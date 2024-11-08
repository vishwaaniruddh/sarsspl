<?php include('../config.php');
date_default_timezone_set('Asia/Kolkata');



$id= $_POST['member_id'];
$setteled_amount = $_POST['amount'];
$remark = $_POST['remark'];
$payment_date = $_POST['payment_date'];
$datetime = date('Y-m-d h:i:s'); 


function get_amount($id){
    global $con;
    
    $sql = mysqli_query($con,"select sum(amount) as amount from manage_join_com where member_id='".$id."' order by id desc");
    if($sql_result = mysqli_fetch_assoc($sql)){
        return round($sql_result['amount'],2);
    }
    else{
        return 0;
    }
    
    
}






if($id && $setteled_amount){
  
  $check_sql = mysqli_query($con,"select * from manage_join_com where member_id='".$id."' order by id desc");
if($check_sql_result = mysqli_fetch_assoc($check_sql)){
    // $id = $check_sql_result['id'];

        $total_amount = $check_sql_result['available_amount'];        
        
        $remaining_amount = round($total_amount,2) - round($setteled_amount,2);   
        $remaining_amount = round($remaining_amount,2);
        
        
 if(mysqli_query($con,"insert into manage_join_com(member_id,amount,available_amount,status,remark,payment_date, created_at) values('".$id."','".$setteled_amount."','".$remaining_amount."','1','".$remark."','".$payment_date."','".$datetime."')")){
            echo 1;
        }
    
}
else{
    
    
    $com_sql = mysqli_query($con,"select sum(amount) as amount from joining_com_details where member_id = '".$id."'");
    $com_sql_result = mysqli_fetch_assoc($com_sql);
    $amount = $com_sql_result['amount'];
    

                        if(get_amount($id)>0){
                               
                               $available_amount = round($amount,2) - get_amount($id);  
                            }else{
                                $available_amount = round($amount,2);                                
                            } 

$available_amount = $available_amount - $setteled_amount ; 

  if(mysqli_query($con,"insert into manage_join_com(member_id,amount,available_amount,status,remark,payment_date,created_at) values('".$id."','".$setteled_amount."','".$available_amount."','1','".$remark."','".$payment_date."','".$datetime."')")){
    
    $insert_id = $con3->insert_id;
    
        $com_sql = mysqli_query($con,"select sum(amount) as amount from commission_details where commission_to = '".$id."'");
        $com_sql_result = mysqli_fetch_assoc($com_sql);
        $total_amount = $com_sql_result['amount'];        
        
        $remaining_amount = round($total_amount,2) - round($setteled_amount,2);   
        $remaining_amount = round($remaining_amount,2);
        if(mysqli_query($con,"update manage_join_com set available_amount = '".$remaining_amount."' where id='".$insert_id."'")){
            echo 1;
        }

    
}
else{
    echo mysqli_error();
}
  }



  
}
else{
    echo  mysqli_error();
}



?>