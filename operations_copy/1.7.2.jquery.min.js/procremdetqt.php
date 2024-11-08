<?php
session_start();

if(!isset($_SESSION['user']))
echo "<script type='text/javascript'>alert('Sorry Your session has Expired, You need to login Again');window.location='index.php';</script>";
else{
include("config.php");

$str='';
$errors2=0;
$photoname2='';
//echo $_FILES['userfile']['name'];
//echo $_FILES['hoverfrm']['name'];
define ("MAX_SIZE","3000");
function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
if(isset($_FILES['userfile']['name']) && $_FILES['userfile']['name']!='')
{
 $photo2=$_FILES['userfile']['name']; 
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
	//echo "hi";
 	//get the original name of the file from the clients machine
 		$filename2 = stripslashes($photo2); //echo $filename;
 	//get the extension of the file in a lower case format
  		$extension2 = getExtension($filename2);
 		 $extension2 = strtolower($extension2);
 	//if it is not a known extension, we will suppose it is an error and will not  upload the file,  
	//otherwise we will do more tests
 if (($extension2 != "xls") && ($extension2 != "csv") && ($extension2 != "doc") && ($extension2 != "docx") && ($extension2 != "txt") && ($extension2 != "eml") && ($extension2 != "msg")) 
 		{
		//print error message
 		$str= '<h1>Unknown extension!</h1>';
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
$newname2="quotation/".$photo_name2;
//echo $newname;
//we verify if the image has been uploaded, and print error instead
$copied2 = copy($_FILES['userfile']['tmp_name'],$newname2);

if (!$copied2) 
{
 $str= '<h1>Copy unsuccessfull!</h1>';
	$errors2=1;
}}
//echo $newname;


}
}

if($errors2=='0'){
$quot=mysqli_query($con,"select rate,qty,quotid from quot_details where quotdetid='".$_POST['quot']."'");
$quotro=mysqli_fetch_row($quot);
$cst=$quotro[0]*$quotro[1];
$quotid=$_POST['quot'];
$sub=str_replace("'","\'",$_POST['subject']);

$rem=str_replace("'","\'",$_POST['memo']);
//echo "update `quot_details` set `rate`='".$rate[$i]."' where quotdetid='".$id[$i]."'<br>";
$qry=mysqli_query($con,"update `quot_details` set status='1',rejectappform='".$photo_name2."',upby='".$_SESSION['user']."',remark='".$rem."' where quotdetid='".$_POST['quot']."'");

if($qry)
{
$date=date('Y-m-d H:i:s');
$alrt=mysqli_query($con,"select alert_id from alert where quotdetid='".$_POST[2]."'");
$altro=mysqli_fetch_row($alrt);
$up=mysqli_query($con,"update quotation set totalcost=totalcost-".$cst.",materialcnt=(materialcnt-1) where quotid='".$quotro[2]."'");
//$alert=mysqli_query($con,"update alert set call_status=0,status=0 where quotdetid='".$_POST['quot']."'");
$feed=mysqli_query($con,"INSERT INTO `alert_updates` (`id`, `alert_id`, `up`, `update_time`, `branch`) VALUES (NULL, '".$altro[0]."', '".$_POST['memo']."', '".$date."', '".$_SESSION['user']."')");
$str="Data Entered Successfully";

}
else
$str="Some Error Occurred";

}



//$_SESSION['success']=$str;
header('location:viewquot2.php?success='.$str);
}
?>