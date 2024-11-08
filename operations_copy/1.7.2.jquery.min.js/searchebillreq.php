<?php
session_start();
//echo $_SESSION['user'];
$desig= $_POST['desig'];
$service=$_POST['service'];
 $dept=$_POST['dept'];

include('config.php');

$cid="";

$sdate="";
$edate="";

	$strPage = $_REQUEST['Page'];
	
	$sql="Select q.req_no,q.reqby,q.cust_id,q.trackerid,q.supervisor,s.bank,s.atmsite_address,q.entrydate,l.username,q.entrydate,q.status,q.approvalform,s.atm_id1 from ebillfundrequests q,".$_POST['cid']."_sites s,login l where q.cust_id='".$_POST['cid']."' and l.srno=q.quotby and q.trackerid=s.trackerid";
	
	if(isset($_POST['pstat']) && $_POST['pstat']!='')
	$sql.=" and q.status='".$_POST['pstat']."'";
	else
	$sql.=" and q.status<>'8'";

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

if($desig=="11" && $service=='3' && $dept=='4')
{
$qr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
$qrro=mysqli_fetch_row($qr);
//$sql.=" and requestby='".$qrro[0]."'";
$sql.=" and q.quotby='".$qrro[0]."'";
}

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
$sql.=" order by q.status ASC LIMIT $Page_Start , $Per_Page";
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
<th width="75">Department</th>
<th width="75">Atm ID</th>
<th width="75">Address</th>
<th width="75">Bank</th>
<th width="75">Memo</th>
<th width="75">Date</th>
<!--<th width="75">Amount</th>-->
<th width="75">Last Approval Details</th>

<th width="75">Approval</th>
<?php
// Insert a new row in the table for each person returned
if(mysqli_num_rows($table)>0) {
$count=0;
while($row= mysqli_fetch_row($table))
{
//echo "dept=".$dept;
//$count=$count+1;
//echo "select short_name,contact_first from contacts where short_name='$row[2]'";
$qry1=mysqli_query($con,"select short_name,contact_first from contacts where short_name='$row[2]'");
$qrrow=mysqli_fetch_array($qry1);

$branch=mysqli_query($con,"select username from login where srno='".$row[6]."'");
$brro=mysqli_fetch_row($branch);
$deptde=mysqli_query($con,"select `desc` from department where deptid='2'");
$dtro=mysqli_fetch_row($deptde);
//$crow=mysqli_fetch_row($qry1);	

?><div class=article>
<div class=title><tr>
<td width="75"><?php echo $count+1; ?></td>
<td width="75"><?php echo $row[8]; //echo $row[6]; ?></td>
<td width="75"><?php echo $dtro[0]; ?></td>
<td width="75"><?php echo $row[12]; //echo $row[6]; ?></td>
<td width="75"><?php echo $row[6]; //echo $row[6]; ?></td>
<td width="75"><?php echo $qrrow[1]; ?></td>
<td width="75"><?php echo $row[4]; ?></td>
<td width="75"><?php echo date("d/m/Y h:i:s a",strtotime($row[9])); ?></td>
<!--<td width="75"><?php echo $row[1]; ?></td>-->
<td>
<?php
//echo "select appid,appby,apptime,level,remarks from fundrequestapproval where reqid='".$row[0]."' order by appid DESC limit 1";
$lst=mysqli_query($con,"select appid,appby,apptime,level,remarks from ebillfundapp where reqid='".$row[0]."' order by appid DESC limit 1");
while($lstro=mysqli_fetch_array($lst))
{
if($lstro[3]=='0')
$stat="Rejected";
else
$stat="Approved";
echo $lstro[1]."<br> ".date("d/m/Y h:i:s a",strtotime($lstro[2]))." <br>".$stat."<br> ".$lstro[4];
}
?><br /><br />
<!--<a href="download.php?filename=<?php echo $row[11]; ?>" class="links">Click to dowload approval Form</a>-->
<!--<a href="#" onClick="newwin('viewfeed.php?id=<?php echo $row[0]; ?>','display')">Click to dowload approval Form</a>--><br />
<a href="#" onClick="newwin('viewquoteformat.php?quotid=<?php echo $row[0]; ?>','display')">Click to view Quotation</a>
</td>


<td id="app<?php echo $count; ?>">
<?php 
if($row[8]=='8')
echo "Amount Paid: Rs. ".$row[2];
//echo "desig=".$desig." ".$service." ".$dept." ".$row[10];
if($desig=="10" && $service=='3' && $dept=='4' && $row[10]=='1')
{
?>
<input type="button" onClick="showrem('showrem<?php echo $count; ?>')" value="Approve" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none">
<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','2')" value="Go" style="background:#FFFF99">

</div>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99"><?php
}
if($desig=="8" && $service=='2' && $dept=='4' && $row[10]=='2')
{
?>
<!--<input type="button" onClick="showrem('showrem<?php echo $count; ?>')" value="Approve" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none">
<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','3')" value="Go" style="background:#FFFF99">

</div>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99">-->
<a href="quotcreation.php?quotid=<?php echo $row[0] ?>"> Create Quote</a>
<?php
}
if($desig=="8" && $service=='2' && $dept=='4' && $row[10]=='20')
{
?>
<!--<input type="button" onClick="showrem('showrem<?php echo $count; ?>')" value="Approve" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none">
<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','3')" value="Go" style="background:#FFFF99">

</div>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99">-->
<a href="viewquoteformat.php?quotid=<?php echo $row[0] ?>" target="_blank">Mailing Format</a><br />
<a href="Editquote.php?quotid=<?php echo $row[0] ?>"> Edit Quote</a>
<?php
}
if($desig=="8" && $service=='1' && $dept=='4' && $row[10]=='3')
{
?>
<input type="button" onClick="showrem('showrem<?php echo $count; ?>')" value="Approve" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none">
<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','4')" value="Go" style="background:#FFFF99">

</div>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99"><?php
}

 $count=$count+1;

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