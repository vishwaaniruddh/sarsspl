<?php
session_start();
// var_dump($_SESSION);
if (!isset($_SESSION['mem_id']) && !isset($_SESSION['username'])) {
    ?>

    <script>
        window.location.href='https://modimart.world/franchise2/get_members.php';
    </script>

<?
}
include '../config.php';

$userid     = $_GET['id'];
$sql        = mysqli_query($con, "select * from new_member where id='" . $userid . "'");
$sql_result = mysqli_fetch_assoc($sql);

$id                 = $sql_result['id'];
$full_pay_date      = $sql_result['full_pay_date'];
$level_id           = $sql_result['level_id'];
$position_id        = $sql_result['position_id'];
$country            = $sql_result['country'];
$zone               = $sql_result['zone'];
$state              = $sql_result['state'];
$division           = $sql_result['division'];
$district           = $sql_result['district'];
$taluka             = $sql_result['taluka'];
$village            = $sql_result['village'];
$location           = $sql_result['location'];
$pincode            = $sql_result['pincode'];
$status             = $sql_result['status'];
$name               = $sql_result['name'];
$mobile             = $sql_result['mobile'];
$application        = $sql_result['application'];
$no_intro           = $sql_result['no_intro'];
$intro_id           = $sql_result['intro_id'];
$introducer_name    = $sql_result['introducer_name'];
$introducer_mobile  = $sql_result['introducer_mobile'];
$temp_name          = $sql_result['temp_name'];
$payment_date       = $sql_result['payment_date'];
$is_paid            = $sql_result['is_paid'];
$payment_receivable = $sql_result['payment_receivable'];
$payment_received   = $sql_result['payment_received'];
$balance            = $sql_result['balance'];
$time               = $sql_result['time'];
$residing_area      = $sql_result['residing_area'];
$mobile2            = $sql_result['mobile2'];
$is_verify          = $sql_result['is_verify'];
$created_at         = $sql_result['created_at'];
$image_id           = $sql_result['image_id'];
$star               = $sql_result['star'];
$position_name      = $sql_result['position_name'];
$email              = $sql_result['email'];
$dob                = $sql_result['dob'];
$cast               = $sql_result['cast'];

$mem_status = $sql_result['mem_status'];

$email           = $sql_result['email'];
$dob             = $sql_result['dob'];
$cast            = $sql_result['cast'];
$anniversary     = $sql_result['anniversary'];
$gender          = $sql_result['gender'];
$marrital_status = $sql_result['marrital_status'];
$pan             = $sql_result['pan'];
$adhar_card      = $sql_result['adhar_card'];

$branch             = $sql_result['branch'];
$bank               = $sql_result['bank'];
$account_num        = $sql_result['account_num'];
$ifsc               = $sql_result['ifsc'];
$account_type       = $sql_result['account_type'];
$account_holdername = $sql_result['account_holdername'];
$pay_option         = $sql_result['pay_option'];
$gst                = $sql_result['gst'];
$password           = $sql_result['password'];

$payable_bank = $sql_result['payable_bank'];
$amount_paid  = $sql_result['amount_paid'];
$paid_date    = $sql_result['paid_date'];
$txn_id       = $sql_result['txn_id'];
$proof_image  = $sql_result['proof_image'];
$status       = $sql_result['status'];

$read_agree = $sql_result['read_agreement'];

$refcode  = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `franchise_referral` WHERE franchise_id='" . $id . "'"));
$ref_code = $refcode['ref_code'];

function get_image($type, $id)
{

    global $con;

    $sql        = mysqli_query($con, "select * from new_member_images where member_id='" . $id . "' and type='" . $type . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    $image = $sql_result['image'];
    return str_replace("https://www.", "http://", $image);

}

function generate_code($length)
{
    $data[] = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0, 'a', 'b', 'c', 'd', 'e', 'f');
    $res    = '';
    for ($i = 0; $i < $length; $i++) {
        $res .= $data[rand(0, count($data))];
    }
    return $res;
}

$read_datetime = $sql_result['read_agree_date'];

$read_date = date('Y-m-d', strtotime($read_datetime));
$read_time = date('H:i:s', strtotime($read_datetime));

?>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Edit Profile | All Mart</title>
    <!-- Favicon-->
    <link rel="icon" href="../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="../plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="../plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="../plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <!--<link href="../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />-->

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />

    <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>


    <link href="../plugins/dropzone/dropzone.css" rel="stylesheet">
    <style>
                section.content{
    margin: 13% 15px 0 15px;
        }

        td{
                white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
        }
        .navbar-nav {
     margin: 2% auto !important;
}
img{
    width: 100%;
    object-fit: cover;
    height: 350px;
}

@media (min-width: 768px){
.modal-dialog {
    width: 900px;
    margin: 30px auto;
}
}


    </style>
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
        <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header" style="min-width: 200px;">

                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>

                <a class="navbar-brand" href="../index.php" style="display:flex;height: 100px;margin: auto; line-height: 3;     padding: 0;
    width: 100%;">
                                      <img src="https://modimart.world/assets/logo.png" alt="" style="width: 100px;background:white;border-radius: 50%;height: auto;">
                    <span style="margin: auto 5%;">ModiMart</span>

                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
              <?include '../menu.php';?>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->


    <section class="content">
        <form id="form" action="changePlaceProcess.php" method="post" enctype="multipart/form-data">

            <input type="hidden" name="userid" value="<?echo $_GET['id']; ?>">
            <input type="hidden" name="oldcountry" value="<?=$country?>">
            <input type="hidden" name="oldzone" value="<?=$zone?>">
            <input type="hidden" name="oldstate" value="<?=$state?>">
            <input type="hidden" name="olddivision" value="<?=$division?>">
            <input type="hidden" name="olddistrict" value="<?=$district?>">
            <input type="hidden" name="oldtaluka" value="<?=$taluka?>">
            <input type="hidden" name="oldpincode" value="<?=$pincode?>">
            <input type="hidden" name="oldvillage" value="<?=$village?>">
            <input type="hidden" name="oldaddress" value="<?=$location?>">


        <div class="container-fluid">
            <div class="block-header">
                <h2> Franchisee Application form Edit  </h2>
            </div>
                            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Address</h2>

                        </div>
                        <div class="body">

                            <div class="row clearfix">
                                
                                <div class="col-sm-12">

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="address" value="<?echo $location; ?>" class="form-control" />
                                            <label class="form-label">Residing Address</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-sm-3">


                                  <select class="form-control" name="country" id="country" onchange="getZone(this.value)">
                                        <option value="1">India</option>
                                    </select>

                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control" name="zone" id="zone" onchange="getState(this.value)" >
                                        <option value="0">Select Zone</option>
                                    <?
                                    $zone_sql = mysqli_query($con, "select * from new_zone where country='1'");
                                    while ($zone_sql_result = mysqli_fetch_assoc($zone_sql)) {?>

                                    <option value="<?echo $zone_sql_result['id'] ?>" <?php if ($zone==$zone_sql_result['id']) {echo "selected";}?> ><?echo $zone_sql_result['zone']; ?></option>

                                    <?}?>
                                    </select>
                                </div>


                                <div class="col-sm-3">

                                   <select class="form-control" id="state" name="state" onchange="getdivision(this.value)" >
                                    <option value="0">Select State</option>
                                    <?
                                    $state_sql = mysqli_query($con, "select * from new_state where zone= '" . $zone . "'");
                                    while ($state_sql_result = mysqli_fetch_assoc($state_sql)) {?>

                                    <option value="<?echo $state_sql_result['id'] ?>" <?php if ($state==$state_sql_result['id']) {echo "selected";}?>><?echo $state_sql_result['state']; ?></option>

                                    <?}?>

                                    </select>

                                </div>

                                <div class="col-sm-3">
                                   <select class="form-control" id="division" name="division" onchange="getdistrict(this.value)" >
                                    <option value="0">Select Division</option>
                                    <?
                                $division_sql = mysqli_query($con, "select * from new_division where state= '" . $state . "'");
                                while ($division_sql_result = mysqli_fetch_assoc($division_sql)) {?>

                                    <option value="<?echo $division_sql_result['id'] ?>"  <?php if ($division==$division_sql_result['id']) {echo "selected";}?>><?echo $division_sql_result['division']; ?></option>

                                    <?}?>

                                    </select>
                                </div>

                            </div>

                            <div class="row clearfix">
                                <div class="col-sm-3">
                                  <select class="form-control" id="district" name="district" onchange="gettaluka(this.value)" >
                                    <option value="0">Select District</option>
                                <?
                                    $district_sql = mysqli_query($con, "select * from new_district where division= '" . $division . "'");
                                    while ($district_sql_result = mysqli_fetch_assoc($district_sql)) {?>

                                    <option value="<?echo $district_sql_result['id'] ?>" <?php if ($district==$district_sql_result['id']) {echo "selected";}?>><?echo $district_sql_result['district']; ?></option>

                                    <?}?>

                                    </select>
                                </div>

                                <div class="col-sm-3">
                                    <select class="form-control" id="taluka" name="taluka" onchange="getpincode(this.value)" >
                                        <option value="0">Select Taluka</option>
                                        <?
                                $taluka_sql = mysqli_query($con, "select * from new_taluka where district= '" . $district . "'");
                                while ($taluka_sql_result = mysqli_fetch_assoc($taluka_sql)) {?>

                                    <option value="<?echo $taluka_sql_result['id'] ?>" <?php if ($taluka==$taluka_sql_result['id']) {echo "selected";}?>><?echo $taluka_sql_result['taluka']; ?></option>

                                    <?}?>
                                    </select>
                                </div>



                                <div class="col-sm-3">
                                    <select class="form-control" id="pincode" name="pincode" onchange="getvillage(this.value)" >
                                        <option value="0">Select Pincode</option>
                                    <?
                                $pincode_sql = mysqli_query($con, "select * from new_pincode where taluka= '" . $taluka . "'");
                                while ($pincode_sql_result = mysqli_fetch_assoc($pincode_sql)) {?>

                                    <option value="<?echo $pincode_sql_result['id'] ?>" <?php if ($pincode==$pincode_sql_result['id']) {echo "selected";}?>><?echo $pincode_sql_result['pincode']; ?></option>

                                    <?}?>
                                    </select>
                                </div>

                                <div class="col-sm-3">
                                  <select class="form-control" id="village" name="village" >
                                    <option value="0">Select Village</option>
                                <?$village_sql = mysqli_query($con, "select * from new_village where pincode= '" . $pincode . "'");
                                while ($village_sql_result = mysqli_fetch_assoc($village_sql)) {?>

                                    <option value="<?echo $village_sql_result['id'] ?>" <?php if ($village==$village_sql_result['id']) {echo "selected";}?>><?echo $village_sql_result['village']; ?></option>

                                    <?}?>
                                    </select>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-12 text-right">
                        <input type="submit" name="submit"  value="Update" class="btn btn-lg  btn-danger">
                    </div>
                            </div>


                    </div>
                        </div>
                    </div>
                    
                </div>

            <!-- Input -->









                          </div>



                        </div>
                    </div>
                </div>

            </div>
            </div>
        </div>

        <div style="display:flex;justify-content:center;">
            
        </div>


        </form>
    </section>




































<script>
    function getZone(country)
    {
        $.ajax({
                                    url: "changeZone.php",
                                    data: 'country=' + country,
                                    type: "POST",
                                    success: function (data) {
                                        $("#zone").html(data);
                                        $("#state").html("");
                                        $("#division").html("");
                                        $("#district").html("");
                                        $("#taluka").html("");
                                        $("#pincode").html("");
                                        $("#village").html("");

                                    }
                                });
    }
</script>
<script>

    function getState(value)
    {
        $.ajax({
                url: "getState.php",
                data: 'zone=' + value,
                type: "POST",
                success: function (respo) {

                    $("#state").html(respo);
                    $("#division").html("");
                    $("#district").html("");
                    $("#taluka").html("");
                    $("#pincode").html("");
                    $("#village").html("");
                }
            });
    }
</script>

<script>

    function getdivision(value)
    {
        $.ajax({
                url: "getdivision.php",
                data: 'state=' + value,
                type: "POST",
                success: function (respo) {

                    $("#division").html(respo);
                    $("#district").html("");
                    $("#taluka").html("");
                    $("#pincode").html("");
                    $("#village").html("");
                }
            });
    }
</script>

<script>

    function getdistrict(value)
    {
        $.ajax({
                url: "getdistrict.php",
                data: 'division=' + value,
                type: "POST",
                success: function (respo) {

                    $("#district").html(respo);
                    $("#taluka").html("");
                    $("#pincode").html("");
                    $("#village").html("");
                }
            });
    }
</script>

<script>

    function gettaluka(value)
    {
        $.ajax({
                url: "gettaluka.php",
                data: 'district=' + value,
                type: "POST",
                success: function (respo) {

                    $("#taluka").html(respo);
                    $("#pincode").html("");
                    $("#village").html("");
                }
            });
    }
</script>

<script>

    function getpincode(value)
    {
        $.ajax({
                url: "getpincode.php",
                data: 'taluka=' + value,
                type: "POST",
                success: function (respo) {

                    $("#pincode").html(respo);
                    $("#village").html("");
                }
            });
    }
</script>

<script>

    function getvillage(value)
    {
        $.ajax({
                url: "getvillage.php",
                data: 'pincode=' + value,
                type: "POST",
                success: function (respo) {

                    $("#village").html(respo);
                }
            });
    }
</script>







    <!-- Jquery Core Js -->
    <script src="../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <!--<script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>-->

    <!-- Slimscroll Plugin Js -->
    <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>

    <!-- Autosize Plugin Js -->
    <script src="../plugins/autosize/autosize.js"></script>

    <!-- Moment Plugin Js -->
    <script src="../plugins/momentjs/moment.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="../plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="../plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <script src="../js/pages/forms/basic-form-elements.js"></script>
<script src="../plugins/dropzone/dropzone.js"></script>
    <!-- Demo Js -->
    <script src="../js/demo.js"></script>
</body>
</html>
