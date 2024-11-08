<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// $userid=85;
$userid=$_POST['userid'];

$sql=mysql_query("SELECT * from quiz_friends where user_id='".$userid."'",$con);

while($sql_result=mysql_fetch_assoc($sql)){
    
    $friend_id=$sql_result['friend_id'];
    $friend_name = get_name($friend_id,TRUE);
    
    
    $friend_sql=mysql_query("SELECT * from quiz_regdetails where id='".$friend_id."'",$con);
    
    $friend_sql_result=mysql_fetch_assoc($friend_sql);
    
    $std=$friend_sql_result['class'];
    $school=$friend_sql_result['school'];
    
    $avatar=get_avatar($friend_id);
    
    
    
    $data[]=['data'=>['friend_id'=>$friend_id,'name'=>$friend_name,'class'=>$std,'school'=>$school,'avatar'=>$avatar]];
}

echo json_encode($data);




?>