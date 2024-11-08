<?php
 session_start();
include('head.php');

error_reporting(E_ALL);
ini_set('display_errors', '1');

// $geust_id=$_SESSION['geust_id'];
$contact_name=$_POST['contact_name'];
$contact_name = mysqli_real_escape_string($con1, $contact_name);

$contact_email=$_POST['contact_email'];
$contact_email = mysqli_real_escape_string($con1, $contact_email);

$contact_subject=$_POST['contact_subject'];
$contact_subject = mysqli_real_escape_string($con1, $contact_subject);

$contact_body=$_POST['contact_body'];
$contact_body = mysqli_real_escape_string($con1, $contact_body);


if(isset($contact_email) && isset($contact_name) && isset($contact_subject) && isset($contact_body)){

    $sql="INSERT INTO `Contactus_mail`(`name`, `email`, `subject`, `message`) VALUES ('".$contact_name."','".$contact_email."','".$contact_subject."','".$contact_body."')";
    $inst=mysqli_query($con1,$sql);


    $body="Hello Allmart.world,\r\n My Name is ".$contact_name.",\r\n  My Email id ".$contact_email.",\r\n Subject -".$contact_subject.",\r\n My Message Is :".$contact_body;

    // mail
    // $to= 'noreply@allmart.world';
    $to= 'work.rjkashyap05@gmail.com';

    $subject="Allmart : Mail Send By Contact-Us :- ".$contact_subject;
    $headers = "From: <".$contact_email.">\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $message="Mail Send By Contact-Us \r\n".$body;

   $send= mail($to, $subject, $message, $headers);
   if($send)
   {
     ?>

<script>
       swal("Mail Send Successfully !","","success");    
    
    setTimeout(function(){
       window.location.href='contact_us.php';        
    }, 3000);
</script>
<?php


   }
else
{
    ?>

<script>
       swal("Mail Not Send!","","error");    
    
    setTimeout(function(){
        window.location.href='contact_us.php';        
    }, 3000);
</script>
<?php

}
   


}

else { 

    
?>

<script>
       swal("invalid detail!","","error");    
    
    setTimeout(function(){
        window.location.href='contact_us.php';        
    }, 3000);
</script>
<?php
    // header('Location:index.php ');

    // exit();
}



?>