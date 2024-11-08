<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json');



// enable for live reponses
$testid=$_POST['testid'];
$response=$_POST['ans'];
$response_time=$_POST['timetaken'];
$questionid=$_POST['qid'];
$userid=$_POST['userid'];
$standard=$_POST['std'];
$groupid=$_POST['groupid'];
// end

// test
// $testid=3092;
// $response='b';
// $response_time=15;
// $questionid=16835;
// $userid=85;
// $groupid=54;
// end


 mysqli_query($con,"update group_response set responses='".$response."' , timetaken='".$response_time."' where testid='".$testid."' and player='".$userid."' and groupid='".$groupid."' and question_id='".$questionid."'");

?>
