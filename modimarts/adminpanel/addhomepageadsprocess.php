<?php 
session_start();
include('config.php');

error_reporting(E_ALL);
ini_set('display_errors', '1');

$name=$_POST['name'];
$position=$_POST['position'];

function getExtension($str)
{
    $i = strrpos($str, ".");
    if (!$i) {return "";}
    $l   = strlen($str) - $i;
    $ext = substr($str, $i + 1, $l);
    return $ext;
}

if (isset($_POST['name'])) {

    $error  = 0;
    $imgdir1="/home/allmart/public_html/";
    $imgdir = "/assets/media/ads/";

    $name    = mysqli_real_escape_string($con3, $_POST['name']);
    $date       = date('Y-m-d H:i:s');
    $position = mysqli_real_escape_string($con3, $_POST['position']);
    $url = mysqli_real_escape_string($con3, $_POST['url']);

    // Check img
    if (file_exists($_FILES['adsimg']['tmp_name'])) {
        $imgfileTmpPath   = $_FILES['adsimg']['tmp_name'];
        $imgfileName      = $_FILES['adsimg']['name'];
        $imgfileSize      = $_FILES['adsimg']['size'];
        $imgfileType      = $_FILES['adsimg']['type'];
        $imgfileExtension = strtolower(getExtension($imgfileName));

        $newFileName = md5(time() . $imgfileName) . '.' . $imgfileExtension;
        $imgallow    = array('jpg', 'gif', 'png', 'jpeg');
        if (in_array($imgfileExtension, $imgallow)) {

            $imgdest_path = $imgdir . $newFileName;

            if (move_uploaded_file($imgfileTmpPath, $imgdir1.$imgdest_path)) {
                echo 'File is successfully uploaded';
            } else {
                echo 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
            }

        } else {
            $error = 1;
        }

    } else {
        $imgdest_path = '';
    }


$userid=$_SESSION['SESS_USER_NAME'];
$mydata=mysqli_query($con3,"INSERT INTO `homepage_ads`(`name`, `img_path`, `position`, `uploded_by`, `status`, `created_at`,`url`) VALUES ('".$name."','".$imgdest_path."','".$position."','".$userid."','1','".$date."','".$url."')");
if ($mydata) {
	 ?>
			<script>
			   alert("Ads Uploaded successfully!");    
			    setTimeout(function(){
			        window.location.href='<?=$baseurl?>adminpanel/HomepageAds.php';        
			    }, 1500);
			</script>

			<?php
}
else
{
	?>
		<script>
		       alert("Ads Not Uploaded ");    
		    
		    setTimeout(function(){
		        window.location.href='<?=$baseurl?>adminpanel/HomepageAds.php';        
		    }, 3000);
		</script>
		<?php

}
}

 ?>