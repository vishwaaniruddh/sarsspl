<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$groupid=$_POST['groupid'];

$groupid=48;

$sql=mysqli_query($con,"SELECT distinct(testid) as test,groupid,player,standard,topic,subject,is_accepted from group_quiz_notification where groupid<>'".$groupid."'");


while($sql_result=mysqli_fetch_assoc($sql)){
    
    
    echo $groupid=$sql_result['groupid'];
    
}




?>

