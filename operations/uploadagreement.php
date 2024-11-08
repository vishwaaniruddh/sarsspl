<?php
include('../config.php');
$tkdt=$_GET['tkdt'];
$field=$_GET['field'];
$id=$_GET['id'];
//echo "update newtempsites set ".$field."=STR_TO_DATE('".$tkdt."','%d/%m/%Y'),active='1' where id='".$id."'";
//echo "update newtempsites set ".$field."=STR_TO_DATE('".$tkdt."','%d/%m/%Y'),active='1',ebillstat='1' where id='".$id."'";
$qry=mysqli_query($con,"update newtempsites set ".$field."=STR_TO_DATE('".$tkdt."','%d/%m/%Y'),active='1',ebillstat='1' where id='".$id."'");
if($qry)
echo "1";
else
echo "0".mysqli_error();
?>