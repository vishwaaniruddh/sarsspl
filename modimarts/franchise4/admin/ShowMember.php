<?php
session_start();
// var_dump($_SESSION['userid']);
if (!isset($_GET['id'])) {?>

    <script>
        window.location.href='https://modimart.world/franchise4/get_members.php';
    </script>

<?}
include '../config.php';

function zone_name($id)
{

    global $con;

    $sql        = mysqli_query($con, "select * from new_zone where id = '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['zone'];
}

function state_name($id)
{

    global $con;

    $sql        = mysqli_query($con, "select * from new_state where id = '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['state'];
}

function division_name($id)
{

    global $con;

    $sql        = mysqli_query($con, "select * from new_division where id = '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['division'];
}

function district_name($id)
{

    global $con;

    $sql        = mysqli_query($con, "select * from new_district where id = '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['district'];
}

function taluka_name($id)
{

    global $con;

    $sql        = mysqli_query($con, "select * from new_taluka where id = '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['taluka'];
}

function pincode_name($id)
{

    global $con;

    $sql        = mysqli_query($con, "select * from new_pincode where id = '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['pincode'];
}

function village_name($id)
{

    global $con;

    $sql        = mysqli_query($con, "select * from new_village where id = '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['village'];
}



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
$bank            = $sql_result['bank'];
$account_num     = $sql_result['account_num'];
$ifsc            = $sql_result['ifsc'];
$account_type    = $sql_result['account_type'];
$pay_option      = $sql_result['pay_option'];
$gst             = $sql_result['gst'];
$password        = $sql_result['password'];

$payable_bank = $sql_result['payable_bank'];
$amount_paid  = $sql_result['amount_paid'];
$paid_date    = $sql_result['paid_date'];
$txn_id       = $sql_result['txn_id'];
$proof_image  = $sql_result['proof_image'];

$read_agree = $sql_result['read_agreement'];

$refcode=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `franchise_referral` WHERE franchise_id='".$id."'"));
$ref_code=$refcode['ref_code'];

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
    $data[] = array(1,2,3,4,5,6,7,8,9,0,'a','b','c','d','e','f');
    $res = '';
    for ($i=0;$i<$length;$i++)
    {
        $res .= $data[rand(0,count($data))];
    }
    return $res;
}

$read_datetime = $sql_result['read_agree_date'];

$read_date = date('Y-m-d', strtotime($read_datetime));
$read_time = date('H:i:s', strtotime($read_datetime));

// echo get_image('aadhar_back',$userid);

// return;
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
        

            <input type="hidden" name="userid" value="<?echo $_GET['id']; ?>">


        <div class="container-fluid">
            <div class="block-header">
                <h2> Franchisee Application  </h2>



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


                                  <select class="form-control" name="country" disabled>
                                        <option value="1">India</option>
                                    </select>

                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control" name="zone" disabled>
                                    <?
									$zone_sql = mysqli_query($con, "select * from new_zone where id= '" . $zone . "'");
									if ($zone_sql_result = mysqli_fetch_assoc($zone_sql)) {?>

                                    <option value="<?echo $zone_sql_result['id'] ?>" selected><?echo $zone_sql_result['zone']; ?></option>

                                    <?}?>
                                    </select>
                                </div>


                                <div class="col-sm-3">

                                   <select class="form-control" name="state" disabled>
                                    <?
$state_sql = mysqli_query($con, "select * from new_state where id= '" . $state . "'");
if ($state_sql_result = mysqli_fetch_assoc($state_sql)) {?>

                                    <option value="<?echo $state_sql_result['id'] ?>" selected><?echo $state_sql_result['state']; ?></option>

                                    <?}?>

                                    </select>

                                </div>

                                <div class="col-sm-3">
                                   <select class="form-control" name="division" disabled>
                                    <?
$division_sql = mysqli_query($con, "select * from new_division where id= '" . $division . "'");
if ($division_sql_result = mysqli_fetch_assoc($division_sql)) {?>

                                    <option value="<?echo $division_sql_result['id'] ?>" selected><?echo $division_sql_result['division']; ?></option>

                                    <?}?>

                                    </select>
                                </div>

                            </div>

                            <div class="row clearfix">
                                <div class="col-sm-3">
                                  <select class="form-control" name="district" disabled>
                                <?
$district_sql = mysqli_query($con, "select * from new_district where id= '" . $district . "'");
if ($district_sql_result = mysqli_fetch_assoc($district_sql)) {?>

                                    <option value="<?echo $district_sql_result['id'] ?>" selected><?echo $district_sql_result['district']; ?></option>

                                    <?}?>

                                    </select>
                                </div>

                                <div class="col-sm-3">
                                    <select class="form-control" name="taluka" disabled>
                                        <?
$taluka_sql = mysqli_query($con, "select * from new_taluka where id= '" . $taluka . "'");
if ($taluka_sql_result = mysqli_fetch_assoc($taluka_sql)) {?>

                                    <option value="<?echo $taluka_sql_result['id'] ?>" selected><?echo $taluka_sql_result['taluka']; ?></option>

                                    <?}?>
                                    </select>
                                </div>



                                <div class="col-sm-3">
                                    <select class="form-control" name="pincode" disabled>
                                    <?
$pincode_sql = mysqli_query($con, "select * from new_pincode where id= '" . $pincode . "'");
if ($pincode_sql_result = mysqli_fetch_assoc($pincode_sql)) {?>

                                    <option value="<?echo $pincode_sql_result['id'] ?>" selected><?echo $pincode_sql_result['pincode']; ?></option>

                                    <?}?>
                                    </select>
                                </div>

                                <div class="col-sm-3">
                                  <select class="form-control" name="village" disabled>
                                <?$village_sql = mysqli_query($con, "select * from new_village where id= '" . $village . "'");
if ($village_sql_result = mysqli_fetch_assoc($village_sql)) {?>

                                    <option value="<?echo $village_sql_result['id'] ?>" selected><?echo $village_sql_result['village']; ?></option>

                                    <?}?>
                                    </select>
                                </div>
                            </div>

                            <div>
                               


                                   

                            </div>

                    </div>
                        </div>
                    </div>
                </div>

            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Applicant
                            </h2>

                        </div>
                        <div class="body">


                            <div class="row clearfix">

                                <div class="col-sm-4">

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="full_name" value="<?echo $name; ?>" class="form-control" />
                                            <label class="form-label">Full Name</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="full_name" value="<?echo $id; ?>" class="form-control" />
                                            <label class="form-label">User ID</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-4">

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="password" value="<?echo $password; ?>" class="form-control" required/>
                                            <label class="form-label">Password</label>
                                        </div>
                                    </div>

                                </div>


                            </div>



                            <div class="row clearfix">

                                <div class="col-sm-4">

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="mobile" value="<?echo $mobile; ?>" class="form-control" />
                                            <label class="form-label">Phone Number</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="email" name="email" value="<?echo $email; ?>" class="form-control" />
                                            <label class="form-label">Email Id</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                            <div class="form-line" value="<?echo $dob; ?>" id="bs_datepicker_container">
                                                <input type="text" name="dob" class="form-control" value="<?echo $dob; ?>" placeholder="Please choose Date Of Birth...">
                                                <label class="form-label">DOB</label>
                                            </div>
                                        </div>
                                </div>
                        </div>
                        </div>
                    </div>
                </div>

                          </div>

            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Payment
                            </h2>

                        </div>
                        <div class="body">
                        <form action="https://modimart.world/franchise4/Payment/RequestFpayamt.php" method="post">

                            <input type="hidden" name="merchant_param1" value="<? echo $id;?>" readonly >

                            <input type="hidden" name="billing_name" value="<? echo $name;?>" readonly hidden>


                            <input type="hidden" name="billing_tel" value="<?=$mobile?>" readonly hidden>
                            <input type="hidden" name="billing_email" value="<?=$email?>" readonly hidden>

                            

                            <input type="hidden" name="billing_address" value="<?=$location?>" readonly hidden>
                            <input type="hidden" name="billing_city" value="<?=taluka_name($taluka)?>" readonly hidden>
                            <input type="hidden" name="billing_state" value="<?=state_name($state)?>" readonly hidden>
                            <input type="hidden" name="billing_zip" value="<?=pincode_name($pincode)?>" readonly hidden>
                            <input type="hidden" name="billing_country" value="India" readonly hidden>

                            <input type="hidden" name="tid" id="tid" readonly hidden>

                            <input type="hidden" name="merchant_id" value="283837" hidden>

                            <input type="hidden" name="order_id" value="<?=time()?>" hidden>

                            <input type="hidden" name="currency" value="INR" hidden>

                            <input type="hidden" name="redirect_url" value="https://modimart.world/franchise4/Payment/ccavResponseHandler.php" readonly hidden>

                            <input type="hidden" name="cancel_url" value="https://modimart.world/franchise4/Payment/ccavResponseHandler.php" readonly hidden>

                            <input type="hidden" name="language" value="EN" readonly hidden>
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" name="amount" min="1000" value="1000" class="form-control" required />
                                            <label class="form-label">Enter Payment Amount</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                       
                                            <input type="submit" class="btn btn-danger btn-lg" value="Pay Now">
                                        
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                          </div>



                        </div>
                    </div>
                </div>



<style>

.agree_heading, .main_ol>li    {
background: #cccccc;
    padding: 5px;
    color: black;
    padding-left: 1%;
    font-size: 16px;
    font-weight: 700;
    margin: 1% auto;
    }
    .main_ol li p{
        margin:2% ;
    }
</style>



































    <style>
        .btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}

#img-upload{
    width: 100%;
}
    </style>
    <script>


    function myFunction() {
  // Get the checkbox
  var checkBox = document.getElementById("myCheck");
  // Get the output text
  var text = document.getElementById("text");

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    text.style.display = "block";
    $("#pay_bank").prop('required',true);
    $("#paid_amount").prop('required',true);
    $("#paid_date").prop('required',true);
    $("#paid_id").prop('required',true);


  } else {
    text.style.display = "none";
        $("#pay_bank").prop('required',false);
    $("#paid_amount").prop('required',false);
    $("#paid_date").prop('required',false);
    $("#paid_id").prop('required',false);
  }
}

    $(document).ready( function() {


       $(function() {

        $("#item").on('change',function() {
            var val = $('#item').val()
            var xyz = $('#items option').filter(function() {
                return this.value == val;
            }).data('xyz');
            // alert(xyz);



            $.ajax({
            type: "POST",
            url: '../get_mobile.php',
            data: 'id='+xyz,

            success:function(msg) {
            // alert(msg);
            $("#intro_mobile").val(msg);
            $("#intro_id").val(xyz);

            }
            });

        })
    })




           var member_id = '<?echo $id; ?>';
                $.ajax({
                type: "POST",
                url: '../get_tree.php',
                data: 'member_id='+member_id,

                success:function(msg) {
                // console.log(msg);
                $("#tree").html(msg);

                }
                });


                  $.ajax({
                type: "POST",
                url: '../get_child.php',
                data: 'member_id='+member_id,

                success:function(msg) {
                // alert(msg);
                $("#modal_body").html(msg);

                }
                });



    	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {

		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;

		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }

		});
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();

		        reader.onload = function (e) {
		            $('#aadharfront').attr('src', e.target.result);
		        }

		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#aadhar_front").change(function(){
		    readURL(this);
		});
	});



    $(document).ready( function() {
    	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {

		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;

		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }

		});
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();

		        reader.onload = function (e) {
		            $('#aadharback').attr('src', e.target.result);
		        }

		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#aadhar_back").change(function(){
		    readURL(this);
		});
	});



    $(document).ready( function() {
    	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {

		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;

		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }

		});
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();

		        reader.onload = function (e) {
		            $('#pass').attr('src', e.target.result);
		        }

		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#passport").change(function(){
		    readURL(this);
		});
	});



    $(document).ready( function() {
    	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {

		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;

		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }

		});
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();

		        reader.onload = function (e) {
		            $('#pancard').attr('src', e.target.result);
		        }

		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#pan_card").change(function(){
		    readURL(this);
		});
	});











    $("document").ready(function(){








var get_zone = "<?echo $_GET['zone']; ?>";
var get_state = "<?echo $_GET['state']; ?>";
var get_division = "<?echo $_GET['division']; ?>";
var get_district = "<?echo $_GET['district']; ?>";

    //   var get_taluka = <?echo $_GET['taluka']; ?>;
    //   var get_pincode = <?echo $_GET['pincode']; ?>;

       if(get_zone){
           window.onload = function(){

            $("#zone").val(get_zone);

            var state_id = get_state;
                 $.ajax({
                    type: "POST",
                    url: 'get_state.php',
                    data: 'zone_id='+get_zone,
                    success:function(msg) {
                // document.getElementById("division").innerHTML = '<option value="">Disivion</option>';
                // document.getElementById("district").innerHTML = '<option value="">District</option>';
                // document.getElementById("taluka").innerHTML = '<option value="">Taluka</option>';
                // document.getElementById("pincode").innerHTML = '<option value="">Pincode</option>';
                // document.getElementById("village").innerHTML = '<option value="">Village</option>';

                        $("#state").html(msg);
                        $("#state").val(get_state);
                    }
                });
            }
       }

            setTimeout(function(){



                if(get_state){



                $.ajax({
                    type: "POST",
                    url: 'get_division.php',
                    data: 'state_id='+get_state,
                    success:function(msg) {

                    $("#division").html(msg);
                    $("#division").val(get_division);

                    }
                });

      }


    }, 1500);


                    setTimeout(function(){



                if(get_division){



                $.ajax({
                    type: "POST",
                    url: 'get_district.php',
                    data: 'division_id='+get_division,
                    success:function(msg) {


                        // alert(msg);
                    // document.getElementById("district").innerHTML = '<option value="">District</option>';
                    // document.getElementById("taluka").innerHTML = '<option value="">Taluka</option>';
                    // document.getElementById("pincode").innerHTML = '<option value="">Pincode</option>';
                    // document.getElementById("village").innerHTML = '<option value="">Village</option>';


                    $("#district").html(msg);
                    $("#district").val(get_district);
                    }
                });

      }


    }, 2500);



       setTimeout(function(){
            if(get_district){



                $.ajax({
                    type: "POST",
                    url: 'get_taluka.php',
                    data: 'district_id='+get_district,
                    success:function(msg) {
                    $("#taluka").html(msg);
                    $("#taluka").val(get_taluka);
                    }
                });

      }


    }, 3500);










       $("#zone").on('change',function(){
             var zone_id = $("#zone").val();
             $.ajax({

                type: "POST",
                url: 'get_state.php',
                data: 'zone_id='+zone_id,
                success:function(msg) {

                document.getElementById("state").innerHTML = '<option value="">State</option>';
                document.getElementById("division").innerHTML = '<option value="">Disivion</option>';
                document.getElementById("district").innerHTML = '<option value="">District</option>';
                document.getElementById("taluka").innerHTML = '<option value="">Taluka</option>';
                document.getElementById("pincode").innerHTML = '<option value="">Pincode</option>';
                document.getElementById("village").innerHTML = '<option value="">Village</option>';

                    $("#state").html(msg);

                     $("#state").val('1').attr('selected','selected');

                }
            });

         });


         $("#state").on('change',function(){
             var state_id = $("#state").val();
             $.ajax({
                type: "POST",
                url: 'get_division.php',
                data: 'state_id='+state_id,
                success:function(msg) {

            document.getElementById("division").innerHTML = '<option value="">Disivion</option>';
            document.getElementById("district").innerHTML = '<option value="">District</option>';
            document.getElementById("taluka").innerHTML = '<option value="">Taluka</option>';
            document.getElementById("pincode").innerHTML = '<option value="">Pincode</option>';
            document.getElementById("village").innerHTML = '<option value="">Village</option>';


                    $("#division").html(msg);
                }
            });
         });


         $("#division").on('change',function(){
             var division_id = $("#division").val();
             $.ajax({

                type: "POST",
                url: 'get_district.php',
                data: 'division_id='+division_id,
                success:function(msg) {


            document.getElementById("district").innerHTML = '<option value="">District</option>';
            document.getElementById("taluka").innerHTML = '<option value="">Taluka</option>';
            document.getElementById("pincode").innerHTML = '<option value="">Pincode</option>';
            document.getElementById("village").innerHTML = '<option value="">Village</option>';



                    $("#district").html(msg);
                }
            });
         });


          $("#district").on('change',function(){
             var district_id = $("#district").val();
             $.ajax({

                type: "POST",
                url: 'get_taluka.php',
                data: 'district_id='+district_id,
                success:function(msg) {


            document.getElementById("taluka").innerHTML = '<option value="">Taluka</option>';
            document.getElementById("pincode").innerHTML = '<option value="">Pincode</option>';
            document.getElementById("village").innerHTML = '<option value="">Village</option>';



                    $("#taluka").html(msg);
                }
            });
         });

      $("#taluka").on('change',function(){
             var taluka_id = $("#taluka").val();
             $.ajax({

                type: "POST",
                url: 'get_pincode.php',
                data: 'taluka_id='+taluka_id,
                success:function(msg) {



            document.getElementById("pincode").innerHTML = '<option value="">Pincode</option>';
            document.getElementById("village").innerHTML = '<option value="">Village</option>';


                    $("#pincode").html(msg);
                }
            });
         });



      $("#pincode").on('change',function(){
             var pincode_id = $("#pincode").val();
             $.ajax({

                type: "POST",
                url: 'get_village.php',
                data: 'pincode_id='+pincode_id,
                success:function(msg) {

            document.getElementById("village").innerHTML = '<option value="">Village</option>';

                    $("#village").html(msg);
                }
            });
         });


    });




        $("#basic_checkbox_1").on('click',function(){
              $("#basic_checkbox_2").removeAttr('checked');

        });
         $("#basic_checkbox_2").on('click',function(){
              $("#basic_checkbox_1").removeAttr('checked');
        });



//         $("#form").submit(function(e) {


//             if($("#basic_checkbox_2").is(':checked') || $("#basic_checkbox_1").is(':checked')){
//                 return true;

//               }
//     alert("Please select at least one to upgrade.");
//     return false;
// });


</script>


<?
if ($read_agree == 0) {?>
    <script>

        $("#form").submit(function(e) {


            if($("#basic_checkbox_agree").is(':checked')){
                return true;

              }
            alert("You can not become Franchisee of modimart.world till you accept the Franchisee Agreement.");
            return false;
});



    </script>

<?}?>

<script>
    function createRef(id)
    {
         if(id!=''){
            $(".page-loader-wrapper").show();
         $.ajax({
                url: "https://www.modimart.world/franchise4/admin/creatMemref.php",
                data: 'memcode=' + id,
                type: "POST",
                success: function (data) {
                   // alert(data);
                    $(".page-loader-wrapper").show();
                   location.reload();
                }
            });
    }
}
</script>
<script>
function CopyFun() {
  var copyText = document.getElementById("refcode");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  // alert("Copied the text: " + copyText.value);
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
