<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');

$testid=937;

$query="select * from quiz_result where test_id=$testid";
$sql=mysql_query($query,$con);

while ($result=mysql_fetch_assoc($sql)) {

 $data[]= ['data'=>['test_id'=>$testid,'player2'=>$player2,'question_id'=>$result['questions_ids'],'topic'=>$result['topic_ids'],'sub_topic'=>$result['subtopic_ids'],'mcq' => $result['mcq'],'final_ans'=>$result['final_ans'],'options'=>$options,'ideal_time'=>$ideal_time]];
    
}

echo json_encode($data);















?>