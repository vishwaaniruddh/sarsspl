<?php
session_start();
include 'config.php';
include 'adminaccess.php';

// error_reporting(E_ALL);
// ini_set('display_errors', '1');

function getExtension($str)
{
    $i = strrpos($str, ".");
    if (!$i) {return "";}
    $l   = strlen($str) - $i;
    $ext = substr($str, $i + 1, $l);
    return $ext;
}

if (isset($_POST['Heading'])) {

    $error  = 0;
    $imgdir = "../assets/media/img/";
    $docdir = "../assets/media/doc/";

    $heading    = mysqli_real_escape_string($con1, $_POST['Heading']);
    $date       = date('Y-m-d H:i:s', strtotime($_POST['date']));
    $SourceName = mysqli_real_escape_string($con1, $_POST['SourceName']);
    $url        = mysqli_real_escape_string($con1, $_POST['url']);
    $Type       = mysqli_real_escape_string($con1, $_POST['Type']);

    // Check img
    if (file_exists($_FILES['upimg']['tmp_name'])) {

        $imgfileTmpPath   = $_FILES['upimg']['tmp_name'];
        $imgfileName      = $_FILES['upimg']['name'];
        $imgfileSize      = $_FILES['upimg']['size'];
        $imgfileType      = $_FILES['upimg']['type'];
        $imgfileExtension = strtolower(getExtension($imgfileName));
        $mainpath = $_SERVER['DOCUMENT_ROOT'];
        $oldimg=$_POST['oldimg'];
        $imgpath=$mainpath.$oldimg;

          if (unlink($imgpath)) {    
                echo "success";
            } else {
                echo "fail";    
            }

        $newFileName = md5(time() . $imgfileName) . '.' . $imgfileExtension;
        $imgallow    = array('jpg', 'gif', 'png', 'jpeg');
        if (in_array($imgfileExtension, $imgallow)) {

            $imgdest_path = $imgdir . $newFileName;

            if (move_uploaded_file($imgfileTmpPath, $imgdest_path)) {
                echo 'File is successfully uploaded';
            } else {
                echo 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
            }

        } else {
            $error = 1;
        }

    } else {
        $imgdest_path = $_POST['oldimg'];
    }

    // Check document
    if (file_exists($_FILES['updoc']['tmp_name'])) {
        $docfileTmpPath   = $_FILES['updoc']['tmp_name'];
        $docfileName      = $_FILES['updoc']['name'];
        $docfileSize      = $_FILES['updoc']['size'];
        $docfileType      = $_FILES['updoc']['type'];
        $docfileExtension = strtolower(getExtension($docfileName));

        $mainpath = $_SERVER['DOCUMENT_ROOT'];
        $oldimg=$_POST['olddoc'];
        $imgpath=$mainpath.$oldimg;

          if (unlink($imgpath)) {    
                echo "success";
            } else {
                echo "fail";    
            }

        $docFileName = md5(time() . $docfileName) . '.' . $docfileExtension;
        $docallow    = array('mp4', 'pdf', 'png');
        if (in_array($docfileExtension, $docallow)) {

            $docdest_path = $docdir . $docFileName;

            if (move_uploaded_file($docfileTmpPath, $docdest_path)) {
                echo 'File is successfully uploaded';
            } else {
                echo 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
            }

        } else {
            $error = 1;
        }

    } else {
        $docdest_path = $_POST['olddoc'];
    }

    if ($error == 0) {
        // mysqli_query($con1, "INSERT INTO `PressReleases`( `press_type`, `heading`, `source_name`, `url`, `document`, `image`, `created_date`) VALUES ('" . $Type . "','" . $heading . "','" . $SourceName . "','" . $url . "','" . $docdest_path . "','" . $imgdest_path . "','" . $date . "')");
        $mediaid=$_POST['mediaid'];
        mysqli_query($con1,"UPDATE `PressReleases` SET`press_type`='".$Type."',`heading`='".$heading."',`source_name`='".$SourceName."',`url`='".$url."',`document`='".$docdest_path."',`image`='".$imgdest_path."',`created_date`='".$date."' WHERE id='".$mediaid."'");

        ?>
			<script>
			   alert("Media updated successfully!");    
			    setTimeout(function(){
			        window.location.href='/adminpanel/ManagePress.php';        
			    }, 1500);
			</script>

			<?php

    }
    else
    {
    	?>
		<script>
		       alert("Media Not Uploaded ");    
		    
		    setTimeout(function(){
		        window.location.href='/adminpanel/ManagePress.php';        
		    }, 3000);
		</script>
		<?php
    }

}
