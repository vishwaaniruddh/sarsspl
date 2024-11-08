<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');



$userid=$_POST['userid'];
// $userid=88;

$sql=mysql_query("SELECT * from quiz_result where p1='".$userid."' ORDER by id DESC LIMIT 10",$con);


while ($sql_result=mysql_fetch_assoc($sql)) {
    
    $p2=$sql_result['p2'];
    $topic=$sql_result['topic_ids'];
    
    $sqla=mysql_query("SELECT * from quiztest where topic='".$topic."'",$con);
    $sql_resulta=mysql_fetch_assoc($sqla);
    
    $subjectid=$sql_resulta['subject'];
    
    $get_sub=mysql_query("SELECT * from project_catT where id='".$subjectid."'",$con);
    $get_sub_result=mysql_fetch_assoc($get_sub);
    
    $subject=$get_sub_result['name'];
    
    $p1_correct_count=$sql_result['p1_correct_count'];
    $p2_correct_count=$sql_result['p2_correct_count'];
    $player_won=$sql_result['player_won'];
    $date=$sql_result['created_at'];



$timestamp = strtotime($sql_result['created_at']);
$date = date('d-M-Y', $timestamp);
// $time = date('Gi.s', $timestamp);


    $data[]=['data'=>['p2'=>$p2,'p1_correct_count'=>$p1_correct_count,'subject'=>$subject,'p2_correct_count'=>$p2_correct_count,'player_won'=>$player_won,'date'=>$date]];
    
}


echo json_encode($data);
?>