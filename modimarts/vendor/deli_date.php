<?php
session_start();
include "config.php"; 


$oid=$_POST['oid'];
$deldt=$_POST['datepicker'];
$deldts = date("Y-m-d", strtotime($deldt));
//echo $oid;
//echo $deldt;



$query=mysqli_query($con1,"update Orders set delivery_date='".$deldts."' where id='".$oid."'");
//echo "update Orders set delivery_date='".$deldts."' where id='".$oid."'";

if($query)
{
    echo 1;
    
}
else
{
    
    echo 0;
}

?>

