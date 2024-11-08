<?php
session_start();
include 'config.php';
include 'adminaccess.php';
include '../Commi_Data.php';


error_reporting(E_ALL);
ini_set('display_errors', '1');

if (isset($_SESSION['SESS_USER_NAME']) && isset($_SESSION['SESS_USER_NAME'])) {
    echo "";
} else {
    ?>

<script>

        window.location.href='/adminpanel/';

</script>
<?php

}
// var_dump($_POST);
// include('admin.php');
?>
<link

      href="/assets/frame.scss.css"

      rel="stylesheet"

      type="text/css"

      media="all"

    />

    <script src="/assets/sweetalert.min.js"></script>


    <link

      href="/assets/home-sections.scss.css"

      rel="stylesheet"

      type="text/css"

      media="all"

    />


    <link rel="stylesheet" href="/assets/notyf.min.css">
    <script src="/assets/notyf.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>

    <style type="text/css">

        .imgBox{width: 300px;height: 300px;border: 1px solid #222;}
    </style>

   
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
    $ship_to       = $_POST['ship_to'];
    $order_status = '0';
    $date         = date('Y-m-d H:i:s', strtotime($date));

    $userid = $_SESSION['SESS_USER_NAME'];

    if(isset($_POST['is_franchise'])){  $is_franchise=$_POST['is_franchise']; } else {
    $is_franchise=0;
}

if (isset($_POST['userid'])) {
    $userid=$_POST['userid'];
}
else
{
   $userid = $_SESSION['SESS_USER_NAME'];  
}



    $select_sql        = mysqli_query($con1, "select * from proforma_Order_ent where transaction_id='" . $txnid . "'") or die(mysqli_error($con1));
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
        // $is_franchise = '0';
        $insert       = "insert into proforma_Order_ent(user_id,date,amount,status,pmode,pdfpath,cmplt_status,transaction_stats,transaction_id,cartids_inorder,shipping_charges,pan_details,gst_details,discount,Notes,is_franchise,ship_to,created_by) values('" . $userid . "','" . $date . "','" . $amount . "','1','" . $ordertype . "','','','" . $order_status . "','" . $txnid . "','" . $json_cart . "','" . $shoppingcharge . "','" . $pannumber . "','" . $gstnumber . "','" . $discount . "','" . $Notes . "','".$is_franchise."','".$ship_to."','" . $_SESSION['SESS_USER_NAME']. "')";
        mysqli_query($con1, $insert) or die(mysqli_error($con1));
        $order = mysqli_insert_id($con1);

        $new_statement = "insert into proforma_new_order(oid, name,email,phone,address,city,state,country,zip,status,created_at,bill_address,bill_city,bill_state,bill_zip) values('" . $order . "','" . $billing_name . "','" . $billing_email . "','" . $billing_tel . "','" . $shipping_addres . "','" . $shipping_city . "','" . $shipping_state . "','" . $billing_country . "','" . $shipping_zip . "','1','" . $date . "','" . $billing_address . "','" . $billing_city . "','" . $billing_state . "','" . $billing_zip . "')";
        $proforma_new_order     = mysqli_query($con1, $new_statement) or die(mysqli_error($con1));

        $procount = count($_POST['pid']);

        $_orderdate = date('Y-m-d');

        for ($i = 0; $i < $procount; $i++) {
            $qty          = $_POST['productqty'][$i];
            $product_amt  = $_POST['productprice'][$i];
            $product_name = $_POST['productId'][$i];
            $pid          = $_POST['pid'][$i];
            $vendor       = $_POST['vendor'][$i];
            $cat_id       = $_POST['category_id'][$i];
            $prodid       = $_POST['prod_id'][$i];
            $prodis       = $_POST['pro_dis'][$i];
            $prodisamt       = $_POST['pro_disamt'][$i];

            $item_id      = $pid . "/" . $cat_id . "/" . $prodid;

            if (isset($_POST['outside_product'][$i])) {
                $outside_product = $_POST['outside_product'][$i];
            } else {
                $outside_product = 0;
            }

            if (isset($_POST['pro_img'][$i])) {
                if($_POST['pro_img'][$i]!='')
                {
                 $product_image = $_POST['pro_img'][$i];               
                }
                else
                {
                  $product_image = Getimg($pid, $cat_id, $prodid);
                }

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

            
             $resdata=json_encode($resdata);
            $product_name =mysqli_real_escape_string($con1, $product_name);

            $insert_proforma_order_details = "insert into proforma_order_details(oid,item_id,rate,qty,rejected_qty,status,total_amt,mrc_id,cat_id,track_id,track_Status,color,size,product_name,image,date,HSN,gst,cart_res,outside_product,mrp,discount,dis_amount) values ('" . $order . "','" . $item_id . "','" . $product_amt . "','" . $qty . "','','1','" . $product_amt * $qty . "','" . $vendor . "','" . $cat_id . "','','','" . $color . "','" . $size . "','" . $product_name . "','" . $product_image . "','" . $date . "','" . $HSN . "','" . $gst . "','" . $resdata . "','" . $outside_product . "','" . $mrp . "','".$prodis."','".$prodisamt."')";
            mysqli_query($con1, $insert_proforma_order_details);


        }

        $ch = curl_init();
        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_URL, "/invoice/proinvoice.php?order_id=" . $order);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        // grab URL and pass it to the browser
        curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        // close cURL resource, and free up system resources
        curl_close($ch);
         

        ?>

<script>
    alert("Order Added Successfully !");
    setTimeout(function(){
        window.location.href='/adminpanel/viewproforma.php?orderid=<?=$order?>';
    }, 1500);
</script>

<?php
} else {
        ?>

<script>
       swal("Duplicate Entry !","","error");

    setTimeout(function(){
        window.location.href='/adminpanel/AddOrderByAdmin.php';
    }, 3000);
</script>
<?php
}
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

            $pro_img = '/ecom/' . get_kit_info($cust_pid, 'photo');

        } else {

            $pro_img = '/ecom/' . $frtu[0];

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