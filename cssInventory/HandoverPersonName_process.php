<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
?>
<html>
    <head>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
 
<body>


<?php
include 'config.php';
$Handover=$_POST['Handover'];

$City=$_POST['City'];
$sql="insert into handover_person(Handover,City)values('".$Handover."','".$City."')";
$result=mysqli_query($conn,$sql);
//echo $sql;
$last=mysqli_insert_id($conn);
//echo $last;
?>

<script>
<?php
if($last!=""){
?>
swal({
  title: "Added Successfull!",
  text: "done!",
  icon: "success",
  button: "OK",
});

window.open("HandoverPersonName.php","_self");
<?php
}
else
{?>


  swal({
  title: "Invalid!",
  text: "oops!",
  icon: "error",
  button: "not done",
});  
window.open("HandoverPersonName.php","_self");
<?php
}
?>

</script> 

</body>
</html>
<?php
}else
{ 
 header("location: login.php");
}
?>
