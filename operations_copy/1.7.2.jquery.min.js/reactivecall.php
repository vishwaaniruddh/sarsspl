<?php
include("access.php");

$id=$_GET['id'];
$br=$_GET['br'];
include("config.php");

date_default_timezone_set('Asia/Kolkata');
$qr=mysqli_query($con,"select caller_email from alert where alert_id='".$id."'");
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
<h2>Reactivate Call</h2>
<div id="header">
<form action="process_callreact.php" method="post" name="form">
<input type="hidden" name="ml" id="ml" value="<?php echo $ro1[0];  ?>" />
<table width="363">
<tr>
<td width="184" height="35">Update : </td>
<td width="167">
<textarea name="up" id="up" rows="4" cols="25"></textarea>
</td>
</tr>

<tr>
<td width="184" height="35">Send this update to client also : </td>
<td width="167">
<input type="checkbox" name="mail" id="mail" value="mail" onclick="mail_value();"/><input type="text" value="" name="email" id="email" readonly="readonly"/>
</td>
</tr>

<tr>
<td height="35">
<input type="hidden" name="alertid" value="<?php echo $id; ?>" readonly />
<input type="hidden" name="br" value="<?php echo $br; ?>" />
<input type="hidden" name="dt" value="<?php echo date("Y-m-d H:i:s"); ?>" id="dt" />
<input type="submit" value="submit" class="readbutton"/></td>
<td><input type="button" value="cancel" class="readbutton" onclick="Javascript:location.href='view_alert.php'"/></td>

</tr>
</table>
</form>
</div>
</center>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>