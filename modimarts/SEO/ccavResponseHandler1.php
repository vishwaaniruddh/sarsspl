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

        $shoppingcharge = $information[1];

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

function delete_from_cart($userid)
{

    global $con1;

    $delete = "delete from cart where user_id='" . $userid . "'";

    // $delete = "update cart set status=1 where user_id='".$userid."'";

    mysqli_query($con1, $delete);

}

function getccode($cid, $pid)
{
    global $con1;

    $qrya = "select * from main_cat where id='" . $cid . "'";

    $resulta = mysqli_query($con1, $qrya);
    $rowa    = mysqli_fetch_row($resulta);

    $aa = $rowa[2];

    if ($cid == 80) {
        $maincatid = 5;

    } else {
        if ($aa != 0) {
            $qrya1    = "select * from main_cat where id='" . $aa . "'";
            $resulta1 = mysqli_query($con1, $qrya1);
            $rowa1    = mysqli_fetch_row($resulta1);
            $Maincate = $rowa1[4];
        }
        if ($Maincate == 1) {
            $qrylatf = "SELECT `ccode` FROM `fashion` WHERE code='" . $pid . "'";
        } else if ($Maincate == 190) {
            $qrylatf = "SELECT `ccode` FROM `electronics` WHERE code='" . $pid . "'";
        } else if ($Maincate == 218) {
            $qrylatf = "SELECT `ccode` FROM `grocery` WHERE code='" . $pid . "'";
        } else if ($Maincate == 760) {
            $qrylatf = "SELECT `ccode` FROM `kits` WHERE code='" . $pid . "'";
        } else if ($Maincate == 767) {
            $qrylatf = "SELECT  `ccode` FROM `promotion_product` WHERE code='" . $pid . "'";
        } else {
            $qrylatf = "SELECT  `ccode` FROM `products` WHERE code='" . $pid . "'";
        }
    }
    $qrylatfrws = mysqli_query($con1, $qrylatf);

    $latstprnrws = mysqli_fetch_array($qrylatfrws);
    return $latstprnrws['ccode'];
}

function getfranchise($client_id)
{
    global $con;
    global $con1;

    $sql     = mysqli_query($con1, "SELECT * FROM `clients` WHERE code ='" . $client_id . "'");
    $row     = mysqli_fetch_assoc($sql);
    $country = "india";
    $zone    = $row['city'];
    $state   = $row['state'];
    $pincode = $row['pincode'];

    $getfra        = mysqli_query($con, "SELECT * FROM `new_member` WHERE pincode='" . $pincode . "' AND zone='" . $zone . "' AND state='" . $state . "' AND country='" . $country . "'");
    $getfranchdata = mysqli_fetch_assoc($getfra);

    return $getfranchdata['id'];

}

function commission($txn_id, $commision, $mem, $date, $promotion)
{

    global $con;
    global $con1;

    $distribut_amount = $commision;

    $member_sql        = mysqli_query($con, "select * from new_member where id='" . $mem . "' and status=1");
    $member_sql_result = mysqli_fetch_assoc($member_sql);

    $pos_name     = $member_sql_result['star'];
    $member_level = $member_sql_result['level_id'];

    $village  = $member_sql_result['village'];
    $pincode  = $member_sql_result['pincode'];
    $taluka   = $member_sql_result['taluka'];
    $district = $member_sql_result['district'];
    $division = $member_sql_result['division'];
    $state    = $member_sql_result['state'];
    $zone     = $member_sql_result['zone'];
    $country  = $member_sql_result['country'];

    if ($village > 0) {
        $vil_sql        = mysqli_query($con, "select * from new_member where village='" . $village . "' and status=1");
        $vil_sql_result = mysqli_fetch_assoc($vil_sql);
        $vil_mem        = $vil_sql_result['id'];

        if ($vil_mem) {
            $vil_amount    = round($distribut_amount / 2, 5);
            $actual_amount = $vil_amount;

            // echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','village".$vil_mem."','".$vil_amount."','1','".$promotion."','".$date."')";
            // echo '<br>';
            mysqli_query($con1, "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('" . $txn_id . "','" . $vil_mem . "','" . $vil_amount . "','1','" . $promotion . "','" . $date . "')");
        } else {
            $actual_amount = $distribut_amount;
        }

    } else {
        $vil_amount    = $distribut_amount;
        $actual_amount = $distribut_amount;
        $vil_mem       = 0;
    }

    if ($pincode > 0) {

        $pin_sql        = mysqli_query($con, "select * from new_member where pincode='" . $pincode . "' and village=0 and status=1");
        $pin_sql_result = mysqli_fetch_assoc($pin_sql);
        $pin_mem        = $pin_sql_result['id'];

        if ($pin_mem) {

            $pin_amount    = round($vil_amount / 2, 5);
            $actual_amount = $pin_amount;
            // echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','pincode".$pin_mem."','".$pin_amount."','1','".$promotion."','".$date."')";
            // echo '<br>';
            mysqli_query($con1, "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('" . $txn_id . "','" . $pin_mem . "','" . $pin_amount . "','1','" . $promotion . "','" . $date . "')");
        } else {
            $pin_amount = $actual_amount;
        }

    } else {
        $pin_amount = $distribut_amount;
        // $pin_amount =  round($actual_amount /2 ,5) ;
        $actual_amount = $distribut_amount;
        $pin_mem       = 0;
    }

    // return;
    if ($taluka > 0) {
        $tal_sql        = mysqli_query($con, "select * from new_member where taluka='" . $taluka . "' and pincode=0 and status=1");
        $tal_sql_result = mysqli_fetch_assoc($tal_sql);
        $tal_mem        = $tal_sql_result['id'];

        if ($tal_mem) {
            $tal_amount    = round($pin_amount / 2, 5);
            $actual_amount = $tal_amount;

            // echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','taluka".$tal_mem."','".$tal_amount."','1','".$promotion."','".$date."')";
            // echo '<br>';
            mysqli_query($con1, "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('" . $txn_id . "','" . $tal_mem . "','" . $tal_amount . "','1','" . $promotion . "','" . $date . "')");
        } else {
            $tal_amount = $actual_amount;
        }

    } else {
        $tal_amount    = $distribut_amount;
        $actual_amount = $distribut_amount;
        $tal_mem       = 0;
    }

    if ($district > 0) {
        $dis_sql        = mysqli_query($con, "select * from new_member where district='" . $district . "' and taluka=0 and status=1");
        $dis_sql_result = mysqli_fetch_assoc($dis_sql);
        $dis_mem        = $dis_sql_result['id'];

        if ($dis_mem) {
            $dis_amount    = round($tal_amount / 2, 5);
            $actual_amount = $dis_amount;
            // echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$dis_mem."','".$dis_amount."','1','".$promotion."','".$date."')";
            // echo '<br>';
            mysqli_query($con1, "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('" . $txn_id . "','" . $dis_mem . "','" . $dis_amount . "','1','" . $promotion . "','" . $date . "')");

        } else {
            $dis_amount = $actual_amount;
        }

    } else {
        $dis_amount    = $distribut_amount;
        $actual_amount = $distribut_amount;
        $dis_mem       = 0;
    }

    if ($division > 0) {
        $div_sql        = mysqli_query($con, "select * from new_member where division='" . $division . "' and district=0 and status=1");
        $div_sql_result = mysqli_fetch_assoc($div_sql);
        $div_mem        = $div_sql_result['id'];

        if ($div_mem) {
            $div_amount    = round($dis_amount / 2, 5);
            $actual_amount = $div_amount;

            // echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$div_mem."','".$div_amount."','1','".$promotion."','".$date."')";
            // echo '<br>';

            mysqli_query($con1, "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('" . $txn_id . "','" . $div_mem . "','" . $div_amount . "','1','" . $promotion . "','" . $date . "')");

        } else {
            $div_amount = $actual_amount;
        }

    } else {
        $div_amount    = $distribut_amount;
        $actual_amount = $distribut_amount;
        $div_mem       = 0;
    }

    if ($state > 0) {

        // echo '$div_amount'.$div_amount;

        $state_sql        = mysqli_query($con, "select * from new_member where state='" . $state . "' and division=0 and status=1");
        $state_sql_result = mysqli_fetch_assoc($state_sql);
        $state_mem        = $state_sql_result['id'];

        if ($state_mem) {
            $state_amount  = round($div_amount / 2, 5);
            $actual_amount = $state_amount;

            // echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$state_mem."','".$state_amount."','1','".$promotion."','".$date."')";
            // echo '<br>';
            mysqli_query($con1, "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('" . $txn_id . "','" . $state_mem . "','" . $state_amount . "','1','" . $promotion . "','" . $date . "')");
        } else {
            $state_amount = $actual_amount;
        }

    } else {
        $state_amount  = $distribut_amount;
        $actual_amount = $distribut_amount;
        $state_mem     = 0;
    }

    if ($zone > 0) {
        $zone_sql        = mysqli_query($con, "select * from new_member where zone='" . $zone . "' and state=0 and status=1");
        $zone_sql_result = mysqli_fetch_assoc($zone_sql);
        $zone_mem        = $zone_sql_result['id'];

        if ($zone_mem) {
            $zone_amount   = round($state_amount / 2, 5);
            $actual_amount = $zone_amount;
            // echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$zone_mem."','".$zone_amount."','1','".$promotion."','".$date."')";
            // echo '<br>';
            mysqli_query($con1, "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('" . $txn_id . "','" . $zone_mem . "','" . $zone_amount . "','1','" . $promotion . "','" . $date . "')");
        } else {
            $zone_amount = $actual_amount;
        }

    } else {
        $zone_amount   = $distribut_amount;
        $actual_amount = $distribut_amount;
        $zone_mem      = 0;
    }

    if ($country > 0) {
        $country_sql        = mysqli_query($con, "select * from new_member where country='" . $country . "' and zone=0 and status=1");
        $country_sql_result = mysqli_fetch_assoc($country_sql);
        $country_mem        = $country_sql_result['id'];

        if ($country_mem) {
            $country_amount = round($zone_amount / 2, 5);
            $sar_amount     = round($zone_amount / 2, 5);
            // echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$country_mem."','".$country_amount."','1','".$promotion."','".$date."')";
            // echo '<br>';
            mysqli_query($con1, "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('" . $txn_id . "','" . $country_mem . "','" . $country_amount . "','1','" . $promotion . "','" . $date . "')");
        } else {
            $country_amount = $actual_amount;
            $sar_amount     = $actual_amount;
        }

    }
}

function get_cart_info($cartid, $parameter)
{

    global $con1;

    $sql = mysqli_query($con1, "select $parameter from cart where id='" . $cartid . "'");

    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result[$parameter];

}

function get_shipping_charges($userid)
{
    global $con1;

    $shipping_charges = 0;

    /*if($total<=2000){

    $shipping_charges = 150;

    } else if($total >=2001 && $total <=5000){

    $shipping_charges = 200;

    } else if($total >=5001){

    $shipping_charges = 0;

    }*/

    $sql_sum = mysqli_query($con1, "select sum(shipping_out_state) as shipping_out_state,sum(shipping_in_area) as shipping_in_area from cart where user_id='" . $userid . "'");

    $sql_result_sum = mysqli_fetch_assoc($sql_sum);

    $total_state = $sql_result_sum['shipping_out_state'];

    $total_area = $sql_result_sum['shipping_in_area'];

    $shipping_charges = $total_state + $total_area;

    return $shipping_charges;

}

function get_cart_ids($userid)
{

    global $con1;

    $sql = mysqli_query($con1, "select * from cart where user_id='" . $userid . "' and status=0");

    while ($sql_result = mysqli_fetch_assoc($sql)) {

        $cart_id[] = $sql_result['id'];

    }

    return $cart_id;

}

function get_cart_quantity($cartid)
{
    global $con1;
    $sql = mysqli_query($con1, "select * from cart where id='" . $cartid . "' and status=0");
    while ($sql_result = mysqli_fetch_assoc($sql)) {
        $cart_quantity = $sql_result['qty'];
    }
    return $cart_quantity;
}
function get_product_amt_by_cart_id($cartid)
{
    global $con1;
    $sql        = mysqli_query($con1, "select * from cart where id='" . $cartid . "' and status=0");
    $sql_result = mysqli_fetch_assoc($sql);
    $cart_total = $sql_result['p_price'];
    return $cart_total;
}

function get_product_from_cart_by_cartid($cartid)
{
    global $con1;
    $sql        = mysqli_query($con1, "select pid from cart where id='" . $cartid . "' and status=0");
    $sql_result = mysqli_fetch_assoc($sql);
    $product_id = $sql_result['pid'];
    return $product_id;
}

$email = $_SESSION['email'];
$email = ($email == '') ? $billing_email : $email;
// $email='prabir.d06@gmail.com';

$firstname        = $_SESSION['fname'];
$shipping_charges = get_shipping_charges($userid);
if ($shipping_charges == 0) {$shoppingcharge = $shipping_charges + $shoppingcharge;}
$total_amount = $shipping_charges + $amount;
$date         = date('Y-m-d H:i:s');
$datetime     = date('Y-m-d h:i:s');

if ($order_status === "Success") {

    $select_sql        = mysqli_query($con1, "select * from Order_ent where transaction_id='" . $txnid . "'");
    $select_sql_result = mysqli_fetch_assoc($select_sql);
    if (!mysqli_num_rows($select_sql)) {
        //to prevent duplicate entries
        $crtids    = get_cart_ids($userid);
        $json_cart = json_encode($crtids);
        $json_cart = str_replace(array('[', ']', '"'), '', $json_cart);
        $arr       = explode(',', $json_cart);
        $json_cart = implode(",", $arr);
        $insert    = "insert into Order_ent(user_id,date,amount,status,pmode,pdfpath,cmplt_status,transaction_stats,transaction_id,cartids_inorder,shipping_charges) values('" . $userid . "','" . $date . "','" . $amount . "','0','online','','','" . $order_status . "','" . $txnid . "','" . $json_cart . "','" . $shoppingcharge . "')";
        mysqli_query($con1, $insert);
        $order         = mysqli_insert_id($con1);
        $new_statement = "insert into new_order(oid, name,email,phone,address,city,state,country,zip,status,created_at) values('" . $order . "','" . $billing_name . "','" . $billing_email . "','" . $billing_tel . "','" . $billing_address . "','" . $billing_city . "','" . $billing_state . "','" . $billing_country . "','" . $billing_zip . "','1','" . $datetime . "')";
        $new_order     = mysqli_query($con1, $new_statement);

        $check = mysqli_num_rows(mysqli_query($con1, "SELECT * FROM `address` WHERE `userid`='" . $userid . "'"));
        if ($check == 0) {
            mysqli_query($con1, "INSERT INTO `address`(`userid`, `fname`, `mobile`, `email`, `address`, `pincode`, `state`, `city`, `status`, `is_primary`) VALUES('" . $userid . "','" . $billing_name . "','" . $billing_tel . "','" . $billing_email . "','" . $billing_address . "','" . $billing_zip . "','" . $billing_state . "','" . $billing_city . "','1','1')");

        } else {
            $addupdate = mysqli_query($con1, "UPDATE `address` SET  `address`='" . $billing_address . "',`pincode`='" . $billing_zip . "',`state`='" . $billing_state . "',`city`='" . $billing_city . "' WHERE `userid`='" . $userid . "'");

        }

        foreach ($crtids as $key => $val) {
            $qty                  = get_cart_quantity($val);
            $product_amt          = get_product_amt_by_cart_id($val);
            $product_name         = get_cart_info($val, 'product_name');
            $pid                  = get_cart_info($val, 'pid');
            $cat_id               = get_cart_info($val, 'cat_id');
            $prodid               = get_cart_info($val, 'prodid');
            $item_id              = $pid . "/" . $cat_id . "/" . $prodid;
            $product_image        = get_cart_info($val, 'image');
            $insert_order_details = "insert into order_details(oid,item_id,rate,qty,discount,rejected_qty,status,total_amt,mrc_id,cat_id,track_id,track_Status,color,size,date,product_name,image) values ('" . $order . "','" . $item_id . "','" . $product_amt . "','" . $qty . "','','','1','" . $product_amt * $qty . "','','','','','','','" . $date . "','" . $product_name . "','" . $product_image . "')";
            mysqli_query($con1, $insert_order_details);

        }
        //  delete_from_cart
        delete_from_cart($userid);

        $order_sql      = mysqli_query($con1, "select * from new_order where oid='" . $order . "'");
        $ord_sql_result = mysqli_fetch_assoc($order_sql);
        $firstname      = $ord_sql_result['name'];

        // Mail Template

        $link = '<html lang="en"><head><meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<div id="m_3716871841364271743wrapper" dir="ltr" style="background-color:#f7f7f7;margin:0;padding:70px 0;width:100%">
    <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
        <tbody>
            <tr>
             <td align="center" valign="top">
                <div id="m_3716871841364271743template_header_image"></div>
                    <table border="0" cellpadding="0" cellspacing="0" width="600" id="m_3716871841364271743template_container" style="background-color:#ffffff;border:1px solid #dedede;border-radius:3px">
                        <tbody>
                            <tr>
                            <td align="center" valign="top">
                                <table border="0" cellpadding="0" cellspacing="0" width="600" id="m_3716871841364271743template_header" style="background-color:#96588a;color:#ffffff;border-bottom:0;font-weight:bold;line-height:100%;vertical-align:middle;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;border-radius:3px 3px 0 0">
                                    <tbody>
                                        <tr>
                                            <td id="m_3716871841364271743header_wrapper" style="padding:36px 48px;display:block">
                                                <h1 style="font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:30px;font-weight:300;line-height:150%;margin:0;text-align:left;color:#ffffff">
                                                Thank you for your order
                                                </h1>
                                                <h3>Your Order is successfully placed ! </h3>
                                                 <span> The transaction id for your reference is  ' . $txnid . ' </span>
                                                </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            </tr>
                            <tr>
                            <td align="center" valign="top">
                                    <table border="0" cellpadding="0" cellspacing="0" width="600" id="m_3716871841364271743template_body"><tbody><tr>
                                        <td valign="top" id="m_3716871841364271743body_content" style="background-color:#ffffff">
                                                <table border="0" cellpadding="20" cellspacing="0" width="100%"><tbody><tr>
                                                <td valign="top" style="padding:48px 48px 32px">
                                                    <div id="m_3716871841364271743body_content_inner" style="color:#636363;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:14px;line-height:150%;text-align:left">
                                                            <p style="margin:0 0 16px">Hi ' . $firstname . ',</p>
                                                            <p style="margin:0 0 16px">Thanks for your order. It’s on-hold until we confirm that payment has been received. In the meantime, here’s a reminder of what you ordered:</p><span class="im">
                                                            </span><h2 style="color:#96588a;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:18px;font-weight:bold;line-height:130%;margin:0 0 18px;text-align:left">
                                                                [Order #' . $order . '] (' . date('Y/m/d h:i:s') . ')</h2>
                                                            <div style="margin-bottom:40px">
                                                                <table cellspacing="0" cellpadding="6" border="1" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;width:100%;font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif">
                                                            <thead><tr>
                                                            <th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Product</th>
                                                                            <th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Quantity</th>
                                                                            <th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Price</th>
                                                                        </tr></thead>';

        $show_email_sql = mysqli_query($con1, "select * from order_details  where oid='" . $order . "' ");
        while ($show_order_sql_result1 = mysqli_fetch_assoc($show_email_sql)) {
            $pro_image1    = $show_order_sql_result1['image'];
            $pro_name1     = $show_order_sql_result1['product_name'];
            $pro_qty1      = $show_order_sql_result1['qty'];
            $single_price1 = $show_order_sql_result1['rate'];
            $total_amt1    = $single_price1 * $pro_qty1;
            $link .= '<tbody>
                <tr>
                    <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word">
                        <img src="' . $pro_image1 . '" width="30%"> ' . $pro_name1 . '      </td>
                    <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif">' . $pro_qty1 . ' </td>
                    <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif">
                    <span><span>&#8377;</span>' . $total_amt1 . '</span>        </td>
                </tr>
            </tbody>';

        }

        $link .= '<tfoot>
                <tr>
                    <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Shipping:</th>
                        <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">
                           <span><span>&#8377;</span>' . $shoppingcharge . '</span>
                        </td>
                </tr>
                <tr>
                    <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Total:</th>
                        <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left"><span><span>&#8377;</span>' . $total_amount . '</span></td>
                </tr>
            </tfoot>
        </table>
</div>
    <p style="margin:0 0 16px">We look forward to fulfilling your order soon.</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</td>
</tr>
<tr>
<td align="center" valign="top"><table border="0" cellpadding="10" cellspacing="0" width="600" id="m_3716871841364271743template_footer"><tbody><tr><td valign="top" style="padding:0;border-radius:6px"><table border="0" cellpadding="10" cellspacing="0" width="100%"><tbody><tr><td colspan="2" valign="middle" id="m_3716871841364271743credit" style="border-radius:6px;border:0;color:#8a8a8a;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:12px;line-height:150%;text-align:center;padding:24px 0">                </td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table><div class="yj6qo"></div><div class="adL">
</div></div></body></html>';
        $sql11        = mysqli_query($con1, "select * from Order_ent where transaction_id='" . $txnid . "'");
        $sql11_result = mysqli_fetch_assoc($sql11);
        $order_id     = $sql11_result['id'];

        // $headers .= "Reply-To: The Sender sales@allmart.world\r\n";
        // $headers .= "Return-Path: The Sender sales@allmart.world\r\n";
        // $headers .= "From: sales@allmart.world" ."\r\n" .
        // $headers .= "Organization: Sender Organization\r\n";
        // $headers .= "MIME-Version: 1.0\r\n";
        // $headers .= "Content-type: text/html; charset=utf-8\r\n";
        // $headers .= "X-Priority: 3\r\n";
        // $headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;

        //     if(mail($email, "Thanks You For Shopping At AllMart", $link, $headers,'-f sales@allmart.world -F "AllMart"')){

        //     // if(mail($email, "Message", $link, $headers)){

        //         mail('kvaljani@gmail.com', "Message", $link, $headers);

        //         mail('visshwaaniruddh@gmail.com', "Message", $link, $headers);

        //         // mail('satyendra1111@gmail.com', "Message", $link, $headers);

        //     }
        // End Mail Send

        // call make pdf function
        $ch = curl_init();
        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_URL, "https://allmart.world/invoice/invoice.php?order_id=" . $order_id);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        // grab URL and pass it to the browser
        curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        // close cURL resource, and free up system resources
        curl_close($ch);

        // echo  $httpcode;

        if ($email != '') {

            $EmailSubject = "Thank You For Shopping At AllMart";

            $MESSAGE_BODY = "";

            // $leadsmail  = "ram@sarmicrosystems.in', 'Mailer";
            $leadsmail = "noreply@allmart.world', 'Mailer";

            $mailheader = "From: " . $leadsmail . "\r\n";
            $mailheader .= "Reply-To: " . $leadsmail . "\r\n";

            require "library/phpmail/src/Exception.php";
            require "library/phpmail/src/PHPMailer.php";
            require "library/phpmail/src/SMTP.php";

            $smtmail = new PHPMailer\PHPMailer\PHPMailer();

            //Server settings
            //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $smtmail->isSMTP(); // Set mailer to use SMTP
            // $smtmail->Host       = 'sarmicrosystems.in'; // Specify main and backup SMTP servers
            $smtmail->Host     = 'allmart.world'; // Specify main and backup SMTP servers
            $smtmail->SMTPAuth = true; // Enable SMTP authentication

            // $smtmail->Username   = 'ram@sarmicrosystems.in'; // SMTP username
            // $smtmail->Password   = 'ram1234*'; // SMTP password

            $smtmail->Username = 'noreply@allmart.world'; // SMTP username
            $smtmail->Password = 'Allmart@321#'; // SMTP password

            $smtmail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
            $smtmail->Port       = 587; // TCP port to connect to

            //Recipients
            // $smtmail->setFrom('ram@sarmicrosystems.in', 'ALLMart Ecommarce LLP ');
            $smtmail->setFrom('noreply@allmart.world', 'ALLMart Ecommarce LLP ');
            $smtmail->addAddress($email);
            $smtmail->mailheader = $mailheader; // Add a recipient
            //$mail->addAddress('ellen@example.com');               // Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            $smtmail->addCC('enquiry.allmart@gmail.com');
            //$mail->addBCC('bcc@example.com');

            //Attachments
            // $imgs=$orderresult['packaging_images'];
            // $imgs = explode(', ', $imgs);
            // for ($i=0; $i <count($imgs) ; $i++) {
            //     $mail->addAttachment(__DIR__ . '/../admin/'.$imgs[$i]);
            // }

            $smtmail->addAttachment(__DIR__ . '/invoice/bills/Invoice-' . $order_id . '.pdf'); // Add attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $smtmail->isHTML(true); // Set email format to HTML
            $smtmail->Subject = $EmailSubject . "\r\n";
            $smtmail->Body    = $link . "\r\n" . $MESSAGE_BODY;
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            //$mail->AltBody=$MESSAGE_BODY;
            $smtmail->send();
//==============mail end===

//  if(!$smtmail->Send()) {
            //         echo "Mailer Error: " . $mail->ErrorInfo;
            //      } else {
            //         echo "Message has been sent";
            //      }
        }

        $show_email_sql = mysqli_query($con1, "select * from order_details  where oid='" . $order . "' ");
        $_orderdate     = date('Y-m-d');
        while ($show_order_sql_result1 = mysqli_fetch_assoc($show_email_sql)) {
            $single_price1 = $show_order_sql_result1['rate'];
            $total_amt1    = $single_price1 * $pro_qty1;
            $_prod_qty     = $show_order_sql_result1['qty'];
            $_product_id   = explode('/', $show_order_sql_result1['item_id']);
            $promotion     = $_product_id[0];

            $sql1               = mysqli_query($con1, "select allmart_commission from products where code='" . $_product_id[0] . "' and category='" . $_product_id[1] . "' and name='" . $_product_id[2] . "' order by code desc");
            $sql_result1        = mysqli_fetch_assoc($sql1);
            $allmart_commission = 0;
            if (!empty($sql_result1)) {
                $allmart_commission = $sql_result1['allmart_commission'];
                $client_id          = getccode($_product_id[1], $_product_id[0]);
                $franchise_id       = getfranchise($client_id);
                // echo $franchise_id;
            }
            $allmart_commission = $allmart_commission * $_prod_qty;
            $sql1               = mysqli_query($con1, "select txn_id from commission order by id desc");
            $sql_result1        = mysqli_fetch_assoc($sql1);

            $txnid  = $sql_result1['txn_id'];
            $txnid  = preg_replace('/[^0-9]/', '', $txnid);
            $txnid  = $txnid + 1;
            $txn_id = 'txn-' . $txnid;

            commission($txn_id, $allmart_commission, $franchise_id, $_orderdate, $promotion);
        }

    }

} else if ($order_status === "Aborted") {
    echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
} else if ($order_status === "Failure") {
    echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
} else {
    echo "<br>Security Error. Illegal access detected";
}

?>

 <div class="product-model">
     <div class="container">
         <div class="row ">
          <div class="col-md-12 pay-info">
      <?php if ($order_status === "Success") {

    $sql        = mysqli_query($con1, "select * from Order_ent where transaction_id='" . $txnidfo . "'");
    $sql_result = mysqli_fetch_assoc($sql);
    $order_id   = $sql_result['id'];
    $date       = $sql_result['date'];

    $order_sql      = mysqli_query($con1, "select * from new_order where oid='" . $order_id . "'");
    $ord_sql_result = mysqli_fetch_assoc($order_sql);
    $firstname      = $ord_sql_result['name'];
    $email          = $ord_sql_result['email'];

    echo "<h3>Thank You, " . $firstname . ".Your order is placed successfully .</h3>";
    echo "<h4>Your Transaction ID for this transaction is <span class='txn_id'>" . $txnidfo . ".</span></h4>";?>
            <div id="primary" class="content-area">
                    <main id="main" class="site-main" role="main">
                      <article id="post-8" class="post-8 page type-page status-publish hentry">
                        <div class="entry-content">
                        <div class="woocommerce">
                         <div class="woocommerce-order">

                <ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">
                <li class="woocommerce-order-overview__order order">
                    Order number: <strong><?echo $order_id; ?></strong>
                </li>
                <li class="woocommerce-order-overview__date date">
                    Date:  <strong><?echo $date; ?> </strong>
                </li>
                <li class="woocommerce-order-overview__email email">
                    Email: <strong><?echo $email; ?></strong>
                    </li>
                <li class="woocommerce-order-overview__total total">
                    Total: <strong><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><?echo $total_amount; ?></span></strong>
                </li>
            </ul>
        <section class="woocommerce-order-details">
    <h2 class="woocommerce-order-details__title">Order details</h2>
    <table class="woocommerce-table woocommerce-table--order-details shop_table order_details">
        <thead>
            <tr>
                <th class="woocommerce-table__product-name product-name">Product</th>
                <th class="woocommerce-table__product-name product-name">Individual Price</th>
                <th class="woocommerce-table__product-table product-total">Total</th>
            </tr>
        </thead>
        <tbody>
<?
    $show_order_sql = mysqli_query($con1, "select * from order_details where oid='" . $order_id . "'");
    while ($show_order_sql_result = mysqli_fetch_assoc($show_order_sql)) {
        $pro_image    = $show_order_sql_result['image'];
        $pro_name     = $show_order_sql_result['product_name'];
        $pro_qty      = $show_order_sql_result['qty'];
        $single_price = $show_order_sql_result['rate'];
        $total_amt    = $single_price * $pro_qty;
        ?>
      <tr class="woocommerce-table__line-item order_item">
    <td class="woocommerce-table__product-name product-name">
        <img src="<?echo $pro_image; ?>">
        <?echo $pro_name; ?> <strong class="product-quantity">×&nbsp;<?echo $pro_qty; ?></strong>   </td>
    <td class="woocommerce-table__product-total product-total">
        <?echo $single_price; ?>
    </td>
    <td class="woocommerce-table__product-total product-total">
        <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><?echo $total_amt; ?></span>   </td>
</tr>
<?}?>
        </tbody>
        <tfoot>
                   <tr>
                        <th scope="row">Shipping:</th>
                        <td colspan='8'><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><?echo $shoppingcharge; ?></span></td>

                    </tr>
                    <tr>
                        <th scope="row">Total:</th>
                        <td colspan='8'><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><?echo $total_amount; ?></span></td>
                    </tr>
        </tfoot>
    </table>
    </section>
</div>
</div>
</div>
<!-- .entry-content -->
        </article><!-- #post-## -->
        </main><!-- #main -->
    </div>
            <?

    $_SESSION['pay_status'] = true;

} else {
    echo "<h3>Something went Wrong !! </h3>";
    echo "<h4>Please try Again !</h4>";
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
    background: #e3e5e6;
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

