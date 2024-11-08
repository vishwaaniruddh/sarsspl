<!DOCTYPE html>
<html>
<head>
	<title>Shyambabadham</title>
	  <meta charset="utf-8">
      <meta name="robots" content="noindex">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="keywords" content="">
      <link rel="icon" href="../images/favicon.png" type="image/gif" sizes="16x16">
      <link href="https://fonts.googleapis.com/css?family=Raleway+Dots|Raleway:400,500,700,700i&display=swap&subset=latin-ext" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="../css/css_new/bootstrap.min.css">
      <script src="../js/jquery.min.js"></script>
      <script src="../js/popper.min.js"></script>
      <script src="../js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="../css/css_new/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="../css/css_new/style.css">
      
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  

      <script>
      function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
      
      
          jQuery(document).ready(function(){
    // This button will increment the value
    $('[data-quantity="plus"]').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('data-field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If is not undefined
        if (!isNaN(currentVal)) {
            // Increment
            $('input[name='+fieldName+']').val(currentVal + 1);
            
              var currentValnew = parseInt($('input[name='+fieldName+']').val());
             var amount =$("#amount").val();
             var totalAmount =currentValnew*50000;
            $("#amount").val("Rs. "+totalAmount);
            
            
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(1);
        }
    });
    // This button will decrement the value till 0
    $('[data-quantity="minus"]').click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('data-field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 1) {
            // Decrement one
            $('input[name='+fieldName+']').val(currentVal - 1);
            
            
             var currentValnew = parseInt($('input[name='+fieldName+']').val());
             var amount =$("#amount").val();
             var totalAmount =currentValnew*50000;
           $("#amount").val("Rs. "+totalAmount);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(1);
        }
    });
});


      </script>
      
      
       <script>
       function validation(){
           var val = document.getElementById("exampleCheck1").checked;
          
           if(val!=true){
               swal("Please Read & Accept Membership Agreement");
              
               return false;
           }
       }
           
           </script>
      
      
      
      
      
      <style>
    
.plus-minus-input {
  -webkit-align-items: center;
      -ms-flex-align: center;
          align-items: center;
}

.plus-minus-input .input-group-field {
  text-align: center;
  margin-left: 0.5rem;
  margin-right: 0.5rem;
     padding: 0.5rem;
    border-radius: 38px;
    width: 62px;
}

.plus-minus-input .input-group-field::-webkit-inner-spin-button,
.plus-minus-input .input-group-field ::-webkit-outer-spin-button {
  -webkit-appearance: none;
          appearance: none;
}

.plus-minus-input .input-group-button .circle {
  border-radius: 50%;
  padding: 0.25em 0.8em;
}


      </style>
      
</head>
<body>
<div class="container-fluid header">
         <ul class="nav justify-content-center hiddenxs">
            <li class="nav-item">
               <a class="nav-link active" href="index.html">Home</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="about_us.html">About Dham</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="facilities.html">Facilities</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="membership.php">Membership</a>
            </li>
            <li class="nav-item nav-img">
               <a class="nav-link " href="index.html">
                   <div class="logo">
                    <img class="logoimg" src="../images/SHYAM BABA LOGO130x130-16.png">
                  </div>
              </a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="mandir.html">Mandir</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="coming-soon.html">Committee</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="contact-us.html">Contact Us</a>
            </li>
            <li class="nav-item">
               <a class="nav-link lang-align" href="https://shyambabadham.com/"><button class="btn lang">हिन्दी</button></a>
            </li>

             
         </ul>

         <nav class="navbar navbar-expand-lg navbar-light  d-block d-sm-none">
            
            <div class="row">
              <div class="col-8">
              <a class="navbar-brand mobile-nav" href="index.html"><img src="../images/LOGO.png"></a>
            </div>
              <div class="col-2">
              <a class="navbar-brand mobile-nav" href="https://shyambabadham.com/"><button class="btn lang mt-3">हिन्दी</button></a>
            </div>
            <div class="col-2">
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            </div>
            </div>
            <div class="navbar-collapse collapse" id="navbarSupportedContent" style="">
               <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                     <a class="nav-link" href="index.html">Home</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="about_us.html">About Dham</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="facilities.html">Facilities</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="membership.php">Membership</a>
                   </li>
                  <li class="nav-item">
                     <a class="nav-link" href="mandir.html">Mandir</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="coming-soon.html">Committee</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="contact-us.html">Contact Us</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="https://shyambabadham.com/">हिन्दी</a>
                  </li>
               </ul>
            </div>
         </nav>
      </div>
    <div id="demo" class="carousel slide mainslider membershipeng " data-ride="carousel">
    <div class="carousel-inner">
    <div class="carousel-item active">
        <img src="../images/Contact-Banner.png" alt="Los Angeles" width="1100" height="500">
        <div class="carousel-caption">
			<div class="row">
        <div class="col-lg-12 col-6 text-left">
          <h3>Membership Details</h3>
          
          
        </div>
			</div>
        </div>   
    </div>
    </div>
</div>
<div class="container membership-content">
    <div class="row ">
      <div class="col-md-12 mt-5 mb-5 text-center">
      <!--<h2 class="membership-form">Membership Details</h2>-->
    </div>
  </div>
</div>
<div class="container mb-5">
  <div class="row">
    <div class="col-lg-12">
      <div class="container membershipform">
      <form action="../PHP_Bolt-master/Online_Donation_test.php" method="post" >
          <div id="member">
             <div id="member2">
             
             
             
            
              
              
                <div class="row">
                    <div class="col-lg-3"></div>
          <div class="col-lg-6">
            <div class="form-group">
            <h4 class="membership-form" align="center">Membership Details</h4>
            </div>
          
          <div class="form-group"><br />
                <h6 class="membership-form">Membership Amount Rs. 50,000/- per night</h6>
            </div>
          <br />
            <div class="row">
          <div class="col-lg-6">
                              <h6 class="membership-form">No. of Nights</h6>
                              
                                <!-- Change the `data-field` of buttons and `name` of input field's for multiple plus minus buttons-->
                <div class="input-group plus-minus-input">
                  <div class="input-group-button">
                    <button type="button" class="button hollow circle" data-quantity="minus" data-field="quantity">
                      <i class="fa fa-minus" aria-hidden="true"></i>
                    </button>
                  </div>
                  <input class="input-group-field" type="number"  name="quantity" style="font-size:21px;"  value="1"  >
                  <div class="input-group-button">
                    <button type="button" class="button hollow circle" data-quantity="plus" data-field="quantity">
                      <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>
                  </div>
                </div>


          </div>
          <div class="col-lg-6">
                  <h6 class="membership-form">Total Amount</h6>
              <div class="input-group plus-minus-input">
                  <input class="form-control" type="text" name="amount" id="amount" value="Rs. 50000" style="background:#ed0505;color:white;width:55% !important;flex: none;font-size: 21px;" border="none" readonly>
                </div>

          </div>
         
            
          </div>
          <hr />
          <br />
             <h5 class="membership-form">Personal Details</h5>
          
          
            <div class="form-group">
              <label for="exampleInputEmail1">First Name</label>
              <div class="input-group">
             <!-- <span class="input-group-addon"><i class="fa fa-globe"></i></span>-->
              <input type="text" class="form-control" id="fname" name="fname" aria-describedby="emailHelp" required>
              <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
              </div>
            </div>
            
              <div class="form-group">
              <label for="exampleInputEmail1">Last Name</label>
              <div class="input-group">
              <!--<span class="input-group-addon"><i class="fa fa-globe"></i></span>-->
              <input type="text" class="form-control" id="lname" name="lname" aria-describedby="emailHelp" required>
              <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
              </div>
            </div>
          
          
           <div class="form-group">
              <label for="exampleInputEmail1">Mobile Number</label>
              <div class="input-group">
             <!-- <span class="input-group-addon"><i class="fa fa-globe"></i></span>-->
              <input type="text" class="form-control" id="mobile" name="mobile" aria-describedby="emailHelp" onkeypress="return isNumber(event)" maxlength="10" required>
              <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
              </div>
            </div>
          
          
            <input type="button" onclick="window.open('../PHP_Bolt-master/Online_Donation_test.php');" class="btn more memberformsubmit float-left" value="Continue"> 
          </div>
          
          <div class="col-lg-3"></div>
          <!--  <div class="col-lg-6">
            <div class="form-group">
            <h4 class="membership-form" align="center">Membership Agreement</h4>
            </div>
           <div style="height:488px;overflow:auto;background-color:#fafafae8;scrollbar-base-color:gold;font-family:sans-serif;padding:10px;">
                 <ol>
            <li>General Check-in / Check-out Policy is as per below:
                a.Check-in time is 12 noon and check-out time is 10:00 am
                b.Subject to availability, early check-in and late check-out will be considered. Charges as applicable</li>
                <li>In case of cancelation of booking 48 hours prior to arrival (72 hours prior for some hotels) no cancellation charges apply. After which 1 nights retention will be applicable</li>
                <li>Amendment of bookings is allowed until only 48 hours prior to arrival (72 hours prior for some hotels). Please contact Keys Hotels customer care center at reservations@keyshotels.com Or call us on 1800 209 2299for any assistance.</li>
                <li>Please note that the above timeline and cancellation charges may vary depending on the hotel where the booking is made in accordance with the concerned hotel policy and the booking confirmation voucher issued. The Customer is therefore advised to check with the agents of the Keys Hotels customer care center in relation to the cancellation charges and timeline.</li>
                <li>Certain privileged booking rates or special offers are not eligible for cancellation, refund or any change. The Customer is therefore advised to check the room description and any such conditions carefully prior to making a booking. Keys Hotels shall not be liable to cancel or refund any monies or alter any bookings if booking are made under such privileged booking rates or special offers.</li>
                <li>Upon cancellation of booking, the refund of the booking amount will be initiated. The booking amount after deduction of cancellation charges and taxes, as applicable, will be credited into the bank account of the Customer using the same payment mode (i.e. debit card/ credit card/ net-banking) by which the booking was made by the Customer. The refund process may take 10-15 business days.</li>
                <li>In case the booking amount is paid using credit card, the refund will be processed on the credit card.</li>
                <li>Children up-to 5 Years of age can stay free (cribs subject to availability). Additional charges may be applicable for children between 5 and 12 years. 13 years will be charged as per extra adult rate.
                </li>
                <li>In keeping with our heightened security procedures we request you to provide your photo-identity proof while checking-in. Indian Nationals can present any of the following which is mandatory: Passport, Driving License, Voter ID Card, Pan Card. Foreign Nationals are required to present their passport and valid visa.</li>
        </ol>
        <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">I hereby agree to the <b>Terms &#38; Conditions</b></label>
            </div>
            </div>-->
            
            <br />
           <!--  <input type="submit" class="btn more memberformsubmit float-left" value="Continue"> -->
            
          <!--</div>-->
            
          </div>
              
              
              
              
              
        
         
        
          </div>
          
          </div>

            
            
           
          </form>
        
        </div>
        </div>
    </div>
    
  </div>
  
</div>


 <?php include('../en/footer_english.php') ?>
      <script>
$(document).ready(function(){
    var i=0;
  $("#addmember").click(function(){
    
    //  $("#member").append('<div class="row"><div class="col-lg-12"><h5>Contribution for another Member</h5></div></div>');
    
    $("#member").append($("#member2").children().clone());
  });
});

      </script>


</body>
</html>