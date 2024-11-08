<?php
session_start();
$cid=$_SESSION['id'];
include('config.php');
$avtar=mysql_query("select * from clients where code='".$cid."'");
$avtarres=mysql_fetch_row($avtar);
$cname=$avtarres[1];   
$conname=$avtarres[11]; 
?>  
<!-- Favicon -->
  <link rel="icon" type="image/png" href="logomera.png"> 
  <!-- LessCSS Style --><!--  
  <link rel="stylesheet/less" type="text/css" href="css/style.less">
  <script src="js/lessCSS/less-1.4.2.min.js" type="text/javascript"></script>-->
  <!-- Pure CSS Style -->
  <!--  
  <link rel="stylesheet" type="text/css" href="css/style.css">-->
  <!-- Pure CSS Style (minified) -->
  <link rel="stylesheet" type="text/css" href="css/style-min.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link href="../datepc/dcalendar.picker.css" rel="stylesheet" type="text/css">

  <!-- WebFonts -->
  <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic|Open+Sans:400italic,700italic,400,700' rel='stylesheet' type='text/css'>
  <!-- Font Awesome --> 
  <link href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
  <!-- jQuery -->
  <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
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
  <script src="http://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>
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
  <link href="http://fonts.googleapis.com/css?family=Inconsolata:400,700" rel="stylesheet" type="text/css">
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
</head>
<!-- Main Container -->
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
          <a href="sarmicrosystems.com/oc1" target="_blank">
            <img class="logo-sidebar-big" src="logomera.png" alt="MERABAZA-logo" style="width:200px;">
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
            <a href="#" class="sidebar-big sub-menu-caret">
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
            <a href="#" class="sub-menu-caret">
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
            <a href="#" class="sub-menu-caret">
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
            <a href="#" class="sub-menu-caret">
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
            $admin_cid=mysql_query("select cid,department from users where  cid='".$_SESSION["id"]."' ");
            $result_admin=mysql_fetch_array($admin_cid);
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
          <?php /*if($avtarres[14]>500) {?> 
          <li>
            <a href="#" class="sidebar-big">
              My Blog
               <i class="sub-menu-caret">&#xf0dd;</i>
            </a>
            <!-- Sub Menu -->
            <ul class="sub-sidebar">
              <li>
                <a href="add_blog.php">
                  Add Blogs
                </a>
              </li>
              <li>
                <a href="view_blog.php">
                  View Blogs
                   </a>
              </li>
             </ul>
          </li><?php }
		  if($avtarres[14]>1000)
		  {
		  ?>
          <li>
            <a href="view_gallery.php" class="sidebar-big">
              Gallery
            </a>
           </li>
           <?php }
		   if($avtarres[14]>1500){?>
          <li>
            <a href="#" class="sidebar-big">
              My Offers
               <i class="sub-menu-caret">&#xf0dd;</i>
            </a>
            <!-- Sub Menu -->
            <ul class="sub-sidebar">
              <li>
                <a href="add_offer.php">
                  Add New Offers
                </a>
              </li>
              <li>
                <a href="view_offers.php">
                  View Offers
                </a>
              </li>
             </ul>
          </li>
          <?php } */?> 
        <!--<li>
            <a href="theme.php" class="sidebar-big">
              My Themes
            </a>
           </li>-->
          <li>
            <a href="logout.php" class="sidebar-big">
                LogOut
            </a>
          </li>
          <!--<li>
            <a href="#">
              Empty
            </a>
          </li>-->
        </ul>
      </nav>
      <!-- Ads Widget 
      <div class="sidebar-widget">
        <h4 class="widget-title"><span>&#xf0a1;</span>Ads</h4>
        <a href="#" class="ads-link">
          <img src="http://placebox.es/177/100/F4F4F4/555555/" alt="ads">
        </a><br/>
        <a href="#" class="ads-link">
          <img src="http://placebox.es/177/100/F4F4F4/555555/" alt="ads">
        </a>
      </div>-->
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
            <!--<form action="#">
              <in`put type="text" id="live-search" placeholder="Live Search">
              <input type="submit" value="">
            </form>-->
            <!-- Live Search -->
            <div class="live-search">
              <!--<ul>
                <li>
                  <a href="#">
                    <img src="media/ls1.jpg" alt="preview" class="live-search-thumb">
                    <h4 class="typo">Aspernatur sapiente unde</h4>
                    <p class="typo light no-margin">Reprehenderit eaque illo aspernatur <span class="h">sapiente</span> unde consequuntur quod deserunt maxime vel ...</p>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <img src="media/ls2.jpg" alt="preview" class="live-search-thumb">
                    <h4 class="typo">Eaque illo aspernatur sapiente</h4>
                    <p class="typo light no-margin">Adipisicing <span class="h">elit</span> Mollitia reprehenderit eaque illo aspernatur sapiente unde consequuntur quod deserunt maxime vel ...</p>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <h4 class="typo">Lorem ipsum dolor sit amet.</h4>
                    <p class="typo light no-margin">Lorem ipsum dolor sit amet, consectetur <spna class="h">adipisicing</spna> elit. Mollitia reprehenderit eaque illo aspernatur sapiente unde consequuntur quod deserunt maxime vel ...</p>
                  </a>
                </li>
                <li class="live-search-separator">...</li>
                <li class="live-search-more">
                  <a href="#">
                    See more
                  </a>
                </li>
              </ul>-->
            </div>
          </div>
          <!-- Top Navigation -->
          <div class="top-nav">
            <!--<ul>
              <li><a class="on" href="index.html"><i class="i i-left">&#xf015;</i> <span>Home</span></a></li>
              <li><a href="#"><i class="i i-left">&#xf05a;</i> <span>FAQ</span></a></li>
              <li><a href="#" class="top-menu-trigger"><i class="i i-left">&#xf0ca;</i> <span>Menu</span></a>
                <ul class="top-sub-menu">
                  <li><a href="#">Item One</a></li>
                  <li><a href="#"><i class="i i-left">&#xf0ee;</i> Item Two + Icon</a></li>
                  <li><a href="#">Item Three</a></li>
                  <li><a href="#">Item Four</a></li>
                  <li><a href="#">Item Five</a></li>
                </ul>
              </li>
              <li><a href="#" id="show-h-stats"><i class="i i-left">&#xf126;</i> <span>Hidden Stats</span></a>
              </li>
              <li><a href="#"><i class="i i-left">&#xf091;</i> <span>Buy</span></a></li>
            </ul>-->
          </div>
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
       <!--   <div class="user-message-content">
            <a href="#" class="u-single-mesg">
              <img src="media/chat/u1.jpg" alt="aaa">
              <h5>Joseph Moore</h5>
              <p>Lorem ipsum dolor sit amet ...</p>
              <span><i class="i i-left i-small">&#xf00c;</i>12, August</span>
            </a>
            <a href="#" class="u-single-mesg">
              <img src="media/chat/u2.jpg" alt="aaa">
              <h5>Holly Roberts</h5>
              <p>Nostrum quidem eaque tempora ea totam ...</p>
              <span><i class="i i-left i-small">&#xf112;</i>11, July</span>
            </a>
          </div>
          <div class="user-logs-content">
            <a href="#" class="u-single-mesg">
              <i>&#xf03e;</i>
              <p><strong>Stephen</strong> Add new picture</p>
              <span>12, August</span>
            </a>
            <a href="#" class="u-single-mesg">
              <i>&#xf0e5;</i>
              <p><strong>Rose</strong> Add new comments</p>
              <span>11, July</span>
            </a>
            <a href="#" class="u-single-mesg">
              <i>&#xf07a;</i>
              <p><strong>Thomas</strong> Buy your latest item</p>
              <span>10, July</span>
            </a>
          </div>-->
        </div>
        <!-- Hidden Stats -->
        <div class="grid-12 hidden-top-stats">
          <!-- Multiple Axis -->
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
         <!--  <div class="grid-2">
            <a href="pagetrack.php">
              <div class="data-icon" style="color: #ED303C;">&#xf135;</div>
              <div class="data-info">
              <?php $pgtrakqry=mysql_query("select sum(count) from page_track where cid='".$cid."'");
			  $pgtrak=mysql_fetch_row($pgtrakqry);
			  	echo "<h4>".$pgtrak[0]."</h4>";
				if($pgtrak[0]=="")
				echo "<h4>0</h4>";
			  ?>
                
                <h5>Page Views</h5>
              </div>
            </a>
          </div>
          <div class="grid-2">
            <a href="prod_track.php">
              <div class="data-icon" style="color: #ED303C;">&#xf135;</div>
              <div class="data-info">
               <?php $prtrakqry=mysql_query("select sum(count) from product_track where cid='".$cid."'");
			  $prtrak=mysql_fetch_row($prtrakqry);
			  	echo "<h4>".$prtrak[0]."</h4>";
				if($prtrak[0]=="")
				echo "<h4>0</h4>";
			  ?>
                <h5>Product Views</h5>
              </div>
            </a>
          </div> -->
          <div class="grid-2">
            <a href="order.php">
              <div class="data-icon" style="color: #95CFB7;">&#xf07a;</div>
              <div class="data-info">
<?php $qryshow=mysql_query("SELECT count(id) FROM `order_details` where mrc_id='".$_SESSION["id"]."'"); 


$fetchshow=mysql_fetch_array($qryshow);
?>
                <h4><?php echo $fetchshow[0];?></h4>
                <h5>My Orders</h5>
              </div>
            </a>
          </div>
         <!-- <div class="grid-2">
            <a href="report.php">
              <div class="data-icon" style="color: #00A8C6;">&#xf0f6;</div>
              <div class="data-info">
                <h4> Reports</h4>
               <h5>View ADS</h5>
              </div>
            </a>
          </div>
          <div class="grid-4 custom-contents-top">
            <a class="lightbox-block" href="media/lightbox/img1.jpg" data-lightbox="image2" title="Some Statistics">
              <img src="media/lightbox/thumb-3.png" alt="thumb3" width="352" height="56">
            </a>
          </div>-->
        </div><!-- Title & Sitemap -->
