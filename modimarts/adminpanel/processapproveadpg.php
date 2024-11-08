<?php
session_start();
include('config.php');
$errs=0;
//mysql_query("BEGIN");

$sql_statement = mysql_query("update ads_upload set status=1 where id='".$_POST['adid']."'");
//echo "update ads_upload set status=1 where id='".$_POST['adid']."'";


$curr_dt=date('Y-m-d H:i:s');
	$subAdminWork=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','Approve','Approved video','".$curr_dt."','".$_SESSION['lastSubID']."','". $_POST['adid']." ','ads_upload') ");
		
	


if($sql_statement)
{
$errs++;
}
echo $errs;

$getbkdets=mysql_query("select * from ad_booking_details where id='".$_POST['adid']."'");
$frws=mysql_fetch_array($getbkdets);
$dt1=date("Y-m-d",strtotime(str_replace("/","-",$frws['frmdt'])));
$dt2=date("Y-m-d",strtotime(str_replace("/","-",$frws['todt'])));

$dt=$dt1." 00:00:00";
$dtr=$dt2." 24:00:00";

/*
while(date("Y-m-d H:i:s",strtotime($dt))<=date("Y-m-d H:i:s",strtotime($dtr)))
{
   $dt=date("d-m-Y H:i:s",strtotime($dt)+$dur); 
    
    if(date("Y-m-d H:i:s",strtotime($dt)+$dur)<=date("Y-m-d H:i:s",strtotime($dtr)))
    {

$qr=mysql_query("insert into ");
    
    }
    else
    {
        break;
    }
}*/

?>
