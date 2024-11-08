<? session_start();
include('../config.php');

function get_refName($ref)
{
Global $con;
if($ref!='')
{
  $getreff = mysqli_query($con,"SELECT * FROM `greetings_referral_code` WHERE code='".$ref."'");
  $sql_result = mysqli_fetch_assoc($getreff);
  return  $sql_result;
}

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
                
                <a class="navbar-brand" href="http://www.modimart.world/franchise4/" style="display:flex;height: 100px;margin: auto; line-height: 3;     padding: 0;
    width: 100%;">
                                    <img src="https://modimart.world/assets/logo.png" style="width:100px;" >
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
                                Download History
                            </h2>

                        </div>
                        <div class="body">
                            <form action="#" method="post">
                            <div class="row">
                                <div class="col-md-4">
                                   <lable>From</lable>
                                 <input type="date" class="form-control" value="<?php if(isset($_POST['date1'])){ echo $_POST['date1'];} ?>" name="date1">
                                </div>
                                <div class="col-md-4">
                                <lable>To</lable>
                                <input type="date" class="form-control" value="<?php if(isset($_POST['date2'])){ echo $_POST['date2'];} ?>" name="date2">
                                </div>
                                <div class="col-md-4">
                                    <br/>
                                 <input type="submit" class="btn btn-success">
                                 <a href="DownloadHistory.php" class="btn btn-info">Reset</a>
                                </div>
                            </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>User Name</th>
                                            <th>Download Count</th>
                                            <th>User Type</th>
                                            <th>Introducer</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php
                                        if(isset($_POST['date1']))
                                        {

                                            $dateone=date('Y-m-d',strtotime($_POST['date1']));
                                            $datetwo=date('Y-m-d',strtotime($_POST['date2']));


                                            
                                            $sql = mysqli_query($con,"SELECT greeting_download_count.date,greeting_download_count.user_id,customer_promotion.is_franchisee,customer_promotion.refcode,customer_promotion.customer_name,SUM(download_count) as totaldown FROM `greeting_download_count` LEFT JOIN `customer_promotion` ON greeting_download_count.user_id = customer_promotion.customer_id WHERE greeting_download_count.date BETWEEN '".$dateone."' AND '".$datetwo."' GROUP BY greeting_download_count.user_id ORDER By greeting_download_count.date");


                                        }
                                        else
                                        {
                                            $thisdate=date('Y-m-d');
                                            $sql = mysqli_query($con,"SELECT greeting_download_count.date,greeting_download_count.user_id,customer_promotion.is_franchisee,customer_promotion.refcode,customer_promotion.customer_name,SUM(download_count) as totaldown FROM `greeting_download_count` LEFT JOIN `customer_promotion` ON greeting_download_count.user_id = customer_promotion.customer_id WHERE greeting_download_count.date = '".$thisdate."' GROUP BY greeting_download_count.user_id");

                                        }
                                         
$i=1;
// $sql_result = mysqli_fetch_assoc($sql);
// echo "<pre>";
// print_r($sql_result);
// echo "</pre>";
while($sql_result = mysqli_fetch_assoc($sql)){ ?>
                                        
                    <tr>
                        <td><?=$i?></td>
                        <td><?=date('d-m-Y',strtotime($sql_result['date']))?></td>
                        <td><?=$sql_result['customer_name']?>
                    <input type="hidden" value="<?=$sql_result['user_id']?>"></td>
                        <td><?=$sql_result['totaldown']?></td>
                        <td>
                            <?php
                            if ($sql_result['is_franchisee']==='1') {
                              ?>
                              Franchise
                              <?php
                            } else if($sql_result['is_franchisee']==="2") {
                                ?>
                                Paid Customer
                                <?php
                            } 
                            else if($sql_result['is_franchisee']==="0")
                            {
                                ?>
                                Free Customer
                                <?php
                            }
                            
                            else if($sql_result['is_franchisee']==="4")
                            {
                                ?>
                                Staff
                                <?php
                            }
                            
                            ?></td>
                        <td><?php
                        $getreff=get_refName($sql_result['refcode']);
                       echo $getreff['created_by']; ?></td>
                        
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
