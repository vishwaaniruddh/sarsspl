<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


$userid=$_POST['userid'];


$sql=mysql_query("SELECT friend_id from quiz_friends where user_id='".$userid."'");
    
    while($sql_result=mysql_fetch_assoc($sql)){
        $friend_id[]=$sql_result['friend_id'];
    }

echo json_encode($friend_id);
?>