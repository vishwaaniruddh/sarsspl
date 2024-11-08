<?php
session_start();
include("config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function validate()
{
//alert("hi");
if(document.getElementById("feed").value=='')
{
alert("Please Enter some Feedback");
return false;
}
if(document.getElementById("serial").value=='')
{
alert("Please Enter serial number of UPS");
return false;
}

}
</script>
</head>

<body>
<center>
<?php  include("menubar.php"); ?>
<h2>Feedback</h2>
<div id="header">


<?php
 $alert=$_GET['alert'];
$eng_id=$_GET['eng_id'];
?>
<form action="process_feedback.php" method="post" name="form"  >
<table width="394">
<tr>
<td width="175" height="35">Feedback : </td>
<td width="207"><textarea rows="4" cols="28" name="feed" id="feed"></textarea></td>
</tr>

<!--<tr>
<td height="35">Call closed by giving Standby : </td>
<td><input type="checkbox" value="Y" name="stand" /></td>
</tr>-->
<tr>
<td height="35">Call close : </td>
<td><input type="checkbox" value="1" name="callclose" /></td>
</tr>
<tr>
<td height="35">
<input type="hidden" name="alert" value="<?php echo $alert; ?>" readonly /><input type="hidden" name="eng_id" value="<?php echo $eng_id; ?>" />
<input type="submit" value="submit" class="readbutton" onclick="return validate()"/>
</td>
<td>
<input type="button" value="Cancel" class="readbutton" onclick="Javascript:location.href='eng_alert.php'"/>
</td>
</tr>
</table>
</form>
</div>
</center>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>

</body>
</html>