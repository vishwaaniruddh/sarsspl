 <meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" name="viewport">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<title>Welcome To | Lead Management</title>
<link rel="icon" type="image/x-icon" href="assets/img/logo.png"/>
<link rel="icon" href="assets/img/logo.png" type="image/png" sizes="16x16">
<link rel="stylesheet" href="assets/vendor/pace/pace.css">
<script src="assets/vendor/pace/pace.min.js"></script>
<!--vendors-->
<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
<link rel="stylesheet" type="text/css" href="assets/vendor/jquery-scrollbar/jquery.scrollbar.css">
<link rel="stylesheet" href="assets/vendor/select2/css/select2.min.css">
<link rel="stylesheet" href="assets/vendor/jquery-ui/jquery-ui.min.css">
<link rel="stylesheet" href="assets/vendor/daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="assets/vendor/timepicker/bootstrap-timepicker.min.css">
<link href="https://fonts.googleapis.com/css?family=Hind+Vadodara:400,500,600" rel="stylesheet">
<link rel="stylesheet" href="assets/fonts/jost/jost.css">
<!--Material Icons-->
<link rel="stylesheet" type="text/css" href="assets/fonts/materialdesignicons/materialdesignicons.min.css">
<!--Bootstrap + atmos Admin CSS-->
<link rel="stylesheet" type="text/css" href="assets/css/atmos.min.css">
<!-- Additional library for page -->
 <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  
      <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />


<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
} 

</script>


<script>
$(function(){
      $('input[type=text]').keyup(function(){
        var input_val = $(this).val();
        var inputRGEX = /^[a-zA-Z0-9!@#$%^&*(){};:<>,.-?/]*$/;
        var inputResult = inputRGEX.test(input_val);
          if(!(inputResult))
          {     
            this.value = this.value.replace(/[^a-zA-Z0-9!@#$%^&*(){};:<>,.?-/\s]/gi, '');
          }
       });
    });
</script>