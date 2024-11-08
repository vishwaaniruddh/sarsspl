<?php
include('access.php');
include('config.php');
$agree2=$_POST['agree2'];
$agreement='';
$id=$_POST['id'];
$rem=str_replace("'","\'",$_POST['rem']);
if($_FILES['agree']['name']=='')
$agreement=$agree2;

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
if($_FILES['agree']['name']!='')
{
$photo=$_FILES['agree']['name']; 
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
$agreement=$photo_name1;
$time=$time+1;
//echo "TIME IS  :".time();
//the new name will be containing the full path where will be stored (images folder)
$newname="takeover_form/".$photo_name1;
//echo $newname;
//we verify if the image has been uploaded, and print error instead
$copied = copy($_FILES['agree']['tmp_name'],$newname);

if (!$copied) 
{
	echo '<h1>Copy unsuccessfull!</h1>';
	$errors=1;
}}
//echo $newname;


}
}
if($errors!='1')
{
$stat='1';
$ebill='1';

//echo "update newtempsites set bank='".$_POST['bank']."', csslocalbranch='".$_POST['local']."',site_id='".$_POST['siteid']."',state='".$_POST['state']."',city='".$_POST['city']."',atmsite_address='".$_POST['add']."',formpath='".$agreement."',project='".$_POST['project']."',takeover_date=STR_TO_DATE('".$_POST['tkdt']."','%d/%m/%Y'),active='".$stat."',ebillstat='".$ebill."' where id='".$id."'";
$ct='N';
$cttkdt='0000-00-00';
$hk='N';
$hktkdt='0000-00-00';
$rnm='N';
$rnmtkdt='0000-00-00';
$eb='N';
if(isset($_POST['ct']))
{
$ct='Y';
$cttkdt=date('Y-m-d',strtotime(str_replace('/','-',$_POST['cttkdt'])));
}
if(isset($_POST['hk']))
{
$hk='Y';
$hktkdt=date('Y-m-d',strtotime(str_replace('/','-',$_POST['hktkdt'])));
}
if(isset($_POST['rnm']))
{
$rnm='Y';
$rnmtkdt=date('Y-m-d',strtotime(str_replace('/','-',$_POST['rnmtkdt'])));
}
if(isset($_POST['eb']))
{
$eb='Y';
$ebtkdt=date('Y-m-d',strtotime(str_replace('/','-',$_POST['ebtkdt'])));
}

$str="update newtempsites set bank='".$_POST['bank']."',caretaker='".$ct."',takeover_date='".$cttkdt."',housekeeping='".$hk."',housekeeping_tkdt='".$hktkdt."',maintenance='".$rnm."',maintenance_tkdt='".$rnmtkdt."',csslocalbranch='".$_POST['local']."',site_id='".$_POST['siteid']."',state='".$_POST['state']."',city='".$_POST['city']."',atmsite_address='".$_POST['add']."',formpath='".$agreement."',project='".$_POST['project']."',active='".$stat."',ebillstat='".$ebill."',cust_remarks='".$rem."',ebill='".$eb."',ebill_tkdt='".$ebtkdt."' where id='".$id."'";

//echo $str;
$qry=mysqli_query($con,$str);
if($qry)
{
$u=mysqli_query($con,"UPDATE `Takeoverform` SET `bank`='".$_POST['bank']."',`caretaker`='".$ct."',`housekeeping`='".$hktkdt."',`maintenance`='".$rnm."',`ebill`='".$eb."',`localbranch`='".$_POST['local']."',`siteid`='".$_POST['siteid']."',`siteaddress`='".$_POST['add']."',`project`='".$_POST['project']."',`state`='".$_POST['state']."',`city`='".$_POST['city']."',`takeoverdate`='".$cttkdt."',`remarks`='".$rem."' WHERE `tempid`='".$id."'");
?>
<script type="text/javascript">
alert("site Updated Successfully");
window.close();
</script>
<?php
}
else
{
echo "Some Error Occurred. ".mysqli_error();
}
}
else
echo "Some Error while uploading the file";

?>