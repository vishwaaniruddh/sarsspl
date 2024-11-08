<?php 
	include("access.php");
	include("config.php");	

session_start();
//include("access.php");
if(!$_SESSION['user'])
{
?>
<script type="text/javascript">
alert("Sorry Your session has Expired");
window.location="index.php";
</script>
<?php
}



$qoid=$_GET['qoid'];
$sts=$_GET['strdt'];
$ends=$_GET['endt'];
$oatm=$_GET['oatm'];
   

   
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<script src="excel.js" type="text/javascript"></script>

<!--<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>-->
<script type="text/javascript" src="script.js"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>

<script type="text/javascript">


function transfunc(id)
{
var qoid=document.getElementById('quot').value;
var strdt=document.getElementById('date').value;
var endt=document.getElementById('date2').value;
var atm=document.getElementById('atm').value;

var counts=id.replace( /^\D+/g, '').trim();
var qid=document.getElementById('qid'+counts).value;
//var trramt=document.getElementById('trreqamt'+counts).value;
//var vcno=document.getElementById('vcno'+counts).value;

var conf=confirm('Do you really want to transfer the quotation?');
    
 

if(conf==true)
{
$.ajax({
            type: "POST",
            url: "transfer_quotation_vijay.php",
            data: 'qid='+qid,
             beforeSend: function()
                   {
        
                document.getElementById(id).disabled=true;
                 document.getElementById(id).value="please wait";
                  },
            success: function(msg){
               
                 
                alert(msg);
                   
                window.open('icici_quot_view.php?qoid='+qoid+'&strdt='+strdt+'&endt='+endt+'&oatm='+atm,'_self');
               
                
            }
        });
}

}








function vdtefunc(id)
{
//lert(id);
var count= id.replace( /^\D+/g, '').trim();
//lert(count);
var qid=document.getElementById('qid'+count).value;


 window.open('viewiciciquot.php?qid='+qid,'_blank');




}
function vhisfunc(id)
{

var count= id.replace( /^\D+/g, '').trim();
//lert(count);
var qid=document.getElementById('qid'+count).value;

//alert(qid);

 window.open('icici_edit_history.php?qid='+qid,'_blank');
   



}

function vpdffunc(id)
{
//lert(id);
var count= id.replace( /^\D+/g, '').trim();
//lert(count);
var qid=document.getElementById('qid'+count).value;

//alert(qid);

 window.open('savequotpdf.php?qid='+qid,'_blank');
   



}



function editfunc(id)
{


var count= id.replace( /^\D+/g, '').trim();
//lert(count);
var qid=document.getElementById('qid'+count).value;

var qoid=document.getElementById('quot').value;
var strdt=document.getElementById('date').value;
var endt=document.getElementById('date2').value;
var atm=document.getElementById('atm').value;


//alert(qid);

 window.open('iciciquotedit.php?qid='+qid+'&qoid='+qoid+'&strdt='+strdt+'&endt='+endt+'&atm='+atm,'_self');


}






function qappfunc(id)
{


var count= id.replace( /^\D+/g, '').trim();
//lert(count);
var qid=document.getElementById('qid'+count).value;

var qoid=document.getElementById('quot').value;
var strdt=document.getElementById('date').value;
var endt=document.getElementById('date2').value;
var atm=document.getElementById('atm').value;


//alert(qid);

 window.open('icici_approve_det.php?qid='+qid+'&qoid='+qoid+'&strdt='+strdt+'&endt='+endt+'&atm='+atm,'_self');


}


function closefunc(id)
{


var count= id.replace( /^\D+/g, '').trim();
//lert(count);
var qid=document.getElementById('qid'+count).value;

var qoid=document.getElementById('quot').value;
var strdt=document.getElementById('date').value;
var endt=document.getElementById('date2').value;
var atm=document.getElementById('atm').value;


//alert(qid);

 window.open('close_quotation.php?qid='+qid+'&qoid='+qoid+'&strdt='+strdt+'&endt='+endt+'&atm='+atm+'&ic=ic','_self');


}


function cancqfunc(id)
{
var count= id.replace( /^\D+/g, '').trim();
//alert(count);

var qoid=document.getElementById('quot').value;
var strdt=document.getElementById('date').value;
var endt=document.getElementById('date2').value;
var atm=document.getElementById('atm').value;
var qid=document.getElementById('qid'+count).value;


window.open('canc_quotation.php?qid='+qid+'&qoid='+qoid+'&strdt='+strdt+'&endt='+endt+'&atm='+atm+'&ic=ic','_self');

}


function func()
{

var qid=document.getElementById('quot').value;
var strdt=document.getElementById('date').value;
var endt=document.getElementById('date2').value;
var atm=document.getElementById('atm').value;
var type=document.getElementById('type').value;
var pono=document.getElementById('pos').value;
var cust=document.getElementById('cust1').value;
var location=document.getElementById('Loc').value;
//alert(pono);
$.ajax({
   type: 'POST',    
url:'get_icici_quotdetails.php',
 beforeSend: function()
                   {
        
                  document.getElementById("show").innerHTML ="<center><img src=loader.gif></center>";
                  },
data:'qid='+qid+'&strdt='+strdt+'&endt='+endt+'&atm='+atm+'&typ='+type+'&pono='+pono+'&cust='+cust+'&location='+location,

success: function(msg){

//alert(msg);
  document.getElementById('show').innerHTML=msg;
         }
     });

}


</script>
<style>


</style>
</head>
<body onload="func();" >
<form id="frmup" name="frmup"  method="post" action="iciciexp.php" target="_blank">
<center>
<?php include("menubar.php"); ?>
<h2>Quotations</h2>



<table height=75 border="0" cellpadding="0" cellspacing="0">
<tr>

<th>Customer
<?php

$sqlc="Select short_name,contact_first from contacts where type='c' ";

$carr=explode(',',$_SESSION['custid']);

$cnt=count($carr);

for($i=0;$i<$cnt;$i++)
{
 if($i==0)
{


$sqlc.=" and short_name='".$carr[$i]."'";
}
else
{
$sqlc.=" or short_name='".$carr[$i]."'";

}

}

$qryc=mysqli_query($con,$sqlc);
?>
<select  name="cust1" id="cust1"  >

<?php
while($clro=mysqli_fetch_row($qryc))
{
?>
<option value="<?php echo $clro[0]; ?>" ><?php echo $clro[1]; ?></option>
<?php
}
?>
</select> 


</th>



<th><label>Quotation ID</label><input type="text" id="quot" name="quot" value="<?php echo $qoid;?>"/></th>
</th>


<th><label>Category</label><select id="type" name="type">
<option value="-1">select type</option>

<option value="po">Po Basis</option>
<option value="f">Fixed Cost</option>
<option value="a">Approval Basis</option>

</select>
</th>
<th><label>Sol ID</label><input type="text" id="atm" name="atm" value="<?php echo $oatm;?>"/></th>
<th><label>From Date</label><input type="text" name="date" id="date"  onclick="displayDatePicker('date');"  value="<?php echo $sts;?>"/></th>
<th><label>To Date</label>  <input type="text" name="date2" id="date2"  onclick="displayDatePicker('date2');"  value="<?php echo $ends;?>"/></th>
<th><label>PO number</label><input type="text" id="pos" name="pos" /></th>
<th><label>Location</label><input type="text" id="Loc" name="Loc" /></th>
<th><input type="button" name="search"  value="search" onclick="func();"/></th>  
</tr>
</table>
</center>
<br>
<br>
<br>
<br>

<center>
<div id="show"></div>
</center>


<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</form>

</body>

</html>





