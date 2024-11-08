<?php
$stsss="2";
include('config.php');
  $qry="select code,name from cities";
			  $res=mysqli_query($con1,$qry);                
			  $num=mysqli_num_rows($res);

						  $qry1="select distinct code from categories";
						 $res1=mysqli_query($con1,$qry1);                
						  $num1=mysqli_num_rows($res1);     

       					$qry2="select max(code) as ncode from clients";   
						 $res2=mysqli_query($con1,$qry2);
						 $row2=mysqli_fetch_array($res2);
						       
							 // $qry="select * from main_cat WHERE UNDER=0";
             				 // $result=mysqli_query($con1,$qry);  
?>




<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="ltr" lang="en" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="ltr" lang="en" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Merabazaar</title>
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
                
                <!--<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>-->
                
                <script type="text/javascript" src="catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/bootstrap/js/bootstrap.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/common.js"></script>
                <script type="text/javascript" src="catalog/view/theme/pav_bigstore/javascript/common.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/pavdeals/countdown.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/colorpicker/js/colorpicker.js"></script>
               
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<link href="datepc/dcalendar.picker.css" rel="stylesheet" type="text/css">

<script>

function getloc()
{ $.ajax({
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

city2(jsr['city']);


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
    document.getElementById("cname").focus();
  }
  }
  var str=document.getElementById('state').value;
 
xmlhttp.open("POST","getCity.php?id="+str+"&city="+city,true);
//alert("getCity.php?id="+str);
xmlhttp.send();
}




var boolemail=false;
function checkemail()
{
    
    try
    {
var element2 = $('#email');
//alert("hello");
    var email=document.getElementById('email').value;
   if(email!=""){
    $.ajax({
             type: "POST",
             url: "checkemail.php",
			async: false,
   data:'email='+email,
             success: function(msg){
                 
                 $(element2).parent().addClass('');
                 $(element2).parent().removeClass('has-error');
           $('.alert, .text-danger').remove();
if(msg==1)
{
     boolemail=false;
   // alert("Email id already exists !!");
    //bool=false;
     
$(element2).after('<div class="text-danger" id="emailerr">' +'Email Id is already registered' + '</div>');
$(element2).parent().addClass('has-error');
   
    element2.focus();
}else
{
     boolemail=true;
}

            }
         }); 
         
   }
    }catch(exc)
    {
        alert(exc);
    }
   return boolemail;
}

 
 
 
function checkcontactno()
{
var boolcont=false;
//alert("hello");
 var element3 = $('#mobile');
    var mob=document.getElementById('mobile').value;
   // alert(email);
   if(mob!="")
   {
    $.ajax({
             type: "POST",
             url: "checkemail.php",
			async: false,
   data:'mob='+mob+'&sts=1',
             success: function(msg){
                 //alert(mob);
                  $(element3).parent().addClass('');
                 $(element3).parent().removeClass('has-error');
                  $('.alert, .text-danger').remove();
if(msg==1)
{
   // alert("Email id already exists !!");
    //bool=false;
     
$(element3).after('<div class="text-danger" id="emailerr">' +'Contact number is already registered' + '</div>');
$(element3).parent().addClass('has-error');
    boolcont=false;
    element3.focus();
}

            }
         }); 
   }
   return boolcont;
}
 
 function finalval()
{
   
    if(checkcont() && checkemail() &&validation() )
    {
       return true; 
    }
    else
    {
        
        return false; 
        
    }
    
   
}
 
 function validation()
 {
     
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

	



      </head>
  <body class="common-home page-common-home layout-fullwidth" onload="getloc();">
    <div class="row-offcanvas row-offcanvas-left">
      <div id="page">
        <!-- header -->
 
 
<header id="header-layout" class="header-v2">
      <div id="header-main">
        <div class="">
            <div class="row">
            <?php include('resale_menu.php')?>
            </div>
        </div>
    </div>
   
</header>


        <div id="sys-notification">
          <div class="container">
            <div id="notification"></div>
          </div>
        </div>
       
        
              <div id="sys-notification1">
          <div class="container">
            <div id="notification1">
                
             
                
                
            </div>
          </div>
        </div>
        <style>
            input[type=text], textarea {
  -webkit-transition: all 0.30s ease-in-out;
  -moz-transition: all 0.30s ease-in-out;
  -ms-transition: all 0.30s ease-in-out;
  -o-transition: all 0.30s ease-in-out;
  outline: none;
  
  border: 1px solid #DDDDDD;
}
 
input[type=text]:focus, textarea:focus {
  box-shadow: 0 0 5px rgba(81, 203, 238, 1);
 
  border: 1px solid rgba(81, 203, 238, 1);
}
        </style>
        <style>
            .form-control {
                    width: 95%;
                    padding: 8px 8px;
            }
        </style>
        
               <div class="container" >
 
      
    <div class="row">      <br>  <div id="content1" class="col-sm-2"> </div>       <div id="container content" class="col-sm-8" style="background-color: #f5f5f5;border-radius:1%;margin-left: 2%;">      
   <br><center> If you are already a Member <a href="user/index.php">Click Here</a>
    <h1>Register Account</center></h1>
      <p><!--If you already have an account with us, please login at the <a href="login.php">login page</a>.--></p>
    


 		<form action="processAddCustomer.php" method="post" enctype="multipart/form-data" id="loginForm"  class="form-horizontal" autocomplete="OFF" onsubmit="return finalval();">
  
		    <input type="hidden" name="Latitude" id="Latitude" readonly>
          <input type="hidden" name="Longitude" id="Longitude" readonly>
  

<div class="form-group required">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Capture Current Location</font></label>
     <div class="col-sm-9">
            
              <input type="checkbox" id="caploc" name="caploc" checked/>
                          </div>
          </div>

 <div class="form-group " >
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" ></font></label>
     <div class="col-sm-9" id="attatch">
            

                          </div>
          </div>
                 

    <div class="form-group required" id="compname">
      <label class="col-sm-3 control-label" for="input-firstname" id="id-name" ><font color="black" >Name</font></label>
       <div class="col-sm-9">
          <input type="text" name="cname" id="cname" placeholder=" Name"  class="form-control" size="50" tabindex=0 required autofocus/>
       </div>
    </div>
           
          
          <div class="form-group required" id="st">
          <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >State</font></label>
                <div class="col-sm-9">
                   <select name="state"   id="state" class="form-control" class="styledselect_form_1"  onchange="city1()" ><option value="0" style="width: 12em" >Select</option>
                           <?php 
                                $sqlm=mysqli_query($con1,"select * from states");
                                while($rowm=mysqli_fetch_row($sqlm)){
                            ?>
	         			   <option value="<?php echo $rowm[1]; ?>"><?php echo $rowm[1]; ?></option>
                           <?php } ?>
                    </select>
                </div>
          </div>
           
          <div class="form-group required" id="Ccity">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >City</font></label>
     <div class="col-sm-9">
        <div id="city1" >
<select  name="city" class="form-control" class="styledselect_form_1" id="city" ><option value="0" style="width: 15em" >select</option>

</select></div>                  </div>
          </div>
            


<div class="form-group required" id="CArea">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Area</font></label>
     <div class="col-sm-9">
            
              <input type="text"  class="form-control" name="area" id="area"   required autofocus/><div id="search_suggest">

</div>
                          </div>
          </div>
           
          
          
<div class="form-group required" id="Caddress">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Address</font></label>
     <div class="col-sm-9">
              <input type="text"  class="form-control" name="add2"  class="in-form" required autofocus/>
        </div>
        </div>
            
          
          <div class="form-group " id="CTelephn">
    <label class="col-sm-3 control-label" for="input-firstname" id="id-Cteleph"><font color="black" >Company Telephone</font></label>
    <label class="col-sm-3 control-label" for="input-firstname" id="id-teleph" style="display:none"><font color="black" >Telephone</font></label>
     <div class="col-sm-9">
                     
              <input type="text" name="phone" maxlength ="10" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="" <?php } ?> id="phone"  class="form-control"  value="<?php if($Mobile!=""){ echo $Mobile;} ?>"  onkeypress='return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46'  />
                       <input type="hidden" name="contact2" id="contact2"   class="form-control" value="<?php if($Mobile!=""){ echo  $Mobile;} ?>"/>
                       
                          </div>
          </div>
            
        
          
             <div class="form-group required" id="Cemail">
      <label class="col-sm-3 control-label" for="input-firstname" id="id-email" ><font color="black" >Email-ID</font></label>
    <div class="col-sm-9">
            <input type="email"  class="form-control" name="email" id="email" class="inp-form" onblur="checkemail();" required autofocus/>Email will be sent to this email id<br/>
            </div>
                          </div>
         
          
          <div class="form-group required" id="Cmobile">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Mobile</font></label>
                      <div class="col-sm-9">
              <input type="text" name="mobile" maxlength ="10" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="Mobile" <?php } ?> id="contact"  class="form-control" onblur="checkcontactno();" value="<?php if($Mobile!=""){ echo $Mobile;} ?>"  onkeypress='return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46' required autofocus/>
                       <input type="hidden" name="contact2" id="contact2"   class="form-control" value="<?php if($Mobile!=""){ echo  $Mobile;} ?>"/>
                       
                          </div>
                          
         </div>
       
            
            
            
            <div class="form-group " id="PartshipBusiAadhr" >
            <label class="col-sm-3 control-label" ><font color="black">Aadhar No.</font></label>
            <div class="col-sm-9">
            <input type="text" id="busiAadhar" name="busiAadhar" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" /> 
            </div>
            </div>
            
  
           
            
            
           <div class="form-group required" id="PartshipcomnyPan" >
            <label class="col-sm-3 control-label" ><font color="black">Pan No.</font></label>
            <div class="col-sm-9">
            <input type="text" id="Pan" name="Pan" class="form-control"  > 
            </div>
            </div>

            
          
            
            
            
            
            
          
         <div align="center">
            <input type="submit" class="btn btn-primary" value=Submit name="submit"/>
            <button type="button" class="btn btn-primary" style="margin-top: 0px;"  onclick='window.open("admin.php","_self");'>Cancel</button>
         </div>
         <br>

                     
        </div>
          
          
          
          <style>
button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 8px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
     border-radius: 8px;
    margin: 4px 2px;
    cursor: pointer;
}
</style>
 <!-- /////////////////////////////////////////////--> 
         

</form>
</div>

      </div>
  
</div>
<script type="text/javascript">
 
 

$(document).ready(function(){
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showLocation);
    }else{
        alert('Geolocation is not supported by this browser.');
    }
});

$(function() {
  // from http://stackoverflow.com/questions/45888/what-is-the-most-efficient-way-to-sort-an-html-selects-options-by-value-while
  var my_options = $('.compny select option');
  var selected = $('.compny').find('select').val();

  my_options.sort(function(a,b) {
    if (a.text > b.text) return 1;
    if (a.text < b.text) return -1;
    return 0
  })

  $('.compny').find('select').empty().append( my_options );
  $('.compny').find('select').val(selected);
  
  // set it to multiple
  $('.compny').find('select').attr('multiple', true);
  
  // remove all option
  $('.compny').find('select option[value=""]').remove();
  // add multiple select checkbox feature.
  $('.compny').find('select').multiselect();
})

</script>
<br>
 <link rel="stylesheet" type="text/css" href="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.css" />
<footer id="footer" class="nostylingboxs">
  <?php include("resale_footer.php")?>
</footer>
 
 
  <?php include('footerbottom.php')?>
</div>

  
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
</body>
</html>