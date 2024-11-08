<?php
session_start();
include("config.php");
$check1="N";
$check2="N";
$check3="N";
$check4="N";
$ebill='N';



if(isset($_POST['submit']))
{
$error=0;
$image_name='';
$maxsize='2140';
//$_FILES['userfile']['name'];
$size=($_FILES['userfile']['size']/1024);

if($_FILES['userfile']!=''){
//echo $size." *** ".$maxsize;
if($size>$maxsize)
{
echo "Your file size is ".$size;
echo "File is too large to be uploaded. You can only upload ".$maxsize." KB of data. Please go back and try again";
}
else
{

 define ("MAX_SIZE","100"); 
 
$fichier=$_FILES['userfile']['name']; 

///echo $fichier;
 function getExtension($str)
		 {
		 	$i = strrpos($str,".");
			if (!$i) { return ""; }
			$l = strlen($str) - $i;
			$ext = substr($str,$i+1,$l);
			return $ext;
		 }
	
	
if($fichier){
	 
$filename = stripslashes($_FILES['userfile']['name']);

			//get the extension of the file in a lower case format
				$extension = getExtension($filename);
				$extension = strtolower($extension);
				
				$image_name=time().'.'.$extension;
				
$newname="sitepic/".$image_name;
	//echo $newname;	
	
$copied = copy($_FILES['userfile']['tmp_name'], $newname);


if (!$copied) 
{
	echo '<h1>Copy unsuccessfull!</h1>';
		$errors=1;
}
}

//echo $newname;

}
}
//echo $errors;
if($errors==0)
{
 $cid=$_POST['cid'];
 $project=$_POST['project'];
 $bank=$_POST['bank'];
  $atmid=$_POST['atmid'];
 $localbranch=$_POST['localbranch'];
 $sitetype=$_POST['sitetype'];
 $siteid=$_POST['siteid'];
 $siteaddress=$_POST['siteaddress'];
 $state=$_POST['state'];
 $region=$_POST['region'];
 $city=$_POST['city'];
 $zone=$_POST['zone'];
 $location=$_POST['location'];

 $takeoverdate=$_POST['takeoverdate'];
 $remarks=$_POST['remarks'];
 
 $atmid2=$_POST['atmid2'];
 $otherdetails=$_POST['otherdetails'];
 
 $cttkdt=date('Y-m-d',strtotime(str_replace("/","-",$takeoverdate)));

$stttt='0';
$ebst='0';
if($_SESSION['designation']=='8')
{
$stttt='2';
$ebst='2';

}

if($takeoverdate!='')
$stttt='1';
$cust=mysqli_query($con,"select contact_first from contacts where short_name='".$cid."' and type='c'");
$custro=mysqli_fetch_row($cust);

$str222= "INSERT INTO `rnmsites` (`id`, `cust_id`, `cust_name`, `bank`, `csslocalbranch`, `zone`, `state`, `region`, `site_id`, `atm_id1`, `city`, `location`, `atmsite_address`, `site_type`, `takeover_date`,  `cust_remarks`, `active`, `project`,`upby`,`atm_id2`) VALUES (NULL, '".$cid."', '".$custro[0]."',  '".$bank."','".$localbranch."', '".$zone."', '".$state."', '".$region."', '".$siteid."','".$atmid."','".$city."', '".$location."','".$siteaddress."','".$sitetype."','".$cttkdt."',  '".$remarks."','".$stttt."', '".$project."', '".$_SESSION['user']."','".$atmid2."')";

//echo $str222."<br>";
$query=mysqli_query($con,$str222);
if(!$query)
echo mysqli_error();
$insid=mysqli_insert_id();

if($query)
{

//echo $str333;
$sql=mysqli_query($con,$str333);

header('location:newrnmsite.php?id=1');
}
else
echo "Some Error Occurred in query1 ".mysqli_error();
}
else
echo "Some Error Occurred ".mysqli_error();
}
?>