<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// error_reporting(0);

$std=$_POST['std'];
// $std=8;



$ai_sql=mysql_query("select * from ai_players where standard='".$std."' and is_busy=0 ORDER BY RAND() LIMIT 1;",$con);

$ai_sql_result=mysql_fetch_assoc($ai_sql);

$ai_id=$ai_sql_result['id'];


$all_subjects = get_subject($std);

$all_subjects=json_decode($all_subjects);
shuffle($all_subjects);

$subid= $all_subjects[0];   // here is the subject id

$all_topics = get_all_topics($subid);
$all_topics=json_decode($all_topics);
shuffle($all_topics);

$topicid= $all_topics[0];   // here is the topic id   




    $sql=mysql_query("select * from online where status=1",$con);

    while($sql_result=mysql_fetch_assoc($sql)){
        
         $userid = $sql_result['userid'];
         
         $insert_sql="insert into ai_notification(userid,ai_id,standard,subject,topic) VALUES('".$userid."','".$ai_id."','".$std."','".$subid."','".$topicid."')";
         
         if(mysql_query($insert_sql,$con)){
             echo 1;
         }
         else{
             echo 0;
         }
         
        
    }
    


?>