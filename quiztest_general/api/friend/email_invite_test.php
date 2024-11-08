<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');



  $to=$_POST['friendemail']; 

  $myid=$_POST['userid'];

  
    $sql=mysqli_query($con,"select id,emailid from quiz_regdetails where emailid='".$to."'");
    $sql_result=mysqli_fetch_assoc($sql);
    $oppid=$sql_result['id'];
    
    $sqlMyData=mysqli_query($con,"select id, class, name, emailid from quiz_regdetails where id='".$myid."'");
    $sql_result_MyData=mysqli_fetch_assoc($sqlMyData);
    $MyStd=$sql_result_MyData['class'];
    $MyName = $sql_result_MyData['name'];
    
    if($sql_result){
        
        $check_sql=mysqli_query($con,"select * from quiz_friends where user_id='".$myid."' and friend_id='".$oppid."'");
        $check_sql_result=mysqli_fetch_assoc($check_sql);
        
        if($check_sql_result){
            echo json_encode('2');
        }
        else{
            $msg = '<html>
                    <body>
                        Hey,
                        <br><br>
                        Quiz2shine is a really cool app to check your learning in Math and Science in a Fun way. <br>
                        <div style="margin-left:50px;">
                            <img src="http://sarmicrosystems.in/quiztest/img/Quiz2shine.png" style="width: 250px;">
                        </div>
                        <br><br>
                        1) Play topic level quizzes mapped to school syllabus <br>
                        2) For classes 6 to 10th <br>
                        3) Play with friends, unknown players and 4 levels of AI (i.e. against computer) <br>
                        <br>
                        I am registered as a player in class '.$MyStd.'th in quiz2shine app and really love it. <br><br>
                        <a href="http://sarmicrosystems.in/quiztest_general/api/friend/friends.php?opp='.$oppid.'&&me='.$myid.'">Click here to register.</a>
                        <br><br>
                        Download Quiz2shine app from this link: google playstore (available for android currently) and register. Let the Fun
                        begin! 
                        <br><br>
                        Do share on your social media.
                    </body> 
                    </html>';
            
            $link='http://sarmicrosystems.in/quiztest_general/api/friend/friends.php?opp='.$oppid.'&&me='.$myid;
            $headers .= "Organization: Sender Organization\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            //$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= "X-Priority: 3\r\n";
            $headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
            
            if(mail($to, "Quiz2shile Invitation from ".$MyName, $msg, $headers)){
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
    $link.='<p>http://sarmicrosystems.in/quiztest/front/register.php?rg='.$myid.'</p>';
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