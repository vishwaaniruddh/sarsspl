<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$userid=$_POST['userid'];
$groupid=$_POST['groupid'];

// $userid=115;
// $groupid=48;


$check_sql=mysql_query("SELECT * from group_ready_notification where group_id='".$groupid."' and created_by='".$userid."'",$con);

if($check_sql_result=mysql_fetch_assoc($check_sql)){
    
    // $delete_sql=mysql_query("DELETE from group_ready_notification where group_id='".$groupid."'",$con);

    $sql=mysql_query("UPDATE group_ready_notification set is_accepted=3 where group_id='".$groupid."' and member='".$userid."'",$con);
    
}

else{
    $sql="UPDATE group_ready_notification set is_accepted=3 where group_id='".$groupid."' and member='".$userid."'";


if(mysql_query($sql,$con)){
    echo json_encode('1');
}
else{
    echo json_encode('0');
}

}


?>