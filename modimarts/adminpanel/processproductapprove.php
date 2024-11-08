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
elseif ($pstts==2){
    $stts=2;
}
else {
    echo 2;
}

$ct=$_POST['ct'];

$qrya="select * from main_cat where id='".$ct."'";
 $resulta=mysql_query($qrya);
 $rowa = mysql_fetch_row($resulta);
$aa=$rowa[2];
   
if($aa!=0){
    $qrya1="select * from main_cat where id='".$aa."'";
    $resulta1=mysql_query($qrya1);
    $rowa1 = mysql_fetch_row($resulta1);
    $Maincate= $rowa1[4];
} 
$curr_dt1=date('Y-m-d H:i:s');
if($Maincate==1){
$sql_statement = mysql_query("update fashion set status='".$stts."' where code='".$_POST['adid']."'");
 if($pstts==1){
	    $subAdminWork1=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','Approve','Approved merchant Product','".$curr_dt1."','".$_SESSION['lastSubID']."','". $_POST['adid']." ','fashion') ");
    }
}
else if($Maincate==190){
    $sql_statement = mysql_query("update electronics set status='".$stts."' where code='".$_POST['adid']."'");
if($pstts==1){
	    $subAdminWork1=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','Approve','Approved merchant Product','".$curr_dt1."','".$_SESSION['lastSubID']."','". $_POST['adid']." ','electronics') ");
    }
}
else if($Maincate==218){
$sql_statement = mysql_query("update grocery set status='".$stts."' where code='".$_POST['adid']."'");
    
    if($pstts==1){
	    $subAdminWork1=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','Approve','Approved merchant Product','".$curr_dt1."','".$_SESSION['lastSubID']."','". $_POST['adid']." ','grocery') ");
    }
}
else if($Maincate==482){
    $sql_statement = mysql_query("update Resale set status='".$stts."' where code='".$_POST['adid']."'");
    if($pstts==1){
	    $subAdminWork1=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','Approve','Approved merchant Product','".$curr_dt1."','".$_SESSION['lastSubID']."','". $_POST['adid']." ','Resale') ");
    }
}
else{
    $sql_statement = mysql_query("update products set status='".$stts."' where code='".$_POST['adid']."'");
if($pstts==1){
 	$subAdminWork1=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','Approve','Approved merchant Product','".$curr_dt1."','".$_SESSION['lastSubID']."','". $_POST['adid']." ','products') ");
    }
}
//$sql_statement = mysql_query("update products set status='".$stts."' where code='".$_POST['adid']."'");
if(!$sql_statement)
{
    echo 2;
}else{
    echo 1;
}
/*

$getbkdets=mysql_query("select * from ad_booking_details where id='".$_POST['adid']."'");
$frws=mysql_fetch_array($getbkdets);
$dt1=date("Y-m-d",strtotime(str_replace("/","-",$frws['frmdt'])));
$dt2=date("Y-m-d",strtotime(str_replace("/","-",$frws['todt'])));

$dt=$dt1." 00:00:00";
$dtr=$dt2." 24:00:00";


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
}

*/
}
if($_POST['sttss']=="reasn"){
   $re=$_POST['re'];
    $curr_dt=date('Y-m-d H:i:s');
    if($Maincate==1){
        $q=mysql_query("update fashion set Reason='".$re."' where code='".$_POST['cod']."'");
    	$subAdminWork=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','Reject','Rejected merchant Product','".$curr_dt."','".$_SESSION['lastSubID']."','".$_POST['cod']." ','fashion') ");
    }
    else if($Maincate==190){
        $q=mysql_query("update electronics set Reason='".$re."' where code='".$_POST['cod']."'");
    	$subAdminWork=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','Reject','Rejected merchant Product','".$curr_dt."','".$_SESSION['lastSubID']."','".$_POST['cod']." ','electronics') ");
    }
    else if($Maincate==218){
    $q=mysql_query("update grocery set Reason='".$re."' where code='".$_POST['cod']."'");
    	$subAdminWork=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','Reject','Rejected merchant Product','".$curr_dt."','".$_SESSION['lastSubID']."','".$_POST['cod']." ','grocery') ");
    }
    else{
        $q=mysql_query("update products set Reason='".$re."' where code='".$_POST['cod']."'");
    	$subAdminWork=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','Reject','Rejected merchant Product','".$curr_dt."','".$_SESSION['lastSubID']."','".$_POST['cod']." ','products') ");
    }
    //$q=mysql_query("update products set Reason='".$re."' where code='".$_POST['cod']."'");
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
