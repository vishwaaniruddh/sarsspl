<?php
session_start();

if(!isset($_SESSION['user']))
echo "<script type='text/javascript'>alert('Sorry Your session has Expired, You need to login Again');window.location='index.php';</script>";
else{

include("config.php");
$cnt=$_POST['matcnt'];
$mat=array();
$rate=array();
$qty=array();
$id=array();
$stat=0;
$tot=0;
$str='';
$errors2=0;
$photo_name2=$_POST['userfile2'];
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
$mem2='';
$asst=array();
$suprt=array();
$remmm=array();
$suptot=0;
for($i=0;$i<$cnt;$i++)
{
if(isset($_POST['material'][$i]) && $_POST['material'][$i]!='')
{
$id[]=$_POST['id'][$i];

$mem2.="\n***###Component-".$asst[]=$_POST['asst'][$i];
 $mem2.="\nWork-".$mat[]=$_POST['material'][$i];
$mem2.="\nRate-".$rate[]=$_POST['rate'][$i];

 $mem2.="\nQuantity-".$qty[]=$_POST['qty'][$i];
 $mem2.=" ".$unit[]=$_POST['unit'][$i];
 if(isset($_POST['suprate'][$i]))
 $mem2.="\nSup Rate-".$suprt[]=$_POST['suprate'][$i];
$tot=$tot+(($_POST['rate'][$i])*($_POST['qty'][$i]));
$suptot=$suptot+(($_POST['suprate'][$i])*($_POST['qty'][$i]));
$mem2.="\nRemark-".$remmm[]=$_POST['remmm'][$i];
$stat=$stat+1;
}
}
if($stat>0)
{
$quotid=$_POST['quot'];
$sub=str_replace("'","\'",$_POST['subject']);

for($i=0;$i<$stat;$i++)
{
//echo "update `quot_details` set `rate`='".$rate[$i]."' where quotdetid='".$id[$i]."'<br>";
$qry=mysqli_query($con,"update `quot_details` set `rate`='".$rate[$i]."',qty='".$qty[$i]."',unit='".$unit[$i]."',material='".$mat[$i]."',suprate='".$suprt[$i]."',remark='".$remmm[$i]."' where quotdetid='".$id[$i]."'");
}
//if($_POST['po']=='')

$stt='20';
//else
//$stt='3';
$memo=str_replace("'","\'",$_POST['memo']);
$mem2.="\nTotal-".$tot;
if($_SESSION['designation']>='8')
$memo=$memo." ".$mem2;
$ins2=mysqli_query($con,"INSERT INTO `quotapproval` (`appid`, `quotid`, `appby`, `apptime`, `remarks`, `level`, `status`) VALUES (NULL, '".$quotid."', '".$_SESSION['user']."', Now(), '".$memo."', '".$_POST['upstat']."', '0')");
//echo "Update quotation set status='".$stt."',totalcost='".$tot."',materialcnt='".$stat."',approvalform='".$photo_name2."',mailperson='".$_POST['authn']."' where quotid='".$quotid."'";

$dis=$tot-$_POST['appamt'];
$clappdt="0000-00-00";

if($_POST['appdate'])
{
$clappdt=date("Y-m-d",strtotime(str_replace("/","-",$_POST['appdate'])));
}
//echo "Update quotation set status='".$stt."',totalcost='".$_POST['appamt']."',materialcnt='".$stat."',approvalform='".$photo_name2."',mailperson='".$_POST['authn']."',type='".$_POST['type']."',discount='".$dis."',reqamt='".$suptot."' where quotid='".$quotid."'";
if($_SESSION['designation']=='8')
$qq=",supervisor='".$_POST['super']."'";

//echo "Update quotation set status='".$_POST['upstat']."',totalcost='".$_POST['appamt']."',materialcnt='".$stat."',approvalform='".$photo_name2."',discount='".$dis."',reqamt='".$suptot."',clientappdate='".$clappdt."' ".$qq." where quotid='".$quotid."'";
$ins=mysqli_query($con,"Update quotation set status='".$_POST['upstat']."',totalcost='".$_POST['appamt']."',materialcnt='".$stat."',approvalform='".$photo_name2."',discount='".$dis."',reqamt='".$suptot."',clientappdate='".$clappdt."',mailperson='".$_POST['appcl']."' ".$qq." where quotid='".$quotid."'");

if($ins){
if($_FILES['userfile']['name']!='')
unlink("quotation/".$_POST['userfile2']);

$str="Data Entered Successfully";
}
else
$str="Some Error Occurred";
}
else
$str="No Material was Entered";
}



//$_SESSION['success']=$str;
header('location:viewquot2.php?success='.$str);
}
?>