<?php
session_start();
include("config.php");
$qr="";

      $qr="update  top_right_slider set stats='3',lastupdt='".date("Y-m-d H:is")."' where id='".$_POST['updid']."'";
  
$exwcq=mysql_query($qr);


  $curr_dt=date('Y-m-d H:i:s');
	$subAdminWork=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','Delete','Deleted Slider Product','".$curr_dt."','".$_SESSION['lastSubID']."','". $_POST['updid']." ','top_right_slider') ");
		
	

if($exwcq)
{
    echo 1;
}
else
{
    echo 2;
}

?>