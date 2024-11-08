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



    </style>
    
    
</head>
<body class="theme-red">
    <div class="overlay"></div>>
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
    <style>
        .content ul li a{
            font-size: 20px;
        }
    </style>
    <section class="content">
        <ul>

            <li>
                <a href="https://modimarts.com/franchise8/com_distribution.php">Total Commission And Distribution(Level Wise)</a>
            </li>
            <li>
                <a href="https://modimarts.com/franchise8/all_com.php">Total Commission With Bank Details</a>
            </li>
            <li>
                <a href="https://modimarts.com/franchise8/franch_com_join.php">Joining Commission from 800 </a>
            </li>
            
                        <li>
                <a href="https://modimarts.com/franchise8/overall_franch_com_join.php">Joining Commission from 800 - Overall</a>
            </li>
               <li>
                <a href="https://modimarts.com/franchise8/admin/add_commission.php">Add Product Commission</a>
            </li>
        </ul>
    </section>
    
    </body>
    </html>