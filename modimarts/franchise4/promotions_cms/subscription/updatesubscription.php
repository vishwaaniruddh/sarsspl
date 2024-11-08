<?php 
session_start();
include '../../config.php';


$id             = $_POST['userid'];
$price          = $_POST['price'];
$name           = $_POST['name'];
$description    = $_POST['description'];
$validity       = $_POST['validity'];
// var_dump($customer_id);die;



  $update_member = "update `Subscription` set `name`='".$name."',`price`='".$price."',`description`='".$description."',`validity`='".$validity."' where `id` ='".$id."'";
  
 

if (mysqli_query($con, $update_member)) {
  echo "REcord updated successfully";
} else {
  echo "Error: <br>" . mysqli_error($con);
}

?>
<script>
    window.location="https://allmart.world/franchise/promotions_cms/subscription/display.php";
</script>