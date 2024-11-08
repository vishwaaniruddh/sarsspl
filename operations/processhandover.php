<?php
include("config.php");

$errors2=0;
//echo $_FILES['hoverfrm']['name'];
define ("MAX_SIZE","3000");
function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
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
	//echo "hi";
 	//get the original name of the file from the clients machine
 		$filename2 = stripslashes($photo2); //echo $filename;
 	//get the extension of the file in a lower case format
  		$extension2 = getExtension($filename2);
 		 $extension2 = strtolower($extension2);
 	//if it is not a known extension, we will suppose it is an error and will not  upload the file,  
	//otherwise we will do more tests
 if (($extension2 != "jpg") && ($extension2 != "jpeg") && ($extension2 != "png") && ($extension2 != "gif") && ($extension2 != "docx") && $extension2 != "xls" && $extension2 != "txt" && $extension2 != "msg" && $extension2 != "eml") 
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
if($errors2!='1')
{
//echo "hi";
$cid=$_POST['cid'];
$cttkdt='0000-00-00';
$cthodt='0000-00-00';
$hktkdt='0000-00-00';
$hkhodt='0000-00-00';
$rnmhodt='0000-00-00';
$rnmtkdt='0000-00-00';
$ebhodt='0000-00-00';
$ebtkdt='0000-00-00';
$qry=mysqli_query($con,"select takeover_date,housekeeping_tkdt,maintenance_tkdt,caretaker,maintenance,housekeeping,ebill from ".$cid."_sites where trackerid='".$_POST['track']."'");
$ro=mysqli_fetch_row($qry);
if($ro[3]=='Y')
{
$cttkdt=$ro[0];
$cthodt=date('Y-m-d',strtotime(str_replace("/","-",$_POST['hoverdt'])));
}
if($ro[4]=='Y')
{
$rnmtkdt=$ro[2];
$rnmhodt=date('Y-m-d',strtotime(str_replace("/","-",$_POST['hoverdt'])));
}
if($ro[5]=='Y')
{
$hktkdt=$ro[1];
$hkhodt=date('Y-m-d',strtotime(str_replace("/","-",$_POST['hoverdt'])));
}
$cnt=0;
$frm='';
$qry2=mysqli_query($con,"select takeoverfrm,service from takeoversites where trackerid='".$_POST['track']."' and cid='".$cid."'");
while($ro2=mysqli_fetch_row($qry2))
{
if($cnt==0)
{
$frm=$frm.",".$ro2[0];
}
if($ro2=='ebill')
{
$ebtkdt=date("Y-m-d",strtotime($ro2[3]));
$ebhodt=date('Y-m-d',strtotime(str_replace("/","-",$_POST['hoverdt'])));
//$mst=mysqli_query($con,"update mastersites set handoverdt='".$ebhodt."' where cust_id='".$cid."' and trackerid='".$_POST['track']."'");
}

}
//echo "INSERT INTO `handoversites` (`id`, `cid`, `takeoverdt`, `handoverdt`, `handoverform`, `atmid`, `takeoverform`,trackerid,housekeeping_tkdt,housekeeping_hodt,maintenance_tkdt,maintenance_hodt,ebill_tkdt,ebill_hodt) VALUES (NULL, '".$_POST['cid']."', '".$cttkdt."', '".$cthodt."', '".$photo_name2."', '".$_POST['atmid']."', '".$ro2[0]."','".$_POST['track']."','".$hktkdt."','".$hkhodt."','".$rnmtkdt."','".$rnmhodt."','".$ebtkdt."','".$ebhodt."')";
$ins=mysqli_query($con,"INSERT INTO `handoversites` (`id`, `cid`, `takeoverdt`, `handoverdt`, `handoverform`, `atmid`, `takeoverform`,trackerid,housekeeping_tkdt,housekeeping_hodt,maintenance_tkdt,maintenance_hodt,ebill_tkdt,ebill_hodt) VALUES (NULL, '".$_POST['cid']."', '".$cttkdt."', '".$cthodt."', '".$photo_name2."', '".$_POST['atmid']."', '".$ro2[0]."','".$_POST['track']."','".$hktkdt."','".$hkhodt."','".$rnmtkdt."','".$rnmhodt."','".$ebtkdt."','".$ebhodt."')");
if(!$ins)
echo mysqli_error();
if($ins)
{

$del=mysqli_query($con,"Delete from takeoversites where trackerid='".$_POST['track']."'");

//echo "Update ".$cid."_sites set handover_date='".$cthodt."',housekeeping_hodt='".$hkhodt."',maintenance_hodt='".$rnmhodt."' where trackerid='".$_POST['track']."'";
$up=mysqli_query($con,"Update ".$cid."_sites set handover_date='".$cthodt."',housekeeping_hodt='".$hkhodt."',maintenance_hodt='".$rnmhodt."' where trackerid='".$_POST['track']."'");
if($ro[6]=='Y')
{
$strr='';

$st=mysqli_query($con,"Select takeoverdt,handoverdt from mastersites where trackerid='".$_POST['track']."' and cust_id='".$cid."'");
$stro=mysqli_fetch_row($st);

if($stro[0]=='0000-00-00')
$strr.=" takeoverdt=".$cttkdt.",";
$mast=mysqli_query($con,"update mastersites set ".$strr." handoverdt=STR_TO_DATE('".$_POST['hoverdt']."','%d/%m/%Y') where trackerid='".$_POST['track']."' and cust_id='".$cid."'");
}
if($up)
header('location:view_site.php');
else
echo "Some Error Occurred".mysqli_error();
}
else
echo "Some Error Occurred. ".mysqli_error();

}

?>