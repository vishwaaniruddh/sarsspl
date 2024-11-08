<?php
session_start();
// var_dump($_SESSION);
$MemberID=$_GET['MemberID'];
if (!isset($_SESSION['username'])) {
    ?>

    <script>
        window.location.href='https://allmart.world/franchise/get_members.php';
    </script>

<?
}
include '../config.php';


function GetMembers($memid)
{

    global $con3;

    $getdata=mysqli_query($con3,"SELECT name FROM `new_member` WHERE id ='".$memid."'");
    $getdata1=mysqli_fetch_assoc($getdata);

    return $getdata1['name'];

}

function country_name($id)
{

    global $con3;

    $sql        = mysqli_query($con3, "select country from new_country where id = '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['country'];
}

function zone_name($id)
{

    global $con3;

    $sql        = mysqli_query($con3, "select zone from new_zone where id = '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['zone'];
}

function state_name($id)
{

    global $con3;

    $sql        = mysqli_query($con3, "select state from new_state where id = '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['state'];
}

function division_name($id)
{

    global $con3;

    $sql        = mysqli_query($con3, "select division from new_division where id = '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['division'];
}

function district_name($id)
{

    global $con3;

    $sql        = mysqli_query($con3, "select district from new_district where id = '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['district'];
}

function taluka_name($id)
{

    global $con3;

    $sql        = mysqli_query($con3, "select taluka from new_taluka where id = '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['taluka'];
}

function pincode_name($id)
{

    global $con3;

    $sql        = mysqli_query($con3, "select pincode from new_pincode where id = '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['pincode'];
}

function village_name($id)
{

    global $con3;

    $sql        = mysqli_query($con3, "select village from new_village where id = '" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['village'];
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
        <div class="container-fluid">
                            <!-- Input -->
            <div class="row clearfix">
                

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Franchisee Transfer History
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
                                            <th>Franchise</th>
                                            <th>Old Date </th>
                                            <th>Updated Date </th>
                                            <th>Previous Position</th>
                                            <th>Changed Position</th>
                                            <th>Updated By</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                       $mydata= mysqli_query($con3,"SELECT * FROM `franchise_transfer_history` WHERE mem_id='".$MemberID."' ORDER BY `franchise_transfer_history`.`id` DESC");
                                       foreach ($mydata as $key => $value) {


                                        $allot_Status=$value['allot_Status'];
                                        if ($allot_Status==1) {
                                            $status="<a class='btn btn-success'>Alloted</a>";
                                        }if ($allot_Status==0) {
                                            $status="<a class='btn btn-danger'>Not-Alloted</a>";
                                        }

                                        $newdata=json_decode($value['updated_place']);
                                        $olddata=json_decode($value['before_place']);

                                        $NewCountry=$newdata->country;
                                        $Newzone=$newdata->zone;
                                        $Newstate=$newdata->state;
                                        $Newdivision=$newdata->division;
                                        $Newdistrict=$newdata->district;
                                        $Newtaluka=$newdata->taluka;
                                        $Newpincode=$newdata->pincode;
                                        $Newvillage=$newdata->village;
                                           // GetCountryname
                                        if ($NewCountry!=0) {
                                            $CountryName="Country - ".country_name($NewCountry);
                                        }
                                        else
                                        {
                                          $CountryName="Country - NA";  
                                        }

                                        // Get Zone name
                                        if ($Newzone!=0) {
                                            $ZoneName="Zone - ".zone_name($Newzone);
                                        }
                                        else
                                        {
                                          $ZoneName="";  
                                        }
                                          // get State Name
                                        if ($Newstate!=0) {
                                            $stateName="State - ".state_name($Newstate);
                                        }
                                        else
                                        {
                                          $stateName="";  
                                        }

                                        // get Division Name
                                        if ($Newdivision!=0) {
                                            $divisionName="Division - ".division_name($Newdivision);
                                        }
                                        else
                                        {
                                          $divisionName="";  
                                        }

                                        // get District Name
                                        if ($Newdistrict!=0) {
                                            $DistrictName="Disrict - ".district_name($Newdistrict);
                                        }
                                        else
                                        {
                                          $DistrictName="";  
                                        }
                                        // get taluka name
                                        if ($Newtaluka!=0) {
                                            $TalukaName="Taluka - ".taluka_name($Newtaluka);
                                        }
                                        else
                                        {
                                          $TalukaName="";  
                                        }
                                        // get pincode name
                                        if ($Newpincode!=0) {
                                            $PincodeName="Pincode - ".pincode_name($Newpincode);
                                        }
                                        else
                                        {
                                          $PincodeName="";  
                                        }
                                        // get village name
                                        if ($Newvillage!=0) {
                                            $VillageName="Village - ".village_name($Newvillage);
                                        }
                                        else
                                        {
                                          $VillageName="";  
                                        }

                                        $NewPlace= $CountryName."<br/>".$ZoneName."<br/>".$stateName."<br/>".$divisionName."<br/>".$DistrictName."<br/>".$TalukaName."<br/>".$PincodeName."<br/>".$VillageName;


                                        $oldCountry=$olddata->country;
                                        $oldzone=$olddata->zone;
                                        $oldstate=$olddata->state;
                                        $olddivision=$olddata->division;
                                        $olddistrict=$olddata->district;
                                        $oldtaluka=$olddata->taluka;
                                        $oldpincode=$olddata->pincode;
                                        $oldvillage=$olddata->village;

                                        if ($oldCountry!=0) {
                                            $CountryNameA="Country - ".country_name($oldCountry);
                                        }
                                        else
                                        {
                                          $CountryNameA="Country - NA";  
                                        }

                                        // Get Zone name
                                        if ($oldzone!=0) {
                                            $ZoneNameA="Zone - ".zone_name($oldzone);
                                        }
                                        else
                                        {
                                          $ZoneNameA="";  
                                        }
                                          // get State Name
                                        if ($oldstate!=0) {
                                            $stateNameA="State - ".state_name($oldstate);
                                        }
                                        else
                                        {
                                          $stateNameA="";  
                                        }

                                        // get Division Name
                                        if ($olddivision!=0) {
                                            $divisionNameA="Division - ".division_name($olddivision);
                                        }
                                        else
                                        {
                                          $divisionNameA="";  
                                        }

                                        // get District Name
                                        if ($olddistrict!=0) {
                                            $DistrictNameA="Disrict - ".district_name($olddistrict);
                                        }
                                        else
                                        {
                                          $DistrictNameA="";  
                                        }
                                        // get taluka name
                                        if ($oldtaluka!=0) {
                                            $TalukaNameA="Taluka - ".taluka_name($oldtaluka);
                                        }
                                        else
                                        {
                                          $TalukaNameA="";  
                                        }
                                        // get pincode name
                                        if ($oldpincode!=0) {
                                            $PincodeNameA="Pincode - ".pincode_name($oldpincode);
                                        }
                                        else
                                        {
                                          $PincodeNameA="";  
                                        }
                                        // get village name
                                        if ($oldvillage!=0) {
                                            $VillageNameA="Village - ".village_name($oldvillage);
                                        }
                                        else
                                        {
                                          $VillageNameA="";  
                                        }

                                        $OldPlace= $CountryNameA."<br/>".$ZoneNameA."<br/>".$stateNameA."<br/>".$divisionNameA."<br/>".$DistrictNameA."<br/>".$TalukaNameA."<br/>".$PincodeNameA."<br/>".$VillageNameA;


                                           
                                         ?>
                                    <tr role="row" >
                                            <td><?=$key+1?></td>
                                            <td><?=GetMembers($value['mem_id'])?></td>
                                            <td><?=date('d-M-Y',strtotime($value['start_date']))?></td>
                                            <td><?=date('d-M-Y',strtotime($value['end_date']))?></td>
                                            <td><?=$OldPlace?></td>
                                           
                                            <td><?=$NewPlace?></td>
                                            <td><?=$value['updated_by']?></td>
                                            <td><?=$status?></td>
                                        </tr>
                                    <?php } ?>
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
</body>
</html>
