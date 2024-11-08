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
        
<!-- Include DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">

<!-- Include DataTables Buttons CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">


        <!-- Datatables css -->
    <!--    <link href="<?=base_url()?>/assets/css/vendor/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />-->
    <!--    <link href="<?=base_url()?>/assets/css/vendor/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />-->
    <!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->
    
    <!--<link href="<?=base_url()?>/assets/css/vendor/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />-->

    </head>

    <body class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>