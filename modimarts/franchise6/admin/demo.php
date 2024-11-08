<? session_start();
include('../config.php');


if(!$_SESSION){ ?>
    
    <script>
        window.location.href='https://modimart.world/get_members.php';
    </script>
    
<? } 

$userid = $_GET['id'];
$sql = mysqli_query($con,"select * from new_member where id='".$userid."'");
$sql_result = mysqli_fetch_assoc($sql);


$id=$sql_result['id'];
$full_pay_date=$sql_result['full_pay_date'];
$level_id=$sql_result['level_id'];
$position_id=$sql_result['position_id'];
$country=$sql_result['country'];
$zone=$sql_result['zone'];
$state=$sql_result['state'];
$division=$sql_result['division'];
$district=$sql_result['district'];
$taluka=$sql_result['taluka'];
$village=$sql_result['village'];
$location=$sql_result['location'];
$pincode=$sql_result['pincode'];
$status=$sql_result['status'];
$name=$sql_result['name'];
$mobile=$sql_result['mobile'];
$application=$sql_result['application'];
$no_intro=$sql_result['no_intro'];
$intro_id=$sql_result['intro_id'];
$introducer_name=$sql_result['introducer_name'];
$introducer_mobile=$sql_result['introducer_mobile'];
$temp_name=$sql_result['temp_name'];
$payment_date=$sql_result['payment_date'];
$is_paid=$sql_result['is_paid'];
$payment_receivable=$sql_result['payment_receivable'];
$payment_received=$sql_result['payment_received'];
$balance=$sql_result['balance'];
$time=$sql_result['time'];
$residing_area=$sql_result['residing_area'];
$mobile2=$sql_result['mobile2'];
$is_verify=$sql_result['is_verify'];
$created_at=$sql_result['created_at'];
$image_id=$sql_result['image_id'];
$star=$sql_result['star'];
$position_name=$sql_result['position_name'];
$email = $sql_result['email'];
$dob = $sql_result['dob'];
$cast = $sql_result['cast'];

$mem_status = $sql_result['mem_status'];




$email = $sql_result['email'];
$dob = $sql_result['dob'];
$cast = $sql_result['cast'];
$anniversary = $sql_result['anniversary'];
$gender = $sql_result['gender'];
$marrital_status = $sql_result['marrital_status'];
$pan = $sql_result['pan'];
$adhar_card = $sql_result['adhar_card'];
$bank = $sql_result['bank'];
$account_num = $sql_result['account_num'];
$ifsc = $sql_result['ifsc'];
$account_type = $sql_result['account_type'];
$pay_option = $sql_result['pay_option'];
$gst = $sql_result['gst'];
$password = $sql_result['password'];


$payable_bank = $sql_result['payable_bank'];
$amount_paid  = $sql_result['amount_paid'];
$paid_date = $sql_result['paid_date'];
$txn_id = $sql_result['txn_id'];
$proof_image = $sql_result['proof_image'];


function get_image($type,$id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_member_images where member_id='".$id."' and type='".$type."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['image'];
}


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
    <!--<div class="page-loader-wrapper">-->
    <!--    <div class="loader">-->
    <!--        <div class="preloader">-->
    <!--            <div class="spinner-layer pl-red">-->
    <!--                <div class="circle-clipper left">-->
    <!--                    <div class="circle"></div>-->
    <!--                </div>-->
    <!--                <div class="circle-clipper right">-->
    <!--                    <div class="circle"></div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <p>Please wait...</p>-->
    <!--    </div>-->
    <!--</div>-->
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
                                    <img src="https://modimart.world/assets/logo.png" style="width:100px;height:100px;" >
                    <span style="margin: auto 5%;">ModiMart</span>
                
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
              <? include('../menu.php');?>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->


    <section class="content">
        <form id="form" action="process_member_edit.php" method="post" enctype="multipart/form-data">
            
            <input type="hidden" name="userid" value="<? echo $_GET['id'];?>">
            
            
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
                                            <input type="text" name="address" value="<? echo $location;?>" class="form-control" />
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
                                    $zone_sql = mysqli_query($con,"select * from new_zone where id= '".$zone."'");
                                    if($zone_sql_result = mysqli_fetch_assoc($zone_sql)){ ?>
                                    
                                    <option value="<? echo $zone_sql_result['id']?>" selected><? echo $zone_sql_result['zone'];?></option>
                                    
                                    <? } ?>
                                    </select>
                                </div>
                                
                                
                                <div class="col-sm-3">
                                  
                                   <select class="form-control" name="state" disabled>
                                    <?
                                    $state_sql = mysqli_query($con,"select * from new_state where id= '".$state."'");
                                    if($state_sql_result = mysqli_fetch_assoc($state_sql)){ ?>
                                    
                                    <option value="<? echo $state_sql_result['id']?>" selected><? echo $state_sql_result['state'];?></option>
                                    
                                    <? } ?>
                                    
                                    </select>
                                    
                                </div>
                                
                                <div class="col-sm-3">
                                   <select class="form-control" name="division" disabled>
                                    <?
                                    $division_sql = mysqli_query($con,"select * from new_division where id= '".$division."'");
                                    if($division_sql_result = mysqli_fetch_assoc($division_sql)){ ?>
                                    
                                    <option value="<? echo $division_sql_result['id']?>" selected><? echo $division_sql_result['division'];?></option>
                                    
                                    <? } ?>

                                    </select>
                                </div>
                            
                            </div>
                            
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                  <select class="form-control" name="district" disabled>
                                <?
                                    $district_sql = mysqli_query($con,"select * from new_district where id= '".$district."'");
                                    if($district_sql_result = mysqli_fetch_assoc($district_sql)){ ?>
                                    
                                    <option value="<? echo $district_sql_result['id']?>" selected><? echo $district_sql_result['district'];?></option>
                                    
                                    <? } ?>

                                    </select>
                                </div>
                                
                                <div class="col-sm-3">
                                    <select class="form-control" name="taluka" disabled>
                                        <?
                                    $taluka_sql = mysqli_query($con,"select * from new_taluka where id= '".$taluka."'");
                                    if($taluka_sql_result = mysqli_fetch_assoc($taluka_sql)){ ?>
                                    
                                    <option value="<? echo $taluka_sql_result['id']?>" selected><? echo $taluka_sql_result['taluka'];?></option>
                                    
                                    <? } ?>
                                    </select>
                                </div>
                                
                                
                                
                                <div class="col-sm-3">
                                    <select class="form-control" name="pincode" disabled>
                                    <?
                                    $pincode_sql = mysqli_query($con,"select * from new_pincode where id= '".$pincode."'");
                                    if($pincode_sql_result = mysqli_fetch_assoc($pincode_sql)){ ?>
                                    
                                    <option value="<? echo $pincode_sql_result['id']?>" selected><? echo $pincode_sql_result['pincode'];?></option>
                                    
                                    <? } ?>
                                    </select>
                                </div>
                                
                                <div class="col-sm-3">
                                  <select class="form-control" name="village" disabled>
                                <? $village_sql = mysqli_query($con,"select * from new_village where id= '".$village."'");
                                    if($village_sql_result = mysqli_fetch_assoc($village_sql)){ ?>
                                    
                                    <option value="<? echo $village_sql_result['id']?>" selected><? echo $village_sql_result['village'];?></option>
                                    
                                    <? } ?>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <button id="trees" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-original-title ="<? echo $id; ?>" data-target="#myModal1">View Tree</button> | 
                                <button id="introduced_to" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-original-title ="<? echo $id; ?>" data-target="#myModal">Introduced To</button> 
                                
                                
                                <?
                                
$check_sql = mysqli_query($con,"SELECT * FROM `new_member` where (pan <> '' OR gst <> '' OR adhar_card <> '') and id='".$userid."' and location <> '' and status=1");

if($check_sql_result= mysqli_fetch_assoc($check_sql)){ 

    if($check_sql_result['level_id'] < 8 ){ ?>
            
       | <a class="btn btn-info btn-lg" target="_blank" href="https://modimart.world/franchise6/bill/pdf/bill.php?id=<? echo $userid?>">Franchise Invoice</a> 
    <? }
    
    if($check_sql_result['level_id'] == 8){ ?>
        | <a class="btn btn-info btn-lg" target="_blank" href="https://modimart.world/franchise6/bill/pdf/bill1.php?id=<? echo $userid?>">
                                    Franchise Invoice
                                </a>

    <? } } ?>
     
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
                                            <input type="text" name="full_name" value="<? echo $name; ?>" class="form-control" />
                                            <label class="form-label">Full Name</label>
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="col-sm-4">
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="password" value="<? echo $password; ?>" class="form-control" required/>
                                            <label class="form-label">Password</label>
                                        </div>
                                    </div>

                                </div>
                                
                                
                            </div>
                            
                            
                            
                            <div class="row clearfix">
                                
                                <div class="col-sm-4">
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="mobile" value="<? echo $mobile;   ?>" class="form-control" />
                                            <label class="form-label">Phone Number</label>
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="col-sm-4">
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="email" name="email" value="<? echo $email; ?>" class="form-control" />
                                            <label class="form-label">Email Id</label>
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                            <div class="form-line" value="<? echo $dob; ?>" id="bs_datepicker_container">
                                                <input type="text" name="dob" class="form-control" value="<? echo $dob; ?>" placeholder="Please choose Date Of Birth...">
                                                <!--<label class="form-label"></label>-->
                                            </div>
                                        </div>
                                </div>
                        </div>
                        
                        
                        <div class="row clearfix">
                            
                            <div class="col-sm-6">
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="cast" value="<? echo $cast; ?>" class="form-control" />
                                            <label class="form-label">Cast</label>
                                        </div>
                                    </div>

                            </div>
                                
                                
                            <div class="col-sm-6">
                                    <div class="form-group form-float">
                                            <div class="form-line" id="bs_datepicker_container">
                                                <input type="text" name="anniversary" class="form-control" value="<? echo $anniversary; ?>" placeholder="Please choose Anniversary Date...">
                                                <!--<label class="form-label"></label>-->
                                            </div>
                                        </div>
                                </div>
                                
                        </div>
                        
                        
                        <div class="row clearfix">

                            <div class="col-sm-6 demo-radio-button">
                                    
                                    <label>Gender</label>
                                    <div class="form-group">
                                        <input name="gender" value="male" type="radio" id="radio_1" <? if($gender=='male'){ echo 'checked';}?> />
                                        <label for="radio_1">Male</label>
                                        <input name="gender" value="female" type="radio" id="radio_2" <? if($gender=='female'){ echo 'checked';}?> />
                                        <label for="radio_2">Female</label>
                                    </div>
                                </div>
                                
                            <div class="col-sm-6 demo-radio-button">
                                    
                                    <label>Marrital Status</label>
                                    <div class="form-group">
                                        <input name="marrital_status" value="married" type="radio" id="radio_3" <? if($marrital_status=='married'){ echo 'checked';}?> />
                                        <label for="radio_3">Married</label>
                                        <input name="marrital_status" value="unmarried" type="radio" id="radio_4" <? if($marrital_status=='unmarried'){ echo 'checked';}?> />
                                        <label for="radio_4">Unmarried</label>
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
                                Introducer
                            </h2>
                            
                        </div>
                        <div class="body">
                            
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">


<input list="items" id="item" class="form-control" value="<? echo $introducer_name; ?>">

<datalist id="items">
<?  $sql = mysqli_query($con,"select * from new_member where status=1");
    
    while($sql_result = mysqli_fetch_assoc($sql)){ 
    
    $name = $sql_result['name'];
    $id = $sql_result['id']; ?>

    <option value="<? echo $name; ?>"  data-xyz = "<? echo $id; ?>" >

<? } ?>

</datalist>


                                            <!--<input type="text" name="intro_name" value="<? echo $introducer_name;?>" class="form-control" />-->
                                            <label class="form-label">Introducer Name</label>
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="col-sm-6">
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="intro_mobile" id="intro_mobile" value="<? echo $introducer_mobile;?>" class="form-control" />
                                            <label class="form-label">Introducer Mobile</label>
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
                                            <input type="text" name="pan" value="<? echo $pan; ?>" class="form-control" />
                                            <label class="form-label">Pan Card Number</label>
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="col-sm-4">
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="adhar_card" value="<? echo $adhar_card; ?>" class="form-control" />
                                            <label class="form-label">Adhar Card Number</label>
                                        </div>
                                    </div>

                                </div>
                                
                                
                            <div class="col-sm-4">
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="gst" value="<? echo $gst; ?>" class="form-control" />
                                            <label class="form-label">GST</label>
                                        </div>
                                    </div>

                                </div>



                            
                            </div>
                            
                            
                                <div class="row clearfix">
                                <div class="col-sm-3">
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="bank" value="<? echo $bank; ?>" class="form-control" />
                                            <label class="form-label">Bank Name</label>
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="col-sm-3">
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="account_num" value="<? echo $account_num; ?>" class="form-control" />
                                            <label class="form-label">Account Number</label>
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="col-sm-3">
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="ifsc" value="<? echo $ifsc; ?>" class="form-control" />
                                            <label class="form-label">IFSC Number</label>
                                        </div>
                                    </div>

                                </div>
                                
                                
                              <div class="col-sm-3">
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="account_type" value="<? echo $account_type; ?>" class="form-control" />
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
                                    if($level_id < 8 && $level_id > 0 ){ ?>
                                        <input name="pay_option" value="p" type="checkbox" <? if($mem_status=='p'){ echo 'checked'; }?>/>
                                        <label for="myCheck">Rs 5000/- NON REFUNDABLE</label>
                                    <? }
                                    
                                    ?>
                                    
                                    
                                    
                                    </div>
                                </div>  
                                
                         <div id="text" >
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" value="<? echo $payable_bank; ?> " name="pay_bank" id="pay_bank" class="form-control" />
                                                <label class="form-label">Payable Bank<span class="required">*</span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" name="paid_amount" value="<? echo $amount_paid; ?>" id="paid_amount" class="form-control" />
                                                <label class="form-label">Amount Paid<span class="required">*</span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line" id="bs_datepicker_container">
                                            <input type="text" name="paid_date" id="paid_date" value="<? echo $paid_date; ?>" class="form-control" />
                                            <label class="form-label">Paid Date<span class="required">*</span></label>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-sm-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" value="<? echo $txn_id; ?>" name="paid_id" id="paid_id" class="form-control"/>
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
                    if($proof_image){ ?>
                    
                    <img src="<? echo $proof_image; ?>">
                    <? } else{
                    echo 'No Proof Uploaded ! '; 
                    }
                    ?>
                    </div>
                       
              </div>                      

                                        
                                    </div>

                            </div>
                                
                                
                            
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
            <img id='pass' <? if(get_image('passport',$userid)){ echo "src=".get_image('passport',$userid);}?>>



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
            <img id='aadharfront' <? if(get_image('aadhar_front',$userid)){ echo "src=".get_image('aadhar_front',$userid);}?>>



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
            <img id='aadharback' <? if(get_image('aadhar_back',$userid)){ echo "src=".get_image('aadhar_back',$userid);}?>>




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
            <img id='pancard' <? if(get_image('aadhar_back',$userid)){ echo "src=".get_image('pan_card',$userid);}?>>

        </div>
        
    </div>
    
            </div>
                            

                        
                        
                        
                          </div>
                        </div>
                    </div>
                </div>
                
                
                
                
                
                
                
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

        
        
        
           var member_id = '<? echo $id; ?>';
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
       
       
       
       
       
       
       
       
var get_zone = "<? echo $_GET['zone']; ?>";
var get_state = "<? echo $_GET['state']; ?>";
var get_division = "<? echo $_GET['division']; ?>";
var get_district = "<? echo $_GET['district']; ?>";

    //   var get_taluka = <? echo $_GET['taluka']; ?>;
    //   var get_pincode = <? echo $_GET['pincode']; ?>;
       
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
