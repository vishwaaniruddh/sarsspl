<?php
include("config.php");
$qry=mysqli_query($con,"select * from aareqtbl");
while($row=mysqli_fetch_array($qry))
{
if($row[14]=='')
{
// atm which has no trackerid
//echo "INSERT INTO `ebillfundrequests` (`atmid`, `bill_date`, `unit`, `amount`, `status`, `start_date`, `end_date`, `supervisor`, `due_date`, `opening_reading`, `closing_reading`, `entrydate`, `cust_id`, `reqby`, `trackerid`,`reqstatus`,`memo`,`print`,`priority`,`extrachrg`,pstat,billfrom) select  `atmid`, `bill_date`, `unit`, `amount`, `status`, `start_date`, `end_date`, `supervisor`, `due_date`, `opening_reading`, `closing_reading`, `entrydate`, `cust_id`, `reqby`, `trackerid`,`reqstatus`,`memo`,`print`,`priority`,`extrachrg`,pstat,billfrom from aareqtbl where req_no='".$row[0]."'";
	
	$entry=mysqli_query($con,"INSERT INTO `ebillfundrequests` (`atmid`, `bill_date`, `unit`, `amount`, `status`, `start_date`, `end_date`, `supervisor`, `due_date`, `opening_reading`, `closing_reading`, `entrydate`, `cust_id`, `reqby`, `trackerid`,`reqstatus`,`memo`,`print`,`priority`,`extrachrg`,pstat,billfrom) select  `atmid`, `bill_date`, `unit`, `amount`, `status`, `start_date`, `end_date`, `supervisor`, `due_date`, `opening_reading`, `closing_reading`, `entrydate`, `cust_id`, `reqby`, `trackerid`,`reqstatus`,`memo`,`print`,`priority`,`extrachrg`,pstat,billfrom from aareqtbl where req_no='".$row[0]."'");
	$idd=mysqli_insert_id();
$up=mysqli_query($con,"update aainvdettbl set refid='$idd' where detail_id='".$row[0]."'");
//echo "update aainvdettbl set refid='$idd' where detail_id='".$row[0]."'";
	if($entry)
	{
	$id=mysqli_query($con,"select max(req_no) from `ebillfundrequests`");
$idr=mysqli_fetch_row($id);
	$mkpay=mysqli_query($con,"INSERT INTO `ebpayment` (`Bill_No`, `Paid_Amount`, `Paid_Date`,`entrydt`,`upby`,`status`) select '".$idr[0]."', `Paid_Amount`, `Paid_Date`,`entrydt`,`upby`,`status` from aapaytbl where Bill_No='".$row[0]."'");
	}
	else
	echo "failed to insert ".mysqli_error();

}
else{
	
	$qry2=mysqli_query($con,"select * from ebillfundrequests where start_date='".$row['start_date']."' and cust_id='".$row['cust_id']."' and end_date='".$row['end_date']."' and bill_date='".$row['bill_date']."' and due_date='".$row['due_date']."' and (atmid='".$row['atmid']."' or trackerid='".$row['trackerid']."') and trackerid!=''");
	//echo "select * from ebillfundrequests where start_date='".$row['start_date']."' and cust_id='".$row['cust_id']."' and end_date='".$row['end_date']."' and bill_date='".$row['bill_date']."' and due_date='".$row['due_date']."' and (atmid='".$row['atmid']."' or trackerid='".$row['trackerid']."') and trackerid!=''<br/>";
	if(mysqli_num_rows($qry2)>0)
	{

		$row2=mysqli_fetch_row($qry2);
$up=mysqli_query($con,"update aainvdettbl set refid='$row2[0]' where detail_id='".$row[0]."'");
		$qry3=mysqli_query($con,"select * from ebpayment where Bill_No='".$row2[0]."'");
		//echo "select * from ebpayment where bill_no='".$row2[0]."'<br/><br/>";
		if(mysqli_num_rows($qry3)>0)
		{
			$qry4=mysqli_query($con,"select * from send_bill_detail where reqid='".$row2[0]."'");
			//echo "select * from send_bill_detail where reqid='".$row2[0]."'<br/><br/><br/>";

		}
		else
		{
		$ebpay=mysqli_query($con,"INSERT INTO `ebpayment`(`Bill_No`, `Paid_Amount`, `Paid_Date`, `memo`, `entrydt`, `upby`, `status`, `extrachrg`) select '".$row2[0]."', `Paid_Amount`, `Paid_Date`, `memo`, `entrydt`, `upby`, `status`, `extrachrg` FROM `aapaytbl` WHERE Bill_No='".$row[0]."'");
		//echo "INSERT INTO `ebpayment`(`Bill_No`, `Paid_Amount`, `Paid_Date`, `memo`, `entrydt`, `upby`, `status`, `extrachrg`) select '".$row2[0]."', `Paid_Amount`, `Paid_Date`, `memo`, `entrydt`, `upby`, `status`, `extrachrg` FROM `aapaytbl` WHERE Bill_No='".$row[0]."' <br/><br/>";
		}
$up2=mysqli_query($con,"update ebillfundrequests set print='y',pstat='1' where req_no='".$row2[0]."' and req_no!=''");
	
	}
	else
	{
		$qry5=mysqli_query($con,"select * from ebillfundrequests where reqstatus<>'0' and cust_id='".$row['cust_id']."' and (atmid='".$row['atmid']."' or trackerid='".$row['trackerid']."') and ((start_date<'".$row['start_date']."' and end_date>'".$row['start_date']."') or (start_date<'".$row['end_date']."' and end_date>'".$row['end_date']."')  )");
//echo "select * from ebillfundrequests where reqstatus<>'0' and cust_id='".$row['cust_id']."' and (atmid='".$row['atmid']."' or trackerid='".$row['trackerid']."') and ((start_date<'".$row['start_date']."' and end_date>'".$row['start_date']."') or (start_date<'".$row['end_date']."' and end_date>'".$row['end_date']."')  )<br/><br/>";
if(mysqli_num_rows($qry5)>0)
	{
		$row5=mysqli_fetch_row($qry5);
//echo "update aainvdettbl set refid='$row5[0]' where detail_id='".$row[0]."'";
$up=mysqli_query($con,"update aainvdettbl set refid='$row5[0]' where detail_id='".$row[0]."'");
		$qry6=mysqli_query($con,"select * from ebpayment where Bill_No='".$row5[0]."'");
		echo "select * from ebpayment where bill_no='".$row5[0]."'<br/><br/>";
		if(mysqli_num_rows($qry6)>0)
		{
			
		}
		else
		{
		$ebpay=mysqli_query($con,"INSERT INTO `ebpayment`(`Bill_No`, `Paid_Amount`, `Paid_Date`, `memo`, `entrydt`, `upby`, `status`, `extrachrg`) select '".$row5[0]."', `Paid_Amount`, `Paid_Date`, `memo`, `entrydt`, `upby`, `status`, `extrachrg` FROM `aapaytbl` WHERE Bill_No='".$row[0]."'");
		echo "INSERT INTO `ebpayment`(`Bill_No`, `Paid_Amount`, `Paid_Date`, `memo`, `entrydt`, `upby`, `status`, `extrachrg`) select '".$row5[0]."', `Paid_Amount`, `Paid_Date`, `memo`, `entrydt`, `upby`, `status`, `extrachrg` FROM `aapaytbl` WHERE Bill_No='".$row[0]."' <br/><br/>";
		}

$up2=mysqli_query($con,"update ebillfundrequests set print='y',pstat='1' where req_no='".$row5[0]."' and req_no!=''");
	
	}
	else
	{
	//echo "INSERT INTO `ebillfundrequests` (`atmid`, `bill_date`, `unit`, `amount`, `status`, `start_date`, `end_date`, `supervisor`, `due_date`, `opening_reading`, `closing_reading`, `entrydate`, `cust_id`, `reqby`, `trackerid`,`reqstatus`,`memo`,`print`,`priority`,`extrachrg`,pstat,billfrom) select  `atmid`, `bill_date`, `unit`, `amount`, `status`, `start_date`, `end_date`, `supervisor`, `due_date`, `opening_reading`, `closing_reading`, `entrydate`, `cust_id`, `reqby`, `trackerid`,`reqstatus`,`memo`,`print`,`priority`,`extrachrg`,pstat,billfrom from aareqtbl where req_no='".$row[0]."'";
	
	$entry=mysqli_query($con,"INSERT INTO `ebillfundrequests` (`atmid`, `bill_date`, `unit`, `amount`, `status`, `start_date`, `end_date`, `supervisor`, `due_date`, `opening_reading`, `closing_reading`, `entrydate`, `cust_id`, `reqby`, `trackerid`,`reqstatus`,`memo`,`print`,`priority`,`extrachrg`,pstat,billfrom) select  `atmid`, `bill_date`, `unit`, `amount`, `status`, `start_date`, `end_date`, `supervisor`, `due_date`, `opening_reading`, `closing_reading`, `entrydate`, `cust_id`, `reqby`, `trackerid`,`reqstatus`,`memo`,`print`,`priority`,`extrachrg`,pstat,billfrom from aareqtbl where req_no='".$row[0]."'");
	$idd=mysqli_insert_id();
	if($entry)
	{
	$id=mysqli_query($con,"select max(req_no) from `ebillfundrequests`");
$idr=mysqli_fetch_row($id);
//echo "<br>update aainvdettbl set refid='$idr[0]' where detail_id='".$row[0]."'<br>";
$up=mysqli_query($con,"update aainvdettbl set refid='$idr[0]' where detail_id='".$row[0]."'");
	$mkpay=mysqli_query($con,"INSERT INTO `ebpayment` (`Bill_No`, `Paid_Amount`, `Paid_Date`,`entrydt`,`upby`,`status`) select '".$idr[0]."', `Paid_Amount`, `Paid_Date`,`entrydt`,`upby`,`status` from aapaytbl where Bill_No='".$row[0]."'");

$up2=mysqli_query($con,"update ebillfundrequests set print='y',pstat='1' where req_no='".$idr[0]."' and req_no!=''");
	}
	else
	echo "failed to insert ".mysqli_error();
	}
	}
	}
}
?>