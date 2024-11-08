<?php
include('config.php');
session_start();
if($_POST['Status']==7){

$errs=0;
//mysql_query("BEGIN");
$pstts=$_POST['stts'];
if($pstts==1){
    
    $stts=1;
}
elseif($pstts==2){
    $stts=2;
}
else{
    echo 2;
}

$ct=$_POST['ct'];

$curr_dt1=date('Y-m-d H:i:s');


$sql_statement = mysql_query("update Resale set status='".$stts."' where code='".$_POST['adid']."'");
//echo "update Resale set status='".$stts."' where code='".$_POST['adid']."'";
    
    if($pstts==1){

	$subAdminWork1=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','Approve','Approved merchant Product','".$curr_dt1."','".$_SESSION['lastSubID']."','". $_POST['adid']." ','Resale') ");
    }
if(!$sql_statement)
{
echo 2;
}else{
    echo 1;
}

}


if($_POST['sttss']=="reasn"){
   $re=$_POST['re'];
   
    $curr_dt=date('Y-m-d H:i:s');

$q=mysql_query("update Resale set Reason='".$re."' where code='".$_POST['cod']."'");
//echo "update Resale set Reason='".$re."' where code='".$_POST['cod']."'";

	$subAdminWork=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','Reject','Rejected merchant Product','".$curr_dt."','".$_SESSION['lastSubID']."','".$_POST['cod']." ','products') ");
	

  if($q)
{
    
    
$to=$_POST['em'];
$subject = "Reason for reject";
$txt = $_POST['re'];
$headers = "From: Merabazaar@example.com" . "\r\n" .
"CC: sarmicrosystems@example.com";

mail($to,$subject,$txt,$headers);

    
    
echo 1;
}else{
    echo 2;
}
    
    
}


?>
