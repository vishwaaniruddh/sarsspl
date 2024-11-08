<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$sql=mysqli_query($con,"SELECT * from share_link");

while($sql_result=mysqli_fetch_assoc($sql)){
    
    $play_store=$sql_result['play_store'];
    
    $data[]=['data'=>['play_store'=>$play_store]];
}

if($data){
    echo json_encode($data);  
    return;
} else {
    echo json_encode("[]");
}

?>