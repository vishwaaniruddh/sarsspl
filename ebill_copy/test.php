<?php
session_start();
if(!isset($_SESSION['user']))
{
header('location:index.php');
}

include('config.php');
?>


<center><form name="frm" method="post" action="test.php">
<p>Select and submit to see according to customer id</p>
<select name="cust" id="cust">
<?php
$cust=mysqli_query($con,"select distinct(cust_id) from mastersites");
while($custro=mysqli_fetch_row($cust))
{
?>
<option value="<?php echo $custro[0]; ?>" <?php if(isset($_POST['submit']) && $custro[0]==$_POST['cust']){ echo "selected"; } ?>><?php echo $custro[0]; ?></option>
<?php
}
?>
</select>
<input type="submit" value="Submit" name="submit">
</form>
</center>
<?php

if(isset($_POST['submit'])){
$cid=$_POST['cust'];



?>
<table border="1" id="custtable" style="
    width: 165%;
">
<tr>
	 
	<th>ATM ID</th>
	<th>Bill Amount</th>
	<th>Bill Unit</th>
	<th style="width:83px;">Due Date</th>
	<th>Consumer No</th>
	<th>Service Provider</th>
	<th>Section Code</th>
	<th>Client</th>
	<th>Landlord</th>
        <th>Bill period From</th>
        <th>Bill period To</th>
        <th>Last paid Date</th>
        <th>Paid Amount</th>
        <th>Last Fund Transfer Date</th>
        <th>Last Fund Transfer Amount</th>
</tr>
 <button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button> 

<?php


//========================================================================================

$cust=mysqli_query($con,"select distinct(cust_id),trackerid from mastersites");

while($custro=mysqli_fetch_row($cust)){

if($cid==$custro[0]){

$q="SELECT * from send_bill_detail WHERE atm_id='$custro[1]' order by detail_id DESC limit 1";

$result=mysqli_query($con,$q); 

while($qrro=mysqli_fetch_array($result)){

//========================================query to fetch customer name ffrom  table==============================
 $qr=mysqli_query($con,"SELECT cust_name FROM  `".$custro[0]."_sites` where `trackerid`= '".$qrro[2]."' ");
 $qrro1=mysqli_fetch_array($qr);
 
 //===============================================query to fetch landlord name and atm_id from the table========================
 $landlord=mysqli_query($con,"SELECT landlord,atm_id FROM  `".$custro[0]."_ebill` where `atmtrackid`= '".$qrro[2]."'");
 
 $landname=mysqli_fetch_array($landlord);

//===============================================query to fetch last fund transfer amount from the table========================
 $amt=mysqli_query($con,"SELECT approvedamt FROM  `ebillfundrequests` where `cust_id`= '".$custro[0]."'");
 
 $approvramt=mysqli_fetch_array($amt);

//===============================================query to fetch last fund transfer date from the table========================
 $damt=mysqli_query($con,"SELECT pdate FROM  `ebfundtransfers` where `reqid`= '".$qrro[20]."'");
 
 $dapprovramt=mysqli_fetch_array($damt);

?>
		<tr>
		
		
		<td><?php echo $landname[1]; ?></td>
		<td><?php echo $qrro[12]; ?></td>
		<td><?php echo $qrro[8]; ?></td>
		<td><?php echo $qrro[7]; ?></td>
		<td><?php echo $qrro[5]; ?></td>
		<td><?php echo $qrro[3]; ?></td>
		<td><?php echo ''; ?></td>
		<td><?php echo $qrro1[0]; ?></td>
		<td><?php echo $landname[0]; ?></td>
                <td><?php echo $qrro[9]; ?></td>
                <td><?php echo $qrro[10]; ?></td>
                <td><?php echo $qrro[13]; ?></td>
                <td><?php echo $qrro[12]; ?></td>
                <td><?php echo $dapprovramt[0]; ?></td>
                 <td><?php echo $approvramt[0]; ?></td>
		</tr>
<?php

	

     }
    }
  }
}
?>

</table>