<script>
function payments()
  { //alert("ddd");
   
  // window.open("showpay.php?app=","MsgWindow","width=900,height=600");
  }
</script>
<?php
session_start();
//echo $_SESSION['user'];
$desig='6'; //$_POST['desig'];
$service='1'; //$_POST['service'];
 $dept='5'; //$_POST['dept'];
$_POST['cid']='Tata05';
include('config.php');

$cid="";

$sdate="";
$edate="";

	$strPage = $_REQUEST['Page'];
	
	$sql="Select * from ebillfundrequests where cust_id='".$_POST['cid']."'";
	
	if(isset($_POST['pstat']) && $_POST['pstat']!='')
	$sql.=" and reqstatus='".$_POST['pstat']."'";
	else
	$sql.=" and reqstatus<>'8'";
	if(isset($_POST['atm']) && $_POST['atm']!='')
	$sql.=" and atmid LIKE'%".$_POST['atm']."%'";

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
$sql.=" and entrydate between STR_TO_DATE('".$_POST['sdate']."','%d/%m/%Y') and STR_TO_DATE('".$_POST['edate']."','%d/%m/%Y')";
else
$sql.=" and entrydate='".$sdate."'";
}

if($desig=="11" && $service=='3' && $dept=='4')
{
$qr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
$qrro=mysqli_fetch_row($qr);
$sql.=" and reqby='".$qrro[0]."'";
}


$table=mysqli_query($con,$sql);

$Num_Rows = mysqli_num_rows ($table);
 
// pagins
?>
 <div align="center">Total Records: <b><?php echo $Num_Rows; ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
$Per_Page =50; //$_POST['perpg'];   // Records Per Page
 
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
$sql.=" order by req_no DESC LIMIT $Page_Start , $Per_Page";
echo $sql;
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
<form action="showpay.php" method="post" >
<table width="995" border="1" cellpadding="2" cellspacing="0"  id="custtable" style="margin-top:5px;"> 


<th width="75">Sr NO</th>
<th width="75">Requesting Person</th>
<th width="75">ATM ID</th>
<th width="75">Bank</th>
<th width="75px">Address</th>
<th width="75">Bill Date</th>
<th width="75">Due Date</th>
<th width="75">From</th>
<th width="75">To</th>
<th width="75">Units</th>
<th width="75">Amount</th>
<th width="75">Priority</th>
<th width="75">Supervisor</th>
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
$qry1=mysqli_query($con,"select bank,atmsite_address from ".$row[12]."_sites where trackerid='".$row[14]."'");
$qrrow=mysqli_fetch_array($qry1);

$branch=mysqli_query($con,"select username from login where srno='".$row[13]."'");
$brro=mysqli_fetch_row($branch);
//$deptde=mysqli_query($con,"select `desc` from department where deptid='2'");
//$dtro=mysqli_fetch_row($deptde);
//$crow=mysqli_fetch_row($qry1);	

?><div class=article>
<div class=title><tr>
<td width="75"><?php echo $count+1; ?></td>
<td width="75"><?php echo $brro[0]; //echo $row[6]; ?></td>
<td width="75"><?php echo $row[1]; ?></td>
<td width="75"><?php echo $qrrow[0]; ?></td>
<td width="75"><?php echo $qrrow[1]; ?></td>
<td width="75"><?php if($row[2]!='0000-00-00'){ echo date('d/m/Y',strtotime($row[2])); }else{ echo "NA"; } ?></td>
<td width="75"><?php if($row[9]!='0000-00-00'){ echo date('d/m/Y',strtotime($row[9])); }else{ echo "NA"; }// echo $row[9]; ?></td>
<td width="75"><?php if($row[6]!='0000-00-00'){ echo date('d/m/Y',strtotime($row[6])); }else{ echo "NA"; }//echo $row[6]; ?></td>
<td width="75"><?php if($row[7]!='0000-00-00'){ echo date('d/m/Y',strtotime($row[7])); }else{ echo "NA"; } //echo $row[7]; ?></td>
<td width="75"><?php echo $row[3]; ?></td>
<td width="75"><?php echo $row[4]; ?></td>
<td width="75"><?php echo $row[23]; ?></td>
<td width="75"><?php echo $row[8]; ?></td>
<!-- <td width="75"><?php echo date("d/m/Y h:i:s a",strtotime($row[10])); ?></td>
<td width="75"><?php echo $row[1]; ?></td>-->
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
<a href="#" onclick="newwin('viewefeed.php?id=<?php echo $row[0]; ?>','display')">Click to view all Feedbacks</a>
</td>


<td id="app<?php echo $count; ?>">
<?php 
if($row[15]=='8')
echo "Amount Paid: Rs. ".$row[16];
//echo "desig=".$desig." ".$service." ".$dept." ".$row[8];
if($desig=="7" && $service=='1' && $dept=='2' && $row[15]=='4')
{
?>
<input type="button" onclick="showrem('showrem<?php echo $count; ?>')" value="Approve" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none">
<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','5')" value="Go" style="background:#FFFF99">

</div>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99"><?php
}
if($desig=="6" && $service=='1' && $dept=='5' && $row[15]=='5')
{
?>
<input type="button" onclick="showrem('showrem<?php echo $count; ?>')" value="Approve" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none">
<input type="text" name="appamt<?php echo $count; ?>" id="appamt<?php echo $count; ?>" value="<?php echo $row[4]; ?>">
<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="financeapprove('<?php echo $count; ?>','<?php echo $row[0] ?>','6')" value="Go" style="background:#FFFF99">

</div>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99"><?php
}
if($desig=="1" && $service=='1' && $dept=='1' && $row[15]=='6')
{
?>
<input type="button" onclick="showrem('showrem<?php echo $count; ?>')" value="Approve" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none">
<input type="text" name="appamt<?php echo $count; ?>" id="appamt<?php echo $count; ?>" value="<?php echo $row[4]; ?>">

<textarea id="rem<?php echo $count; ?>"></textarea>
<input type="button" onClick="financeapprove('<?php echo $count; ?>','<?php echo $row[0] ?>','7')" value="Go" style="background:#FFFF99">

</div>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99"><?php
}
if($desig=="6" && $service=='1' && $dept=='5' && $row[15]=='7')
{
?>
<input type="checkbox" name="apps[]" value="<?php echo $row[0]; ?>" style="background:#FFFF99" />
<!--<input type="button" onclick="showrem('showrem<?php echo $count; ?>')" value="Approve" style="background:#FFFF99" />
<div id="showrem<?php echo $count; ?>" style="display:none">
<input type="text" name="appamt<?php echo $count; ?>" id="appamt<?php echo $count; ?>" value="<?php echo $row[16]; ?>" readonly><br>
<input type="text" name="chkno<?php echo $count; ?>" id="chkno<?php echo $count; ?>" placeholder="Cheque No"><br>
<textarea id="rem<?php echo $count; ?>"></textarea><br>
<input type="button" onClick="financepayment('<?php echo $count; ?>','<?php echo $row[0] ?>','8')" value="Go" style="background:#FFFF99">

</div>
<input type="button" onClick="approve('<?php echo $count; ?>','<?php echo $row[0] ?>','0')" value="Reject" style="background:#FFFF99">
-->
<?php
}
if($desig=="6" && $service=='1' && $dept=='5' && $row[17]!='0'){
echo "<br> Cheque No : ".$row[17];

}
$count=$count+1;

}
?></td></tr>.</div></div>
<tr><td colspan=15 align='center' ><input type="submit" value="Payments" /></td></tr>
</table></form>
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