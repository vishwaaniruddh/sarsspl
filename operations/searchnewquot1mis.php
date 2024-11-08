<?php
include("config.php");
include("access.php");
	
session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry, your session has Expired'); window.location='index.php';</script>";
}
else
{

$strPage = $_POST['Page'];
	
        $dt1=str_replace("/","-",$_POST['strdt']);
	$start=date('Y-m-d', strtotime($dt1));
 
	$dt2=str_replace("/","-",$_POST['endt']);
	$end=date('Y-m-d', strtotime($dt2));



/*----------------------------------------------------------------------------------------approval basis-----------------------*/

$qddarr=array();
$indetq="select id from quotation1 where p_stat='2' and category='a' ";
if($_SESSION['custid']!='all')
{
$indetq.=" and cust='".$_SESSION['custid']."'";
}

if($_POST['cust']!='')
{
$indetq.=" and cust='".$_POST['cust']."'";
}

/*       
       if($_POST['strdt']!="" && $_POST['endt']!="" )
       {
       $indetq.=" and DATE(entrydate) >='".$start."' and DATE(entrydate) <='".$end."'";
       }

*/

$indet=mysqli_query($con,$indetq);




while($indetrws=mysqli_fetch_array($indet))
{

$qddarr[]=$indetrws[0];
}


//print_r($qddarr);
$instr=implode(',',$qddarr);

//echo $instr;
//$qrya="select sum(b.Total),sum(c.app_amt),sum(d.req_amt),sum(e.tamount) from quotation1 a,quotation_details b,quotation_approve_details c,quotation1_req d,quotation1ftransfers e   where  a.p_stat='2' and a.category='a' and a.id=b.qid and a.id=c.qid  and a.id=d.qid and a.id=e.qid";

//$qrya2="select sum(c.amt) from quotation1 a,icici_quot_details c  where  a.p_stat='2' and a.category='a'  and a.id=c.qid";

$qrya="select sum(Total) from quotation_details where qid in($instr)";
$qryapp1="select sum(app_amt) from quotation_approve_details where qid in($instr)";
$qryreq2="select sum(req_amt) from quotation_approve_details where qid in($instr)";
$qrytr3="select sum(tamount) from quotation1ftransfers  where qid in($instr)";



$qrya2="select sum(amt) from icici_quot_details where  qid in($instr)";






$qry=mysqli_query($con,$qrya);
$rws=mysqli_fetch_array($qry);
//echo $qrya."<br>";

$qry2=mysqli_query($con,$qrya2);
$rws2=mysqli_fetch_array($qry2);
//echo $qrya2

$qryapr1=mysqli_query($con,$qryapp1);
$rwss2=mysqli_fetch_array($qryapr1);


$qryreqr=mysqli_query($con,$qryreq2);
$rwss3=mysqli_fetch_array($qryreqr);

$qrytrf=mysqli_query($con,$qrytr3);
$rwss4=mysqli_fetch_array($qrytrf);



/*
$qry1=mysqli_query($con,$qrya1);

$quotamt='0';
while($rws1=mysqli_fetch_array($qry1))
{
$qry2=mysqli_query($con,"select sum(Total) where qid='".$rws1[0]."'");
$qry2row=mysqli_fetch_array($qry2);
$quotamt=$quotamt+$qry2row[0];
}
	*/



/*----------------------------------------------------------------------------------------fixed cost-----------------------*/


$qddarrfc=array();
$indetq2="select id from quotation1 where p_stat='2' and category='f' ";

if($_SESSION['custid']!='all')
{
$indetq2.=" and cust='".$_SESSION['custid']."'";
}


if($_POST['cust']!='')
{
$indetq2.=" and cust='".$_POST['cust']."'";
}

//echo $indetq2; 
$indet2=mysqli_query($con,$indetq2);
while($indetrwsfc=mysqli_fetch_array($indet2))
{

$qddarrfc[]=$indetrwsfc[0];
}

$instr2=implode(',',$qddarrfc);

//echo $indetq2;
//print_r($qddarrfc);

$qryafc="select sum(Total) from quotation_details where qid in($instr2)";
$qryaicicifc="select sum(amt) from icici_quot_details where  qid in($instr2)";
//$qryappfc="select sum(app_amt) from quotation_approve_details where qid in($instr2)";
//$qryreqfc="select sum(req_amt) from quotation_approve_details where qid in($instr2)";
$qrytrfc="select sum(tamount) from quotation1ftransfers  where qid in($instr2)";




$qryfc=mysqli_query($con,$qryafc);
$rwsfc=mysqli_fetch_array($qryfc);

$qryfc2=mysqli_query($con,$qryaicicifc);
$rwsfc2=mysqli_fetch_array($qryfc2);



/*$qryapr1fc=mysqli_query($con,$qryappfc);
$rwss2fc=mysqli_fetch_array($qryapr1fc);


$qryreqr=mysqli_query($con,$qryreqfc);
$rwss3fc=mysqli_fetch_array($qryreqr);*/

$qrytrffc=mysqli_query($con,$qrytrfc);
$rwss4fc=mysqli_fetch_array($qrytrffc);




/*-------------------------------------------------------------------------------------------------*/


	?>

<table border='2'>
<th>Category</th>

<th>Sum of Quoted Amount</th>

<th>Sum of Approved AMOUNT</th>

<th>Sum of Required AMOUNT</th>

<th>Sum of Transferred Amount</th>

<th>Sum of Deducted Amount</th>



<!--<tr>
<td>Approval Basis</td>
<td><?php echo round($rws[0]+$rws2[0]);?></td>
<td><?php echo round($rwss2);?></td>
<td><?php echo round($rws[2]);?></td>
<td><?php echo round($rws[3]);?></td>

</tr>-->


<tr>
<td>Approval Basis</td>
<td><?php echo round($rws[0]+$rws2[0]);?></td>
<td><?php echo round($rwss2[0]);?></td>
<td><?php echo round($rwss3[0]);?></td>
<td><?php echo round($rwss4[0]);?></td>
<td><?php echo round($rwss4[0]-$rwss3[0]);?></td>

</tr>


<tr>
<td>Fixed Cost</td>
<td><?php echo round($rwsfc[0]+$rwsfc2[0]);?></td>
<td></td>
<td></td>
<td><?php echo round($rwss4fc[0]);?></td>
<td><?php echo round($rwss4fc[0]-($rwsfc[0]+$rwsfc2[0]));?></td>
</tr>

</table>





<?php } ?>