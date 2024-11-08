<!doctype html>
<!--[if lt IE 7]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<?php
include("config.php");
?>
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
     
      <?php include("includeinallpages.php");?>
  
    <script>
  
    function validation()
{

try
{

 $(".errlable").css("display", "none");

var email=document.getElementById('email').value;

 var re = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

var errc="Red";
var errexs=0;


if(email=="")
{

document.getElementById("label3").innerHTML="Enter Your Valid Email !";
 document.getElementById("label3").style.color=errc;
 document.getElementById("label3").style.display="block";
 document.getElementById("label3").focus();

return false
}


}catch(ex)
{
    
    alert(ex);
}


}

    
    
  

 
    </script>
    
    <style>
    label{
        font-size:16px;
        color:#fff;
        text-align:center;
    }
    
    .card {
    background:-moz-linear-gradient(-45deg, #cc6698 0%, #6b396c 100%) ;
    /* just in case there no content*/
    padding: 20px 25px 30px;
    margin: 0 auto 25px;
    margin-top: 50px;
    /* shadows and rounded borders */
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 70px 70px rgba(0, 0, 0, 0.3);
}
.form-control
{
    
    color:#000;
    
}
   
    </style>
</head>

<body onload="">
    
    <div class="pre-loader">
        <div class="load-con">
            <img src="assets/img/freeze/logo.png" class="animated fadeInDown" alt="">
            <div class="spinner">
              <div class="bounce1"></div>
              <div class="bounce2"></div>
              <div class="bounce3"></div>
            </div>
        </div>
    </div>
   
    <header>
        
      <?php
      
      //include('menu.php');
      
      ?>  
      
      
            
      


    <div>
    
     <section id="reviews">
            <div class="container">
                <div class="section-heading inverse scrollpoint sp-effect3">
                     <h1 style="color:cyan;">Forgot Password</h1>
                    <div class="divider"></div>
                    <p style="color:#fff;">Fields Marked <font color="Red"size="8">*</font> are Mandatory</p>
                
                </div>
               <div class="row">
                    <div  class="col-md-4"></div>
                    
                    <div class="col-md-4" style="margin-top:-130px;">
                         <div class="card " >
                        <div class="row">
                            <div class="col-md-12 col-sm-12 scrollpoint sp-effect3">
                                <form  method="POST" action="forgotpass.php" onsubmit="return validation()">
                                 
                                   
                                    <div class="form-group">
                                     <label for="mail"><font color="Red"size="6">*</font><b>Email:</b></label><label id="label3" class="errlable"></label>
          <input type="email" id="email" name="email"  onblur="chkmailexs();"  class="form-control" style="color:black">
          
                                    </div>
                   
                        
 
<div><center>
                                    <button type="submit" class="btn btn-default btn-lg" >Submit</button>
                                    <button type="button" class="btn btn-default btn-lg" onclick='window.open("login.php","_self");'>Cancel</button>
                                    <label id="label10" class="errlable"></label>
    </center>
    </div>
   <div>
       <br/>
        <center><font color="cyan" size="5">Already have an Account?
        
                            <a href="javascript:void(0);" class="btn btn-primary inverse btn-lg" onclick='window.open("login.php","_self");'>LOG IN</a>
                        </center>
        </div>
                                </form>
                            </div>
    </div>
            </div>
        </section>
        
        </div>
    </header>


        <?php include("footer.php");?>   


    </div>
    
    
   
</body>

</html>




























 <div class="row">               
    <div id="content" class="col-sm-9">      
 <h1>Forgot Your Password?</h1>
      <p>Enter the e-mail address associated with your account. Click submit to have a password e-mailed to you.</p>
       
        <form action="forgotpass.php" method="post" enctype="multipart/form-data" class="form-horizontal">
        <fieldset>
          <legend>Your E-Mail Address</legend>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-email">E-Mail Address</label>
            <div class="col-sm-10">
              <input type="text" name="email" value="" placeholder="E-Mail Address" id="input-email" class="form-control" required/>
            </div>
          </div>
        </fieldset>
        <div class="buttons clearfix">
          <div class="pull-left"><a href="" class="btn btn-default">Back</a></div>
          <div class="pull-right">
            <input type="submit" value="Continue" class="btn btn-primary" />
          </div>
        </div>
      </form>
             </div>
              </div>