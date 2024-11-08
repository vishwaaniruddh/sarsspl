<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


$sql = mysqli_query($con,"select * from competetion_duration where status=1");


while($sql_result = mysqli_fetch_assoc($sql)){
    
    $id = $sql_result['id'];
    $duration = $sql_result['duration'];
    $amount = $sql_result['amount'];
    $type = $sql_result['type'];
    
    $data[]= ['id'=>$id,'duration'=>$duration, 'amount'=>$amount, 'type' =>$type ];
}

echo json_encode($data);
?>