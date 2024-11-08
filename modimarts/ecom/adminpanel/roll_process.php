<?php
session_start();
/*session_start();
	ob_start();
		if(!isset($_SESSION['admin'])) {
		header('Location:index.php');	
		exit;
	}*/
include('config.php');

$roll=$_POST['roll'];
$permission=$_POST['drop'];



         	 
			  $qry="insert into roll(`roll`, `permission`) values('".$roll."','".$permission."')";
			  $res=mysql_query($qry);
			 
		 
			$subid= mysql_insert_id();
			 
			 
	$curr_dt=date('Y-m-d H:i:s');
	$subAdminWork=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','Add','Roll Creation','".$curr_dt."','".$_SESSION['lastSubID']."','". $subid." ','roll') ");
		
//	echo "insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','Add','Roll Creation','".$curr_dt."','".$_SESSION['lastSubID']."','". $subid." ','roll') ";
			 
                if($res)
		 {
		     $message = "Add Successfully !!";
echo "<script type='text/javascript'>alert('$message');</script>";

echo '<script>window.open("roll.php", "_self");</script>';

// header('Location:Add_Subadmin.php');  
		 }
 	
                  else
                 {
echo "Error Occured";
                 }
 	
                     
?>
