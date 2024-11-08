<?php
include("access.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
</head>

<body>
<center>

<?php include("menubar.php"); ?>
<h2>View Alerts</h2>
<div id="search"  style="padding-top:-500px">
<?php
$count=0;
$des=$_SESSION['designation'];
 $username=$_SESSION['user'];
//$pass=$_SESSION['password'];

include_once('class_files/select.php');
$sel_obj=new select();
//$sql=$sel_obj->select_rows('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("*"),"area_engg","email_id",$username,array(""),"y","city","a");
//$row=mysqli_fetch_row($sql);
	include("config.php");
	//echo "select srno from login where username='".$_SESSION['user']."'";
	$qry=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
	$row=mysqli_fetch_row($qry);
	//echo $row[0];
	//echo "<br>select engg_id from area_engg where loginid='".$row[0]."'";
	$qry2=mysqli_query($con,"select engg_id from area_engg where loginid='".$row[0]."'");
	$row2=mysqli_fetch_row($qry2);
	//echo "<br>".$row2[0];
?>
<table width="506" border="1" cellpadding="2" cellspacing="0" class="res">
<th>Complain ID</th>
<th width="49">ATM</th>
<th width="68">Bank</th>
<th width="58">Area</th>
<th width="58">Address</th>
<th width="106">Problem</th>
<th width="58">Call Status</th>
<!--<th width="58">Assets / Qty</th>-->
<th width="106">Status</th>


<?php
//echo "Select * from alert_delegation where engineer='".$row2[0]."' and status='1' and alert_id in (select alert_id from alert where call_status<>'3')";
$sql1=mysqli_query($con,"Select * from alert_delegation where engineer='".$row2[0]."' and alert_id in (select alert_id from alert where call_status='1')");


while($row1=mysqli_fetch_row($sql1)) {
	$atmrow='';
$sql2=mysqli_query($con,"select * from alert where alert_id='".$row1[3]."'and call_status<>'3'");	
	$row2=mysqli_fetch_row($sql2);
if($row2[17]=='rnmsites')
$at="select atm_id1 from rnmsites where trackerid='".$row2[2]."'";
elseif($row2[17]=='sites')
$at="select atm_id1 from ".$row2[1]."_sites where trackerid='".$row2[2]."'";
$atm=mysqli_query($con,$at);
	$atmrow=mysqli_fetch_row($atm);
	 if($row2[16]!='3')
	 {
	 
	 $count=$count+1;
?>
<tr class="<?php if($count%2==0){ echo "res1"; } else{ echo "res2"; }  ?>">
<td><?php echo $row2[25]; ?></td>
<td><?php echo $atmrow[0]; ?></td>
<td><?php echo $row2[3]; ?></td>
<td><?php echo $row2[4]; ?></td>
<td><?php echo $row2[5]; ?></td>
<td><?php echo $row2[9];

 ?></td>
<td><?php 
echo $row2[16];
if($row2[16]=='3')
echo "Done";
else
echo "Pending";

 ?></td>


<td>
<?php if($row2[15]!='3') { ?>
<input type="button" value="Update" class="readbutton" onclick="javascript:location.href='eng_feedback.php?alert=<?php echo $row1[3]; ?>&eng_id=<?php echo $row[0]; ?>'"/>
<?php } else { ?>
<img src="images/right.png" /><?php } ?></td>
</tr>
<?php } } 
if($_SESSION['user']=='masteradmin')
{
//echo "Select * from alert_delegation order by id DESC";
$sq=mysqli_query($con,"Select * from alert_delegation order by id DESC");
//$sql1=$sel_obj->select_rows('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("alert_id"),"alert_delegation","engineer",$row[0],array(""),"y","","");
while($ro=mysqli_fetch_row($sq)) {
	$atmrow='';
	//echo "select * from alert where alert_id='".$row1[3]."'";
	//echo "select * from alert where alert_id='".$ro[3]."' and call_status<>'Done'";
$sql2=mysqli_query($con,"select * from alert where alert_id='".$ro[3]."' and call_status<>'Done'");	//$sql2=$sel_obj->select_rows('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("*"),"alert","alert_id",$row1[0],array(""),"y","","");
	while($row2=mysqli_fetch_row($sql2))
	{
if($row2[17]=='service')
{
	$atm=mysqli_query($con,"select atmid from Amc where amcid='".$row2[2]."'");
	$atmrow=mysqli_fetch_row($atm);
}
$count=$count+1;	
?>
<tr class="<?php if($count%2==0){ echo "res1"; } else{ echo "res2"; }  ?>">
<td><?php echo $row2[25]; ?></td>
<td><?php if($row2[17]=='new' || $row2[17]=='new temp' ){ echo $row2[2];}else{ echo $atmrow[0]; } ?></td>
<td><?php echo $row2[3]; ?></td>
<td><?php echo $row2[4]; ?></td>
<td><?php echo $row2[5]; ?></td>
<td><?php echo $row2[9];
if($row2[28]=='1')
 {
 //echo "select desc from buyback where alertid='".$row[0]."'";
// echo "select * from buyback where alertid='".$row2[0]."'";
 $buy=mysqli_query($con,"select * from buyback where alertid='".$row2[0]."'");
 $buyro=mysqli_fetch_row($buy);
 echo "<br><b>Buy Back :</b>".$buyro[2];
 
 }
 ?></td>
<td><?php if($row2[16]=='1')
echo "Pending";
else
echo $row2[16]; ?></td>

<td><?php

 for($i=0;$i<count($row2[0]);$i++) {
 //echo "select assets,qty from alert_assets where alert_id='$row2[0]'";
 $sql3=mysqli_query($con,"select assets,qty from alert_assets where alert_id='$row2[0]'");
       while($row3=mysqli_fetch_row($sql3))
       echo $row3[0]."($row3[1])".", ";}
       ?></td>
<td>
<?php if($row2[15]!='3') { ?>
<input type="button" value="Update" class="readbutton" onclick="javascript:location.href='eng_feedback.php?alert=<?php echo $ro[3]; ?>&eng_id=<?php echo $row[0]; ?>'"/>
<?php } else { ?>
<img src="images/right.png" /><?php } ?></td>
</tr>
<?php } } 	
}
?>
</table>
</div>
</center>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>