<?  include('../../config.php'); 
error_reporting(0); 
?> 
<?php 
$msg = ""; 

// If upload button is clicked ... 
if (isset($_POST['upload'])) { 

	$filename = $_FILES["uploadfile"]["name"]; 
	//echo $filename;
	$tempname = $_FILES["uploadfile"]["tmp_name"];	 
		$folder = "image/".$filename; 
		$allowed_image_extension = array(
        "png",
        "jpg",
        "jpeg"
    );
    
        $fileinfo = @getimagesize($_FILES["uploadfile"]["tmp_name"]);
        $width = $fileinfo[0];
         $height = $fileinfo[1];
        $file_extension = pathinfo($_FILES["uploadfile"]["name"], PATHINFO_EXTENSION);
        
        if (! file_exists($_FILES["uploadfile"]["tmp_name"])) {
            // echo "123";
        $response = array(
            "type" => "error",
            "message" => "Choose image file to upload."
        );
    }    // Validate file input to check if is with valid extension
    else if (! in_array($file_extension, $allowed_image_extension)) {
        $response = array(
            "type" => "error",
            "message" => "Upload valiid images. Only PNG and JPEG are allowed."
        );
        echo $result;
    }    // Validate image file size
    else if (($_FILES["uploadfile"]["size"] > 10000000)) {
        $response = array(
            "type" => "error",
            "message" => "Image size exceeds 10MB"
        );
    }    // Validate image file dimension
   else {
    	$sql = "INSERT INTO ads_image(Filename) VALUES ('$filename')"; 
		mysqli_query($con, $sql); 
        $target = "image/" . basename($_FILES["uploadfile"]["name"]);
        if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $target)) {
            $response = array(
                "type" => "success",
                "message" => "Image uploaded successfully."
            );
        } else {
            $response = array(
                "type" => "error",
                "message" => "Problem in uploading image files."
            );
        }
	} 

    // return $response;
} 
 
$result = mysqli_query($con, "SELECT * FROM ads_image"); 
?> 

<!DOCTYPE html> 
<html> 

<head> 
	<title>Image Upload</title> 
	<link rel="stylesheet"
		type="text/css"
		href="style.css" /> 
</head> 

<body> 
	<div id="content"> 
		<form method="POST"	action="image_form.php" enctype="multipart/form-data"> 
			<input type="file"	name="uploadfile" /> 
			<div> 
				<button type="submit" name="upload"> UPLOAD </button> 
			</div> 
		</form> 
		<?php if(!empty($response)) { ?> <div class="response 
    		<?php echo $response["type"]; ?>">
            <?php echo $response["message"]; ?>
        </div>
        <?php }?>
	</div> 
</body> 

</html> 
