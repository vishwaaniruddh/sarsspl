<?php 
include('config.php');
 ?>
<script src="/adminpanel/Sweetalert/sweetalert2@11.js"></script>
<script src="/adminpanel/Sweetalert/jquery.min.js" ></script>
<?php 
$memdata=$_POST['mem_id'];
var_dump($memdata);
$txnid=$_POST['txnid'];
if(count($memdata)>0){
$getcount=mysqli_query($con1,"SELECT * FROM `commission_Payment` WHERE txn_id='".$txnid."'");
$count=mysqli_num_rows($getcount);
 $txn_date=date('Y-m-d H:i:s');

if($count==0){



$batchno="COMM-".date('Y-m-d')."-".time();

for ($i=0; $i <count($memdata) ; $i++) { 
  $md=  explode('/', $memdata[$i]);
  $memid=$md[0];
  $amount=$md[1];
  $myscl=mysqli_query($con1,"INSERT INTO `commission_Payment`(`commission_to`, `txn_id`, `amount`, `batch_no`) VALUES ('".$memid."','".$txnid."','".$amount."','".$batchno."')");
  $getcomm=mysqli_query($con1,"UPDATE `commission_details` SET `com_givien`='1',`batch_no`='".$batchno."' WHERE commission_to ='".$memid."' AND com_givien='0'");

   $inlag=mysqli_query($con1,"INSERT INTO `commission_transaction`(`order_id`, `payment_id`, `amount`, `txn_type`, `commission_to`, `txn_date`) VALUES ('','".$txnid."','".$amount."','1','".$memid."','".$txn_date."')");
 
}
echo "Success";
?>

 <script>
    Swal.fire(
  'Success',
  'Commission Distribute Successfully!',
  'success'
).then(function() {
    window.location = "/adminpanel/CommissionDetails.php";
});
</script>
<?php

}
}
else
{
    echo "Error";
    ?>
     <script>
    Swal.fire(
  'Warning',
  'Records Already Present!',
  'error'
).then(function() {
    window.location = "/adminpanel/CommissionDetails.php";
});
</script>
    <?php
}
 


