<!--<link href="myfunction/style.css" rel="stylesheet" type="text/css">-->
<?php
//session_start();
include('config.php');
//require("myfunction/function.php");
############# must create your db base connection
//echo "hhj";
//$strPage = $_REQUEST['Page'];
//if($_REQUEST['mode']=="Listing"){
$id="";
$cid="";
$bank="";
$city="";
$area="";
$state="";
$pin="";
$sdate="";
$edate="";
//echo $_SESSION['designation'];
//paging
/*$page=1;//Default page
$limit=10;//Records per page
$start=0;//starts displaying records from 0
if(isset($_GET['page']) && $_GET['page']!=''){
	$page=$_GET['page'];
}
	$start=($page-1)*$limit;*/
	//end paging
	$strPage = $_REQUEST['Page'];
	//echo $_POST['sdate'];
	$sql="Select s.atm_id1,s.atmsite_address,s.bank,s.location,s.city,s.state,s.takeover_date,t.fromcid,t.to,t.handoverdt,t.takeoverdt,t.handoverform,t.takeoverform,t.remarks,t.transferid,t.status from ".$_POST['cid']."_sites s,transfer_req t where (t.status='0' or t.status='1' or t.status='2') and s.active=0 and t.fromcid='".$_POST['cid']."' and t.atmid=s.atm_id1";
if(isset($_POST['id']) && $_POST['id']!='')
{
$id=$_POST['id'];
$sql.=" and s.atm_id1 LIKE '%".$id."%'";
}
	
if(isset($_POST['bank']) && $_POST['bank']!='')
{
$bank=$_REQUEST['bank'];
$sql.=" and s.bank LIKE '%".$bank."%'";
}
if(isset($_POST['area']) && $_POST['area']!='')
{
$area=$_REQUEST['area'];
$sql.=" and s.location LIKE '%".$area."%'";
}
if(isset($_POST['city']) && $_POST['city']!='')
{
$city=$_REQUEST['city'];
$sql.=" and s.city LIKE '%".$city."%'";
}
if(isset($_POST['state']) && $_POST['state']!='')
{
$state=$_REQUEST['state'];
$sql.=" and s.state LIKE '%".$state."%'";
}
if(isset($_POST['pin']) && $_POST['pin']!='')
{
$pin=$_REQUEST['pin'];
$sql.=" and s.atmsite_address LIKE '%".$pin."%'";
}
if(isset($_POST['sdate']) && $_POST['sdate']!='' && isset($_POST['edate']) && $_POST['edate']!='')
{
 $sdate=$_REQUEST['sdate'];
$sdate2=str_replace("/","-",$sdate);
//echo $sdate2;
$sql.=" and t.entrydt between STR_TO_DATE('".$_POST['sdate']."','%d/%m/%Y') and STR_TO_DATE('".$_POST['edate']."','%d/%m/%Y')";
}


//$table=mysqli_query($con,"select * from atm");

$table=mysqli_query($con,$sql);

$Num_Rows = mysqli_num_rows ($table);
 
########### pagins
?>
 <div align="center">
 Records Per Page :<select name="perpg" id="perpg" onchange="searchById('Listing','1','perpg');">
 
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
$sql.=" order by t.status ASC LIMIT $Page_Start , $Per_Page";
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
<table border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;"  id="custtable"> 


<th width="75">Transfer from</th>
<th width="75">ATM1</th>
<th width="75">Transfer To</th>
<th width="75">HandOver Date</th>
<th width="75">TakeOver Date</th>
<th width="75">Handover Form</th>
<th width="75">Takeover Form</th>
<th width="75">Remarks</th>
<th width="125">Bank</th>
<th width="75">Area</th>
<th width="75">City</th>
<th width="95">State</th>

<th width="70">Address</th>


<?php if($_POST['desig']=='3' && $row[15]!='2'){ ?><th width="45"></th><?php } ?></tr>
<!--
<th width="45">Edit</th>
<th width="50">Delete</th>-->

<?php
// Insert a new row in the table for each person returned
if(mysqli_num_rows($table)>0) {
$count=0;
while($row= mysqli_fetch_row($table))
{
	$to='';
	$from='';
	//echo "select short_name,contact_first from contacts where (short_name='$row[7]' or short_name='$row[8]')";
$qry1=mysqli_query($con,"select short_name,contact_first from contacts where (short_name='$row[7]' and short_name='$row[8]')");
while($qrrow=mysqli_fetch_array($qry1))
{
if($row[7]==$qrrow[0])
 $from=$qrrow[1];

if($row[8]==$qrrow[0])
 $to=$qrrow[1];
}
$s=0;
if($row[9]=='0000-00-00' || $row[10]=='0000-00-00' || $row[11]=='' || $row[12]=='')
$s=1;
//$crow=mysqli_fetch_row($qry1);	

?><div class=article>
<div class=title><tr <?php if($s==1){ ?> style="color:#FF0000" <?php } ?>>
<td width="75"><?php echo $row[7]; ?></td>
<td width="75"><?php echo $row[0]; ?></td>
<td width="75"><?php echo $row[8]; ?></td>
<td width="75"><?php echo $row[9]; ?></td>
<td width="75"><?php echo $row[10]; ?></td>
<td width="75"><?php echo $row[11]; ?></td>
<td width="75"><?php echo $row[12]; ?></td>
<td width="75"><?php echo $row[13]; ?></td>
<td width="75"><?php echo $row[2]; ?></td>
<td width="75"><?php echo $row[3]; ?></td>
<td width="75"><?php echo $row[4]; ?></td>
<td width="75"><?php echo $row[5]; ?></td>
<td width="75"><?php echo $row[1]; ?></td>
<?php 
//echo "desig ".$_SESSION['designation'];
// for account manager Edit option
if($_POST['desig']=='8' && $_POST['auth']=='2' && $_POST['dept']=='4' && $row[15]<'2'){ ?><td width="75" id="app<?php echo $count; ?>"><input type="button" onClick="window.open('edittransfersite.php?transid=<?php echo $row[14]; ?>')" value="Edit">
<?php  }

//for operation manager Approve Option
//echo $_POST['desig']." ".$row[15];
if($_POST['desig']=='8' && $_POST['auth']=='1' && $_POST['dept']=='4' && ($row[15]=='0' ||$row[15]=='1' || $row[15]=='2')){ ?><td width="75" id="app<?php echo $count; ?>"><input type="button" onClick="approvetransfer('<?php echo $count; ?>','<?php echo $row[14]; ?>','1')" value="Approve"></td>  <?php } ?>
</tr></div></div><?php
$count=$count+1;
}

?></table>
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
