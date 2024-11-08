<?php
include("config.php");

$id=$_GET['val'];

//echo "select `Charges` from `ebillcharges` where `auto_id`='".$id."'";
$row=mysqli_query($con,"select `Charges` from `ebillcharges` where `auto_id`='".$id."'");
$row1=mysqli_fetch_row($row);
echo $row1[0]; 

?>