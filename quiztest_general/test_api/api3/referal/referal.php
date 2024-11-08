<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json');





$userid=$_POST['userid'];
$referal=$_POST['referal'];



$userid=165;
$referal='qwerty166';


$referal_sql=mysql_query("select * from quiz_login where referal='".$referal."'",$con);
$referal_sql_result=mysql_fetch_assoc($referal_sql);

$friend_id=$referal_sql_result['user_id'];


if($referal_sql_result){
    
    $friends_sql=mysql_query("select * from quiz_friends where user_id='".$userid."' and friend_id='".$friend_id."'",$con);
    
       $friends_sql_result=mysql_fetch_assoc($friends_sql);
       

       if(!$friends_sql_result){
            
            $sql=mysql_query("INSERT into quiz_friends(user_id,friend_id) VALUES('".$userid."','".$friend_id."')",$con);
    
            $sql_reverse=mysql_query("INSERT into quiz_friends(user_id,friend_id) VALUES('".$friend_id."','".$userid."')",$con);
            
        //   check if the user is in the referal table
           
           $check_sql=mysql_query("select * from referal_points where userid='".$friend_id."'",$con);
           $check_sql_result=mysql_fetch_assoc($check_sql);
            $points=$check_sql_result['points'];
           if(!$check_sql_result){
              
              
             $referal_point=mysql_query("INSERT INTO referal_points(userid,points) VALUES('".$friend_id."',25)",$con);  
           }
           else{


               $points=$points+25;
            
               $referal_point=mysql_query("UPDATE referal_points set points='".$points."' where userid='".$friend_id."'",$con);
           }
             

       }
         
}
else{
    echo 'not found';
}



?>