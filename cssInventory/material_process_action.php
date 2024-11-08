<?php session_start();
date_default_timezone_set('Asia/Kolkata');

include 'config.php';

$id=$_POST['id'];
$status=$_POST['status'];
$datetime = date('Y-m-d');

$login_user = $_SESSION['login_user'] ; 

if($status==0){
    $status_details = 'cancelled';
    $cancel_remarks=$_POST['cancel_remarks'];
    $sql = "update material_inventory set status=0, cancel_remarks='".$cancel_remarks."' where id='".$id."'";
    
    $mis_id_sql = mysqli_query($css,"select * from material_inventory where id='".$id."'");
    $mis_id_sql_result = mysqli_fetch_assoc($mis_id_sql);
    $mis_id = $mis_id_sql_result['mis_id']; 
    
    mysqli_query($css,"insert into mis_history(mis_id,type,remark,status,created_at,contact_person_name) values('".$mis_id."','cancelled','".$cancel_remarks."','1','".$datetime."','".$login_user."')");

}
if($status==4){
    $status_details = 'material_dispatch';
    $pod=$_POST['pod'];
    $courier_name = $_POST['courier_name'];
    $mis_id=$_POST['mis_id'];
    $sql = "update material_inventory set status=4 where id='".$id."'";
    
    $materialupdatesql = "update material_update set pod='".$pod."',courier='".$courier_name."' where mis_id='".$mis_id."'";
    mysqli_query($css,$materialupdatesql); 
    $mishistorysql = "update mis_history set pod='".$pod."',courier_agency='".$courier_name."',status='material_dispatch' where mis_id='".$mis_id."'";
    mysqli_query($css,$mishistorysql);
}
if(mysqli_query($css,$sql)){
    $select = "select mis_id from material_inventory where id='".$id."'";
    $queryres = mysqli_query($css,$select);
    $resultdata = mysqli_fetch_row($queryres);
    $mis_id = $resultdata[0];
    $mis_sql = "update mis_details set status='".$status_details."' where id='".$mis_id."'";
    if(mysqli_query($css,$mis_sql)){
      echo '1';
    }
}
else{
    echo '2';
}

 
