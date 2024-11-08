<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');



  $to=$_POST['friendemail']; 

  $myid=$_POST['userid'];

  
  $sql=mysql_query("select emailid from quiz_regdetails where emailid='".$to."'",$con);
  

  $sql_result=mysql_fetch_assoc($sql);
    
    if($sql_result){
        
        $check_sql=mysql_query("select * from quiz_friends where user_id='".$myid."' and friend_id='".$oppid."'",$con);
        $check_sql_result=mysql_fetch_assoc($check_sql);
        
        if($check_sql_result){
            echo 'The person is already in you friend list';
        }
        else{
            $link='https://www.sarmicrosystems.in/quiztest_general/api/friend/friends.php?opp='.$oppid.'&&me='.$myid;
            $headers .= "Organization: Sender Organization\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
            $headers .= "X-Priority: 3\r\n";
            $headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
            
            if(mail($to, "Message", $link, $headers)){
                echo 'Email sent successfully ...';
            }
            else{
                echo 'Error in sending email !';
            }


        }
        

    }
    else{
        
        

            $link="https://www.sarmicrosystems.in/quiztest/front/register.php?rg='".$myid."'";
            $headers .= "Organization: Sender Organization\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
            $headers .= "X-Priority: 3\r\n";
            $headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
            
            if(mail($to, "Message", $link, $headers)){
                echo 'Email sent successfully ...';
            }
            else{
                echo 'Error in sending email !';
            }
            

    }


?>