<?php
session_start();
if (!isset($_SESSION['user'])) {
	echo "Sorry your session has Expired. Please Login and try again to view History of this Atm";
} else {
	include ("config.php");
	$trackid = $_GET['trackid'];
	$atm = $_GET['atmid'];
	$custid = $_GET['custid'];
	//echo "select bill_date,start_date,end_date,due_date,amount,req_no,approvedamt,supervisor,reqby,billfrom,reqstatus,print from ebillfundrequests where atmid='".$atm."' and cust_id='".$custid."' and trackerid='".$trackid."' and reqstatus<>'0'  and req_no not in (select alert_id from ebfundtranscanc where status=0) order by due_date DESC limit 10";
	
	$qry = mysqli_query($con, "select bill_date,start_date,end_date,due_date,amount,req_no,approvedamt,supervisor,reqby,billfrom,reqstatus,print from ebillfundrequests where atmid='" . $atm . "' and cust_id='" . $custid . "' and trackerid='" . $trackid . "' and reqstatus<>'0'  and req_no not in (select alert_id from ebfundtranscanc where status=0) order by due_date DESC limit 10");
	
// 	echo $qry;
// echo "<script>alert($qry);</script>";
	?>
	<a href="javascript:void(0);"
		onclick="newwin('ebsitehist.php?atmid=<?php echo $atm; ?>&custid=<?php echo $custid; ?>&trackid=<?php echo $trackid; ?>','display',900,700)">View
		Full history</a><br>
	<a href="viewpaidebill.php?atmid=<?php echo $atm; ?>&cid=<?php echo $custid; ?>" target="_new">View Detail</a>
	<table width="200px">
		<?php
		if (mysqli_num_rows($qry) > 0) {
			while ($row = mysqli_fetch_array($qry)) {
				//echo "select * from ebpayment where Bill_no='".$row[5]."'";
				$qr = mysqli_query($con, "select * from ebpayment where Bill_no='" . $row[5] . "'");
				$ro = mysqli_fetch_row($qr);
				$transfer = mysqli_query($con, "select * from ebillfundapp where reqid='" . $row[5] . "' and level='8'");
				$srno = mysqli_query($con, "select username from login where srno='" . $row[8] . "'");
				$sr = mysqli_fetch_row($srno);
				$inv = mysqli_query($con, "select send_id from send_bill_detail where reqid='" . $row[5] . "' and status=0 and send_id in(select send_id from send_bill where status=0)");
				$invro = mysqli_fetch_row($inv);
				$send_bill_qry = mysqli_query($con, "select * from send_bill where send_id='$invro[0]'");
				$send_bill = mysqli_fetch_array($send_bill_qry);
				?>
				<tr>
					<th colspan="2">Fund Request</th>
				</tr>
				<tr>
					<td><b>Request ID</b></td>
					<td><?php echo $row[5]; ?></td>
				</tr>
				<td><b>Bill Date</b></td>
				<td><?php if ($row[0] != '0000-00-00') {
					echo date('d, M Y', strtotime($row[0]));
				} ?></td>
				</tr>
				<tr>
					<td><b>Start Date</b></td>
					<td><?php if ($row[1] != '0000-00-00') {
						echo date('d, M Y', strtotime($row[1]));
					} ?></td>
				</tr>
				<tr>
					<td><b>Bill From</b></td>
					<td><?php if ($row[9] != '0000-00-00') {
						echo date('d, M Y', strtotime($row[9]));
					} ?></td>
				</tr>
				<tr>
					<td><b>End Date</b></td>
					<td><?php if ($row[2] != '0000-00-00') {
						echo date('d, M Y', strtotime($row[2]));
					} ?></td>
				</tr>
				<tr>
					<td><b>Due Date</b></td>
					<td><?php if ($row[3] != '0000-00-00') {
						echo date('d, M Y', strtotime($row[3]));
					} ?></td>
				</tr>
				<tr>
					<td><b>Supervisor</b></td>
					<td><?php if ($row[7] != '-1') {
						echo $row[7];
					} ?></td>
				</tr>
				<tr>
					<td><b>Requested Amount</b></td>
					<td><?php echo $row[4]; ?></td>
				</tr>
				<?php if (mysqli_num_rows($transfer) > 0) {
					$transro = mysqli_fetch_row($transfer); ?>
					<tr>
						<td><b>Transferred Amount</b></td>
						<td><?php echo $row[6]; ?></td>
					</tr>

					<tr>
						<td><b>Transferred Date</b></td>
						<td><?php echo date("d, M Y", strtotime($transro[3])); ?></td>
					</tr>
				<?php } ?>
				<tr>
					<td><b>Entered By</b></td>
					<td><?php echo $sr[0]; ?></td>
				</tr>
				<tr>
					<th colspan="2">Paid Details</th>
				</tr>
				<tr>
					<td><b>Paid Date</b></td>
					<td><?php if (mysqli_num_rows($qr) > 0) {
						if ($ro[2] != '0000-00-00') {
							echo date('d, M Y', strtotime($ro[2]));
						}
					} ?>
					</td>
				</tr>
				<tr>
					<td><b>Remarks</b></td>
					<td><?php echo nl2br($ro[3]); ?></td>
				</tr>
				<tr>
					<td><b>Amount</b></td>
					<td><?php echo $ro[1]; ?></td>
				</tr>
				<tr>
					<td><b>Updated By</b></td>
					<td><?php echo $ro[5]; ?></td>
				</tr>
				<tr>
					<td><b>Inv No</b></td>
					<td><?php echo $send_bill['inv_no']; ?></td>
				</tr>
				<?php if ($_SESSION['designation'] == '7') {
					$canc = mysqli_query($con, "select * from ebillfundcancinv where reqid='" . $row[5] . "'");

					if (mysqli_num_rows($inv) == 0 && mysqli_num_rows($canc) == 0) { ?>
						<tr>
							<td colspan="2"><?php if ($row[10] != '0' & $row[11] != 'y') { ?>
									<a href="editbill.php?reqid=<?php echo $row[5]; ?>" target="_blank">Edit Details</a>
								<?php }

							?>
								<input type="button" id="showrem<?php echo $row[5]; ?>" onclick="showrem('<?php echo $row[5]; ?>')"
									value="Cancel">
							</td>
						</tr>

						<tr id="up1<?php echo $row[5]; ?>" style="display:none;">
							<td><b>Remark</b></td>
							<td><textarea name="rem<?php echo $row[5]; ?>" id="rem<?php echo $row[5]; ?>"></textarea></td>
						</tr>
						<tr id="up2<?php echo $row[5]; ?>" style="display:none;">
							<td colspan="2"><input type="button" name="cancinv<?php echo $row[5]; ?>" id="cancinv<?php echo $row[5]; ?>"
									onclick="cancinv('<?php echo $row[5]; ?>')" value="Cancel from Invoicing"></td>
						</tr>
					<?php
					} else if (mysqli_num_rows($inv) > 0) {
						echo "<tr><td colspan='3' style='background:white'>Invoicing Done</td></tr>";
						echo "<tr><td colspan='3'>Invoicing done by : " . $send_bill['createdby'] . "</td></tr>";
					} else if (mysqli_num_rows($canc) > 0) {
						if ($_SESSION['user'] == "vaibhav") {
							?>
									<tr id="club<?php echo $row[5]; ?>">
										<td colspan='3' style='background:white'><b>Clubbed</b>
											<input type="button" onclick="unclubbed('<?php echo $row[5]; ?>')" value="Unclubbed">
										</td>
									</tr>
							<?php
						} else {
							echo "<tr><td colspan='3' style='background:white'><b>Clubbed</b></td></tr>";
						}
					}

				} ?>
				<tr>
					<td colspan="2">
						<hr size='3px'>
					</td>
				</tr>
				<?php
			}
		} else
			echo "<tr><td>no Record Found</td></tr>";

		?>
	</table>
	<?php
}
?>