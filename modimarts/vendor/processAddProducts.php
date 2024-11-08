<?php session_start();
include('config.php');
//var_dump($_POST);
?>
<html>
    <head>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>-->
        
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
<body>
<?php
$errors=0;
$errormsg_arr=array();
$yrwdir=date("Y")."/".date("m");
// mysqli_begin_transaction($con1);
$dir="userfiles/".$_SESSION['id']."/img/".$yrwdir."/";
$dirthunbs="userfiles/".$_SESSION['id']."/thumbs/".$yrwdir."/";
$dirtmidsize="userfiles/".$_SESSION['id']."/midsize/".$yrwdir."/";
$dirtLrgsize="userfiles/".$_SESSION['id']."/largeSize/".$yrwdir."/";
if (!is_dir("../".$dir)) 
{
    if(!mkdir("../".$dir,0777, true))
    {
        $error = error_get_last();
        $rr="Make dir error".$error['message'];
        $errormsg_arr[]=$rr;
        $errors++;
    }
}

if (!is_dir("../".$dirthunbs)) 
{
    if(!mkdir("../".$dirthunbs,0777, true))
    {
        $error = error_get_last();
        $rr="Make dir error".$error['message'];
        $errormsg_arr[]=$rr;
        $errors++;
    }
}

if (!is_dir("../".$dirtmidsize)) 
{
    if(!mkdir("../".$dirtmidsize,0777, true))
    {
        $error = error_get_last();
        $rr="Make dir error".$error['message'];
        $errormsg_arr[]=$rr;
        $errors++;
    }
}

if (!is_dir("../".$dirtLrgsize)) 
{
    if(!mkdir("../".$dirtLrgsize,0777, true))
    {
        $error = error_get_last();
        $rr="Make dir error".$error['message'];
        $errormsg_arr[]=$rr;
        $errors++;
    }
}
$ccode=$_SESSION['id'];
$pcode=$_POST['pcode'];
/* Ruchi */
$p_other=mysqli_real_escape_string($_POST['editor1']);
/*$pcat=$_POST['pcat'];hdCategory*/
$pcat=$_POST['hdCategory'];
//echo 'category :'.$pcat;
$email = $_POST['email'];
//echo $_POST['Maincat'];
/* Ruchi */
/*if($_POST['pbrand']=='otherbrand'){
    $brand=$_POST['new_brand']; 
    $brand_qry=mysqli_query($con1,"INSERT INTO `brand`(`brand`, `category_id`) VALUES ('$brand','$pcat')");
    $pbrand=mysqli_insert_id($con1);
} else 
{
   $pbrand=$_POST['pbrand']; 
}
if($_POST['pname']=='otherproduct'){
    $prname=mysqli_real_escape_string($_POST['new_product']);
    //$brand_qry=mysqli_query($con1,"INSERT INTO `product_model`(`product_model`, `brand_id`) VALUES ('$prname','$pbrand')");
    $qry_pmodel=mysqli_query($con1,"INSERT INTO `product_model`(`product_model`, `description`, `price`, `others`,discount,discount_type,brand_id,long_desc,) VALUES ('$pname','$p_other','$price','$others','$discntamt','$dicnttyp','$pbrand','$Longdesc')");
    $pname=mysqli_insert_id($con1);
} else {
    $pname=mysqli_real_escape_string($_POST['pname']);
}*/
//=========When we Create New Category then this code will be execute================
$newMainCat="";
$newSubCat="";
$newSubCatUnder="";
$CreateNewCategory="";
$newSubCat1="";
if($_POST['Maincat']=="AddNewCategory"){
    $newMainCat=$_POST['newMainCat'];
    $newSubCat1=$_POST['newSubCat'];
     $newSubCatUnder=$_POST['newSubCatUnder'];
    $CreateNewCategory=$_POST['CreateNewCategory'];

if($newSubCatUnder=="none"){
    $newSubCat=$newSubCat1;
}else{
    $newSubCat=$newSubCatUnder;
}
}
//===================================================================================
$hidden_sizeid=$_POST['hidden_sizeid'];

$spfc=$_POST['specification'];
$spfc1=$_POST['specification1'];

$target1=$_POST['oldimg'];
$target2=$_POST['oldaudio'];

$target3=$_POST['oldvid'];

$price=$_POST['price'];
$Longdesc=$_POST['editor'];

$allmart_commission = $_POST['allmart_commission'];
//echo "rammm".$Longdesc;
$others=mysqli_real_escape_string($con1,$_POST['others']); 
//$quentity=$_POST['quentity'];
$discntamt=$_POST['discnt']; 

$hidden_color=$_POST['hidden_color']; 
$hidden_size=$_POST['hidden_size']; 

if(isset($_POST['new_product'])){
    $prname=$_POST['new_product'];
    //echo "Model-".$prname;
}

if(isset($_POST['discount']))
{
$dicnttyp=$_POST['discount']; // Displaying Selected Value
//echo $dicnttyp;
} 
//Ruchi : Additional info
$new =false;
if(isset($_POST['new_price']))
{
    $new = true;
    $new_price=$_POST['new_price']; // Displaying Selected Value
} 
if(isset($_POST['new_Long_desc']))
{
    $new = true;
    $new_Long_desc=$_POST['new_Long_desc']; // Displaying Selected Value
} 
if(isset($_POST['new_others']))
{
    $new = true;
    $new_others=$_POST['new_others']; // Displaying Selected Value
} 
if(isset($_POST['new_description']))
{
    $new = true;
    $new_description=$_POST['new_description']; // Displaying Selected Value
} 
if(isset($_POST['new_discount']))
{
    $new = true;
    $new_discount=$_POST['new_discount']; // Displaying Selected Value
} 




if($discntamt!="" && $discntamt>0)
{
    if($dicnttyp=='P')
    {
    $ab=($discntamt/100)*$price;
    $ttlprs=$price-$ab;
    }
    else{
    // $ttlprs=$price-$discntamt;
    
    $ttlprs=$discntamt;
    
    
    //$discntamt=($discntamt / $price) * 100;
    }
} else {$ttlprs=$price;}




/* Ruchi */
if($_POST['pbrand']=='otherbrand'){
    $brand=$_POST['new_brand']; 
    $brand_qry=mysqli_query($con1,"INSERT INTO `brand`(`brand`, `category_id`) VALUES ('$brand','$pcat')");
    $pbrand=mysqli_insert_id($con1);
} else 
{
   $pbrand=$_POST['pbrand']; 
}
if($_POST['pname']=='otherproduct') {
   // $prname=mysqli_real_escape_string($_POST['new_product']);
    //echo $prname;
    /*$brand_qry=mysqli_query($con1,"INSERT INTO `product_model`(`product_model`, `brand_id`) VALUES ('$prname','$pbrand')");*/
    $qry_pmodel=mysqli_query($con1,"INSERT INTO `product_model`(`product_model`, `description`, `price`, `others`,discount,discount_type,brand_id,category_id,Long_desc,offer_price,allmart_commission) VALUES ('$prname','$p_other','$price','$others','$discntamt','$dicnttyp','$pbrand','$pcat','$Longdesc','$ttlprs','$allmart_commission')");
    //echo "INSERT INTO `product_model`(`product_model`, `description`, `price`, `others`,discount,discount_type,brand_id,Long_desc) VALUES ('$prname','$p_other','$price','$others','$discntamt','$dicnttyp','$pbrand','$Longdesc')";
    $pname=mysqli_insert_id($con1);
    //echo $pname;
    //var_dump($qry_pmodel);
} else {
    $pname=$_POST['pname'];
}
//echo 'pn'. $pname;
if(isset($_POST['Submit']))
$image=$_FILES['image']['name'];
define ("MAX_SIZE","100");
  
function getExtension($str) {
    $i = strrpos($str,".");
    if (!$i) { return ""; }
    $l = strlen($str) - $i;
    $ext = substr($str,$i+1,$l);
    return $ext;
}
    
function resize($filename_original, $filename_resized, $new_w, $new_h){
  //echo $filename_original." ".$filename_resized."<br>";
    $extension = pathinfo($filename_original, PATHINFO_EXTENSION);
    //echo $extension;
    if ( preg_match("/jpg|jpeg/", $extension) ){ $src_img=@imagecreatefromjpeg("../".$filename_original); }
 
    if ( preg_match("/png/", $extension) ) $src_img=@imagecreatefrompng("../".$filename_original);
 
   // echo "<br><br>---".$src_img."---";
    if(!$src_img) return false;
 
    $old_w = imageSX($src_img);
    $old_h = imageSY($src_img);
 
    $x_ratio = $new_w / $old_w;
    $y_ratio = $new_h / $old_h;
 
   /* if ( ($old_w <= $new_w) && ($old_h <= $new_h) ) {
        $thumb_w = $old_w;
        $thumb_h = $old_h;
    }
    elseif ( $y_ratio <= $x_ratio ) {
        $thumb_w = round($old_w * $y_ratio);
        $thumb_h = round($old_h * $y_ratio);
    }
    else {
        $thumb_w = round($old_w * $x_ratio);
        $thumb_h = round($old_h * $x_ratio);
    }  */
    
   if ( $y_ratio <= $x_ratio ) {
        $thumb_w = round($old_w * $y_ratio);
        $thumb_h = round($old_h * $y_ratio);
    } else {
        $thumb_w = round($old_w * $x_ratio);
        $thumb_h = round($old_h * $x_ratio);
    }
 
    $dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
    imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_w,$old_h); 
 
    if (preg_match("/png/",$extension)) imagepng($dst_img,$filename_resized); 
    else imagejpeg($dst_img,$filename_resized,100); 
 
    imagedestroy($dst_img); 
    imagedestroy($src_img);
 
    return true;
} 
$image_name3=array();
$image_name4=array();
$image_name5=array();
$image_name6=array();
$image1=$_FILES['image']['name'];
$cntt1=count($image1);
for($a=0;$a<$cntt1;$a++){
    $image=$_FILES['image']['name'][$a];
    
    if ($image) 
    {
        // echo $image;
        //get the original name of the file from the clients machine
        $filename = stripslashes($_FILES['image']['name'][$a]);
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
            $size=filesize($_FILES['image']['tmp_name'][$a]);

            //compare the size with the maxim size we defined and print error if bigger
            if ($size > MAX_SIZE*4024000)
            {
              echo '<h1>You have exceeded the size limit!</h1>';
              $errors=1;
            }
$time=time();

$image_name=$time.$a.'.'.$extension;

$dirs="userfiles/".$_SESSION['id']."/img/".$image_name;

$imgpath=$dir.$image_name;
$image_name3[]=$imgpath;

$copied = copy($_FILES['image']['tmp_name'][$a], "../".$imgpath);

if (!$copied) 
{
  echo '<h1>Copy unsuccessfull!</h1>'."</br>";
  $errors=1;
}

    $image_name4[]=$dirthunbs.$image_name;
    if(!resize($imgpath,"../".$dirthunbs.$image_name, 200, 200))
    {
        $error = error_get_last();
        $rr="Resize thumbs error".$error['message'];
        
        $errormsg_arr[]=$rr;
        $errors++;
    }
    $image_name5[]=$dirtmidsize.$image_name;
    
    if(!resize($imgpath,"../".$dirtmidsize.$image_name, 500, 500))
    {
        $error = error_get_last();
        $rr="Resize midsize error".$error['message'];
        
        $errormsg_arr[]=$rr;
        $errors++;
    }
    $image_name6[]=$dirtLrgsize.$image_name;
    
    if(!resize($imgpath,"../".$dirtLrgsize.$image_name, 1000, 1000))
    {
        $error = error_get_last();
        $rr="Resize midsize error".$error['message'];
        
        $errormsg_arr[]=$rr;
        $errors++;
    }
}
}
}
if(isset($_POST['submit']) && $errors==0)  
{  

//===============================================
if($_POST['Maincat']=="AddNewCategory"){
   
    $key=$pbrand." ".$p_type;
    
    $sql = "INSERT INTO `Approval_products`(`name`, `ccode`, `description`, `category`, `photo`, `price`, `others`,discount,discount_type,total_amt,thumbs,midsize,brand,product_type,long_desc,keyword1,offer_price,allmart_commission) VALUES ('$pname','$ccode','$p_other','$pcat','$dirs','$price','$others','$discntamt','$dicnttyp','$ttlprs','','','$pbrand','$p_type','$Longdesc','$key','$ttlprs','$allmart_commission')"; 
    $qry=mysqli_query($con1,"INSERT INTO `Approval_products`(`name`, `ccode`, `description`, `category`, `photo`, `price`, `others`,discount,discount_type,total_amt,thumbs,midsize,brand,product_type,long_desc,keyword1,offer_price,allmart_commission) VALUES ('$pname','$ccode','$p_other','$pcat','$dirs','$price','$others','$discntamt','$dicnttyp','$ttlprs','','','$pbrand','$p_type','$Longdesc','$key','$ttlprs','$allmart_commission')");
    
    $insid=mysqli_insert_id($con1); 
    
    $specification=array();
    
     if (is_array($spfc))
        {
            for($i=0;$i<count($spfc);$i++)
            {  
                $qry1=mysqli_query($con1,"INSERT INTO `Approval_productspecification`(`product_id`, `product_specification`,`specificationname`,category) VALUES('".$insid."','".$_POST['specification1'][$i]."','".$_POST['specification'][$i]."','".$pcat."')");
                
            }
         }
    for($a=0;$a<count($image_name3);$a++)
    {
        $sql2="INSERT INTO `Approval_product_img`(`product_id`, `img`,thumbs,midsize,category,largeSize) values('".$insid."','".$image_name3[$a]."','".$image_name4[$a]."','".$image_name5[$a]."','".$pcat."','".$image_name6[$a]."')";
        
        $result2 = mysqli_query($con1,$sql2);
        
        if(!$result2)
        {
            $errormsg_arr[]=mysqli_error($con1);
            $errors++;
        }
    }
    $Newcategory=  mysqli_query($con1,"insert into approval_category (name,under,cat_img,base_cat,Product_id,uploaded_by) values('".$CreateNewCategory."','".$newSubCat."','','".$newMainCat."','$insid','$email')");  
    
}  else {
    $qrya="select * from main_cat where id='".$pcat."'  and status=1";
    $resulta=mysqli_query($con1,$qrya);
    $rowa = mysqli_fetch_row($resulta);
    $aa=$rowa[2];
    
    if($aa!=0){
        $qrya1="select * from main_cat where id='".$aa."' and status=1";
        $resulta1=mysqli_query($con1,$qrya1);
        $rowa1 = mysqli_fetch_row($resulta1);
        $Maincate= $rowa1[4];
        $p_type=mysqli_real_escape_string($rowa1[1]);
        
    }
    
    echo $Maincate;
    
    if($Maincate==1){
        $key=$pbrand." ".$p_type;
        
        $sql = "INSERT INTO `fashion`(`name`, `ccode`, `category`, `photo`,`price`,total_amt,thumbs,midsize,size,color,brand,size_id,product_type,keyword1,offer_price,allmart_commission) VALUES ('$pname','$ccode','$pcat','$dirs','$price','$ttlprs','','','$hidden_size','$hidden_color','$pbrand','$hidden_sizeid','$p_type','$key','$ttlprs','$allmart_commission')";
        
        $qry=mysqli_query($con1,"INSERT INTO `fashion`(`name`, `ccode`, `category`, `photo`,`price`,total_amt,thumbs,midsize,size,color,brand,size_id,product_type,keyword1,offer_price,allmart_commission) VALUES ('$pname','$ccode','$pcat','$dirs','$price','$ttlprs','','','$hidden_size','$hidden_color','$pbrand','$hidden_sizeid','$p_type','$key','$ttlprs','$allmart_commission')");
        
        $insid=mysqli_insert_id($con1); 
        $new_discount = 0;
    
    if($new){
        $qry=mysqli_query($con1,"INSERT INTO `product_additional_details`(`price`,`long_desc`, `others`,`description`, `discount`, `product_id`,main_category) VALUES ('$new_price','$new_Long_desc','$new_others','$new_description','$new_discount','$insid','$Maincate')");
    }
    
    $specification=array();
    if (is_array($spfc))
    {
        for($i=0;$i<count($spfc);$i++)
        {  
            $qry1=mysqli_query($con1,"INSERT INTO `fashionSpecification`(`product_id`, `product_specification`,`specificationname`,category) VALUES('".$insid."','".$_POST['specification1'][$i]."','".$_POST['specification'][$i]."','".$pcat."')");
        }
    }
                         
    for($a=0;$a<count($image_name3);$a++)
    {
    $sql2="INSERT INTO `fashion_img`(`product_id`, `img`,thumbs,midsize,category,largeSize) values('".$insid."','".$image_name3[$a]."','".$image_name4[$a]."','".$image_name5[$a]."','".$pcat."','".$image_name6[$a]."')";
    
    $result2 = mysqli_query($con1,$sql2);
    
        if(!$result2)
    {
          $errormsg_arr[]=mysqli_error($con1);
        
        $errors++;
    }
        
    }
        
    }
    else if($Maincate==190){
        
        $key=$pbrand." ".$p_type;
        
        $sql = "INSERT INTO `electronics`(`name`, `ccode`, `category`, `photo`, `price`,total_amt,thumbs,midsize,size,color,brand,size_id,product_type,keyword1,offer_price,allmart_commission) VALUES ('$pname','$ccode','$pcat','$dirs','$price','$ttlprs','','','$hidden_size','$hidden_color','$pbrand','$hidden_sizeid','$p_type','$key','$ttlprs','$allmart_commission')";
        
        $qry=mysqli_query($con1,"INSERT INTO `electronics`(`name`, `ccode`, `category`, `photo`, `price`,total_amt,thumbs,midsize,size,color,brand,size_id,product_type,keyword1,offer_price,allmart_commission) VALUES ('$pname','$ccode','$pcat','$dirs','$price','$ttlprs','','','$hidden_size','$hidden_color','$pbrand','$hidden_sizeid','$p_type','$key','$ttlprs','$allmart_commission')");
       
        $insid=mysqli_insert_id($con1); 
      
        // echo "INSERT INTO `electronics`(`name`, `ccode`, `category`, `photo`, `price`,total_amt,thumbs,midsize,size,color,brand,size_id,product_type,keyword1,offer_price,allmart_commission) VALUES ('$pname','$ccode','$pcat','$dirs','$price','$ttlprs','','','$hidden_size','$hidden_color','$pbrand','$hidden_sizeid','$p_type','$key','$ttlprs','$allmart_commission')";
      
        if($new){
            $qry=mysqli_query($con1,"INSERT INTO `product_additional_details`(`price`,`long_desc`, `others`,`description`, `discount`, `product_id`,main_category) VALUES ('$new_price','$new_Long_desc','$new_others','$new_description','$new_discount','$insid','$Maincate')");
        }
        
        $specification=array();
        if (is_array($spfc))
        {
            for($i=0;$i<count($spfc);$i++)
            {  
                $qry1=mysqli_query($con1,"INSERT INTO `electronicsSpecification`(`product_id`, `product_specification`,`specificationname`,category) VALUES('".$insid."','".$_POST['specification1'][$i]."','".$_POST['specification'][$i]."','".$pcat."')");
            }
        } 
        for($a=0;$a<count($image_name3);$a++)
        {
            $sql2="INSERT INTO `electronics_img`(`product_id`, `img`,thumbs,midsize,category,largeSize) values('".$insid."','".$image_name3[$a]."','".$image_name4[$a]."','".$image_name5[$a]."','".$pcat."','".$image_name6[$a]."' )";
    
            $result2 = mysqli_query($con1,$sql2);
            if(!$result2)
            {
                $errormsg_arr[]=mysqli_error($con1);
                $errors++;
            }
        }
    }
    else if($Maincate==218){
        
        $key=$pbrand." ".$p_type;
        
        $sql = "INSERT INTO `grocery`(`name`, `ccode`, `category`, `photo`, `price`,total_amt,thumbs,midsize,size,color,brand,size_id,product_type,keyword1,offer_price,allmart_commission) VALUES ('$pname','$ccode','$pcat','$dirs','$price','$ttlprs','','','$hidden_size','$hidden_color','$pbrand','$hidden_sizeid','$p_type','$key','$ttlprs','$allmart_commission')";
        $qry=mysqli_query($con1,"INSERT INTO `grocery`(`name`, `ccode`, `category`, `photo`, `price`,total_amt,thumbs,midsize,size,color,brand,size_id,product_type,keyword1,offer_price,allmart_commission) VALUES ('$pname','$ccode','$pcat','$dirs','$price','$ttlprs','','','$hidden_size','$hidden_color','$pbrand','$hidden_sizeid','$p_type','$key','$ttlprs','$allmart_commission')");
    
        $insid=mysqli_insert_id($con1);
        
        if($new){
            $qry=mysqli_query($con1,"INSERT INTO `product_additional_details`(`price`,`long_desc`, `others`,`description`, `discount`, `product_id`,main_category) VALUES ('$new_price','$new_Long_desc','$new_others','$new_description','$new_discount','$insid','$Maincate')");
        }
        
        $specification=array();
        
        if (is_array($spfc))
        {
            for($i=0;$i<count($spfc);$i++)
            {  
                $qry1=mysqli_query($con1,"INSERT INTO `grocerySpecification`(`product_id`, `product_specification`,`specificationname`,category) VALUES('".$insid."','".$_POST['specification1'][$i]."','".$_POST['specification'][$i]."','".$pcat."')");
            }
        }
        
        for($a=0;$a<count($image_name3);$a++)
        {
            $sql2="INSERT INTO `grocery_img`(`product_id`, `img`,thumbs,midsize,category,largeSize) values('".$insid."','".$image_name3[$a]."','".$image_name4[$a]."','".$image_name5[$a]."','".$pcat."','".$image_name6[$a]."')";
            $result2 = mysqli_query($con1,$sql2);
            if(!$result2)
            {
                $errormsg_arr[]=mysqli_error($con1);
                $errors++;
            }
        }
    }
    
    else if($Maincate==482){
        $key=$pbrand." ".$p_type;
        $qry=mysqli_query($con1,"INSERT INTO `Resale`(`name`, `ccode`, `description`, `category`, `photo`, `price`, `others`,discount,discount_type,total_amt,thumbs,midsize,size,color,brand,product_type,long_desc,keyword1,offer_price,allmart_commission) VALUES ('$pname','$ccode','$p_other','$pcat','$dirs','$price','$others','$discntamt','$dicnttyp','$ttlprs','','','$hidden_size','$hidden_color','$pbrand','$p_type','$Longdesc','$key','$ttlprs','$allmart_commission')");
    
        $insid=mysqli_insert_id($con1); 
        $qry=mysqli_query($con1,"INSERT INTO `product_additional_details`(`price`,`long_desc`, `others`,`description`, `discount`, `product_id`,main_category) VALUES ('$new_price','$new_Long_desc','$new_others','$new_description','$new_discount','$insid','$Maincate')");
        
        $specification=array();
        if (is_array($spfc))
        {
            for($i=0;$i<count($spfc);$i++)
            {  
                $qry1=mysqli_query($con1,"INSERT INTO `ResaleSpecification`(`product_id`, `product_specification`,`specificationname`,category) VALUES('".$insid."','".$_POST['specification1'][$i]."','".$_POST['specification'][$i]."','".$pcat."')");
            }
         }
        for($a=0;$a<count($image_name3);$a++)
        {
            $sql2="INSERT INTO `Resale_img`(`product_id`, `img`,thumbs,midsize,category,largeSize) values('".$insid."','".$image_name3[$a]."','".$image_name4[$a]."','".$image_name5[$a]."','".$pcat."','".$image_name6[$a]."')";
            
            $result2 = mysqli_query($con1,$sql2);

            if(!$result2)
            {
                $errormsg_arr[]=mysqli_error($con1);
                $errors++;
            }
        }
    }
    else{
        $key = $pbrand." ".$p_type;
        $sql = "INSERT INTO `products`(`name`, `ccode`, `category`, `photo`, `price`,total_amt,thumbs,midsize,size,color,brand,size_id,product_type,keyword1,offer_price,allmart_commission) VALUES ('$pname','$ccode','$pcat','$dirs','$price','$ttlprs','','','$hidden_size','$hidden_color','$pbrand','$hidden_sizeid','$p_type','$key','$ttlprs','$allmart_commission')";
        
        $qry=mysqli_query($con1,"INSERT INTO `products`(`name`, `ccode`, `category`, `photo`, `price`,total_amt,thumbs,midsize,size,color,brand,size_id,product_type,keyword1,offer_price,allmart_commission) VALUES ('$pname','$ccode','$pcat','$dirs','$price','$ttlprs','','','$hidden_size','$hidden_color','$pbrand','$hidden_sizeid','$p_type','$key','$ttlprs','$allmart_commission')");
        $insid=mysqli_insert_id($con1); 
        if($new){
            $qry=mysqli_query($con1,"INSERT INTO `product_additional_details`(`price`,`long_desc`, `others`,`description`, `discount`, `product_id`,main_category) VALUES ('$new_price','$new_Long_desc','$new_others','$new_description','$new_discount','$insid','$Maincate')");
        }
                        
        $specification=array();
         
        if (is_array($spfc))
        {
            for($i=0;$i<count($spfc);$i++)
            {  $qry1=mysqli_query($con1,"INSERT INTO `productspecification`(`product_id`, `product_specification`,`specificationname`,category) VALUES('".$insid."','".$_POST['specification1'][$i]."','".$_POST['specification'][$i]."','".$_POST['pcat']."')");
            }
       
        }
        for($a=0;$a<count($image_name3);$a++)
        {
        
            $sql2="INSERT INTO `product_img`(`product_id`, `img`,thumbs,midsize,category,largeSize) values('".$insid."','".$image_name3[$a]."','".$image_name4[$a]."','".$image_name5[$a]."','".$pcat."','".$image_name6[$a]."')";
            $result2 = mysqli_query($con1,$sql2);
            if(!$result2)
            {
                $errormsg_arr[]=mysqli_error($con1);
                $errors++;
            }
        }
    }
}
echo $sql;   //exit;           
if(!$qry)
{
    $errormsg_arr[]=mysqli_error($con1);
   
    $errors++;
}

if($errors=="0")
{ 
    //   mysqli_commit($con1);
?>
<script>
    alert("Product added successfully");
    //swal('Congratulations!', 'Product added successfully!', 'success');
    swal({
        title: 'Congratulations!',
        text: 'Product added successfully!',
        type: 'success',
        closeOnConfirm: false,
        }, function(){
         
        swal({
          title: "Confirm",
          text: "Are you sure you want to Add More Product?",
          type: "warning",
          
          confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Confirm!",
          showCancelButton: true,
          cancelButtonText: "Cancel",
          closeOnConfirm: false,
          closeOnCancel: false
        },
    function(isConfirm) {
      if (isConfirm) {
       window.location="add_product.php";
      } else {
       window.location="welcome.php";  
      }
    });
}); 
 
</script> 
  <?php }   

else
{    
    mysqli_rollback($con1);
     
    for($a=0;$a<count($image_name3);$a++)
    {
      if (file_exists("../".$image_name3[$a])) 
      {
      unlink("../".$image_name3[$a]);
      }
      if (file_exists("../".$image_name4[$a])) 
      {
    
      unlink("../".$image_name4[$a]);
      }
      if (file_exists("../".$image_name5[$a])) 
      {
    
      unlink("../".$image_name5[$a]);
       }
        if (file_exists("../".$image_name6[$a])) 
        {
            unlink("../".$image_name6[$a]);
        }
    }
    print_r($errormsg_arr);
    echo "Error Occured, Please go back and try again";
}                           
 }
?>
</body>
</html>