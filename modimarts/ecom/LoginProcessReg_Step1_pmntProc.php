<?php 
session_start();
include('config.php');
$pass=$_POST['randomNo'];
$G_email=$_POST['emailsend'];
$G_mob=$_POST['mobisend'];


$qryRegi=mysqli_query(mysqli_insert_id,"insert into Registration (email,Mobile,password,resale_merchant) values('".$G_email."','".$G_mob."','".$pass."','1') ");
 $lstid=mysqli_insert_id($con1);

if($lstid!=""){
   $qrylogin=mysqli_query($con1,"insert into login (email,MobileNumber,password,regid) values('".$G_email."','".$G_mob."','".$pass."','".$lstid."') ");



$qrylogin=mysqli_query($con1,"select * from login where (email='".$G_email."' or MobileNumber='".$G_mob."') and password='".$pass."'");
$fetch1=mysqli_num_rows($qrylogin);
if($fetch1 > 0)
{
    
    
$fetch=mysql_fetch_array($qrylogin);
//echo $_SESSION['gid'];
$updt=mysqli_query($con1,"UPDATE `cart` SET `user_id`='".$fetch[3]."' WHERE user_id='".$_SESSION['gid']."' and status=0");

$updt=mysqli_query($con1,"UPDATE `compare_products` SET `user_id`='".$fetch[3]."' WHERE user_id='".$_SESSION['gid']."'");


    
    
    
   $_SESSION['email']=$G_email;
   $_SESSION['gid']=$fetch[3];
   $_SESSION['loginstats']="1";
   
   $_SESSION['log']="login";
}
//==================== send mail for login id and password===========


         $to = $G_email;
         $subject = "All mart";
         
         $message = "<b>Now you are Registered User of Merabazaar. </b>";
         $message .= "<h4>Your Login ID is:".$G_email."</h4>";
         $message .= "<h4>Password is:".$pass." </h4>";
         
         
         $header = "From:allmart.world \r\n";
         $header .= "Cc:jaiswarabhishek2@gmail.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
        

//================================= OTP Code  ==================================






//==================================================



if($qrylogin && $retval){
    echo 1;
    $_SESSION['log']="Guest";
    
}else{
    echo 0;
}


} 

?>