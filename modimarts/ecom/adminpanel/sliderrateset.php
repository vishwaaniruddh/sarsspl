<?php
session_start();
include('config.php');
$errors=0;
$sliderid=$_POST["sliderid"];
$dtsavil=$_POST["dtsavil"];

$expldts=explode(",",$dtsavil);

mysql_query("BEGIN");

for($a=0;$a<count($expldts);$a++)
{
    
    
    
    $sqr=mysql_query("INSERT INTO `slider_slot_rate`(`slider_id`, `rate`, `entrydt`, `dt`) values('".$sliderid."','".$_POST["rate"]."','".date("Y-m-d H:i:s")."','".date("Y-m-d",strtotime($expldts[$a]))."')");
     
     $subid=mysql_insert_id();
    
      $curr_dt=date('Y-m-d H:i:s');
	$subAdminWork=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','rate Set','Rate Set of slot','".$curr_dt."','".$_SESSION['lastSubID']."','". $subid." ','slider_slot_rate') ");
		
	
    
    
    if(!$sqr)
    {
        $errors++;
    }
}


if($errors==0)
{
    
  mysql_query("COMMIT"); 
  
  echo 1;
}else
{
    
    mysql_query("ROLLBACK");
    
  echo 2;
}
?>