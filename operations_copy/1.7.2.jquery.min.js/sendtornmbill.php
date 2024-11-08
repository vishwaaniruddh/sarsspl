<?php
session_start();
if(!$_SESSION['user'])
echo "1";
else
{
include("config.php");
$qid=$_GET['id'];
//echo "update quotation set bill='n' where quotid='".$qid."'";
$update=mysqli_query($con,"update quotation set bill='n' where quotid='".$qid."'");
if($update)
{
echo "2";
}
else{
echo "4";
}
}
?>