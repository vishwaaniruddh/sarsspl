<?php

include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');



$userid = $_REQUEST['userid'];

if($userid){
$date = date('Y-m-d');

 
    $sql = mysqli_query($con,"select * from competetion_registration where userid='".$userid."' and status=1 and DATE(expiry_date) >= '".$date."' order by id desc");

    
    if($sql_result = mysqli_fetch_assoc($sql)){
        
        $subject = $sql_result['subject'];
        $plan = $sql_result['subscription'];
    
    
    
        $check_sql = mysqli_query($con,"select * from competetion_count where userid = '".$userid."' and plan = '".$plan."'");
    
            if($check_sql_result = mysqli_fetch_assoc($check_sql)){
            
                $count = $check_sql_result['quize_count'];
                $new_count = $count +1 ;  
                    if(mysqli_query($con,"update competetion_count set quize_count = '".$new_count."' where userid = '".$userid."' and plan = '".$plan."'")){
                        echo 1;
                    }
                else{
                    echo 0;
                }   
            
            }else{
                
            $statement = "insert into competetion_count(userid,plan,quize_count,status,created_at) values('".$userid."','".$plan."','1','1','".$date."')";
    
            if(mysqli_query($con,$statement)){
                echo 1;
            }
        else{
            echo 0;
        }
    }
        }else{
            echo 'plan_expired';
        }
        
}
else{
    echo 0;
}
?>