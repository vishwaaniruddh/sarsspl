<?php

include("access.php");

// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Untitled Document</title>

<link href="style.css" rel="stylesheet" type="text/css" />

<link href="menu.css" rel="stylesheet" type="text/css" />

mysqli_query($con,



</headmysqli_query($con,



<body >

<center>

<?php  

include("config.php");



$id=$_GET['id'];



$qry=mysqli_query($con,"select * from atm where track_id='$id'");

$row=mysqli_fetch_row($qry);



///echo "select * from customer where cust_id='$row[2]'";

$qry1=mysqli_query($con,"select * from customer where cust_id='$row[2]'");

$crow=mysqli_fetch_row($qry1);

?>





<h2> Sitmysqli_query($con,2>

<div id="header">

<table  border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="se">

<tr>

<td width="210">Customer Name:&nbsp;<b><?php echo $crow[1]; ?></b></td>

<td width="595">Purchase Order:&nbsp;<b><?php echo $row[11]; ?></b></td>

</tr>

<tr><td height="103" colspan="2">



<table width="100%" border="1" cellpadding="4" cellspacing="0"><tr><th width="84">ATM Id</th>

<th width="155">Bank Name</th>

<th width="81">Area</th>

<th width="92">Pincode</th>

<th width="79">City</th>

<th width="78">State</th>

<th width="98">Address</th>

<th width="108">Ref_id</th>

</tr>
mysqli_query($con,
 

<tr>mysqli_query($con,

<td><?php echo $row[1]; ?></td>

<td><?php echo $row[3]; ?></td>

<td><?php echo $row[4]; ?></td>

<td><?php echo $row[5]; ?></td>

<td><?php echo $row[6]; ?></td>

<td><?php echo $row[7]; ?></td>

<td><?php echo $row[9]; ?></td>

<td><?php echo $row[10]; ?></td>

</tr>

<?php

///echo "select * from atm where cust_id='$row[2]' and po='$row[11]'";

/*$qry2=mysqli_query($con,"select * from atm where cust_id='$row[2]' and po='$row[11]'");

while($detail=mysqli_fetch_row($qry2)){

?>

<tr>

<td><?php echo $detail[1]; ?></td>

<td><?php echo $detail[3]; ?></td>

<td><?php echo $detail[4]; ?></td>

<td><?php echo $detail[5]; ?></td>

<td><?php echo $detail[6]; ?></td>

<td><?php echo $detail[7]; ?></td>

<td><?php echo $detail[9]; ?></td>

<td><?php echo $detail[10]; ?></td>

</tr>

<?php }*/ ?>

</table>

</td>



</tr>

<tr>



<td height="119" colspan="2" valign="top">





<table width="100%"><tr><th width="99">Sr No.</th>

<th width="154">Assets Name</th>

<th width="89">Assets Specification</th>

<th width="89">Quantity</th>

<th width="70">Warranty</th>





</tr>

<?php 

$i=1;

///echo "select * from atm where cust_id='$row[2]' and po='$row[11]'";

//echo "select * from site_assets where cust_id='$row[2]' and po='$row[11]'";

$qry2=mysqli_query($con,"select * from site_assets where cust_id='$row[2]' and po='$row[11]' and atmid='".$id."'");

while($detail=mysqli_fetch_row($qry2)){

//echo "select * from assets_specification where ass_spc_id='$detail[4]'";

$qry3=mysqli_query($con,"select * from assets_specification where ass_spc_id='$detail[4]'");

$row3=mysqli_fetch_row($qry3);

?>

<tr>

<td><?php echo $i++; ?></td>

<td><?php echo $detail[3]; ?></td>

<td><?php echo $row3[2]; ?></td>

<td><?php echo $detail[6]; ?>&nbsp; nos.</td>

<td><?php echo str_replace(',',' ',$detail[5]); ?></td>



</tr>

<?php } ?>

</table>



</td></tr>

</table>



</div>

</center>

</body>

</html>

