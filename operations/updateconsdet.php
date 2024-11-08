<?php

inclmysqli_query($con,php");

$up=mysqli_query($con,"update `".$_POST['cid']."_ebill` set `Consumer_No`='".$_POST['con_no']."', `Distributor`='".$_POST['distributor']."', `Due_Date`='".$_POST['duedate']."', `landlord`='".$_POST['landlord']."', `billing_unit`='".$_POST['billunit']."', `meter_no`='".$_POST['meterno']."', `averagebill`='".$_POST['avgbill']."' where id='".$_POST['id']."'");

if($up)

header('location:electricbills.php');

else

echo "Some Error Occurred".mysqli_error();

?>