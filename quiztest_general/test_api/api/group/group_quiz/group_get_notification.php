<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');



$player=$_POST['userid'];



$sql=mysql_query("select * from group_quiz_notification WHERE player='".$player."'  and is_accepted=0 and created_by=0",$con);

$sql_result=mysql_fetch_assoc($sql);
    
    echo "select * from group_quiz_notification WHERE player='".$player."'  and is_accepted=0 and created_by=0";

// $player1=$sql_result['player'];
// $topic=$sql_result['topic'];
// $subject=$sql_result['subject'];
// $testid=$sql_result['testid'];

// $player1=$sql_result['player2'];

// get player1 name    

// DELETE OLD GROUP QUIZ NOTIFICATIONS

// var_dump($sql_result);
$delete_interval=mysql_query("DELETE FROM group_quiz_notification WHERE created_at < (NOW() - INTERVAL 60 SECOND)",$con);





$name_sql=mysql_query("select * from quiz_regdetails WHERE id='".$player1."'",$con);



$player1_name=get_name($player1,TRUE);
// $player1_name=$name_sql_result['name'].' '.$name_sql_result['lname'];



//end

// get subject Name with Topic ID
    $get_sub_query=mysql_query("SELECT * from quiztest where topic='".$topic."'",$con);
    $get_sub_query_result=mysql_fetch_assoc($get_sub_query);
    
    $subid=$get_sub_query_result['subject'];

    
    $get_subject=mysql_query("SELECT * from project_catT where id='".$subid."'",$con);
    $get_sub_result=mysql_fetch_assoc($get_subject);

    $subject=$get_sub_result['name'];
    
    
    //get topic Name
    
    $get_topic=mysql_query("SELECT * from project_catT where id='".$topic."'",$con);
    $get_topic_result=mysql_fetch_assoc($get_topic);
    
    
    $topic=$get_topic_result['name'];
    

    
   
$data[]=['player1'=>$player1,'player1_name'=>$player1_name,'testid'=>$testid,'topic'=>$topic,'subject'=>$subject,'notification'=>'Group Quize'];   


// $data[]=['id'=>$id,'player1'=>$player1,'player1_name'=>$player1_name,'testid'=>$testid,'standard'=>$standard,'topic'=>$topic,'subject'=>$subject,'notification'=>'Like Minded'];        
 

 
echo json_encode($data);



?>