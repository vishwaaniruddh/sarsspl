<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

error_reporting(0);


$response=$_POST['response'];
$ai_id=$_POST['ai_id'];


$ai_id = preg_replace('/[^0-9]/', '', $ai_id);


// if 5 ie means player initiated for rematch 

if($response==5){
    $sql=mysql_query("select * from ai_players where id='".$ai_id."' and is_busy=0",$con);
    $sql_result=mysql_fetch_assoc($sql);
    
    if($sql_result){
        echo json_encode('1');
    }
    else{
        echo json_encode('0');
    }
    
    
}
?>