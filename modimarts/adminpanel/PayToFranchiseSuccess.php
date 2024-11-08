<?php 
include('config.php');
 ?>
<script src="/adminpanel/Sweetalert/sweetalert2@11.js"></script>
<script src="/adminpanel/Sweetalert/jquery.min.js" ></script>
<?php 

// var_dump($_POST);
$memdata=$_POST['mem_id'];
$numcount=count($memdata);
if ($numcount) {
  
for ($i=0; $i <count($memdata) ; $i++) { 
    $md=  explode('/', $memdata[$i]);
  $memid=$md[0];
  $amount=$md[1];
  $batch_no=$md[2];
  
$getcount=mysqli_query($con1,"SELECT * FROM `commission_Payment` WHERE batch_no='".$batch_no."' AND commission_to='".$memid."'");

$count=mysqli_num_rows($getcount);

if($count){
    $dataget=mysqli_fetch_assoc($getcount);
    $txnid = $dataget['txn_id'];
  
 
  $getcomm=mysqli_query($con1,"UPDATE `commission_details` SET `com_givien`='2' WHERE commission_to ='".$memid."' AND batch_no='".$batch_no."' AND com_givien='1'");

  $paysucc=mysqli_query($con1,"UPDATE `commission_Payment` SET status='1' WHERE batch_no='".$batch_no."' AND commission_to ='".$memid."' ");
  $inlag=mysqli_query($con1,"INSERT INTO `commission_transaction`(`order_id`, `payment_id`, `amount`, `txn_type`, `commission_to`, `txn_date`) VALUES ('','".$txnid."','".$amount."','2','".$memid."','".$txn_date."')");

}

 
}
echo "Success";

?>

 <script>
    Swal.fire(
  'Success',
  'Commission Pay Successfully!',
  'success'
).then(function() {
    window.location = "/adminpanel/CommissionDetails.php";
});
</script>
<?php
}
else
{
    echo "Error";
?>

 <script>
    Swal.fire(
  'Error',
  'Not Details Selected',
  'error'
).then(function() {
    window.location = "/adminpanel/CommissionDetails.php";
});
</script>
<?php } ?>

 


