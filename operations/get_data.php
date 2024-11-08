<?php



include('config.php');



$cust=$_GET['cust'];
mysqli_query($con,
$ref=$_GET['ref'];

$po=$_GET['po'];

mysqli_query($con,

$qry="SELECT `cust_id`,`bank_name`,`state`,`city`,`address`,`pincode`,`area`,`servicetype`,`po` FROM `atm` WHERE `ref_id`='$ref'";

$res=mysqli_query($con,$qry);

$row = mysqli_fetch_row($res);

//echo $row[4];

		



$qry1=mysqli_query($con,"select * from customer where cust_id='$cust'");

$row1=mysqli_fetch_row($qry1);

?>



<table border="1" cellpadding="4" cellspacing="0" width="601"><tr>

<th>Customer Name</th><th>ATM ID.</th><th>PO Number.</th>

<th >Bank Name</th>

<th>State</th>

<th>City</th>

<th>Area</th>

<th >Address</th>

<th>Pin code</th>

<th>Primitive Maintenance</th>

</tr>

<tr>

<td><?php echo $row1[1]; ?></td><td><?php echo $ref; ?></td><td><?php echo $row[8]; ?></td>

<td><input type="hidden" name="bank" id="bank" value="<?php echo $row[1]; ?>"><?php echo $row[1]; ?></td>

<td ><input type="hidden" name="state" id="state" value="<?php echo $row[2]; ?>"><?php echo $row[2]; ?></td>

<td><input type="hidden" name="city" id="city" value="<?php echo $row[3]; ?>"><?php echo $row[3]; ?></td>

<td><input type="hidden" name="area" id="area" value="<?php echo $row[6]; ?>"><?php echo $row[6]; ?></td>

<td><input type="hidden" name="address" id="address" value="<?php echo $row[4]; ?>"><?php echo $row[4]; ?></td>

<td><input type="hidden" name="pin" id="pin" value="<?php echo $row[5]; ?>"><?php echo $row[5]; ?></td>

<td><input type="hidden" name="pm" id="pm" value="<?php echo $row[7]; ?>">Every <?php echo $row[7]; ?> month</td>

</tr>

</table>