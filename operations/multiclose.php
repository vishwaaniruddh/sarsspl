<?php
session_start();
if(!isset($_SESSION['designation']))
{
echo "<script type='text/javascript'>alert('Sorry, your session has Expired. Please login again');window.location='index.php';</script>";
}
else
{
if(isset($_POST['cmdsub']))
{
?>
<?php

include("config.php");

date_default_timezone_set('Asia/Kolkata');
//echo "select caller_email,eta from alert where alert_id='".$id."'";
$qr=mysqli_query($con,"select caller_email,eta from alert where alert_id='".$id."'");
$ro1=mysqli_fetch_row($qr);
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script>

function mail_value(){
	
if(document.getElementById('mail').checked==false){
	//alert("hi");
	document.getElementById('email').value="";
}
else
document.getElementById('email').value=document.getElementById('ml').value;
}

function responsetime(){
	
if(document.getElementById('response').checked==false){
	//alert("hi");
	document.getElementById('rtime').value="";
}
else
document.getElementById('rtime').value=document.getElementById('dt').value;
}
</script>
</head>

<body>
<center>

<?php include("menubar.php"); ?>
<h2>Close Multiple Calls (You are about to update <?php echo count($_POST['arr']); ?> Calls)</h2>
<div id="header">
<form action="process_multiupdate.php" method="post" name="form">
<input type="hidden" name="ml" id="ml" value="<?php echo $ro1[0];  ?>" />
<table width="363">
<tr><td valign="top">Atmid (Complain ID)</td>
<td valign="top"><table border="0"><tr><?php
$alertid=$_POST['arr'];
for($i=1;$i<=count($alertid);$i++)
{
$qr=mysqli_query($con,"select createdby,atm_id,quotdetid,cust_id,alert_type from alert where alert_id='".$alertid[$i-1]."'");
$ro=mysqli_fetch_row($qr);
if($ro[4]=='rnmsites')
$atm="select atm_id1 from rnmsites where id='".$ro[1]."'";
else
$atm="select atm_id1 from ".$ro[3]."_sites where trackerid='".$ro[1]."'";

///echo $atm;
$site=mysqli_query($con,$atm);
$sitero=mysqli_fetch_row($site);

?>
<th><input type="checkbox" name="alertid[]" id="alertid<?php echo $i; ?>" value="<?php echo $alertid[$i-1]; ?>" checked>&nbsp;<?php echo $sitero[0]." (".$ro[0].")"; ?></th>
<?php
if(($i)%4==0 && $i!=0)
echo "</tr><tr>";
}
?></tr></table></td></tr>
<tr>
<td width="184" height="35">Update : </td>
<td width="167">
<textarea name="up" id="up" rows="4" cols="50"></textarea>
</td>
</tr>

<tr>
<td width="184" height="35">Send this update to clients: </td>
<td width="167">
<input type="checkbox" name="mail" id="mail" value="mail" onclick="mail_value();"/><!--<input type="text" value="" name="email" id="email" />-->
</td>
</tr>
<tr>
<td width="184" height="35">Type of Update: </td>
<td width="167">
<input type="radio" name="tou" id="tou" value="Update" checked/>&nbsp;Update<br>
<input type="radio" name="tou" id="tou" value="Close"/>&nbsp;Close Calls
</td>
</tr>

<tr>
<td width="184" height="35">Deadline: </td>
<td width="167"><?php //echo $ro1[1]; ?>
<input type="text" name="est" id="est" value="<?php echo date('d/m/Y'); ?>" readonly="readonly" onclick="displayDatePicker('est');">

<tr>
<td width="184" height="35">Time</td><td>
<select name="time" id="time"><option value="">Select time</option>
<?php
for($i=1;$i<=12;$i++)
{
?>
<option value="<?php echo $i.":00:00"; ?>" <?php if($i==date('h',strtotime(date('Y-m-d h:i:s a')))+3){ echo "selected"; } ?>><?php echo $i; ?></option>
<?php
}
?>

</select>

<select name="meri" id="meri"><option value="">Select</option>
<option value="am" <?php if(date('a',strtotime(date('Y-m-d h:i:s a')))=='am'){ echo "selected"; } ?>>am</option><option value="pm" <?php if(date('a',strtotime(date('Y-m-d h:i:s a')))=='pm'){ echo "selected"; } ?>>pm</option>
</select>
</td>
</tr>

<tr>
<td height="35"><input type="submit" value="submit" name="cmdsub" class="readbutton"/></td>
<td><input type="button" value="cancel" class="readbutton" onclick="Javascript:location.href='view_alert.php'"/></td>
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="br" value="<?php echo $br; ?>" />
<input type="hidden" name="dt" value="<?php echo date("Y-m-d H:i:s"); ?>" id="dt" />
</tr>
</table>
</form>
</div>
</center>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>
<?php
}
else
echo "<script type='text/javascript'>window.location='view_alert.php';</script>";
}
?>