<?
session_start();
include("config.php");

$err=0;
$errstr="";
$pthn="profileimgs/";

if(isset($_FILES['img']))
{
    if($_FILES['img']['name']!="")
    {
    
  if (!file_exists($pthn)) 
{
    
   mkdir($pthn, 0755, true);
}
$pthn=$pthn.date('Y')."/";
if (!file_exists($pthn)) 
{
   mkdir($pthn, 0755, true);
}
$pthn=$pthn.date('m')."/";
if (!file_exists($pthn)) 
{
   mkdir($pthn, 0755, true);
}

    
      $errors= array();
      $file_name = $_FILES['img']['name'];
      $file_size =$_FILES['img']['size'];
      $file_tmp =$_FILES['img']['tmp_name'];
      $file_type=$_FILES['img']['type'];
     // $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      /*if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }*/
      
      /*if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }*/
      $file_name=$pthn.date('YmdHis')."sts".$file_name;
      if($err==0)
      {
         if(move_uploaded_file($file_tmp,$file_name))
         {
             
             
         }else
         {
             echo $_FILES["img"]["error"];
             $err++;
             
             $errstr=$errstr."Upload failed";
         }
         
      }else
      {
        $errstr=$errstr."Upload failed";
        
      }
    }else
    {
        $file_name=$_POST['oldimg'];
    }
}
else
    {
        $file_name=$_POST['oldimg'];
    }

mysqli_query($con,"BEGIN");
if($err==0)
{
    
 
    
     $qr=mysqli_query($con,"update quiz_regdetails set `name`='".mysqli_real_escape_string($con,$_POST['name'])."', `lname`='".mysqli_real_escape_string($con,$_POST['lname'])."', `emailid`='".mysqli_real_escape_string($con,$_POST['email'])."', `school`='".mysqli_real_escape_string($con,$_POST['schname'])."', `class`='".mysqli_real_escape_string($con,$_POST['class1'])."',img_path='".$file_name."' where id='".$_SESSION['userid']."'");
    
    if(!$qr)
    {
        echo mysqli_error($con);
        echo $err++;
    }
}
if($err==0)
{
mysqli_query($con,"COMMIT");
  echo "1";
}
else
{
mysqli_query($con,"ROLLBACK");
    echo "2";
}
?>