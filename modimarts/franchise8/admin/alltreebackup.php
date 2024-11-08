<?session_start();
include '../config.php';


$countcountry= mysqli_query($con, "select * from new_country ");
$new_country = mysqli_fetch_assoc($countcountry);
$countrycount = mysqli_num_rows($countcountry);
echo "country=".$countrycount;

$statesql= mysqli_query($con, "select * from new_state");
$new_state = mysqli_fetch_assoc($statesql);
$new_statecount = mysqli_num_rows($statesql);
echo "State ".$new_statecount;

$sqlzone= mysqli_query($con, "select * from new_zone");
$new_zone = mysqli_fetch_assoc($sqlzone);
$new_zonecount = mysqli_num_rows($sqlzone);
echo "Zone ".$new_zonecount;

$sqlcity= mysqli_query($con, "select * from new_division");
$new_city = mysqli_fetch_assoc($sqlcity);
$new_citycount = mysqli_num_rows($sqlcity);
echo "City ".$new_citycount;

$sqldistrict= mysqli_query($con, "select * from new_district");
$new_district = mysqli_fetch_assoc($sqldistrict);
$new_districtcount = mysqli_num_rows($sqldistrict);
echo "District ".$new_districtcount;

$sqltaluka= mysqli_query($con, "select * from new_taluka");
$new_taluka = mysqli_fetch_assoc($sqltaluka);
$new_talukacount = mysqli_num_rows($sqltaluka);
echo "Taluka ".$new_talukacount;

$sqlpincode= mysqli_query($con, "select * from new_pincode");
$new_pincode = mysqli_fetch_assoc($sqlpincode);
$new_pincodecount = mysqli_num_rows($sqlpincode);
echo "PINcode ".$new_pincodecount;

function get_position($star,$id)
{

    if ($star=="Country") {
       return get_country($id);
    }
    else if($star=="Zone")
    {
          return get_zone($id);
    }
    else if($star=="State")
    {
          return get_state($id);
    }
    else if($star=="Division")
    {
          return get_division($id);
    }
    else if($star=="District")
    {
          return get_district($id);
    }
    else if($star=="Taluka")
    {
          return get_taluka($id);
    }
    else if($star=="Pincode")
    {
          return get_pincode($id);
    }
    else
    {
        return "-";
    }

}

function get_country($id)
{

    global $con;

    $sql = mysqli_query($con, "select country from new_country where id='" . $id . "'");

    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['country'];
}

function get_state($id)
{

    global $con;

    $sql = mysqli_query($con, "select state from new_state where id='" . $id . "'");

    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['state'];
}

function get_zone($id)
{

    global $con;

    $sql = mysqli_query($con, "select zone from new_zone where id='" . $id . "'");

    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['zone'];
}

function get_division($id)
{

    global $con;

    $sql = mysqli_query($con, "select city from new_city where id='" . $id . "'");

    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['city'];
}

function get_district($id)
{

    global $con;

    $sql = mysqli_query($con, "select district from new_district where id='" . $id . "'");

    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['district'];
}

function get_taluka($id)
{

    global $con;

    $sql = mysqli_query($con, "select taluka from new_taluka where id='" . $id . "'");

    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['taluka'];
}

function get_pincode($id)
{
    global $con;
    $sql        = mysqli_query($con, "select pincode from new_pincode where id='" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['pincode'];
}
function get_villege($id)
{
    global $con;
    $sql        = mysqli_query($con, "select * from new_village where id='" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['village'];
}

?>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>All Mart | Members </title>
    <!-- Favicon-->
    <link rel="icon" href="https://modimarts.com/assets/logo.png" type="image/png">

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

        <!-- <link href="css/themes/all-themes.css" rel="stylesheet" /> -->
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



    </style>


</head>
<body class="theme-red">
    <!-- Page Loader -->
    <!-- <div class="page-loader-wrapper">
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
    </div> -->
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



    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header" style="min-width: 200px;">

                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>

                <a class="navbar-brand" href="http://www.modimarts.com/franchise8/" style="display:flex;height: 100px;margin: auto; line-height: 3;     padding: 0;
    width: 100%;">
                                    <img src="https://modimarts.com/assets/logo.png" style="width:100px;border-radius: 50%;" >
                    <span style="margin: auto 5%;">ModiMart</span>

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

                            <div class="table-responsive">
                        <div class="body">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <td>Name</td>
                                            <td>Mobile</td>
                                            <th>Level</th>
                                            <th>Star</th>
                                            <th>Position</th>
                                            <th>Country</th>
                                            <th>Zone</th>
                                            <th>State</th>
                                            <th>Division</th>
                                            <th>Districts</th>
                                            <th>Taluka</th>
                                            <th>Pincode</th>
                                            <th>Village</th>
                                            <th>Location</th>
                                            <th>PAN Card</th>
                                            <th>Adhar Card</th>
                                            <th>GST</th>
                                            <th>Introducer Id</th>
                                            <th>Introducer Name</th>
                                            <th>Introducer Mobile</th>
                                            <th>Paid Status</th>
                                            <th>Product Given Status</th>
                                            <th>Amount</th>
                                            <th>Created at</th>
                                           

                                        </tr>
                                    </thead>
                                    <tbody>

                                      <?php 

                                         $i = 1;
                                        $y=0;
                                        $total=0;



                                         if (0)
                                        {
                                        //  if ($y<$countrycount)
                                        // { 
                                          $forquery=$countcountry;  
                                          $level=1; 
                                        }

                                       
                                          foreach ($forquery as $key => $zone) {
                                             if ($level==1) {
                                                  $query="AND level_id='1' AND country='".$zone['id']."'";
                                              }
                                            if ($level==2) {                                               
                                             $query="AND level_id='2' AND  zone='".$zone['id']."'";
                                              }
                                            if ($level==3) {                                               
                                             $query="AND level_id='3' AND  state='".$zone['id']."'";
                                              }
                                            if ($level==4) {                                               
                                             $query="AND level_id='4' AND  division='".$zone['id']."'";
                                              }
                                            if ($level==5) {                                               
                                             $query="AND level_id='5' AND  district='".$zone['id']."'";
                                              }
                                            if ($level==6) {                                               
                                             $query="AND level_id='6' AND  taluka='".$zone['id']."'";
                                              }
                                            if ($level==7) {                                               
                                             $query="AND level_id='7' AND  pincode='".$zone['id']."'";
                                              }




                                        $sql = mysqli_query($con, "select * from new_member where status=1 $query order by id ASC");
                                               $count=mysqli_num_rows($sql);
                                                    if($count){
                                               
                                                while ($sql_result = mysqli_fetch_assoc($sql)) {

                                                    $f_id=$sql_result['id'];

                                                    if ($sql_result['mem_status'] == 'p') {
                                                        $mem_status = 'Paid';
                                                    } else {
                                                        $mem_status = 'Unpaid';
                                                    }

                                                    if ($sql_result['is_product_received'] == 1) {
                                                        $is_product_received = '<p id="CNGProst_'.$f_id.'"><span onclick="CNGProst(0,'.$f_id.')">Given</span></p>';
                                                    } else {
                                                        $is_product_received = '<p id="CNGProst_'.$f_id.'"><span onclick="CNGProst(1,'.$f_id.')">Not Given</span></p>';
                                                    }

                                                    if ($sql_result['created_at'] < '2020-10-22') {
                                                        $amount = 5000;
                                                    } else {
                                                        $amount = 1000;
                                                    }
                                                          ?>
                                                            <tr>
                                                                <td><?echo $i; ?></td>
                                                                <td><?echo $sql_result['name']; ?></td>
                                                                <td><?echo $sql_result['mobile']; ?></td>
                                                                <td><?echo $sql_result['level_id']; ?></td>
                                                                <td><?echo $sql_result['star']; ?></td>
                                                                <td><?echo $sql_result['position_name']; ?></td>
                                                                <td><? if($sql_result['country']!=0){ echo get_country($sql_result['country']);} ?></td>
                                                                <td><? if($sql_result['zone']!=0){echo get_zone($sql_result['zone']);} ?></td>
                                                                <td><? if($sql_result['state']!=0){echo get_state($sql_result['state']);} ?></td>
                                                                <td><? if($sql_result['division']!=0){echo get_division($sql_result['division']);} ?></td>
                                                                <td><? if($sql_result['district']!=0){echo get_district($sql_result['district']);} ?></td>
                                                                <td><? if($sql_result['taluka']!=0){echo get_taluka($sql_result['taluka']); }?></td>
                                                                <td><? if($sql_result['pincode']!=0){echo get_pincode($sql_result['pincode']);} ?></td>
                                                                <td><?if ($sql_result['village'] != 0) {echo get_villege($sql_result['village']);}?></td>
                                                                <td><?echo $sql_result['location']; ?></td>
                                                                <td><?echo $sql_result['pan']; ?></td>
                                                                <td><?echo $sql_result['adhar_card']; ?></td>
                                                                <td><?echo $sql_result['gst']; ?></td>
                                                                <td><?echo $sql_result['intro_id']; ?></td>
                                                                <td><?echo $sql_result['introducer_name']; ?></td>
                                                                <td><?echo $sql_result['introducer_mobile']; ?></td>
                                                                   <td><?echo $mem_status; ?></td>
                        <td><?echo $is_product_received; ?></td>
                        <td><?echo $amount; ?></td>
                                                                <td><?echo $sql_result['created_at']; ?></td>                   
                                                            </tr>
                                                        
                                        <?$i++;} }
                                       else {?>
                                                              <tr>
                                                                <td><?echo $i; ?></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td><? if($level==1){ echo $zone['name'];} ?></td>
                                                                <td><? if($level==2){echo $zone['zone'];} ?></td>
                                                                <td><? if($level==3){echo   $zone['state'];} ?></td>
                                                                <td><? if($level==4){echo $zone['division'];} ?></td>
                                                                <td><? if($level==5){echo  $zone['district'];} ?></td>
                                                                <td><? if($level==6){echo  $zone['taluka']; }?></td>
                                                                <td><? if($level==7){echo $zone['pincode'];} ?></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                        <?php $i++; } $y++;
                                                        $total=$total+1; }?><?php 

                                               

                                        // if($total==$countrycount)
                                        // {
                                            if (0)
                                        {
                                          $forquery= $sqlzone;
                                           $level=2; 


                                          foreach ($forquery as $key => $zone) {
                                             if ($level==1) {
                                                  $query="AND level_id='1' AND country='".$zone['id']."'";
                                              }
                                            if ($level==2) {                                               
                                             $query="AND level_id='2' AND  zone='".$zone['id']."'";
                                              }
                                            if ($level==3) {                                               
                                             $query="AND level_id='3' AND  state='".$zone['id']."'";
                                              }
                                            if ($level==4) {                                               
                                             $query="AND level_id='4' AND  division='".$zone['id']."'";
                                              }
                                            if ($level==5) {                                               
                                             $query="AND level_id='5' AND  district='".$zone['id']."'";
                                              }
                                            if ($level==6) {                                               
                                             $query="AND level_id='6' AND  taluka='".$zone['id']."'";
                                              }
                                            if ($level==7) {                                               
                                             $query="AND level_id='7' AND  pincode='".$zone['id']."'";
                                              }




                                        $sql = mysqli_query($con, "select * from new_member where status=1 $query order by id ASC");
                                               $count=mysqli_num_rows($sql);
                                                    if($count){
                                               
                                                while ($sql_result = mysqli_fetch_assoc($sql)) {

                                                    $f_id=$sql_result['id'];

                                                    if ($sql_result['mem_status'] == 'p') {
                                                        $mem_status = 'Paid';
                                                    } else {
                                                        $mem_status = 'Unpaid';
                                                    }

                                                    if ($sql_result['is_product_received'] == 1) {
                                                        $is_product_received = '<p id="CNGProst_'.$f_id.'"><span onclick="CNGProst(0,'.$f_id.')">Given</span></p>';
                                                    } else {
                                                        $is_product_received = '<p id="CNGProst_'.$f_id.'"><span onclick="CNGProst(1,'.$f_id.')">Not Given</span></p>';
                                                    }

                                                    if ($sql_result['created_at'] < '2020-10-22') {
                                                        $amount = 5000;
                                                    } else {
                                                        $amount = 1000;
                                                    }
                                                    
                                                          ?>
                                                            <tr>
                                                                <td><?echo $i; ?></td>
                                                                <td><?echo $sql_result['name']; ?></td>
                                                                <td><?echo $sql_result['mobile']; ?></td>
                                                                <td><?echo $sql_result['level_id']; ?></td>
                                                                <td><?echo $sql_result['star']; ?></td>
                                                                <td><?echo $sql_result['position_name']; ?></td>
                                                                <td><? if($sql_result['country']!=0){ echo get_country($sql_result['country']);} ?></td>
                                                                <td><? if($sql_result['zone']!=0){echo get_zone($sql_result['zone']);} ?></td>
                                                                <td><? if($sql_result['state']!=0){echo get_state($sql_result['state']);} ?></td>
                                                                <td><? if($sql_result['division']!=0){echo get_division($sql_result['division']);} ?></td>
                                                                <td><? if($sql_result['district']!=0){echo get_district($sql_result['district']);} ?></td>
                                                                <td><? if($sql_result['taluka']!=0){echo get_taluka($sql_result['taluka']); }?></td>
                                                                <td><? if($sql_result['pincode']!=0){echo get_pincode($sql_result['pincode']);} ?></td>
                                                                <td><?if ($sql_result['village'] != 0) {echo get_villege($sql_result['village']);}?></td>

                                                                <td><?echo $sql_result['location']; ?></td>
                                                                <td><?echo $sql_result['pan']; ?></td>
                                                                <td><?echo $sql_result['adhar_card']; ?></td>
                                                                <td><?echo $sql_result['gst']; ?></td>
                                                                <td><?echo $sql_result['intro_id']; ?></td>

                                                                <td><?echo $sql_result['introducer_name']; ?></td>
                                                                <td><?echo $sql_result['introducer_mobile']; ?></td>
                                                                   <td><?echo $mem_status; ?></td>
                        <td><?echo $is_product_received; ?></td>
                        <td><?echo $amount; ?></td>
                                                                <td><?echo $sql_result['created_at']; ?></td>
                                                               
                                                                
                                                            </tr>
                                                        
                                        <?$i++;} }
                                       else {?>
                                                              <tr>
                                                                <td><?echo $i; ?></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td><? if($level==1){ echo $zone['name'];} ?></td>
                                                                <td><? if($level==2){echo $zone['zone'];} ?></td>
                                                                <td><? if($level==3){echo   $zone['state'];} ?></td>
                                                                <td><? if($level==4){echo $zone['division'];} ?></td>
                                                                <td><? if($level==5){echo  $zone['district'];} ?></td>
                                                                <td><? if($level==6){echo  $zone['taluka']; }?></td>
                                                                <td><? if($level==7){echo $zone['pincode'];} ?></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                        <?php $i++; } $y++;
                                                        $total=$total+1; } }?><?php 

                                        



                                         

                                        //  if($total=$countrycount+$new_zonecount)
                                        // {
                                                        if (0)
                                        {
                                           $forquery= $statesql;
                                           $level=3; 
                                      

                                          foreach ($forquery as $key => $zone) {
                                             if ($level==1) {
                                                  $query="AND level_id='1' AND country='".$zone['id']."'";
                                              }
                                            if ($level==2) {                                               
                                             $query="AND level_id='2' AND  zone='".$zone['id']."'";
                                              }
                                            if ($level==3) {                                               
                                             $query="AND level_id='3' AND  state='".$zone['id']."'";
                                              }
                                            if ($level==4) {                                               
                                             $query="AND level_id='4' AND  division='".$zone['id']."'";
                                              }
                                            if ($level==5) {                                               
                                             $query="AND level_id='5' AND  district='".$zone['id']."'";
                                              }
                                            if ($level==6) {                                               
                                             $query="AND level_id='6' AND  taluka='".$zone['id']."'";
                                              }
                                            if ($level==7) {                                               
                                             $query="AND level_id='7' AND  pincode='".$zone['id']."'";
                                              }




                                        $sql = mysqli_query($con, "select * from new_member where status=1 $query order by id ASC");
                                               $count=mysqli_num_rows($sql);
                                                    if($count){
                                               
                                                while ($sql_result = mysqli_fetch_assoc($sql)) {

                                                    $f_id=$sql_result['id'];

                                                    if ($sql_result['mem_status'] == 'p') {
                                                        $mem_status = 'Paid';
                                                    } else {
                                                        $mem_status = 'Unpaid';
                                                    }

                                                    if ($sql_result['is_product_received'] == 1) {
                                                        $is_product_received = '<p id="CNGProst_'.$f_id.'"><span onclick="CNGProst(0,'.$f_id.')">Given</span></p>';
                                                    } else {
                                                        $is_product_received = '<p id="CNGProst_'.$f_id.'"><span onclick="CNGProst(1,'.$f_id.')">Not Given</span></p>';
                                                    }

                                                    if ($sql_result['created_at'] < '2020-10-22') {
                                                        $amount = 5000;
                                                    } else {
                                                        $amount = 1000;
                                                    }
                                                    
                                                          ?>
                                                            <tr>
                                                                <td><?echo $i; ?></td>
                                                                <td><?echo $sql_result['name']; ?></td>
                                                                <td><?echo $sql_result['mobile']; ?></td>
                                                                <td><?echo $sql_result['level_id']; ?></td>
                                                                <td><?echo $sql_result['star']; ?></td>
                                                                <td><?echo $sql_result['position_name']; ?></td>
                                                                <td><? if($sql_result['country']!=0){ echo get_country($sql_result['country']);} ?></td>
                                                                <td><? if($sql_result['zone']!=0){echo get_zone($sql_result['zone']);} ?></td>
                                                                <td><? if($sql_result['state']!=0){echo get_state($sql_result['state']);} ?></td>
                                                                <td><? if($sql_result['division']!=0){echo get_division($sql_result['division']);} ?></td>
                                                                <td><? if($sql_result['district']!=0){echo get_district($sql_result['district']);} ?></td>
                                                                <td><? if($sql_result['taluka']!=0){echo get_taluka($sql_result['taluka']); }?></td>
                                                                <td><? if($sql_result['pincode']!=0){echo get_pincode($sql_result['pincode']);} ?></td>
                                                                <td><?if ($sql_result['village'] != 0) {echo get_villege($sql_result['village']);}?></td>

                                                                <td><?echo $sql_result['location']; ?></td>
                                                                <td><?echo $sql_result['pan']; ?></td>
                                                                <td><?echo $sql_result['adhar_card']; ?></td>
                                                                <td><?echo $sql_result['gst']; ?></td>
                                                                <td><?echo $sql_result['intro_id']; ?></td>

                                                                <td><?echo $sql_result['introducer_name']; ?></td>
                                                                <td><?echo $sql_result['introducer_mobile']; ?></td>
                                                                   <td><?echo $mem_status; ?></td>
                        <td><?echo $is_product_received; ?></td>
                        <td><?echo $amount; ?></td>
                                                                <td><?echo $sql_result['created_at']; ?></td>
                                                               
                                                                
                                                            </tr>
                                                        
                                        <?$i++;} }
                                       else {?>
                                                              <tr>
                                                                <td><?echo $i; ?></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td><? if($level==1){ echo $zone['name'];} ?></td>
                                                                <td><? if($level==2){echo $zone['zone'];} ?></td>
                                                                <td><? if($level==3){echo   $zone['state'];} ?></td>
                                                                <td><? if($level==4){echo $zone['division'];} ?></td>
                                                                <td><? if($level==5){echo  $zone['district'];} ?></td>
                                                                <td><? if($level==6){echo  $zone['taluka']; }?></td>
                                                                <td><? if($level==7){echo $zone['pincode'];} ?></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                        <?php $i++; } $y++;
                                                        $total=$total+1; } }?><?php 




                                      

                                        //  if($total=$countrycount+$new_zonecount+$new_statecount)
                                        // {
                                                        if (0)
                                        {
                                           $forquery= $sqlcity;
                                           $level=4; 
                                       //  

                                          foreach ($forquery as $key => $zone) {
                                             if ($level==1) {
                                                  $query="AND level_id='1' AND country='".$zone['id']."'";
                                              }
                                            if ($level==2) {                                               
                                             $query="AND level_id='2' AND  zone='".$zone['id']."'";
                                              }
                                            if ($level==3) {                                               
                                             $query="AND level_id='3' AND  state='".$zone['id']."'";
                                              }
                                            if ($level==4) {                                               
                                             $query="AND level_id='4' AND  division='".$zone['id']."'";
                                              }
                                            if ($level==5) {                                               
                                             $query="AND level_id='5' AND  district='".$zone['id']."'";
                                              }
                                            if ($level==6) {                                               
                                             $query="AND level_id='6' AND  taluka='".$zone['id']."'";
                                              }
                                            if ($level==7) {                                               
                                             $query="AND level_id='7' AND  pincode='".$zone['id']."'";
                                              }




                                        $sql = mysqli_query($con, "select * from new_member where status=1 $query order by id ASC");
                                               $count=mysqli_num_rows($sql);
                                                    if($count){
                                               
                                                while ($sql_result = mysqli_fetch_assoc($sql)) {

                                                    $f_id=$sql_result['id'];

                                                    if ($sql_result['mem_status'] == 'p') {
                                                        $mem_status = 'Paid';
                                                    } else {
                                                        $mem_status = 'Unpaid';
                                                    }

                                                    if ($sql_result['is_product_received'] == 1) {
                                                        $is_product_received = '<p id="CNGProst_'.$f_id.'"><span onclick="CNGProst(0,'.$f_id.')">Given</span></p>';
                                                    } else {
                                                        $is_product_received = '<p id="CNGProst_'.$f_id.'"><span onclick="CNGProst(1,'.$f_id.')">Not Given</span></p>';
                                                    }

                                                    if ($sql_result['created_at'] < '2020-10-22') {
                                                        $amount = 5000;
                                                    } else {
                                                        $amount = 1000;
                                                    }
                                                    
                                                          ?>
                                                            <tr>
                                                                <td><?echo $i; ?></td>
                                                                <td><?echo $sql_result['name']; ?></td>
                                                                <td><?echo $sql_result['mobile']; ?></td>
                                                                <td><?echo $sql_result['level_id']; ?></td>
                                                                <td><?echo $sql_result['star']; ?></td>
                                                                <td><?echo $sql_result['position_name']; ?></td>
                                                                <td><? if($sql_result['country']!=0){ echo get_country($sql_result['country']);} ?></td>
                                                                <td><? if($sql_result['zone']!=0){echo get_zone($sql_result['zone']);} ?></td>
                                                                <td><? if($sql_result['state']!=0){echo get_state($sql_result['state']);} ?></td>
                                                                <td><? if($sql_result['division']!=0){echo get_division($sql_result['division']);} ?></td>
                                                                <td><? if($sql_result['district']!=0){echo get_district($sql_result['district']);} ?></td>
                                                                <td><? if($sql_result['taluka']!=0){echo get_taluka($sql_result['taluka']); }?></td>
                                                                <td><? if($sql_result['pincode']!=0){echo get_pincode($sql_result['pincode']);} ?></td>
                                                                <td><?if ($sql_result['village'] != 0) {echo get_villege($sql_result['village']);}?></td>

                                                                <td><?echo $sql_result['location']; ?></td>
                                                                <td><?echo $sql_result['pan']; ?></td>
                                                                <td><?echo $sql_result['adhar_card']; ?></td>
                                                                <td><?echo $sql_result['gst']; ?></td>
                                                                <td><?echo $sql_result['intro_id']; ?></td>

                                                                <td><?echo $sql_result['introducer_name']; ?></td>
                                                                <td><?echo $sql_result['introducer_mobile']; ?></td>
                                                                   <td><?echo $mem_status; ?></td>
                        <td><?echo $is_product_received; ?></td>
                        <td><?echo $amount; ?></td>
                                                                <td><?echo $sql_result['created_at']; ?></td>
                                                               
                                                                
                                                            </tr>
                                                        
                                        <?$i++;} }
                                       else {?>
                                                              <tr>
                                                                <td><?echo $i; ?></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td><? if($level==1){ echo $zone['name'];} ?></td>
                                                                <td><? if($level==2){echo $zone['zone'];} ?></td>
                                                                <td><? if($level==3){echo   $zone['state'];} ?></td>
                                                                <td><? if($level==4){echo $zone['division'];} ?></td>
                                                                <td><? if($level==5){echo  $zone['district'];} ?></td>
                                                                <td><? if($level==6){echo  $zone['taluka']; }?></td>
                                                                <td><? if($level==7){echo $zone['pincode'];} ?></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                        <?php $i++; } $y++;
                                                        $total=$total+1; }}?><?php 




                                        //  if ($total=$countrycount+$new_zonecount+$new_statecount+$new_citycount)
                                        // {
                                                        if (0)
                                        {
                                       
                                          $forquery= $sqldistrict;
                                           $level=5;
                                       

                                          foreach ($forquery as $key => $zone) {
                                             if ($level==1) {
                                                  $query="AND level_id='1' AND country='".$zone['id']."'";
                                              }
                                            if ($level==2) {                                               
                                             $query="AND level_id='2' AND  zone='".$zone['id']."'";
                                              }
                                            if ($level==3) {                                               
                                             $query="AND level_id='3' AND  state='".$zone['id']."'";
                                              }
                                            if ($level==4) {                                               
                                             $query="AND level_id='4' AND  division='".$zone['id']."'";
                                              }
                                            if ($level==5) {                                               
                                             $query="AND level_id='5' AND  district='".$zone['id']."'";
                                              }
                                            if ($level==6) {                                               
                                             $query="AND level_id='6' AND  taluka='".$zone['id']."'";
                                              }
                                            if ($level==7) {                                               
                                             $query="AND level_id='7' AND  pincode='".$zone['id']."'";
                                              }




                                        $sql = mysqli_query($con, "select * from new_member where status=1 $query order by id ASC");
                                               $count=mysqli_num_rows($sql);
                                                    if($count){
                                               
                                                while ($sql_result = mysqli_fetch_assoc($sql)) {

                                                    $f_id=$sql_result['id'];

                                                    if ($sql_result['mem_status'] == 'p') {
                                                        $mem_status = 'Paid';
                                                    } else {
                                                        $mem_status = 'Unpaid';
                                                    }

                                                    if ($sql_result['is_product_received'] == 1) {
                                                        $is_product_received = '<p id="CNGProst_'.$f_id.'"><span onclick="CNGProst(0,'.$f_id.')">Given</span></p>';
                                                    } else {
                                                        $is_product_received = '<p id="CNGProst_'.$f_id.'"><span onclick="CNGProst(1,'.$f_id.')">Not Given</span></p>';
                                                    }

                                                    if ($sql_result['created_at'] < '2020-10-22') {
                                                        $amount = 5000;
                                                    } else {
                                                        $amount = 1000;
                                                    }
                                                    
                                                          ?>
                                                            <tr>
                                                                <td><?echo $i; ?></td>
                                                                <td><?echo $sql_result['name']; ?></td>
                                                                <td><?echo $sql_result['mobile']; ?></td>
                                                                <td><?echo $sql_result['level_id']; ?></td>
                                                                <td><?echo $sql_result['star']; ?></td>
                                                                <td><?echo $sql_result['position_name']; ?></td>
                                                                <td><? if($sql_result['country']!=0){ echo get_country($sql_result['country']);} ?></td>
                                                                <td><? if($sql_result['zone']!=0){echo get_zone($sql_result['zone']);} ?></td>
                                                                <td><? if($sql_result['state']!=0){echo get_state($sql_result['state']);} ?></td>
                                                                <td><? if($sql_result['division']!=0){echo get_division($sql_result['division']);} ?></td>
                                                                <td><? if($sql_result['district']!=0){echo get_district($sql_result['district']);} ?></td>
                                                                <td><? if($sql_result['taluka']!=0){echo get_taluka($sql_result['taluka']); }?></td>
                                                                <td><? if($sql_result['pincode']!=0){echo get_pincode($sql_result['pincode']);} ?></td>
                                                                <td><?if ($sql_result['village'] != 0) {echo get_villege($sql_result['village']);}?></td>

                                                                <td><?echo $sql_result['location']; ?></td>
                                                                <td><?echo $sql_result['pan']; ?></td>
                                                                <td><?echo $sql_result['adhar_card']; ?></td>
                                                                <td><?echo $sql_result['gst']; ?></td>
                                                                <td><?echo $sql_result['intro_id']; ?></td>

                                                                <td><?echo $sql_result['introducer_name']; ?></td>
                                                                <td><?echo $sql_result['introducer_mobile']; ?></td>
                                                                   <td><?echo $mem_status; ?></td>
                        <td><?echo $is_product_received; ?></td>
                        <td><?echo $amount; ?></td>
                                                                <td><?echo $sql_result['created_at']; ?></td>
                                                               
                                                                
                                                            </tr>
                                                        
                                        <?$i++;} }
                                       else {?>
                                                              <tr>
                                                                <td><?echo $i; ?></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td><? if($level==1){ echo $zone['name'];} ?></td>
                                                                <td><? if($level==2){echo $zone['zone'];} ?></td>
                                                                <td><? if($level==3){echo   $zone['state'];} ?></td>
                                                                <td><? if($level==4){echo $zone['division'];} ?></td>
                                                                <td><? if($level==5){echo  $zone['district'];} ?></td>
                                                                <td><? if($level==6){echo  $zone['taluka']; }?></td>
                                                                <td><? if($level==7){echo $zone['pincode'];} ?></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                        <?php $i++; } $y++;
                                                        $total=$total+1; } }?><?php 

                                       



                                        //  if ($total=$countrycount+$new_zonecount+$new_statecount+$new_citycount+$new_districtcount)
                                        // { 
                                                        if (0)
                                        {
                                        
                                          $forquery= $sqltaluka;
                                           $level=6;
                                      

                                          foreach ($forquery as $key => $zone) {
                                             if ($level==1) {
                                                  $query="AND level_id='1' AND country='".$zone['id']."'";
                                              }
                                            if ($level==2) {                                               
                                             $query="AND level_id='2' AND  zone='".$zone['id']."'";
                                              }
                                            if ($level==3) {                                               
                                             $query="AND level_id='3' AND  state='".$zone['id']."'";
                                              }
                                            if ($level==4) {                                               
                                             $query="AND level_id='4' AND  division='".$zone['id']."'";
                                              }
                                            if ($level==5) {                                               
                                             $query="AND level_id='5' AND  district='".$zone['id']."'";
                                              }
                                            if ($level==6) {                                               
                                             $query="AND level_id='6' AND  taluka='".$zone['id']."'";
                                              }
                                            if ($level==7) {                                               
                                             $query="AND level_id='7' AND  pincode='".$zone['id']."'";
                                              }




                                        $sql = mysqli_query($con, "select * from new_member where status=1 $query order by id ASC");
                                               $count=mysqli_num_rows($sql);
                                                    if($count){
                                               
                                                while ($sql_result = mysqli_fetch_assoc($sql)) {

                                                    $f_id=$sql_result['id'];

                                                    if ($sql_result['mem_status'] == 'p') {
                                                        $mem_status = 'Paid';
                                                    } else {
                                                        $mem_status = 'Unpaid';
                                                    }

                                                    if ($sql_result['is_product_received'] == 1) {
                                                        $is_product_received = '<p id="CNGProst_'.$f_id.'"><span onclick="CNGProst(0,'.$f_id.')">Given</span></p>';
                                                    } else {
                                                        $is_product_received = '<p id="CNGProst_'.$f_id.'"><span onclick="CNGProst(1,'.$f_id.')">Not Given</span></p>';
                                                    }

                                                    if ($sql_result['created_at'] < '2020-10-22') {
                                                        $amount = 5000;
                                                    } else {
                                                        $amount = 1000;
                                                    }
                                                    
                                                          ?>
                                                            <tr>
                                                                <td><?echo $i; ?></td>
                                                                <td><?echo $sql_result['name']; ?></td>
                                                                <td><?echo $sql_result['mobile']; ?></td>
                                                                <td><?echo $sql_result['level_id']; ?></td>
                                                                <td><?echo $sql_result['star']; ?></td>
                                                                <td><?echo $sql_result['position_name']; ?></td>
                                                                <td><? if($sql_result['country']!=0){ echo get_country($sql_result['country']);} ?></td>
                                                                <td><? if($sql_result['zone']!=0){echo get_zone($sql_result['zone']);} ?></td>
                                                                <td><? if($sql_result['state']!=0){echo get_state($sql_result['state']);} ?></td>
                                                                <td><? if($sql_result['division']!=0){echo get_division($sql_result['division']);} ?></td>
                                                                <td><? if($sql_result['district']!=0){echo get_district($sql_result['district']);} ?></td>
                                                                <td><? if($sql_result['taluka']!=0){echo get_taluka($sql_result['taluka']); }?></td>
                                                                <td><? if($sql_result['pincode']!=0){echo get_pincode($sql_result['pincode']);} ?></td>
                                                                <td><?if ($sql_result['village'] != 0) {echo get_villege($sql_result['village']);}?></td>

                                                                <td><?echo $sql_result['location']; ?></td>
                                                                <td><?echo $sql_result['pan']; ?></td>
                                                                <td><?echo $sql_result['adhar_card']; ?></td>
                                                                <td><?echo $sql_result['gst']; ?></td>
                                                                <td><?echo $sql_result['intro_id']; ?></td>

                                                                <td><?echo $sql_result['introducer_name']; ?></td>
                                                                <td><?echo $sql_result['introducer_mobile']; ?></td>
                                                                   <td><?echo $mem_status; ?></td>
                        <td><?echo $is_product_received; ?></td>
                        <td><?echo $amount; ?></td>
                                                                <td><?echo $sql_result['created_at']; ?></td>
                                                               
                                                                
                                                            </tr>
                                                        
                                        <?$i++;} }
                                       else {?>
                                                              <tr>
                                                                <td><?echo $i; ?></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td><? if($level==1){ echo $zone['name'];} ?></td>
                                                                <td><? if($level==2){echo $zone['zone'];} ?></td>
                                                                <td><? if($level==3){echo   $zone['state'];} ?></td>
                                                                <td><? if($level==4){echo $zone['division'];} ?></td>
                                                                <td><? if($level==5){echo  $zone['district'];} ?></td>
                                                                <td><? if($level==6){echo  $zone['taluka']; }?></td>
                                                                <td><? if($level==7){echo $zone['pincode'];} ?></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                        <?php $i++; } $y++;
                                                        $total=$total+1; } }?><?php 

                                        //  if ($y<=$countrycount)
                                        // {
                                        //  if ($total=$countrycount+$new_zonecount+$new_statecount+$new_citycount+$new_districtcount+$new_talukacount)
                                        // { 

                                                        if (0)
                                        {
                                      
                                          $forquery= $sqlpincode;
                                           $level=7;
                                      

                                          foreach ($forquery as $key => $zone) {
                                             if ($level==1) {
                                                  $query="AND level_id='1' AND country='".$zone['id']."'";
                                              }
                                            if ($level==2) {                                               
                                             $query="AND level_id='2' AND  zone='".$zone['id']."'";
                                              }
                                            if ($level==3) {                                               
                                             $query="AND level_id='3' AND  state='".$zone['id']."'";
                                              }
                                            if ($level==4) {                                               
                                             $query="AND level_id='4' AND  division='".$zone['id']."'";
                                              }
                                            if ($level==5) {                                               
                                             $query="AND level_id='5' AND  district='".$zone['id']."'";
                                              }
                                            if ($level==6) {                                               
                                             $query="AND level_id='6' AND  taluka='".$zone['id']."'";
                                              }
                                            if ($level==7) {                                               
                                             $query="AND level_id='7' AND  pincode='".$zone['id']."'";
                                              }




                                        $sql = mysqli_query($con, "select * from new_member where status=1 $query order by id ASC");
                                               $count=mysqli_num_rows($sql);
                                                    if($count){
                                               
                                                while ($sql_result = mysqli_fetch_assoc($sql)) {


                                                    $f_id=$sql_result['id'];

                                                    if ($sql_result['mem_status'] == 'p') {
                                                        $mem_status = 'Paid';
                                                    } else {
                                                        $mem_status = 'Unpaid';
                                                    }

                                                    if ($sql_result['is_product_received'] == 1) {
                                                        $is_product_received = '<p id="CNGProst_'.$f_id.'"><span onclick="CNGProst(0,'.$f_id.')">Given</span></p>';
                                                    } else {
                                                        $is_product_received = '<p id="CNGProst_'.$f_id.'"><span onclick="CNGProst(1,'.$f_id.')">Not Given</span></p>';
                                                    }

                                                    if ($sql_result['created_at'] < '2020-10-22') {
                                                        $amount = 5000;
                                                    } else {
                                                        $amount = 1000;
                                                    }
                                                    
                                                          ?>
                                                            <tr>
                                                                <td><?echo $i; ?></td>
                                                                <td><?echo $sql_result['name']; ?></td>
                                                                <td><?echo $sql_result['mobile']; ?></td>
                                                                <td><?echo $sql_result['level_id']; ?></td>
                                                                <td><?echo $sql_result['star']; ?></td>
                                                                <td><?echo $sql_result['position_name']; ?></td>
                                                                <td><? if($sql_result['country']!=0){ echo get_country($sql_result['country']);} ?></td>
                                                                <td><? if($sql_result['zone']!=0){echo get_zone($sql_result['zone']);} ?></td>
                                                                <td><? if($sql_result['state']!=0){echo get_state($sql_result['state']);} ?></td>
                                                                <td><? if($sql_result['division']!=0){echo get_division($sql_result['division']);} ?></td>
                                                                <td><? if($sql_result['district']!=0){echo get_district($sql_result['district']);} ?></td>
                                                                <td><? if($sql_result['taluka']!=0){echo get_taluka($sql_result['taluka']); }?></td>
                                                                <td><? if($sql_result['pincode']!=0){echo get_pincode($sql_result['pincode']);} ?></td>
                                                                <td><?if ($sql_result['village'] != 0) {echo get_villege($sql_result['village']);}?></td>

                                                                <td><?echo $sql_result['location']; ?></td>
                                                                <td><?echo $sql_result['pan']; ?></td>
                                                                <td><?echo $sql_result['adhar_card']; ?></td>
                                                                <td><?echo $sql_result['gst']; ?></td>
                                                                <td><?echo $sql_result['intro_id']; ?></td>

                                                                <td><?echo $sql_result['introducer_name']; ?></td>
                                                                <td><?echo $sql_result['introducer_mobile']; ?></td>
                                                                   <td><?echo $mem_status; ?></td>
                        <td><?echo $is_product_received; ?></td>
                        <td><?echo $amount; ?></td>
                                                                <td><?echo $sql_result['created_at']; ?></td>
                                                               
                                                                
                                                            </tr>
                                                        
                                        <?$i++;} }
                                       else {?>
                                                              <tr>
                                                                <td><?echo $i; ?></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td><? if($level==1){ echo $zone['name'];} ?></td>
                                                                <td><? if($level==2){echo $zone['zone'];} ?></td>
                                                                <td><? if($level==3){echo   $zone['state'];} ?></td>
                                                                <td><? if($level==4){echo $zone['division'];} ?></td>
                                                                <td><? if($level==5){echo  $zone['district'];} ?></td>
                                                                <td><? if($level==6){echo  $zone['taluka']; }?></td>
                                                                <td><? if($level==7){echo $zone['pincode'];} ?></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                        <?php $i++; } $y++;
                                                        $total=$total+1; }}?>



                                                        <?php
                                        //  if ($total=$countrycount+$new_zonecount+$new_statecount+$new_citycount+$new_districtcount+$new_talukacount+$new_pincodecount)
                                        // { 
                                                        if (1) 
                                        {
                                      
                                          // $forquery= $sqlpincode;
                                           $level=8;
                                      

                                            if ($level==8) {                                               
                                             $query="AND level_id='8' AND  village<>'0'";
                                              }
 


                                        $sql = mysqli_query($con, "select * from new_member where status=1 $query order by id ASC");                                               
                                               
                                                while ($sql_result = mysqli_fetch_assoc($sql)) {


                                                    $f_id=$sql_result['id'];

                                                    if ($sql_result['mem_status'] == 'p') {
                                                        $mem_status = 'Paid';
                                                    } else {
                                                        $mem_status = 'Unpaid';
                                                    }

                                                    if ($sql_result['is_product_received'] == 1) {
                                                        $is_product_received = '<p id="CNGProst_'.$f_id.'"><span onclick="CNGProst(0,'.$f_id.')">Given</span></p>';
                                                    } else {
                                                        $is_product_received = '<p id="CNGProst_'.$f_id.'"><span onclick="CNGProst(1,'.$f_id.')">Not Given</span></p>';
                                                    }

                                                    if ($sql_result['created_at'] < '2020-10-22') {
                                                        $amount = 5000;
                                                    } else {
                                                        $amount = 1000;
                                                    }
                                                    
                                                          ?>
                                                            <tr>
                                                                <td><?echo $i; ?></td>
                                                                <td><?echo $sql_result['name']; ?></td>
                                                                <td><?echo $sql_result['mobile']; ?></td>
                                                                <td><?echo $sql_result['level_id']; ?></td>
                                                                <td><?echo $sql_result['star']; ?></td>
                                                                <td><?echo $sql_result['position_name']; ?></td>
                                                                <td><? if($sql_result['country']!=0){ echo get_country($sql_result['country']);} ?></td>
                                                                <td><? if($sql_result['zone']!=0){echo get_zone($sql_result['zone']);} ?></td>
                                                                <td><? if($sql_result['state']!=0){echo get_state($sql_result['state']);} ?></td>
                                                                <td><? if($sql_result['division']!=0){echo get_division($sql_result['division']);} ?></td>
                                                                <td><? if($sql_result['district']!=0){echo get_district($sql_result['district']);} ?></td>
                                                                <td><? if($sql_result['taluka']!=0){echo get_taluka($sql_result['taluka']); }?></td>
                                                                <td><? if($sql_result['pincode']!=0){echo get_pincode($sql_result['pincode']);} ?></td>
                                                                <td><?if ($sql_result['village'] != 0) {echo get_villege($sql_result['village']);}?></td>

                                                                <td><?echo $sql_result['location']; ?></td>
                                                                <td><?echo $sql_result['pan']; ?></td>
                                                                <td><?echo $sql_result['adhar_card']; ?></td>
                                                                <td><?echo $sql_result['gst']; ?></td>
                                                                <td><?echo $sql_result['intro_id']; ?></td>

                                                                <td><?echo $sql_result['introducer_name']; ?></td>
                                                                <td><?echo $sql_result['introducer_mobile']; ?></td>
                                                                   <td><?echo $mem_status; ?></td>
                                                                    <td><?echo $is_product_received; ?></td>
                                                                    <td><?echo $amount; ?></td>
                                                                <td><?echo $sql_result['created_at']; ?></td>
                                                               
                                                                
                                                            </tr>
                                                        
                                        <?$i++;} $total=$total+1; }?>

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
    <!--<script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>-->

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
