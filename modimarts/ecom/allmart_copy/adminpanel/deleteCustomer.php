<?php
include('config.php');
session_start();
try {
    $errs=0;
    mysql_query("BEGIN");

                 $cmp=$_POST['cmp'];
                 $reas=$_POST['reas'];
                 
                 
                 
                 $insqr=mysql_query("INSERT INTO `clients_deleted`(`code`, `name`, `city`, `state`, `area`, `address`, `cid`, `category`, `phone`, `fax`, `email`, `contact`, `mobile`, `noe`, `memtype`, `license`, `fees`, `yoe`, `logo`, `rdate`, `till_date`, `Latitude`, `Longitude`, `vat`, `adhar_no`, `pan_no`, `Establishment`) select `code`, `name`, `city`, `state`, `area`, `address`, `cid`, `category`, `phone`, `fax`, `email`, `contact`, `mobile`, `noe`, `memtype`, `license`, `fees`, `yoe`, `logo`, `rdate`, `till_date`, `Latitude`, `Longitude`, `vat`, `adhar_no`, `pan_no`, `Establishment` from clients where code='$cmp'");
                 //echo $insqr;
                 if(!$insqr)
                 {
                     echo mysql_error();
                    $errs++; 
                     
                 }
                 
                 $del1=mysql_query("delete from users where cid='$cmp'");
                 //echo $del1;
                 if(!$del1)
                 {
                     echo mysql_error();
                    $errs++; 
                     
                 }
                 
                 $upd1=mysql_query("update clients_deleted set delete_reason='".mysql_real_escape_string($reas)."' where code='$cmp'");
                 if(!$upd1)
                 {
                     echo mysql_error();
                    $errs++; 
                     
                 }
                 

		  $qry1="delete from clients where code='$cmp'";
			$result=mysql_query($qry1);
			  
			  
  $curr_dt=date('Y-m-d H:i:s');
	$subAdminWork=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','delete','Delete Merchant from Merchant Table','".$curr_dt."','".$_SESSION['lastSubID']."','". $cmp." ','clients') ");
		
		
			
			                  
			if($errs==0)
		{
			 // header('Location:admin.php');  
			 mysql_query("COMMIT");
		    ECHO 1;
		}
		else
		{
		    mysql_query("ROLLBACK");
		echo 0;
		}
}
		catch(Exception $e)
		{
		 //echo "Exception ".$e->getMessage();
		 }
?>