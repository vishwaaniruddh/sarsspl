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

function recbill(val,reqid)

{

	//alert(val);

mysqli_

//alertmysqli_

	docmysqli_getElementById('billdet').innerHTML="<center><img src='loading.gif' width='100px' height='50px'></center>";
mysqli_
		if (window.XMLHttpRequest)
mysqli_
  {// comysqli_ IE7+, Firefox, Chrome, Opera, Safari
mysqli_
  xmlhttpmysqli_MLHttpRequest();

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

	document.getElementById('billdet').innerHTML=xmlhttp.responseText;

   }
mysqli_
  }



//alert("getebillproj.php?val="+val+"&type="+type);

xmlhttp.open("GET","getformext.php?val="+val+"&reqid="+reqid,true);

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



<body onload="recbill('1')"><!--old -->



<center>

<?php include("menubar.php");

//echo "select start_date,end_date,bill_date,due_date,opening_reading,closing_reading,unit from ebillfundrequests where req_no='".$_GET['reqid']."'";

$req=mysql_query("select start_date,end_date,bill_date,due_date,opening_reading,closing_reading,unit,cust_id,atmid,trackerid,approvedamt from ebillfundrequests where req_no='".$_GET['reqid']."'");



$reqro=mysql_fetch_row($req);

//echo "select * from ebpayment where Bill_No='".$_GET['reqid']."'";

$pd=mysql_query("select * from ebpayment where Bill_No='".$_GET['reqid']."'");

$pdro=mysql_fetch_row($pd);



$site=mysql_query("select bank,projectid from ".$reqro[7]."_sites where trackerid='".$reqro[9]."'");

$sitero=mysql_fetch_row($site);

$ebill=mysql_query("select meter_no,Consumer_No from ".$reqro[7]."_ebill where atmtrackid='".$reqro[9]."'");

$ebillro=mysql_fetch_row($ebill);



//echo $_SESSION['branch'];

 //echo $_SESSION['designation']." ".$_SESSION['serviceauth']." ".$_SESSION['dept'];

//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation']." ".$_SESSION['dept']." ".$_SESSION['serviceauth']

 ?>

 

 <center>

<form name="frmeb" method="post" action="processcoupan.php" onsubmit="return validate(this);">

<input type="hidden" name="reqno" id="reqno" value="<?php echo $_GET['reqid']; ?>">

<input type="hidden" name="page" id="page" value="<?php if(isset($_GET['page'])){ echo $_GET['page']; }  ?>">

<input type="hidden" name="cid" id="cid" value="<?php echo $_GET['cid']; ?>">

<table><tr><td valign="top" id="blockreq"></td><td valign="top">



<table>

<tr><td> Cust ID</td><td><?php echo $reqro[7]; ?></td></tr>

<tr><td> Atm ID</td><td><?php echo $reqro[8]; ?></td></tr>

<tr><td> Bank</td><td><?php echo $sitero[0]; ?></td></tr>

<tr><td> Project ID</td><td><?php echo $sitero[1]; ?></td></tr>

<tr><td>Transferred Amount</td><td><?php echo $reqro[10]; ?></td></tr>

<tr><td> Docket No</td><td><?php echo $_GET['reqid']; ?></td></tr>

<tr><td> Meter Number</td><td><?php echo $ebillro[0]; ?></td></tr>

<tr><td> Consumer Number</td><td><?php echo $ebillro[1]; ?></td></tr>

<tr><td> Number of receipt(only numbers)</td><td><input type="text" name="reccnt" id="reccnt" value="1" onblur="recbill(this.value,'<?php echo $_GET['reqid']; ?>');"></td></tr>

<tr><td colspan="2"><div id="billdet"></div><input type="hidden" name='paid' id='paid' value='paid'></td></tr>

<tr><td>Paid Date</td><td><input type="text" name="pdt" id="pdt" value="<?php if(mysql_num_rows($pd)>0){ echo date('d/m/Y',strtotime($pdro[2]));} ?>" onclick="displayDatePicker('pdt');"></td></tr>

<!--<tr><td>Total:</td><td><input type="text" name="total" id="total" value="0" readonly="readonly" ></td></tr>-->

<tr><td>Remarks:</td><td><input type="text" name="memo" id="memo" placeholder="memo" ></td></tr>

<tr><td colspan="2"><input type="submit" name="cmdsub" id="cmdsub" value="Save" ></td></tr>

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