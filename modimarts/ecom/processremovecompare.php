<?php
session_start();
include('config.php');
$prid = $_POST['compareid'];
$usrid=$_SESSION['gid'];

$errs=0;
if($usrid!=="")
{

$chkqr=mysqli_query($con1,"delete from compare_products where id='".$prid."'");

if(!$chkqr)
{
    echo 0;
}
else
{
    echo 1;
}
}else
{
    echo 2;
}
?>