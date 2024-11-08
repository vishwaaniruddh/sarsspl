<?php 
session_start();
include('config.php');
$email=$_POST['email'];
$passwd=$_POST['password'];


$qrylogin=mysqli_query($con1,"select * from login where (email='".$email."' or MobileNumber='".$email."' )   and password='".$passwd."'");
$fetch1=mysqli_num_rows($qrylogin);



if($fetch1 > 0)
{
    
    
$fetch=mysqli_fetch_array($qrylogin);
$updt=mysqli_query($con1,"UPDATE `cart` SET `user_id`='".$fetch[3]."' WHERE user_id='".$_SESSION['gid']."' and status=0");

$updt=mysqli_query($con1,"UPDATE `compare_products` SET `user_id`='".$fetch[3]."' WHERE user_id='".$_SESSION['gid']."'");


   $_SESSION['email']=$email;
   $_SESSION['gid']=$fetch[3];
   $_SESSION['gids']=$fetch[3];
   $_SESSION['loginstats']="1";

header("location:resale_index.php");
//echo 1;
}
else
{
echo 0;
header("location:login.php?err=1");
}
?>