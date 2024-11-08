<?php
session_start();

include('config.php');
############# must create your db base connection

$strPage = $_REQUEST['Page'];
	//echo $_POST['br'];
$id="";
$cid="";
$bank="";
$city="";
$area="";
$state="";
//$br="Mumbai";
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
$str="";


?>
<form name="frm" method="post" action="multiclose.php">
<table border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res"  id="custtable">
<tr>
<th width="77">Made By</th> 
<th width="77">Complain ID</th> 
<th width="77">Name</th>
<th width="72">ATM</th>
<th width="71">Bank</th>
<th width="71">State</th>
<th width="55">City</th>
<th width="57">Area</th>
<th width="207">Address</th>
<th width="200">Problem</th>
<th width="75">Alert Date</th>
<th width="75">Contact Person</th>
<th width="75"> Phone</th>
<th width="75"> Branch Manager</th>
<th width="75"> Quotation Status</th>
<th width="100">Supervisors Last FeedBack</th>
<th width="67">Status</th>

<th width="48">Update</th></tr>
<?php
include("config.php");


//$table=$filter->filter('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',"alert",array("state"),array($br1[$i]));
if($_POST['br']=='all')
{
$sql="Select * from alert where 1";

}
else
$sql="Select * from alert where area in (".$br2.") ";

if($_SESSION['custid']!='all' && $_SESSION['custid']!='')
{
$ctt=str_replace(",","','",$_SESSION['custid']);
$ctt="'$ctt'";
$sql.=" and  cust_id in ($ctt)";
}
if(isset($_POST['brnch']) && $_POST['brnch']!='-1')
$sql.=" and area='".$_POST['brnch']."'";
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
elseif($calltype=='onhold')
$sql.=" and call_status = '2'";
elseif($calltype=='Rejected')
$sql.=" and call_status = '0'";
}

/*if(isset($_POST['atmid']) && $_POST['atmid']!='')
{
 $id=$_POST['atmid'];
//$sql.=" and ((atm_id IN (select track_id from atm where atm_id LIKE '%".$id."%') or atm_id IN (select amcid from Amc where atmid LIKE '%".$id."%'))";
$sql.=" and atm_id in( select trackerid from '%".$id."%') ";
}*/

if(isset($_POST['cid']) && $_POST['cid']!='')
{
$cid=$_POST['cid'];
//$sql.=" and cust_id IN (select cust_id from customer where cust_name LIKE '%".$cid."%')";
$sql.=" and  cust_id LIKE '%".$cid."%'";
}
 
if(isset($_POST['bank']) && $_POST['bank']!='')
{
$bank=$_REQUEST['bank'];
$sql.=" and bank_name LIKE '%".$bank."%'";
}
if(isset($_POST['doc']) && $_POST['doc']!='')
{
$doc=$_REQUEST['doc'];
$sql.=" and createdby LIKE '%".$doc."%'";
}
if(isset($_POST['supervisor']) && $_POST['supervisor']!='')
{
$super=$_REQUEST['supervisor'];
$sql.=" and quotdetid in (select quotid from quotation where supervisor like '%".$super."%')";
}
if(isset($_POST['prio']) && $_POST['prio']!='')
{
$prio=$_REQUEST['prio'];
$sql.=" and callpriority LIKE '%".$prio."%'";
}
//echo $sql;
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

if(isset($_POST['area']) && $_POST['area']!='')
{
$area=$_REQUEST['area'];
$sql.=" and address LIKE '%".$area."%'";
}
if(isset($_POST['atmid']) && $_POST['atmid']!='')
{
 $id=$_POST['atmid'];
$sql.=" and atm_id LIKE '%".$id."%' ";

}



//echo $sql;
$table=mysqli_query($con,$sql);
if(!$table)
echo mysqli_error();
$count=0;
$Num_Rows = mysqli_num_rows ($table);
 ?>
 <div align="center"><b>Total Records: <?php echo $Num_Rows; ?></b>&nbsp;&nbsp;&nbsp;
 Records Per Page :<select name="perpg" id="perpg" onchange="searchById('Listing','1','perpg');">
 
 <?php
 for($i=1;$i<=$Num_Rows;$i++)
 {
 if($i%50==0)
 {
 ?>
 <option value="<?php echo $i; ?>" <?php if(($_POST['perpg']) && $_POST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo $i."/page"; ?></option>
 <?php
 }
 }
 
 ?>
 <option value="<?php echo $Num_Rows; ?>"<?php if(($_POST['perpg']) && $_POST['perpg']==$Num_Rows){?>  selected="selected" <?php } ?>><?php echo "All"; ?></option>
 </select>
 
 </div>
 <?php
########### pagins
//echo $_POST['perpg'];
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




$sql.=" order by eta ASC,alert_id DESC LIMIT $Page_Start , $Per_Page";
echo $sql;
$table=mysqli_query($con,$sql);

if(mysqli_num_rows($table)>0) {
while($row= mysqli_fetch_row($table))
{


	$qry=mysqli_query($con,"select contact_first from contacts where short_name='".$row[1]."'");
	$custrow=mysqli_fetch_row($qry);
	$tab=mysqli_query($con,"select feedback from eng_feedback where alert_id='".$row[0]."'");
	$row1=mysqli_fetch_row($tab);
		?>
<tr <?php if($row[26]=='1'){ echo "style='background:#99CC33'"; } if($row[16]=='2'){ echo "style='background:#990000'"; } ?>>
<?php $mdby=explode('-',$row[25]);
$getmby=mysqli_query($con,"select username from login where srno='".$mdby[0]."'");
$gmbrow=mysqli_fetch_array($getmby);

?>
<td width="77" valign="top">&nbsp;<?php echo $gmbrow[0]; ?></td>
<td width="77" valign="top">&nbsp;<?php echo $row[25]; ?></td>
<td width="77" valign="top">&nbsp;<?php 
echo $custrow[0];
 ?></td>
<td width="72" valign="top">&nbsp;<?php echo $row[2];// echo $row[17]." ".$row[2];
   
   
   ?></td>
<td width="71" valign="top">&nbsp;<?php echo $row[3]; ?></td>
<td width="71" valign="top">&nbsp;<?php echo $row[27]; ?></td>
<td width="55" valign="top">&nbsp;<?php echo $row[6] ?></td>
<td width="57" valign="top">&nbsp;<?php echo $row[4] ?></td>
<td valign="top">&nbsp;<?php echo $row[5] ?></td>
<td width="200" valign="top">&nbsp;<?php
 echo nl2br($row[9]);
 
 ?></td>
<td width="75" valign="top">&nbsp;<?php
if($row[17]=='service' || $row[17]=='new temp'){ echo date('d/m/Y',strtotime($row[10]));  } else{ if(isset($row[11]) and $row[11]!='0000-00-00') echo date('d/m/Y',strtotime($row[11])); }
?></td>
<td width="75" valign="top">&nbsp;<?php echo $row[12] ?></td>
<td width="75" valign="top">&nbsp;<?php echo $row[13] ?></td>
<td width="75" valign="top">
<?php
$sup=mysqli_query($con,"select supervisor from quotation where quotid='".$row[30]."'");
$supro=mysqli_fetch_row($sup);
echo $supro[0];
 ?></td>
<td width="75" valign="top">&nbsp;<?php 
//echo "select max(appid),appby,remarks from quotapproval where quotid in('".$row[30]."')";
$qstat=mysqli_query($con,"select max(appid),appby,remarks from quotapproval where quotid in('".$row[30]."')");
$qstro=mysqli_fetch_row($qstat);
$rest=explode("***###",$qstro[2]);
if($rest[0]!=''){
echo "<b>By ".$qstro[1]."</b>: ".$rest[0];
}
//echo "Quotation Status"; ?></td>
<td valign="top">&nbsp;<?php if($row1[0]!=''){ ?><a class="update" href="javascript:void(0)" onclick="newwin('masteralert.php?id=<?php echo $row[0] ?>','display')" ><?php echo $row1[0]; ?></a><?php }else{ 
$al=mysqli_query($con,"select feedback from eng_feedback where alert_id='".$row[0]."' order by id DESC limit 1");
$alro=mysqli_fetch_row($al);
echo $alro[0];
 } ?></td>
 <td>
 <?php
 
 //echo $_POST['br']." ".$_SESSION['user'];
 if($row[16]=='1')
 {
 // echo $row[15]." ".$row[16];

 if($row[15]=='1')
 {
if($_SESSION['designation']=='8')
{
if($row[19]!="")
{
?>
<input type="checkbox" name="arr[]" value="<?php echo $row[0]; ?>">

<br><a href="notify.php?req=<?php echo $row[0]?>&br=<?php echo $br ?>&type=wait&atmid=<?php echo $row[2]; ?>">Standby Close</a>
<br><a href="callclose.php?req=<?php echo $row[0]?>&atmid=<?php echo $row[2]; ?>" style="text-decoration:none; color:#FFFFFF" target="_blank">Permanent Close</a>
<?php
}
}
 ?><a href="delegate.php?req=<?php echo $row[0]?>&city=<?php echo $row[6]; ?>&atm=<?php echo $row[2]?>&br=<?php echo $br; ?>&atmid=<?php echo $row[2]; ?>">Delegate</a>


<!--<br><a href="transfercall.php?req=<?php echo $row[0]?>&city=<?php echo $row[6]; ?>&atm=<?php echo $row[2]?>&br=<?php echo $br; ?>">Tansfer</a>-->
<?php

}
elseif($row[15]=='2')
{
echo "Delegated";
?>
<input type="checkbox" name="arr[]" value="<?php echo $row[0]; ?>">
<br><a href="notify.php?req=<?php echo $row[0]?>&br=<?php echo $br ?>&type=wait&atmid=<?php echo $row[2]; ?>">Standby Close</a>
<br><a href="callclose.php?req=<?php echo $row[0]?>&atmid=<?php echo $row[2]; ?>" style="text-decoration:none; color:#FFFFFF" target="_blank">Permanent Close</a>
<?php
}
 if($row[15]=='3')
 {
//echo $row[16];
?>
<input type="checkbox" name="arr[]" value="<?php echo $row[0]; ?>">
<br><a href="notify.php?req=<?php echo $row[0]?>&br=<?php echo $br ?>&type=wait&atmid=<?php echo $row[2]; ?>">Standby Close</a>
<br><a href="callclose.php?req=<?php echo $row[0]?>&atmid=<?php echo $row[2]; ?>" style="text-decoration:none; color:#FFFFFF" target="_blank">Permanent Close</a>
<?php
}
 }
elseif($row[16]=='2')
{
echo "Under Tansferring Process";
}
elseif($row[16]=='4')
{
echo "On Hold";
}
elseif($row[16]=='3')
{
echo "Call Closed";
}
  

 ?>
 </td>
 
 <td>
 <?php
// echo $row[16]
 if(($row[16]=='Delegated' || $row[16]=='2' || $row[16]=='1') && $row[26]!='1')
 {
 ?>
	<a href="update.php?id=<?php echo $row[0]?>&br=<?php echo $br?>&atmid=<?php echo $row[2]; ?>" style="text-decoration:none">Update</a>
	<?php
 }
 
 
 ?><a class="update" href="javascript:void(0);" onclick="newwin('call_update.php?id=<?php echo $row[2]; ?>','display',400,400)" >View Update</a>
 </td>

</tr>
<?php

}
?>
<tr><td colspan="17" align="center"><input type="submit" name="cmdsub" value="Close calls"></td></tr>
</table></form>
<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php

}
if($Prev_Page) 
{
	echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252> << Back</font></a>";
}
/*
for($i=1; $i<=$Num_Pages; $i++){
	if($i != $Page)
	{
		echo " <li><a href=\"JavaScript:searchById('Listing','$i','perpg')\">$i</a> </li>";
	}
	else
	{
		echo "<li class='currentpage'><b> $i </b></li>";
	}
}*/
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}
?>

<div id="bg" class="popup_bg"> </div> 