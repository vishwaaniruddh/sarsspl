<?php
session_start();
include 'config.php';
$mobile_no = $_POST['mobile_no'];
$password = $_POST['password'];

// echo $mobile_no;

$sql="select * from member_credentials where user_name='".$mobile_no."' and password ='".$password."' ";
$query=mysqli_query($conn,$sql);
$numrow=mysqli_num_rows($query);

// echo $sql;

if($numrow >0){
    while($sql2fetch=mysqli_fetch_array($query)){
         session_start();
         $_SESSION["member_id"]=$sql2fetch['member_id'];
         $_SESSION["user_name"]=$sql2fetch['user_name'];
        echo '1';
        // exit;
    }
}else{
    echo '0';
    // echo $sql;
}