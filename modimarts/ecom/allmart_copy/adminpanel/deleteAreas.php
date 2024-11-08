<?php
session_start();
include('config.php');
try {

                 $cmp=$_POST['cmp'];

	//	  $qry1="delete from areas where code='$cmp'";
		//	  $result=mysql_query($qry1);
			                  
		
mysql_query('BEGIN');
    $sqlr=mysql_query("DELETE FROM `areas` WHERE code='".$cmp."'");
    	 
    	  $curr_dt=date('Y-m-d H:i:s');
	$subAdminWork=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','Delete','Delete Area From Area Table','".$curr_dt."','".$_SESSION['lastSubID']."','". $cmp." ','areas') ");
		
    

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
}		catch(Exception $e)
		{
		 echo "Exception ".$e->getMessage();
		 }
?>