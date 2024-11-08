<?php
	include("config.php");
	$reqid=$_REQUEST['reqid'];
	//$qry=mysqli_query($con,"select f.req_no,f.atmid,f.bill_date,f.due_date,f.unit,p.Paid_Amount,p.Paid_Date,f.reqby,f.entrydate,f.trackerid,f.cust_id,f.start_date,f.end_date,f.billfrom,p.`entrydt`,p.`upby` from ebillfundrequests f,ebpayment p where p.Bill_No=f.req_no and f.req_no='".$reqid."'");
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Rejection Bill Details </title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script type="text/javascript">

</script>
<script>
	window.onunload = refreshParent;
	function refreshParent() {
		window.opener.location.reload();
	}
	function reasonCheck(rid)
	{
		if(document.getElementById(rid).checked)
		{
			var cnt=Number(document.getElementById("count").value);
			document.getElementById("count").value=(cnt+1);
		}
		else
		{
			var cnt=Number(document.getElementById("count").value);
			document.getElementById("count").value=(cnt-1);
		}
	}
	function validate(form)
	{
		with(form)
		{
			if(document.getElementById("count").value==0)
			{
				alert("Please select atleast one reason.");
				return false;
			}
			return true;
		}
	}
</script>
</head>

<body>
<center><h2>Rejection Bill Details </h2></center>
<form name="form" method="get" action="process_reject_generatebill.php" onsubmit="return validate(this)">
<table width="100%">
<tr>
<th>Email :</th><td><input type="email" required name="rejemail" id="rejemail" value="<?php //echo $row[5]; ?>"></td>
</tr>
<tr>
<th>CCEmail :</th><td><textarea rows="5" required name="rejccemail" id="rejccemail"></textarea></td>
</tr>
<tr>
<th colspan="2">Reason :</th>
</tr>
<tr>
<td colspan="2">
<ol>
<?php
$qry=mysqli_query($con,"select * from rejection_generateebill where status='1'");
while($row=mysqli_fetch_array($qry))
{
?>
<li><input type="checkbox" name="reason[]" id="reason_<?php echo $row['id']; ?>"  value="<?php echo $row['id']; ?>" onchange="reasonCheck(this.id)"/><b><?php echo $row['reason']; ?></b><br /></li>
<?php
}
?>
</ol>
</td>
</tr>
<tr>
<td>Remarks:</th><td><input type="text" name="reason1" id="reason1" placeholder="Remarks" >
<input type="hidden" name="reqid" value="<?php echo $reqid; ?>"/>
<input type="hidden" name="count" id="count" value="0"/>
</td>
</tr>
<tr>
<td colspan="2"><input type="submit" value="Reject" name="submit"/></td>
</tr>
</table>
</form>
</body>
</html>