<?php
session_start();
include('connect.php');
$sell = $_POST['sell'];
$cost = $_POST['cost'];
$name = $_POST['name'];
$cat_id=$_POST['cat_id'];
$id =$_POST['pro_id'];


$result = $db->prepare('SELECT * FROM category WHERE  id=:id ');
$result->bindParam(':id', $cat_id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ $cat=$row['name']; }


$sql = 'UPDATE  products SET product_name=?, sell_price =? , cost_price=?, cat=?, cat_id=?  WHERE  id=? ';
$ql = $db->prepare($sql);
$ql->execute(array($name,$sell,$cost,$cat,$cat_id,$id));


header("location: product_view.php");


?>