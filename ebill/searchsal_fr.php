<?php
include("config.php");
include("access.php");
	

//echo "hello";



$mnth=$_POST['mnth'];
$yr=$_POST['yr'];
$typ=$_POST['typ'];
$state=$_POST['state'];
$locn=$_POST['locn'];
$fto=$_POST['fto'];

$dt=$yr."-".$mnth;

//echo $dt;
//echo $mnth.$yr.$typ;


$frstday= date('Y-m-01', strtotime($dt));



// Last day of the month.
$lastday=date('Y-m-t', strtotime($dt));
//echo "fdate=".$frstday."<br>";

//echo "lastdate=".$lastday."<br>";



//echo "First date=".$frstday."--"."Last date=".$lastday."--";

//echo $lastday."-".$frstday;
$nofdays = cal_days_in_month(CAL_GREGORIAN, $mnth, $yr);
//echo "Total nof days=".$nofdays;
//echo "select distinct(FundTransferTo) from caretaker_salary where Roll='".$typ."'";


$chiexts=mysqli_query($con,"select accid from ct_salaryimport where month='".$mnth."' and year='".$yr."' and roll='".$typ."' and status='1' ");
$exstsrow=mysqli_num_rows($chiexts);

$chstt1=mysqli_query($con,"select accid from ct_salaryimport  where  month='".$mnth."' and year='".$yr."' and status='2' and roll='".$typ."'" );
$chdrow1=mysqli_num_rows($chstt1);

if($exstsrow>0)
{


$qry1="";
if($fto!="")
{
$qry1="select distinct(accid2) from caretaker_salary where Roll='".$typ."' and accid2='".$fto."'  ";
}
else
{
$qry1="select distinct(accid2) from caretaker_salary where Roll='".$typ."' and accid2!='0' ";
}

$attqrr="select id from salary_acc where 1 ";
if($state!='')
{

$attqrr.=" and state='".$state."'";
}

if($locn!='')
{
$attqrr.="and location='".$locn."' ";

}

if($state!='' || $locn!='')
{

$qry1.=" and accid2 in(".$attqrr.") ";
}


$qry1.=" order by accid2 ASC";
//echo $qry1;
$qry=mysqli_query($con,$qry1);



$chdrow=mysqli_num_rows($qry);

//echo $qry1;


?>

<div align="center">
<input type="hidden" name="salmnth" id="salmnth" value="<?php echo $dt;?>">


<br>
<br>
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

<th>Cleaning Materials (NON Other Cust.)</th>
<th>Disputed</th>
<th>Advance Salary</th>
<th>Uniform Recovery Amt.</th>
<th>Customer Impose the Penalty Amt.</th>
<th>WF</th>
<th>Hold Salary</th>

<th>Total Released Amt</th>
<th>A/c. FWD</th>
<th>A/c. Transfer Amt</th>
<th>Transfer Date</th>
<th>Pending Transfer Amt</th>
<th></th>
<th>Annexure</th>
<th>Remark</th>

</tr>



<?php
$relst='0';
$clott='0';
$clnott='0';
$dispt='0';
$urec='0';
$cpen='0';
$wft='0';
$hlst='0';
$adv="0";

$gsum=0;
$cntt='1';
$tcssamt='0';
$tpndmt='0';
$ttrafdamt='0';
while($qrow=mysqli_fetch_array($qry))
{
$count=0;
//echo "select * from caretaker_salary where FundTransferTo='".$qrow[0]."' ";
$detqry=mysqli_query($con,"select * from caretaker_salary where accid2='".$qrow[0]."' and Roll='".$typ."' ");
$detrow=mysqli_fetch_array($detqry);

$chifto=mysqli_query($con,"select accid from ct_salaryimport where main_acc='".$qrow[0]."' and month='".$mnth."' and year='".$yr."' and roll='".$typ."'");
$numrwss=mysqli_num_rows($chifto);

//echo "select accid from ct_salaryimport where main_acc='".$qrow[0]."' and month='".$mnth."' and year='".$yr."' and roll='".$typ."'";

//echo $numrwss;
$ftdet1="";
$qrctimport1="";
if($numrwss=='0')
{
$ftdet1="select * from salary_acc where id='".$qrow[0]."'";
$qrctimport1="select cleaning_mat_other,cleaning_mat_nonother,disputed,advance,uniform_rec,cust_penalty,wf,hold_salary,id,earnedsal,no_of_atm,total_salary from ct_salaryimport where accid='".$qrow[0]."' and main_acc='0' and month='".$mnth."' and year='".$yr."' and status='1' and roll='".$typ."'";
}
else
{
$chifrow=mysqli_fetch_array($chifto);
$ftdet1="select * from salary_acc where id='".$chifrow[0]."'";
$qrctimport1="select cleaning_mat_other,cleaning_mat_nonother,disputed,advance,uniform_rec,cust_penalty,wf,hold_salary,id,earnedsal,no_of_atm,total_salary from ct_salaryimport where main_acc='".$qrow[0]."' and accid='".$chifrow[0]."' and month='".$mnth."' and year='".$yr."' and status='1' and roll='".$typ."'";
}

//echo $qrctimport1;
$ftdet=mysqli_query($con,$ftdet1);
$ftorow=mysqli_fetch_array($ftdet);
//echo $ftorow[0]."<br>";

$qrctimport=mysqli_query($con,$qrctimport1);


$qrimprow=mysqli_fetch_array($qrctimport);





if($qrimprow[10]!="")
{
?>
<tr>
<td align="center"><?php echo $cntt;?></td>
<td align="center"><?php echo $ftorow[5];?></td>
<td align="center"><?php echo $ftorow[7];?></td>
<td align="center"><?php echo $ftorow[6];?></td>
<td align="center"><?php echo $ftorow[1];?></td>
<td align="center"><?php echo $ftorow[4];?></td>
<td align="center"><?php echo $ftorow[2];?></td>
<td align="center"><?php echo $ftorow[3];?></td>
<td align="center"></td>
<td align="center"><?php echo $detrow[5];?></td>
<td align="center"></td>
<td align="center"><?php echo $detrow[1];?></td>
<td align="center"><?php echo $qrimprow[10];?></td>
<td align="center"><?php echo round($qrimprow[9],2);  $gsum=round($gsum+$qrimprow[9]);?></td>
<td align="center"><?php echo round($qrimprow[0],2); $clott=$clott+$qrimprow[0]; ?></td>
<td align="center"><?php echo round($qrimprow[1],2); $clnott=$clnott+$qrimprow[1];?></td>
<td align="center"><?php echo round($qrimprow[2],2);  $dispt=$dispt+$qrimprow[2];?></td>
<td align="center"><?php echo round($qrimprow[3],2);  $adv=$adv+$qrimprow[3];?></td>
<td align="center"><?php echo round($qrimprow[4],2); $urec=$urec+$qrimprow[4];?></td>
<td align="center"><?php echo round($qrimprow[5],2); $cpen=$cpen+$qrimprow[5];?></td>
<td align="center"><?php echo round($qrimprow[6],2); $wft=$wft+$qrimprow[6];?></td>
<td align="center"><?php echo round($qrimprow[7],2); $hlst=$hlst+$qrimprow[7];?></td>

<?php 
$a=round($total1+$total2+$qrimprow[0]+$qrimprow[1]+$qrimprow[2],2);
$b=round($qrimprow[3]+$qrimprow[4]+$qrimprow[5]+$qrimprow[6]+$qrimprow[7],2);
$s=$a-$b;
//echo $a."<br>".$b."<br>".$s;


$trdetails=mysqli_query($con,"select sum(tamount) from salary_generate_details where ctid='".$qrimprow[8]."' and month='".$mnth."' and year='".$yr."'");
$trdetrows=mysqli_fetch_array($trdetails);

$pendamt=$qrimprow[11]-$trdetrows[0];

$onethrdamt=round($qrimprow[11])/3;

$pmt='0';
if(intval($onethrdamt)>($pendamt))
{
$pmt=round($pendamt);
}
else
{
$pmt=round($onethrdamt);
}

?>
<td align="center"><input type="text" class='enbl' name="tcsamt[]" id="tcsamt<?php echo $cntt;?>" value="<?php echo round($qrimprow[11]); $tcssamt=$tcssamt+$qrimprow[11];?>" readonly></td>
<td align="center"></td>
<td align="center"><input type="text"  name="tramt[]" id="tramt<?php echo $cntt;?>" value="<?php echo round($trdetrows[0]); $ttrafdamt=$ttrafdamt+round($trdetrows[0]);?>"  style="width:70px;" readonly></td>
<td align="center"></td>
<td align="center"><input type="text"  name="penamt[]" id="penamt<?php echo $cntt;?>" value="<?php echo round($pendamt); $tpndmt=$tpndmt+round($pendamt);?>"  style="width:70px;" readonly></td>


<td>

<?php
if($_SESSION['designation']=='6' )
{?>

<input type="checkbox" name="payment[]" id="payment<?php echo $cntt;?>" value='<?php echo $qrimprow[8];?>'  onchange="addpay(this.value,this.id);" checked>
<input type="text" class="enb" name="payf[]" id="pay<?php echo $cntt;?>" value="<?php echo round($pmt);?>" onkeyup='addpmnt(this.id);' style="width:70px;" >


<?php } ?>

</td>


<td align="center" width='100'>

<button type="button" name="vannex<?php echo $cntt;?>" id="vannex<?php echo $cntt;?>"  onclick="window.open('salary_annexnew.php?ft=<?php echo $qrow[0];?>&fd=<?php echo $mnth;?>&ld=<?php echo $yr;?>&typ=<?php echo $typ;?>','_blank');">View Annnexure</button>

</td>

<td align="center">
<?php

$chis=mysqli_query($con,"select remark from salary_edit_history where detail_id='".$qrimprow[8]."'");

$hisrows=mysqli_num_rows($chis);


if($hisrows!=0)
	    {
$hrow=mysqli_fetch_array($chis);

?>

	        <input type="button" name="vhis"  value="View History" onclick="vhisfunc(<?php echo $qrimprow[8];?>);">
	       <?php } ?>
</td>


</tr>







<?php
}
$cntt++;
}

?>
<tr><td colspan="13"></td>
<td align="center"><?php echo $gsum;?></td>

</td><td align="center"><?php echo round($clott);?></td>
</td><td align="center"><?php echo round($clnott);?></td>
</td><td align="center"><?php echo round($dispt);?></td>
</td><td align="center"><?php echo round($adv);?></td>
</td><td align="center"><?php echo round($urec);?></td>
</td><td align="center"><?php echo round($cpen);?></td>
</td><td align="center"><?php echo round($wft);?></td>
</td><td align="center"><?php echo round($hlst);?></td>
</td><td align="center"><?php echo round($tcssamt);?></td>
</td><td align="center"></td>
</td><td align="center"><?php echo round($ttrafdamt);?></td>
</td><td align="center"><?php echo "";?></td>
</td><td align="center"><?php echo round($tpndmt);?></td>
</td><td align="center"></td>
</td><td align="center"></td>
</td><td align="center"></td>

</tr>
<tr><td colspan='27' align="right">Total selected salary</td><td><input type="text" name="seltot" id="seltot" value='0' readonly></td></tr>

<tr><td colspan='27' align="center"> <button type="submit" name="app" id="app" >Payments</button>
<br>

</td></tr>
</table>
<?php
}
else if($chdrow1>0)
{
echo "Salary already Generated for this month";
}
else
{
echo "Salary not Generated for this month";
}
?>