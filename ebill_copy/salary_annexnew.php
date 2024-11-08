<?php
include("config.php");
include("access.php");

$ft=$_GET['ft'];
$mnth=$_GET['fd'];
$yr=$_GET['ld'];
$typ=$_GET['typ'];
//echo $ft;


$dt=$yr."-".$mnth;

//echo $dt;
//echo $mnth.$yr.$typ;


$frstday= date('Y-m-01', strtotime($dt));



// Last day of the month.
$lastday=date('Y-m-t', strtotime($dt));




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<script src="excel.js" type="text/javascript"></script>
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script type="text/javascript" src="/1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
<script type="text/javascript">

</script>
</head>
<body>
<center><input type="button" id="exp" onclick="tableToExcel('exptexcl', 'Table Export Example')" value="Export To Excel"/>	</center>
<br>
<div id="exptexcl" name="exptexcl">
<table border="2" name="exptexcl" id="exptexcl">
<table border="2">
<th>Sr</th>
<th>Status</th>
<th>Zone</th>
<th>Off Roll / On Roll</th>
<th>Salary Month</th>
<th>CSS local Branch</th>
<th>CSS BM</th>
<th>Customer Name</th>
<th>Bank Name</th>
<th>ATM ID</th>
<th>II ATM ID	</th>
<th>Location</th>
<th>City</th>
<th>State</th>
<th>T/O Date</th>
<th>H/O Date</th>
<th>Shift</th>
<th>Category</th>
<th>No Of Guards</th>
<th>Wages</th>
<th>From</th>
<th>To</th>
<th>Month Days</th>
<th>Duty Days</th>
<th>W.F</th>
<th>Earned Salary</th>
<th>Final Net Amount</th>
<th style="width:450px;">Status</th>
<?php
$totsum='0';
$earnedsum='0';
$wftot='0';

$qrnx=mysqli_query($con,"select * from salannexdet where accid='".$ft."' and month='".$mnth."' and year='".$yr."' and roll='".$typ."'");

$a=0;
$gtrwsn="";
$qrs=mysqli_query($con,"select * from ct_salaryimport where main_acc='".$ft."' and month='".$mnth."' and year='".$yr."' and roll='".$typ."' ");
//echo "select * from ct_salaryimport where main_acc='".$ft."' and month='".$mnth."' and year='".$yr."' and roll='".$typ."' ";
$qrcnt=mysqli_num_rows($qrs);
if($qrcnt>0)
{
$gtrwsn=mysqli_fetch_array($qrs);
}
else
{
$qrs1=mysqli_query($con,"select * from ct_salaryimport where accid='".$ft."' and month='".$mnth."' and year='".$yr."' and roll='".$typ."' ");
$gtrwsn=mysqli_fetch_array($qrs1);
}




while($qnrws=mysqli_fetch_array($qrnx))
{



?>
<tr>
<td align="center"><?php echo $a+1;?></td>
<td align="center"><?php echo $qnrws[2];?></td>
<td align="center"><?php echo $qnrws[3];?></td>
<td align="center"><?php echo $qnrws[4];?></td>
<td align="center"><?php echo date('M-y',strtotime($qnrws[5]));?></td>
<td align="center"><?php echo $qnrws[6];?></td>
<td align="center"><?php echo $qnrws[7];?></td>
<td align="center"><?php echo $qnrws[8];?></td>
<td align="center"><?php echo $qnrws[9];?></td>
<td align="center"><?php echo $qnrws[10];?></td>
<td align="center"><?php echo $qnrws[11];?></td>
<td align="center"><?php echo $qnrws[12];?></td>
<td align="center"><?php echo $qnrws[13];?></td>
<td align="center"><?php echo $qnrws[14];?></td>
<td align="center"><?php echo date('d-m-Y',strtotime($qnrws[15]));?></td>
<td align="center"><?php if($qnrws[16]!='0000-00-00') { echo date('d-m-Y',strtotime($qnrws[16])); }?></td>
<td align="center"><?php echo $qnrws[17];?></td>
<td align="center"><?php echo $qnrws[18];?></td>
<td align="center"><?php echo $qnrws[19];?></td>
<td align="center"><?php echo round($qnrws[20]);?></td>
<td align="center"><?php echo  date('d-m-Y',strtotime($qnrws[21]));?></td>
<td align="center"><?php echo  date('d-m-Y',strtotime($qnrws[22]));?></td>
<td align="center"><?php echo $qnrws[23];?></td>
<td align="center"><?php echo $qnrws[24];?></td>
<td align="center"><?php echo round($qnrws[25]); $wftot=$wftot+$qnrws[25]; ?></td>
<td align="center"><?php echo  round($qnrws[26]); $earnedsum=$earnedsum+$qnrws[26];?></td>
<td align="center"><?php echo round($qnrws[27]); $totsum=$totsum+$qnrws[27];?></td>
<td align="center" style="width:450px;"></td>

</tr>
<?php
}
?>
<tr>
<td colspan="24"></td>
<td align="center"><?php echo round($wftot);?></td>
<td align="center"><?php echo round($earnedsum);?></td>
<td align="center"><?php echo round($totsum);?></td></tr>
<tr>
<td colspan="26">
</td>

<td align="center"><?php echo round($gtrwsn[2]);?></td>
<td align="center">Cleaning Materials (Other Cust.)</td>
</tr>

<tr>
<td colspan="26">
</td>

<td align="center"><?php echo round($gtrwsn[3]);?></td>
<td align="center">Cleaning Materials (NON Other Cust.)</td>
</tr>

<tr>
<td colspan="26">
</td>

<td align="center"><?php echo round($gtrwsn[4]);?></td>
<td align="center">Disputed</td>
</tr>

<tr>
<td colspan="26">
</td>

<td align="center"><?php echo round($gtrwsn[5]);?></td>
<td align="center">Advance Salary</td>
</tr>


<tr>
<td colspan="26">
</td>

<td align="center"><?php echo round($gtrwsn[6]);?></td>
<td align="center">Uniform Recovery Amt.</td>
</tr>

<tr>
<td colspan="26">
</td>

<td align="center"><?php echo round($gtrwsn[7]);?></td>
<td align="center">Customer Impose the Penalty Amt.</td>
</tr>


<tr>
<td colspan="26">
</td>

<td align="center"><?php echo round($gtrwsn[9]);?></td>
<td align="center" style="width:400px;">Hold Salary</td>
</tr>


<tr>
<td colspan="26">
</td>
<td align="center"><?php 
//round(($earnedsum+$gtrwsn[2]+$gtrwsn[3]+$gtrwsn[4]-$gtrwsn[5]+$gtrwsn[6]+$gtrwsn[7]+$gtrwsn[9]))
$sb12=$earnedsum+$gtrwsn[2]+$gtrwsn[3]+$gtrwsn[4];
$s13=$gtrwsn[5]+$gtrwsn[6]+$gtrwsn[7]+$gtrwsn[9]+$gtrwsn[8];
echo round($sb12-$s13);?></td>
</tr>
</table>
</div>
</body>
</html>
