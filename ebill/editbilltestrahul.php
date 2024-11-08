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
<title>Edit</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script type="text/javascript">

function caldiff()
{
var bmt=document.getElementById('bamt').value;

var afmt=document.getElementById('adtamt').value;
//alert(bmt+""+afmt);
if(bmt!="" & afmt!="")
{
var diffem=parseInt(afmt)-parseInt(bmt);
document.getElementById('after_duedt_chrg').value=diffem;

}

}




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
if(Number(document.getElementById("chck_cnt").value)>0)
{
	if(memo.value=='')
	{
		alert("Remarks is compulsory");
		memo.focus();
		return false;
	}	
}
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
if(cust1.value=='Tata05')
{
if(document.getElementById('tata').value==''){
alert("Please Select type for Tata");
return false;
}
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
//alert(new Date(paiddt.value).getTime()+" "+new Date(billdt.value).getTime()+" "+new Date().getTime());
var paid = paiddt.value.split("/");
var paid2 = new Date(arrStartDate[2], arrStartDate[1], arrStartDate[0]);
var bill = billdt.value.split("/");
var bill2 = new Date(arrEndDate[2], arrEndDate[1], arrEndDate[0]);
if((new Date(paid2).getTime() <= new Date(bill2).getTime()) || (new Date(paid2).getTime() > new Date().getTime()))
{
alert("Invalid Dates");
return false;
stdt.focus();
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
  function isNumberKey(evt)
{
var charCode = (evt.which) ? evt.which : event.keyCode;
if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
return false;
 
return true;
}
function chrg_chck(id)
{
	//alert(id);
	if(document.getElementById(id).checked == true)
	{
		var cnt=Number(document.getElementById("chck_cnt").value);
		cnt+=1;
		document.getElementById("chck_cnt").value=cnt;
	}
	else
	{
		var cnt=Number(document.getElementById("chck_cnt").value);
		cnt-=1;
		document.getElementById("chck_cnt").value=cnt;
	}
}
</script>

</head>

<body><!--old -->

<center>
<?php include("menubar.php");
//echo "select start_date,end_date,bill_date,due_date,opening_reading,closing_reading,unit from ebillfundrequests where req_no='".$_GET['reqid']."'";
$req=mysqli_query($con,"select start_date,end_date,bill_date,due_date,opening_reading,closing_reading,unit,cust_id,atmid,trackerid,approvedamt,`recon_chrg`,`discon_chrg`,`sd`,`after_duedt_chrg`, `extrachrg_stat`, `recon_chrg_stat`, `discon_chrg_stat`, `sd_stat`, `after_duedt_chrg_stat`,bill_amt,afdt_amt,trans_id from ebillfundrequests where req_no='".$_GET['reqid']."'");

$reqro=mysqli_fetch_array($req);
//echo "select * from ebpayment where Bill_No='".$_GET['reqid']."'";
$pd=mysqli_query($con,"select * from ebpayment where Bill_No='".$_GET['reqid']."'");
$pdro=mysqli_fetch_row($pd);

$site=mysqli_query($con,"select bank,projectid from ".$reqro[7]."_sites where trackerid='".$reqro[9]."'");
$sitero=mysqli_fetch_row($site);
//echo $_SESSION['branch'];
 //echo $_SESSION['designation']." ".$_SESSION['serviceauth']." ".$_SESSION['dept'];
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation']." ".$_SESSION['dept']." ".$_SESSION['serviceauth']
 ?>
 
 <center>
<form name="frmeb" method="post" action="procedtebdettestrahul.php" onsubmit="return validate(this);">
<input type="hidden" name="reqno" id="reqno" value="<?php echo $_GET['reqid']; ?>">
<input type="hidden" name="page" id="page" value="<?php if(isset($_GET['page'])){ echo $_GET['page']; }  ?>">
<input type="hidden" name="cid" id="cid" value="<?php echo $_GET['cid']; ?>">

<table><tr><td valign="top" id="blockreq"></td><td valign="top">

<table>
<tr><td> Cust ID</td><td><input type="hidden" name="cust1" id="cust1" value="<?php echo $reqro[7]; ?>"/><?php echo $reqro[7]; ?></td></tr>
<tr><td> Atm ID</td><td><?php echo $reqro[8]; ?></td></tr>
<tr><td> Bank</td><td><?php echo $sitero[0]; ?></td></tr>
<tr><td> Project ID</td><td><?php echo $sitero[1]; ?></td></tr>
<tr><td>Transferred Amount</td><td><?php echo $reqro[10]; ?></td></tr>
<tr><td> Docket No</td><td><?php echo $_GET['reqid']; ?></td></tr>
<tr><td> Start Date</td><td><input type="text" name="stdt" id="stdt" value="<?php if($reqro[0]!='0000-00-00'){ echo date('d/m/Y',strtotime($reqro[0]));} ?>" onclick="displayDatePicker('stdt');" ></td></tr>
<tr><td> Bill From</td><td><input type="text" name="billfrmdt" id="billfrmdt" value="<?php if($reqro[0]!='0000-00-00'){ echo date('d/m/Y',strtotime($reqro[0]));} ?>" onclick="displayDatePicker('billfrmdt');" onblur="blockinv(this.value,'<?php echo $_GET['reqid'] ?>');" ></td></tr>
<tr><td> End Date</td><td><input type="text" name="enddt" id="enddt" value="<?php  if($reqro[1]!='0000-00-00'){ echo  date('d/m/Y',strtotime($reqro[1]));} ?>" onclick="displayDatePicker('enddt');" onblur="blockinv(this.value,'<?php echo $_GET['reqid'] ?>');"></td></tr>
<tr><td>Bill  Date</td><td><input type="text" name="billdt" id="billdt" value="<?php  if($reqro[2]!='0000-00-00'){ echo  date('d/m/Y',strtotime($reqro[2]));} ?>" onclick="displayDatePicker('billdt');"></td></tr>
<tr><td>Due Date</td><td><input type="text" name="duedt" id="duedt" value="<?php  if($reqro[3]!='0000-00-00'){ echo  date('d/m/Y',strtotime($reqro[3]));} ?>" onclick="displayDatePicker('duedt');"></td></tr>

<tr><td>Opening Reading</td><td><input type="text" name="openread" id="openread" value="<?php echo $reqro[4]; ?>" onkeyup=calc();></td></tr>
<tr><td>Closing Reading</td><td><input type="text" name="closeread" id="closeread" value="<?php echo $reqro[5]; ?>" onkeyup=calc();></td></tr>
<tr><td>Unit</td><td><input type="text" name="unit" id="unit" value="<?php echo $reqro[6]; ?>" readonly></td></tr>

<tr><td>Paid Date</td><td><input type="text" name="paiddt" id="paiddt" value="<?php if(mysqli_num_rows($pd)>0){ echo date('d/m/Y',strtotime($pdro[2]));} ?>" onclick="displayDatePicker('paiddt');"></td></tr>
<tr><td>Paid Amount(Amount To be received from Customer)</td><td><input type="text" name="paidamt" id="paidamt" required value="<?php if(mysqli_num_rows($pd)>0){ echo $pdro[1];} ?>" onkeypress="return isNumberKey(event);" /></td></tr>

<tr>
<td >Bill Amount</td>
<td>
     <input type="text" name="bamt" id="bamt" value="<?php  echo $reqro[20]; ?>"/>
  </td>
    </tr>
    <tr>
     <td >After Due Date Amount</td>
     <td ><input type="text" name="adtamt" id="adtamt"  value="<?php  echo $reqro[21];?>" onblur="caldiff()"/></td>



</tr>
<tr>  <td >Transaction ID</td>
     <td><input type="text" name="trsid" id="trsid" value="<?php  echo $reqro[22]; ?>" /></td>
</tr>



!---<tr>
	<td>Extra Charge(Charges After due date)</td>
	<td><input type="text" name="xtrachrg" id="xtrachrg" value="<?php if(mysqli_num_rows($pd)>0){ echo $pdro[7];} ?>"></td>
	<td><input type="checkbox" name="extrachrg_stat" id="extrachrg_stat" <?php if($reqro['extrachrg_stat']==1){ echo "checked"; }?> onchange="chrg_chck(this.id);" /></td>
</tr>--->
<tr>
	<td>Reconnection Charge:</td>
	<td><input type="text" name="recon_chrg" id="recon_chrg" value="<?php echo $reqro['recon_chrg']; ?>" onkeypress="return isNumberKey(event);" /></td>
	<td><input type="checkbox" name="recon_chrg_stat" id="recon_chrg_stat" <?php if($reqro['recon_chrg_stat']==1){ echo "checked"; }?> onchange="chrg_chck(this.id);" /></td>
</tr>
<tr>
	<td>Disconnection Charge:</td>
	<td><input type="text" name="discon_chrg" id="discon_chrg" value="<?php echo $reqro['discon_chrg']; ?>" onkeypress="return isNumberKey(event);" /></td>
	<td><input type="checkbox" name="discon_chrg_stat" id="discon_chrg_stat" <?php if($reqro['discon_chrg_stat']==1){ echo "checked"; }?> onchange="chrg_chck(this.id);" /></td>
</tr>
<tr>
	<td>Security Deposit:</td>
	<td><input type="text" name="sd" id="sd" value="<?php echo $reqro['sd']; ?>" onkeypress="return isNumberKey(event);" /></td>
	<td><input type="checkbox" name="sd_stat" id="sd_stat" <?php if($reqro['sd_stat']==1){ echo "checked"; }?> onchange="chrg_chck(this.id);" /></td>
</tr>
<tr>
	<td>After due date charges:</td>
	<td><input type="text" name="after_duedt_chrg" id="after_duedt_chrg" value="<?php echo $reqro['after_duedt_chrg']; ?>" onkeypress="return isNumberKey(event);" /></td>
	<!--<td><input type="checkbox" name="after_duedt_chrg_stat" id="after_duedt_chrg_stat" <?php if($reqro['after_duedt_chrg_stat']==1){ echo "checked"; }?> onchange="chrg_chck(this.id);" /></td>-->
	<input type="hidden" id="chck_cnt" value="0";/>
</tr>
<tr><td colspan="2"><input type="radio" name='paid' id='paid' value='paid' checked>&nbsp;Paid &nbsp;<input type="radio" name='paid' id='paid' value='unpaid' >  Unpaid</td></tr>
<tr><td colspan="2"><a href="<?php echo "reject_update_paidbill.php?reqid=".$_GET['reqid']; ?>">Reject</a><br></td></tr>
<tr><td>Remarks:</td><td><input type="text" name="memo" id="memo" placeholder="memo" ></td></tr>
<tr><td colspan="2"><input type="submit" name="cmdsub" id="cmdsub" value="Edit" ></td></tr>
</table></td></tr></table>
</form>
</center>
 </center>




<div id="search">

</div>


<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>