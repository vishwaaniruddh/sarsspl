<?php include('../config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = $_POST['id'];
$created_at = $_POST['created_at'];
$Promotionsname = mysqli_real_escape_string($con,$_POST['Promotionsname']);
$promotion_type = mysqli_real_escape_string($con,$_POST['promotion_type']);
$promotion_status =mysqli_real_escape_string($con,$_POST['promotion_status']);
$subtype =mysqli_real_escape_string($con,$_POST['subtype']);
$next_date =mysqli_real_escape_string($con,$_POST['next_date']);
$date = date("Y-m-d");
$created_at=date('Y-m-d',strtotime($created_at));;

       

$update = "UPDATE `promotions` SET `promotions`='".$Promotionsname."',`status`='".$promotion_status."',`type`='".$promotion_type."',`subtype`='".$subtype."',`created_at`='".$created_at."',`next_date`='".$next_date."' WHERE id='".$id."'";


if(mysqli_query($con,$update)){ ?>
   
   <script>
       alert('Promotion Updated Successfully !');
       window.history.back();
   </script> 
<? }
else{ ?>
   <script>
       alert('Promotion Updated Error !');
       window.history.back();
   </script>
     
<? }


 
?>
