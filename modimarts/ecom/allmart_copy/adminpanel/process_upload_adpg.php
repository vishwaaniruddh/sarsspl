<?php
session_start();
include('config.php');
//include('access.php');

$id=$_POST['id'];
$errors=0;

$fdt=$_POST["fdt"];
$tdt=$_POST["tdt"];
$dur=$_POST["duration"];
$desc=$_POST["desc"];
$name=$_POST["name"];
//echo "duration"." ".$duration;
$errormsg=1;

/* Ruchi : 12dec19 : print_r($_POST);*/
$avdts=$_POST["availdtsarr[]"];
$requiredslot=$_POST["availdtslotreqcnt[]"];

$chkslotexs=0;
for($a=0;$a<count($avdts);$a++)
{
    echo $avdts[$a];
}

/*$image=$_FILES['img0']['name'];
	 //$qcnt= count($image); 

function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
$nwyr=date('Y');
$nwdt=date('m');
$pth="videoads/".$nwyr."/".$nwdt."/";
//echo $pth;
if (!file_exists("../".$pth)) {
//echo "doesnt exist";
   mkdir("../".$pth, 0755, true);
}
		
 echo $image; 
 $extension1=getExtension($image);
 if($extension1!="mp4")
 {
     $errors++;
     $errormsg=4;
 }else
 {
$image_name3=time()."".$a.'.'.$extension1;

$newname3=$pth.$image_name3;
if(!move_uploaded_file($_FILES['img0']['tmp_name'],mysql_real_escape_string($newname3)))
{
   $errors++;
     $errormsg=10; 
}
 }

if($errors==0)
{
 echo "okk";
}
else
{
    echo $errormsg;
}
*/
?>