<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


$email=$_POST['email'];

$sql=mysql_query("select * from quiz_regdetails where emailid='".$email."'");
$sql_result=mysql_fetch_assoc($sql);

if($sql_result>0)
{

   $string=random_string(8);
   $email = strip_tags($email);
   $update_password="update quiz_login set pass='".$string ."' where user_id='".$sql_result['id']."' ";
   
   
   if(mysql_query($update_password,$con)){
    
            $subject="Your new password";
            
            $headers .= "Organization: Sender Organization\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= "X-Priority: 3\r\n";
            $headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
            
            
			$message="<h3>Your password is </h3>".$string;

            if(mail($email, $subject, $message, $headers)){
                echo json_encode('1');
            }
            else{
                echo json_encode('0');
            }


        }
}

else{
    echo json_encode('0');
}


?>