<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?
include('../config.php');

$id = $_GET['id'];
$getdata="SELECT * FROM `new_member` WHERE id='".$id."'";
$data = mysqli_query($con,$getdata);
$userdata = mysqli_fetch_assoc($data);
$country=$userdata['country'];
$zone=$userdata['zone'];
$state=$userdata['state'];
$division=$userdata['division'];
$district=$userdata['district'];
$taluka=$userdata['taluka'];
$village=$userdata['village'];
$location=$userdata['location'];
$pincode=$userdata['pincode'];

$dataselect="SELECT * FROM `new_member` WHERE pincode='$pincode' AND village='$village' AND  taluka='$taluka' AND  district='$district' AND  division='$division' AND   state='$state' AND   zone='$zone' AND   country='$country' AND status='1'";
$selectuser1=mysqli_query($con,$dataselect);
$selectuser=mysqli_fetch_assoc($selectuser1);
$numcount=mysqli_num_rows($selectuser1);
// var_dump($selectuser);
if($numcount)
{
    echo "<script>alert('Member ".$selectuser['name']." Has already at that position, Please, remove first')</script>"; 
    echo "<script> var previd= ".$selectuser['id']."</script>";
    echo "<script> var newid= ".$userdata['id']."</script>";
    ?>
    <script>
    // alert("Already "++"  Have Placed in this place Remove This first !");
    var result = confirm("Are You Remove now?");
if (result) {
    //Logic to delete the item
    window.location.href = 'member_disapprove.php?id='+previd+'&setid='+newid;

}
else
{
    window.history.back();  
}
//   window.history.back();
    </script>
    <?php

}
else{

$sql = "update new_member set status=1 where id='".$id."'";


if(mysqli_query($con,$sql)){ ?>


     <script>
     alert("Approved Succesfully !");
   window.history.back();
     </script>
    
     <?php
} else { ?>

   <script> 
      alert("Approved Error !"); 
        window.history.back(); 
    </script>
    
    
 <?php 
} 
}?>