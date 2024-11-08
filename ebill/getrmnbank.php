<?php
include("config.php");
$cid=$_GET['cid'];
$qry=mysqli_query($con,"select distinct(bank) from ".$cid."_sites where  bank<>'' order by bank ASC");
?>
<option value="">Select Bank</option>
<?php
while($ro=mysqli_fetch_array($qry))
{
?>
<option value="<?php echo $ro[0]; ?>"><?php echo $ro[0]; ?></option>
<?php
}
?>