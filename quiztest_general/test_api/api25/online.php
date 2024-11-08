<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// $userid=88;
$userid=$_POST['userid'];
$status=$_POST['status'];



if($status==1){
    $sql="update quiz_login set is_online=1 where user_id='".$userid."'";
    mysql_query($sql,$con);    
}
if($status==2){
    $sql="update quiz_login set is_online=0 where user_id='".$userid."'";
    mysql_query($sql,$con); 
}

?>