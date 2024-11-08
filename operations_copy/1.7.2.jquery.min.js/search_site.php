<!--<link href="myfunction/style.css" rel="stylesheet" type="text/css">-->
<?php
//include('access.php');
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

	$sql="Select housekeeping,housekeeping_tkdt,housekeeping_hodt,caretaker,takeover_date,handover_date,maintenance,maintenance_tkdt,maintenance_hodt,ebill,bank,location,city,state,atmsite_address,atm_id1,takeover_date,projectid,atm_id2,trackerid,handover_date,id,cust_id from ".$_POST['cid']."_sites where active='Y'";
if(isset($_POST['id']) && $_POST['id']!='')
{
$id=$_POST['id'];
$sql.=" and atm_id1 LIKE '%".$id."%'";
}
	
if(isset($_POST['bank']) && $_POST['bank']!='')
{
$bank=$_REQUEST['bank'];
$sql.=" and bank LIKE '%".$bank."%'";
}
if(isset($_POST['area']) && $_POST['area']!='')
{
$area=$_REQUEST['area'];
$sql.=" and atmsite_address LIKE '%".$area."%'";
}
if(isset($_POST['city']) && $_POST['city']!='')
{
$city=$_REQUEST['city'];
$sql.=" and city LIKE '%".$city."%'";
}
if(isset($_POST['state']) && $_POST['state']!='')
{
$state=$_REQUEST['state'];
$sql.=" and state LIKE '%".$state."%'";
}
if(isset($_POST['pin']) && $_POST['pin']!='')
{
$pin=$_REQUEST['pin'];
$sql.=" and atmsite_address LIKE '%".$pin."%'";
}
if(isset($_POST['sdate']) && $_POST['sdate']!='')
{
 $sdate=$_REQUEST['sdate'];
$sdate2=str_replace("/","-",$sdate);
//echo $sdate2;
$sql.=" and takeover_date LIKE '%".date('Y-m-d',strtotime($sdate2))."%'";
}
if(isset($_POST['edate']) && $_POST['edate']!='')
{
$edate=$_REQUEST['edate'];
$edate2=str_replace("/","-",$edate);
$sql.=" and takeover_date LIKE '%".date('Y-m-d',strtotime($edate2))."%'";
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
$sql.=" order by takeover_date DESC LIMIT $Page_Start , $Per_Page";
//echo $sql;
$table=mysqli_query($con,$sql);
//include_once('class_files/filter_new.php');
//$filter=new filter_new();
//$table=$filter->filter($id,$cid,$bank,$area,$pin,$city,$state,$sdate,$edate);

/*include_once('class_files/table_formation.php');
$form=new table_formation();
$form->table_forming(array("","","","","",""),$table,"n");*/
include("config.php");
?>
<table border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;"  id="custtable"> 

<th width="75">ATM1</th>
<th width="75">ATM2</th>
<th width="77">HouseKeeping</th>
<th width="77">Takeover Date</th>
<th width="77">Handove Date</th>
<th width="77">Caretaker</th>
<th width="77">Takeover Date</th>
<th width="77">Handove Date</th>
<th width="77">Maintenance</th>
<th width="77">Takeover Date</th>
<th width="77">Handove Date</th>
<th width="77">Ebill</th>
<th width="77">Takeover Date</th>
<th width="77">Handove Date</th>
<th width="125">Bank</th>
<th width="75">Area</th>
<th width="75">City</th>
<th width="95">State</th>

<th width="70">Address</th>


<th width="45">Detail</th></tr>
<!--
<th width="45">Edit</th>
<th width="50">Delete</th>-->

<?php
// Insert a new row in the table for each person returned
if(mysqli_num_rows($table)>0) {
while($row= mysqli_fetch_row($table))
{
$hk=0;$ct=0;$mn=0;$eb=0;
//echo $row[2]." ".$row[5]." ".$row[8];
//housekeeping,housekeeping_tkdt,housekeeping_hodt,caretaker,takeover_date,handover_date,maintenance,maintenance_tkdt,maintenance_hodt,ebill
if($row[0]=='Y' && $row[2]=='0000-00-00')
{
$hk=1;
}
if($row[3]=='Y' && $row[5]=='0000-00-00')
{
$ct=1;
}
if($row[6]=='Y' && $row[8]=='0000-00-00')
{
$mn=1;
}
//echo "select takeoverdt,handoverdt from mastersites where cust_id='".$_POST['cid']."' and trackerid='".$row[19]."'";
$mst=mysqli_query($con,"select takeoverdt,handoverdt from mastersites where cust_id='".$_POST['cid']."' and trackerid='".$row[19]."'");
$mstro=mysqli_fetch_row($mst);
//echo mysqli_num_rows($mst);
if($row[9]=='Y' && mysqli_num_rows($mst)>0)
{
if($mstro[1]=='0000-00-00')
$eb=1;
}	
//$qry1=mysqli_query($con,"select * from customer where cust_id='$row[2]'");
//$crow=mysqli_fetch_row($qry1);	

?><div class=article>
<div class=title><tr>
<td width="75"><?php echo $row[15] ?></td>
<td width="75"><?php echo $row[18] ?></td>
<td width="77"><?php echo $row[0]; ?></td>
<td width="77"><?php if($row[0]=='Y' && $row[1]!='0000-00-00' && $row[1]!='null' && $row[1]!=''){ echo date('d/m/Y',strtotime($row[1])); } ?></td>
<td width="77"><?php  if($row[0]=='Y' && $row[2]!='0000-00-00' && $row[2]!='null' && $row[2]!=''){ echo date('d/m/Y',strtotime($row[2]));} ?></td>
<td width="77"><?php echo $row[3]; ?></td>
<td width="77"><?php  if($row[3]=='Y' && $row[4]!='0000-00-00' && $row[4]!='null' && $row[4]!=''){ echo date('d/m/Y',strtotime($row[4]));} ?></td>
<td width="77"><?php  if($row[3]=='Y' && $row[5]!='0000-00-00' && $row[5]!='null' && $row[5]!=''){ echo date('d/m/Y',strtotime($row[5]));} ?></td>
<td width="77"><?php echo $row[6]; ?></td>
<td width="77"><?php  if($row[6]=='Y' && $row[7]!='0000-00-00' && $row[7]!='null' && $row[7]!=''){ echo date('d/m/Y',strtotime($row[7]));} ?></td>
<td width="77"><?php  if($row[6]=='Y' && $row[8]!='0000-00-00' && $row[8]!='null' && $row[8]!=''){ echo date('d/m/Y',strtotime($row[8]));} ?></td>
<td width="77"><?php echo $row[9]; ?></td>
<td width="125"><?php if($row[9]=='Y'){  if($mstro[0]!='0000-00-00'){ echo date('d/m/Y',strtotime($mstro[0])); }else{   if($row[4]!='0000-00-00'){echo date('d/m/Y',strtotime($row[4]));} }} ?></td>
<td width="75"><?php if($row[9]=='Y'){  if($mstro[1]!='0000-00-00'){ echo date('d/m/Y',strtotime($mstro[1])); }else{  if($row[5]!='0000-00-00'){echo date('d/m/Y',strtotime($row[5]));} }}  ?></td>
<td width="125"><?php echo $row[10]; ?></td>
<td width="75"><?php echo $row[11]; ?></td>
<td width="75"><?php echo $row[12]; ?></td>
<td width="95"><?php echo $row[13]; ?></td>

<td width="70"><?php echo $row[14]; ?></td>


<td width="45" height="31"> 
<!--<a href="editsite.php?trackid=<?php echo $row[19]; ?>&id=<?php echo $row[22]; ?>&cid=<?php echo $row[22]; ?>&bid=<?php echo $row[10]; ?> ">EDIT</a>-->
<?php 
//echo $hk." ".$ct." ".$mn." ".$eb;
if($hk==1 || $ct==1 || $mn==1 || $eb==1){ ?>
<a href="transfersite.php?atmid=<?php echo $row[15]; ?>&cid=<?php echo $_POST['cid']; ?>&trackid=<?php echo $row[19]; ?>"> Transfer </a><br />

<a href="handoversite.php?atmid=<?php echo $row[15]; ?>&cid=<?php echo $_POST['cid']; ?>&trackid=<?php echo $row[19]; ?>"> Handover </a>
<?php  }else
{
?>
Takeover
<?php
} ?>

<!--<a href="detail_site.php?id=<?php echo $row[9]; ?>&cid=<?php echo $_POST['cid']; ?>" target="_blank"> Detail </a>&nbsp;&nbsp;
<a href="#" onClick="window.open('edit_site.php?id=<?php echo $row[9]; ?>&cid=<?php echo $_POST['cid']; ?>&type=<?php echo $_POST['cid']; ?>new','edit_site','width=700px,height=750,left=200,top=40')"> Edit </a>-->

</td>
<!--
<td width="45" height="31"> <a href="edit_site.php?id='.$row[0].'"> Edit </a></td>
<td width="50" height="31">  <a href="javascript:confirm_delete('.$row[0].');"> Delete </a></td>-->
</tr></div></div><?php
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