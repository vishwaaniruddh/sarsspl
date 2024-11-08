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
  $atm=$_POST['atmid'];
 $localbranch=$_POST['localbranch'];
 $sitetype=$_POST['sitetype'];
 $siteid=$_POST['siteid'];
 $siteaddress=$_POST['siteaddress'];
 $state=$_POST['state'];
 $region=$_POST['region'];
 $city=$_POST['city'];
 $zone=$_POST['zone'];
 $location=$_POST['location'];
 $clsn=$_POST['clsn'];
 $clsp=$_POST['clsp'];
 $takeoverdate=$_POST['takeoverdate'];
 $remarks=$_POST['remarks'];
 $noatm=$_POST['noatm'];
 $phone=$_POST['phone'];
 $fire=$_POST['fire'];
 $exhaustfan=$_POST['exhaustfan'];
 $nobattery=$_POST['nobattery'];
 $stabilizer=$_POST['stabilizer'];
 $imuerter=$_POST['imuerter'];
 $dustbin=$_POST['dustbin'];
 $doormat=$_POST['doormat'];
 $chair=$_POST['chair'];
 $ac=$_POST['ac'];
 $idu=$_POST['idu'];
 $ups=$_POST['ups'];
 $otherdetails=$_POST['otherdetails'];
if(isset($_POST['checkbox1']))
{
 $check1="Y";
}
if(isset($_POST['checkbox2']))
{
 $check2="Y";
}
if(isset($_POST['checkbox3']))
{
$check3="Y";
}
if(isset($_POST['checkbox4']))
{
 $check4="Y";
 $ebill='Y';
}

$cust=mysqli_query($con,"select contact_first from contacts where short_name='".$cid."' and type='c'");
$custro=mysqli_fetch_row($cust);

$str222= "INSERT INTO `newtempsites` (`id`, `cust_id`, `cust_name`,`housekeeping`, `caretaker`, `maintenance`, `ebill`, `bank`, `csslocalbranch`, `zone`, `state`, `region`, `site_id`, `atm_id1`, `city`, `location`, `atmsite_address`, `site_type`, `takeover_date`, `handover_date`, `hsupervisor_name`, `super_contact`, `cust_remarks`, `active`, `project`,`upby`,`ebillstat`,`city_category`,`subcat`) VALUES (NULL, '".$cid."', '".$custro[0]."', '".$check2."', '".$check1."', '".$check3."', '".$check4."', '".$bank."','".$localbranch."', '".$zone."', '".$state."', '".$region."', '".$siteid."','".$atmid."','".$city."', '".$location."','".$siteaddress."','".$sitetype."',STR_TO_DATE('".$takeoverdate."','%d/%m/%Y'), '0000-00-00', '".$clsn."','".$clsp."', '".$remarks."','3', '".$project."', '".$_SESSION['user']."','3','".$_POST['citycat']."',,'".$_POST['subcat']."')";

//echo $str222."<br>";
$query=mysqli_query($con,$str222);
$insid=mysqli_insert_id();
$str333="INSERT INTO Takeoverform(customer,project,bank,atmid,caretaker,housekeeping,maintenance,ebill,localbranch,sitetype,siteid,siteaddress,state,region,city,zone,location,csslocalsupervisorname,csslocalsupervisornumber,takeoverdate,remarks,numberofatm,phone,ac,fire,exhaustfan,ups,numberofbattery,idu,stabilizer,imuerter,dustbin,doormat,chair,otherdetails,photo,tempid)VALUES('".$cid."','".$project."','".$bank."','".$atmid."','".$check1."','".$check2."','".$check3."','".$check4."','".$localbranch."','".$sitetype."','".$siteid."','".$siteaddress."','".$state."','".$region."','".$city."','".$zone."','".$location."','".$clsn."','".$clsp."',STR_TO_DATE('".$takeoverdate."','%d/%m/%Y'),'".$remarks."','".$noatm."','".$phone."','".$ac."','".$fire."','".$exhaustfan."','".$ups."','".$nobattery."','".$idu."','".$stabilizer."','".$imuerter."','".$dustbin."','".$doormat."','".$chair."','".$otherdetails."','".$image_name."','".$insid."')";
if($query)
{

//echo $str333;
$sql=mysqli_query($con,$str333);

if(!$sql)
echo "in query2 ".mysqli_error();
else
header('location:takeovernew.php');
}
else
echo "Some Error Occurred in query1 ".mysqli_error();
}
else
echo "Some Error Occurred ".mysqli_error();
}
?>