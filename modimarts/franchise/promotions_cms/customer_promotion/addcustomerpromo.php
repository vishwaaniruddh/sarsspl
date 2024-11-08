<?php 
session_start();
include '../../config.php';

function getExtension($str)
{
    $i = strrpos($str, ".");
    if (!$i) {return "";}
    $l   = strlen($str) - $i;
    $ext = substr($str, $i + 1, $l);
    return $ext;
}

$customer_address    = "";
$customer_name       = $_POST['name'];
$logo                = $_FILES['logo'];
$content             = $_POST['content'];
$content             = $_POST['content'];
$content1             = $_POST['content1'];
$content2             = $_POST['content2'];
$content3             = $_POST['content3'];
$image               = $_FILES['image'];
$password            = $_POST['password'];
$mobile              = $_POST['mobile'];
$status              = 1;

$email               = $_POST['email'];
$website              = $_POST['website'];
$designation         = $_POST['designation'];
$is_franchisee       = $_POST['is_franchisee'];

// IMAGE
$file_name=$_FILES["image"]["name"];
$file_tmp=$_FILES["image"]["tmp_name"];
$file_name = str_replace(" ","",$file_name);


$imgfileExtension = strtolower(getExtension($file_name));
$name = md5(time()) . '.' . $imgfileExtension;

 $target_dir = 'upload/'.$name;

move_uploaded_file($_FILES["image"]["tmp_name"],$target_dir);

// LOGO
$file_name1=$_FILES["logo"]["name"];
$file_tmp1=$_FILES["logo"]["tmp_name"];
$file_name1 = str_replace(" ","",$file_name1);

$imgfileExtension1 = strtolower(getExtension($file_name1));
$name1 = md5(time()) . '.' . $imgfileExtension1;

 $target_dir1 = 'logo/'.$name1;

move_uploaded_file($_FILES["logo"]["tmp_name"],$target_dir1);


// footer_image
$file_name2=$_FILES["footer_image"]["name"];
$file_tmp2=$_FILES["footer_image"]["tmp_name"];
$file_name2 = str_replace(" ","",$file_name2);

$imgfileExtension2 = strtolower(getExtension($file_name2));
$name2 = md5(time()) . '.' . $imgfileExtension2;


 $target_dir2 = 'footer_image/'.$name2;

move_uploaded_file($_FILES["footer_image"]["tmp_name"],$target_dir2);




$insert_member= "insert into `customer_promotion`(`customer_name`, `customer_address`, `content`, `content1`, `content2`, `content3`, `image`,`logo`, `status`,`password`,`mobile_number`,`email`,`website`,`designation`,`footer_image`,`is_franchisee`) values ('".$customer_name."','".$customer_address."','".$content."','".$content1."','".$content2."','".$content3."', '".$target_dir."','".$target_dir1."','".$status."','".$password."','".$mobile."','".$email."','".$website."','".$designation."','".$target_dir2."','".$is_franchisee."')";

if (mysqli_query($con, $insert_member)) {
  echo "New record created successfully";
 } else {
  echo "Error: <br>" . mysqli_error($con);
}

?>

<script>
    window.location="https://allmart.world/franchise/promotions_cms/customer_promotion/";
</script>