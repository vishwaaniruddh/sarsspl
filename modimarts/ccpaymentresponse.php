<?php session_start();

include 'head.php';

include 'ccCrypto.php';

// ini_set('display_errors', 1);

// ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

$workingKey = '2767DEF9D0F926DEC2DC4403D962F59D'; //Working Key should be provided here.

$encResponse = $_POST["encResp"]; //This is the response sent by the CCAvenue Server

$rcvdString = decrypt($encResponse, $workingKey); //Crypto Decryption used as per the specified working key.

$order_status = "";

$decryptValues = explode('&', $rcvdString);

$dataSize = sizeof($decryptValues);

for ($i = 0; $i < $dataSize; $i++) {

    $information = explode('=', $decryptValues[$i]);

    if ($i == 3) {

        $order_status = $information[1];

    }

    if ($i == 26) {

        $userid = $information[1];

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

        $paymentmadefor = $information[1];

    }
}

$sql = mysqli_query($con1, "select * from Registration where id='" . $userid . "'");

if ($sql_result = mysqli_fetch_assoc($sql)) {

    $_SESSION['gid'] = $sql_result['id'];

    $_SESSION['fname'] = $sql_result['Firstname'];

    $_SESSION['lname'] = $sql_result['Lastname'];

    $_SESSION['mobile'] = $sql_result['Mobile'];

    $_SESSION['email'] = $sql_result['email'];

    $sql_address = mysqli_query($con1, "select * from address where userid='" . $_SESSION['gid'] . "' and status=1 and is_primary=1");

    $sql_address_result = mysqli_fetch_assoc($sql_address);

    $address = $sql_address_result['address'];

    $pincode = $sql_address_result['pincode'];

    $city = $sql_address_result['city'];

    $state = $sql_address_result['state'];

    $landmark = $sql_address_result['landmark'];

    $_SESSION['primary_address'] = $address . ', ' . $landmark . ', ' . $city . ', ' . $pincode . ', ' . $state;

    $_SESSION['primary_city'] = $city;

    $_SESSION['primary_state'] = $state;

    $_SESSION['primary_zip'] = $pincode;

    $txnidfo = $txnid;

}




$email = $_SESSION['email'];
$email = ($email == '') ? $billing_email : $email;
// $email='prabir.d06@gmail.com';

$firstname        = $_SESSION['fname'];
$shoppingcharge = "0";

$date         = date('Y-m-d H:i:s');
$datetime     = date('Y-m-d h:i:s');

$ord_response = json_encode($decryptValues);

if ($order_status === "Success") {
// if (0) {

    $select_sql        = mysqli_query($con1, "select * from Order_ent where transaction_id='" . $txnid . "'");
    $select_sql_result = mysqli_fetch_assoc($select_sql);
    if (!mysqli_num_rows($select_sql)) {
        //to prevent duplicate entries
       
        $insert    = "insert into Order_ent(user_id,date,amount,status,pmode,pdfpath,cmplt_status,transaction_stats,transaction_id,cartids_inorder,shipping_charges,ord_response) values('" . $userid . "','" . $date . "','" . $amount . "','0','online','','','" . $order_status . "','" . $txnid . "','','" . $shoppingcharge . "','" . $ord_response . "')";
        mysqli_query($con1, $insert);
        $order         = mysqli_insert_id($con1);
        $new_statement = "insert into new_order(oid, name,email,phone,address,city,state,country,zip,status,created_at) values('" . $order . "','" . $billing_name . "','" . $billing_email . "','" . $billing_tel . "','" . $billing_address . "','" . $billing_city . "','" . $billing_state . "','" . $billing_country . "','" . $billing_zip . "','1','" . $datetime . "')";
        $new_order     = mysqli_query($con1, $new_statement);

        $check = mysqli_num_rows(mysqli_query($con1, "SELECT * FROM `address` WHERE `userid`='" . $userid . "'"));
        if ($check == 0) {
            mysqli_query($con1, "INSERT INTO `address`(`userid`, `fname`, `mobile`, `email`, `address`, `pincode`, `state`, `city`, `status`, `is_primary`) VALUES('" . $userid . "','" . $billing_name . "','" . $billing_tel . "','" . $billing_email . "','" . $billing_address . "','" . $billing_zip . "','" . $billing_state . "','" . $billing_city . "','1','1')");

        } else {
            $addupdate = mysqli_query($con1, "UPDATE `address` SET  `pincode`='" . $billing_zip . "',`state`='" . $billing_state . "',`city`='" . $billing_city . "' WHERE `userid`='" . $userid . "'");

        }
    }

      

  

}

?>

 <div class="product-model">
     <div class="container">
         <div class="row ">
          <div class="col-md-12 pay-info">
      <?php if ($order_status === "Success") { ?>
        <p><strong>Transaction  Id - <?=$txnid?> <?php if ($paymentmadefor!='') {
            echo $paymentmadefor; } ?> </strong> </p>

    <img src="https://allmart.world/assets/Success.gif" alt="Success" style="width:50%;">
    <br/>
    <a href="index.php" class="btn btn-default">Go To Home Page</a>
            <?

    $_SESSION['pay_status'] = true;

} else {
    ?>
    <img src="https://allmart.world/assets/failed.gif" alt="failed"  style="width:50%;">
    <br/>
    <a href="index.php" class="btn btn-default">Go To Home Page</a>
    <?php
}
?>

            <div >
             </div>
          </div>
        </div>
</div>
<!---->

<style>
    .txn_id{
        color:green;
    }
    .pay-info{
        text-align:center;
            padding: 10%;
    background: #fcfcfc;
    }
    .shoping{
        display:none;
    }
    @media (min-width: 768px){
        .content-area, .widget-area {
            margin-bottom: 2.617924em;
        }
        .content-area {
    width: 100%;
    float: left;
    margin-right: 4.347826087%;
}
.woocommerce-cart .hentry, .woocommerce-checkout .hentry {
    border-bottom: 0;
    padding-bottom: 0;
}
    }
.hentry {
    margin: 0 0 4.235801032em;
}

ul.order_details {
    list-style: none;
    position: relative;
    margin: 3.706325903em 0;
}

.order_details {
    background-color: #000000;
}

ul.order_details li:first-child {
    padding-top: 1.618em;
}

ul.order_details li {
    padding: 1em 1.618em;
    font-size: 0.8em;
    text-transform: uppercase;
}

ul.order_details li strong {
    display: block;
    font-size: 1.41575em;
    text-transform: none;
}

b, strong {

    font-weight: 600;

}
.site-main {

    margin-bottom: 2.617924em;

}

.order_details {

    background-color: white;

}

table {

    border-spacing: 0;

    width: 100%;

    border-collapse: separate;

}

table {

    margin: 0 0 1.41575em;

    width: 100%;

}

table {

    border-collapse: collapse;

    border-spacing: 0;

}

table thead th {

    padding: 1.41575em;

    vertical-align: middle;

}

table:not( .has-background ) tbody td {

    background-color: #000000;

}

table th, table tbody td, #payment .payment_methods li, #comments .comment-list .comment-content .comment-text, #payment .payment_methods > li .payment_box, #payment .place-order {

    background: #f8f8f8!important;

}
table td, table th {

    padding: 1em 1.41575em;

    text-align: left;

    vertical-align: top;

    width:50%;

}

table td img{

    width:20%;

}

.hentry .entry-content a:not(.button) {

    text-decoration: underline;

}

a {

    color: #227504;

}

b, strong {

    font-weight: 600;

}

</style>

</div>

<?include 'footer.php';?>

