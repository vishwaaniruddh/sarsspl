<?php 
session_start();
include('config.php');
 $orderids=$_POST['orderids'];
 $getorder=mysqli_query($con1,"SELECT oid FROM `proforma_order_details` WHERE id='".$orderids."'");
 $getorderdata=mysqli_fetch_assoc($getorder);
 $deleteOrdes=mysqli_query($con1,"DELETE FROM `proforma_order_details` WHERE id='".$orderids."'");
 if($deleteOrdes)
 {
 	$orderId=$getorderdata['oid'];
 	$getttaldata=mysqli_query($con1,"SELECT SUM(total_amt) as totlamt FROM `proforma_order_details` WHERE oid='".$orderId."'");
 	$gettotalamt=mysqli_fetch_assoc($getttaldata);
 	$ttlamt=$gettotalamt['totlamt'];

 	$updatdata=mysqli_query($con1,"UPDATE `proforma_Order_ent` SET `amount`='".$ttlamt."' WHERE id='".$orderId."'");
 }

 if($deleteOrdes)
 {
 	echo "Order Item Remove From Order";

 }
 else
 {
 	echo "Order Item Not Remove From Order";
 }
 ?>