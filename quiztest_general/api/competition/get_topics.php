<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



$userid = $_REQUEST['userid'];
// $userid = '19';
$standard = get_student_class($userid);


if($standard > 0 && $userid > 0 ){
$sql = mysqli_query($con,"select * from competetion_registration where userid = '".$userid."' and status=1 order by id desc");
$sql_result = mysqli_fetch_assoc($sql);
$subject = $sql_result['subject'];



$user_sql = mysqli_query($con,"select * from competetion_payment where userid='".$userid."' order by id desc ");
$user_sql_result = mysqli_fetch_assoc($user_sql);
$created_at = $user_sql_result['created_at'];


$sub_sql = mysqli_query($con,"select * from subjects where id='".$subject."'");
$sub_sql_result = mysqli_fetch_assoc($sub_sql);
$subject = $sub_sql_result['subject'];


$played_quiz_sql = mysqli_query($con,"select topic,count(topic) as topic_count  from competetion_quiz where p1='".$userid."' and created_at >= CURDATE() group by topic");

$played_quiz_sql_result= mysqli_fetch_assoc($played_quiz_sql);

if($played_quiz_sql_result['topic_count']>3){
    $block_topic[] = $played_quiz_sql_result['topic'];
}else{
    $block_topic=[];
}





if($subject=='Science'){
    $json_topic = "select * from project_catT where standard='".$standard."' and is_sci=1 and UNDER=0";    
}else{
    $json_topic = "select * from project_catT where standard='".$standard."' and is_math=1  and UNDER=0";
}

$json_topic_sql = mysqli_query($con,$json_topic);

while($json_topic_sql_result = mysqli_fetch_assoc($json_topic_sql)){
    $id[] = $json_topic_sql_result['id'];
}


$id=json_encode($id);
$id=str_replace( array('[',']','"') , ''  , $id);
$arr=explode(',',$id);
$sub_ids = "'" . implode ( "', '", $arr )."'";


$topic_sql = mysqli_query($con,"select * from project_catT where standard ='".$standard."' and UNDER in ($sub_ids)");

while($topic_sql_result = mysqli_fetch_assoc($topic_sql)){
    
    $sub_topicid = $topic_sql_result['id'];
    if(!in_array(  $sub_topicid , $block_topic )){
        $data[]=['id'=>$sub_topicid,'sub'=>$topic_sql_result['name']];        
    }

}

if($data){
    echo json_encode($data);
}else{
    echo 0;
}


    
}
else{
    echo 0;
}
?>
