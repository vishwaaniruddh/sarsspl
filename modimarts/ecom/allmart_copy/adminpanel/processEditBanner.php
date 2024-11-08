<?php
session_start();
include('config.php');

$oldimg = $_POST['oldimg'];
$id=$_POST['id'];
$pos=$_POST['pos'];
$cid=$_POST['cid'];
          //  echo " ".$code."-".$cname."-".$key;            
$uplpth=$ocimagepath."catalog/demo/slider2/";

 define ("MAX_SIZE","100"); 

//This function reads the extension of the file. It is used to determine if the file  is an image by checking the extension.
 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }

//This variable is used as a flag. The value is initialized with 0 (meaning no error  found)  
//and it will be changed to 1 if an errro occures.  
//If the error occures the file will not be uploaded.
 $errors=0;
//checks if the form has been submitted
 if(isset($_POST['Submit'])) 
 {
 	//reads the name of the file the user submitted for uploading
 	$image=$_FILES['image']['name'];
 	//if it is not empty
 	if ($image) 
 	{// echo $image;
 	//get the original name of the file from the clients machine
 		$filename = stripslashes($_FILES['image']['name']);
 	//get the extension of the file in a lower case format
  		$extension = getExtension($filename);
 		$extension = strtolower($extension);
 	//if it is not a known extension, we will suppose it is an error and will not  upload the file,  
	//otherwise we will do more tests
 if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
 		{
		//print error message
 			echo '<h1>Unknown extension!</h1>';
 			$errors=1;
 		}
 		else
 		{
//get the size of the image in bytes
 //$_FILES['image']['tmp_name'] is the temporary filename of the file
 //in which the uploaded file was stored on the server
 $size=filesize($_FILES['image']['tmp_name']);

$image_name=time().'.'.$extension;
$newname=$uplpth.$image_name;
$path="catalog/demo/slider2/".$image_name;
//$newname=$mainpath."banners/".$image_name;
//we verify if the image has been uploaded, and print error instead

$copied = copy($_FILES['image']['tmp_name'], $newname);
if (!$copied) 
{
	echo '<h1>Copy unsuccessfull!</h1>';
	$errors=1;
}}}else { $path=$oldimg;} }

	   if(isset($_POST['Submit']) && !$errors) 
 {


 				  $qry="update oc_pavosliderlayers set image='".$path."',position='".$pos."' where id='$id'";
//echo $qry;
			  $res=mysqli_query($con3,$qry);
			  
			    $curr_dt=date('Y-m-d H:i:s');
	$subAdminWork=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','Edit','Edit Carousel Slider Image','".$curr_dt."','".$_SESSION['lastSubID']."','". $id." ','oc_pavosliderlayers') ");
		
			  
			  
                if($res!="")
		 
header('location:viewBanners.php');
 //('location:viewBanners.php?pos='.$pos);
 	
                  else
                 
echo "Error Occured";
  
 	
 }?>
