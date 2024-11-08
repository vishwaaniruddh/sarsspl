<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include ('config.php');
//ECHO 'TR';

$sts=$_POST['sts'];
$val=$_POST['val'];

if($sts=="1")
{
//echo "SELECT * FROM `login` where username='".$email."'";
$qr=mysqli_query($con,"SELECT emailid FROM quiz_regdetails where emailid='".$val."'");
$nrws=mysqli_num_rows($qr);

echo $nrws;
}


if($sts=="2")
{
//echo "SELECT * FROM `login` where username='".$email."'";
//echo "SELECT username FROM quiz_login where username='".$val."'";
$qr=mysqli_query($con,"SELECT username FROM quiz_login where username='".$val."'");
$nrws=mysqli_num_rows($qr);

echo $nrws;
}

?>