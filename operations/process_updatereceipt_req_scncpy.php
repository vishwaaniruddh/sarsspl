<?php
session_start();
if(!isset($_SESSION['user'])){
?>
<script type="text/javascript">
alert("Sorry, Your Session Has been Expired");
window.location="index.php";
</script>
<?php
}
else
{
	include("config.php");
	$status=0;
	//$sr=mysqli_query($con,"select username from login where srno='".$_SESSION['user']."'");
	//$srn=mysqli_fetch_row($sr);
	if(isset($_POST['cmdsub']))
	{
		
		$errors2=0;
		$photo_name2=$_POST['scancpy'];
		//echo $_FILES['scancpy']['name'];
		//echo $_FILES['hoverfrm']['name'];
		define ("MAX_SIZE","3000");
		function getExtension($str) {
				 $i = strrpos($str,".");
				 if (!$i) { return ""; }
				 $l = strlen($str) - $i;
				 $ext = substr($str,$i+1,$l);
				 return $ext;
		 }
		
		if(isset($_FILES['scancpy']['name']) && $_FILES['scancpy']['name']!='')
		{
		 $photo2=$_FILES['scancpy']['name']; 
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
		 if (($extension2 != "jpg") && ($extension2 != "png") && ($extension2 != "bmp")) 
		{
		//print error message
			$str= '<h1>Unknown extension!</h1><a href="view_updatereceiprt_req.php">Go Back</a>';
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
		$newname2="updatereceipt_scncpy/".$photo_name2;
		//echo $newname;
		//we verify if the image has been uploaded, and print error instead
		$copied2 = copy($_FILES['scancpy']['tmp_name'],$newname2);
		
		if (!$copied2) 
		{
		 	$str= '<h1>Copy unsuccessfull!</h1><a href="view_updatereceiprt_req.php">Go Back</a>';
			$errors2=1;
		}
		}
		//echo $newname;
		
		
		}
		}
		
		if($errors2==0)
		{
			$sr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
			$srno=mysqli_fetch_row($sr);
			//echo "update `update_receipt` set scncpy='".$photo_name2."',scncpy_by='".$srno[0]."' where reqid='".$_REQUEST['req_id']."'";
			$qry=mysqli_query($con,"update `update_receipt` set scncpy='".$photo_name2."',scncpy_by='".$srno[0]."' where reqid='".$_REQUEST['req_id']."'");
			if($qry)
			{
				$_SESSION['success']=1;
			}
			else
			{
				$_SESSION['success']=0;
			}
			if(isset($_POST['sup']) && $_POST['sup']!='')
			{
				$_SESSION['supv']=$_POST['sup'];
			}
			if(isset($_POST['to_page']) && $_POST['to_page']!='')
			{
				header("location:".$_REQUEST['to_page'].".php");
			}
			else
			{
				header('location:view_updatereceiprt_req.php');
			}
		}
		else
			echo $str;
	}
}
?>