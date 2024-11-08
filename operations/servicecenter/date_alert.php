<?php
//include('config.php');
############# must create your db base connection
//echo "hhj";
//$strPage = $_REQUEST['Page'];
//if($_REQUEST['mode']=="Listing"){

$adate1="";
$adate2="";
$br=$_GET['br'];

if(isset($_POST['adate1']))
$adate1=$_REQUEST['adate1'];
if(isset($_POST['adate2']))
$adate2=$_REQUEST['adate2']; 


$str="";

include_once('class_files/date_filter_on_login.php');
$fil=new date_range();
$table=$fil->date_filter('localhost','site','site','atm_site',"alert","alert_date",$adate1,$adate2,$br);

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

