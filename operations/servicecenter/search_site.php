<?php
include('config.php');
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

if(isset($_POST['id']))
$id=$_POST['id'];
if(isset($_POST['cid']))
$cid=$_POST['cid']; 
if(isset($_POST['bank']))
$bank=$_REQUEST['bank'];
if(isset($_POST['area']))
$area=$_REQUEST['area'];
if(isset($_POST['city']))
$city=$_REQUEST['city'];
if(isset($_POST['state']))
$state=$_REQUEST['state'];
if(isset($_POST['pin']))
$pin=$_REQUEST['pin'];
if(isset($_POST['sdate']))
$sdate=$_REQUEST['sdate'];
if(isset($_POST['edate']))
$edate=$_REQUEST['edate'];

//$table=mysql_query("select * from atm");

$str="";
include_once('class_files/filter_new.php');
$filter=new filter_new();
$table=$filter->filter($id,$cid,$bank,$area,$pin,$city,$state,$sdate,$edate);
/*include_once('class_files/table_formation.php');
$form=new table_formation();
$form->table_forming(array("","","","","",""),$table,"n");*/


$str.='<table border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;"> ';

$str.='
<th width="77">Customer</th>
<th width="125">Bank</th>
<th width="75">Area</th>
<th width="75">City</th>
<th width="75">State</th>
<th width="75">Pincode</th>
<th width="75">ATM</th>
<th width="75">Start Date</th>
<th width="45">Edit</th>
<th width="50">Delete</th>';


// Insert a new row in the table for each person returned

while($row= mysql_fetch_row($table))
{
	

$str.='<tr>

<td width="77">'.$row[2].'</td>
<td width="125">'.$row[3].'</td>
<td width="75">'.$row[4].'</td>
<td width="75">'.$row[6].'</td>
<td width="75">'.$row[7].'</td>
<td width="75">'.$row[5].'</td>
<td width="75">'.$row[1].'</td>
<td width="75">';
if(isset($row[8]) and $row[8]!='0000-00-00') $str.=date('d/m/Y',strtotime($row[8]));
$str.='</td>
<td width="45" height="31"> <a href="edit_site.php?id='.$row[0].'"> Edit </a></td>
<td width="50" height="31">  <a href="javascript:confirm_delete('.$row[0].');"> Delete </a></td>
</tr>';


}

$str.='</table>';
echo $str;
?>

