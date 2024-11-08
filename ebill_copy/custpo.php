<?php
include("config.php");
$cid=$_GET['cid'];
$project=$_GET['proj'];
$project=str_replace(",","','",$project);
if($project!='-1')
$project="'".$project."'";
$bank=str_replace(",","','",$_GET['bank']);
if($bank!='-1')
$bank="'".$bank."'";
$service=$_GET['service'];
$str='';
$service2=explode(" ",$service);
$service=$service2[0];
$qrstr='';
if($service2[1]=='CT')
$qrstr=" and caretaker='Y'";
if($service2[1]=='HK')
$qrstr=" and housekeeping='Y'";

if(isset($_GET['tp']) && $_GET['tp']=='po')
{
$str="select distinct p.po from tatapo p,".$cid."_sites s where s.atm_id1=p.atmid and s.".$service."='Y' ".$qrstr."";
if($project!='' && $project !='-1' && $project!='x@')
$str.=" and s.projectid in ($project)";
if($bank!='' && $bank !='-1')
$str.=" and s.bank in ($bank)";

$str.=" order by p.po ASC";
echo $str;
$qry=mysqli_query($con,$str);
if(!$qry)
echo mysqli_error();
?>
<option value="">Select PO</option>
<?php
while($ro=mysqli_fetch_row($qry))
{
//echo $ro[0];
?>
<option value="<?php echo $ro[0]; ?>"><?php echo $ro[0]; ?></option>
<?php
}
?><option value="">All</option>

<?php

} 
elseif(isset($_GET['tp']) && $_GET['tp']=='zone')
{
$po=$_GET['po'];
$str="select distinct s.".$_GET['tp']." from tatapo p,".$cid."_sites s where s.".$service."='Y' ".$qrstr."";
if($project!='' && $project !='-1' && $project!='x@')
$str.=" and s.projectid in ($project)";
if($bank!='' && $bank !='-1')
$str.=" and s.bank in ($bank)";
if($po!='' && $po!='false')
$str.="  and s.atm_id1=p.atmid  and p.po='".$po."'";
$str.=" order by s.".$_GET['tp']." ASC";
//echo $str;
$qry=mysqli_query($con,$str);
if(!$qry)
echo mysqli_error();
?>
<option value="">Select <?php echo $_GET['tp']; ?></option>
<?php
while($ro=mysqli_fetch_row($qry))
{
?>
<option value="<?php echo $ro[0]; ?>"><?php echo $ro[0]; ?></option>
<?php
}
?><option value="">All</option>

<?php


}
 ?>
