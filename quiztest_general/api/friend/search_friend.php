<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// $searchText='sat';
$searchText=$_POST['name'];
$userid=$_POST['userid'];
$myClass=$_POST["class"];


$class=get_student_class($userid);

$sql=mysqli_query($con,"SELECT CONCAT(name,' ',lname) as full_name,class,avatar_id,school,id FROM quiz_regdetails where (emailid like '".$searchText."%' or mobile like '".$searchText."') and id !='".$userid."'");

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
}
   

$get_sql=mysqli_query($con,"SELECT * from quiz_login where username like '".$searchText."%' ");
$get_sql_result=mysqli_fetch_assoc($get_sql);

$userid=$get_sql_result['user_id'];

$sql2=mysqli_query($con,"SELECT CONCAT(name,' ',lname) as full_name,class,avatar_id,school,id FROM quiz_regdetails where id='".$userid."' and class='".$class."'");

while($sql_result=mysqli_fetch_assoc($sql)){
    
    $id=$sql_result['id'];
    $full_name=$sql_result['full_name'];
    $class=$sql_result['class'];
    $school=$sql_result['school'];
    $avatar=get_avatar($id);

    //$data[]=['data'=>['id'=>$id,'name'=>$full_name,'class'=>$class,'avatar'=>$avatar,'school'=>$school]];
}
    //echo json_encode($data); 

?>