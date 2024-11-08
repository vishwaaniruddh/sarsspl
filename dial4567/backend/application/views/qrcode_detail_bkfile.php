<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>QR Detail</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <style>
            .div_title {
                font-size: 12px;
            }
            .div_border {
                border:1px solid grey;
                padding: 5px;
                padding-left: 10px;
                font-weight:bold;
            }
            .code_img {
                box-shadow: 1px 1px 10px 2px gray;
            }
        </style>
    </head>
    <body>
        <header>
            <div class="container mt-3 text-center">
                <div class=" ">
                    <img src="<?php echo $captain_india_logo; ?>" width="100px" />
                </div>
                <!--<div class="mt-3">-->
                <!--    <h4 >Primary Information</h4>-->
                <!--</div>-->
            </div>
        </header>
        <?php if ($result['user_id'] != null) { ?>
            <div class="container mt-3">
                <div class="row mb-3">
                    <div class="col-xs-4 col-sm-12 col-md-6 col-lg-8 col-xl-12">
                        <div class=" text-center">
                            <b >Primary Information</b>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-xs-2 col-sm-6 col-md-3 col-lg-4 col-xl-6  mt-2  mb-2 pr-2">
                        <div class="text-right pr-5">
                            <?php if ($result['image_path'] != null) { ?>
                                <img src="<?php echo $result['image_path']; ?>" width="200px" class="code_img" />
                            <?php } ?>
                        </div>
                        <?php if ($result['missing_status'] == '2') { ?>
                            <div class="text-right pr-5 mt-4">
                                <img src="<?php echo $missing_status; ?>" width="200px" class=" " />
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-xs-2 col-sm-6 col-md-3 col-lg-4 col-xl-6">
                        <div class=" ">

                            <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                                <div class="div_title">Code</div>
                                <div class=" div_border">
                                    <?php echo $result['code']; ?>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                                <div class="div_title">Type</div>
                                <div class=" div_border">
                                    <?php echo $result['type_title']; ?>
                                </div>
                            </div>

                            <?php if ($result['type'] == '1') { ?>
                                <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                                    <div class="div_title">Name of user</div>
                                    <div class=" div_border">
                                        <?php echo $result['first_name'] . " " . $result['last_name']; ?>
                                    </div>
                                </div>

                                <?php if ($result['blood_group'] != null) { ?>
                                    <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                                        <div class="div_title">Blood group</div>
                                        <div class=" div_border">
                                            <?php echo $result['blood_group']; ?>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if ($result['email'] != null) { ?>
                                    <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                                        <div class="div_title">Email</div>
                                        <div class=" div_border">
                                            <?php echo $result['email']; ?>
                                        </div>
                                    </div>
                                <?php } ?>

                                <div id="div_contact">

                                </div>
                              
                                
                                <?php if ($result['missing_status'] == '1') { ?>
                                    <div class="col-md-4 col-lg-8 col-xl-12 mb-2" id="view_detail_button">
                                        <div class="div_title text-center">
                                            <button type="button" class="btn btn-outline-primary" onclick="viewDetail()" >View Detail</button>
                                        </div>
                                    </div>
                                <?php } else if ($result['missing_status'] == '2') { ?>

                                    <div id="div_missingstatus_contact"  >
                                        <?php if (!empty($result['emergency_contacts'])) { ?>
                                            <div class="col-md-4 col-lg-8 col-xl-12"><div class="div_title">Emergency contacts</div></div>
                                            <?php foreach ($result['emergency_contacts'] as $row) { ?>
                                                <div class="col-md-4 col-lg-8 col-xl-12 mb-2"><div class="div_title"></div>
                                                    <div class=" div_border">
                                                        <?php echo $row['name'] . " - " . $row['mobile_no']; ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <div class="col-md-4 col-lg-8 col-xl-12"><div >There is no emergency contacts.</div></div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>

                                <?php if ($result['missing_status'] == '2') { ?>
                                    <div class="col-md-4 col-lg-8 col-xl-12 mb-2" id="view_detail_button">
                                        <div class="div_title text-center">
                                            <!--<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#rise_missing_alert_modal">Rise Missing Alert</button>-->
                                            <button type="button" class="btn btn-outline-primary"   onclick="riseMissingAlertModal();">Rise Missing Alert</button>
                                        </div>
                                    </div>
                                <?php } ?>
                                
                                <div class="col-xs-2 col-sm-6 col-md-4 col-lg-8 col-xl-12 mb-2" id="mobile_no_div" style="display:none">
                                    <div class="row">
                                        <div class="col-xs-2 col-sm-5 col-md-4 col-lg-7 col-xl-12 mt-2 mb-2 pr-2">For view detail verify mobile number using send OTP</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-2 col-sm-4 col-md-3 col-lg-3 col-xl-4  mb-2  pr-2 ">
                                            <div class="  ">
                                                Enter mobile number
                                            </div>
                                        </div>
                                        <div class="col-xs-2 col-sm-6 col-md-3 col-lg-3 col-xl-6">
                                            <div class=" ">
                                                <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                                                    <div class="  ">
                                                        <input type="text" name="mobile_no" id="mobile_no" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                                                    <div class="div_title  ">
                                                        <button type="button" class="btn btn-outline-primary" onclick="sendOtp()"> Send OTP </button>
                                                        <input type="hidden" name="code_id" id="code_id" value="<?php echo $result['id']; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-2 col-sm-6 col-md-4 col-lg-8 col-xl-12 mb-2" id="send_otp_div" style="display:none">
                                    <div class="row"   >
                                        <div class="col-xs-2 col-sm-4 col-md-3 col-lg-3 col-xl-4   mb-2 pr-2">
                                            <div class="  pr-5">
                                                Enter otp
                                            </div>
                                        </div>
                                        <div class="col-xs-2 col-sm-6 col-md-3 col-lg-4 col-xl-6">
                                            <div class=" ">
                                                <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                                                    <div class="  ">
                                                        <input type="text" name="otp" id="otp" />
                                                        <div id="otp_err" style="display: none; color: red; font-size: 14px;"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                                                    <div class="div_title  ">
                                                        <button type="button" class="btn btn-outline-primary" onclick="verifyOtp()" > Verify OTP </button>
                                                        <input type="hidden" name="code_id" id="code_id" value="<?php echo $code_id; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>
                        </div>
                        <?php if ($result['type'] == '2') { ?>
                            <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                                <div class="div_title">Name of animal</div>
                                <div class=" div_border">
                                    <?php echo $result['name']; ?>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                                <div class="div_title">Color</div>
                                <div class=" div_border">
                                    <?php echo $result['color']; ?>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                                <div class="div_title">Description</div>
                                <div class=" div_border">
                                    <?php echo $result['description']; ?>
                                </div>
                            </div>

                        <?php } ?>

                        <?php if ($result['type'] == '3') { ?>
                            <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                                <div class="div_title">Name of animal</div>
                                <div class=" div_border">
                                    <?php echo $result['name']; ?>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                                <div class="div_title">Device name</div>
                                <div class=" div_border">
                                    <?php echo $result['device_name']; ?>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                                <div class="div_title">Model number</div>
                                <div class=" div_border">
                                    <?php echo $result['model_number']; ?>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                                <div class="div_title">Serial number</div>
                                <div class=" div_border">
                                    <?php echo $result['serial_number']; ?>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                                <div class="div_title">Color</div>
                                <div class=" div_border">
                                    <?php echo $result['color']; ?>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                                <div class="div_title">Description</div>
                                <div class=" div_border">
                                    <?php echo $result['description']; ?>
                                </div>
                            </div>

                        <?php } ?>

                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="container mt-3">
                <div class="row mb-3">
                    <div class="col-xs-4 col-sm-12 col-md-6 col-lg-8 col-xl-12">
                        <div class=" text-center">
                            <b >QR Code is not linked.</b>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    
    <!-- The Modal -->
	<div class="modal" id="rise_missing_alert_modal">
	  	<div class="modal-dialog modal-lg">
		    <div class="modal-content">

		      	<!-- Modal Header -->
		      	<div class="modal-header">
			        <h4 class="modal-title">Rise Missing Alert</h4>
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
		      	</div>

		      	<!-- Modal body -->
		      	<div class="modal-body">
		        	<form   id="edit-form">
		        	    
		        	    
		        	    <div class="row">
                            <div class="col-sm-12">
                                <div class="row form-group">
                                    <div class="col-4 col-sm-2">
                                        <label for="first_name">First Name</label>
                                    </div>
                                    <div class="col-8 col-sm-10">
                                        <input class="form-control" type="text" name="first_name" id="first_name">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-4 col-sm-2">
                                        <label for="last_name">Last Name</label>
                                    </div>
                                    <div class="col-8 col-sm-10">
                                        <input class="form-control" type="text" name="last_name" id="last_name">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-4 col-sm-2">
                                        <label for="mobile_no">Mobile no</label>
                                    </div>
                                    <div class="col-8 col-sm-10">
                                        <input class="form-control" type="text" name="mobile_number" id="mobile_number">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-4 col-sm-2">
                                       
                                    </div>
                                    <div class="col-8 col-sm-10">
                                        <button type="button" class="btn btn-primary" id="btnUpdateSubmit" onclick="riseMissingAlert()" >Add</button>
					  	                <button type="button" class="btn btn-danger float-right" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

					  
					</form>
		      	</div>

		    </div>
	  	</div>
	</div>

    <br/><br/><br/><br/>

    <footer>
        <div class="container">
            <p>
            <div class="text-center">
                <img src="<?php echo $captain_india_support; ?>" width="50px" />
            </div>
            </p>
            <p>
            <div class="text-center" style="color:grey;">
                Captain INDIA Customer Support
            </div>
            </p>
        </div>
    </footer>
    <script>
        function viewDetail() {
            $("#view_detail_button").hide();
            $("#mobile_no_div").show();
        }

        function sendOtp() {
            var mobile_no = $('#mobile_no').val();
            var code_id = $('#code_id').val();
            if (mobile_no.length != 10) {
                alert("Please enter valid number")
            } else {
                $.ajax({
                    cache: false,
                    type: 'POST',
                    data: {'mobile_number': mobile_no, 'code_id': code_id, 'purpose': 4, 'active_platform': 3},
                    url: "<?php echo $send_otp_url; ?>",
                    success: function (data) {
                        $("#mobile_no_div").hide();
                        $("#send_otp_div").show();
                    }
                });
            }
        }

        function verifyOtp() {
            var otp = $('#otp').val();
            var code_id = $('#code_id').val();
            if (otp.length != 4) {
                alert("Please enter valid otp")
            } else {
                $.ajax({
                    cache: false,
                    type: 'POST',
                    data: {'otp': otp, 'code_id': code_id},
                    url: "<?php echo $verify_otp_url; ?>",
                    success: function (data) {
                        var json = $.parseJSON(data);
                        if (json.status == "Success") {
                            $("#div_contact").html(json.emergency_contacts_html);

                            $("#mobile_no_div").hide();
                            $("#send_otp_div").hide();
                            $("#view_detail_button").hide();
                            if (json.user_detail_url != "") {
//                                    window.location = json.user_detail_url;
                            }
                        } else {
                            $("#otp_err").text("Incorrect OTP");
                            $("#otp_err").show();

                        }
                    }
                });
            }
        }
        
         function riseMissingAlertModal() {
                            $('#rise_missing_alert_modal').modal('show');

         }
         function riseMissingAlert() {
           
            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();
            var mobile_number = $('#mobile_number').val();
            var code_id = $('#code_id').val();
               $('#rise_missing_alert_modal').modal('toggle');
            // $("#rise_missing_alert_modal").modal('hide');   
               $('#rise_missing_alert_modal').modal('hide');
                 $("#rise_missing_alert_modal").modal("hide");
            // if (mobile_no.length != 10) {
            //     alert("Please enter valid number")
            // } else {
                $.ajax({
                    cache: false,
                    type: 'POST',
                    data: {'first_name': first_name,'last_name':last_name , 'mobile_number':mobile_number,'code_id': code_id },
                    url: "<?php echo $missing_alert_url; ?>",
                    success: function (data) {
                        // $("#mobile_no_div").hide();
                        // $("#send_otp_div").show();
                    }
                });
            // }
        }
    </script>
</body>
</html>
