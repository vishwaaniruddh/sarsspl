<?php 
session_start();
include '../../config.php';


$customer_address    = $_POST['address'];
$customer_name       = $_POST['name'];
$logo                = $_POST['logo'];
$content             = $_POST['content'];
$image               = $_POST['image'];
$status              = $_POST['status'];

$view_member= "SELECT `customer_id`, `customer_name`, `customer_address`, `content`, `logo`, `image`, `status`, `created_at`, `updated_at` FROM `customer_promotion`";

// if (mysqli_query($con, $view_member)) {
//   echo "New record created successfully";
//  } else {
//   echo "Error: <br>" . mysqli_error($con);
// }

?>