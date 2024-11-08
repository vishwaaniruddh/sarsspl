<?php 
session_start();
function cwUpload($field_name = '', $target_folder = '', $file_name = '', $thumb = FALSE, $thumb_folder = '', $thumb_width = '', $thumb_height = ''){

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
<!--
<?php if($thumb_src != ''){ ?>
<img src="<?php echo $thumb_src; ?>" alt="">
<?php } ?>
-->
<?php
include('config.php');
//var_dump($_POST);exit;
$catid=$_POST['rd'];
//$catid=$_POST['catid'];
//============== code for get category under (0) ============
$basecat=$_POST['basecat'];
$strr="";
if($basecat!="")
{
	$sqlbrdcr = mysql_query("select * from main_cat where id ='".$basecat."' order by name");
//	echo "select * from main_cat where id ='".$basecat."' order by name";
		$fbrws=mysql_fetch_array($sqlbrdcr);
		if($fbrws['under']=="0")
		{
		    //echo "ok";
		    $strr=$fbrws['id'];
		}else
		{
		    $exs=0;
		    $idbrdcrmbarr=array();
		   $iddbr=$fbrws['id'];
		   while($exs==0)
		   {
		      //echo "select * from main_cat where id ='".$iddbr."'";
		       	$sqlbrdcr2 = mysql_query("select * from main_cat where id ='".$iddbr."' order by name");
		       	
		     //  	echo "select * from main_cat where id ='".$iddbr."' order by name";
		       	
	         	$fbrws2=mysql_fetch_array($sqlbrdcr2);
	         	//$idbrdcrmbarr[]=$iddbr;
	         	array_unshift($idbrdcrmbarr, $iddbr);
	         	if($fbrws2['under']=="0")
	         	{
	         	 $iddbr="0";
	         	    	$exs=1;
	         	    	break;
	         	}else
	         	{
	         	 $iddbr= $fbrws2['under'];  
	         	}
		   }
		    //print_r($idbrdcrmbarr);
		}
	
		for($c=0;$c<count($idbrdcrmbarr);$c++)
		{
	    	$sqlbrdcr23 = mysql_query("select * from main_cat where id ='".$idbrdcrmbarr[$c]."' order by name");
         	$fbrws23=mysql_fetch_array($sqlbrdcr23);
         	
         	if($strr==""){
         	$strr=$fbrws23['id'];
         	echo "hiii".$strr;
         	} else{
     	        //  $strr=$strr."->".$fbrws23['id'];
     	    }
		}
}


//=======================================================


$cname=mysql_real_escape_string($_POST['cname']);
try{  

$chkqr=mysql_query("select * from main_cat where name='".$cname."' and under='".$catid."'");
//echo "select * from main_cat where name='".$cname."' and under='".$catid."'";
$chknrws=mysql_num_rows($chkqr);

if($chknrws==0 )
{
	$qry="insert into main_cat(name,under,cat_img,base_cat) values('".mysql_real_escape_string($cname)."','".$catid."','".$thumb_src."','".$strr."')";
	$res=mysql_query($qry);
    $base=mysql_insert_id();

$curr_dt=date('Y-m-d H:i:s');
	$subAdminWork=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','Add','Add Category In Category Table','".$curr_dt."','".$_SESSION['lastSubID']."','". $base." ','main_cat') ");
		
	


$chk=mysql_query("select * from main_cat where id='".$base."'");
$fetchchk=mysql_fetch_array($chk);

if($fetchchk['under']==0){
$updateBasecat=mysql_query("update main_cat set base_cat='".$base."' where id='".$base."'");
}


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











