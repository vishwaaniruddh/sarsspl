<?php
session_start();
/*

session_start();

	ob_start();

		if(!isset($_SESSION['admin'])) {

		header('Location:index.php');	

		exit;

	}*/

include('config.php');
try {

                $banner=$_GET['cmp'];
$pos=$_GET['pos'];
		//  $qry1="delete from banners where id='$banner'";
		 $qry2=mysqli_query($con3,"select * from oc_pavosliderlayers where id='".$banner."'");
		 $fr=mysqli_fetch_array($qry2);
		
		if($fr["image"]!="")
		{
		unlink($ocimagepath.$fr["image"]);
		}
		  $result=mysqli_query($con3,"delete from `oc_pavosliderlayers` WHERE id='".$banner."'");
			  
			                  $curr_dt=date('Y-m-d H:i:s');
	$subAdminWork=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','Delete','Deleted Carousel Slider Image','".$curr_dt."','".$_SESSION['lastSubID']."','". $banner." ','oc_pavosliderlayers') ");
		
	
			                  
			                  
			if($result!="")
		{
			 header('location:viewBanners.php');
 }
		else
		
		echo "error updating data";
		}
		catch(Exception $e)
		{
		 echo "Exception ".$e->getMessage();
		 }
?>