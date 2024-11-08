<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$userid=$_POST['userid'];

// $userid=115;


$sql=mysqli_query($con,"SELECT * from group_ready_notification where member='".$userid."' and is_accepted=0");

while($sql_result=mysqli_fetch_assoc($sql)){

$initiator=$sql_result['created_by'];
$groupid=$sql_result['group_id'];

$group_name=group_name($groupid);

$data[]=['groupid'=>$groupid,'created_by'=>$initiator,'group_name'=>$group_name];


    
}
if($data){
echo json_encode($data);    
}

else{
    echo json_encode('0');
}


?>