<?php
include("config.php");
$cid=$_GET['cid'];
$cat='-1';
$bank='-1';
$subcat='-1';
if(isset($_GET['cat']))
$cat=$_GET['cat'];
if(isset($_GET['bank']))
$bank=$_GET['bank'];
if(isset($_GET['subcat']))
 $subcat=$_GET['subcat'];
 
 
//echo $cid." ".$cat;
//echo "select atm_id1 from ".$cid."_sites where city_category='".$cat."'";
$str="select atm_id1 from ".$cid."_sites where 1 ";
if($cat!='-1')
$str.=" city_category='".$cat."'";
if($bank!='-1')
$str.=" and bank='".$bank."'";
if($subcat!='-1')
$str.=" and subcat='".$subcat."'";
if(isset($_GET['proj']) && $_GET['proj']!='-1' && $_GET['proj']!='false')
 {
 $proj=str_replace(",","','",$_GET['proj']);
 $proj="'".$proj."'";
 $str.=" and projectid in ($proj)";
 }
 if(isset($_GET['service']) && $_GET['service']!='-1')
 {

 $str.=" and ".$_GET['service']."='Y'";
 }
 $str.=" order by atm_id1 ASC";
//echo $str;
$qry=mysqli_query($con,$str);
$i=0;
$atm='';
?>
<option value="">Select Atm</option>
<?php
while($row=mysqli_fetch_array($qry))
{
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
<?php
}
//echo $atm;
?><option value="-1">All</option>