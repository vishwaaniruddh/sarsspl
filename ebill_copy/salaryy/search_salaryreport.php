<?php
include("../config.php");
include("../access.php");
	
session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry, your session has Expired'); window.location='../index.php';</script>";
}
else
{

//echo "hello";



$mnth=$_POST['mnth'];
$yr=$_POST['yr'];
$typ=$_POST['typ'];

$dt=$yr."-".$mnth;

//echo $dt;
//echo $mnth.$yr.$typ;


$frstday= date('Y-m-01', strtotime($dt));



// Last day of the month.
$lastday=date('Y-m-t', strtotime($dt));

//echo "First date=".$frstday."--"."Last date=".$lastday."--";

//echo $lastday."-".$frstday;
$nofdays = cal_days_in_month(CAL_GREGORIAN, $mnth, $yr);
//echo "Total nof days=".$nofdays;

$qry=mysqli_query($con,"select distinct(FundTransferTo) from caretaker_salary");


?>

<table border="2">
<tr>
<th>Sr no</th>
<th>Zone</th>
<th>State</th>
<th>Location</th>
<th>Branch Head</th>
<th>Bank</th>
<th>A/c. No</th>
<th>IFSC Code</th>
<th>Email ID</th>
<th>Customer</th>
<th>Bank / Other</th>
<th>Roll</th>
<th>Count of ATM</th>
<th>Released Salary by CSS</th>
<th>Cleaning Materials (Other Cust.)</th>

</tr>

<?php
$cntt=1;

$gsum=0;
while($qrow=mysqli_fetch_array($qry))
{
$count=0;
//echo "select * from caretaker_salary where FundTransferTo='".$qrow[0]."' ";
$detqry=mysqli_query($con,"select * from caretaker_salary where FundTransferTo='".$qrow[0]."' ");
$detrow=mysqli_fetch_array($detqry);


//echo "select sum(wages) from caretaker_salary where FundTransferTo='".$qrow[0]."' and ServiceStatus='Active' and TakeOverDate<".$lastday."<br>";
$aqry="select wages,TakeOverDate from caretaker_salary where FundTransferTo='".$qrow[0]."' and ServiceStatus='Active' and TakeOverDate<='".$lastday."'";

if($typ!="")
{
if($typ=='offroll')
{
$aqry.=" and Roll='Off Roll'";
}
else
{
$aqry.=" and Roll='On Roll'";
}
}

//echo $aqry;
$activeqry=mysqli_query($con,$aqry);

$total1=0;

while($acrow=mysqli_fetch_array($activeqry))
{
$chdt=date('Y-m',strtotime($acrow[1]));
if($chdt==$dt)
{

$diff = (strtotime($lastday)- strtotime($acrow[1]))/24/3600; 
//echo $diff;


$total1=$total1+round($acrow[0]*$diff/$nofdays,2);

}
else
{
$total1=$total1+$acrow[0];

}
$count++;
}







$inacqry="select wages,HandOverDate from caretaker_salary where FundTransferTo='".$qrow[0]."' and ServiceStatus='Inactive' and HandOverDate>'".$frstday."'";


if($typ!="")
{
if($typ=='offroll')
{
$inacqry.=" and Roll='Off Roll'";
}
else
{
$inacqry.=" and Roll='On Roll'";
}
}

//echo $inacqry;
$inactiveqry=mysqli_query($con,$inacqry);




$total2=0;
while($inacrow=mysqli_fetch_array($inactiveqry))
{

$chdtt=date('Y-m',strtotime($inacrow[1]));

//echo $chdtt;
if($chdtt==$dt)
{

$diffi=(strtotime($inacrow[1])-(strtotime($frstday)))/24/3600 ; 
//echo $diffi;


$total2=$total2+round($inacrow[0]*$diffi/$nofdays,2);
}
else
{
$total2=$total2+$inacrow[0];

}


$count++;
}


$gsum=$gsum+$total2+$total1;


?>
<tr>
<td align="center"><?php echo $cntt;?></td>
<td align="center"><?php echo $detrow[10];?></td>
<td align="center"><?php echo $detrow[12];?></td>
<td align="center"><?php echo $detrow[7];?></td>
<td align="center"><?php echo $qrow[0];?></td>
<td align="center"><?php echo "";?></td>
<td align="center"><?php echo "";?></td>
<td align="center"></td>
<td align="center"></td>
<td align="center"></td>
<td align="center"></td>
<td align="center"></td>
<td align="center"><?php echo $count;?></td>
<td align="center"><?php echo round($total1+$total2,2);?></td>


</tr>
<?php
$cntt++;
}
?>
<tr><td colspan="13"></td><td align="center"><?php echo $gsum;?></td></tr>
</table>
<?php
}
?>