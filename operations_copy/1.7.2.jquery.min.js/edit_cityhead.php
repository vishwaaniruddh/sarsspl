<?php include("access.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<title>CSS-<?php echo $_SESSION['user']; ?></title>
</head>

<body>
<center>
<?php include("menubar.php"); ?>
<h2>Edit Branch Head Details</h2>
<?php
$state=array();
$id=$_GET['id'];
include("config.php");
$qry=mysqli_query($con,"select * from branch_head where head_id='".$id."'");
$crow=mysqli_fetch_row($qry);
$qry4=mysqli_query($con,"select * from login where srno='".$crow[6]."'");
$row4=mysqli_fetch_row($qry4);
$br1=str_replace(",","','",$row4[3]);
$br1="'".$br1."'";
//echo "select state_id,state from state where state_id IN ($br1)";
//echo "select state_id,state from state where state_id NOT IN ($br1)";
//echo "select state_id,state from state where state_id IN ($br1)";	
$st=mysqli_query($con,"select id,location from cssbranch where id IN ($br1)");

while($row2=mysqli_fetch_row($st))
{
$state[]=$row2[1];
}	


//$qry2=mysqli_query($con,"select state from branch_details where branchid='".$crow[1]."'");
//$state=mysqli_fetch_row($qry2);
//echo $state[0];
include_once('class_files/select.php');
$sel_obj=new select();
//$city_head=$sel_obj->select_rows('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("*"),"branch_head","head_id",$id,array(""),"y","head_name","a");
//$crow=mysqli_fetch_row($city_head);
?>
<div id="header">
<form action="update_cityhead.php" method="post" name="form">
<table>
<tr>
<td width="108" height="35">State : </td>
<td width="181">

<?php echo implode(",",$state); ?>

<!-- <select name="state" id="state" readonly>

<option value="0">select</option>
<?php while($row=mysqli_fetch_row($city_tab)){ ?>
<option value="<?php echo $row[0]; ?>"<?php if($state[0]==$row[0]){ echo "selected"; } ?>><?php echo $row[1]; ?></option>
<?php } ?>
</select>-->

</td>
</tr>

<tr>
<td height="35">Name : </td>
<td><input type="text" name="name" id="name" value="<?php echo $crow[2]; ?>" readonly/></td>
</tr>

<tr>
<td height="35">Contact : </td>
<td><input type="text" name="cont" id="cont" value="<?php echo $crow[4]; ?>"/></td>
</tr>

<tr>
<td height="35">Email : </td>
<td><input type="text" name="email" id="email" value="<?php echo $crow[3]; ?>"/></td>
</tr>

<tr>
<td height="35">
<input type="hidden" name="id" value="<?php echo $crow[0]; ?>" />
<input type="submit" value="submit" class="readbutton"/></td>
</tr>
</table>
</form>
</div>
</center>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>