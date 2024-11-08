<?php
session_start();
if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){
    
    header("location:index.php");
}else
{
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
                                // include("mancategories.php");
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
 <!-- <ul class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i></a></li>
        <li><a href="#">Account</a></li>
      </ul>-->
    <div class="row" style="height:300px">                
    <div id="content" class="col-sm-9" style="margin-left: 10%;border-radius: 10px;">     
    <h2 style="margin-left: 14px;">Change Password</h2>
    <br />
    <form method="post" action="" onsubmit="return logfnn();">
    <fieldset>
     <div class="form-group required" >
            <label class="col-sm-4 control-label" for="input-password">Enter Current Password</label>
            <div class="col-sm-8">
              <input type="password" name="password" <?php if(isset($_SESSION['loginstats']) & $_SESSION['loginstats']!=""){?> placeholder="Password" <?php } ?> id="password" class="form-control" required autofocus onblur="chkifpasswrd()";/></br>
                          </div>
          </div>
          </fieldset>
           <fieldset>
           <div class="form-group required">
            <label class="col-sm-4 control-label" for="input-confirm">Enter New Password</label>
            <div class="col-sm-8">
              <input type="password" name="confirm1" placeholder="New Password "  id="confirm1" class="form-control"  required autofocus/></br>
                          </div>
          </div>
          </fieldset>
              <fieldset>
          <div class="form-group required">
            <label class="col-sm-4 control-label" for="input-confirm">Password Confirm</label>
            <div class="col-sm-8">
              <input type="password" name="confirm"  placeholder="Password Confirm"  id="confirm" class="form-control"  required autofocus/>
                          </div>
          </div>
          </fieldset><br /><br />
          <input type="submit" value="submit" class="btn btn-primary" style="margin-left: 35%;border-radius: 10px;"/>
         </form>     <br />
      </div>
   
</div>
</div>
 


  
<script type="text/javascript">
var bool=true;
function chkifpasswrd()
{
    try
    {
     var passw=document.getElementById('password').value;
     if(passw.trim()!="")
     {
    $.ajax({
        url: 'chkpasswrd.php',
        type: 'post',
        async: false,
        data:'password='+passw,
         success: function(msg) {
             
              $('.text-danger').parent().addClass('');
                  $('.text-danger').parent().removeClass('has-error');
                 $('.alert, .text-danger').remove();
            if(msg==0)
            {
                 var element2 = $('#password');
$(element2).after('<div class="text-danger">' +'Password is incorrect' + '</div>');
$('.text-danger').parent().addClass('has-error');
    bool=false;
    element2.focus();
     return bool;
                
            }else
            {
                
              bool=true;  
              return bool;
            }
             
             
         },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
     }else
     {
         
        bool=true; 
     }
    }catch(exc)
    {
        alert(exc);
    }
    return bool;
}



function val()
{
    
    if(chkifpasswrd())
    {
   
       try
    {          
     var passw1=document.getElementById('confirm1').value;
     var passw2=document.getElementById('confirm').value;
     if(passw1!=passw2)
     {
        
         var element2 = $('#confirm');
$(element2).after('<div class="text-danger">' +'Password doesnt match' + '</div>');
$('.text-danger').parent().addClass('has-error');
    element2.focus(); 
    return false;
     }else
     {
          $('.text-danger').parent().addClass('');
                  $('.text-danger').parent().removeClass('has-error');
                 $('.alert, .text-danger').remove();
         return true;
     }
     
    }catch(exc)
    {
        alert(exc);
    }
    }else
    {
        
        return false;
    }
    
}

function logfnn()
{
    if(val())
    {
     var passw2=document.getElementById('confirm').value;
     
    $.ajax({
        url: 'processupdpass.php',
        type: 'post',
        data:'password='+passw2,
        success: function(msg) {
            //alert(msg);
            $('.alert, .text-danger').remove();
            $('.form-group').removeClass('has-error');

            if (msg==0) {
                 document.getElementById('notification1').innerHTML='<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' +'Some error occured please try again'+ '<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
            } else {
          document.getElementById('notification1').innerHTML='<div class="alert alert-success"><i class="fa fa-exclamation-circle"></i> ' +'Updated successful'+ '<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
       
		
		   }
		   
		   var scrollPos =  $("#notification1").offset().top;
 $(window).scrollTop(scrollPos);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
    }

    return false;
}




</script>

 
 

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
<?php } ?>