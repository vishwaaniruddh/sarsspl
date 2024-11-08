<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function confirm_delete(id)
{
	if (confirm("Are you sure you want to delete this entry?"))
	{
		document.location="delete_site.php?id="+id;
	}
	
}


///////////////////////////////search 
function searchById(a,b) {
//alert(a);
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
		 /* if(document.getElementById('idd').value=="" && document.getElementById('fname22').value=="")
		  {
			  var url = 'get_docID.php';
		  }else   if(document.getElementById('fname22').value==""){
			  
			  var s=document.getElementById('idd').value;
			var url = 'get_docID.php?id='+s;
		  } else if(document.getElementById('idd').value==""){
			  
			   var s=document.getElementById('fname22').value;
			var url = 'get_docID.php?fname='+s;
		  } else{*/
			 // var id=document.getElementById('idd').value;//alert(id);
			 if(a!="Loading"){
			 var id=document.getElementById('id').value;//alert(id);
			 var cid=document.getElementById('cid').value;//alert(cid);
			  var bank=document.getElementById('bank').value;//alert(bank);
			 var city=document.getElementById('city').value;//alert(city);
			  var area=document.getElementById('area').value;//alert(area);
			 var state=document.getElementById('state').value;//alert(state);
			 var pin=document.getElementById('pin').value;//alert(pin);
			 var sdate=document.getElementById('sdate').value;//alert(sdate);
			 var edate=document.getElementById('edate').value;//alert(edate);
			  }
			//alert("gg"); 
			var url = 'search_site.php';
		//  }
 	
		var pmeters="";
			//alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			if(a!="Loading"){ 
			 pmeters = 'id='+id+'&cid='+cid+'&city='+city+'&state='+state+'&area='+area+'&pin='+pin+'&sdate='+sdate+'&edate='+edate+'&area='+area+'&bank='+bank;
			}//alert("gg");
			HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
 
//alert("gg"); 
			HttPRequest.onreadystatechange = function()
			{
 /*
			if(HttPRequest.readyState == 3)  // Loading Request
				  {
	document.getElementById("listingAJAX").innerHTML = '<img src="loader.gif" align="center" />';
				  }
 */
				 if(HttPRequest.readyState == 4) // Return Request
				  {
		var response = HttPRequest.responseText;
 
 //alert(response);
				  document.getElementById("search").innerHTML = response;
			  }
		}
  }
</script>
</head>

<body onLoad="searchById('Loading','1')">
<center>
<h2>View Site</h2>
<div id="header">
<table  border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="se">
<tr>

<td width="77"><input type="text" name="cid" id="cid" onkeyup="searchById('Listing','1');" placeholder="Customer"/></td>
<td width="145"><input type="text" name="bank" id="bank" onkeyup="searchById('Listing','1');" placeholder="Bank"/></td>
<td width="75"><input type="text" name="area" id="area" onkeyup="searchById('Listing','1');" placeholder="Area"/></td>
<td width="75"><input type="text" name="city" id="city" onkeyup="searchById('Listing','1');" placeholder="City"/></td>
<td width="75"><input type="text" name="state" id="state" onkeyup="searchById('Listing','1');" placeholder="State"/></td>
<td width="75"><input type="text" name="pin" id="pin" onkeyup="searchById('Listing','1');" placeholder="Pincode"/></td>
<td width="75"><input type="text" name="id" id="id" onkeyup="searchById('Listing','1');" placeholder="ATM"/></td>
<td width="75"><input type="text" name="sdate" id="sdate"  onkeyup="searchById('Listing','1');" placeholder="From Date"/></td>
<td width="75"><input type="text" name="edate" id="edate"  onkeyup="searchById('Listing','1');" placeholder="To Date"/></td>
</tr>



</table>
<div id="search"></div>
</div>
</center>
</body>
</html>