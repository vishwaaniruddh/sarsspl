<?php
include("config.php");
 $city=$_POST['city'];
 $area=$_POST['area'];
 $name=$_POST['name'];
 $cont=$_POST['cont'];
 $email=$_POST['email'];
 $fichier=$_FILES['resume']['name'];
$logid='';
/*require_once('class_files/insert.php');
$in_obj=new insert();
$in_obj->insert_into('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts','area_engg',array("engg_name","area","city","email_id","phone_no1"),array($name,$area,$city,$email,$cont));*/
if($fichier!='')
{
 define ("MAX_SIZE","100"); 
 
//$fichier=$_FILES['userfile']['name']; 

///echo $fichier;
 function getExtension($str)
		 {
		 	$i = strrpos($str,".");
			if (!$i) { return ""; }
			$l = strlen($str) - $i;
			$ext = substr($str,$i+1,$l);
			return $ext;
		 }
	
$errors=0;	

 $filename = stripslashes($_FILES['resume']['name']);

			//get the extension of the file in a lower case format
				 $extension = getExtension($filename);
				$extension = strtolower($extension);
				
				$image_name=time().date("d_m_y").'.'.$extension;
	if(!is_dir("eng_resume"))
	mkdir("eng_resume");			
$newname="eng_resume/".$image_name;
	//echo $newname;	
	
$copied = copy($_FILES['resume']['tmp_name'], $newname);

if (!$copied) 
{
	echo '<h1>Copy unsuccessfull!</h1>';
		$errors=1;
}

}
/*if($errors!=1)
{*/

$uname=explode(" ",$name);

$qr=mysqli_query($con,"select max(srno) from login");
$row=mysqli_fetch_row($qr);
//echo "<br>max id ".$row[0]." ".$uname[0];
$uid=$uname[0].($row[0]+1)."";

$q=mysqli_query($con,"INSERT INTO `login` (`srno`, `username`, `password`, `branch`, `designation`, `status`,`serviceauth`,`deptid`) VALUES (NULL, '".$uid."', '".$uid."123', '".$area."', '11', '1','3','4')");
$logid=mysqli_insert_id();
$qry=mysqli_query($con,"Insert into area_engg(`engg_name`,`area`,`city`,`email_id`,`phone_no1`,`resume`,`loginid`) Values('".$name."','".$area."','".$city."','".$email."','".$cont."','".$newname."','".$logid."')");
//echo "<br>INSERT INTO `satyavan_accounts`.`login` (`srno`, `username`, `password`, `branch`, `designation`, `status`) VALUES (NULL, '".$uid."', '".$uid."123', '".$area."', '4', '0')";
//echo "<br>Insert into area_engg(`engg_name`,`area`,`city`,`email_id`,`phone_no1`,`resume`,`loginid`) Values('".$name."','".$area."','".$city."','".$email."','".$cont."','".$newname."','".$logid."')";
if($qry)
{
	header('Location:view_areaeng.php');
}
else
echo "Error Creating Area Engineer";
//}

?>