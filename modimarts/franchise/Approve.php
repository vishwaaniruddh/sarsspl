<?php
session_start(); //Start the session
include ("config.php");
$id=$_POST['id'];
$pass=rand(1000,10000);
$data=array();
if(isset($_GET['id'])){
    $id=$_GET['id'];
}
$sql2="select email,name from member where id='".$id."'";
$runsql2=mysqli_query($conn,$sql2);
$fetchemail=mysqli_fetch_array($runsql2);
$numrow=mysqli_num_rows($runsql2);
if($numrow >0){
$sql="update member set status='1' where id='".$id."'";
$runsql=mysqli_query($conn,$sql);

//===========for mail===============

$EmailSubject="Your Registration And Approval done Please login";

$MESSAGE_BODY="";
    
   // $MESSAGE_BODY.="your username is: ".$email."\r\n";
    
    //$MESSAGE_BODY.="your password is: ".$fetchHotelusers['password']."\r\n";
      
     $message="Dear ".$fetchemail[1]." You have been successfully registered and approved please login with following link"."\r\n";
           $message.="user_id: $fetchemail[0]"."\r\n";
           $message.="Password: $pass"."\r\n";
            $message.="http://sarmicrosystems.in/temple/index.php";
        $leadsmail="ram@sarmicrosystems.in', 'Mailer";
        $mailheader = "From: ".$leadsmail."\r\n"; 
    $mailheader .= "Reply-To: ".$leadsmail."\r\n"; 
 
//require 'phpmail/src/Exception.php';
require 'phpmail/src/PHPMailer.php';
require 'phpmail/src/SMTP.php';

$mail = new PHPMailer\PHPMailer\PHPMailer();

    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'sarmicrosystems.in';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'ram@sarmicrosystems.in';                 // SMTP username
    $mail->Password = 'ram1234*';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('ram@sarmicrosystems.in', 'Temple login');
    $mail->addAddress($fetchemail[0]); 
    $mail->mailheader=$mailheader;// Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('ramshankargupta444@gmail.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(false);                                  // Set email format to HTML
    $mail->Subject = $EmailSubject."\r\n";
    $mail->Body    = $message."\r\n".$MESSAGE_BODY;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    //$mail->AltBody=$MESSAGE_BODY;
    $mail->send();
//==============mail end===
 
$login="insert into Users(UserName,Password,reg_id) values('".$fetchemail[0]."','".$pass."','".$id."')";
$runlogin=mysqli_query($conn,$login);

if($runlogin){
    echo '1';
}else{
    echo '2';
}

}else{
    echo "error";
}
// echo json_encode($data);  
?>