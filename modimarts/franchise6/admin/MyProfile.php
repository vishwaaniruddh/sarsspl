<?php
session_start();
// var_dump($_SESSION);

if (!isset($_SESSION['userid'])) {
    ?>

    <script>
        window.location.href='https://modimart.world/franchise6/admin/login_form.php';
    </script>

<?
}
include '../config.php';


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
                            <h2>
                               Users Details
                               <a href="AddUsers.php" style="float:right;" class="btn btn-success">Add Users</a>
                            </h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-12">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable" style="cursor: pointer;" id="example">
                                    <thead>
                                        <tr role="row">
                                            <th>S.no</th>
                                            <th>User Name</th>
                                            <th>User mobile</th>
                                            <th>User id</th>
                                            <th>User Type</th>
                                            <th>User Status</th>
                                            <th>details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 

                                        var_dump($_SESSION['userid']);
                                        $userid=$_SESSION['userid'];
                                        $Usersdata=mysqli_query($con3,"SELECT * FROM `Users` WHERE UserId='".$userid."'");
                                        foreach ($Usersdata as $key => $value) {
                                             ?>
                                             <tr>
                                                 <td><?=$key+1?></td>
                                                 <td><?=$value['Full_Name']?></td>
                                                 <td><?=$value['mobile']?></td>
                                                 <td><?=$value['UserName']?></td>
                                                 <td><?=$value['UserType']?></td>
                                                 <td>
                                                    <?php if($value['status']==1){ echo "Active";}else{ echo "disactive"; } ?>
                                                   </td>
                                                 <td>
                                                     <a class="btn btn-primary" href="viewUsers.php?admnid=<?=$value['UserId']?>">View</a>
                                                     <a class="btn btn-info" href="editUsers.php?admnid=<?=$value['UserId']?>">Edit</a>
                                                    
                                                 </td>
                                             </tr>
                                             <?php
                                         } ?>
                                    </tbody>
                                </table></div></div></div>
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
            </div>
        </div>

        </form>
    </section>

<script>
    $('#example').DataTable();
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
    <script>
        function CheckDelete()
        {
            return confirm("Are You Sure Delete This Records");
        }
    </script>
</body>
</html>
