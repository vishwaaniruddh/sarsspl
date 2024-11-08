<?php 
include_once 'connect.php';

function getmerchantcode($cid, $pid)
{
    global $con1;

    $qrya = "select * from main_cat where id='" . $cid . "'";

    $resulta = mysqli_query($con1, $qrya);
    $rowa    = mysqli_fetch_row($resulta);
    $aa = $rowa[2];

    if ($cid == 80) {
        $Maincate = 5;

    } else {
        if ($aa != 0) {
            $qrya1    = "select * from main_cat where id='" . $aa . "'";
            $resulta1 = mysqli_query($con1, $qrya1);
            $rowa1    = mysqli_fetch_row($resulta1);
            $Maincate = $rowa1[4];
        }
        else
        {
        $Maincate=0;    
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

 function getrecentproduct($userid)
 {
 	global $con1;
    $getnewdata=mysqli_query($con1,"SELECT * FROM `cart` WHERE user_id='".$userid."'");
    // $getdata=mysqli_fetch_assoc($getnew);

    $getnew = array();
   foreach ($getnewdata as $key => $value) {
   	$cid=$value['cat_id'];
   	$pid=$value['pid'];
   	$getcccode=getmerchantcode($cid, $pid);
   	array_push($getnew, $getcccode);
   }
   return $getnew;

 }
 ?>