<?php
session_start();
include 'config.php';

// error_reporting(E_ALL);
// ini_set('display_errors', '1');

if (isset($_POST['UnitName'])) {
    $unitname = $_POST['UnitName'];
    $under = $_POST['under'];
    $chk      = mysqli_query($con1, "SELECT * FROM `product_variant_master` WHERE name LIKE '%$unitname%' ") or die(mysqli_error($con1));
    $check    = mysqli_num_rows($chk);
    if ($check == 0) {
        $query = mysqli_query($con1, "INSERT INTO `product_variant_master`(`name`,`under`) VALUES ('$unitname','$under')") or die(mysqli_error($con1));
        ?>
        <script>
        window.location.href = 'product_units.php';
        </script>
        <?php
    } else {
        ?>
        <script>
        window.location.href = 'product_units.php';
        </script>
        <?php

    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <META HTTPS-EQUIV="Pragma" CONTENT="no-cache">
    <META HTTPS-EQUIV="Expires" CONTENT="-1">
    <!--============================ ck Editor ===============-->
    <meta https-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--<link rel="stylesheet" href="adstyle.css" type="text/css" />
    <link rel="stylesheet" href="style.css" type="text/css" />-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
    <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
    <script src="ckeditor/ckeditor.js"></script>
    <script src="ckeditor/samples/js/sample.js"></script>
    <link rel="stylesheet" href="ckeditor/samples/css/samples.css">
    <!--============================ ck Editor ===============-->
    <!-- Meta -->
    <meta charset="UTF-8">
    <meta name="author" content="Acura">
  <meta name="description" content="Acura - A Real Admin Template">
  <meta name="keywords" content="Acura, Admin Template, Admin, Premium, ThemeForest, Clean, Modern, Responsive">
  <!-- Responsive viewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <!-- Title -->
  <link rel="stylesheet" type="text/css" href="pop.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
  <title>Vendor Add-product</title>
  <style>
      body{
          font-family: 'Open Sans',sans-serif !important;
          /*font: 16px / 1.8 Arial, 'Helvetica Neue', Helvetica, sans-serif;*/
          font: 16px , 'Open Sans',  sans-serif !important;
        }
        .lbl-prop{
            color: red;
            font-size: 14px;
        }

        .tables tr{
                border-bottom: 0 !important;
        }
        .no-space{
                white-space: nowrap;
        }
  </style>
<?php include 'header.php';?>
<body >
<div  class="modal" style="left: 697px">

<!-- Title & Sitemap -->
    <div class="title-sitemap grid-12">
        <h1 class="grid-10"><i>&#xf132;</i><span> Welcome to Vendor Panel</span> </h1>
    </div>
    </header>
      <!-- Data -->
      <div class="data grid-12">
        <!-- Simple Chart -->
        <div>
          <div class="widget">
            <header class="widget-header">
              <div class="widget-header-icon">&#xf109;</div>
            </header>
            </div>
            <div class="widget">
              <div class="form-group">
                  <h3>Add Product Unit </h3>

              </div>
              <div class="row form-group">
                <form action="#" method="post">
                    <div class="col-md-4 text-center">
                        <div class="form-group">
                            <label for="UnitName">Master Name</label>
                            <select class="form-control" name="under">
                            <option value="">Select Master</option>
                               <?php
                            $gquery = mysqli_query($con1, "SELECT * FROM `product_variant_master` WHERE under ='0'");
                            while ($rowq = mysqli_fetch_assoc($gquery)) {
                                ?> <option value="<?=$rowq['id']?>"><?=$rowq['name']?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="form-group">
                            <label for="UnitName">Unit Name</label>
                            <input type="text" name="UnitName" id="UnitName" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-primary" style="margin-top: 33px;">
                        </div>
                    </div>


      </div>

              </div>
          </div>
        </div>
      </div>
</div>
</body>
</html>

  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/custom.css">
  <!--<script type="text/javascript" src="script.js"></script>-->
    <script src="ckeditor/ckeditor.js"></script>
  <script src="ckeditor/samples/js/sample.js"></script>
  <link rel="stylesheet" href="ckeditor/samples/css/samples.css">
  <script src="ckeditor/samples/js/sample1.js"></script>

<!--=================================ck editor=======================-->

<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.js"></script>
<link rel="stylesheet" type="text/css" href="css/dropdown.css">

