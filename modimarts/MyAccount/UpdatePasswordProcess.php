<?php
 session_start();
include '../head.php';


$userid=$_SESSION['gid'];
 $cPass    = mysqli_real_escape_string($con1, $_POST["cPass"]);

$NPass    = mysqli_real_escape_string($con1, $_POST["NPass"]);  

$CNPass    = mysqli_real_escape_string($con1, $_POST['CNPass']);

$time = date('Y-m-d');


if(isset($_POST['UpdatePass'])){
$add_check = mysqli_query($con1,"select * from Registration where id ='".$userid."'");

if($add_check_result = mysqli_fetch_assoc($add_check)){
  $password=$add_check_result['password'];

    
    if($password==$cPass)
    {
    if($NPass!=$password){
      if($NPass==$CNPass)
      {

       mysqli_query($con1,"UPDATE login SET password='".$CNPass."' where regid='".$userid."'");
       $update= mysqli_query($con1,"UPDATE Registration SET password='".$CNPass."' where id='".$userid."'");

    if($update){ ?>
      <script>
          swal('Password Updated Successfully !');
          setTimeout(function(){ 
              window.history.back();
               
          }, 1500);

      </script>
     <? }
     else
     {
      ?>
  <script>
          swal('Profile Not Updated !');
          setTimeout(function(){ 
              window.history.back();
               
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
              window.history.back();
               
          }, 1500);

      </script>
     <? 

      }
  }
  else
  {
  	?>
  <script>
          swal('Current Password And New Password Same Enter Diffrent Password !');
          setTimeout(function(){ 
              window.history.back();
               
          }, 1500);

      </script>
 <?php

  }

    }
    else
    {
      ?>
  <script>
          swal('Current Password Not Correct !');
          setTimeout(function(){ 
              window.history.back();
               
          }, 1500);

      </script>
 <?php
    }
}
else
{
   ?>
  <script>
          swal('Profile Not Updated !');
          setTimeout(function(){ 
              window.history.back();
               
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
              window.history.back();
               
          }, 1500);

      </script>
 <?php

}


?>