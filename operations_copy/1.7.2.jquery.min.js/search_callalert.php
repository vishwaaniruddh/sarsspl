<?php
session_start();
//echo $_SESSION['user'];
//include('config.php');
############# must create your db base connection
//echo "hhj";

//if($_REQUEST['mode']=="Listing"){
include("access.php");
	$strPage = $_REQUEST['Page'];

$id="";
$cid="";
$bank="";
$city="";

//$br="Mumbai";

include("config.php");

$bran=array();
//echo $_SESSION['branch'];
  $ser= $_POST['service'];
$service2='';

$br=$_POST['br'];
if($_POST['br']!='all')
{
$br1=str_replace(",","','",$br);//echo $br1[0]."/".$br1[1];
$br1="'".$br1."'";

$src=mysqli_query($con,"select location from cssbranch where id in (".$br1.")");
while($srcrow=mysqli_fetch_array($src))
{
	$bran[]=$srcrow[0];
}
$br3=implode(",",$bran);
$br2=str_replace(",","','",$br3);//echo $br1[0]."/".$br1[1];
$br2="'".$br2."'";
 $service=implode(",",$ser);
$service2=str_replace(",","','",$ser);//echo $br1[0]."/".$br1[1];
$service2="'".$service2."'";

}
$sql="";

$count=0;
//echo "br=".$_POST['br'];
if($_POST['br']=='all' || $_POST['br']=='0')
{
$sql="Select * from alert where 1";

}
else
$sql="Select * from alert where area in (".$br2.") ";
if(isset($_POST['brnch']) && $_POST['brnch']!='-1'&& $_POST['brnch']!='')
$sql.=" and area='".$_POST['brnch']."'";

if(isset($_POST['cid']) && $_POST['cid']!='')
{
$cid=$_POST['cid'];
$sql.=" and cust_id LIKE '%".$cid."%'";
}
 
if(isset($_POST['bank']) && $_POST['bank']!='')
{
$bank=$_REQUEST['bank'];
$sql.=" and bank_name LIKE '%".$bank."%'";
}

if(isset($_POST['state']) && $_POST['state']!='')
{
$area=$_REQUEST['state'];
$sql.=" and address LIKE '%".$area."%'";
}
if(isset($_POST['sdt']) && isset($_POST['edt']) && $_POST['sdt']!='' && $_POST['edt']!='')
{
//echo $sql;
//echo $_POST['sdt']." ".$_POST['edt'];
 $stdt=date('Y-m-d',strtotime(str_replace("/","-",$_POST['sdt'])));
 $edt=date('Y-m-d',strtotime(str_replace("/","-",$_POST['edt'])));
if($stdt!=$edt)
$sql.=" and alert_date BETWEEN '".$stdt."' AND '".$edt."'";
else
$sql.=" and alert_date LIKE '".$stdt."'";

}
if(isset($_POST['calltype']))
{
$calltype=$_REQUEST['calltype'];
if($calltype=='')
{
}
elseif($calltype=='open')
$sql.=" and (call_status='1' or call_status='2')";
elseif($calltype=='Done')
$sql.=" and call_status = '3'";
elseif($calltype=='Rejected')
$sql.=" and call_status = '0'";
}
$table=mysqli_query($con,$sql);

$count=0;
$Num_Rows = mysqli_num_rows ($table);
 ?>
 <div align="center">
 <b>Total Records: <?php echo $Num_Rows; ?></b> &nbsp;&nbsp;Records Per Page :<select name="perpg" id="perpg" onchange="searchById('Listing','1','perpg');">
 
 <?php
 for($i=1;$i<=$Num_Rows;$i++)
 {
 if($i%10==0)
 {
 ?>
 <option value="<?php echo $i; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo $i."/page"; ?></option>
 <?php
 }
 }
 
 ?>
 <option value="<?php echo $Num_Rows; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$Num_Rows){?>  selected="selected" <?php } ?>><?php echo "All"; ?></option>
 </select>
 
 </div>
 <?php
 
########### pagins

$Per_Page =$_POST['perpg'];   // Records Per Page
 
$Page = $strPage;
if(!$strPage)
{
	$Page=1;
}
 
$Prev_Page = $Page-1;
$Next_Page = $Page+1;


$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page)
{
	$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
	$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
	$Num_Pages =($Num_Rows/$Per_Page)+1;
	$Num_Pages = (int)$Num_Pages;
}
$qr22=$sql;
$sql.=" order by alert_id DESC LIMIT $Page_Start , $Per_Page";
//echo $sql;
$table=mysqli_query($con,$sql);
/*include_once('class_files/table_formation.php');

$form=new table_formation();
$form->table_forming(array("","","","","","","","","","",""),$table,"n");*/
//$table=mysqli_query($con,"select cust_id,atm_id,bank_name,state,createdby from alert");
?>
<table><tr><td valign="top" style="background:#4aba8d;">&nbsp;</td><td valign="top">Once Reactivated</td><td valign="top" style="background:#3b9bc4">&nbsp;</td><td valign="top">Twice Reactivated</td><td valign="top" style="background:#ad3d3d">&nbsp;</td><td valign="top">Thrice Reactivated</td><td valign="top" style="background:#d42b55">&nbsp;</td><td valign="top">More than Thrice Reactivated</td></tr></table>
<table border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res">


<th width="77">Complaint No</th>
<th width="77">Name</th>
<th width="75">ATM</th>
<th width="125">Bank</th>
<th width="125">State</th>
<th width="125">Site Address</th>
<th width="75">Problem</th>

<th width="75"> Date</th>
<th width="75">Contact Person</th>
<th width="75">Phone</th>

<th width="45">Status</th>
<th width="45">Call Close Date/time</th>

<th width="45">Response Time</th>
<th width="45">Resolution Time</th>
<th width="45">Customer Status</th>
<th width="45">Last Feedback</th>
<th>Quotation Status</th>
<th width="45">Update</th>
<?php


// Insert a new row in the table for each person returned
if(mysqli_num_rows($table)>0) {
while($row= mysqli_fetch_row($table))
{
$count=$count+1;
include("config.php");
$react=mysqli_query($con,"select * from alert_reactive where alert_id='".$row[0]."'");
$recnum=mysqli_num_rows($react);
//$qry3=$filter->filter('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',"customer",array("cust_name"),array($row[0]));
//echo "select cust_name from customer where cust_id='".$row[1]."'";
if($row[17]=='sites')
$atmstr="select atm_id1 from ".$row[1]."_sites where trackerid='".$row[2]."'";
if($row[17]=='rnmsites')
$atmstr="select atm_id1 from rnmsites where id='".$row[2]."'";

if(isset($_POST['atmid']) && $_POST['atmid']!='')
{
 $id=$_POST['atmid'];
//$atmstr.=" and atm_id1 like ('%".$id."%')";
$atmstr.=" and (atm_id1 LIKE '%".$id."%' or atm_id2 LIKE '%".$id."%' or atm_id3 LIKE '%".$id."%')";
}
$atm=mysqli_query($con,$atmstr);
if(mysqli_num_rows($atm)>0){
$atmrow=mysqli_fetch_row($atm);

$qry3=mysqli_query($con,"select contact_first from contacts where short_name='".$row[1]."'");
$row3=mysqli_fetch_row($qry3);
$tab=mysqli_query($con,"select up from alert_updates where alert_id='$row[0]' order by id DESC");
	//include_once('class_files/filter.php');
	//$ob=new filter();
	//$tab=$ob->filter_by('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("up"),'alert_updates',array("alert_id"),array($row[0]),'','');
	$row1=mysqli_fetch_row($tab);
	
$time1 = strtotime($row[10]);
$time2 = strtotime($row[18]);

$diff = $time2-$time1;
$hours = $diff / 3600; // 3600 seconds in an hour
$minutes = ($hours - floor($hours)) * 60;
$final_hours = round($hours,0);
$final_minutes = round($minutes);//echo $final_hours. "/" .$final_minutes;

?><tr <?php if($recnum==1){ ?> style="background:#4aba8d;"<?php  }elseif($recnum==2){ ?> style="background:#3b9bc4"<?php  }elseif($recnum==3){ ?> style="background:#ad3d3d"<?php  }elseif($recnum>3){ ?> style="background:#d42b55"<?php  } ?>>
<td valign="top" valign="top" width="77"><?php echo $row[25]?></td>
<td valign="top" valign="top" width="77"><?php echo $row3[0] ?></td>
<td valign="top" valign="top" width="125"><?php echo $atmrow[0]; ?></td>
<td valign="top" valign="top" width="75"><?php echo $row[3]; ?></td>
<td valign="top" valign="top" width="75"><?php echo $row[27] ?></td>
<td valign="top" valign="top" width="75"><?php echo $row[5]?></td>
<td valign="top" valign="top" width="75"><?php echo $row[9]?></td>
<td valign="top" valign="top" width="75"><?php if($row[17]=='new'){ echo "".date('d/m/Y',strtotime($row[11])); }else { echo date('d/m/Y',strtotime($row[10])); }
?></td>
<td valign="top" valign="top" width="75"><?php echo $row[12] ?></td>
<td valign="top" valign="top" width="75"><?php echo $row[13] ?></td>
<td valign="top" valign="top"><?php 
if($row[16]=='1')
echo "Pending";
elseif($row[16]=='0')
echo "Rejected";
elseif($row[16]=='2')
echo "Waiting for Final Close";
elseif($row[16]=='3' || $row[16]=='4')
echo "Closed"; ?></td>
<td valign="top" valign="top" width="75"><?php  
if(isset($row[18]) and $row[18]!='0000-00-00 00:00:00') echo date('d/m/Y h:i a',strtotime($row[18]));
?></td>
<td valign="top" valign="top" width="75"><?php 
if($row[24]!='0000-00-00 00:00:00')
echo date('d/m/Y g:i:s a',strtotime($row[24]));
?></td><td valign="top" valign="top"><?php 

if($row[18]!='0000-00-00 00:00:00')
echo ''.$final_hours. "h " .$final_minutes."m";
?></td>
<td valign="top" valign="top" width="75"><?php echo $row[17] ?></td>
<td valign="top" valign="top">

<?php echo $row1[0]; ?></td>
<td valign="top" valign="top" width="75" valign="top"><?php 
//echo "select max(appid),appby,remarks,quotid from quotapproval where quotid in('".$row[30]."')";
$qstat=mysqli_query($con,"select max(appid),appby,remarks,quotid from quotapproval where quotid in('".$row[30]."')");
if(mysqli_num_rows($qstat)>0)
{
$qstro=mysqli_fetch_row($qstat);
$rest=explode("***###",$qstro[2]);

?>
<a href="javascript:void(0);" onclick="newwin('viewquotedet.php?quotid=<?php echo $row[30]; ?>', 'display',400,400);" ><?php echo "<b>By ".$qstro[1]."</b>: ".$rest[0];
?>
</a>
<?php

}
//echo "Quotation Status"; 
?></td>
<td valign="top" valign="top">

<!--<a class="update" href="javascript:void(0);"  onClick="openpopup('<?php echo $row[0] ?>','display','400','400')" >Update</a>-->
<?php if($row[16]=='3'){ ?>
<a class="update" href="reactivecall.php?id=<?php echo $row[0]; ?>" >Reactivate</a><br><?php } ?>
<a class="update" href="javascript:void(0);" onclick="newwin('call_update.php?id=<?php echo $row[0] ?>','display','400','400')" >View Update</a>
<div id="<?php echo $row[0] ?>"  class="popup"></div></td>
</tr><?php 
}}
?>
</table>
<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php
}
if($Prev_Page) 
{
	echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252> << Back</font></a> ";
}
/*
for($i=1; $i<=$Num_Pages; $i++){
	if($i != $Page)
	{
		echo " <li><a href=\"JavaScript:searchById('Listing','$i')\">$i</a> </li>";
	}
	else
	{
		echo "<li class='currentpage'><b> $i </b></li>";
	}
}*/
if($Page!=$Num_Pages)
{
	echo "<a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}
?>
<form name="frm" method="post" action="exportme2.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >