<?php
/*include("config.php");
 $id=$_GET['id'];
$stat=$_GET['stat'];
//echo "select * from transfer_req where transferid='".$id."'";
$qry=mysqli_query($con,"select * from transfer_req where transferid='".$id."'");
$row=mysqli_fetch_row($qry);

//echo "<br>select * from account_manager where cust_id='".$row[2]."'";
$acc=mysqli_query($con,"select * from account_manager where cust_id='".$row[2]."'");
$acro=mysqli_fetch_row($acc);
$sql2="select housekeeping,housekeeping_rate,caretaker,caretaker_rate,maintenance,maintenance_rate,bank,csslocalbranch,zone,state,region,site_id,atm_id1,atm_id2,atm_id3,dummyatm_id,siteoldmdn_no,sitenewmdn_no,	mdnrsn_no,city,location,atmsite_address,site_type,city_category,takeover_date,handover_date,hsupervisor_name,super_contact,caretakersalary1,caretakersalary2,caretakersalary3,caretaker_id1,	caretaker_doj1,caretaker_name1,caretaker_acc1,caretaker_id2,caretaker_doj2,caretaker_name2,caretaker_acc2,caretaker_id3,caretaker_doj3,caretaker_name3,caretaker_acc3,cust_remarks,cssbilling_remark,cssacremarks,active,ebill,projectid,trackerid from ".$row[1]."_sites where trackerid='".$row[11]."'";
//echo $sql2."<br><br>";
$site=mysqli_query($con,$sql2);
$sitero=mysqli_fetch_row($site);

$mast=mysqli_query($con,"update mastersites set status='1' where trackerid='".$sitero[49]."'");
$sql="INSERT INTO `".$row[2]."_sites` (`acmanager`, `acmanagerphone`, `housekeeping`, `housekeeping_rate`, `caretaker`, `caretaker_rate`, `maintenance`, `maintenance_rate`, `bank`, `csslocalbranch`, `zone`, `state`, `region`, `site_id`, `atm_id1`, `atm_id2`, `atm_id3`, `dummyatm_id`, `siteoldmdn_no`, `sitenewmdn_no`, `mdnrsn_no`, `city`, `location`, `atmsite_address`, `site_type`, `city_category`, `takeover_date`, `handover_date`, `hsupervisor_name`, `super_contact`, `caretakersalary1`, `caretakersalary2`, `caretakersalary3`, `caretaker_id1`, `caretaker_doj1`, `caretaker_name1`, `caretaker_acc1`, `caretaker_id2`, `caretaker_doj2`, `caretaker_name2`, `caretaker_acc2`, `caretaker_id3`, `caretaker_doj3`, `caretaker_name3`, `caretaker_acc3`, `cust_remarks`, `cssbilling_remark`, `cssacremarks`, `active`, `ebill`, `projectid`) VALUES ('".$acro[0]."', '".$acro[1]."','".$sitero[0]."','".$sitero[1]."', '".$sitero[2]."', '".$sitero[3]."', '".$sitero[4]."', '".$sitero[5]."', '".$sitero[6]."', '".$sitero[7]."', '".$sitero[8]."', '".$sitero[9]."', '".$sitero[10]."', '".$sitero[11]."', '".$sitero[12]."', '".$sitero[13]."', '".$sitero[14]."', '".$sitero[15]."', '".$sitero[16]."', '".$sitero[17]."', '".$sitero[18]."', '".$sitero[19]."', '".$sitero[20]."', '".$sitero[21]."', '".$sitero[22]."', '".$sitero[23]."', '".$row[5]."', '".$sitero[25]."', '".$row[2]."', '".$sitero[27]."', '".$sitero[28]."', '".$sitero[29]."', '".$sitero[30]."', '".$sitero[31]."', '".$sitero[32]."', '".$sitero[33]."', '".$sitero[34]."', '".$sitero[35]."', '".$sitero[36]."', '".$sitero[37]."', '".$sitero[38]."', '".$sitero[39]."', '".$sitero[40]."', '".$sitero[41]."', '".$sitero[42]."', '".$sitero[43]."', '".$sitero[44]."', '".$sitero[45]."', 'Y', '".$sitero[47]."', '".$sitero[48]."')";
//echo $sql;
$ins=mysqli_query($con,$sql);
$idr=mysqli_query($con,"select max(id) from ".$row[2]."_sites");
$idrr=mysqli_fetch_row($idr);

$trackid=$row[2]."_".$idrr[0];
$upp=mysqli_query($con,"update ".$row[2]."_sites set trackerid='".$trackid."' where id='".$idrr[0]."'");
if($sitero[47]=='Y' || $sitero[47]=='y')
{
//echo "select Consumer_No,Distributor,ATM_ID,Due_Date,landlord,billing_unit,meter_no,averagebill from ".$row[1]."_ebill where atm_id='".$row[3]."'";
$cons=mysqli_query($con,"select Consumer_No,Distributor,ATM_ID,Due_Date,landlord,billing_unit,meter_no,averagebill from ".$row[1]."_ebill where atm_id='".$row[3]."'");
if(mysqli_num_rows($cons)>0)
{
$consro=mysqli_fetch_row($cons);
$consins=mysqli_query($con,"INSERT INTO `".$row[2]."_ebill` (`id`, `Consumer_No`, `Distributor`, `atm_id`, `Due_date`, `landlord`, `billing_unit`, `meter_no`, `averagebill`,atmtrackid) VALUES (NULL, '".$consro[0]."', '".$consro[1]."', '".$row[3]."', '".$consro[3]."', '".$consro[4]."', '".$consro[5]."', '".$consro[6]."', '".$consro[7]."','".$trackid."')");
$mstins=mysqli_query($con,"INSERT INTO `mastersites` (`srno`, `atm_id1`, `cust_id`, `meter_no`, `Consumer_No`, `trackerid`, `bank`, `status`) VALUES (NULL, '".$sitero[12]."', '', '', '', '', '', '0')");
if(!$consins)
echo mysqli_error();
}

if($ins)
{
$hand=mysqli_query($con,"INSERT INTO `handoversites` (`id`, `cid`, `takeoverdt`, `handoverdt`, `handoverform`, `atmid`,`trackerid`) VALUES (NULL, '".$row[1]."', '".$sitero[24]."', '".$row[4]."', '".$row[6]."', '".$row[3]."','".$sitero[49]."')");
$handid=mysqli_query($con,"select max(id) from handoversites");
$hndr=mysqli_fetch_row($handid);
$up=mysqli_query($con,"Update ".$row[1]."_sites set handover_date='".$row[4]."' where atm_id1='".$row[3]."'");
$uptrans=mysqli_query($con,"Update transfer_req set status='2' where transferid='".$id."'");
if($up && $uptrans && $hand)
echo "1";
else
{
$delh=mysqli_query($con,"Delete from `handoversites` where id='".$hndr[0]."'");
$del=mysqli_query($con,"Delete from ".$row[2]."_sites where trackerid='".$trackid."'");
$del2=mysqli_query($con,"Delete from ".$row[2]."_ebill where atmtrackid='".$trackid."'");
//$up=mysqli_query($con,"Update ".$row[1]."_sites set active='0' where trackerid='".$row[3]."'");
$uptrans=mysqli_query($con,"Update transfer_req set status='1' where transferid='".$id."'");
echo "0";
}
}
else
{
$del=mysqli_query($con,"Delete from ".$row[2]."_sites where trackerid='".$trackid."'");
$del2=mysqli_query($con,"Delete from ".$row[2]."_ebill where atmtrackid='".$trackid."'");
$up=mysqli_query($con,"Update ".$row[1]."_sites set handover_date='0000-00-00' where trackerid='".$sitero[49]."'");
$uptrans=mysqli_query($con,"Update transfer_req set status='1' where transferid='".$id."'");
echo "0";
}
}
else
{
if(!$ins)
{
$del=mysqli_query($con,"Delete from ".$row[2]."_sites where trackerid='".$trackid."'");
$del2=mysqli_query($con,"Delete from ".$row[2]."_ebill where atmtrackid='".$trackid."'");
//$up=mysqli_query($con,"Update ".$row[1]."_sites set active='0' where atm_id1='".$row[3]."'");
$uptrans=mysqli_query($con,"Update transfer_req set status='1' where transferid='".$id."'");
echo "0";
}
else
{
$hand=mysqli_query($con,"INSERT INTO `handoversites` (`id`, `cid`, `takeoverdt`, `handoverdt`, `handoverform`, `atmid`,trackerid) VALUES (NULL, '".$row[1]."', '".$sitero[24]."', '".$row[4]."', '".$row[6]."', '".$row[3]."','".$row[11]."')");
$handid=mysqli_insert_id();
$up=mysqli_query($con,"Update ".$row[1]."_sites set handover_date='".$row[4]."' where trackerid='".$sitero[49]."'");
$uptrans=mysqli_query($con,"Update transfer_req set status='2' where transferid='".$id."'");
if($up && $uptrans)
echo "1";
else
{
$delh=mysqli_query($con,"Delete from `handoversites` where id='".$handid."'");
$del=mysqli_query($con,"Delete from ".$row[2]."_sites where trackerid='".$trackid."'");
$del2=mysqli_query($con,"Delete from ".$row[2]."_ebill where atmtrackid='".$trackid."'");
$up=mysqli_query($con,"Update ".$row[1]."_sites set handover_date='0000-00-00' where trackerid='".$sitero[49]."'");
$uptrans=mysqli_query($con,"Update transfer_req set status='1' where transferid='".$id."'");
echo "0";
}
}
}*/


include("config.php");
if(!$_SESSION['user'])
{
echo "0";
}
else
{
 $id=$_GET['id'];
$stat=$_GET['stat'];
//echo "select * from transfer_req where transferid='".$id."'";
$qry=mysqli_query($con,"select * from transfer_req where transferid='".$id."'");
$row=mysqli_fetch_row($qry);
$sql2="select housekeeping,housekeeping_rate,caretaker,caretaker_rate,maintenance,maintenance_rate,bank,csslocalbranch,zone,state,region,site_id,atm_id1,atm_id2,atm_id3,dummyatm_id,siteoldmdn_no,sitenewmdn_no,	mdnrsn_no,city,location,atmsite_address,site_type,city_category,takeover_date,handover_date,hsupervisor_name,super_contact,caretakersalary1,caretakersalary2,caretakersalary3,caretaker_id1,	caretaker_doj1,caretaker_name1,caretaker_acc1,caretaker_id2,caretaker_doj2,caretaker_name2,caretaker_acc2,caretaker_id3,caretaker_doj3,caretaker_name3,caretaker_acc3,cust_remarks,cssbilling_remark,cssacremarks,active,ebill,projectid,trackerid from ".$row[1]."_sites where trackerid='".$row[11]."'";
echo $sql2."<br><br>";
$site=mysqli_query($con,$sql2);
$sitero=mysqli_fetch_row($site);


}
?>