<?php 
session_start();
include('config.php');
include('adminaccess.php');

// echo "<pre>";print_r($_POST);echo "</pre>";

// error_reporting(E_ALL);
// ini_set('display_errors', '1');


$order_id=$_POST['order_id'];
$username=$_POST['username'];
$orderdate=$_POST['orderdate'];
$orderdate     = date('Y-m-d H:i:s',strtotime($orderdate));
$phone=$_POST['phone'];
$email=$_POST['email'];
$billing_address=$_POST['billing_address'];
$billing_city=$_POST['billing_city'];
$billing_state=$_POST['billing_state'];
$billing_zip=$_POST['billing_zip'];
$gstnumber=$_POST['gstnumber'];
$pannumber=$_POST['pannumber'];
$itemid=$_POST['itemid'];
$discount=$_POST['discount'];
$shipping_charges=$_POST['shipping_charges'];
$g_total=$_POST['g_total'];
$ordertype=$_POST['ordertype'];
$Notes=$_POST['Notes'];
$ship_to=$_POST['ship_to'];
if(isset($_POST['is_franchise'])){  $is_franchise=$_POST['is_franchise']; } else {
	$is_franchise=0;
}

$userid=$_POST['userid'];
$productname=$_POST['productId'];
$prociunt=count($productname);
// echo $prociunt;

// var_dump($is_franchise);die();


if (isset($_POST['updatepro'])) {
	$update=mysqli_query($con1,"UPDATE `proforma_Order_ent` SET `date`='".$orderdate."',`amount`='".$g_total."',`discount`='".$discount."',`pmode`='".$ordertype."',`shipping_charges`='".$shipping_charges."',`gst_details`='".$gstnumber."',`pan_details`='".$pannumber."',`Notes`='".$Notes."',`user_id`='".$userid."',`ship_to`='".$ship_to."',`is_franchise`='".$is_franchise."' WHERE id='".$order_id."'");
	if ($update) {

		$adupdate=mysqli_query($con1,"UPDATE `proforma_new_order` SET `name`='".$username."',`email`='".$email."',`phone`='".$phone."',`address`='".$billing_address."',`city`='".$billing_city."',`state`='".$billing_state."',`zip`='".$billing_zip."' WHERE oid='".$order_id."'");

		for ($i=0; $i < $prociunt; $i++)
		{ 
			$itemid=$_POST['itemid'][$i];
			$productprice=$_POST['productprice'][$i];
			$productqty=$_POST['productqty'][$i];
			$pro_total=$_POST['pro_total'][$i];
			$product_name=$_POST['productId'][$i];

			$pid=$_POST['pid'][$i];
			$cat_id=$_POST['category_id'][$i];
			$prodid=$_POST['prod_id'][$i];
			$vendor=$_POST['vendor'][$i];
			$outside_product=$_POST['outside_product'][$i];

			if (!isset($_POST['outside_product'][$i])) {$prodata = getproductprice($cat_id, $pid);}

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
            } 
            else {

                $mrp = $productprice;
            }

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

			
			$resdata='';


			

			if ($itemid=='') {
				$item_id      = $pid . "/" . $cat_id . "/" . $prodid;

				$insert_proforma_order_details = "insert into proforma_order_details(oid,item_id,rate,qty,discount,rejected_qty,status,total_amt,mrc_id,cat_id,track_id,track_Status,color,size,product_name,image,date,HSN,gst,cart_res,outside_product,mrp) values ('" . $order_id . "','" . $item_id . "','" . $productprice . "','" . $productqty . "','','','1','" . $productprice * $productqty . "','" . $vendor . "','" . $cat_id . "','','','" . $color . "','" . $size . "','" . $product_name . "','" . $product_image . "','" . $orderdate . "','" . $HSN . "','" . $gst . "','" . $resdata . "','" . $outside_product . "','" . $mrp . "')";
            mysqli_query($con1, $insert_proforma_order_details);
            echo "New Entry";
				
			}
			else
			{
			$updatesuccess = mysqli_query($con1,"UPDATE `proforma_order_details` SET `rate`='".$productprice."',`qty`='".$productqty."',`total_amt`='".$pro_total."' WHERE id='".$itemid."'");
			echo "Update";
		    }
			
			
		}
		?>

<script>
    alert("Order Updated  Successfully !");    
    // setTimeout(function(){
        window.location.href='/adminpanel/EditproformaDetails.php?orderid=<?=$order_id?>';        
    // }, 1500);
</script>

<?php

	}
	else
	{
		?>

<script>
    alert("Order Not Updated !");    
    // setTimeout(function(){
        window.location.href='/adminpanel/EditproformaDetails.php?orderid=<?=$order_id?>';        
    // }, 1500);
</script>

<?php
	}
	
}
else
{
	?>

<script>
    alert("Order Not Updated !"); 
        window.location.href='/adminpanel/EditproformaDetails.php?orderid=<?=$order_id?>';        
    // }, 1500);
</script>

<?php
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
