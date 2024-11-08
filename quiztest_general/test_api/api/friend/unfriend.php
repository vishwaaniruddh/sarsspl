<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$userid=$_POST['userid'];
$friendid=$_POST['friendid'];

// $userid=88;
// $friendid=97;

$delete1="DELETE from quiz_friends where user_id='".$userid."' and friend_id='".$friendid."'";
$delete2="DELETE from quiz_friends where user_id='".$friendid."' and friend_id='".$userid."'";

if(mysql_query($delete1,$con) && mysql_query($delete2,$con)){
    
    echo json_encode('1');
    
}
else{
    echo json_encode('0');
}


?>