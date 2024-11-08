<?php
 session_start();
include('head.php');

$geust_id=$_SESSION['geust_id'];
$email=$_POST['email'];
$email = mysqli_real_escape_string($con1, $email);


if($email!=''){

$qrylogin=mysqli_query($con1,"select * from login where email='".$email."'");

if($qrylogin_result = mysqli_fetch_assoc($qrylogin)) {

    $sql=mysqli_query($con1,"select * from Registration where email='".$email."'");
    
    $sql_result=mysqli_fetch_assoc($sql);
    $token= $email.time();
    $token=base64_encode($token);
    $resemail=base64_encode($email);
    $update=mysqli_query($con1,"UPDATE `Registration` SET pass_token='$token' where email='".$email."'");
    $url="https://allmart.world/SetNewPassword.php?auth=".$resemail."&token=".$token;

    // mail
    $to= $email;
    $subject="Allmart : Your login id and password! ";
    $headers = "From: <noreply@allmart.world>\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $message="Your User Name is ".$email."<br/> Your Password Resetlinkis is : ".$url;

    mail($to, $subject, $message, $headers);
    ?>

<script>
       swal("Reset Link Send in your Email Successfully !","","success");    
    
    setTimeout(function(){
        window.location.href='login.php';        
    }, 3000);
</script>
<?php



}

else { 

    
?>

<script>
       swal("Email not Found!","","error");    
    
    setTimeout(function(){
        window.location.href='ForgetPassword.php';        
    }, 3000);
</script>
<?php
    // header('Location:index.php ');

    // exit();
}
}
else
{
	?>

<script>
       swal("Invalid Credentials ! Please Try Again !","","error");    
    
    setTimeout(function(){
        window.location.href='ForgetPassword.php';        
    }, 3000);
</script>
<?php

}


?>