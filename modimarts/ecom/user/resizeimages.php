<?php
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


if(isset($_GET['cid'])){
    $cid=$_GET['cid'];
//$image_name='DIWALI_BOX_4.jpg';  //$_GET['img'];
$dir="userfiles/".$cid."/img/2020/09/";
$dirthumbs="userfiles/".$cid."/thumbs/2020/09/";
$dirtmidsize="userfiles/".$cid."/midsize/2020/09/";
$dirtLrgsize="userfiles/".$cid."/largeSize/2020/09/";
//echo $dir;
$all_files = glob("../".$dir."*.*");
echo count($all_files)."<br>";
  for ($i=0; $i<count($all_files); $i++)
    {
      $image_name = $all_files[$i];
      $supported_format = array('gif','jpg','jpeg','png');
      $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
      if (in_array($ext, $supported_format))
          {
          //  $arr=split("/",$image_name);
            //$cnt=count($arr); echo $cnt;
            //$img=$arr[$cnt-1];
            $imgpath=$image_name;
            echo $imgpath."<br>";

            $dirthumb=str_replace("img","thumbs",$image_name); 
            $dirmid=str_replace("img","midsize",$image_name); 
            $dirlarge=str_replace("img","largeSize",$image_name); 
            
            resize($imgpath,$dirthumb, 200, 200);
            resize($imgpath,$dirmid, 500, 500);
            resize($imgpath,$dirlarge, 1000, 1000);
           /* resize($imgpath,"../".$dirthumbs.$image_name, 200, 200);
            resize($imgpath,"../".$dirtmidsize.$image_name, 500, 500);
            resize($imgpath,"../".$dirtLrgsize.$image_name, 1000, 1000);*/
          } else {
              continue;
          }
    }

}
else
echo "please pass customer id";
?>