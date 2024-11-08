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
$name=$_POST['Name'];
$Add=$_POST['Address'];
$ddl_city=$_POST['ddl_city'];
$ddl_state=$_POST['ddl_state'];
$contact=$_POST['MobileNumber'];
$Location=$_POST['Location'];

$ddl_team=$_POST['ddl_team'];

date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d H:i:s');
$sql="insert into team(Name,Address,Location,state,city,contact,team,date)values('".$name."','".$Add."','".$Location."','".$ddl_state."','".$ddl_city."','".$contact."','".$ddl_team."','".$date."')";
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

window.open("addteam.php","_self");
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
window.open("addteam.php","_self");
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
