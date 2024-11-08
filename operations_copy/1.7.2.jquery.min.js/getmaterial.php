<?php
$val=$_GET['val'];
$val2=$_GET['val2'];
$type=$_GET['type'];
?>
<option value="-1">Select</option><?php
include("config.php");

$sql="select ";

if($type=='material')
$sql.="distinct(description) ";
elseif($type=='asset')
$sql.="distinct(problem) ";

$sql.="from atmassets where status=0";
if($val!='-1')
$sql.=" and now='".$val."'";
if($val2!='-1' && $val2!='')
$sql.=" and problem='".$val2."'";
echo $sql;
$qry=mysqli_query($con,$sql);
if(!$qry)
echo mysqli_error();
while($row=mysqli_fetch_array($qry))
{
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
<?php
}
?>