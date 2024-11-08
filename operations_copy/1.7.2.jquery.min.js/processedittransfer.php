<?php
if(isset($_POST['submit']))
{
include("config.php");
//$fcid=$_POST['fcid'];
$tcid=$_POST['tcid'];
$rem=str_replace("'","\'",$_POST['rem']);
$hoverdt=$_POST['hoverdt'];
$toverdt=$_POST['toverdt'];
$id=$_POST['transid'];
$handover='';
$takeover='';
 $errors2=0;
 $errors=0;
define ("MAX_SIZE","3000");
function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
if($_FILES['toverfrm']['name']!='')
{
$photo=$_FILES['toverfrm']['name']; 
//$old=$_POST['old'];

 
 
 //This variable is used as a flag. The value is initialized with 0 (meaning no error  found)  
//and it will be changed to 1 if an errro occures.  
//If the error occures the file will not be uploaded.
 $errors=0;
//checks if the form has been submitted
 $time = time();
 	//reads the name of the file the user submitted for uploading
 	

 	//if it is not empty
	//echo count($image1);
 	if (!$photo=="") 
 	{
 	//get the original name of the file from the clients machine
 		$filename = stripslashes($photo); //echo $filename;
 	//get the extension of the file in a lower case format
  		$extension = getExtension($filename);
 		$extension = strtolower($extension);
 	//if it is not a known extension, we will suppose it is an error and will not  upload the file,  
	//otherwise we will do more tests
 if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif") && ($extension != "docx") && $extension != "xls") 
 		{
		//print error message
 			echo '<h1>Unknown extension!</h1>';
 			$errors=1;
 		}
 		else
 		{

//we will give an unique name, for example the time in unix time format
$photo_name1=$time.'.'.$extension; //echo $image_name[$j];
$takeover=$photo_name1;
$time=$time+1;
//echo "TIME IS  :".time();
//the new name will be containing the full path where will be stored (images folder)
$newname="takeover_form/".$photo_name1;
//echo $newname;
//we verify if the image has been uploaded, and print error instead
$copied = copy($_FILES['toverfrm']['tmp_name'],$newname);

if (!$copied) 
{
	echo '<h1>Copy unsuccessfull!</h1>';
	$errors=1;
}}
//echo $newname;


}
}
if($_FILES['hoverfrm']['name']!='')
{
$photo2=$_FILES['hoverfrm']['name']; 
//$old=$_POST['old'];
//define ("MAX_SIZE","3000");
 
 
 //This variable is used as a flag. The value is initialized with 0 (meaning no error  found)  
//and it will be changed to 1 if an errro occures.  
//If the error occures the file will not be uploaded.

//checks if the form has been submitted
 $time2 = time();
 	//reads the name of the file the user submitted for uploading
 	

 	//if it is not empty
	//echo count($image1);
 	if (!$photo2=="") 
 	{
 	//get the original name of the file from the clients machine
 		$filename2 = stripslashes($photo2); //echo $filename;
 	//get the extension of the file in a lower case format
  		$extension2 = getExtension($filename2);
 		$extension2 = strtolower($extension2);
 	//if it is not a known extension, we will suppose it is an error and will not  upload the file,  
	//otherwise we will do more tests
 if (($extension2 != "jpg") && ($extension2 != "jpeg") && ($extension2 != "png") && ($extension2 != "gif") && ($extension2 != "docx") && $extension2 != "xls") 
 		{
		//print error message
 			echo '<h1>Unknown extension!</h1>';
 			$errors2=1;
 		}
 		else
 		{

//we will give an unique name, for example the time in unix time format
$photo_name2=($time2+1).'.'.$extension2; //echo $image_name[$j];
$handover=$photo_name2;
$time2=$time2+1;
//echo "TIME IS  :".time();
//the new name will be containing the full path where will be stored (images folder)
$newname2="handover_form/".$photo_name2;
//echo $newname;
//we verify if the image has been uploaded, and print error instead
$copied2 = copy($_FILES['hoverfrm']['tmp_name'],$newname2);

if (!$copied2) 
{
//	echo '<h1>Copy unsuccessfull!</h1>';
	$errors2=1;
}}
//echo $newname;


}
}
if($errors!='1' && $errors2!='1')
{
if($_FILES['toverfrm']['name']=='')
$takeover=$_POST['toverfrm2'];
else
{
if($_POST['toverfrm2']!='')
unlink("takeover_form/".$_POST['toverfrm2']);

}

if($_FILES['hoverfrm']['name']=='')
$handover=$_POST['hoverfrm2'];
else
{
if($_POST['hoverfrm2']!='')
unlink("takeover_form/".$_POST['hoverfrm2']);

}
if($handover=='' || $takeover=='')
$stat=0;
else
$stat='1';
//echo "update `transfer_req` set `handoverdt`=STR_TO_DATE('".$hoverdt."','%d/%m/%Y'), `takeoverdt`=STR_TO_DATE('".$toverdt."','%d/%m/%Y'), `handoverform`='".$handover."', `takeoverform`='".$takeover."', `remarks`='".$rem."', `status`='1' where transferid='".$id."'";
$qry=mysqli_query($con,"update `transfer_req` set `handoverdt`=STR_TO_DATE('".$hoverdt."','%d/%m/%Y'), `takeoverdt`=STR_TO_DATE('".$toverdt."','%d/%m/%Y'), `handoverform`='".$handover."', `takeoverform`='".$takeover."', `remarks`='".$rem."', `status`='".$stat."' where transferid='".$id."'");
if($qry)
header('location:view_site.php?success=Transfer Details Edited Successfully.');
else
header('location:transfersite.php?error=Following Error Occurred.'.mysqli_error());
}
else
{
unlink("takeover_form/".$takeover);
unlink("handover_form/".$handover);

header('location:transfersite.php?error=Some Error occurred while uploading file');

}




}
?>