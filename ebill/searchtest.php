<?php
include("config.php");
include("access.php");

//echo "ok";
$atm=$_GET['atms'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script type="text/javascript">

var tableToExcel = (function() {
//alert("hii");
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script>
<script>

function vdtefunc(qid,ct)
{

if(ct=="Fidility")
{

window.open('viewfisquotdetails.php?qid='+qid,'_blank');
}
else if(ct=="Tata")
{

window.open('viewtataquotdetails.php?qid='+qid,'_blank');
}
else
{

 window.open('viewquotdetails.php?qid='+qid,'_blank');
  } 



}


</script>
</head>
<body >
<center>
<?php  include("menubar.php"); 






$qry=mysqli_query($con,"select * from quotation1 where atm='".$atm."' and status!='c'");
//echo "select * from quotation1 where atm='".$atm."'";
$ncnt=mysqli_num_rows($qry);
//echo $ncnt;

if($ncnt>0)
{
?>
<table border='2'> 
<th>srno</th>
<th>status</th>
<th>qid</th>
<th>quotationid</th>
<th>Amount</th>
<th>Transferred Amount</th>
<th>Transferred Date</th>


<?php
$srn='1';
while($rws=mysqli_fetch_array($qry))
{

$samt=mysqli_query($con,"select sum(Total) from quotation_details where qid='".$rws[0]."'");
$sumamtrw=mysqli_fetch_array($samt);


$sts="";
if($rws[18]==0)
{

$sts="Pending";
}
if($rws[18]==1)
{

$sts="Fund Processing";
}
if($rws[18]==2)
{

$sts="Transferred";
}

if($rws[18]==100)
{

$sts="Archieved";
}

if($rws[18]==10)
{

$sts="Rejected";
}



$tramtrws="";
if($rws[18]==2)
{

$tramt=mysqli_query($con,"select tamount,pdate from quotation1ftransfers where qid='".$rws[0]."'");
$tramtrws=mysqli_fetch_array($tramt);
}


?>
<tr>
<td><?php echo $srn;?></td>
<td><?php echo $sts;?></td>

<td><?php echo $rws[0];?></td>
<td><?php echo $rws[1];?></td>



<td><?php echo round($sumamtrw[0]);?></td>



<td><?php echo round($tramtrws[0]);?></td>



<td><?php if($tramtrws[1]!="") { echo date('d-m-Y',strtotime($tramtrws[1]));  }?></td>



<td  align="center"> <input type="button" name="vdet" id="vdet<?php echo $srno?>" value="View" onclick="vdtefunc('<?php echo $rws[0];?>','<?php echo $rws[2];?>');"></td>
</tr>

<?php
$srn++;
}
?>



</table>
<?php
}
?>
</center>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>