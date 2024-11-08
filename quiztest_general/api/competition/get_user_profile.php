<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


$userid=$_GET['userid'];

$sql=mysqli_query($con,"SELECT competetion_registration.id as competetion_id ,
			competetion_registration.subscription as subscription_id ,
			subjects.subject as subjects_name ,
			competetion_registration.updated_at as competetion_updated_at ,
			competetion_registration.created_at as competetion_created_at ,
			competetion_registration.expiry_date as expiry_date,
			competetion_duration.amount as amount ,
			competetion_duration.type as duration_type,
			competetion_duration.duration as duration
			FROM competetion_registration 
			INNER join subjects on subjects.id=competetion_registration.subject 
			INNER join competetion_duration on competetion_duration.id=competetion_registration.subscription 
			where competetion_registration.userid='".$userid."'");



$get_result=mysqli_fetch_assoc($sql);

$competetion_id=$get_result['competetion_id'];
$subscription=$get_result['subscription_id'];
$subjects_name=$get_result['subjects_name'];
$duration=$get_result['duration'];
$amount=$get_result['amount'];
$duration_type=$get_result['duration_type'];
$competetion_updated_at=$get_result['competetion_updated_at'];
$competetion_created_at=$get_result['competetion_created_at'];
$competetion_expiry_date=$get_result['expiry_date'];




$data=['data'=>['competetion_id'=>$competetion_id,'amount'=>$amount,'duration'=>$duration,'duration_type'=>$duration_type,'competetion_created_at'=>$competetion_created_at,'competetion_updated_at'=>$competetion_updated_at,'competetion_expiry_date'=>$competetion_expiry_date,'subjects_name'=>$subjects_name,'subscription_id'=>$subscription]];

echo json_encode($data);





?>