<?php
session_start();

include('config.php');
/*var_dump($_FILES);*/
/*var_dump($_POST);*/
if(isset($_GET['id'])) { 
    $id = $_POST['id'];
    $period = $_POST['period'];
    $type = $_POST['type'];
    $rate = $_POST['rate'];
    $discount = $_POST['discount'];
    $city = $_POST['city'];
    $status = $_POST['status'];
} else {
    $rate = $_POST['rate'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $type = $_POST['type'];
    $period = $_POST['period'];
    $discount = $_POST['discount'];
    $city = $_POST['city'];
    if(isset($_FILES['offer_content']) && $_FILES['offer_content']!=''){ 
        $content_file='';
      
///////////////////////////////

$target_dir = "userfiles/";
$target_file = $target_dir . basename($_FILES["offer_content"]["name"]);
//echo $target_file;
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
/*echo $fileType;exit;*/
//if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["offer_content"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
//}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

    if (move_uploaded_file($_FILES["offer_content"]["tmp_name"], $target_file)) {
        $content_file=$target_file;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }


// $content_file=$_FILES['offer_content']['name'];

////////////////////
}
    if(isset($_GET['content'])){
        $content = $_POST['content'];
    }
    
    $status = $_POST['status'];
}
$date = date('Y-m-d H:i:s');
if($fileType == 'mp4' || $fileType == 'avi' || $fileType == 'flv' || $fileType == 'wmv' || $fileType == 'mov'){
    $fileType = 'video';
} else if($fileType == 'jpeg' || $fileType == 'gif' || $fileType == 'png' || $fileType == 'wmv' || $fileType == 'mov'){
    $fileType = 'image';
} else if($fileType == 'txt' || $fileType == 'doc' || $fileType == 'pdf' || $fileType == 'ppt' || $fileType == 'pptx'){
    $fileType = 'doc';
}

 if($_GET['id']>0){
   /* $update_qry = mysql_query("update subscriptions set end_date='".$date."' , status=2 where id=".$_GET['id']);
    $res=mysql_query($qry);
    $message = "Subscription updated successfully!";  exit;*/
} else {
    $qry="insert into merchant_offers(`start_date`,`end_date`,`rate`,`status`,`creation_date`,`period`,`content`,`content_file`,`type`,`city`,`file_type`) values('".$start_date."','".$end_date."','".$rate."','".$status."','".$date."','".$period."','".$content."','".$content_file."','".$type."','".$city."','".$fileType."')";
    
   /* var_dump($cnt);exit;*/
    $res=mysql_query($qry);
    $message = "Offer Added Successfully !!";
    $lastr_id= mysql_insert_id();
    /*echo $qry;exit;*/
}
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo '<script>window.open("add_offers.php", "_self");</script>';
?>
