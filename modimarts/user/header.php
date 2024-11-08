<?php
session_start();
$cid=$_SESSION['id'];
include('config.php');
$avtar=mysqli_query($con1,"select * from clients where code='".$cid."'");
$avtarres=mysqli_fetch_row($avtar);
$cname=$avtarres[1];    
$conname=$avtarres[11]; 
?> 
<!doctype html>
<html lang="en">
    <head>
    <!-- Meta -->
    <meta charset="UTF-8">
    <meta name="author" content="Acura" >   
    <meta name="description" content="Acura - A Real Admin Template">
    <meta name="keywords" content="Acura, Admin Template, Admin, Premium, ThemeForest, Clean, Modern, Responsive">
    <!-- Responsive viewport --> 
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <!-- Title -->
    <title>Merchant-Welcome</title>
    <!-- Favicon -->
  <link rel="icon" type="image/png" href="../image/Merabaz.png">
  <!-- LessCSS Style --><!--  
  <link rel="stylesheet/less" type="text/css" href="css/style.less">
  <script src="js/lessCSS/less-1.4.2.min.js" type="text/javascript"></script>-->
  <!-- Pure CSS Style -->
  <!--  
  <link rel="stylesheet" type="text/css" href="css/style.css">
  -->
  <!-- Pure CSS Style (minified) -->
  <link rel="stylesheet" type="text/css" href="css/style-min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link href="../datepc/dcalendar.picker.css" rel="stylesheet" type="text/css">
  <!-- WebFonts -->
  <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic|Open+Sans:400italic,700italic,400,700' rel='stylesheet' type='text/css'>
  <!-- Font Awesome --> 
  <link href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-2.0.3.min.js"></script>
  <script src="js/jquery-migrate/jquery-migrate-1.0.0.js"></script>
  <!-- Acura JS -->
  <script src="js/acura.js"></script>
  <!-- Tipsy jQuery --> 
  <script src="js/tipsy/jquery.tipsy.js"></script>
  <link href="js/tipsy/tipsy.css" rel="stylesheet"> 
  <!-- Masked Input -->
  <script src="js/maskedinput/jquery.maskedinput.min.js"></script>
  <!-- Textarea Autosize -->
  <script src="js/autosize/jquery.autosize.min.js"></script>
  <!-- Textarea Counter -->
  <script src="js/nobleCount/jquery.NobleCount.min.js"></script>
  <!-- Uniform -->
  <link rel="stylesheet" href="js/uniform/theme/css/uniform.default.min.css">
  <script src="js/uniform/jquery.uniform.min.js"></script>
  <!-- jQuery UI -->
  <script src="js/jquery-ui-1.10.3/js/jquery-ui-1.10.3.custom.min.js"></script>
  <link rel="stylesheet" href="js/jquery-ui-1.10.3/css/no-theme/jquery-ui-1.10.3.custom.css">
  <!-- CLEditor -->
  <script src="js/cleditor/jquery.cleditor.min.js"></script>
  <link rel="stylesheet" href="js/cleditor/jquery.cleditor.css">
  <!-- jQuery textext -->
  <script src="js/tagsinput/jquery.tagsinput.min.js"></script>
  <link rel="stylesheet" href="js/tagsinput/jquery.tagsinput.css">
  <!-- flot -->
  <script src="js/flot/jquery.flot.min.js"></script>
  <script src="js/flot/jquery.flot.resize.js"></script>
  <script src="js/flot/jquery.flot.time.js"></script>
  <script src="js/flot/jquery.flot.threshold.js"></script>
  <script src="js/flot/jquery.flot.pie.js"></script>
  <script src="js/flot/jquery.flot.stack.js"></script>
  <!-- colResizable -->
  <script src="js/colResizable/colResizable-1.3.js"></script>
  <script src="js/dataTables/jquery.dataTables.min.js"></script>
  <!-- Full Calendar -->
  <script src="js/fullcalendar/fullcalendar.min.js"></script>
  <link rel="stylesheet" href="js/fullcalendar/fullcalendar.css">
  <!-- jquery UI Map -->
  <script src="https://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>
  <script src="js/jquery-ui-map/ui/jquery.ui.map.js" type="text/javascript"></script>
  <!-- jQuery Vector Map -->
  <script src="js/jqvmap-stable/jqvmap/jquery.vmap.js" type="text/javascript"></script>
  <script src="js/jqvmap-stable/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
  <script src="js/jqvmap-stable/jqvmap/maps/jquery.vmap.world.js"></script>
  <script src="js/jqvmap-stable/jqvmap/data/jquery.vmap.sampledata.js"></script>
  <!-- jQuery Knob -->
  <script src="js/jquery-knob/jquery.knob.js"></script>
  <!-- bxSlider -->
  <script src="js/bxSlider/jquery.bxslider.min.js"></script>
  <link href="js/bxSlider/jquery.bxslider.css" rel="stylesheet">
  <!-- Gritter -->
  <script src="js/gritter/js/jquery.gritter.min.js"></script>
  <link href="js/gritter/css/jquery.gritter.css" rel="stylesheet">
  <!-- Lightbox -->
  <!--<script src="js/lightbox/js/lightbox-2.6.min.js"></script>-->
  <script src="js/lightbox/js/lightbox-2.6.js"></script>
  <link href="js/lightbox/css/lightbox.css" rel="stylesheet">
  <!-- jGrowl-->
  <link rel="stylesheet" href="js/jGrowl/jquery.jgrowl.css" />
  <script src="js/jGrowl/jquery.jgrowl.min.js"></script>
  <!-- Circle Slider -->
  <link rel="stylesheet" href="js/circleSlider/css/website.css" />
  <script src="js/circleSlider/js/jquery.tinycircleslider.min.js"></script>
  <!-- Highlight.js -->
  <script src="js/highlight.js/highlight.pack.js"></script>
  <link rel="stylesheet" href="js/highlight.js/styles/github.css">
  <script>hljs.initHighlightingOnLoad();</script>
  <link href="https://fonts.googleapis.com/css?family=Inconsolata:400,700" rel="stylesheet" type="text/css">
  <!-- Color Picker -->
  <link rel="stylesheet" media="screen" type="text/css" href="js/colorpicker/css/colorpicker.css" />
  <script type="text/javascript" src="js/colorpicker/js/colorpicker.js"></script>
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script>
  function  fn(sts,slotpos)
  {
    try
      {
        document.getElementById('slotid').value=sts;
        if(sts=="")
        {
            $('#slotbkform').attr('action', 'adsuploadpguser.php');
        }else 
        {
            window.open("adslotbooking.php?cvxrtqweroerfer="+sts+'&gvhjyuskaertfer='+slotpos,'_self');
            //$('#slotbkform').attr('action', 'adslotbooking.php'); 
        }
      //$('#slotbkform').submit(); 
      } catch(ac)
      {
        alert(ac);
      }
    }
  </script>
  <!-- Ruchi 3 jan 20 -->
</head>
<!-- Main Container -->
<body>
  <div class="container">
    <form id="slotbkform" name="slotbkform" method="post">
        <input type="hidden" id="slotid" name="slotid" value='<?php if(isset($_GET["slotid"]) & $_GET["slotid"]!=""){ echo $_GET["slotid"];}?>'>
    </form>
    <!-- Sidebar -->
    <aside class="sidebar">
      <!-- .sidebar-mobile .sidebar-reduce -->
      <!-- Logo and Reduce Sidebar -->
      <div class="logo-reduce-sidebar">
        <div class="logo">
          <a href="https://allmart.world/" target="_blank">
            <img class="logo-sidebar-big" src="../assets/allmart.png" alt="Allmart-logo" style="width:130px;">
          </a>
        </div>
        <div class="reduce-sidebar">&#xf0c9;</div>
      </div>
      <!-- Sidebar Nav -->
      <nav class="nav-sidebar">
        <ul>
          <li>
             <a href="welcome.php" class="on sidebar-big">
              <span class="icon">&#xf132;</span>
              Home
            </a>
          </li>
          <li>
            <a href="#" class="sidebar-big">
              <span class="icon">&#xf0b1;</span>
              Personlize
              <i class="sub-menu-caret">&#xf0dd;</i>
            </a>
            <!-- Sub Menu -->
            <ul class="sub-sidebar" >
              <li>
                <a href="edit_profile.php">
                  Edit Profile
                </a>
              </li>
              <li>
                <a href="changepassword.php">
                  Change Password
                </a>
              </li>
             </ul>
          </li>
          <li>
            <a href="#" class="sidebar-big">
              My Products
               <i class="sub-menu-caret">&#xf0dd;</i>
            </a>
            <!-- Sub Menu -->
            <ul class="sub-sidebar">
              <li>
                <a href="add_product.php">
                  Add Products
                </a>
              </li>
              <li>
                <a href="view_products.php">
                  View Products
                </a>
              </li>
            </ul>
          </li>
          <!--Ruchi-->
          <li>
            <a href="#" class="sidebar-big">
              My Subscriptions / Offers
               <i class="sub-menu-caret">&#xf0dd;</i>
            </a>
            <!-- Sub Menu -->
            <ul class="sub-sidebar">
              <li>
                <a href="view_subscriptions.php">
                  My Subscriptions
                </a>
              </li>
              <li>
                <a href="view_offer.php">
                  My Offers
                </a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#" class="sidebar-big">
                Reports
               <i class="sub-menu-caret">&#xf0dd;</i>
            </a>
            <!-- Sub Menu -->
            <ul class="sub-sidebar">
              <li>
                <a href="my_subscriptions.php">
                  Subscriptions
                </a>
              </li>
              <li>
                <a href="my_offers.php">
                  Offers
                </a>
              </li>
              <li>
                <a href="view_mySlots.php">
                  Slot Booked
                </a>
              </li>
              <li>
                <a href="view_sold_products.php">
                 Products Sold
                </a>
              </li>
              <li>
                <a href="claim_bill.php">
                 Claim Bill
                </a>
                <a href="bills.php">
                  Billing Report
                </a>
              </li>
              <li>
                <a href="payment_history.php">
                 Pending Payments
                </a>
              </li>
              <li>
                <a href="order_history.php">
                 Order History
                </a>
              </li>
            </ul>
          </li>
          <?php 
            $admin_cid=mysqli_query($con1,"select cid,department from users where  cid='".$_SESSION["id"]."' ");
            $result_admin=mysqli_fetch_array($admin_cid);
            if($result_admin[0]!=0 && $result_admin[1]!='admin'){
          ?>
          <li>
             <a href="HomePageImage.php" class="on sidebar-big" target="_blank">
              <span class="icon">&#xf132;</span>
              Advertise
            </a>
          </li>
          <li>
             <a href="upload_ads_videos.php" class="on sidebar-big">
              <span class="icon">&#xf132;</span>
              Upload Ads
            </a>
          </li>
         <?php } ?>
          <li>
            <a href="logout.php" class="sidebar-big">
                LogOut
            </a>
          </li>
        </ul>
      </nav>
    </aside>
    <!-- Contents -->
    <div class="contents"  >
      <!-- Header -->
      <header class="header grid-12" >
        <!-- Mobide Header -->
        <div class="grid-12 mobile-header">
          <!-- Logo -->
          <div class="logo-mh">
            <a href="index.html">
              <img src="logosmall.png" alt="acura-logo">
            </a>
          </div>
          <!-- Reduce -->
          <div class="reduce-sidebar-mh">&#xf0c9;</div>
        </div>
         <div class="search-top-nav grid-8">
          <!-- Search -->
          <div class="search">
            <div class="live-search">  </div>
          </div>
          <!-- Top Navigation -->
          <div class="top-nav">  </div>
        </div>
        <!-- User -->
        <div class="top-user grid-4">
          <!-- User Avatar -->
          <div class="user-avatar">
            <img src="<?php echo $mainpath.$avtarres[18]; ?>" alt="<?php echo $conname ?>" width="65" height="65">
          </div>
          <!-- User Data -->
          <div class="user-data">
            <h4><a href="#"><?php echo $conname ?></a></h4>
            <h6><?php echo $cname; ?></h6>
            <!-- User Notifications -->
            <ul class="user-notifications">
            <!--  <li id="u-top-logs-toggle">&#xf0ac;<span>5</span></li>
              <li id="u-top-msg-toggle">&#xf003;<span>13</span></li>-->
            </ul>
            <!-- User Options -->
            <ul class="user-options">
              <li>
                <div id="u-s-icon" class="btn btn-menu btn-small btn-transparent btn-o-icon"><i>&#xf013;</i>
                  <!-- Menu -->
                  <div class="menu menu-bottom-right">
                    <ul>
                      <li>
                        <a href="edit_profile.php">
                          <div class="menu-icon"><!-- Empty --></div>
                          <div class="menu-title">
                            Edit Profile
                          </div>
                        </a>
                      </li>
                      <li>
                        <a href="logout.php">
                          <div class="menu-icon"><!-- Empty --></div>
                          <div class="menu-title">
                            Logout
                          </div>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <!-- Hidden Stats -->
        <div class="grid-12 hidden-top-stats">
          <div class="grid-12">
            <div class="widget widget-no-border">
              <div class="widget-body no-padding">
                <div class="h-m-s"></div>
              </div>
            </div>
          </div>
        </div>
        <!-- Popular Page -->
        <div class="top-buttons grid-12">
          <div class="grid-2">
            <a href="order.php">
              <div class="data-icon" style="color: #95CFB7;">&#xf07a;</div>
              <div class="data-info">
                <?php 
                    $qryshow=mysqli_query($con1,"SELECT count(id) FROM `order_details` where mrc_id='".$_SESSION["id"]."'"); 
                    $fetchshow=mysqli_fetch_array($qryshow);
                ?>
                <h4><?php echo $fetchshow[0];?></h4>
                <h5>My Orders</h5>
              </div>
            </a>
          </div>
        </div>
