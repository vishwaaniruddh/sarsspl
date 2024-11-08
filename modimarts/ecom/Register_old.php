<?php
session_start();
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
        <title>All mart</title>
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
  <body class="common-home page-common-home layout-fullwidth" onload="<?php if(isset($_SESSION['loginstats']) & $_SESSION['loginstats']!=""){ }else{?>getloc();<?php } ?>">
     
    <div class="row-offcanvas row-offcanvas-left">
      <div id="page">
        <!-- header -->
<header id="header-layout" class="header-v2">
    <div id="topbar" class="topbar-v1">
  <div class="container">
  <?php include('topbar.php')?>
</div>
</div>   
<div id="header-main">
        <div class="">
            <div class="row">
            <?php include('menucopy.php')?>
            </div>
        </div>
    </div>
    
    <!--<div id="header-bot" class="hidden-xs hidden-sm">
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
                    <div class="col-lg-3 col-sm-3 col-md-3 hidden-xs hidden-sm"></div>
                </div>
            </div>
        </div>
    </div>-->
</header>
        <!-- /header -->
       
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
       <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){ ?>
        <li><a href="#">Register</a></li>
        <?php } ?>
      </ul>
      
      <div id="sys-notification1">
          <div class="container">
            <div id="notification1">
            </div>
          </div>
        </div>
       <center><div class="container" class="col-sm-10">
    <div class="row">               
    <div id="content" class="col-sm-8 col-md-offset-2" style="background-color: #f5f5f5;border-radius:1%;margin-left: 179px;">      
     <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?>
    <h1>Register Account</h1>
    <p>If you already have an account with us, please login at the <a href="login.php">login page</a>.</p>
    <?}else{?>
   
       <?php } 
       
       if(isset($_SESSION['loginstats']) & $_SESSION['loginstats']!=""){
   
                      $slctqry=mysqli_query($con1,"SELECT * FROM `Registration` WHERE id='".$_SESSION['gid']."'");
                     // echo "SELECT * FROM `Registration` WHERE id='".$_SESSION['gid']."'";
                      echo mysqli_error();
                      $sltqryftch=mysqli_fetch_array($slctqry);
                      
                      $name=$sltqryftch["Firstname"];
                      $Lastname=$sltqryftch["Lastname"];
                      $email=$sltqryftch["email"];
                      $Mobile=$sltqryftch["Mobile"];

$aqr=mysqli_query($con1,"SELECT * FROM `user_address` where user_id='".$_SESSION['gid']."' order by id asc");
$aqrws=mysqli_fetch_array($aqr);

$address=$aqrws["address"];

    $pincode=$aqrws["pin"];
                      $state=$aqrws["state"];
$city=$aqrws["city"];
$password=$sltqryftch["password"];

}

?>
      <form action="process_reg.php" method="post" enctype="multipart/form-data" class="form-horizontal" id="regfrm" onsubmit="return val();">
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
              <input type="text" name="firstname"  id="input-firstname" class="form-control" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="First Name" <?php } ?> value="<?php echo $name; ?>" required autofocus/>
                          </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-lastname">Last Name</label>
            <div class="col-sm-10">
              <input type="text" name="lastname" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="Last Name" <?php } ?> id="input-lastname" class="form-control" value="<?php if($Lastname!=""){ echo $Lastname;} ?>" required autofocus/>
                          </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-email">E-Mail</label>
            <div class="col-sm-10">
              <input type="email" name="email" id="email" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="E-Mail" <?php } ?>  class="form-control" onblur="checkemail();" value="<?php if($email!=""){ echo  $email;} ?>" required autofocus/>
              
              <input type="hidden" name="email2" id="email2"   class="form-control" value="<?php if($email!=""){ echo  $email;} ?>"/>
              
                          </div>
          </div>
         <!-- <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-telephone">Mobile No.</label>
            <div class="col-sm-10">
              <input type="tel" name="contact" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="Mobile" <?php } ?> id="contact"  class="form-control" onblur="checkcontact();" value="<?php if($Mobile!=""){ echo $Mobile;} ?>"  onblur ='return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46' required autofocus/>
                       <input type="hidden" name="contact2" id="contact2"   class="form-control" value="<?php if($Mobile!=""){ echo  $Mobile;} ?>"/>
                       
                          </div>-->
                          
                          
                            <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-telephone">Mobile No.</label>
            <div class="col-sm-10">
              <input type="text" name="contact" maxlength ="10" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="Mobile" <?php } ?> id="contact"  class="form-control" onblur="checkcontact();" value="<?php if($Mobile!=""){ echo $Mobile;} ?>"  onkeypress='return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46' />
                       <input type="hidden" name="contact2" id="contact2"   class="form-control" value="<?php if($Mobile!=""){ echo  $Mobile;} ?>"/>
                       
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
            <label class="col-sm-2 control-label" for="input-address-1"  style="text-align: left;">Plot NO.</label>
            <div class="col-sm-10">
              <input type="text" name="PlotNO" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="Plot NO" <?php } ?> id="PlotNO" class="form-control" value="<?php if($plotNo!=""){ echo $plotNo;} ?>" required autofocus/>
                          </div>
          </div>
           <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-address-1"  style="text-align: left;">Wing No.</label>
            <div class="col-sm-10">
              <input type="text" name="WingNo" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="Wing No" <?php } ?> id="WingNo" class="form-control" value="<?php if($wingNo!=""){ echo $wingNo;} ?>" required autofocus/>
                          </div>
          </div>
          
           <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-address-1"  style="text-align: left;">Building Name</label>
            <div class="col-sm-10">
              <input type="text" name="BuildingName" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="Building Name" <?php } ?> id="BuildingName" class="form-control" value="<?php if($buildName!=""){ echo $buildName;} ?>" required autofocus/>
                          </div>
          </div>
          
           <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-address-1"  style="text-align: left;">Road No.</label>
            <div class="col-sm-10">
              <input type="text" name="RoadNo" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="Road No" <?php } ?> id="RoadNo" class="form-control" value="<?php if($roadNo!=""){ echo $roadNo;} ?>" required autofocus/>
                          </div>
          </div>
          
           <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-address-1"  style="text-align: left;">LandMark</label>
            <div class="col-sm-10">
              <input type="text" name="LandMark" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="LandMark" <?php } ?> id="LandMark" class="form-control" value="<?php if($landmark!=""){ echo $landmark;} ?>" required autofocus/>
                          </div>
          </div>
          
           <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-address-1"  style="text-align: left;">Locality</label>
            <div class="col-sm-10">
              <input type="text" name="Locality" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="Locality" <?php } ?> id="Locality" class="form-control" value="<?php if($Locality!=""){ echo $Locality;} ?>" required autofocus/>
                          </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-address-1">Address</label>
            <div class="col-sm-10">
              <input type="text" name="address_1" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="Address" <?php } ?> id="input-address-1" class="form-control" value="<?php if($address!=""){ echo $address;} ?>" required autofocus/>
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
                  <option value="0" style="width: 12em"></option>
                         <?php 
$sqlm=mysqli_query($con1,"select * from states");
while($rowm=mysqli_fetch_row($sqlm)){
?>
				<option value="<?php echo $rowm[1]; ?>" <?php if($rowm[0]==$state){ echo "selected";} ?>><?php echo $rowm[1]; ?></option>
<?php } ?>
</select>
                          </div>
          </div>
          
          <?php
          if(isset($_SESSION['loginstats']) & $_SESSION['loginstats']!=""){
          $gestnm=mysqli_query($con1,"select name from cities where code='".$city."'");
          $cityrr=mysqli_fetch_array($gestnm);
          ?>
          <script>
          city2('<?php echo $cityrr[0];?>');
          </script>
          <?php } ?>
          
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
              <input type="text" name="pincode" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="PIN Code" <?php } ?> id="input-postcode" class="form-control" value="<?php echo $pincode;?>" required autofocus onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength='6'/>
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
            <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?>
          <legend>Your Password</legend>
          <?php } ?>
          <div class="form-group required" <?php if(isset($_SESSION['loginstats']) & $_SESSION['loginstats']!=""){?> style="display:none;" <?php  } ?>>
            <label class="col-sm-2 control-label" for="input-password">Password</label>
            <div class="col-sm-10">
              <input type="password" name="password" <?php if(isset($_SESSION['loginstats']) & $_SESSION['loginstats']!=""){?> placeholder="Password" <?php } ?> id="password" class="form-control" value="<?php echo $password;?>" required autofocus/>
                          </div>
          </div>
          <div class="form-group required" <?php if(isset($_SESSION['loginstats']) & $_SESSION['loginstats']!=""){?> style="display:none;" <?php } ?>>
            <label class="col-sm-2 control-label" for="input-confirm">Password Confirm</label>
            <div class="col-sm-10">
              <input type="password" name="confirm" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="Password Confirm" <?php } ?> id="confirm" class="form-control" value="<?php echo $password;?>" required autofocus/>
                          </div>
          </div>
        </fieldset>
        <fieldset>
         
        </fieldset>
                        <div class="buttons">
          <div class="center" >
              
              <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){ ?> I have read and agree to the <?php } ?> <a href="javascript:void(0)" class="agree" <?php if(isset($_SESSION['loginstats']) && $_SESSION['loginstats']!=""){ ?> style="display:none;" <?php } ?>><b>Privacy Policy</b></a>                        
          <input type="checkbox" name="agree" id="agree" value="1" <?php if(isset($_SESSION['loginstats']) & $_SESSION['loginstats']!=""){ ?> checked style="display:none;" <?php } ?>/>
            &nbsp;
        <input type="submit" name="update" data-loading-text="Loading..."  class="btn btn-primary"  value="update" <?php if(isset($_SESSION['loginstats']) && $_SESSION['loginstats']!=""){ ?> style="display:block;border-radius: 10px;" <?php }else{ ?>style="display:none;border-radius: 10px;" <?php } ?>/>
            <!--<button type="submit" name="submit" data-loading-text="Loading..." value="Continue" id="regbtn"  class="btn btn-primary" />Submit</button>-->
            <input type="submit" name="submit" value="Submit" data-loading-text="Loading..." class="btn btn-primary" <?php if(isset($_SESSION['loginstats']) && $_SESSION['loginstats']!=""){?> style="display:none;border-radius: 10px;"<?php }else{ ?>style="display:block;border-radius: 10px;"<?php } ?>/>
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

if(checkemail())
{
if(checkcontact())
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
          
            //document.getElementById('regbtn1').value="Please wait...";
            //document.getElementById('regbtn1').setAttribute('disabled', 'disabled');
           
            //document.getElementById('regbtn2').value="Please wait...";
            //document.getElementById('regbtn2').setAttribute('disabled', 'disabled');
           
         //  document.getElementById('regfrm').submit();
        }
}else
{
  bl=false;   
}
}
else
{
  bl=false;   
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
    var email2=document.getElementById('email2').value;
   //alert(email1);
   if(email1!=email2)
   {
   
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
   bool=true;
    
   // checkcontact();
}


            }
         }); 
         
   }else
{
    bool=true;
}
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
    var cont2=document.getElementById('contact2').value;
    if(cont!=cont2)
    {
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
 bool2=true;
 //guestcheckoutfn();
 //val();
}

            }
         }); 
    }else
    {
       bool2=true;
        
    }
}catch(ex){
    alert(ex);
  
      
}
   return bool2;
}

 

</script>



      </div>
       <div id="column-right" class="col-lg-3 col-md-3 col-sm-12 sidebar col-xs-12">
    <div class="list-group">
   <?php include('myaccsidemenu.php');?>
  </div>
  </div>
</div>  
</div></div><ycenter>
<!--
  $ospans: allow overrides width of columns base on thiers indexs. format array( column-index=>span number ), example array( 1=> 3 )[value from 1->12]
 -->



 
<footer id="footer" class="nostylingboxs">
 
  

  <?php include("footer.php")?>

</footer>
 
 
<div id="powered">
  <?php include('footerbottom.php')?>

</div>


  
<script type="text/javascript">
$(document).ready( function (){
	$(".paneltool .panelbutton").click( function(){	
		$(this).parent().toggleClass("active");
	} );
} );



function showstatsfunc(sts)
{
    try
{
    //alert(sts);
    if(sts=="2")
    {
 
 
            document.getElementById('notification1').innerHTML='<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' +'Some error occured please try again'+ '<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
}
else
{
 <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){ ?>
            document.getElementById('notification1').innerHTML='<div class="alert alert-success"><i class="fa fa-exclamation-circle"></i> ' +'Registration successfull please login'+ '<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
 <?php }else{ ?>
 
 document.getElementById('notification1').innerHTML='<div class="alert alert-success"><i class="fa fa-exclamation-circle"></i> ' +'Update successfull'+ '<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
 <?php } ?>
    
}
}catch(exc)
{
    alert(exc);
}
        
    }
</script>

       <?php   if(isset($_GET['sts']) & $_GET['sts']!="")
{ 
?>
<script>
showstatsfunc('<?php echo $_GET['sts'];?>');
</script>
<?php
}
?>

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
<script type="text/javascript">
    $("#offcanvasmenu").html($("#bs-megamenu").html());
</script><div id="top"><a class="scrollup" href="#"><i class="fa fa-angle-up"></i>TOP</a></div>
</div>
	
</body></html>