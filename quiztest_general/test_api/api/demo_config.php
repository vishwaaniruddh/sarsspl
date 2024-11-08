<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');



  $to=$_POST['friendemail']; 
$to='lanwan151@gmail.com';

  $myid=$_POST['userid'];
$myid=179;
  
  $sql=mysql_query("select id,emailid from quiz_regdetails where emailid='".$to."'",$con);
  

  $sql_result=mysql_fetch_assoc($sql);
    
    $oppid=$sql_result['id'];

    if($sql_result){
        
        $check_sql=mysql_query("select * from quiz_friends where user_id='".$myid."' and friend_id='".$oppid."'",$con);
        $check_sql_result=mysql_fetch_assoc($check_sql);
        
        if($check_sql_result){
            echo json_encode('2');
        }
        else{
            $link='https://www.sarmicrosystems.in/quiztest_general/api/friend/friends.php?opp='.$oppid.'&&me='.$myid;
            $headers .= "Organization: Sender Organization\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
            $headers .= "X-Priority: 3\r\n";
            $headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
            
            if(mail($to, "Message", $link, $headers)){
                echo json_encode('1');
            }
            else{
                echo json_encode('0');
            }


        }
        

    }
    else{
        
        
    $link= '<html><body>';
    $link .= '<h3>Hey ! This is '.get_name($myid,TRUE).'!  I am playing quiz throgh this App, and having so much fun :D</h3> ';
    $link.='<p>https://www.sarmicrosystems.in/quiztest/front/register.php?rg='.$myid.'</p>';
    $link.='<h4>Click the above link to register and install application ! Lets Compete !!</h4>';
    $link .= '</body></html>';
             
            $headers .= "Organization: Sender Organization\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            // $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= "X-Priority: 3\r\n";
            $headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
            
            if(mail($to, "Message", $link, $headers)){
                   echo json_encode(1);
            }
            else{
                   echo json_encode(0);
            }
            

    }


?>