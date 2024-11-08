<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


$userid=$_POST['userid'];

$username=get_username($userid);
// $userid=88;

$sql=mysql_query("select * from quiz_regdetails where id='".$userid."'",$con);

$get_result=mysql_fetch_assoc($sql);

$fname=$get_result['name'];
$lname=$get_result['lname'];
$email=$get_result['emailid'];
$school=$get_result['school'];
$class=$get_result['class'];
$avatar=$get_result['avatar_id'];


// get avatar image url
$avatar_sql=mysql_query("select * from avatar where id='".$avatar."'",$con);
$avatar_get_result=mysql_fetch_assoc($avatar_sql);

$avatar=$avatar_get_result['avatar_url'];

// end



$data=['data'=>['username'=>$username,'fname'=>$fname,'lname'=>$lname,'email'=>$email,'school'=>$school,'class'=>$class,'avatar'=>$avatar]];

echo json_encode($data);





?>