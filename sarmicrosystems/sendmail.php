<?php
//get data from form  
$name = $_POST['username'];
$email= $_POST['email'];
$phone= $_POST['phone'];
$message= $_POST['message'];
$to = "work.rajeshb@gmail.com";
$subject = "Mail From website";
$txt ="Name = ". $name . "\r\n  Email = " . $email . "\r\n Message =" . $message . "\r\n  Contact = " . $phone ;
$headers = "From: $email" . "\r\n" ;
if($email!=NULL){
    mail($to,$subject,$txt,$headers);
}
//redirect
header("Location:contact.php?message=Successfull");
?>