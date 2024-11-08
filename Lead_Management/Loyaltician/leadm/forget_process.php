<?php
include('../config.php');

$email=$_POST['forgetemail'];
$EmailSubject="your password";

$sql=mysql_query($conn,"select * from login where username='".$email."'");
//echo "select * from login where username='".$email."'";
$mailheader="password recovery";

$row=mysqli_fetch_array($sql);
//echo "num".$row;
$num_row=mysqli_num_rows($sql);
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