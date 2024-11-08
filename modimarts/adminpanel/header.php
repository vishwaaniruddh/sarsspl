<?php
session_start();
if (isset($_SESSION['SESS_USER_NAME']) && isset($_SESSION['SESS_USER_NAME'])) {

    ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Allmart</title>
<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
<link rel="stylesheet" href="css/bootstrap.css">
<!-- Customizable CSS -->
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/blue.css">
<link rel="shortcut icon" href="/assets/logo-original.png" type="image/png" />
<!--
[if IE]>
<link rel="stylesheet" media="all" type="text/css" href="css/pro_dropline_ie.css" />
<![endif]
-->

<!--  jquery core -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="../datepc/dcalendar.picker.css" rel="stylesheet" type="text/css">

<!--  checkbox styling script -->
<script src="js/jquery/ui.core.js" type="text/javascript"></script>
<script src="js/jquery/ui.checkbox.js" type="text/javascript"></script>
<script src="js/jquery/jquery.bind.js" type="text/javascript"></script>
<!-- <script src="js/jquery-1.js"></script> -->
<script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap-hover-dropdown.js"></script>

<?php
$permission = $_SESSION['permission'];
    $myString   = $permission;

    $myArray = explode(',', $myString);

    foreach ($myArray as $my_Array) {
     ?>
      <script> $(function(){  $("#<?=$my_Array?>").show(); });</script>
      <script> $(function(){  $("#<?=$my_Array?>").css('display', 'block');; });</script>
      <script> $(function(){  $("#hdm<?=$my_Array?>").show(); });</script>

    <?php }?>
<script>
$(function(){
  $('input').checkBox();
  $('#toggle-all').click(function(){
  $('#toggle-all').toggleClass('toggle-checked');
  $('#mainform input[type=checkbox]').checkBox('toggle');
  return false;
  });
});
</script>
<![if !IE 7]>
<!--  styled select box script version 1 -->
<script src="js/jquery/jquery.selectbox-0.5.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('.styledselect').selectbox({ inputClass: "selectbox_styled" });
});
</script>
<![endif]>
<!--  styled select box script version 2 -->
<script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('.styledselect_form_1').selectbox({ inputClass: "styledselect_form_1" });
  $('.styledselect_form_2').selectbox({ inputClass: "styledselect_form_2" });
});
</script>

<!--  styled select box script version 3 -->
<script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('.styledselect_pages').selectbox({ inputClass: "styledselect_pages" });
});
</script>

<!--  styled file upload script -->
<script src="js/jquery/jquery.filestyle.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
$(function() {
  $("input.file_1").filestyle({
  image: "images/forms/upload_file.gif",
  imageheight : 29,
  imagewidth : 78,
  width : 300
  });
});
</script>

<!-- Custom jquery scripts -->
<script src="js/jquery/custom_jquery.js" type="text/javascript"></script>

<!-- Tooltips -->
<script src="js/jquery/jquery.tooltip.js" type="text/javascript"></script>
<script src="js/jquery/jquery.dimensions.js" type="text/javascript"></script>
<script type="text/javascript">
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
</script>
<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
<script src="js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
$(document).pngFix( );
});
</script>
</head>
<style>
/* CSS Document */
#menu, #menu ul {
  list-style:none;
  padding:0;
  margin-left:-60;
  font-size:12px;
}
#menu li {
  position:relative;
    text-align:center;
  min-width:114px;
}
#menu li ul {
  position:absolute;
  margin-top:em;
  margin-left:.em; /* for IE */
  display:none;
  z-index: 999999;
}
#menu ul li ul {
  margin-top:-3em;
  margin-left:10em;
  padding:-10px;
}
/* ******************************************************************* */
/* SHOW SUBMENU  1 */
#menu li:hover ul, #menu li.over ul {
  display:block;
}
#menu li:hover ul ul, #menu li.over ul ul {
  display:none;
}
/* SHOW SUBMENU  2 */
#menu ul li:hover ul, #menu ul li.over ul {
  display:block;
}
/* ******************************************************************* */
/* STYLING UP THE LINKS */
#menu a {
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
}

/* ******************************************************************* */

#menu {
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
}

/* ******************************************************************* */

/* Fix IE. Hide from IE Mac \*/
* html ul li { float: left; height: 1%; }
* html ul li a { height: 1%; }
/* End */

</style>
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
                      <li ><a href="set_slot_todate.php" title="Set Rate">Set Rate for Ads</a></li>
                      <li id="5" style="display:none;"><a href="upload_ads_videos.php" title="Upload Ads">Upload Ads</a></li>
                      <li id="6" style="display:none;"><a href="adsapprovaldetails.php" title="View Ads">View Ads</a></li>
                      <li id="7" style="display:none;"><a href="adsbookingslotdetails.php" title="ads slot booking">ads slot booking</a></li>
                      <li id="8" style="display:none;"><a href="set_ads_todatemn.php" title="set todays date for ads">set todays date for ads</a></li>
                    </ul>
                  </li>
                  <li id="hds9" ><a href="#" title="Reports"> Reports </a>
                    <ul>
                      <li id="9" style="display:none;"><a href="product_uplod_admin.php" title="products uploaded">products uploaded</a></li>
                      <li id="10" style="display:none;"><a href="HomepageDisplayAdsReport.php" title="Homepage Display Ads">Homepage Display Ads </a></li>
                    </ul>
                  </li>
                        <li  id="11"  style="display:none;" ><a href="featured_products.php" title="Featured Product">Featured Product</a></li>
                        <li  id="12"  style="display:none;"><a href="best_selling_product.php" title="Best Selling Product">Best Selling Product</a></li>
                        <li  id="13"style="display:none;"><a href="related_products.php" title="Related Products">Related Products</a></li>
                  <li >
                     <a href="#" title="Offers">Offers</a>
                      <ul>
                          <li id="14" style="display:none;"><a href="view_offers.php" title="Merchant's Offers">Merchant's Offers</a></li>
                          <li id="15" style="display:none;"><a href="add_offers.php" title="Merchant's Offers">Add Merchant's Offers</a></li>
                          <li id="16" style="display:none;"><a href="#" title="User Offers">User Offers </a></li>
                      </ul>
                </li>
              <li>
                  <a href="#" title="subscriptions">Subscriptions</a>
                  <ul>
                      <li id="17" style="display:none;"><a href="view_subscriptions.php" title="subscriptions">View Subscriptions</a></li>
                      <li id="18"style="display:none;"><a href="add_subscription.php" title="Homepage Display Ads">Add Subscriptions </a></li>
                    </ul>
              </li>
                </ul>

              </li>
              <li id="hdm11" ><a href="#" title="Merchant proct">Merchant Products</a>
                <ul>
                    <li id="19" style="display:none;"><a href="productapproval.php" title="Products Approval">Products Approval</a></li>
                    <li id="20" style="display:none;"><a href="resale_productapproval.php" title="Resale Products Approval">Resale Products Approval</a></li>
                    <li id="21" style="display:none;" ><a href="product_sold.php" title="Product Report">All Product Report</a></li>
                    <li id="22" style="display:none;" ><a href="productlist.php" title="Product Report">Edit Product Min And max Qty</a></li>
                    <li id="23" style="display:none;" ><a href="SetcourierData.php" title="Product Report">Set Courier Charge</a></li>
                    <li id="24" style="display:none;" ><a href="tadkaProduct.php" title="Product Report">Tadka Products</a></li>
                    <li id='25' style="display:none;"><a href="HomepageAds.php" title="Homepage display Ads">Homepage display Ads</a></li>

                </ul>
              </li>

            <li id="hdm13"  >
                <a href="#" title="Area" >Area</a>
                <ul>
                    <li id="hds13" style="display:none;width:120px"><a href="#" title="Cities">Cities</a>
                     <ul>
                        <li id="26" style="display:none;"><a href="AddCity.php" title="Add Cities">Add Cities</a></li>
                        <li id="27" style="display:none;"><a href="cities.php" title="View Cities">View Cities</a></li>
                     </ul>
                    </li>
                   <li id="hds15" ><a href="#" title="Areas">Areas</a>
                  <ul>
                    <li id="28" style="display:none;"><a href="addArea.php" title="Add Areas">Add Areas</a></li>
                    <li id="29" style="display:none;"><a href="location.php" title="View Areas">View Areas</a></li>
                 </ul>
              </li>
              </ul>
            </li>
          <li id="hdm17" ><a href="#" title="Category">Category</a>
               <ul>
                <li id="30" style="display:none;"><a href="cattrtest.php" title="Add Category">Add Category</a></li>
                <li id="31" style="display:none;"><a href="sub_cat.php" title="View Category">View Category</a></li>
                <li id="32" style="display:none;"><a href="category_Approval.php" title="Approve Category">Approve Category</a></li>
                <li id="33" style="display:none;"><a href="add_resaleCategory.php" title="Add Category">Add Resale Category</a></li>
                <li id="34" style="display:none;"><a href="view_resaleCategory.php" title="View Category">View Resale Category</a></li>
            </ul>
          </li>
          
          <li id="hdm27" ><a href="#" title="Category">Brand</a>
               <ul>
              <li id="35" style="display:none;"><a href="add_brand.php" title="Add Brand">Add Brand</a></li>
              <li id="36" style="display:none;"><a href="view_brand.php" title="View Brand">View Category</a></li>
            </ul>
          </li>
            <li id="hdm19">
                <a href="#" title="Orders">Orders</a>
               <ul>
                    <li id="50" style="display:none;"><a href="Order.php" title="Products Approval">Order Details</a></li>
                    <li id="37" style="display:none;" ><a href="/adminpanel/AddOrderByAdmin.php" title="Add Orders">Add Orders</a></li>
                    <li id="38" style="display:none;"><a href="onlymerchant.php" title="Order Report">Order Report</a></li>
                    <li id="39" style="display:none;"><a href="bill.php" title="Billing Report">Billing Report</a></li>
                    <li id="40" style="display:none;"><a href="deletedorder.php" title="Billing Report">Deleted Order</a></li>
                    <li id="41" style="display:none;"><a href="Manage_Proformainvoice.php" title="Test Order">Proforma Order</a></li>
                 </ul>
            </li>
            <li id="hdm20" >
                <a href="#" title="Orders">Sub Admin</a>
                <ul>
                  <li id="42" style="display:none;"><a href="Add_Subadmin.php" title="Add Subadmin">Add Subadmin</a></li>
                  <li id="43" style="display:none;"><a href="subAdminWorkDetails.php" title="Work Details">Work Details</a></li>
                  <li id="44" style="display:none;"><a href="roll.php" title="Role Creation">Role Creation</a></li>
                  </ul>
            </li>
            <li id="hdm32"  >
                <a href="#" title="Orders">Others</a>
                <ul>
                  <li id="45" style="display:none;"><a href="ManagePress.php" title="Manage Media">Manage Media</a></li>
                  <li id="46" style="display:none;"><a href="ManageReview.php" title="Work Details">Manage Review</a></li>
                  <li id="47" style="display:none;"><a href="getcommissionnew.php" title="Commission Distribution">Commission Distribution</a></li>
                  <li id="48" style="display:none;"><a href="NEFTDetails1.php" title="Commission Deatils">Commission Details</a></li>
                  <li id="49" style="display:none;"><a href="commission_ledger.php" title="Commission Deatils">Commission Ledger</a></li>
                  </ul>
            </li>
                <li  class="dropdown  navbar-right special-menu" style="margin-right: -75px;width: 185px;"> <a href="changePaasword.php" style="margin-left: -40px;">Change Password</a> </li>
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
<div class="clear"></div>
<!--  start nav-outer -->
</div>
<!--  start nav-outer-repeat................................................... END -->
 <div class="clear"></div>
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">
<div class="clear">&nbsp;</div>
</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer -->
<div class="clear">&nbsp;</div>
</body>
</html>
<?php
}
?>