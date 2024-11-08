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



$customer_id         = $_POST['userid'];
$mobile_number       = $_POST['mobile_number'];
$customer_name       = $_POST['name'];
$password            = $_POST['password'];

$content             = $_POST['content'];
$content1             = $_POST['content1'];
$content2             = $_POST['content2'];
$content3             = $_POST['content3'];

$logo                = $_FILES['logo'];
$image               = $_FILES['image'];
$footer_image        = $_FILES['footer_image'];

$oldlogo             = $_POST['oldlogo'];
$oldimg              = $_POST['oldimg'];
$oldfooter_image     = $_POST['oldfooter_image'];

$status              = $_POST['status'];
$email               = $_POST['email'];
$website              = $_POST['website'];
$designation         = $_POST['designation'];
$status              = $_POST['status'];
$is_franchisee      = $_POST['is_franchisee'];
// var_dump($customer_id);die;

       
if($_FILES["image"]["name"]!=''){        
$file_name=$_FILES["image"]["name"];
$file_tmp=$_FILES["image"]["tmp_name"];
$file_name = str_replace(" ","",$file_name);

$imgfileExtension = strtolower(getExtension($file_name));
$name = md5(time()). '.' . $imgfileExtension;

 $target_dir = 'upload/'.$name;
 move_uploaded_file($file_tmp,$target_dir);
}
else
{
 $target_dir = $oldimg;   
}


 

if($_FILES["logo"]["name"]!='')
{
$file_name1=$_FILES["logo"]["name"];
$file_tmp1=$_FILES["logo"]["tmp_name"];
$file_name1 = str_replace(" ","",$file_name1);

$imgfileExtension1 = strtolower(getExtension($file_name1));
$name1 = md5(time()) . '.' . $imgfileExtension1;


$target_dir1 = 'logo/'.$name1;


move_uploaded_file($file_tmp1,$target_dir1);

}
else
{
    $target_dir1 = $oldlogo;
}
 

if($_FILES["footer_image"]["name"]!='')
{
$file_name2=$_FILES["footer_image"]["name"];
$file_tmp2=$_FILES["footer_image"]["tmp_name"];
$file_name2 = str_replace(" ","",$file_name2);

$imgfileExtension2 = strtolower(getExtension($file_name2));
$name2 = md5(time()) . '.' . $imgfileExtension2;


$target_dir2 = 'footer_image/'.$name2;


move_uploaded_file($file_tmp2,$target_dir2);

}
else
{
    $target_dir2 = $oldfooter_image;
}

  $update_member = "update `customer_promotion` set `customer_name`='".$customer_name."',`mobile_number`='".$mobile_number."',`password`='".$password."',`content`='".$content."',`content1`='".$content1."',`content2`='".$content2."',`content3`='".$content3."', `logo`='".$target_dir1."',`image` = '".$target_dir."',`footer_image` = '".$target_dir2."',`status`='".$status."',`email`='".$email."',`website`='".$website."' ,`designation`='".$designation."',`is_franchisee`='".$is_franchisee."' where `customer_id` ='".$customer_id."'";
  
 

if (mysqli_query($con, $update_member)) {
  echo "REcord updated successfully";
} else {
  echo "Error: <br>" . mysqli_error($con);
}

?>
<script>
    window.location="https://allmart.world/franchise/promotions_cms/customer_promotion/";
</script>