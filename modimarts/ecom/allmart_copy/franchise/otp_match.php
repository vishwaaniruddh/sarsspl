<?php
session_start();
include 'config.php';
// echo $_SESSION['member_id'];
$mobile_no = $_POST['mobile_no'];
$get_otp = $_POST['get_otp'];



$sql="select * from otp_verification where mobile_no ='".$mobile_no."' and otp ='".$get_otp."' ORDER by id DESC LIMIT 1";
$query=mysqli_query($conn,$sql);
$numrow=mysqli_num_rows($query);
// echo $query;
if($numrow >0){
    
$sql_delet="delete from otp_verification where mobile_no ='".$mobile_no."' and otp ='".$get_otp."' ";
$query1=mysqli_query($conn,$sql_delet);

$sql="select * from member where mobile ='".$mobile_no."'";
$query2=mysqli_query($conn,$sql);
$numrow=mysqli_num_rows($query2);


if($numrow >0){
    while($sql2fetch=mysqli_fetch_array($query2)){
         session_start();
         $_SESSION["member_id"]=$sql2fetch['id'];
         $_SESSION["user_name"]=$sql2fetch['mobile'];
        echo '1';
        // exit;
    }
    }else{
        echo '2';
    }
}else{
    echo '0';
}

// $sql="select * from otp_verification where mobile_no ='".$mobile_no."' and otp ='".$get_otp."' ORDER by id DESC LIMIT 1";
// $query=mysqli_query($conn,$sql);
// $numrow=mysqli_num_rows($query);
// // echo $query;
// if($numrow >0){
    
// $sql_delet="delete from otp_verification where mobile_no ='".$mobile_no."' and otp ='".$get_otp."' ";
// $query1=mysqli_query($conn,$sql_delet);
    
//     echo '1';
// }else{
//     echo '0';
// }

?>