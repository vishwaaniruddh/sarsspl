<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


$id=$_POST['groupid'];

// $id=48;

$sql=mysqli_query($con,"SELECT distinct(groupid) as groupa,testid,standard,topic,subject from group_quiz_notification where  groupid<>'".$id."'");

// echo "SELECT distinct(groupid) as groupa,testid,standard,topic,subject from group_quiz_notification where  groupid<>'".$id."'";

// if($sql_result=mysqli_fetch_assoc($sql)){
    

while($sql_result=mysqli_fetch_assoc($sql)){
    

    
    $groupid=$sql_result['groupa'];
    $testid=$sql_result['testid'];
    $topic=$sql_result['topic'];
    $subjectid=$sql_result['subject'];
    $subject=get_topic_name($subjectid);
    $topic_name=get_topic_name($topic);
    
    
    
    $data[]=['group_id'=>$groupid,'group_name'=>group_name($groupid),'testid'=>$testid,'subid'=>$subjectid,'topicid'=>$topic,'subject'=>$subject,'topic'=>$topic_name];
    

}

echo json_encode($data);
?>