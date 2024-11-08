<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


$testid=$_POST['testid'];
// $testid=2317;


$sql=mysql_query("select * from rematch where testid='".$testid."'",$con);

$sql_result=mysql_fetch_assoc($sql);

$isaccept=$sql_result['is_accepted'];


if($isaccept>0){
    echo json_encode($isaccept);
}
else{
    echo json_encode('0');
}

?>