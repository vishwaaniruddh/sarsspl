<?php
 session_start();
// include('../config.php');

include '../ecommerce_config.php';
ini_set('display_errors', 'On');
error_reporting(E_ALL);


function commission($txn_id,$commision,$mem,$date,$promotion){

    global $con;
    global $con1;
    $date=date('Y-m-d');

        $distribut_amount = $commision;

        $member_sql = mysqli_query($con,"select * from new_member where id='".$mem."' and status=1");
        $member_sql_result = mysqli_fetch_assoc($member_sql);

        $pos_name = $member_sql_result['star'];
        $member_level = $member_sql_result['level_id'];

        $village = $member_sql_result['village'];
        $pincode = $member_sql_result['pincode'];
        $taluka = $member_sql_result['taluka'];
        $district = $member_sql_result['district'];
        $division = $member_sql_result['division'];
        $state = $member_sql_result['state'];
        $zone = $member_sql_result['zone'];
        $country = $member_sql_result['country'];


        if($village > 0 ){
            $vil_sql = mysqli_query($con,"select * from new_member where village='".$village."' and status=1");
            $vil_sql_result = mysqli_fetch_assoc($vil_sql);
            $vil_mem = $vil_sql_result['id'];

            if($vil_mem){
                $vil_amount = round($distribut_amount /2 ,5);
                $actual_amount = $vil_amount;

                // echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','village".$vil_mem."','".$vil_amount."','1','".$promotion."','".$date."')";
                // echo '<br>';
                  mysqli_query($con1,"insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$vil_mem."','".$vil_amount."','1','".$promotion."','".$date."')");
            }
            else{
                $actual_amount = $distribut_amount;
            }

        }
        else{
                $vil_amount = $distribut_amount;
                $actual_amount = $distribut_amount;
                $vil_mem = 0;
        }



        if($pincode > 0){

        $pin_sql = mysqli_query($con,"select * from new_member where pincode='".$pincode."' and village=0 and status=1");
        $pin_sql_result = mysqli_fetch_assoc($pin_sql);
        $pin_mem = $pin_sql_result['id'];

            if($pin_mem){

               $pin_amount =  round($vil_amount /2 ,5) ;
              $actual_amount = $pin_amount;
                // echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','pincode".$pin_mem."','".$pin_amount."','1','".$promotion."','".$date."')";
                // echo '<br>';
                  mysqli_query($con1,"insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$pin_mem."','".$pin_amount."','1','".$promotion."','".$date."')");
            }
            else{
                 $pin_amount =  $actual_amount ;
            }

        }
        else{
        $pin_amount = $distribut_amount ;
            // $pin_amount =  round($actual_amount /2 ,5) ;
            $actual_amount = $distribut_amount;
            $pin_mem = 0;
        }



        // return;
        if($taluka > 0){
            $tal_sql = mysqli_query($con,"select * from new_member where taluka='".$taluka."' and pincode=0 and status=1");
            $tal_sql_result = mysqli_fetch_assoc($tal_sql);
            $tal_mem = $tal_sql_result['id'];

            if($tal_mem){
                $tal_amount = round($pin_amount /2,5) ;
                $actual_amount = $tal_amount;

                // echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','taluka".$tal_mem."','".$tal_amount."','1','".$promotion."','".$date."')";
                // echo '<br>';
                  mysqli_query($con1,"insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$tal_mem."','".$tal_amount."','1','".$promotion."','".$date."')");
            }
            else{
                $tal_amount = $actual_amount  ;
            }


        }
        else{
            $tal_amount=$distribut_amount;
            $actual_amount = $distribut_amount;
            $tal_mem = 0;
        }

        if($district > 0){
        $dis_sql = mysqli_query($con,"select * from new_member where district='".$district."' and taluka=0 and status=1");
        $dis_sql_result = mysqli_fetch_assoc($dis_sql);
        $dis_mem = $dis_sql_result['id'];

            if($dis_mem){
                $dis_amount = round($tal_amount /2,5) ;
                $actual_amount = $dis_amount;
                // echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$dis_mem."','".$dis_amount."','1','".$promotion."','".$date."')";
                // echo '<br>';
                  mysqli_query($con1,"insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$dis_mem."','".$dis_amount."','1','".$promotion."','".$date."')");

            }
            else{
                    $dis_amount = $actual_amount ;
            }

        }
        else{
            $dis_amount=$distribut_amount;
            $actual_amount = $distribut_amount;
            $dis_mem = 0;
        }



        if($division > 0){
        $div_sql = mysqli_query($con,"select * from new_member where division='".$division."' and district=0 and status=1");
        $div_sql_result = mysqli_fetch_assoc($div_sql);
        $div_mem = $div_sql_result['id'];

            if( $div_mem){
                $div_amount = round($dis_amount /2,5) ;
                $actual_amount = $div_amount;

                // echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$div_mem."','".$div_amount."','1','".$promotion."','".$date."')";
                // echo '<br>';

                  mysqli_query($con1,"insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$div_mem."','".$div_amount."','1','".$promotion."','".$date."')");

            }
            else{
                $div_amount = $actual_amount ;
            }



        }
        else{
                $div_amount = $distribut_amount ;
                $actual_amount = $distribut_amount;
                $div_mem = 0 ;
        }





        if($state > 0 ){

            // echo '$div_amount'.$div_amount;

        $state_sql = mysqli_query($con,"select * from new_member where state='".$state."' and division=0 and status=1");
        $state_sql_result = mysqli_fetch_assoc($state_sql);
        $state_mem = $state_sql_result['id'];

            if($state_mem){
                $state_amount = round($div_amount /2,5) ;
                $actual_amount = $state_amount;

                // echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$state_mem."','".$state_amount."','1','".$promotion."','".$date."')";
                // echo '<br>';
                  mysqli_query($con1,"insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$state_mem."','".$state_amount."','1','".$promotion."','".$date."')");
            }
            else{
                $state_amount = $actual_amount  ;
            }


        }
        else{
                $state_amount = $distribut_amount ;
                $actual_amount = $distribut_amount;
                $state_mem = 0 ;
        }




        if($zone > 0){
            $zone_sql = mysqli_query($con,"select * from new_member where zone='".$zone."' and state=0 and status=1");
            $zone_sql_result = mysqli_fetch_assoc($zone_sql);
            $zone_mem = $zone_sql_result['id'];

            if($zone_mem){
                    $zone_amount = round($state_amount /2,5) ;
                    $actual_amount = $zone_amount;
                    // echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$zone_mem."','".$zone_amount."','1','".$promotion."','".$date."')";
                    // echo '<br>';
                      mysqli_query($con1,"insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$zone_mem."','".$zone_amount."','1','".$promotion."','".$date."')");
            }
            else{
                 $zone_amount = $actual_amount ;
            }


        }
        else{
            $zone_amount = $distribut_amount ;
            $actual_amount = $distribut_amount;
            $zone_mem = 0;
        }




        if($country > 0){
            $country_sql = mysqli_query($con,"select * from new_member where country='".$country."' and zone=0 and status=1");
            $country_sql_result = mysqli_fetch_assoc($country_sql);
            $country_mem = $country_sql_result['id'];

            if($country_mem){
                $country_amount = round($zone_amount/2,5);
                $sar_amount = round($zone_amount/2,5);
                // echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$country_mem."','".$country_amount."','1','".$promotion."','".$date."')";
                // echo '<br>';
                  mysqli_query($con1,"insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','".$country_mem."','".$country_amount."','1','".$promotion."','".$date."')");
            }
            else{
                $country_amount = $actual_amount;
                $sar_amount = $actual_amount;
            }

        }


// Sar Commission

// echo "insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','SAR','".$sar_amount."','1','".$promotion."','".$date."')";

  mysqli_query($con1,"insert into commission_details(txn_id,commission_to,amount,status,promotion,created_at) values('".$txn_id."','SAR','".$sar_amount."','1','".$promotion."','".$date."')");
}



if(isset($_SESSION["username"]))
{

    // echo"hello";
    $usrid=$_SESSION["userid"];
    $franchise_id=$_POST['franchise_id'];
    $prodid=$_POST['prodid'];
   // echo '<pre>';print_r($_POST['product_ids']);echo '</pre>';die;
    $total_amount=0;

    for ($i=0; $i < count($_POST['amount']); $i++) {
         $total_amount+=trim($_POST['amount'][$i])*trim($_POST['proquntity'][$i]);
    }



    if($total_amount<=5000){

        $time=time();
        $yrwdir=date("Y")."/".date("m");
        $dir="Product_recipts/files/".$franchise_id."/img/".$yrwdir."/";
        $dirv="Product_recipts/files/".$franchise_id."/video/".$yrwdir."/";

        if (!is_dir($dir))
            {
                if(!mkdir($dir,0777, true))
                {
                    $error = error_get_last();
                    $rr="Make dir error".$error['message'];
                    $errormsg_arr[]=$rr;
                    $errors++;
                }
            }

        if (!is_dir($dirv))
            {
                if(!mkdir($dirv,0777, true))
                {
                    $error = error_get_last();
                    $rr="Make dir error".$error['message'];
                    $errormsg_arr[]=$rr;
                    $errors++;
                }
            }

            // Upload Img AND Videos

            $video=$_FILES['send_video']['name'];
            if($video!=''){

            $videofilename = stripslashes($video);
            //get the extension of the file in a lower case format
            $videoextension = getExtension($videofilename);
            $videoextension = strtolower($videoextension);

            if (($videoextension != "mp4") && ($videoextension != "jpeg") && ($videoextension != "wma") && ($videoextension != "jpg"))
    {
        //print error message
        echo '<h1>Unknown extension!</h1>';
        $errors=1;
    }
    else
    {


        $video_name=$time.'.'.$videoextension;

        $videopath=$dirv.$video_name;

        $vcopied = copy($_FILES['send_video']['tmp_name'],$videopath);

        if (!$vcopied)
        {
        echo '<h1>Copy unsuccessfull!</h1>'."</br>";
        $errors=1;
        }

    }
}

$image_name3 = array();
$image1 = $_FILES['send_imgs']['name'];
$cntt1 = count($image1);
for($a = 0;$a<$cntt1;$a++){
$image=$_FILES['send_imgs']['name'][$a];

if ($_FILES['send_imgs']!='')
{
    // echo $image;
    //get the original name of the file from the clients machine
    $filename = stripslashes($_FILES['send_imgs']['name'][$a]);
    //get the extension of the file in a lower case format
    $extension = getExtension($filename);
    $extension = strtolower($extension);
    //if it is not a known extension, we will suppose it is an error and will not  upload the file,
    //otherwise we will do more tests
    if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png"))
    {
        //print error message
        echo '<h1>Unknown extension!</h1>';
        $errors=1;
    }
    else
    {
        //get the size of the image in bytes
        //$_FILES['image']['tmp_name'] is the temporary filename of the file
        //in which the uploaded file was stored on the server
        $size=filesize($_FILES['send_imgs']['tmp_name'][$a]);

        //compare the size with the maxim size we defined and print error if bigger
        // if ($size > MAX_SIZE*4024000)
        // {
        //   echo '<h1>You have exceeded the size limit!</h1>';
        //   $errors=1;
        // }


        $image_name=$time.$a.'.'.$extension;

        $imgpath=$dir.$image_name;
        $image_name3[]=$imgpath;

        $copied = copy($_FILES['send_imgs']['tmp_name'][$a],$imgpath);

        if (!$copied)
        {
        echo '<h1>Copy unsuccessfull!</h1>'."</br>";
        $errors=1;
        }
        }
        }
        }

if(!isset($image_name3))
{
    $image_name3='1';
}
if(!isset($videopath))
{
    $videopath='1';
}


    $_productidarray = $_POST['product_ids'];


        // $videopath= implode(', ',$videopath);
        $image_name3= implode(', ',$image_name3);
        $product_ids= implode(', ', $_POST['product_ids']);
        $amount= implode(', ', $_POST['amount']);
        $quantities= implode(', ', $_POST['proquntity']);

        $sql="INSERT INTO `franchise_received_products`( `franchise_id`, `product_ids`,`quantities`,`amounts`,`packaging_images`,`video_url`,`created_by`,`total_amount`) VALUES ('$franchise_id','$product_ids','$quantities','$amount','$image_name3','$videopath','$usrid','$total_amount')";
        $runsql=mysqli_query($con_web,$sql) or  die(mysqli_error($con_web));
        $IsSuccess = 1;
        $last_id = mysqli_insert_id($con_web);

        if($runsql)
        {

              $upd="UPDATE `new_member` SET is_product_received='1' WHERE id='".$usrid."' ";
              $runsql=mysqli_query($con1,$upd) or  die(mysqli_error($con1));
              $ch = curl_init();
              // set URL and other appropriate options
              curl_setopt($ch, CURLOPT_URL, "https://modimart.world/franchise6/Product_recipts/send_recipt.php?id=".$last_id);
              curl_setopt($ch, CURLOPT_HEADER, 0);
              // grab URL and pass it to the browser
              curl_exec($ch);
              // close cURL resource, and free up system resources
              curl_close($ch);

                $_orderdate = date('Y-m-d');
                $_productidarray = $_POST['product_ids'];
                $_productqtyarray = $_POST['proquntity'];
                foreach($_productidarray as $key=>$_product){
                    $_prod_qty = $_productqtyarray[$key];
                    $_product_id = explode('/',$_product);
                    $promotion = $_product_id[0];

                    $sql1 = mysqli_query($con1,"select allmart_commission from products where code='".$_product_id[0]."' and category='".$_product_id[1]."' and name='".$_product_id[2]."' order by code desc");
                    $sql_result1 = mysqli_fetch_assoc($sql1);
                    $allmart_commission = 0;
                    if(!empty($sql_result1)){
                      $allmart_commission = $sql_result1['allmart_commission'];
                    }
                    $allmart_commission = $allmart_commission * $_prod_qty;
                   $sql1               = mysqli_query($con1, "SELECT max(RIGHT(txn_id,LENGTH(txn_id)-4)) As code from commission_details");
                    $sql_result1        = mysqli_fetch_assoc($sql1);

                    $txnid  = $sql_result1['code'];
                    $txnid = preg_replace('/[^0-9]/', '', $txnid);
                    $txnid = $txnid+1 ;
                    $txn_id = 'txn-'.$txnid;

                    commission($txn_id,$allmart_commission,$franchise_id,$_orderdate,$promotion);
                }

              ?>
        <script>
              alert('Success');
              // update member purchase product
              window.location.href = 'Selected_product.php?id=<?=$prodid?>';
              </script>
          <?php
        }
        else
        {
            unlink($videopath);

            for($a=0;$a<count($image_name3);$a++)
            {
                if (file_exists($image_name3[$a]))
                {
                    unlink($image_name3[$a]);
                }
            }
            ?>
        <script>
         alert("error");
         window.location.href = 'members.php';
        </script>
        <?php
         }
    }
    else
    {
        ?>
        <script>
        alert('Total Amount Is greater Then 5000');
         window.location.href = 'members.php';
        </script>
        <?php
    }

}
else
{
    ?>
        <script>
alert("Session Expried Please Login");
window.open("members.php","_self");

</script>
        <?php

}


function getExtension($str) {
    $i = strrpos($str,".");
    if (!$i) { return ""; }
    $l = strlen($str) - $i;
    $ext = substr($str,$i+1,$l);
    return $ext;
}




?>