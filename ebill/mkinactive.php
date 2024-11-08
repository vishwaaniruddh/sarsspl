<?php
include("config.php");
$id=$_GET['id'];
$val=$_GET['val'];
$cid=$_GET['cid'];
//echo "update ".$cid."_sites set active='".$val."' where id='".$id."'";
$qry=mysqli_query($con,"update ".$cid."_sites set active='".$val."' where id='".$id."'");

if($qry)
{
echo "Done";
}
else
echo "Some Error Occurred".mysqli_error();
?>