<?php 
session_start();
include '../../config.php';


$name           = $_POST['name'];
$price          = $_POST['price'];
$description    = $_POST['description'];
$validity       = $_POST['validity'];

$insert_member= "insert into `Subscription`(`name`, `price`, `description`, `validity`) values ('".$name."','".$price."','".$description."','".$validity."')";

if (mysqli_query($con, $insert_member)) {
  echo "New record created successfully";
 } else {
  echo "Error: <br>" . mysqli_error($con);
}

?>

<script>
    window.location="https://allmart.world/franchise/promotions_cms/subscription/display.php";
</script>