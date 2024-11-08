<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');



$player=$_POST['userid'];



$sql=mysqli_query($con,"select * from group_quiz_notification WHERE player='".$player."'  and is_accepted=0 and created_by=0");

$sql_result=mysqli_fetch_assoc($sql);
    
    echo "select * from group_quiz_notification WHERE player='".$player."'  and is_accepted=0 and created_by=0";

// $player1=$sql_result['player'];
// $topic=$sql_result['topic'];
// $subject=$sql_result['subject'];
// $testid=$sql_result['testid'];

// $player1=$sql_result['player2'];

// get player1 name    

// DELETE OLD GROUP QUIZ NOTIFICATIONS

// var_dump($sql_result);
$delete_interval=mysqli_query($con,"DELETE FROM group_quiz_notification WHERE created_at < (NOW() - INTERVAL 60 SECOND)");





$name_sql=mysqli_query($con,"select * from quiz_regdetails WHERE id='".$player1."'");



$player1_name=get_name($player1,TRUE);
// $player1_name=$name_sql_result['name'].' '.$name_sql_result['lname'];



//end

// get subject Name with Topic ID
    $get_sub_query=mysqli_query($con,"SELECT * from quiztest where topic='".$topic."'");
    $get_sub_query_result=mysqli_fetch_assoc($get_sub_query);
    
    $subid=$get_sub_query_result['subject'];

    
    $get_subject=mysqli_query($con,"SELECT * from project_catT where id='".$subid."'");
    $get_sub_result=mysqli_fetch_assoc($get_subject);

    $subject=$get_sub_result['name'];
    
    
    //get topic Name
    
    $get_topic=mysqli_query($con,"SELECT * from project_catT where id='".$topic."'");
    $get_topic_result=mysqli_fetch_assoc($get_topic);
    
    
    $topic=$get_topic_result['name'];
    

    
   
$data[]=['player1'=>$player1,'player1_name'=>$player1_name,'testid'=>$testid,'topic'=>$topic,'subject'=>$subject,'notification'=>'Group Quize'];   


// $data[]=['id'=>$id,'player1'=>$player1,'player1_name'=>$player1_name,'testid'=>$testid,'standard'=>$standard,'topic'=>$topic,'subject'=>$subject,'notification'=>'Like Minded'];        
 

 
echo json_encode($data);



?>