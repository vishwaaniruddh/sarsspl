<?php
session_start();
include 'config.php';
include 'adminaccess.php';

error_reporting(E_ALL);
ini_set('display_errors', '1');

if (isset($_SESSION['SESS_USER_NAME']) && isset($_SESSION['SESS_USER_NAME'])) {
    echo "";
} else {
    ?>

<script>

        window.location.href='<?=$baseurl?>adminpanel/';

</script>
<?php

}
// var_dump($_POST);
// include('admin.php');
?>
<link

      href="<?=$baseurl?>assets/frame.scss.css"

      rel="stylesheet"

      type="text/css"

      media="all"

    />

    <script src="<?=$baseurl?>assets/sweetalert.min.js"></script>


    <link

      href="<?=$baseurl?>assets/home-sections.scss.css"

      rel="stylesheet"

      type="text/css"

      media="all"

    />

    <link

      href="<?=$baseurl?>assets/style.css"

      rel="stylesheet"

      type="text/css"

      media="all"

    />
<!--
    <link

      href="<?=$baseurl?>assets/videopopup.css"

      rel="stylesheet"

      type="text/css"

      media="all"

    />-->

    <link

      href="<?=$baseurl?>assets/slick.scss"

      rel="stylesheet"

      type="text/css"

      media="all"

    />

    <link

      href="<?=$baseurl?>assets/prettyPhoto.css"

      rel="stylesheet"

      type="text/css"

      media="all"

    />

    <link

      href="<?=$baseurl?>assets/animate.css"

      rel="stylesheet"

      type="text/css"

      media="all"

    />

    <link

      href="<?=$baseurl?>assets/font-all.min.css"

      rel="stylesheet"

      type="text/css"

      media="all"

    />



    <link

      rel="stylesheet"

      type="text/css"

      href="<?=$baseurl?>assets/gfontcss.css"

    />







    <link

      rel="stylesheet"

      type="text/css"

      href="<?=$baseurl?>assets/gfont3css.css"

    />



    <link

      rel="stylesheet"

      type="text/css"

      href="<?=$baseurl?>assets/gfont2css.css"

    />

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous"></script> -->

    <link rel="stylesheet" href="<?=$baseurl?>assets/notyf.min.css">
    <script src="<?=$baseurl?>assets/notyf.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>

    <style type="text/css">

        .imgBox{width: 300px;height: 300px;border: 1px solid #222;}
    </style>

    <script

      src="<?=$baseurl?>assets/header.js?v=10373096426439681222"

      type="text/javascript"

    ></script>
<?

if (isset($_POST['txnid'])) {
    $txnid         = $_POST['txnid'];
    $date          = $_POST['orderdate'];
    $ordertype     = $_POST['ordertype'];
    $customre_Name = mysqli_real_escape_string($con1, $_POST['customre_Name']);
    $billing_name  = ($customre_Name != '') ? $customre_Name : 'Add By Admin';

    $customre_Email = mysqli_real_escape_string($con1, $_POST['customre_Email']);
    $billing_email  = ($customre_Email != '') ? $customre_Email : "";

    $customre_Mob = $_POST['customre_Mob'];
    $billing_tel  = ($customre_Mob != '') ? $customre_Mob : "";

    $billing_address = mysqli_real_escape_string($con1, $_POST['billing_addres']);
    $shipping_addres = mysqli_real_escape_string($con1, $_POST['shipping_addres']);

    $billing_zip     = $_POST['billing_zip'];
    $billing_state   = $_POST['billing_state'];
    $billing_city    = $_POST['billing_city'];
    $billing_country = "India";

    $shipping_zip   = $_POST['shipping_zip'];
    $shipping_state = $_POST['shipping_state'];
    $shipping_city  = $_POST['shipping_city'];

    $pannumber = $_POST['pannumber'];
    $gstnumber = $_POST['gstnumber'];
    $amount    = $_POST['g_total'];
    $discount  = $_POST['discount'];
    $Notes     = $_POST['Notes'];

    $shoppingcharge = $_POST['shipping_charges'];
    $amount         = $amount + $shoppingcharge;
    $amount         = $amount - $discount;

    $pid          = $_POST['pid'];
    $prod_id      = $_POST['prod_id'];
    $category_id  = $_POST['category_id'];
    $vendor       = $_POST['vendor'];
    $order_status = '0';
    $date         = date('Y-m-d H:i:s', strtotime($date));

    $userid = $_SESSION['SESS_USER_NAME'];

    $select_sql        = mysqli_query($con1, "select * from Order_ent where transaction_id='" . $txnid . "'") or die(mysqli_error($con1));
    $select_sql_result = mysqli_fetch_assoc($select_sql);
    if (!mysqli_num_rows($select_sql)) {
        //to prevent duplicate entries
        $ttlout_product = 0;
        $iscount        = count($_POST['pid']);
        if (isset($_POST['outside_product'])) {
            for ($r = 0; $r < $iscount; $r++) {
                $out_product    = $_POST['outside_product'][$r];
                $ttlout_product = $ttlout_product + $out_product;
            }
        }

        $crtids       = $pid;
        $json_cart    = json_encode($crtids);
        $json_cart    = str_replace(array('[', ']', '"'), '', $json_cart);
        $arr          = explode(',', $json_cart);
        $json_cart    = implode(",", $arr);
        $is_franchise = '0';
        $insert       = "insert into Order_ent(user_id,date,amount,status,pmode,pdfpath,cmplt_status,transaction_stats,transaction_id,cartids_inorder,shipping_charges,pan_details,gst_details,discount,Notes) values('" . $userid . "','" . $date . "','" . $amount . "','1','" . $ordertype . "','','','" . $order_status . "','" . $txnid . "','" . $json_cart . "','" . $shoppingcharge . "','" . $pannumber . "','" . $gstnumber . "','" . $discount . "','" . $Notes . "')";
        mysqli_query($con1, $insert) or die(mysqli_error($con1));
        $order = mysqli_insert_id($con1);

        $new_statement = "insert into new_order(oid, name,email,phone,address,city,state,country,zip,status,created_at,bill_address,bill_city,bill_state,bill_zip) values('" . $order . "','" . $billing_name . "','" . $billing_email . "','" . $billing_tel . "','" . $shipping_addres . "','" . $shipping_city . "','" . $shipping_state . "','" . $billing_country . "','" . $shipping_zip . "','1','" . $date . "','" . $billing_address . "','" . $billing_city . "','" . $billing_state . "','" . $billing_zip . "')";
        $new_order     = mysqli_query($con1, $new_statement) or die(mysqli_error($con1));

        $procount = count($_POST['pid']);

        if ($ttlout_product) {
            $ttq         = count($_POST['outside_product']);
            $ttamount    = $amount;
            $purchase_id = addPurchase($userid, $ttq, $ttamount, $order);
            $sale_id     = addsale($userid, $ttq, $ttamount, $order, $is_franchise);

        }
        $_orderdate = date('Y-m-d');

        for ($i = 0; $i < $procount; $i++) {
            $qty          = $_POST['productqty'][$i];
            $product_amt  = $_POST['productprice'][$i];
            $product_name = $_POST['productId'][$i];
            $pid          = $_POST['pid'][$i];
            $vendor       = $_POST['vendor'][$i];
            $cat_id       = $_POST['category_id'][$i];
            $prodid       = $_POST['prod_id'][$i];
            $item_id      = $pid . "/" . $cat_id . "/" . $prodid;

            if (isset($_POST['outside_product'][$i])) {
                $outside_product = $_POST['outside_product'][$i];
            } else {
                $outside_product = 0;
            }

            if (isset($_POST['pro_img'][$i])) {
                $product_image = $_POST['pro_img'][$i];
            } else {
                $product_image = Getimg($pid, $cat_id, $prodid);
            }

            if (!isset($_POST['outside_product'][$i])) {$prodata = getproductprice($cat_id, $pid);}

            if (isset($_POST['hsn'][$i])) {

                $HSN = $_POST['hsn'][$i];
            } else {
                $HSN = $prodata['HSN'];
            }

            if (isset($_POST['gst'][$i])) {
                $gst = $_POST['gst'][$i];
            } else {
                $gst = $prodata['gst'];
            }

            if (isset($_POST['color'][$i])) {
                $color = $_POST['color'][$i];
            } else {
                $color = "";
            }

            if (isset($_POST['size'][$i])) {
                $size = $_POST['size'][$i];
            } else {
                $size = "";
            }

            if (isset($_POST['mrp'][$i])) {
                $mrp = $_POST['mrp'][$i];
            } else {
                $mrp = $product_amt;
            }

            $discount = get_percentage($mrp, $product_amt);

            $resdata     = array();
            $totalpro    = 0;
            $totalAmount = $product_amt * $qty;

            if ($outside_product) {

                $pur_discount    = 70;
                $pur_amount      = $mrp - ($mrp * $pur_discount) / 100;
                $pur_totalAmount = $pur_amount * $qty;

                AddProductAdd($pid, $product_name, $cat_id, '1508', $pur_amount, $qty, $HSN, $purchase_id, $gst, $mrp, $pur_discount, $pur_totalAmount);
                AddProductSale($pid, $product_name, $cat_id, '1508', $product_amt, $qty, $HSN, $sale_id, $gst, $mrp, $discount, $totalAmount, $is_franchise);
                for ($c = 0; $c < $qty; $c++) {

                    $res = AddCartCall('1094218', $pid, $size, $color);
                    array_push($resdata, $res);
                    $totalpro = $totalpro + 1;
                }
            }
             $resdata=json_encode($resdata);
            $product_name =mysqli_real_escape_string($con1, $product_name);

            $insert_order_details = "insert into order_details(oid,item_id,rate,qty,discount,rejected_qty,status,total_amt,mrc_id,cat_id,track_id,track_Status,color,size,product_name,image,date,HSN,gst,cart_res,outside_product,mrp) values ('" . $order . "','" . $item_id . "','" . $product_amt . "','" . $qty . "','','','1','" . $product_amt * $qty . "','" . $vendor . "','" . $cat_id . "','','','" . $color . "','" . $size . "','" . $product_name . "','" . $product_image . "','" . $date . "','" . $HSN . "','" . $gst . "','" . $resdata . "','" . $outside_product . "','" . $mrp . "')";
            mysqli_query($con1, $insert_order_details);

            $promotion   = $pid;
            $sql1        = mysqli_query($con1, "select allmart_commission from products where code='" . $pid . "' and category='" . $cat_id . "' and name='" . $prodid . "' order by code desc") or die(mysqli_error($con1));
            $sql_result1 = mysqli_fetch_assoc($sql1);

            if ($totalpro > 0) {
                $Records = array(
                    'member_id'              => "1094218",
                    'wallet_category'        => "1",
                    'ewallet_account_number' => "ALLMART",
                    'ewallet_password'       => "791278",
                    'coupon_code'            => "",
                    'delivery_type'          => "",
                    'first_name'             => $billing_name,
                    'add1'                   => $billing_address,
                    'add2'                   => "",
                    'add3'                   => "",
                    'city'                   => $billing_city,
                    'state'                  => $billing_state,
                    'pincode'                => $billing_zip,
                    'email'                  => $billing_email,
                    'phone'                  => $billing_tel,
                );

                $alldata = array(
                    'ref'     => "forewallet",
                    'Records' => $Records,
                );

                $jsondata = json_encode($alldata);
                // var_dump($jsondata);

                $parameter = 'json_request=' . $jsondata;
                $other_res = APICheckout('1094218', $parameter);
                // echo $other_res;
                // echo "<br/>";

                $updatedata = mysqli_query($con1, "UPDATE `Order_ent` SET `other_res`='" . $other_res . "' WHERE `id`='" . $order . "'");

            }

            $allmart_commission = 0;
            if (!empty($sql_result1)) {
                $allmart_commission = $sql_result1['allmart_commission'];
                $allmart_commission = (($product_amt / 100) * $sql_result1['allmart_commission']);
                $client_id          = $vendor;
                $franchise_id       = getfranchise($client_id);
                // echo $franchise_id;
            }

            $allmart_commission = $allmart_commission * $qty;
            $sql1               = mysqli_query($con1, "select txn_id from commission order by id desc") or die(mysqli_error($con1));
            $sql_result1        = mysqli_fetch_assoc($sql1);

            $txnid  = $sql_result1['txn_id'];
            $txnid  = preg_replace('/[^0-9]/', '', $txnid);
            $txnid  = $txnid + 1;
            $txn_id = 'txn-' . $txnid;
            // var_dump($franchise_id);die();
            $neworder_id = $order . "-" . $promotion;

            // commission($txn_id, $allmart_commission, $franchise_id, $_orderdate, $promotion,'',$neworder_id);

        }

        $ch = curl_init();
        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_URL, "<?=$baseurl?>invoice/invoice.php?order_id=" . $order);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        // grab URL and pass it to the browser
        curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        // close cURL resource, and free up system resources
        curl_close($ch);

        ?>

<!-- <script>
    alert("Order Added Successfully !");
    setTimeout(function(){
        window.location.href='<?=$baseurl?>adminpanel/Order.php';
    }, 1500);
</script> -->

<?php
} else {
        ?>

<!-- <script>
       swal("Duplicate Entry !","","error");

    setTimeout(function(){
        window.location.href='<?=$baseurl?>adminpanel/AddOrderByAdmin.php';
    }, 3000);
</script> -->
<?php
}
}

function AddCartCall($userid, $product_id, $size, $color)
{

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL            => 'https://thebrandtadka.com/api/index.php?mod=ApiMobile&api_key=VarifyTADKA7563&company_id=400%20&action=addToCart&token=8cc6be81ea4f574acf24aa1aaae2252d&product_id=' . $product_id . '&member_id=1094218&size_id=' . $size . '&color_id=' . $color,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING       => '',
        CURLOPT_MAXREDIRS      => 10,
        CURLOPT_TIMEOUT        => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST  => 'GET',
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return $response;
}

function APICheckout($userid, $parameters)
{

    $url      = 'https://thebrandtadka.com/api/index.php?mod=ApiMobile';
    $postdata = 'action=CheckoutEwallet&api_key=VarifyTADKA7563&token=8cc6be81ea4f574acf24aa1aaae2252d&company_id=400&d&member_id=1094218&' . $parameters;

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL            => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING       => '',
        CURLOPT_MAXREDIRS      => 10,
        CURLOPT_TIMEOUT        => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST  => 'POST',
        CURLOPT_POSTFIELDS     => $postdata,
        CURLOPT_HTTPHEADER     => array(
            'Content-Type: application/x-www-form-urlencoded',
            'Cookie: PHPSESSID=9e6b5c13803cddcabcdd9ba3bf9afbf3',
        ),
    ));
    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

function addPurchase($userid, $totalqty, $amount, $order)
{
    global $con4;
    $data    = date("Y-m-d");
    $getbill = mysqli_fetch_assoc(mysqli_query($con4, "SELECT MAX(pur_id) as Max FROM `phppos_purchase`"));
    $max1    = $getbill['Max'];
    $max     = $max1 + 1;
    $bill_id = "ORDNO-" . $max;

    $result = mysqli_query($con4, "INSERT INTO `phppos_purchase`(`bill_id`,`supp_id`, `date`, `totalqty`, `totalamt`, `outstanding`, `discount`, `payamt`,`is_customer`,`order_id`) VALUES ('" . $bill_id . "','1508','" . $data . "','" . $totalqty . "','" . $amount . "','0','0','" . $amount . "','1','" . $order . "')");
    // var_dump($result);
    $insertid = mysqli_insert_id($con4);
    return $insertid;
}

function addsale($userid, $totalqty, $amount, $order_id, $is_franchise)
{
    global $con4;
    $data    = date("Y-m-d");
    $getbill = mysqli_fetch_assoc(mysqli_query($con4, "SELECT MAX(pur_id) as Max FROM `Customers_sales`"));
    $max1    = $getbill['Max'];
    $max     = $max1 + 1;
    $bill_id = "ORDNO-" . $max;

    $result = mysqli_query($con4, "INSERT INTO `Customers_sales`(`bill_id`,`cust_id`, `date`, `totalqty`, `totalamt`, `outstanding`, `discount`, `payamt`,`is_customer`,`order_id`,`is_franchise`) VALUES ('" . $bill_id . "','" . $userid . "','" . $data . "','" . $totalqty . "','" . $amount . "','0','0','" . $amount . "','1',$order_id,'" . $is_franchise . "')");
    // var_dump($result);
    $insertid = mysqli_insert_id($con4);

    return $insertid;
}

function AddProductAdd($pid, $product_name, $cat_id, $supplier_id, $product_amt, $qty, $HSN, $pur_id, $gst, $mrp, $discount, $totalamt)
{

    global $con4;

    $item    = "select * from phppos_items where item_number='" . $pid . "'";
    $getitem = mysqli_query($con4, $item);

    $itemcount = mysqli_num_rows($getitem);

    if ($itemcount == 0) {

        $addsqli = "INSERT INTO `phppos_items`(`name`, `category`, `supplier_id`, `item_number`, `description`, `cost_price`, `unit_price`, `quantity`, `hsn`) VALUES ('" . $product_name . "','" . $cat_id . "','" . $supplier_id . "','" . $pid . "','','" . $product_amt . "','" . $product_amt . "','" . $qty . "','" . $HSN . "')";

        $additem  = mysqli_query($con4, $addsqli);
        $myautoid = mysqli_insert_id($con4);
        $newqtry  = $qty;

    } else {
        $itemdata = mysqli_fetch_assoc($getitem);
        $quantity = $itemdata['quantity'];
        $myautoid = $itemdata['item_id'];
        $newqtry  = $quantity + $qty;

    }

    $sql   = "SELECT * FROM `product_stock` WHERE cat_id ='" . $cat_id . "' AND pid='" . $pid . "'";
    $query = mysqli_query($con4, $sql);
    $count = mysqli_num_rows($query);
    if ($count) {

        $roww    = mysqli_fetch_assoc($query);
        $qnty    = $roww['stock'] - $qty;
        $addprro = "UPDATE `product_stock` SET `stock`='" . $qnty . "'WHERE cat_id='" . $cat_id . "' AND pid='" . $pid . "'";
        mysqli_query($con4, $addprro);
    } else {

        $addstock = "INSERT INTO `product_stock`(`cat_id`, `pid`, `stock`) VALUES ('" . $cat_id . "','" . $pid . "','" . $newqtry . "')";
        $str      = mysqli_query($con4, $addstock);

    }

    $data = mysqli_query($con4, "INSERT INTO `phppos_purchase_details`(`pur_id`, `item_id`, `qty`, `price`, `hsn`,`gst`,`mrp`,`discount`,`total_price`) VALUES ('" . $pur_id . "','" . $myautoid . "','" . $qty . "','" . $product_amt . "','" . $HSN . "','" . $gst . "','" . $mrp . "','" . $discount . "','" . $totalamt . "')");
    return $data;
}

function AddProductSale($pid, $product_name, $cat_id, $supplier_id, $product_amt, $qty, $HSN, $pur_id, $gst, $mrp, $discount, $totalamt)
{

    global $con4;
    $item    = "select * from phppos_items where item_number='" . $pid . "'";
    $getitem = mysqli_query($con4, $item);

    $itemcount = mysqli_num_rows($getitem);

    if ($itemcount == 0) {
        $addsqli  = "INSERT INTO `phppos_items`(`name`, `category`, `supplier_id`, `item_number`, `description`, `cost_price`, `unit_price`, `quantity`, `hsn`) VALUES ('" . $product_name . "','" . $cat_id . "','" . $supplier_id . "','" . $pid . "','','" . $mrp . "','" . $product_amt . "','" . $qty . "','" . $HSN . "')";
        $additem  = mysqli_query($con4, $addsqli);
        $myautoid = mysqli_insert_id($con4);
        $newqtry  = $qty;
    } else {
        $itemdata = mysqli_fetch_assoc($getitem);
        $quantity = $itemdata['quantity'];
        $myautoid = $itemdata['item_id'];
        $newqtry  = $quantity + $qty;

    }

    $sql   = "SELECT * FROM `product_stock` WHERE cat_id ='" . $cat_id . "' AND pid='" . $pid . "'";
    $query = mysqli_query($con4, $sql);
    $count = mysqli_num_rows($query);
    if ($count) {

        $roww    = mysqli_fetch_assoc($query);
        $qnty    = $roww['stock'] + $qty;
        $addprro = "UPDATE `product_stock` SET `stock`='" . $qnty . "'WHERE cat_id='" . $cat_id . "' AND pid='" . $pid . "'";
        mysqli_query($con4, $addprro);
    } else {

        $addstock = "INSERT INTO `product_stock`(`cat_id`, `pid`, `stock`) VALUES ('" . $cat_id . "','" . $pid . "','" . $newqtry . "')";
        $str      = mysqli_query($con4, $addstock);

    }

    $data = mysqli_query($con4, "INSERT INTO `Customers_sales_details`(`pur_id`, `item_id`, `qty`, `price`, `hsn`,`gst`,`mrp`,`discount`,`total_price`) VALUES ('" . $pur_id . "','" . $myautoid . "','" . $qty . "','" . $product_amt . "','" . $HSN . "','" . $gst . "','" . $mrp . "','" . $discount . "','" . $totalamt . "')");

}

function Getimg($pid, $cid, $prod_id)
{

    global $con1;

    $qrya = "SELECT * FROM `main_cat` WHERE `id`='$cid'";

    $resulta = mysqli_query($con1, $qrya);

    $rowa = mysqli_fetch_row($resulta);

    $aa = $rowa[2];

    if ($cid == 80) {

        $maincatid = 5;

        $sql = "select * from  `garment_product` where product_for='" . $maincatid . "' and  gproduct_id in(select gproduct_id from product_images_new where gproduct_id>0)";

    } else {

        if ($aa != 0) {

            $qrya1 = "select * from main_cat where id='" . $aa . "'";

            $resulta1 = mysqli_query($con1, $qrya1);

            $rowa1 = mysqli_fetch_row($resulta1);

            $Maincate = $rowa1[4];

        }

    }

    if ($Maincate == 1) {

        $sqlimg23mn = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `fashion_img` WHERE `product_id`='$pid' order by id asc limit 0,1");

    } else if ($Maincate == 190) {

        $sqlimg23mn = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `electronics_img` WHERE `product_id`='$pid' order by id asc  limit 0,1");
    } else if ($Maincate == 218) {

        $sqlimg23mn = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `grocery_img` WHERE `product_id`='$pid' order by id asc limit 0,1");

    } else if ($Maincate == 760) {

        $sqlimg23mn = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `kits_img` WHERE `product_id`='$pid' order by id asc limit 0,1");

    } else if ($Maincate == 657) {

        $sqlimg23mn = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `service_img` WHERE `product_id`='$pid' order by id asc limit 0,1");

    } else if ($Maincate == 767) {

        $sqlimg23mn = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `promotion_product_img` WHERE `product_id`='$pid' order by id asc limit 0,1");

    } else {

        $sqlimg23mn = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `product_img` WHERE `product_id`='$pid' order by id asc limit 0,1");

    }

    $frtu = mysqli_fetch_array($sqlimg23mn);

    if (isset($_GET['gid'])) {

        $jewellery = false;

        // $maincatid = ' in(5,10,22,27,28)';

        if ($cid == 80) {

            $maincatid = ' in(22,27,28,29)';

        } else if ($cid == 82) {

            $maincatid = ' in(8)';

        } else if ($cid == 84) {

            $maincatid = ' in(10)';

        } else if ($cid == 85) {

            $maincatid = ' in(5)';

        } else if ($cid == 117) {

            // jewellery

            $jewellery = true;

            $maincatid = ' in(19)';

        } else if ($cid == 117) {

            // jewellery

            $jewellery = true;

            $maincatid = ' in(19)';

        }

        if ($jewellery) {

            $prcode = $data['product_code'];

            $sql = "SELECT * FROM `product` WHERE `categories_id` " . $maincatid . " and product_id=" . $_GET['gid'];

            $sqlimg = "SELECT img_name FROM `product_images_new` WHERE `product_id`=" . $_GET['gid'];

        } else {

            $prcode = $data['gproduct_code'];

            $sql = "select * from  `garment_product` where product_for " . $maincatid . " and gproduct_id=" . $_GET['gid'];

            $sqlimg = "SELECT img_name FROM `product_images_new` WHERE `gproduct_id`=" . $_GET['gid'];

        }

        // $sql="select * from  `garment_product` where product_for ".$maincatid." and gproduct_id=".$_GET['gid'];

        $result = mysqli_query($con1, $sql);

        $data = mysqli_fetch_array($result);

        //print_r($data);

        if ($jewellery) {

            $prcode = $data['product_code'];

        } else {

            $prcode = $data['gproduct_code'];

        }

        $rate_qry = mysqli_query($con1, "SELECT unit_price,cost_price,quantity FROM phppos_items where name like '" . $prcode . "'");

        $rate = mysqli_fetch_row($rate_qry);

        // $sqlimg="SELECT img_name FROM `product_images_new` WHERE `gproduct_id`=".$_GET['gid'];

        // echo $sqlimg;

        $qryimg = mysqli_query($con1, $sqlimg);

        $rowimg = mysqli_fetch_row($qryimg);

        $path = trim($pathmain . "uploads" . $rowimg[0]);

        $expl = explode('/', $path);

        $pth1 = trim($pathmain . "mid1/" . $expl[$cnt - 1]);

        $pro_img = "http://yosshitaneha.com/" . $path;

        return $pro_img;

    } else {

        $categogy = $cid;

        $prod_id = $prod_id;

        $cust_pid = $pid;

        if ($categogy == '761') {

            $pro_img = '<?=$baseurl?>ecom/' . get_kit_info($cust_pid, 'photo');

        } else {

            $pro_img = '<?=$baseurl?>ecom/' . $frtu[0];

        }

    }

    return $pro_img;

}

function get_kit_info($id, $parameter)
{

    global $con1;

    $sql        = mysqli_query($con1, "select $parameter from kits where code ='" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result[$parameter];

}

function commission($txn_id, $commision, $mem, $date, $promotion, $reffid, $order_id)
{

    global $con;
    global $con1;

    if ($reffid != '' && $reffid != 0) {
        $ref_amt          = round($commision / 2, 5);
        $distribut_amount = $ref_amt;
        mysqli_query($con1, "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at,order_id,is_referral) values('" . $txn_id . "','" . $reffid . "','" . $ref_amt . "','1','" . $promotion . "','" . $date . "','" . $order_id . "',1)");

    } else {
        $distribut_amount = $commision;
        $reffid           = 0;
    }

    // $distribut_amount = $commision;
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
    $date     = date('Y-m-d');

    if ($village > 0) {
        $vil_sql        = mysqli_query($con, "select * from new_member where village='" . $village . "' and id<>'" . $reffid . "' and status=1");
        $vil_sql_result = mysqli_fetch_assoc($vil_sql);
        $vil_mem        = $vil_sql_result['id'];

        if ($vil_mem) {
            $vil_amount    = round($distribut_amount / 2, 5);
            $actual_amount = $vil_amount;
            if ($mem == $vil_mem) {$is_introducer = '1';} else { $is_introducer = '';}

            // echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','village".$vil_mem."','".$vil_amount."','1','".$promotion."','".$date."')";
            // echo '<br>';
            mysqli_query($con1, "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at,order_id,is_introducer) values('" . $txn_id . "','" . $vil_mem . "','" . $vil_amount . "','1','" . $promotion . "','" . $date . "','" . $order_id . "','" . $is_introducer . "')");
        } else {
            $actual_amount = $distribut_amount;
        }

    } else {
        $vil_amount    = $distribut_amount;
        $actual_amount = $distribut_amount;
        $vil_mem       = 0;
    }

    if ($pincode > 0) {

        $pin_sql        = mysqli_query($con, "select * from new_member where pincode='" . $pincode . "' and id<>'" . $reffid . "' and village=0 and status=1");
        $pin_sql_result = mysqli_fetch_assoc($pin_sql);
        $pin_mem        = $pin_sql_result['id'];

        if ($pin_mem) {

            $pin_amount    = round($vil_amount / 2, 5);
            $actual_amount = $pin_amount;
            if ($mem == $pin_mem) {$is_introducer = '1';} else { $is_introducer = '';}
            // echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','pincode".$pin_mem."','".$pin_amount."','1','".$promotion."','".$date."')";
            // echo '<br>';
            mysqli_query($con1, "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at,order_id,is_introducer) values('" . $txn_id . "','" . $pin_mem . "','" . $pin_amount . "','1','" . $promotion . "','" . $date . "','" . $order_id . "','" . $is_introducer . "')");
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
        $tal_sql        = mysqli_query($con, "select * from new_member where taluka='" . $taluka . "' and id<>'" . $reffid . "' and pincode=0 and status=1");
        $tal_sql_result = mysqli_fetch_assoc($tal_sql);
        $tal_mem        = $tal_sql_result['id'];

        if ($tal_mem) {
            $tal_amount    = round($pin_amount / 2, 5);
            $actual_amount = $tal_amount;
            if ($mem == $tal_mem) {$is_introducer = '1';} else { $is_introducer = '';}

            // echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','taluka".$tal_mem."','".$tal_amount."','1','".$promotion."','".$date."')";
            // echo '<br>';
            mysqli_query($con1, "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at,order_id,is_introducer) values('" . $txn_id . "','" . $tal_mem . "','" . $tal_amount . "','1','" . $promotion . "','" . $date . "','" . $order_id . "','" . $is_introducer . "')");
        } else {
            $tal_amount = $actual_amount;
        }

    } else {
        $tal_amount    = $distribut_amount;
        $actual_amount = $distribut_amount;
        $tal_mem       = 0;
    }

    if ($district > 0) {
        $dis_sql        = mysqli_query($con, "select * from new_member where district='" . $district . "' and id<>'" . $reffid . "' and taluka=0 and status=1");
        $dis_sql_result = mysqli_fetch_assoc($dis_sql);
        $dis_mem        = $dis_sql_result['id'];

        if ($dis_mem) {
            $dis_amount    = round($tal_amount / 2, 5);
            $actual_amount = $dis_amount;
            if ($mem == $dis_mem) {$is_introducer = '1';} else { $is_introducer = '';}
            // echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$dis_mem."','".$dis_amount."','1','".$promotion."','".$date."')";
            // echo '<br>';
            mysqli_query($con1, "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at,order_id,is_introducer) values('" . $txn_id . "','" . $dis_mem . "','" . $dis_amount . "','1','" . $promotion . "','" . $date . "','" . $order_id . "','" . $is_introducer . "')");

        } else {
            $dis_amount = $actual_amount;
        }

    } else {
        $dis_amount    = $distribut_amount;
        $actual_amount = $distribut_amount;
        $dis_mem       = 0;
    }

    if ($division > 0) {
        $div_sql        = mysqli_query($con, "select * from new_member where division='" . $division . "' and id<>'" . $reffid . "' and district=0 and status=1");
        $div_sql_result = mysqli_fetch_assoc($div_sql);
        $div_mem        = $div_sql_result['id'];

        if ($div_mem) {
            $div_amount    = round($dis_amount / 2, 5);
            $actual_amount = $div_amount;
            if ($mem == $div_mem) {$is_introducer = '1';} else { $is_introducer = '';}

            // echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$div_mem."','".$div_amount."','1','".$promotion."','".$date."')";
            // echo '<br>';

            mysqli_query($con1, "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at,order_id,is_introducer) values('" . $txn_id . "','" . $div_mem . "','" . $div_amount . "','1','" . $promotion . "','" . $date . "','" . $order_id . "','" . $is_introducer . "')");

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

        $state_sql        = mysqli_query($con, "select * from new_member where state='" . $state . "' and id<>'" . $reffid . "' and division=0 and status=1");
        $state_sql_result = mysqli_fetch_assoc($state_sql);
        $state_mem        = $state_sql_result['id'];

        if ($state_mem) {
            $state_amount  = round($div_amount / 2, 5);
            $actual_amount = $state_amount;
            if ($mem == $state_mem) {$is_introducer = '1';} else { $is_introducer = '';}

            // echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$state_mem."','".$state_amount."','1','".$promotion."','".$date."')";
            // echo '<br>';
            mysqli_query($con1, "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at,order_id,is_introducer) values('" . $txn_id . "','" . $state_mem . "','" . $state_amount . "','1','" . $promotion . "','" . $date . "','" . $order_id . "','" . $is_introducer . "')");
        } else {
            $state_amount = $actual_amount;
        }

    } else {
        $state_amount  = $distribut_amount;
        $actual_amount = $distribut_amount;
        $state_mem     = 0;
    }

    if ($zone > 0) {
        $zone_sql        = mysqli_query($con, "select * from new_member where zone='" . $zone . "' and id<>'" . $reffid . "' and state=0 and status=1");
        $zone_sql_result = mysqli_fetch_assoc($zone_sql);
        $zone_mem        = $zone_sql_result['id'];

        if ($zone_mem) {
            $zone_amount   = round($state_amount / 2, 5);
            $actual_amount = $zone_amount;
            if ($mem == $zone_mem) {$is_introducer = '1';} else { $is_introducer = '';}
            // echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$zone_mem."','".$zone_amount."','1','".$promotion."','".$date."')";
            // echo '<br>';
            mysqli_query($con1, "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at,order_id,is_introducer) values('" . $txn_id . "','" . $zone_mem . "','" . $zone_amount . "','1','" . $promotion . "','" . $date . "','" . $order_id . "','" . $is_introducer . "')");
        } else {
            $zone_amount = $actual_amount;
        }

    } else {
        $zone_amount   = $distribut_amount;
        $actual_amount = $distribut_amount;
        $zone_mem      = 0;
    }

    if ($country > 0) {
        $country_sql        = mysqli_query($con, "select * from new_member where country='" . $country . "' and id<>'" . $reffid . "' and zone=0 and status=1");
        $country_sql_result = mysqli_fetch_assoc($country_sql);
        $country_mem        = $country_sql_result['id'];

        if ($country_mem) {
            $country_amount = round($zone_amount / 2, 5);
            $sar_amount     = round($zone_amount / 2, 5);
            if ($mem == $country_mem) {$is_introducer = '1';} else { $is_introducer = '';}

            // echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$country_mem."','".$country_amount."','1','".$promotion."','".$date."')";
            // echo '<br>';
            mysqli_query($con1, "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at,order_id,is_introducer) values('" . $txn_id . "','" . $country_mem . "','" . $country_amount . "','1','" . $promotion . "','" . $date . "','" . $order_id . "','" . $is_introducer . "')");
        } else {
            $country_amount = $actual_amount;
            $sar_amount     = $actual_amount;
        }

    }
    // Sar Commission
    mysqli_query($con1, "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at,order_id) values('" . $txn_id . "','SAR','" . $sar_amount . "','1','" . $promotion . "','" . $date . "','" . $order_id . "')");
}

function getfranchise($client_id)
{
    global $con;
    global $con1;

    $sql = mysqli_query($con1, "SELECT * FROM `clients` WHERE code ='" . $client_id . "'");
    $row = mysqli_fetch_assoc($sql);

    $country = "india";
    $zone    = $row['city'];
    $state   = $row['state'];
    $pincode = $row['pincode'];

    $getfra        = mysqli_query($con, "SELECT * FROM `new_member` WHERE pincode='" . $pincode . "' AND zone='" . $zone . "' AND state='" . $state . "' AND country='" . $country . "'");
    $getfranchdata = mysqli_fetch_assoc($getfra);
    // var_dump($getfranchdata);die();

    return $getfranchdata['id'];

}

function getproductprice($cid, $pid)
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
            $qrylatf = "SELECT * FROM `fashion` WHERE code='" . $pid . "'";
        } else if ($Maincate == 190) {
            $qrylatf = "SELECT * FROM `electronics` WHERE code='" . $pid . "'";
        } else if ($Maincate == 218) {
            $qrylatf = "SELECT * FROM `grocery` WHERE code='" . $pid . "'";
        } else if ($Maincate == 760) {
            $qrylatf = "SELECT * FROM `kits` WHERE code='" . $pid . "'";
        } else if ($Maincate == 767) {
            $qrylatf = "SELECT  * FROM `promotion_product` WHERE code='" . $pid . "'";
        } else {
            $qrylatf = "SELECT  * FROM `products` WHERE code='" . $pid . "'";
        }
    }
    $qrylatfrws = mysqli_query($con1, $qrylatf);

    $latstprnrws = mysqli_fetch_array($qrylatfrws);
    return $latstprnrws;
}

function get_percentage($total, $number)
{
    $percent = (($total - $number) * 100) / $total;
    return $percent;
}
?>