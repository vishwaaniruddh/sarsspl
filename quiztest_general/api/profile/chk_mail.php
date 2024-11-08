<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


$email=$_POST['email'];
/*
$subject="Quiz2shine Reset password";
            
            $headers .= "Organization: Sender Organization\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= "X-Priority: 3\r\n";
            $headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
            
            $message="<h3>Your password is </h3>".$string;
            
            $message='<html>
                    <body>
                        Hello '.$name.',
                        <br><br>
                        <span style="font-size: large;"><b>Your OTP is '.$string.'.</b></span><br>
                        Please use this otp to complete your registration on Quz2shine, the fun filled study app.
                        <br><br>
                        OTP is valid only for 30 mins.
                        <br><br>
                        thanks
                        <br><br>
                        The Quz2shine team
                        <br><br>
                        This is an automated email. Please do not reply.
                        In case you wish to get in touch with us, please email us at contactus@quiz2shine.com
                    </body>
                    </html>';
            if(mail($email, $subject, $message, $headers)){
                echo json_encode('1');
            }
            else{
                echo json_encode('0');
            }  */
            
    //$sender = 'someone@somedomain.tld';
$sender = 'info@sarmicrosystems.in';
$recipient = $email;
$subject = "php mail test";
$message = "php test message";
$headers = 'From:' . $sender;

if (mail($recipient, $subject, $message, $headers))
{
    echo "Message accepted";
}
else
{
    echo "Error: Message not accepted";
}        