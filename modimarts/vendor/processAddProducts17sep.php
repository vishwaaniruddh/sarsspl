<?php session_start();
include('config.php');
//var_dump($_POST);exit;
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
mysql_query("BEGIN");
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
 $pbrand=$_POST['pbrand'];
$pname=mysql_real_escape_string($_POST['pname']);
$p_other=mysql_real_escape_string($_POST['editor1']);
$pcat=$_POST['pcat'];
$email = $_POST['email'];
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
//echo "rammm".$Longdesc;
$others=mysqli_real_escape_string($con3,$_POST['others']); 
//$quentity=$_POST['quentity'];
$discntamt=$_POST['discnt']; 

$hidden_color=$_POST['hidden_color']; 
$hidden_size=$_POST['hidden_size']; 

if(isset($_POST['discount']))
{
$dicnttyp=$_POST['discount']; // Displaying Selected Value
//echo $dicnttyp;
 } 
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
    }
    else {
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
    //echo "hi".$image;
 	//if it is not empty
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
//we will give an unique name, for example the time in unix time format
$image_name=$time.$a.'.'.$extension;
//echo "TIME IS  :".time();
//the new name will be containing the full path where will be stored (images folder)
$dirs="userfiles/".$_SESSION['id']."/img/".$image_name;
//echo "gupta".$dirs;
$imgpath=$dir.$image_name;
//echo "hiiii".$imgpath;
//$imgpath11="userfiles/".$image_name;
//echo "hii".$imgpath11;
$image_name3[]=$imgpath;
//we verify if the image has been uploaded, and print error instead
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
    //echo $rr;
    $errormsg_arr[]=$rr;
    $errors++;
    }


$image_name5[]=$dirtmidsize.$image_name;
//	if(!resize($imgpath,"../".$dirtmidsize.$image_name, 220, 230))
	if(!resize($imgpath,"../".$dirtmidsize.$image_name, 500, 500))
	{
	     $error = error_get_last();
    $rr="Resize midsize error".$error['message'];
    //echo $rr;
    $errormsg_arr[]=$rr;
    $errors++;
	}

    $image_name6[]=$dirtLrgsize.$image_name;
    //	if(!resize($imgpath,"../".$dirtmidsize.$image_name, 220, 230))
	if(!resize($imgpath,"../".$dirtLrgsize.$image_name, 1000, 1000))
	{
	     $error = error_get_last();
         
          
    $rr="Resize midsize error".$error['message'];
    //echo $rr;
    $errormsg_arr[]=$rr;
    $errors++;
	}
}
}
}
if(isset($_POST['submit']) && $errors==0)  
  {   

if($discntamt!="" && $discntamt>0)
{
if($dicnttyp=='P')
{
$ab=($discntamt/100)*$price;
$ttlprs=$price-$ab;
}
else{
$ttlprs=$price-$discntamt;
/*
echo "ttlprs".$ttlprs;
echo "price".$price;
echo "discntamt".$discntamt;
*/

//$discntamt=($discntamt / $price) * 100;
}
}else{$ttlprs=$price;}

// this code for New category added in ApprovalCategory table 

  //$lastNewCatID= mysql_insert_id($Newcategory);
  //echo $lastNewCatID;

/*  Ruchi : 
if($_POST['Maincat']=="AddNewCategory"){
    //echo 'new cat1';
    $key=$pbrand." ".$p_type;
    //echo 'b: '.$pbrand."type: ".$p_type.'<br>';
    $qry=mysql_query("INSERT INTO `Approval_products`(`name`, `ccode`, `description`, `category`, `photo`, `price`, `others`,discount,discount_type,total_amt,thumbs,midsize,brand,product_type,long_desc,keyword1) VALUES ('$pname','$ccode','$p_other','$pcat','$dirs','$price','$others','$discntamt','$dicnttyp','$ttlprs','','','$pbrand','$p_type','$Longdesc','$key')");
    //echo "INSERT INTO `Approval_products`(`name`, `ccode`, `description`, `category`, `photo`, `price`, `others`,discount,discount_type,total_amt,thumbs,midsize,brand,product_type,long_desc,keyword1) VALUES ('$pname','$ccode','$p_other','$pcat','$dirs','$price','$others','$discntamt','$dicnttyp','$ttlprs','','','$pbrand','$p_type','$Longdesc','$key')";  
                 $insid=mysql_insert_id(); 
                 //var_dump($qry);
                 $specification=array();
                 //var_dump($spfc);exit;
 
                 if (is_array($spfc))
                    {
                        for($i=0;$i<count($spfc);$i++)
                        {  
                            $qry1=mysql_query("INSERT INTO `Approval_productspecification`(`product_id`, `product_specification`,`specificationname`,category) VALUES('".$insid."','".$_POST['specification1'][$i]."','".$_POST['specification'][$i]."','".$pcat."')");
                            //var_dump($qry1);
                        }
                     }
                      for($a=0;$a<count($image_name3);$a++)
{
$sql2="INSERT INTO `Approval_product_img`(`product_id`, `img`,thumbs,midsize,category,largeSize) values('".$insid."','".$image_name3[$a]."','".$image_name4[$a]."','".$image_name5[$a]."','".$pcat."','".$image_name6[$a]."')";
//echo  $sql2;
$result2 = mysql_query($sql2);
//var_dump($sql2);
    if(!$result2)
{
      $errormsg_arr[]=mysql_error();
    
    $errors++;
}
}
  $Newcategory=  mysql_query("insert into approval_category (name,under,cat_img,base_cat,Product_id) values('".$CreateNewCategory."','".$newSubCat."','','".$newMainCat."','$insid')");  
 //var_dump($Newcategory);exit;
 // $lastNewCatID= mysql_insert_id($Newcategory);
}*/
//===============================================
if($_POST['Maincat']=="AddNewCategory"){
   echo 'categ : '.$pcat;
    $key=$pbrand." ".$p_type;
    
    /*$Newcategory=  mysql_query("insert into approval_category (name,under,cat_img,base_cat,Product_id) values('".$CreateNewCategory."','".$newSubCat."','','".$newMainCat."','$insid')");  
    //var_dump($Newcategory);exit;
     $lastNewCatID= mysql_insert_id();
     echo 'last categ ins id : '.$lastNewCatID;*/
      
    $qry=mysql_query("INSERT INTO `Approval_products`(`name`, `ccode`, `description`, `category`, `photo`, `price`, `others`,discount,discount_type,total_amt,thumbs,midsize,brand,product_type,long_desc,keyword1) VALUES ('$pname','$ccode','$p_other','$pcat','$dirs','$price','$others','$discntamt','$dicnttyp','$ttlprs','','','$pbrand','$p_type','$Longdesc','$key')");
    //echo "INSERT INTO `Approval_products`(`name`, `ccode`, `description`, `category`, `photo`, `price`, `others`,discount,discount_type,total_amt,thumbs,midsize,brand,product_type,long_desc,keyword1) VALUES ('$pname','$ccode','$p_other','$pcat','$dirs','$price','$others','$discntamt','$dicnttyp','$ttlprs','','','$pbrand','$p_type','$Longdesc','$key')";  
    $insid=mysql_insert_id(); 
    var_dump($qry); echo 'prod_id : '.$insid;
    $specification=array();
    //var_dump($spfc);exit;
     if (is_array($spfc))
        {
            for($i=0;$i<count($spfc);$i++)
            {  
                $qry1=mysql_query("INSERT INTO `Approval_productspecification`(`product_id`, `product_specification`,`specificationname`,category) VALUES('".$insid."','".$_POST['specification1'][$i]."','".$_POST['specification'][$i]."','".$pcat."')");
                //var_dump($qry1);
            }
         }
    for($a=0;$a<count($image_name3);$a++)
    {
        $sql2="INSERT INTO `Approval_product_img`(`product_id`, `img`,thumbs,midsize,category,largeSize) values('".$insid."','".$image_name3[$a]."','".$image_name4[$a]."','".$image_name5[$a]."','".$pcat."','".$image_name6[$a]."')";
        //echo  $sql2;
        $result2 = mysql_query($sql2);
        //var_dump($sql2);
        if(!$result2)
        {
            $errormsg_arr[]=mysql_error();
            $errors++;
        }
    }
     $Newcategory=  mysql_query("insert into approval_category (name,under,cat_img,base_cat,Product_id,uploaded_by) values('".$CreateNewCategory."','".$newSubCat."','','".$newMainCat."','$insid','$email')");  
      //var_dump($Newcategory);exit;
      // $lastNewCatID= mysql_insert_id($Newcategory);
    
}
    else {
    $qrya="select * from main_cat where id='".$pcat."'";
    $resulta=mysql_query($qrya);
    $rowa = mysql_fetch_row($resulta);
    $aa=$rowa[2];
    //echo  "gup".$aa;
       
    if($aa!=0){
        
         $qrya1="select * from main_cat where id='".$aa."'";
     $resulta1=mysql_query($qrya1);
     $rowa1 = mysql_fetch_row($resulta1);
        $Maincate= $rowa1[4];
        $p_type=mysql_real_escape_string($rowa1[1]);
      // $p_type=$rowa1[1];
       
    } 
    
    if($Maincate==1){
        
         $key=$pbrand." ".$p_type;
        $qry=mysql_query("INSERT INTO `fashion`(`name`, `ccode`, `description`, `category`, `photo`, `price`, `others`,discount,discount_type,total_amt,thumbs,midsize,size,color,brand,size_id,product_type,long_desc,keyword1) VALUES ('$pname','$ccode','$p_other','$pcat','$dirs','$price','$others','$discntamt','$dicnttyp','$ttlprs','','','$hidden_size','$hidden_color','$pbrand','$hidden_sizeid','$p_type','$Longdesc','$key')");
    //echo "INSERT INTO `fashion`(`name`, `ccode`, `description`, `category`, `photo`, `price`, `others`,discount,discount_type,total_amt,thumbs,midsize,size,color,brand,size_id,product_type,long_desc) VALUES ('$pname','$ccode','$pdesc','$pcat','$dirs','$price','$others','$discntamt','$dicnttyp','$ttlprs','','','$hidden_size','$hidden_color','$pbrand','$hidden_sizeid','$p_type','$Longdesc')";
        
             $insid=mysql_insert_id(); 
             $specification=array();
     
     
                     if (is_array($spfc))
                        {
                            for($i=0;$i<count($spfc);$i++)
                            {  $qry1=mysql_query("INSERT INTO `fashionSpecification`(`product_id`, `product_specification`,`specificationname`,category) VALUES('".$insid."','".$_POST['specification1'][$i]."','".$_POST['specification'][$i]."','".$pcat."')");
                            }
                       
                         }
                         
                         
                          for($a=0;$a<count($image_name3);$a++)
    {
    $sql2="INSERT INTO `fashion_img`(`product_id`, `img`,thumbs,midsize,category,largeSize) values('".$insid."','".$image_name3[$a]."','".$image_name4[$a]."','".$image_name5[$a]."','".$pcat."','".$image_name6[$a]."')";
    
    $result2 = mysql_query($sql2);
    
        if(!$result2)
    {
          $errormsg_arr[]=mysql_error();
        
        $errors++;
    }
        
    }
        
    }
    else if($Maincate==190){
        $key=$pbrand." ".$p_type;
        $qry=mysql_query("INSERT INTO `electronics`(`name`, `ccode`, `description`, `category`, `photo`, `price`, `others`,discount,discount_type,total_amt,thumbs,midsize,size,color,brand,product_type,long_desc,keyword1) VALUES ('$pname','$ccode','$p_other','$pcat','$dirs','$price','$others','$discntamt','$dicnttyp','$ttlprs','','','$hidden_size','$hidden_color','$pbrand','$p_type','$Longdesc','$key')");
        //echo "INSERT INTO `electronics`(`name`, `ccode`, `description`, `category`, `photo`, `price`, `others`,discount,discount_type,total_amt,thumbs,midsize,size,color,brand,product_type) VALUES ('$pname','$ccode','$pdesc','$pcat','$dirs','$price','$others','$discntamt','$dicnttyp','$ttlprs','','','$hidden_size','$hidden_color','$pbrand','$p_type')";
        
                              $insid=mysql_insert_id(); 
                              $specification=array();
     
                     if (is_array($spfc))
                        {
                            for($i=0;$i<count($spfc);$i++)
                            {  
                                $qry1=mysql_query("INSERT INTO `electronicsSpecification`(`product_id`, `product_specification`,`specificationname`,category) VALUES('".$insid."','".$_POST['specification1'][$i]."','".$_POST['specification'][$i]."','".$pcat."')");
                            }
                         }    
        
    for($a=0;$a<count($image_name3);$a++)
    {
    $sql2="INSERT INTO `electronics_img`(`product_id`, `img`,thumbs,midsize,category,largeSize) values('".$insid."','".$image_name3[$a]."','".$image_name4[$a]."','".$image_name5[$a]."','".$pcat."','".$image_name6[$a]."' )";
    
    $result2 = mysql_query($sql2);
    if(!$result2)
    {
        $errormsg_arr[]=mysql_error();
        $errors++;
    }
    }
    }
    else if($Maincate==218){
       
          $key=$pbrand." ".$p_type;
        $qry=mysql_query("INSERT INTO `grocery`(`name`, `ccode`, `description`, `category`, `photo`, `price`, `others`,discount,discount_type,total_amt,thumbs,midsize,size,color,brand,product_type,long_desc,keyword1) VALUES ('$pname','$ccode','$p_other','$pcat','$dirs','$price','$others','$discntamt','$dicnttyp','$ttlprs','','','$hidden_size','$hidden_color','$pbrand','$p_type','$Longdesc','$key')");
        
                      $insid=mysql_insert_id(); 
                      $specification=array();
     
     
                     if (is_array($spfc))
                        {
                            for($i=0;$i<count($spfc);$i++)
                            {  $qry1=mysql_query("INSERT INTO `grocerySpecification`(`product_id`, `product_specification`,`specificationname`,category) VALUES('".$insid."','".$_POST['specification1'][$i]."','".$_POST['specification'][$i]."','".$pcat."')");
                            }
                       
                         }    
        
        
    for($a=0;$a<count($image_name3);$a++)
    {
        $sql2="INSERT INTO `grocery_img`(`product_id`, `img`,thumbs,midsize,category,largeSize) values('".$insid."','".$image_name3[$a]."','".$image_name4[$a]."','".$image_name5[$a]."','".$pcat."','".$image_name6[$a]."')";
        $result2 = mysql_query($sql2);
        if(!$result2)
        {
            $errormsg_arr[]=mysql_error();
            $errors++;
        }
    }
    }
    
    else if($Maincate==482){
          $key=$pbrand." ".$p_type;
        $qry=mysql_query("INSERT INTO `Resale`(`name`, `ccode`, `description`, `category`, `photo`, `price`, `others`,discount,discount_type,total_amt,thumbs,midsize,size,color,brand,product_type,long_desc,keyword1) VALUES ('$pname','$ccode','$p_other','$pcat','$dirs','$price','$others','$discntamt','$dicnttyp','$ttlprs','','','$hidden_size','$hidden_color','$pbrand','$p_type','$Longdesc','$key')");
        
                      $insid=mysql_insert_id(); 
                      $specification=array();
                     if (is_array($spfc))
                        {
                            for($i=0;$i<count($spfc);$i++)
                            {  
                                $qry1=mysql_query("INSERT INTO `ResaleSpecification`(`product_id`, `product_specification`,`specificationname`,category) VALUES('".$insid."','".$_POST['specification1'][$i]."','".$_POST['specification'][$i]."','".$pcat."')");
                            }
                         }
         for($a=0;$a<count($image_name3);$a++)
    {
    $sql2="INSERT INTO `Resale_img`(`product_id`, `img`,thumbs,midsize,category,largeSize) values('".$insid."','".$image_name3[$a]."','".$image_name4[$a]."','".$image_name5[$a]."','".$pcat."','".$image_name6[$a]."')";
    
    $result2 = mysql_query($sql2);
    
        if(!$result2)
    {
          $errormsg_arr[]=mysql_error();
        
        $errors++;
    }
        
    }
        
    }
    
    else{
       
          $key=$pbrand." ".$p_type;
    //$qry=mysql_query("INSERT INTO `products`(`name`, `ccode`, `description`, `category`, `photo`, `price`, `others`,discount,discount_type,total_amt,thumbs,midsize,brand,product_type,long_desc,keyword1) VALUES ('$pname','$ccode','$p_other','$pcat','$dirs','$price','$others','$discntamt','$dicnttyp','$ttlprs','','','$pbrand','$p_type','$Longdesc','$key')");
     $qry=mysql_query("INSERT INTO `products` (`name`, `ccode`, `description`, `category`, `photo`, `price`, `others`,discount,discount_type,total_amt,thumbs,midsize,size,color,brand,size_id,product_type,long_desc,keyword1) VALUES ('$pname','$ccode','$p_other','".$_POST['pcat']."','$dirs','$price','$others','$discntamt','$dicnttyp','$ttlprs','','','$hidden_size','$hidden_color','$pbrand','$hidden_sizeid','$p_type','$Longdesc','$key')");          
                     $insid=mysql_insert_id(); 
                     $specification=array();
     
                     if (is_array($spfc))
                        {
                            for($i=0;$i<count($spfc);$i++)
                            {  $qry1=mysql_query("INSERT INTO `productspecification`(`product_id`, `product_specification`,`specificationname`,category) VALUES('".$insid."','".$_POST['specification1'][$i]."','".$_POST['specification'][$i]."','".$_POST['pcat']."')");
                            }
                       
                         }
                          for($a=0;$a<count($image_name3);$a++)
    {
    $sql2="INSERT INTO `product_img`(`product_id`, `img`,thumbs,midsize,category,largeSize) values('".$insid."','".$image_name3[$a]."','".$image_name4[$a]."','".$image_name5[$a]."','".$_POST['pcat']."','".$image_name6[$a]."')";
    
    $result2 = mysql_query($sql2);
        if(!$result2)
        {
            $errormsg_arr[]=mysql_error();
            $errors++;
        }
    }
    }
}

               
if(!$qry)
{
    
      $errormsg_arr[]=mysql_error();
   
    $errors++;
}

//$insid=mysql_insert_id();   

//echo "insert id".$insid;
/*
 $spfc=$_POST['specification'];
  $spfc1=$_POST['specification1'];
 $specification=array();
 if (is_array($spfc))
{
for($i=0;$i<count($spfc);$i++)
{
    
    $qry1=mysql_query("INSERT INTO `productspecification`(`product_id`, `product_specification`,`specificationname`) VALUES('".$insid."','".$_POST['specification1'][$i]."','".$_POST['specification'][$i]."')");
    
   
}
   
}
 for($a=0;$a<count($image_name3);$a++)
{
$sql2="INSERT INTO `product_img`(`product_id`, `img`,thumbs,midsize) values('".$insid."','".$image_name3[$a]."','".$image_name4[$a]."','".$image_name5[$a]."')";

$result2 = mysql_query($sql2);

    if(!$result2)
{
      $errormsg_arr[]=mysql_error();
    
    $errors++;
}
    
}
*/




                               if($errors=="0")

	{ 
	    mysql_query("Commit");
	    ?>
<script>
//alert("Product added successfully");
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
 /* var r = confirm("Are you sure you want to Add More Product");
                if(r == true)
                {
                    window.location="add_product.php";

                }
                else
                {
                     window.location="welcome.php";           
                }
   
*/


  //	window.open('view_products.php',"_self");
</script> 
  <?php	} 	

                  else
                 {    
                      mysql_query("ROLLBACK");
	   
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