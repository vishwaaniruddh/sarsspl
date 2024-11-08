<?php
session_start();
//echo $_SESSION['user'];
$desig= $_POST['desig'];
$service=$_POST['service'];
 $dept=$_POST['dept'];
 $br=$_POST['br'];
include('config.php');

$cid="";

$sdate="";
$edate="";

	$strPage = $_REQUEST['Page'];
	
	$sql="Select q.quotid,q.quotby,q.cust_id,q.trackerid,q.description,q.dept,l.username,q.entrydt,q.status,q.approvalform,q.sitetype,q.supervisor,q.reqamt,q.approvedamt,q.clientappdate,q.type,q.totalcost from quotation q,login l where  l.srno=q.quotby";
if(isset($_POST['cid']) && $_POST['cid']!='' && $_POST['cid']!='-1' && $_POST['cid']!='all' && $_POST['cid']!='All')
$sql.=" and q.cust_id='".$_POST['cid']."'";
if(isset($br) && $br!='' && $br!='All' && $br!='-1' && $br!='all')
{
$loc=array();
$br2=mysqli_query($con,"select location from cssbranch where id in($br)");
while($brro=mysqli_fetch_row($br2))
$loc[]=$brro[0];

$location=implode(",",$loc);
$location=str_replace(",","','",$location);
$location="'".$location."'";
$sql.=" and q.csslocalbranch in($location)";
}
	//echo $_POST['pstat'];
	if(isset($_POST['pstat']) && $_POST['pstat']=='-1')
	{
	
	$sql.=" and (q.status between '1' and '7' or q.status>10)";
	
	}
	else
	{
	
	$sql.=" and q.status='".$_POST['pstat']."'";
	
	}
	
	
	if(isset($_POST['sup']) && $_POST['sup']!='-1')
	$sql.=" and q.supervisor='".$_POST['sup']."'";
	
	if(isset($_POST['qtype']) && $_POST['qtype']!='')
	$sql.=" and q.type='".$_POST['qtype']."'";
	
	
	if(isset($_POST['app']) && $_POST['app']!='')
	{
	if($_POST['app']!='100')
	$sql.=" and q.status='".$_POST['app']."'";
	else
	$sql.=" and q.totalcost>0 and (q.clientappdate='0000-00-00')";
	
	}
	

if(isset($_POST['sdate']) && $_POST['sdate']!='' && isset($_POST['edate']) && $_POST['edate']!='')
{
 $sdate=$_REQUEST['sdate'];
$sdate=str_replace("/","-",$sdate);
$sdate=date("Y-m-d",strtotime($sdate));
$edate=$_REQUEST['edate'];
$edate=str_replace("/","-",$edate);
$edate=date("Y-m-d",strtotime($edate));

//echo $sdate2;
if($sdate!=$edate)
$sql.=" and q.entrydt between STR_TO_DATE('".$_POST['sdate']."','%d/%m/%Y') and STR_TO_DATE('".$_POST['edate']."','%d/%m/%Y')";
else
$sql.=" and q.entrydt='".$sdate."'";
}

/*if($desig=="11" && $service=='3' && $dept=='4')
{
$qr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
$qrro=mysqli_fetch_row($qr);
//$sql.=" and requestby='".$qrro[0]."'";
$sql.=" and q.quotby='".$qrro[0]."'";
}*/

//echo $sql;
$table=mysqli_query($con,$sql);

$Num_Rows = mysqli_num_rows ($table);
 
// pagins
?>
 <div align="center">
 Records Per Page :<select name="perpg" id="perpg" onChange="searchById('Listing','1','perpg');">
 
 <?php
 for($i=1;$i<=$Num_Rows;$i++)
 {
 if($i%50==0)
 {
 ?>
 <option value="<?php echo $i; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo $i."/page"; ?></option>
 <?php
 }
 }
 
 ?>
 <option value="<?php echo $Num_Rows; ?>"><?php echo "All"; ?></option>
 </select>
 
 </div>
 <?php
// pagins
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
$sql.=" order by q.quotid DESC";
if(isset($_POST['atmid']) && $_POST['atmid']=='')
$sql.=" LIMIT $Page_Start , $Per_Page";

//echo $sql;
$table=mysqli_query($con,$sql);
if(!$table)
echo mysqli_error();
//include_once('class_files/filter_new.php');
//$filter=new filter_new();
//$table=$filter->filter($id,$cid,$bank,$area,$pin,$city,$state,$sdate,$edate);

/*include_once('class_files/table_formation.php');
$form=new table_formation();
$form->table_forming(array("","","","","",""),$table,"n");*/
include("config.php");
?>
<table width="995" border="1" cellpadding="2" cellspacing="0"  id="custtable" style="margin-top:5px;"> 


<th width="75">Sr NO</th>
<th width="75">Requesting Person</th>
<th width="75">Entered By</th>
<th width="75">Department</th>
<th width="75">Atm ID</th>
<th width="75">Address</th>
<th width="75">Bank</th>
<th width="300">Memo</th>
<th width="75">Date</th>
<th width="75">Requested Amount</th>
<th width="75">Approved Amount</th>
<th style="overflow: hidden; width: 40px; font-size:small;">Last Approval Details</th>

<th width="75">Approval</th>
<?php
// Insert a new row in the table for each person returned
if(mysqli_num_rows($table)>0) {
$count=0;
while($row= mysqli_fetch_row($table))
{
//echo $row[10]."<br>";

$qry1=mysqli_query($con,"select short_name,contact_first from contacts where short_name='$row[2]'");
$qrrow=mysqli_fetch_array($qry1);
//echo "select username from login where srno='".$row[1]."'";
$branch=mysqli_query($con,"select username from login where srno='".$row[1]."'");
$brro=mysqli_fetch_row($branch);
$deptde=mysqli_query($con,"select `desc` from department where deptid='".$row[5]."'");
$dtro=mysqli_fetch_row($deptde);
//$crow=mysqli_fetch_row($qry1);
$str='';	
if($row[10]=='rnmsites')
$str=" select atmsite_address,bank,atm_id1 from rnmsites where id='".$row[3]."'";
else
$str=" select atmsite_address,bank,atm_id1 from ".$row[2]."_sites where trackerid='".$row[3]."'";

if(isset($_POST['atmid']) && $_POST['atmid']!='')
$str.=" and (atm_id1 like '%".$_POST['atmid']."%' or atm_id2 like '%".$_POST['atmid']."%' or atm_id3 like '%".$_POST['atmid']."%')";
$site=mysqli_query($con,$str);
if(mysqli_num_rows($site)>0){
$sitero=mysqli_fetch_row($site);
//echo "hi";
?><div class=article>
<div class=title><tr>
<td valign="top" valign="top" width="75"><?php echo $count+1; ?></td>
<td valign="top" width="75"><?php echo $row[11]; //echo $row[6]; ?></td><td valign="top" width="75"><?php echo $brro[0]; //echo $row[6]; ?></td>
<td valign="top" width="75"><?php echo $dtro[0]; ?></td>
<td valign="top" width="75"><?php echo $sitero[2]; //echo $row[6]; ?></td>
<td valign="top" width="75"><?php echo $sitero[0]; //echo $row[6]; ?></td>
<td valign="top" width="75"><?php echo $sitero[1]; ?></td>
<td valign="top" width="300"><?php //echo "hi".$row[4];
$asst=array();
$stat=0;
$tot=0;
$num=0;
//echo "select * from quot_details where quotid='".$row[0]."'  and status='0' order by component,material ASC";
$det=mysqli_query($con,"select * from quot_details where quotid='".$row[0]."'  and status='0' order by component,material ASC");
while($detro=mysqli_fetch_array($det))
{
//echo "select * from atmassets where now='".$detro[9]."' and problem='".$detro[7]."' and description='".$detro[2]."' ";
$ck=mysqli_query($con,"select * from atmassets where now='".$detro[9]."' and problem='".$detro[7]."' and description='".$detro[2]."'");
if(mysqli_num_rows($ck)>0){
$stat=$stat+1;

  if(in_array($detro[7],$asst)){  $num=$num+1;
  if($detro[6]==1){ echo "<strike>";}
 echo $num.". ".$detro[2]." ".$detro[12]."(".$detro[3]." ".$detro[4]." * ".$detro[8].")<br>";
 if($detro[6]==1){ echo "</strike>";}
 }else{ 
$num=$num+1;
echo "<b><u>".$detro[7]."</u></b>";
 if($detro[6]==1){ echo "<strike>";}
echo "<br>".$num.". ".$detro[2]." ".$detro[12]."(".$detro[3]." ".$detro[4]." * ".$detro[8].")<br>";$asst[]=$detro[7];
if($detro[6]==1){ echo "</strike>";}
 } 
}
}
 ?></td>
<td valign="top" width="75"><?php echo date("d/m/Y h:i:s a",strtotime($row[7])); ?></td>

<td valign="top" width="75"><?php echo $row[12]; ?></td>
<td valign="top" width="75"><?php echo $row[13]; ?></td>
<td style="overflow: hidden; width: 250px; height:40px; font-size:small;">

<?php
//echo "select appid,appby,apptime,level,remarks from fundrequestapproval where reqid='".$row[0]."' order by appid DESC limit 1";
$lst=mysqli_query($con,"select appid,appby,apptime,level,remarks from quotapproval where quotid='".$row[0]."' order by appid DESC limit 1");
while($lstro=mysqli_fetch_array($lst))
{
if($lstro[3]=='0')
$stat="Rejected";
else
$stat="Approved";
$rem=explode("***###",$lstro[4]);
echo $lstro[1]."<br> ".date("d/m/Y h:i:s a",strtotime($lstro[2]))." <br>".$stat."<br> ".nl2br($rem[0]);
}
?><br /><br />
<a href="#" onClick="newwin('viewquotedet.php?quotid=<?php echo $row[0]; ?>','display')">View Details</a>
<br />
<?php /*if($desig<='8'){*/ ?><a href="#" onClick="newwin('viewquoteformat.php?quotid=<?php echo $row[0]; ?>','display')">Click to view Quotation</a><?php // } ?>
</td>


<td valign="top" id="app<?php echo $count; ?>">
<?php 
if($row[8]=='8')
echo "Amount Paid: Rs. ".$row[13];
//echo "desig=".$desig." ".$service." ".$dept." ".$row[8];
if($desig=="11"  && $service=='1' && $dept=='4' && ($row[8]=='1' || $row[8]=='2'|| $row[8]=='11'))
{
if($row[8]=='11' || $row[8]=='1'){
?>
<input type="button" onClick="showrem('showrem<?php echo $count; ?>')" value="Update" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none">
<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','20')" value="Go" style="background:#FFFF99">&nbsp;&nbsp;&nbsp;
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99">
</div>

<?php } ?>
<!--<a href="viewquoteformat.php?quotid=<?php echo $row[0] ?>" target="_blank">Mailing Format</a>--><br />
<a href="Editquote.php?quotid=<?php echo $row[0] ?>&st=20"> Edit Quote</a>
<?php

}

if($desig=="11" && $service=='2' && $dept=='4' && ($row[8]=='1' || $row[8]=='11'))
{

?>
<input type="button" onClick="showrem('showrem<?php echo $count; ?>')" value="Update" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none">
<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','2')" value="Go" style="background:#FFFF99">&nbsp;&nbsp;&nbsp;
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99">
</div>

<!--<a href="viewquoteformat.php?quotid=<?php echo $row[0] ?>" target="_blank">Mailing Format</a>--><br />
<a href="Editquote.php?quotid=<?php echo $row[0] ?>&st=2"> Edit Quote</a>
<?php
}
if($desig=="11" && $service=='3' && $dept=='4' && $row[8]=='1')
{

?>
<input type="button" onClick="showrem('showrem<?php echo $count; ?>')" value="Update" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none">
<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','11')" value="Go" style="background:#FFFF99">&nbsp;&nbsp;&nbsp;
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99">
</div>

<!--<a href="viewquoteformat.php?quotid=<?php echo $row[0] ?>" target="_blank">Mailing Format</a>--><br />
<a href="Editquote.php?quotid=<?php echo $row[0] ?>&st=11"> Edit Quote</a>
<?php
}

if($desig=="10" && $service=='3' && $dept=='4' && $row[8]=='1')
{
?>
<input type="button" onClick="showrem('showrem<?php echo $count; ?>')" value="Approve" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none">
<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','2')" value="Go" style="background:#FFFF99">&nbsp;&nbsp;&nbsp;
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99">
</div>
<?php
}
/*if($desig=="8" && $service=='2' && $dept=='4' && $row[8]=='2')
{
?>
<!--<input type="button" onClick="showrem('showrem<?php echo $count; ?>')" value="Approve" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none">
<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','2')" value="Go" style="background:#FFFF99">

</div>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99">-->
<a href="quotcreation.php?quotid=<?php echo $row[0] ?>" target="_blank"> Create Quote</a>
<?php
}*/
if($desig=="8"  && ($service=='2' || $service=='3') && $dept=='4' && ($row[8]=='1' || $row[8]=='20' || $row[8]=='2'|| $row[8]=='11'))
{
//echo $row[15]." ".$row[14];
?>
<input type="button" onClick="showrem('showrem<?php echo $count; ?>')" value="Approve" style="background:#FFFF99" <?php if($row[15]=='R&M' && $row[14]=='0000-00-00'){ ?> disabled <?php } ?> />
<div id="showrem<?php echo $count; ?>" style="display:none">
<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','<?php if($row[12]>0){ echo "3"; }else{ echo "8"; } ?>')" value="Go" style="background:#FFFF99" <?php if($row[15]=='R&M' && $row[14]=='0000-00-00'){ ?> disabled <?php } ?>>&nbsp;&nbsp;&nbsp;
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99" <?php if($row[15]=='R&M' && $row[14]=='0000-00-00'){ ?> disabled <?php } ?>>
</div>

<a href="viewquoteformat.php?quotid=<?php echo $row[0] ?>" target="_blank">Mailing Format</a><br />
<a href="Editquote.php?quotid=<?php echo $row[0] ?>&st=20" target="_blank"> Edit Quote</a>
<?php
}
if($desig=="8" && $service=='1' && $dept=='4' && $row[8]=='3')
{
?>
<input type="button" onClick="showrem('showrem<?php echo $count; ?>')" value="Approve" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none">
<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','<?php if($row[12]>0){ echo "4"; }else{ echo "8"; } ?>')" value="Go" style="background:#FFFF99">&nbsp;&nbsp;&nbsp;
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99">
</div>
<?php
}
if($row[8]=='8' && $row[16]>0 && $desig=='8')
{
?>
<div id="bill<?php echo $row[0]; ?>"><input type="button" onclick="sendtobill('<?php echo $row[0] ?>');" value="Send for Billing"></div>


<?php
}

$count=$count+1;
}
}
?></td></tr></div></div></table>
<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php
}
if($Prev_Page) 
{
	echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page','perpg')\"> << Back</a> ";
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
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\">Next >></a> ";
}
?>