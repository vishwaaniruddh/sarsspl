<?php 
session_start();
// include 'config.php';

date_default_timezone_set('Asia/Kolkata');
$host="localhost";
$user="shyambab_Temp";
$pass="sar@123";
$dbname="shyambab_Temple";
$conn = new mysqli($host, $user, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
//echo "Connected succesfull";
   
}
$name = $_POST['name'];
$dob = $_POST['dob'];
$gen = $_POST['gender'];
$mobile = $_POST['mobile'];
$pan = $_POST['pan'];
$aadhar = $_POST['aadhar'];
$family = $_POST['family'];
$image = $_POST['image'];

//echo json_encode($_POST['name']);
$addr = $_POST['addr'];
$tempaddr = $_POST['tempaddr'];
$date = $_POST['date'];
$place = $_POST['place'];

echo json_encode($_POST);
/*echo json_encode($name).'<br>';
echo json_encode($dob).'<br>';
echo json_encode($gen).'<br>';echo json_encode($mobile).'<br>';
echo json_encode($pan).'<br>';
echo json_encode($aadhar).'<br>';
//echo json_encode($family).'<br>';
echo json_encode($image).'<br>';

echo json_encode($_POST['gender']);*/

?>
