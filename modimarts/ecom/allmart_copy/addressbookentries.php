<?php
session_start();
?>
<!DocTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="ltr" lang="en" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="ltr" lang="en" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="ltr" class="ltr" lang="en">
    <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Account Login</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
        <script type="text/javascript" src="catalog/view/javascript/jquery/jquery-2.1.1.min.js"></script>
       <script type="text/javascript" src="requiredfunctions.js"></script>
                    	    	<link href="http://sarmicrosystems.in/oc1/image/catalog/cart.png" rel="icon" />
    	                <link href="catalog/view/theme/pav_bigstore/stylesheet/bootstrap.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/stylesheet.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/paneltool.css" rel="stylesheet" />
                <link href="catalog/view/javascript/jquery/colorpicker/css/colorpicker.css" rel="stylesheet" />
                <link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/animate.css" rel="stylesheet" />
                <link href="catalog/view/javascript/jquery/magnific/magnific-popup.css" rel="stylesheet" />
                <link href="catalog/view/javascript/jquery/owl-carousel/owl.carousel.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/fonts.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/pavnewsletter.css" rel="stylesheet" />
                <script type="text/javascript" src="catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/bootstrap/js/bootstrap.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/common.js"></script>
                <script type="text/javascript" src="catalog/view/theme/pav_bigstore/javascript/common.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/pavdeals/countdown.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/colorpicker/js/colorpicker.js"></script>
        
    <!-- FONT -->

        <!-- FONT -->

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
      </head>

<body class="common-home page-common-home layout-fullwidth">
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
                                 <?php 
                                 include("mancategories.php");
                                 ?>                        
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
         <div id="sys-notification1">
          <div class="container">
            <div id="notification1"> 
                
             
                
                
            </div>
          </div>
        </div>
                       
 <div class="container">
  <ul class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i></a></li>
        <li><a href="myacc.php">Account</a></li>
      </ul>
    <div class="row" >       
    <div id="shw" class="col-lg-9 col-md-9 col-sm-12 sidebar col-xs-12">
   
   </div>
   
   
    <div id="column-right" class="col-lg-3 col-md-3 col-sm-12 sidebar col-xs-12">
    <div class="list-group">
    <?php include('myaccsidemenu.php');?>
  </div>
  </div>
</div>
</div>
 
<footer id="footer" class="nostylingboxs">

  <?php include("footer.php")?>

</footer>
 
<div id="powered">
    
 <?php include('footerbottom.php')?>
 
</div>


  
<script type="text/javascript">

function delfn(id)
{
    
    try
    {
        
       $.ajax({
        url: 'delcustaddresses.php',
        type: 'post',
        data:'id='+id,
        success: function(msg) 
        {
           // alert(msg);
           //document.getElementById('shw').innerHTML=msg;
           if (msg==1) {
                document.getElementById('notification1').innerHTML='<div class="alert alert-success"><i class="fa fa-exclamation-circle"></i> ' +'Delete successful'+ '<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
            } else {
          
        document.getElementById('notification1').innerHTML='<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' +'Some error occured please try again'+ '<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
		
		   }
           
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
    }
    catch(ex)
    {
        
        alert(ex);
    }
}


function editfn(id)
{
    
    try
    {
        
       $.ajax({
        url: 'editcustaddresses.php',
        type: 'post',
        data:'id='+id,
        success: function(msg) 
        {
           // alert(msg);
           document.getElementById('shw').innerHTML=msg;
          
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
    }
    catch(ex)
    {
        
        alert(ex);
    }
}



function displfunc(showsts)
{
    
    try
    {
        
        if(showsts!="")
        {
            showstatsfunc(showsts);
        }
        
       $.ajax({
        url: 'getcustaddresses.php',
        type: 'post',
        data:'',
        success: function(msg) 
        {
            
           document.getElementById('shw').innerHTML=msg;
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
    }
    catch(ex)
    {
        
        alert(ex);
    }
}


function logfnn()
{
    
     var eml=document.getElementById('input-email').value;
    var passw=document.getElementById('input-password').value;
    $.ajax({
        url: 'loginprocessnew.php',
        type: 'post',
        data:'email='+eml+'&password='+passw,
        beforeSend: function() {
        	$('#button-login').button('loading');
		},
        complete: function() {
            $('#button-login').button('reset');
        },
        success: function(msg) {
            //alert(msg);
            $('.alert, .text-danger').remove();
            $('.form-group').removeClass('has-error');

            if (msg==1) {
                location = 'index.php';
            } else {
            //    $('#well').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' +'Incorrect username and password'+ '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
			
			toastfunc("Incorrect username and password");
			$('input[name=\'email\']').parent().addClass('has-error');
				$('input[name=\'password\']').parent().addClass('has-error');
		   }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}


$(document).ready( function (){
displfunc('');
} );




function getloc()
{
// alert("ok");

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


document.getElementById("input-payment-zone").value=jsr['region_name'];
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


function city2(city)
{alert(city)
    try
    {
     var str=document.getElementById('input-payment-zone').value;
//alert("ok");
     $.ajax({
             type: "GET",
             url: "getCity.php",
		
   data:"id="+str+"&city="+city,

             success: function(msg){
                // alert(msg);
                  document.getElementById("city1").innerHTML=msg;
             },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
     });
    }catch(ex)
    {
        alert(ex);
    }
    
}

function showstatsfunc(sts)
{
    try
{
    //alert(sts);
    if(sts=="0")
    {
 
 
            document.getElementById('notification1').innerHTML='<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' +'Some error occured please try again'+ '<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
}
else
{

            document.getElementById('notification1').innerHTML='<div class="alert alert-success"><i class="fa fa-exclamation-circle"></i> ' +'Successful'+ '<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
 
}
}catch(exc)
{
    alert(exc);
}
        
    }

function addresfn(id)
{
    try
    {
    var fd=new FormData($('#usenewaddr')[0]);
    fd.append("id",id);
     $.ajax({
            url: "process_useraddress.php",
            type: "POST",
            data:fd,    
            contentType: false,
            cache: false,
            processData:false,
success: function(text){
    //alert(text);
    displfunc(text);
}
});
             
    }catch(ex)
    {
        alert(ex);
    }
    return false;
}



</script>



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