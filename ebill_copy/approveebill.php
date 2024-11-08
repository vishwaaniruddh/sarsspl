<?php
include("config.php");
$id=$_GET['id'];
$stat=$_GET['stat'];
$qry=mysqli_query($con,"update ebdetails set print='".$stat."' where bill_no='".$id."'");
if($qry)
echo "1";
else
echo "0";
?>