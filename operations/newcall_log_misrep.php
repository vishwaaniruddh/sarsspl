<?php
include("access.php");
include('config.php');
session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry, your session has Expired'); window.location='index.php';</script>";
}
else
{
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="popup.css"  rel="stylesheet" type="text/css">
<script src="popup.js" type="text/jscript" language="javascript"> </script>
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

function showupdiv(id)
{
//alert(id);
var count= id.replace( /^\D+/g, '').trim();
//alert(count);
document.getElementById("updiv"+count).style.display = 'block';



}

function showcldiv(id)
{
//alert(id);
var count= id.replace( /^\D+/g, '').trim();
//alert(count);
document.getElementById("closecalldiv"+count).style.display = 'block';



}

function showstdiv(id)
{
//alert(id);
var count= id.replace( /^\D+/g, '').trim();
//alert(count);
document.getElementById("stndbydiv"+count).style.display = 'block';



}

function hidediv(id)
{
//alert(id);
//var count= id.replace( /^\D+/g, '').trim();
//alert(count);
document.getElementById(id).style.display = 'none';



}
function callupdfunc(id)
{
var counts= id.replace( /^\D+/g, '').trim();
var updrem=document.getElementById("updrem"+counts).value;
var alertid=document.getElementById("alid"+counts).value;
if(updrem=="")
{

alert("please enter remark")
}
else
{
var conf=confirm('Do you really want to update?');

if(conf==true)
{

$.ajax({
   type: 'POST',    
url:'process_newcall_update.php',
data:'alid='+alertid+'&updrem='+updrem,
beforeSend: function()
                   {
        document.getElementById("updcall"+counts).disabled=true;
          document.getElementById("updb"+counts).disabled=true;         
                  },
success: function(msg){
alert(msg);
if(msg=='error')
{
document.getElementById("updcall"+counts).disabled=false;
          document.getElementById("updb"+counts).disabled=false;
}
else
{
document.getElementById("updiv"+counts).style.display = 'none';
document.getElementById("updcall"+counts).value="Updated";
}


 }
     });

}

}

}




function standbyfunc(id)
{
var counts= id.replace( /^\D+/g, '').trim();
var stndbyrem=document.getElementById("stndbyrem"+counts).value;
var alertid=document.getElementById("alid"+counts).value;
if(stndbyrem=="")
{

alert("please enter remark")
}
else
{
var conf=confirm('Do you really want to update?');

if(conf==true)
{

$.ajax({
   type: 'POST',    
url:'process_newcall_standby.php',
data:'alid='+alertid+'&strem='+stndbyrem,
beforeSend: function()
                   {
        document.getElementById("stndby"+counts).disabled=true;
          document.getElementById("stndbyb"+counts).disabled=true;         
                  },
success: function(msg){
alert(msg);
if(msg=='error')
{
document.getElementById("stndby"+counts).disabled=false;
          document.getElementById("stndbyb"+counts).disabled=false;
}
else
{
document.getElementById("stndbydiv"+counts).style.display = 'none';
document.getElementById("stndby"+counts).value="standby done";
}


 }
     });

}

}

}






function closecallfunc(id)
{
var counts= id.replace( /^\D+/g, '').trim();
var closecallrem=document.getElementById("closecallrem"+counts).value;
var alertid=document.getElementById("alid"+counts).value;
if(closecallrem=="")
{

alert("please enter remark")
}
else
{
var conf=confirm('Do you really want to close?');

if(conf==true)
{

var fd=new FormData($('#frmup')[0]);
	//lert(fd);

fd.append('alid',alertid);
fd.append('clrem',closecallrem);
fd.append('cnt',counts);

$.ajax({
   type: 'POST',    
url:'process_newcall_close.php',
contentType: false,
            cache: false,
            processData:false,
data:fd,
beforeSend: function()
                   {
        document.getElementById("closecall"+counts).disabled=true;
          document.getElementById("closecallb"+counts).disabled=true;         
                  },
success: function(msg){
alert(msg);
if(msg=='error')
{
document.getElementById("closecall"+counts).disabled=false;
          document.getElementById("closecall"+counts).disabled=false;
}
else
{
document.getElementById("closecalldiv"+counts).style.display = 'none';
document.getElementById("closecall"+counts).value="Closed";
}


 }
     });

}

}

}






function func(strpg,perpg)
{

var calltype=document.getElementById('calltype').value;
var atm=document.getElementById('atmid').value;
var bank=document.getElementById('bank').value;
var area=document.getElementById('area').value;
var sdate=document.getElementById('sdate').value;
var edate=document.getElementById('edate').value;


//alert(calltype);

if(perpg=="")
{
perp='50';
}
else
{
perp=document.getElementById(perpg).value;
}



var Page="";
if(strpg!="")
{
Page=strpg;
}






//alert(accname);

//alert(atm);
$.ajax({
   type: 'POST',    
url:'search_newcallalert.php',
 beforeSend: function()
                   {
        
                  document.getElementById("search").innerHTML ="<center><img src=loader.gif></center>";
                  },
data:'atm='+atm+'&bank='+bank+'&perpg='+perp+'&Page='+Page+'&area='+area+'&sdate='+sdate+'&edate='+edate+'&calltype='+calltype,
success: function(msg){

//alert(msg);
  document.getElementById('search').innerHTML=msg;



     lcalc();
 
         }
     });





}

</script>
</head>

<body onLoad="func('','');">
<form id="frmup" name="frmup" enctype="multipart/form-data" method="post" >

<div style="height:30px;">

<input type="hidden" name="br" id="br" value="<?php echo $_SESSION['branch']; ?>"/>
<input type="hidden" name="dept" id="dept" value="<?php echo $_SESSION['dept']; ?>"/>
<input type="hidden" name="service" id="service" value="<?php echo $_SESSION['serviceauth']; ?>"/>
<input type="hidden" name="desig" id="desig" value="<?php echo $_SESSION['designation']; ?>"/>
<center>
<?php include("menubar.php");
//echo $_SESSION['branch'];
 ?>

<h2>MIS Report</h2>
 <button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>
	<br />
<table cellpadding="" cellspacing="0" >
  <tr>
    <th width="77" colspan="5"><select name="calltype" id="calltype" >
     <option value="">All Calls</option>
      <option value="0">Open call</option>
      <option value="1">Closed call</option>
      <!--<option value="10">Call On Hold</option>-->
      <option value="10">Standby</option>
      
    </select></th>
    <th width="77"><?php
    $sql="Select short_name,contact_first from contacts where type='c' ";
if($_SESSION['custid']!='all')
{
$custo=str_replace(",","','",$_SESSION['custid']);
$custo="'".$custo."'";
$sql.=" and short_name in ($custo)";
}
$qry=mysqli_query($con,$sql);

 ?>
 <select  name="cid" id="cid" onchange="searchById('Listing','1','');">
<option value="">Select Client</option>
<?php
while($clro=mysqli_fetch_row($qry))
{
?>
<option value="<?php echo $clro[0]; ?>" <?php if($_SESSION['custid']==$clro[0]){ echo "selected"; } ?>><?php echo $clro[1]; ?></option>
<?php
}
?>
</select>
    </th>
    <th width="75"><select name="brnch" id="brnch" onchange="searchById('Listing','1','');"><option value="-1">All</option>
    <?php
    $brn="select location from cssbranch where 1 ";
    if($_SESSION['branch']!='all' && $_SESSION['branch']!='All')
    $brn.=" and id in (".$_SESSION['branch'].")";
    
    $brn.=" order by location ASC";
    $br=mysqli_query($con,$brn);
    while($brro=mysqli_fetch_array($br))
    { ?>
    <option value="<?php echo $brro[0]; ?>"><?php echo $brro[0]; ?></option><?php }
    ?>
    </select></th>
    <th width="75"><input type="text" name="atmid" id="atmid" onkeyup="searchById('Listing','1','');" placeholder="ATM"/></th>
    <th width="75"><input type="text" name="bank" id="bank" onkeyup="searchById('Listing','1','');" placeholder="Bank"/></th>
    <th width="75"><input type="text" name="area" id="area" onkeyup="searchById('Listing','1','');" placeholder="Address"/></th>
      <th width="75"><input type="text" name="sdate" id="sdate" onclick="displayDatePicker('sdate');" readonly="readonly" placeholder="From Date"/></th>
<th width="75"><input type="text" name="edate" id="edate"  onclick="displayDatePicker('edate');" readonly="readonly" placeholder="To Date"/></th>
    <th width="75"><input type="button" onclick="func('','');" class="readbutton" value="Search" style="width:120px;"/></th>
  
  </tr>
  <tr>
    
  </tr>
</table>
</center>
</div>

<center>
<div id="search" style="padding-top:-100px"></div>


</center>

<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</form>
</body>
</html>
<?php } ?>