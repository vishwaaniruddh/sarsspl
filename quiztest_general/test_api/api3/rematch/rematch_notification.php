<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$userid=$_POST['userid'];


$sql=mysql_query("SELECT * from rematch where player2='".$userid."'",$con);

$sql_result=mysql_fetch_assoc($sql);

$oppid=$sql_result['player2'];
$testid=$sql_result['testid'];



mysql_query("DELETE FROM rematch WHERE created_at < (NOW() - INTERVAL 30 SECOND)  and testid='".$testid."'",$con);



$topic=$sql_result['topic'];
$subject=$sql_result['subject'];
$quiz_type=$sql_result['againstid'];

if($oppid == $userid){
$data=['data'=>['oppid'=>$oppid,'testid'=>$testid,'topic'=>$topic,'subject'=>$subject,'quiz_type'=>$quiz_type]];



echo json_encode($data);    
}
else{
    echo json_encode('0');
}




?>