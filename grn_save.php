<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$userid = $_SESSION['SESS_MEMBER_ID'];
$username = $_SESSION['SESS_FIRST_NAME'];

$invo = $_POST['id'];
$type = $_POST['type'];
$sup = $_POST['supply'];
$sup_invo = $_POST['sup_invoice'];
$note = $_POST['note'];

$pay_amount = 0;
if ($type != 'Order') {
    $pay_amount = $_POST['amount'];
}

$pay_type = '';
$acc_no = '';
$bank_name = '';
$chq_no = '';
$chq_bank = '';
$chq_date = '';
if ($type == 'GRN') {

    $pay_type = $_POST['pay_type'];

    if ($pay_type == 'Bank') {
        $acc_no = $_POST['acc_no'];
        $bank_name = $_POST['bank_name'];
    }

    if ($pay_type == 'Chq') {
        $chq_no = $_POST['chq_no'];
        $chq_bank = $_POST['chq_bank'];
        $chq_date = $_POST['chq_date'];
    }
}

$dic = 0;


$result = $db->prepare("SELECT * FROM supplier WHERE id=:id ");
$result->bindParam(':id', $sup);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
    $sup_name = $row['name'];
}

$bank = 0;

$result = $db->prepare("SELECT * FROM bank WHERE id=:id ");
$result->bindParam(':id', $bank);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
    $bank_name = $row['name'];
}

$result = $db->prepare("SELECT sum(amount),sum(discount) FROM purchases_list WHERE invoice_no=:id ");
$result->bindParam(':id', $invo);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
    $amount = $row['sum(amount)'];
    $dic = $row['sum(discount)'];
}

$date = date("Y-m-d");
$time = date('H:i:s');

if ($invo != '') {
    $sql = "INSERT INTO purchases (invoice_no,amount,remarks,date,supplier_id,supplier_name,supplier_invoice,pay_type,pay_amount,discount,type,user_id) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
    $re = $db->prepare($sql);
    $re->execute(array($invo, $amount, $note, $date, $sup, $sup_name, $sup_invo, $pay_type, $pay_amount, $dic, $type, $userid));

    if ($type == 'GRN') {

        $sql = "UPDATE  purchases_list SET action=? WHERE invoice_no=?";
        $ql = $db->prepare($sql);
        $ql->execute(array('active', $invo));


        if ($amount > $pay_amount) {

            $credit = $amount - $pay_amount;

            $sql = 'INSERT INTO supply_payment (amount,pay_amount,pay_type,date,invoice_no,supply_id,supply_name,supplier_invoice,type,credit_balance) VALUES (?,?,?,?,?,?,?,?,?,?)';
            $q = $db->prepare($sql);
            $q->execute(array($credit, 0, 'Credit', $date, $invo, $sup, $sup_name, $sup_invo, $type, $credit));
        }

        if ($pay_amount > 0) {
            $sql = 'INSERT INTO supply_payment (amount,pay_amount,pay_type,date,invoice_no,supply_id,supply_name,supplier_invoice,type,chq_no,chq_bank,chq_date,bank_name,acc_no) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
            $q = $db->prepare($sql);
            $q->execute(array($pay_amount, $pay_amount, $pay_type, $date, $invo, $sup, $sup_name, $sup_invo, $type, $chq_no, $chq_bank, $chq_date, $bank_name, $acc_no));
        }

        $result = $db->prepare("SELECT * FROM purchases_list WHERE invoice_no = '$invo' ");
        $result->bindParam(':userid', $res);
        $result->execute();
        for ($i = 0; $row = $result->fetch(); $i++) {
            $p_id = $row['product_id'];
            $name = $row['name'];
            $qty = $row['qty'];
            $date = $row['date'];
            $sell = $row['sell'];
            $cost = $row['cost'];

            $qty_blc = 0;
            $re = $db->prepare("SELECT * FROM products WHERE id = '$p_id' ");
            $re->bindParam(':userid', $res);
            $re->execute();
            for ($k = 0; $r = $re->fetch(); $k++) {
                $st_qty = $r['qty'];
                $code = $r['product_code'];
            }

            $qty_blc = $st_qty + $qty;

            $sql = "UPDATE  products SET qty = ?, cost_price = ?, sell_price = ? WHERE id=?";
            $ql = $db->prepare($sql);
            $ql->execute(array($qty_blc, $cost, $sell, $p_id));

            $sql = "INSERT INTO inventory (product_id,name,invoice_no,type,balance,qty,date,sell,cost) VALUES (?,?,?,?,?,?,?,?,?)";
            $ql = $db->prepare($sql);
            $ql->execute(array($p_id, $name, $invo, 'in', $qty_blc, $qty, $date, $sell, $cost));

            $sql = "INSERT INTO stock_log (type,invoice_no,product_id,product_name,qty,qty_balance,date,time,user_id,source_id) VALUES (?,?,?,?,?,?,?,?,?,?)";
            $re = $db->prepare($sql);
            $re->execute(array('GRN',$invo, $p_id, $name, $qty, $qty_blc, $date, $time, $userid, $row['id']));


            $qty_blc = 0;
            $con = 0;
            $re = $db->prepare("SELECT * FROM stock ");
            $re->bindParam(':userid', $res);
            $re->execute();
            for ($k = 0; $r = $re->fetch(); $k++) {
                $st_qty = $r['qty_balance'];
                $st_sell = $r['sell'];
                $st_cost = $r['cost'];
                $st_p = $r['product_id'];
                $st_sup = 1;
                $st_id = $r['id'];

                if ($sell == $st_sell & $cost == $st_cost & $sup == $st_sup & $p_id == $st_p) {

                    $sql = "UPDATE stock SET qty=qty+?, qty_balance=qty_balance+? WHERE id=?";
                    $ql = $db->prepare($sql);
                    $ql->execute(array($qty, $qty, $st_id));
                    $con = 1;
                }
            }

            if ($con == 0) {

                $sql = "INSERT INTO stock (product_id,code,name,invoice_no,qty_balance,qty,date,supplier_id,supplier_name,sell,cost) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                $ql = $db->prepare($sql);
                $ql->execute(array($p_id, $code, $name, $invo, $qty, $qty, $date, $sup, $sup_name, $sell, $cost));
            }
        }


        if ($pay_type == 'Cash') {

            $cr_id = 2;

            $de_blc = 0;
            $blc = 0;
            $re = $db->prepare("SELECT * FROM cash WHERE id = $cr_id ");
            $re->bindParam(':userid', $res);
            $re->execute();
            for ($k = 0; $r = $re->fetch(); $k++) {
                $blc = $r['amount'];
                $cr_name = $r['name'];
            }

            $de_blc = $blc - $pay_amount;

            $cr_type = 'grn_payment';

            $sql = "INSERT INTO transaction_record (transaction_type,type,record_no,amount,action,credit_acc_no,credit_acc_type,credit_acc_name,credit_acc_balance,debit_acc_type,debit_acc_name,debit_acc_id,debit_acc_balance,date,time,user_id,user_name) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $ql = $db->prepare($sql);
            $ql->execute(array('GRN', 'Debit', $invo, $pay_amount, 0, 0, $cr_type, 'Cash GRN', 0, $cr_type, $cr_name, $cr_id, $de_blc, $date, $time, $userid, $username));

            $sql = "UPDATE  cash SET amount=? WHERE id=?";
            $ql = $db->prepare($sql);
            $ql->execute(array($de_blc, $cr_id));
        }
    } else

    if ($type == 'Return') {

        $sql = "UPDATE  purchases_list SET action=? WHERE invoice_no=?";
        $ql = $db->prepare($sql);
        $ql->execute(array('close', $invo));

        $sql = 'INSERT INTO supply_payment (amount,pay_amount,pay_type,date,invoice_no,supply_id,supply_name,supplier_invoice,type,credit_balance) VALUES (?,?,?,?,?,?,?,?,?,?)';
        $q = $db->prepare($sql);
        $q->execute(array($amount, 0, 'Credit_note', $date, $invo, $sup, $sup_name, $sup_invo, $type, $amount));

        $result = $db->prepare("SELECT * FROM purchases_list WHERE invoice_no = '$invo' ");
        $result->bindParam(':userid', $res);
        $result->execute();
        for ($i = 0; $row = $result->fetch(); $i++) {
            $p_id = $row['product_id'];
            $name = $row['name'];
            $qty = $row['qty'];
            $date = $row['date'];
            $st_id = $row['stock_id'];

            $qty_blc = 0;
            $re = $db->prepare("SELECT * FROM products WHERE id = '$p_id' ");
            $re->bindParam(':userid', $res);
            $re->execute();
            for ($k = 0; $row0 = $re->fetch(); $k++) {
                $st_qty = $row0['qty'];
            }

            $qty_blc = $st_qty - $qty;

            $sql = "UPDATE  products SET qty=? WHERE id=?";
            $ql = $db->prepare($sql);
            $ql->execute(array($qty_blc, $p_id));

            $sql = "INSERT INTO inventory (product_id,name,invoice_no,type,balance,qty,date) VALUES (?,?,?,?,?,?,?)";
            $ql = $db->prepare($sql);
            $ql->execute(array($p_id, $name, $invo, 'out', $qty_blc, $qty, $date));

            $qty_blc = 0;
            $res = $db->prepare("SELECT * FROM stock WHERE id = :id ");
            $res->bindParam(':id', $st_id);
            $res->execute();
            for ($k = 0; $row0 = $res->fetch(); $k++) {
                $st_qty = $row0['qty_balance'];
            }

            $qty_blc = $st_qty - $qty;

            $sql = "UPDATE stock SET qty=?, qty_balance=? WHERE id=?";
            $ql = $db->prepare($sql);
            $ql->execute(array($qty, $qty_blc, $st_id));
        }
    } else

    if ($type == 'Order') {

        $sql = "UPDATE  purchases_list SET action=? WHERE invoice_no=?";
        $ql = $db->prepare($sql);
        $ql->execute(array('pending', $invo));
    }
}

$invo = date("ymdhis");
$y = date("Y");
$m = date("m");
if ($type == 'GRN') {

    header("location: grn_rp.php?year=$y&month=$m");
}

if ($type == 'Return') {
    header("location: grn_return.php?id=$invo");
}

if ($type == 'Order') {
    header("location: grn_order.php?id=$invo");
}
