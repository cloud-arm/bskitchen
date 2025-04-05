<?php
session_start();
include('config.php');
date_default_timezone_set("Asia/Colombo");


$id = $_GET['id'];
$type = $_GET['type'];

if($type=="delete"){
    query("UPDATE products SET dll = 1 WHERE id = '$id' ");
}

if($type=="disable"){
    query("UPDATE products SET action = 1 WHERE id = '$id' ");
}

if($type=="enable"){
    query("UPDATE products SET action = 0 WHERE id = '$id' ");
}



header("location: product_view.php");
