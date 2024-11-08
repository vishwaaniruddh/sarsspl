


<?php 
session_start();
include("config.php");
include("access.php");


if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry, your session has Expired'); window.location='index.php';</script>";
}
else
{

$dt1=str_replace("/","-",$_POST['strdt']);
	$start=date('Y-m-d', strtotime($dt1));
 
	$dt2=str_replace("/","-",$_POST['endt']);
	$end=date('Y-m-d', strtotime($dt2));



$qry="select * from salaryinfo where 1 ";


if($_POST['strdt']!="" & $_POST['endt']!="" )
{

$qry.=" and from_dt='".$start."' and to_dt='".$end."'";
}

$qrs=mysqli_query($con,$qry);
echo $qry;
?>

<input type="button" onClick="tableToExcel('custtable', 'Table Export Example')" value="Export Table data into Excel"/>


<table border='2' cellsapacing="2" id="custtable" name="custtable">
<th>Sr No	 </th>
<th> Site Status</th>
<th> Customer	</th>
<th> Bank</th>
<th>CSS Local Branch	 </th>
<th>City </th>
<th> State	</th>
<th>Site ID	 </th>
<th> Atm Id	</th>
<th>ATM Site Address </th>
<th>Take Over Date	 </th>

<th>Salary Paid - Month	 </th>
<th> From	</th>
<th>To </th>
<th>Days </th>

<th>HK Rate </th>
<th>BLM Rate</th>
<th>FLM Rate </th>
<th>Shutter Rate </th>
<th>Final Salary</th>

<?php
$srn=1;
$tot="";
while($qrow=mysqli_fetch_array($qrs))
{


$atmdet=mysqli_query($con,"select * from hknew where atm_id='".$qrow[1]."'");
$atmdrow=mysqli_fetch_array($atmdet);
?>
<tr>

<td align="center"><?php echo $srn;?></td>
<td align="center"><?php echo $atmdrow[1];?></td>
<td align="center"><?php echo $atmdrow[2];?></td>
<td align="center"><?php echo $atmdrow[3];?></td>
<td align="center"><?php echo $atmdrow[4];?></td>
<td align="center"><?php echo $atmdrow[5];?></td>
<td align="center"><?php echo $atmdrow[6];?></td>
<td align="center"><?php echo $atmdrow[7];?></td>
<td align="center"><?php echo $atmdrow[8];?></td>
<td align="center"><?php echo $atmdrow[9];?></td>
<td align="center"><?php echo $atmdrow[10];?></td>
<td align="center"><?php echo $qrow[7];?></td>
<td align="center"><?php echo $qrow[8];?></td>
<td align="center"><?php echo $qrow[9];?></td>
<td align="center"></td>

<td align="center"><?php echo $qrow[2];?></td>
<td align="center"><?php echo round($qrow[3]);?></td>
<td align="center"><?php echo round($qrow[4]);?></td>
<td align="center"><?php echo round($qrow[5]);?></td>
<td align="center"><?php echo round($qrow[6]); $tot=$tot+round($qrow[6]);?></td>





</tr>



<?php
$srn++;
}
?>
<tr>
<td colspan="19">

</td>
<td align="center">
<?php echo round($tot);?>
</td>
</tr>
</table>
<?php } 
?>