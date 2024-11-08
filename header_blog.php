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

$url = "https://sarmicrosystems.in/";

$id = $_GET['id'];

$sql = mysqli_query($con,"select image1 from blog_details_insert where id = '".$id."' limit 1 ");
$sql_res = mysqli_fetch_row($sql);

if(mysqli_num_rows($sql)>0){
    $imageUrl = $url.$sql_res[0];
}else{
    $imageUrl = "https://sarmicrosystems.in/assets/images/logo/headlogo.png";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta property="og:image" content="<?php echo $imageUrl; ?>">
<!--<meta property="og:image:type" content="image/jpg">-->
<!--<meta property="og:image:width" content="1024">-->
<!--<meta property="og:image:height" content="1024">-->

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

<!-- added for manoj sir -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src= 'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-TD7LKSMD');</script>


</head>
<body>
     <div class="boxed_wrapper">
   
<?php include 'nav.php';
    //   include 'top-header.php'; 
?> 