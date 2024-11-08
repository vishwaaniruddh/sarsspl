<?php
session_start();
include('../config.php');


$id=$_GET['id'];
$stat=$_GET['stat'];
//echo "update newtempsites set ".$field."=STR_TO_DATE('".$tkdt."','%d/%m/%Y'),active='1' where id='".$id."'";
//echo "update newtempsites set active='1' where id='".$id."'";
//echo "update newtempsites set active='".$stat."',ebillstat='2',appby='".$_SESSION['user']."' where id='".$id."'";
$qry=mysqli_query($con,"update newtempsites set active='".$stat."',ebillstat='".$stat."',appby='".$_SESSION['user']."' where id='".$id."'");
if($qry)
echo "1";
else
echo "0";
?>