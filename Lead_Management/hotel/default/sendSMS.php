<?php
$mob=$mob1;
//$mob=8169072260;
//$mob=9323654529;

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.msg91.com/api/v2/sendsms?country=91",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
//  CURLOPT_POSTFIELDS => "{ \"sender\": \"SOCKET\", \"route\": \"4\", \"country\": \"91\", \"sms\": [ { \"message\": \"Message1\", \"to\": [ \"9987856464\", \"9967447233\" ] }, { \"message\": \"Message2\", \"to\": [ \"9987856464\", \"9967447233\" ] } ] }",
    CURLOPT_POSTFIELDS => "{ \"sender\": \"Orchid\", \"route\": \"4\", \"country\": \"91\", \"sms\": [ { \"message\": \"Thank you for your visit to The Orchid Hotel Pune, hope you had a nice experience with us. Please click here to review your visit. The link is https://www.zomato.com/pune/boulevard-the-orchid-hotel-balewadi/reviews\", \"to\": [ \"$mob\" ] } ] }",
  
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_HTTPHEADER => array(
    "authkey:265031A9Tcwgh5PSl5c76512f ",
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  //echo "cURL Error #:" . $err;
} else {
  //echo $response;
}




///=================== send zomato link=====================
  
    
$EmailSubject9="Zomato Link!";

   $MESSAGE_BODY9="";
     
        $message9="Thank you for your visit to The Orchid Hotel Pune, hope you had a nice experience with us. Please click here to review your visit. <br> 'The link is https://www.zomato.com/pune/boulevard-the-orchid-hotel-balewadi/reviews\'.";
        
        
         
            
        $leadsmail9="Orchidmembership@loyaltician.com";
        $mailheader9 = "From: ".$leadsmail9."\r\n"; 
    $mailheader9 .= "Reply-To: ".$leadsmail9."\r\n"; 
 
require 'phpmail/src/PHPMailer.php';
require 'phpmail/src/SMTP.php';

$mail9 = new PHPMailer\PHPMailer\PHPMailer();

    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail9->isSMTP();                                      // Set mailer to use SMTP
    $mail9->Host = 'sarmicrosystems.in';  // Specify main and backup SMTP servers
    $mail9->SMTPAuth = true;                               // Enable SMTP authentication
    $mail9->Username = 'ram@sarmicrosystems.in';                 // SMTP username
    $mail9->Password = 'ram1234*';                           // SMTP password
    $mail9->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail9->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail9->setFrom('leads@loyaltician.com','loyaltician');
    $mail9->addAddress($Gmail); 
    $mail9->mailheader=$mailheader1;// Add a recipient
  //  $mail->addCC('leads@loyaltician.com');
    $mail9->addBCC('kvaljani@gmail.com ');
     $mail9->addCC('meanand.gupta21@gmail.com');
    
    
    $mail9->isHTML(true);                                  // Set email format to HTML
    $mail9->Subject = $EmailSubject9."\r\n";
    $mail9->Body    = $message9."\r\n".$MESSAGE_BODY9;
    $mail9->send();
//==============mail end===

  
 

////////////////////////////////////////////////////////////
?>