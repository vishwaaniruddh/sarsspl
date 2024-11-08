<?php
session_start();
include('config.php');

$ccode=$_POST['ccode'];
$code=$_POST['code'];
$cname=$_POST['cname'];
$key=$_POST['add1'];
          //  echo " ".$code."-".$cname."-".$key;            
			try{  
			  $qry="insert into areas(`city`, `name`, `keywords`) values('".$ccode."','".$cname."','".$key."')";
			  $res=mysql_query($qry);
			  
			 $subid= mysql_insert_id();
			  $curr_dt=date('Y-m-d H:i:s');
	$subAdminWork=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','Add','Add Area In Area Table','".$curr_dt."','".$_SESSION['lastSubID']."','". $subid." ','areas') ");
		
	
			  
                if($res)
		 
header('location:location.php');
  
 	
                  else
                 
echo "Error Occured";
  
 	
                          }catch(Exception $e)
                           {
                             echo 'Message: ' .$e->getMessage();
                           }
?>