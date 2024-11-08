<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json');

// echo  $date2=date('d-m-Y h:i:s') ;


echo get_status(88);


// echo NOW();

    // echo "UPDATE online set status=0 WHERE created_at < (NOW() - INTERVAL 15 SECOND)";
$userid=$_POST['userid'];


$sql=mysql_query("select * from online where userid='".$userid."'",$con);

$sql_result=mysql_fetch_assoc($sql);

if($sql_result){
    
}






?>