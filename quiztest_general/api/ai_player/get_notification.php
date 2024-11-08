<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');



$userid=$_POST['player2'];
// $userid=166;

$sql=mysqli_query($con,"select * from ai_notification where userid='".$userid."' and is_accepted=0");


$sql_result=mysqli_fetch_assoc($sql);

if($sql_result){
$id=$sql_result['id'];
$ai_id=$sql_result['ai_id'];
$subid=$sql_result['subject'];
$topic=$sql_result['topic'];

$ai_player_name = ai_player_name($ai_id);

$sub_name=get_topic_name($subid);
$topic_name=get_topic_name($topic);

$data=['id'=>$id,'player1'=>$ai_id,'player1_name'=>$ai_player_name, 'subject'=>$sub_name,'topic'=>$topic_name,'notification'=>'AI Notification'];



echo json_encode($data);

    
}


?>