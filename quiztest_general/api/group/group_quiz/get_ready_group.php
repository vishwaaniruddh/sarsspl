<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


$sql=mysqli_query($con,"SELECT * from group_ready_notification where is_ready=1");

while($sql_result=mysqli_fetch_assoc($sql)){
    
    $groupid[]=$sql_result['group_id'];
    
    
    

    
}
$groupid=json_encode($groupid);
$groupid=str_replace( array('[',']','"') , ''  , $groupid);

$group=array_unique(explode(',', $groupid));


foreach($group as $key => $value){
    
$data[]=['group_id'=>$value,'group_name'=>group_name($value)];
    
}


echo json_encode($data);


?>