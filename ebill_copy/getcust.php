<?php
include("config.php");
//echo $_GET['tp'];

if(isset($_GET['tp']))
{
 $service=$_GET['service'];
 $cid=$_GET['cid'];
$str='';

$service2=explode(" ",$service);
$service=$service2[0];
$qrstr='';
if($service2[1]=='CT')
$qrstr=" and caretaker='Y'";
if($service2[1]=='HK')
$qrstr=" and housekeeping='Y'";
$str="select distinct(projectid) from ".$cid."_sites where active='Y' and ".$service."='Y' ".$qrstr." and projectid<>''";

//echo $str;
$sql=mysqli_query($con,$str);
?>
<option value="x@">Select</option>
<?php
while($row=mysqli_fetch_array($sql))
{
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
<?php
}
?>
<option value="-1">All</option>
<?php

echo "###project";

}
else
{
 $val=$_GET['val'];
$type=$_GET['type'];
// $_GET['par'];

if($type=='cid')
{
$str='';
$str.="Select short_name,contact_first from contacts where 1 ";
if($val=='caretaker')
$str.=" and caretaker='Y'";
if($val=='housekeeping')
$str.=" and housekeeping='Y'";
if($val=='maintenance')
$str.=" and maintenance='Y'";
if($val=='maintenance HK')
$str.=" and maintenance='Y' and housekeeping='Y'";
if($val=='maintenance CT')
$str.=" and maintenance='Y' and caretaker='Y'";
if(isset($_GET['par']) && $_GET['par']!='')
$str.=" and cust_id='".$_GET['par']."'";

$str.=" order by cust_name ASC";
//echo $str;
$qry=mysqli_query($con,$str);
?>
<option value=''>Select</option>
<?php
while($row=mysqli_fetch_array($qry))
{
?>
<option value="<?php echo $row[1]; ?>"><?php echo $row[1]; ?></option>
<?php
}
}
elseif($type=='bank')
{
if(isset($_GET['par']))
$par=$_GET['par'];
$str='';
$str.="Select distinct(bank) from ".$val."_sites where 1 ";
if($par=='caretaker')
$str.=" and caretaker='Y'";
if($par=='housekeeping')
$str.=" and housekeeping='Y'";
if($par=='maintenance')
$str.=" and maintenance='Y'";
if($par=='maintenance HK')
$str.=" and maintenance='Y' and housekeeping='Y'";
if($par=='maintenance CT')
$str.=" and maintenance='Y' and caretaker='Y'";
$str.=" order by bank ASC";

//echo $str;
$qry=mysqli_query($con,$str);
?>
<option value=''>Select</option>
<?php
while($row=mysqli_fetch_array($qry))
{
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
<?php
}
?>
<option value='-1'>All</option>
<?php
}
}
?>