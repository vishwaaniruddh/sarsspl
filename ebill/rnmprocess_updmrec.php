<?php

include("access.php");
include("config.php");	

$qid=$_POST['qid'];
$bank=$_POST['bank'];
$city=$_POST['city'];
$state=$_POST['state'];
$proj=$_POST['proj'];
$sv=$_POST['sv'];   
$locn=mysqli_real_escape_string($con,$_POST['locn']);
//echo "ok";



$updqry=mysqli_query($con,"update quotation1 set bank='".$bank."',city='".$city."',state='".$state."',location='".$locn."',project_id='".$proj."',supervisor='".$sv."' where id='".$qid."'");

if($updqry)
{

echo "Updated";
}
else
{
echo "Error";
}
?>