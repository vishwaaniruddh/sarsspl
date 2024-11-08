<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


$std = $_REQUEST['std'];


if($std){
    

$sql = mysqli_query($con,"select * from project_catT where is_sci ='1' and standard='".$std."'");


while($sql_result = mysqli_fetch_assoc($sql)){
    
    $id = $sql_result['id'];
    $subject = $sql_result['name'];
    
    $data[] = ['id'=>$id,'subject'=>$subject];
}


    if($data){
        
        echo json_encode($data);
    }
    else{
        echo 0;
    }
}
else{
    echo 0;
}



?>