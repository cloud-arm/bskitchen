<?php
session_start();
include('../config.php');




$product_id = select_item('sales_list','product_id','id='.$_POST['id'],'../');

if (select_item('sales_list','action','id='.$_POST['id'],'../')==12) {
    echo "Already voided";
    exit();
}
$qty = select_item('sales_list','qty','id='.$_POST['id'],'../');
$balance = select_item('products','qty','id='.$product_id,'../')+$qty;

update("sales_list", ['action'=>'12'], "id=".$_POST['id'], '../');
update("products", ['qty'=>$balance], "id=".$product_id, '../');

$insertData = array(
    "data" => array(
        "type" => "Return",
        "product_name" => select_item('products','product_name','id='.$product_id,'../'),
        "product_id" => $product_id,
        "qty" => $qty,
        "qty_balance"=>$balance,
        "date"=> date("Y-m-d"),
        "time"=> date("H:i:s"),
    ),
    "other" => array(
    ),
);
print_r( insert("stock_log", $insertData,'../'));


header("location: ../issuing.php");
 