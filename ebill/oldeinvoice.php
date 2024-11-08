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
<title>View Invoice</title>
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
		   var inv=document.getElementById('invoice').value;
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
			 var invoice_no=document.getElementById('invoice_no').value;
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
			 pmeters = 'atmid='+id+'&cid='+cid+'&area='+area+'&bank='+bank+'&Page='+b+'&perpg='+ppg+"&address="+address+"&zone="+zone+"&dt="+dt+"&dt2="+dt2+"&proj="+proj+'&type='+type+'&tata='+tata+'&invoice='+inv+'&invoice_no='+invoice_no;
			// alert(pmeters);
			}
			else
			{
				 pmeters = 'br='+br+'&Page='+b+'&perpg='+ppg+'&invoice='+inv;
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
  

function clsfuncc(sendid,yr,btnid)
{
//alert(sendid);
var conf=confirm('Do you really want to close the invoice?');
    

if(conf==true)
{

$.ajax({
   type: 'POST',    
url:'closeinvoicenew.php',
data:'sendid='+sendid+'&yr='+yr,
beforeSend: function()
                   {
        document.getElementById(btnid).disabled=true;
       
                  
                  },
success: function(msg){
alert(msg);

         },
    error: function (request, status, error) {
        alert(request.responseText);
    }
     });



}



}


  function canceleinv(id,cust)
  {
  var answer = confirm ("Do you really want to cancel this invoice?")
if (answer){
window.location='canceleinv.php?eid='+id+'&cid='+cust;
  }
  }
</script>
</head>

<body><!--old -->

<center>
<?php include("menubar.php");
//echo $_SESSION['branch'];
 //echo $_SESSION['designation']." ".$_SESSION['serviceauth']." ".$_SESSION['dept'];
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation']." ".$_SESSION['dept']." ".$_SESSION['serviceauth']
 ?></center>

<p align="center">
<?php
	//echo "user".$_SESSION['user'];
//echo $_SESSION['custid'];
$cust=explode(",",$_SESSION['custid']);
$cl='';
for($i=0;$i<count($cust);$i++)
{

if($i==0)
$cl="'".$cust[$i]."'";
elseif($i==(count($i)-1))
$cl.=",'".$cust[$i]."'";
else
$cl.=",'".$cust[$i]."'";


/*if($i==0)
$cl.="'".$cust[$i];
elseif($i==(count($cust)-1))
$cl.=",'".$cust[$i]."'";
else
$cl.="','".$cust[$i]."','";*/

//echo $cl."<br>";
}
 
//echo $cl;
?>
           <select name="cid" id="cid" onchange="getbank(this.value,'ebill');" ><option value="">select Client</option>
           <?php
          // $result1 = mysqli_query($con,"SELECT DISTINCT cust_name, cust_id FROM sites where atm_id1 in (select ATM_ID from ebill where Active='Y')");
          $sql="SELECT contact_first, short_name FROM contacts where type='c' and short_name in(select distinct(cust_id) from mastersites) order by contact_first ASC";
        //  if($_SESSION['custid']!='all')
        //  $sql.="  and short_name in ($cl)";
          
		  //echo $sql;
          $result1 = mysqli_query($con,$sql);
          // $result1 = mysqli_query($con,"SELECT DISTINCT s.cust_name, s.cust_id FROM sites s,ebill e where s.atm_id1 =e.ATM_ID and e.Active='Y'");
            while($row1 = mysqli_fetch_row($result1)){ ?>
                                           <option value="<?php echo $row1[1]; ?>" ><?php echo $row1[0]; ?></option>
           <?php } ?>   </select>
          <select name="bank" id="bank" onchange="searchById('Listing','1','');" ><option value="">select Bank</option></select>
          <select name=type id=type style="display:none" onchange="searchById('Listing','1','');">
         
          <option value="">Select Type</option>
          <option value="paid">Paid Bills</option><option value="unpaid">Unpaid Bills</option></select>
          <select name=tata id=tata style="display:none" onchange="searchById('Listing','1','');">
           <option value="">Select Type</option>
            <option value="housekeeping">Housekeeping</option>
            <option value="">Others</option>
           </select>
          <select name="proj" id="proj" onchange="searchById('Listing','1','');" ><option value="">select Project</option></select>
           <select name="invoice" id="invoice" onchange="searchById('Listing','1','');" >
           <option value="0">Active</option>
           <option value="1">Inactive</option>
           <option value="-1">All</option>
           </select>
           
           <!--<input type="text" name="bank" id="bank" onkeyup="searchById('Listing','1','');" placeholder="Bank"/>-->
    <input type="text" name="atmid" id="atmid" onkeyup="searchById('Listing','1','');" placeholder="ATM"/>
   
    <input type="text" name="area" id="area" onkeyup="searchById('Listing','1','');" placeholder="location"/> 
    <input type="text" name="address" id="address" onkeyup="searchById('Listing','1','');" placeholder="Address"/> 
    <input type="text" name="zone" id="zone" onkeyup="searchById('Listing','1','');" placeholder="Zone"/>         
    <input type="hidden" name="service" id="service" onkeyup="searchById('Listing','1','');" placeholder="Service"/>
     <input type="text" name="date" id="date" placeholder="From date" onclick="displayDatePicker('date');"  />
    <input type="text" name="date2" id="date2" placeholder="To date" onclick="displayDatePicker('date2');"  /> 
     <input type="text" name="invoice_no" id="invoice_no" placeholder="Invoice No." />   
      <input type="button" onclick="searchById('Listing','1','');" value="Search by Date">
   
</p>


<div id="search"></div>


<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>