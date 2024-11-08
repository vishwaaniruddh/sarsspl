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
    <style>
    	#load{
    display: none;
    width: 100%;
    height: 100%;
    position:fixed;
    z-index:9999;
    background:url("<?=base_url('assets/images/Circle.svg')?>") no-repeat center center rgba(0,0,0,0.25)
}
    </style>
    
  </head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  <body class="vertical-layout vertical-menu-modern 1-column   blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <div id="load"></div>
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
					
				</div>
				<div class="card-content collapse show">
					<div class="card-body">
						
						<form class="form" action="<?=base_url(uri_string())?>" method="POST" onsubmit="return CheckPasswordreq()" enctype="multipart/form-data">
							<div class="form-body">
								<?=$this->session->flashdata('FlashMassage');?>
								
								<h4 class="form-section"><i class="ft-user"></i>Position </h4>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="projectinput1">Address <span class="text-danger" title="required Input">*</span></label>
											<textarea id="getAddress" rows="5" class="form-control" name="address" placeholder="Get Address" required></textarea>
											
										</div>
									</div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="projectinput1">Upload Profile Image <span class="text-danger" title="required Input">*</span></label>
                                           <input accept="image/*"  name="image" class="form-control" type='file' id="uploadfile" required/>
                                           <small class="text-warning">Image Must be atleast 500 width x 500 height and png,jpg,jpeg format</small>
                                            
                                        </div>
                                        <span id="response"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <div style="display:none" id="imgbox">
                                            <div class="form-group">
                                                <img id="output" style="height: 155px;" src="#" alt="your image" />

                                            </div>
                                        </div>
                                        <span id="imgsize"></span>
                                    </div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="projectinput1">Country <span class="text-danger" title="required Input">*</span></label>											
											<select name="country" id="country"  class="form-control" required readonly></select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="projectinput2">Zone <span class="text-danger" title="required Input">*</span></label>
											
											<select name="zone" id="zone"  class="form-control" required readonly></select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="projectinput2">State</label>
											
											<select name="State" id="State"  class="form-control" required readonly></select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="projectinput2">Division</label>
											
											<select name="Division" id="Division"  class="form-control" required readonly></select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="projectinput2">District</label>
											
											<select name="district" id="district"  class="form-control" required readonly></select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="projectinput2">taluka</label>
											
											<select name="taluka" id="taluka"  class="form-control" required readonly></select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="projectinput2">pincode <span class="text-danger" title="required Input">*</span></label>
											
											<!-- <select name="pincode" id="pincode"  class="form-control" required ></select> -->
											<input type="number" name="pincode" id="pincode" class="form-control typeahead" required>
											<input type="hidden" name="village" id="village" required>
										</div>
									</div>
									<!-- <div class="col-md-3">
										<div class="form-group">
											<label for="projectinput2">village <span class="text-danger" title="required Input">*</span></label>

											
											<select name="village" id="village"  class="form-control" required ></select>
										</div>
									</div> -->
									<div class="col-md-12 m-2 text-center">
										<span id="getfranchise"></span>
									</div>
								</div>
							

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
											<input type="text"  class="form-control" placeholder="Enter Phone Number" name="phoneno" required>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="projectinput6">Email Id </label>
											<input type="email"  class="form-control" placeholder="Enter Email id" name="emailid" >
										</div>
									</div>
									
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="reffral">Refferal Code</label>
											<input type="text"  class="form-control <?php if(isset($_GET['refcode'])){ echo "border-success"; } ?>" value="<?php if(isset($_GET['refcode'])){ echo $_GET['refcode']; } ?>" placeholder="Enter ReffralCode" name="ReffralCode" readonly>
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
    		var village = $("#village").val();
    		if(village!==''){
	    		if(password===ConfirmPassword)
	    		{
	    			return true;

	    		}
	    		else
	    		{
	    			return false;
	    		}
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

     <script>
    	

    	$('#pincode').typeahead({
    		 
            source: function (query, result) {
                console.log("Call data");   
                $("#village").html('');             
                $("#taluka").html('');             
                $("#district").html('');             
                $("#Division").html('');             
                $("#State").html('');             
                $("#zone").html('');             
                $("#country").html('');             
                $("#getfranchise").html('');             
                $.ajax({
                    url: "<?=base_url('Result/getpincode')?>",
                    data: 'query=' + query,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                    	
                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            },
            updater: function(item) {
                selectvilage(item.id);
                selecttaluka(item.id);
                getnoofvilage(item.id);
                console.log("====="+item)
                return item;
            }
        });

    </script>

    <script>
    	function selectvilage(pincode)
    	{
    		 $("#load").show();
    		$.ajax({
                    url: "<?=base_url('Result/getvillage')?>",
                    data: 'query=' + pincode,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        
                        $("#village").val(data);
                          // $("#load").hide();
                    }
                });


    	}
    </script> 
    <script>
        function getnoofvilage(pincode)
        {
             $("#load").show();
            $.ajax({
                    url: "<?=base_url('Result/getnoofvilage')?>",
                    data: 'query=' + pincode,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        
                        // $("#village").html(data);
                          // $("#load").hide();
                          // console.log(data);
                          if(data==0)
                          {
                            // console.log('%c Sorry, Out of 60 Positions in your pincode 60 Positions are FULL and so we CAN-NOT appoint you. Request you to contact you introducer for the same. ', 'color: #ff4961');

                            $("#getfranchise").html("<span class='text-danger'>Sorry, <b  class='text-warning' >Out of 60 Positions</b> in your pincode 60 Positions are FULL and so we CAN-NOT appoint you. Request you to contact you introducer for the same. </span>");


                          }
                          else
                          {
                            // console.log('%c Congratulations, Out of 60 Positions in your pincode '+data+' Positions are available. Please fill the form to confirm your appointment. ', 'color: #28d094');
                            $("#getfranchise").html('<span >Congratulations, <b  class="text-warning" >Out of 60 Positions</b> in your pincode <b class="text-warning ">'+data+' Positions are available</b>. Please fill the form to confirm your appointment. <span>');

                          }
                    }
                });


        }
    </script>

    <script>
    	function selecttaluka(pincode)
    	{
           $("#load").show();
    		$.ajax({
                    url: "<?=base_url('Result/gettaluka')?>",
                    data: 'query=' + pincode,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        
                        $("#taluka").html(data);
                        var taluka= $('#taluka').val();
                        selectdistrict(taluka); 
                         $("#load").hide();                        
                    }
                });


    	}
    </script>

    <script>
    	function selectdistrict(taluka)
    	{
    		 // $("#load").show();
    		$.ajax({
                    url: "<?=base_url('Result/getdistrict')?>",
                    data: 'query=' + taluka,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        
                        $("#district").html(data);
                        var district= $('#district').val();
                        selectdivision(district); 
                         $("#load").hide();

                        
                    }
                });


    	}
    </script>

    <script>
    	function selectdivision(district)
    	{
        // $("#load").show();
    		 
    		$.ajax({
                    url: "<?=base_url('Result/getdivision')?>",
                    data: 'query=' + district,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        $("#Division").html(data);
                        var division= $('#Division').val();
                        selectState(division);
                         $("#load").hide();
                       
                    }
                });


    	}
    </script>

    <script>
    	function selectState(division)
    	{
    		 // $("#load").show();
    		$.ajax({
                    url: "<?=base_url('Result/getState')?>",
                    data: 'query=' + division,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        
                        $("#State").html(data);
                        var State= $('#State').val();
                        selectZone(State);
                         $("#load").hide();
                    }
                });


    	}
    </script>

    <script>
    	function selectZone(state)
    	{
          // $("#load").show();
    		$.ajax({
                    url: "<?=base_url('Result/getZone')?>",
                    data: 'query=' + state,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        
                        $("#zone").html(data);
                        var zone= $('#zone').val();
                        selectCountry(zone);
                         $("#load").hide();
                    }
                });


    	}
    </script>
    <script>
    	function selectCountry(zone)
    	{
    		 // $("#load").show();

    		$.ajax({
                    url: "<?=base_url('Result/getCountry')?>",
                    data: 'query=' + zone,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        
                        $("#country").html(data);
                         $("#load").hide();
                    }
                });


    	}
    </script>

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

    <!-- <script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
      $("#imgbox").show()
    }
  };
</script>
  -->
<script>
    $(document).ready(function(){

 var _URL = window.URL || window.webkitURL;

 $('#uploadfile').change(function () {
  var file = $(this)[0].files[0];

  img = new Image();
  var imgwidth = 0;
  var imgheight = 0;
  var maxwidth = 500;
  var maxheight = 500;

  img.src = _URL.createObjectURL(file);
  img.onload = function() {
   imgwidth = this.width;
   imgheight = this.height;
  

   $("#width").text(imgwidth);
   $("#height").text(imgheight);
   if(imgwidth <= maxwidth && imgheight <= maxheight){

    console.log('%c perfect Image', 'color: #28d094');
    $("#output").attr("src",img.src);
   $("#imgbox").show();
   $("#response").html('');
   $("#imgsize").html('');

  
  }else{
   $("#response").html('<span class="text-danger">Image size must be '+maxwidth+'X'+maxheight+'</span>');
   console.log('%c Image size must be '+maxwidth+'X'+maxheight, 'color: #ff4961');
   $("#uploadfile").val('');
   
   $("#imgsize").html('<span class="text-danger">Uploaded Image width '+imgwidth+' And height = '+imgheight+'</span>');
   $("#output").attr("src",'');
   $("#imgbox").hide();
  }
 };
 img.onerror = function() {

  $("#response").html('<span class="text-danger">not a valid file: ' + file.type+'</span>');
  console.log('%c not a valid file: ' + file.type, 'color: #ff4961');
  $("#uploadfile").val('');
  $("#imgsize").html('<span class="text-danger">Uploaded Image width '+imgwidth+'And height = '+imgheight+'</span>');
   $("#output").attr("src",'');
   $("#imgbox").hide();
 }

 });
});
</script>


   


  </body>
  <!-- END: Body-->

</html>