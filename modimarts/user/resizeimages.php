<?php
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

//if(isset($_GET['img'])){
$image_name='Black_Forest_Cake.jpg';  //$_GET['img'];
$dir="userfiles/494/img/2020/08/";
$dirthunbs="userfiles/494/thumbs/2020/08/";
$dirtmidsize="userfiles/494/midsize/2020/08/";
$dirtLrgsize="userfiles/494/largeSize/2020/08/";
$imgpath=$dir.$image_name;


resize($imgpath,"../".$dirthunbs.$image_name, 200, 200);
resize($imgpath,"../".$dirtmidsize.$image_name, 500, 500);
resize($imgpath,"../".$dirtLrgsize.$image_name, 1000, 1000);
//}
//else
//echo "please pass an image";
?>