<?php
session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='textr/javascript'>window.location='index.php';</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function confirm_delete(id)
{
	if (confirm("Are you sure you want to delete this entry?"))
	{
		document.location="delete_areahead.php?id="+id;
	}
	
}
</script>
</head>

<body>
<?php
include("menubar.php")
?>
<center>
<h2>View Area Head</h2>
<div id="header">
<table width="590" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;">
<th width="150">Name</th>
<th width="111">CSS Local Branch</th>

<th width="68">Email</th>
<th width="79">Contact</th>
<th width="40">Edit</th>
<th width="45">Delete</th>

<?php
include_once('config.php');

$city_head=mysqli_query($con,"select * from branch_head where status='1' order by head_name ASC");
while($row=mysqli_fetch_row($city_head))
{
$brnch=array();
	$br=mysqli_query($con,"select location from cssbranch where id in (".$row[1].")");
	while($brro=mysqli_fetch_array($br))
	$brnch[]=$brro[0];
?>
<tr>
<td><?php echo $row[2]; ?></td>
<td><?php echo implode(",",$brnch); ?></td>
<!--<td><?php echo $row[2]; ?></td>-->
<td><?php echo $row[3]; ?></td>
<td><?php echo $row[4]; ?></td>
<td width="40" height="31"> <a href='edit_areahead.php?id=<?php echo $row[0]; ?>'> Edit </a></td>
<td width="45" height="31">  <a href="javascript:confirm_delete(<?php echo $row[0]; ?>);"> Delete </a></td>
</tr>
<?php } ?>
</table>
</div>
</center>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>