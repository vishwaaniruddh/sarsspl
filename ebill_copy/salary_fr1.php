<?php
include("access.php");
include("config.php");






$typf=$_GET['typf'];
$mnf=$_GET['mnf'];
$yf=$_GET['yf'];

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

function vhisfunc(hid)
{
window.open('viewsalhistory.php?hid='+hid,'_blank');
}


var payd=[];

var paymd=[];



function subfunc()
{

var mnth=document.getElementById('mnth').value;
var yr=document.getElementById('yr').value;
var typ=document.getElementById('typ').value;
var paym=[];
$("input[type='text'].enb").each(function(){

    paym.push($(this).val());
  
});

var paymain=[];
$("input[type='text'].enbl").each(function(){

    paymain.push($(this).val());
  
});




document.getElementById('ctsalid').value=payd;
document.getElementById('ctpay').value=paym;
document.getElementById('paymm').value=paymain;
var conf=confirm('Do you really want to Approve?');
    

if(conf==true)
{
return true;
/*
$.ajax({
   type: 'POST',    
url:'process_salary_fr.php',
data:'ctid='+payd+'&paymt='+paym,
 
success: function(msg){

alert(msg);
window.open('admin_salrep.php?typf='+typ+'&mnf='+mnth+'&yf='+yr,'_self');
 
         },
        error: function (request, status, error) {
        alert(request.responseText);
    }
     });

*/
}



return false;
}


function addpay(ctid,id)
  {
  var counts=id.replace( /^\D+/g, '').trim();
var amtt=document.getElementById('pay'+counts).value;
//alert(ctid);




if (document.getElementById(id).checked)
{       if(ctid!="")
{
          payd.push(ctid);
      
document.getElementById('seltot').value=Number(document.getElementById('seltot').value)+Number(amtt);
document.getElementById('pay'+counts).className = "enb";
document.getElementById('pay'+counts).disabled=false;
document.getElementById('tcsamt'+counts).className = "enbl";



}
}
else{
var index = payd.indexOf(ctid);
if (index > -1) {
    payd.splice(index, 1);
}

document.getElementById('seltot').value=Number(document.getElementById('seltot').value)-Number(amtt);
document.getElementById('pay'+counts).className = "disb";
document.getElementById('pay'+counts).disabled=true;
document.getElementById('tcsamt'+counts).className = "disbl";

}
 
 //alert(payd);
 
  }


function oladdmt()
  {
   
$("input:checkbox[name=pay[]]:checked").each(function(){
    payd.push($(this).val());
});

var paymsel1=[];
		var fields = document.getElementsByName("payf[]");
		for(var i = 0; i < fields.length; i++) 
                   {
			paymsel1.push(fields[i].value);
			}
 

var seltotal= 0;
	for (i=0; i<paymsel1.length; i++)
	{ 
          if(paymsel1[i]!="")
             {
    seltotal+=parseFloat(paymsel1[i]);
	    }
	}
	
document.getElementById('seltot').value=Math.round(seltotal);

  }
  
  function addpmnt(id)
  {
  var counts=id.replace( /^\D+/g, '').trim();
  var edmt=document.getElementById(id).value;
  var pendamt=document.getElementById('penamt'+counts).value;
  if(Number(edmt)>Number(pendamt))
  {
  
  alert("Amount is greater than Pending Amount");
  document.getElementById(id).value=Math.round(pendamt);
  
  var paymsel12=[];
		var fields30 = document.getElementsByName("payf[]");
		for(var i = 0; i < fields30.length; i++) 
                   {
			paymsel12.push(fields30[i].value);
			}
 

var seltotal30= 0;
	for (i=0; i<paymsel12.length; i++)
	{ 
          if(paymsel12[i]!="")
             {
    seltotal30+=parseFloat(paymsel12[i]);
	    }
	}
	
document.getElementById('seltot').value=Math.round(seltotal30);
  
  
  }
  else
  {
  
    var paymsel12=[];
		var fields30 = document.getElementsByName("payf[]");
		for(var i = 0; i < fields30.length; i++) 
                   {
			paymsel12.push(fields30[i].value);
			}
 

var seltotal30= 0;
	for (i=0; i<paymsel12.length; i++)
	{ 
          if(paymsel12[i]!="")
             {
    seltotal30+=parseFloat(paymsel12[i]);
	    }
	}
	
document.getElementById('seltot').value=Math.round(seltotal30);
  
  
  }
  
  }


function func()
{
//alert("hello");
var mnth=document.getElementById('mnth').value;
var yr=document.getElementById('yr').value;
var typ=document.getElementById('typ').value;
var state=document.getElementById('state').value;
var fto=document.getElementById('fto').value;
var locn=document.getElementById('locn').value;


if(typ=="")
{
alert("Please select type");
}
else if(yr=="")
{
alert("Please select Year");
}
else if(mnth=="")
{
alert("Please select Month");

}
else
{
//alert(accname);

//alert(atm);
$.ajax({
   type: 'POST',    
url:'searchsal_frtest.php',
 beforeSend: function()
                   {
        
                  document.getElementById("search").innerHTML ="<center><img src=../loader.gif></center>";
                  },
data:'mnth='+mnth+'&yr='+yr+'&typ='+typ+'&state='+state+'&fto='+fto+'&locn='+locn,
success: function(msg){

//alert(msg);
  document.getElementById('search').innerHTML=msg;
 oladdmt();


  
 
         }
     });



}

}


</script>
</head>
<body onload="<?php if($typf!=""){?> func(); <?php  }?>">
<form id='frm1' method="post" enctype="multipart/form-data" action="process_salary_fr.php" onsubmit="return subfunc();">
<input type="hidden" name="ctsalid" id="ctsalid" readonly/>
<input type="hidden" name="ctpay" id="ctpay" readonly/>
<input type="hidden" name="paymm" id="paymm" readonly/>
<input type="hidden" name="salmnth" id="salmnth" value="<?php echo $dt;?>">

<center>
<?php  include("menubar.php"); ?>
<h2 class="h2color"></h2>


<br/>
<table  border="0" cellpadding="0" cellspacing="0">



<th>Type:
<select name="typ" id="typ">
<option value="">select type</option>
<option value="Off Roll" <?php if($typf=='Off Roll'){ echo "selected";}?>>Off Roll</option>
<option value="On Roll" <?php if($typf=='On Rolll'){ echo "selected";}?>>On Roll</option>
</select>
</th>
<th>
Month
<select id="mnth" name="mnth" style="width:200px">

<option value="">select month</option>
<option value="01"   <?php if($mnf=='1'){ echo "selected";} ?>>January</option>
 <option value="02" <?php if($mnf=='2'){ echo "selected";} ?>>February</option>
 <option value="03" <?php if($mnf=='3'){ echo "selected";} ?>>March</option>
 <option value="04" <?php if($mnf=='4'){ echo "selected";} ?>>April</option>
 <option value="05" <?php if($mnf=='5'){ echo "selected";} ?>>May</option>
 <option value="06" <?php if($mnf=='6'){ echo "selected";} ?>>June</option>
 <option value="07" <?php if($mnf=='7'){ echo "selected";} ?>>July</option>
 <option value="08" <?php if($mnf=='8'){ echo "selected";} ?>>August</option>
 <option value="09" <?php if($mnf=='9'){ echo "selected";} ?>>September</option>
 <option value="10" <?php if($mnf=='10'){ echo "selected";} ?>>October</option>
 <option value="11" <?php if($mnf=='11'){ echo "selected";} ?>>November</option>
 <option value="12" <?php if($mnf=='12'){ echo "selected";} ?>>December</option>
</select>

</th>
<th>Year:
<select name="yr" id="yr">
 <option value="" >select year</option>
<?php $year="2000";
$cyr=date('Y');
for($i=1;$i<50;$i++)
{

?>
<option value="<?php echo $year;?>" <?php  if($yf=="") {if($cyr==$year){ echo "selected";}}else{ if($yf==$year){ echo "selected";}  }   ?> ><?php echo $year; $year=$year+1; ?></option>

<?php } ?>
</select>
</th>

<th><select  name="state"  id="state">
<option value="">select state</option>
<?php 
$gst=mysqli_query($con,"select distinct(state) from salary_acc");
while($gsrow=mysqli_fetch_array($gst))
{
?>
<option value="<?php echo $gsrow[0];?>"><?php echo $gsrow[0];?></option>
<?php
}

?>
</select>
</th>

<th><select  name="locn"  id="locn">
<option value="">select location</option>
<?php 
$gloc=mysqli_query($con,"select distinct(location) from salary_acc");
while($glrow=mysqli_fetch_array($gloc))
{
?>
<option value="<?php echo $glrow[0];?>"><?php echo $glrow[0];?></option>
<?php
}

?>
</select>
</th>

<th><select  name="fto"  id="fto">
<option value="">select FundTransferTo</option>
<?php 
$getfto=mysqli_query($con,"select distinct(FundTransferTo),accid2 from caretaker_salary");
while($ftrow=mysqli_fetch_array($getfto))
{
?>
<option value="<?php echo $ftrow[1];?>"><?php echo $ftrow[0];?></option>
<?php
}

?>
</select>
</th>




<th><input type="button" name="search"  value="search" onclick="func();"/></th>
</tr>
</table>
</center>



<center>
<div id="search"></div>

</center>
</form>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>