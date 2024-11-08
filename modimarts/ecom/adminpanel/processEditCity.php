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

$code=$_POST['code'];
$cname=$_POST['cname'];
$key=$_POST['add1'];
          //  echo " ".$code."-".$cname."-".$key;            
			try{  
			  $qry="update cities set name='$cname',keywords='$key' where code='$code'";  
			  $res=mysql_query($qry);
			  
			  $curr_dt=date('Y-m-d H:i:s');
	$subAdminWork=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','Edit','Edit City  In City Table','".$curr_dt."','".$_SESSION['lastSubID']."','".$code." ','cities') ");
		
	
			  
			  
                if($res)
		 
 header('Location:cities.php');  
  
 	
                  else
                 
echo "Error Occured";
  
 	
                          }catch(Exception $e)
                           {
                             echo 'Message: ' .$e->getMessage();
                           }
?>

