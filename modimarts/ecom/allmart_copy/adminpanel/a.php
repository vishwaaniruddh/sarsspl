<?php 
session_start();
include('header.php');
include('config.php');
include('access.php');



			  $qry="select code,name from cities";
			  $res=mysql_query($qry);                
			  $num=mysql_num_rows($res);

						  $qry1="select distinct code from categories";
						 $res1=mysql_query($qry1);                
						  $num1=mysql_num_rows($res1);     

       					$qry2="select max(code) as ncode from clients";   
						 $res2=mysql_query($qry2);
						 $row2=mysql_fetch_array($res2);
						       
							  $qry="select * from main_cat WHERE UNDER=0";
             				  $result=mysql_query($qry);  
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
        <link rel="stylesheet" href="css/stylesheet.css">
       
      

       
              <script type="text/javascript" src="../catalog/view/javascript/jquery/jquery-2.1.1.min.js"></script>
              <script type="text/javascript" src="../requiredfunctions.js"></script>
    	     <link href="../catalog/view/theme/pav_bigstore/stylesheet/bootstrap.css" rel="stylesheet" />
               
                <link href="../catalog/view/theme/pav_bigstore/stylesheet/paneltool.css" rel="stylesheet" />
                <link href="../catalog/view/javascript/jquery/colorpicker/css/colorpicker.css" rel="stylesheet" />
                <link href="../catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
                <link href="../catalog/view/theme/pav_bigstore/stylesheet/animate.css" rel="stylesheet" />
                <link href="../catalog/view/javascript/jquery/magnific/magnific-popup.css" rel="stylesheet" />
                <link href="../catalog/view/javascript/jquery/owl-carousel/owl.carousel.css" rel="stylesheet" />
                <link href="../catalog/view/theme/pav_bigstore/stylesheet/fonts.css" rel="stylesheet" />
                <link href="../catalog/view/theme/pav_bigstore/stylesheet/homebuilder.css" rel="stylesheet" />
                <link href="../catalog/view/theme/pav_bigstore/stylesheet/sliderlayer/css/typo.css" rel="stylesheet" />
                <link href="../catalog/view/theme/pav_bigstore/stylesheet/pavnewsletter.css" rel="stylesheet" />
                <script type="text/javascript" src="../catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js"></script>
                <script type="text/javascript" src="../catalog/view/javascript/bootstrap/js/bootstrap.min.js"></script>
                <script type="text/javascript" src="../catalog/view/javascript/common.js"></script>
                <script type="text/javascript" src="../catalog/view/theme/pav_bigstore/javascript/common.js"></script>
                <script type="text/javascript" src="../catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js"></script>
                <script type="text/javascript" src="../catalog/view/javascript/pavdeals/countdown.js"></script>
                <script type="text/javascript" src="../catalog/view/javascript/jquery/colorpicker/js/colorpicker.js"></script>
                
                <script type="text/javascript" src="../catalog/view/javascript/layerslider/jquery.themepunch.plugins.min.js"></script>
                <script type="text/javascript" src="../catalog/view/javascript/layerslider/jquery.themepunch.revolution.min.js"></script>
    <!-- FONT -->

        <!-- FONT -->
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
document.getElementById("Latitude").value=jsr['latitude'];
document.getElementById("Longitude").value=jsr['longitude'];

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
   // alert(email);
    $.ajax({
             type: "POST",
             url: "checkemail.php",
			async: false,
   data:'email='+email,
             success: function(msg){
                 
                 $(element2).parent().addClass('');
                 $(element2).parent().removeClass('has-error');
                 $('#emailerr').remove();
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
    }catch(exc)
    {
       // alert(exc);
    }
   return boolemail;
}

 
 
 
function checkcontactno()
{
    try
    {
        //alert("hello");
var boolcont=false;
//alert("hello");
 var element3 = $('#mobile');
    var mob=document.getElementById('mobile').value;
   
   if(mob!="")
   {
    $.ajax({
             type: "POST",
             url: "checkemail.php",
			async: false,
   data:'mob='+mob+'&sts=1',
             success: function(msg){
                 //alert(msg);
                  $(element3).parent().addClass('');
                 $(element3).parent().removeClass('has-error');
                  $('#conterr').remove();
if(msg==1)
{
   // alert("Email id already exists !!");
    //bool=false;
     
$(element3).after('<div class="text-danger" id="conterr">' +'Contact number is already registered' + '</div>');
$(element3).parent().addClass('has-error');
    boolcont=false;
    element3.focus();
}

            }
         }); 
   }
    }catch(exc)
    {
        alert(exc);
    }
   return boolcont;
}
 
 function finalval()
{
    if(checkcont1() && checkemail())
    {
       return true; 
    }
    else
    {
        
        return false; 
        
    }
    
   
}
function checkcont1()
{
try{
     var selected = $(".compny option:selected");
                var message = "";
                selected.each(function () {
                //  message += $(this).text() + " " + $(this).val() + "\n";
                  message += $(this).text() + " "  + "\n";
               
                });
               
    var fields2 = message.split(/[^\s]+/).length - 1;
 // alert(length)
   
//var fields2 = document.getElementsByName("compny[]");


    var cat=0;
    
    for(var i = 0; i < fields2; i++) 
                   {  
                       
                   if(message)    
//  if(fields2[i].checked==true)
{
    cat=1;


}
                   }   
                if(cat==0){
                       alert("select atleast 1 category !!");
                     return false;
                   }else{
   return true;
                   }
      // return true;           
                 
}catch(e){
    alert(e);
}
}


function addItem()
{
	
//alert("ok");
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
		

	//	var newdiv=document.createElement("div");
//alert(xmlhttp.responseText);
//newdiv.innerHTML=xmlhttp.responseText+"<td><input type='button' value='Remove' onClick='removeElement("+num+")'><td></tr></div><tbody><table>";
//newdiv.innerHTML=xmlhttp.responseText;
try
{
	document.getElementById('attatch').innerHTML=xmlhttp.responseText;
}catch(ex)
{
    alert(ex);
}
    }
  }
  
    var nomem=document.getElementById('nomem').value;
  //alert("addrow_image.php?cnt="+cnt);
xmlhttp.open("GET","addrowimg.php?nomem="+nomem,true);
xmlhttp.send();	
}
 
 
 
/*
 var bool2=true;
function checkcont()
{

//alert("hello");
    var mob=document.getElementById('contact').value;
   // alert(email);
    $.ajax({
             type: "POST",
             url: "checkemail.php",
			
   data:'mob='+mob='&sts=1',
             success: function(msg){
                 alert(msg);
   $('.text-danger').parent().addClass('form-group required');
                  $('.text-danger').parent().removeClass('has-error');
                 $('.alert, .text-danger').remove();
if(msg==1)
{
   // alert("Email id already exists !!");
    //bool=false;
     var element2 = $('#contact');
$(element2).after('<div class="text-danger">' +'Contact No is already registered' + '</div>');
$('.text-danger').parent().addClass('has-error');
    bool2=false;
    element2.focus();
}

            }
         }); 
   return bool2;
}




function finalval()
{
    if(!checkcont())
    {
       return false; 
    }
    else if(checkemail())
    {
        
        return false; 
        
    }else
    {
      return true;   
    }
    
    
}*/
</script>

<!--<script type="text/javascript">
        function ValidateFax() {
            var regex = new RegExp("^\\+[0-9]{1,3}-[0-9]{3}-[0-9]{7}$");
            var fax = document.getElementById("txtFax").value;
            if (fax != '') {
                if (regex.test(fax)) {
                    alert("Fax no is valid");
                } else {
                    alert("Fax no is invalid");
                }
            } else {
                alert("Enter Fax no.");
            }
        }
    </script>-->



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
  padding: 8px 20px;
  font-size: 14px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color: #4CAF50;
  border: none;
  border-radius: 10px;
 
}

.button:hover {background-color: #3e8e41}

.button:active {
  background-color: #3e8e41;
 
}

</style>




      </head>
  <body class="common-home page-common-home layout-fullwidth" onload="getloc();">
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
        
              <div id="sys-notification1">
          <div class="container">
            <div id="notification1">
                
             
                
                
            </div>
          </div>
        </div>
        
        
        
        
                        <div class="container" >
 <!-- <ul class="breadcrumb">
        <li><a href="http://sarmicrosystems.in/oc1/index.php?route=common/home"><i class="fa fa-home"></i></a></li>
       
        <li><a href="#">Register</a></li>
      </ul>-->
      
    <div class="row">        <div id="content1" class="col-sm-2"> </div>       <div id="content" class="col-sm-8">      <h1>Register Account</h1>
      <p><!--If you already have an account with us, please login at the <a href="login.php">login page</a>.--></p>
    


 		<form action="processAddCustomer.php" method="post" enctype="multipart/form-data" id="loginForm"  class="form-horizontal" autocomplete="OFF" onsubmit="return finalval();">
  
		    <input type="hidden" id="Latitude" name="Latitude">
<input type="hidden" id="Longitude" name="Longitude">
<div class="form-group required">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Company Name</font></label>
     <div class="col-sm-9">
            
              <input type="text" name="cname"  placeholder="Company Name"  class="form-control" size="50" tabindex=0 required focus/>
                          </div>
          </div>
           
          
          <div class="form-group required">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >State</font></label>
     <div class="col-sm-9">
            
              <select name="state"   id="state" class="form-control" class="styledselect_form_1"  onchange="city1()" ><option value="0" style="width: 12em" >Select</option>
                         <?php 
$sqlm=mysql_query("select * from states");
while($rowm=mysql_fetch_row($sqlm)){
?>
				<option value="<?php echo $rowm[1]; ?>"><?php echo $rowm[1]; ?></option>
<?php } ?>
</select>
                          </div>
          </div>
           
          <div class="form-group required">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >City</font></label>
     <div class="col-sm-9">
        <div id="city1" >
<select  name="city" class="form-control" class="styledselect_form_1" id="city" ><option value="0" style="width: 15em" >select</option>

</select></div>                  </div>
          </div>
            


<div class="form-group required">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Area</font></label>
     <div class="col-sm-9">
            
              <input type="text"  class="form-control" name="area" id="area"   required autofocus/><div id="search_suggest">

</div>
                          </div>
          </div>
           
          
          
<div class="form-group required">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Address</font></label>
     <div class="col-sm-9">
            
              <input type="text"  class="form-control" name="add2"  class="inp-form" required autofocus/>
                          </div>
          </div>
            
          
          <div class="form-group required">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Company Telephone</font></label>
     <div class="col-sm-9">
            
            <!-- <input type="text"  class="form-control" name="phone" size="50" class="inp-form" required autofocus onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength='10' placeholder="(Pls Enter number only..)"/>
                          </div>-->
                          
                       
              <input type="text" name="contact" maxlength ="10" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="" <?php } ?> id="contact"  class="form-control" onblur="checkcontact();" value="<?php if($Mobile!=""){ echo $Mobile;} ?>"  onkeypress='return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46' required autofocus/>
                       <input type="hidden" name="contact2" id="contact2"   class="form-control" value="<?php if($Mobile!=""){ echo  $Mobile;} ?>"/>
                       
                          </div>
          </div>
            
          
             <div class="form-group ">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Company Fax</font></label>
     <div class="col-sm-9">
            
             <!--<input type="text"  class="form-control" id="txtFax" onblur="ValidateFax();" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength='11' name="fax" class="inp-form" />
                          </div>-->
                          
                          
              <input type="text" name="contact" maxlength ="11" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="" <?php } ?> id="contact"  class="form-control" onblur="checkcontact();" value="<?php if($Mobile!=""){ echo $Mobile;} ?>"  onkeypress='return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46' required autofocus/>
                       <input type="hidden" name="contact2" id="contact2"   class="form-control" value="<?php if($Mobile!=""){ echo  $Mobile;} ?>"/>
                       
                          </div>
          </div>
            
          
          
             <div class="form-group required">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Company Email</font></label>
    <div class="col-sm-9">
            <input type="email"  class="form-control" name="email" id="email" class="inp-form" onblur="checkemail();" required/>Email will be sent to this email id<br/>
            </div>
                          </div>
         
            
          
           <div class="form-group required">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Contact Person</font></label>
     <div class="col-sm-9">
            
<input type="text"  name="contact" class="form-control" class="inp-form" placeholder="Enter character only"  required autofocus/>
                          </div>
          </div> 
            
          
          <div class="form-group required">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Mobile</font></label>
    <!-- <div class="col-sm-9">
            
<input type="text" name="mobile" id="mobile" class="form-control" class="inp-form"  onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength='10' minlength='10' onblur="checkcontactno();" required autofocus/>
                          </div>-->
                          <div class="col-sm-9">
              <input type="text" name="contact" maxlength ="10" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="Mobile" <?php } ?> id="contact"  class="form-control" onblur="checkcontact();" value="<?php if($Mobile!=""){ echo $Mobile;} ?>"  onkeypress='return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46' required autofocus/>
                       <input type="hidden" name="contact2" id="contact2"   class="form-control" value="<?php if($Mobile!=""){ echo  $Mobile;} ?>"/>
                       
                          </div>
                          
                          
          </div>
            
    

      
          
            <div  class="form-group required">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Company Category</font></label>
   
     <div class="col-sm-9">
            
<!--<select name="cat" id="cat"  class="form-control" class="styledselect_form_1"  required><option value="" >select</option>-->

<div class="compny">
<!--<div class="compny">-->
   
    <span class="input">
        <select   id="compny" name="compny"    onchange="city1()" >
         <?php 
           		   while($row = mysql_fetch_row($result))
					{  ?>
				
				
				
      	<option   value="<?php echo $row[0]; ?>" /> <?php echo $row[1]; ?><?php echo $rowm[1]; ?></option>
                     <br/>
   	
			<!--	 <select name="compny"   id="compny" class="form-control" class="styledselect_form_1"  onchange="city1()" >
                    	<option style="width: 12em" value="<?php echo $row[0]; ?>" /> <?php echo $row[1]; ?><?php echo $rowm[1]; ?></option>
                     <br/>
                     </select>-->
<?php } ?>
        </select>
    </span>
</div>







    <div id="res" ></div>
                          </div>
          </div>
           
          
            
          
            <div class="form-group ">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Company Logo</font></label>
     <div class="col-sm-9">
            
<input type="file" name="logo"  padding="0" class="form-control" class="inp-form"  size="50"/><p style="color:red">( Upload image only..)</p>
                          </div>
          </div>
            
          
            <div class="form-group ">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Shop and Establisment Licence</font></label>
     <div class="col-sm-9">
            
<input type="text"  class="form-control" name="lic" size="50" class="inp-form" />
          </div>
          </div>
          
           <div class="form-group ">
    <label class="col-sm-3 control-label" for="input-firstname">
        <font color="black" >Company Type</font></label>
     <div class="col-sm-9">
            
<select  class="form-control" id="ctyp" name="ctyp" class="inp-form" onchange="disfn('');">
    <option value="0">Select type</option>
    <option value="1" >Partnership</option>
    <option value="2" >Proprietorship</option>
    
</select>
                          </div>
          </div>
            
          <script>
              function disfn(sts){
                  try
                  {
                 
                  if(document.getElementById('ctyp').value=="1")
                  {
                      
                      
              
              document.getElementById('hide').style.display="block";
              document.getElementById('nomem').setAttribute('required','required');
                  }else
                  {
                   document.getElementById('hide').value="";
                   document.getElementById('hide').style.display="none";
                   document.getElementById('nomem').removeAttribute('required','required');
                   document.getElementById('attatch').innerHTML="";
              
                 
                  }
                  }catch(ex)
                  {
                    alert(ex);  
                  }
              }
          </script>
             <div class="form-group " id="hide" style="display:none">
    <label class="col-sm-3 control-label" ><font color="black">No. of Partner</font></label>
     
            <div class="col-sm-9">
                <input type="text" id="nomem" name="nomem" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="addItem();"> 
            </div>

                       
          </div>
            
             <div class="form-group " >
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" ></font></label>
     <div class="col-sm-9" id="attatch">
            

                          </div>
          </div>
            
            
            
                    <div class="form-group required">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Date Of Registration</font></label>
     <div class="col-sm-9">
            
<input type="text"   class="form-control" name="rdate" id="rdate" data-maxdate="<?php echo date("Y-m-d", strtotime("+1 day"));?>"  class="inp-form" required autofocus/>
                         <!-- <script src="datepc/dcalendar.picker.js"></script>-->
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="datepc/dcalendar.picker.js"></script>

<script>
$('#rdate').dcalendarpicker({format: 'dd-mm-yyyy'});
</script>


                          </div>
          </div> 
            
            
            
            
            
            
            
            
            
            
            
             <div class="form-group ">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Year Of Establishment</font></label>
     <div class="col-sm-9">
            
<!--<input type="text"  class="form-control" name="fees" size="50" class="inp-form" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength='4' />

                          </div>-->
                          
                           
              <input type="text" name="fees" maxlength ="4" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="" <?php } ?> id="contact"  class="form-control" onblur="checkcontact();" value="<?php if($Mobile!=""){ echo $Mobile;} ?>"  onkeypress='return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46' required autofocus/>
                       <input type="hidden" name="contact2" id="contact2"   class="form-control" value="<?php if($Mobile!=""){ echo  $Mobile;} ?>"/>
                       
                          </div>
                          
                          
                          
          </div>
            
          
            
          
             <div class="form-group required">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Adhar card no.</font></label>
     <div class="col-sm-9">
            
<!--<input type="text" class="form-control" name="adhar" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="12" size="50" class="inp-form" required autofocus/>-->


              <input type="text" name="adhar" maxlength ="12" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="adhar number" <?php } ?> id="adhar"  class="form-control" onblur="checkcontact();" value="<?php if($adhar!=""){ echo $adhar;} ?>"  onkeypress='return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46' required autofocus/>
                       <input type="hidden" name="contact2" id="contact2"   class="form-control" value="<?php if($adhar!=""){ echo  $adhar;} ?>"/>
                       
                         
                          </div>
          </div>
            
          
           <div class="form-group required">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Pan card no.</font></label>
     <div class="col-sm-9">
            
<input type="text" class="form-control" name="pan"  size="50" class="inp-form" required autofocus/>
                          </div>
          </div>
            
          
           <div class="form-group required">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Establishment no.</font></label>
     <div class="col-sm-9">
            
<input type="text" class="form-control"  name="Establishment" class="inp-form" required autofocus/>
                          </div>
          </div>
            


         
           <div class="form-group required">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >GST NO.</font></label>
     <div class="col-sm-9">
            
<input type="vat" name="vat" class="form-control"  class="inp-form" required autofocus/>
                          </div>
          </div>
            
          
          
         <div align="center">
        <input type="submit" class="button" value=Submit />
        <button type="button"  onclick='window.open("admin.php","_self");'>Cancel</button>
        
          </div>
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
<script type="text/javascript"><!--
// Sort the custom fields
$('#account .form-group[data-sort]').detach().each(function() {
	if ($(this).attr('data-sort') >= 0 && $(this).attr('data-sort') <= $('#account .form-group').length) {
		$('#account .form-group').eq($(this).attr('data-sort')).before(this);
	}

	if ($(this).attr('data-sort') > $('#account .form-group').length) {
		$('#account .form-group:last').after(this);
	}

	if ($(this).attr('data-sort') == $('#account .form-group').length) {
		$('#account .form-group:last').after(this);
	}

	if ($(this).attr('data-sort') < -$('#account .form-group').length) {
		$('#account .form-group:first').before(this);
	}
});

$('#address .form-group[data-sort]').detach().each(function() {
	if ($(this).attr('data-sort') >= 0 && $(this).attr('data-sort') <= $('#address .form-group').length) {
		$('#address .form-group').eq($(this).attr('data-sort')).before(this);
	}

	if ($(this).attr('data-sort') > $('#address .form-group').length) {
		$('#address .form-group:last').after(this);
	}

	if ($(this).attr('data-sort') == $('#address .form-group').length) {
		$('#address .form-group:last').after(this);
	}

	if ($(this).attr('data-sort') < -$('#address .form-group').length) {
		$('#address .form-group:first').before(this);
	}
});

$('input[name=\'customer_group_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=account/register/customfield&customer_group_id=' + this.value,
		dataType: 'json',
		success: function(json) {
			$('.custom-field').hide();
			$('.custom-field').removeClass('required');

			for (i = 0; i < json.length; i++) {
				custom_field = json[i];

				$('#custom-field' + custom_field['custom_field_id']).show();

				if (custom_field['required']) {
					$('#custom-field' + custom_field['custom_field_id']).addClass('required');
				}
			}


		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});


//--></script>
<script type="text/javascript"><!--

//--></script>
<script type="text/javascript"><!--
$('select[name=\'country_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=account/account/country&country_id=' + this.value,
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

$('select[name=\'country_id\']').trigger('change');
//--></script>

<!--
  $ospans: allow overrides width of columns base on thiers indexs. format array( column-index=>span number ), example array( 1=> 3 )[value from 1->12]
 -->



 

 
<div id="powered">
  <?php //include('footerbottom.php')
  ?>

</div>


  
<script type="text/javascript">
$(document).ready( function (){
	$(".paneltool .panelbutton").click( function(){	
		$(this).parent().toggleClass("active");
	} );
} );

</script>


<script type="text/javascript">
$('#myTab a').click(function (e) {
	e.preventDefault();
	$(this).tab('show');
})
$('#myTab a:first').tab('show'); 
 

var $MAINCONTAINER = $("html");

/**
 * BACKGROUND-IMAGE SELECTION
 */
$(".background-images").each( function(){
	var $parent = this;
	var $input  = $(".input-setting", $parent ); 
	$(".bi-wrapper > div",this).click( function(){
		 $input.val( $(this).data('val') ); 
		 $('.bi-wrapper > div', $parent).removeClass('active');
		 $(this).addClass('active');

		 if( $input.data('selector') ){  
			$($input.data('selector'), $($MAINCONTAINER) ).css( $input.data('attrs'),'url('+ $(this).data('image') +')' );
		 }
	} );
} ); 

$(".clear-bg").click( function(){
	var $parent = $(this).parent();
	var $input  = $(".input-setting", $parent ); 
	if( $input.val('') ) {
		if( $parent.hasClass("background-images") ) {
			$('.bi-wrapper > div',$parent).removeClass('active');	
			$($input.data('selector'),$("#main-preview iframe").contents()).css( $input.data('attrs'),'none' );
		}else {
			$input.attr( 'style','' )	
		}
		$($input.data('selector'), $($MAINCONTAINER) ).css( $input.data('attrs'),'inherit' );

	}	
	$input.val('');

	return false;
} );



 $('.accordion-group input.input-setting').each( function(){
 	 var input = this;
 	 $(input).attr('readonly','readonly');
 	 $(input).ColorPicker({
 	 	onChange:function (hsb, hex, rgb) {
 	 		$(input).css('backgroundColor', '#' + hex);
 	 		$(input).val( hex );
 	 		if( $(input).data('selector') ){  
				$( $MAINCONTAINER ).find($(input).data('selector')).css( $(input).data('attrs'),"#"+$(input).val() )
			}
 	 	}
 	 });
	} );
 $('.accordion-group select.input-setting').change( function(){
	var input = this; 
		if( $(input).data('selector') ){  
		var ex = $(input).data('attrs')=='font-size'?'px':"";
		$( $MAINCONTAINER ).find($(input).data('selector')).css( $(input).data('attrs'), $(input).val() + ex);
	}
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

            document.getElementById('notification1').innerHTML='<div class="alert alert-success"><i class="fa fa-exclamation-circle"></i> ' +'Registration successfull please login'+ '<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
 
    
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
  
</script><!--<div id="top"><a class="scrollup" href="#"><i class="fa fa-angle-up"></i>TOP</a></div>-->
</div>

 </body>

</html>
 
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.js"></script>


 

 
<script>
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

 <link rel="stylesheet" type="text/css" href="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.css" />
