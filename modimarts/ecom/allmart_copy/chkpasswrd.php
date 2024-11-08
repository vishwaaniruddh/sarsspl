<?php 
session_start();
include('config.php');

$passwd=$_POST['password'];

$qrylogin=mysqli_query($con1,"select * from login where  password='".$passwd."' and regid='".$_SESSION['gid']."'");
//echo "select * from login where email='".$email."' and password='".$passwd."'";
$fetch1=mysqli_num_rows($qrylogin);

if($fetch1>0)
{
    echo 1;
}
else
{
    echo 0;
}
?>