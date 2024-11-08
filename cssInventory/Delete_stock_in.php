<?php

session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
include 'config.php';?>
<html>
    <head>
        
        
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
        
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
        

<body>
<?php
$del=$_REQUEST['srno'];

$sql="delete from enventory_Stock where srno='".$del."'";
$rst=mysqli_query($conn,$sql);

//echo $sql;

if($rst){
?>

<script>

swal({
  title: "deleted Successfull!",
  text: "done!",
  icon: "success",
  button: "OK",
});
window.open("viewstock.php","_self");


</script> 
<?php }?>


</body>
</html>

<?php
}else
{ 
 header("location: index.php");
}

?>

