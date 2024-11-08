<?php 
session_start();
include('config.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="icon" href="images/favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,700%7CRoboto+Slab:400,300,700">
    <link rel="stylesheet" href="css/sig.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    

    <style>
        .busy * {
            cursor: wait !important;
        }
        
        .button {
            background-color: #FBBA00;
            border: none;
            color: white;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            -webkit-transition-duration: 0.4s;
            /* Safari */
            transition-duration: 0.4s;
            cursor: pointer;
        }
        .button2{
            .button {
            background-color: #FBBA00;
            border: none;
            color: white;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            -webkit-transition-duration: 0.4s;
            /* Safari */
            transition-duration: 0.4s;
            cursor: pointer;
        }
        }
        
        .button1 {
            background-color: #FBBA00;
            color: #fff;
            font-family: "Open Sans", Helvetica, Arial, sans-serif;
            font-size: 22px;
            padding: 8px 10px;
        }
        
        
        
      
/* unvisited link */
.test2:link {
    color: #5B5B5B;
    text-decoration: none;
}
}

/* visited link */
.test2:visited {
    color: #5B5B5B;
}

/* mouse over link */
.test2:hover {
    color: #00A0E3;
     text-decoration: underline;
}

/* selected link */
.test2:active {
    color: #5B5B5B;
}
.col-md-6 {
    width: 33%;
}
.col-md-offset-3 {
    margin-left: 34%;
}
</style>

<script>
    function abc(){
             
              var forgetemail=document.getElementById("email").value;
               //alert(forgetemail)
              $.ajax({
   type: 'POST',    
   url:'forget_process.php',
  
    data:'forgetemail='+forgetemail,

   success: function(msg){
       //alert(data);
      if(msg==1){
swal("password has been sent to your Email Id");

window.open("index.php","_self");

}
else
{
swal("Invalid Email ID. Please enter the correct email address");
return false;
window.open("index.php","_self");
}
    
  // alert(msg);
  
   
} })
              
            }
            
            function validation1()
{

     var email= document.getElementById("email").value;
     var emailFilter =  /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/ ;
   
     
      if(email=="")
     {
     swal("please enter Email id ");
     return false;
     }
     else if (!emailFilter.test(email))
	{
		
		swal("invalid email ")
		return false;
	}
     
     else{
 
     
     return true;
          }
}

function final(){
    if(validation1() && abc())
    {
       return true; 
    }
    else
    {
        
        return false; 
        
    }
}
</script>
<script>
function validation(){
   
	var userName = document.getElementById("uname").value;
	var password = document.getElementById("pass").value;
	
	if (userName == "")
	{
		alert("userName can not be empty");
		return false;
	}
	else if (password == "")
	{
		alert("password can not be empty");
		return false;
	}
	
	
	return true;
}

</script>

</head>

<body>
    
        <div class="row" style="margin-right:0px;">
            <div class="col-md-12" style="
    right: 15px;
">
                <!--<div class="row"  style="border:0px solid #000;">
                    <div class="col-md-3" style="border:0px solid #000;"> <img src='images/logo.png' class="img-responsive" alt='logo.jpg'  style="height: 100px;  width: 340px;margin-top:3%;margin-left:9%;"></div>
                </div>-->
                
                
                
                <div class="row" style="margin-top:2%;">
                    <div class="col-md-6 col-md-offset-3" style="border: 1px solid #bfbfbf;">
                  <form class="login" action="process_login.php" method="post" style="
    margin-bottom: 0px;
    margin-top: 0px;
    padding-bottom: 0px;
">
            <fieldset>
                                <center>
                                    <h3 style="color:#00A0E3; font-size:22px; margin-bottom:20px;"><b>Login</b></h3></center>
                                    
                                <center>
                                    
                                     <label><font color="red"><?php if($_GET['sts']=="1"){ echo "Incorrect Userid & Password";}?></font></label><br>
                                     
                                    <font for="mail" style="color:#5B5B5B;">User Name</font></center>
                               <input type="text" placeholder="User Name" id="uname" name="uname" required style=" margin-bottom:-0.2px;">
                                <center>
                                    <label id="label3" style="font-size:12px;"></label>
                                </center>
                                <center> <font for="password" style="color:#5B5B5B;">Password </font></center>
                                <input type="password" placeholder="Password" id="pass" name="pass" required style=" margin-bottom:-0.1;">
                               
                                
                                <center>
                                    <button class="button button1" style="margin-top:15px;"><b>CONTINUE</b></button>
                                </center>
                                <!--<center>
                                    <p style="margin-top:3px;"><font style="color:#5B5B5B; font-family: " Open Sans ", Helvetica, Arial, sans-serif;">Don't have an account yet? </font>&nbsp;<a href="registrationnew.php">Free Sign up</a> <img src="images/iconimg.png" style="width:2%; height:3%;"></p>
                                </center>-->
                            </fieldset>
                            
                        </form>
                        <center>
                                   <!---POPUp--->
                                   <div class="container" style="
    width: 270px;
    padding-left: 0px;
    padding-right: 0px;
">

    <center> 
  
  <!-- Trigger the modal with a button
  <button type="button" class="button button1" style="font-size:10px;width: 117px;background-color: #fbba00;border-color: #fbba00;border-bottom-width: 0px;padding-bottom: 10px;margin-top: 0px;margin-bottom: 19px;border-radius: 50px;hover: blue;" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Forgot Password</button>
   -->
   <button class="button button1"  class="btn btn-info btn-lg" style="font-size: 13px;margin-top: 0px;margin-bottom: 10px;padding-left: 0px;padding-right: 0px;width: 124px;height: 31px;padding-bottom: 13px;border-bottom-width: 12px;padding-top: 6px;" data-toggle="modal" data-target="#myModal">Forgot Password</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" style="
    
    margin-top: 100px;
">
    
      <!-- Modal content-->
      <div class="modal-content" style="
    width: 351px;
    border-bottom-width: 0px;
    border-top-width: 0px;
    margin-top: 0px;
">
          
        
        <div class="modal-body" style="
    padding-top: 0px;
    padding-bottom: 0px;
    padding-right: 0px;
    padding-left: 16px;
    right: 1px;
">
        <form class="login" action="" method="post">
            <fieldset style=" padding-right: 7px;">
                                <center>
                                    <h3 style="color:#00A0E3;font-size:22px;margin-bottom: 10px;padding-left: 0px;padding-right: 16px;margin-top: 10px;width: 246px;"><b>Password Recovery</b></h3></center>
                                    
                                <center>
                                    
                                    <font for="mail" style="color:#5B5B5B;">Email</font></center>
                                   
                               <input type="text" placeholder="Email" id="email" name="email" required style="border: 1px solid #ccc;border-radius: 50px;font-size: 16px;height: auto;outline: 0;padding: 9px;width: 100%;color: #000000;box-shadow: 0 1px 0 rgba(0,0,0,0.03) inset;margin-bottom:-0.2px;">
                               <br><br>
                                <center>
                                    <input type="Button" Value="Continue" onclick="final()" style="border-radius: 50px;width: 206px;height: 37px;background-color: #fbba00;">
                            
                            </center>
                            </fieldset>
                        </form>
        </div>
       
          <div class="modal-footer">
          <button type="button" class="btn btn-default" style="
    width: 60px;
    height: 25px;
    padding-top: 0px;
    padding-bottom: 0px;
    margin-top: 7px;
" data-dismiss="modal">Close</button>
        </div>
          
          
        </div><!---POPUp END--->
                                </center>
                    </div>
                </div>
                <!--<div class="row">
                    <div class="col-md-3 col-md-offset-9" style="margin-top:6%;">
                        <footer>
                            <p style="font-size:14px;"><font style="color:#00A0E3; ">Privacy policy.</font> @ <font style="color: #5B5B5B;">Copyright <a class="test2" href="index2.php" >test2shine.com</a></font></p>
                        </footer>
                    </div>
                </div>-->
            </div>
             </div>
                
        
        <!-- <div style="margin-top:5px;"><img src="images/logo.png" style="width:250px; height:80px;"></div>--></div>
</body>

</html>