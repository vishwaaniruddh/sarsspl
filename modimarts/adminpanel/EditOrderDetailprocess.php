<?php 
session_start();
include('config.php');
include('adminaccess.php');

error_reporting(E_ALL);
ini_set('display_errors', '1');
// var_dump($_POST);

$order_id=$_POST['order_id'];
$username=$_POST['username'];
$orderdate=$_POST['orderdate'];
$orderdate     = date('Y-m-d H:i:s',strtotime($orderdate));
$phone=$_POST['phone'];
$email=$_POST['email'];
$billing_address=$_POST['billing_address'];
$billing_city=$_POST['billing_city'];
$billing_state=$_POST['billing_state'];
$billing_zip=$_POST['billing_zip'];
$gstnumber=$_POST['gstnumber'];
$pannumber=$_POST['pannumber'];
$itemid=$_POST['itemid'];
$discount=$_POST['discount'];
$shipping_charges=$_POST['shipping_charges'];
$g_total=$_POST['g_total'];
$ordertype=$_POST['ordertype'];
$Notes=$_POST['Notes'];
$ship_to=$_POST['ship_to'];
if(isset($_POST['is_franchise'])){  $is_franchise=$_POST['is_franchise']; } else {
	$is_franchise=0;
}

$userid=$_POST['userid'];
$prociunt=count($itemid);
// echo $prociunt;

// var_dump($is_franchise);die();


if (isset($_POST['updatepro'])) {
	$update=mysqli_query($con1,"UPDATE `Order_ent` SET `date`='".$orderdate."',`amount`='".$g_total."',`discount`='".$discount."',`pmode`='".$ordertype."',`shipping_charges`='".$shipping_charges."',`gst_details`='".$gstnumber."',`pan_details`='".$pannumber."',`Notes`='".$Notes."',`user_id`='".$userid."',`ship_to`='".$ship_to."',`is_franchise`='".$is_franchise."' WHERE id='".$order_id."'");
	if ($update) {

		$adupdate=mysqli_query($con1,"UPDATE `new_order` SET `name`='".$username."',`email`='".$email."',`phone`='".$phone."',`address`='".$billing_address."',`city`='".$billing_city."',`state`='".$billing_state."',`zip`='".$billing_zip."' WHERE oid='".$order_id."'");

		for ($i=0; $i < $prociunt; $i++)
		{ 
			$itemid=$_POST['itemid'][$i];
			$productprice=$_POST['productprice'][$i];
			$productqty=$_POST['productqty'][$i];
			$pro_total=$_POST['pro_total'][$i];
			$pro_dis=$_POST['pro_dis'][$i];
			$pro_disamt=$_POST['pro_disamt'][$i];

			$updatesuccess = mysqli_query($con1,"UPDATE `order_details` SET `rate`='".$productprice."',`qty`='".$productqty."',`total_amt`='".$pro_total."',`discount`='".$pro_dis."',`dis_amount`='".$pro_disamt."' WHERE id='".$itemid."'");
			
			
		}
		?>

<script>
    alert("Order Updated  Successfully !");    
    // setTimeout(function(){
        window.location.href='/adminpanel/EditOrderDetails.php?orderid=<?=$order_id?>';        
    // }, 1500);
</script>

<?php

	}
	else
	{
		?>

<script>
    alert("Order Not Updated !");    
    // setTimeout(function(){
        window.location.href='/adminpanel/EditOrderDetails.php?orderid=<?=$order_id?>';        
    // }, 1500);
</script>

<?php
	}
	
}
else
{
	?>

<script>
    alert("Order Not Updated !");    
    // setTimeout(function(){
        window.location.href='/adminpanel/EditOrderDetails.php?orderid=<?=$order_id?>';        
    // }, 1500);
</script>

<?php
}


 ?>