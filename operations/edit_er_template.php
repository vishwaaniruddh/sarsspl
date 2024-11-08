<?php 

//include("access.php");

include("config.php");



?>

<?php 

//echo $_SESSION['designation'];

if($_SESSION['designation']=='11')

	$_SESSION['custid']='all';

 

 //echo $_SESSION['user'];

 //echo  $_SESSION['custid'];

 ?>

 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>EBill Recharge-<?php echo $_SESSION['user']; ?></title>

<link href="style.css" rel="stylesheet" type="text/css" />

<link href="menu.css" rel="stylesheet" type="text/css" />

<!--datepicker-->

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />

<script src="datepicker/datepick_js.js" type="text/javascript"></script>

<!--Slide down div  -->

<script src="js/jquery.min.js.js" type="text/javascript"></script>

 

 

 

 

<style> 

body {

	font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif;

	font-size: .8em;

	}

 

/* the div that holds the date picker calendar */

.dpDiv {

	}

 

 

/* the table (within the div) that holds the date picker calendar */

.dpTable {

	font-family: Tahoma, Arial, Helvetica, sans-serif;

	font-size: 12px;

	text-align: center;

	color: #505050;

	background-color: #ece9d8;

	border: 1px solid #AAAAAA;

	}

 

 

/* a table row that holds date numbers (either blank or 1-31) */

.dpTR {

	}

 

 

/* the top table row that holds the month, year, and forward/backward 



buttons */

.dpTitleTR {

	}

 

 

/* the second table row, that holds the names of days of the week (Mo, 



Tu, We, etc.) */

.dpDayTR {

	}

 

 

/* the bottom table row, that has the "This Month" and "Close" buttons 



*/

.dpTodayButtonTR {

	}

 

 

/* a table cell that holds a date number (either blank or 1-31) */

.dpTD {

	border: 1px solid #ece9d8;

	}

 

 

/* a table cell that holds a highlighted day (usually either today's 



date or the current date field value) */

.dpDayHighlightTD {

	background-color: #CCCCCC;

	border: 1px solid #AAAAAA;

	}

 

 

/* the date number table cell that the mouse pointer is currently over 



(you can use contrasting colors to make it apparent which cell is being 



hovered over) */

.dpTDHover {

	background-color: #aca998;

	border: 1px solid #888888;

	cursor: pointer;

	color: red;

	}

 

 

/* the table cell that holds the name of the month and the year */

.dpTitleTD {

	}

 

 

/* a table cell that holds one of the forward/backward buttons */

.dpButtonTD {

	}

 

 

/* the table cell that holds the "This Month" or "Close" button at the 



bottom */

.dpTodayButtonTD {

	}

 

 

/* a table cell that holds the names of days of the week (Mo, Tu, We, 



etc.) */

.dpDayTD {

	background-color: #CCCCCC;

	border: 1px solid #AAAAAA;

	color: white;

	}

 

 

/* additional style information for the text that indicates the month 



and year */

.dpTitleText {

	font-size: 12px;

	color: gray;

	font-weight: bold;

	}

 

 

/* additional style information for the cell that holds a highlighted 



day (usually either today's date or the current date field value) */ 

.dpDayHighlight {

	color: 4060ff;

	font-weight: bolmysqli_query($con,

	}

 

 

/* the forward/backward buttons at the top */

.dpButton {mysqli_query($con,

	font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif;

	font-size: 10px;

	color: gray;

	background: #d8e8ff;

	font-weight: bold;

	padding: 0px;

	}

 mysqli_query($con,

 

/* the "This mysqli_query($con,Close" buttons at the bottom */

.dpTodayButton {

	font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif;

	font-size: 10px;

	color: gray;

	background: #d8e8ff;

	font-weight: bold;

	}
mysqli_query($con,
 

</style> 



<script src="php_calendar/scripts.js" type="text/javascript"></script>

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

//================ calculate =============

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



<center>

<?php include("menubar.php"); ?>

</center>

<div align="center">

  <h2 class="style1">New Recharge Template</h2>

</div>

<div >

<form name="myform" method="POST" action="process_edit_er_template.php">

	<table id="myTable" border="1">

<?php

	$tmt_id=$_GET['tmt_id'];

	$view_temptlate=mysqli_query($con,"select * from recharge_template where status=1 and tmt_id='".$tmt_id."'");

	if($view_temptlate>0)

	{

		$row=mysqli_fetch_array($view_temptlate)

?>

		<tr>

			<td>Supervisor : </td>

			<td colspan="4"><input type="text" name="sv" id="sv" value="<?php echo $row['supervisor']; ?>" readonly />

				<!--<select name="sv" id="sv" required ><option value="-1">Select</option>

				<?php

					  $sup=mysqli_query($con,"select distinct(hname) from fundaccounts order by hname ASC");

					 while($supro=mysqli_fetch_array($sup))

					 { 

				?>

			   		<option value="<?php echo $supro[0]; ?>" <?php if($supro[0]==$row['supervisor']){ echo "selected"; } ?>><?php echo $supro[0]; ?></option>

		  		<?php } ?>  

	    			</select>-->

			</td>

		</tr>

		<tr>

			<td>Select Client : </td>

			<td colspan="4"><input type="text" name="cust" id="cust" value="<?php echo $row['cust_id']; ?>" readonly />

				<!--<select name="cust" id="cust" required > <option value="">Select Client</option>

				     <?php

					  $str="Select short_name,contact_first from contacts where type='c' order by contact_first ASC";

					 

					  $qry=mysqli_query($con,$str);

					  while($row1=mysqli_fetch_row($qry))

					  {

						// echo "select 1 from ".$row[0]."_ebill";

						$val = mysqli_query($con,"select 1 from ".$row1[0]."_ebill");

						if($val !== FALSE)

						{

						   //DO SOMETHING! IT EXISTS!

						   ?>

						      <option value="<?php echo $row1[0]; ?>" <?php if($row1[0]==$row['cust_id']){ echo "selected"; } ?>><?php echo $row1[1]; ?></option>

						      <?php

						}

					  

					  }

				?>

				</select>-->

			</td/>

		</tr>

<?php

		$row2_qry=mysqli_query($con,"select * from recharge_template_details where tmt_id='".$tmt_id."' and status=1");

		$i=0;

		$totalamt=0;

		while($row2=mysqli_fetch_array($row2_qry))

		{

?>

		<tr id="tr_row_<?php echo $i;?>">

			<td><center><b><?php echo $i+1;?></b></center></td>

	        	<td>Atm ID : </td>

	            	<td><input type="text" name="atmid[<?php echo $i;?>]" id="atmid_<?php echo $i;?>" value="<?php echo $row2['atm_id']; ?>" onblur="getdetails(this.value,'atm_id1',this.id,'trackid_<?php echo $i;?>');" readonly /></td>

	            	<td>Amount</td>

	            	<td><input type="text" name="amt[<?php echo $i;?>]" id="amt_<?php echo $i;?>" value="<?php echo $row2['amount']; $totalamt+=$row2['amount']; ?>" onKeyUp="calculate();" required />

	            	<input type="hidden" value="<?php echo $row2['tracker_id']; ?>"  name="trackid[<?php echo $i;?>]" id="trackid_<?php echo $i;?>"></td>

	            	<td><button onclick="location.href='remove_er_atm.php?td_id=<?php echo $row2['td_id']; ?>&tmt_id=<?php echo $tmt_id; ?>';return false;">Remove Item</button></a></td>

	        </tr>

	            

<?php

			$i++;

		}

	}

?>	            <input type="hidden" value="<?php echo $i;?>"  name="counter" id="counter">

	        <tr>

	            <td colspan="4" align="right">Total Amount</td>

	            <td><input type="text" name="totalamtgross" id="totalamtgross" value="<?php echo $totalamt; ?>" readonly=readonly></td>

	            <td><button type="button" onClick="addquotationItem();"><i class="icon-ok"></i> Add Item</button></td>

	        </tr>

	</table>

	<input type="hidden" value="<?php echo $tmt_id; ?>"  name="tmt_id">

	<center><input type="submit" name="Submit" value="Submit"/></center>

</form>

</div>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>

<script type="text/javascript" src="script.js"></script>

</body>

</html>