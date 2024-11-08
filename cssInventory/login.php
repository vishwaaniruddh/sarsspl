<?php
session_start();

?>
<html>
<head>
<title>LoginPage</title>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<!------ Include the above in your HEAD tag ---------->
<?php include 'header.php'?>
<style>
body, html {
    height: 100%;
    background-repeat: no-repeat;
   
    background-color:  #f35e3f  ;
    
}

.card-container.card {
    max-width: 350px;
    padding: 40px 40px;
}

.btn {
    font-weight: 700;
    height: 36px;
    -moz-user-select: none;
    -webkit-user-select: none;
    user-select: none;
    cursor: default;
}

/*
 * Card component
 */
.card {
    background-color: #F7F7F7;
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
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}

.profile-img-card {
    width: 96px;
    height: 96px;
    margin: 0 auto 10px;
    display: block;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}

/*
 * Form styles
 */
.profile-name-card {
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    margin: 10px 0 0;
    min-height: 1em;
}

.reauth-email {
    display: block;
    color: #404040;
    line-height: 2;
    margin-bottom: 10px;
    font-size: 14px;
    text-align: center;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin #inputEmail,
.form-signin #inputPassword {
    direction: ltr;
    height: 44px;
    font-size: 16px;
}

.form-signin input[type=email],
.form-signin input[type=password],
.form-signin input[type=text],
.form-signin button {
    width: 100%;
    display: block;
    margin-bottom: 10px;
    z-index: 1;
    position: relative;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin .form-control:focus {
    border-color: rgb(104, 145, 162);
    outline: 0;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
}

.btn.btn-signin {
    /*background-color: #4d90fe; */
    background-color: rgb(104, 145, 162);
    /* background-color: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
    padding: 0px;
    font-weight: 700;
    font-size: 14px;
    height: 36px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    border: none;
    -o-transition: all 0.218s;
    -moz-transition: all 0.218s;
    -webkit-transition: all 0.218s;
    transition: all 0.218s;
}

.btn.btn-signin:hover,
.btn.btn-signin:active,
.btn.btn-signin:focus {
    background-color: rgb(12, 97, 33);
}

.forgot-password {
    color: rgb(104, 145, 162);
}

.forgot-password:hover,
.forgot-password:active,
.forgot-password:focus{
    color: rgb(12, 97, 33);
}
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

       
        <script>
        
            function rep(){  debugger;
               var email=document.getElementById("inputEmail").value;
            //alert("h"+email);
               var password=document.getElementById("inputPassword").value;
           //alert("g"+password);
           
            
             $.ajax({
   type: 'POST',    
   url:'login_process.php',
  
  //  data:'email='+email+'&password='+password,
   data : {email:email,password:password},
   success: function(msg){ debugger;
      if(msg==1){
swal("successfuly login");

window.open("dashboard1.php","_self");

}
else
{
swal("invalid username or password");
window.open("login.php","_self");
}
    
  // alert(msg);
  
   
} })
            }
        </script>
        <!---------------------------------------------------------->
        <script>
            
            function abc(){
             
              var forgetemail=document.getElementById("email").value;
               //alert("hello")
              $.ajax({
   type: 'POST',    
   url:'forgetlogin_process.php',
  
    data:'forgetemail='+forgetemail,

   success: function(msg){
      alert(msg);
      if(msg==1){
swal("password has been sent to your Email Id");

window.open("login.php","_self");

}
else
{
swal("invalid username or password");
window.open("login.php","_self");
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

</head>
    <div class="container">
        <div class="card card-container">

            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
<h2 align="center">Login</h2>
            <form class="form-signin">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
               <center>
                                    <!---POPUp--->
                                   <div class="container" style="
    width: 270px;
    padding-left: 0px;
    padding-right: 0px;
">

    <center> 
  
  <!-- Trigger the modal with a button -->
  <button type="button"    style="font-size:10px;width: 117px;background-color: #6891a2;border-color: #6891a2;" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Forgot Password</button>
  

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
                                    <h3 style="color:#00A0E3;font-size:22px;margin-bottom: 10px;padding-left: 0px;padding-right: 16px;margin-top: 10px;"><b>Password Recovery</b></h3></center>
                                    
                                <center>
                                    
                                    <font for="mail" style="color:#5B5B5B;">Email</font></center>
                                   
                               <input type="text" placeholder="Email" id="email" name="email" required style="border: 1px solid #ccc;border-radius: 50px;font-size: 16px;height: auto;outline: 0;padding: 9px;width: 100%;color: #000000;box-shadow: 0 1px 0 rgba(0,0,0,0.03) inset;margin-bottom:-0.2px;">
                               <br><br>
                                <center>
                                    <input type="Button" Value="Continue" class="button" onclick="final()"; style="border-radius: 50px;width: 206px;height: 37px;">
                                </center>
                            </fieldset>
                        </form>
        </div>
       
          <div class="modal-footer">
          <button type="button" class="btn btn-default" style="
    width: 60px;
" data-dismiss="modal">Close</button>
        </div>
          
          
        </div><!---POPUp END--->
                                </center>
                <input type="button" value="Sign in" class="btn btn-lg btn-primary btn-block btn-signin"  onclick="rep()">
            </form><!-- /form -->
           <!-- <a href="#" class="forgot-password">
                Forgot the password?
            </a>/
             <a href="registration.php" class="forgot-password">
                Registration
            </a>-->
        </div><!-- /card-container -->
    </div><!-- /container -->