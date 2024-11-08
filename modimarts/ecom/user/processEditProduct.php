<?php
session_start();
include('config.php');
?>
<html>
    <head>
        
 <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>


 
<body>

<?php
$errors=0;
$yrwdir=date("Y")."/".date("m");

$dir="userfiles/".$_SESSION['id']."/img/".$yrwdir."/";
$dirthunbs="userfiles/".$_SESSION['id']."/thumbs/".$yrwdir."/";
$dirtmidsize="userfiles/".$_SESSION['id']."/midsize/".$yrwdir."/";




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


$ccode=$_SESSION['id'];
$LongDesc=$_POST['editor'];
$pcode=$_POST['pcode'];
$prcat=$_POST['prcat'];
$pbrand=$_POST['pbrand'];
$pname=mysqli_real_escape_string($con1,$_POST['pname']);
// 
//$pdesc=mysqli_real_escape_string($con1,$_POST['editor1']);
$p_Other=mysqli_real_escape_string($con1,$_POST['editor1']);
//echo  "ram".$p_Other."ram";
//echo  "gup".$_POST['editor1']."gup";
$pcat=$_POST['pcat'];

$hidden_color=$_POST['hidden_color'];
$hidden_size=$_POST['hidden_size'];
$hidden_sizeid=$_POST['hidden_sizeid'];

$target1=$_POST['oldimg'];
$oldimgthumbs=$_POST['oldimgthumbs'];
$oldimgmidsize=$_POST['oldimgmidsize'];


$oldimgid=$_POST['oldimgid'];

$target1au=$_POST['oldaudio'];

$target1vi=$_POST['oldvid'];

$price=$_POST['price'];
$quentity=$_POST['quentity'];
//$P_desc=mysqli_real_escape_string($con1,$_POST['P_desc']);   
$P_desc=mysqli_real_escape_string($con1,$_POST['P_desc']);   

//echo $pcode;
$discntamt=$_POST['discnt']; 

if(isset($_POST['discount']))
{
$dicnttyp=$_POST['discount']; // Displaying Selected Value

 } 

    
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
 
    if ( ($old_w <= $new_w) && ($old_h <= $new_h) ) {
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

$filestodel=array();//contains old files which were upadted with new images the files in this array will be deleted if all process is successfll

$newfylsgen=array();//contains new files which will be deleted if process is not successful

$image1=$_FILES['image']['name'];
$cntt1=count($image1);
for($a=0;$a<$cntt1;$a++){

    $image=$_FILES['image']['name'][$a];
   //echo  $image;
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

$time=time();
//we will give an unique name, for example the time in unix time format
$image_name=$time.$a.'.'.$extension;
//echo "TIME IS  :".time();
//the new name will be containing the full path where will be stored (images folder)
$imgpath=$dir.$image_name;
//echo $imgpath;
$image_name3[]=$imgpath;

//we verify if the image has been uploaded, and print error instead
$copied = copy($_FILES['image']['tmp_name'][$a], "../".$imgpath);

if (!$copied) 
{
  echo '<h1>Copy unsuccessfull!</h1>';
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
  if(!resize($imgpath,"../".$dirtmidsize.$image_name, 220, 230))
  {
       $error = error_get_last();
         
          
    $rr="Resize midsize error".$error['message'];
    //echo $rr;
    $errormsg_arr[]=$rr;
    $errors++;
      
  }

}



 $filestodel[]=$target1[$a];  
 $filestodel[]=$oldimgthumbs[$a];  
 $filestodel[]=$oldimgmidsize[$a];  
 
 $newfylsgen[]=$dir.$image_name;  
 $newfylsgen[]=$dirthunbs.$image_name;  
 $newfylsgen[]=$dirtmidsize.$image_name;  
 

}else
{
    
 $image_name3[]=$target1[$a];  
 $image_name4[]=$oldimgthumbs[$a];  
 $image_name5[]=$oldimgmidsize[$a];  
 

}

}
//echo "here";

    if($discntamt!="" && $discntamt>0 || $discntamt==0)
{
if($dicnttyp=='P')
{ 
    
$ab=($discntamt/100)*$price;
//$ab=($price/100)*$discntamt;

$ttlprs=$price-$ab;
//echo "a".$price;
//echo "b".$ab;
//echo "c".$ttlprs;
}
else
{
$ttlprs=$price-$discntamt;
//$discntamt=($discntamt / $price) * 100;

}
}



if($prcat==1){
    $qry="UPDATE `fashion` SET `name`='$pname',`description`='$p_Other',`brand`='$pbrand',`category`='$pcat',`price`='$price',`quantity`='$quentity',`others`='$P_desc',discount='$discntamt',discount_type='$dicnttyp',total_amt='$ttlprs',color='$hidden_color',size='$hidden_size',size_id='$hidden_sizeid',Long_desc='$LongDesc' WHERE code='$pcode' and ccode='$ccode'"; 
 }
else if($prcat==190){
    $qry="UPDATE `electronics` SET `name`='$pname',`description`='$p_Other',`category`='$pcat',`price`='$price',`quantity`='$quentity',`others`='$P_desc',discount='$discntamt',discount_type='$dicnttyp',total_amt='$ttlprs',Long_desc='$LongDesc' WHERE code='$pcode' and ccode='$ccode'";  //echo $qry;
    }
else if($prcat==218){
    $qry="UPDATE `grocery` SET `name`='$pname',`description`='$p_other',`category`='$pcat',`price`='$price',`quantity`='$quentity',`others`='$P_desc',discount='$discntamt',discount_type='$dicnttyp',total_amt='$ttlprs',Long_desc='$LongDesc' WHERE code='$pcode' and ccode='$ccode'";  
}
else if($prcat==482){
    $qry="UPDATE `Resale` SET `name`='$pname',`description`='$p_other',`category`='$pcat',`price`='$price',`quentity`='$quentity',`others`='$P_desc',discount='$discntamt',discount_type='$dicnttyp',total_amt='$ttlprs',Long_desc='$LongDesc' WHERE code='$pcode' and ccode='$ccode'"; 
}
else{
   $qry="UPDATE `products` SET `name`='$pname',`description`='$p_other',`brand`='$pbrand',`category`='$pcat',`price`='$price',`quentity`='$quentity',`others`='$P_desc',discount='$discntamt',discount_type='$dicnttyp',total_amt='$ttlprs',Long_desc='$LongDesc' WHERE code='$pcode' and ccode='$ccode'";    
}

//echo $qry;
$res=mysqli_query($con1,$qry); 
           
               if(!$res)
               { 
    $errormsg_arr[]=mysqli_error($con1);
    $errors++;
               }
    
    
    
    
    
               

$spfc=$_POST['specification'];
$spfc1=$_POST['specification1'];
$vid=$_POST['id'];

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
    if($prcat==1)
    {
        for($i=0;$i<count($spfc);$i++)
                         {  
                             
                             if($vid[$i]!=""){
                        
                        $qry=mysqli_query($con1,"update  fashionSpecification set product_specification='".$_POST['specification1'][$i]."',specificationname='".$_POST['specification'][$i]."' where id='".$vid[$i]."'");
                      
                         }
                        else{
                            
                            $qrya=mysqli_query($con1,"INSERT INTO `fashionSpecification`(`product_id`, `product_specification`,`specificationname`) VALUES('".$pcode."','".$_POST['specification1'][$i]."','".$_POST['specification'][$i]."')");
                        
                        }
                    }
    
       for($a=0;$a<count($image_name3);$a++)
        {
                    //echo "ok";
                    if($oldimgid[$a]=="")
                    {
                        
                       $insrtqry=mysqli_query($con1," INSERT INTO `fashion_img`( `product_id`, `img`,thumbs,midsize) VALUES ('".$pcode."','".$image_name3[$a]."','".$image_name4[$a]."','".$image_name5[$a]."')");
                       
                        if(!$insrtqry)
               {
                   
                  
    $errormsg_arr[]=mysqli_error($con1);
    $errors++;
               }
                       
                    }else if($oldimgid[$a]!="")
                    {
                      $update=mysqli_query($con1,"update fashion_img set img ='".$image_name3[$a]."',product_id='".$pcode."',thumbs='".$image_name4[$a]."',midsize='".$image_name5[$a]."' where id='".$oldimgid[$a]."'");
                       
                         if(!$update)
               {
                   
                  
    $errormsg_arr[]=mysqli_error($con1);
    $errors++;
               }
                    }
                 
        }
      
        
}

else if($prcat==190)
{
   for($i=0;$i<count($spfc);$i++)
                         {  
                             
                             if($vid[$i]!=""){
                        
                        $qry=mysqli_query($con1,"update  electronicsSpecification set product_specification='".$_POST['specification1'][$i]."',specificationname='".$_POST['specification'][$i]."' where id='".$vid[$i]."'");
                      
                         }
                        else{
                            
                            $qrya=mysqli_query($con1,"INSERT INTO `electronicsSpecification`(`product_id`, `product_specification`,`specificationname`) VALUES('".$pcode."','".$_POST['specification1'][$i]."','".$_POST['specification'][$i]."')");
                        
                        }
                    }
    
       for($a=0;$a<count($image_name3);$a++)
        {
                    //echo "ok";
                    if($oldimgid[$a]=="")
                    {
                        
                       $insrtqry=mysqli_query($con1," INSERT INTO `electronics_img`( `product_id`, `img`,thumbs,midsize) VALUES ('".$pcode."','".$image_name3[$a]."','".$image_name4[$a]."','".$image_name5[$a]."')");
                       
                        if(!$insrtqry)
               {
                   
                  
    $errormsg_arr[]=mysqli_error($con1);
    $errors++;
               }
                       
                    }else if($oldimgid[$a]!="")
                    {
                      $update=mysqli_query($con1,"update electronics_img set img ='".$image_name3[$a]."',product_id='".$pcode."',thumbs='".$image_name4[$a]."',midsize='".$image_name5[$a]."' where id='".$oldimgid[$a]."'");
                       
                         if(!$update)
               {
                   
                  
    $errormsg_arr[]=mysqli_error($con1);
    $errors++;
               }
                    }
                 
        }
      
         
}

else if($prcat==218)
{
   for($i=0;$i<count($spfc);$i++)
                         {  
                             
                             if($vid[$i]!=""){
                        
                        $qry=mysqli_query($con1,"update  grocerySpecification set product_specification='".$_POST['specification1'][$i]."',specificationname='".$_POST['specification'][$i]."' where id='".$vid[$i]."'");
                      
                         }
                        else{
                            
                            $qrya=mysqli_query($con1,"INSERT INTO `grocerySpecification`(`product_id`, `product_specification`,`specificationname`) VALUES('".$pcode."','".$_POST['specification1'][$i]."','".$_POST['specification'][$i]."')");
                        
                        }
                    }
    
       for($a=0;$a<count($image_name3);$a++)
        {
                    //echo "ok";
                    if($oldimgid[$a]=="")
                    {
                        
                       $insrtqry=mysqli_query($con1," INSERT INTO `grocery_img`( `product_id`, `img`,thumbs,midsize) VALUES ('".$pcode."','".$image_name3[$a]."','".$image_name4[$a]."','".$image_name5[$a]."')");
                       
                        if(!$insrtqry)
               {
                   
                  
    $errormsg_arr[]=mysqli_error($con1);
    $errors++;
               }
                       
                    }else if($oldimgid[$a]!="")
                    {
                      $update=mysqli_query($con1,"update grocery_img set img ='".$image_name3[$a]."',product_id='".$pcode."',thumbs='".$image_name4[$a]."',midsize='".$image_name5[$a]."' where id='".$oldimgid[$a]."'");
                       
                         if(!$update)
               {
                   
                  
    $errormsg_arr[]=mysqli_error($con1);
    $errors++;
               }
                    }
                 
        }
      
         
}

else

   for($i=0;$i<count($spfc);$i++)
                         {  
                             
                             if($vid[$i]!=""){
                        
                      $qry=mysqli_query($con1,"update productspecification SET product_specification='".$_POST['specification1'][$i]."',specificationname='".$_POST['specification'][$i]."' where id='".$vid[$i]."'");
           
                         }
                        else{
                            
                          $qrya=mysqli_query($con1,"INSERT INTO `productspecification`(`product_id`, `product_specification`,`specificationname`) VALUES('".$pcode."','".$_POST['specification1'][$i]."','".$_POST['specification'][$i]."')");
         
                        }
                    }
    
       for($a=0;$a<count($image_name3);$a++)
        {
                    //echo "ok";
                    if($oldimgid[$a]=="")
                    {
                          
                       $insrtqry=mysqli_query($con1," INSERT INTO `product_img`( `product_id`, `img`,thumbs,midsize) VALUES ('".$pcode."','".$image_name3[$a]."','".$image_name4[$a]."','".$image_name5[$a]."')");
                     
                        if(!$insrtqry)
               {
                   
                  
    $errormsg_arr[]=mysqli_error($con1);
    $errors++;
               }
                       
                    }else if($oldimgid[$a]!="")
                    {
               $update=mysqli_query($con1,"update product_img set img ='".$image_name3[$a]."',product_id='".$pcode."',thumbs='".$image_name4[$a]."',midsize='".$image_name5[$a]."' where id='".$oldimgid[$a]."'");
                               
                         if(!$update)
               {
                   
                  
    $errormsg_arr[]=mysqli_error($con1);
    $errors++;
               }
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
   for($a=0;$a<count($image_name3);$a++)
                {
                    //echo "ok";
                    if($oldimgid[$a]=="")
                    {
                        
                       $insrtqry=mysqli_query($con1," INSERT INTO `product_img`( `product_id`, `img`,thumbs,midsize) VALUES ('".$pcode."','".$image_name3[$a]."','".$image_name4[$a]."','".$image_name5[$a]."')");
                       
                        if(!$insrtqry)
               {
                   
                  
    $errormsg_arr[]=mysqli_error($con1);
    $errors++;
               }
                       
                    }else if($oldimgid[$a]!="")
                    {
                       //echo "update set img ='".$image_name3[$a]."',product_id='".$pcode."' where id='".$oldimgid[$a]."'"; 
                       $update=mysqli_query($con1,"update product_img set img ='".$image_name3[$a]."',product_id='".$pcode."',thumbs='".$image_name4[$a]."',midsize='".$image_name5[$a]."' where id='".$oldimgid[$a]."'");
                       
                         if(!$update)
               {
                   
                  
    $errormsg_arr[]=mysqli_error($con1);
    $errors++;
               }
                    }
                    
                }
                
}*/





                               if($errors=="0")

  { 
      mysqli_commit($con1);
      
      for($a=0;$a<count($filestodel);$a++)
    {
        
         
        if($filestodel[$a]!="")
        {
       if (file_exists("../".$filestodel[$a])) 
      {
      unlink("../".$filestodel[$a]);
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
  
  <?php }   

                  else

                 {    
                     
mysqli_rollback($con1);

  for($a=0;$a<count($newfylsgen);$a++)
    {
        
        if($newfylsgen[$a]!="")
        {
        
       if (file_exists("../".$newfylsgen[$a])) 
      {
      unlink("../".$newfylsgen[$a]);
      }
        }
      
          
    }

print_r($errormsg_arr);
    echo "Error Occured, Please go back and try again";

  }                               

 



?>



</body>
</html>