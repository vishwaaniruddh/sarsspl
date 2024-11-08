<?php
session_start();
if (!isset($_SESSION['mem_id']) && !isset($_SESSION['username'])) {
    ?>

    <script>
        window.location.href='https://www.modimart.world/franchise/get_members.php';
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

$branch            = $sql_result['branch'];
$bank            = $sql_result['bank'];
$account_num     = $sql_result['account_num'];
$ifsc            = $sql_result['ifsc'];
$account_type    = $sql_result['account_type'];
$account_holdername    = $sql_result['account_holdername'];
$pay_option      = $sql_result['pay_option'];
$gst             = $sql_result['gst'];
$password        = $sql_result['password'];

$payable_bank = $sql_result['payable_bank'];
$amount_paid  = $sql_result['amount_paid'];
$paid_date    = $sql_result['paid_date'];
$txn_id       = $sql_result['txn_id'];
$proof_image  = $sql_result['proof_image'];
$status  = $sql_result['status'];

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
    <title>Edit Profile | Modi Mart</title>
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
        <form id="form" action="process_member_edit.php" method="post" enctype="multipart/form-data">

            <input type="hidden" name="userid" value="<?echo $_GET['id']; ?>">


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
                                <button id="trees" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-original-title ="<?echo $id; ?>" data-target="#myModal1">View Tree</button> |
                                <button id="introduced_to" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-original-title ="<?echo $id; ?>" data-target="#myModal">Introduced To</button>
                              
                                <?

$check_sql = mysqli_query($con, "SELECT * FROM `new_member` where (pan <> '' OR gst <> '' OR adhar_card <> '') and id='" . $userid . "' and location <> '' and status=1");

if ($check_sql_result = mysqli_fetch_assoc($check_sql)) {
    echo $check_sql_result['level_id'];

    if ($check_sql_result['level_id'] <= 8) {?>

        <a class="btn btn-info btn-lg" target="_blank" href="https://modimart.world/franchise/bill/pdf/bill.php?id=<?echo $userid ?>">Franchise Invoice</a>
    <?}

   }?>
    <?php if(isset($_SESSION["username"])){ ?>
     | <a class="btn btn-info btn-lg"  href="Update_Member_Place.php?id=<?=$userid?>">
                                    Change Member Place
                                </a>
    <?php }?>



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

                                <div class="col-sm-8">

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


                        <div class="row clearfix">

                            <div class="col-sm-6">

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="cast" value="<?echo $cast; ?>" class="form-control" />
                                            <label class="form-label">Cast</label>
                                        </div>
                                    </div>

                            </div>


                            <div class="col-sm-6">
                                    <div class="form-group form-float">
                                            <div class="form-line" id="bs_datepicker_container">
                                                <input type="text" name="anniversary" class="form-control" value="<?echo $anniversary; ?>" placeholder="Please choose Anniversary Date...">
                                                <label class="form-label">Anniversary</label>
                                            </div>
                                        </div>
                                </div>

                        </div>


                        <div class="row clearfix">

                            <div class="col-sm-6 demo-radio-button">

                                    <label>Gender</label>
                                    <div class="form-group">
                                        <input name="gender" value="male" type="radio" id="radio_1" <?if ($gender == 'male') {echo 'checked';} if($gender=='') { echo "checked";}?> />
                                        <label for="radio_1">Male</label>
                                        <input name="gender" value="female" type="radio" id="radio_2" <?if ($gender == 'female') {echo 'checked';}?> />
                                        <label for="radio_2">Female</label>
                                    </div>
                                </div>

                            <div class="col-sm-6 demo-radio-button">

                                    <label>Marrital Status</label>
                                    <div class="form-group">
                                        <input name="marrital_status" value="married" type="radio" id="radio_3" <?if ($marrital_status == 'married') {echo 'checked';} if($marrital_status=='') { echo "checked";}?> />
                                        <label for="radio_3">Married</label>
                                        <input name="marrital_status" value="unmarried" type="radio" id="radio_4" <?if ($marrital_status == 'unmarried') {echo 'checked';}?> />
                                        <label for="radio_4">Unmarried</label>
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
                                Referral Code
                            </h2>

                        </div>
                        <div class="body">

                            <div class="row clearfix">
                              <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <?php 
                                            if ($ref_code!='') {
                                                ?>
                                                <input type="text" name="reflink" value="https://modimart.world?rf=<?=$ref_code?>" id="refcode" class="form-control" readonly/>
                                                <label class="form-label">Referral link</label>
                                                <?php                                                 
                                             } else {
                                                 ?>
                                                 <input type="text" name="reflink" value="" class="form-control" />
                                                 <label class="form-label">Referral link</label>
                                                 <?php
                                             }
                                              ?>
                                            
                                        </div>
                                    </div>

                                </div>
                             <div class="col-sm-2">
                                    <div class="form-group form-float">

                                        <?php if ($ref_code!='') {
                                            ?>
                                            <a class="btn btn-success" onclick="CopyFun()" >Copy Code</a>
                                            <?
                                        } else {
                                            ?>
                                            <a class="btn btn-success" onclick="createRef(<?=$id?>)">Create Referral</a>
                                            <?php
                                        }
                                         ?>
                                        
                                            
                                        
                                    </div>

                                </div>
                                 <?php if (isset($_SESSION['username'])) {?>
                            <div class="col-sm-6 demo-radio-button">

                                    <label>Active Status</label>
                                    <div class="form-group">
                                        <input name="user_status" value="1" type="radio" id="radio_5" <?if ($status == '1') {echo 'checked';} ?> />
                                        <label for="radio_5">Active</label>
                                        <input name="user_status" value="0" type="radio" id="radio_6" <?if ($status == '0') {echo 'checked';}?> />
                                        <label for="radio_6">Disactive</label>
                                        <input name="user_status" value="2" type="radio" id="radio_7" <?if ($status == '2') {echo 'checked';}?> />
                                        <label for="radio_7">Waiting</label>
                                    </div>
                            </div>
                        <?php }else { ?>
                            <input type="hidden" value="<?=$status?>" name="user_status">
                        <?php } ?>

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
                                Introducer
                            </h2>

                        </div>
                        <div class="body">

                            <div class="row clearfix">
                                <div class="col-sm-4">

                                    <div class="form-group form-float">
                                        <div class="form-line">


                                        <input list="items" id="item" name="intro_name" class="form-control" value="<?echo $introducer_name; ?>">

                                        <datalist id="items">
                                        <?$sql = mysqli_query($con, "select * from new_member where status=1");

                                        while ($sql_result = mysqli_fetch_assoc($sql)) {

                                            $name = $sql_result['name'];
                                            $id   = $sql_result['id'];?>

                                            <option value="<?echo $name; ?>"  data-xyz = "<?echo $id; ?>" >

                                        <?}?>

                                           </datalist>


                                            <!--<input type="text" name="intro_name" value="<?echo $introducer_name; ?>" class="form-control" />-->
                                            <label class="form-label">Introducer Name</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-4">

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="intro_mobile" id="intro_mobile" value="<?echo $introducer_mobile; ?>" class="form-control" />
                                           
                                            <label class="form-label">Introducer Mobile</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input class="form-control" type="text" id="intro_id" value="<?=$intro_id?>" name="intro_id">
                                            <label class="form-label">Introducer ID</label>
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
                                Bank Info
                            </h2>

                        </div>
                        <div class="body">

                            <div class="row clearfix">
                                <div class="col-sm-4">

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="pan" value="<?echo $pan; ?>" class="form-control" />
                                            <label class="form-label">Pan Card Number</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-4">

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="adhar_card" value="<?echo $adhar_card; ?>" class="form-control" />
                                            <label class="form-label">Adhar Card Number</label>
                                        </div>
                                    </div>

                                </div>


                            <div class="col-sm-4">

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="gst" value="<?echo $gst; ?>" class="form-control" />
                                            <label class="form-label">GST</label>
                                        </div>
                                    </div>

                                </div>




                            </div>


    <div class="row clearfix">
    <div class="col-sm-3">

        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" name="bank" value="<?echo $bank; ?>" class="form-control" />
                <label class="form-label">Bank Name</label>
            </div>
        </div>

    </div>
    <div class="col-sm-3">

        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" name="branch" value="<?echo $branch; ?>" class="form-control" />
                <label class="form-label">Branch Name</label>
            </div>
        </div>

    </div>
    <div class="col-sm-3">

        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" name="account_holdername" value="<?echo $account_holdername; ?>" class="form-control" />
                <label class="form-label">Account Holder Name</label>
            </div>
        </div>

    </div>

    <div class="col-sm-3">

        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" name="account_num" value="<?echo $account_num; ?>" class="form-control" />
                <label class="form-label">Account Number</label>
            </div>
        </div>

    </div>

    <div class="col-sm-3">

        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" name="ifsc" value="<?echo $ifsc; ?>" class="form-control" />
                <label class="form-label">IFSC Number</label>
            </div>
        </div>

    </div>


  <div class="col-sm-3">

        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" name="account_type" value="<?echo $account_type; ?>" class="form-control" />
                <label class="form-label">Bank Account Type</label>
            </div>
        </div>

    </div>

</div>

<div class="row clearfix">
    <div class="col-sm-12 demo-radio-button">

        <label>Payment Option</label>
        <div class="form-group">

        <?
if ($level_id < 8 && $level_id > 0) {?>
            <input name="pay_option" value="p" type="checkbox" <?if ($mem_status == 'p') {echo 'checked';}?>/>
            <label for="myCheck">Rs 5000/- NON REFUNDABLE</label>
        <?}
if ($level_id == 8) {?>
            <input name="pay_option" value="p" type="checkbox" <?if ($mem_status == 'p') {echo 'checked';}?>/>
            <label for="myCheck">Rs 1000/- NON REFUNDABLE</label>
        <?}

?>



        </div>
    </div>

<div id="text" >
<div class="row clearfix">
    <div class="col-sm-3">
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" value="<?echo $payable_bank; ?> " name="pay_bank" id="pay_bank" class="form-control" />
                    <label class="form-label">Payable Bank<span class="required">*</span></label>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" name="paid_amount" value="<?echo $amount_paid; ?>" id="paid_amount" class="form-control" />
                    <label class="form-label">Amount Paid<span class="required">*</span></label>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
        <div class="form-group form-float">
            <div class="form-line" id="bs_datepicker_container">
                <input type="text" name="paid_date" id="paid_date" value="<?echo $paid_date; ?>" class="form-control" />
                <label class="form-label">Paid Date<span class="required">*</span></label>
            </div>
        </div>
        </div>
        <div class="col-sm-3">
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" value="<?echo $txn_id; ?>" name="paid_id" id="paid_id" class="form-control"/>
                <label class="form-label">Transaction Id / UPI Paid Id<span class="required">*</span></label>
            </div>
        </div>
        </div>

        </div>


<div class="col-md-6">
<div class="form-group">
<label class="form-label">Paid Proof</label>
<div class="form-line">
<input type="file" name="paid_proof" class="form-control" />

</div>
</div>
</div>

<div class="col-md-6">
<div class="form-group">


<?
if ($proof_image) {?>

<img src="<?echo $proof_image; ?>">
<?} else {
    echo 'No Proof Uploaded ! ';
}
?>
</div>

</div>


        </div>

</div>
    <br>
<h4 style="text-align:center;">You have accepted the Franchisee Agreement on <?echo $read_date; ?>: <?echo $read_time; ?> <?php if($read_agree){ ?> <a href="https://modimart.world/invoice/genagreement.php?id=<?=$userid ?>" class="btn btn-success">Download Agreement</a> <?php } ?></h4>

<br>
<br>

<div class="row clearfix">
<div class="col-sm-3">
<div class="form-group">

    <label>Passport Size Photo</label>
<div class="input-group">
<span class="input-group-btn">
<span class="btn btn-default btn-file">
Browse… <input type="file" name="passport" id="passport">
</span>
</span>
<input type="text" class="form-control" readonly>
</div>
<img id='pass' <?if (get_image('passport', $userid)) {echo "src=" . get_image('passport', $userid);}?>>



</div>

</div>

<div class="col-sm-3">
<div class="form-group">

<label>Aadhar Card Front</label>
<div class="input-group">
<span class="input-group-btn">
<span class="btn btn-default btn-file">
Browse… <input type="file" name="aadhar_front" id="aadhar_front">
</span>
</span>
<input type="text" class="form-control" readonly>
</div>
<img id='aadharfront' <?if (get_image('aadhar_front', $userid)) {echo "src=" . get_image('aadhar_front', $userid);}?>>



</div>

</div>

<div class="col-sm-3">
<div class="form-group">




<label>Aadhar Card Back</label>
<div class="input-group">
<span class="input-group-btn">
<span class="btn btn-default btn-file">
Browse… <input type="file" name="aadhar_back" id="aadhar_back">
</span>
</span>
<input type="text" class="form-control" readonly>
</div>
<img id='aadharback' <?if (get_image('aadhar_back', $userid)) {echo "src=" . get_image('aadhar_back', $userid);}?>>




</div>

</div>


<div class="col-sm-3">
<div class="form-group">


<label>Pan Card Photo</label>
<div class="input-group">
<span class="input-group-btn">
<span class="btn btn-default btn-file">
Browse… <input type="file" name="pan_card" id="pan_card">
</span>
</span>
<input type="text" class="form-control" readonly>
</div>
<img id='pancard' <?if (get_image('aadhar_back', $userid)) {echo "src=" . get_image('pan_card', $userid);}?>>

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




















<?
if ($read_agree == 0) {

    ?>




                            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Agreement
                            </h2>

                        </div>
                        <div class="body">

    <div class="row clearfix">
        <div class="col-sm-12" style=" height: 500px; overflow: scroll;">

            <p style="text-align:center" class="agree_heading">Date</p>

<p>
    This Agreement is dated the <u><?echo date('d'); ?></u> day of <u><?echo date("F", strtotime(date('Y-m-d'))); ?></u>, <u><?echo date('Y'); ?></u>.
</p>

<p style="text-align:center" class="agree_heading"> Parties </p>

<ol>
    <li>
M/S Modimart Ecommerce LLP, a limited liability partnership through its Partner- Mr. Rajesh Modi, having its office at- Office Building No 2, Pragati Society, Near Pancholia School, Mahavir Nagar, Kandivali West Mumbai 400067. Maharashtra. (Hereinafter referred to as the “Franchisor”, which expression shall mean and include its successors and assigns) of the One Part;

       and
    </li>



<li>
    Mr./Mrs./Ms. <Full Name>, having its residence at- <full address> (Hereinafter referred to as the “Franchisee”, which expression shall mean and include its successors and assigns) of the Two Part).
</li>
</ol>

<p style="text-align:center" class="agree_heading">Recitals</p>

<ol type="A">


<li>
    The franchisor has developed a platform where buyers can buy products and sellers can list and sell their products. The platform is in the form of e-commerce website with the domain name of – http://www.modimart.world
</li>

<li>
    The Franchisor has though of a hierarchy where Franchisees would be appointed at various levels of hierarchy to perform certain roles and responsibilities including to promote, build and manage the buyer as well as seller network. The Franchisor has established a business and has developed strategies, methods, systems and branding for a Franchise System.
</li>

<li>
    The Franchisee wishes to use the Franchise System for the operation of a business as the franchisee.
</li>

<li>
    The Franchisor has agreed to grant the Franchisee, and the Franchisee has agreed to accept a Franchise, on the terms and conditions of this Agreement.
</li>

<li>
    The Franchisor has agreed to appoint the Franchisee as “LEVEL NAME” position/designation which can be changed from time to time by the Franchisor.
</li>
</ol>



<p style="text-align:center">IT IS AGREED as follows:</p>

<ol class="main_ol">
<li>
    Interpretation
</li>

	In this Agreement, unless the context otherwise requires:
<ol type="a">
    <li>“Person” includes an individual only;</li>
    <li>“Personnel” includes a party’s, employees, contractors or agents;</li>
    <li>words stating the plural number include the singular number and vice versa;</li>
    <li>words stating one gender include every gender;</li>
    <li>any reference to any of the parties includes that party’s executors, administrators or permitted assigns and its successors;</li>






<li>a reference to a clause is a reference to a clause in this Agreement;</li>
	<li>Clause headings are inserted for convenience only and will not be construed to limit or extend the scope of a clause;</li>
<li>a reference to month means calendar month;</li>
<li>a reference to year means each successive period of twelve months following the Commencement Date;</li>
<li>a reference to any monetary value is a reference to the Indian Rupee (INR);</li>
<li>a reference to an Annexure or Schedule is a reference to the corresponding Annexure or Schedule to this Agreement;</li>
<li>a reference to a statute includes all regulations under, and amendments to, that statute and any statute passed in substitution for that statute or incorporating any of its provisions to the extent they are incorporated;</li>
<li>where the day on or by which any act or thing is to be done is not a Business Day, that act or thing must be done on or by the next following Business Day;</li>
<li>where any word or expression is defined in this Agreement, any other part of speech, grammatical form, singular or pluralised form of that word or expression will have a corresponding meaning</li>

</ol>

<li>Definitions</li>

<p>In this Agreement (including the Introduction):</p>
<p><b>“Associations”</b> means the industry associations or groups applicable to the industry or industry in which the franchise operates;</p>
<p><b>“Approved Apparel”</b> means clothing or uniforms that are deemed acceptable by the Franchisor or specified from time to time by the Franchisor;</p>
<p><b>“Authority” </b>means any municipal, and state authorities, Central, State or Local Government, Central or State or Local Government departments, authorities, statutory corporations, statutory bodies or any other bodies or boards with authority in relation to the Business;</p>
<p><b>“Brand Identification”</b> means the registered or unregistered trade names, trademarks, service marks, branding, brand identity, Marks, Business Name, colors, logos or as may at any time be used by the Franchisor and approved for use by the Franchisee in relation to the Branding and customer recognition of the Franchise System;</p>
<p><b>“Brand Image”</b> means the graphical image for the Franchise System comprising the Business Name, Branding, Marks, Logo, color schemes, font, designs, web page, layout, stationary, signage, uniforms and livery defined in the Operations Manuals or Branding Manuals or as otherwise stipulated by the Franchisor at any time;</p>
<p><b>“Business Day” </b>means any day other than a public holiday;
<p><b>“Commencement Date”</b> means the date of commencement of the business by the Franchisee;</p>
<p><b>“Commission”</b> means the amount earned by the Franchisee directly and indirectly by the sale of the product promoted by them or other franchisee who reports to the franchisee whereas such amount is payable by the Franchisor with terms and conditions applicable;</p>
<p><b>“Confidential Information”</b> means all information relating to financial information; accounting procedures; techniques; intellectual property or information ;trade secrets or other data; specifications, processes, patents, techniques, inventions, systems; planning or marketing procedures; know-how, identity of supplier and customers; the contents of any Manuals; the terms and conditions of this Agreement; all commercially valuable information regarding the current or future business interests or affairs of the Franchisor and Franchise and its related businesses, or any person or entity with which the Franchisor deems confidential. All such information, in whatever such form it may take or be recorded or stored or disseminated and whether originated by the Franchisor or any other party;</p>
<p><b>“Equipment”</b> means the list of equipment’s communicated by the franchisor or its team for the set-up and the business of franchise</p>
<p><b>“Equipment Fee”</b> means the fee for the supply of the Equipment to the Franchisee</p>
<p><b>“Franchise”</b> means a license to conduct a business using the System within the terms and conditions of this agreement and defined within (but not limited to) the Franchise Model and Manuals;</p>
<p><b>“Franchise Fee”</b> means the monetary amount which must be paid to the Franchisor by the Franchisee on the terms set out in this agreement for the granting and use of the Franchise, being the amount and payment terms set out and such amount shall always be non-refundable as well as non-adjustable under any and every circumstances.</p>
<p><b>“Franchisor”</b> means the Franchisor and Franchisor’s business.</p>
<p><b>“Implementation Staff”</b> means the person or persons instructed by the Franchisor to undertake training and assistance with the initial set up and commencement of the Franchisee’s Business;</p>
<p><b>“Initial Training Fee”</b> means the amount paid by the Franchisee to the Franchisor for the initial training;</p>
<p><b>“Invoiced Price”</b> means the price stated in any invoice or any statement issued by the Franchisor to the Franchisee for goods or services supplied by the Franchisor to the Franchisee;</p>
<p> <b>“Know-How”</b> means all information, technology, patents, knowledge and experience, procedures, intellectual property, patents, databases, industry knowledge, techniques, procedures and systems relating to the Franchise System: </p>
<p><b>“Manuals” </b>means the Franchise Model Manuals for the System and Operation of the Franchise Model;</p>
<p><b>“Penalty Interest Rate”</b> means the interest rate.</p>
<p><b>“Personnel”</b> means the staff and employees who will be performing the services or involved in the Franchise Business;</p>
<p><b> “Premise or Location”</b> means a site or location used by the Franchisee in conducting the Business as the place of business for the particular franchise;</p>
<p><b>“Proprietary Rights”</b> means all statutory or common law rights in any trademarks, brand identification, brand image, copyright, trade secrets, designs, patents, confidential information and any goodwill;</p>
<p><b>“Renewal Fee”</b> means the amount payable to the Franchisor by the Franchisee when renewing this agreement;</p>
<p><b>“Renewal Term”</b> means the period (no. of years) for which the agreement would be extended with same terms and conditions or altered as per the discretion of franchisor;</p>
<p><b>“Sales”</b> means any product sold from the platform with direct effort of the Franchisee or effort of the other franchisees below it as per the hierarchy decided by the Franchisor.</p>
<p><b>“Sales Target”</b> means the target level of sales specified by the franchisor on regular basis but, not necessarily to be a duty of franchisor to provide.</p>
<p><b>“Software”</b> means the computer software or mobile app or subsequent updates supplied by the Franchisor or third party for use in the Franchise Business</p>
<p><b>“Stationery”</b> means all forms, invoice forms, letterhead, business cards, signage, livery, receipt forms, branded material, both in tangible form or stored or disseminated electronically or other printed material for use in the Business;</p>
<p><b>“System”</b> means the system for the operation of the Franchise Business which includes the use of the Business Name, the Brand Image, Brand Identification, Know-How, Intellectual Property and Products;</p>
<p><b>“Tax”</b> means any tax levy or charge of any nature whatsoever imposed by any authority on any payment and sales made by the Franchisee and includes, without limitation, any goods and service tax other tax even local taxes as applicable from time to time.</p>
<p><b>“Term”</b> means the period of time or tenure counted from the Commencement Date;</p>
<p><b>“Territory”</b> means the geographic area specified.</p>
<p><b>“Training Programme”</b> means the training to be undertaken by the Franchisee and the Franchisee employees in the operation of a Franchise;</p>
<p><b>“Vehicle” </b>means any vehicle used by the Franchisee in conducting the Business;</p>
<p><b>“Works”</b> means any installation, refurbishing, repairs, maintenance, sign writing, painting or other work needed to ensure the Premises and Vehicle conform to the Brand Image and Brand Identification of the Franchise or with the requirements of any Authority.</p>



<li>
    Grant of Franchise License
</li>

<p>	3.1 Grant of License</p>

<p>
    	The Franchisee is granted an exclusive license, subject to the terms and conditions of this Agreement, by the Franchisor to:
</p>

<ol type="a">
<li>
    operate the Business within the Territory as defined; and
</li>
<li>
    use the trade names, brand identification and brand image; and
</li>
<li>
    use the Franchisor’s copyright, material, know-how, knowledge etc; and
</li>
<li>
    use the benefit of the Franchisor’s expertise, knowledge and marketing experience.
</li>
</ol>

<p>3.2	Registered License Agreement</p>
	<p>The Franchisee shall enter into a Registered License Agreement if required by the Franchisor.</p>



<li>Exclusive Position in a Territory</li>

<p>The Franchisee is granted an exclusive license to operate the Business with a Designation and in Capacity which is assigned and subject to change in the territory defined in the Franchise Manual. The exclusivity of territory shall be limited upto and within the said territory limits for the said position only and Franchisor may appoint other franchisee for different position within the said territory</p>

<p>
    The position/designation shall be given based on performance and can be changed from time to time as per the sole discretion of the franchisor.
</p>

<p>
    During the tenure of the exclusivity period, the Franchisor shall not appoint for the same position inside the exclusive territory of the franchisee. The franchisee may loose the exclusivity of the position in the said territory for non-performance and breach of any clause of this agreement or franchise manual. Such decision shall be at sole discretion of the Franchisor and the Franchisor is not answerable or not liable to explain or justify any reason for its decision.
</p>


<li>
    Commercials
</li>

<ol>
    <li><b>Payments upon Signing</b></li>

<p>The Franchisee must, on or before the signing of this Franchise Agreement pay the non-refundable Franchise Fee of INR 5,000 (Rupees Five Thousand) including GST as applicable to the Franchisor.</p>

<li><b>Local Advertising/Marketing Fees</b></li>
<p>
    The Franchisee is required to conduct all marketing, advertising and promotion for its franchise as well as for people under them in the hierarchy system. Such marketing, advertising and promotion shall be done after approval of the Franchisor.
</p>

<li><b>Additional Charges, Levies and Taxes</b></li>
<p>
    The Franchisee shall be responsible for any and all taxes, sales taxes, duties, bank fees, levies, charges or commissions of any nature whatsoever imposed by an Authority and are additional to the amounts specified in this agreement or resulting from this agreement.
</p>
<li><b>Interest</b></li>
<p>
    Any monies owed to the Franchisor by the Franchisee and not paid on the due date for payment will incur an interest rate as specified in various clauses of this agreement or 1% to be calculated daily, whichever is higher and shall continue to accrue until payment is received in full by the Franchisor.
</p>
</ol>

<li>
    Franchise Term and Renewal
</li>

<ol>
    <li><b>Timely Commencement</b></li>
    <p>The Franchisee must commence the Business within 1 day/s from the date of this agreement and if any extension to this date, than the franchisee shall ask the franchisor in writing and franchisor shall on its discretion shall approve or disapprove.</p>

    <li><b>Agreement Term</b></li>
<p>Subject to the Franchisee’s continuing compliance with the Franchisee obligation under this Agreement, the Franchisee will conduct the Business for the Term of 5 (five) years commencing from the date of signing this agreement.</p>
<li><b>Renewal Option</b></li>
<p>
Should the Franchisee not at any time during the Term (including any notice period) be in default of any of the provisions of this Agreement, The Franchisee may renew this Agreement for the Renewal Term of 5 (five) years. Should the Franchisee wish to renew the Agreement then the Franchisee must give the Franchisor no less than six (6) months and no more than twelve (12) months written notice of the Franchisee’s intention to renew prior to the expiry date of the Term.

</p>
<li><b>Renewal Conditions</b></li>
<p> To exercise the option referred to in Clause 5.3, the Franchisee must comply with each of the following conditions prior to the expiry of the Term: </p>

<ol type="a">
<li>	no later than fifteen (15) Business Days after receipt of the Franchisor’s standard agreement (which Franchise agreement may contain different terms and conditions to those set out in this Agreement) execute and return the agreement to the Franchisor; and</li>
<li>Pay the applicable Renewal Fee of <span style="background:yellow;">INR 5,000 (Rupees Five Thousand) plus applicable taxes</span> to be paid to the Franchisor towards documentation and administrative charges; and</li>
<li>get Training, carry out all Works as are reasonably necessary (or reasonably required by the Franchisor) to ensure the Business meets the current Image for the System.    </li>
</ol>

<li><b>Renewal Agreement</b></li>
	<p>
	    The Franchisee acknowledges that any renewal agreement between the parties may differ significantly in all respects from the terms and conditions appearing in this Agreement due to further development of the System, changes in economic and business conditions or for any other reasons whatsoever.
	</p>
</ol>


<li>
    Franchise Manuals
</li>
<p>The franchisor has a right to introduce at any given point of time, the Manuals containing information relating to business practices, standards, specifications, use of stationery, procedures, training, the Business Name, Branding Image, Branding Identification and Business Systems at any time by the for the operation of the Business and the franchisee has abide by it. The Franchisee must operate the Business strictly in accordance with the processes, policies, instructions and standards as specified by franchisor.</p>

 <ol type="1">
<li> <b>Ownership of Manuals</b></li>
<p>The Franchisor will retain proprietary ownership of the Manuals including the intellectual property contained within the Manuals including the Business Name, Branding Image, Branding Identification and Business Systems and Know-How. </p>
<li> <b>Franchisee Compliance</b></li>
<p>The Franchisee must comply and must ensure its personnel comply with all of the business practices, standards, specifications, rules, regulations, responsibilities, task, roles, procedures and obligations set out in the Manuals.</p>
<li> <b>Conflict of Provisions</b></li>
<p>The provisions of this Agreement will prevail should there be any conflict between the provisions of this Agreement and the provisions of the Manuals, </p>
<li> <b>Right to Vary Manuals</b></li>
<p>The Franchisor has the right to amend, vary and revise the contents of the Manuals at any time and in any manner as the Franchisor in its absolute discretion sees fit. Should the Franchisor wish to vary, amend or revise the Manuals, then the Franchisor will advise the Franchisee of any variations, amendments or revisions in writing by instruction to the Franchisee and by supplying the Franchisee a copy of any variations, amendments or revisions to be inserted into the Manuals.</p>
<li><b> Variation Effective After Three Days</b></li>
<p>Any variations, amendments or revisions to the Manuals will be deemed to be effective immediately in <span style="color:blue;">(1) Business Day/s</span> after the Franchisor has notified the Franchisee, unless the Franchisor specifies a later effective date in such notice.</p>
<li><b>Innovations</b></li>
<p>The Franchisee agrees to promptly disclose to the Franchisor all Innovations to the Systems defined in the Manuals, whether or not protectable intellectual property and whether created by or for the Franchisee or employees. All Innovations will be deemed the Franchisors sole and exclusive property and works made-for-hire for the Franchisor. The Franchisor has the right to incorporate Innovations into the System and may use them and authorise the Franchisee and others to use them in the operation of the Business. Innovations will then also constitute Confidential Information. The Franchisor will disclose to the Franchisee the Innovations that are made a part of the System. To the extent any Innovation does not qualify as a work made-for-hire for the Franchisor, the Franchisee assigns ownership of that Innovation, and all intellectual property and other rights to the Innovation, to the Franchisor and agrees to sign and deliver such instruments and documents, and provide such assistance and perform such other acts as the Franchisor periodically designate in order for the Franchisor or its designee to obtain exclusive rights in such Innovations. The Franchisor will have no obligation to make any lump sum or other payments to the Franchisee or any other person with respect to any such Innovations. The Franchisee will not use, nor will allow any other person to use, any such Innovations, whether in connection with the Facility or otherwise, without obtaining our prior written approval.     </p>
 </ol>



<li>Equipment</li>

<p>The Franchisee must have a Smartphone with Whatsapp, Telegram and Gmail accounts along with fast internet and video calling function supported by an Android application as directed by the Franchisor from time to time.</p>

<li>
	Primary Role of Franchisee
</li>
<ol>

<li> <b>Introduce New Franchisee</b></li>
<p>Franchisee shall bring 6 (six) individuals (such that they are approved and appointed as the Franchisee with the Franchisor at the sole discretion of the Franchisor) to be part of the franchisee network of the Franchisor. Such individuals should be known to the Franchisee and should have good conduct as well as Mentored & Monitored and solve their problems by the Franchisee.</p>
<li> <b>Team Performance</b></li>
<p>The Franchisee will take the responsibility for building the down line team as per the hierarchy set by the Franchisor and also for the team performance in terms of sales, revenue, conduct of the franchisee under them as per the Franchisor’s decided hierarchy.</p>
<li> <b>Report Irregularity/Indiscipline to Senior</b></li>
<p>If the Franchisee finds any irregularity or indiscipline for its team be it junior or senior shall immediately report the same to the Franchisor.</p>

<li> <b>Bring Sellers to Platform</b></li>
<p>The Franchisee shall bring products and goods of various companies and brand to the Franchisor platform for selling them. The Franchisee shall not sell the products and goods directly but, will bring sellers willing to sell them. It is the main responsibility of the Franchisee to bring various sellers to the platform as the Franchisor is just responsible for building the platform and will just be of an assistance to the Franchisee to bring sellers for the platforms. The Franchisee shall bring sellers as per the terms and conditions of the Franchisor. The Franchisee shall assist the seller to seamlessly register on the platform, get the products listed and help them sell.</p>
<li> <b>Remove Hurdles</b></li>
<p>The Franchisee shall ensure to remove all hurdles in terms of revenue generation.</p>
<li> <b>Revenue Target</b></li>
<p>Every Village Franchisee shall bring in minimum of INR 10 Lakhs of sales from their territory and all the Franchisee in the upline hierarchy shall help the Village Franchise to achieve the sale target.</p>
<li> <b>Messaging Group</b></li>
<p>The Franchisee shall create a minimum of 8 (eight) WhatsApp/Telegram group and Broadcast group of unique 2000 people each from within their territory where they will regularly post about the products, special offers and other details to make the members buy the products.</p>
</ol>


<li>
	Brand Identification and Brand Image
</li>

<ol type="1">

<li> <b>Brand Identification and Brand Image Ownership</b></li>

<p>All rights of ownership and use of the Brand Identification and Brand Image including (but not limited to) the Business Name, the Brand Identification, the Brand Image, the Business and the System will endure for the sole benefit of, and remain with, the Franchisor. The Franchisee acknowledges having no rights to use the Business Name, the Brand Image, the Business or the System except in accordance with this Agreement.</p>
<li><b>Dispute of Franchisor’s Rights </b></li>

<p>The Franchisee will not dispute the Franchisor’s Proprietary Rights in the Business Name, the Brand Identification, Brand Image, the Business or the System nor take any action or assist any other party to take any action which may affect those Proprietary Rights and that of the Franchisor.</p>
<li><b>Registration</b></li>
<p>The Franchisee must not apply to register any business names, company names, trade names or Internet domain names, or any business names, company names, trade names or Internet domain names and could be interpreted as being similar to that of the Franchisor, with any Authority containing the Brand Image or Brand Identification without the prior written consent of the Franchisor.  Should this agreement be terminated for any reason, the Franchisee must give to the Franchisor a signed transfer (relevant to the nature of the name) of such name transferring ownership of the name to the Franchisor and the Franchisee agrees to relinquish ownership and to cease using the name upon termination of this Agreement.</p>


<li><b>Brand Use Restrictions</b></li>
<p>The Franchisee must:</p>
<ol type="a">
	<li>only conduct the Business using the Branding Image and Branding Identification;</li>
<li>only use the Business Name, Branding Image and Branding Identification in the manner permitted by the Franchisor;</li>
<li>identify to the public that the Franchisee is using the Business Name, Branding Image and Branding Identification as an independent business under license; and</li>
<li>
	not use the Business Name, Branding Image and Branding Identification in connection with the supply of any product or service not covered by this Agreement or the Manuals without the prior written consent of the Franchisor.
</li>

</ol>

<li><b>Changes to Business Name or Branding</b></li>

<p>
	The Franchisee acknowledges that the Franchisor may add to or modify the Business Name, Branding Image and Branding Identification at any time.  The Franchisee is to use any new or modified Business Name, Branding Image and Branding Identification in relation to the Business. Any costs incurred by the Franchisee in respect to changing the Business Name, Branding Image and Branding Identification shall be borne by the Franchisor. The Franchisee must immediately stop using any Business Name, branding, company name or trade name that the Franchisor notifies the Franchisee to stop using.
</p>

<li><b>Infringement</b></li>

<p>The Franchisee will immediately inform the Franchisor if any infringement or threatened infringement of the Business Name, Branding Image and Branding Identification, Business, Confidential Information or System should the Franchisee become aware of such an event. Any legal proceedings that are threatened or commenced by any person against the Franchisee on the ground that the Business Name, Branding Image and Branding Identification, Business, Confidential Information or System infringes any rights belonging to any other person, then the Franchisee will promptly advise the Franchisor of this event.</p>
<li><b>Defense of Infringements</b></li>


<p>The Franchisor has the sole right to initiate or defend any legal proceedings concerning any infringements of the Business Name, Branding Image and Branding Identification, Confidential Information or System. If the Franchisor commences or defends any claims or legal proceedings against any person (other than the Franchisee) concerning any infringements of or claims in relation to the Business Name, Branding Image and Branding Identification, Business, Confidential Information or System then the Franchisor will:</p>
<ol type="a">

<li>
	bear all costs and expenses including any damages or costs awarded against the Franchisor or the Franchisee; and
</li>

<li>
	be entitled to take the benefit of any award including any damages or costs awarded in favour of the Franchisor or the Franchisee.
</li>
<p>

The Franchisee will provide all reasonable assistance to the Franchisor in relation to any claims or legal proceedings concerning the Business Name, Branding Image and Branding Identification, Business, Confidential Information or System.
</p>
</ol>


</ol>





<li>Promotion and Advertising </li>

<ol>

 <li><b>Branding and Signage</b></li>
<p>The Franchisee must display the Business Name, Branding Image and Branding Identification and any Signs in the manner specified by the Franchisor and specified in the Manuals.</p>
<li><b>Branding or Signs Restrictions</b></li>
<p>The Franchisee must obtain the prior written consent of the Franchisor to display on the Premises and Vehicle of any trademark, logo or emblem other than those specified with the Business Name, Branding Image and Branding Identification and identified in the Manuals.</p>
<li><b>Business Promotion</b></li>
<p>The Franchisee must use its best endeavors to promote the Business and the Business Name, Branding Image and Branding Identification.</p>
<li><b>Promotional Material</b></li>
<p>The Franchisee must ensure that any stationery, advertising and promotional material includes a statement approved by the Franchisor that specifies that the Business is operated as an independent business of the Franchisee under license from the Franchisor, and as specified in the Manuals to this effect.</p>
<li><b>Other Advertising</b></li>
	<p>Prior consent of the Franchisor must be gained by the Franchisee before using any advertising or promotional material not supplied by the Franchisor.</p>
<li><b>Adherence to Manuals</b></li>
	<p>The Franchisee must follow the procedures and guidelines outlined in the Manuals when undertaking any advertising, marketing or promotional activity.</p>
</ol>

<li>
    Commission
</li>

<ol type="1">
    <li>
        The Franchisee shall receive commission on weekly basis from the Franchisor. A week shall be counted from Monday to Sunday and the commission of current week shall be paid on or before the 3rd day of the next week i.e the commission of week starting from Monday till Sunday shall be paid on or before coming Wednesday.
    </li>
    <li>
The commission eligible for the Franchisee to receive when a sale happens shall be displayed on the App developed by the Franchisor after the Franchisee logs in. The commissions shall be solely decided by the Franchisor and shall be allocated as per the formula set by the Franchisor at its sole discretion.
    </li>
</ol>




<li>Business Conduct</li>

<ol type="1">
<li><b>Misleading Conduct</b></li>
<p>The Franchisee must not at any time make any representations concerning any aspects of the Business which are false, misleading or deceptive or engage in conduct likely to bring the Franchisor, Business Name, Branding Image and Branding Identification into disrepute.</p>
<li><b>Compliance with Laws and Regulations</b>
</li>
<p>
The Franchisee must at all times comply with all laws, regulations and requirements made by any Local, State, Central or Government Authority.
</p>

<li><b>Compliance with Standards</b></li>
<p>
The Franchisee must fully comply with the standards, procedures and specifications notified in writing by the Franchisor or as specified in the Manuals and all mandatory standards that are issued by any Authority in the Territory that Business is permitted to operate within.
</p>

<li><b>Hours of Business</b></li>
<p>
The Franchisee must ensure that the Franchisee and the Franchisee’s personnel are available to conduct the Business during normal business hours (i.e. ten hours) or such other hours as communicated from time to time by the Franchisor in writing and/or as mentioned in the Franchise Manuals.
</p>

<li><b>Commencing Business Restrictions</b></li>
<p>The Franchisee must not commence operating the Business until:</p>

<ol type="a">


<li>laptop/internet;</li>
<li>appointment of 6 people</li>
<li>the Franchisee or the Franchisee’s personnel have commenced and completed the Training Programme provided by the Franchisor or its staff, team or approved external agency;</li>
</ol>

<li><b>Available for Downline Franchisee</b></li>
	<p>The Franchisee shall on daily basis shall be available for the Downline Franchisee as per the hierarchy set by the Franchisor i.e. the Franchisee under them. The Franchisee shall be responsible to help, assist and solve all their problems with regards to the franchise.</p>

</ol>




<li>Business Practise</li>

<ol type="1">
    <li><b>Membership of Associations and Groups</b></li>

<p>The Franchisee will (if not already a member) apply for membership of any such Associations or Groups nominated by the Franchisor within ten (10) Business Days of being required to do so by the Franchisor.</p>
<li><b>Inspection of Premises</b></li>
<p>
    The Franchisor, at any time, may inspect the Premises to determine if the Franchisee is complying with its obligations under this Agreement.
</p>

<li><b>Prospective Franchisees Visits</b></li>
<p>The Franchisee will permit the Franchisor to visit the Premises with prospective Franchisees in order to show these prospective Franchisees the System in operation by the Franchisee. Such visits are to be conducted with reasonable notice to the Franchisee.</p>

<li>
    <b>Use of Computer Hardware and Software</b>
</li>

<p>The Franchisee shall use the Hardware and Software supplied by or recommended by the Franchisor in connection with the Business. The Franchisee acknowledges that the ownership of all intellectual property in the Software and the database information (including the customer database) shall always remain with the Franchisor or the Licensor of the software.</p>
<li><b>Franchise Manuals</b></li>

<p>The Franchisee agrees to adhere to guidelines and directions mentioned in the franchise manuals provided by the franchisor.</p>

</ol>


<li>Confidentiality</li>
<p>As a condition of the Franchisor providing the Confidential Information to the Franchisee in addition to other valuable consideration, the receipt and sufficiency of which consideration is hereby acknowledged, the parties to this Agreement agree as follows:</p>
<ol type="1">
    <li><b>Confidential Information</b></li>

<p>All written and oral information and materials disclosed or provided by the Franchisor to the Franchisee under this Agreement is Confidential Information regardless of whether it was provided before or after the date of this Agreement or how it was provided to the Franchisee. Confidential Information will not include information: </p>

<ol type="a">
<li>
    that is generally known in the industry of the Franchisor; or
</li>
<li>
    that is now or subsequently becomes generally available to the public through no wrongful act of the Franchisee; or
</li>
<li>
    that the Franchisee rightfully had in its possession prior to receiving the Confidential Information from the Franchisor; or
</li>

<li>
    that is independently created by the Franchisee without direct or indirect use of the Confidential Information; or
</li>
<li>
    that the Franchisee rightfully obtains from a third party who has the right to transfer or disclose it.
</li>
</ol>


<li><b>Confidential Obligations</b></li>
<p>
Except as otherwise provided in this Agreement, the Franchisee must keep the Confidential Information confidential. The Franchisee and the Franchisee’s personnel will not disclose any of the Confidential Information to any other person without the prior written consent of the Franchisor except as obligated by law or to any solicitor or to any accountant.
</p>
<li><b>Ownership of Information</b></li>

<p>
Except as otherwise provided in this Agreement, the Confidential Information will remain the exclusive property of the Franchisor and will only be used by the Franchisee for the permitted purpose of exercising the business as set out in this Agreement. The Franchisee will not use the Confidential Information for any purpose that might be directly or indirectly detrimental to the Franchisor or any of its affiliates, subsidiaries or other Franchisees. Nothing contained in this Agreement will grant to, or create in the Franchisee, either expressly or impliedly, any right, title, interest or license in or to the intellectual property and confidential information of the Franchisor.
</p>

<li><b>Information Protection</b></li>
<p>The obligations to ensure and protect the confidentiality of the Confidential Information imposed on the Franchisee in this Agreement and any obligations to provide notice under this Agreement will survive the expiration or termination, as the case may be, of this Agreement and will continue for a period of ten (10) years from the date of such expiration or termination.</p>

<li><b>Information Disclosure</b></li>
<p>The Franchisee may disclose any of the Confidential Information:</p>

<ol type="a">
<li>to such of its employees, agents, representatives and advisors that have a reasonable need to know for the Business provided that:</li>

<ol type="i">
<li>the Franchisee has informed such personnel of the confidential nature of the Confidential Information; and</li>
<li>such personnel agree to be legally bound to the same burdens of confidentiality and non-use as the Franchisee; and</li>
<li>the Franchisee agrees to take all necessary steps to ensure that the terms of this Agreement are not violated by such personnel; and</li>
<li>the Franchisee agrees to be responsible for and indemnify the Franchisor for any breach of this Agreement by its personnel.</li>
</ol>

<li> to a third party where the Franchisor has consented in writing to such disclosure; and </li>
<li> to the extent required by law or by the request or requirement of a court of law, a regulatory body, or an administrative tribunal. </li>
(c)

</ol>

<li><b>Storage and Disclosure</b></li>
<p>The Franchisee agrees to retain all Confidential Information at its usual place of business and to store all Confidential Information separate from other information and documents held in the same location. Further, the Confidential Information is not to be used, reproduced, transformed, or stored on a computer or device that is accessible to persons to whom disclosure may not be made, as set out in this Agreement.</p>

<li><b>Failure to Maintain Confidentiality</b></li>
<p>The Franchisee agrees and acknowledges that the Confidential Information is of a proprietary and confidential nature and that any failure to maintain the confidentiality of the Confidential Information in breach of this Agreement cannot be reasonably or adequately compensated for in money damages and would cause irreparable injury to the Franchisor. Accordingly, the Franchisee agrees that the Franchisor is entitled to, in addition to all other rights and remedies available to it under this Agreement, obtain an injunction restraining the Franchisee, any of its personnel, and any agents of the Franchisee, from directly or indirectly committing or engaging in any act restricted by this Agreement in relation to the Confidential Information.</p>


<li><b>Return of Confidential Information</b></li>
<p>The Franchisee will keep track of all Confidential Information provided to it and the location of such information. The Franchisor may at any time request the return of all Confidential Information from the Franchisee. Upon the request of the Franchisor, or in the event that the Franchisee ceases to require use of the Confidential Information, or upon the expiration or termination of this Agreement, the Franchisee will:</p>
<ol type="a">
<li>
    return all Confidential Information to the Franchisor and will not retain any copies of this information; and
</li>
<li>
    destroy or have destroyed all memoranda, notes, reports and other works based on or derived from the Franchisees review of the confidential information; and
</li>
<li>
    provide a certificate to the Franchisor that such materials have been destroyed or returned, as the case may be.
</li>
</ol>



<li><b>Additional Disclosure</b></li>

<p>
    In the event that the Franchisee is required in a civil, criminal or regulatory proceeding to disclose any part of the Confidential Information, the Franchisee will give to the Franchisor prompt written notice of such request so the Franchisor may seek an appropriate remedy or alternatively to waive the Franchisee's compliance with the provisions of this Agreement in regards to the request.
</p>

<li><b>Franchisor Notification</b></li>
<p>If the Franchisee loses or fails to maintain the confidentiality of any of the Confidential Information in breach of this Agreement, the Franchisee will immediately notify the Franchisor and take all reasonable steps necessary to retrieve the lost or improperly disclosed Confidential Information.</p>

</ol>


<li>Personnel</li>

    <ol>
        <li><b>Personnel</b></li>

<p>The Franchisee will;</p>

<ol type="a">
<li>
    submit a list of Personnel to be employed by, or be involved in the Business; and
</li>
<li>
    must immediately notify the Franchisor if any of the Personnel are no longer involved in the Business or leave the Franchisee’s employment; and
</li>
<li>
    The Franchisee must promptly submit to the Franchisor the names, experience and background of any person proposed to be employed in the business for final approval before recruiting them
</li>

</ol>
<li><b>Employment of Personnel</b></li>
<p>The Franchisee will at all times employ suitably experienced, qualified and trained personnel which are approved by the Franchisor. The Franchisee would maintain the required number of personnel with required roles and designations as asked by the Franchisor.</p>
<li><b>Representations to Employees</b></li>
<p>Under no circumstances will the Franchisee hold out to any employee or prospective employee that they are or will be employed by the Franchisor.  The Franchisee will give to each of its employees (in addition to any employment documentation required by any Local or Government Authority) a letter containing a clear statement that the employee is not an employee of the Franchisor.  </p>
<li><b>Responsibility for Personnel</b></li>
<p>The Franchisee is responsible for any income tax, annual leave, long service leave, sick leave, parental leave, workers compensation, superannuation, educational and training expenses, termination payments and any other taxes, duties, benefits or entitlements in respect of the Franchisee’s personnel as required by law. The Franchisee must comply with relevant employee and workers’ legislation in all dealings with employees.</p>

<li><b>Personnel Conducting Business</b></li>

<p>The Franchisee and all personnel of the Franchisee while conducting the Business must:</p>

<ol type="a">

<li>observe a high standard of dress and appearance, personal hygiene and always act in a professional manner; and</li>
<li>display consistent courtesy to all clients, general public and to all personnel of the Franchisor.</li>
</ol>


<li><b>Sub-Contractor Restrictions</b></li>
<p>The Franchisee may not appoint sub-contractors for the Business, unless approved in writing by the Franchisor.</p>

<li><b>Inappropriate Personnel</b></li>
<p>
The Franchisee will at all times employ suitably experienced, qualified and trained personnel. Such personnel will, at all times, comply with the specifications set down by the Manuals and conduct themselves in a manner that upholds the reputation and standards of the Business. If, in the opinion of the Franchisor, a member of staff does not conduct themselves in a manner that upholds the reputation or standards of the Business, or engages in acts of behavior that is detrimental to the Franchisor, the Franchisee or the Business, then the Franchisor will notify the Franchisee of such action. The Franchisee must, as soon possible, after this notification and, subject to any laws regarding dismissal or termination of employment, take appropriate action to remove such person from the Business and to select a replacement and have the replacement (if requested by the Franchisor) complete a training programme. The Franchisee must ensure that in any letter of appointment or contract of employment it reserves the right to remove personnel to other duties or (where necessary) terminate their employment in compliance with this clause.  Nothing in this clause will be construed as placing an obligation on the Franchisee to take any action which may expose the Franchisee to a claim of unfair or wrongful dismissal but if the Franchisee reasonably considers that a request from the Franchisor to remove a member of personnel may have such result then the Franchisee must co-operate with the Franchisor in reaching a satisfactory resolution in respect of such unsuitable personnel.
</p>

    </ol>


<li>
    Training
</li>

<ol type="1">

<li>Undertaking Training</li>
<p>The Franchisee and the Franchisee’s personnel must undertake the training provided by the Franchisor, its staff or team and authorized third party trainers at their own cost i.e. the cost of travelling, accommodation, stay and pay to be borne by the franchisee.</p>
<li>Additional Training</li>
<p>The Franchisee and any of the Franchisee’s personnel may, from time to time, be required to attend additional training programmes necessary to keep Franchisees and their personnel up to date with the latest technology, industry improvements and business methods for conducting the Business.</p>
<li>Costs of Training</li>
<p>Prior to the date on which the training programme commences, the Franchisee must pay the Franchisor the training fees notified by the Franchisor for any training programme undertaken by the Franchisee or the Franchisee’s personnel under Clause 17.2. The Franchisee is responsible for any travel, accommodation or other expenses (including any applicable Tax, Cess or Charges) incurred by the Franchisee or the Franchisee’s personnel to attend a training programme.</p>
</ol>

<li>Indemnity of Franchisor</li>

<p>The Franchisee will hold harmless and indemnify the Franchisor against any and all claims and actions arising out of running the Business and carrying out the provisions of this Agreement. Such indemnity shall include, without limitation, expenses, judgments, fines, settlements, claims, proceedings, damages, losses, liability and costs and other amounts (including all legal costs) actually and reasonably incurred in connection with any liability, suit, action, loss, or damage arising or resulting from the Franchisees participation and actions in the Business for which the Franchisee is held civilly or criminally liable, or which it incurs concerning:</p>

<ol type="a">
<li>
    A breach by the Franchisee of this Agreement or any other agreement between the Franchisor and Franchisee; or
</li>
<li>A breach by the Franchisee of any warranties or representations express or implied made by the Franchisee to the Franchisor; or</li>

<li>Any injury to any person or damage to any property arising from the conduct of the Business; or</li>

<li>The inability of the Franchisee to settle all debts and expenses of the Business; or</li>

<li>Any negligent or willful act or omission by the Franchisee or by the personnel of the Franchisee; or</li>

<li>Any legal proceedings in which the Franchisor is made a party or is otherwise involved arising directly or indirectly out of this Agreement or the Business (except where costs are awarded in favour of the Franchisee against the Franchisor).</li>
</ol>

<li>
    Liability of the Franchisor
</li>

<ol>


<li>Limitation of Liability</li>
<p>Except as expressly provided in this Agreement, neither the Franchisor, or any of its agents, employees and sub-contractors shall be liable to the Franchisee or any other party for any claim, loss, demand or damages whatsoever (whether such claims, loss, demands or damages were foreseeable, known or otherwise and result from the usage or sale of company products supplied by the franchisor).</p>

<p>
    With the exception of any breaches of this agreement by the Franchisor, the Franchisor or any of its agents, employees or sub-contractors shall not be liable to the Franchisee or any of the Franchisees agents, employees or sub-contractors for any indirect or consequential loss or damage including, without limitation, loss of actual or anticipated profits (including loss of profits on contracts), loss of revenue, loss of business, loss of opportunity, loss of anticipated savings, loss of good will, loss of reputation, loss or damage to or corruption of data, loss of use of money, and whether or not advised of the possibility of such claim, loss, demand or damages and arising in tort (including negligence), contract or otherwise, to the fullest extent permitted by law.
</p>

<p>
    All warranties, terms and conditions, representations or inducements made by the Franchisor, its officers, employees and agents,  whether express, implied relating in any way to this Agreement are excluded, except as expressly provided in this Agreement.
</p>
<li>Statutory Limitations</li>
<p>The Statutory Limitations, if any, are limited to the period of this Agreement and a further one (1) year after the termination of this agreement. The Franchisee agrees that any claim under this clause is specifically excluded should a claim be made after this time period.</p>
<p>Any term, condition or warranty will be deemed to be included in this Agreement where any Statute implies in this Agreement that cannot be avoided excluded or modified.  Where permitted to do so the liability of the Franchisor for any breach of such term, condition or warranty will be limited, at the Franchisor’s option, to any one or more of the repair of such goods, the replacement of the goods or the supply of equivalent goods, the payment of the cost of replacing the goods or of acquiring equivalent goods, the payment of the cost of having the services supplied again or the supplying of the services again.</p>

<li>Profitability and Disclosure Document</li>
<p>The Franchisor makes no expression or promises, guarantees, implied representations, or warranties regarding the profitability, cost structure or earnings of the Business. The Franchisee acknowledges that there have been no expressions, promises, guarantees, implied representations, or warranties of any kind made by the Franchisor to induce the Franchisee to enter into this Agreement.</p>

</ol>

<li>
    Warranties
</li>

<ol type="1">


<li>Warranties</li>

<p>The Franchisee hereby warrants and represents to the Franchisor:</p>
<ol>
    <li>
        Authority to Act
    </li>
    <p>Where the Franchisee is a company, the Franchisee is empowered, by the legal documentation supporting the Company’s formation, to enter into this Agreement and to do all things required by this Agreement to discharge the Franchisees obligations under this Agreement;</p>

    <li>Sufficient Funds</li>
<p>The Franchisee has sufficient funds to properly discharge all the Franchisee’s obligations under this Agreement;</p>

<li>Disclosure by Franchisee</li>
<p>The Franchisee and its Partners or Directors or Shareholder or Trustees (as the case may be) have each made, prior to entering into this agreement, full, true and accurate disclosure and representations, that are true, correct and accurate in all respects, to the Franchisor of all facts and matters which may be material to the Franchisor in assessing whether to grant the Franchisee a license to operate the Business and to enter into this Agreement. The Franchisee and its Partners or Directors or Shareholder or Trustees (as the case may be) hereby states that there are no other facts or conditions which would or may make any of the statements, information or representations incorrect or inaccurate;</p>
<li>Franchisee Remains Owner</li>
<p>Where the Franchisee has not disclosed to the Franchisor in writing prior to the execution of this Agreement that the Franchisee is a trustee of a Trust, the Franchisee is, and will continue to be, the beneficial owner in their personal capacity.</p>

<li>Franchisee as Trustee</li>

<p>Where the Franchisee is the trustee of a Trust; the Franchisee declares;</p>

<ol type="a">
    <li>
    the Franchisee is entering into this Agreement as part of the due and proper administration of the Trust; and
    </li>
<li>the Franchisee is not in default under any of the provisions of the deed establishing the Trust; and</li>
<li>the right of indemnity of the Franchisee as trustee of the Trust, and the lien of the Franchisee over the assets of the Trust have not been limited in any way.</li>
</ol>


<li>Incurring Debt</li>
	<p>The Franchisee will not incur any debt or financial obligation in relation to the Business at any time during the Term of this contract knowing that such a debt or obligation cannot be settled under the terms of payment.</p>
</ol>


<li>Dependence on Warranties</li>
<p>The Franchisee must immediately notify the Franchisor in writing if there are any conditions or circumstances which may render such warranties as stated in Clause 20.1 invalid or untrue. The Franchisee acknowledges that the Franchisor has relied upon the warranties contained in Clause 20.1 in entering into this Agreement, and will continue to do so during the Term, and after the termination, of this Agreement.</p>

</ol>






<li>Communication Numbers and Addresses</li>

<ol type="1">


<li>Directories</li>
<p>The Franchisee may place an entry for the Business in telephone directories applicable to the Territory. Such an entry is to be fully compliant with the specifications outlined in the applicable Manuals.</p>
<li>Website and Email Addresses, Telephone and Facsimile Numbers and other Media</li>
<p>The Franchisee will never apply and not create without written approval telephone and facsimile numbers, email addresses, websites, Linked In, Twitter, Facebook, Blogs or any other form of communication.</p>
<li>
    Facilities Ownership
</li>
<p>Where the Franchisee does obtain any telephone or facsimile numbers, website and email addresses, social media accounts or digital footprints for the Business, the Franchisee shall do so on behalf of the Franchisor only.</p>
<li>Facilities Reverting</li>
<p>The Franchisee acknowledges that after termination of this Agreement (for whatever reason) the use and ownership of the telephone and facsimile numbers, email addresses, websites, Linked In, Twitter, Facebook, Blogs or any other form of communication or social media will revert to the Franchisor and;</p>
<ol type="a">
    <li>the Franchisee will not make use of any of the telephone and facsimile numbers, email addresses, websites, Linked In, Twitter, Facebook, Blogs or any other form of communication or social media; and</li>
    <li>the Franchisee will not prevent or interfere with the use by the Franchisor of these telephone and facsimile numbers, email addresses, websites, Linked In, Twitter, Facebook, Blogs or any other form of communication or social media or with any action taken by the Franchisor to transfer or to redirect such numbers to the Franchisor; and</li>
    <li>the Franchisee will assist the Franchisor (if requested by the Franchisor) to have any listing of these telephone and facsimile numbers, email addresses, websites, Linked In, Twitter, Facebook, Blogs or any other form of communication or social media, and any associated usernames and passwords transferred to the Franchisor; and</li>
    <li>the Franchisee must immediately execute all necessary documentation to transfer the telephone and facsimile numbers, email addresses, websites, Linked In, Twitter, Facebook, Blogs or any other form of communication or social media, and any associated usernames and passwords to the Franchisor.</li>
    </ol>
</ol>

<li>Reporting</li>
<ol>


<li>Daily Reporting</li>
<p>The Franchisee shall do a telephonic or video call atleast 4 (four) times a day, daily to the reporting Franchisee above them as directed by the Franchisor.</p>
<li>Monthly Reporting</li>
<p>By the tenth (10) Business Day of each month a report for the preceding month on the Franchisee’s activities during that month in the form or forms required by the Franchisor such report to include:</p>
<ol type="a">
<li>changes to the Franchisee personnel; and</li>
<li>financial performance including monthly Tax returns; and</li>
 <li>new clients or customer database; and</li>
<li>advertising and marketing activities; and</li>
<li>any other order forms, calculations or information as the Franchisor may require at any time or as specified in the Manuals</li>
</ol>

</ol>

<li>Seller Listing</li>

<p>The Franchisee shall represent and bring the sellers to the Franchisor platform to sell their goods and products, would help the sellers as and when required. Would explain all the terms and conditions of being a seller with the platform of the Franchisor in detail and explain about the legal agreement to be signed. Such agreement would be signed between the Seller and the Franchisor and in future if the Franchisee discontinues or is terminated from being the Franchisee, than the network of all sellers would continue to be the property of the Franchisor only.</p>
<li>Records of the Business</li>

<ol>


<li>Location of Records</li>
<p>The Franchisee must keep all business and financial records that relate to the Business at the Franchisee’s address i.e. the address of the restaurant for a time of no less than seven (7) years from the Commencement Date.</p>
<li>Inspection of Records</li>
<p>The Franchisor, or its authorised representatives, may request the Franchisee to supply all records the Franchisor believes necessary to undertake an audit of the records and may inspect and remove any records for the purposes of auditing and examining the records.</p>

<li>Audit of Records</li>
<p>The Franchisor may, within sixty (60) Business Days after the termination of this Agreement by notice to the Franchisee, advise the Franchisee that the Franchisor requires an audit of the business and financial records of the Business The Franchisee must immediately upon receipt of the notice referred to in clause 24.2 deliver to the Franchisor all of the business and financial records of the Business. The Franchisor will return all business and financial records of the Business, in its possession to the Franchisee within a reasonable time after the completion of an audit. The Franchisee and the Franchisee’s personnel must fully co-operate with the Franchisor, its personnel and auditors in conducting any inspection or audit referred in this clause.</p>
<li>Audit Report</li>
<p>The Franchisor will within thirty (30) Business Days after completing an audit of the Business forward a copy of the audit report to the Franchisee.</p>
</ol>

<li>Obligations of the Franchisor</li>
<ol type="1">
    <li>Training and Support</li>

<p>The Franchisor will supply training and support as follows:</p>

<ol type="a">
<li>Initial Training</li>
<p>Initial training for the Franchisee and relevant personnel including assistance with the set-up and launch. The Franchisee has to ensure that along with them, the staff required are hired and sent for training atleast 15 days before the commencement date of the franchise premises or outlet.</p>

<li>Ongoing Training</li>
	<p>The Franchisor shall provide training as required by the Franchisee but, at the location suitable to the Franchisor. All costs related to the training shall be payable by the Franchisee including any costs incurred by the Franchisor (such as travel, accommodation and reasonable living expenses).</p>
</ol>



<li>Meetings of Franchisees</li>
<p>The Franchisor may, on a regular basis, convene meetings, either in person or via electronic media such as Skype or telephone conference call, of the Franchisees for the purpose of discussing the Franchise operations. The Franchisor will endeavor to give to the Franchisee not less than seven (7) Days notice of such meeting. The Franchisee will, at its own expense, either attend these meetings personally or send one of the Key Personnel.</p>
<li>Franchisees Information</li>
<p>The Franchisor will keep a register of the names and addresses of its Franchisees and will allow the Franchisee to inspect the register during normal business hours. The Franchisee consents to their information being added to the register and for their information to be made available to other Franchisees.</p>
<li>Establishing Business</li>
<p>The Franchisee acknowledges while the Franchisor will provide training and initial and ongoing assistance to the Franchisee, the Franchisee is responsible for establishing the Franchisee’s own reputation, customer, sales and client base in the Territory.</p>
<li>Management Contract</li>
<p>The Franchisor may, at the Franchisor’s option, enter into a management contract for part or all of its services provided to the Franchisee. The Franchisee agrees to deal with any such manager in the same manner as it would otherwise deal with the Franchisor entity or person.</p>
</ol>

<li>Franchisor Termination</li>

<p>The Franchisor may terminate this Agreement immediately by written notice if:</p>

<ol type="a">
<li>the Franchisee fails to remedy a breach of this agreement within fourteen (14) Business Days after receiving notice in writing from the Franchisor, for breach of any term of this Agreement; or</li>
<li>the Franchisee engages in any conduct or activities that are damaging or harmful to the reputation or interests of the Franchisor or to the Business Name, Branding Image and Branding Identification, Confidential Information or System; or</li>
<li>the Franchisee or any personnel of the Franchisee breaches the obligations of confidentiality set out in this Agreement so as to cause serious or potentially serious financial consequences for the Franchisor; or</li>
<li>the Franchisee commits any act of bankruptcy, is wound up or has a provisional, liquidator, receiver, controller, manager, official manager or trustee appointed to any part of the Franchisee’s property or is subject to any form of insolvency; or</li>
<li>a distress or other execution is levied or enforced upon or against any part of the property or assets of the Franchisee, for any amount ; or</li>
<li>the Franchisee is unable to pay any debts of the Business as they fall due; or</li>
<li>fails to commence operation of the Business as soon as practicable after the Commencement or the Franchisee abandons the Business and fails to operate the Business for fifteen (15) consecutive Business Days or the Franchisee threatens to cease carrying on the Business; or</li>
<li>the Franchisee attempts part with possession of, charge or otherwise encumber any right or obligation under this Agreement or attempts to sell, transfer, license, Franchise, or otherwise than in accordance with this Agreement; or</li>
<li>the Franchisee understates the Gross Revenue by more than three (3%) per cent on more than one occasion; or</li>
<li>the Franchisee directly or indirectly transfers or attempts to transfer the beneficial ownership of the issued share capital of the Franchisee. Should the Franchisee issue, allot or take any share in the share capital of the Franchisee and transfer it to any person where such person would hold or control a beneficial ownership in the capital of the Franchisee of more than forty-nine per cent (49%) of the voting, income or capital participation rights; or</li>
<li>an Authority initiates a prosecution of the Franchisee which results in a prosecution under the Laws or Regulations applicable to the Territory in circumstances which affects the ability of the Franchisee’s ability to carry on business or perform their duties and obligations under this Agreement; or</li>
<li>there occurs any change in the financial position of the Franchisee which affects the ability of the Franchisee to perform or comply with the Franchisee’s obligations under this Agreement; or</li>
<li>the Franchisee fails for a period of twenty (20) Business Days after receipt of notice from any Authority to comply with any law, by-law, ordinance or regulation applicable to the operation of the Business; or</li>
<li>the Franchisee is charged or convicted of a serious criminal offence punishable by imprisonment which, in the reasonable opinion of the Franchisor, is detrimental to the operation of the Business.</li>

</ol>


<li>Consequence of Termination</li>

<ol type="1">


<li>Consequence of Termination</li>
<p>Subsequent to the termination of this Agreement the Franchisee must not directly or indirectly represent or represent in any way to any party as being a Franchisee or otherwise associated with the Franchisor.</p>
<p>The Franchisee must no later than seven (7) Business Days after the date of termination:</p>

<ol type="a">
<li>pay to the Franchisor and all other creditors of the Business all amounts owing to the Franchisor under this Agreement; and</li>
<li>return to the Franchisor all copies of the Manuals and any Confidential Information held by the Franchisee; and</li>
<li>return all advertising material that contains or displays the Business Name, Branding Image or Branding Identification used in the operation of the Business; and</li>
<li>return any items supplied to the Franchisee by the Franchisor which are the property of the Franchisor for which the Franchisor has not received payment; and</li>
<li>take all action and execute all documents to cancel or transfer all telephone and facsimile numbers, email addresses, websites, Linked In, Twitter, Facebook, Blogs or any other form of communication or social media, and any associated usernames and passwords used in relation to the Business; and</li>
<li>remove or obscure signs or logos or other features displaying any of the Business Name, Branding Image or Branding Identification in or on any Premises or Vehicle; and</li>
<li>make available all financial and trading information concerning the Business as required by the Franchisor and provide to the Franchisor complete details of all past, existing and prospective clients.</li>

</ol>

<li>Franchisor’s Right to Conduct Business</li>
<p>Should the Franchisor deem it necessary to carry on the operation of the business, the Franchisee shall allow the Franchisor and/or its representatives to enter without notice onto the Premises used by the Franchisee to conduct the Business. Should the Franchisor carry out this action then the Franchisor will not be liable for damage or compensation of any nature whatsoever to the Franchisee or any other party.</p>
<li>Injunctive Enforcement</li>
<p>The Franchisee acknowledges that strict adherence by the Franchisee to the provisions of this agreement is vital to the success of the Business, and to the Franchisor and other Franchisees, and that damages would not be an appropriate remedy in the event of a default by the Franchisee. Accordingly, it is acknowledged that the Franchisor shall be entitled to apply for and obtain temporary or permanent injunctions, declarations and orders for specific performance enforcing the provisions of this agreement in the event of a default by the Franchisee and to prohibit or restrain any act or omission by the Franchisee or any employee that would constitute a default of this agreement.</p>

</ol>


<li>Extension to Timeframe</li>
<p>If the Franchisee continues to conduct the Business in the Territory after the expiry of the Term, with the permission of the Franchisor, then the Franchisee will (in absence of any written agreement to the contrary) be deemed to have been granted an extension of time of this Agreement on a monthly basis on the terms and conditions set out in this Agreement.</p>



<li>Sale of Business</li>

<p>The Franchisee is not allowed to sell the franchise rights in full or partly to anyone. The Franchisor at its sole discretion may allow the sale and transfer of the Franchisee at a certain cost but the decision of the same shall be on the sole discretion of the Franchisor.</p>


<li>Restriction on Competition</li>

<ol type="1">


<li>Restraint during Term</li>
<p>The Franchisee agrees that during the period of this Agreement, the Franchisee shall not, either personally, or as an employee, consultant or agent for any other entity or employer, carry on business in competition with the Franchisor or the Business in India or in any foreign country or island.</p>
<li>Restraint after Termination</li>
<p>The Franchisee covenants, after carefully considering the nature and extent of the restrictions imposed upon them and the rights and remedies conferred on the Franchisor, which are agreed and acknowledged to be reasonable in time and extent to fairly and not excessively protect the legitimate interests of the Franchisor, the Franchisees and other Franchisees of the Business, that the Franchisee will during this agreement or for a period of five (5) years from the date of termination or expiration of this agreement directly or indirectly as principal, servant, agent, director, shareholder, partner, employee, consultant, act as an agent, partner or representative or in any other capacity whatsoever:</p>

<ol type="a">


<li>As a separate and distinct restraint: operate, be involved or interested in or have any connection whatsoever with any employment, business or occupation involving the industry of the Franchisor; or</li>
<li>In addition as a separate and distinct restraint: seek to solicit or carry out any work of the same nature as the Franchisor or for any client or customer of the Business with which the Franchisee has had any contact or dealings whilst being a party to this Agreement before termination; or</li>
<li>In addition as a separate and distinct restraint: solicit or engage or employ any employee of the Franchisor, or any party that the Franchisor enters into an Agreement with to carry on the Business in the same Territory, or that the Franchisee or any Franchisee of the Business had any dealings whilst being a party to this Agreement before termination; or</li>
<li>In addition as a separate and distinct restraint: have business contact with or be in any way involved in any business activities with any Franchisee located within the territory.</li>
</ol>

<li>Remedies</li>
<p>The Franchisee and the nominated representative acknowledge that breach or threatened breach of any part of clause 30 will cause such immeasurable damage to the Franchisor that the Franchisor shall be entitled to apply to any court of competent jurisdiction for an injunction to prevent any breach or threatened breach in addition to any other remedy the Franchisor may have.</p>

</ol>


<li>Assignment</li>

<ol type="1">


<li>Franchisee Must Not Assign</li>
<p>The Franchisee must not assign or attempt to assign all or any part of this Agreement or the Franchisee’s rights or obligations under this Agreement.</p>
<li>Franchisor May Assign</li>
<p>The Franchisor will have the right to assign this Agreement and all or any benefits of this Agreement at any time during the Term of this Agreement.</p>

</ol>


<li>Franchisee Must Not Sub-Franchise or Transfer</li>

<ol>
    <li>The Franchisee Must Not Assign</li>
<p>The Franchisee must not assign, license, sublicense, charge, mortgage, sub-Franchise or otherwise encumber any interest of the Franchisee in this Agreement or in the Business.</p>

<li>The Franchisee Must Not Transfer</li>
<p>The Franchisee must not transfer, issue or allot a share or shares, or of any rights or of any other interest, in the share capital of the Franchisee, to one or more persons whereby such person or persons in aggregate would hold a beneficial ownership in the share capital, voting or participation rights of the Franchisee of greater than forty-nine per cent (49%).</p>

</ol>


<li>Incapacity of Franchisee</li>

<ol type="1">


<li>Death of Franchisee</li>
<p>In the event of the death of the Franchisee or, where the Franchisee is a Company or Trust, the Key Personnel, then the executor or legal representative of the Franchisee will as soon as practicable transfer this Agreement and the Business in accordance with clause 29.</p>
<li>Incapacity of Franchisee</li>
<p>The Franchisor may require the Franchisee to transfer the Business in accordance with clause 29 if the Franchisee or, where the Franchisee is a Company or Trust, the Key Personnel, suffer total or partial physical or mental incapacity for a period exceeding three (3) calendar months which, in the opinion of the Franchisor, renders the Franchisee unable to properly operate the Business.</p>
<li>Discontinuation</li>
<p>If the franchisee wishes to discontinue this franchise agreement or contract during the on-going tenure or period for any reason, franchisee would need to give 3 (three) months advance written notice to the franchisor or pay a fine of Rs. 2,00,000 (two lakhs) for discontinuation and termination of said franchise agreement</p>
<li>Franchisor May Supervise</li>
<p>Subject to clause 33.1 or 33.2 being enacted, the Franchisor may appoint any person that the Franchisor deems acceptable to supervise the operation of the Business and ensure that the Business is operated pending a return of the Franchisee to the Business. Where the Franchisee or the Key Personnel is unable to return to the Business by reason of death or incapacity, then the Business will be transferred to the Franchisor in accordance with clause 29.</p>

</ol>



<li>Continuing Obligations</li>

<p>The termination of this Agreement for any reason will not affect clauses 15, 18, 19, 20, 24, 26, 27 or 30 nor any of the provisions of the Agreement which expressly or implied, remain in effect after termination and will be without prejudice to any right of action already accrued to either party in respect of any breach of this Agreement by the other party.</p>


<li>Relationship of Parties</li>

<p>Under no circumstances will the Franchisee act, represent or imply that they are an employee, agent, partner or joint venture of the Franchisor and nothing in this Agreement will be construed so as to make the Franchisee the employee, agent, partner or joint ventures or representative of the Franchisor.</p>



<li>Notices</li>

<ol type="1">


<li>Address for Service</li>
	<p>The physical/electronic address for service of a notice on a party will be such an address as nominated and provided by the parties below and also may include the address of the Business Premises, the address of the registered office, the residential address of the Director or Key Personnel (as the case may be)</p>
	<p>If to the Franchisor: </p>
	<p>Kind Attn.: </p>
	<p>Mr. Rajesh Modi. </p>

	<p>Postal Address: </p>
	<p>M/S Modimart Ecommerce LLP. </p>
	<p>Office Building No 2, Pragati Society, Near Pancholia School, Mahavir Nagar, Kandivali West Mumbai 400067. Maharashtra.</p>
	<p>Email id is: </p>
<p>	@</p>

	<p>Mobile no is:</p>
	<p>+91 </p>

	<p>If to the Franchisee:</p>
	<br>
<p>Kind Attn.:</p>
<p>Mr. </p>
<br>
<p>Postal Address:</p>
<p>Maharashtra.</p>
<br>
<p>Email id is:</p>
	<p>@</p>
<br>
	<p>Mobile no is:</p>
	<p>+91</p>

<li>Service of Notices</li>
<p>Without prejudice to any other mode of service authorized or permitted at law a notice will be regarded as properly given if in writing either personally served on the party or any authorized officer of the party to whom it is given (in which case the notice will be regarded as having been received on that day), or mailed to the party by prepaid post (in which case it will be regarded as having been received on the fifth (5) Business Day following the date of posting of the notice) or sent to the party by facsimile transmission or sent to the party by electronic mail (in which case the notice will be regarded as having been received at the time the facsimile machine or computer on which that facsimile or electronic mail is transmitted displays or records confirmation that transmission has been completed) to the party to whom it was sent if that occurs before 5.00 pm on a Business Day in the place to which that facsimile is sent and in any other case on the next Business Day in that place following the day on which the confirmation of sending is displayed or recorded.</p>

</ol>

<li>Governing Law and Jurisdiction</li>

<ol type="A">

<li>The Parties shall attempt in good faith to resolve any dispute, difference or claim arising out of or in relation to this Agreement through mutual discussion. In case it is not resolved within thirty (30) days from receipt of the written notice (setting out the dispute or claim) by the other Party, the complaining Party may issue a notice of reference, invoking settlement of such dispute through Arbitration in city of Mumbai, Maharashtra only.</li>

<li>All disputes between Parties shall be subject to exclusive jurisdiction of city of Mumbai, Maharashtra only</li>

<li>Arbitration: Any and all disputes ("Disputes") arising out of or in relation to or in connection with this Agreement between the Parties or relating to the performance or non-performance of the rights and obligations set forth herein or the breach, termination, invalidity or interpretation thereof shall be referred for arbitration in city of Mumbai, Maharashtra in accordance with the terms of Indian Arbitration and Conciliation Act, 1996 or any amendments thereof. The language used in the arbitral proceedings shall be English. Arbitration shall be conducted by a sole arbitrator, who shall be appointed by the Supplier only. The arbitral award shall be in writing and shall be final and binding on each Party and shall be enforceable in any court of competent jurisdiction.</li>
 </ol>

<li>Justifiable Delay</li>

<ol type="1">

<li>If any party is rendered unable by a Justifiable Delay (being any act, omission or circumstance not reasonably within the control of the party relying upon, or intending to rely upon the same, including but not limited to any act of vandalism by any person not associated with the Franchisee or Franchisor, computer viruses, computer downtime, strike, lockout or other industrial disturbance, action or inaction of Authority, riot, any act of God or any act of the public enemy) from observing or performing its obligations under this Agreement (other than any obligation to make money payments) that party must give notice to the other party specifying full particulars of the expected duration and nature of the Excusable Delay to the other party within three (3) Business Days of the Justifiable Delay occurring.</li>
<li>Thereafter the obligations of the party affected by the Justifiable Delay, so far as they are affected by the Justifiable Delay, will be suspended for the continuance of the Justifiable Delay. The affected party must use all reasonable efforts to mitigate and remove the effect of the Justifiable Delay as quickly as possible, time being of the essence.</li>
<li>Force Majeure</li>
<p>Each party hereby releases the other from any claim liability or responsibility pursuant to this agreement concerning the other party’s failure to perform any obligation where such failure is due to strike, lockout, riot, industrial action, fire, storm, tempest, act of God, material shortage, government law or regulation or requirement or any other cause beyond the control of the other party and no such failure shall entitle a party to terminate this agreement.</p>

</ol>

<li>Time of the Essence</li>
<p>In respect of all of the obligations imposed upon the Franchisee and the Franchisor time will be of the essence of this Agreement and no extension or variation thereof will operate as a waiver of this clause.</p>

<li>Business Improvements</li>

<ol type="1">
    <li>Improvement Disclosure</li>

<p>If at any time the Franchisee or its personnel make any discoveries or any improvements to the System, the Know-How or the operation or marketing of the Services and Company Products which may be of benefit to the Franchisor or to other Franchisees, the Franchisee will immediately:</p>
<ol type="a">
<li>provide to the Franchisor full and true particulars of the discovery or improvement; and</li>
<li>provide such assistance to the Franchisor as they may require in respect of the discovery or improvement.</li>
</ol>
<li>Compensation</li>
<p>The Franchisee acknowledges that the assignment set out in this clause is both fair and reasonable and that the Franchisee has received full and valuable compensation for such assignment by the grant of the Franchise.</p>
<li>Assignment of Improvements</li>
<p>The Franchisee hereby assigns to the Franchisor any Proprietary Rights in any such future improvement or discovery. The Franchisee undertakes to do any act or thing and execute all documentation required by the Franchisor to give full effect to such assignment.</p>

</ol>


<li>Entire Agreement</li>

<ol type="1">
<li>Entire Agreement</li>
<p>Except as provided in this Agreement, this Agreement represents the entire agreement between the parties and contains all (but not limited to) of the agreements, representations, warranties, promises, obligations, guarantees, undertakings, limitations and restrictions of the parties.</p>

<li>Agreement Supersedes</li>
<p>This Agreement supersedes all prior negotiations, contracts, arrangements, understandings and agreements between the parties and that there are no other representations, warranties, arrangements, understandings or agreements between the parties, express or implied, except as are specified or referred to in this Agreement.</p>

<li>Further Documents</li>
<p>The parties covenant to do such further acts and things and execute such further documents as shall be necessary in the reasonable opinion of the Franchisor to give effect or better effect to the provisions of this agreement.</p>

<li>Power of Attorney</li>
<p>In the event of the Franchisee failing to execute any document or do any act or thing required by this agreement the Franchisee hereby irrevocably appoints the Franchisor as its lawful attorney and empowers it to execute such document or do such act and thing in the name of the Franchisee and on its behalf.</p>
</ol>


<li>Variation</li>

<p>This Agreement may be amended from time to time and varied only by an agreement or document in writing signed by the parties.</p>


<li>Waiver</li>

<ol type="1">
<li>
    No waiver of a breach or non-disclosure of any provision of this Agreement by the Franchisor will be effective unless in writing signed by the Franchisor and such waiver will not operate as a waiver of any further breach or non-disclosure.
</li>
<li>No default or delay on the part of the Franchisor in exercising any rights under this Agreement or in law or otherwise will operate as a waiver of any rights.</li>
</ol>




<li>Severability</li>

<ol type="1">
<li>Where any provision of this Agreement is judged by any court or is rendered by any Statute to be prohibited, invalid, void, voidable, illegal or unenforceable that provision will be severed from this Agreement without affecting or invalidating any other provision of this Agreement and all other provisions of this agreement will remain in full effect.</li>
<li>This clause will not apply if the severance of any provision alters the essential nature of this Agreement.</li>
</ol>



<li>Consent and Approval</li>

<ol type="1">
    <li>Franchisor Approval</li>
    <p>Unless expressly stated otherwise in this Agreement, the Franchisor is not obliged to give its approval or consent to any matter or thing.</p>

    <li>Consent Not Unreasonably Withheld</li>
    <p>The Franchisor may give or withhold its approval or consent and may, in giving approval or consent, do so subject to such terms and conditions as the Franchisor in its absolute discretion may determine provided however that the Franchisor will not unreasonably withhold its approval and consent.</p>
</ol>


<li>No Set-off</li>

<p>The Franchisee must pay all monies under this Agreement to the Franchisor free from any set-off (whether legal or equitable), or cross claims which the Franchisee may be entitled to claim against the Franchisor.</p>

<li>Remedies</li>

<p>All rights and remedies of the Franchisor provided for in this Agreement are cumulative and will not exclude or modify any other rights and remedies of the Franchisor provided by any applicable statute or law independently of this Agreement.</p>


<li>Counterparts</li>

<p>This Agreement may consist of a number of counterparts and the counterparts taken together constitute one and the same instrument.</p>


<li>Costs</li>

<ol>
<li>The Franchisee will pay its own legal costs and disbursements relating to this Agreement.</li>

<li>The Franchisee will pay to the Franchisor within five (5) Business Days after being notified by the Franchisor all of the legal costs and disbursements incurred by the Franchisor relating to the entering into this Agreement or any renewal of this Agreement or any action taken by the Franchisor to enforce or preserve any of the rights of the Franchisor under this Agreement or to remedy or rectify any default or breach by the Franchisee.</li>
</ol>



<li>Alternative Dispute Resolution</li>

<ol type="1">


<li>Parties to Meet in Good Faith</li>
	<p>If any Dispute arises out of, or in connection with this Agreement, the Franchisee and the Franchisor will, with ten (10) Business Days, meet in good faith to resolve the Dispute.</p>

<li>Resolution by Mediation	</li>
	<p>If the Dispute is not resolved at the meeting of the parties, then the parties will attempt to settle the Dispute by mediation in accordance with the Indian Franchise Association’s Code of Conduct Dispute Resolution procedure. The mediation is to take place no later than twenty (20) Business Days after the date of the Dispute notice.</p>

<li>Prohibition of Legal Action</li>
<p>No party may commence any legal action in relation to any dispute arising out of this Agreement until it has attempted to settle the Dispute by mediation and either the mediation has terminated or the other party has failed to participate in the mediation, provided that the right to issue proceedings is not prejudiced by a delay.</p>

<li>Failure to Resolve</li>
<p>If the Dispute is not settled by mediation within ten (10) Business Days of the commencement of the mediation, or within such period as the parties may agree in writing, the dispute shall be referred to and finally resolved by arbitration.</p>

</ol>

<li>Independent Advice</li>

<p>The Franchisee acknowledges that prior to entering into this Agreement the Franchisee obtained independent legal and financial advice. Including advise to risk, efforts and health toll generated by being a franchisee.</p>





<li>Disclosure of Conflict of Interest</li>

<p>Should the Franchisee become aware of the existence of a Conflict of Interest that the Franchisee may have with the duties or obligations under this Agreement or the performance of the duties and obligations of the Franchisee under this Agreement, then the Franchisee will make full disclosure in writing to the Franchisor of the existence, nature and extent of any conflict of interest or any fact or circumstances likely to result in a conflict of interest.</p>

</ol>


<p>For the sake of convenience and for the individual records of both Franchisor i.e. the party of the first part and Franchisee i.e. the party of the second part, total two (2) original copies of this agreement have been signed, sealed and stamped in original nature and both are counter-signed by parties in origin only and kept one copy for their own records.</p>

<p>In WITNESS whereof the parties hereto have set and subscribed their respective hands and seals on the day month and year first written above.</p>

<p>(1)	FRANCHISOR– party of the first part</p>

<p>Name: Mr. Rajesh Modi - Partner, Modimart Ecommerce LLP</p>





<br><br><br>

<p>Signature</p>

<p>In the presence of Witness,</p>

<p>Name: Mr. NAME - Designation, Modimart Ecommerce LLP</p>




<br><br><br>


<p>Signature</p>


<p>(2)	FRANCHISEE – party of the second part</p>

<p>Name: Mr. </p>
<br><br><br>







<p>Signature	</p>

<p>In the presence of Witness,</p>

<p>Name:</p>




<br><br><br>

<p>Signature</p>




<p>Place: Mumbai						Date:</p>

        </div>

    </div>


    <div>
<input type="checkbox" id="basic_checkbox_agree" value="<?php if($read_agree==1){echo"1";}else{echo"0";} ?>" name="read_agree" class="filled-in" <?if ($read_agree == 1) {echo 'checked';}?>>
<label for="basic_checkbox_agree">I have read this agreement and also agreed.</label>
</div>



          </div>
          </div>
          </div>
          </div>











                <?}?>



<input type="text" name="read_agreement" <?if ($read_agree == 1) {echo 'checked';}?> hidden>



            </div>
            </div>
        </div>

        <div style="display:flex;justify-content:center;">
            <input type="submit" name="submit" value="Update" class="btn btn-danger">
        </div>


        </form>
    </section>
    <br>
    <br>
    <br>







<!-- Modal -->
<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Position Detailed</h4>
      </div>


      <div class="modal-body" id="tree">

      </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Position Detailed</h4>
      </div>


      <div class="modal-body" id="modal_body">

      </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

















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
                url: "https://www.modimart.world/franchise/admin/creatMemref.php",
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
