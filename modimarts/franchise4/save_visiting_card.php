<?php session_start();

include('config.php');

define('UPLOAD_DIR', 'visiting_card_images/'); 
$img = $_POST['imgBase64'];
$mobile = $_POST['mobilenum'];
$id = $_POST['id'];


$img = str_replace('data:image/png;base64,', '', $img); 
$img = str_replace(' ', '+', $img); 
$data = base64_decode($img); 
$file = UPLOAD_DIR . $mobile. '.png'; 
$success = file_put_contents($file, $data);


$url='https://www.modimart.world/franchise4/visiting_card_images/'.$mobile.'.png';

$sql="UPDATE new_member SET visiting_image='".$url."' WHERE id='".$id."'";

mysqli_query($con, $sql);

?>
