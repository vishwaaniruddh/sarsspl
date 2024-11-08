<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// $name='sat';
$name=$_POST['name'];

$sql=mysql_query("SELECT CONCAT(name,' ',lname) as full_name,class,avatar_id,school,id FROM quiz_regdetails where name like '".$name."%'",$con);

while($sql_result=mysql_fetch_assoc($sql)){
    
    $full_name=$sql_result['full_name'];
    $class=$sql_result['class'];
    $avatar_id=$sql_result['id'];

    $avatar=get_avatar($avatar_id);

    $data[]=['data'=>['name'=>$full_name,'class'=>$class,'avatar'=>$avatar]];
}
    echo json_encode($data); 



?>