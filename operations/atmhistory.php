<?php
include('config.php');
$val=$_GET['val'];
$field=$_GET['field'];
$dt=date('Y-m-d');
$cnt=0;
?><center><h3>Following Match Found</h3></center>
<table border='1'><tr>
<?php
$qry=mysqli_query($con,"select short_name,contact_first from contacts where type='c'");
while($row=mysqli_fetch_array($qry))
{
//echo "select atm_id1,caretaker,takeover_date,handover_date,housekeeping,housekeeping_tkdt,housekeeping_hodt,maintenance,maintenance_tkdt,maintenance_hodt,ebill,atmsite_address from ".$row[0]."_sites where atm_id1='".$val."';";
$site=mysqli_query($con,"select atm_id1,caretaker,takeover_date,handover_date,housekeeping,housekeeping_tkdt,housekeeping_hodt,maintenance,maintenance_tkdt,maintenance_hodt,ebill,atmsite_address from ".$row[0]."_sites where atm_id1='".$val."'");
if(mysqli_num_rows($site)>0)
{
?>
<td>
<?php
$cnt=$cnt+1;
if($cnt%3==0)
{
?>
</tr><tr>
<?php
}
$service='';
//echo $sitero[3]." ".$sitero[6]." ".$sitero[9];
$sitero=mysqli_fetch_row($site);
if($sitero[1]=='Y' && ($sitero[3]=="0000-00-00" || $sitero[3]=='null' || $sitero[3]>=$dt))
$service="Caretaker";
if($sitero[4]=='Y' && ($sitero[6]=="0000-00-00" || $sitero[6]=='null' || $sitero[6]>=$dt))
$service=$service."<br> Housekeeping";
if($sitero[7]=='Y' && ($sitero[9]=="0000-00-00" || $sitero[9]=='null' || $sitero[9]>=$dt))
$service=$service."<br> Maintenance";
if($sitero[10]=='Y')
$service=$service."<br> Ebill";
?>
<table>
<tr><td colspan="2" align="center"><?php echo $row[1]; ?> Sites</td></tr>
<tr><th>Client:</th><td><?php echo $row[1]; ?></td></tr>
<tr><th>Atm:</th><td><?php echo $sitero[0]; ?></td></tr>
<tr><th>Address:</th><td width="150px" style="word-break:break-all;"><?php echo nl2br($sitero[11]); ?></td></tr>
<tr><th>Active Services:</th><td><?php echo $service;  ?></td></tr></table></td>
<?php

}

}

$temp=mysqli_query($con,"select cust_id,cust_name,atm_id1,caretaker,housekeeping,maintenance,ebill,atmsite_address from newtempsites where atm_id1='".$val."'");
if(mysqli_num_rows($temp)>0)
{
$service='';
while($tempro=mysqli_fetch_row($temp)){
 $cnt=$cnt+1;
?>
<td>
<?php
$cnt=$cnt+1;
if($cnt%3==0)
{
?>
</tr><tr>
<?php
}
if($tempro[3]=='Y')
$service="Caretaker";
if($tempro[4]=='Y')
$service=$service."<br> Housekeeping";
if($tempro[5]=='Y')
$service=$service."<br> Maintenance";
if($tempro[6]=='Y')
$service=$service."<br> Ebill";
?>
<tr><td colspan="2" align="center">Temporary Sites</td></tr>
<tr><td><table><tr><th>Client:</th><td><?php echo $tempro[1]; ?></td></tr>
<tr><th>Atm:</th><td><?php echo $tempro[2]; ?></td></tr>
<tr><th>Address:</th><td width="150px" style="word-break:break-all;"><?php echo nl2br($tempro[7]); ?></td></tr>
<tr><th>Active Services:</th><td><?php echo $service;  ?></td></tr></table></td>
<?php
}
}

$cnt=0;
?></tr></table>

