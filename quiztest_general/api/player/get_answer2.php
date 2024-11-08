<?php include($_SERVER['DOCUMENT_ROOT'] . '/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// test
// $testid=7837;
// $response='b';
// $response_time=15;
// $questionid=10375;
// $userid=203;
// end

// enable for live reponses
$testid = $_POST['testid'];
$response = $_POST['ans'];
$response_time = $_POST['timetaken'];
$questionid = $_POST['qid'];
$userid = $_POST['userid'];
$standard = $_POST['std'];
// end

$sql = mysqli_query($con,"SELECT * FROM quiz_result where id='" . $testid . "'");
$get_result = mysqli_fetch_assoc($sql);

$std = $get_result['standard'];

if (empty($std)) {
    $sql = "update quiz_result set standard='" . $standard . "' where id='" . $testid . "'";
    mysqli_query($con,$sql);
}

// get questions index
$questionsString = $get_result['questions_ids'];
$questionsList = explode(",", $questionsString);
$q_key = array_search($questionid, $questionsList);

//get answers key
$aid = $get_result['answers'];
$aid_arr = explode(",", $aid);
//$a_key = array_search($response, $aid_arr);
$correct_answer = $aid_arr[$q_key];

echo "q_key: " . $q_key;
echo "<br>Count: " . count($questionsList);
// set user id
$player = $get_result['p1'];

if ($player == $userid) {
    $player1 = $player;

    $p1_responses = $get_result['p1_responses'];
    $p1_responses_arr = explode(",", $p1_responses);
    $p1ResponsesCount = 0;
    if(!empty($p1_responses)){
        $p1ResponsesCount = count($p1_responses_arr);
    }
    echo " <br> count(p1_responses_arr): ".count($p1_responses_arr)." <br> $p1ResponsesCount: ".$p1ResponsesCount;
    //checking equality withiut adding +1 to $q_key because we are checking if we got responce till previous question 
    if($p1ResponsesCount < $q_key) {
        for($i=$p1ResponsesCount; $i < $q_key; $i++){
            array_push($p1_responses_arr, '1');
        }
    }
    if(count($p1_responses_arr) == $q_key || $p1ResponsesCount == 0) {
        array_push($p1_responses_arr, $response);
        $json = json_encode($p1_responses_arr);
        $p1_response = str_replace(array('[', ']', '"'), '', $json);
        $p1_response = trim($p1_response, ",");
    
        // get correct count
        $correct_count = $get_result['p1_correct_count'];
    
        // get reponse time    
        if ($response == $correct_answer) {
            $p1_time = $get_result['p1_time_taken'];
            $updated_p1_time = $p1_time + $response_time;
            $correct_count++;
            $update_sql1 = "UPDATE quiz_result set p1_correct_count='" . $correct_count . "',p1_time_taken='" . $updated_p1_time . "' WHERE id='" . $testid . "'";
            mysqli_query($con,$update_sql1);
            // echo $update_sql1;    
            // echo $update_sql;        
        }
        $update_sql2 = "UPDATE quiz_result set p1_responses='" . $p1_response . "' WHERE id='" . $testid . "'";
        // echo $update_sql2;    
        mysqli_query($con,$update_sql2);
    }
} else {
    $player2 = $userid;

    $p2_responses = $get_result['p2_responses'];
    $p2_responses_arr = explode(",", $p2_responses);
    $p2ResponsesCount = 0;
    if(!empty($p2_responses)){
        $p2ResponsesCount = count($p2_responses_arr);
    }
    if($p2ResponsesCount < $q_key) {
        for($i=$p2ResponsesCount; $i < $q_key; $i++){
            array_push($p2_responses_arr, '1');
        }
    }
    if(count($p2_responses_arr) == $q_key || $p2ResponsesCount==0) {
        array_push($p2_responses_arr, $response);
        $json = json_encode($p2_responses_arr);
        $p2_response = str_replace(array('[', ']', '"'), '', $json);
        $p2_response = trim($p2_response, ",");
    
        // get correct count
        $correct_count = $get_result['p2_correct_count'];
    
        // get reponse time    
        if ($response == $correct_answer) {
    
            $p2_time = $get_result['p2_time_taken'];
            $updated_p2_time = $p2_time + $response_time;
            $correct_count++;
    
            $update_sql3 = "UPDATE quiz_result set  p2_correct_count='" . $correct_count . "',p2_time_taken='" . $updated_p2_time . "' WHERE id='" . $testid . "'";
            mysqli_query($con,$update_sql3);
        }
    
        $update_sql4 = "UPDATE quiz_result set p2='" . $player2 . "',p2_responses='" . $p2_response . "' WHERE id='" . $testid . "'";
        mysqli_query($con,$update_sql4);
    }
}
