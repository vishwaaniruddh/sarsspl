<?php
include("config.php");
$val=$_GET['val'];


$sql="Select Distinct(bank) from ".$val."_sites  where  Active='Y' order by bank ASC";

//echo $sql;
$qry=mysqli_query($con,$sql);
?>
<option value="0">Select Bank</option>
<?php
while($row=mysqli_fetch_array($qry))
{
if($row[0]!='')
{

?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
<?php
}
}
?><!--</select>-->