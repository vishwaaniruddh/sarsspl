<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$groupid=$_POST['groupid'];

$groupid=48;

$sql=mysql_query("SELECT distinct(testid) as test,groupid,player,standard,topic,subject,is_accepted from group_quiz_notification where groupid<>'".$groupid."'",$con);


while($sql_result=mysql_fetch_assoc($sql)){
    
    
    echo $groupid=$sql_result['groupid'];
    
}




?>

