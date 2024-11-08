<!DOCTYPE html>
<html lang="en">
<head>
        <?php
         $CI =& get_instance(); 
     $CI->load->model('Settings_M');
     $Settings=$CI->Settings_M->getSettingdetails(1);
     ?>
        <meta charset="utf-8" />
        <title>Log In : <?=$Settings->Company_name?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="<?=$Settings->Company_name?>" name="description" />
        <!-- <meta content="Coderthemes" name="author" /> -->
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?=base_url()."/".$Settings->logo?>">

        <!-- App css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
        <link href="assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />

    </head>

    <body class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>