<?php
session_start();

if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
}


include('config.php');

?>

<?php

$url = "https://sarmicrosystems.in/SAR/";

$id = $_GET['id'];

$sql = mysqli_query($con,"select image1 from blog_detail where id = '".$id."' limit 1 ");
$sql_res = mysqli_fetch_row($sql);

if(mysqli_num_rows($sql)>0){
    $imageUrl = $url.$sql_res[0];
}else{
    $imageUrl = "https://sarmicrosystems.in/SAR/assets/images/logo/headlogo.png";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta property="og:image" content="<?php echo $imageUrl; ?>">

<title>SAR Software Solutions Pvt. Ltd. </title>

<!-- Fav Icon -->
<link rel="icon" href="favicon.ico" type="image/x-icon">

<!-- Stylesheets -->
<link href="assets/css/font-awesome-all.css" rel="stylesheet">
<link href="assets/css/flaticon.css" rel="stylesheet">
<link href="assets/css/owl.css" rel="stylesheet">
<link href="assets/css/bootstrap.css" rel="stylesheet">
<link href="assets/css/jquery.fancybox.min.css" rel="stylesheet">
<link href="assets/css/animate.css" rel="stylesheet">
<link href="assets/css/color.css" rel="stylesheet">
<link href="assets/css/global.css" rel="stylesheet">
<link href="assets/css/elpath.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
<link href="assets/css/responsive.css" rel="stylesheet">

</head>
<body>
     <div class="boxed_wrapper">
   
<?php include 'nav.php';
    //   include 'top-header.php'; 
?> 