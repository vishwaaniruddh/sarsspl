<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// $name='sat';
$name=$_POST['name'];
$userid=$_POST['userid'];


$class=get_student_class($userid);

$sql=mysql_query("SELECT CONCAT(name,' ',lname) as full_name,class,avatar_id,school,id FROM quiz_regdetails where emailid like '".$name."%' and class='".$class."'",$con);

while($sql_result=mysql_fetch_assoc($sql)){
    
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
   

$get_sql=mysql_query("SELECT * from quiz_login where username like '".$name."%' ",$con);
$get_sql_result=mysql_fetch_assoc($get_sql);

$userid=$get_sql_result['user_id'];

$sql2=mysql_query("SELECT CONCAT(name,' ',lname) as full_name,class,avatar_id,school,id FROM quiz_regdetails where id='".$userid."' and class='".$class."'",$con);

while($sql_result=mysql_fetch_assoc($sql)){
    
    $id=$sql_result['id'];
    $full_name=$sql_result['full_name'];
    $class=$sql_result['class'];
    $school=$sql_result['school'];
    $avatar=get_avatar($id);

    $data[]=['data'=>['id'=>$id,'name'=>$full_name,'class'=>$class,'avatar'=>$avatar,'school'=>$school]];
}
    echo json_encode($data); 



?>