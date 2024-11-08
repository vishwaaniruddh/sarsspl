<?php function cwUpload($field_name = '', $target_folder = '', $file_name = '', $thumb = FALSE, $thumb_folder = '', $thumb_width = '', $thumb_height = ''){

    //folder path setup
    $target_path = $target_folder;
    $thumb_path = $thumb_folder;
    
    //file name setup
    $filename_err = explode(".",$_FILES[$field_name]['name']);
    $filename_err_count = count($filename_err);
    $file_ext = $filename_err[$filename_err_count-1];
    if($file_name != ''){
        $fileName = $file_name.'.'.$file_ext;
    }else{
        $fileName = $_FILES[$field_name]['name'];
    }
    
    //upload image path
    $upload_image = $target_path.basename($fileName);
    
    //upload image
    if(move_uploaded_file($_FILES[$field_name]['tmp_name'],$upload_image))
    {
        //thumbnail creation
        if($thumb == TRUE)
        {
            $thumbnail = $thumb_path.$fileName;
            list($width,$height) = getimagesize($upload_image);
            $thumb_create = imagecreatetruecolor($thumb_width,$thumb_height);
            switch($file_ext){
                case 'jpg':
                    $source = imagecreatefromjpeg($upload_image);
                    break;
                case 'jpeg':
                    $source = imagecreatefromjpeg($upload_image);
                    break;

                case 'png':
                    $source = imagecreatefrompng($upload_image);
                    break;
                case 'gif':
                    $source = imagecreatefromgif($upload_image);
                    break;
                default:
                    $source = imagecreatefromjpeg($upload_image);
            }

            imagecopyresized($thumb_create,$source,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
            switch($file_ext){
                case 'jpg' || 'jpeg':
                    imagejpeg($thumb_create,$thumbnail,100);
                    break;
                case 'png':
                    imagepng($thumb_create,$thumbnail,100);
                    break;

                case 'gif':
                    imagegif($thumb_create,$thumbnail,100);
                    break;
                default:
                    imagejpeg($thumb_create,$thumbnail,100);
            }

        }

        return $fileName;
    }
    else
    {
        return false;
    }
}?>






<?php 

if(!empty($_FILES['fileToUpload']['name'])){
    
    //call thumbnail creation function and store thumbnail name
    $upload_img = cwUpload('fileToUpload','images/cat/','',TRUE,'images/cat/thumb/','200','160');
    
    //full path of the thumbnail image
    $thumb_src = 'images/cat/thumb/'.$upload_img;
    
    //set success and error messages
    $message = $upload_img?"<span style='color:#008000;'>Image thumbnail have been created successfully.</span>":"<span style='color:#F00000;'>Some error occurred, please try again.</span>";
    
}else{
    
    //if form is not submitted, below variable should be blank
    $thumb_src = '';
    $message = '';
}
 
?>


<?php if($thumb_src != ''){ ?>
<img src="<?php echo $thumb_src; ?>" alt="">
<?php } ?>

















<?php
include('config.php');



$catid=$_POST['rd'];
//$catid=$_POST['catid'];

$cname=mysql_real_escape_string($_POST['cname']);
try{  

$chkqr=mysql_query("select * from main_cat where name='".$cname."' and under='".$catid."'");
//echo "select * from main_cat where name='".$cname."' and under='".$catid."'";
$chknrws=mysql_num_rows($chkqr);

if($chknrws==0 )
{
			  $qry="insert into main_cat(name,under,cat_img) values('".mysql_real_escape_string($cname)."','".$catid."','".$thumb_src."')";

//echo $qry;
			  $res=mysql_query($qry);

                if($res){
                      //echo 1;
                      echo '<script language="javascript">'.'alert("Category added successfully")'.'</script>';

                    echo '<script language="javascript">'.'window.open("cattrtest.php", "_self")'.'</script>';

				}

                  else
{
    //echo 0;
      echo '<script language="javascript">'.'alert("Error")'.'</script>';
      echo '<script language="javascript">'.'window.open("cattrtest.php", "_self")'.'</script>';

    
}
}else
{     echo '<script language="javascript">'.'alert("Category alredy exists")'.'</script>';
      echo '<script language="javascript">'.'window.open("cattrtest.php", "_self")'.'</script>';
    //echo 10;
}
                          }catch(Exception $e)

                           {

                           //  echo 'Message: ' .$e->getMessage();
      //echo 20;
       echo '<script language="javascript">'.'alert("Exception occured")'.'</script>';
       echo '<script language="javascript">'.'window.open("cattrtest.php", "_self")'.'</script>';
    
                           }

?>











