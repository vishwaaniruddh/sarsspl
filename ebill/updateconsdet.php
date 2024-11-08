<?php
include("config.php");
mysqli_query($con,"BEGIN");
$up=mysqli_query($con,"update `".$_POST['cid']."_ebill` set `Consumer_No`='".$_POST['con_no']."', `Distributor`='".$_POST['distributor']."', `Due_Date`='".$_POST['duedate']."', `landlord`='".$_POST['landlord']."', `billing_unit`='".$_POST['billunit']."', `meter_no`='".$_POST['meterno']."', `averagebill`='".$_POST['avgbill']."' where atmtrackid='".$_POST['trackid']."'");
//echo "update `".$_POST['cid']."_sites` set site_id='".$_POST['siteid']."' where trackerid='".$_POST['trackid']."'";
$up1=mysqli_query($con,"update `".$_POST['cid']."_sites` set site_id='".$_POST['siteid']."' where trackerid='".$_POST['trackid']."'");
if($up && $up1)
{
	mysqli_query($con,"COMMIT");
	header('location:electricbills.php');
}
else
{
	mysqli_query($con,"ROLLBACK");
	echo "Some Error Occurred".mysqli_error();
}
?>