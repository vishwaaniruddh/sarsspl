<?php ini_set( "display_errors", 0);

include("access.php");


// header('Location:managesite1.php?id='.$id); 
 
include("config.php");

$result1 = mysqli_query($con,"SELECT contact_first, short_name FROM contacts where type='c' order by short_name ASC");		
$result2 = mysqli_query($con,"SELECT DISTINCT bank FROM sites");		
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sites</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script src="excel.js" type="text/javascript"></script>

<script type="text/javascript">
function makeinactive(id,val,cid)
{
	//alert(val+" "+id+" "+cid);
if(confirm("Do you really want to edit this site?")){
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
//document.getElementById('active'+id).innerHTML='';
	document.getElementById('active'+id).innerHTML=xmlhttp.responseText;
	
	
    }
  }
 //alert("mkinactive.php?val="+val+"&id="+id+"&cid="+cid);
xmlhttp.open("GET","mkinactive.php?val="+val+"&id="+id+"&cid="+cid,true);
xmlhttp.send();

}	
}
function getbank(val)
{
	//alert(val);
var cid=document.getElementById('cid').value;

	//alert(val+" "+cid);
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
	
	
    }
  }
  ///alert("getsitebank.php?proj="+val+"&cid="+cid);
xmlhttp.open("GET","getsitebank.php?proj="+val+"&cid="+cid,true);
xmlhttp.send();

	
}
function getproj(cid)
{
	//alert(cid);


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
document.getElementById('project').innerHTML='';
	document.getElementById('project').innerHTML=xmlhttp.responseText;
	
	
    }
  }
  //alert("getcustbank.php?val="+val);
 // alert("getproject.php?cid="+cid);
xmlhttp.open("GET","getproject.php?cid="+cid,true);
xmlhttp.send();

	
}
///////////////////////////////search 
function searchById(a,b,perpg) {
//alert(a+" "+b+" "+perpg);
if(document.getElementById('cid').value=='')
alert("Please select Client");
else
{
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
	
			 if(a!="Loading"){
			 var id=document.getElementById('atmid').value;//alert(id);
			 var cid=document.getElementById('cid').value;//alert(cid);
			 var proj=document.getElementById('project').value;
			 var bank=document.getElementById('bank').value;//alert(bank);
			 var address=document.getElementById('address').value;
			 
			 var area=document.getElementById('area').value;//alert(area);
			 var zone=document.getElementById('zone').value;
			 var dt=document.getElementById('date').value;
			 var dt2=document.getElementById('date2').value;
			  }
			 // alert(br);
			//alert("gg"); 
			var url = 'managesite_data.php'; 
		//  }
 	//alert(br);
 	//alert(dt);
		    var pmeters="";
			//alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			if(a!="Loading"){ 
			 pmeters = 'atmid='+id+'&cid='+cid+'&area='+area+'&bank='+bank+'&Page='+b+'&perpg='+ppg+'&service='+service+"&address="+address+"&zone="+zone+"&dt="+dt+"&dt2="+dt2+"&project="+proj;
			// alert(pmeters);
			}
			else
			{
				 pmeters = 'br='+br+'&Page='+b+'&perpg='+ppg+'&service='+service;
			}
			//alert(pmeters);
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
  }
</script>
</head>
<body onload="<?php if(isset($_GET['cid'])){ ?>getproj('<?php echo $_GET['cid']; ?>');searchById('Listing','1',''); <?php } ?>" >


<center>
<?php include("menubar.php");
//echo $_SESSION['branch'];
 ?>


  <h2 class="style1">MANAGE SITES</h2>
<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>
<p align="center">

           <select name="cid" id="cid" onchange="getproj(this.value);" ><option value="">select Client</option>
           <?php while($row1 = mysqli_fetch_row($result1)){ ?>
                                           <option value="<?php echo $row1[1]; ?>"<?php if(isset($_GET['cid']) && $_GET['cid']==$row1[1]){ ?> selected <?php }  ?> ><?php echo $row1[0]; ?></option>
           <?php } ?>   </select>
           <select name="project" id="project" onchange="getbank(this.value);" >
           
                                           <option value="" >Select Project</option>
           </select>
          <select name="bank" id="bank" onchange="" ><option value="">select Bank</option>
           </select>
           <!--<input type="text" name="bank" id="bank" onkeyup="" placeholder="Bank"/>-->
    <input type="text" name="atmid" id="atmid" onkeyup="" placeholder="ATM"/>
   
    <input type="text" name="area" id="area" onkeyup="" placeholder="location"/> 
    <input type="text" name="address" id="address" onkeyup="" placeholder="Address"/> 
    <input type="text" name="zone" id="zone" onkeyup="" placeholder="Zone"/>         
    <!--<input type="text" name="service" id="service" onkeyup="" placeholder="Service"/>-->
    <select name="service" id="service" onchange="">
    <option value="">Select Service</option>
    <option value="1">House Keeping</option>
    <option value="2">care taker</option>
    <option value="3">Maintenance</option>
    <option value="4">Ebill</option>
    
    </select>     <br />
      <input type="text" name="date" id="date" placeholder="From date" onclick="displayDatePicker('date');"  />
      <input type="text" name="date2" id="date2" placeholder="T0 date" onclick="displayDatePicker('date2');"  />  
      <input type="button" onclick="searchById('Listing','1','');" value="Search">                     
</p>
<!--<p>&nbsp;<a href="exportallsite.php" >Export All Data</a></p>-->

</center>
<div id="search">

</div>

<script type="text/javascript" src="1.7.2.jquery.min.js"></script>

<script type="text/javascript" src="script.js"></script>
</body>
</html>