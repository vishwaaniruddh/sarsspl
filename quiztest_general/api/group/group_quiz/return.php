<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$userid=$_POST['userid'];
$groupid=$_POST['groupid'];

// $userid=115;
// $groupid=48;


$check_sql=mysqli_query($con,"SELECT * from group_ready_notification where group_id='".$groupid."' and created_by='".$userid."'");

if($check_sql_result=mysqli_fetch_assoc($check_sql)){
    
    // $delete_sql=mysqli_query($con,"DELETE from group_ready_notification where group_id='".$groupid."'");

    $sql=mysqli_query($con,"UPDATE group_ready_notification set is_accepted=3 where group_id='".$groupid."' and member='".$userid."'");
    
}

else{
    $sql="UPDATE group_ready_notification set is_accepted=3 where group_id='".$groupid."' and member='".$userid."'";


if(mysqli_query($con,$sql)){
    echo json_encode('1');
}
else{
    echo json_encode('0');
}

}


?>