<?php 
include 'config.php';
$itemid=$_POST['oid'];
$status='1';

$update=mysqli_query($con1,"UPDATE `order_details` SET `shipping_status`='".$status."' WHERE id='".$itemid."'");
if ($update) {
	echo "Success fully Accepted";
}
else
{
	echo "Not Accepted";
}
 ?>
