<?php 
	include("access.php");
	include("config.php");	

session_start();
//include("access.php");
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry, your session has Expired'); window.location='index.php';</script>";
}
else
{




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
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script src="excel.js" type="text/javascript"></script>


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
               
                 
                // alert(msg);
                   
                window.open('quotation_approve.php?qoid='+qoid+'&strdt='+strdt+'&endt='+endt+'&oatm='+atm,'_self');
               
                
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

var ct=document.getElementById('customer'+count).value.trim();
//alert(qid);
//alert(ct);
if(ct=="Fidility")
{

window.open('viewfisquotdetails.php?qid='+qid,'_blank');
}
else if(ct=="Tata")
{

window.open('viewtataquotdetails.php?qid='+qid,'_blank');
}
else if(ct=="kotak_delhi")
{

window.open('viewquotdetails1.php?qid='+qid,'_blank');
} 
else
{

 window.open('viewquotdetails.php?qid='+qid,'_blank');
  } 



}
function vhisfunc(id)
{

var count= id.replace( /^\D+/g, '').trim();
//lert(count);
var qid=document.getElementById('qid'+count).value;

//alert(qid);

 window.open('viewoldquot.php?qid='+qid,'_blank');
   



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

 window.open('editquotation.php?qid='+qid+'&qoid='+qoid+'&strdt='+strdt+'&endt='+endt+'&atm='+atm,'_self');


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

 window.open('appedit_quot.php?qid='+qid+'&qoid='+qoid+'&strdt='+strdt+'&endt='+endt+'&atm='+atm,'_self');


}

function closefuncdiv(divcls)
{

//alert(divcls);
document.getElementById(divcls).style.display = 'block';

}

function closefuncdivhide(divcls)
{

//alert(divcls);
document.getElementById(divcls).style.display = 'none';

}




function clsfunc(id,cust)
{

var counts= id.replace( /^\D+/g, '').trim();
var qid=document.getElementById('qid'+counts).value;
var dt=document.getElementById('date1'+counts).value; 
 var comby=document.getElementById('comby'+counts).value;
  var rem=document.getElementById('rem'+counts).value;
 var eml=document.getElementById('email_cpy'+counts).value;
//alert(cust);

if(cust=='AGS01' & eml=='')
{
alert("please add attachment");
}
else
{
if(rem=="")
{
alert("please enter remark");
}
else
{

var conf=confirm('Are you sure to Close the Quotation?');
    
 //alert(qid);
 //alert(appamt);
var fd=new FormData($('#frmup')[0]);
  fd.append('qid',qid);
 fd.append('dt',dt);
 fd.append('comby',comby);
 fd.append('rem',rem);
 fd.append('counts',counts);
//alert(fd);
 
if(conf==true)
{ 


$.ajax({
            url: "process_quotfinal_close.php",
            type: "POST",
            data:fd,    
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function()
                   {
        
                  document.getElementById(id).disabled=true;
                       document.getElementById('closeq'+counts).disabled=true;
                     document.getElementById('clsfdiv'+counts).style.display='none';
                  },     
            success: function(text){
            alert(text);
            document.getElementById('closeq'+counts).value='Closed';
           },
    error: function (request, status, error) {
        alert(request.responseText);
    }
        });

}

}

}
}


















/*function closefunc(id)
{


var count= id.replace( /^\D+/g, '').trim();
//lert(count);
var qid=document.getElementById('qid'+count).value;

var qoid=document.getElementById('quot').value;
var strdt=document.getElementById('date').value;
var endt=document.getElementById('date2').value;
var atm=document.getElementById('atm').value;


//alert(qid);

 window.open('close_quotation.php?qid='+qid+'&qoid='+qoid+'&strdt='+strdt+'&endt='+endt+'&atm='+atm,'_self');


}

*/
function cancqfunc(id)
{
var count= id.replace( /^\D+/g, '').trim();
//alert(count);

var qoid=document.getElementById('quot').value;
var strdt=document.getElementById('date').value;
var endt=document.getElementById('date2').value;
var atm=document.getElementById('atm').value;
var qid=document.getElementById('qid'+count).value;


window.open('canc_quotation.php?qid='+qid+'&qoid='+qoid+'&strdt='+strdt+'&endt='+endt+'&atm='+atm,'_self');

}


function func(strpg,perpg)
{
debugger;
var tik_id=document.getElementById('tik_id').value;
var qid=document.getElementById('quot').value;
var strdt=document.getElementById('date').value;
var endt=document.getElementById('date2').value;
var bank=document.getElementById('bank').value;
var atm=document.getElementById('atm').value;
var accname=document.getElementById('accname').value;
var type=document.getElementById('type').value;
var fundtyp=document.getElementById('fundtyp').value;
var calltyp=document.getElementById('calltyp').value;
var qtst=document.getElementById('stts').value;

var cust=document.getElementById('cust1').value;
if(perpg=="")
{
perp='10';
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




//alert(qid);
$.ajax({
   type: 'POST',    
url:'getquotdetails1.php',
 beforeSend: function()
                   {
        
                  document.getElementById("show").innerHTML ="<center><img src=loader.gif></center>";
                  },
data:'qid='+qid+'&strdt='+strdt+'&endt='+endt+'&atm='+atm+'&accname='+accname+'&type='+type+'&fundtyp='+fundtyp+'&perpg='+perp+'&Page='+Page+'&calltyp='+calltyp+'&qtst='+qtst+'&cust1='+cust+'&tik_id='+tik_id+'&bank='+bank,

success: function(msg){

// alert(msg);
  document.getElementById('show').innerHTML=msg;
         }
     });

}





function getbank()
{
	//alert(val);



  var cst=document.getElementById('cust1').value;
//alert(cst);



	if (window.XMLHttpRequest)
        {
            // code for IE7+, Firefox, Chrome, Opera, Safari
           xmlhttp=new XMLHttpRequest();
        }
      else
       {
           // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
       }
       xmlhttp.onreadystatechange=function()
       {
          if (xmlhttp.readyState==4 && xmlhttp.status==200)
          {
		
            //alert(xmlhttp.responseText);
            document.getElementById('bank').innerHTML='';
	    document.getElementById('bank').innerHTML=xmlhttp.responseText;
	

	    
	
          }
       }
       xmlhttp.open("GET","getbank.php?val="+cst,true);
       xmlhttp.send();
      
	
}


</script>
<style>


</style>
</head>
<body onload="func('','');" >
<form id="frmup" name="frmup"  method="post" action="expquot.php" target="_blank">
<center>
<?php include("menubar.php"); ?>
<h2>Quotations</h2>



<table height=75 border="0" cellpadding="0" cellspacing="0">
<tr>



<th>

<?php

$sql="Select short_name,contact_first from contacts where type='c' ";
$cnt="";
if($_SESSION['custid']!='all')
{
$carr=explode(',',$_SESSION['custid']);

$cnt=count($carr);

for($i=0;$i<$cnt;$i++)
{
 if($i==0)
{


$sql.=" and short_name='".$carr[$i]."'";
}
else
{
$sql.=" or short_name='".$carr[$i]."'";

}
}
}

$qry=mysqli_query($con,$sql);
 ?>
 <select  name="cust1" id="cust1" onchange="getbank();" >
<?php
while($clro=mysqli_fetch_row($qry))
{
?>
<option value="<?php echo $clro[0]; ?>" <?php if($_SESSION['custid']==$clro[0]){ echo "selected"; } ?>><?php echo $clro[1]; ?></option>
<?php
}
?>
</select> </th>



<th><label>Quotation ID</label><input type="text" id="quot" name="quot" value="<?php echo $qoid;?>"/></th>
</th>



<th><label>Category</label><select id="type" name="type">
<option value="-1">select type</option>


<option value="f">Fixed Cost</option>
<option value="a">Approval Basis</option>

</select>
</th>

<th><label>Bank</label>
<select style="width:150px" name="bank" id="bank" onchange="enbtxt();">
<option value="0">Select Bank</option>

</select>
</th>



<th><label>Atm ID</label><input type="text" id="atm" name="atm" value="<?php echo $oatm;?>"/></th>
<th><label>From Date</label><input type="text" name="date" id="date"  onclick="displayDatePicker('date');"  value="<?php echo $sts;?>"/></th>
<th><label>To Date</label>  <input type="text" name="date2" id="date2"  onclick="displayDatePicker('date2');"  value="<?php echo $ends;?>"/></th>
<th>
    
<?php


$expl=explode(",",$_SESSION['custid']);

$csds="";

for($b=0;$b<count($expl);$b++)
{
    
    if($csds=="")
    {
        $csds=$csds."'".$expl[$b]."'";
    }else
    {
        
        $csds=$csds.",'".$expl[$b]."'";
    }
}

//echo "select distinct(reqby) from quotation1 where cust in($csds)";?>
    <label>Made By</label><select id="accname" name="accname">

<option value="-1">select </option>
<?php

$nwr=mysqli_query($con,"select distinct(reqby) from quotation1 where cust in($csds)");
while($ftt=mysqli_fetch_array($nwr))
{
    
 $qrs1=mysqli_query($con,"select srno,username from login where srno='".$ftt[0]."'");
$frty=mysqli_fetch_array($qrs1);
   ?>
   
   <option value="<?php echo $frty[0];?>"><?php echo $frty[1];?></option>

   <?php
    
}
?>
</select>
</th>
<th><label>Fund Process</label><select id="fundtyp" name="fundtyp">
<option value="-1">select type</option>


<option value="0">Pending</option>
<option value="1">Fund Processing</option>
<option value="2">Closed</option>
<option value="100">Archieved</option>
<option value="10">Rejected</option>

</select>
</th>



<th><label>Call Type</label><select id="calltyp" name="calltyp">
<option value="">select call type</option>


<option value="0">Open</option>
<option value="1">Closed</option>

</select>
</th>


<th><label>Status</label><select id="stts" name="stts">
<option value="">select status</option>


<option value="y">Pending</option>
<option value="a">Approve By</option>
<option value="app">Approved</option>
</select>
</th>

<th><label>WBS/VPR/Prime/Tik/Ref_No/JobID</label><input type="text" id="tik_id" name="tik_id" value="<?php echo "";?>"/></th>

<th><input type="button" name="search"  value="search" onclick="func('','');"/></th>  
 </tr>
 </table>
 
</center>
<br>
<br>
<center>
<div id="show"></div>
</center>



<script type="text/javascript" src="script.js"></script>
</form>

</body>

</html>


<?php } ?>


