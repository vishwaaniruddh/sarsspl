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
<title>MIS</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script type="text/javascript">
 function dispatch2(inv)
{
//alert(inv);
if(document.getElementById("dis"+inv).style.display=='block')
document.getElementById("dis"+inv).style.display='none';
else
document.getElementById("dis"+inv).style.display='block';

}

function dispatch(inv)
{
//alert(inv);
var xmlhttp;
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
	alert("some Error Occurred");
	
	}
	else
	document.getElementById("diss"+inv).innerHTML=xmlhttp.responseText;
    }
  }
  var state=document.getElementById("stat"+inv).value;
 // alert(inv);
  var rem=document.getElementById("rem"+inv).value;
  
xmlhttp.open("GET","dispatchebill.php?id="+inv+"&stat="+state+"&rem="+rem,false);

xmlhttp.send();

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
		 
	
//var dispt=document.getElementById('dispt').value;
			 if(a!="Loading"){
			 
			 var cid=document.getElementById('cid').value;//alert(cid);
			 var user=document.getElementById('user').value;//alert(cid);
			 var bank=document.getElementById('bank').value;//alert(bank);
			 
			  var dt=document.getElementById('date').value;
			 var dt2=document.getElementById('date2').value;

			  }
			 // alert(br);
			//alert("gg"); 
			var url = 'searchebmis.php'; 
		//  }
 	//alert(br);
		    var pmeters="";
			//alert(url);
//+"&dispt="+dispt
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			if(a!="Loading"){ 
			 pmeters = 'cid='+cid+'&bank='+bank+'&Page='+b+'&perpg='+ppg+"&dt="+dt+"&dt2="+dt2+"&user="+user;
			// alert(pmeters);
			}
			else
			{
				 pmeters = 'Page='+b+'&perpg='+ppg;
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
<select name="user" id="user" ><option value="">select User</option>
           <?php
          // $result1 = mysqli_query($con,"SELECT DISTINCT cust_name, cust_id FROM sites where atm_id1 in (select ATM_ID from ebill where Active='Y')");
          $usr="SELECT username FROM login where designation='7' and deptid='2' and status=1 order by username ASC";
        //  if($_SESSION['custid']!='all')
        //  $sql.="  and short_name in ($cl)";
          
		  //echo $sql;
          $usro= mysqli_query($con,$usr);
          // $result1 = mysqli_query($con,"SELECT DISTINCT s.cust_name, s.cust_id FROM sites s,ebill e where s.atm_id1 =e.ATM_ID and e.Active='Y'");
            while($urow1 = mysqli_fetch_row($usro)){ ?>
                                           <option value="<?php echo $urow1[0]; ?>" ><?php echo $urow1[0]; ?></option>
           <?php } ?>   </select>

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
         
     <input type="text" name="date" id="date" placeholder="From date" onclick="displayDatePicker('date');"  />
    <input type="text" name="date2" id="date2" placeholder="To date" onclick="displayDatePicker('date2');"  />  
      <input type="button" onclick="searchById('Listing','1','');" value="Search by Date">
   
</p>


<div id="search"></div>


<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>