<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$userid = $_REQUEST['userid'];
$testid = $_REQUEST['testid'];

$sql = mysqli_query($con,"select * from competetion_quiz_result where testid ='".$testid."' and player_id='".$userid."' order by id asc");

$counter = 1 ; 
while($sql_result = mysqli_fetch_assoc($sql)){
    
    
    $question_id = $sql_result['question_id'];
    $question = question_string($question_id);
    $answer = $sql_result['answer'];
    $given_answer = $sql_result['player_answer'];
    $time_taken = $sql_result['time_take'];
    
    
    
    $data[] = ['srno'=>$counter , 'question'=>$question , 'correct_ans'=>$answer ,'given_ans' =>$given_answer , 'time_taken'=>$time_taken];
    $counter++;
}

if($data){
    echo json_encode($data);
}
else{
    echo 0;
}
