<? session_start();
include('config.php');
include('../config.php');
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


$order_id = $_GET['order_id'];
$id = $_GET['id'];

function GetTotalEntry($order_id)
{
    global $con1;
  $sql= mysqli_query($con1,"SELECT id FROM `commission_details` WHERE order_id='".$order_id."' Group BY commission_to");
  $count=mysqli_num_rows($sql);
  return $count;
}

function GetTotalLevel($order_id)
{
    global $con1;
  $sql= mysqli_query($con1,"SELECT id FROM `commission_details` WHERE order_id='".$order_id."' AND is_introducer='NULL' Group BY level");
  $count=mysqli_num_rows($sql);
  return $count;
}

function CheckEntry($order_id,$level)
{
    global $con1;
  $sql= mysqli_query($con1,"SELECT id FROM `commission_details` WHERE order_id='".$order_id."' AND level='".$level."'");
  $count=mysqli_num_rows($sql);
  return $count;
}
function checkintro($order_id)
{
    global $con1;
  $sql= mysqli_query($con1,"SELECT id FROM `commission_details` WHERE order_id='".$order_id."' AND is_introducer='1' AND level='0'");
  $count=mysqli_num_rows($sql);
  return $count;
}

function getComAmount($order_id,$amount,$level)
{
    global $con1;
    
    // $Gettoalenty=GetTotalEntry($order_id);
    $Gettoallevel=GetTotalLevel($order_id);
    $is_intro=checkintro($order_id);
    // echo $is_intro;die();
    if($is_intro){ $amount=number_format($amount/2,2, '.', '');}
    if($is_intro && $level>0 ){

    $resultval=0;
    $amt=$amount;
    for ($i=8; $i > 0 ; $i--) {
          $checkenty=CheckEntry($order_id,$i);
          if($checkenty)
          {
            $resultval=number_format($amt/2,2, '.', '');
            $amt=$resultval;



          }
          else
          {
            $resultval=$amt;

          }


          if ($i==$level) {
           return $resultval;
         }
        
    }
}
else
{
  return $amount;  
}
}

function member($parameter,$id){
    global $con;
    
    $mem_sql = mysqli_query($con,"select $parameter from new_member where id='".$id."'");
    $mem_sql_result = mysqli_fetch_assoc($mem_sql);
    
    return $mem_sql_result[$parameter];

}


$sql = mysqli_query($con,"select * from new_member where id='".$id."'");
$sql_result = mysqli_fetch_assoc($sql);

$name = $sql_result['name'];
$level = $sql_result['level_id'];
$lv_id = $sql_result['level_id'];
$mobile = $sql_result['mobile'];
$issue_date = $sql_result['full_pay_date'];

$originalDate = $issue_date;
$newDate = date("d-m-Y", strtotime($originalDate));


$_SESSION['visiting_mobile']=$mobile;

function get_image($id){
    
    global $con;
    

    $sql = mysqli_query($con, "select * from new_member_images where member_id = '".$id."' and type='passport'");
    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['image'];
}

function get_zone($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_zone where id='".$id."'");
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['zone'];
}

function get_state($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_state where id='".$id."'");
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['state'];
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


if($level==1){
    $level = 'Country';
    $level_id = 'India';
}
else if($level==2){
        $level = 'Zone';
        $level_id = $sql_result['zone'];
        $level_id = get_zone($level_id);
        
}
else if($level==3){
        $level = 'State';
        $level_id = $sql_result['state'];
        $level_id = get_state($level_id);
}
else if($level==4){
        $level = 'Division';
        $level_id = $sql_result['division'];
        $level_id = get_division($level_id);
}
else if($level==5){
        $level = 'District';
        $level_id = $sql_result['district'];
        $level_id = get_district($level_id);
}
else if($level==6){
        $level = 'Taluka';
        $level_id = $sql_result['taluka'];
        $level_id = get_taluka($level_id);
}
else if($level==7){
        $level = 'Pincode';
        $level_id = $sql_result['pincode'];
        $level_id = get_pincode($level_id);
}
else if($level==8){
        $level = 'Village';
        $level_id = $sql_result['village'];
        $level_id = get_village($level_id);
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
    <?php 
$view="SELECT * FROM `commission_details` WHERE order_id='".$order_id."' AND commission_to='".$id."'";
$view=mysqli_query($con1,$view);
?>
<div class="row">
    <div class="col-md-12">

         <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
            <thead>
                <tr>
                <th>S.no</th>
                <th>Bill NO</th>
                 <th>Product Name</th>  
                <th>Bill Amt</th>
                <th>7 Level management comm (%)</th>  
                <th>7 Level Management Comm (Amt)</th> 
                <th>Introducer Comm for Dir Customer (%)</th>
                <th>Introducer Comm for Dir Customer (Amt)</th>
                <th>Comm Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $view_result=mysqli_fetch_assoc($view);
        $orddata=json_decode($view_result['promotion']);
       // $orderdetails=explode(',', $orddata);
       // var_dump($orddata);
         $franchisedata=mysqli_fetch_assoc(mysqli_query($con1,"SELECT is_franchise FROM `Order_ent` WHERE `id`='".$order_id."'"));

        for ($s=0; $s <count($orddata) ; $s++) { 

            $order_id=$view_result['order_id'];
            $ordlvl=$view_result['level'];

            $ProName=urldecode($orddata[$s]->ProName);
            $billamt=$orddata[$s]->Amount*$orddata[$s]->Qty;
            $Commission=$orddata[$s]->Commission;
            $CommissionAmount=$orddata[$s]->CommissionAmount;

             $RefCommission=$orddata[$s]->RefCommission;
            $RefAmount=$orddata[$s]->RefAmount;

           if($franchisedata['is_franchise']==1){
            $introcom=0.00;
            $introcomamt=0.00;
        } else {
            $introcom=number_format($RefCommission,2);
            $introcomamt=number_format($RefAmount,2);
        }
        $commiAMT= getComAmount($order_id,$CommissionAmount,$ordlvl);
            // $introcom=number_format($Commission/2,2);
            // $introcomamt=number_format($CommissionAmount/2,2);
            // $commiAMT= getComAmount($order_id,$CommissionAmount,$ordlvl);
            $totalComm=$totalComm+$commiAMT;
            $totalBill=$totalBill+$billamt;
            $totalref=$totalref+$introcomamt;
            
           
         ?>
         <tr>
             <td align="right"><?=$s+1?></td>
             <td align="right"><?=$order_id?></td>
             <td ><?=$ProName?></td>
             <td align="right"><?=number_format($billamt,2)?></td>
             <td align="right"> <?=number_format($commiAMT/$billamt*100,2)?> %</td>
             <td align="right"><?=number_format($CommissionAmount,2)?></td>
             <!-- <td align="right"><?=$commiAMT?></td> -->
             <td align="right"><?=$introcom?></td>
             <td align="right"><?=$introcomamt?></td>
            <td></td>
         </tr>
    
   
     <?php
    
    }

     ?>
     <tfoot>
         <tr>
             <td align="right"></td>
             <td align="right"></td>
             <td ></td>
             <td align="right"><?=number_format($totalBill,2)?></td>
             <td align="right"></td>
            
             <td align="right"><?=number_format($totalComm,2)?></td>
             <td align="right"></td>
             <td align="right"><?=number_format($totalref,2)?></td>
            <td><a class="btn btn-info" href="https://allmart.world/franchise/GetCommisionDetails.php?order_id=<?=$order_id?>">Details</a></td>
         </tr>
     </tfoot>
        
                
            </tbody>
        </table>
    </div>
</div>
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