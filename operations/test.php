<?php
include("config.php");
$qry=mysqli_query($con,"select * from quotation where quotid not in (select quotdetid from alert)");
while($row=mysqli_fetch_array($qry))
{
//echo $row[18];
if($row[18]=='rnmsites')
$st="select bank,csslocalbranch,atmsite_address,city,state from rnmsites where id='".$row[4]."'";
else
$st="select bank,csslocalbranch,atmsite_address,city,state from ".$row[3]."_sites where trackerid='".$row[4]."'";
//echo $st."<br>";
$site=mysqli_query($con,$st);
$sitero=mysqli_fetch_row($site);
$comp=array();
$mat=mysqli_query($con,"select distinct(component),now from quot_details where quotid='".$row[1]."'");
$mattype='';
while($matro=mysqli_fetch_array($mat))
{
//echo "select count(alert_id) from alert where alert_date like '".date('Y-m-d',strtotime($row[9]))."%'<br>";
$oldalert=mysqli_query($con,"select count(alert_id) from alert where alert_date like '".date('Y-m-d',strtotime($row[9]))."%'");
$old=mysqli_fetch_row($oldalert);
 $mattype=$matro[1]."_".$matro[0];
//echo "<br>alertid=".$old[0]."<br>";
$docno=$row[2]."_".date('dmY',strtotime($row[9]))."".($old[0]+1);
$prblm='';
$prblm='<b>'.$matro[0].":</b>";
$matr=mysqli_query($con,"select material from quot_details where quotid='".$row[1]."' and component='".$matro[0]."'");
while($mt=mysqli_fetch_array($matr))
{
$prblm.=$mt[0]."\n";
}
echo "INSERT INTO `alert` (`cust_id`, `atm_id`,`bank_name`, `area`, `address`, `city`, `state`, `problem`, `entry_date`, `alert_date`, `caller_name`, `status`, `call_status`, `alert_type`,`createdby`, `state1`, `quotdetid`,`mattype`, `callpriority`) values('".$row[3]."','".$row[4]."','".$sitero[0]."','".$sitero[1]."','".str_replace("'","\'",$sitero[2])."','".$sitero[3]."','".$sitero[4]."','".$prblm."','".$row[9]."','".$row[9]."','".$row[15]."','1','1','".$row[18]."','".$docno."','".$sitero[4]."','".$row[1]."','".$mattype."','Normal')<br><br> ";
$alert=mysqli_query($con,"INSERT INTO `alert` (`cust_id`, `atm_id`,`bank_name`, `area`, `address`, `city`, `state`, `problem`, `entry_date`, `alert_date`, `caller_name`, `status`, `call_status`, `alert_type`,`createdby`, `state1`, `quotdetid`,`mattype`, `callpriority`) values('".$row[3]."','".$row[4]."','".$sitero[0]."','".$sitero[1]."','".str_replace("'","\'",$sitero[2])."','".$sitero[3]."','".$sitero[4]."','".$prblm."','".$row[9]."','".$row[9]."','".$row[15]."','1','1','".$row[18]."','".$docno."','".$sitero[4]."','".$row[1]."','".$mattype."','Normal')");
if(!$alert)
echo mysqli_error();
}

}

/*$arr=array('1','2','1.1','1.4','1.4.3','1.1.1');
sort($arr);
//print_r($arr);
$arrlength=count($arr);
for($x=0;$x<$arrlength;$x++)
   {
   echo $arr[$x];
   echo "<br>";
   }*/

?>