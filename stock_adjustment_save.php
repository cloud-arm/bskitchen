<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo");

$userid = $_SESSION['SESS_MEMBER_ID'];
$username = $_SESSION['SESS_FIRST_NAME'];

$id = $_POST['id'];
$new_stock = $_POST['new_stock'];
$note = $_POST['note'];


$result = $db->prepare("SELECT * FROM products WHERE id=:id ");
$result->bindParam(':id', $id);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
    $name = $row['product_name'];
    $qty = $row['qty'];
}

$stock_id = 0;
$result = $db->prepare("SELECT * FROM stock WHERE product_id=:id ");
$result->bindParam(':id', $id);
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
    $stock_id = $row['id'];
}

$date = date("Y-m-d");
$time = date('H:i:s');

$sql = "UPDATE  products SET qty=? WHERE id=?";
$ql = $db->prepare($sql);
$ql->execute(array($new_stock, $id));

$sql = "UPDATE  stock SET qty_balance=? WHERE id=?";
$ql = $db->prepare($sql);
$ql->execute(array($new_stock, $stock_id));

$sql = "INSERT INTO stock_adjustment (product_id,product_name,stock_id,pr_stock,new_stock,note,date,time,userid,username) VALUES (?,?,?,?,?,?,?,?,?,?)";
$re = $db->prepare($sql);
$re->execute(array($id, $name, $stock_id, $qty, $new_stock, $note, $date, $time, $userid, $username));


header("location: stock_adjustment.php");
