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
$fn=$_POST['fn'];
$name=$_POST['name'];
$password=$_POST['password'];
$drop=$_POST['drop'];

if(isset($_POST['sub'])){

$sql="insert into login(name,email,password,permission,designation)
values('$fn','$name','$password','$drop',0)";
$result=mysqli_query($conn,$sql);
//echo $sql;

if($result){
?>

<script>

swal({
  title: "register Successfull!",
  text: "done!",
  icon: "success",
  button: "OK",
});
window.open("addusers.php","_self");


</script> 
<?php }?>


</body>
</html>

<?php
}}else
{ 
 header("location: index.php");
}
?>

