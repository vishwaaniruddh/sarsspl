<?php 
session_start();
include('config.php');

$L_username=$_REQUEST['L_username'];
$L_pass=$_REQUEST['L_pass'];
$G_email=$_REQUEST['G_email'];
$G_mob=$_REQUEST['G_mob'];

if($L_username!="" && $L_pass!=""){

$qrylogin=mysqli_query($con1,"select * from login where (email='".$L_username."' or MobileNumber='".$L_username."') and password='".$L_pass."'");
$fetch1=mysqli_num_rows($qrylogin);



if($fetch1 > 0)
{
    
  // echo  $_SESSION['gid'];
    
$fetch=mysqli_fetch_array($qrylogin);
$updt=mysqli_query($con1,"UPDATE `cart` SET `user_id`='".$fetch[3]."' WHERE user_id='".$_SESSION['gid']."' and status=0");

$updt=mysqli_query($con1,"UPDATE `compare_products` SET `user_id`='".$fetch[3]."' WHERE user_id='".$_SESSION['gid']."'");


   $_SESSION['email']=$L_username;
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
    
}else if($G_email!="" && $G_mob!="") {

$qrylogin=mysqli_query($con1,"select * from login where email='".$G_email."' or MobileNumber='".$G_mob."'");
$fetch1=mysqli_num_rows($qrylogin);
if($fetch1 > 0){
 $fetch=mysqli_fetch_array($qrylogin);
    if($fetch[1]==$G_email){
        echo 2;
    }
    else if($fetch[4]==$G_mob){
        echo 3;
    }
    
}else{

    
$pass=str_pad(rand(0,999), 5, "0", STR_PAD_LEFT);

// echo $pass."@#".$G_email."@#".$G_mob;


//==================== send mail for login id and password===========



	// Authorisation details.
	$username = "deepakdeepakgupta265@gmail.com";
	$hash = "fcf11fdbbeecb26097413d02e207f6603219386819ee3038f38ce82a7b684465";

	// Config variables. Consult http://api.textlocal.in/docs for more info.
	$test = "0";

	// Data for text message. This is the text message data.
	$sender = "TXTLCL"; // This is who the message appears to be from.
	$numbers = "919987856464"; // A single number or a comma-seperated list of numbers
	$message = "Your OTP is:".$pass;
	// 612 chars or less
	// A single number or a comma-seperated list of numbers
	$message = urlencode($message);
	$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
	$ch = curl_init('http://api.textlocal.in/send/?');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch); // This is the result from the API
	curl_close($ch);
	
	


         $to = $G_email;
         $subject = "Merabazaar";
         
        $message = "<h4>Your OTP and Password :".$pass."</h4>";
          
         $header = "From:Merabazzar.com \r\n";
         $header .= "Cc:jaiswarabhishek2@gmail.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
        

//===================================================================






$qryRegi=mysqli_query($con1,"insert into Registration (email,Mobile,password,resale_merchant) values('".$G_email."','".$G_mob."','".$pass."','1') ");
 $lstid=mysqli_insert_id($con1);

if($lstid!=""){
   $qrylogin=mysqli_query($con1,"insert into login (email,MobileNumber,password,regid) values('".$G_email."','".$G_mob."','".$pass."','".$lstid."') ");


if($qrylogin){
    echo 1;
    
}
}  
}
    
}
    
    


?>