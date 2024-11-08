<?php
include('config.php');
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
$sql_statement = mysql_query("update advertise_booking set status='".$stts."' where id='".$_POST['adid']."'");
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
}*/

?>
