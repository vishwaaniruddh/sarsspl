<?php 
session_start();

?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php

if (!isset($_SESSION['username']) && $_SESSION['userid']=='1') {
    ?>
    <script>
        window.location.href='https://modimart.world/franchise2/get_members.php';
    </script>
<?
}
include '../config.php';

error_reporting(E_ALL);
ini_set('display_errors', '1');

function getExtension($str)
{
    $i = strrpos($str, ".");
    if (!$i) {return "";}
    $l   = strlen($str) - $i;
    $ext = substr($str, $i + 1, $l);
    return $ext;
}

$userType=$_POST['UserType'];
$UserName=$_POST['UserName'];
$FullName=$_POST['FullName'];
$password=$_POST['password'];
$status=$_POST['status'];
$oldimg=$_POST['oldimg'];
$UserId=$_POST['UserId'];
$mobile=$_POST['mobile'];


	

 $imgdir = "/home/allmart/public_html";
 $imgdir1 = "/assets/users/";

     if (file_exists($_FILES['image']['tmp_name'])) {
        $imgfileTmpPath   = $_FILES['image']['tmp_name'];
        $imgfileName      = $_FILES['image']['name'];
        $imgfileSize      = $_FILES['image']['size'];
        $imgfileType      = $_FILES['image']['type'];
        $imgfileExtension = strtolower(getExtension($imgfileName));

        $newFileName = md5(time() . $imgfileName) . '.' . $imgfileExtension;
        $imgallow    = array('jpg', 'gif', 'png', 'jpeg');
        if (in_array($imgfileExtension, $imgallow)) {

            $imgdest_path = $imgdir1 . $newFileName;
            $imgdest_path1 = $imgdir . $imgdest_path;

            if (move_uploaded_file($imgfileTmpPath, $imgdest_path1)) {
                echo 'File is successfully uploaded';
            } else {
                echo 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
            }
        } else {
            $error = 1;
        }

    } else {
        $imgdest_path = $oldimg;
    }

// $putdata=mysqli_query($con3,"INSERT INTO `Users`(`UserName`,`Full_Name`, `Password`, `UserType`, `image`,`roll_id`) VALUES ('".$UserName."','".$FullName."','".$password."','".$userType."','".$imgdest_path."','2')");

$updateuser=mysqli_query($con3,"UPDATE `Users` SET `UserName`='".$UserName."',`Full_Name`='".$FullName."',`Password`='".$password."',`UserType`='".$userType."',`image`='".$imgdest_path."',`status`='".$status."',`mobile`='".$mobile."' WHERE UserId='".$UserId."'");

if($updateuser)
{
	echo "Updated Successfully";
	?>
		<script>


		    Swal.fire(
		  'Success',
		  'User Updated Successfully',
		  'success'
		).then(function() {
		    window.location = "https://www.modimart.world/franchise2/admin/Users.php"
		});

		</script>
		<?php

}
else
{
	echo "Not Updated";
	?>
<script>
    
    Swal.fire(
  'Failed',
  'User Not Updated',
  'error'
).then(function() {
    window.location = "https://www.modimart.world/franchise2/admin/Users.php";
});
</script>
<?php
}


   


 ?>