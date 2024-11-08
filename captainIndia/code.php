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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        <?php
            $code_id = "";
            if (isset($_GET['uid'])) {
                $code_id = $_GET['uid'];
            }
        ?>
        <div id="code_detail_div"></div>
        <script>
            var code_id = '<?php echo $code_id; ?>';
            if (code_id != "") {
                $.ajax({
                    url: 'https://uat.captainindia.anekalabs.com/backend/index.php/api/qrcodedetailbycode/'+code_id,
                    async: false,
                    data: {action: 'test'},
                    type: 'post',
                    success: function(output) {
                        $("#code_detail_div").html(output );
                    }
                });
            }
            function raiseMissingAlertModal() {
                $('#raise_missing_alert_modal').modal('show');
            }
        
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else { 
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
            navigator.geolocation.getCurrentPosition(function(position) {  
                console.log('allow');
                $('#latitude').val( position.coords.latitude);
                $('#longitude').val( position.coords.longitude);
                scanAlert();
            }, function() {
                console.log('deny');
                scanAlert();
            });
        function showPosition(position) {
//   x.innerHTML = "Latitude: " + position.coords.latitude + 
//   "<br>Longitude: " + position.coords.longitude;
 
            $('#latitude').val( position.coords.latitude);
            $('#longitude').val( position.coords.longitude);
            // scanAlert();
        }
        function scanAlert() {
            var user_id = $('#user_id').val();
            var qr_code_id = $('#qr_code_id').val();
            var latitude = $('#latitude').val();
            var longitude = $('#longitude').val();
            var missing_status = $('#missing_status').val();
            var code = $('#code').val();
            if (user_id !="") {
                $.ajax({
                    cache: false,
                    type: 'POST',
                    data: {'code_id': qr_code_id, 'latitude': latitude, 'longitude': longitude,'code': code, 'qr_code_user_id': user_id, 'missing_status': missing_status},
                    url:  'https://uat.captainindia.anekalabs.com/backend/index.php/api/addQrCodeScanAlert',
                    success: function (data) {
                        // 
                    },
                    error: function(){
                            // alert("failure");
                    }
                });
            }
        }

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
                    url: "https://uat.captainindia.anekalabs.com/backend/index.php/api/sendotpqrcode",
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
                    url: "https://uat.captainindia.anekalabs.com/backend/index.php/api/verifyotpsdqrcode",
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
        
        
           function raiseMissingAlert() {
            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();
            var mobile_number = $('#mobile_number').val();
            var code_id = $('#code_id').val();
            var latitude = $('#latitude').val();
            var longitude = $('#longitude').val();
            var missing_status = $('#missing_status').val();
            var code = $('#code').val();
            var user_id = $('#user_id').val();
            if (first_name == "") {
                alert("Please enter first name")
            } else if (last_name == "") {
                alert("Please enter last number")
            } else if (mobile_number.length != 10) {
                alert("Please enter valid number")
            } else {
                $("#raise_missing_alert_modal").modal("hide");
                $.ajax({
                    cache: false,
                    type: 'POST',
                    data: {'first_name': first_name, 'last_name':last_name , 'mobile_number':mobile_number,'code': code, 'code_id': code_id,
                    'latitude':latitude,'longitude':longitude, 'qr_code_user_id': user_id,'missing_status': missing_status   },
                
                    url:  'https://uat.captainindia.anekalabs.com/backend/index.php/api/addmissingalert',
                    success: function (data) {
                           alert("Missing alert submitted.")
                           $('#first_name').val("");
                           $('#last_name').val("");
                           $('#mobile_number').val("");
                    },
                    error: function(){
                            // alert("failure");
                    }
                });
            }
        }
        </script>
    </body>
</html>



