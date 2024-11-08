<?php 

include '../config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$memcode=$_POST['memcode'];

if(isset($memcode))
{
CreateRef($memcode);
}

function CreateRef($memcode)
{
	Global $con;

$refcode=generate_code(30);
$memcount=mysqli_num_rows(mysqli_query($con,"SELECT * FROM `franchise_referral` WHERE franchise_id='".$memcode."'"));
if($memcount==0){

$checkcode=mysqli_query($con,"SELECT * FROM `franchise_referral` WHERE ref_code='".$refcode."'");
$countref=mysqli_num_rows($checkcode);

if($countref==0)
{
	$date=date('Y-m-d H:i:s');
	$done=mysqli_query($con,"INSERT INTO `franchise_referral`(`ref_code`, `franchise_id`, `created_at`, `updated_at`) VALUES ('".$refcode."','".$memcode."','".$date."','".$date."')");
	if($done)
	{
		echo "1";
	}
	else
	{
	echo "0"; 
     }
}
else
{
CreateRef($memcode);
}
}
else
{
	echo "0";
}
}



function generate_code($length)
{
    $str_result = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz'; 
    return substr(str_shuffle($str_result), 0, $length);
}
 ?>