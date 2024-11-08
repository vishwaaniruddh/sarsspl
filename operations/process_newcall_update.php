<?php 
include("access.php");
include("config.php");


session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry, your session has Expired'); window.location='index.php';</script>";
}
else
{
//echo "hello";
$alid=$_POST['alid'];
$updrem=$_POST['updrem'];

$errors="0";

$dt=date('Y-m-d H:i:s');
mysqli_query($con,'BEGIN');

$srqry=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
			$srno=mysqli_fetch_array($srqry);
			
			
			
		$insqry=mysqli_query($con,"insert into new_callupdate_details (`alertid`, `remark`, `reqby`, `entrydt`)values('".$alid."','".$updrem."','".$srno[0]."','".$dt."')");	
		if(!$insqry)
		{
		$errors++;
		
		}
			
			

if($errors==0)
{
mysqli_query($con,"COMMIT");
echo "Updated";

}
else
{
mysqli_query($con,"ROLLBACK");
//echo mysqli_error();
echo "error";

}		
			
			
			
			
			
}			
			
			
			
?>
