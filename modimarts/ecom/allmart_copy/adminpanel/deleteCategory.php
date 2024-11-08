<?php
session_start();
include('config.php');
try {

                 $cmp=$_POST['cmp'];

$sltqry=mysql_query("select under from main_cat where under='$cmp'");
$sltqrynr=mysql_fetch_row($sltqry);
$nrts=mysql_num_rows($sltqry);
if($nrts=="0")
{
		  $qry1="delete from main_cat where id='$cmp'";
			  $result=mysql_query($qry1);
			       
$curr_dt=date('Y-m-d H:i:s');
$subAdminWork=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','Delete','Delete Category From Category Table','".$curr_dt."','".$_SESSION['lastSubID']."','". $cmp." ','main_cat') ");
		
	
			       
			                  
			if($result)
		{
echo 1;		  		 
//header('location:sub_cat.php');
}
		else
		{
		    echo 0;
//		echo "error updating data";
		}
}else{
   
   echo 10; 
}
}		catch(Exception $e)
		{
		 echo "Exception ".$e->getMessage();
		 }
?>