<?php 
include("access.php");
include("config.php");
    $sid = $_GET['atmid'];
    $id = $_GET['id'];
	 $cid = $_GET['cid'];
	  $bid = $_GET['bid'];
	
        $sql = "select * from ".$cid."_ebill where atm_id='".$sid."'";

		$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_row($result);	
	
        $sql1 = "select * from ebaccount_details where atmid='".$sid."'";

		$result1 = mysqli_query($con,$sql1);
	$row1 = mysqli_fetch_row($result1);			
	/*
	if($row[5]=="Y"){
	houserate.visible=true;
	}*/
	 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>New Bill Entry</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script src="function.js" type="text/javascript"></script>

 <script type="text/javascript">
 
function updateData()
{
//alert("hi");

//var val;
//val=val+"&comp="+comp;
//alert(num);
//	document.getElementById('image').innerHTML="<img src='loading.gif' width='100px' height='50px'>";
		if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		
alert(xmlhttp.responseText);
document.getElementById(id).innerHTML='';
	document.getElementById(id).innerHTML=xmlhttp.responseText;
	
	
    }
  }
  //alert("getcustbank.php?val="+val);
//xmlhttp.open("GET",val,true);
//xmlhttp.send();


	var m_consumr=document.getElementById('con_no').value;
	var m_trackerid=document.getElementById('trackid').value;
	var m_dist=document.getElementById('distributor').value;
	var m_due=document.getElementById('duedate').value;
	var m_land=document.getElementById('landlord').value;
	var m_billunit=document.getElementById('billunit').value;
	var m_meter=document.getElementById('meterno').value;
	var m_atm=document.getElementById('atmid').value;
	var m_cust=document.getElementById('cust').value;
	var addr=document.getElementById('address').value;
	var prj=document.getElementById('projectid').value;
	var bank=document.getElementById('bank').value;
	//alert(cust);
	/*alert(m_atm);
	alert(m_dist);
	alert(m_due);
	alert(m_land);*/
	//var m_dat="consumer="+m_consumr+"&trckid="+m_trackerid+"&distri="+m_dist;
	//alert(m_dat);
	if(m_atm!='' && m_cust!=''){
var dat="cust="+m_cust+"&consumer="+m_consumr+"&trckid="+m_trackerid+"&distri="+m_dist+"&duedt="+m_due+"&land="+m_land+"&billunit="+m_billunit+"&mtr="+m_meter+"&atm="+m_atm+"&addr="+addr+"&bank="+bank+"&prjt="+prj;
//alert(dat);

xmlhttp.open("POST","updatepage.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send(dat);
}
else
{
alert("Please Enter Atm ID");
return false;
}

}
	

 </script>
 
<style> 
body {
	font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif;
	font-size: .8em;
	}
 
/* the div that holds the date picker calendar */
.dpDiv {
	}
 
 
/* the table (within the div) that holds the date picker calendar */
.dpTable {
	font-family: Tahoma, Arial, Helvetica, sans-serif;
	font-size: 12px;
	text-align: center;
	color: #505050;
	background-color: #ece9d8;
	border: 1px solid #AAAAAA;
	}
 
 
/* a table row that holds date numbers (either blank or 1-31) */
.dpTR {
	}
 
 
/* the top table row that holds the month, year, and forward/backward 

buttons */
.dpTitleTR {
	}
 
 
/* the second table row, that holds the names of days of the week (Mo, 

Tu, We, etc.) */
.dpDayTR {
	}
 
 
/* the bottom table row, that has the "This Month" and "Close" buttons 

*/
.dpTodayButtonTR {
	}
 
 
/* a table cell that holds a date number (either blank or 1-31) */
.dpTD {

	border: 1px solid #ece9d8;
	}
 
 
/* a table cell that holds a highlighted day (usually either today's 

date or the current date field value) */
.dpDayHighlightTD {
	background-color: #CCCCCC;
	border: 1px solid #AAAAAA;
	}
 
 
/* the date number table cell that the mouse pointer is currently over 

(you can use contrasting colors to make it apparent which cell is being 

hovered over) */
.dpTDHover {
	background-color: #aca998;
	border: 1px solid #888888;
	cursor: pointer;
	color: red;
	}
 
 
/* the table cell that holds the name of the month and the year */
.dpTitleTD {
	}
 
 
/* a table cell that holds one of the forward/backward buttons */
.dpButtonTD {
	}
 
 
/* the table cell that holds the "This Month" or "Close" button at the 

bottom */
.dpTodayButtonTD {
	}
 
 
/* a table cell that holds the names of days of the week (Mo, Tu, We, 

etc.) */
.dpDayTD {
	background-color: #CCCCCC;
	border: 1px solid #AAAAAA;
	color: white;
	}
 
 
/* additional style information for the text that indicates the month 

and year */
.dpTitleText {
	font-size: 12px;
	color: gray;
	font-weight: bold;
	}
 
 
/* additional style information for the cell that holds a highlighted 

day (usually either today's date or the current date field value) */ 
.dpDayHighlight {
	color: 4060ff;
	font-weight: bold;
	}
 
 
/* the forward/backward buttons at the top */
.dpButton {
	font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: gray;
	background: #d8e8ff;
	font-weight: bold;
	padding: 0px;
	}
 
 
/* the "This Month" and "Close" buttons at the bottom */
.dpTodayButton {
	font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: gray;
	background: #d8e8ff;
	font-weight: bold;
	}
 
</style> 

<script src="php_calendar/scripts.js" type="text/javascript"></script>
<script type="text/javascript">


function validate(form)
{

return true;
}


function validatee(form)
{

//alert("hi");
with(form)
{
if(cust.value=='')
{
alert("Please Select Customer");
cust.focus();
return false;
}
if(trackid.value=='')
{
alert("Please Enter Tracker ID");
trackid.focus();
return false;
}
if(bill_date.value=='')
{
alert("Please Enter Bill Date");
bill_date.focus();
return false;
}
if(fromdt.value=='')
{
alert("Please Select From Date ");
fromdt.focus();
return false;
}
if(todt.value=='')
{
alert("Please Select To Date ");
todt.focus();
return false;
}
if(duedt.value=='')
{
alert("Please Select Due Date ");
duedt.focus();
return false;
}
if(openr.value=='')
{
alert("Please Enter Opening Reading ");
openr.focus();
return false;
}
if(closer.value=='')
{
alert("Please Select Closing Reading ");
closer.focus();
return false;
}
if(extra.value=='')
{
alert("Please Enter Extra Charge ");
extra.focus();
return false;
}
if(unit.value=='')
{
alert("Please Enter Unit Number ");
unit.focus();
return false;
}
if(amount.value=='')
{
alert("Please Enter Amount ");
amount.focus();
return false;
}
if(paiddt.value=='')
{
alert("Please Select Paid Date ");
paiddt.focus();
return false;
}
if(sv.value=='-1')
{
alert("Please Select a Supervisor ");
sv.focus();
return false;
}
return true;
}

}

function getdetails(val,type)
{
//alert(val+" "+type);
//alert(document.getElementById('cust').value);
//alert(type);
if((document.getElementById('cons').checked==true && type=='Consumer_No') || type=='atm_id1')
{
//alert(val+" "+type);
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	//alert(xmlhttp.responseText);
	var s=xmlhttp.responseText;
var s2=s.split("###$$$");
//document.getElementById('Error').innerHTML=xmlhttp.responseText;
//alert(xmlhttp.responseText);
if(s2[0]=='NA')
{
//alert("No Such Site Available");
//document.getElementById('Error').innerHTML=xmlhttp.responseText;
document.getElementById('err').value=s2[1];
document.getElementById('cmdsub').disabled=true;
document.getElementById('con_no').value='';
document.getElementById('address').value='';
document.getElementById('trackid').value='';
document.getElementById('distributor').value='';
document.getElementById('duedate').value='';
document.getElementById('landlord').value='';
document.getElementById('billunit').value='';
document.getElementById('meterno').value='';
document.getElementById('avgbill').value='';
document.getElementById('bank').value='';
document.getElementById('projectid').value="";
//document.getElementById('flag').value='1';
}
else
{

//document.getElementById('flag').value='0';
//alert(s2[1]);
document.getElementById('err').value='';

document.getElementById('con_no').value=s2[0];
document.getElementById('address').value=s2[8];
document.getElementById('trackid').value=s2[9];
document.getElementById('distributor').innerHTML=s2[1];
document.getElementById('duedate').value=s2[3];
document.getElementById('landlord').value=s2[4];
document.getElementById('billunit').value=s2[5];
document.getElementById('meterno').value=s2[6];
document.getElementById('avgbill').value=s2[7];
document.getElementById('bank').value=s2[12];
document.getElementById('projectid').value=s2[13];
//document.getElementById('cust').value=s2[10];

//alert(document.getElementById('cust').value);
document.getElementById('sv').value=s2[11];
if(document.getElementById('atmid').value=='')
document.getElementById('atmid').value=s2[2];

document.getElementById('cmdsub').disabled=false;

gethistory(s2[9],s2[10],s2[2]);
}


    }
  }
if(val!='')
{
  var cid=document.getElementById('cust').value;
//alert("getebdetails.php?val="+val+"&type="+type+'&cid='+cid);
xmlhttp.open("GET","getebdet2fisnew.php?val="+val+"&type="+type+'&cid='+cid,true);
xmlhttp.send();
}
}	
}
 //get history on ATM ID
  function gethistory(trackerid,custid,atmid)
  {
 //alert(trackerid+" "+custid+" "+atmid);
 

  	if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		
//alert(xmlhttp.responseText);


document.getElementById('history').innerHTML=xmlhttp.responseText;
	
    }
  }
// alert("getcustbank.php?val="+val);

  var cid=document.getElementById('cust').value;
   var atmid=document.getElementById('atmid').value;
    var trackid=document.getElementById('trackid').value;
//alert("chkbilldt.php?val="+val+"&tbl="+tbl+"&cid="+cid);
//alert("getebhistory.php?trackid="+trackerid+"&custid="+custid+"&atmid="+atmid);
xmlhttp.open("GET","getebhistory.php?trackid="+trackerid+"&custid="+custid+"&atmid="+atmid,true);
xmlhttp.send();

  }
  function checkdt()
  {
  //alert(val+" "+tbl);
 //alert("hi");
//return ("not done");
 	if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		
//alert(xmlhttp.responseText);
if(xmlhttp.responseText=='2')
{
alert("Invalid Date");
document.getElementById('cmdsub').disabled=true;
}
else if(xmlhttp.responseText=='3')
{
alert("Bill is already generated for this Date");
document.getElementById('cmdsub').disabled=true;
}
else
document.getElementById('cmdsub').disabled=false;
	
    }
  }

//alert("hi");
if(document.getElementById('cust').value=='' || document.getElementById('trackid').value=='')
{
alert("Please select Client And Tracker ID");
return false;
}
else
  {
  
  var cid=document.getElementById('cust').value;

   var atmid=document.getElementById('atmid').value;

   var stdt=document.getElementById('fromdt').value;
   var todt=document.getElementById('todt').value;
   var billdt=document.getElementById('bill_date').value;
   var duedt=document.getElementById('duedt').value;

    var trackid=document.getElementById('trackid').value;
//alert(cid);

xmlhttp.open("GET","chkbilldt2.php?cid="+cid+'&atmid='+atmid+'&trackid='+trackid+'&frmdt='+stdt+'&todt='+todt+'&duedt='+duedt+'&billdt='+billdt,false);
xmlhttp.send();
//alert("chkbilldt.php?cid="+cid+'&atmid='+atmid+'&trackid='+trackid+'&frmdt='+stdt+'&todt='+todt+'&duedt='+duedt+'&billdt='+billdt);
}
  }
/*function checkdt(val,tbl)
  {
  //alert(val+" "+tbl);
 

  	if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		
//alert(xmlhttp.responseText);
if(xmlhttp.responseText=='1')
{
alert("Bill is already generated for this Date");
document.getElementById('cmdsub').disabled=true;
}
else
document.getElementById('cmdsub').disabled=false;
	
    }
  }
// alert("getcustbank.php?val="+val);
if(document.getElementById('cust').value=='' || document.getElementById('trackid').value=='')
{
alert("Please select Client And Tracker ID");
return false;
}
else
  {
  if(val!=''){
  var cid=document.getElementById('cust').value;
   var atmid=document.getElementById('atmid').value;
    var trackid=document.getElementById('trackid').value;
    var bill_date=document.getElementById('bill_date').value;
    var frmdt=document.getElementById('fromdt').value;
    var todt=document.getElementById('todt').value;
    var duedt=document.getElementById('duedt').value;
//alert("chkbilldt.php?val="+val+"&tbl="+tbl+"&cid="+cid);
xmlhttp.open("GET","chkbilldt.php?val="+val+"&tbl="+tbl+"&cid="+cid+'&atmid='+atmid+'&trackid='+trackid+'&billdt='+bill_date+'&frmdt='+frmdt+'&todt='+todt+'&duedt='+duedt,true);
xmlhttp.send();
}
}
  }*/
  
  function show(id){
 //alert(document.getElementById('divcon_no').style.display);
 // alert(document.getElementById('divcon_no2').style.display);
  
  if(document.getElementById('divcon_no2').style.display=='block' && document.getElementById('divcon_no').style.display=='none')
  {
   document.getElementById('oldcons').innerHTML='Old Consumer Number';
   document.getElementById('divcon_no').style.display='block';
 document.getElementById('divcon_no2').style.display='none';

  }
  else if(document.getElementById('divcon_no2').style.display=='none' && document.getElementById('divcon_no').style.display=='block')
  {
  document.getElementById('oldcons').innerHTML='New Consumer Number';
 document.getElementById('divcon_no').style.display='none';
  document.getElementById('divcon_no2').style.display='block';
  }
  
  if(document.getElementById(id).checked==true)
  {
  document.getElementById('cmdsub').disabled=true;
  }
  else if(document.getElementById(id).checked==false)
  {
 // alert("hi");
  document.getElementById('cmdsub').disabled=false;
  }
  }
  
  function calc(openr,closer)
{
//alert(openr+" "+closer);
var openre=Number(document.getElementById(openr).value);
var closr=Number(document.getElementById(closer).value);
if(openre!='' && closr!='')
{
document.getElementById('unit').value=(Number(closr)-Number(openre));
}
}
function newwin(url,winname,w,h)
{
//alert("hi");
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var targetWin = window.open (url, winname, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=1, resizable=yes, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
  //mywindow = window.open(url, winname, "location=400,status=1,scrollbars=1, width=500,height=400,left=350,top=200");
  
 }
</script>
</head>

<body>

<center>
<?php include("menubar.php");
//echo $_SESSION['branch'];
 ?></center>
<div align="center">
  <h2 class="style1">E-Bill Entry</h2>
</div><br /><br />

<div align="center" id="Error"><?php if(isset($_SESSION['success'])){ echo $_SESSION['success']; unset($_SESSION['success']);}  ?></div>
<form id="form1" name="form1" method="post" action="processbillentry.php" onsubmit="return validate(this)" autocomplete="OFF">
<center><input type="text" name="err" id="err" readonly="readonly" /></center>
<table><tr><td valign="top"><h2>History</h2><div id="history"></div></td><td valign="top">
 <table width="790" border="1" align="center" cellpadding="4" cellspacing="0">
 <tr>
 <td width="146" height="52"><div align="center">Select Client</div></td>
 <td><div align="center">
   <p>
    <select name="cust" id="cust"> 
     <?php
	 include("config.php");
	 $str="Select short_name,contact_first from contacts where type='c' and short_name like '%fis%'";
	 
	  $qry=mysqli_query($con,$str);
	  while($row=mysqli_fetch_row($qry))
	  {
	 // echo "select 1 from ".$row[0]."_ebill";
	  $val = mysqli_query($con,"select 1 from ".$row[0]."_ebill");
if($val !== FALSE)
{
   //DO SOMETHING! IT EXISTS!
   ?>
      <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
      <?php
}
	  
	  }
	   ?>
     </select>
     <!-- <input type="text" name="cust" id="cust" readonly="readonly">-->
   </p>
 </div></td>
    <td width="29"></td>
     <td><div align="center">ATM ID</div></td>
     <td><div align="center"><input type="text" name="atmid" id="atmid" value="<?php echo $row[3]; ?>" onblur="getdetails(this.value,'atm_id1');" />
       
     </div></td>
  </tr> 
  
  <tr>
 <td width="146" height="52"><div align="center">Bank</div></td>
 <td><div align="center">
   <p>
   <select name="bank" id="bank"  style="width:150px">  <option value="" >Select Bank</option>
			   
				<?php
				$bkk="select bank_name,bank from bank order by bank_name ASC";
			   //echo $pojct;
			  $bkkr=mysqli_query($con,$bkk);
 while($bkkro=mysqli_fetch_array($bkkr))
			  {
			  ?>
			  <option value="<?php echo $bkkro[0];  ?>"><?php echo $bkkro[1];  ?></option>
			  <?php
			  }
				/*for($i=0;$i<count($bank);$i++)
				{ ?>
				   <option value="<?php echo $bank[$i]; ?>"><?php echo $bank[$i]; ?></option>
			   <?php }*/ ?> 
			   <option value="">Other Bank</option> 
											 
			   </select>
     <!-- <input type="text" name="bank" id="bank" readonly/>-->
   </p>
 </div></td>
    <td width="29"></td>
     <td><div align="center">Project ID</div></td>
     <td><div align="center">
       <!--<input type="text" name="projectid" id="projectid"  readonly/>-->
       <?php 
			   
			   $pojct="select project from projects where project<>'Other Bank'";
			   //echo $pojct;
			  $pro=mysqli_query($con,$pojct);
			  if(!$pro)
			  echo mysqli_error();
			    ?>
			  <select name="projectid" id="projectid"><option value="Other Bank">Other Bank</option>
			  <?php
			  
			  
			  while($proj=mysqli_fetch_array($pro))
			  {
			  ?>
			  <option value="<?php echo $proj[0];  ?>"><?php echo $proj[0];  ?></option>
			  <?php
			  }
			  ?>
			  </select>
     </div></td>
  </tr>       
 <tr>
 <td width="146" height="52"><div align="center">Address</div></td>
 <td><div align="center">
   <p>
     <textarea name="address" id="address"/></textarea>
   </p>
 </div></td>
    <td width="29"></td>
     <td><div align="center">Distributor</div></td>
     <td><div align="center">
       <!--<input type="text" name="distributor" id="distributor" />-->
       <select name="distributor" id="distributor" style="width:150px"><option value="" width="60px">select Provider</option>
<?php
$sp=mysqli_query($con,"select code,provider from eserviceprovider where status=0 order by provider ASC");
while($spro=mysqli_fetch_array($sp))
{
?>
<option value="<?php echo $spro[0]; ?>"><?php echo $spro[1]." (".$spro[0].")"; ?>
<?php
}
?>
</select>
     </div></td>
  </tr>      
  <tr>
    <td width="146" height="52"><div align="center">Tracker ID</div></td>
    <td width="211"><div align="center">
      <p>
        <input type="text" name="trackid" id="trackid" value="" readonly="readonly" />
        </p>
      </div></td>
  <td width="29"></td>
    <td width="122"><div align="center">Consumer No</div></td>
    <td width="248"><div align="center">
      <p>
      <div id='divcon_no' style="display:block">
       <input type="checkbox" name="cons" id="cons" />&nbsp;&nbsp;Search<br> <input type="text" name="con_no" id="con_no" onblur="getdetails(this.value,'Consumer_No');"  /></div><br />
        <!--<input type="checkbox" name="cons" id="cons" onclick="getdetails(this.value,'Consumer_No');" >&nbsp;&nbsp;
          <div id='divcon_no2' style="display:none">
        <input type="text" name="newcons" id="newcons" >--></div>
      </p>
    </div></td>
  </tr>
  
     <tr>
 <td width="146" height="52"><div align="center">Due DATE (Month in numbers Only)</div></td>
   <td><div align="center">
     <input type="text" name="duedate" id="duedate" />
   </div></td>
    <td width="29">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><div align="center">Landlord</div></td>
     <td><div align="center">
       <p>
         <input type="text" name="landlord" id="landlord" />
       </p>
     </div></td>
    </tr>    
<tr>
 <td width="146" height="52"><div align="center">Billing Unit</div></td>
   <td><div align="center">
     <input type="text" name="billunit"  id="billunit"/>
   </div></td>
    <td width="29">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><div align="center">Meter Number</div></td>
     <td><div align="center">
       <p>
         <input type="text" name="meterno" id="meterno" />
         <!--<input type="text" name="meterno" id="meterno" onblur="getdetails(this.value,'meter_no');" />-->
       </p>
     </div></td>
    </tr>
<tr>
 <td width="146" height="52"><div align="center">Averarge Bill</div></td>
   <td><div align="center">
     <input type="text" name="avgbill" readonly="readonly" id="avgbill"/>
   </div></td>
    <td width="29">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td align="center">Bill Date</td>
     <td align="center"><input type="text" name="bill_date" id="bill_date" onclick="displayDatePicker('bill_date');"  /></td>
</tr>
<tr>
 <td width="146" height="52"><div align="center">Start Date</div></td>
   <td><div align="center">
     <input type="text" name="fromdt" id="fromdt" onclick="displayDatePicker('fromdt');" />
   </div></td>
    <td width="29">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td align="center">End Date</td>
     <td align="center"><input type="text" name="todt" id="todt" onclick="displayDatePicker('todt');" /></td>
</tr>
<tr>
 <td width="146" height="52"><div align="center">Due Date</div></td>
   <td><div align="center">
     <input type="text" name="duedt" id="duedt" onclick="displayDatePicker('duedt');" />
   </div></td>
    <td width="29">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td align="center">Opening Reading</td>
     <td align="center"><input type="text" name="openr" id="openr" onkeyup="calc('openr','closer');"  /></td>
</tr>
<tr>
 <td align="center">Close Reading</td>
     <td align="center"><input type="text" name="closer" id="closer" onkeyup="calc('openr','closer');"  /></td> 
    <td width="29">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td width="146" height="52"><div align="center">Unit</div></td>
   <td><div align="center">
     <input type="text" name="unit" id="unit" />
   </div></td>
    
</tr>
<tr>
 <td width="146" height="52"><div align="center">Extra Charge</div></td>
   <td><div align="center">
     <input type="text" name="extra" id="extra" value="0"/>
   </div></td>
    <td width="29">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td align="center">Amount</td>
     <td align="center"><input type="text" name="amount" id="amount" /></td>
</tr>
<tr>
  <td align="center">Paid Date</td>
     <td align="center"><input type="text" name="paiddt" id="paiddt"  onclick="displayDatePicker('paiddt');"/></td>
 <td width="146" height="52"><div align="center"></div></td>
   <td width="146" height="52"><div align="center">Supervisor</div></td>
   <td><div align="center">
    <select name="sv" id="sv"><option value="-1">Select</option>
			   <?php
			  // $sup=mysqli_query($con,"select username from login where designation='11' and serviceauth='3' and deptid='4' order by username ASC");
			  $sup=mysqli_query($con,"select distinct(hname) from fundaccounts order by hname ASC");
				 while($supro=mysqli_fetch_array($sup))
				{ ?>
				   <option value="<?php echo $supro[0]; ?>" ><?php echo $supro[0]; ?></option>
			   <?php } ?>  
			    </select>
    
   </div></td>
 
   
</tr>
<tr>
  <td align="center">Type</td>
     <td align="left" colspan="5"><select name="ptype" id="ptype"><option value="paid">Paid</option><option value="unpaid">Unpaid</option></select></td>
   
   
</tr>
<tr style="display:none">
  <td align="center" style="display:none">memo</td>
     <td align="center" colspan="3" style="display:none"><textarea name="memo" id="memo"></textarea></td>
   
   <td align="center">Priority<select name="cases" id="cases"  height=20px>
   <option value="" >All</option>
    <option value="Normal" >Normal</option>
     <option value="Very Urgent" >Very Urgent</option>
     <option value="Disconnection" >Disconnection</option>
     </select></td>
   
</tr>

  <tr>
    <td colspan="11" align="center"><input type="hidden" name="stat" id="stat" value="paid"/><input type="submit" value="submit" id="cmdsub" name="cmdsub" />
   <!-- <input type="submit" name="cmdapp" id="cmdapp" value="Send for Approval" /> -->
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <!--<a href="electricbills.php">cancel</a>-->  
      <input type="button" name="update" id="update" value="Update" onclick="updateData();" />
    </td>
  </tr>
</table>
</td></tr></table>
</form>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>