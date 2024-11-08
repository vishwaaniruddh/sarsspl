<?php ini_set( "display_errors", 0);
session_start();
include("access.php");
?>

<?php
//echo $_SESSION['user']." ".$_SESSION['designation'];

// header('Location:managesite1.php?id='.$id); 
 
include("config.php");

	
		
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Customer Payment</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script type="text/javascript">
function validate1(form1){
 with(form1)
 {
  
/*if ( form1.comp.selectedIndex == 0 )
 { alert ( "Please select Company Name." );
 comp.focus();
  return false;
} */
/*if(bid.value=='')
{
alert("Please Select Bank");
return false;
}*/
//alert(cust.value);
if(cust.value=='EUR08')
{
if(type.value==''){
alert("Please Select type for Euronet");
return false;
}
}
}
 return true;
 }
 </script>
 <script type="text/javascript">
function getbank(val,type)
{
	//alert(val);

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
		
//alert(xmlhttp.responseText);
document.getElementById('bank').innerHTML='';
	document.getElementById('bank').innerHTML=xmlhttp.responseText;
	if(val=='EUR08')
	document.getElementById('type').style.display='';
	else
	document.getElementById('type').style.display='none';
	
	if(val=='Tata05')
	document.getElementById('tata').style.display='';
	else
	document.getElementById('tata').style.display='none';
	
	getproject(val,'projectid');
	
    }
  }

xmlhttp.open("GET","getcustbank.php?val="+val+"&type="+type,true);
xmlhttp.send();
//alert("getcustbank.php?val="+val+"&type="+type);
	
}
function blockinv(val,reqid)
{
//alert(val+" "+reqid);
if(val!=''){
var billfrom=document.getElementById('billfrmdt').value;
var todt=document.getElementById('enddt').value;
if(billfrom!='' && todt!=''){
//alert("hi");
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

	document.getElementById('blockreq').innerHTML=xmlhttp.responseText;
 }
  }
//alert("hello");
//alert("getblockreq.php?billfrm="+billfrom+"&todt="+todt+"&reqid="+reqid);
xmlhttp.open("GET","getblockreq.php?billfrm="+billfrom+"&todt="+todt+"&reqid="+reqid,true);

xmlhttp.send();
}
}	
}
function getproject(val,type)
{
	//alert(val);

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
		
//alert(xmlhttp.responseText);
document.getElementById('proj').innerHTML='';
	document.getElementById('proj').innerHTML=xmlhttp.responseText;
	
	
    }
  }

//alert("getebillproj.php?val="+val+"&type="+type);
xmlhttp.open("GET","getebillproj.php?val="+val+"&type="+type,true);
xmlhttp.send();

	
}
function searchById(a,b,perpg) {
//alert(a+" "+b+" "+perpg);
var ppg='';
if(perpg=='')
ppg='50';
else
ppg=document.getElementById(perpg).value;
document.getElementById("search").innerHTML ="<center><img src=loader.gif></center>";
		  HttPRequest = false;
		  if (window.XMLHttpRequest) { // Mozilla, Safari,...
			 HttPRequest = new XMLHttpRequest();
			 if (HttPRequest.overrideMimeType) {
				HttPRequest.overrideMimeType('text/html');
			 }
		  } else if (window.ActiveXObject) { // IE
			 try {
				HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
				try {
				   HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {}
			 }
		  } 
 
		  if (!HttPRequest) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
		  }
		 // var br=document.getElementById('br').value;
		  var service=document.getElementById('service').value;
		//  var calltype=document.getElementById('calltype').value;
	var type='';
	var tata='';
			 if(a!="Loading"){
			 var id=document.getElementById('atmid').value;//alert(id);
			 var cid=document.getElementById('cid').value;//alert(cid);
			 var bank=document.getElementById('bank').value;//alert(bank);
			 var address=document.getElementById('address').value;
			 var proj=document.getElementById('proj').value;
			 var area=document.getElementById('area').value;//alert(area);
			 var zone=document.getElementById('zone').value;
			  var dt=document.getElementById('date').value;
			 var dt2=document.getElementById('date2').value;
			 if(cid=='EUR08')
			 type=document.getElementById('type').value;
			 
			  if(cid=='Tata05')
			 tata=document.getElementById('tata').value;
			  }
			 // alert(br);
			//alert("gg"); 
			var url = 'searcholdebinvoice.php'; 
		//  }
 	//alert(br);
		    var pmeters="";
			//alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			if(a!="Loading"){ 
			 pmeters = 'atmid='+id+'&cid='+cid+'&area='+area+'&bank='+bank+'&Page='+b+'&perpg='+ppg+"&address="+address+"&zone="+zone+"&dt="+dt+"&dt2="+dt2+"&proj="+proj+'&type='+type+'&tata='+tata;
			// alert(pmeters);
			}
			else
			{
				 pmeters = 'br='+br+'&Page='+b+'&perpg='+ppg;
			}
		//	alert(pmeters);
			HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
 
//alert(pmeters); 
			HttPRequest.onreadystatechange = function()
			{
 
				 if(HttPRequest.readyState == 4) // Return Request
				  {
		var response = HttPRequest.responseText;
 
 //alert(response);
				  document.getElementById("search").innerHTML = response;
			  }
		}
  }
  function calc()
  {
  //alert("hi");
  document.getElementById("unit").value=Number(document.getElementById("closeread").value)-Number(document.getElementById("openread").value);
  }
  
  function validate(form)
  {
  //alert("hi");
  with(form)
{
if(stdt.value=='')
{
alert("Start Date cannot be left Blank");
return false;
stdt.focus();
}
if(billfrmdt.value=='')
{
alert("Bill from Date cannot be left Blank");
return false;
billfrmdt.focus();
}
if(enddt.value=='')
{
alert("End Date cannot be left Blank");
return false;
enddt.focus();
}
if(billdt.value=='')
{
alert("Bill Date cannot be left Blank");
return false;
billdt.focus();
}
if(duedt.value=='')
{
alert("Due Date cannot be left Blank");
return false;
duedt.focus();
}
if(paiddt.value=='')
{
alert("Paid Date cannot be left Blank");
return false;
paiddt.focus();
}
if(paidamt.value=='')
{
alert("Paid Amount cannot be left Blank");
return false;
paidamt.focus();
}
/*var stdt2=stdt.value;
var enddt2=enddt.value;
var st=stdt2.split("/");
var endd=enddt2.split("/");
    var d1 = new Date("+st[2]+"-"+st[1]+"-"+st[0]+");
var d2 =new Date("+endd[2]+"-"+endd[1]+"-"+endd[0]+");

    alert(d1+" "+d2);
if(new Date(stdt.value).getTime() >= new Date(endt.value).getTime() || new Date(enddt.value).getTime() > new Date(billdt.value).getTime() || new Date(billdt.value).getTime() > new Date(duedt.value).getTime())
{
   alert("Invalid Dates");
   return false;
}*/


}
return true;
  }
</script>

</head>

<body><!--old -->

<center>
<?php include("menubar.php");?>

<div id="search">
<form name="" method="post" action="">
	<table>
		<tr>
        	<td>Select Client :</td>
            <td>
            	<?php $sql2="select distinct `cust_id` from ebillfundrequests where 1";
if($_SESSION['custid']!='all')
{
if($_SESSION['designation']!="11")
$sql2.=" and `cust_id` in (".$cl.")";
else
{
$sr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
$srro=mysqli_fetch_row($sr);
$sql2.=" and `reqby` in (".$srro[0].")";
}

}

$sql="select `short_name`,`contact_first` from contacts where `type`='c' and `short_name` in ($sql2) order by contact_first ASC ";
//$sql="select `short_name`,`contact_first` from contacts where `type`='c' order by contact_first ASC ";
//echo $sql;
$qry=mysqli_query($con,$sql);
//$qry=mysqli_query($con,"Select short_name,contact_first from contacts where type='c' and short_name='".$_SESSION['custid']."'");

 ?>
 <select  name="cid" id="cid"><option value="">Select Client</option>

<?php
while($clro=mysqli_fetch_row($qry))
{
?>
<option value="<?php echo $clro[0]; ?>"><?php echo $clro[1]; ?></option>
<?php
}
?>
</select>
            </td>
        </tr>
      	<tr>
        	<td>Invoice Number :</td>
            <td>
            	<select name="invoiceno" id="invoiceno" style="width:150px">
            		<option value="">Select Invoice</option>
                </select>
            </td>
        </tr>
        <tr>
        	<td>Amount :</td>
            <td><input type="text" disabled="disabled" name="amt"/></td>
        </tr>
        <tr><td>Paid Date</td><td><input type="text" name="paiddt" id="paiddt" onclick="displayDatePicker('paiddt');"></td></tr>
        <tr>
        	<td>Paid Amount :</td>
            <td><input type="text" onkeypress="return isNumberKey(event)" name="paidamt"/></td>
        </tr>
        <tr>
        	<td>Tax Deduction :</td>
            <td><input type="text" onkeypress="return isNumberKey(event)" name="tax"/></td>
        </tr>
        <tr>
        	<td style="text-align:center"><input type="submit" value="Update"/></td>
        </tr>
	</table>
</form>
</div>

</center>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>