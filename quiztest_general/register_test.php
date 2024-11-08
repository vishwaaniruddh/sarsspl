<!doctype html>
<!--[if lt IE 7]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->

<head>
    <meta charset="UTF-8">
    <title>Quiz2shine</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    
    <script>
    function fn()
    {
        
        
        //$("#show").load("indexslider");
    }
    
    function validation()
{

try
{

 $(".errlable").css("display", "none");

var name=document.getElementById('name').value;
var lname=document.getElementById('lname').value;
var email=document.getElementById('email').value;

var password=document.getElementById('password').value;
var cpassword=document.getElementById('cpassword').value;


var class1=document.getElementById('class1').value;
var schn=document.getElementById('schname').value;
var unm=document.getElementById('uname').value;



 var re = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

var errc="Red";
var errexs=0;

if(password!=cpassword)
{
document.getElementById("label8").innerHTML="Password and Confirm Password must be same!";
 document.getElementById("label8").style.color=errc;
 document.getElementById("label8").style.display="block";
 document.getElementById("label8").focus();

errexs++;
}


if(cpassword=="")
{
document.getElementById("label8").innerHTML="Confirm Password  !";
 document.getElementById("label8").style.color=errc;
 document.getElementById("label8").style.display="block";
 document.getElementById("label8").focus();

errexs++;
}

if(password=="")
{
document.getElementById("label7").innerHTML="Enter Password  !";
 document.getElementById("label7").style.color=errc;
 document.getElementById("label7").style.display="block";
 document.getElementById("label7").focus();

errexs++;
}

if(unm=="")
{
document.getElementById("label6").innerHTML="Enter USername  !";
 document.getElementById("label6").style.color=errc;
 document.getElementById("label6").style.display="block";
 document.getElementById("label6").focus();

errexs++;
}


if(class1=="")
{
document.getElementById("label5").innerHTML="Select Class  !";
 document.getElementById("label5").style.color=errc;
 document.getElementById("label5").style.display="block";
 document.getElementById("label5").focus();

errexs++;
}


if(schn=="")
{
document.getElementById("label4").innerHTML="Enter School Name !";
 document.getElementById("label4").style.color=errc;
 document.getElementById("label4").style.display="block";
 document.getElementById("label4").focus();

errexs++;
}


if(email!="")
{
alert(email);    
if(!re.test(email))
{
document.getElementById("label3").innerHTML="Enter Your Valid Email !";
 document.getElementById("label3").style.color=errc;
 document.getElementById("label3").style.display="block";
 document.getElementById("label3").focus();

errexs++;
}
}

/*if(email=="")
{
document.getElementById("label3").innerHTML="Enter Your Email !";
 document.getElementById("label3").style.color=errc;
 document.getElementById("label3").style.display="block";
errexs++;

}
*/

if(lname=="")
{
document.getElementById("label2").innerHTML="Enter Your Last Name !";
 document.getElementById("label2").style.color=errc;
 document.getElementById("label2").style.display="block";
document.getElementById("label2").focus();

errexs++;

}


if(name=="")
{
document.getElementById("label1").innerHTML="Enter Your First Name !";
 document.getElementById("label1").style.color=errc;
 document.getElementById("label1").style.display="block";
//alert('Enter Your Name');
document.getElementById("label1").focus();

errexs++;

} 




}catch(ex)
{
    
    alert(ex);
}

if(errexs==0)
{
    
    
    return true;
}else
{
    
    document.getElementById("label10").innerHTML="Rectify Validation Errors to continue";
 document.getElementById("label10").style.color=errc;
 document.getElementById("label10").style.display="block";

    
    return false;
}

}

    
    function subfunc()
    {
      
      try
      {
        
        if(validation())
        {
      var formData = new FormData($('#formf')[0]);
       $.ajax({
       url: 'signup_process.php',
       type: 'POST',
       data: formData,
       async: false,
       cache: false,
       contentType: false,
       enctype: 'multipart/form-data',
       processData: false,
       success: function (response) {
         alert(response);
       }
       
  
   
   
   });
        
        }
    
    }catch(ex)
   {
       
       
       
   }
    }
    </script>
    
    <style>
    label{
        font-size:16px;
        color:#fff;
        text-align:center;
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
        
      <?php include('menu.php');?>  
      
      
            
      


    <div class="wrapper" >
    
        <section id="support" >
            <div class="container"  >
                <div class="section-heading scrollpoint sp-effect3" style="margin-top:120px">
                    <h1 style="color:#fff;">Register</h1>
                    <div class="divider"></div>
                    <p style="color:#fff;">For more info and support, contact us!</p>
                </div>
                <div class="row">
                    <div  class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 scrollpoint sp-effect1">
                                <form role="form" id="formf" enctype='multipart/form-data'>
                                    <div class="form-group">
                                       <label ><b>First name:</b></label><label id="label1" class="errlable">
                                           
                                       </label>
          <input type="text" id="name" name="name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        
                                        
                                        <label for="lname"><b>Last name:</b></label><label id="label2" class="errlable"></label>
          <input type="text" id="lname" name="lname"  class="form-control" >
          
                                    </div>
                                    <div class="form-group">
                                     <label for="mail"><b>Email:</b></label><label id="label3" class="errlable"></label>
          <input type="email" id="email" name="email"  onblur="chkmailexs();"  class="form-control" >
          
                                    </div>
                                    
                                      <div class="form-group">
                                     <label for="img"><b>Profile Image:</b></label>
          <input type="file" id="img" name="img"   >
          
                                    </div>
                                    
                                    
                                  <div class="form-group">
                                     <label for="img"><b>School  Name:</b></label><label id="label4" class="errlable"></label>
          <input type="text"  name="schname" id="schname"  class="form-control" >
          
                                    </div>
                                       
                                    
                                    
                                     <div class="form-group">
                                     <label for="board"><b>Class:</b></label><label id="label5" class="errlable"></label>
         <select name="class1" id="class1"  class="form-control" >
<option value=''>Select Class</option>
<option value='6'>VI</option>
<option value='7'>VII</option>
<option value='8'>VIII</option>
<option value='9'>IX</option>
<option value='10'>X</option>


</select>
                                    </div>
 
 
                         <div class="form-group">
                                    <label for="password"><b>User name:</b> </label><label id="label6" class="errlable"></label>
          <input type="text" id="uname" name="uname" maxlength="20" class="form-control" >
                                    </div>
                                                      
 <div class="form-group">
                                    <label for="password"><b>Password:</b> </label><label id="label7" class="errlable"></label>
          <input type="password" id="password" name="password" maxlength="20" class="form-control" >
                                    </div>
                               

<div class="form-group">
                                    <label for="password"><b>Confirm Password:</b> </label><label id="label8" class="errlable"></label>
          <input type="password" id="cpassword" name="cpassword" maxlength="20" class="form-control">
                                    </div>
 
<div>
                                    <button type="button" class="btn btn-default btn-lg" onclick="subfunc();">Submit</button>
                                    
                                   <label id="label10" class="errlable"></label>
    </div>                                
                                </form>
                            </div>
                            <!--<div class="col-md-4 col-sm-4 contact-details scrollpoint sp-effect2">
                                <div class="media">
                                    <a class="pull-left" href="#" >
                                        <i class="fa fa-map-marker fa-2x"></i>
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">4, Some street, California, USA</h4>
                                    </div>
                                </div>
                                <div class="media">
                                    <a class="pull-left" href="#" >
                                        <i class="fa fa-envelope fa-2x"></i>
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">
                                            <a href="mailto:support@oleose.com">support@oleose.com</a>
                                        </h4>
                                    </div>
                                </div>
                                <div class="media">
                                    <a class="pull-left" href="#" >
                                        <i class="fa fa-phone fa-2x"></i>
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">+1 234 567890</h4>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                        
                        <div  class="col-md-3"></div>
                    </div>
                </div>
            </div>
        </section>
        
        
        
    </header>


        <?php include("footer.php");?>   


    </div>
    
    
   
</body>

</html>
