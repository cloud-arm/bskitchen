<?php
session_start();
include('connect.php');
$name = $_POST['name'];
$code = $_POST['code'];
$type = $_POST['type'];
$sell = 0;
$cost = 0;
$cat = 0;
$stock = 0;

if ($type == 'service') {
    $sell = $_POST['sell'];
}

if ($type == 'dish') {
    $sell = $_POST['sell'];
    $cat = $_POST['cat'];
}

if ($type == 'Materials') {
    $cost = $_POST['cost'];
    $stock = 1;
}


// query
$sql = "INSERT INTO products (product_name,product_code,sell_price,cost_price,type,cat_id,stock_action) VALUES (?,?,?,?,?,?,?)";
$ql = $db->prepare($sql);
$ql->execute(array($name, $code, $sell, $cost, $type, $cat, $stock));


if ($c == 'dish') {
    $result = $db->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 1");
    $result->bindParam(':userid', $date);
    $result->execute();
    for ($i = 0; $row = $result->fetch(); $i++) {
        $pro_id = $row['id'];
        $id = 0;
    }

    $sql = "UPDATE use_product
        SET main_product=?
		WHERE main_product=?";
    $q = $db->prepare($sql);
    $q->execute(array($pro_id, $id));
}

if ($c == 'service') {
    $result = $db->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 1");
    $result->bindParam(':userid', $date);
    $result->execute();
    for ($i = 0; $row = $result->fetch(); $i++) {
        $pro_id = $row['id'];
        $id = 0;
    }

    $sql = "UPDATE use_product
        SET main_product=?
		WHERE main_product=?";
    $q = $db->prepare($sql);
    $q->execute(array($pro_id, $id));
}


header("location: product_view.php");
