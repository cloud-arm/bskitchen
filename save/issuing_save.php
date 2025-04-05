<?php
session_start();
include('../config.php');




$insertData = array(
    "data" => array(
        "name" => select_item('products','product_name','id='.$_POST['product'],'../'),
        "product_id" => $_POST['product'],
        "qty" => $_POST['qty'],
        "ration" => select_item('ration','name','id='.$_POST['ration'],'../'),
        "ration_id" => $_POST['ration'],
        "date"=> $_POST['date'],  
    ),
    "other" => array(
    ),
);
print_r( insert("sales_list", $insertData,'../'));


query("UPDATE products SET qty=qty-".$_POST['qty']." WHERE id=".$_POST['product'],'../');

$insertData = array(
    "data" => array(
        "type" => "invoice",
        "product_name" => select_item('products','product_name','id='.$_POST['product'],'../'),
        "product_id" => $_POST['product'],
        "qty" => $_POST['qty'],
        "qty_balance"=>select_item('products','qty','id='.$_POST['product'],'../'),
        "date"=> date("Y-m-d"),  
        "time"=> date("H:i:s"),
    ),
    "other" => array(
    ),
);
print_r( insert("stock_log", $insertData,'../'));





header("location: ../issuing.php");
 