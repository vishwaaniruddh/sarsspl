<?php
include("config.php");
$cust=$_GET['val'];
$proj=$_GET['proj'];
$stat=$_GET['stat'];
//echo "Select Distinct(bank) from newtempsites where cust_id='".$proj."' and project='".$cust."' and (active='2' or active='3') ";
$qry=mysqli_query($con,"Select Distinct(bank) from newtempsites where cust_id='".$proj."' and project='".$cust."' and (active='2' or active='3') ");
//echo mysqli_num_rows($qry);
if(!$qry)
echo "failed".mysqli_error();
?>
<option value="">Select Bank</option>
<?php
while($row=mysqli_fetch_array($qry))
{
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
<?php
}
?>