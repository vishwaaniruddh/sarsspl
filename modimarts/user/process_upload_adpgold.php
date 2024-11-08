<?php
session_start();
include('config.php');
//include('access.php');

if(isset($_SESSION['id']) & $_SESSION['id']!="")
{

$id=$_POST['id'];
$errors=0;

$duration=$_POST["durarr"];
$name=$_POST["namearr"];
$desc=$_POST["descarr"];

//echo "duration"." ".$duration;
$errormsg=1;
$image=$_FILES['image']['name'];
	 $qcnt= count($image); 

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

		
//================mp3 image====================================================================== 
 	
	
	
	$image_name3=array();
$newname3=array();
 $image1=$_FILES['img']['name'];
	 $ncnt= count($image1);
 	
 	
 	
	for($a=0;$a<$ncnt;$a++){
	
 	$image1=$_FILES['img']['name'][$a];
 	
	
 	if ($image1) 
 	{
	
 		$filename1= stripslashes($image1);
 	
  		$extension1= getExtension($filename1);
 		$extension1= strtolower($extension1);
 	
 if ($extension1 != "mp4")
 		{
//&& ($extension1 != "jpeg") && ($extension1 != "png") && ($extension1 != "gif")) 
		//print error message
 			//echo '<h1>Unknown extension!</h1>';
 			$errors++;
 			$errormsg=4;
 		}
 		else
{


 $size1=filesize($_FILES['img']['tmp_name'][$i]);



$image_name3[$a]=time()."".$a.'.'.$extension1;

$newname3[$a]=$pth.$image_name3[$a];
$newnmm="../".$pth.$image_name3[$a];

//echo $newnmm;
//echo "path  ".$newname3[$a];
$copied1= copy($_FILES['img']['tmp_name'][$a], $newnmm);

if (!$copied1) 
{
	
	$errors++;
	
	}
	
	
	}
	
	}
	
	}

		if($errors==0) 
{  
//echo "ok2";
		  for($i=0;$i<$ncnt;$i++)
   			{

if($newname3[$i]!="")
{	

   	
$dt=date("Y-m-d");		
   			
 $primage=mysqli_query($con1,"insert into `ads_upload`(`name`, `descrtn`, `videopath`,duration,upload_by,status,upload_dt) values('".$name[$i]."','".$desc[$i]."','".$newname3[$i]."','".$duration[$i]."','".$_SESSION['id']."',0,'".date("Y-m-d H:i:s")."')");	
//echo "insert into `upload_only_moives`(`name`, `descrtn`, `videopath`,duration) values('".$name[$i]."','".$desc[$i]."','".$newname3[$i]."','".$duration[$i]."')";
                          if(!$primage)
		          {
                                  $errors++;
                               // echo mysql_error(); 
                                  $errormsg=5; 
		 	   }
}
   			}
}
	      
echo $errormsg;

}else
{
    
    echo 50;
}
?>