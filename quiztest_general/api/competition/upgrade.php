<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


$plan = $_REQUEST['plan'];
$userid = $_REQUEST['userid'];
$date = date('Y-m-d');
$mode = 'cash';

// $plan = '1';
// $userid = '26';



if(isset($userid) && isset($plan)){
    
    $old_plan_sql = mysqli_query($con,"select * from competetion_registration where userid='".$userid."' order by id desc");
    $old_plan_sql_result = mysqli_fetch_assoc($old_plan_sql);
    $oldplan = $old_plan_sql_result['subscription'];



if($plan == 1){
 
 $expiry_date = date('Y-m-d', strtotime('sunday'));
 
}else if ($plan == 2){
    $expiry_date = date("Y-m-t", strtotime($date));
 }else if($plan == 3){
     
    $date =  date('Y-m-d', strtotime($date. '+2 months')); 
    $expiry_date = date("Y-m-t", strtotime($date));
    
}else if($plan == 4){
     $date =  date('Y-m-d', strtotime($date. '+5 months')); 
    $expiry_date = date("Y-m-t", strtotime($date));
}




     $sql = "insert into competetion_payment(userid,old_plan,new_plan,mode,status,created_at,expiry_date) values('".$userid."','".$oldplan."','".$plan."','".$mode."','1','".$date."','".$expiry_date."')" ; 
     
    
    if(mysqli_query($con,$sql)){
        echo 1;
        
        mysqli_query($con,"insert into competetion_count(userid,plan,quize_count,status,created_at) values('".$userid."','".$plan."','".$quize_count."',1,'".$date."')");
        
        mysqli_query($con,"update competetion_registration set subscription = '".$plan."' , updated_at ='".$date."' , expiry_date = '".$expiry_date."' where userid='".$userid."'");
    }
    else{
        echo 0;
    }
}
else{
    echo 0;
}





