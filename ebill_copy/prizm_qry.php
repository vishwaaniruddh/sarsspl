<table border="1">
	<tr>
		<td>Sr. No.</td>
		<td>Bank Name</td>
		<td>Project ID</td>
		<td>Atm ID</td>
		<td>Address</td>
		<td>Bill Amount</td>
		<td>Bill No.</td>
		<td>Start Date</td>
		<td>End Date</td>
		<td>Paid Date</td>
		<td>Number of Days</td>
		<td>Average Bill per 30days</td>
	</tr>
<?php
	include("config.php");
	$qry1=mysqli_query($con,"select sbd.atm_id,sbd.paid_amount,sb.invoice_no,sbd.usdate,sbd.uedate,sbd.paid_date from send_bill sb,send_bill_detail sbd where sb.send_id=sbd.send_id and sb.invoice_no in (select `COL 2` from `TABLE 396`)");
	$i=1;
	while($row1=mysqli_fetch_array($qry1))
	{
		$qry2=mysqli_query($con,"select atmsite_address,bank,projectid,atm_id1 from PRIZM07_sites where trackerid = '".$row1[0]."'");
		
		$row2=mysqli_fetch_array($qry2);
		$qry3=mysqli_query($con,"select `COL 1` from `TABLE 396` where `COL 1`='".$row2[3]."' and `COL 2`='".$row1[2]."'");
		if(mysqli_num_rows($qry3)>0)
		{
			mysqli_query($con,"insert into tablera(`atm`) values ('$row2[3]')");
		
?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $row2[1]; ?></td>
		<td><?php echo $row2[2]; ?></td>
		<td><?php echo $row2[3]; ?></td>
		<td><?php echo $row2[0]; ?></td>
		<td><?php echo $row1[1]; ?></td>
		<td><?php echo $row1[2]; ?></td>
		<td><?php echo $row1[3]; ?></td>
		<td><?php echo $row1[4]; ?></td>
		<td><?php echo $row1[5]; ?></td>
		<td><?php $nod=0; if($row1[3]!='0000-00-00' and $row1[4]!='0000-00-00'){echo $nod=floor((strtotime($row1[4])-strtotime($row1[3])) / 86400);}else{echo "NA";}  ?></td>
        	<td><?php if($nod!=0)echo number_format ($row1[1]*30.0/$nod,2); ?></td>
	</tr>
<?php
			$i++;
		}
	}
?>