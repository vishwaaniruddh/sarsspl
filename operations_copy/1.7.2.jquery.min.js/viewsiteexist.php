<?php
include("access.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Existing Site Details</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<center>
<input type="button" value="Close" onclick="window.close()" />
<table border="1">

<?php
include("config.php");
$id=$_GET['id'];
//print_r($id);
$id=str_replace(",","','",$id);
$id="'".$id."'";
$cid=$_GET['cid'];
$cl=mysqli_query($con,"select contact_first from contacts where short_name='".$cid."'");
$clro=mysqli_fetch_row($cl);
$qry=mysqli_query($con,"select atm_id1,site_id,projectid,bank,csslocalbranch,zone,state,region,atmsite_address,location,trackerid from ".$cid."_sites where trackerid in (".$id.")");
if(mysqli_num_rows($qry)>0)
{
?>
<tr><th>Tracker ID</th><th>Customer</th><th>Atm ID</th><th>Site ID</th><th>Project ID</th><th>Bank</th><th>CSS Local Branch</th><th>Zone</th><th>State</th><th>Region</th><th>Address</th><th>Location</th></tr>
<?php
while($row=mysqli_fetch_row($qry))
{

?>

<tr>
<td><?php echo $row[10]; ?></td>
<td><?php echo $clro[0]; ?></td>
  <td><?php echo $row[0]; ?></td> 
  <td><?php echo $row[1]; ?></td> 
  <td><?php echo $row[2]; ?></td> 
  <td><?php echo $row[3]; ?></td> 
  <td><?php echo $row[4]; ?></td> 
  <td><?php echo $row[5]; ?></td> 
  <td><?php echo $row[6]; ?></td> 
  <td><?php echo $row[7]; ?></td> 
  <td><?php echo $row[8]; ?></td> 
  <td><?php echo $row[9]; ?></td> 
   </tr>
<!--<tr><td>Bank</td><td><?php echo $row[4]; ?></td></tr>
<tr><td>Bank</td><td><?php echo $row[4]; ?></td></tr>-->

<?php } }?></table>
</center>
</body>
</html>