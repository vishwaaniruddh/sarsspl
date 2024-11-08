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
        <div class="container mt-3">
            <div class="row mb-3">
                <div class="col-xs-4 col-sm-12 col-md-6 col-lg-8 col-xl-12">
                    <div class=" text-center">
                        <b >Send OTP</b>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row" id="mobile_no_div">
                <div class="col-xs-2 col-sm-6 col-md-3 col-lg-4 col-xl-6  mt-2  mb-2 pr-2">
                    <div class="text-right pr-5">
                        Enter mobile number
                    </div>
                </div>
                <div class="col-xs-2 col-sm-6 col-md-3 col-lg-4 col-xl-6">
                    <div class=" ">
                        <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                            <div class="  ">
                                <input type="text" name="mobile_no" id="mobile_no" />
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                            <div class="div_title  ">
                                <button type="button" class="btn btn-outline-primary" onclick="sendOtp()" > Send OTP </button>
                                <input type="hidden" name="code_id" id="code_id" value="<?php echo $code_id; ?>" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row" id="send_otp_div" style="display:none">
                <div class="col-xs-2 col-sm-6 col-md-3 col-lg-4 col-xl-6  mt-2  mb-2 pr-2">
                    <div class="text-right pr-5">
                        Enter otp
                    </div>
                </div>
                <div class="col-xs-2 col-sm-6 col-md-3 col-lg-4 col-xl-6">
                    <div class=" ">
                        <div class="col-md-4 col-lg-8 col-xl-12 mb-2">
                            <div class="  ">
                                <input type="text" name="otp" id="otp" />
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
        <br/>

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
            function sendOtp() {
                var mobile_no = $('#mobile_no').val();
                var code_id = $('#code_id').val();

                if (mobile_no.length != 10) {
                    alert("Please enter valid number")
                } else {
                    $.ajax({
                        cache: false,
                        type: 'POST',
                        data: {'mobile_number': mobile_no, 'code_id' : code_id, 'purpose' :4, 'active_platform':2},
                        url: "<?php echo $send_otp_url; ?>",
                        success: function (data) {
                            console.log("success");
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
                                if (json.user_detail_url != "") {
                                    window.location = json.user_detail_url;
                                }
                            }
                        }
                    });
                }
            }
        </script>
    </body>
</html>
