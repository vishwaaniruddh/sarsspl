<?php include($_SERVER['DOCUMENT_ROOT'].'/Lead_Management/Loyaltician/application/config.php');

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

error_reporting(0);


$email=$_REQUEST['email'];

// $email='yadavishalyadav629@gmail.com';

$sql=mysqli_query($conn,"select * from signUpBarcodUserDets where email='".$email."'");
$sql_result=mysqli_fetch_assoc($sql);

if($sql_result>0) {
    
   $string=$sql_result['password'];
   $email = strip_tags($email);
    
            $subject="Your new password";
            
            $headers .= "Organization: Sender Organization\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= "X-Priority: 3\r\n";
            $headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
            
			$message="<h3>Your password is </h3>".$string;

            if(mail($email, $subject, $message, $headers)){
                echo "1";
            }
            else{
                echo "0";
            }

}
?>