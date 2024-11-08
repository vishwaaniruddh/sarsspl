<?php
include("config.php");
include("access.php");

//echo "ok";
$atm=$_POST['atm'];

$qry=mysqli_query($con,"select * from quotation1_tis where atm='".$atm."' and status!='c'");
//echo "select * from quotation1 where atm='".$atm."'";
$ncnt=mysqli_num_rows($qry);
//echo $ncnt;

if($ncnt>0)
{
?>
<table border='2'> 


<?php
while($rws=mysqli_fetch_array($qry))
{

$samt=mysqli_query($con,"select sum(Total) from quotation_details_tis where qid='".$rws[0]."'");
$sumamtrw=mysqli_fetch_array($samt);


$sts="";
if($rws[18]==0)
{

$sts="Pending";
}
if($rws[18]==1)
{

$sts="Fund Processing";
}
if($rws[18]==2)
{

$sts="Transferred";
}

if($rws[18]==100)
{

$sts="Archieved";
}
if($rws[18]==10)
{

$sts="Rejected";
}

$tramtrws="";
if($rws[18]==2)
{

$tramt=mysqli_query($con,"select tamount,pdate from quotation1ftransfers_tis where qid='".$rws[0]."'");
$tramtrws=mysqli_fetch_array($tramt);
}


?>
<tr>
<td>Status</td><td><?php echo $sts;?></td>
</tr>

<tr>
<td>QuotaionID</td><td><?php echo $rws[1];?></td>
</tr>

<tr>
<td>Amount</td><td><?php echo round($sumamtrw[0]);?></td>
</tr>

<tr>
<td>Transferred Amount</td><td><?php echo round($tramtrws[0]);?></td>
</tr>


<tr>
<td>Transferred Date</td><td><?php if($tramtrws[1]!="") { echo date('d-m-Y',strtotime($tramtrws[1]));  }?></td>
</tr>

<tr>
<td colspan="2" align="center"> <input type="button" name="vdet" id="vdet<?php echo $srno?>" value="View" onclick="vdtefunc('<?php echo $rws[0];?>','<?php echo $rws[2];?>');"></td>
</tr>


<tr style="height:25px;"></tr>

<?php

}
?>



</table>
<?php
}
?>