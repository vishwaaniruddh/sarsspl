<html dir="ltr" class="ltr" lang="en">
    <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Shopping Cart</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="requiredfunctions.js"></script>
             	<link href="image/catalog/cart.png" rel="icon" />
    	                <link href="catalog/view/theme/pav_bigstore/stylesheet/bootstrap.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/stylesheet.css" rel="stylesheet" />
               
              
                <link href="catalog/view/javascript/jquery/colorpicker/css/colorpicker.css" rel="stylesheet" />
                <link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/animate.css" rel="stylesheet" />
                <link href="catalog/view/javascript/jquery/magnific/magnific-popup.css" rel="stylesheet" />
           
                <link href="catalog/view/javascript/jquery/owl-carousel/owl.carousel.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/fonts.css" rel="stylesheet" />
                <link href="catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/pavnewsletter.css" rel="stylesheet" />
              
                  	  <script type="text/javascript" src="catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/bootstrap/js/bootstrap.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/common.js"></script>
                <script type="text/javascript" src="catalog/view/theme/pav_bigstore/javascript/common.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/pavdeals/countdown.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/colorpicker/js/colorpicker.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/datetimepicker/moment.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js"></script> 
    <!-- FONT -->

        <!-- FONT -->
<script>
function remfromcart2(cartid)
{
  try
{
   //alert("this2");
$.ajax({
   type: 'POST',    
url:'remvcart.php',
data:'cartid='+cartid,

success: function(msg){
//alert(msg);
if(msg==2)
{
   // alert("sorry your session has been expired");
   toastfunc("sorry your session has been expired");
}
else if(msg==1)
{
 //toastfunc();
 toastfunc("Product removed from cart");
 showcartdetails();
}
else
{
toastfunc("Error removing from cart");
}
updatecart();
  //document.getElementById('show').innerHTML=msg;
         }
     });

}catch(exc)
{
alert(exc);
}  
    
}

var bl=true;
function qtfchk(qtyid)
{
    try
    {
        var chkqt=document.getElementById(qtyid).value;
        
        if(chkqt=="")
        {
            
           bl=false;
           toastfunc("Quantity must be greater than 0");
            
        }
       
    
    }catch(exc)
    {
       //alert(exc); 
    }
    return bl;
}


function process(v,row,cart,qt){
    
    
    var value = parseInt(document.getElementById('nwqty'+row).value);

    if (value > 0) {
           value+=v;
        } else{
            value=1;
        }
    if(value=='0') {
            value=1;
        }
    
    document.getElementById('nwqty'+row).value = value;
    updtfn(cart,qt)
}


function updtfn(cartid,qtyid)
{
  try
{
    if(qtfchk(qtyid))
    {
 //alert("this2");
   var qtyn=document.getElementById(qtyid).value;

   
$.ajax({
   type: 'POST',    
url:'updtcrtfromcart.php',
data:'cartid='+cartid+'&qtyn='+qtyn,

success: function(msg){
//alert(msg);
if(msg==2)
{
   // alert("sorry your session has been expired");
   toastfunc("sorry your session has been expired");
}
else if(msg==3)
{
    toastfunc("Product is out of stock");
}
else if(msg==1)
{
 //toastfunc();
 toastfunc("cart updated");
 showcartdetails();
}
else
{
toastfunc("Error updating cart");
}
updatecart();
  //document.getElementById('show').innerHTML=msg;
         }
     });
}
}catch(exc)
{
alert(exc);
}  
    
}

function showcartdetails()
{
try
{
 // alert("ok");
$.ajax({
   type: 'POST',    
url:'cartpagesearch.php',
data:'',

success: function(msg){
    //alert(msg);
    if(msg!="")
    {
         document.getElementById('cartdets').innerHTML=msg;
        document.getElementById('accordion').style.display='block';
    }else
    {
        document.getElementById('accordion').style.display='none'; 
        document.getElementById('cartdets').innerHTML="<center><b>Your Cart is empty<b></center>";
    }
   
    updatecart();
         }
     });

}catch(exc)
{
    alert(exc);
}
}
</script>
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


<script>
function testing(){
    alert("fuck")
}
</script>
      </head>
  <body class="checkout-cart page-checkout-cart layout-fullwidth" onload="showcartdetails();">
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
    <div id="header-bot" class="hidden-xs hidden-sm">
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
  <ul class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i></a></li>
        <li><a href="cart.php">Shopping Cart</a></li>
      </ul>
        <div class="row" >              
        <div id="content" class="col-sm-12" >     
       
      <form action="" method="post" enctype="multipart/form-data">
        <div class="table-responsive" id="cartdets">
        
        </div>
      </form>
          
            <br />
     
     <div class="panel-group" id="accordion" style="display:none;">
        <!---  <h2>What would you like to do next?</h2>
      <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
               <div class="panel panel-default">
  <div class="panel-heading">
    <h4 class="panel-title"><a href="#collapse-coupon" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion">Use Coupon Code <i class="fa fa-caret-down"></i></a></h4>
  </div>
  <div id="collapse-coupon" class="panel-collapse collapse">
    <div class="panel-body">
      <label class="col-sm-2 control-label" for="input-coupon">Enter your coupon here</label>
      <div class="input-group">
        <input type="text" name="coupon" value="" placeholder="Enter your coupon here" id="input-coupon" class="form-control" />
        <span class="input-group-btn">
        <input type="button" value="Apply Coupon" id="button-coupon" data-loading-text="Loading..."  class="btn btn-primary" />
        </span></div>
      <script type="text/javascript">
$('#button-coupon').on('click', function() {
	$.ajax({
		url: 'index.php?route=extension/total/coupon/coupon',
		type: 'post',
		data: 'coupon=' + encodeURIComponent($('input[name=\'coupon\']').val()),
		dataType: 'json',
		beforeSend: function() {
			$('#button-coupon').button('loading');
		},
		complete: function() {
			$('#button-coupon').button('reset');
		},
		success: function(json) {
			$('.alert').remove();

			if (json['error']) {
				$('.breadcrumb').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

				$('html, body').animate({ scrollTop: 0 }, 'slow');
			}

			if (json['redirect']) {
				location = json['redirect'];
			}
		}
	});
});
</script>
    </div>
  </div>
</div>
                <div class="panel panel-default">
  <div class="panel-heading">
    <h4 class="panel-title"><a href="#collapse-shipping" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion">Estimate Shipping &amp; Taxes <i class="fa fa-caret-down"></i></a></h4>
  </div>
  <div id="collapse-shipping" class="panel-collapse collapse">
    <div class="panel-body">
      <p>Enter your destination to get a shipping estimate.</p>
      <div class="form-horizontal">
        <div class="form-group required">
          <label class="col-sm-2 control-label" for="input-country">Country</label>
          <div class="col-sm-10">
            <select name="country_id" id="input-country" class="form-control">
              <option value=""> --- Please Select --- </option>
                                          <option value="244">Aaland Islands</option>
                                                        <option value="1">Afghanistan</option>
                                                        <option value="2">Albania</option>
                                                        <option value="3">Algeria</option>
                                                        <option value="4">American Samoa</option>
                                                        <option value="5">Andorra</option>
                                                        <option value="6">Angola</option>
                                                        <option value="7">Anguilla</option>
                                                        <option value="8">Antarctica</option>
                                                        <option value="9">Antigua and Barbuda</option>
                                                        <option value="10">Argentina</option>
                                                        <option value="11">Armenia</option>
                                                        <option value="12">Aruba</option>
                                                        <option value="252">Ascension Island (British)</option>
                                                        <option value="13">Australia</option>
                                                        <option value="14">Austria</option>
                                                        <option value="15">Azerbaijan</option>
                                                        <option value="16">Bahamas</option>
                                                        <option value="17">Bahrain</option>
                                                        <option value="18">Bangladesh</option>
                                                        <option value="19">Barbados</option>
                                                        <option value="20">Belarus</option>
                                                        <option value="21">Belgium</option>
                                                        <option value="22">Belize</option>
                                                        <option value="23">Benin</option>
                                                        <option value="24">Bermuda</option>
                                                        <option value="25">Bhutan</option>
                                                        <option value="26">Bolivia</option>
                                                        <option value="245">Bonaire, Sint Eustatius and Saba</option>
                                                        <option value="27">Bosnia and Herzegovina</option>
                                                        <option value="28">Botswana</option>
                                                        <option value="29">Bouvet Island</option>
                                                        <option value="30">Brazil</option>
                                                        <option value="31">British Indian Ocean Territory</option>
                                                        <option value="32">Brunei Darussalam</option>
                                                        <option value="33">Bulgaria</option>
                                                        <option value="34">Burkina Faso</option>
                                                        <option value="35">Burundi</option>
                                                        <option value="36">Cambodia</option>
                                                        <option value="37">Cameroon</option>
                                                        <option value="38">Canada</option>
                                                        <option value="251">Canary Islands</option>
                                                        <option value="39">Cape Verde</option>
                                                        <option value="40">Cayman Islands</option>
                                                        <option value="41">Central African Republic</option>
                                                        <option value="42">Chad</option>
                                                        <option value="43">Chile</option>
                                                        <option value="44">China</option>
                                                        <option value="45">Christmas Island</option>
                                                        <option value="46">Cocos (Keeling) Islands</option>
                                                        <option value="47">Colombia</option>
                                                        <option value="48">Comoros</option>
                                                        <option value="49">Congo</option>
                                                        <option value="50">Cook Islands</option>
                                                        <option value="51">Costa Rica</option>
                                                        <option value="52">Cote D'Ivoire</option>
                                                        <option value="53">Croatia</option>
                                                        <option value="54">Cuba</option>
                                                        <option value="246">Curacao</option>
                                                        <option value="55">Cyprus</option>
                                                        <option value="56">Czech Republic</option>
                                                        <option value="237">Democratic Republic of Congo</option>
                                                        <option value="57">Denmark</option>
                                                        <option value="58">Djibouti</option>
                                                        <option value="59">Dominica</option>
                                                        <option value="60">Dominican Republic</option>
                                                        <option value="61">East Timor</option>
                                                        <option value="62">Ecuador</option>
                                                        <option value="63">Egypt</option>
                                                        <option value="64">El Salvador</option>
                                                        <option value="65">Equatorial Guinea</option>
                                                        <option value="66">Eritrea</option>
                                                        <option value="67">Estonia</option>
                                                        <option value="68">Ethiopia</option>
                                                        <option value="69">Falkland Islands (Malvinas)</option>
                                                        <option value="70">Faroe Islands</option>
                                                        <option value="71">Fiji</option>
                                                        <option value="72">Finland</option>
                                                        <option value="74">France, Metropolitan</option>
                                                        <option value="75">French Guiana</option>
                                                        <option value="76">French Polynesia</option>
                                                        <option value="77">French Southern Territories</option>
                                                        <option value="126">FYROM</option>
                                                        <option value="78">Gabon</option>
                                                        <option value="79">Gambia</option>
                                                        <option value="80">Georgia</option>
                                                        <option value="81">Germany</option>
                                                        <option value="82">Ghana</option>
                                                        <option value="83">Gibraltar</option>
                                                        <option value="84">Greece</option>
                                                        <option value="85">Greenland</option>
                                                        <option value="86">Grenada</option>
                                                        <option value="87">Guadeloupe</option>
                                                        <option value="88">Guam</option>
                                                        <option value="89">Guatemala</option>
                                                        <option value="256">Guernsey</option>
                                                        <option value="90">Guinea</option>
                                                        <option value="91">Guinea-Bissau</option>
                                                        <option value="92">Guyana</option>
                                                        <option value="93">Haiti</option>
                                                        <option value="94">Heard and Mc Donald Islands</option>
                                                        <option value="95">Honduras</option>
                                                        <option value="96">Hong Kong</option>
                                                        <option value="97">Hungary</option>
                                                        <option value="98">Iceland</option>
                                                        <option value="99" selected="selected">India</option>
                                                        <option value="100">Indonesia</option>
                                                        <option value="101">Iran (Islamic Republic of)</option>
                                                        <option value="102">Iraq</option>
                                                        <option value="103">Ireland</option>
                                                        <option value="254">Isle of Man</option>
                                                        <option value="104">Israel</option>
                                                        <option value="105">Italy</option>
                                                        <option value="106">Jamaica</option>
                                                        <option value="107">Japan</option>
                                                        <option value="257">Jersey</option>
                                                        <option value="108">Jordan</option>
                                                        <option value="109">Kazakhstan</option>
                                                        <option value="110">Kenya</option>
                                                        <option value="111">Kiribati</option>
                                                        <option value="253">Kosovo, Republic of</option>
                                                        <option value="114">Kuwait</option>
                                                        <option value="115">Kyrgyzstan</option>
                                                        <option value="116">Lao People's Democratic Republic</option>
                                                        <option value="117">Latvia</option>
                                                        <option value="118">Lebanon</option>
                                                        <option value="119">Lesotho</option>
                                                        <option value="120">Liberia</option>
                                                        <option value="121">Libyan Arab Jamahiriya</option>
                                                        <option value="122">Liechtenstein</option>
                                                        <option value="123">Lithuania</option>
                                                        <option value="124">Luxembourg</option>
                                                        <option value="125">Macau</option>
                                                        <option value="127">Madagascar</option>
                                                        <option value="128">Malawi</option>
                                                        <option value="129">Malaysia</option>
                                                        <option value="130">Maldives</option>
                                                        <option value="131">Mali</option>
                                                        <option value="132">Malta</option>
                                                        <option value="133">Marshall Islands</option>
                                                        <option value="134">Martinique</option>
                                                        <option value="135">Mauritania</option>
                                                        <option value="136">Mauritius</option>
                                                        <option value="137">Mayotte</option>
                                                        <option value="138">Mexico</option>
                                                        <option value="139">Micronesia, Federated States of</option>
                                                        <option value="140">Moldova, Republic of</option>
                                                        <option value="141">Monaco</option>
                                                        <option value="142">Mongolia</option>
                                                        <option value="242">Montenegro</option>
                                                        <option value="143">Montserrat</option>
                                                        <option value="144">Morocco</option>
                                                        <option value="145">Mozambique</option>
                                                        <option value="146">Myanmar</option>
                                                        <option value="147">Namibia</option>
                                                        <option value="148">Nauru</option>
                                                        <option value="149">Nepal</option>
                                                        <option value="150">Netherlands</option>
                                                        <option value="151">Netherlands Antilles</option>
                                                        <option value="152">New Caledonia</option>
                                                        <option value="153">New Zealand</option>
                                                        <option value="154">Nicaragua</option>
                                                        <option value="155">Niger</option>
                                                        <option value="156">Nigeria</option>
                                                        <option value="157">Niue</option>
                                                        <option value="158">Norfolk Island</option>
                                                        <option value="112">North Korea</option>
                                                        <option value="159">Northern Mariana Islands</option>
                                                        <option value="160">Norway</option>
                                                        <option value="161">Oman</option>
                                                        <option value="162">Pakistan</option>
                                                        <option value="163">Palau</option>
                                                        <option value="247">Palestinian Territory, Occupied</option>
                                                        <option value="164">Panama</option>
                                                        <option value="165">Papua New Guinea</option>
                                                        <option value="166">Paraguay</option>
                                                        <option value="167">Peru</option>
                                                        <option value="168">Philippines</option>
                                                        <option value="169">Pitcairn</option>
                                                        <option value="170">Poland</option>
                                                        <option value="171">Portugal</option>
                                                        <option value="172">Puerto Rico</option>
                                                        <option value="173">Qatar</option>
                                                        <option value="174">Reunion</option>
                                                        <option value="175">Romania</option>
                                                        <option value="176">Russian Federation</option>
                                                        <option value="177">Rwanda</option>
                                                        <option value="178">Saint Kitts and Nevis</option>
                                                        <option value="179">Saint Lucia</option>
                                                        <option value="180">Saint Vincent and the Grenadines</option>
                                                        <option value="181">Samoa</option>
                                                        <option value="182">San Marino</option>
                                                        <option value="183">Sao Tome and Principe</option>
                                                        <option value="184">Saudi Arabia</option>
                                                        <option value="185">Senegal</option>
                                                        <option value="243">Serbia</option>
                                                        <option value="186">Seychelles</option>
                                                        <option value="187">Sierra Leone</option>
                                                        <option value="188">Singapore</option>
                                                        <option value="189">Slovak Republic</option>
                                                        <option value="190">Slovenia</option>
                                                        <option value="191">Solomon Islands</option>
                                                        <option value="192">Somalia</option>
                                                        <option value="193">South Africa</option>
                                                        <option value="194">South Georgia &amp; South Sandwich Islands</option>
                                                        <option value="113">South Korea</option>
                                                        <option value="248">South Sudan</option>
                                                        <option value="195">Spain</option>
                                                        <option value="196">Sri Lanka</option>
                                                        <option value="249">St. Barthelemy</option>
                                                        <option value="197">St. Helena</option>
                                                        <option value="250">St. Martin (French part)</option>
                                                        <option value="198">St. Pierre and Miquelon</option>
                                                        <option value="199">Sudan</option>
                                                        <option value="200">Suriname</option>
                                                        <option value="201">Svalbard and Jan Mayen Islands</option>
                                                        <option value="202">Swaziland</option>
                                                        <option value="203">Sweden</option>
                                                        <option value="204">Switzerland</option>
                                                        <option value="205">Syrian Arab Republic</option>
                                                        <option value="206">Taiwan</option>
                                                        <option value="207">Tajikistan</option>
                                                        <option value="208">Tanzania, United Republic of</option>
                                                        <option value="209">Thailand</option>
                                                        <option value="210">Togo</option>
                                                        <option value="211">Tokelau</option>
                                                        <option value="212">Tonga</option>
                                                        <option value="213">Trinidad and Tobago</option>
                                                        <option value="255">Tristan da Cunha</option>
                                                        <option value="214">Tunisia</option>
                                                        <option value="215">Turkey</option>
                                                        <option value="216">Turkmenistan</option>
                                                        <option value="217">Turks and Caicos Islands</option>
                                                        <option value="218">Tuvalu</option>
                                                        <option value="219">Uganda</option>
                                                        <option value="220">Ukraine</option>
                                                        <option value="221">United Arab Emirates</option>
                                                        <option value="222">United Kingdom</option>
                                                        <option value="223">United States</option>
                                                        <option value="224">United States Minor Outlying Islands</option>
                                                        <option value="225">Uruguay</option>
                                                        <option value="226">Uzbekistan</option>
                                                        <option value="227">Vanuatu</option>
                                                        <option value="228">Vatican City State (Holy See)</option>
                                                        <option value="229">Venezuela</option>
                                                        <option value="230">Viet Nam</option>
                                                        <option value="231">Virgin Islands (British)</option>
                                                        <option value="232">Virgin Islands (U.S.)</option>
                                                        <option value="233">Wallis and Futuna Islands</option>
                                                        <option value="234">Western Sahara</option>
                                                        <option value="235">Yemen</option>
                                                        <option value="238">Zambia</option>
                                                        <option value="239">Zimbabwe</option>
                                        </select>
          </div>
        </div>
        <div class="form-group required">
          <label class="col-sm-2 control-label" for="input-zone">Region / State</label>
          <div class="col-sm-10">
            <select name="zone_id" id="input-zone" class="form-control">
            </select>
          </div>
        </div>
        <div class="form-group required">
          <label class="col-sm-2 control-label" for="input-postcode">Post Code</label>
          <div class="col-sm-10">
            <input type="text" name="postcode" value="" placeholder="Post Code" id="input-postcode" class="form-control" />
          </div>
        </div>
        <button type="button" id="button-quote" data-loading-text="Loading..." class="btn btn-primary">Get Quotes</button>
      </div>
      <script type="text/javascript">
$('#button-quote').on('click', function() {
	$.ajax({
		url: 'index.php?route=extension/total/shipping/quote',
		type: 'post',
		data: 'country_id=' + $('select[name=\'country_id\']').val() + '&zone_id=' + $('select[name=\'zone_id\']').val() + '&postcode=' + encodeURIComponent($('input[name=\'postcode\']').val()),
		dataType: 'json',
		beforeSend: function() {
			$('#button-quote').button('loading');
		},
		complete: function() {
			$('#button-quote').button('reset');
		},
		success: function(json) {
			$('.alert, .text-danger').remove();

			if (json['error']) {
				if (json['error']['warning']) {
					$('.breadcrumb').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

					$('html, body').animate({ scrollTop: 0 }, 'slow');
				}

				if (json['error']['country']) {
					$('select[name=\'country_id\']').after('<div class="text-danger">' + json['error']['country'] + '</div>');
				}

				if (json['error']['zone']) {
					$('select[name=\'zone_id\']').after('<div class="text-danger">' + json['error']['zone'] + '</div>');
				}

				if (json['error']['postcode']) {
					$('input[name=\'postcode\']').after('<div class="text-danger">' + json['error']['postcode'] + '</div>');
				}
			}

			if (json['shipping_method']) {
				$('#modal-shipping').remove();

				html  = '<div id="modal-shipping" class="modal">';
				html += '  <div class="modal-dialog">';
				html += '    <div class="modal-content">';
				html += '      <div class="modal-header">';
				html += '        <h4 class="modal-title">Please select the preferred shipping method to use on this order.</h4>';
				html += '      </div>';
				html += '      <div class="modal-body">';

				for (i in json['shipping_method']) {
					html += '<p><strong>' + json['shipping_method'][i]['title'] + '</strong></p>';

					if (!json['shipping_method'][i]['error']) {
						for (j in json['shipping_method'][i]['quote']) {
							html += '<div class="radio">';
							html += '  <label>';

							if (json['shipping_method'][i]['quote'][j]['code'] == '') {
								html += '<input type="radio" name="shipping_method" value="' + json['shipping_method'][i]['quote'][j]['code'] + '" checked="checked" />';
							} else {
								html += '<input type="radio" name="shipping_method" value="' + json['shipping_method'][i]['quote'][j]['code'] + '" />';
							}

							html += json['shipping_method'][i]['quote'][j]['title'] + ' - ' + json['shipping_method'][i]['quote'][j]['text'] + '</label></div>';
						}
					} else {
						html += '<div class="alert alert-danger">' + json['shipping_method'][i]['error'] + '</div>';
					}
				}

				html += '      </div>';
				html += '      <div class="modal-footer">';
				html += '        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';

								html += '        <input type="button" value="Apply Shipping" id="button-shipping" data-loading-text="Loading..." class="btn btn-primary" disabled="disabled" />';
				
				html += '      </div>';
				html += '    </div>';
				html += '  </div>';
				html += '</div> ';

				$('body').append(html);

				$('#modal-shipping').modal('show');

				$('input[name=\'shipping_method\']').on('change', function() {
					$('#button-shipping').prop('disabled', false);
				});
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

/*$(document).delegate('#button-shipping', 'click', function() {
	$.ajax({
		url: 'index.php?route=extension/total/shipping/shipping',
		type: 'post',
		data: 'shipping_method=' + encodeURIComponent($('input[name=\'shipping_method\']:checked').val()),
		dataType: 'json',
		beforeSend: function() {
			$('#button-shipping').button('loading');
		},
		complete: function() {
			$('#button-shipping').button('reset');
		},
		success: function(json) {
			$('.alert').remove();

			if (json['error']) {
				$('.breadcrumb').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

				$('html, body').animate({ scrollTop: 0 }, 'slow');
			}

			if (json['redirect']) {
				location = json['redirect'];
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});
</script>
<script type="text/javascript">
/*$('select[name=\'country_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=extension/total/shipping/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
		},
		complete: function() {
			$('.fa-spin').remove();
		},
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('input[name=\'postcode\']').parent().parent().addClass('required');
			} else {
				$('input[name=\'postcode\']').parent().parent().removeClass('required');
			}

			html = '<option value=""> --- Please Select --- </option>';

			if (json['zone'] && json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
					html += '<option value="' + json['zone'][i]['zone_id'] + '"';

					if (json['zone'][i]['zone_id'] == '') {
						html += ' selected="selected"';
					}

					html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"> --- None --- </option>';
			}

			$('select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'country_id\']').trigger('change');*/
</script>
    </div>
  </div>
</div>
                <!--<div class="panel panel-default">
  <div class="panel-heading">
    <h4 class="panel-title"><a href="#collapse-voucher" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Use Gift Certificate <i class="fa fa-caret-down"></i></a></h4>
  </div>
  <div id="collapse-voucher" class="panel-collapse collapse">
    <div class="panel-body">
      <label class="col-sm-2 control-label" for="input-voucher">Enter your gift certificate code here</label>
      <div class="input-group">
        <input type="text" name="voucher" value="" placeholder="Enter your gift certificate code here" id="input-voucher" class="form-control" />
        <span class="input-group-btn">
        <input type="submit" value="Apply Gift Certificate" id="button-voucher" data-loading-text="Loading..."  class="btn btn-primary" />
        </span> </div>
      <script type="text/javascript">
$('#button-voucher').on('click', function() {
  $.ajax({
    url: 'index.php?route=extension/total/voucher/voucher',
    type: 'post',
    data: 'voucher=' + encodeURIComponent($('input[name=\'voucher\']').val()),
    dataType: 'json',
    beforeSend: function() {
      $('#button-voucher').button('loading');
    },
    complete: function() {
      $('#button-voucher').button('reset');
    },
    success: function(json) {
      $('.alert').remove();

      if (json['error']) {
        $('.breadcrumb').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

        $('html, body').animate({ scrollTop: 0 }, 'slow');
      }

      if (json['redirect']) {
        location = json['redirect'];
      }
    }
  });
});
</script>
    </div>
  </div>
</div>-->
              
              
               <div class="buttons clearfix">
        <div class="pull-left"><a href="index.php" class="btn btn-default">Continue Shopping</a></div>
       <!-- <div class="pull-right"><a href="Checkout.php" class="btn btn-primary">Checkout</a></div>-->
       <div class="pull-right"><a href="paymentProcess.php" class="btn btn-primary">Checkout</a></div>
      </div>
              
              </div>
     
     
      </div>
    </div>
</div>

<!--
  $ospans: allow overrides width of columns base on thiers indexs. format array( column-index=>span number ), example array( 1=> 3 )[value from 1->12]
 -->



 
<footer id="footer" class="nostylingboxs">
 
  

  <?php include("footer.php")?>

</footer>
 
 
<!--<div id="powered">
  <?php include('footerbottom.php')?>

</div>-->
<script type="text/javascript">
$(document).ready( function (){
	$(".paneltool .panelbutton").click( function(){	
		$(this).parent().toggleClass("active");
	} );
} );

</script>


<script type="text/javascript">
    //$("#offcanvasmenu").html($("#bs-megamenu").html());
</script><div id="top"><a class="scrollup" href="#"><i class="fa fa-angle-up"></i>TOP</a></div>
</div>
</body></html>