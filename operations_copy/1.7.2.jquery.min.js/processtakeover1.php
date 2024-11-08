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
  $atm2=$_POST['atmid2'];
 $localbranch=$_POST['localbranch'];
 $sitetype=$_POST['sitetype'];
 $siteid=$_POST['siteid'];
  $siteaddress=str_replace("'","",$_POST['siteaddress']);
 $state=$_POST['state'];
 $region=$_POST['region'];
 $city=$_POST['city'];
 $zone=$_POST['zone'];
 $location=str_replace("'","",$_POST['location']);
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
$atmid=$_POST['atmid'];
 $atmid2=$_POST['atmid2'];
 $otherdetails=$_POST['otherdetails'];
 $cttkdt='0000-00-00';

$hktkdt='0000-00-00';
$ebtkdt='0000-00-00';

$rnmtkdt='0000-00-00';
if(isset($_POST['checkbox1']))
{
 $check1="Y";
 $cttkdt=date('Y-m-d',strtotime(str_replace("/","-",$takeoverdate)));
}
if(isset($_POST['checkbox2']))
{
$hktkdt=date('Y-m-d',strtotime(str_replace("/","-",$takeoverdate)));
 $check2="Y";
}
if(isset($_POST['checkbox3']))
{
$rnmtkdt=date('Y-m-d',strtotime(str_replace("/","-",$takeoverdate)));
$check3="Y";
}

if(isset($_POST['checkbox4']))
{
 $check4="Y";
 $ebill='Y';
 $ebtkdt=date('Y-m-d',strtotime(str_replace("/","-",$takeoverdate)));
}
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

$str222= "INSERT INTO `newtempsites` (`id`, `cust_id`, `cust_name`,`housekeeping`, `caretaker`, `maintenance`, `ebill`, `bank`, `csslocalbranch`, `zone`, `state`, `region`, `site_id`, `atm_id1`, `city`, `location`, `atmsite_address`, `site_type`, `takeover_date`, `handover_date`, `hsupervisor_name`, `super_contact`, `cust_remarks`, `active`, `project`,`upby`,`ebillstat`,`atm_id2`,`city_category`,`subcat`,`housekeeping_tkdt`,`maintenance_tkdt`,ebill_tkdt) VALUES (NULL, '".$cid."', '".$custro[0]."', '".$check2."', '".$check1."', '".$check3."', '".$check4."', '".$bank."','".$localbranch."', '".$zone."', '".$state."', '".$region."', '".$siteid."','".$_POST['atmid']."','".$city."', '".$location."','".$siteaddress."','".$sitetype."','".$cttkdt."', '0000-00-00', '".$clsn."','".$clsp."', '".$remarks."','".$stttt."', '".$project."', '".$_SESSION['user']."','".$ebst."','".$atmid2."','".$_POST['citycat']."','".$_POST['subcat']."','".$hktkdt."','".$rnmtkdt."','".$ebtkdt."')";

//echo $str222."<br>";
$query=mysqli_query($con,$str222);
if(!$query)
echo mysqli_error();
$insid=mysqli_insert_id();
if(isset($_POST['checkbox4']))
{
 $cons=mysqli_query($con,"INSERT INTO `tempebill` ( `Consumer_No`, `Distributor`, `ATM_ID`, `landlord`, `custid`,  `meter_no`, `tempid`) VALUES ( '".$_POST['cons']."', '".$_POST['dist']."', '".$atmid."', '".$land."', '".$cid."', '".$_POST['meter']."',  '".$insid."')");
}

$str333="INSERT INTO Takeoverform(customer,project,bank,atmid,caretaker,housekeeping,maintenance,ebill,localbranch,sitetype,siteid,siteaddress,state,region,city,zone,location,csslocalsupervisorname,csslocalsupervisornumber,takeoverdate,remarks,numberofatm,phone,ac,fire,exhaustfan,ups,numberofbattery,idu,stabilizer,imuerter,dustbin,doormat,chair,otherdetails,photo,tempid,`atm_id2`)VALUES('".$cid."','".$project."','".$bank."','".$_POST['atmid']."','".$check1."','".$check2."','".$check3."','".$check4."','".$localbranch."','".$sitetype."','".$siteid."','".$siteaddress."','".$state."','".$region."','".$city."','".$zone."','".$location."','".$clsn."','".$clsp."',STR_TO_DATE('".$takeoverdate."','%d/%m/%Y'),'".$remarks."','".$noatm."','".$phone."','".$ac."','".$fire."','".$exhaustfan."','".$ups."','".$nobattery."','".$idu."','".$stabilizer."','".$imuerter."','".$dustbin."','".$doormat."','".$chair."','".$otherdetails."','".$image_name."','".$insid."','".$atmid2."')";
if($query)
{

//echo $str333;
$sql=mysqli_query($con,$str333);

if(!$sql)
echo "in query2 ".mysqli_error();
else
echo "<script type='text/javascript'>alert('Site Entered Successfully');window.location='takeovernew.php'</script>";
//header('location:takeovernew.php?id=1');
}
else
echo "Some Error Occurred in query1 ".mysqli_error();
}
else
echo "Some Error Occurred ".mysqli_error();
}
?>