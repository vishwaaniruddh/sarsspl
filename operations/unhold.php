<?php

include("config.php");

$id=$mysqli_query($con,

//echo "Update alert set call_status='Pending',status='Pending' where alert_id='".$id."'";

$qry=mysqli_query($con,"Update alert set call_status='Pending',status='Pending' where alert_id='".$id."'");

if($qry)

header("location:view_alert.php");

else

echo "Some Error Occurred";

?>