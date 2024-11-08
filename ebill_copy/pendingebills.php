<?php ini_set( "display_errors", 0);
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

// header('Location:managesite1.php?id='.$id); 
 

		
//$result2 = mysqli_query($con,"SELECT DISTINCT bank FROM sites");		
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Pending E-Bill Sites</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<script src="excel.js" type="text/javascript"></script>
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script type="text/javascript">
function newwin(url,winname)
{
//alert("hi");
  mywindow = window.open(url, winname, "location=400,status=1,scrollbars=1, width=500,height=400,left=350,top=200");
  
 }
function getbank(val)
{
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
// alert("getcustbank.php?val="+val);
xmlhttp.open("GET","getcustbank.php?val="+val+"&type=ebill",true);
xmlhttp.send();

	
}
function searchById(a,b,perpg) {
//alert(a+" "+b+" "+perpg);
var ppg='';
if(perpg=='')
ppg='20';
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
		  var cid=document.getElementById('cid').value;//alert(cid);
		//  var calltype=document.getElementById('calltype').value;
	
			 if(a!="Loading"){
			 ///var id=document.getElementById('atmid').value;//alert(id);
			 var atm=document.getElementById('atm').value;
			 var bank=document.getElementById('bank').value;//alert(bank);
			// var service=document.getElementById('service').value;
			 
			 
			 //var comp=document.getElementById('comp').value;
			  var dt=document.getElementById('date').value;
			 var dt2=document.getElementById('date2').value;
			 var yr=document.getElementById('yr').value;
			 var mon=document.getElementById('month').value;
			 var yr2=document.getElementById('yr2').value;
			 var mon2=document.getElementById('month2').value;
			 var ran=document.getElementById('range').value;
			  }
			 // alert(br);
			//alert("gg"); 
			var url = 'searchpendingebill.php'; 
		//  }
 	//alert(br);
		    var pmeters="";
			//alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			if(a!="Loading"){ 
			 pmeters = 'cid='+cid+'&bank='+bank+'&Page='+b+'&perpg='+ppg+"&dt="+dt+"&dt2="+dt2+"&atm="+atm+"&yr="+yr+"&mon="+mon+"&range="+ran+"&yr2="+yr2+"&mon2="+mon2;
			// alert(pmeters);
			}
			else
			{
				 pmeters = 'Page='+b+'&perpg='+ppg+'&cid='+cid;
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
  
  function edtpay(cnt,reqid)
  {
  //alert(id+" "+stat);
  if (confirm('Are you sure you want to Proceed?')) {
    // Save it!

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
document.getElementById('out'+cnt).innerHTML="Edited Successfully";
else
alert("Some Error Occurred. Please Refresh your page and try again");
	
	
    }
  }
var pamt=document.getElementById('pamt'+cnt).value;
var pdt=document.getElementById('pdt'+cnt).value;
var memo=document.getElementById('memo'+cnt).value;
var radios = document.getElementsByName('paid'+cnt);
var paid
for (var i = 0, length = radios.length; i < length; i++) {
    if (radios[i].checked) {
        // do whatever you want with the checked radio
      //  alert(radios[i].value);
 paid=radios[i].value;
        // only one radio can be logically checked, don't check the rest
        break;
    }}
//var paid=document.getElementById('paid'+cnt).value;
 // alert("approveebill.php?id="+id+"&stat="+stat);
// alert("getcustbank.php?val="+val);
//alert("updatepaidebill.php?pamt="+pamt+"&pdt="+pdt+"&memo="+memo+"&reqid="+reqid+"&paid="+paid);
xmlhttp.open("GET","updatepaidebill.php?pamt="+pamt+"&pdt="+pdt+"&memo="+memo+"&reqid="+reqid+"&paid="+paid,true);
xmlhttp.send();
}
  }

function show(id)
{
if(document.getElementById(id).style.display=='none'){
document.getElementById(id).style.display='block';
document.getElementById(id).focus();
}
else{
document.getElementById(id).style.display='none'; }

document.getElementById(id).focus();
}
</script>
</head>

<body>

<center>
<?php include("menubar.php");
//echo $_SESSION['branch'];
include("config.php");

//echo $_SESSION['custid'];
 $sql="select short_name,contact_first from contacts where type='c' and short_name in (select distinct(cust_id) from ebillfundrequests)";
          if($_SESSION['custid']!='all'){
$cu=str_replace(",","','",$_SESSION['custid']);
$cu="'".$cu."'";
//$sql.=" and short_name in (".$cu.")";
}
   //echo $sql;
 ?>
 </center>


<p align="center">
           <select name="cid" id="cid" onchange="searchById('Listing','1','');getbank(this.value);" ><option value="">select Client</option>
           <?php
//echo $sql;
           $result1 = mysqli_query($con,$sql);
		   if(!$result)
		   echo mysqli_error();
            while($row1 = mysqli_fetch_row($result1)){
            //$custname=mysqli_query($con,"select contact_first from contacts where short_name='".$row1[0]."' and type='c'");
            //$name=mysqli_fetch_row($custname);
           
             ?>
                                           <option value="<?php echo $row1[0]; ?>" ><?php echo $row1[1]; ?></option>
           <?php } ?>   </select>
          
          
          <select name="bank" id="bank" onchange="searchById('Listing','1','');" ><option value="">select Bank</option>
           </select>
           <select name="month" id="month"><option value="">Select From Month          </option>
           <?php $yr=date('Y'); for($i=1;$i<=12;$i++){
           ?>
           <option value="<?php echo $i; ?>"><?php echo date("F",strtotime($yr."-".$i."-01")); ?></option>
           <?php
           }  ?>
           </select>
           <select name="yr" id="yr"><option value="">Select Year         </option>
           <?php $yr=date('Y'); for($i=date('Y');$i>2008;$i--){
           ?>
           <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
           <?php
           }  ?>
           </select>
           
           
             <select name="month2" id="month2"><option value="">Select To Month          </option>
           <?php $yr=date('Y'); for($i=1;$i<=12;$i++){
           ?>
           <option value="<?php echo $i; ?>"><?php echo date("F",strtotime($yr."-".$i."-01")); ?></option>
           <?php
           }  ?>
           </select>
           <select name="yr2" id="yr2"><option value="">Select Year         </option>
           <?php $yr=date('Y'); for($i=date('Y');$i>2008;$i--){
           ?>
           <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
           <?php
           }  ?>
           </select>
           <select name="range" id="range">
           <option value="<?php echo "-1"; ?>">All</option>
           <option value="<?php echo "week"; ?>">Next 7 Days</option>
           <option value="<?php echo "overdue"; ?>">Over Dues</option>
           </select>
                <input type="text" name="atm" id="atm" placeholder="ATM ID" onkeyup="searchById('Listing','1','');"  />
    
    <input type="hidden" name="date" id="date" placeholder="From date" onclick="displayDatePicker('date');"  />
      <input type="hidden" name="date2" id="date2" placeholder="To date" onclick="displayDatePicker('date2');"  />  
      <input type="button" onclick="searchById('Listing','1','');" value="Search"><br><button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>
</p>

<div id="search">  </div>

<script type="text/javascript" src="http://cssmumbai.sarmicrosystems.com/operations/1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="http://cssmumbai.sarmicrosystems.com/operations/script.js"></script>

</body>
</html>