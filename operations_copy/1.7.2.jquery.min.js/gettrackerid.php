<?php
include("config.php");
$cid=$_GET['cid'];
$type=$_GET['type'];
$val=$_GET['val'];
$ccmail='';
//echo "select trackerid,bank,csslocalbranch,city,atmsite_address,state,trackerid from ".$cid."_sites where (".$type."1='".$val."' or ".$type."2='".$val."' or ".$type."3='".$val."')";
$cc=mysqli_query($con,"select mailid from ccmails where client='".$cid."'");
$ccro=mysqli_fetch_row($cc);

$qry=mysqli_query($con,"select trackerid,bank,csslocalbranch,city,atmsite_address,state,trackerid from ".$cid."_sites where (".$type."1='".$val."' or ".$type."2='".$val."' or ".$type."3='".$val."')");
if(mysqli_num_rows($qry)>0)
{

$ro=mysqli_fetch_row($qry);
//echo "select caller_name,caller_phone,caller_email,quotdetid from alert where cust_id='".$cid."' and atm_id='".$ro[6]."' order by alert_id DESC limit 1";
$alert=mysqli_query($con,"select caller_name,caller_phone,caller_email,quotdetid from alert where cust_id='".$cid."' and atm_id='".$ro[6]."' order by alert_id DESC limit 1");

$alertro=mysqli_fetch_row($alert);
//echo "select supervisor,ccmail from quotation where quotid='".$alertro[3]."'";
$quot=mysqli_query($con,"select supervisor,ccmail from quotation where quotid='".$alertro[3]."'");
$quotro=mysqli_fetch_row($quot);
if(mysqli_num_rows($alert)>0)
$ccmail.=$quotro[1];
else
$ccmail.=$ccro[0];
echo $ro[0]."****".$ro[1]."****sites****".$ro[2]."****".$ro[3]."****".$ro[4]."****".$ro[5]."****".$alertro[0]."****".$alertro[1]."****".$alertro[2]."****".$quotro[0]."****".$ccmail."\n";
}
else
{
//echo "select id,bank,csslocalbranch,city,atmsite_address,state,id from rnmsites where (atm_id1='".$val."' or atm_id2='".$val."' or atm_id3='".$val."') and cust_id='".$cid."'";
$qry2=mysqli_query($con,"select id,bank,csslocalbranch,city,atmsite_address,state,id from rnmsites where (".$type."1='".$val."' or ".$type."2='".$val."' or ".$type."3='".$val."') and cust_id='".$cid."' and active='1'");
if(mysqli_num_rows($qry2)>0)
{
$ro2=mysqli_fetch_row($qry2);
$alert2=mysqli_query($con,"select caller_name,caller_phone,caller_email,quotdetid from alert where cust_id='".$cid."' and atm_id='".$ro[6]."' order by alert_id DESC limit 1");

$alertro2=mysqli_fetch_row($alert2);
//echo "select supervisor from quotation where quotid='".$alertro2[3]."'";
$quot2=mysqli_query($con,"select supervisor,ccmail from quotation where quotid='".$alertro2[3]."'");
$quotro2=mysqli_fetch_row($quot2);
if(mysqli_num_rows($alert2)>0)
$ccmail.=$quotro2[1];
else
$ccmail.=$ccro[0];
echo $ro2[0]."****".$ro2[1]."****rnmsites****".$ro2[2]."****".$ro2[3]."****".$ro2[4]."****".$ro2[5]."****".$alertro2[0]."****".$alertro2[1]."****".$alertro2[2]."****".$quotro2[0]."****".$ccmail."\n";
}
else
echo "0";
}
?>