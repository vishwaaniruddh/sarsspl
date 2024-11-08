<?php
session_start();
// var_dump($_SESSION);
if (!isset($_SESSION['username']) && $_SESSION['userid']=='1') {
    ?>

    <script>
        window.location.href='https://modimart.world/franchise6/admin/login_form.php';
    </script>

<?
}
include '../config.php';

$admnid=$_GET['admnid'];

$getuserdata=mysqli_query($con3,"SELECT * FROM `Users` WHERE UserId='".$admnid."'");
$getusrData=mysqli_fetch_assoc($getuserdata);

?>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Add User | All Mart</title>
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
/*img{
    width: 100%;
    object-fit: cover;
    height: 350px;
}*/

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
                    

                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
              <?include '../menu.php';?>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->


    <section class="content">           


        <div class="container-fluid">
            
                            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>View Users</h2>

                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                <label class="form-label">Designation</label>
                                  <select class="form-control" name="UserType" required>
                                        <option <?php if($getusrData['UserType']=="Admin"){ echo "selected";} ?> value="Admin">Admin</option>
                                        <option <?php if($getusrData['UserType']=="Director"){ echo "selected";} ?> value="Director">Director</option>
                                        <option <?php if($getusrData['UserType']=="Staff"){ echo "selected";} ?> value="Staff">Staff</option>
                                        <option <?php if($getusrData['UserType']=="Telecaller"){ echo "selected";} ?> value="Telecaller">Telecaller</option>
                                        <option <?php if($getusrData['UserType']=="BackOffice"){ echo "selected";} ?> value="BackOffice">BackOffice</option>
                                        <option <?php if($getusrData['UserType']=="DTP"){ echo "selected";} ?> value="DTP">DTP</option>
                                        <option <?php if($getusrData['UserType']=="Marketing-Head"){ echo "selected";} ?> value="Marketing-Head">Marketing-Head</option>
                                        <option <?php if($getusrData['UserType']=="Godown-incharge"){ echo "selected";} ?> value="Godown-incharge">Godown-Incharge</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                     <div class="form-line">
                                        <label class="form-label">Enter User Name</label>
                                            <input type="text" value="<?=$getusrData['UserName']?>" name="UserName"  class="form-control" required />
                                            <input type="hidden" value="<?=$admnid?>" name="UserId">
                                        </div>
                                </div>
                                <div class="col-sm-3">
                                     <div class="form-line">
                                        <label class="form-label">Enter Full Name</label>
                                            <input type="text" name="FullName" value="<?=$getusrData['Full_Name']?>" class="form-control" required />
                                            
                                        </div>
                                </div>
                                <div class="col-sm-3">
                                     <div class="form-line">
                                            <label class="form-label">Enter Password</label>
                                            <input type="text" name="password" value="<?=$getusrData['Password']?>" class="form-control" required />
                                           
                                        </div>
                                </div>
                                <div class="col-sm-3">
                                     <div class="form-line">
                                            <label class="form-label">User Status</label>
                                            <select name="status" id="" class="form-control">
                                                <option
                                                 <?php if ($getusrData['UserName']=='1'){echo "selected";} ?> value="1">Active</option>
                                                <option <?php if ($getusrData['UserName']=='0'){echo "selected";}?> value="0">Disactive</option>
                                            </select>
                                           
                                        </div>
                                </div>
                                <div class="col-sm-3">
                                     <div class="form-line">
                                        <label class="form-label">Insert Profile Image</label>
                                        <input type="file" name="image"  class="form-control" required />
                                        <input type="hidden" value="<?=$getusrData['image']?>" name="oldimg">
                                        <img src="https://www.modimart.world/<?=$getusrData['image']?>" alt="" width="100px" height="100px">

                                            
                                        </div>
                                </div>
                            </div>

                            
                            <div class="row clearfix">
                                <div class="col-md-12 text-right">
                        
                        <a  class="btn btn-lg  btn-danger" href="https://www.modimart.world/franchise6/admin/Users.php">Back</a>
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


        <!-- </form> -->
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
