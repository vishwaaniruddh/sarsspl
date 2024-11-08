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
$dt1='';
$dt2='';
if($yr!='' && $mon!=''){
$dt1=date('Y-m-d',strtotime($yr."-".$mon."-01"));
$dt2=date('Y-m-d',strtotime($yr."-".$mon."-31"));
}
else
{
//date('m-01-Y'); // hard-coded '01' for first day
//$last_day_this_month  = date('m-t-Y')
$dt1=date('Y-m-01');
$dt2=date('Y-m-t');
}
$sdate="";
$edate="";
$curdt=date('Y-m-d H:i:s');
//	$strPage = $_REQUEST['Page'];
	//atm whose request has not been received
//before 1 week of next due_date 
//select trackerid from ebillfundrequests` where due_date<='".date('Y-m-d',strtotime('-1 week'))."'
	$sql2="SELECT atmid FROM `ebillfundrequests` WHERE cust_id='".$cid."' and `due_date` between '".$dt1."' and '".$dt2."'";
	//echo $sql2;
	$table2=mysqli_query($con,$sql2);
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
        $sql="SELECT m.atm_id1,s.bank,s.atmsite_address,s.csslocalbranch,s.state,e.Due_Date FROM `mastersites` m,".$cid."_sites s,".$cid."_ebill e WHERE s.trackerid=m.trackerid and m.trackerid=e.atmtrackid and m.status='0'";
        if($atms!="''")
        $sql.="  and m.`atm_id1` not in($atms)";
if(isset($_POST['bank']) && $_POST['bank']!='')
$sql.=" and s.bank='".$_POST['bank']."'";
if(isset($_POST['atm']) && $_POST['atm']!='')
$sql.=" and s.atm_id1 Like '%".$_POST['atm']."%'";
$curdt=date('d');
$curdt2=date('d',strtotime('+1 week'));


$sql.=" and e.Due_Date Between $range";
//echo strtotime(date('Y-m-01'))." ".strtotime($yr."-".$mon."-01");
//echo $yr." ".$mon;
$str1='';
$str2='';
if($yr!='' && $mon!='')
{
//echo "hi";
$str1=strtotime(date('Y-m'));
$str2=strtotime(date('Y-m',strtotime($yr."-".$mon."")));
if($str1>$str2)
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

?><center>
<b>Total Number Of Records : <?php echo mysqli_num_rows($table); ?></b>
<table><tr><th>Atm ID</th><th>Due date</th><th>Bank</th><th>Css LocalBranch</th><th>State</th><th>Address</th></tr>
<?php
        while($row=mysqli_fetch_row($table))
	{ 
?>
<tr <?php if($yr!='' && $mon!='')
{
if($str1>$str2)
{
?>style="background:red"
<?php
}
else{
//echo $str1." ".$str2;
if($str1==$str2)
if($row[5]>=$curdt && $row[5]<=$curdt2){ ?> style="background:yellow"<?php }elseif($row[5]<$curdt){  ?> style="background:red"<?php }
}
}
else{ if($row[5]>=$curdt && $row[5]<=$curdt2){ ?> style="background:yellow"<?php }elseif($row[5]<$curdt){  ?> style="background:red"<?php } } ?>><td><?php echo $row[0]; ?></td>
<td><?php echo $row[5]; ?></td>
<td><?php echo $row[1]; ?></td>
<td><?php echo $row[3]; ?></td>
<td><?php echo $row[4]; ?></td>
<td><?php echo $row[2]; ?></td>
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
?>