<?php
session_start();
//echo $_SESSION['user'];
//$desig= $_POST['desig'];
//$service=$_POST['service'];
 //$dept=$_POST['dept'];

include('config.php');

$cid=$_POST['cid'];
$range=$_POST['range'];
$yr=$_POST['yr'];
$mon=$_POST['mon'];
$yr2=$_POST['yr2'];
$mon2=$_POST['mon2'];
$dt1='';
$dt2='';
if($yr!='' && $mon!='' && $yr2!='' && $mon2!=''){
$dt1=date('Y-m-d',strtotime($yr."-".$mon."-01"));
$dt2=date('Y-'.$mon2.'-t');
}
else
{
//date('m-01-Y'); // hard-coded '01' for first day
//$last_day_this_month  = date('m-t-Y')
$dt1=date('Y-m-01');
$dt2=date('Y-m-31');
}
$sdate="";
$edate="";
if(strtotime($dt1)>strtotime($dt2))
echo "<center>Invalid Date</center>";
$curdt=date('Y-m-d H:i:s');
//	$strPage = $_REQUEST['Page'];
	//atm whose request has not been received
//before 1 week of next due_date 
//select trackerid from ebillfundrequests` where due_date<='".date('Y-m-d',strtotime('-1 week'))."'
	$sql2="SELECT atmid FROM `ebillfundrequests` WHERE cust_id='".$cid."' and `due_date` between '".$dt1."' and '".$dt2."' and reqstatus<>'0'";
	//echo $sql2;
	$table2=mysqli_query($con,$sql2);
	//echo mysqli_num_rows($table2);
	$ct='';
	$atms='';
	$cnt=0;
	$x=0;
	while($row2=mysqli_fetch_row($table2))
	{ 
	// echo ($x+1).'-';
	// echo $row[0].'<br>';
	if($cnt==0)
	$atms.=$row2[0];
	else
	 $atms.=','.$row2[0];
	 $cnt=$cnt+1;
	// $x++;
	}
//echo $atms;
	//$atms=substring($atms,0,length($atms)-1);
	$atms.'0';
	$atms=str_replace(",","','",$atms);
	$atms="'".$atms."'";
	//echo $atms;
        $sql="SELECT m.atm_id1,s.bank,s.atmsite_address,s.csslocalbranch,s.state,e.Due_Date FROM `mastersites` m,".$cid."_sites s,".$cid."_ebill e WHERE s.trackerid=m.trackerid and m.trackerid=e.atmtrackid and m.status='0' and s.ebill='Y'";
        if($atms!="''")
        $sql.="  and m.`atm_id1` not in($atms)";
if(isset($_POST['bank']) && $_POST['bank']!='')
$sql.=" and s.bank='".$_POST['bank']."'";
if(isset($_POST['atm']) && $_POST['atm']!='')
$sql.=" and s.atm_id1 Like '%".$_POST['atm']."%'";
$curdt=date('d');
$curdt2=date('d',strtotime('+1 week'));
;//echo $range;
if($range=='-1')
$sql.=" and e.Due_Date Between 0 and ".date('t');
else if($range=='week')
{
 $ddt=date('Y-m-d');
//echo date('Y-m-d',strtotime(date("Y-m-d", strtotime($ddt)) . " +1 day"))."<br>";
$nod=array();
for($i=0;$i<=7;$i++)
{
//echo $i;
//echo date('Y-m-d',strtotime(date("Y-m-d", strtotime($ddt)) . " +$i day"))."<br>";
$nod[]=date('d',strtotime(date("Y-m-d", strtotime($ddt)) . " +$i day"));
}
$nod2=implode(",",$nod);
$sql.=" and e.Due_Date in($nod2)";
}
else
{
$sql.=" and e.Due_Date Between 0 and ".date('d',strtotime('-1 days'));
}
//"0 and ".date('t')
//date('d')." and ".date('d',strtotime('+1 week'))
//"0 and ".date('d',strtotime('-1 days'))

//echo strtotime(date('Y-m-01'))." ".strtotime($yr."-".$mon."-01");
//echo $yr." ".$mon;
$str1='';
$str2='';
if(($yr!='' && $mon!='') || $range=='week')
{
//echo "hi";
$str1=strtotime(date('Y-m'));
$str2=strtotime(date('Y-m',strtotime($yr."-".$mon."")));
if($str1>$str2 ||  $range=='week')
$sql.=" order by e.Due_Date DESC";
else
$sql.=" order by e.Due_Date ASC";
}
else
$sql.=" order by e.Due_Date ASC";
//echo $sql;
//echo "<br>".$str1." ".$str2;
        $table=mysqli_query($con,$sql);
        if(!$table)
echo mysqli_error();
if(mysqli_num_rows($table)>0){
$cnt=mysqli_query($con,"select * from ".$cid."_ebill where atmtrackid in (select trackerid from ".$cid."_sites where ebill='Y')");

?><center>
<b>Total EBill Sites: <?php echo mysqli_num_rows($cnt); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Number Of Records : <?php echo mysqli_num_rows($table); ?>   </b>
<table id="custtable"><tr><th>Atm ID</th><th>Due date</th><th>Bank</th><th>Css LocalBranch</th><th>State</th><th>Address</th><th>Average Amount</th></tr>
<?php
        while($row=mysqli_fetch_row($table))
	{ 
		$ebfundreq_qry=mysqli_query($con,"select * from ebillfundrequests where atmid like '".$row[0]."' order by req_no desc");
		if(mysqli_num_rows($ebfundreq_qry)>0)
		{
			$ebfundreq_row=mysqli_fetch_array($ebfundreq_qry);
			$nod1=floor((strtotime($ebfundreq_row['end_date'])-strtotime($ebfundreq_row['start_date'])) / 86400);
			if($ebfundreq_row['approvedamt']!=0)
				$amt=$ebfundreq_row['approvedamt'];
			else
				$amt=$ebfundreq_row['amount'];
		}
		else
			$nod1=0;
?>
<tr <?php if($yr!='' && $mon!='')
{
if($str1>$str2 && $range!='week')
{
?>style="background:red"
<?php
}
else{
//echo $str1." ".$str2;
if($str1==$str2)
if($row[5]>=$curdt && $row[5]<=$curdt2){ ?> style="background:yellow"<?php }elseif($row[5]<$curdt && $range!='week'){  ?> style="background:red"<?php }
}
}
else{ if($row[5]>=$curdt && $row[5]<=$curdt2){ ?> style="background:yellow"<?php }elseif($row[5]<$curdt && $range!='week'){  ?> style="background:red"<?php } } ?>><td><?php echo $row[0]; ?></td>
<td><?php echo $row[5]; ?></td>
<td><?php echo $row[1]; ?></td>
<td><?php echo $row[3]; ?></td>
<td><?php echo $row[4]; ?></td>
<td><?php echo $row[2]; ?></td>
<td><?php if($nod1==0){ echo "NA"; }else{echo number_format($amt*30.0/$nod1,2);} ?></td>
</tr>
<?php
	/* echo ($x+1).'-';
	 echo $row[0].'<br>';
	 $atms.=$row[0].',';*/
	 $x++;
	}
?>
</table></center>
<?php
}
else
echo "No data to display";
?>