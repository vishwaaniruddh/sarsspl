<? session_start();

include('config.php');?>

<html>

<head>
    
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>All Mart | Members</title>
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

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <!--<link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />-->

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Sweetalert Css -->
    <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    
    
    
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />
    <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
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
#member_pic img{
    height: 150px;
    /*width: 150px;*/
        border: 1px solid black;
}
.table tbody tr td{
    vertical-align: baseline;
    
}
    </style>
</head>

<script>
    if (!!window.performance && window.performance.navigation.type === 2) {
            // value 2 means "The page was accessed by navigating into the history"
            console.log('Reloading');
            window.location.reload(); // reload whole page

        }
</script>

<body class="theme-red">
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
                
                <a class="navbar-brand" href="index.php" style="display:flex;height: 100px;margin: auto; line-height: 3;     padding: 0;
    width: 100%;">
                                    <img src="logo.jpg" style="width:100px;" >
                    <span style="margin: auto 5%;">AllMart</span>
                
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    
                    <li>
                        <a href="http://www.allmart.world/franchise/get_members.php" class="">Member Filter</a>
                    </li>
                    
                    <? 
                    if(isset($_SESSION) && $_SESSION['rollid']==1){ ?>
                                        <li>
                        <a href="http://www.allmart.world/franchise/admin/members.php" class="">Member</a>
                    </li>
                    
                    
                    <li>
                        <a href="http://www.allmart.world/franchise/admin/pending_approve.php" class="">Pending Approve</a>
                    </li>
                        
                    <? } else{ ?>
                    <li>
                        <a href="http://www.allmart.world/franchise/admin/index.php" class="">Login</a>
                    </li>     
                    <? } ?>
                   
                   
                </ul>
            </div>
        </div>
    </nav>
    
    
    <style>
        label span{
            color:red;
        }
    </style>

    <section class="content">
        <div class="container-fluid">

            <!-- Select -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    
                    
  <form id="form" action="process_franchise_details.php" method="POST">
    
    <div class="card">
        <div class="body">
        
            <div class="row clearfix">
                <div class="col-md-6">
                    
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="name" class="form-control">
                                <label class="form-label">Name</label>
                            </div>
                        </div>
                </div>
                <div class="col-md-6">
                      <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="mobile" class="form-control">
                                <label class="form-label">Mobile</label>
                            </div>
                        </div>
                </div>
               
            </div>
            
            <div class="row clearfix">
                                        
                                        
                                        
                                        <div class="col-sm-6">
                                            <label>Want Area</label>
                                            <select class="form-control" id="zone">
                                                <option value="">  Select </option>
                                                <option value="2">  Zone </option>
                                                <option value="3">  State </option>
                                                <option value="4">  Division </option>
                                                <option value="5">  District </option>
                                                <option value="6"> Taluka  </option>
                                                <option value="7">  Pincode </option>
                                                <option value="8">  Village </option>
                                            </select>
                                        </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                            <input type="text" name="address" value="" class="form-control">
                                            <label class="form-label">Write Area</label>
                                        </div>
                                    </div>
                                </div>
        </div>
            
            <div class="row clearfix">
                                        <div class="col-sm-6">
                                            <label>State</label>
                                            <select class="form-control" name="select_state">
                                                <option value="">  Select </option>
                                                <? 
                                                $state_sql = mysqli_query($con,"select * from new_state order by state ASC");
                                                
                                                while($state_sql_result = mysqli_fetch_assoc($state_sql)){ ?>
                                                   
                                                   <option value="<? echo $state_sql_result['id'];?>">
                                                       <? echo $state_sql_result['state'];?>
                                                   </option>
                                                    
                                                <? }
                                                ?>
                                            </select>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                            <input type="email" name="email" class="form-control">
                                            <label class="form-label">Email</label>
                                        </div>
                                    </div>
                                </div>
                                        </div>
                                        
            <div class="row clearfix">
                <div class="col-md-4">
                    
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="intro_id" class="form-control">
                                <label class="form-label">Introducer ID</label>
                            </div>
                        </div>
                </div>
                <div class="col-md-4">
                      <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="intro_name" class="form-control">
                                <label class="form-label">Introducer Name</label>
                            </div>
                        </div>
                </div>
                <div class="col-md-4">
                       <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="intro_mob" class="form-control">
                                <label class="form-label">Introducer Mobile</label>
                            </div>
                        </div>
                </div>
            </div>
            
            <div class="row clearfix" style="display:flex;justify-content:center;">
                <input type="submit" class="btn btn-danger" value="Pay">
            </div>
            
        </div>
    </div>
</form>
                    
                </div>
            </div>
            <!-- #END# Select -->
</div>
    </section>
    
    
    <script src="plugins/jquery/jquery.min.js"></script> 
    <script src="plugins/bootstrap/js/bootstrap.js"></script>
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="plugins/node-waves/waves.js"></script>
    <script src="plugins/autosize/autosize.js"></script>
    <script src="plugins/momentjs/moment.js"></script>
    <script src="plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="js/admin.js"></script>
    <script src="js/pages/forms/basic-form-elements.js"></script>
    <script src="js/admin.js"></script>
    <script src="js/demo.js"></script>
    <script src="plugins/sweetalert/sweetalert.min.js"></script>
    <script src="js/pages/ui/dialogs.js"></script>

</body>
</html>
