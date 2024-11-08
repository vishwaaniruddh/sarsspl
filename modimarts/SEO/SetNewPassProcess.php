<?php
session_start();
include('head.php');

$email=$_POST["email"];  
$pass_token=$_POST["pass_token"];  
$passwd=$_POST["passwd"];  
$cpass=$_POST['cpass'];


if(isset($_POST['UpdatePass']) && isset($_POST['email']) && isset($_POST['pass_token']) && isset($_POST['passwd']) && isset($_POST['cpass'])){
$add_check = mysqli_query($con1,"select * from Registration where email ='".$email."' AND pass_token='".$pass_token."'");

if($add_check_result = mysqli_fetch_assoc($add_check)){
  $password=$add_check_result['email'];
  $userid=$add_check_result['id'];

    
    if($password==$email)
    {
    if($passwd==$cpass){
      

       mysqli_query($con1,"UPDATE login SET password='".$passwd."' where regid='".$userid."'");
       $update= mysqli_query($con1,"UPDATE Registration SET password='".$passwd."',pass_token='' where id='".$userid."'");

    if($update){ 

      ?>
      <script>
          swal('Password Updated Successfully !');
          setTimeout(function(){ 
             window.location.href='https://allmart.world/login.php'; 
               
          }, 1500);

      </script>
     <? }
     else
     {
      ?>
  <script>
          swal('Password Not Updated !');
          setTimeout(function(){ 
              window.location.href='https://allmart.world/login.php';
               
          }, 1500);

      </script>
 <?php
     }

      }
      else
      {
        ?>
      <script>
          swal('New And Confirm Password Not Match !');
          setTimeout(function(){ 
              window.location.href='https://allmart.world/login.php';
               
          }, 1500);

      </script>
     <?php

      }

    }
    else
    {
      ?>
  <script>
          swal('Email Not Found');
          setTimeout(function(){ 
            window.location.href='https://allmart.world/login.php';
               
          }, 1500);

      </script>
 <?php
    }
}
else
{
   ?>
  <script>
          swal('Invalid Token !');
          setTimeout(function(){ 
             window.location.href='https://allmart.world/login.php';
               
          }, 1500);

      </script>
 <?php

}  
}
else{
 ?>
  <script>
          swal('Profile Not Updated !');
          setTimeout(function(){ 
             window.location.href='https://allmart.world/login.php';
               
          }, 1500);

      </script>
 <?php

}


?>