<?php session_start();

include('config.php');

define('UPLOAD_DIR', 'joining_card/'); 
$img = $_POST['imgBase64'];
$mobile = $_POST['mobilenum'];
$id = $_POST['id'];

$img = str_replace('data:image/png;base64,', '', $img); 
$img = str_replace(' ', '+', $img); 
$data = base64_decode($img); 
$file = UPLOAD_DIR . $id. '.png'; 
$success = file_put_contents($file, $data);


$url='https://www.allmart.world/franchise/joining_card/'.$id.'.png';

$sql="UPDATE joining_com SET chart_img='".$url."' WHERE id='".$id."'";

mysqli_query($con, $sql);

?>
