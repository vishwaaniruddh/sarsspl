<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$userid=$_POST['userid'];

// $userid=88;

$sql=mysqli_query($con,"SELECT * from quiz_login where user_id='".$userid."'");

$sql_result=mysqli_fetch_assoc($sql);

$code=$sql_result['username'];

echo json_encode($code);


?>