<?php 
session_start();
include('config.php');

if($_POST['ac']=="guest"){
    $Mobile=$_POST['Mobile'];
    $Mail=$_POST['Mail'];
    
    $qrylogin=mysqli_query($con1,"select * from login where email='".$Mail."' or MobileNumber='".$Mobile."'");
$fetch1=mysqli_num_rows($qrylogin);
if($fetch1 > 0){
 $fetch=mysqli_fetch_array($qrylogin);
    if($fetch[1]==$Mail){
        echo 2;
    }
    else if($fetch[4]==$Mobile){
        echo 3;
    }
    
    
    
}else{

    
$pass=str_pad(rand(0,999), 5, "0", STR_PAD_LEFT);
$qryRegi=mysqli_query($con1,"insert into Registration (email,Mobile,password) values('".$Mail."','".$Mobile."','".$pass."') ");
 $lstid=mysqli_insert_id($con1);
if($lstid!=""){
   $qrylogin=mysqli_query($con1,"insert into Login (email,Mobile,password) values('".$Mail."','".$Mobile."','".$pass."') ");
}

if($qrylogin){
    echo 1;
    
}
    
}
    
}else{
$email=$_POST['email'];
$passwd=$_POST['password'];

$qrylogin=mysqli_query($con1,"select * from login where email='".$email."' and password='".$passwd."'");
$fetch1=mysqli_num_rows($qrylogin);



if($fetch1 > 0)
{
$fetch=mysqli_fetch_array($qrylogin);
$updt=mysqli_query($con1,"UPDATE `cart` SET `user_id`='".$fetch[3]."' WHERE user_id='".$_SESSION['gid']."' and status=0");

$updt=mysqli_query($con1,"UPDATE `compare_products` SET `user_id`='".$fetch[3]."' WHERE user_id='".$_SESSION['gid']."'");


   $_SESSION['email']=$email;
   $_SESSION['gid']=$fetch[3];
   $_SESSION['loginstats']="1";


   $_SESSION['log']="login";

//echo $fetch[3];
//header("location:index.php");
echo 1;
}
else
{
echo 0;
//header("location:login.php");
}
    
}

?>