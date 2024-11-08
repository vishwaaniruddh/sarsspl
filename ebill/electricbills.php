<?php ini_set( "display_errors", 0);

include("access.php");
if(!$_SESSION['user']){
?>
<script type="text/javascript">
alert("Sorry your session has been expired");
window.location="index.php";
</script>
<?php

}

// header('Location:managesite1.php?id='.$id); 
 
include("config.php");

		
		
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Electric Bills</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
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
	
	
    }
  }
  //alert("getcustbank.php?val="+val);
xmlhttp.open("GET","getcustbank.php?val="+val+"&type="+type,true);
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
	
			 if(a!="Loading"){
			 var id=document.getElementById('atmid').value;//alert(id);
			 var cid=document.getElementById('cid').value;//alert(cid);
			 var bank=document.getElementById('bank').value;//alert(bank);
			// var address=document.getElementById('address').value;
			 var address='';
			 var area='';
			 //var area=document.getElementById('area').value;//alert(area);
			 var zone=document.getElementById('zone').value;
			  var dt=document.getElementById('date').value;
			 var dt2=document.getElementById('date2').value;
			  var opts = document.getElementById('state').options;
    var i = 0, len = opts.length, a = [];
    for (i; i<len; i++) {
if(opts[i].selected==true)
        a.push(opts[i].value);
    }
    var state = a.join(',');
			  }
			 // alert(br);
			//alert("gg"); 
			var url = 'manageebill_data.php'; 
		//  }
 	//alert(br);
		    var pmeters="";
			//alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			if(a!="Loading"){ 
			 pmeters = 'atmid='+id+'&cid='+cid+'&area='+area+'&bank='+bank+'&Page='+b+'&perpg='+ppg+'&service='+service+"&address="+address+"&zone="+zone+"&dt="+dt+"&dt2="+dt2+"&state="+state;
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

<center>
<?php include("menubar.php");
//echo $_SESSION['branch'];
 ?>

<!--<div align="center">
  <h2 class="style1">ELECTRIC BILLS</h2>
</div>
<p><form action="electricbills.php" ><input type="hidden" name="id" value="<?php echo $id; ?>" />Select Customer ID : <select name="cid" ><option value="-1" >select</option>
           <?php while($row1 = mysqli_fetch_row($result1)){ ?>
                                           <option value="<?php echo $row1[1]; ?>" ><?php echo $row1[0]; ?></option>
           <?php } ?>   </select>Select Bank : <select name="bid" ><option value="-1" >select</option>
           <?php while($row2 = mysqli_fetch_row($result2)){ ?>
                                           <option value="<?php echo $row2[0]; ?>" ><?php echo $row2[0]; ?></option>
           <?php } ?>   </select> <input type="submit" value="submit" />
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php">Back</a>
         <?php if(isset($cid)){  ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="generateEbill.php?cid=<?php echo $cid; ?>&bid=<?php echo $bid; ?>">generate Electric bill</a><?php } ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="history.php?cid=<?php echo $cid; ?>&bid=<?php echo $bid; ?>&id=<?php echo $id; ?>">Printed Electric bill</a>
</form>                                 
</p><?php if(isset($cid)) { ?>
<a href="excel1.php?&cid=<?php echo $cid; ?>&bid=<?php echo $bid; ?>">Export to Excel</a><br/><br/>
<table width="800" border="1" align="center" cellpadding="4" cellspacing="0">
  <tr>
    <th scope="col"><div align="center">Bill ID </div></th>
    <th scope="col"><div align="center">ATM ID</div></th>
    <th scope="col"><div align="center">CONSUMER NO.</div></th>
    <th scope="col"><div align="center">DISTRIBUTOR</div></th>
    <th scope="col"><div align="center">DUE DATE </div></th>       
    <th scope="col"><div align="center">LANDLORD </div></th>       
    <th scope="col"><div align="center">ACTIVE </div></th>       
    <th scope="col"><div align="center">EDIT</div></th>   
      <th scope="col"><div align="center">VIEW PAID BILLS</div></th>
      <th scope="col"><div align="center">NEW BILL ENTRY</div></th> 
<!--      <th scope="col"><div align="center">MONEY TRANSFER</div></th>      -->
    
 <!-- </tr>
  <?php
          //echo $cid." - " .$bid;
	if($cid==-1 and $bid==-1)
		$sql = "SELECT atm_id1 FROM sites";
        elseif($bid==-1)
		$sql = "SELECT atm_id1 FROM sites where cust_id='$cid'";		
		else
		$sql = "SELECT atm_id1 FROM sites where cust_id='$cid' and bank='$bid'";
	/*	$str="";
		$result = mysqli_query($con,$sql);
		while($row = mysqli_fetch_row($result))
		{  $str=$str.$row[0].",";
		}
                $num = strlen($str);
                $str = substr($str,0,$num-1);
                echo $str;*/
                $nsql = "select * from ebill where ATM_ID in ($sql)"; //echo $nsql;
				 //$nsql = "select * from ebdetails where site_id='SN000523'";
                $result = mysqli_query($con,$nsql);
              $num=mysqli_num_rows($result); ?>
			<b> Total Number Of Record:&nbsp;&nbsp;&nbsp;<?php echo $num; ?></b>
             
	<?php	while($row = mysqli_fetch_row($result))
		{
			?>
		 <tr><td><?php echo $row[0]; ?></td>
		     <td><?php echo $row[3]; ?></td>
			 <td><?php echo $row[1]; ?></td>
			 <td><?php echo $row[2]; ?></td>
			 <td><?php echo $row[4]; ?></td>			 			              
			  <td><?php echo $row[5]; ?></td>			 			              
			   <td><?php echo $row[6]; ?></td>			 			              
			 <td><a href="editebill.php?atmid=<?php echo $row[3]; ?>&id=<?php echo $id; ?>&cid=<?php echo $cid; ?>&bid=<?php echo $bid; ?>">EDIT</a></td>			
             <td><a href="viewebills.php?atmid=<?php echo $row[3]; ?>&id=<?php echo $id; ?>&cid=<?php echo $cid; ?>&bid=<?php echo $bid; ?>">VIEW</a></td>
             <td><a href="newebill.php?atmid=<?php echo $row[3]; ?>&id=<?php echo $id; ?>&cid=<?php echo $cid; ?>&bid=<?php echo $bid; ?>">ENTRY</a></td>			  
<!--             <td><a href="moneytransfer.php?atmid=<?php echo $row[3]; ?>&id=<?php echo $id; ?>&cid=<?php echo $cid; ?>&bid=<?php echo $bid; ?>">TRANSFER</a></td>	-->		  
		<!--</tr>
		<?php
		}
?>
</table>

<?php } ?>-->
<table><tr><td valign="top">
           <select name="cid" id="cid" onchange="getbank(this.value,'ebill');" ><option value="">select Client</option>
           <?php
          // $result1 = mysqli_query($con,"SELECT DISTINCT cust_name, cust_id FROM sites where atm_id1 in (select ATM_ID from ebill where Active='Y')");
          $result1 = mysqli_query($con,"SELECT contact_first, short_name FROM contacts where type='c' and short_name in (select distinct(cust_id) from ebillfundrequests) order by contact_first ASC");
          // $result1 = mysqli_query($con,"SELECT DISTINCT s.cust_name, s.cust_id FROM sites s,ebill e where s.atm_id1 =e.ATM_ID and e.Active='Y'");
            while($row1 = mysqli_fetch_row($result1)){ ?>
                                           <option value="<?php echo $row1[1]; ?>" ><?php echo $row1[0]; ?></option>
           <?php } ?>   </select></td><td valign="top">
          <select name="bank" id="bank" onchange="searchById('Listing','1','');" ><option value="">select Bank</option>
           </select></td><td valign="top">
          
    <input type="text" name="atmid" id="atmid" onkeyup="searchById('Listing','1','');" placeholder="ATM"/>
   </td><td valign="top">
   <select name="state" id="state" multiple onblur="searchById('Listing','1','');">
   <option value="">Select state</option>
   <?php
   $state=mysqli_query($con,"select state from state");
   while($stro=mysqli_fetch_array($state))
   {
   ?>
   <option value="<?php echo $stro[0]; ?>"><?php echo $stro[0]; ?></option>
   <?php
   }
   ?>
   </select></td><!--<td valign="top">
    <input type="text" name="area" id="area" onkeyup="searchById('Listing','1','');" placeholder="location"/> 
    </td> <td valign="top">
   <textarea name="address" id="address" onkeyup="searchById('Listing','1','');" placeholder="Address"/> </textarea></td>--><td valign="top">
    <input type="text" name="zone" id="zone" onkeyup="searchById('Listing','1','');" placeholder="Zone"/>       </td><td valign="top">  
    <input type="hidden" name="service" id="service" onkeyup="searchById('Listing','1','');" placeholder="Service"/></td><td valign="top">
     <input type="text" name="date" id="date" placeholder="From date" onclick="displayDatePicker('date');"  /></td><td valign="top">
    <input type="text" name="date2" id="date2" placeholder="To date" onclick="displayDatePicker('date2');"  />  </td><td valign="top">
      <input type="button" onclick="searchById('Listing','1','');" value="Search"></td></tr></table>
   

</center>


<div id="search" style="padding-top:-100px;"></div>


<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>