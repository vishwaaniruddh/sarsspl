<?php
include("config.php");
if(isset($_POST['cmdsub']))
{
$k=0;
$site=array();
$err=array();
//echo count($_POST['siteid']);
for($i=0;$i<count($_POST['siteid']);$i++)
{
if(isset($_POST['siteid'][$i]))
{
$stid=$_POST['siteid'][$i];
//echo "select * from newtempsites where id='".$stid."'<br>";
$query=mysqli_query($con,"select * from newtempsites where id='".$stid."'");
$row=mysqli_fetch_row($query);
$get=mysqli_query($con,"select * from tempebill where tempid='".$row[0]."'");
$getro=mysqli_fetch_row($get);
//echo "select * from ".$row[1]."_sites where atm_id1='".$row[17]."'<br>";
$atm=mysqli_query($con,"select * from ".$row[1]."_sites where atm_id1='".$row[17]."'");
if($row[17]!='Under Construction' || $row[17]!='Not Live' || $row[17]!='')
{
$num=mysqli_num_rows($atm);
}
else
{
$num=0;
}


//echo $num;
if($num>0)
{
//echo "Site Already Available<br>";
$atmro=mysqli_fetch_row($atm);
$find=mysqli_query($con,"select * from mastersites where trackerid='".$atmro[54]."'");
//echo "select * from ".$row[1]."_ebill where atmtrackid='".$atmro[54]."'";
$qr=mysqli_query($con,"select * from ".$row[1]."_ebill where atmtrackid='".$atmro[54]."'");
if(mysqli_num_rows($qr)>0)
{
//$getdet=mysqli_fetch_row($qr);
//echo "update ".$row[1]."_sites set ebill='Y' where trackerid='".$atmro[54]."'";
$up=mysqli_query($con,"update ".$row[1]."_sites set ebill='Y' where trackerid='".$atmro[54]."'");
if(mysqli_num_rows($find)==0){
$mastqry=mysqli_query($con,"INSERT INTO `mastersites` (`srno`, `atm_id1`, `cust_id`, `meter_no`, `Consumer_No`, `trackerid`, `bank`,`takeoverdt`) VALUES (NULL, '".$getro[3]."', '".$row[1]."', '".$getro[11]."', '".$getro[1]."','".$row[1]."_".$inid."', '".$row[11]."','".$row[63]."')");
}
//$err[]="Atm ID already Exists. ";
$site[]=$stid;
}
else{
//echo "Ebill also available<br>";
//echo "select * from tempebill where tempid='".$row[0]."'<br>";

if($row[53]=='Y')
{
//echo "INSERT INTO ".$row[1]."_ebill (`id`, `Consumer_No`, `Distributor`, `ATM_ID`, `Due_Date`, `landlord`, `averagebill`,`billing_unit`,`meter_no`,`atmtrackid`) VALUES (NULL, '".$getro[1]."', '".$getro[2]."', '".$getro[3]."', '".$getro[4]."', '".$getro[5]."', '".$getro[8]."', '".$getro[10]."', '".$getro[11]."','".$atmro[54]."')<br>";

$cons=mysqli_query($con,"INSERT INTO ".$row[1]."_ebill (`id`, `Consumer_No`, `Distributor`, `ATM_ID`, `Due_Date`, `landlord`, `averagebill`,`billing_unit`,`meter_no`,`atmtrackid`) VALUES (NULL, '".$getro[1]."', '".$getro[2]."', '".$getro[3]."', '".$getro[4]."', '".$getro[5]."', '".$getro[8]."', '".$getro[10]."', '".$getro[11]."','".$atmro[54]."')");

if(mysqli_num_rows($find)==0){
$mastqry=mysqli_query($con,"INSERT INTO `mastersites` (`srno`, `atm_id1`, `cust_id`, `meter_no`, `Consumer_No`, `trackerid`, `bank`,`takeoverdt`) VALUES (NULL, '".$getro[3]."', '".$row[1]."', '".$getro[11]."', '".$getro[1]."','".$row[1]."_".$inid."', '".$row[11]."','".$row[63]."')");
}
if(!$cons)
$err[]="Failed to insert Consumer Details. ".mysqli_error();
else
$site[]=$stid;
}
}
}
else
{
//echo "New Site<br>";
$newsite= "INSERT INTO ".$row[1]."_sites (`cust_id`, `cust_name`, `acmanager`, `acmanagerphone`, `housekeeping`, `housekeeping_rate`, `caretaker`, `caretaker_rate`, `maintenance`, `maintenance_rate`, `bank`, `csslocalbranch`, `zone`, `state`, `region`, `site_id`, `atm_id1`, `atm_id2`, `atm_id3`, `dummyatm_id`, `siteoldmdn_no`, `sitenewmdn_no`, `mdnrsn_no`, `city`, `location`, `atmsite_address`, `site_type`, `city_category`, `takeover_date`, `handover_date`, `hsupervisor_name`, `super_contact`, `caretakersalary1`, `caretakersalary2`, `caretakersalary3`, `caretaker_id1`, `caretaker_doj1`, `caretaker_name1`, `caretaker_acc1`, `caretaker_id2`, `caretaker_doj2`, `caretaker_name2`, `caretaker_acc2`, `caretaker_id3`, `caretaker_doj3`, `caretaker_name3`, `caretaker_acc3`, `cust_remarks`, `cssbilling_remark`, `cssacremarks`, `ebill`,housekeeping_tkdt,maintenance_tkdt,`projectid`) VALUES ('".$row[1]."', '".$row[2]."', '".$row[3]."', '".$row[4]."', '".$row[5]."', '".$row[6]."', '".$row[7]."', '".$row[8]."', '".$row[9]."', '".$row[10]."','".$row[11]."', '".$row[12]."','".$row[13]."', '".$row[14]."', '".$row[15]."', '".$row[16]."', '".$row[17]."', '".$row[18]."', '".$row[19]."', '".$row[20]."', '".$row[21]."', '".$row[22]."', '".$row[23]."', '".$row[24]."', '".$row[25]."', '".$row[26]."', '".$row[27]."', '".$row[28]."', '".$row[29]."', '".$row[30]."', '".$row[31]."', '".$row[32]."', '".$row[33]."', '".$row[34]."', '".$row[35]."', '".$row[36]."', '".$row[7]."', '".$row[38]."', '".$row[39]."', '".$row[40]."', '".$row[41]."', '".$row[42]."', '".$row[43]."', '".$row[44]."', '".$row[45]."', '".$row[46]."', '".$row[47]."', '".$row[48]."', '".$row[49]."', '".$row[50]."', '".$row[53]."','".$row[61]."','".$row[62]."','".$row[52]."')";

$inid=0;
//echo $newsite."<br>";
$ins=mysqli_query($con,$newsite);
$newsiteid=mysqli_insert_id($ins);
//echo "select max(id) from ".$row[1]."_sites<br>";
$in=mysqli_query($con,"select max(id) from ".$row[1]."_sites");
$insr=mysqli_fetch_row($in);
if($newsiteid=='')
$inid=$insr[0];
else
$inid=$newsiteid;


if(!$ins)
{


$err[]="failed to insert site with atmid  ".$row[17]." ".mysqli_error();
}
else
{
//echo "update ".$row[1]."_sites set trackerid='".$row[1]."_".$inid."' where id='".$inid."'<br>";
$up=mysqli_query($con,"update ".$row[1]."_sites set trackerid='".$row[1]."_".$inid."' where id='".$inid."'");
//echo "Update Takeoverform set trackerid='".$row[1]."_".$inid."' where tempid='".$row[0]."'<br>";
$up2=mysqli_query($con,"Update Takeoverform set trackerid='".$row[1]."_".$inid."' where tempid='".$row[0]."'");
if($row[5]=='Y')
$tkdt=mysqli_query($con,"INSERT INTO `takeoversites` (`id`, `cid`, `atmid`, `takeover_date`, `takeoverfrm`, `status`,`trackerid`,service) VALUES (NULL, '".$row[1]."', '".$row[17]."', '".$row[61]."', '".$row[55]."', '0','".$row[1]."_".$inid."','housekeeping')");

if($row[7]=='Y')
$tkdt2=mysqli_query($con,"INSERT INTO `takeoversites` (`id`, `cid`, `atmid`, `takeover_date`, `takeoverfrm`, `status`,`trackerid`,service) VALUES (NULL, '".$row[1]."', '".$row[17]."', '".$row[29]."', '".$row[55]."', '0','".$row[1]."_".$inid."','caretaker')");

if($row[9]=='Y')
$tkdt3=mysqli_query($con,"INSERT INTO `takeoversites` (`id`, `cid`, `atmid`, `takeover_date`, `takeoverfrm`, `status`,`trackerid`,service) VALUES (NULL, '".$row[1]."', '".$row[17]."', '".$row[62]."', '".$row[55]."', '0','".$row[1]."_".$inid."','maintenance')");

if($row[53]=='Y')
$tkdt4=mysqli_query($con,"INSERT INTO `takeoversites` (`id`, `cid`, `atmid`, `takeover_date`, `takeoverfrm`, `status`,`trackerid`,service) VALUES (NULL, '".$row[1]."', '".$row[17]."', '".$row[63]."', '".$row[55]."', '0','".$row[1]."_".$inid."','ebill')");
$get=mysqli_query($con,"select * from tempebill where tempid='".$stid."'");
$getro=mysqli_fetch_row($get);
if($row[53]=='Y')
{
//echo "INSERT INTO ".$row[1]."_ebill (`id`, `Consumer_No`, `Distributor`, `ATM_ID`, `Due_Date`, `landlord`, `averagebill`,`billing_unit`,`meter_no`,`atmtrackid`) VALUES (NULL, '".$getro[1]."', '".$getro[2]."', '".$getro[3]."', '".$getro[4]."', '".$getro[5]."', '".$getro[8]."', '".$getro[10]."', '".$getro[11]."','".$row[1]."_".$inid."')<br>";
$cons=mysqli_query($con,"INSERT INTO ".$row[1]."_ebill (`id`, `Consumer_No`, `Distributor`, `ATM_ID`, `Due_Date`, `landlord`, `averagebill`,`billing_unit`,`meter_no`,`atmtrackid`) VALUES (NULL, '".$getro[1]."', '".$getro[2]."', '".$getro[3]."', '".$getro[4]."', '".$getro[5]."', '".$getro[8]."', '".$getro[10]."', '".$getro[11]."','".$row[1]."_".$inid."')");
if(!$cons)
{
//echo "INSERT INTO `mastersites` (`srno`, `atm_id1`, `cust_id`, `meter_no`, `Consumer_No`, `trackerid`, `bank`) VALUES (NULL, '".$getro[3]."', '".$row[1]."', '".$getro[11]."', '".$getro[1]."','".$row[1]."_".$inid."', '".$row[11]."')<br>";
$err[]="Failed to insert Consumer Details. ".mysqli_error();
}
else
{
$mastqry=mysqli_query($con,"INSERT INTO `mastersites` (`srno`, `atm_id1`, `cust_id`, `meter_no`, `Consumer_No`, `trackerid`, `bank`,`takeoverdt`) VALUES (NULL, '".$getro[3]."', '".$row[1]."', '".$getro[11]."', '".$getro[1]."','".$row[1]."_".$inid."', '".$row[11]."','".$row[63]."')");
$site[]=$stid;
}
}
}
}

$k=$k+1;
}
}
if($k==0)
header('location:level1ebillapp.php');
else
{

?>

<?php
//echo count($site);
if(count($site)>0)
{
 $siteid=implode(",",$site);
//echo "Update newtempsites set ebillstat='5' where id in(".$siteid.")";
$qry=mysqli_query($con,"Update newtempsites set ebillstat='5',active='5' where id in(".$siteid.")");
if($qry)
{
}
else
$err[]="Updation of temporary sites failed. Some Error Occurred. ".mysqli_error();
}
//echo count($err);
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
//echo "hello";
//header('location:level1ebillapp.php?msg=Sites Approved Succesfully and Billing will be started based on takeover date');
?>
<script type="text/javascript">
alert("Site updated succesfully");
window.location="level1ebillapp.php?msg=Sites Approved Succesfully and Billing will be started based on takeover date";
</script>
<?php
}


}

}
?>