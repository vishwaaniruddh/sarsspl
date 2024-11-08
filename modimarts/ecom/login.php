<!DocTYPE html>
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
        <title>Account Login</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
        <script type="text/javascript" src="catalog/view/javascript/jquery/jquery-2.1.1.min.js"></script>
       <script type="text/javascript" src="requiredfunctions.js"></script>
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
                <script type="text/javascript" src="catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/bootstrap/js/bootstrap.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/common.js"></script>
                <script type="text/javascript" src="catalog/view/theme/pav_bigstore/javascript/common.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/pavdeals/countdown.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/colorpicker/js/colorpicker.js"></script>
        
    <!-- FONT -->

        <!-- FONT -->

<style>

#notification {
    visibility: hidden;
    min-width: 250px;
    margin-left: -125px;
    background-color: #333;
    color: #fff;
    text-align: center;
    border-radius: 2px;
    padding: 16px;
    position: fixed;
    z-index: 1;
    left: 50%;
    bottom: 30px;
    font-size: 17px;
}

#notification.showalrt{
    visibility: visible;
     -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
    animation: fadein 0.5s, fadeout 0.5s 2.5s;
   
}
</style>
      </head>
<body class="common-home page-common-home layout-fullwidth">
    <div class="row-offcanvas row-offcanvas-left">
      <div id="page">
        <!-- header -->
        
<header id="header-layout" class="header-v2">
    <div id="topbar" class="topbar-v1">
  <div class="container">
  <?php include('topbar.php')?>
</div>
</div>    <div id="header-main">
        <div class="">
            <div class="row">
            <?php include('menucopy.php')?>
            </div>
        </div>
    </div>
    
    <!---<div id="header-bot" class="hidden-xs hidden-sm">
        <div class="container">
            <div class="container-inner">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                        <div id="pav-mainnav" class="hidden-xs hidden-sm">
                            
                                            
                                              <div class="bottom-offcanvas visible-xs visible-sm space-10 space-top-10">
            <div class="container">
                <button data-toggle="offcanvas" class="btn btn-primary" type="button"><i class="fa fa-bars"></i></button>
            </div>
        </div>
                                                </div>
                    </div>
                            <div class="col-lg-3 col-sm-3 col-md-3 hidden-xs hidden-sm">
                                                     
                            </div>
                        </div>
            </div>
        </div>
    </div>--->
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
  <ul class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i></a></li>
        <!--<li><a href="http://sarmicrosystems.in/oc1/index.php?route=account/account">Account</a></li>-->
        <li><a href="#">Login</a></li>
      </ul>
      <div class="row">                <div id="content" class="col-sm-9">      <div class="row">
        <div class="col-sm-6">
         <!--<div class="well">
           <h2>New Customer</h2>
            <p><strong>Register Account</strong></p>
            <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
            <a href="Register.php" class="btn btn-primary">Continue</a>
            </div>-->
        </div>
        <div class="col-sm-6">
          <div class="well">
            <h2>Login</h2>
            <form action="process_login.php" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label class="control-label" for="input-email">E-Mail Address</label>
                <input type="text" name="email" value="" placeholder="E-Mail Address" id="input-email" class="form-control" />
              </div>
              <div class="form-group">
                <label class="control-label" for="input-password">Password</label>
                <input type="password" name="password" value="" placeholder="Password" id="input-password" class="form-control" />
                <a href="forgot_pass.php">Forgotten Password</a></div>
              <input type="button" value="Login" id="button-login" class="btn btn-primary" onclick="logfnn();"/>
                          </form>
          </div>
        </div>
      </div>
      </div>
    <div id="column-right" class="col-lg-3 col-md-3 col-sm-12 sidebar col-xs-12">
   <!-- <div class="list-group">
    <a href="http://sarmicrosystems.in/oc1/index.php?route=account/login" class="list-group-item">Login</a> <a href="http://sarmicrosystems.in/oc1/index.php?route=account/register" class="list-group-item">Register</a> <a href="http://sarmicrosystems.in/oc1/index.php?route=account/forgotten" class="list-group-item">Forgotten Password</a>
    <a href="http://sarmicrosystems.in/oc1/index.php?route=account/account" class="list-group-item">My Account</a>
    <a href="http://sarmicrosystems.in/oc1/index.php?route=account/address" class="list-group-item">Address Book</a> <a href="http://sarmicrosystems.in/oc1/index.php?route=account/wishlist" class="list-group-item">Wish List</a> <a href="http://sarmicrosystems.in/oc1/index.php?route=account/order" class="list-group-item">Order History</a> <a href="http://sarmicrosystems.in/oc1/index.php?route=account/download" class="list-group-item">Downloads</a><a href="http://sarmicrosystems.in/oc1/index.php?route=account/recurring" class="list-group-item">Recurring payments</a> <a href="http://sarmicrosystems.in/oc1/index.php?route=account/reward" class="list-group-item">Reward Points</a> <a href="http://sarmicrosystems.in/oc1/index.php?route=account/return" class="list-group-item">Returns</a> <a href="http://sarmicrosystems.in/oc1/index.php?route=account/transaction" class="list-group-item">Transactions</a> <a href="http://sarmicrosystems.in/oc1/index.php?route=account/newsletter" class="list-group-item">Newsletter</a>
  </div>-->
  </div>
</div>
</div>

<!--
  $ospans: allow overrides width of columns base on thiers indexs. format array( column-index=>span number ), example array( 1=> 3 )[value from 1->12]
 -->



 
<footer id="footer" class="nostylingboxs">

  <?php include("footer.php")?>

</footer>
 
<div id="powered">
    
 <?php include('footerbottom.php')?>
 
</div>


  
<script type="text/javascript">

function logfnn()
{
    
     var eml=document.getElementById('input-email').value;
    var passw=document.getElementById('input-password').value;
    $.ajax({
        url: 'loginprocessnew.php',
        type: 'post',
        data:'email='+eml+'&password='+passw,
        beforeSend: function() {
        	$('#button-login').button('loading');
		},
        complete: function() {
            $('#button-login').button('reset');
        },
        success: function(msg) {
            //alert(msg);
            $('.alert, .text-danger').remove();
            $('.form-group').removeClass('has-error');

            if (msg==1) {
                location = 'index.php';
            } else {
            //    $('#well').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' +'Incorrect username and password'+ '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
			
			toastfunc("Incorrect username and password");
			$('input[name=\'email\']').parent().addClass('has-error');
				$('input[name=\'password\']').parent().addClass('has-error');
		   }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}


$(document).ready( function (){
	$(".paneltool .panelbutton").click( function(){	
		$(this).parent().toggleClass("active");
	} );
} );

</script>

<!--------<div id="pav-paneltool" class="hidden-sm hidden-xs">
	<div class="paneltool themetool">
		<div class="panelbutton">
			<i class="fa fa-cog"></i>
		</div>
		<div class="panelcontent ">
			<div class="panelinner">
				<h4>Panel Tool</h4>
				<form action="/oc1/index.php?route=account/login" method="post" class="clearfix"><div class="clearfix">
					<div class="group-input row">
						<label class="col-sm-4">Theme</label>
						<select class="col-sm-8" name="userparams[skin]">
							<option value="">default</option>
														<option value="blue" >blue</option>
														<option value="brown" >brown</option>
														<option value="green" >green</option>
														<option value="greenlight" >greenlight</option>
													</select>					
					</div>
					<div class="group-input row">
						<label class="col-sm-4">Layout</label>
						<select class="col-sm-8" name="userparams[layout]">
														<option value="fullwidth"  selected="selected" >Full Width</option>
														<option value="boxed-lg" >Boxed Desktop Large</option>
													</select>					
					</div>

					<hr>
					<div class="clearfix"></div>
					<p class="group-input pull-right">
						<button value="Apply" class="btn btn-small" name="btn-save" type="submit">Apply</button>
						<a class="btn btn-small" href="http://sarmicrosystems.in/oc1/?pavreset=?"><span>Reset</span></a>
					</p>
				</div></form>
			</div>	
		</div>
	</div>
	
	<div class="paneltool editortool">
		<div class="panelbutton">
			<i class="fa fa-adjust"></i>
		</div>
		<div class="panelcontent editortool"><div class="panelinner">
							
				<h4>Live Theme Editor</h4>					
									<div class="clearfix" id="customize-body">			
						<ul class="nav nav-tabs" id="myTab">
														<li><a href="#tab-selectors">Layout Selectors</a></li>		
														<li><a href="#tab-elements">Layout Elements</a></li>		
													</ul>										
						<div class="tab-content" > 
														<div class="tab-pane" id="tab-selectors">
																<div class="accordion"  id="custom-accordionselectors">
																  	            	   <div class="accordion-group">
			                            <div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#custom-accordionselectors" href="#collapsebody">
												Body Content	 
											</a>
										</div>

			                            <div id="collapsebody" class="accordion-body panel-collapse collapse  in ">
				                            <div class="accordion-inner panel-body clearfix">
				                              														 					                                  <div class="form-group">
															<label>Background Color</label>
															<input value="" size="10" name="customize[body][]" data-match="body" type="text" class="input-setting" data-selector="body,body #page" data-attrs="background-color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 													  <div class="form-group background-images"> 
															<label>Background Image</label>
															<a class="clear-bg btn btn-small" href="#">Clear</a>
															<input value="" type="hidden" name="customize[body][]" data-match="body" class="input-setting" data-selector="body,body #page" data-attrs="background-image">

															<div class="clearfix"></div>
															 <p><em style="font-size:10px">Those Images in folder YOURTHEME/img/patterns/</em></p>
															<div class="bi-wrapper clearfix">
																														<div style="background:url('http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern1.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern1.png" data-val="../../img/patterns/pattern1.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern10.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern10.png" data-val="../../img/patterns/pattern10.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern11.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern11.png" data-val="../../img/patterns/pattern11.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern12.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern12.png" data-val="../../img/patterns/pattern12.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern13.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern13.png" data-val="../../img/patterns/pattern13.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern14.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern14.png" data-val="../../img/patterns/pattern14.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern15.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern15.png" data-val="../../img/patterns/pattern15.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern16.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern16.png" data-val="../../img/patterns/pattern16.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern17.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern17.png" data-val="../../img/patterns/pattern17.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern18.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern18.png" data-val="../../img/patterns/pattern18.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern19.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern19.png" data-val="../../img/patterns/pattern19.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern2.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern2.png" data-val="../../img/patterns/pattern2.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern20.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern20.png" data-val="../../img/patterns/pattern20.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern3.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern3.png" data-val="../../img/patterns/pattern3.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern4.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern4.png" data-val="../../img/patterns/pattern4.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern5.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern5.png" data-val="../../img/patterns/pattern5.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern6.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern6.png" data-val="../../img/patterns/pattern6.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern7.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern7.png" data-val="../../img/patterns/pattern7.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern8.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern8.png" data-val="../../img/patterns/pattern8.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern9.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc1/catalog/view/theme/pav_bigstore/image/pattern/pattern9.png" data-val="../../img/patterns/pattern9.png">

															</div>
																				                                    </div>
					                                  </div>
					                                  

																									 					                                   <div class="form-group">
						                                   <label>Font-Size</label>
						                                  	<select name="customize[body][]" data-match="body"  class="input-setting" data-selector="body,body #page" data-attrs="font-size">
																<option value="">Inherit</option>
																												<option value="9">9</option>
																														<option value="10">10</option>
																														<option value="11">11</option>
																														<option value="12">12</option>
																														<option value="13">13</option>
																														<option value="14">14</option>
																														<option value="15">15</option>
																														<option value="16">16</option>
																															</select>
																<a href="#" class="clear-bg btn btn-small">Clear</a>
					                                  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Font-Family</label>
															<input value="" size="10" name="customize[body][]" data-match="body" type="text" class="input-setting" data-selector="body,body #page" data-attrs="font-family"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Text Color</label>
															<input value="" size="10" name="customize[body][]" data-match="body" type="text" class="input-setting" data-selector="body,body #page" data-attrs="color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Link Color</label>
															<input value="" size="10" name="customize[body][]" data-match="body" type="text" class="input-setting" data-selector="body a,body #page a" data-attrs="color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																                            </div>
			                            </div>
				                    </div>         	
																	  	            	   <div class="accordion-group">
			                            <div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#custom-accordionselectors" href="#collapsetop-bar">
												Top Bar	 
											</a>
										</div>

			                            <div id="collapsetop-bar" class="accordion-body panel-collapse collapse ">
				                            <div class="accordion-inner panel-body clearfix">
				                              														 					                                  <div class="form-group">
															<label>Background </label>
															<input value="" size="10" name="customize[top-bar][]" data-match="top-bar" type="text" class="input-setting" data-selector="#topbar" data-attrs="background-color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Link Color</label>
															<input value="" size="10" name="customize[top-bar][]" data-match="top-bar" type="text" class="input-setting" data-selector="#topbar a,#topbar .dropdown .dropdown-toggle" data-attrs="color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Link hover</label>
															<input value="" size="10" name="customize[top-bar][]" data-match="top-bar" type="text" class="input-setting" data-selector="#topbar a:hover,#topbar .dropdown:hover .dropdown-toggle" data-attrs="color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																                            </div>
			                            </div>
				                    </div>         	
																	  	            	   <div class="accordion-group">
			                            <div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#custom-accordionselectors" href="#collapsepav-mainnav">
												Main Menu	 
											</a>
										</div>

			                            <div id="collapsepav-mainnav" class="accordion-body panel-collapse collapse ">
				                            <div class="accordion-inner panel-body clearfix">
				                              														 					                                  <div class="form-group">
															<label>Background Color</label>
															<input value="" size="10" name="customize[pav-mainnav][]" data-match="pav-mainnav" type="text" class="input-setting" data-selector="#pav-mainnav,#pav-mainnav .navbar-default" data-attrs="background-color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Color Link</label>
															<input value="" size="10" name="customize[pav-mainnav][]" data-match="pav-mainnav" type="text" class="input-setting" data-selector="#pav-megamenu .navbar-nav li a" data-attrs="color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																                            </div>
			                            </div>
				                    </div>         	
																	  	            	   <div class="accordion-group">
			                            <div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#custom-accordionselectors" href="#collapsefooter-top">
												Footer top	 
											</a>
										</div>

			                            <div id="collapsefooter-top" class="accordion-body panel-collapse collapse ">
				                            <div class="accordion-inner panel-body clearfix">
				                              														 					                                  <div class="form-group">
															<label>Background </label>
															<input value="" size="10" name="customize[footer-top][]" data-match="footer-top" type="text" class="input-setting" data-selector=".footer-top" data-attrs="background-color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																                            </div>
			                            </div>
				                    </div>         	
																	  	            	   <div class="accordion-group">
			                            <div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#custom-accordionselectors" href="#collapsefooter-center">
												Footer Center	 
											</a>
										</div>

			                            <div id="collapsefooter-center" class="accordion-body panel-collapse collapse ">
				                            <div class="accordion-inner panel-body clearfix">
				                              														 					                                  <div class="form-group">
															<label>Background </label>
															<input value="" size="10" name="customize[footer-center][]" data-match="footer-center" type="text" class="input-setting" data-selector=".footer-center,.footer-center .container" data-attrs="background-color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Text color</label>
															<input value="" size="10" name="customize[footer-center][]" data-match="footer-center" type="text" class="input-setting" data-selector=".footer-center .container .column,.footer-center .container .column .panel-title" data-attrs="color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Link color</label>
															<input value="" size="10" name="customize[footer-center][]" data-match="footer-center" type="text" class="input-setting" data-selector=".footer-center .container .column a" data-attrs="color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Link hover</label>
															<input value="" size="10" name="customize[footer-center][]" data-match="footer-center" type="text" class="input-setting" data-selector=".footer-center .container .column a:hover" data-attrs="color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Bg newsletter</label>
															<input value="" size="10" name="customize[footer-center][]" data-match="footer-center" type="text" class="input-setting" data-selector=".btn-custom" data-attrs="background-color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																                            </div>
			                            </div>
				                    </div>         	
																	  	            	   <div class="accordion-group">
			                            <div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#custom-accordionselectors" href="#collapsepowered">
												Powered	 
											</a>
										</div>

			                            <div id="collapsepowered" class="accordion-body panel-collapse collapse ">
				                            <div class="accordion-inner panel-body clearfix">
				                              														 					                                  <div class="form-group">
															<label>Background </label>
															<input value="" size="10" name="customize[powered][]" data-match="powered" type="text" class="input-setting" data-selector="#powered .container" data-attrs="background-color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Text color</label>
															<input value="" size="10" name="customize[powered][]" data-match="powered" type="text" class="input-setting" data-selector="#powered .container" data-attrs="color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Link color</label>
															<input value="" size="10" name="customize[powered][]" data-match="powered" type="text" class="input-setting" data-selector="#powered .container a" data-attrs="color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																                            </div>
			                            </div>
				                    </div>         	
																	 </div>
															</div>
						   							<div class="tab-pane" id="tab-elements">
																<div class="accordion"  id="custom-accordionelements">
																  	            	   <div class="accordion-group">
			                            <div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#custom-accordionelements" href="#collapseproduct">
												Products	 
											</a>
										</div>

			                            <div id="collapseproduct" class="accordion-body panel-collapse collapse  in ">
				                            <div class="accordion-inner panel-body clearfix">
				                              														 					                                  <div class="form-group">
															<label>Product Name</label>
															<input value="" size="10" name="customize[product][]" data-match="product" type="text" class="input-setting" data-selector=".product-bloc1k .name a" data-attrs="color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Color Price New</label>
															<input value="" size="10" name="customize[product][]" data-match="product" type="text" class="input-setting" data-selector=".price .price-new" data-attrs="color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Color Price Old</label>
															<input value="" size="10" name="customize[product][]" data-match="product" type="text" class="input-setting" data-selector=".price .price-old" data-attrs="color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Icon Color</label>
															<input value="" size="10" name="customize[product][]" data-match="product" type="text" class="input-setting" data-selector="
				.cart .fa, .wishlist .fa, .compare .fa, .quick-view .fa,.zoom .fa
			" data-attrs="color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Color Sale</label>
															<input value="" size="10" name="customize[product][]" data-match="product" type="text" class="input-setting" data-selector=".product-label" data-attrs="color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Bg Sale</label>
															<input value="" size="10" name="customize[product][]" data-match="product" type="text" class="input-setting" data-selector=".product-label.sale-exist" data-attrs="background-color"><a href="#" class="clear-bg btn btn-small">Clear</a>
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

</div> ----------->
 
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
 

</script>
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