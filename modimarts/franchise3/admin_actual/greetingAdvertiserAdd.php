<?php
session_start();

include '../config.php';


function country_name($id)
{

    global $con;

    $sql        = mysqli_query($con, "select * from new_country where id = '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['country'];
}

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

// error_reporting(E_ALL);
// ini_set('display_errors', '1');

if (isset($_POST['submit'])) {
    $cust_name          = $_POST['full_name'];
    $upload_type        = $_POST['upload_type'];
    $bottom_percentage  = $_POST['bottom_percentage'];
    $give_advertisement = $_POST['give_advertisement'];
    $NumberofPerson     = $_POST['NumberofPerson'];
    $NumberofDays       = $_POST['NumberofDays'];
    $TotalAdvertisement = $_POST['TotalAdvertisement'];
    $gender             = $_POST['gender'];
    $mobile             = $_POST['mobile'];
    $MinIncome          = $_POST['MinIncome'];
    $MaxIncome          = $_POST['MaxIncome'];
    $LocationName       = $_POST['LocationName'];

    $password = $_POST['password'];
    $file     = $_FILES['fileInput'];

    $ext  = pathinfo($_FILES['fileInput']['name'], PATHINFO_EXTENSION);
    $name = time() . '.' . $ext;
    $path = '/' . $name;

    //zone==1
    if ($_POST['txtZone'] != null) {
        if ($_POST['txtState'] != null) {
            if ($_POST['txtDivision'] != null) {
                if ($_POST['txtDistrict'] != null) {
                    if ($_POST['txtTaluka'] != null) {
                        if ($_POST['txtPincode'] != null) {

                            if ($_POST['txtVillage'] != null) {
                                $location = $_POST['txtVillage'];
                                
                                    $LocationName = village_name($location);
                               
                                
                            } else {
                                $location = $_POST['txtPincode'];
                                 
                                    $LocationName = pincode_name($location); 
                                
                            }
                        } else {
                            $location = $_POST['txtTaluka'];
                            
                                 $LocationName = taluka_name($location);
                            
                        }
                    } else {
                        $location = $_POST['txtDistrict'];
                         
                             $LocationName = district_name($location);
                         
                    }
                } else {
                    $location = $_POST['txtDivision'];
                     $LocationName = division_name($location);
                     
                }
            } else {
                $location = $_POST['txtState'];
                 
                     $LocationName = state_name($location);
               
                 
            }
        } else {
            $location = $_POST['txtZone'];
           
                $LocationName = zone_name($location);
            
        }

    } else {
        $location = $_POST['txtCountry'];
       
            $LocationName = country_name($location); 
      
    }
    $sql = "INSERT INTO `greetings_advertiser_list`(`client_name`,`upload_type`,`upload_design`, `bottom_percentage`, `give_advertisement`, `total_person`, `total_days`, `total_advertisement`, `gender`, `visible_location`, `location_name`, `min_income`, `max_income`, `mobile_no`, `password` )
     VALUES
     ('" . $cust_name . "','". $upload_type ."','" . $name . "','" . $bottom_percentage . "','" . $give_advertisement . "','" . $NumberofPerson . "','" . $NumberofDays . "','" . $TotalAdvertisement . "','" . $gender . "','" . $location . "','" . $LocationName . "','" . $MinIncome . "','" . $MaxIncome . "','" . $mobile . "','" . $password . "') ";

//   var_dump($LocationName); die;
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
// var_dump($result); die;
    if ($result) {
        move_uploaded_file($_FILES['fileInput']['tmp_name'], $path);
        ?>
        <script>
         alert("register successfully");
        // window.location.href = "greetingAdvertiserList.php";
        </script>
        <?php

    } else {
        ?>
        <script>
         alert("register Failed");
        // window.location.href = "greetingAdvertiserList.php";
        </script>
        <?php

    }

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


    <link href="../css/themes/all-themes.css" rel="stylesheet" />
    <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://allmart.world/franchise/typeahead.js"></script>


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

.custom_row{
    display:flex;
}

.cust_col{
    padding-left:1%;
    padding-right:1%;
}

.typeahead li a{
    font-size: 14px;
}

ul.typeahead{
    width:100%;
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
                                      <img src="https://allmart.world/assets/logo.png" alt="" style="width: 100px;background:white;border-radius: 50%;height: auto;">
                    <span style="margin: auto 5%;">AllMart</span>

                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
              <?include '../menu.php';?>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->


    <section class="content">
        <form id="form" action="#" method="post" enctype="multipart/form-data">




        <div class="container-fluid">
            <div class="block-header">
                <h2> Greetings Advertisement Register  </h2>
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
                                            <input type="text" name="full_name"  class="form-control" required/>
                                            <label class="form-label">Client Name *</label>
                                        </div>
                                    </div>
                                </div>
                                    <div class="col-sm-4 ">

                                        <label>Upload Type</label>
                                        <div class="form-group form-float demo-radio-button">
                                            <input name="upload_type" value="Top"  type="radio" id="radio_1"  onclick="SetOption(this.value)"
                                             checked />
                                            <label for="radio_1">Top</label>

                                            <input name="upload_type" value="Bottom" type="radio" id="radio_2"  onclick="SetOption(this.value)" />
                                            <label for="radio_2">Bottom</label>
                                        </div>
                                    </div>

                                     <div class="col-md-4"  id="advertise">
                                        <label>Advertisement Category</label>
                                        <select class="form-control" id="advertisementCategory">
                                            <option value="">  Category </option>
                                            <option value="Land">Land</option>
                                            <option value="Greetings">Greetings</option>

                                        </select>
                                    </div>


                                </div>
                                <div class="row clearfix">
                                  <div class="col-sm-4 " style="display:none" id="bottomPercentage">

                                    <label>Bottom Portion Percentage</label>
                                    <div class="form-group demo-radio-button">
                                        <input name="bottom_percentage" value="80%" type="radio" id="radio_3" <?if ($bottom_percent == '80%') {echo 'checked';}if ($bottom_percent == '') {echo "checked";}?> />
                                        <label for="radio_3">80%</label>
                                        <input name="bottom_percentage" value="100%" type="radio" id="radio_4" <?if ($bottom_percent == '100%') {echo 'checked';}?> />
                                        <label for="radio_4">100%</label>
                                    </div>
                                </div>

                                <div class="col-sm-4">

                                    <div class="form-group form-float">
                                        <label class="form-label">Upload Design *</label>
                                        <div class="form-line">
                                            <input type="file" name="fileInput" class="form-control" required/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4 ">

                                    <label>Give Advertisement</label>
                                    <div class="form-group demo-radio-button">
                                        <input name="give_advertisement" value="Yes" type="radio" id="radio_5" <?if ($give_advertisement == 'Yes') {echo 'checked';}if ($give_advertisement == '') {echo "checked";}?> />
                                        <label for="radio_5">Yes</label>
                                        <input name="give_advertisement" value="No" type="radio" id="radio_6" <?if ($give_advertisement == 'No') {echo 'checked';}?> />
                                        <label for="radio_6">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                                <input type="number" name="NumberofPerson" class="form-control" value="0" id="val1" onkeyup="Calc()" />
                                                <label class="form-label">Number of Person</label>
                                        </div>
                                    </div>
                                </div>

                            <div class="col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" name="NumberofDays" value="0" class="form-control" id="val2" onkeyup="Calc()"/>
                                            <label class="form-label">Number of Days</label>
                                        </div>
                                    </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" name="TotalAdvertisement" value="0" id="total" class="form-control" readonly />
                                        <label class="form-label">Total Advertisement</label>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row clearfix">

                            <div class="col-sm-4 demo-radio-button">

                                    <label>Gender</label>
                                    <div class="form-group">
                                         <input name="gender" value="both" type="radio" id="radio_9" checked />
                                        <label for="radio_9">Both</label>
                                        <input name="gender" value="male" type="radio" id="radio_7"  />
                                        <label for="radio_7">Male</label>
                                        <input name="gender" value="female" type="radio" id="radio_8" />
                                        <label for="radio_8">Female</label>
                                    </div>
                                </div>

                                <div class="col-sm-8">
                                    <label class="form-label">Visible Location</label>



                                <div class="row custom_row">
                                    <div class="col-md-2">
                                        <!-- <label>Country</label> -->
                                        <input type="text"  id="txtCountry" class="typeahead" style="width:100%" placeholder="Search Country">
                                        <select class="form-control" name="txtCountry" id="country">
                                            <option value="1">India</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2" style="">
                                        <!-- <label>Zone</label> -->
                                        <input type="text"  id="txtZone" class="typeahead" style="width:100%" placeholder="Search Zone">
                                        <select class="form-control" name="txtZone" id="zone">
                                            <option value=""> Zone </option>
                                            <option value="6">Central India</option>
                                            <option value="4">East India</option>
                                            <option value="3">North East</option>
                                            <option value="5">North India</option>
                                            <option value="2">South India</option>
                                            <option value="1">Western India</option>

                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <!-- <label>State</label> -->
                                        <input type="text"  id="txtState" class="typeahead" style="width:100%" placeholder="Search State">
                                        <select class="form-control" name="txtState" id="state">
                                            <option value="">  State </option>
                                        </select>
                                    </div>


                                    <div class="col-md-2">
                                        <!-- <label>Division</label> -->
                                        <input type="text"  id="txtDivision" class="typeahead" style="width:100%" placeholder="Search Division">
                                        <select class="form-control" name="txtDivision" id="division">
                                            <option value=""> Division </option>
                                        </select>
                                    </div>


                                    <div class="col-md-2">
                                        <!-- <label>District</label> -->
                                        <input type="text"  id="txtDistrict" class="typeahead" style="width:100%" placeholder="Search District">
                                        <select class="form-control" name="txtDistrict" id="district">
                                            <option value="">  District </option>
                                        </select>
                                    </div>


                                    <div class="col-md-2">
                                        <!-- <label>Taluka</label> -->
                                        <input type="text"  id="txtTaluka" class="typeahead" style="width:100%" placeholder="Search Taluka">
                                        <select class="form-control" name="txtTaluka" id="taluka">
                                            <option value="">  Taluka </option>
                                        </select>
                                    </div>


                                    <div class="col-md-2">
                                        <!-- <label>Pincode</label> -->
                                        <input type="text" id="txtPincode" class="typeahead" style="width:100%" placeholder="Search Pincode">
                                        <select class="form-control"  name="txtPincode" id="pincode">
                                            <option value="">  Pincode </option>
                                        </select>
                                    </div>


                                    <div class="col-md-2" style="display:none;">
                                        <!-- <label>Village</label> -->
                                        <input type="text"  id="txtVillage" class="typeahead" style="width:100%" placeholder="Search Village">
                                        <select class="form-control" name="txtVillage" id="village">
                                            <option value="">  Village </option>
                                        </select>
                                    </div>


                                </div>


                            </div>

                        </div>

                     <div class="row clearfix">
                                <!--<div class="col-sm-4">-->
                                <!--    <div class="form-group form-float">-->
                                <!--        <div class="form-line">-->
                                <!--                <input type="text" name="LocationName" class="form-control" value="" >-->
                                <!--                <label class="form-label">Location Name</label>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->

                            <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" name="MinIncome" value="" class="form-control" />
                                            <label class="form-label">Minimum Income</label>
                                        </div>
                                    </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" name="MaxIncome" value="" class="form-control"  />
                                        <label class="form-label">Maximum Income</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix" >

                             <div class="col-sm-6">

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" name="mobile"  class="form-control" />
                                            <label class="form-label">Mobile Number</label>
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-sm-6">

                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="password"  class="form-control" />
                                            <label class="form-label">Password</label>
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



  </div>
            </div>
        </div>

        <div style="display:flex;justify-content:center;">
            <button type="submit" name="submit" method="POST" class="btn btn-danger">Submit</button>
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
// Functions

// $(document).ready(function() {
//    $('input[type="radio"]').click(function category(value) {
//        if($(this).attr('id') == 'radio_1') {
//             $('#advertise').show();
//        }

//        else {
//             $('#advertise').hide();
//        }
//    });
// });

// $(document).ready(function() {
//    $('input[type="radio"]').click(function bottom(value) {
//        if($(this).attr('id') == 'radio_2') {
//             $('#bottomPercentage').show();
//        }

//        else {
//             $('#bottomPercentage').hide();
//        }
//    });
// });


      $("#zone").on('change',function(){
             var zone_id = $("#zone").val();
             $.ajax({

                type: "POST",
                url: 'https://allmart.world/franchise/get_state.php',
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
                url: 'https://allmart.world/franchise/get_division.php',
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
                url: 'https://allmart.world/franchise/get_district.php',
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
                url: 'https://allmart.world/franchise/get_taluka.php',
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
                url: 'https://allmart.world/franchise/get_pincode.php',
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
                url: 'https://allmart.world/franchise/get_village.php',
                data: 'pincode_id='+pincode_id,
                success:function(msg) {

            document.getElementById("village").innerHTML = '<option value="">Village</option>';

                    $("#village").html(msg);
                }
            });
         });






//         $("#basic_checkbox_1").on('click',function(){
//               $("#basic_checkbox_2").removeAttr('checked');

//         });
//          $("#basic_checkbox_2").on('click',function(){
//               $("#basic_checkbox_1").removeAttr('checked');
//         });



//         $("#form").submit(function(e) {


//             if($("#basic_checkbox_2").is(':checked') || $("#basic_checkbox_1").is(':checked')){
//                 return true;

//               }
//     alert("Please select at least one to upgrade.");
//     return false;
// });


</script>




<script>

         /* ===============================================================================================================
         Function for Typeahead
         =================================================================================================================*/

 $('#txtCountry').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "https://allmart.world/franchise/get_country.php",
                    data: 'query=' + query,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            }
        });
        /* ===============================================================================================================
         Function for select Zone
         =================================================================================================================*/
        function selectZone(zone){

            //      var zone = this.value;

            $("#txtState").val('');
            $("#txtDistrict").val('');
            $("#txtDivision").val('');
            $("#txtTaluka").val('');
            $("#txtPincode").val('');
            $("#txtVillage").val('');


            $("#division").val('');
            $("#district").val('');
            $("#taluka").val('');
            $("#pincode").val('');
            $("#village").val('');


            $.ajax({
                url: "https://allmart.world/franchise/fill_by_zone.php",
                data: 'zone=' + zone,
                type: "POST",
                success: function (data) {

                    var obj = JSON.parse(data);

                    var zone = obj['zone'];
                    $("#zone").val(zone);

                    $.ajax({
                        type: "POST",
                        url: 'https://allmart.world/franchise/get_zone.php',
                        data: 'zone_id='+zone,
                        success:function(msg) {
                            document.getElementById("state").innerHTML = '<option value="">State</option>';
                            $("#state").html(msg);
                            $('#state option[value="' + state + '"]').prop('selected', true);
                        }
                    });
                }
            });


        }
        $('#txtZone').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "https://allmart.world/franchise/get_zone1.php",
                    data: 'query=' + query,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            },
            updater: function(item) {
                selectZone(item);
                console.log("selectZone====="+item)
                return item;
            }
        });

        /* ===============================================================================================================
         Function for select State
         =================================================================================================================*/
        function selectState(state){

            // var state = this.value;

            $("#txtZone").val('');
            $("#txtDivision").val('');
            $("#txtDistrict").val('');
            $("#txtTaluka").val('');
            $("#txtPincode").val('');
            $("#txtVillage").val('');

            //  $("#division").val('');
            $("#district").val('');
            $("#taluka").val('');
            $("#pincode").val('');
            $("#village").val('');

            $.ajax({
                url: "https://allmart.world/franchise/fill_by_state.php",
                data: 'state=' + state,
                type: "POST",
                success: function (data) {

                    var obj = JSON.parse(data);

                    var zone = obj['zone'];
                    var state = obj['state'];
                    var division = obj['division_id'];
                    $("#zone").val(zone);

                    $.ajax({
                        type: "POST",
                        url: 'https://allmart.world/franchise/get_state.php',
                        data: 'zone_id='+zone,
                        success:function(msg) {
                            document.getElementById("state").innerHTML = '<option value="">State</option>';
                            $("#state").html(msg);
                            $('#state option[value="' + state + '"]').prop('selected', true);
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: 'https://allmart.world/franchise/get_division.php',
                        data: 'state_id='+state,
                        success:function(msg) {
                            document.getElementById("division").innerHTML = '<option value="">Division</option>';
                            $("#division").html(msg);
                            $('#division option[value="' + division + '"]').prop('selected', true);
                        }
                    });

                }
            });


        }
        $('#txtState').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "https://allmart.world/franchise/get_state1.php",
                    data: 'query=' + query,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {

                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            },updater: function(item) {
                selectState(item.name);
                console.log("selectState====="+item.name)
                return item;
            }
        });
        /* ===============================================================================================================
         Function for select Pincode
         =================================================================================================================*/
        function selectPincode(pincode){

            //var pincode = this.value;

            $("#txtZone").val('');
            $("#txtState").val('');
            $("#txtDivision").val('');
            $("#txtDistrict").val('');
            $("#txtTaluka").val('');
            $("#txtVillage").val('');


            $.ajax({
                url: "https://allmart.world/franchise/fill_by_pin.php",
                data: 'pincode=' + pincode,
                type: "POST",
                success: function (data) {

                    console.log(data);

                    var obj = JSON.parse(data);
                    var zone = obj['zone'];
                    var state = obj['state'];
                    var division = obj['division'];
                    var district = obj['district'];
                    var taluka = obj['taluka'];
                    var pincode_id = obj['pincode_id'];
                    $("#zone").val(zone);


                    $.ajax({
                        type: "POST",
                        url: 'https://allmart.world/franchise/get_state.php',
                        data: 'zone_id='+zone,
                        success:function(msg) {
                            document.getElementById("state").innerHTML = '<option value="">State</option>';
                            $("#state").html(msg);
                            $('#state option[value="' + state + '"]').prop('selected', true);
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: 'https://allmart.world/franchise/get_division.php',
                        data: 'state_id='+state,
                        success:function(msg) {
                            document.getElementById("division").innerHTML = '<option value="">Division</option>';
                            $("#division").html(msg);
                            $('#division option[value="' + division + '"]').prop('selected', true);
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: 'https://allmart.world/franchise/get_district.php',
                        data: 'division_id='+division,
                        success:function(msg) {
                            document.getElementById("district").innerHTML = '<option value="">District</option>';
                            $("#district").html(msg);
                            $('#district option[value="' + district + '"]').prop('selected', true);
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: 'https://allmart.world/franchise/get_taluka.php',
                        data: 'district_id='+district,
                        success:function(msg) {
                            document.getElementById("taluka").innerHTML = '<option value="">Taluka</option>';
                            $("#taluka").html(msg);
                            $('#taluka option[value="' + taluka + '"]').prop('selected', true);
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: 'https://allmart.world/franchise/get_pincode.php',
                        data: 'taluka_id='+taluka,
                        success:function(msg) {
                            document.getElementById("pincode").innerHTML = '<option value="">Pincode</option>';
                            $("#pincode").html(msg);
                            $('#pincode option[value="' + pincode_id + '"]').prop('selected', true);
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: 'https://allmart.world/franchise/get_village.php',
                        data: 'pincode_id='+pincode_id,
                        success:function(msg) {


                            document.getElementById("village").innerHTML = '<option value="">village</option>';
                            $("#village").html(msg);
                            $('#village option[value="' + village + '"]').prop('selected', true);
                        }
                    });
                }
            });


        }
        $('#txtPincode').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "https://allmart.world/franchise/get_pincode1.php",
                    data: 'query=' + query,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            },
            updater: function(item) {
                selectPincode(item.name);
                console.log("selectPincode====="+item.id)
                return item;
            }
        });

        /* ===============================================================================================================
         Function for select division
         =================================================================================================================*/
        function selectDivision(division){
            //    var division = this.value;

            $("#txtZone").val('');
            $("#txtState").val('');
            $("#txtDistrict").val('');
            $("#txtTaluka").val('');
            $("#txtPincode").val('');
            $("#txtVillage").val('');



            //  $("#division").val('');
            // $("#district").val('');
            $("#taluka").val('');
            $("#pincode").val('');
            $("#village").val('');

            $.ajax({
                url: "https://allmart.world/franchise/fill_by_division.php",
                data: 'division=' + division,
                type: "POST",
                success: function (data) {

                    var obj = JSON.parse(data);
                    var zone = obj['zone'];
                    var state = obj['state'];
                    var division = obj['division_id'];

                    $("#zone").val(zone);


                    $.ajax({
                        type: "POST",
                        url: 'https://allmart.world/franchise/get_state.php',
                        data: 'zone_id='+zone,
                        success:function(msg) {
                            document.getElementById("state").innerHTML = '<option value="">State</option>';
                            $("#state").html(msg);
                            $('#state option[value="' + state + '"]').prop('selected', true);
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: 'https://allmart.world/franchise/get_division.php',
                        data: 'state_id='+state,
                        success:function(msg) {
                            document.getElementById("division").innerHTML = '<option value="">Division</option>';
                            $("#division").html(msg);
                            $('#division option[value="' + division + '"]').prop('selected', true);
                        }
                    });


                    $.ajax({
                        type: "POST",
                        url: 'https://allmart.world/franchise/get_district.php',
                        data: 'division_id='+division,
                        success:function(msg) {
                            document.getElementById("district").innerHTML = '<option value="">District</option>';
                            $("#district").html(msg);
                            $('#district option[value="' + district + '"]').prop('selected', true);
                        }
                    });


                }
            });


        }
        $('#txtDivision').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "https://allmart.world/franchise/get_division1.php",
                    data: 'query=' + query,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            },
            updater: function(item) {
                selectDivision(item.id);
                console.log("selectDivision====="+item)
                return item;
            }
        });

        /* ===============================================================================================================
         Function for select District
         =================================================================================================================*/
        function selectDist(district){
            //var district = selectVal;

            $("#txtZone").val('');
            $("#txtState").val('');
            $("#txtDivision").val('');
            $("#txtTaluka").val('');
            $("#txtPincode").val('');
            $("#txtVillage").val('');

            //  $("#division").val('');
            // $("#district").val('');
            // $("#taluka").val('');
            $("#pincode").val('');
            $("#village").val('');




            $.ajax({
                url: "https://allmart.world/franchise/fill_by_district.php",
                data: 'district=' + district,
                type: "POST",
                success: function (data) {

                    var obj = JSON.parse(data);
                    var zone = obj['zone'];
                    var state = obj['state'];
                    var division = obj['division'];
                    var district = obj['district_id'];
                    $("#zone").val(zone);


                    $.ajax({
                        type: "POST",
                        url: 'https://allmart.world/franchise/get_state.php',
                        data: 'zone_id='+zone,
                        success:function(msg) {
                            document.getElementById("state").innerHTML = '<option value="">State</option>';
                            $("#state").html(msg);
                            $('#state option[value="' + state + '"]').prop('selected', true);
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: 'https://allmart.world/franchise/get_division.php',
                        data: 'state_id='+state,
                        success:function(msg) {
                            document.getElementById("division").innerHTML = '<option value="">Division</option>';
                            $("#division").html(msg);
                            $('#division option[value="' + division + '"]').prop('selected', true);
                        }
                    });


                    $.ajax({
                        type: "POST",
                        url: 'https://allmart.world/franchise/get_district.php',
                        data: 'division_id='+division,
                        success:function(msg) {
                            document.getElementById("district").innerHTML = '<option value="">District</option>';
                            $("#district").html(msg);
                            $('#district option[value="' + district + '"]').prop('selected', true);
                        }
                    });


                    $.ajax({
                        type: "POST",
                        url: 'https://allmart.world/franchise/get_taluka.php',
                        data: 'district_id='+district,
                        success:function(msg) {
                            document.getElementById("taluka").innerHTML = '<option value="">Taluka</option>';
                            $("#taluka").html(msg);
                            $('#taluka option[value="' + taluka + '"]').prop('selected', true);
                        }
                    });

                }
            });
        }


        $('#txtDistrict').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "https://allmart.world/franchise/get_district1.php",
                    data: 'query=' + query,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            },
            updater: function(item) {
                selectDist(item.id);
                console.log("====="+item)
                return item;
            }
        });


        /* ===================================================================================================================
         Function for select Taluka
         ===================================================================================================================*/
        function selectTaluka(taluka){

            // var taluka = taluka;

            $("#txtZone").val('');
            $("#txtState").val('');
            $("#txtDivision").val('');
            $("#txtDistrict").val('');
            $("#txtPincode").val('');
            $("#txtVillage").val('');


//  $("#division").val('');
//             $("#district").val('');
//             $("#taluka").val('');
//             $("#pincode").val('');
            $("#village").val('');




            $.ajax({
                url: "https://allmart.world/franchise/fill_by_taluka.php",
                data: 'taluka=' + taluka,
                type: "POST",
                success: function (data) {

                    var obj = JSON.parse(data);
                    var zone = obj['zone'];
                    var state = obj['state'];
                    var division = obj['division'];
                    var district = obj['district'];
                    var taluka = obj['taluka_id'];
                    // var pincode_id = obj['pincode_id'];
                    $("#zone").val(zone);


                    $.ajax({
                        type: "POST",
                        url: 'https://allmart.world/franchise/get_state.php',
                        data: 'zone_id='+zone,
                        success:function(msg) {
                            document.getElementById("state").innerHTML = '<option value="">State</option>';
                            $("#state").html(msg);
                            $('#state option[value="' + state + '"]').prop('selected', true);
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: 'https://allmart.world/franchise/get_division.php',
                        data: 'state_id='+state,
                        success:function(msg) {
                            document.getElementById("division").innerHTML = '<option value="">Division</option>';
                            $("#division").html(msg);
                            $('#division option[value="' + division + '"]').prop('selected', true);
                        }
                    });


                    $.ajax({
                        type: "POST",
                        url: 'https://allmart.world/franchise/get_district.php',
                        data: 'division_id='+division,
                        success:function(msg) {
                            document.getElementById("district").innerHTML = '<option value="">District</option>';
                            $("#district").html(msg);
                            $('#district option[value="' + district + '"]').prop('selected', true);
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: 'https://allmart.world/franchise/get_taluka.php',
                        data: 'district_id='+district,
                        success:function(msg) {
                            document.getElementById("taluka").innerHTML = '<option value="">Taluka</option>';
                            $("#taluka").html(msg);
                            $('#taluka option[value="' + taluka + '"]').prop('selected', true);
                        }
                    });


                    $.ajax({
                        type: "POST",
                        url: 'https://allmart.world/franchise/get_pincode.php',
                        data: 'taluka_id='+taluka,
                        success:function(msg) {
                            document.getElementById("pincode").innerHTML = '<option value="">Pincode</option>';
                            $("#pincode").html(msg);
                            // $('#pincode option[value="' + pincode_id + '"]').prop('selected', true);
                        }
                    });
                }
            });



        }


        $('#txtTaluka').typeahead({
            source: function (query, result) {
                console.log("Call data"+j)
                j++;
                $.ajax({
                    url: "https://allmart.world/franchise/get_taluka1.php",
                    data: 'query=' + query,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            },
            updater: function(item) {
                selectTaluka(item.id);
                console.log("====="+item)
                return item;
            }
        });

        /* ==================================================================================================================
         Function for select Village
         =====================================================================================================================*/
        function selectVillage(village){

            //var village = this.value;

            $("#txtZone").val('');
            $("#txtState").val('');
            $("#txtDivision").val('');
            $("#txtDistrict").val('');
            $("#txtTaluka").val('');
            $("#txtPincode").val('');


            $("#mem_id").val('');
            $("#mem_name").val('');
            $("#mem_mobile").val('');


            $.ajax({
                url: "https://allmart.world/franchise/fill_by_village.php",
                data: 'village=' + village,
                type: "POST",
                success: function (data) {

                    var obj = JSON.parse(data);
                    var zone = obj['zone'];
                    var state = obj['state'];
                    var division = obj['division'];
                    var district = obj['district'];
                    var taluka = obj['taluka'];
                    var pincode = obj['pincode'];
                    var village_id = obj['village'];

                    $("#zone").val(zone);


                    $.ajax({
                        type: "POST",
                        url: 'https://allmart.world/franchise/get_state.php',
                        data: 'zone_id='+zone,
                        success:function(msg) {
                            document.getElementById("state").innerHTML = '<option value="">State</option>';
                            $("#state").html(msg);
                            $('#state option[value="' + state + '"]').prop('selected', true);
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: 'https://allmart.world/franchise/get_division.php',
                        data: 'state_id='+state,
                        success:function(msg) {
                            document.getElementById("division").innerHTML = '<option value="">Division</option>';
                            $("#division").html(msg);
                            $('#division option[value="' + division + '"]').prop('selected', true);
                        }
                    });


                    $.ajax({
                        type: "POST",
                        url: 'https://allmart.world/franchise/get_district.php',
                        data: 'division_id='+division,
                        success:function(msg) {
                            document.getElementById("district").innerHTML = '<option value="">District</option>';
                            $("#district").html(msg);
                            $('#district option[value="' + district + '"]').prop('selected', true);
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: 'https://allmart.world/franchise/get_taluka.php',
                        data: 'district_id='+district,
                        success:function(msg) {
                            document.getElementById("taluka").innerHTML = '<option value="">Taluka</option>';
                            $("#taluka").html(msg);
                            $('#taluka option[value="' + taluka + '"]').prop('selected', true);
                        }
                    });


                    $.ajax({
                        type: "POST",
                        url: 'https://allmart.world/franchise/get_pincode.php',
                        data: 'taluka_id='+taluka,
                        success:function(msg) {
                            document.getElementById("pincode").innerHTML = '<option value="">Pincode</option>';
                            $("#pincode").html(msg);
                            $('#pincode option[value="' + pincode + '"]').prop('selected', true);
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: 'https://allmart.world/franchise/get_village.php',
                        data: 'pincode_id='+pincode,
                        success:function(msg) {

                            document.getElementById("village").innerHTML = '<option value="">village</option>';
                            $("#village").html(msg);
                            $('#village option[value="' + village_id + '"]').prop('selected', true);
                        }
                    });
                }
            });

        }

        $('#txtVillage').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "https://allmart.world/franchise/get_village1.php",
                    data: 'query=' + query,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            },

            updater: function(item) {
                selectVillage(item);
                console.log("====="+item)
                return item;
            }
        });

</script>

<script>
    function SetOption(val)
    {
        if(val=="Bottom")
        {
          $("#bottomPercentage").show();
          $("#advertise").hide();
        }
        else
        {
            $("#advertise").show();
             $("#bottomPercentage").hide();

        }


    }
    
    function Calc()
    {
        var val1=$("#val1").val();
        var val2=$("#val2").val();
        if(val1!="" && val2!="")
        {
            console.log(val1);
            console.log(val2);
            var total = val1 * val2;
            $("#total").val(total);
        }
        else{
            $("#total").val("0");
        }
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
