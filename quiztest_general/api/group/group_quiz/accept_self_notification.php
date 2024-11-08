<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$userid=$_POST['userid'];
$groupid=$_POST['groupid'];

// $userid=115;
// $groupid=48;

$sql="UPDATE group_ready_notification set is_accepted=1 where group_id='".$groupid."' and member='".$userid."'";


if(mysqli_query($con,$sql)){
    echo json_encode('1');
}
else{
    echo json_encode('0');
}


?>