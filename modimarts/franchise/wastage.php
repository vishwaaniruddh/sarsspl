<? include('config.php');?>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Basic Form Elements | Bootstrap Based Admin Template - Material Design</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <!--<link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />-->

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />
    
    <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  
  
    <link href="plugins/dropzone/dropzone.css" rel="stylesheet">
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
                
                <a class="navbar-brand" href="index.php" style="display:flex;height: 100px;margin: auto; line-height: 3;     padding: 0;
    width: 100%;">
                                    <img src="logo.jpg" style="width:100px;" >
                    <span style="margin: auto 5%;">AllMart</span>
                
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li>
                        <a href="members.php" class="">Member</a>
                    </li>
                    
                    <li>
                        <a href="get_members.php" class="">Member Filter</a>
                    </li>
                    
                    
                    
                    <li>
                        <a href="apply.php" class="">Apply</a>
                    </li>
                    
                    <li>
                        <a href="pending_approve.php" class="">Pending Approve</a>
                    </li>
                   
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->


    <section class="content">
        <form id="form" action="process_apply.php" method="post" enctype="multipart/form-data">
        <div class="container-fluid">
            <div class="block-header">
                <h2> Franchise Application form</h2>
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
                                <div class="col-sm-12">
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="full_name" class="form-control" />
                                            <label class="form-label">Full Name</label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            
                            <div class="row clearfix">
                                
                                <div class="col-sm-4">
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="mobile" class="form-control" />
                                            <label class="form-label">Phone Number</label>
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="col-sm-4">
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="email" name="email" class="form-control" />
                                            <label class="form-label">Email Id</label>
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="col-sm-4">
                                    <div class="form-group form-float">
                                            <div class="form-line" id="bs_datepicker_container">
                                                <input type="text" name="dob" class="form-control" placeholder="Please choose Date Of Birth...">
                                                <!--<label class="form-label"></label>-->
                                            </div>
                                        </div>
                                </div>
                        </div>
                        
                        
                        <div class="row clearfix">
                            
                            <div class="col-sm-6">
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="cast" class="form-control" />
                                            <label class="form-label">Cast</label>
                                        </div>
                                    </div>

                            </div>
                                
                                
                            <div class="col-sm-6">
                                    <div class="form-group form-float">
                                            <div class="form-line" id="bs_datepicker_container">
                                                <input type="text" name="anniversary" class="form-control" placeholder="Please choose Anniversary Date...">
                                                <!--<label class="form-label"></label>-->
                                            </div>
                                        </div>
                                </div>
                                
                        </div>
                        
                        
                        <div class="row clearfix">

                            <div class="col-sm-6 demo-radio-button">
                                    
                                    <label>Gender</label>
                                    <div class="form-group">
                                        <input name="gender" value="male" type="radio" id="radio_1" checked />
                                        <label for="radio_1">Male</label>
                                        <input name="gender" value="female" type="radio" id="radio_2" />
                                        <label for="radio_2">Female</label>
                                    </div>
                                </div>
                                
                            <div class="col-sm-6 demo-radio-button">
                                    
                                    <label>Marrital Status</label>
                                    <div class="form-group">
                                        <input name="marrital_status" value="married" type="radio" id="radio_3" checked />
                                        <label for="radio_3">Married</label>
                                        <input name="marrital_status" value="unmarried" type="radio" id="radio_4" />
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
                                            <input type="text" name="intro_name" class="form-control" />
                                            <label class="form-label">Introducer Name</label>
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="col-sm-6">
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="intro_mobile" class="form-control" />
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
                            <h2>Address</h2>
                            
                        </div>
                        <div class="body">
                            
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="address" class="form-control" />
                                            <label class="form-label">Residing Address</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                  
                                  
                                  <select class="form-control" name="country">
                                        <option value="1">India</option>
                                    </select>
                                  
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control" name="zone">
                                    
                                    <?
                                    $zone_sql = mysqli_query($con,"select * from new_zone where id = '".$_GET['zone']."'");
                                    $zone_sql_result = mysqli_fetch_assoc($zone_sql); ?>

                                    <option value="<? echo $zone_sql_result['id']?>"><? echo $zone_sql_result['zone'];?></option>
                                    

                                    </select>
                                </div>
                                
                                
                                <div class="col-sm-3">
                                  
                                   <select class="form-control" name="state" >
                                    
                                    <?    $state_sql = mysqli_query($con,"select * from new_state where id = '".$_GET['state']."'");
                                    $state_sql_result = mysqli_fetch_assoc($state_sql); ?>

                                    <option value="<? echo $state_sql_result['id']?>"><? echo $state_sql_result['state'];?></option>

                                    </select>
                                    
                                </div>
                                
                                <div class="col-sm-3">
                                   <select class="form-control" name="division">
                                        <?    $division_sql = mysqli_query($con,"select * from new_division where id = '".$_GET['division']."'");
                                        $division_sql_result = mysqli_fetch_assoc($division_sql); ?>
                                        <option value="<? echo $division_sql_result['id']?>"><? echo $division_sql_result['division'];?></option>
                                    </select>
                                </div>
                            
                            </div>
                            
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                  <select class="form-control" name="district">
                                        
                                        <?    $district_sql = mysqli_query($con,"select * from new_district where id = '".$_GET['district']."'");
                                        $district_sql_result = mysqli_fetch_assoc($district_sql); ?>
                                        <option value="<? echo $district_sql_result['id']?>"><? echo $district_sql_result['district'];?></option>
                                        
                                    </select>
                                </div>
                                
                                <div class="col-sm-3">
                                    <select class="form-control" name="taluka">

                                        <?    $taluka_sql = mysqli_query($con,"select * from new_taluka where id = '".$_GET['taluka']."'");
                                        $taluka_sql_result = mysqli_fetch_assoc($taluka_sql); ?>
                                        <option value="<? echo $taluka_sql_result['id']?>"><? echo $taluka_sql_result['taluka'];?></option>

                                    </select>
                                </div>
                                
                                
                                
                            <div class="col-sm-3">
                                <select class="form-control" name="pincode">
                                    <?    $pincode_sql = mysqli_query($con,"select * from new_pincode where id = '".$_GET['pincode']."'");
                                    $pincode_sql_result = mysqli_fetch_assoc($pincode_sql); ?>
                                    <option value="<? echo $pincode_sql_result['id']?>"><? echo $pincode_sql_result['pincode'];?></option>
                            
                                </select>
                            </div>
                                
                            <div class="col-sm-3">
                                <select class="form-control" name="village">
                                    <?    $village_sql = mysqli_query($con,"select * from new_village where id = '".$_GET['village']."'");
                                    $village_sql_result = mysqli_fetch_assoc($village_sql); ?>
                                    <option value="<? echo $village_sql_result['id']?>"><? echo $village_sql_result['village'];?></option>
                            
                                </select>
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
                                <div class="col-sm-6">
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="pan" class="form-control" />
                                            <label class="form-label">Pan Card Number</label>
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="col-sm-6">
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="adhar_card" class="form-control" />
                                            <label class="form-label">Adhar Card Number</label>
                                        </div>
                                    </div>

                                </div>
                            
                            </div>
                            
                            
                                <div class="row clearfix">
                                <div class="col-sm-3">
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="bank" class="form-control" />
                                            <label class="form-label">Bank Name</label>
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="col-sm-3">
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="account_num" class="form-control" />
                                            <label class="form-label">Account Number</label>
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="col-sm-3">
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="ifsc" class="form-control" />
                                            <label class="form-label">IFSC Number</label>
                                        </div>
                                    </div>

                                </div>
                                
                                
                              <div class="col-sm-3">
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="account_type" class="form-control" />
                                            <label class="form-label">Bank Account Type</label>
                                        </div>
                                    </div>

                                </div>
                            
                            </div>
                            
                            <div class="row clearfix">
                                <div class="col-sm-6 demo-radio-button">
                                    
                                    <label>Payment Option</label>
                                    <div class="form-group">
                                        <input name="pay_option" value="5000" type="radio" id="radio_5" checked />
                                        <label for="radio_5">Option 1: Rs 5000/- NON REFUNDABLE</label>
                                        <input name="pay_option" value="10000" type="radio" id="radio_6" />
                                        <label for="radio_6">Option 2: rS. 1,00,000/- ADVANCE FOR GOODS PURCHASE</label>
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="gst" class="form-control" />
                                            <label class="form-label">GST</label>
                                        </div>
                                    </div>

                                </div>
                            
                            </div>
                                
                            
<div class="row clearfix">
    <div class="col-sm-3">
            <div class="form-group">
                <label class="form-label">Passport</label>
                <div class="form-line">
                    <input type="file" name="passport" class="form-control" />

                </div>
            </div>
        
    </div>

    <div class="col-sm-3">
            <div class="form-group">
                <label class="form-label">Aadhar Card Front</label>
                <div class="form-line">
                    <input type="file" name="aadhar_front" class="form-control" />

                </div>
            </div>
        
    </div>
    
    <div class="col-sm-3">
            <div class="form-group">
                <label class="form-label">Aadhar Card Back</label>
                <div class="form-line">
                    <input type="file" name="aadhar_back" class="form-control" />

                </div>
            </div>
        
    </div>
    
    
    <div class="col-sm-3">
            <div class="form-group">
                <label class="form-label">Pan Card Photo</label>
                <div class="form-line">
                    <input type="file" name="pan_card" class="form-control" />

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
                                Terms & Conditions
                            </h2>
                            
                        </div>
                        <div class="body">
                            
    <div class="row clearfix">
        <div class="col-sm-12">
            
        <span>I will abide by the Rules & Regulations of the company from time to time * </span>
        <br>
        <br>
        <div class="demo-checkbox">
            <input type="checkbox" id="basic_checkbox_1" class="filled-in">
            <label for="basic_checkbox_1">Yes</label>
            <input type="checkbox" id="basic_checkbox_2" class="filled-in">
            <label for="basic_checkbox_2">No</label>
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
            <input type="submit" name="submit" value="submit" class="btn btn-danger">
        </div>
        
        
        </form>
    </section>
    <br>
    <br>
    <br>
    

    
    <script>
    
    
    $("document").ready(function(){
       
       
       var get_zone = <? echo $_GET['zone']; ?>;
       var get_state = <? echo $_GET['state']; ?>;
       var get_division = <? echo $_GET['division']; ?>;
       var get_district = <? echo $_GET['district']; ?>;
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
        


        $("#form").submit(function(e) {
            
            
            if($("#basic_checkbox_2").is(':checked') || $("#basic_checkbox_1").is(':checked')){
                return true;
                
              }      
    alert("Please select at least one to upgrade.");
    return false;
});





    </script>







    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <!--<script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>-->

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Autosize Plugin Js -->
    <script src="plugins/autosize/autosize.js"></script>

    <!-- Moment Plugin Js -->
    <script src="plugins/momentjs/moment.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/forms/basic-form-elements.js"></script>
<script src="plugins/dropzone/dropzone.js"></script>
    <!-- Demo Js -->
    <script src="js/demo.js"></script>
</body>
</html>







<!--Start Kit-->

<!--    <div class="franchisee_presentation">-->
<!--            <h2 style="text-align: center;">Kit</h2><br>-->

<!--            <div class="row">-->
                
                
                
                
<!--                <? -->
                

<!--function image_url($id){-->
<!--    global $con1;-->
    
<!--    $sql = mysqli_query($con1,"select * from kits_img where product_id ='".$id."'");-->
<!--    $sql_result = mysqli_fetch_assoc($sql);-->
    
<!--    return $sql_result['midsize'];-->
    
<!--}-->
                
<!--                $kit_sql = mysqli_query($con1,"select * from kits order by code desc limit 5");-->
                
<!--                while($kit_sql_result = mysqli_fetch_assoc($kit_sql)){ -->
                
<!--                $id = $kit_sql_result['code'];-->
<!--                $photo = image_url($id);-->
<!--                $name = $kit_sql_result['name'];-->
<!--                $amount = $kit_sql_result['total_amt'];-->
<!--                $photo = "https://allmart.world/ecom/".$photo;-->
<!--                $cat = $kit_sql_result['category'];-->
<!--                ?>-->
    
<!--                    <div class="col-lg-4 col-md-6 col-12">-->
<!--                        <div class="card">-->
<!--                            <a href="../allmart/product_detail.php?pid=<?php echo $id;?>&catid=761&prod_id=<?php echo $name ;?>">-->
<!--                                <img src="<? echo $photo; ?>" alt="" style="width:100%;     object-fit: contain;">-->
<!--                                <div class="container">-->
<!--                                <center>  <h5><b style="color:black;"><? echo $name; ?></b></h5>-->
<!--                                  <h5><b style="color:black;">Rs <? echo $amount; ?></b></h5></center>-->
<!--                                </div>-->
<!--                            </a>-->
                            
<!--                        </div>-->
<!--                    </div>-->
                    
<!--                <? } ?>-->
                
                


<!--            </div>-->
<!--        </div>-->
                <!--<div class="view_all" style="display: flex; justify-content: center;">-->
                <!--    <a href="https://allmart.world/allmart/product.php?catid=761" style="color:red; font-size:24px; font-weight:900;">View All Kit</a>-->
                <!--</div>-->

<!--End Kit-->

