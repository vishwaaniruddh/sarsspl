<?php
session_start();
include('config.php');

$state=mysqli_real_escape_string($_POST['zone_id']);
$address=mysqli_real_escape_string($_POST['address_1']);
$city=mysqli_real_escape_string($_POST['city']);
$pincode=mysqli_real_escape_string($_POST['postcode']);


$gtsts=mysqli_query($con1,"SELECT * FROM `states` where state_name='".$state."'");
$stsrw=mysqli_fetch_array($gtsts);


if($_POST['id']=="")
{
$qryaddrqr=mysqli_query($con1,"INSERT INTO `user_address`(`user_id`, `address`, `state`, `city`, `pin`) VALUES('".$_SESSION['gid']."','".$address."','".$stsrw[0]."','".$city."','".$pincode."')"); 
}
else
{
  $qryaddrqr=mysqli_query($con1,"update `user_address` set `address`='".$address."', `state`='".$stsrw[0]."', `city`='".$city."', `pin`='".$pincode."' where id='".$_POST["id"]."'"); 
    
}
if($qryaddrqr)
{
    echo 1;
}else
{
    echo mysqli_error($con1);
    echo 0;
}
?>