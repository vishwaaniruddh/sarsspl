<?php

include("access.php");

if(!isset($_GET['transid']))

{

?>

<script type="text/javascript">

window.close();

</script>

<?php

}

include("config.php");

// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>

<link href="style.css" rel="stylesheet" type="text/css" />

<link href="menu.css" rel="stylesheet" type="text/css" />

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />

<script src="datepicker/datepick_js.js" type="text/javascript"></script>

<script type="text/javascript">


mysqli_query($con,
var tableToExcel = (function() {

//alert("hii");

  var uri = 'data:application/vnd.ms-excel;base64,'

    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'

    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }

    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }

  retumysqli_query($con,table, name) {

    if (!table.nodeType) table = document.getElementById(table)

    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}

    window.location.href = uri + base64(format(template, ctx))

  }

})()

</script>



</head>



<body >

<div class="fixed">



<center><h2>Edit Transfer</h2>

<?php

$transid=$_GET['transid'];

//echo "select * from transfer_req where tranferid='".$transid."'";

$qry=mysqli_query($con,"select * from transfer_req where transferid='".$transid."'");

$row=mysqli_fetch_row($qry);

?>

<form action="processedittransfer.php" method="post" name="form" enctype="multipart/form-data">

<table>

<tr>

<td>Handover Date:</td><td><input type="text" name="hoverdt" id="hoverdt" value="<?php echo date('d/m/Y',strtotime($row[4])); ?>" onClick="displayDatePicker('hoverdt');" readonly="readonly" /></td>

</tr>

<tr>

<td width="126" height="35"> Customer : </td>

<td width="221">

<?php

//echo "select contact_first from contacts where type='c' and short_name='".$row[2]."'";

$qry2=mysqli_query($con,"select contact_first from contacts where type='c' and short_name='".$row[2]."'");

$qry2row=mysqli_fetch_row($qry2);

?>

<input type="text" name="tcid" id="tcid" value="<?php echo $qry2row[0]; ?>" readonly="readonly">



</td>

</tr>



<tr>

<td>Takeover Date:</td><td><input type="text" name="toverdt" id="toverdt" value="<?php echo date('d/m/Y',strtotime($row[5])); ?>" onClick="displayDatePicker('toverdt');" readonly="readonly" /></td>

</tr>

<tr>

<td>Remarks:</td><td><textarea name="rem" id="rem"><?php echo $row[9]; ?></textarea></td>

</tr>

<tr>

<td>TakeOver Agreement Form:</td><td><input type="file" name="toverfrm" id="toverfrm" /><input type="hidden" id="toverfrm2" name="toverfrm2" value="<?php echo $row[7]; ?>" /><?php echo $row[7]; ?></td>

</tr>

<tr>

<td>Handover Agreement Form:</td><td><input type="file" name="hoverfrm" id="hoverfrm" /><input type="hidden" id="hoverfrm2" name="hoverfrm2" value="<?php echo $row[6]; ?>" /><?php echo $row[6]; ?></td>

</tr>

<tr>

<td height="35" colspan="2" align="center">

<input type="hidden"  name="transid" value="<?php echo $transid; ?>" />

<input type="submit" value="submit" name="submit" class="readbutton" /><input type="button" onClick="window.close()" value="cancel" /></td>

</tr>

</table>

</form>

</center>

</div>

<script type="text/javascript" src="1.7.2.jquery.min.js"></script>

<script type="text/javascript" src="script.js"></script>

</body>

</html>