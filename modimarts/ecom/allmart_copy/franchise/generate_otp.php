<? include('config.php');

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$id = $_POST['member_id'];

// $id = '116';

$get_mobile = mysqli_query($con,"select * from new_member where id='".$id."'");
$get_mobile_result = mysqli_fetch_assoc($get_mobile);
$mobile = $get_mobile_result['mobile'];

$datetime = date("Y-m-d H:i:s");
$otp = rand(1000,9999);

mysqli_query($con,"delete from otp_verification where mobile_no='".$mobile."'");

$sql  = "insert into otp_verification(mobile_no,otp,date_time) values('".$mobile."','".$otp."','".$datetime."')";

if(mysqli_query($con,$sql)){

    
    $url="avoservice.in/whatsapp_frachise.php?id=".$id;
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);

    $result = curl_exec($ch);
    
    print_r($result);
    curl_close($ch);

    
}
else{
    echo mysqli_error($con);
}

?>
