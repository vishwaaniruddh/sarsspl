<?php
session_start();
include "config.php"; 
if($_POST['st']=="1"){
$oid=$_POST['oid'];
$loc=$_POST['loc'];
$date = date('Y-m-d H:i:s');
$query=mysqli_query($con1,"update order_shipping set current_Location='".$loc."',dt='".$date."' where oid='".$oid."'");

//echo "update order_shipping set current_Location='".$loc."' where oid='".$oid."'";
if($query)
{
    echo 1;
    
}
else
{
    
    echo 0;
}
}



if($_POST['st']=="2")
{   
$oid=$_POST['oid'];
$rj=$_POST['rj'];
$query=mysqli_query($con1,"update Orders set rejReason='".$rj."' where id='".$oid."'");
if($query)
{
    echo 1;
}
else
{
    echo 0;
}
}
?>