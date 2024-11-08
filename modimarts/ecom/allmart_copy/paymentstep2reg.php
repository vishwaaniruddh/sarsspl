<?php
include('config.php');
?>
<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="ltr" lang="en" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="ltr" lang="en" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    
        <title>Allmart</title>
        <link rel="stylesheet" href="">
       
       
                <meta name="description" content="My Store" />
                    	    	<link href="http://sarmicrosystems.in/oc1/" rel="canonical" />
                    	    	<script type="text/javascript" src="catalog/view/javascript/jquery/jquery-2.1.1.min.js"></script>
                    	    	<script type="text/javascript" src="requiredfunctions.js"></script>
    	     <link href="catalog/view/theme/pav_bigstore/stylesheet/bootstrap.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/stylesheet.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/paneltool.css" rel="stylesheet" />
                <link href="catalog/view/javascript/jquery/colorpicker/css/colorpicker.css" rel="stylesheet" />
                <link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/animate.css" rel="stylesheet" />
                <link href="catalog/view/javascript/jquery/magnific/magnific-popup.css" rel="stylesheet" />
                <link href="catalog/view/javascript/jquery/owl-carousel/owl.carousel.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/fonts.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/homebuilder.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/sliderlayer/css/typo.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/pavnewsletter.css" rel="stylesheet" />
            
                <script type="text/javascript" src="catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/bootstrap/js/bootstrap.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/common.js"></script>
                <script type="text/javascript" src="catalog/view/theme/pav_bigstore/javascript/common.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/pavdeals/countdown.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/colorpicker/js/colorpicker.js"></script>
                <!--<script type="text/javascript" src="catalog/view/javascript/layerslider/jquery.themepunch.plugins.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/layerslider/jquery.themepunch.revolution.min.js"></script>-->
    <!-- FONT -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- FONT -->

<style type="text/css">
#loginForm .has-error .control-label,
#loginForm .has-error .help-block,
#loginForm .has-error .form-control-feedback {
    color: #f39c12;
}

#loginForm .has-success .control-label,
#loginForm .has-success .help-block,
#loginForm .has-success .form-control-feedback {
    color: #18bc9c;
}



</style>

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


<style>
.button {
  display: inline-block;
  padding: 2px 20px;
  font-size: 24px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color: #4CAF50;
  border: none;
  border-radius: 10px;
  box-shadow: 0 9px #999;
}

.button:hover {background-color: #3e8e41}

.button:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

</style>
<script>
function getloc()
{
 //alert("ok");

    $.ajax({
             type: "POST",
             url: "getlocationtestr.php",
		datatype:'json',	
   data:'',

             success: function(msg){
                // alert(msg);
//alert(msg.city);
var jsr=JSON.parse(msg);
//alert(jsr['region_name']);


document.getElementById("state").value=jsr['region_name'];
//document.getElementById("city").value=jsr['city'];
city2(jsr['city']);
//document.getElementById("Latitude").value=jsr['latitude'];
//document.getElementById("Longitude").value=jsr['longitude'];

//var sp=msg.split('####');


/*$("#state option").each(function(i){
        alert($(this).text());
        
        if($(this).text()==sp[0])
        {
            alert($(this).text());
            $(this)prop('selected', true);
            
        }
    });*/

            }
         });
    
    
}

</script>

<script>


function city1()
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("city1").innerHTML=xmlhttp.responseText;
  }
  }
  var str=document.getElementById('state').value;
 
xmlhttp.open("POST","getCity.php?id="+str,true);
//alert("getCity.php?id="+str);
xmlhttp.send();
}

function city2(city)
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
       // alert(xmlhttp.responseText);
    document.getElementById("city1").innerHTML=xmlhttp.responseText;
  }
  }
  var str=document.getElementById('state').value;
 
xmlhttp.open("POST","getCity.php?id="+str+"&city="+city,true);
//alert("getCity.php?id="+str);
xmlhttp.send();
}
</script>
      </head>
  <body class="common-home page-common-home layout-fullwidth" >
    <div class="row-offcanvas row-offcanvas-left">
      <div id="page">
        <!-- header -->

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

      
      <div id="sys-notification1">
          <div class="container">
            <div id="notification1">
                
             
                
                
            </div>
          </div>
        </div>
      
    <div class="row"> 
    <div id="content" class="col-sm-9">      
   
      <form action="prcessreg2.php" method="post" enctype="multipart/form-data" class="form-horizontal" id="regfrm" onsubmit="return checkemail();">
      
       
        <input type="text" id="pid" name="pid"   value="<?php echo $_REQUEST['pid'];?>">
        <input type="text" id="cid" name="cid" value="<?php echo $_REQUEST['cid'];?>">
        <input type="text" id="qty" name="qty" value="<?php echo $_REQUEST['qty'];?>">
        <input type="text" id="clr" name="clr" value="<?php echo $_REQUEST['clr'];?>">
        <input type="text" id="sz" name="sz" value="<?php echo $_REQUEST['sz'];?>">
     
        <fieldset id="account">
          <legend>Your Personal Details</legend>
          <div class="form-group required" style="display: none;">
            <label class="col-sm-2 control-label">Customer Group</label>
            <div class="col-sm-10">
                                          <div class="radio">
                <label>
                  <input type="radio" name="customer_group_id" value="1" checked="checked" />
                  Default</label>
              </div>
                                        </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-firstname">First Name</label>
            <div class="col-sm-10">
              <input type="text" name="firstname" value="" placeholder="First Name" id="input-firstname" class="form-control" required autofocus/>
                          </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-lastname">Last Name</label>
            <div class="col-sm-10">
              <input type="text" name="lastname" value="" placeholder="Last Name" id="input-lastname" class="form-control" required autofocus/>
                          </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-email">E-Mail</label>
            <div class="col-sm-10">
              <input type="email" name="email" id="email" value="" placeholder="E-Mail"  class="form-control" required autofocus/>
                          </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-telephone">Contact no.</label>
            <div class="col-sm-10">
              <input type="tel" name="contact" value="" placeholder="Telephone" id="contact" class="form-control" required autofocus onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength='10'/>
                          </div>
          </div>
        <!--  <div class="form-group">
            <label class="col-sm-2 control-label" for="input-fax">Fax</label>
            <div class="col-sm-10">
              <input type="text" name="fax" value="" placeholder="Fax" id="input-fax" class="form-control" required autofocus/>
            </div>
          </div>-->
                  </fieldset>
        <fieldset id="address">
          <legend>Your Address</legend>
         <!-- <div class="form-group">
            <label class="col-sm-2 control-label" for="input-company">Company</label>
            <div class="col-sm-10">
              <input type="text" name="company" value="" placeholder="Company" id="input-company" class="form-control" />
            </div>
          </div>-->
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-address-1">Address 1</label>
            <div class="col-sm-10">
              <input type="text" name="address_1" value="" placeholder="Address 1" id="input-address-1" class="form-control" required autofocus/>
                          </div>
          </div>
         <!-- <div class="form-group">
            <label class="col-sm-2 control-label" for="input-address-2">Address 2</label>
            <div class="col-sm-10">
              <input type="text" name="address_2" value="" placeholder="Address 2" id="input-address-2" class="form-control" />
            </div>
          </div>-->
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-zone">State</label>
            <div class="col-sm-10">
              <select name="state" id="state" class="form-control" class="styledselect_form_1"  onchange="city1()" required autofocus>
                  <option value=""> --- Please Select --- </option>
                  <option value="0" style="width: 12em"></option>
                         <?php 
$sqlm=mysqli_query($con1,"select * from states");
while($rowm=mysqli_fetch_row($sqlm)){
?>
				<option value="<?php echo $rowm[1]; ?>"><?php echo $rowm[1]; ?></option>
<?php } ?>
</select>
                          </div>
          </div>
          <script>
          
          getloc();
          </script>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-city">City</label>
            <div class="col-sm-10">
              <div id="city1" >
<select  name="city" class="form-control" class="styledselect_form_1" id="city" ><option value="0" style="width: 15em" >select</option>

</select></div>  
</div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-postcode">PIN Code</label>
            <div class="col-sm-10">
              <input type="text" name="pincode" value="" placeholder="PIN Code" id="input-postcode" class="form-control" required autofocus onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength='6'/>
                          </div>
          </div>
          <!--<div class="form-group required">
            <label class="col-sm-2 control-label" for="input-country">Country</label>
            <div class="col-sm-10">
              <select name="country_id" id="input-country" class="form-control">
                <option value=""> --- Please Select --- </option>
                                                <option value="244">Aaland Islands</option>
                                                                <option value="1">India</option>
                                                        
                                                                <option value="50">Cook Islands</option>
                                                          <option value="178">Saint Kitts and Nevis</option>
                                                                <option value="179">Saint Lucia</option>
                                                                <option value="180">Saint Vincent and the Grenadines</option>
                                                                <option value="181">Samoa</option>
                                                    <option value="181">Afghanistan</option>
                                                    <option value="181">china</option>
                                              </select>
                                             
                 
                          </div>
          </div>-->
                  </fieldset>
        <fieldset>
          <legend>Your Password</legend>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-password">Password</label>
            <div class="col-sm-10">
              <input type="password" name="password" value="" placeholder="Password" id="password" class="form-control" required autofocus/>
                          </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-confirm">Password Confirm</label>
            <div class="col-sm-10">
              <input type="password" name="confirm" value="" placeholder="Password Confirm" id="confirm" class="form-control" required autofocus/>
                          </div>
          </div>
        </fieldset>
        <fieldset>
          <legend>Newsletter</legend>
          <div class="form-group">
            <label class="col-sm-2 control-label">Subscribe</label>
            <div class="col-sm-10">
                            <label class="radio-inline">
                <input type="radio" name="newsletter" value="1" />
                Yes</label>
              <label class="radio-inline">
                <input type="radio" name="newsletter" value="0" checked="checked" />
                No</label>
                          </div>
          </div>
        </fieldset>
        
        
        
        
                        <div class="buttons">
          <div class="pull-right">I have read and agree to the <a href="http://sarmicrosystems.in/oc1/index.php?route=information/information/agree&amp;information_id=3" class="agree"><b>Privacy Policy</b></a>                        
          <input type="checkbox" name="agree" id="agree" value="1" />
                        &nbsp;
            <input type="submit" data-loading-text="Loading..." value="Continue" id="regbtn" class="btn btn-primary" />
          </div>
        </div>
              </form>
              
              
            


<script>








//============================================
var bl=true;
function val()
{
    
    try
    {

var phone = document.getElementById("contact").value;
var password = document.getElementById("password").value;
var confirm = document.getElementById("confirm").value;
var agree = document.getElementById("agree").value;
  
        if (password != confirm) {
            toastfunc("Passwords do not match.");
            document.getElementById("confirm").focus();
            bl=false;
            
        }
        
        else if(!document.getElementById('agree').checked){ 
             toastfunc("Please check agree conditions!!");
            document.getElementById("agree").focus();
            bl=false;
        }
        else
        {
            bl=true;
            bool=true;
          
            document.getElementById('regbtn').value="Please wait...";
            document.getElementById('regbtn').setAttribute('disabled', 'disabled');
           
           document.getElementById('regfrm').submit();
        }
    }
catch(exc)
    {
        
       toastfunc(exc); 
    }
  return bl;
}
    

//================================================check email===================================================
//var bool=false;


var bool=false;
function checkemail()
{
try{
//alert("hello");
    var email1=document.getElementById('email').value;
   //alert(email1);
    $.ajax({
             type: "POST",
             url: "chkmail.php",
			async: false,
   data:'email2='+email1,
             success: function(msg){
                  $('.text-danger').parent().addClass('');
                  $('.text-danger').parent().removeClass('has-error');
                 $('.alert, .text-danger').remove();
                 //alert("check");
//alert(msg);
if(msg==1)
{
    //toastfunc("Email id already exists !!");
    var element2 = $('#email');
$(element2).after('<div class="text-danger">' +'Email Id is already registered' + '</div>');
$('.text-danger').parent().addClass('has-error');
    bool=false;
    element2.focus();
}
else
{
   //bool=true;
    
    checkcontact();
}

            }
         }); 
}catch(ex){
    alert(ex);
}
         //alert(bool);
   return bool;
}

 
 
 
 
 var bool2=false;
function checkcontact()
{
try{
//alert("hello");
    var cont=document.getElementById('contact').value;
   //alert(email1);
    $.ajax({
             type: "POST",
             url: "chkmail.php",
			async: false,
   data:'cont='+cont+'&stats=1',
             success: function(msg){
                 //alert("check");
                  $('.text-danger').parent().addClass('');
                  $('.text-danger').parent().removeClass('has-error');
                 $('.alert, .text-danger').remove();
                 
//alert(msg);
if(msg==1)
{
     bool2=false;
var element2 = $('#contact');
$(element2).after('<div class="text-danger">' +'Contact No is already registered' + '</div>');
$('.text-danger').parent().addClass('has-error');
element2.focus();

}
else
{
 //bool2=true;
 //guestcheckoutfn();
 val();
}

            }
         }); 
}catch(ex){
    alert(ex);
  
      
}
   return bool2;
}

 

</script>



      </div>
  
</div>


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

</div>
	
</body></html>