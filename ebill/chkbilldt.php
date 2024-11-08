<?php
include("config.php");
$val=$_GET['val'];
$tbl=$_GET['tbl'];
$cid=$_GET['cid'];
$atmid=$_GET['atmid'];
$trackid=$_GET['trackid'];
$dt=str_replace("/","-",$val);
$dt2=date('Y-m-',strtotime($dt));
$st=0;
//echo "select * from ebdetails where cust_id='".cid."' and (atmid='".$atmid."' OR trackerid='".$trackid."')  and ".$tbl."=STR_TO_DATE('".$val."','%d/%m/%Y')";
//echo "select * from ebdetails where cust_id='".$cid."' and (atmid='".$atmid."' OR trackerid='".$trackid."') ";
//echo "select bill_date from ebdetails where cust_id='".$cid."' and (atmid='".$atmid."' OR trackerid='".$trackid."')";
$qry=mysqli_query($con,"select * from ebillfundrequests where cust_id='".$cid."' and (atmid='".$atmid."' OR trackerid='".$trackid."') and ".$tbl." like '".$val."%'");

if(mysqli_num_rows($qry)>0)
{
$st='1';
}
else
 $st='0';
 
 echo $st;
?>