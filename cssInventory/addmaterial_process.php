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
$name=$_POST['name'];
//$Add=$_POST['Address'];
$vendorname=$_POST['vendorname'];


$model=$_POST['modelno'];

$pono = $_REQUEST['pono'];
$project = $_REQUEST['project'];




$count= count($model);
//echo $count;

date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d H:i:s');
$sql="insert into material(Vendorname_id,Name,entrydate)values('".$vendorname."','".$name."','".$date."')";
$result=mysqli_query($conn,$sql);
//echo $sql;
$last=mysqli_insert_id($conn);
///echo $last;

if($last){
    for($i=0;$i<$count;$i++)
                        {
$sql2="insert into model_no(material_id,modelno,entrydate,pono,project)values('".$last."','".$model[$i]."','".$date."','".$pono[$i]."','".$project[$i]."')";
$result2=mysqli_query($conn,$sql2);    
}
}
?>

<script>
<?php
if($result2){
?>
swal({
  title: "Added Successfull!",
  text: "done!",
  icon: "success",
  button: "OK",
});

window.open("addmaterial.php","_self");
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
window.open("addmaterial.php","_self");
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