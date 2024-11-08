<? session_start();
include('config.php');
include('../config.php');


// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

function member($parameter,$id){
    global $con;
    
    $mem_sql = mysqli_query($con,"select $parameter from new_member where id='".$id."'");
    $mem_sql_result = mysqli_fetch_assoc($mem_sql);
    
    return $mem_sql_result[$parameter];

}


?>


<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>All Mart | Members </title>
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

    <!-- JQuery DataTable Css -->
    <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />
    
        <link href="css/themes/all-themes.css" rel="stylesheet" />
    <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  
  
    <style>
        section.content{
        margin: 13% 15px 0 15px;
        }
               .navbar-nav {
     margin: 2% auto !important;
}

        td{
                white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
        }
    </style>
    
        <style>
               section.content{
    margin: 13% 15px 0 15px;
        }
        
        td{
    overflow: hidden;
    text-overflow: ellipsis;
        }
        .navbar-nav {
     margin: 2% auto !important;
}
#member_pic img{
    height: 150px;
    /*width: 150px;*/
        border: 1px solid black;
}
.table tbody tr td{
    vertical-align: baseline;
    
}

@media (min-width: 991px) { 
    
.custom_row{
    display:flex;
}

}

@media (max-width: 991px) { 
    
.margin_row{
    margin: 30% auto;
}

}
#modal_body table{
    font-size:13px;
}


@media (min-width: 768px){

.modal-dialog {
    width: 900px;
    margin: 30px auto;
}    
}

 .navbar {
    background-color: #F44336;
}

 .nav > li > a {
    color: #fff;
}
    </style>
    
    
</head>
<body>
    
    
    
<?
$sql = mysqli_query($con3,"select distinct(txn_id) from commission_details order by id desc");   
        
    while($sql_result = mysqli_fetch_assoc($sql)){
        

    $txn_id = $sql_result['txn_id']; 
    ?>


    <!-- see product Modal -->
<div id="<? echo $txn_id; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-body">

        <h2>Transaction ID <span style="font-size:18px; color:red;">  <? echo $txn_id; ?> </span></h2>
        
        <table class="table table-condensed">
    <thead>
      <tr>
        <th>Name</th>
        <th>Amount</th>
        <th>Position</th>
      </tr>
    </thead>
    <tbody>

        
        <? 
        $mem_sql = mysqli_query($con3,"select * from commission_details where txn_id ='".$txn_id."' and status = 1 order by id asc");
        while($mem_sql_result = mysqli_fetch_assoc($mem_sql)){
            
            $member = $mem_sql_result['commission_to'];
            $amount = $mem_sql_result['amount']; 
            
            $total_sql = mysqli_query($con3,"select sum(amount) as total from commission where txn_id='".$txn_id."'");
            $total_sql_result = mysqli_fetch_assoc($total_sql);
            
            $total = $total_sql_result['total'];
            ?>
            
    <tr>
        <? if($member == 'SAR'){  ?>
        <td><? echo $member; ?></td>            
        <? } else{ ?> 
        <td><? echo member('name',$member); ?></td>    
        <? } ?>

        
        <td><? echo round($amount,2); ?></td>
        
        <? if($member == 'SAR'){  ?>
        <td>Software Team</td>            
        <? } else{ ?> 
        
        
        <td><? echo member('star',$member);?></td>
        <? } ?>
    </tr>
  
        <? } ?>
        
    </tbody>
  </table>
  
  <h4>Total Amount Rs. <? echo round($total,2); ?>/- </h4>
        
        
        
      </div>
     
    </div>

  </div>
</div>
<!--End See product modal-->


<? } ?>


    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header" style="min-width: 200px;">

                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                
                <a class="navbar-brand" href="http://www.allmart.world/franchise/" style="display:flex;height: 100px;margin: auto; line-height: 3;     padding: 0;
    width: 100%;">
                                    <img src="https://allmart.world/assets/allmart.2png" style="width:100px;" >
                    <span style="margin: auto 5%; color:white;">AllMart</span>
                
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <? include('menu.php');?>
                
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    
    

    <section class="content">
        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Transaction ID</th>
                                            <th>Total</th>
                                            <td>View</td>
                                        </tr>
                                    </thead>
                                    <tbody>
  <?php 
  $i=1;
     $sql = mysqli_query($con3,"select distinct(txn_id) from commission");     
  while($sql_result = mysqli_fetch_assoc($sql)){   
      
    $txn_id = $sql_result['txn_id'];
    
    $com_sql= mysqli_query($con3,"select sum(amount) as total from commission where txn_id = '".$txn_id."' and status=1");
    $com_sql_result = mysqli_fetch_assoc($com_sql);
    $total = $com_sql_result['total']; ?> 
  
  <tr>
      <td><? echo $i; ?></td>
      <td><? echo $txn_id; ?></td>
      <td><? echo round($total,2); ?></td>
      <td><a href="#" class="btn btn-info" data-toggle="modal" data-target="#<? echo $txn_id; ?>">View Details</a></td>
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
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <!--<script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>-->

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>