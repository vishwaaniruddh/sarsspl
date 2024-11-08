<?php session_start();
include 'config.php';?>
<html>
    <head>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
 
<body>
<?php
$Sales=$_POST['Sales'];
$check=$_POST['che'];
date_default_timezone_set('Asia/Kolkata');
$dates = date('Y-m-d H:i:s');


$count=count($_SESSION["delvalue"]);

for ($i=0;$i< $count;$i++){
    
    $sql="insert into Lead_Renewal_Delegation(LeadId,SalesmanId,DelegatedTIme) values('".$_SESSION["delvalue"][$i]."','".$Sales."','".$dates."')";
    $runsql=mysqli_query($conn,$sql);
    
//   ( comment by anand)
   // $sql2="update Leads_table set Status='1',Assigned='".$dates."' where Lead_id='".$_SESSION["delvalue"][$i]."'";
   // $runsql2=mysqli_query($conn,$sql2);
}

?>
  <script>
<?php
if($runsql){
?>
swal({
  title: "Delegated Successfull!",
  text: "done!",
  icon: "success",
  button: "OK",
});

window.open("Renewals.php","_self");
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
window.open("Renewals.php","_self");
<?php
}
?>

</script> 
