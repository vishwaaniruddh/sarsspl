<?php 
include("access.php");
include("config.php");

$ser=mysqli_query($con,"select serviceauth,branch from login where username='".$_SESSION['user']."'");
$serro=mysqli_fetch_row($ser);
//echo $_SESSION['designation'];
if($_SESSION['designation']=='11')
	$_SESSION['custid']='all';
 
 //echo $_SESSION['user'];
 //echo  $_SESSION['custid'];
 ?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ebill Recharge<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="popup.css"  rel="stylesheet" type="text/css">
<script src="popup.js" type="text/jscript" language="javascript"> </script>
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script>
function getdetails(val,type,id,trackid)
{
	if(document.getElementById(id).value!="")
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
				var s=xmlhttp.responseText;
				var s2=s.split("###$$$");
				
				if(s2[0]=="false")
				{
					alert(s2[1]);
					document.getElementById(id).focus();
					document.getElementById(trackid).value="";
				}
				else if(s2[0]=="true")
				{
					//alert(s2[1]);
					document.getElementById(trackid).value=s2[1];
				}
			}
		}
		//var sv=document.getElementById('sv').value;
		var cid=document.getElementById('cust').value;
		//alert(cid);
		//alert("getebdetails.php?val="+val+"&type="+type+'&cid='+cid);
		xmlhttp.open("GET","geterdetails.php?val="+val+"&type="+type+'&cid='+cid,true);
		xmlhttp.send();
		var cont=document.getElementById('counter').value;
		var check= new Array();
		//alert(cont);
		var i=0;
		if(cont>1)
		{
			
			for(i=0;i<cont;i++)
			{
				var cop='atmid_'+i;
				var n=id.localeCompare(cop);
				if(n!=0)
				{
					check[i]=document.getElementById('atmid_'+i).value;
				}
			}
			//alert(check.toString());
			if(check.indexOf(val)>-1)
			{
				alert("Value is Repeated.");
				document.getElementById(id).value="";
				document.getElementById(id).focus();
			}
		}
	}
}
function addquotationItem()
{ 	
	var cnt=Number(document.getElementById('counter').value);
	if(cnt<15 ){
		if(document.getElementById('atmid_'+(cnt-1)).value!=""){
			var table = document.getElementById("myTable");
			var row = table.insertRow((cnt+2));
			var cell1 = row.insertCell(0);
			cell1.innerHTML = "<center><b>"+(cnt+1)+"</b></center>";
			var cell1 = row.insertCell(1);
			cell1.innerHTML = "Atm ID : ";
			var cell1 = row.insertCell(2);
			cell1.innerHTML = "<input type=\"text\" name=\"atmid["+cnt+"]\" id=\"atmid_"+cnt+"\" onblur=\"getdetails(this.value,'atm_id1',this.id,\'trackid_"+cnt+"\');\" />";
			var cell1 = row.insertCell(3);
			cell1.innerHTML = "Amount : ";
			var cell1 = row.insertCell(4);
			cell1.innerHTML = "<input type=\"text\" name=\"amt["+cnt+"]\" id=\"amt_"+cnt+"\" onKeyUp=\"calculate();\" required /><input type=\"hidden\" value=\"\"  name=\"trackid["+cnt+"]\" id=\"trackid_"+cnt+"\"/>";
			cnt=cnt+1;
			document.getElementById('counter').value=cnt;
		}
		else{
			alert("Last atm field is empty.");
			document.getElementById('atmid_'+(cnt-1)).focus();
		}
	}
	else
		alert("Can add more than 15 sites.");
}
//================ If want to calculate use this modification required =============
function calculate(){
	var cont=document.getElementById('counter').value;
	//alert(cont);
	var amt=0;
	for(i=0;i<cont;i++){
		amt=amt+Number(document.getElementById('amt_'+i).value);
	}
	document.getElementById('totalamtgross').value=amt;
}
</script>
</head>

<body>
<div style="height:30px;">

<input type="hidden" name="br" id="br" value="<?php echo $_SESSION['branch']; ?>"/>
<input type="hidden" name="dept" id="dept" value="<?php echo $_SESSION['dept']; ?>"/>
<input type="hidden" name="service" id="service" value="<?php echo $_SESSION['serviceauth']; ?>"/>
<input type="hidden" name="desig" id="desig" value="<?php echo $_SESSION['designation']; ?>"/>
<center>
<?php include("menubar.php");
//echo $_SESSION['branch'];
 ?>

<h2>New Recharge Template</h2>
</center>
<form name="myform" method="POST" action="process_er_template.php">
	<table id="myTable" border="1">
		<tr>
			<td>Supervisor : </td>
			<td colspan="4">
				<select name="sv" id="sv" required ><option value="-1">Select</option>
				<?php
					  $sup=mysqli_query($con,"select distinct(hname) from fundaccounts order by hname ASC");
					 while($supro=mysqli_fetch_array($sup))
					 { 
				?>
			   		<option value="<?php echo $supro[0]; ?>" ><?php echo $supro[0]; ?></option>
		  		<?php } ?>  
	    			</select>
			</td>
		</tr>
		<tr>
			<td>Select Client : </td>
			<td colspan="4">
				<select name="cust" id="cust" required > <option value="">Select Client</option>
				     <?php
					  $str="Select short_name,contact_first from contacts where type='c' order by contact_first ASC";
					 
					  $qry=mysqli_query($con,$str);
					  while($row=mysqli_fetch_row($qry))
					  {
						// echo "select 1 from ".$row[0]."_ebill";
						$val = mysqli_query($con,"select 1 from ".$row[0]."_ebill");
						if($val !== FALSE)
						{
						   //DO SOMETHING! IT EXISTS!
						   ?>
						      <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
						      <?php
						}
					  
					  }
				?>
				</select>
			</td/>
		</tr>
		
		<tr>
			<td><center><b>1</b></center></td>
	        	<td>Atm ID : </td>
	            	<td><input type="text" name="atmid[0]" id="atmid_0" onblur="getdetails(this.value,'atm_id1',this.id,'trackid_0');" /></td>
	            	<td>Amount</td>
	            	<td><input type="text" name="amt[0]" id="amt_0" onKeyUp="calculate();" required />
	            	<input type="hidden" value=""  name="trackid[0]" id="trackid_0"></td>
	        </tr>
	            <input type="hidden" value="1"  name="counter" id="counter">
	        <tr>
	            <td colspan="4" align="right">Total Amount</td>
	            <td><input type="text" name="totalamtgross" id="totalamtgross" value="0" readonly=readonly></td>
	            <td><button type="button" class="btn blue" onClick="addquotationItem();"><i class="icon-ok"></i> Add Item</button></td>
	        </tr>
            <tr>
            	<td colspan="5" align="center"><input type="submit" name="Submit" value="Submit"/></td>
            </tr>
	</table>
	
</form>
</div>

<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>


</body>
</html>