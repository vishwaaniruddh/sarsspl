<?php
 session_start();
include '../head.php';


$userid=$_SESSION['gid'];

 
$fname    = mysqli_real_escape_string($con1, $_POST['fname']);
 
$lname    = mysqli_real_escape_string($con1, $_POST['lname']);
// $country=$_POST["country"]; 

$address    = mysqli_real_escape_string($con1, $_POST['address']);

$city    = mysqli_real_escape_string($con1, $_POST['city']);

 
$state    = mysqli_real_escape_string($con1, $_POST['state']);

$pincode    = mysqli_real_escape_string($con1, $_POST["postcode"]); 
 
$mobile    = mysqli_real_escape_string($con1, $_POST["phone"]);
 
$email    = mysqli_real_escape_string($con1, $_POST["email"]);

$landmark    = mysqli_real_escape_string($con1, $_POST["landmark"]);
$time = date('Y-m-d');


if(isset($_POST['UpdateAccount'])){

    mysqli_query($con1,"UPDATE Registration SET Firstname='".$fname."',Lastname='".$lname."',Mobile = '".$mobile."' where id='".$userid."'");


$add_check = mysqli_query($con1,"select * from address where userid ='".$userid."' and is_primary = 1");

if($add_check_result = mysqli_fetch_assoc($add_check)){
    $update = "update address set fname = '".$fname."',lname='".$lname."',email='".$email."',mobile='".$mobile."', address='".$address."', landmark='".$landmark."', state= '".$state."',city='".$city."',pincode ='".$pincode."',updated_at = '".$time."' where userid='".$userid."' and is_primary=1"; 

    if(mysqli_query($con1,$update)){ ?>
      <script>
          swal('Profile Updated Successfully !');
          setTimeout(function(){ 
              window.history.back();
               
          }, 1500);

      </script>
<? }  
}
else{
    $insert = "insert into address(userid, fname,lname,email,mobile, address, landmark, state,city,pincode,created_at,is_primary) values('".$userid."','".$fname."','".$lname."','".$email."','".$mobile."', '".$address."', '".$landmark."',  '".$state."','".$city."','".$pincode."','".$time."','1')";
    if(mysqli_query($con1,$insert)){ ?>

      <script>
          swal('Address inserted Successfully !');
          setTimeout(function(){ 
              window.history.back();
               
          }, 1500);

       </script>
 <? }    

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


return; 
