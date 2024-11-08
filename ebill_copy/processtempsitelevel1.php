<?php
include("config.php");

$k=0;
$site=array();
$err=array();
//echo count($_POST['siteid']);
for($i=0;$i<count($_POST['siteid']);$i++)
{
if(isset($_POST['siteid'][$i]))
{
 $tempid=$_POST['siteid'][$i];
//echo "select * from newtempsites where id='".$_POST['siteid'][$i]."'";
$query=mysqli_query($con,"select * from newtempsites where id='".$_POST['siteid'][$i]."'");
$row=mysqli_fetch_row($query);
if($row[17]!='' || $row[17]!='not live')
{
$atm=mysqli_query($con,"select * from ".$row[1]."_sites where atm_id1='".$row[17]."'");
if($row[17]!='Under Construction' || $row[17]!='Not Live' || $row[17]!='')
{
$num=0;
}
else
{
$num=mysqli_num_rows($atm);
}
}
if($num>0)
{
$atmro=mysqli_fetch_row($atm);
//echo "<br>Update sites set  `housekeeping_rate`='".$row[6]."', `caretaker_rate`='".$row[8]."', `maintenance_rate`='".$row[10]."' where atm_id1='".$row[17]."'";

$up=mysqli_query($con,"Update ".$row[1]."_sites set  `housekeeping_rate`='".$row[6]."', `caretaker_rate`='".$row[8]."', `maintenance_rate`='".$row[10]."',Takeover_date='".$row[29]."',housekeeping_tkdt='".$row[61]."',maintenance_tkdt='".$row[62]."' where id='".$row[53]."'");
if($up)
{
if($row[5]=='Y')
$tkdt=mysqli_query($con,"INSERT INTO `takeoversites` (`id`, `cid`, `atmid`, `takeover_date`, `takeoverfrm`, `status`,`trackerid`,service) VALUES (NULL, '".$row[1]."', '".$row[17]."', '".$row[61]."', '".$row[55]."', '0','".$atmro[54]."','housekeeping')");

if($row[7]=='Y')
$tkdt2=mysqli_query($con,"INSERT INTO `takeoversites` (`id`, `cid`, `atmid`, `takeover_date`, `takeoverfrm`, `status`,`trackerid`,service) VALUES (NULL, '".$row[1]."', '".$row[17]."', '".$row[29]."', '".$row[55]."', '0','".$atmro[54]."','caretaker')");

if($row[9]=='Y')
$tkdt3=mysqli_query($con,"INSERT INTO `takeoversites` (`id`, `cid`, `atmid`, `takeover_date`, `takeoverfrm`, `status`,`trackerid`,service) VALUES (NULL, '".$row[1]."', '".$row[17]."', '".$row[62]."', '".$row[55]."', '0','".$atmro[54]."','maintenance')");

if($row[53]=='Y')
$tkdt4=mysqli_query($con,"INSERT INTO `takeoversites` (`id`, `cid`, `atmid`, `takeover_date`, `takeoverfrm`, `status`,`trackerid`,service) VALUES (NULL, '".$row[1]."', '".$row[17]."', '".$row[63]."', '".$row[55]."', '0','".$atmro[54]."','ebill')");

//$up2=mysqli_query($con,"Update Takeoverform set trackerid='".$row[1]."_".$insid."' where tempid='".$_POST['site'][$i]."'");

$site[]=$_POST['siteid'][$i];
}
else
{
$err[]="failed to update service rates of ATM ID: ".$atmro[16]." or ".$atmro[17]." or ".$atmro[18]."";
}
}
else
{
//echo "<br><br>INSERT INTO ".$row[1]."_sites (`cust_id`, `cust_name`, `acmanager`, `acmanagerphone`, `housekeeping`, `housekeeping_rate`, `caretaker`, `caretaker_rate`, `maintenance`, `maintenance_rate`, `bank`, `csslocalbranch`, `zone`, `state`, `region`, `site_id`, `atm_id1`, `atm_id2`, `atm_id3`, `dummyatm_id`, `siteoldmdn_no`, `sitenewmdn_no`, `mdnrsn_no`, `city`, `location`, `atmsite_address`, `site_type`, `city_category`, `takeover_date`, `handover_date`, `hsupervisor_name`, `super_contact`, `caretakersalary1`, `caretakersalary2`, `caretakersalary3`, `caretaker_id1`, `caretaker_doj1`, `caretaker_name1`, `caretaker_acc1`, `caretaker_id2`, `caretaker_doj2`, `caretaker_name2`, `caretaker_acc2`, `caretaker_id3`, `caretaker_doj3`, `caretaker_name3`, `caretaker_acc3`, `cust_remarks`, `cssbilling_remark`, `cssacremarks`, `active`) VALUES ('".$row[1]."', '".$row[2]."', '".$row[3]."', '".$row[4]."', '".$row[5]."', '".$row[6]."', '".$row[7]."', '".$row[8]."', '".$row[9]."', '".$row[10]."','".$row[11]."', '".$row[12]."','".$row[13]."', '".$row[14]."', '".$row[15]."', '".$row[16]."', '".$row[17]."', '".$row[18]."', '".$row[19]."', '".$row[20]."', '".$row[21]."', '".$row[22]."', '".$row[23]."', '".$row[24]."', '".$row[25]."', '".$row[26]."', '".$row[27]."', '".$row[28]."', '".$row[29]."', '".$row[30]."', '".$row[31]."', '".$row[32]."', '".$row[33]."', '".$row[34]."', '".$row[35]."', '".$row[36]."', '".$row[7]."', '".$row[38]."', '".$row[39]."', '".$row[40]."', '".$row[41]."', '".$row[42]."', '".$row[43]."', '".$row[44]."', '".$row[45]."', '".$row[46]."', '".$row[47]."', '".$row[48]."', '".$row[49]."', '".$row[50]."', '0')";


$ins=mysqli_query($con,"INSERT INTO ".$row[1]."_sites (`cust_id`, `cust_name`, `acmanager`, `acmanagerphone`, `housekeeping`, `housekeeping_rate`, `caretaker`, `caretaker_rate`, `maintenance`, `maintenance_rate`, `bank`, `csslocalbranch`, `zone`, `state`, `region`, `site_id`, `atm_id1`, `atm_id2`, `atm_id3`, `dummyatm_id`, `siteoldmdn_no`, `sitenewmdn_no`, `mdnrsn_no`, `city`, `location`, `atmsite_address`, `site_type`, `city_category`, `takeover_date`, `handover_date`, `hsupervisor_name`, `super_contact`, `caretakersalary1`, `caretakersalary2`, `caretakersalary3`, `caretaker_id1`, `caretaker_doj1`, `caretaker_name1`, `caretaker_acc1`, `caretaker_id2`, `caretaker_doj2`, `caretaker_name2`, `caretaker_acc2`, `caretaker_id3`, `caretaker_doj3`, `caretaker_name3`, `caretaker_acc3`, `cust_remarks`, `cssbilling_remark`, `cssacremarks`,`ebill`,`projectid`,`subcat`,`housekeeping_tkdt`,`maintenance_tkdt`) VALUES ('".$row[1]."', '".$row[2]."', '".$row[3]."', '".$row[4]."', '".$row[5]."', '".$row[6]."', '".$row[7]."', '".$row[8]."', '".$row[9]."', '".$row[10]."','".$row[11]."', '".$row[12]."','".$row[13]."', '".$row[14]."', '".$row[15]."', '".$row[16]."', '".$row[17]."', '".$row[18]."', '".$row[19]."', '".$row[20]."', '".$row[21]."', '".$row[22]."', '".$row[23]."', '".$row[24]."', '".$row[25]."', '".$row[26]."', '".$row[27]."', '".$row[28]."', '".$row[29]."', '".$row[30]."', '".$row[31]."', '".$row[32]."', '".$row[33]."', '".$row[34]."', '".$row[35]."', '".$row[36]."', '".$row[7]."', '".$row[38]."', '".$row[39]."', '".$row[40]."', '".$row[41]."', '".$row[42]."', '".$row[43]."', '".$row[44]."', '".$row[45]."', '".$row[46]."', '".$row[47]."', '".$row[48]."', '".$row[49]."', '".$row[50]."','".$row[53]."','".$row[52]."','".$row[60]."','".$row[61]."','".$row[62]."')");

 $insid=mysqli_insert_id();
if(!$ins)
{
$err[]="Some Error Occurred. ".mysqli_error();
}
else
{
//echo "hiii";
//echo $_POST['site'][$i];
$up=mysqli_query($con,"update ".$row[1]."_sites set trackerid='".$row[1]."_".$insid."' where id='".$insid."'");
//echo "Update Takeoverform set trackerid='".$row[1]."_".$insid."' where tempid='".$tempid."'";
$up2=mysqli_query($con,"Update Takeoverform set trackerid='".$row[1]."_".$insid."' where tempid='".$row[0]."'");
if($row[5]=='Y')
$tkdt=mysqli_query($con,"INSERT INTO `takeoversites` (`id`, `cid`, `atmid`, `takeover_date`, `takeoverfrm`, `status`,`trackerid`,service) VALUES (NULL, '".$row[1]."', '".$row[17]."', '".$row[61]."', '".$row[55]."', '0','".$row[1]."_".$insid."','housekeeping')");

if($row[7]=='Y')
$tkdt2=mysqli_query($con,"INSERT INTO `takeoversites` (`id`, `cid`, `atmid`, `takeover_date`, `takeoverfrm`, `status`,`trackerid`,service) VALUES (NULL, '".$row[1]."', '".$row[17]."', '".$row[29]."', '".$row[55]."', '0','".$row[1]."_".$insid."','caretaker')");

if($row[9]=='Y')
$tkdt3=mysqli_query($con,"INSERT INTO `takeoversites` (`id`, `cid`, `atmid`, `takeover_date`, `takeoverfrm`, `status`,`trackerid`,service) VALUES (NULL, '".$row[1]."', '".$row[17]."', '".$row[62]."', '".$row[55]."', '0','".$row[1]."_".$insid."','maintenance')");

if($row[53]=='Y')
{
$tkdt4=mysqli_query($con,"INSERT INTO `takeoversites` (`id`, `cid`, `atmid`, `takeover_date`, `takeoverfrm`, `status`,`trackerid`,service) VALUES (NULL, '".$row[1]."', '".$row[17]."', '".$row[63]."', '".$row[55]."', '0','".$row[1]."_".$insid."','ebill')");

}

if($row[53]=='Y')
{
//echo "INSERT INTO ".$row[1]."_ebill (`id`, `Consumer_No`, `Distributor`, `ATM_ID`, `Due_Date`, `landlord`, `averagebill`,`billing_unit`,`meter_no`,`atmtrackid`) VALUES (NULL, '".$getro[1]."', '".$getro[2]."', '".$getro[3]."', '".$getro[4]."', '".$getro[5]."', '".$getro[8]."', '".$getro[10]."', '".$getro[11]."','".$row[1]."_".$insid."')<br>";
$eb=mysqli_query($con,"select * from ".$row[1]."_ebill where atmtrackid='".$row[1]."_".$insid."'");
if(mysqli_num_rows($eb)==0){
$get=mysqli_query($con,"select * from tempebill where tempid='".$_POST['siteid'][$i]."'");
$getro=mysqli_fetch_row($get);
$cons=mysqli_query($con,"INSERT INTO ".$row[1]."_ebill (`id`, `Consumer_No`, `Distributor`, `ATM_ID`, `Due_Date`, `landlord`, `averagebill`,`billing_unit`,`meter_no`,`atmtrackid`) VALUES (NULL, '".$getro[1]."', '".$getro[2]."', '".$getro[3]."', '".$getro[4]."', '".$getro[5]."', '".$getro[8]."', '".$getro[10]."', '".$getro[11]."','".$row[1]."_".$insid."')");
if(!$cons)
{
//echo "INSERT INTO `mastersites` (`srno`, `atm_id1`, `cust_id`, `meter_no`, `Consumer_No`, `trackerid`, `bank`) VALUES (NULL, '".$getro[3]."', '".$row[1]."', '".$getro[11]."', '".$getro[1]."','".$row[1]."_".$insid."', '".$row[11]."')<br>";
$err[]="Failed to insert Consumer Details. ".mysqli_error();
}
else
{
$mastqry=mysqli_query($con,"INSERT INTO `mastersites` (`srno`, `atm_id1`, `cust_id`, `meter_no`, `Consumer_No`, `trackerid`, `bank`,`takeoverdt`) VALUES (NULL, '".$getro[3]."', '".$row[1]."', '".$getro[11]."', '".$getro[1]."','".$row[1]."_".$insid."', '".$row[11]."','".$row[63]."')");

}}
}
$site[]=$_POST['siteid'][$i];
}
}//end of num ka Else

$k=$k+1;
}
/*else
{
$ins=mysqli_query($con,"INSERT INTO ".$row[1]."_sites (`cust_id`, `cust_name`, `acmanager`, `acmanagerphone`, `housekeeping`, `housekeeping_rate`, `caretaker`, `caretaker_rate`, `maintenance`, `maintenance_rate`, `bank`, `csslocalbranch`, `zone`, `state`, `region`, `site_id`, `atm_id1`, `atm_id2`, `atm_id3`, `dummyatm_id`, `siteoldmdn_no`, `sitenewmdn_no`, `mdnrsn_no`, `city`, `location`, `atmsite_address`, `site_type`, `city_category`, `takeover_date`, `handover_date`, `hsupervisor_name`, `super_contact`, `caretakersalary1`, `caretakersalary2`, `caretakersalary3`, `caretaker_id1`, `caretaker_doj1`, `caretaker_name1`, `caretaker_acc1`, `caretaker_id2`, `caretaker_doj2`, `caretaker_name2`, `caretaker_acc2`, `caretaker_id3`, `caretaker_doj3`, `caretaker_name3`, `caretaker_acc3`, `cust_remarks`, `cssbilling_remark`, `cssacremarks`) VALUES ('".$row[1]."', '".$row[2]."', '".$row[3]."', '".$row[4]."', '".$row[5]."', '".$row[6]."', '".$row[7]."', '".$row[8]."', '".$row[9]."', '".$row[10]."','".$row[11]."', '".$row[12]."','".$row[13]."', '".$row[14]."', '".$row[15]."', '".$row[16]."', '".$row[17]."', '".$row[18]."', '".$row[19]."', '".$row[20]."', '".$row[21]."', '".$row[22]."', '".$row[23]."', '".$row[24]."', '".$row[25]."', '".$row[26]."', '".$row[27]."', '".$row[28]."', '".$row[29]."', '".$row[30]."', '".$row[31]."', '".$row[32]."', '".$row[33]."', '".$row[34]."', '".$row[35]."', '".$row[36]."', '".$row[7]."', '".$row[38]."', '".$row[39]."', '".$row[40]."', '".$row[41]."', '".$row[42]."', '".$row[43]."', '".$row[44]."', '".$row[45]."', '".$row[46]."', '".$row[47]."', '".$row[48]."', '".$row[49]."', '".$row[50]."')");

$insid=mysqli_insert_id();
if(!$ins)
{
$err[]="Some Error Occurred. ".mysqli_error();
}
else
{
$up=mysqli_query($con,"update ".$row[1]."_sites set trackerid='".$row[1]."_".$insid."' where id='".$insid."'");
echo "Update Takeoverform set trackerid='".$row[1]."_".$insid."' where tempid='".$_POST['site'][$i]."'";

$up2=mysqli_query($con,"Update Takeoverform set trackerid='".$row[1]."_".$insid."' where tempid='".$_POST['site'][$i]."'");

$tkdt=mysqli_query($con,"INSERT INTO `takeoversites` (`id`, `cid`, `atmid`, `takeover_date`, `takeoverfrm`, `status`,`siteid`) VALUES (NULL, '".$row[1]."', '".$row[17]."', '".$row[29]."', '".$row[55]."', '0','".$insid."')");
$site[]=$_POST['siteid'][$i];
}//end of else
}//end of else
*/
}//End For Loop

if($k==0)
{ //header('location:level1approve.php');
 }
else
{
if(count($siteid)>0)
{
$siteid=implode(",",$site);
//echo "Update newtempsites set active='4' where id in(".$siteid.")";
$qry=mysqli_query($con,"Update newtempsites set active='4' where id in(".$siteid.")");
if($qry)
{
}
else
$err[]="Updation of temporary sites failed. Some Error Occurred. ".mysqli_error();
}
if(count($err)>0)
{
?>
<table><tr><td>Sr no</td><td>Error on ATM ID</td></tr>
<?php


for($i=0;$i<count($err);$i++)
{
?>
<tr><td><?php echo $i+1; ?></td><td><?php echo $err[$i]; ?></td></tr>
<?php
}
?>
</table>
<?php
}
else
{
header('location:level1approve.php?msg=Sites Approved Succesfully and Billing will be started based on takeover date');
}


}


?>