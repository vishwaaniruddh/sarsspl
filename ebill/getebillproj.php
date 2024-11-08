<?php
include("config.php");
$val=$_GET['val'];
//$qry=mysqli_query($con,"Select Distinct(s.bank) from ".$val."_sites s,ebill e where s.atm_id1=e.ATM_ID and s.cust_id='".$val."' and e.Active='Y'");
//if it is from sites
if(isset($_GET['type']))
$sql="Select Distinct(projectid) from ".$val."_sites  where  Active='Y' and ebill='Y' order by projectid ASC";
else
$sql="Select Distinct(projectid) from ".$val."_sites  where  Active='Y' and ebill='Y' order by projectid ASC";

//echo $sql;
$qry=mysqli_query($con,$sql);


?>
<!--<select id='bank' name='bank'>--><option value="">Select Project</option>
<?php
while($row=mysqli_fetch_array($qry))
{
if($row[0]!=''){
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
<?php
}
}
?><option value="">All</option><!--</select>-->