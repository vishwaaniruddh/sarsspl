<?php
session_start();
include('config.php');
?>
<html>
<head>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <body>
<?php
$ReciptNO = $_POST['ReciptNO'];
$Name = $_POST['name'];
$CompanyName = $_POST['CompanyName'];
$Youremember = $_POST['Youremember'];
$RupeesWord = $_POST['RupeesWord'];
$Fund = $_POST['Fund'];
$Room = $_POST['Room'];
$cow = $_POST['cow'];
$Tree = $_POST['Tree'];
$PayMode = $_POST['PayMode'];
$CardNo = $_POST['CardNo'];
$Amount = $_POST['Amount'];
$Mobile = $_POST['Mobile'];


$result = mysqli_query($conn,"INSERT INTO `Recipt`(`ReciptNumber`, `Name`,`CompanyName`, `Youremember`,`RupeesWord`, `Fund`, `Room`,`cow`, `Tree`, `PayMode`, `CardNo`,`Amount`, `Mobile`,entryDate) VALUES ('".$ReciptNO."','".$Name."','".$CompanyName."','".$Youremember."','".$RupeesWord."','".$Fund."','".$Room."','".$cow."','".$Tree."','".$PayMode."','".$CardNo."','".$Amount."','".$Mobile."','".date('Y-m-d H:i:s')."')");

if($result)
   {
       
       include('avopdf/report.php');
       
       
       
?>

<script>
    swal("Successfully Submited! ");
   window.open("Recipt.php","_self");
   
</script>

 <?php   
}else{?>
   <script>
   swal("Enter correct userid and password to login");
    window.open("Recipt.php","_self");
</script> 
<?php }

?>
</body>
</html>