<?php ini_set( "display_errors", 0);



include("access.php");





// header('Location:managesite1.php?id='.$id); 

 

include("config.php");



 ?>
<!DOCTYPE html PUBLIC "-//W2C//DTD XHTML 1.0 Transitional//EN" "http://www.w2.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w2.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />

<link href="menu.css" rel="stylesheet" type="text/css" />

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />

<script src="datepicker/datepick_js.js" type="text/javascript"></script>

<script type="text/javascript">
function searchById(a,b,perpg)
{
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
</script>

</head>

<body>
<form name="frm1" method="post" action="processtakeover1.php">
<center><h2 class="style1">Takeover Form</h2></center>
                                           <option value=""></option>
                       <select name="cid" id="cid" onchange="searchById('Listing','1','');getproj(this.value);" ><option value="">select Client</option>
           <?php while($row1 = mysqli_fetch_row($result1)){ ?>
                                           <option value="<?php echo $row1[1]; ?>"<?php //if(isset($_GET['cid'])){ if($_GET['cid']==$row1[0]){ echo "selected"; } } ?> ><?php echo $row1[0]; ?></option>
           <?php } ?>   </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           
           <select name="project" id="project" onchange="searchById('Listing','1','');getbank(this.value);" >
           
                                           <option value="" >Select Project</option>
          </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <select name="bank" id="bank" onchange="searchById('Listing','1','');" >
              <option value="">select Bank</option>
            </select></center>
            
<br />
<center><input type="checkbox" name="checkbox1" value="">Care Taker&nbsp;&nbsp;
           <input type="checkbox" name="checkbox2" value="">House Keeping&nbsp;&nbsp;
           <input type="checkbox" name="checkbox3" value="">Maintenance&nbsp;&nbsp;
            <input type="checkbox" name="checkbox4" value="">Ebill&nbsp;&nbsp;
            </center>
            <br />
            <center>
             ATM ID: <input type="text" name="atmid">&nbsp;
             Local Branch: <input type="text" name="localbranch">&nbsp;
             Site Type: <input type="text" name="sitetype">&nbsp;
             Site ID: <input type="text" name="siteid">&nbsp;</center>
             <br/>
             <center>
             Site Address: <textarea rows="4" cols="50" name="siteaddress"></textarea>&nbsp;</center>
             <br />
             
             
             <center> State: <select name="state" id="state"    ><option value="">select State</option></select>&nbsp;&nbsp;&nbsp;&nbsp;
               Region: <input type="text" name="region">&nbsp;&nbsp;&nbsp;&nbsp;
               
               City: <select name="city" id="city"    ><option value="">select City</option></select>&nbsp;&nbsp;&nbsp;&nbsp;
               Zone: <select name="zone" id="zone"    ><option value="">select Zone</option></select>&nbsp;&nbsp;&nbsp;&nbsp;
                 Location: <input type="text" name="location">&nbsp;&nbsp;&nbsp;&nbsp;</center>
                 <br />
               
                
                <center> CSS Local Supervisor Name: <input type="text" name="clsn">&nbsp;&nbsp;
                 CSS Local Supervisor Number: <input type="text" name="clsp">&nbsp;&nbsp;
                 
                Takeover Date: <input type="text" name="takeoverdate" id="takeoverdate"  onclick="displayDatePicker('takeoverdate')" />&nbsp;&nbsp;</center>
                <br />
                <center>
                  Remarks: <textarea rows="4" cols="50" name="remarks"></textarea></center>
                  <center><h2 class="style1">ASSETS</h2></center>
                  <br />
                  <center>
                  
                     NUMBER OF ATM :<input type="text" name="noatm">&nbsp;
                     PHONE: <input type="text" name="phone">&nbsp;</center>
                     <br />
                     <center>
                      A/C: <input type="text" maxlength="5" size="2" name="ac">&nbsp;&nbsp;&nbsp;
                     FIRE EXTINGUISHER: <input type="text" maxlength="5" size="2" name="fire">&nbsp;&nbsp;&nbsp;
                     EXHAUST FAN :<input type="text" maxlength="5" size="2" name="exhaustfan">&nbsp;&nbsp;&nbsp;
                   UPS:<input type="text" maxlength="5" size="2" name="ups">&nbsp;&nbsp;&nbsp;
                     NUMBER OF BATTERY: <input type="text" maxlength="5" size="2" name="nobattery">&nbsp;&nbsp;&nbsp;
                      I D U: <input type="text" maxlength="5" size="2" name="idu">&nbsp;&nbsp;&nbsp;
                       STABILIZER: <input type="text" maxlength="5" size="2" name="stabilizer">&nbsp;&nbsp;&nbsp;
                        IMUERTER: <input type="text" maxlength="5" size="2" name="imuerter">&nbsp;&nbsp;&nbsp;</center>
                        <br />
                        <center>
                         DUSTBIN: <input type="text" maxlength="5" size="2" name="dustbin">&nbsp;
                          DOORMAT: <input type="text" maxlength="5" size="2" name="doormat">&nbsp;
                           CHAIR: <input type="text" maxlength="5" size="2" name="chair">&nbsp;</center>
                           <br />
                           <center>
                            OTHER DETAILS: <textarea rows="4" cols="50" name="otherdetails"></textarea></center>
                            <br />
                            <center>
                            <input type="submit" value="submit" name="submit" /></center>
                            </form>
                      
                     
</body>
</html>