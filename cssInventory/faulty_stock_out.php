<?php
include 'config.php';
?>
<html>
    <head>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
        
     
<body>

<?php
$id=$_REQUEST['id'];

date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d H:i:s');



$sql="update InventoryOUT_Stock set Status='faulty' where id='".$id."'";
$result=mysqli_query($conn,$sql);

?>
<script>
<?php
if($result){
    ?>
swal({
  title: "Update Successfull!",
  text: "done!",
  icon: "success",
  button: "OK",
});
window.open("inventory.php","_self");
<?php

}

?>
//

</script> 

</body>
</html>