<?php 
	include("access.php");
	include("config.php");	
	$accmgr=0;
	if($_SESSION['designation']==8 && $_SESSION['dept']==4 && $_SESSION['serviceauth']==2)
		$accmgr=1;
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<!--Slide down div  -->
<script src="js/jquery.min.js.js" type="text/javascript"></script>
<script src="php_calendar/scripts.js" type="text/javascript"></script>
<script>
function isNumberKey(evt)
{
var charCode = (evt.which) ? evt.which : event.keyCode;
if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
return false;
 
return true;
}
function chckchq()
{
	if(document.getElementById("paytype").value=="cash")
	{
		document.getElementById("bank").disabled =true;
		document.getElementById("chqno").disabled =true;
	}
	else
	{
		document.getElementById("bank").disabled =false;
		document.getElementById("chqno").disabled =false;
	}
}
</script>
</head>

<body>
<center>
<?php include("menubar.php"); ?>

<h2>Reversal Detail</h2>
<form method="post" action="process_revesal_reqonaccunt_sv.php"> 
	<table>
    	<?php
			$qry1=mysqli_query($con,"select dbtaccno from ebonacctransfers where reqid='".$_REQUEST['reqid']."'");
			$row1=mysqli_fetch_array($qry1);
			if($accmgr)
			{
				$qry=mysqli_query($con,"select aid from onacctransfer where reqid='".$_REQUEST['reqid']."'");
 //echo "select aid from onacctransfer where reqid='".$_REQUEST['reqid']."'";

				$row=mysqli_fetch_array($qry);

				$sup_qry=mysqli_query($con,"select * from fundaccounts where aid like '$row[0]'");
				$supro=mysqli_fetch_array($sup_qry);
		?>
        <tr>
        	<td>Transfer From</td>
            <th><?php echo $supro[1]."/ ".$supro[4]."/ ".$supro[2]; ?></th>
    	</tr> 
		<?php
			}
		?>
    	<tr>
        	<td>Transfer To</td>
            <td>
            	<select name="dbtacc" id="dbtacc" required >
			<option value="">Select Credit Acc/no</option>
			<option value="074005000336" <?php if($row1[0]=="074005000336"){ echo "selected"; }?>>074005000336</option>
			<option value="074005000588" <?php if($row1[0]=="074005000588"){ echo "selected"; }?>>074005000588</option>
			<option value="074005000745" <?php if($row1[0]=="074005000745"){ echo "selected"; }?>>074005000745</option>
			<option value="074051000006" <?php if($row1[0]=="074051000006"){ echo "selected"; }?>>074051000006</option>
                </select>
            </td>
    	</tr>            
    	<tr>         	
            <td>Payment Type:</td>
            <td>
            	<select name="paytype" id="paytype" onchange="chckchq();" required>
                	<option value="">Select Payment Type</option>
                    <option value="cheque">Cheque</option>
                    <option value="cash">Cash</option>
                </select>
            </td>
    	</tr>            
    	<tr>        
            <td>Bank:</td>
            <td><input type="text" name="bank" id="bank" placeholder="Bank"/></td>
    	</tr>
        <tr>        
            <td>Cheque No.:</td>
            <td><input type="text" name="chqno" id="chqno" placeholder="Cheque No." onKeyPress="return isNumberKey(event);"/></td>
    	</tr>
        <tr>        
            <td>Amount : </td>
            <?php
				
				$ebfundreq_qry=mysqli_query($con,"select approvedamt from onacctransfer where reqid='".$_REQUEST['reqid']."'");
            	$ebfundreq=mysqli_fetch_array($ebfundreq_qry);
			?>
            <td><input type="text" name="pamount" id="pamount" placeholder="Amount" required="required" value="<?php echo $ebfundreq['approvedamt'];?>" onKeyPress="return isNumberKey(event);"/></td>
    	</tr>
        <tr>        
            <td>Date:</td>
            <td><input type="text" name="pdate" id="pdate" onclick="displayDatePicker('pdate');" required="required" onKeyPress="return isNumberKey(event);" placeholder="dd/mm/yyyy"/></td>
    	</tr>
        <tr>
        	<td>Remarks:</td>
            <td><input type="text" name="remark" id="remark" placeholder="Remarks"/></td>
        </tr>
        <tr>
        	<td colspan="2"><input type="hidden" name="reqid" value="<?php echo $_REQUEST['reqid']; ?>"/><input type="submit" value="Submit"/></td>
        </tr>
    </table>
</form>
</center>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>