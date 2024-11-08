<?php
include("config.php");
include("access.php");
$qotid=$_POST['quotid'];
$rem=$_POST['rem'];

$error=0;


$image_name='';
$maxsize='2140';
//$_FILES['email_cpy']['name'];
$size=($_FILES['email_cpy']['size']/1024);

if($_FILES['email_cpy']['name']!=''){
//echo $size." *** ".$maxsize;
if($size>$maxsize)
{

echo "Your file size is ".$size."File is too large to be uploaded. You can only upload ".$maxsize." KB of data. Please go back and try again";
$error++;
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
$newname="../operations/quotuploads/cancel/".$image_name;
	//echo $newname;	
	
$copied = copy($_FILES['email_cpy']['tmp_name'], $newname);


if (!$copied) 
{
	echo "<h1>Copy unsuccessfull!</h1>";
		$error++;
}
}

//echo $newname;

}


}




$dt=date('Y-m-d H:i:s');
$srqry=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
			$srno=mysqli_fetch_array($srqry);
	
	
	
			
mysqli_query($con,"BEGIN");
			
			
	$insqry=mysqli_query($con,"INSERT INTO `cancelled_quotation`(`qid`,`remark`, `reqby`, `cancdate`,filename) VALUES ('".$qotid."','".$rem."','".$srno[0]."','".$dt."','".$image_name."')")	;	
   if(!$insqry)
   { 
     $error++;
    }
       $upqry=mysqli_query($con,"Update  `quotation1` set status='c' where id='".$qotid."' ")	;	
if(!$upqry)
   { 
     $error++;
    }

if($error==0)
{
mysqli_query($con,"COMMIT");
echo "Quotation No-".$qotid." "."Cancelled";
}
else
{
mysqli_query($con,"ROLLBACK");
echo "Error";

}
?>