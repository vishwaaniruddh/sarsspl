<?php session_start(); ?>
<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="ltr" lang="en" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="ltr" lang="en" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="ltr" class="ltr" lang="en">
    <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Forgot Your Password?</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
        
                    	    	<link href="http://sarmicrosystems.in/oc1/image/catalog/cart.png" rel="icon" />
    	                <link href="catalog/view/theme/pav_bigstore/stylesheet/bootstrap.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/stylesheet.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/paneltool.css" rel="stylesheet" />
                <link href="catalog/view/javascript/jquery/colorpicker/css/colorpicker.css" rel="stylesheet" />
                <link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/animate.css" rel="stylesheet" />
                <link href="catalog/view/javascript/jquery/magnific/magnific-popup.css" rel="stylesheet" />
                <link href="catalog/view/javascript/jquery/owl-carousel/owl.carousel.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/fonts.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/pavnewsletter.css" rel="stylesheet" />
                        <script type="text/javascript" src="catalog/view/javascript/jquery/jquery-2.1.1.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/bootstrap/js/bootstrap.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/common.js"></script>
                <script type="text/javascript" src="catalog/view/theme/pav_bigstore/javascript/common.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/pavdeals/countdown.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/colorpicker/js/colorpicker.js"></script>
        
    <!-- FONT -->

        <!-- FONT -->


      </head>
  <body class="account-forgotten page-account-forgotten layout-fullwidth">
    <div class="row-offcanvas row-offcanvas-left">
      <div id="page">
        <!-- header -->
        
<header id="header-layout" class="header-v2">
    <div id="topbar" class="topbar-v1">
  <div class="container">
  <div class="login pull-left hidden-xs hidden-sm">
   
  </div>
  <!-- Show Mobile -->          
      <div class="show-mobile hidden-lg hidden-md pull-right">     
        <div class="quick-user pull-left">
          <div class="quickaccess-toggle">
            <i class="fa fa-user"></i> <i class="fa fa-angle-down"></i>
          </div>  
          <div class="inner-toggle">
            <div class="login links">
                              <ul>
                  <li><a href="http://sarmicrosystems.in/oc/index.php?route=account/register">Register</a></li>
                  <li><a href="http://sarmicrosystems.in/oc/index.php?route=account/login">Login</a></li>
                </ul>
                 
            </div>
          </div>            
        </div>
      </div>
    <!-- End -->
  <div class="current-lang pull-right">
    <div class="btn-group box-language">
            </div>
    <!-- currency -->
    <div class="btn-group box-currency">
        <div class="pull-left">
        <form action="http://sarmicrosystems.in/oc/index.php?route=common/currency/currency" method="post" enctype="multipart/form-data" id="form-currency">
  <div class="btn-group dropdown">
    <button class="btn-link dropdown-toggle" data-toggle="dropdown">
                            <strong>$</strong>
            <span class="hidden-xs hidden-sm hidden-md">Currency</span> <i class="fa fa-angle-down"></i></button>
    <ul class="dropdown-menu">
                  <li><button class="currency-select btn-link btn-block" type="button" name="EUR">€ Euro</button></li>
                        <li><button class="currency-select btn-link btn-block" type="button" name="GBP">£ Pound Sterling</button></li>
                        <li><button class="currency-select btn-link btn-block" type="button" name="USD">$ US Dollar</button></li>
                </ul>
  </div>
  <input type="hidden" name="code" value="" />
  <input type="hidden" name="redirect" value="http://sarmicrosystems.in/oc/index.php?route=account/forgotten" />
</form>
</div>
    </div>
    <div class="btn-group box-setting">        
        <div class="btn-group dropdown">
            <button type="button" class="btn-link dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-cog"></i>
              <span class="text-label hidden-xs hidden-sm hidden-md">Setting</span> 
              <i class="fa fa-angle-down"></i>                  
            </button>
            <ul class="dropdown-menu">
              <li><a class="" href="http://sarmicrosystems.in/oc/index.php?route=account/account"><i class="fa fa-user"></i>My Account</a></li>
              <li><a class="wishlist" href="http://sarmicrosystems.in/oc/index.php?route=account/wishlist"><i class="fa fa-list-alt"></i> <span id="wishlist-total">Wish List (0)</span></a></li>
              <li><a class="shoppingcart" href="http://sarmicrosystems.in/oc/index.php?route=checkout/cart"><i class="fa fa-bookmark"></i>Shopping Cart</a></li>
              <li><a class="last" href="http://sarmicrosystems.in/oc/index.php?route=checkout/checkout"><i class="fa fa-share"></i>Checkout</a></li>
            </ul>
        </div>
    </div>
  </div>
</div>
</div>    <div id="header-main">
        <div class="container">
            <div class="row">
                <div class="logo inner col-lg-3 col-md-2 col-sm-3 col-xs-12">
                                            <div id="logo-theme" class="logo-store">
                            <a href="http://sarmicrosystems.in/oc/index.php?route=common/home">
                                <span>Your Store</span>
                            </a>
                        </div>
                                    </div>
                <div id="search" class="col-lg-4 col-md-4 col-sm-5 col-xs-8">
                    <div class="quick-access">
                        <div class="input-group">  
  <input type="text" name="search" value="" placeholder="Search" class="form-control radius-x" />
  <div class="input-group-btn">
    <button type="button" class="btn btn-default btn-lg radius-x"><i class="fa fa-search"></i></button>
  </div>
</div>                    </div>
                </div>
                <div class="inner col-lg-4 col-md-5 col-sm-4 col-xs-4 col-lg-offset-1 col-md-offset-1">
                    <div class="call-top hidden-sm hidden-xs pull-left">
                        <strong class="fa fa-phone"></strong> <span><b>Call us now</b> <br> Toll free :<span> 0123-456-789</span></span>                    </div>
                    <div id="cart-top" class="cart-top pull-right">
                        <div id="cart" class="clearfix">
    <div data-toggle="dropdown" data-loading-text="Loading..." class="heading media dropdown-toggle">
      <div class="pull-left">
        <i class="icon-cart fa fa-shopping-cart"></i>
      </div>
      <div class="cart-inner media-body">
        <b class="text-cart">My cart</b>
        <p>
          <span id="cart-total" class="cart-total">0 item(s) - $0.00</span>
          <i class="fa fa-angle-down"></i>
        </p>
      </div>
    </div>
    <ul class="dropdown-menu content">
            <li>
        <p class="text-center">Your shopping cart is empty!</p>
      </li>
          </ul>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="header-bot" class="hidden-xs hidden-sm">
        <div class="container">
            <div class="container-inner">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                        <div id="pav-mainnav" class="hidden-xs hidden-sm">
                            <nav id="pav-megamenu" class="navbar">
	<div class="navbar-header">
	  <button data-toggle="offcanvas" class="btn btn-primary canvas-menu hidden-lg hidden-md" type="button"><span class="fa fa-bars"></span> Menu</button>
	</div>
                                            <div class="col-lg-3 col-sm-3 col-md-3 hidden-xs hidden-sm">
                            <div class="top-verticalmenu hidden-xs hidden-sm">
	<div class="menu-heading d-heading">
	<h4>
	  <span class="fa fa-bars pull-left"></span>
	  categories              
	</h4>
	</div> 
	<div id="pav-verticalmenu"> 
	<div class="menu-content d-content">
	  	<div class="pav-verticalmenu fix-top">
		<div class="navbar navbar-verticalmenu">
			<div class="verticalmenu" role="navigation">
				<div class="navbar-header">
				<a href="javascript:;" data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle">
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			    </a>
				<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav verticalmenu"><li class="topdropdow parent dropdown " >
					<a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=24" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-mobile-phone"></i><span class="menu-title">Electronics</span><span class="menu-desc">Quisque ac neque et augue
bibendum</span><b class="caret"></b></a><div class="dropdown-menu"  style="width:300px" ><div class="dropdown-menu-inner"><div class="row"><div class="mega-col col-md-12 sidebar" > <div class="mega-col-inner"><div class="pavo-widget"><div class="pavo-widget"><h4 class="widget-heading">Products Latest</h4>
<div class="widget-content ">
	<div class="widget-inner list products-row">
				<div class="w-product product-col clearfix col-lg-4 col-md-4 col-sm-12 col-xs-12">
			
<div class="product-block">

          
      <div class="image">
        
        <div class="product-img img">
          <a class="img" title="HP LP3065" href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=47">
            <img class="img-responsive" src="http://sarmicrosystems.in/oc/image/cache/catalog/demo/hp_1-100x100.jpg" title="HP LP3065" alt="HP LP3065" />
          </a>          
          <div class="compare hover-icon">     
              <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Compare this Product" onclick="compare.add('47');"><i class="fa fa-exchange"></i></button>
                            <div class="quickview hidden-xs hidden-sm">
              <a class="iframe-link btn btn-default" data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/index.php?route=themecontrol/product&amp;product_id=47"  title="Quick View" ><i class="fa fa-arrows-alt"></i></a>
              </div>
               
          </div>  
          <div class="wishlist hover-icon">
            <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Add to Wish List" onclick="wishlist.add('47');"><i class="fa fa-heart"></i></button>
            <div class="zoom hidden-xs hidden-sm">
                          <a data-toggle="tooltip" data-placement="top" href="http://sarmicrosystems.in/oc/image/catalog/demo/hp_1.jpg" class="product-zoom btn btn-default info-view colorbox cboxElement" title="HP LP3065"><i class="fa fa-search-plus"></i></a>
                        </div> 
          </div>           
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="http://sarmicrosystems.in/oc/index.php?route=product/product&amp;product_id=47">HP LP3065</a></h6>
         
        <p class="description">
	Stop your co-workers in their tracks with the stunning new 30-inch diagonal HP LP3065 Flat Panel .....</p>
        
                <div class="price">
                      <span class="price-new">$100.00</span>
             
                              </div>
          
            
                <div class="action">
                      <div class="cart">            
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="cart.add('47');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Add to Cart</span>
              </button>
            </div>
                  </div>     
  </div>  
</div>





   
		</div>
			</div>
</div>
</div></div></div></div></div></div></div></li><li class="bg1 parent dropdown " >
					<a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=46" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gift"></i><span class="menu-title">Accessories</span><span class="menu-desc">Quisque ac neque et augue
auctor aliquet</span><b class="caret"></b></a><div class="dropdown-menu"  style="width:500px" ><div class="dropdown-menu-inner"><div class="row"><div class="mega-col col-md-6 " > <div class="mega-col-inner"><div class="pavo-widget"></div><div class="pavo-widget"></div><div class="pavo-widget"><div class="pavo-widget"><h4 class="widget-heading title">Automative</h4>

</div></div></div></div><div class="mega-col col-md-5 " > <div class="mega-col-inner"><div class="pavo-widget"><div class="pavo-widget">
<div class="widget-html    ">
        <h4 class="widget-heading title">
        Makes a photoshop    </h4>
    	<div class="widget-inner -content clearfix">
		 <div class="content ">    <p>Lorem ipsum dolor sit amet consectetuer adipiscing eli Aenean commodo ligula bus et magnis dis parturient eu pretium quis sem.</p><p>Lorem ipsum dolor sit amet consectetuer adipiscing eli Aenean commodo ligula.</p></div>	</div>
</div>
</div></div></div></div></div></div></div></li><li class="bg1 topdropdow parent dropdown " >
					<a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=45" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-clock-o"></i><span class="menu-title">Home &amp; Garden</span><span class="menu-desc">Quisque ac neque et augue
bendum</span><b class="caret"></b></a><div class="dropdown-menu"  style="width:700px" ><div class="dropdown-menu-inner"><div class="row"><div class="mega-col col-md-6 " > <div class="mega-col-inner"><div class="pavo-widget"><div class="pavo-widget"><h4 class="widget-heading title">Electronics</h4>

</div></div></div></div><div class="mega-col col-md-6 " > <div class="mega-col-inner"><div class="pavo-widget"><div class="pavo-widget"><h4 class="widget-heading title">Cloth</h4>

		</div>
	</div>
	</div>
	</div>
</div>                        </div>
                                     </div>
            </div>
        </div>
    </div>
</header> 
        <!-- /header -->
        <div class="bottom-offcanvas visible-xs visible-sm space-10 space-top-10">
            <div class="container">
                <button data-toggle="offcanvas" class="btn btn-primary" type="button"><i class="fa fa-bars"></i></button>
            </div>
        </div>
        <!-- sys-notification -->
        <div id="sys-notification">
          <div class="container">
            <div id="notification"></div>
          </div>
        </div>
        <!-- /sys-notification -->
                        <div class="container">
 
    <div class="row">                <div id="content" class="col-sm-9">      <h1>Forgot Your Password?</h1>
      <p>Enter the e-mail address associated with your account. Click submit to have a password e-mailed to you.</p>
      <form action="forgotpass.php" method="post" enctype="multipart/form-data" class="form-horizontal">
        <fieldset>
          <legend>Your E-Mail Address</legend>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-email">E-Mail Address</label>
            <div class="col-sm-10">
              <input type="text" name="email" value="" placeholder="E-Mail Address" id="input-email" class="form-control" required/>
            </div>
          </div>
        </fieldset>
        <div class="buttons clearfix">
          <div class="pull-left"><a href="" class="btn btn-default">Back</a></div>
          <div class="pull-right">
            <input type="submit" value="Continue" class="btn btn-primary" />
          </div>
        </div>
      </form>
      </div>
    <div id="column-right" class="col-lg-3 col-md-3 col-sm-12 sidebar col-xs-12">
    <!--<div class="list-group">
    <a href="http://sarmicrosystems.in/oc/index.php?route=account/login" class="list-group-item">Login</a> <a href="http://sarmicrosystems.in/oc/index.php?route=account/register" class="list-group-item">Register</a> <a href="http://sarmicrosystems.in/oc/index.php?route=account/forgotten" class="list-group-item">Forgotten Password</a>
    <a href="http://sarmicrosystems.in/oc/index.php?route=account/account" class="list-group-item">My Account</a>
    <a href="http://sarmicrosystems.in/oc/index.php?route=account/address" class="list-group-item">Address Book</a> <a href="http://sarmicrosystems.in/oc/index.php?route=account/wishlist" class="list-group-item">Wish List</a> <a href="http://sarmicrosystems.in/oc/index.php?route=account/order" class="list-group-item">Order History</a> <a href="http://sarmicrosystems.in/oc/index.php?route=account/download" class="list-group-item">Downloads</a><a href="http://sarmicrosystems.in/oc/index.php?route=account/recurring" class="list-group-item">Recurring payments</a> <a href="http://sarmicrosystems.in/oc/index.php?route=account/reward" class="list-group-item">Reward Points</a> <a href="http://sarmicrosystems.in/oc/index.php?route=account/return" class="list-group-item">Returns</a> <a href="http://sarmicrosystems.in/oc/index.php?route=account/transaction" class="list-group-item">Transactions</a> <a href="http://sarmicrosystems.in/oc/index.php?route=account/newsletter" class="list-group-item">Newsletter</a>
  </div>-->
  </div>
</div>
</div>

<!--
  $ospans: allow overrides width of columns base on thiers indexs. format array( column-index=>span number ), example array( 1=> 3 )[value from 1->12]
 -->



 
<footer id="footer" class="nostylingboxs">
 
  

  <div class="footer-center " id="pavo-footer-center">
  <div class="container">
      <div class="row">
        <div class="column col-xs-12 col-sm-6 col-md-3 col-lg-3">
          <div class="media">  				<div class="logo-about">  		
				<!--<h2>Merabazaar</h2>------>	<img alt="icon" src="image/catalog/logo.png"> 	</div>    				<div class="media-body">  					<div class="ourservice-content">  						<p>Proin gravida nibh velit auctor bibendum auctor, nisi elituat ipsum odio sit amet nibh ulpate cursus a sit amet mauris.</p>  					</div>  				</div>    			</div>        </div>
        <div class="column col-xs-12 col-sm-6 col-md-3 col-lg-3">
          
<div class=" pav-newsletter" id="newsletter_1995213443">
		<form id="formNewLestter" method="post" action="forgotpass.php" class="formNewLestter">
            <div class="panel-heading"><h4 class="panel-title">Newsletter</h4></div>
            <div class="box-content">
                <div class="description"><p>A newsletter is a regularly distributed publication that is generally about one main topic of interest to its subscribers.</p></div>
                <div class="input-group">
                    <input type="text" class="form-control email"   placeholder="Your email address" name="email">
                	<div class="input-group-btn">
                    	<button type="submit" name="submitNewsletter" class="btn btn-custom" value="Subscribe">
                    	<span class="fa fa-paper-plane"></span></button>
                	</div>
                </div>
             
                <input type="hidden" value="1" name="action">
                <div class="valid"></div>
                            </div>	
		</form>
</div>
<script type="text/javascript"><!--

$( document ).ready(function() {

	$('#formNewLestter').on('submit', function() {
		var email = $('.email').val();
		$(".success_inline, .warning_inline, .error").remove();
		if(!isValidEmailAddress(email)) {				
			$('.valid').html("<div class=\"error alert alert-danger\">Email is not valid!<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button></div></div>");
			$('.email').focus();
			return false;
		}
	
		var url = "http://sarmicrosystems.in/oc/index.php?route=extension/module/pavnewsletter/subscribe";
		$.ajax({
			type: "post",
			url: url,
			data: $("#formNewLestter").serialize(),
			dataType: 'json',
			success: function(json)
			{
				$(".success_inline, .warning_inline, .error").remove();
				if (json['error']) {
					$('.valid').html("<div class=\"warning_inline alert alert-danger\">"+json['error']+"<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button></div>");
				}
				if (json['success']) {
					$('.valid').html("<div class=\"success_inline alert alert-success\">"+json['success']+"<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button></div>");
				}
			}
		}); return false;
	
	}); //end submmit
}); //end document

function isValidEmailAddress(emailAddress) {
	var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	return pattern.test(emailAddress);
}
--></script>        </div>
                  <div class="column col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <div class="box pav-custom">              
              <div class="panel-heading">
                <h4 class="panel-title">Contact Us</h4>
              </div>
              <div class="box-content">
                <div class="box-content">  	<div class="description">PO Box 16122 Collins Street West Victoria 8007 Australia</div>  	<ul class="list contact">  		<li><span class="iconbox"><i class="fa fa-phone">&nbsp;</i>+844 123 456 78</span></li>  		<li><span class="iconbox"><i class="fa fa-mobile-phone">&nbsp;</i>+844 123 456 79</span></li>  		<li><span class="iconbox"><i class="fa fa-envelope">&nbsp;</i>contac@yourcompany.com</span></li>  	</ul>  </div>              </div>
            </div>
          </div>        
        
                <div class="column col-xs-12 col-sm-6 col-md-3 col-lg-3">
          <div class="box pav-custom">
            <div class="panel-heading">
              <h4 class="panel-title">follow us</h4>
            </div>
             
          </div>
        </div>        
              </div>
  </div>
</div>
    <div class="footer-bottom " id="pavo-footer-bottom">
  <div class="container">
    <div class="container-inner">
    <div class="row">
      <div class="column col-xs-12 col-sm-6 col-md-3 col-lg-3">
        <div class="box">
          <div class="panel-heading">
            <h4 class="panel-title">My Account</h4>
          </div>
          <ul class="list-unstyled list">
            <li><a href="http://sarmicrosystems.in/oc/index.php?route=account/account">My Account</a></li>
            <li><a href="http://sarmicrosystems.in/oc/index.php?route=account/order">Order History</a></li>
            <li><a href="http://sarmicrosystems.in/oc/index.php?route=account/wishlist">Wish List</a></li>
            <li><a href="http://sarmicrosystems.in/oc/index.php?route=account/newsletter">Newsletter</a></li>
            <li><a href="http://sarmicrosystems.in/oc/index.php?route=product/special">Specials</a></li>
          </ul>
        </div>
      </div>
            <div class="column col-xs-12 col-sm-6 col-md-3 col-lg-3">
        <div class="box">
          <div class="panel-heading">
            <h4 class="panel-title">Information</h4>
          </div>
          <ul class="list-unstyled list">
                        <li><a href="http://sarmicrosystems.in/oc/index.php?route=information/information&amp;information_id=4">About Us</a></li>
                        <li><a href="http://sarmicrosystems.in/oc/index.php?route=information/information&amp;information_id=6">Delivery Information</a></li>
                        <li><a href="http://sarmicrosystems.in/oc/index.php?route=information/information&amp;information_id=3">Privacy Policy</a></li>
                        <li><a href="http://sarmicrosystems.in/oc/index.php?route=information/information&amp;information_id=5">Terms &amp; Conditions</a></li>
                      </ul>
        </div>
      </div>
            
      <div class="column col-xs-12 col-sm-6 col-md-3 col-lg-3">
        <div class="box">
          <div class="panel-heading">
            <h4 class="panel-title">Customer Service</h4>
          </div>
          <ul class="list-unstyled list">
            <li><a href="http://sarmicrosystems.in/oc/index.php?route=information/contact">Contact Us</a></li>
            <li><a href="http://sarmicrosystems.in/oc/index.php?route=account/return/add">Returns</a></li>
            <li><a href="http://sarmicrosystems.in/oc/index.php?route=information/sitemap">Site Map</a></li>
             <li><a href="http://sarmicrosystems.in/oc/index.php?route=product/manufacturer">Brands</a></li>
            <li><a href="http://sarmicrosystems.in/oc/index.php?route=account/voucher">Gift Certificates</a></li>
          </ul>
        </div>
      </div>


              <div class="column col-xs-12 col-sm-6 col-md-3 col-lg-3">
          <div class="box contact-us">
            <div class="panel-heading">
              <h4 class="panel-title">Business Hours</h4>
            </div>
              <div class="box-content">
              <ul class="list-unstyled list">  			            <li>Mon - Fri: ---------------8am - 5pm</li>  			            <li>Sat: ----------------------8am - 11am</li>  			            <li>Sun: ------------------------- Closed</li>  			            <li>We work all the holidays</li>  			        </ul>            </div>
          </div>
        </div>        
      
      </div>
    </div>
  </div>
</div>

</footer>
 
 
<div id="powered">
  <div class="container">
    <div class="copyright pull-left">
          Powered By <a href="http://www.opencart.com">OpenCart</a><br /> Your Store &copy; 2017. 
        </div> 

          <div class="paypal pull-right">
        <img src="image/catalog/demo/payment.png" alt="">      </div>
     
</div>


</div>

 <!-- 
<script type="text/javascript">
$(document).ready( function (){
	$(".paneltool .panelbutton").click( function(){	
		$(this).parent().toggleClass("active");
	} );
} );

</script>


<script type="text/javascript">
$('#myTab a').click(function (e) {
	e.preventDefault();
	$(this).tab('show');
})
$('#myTab a:first').tab('show'); 
 

var $MAINCONTAINER = $("html");

/**
 * BACKGROUND-IMAGE SELECTION
 */
$(".background-images").each( function(){
	var $parent = this;
	var $input  = $(".input-setting", $parent ); 
	$(".bi-wrapper > div",this).click( function(){
		 $input.val( $(this).data('val') ); 
		 $('.bi-wrapper > div', $parent).removeClass('active');
		 $(this).addClass('active');

		 if( $input.data('selector') ){  
			$($input.data('selector'), $($MAINCONTAINER) ).css( $input.data('attrs'),'url('+ $(this).data('image') +')' );
		 }
	} );
} ); 

$(".clear-bg").click( function(){
	var $parent = $(this).parent();
	var $input  = $(".input-setting", $parent ); 
	if( $input.val('') ) {
		if( $parent.hasClass("background-images") ) {
			$('.bi-wrapper > div',$parent).removeClass('active');	
			$($input.data('selector'),$("#main-preview iframe").contents()).css( $input.data('attrs'),'none' );
		}else {
			$input.attr( 'style','' )	
		}
		$($input.data('selector'), $($MAINCONTAINER) ).css( $input.data('attrs'),'inherit' );

	}	
	$input.val('');

	return false;
} );



 $('.accordion-group input.input-setting').each( function(){
 	 var input = this;
 	 $(input).attr('readonly','readonly');
 	 $(input).ColorPicker({
 	 	onChange:function (hsb, hex, rgb) {
 	 		$(input).css('backgroundColor', '#' + hex);
 	 		$(input).val( hex );
 	 		if( $(input).data('selector') ){  
				$( $MAINCONTAINER ).find($(input).data('selector')).css( $(input).data('attrs'),"#"+$(input).val() )
			}
 	 	}
 	 });
	} );
 $('.accordion-group select.input-setting').change( function(){
	var input = this; 
		if( $(input).data('selector') ){  
		var ex = $(input).data('attrs')=='font-size'?'px':"";
		$( $MAINCONTAINER ).find($(input).data('selector')).css( $(input).data('attrs'), $(input).val() + ex);
	}
 } );
 

</script>-->
</div>
<div class="sidebar-offcanvas visible-xs visible-sm">
    <div class="offcanvas-inner panel-offcanvas">
        <div class="offcanvas-heading clearfix">
            <button data-toggle="offcanvas" class="btn btn-v2 pull-right" type="button"><span class="zmdi zmdi-close"></span></button>
        </div>
        <div class="offcanvas-body">
            <div id="offcanvasmenu"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#offcanvasmenu").html($("#bs-megamenu").html());
</script><div id="top"><a class="scrollup" href="#"><i class="fa fa-angle-up"></i>TOP</a></div>
</div>
</body></html>