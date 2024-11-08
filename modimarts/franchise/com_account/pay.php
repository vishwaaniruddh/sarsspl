<?php include('../../config.php');
date_default_timezone_set('Asia/Kolkata');



$id= $_POST['member_id'];
$setteled_amount = $_POST['amount'];
$remark = $_POST['remark'];
$payment_date = $_POST['payment_date'];
$datetime = date('Y-m-d h:i:s'); 




if($id && $setteled_amount){
  
  $check_sql = mysqli_query($con3,"select * from manage_sales_com where member_id='".$id."' order by id desc");
if($check_sql_result = mysqli_fetch_assoc($check_sql)){
    // $id = $check_sql_result['id'];

        $total_amount = $check_sql_result['available_amount'];        
        
        $remaining_amount = round($total_amount,2) - round($setteled_amount,2);   
        $remaining_amount = round($remaining_amount,2);
        
        
 if(mysqli_query($con3,"insert into manage_sales_com(member_id,amount,available_amount,status,remark,payment_date, created_at) values('".$id."','".$setteled_amount."','".$remaining_amount."','1','".$remark."','".$payment_date."','".$datetime."')")){
            echo 1;
        }
    
}
else{
  if(mysqli_query($con3,"insert into manage_sales_com(member_id,amount,status,remark,payment_date,created_at) values('".$id."','".$setteled_amount."','1','".$remark."','".$payment_date."','".$datetime."')")){
    
    $insert_id = $con3->insert_id;
    
        $com_sql = mysqli_query($con3,"select sum(amount) as amount from commission_details where commission_to = '".$id."'");
        $com_sql_result = mysqli_fetch_assoc($com_sql);
        $total_amount = $com_sql_result['amount'];        
        
        $remaining_amount = round($total_amount,2) - round($setteled_amount,2);   
        $remaining_amount = round($remaining_amount,2);
        if(mysqli_query($con3,"update manage_sales_com set available_amount = '".$remaining_amount."' where id='".$insert_id."'")){
            echo 1;
        }

    
}
else{
    echo 0;
}
  }



  
}
else{
    echo 0;
}



?>