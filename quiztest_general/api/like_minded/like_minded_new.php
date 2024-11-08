<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
      include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$player1=$_POST['player1'];
$standard=$_POST['stdid'];
$topic=$_POST['topicid'];

$subjectid=$_POST['subid'];

$insert_sql_result="INSERT INTO quiz_result(p1,subject) VALUES('".$player1."','".$subjectid."')";


if (mysqli_query($con,$insert_sql_result) === TRUE) {

    $testid = mysqli_insert_id($con);

}


        $_id = rand(701, 988);
      
        $player2_name=ai_player_name($_id);


$insert_sql=mysqli_query($con,"INSERT INTO like_minded(player1,testid,player2,is_accepted,standard,topic) VALUES('".$player1."','".$testid."','".$_id."',0,'".$standard."','".$topic."')");
        



$data=['testid'=>$testid];

    echo json_encode($data);

?>