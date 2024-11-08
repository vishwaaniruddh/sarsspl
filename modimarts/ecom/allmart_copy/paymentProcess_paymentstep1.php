<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php include("mainPage_paymentProcess.php");?>
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
}

* {
  box-sizing: border-box;
}

/* style the container */
.containers {
  position: relative;
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px 0 30px 0;
      width: 86%;
} 

/* style inputs and link buttons */
/*input,
.btn {
  width: 100%;
  padding: 12px;
  border: none;
  border-radius: 4px;
  margin: 5px 0;
  opacity: 0.85;
  display: inline-block;
  font-size: 17px;
  line-height: 20px;
  text-decoration: none; 
}*/

.btn {
    text-align:center;
  width: 100%;
  padding: 7px;
  border: none;
  border-radius: 4px;
  margin: 5px 0;
  opacity: 0.85;
  display: inline-block;
  font-size: 17px;
  line-height: 20px;
  text-decoration: none; 
}

.inpt{
    width: 100%;
  padding: 7px;
  border: none;
  border-radius: 4px;
  margin: 3px 0;
  opacity: 0.85;
  display: inline-block;
  font-size: 14px;
  line-height: 20px;
  text-decoration: none; 
}
input:hover,
.btn:hover {
  opacity: 1;
}
/* add appropriate colors to fb, twitter and google buttons */
.fb {
 background-color: #3B5998;
  color: white;
}
.twitter {
  background-color: #55ACEE;
  color: white;
}
.google {
  background-color: #dd4b39;
  color: white;
}
/* style the submit button */
input[type=button] {
  background-color: #4CAF50;
  color: white;
  cursor: pointer;
}
input[type=button]:hover {
  background-color: #45a049;
}
/* Two-column layout */
.col {
  float: left;
  width: 50%;
  margin: auto;
  padding: 0 50px;
  margin-top: 6px;
}
/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
/* vertical line */
.vl {
  position: absolute;
  left: 50%;
  transform: translate(-50%);
  border: 2px solid #ddd;
  height: 175px;
}
/* text inside the vertical line */
.vl-innertext {
  position: absolute;
  top: 50%;
  transform: translate(-50%, -50%);
background-color: #f1f1f1;
  border: 1px solid #ccc;
  border-radius: 50%;
  padding: 8px 10px;
}
/* hide some text on medium and large screens */
.hide-md-lg {
  display: none;
}
/* bottom container */
.bottom-container {
  text-align: center;
  background-color: #666;
  border-radius: 0px 0px 4px 4px;
    width: 86%;
}
a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

/* Responsive layout - when the screen is less than 650px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 650px) {
  .col {
    width: 100%;
    margin-top: 0;
  }
  /* hide the vertical line */
  .vl {
    display: none;
  }
  /* show the hidden text on small screens */
  .hide-md-lg {
    display: block;
    text-align: center;
  }
}
</style>
</head>
<body>
<div class="containers">
  <form >
    <div class="row">
      <div class="vl">
        <span class="vl-innertext">~</span>
      </div>
      <div class="col">
        <a href="#" onclick="a()" class="fb btn">
          <i class="fa fa-user-circle-o"></i> Login 
         </a>
        <a href="#" onclick="b()" class="twitter btn">
          <i class="fa fa-user-secret"></i> Sign Up
        </a>
        <a href="#" onclick="b()" class="google btn"><i class="fa fa-google fa-fw">
          </i> Guest User
        </a>
      </div>

      <div class="col">
        <div class="hide-md-lg">
          <p>Or sign in manually:</p>
        </div>
<div id="Login" >
        <input type="text" name="L_username" id="L_username" class="inpt" placeholder="Email / Mobile no" >
        <input type="password" name="L_pass" id="L_pass" class="inpt" placeholder="Password" >
        <input type="button" class="btn" onclick="LoginFunction('login')" value="Login">
        <div >
           <a href="#"  class="btn">Forgot password?</a>
        </div>
</div>        
     
<div id="Guest" style="display:none">
        <input type="text" name="G_email" id="G_email" class="inpt" placeholder="Email-ID" >
        <input type="password" name="G_mob" id="G_mob" class="inpt" maxlength=10 placeholder="Mobile No." >
        <input type="button" class="btn" onclick="LoginFunction('guest')" value="Login">
        <br /> <br /> <br />
        
</div>        
        
        
      </div>
      
    </div>
  </form>
</div>







<!--================================================================================-->

<style>


* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.containers {
  background-color: #f2f2f2;
  padding: 5px 20px 0px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

.textboxLogin {
  width: 100%;
  margin-bottom: 10px;
  
  border: 1px solid #ccc;
  border-radius: 3px;
}


/*
input[type=text] {
  width: 100%;
  margin-bottom: 10px;
  
  border: 1px solid #ccc;
  border-radius: 3px;
}*/

input[type=password] {
  width: 100%;
  margin-bottom: 10px;
  padding: 6px;
  border: 1px solid #ccc;
  border-radius: 3px;
}


label {
  margin-bottom: 5px;
  display: block;
}


.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}


a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
</style>


<div class="row" id="HD_address" style="display:none">
  <div class="col-75">
    <div class="containers">
      <form action="/action_page.php">
      
        <div class="row">
          <div class="col-50">
            <h3>Delivery Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="firstname" class="textboxLogin"  placeholder="John M. Doe">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" class="textboxLogin" placeholder="john@example.com">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" class="textboxLogin" placeholder="542 W. 15th Street">
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" class="textboxLogin" name="city" placeholder="New York">

            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" class="textboxLogin" name="state" placeholder="NY">
              </div>
              <div class="col-50">
                <label for="zip">Zip</label>
                <input type="text" id="zip" name="zip" class="textboxLogin" placeholder="10001">
              </div>
            </div>
          </div>



<div class="col-50">
            
            <label for="cname">Plot No.</label>
            <input type="text" id="cname" name="cardname" class="textboxLogin" placeholder="John More Doe">
            <label for="ccnum">Wing No.</label>
            <input type="text" id="ccnum" name="cardnumber" class="textboxLogin" placeholder="1111-2222-3333-4444">
            <label for="expmonth">Building Name</label>
            <input type="text" id="expmonth" name="expmonth" class="textboxLogin" placeholder="September">
            <div class="row">
              <div class="col-50">
                <label for="expyear">Road No.</label>
                <input type="text" id="expyear" name="expyear" class="textboxLogin" placeholder="2018">
              </div>
              <div class="col-50">
                <label for="cvv">LandMark</label>
                <input type="text" id="LandMark" name="LandMark" class="textboxLogin" placeholder="352">
              </div>
              <div class="col-50">
                <label for="cvv">Locality</label>
                <input type="text" id="Locality" name="Locality" class="textboxLogin" placeholder="352">
              </div>
              <div class="col-50">
                <label for="cvv">City</label>
                <input type="text" id="City" name="City" class="textboxLogin" placeholder="352">
              </div>
              <div class="col-50">
                <label for="cvv">Pincode</label>
                <input type="text" id="Pincode" name="Pincode" class="textboxLogin" placeholder="352">
              </div>
            </div>
          </div>

          <!--<div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="John More Doe">
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="September">
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2018">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352">
              </div>
            </div>
          </div>-->
          
        </div>
        <label>
          <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
        </label>
        <input type="submit" value="Continue to checkout" class="btn">
      </form>
    </div>
  </div>
</div>
</body>
</html>
