<?php
session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Your Session has Expired'); window.close();</script>";
}
else
{
	include('config.php');
	$errors=0;
	$image_name='';
	$maxsize='2140';
	//$_FILES['email_cpy']['name'];
	$size=($_FILES['email_cpy']['size']/1024);
	
	if($_FILES['email_cpy']!=''){
	//echo $size." *** ".$maxsize;
	if($size>$maxsize)
	{
	echo "Your file size is ".$size;
	echo "<br/>File is too large to be uploaded. You can only upload ".$maxsize." KB of data. Please go back and try again";
	$errors=1;
	}
	else
	{
	
	define ("MAX_SIZE","100"); 
	
	$fichier=$_FILES['email_cpy']['name']; 
	
	//echo $fichier;
	function getExtension1($str)
	{
	$i = strrpos($str,".");
	if (!$i) { return ""; }
	$l = strlen($str) - $i;
	$ext = substr($str,$i+1,$l);
	return $ext;
	}
	
	//echo $fichier;
	if($fichier){
	//echo "hi" ;
	$filename = stripslashes($_FILES['email_cpy']['name']);
	//echo $filename;
	//get the extension of the file in a lower case format
	$extension = getExtension1($filename);
	$extension = strtolower($extension);
	//echo $extension;
	$image_name=time().'.'.$extension;
	//echo $image_name;
	$newname="../operations/ebemailcpy/".$image_name;
	//echo $newname;	
	
	$copied = copy($_FILES['email_cpy']['tmp_name'], $newname);
	
	
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
					if($_FILES['email_cpy']['name']!='')
					$scan=mysqli_query($con,"INSERT INTO `ebillemailcpy` (`reqid`, `copy`) VALUES ('".$_REQUEST['reqid']."', '".$image_name."')");
					if($scan)
					{
						$_SESSION['success']="Email Attached successfully.";
					}
					else
					{
						unlink($newname);
						$_SESSION['success']="Problem in attaching email please try again.";
					}
					echo "<script type='text/javascript'>alert('".$_SESSION['success']."');window.location='ebillreqapprovals.php';</script>";
	}
	else
	{
		echo "<br/><button><a href=\"ebillreqapprovals.php\">Back</a></button>";
	}
}

?>