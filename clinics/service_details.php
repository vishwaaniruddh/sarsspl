<?php
include 'config.php';

$service_name = $_POST['servname'];
$amount = $_POST['servamt'];

$created_at = date("Y-m-d H:i:s");

$sql = mysqli_query($con,"insert into service_master(serv_name,serv_amt,created_at) values ('".$service_name."','".$amount."','".$created_at."')");
if($sql)
{ echo "<script>
    alert('Data Inserted!!!');
    window.location.href = 'service_master.php';
</script>"; }
else { 
    echo "<script>
    alert('Something Wrong!!!');
    window.location.href = 'service_master.php';
</script>";
 }

?>