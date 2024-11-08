<!DOCTYPE html>
<html class="loading" data-textdirection="ltr" lang="en">
   <!-- BEGIN: Head-->
   <head>
      <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
      <meta content="IE=edge" http-equiv="X-UA-Compatible">
      <meta content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" name="viewport">
      <meta content="." name="description">
      <meta content="admin Panel," name="keywords">
      <meta content="SAR Software" name="author">
      <title>
         Dashboard
      </title>

      <link rel="apple-touch-icon" href="https://allmart.world/assets/logo.png">
    <link rel="shortcut icon" type="image/png" href="https://allmart.world/assets/logo.png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">

       <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>vendors/css/tables/datatable/datatables.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/colors.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/components.min.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/core/colors/palette-gradient.min.css">
     <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>/vendors/css/extensions/toastr.css">
     <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>/css/plugins/extensions/toastr.min.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>/css/style.css">
    <!-- END: Custom CSS-->


    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/core/colors/palette-gradient.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>vendors/css/charts/jquery-jvectormap-2.0.3.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>vendors/css/charts/morris.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>fonts/simple-line-icons/style.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/core/colors/palette-gradient.min.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Vendor JS-->
    <script src="<?=base_url('assets/')?>vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->
    <style>
      #load{
    display: none;
    width: 100%;
    height: 100%;
    position:fixed;
    z-index:9999;
    background:url("<?=base_url('assets/images/Circle.svg')?>") no-repeat center center rgba(0,0,0,0.25)
}
    </style>

      <!-- END: Custom CSS-->
   </head>
   <!-- END: Head-->
   <!-- BEGIN: Body-->
   <body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar" data-col="2-columns" data-menu="vertical-menu-modern" data-open="click">
      <div id="load"></div>