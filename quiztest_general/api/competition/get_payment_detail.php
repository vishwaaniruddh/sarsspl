<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$userid = $_REQUEST['userid'];

$sql = mysqli_query($con,"select competetion_duration.duration as duration,
	                competetion_duration.amount as amount,
	                competetion_payment.created_at as created_at,
	                competetion_payment.mode as mode,
	                competetion_payment.expiry_date as expiry_date,
	                competetion_payment.old_plan as old_plan,
	                competetion_duration.status as status
	                from competetion_payment 
    		    INNER join competetion_duration on competetion_duration.id=competetion_payment.new_plan 
    		    where userid ='".$userid."' order by competetion_payment.id desc");


    		    
while($sql_result = mysqli_fetch_assoc($sql)){
    
    $duration = $sql_result['duration'];
    $amount = $sql_result['amount'];
    $mode = $sql_result['mode'];
    $old_plan = $sql_result['old_plan'];
    $expiry_date = $sql_result['expiry_date'];
    $created_at = $sql_result['created_at'];
    $status = $sql_result['status'];
 
 $old_plan_name='';   
    if($old_plan !=0){
    
     $sqlm=mysqli_query($con,"SELECT id,duration FROM `competetion_duration` where id=$old_plan");
    $row=mysqli_fetch_assoc($sqlm);
      $old_plan_name=$row['duration'];
    
    }
       
   
      
    $data[] = ['duration'=>$duration,'amount'=>$amount ,'mode'=>$mode , 'created_at'=>$created_at ,'expiry_date'=>$expiry_date,'old_plan_name'=>$old_plan_name,'status'=>$status];
}

if($data){
    echo json_encode($data);
}
else{
    echo 0;
}
