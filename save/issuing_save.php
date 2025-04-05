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

header("location: ../issuing.php");
 