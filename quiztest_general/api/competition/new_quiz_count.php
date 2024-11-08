<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


$userid = $_REQUEST['userid'];
$date = date('Y-m-d');

$sql = mysqli_query($con,"select * from competetion_registration where userid = '".$userid."' order by id desc");

if($sql_result = mysqli_fetch_assoc($sql)){
    
    $expiry = $sql_result['expiry_date'];


$get_last_pay = mysqli_query($con,"select * from competetion_payment where userid = '".$userid."' order by id desc");

$get_last_pay_result = mysqli_fetch_assoc($get_last_pay);

$created_at = $get_last_pay_result['created_at'];


        if($date > $expiry){
            echo json_encode('expire');
        }
        else{
            
            $plan = $sql_result['subscription'];

            if($plan == 1){    
                $max_quize = 2 ;
            }else if ($plan == 2){
                $max_quize = 8 ;
            }else if($plan == 3){
                $max_quize = 24 ;
            }else if($plan == 4){
                $max_quize = 48 ; 
            }
            
            $check_sql = mysqli_query($con,"select * from competetion_count where userid = '".$userid."' and plan = '".$plan."' and created_at = '".$created_at."' order by id desc");
            
            if($check_sql_result = mysqli_fetch_assoc($check_sql)){
                    
                $quiz_played = $check_sql_result['quize_count'];
            
                    // if($quiz_played < $max_quize ){
                    //     $count = $check_sql_result['quize_count'];
                    //     $new_count = $count +1 ;
                    //     mysqli_query($con,"update competetion_count set quize_count = '".$new_count."' where userid = '".$userid."' and plan = '".$plan."' and created_at = '".$created_at."'");                
                    //     }
                        
                    //     $get_count_sql = mysqli_query($con,"select * from competetion_count where userid = '".$userid."' and plan = '".$plan."' and created_at = '".$created_at."'order by id desc");
                
                    // 	$get_count_result = mysqli_fetch_assoc($get_count_sql);
                    
                    
                    //  $quiz_played = $get_count_result['quize_count'];         
                        
                       
                    if($max_quize > $quiz_played){
                            echo json_encode('can_play');
                    } else {
                            echo json_encode('max_reach');
                    }
            

            
            }
            else{                
                // $statement = "insert into competetion_count(userid,plan,quize_count,status,created_at) values('".$userid."','".$plan."','1','1','".$date."')";
                //  mysqli_query($con,$statement);
                 echo json_encode('can_play');
            }
    
            
        }

    }else{
    echo 0;
    }
?>