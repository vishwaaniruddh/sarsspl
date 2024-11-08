<?php

include("access.php");

// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Amc Detail</title>

<link href="style.css" rel="stylesheet" type="text/css" />

<link href="menu.css" rel="stylesheet" type="text/css" />

mysqli_query($con,



</headmysqli_query($con,



<body >

<center>

<?php  

include("config.php");



$id=$_GET['id'];

//echo "select * from Amc where amcid='$id'";

$qry=mysqli_query($con,"select * from Amc where amcid='$id'");

$row=mysqli_fetch_row($qry);



///echo "select * from customer where cust_id='$row[2]'";
mysqli_query($con,
$qry1=mysqli_query($con,"select * from customer where cust_id='$row[1]'");

$crow=mysqli_fetch_row($qry1);

?>





<h2> Site Detail </h2>

<div id="header">

<table  border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="se">

<tr>

<td width="377">Customer Name:&nbsp;<b><?php echo $crow[1]; ?></b></td>

<td width="474">Purchase Order:&nbsp;<b><?php echo $row[2]; ?></b></td>

</tr>

<tr><td height="103" colspan="2">



<table width="100%" border="1" cellpadding="4" cellspacing="0"><tr><th width="84">ATM Id</th>

<th width="155">Bank Name</th>

<th width="81">Area</th>
mysqli_query($con,
<th width="92">Pincode</th>

<th wimysqli_query($con,y</th>

<th width="78">State</th>
mysqli_query($con,
<th width="98">Address</th>

<th wimysqli_query($con,f_id</th>

</tr>

<?php 

///echo "select * from atm where cust_id='$row[2]' and po='$row[11]'";

$qry2=mysqli_query($con,"select * from Amc where amcid='".$id."'");

$detail=mysqli_fetch_row($qry2);

?>

<tr>

<td><?php echo $detail[3]; ?></td>

<td><?php echo $detail[4]; ?></td>

<td><?php echo $detail[5]; ?></td>

<td><?php echo $detail[6]; ?></td>

<td><?php echo $detail[7]; ?></td>

<td><?php echo $detail[8]; ?></td>

<td><?php echo $detail[9]; ?></td>

<td><?php echo $detail[10]; ?></td>

</tr>



</table>

</td>



</tr>

<tr><td align="right" colspan="2"><a href="#" onClick="window.open('addmoreasset.php?id=<?php echo $id; ?>&type=amc','addmoreasset','width=400px,height=300,left=200,top=40')">Add Asset</a></td></tr>

<tr>



<td height="119" colspan="2" valign="top">





<table width="100%"><tr><th width="60">Sr No.</th>

<th width="233">Assets Name</th>

<th width="200">Assets Specification</th>

<th width="344">Start Date </th>

<th width="344">End Date </th>



</tr>

<?php 

$i=1;

///echo "select * from atm where cust_id='$row[2]' and po='$row[11]'";

$qry2=mysqli_query($con,"select * from amcassets where `siteid`='$id'");

while($detail1=mysqli_fetch_row($qry2)){

//echo "select * from assets_specification where ass_spc_id='$detail1[2]'";

$qry3=mysqli_query($con,"select * from assets_specification where ass_spc_id='$detail1[2]'");

$row3=mysqli_fetch_row($qry3);



$qry4=mysqli_query($con,"select * from assets where assets_id='$row3[1]'");

$row4=mysqli_fetch_row($qry4);



$qry5=mysqli_query($con,"select * from   `amcpurchaseorder` where `cid`='$row[1]' and `po`='$row[2]'");

$row5=mysqli_fetch_row($qry5);



?>

<tr>

<td><?php echo $i++; ?></td>

<td><?php echo $row4[1]; ?></td>

<td><?php echo $row3[2]; ?></td>

<td><?php if(isset($row5[3]) and $row5[3]!='0000-00-00') echo date('d/m/Y',strtotime($row5[3])); ?></td>

<td><?php if(isset($row5[4]) and $row5[4]!='0000-00-00') echo date('d/m/Y',strtotime($row5[4])); ?></td>

</tr>

<?php } ?>

</table>



</td></tr>

</table>



</div>

</center>

</body>

</html>

