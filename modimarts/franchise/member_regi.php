<?php
session_start();
include 'config.php';
// echo $_SESSION['member_id'];
$mobile_no = $_POST['mobile_no'];
// $member_id = $_POST['member_id'];
$get_otp = $_POST['get_otp'];
$password = $_POST['password'];


$select_sql="select * from member where mobile ='".$mobile_no."'";
$query=mysqli_query($conn,$select_sql);
$numrow=mysqli_num_rows($query);
if($numrow > 0 ){
    while($sql2fetch=mysqli_fetch_array($query)){
         session_start();
        //  $_SESSION["member_id"]=$sql2fetch['id'];
        $member_id =  $sql2fetch['id'];
        // exit;
    }
$insert_sql ="insert into member_credentials(member_id,user_name,password) VALUES('".$member_id."','".$mobile_no."','".$password."')";
    $query1=mysqli_query($conn,$insert_sql);
// echo $query;
if($query1 > 0){
    
    $_SESSION['member_id']=$member_id;
    $_SESSION['user_name']=$mobile_no;
    echo '1';
}else{
    echo '0';
}
}else{
     $insert_sql2 ="insert into member(mobile) VALUES('".$mobile_no."')";
    $query2=mysqli_query($conn,$insert_sql2);
    $member_id = mysqli_insert_id($conn);
    
    if($query2 > 0){
        $insert_sql1 ="insert into member_credentials(member_id,user_name,password) VALUES('".$member_id."','".$mobile_no."','".$password."')";
            $query2=mysqli_query($conn,$insert_sql1);
    if($query2 > 0){
        $_SESSION['member_id']=$member_id;
        $_SESSION['user_name']=$mobile_no;
        echo '1';
    }else{
        echo '0';
    }
    }
}


