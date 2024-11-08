<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// $searchText='sat';
$userid=$_POST['userid'];


$class=get_student_class($userid);

$sql=mysqli_query($con,"SELECT CONCAT(name,' ',lname) as full_name,class,avatar_id,school,id FROM quiz_regdetails where id in ( SELECT `p1_id` FROM `friend_request` WHERE `p2_id` = '".$userid."')");

while($sql_result=mysqli_fetch_assoc($sql)){
    
    $full_name=$sql_result['full_name'];
    $class=$sql_result['class'];
    $id=$sql_result['id'];
    $school=$sql_result['school'];
    $avatar=get_avatar($id);

    $data[]=['data'=>['id'=>$id,'name'=>$full_name,'class'=>$class,'avatar'=>$avatar,'school'=>$school]];
}

if($data){
    echo json_encode($data);  
    return;
} else {
    echo json_encode("[]");
}

?>