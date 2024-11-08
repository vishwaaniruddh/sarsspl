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
    
    $sql = mysqli_query($con,"select * from new_city where id='".$id."'");
    
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['city'];
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
               .navbar-nav {
     margin: 2% auto !important;
}

        td{
                white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
        }
    </style>
</head>
<body class="theme-red">
    <!-- Page Loader -->
    <!--<div class="page-loader-wrapper">-->
    <!--    <div class="loader">-->
    <!--        <div class="preloader">-->
    <!--            <div class="spinner-layer pl-red">-->
    <!--                <div class="circle-clipper left">-->
    <!--                    <div class="circle"></div>-->
    <!--                </div>-->
    <!--                <div class="circle-clipper right">-->
    <!--                    <div class="circle"></div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <p>Please wait...</p>-->
    <!--    </div>-->
    <!--</div>-->
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
                
                <a class="navbar-brand" href="http://www.modimart.world/franchise2/" style="display:flex;height: 100px;margin: auto; line-height: 3;     padding: 0;
    width: 100%;">
                                    <img src="https://modimart.world/assets/logo.png" alt="" style="width: 100px;background:white;border-radius: 50%;">
                    <span style="margin: auto 5%;">ModiMart</span>
                
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li>
                        <a href="http://www.modimart.world/franchise2/admin/members.php" class="">Member</a>
                    </li>
                    
                    
                    <li>
                        <a href="http://www.modimart.world/franchise2/admin/pending_approve.php" class="">Pending Approve</a>
                    </li>
                   
                </ul>
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
                            <?  $id = $_GET['id']; 
                            
                            
                            $sql = mysqli_query($con,"select * from new_member where id='".$id."'");
                            $sql_result = mysqli_fetch_assoc($sql);
                            
                            
                            // var_dump($sql_result);

                            ?>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Name</label>
                                    <p><? echo $sql_result['name'];?></p>
                                </div>
                                <div class="col-md-3">
                                    <label>mobile</label>
                                    <p><? echo $sql_result['mobile'];?></p>
                                </div>
                                <div class="col-md-3">
                                    <label>Is Verfied</label>
                                    <?  if($sql_result['is_verify'] ==1){
                                        echo '<p>Verified Member</p>';
                                    }
                                    else{
                                        echo '<p>Not Verified</p>';
                                    }
                                    
                                    ?>
                                </div>
                                <div class="col-md-3">
                                    <label>Star</label>
                                    <p><? echo $sql_result['star'];?></p>
                                </div>
                            </div>
                            
                            
                            
                            <hr>
                            
                            
                            
                            
                                <div class="row cust_row">
                                    <label>Country</label>
                                    <span><? echo get_country($sql_result['country']);?></span>
                                </div>
                                
                                
                                
                                 <div class="row cust_row">
                                    <label>Zone</label>
                                    <span><? echo get_zone($sql_result['zone']);?></span>
                                </div>
                                
                              
                                <div class="row cust_row">
                                    <label>State</label>
                                    <span><? echo get_state($sql_result['state']);?></span>
                                </div>
                                <div class="row cust_row">
                                    <label>Division</label>
                                    <span><? echo get_division($sql_result['division']);?></span>
                                </div>
                                <div class="row cust_row">
                                    <label>District</label>
                                    <span><? echo get_district($sql_result['district']);?></span>
                                </div>
                                <div class="row cust_row">
                                    <label>Taluka</label>
                                    <span><? echo get_taluka($sql_result['taluka']);?></span>
                                </div>
                                
                                <div class="row cust_row">
                                    <label>Pincode</label>
                                    <span><? echo get_pincode($sql_result['pincode']);?></span>
                                </div>
                                
                                <div class="row cust_row">
                                    <label>Village</label>
                                    <span><? echo $sql_result['village'];?></span>
                                </div>
                                
                                  <div class="row cust_row">
                                    <label>Location</label>
                                    <span><? echo $sql_result['location'];?></span>
                                </div>
                                
<hr>
                            
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Full Payment Date</label>
                                    <p><? echo $sql_result['full_pay_date'];?></p>
                                </div>
                                <div class="col-md-3">
                                 <label>Amount Receivable</label>
                                    <p><? echo $sql_result['payment_receivable'];?>
                                    </p>
                                </div>
                                <div class="col-md-3">
                                 <label>Amount Received</label>
                                    <p><? echo $sql_result['payment_received'];?>
                                    </p>
                                </div>
                                <div class="col-md-2">
                                    <label>Balance</label>
                                    <p><? echo $sql_result['balance'];?></p>
                                </div>
                                
                                <div class="col-md-1">
                                    <label>is_paid</label>
                                     <?  if($sql_result['is_paid'] ==1){
                                        echo '<p>Paid</p>';
                                    }
                                    else{
                                        echo '<p>Not Paid</p>';
                                    } ?>
                                </div>
                            </div>
                            
                            
                            <div class="row">
                                
                                <div class="col-md-3">
                                    <label>Introducer Name</label>
                                    <p><? echo $sql_result['introducer_name'];?></p>
                                </div>
                                <div class="col-md-3">
                                    <label>Introducer Mobile</label>
                                    <p><? echo $sql_result['introducer_mobile'];?></p>
                                </div>
                                <!--<div class="col-md-3"></div>-->
                                <!--<div class="col-md-3"></div>-->
                                
                            </div>
                            
                            
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>


<? include('../footer.php');?>