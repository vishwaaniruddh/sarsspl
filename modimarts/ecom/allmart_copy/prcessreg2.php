<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('config.php');

$fname=mysqli_real_escape_string($_POST['firstname']);
$lname=mysqli_real_escape_string($_POST['lastname']);
$email=mysqli_real_escape_string($_POST['email']);
$state=mysqli_real_escape_string($_POST['state']);
$address=mysqli_real_escape_string($_POST['address_1']);
$city=mysqli_real_escape_string($_POST['city']);
$pincod=mysqli_real_escape_string($_POST['pincod']);
$mob=mysqli_real_escape_string($_POST['contact']);
//echo $mob;


$Pid=mysqli_real_escape_string($_POST['pid']);
$cId=mysqli_real_escape_string($_POST['cid']);
$qty=mysqli_real_escape_string($_POST['qty']);
$clr=mysqli_real_escape_string($_POST['clr']);
$sz=mysqli_real_escape_string($_POST['sz']);





$pass=$_POST['password'];
//$pass=$_POST['pass'];

//echo "radio ".$rd;

/*$qryuser=mysqli_query($con1,"select max(user_id) from generate_userid");
$fetchuser=mysqli_fetch_array($qryuser);
$fetchid=mysqli_num_rows($qryuser);

if($fetchid>0)
{
$uid=$fetchuser[1]+1;
}
else
{
$uid=1;
}
$qryid=mysqli_query($con1,"INSERT INTO `generate_userid`(user_id) values ('".$uid."');*/
$qry="";
/*
$chkqry=mysqli_query($con1,"select * from login where email='".$email."'");
//echo "select * from login where email='".$email."'";


//$fetch=mysqli_fetch_array($qrylogin);

$fetch1=mysqli_num_rows($chkqry);

if($fetch1 > 0)
{
?>
<script>alert("Email already exist!!");</script>
<?php
}
else
{*/
if($_SESSION['gid']!="")
{
    $gtsts=mysqli_query($con1,"SELECT * FROM `states` where state_name='".$state."'");
    $stsrw=mysqli_fetch_array($gtsts);
   // echo  "update Registration set `Firstname`='".$fname."',`Lastname`='".$lname."',`email`='".$email."',`Mobile`='".$mob."',`Gender`='".$rd."',`address`='".$address."',`pincode`='".$pincode."',`state`='".$state."',`city`='".$city."',`password`='".$pass."' where id='".$_SESSION['gid']."'";
$qry=mysqli_query($con1,"update Registration set `Firstname`='".$fname."',`Lastname`='".$lname."',`email`='".$email."',`Mobile`='".$mob."',`Gender`='".$rd."',`address`='".$address."',`pincode`='".$pincode."',`state`='".$stsrw[0]."',`city`='".$city."',`password`='".$pass."' where id='".$_SESSION['gid']."'");

$qrylogin=mysqli_query($con1,"INSERT INTO `login`(`email`, `password`, `regid`) VALUES ('".$email."','".$pass."','".$_SESSION['gid']."')");

    
$qryaddrqr=mysqli_query($con1,"INSERT INTO `user_address`(`user_id`, `address`, `state`, `city`, `pin`) VALUES('".$_SESSION['gid']."','".$address."','".$stsrw[0]."','".$city."','".$pincode."')"); 
    
}
else
{
/*$qry=mysqli_query($con1,"INSERT INTO `Registration`(`Firstname`, `Lastname`, `email`, `Mobile`, `address`, `pincode`, `landmark`, `state`, `city`, `Gender`, `password`)
VALUES ('".$fname."','".$lname."','".$email."','".$mob."','".$address."','".$pincode."','','".$state."','".$city."','".$address."','','".$pass."')");

//echo "INSERT INTO `Registration`(`Firstname`, `Lastname`, `email`, `Mobile`, `address`, `pincode`, `landmark`, `state`, `city`, `Gender`, `password`)
//VALUES ('".$fname."','".$lname."','".$email."','".$mob."','".$address."','".$pincode."','','".$state."','".$city."','".$address."','','".$pass."')";
$id=mysqli_insert_id();

$qrylogin=mysqli_query($con1,"INSERT INTO `login`(`email`, `password`, `regid`) VALUES ('".$email."','".$pass."','".$id."')");*/

}

       


if($qry & $_SESSION['gid']!="")
{
     $_SESSION['email']=$email;
   $_SESSION['loginstats']="1";
   
header("Location:Checkout.php?Pid=$Pid&cId=$cId&qty=$qty&clr=$clr&sz='$sz'");
//echo $email;
}
else
{
  header("Location:Checkout.php?Pid=$Pid&cId=$cId&qty=$qty&clr=$clr&sz='$sz'");
}

//========================send mail=============

$qrymail=mysqli_query($con1,"select id from verification where email='".$email."'");
//echo "select * from verification where email='".$email."'";
$fetchem=mysqli_fetch_array($qrymail);
$fetch=mysqli_num_rows($qrymail);

function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}
  $string=random_string(7);
       $email = strip_tags($email);





$str="";


  if($fetchem[0]!="")
  {   
  	$str="update verification  set code='".$string ."' where EMAIL='".$email."' ";
  	//$update = 1;
   
   }
   else
   {
if($_SESSION['gid']!="")
{
 	$str="INSERT INTO verification(email,code,reg_id) VALUES ('".$email."','".$string ."','".$_SESSION['gid']."')";
}
else
{
$str="INSERT INTO verification(email,code,reg_id) VALUES ('".$email."','".$string ."','".$_SESSION['id']."')";
}
 	//echo $str;
 }
 

?>