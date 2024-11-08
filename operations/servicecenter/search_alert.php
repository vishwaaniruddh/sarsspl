<?php
//include('config.php');
############# must create your db base connection
//echo "hhj";
//$strPage = $_REQUEST['Page'];
//if($_REQUEST['mode']=="Listing"){

	
$id="";
$cid="";
$bank="";
$city="";
$area="";
//$br="Mumbai";


if(isset($_POST['id']))
$id=$_POST['id'];
if(isset($_POST['cid']))
$cid=$_POST['cid']; 
if(isset($_POST['bank']))
$bank=$_REQUEST['bank'];
if(isset($_POST['area']))
$area=$_REQUEST['area'];
//if(isset($_POST['br']))
//$br=$_REQUEST['br']; 
$br=$_GET['br'];
$str="";

//$table=mysql_query("select * from alert where city='$br'");
include_once('class_files/generic_filter.php');
$filter= new generic_filter();
$table=$filter->filter('localhost','site','site','atm_site',"alert",array("cust_id","atm_id","bank_name","area","city"),array($cid,$id,$bank,$area,$br));
//$table=$filter->filter($id,$cid,$bank,$area,$pin,$city,$state,$sdate,$edate);
/*include_once('class_files/table_formation.php');

$form=new table_formation();
$form->table_forming(array("","","","","","","","","","",""),$table,"n");*/

$str.='<table border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;"> ';

$str.='
<th width="77">Name</th>
<th width="75">ATM</th>
<th width="125">Bank</th>
<th width="75">City</th>
<th width="75">Area</th>
<th width="75">Problem</th>
<th width="75">Alert Date</th>
<th width="75">Caller Name</th>
<th width="75">Caller Phone</th>
<th width="75">Caller Email</th>
<th width="45">Status</th>';


// Insert a new row in the table for each person returned

while($row= mysql_fetch_row($table))
{
	
$str.='<tr>

<td width="77">'.$row[1].'</td>
<td width="125">'.$row[2].'</td>
<td width="75">'.$row[3].'</td>
<td width="75">'.$row[6].'</td>
<td width="75">'.$row[4].'</td>
<td width="75">'.$row[9].'</td>
<td width="75">';
if(isset($row[11]) and $row[11]!='0000-00-00') $str.=date('d/m/Y',strtotime($row[11]));
$str.='</td>
<td width="75">'.$row[12].'</td>
<td width="75">'.$row[13].'</td>
<td width="75">'.$row[14].'</td>
<td>';
if($row[15]=="Pending") { 
$str.=$row[15].'<input type="button" value="Delegate" onclick="javascript:location.href=delegate.php?req=$row[0]&city=$row[6]&atm=$row[2]"/>';
 } else 
 $str.=$row[15].'</td>
</tr>';

}

$str.='</table>';
echo $str;
?>

