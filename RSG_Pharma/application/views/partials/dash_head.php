<!DOCTYPE html>
    <html lang="en">
<head>

    <?php
         $CI =& get_instance(); 
     $CI->load->model('Settings_M');
     $Settings=$CI->Settings_M->getSettingdetails(1);
     ?>
        <meta charset="utf-8" />
        <title><?=$title?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?=base_url()."/".$Settings->logo?>">

        <!-- third party css -->
        <link href="<?=base_url()?>/assets/css/vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- third party css end -->

        <!-- App css -->
        <link href="<?=base_url()?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>/assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
        <link href="<?=base_url()?>/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />
        <!-- Datatables css -->
        <link href="<?=base_url()?>/assets/css/vendor/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>/assets/css/vendor/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

 
        <script src="<?=base_url()?>/assets/js/typeahead.js"></script>
        <script src="<?=base_url()?>/assets/js/custome.js"></script>
        <script src="<?=base_url()?>/assets/js/custom.js"></script>
        <!-- end demo js-->

    </head>

    <body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <!-- Begin page -->
        <div class="wrapper">
            <!-- ========== Left Sidebar Start ========== -->