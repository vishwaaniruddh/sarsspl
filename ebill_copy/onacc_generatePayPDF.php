<?php session_start();
//echo $_SESSION['user'];
if (!isset($_SESSION['user'])) {
	echo "<script type='text/javascript'>alert('Sorry, your session has Expired'); window.location='index.php';</script>";
} else {
	include ('config.php');
	$error = 0;
	$dt = date('Y-m-d H:i:s');
	$desig = '6'; //$_POST['desig'];
	$service = '1'; //$_POST['service'];
	$dept = '5'; //$_POST['dept'];
	$reqid = $_POST['reqid'];
	$chqname = $_POST['chqname'];
	$chqno = $_POST['chqno'];
	$dbtacc = $_POST['dbtacc'];
	$remarks = $_POST['remarks'];
	$pdate = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['pdate'])));
	$qry1 = mysqli_query($con, "select max(tid) from ebonacctransfers");
	$qrrow = mysqli_fetch_row($qry1);
	$tid = "";
	if ($qrrow != null)
		$tid = $qrrow[0] + 1; //echo $tid;
	else
		$tid = 1;
	for ($x = 0; $x < count($reqid); $x++) {
		$table = mysqli_query($con, "Select * from onacctransfer where reqid='" . $reqid[$x] . "'");
		$row = mysqli_fetch_array($table);
		$qry1 = mysqli_query($con, "select hname,accno,bank,branch from fundaccounts where aid='" . $row[1] . "'");
		$qrrow = mysqli_fetch_array($qry1);

		mysqli_autocommit($con, FALSE);
		//echo "Update onacctransfer set reqstatus='8' where reqid='".$reqid[$x]."'";
		$onacctransfer = mysqli_query($con, "Update onacctransfer set reqstatus='8',cheqno='" . $chqno . "' where reqid='" . $reqid[$x] . "'");
		//echo "INSERT INTO `onacctransferapp` (`reqid`, `appby`, `apptime`, `remarks`, `level`) VALUES ('".$reqid[$x]."', '".$_SESSION['user']."', '".$dt."', '".$remarks."', '8')";
		if (!$onacctransfer) {
			$error++;
		}


		$onacctransferapp = mysqli_query($con, "INSERT INTO `onacctransferapp` (`reqid`, `appby`, `apptime`, `remarks`, `level`) VALUES ('" . $reqid[$x] . "', '" . $_SESSION['user'] . "', '" . $dt . "', '" . $remarks . "', '8')");

		if (!$onacctransferapp) {
			$error++;
		}
		//echo "insert into ebonacctransfers(tid,reqid,accid,pdate,chqname,chqno,dbtaccno,entrydt) values('".$tid."','".$reqid[$x]."','".$row[1]."','".$pdate."','".$chqname."','".$chqno."','".$dbtacc."','".$dt."')";

		$sr = mysqli_query($con, "select srno from login where username='" . $_SESSION['user'] . "'");
		$srno = mysqli_fetch_row($sr);

		$ebonacctransfers = mysqli_query($con, "INSERT into ebonacctransfers(tid,reqid,accid,pdate,chqname,chqno,dbtaccno,entrydt,narration,remark,email_body,mail_by) values('" . $tid . "','" . $reqid[$x] . "','" . $row[1] . "','" . $pdate . "','" . $chqname . "','" . $chqno . "','" . $dbtacc . "','" . $dt . "','" . $srno[0] . "','" . $remarks . "','" . $_POST['mbdy'] . "','" . $_POST['mby'] . "')");

		if (!$ebonacctransfers) {
			$error++;
		}


	}





	if ($error > 0) {
		//echo mysqli_error();
		mysqli_query($con, "ROLLBACK");
		$_SESSION['success'] = 0;
		header('location:onaccview.php');
	} else {
		mysqli_commit($con);
		//$_SESSION['success']=1;
		//header('location:onaccview.php');

		?>
			 <html>
		<head>
		<script type="text/javascript">     
				function PrintDiv(id) {   
			   <!-- document.getElementById('hide').style.display='none';--> 
				   var divToPrint = document.getElementById(id);
		   
				   var popupWin = window.open('', '_blank', 'width=800,height=400');
				   popupWin.document.open();
				   popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
					popupWin.document.close();
						}
		</script>
		</head>
		<body>
		<center>
		<div id="ppdf" ><br><br><br><br><br><br><br><br><br>
			<table width="995" border="1" cellpadding="2" cellspacing="0"  id="custtable" style="margin-top:5px;"> 
		<th width="10">Sr NO</th>
		<th width="200px">Account Name</th>	
		<th width="180px" align="center">Account No.</th>	
		<th width="60">Amount</th>
			   
		<?php
		/*
		echo "select distinct(accid) from ebonacctransfers where tid='$tid'"."<br>";
		//echo "select * from fundaccounts where aid='".$qrysrow[0]."'"."<br>";
		echo "select sum(approvedamt) from onacctransfer where reqid in(select reqid from ebonacctransfers where tid='".$tid."' and accid='".$qrysrow[0]."')";*/

		$qry30 = mysqli_query($con, "select distinct(accid) from ebonacctransfers where tid='$tid'");
		$cntt = 1;
		$pdtot = 0;
		while ($qrysrow = mysqli_fetch_array($qry30)) {
			$branch30 = mysqli_query($con, "select * from fundaccounts where aid='" . $qrysrow[0] . "'");
			$brro30 = mysqli_fetch_row($branch30);
			echo "select * from fundaccounts where aid='" . $qrysrow[0] . "'" . "<br>";

			$qry2 = mysqli_query($con, "select sum(approvedamt) from onacctransfer where reqid in(select reqid from ebonacctransfers where tid='" . $tid . "' and accid='" . $qrysrow[0] . "')");
			$qrrow2 = mysqli_fetch_array($qry2);
			?><div class=article>
			<div class=title><tr>
			<td width="10" align='center'><?php echo $cntt; ?></td>
			<td width="200" align='left'><?php echo $brro30[1]; ?></td>
			<td width="180px"  align="center"><?php echo $brro30[2]; ?></td>
			<td width="60" align='right' style='padding-right:15px'><?php echo number_format($qrrow2[0], 2);
			$pdtot = $pdtot + $qrrow2[0]; ?></td>

			</tr></div></div>
			<?php
			$cntt++;
		}
		?>

		<tr>
		<td colspan="3"></td>
		<td align="center"><?php echo $pdtot; ?></td></tr>





		</table>										
		</div><input type="button" name="GENERATE" id="GENERATE" value="PRINT PDF" onclick="PrintDiv('ppdf');" />
		<input type="button" name="excl" id="excl" value="Export to Excel" onclick="window.open('ebcmsexp.php?tid=<?php echo $tid; ?>','_blank');" />
		<br><br>
			  <a href="viewquot.php" >HOME</a>   

   
		</center></body>
		</head>
		</html>


		<?php




	}

}
?>