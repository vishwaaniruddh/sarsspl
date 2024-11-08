<? include('config.php');


$otp =  $_POST['value'];
$id = $_POST['member_id'];

$get_mobile = mysqli_query($con,"select * from new_member where id='".$id."'");
$get_mobile_result = mysqli_fetch_assoc($get_mobile);
$mobile = $get_mobile_result['mobile'];



$sql = mysqli_query($con,"select * from otp_verification where mobile_no='".$mobile."' and otp='".$otp."'");

if($sql_result = mysqli_fetch_assoc($sql)){
    echo 1;
}
else{
    echo 2;
}


?>