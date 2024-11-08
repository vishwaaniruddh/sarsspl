<?php
session_start();
include('config.php');
try {

               $cmp=$_POST['cmp'];
mysql_query('BEGIN');
		  $qry1="delete from cities where code='$cmp'";
			  $sqlr=mysql_query($qry1);
	 $curr_dt=date('Y-m-d H:i:s');
	$subAdminWork=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','Delete','Delete City From City Table','".$curr_dt."','".$_SESSION['lastSubID']."','". $cmp." ','cities') ");
		
	
			                  
		if(!$sqlr)
{
ECHO mysql_error();
$error++;

}


    




if($error==0)
{
mysql_query('COMMIT');
echo 1;
}
else
{

mysql_query('ROLLBACK');
echo 2;
}
		}
		catch(Exception $e)
		{
		 echo "Exception ".$e->getMessage();
		 }
?>