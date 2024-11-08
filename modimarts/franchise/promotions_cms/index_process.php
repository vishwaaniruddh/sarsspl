<?php include('../config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$promotion = $_POST['promotion'];
$language = $_POST['language'];
$date = date("Y-m-d");

        $target_dir = 'demo/';
        
        
$file_name=$_FILES["image"]["name"];
$ext = pathinfo($file_name, PATHINFO_EXTENSION);
$filename=time().".".$ext;
$file_tmp=$_FILES["image"]["tmp_name"];
$file_name = str_replace(" ","",$filename);
move_uploaded_file($file_tmp=$_FILES["image"]["tmp_name"],$target_dir.'/'.$file_name);
$uploaded_link = 'https://www.allmart.world/franchise/promotions_cms/demo/'.$file_name;


$insert = "insert into total_promotions(promotion, language, image, status, created_at) values('".$promotion."','".$language."','".$uploaded_link."','1','".$date."')";


if(mysqli_query($con,$insert)){ ?>
   
   <script>
       alert('Promotion Added Successfully !');
       window.history.back();
   </script> 
<? }
else{ ?>
   <script>
       alert('Promotion Added Error !');
       window.history.back();
   </script>
     
<? }


 
?>
