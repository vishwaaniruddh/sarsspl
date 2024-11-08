<?php
include("access.php");

session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry, your session has Expired'); window.location='index.php';</script>";
}
else
{


$cidr=$_GET['cidr'];
$sdater=$_GET['sdater'];
$edater=$_GET['edater'];
$atmr=$_GET['atmr'];
$qidr=$_GET['qidr'];
$bankr=$_GET['bankr'];
$acmr=$_GET['accnamer'];
$billtyp=$_GET['billtyp'];
$refr=$_GET['refr'];



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
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
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
<script type="text/javascript">




function expfunc()
{
$('#frm1').attr('action', 'quotation1_annexexport.php').attr('target','_blank');
$('#frm1').submit();
}

function getbank(cust)
{
    
$.ajax({
   type: 'POST',    
url:'get_quotation1_bank.php',
data:'cust='+cust,
success: function(msg){

//alert(msg);
document.getElementById('bank').innerHTML=msg;

 
         }
     });



}

function func(strpg,perpg)
{


             var cid=document.getElementById('cid').value;//alert(cid);
	
			
			 var sdate=document.getElementById('sdate').value;//alert(sdate);
			var edate=document.getElementById('edate').value;//alert(edate);
			var atmid=document.getElementById('atmid').value;//alert(atmid);
			var bank=document.getElementById('bank').value;//alert(qid);
	        var state=document.getElementById('state').value;//alert(qid);
	

/*if(cid=="")
{
    alert("Select Customer");
    
}
else if(state=="")
{
    alert("Select State");
    
}
else if(bank=="")
{
    alert("Select Bank");
    
}
else */ if(state=="")
{
    alert("Select State");
    
}

else
{
//alert(accname);
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

$.ajax({
   type: 'POST',    
   url:'search_ViewInvoiceannex.php',
   beforeSend: function()
                   {
        
                  document.getElementById("search").innerHTML ="<center><img src=loader.gif></center>";
                  },
data:'cid='+cid+'&sdate='+sdate+'&edate='+edate+"&atmid="+atmid+'&perpg='+perp+'&Page='+Page+'&bank='+bank+'&state='+state,
success: function(msg){

//alert(msg);
  document.getElementById('search').innerHTML=msg;
 
         }
     });


}


}



function calctotmt()
{
    try
    {
    var ttmt=0;
 $("input:checkbox[name=clbillqid[]]:checked").each(function(){
  //  qrrarry.push($(this).val());
  var idd=$(this).attr('id');
  
  var thenum = idd.replace( /^\D+/g, '');
// aprmth 
  //alert(thenum);
  var tt=document.getElementById("aprmth"+thenum).value;
 ttmt=Number(ttmt)+Number(tt); 
  
  
 
});
   
  document.getElementById("fnamt").value= ttmt;
    }catch(ex)
    {
        alert(ex);
        
    }
    
}


function subpfunc()
{


//var qrrarry=[];

var cid=document.getElementById('cid').value;//alert(cid);
	
			
			 var sdate=document.getElementById('sdate').value;//alert(sdate);
			var edate=document.getElementById('edate').value;//alert(edate);
			var atmid=document.getElementById('atmid').value;//alert(atmid);
			var qid=document.getElementById('qid').value;//alert(qid);
			var bank=document.getElementById('bank').value;//alert(qid);
	    //	var accname=document.getElementById('accname').value;//alert(qid);
		
	var state=document.getElementById('state').value;//alert(qid);
		//	var proj=document.getElementById('proj').value;//alert(qid);
var fnamt=document.getElementById('fnamt').value;


var qrrarry="";
$("input:checkbox[name=clbillqid[]]:checked").each(function(){
  //  qrrarry.push($(this).val());
  
  
  if(qrrarry=="")
  {
      qrrarry=$(this).val();
     
  }else
  {
      
      qrrarry=qrrarry+","+$(this).val();
      
  }
});

//alert(qrrarry);

if(qrrarry.length=='0')
{
alert('please select a quotation to submit ' );

}
else
{

$.ajax({
   type: 'POST',    
url:'rnminvprocess.php',
data:{qrrarry:qrrarry,cid:cid,bank:bank,state:state,fnamt:fnamt},
success: function(msg){

alert(msg);
if(msg==20)
{
    alert("session expired");
}
else if(msg!=0)
{
    func("","");
    alert("Successful");
    window.open("rnm_invoice_view.php?sid="+msg,"_blank");
}else
{
    
     alert("Error");
}



    }
     });

}
}

</script>
</head>

<body  >
<form name="frm1" id="frm1" method="post">

<div class="">
<center>
<?php  include("menubar.php"); ?>

<h2 class="h2color">ViewQuot_invoice</h2>

<!--<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>
	<br />-->
<table  border="0" cellpadding="0" cellspacing="0">

<tr>
<th>

<?php 
include("config.php");
?>
<tr>
<th width="75">
<select name="cid" id="cid" onchange="getbank(this.value);">
<option value="-1">Select client</option>



<?php 
$qr=mysqli_query($con,"select short_name,contact_first from contacts");
while($qra=mysqli_fetch_array($qr))
{
?>


<option value="<?php echo $qra[0]; ?>"   <?php if($cidr==$qra[0]){ echo "selected"; } ?>     ><?php echo $qra[1]; ?></option>


<?php 

}
?>

</select>

</th>






<th width="75">
<select name="bank" id="bank">
<option value="" >select bank</option>
</select>
</th>



<th width="75">
<select name="state" id="state" />
<option value="">Select State</option>
<?php $stqr=mysqli_query($con,"select * from quotation1statedet order by state ASC");
while($strws=mysqli_fetch_array($stqr))
{
?>
<option value='<?php echo $strws[1];?>'><?php echo $strws[1];?></option>
<?php } ?>
</select>
</th>


<!--<th width="75">
<select name="proj" id="proj" />
<option value="">Select Project</option>

</select>
</th>-->

</tr>

<tr>
<!--<th width="75"><input type="text" name="qid" id="qid" placeholder="Quotation Id"    value="<?php if($qidr!=""){echo $qidr;}?>"/></th>-->
<th width="75"><input type="text" name="atmid" id="atmid" placeholder="AtmID"    value="<?php if($atmr!=""){echo $atmr;}?>"/></th>
<th width="75"><input type="text" name="sdate" id="sdate" onclick="displayDatePicker('sdate');"  placeholder="From Date" value="<?php if($sdater!=""){echo $sdater;}?>"/></th>
<th width="75"><input type="text" name="edate" id="edate"  onclick="displayDatePicker('edate');"  placeholder="To Date"  value="<?php if($edater!=""){echo $edater;}?>"/></th>

<th><input type="button" name="search" onclick="func('','');" value="search" /></td>
</tr>
</table>
</center>


</div>



<center>
<div id="search"></div>

</center>
</form>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>
<?php 
}
?>