<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$id=$_POST['id'];
$userid=$_POST['userid'];
$response=$_POST['response'];

// $id=10;
// $userid=166;
// $response=2;



if($response==1 || $response=='1'){
$sql="update ai_notification set is_accepted=1 where id = '".$id."'";
    
    if(mysql_query($sql,$con)){
        echo json_encode('1');
    }
    else{
        echo json_encode('0');
    }


}
else{
    $sql="update ai_notification set is_accepted=2 where id = '".$id."'";
    
    if(mysql_query($sql,$con)){
        echo json_encode('1');
    }
    else{
        echo json_encode('0');
    }
}




?>