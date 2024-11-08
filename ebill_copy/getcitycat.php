<?php
include("config.php");
$cid=$_GET['cid'];
//echo "select distinct(city_category) from ".$cid."_sites";
$qry=mysqli_query($con,"select distinct(city_category) from ".$cid."_sites where city_category is not null and city_category<>''");
?>
<option value="-1">City Category</option>
<?php
while($row=mysqli_fetch_array($qry))
{
?>
<option value="<?php echo $row[0]; ?>"><?php if($row[0]==''){ echo "NA"; }else{ echo $row[0]; } ?></option>
<?php
}
$qry2=mysqli_query($con,"select distinct(bank) from ".$cid."_sites where bank is not null and bank<>''");
?><option value="">Leave Blank</option>
******<option value="-1">Select Bank</option>
<?php
while($row2=mysqli_fetch_array($qry2))
{
?>
<option value="<?php echo $row2[0]; ?>"><?php  echo $row2[0]; ?></option>
<?php
}
$qry3=mysqli_query($con,"select distinct((subcat)) from ".$cid."_sites where subcat is not null and subcat<>''");
?><option value="">Leave Blank</option>
******<option value="-1">Select Subcategory</option>
<?php
while($row3=mysqli_fetch_array($qry3))
{
?>
<option value="<?php echo $row3[0]; ?>"><?php  echo $row3[0]; ?></option>
<?php
}
$qry4=mysqli_query($con,"select distinct(zone) from ".$cid."_sites where zone is not null and zone<>''");
?><option value="">Leave Blank</option>
******<option value="-1">Select Zone</option>
<?php
while($row4=mysqli_fetch_array($qry4))
{
?>
<option value="<?php echo $row4[0]; ?>"><?php  echo $row4[0]; ?></option>
<?php
}
$qry5=mysqli_query($con,"select distinct(projectid) from ".$cid."_sites where projectid is not null and projectid<>''");
?><option value="">Leave Blank</option>
******<option value="-1">Select ProjectID</option>
<?php
while($row5=mysqli_fetch_array($qry5))
{
?>
<option value="<?php echo $row5[0]; ?>"><?php  echo $row5[0]; ?></option>
<?php
}
?><option value="">Leave Blank</option>