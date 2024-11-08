<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content=".">
    <meta name="keywords" content="">
    <meta name="author" content="SAR">
    <title><?=$Pagename?></title>
    <link rel="apple-touch-icon" href="https://allmart.world/assets/logo.png">
    <link rel="shortcut icon" type="image/png" href="https://allmart.world/assets/logo.png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>vendors/css/forms/icheck/custom.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/colors.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/components.min.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/core/colors/palette-gradient.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/pages/login-register.min.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>css/style.css">
    <!-- END: Custom CSS-->

  </head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  <body class="vertical-layout vertical-menu-modern 1-column   blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    
         <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        
        <div class="content-body"><!-- Basic form layout section start -->
<section id="basic-form-layouts">
	<div class="row match-height m-2">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-form">User Details</h4>
					<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
					<div class="heading-elements">
						<!--<ul class="list-inline mb-0">-->
						<!--	<li><a data-action="collapse"><i class="ft-minus"></i></a></li>-->
						<!--	<li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>-->
						<!--	<li><a data-action="expand"><i class="ft-maximize"></i></a></li>-->
						<!--	<li><a data-action="close"><i class="ft-x"></i></a></li>-->
						<!--</ul>-->
					</div>
				</div>
				<div class="card-content collapse show">
					<div class="card-body">
						
						<form class="form" action="<?=base_url(uri_string())?>" method="POST" onsubmit="return CheckPasswordreq()">
							<div class="form-body">
								<?=$this->session->flashdata('FlashMassage');?>
								<?php if(0){ ?>
								<h4 class="form-section"><i class="ft-user"></i>Position</h4>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="projectinput1">Address</label>
											<textarea id="getAddress" rows="5" class="form-control" name="address" placeholder="Get Address"></textarea>
											
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="projectinput1">Country <span class="text-danger" title="required Input">*</span></label>
											<input type="text" id="projectinput1" class="form-control" placeholder="Select Country" name="country" required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="projectinput2">Zone <span class="text-danger" title="required Input">*</span></label>
											<input type="text" id="zone" class="form-control" placeholder="Select Zone" name="zone" required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="projectinput2">State</label>
											<input type="text" id="State" class="form-control" placeholder="Select State" name="state">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="projectinput2">Division</label>
											<input type="text" id="Division" class="form-control" placeholder="Enter Division" name="division">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="projectinput2">District</label>
											<input type="text" id="Division" class="form-control" placeholder="Enter District" name="district">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="projectinput2">taluka</label>
											<input type="text" id="taluka" class="form-control" placeholder="Enter taluka" name="taluka">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="projectinput2">pincode</label>
											<input type="text" id="pincode" class="form-control" placeholder="Enter pincode" name="pincode">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="projectinput2">village</label>
											<input type="text" id="village" class="form-control" placeholder="Enter village" name="village">
										</div>
									</div>
								</div>
							<?php } ?>

								<h4 class="form-section"><i class="la la-paperclip"></i> User Details</h4>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="projectinput5">Full Name <span class="text-danger" title="required Input">*</span></label>
											<input type="text" id="Full-Name" class="form-control" placeholder="Enter Full Name" name="fullname" required>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label for="projectinput6">Password <span class="text-danger" title="required Input">*</span></label>
											<input type="password" id="txtPassword" class="form-control form-group" placeholder="Enter Password" name="Password" required>
											<span id="toggle_pwd" class="fa fa-fw fa-eye field_icon"></span>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="projectinput6">Confirm Password <span class="text-danger" title="required Input">*</span></label>
											<input type="password" id="ConfirmPassword" class="form-control form-group" placeholder="Enter Password" onkeyup="checkPassword()" name="Password" required>
											<span id="toggle_pwd" class="fa fa-fw fa-eye field_icon"></span>
											
										</div>
										<span id="msg"></span>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="projectinput5">Phone Number <span class="text-danger" title="required Input">*</span></label>
											<input type="Number"  class="form-control " id="phoneno" onkeyup="phonenumber(this.value)" placeholder="Enter Phone Number" name="phoneno" required>

										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="projectinput6">Email Id</label>
											<input type="email"  class="form-control" placeholder="Enter Email id" name="emailid" >
										</div>
									</div>
									
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="reffral">Reffral Code</label>
											<input type="text"  class="form-control <?php if(isset($_GET['refcode'])){ echo "border-success"; } ?>" value="<?php if(isset($_GET['refcode'])){ echo $_GET['refcode']; } ?>" placeholder="Enter Referral Code" name="ReffralCode" readonly>
										</div>
									</div>
								</div>
								
							</div>

							<div class="form-actions">
								<button type="button" class="btn btn-warning mr-1">
									<i class="ft-x"></i> Cancel
								</button>
								<button type="submit" class="btn btn-primary">
									<input type="hidden" value="1" name="RegisterForm">
									<i class="la la-check-square-o"></i> Save
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

	</div>

</section>
<!-- // Basic form layout section end -->
        </div>
      </div>
    </div>
    <!-- END: Content-->

     

    <script>
    	function checkPassword () {
    		var password = $("#txtPassword").val();
    		var ConfirmPassword = $("#ConfirmPassword").val();
    		if(password===ConfirmPassword)
    		{
    			$("#msg").html("<span class='text-success'>Password Match</span>");

    		}
    		else
    		{
    			$("#msg").html("<span class='text-danger'>Password Not Match</span>");
    		}
    	}
    </script>

    <script>
    	function CheckPasswordreq () {
    		var password = $("#txtPassword").val();
    		var ConfirmPassword = $("#ConfirmPassword").val();
    		if(password===ConfirmPassword)
    		{
    			return true;

    		}
    		else
    		{
    			return false;
    		}
    	}
    </script>



    
     


    <!-- BEGIN: Vendor JS-->
    <script src="<?=base_url('assets/')?>vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="<?=base_url('assets/')?>vendors/js/forms/icheck/icheck.min.js"></script>
    <script src="<?=base_url('assets/')?>vendors/js/forms/validation/jqBootstrapValidation.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="<?=base_url('assets/')?>js/core/app-menu.min.js"></script>
    <script src="<?=base_url('assets/')?>js/core/app.min.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="<?=base_url('assets/')?>js/scripts/forms/form-login-register.min.js"></script>
    <!-- END: Page JS-->

<script type="text/javascript">
        $(function () {
            $("#toggle_pwd").click(function () {
                $(this).toggleClass("fa-eye fa-eye-slash");
               var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
                $("#txtPassword").attr("type", type);
            });
        });
    </script>
  </body>
  <!-- END: Body-->

</html>