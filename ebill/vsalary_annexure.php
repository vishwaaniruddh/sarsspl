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


$nofdays = cal_days_in_month(CAL_GREGORIAN, $mnth, $yr);

$atmid=array();
$aqry=mysqli_query($con,"select Sr from caretaker_salary where accid2='".$ft."' and ServiceStatus='Active' and Roll='".$typ."' and TakeOverDate<='".$lastday."'");


while($acrow=mysqli_fetch_array($aqry))
{
$atmid[]=$acrow[0];

}



$inacqry=mysqli_query($con,"select Sr from caretaker_salary where accid2='".$ft."' and ServiceStatus='Inactive' and Roll='".$typ."' and HandOverDate>'".$frstday."' ");
while($inrow=mysqli_fetch_array($inacqry))
{

$atmid[]=$inrow[0];
}




//print_r($atmid);
//echo count($atmid);

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
<th>Status</th>
<?php
$totsum='0';
$earnedsum='0';
$wftot='0';
for($a=0;$a<count($atmid);$a++)
{

$atmdet=mysqli_query($con,"select * from caretaker_salary where Sr='".$atmid[$a]."' and accid2='".$ft."' and Roll='".$typ."'");
$atmrow=mysqli_fetch_array($atmdet);

$ftodet=mysqli_query($con,"select * from salary_acc where id='".$ft."'");
$ftdrow=mysqli_fetch_array($ftodet);

$chfrdt=date('Y-m',strtotime($atmrow[22]));
$chtodt=date('Y-m',strtotime($atmrow[23]));



$fromdt='00-00-0000';
if($chfrdt==$dt)
{
$fromdt=date('d-m-Y',strtotime($atmrow[22]));

}
else
{
$fromdt=date('d-m-Y',strtotime($frstday));

}



$todt='00-00-0000';
if($chtodt==$dt)
{
$todt=date('d-m-Y',strtotime($atmrow[23]));
}
else
{
$todt=date('d-m-Y',strtotime($lastday));

}

$d='0';
$todt1=date('Y-m-d',strtotime($todt));
if($todt1==$lastday)
{
$diff=(strtotime($todt)-strtotime($fromdt))/24/3600;
$d=$diff+1;
}
else
{
$diff=(strtotime($todt)-strtotime($fromdt))/24/3600;
$d=$diff;
}


$impdet=mysqli_query($con,"select wf from ct_salaryimport where accid='".$ft."' where month='".$mnth."' and yr='".$yr."'");
$impdetrow=mysqli_fetch_array($impdet);

$wfamt='0';
if(intval($d)>10)
{

$wfamt=intval(15)*$atmrow[31];
}

$total1=0;
$aqry3=mysqli_query($con,"select wages,TakeOverDate from caretaker_salary where Sr='".$atmid[$a]."' and accid2='".$ft."'  and ServiceStatus='Active' and Roll='".$typ."'  and TakeOverDate<='".$lastday."' ");


$noras=mysqli_num_rows($aqry3);
//echo $noras;
if($noras>0)
{
$acrow3=mysqli_fetch_array($aqry3);
$chdt3=date('Y-m',strtotime($acrow3[1]));
//echo $chdt3.'-'.$dt.'<br>';
if($chdt3==$dt)
{
//echo "ok";
$differ1=(strtotime($lastday)-strtotime($acrow3[1]))/24/3600; 
$diff1=$differ1+1;
$total1=round($acrow3[0]*$diff1/$nofdays,2);

}
else
{
$total1=$acrow3[0];

}

}


$total2=0;
$inacqry3=mysqli_query($con,"select wages,HandOverDate,TakeOverDate from caretaker_salary where Sr='".$atmid[$a]."' and accid2='".$ft."' and ServiceStatus='Inactive' and Roll='".$typ."' and HandOverDate>'".$frstday."' ");

$norinacc=mysqli_num_rows($inacqry3);
if($norinacc>0)
{
$inacrow4=mysqli_fetch_array($inacqry3);
$chdt4=date('Y-m',strtotime($inacrow4[1]));


if($chdt4==$dt)
{
if($inacrow4[2]<$frstday)
$differ2=(strtotime($inacrow4[1])-strtotime($frstday))/24/3600; 
else
$differ2=(strtotime($inacrow4[1])-strtotime($inacrow4[2]))/24/3600;



$total2=round($inacrow4[0]*$differ2/$nofdays,2);

}
else
{
if($inacrow4[2]<$frstday) 
$total2=$inacrow4[0];
else{
$differ2=(strtotime($lastday)-strtotime($inacrow4[2]))/24/3600;
$total2=round($inacrow4[0]*($differ2+1)/$nofdays,2);
}
}

}





?>
<tr>
<td align="center"><?php echo $a+1;?></td>
<td align="center"><?php echo $atmrow[2];?></td>
<td align="center"><?php echo $atmrow[10];?></td>
<td align="center"><?php echo $atmrow[1];?></td>
<td align="center"><?php echo date('M-y',strtotime($frstday));?></td>
<td align="center"><?php echo $atmrow[7];?></td>
<td align="center"><?php echo $atmrow[8];?></td>
<td align="center"><?php echo $atmrow[5];?></td>
<td align="center"><?php echo $atmrow[6];?></td>
<td align="center"><?php echo $atmrow[14];?></td>
<td align="center"><?php echo $atmrow[15];?></td>
<td align="center"><?php echo $atmrow[19];?></td>
<td align="center"><?php echo $atmrow[17];?></td>
<td align="center"><?php echo $ftdrow[7];?></td>
<td align="center"><?php echo date('d-m-Y',strtotime($atmrow[22]));?></td>
<td align="center"><?php if($atmrow[23]!='0000-00-00') { echo date('d-m-Y',strtotime($atmrow[23])); }?></td>
<td align="center"><?php echo $atmrow[27];?></td>
<td align="center"><?php echo "";?></td>
<td align="center"><?php echo $atmrow[31];?></td>
<td align="center"><?php echo round($atmrow[30]);?></td>
<td align="center"><?php echo $fromdt;?></td>
<td align="center"><?php echo $todt;?></td>
<td align="center"><?php echo $nofdays;?></td>
<td align="center"><?php echo $d;?></td>
<td align="center"><?php echo $wfamt; $wftot=$wftot+$wfamt; ?></td>
<td align="center"><?php echo  $total1+$total2; $earnedsum=$earnedsum+$total1+$total2;?></td>
<td align="center"><?php echo $total1+$total2-$wfamt; $totsum=$totsum+$total1+$total2-$wfamt;?></td>


</tr>
<?php
}?>
<tr>
<td colspan="24"></td>
<td><?php echo round($wftot);?></td>
<td><?php echo round($earnedsum);?></td>
<td><?php echo round($totsum);?></td></tr>
</table>
</div>
</body>
</html>
