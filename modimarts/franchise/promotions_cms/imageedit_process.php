<?php include('../config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$imgid=$_POST['imageid'];


        $target_dir = 'demo/';
 

$file_name=$_FILES["image"]["name"];
$ext = pathinfo($file_name, PATHINFO_EXTENSION);
$filename=time().".".$ext;
$file_tmp=$_FILES["image"]["tmp_name"];
$file_name = str_replace(" ","",$filename);
move_uploaded_file($file_tmp=$_FILES["image"]["tmp_name"],$target_dir.'/'.$file_name);
$uploaded_link = 'https://www.allmart.world/franchise/promotions_cms/demo/'.$file_name;



$insert = "UPDATE `total_promotions` SET `image`='".$uploaded_link."' WHERE id='".$imgid."'";


if(mysqli_query($con,$insert)){
$file_url=$_POST['oldimage'];
$getpath=realpath($_SERVER['DOCUMENT_ROOT'] . parse_url( $file_url, PHP_URL_PATH ));
unlink($getpath);
?>
   
   <script>
       alert('Promotion Updated Successfully !');
       window.history.back();
   </script> 
<? }
else{ ?>
   <script>
       alert('Promotion Updated Error !');
       window.history.back();
   </script>
     
<? }


 
?>
