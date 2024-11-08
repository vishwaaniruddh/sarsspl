<?php
session_start();
include('config.php');
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



mysqli_query($con1,"BEGIN");


$dir="userfiles/".$_SESSION['gids']."/img/".$yrwdir."/";
$dirthunbs="userfiles/".$_SESSION['gids']."/thumbs/".$yrwdir."/";
$dirtmidsize="userfiles/".$_SESSION['gids']."/midsize/".$yrwdir."/";
$dirtLrgsize="userfiles/".$_SESSION['gids']."/largeSize/".$yrwdir."/";


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

if (!is_dir($dirthunbs)) 
{
    if(!mkdir($dirthunbs,0777, true))
    {
    
    $error = error_get_last();
    $rr="Make dir error".$error['message'];
    $errormsg_arr[]=$rr;
    $errors++;
    
    }
}

if (!is_dir($dirtmidsize)) 
{
    if(!mkdir($dirtmidsize,0777, true))
    {
    
    $error = error_get_last();
    $rr="Make dir error".$error['message'];
    $errormsg_arr[]=$rr;
    $errors++;
    
    }
}

if (!is_dir($dirtLrgsize)) 
{
    if(!mkdir($dirtLrgsize,0777, true))
    {
    
    $error = error_get_last();
    $rr="Make dir error".$error['message'];
    $errormsg_arr[]=$rr;
    $errors++;
    
    }
}


$ccode=$_SESSION['gids'];
$pname=mysqli_real_escape_string($_POST['productName']);
$price=$_POST['price'];
 $pbrand=$_POST['brand'];
 $Category=$_POST['Category'];
$spfc=$_POST['specification'];
$spfc1=$_POST['specification1'];
$categorytype=$_POST['categorytype'];

$Longdesc=$_POST['editor'];

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
    if ( preg_match("/jpg|jpeg/", $extension) ){ $src_img=@imagecreatefromjpeg($filename_original); }
 
    if ( preg_match("/png/", $extension) ) $src_img=@imagecreatefrompng($filename_original);
 
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
 	{// echo $image;
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
$dirs="userfiles/".$_SESSION['gids']."/img/".$image_name;
//echo "gupta".$dirs;
$imgpath=$dir.$image_name;
//echo "hiiii".$imgpath;
//$imgpath11="userfiles/".$image_name;
//echo "hii".$imgpath11;
$image_name3[]=$imgpath;
//we verify if the image has been uploaded, and print error instead
$copied = copy($_FILES['image']['tmp_name'][$a], $imgpath);

if (!$copied) 
{
	echo '<h1>Copy unsuccessfull!</h1>'."</br>";
	$errors=1;


}

$image_name4[]=$dirthunbs.$image_name;
    if(!resize($imgpath,$dirthunbs.$image_name, 200, 200))
    {
        
         $error = error_get_last();
         
          
    $rr="Resize thumbs error".$error['message'];
    //echo $rr;
    $errormsg_arr[]=$rr;
    $errors++;
    }


$image_name5[]=$dirtmidsize.$image_name;
//	if(!resize($imgpath,"../".$dirtmidsize.$image_name, 220, 230))
	if(!resize($imgpath,$dirtmidsize.$image_name, 500, 500))
	{
	     $error = error_get_last();
         
          
    $rr="Resize midsize error".$error['message'];
    //echo $rr;
    $errormsg_arr[]=$rr;
    $errors++;
	    
	}

$image_name6[]=$dirtLrgsize.$image_name;
//	if(!resize($imgpath,"../".$dirtmidsize.$image_name, 220, 230))
	if(!resize($imgpath,$dirtLrgsize.$image_name, 1000, 1000))
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






     $key=$pbrand." ".$categorytype;
    $qry=mysqli_query($con1,"INSERT INTO `Resale`(`name`, `ccode`, `description`, `category` ,`photo`, `price`,brand,product_type,keyword1) VALUES ('$pname','$ccode','$Longdesc','$Category','$dirs','$price','$pbrand','$categorytype','$key')");
//echo "INSERT INTO `fashion`(`name`, `ccode`, `description`, `category`, `photo`, `price`, `others`,discount,discount_type,total_amt,thumbs,midsize,size,color,brand,size_id,product_type,long_desc) VALUES ('$pname','$ccode','$pdesc','$pcat','$dirs','$price','$others','$discntamt','$dicnttyp','$ttlprs','','','$hidden_size','$hidden_color','$pbrand','$hidden_sizeid','$p_type','$Longdesc')";
    
         $insid=$con1->insert_id; 
         $specification=array();
 
 
                 if (is_array($spfc))
                    {
                        for($i=0;$i<count($spfc);$i++)
                        {  $qry1=mysqli_query($con1,"INSERT INTO `ResaleSpecification`(`product_id`, `product_specification`,`specificationname`) VALUES('".$insid."','".$_POST['specification1'][$i]."','".$_POST['specification'][$i]."')");
                        }
                   
                     }
                     
                     
                      for($a=0;$a<count($image_name3);$a++)
{
$sql2="INSERT INTO `Resale_img`(`product_id`, `img`,thumbs,midsize,category,largeSize) values('".$insid."','".$image_name3[$a]."','".$image_name4[$a]."','".$image_name5[$a]."','".$Category."','".$image_name6[$a]."')";

$result2 = mysqli_query($con1,$sql2);

    if(!$result2)
{
      $errormsg_arr[]=mysqli_error($con1);
    
    $errors++;
}
    
}
    

                     




               
if(!$qry)
{
    
      $errormsg_arr[]=mysqli_error($con1);
   
    $errors++;
}






                               if($errors=="0")

	{ 
	    mysqli_query($con1,"Commit");
	    ?>
	  
	        
	      
	 
<script>
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
    window.location="resale_AddProduct.php";
  } else {
       window.location="resale_index.php";  
  }
});


 
 
});  
 
  
 
</script> 
  <?php	} 	

                  else

                 {    
                      mysqli_query($con1,"ROLLBACK");
	   
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

 
?>
   


</body>
</html>