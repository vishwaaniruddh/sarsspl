<?php
 session_start();
include '../head.php';


$userid=$_SESSION['gid'];


// $country=$_POST["country"]; 

$address    = mysqli_real_escape_string($con1, $_POST['address']);

$city    = mysqli_real_escape_string($con1, $_POST['city']);


$state    = mysqli_real_escape_string($con1, $_POST['state']);

$pincode    = mysqli_real_escape_string($con1, $_POST['postcode']);

$landmark    = mysqli_real_escape_string($con1, $_POST['landmark']);
$time = date('Y-m-d');


if(isset($_POST['UpdateAccount'])){

$add_check = mysqli_query($con1,"select * from address where userid ='".$userid."' and is_primary = 1");

if($add_check_result = mysqli_fetch_assoc($add_check)){
    $update = "update address set address='".$address."', landmark='".$landmark."', state= '".$state."',city='".$city."',pincode ='".$pincode."',updated_at = '".$time."' where userid='".$userid."' and is_primary=1"; 

    if(mysqli_query($con1,$update)){ ?>
      <script>
          swal('Address Updated Successfully !');
          setTimeout(function(){ 
              window.history.back();
               
          }, 1500);

      </script>
<? }  
}
else{
    $insert = "insert into address(userid, address, landmark, state,city,pincode,created_at,is_primary) values('".$userid."','".$address."', '".$landmark."',  '".$state."','".$city."','".$pincode."','".$time."','1')";
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
          swal('Address Not Updated !');
          setTimeout(function(){ 
              window.history.back();
               
          }, 1500);

      </script>
 <?php

}


return; 
