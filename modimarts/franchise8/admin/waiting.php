<? session_start();
include('../config.php');



if(!isset($_SESSION["username"])) {
	header("Location:login_form.php");
}


function get_country($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_country where id='".$id."'");
    
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['country'];
}


function get_state($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_state where id='".$id."'");
    
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['state'];
}


function get_zone($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_zone where id='".$id."'");
    
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['zone'];
}

function get_division($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_division where id='".$id."'");
    
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['division'];
}


function get_district($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_district where id='".$id."'");
    
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['district'];
}


function get_taluka($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_taluka where id='".$id."'");
    
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['taluka'];
}


function get_pincode($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_pincode where id='".$id."'");
    
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['pincode'];
}


function get_village($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_village where id='".$id."'");
    
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['village'];
}




?>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>All Mart | Members </title>
    <!-- Favicon-->
    <link rel="icon" href="../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="../https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="../https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />
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
                
                <a class="navbar-brand" href="http://www.modimarts.com/franchise8/" style="display:flex;height: 100px;margin: auto; line-height: 3;     padding: 0;
    width: 100%;">
                                    <img src="https://modimarts.com/assets/logo.png" style="width:100px;" >
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
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Welcome
                </h2>
            </div>
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                All Members
                            </h2>

                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <td>Name</td>
                                            <td>Mobile</td>
                                            <th>Level</th>
                                            <th>Star</th>

                                            <th>Country</th>
                                            <th>Zone</th>
                                            <th>State</th>
                                            <th>Division</th>
                                            <th>Districts</th>
                                            <th>Taluka</th>
                                            <th>Pincode</th>
                                            <th>Village</th>
                                            <th>View</th>
                                            <th>Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <? $sql = mysqli_query($con,"select * from new_waiting order by id DESC");

$i=1;
while($sql_result = mysqli_fetch_assoc($sql)){ ?>
                                        
                    <tr>
                        <td><? echo $i;?></td>
                        <td><? echo $sql_result['name'];?></td>
                        <td><? echo $sql_result['mobile'];?></td>
                        <td><? echo $sql_result['level_id'];?></td>
                        <td><? echo $sql_result['star'];?></td>
                        <td><? echo get_country($sql_result['country']);?></td>
                        <td><? echo get_zone($sql_result['zone']);?></td>
                        <td><? echo get_state($sql_result['state']);?></td>
                        <td><? echo get_division($sql_result['division']);?></td>
                        <td><? echo get_district($sql_result['district']);?></td>
                        <td><? echo get_taluka($sql_result['taluka']);?></td>
                        <td><? echo get_pincode($sql_result['pincode']);?></td>
                        <td><? echo get_village($sql_result['village'])?></td>
                        <td>
                            <a class="btn btn-danger" href="member_view.php?id=<? echo $sql_result['id'];?>">View</a>
                        </td>
                        <td>
                            <a class="btn btn-success" href="member_approve.php?id=<? echo $sql_result['id'];?>">Approve</a> |
                            <a class="btn btn-danger" href="member_reject.php?id=<? echo $sql_result['id'];?>">Reject</a>
                        </td>
                            
                    </tr>
                                        
                                        <? $i++; } ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="../plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <script src="../js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js -->
    <script src="../js/demo.js"></script>
</body>

</html>
