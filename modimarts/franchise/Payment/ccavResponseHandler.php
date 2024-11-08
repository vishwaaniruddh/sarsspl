<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php session_start();


include 'ccCrypto.php';
include('../config.php');

// ini_set('display_errors', 1);

// ini_set('display_startup_errors', 1);

// error_reporting(E_ALL);

$workingKey = '2767DEF9D0F926DEC2DC4403D962F59D'; //Working Key should be provided here.

$encResponse = $_POST["encResp"]; //This is the response sent by the CCAvenue Server

$rcvdString = decrypt($encResponse, $workingKey); //Crypto Decryption used as per the specified working key.

$order_status = "";

$decryptValues = explode('&', $rcvdString);
$ord_response=json_encode($decryptValues);

$dataSize = sizeof($decryptValues);

for ($i = 0; $i < $dataSize; $i++) {

    $information = explode('=', $decryptValues[$i]);

    if ($i == 3) {

        $order_status = $information[1];

    }

    if ($i == 26) {

        $userid = $information[1];

    }
    if ($i == 28) {

     $refid = $information[1];

    }

    if ($i == 10) {

        $amount = $information[1];

    }

    if ($i == 11) {

        $billing_name = $information[1];

    }

    if ($i == 12) {

        $billing_address = $information[1];

    }

    if ($i == 13) {

        $billing_city = $information[1];

    }

    if ($i == 14) {

        $billing_state = $information[1];

    }

    if ($i == 15) {

        $billing_zip = $information[1];

    }

    if ($i == 16) {

        $billing_country = $information[1];

    }

    if ($i == 17) {

        $billing_tel = $information[1];

    }

    if ($i == 18) {

        $billing_email = $information[1];

    }

    if ($i == 2) {

        $txnid = $information[1];

    }
    if ($i == 29) {

        $shoppingcharge = $information[1];

    }
    if ($i == 29) {

        $shoppingcharge = $information[1];

    }
    if ($i == 39) {

        $Notes = $information[1];

    }
}

$datetime     = date('Y-m-d h:i:s');

$ordercount=mysqli_query($con3,"SELECT * FROM `Paynow_Franchise` WHERE txn='".$txnid."' ");
$count=mysqli_num_rows($ordercount);
if ($count==0) {
      $sql=mysqli_query($con3,"INSERT INTO `Paynow_Franchise`(`txn`, `member_id`, `amount`, `created_date`, `responce`, `status`) VALUES ('".$txnid."','".$userid."','".$amount."','".$datetime."','".$ord_response."','".$order_status."')");
}

?>
<input type="hidden" id="userid" value="<?=$userid?>">
<?php

if ($order_status === "Success") {

   echo "Payment Successfully";
?>
<script>

var userid =document.getElementById('userid').value;
    Swal.fire(
  'Success',
  'Payment Successfully!',
  'success'
).then(function() {
    window.location = "https://allmart.world/franchise/admin/ShowMember.php?id="+userid;
});

</script>
<?php

 

} else if ($order_status === "Aborted") {
    echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
      ?>
<script>
    var userid =document.getElementById('userid').value;
    Swal.fire(
  'Failed',
  'Payment Not Completed!',
  'error'
).then(function() {
    window.location = "https://allmart.world/franchise/admin/ShowMember.php?id="+userid;
});
</script>
<?php
} else if ($order_status === "Failure") {
    echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
      ?>
<script>
    var userid =document.getElementById('userid').value;
    Swal.fire(
  'Failed',
  'Payment Not Completed!',
  'error'
).then(function() {
    window.location = "https://allmart.world/franchise/admin/ShowMember.php?id="+userid;
});
</script>
<?php
} else {
    echo "<br>Security Error. Illegal access detected";
    ?>
<script>
    var userid =document.getElementById('userid').value;
    Swal.fire(
  'Failed',
  'Payment Not Completed!',
  'error'
).then(function() {
    window.location = "https://allmart.world/franchise/admin/ShowMember.php?id="+userid;
});
</script>
<?php
}

?>



<script>
    $(document).ready(function () {
        
        var userid =document.getElementById('userid').value;
    // Handler for .ready() called.
    window.setTimeout(function () {
        location.href = "https://allmart.world/franchise/admin/ShowMember.php?id="+userid;
    }, 3000);
});
</script>

 

