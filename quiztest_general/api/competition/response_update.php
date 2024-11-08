<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


$player = $_REQUEST['player'];
$testid = $_REQUEST['testid'];
$question_id =$_REQUEST['question_id'];
$player_answer = $_REQUEST['player_answer'];
$time = $_REQUEST['time'];


// //test response
// $player = 26;
// $testid = 37;
// $question_id = 14142;
// $player_answer = 'a';
// $time = 20;




if(isset($player) && isset($testid) && isset($question_id) && isset($player_answer) && isset($time)){
    
     $sql = "update competetion_quiz_result set player_answer ='".$player_answer."' , time_take = '".$time."' where testid='".$testid."' and player_id ='".$player."' and question_id ='".$question_id."'" ; 
    
    


    if(mysqli_query($con,$sql)){
        
        echo 1;
    }
    else{
        echo 0;
    }
    
}else{
    echo 0;
}

