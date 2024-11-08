<?php
session_start();
/*session_start();
	ob_start();
		if(!isset($_SESSION['admin'])) {
		header('Location:index.php');	
		exit;
	}*/
include('config.php');
$subname=$_POST['subname'];
$mobile=$_POST['mobile'];
$emailid=$_POST['emailid'];
$pass=$_POST['pass'];
$newroll=$_POST['newroll'];

$qRollId=mysql_query("select * from roll where id='".$newroll."'");
$fRollId= mysql_fetch_row($qRollId);
$permission= $fRollId[2];
$qry="insert into subAdminLogin(`name`, `mobile`, `email`,`password`,Permission,Roll) values('".$subname."','".$mobile."','".$emailid."','".$pass."','".$permission."','".$newroll."')";
$res=mysql_query($qry);
// echo $qry;
$subid= mysql_insert_id();
$qryusertable="insert into admin_login(`username`, `pass`, `designation`,`status`,permission) values('".$emailid."','".$pass."','1','1','".$permission."')";
$resuser=mysql_query($qryusertable);
$curr_dt=date('Y-m-d H:i:s');
$subAdminWork=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','Add','Add Sub Admin In SubAdmin Table','".$curr_dt."','".$_SESSION['lastSubID']."','". $subid." ','subAdminLogin') ");
if($res)
{
	$message = "Added Successfully !!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo '<script>window.open("Add_Subadmin.php", "_self");</script>';
    // header('Location:Add_Subadmin.php');  
} else {
echo "Error Occured";
}
?>
