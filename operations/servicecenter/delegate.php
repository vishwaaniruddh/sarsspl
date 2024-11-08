<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<center>
<h2>Delegate Alert</h2>
<div id="header">
<form action="process_delegation.php" method="get" name="form" >
<table>
<?php
include_once('class_files/select.php');
$req=$_GET['req'];
$atm=$_GET['atm'];
$city=$_GET['city'];

$sel_obj=new select();
$engg=$sel_obj->select_rows('localhost','site','site','atm_site',array("engg_id","engg_name"),"area_engg","city",$city,array(""),"y","engg_name","a");
?>
<tr>
<td height="35">Engineer : </td>
<td>
<select name="eng" id="eng" >
<option value="0">select</option>
<?php
while($row=mysql_fetch_row($engg)){ 
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
<?php
}
?>
</select>
</td>
</tr>

<tr>
<td height="35">
<input type="hidden" name="req" value="<?php echo $req?>" /><input type="hidden" name="atm" value="<?php echo $atm?>" />
<input type="submit" value="submit" class="readbutton" /></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>