<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


$testid = $_REQUEST['testid'];
$userid = $_REQUEST['userid'];
$question_id =$_REQUEST['question_id'];
$player_answer = $_REQUEST['player_answer'];
$time = $_REQUEST['time'];


if(isset($testid) && isset($userid) && isset($question_id) && isset($player_answer) && isset($time)){

            $check_sql = mysqli_query($con,"select * from competetion_quiz where id='".$testid."'");
            $check_sql_result = mysqli_fetch_assoc($check_sql);
            
            $player1 = $check_sql_result['p1'];
            
            if($userid == $player1){
                $count_column = 'p1_correct_count';
                $player = 'p1';
            }else{
                $count_column = 'p2_correct_count';
                $player = 'p2';
            }
            
            
            
                $ans_sql = mysqli_query($con,"select * from competetion_quiz_result where testid='".$testid."' and question_id = '".$question_id."'"  );
                $ans_sql_result = mysqli_fetch_assoc($ans_sql);
                
                $answer = $ans_sql_result['answer'];
                
                if($answer==$player_answer){
                    $update =1;
                }
                else{
                    $update = 0 ;
                }
                
                $get_ans = mysqli_query($con,"select * from competetion_quiz where id='".$testid."' and $player ='".$userid."'");
                $get_ans_result = mysqli_fetch_assoc($get_ans);
                
                $correct_count = $get_ans_result[$count_column];
                
                $correct_count = $correct_count+$update ; 
                
                $statement = "update competetion_quiz set $count_column = '".$correct_count."' where id='".$testid."'" ; 
                
                
                        if(mysqli_query($con,$statement)){
                            echo 1;
                        }
                        else{
                            echo 0;
                        }
                        
            
}
else{
    echo 0;
}

