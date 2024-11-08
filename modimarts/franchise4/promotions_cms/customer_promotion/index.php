

<?php
session_start();
if (!isset($_SESSION['mem_id']) && !isset($_SESSION['username'])) {
    ?>

    // <script>
    //     window.location.href='https://allmart.world/franchise/get_members.php';
    // </script>

<?
}
include '../../config.php';




$userid     = $_GET['id'];
$sql        = mysqli_query($con, "select * from customer_promotion where id='" . $id . "'");
$sql_result = mysqli_fetch_assoc($sql);

$customer_id         = $sql_result['$customer_id'];
$customer_address    = $sql_result['$customer_address'];
$customer_name       = $sql_result['$customer_name'];
$logo                = $sql_result['logo'];
$image               = $sql_result['image'];
$status              = $sql_result['status'];
$created_at          = $sql_result['created_at'];
$isfranchisee        = $sql_result['is_franchisee'];

?>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>View Profile | All Mart</title>
    <!-- Favicon-->
    <link rel="icon" href="https://www.allmart.world/franchise/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="https://www.allmart.world/franchise/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="https://www.allmart.world/franchise/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="https://www.allmart.world/franchise/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="https://www.allmart.world/franchise/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="https://www.allmart.world/franchise/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="https://www.allmart.world/franchise/plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <!--<link href="https://www.allmart.world/franchise/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />-->

    <!-- Custom Css -->
    <link href="https://www.allmart.world/franchise/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="https://www.allmart.world/franchise/css/themes/all-themes.css" rel="stylesheet" />

    <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>


    <link href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://www.allmart.world/franchise/plugins/dropzone/dropzone.css" rel="stylesheet">
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

                <a class="navbar-brand" href="https://www.allmart.world/franchise/index.php" style="display:flex;height: 100px;margin: auto; line-height: 3;     padding: 0;
    width: 100%;">
                                      <img src="https://allmart.world/assets/logo.png" alt="" style="width: 100px;background:white;border-radius: 50%;height: auto;">
                    <span style="margin: auto 5%;">AllMart</span>

                </a>
              
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
          
              <? //include 'https://www.allmart.world/franchise/menu.php';?>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->


    <section class="content">
        
        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                <a href="/franchise/admin/DownloadHistory.php" class="btn btn-info">Download History</a>
                    <a href="add_promotion.php" class="btn btn-primary" style="float:right;" >Add Customers</a>
                    </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      
                    <div class="card-body">
                       
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" name="table">
                                    <thead border="2">
                                        <tr>
                                            <th>S.no.</th>
                                            <th>Customer Name</th>
                                            <th>Customer Mobile</th>
                                            <th>Content</th>
                                            <th>Logo</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Date & Time of Joining</th>
                                            <th>No.of Days</th>
                                            <th>Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                       
			<? $sql = mysqli_query($con,"SELECT *,datediff(curdate(),created_at) AS datadiff FROM `customer_promotion`");  
// 			$datediff = mysqli_query($con,"SELECT  from `customer_promotion`");
// var_dump($con);

// $datediff = mysqli_fetch_assoc($datediff);
// print_r($datediff);
			$i=1;
			
            
			while($sql_result = mysqli_fetch_assoc($sql)){ ?>

                    <tr>
                        <td><? echo $i;?></td>
                        <td><?=$sql_result['customer_name']?></td>
                        <td><?=$sql_result['mobile_number']?></td>
                        <td><?=$sql_result['content']?></td>
                        <td><img src="https://allmart.world/franchise/promotions_cms/customer_promotion/<?=$sql_result['logo']?>" style="width:100px;height:100px;"></td>
                        <td><img src="https://allmart.world/franchise/promotions_cms/customer_promotion/<?=$sql_result['image']?>" style="width:100px;height:100px;"></td>
                        <td><?php 
                                if($sql_result['status']=='1')
                                {
                                    echo "Active";
                                }
                                else
                                {
                                    echo "InActive";
                                }
                                ?></td>
                        <td><?=$sql_result['created_at']?></td>
                        <td><?=$sql_result['datadiff'] ?></td>
                        <td>  <?php 
                                            if($sql_result['is_franchisee']=='1')
                                            {
                                                echo "Franchise";
                                            }
                                            else if($sql_result['is_franchisee']=='0')
                                            {
                                                echo "Free Customer"; 
                                            }
                                            else if($sql_result['is_franchisee']=='2') {
                                                
                                                echo "Paid Customer";
                                            }
                                            else if($sql_result['is_franchisee']=='4') {
                                                
                                                echo "Staff";
                                            }
                                        ?> </td>
                        <td>
                            <a href="update_promotion.php?id=<?=$sql_result['customer_id']?>" class="btn btn-info" id="Button">Edit</a>
                                        <?php if(0){ ?> <a href="delete.php?id=<?=$sql_result['customer_id']?>" onclick="return checkdelete()" class="btn btn-danger">Delete</a> <?php }?>

                            </td>
                    </tr>
                      <!--endforeach; ?>-->
    <? $i++; } ?>
     
                                        
                                    </tbody>
                                </table>
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
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>
    <br>
    <br>
    <br>




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
function checkdelete() {
  return confirm("Are You Sure Delete This Records");
}
</script>

    <!-- Jquery Core Js -->
    <script src="https://www.allmart.world/franchise/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="https://www.allmart.world/franchise/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <!--<script src="https://www.allmart.world/franchise/plugins/bootstrap-select/js/bootstrap-select.js"></script>-->

    <!-- Slimscroll Plugin Js -->
    <script src="https://www.allmart.world/franchise/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="https://www.allmart.world/franchise/plugins/node-waves/waves.js"></script>

    <!-- Autosize Plugin Js -->
    <script src="https://www.allmart.world/franchise/plugins/autosize/autosize.js"></script>

    <!-- Moment Plugin Js -->
    <script src="https://www.allmart.world/franchise/plugins/momentjs/moment.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="https://www.allmart.world/franchise/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="https://www.allmart.world/franchise/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

    <!-- Custom Js -->
    <script src="https://www.allmart.world/franchise/js/admin.js"></script>
    <script src="https://www.allmart.world/franchise/js/pages/forms/basic-form-elements.js"></script>
<script src="https://www.allmart.world/franchise/plugins/dropzone/dropzone.js"></script>
    <!-- Demo Js -->
    <script src="https://www.allmart.world/franchise/js/demo.js"></script>
    
 
 <script src="//cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
 <script>
     $(document).ready( function () {
    $('table').DataTable();
} );
 </script>
    
</body>
</html>

