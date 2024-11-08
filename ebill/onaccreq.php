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
<title>New Site</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>

 
 
 
 
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
if(unit.value=='' || unit.value<0)
{
alert("Please Enter Proper Unit Number ");
unit.focus();
return false;
}
if(amount.value=='')
{
alert("Please Select Due Date ");
amount.focus();
return false;
}
if(paiddt.value=='')
{
alert("Please Select Paid Date ");
paiddt.focus();
return false;
}
return true;
}
}

function getdetails(val,type)
{
//alert(val+" "+type);
//alert(document.getElementById('cust').value);
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
//document.getElementById('flag').value='1';
}
else
{

//document.getElementById('flag').value='0';
//alert(s2[0]);
document.getElementById('err').value='';

document.getElementById('con_no').value=s2[0];
document.getElementById('address').value=s2[8];
document.getElementById('trackid').value=s2[9];
document.getElementById('distributor').value=s2[1];
document.getElementById('duedate').value=s2[3];
document.getElementById('landlord').value=s2[4];
document.getElementById('billunit').value=s2[5];
document.getElementById('meterno').value=s2[6];
document.getElementById('avgbill').value=s2[7];
document.getElementById('bank').value=s2[10];
if(document.getElementById('atmid').value=='')
document.getElementById('atmid').value=s2[2];

document.getElementById('cmdsub').disabled=false;
document.getElementById('cust').value=s2[10];

gethistory(s2[9],s2[10],s2[2]);
}


    }
  }
if(val!='')
{
  var cid=document.getElementById('cust').value;
//alert("getebdetails.php?val="+val+"&type="+type+'&cid='+cid);
xmlhttp.open("GET","getebdetails.php?val="+val+"&type="+type+'&cid='+cid,true);
xmlhttp.send();
}
	
}

function checkdt(val,tbl)
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
//alert("chkbilldt.php?val="+val+"&tbl="+tbl+"&cid="+cid+'&atmid='+atmid+'&trackid='+trackid);
xmlhttp.open("GET","chkbilldt.php?val="+val+"&tbl="+tbl+"&cid="+cid+'&atmid='+atmid+'&trackid='+trackid,true);
xmlhttp.send();}
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
if((openre!='' || openre!='0') && (closr!='' || closr!='0'))
{
document.getElementById('unit').value=(Number(closr)-Number(openre));
}
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
<div align="center" id="Error"><?php if(isset($_SESSION['success'])){ echo $_SESSION['success']; }  ?></div>
<form id="form1" name="form1" method="post" action="processaccreq.php" onsubmit="return validate(this)" autocomplete="OFF">


 <table width="790" border="1" align="center" cellpadding="4" cellspacing="0">
<tr>
   <td width="146" height="52">Date</td>
  <td width="146" height="52" align="center"><input type="text" name="dt" id="dt" onclick="displayDatePicker('dt');"></td>
</tr>
<tr>
 
   <td width="146" height="52"><div align="center">Supervisor</div></td>
   <td><div align="center">
     <select name="sv" id="sv" ><option value="-1" >Select</option>
     <?php
     include("config.php");
    $sup=mysqli_query($con,"select aid,hname,accno from fundaccounts where status='0' order by hname ASC");
     while($supro=mysqli_fetch_array($sup))
     {
     ?>
     <option value="<?php echo $supro[0]; ?>" ><?php echo $supro[1]." (".$supro[2].")"; ?></option>
     <?php
     }
     ?>
     
     </select>
   </div></td>
 
</tr>
<tr>
<td>Amount</td>
<td colspan="4"><input type="text" name="amt" id="amt" value="0"></td>
</tr>
<tr>
<td>Comments:</td><td><textarea name="memo" id="memo"></textarea></td>
</tr>
  <tr>
    <td colspan="4" align="center"><input type="submit" value="submit" id="cmdsub" name="cmdsub" />
    
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <!--<a href="electricbills.php">cancel</a>-->      </td>
  </tr>
</table>

</form>
<?php
if(isset($_SESSION['success']))
unset($_SESSION['success']);
?>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>