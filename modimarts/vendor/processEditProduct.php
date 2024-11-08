<?php
session_start();
include 'config.php';
include 'add_product_video.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<html>
    <head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
<body>

<?php
$errors      = 0;
$yrwdir      = date("Y") . "/" . date("m");
$videodir    = "userfiles/" . $_SESSION['id'] . "/video/" . $yrwdir . "/";
$dir         = "userfiles/" . $_SESSION['id'] . "/img/" . $yrwdir . "/";
$dirthunbs   = "userfiles/" . $_SESSION['id'] . "/thumbs/" . $yrwdir . "/";
$dirtmidsize = "userfiles/" . $_SESSION['id'] . "/midsize/" . $yrwdir . "/";

if (!is_dir("../ecom/" . $videodir)) {
    if (!mkdir("../ecom/" . $videodir, 0777, true)) {

        $error          = error_get_last();
        $rr             = "Make dir error" . $error['message'];
        $errormsg_arr[] = $rr;
        $errors++;

    }
}

if (!is_dir("../ecom/" . $dir)) {
    if (!mkdir("../ecom/" . $dir, 0777, true)) {

        $error          = error_get_last();
        $rr             = "Make dir error" . $error['message'];
        $errormsg_arr[] = $rr;
        $errors++;

    }
}

if (!is_dir("../ecom/" . $dirthunbs)) {
    if (!mkdir("../ecom/" . $dirthunbs, 0777, true)) {

        $error          = error_get_last();
        $rr             = "Make dir error" . $error['message'];
        $errormsg_arr[] = $rr;
        $errors++;

    }
}

if (!is_dir("../ecom/" . $dirtmidsize)) {
    if (!mkdir("../ecom/" . $dirtmidsize, 0777, true)) {

        $error          = error_get_last();
        $rr             = "Make dir error" . $error['message'];
        $errormsg_arr[] = $rr;
        $errors++;

    }
}

$ccode      = $_SESSION['id'];
$LongDesc   = $_POST['editor'];
// var_dump($LongDesc);die();
$pcode      = $_POST['pcode'];
$prcat      = $_POST['prcat'];
$pbrand     = $_POST['pbrand'];
$p_brand_id = $_POST['p_brand_id'];

// $pname=mysqli_real_escape_string($con1,$_POST['pname']);
$pname          = $_POST['pname'];
$pro_modal_id   = $_POST['pro_modal_id'];
$related_grp_id = $_POST['reletedpro'];

//
//$pdesc=mysqli_real_escape_string($con1,$_POST['editor1']);
$p_Other = mysqli_real_escape_string($con1, $_POST['editor1']);
//echo  "ram".$p_Other."ram";
//echo  "gup".$_POST['editor1']."gup";
$pcat = $_POST['pcat'];
$weight = $_POST['weight'];
$type = $_POST['type'];

$hidden_color  = $_POST['hidden_color'];
$hidden_size   = $_POST['hidden_size'];
$hidden_sizeid = $_POST['hidden_sizeid'];

if (isset($_POST['oldimg'])) {$target1 = $_POST['oldimg'];}
if (isset($_POST['oldimgthumbs'])) {$oldimgthumbs = $_POST['oldimgthumbs'];}
if (isset($_POST['oldimgmidsize'])) {$oldimgmidsize = $_POST['oldimgmidsize'];}

if (isset($_POST['oldimgid'])) {$oldimgid = $_POST['oldimgid'];}

if (isset($_POST['oldaudio'])) {$target1au = $_POST['oldaudio'];}

if (isset($_POST['oldvid'])) {$target1vi = $_POST['oldvid'];}

$price = $_POST['price'];
if (isset($_POST['quentity'])) {$quentity = $_POST['quentity'];} else { $quentity = '';}
//$P_desc=mysqli_real_escape_string($con1,$_POST['P_desc']);
$P_desc = mysqli_real_escape_string($con1, $_POST['P_desc']);
$allmart_commission = mysqli_real_escape_string($con1, $_POST['allmart_commission']);

//echo $pcode;
$discntamt = $_POST['discnt'];

$shipping_in_area = $_POST['shipping_in_area'];
$shipping_out_state = $_POST['shipping_out_state'];
$is_provide_shipping = $_POST['is_provide_shipping'];
$is_shipping = $_POST['is_shipping'];
$gst_with = $_POST['gst_with'];


// var_dump($gst_with);die;
if (isset($_POST['discount'])) {
    $dicnttyp = $_POST['discount']; // Displaying Selected Value

}

function getExtension($str)
{
    $i = strrpos($str, ".");
    if (!$i) {return "";}
    $l   = strlen($str) - $i;
    $ext = substr($str, $i + 1, $l);
    return $ext;
}

function resize($filename_original, $filename_resized, $new_w, $new_h)
{
    //echo $filename_original." ".$filename_resized."<br>";
    $extension = pathinfo($filename_original, PATHINFO_EXTENSION);
    //echo $extension;
    if (preg_match("/jpg|jpeg/", $extension)) {$src_img = @imagecreatefromjpeg("../" . $filename_original);}

    if (preg_match("/png/", $extension)) {
        $src_img = @imagecreatefrompng("../" . $filename_original);
    }

    // echo "<br><br>---".$src_img."---";
    if (!$src_img) {
        return false;
    }

    $old_w = imageSX($src_img);
    $old_h = imageSY($src_img);

    $x_ratio = $new_w / $old_w;
    $y_ratio = $new_h / $old_h;

    if (($old_w <= $new_w) && ($old_h <= $new_h)) {
        $thumb_w = $old_w;
        $thumb_h = $old_h;
    } elseif ($y_ratio <= $x_ratio) {
        $thumb_w = round($old_w * $y_ratio);
        $thumb_h = round($old_h * $y_ratio);
    } else {
        $thumb_w = round($old_w * $x_ratio);
        $thumb_h = round($old_h * $x_ratio);
    }

    $dst_img = ImageCreateTrueColor($thumb_w, $thumb_h);
    imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_w, $old_h);

    if (preg_match("/png/", $extension)) {
        imagepng($dst_img, $filename_resized);
    } else {
        imagejpeg($dst_img, $filename_resized, 100);
    }

    imagedestroy($dst_img);
    imagedestroy($src_img);

    return true;
}

$image_name3 = array();
$image_name4 = array();
$image_name5 = array();

$filestodel = array(); //contains old files which were upadted with new images the files in this array will be deleted if all process is successfll

$newfylsgen = array(); //contains new files which will be deleted if process is not successful

$image1 = $_FILES['image']['name'];
$cntt1  = count($image1);

for ($a = 0; $a < $cntt1; $a++) {

    $image = $_FILES['image']['name'][$a];
    //echo  $image;
    //if it is not empty
    if ($image) {
        // echo $image;
        //get the original name of the file from the clients machine
        $filename = stripslashes($_FILES['image']['name'][$a]);
        //get the extension of the file in a lower case format
        $extension = getExtension($filename);
        $extension = strtolower($extension);
        //if it is not a known extension, we will suppose it is an error and will not  upload the file,
        //otherwise we will do more tests
        if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png")) {
            //print error message
            echo '<h1>Unknown extension!</h1>';
            $errors = 1;
        } else {
//get the size of the image in bytes
            //$_FILES['image']['tmp_name'] is the temporary filename of the file
            //in which the uploaded file was stored on the server
            $size = filesize($_FILES['image']['tmp_name'][$a]);

//compare the size with the maxim size we defined and print error if bigger

            $time = time();
//we will give an unique name, for example the time in unix time format
            $image_name = $time . $a . '.' . $extension;
//echo "TIME IS  :".time();
            //the new name will be containing the full path where will be stored (images folder)
            $imgpath = $dir . $image_name;
//echo $imgpath;
            $image_name3[] = $imgpath;

//we verify if the image has been uploaded, and print error instead
            // $copied = move_uploaded_file($_FILES['image']['tmp_name'][$a],"../ecom/".$imgpath);
            $copied = copy($_FILES['image']['tmp_name'][$a], "../ecom/" . $imgpath);

            if (!$copied) {
                echo '<h1>Copy unsuccessfull!</h1>';
                $errors = 1;

            }

//$insrtqry=mysqli_query($con1," INSERT INTO `product_img`( `product_id`, `category`, `img`) VALUES ('".$pcode."','".$prcat."','".$imgpath."')");

$image_name4[]=$dirthunbs.$image_name;

// echo "here";

            if(!resize("ecom/".$imgpath,"../ecom/".$dirthunbs.$image_name, 200, 200))
            {
              echo "error";
              $error = error_get_last();

            $rr="Resize thumbs error".$error['message'];
            // echo $rr;
            $errormsg_arr[]=$rr;
            $errors++;
            }
            //  echo "here";

$image_name5[]=$dirtmidsize.$image_name;

            if(!resize("ecom/".$imgpath,"../ecom/".$dirtmidsize.$image_name, 220, 230))
            {
                 $error = error_get_last();

              $rr="Resize midsize error".$error['message'];
              echo $rr;
              $errormsg_arr[]=$rr;
              $errors++;

            }

  $image_name4[] = $dirthunbs . $image_name;
            if (!resize("/ecom/" . $imgpath, "../ecom/" . $dirthunbs . $image_name, 200, 200)) {
                $error = error_get_last();
                $rr    = "Resize thumbs error" . $error['message'];

    $errormsg_arr[] = $rr;
                $errors++;
            }
            $image_name5[] = $dirtmidsize . $image_name;

if (!resize("/ecom/" . $imgpath, "../ecom/" . $dirtmidsize . $image_name, 500, 500)) {
                $error = error_get_last();
                $rr    = "Resize midsize error" . $error['message'];

    $errormsg_arr[] = $rr;
                $errors++;
            }

        }

        if (isset($target1[$a])) {$filestodel[] = $target1[$a];}
        if (isset($oldimgthumbs[$a])) {$filestodel[] = $oldimgthumbs[$a];}
        if (isset($oldimgmidsize[$a])) {$filestodel[] = $oldimgmidsize[$a];}

        $newfylsgen[] = $dir . $image_name;
        $newfylsgen[] = $dirthunbs . $image_name;
        $newfylsgen[] = $dirtmidsize . $image_name;

    } else {

        $image_name3[] = $target1[$a];
        $image_name4[] = $oldimgthumbs[$a];
        $image_name5[] = $oldimgmidsize[$a];
    }

}

if ($discntamt != "" && $discntamt > 0 || $discntamt == 0) {
    if ($dicnttyp == 'P') {

        $ab = ($discntamt / 100) * $price;
//$ab=($price/100)*$discntamt;

        $ttlprs = $price - $ab;
//echo "a".$price;
        //echo "b".$ab;
        //echo "c".$ttlprs;
    } else {
        $ttlprs = $price - $discntamt;
//$discntamt=($discntamt / $price) * 100;

    }
}

if ($prcat == 1) {
    $qry  = "UPDATE `fashion` SET `name`='$pro_modal_id',`shipping_in_area`='$shipping_in_area',`shipping_out_state`='$shipping_out_state',`is_provide_shipping`='$is_provide_shipping',`is_shipping`='$is_shipping',`description`='$P_desc',`brand`='$p_brand_id',`category`='$pcat',`price`='$price',`quantity`='$quentity',`others`='$p_Other',discount='$discntamt',discount_type='$dicnttyp',total_amt='$ttlprs',color='$hidden_color',size='$hidden_size',size_id='$hidden_sizeid',Long_desc='$LongDesc',allmart_commission='$allmart_commission' WHERE code='$pcode' and ccode='$ccode'";
    $qry1 = "UPDATE `brand` SET `brand`='$pbrand' WHERE id='$p_brand_id'";
    $res1 = mysqli_query($con1, $qry1);
    $qry2 = "UPDATE `product_model` SET `product_model`='$pname',`related_grp_id`='$related_grp_id',Long_desc='$LongDesc',`others`='$p_Other',`description`='$P_desc',`weight`='$weight',`type`='$type',`gst_with`='".$gst_with."' WHERE id='$pro_modal_id'";

    for ($a = 0; $a < count($image_name3); $a++) {
    //echo "ok";
    if ($oldimgid[$a] == "") {

        $insrtqry = mysqli_query($con1, " INSERT INTO `fashion_img`( `product_id`, `img`,thumbs,midsize) VALUES ('" . $pcode . "','" . $image_name3[$a] . "','" . $image_name4[$a] . "','" . $image_name5[$a] . "')");

        if (!$insrtqry) {

            $errormsg_arr[] = mysqli_error($con1);
            $errors++;
        }

    } else if ($oldimgid[$a] != "") {
        $update = mysqli_query($con1, "update fashion_img set img ='" . $image_name3[$a] . "',product_id='" . $pcode . "',thumbs='" . $image_name4[$a] . "',midsize='" . $image_name5[$a] . "' where id='" . $oldimgid[$a] . "'");

        if (!$update) {

            $errormsg_arr[] = mysqli_error($con1);
            $errors++;
        }
    }

} 


} else if ($prcat == 190) {
    $qry = "UPDATE `electronics` SET `name`='$pro_modal_id',`shipping_in_area`='$shipping_in_area',`shipping_out_state`='$shipping_out_state',`is_provide_shipping`='$is_provide_shipping',`is_shipping`='$is_shipping',`description`='$P_desc',`category`='$pcat',`price`='$price',`quantity`='$quentity',`others`='$p_Other',discount='$discntamt',discount_type='$dicnttyp',total_amt='$ttlprs',Long_desc='$LongDesc',allmart_commission='$allmart_commission' WHERE code='$pcode' and ccode='$ccode'"; //echo $qry;
    $qry2 = "UPDATE `product_model` SET `product_model`='$pname' ,`related_grp_id`='$related_grp_id',Long_desc='$LongDesc',`others`='$p_Other',`description`='$P_desc',`weight`='$weight',`type`='$type',`gst_with`='".$gst_with."' WHERE id='$pro_modal_id'";

    for ($a = 0; $a < count($image_name3); $a++) {
    //echo "ok";
    if ($oldimgid[$a] == "") {

        $insrtqry = mysqli_query($con1, " INSERT INTO `electronics_img`( `product_id`, `img`,thumbs,midsize) VALUES ('" . $pcode . "','" . $image_name3[$a] . "','" . $image_name4[$a] . "','" . $image_name5[$a] . "')");

        if (!$insrtqry) {

            $errormsg_arr[] = mysqli_error($con1);
            $errors++;
        }

    } else if ($oldimgid[$a] != "") {
        $update = mysqli_query($con1, "update electronics_img set img ='" . $image_name3[$a] . "',product_id='" . $pcode . "',thumbs='" . $image_name4[$a] . "',midsize='" . $image_name5[$a] . "' where id='" . $oldimgid[$a] . "'");

        if (!$update) {

            $errormsg_arr[] = mysqli_error($con1);
            $errors++;
        }
    }

} 

} else if ($prcat == 218) {
    $qry  = "UPDATE `grocery` SET `name`='$pro_modal_id',`shipping_in_area`='$shipping_in_area',`shipping_out_state`='$shipping_out_state',`is_provide_shipping`='$is_provide_shipping',`is_shipping`='$is_shipping',`description`='$P_desc',`category`='$pcat',`price`='$price',`quantity`='$quentity',`others`='$p_Other',discount='$discntamt',discount_type='$dicnttyp',total_amt='$ttlprs',Long_desc='$LongDesc',allmart_commission='$allmart_commission' WHERE code='$pcode' and ccode='$ccode'";
    $qry2 = "UPDATE `product_model` SET `product_model`='$pname',`related_grp_id`='$related_grp_id',Long_desc='$LongDesc',`others`='$p_Other',`description`='$P_desc',`weight`='$weight',`type`='$type' ,`gst_with`='".$gst_with."' WHERE id='$pro_modal_id'";

    for ($a = 0; $a < count($image_name3); $a++) {
    //echo "ok";
    if ($oldimgid[$a] == "") {

        $insrtqry = mysqli_query($con1, " INSERT INTO `grocery_img`( `product_id`, `img`,thumbs,midsize) VALUES ('" . $pcode . "','" . $image_name3[$a] . "','" . $image_name4[$a] . "','" . $image_name5[$a] . "')");

        if (!$insrtqry) {

            $errormsg_arr[] = mysqli_error($con1);
            $errors++;
        }

    } else if ($oldimgid[$a] != "") {
        $update = mysqli_query($con1, "update grocery_img set img ='" . $image_name3[$a] . "',product_id='" . $pcode . "',thumbs='" . $image_name4[$a] . "',midsize='" . $image_name5[$a] . "' where id='" . $oldimgid[$a] . "'");

        if (!$update) {

            $errormsg_arr[] = mysqli_error($con1);
            $errors++;
        }
    }

}


} else if ($prcat == 482) {
    $qry  = "UPDATE `Resale` SET `name`='$pro_modal_id',`description`='$P_desc',`category`='$pcat',`price`='$price',`quentity`='$quentity',`others`='$p_Other',discount='$discntamt',discount_type='$dicnttyp',total_amt='$ttlprs',Long_desc='$LongDesc',allmart_commission='$allmart_commission' WHERE code='$pcode' and ccode='$ccode'";
    $qry2 = "UPDATE `product_model` SET `product_model`='$pname',`related_grp_id`='$related_grp_id',Long_desc='$LongDesc',`others`='$p_Other',`description`='$P_desc',`weight`='$weight',`type`='$type' ,`gst_with`='".$gst_with."' WHERE id='$pro_modal_id'";

    for ($a = 0; $a < count($image_name3); $a++) {
    //echo "ok";
    if ($oldimgid[$a] == "") {

        $insrtqry = mysqli_query($con1, " INSERT INTO `Resale_img`( `product_id`, `img`,thumbs,midsize) VALUES ('" . $pcode . "','" . $image_name3[$a] . "','" . $image_name4[$a] . "','" . $image_name5[$a] . "')");

        if (!$insrtqry) {

            $errormsg_arr[] = mysqli_error($con1);
            $errors++;
        }

    } else if ($oldimgid[$a] != "") {
        $update = mysqli_query($con1, "update Resale_img set img ='" . $image_name3[$a] . "',product_id='" . $pcode . "',thumbs='" . $image_name4[$a] . "',midsize='" . $image_name5[$a] . "' where id='" . $oldimgid[$a] . "'");

        if (!$update) {

            $errormsg_arr[] = mysqli_error($con1);
            $errors++;
        }
    }

}


} else {
    $qry  = "UPDATE `products` SET `name`='$pro_modal_id',`shipping_in_area`='$shipping_in_area',`shipping_out_state`='$shipping_out_state',`is_provide_shipping`='$is_provide_shipping',`is_shipping`='$is_shipping',`description`='$P_desc',`brand`='$p_brand_id',`category`='$pcat',`price`='$price',`quentity`='$quentity',`others`='$p_Other',discount='$discntamt',discount_type='$dicnttyp',total_amt='$ttlprs',Long_desc='$LongDesc',allmart_commission='$allmart_commission' WHERE code='$pcode' and ccode='$ccode'";
    $qry1 = "UPDATE `brand` SET `brand`='$pbrand' WHERE id='$p_brand_id'";
    $res1 = mysqli_query($con1, $qry1);
    $qry2 = "UPDATE `product_model` SET `product_model`='$pname',`related_grp_id`='$related_grp_id',Long_desc='$LongDesc',`others`='$p_Other',`description`='$P_desc',`weight`='$weight',`type`='$type' ,`gst_with`='".$gst_with."' WHERE id='$pro_modal_id'";

    for ($a = 0; $a < count($image_name3); $a++) {
    //echo "ok";
    if ($oldimgid[$a] == "") {

        $insrtqry = mysqli_query($con1, " INSERT INTO `product_img`( `product_id`, `img`,thumbs,midsize) VALUES ('" . $pcode . "','" . $image_name3[$a] . "','" . $image_name4[$a] . "','" . $image_name5[$a] . "')");

        if (!$insrtqry) {

            $errormsg_arr[] = mysqli_error($con1);
            $errors++;
        }

    } else if ($oldimgid[$a] != "") {
        $update = mysqli_query($con1, "update product_img set img ='" . $image_name3[$a] . "',product_id='" . $pcode . "',thumbs='" . $image_name4[$a] . "',midsize='" . $image_name5[$a] . "' where id='" . $oldimgid[$a] . "'");

        if (!$update) {

            $errormsg_arr[] = mysqli_error($con1);
            $errors++;
        }
    }

}

}

//echo $qry;
$res = mysqli_query($con1, $qry);

$res2 = mysqli_query($con1, $qry2);

// var_dump($res);
// var_dump($res2);

if (!$res) {
    $errormsg_arr[] = mysqli_error($con1);
    $errors++;
}

if (isset($_FILES['video']['name']) && $_FILES['video']['name'] != '') {
    $name = $_FILES['video']['name'];
    $size = $_FILES['video']['size'];
    $tmp  = $_FILES['video']['tmp_name'];
    add_video($name, $size, $tmp, $videodir, $pcode, $con1);
}

// $spfc=$_POST['specification'];
// $spfc1=$_POST['specification1'];
// $vid=$_POST['id'];

//echo $vid;
// ===================code for get category under "0" ==================
/*$qry1="select * from main_cat where id='".$pcat."'";

$resull=mysqli_query($con1,$qry1);
$roww=mysqli_fetch_row($resull);
$nname=$roww[2];

if($nname!=0){

$qryaa="select * from main_cat where id='".$nname."'";
$rss=mysqli_query($con1,$qryaa);
$rrr = mysqli_fetch_row($rss);
$Maincateee= $rrr[4];

}
 */
//=======================================================================

//     if($prcat==1)
//     {
//         for($i=0;$i<count($spfc);$i++)
//                          {

//                              if($vid[$i]!=""){

//                         $qry=mysqli_query($con1,"update  fashionSpecification set product_specification='".$_POST['specification1'][$i]."',specificationname='".$_POST['specification'][$i]."' where id='".$vid[$i]."'");

//                          }
//                         else{

//                             $qrya=mysqli_query($con1,"INSERT INTO `fashionSpecification`(`product_id`, `product_specification`,`specificationname`) VALUES('".$pcode."','".$_POST['specification1'][$i]."','".$_POST['specification'][$i]."')");

//                         }
//                     }

//        for($a=0;$a<count($image_name3);$a++)
//         {
//                     //echo "ok";
//                     if($oldimgid[$a]=="")
//                     {

//                        $insrtqry=mysqli_query($con1," INSERT INTO `fashion_img`( `product_id`, `img`,thumbs,midsize) VALUES ('".$pcode."','".$image_name3[$a]."','".$image_name4[$a]."','".$image_name5[$a]."')");

//                         if(!$insrtqry)
//                {

//     $errormsg_arr[]=mysqli_error($con1);
//     $errors++;
//                }

//                     }else if($oldimgid[$a]!="")
//                     {
//                       $update=mysqli_query($con1,"update fashion_img set img ='".$image_name3[$a]."',product_id='".$pcode."',thumbs='".$image_name4[$a]."',midsize='".$image_name5[$a]."' where id='".$oldimgid[$a]."'");

//                          if(!$update)
//                {

//     $errormsg_arr[]=mysqli_error($con1);
//     $errors++;
//                }
//                     }

//         }

// }

// else if($prcat==190)
// {
//    for($i=0;$i<count($spfc);$i++)
//                          {

//                              if($vid[$i]!=""){

//                         $qry=mysqli_query($con1,"update  electronicsSpecification set product_specification='".$_POST['specification1'][$i]."',specificationname='".$_POST['specification'][$i]."' where id='".$vid[$i]."'");

//                          }
//                         else{

//                             $qrya=mysqli_query($con1,"INSERT INTO `electronicsSpecification`(`product_id`, `product_specification`,`specificationname`) VALUES('".$pcode."','".$_POST['specification1'][$i]."','".$_POST['specification'][$i]."')");

//                         }
//                     }

//        for($a=0;$a<count($image_name3);$a++)
//         {
//                     //echo "ok";
//                     if($oldimgid[$a]=="")
//                     {

//                        $insrtqry=mysqli_query($con1," INSERT INTO `electronics_img`( `product_id`, `img`,thumbs,midsize) VALUES ('".$pcode."','".$image_name3[$a]."','".$image_name4[$a]."','".$image_name5[$a]."')");

//                         if(!$insrtqry)
//                {

//     $errormsg_arr[]=mysqli_error($con1);
//     $errors++;
//                }

//                     }else if($oldimgid[$a]!="")
//                     {
//                       $update=mysqli_query($con1,"update electronics_img set img ='".$image_name3[$a]."',product_id='".$pcode."',thumbs='".$image_name4[$a]."',midsize='".$image_name5[$a]."' where id='".$oldimgid[$a]."'");

//                          if(!$update)
//                {

//     $errormsg_arr[]=mysqli_error($con1);
//     $errors++;
//                }
//                     }

//         }

// }

// else if($prcat==218)
// {
//    for($i=0;$i<count($spfc);$i++)
//                          {

//                              if($vid[$i]!=""){

//                         $qry=mysqli_query($con1,"update  grocerySpecification set product_specification='".$_POST['specification1'][$i]."',specificationname='".$_POST['specification'][$i]."' where id='".$vid[$i]."'");

//                          }
//                         else{

//                             $qrya=mysqli_query($con1,"INSERT INTO `grocerySpecification`(`product_id`, `product_specification`,`specificationname`) VALUES('".$pcode."','".$_POST['specification1'][$i]."','".$_POST['specification'][$i]."')");

//                         }
//                     }

//        for($a=0;$a<count($image_name3);$a++)
//         {
//                     //echo "ok";
//                     if($oldimgid[$a]=="")
//                     {

//                        $insrtqry=mysqli_query($con1," INSERT INTO `grocery_img`( `product_id`, `img`,thumbs,midsize) VALUES ('".$pcode."','".$image_name3[$a]."','".$image_name4[$a]."','".$image_name5[$a]."')");

//                         if(!$insrtqry)
//                {

//     $errormsg_arr[]=mysqli_error($con1);
//     $errors++;
//                }

//                     }else if($oldimgid[$a]!="")
//                     {
//                       $update=mysqli_query($con1,"update grocery_img set img ='".$image_name3[$a]."',product_id='".$pcode."',thumbs='".$image_name4[$a]."',midsize='".$image_name5[$a]."' where id='".$oldimgid[$a]."'");

//                          if(!$update)
//                {

//     $errormsg_arr[]=mysqli_error($con1);
//     $errors++;
//                }
//                     }

//         }

// }

// else
// {

//    for($i=0;$i<count($spfc);$i++)
//                          {

//                              if($vid[$i]!=""){

//                       $qry=mysqli_query($con1,"update productspecification SET product_specification='".$_POST['specification1'][$i]."',specificationname='".$_POST['specification'][$i]."' where id='".$vid[$i]."'");

//                          }
//                         else{

//                           $qrya=mysqli_query($con1,"INSERT INTO `productspecification`(`product_id`, `product_specification`,`specificationname`) VALUES('".$pcode."','".$_POST['specification1'][$i]."','".$_POST['specification'][$i]."')");

//                         }
//                     }

//        for($a=0;$a<count($image_name3);$a++)
//         {
//                     //echo "ok";
//                     if($oldimgid[$a]=="")
//                     {

//                        $insrtqry=mysqli_query($con1," INSERT INTO `product_img`( `product_id`, `img`,thumbs,midsize) VALUES ('".$pcode."','".$image_name3[$a]."','".$image_name4[$a]."','".$image_name5[$a]."')");

//                         if(!$insrtqry)
//                {

//     $errormsg_arr[]=mysqli_error($con1);
//     $errors++;
//                }

//                     }else if($oldimgid[$a]!="")
//                     {
//                $update=mysqli_query($con1,"update product_img set img ='".$image_name3[$a]."',product_id='".$pcode."',thumbs='".$image_name4[$a]."',midsize='".$image_name5[$a]."' where id='".$oldimgid[$a]."'");

//                          if(!$update)
//                {

//     $errormsg_arr[]=mysqli_error($con1);
//     $errors++;
//                }
//                     }

//         }
// }

// $var_name=$_POST['var_name'];
// $var_price=$_POST['var_price'];
// $var_type=$_POST['var_type'];
// $var_val1=$_POST['var_val1'];
// $var_val2=$_POST['var_val2'];
$rowcount = count($_POST['var_name']);
for ($i = 0; $i < $rowcount; $i++) {
    $product_id         = $pcode;
    $product_mrp        = $_POST['var_price'][$i];
    $product_offerprice = $_POST['product_offerprice'][$i];
    $product_discount   = "0";

    // $product_img = $_FILES['var_img']['name'][$i];

    $product_specification = $_POST['var_val1'][$i] . "-" . $_POST['var_val2'][$i];
    $specificationname     = $_POST['var_name'][$i];
    $category              = $pcat;

    $var_img = $_FILES['var_img']['name'][$i];
//echo  $image;
    //if it is not empty
    if ($var_img) {
        // echo $image;
        //get the original name of the file from the clients machine
        $filename = stripslashes($_FILES['var_img']['name'][$i]);
        //get the extension of the file in a lower case format
        $var_imgextension = getExtension($filename);
        $var_imgextension = strtolower($var_imgextension);
        //if it is not a known extension, we will suppose it is an error and will not  upload the file,
        //otherwise we will do more tests
        if (($var_imgextension != "jpg") && ($var_imgextension != "jpeg") && ($var_imgextension != "png")) {
            //print error message
            echo '<h1>Unknown extension!</h1>';
            $errors = 1;
        } else {
//get the size of the image in bytes
            //$_FILES['image']['tmp_name'] is the temporary filename of the file
            //in which the uploaded file was stored on the server
            $size = filesize($_FILES['var_img']['tmp_name'][$i]);

//compare the size with the maxim size we defined and print error if bigger

            $time = time();
//we will give an unique name, for example the time in unix time format
            $var_imgimage_name = $time . '-v' . $i . '.' . $var_imgextension;
//echo "TIME IS  :".time();
            //the new name will be containing the full path where will be stored (images folder)
            $var_imgimgpath = $dir . $var_imgimage_name;
//echo $imgpath;
            $var_imgimage_name3[] = $var_imgimgpath;

//we verify if the image has been uploaded, and print error instead
            // $copied = move_uploaded_file($_FILES['image']['tmp_name'][$a],$imgpath);
            $copied = copy($_FILES['var_img']['tmp_name'][$i], "../ecom/" . $var_imgimgpath);

            if (!$copied) {
                echo '<h1>Copy unsuccessfull!</h1>';
                $errors = 1;

            }

        }

        $product_img = $dir . $var_imgimage_name;

    } else {

        $product_img = $_POST['oldimg'][$i];
    }

    if (isset($_POST['speci_id'][$i])) {

        $qry = mysqli_query($con1, "update productspecification SET product_mrp='" . $product_mrp . "',product_offerprice='" . $product_offerprice . "' , product_discount='" . $product_discount . "',product_img='" . $product_img . "',product_specification='" . $product_specification . "',specificationname='" . $specificationname . "' where id='" . $_POST['speci_id'][$i] . "'");

    } else {

        $qrya = mysqli_query($con1, "INSERT INTO `productspecification`(`product_id`, `product_mrp`, `product_offerprice`, `product_discount`, `product_img`, `product_specification`, `specificationname`, `category`) VALUES('" . $product_id . "','" . $product_mrp . "','" . $product_offerprice . "','" . $product_discount . "','" . $product_img . "','" . $product_specification . "','" . $specificationname . "','" . $category . "')");

    }

}

/*  {
$var=$_POST['id'];
echo $var;

if(is_array($spfc))
{
for($i=0;$i<count($spfc);$i++)
{

$qrya=mysqli_query($con1,"INSERT INTO `productspecification`(`product_id`, `product_specification`,`specificationname`) VALUES('".$pcode."','".$_POST['specification1'][$i]."','".$_POST['specification'][$i]."')");
//   echo "INSERT INTO `productspecification`(`product_id`, `product_specification`,`specificationname`) VALUES('".$pcode."','".$_POST['specification1'][$i]."','".$_POST['specification'][$i]."')";
}
}else
{
if(isset($_POST['id'])==NULL){

for($i=0;$i<count($spfc);$i++)
{

$qry=mysqli_query($con1,"update productspecification SET product_specification='".$_POST['specification1'][$i]."',specificationname='".$_POST['specification'][$i]."' where id='".$vid[$i]."'");
echo "update productspecification SET product_specification='".$_POST['specification1'][$i]."',specificationname='".$_POST['specification'][$i]."' where id='".$vid[$i]."'";

}
}
}

// }
 */



//}

    if ($errors == "0") {
        mysqli_commit($con1);

        for ($a = 0; $a < count($filestodel); $a++) {

            if ($filestodel[$a] != "") {
                if (file_exists("../" . $filestodel[$a])) {
                    unlink("../" . $filestodel[$a]);
                }
            }

        }
        ?>
<script>



swal({
  title: "Update Successfull!",
  text: "done!",
  icon: "success",
  button: "OK",
});

//swal("Update Successfull");
window.open("view_products.php","_self");
</script>
<?php
//header('Location: view_products.php' );
        ?>

  <?php } else {

        mysqli_rollback($con1);

        for ($a = 0; $a < count($newfylsgen); $a++) {

            if ($newfylsgen[$a] != "") {

                if (file_exists("../" . $newfylsgen[$a])) {
                    unlink("../" . $newfylsgen[$a]);
                }
            }

        }

        print_r($errormsg_arr);
        echo "Error Occured, Please go back and try again";

    }
    ?>



</body>
</html>