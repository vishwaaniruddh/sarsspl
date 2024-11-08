<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']) && isset($_SESSION['SESS_USER_NAME']))
{	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Allmart</title>
<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
<!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
<!-- Customizable CSS -->
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/blue.css">
<link rel="shortcut icon" href="/assets/logo-original.png" type="image/png" />

<script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

 <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js" integrity="sha512-XKa9Hemdy1Ui3KSGgJdgMyYlUg1gM+QhL6cnlyTe2qzMCYm4nAZ1PsVerQzTTXzonUR+dmswHqgJPuwCq1MaAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!--
[if IE]>
<link rel="stylesheet" media="all" type="text/css" href="css/pro_dropline_ie.css" />
<![endif]
-->

<!--  jquery core -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<!-- <link href="../datepc/dcalendar.picker.css" rel="stylesheet" type="text/css"> -->
 
<!--  checkbox styling script -->
<!-- <script src="js/jquery/ui.core.js" type="text/javascript"></script> -->
<!-- <script src="js/jquery/ui.checkbox.js" type="text/javascript"></script> -->
<!-- <script src="js/jquery/jquery.bind.js" type="text/javascript"></script> -->
<!-- <script src="js/jquery-1.js"></script> -->
<script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script> 
<!-- <script src="js/bootstrap.js"></script>  -->
<!-- <script src="js/bootstrap-hover-dropdown.js"></script>  -->

<?php
$permission=$_SESSION['permission'];
$myString = $permission;

$myArray = explode(',', $myString);

foreach($myArray as $my_Array){
    /*echo $my_Array.'<br>'; */
    if($my_Array==1){?>
    <script>$(function(){$("#1").show();$("#hdm1").show();});</script><?php } 
    
     if($my_Array==2) { ?>
    <script>$(function(){$("#2").show();$("#hdm1").show();});</script>
    <?php } 
    
    if($my_Array==3) {?>
    <script>$(function(){ $("#3").show();$("#hdm1").show();});</script><?php } 

     if($my_Array==4) {?>
    <script>$(function(){ $("#4").show();$("#hdm4").show();});</script><?php } 
        
    if($my_Array==5) {?>
    <script>$(function(){ $("#5").show();$("#hds5").show();$("#hdm4").show();});</script> <?php }  

    if($my_Array==6){ ?>
    <script> $(function(){  $("#6").show();$("#hds5").show();$("#hdm4").show(); });</script> <?php } 
  
     if($my_Array==7){ ?>
    <script> $(function(){  $("#7").show();$("#hds5").show();$("#hdm4").show(); });</script><?php } 

     if($my_Array==8){ ?>
    <script> $(function(){  $("#8").show();$("#hds5").show();$("#hdm4").show(); });</script>  <?php } 
   
     if($my_Array==9){ ?>
     
    <script> $(function(){$("#9").show(); $("#hds9").show();$("#hdm4").show(); });</script> <?php } 
   
     if($my_Array==10){ ?>
    <script>$(function(){  $("#10").show(); $("#hds9").show();$("#hdm4").show(); });</script><?php }
    
     if($my_Array==11){ ?>
    <script> $(function(){  $("#11").show(); $("#hdm11").show(); });</script><?php }
    
     if($my_Array==12){ ?>
    <script> $(function(){  $("#12").show();$("#hdm12").show(); });</script><?php } 
    
    if($my_Array==13){ ?>
    <script> $(function(){  $("#13").show();$("#hds13").show();$("#hdm13").show();});</script><?php } 
    
    if($my_Array==14){ ?>
    <script> $(function(){  $("#14").show(); $("#hds13").show();$("#hds14").show(); });</script><?php } 
    
    if($my_Array==15){ ?>
    <script> $(function(){$("#15").show(); $("#hds15").show();$("#hds15").show(); });</script><?php }
    
    if($my_Array==16){ ?>
    <script> $(function(){$("#16").show(); $("#hds15").show();$("#hds16").show(); });</script><?php } 
 
    if($my_Array==17){ ?>
    <script> $(function(){  $("#17").show();$("#hdm17").show(); });</script><?php }

    if($my_Array==18){ ?>
    <script> $(function(){  $("#18").show();$("#hdm17").show(); });</script><?php } 

    if($my_Array==19){ ?>
    <script> $(function(){  $("#19").show();$("#hdm19").show(); });</script> <?php } 
    if($my_Array==21){ ?>
    <script> $(function(){  $("#21").show();$("#hdm19").show(); });</script> <?php } 

    if($my_Array==20){ ?>
    <script> $(function(){  $("#20").show();$("#hdm20").show(); });</script><?php } 
  
    if($my_Array==22){ ?>
    <script> $(function(){  $("#22").show();$("#hdm20").show(); });</script><?php } 
  
     if($my_Array==23){ ?>
    <script> $(function(){  $("#23").show();$("#hdm20").show(); });</script>
    <?php } 
  
     if($my_Array==24){ ?>
        <script> $(function(){  $("#24").show();$("#hdm17").show(); });</script>
    <?php } 
    
    if($my_Array==25){ ?>
        <script> $(function(){  $("#25").show();$("#hdm17").show(); });</script>
    <?php }
    
    if($my_Array==26){ ?>
        <script> $(function(){  $("#26").show();$("#hdm17").show(); });</script>
    <?php }
    
    if($my_Array==27){ ?>
        <script> $(function(){  $("#27").show();$("#hdm27").show(); });</script>
    <?php } ?>
    <!--Ruchi -->
    <?php if($my_Array==29){ ?>
        <script> $(function(){  $("#29").show();$("#30").show();$("#31").show();$("#hdm4").show(); });</script>
    <?php } ?>
    <?php  } ?>
<!-- <script>
$(function(){
	$('input').checkBox();
	$('#toggle-all').click(function(){
 	$('#toggle-all').toggleClass('toggle-checked');
	$('#mainform input[type=checkbox]').checkBox('toggle');
	return false;
	});
});
</script>  --> 
<!--  styled select box script version 1 -->
<!-- <script src="js/jquery/jquery.selectbox-0.5.js" type="text/javascript"></script> -->
<!-- <script type="text/javascript">
$(document).ready(function() {
	$('.styledselect').selectbox({ inputClass: "selectbox_styled" });
});
</script> -->
<!--  styled select box script version 2 --> 
<!-- <script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script> -->
<!-- <script type="text/javascript">
$(document).ready(function() {
	$('.styledselect_form_1').selectbox({ inputClass: "styledselect_form_1" });
	$('.styledselect_form_2').selectbox({ inputClass: "styledselect_form_2" });
});
</script> -->

<!--  styled select box script version 3 --> 
<!-- <script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.styledselect_pages').selectbox({ inputClass: "styledselect_pages" });
});
</script> -->

<!--  styled file upload script --> 
<!-- <script src="js/jquery/jquery.filestyle.js" type="text/javascript"></script> -->
<!-- <script type="text/javascript" charset="utf-8">
$(function() {
	$("input.file_1").filestyle({ 
	image: "images/forms/upload_file.gif",
	imageheight : 29,
	imagewidth : 78,
	width : 300
	});
});
</script> -->

<!-- Custom jquery scripts -->
<!-- <script src="js/jquery/custom_jquery.js" type="text/javascript"></script> -->
 
<!-- Tooltips -->
<!-- <script src="js/jquery/jquery.tooltip.js" type="text/javascript"></script> -->
<!-- <script src="js/jquery/jquery.dimensions.js" type="text/javascript"></script> -->
<!-- <script type="text/javascript">
$(function() {
	$('a.info-tooltip ').tooltip({
		track: true,
		delay: 0,
		fixPNG: true, 
		showURL: false,
		showBody: " - ",
		top: -35,
		left: 5
	});
});
</script>  -->
<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
<!-- <script src="js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
$(document).pngFix( );
});
</script> -->
</head>
<style>
/* CSS Document */
/*#menu, #menu ul {
	list-style:none;
	padding:0;
	margin-left:-60;
	font-size:12px;
}*/
/*#menu li {
	position:relative;
    text-align:center;
	min-width:114px;
}
#menu li ul {
	position:absolute;
	margin-top:em;
	margin-left:.em; 
	display:none;
	z-index: 999999;
}
#menu ul li ul {
	margin-top:-3em;
	margin-left:10em;
	padding:-10px;
}*/
/* ******************************************************************* */
/* SHOW SUBMENU  1 */
/*#menu li:hover ul, #menu li.over ul {
	display:block;
}
#menu li:hover ul ul, #menu li.over ul ul {
	display:none;
}*/
/* SHOW SUBMENU  2 */
/*#menu ul li:hover ul, #menu ul li.over ul {
	display:block;
}*/
/* ******************************************************************* */
/* STYLING UP THE LINKS */
/*#menu a {
	display:block;
	border-right:1px solid #fff;
	background:;
	color:#fff;
	text-decoration:none;
	padding:10px;
}
#menu a:hover {
	background-color:#;
	color:#fff;
}
#menu ul {
	border-top:1px solid #fff;
}
#menu ul a {
	border-right:none;
	border-right:1px solid #fff;
	border-bottom:1px solid #fff;
	border-left:1px solid #fff;
	background:#AEC245;
}*/

/* ******************************************************************* */

/*#menu {
	z-index:1;
margin-left: -70px;
width: 100%;
}
#menu ul {
	z-index:2;
}
#menu ul ul {
	z-index:3;
}

#logo {
    margin: 16px !important;
}*/

/* ******************************************************************* */

/* Fix IE. Hide from IE Mac \*/
/** html ul li { float: left; height: 1%; }
* html ul li a { height: 1%; }*/
/* End */

<!-- </style> -->
<!--<body onload="perm()"> -->
<body > 
<!-- Start: page-top-outer -->
<div id="page-top-outer">    

<!-- Start: page-top -->
<div id="page-top">
	<!-- start logo -->
	<div id="logo">
	<a href=""><img src="/assets/allmart.png" width="60"  alt="" /></a>
	</div>
 	<div class="clear"></div>
</div>
<!-- End: page-top -->
</div>
<!-- End: page-top-outer -->
<div class="clear">&nbsp;</div>
<!--  start nav-outer-repeat................................................................................................. START -->
<header class="header-style-1"> 
  <!-- ============================================== TOP MENU ============================================== -->
  <!-- ============================================== TOP MENU : END ============================================== -->
  <div class="main-header">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder"> 
          <!-- /.contact-row --> 
          <!-- ============================================================= SEARCH AREA ============================================================= -->
         
          <!-- /.search-area --> 
          <!-- ============================================================= SEARCH AREA : END ============================================================= --> </div>
        <!-- /.top-search-holder -->
        <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row"> 
          <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
          <!-- /.dropdown-cart -->
          <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->
        </div>
        <!-- /.top-cart-row --> 
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.main-header -->
  <!-- ============================================== NAVBAR ============================================== -->
  <div class="header-nav animate-dropdown">
    <div class="container-fluid">
      <div class="yamm navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> 
            <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <div class="nav-bg-class">
          <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
            <div class="nav-outer">
              <ul class="nav navbar-nav" id="menu">
            	<li id="hdm1" style="display:none;"><a href="#" title="Merchant" class="selected">Merchant</a>
            	    <ul>
            			<li id="1" style="display:none;"><a href="Register.php" title="Add Merchant">Add Merchant</a></li>
            			<li id="2" style="display:none;"><a href="admin.php" title="View Merchant">View Merchant</a></li>
            			<li id="3" style="display:none;"><a href="merchant_report.php" title="Merchant Report">Merchant Report</a></li>
            			
            		</ul>	
            	</li>
            	<li id="hdm4" style="display:none;">
            	    <a href="#" title="Admin Products">Admin Products</a>
            	     <ul>
            			<li id="4" style="display:none;"><a href="HomePageImage.php" title="Homepage display Ads">Homepage Display Ads</a></li>
            			<li id="hds5" style="display:none;" ><a href="#" title="Visual Advertisement">Visual Advertisement</a>
            				<ul>
            				    <!--Ruchi 24dec19-->
            				    <li ><a href="set_slot_todate.php" title="Set Rate">Set Rate for Ads</a></li>
            					<li id="5" style="display:none;"><a href="upload_ads_videos.php" title="Upload Ads">Upload Ads</a></li>
            					<li id="6" style="display:none;"><a href="adsapprovaldetails.php" title="View Ads">View Ads</a></li>
            					<li id="7" style="display:none;"><a href="adsbookingslotdetails.php" title="ads slot booking">ads slot booking</a></li>
            					<li id="8" style="display:none;"><a href="set_ads_todatemn.php" title="set todays date for ads">set todays date for ads</a></li>
            				</ul>
            			</li> 
            			<li id="hds9" style="display:none;"><a href="#" title="Reports"> Reports </a>
            				<ul>
            					<li id="9" style="display:none;"><a href="product_uplod_admin.php" title="products uploaded">products uploaded</a></li>
            					<li id="10" style="display:none;"><a href="HomepageDisplayAdsReport.php" title="Homepage Display Ads">Homepage Display Ads </a></li>
            				</ul>
            			</li>
						<li ><a href="featured_products.php" title="Featured Product">Featured Product</a></li>
						<li ><a href="best_selling_product.php" title="Best Selling Product">Best Selling Product</a></li>
                        <li ><a href="related_products.php" title="Related Products">Related Products</a></li>
            			<li >
            			   <a href="#" title="Offers">Offers</a>
    					    <ul>
            					<li ><a href="view_offers.php" title="Merchant's Offers">Merchant's Offers</a></li>
            					<li ><a href="add_offers.php" title="Merchant's Offers">Add Merchant's Offers</a></li>
            					<li ><a href="#" title="User Offers">User Offers </a></li>
            				</ul>
        				</li>
    					<li>
    					    <a href="#" title="subscriptions">Subscriptions</a>
    					    <ul>
            					<li ><a href="view_subscriptions.php" title="subscriptions">View Subscriptions</a></li>
            					<li ><a href="add_subscription.php" title="Homepage Display Ads">Add Subscriptions </a></li>
            				</ul>
    					</li>
            		</ul>
            		
            	</li>
            	<li id="hdm11" style="display:none;"><a href="#" title="Merchant proct">Merchant Products</a>
            		<ul>
            			<li id="11" style="display:none;"><a href="productapproval.php" title="Products Approval">Products Approval</a></li>
            		    <li><a href="resale_productapproval.php" title="Resale Products Approval">Resale Products Approval</a></li>
            		    <li ><a href="product_sold.php" title="Product Report">All Product Report</a></li>
                        <li ><a href="productlist.php" title="Product Report">Edit Product Min And max Qty</a></li>
            		
            		<!--	<li><a href="#" title="Homepage display Ads">Homepage display Ads</a></li>
            			<li><a href="#" title="Visual Advertisement uploaded">Visual Advertisement uploaded</a></li>-->
            		</ul>
            	</li> 
                <!-- Ruchi : 
                <li id="hdm12" style="display:none;"><a href="#" title="Parameters">Parameters</a>
                 	<ul>
                        <li id="12" style="display:none;"><a href="set_slot_todate.php" title="Add Cities">Rate per second </a></li>
            		</ul>
    	        </li>-->
        		<li id="hdm13" style="display:none; " ><a href="#" title="Area" >Area</a>
        		    <ul>
                        <li id="hds13" style="display:none;width:120px"><a href="#" title="Cities">Cities</a>
                            <ul>
                                <li id="13" style="display:none;"><a href="AddCity.php" title="Add Cities">Add Cities</a></li>
                				<li id="14" style="display:none;"><a href="cities.php" title="View Cities">View Cities</a></li>
                		    </ul>
                        </li>
    					<li id="hds15" style="display:none;"><a href="#" title="Areas">Areas</a>
        					<ul>
                                <li id="15" style="display:none;"><a href="addArea.php" title="Add Areas">Add Areas</a></li>
            					<li id="16"style="display:none;"><a href="location.php" title="View Areas">View Areas</a></li>
        				    </ul>
    					</li>
        			</ul>
        		</li>
    			<li id="hdm17" style="display:none;"><a href="#" title="Category">Category</a>
    			     <ul>
                        <li id="17" style="display:none;"><a href="cattrtest.php" title="Add Category">Add Category</a></li>
    					<li id="18" style="display:none;"><a href="sub_cat.php" title="View Category">View Category</a></li>
    				    <li id="24" style="display:none;"><a href="category_Approval.php" title="Approve Category">Approve Category</a></li>
    				    <!--Ruchi-->
    				    <li id="25" style="display:none;"><a href="add_resaleCategory.php" title="Add Category">Add Resale Category</a></li>
    					<li id="26" style="display:none;"><a href="view_resaleCategory.php" title="View Category">View Resale Category</a></li>
    				</ul>
    			</li>
    			<!-- Ruchi -->
    			<li id="hdm27" style="display:none;"><a href="#" title="Category">Brand</a>
    			     <ul>
                        <li id="27" style="display:none;"><a href="add_brand.php" title="Add Brand">Add Brand</a></li>
    					<li id="28" style="display:none;"><a href="view_brand.php" title="View Brand">View Category</a></li>
    				</ul>
    			</li>
        		<li id="hdm19" style="display:none;">
        		    <a href="#" title="Orders">Orders</a>
        		   <ul>
        		     <li id="19" style="display:none;"><a href="Order.php" title="Products Approval">Order Details</a></li>
                     <li id="19" ><a href="/adminpanel/AddOrderByAdmin.php" title="Add Orders">Add Orders</a></li>
                    <!--<li id="21" style="display:none;"><a href="merchantOrderReport.php" title="Products Approval">Order Report</a></li>-->
                    <li id="21" style="display:none;"><a href="onlymerchant.php" title="Order Report">Order Report</a></li>
                    <li ><a href="bill.php" title="Billing Report">Billing Report</a></li>
            	   </ul>
        		</li>
        		<li id="hdm20" style="display:none;">
        		    <a href="#" title="Orders">Sub Admin</a>
            		<ul>
            			<li id="20" style="display:none;"><a href="Add_Subadmin.php" title="Add Subadmin">Add Subadmin</a></li>
            			<li id="22" style="display:none;"><a href="subAdminWorkDetails.php" title="Work Details">Work Details</a></li>
            			<li id="23" style="display:none;"><a href="roll.php" title="Role Creation">Role Creation</a></li>
                	</ul>
        		</li>
                <li class="dropdown  navbar-right special-menu" style="margin-right: -75px;width: 185px;"> <a href="changePaasword.php" style="margin-left: -40px;">Change Password</a> </li>
                <li class="dropdown  navbar-right specrial-menu" style="margin-right: -250px;"> <a href="logout.php">LogOut</a> </li>
            </ul>
            <!-- /.navbar-nav -->
            <div class="clearfix"></div>
            </div>
            <!-- /.nav-outer --> 
          </div>
          <!-- /.navbar-collapse -->
        </div>
        <!-- /.nav-bg-class --> 
      </div>
      <!-- /.navbar-default --> 
    </div>
    <!-- /.container-class -->
  </div>
  <!-- /.header-nav --> 
  <!-- ============================================== NAVBAR : END ============================================== -->
</header>

