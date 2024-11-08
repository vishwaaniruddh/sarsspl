<?php
include 'config.php';
$email=$_POST['forgetemail'];
$EmailSubject="your password";

$sql="select * from login where email='".$email."'";
$mailheader="password recovery";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
$num_row=mysqli_num_rows($result);
$MESSAGE_BODY="";
    
    
    
    $MESSAGE_BODY.='your password is: ';
      
        $MESSAGE_BODY.=$row["password"];
        
        $mailheader = "From: ".$email."\r\n"; 
    $mailheader .= "Reply-To: ".$email."\r\n"; 
if($num_row >0){
    
    mail($email, $EmailSubject,  $MESSAGE_BODY,$mailheader) or die ("Failure");
    echo "1";
}



?>