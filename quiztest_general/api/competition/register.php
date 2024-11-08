<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


$userid = $_REQUEST['userid'] ; 
$subject = $_REQUEST['subject'];
$subscription = $_REQUEST['subscription'];
$date = date('Y-m-d');
$expiry_date='';

if($subscription == 1){
 
 $expiry_date = date('Y-m-d', strtotime('sunday'));
 
}else if ($subscription == 2){

    // $expiry_date = date('Y-m-d', strtotime('last day of this month'));
    $expiry_date = date("Y-m-t", strtotime($date));
 }else if($subscription == 3){
     
    //  $expiry_date = date('Y-m-d', strtotime('+3 month'));
    $date =  date('Y-m-d', strtotime($date. '+2 months')); 
    $expiry_date = date("Y-m-t", strtotime($date));
    
}else if($subscription == 4){
    //  $expiry_date = date('Y-m-d', strtotime('+6 month'));
     $date =  date('Y-m-d', strtotime($date. '+5 months')); 
    $expiry_date = date("Y-m-t", strtotime($date));
}



if(isset($userid) && isset($subject) && isset($subscription)){
    
    $sql = "insert into competetion_registration(userid,subject,subscription,status,updated_at,created_at,expiry_date) values('".$userid."','".$subject."','".$subscription."',1,'".$date."','".$date."','".$expiry_date."')";
    
    if(mysqli_query($con,$sql)){
        
        
         $competetion_payment = "insert into competetion_payment(userid,old_plan,new_plan,status,mode,created_at,expiry_date) values('".$userid."','0','".$subscription."',1,'cash','".$date."','".$expiry_date."')";
         
	if(mysqli_query($con,$competetion_payment)){
	        echo 1;
	    }
	    else{
	        echo 0;
	    }
    }
    else{
        echo 0;
    }
}
else{
    echo 0;
}

?>