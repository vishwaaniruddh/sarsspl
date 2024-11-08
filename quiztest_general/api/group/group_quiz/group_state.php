<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


$groupid=$_POST['groupid'];

// $groupid=48;

$sql=mysqli_query($con,"SELECT sum(is_accepted) as state FROM group_ready_notification where group_id='".$groupid."' and is_accepted=1 ");

if($sql_result=mysqli_fetch_assoc($sql)){
$state=$sql_result['state'];

if($state>1){
    echo json_encode('1');
}

else{
    echo json_encode('0');
}    
}

else{
    echo json_encode('0');
}




?>