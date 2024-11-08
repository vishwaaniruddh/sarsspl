<?php
// var_dump($_POST);
// die;

include 'config.php';

session_start();



$id = $_POST['patient_id'];
$doc = $_POST['doc'];
$refno = $_POST['refno'];
$refdate = $_POST['refd'];
$addate = $_POST['addate'];

// $stay = $_POST['stay'];
$newroom = $_POST['Newroom'];
$room = $_POST['room1'];
// $hr = $_POST['hour'];
// $min = $_POST['min'];
// $time = $hr . ":" . $min;
$time = $_POST['addtime'];

$final = $_POST['final'];
$all = $_POST['all'];
$present = $_POST['present'];
$past = $_POST['past'];
$sys = $_POST['sys'];
$local = $_POST['local'];
$pro = $_POST['pro'];
$built = $_POST['built'];
$temp = $_POST['temp'];
$nour = $_POST['nour'];
$pulse = $_POST['pulse'];
$aneama = $_POST['aneama'];
$resp = $_POST['resp'];
$cya = $_POST['cya'];
$lying = $_POST['lying'];
$oedema = $_POST['oedema'];
$bp = $_POST['bp'];
$jau = $_POST['jau'];
$skin = $_POST['skin'];
$throat = $_POST['throat'];
$nail = $_POST['nail'];
$tongue = $_POST['tongue'];
$other = $_POST['other'];
$lymph = $_POST['lymph'];
$treattype = $_POST['tre'];


$sql = "insert into admission (patient_id,doctor,admit_date,admit_time,room,final_diag,allergies,symptoms_of_present_illness,past_illness,systematic_exam,local_examination,provisional_diag,built,temperature,nourishment,pulse,anaema,respiration,cyanosis,lying_bp_down,oedema,bp_sitting,jaundice,skin,throat,nails,tongue,other,lymph_nodes,treat_type,refno,refdate,room_type) values('$id','$doc','$addate','$time','$room','$final','$all','$present','$past','$sys','$local','$pro','$built','$temp','$nour','$pulse','$aneama','$resp','$cya','$lying','$oedema','$bp','$jau','$skin','$throat','$nail','$tongue','$other','$lymph','$treattype','$refno','$refdate','$newroom' )";
echo $sql;
$result = mysqli_query($con, $sql);

// mysqli_query($con,"update appoint set status='yes' where app_id='".$aid."'");
if ($result) {
	header("location: home.php");
} else
	echo "error Inserting data";
