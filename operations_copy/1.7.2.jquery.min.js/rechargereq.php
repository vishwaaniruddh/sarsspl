<?php 

include("access.php");

include("config.php");

    $sid = $_GET['atmid'];

    $id = $_GET['id'];

	 $cid = $_Gmysqli_query($con,

	  $bid = $_GET['bid'];

	
mysqli_query($con,
        $sql = "select * from ".$cid."_ebill where atm_id='".$sid."'";



		$result = mysqli_query($con,$sql);

	$row = mysqli_fetch_row($result);	

	

        $sql1 = "select * from ebaccount_details where atmid='".$sid."'";
mysqli_query($con,


		$result1 = mysqli_query($con,$sql1);

	$row1 = mysqli_fetch_row($result1);			

	/*

	if($row[5]=="Y"){

	houserate.visible=true;

	}*/

	//echo $_SESSION['designation'];

	if($_SESSION['designation']=='11')

	$_SESSION['custid']="all";

	else

	{

	//echo "select custid from login where username='".$_SESSION['user']."'";

	$srno=mysqli_query($con,"select custid from login where username='".$_SESSION['user']."'");

	$sr=mysqli_fetch_row($srno);

	if($_SESSION['custid']!='')

	 $_SESSION['custid']=$sr[0];

	else

	$_SESSION['custid']="all";

	}

	

	//echo $_SESSION['custid'];

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

	font-weight: bold;

	}

 

 

/* the forward/backward buttons at the top */

.dpButton {

	font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif;

	font-size: 10px;

	color: gray;

	background: #d8e8ff;

	font-weight: bold;

	padding: 0px;

	}

 

 

/* the "This Month" and "Close" buttons at the bottom */

.dpTodayButton {

	font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif;

	font-size: 10px;

	color: gray;

	background: #d8e8ff;

	font-weight: bold;

	}

 

</style> 



<script src="php_calendar/scripts.js" type="text/javascript"></script>

<script type="text/javascript">

function validate(form)

{

//alert("hi");

with(form)

{

if(cust.value=='')

{

alert("Please Select Customer");

cust.focus();

return false;

}

if(trackid.value=='')

{

alert("Please Enter Tracker ID");

trackid.focus();

return false;

}

//alert(sv.value);

if(sv.value=='-1' || sv.value=='')

{

alert("Please Select a Supervisor ");

sv.focus();

return false;

}

if(bill_date.value=='' || bill_date.value=='00/00/0000')

{

alert("Please Enter Bill Date");

bill_date.focus();

return false;

}

if(fromdt.value=='' || fromdt.value=='00/00/0000')

{

alert("Please Select From Date ");

fromdt.focus();

return false;

}

if(todt.value=='' || todt.value=='00/00/0000')

{

alert("Please Select To Date ");

todt.focus();

return false;

}

if(duedt.value=='' || duedt.value=='00/00/0000')

{

alert("Please Select Due Date ");

duedt.focus();

return false;

}

if(openr.value=='')

{

alert("Please Enter Opening Reading ");

openr.focus();

return false;

}

if(closer.value=='')

{

alert("Please Enter Closing Reading ");

closer.focus();

return false;

}



if(unit.value=='')

{

alert("Please Enter Unit Number ");

unit.focus();

return false;

}

if(amount.value=='')

{

alert("Please Enter amount ");

amount.focus();

return false;

}

/*if(paiddt.value=='')

{

alert("Please Select Paid Date ");

paiddt.focus();

return false;

}*/

return true;

}

}

function updateData()

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

		

alert(xmlhttp.responseText);

document.getElementById(id).innerHTML='';

	document.getElementById(id).innerHTML=xmlhttp.responseText;

	

	

    }

  }

  //alert("hii");

	var m_consumr=document.getElementById('con_no').value;

	//alert(m_consumr);

	var m_trackerid=document.getElementById('trackid').value;

	//alert(m_trackerid);

	var m_dist=document.getElementById('distributor').value;

	//alert(m_dist);

	var m_due=document.getElementById('duedate').value;

	//alert(m_due);

	var m_land=document.getElementById('landlord').value;

	//alert(m_land);

	//var m_billunit=document.getElementById('billunit').value;

	//alert(m_billunit);

	var m_meter=document.getElementById('meterno').value;

	//alert(m_meter);

	var m_atm=document.getElementById('atmid').value;

	//alert(m_atm);

	var m_cust=document.getElementById('cust').value;

	//alert(m_cust);

	var addr=escape(document.getElementById('address').value);

	//alert(m_add);

	var prj=document.getElementById('projectid').value;

	//alert(prj);

	var bank=document.getElementById('bank').value;

	//alert(bank);

	

	if(m_atm!='' && m_cust!=''){

//alert(m_atm+" "+m_cust);

var dat="cust="+m_cust+"&consumer="+m_consumr+"&trckid="+m_trackerid+"&distri="+m_dist+"&duedt="+m_due+"&land="+m_land+"&mtr="+m_meter+"&atm="+m_atm+"&addr="+addr+"&bank="+bank+"&prjt="+prj;

//alert(dat);



xmlhttp.open("POST","updatepage.php",false);

xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

xmlhttp.send(dat);

//alert(dat);

}

else

{

alert("Please Enter Atm ID");

return fmysqli_query($con,

}

mysqli_query($con,

}

	

function getdetails(val,type)

{

//alert(val+" "+type);

//alert(document.getElementById('cust').value);

if((document.getElementById('cons').checked==true && type=='meter_no') || type=='atm_id1')

{

if (window.XMLHttpRequest)

  {// code for IE7+, Firefox, Chrome, Opera, Safari

  xmlhttp=new XMLHttpRequest();

  }

else

  {// code for IE6, IE5

  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
mysqli_query($con,
  }

  xmlhttp.onreadystatechange=function()

  {

  if (xmlhttp.readyState==4 && xmlhttp.status==200)

    {

	//alert(xmlhttp.responseText);

	var s=xmlhttp.responseText;

var s2=s.split("###$$$");

//document.getElementById('Error').innerHTML=xmlhttp.responseText;

//alert(xmlhttp.responseText);

if(s2[0]=='NA')

{

//alert("Nmysqli_query($con,Available");

//document.getElementById('Error').innerHTML=xmlhttp.responseText;

document.getElementById('err').value=s2[1];

document.getElementById('cmdsub').disabled=true;

document.getElementById('con_no').value='';

document.getElementById('address').value='';

document.getElementById('trackid').value='';

document.getElementById('distributor').value='';

document.getElementById('duedate').value='';

document.getElementById('landlord').value='';

//document.getElementById('billunit').value='';

document.getElementById('meterno').value='';

document.getElementById('avgbill').value='';

document.getElementById('bank').value='';

document.getElementById('cust').value='';

document.getElementById('history').innerHTML="<h2>History</h2>";
mysqli_query($con,
//document.getElementById('flag').value='1';

}

else

{



//document.getElementById('flag').value='0';

//alert(s2[0]);

document.getElementById('err').value='';



document.getElementById('con_no').value=s2[0];

document.getElementById('address').value=s2[8];

document.getElementById('trackid').value=s2[9];

document.getElementById('dist').innerHTML=s2[1];

//alert(s2[1]);

document.getElementById('duedate').value=s2[3];

document.getElementById('landlord').value=s2[4];

//document.getElementById('billunit').value=s2[5];

document.getElementById('meterno').value=s2[6];

document.getElementById('avgbill').value=s2[7];

//alert(s2[10]);

document.getElementById('bank').value=s2[12];

if(document.getElementById('atmid').value=='')

document.getElementById('atmid').value=s2[2];



document.getElementById('cmdsub').disabled=false;

document.getElementById('cust').value=s2[10];

document.getElementById('sv').value=s2[11];



gethistory(s2[9],s2[10],s2[2]);



}


mysqli_query($con,
mysqli_query($con,

    }

  }

  



  var cid=document.getElementById('cust').value;

//alert("getebdetails.php?val="+val+"&type="+type+'&cid='+cid);

xmlhttp.open("GET","getebdetails.php?val="+val+"&type="+type+'&cid='+cid,true);

xmlhttp.send();



}	

}

 function getalert(cust,sescust)

  {

//alert(cust+" "+sescust);

 



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

   // alert(xmlhttp.responseText);

	if(xmlhttp.responseText=='0'){

	document.getElementById('cmdsub').disabled=true;

	alert("This is not your Client");

	

	}	

	else

	document.getElementById('cmdsub').disabled=false;







//document.getElementById('history').innerHTML=xmlhttp.responseText;

	

    }

  }





xmlhttp.open("GET","getselfcust.php?cust="+cust+"&sescust="+sescust,true);

xmlhttp.send();

//alert("getselfcust.php?cust="+cust+"&sescust="+sescust);

  }

function checkdt(val,tbl)

  {

 //alert(val+" "+tbl);

 

var cid=document.getElementById('cust').value;

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

alert("Bill is already generated for this Date");

document.getElementById('cmdsub').disabled=true;

}

else

document.getElementById('cmdsub').disabled=false;



getalert(cid,'<?php echo $_SESSION['custid']; ?>');	

    }

  }

// alert("getcustbank.php?val="+val);

if(document.getElementById('cust').value=='' || document.getElementById('trackid').value=='')

{

alert("Please select Client And Tracker ID");

return false;

}

else

  {

  

   var atmid=document.getElementById('atmid').value;

    var trackid=document.getElementById('trackid').value;

//alert("chkbilldt.php?val="+val+"&tbl="+tbl+"&cid="+cid+'&atmid='+atmid+'&trackid='+trackid);

xmlhttp.open("GET","chkbilldt.php?val="+val+"&tbl="+tbl+"&cid="+cid+'&atmid='+atmid+'&trackid='+trackid,true);

xmlhttp.send();

}

  }

   function gethistory(trackerid,custid,atmid)

  {

var cid=custid;

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

document.getElementById('history').innerHTML=xmlhttp.responseText;

getalert(cid,'<?php echo $_SESSION['custid']; ?>');

    }

  }

// alert("getcustbank.php?val="+val);



  var cid=document.getElementById('cust').value;

   var atmid=document.getElementById('atmid').value;

    var trackid=document.getElementById('trackid').value;

//alert("chkbilldt.php?val="+val+"&tbl="+tbl+"&cid="+cid);

//alert("getebhistory.php?trackid="+trackerid+"&custid="+custid+"&atmid="+atmid);

xmlhttp.open("GET","getebhistory.php?trackid="+trackerid+"&custid="+custid+"&atmid="+atmid,true);

xmlhttp.send();



  }

  function inifund(id)

  {

//alert(id);

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

    if(xmlhttp.responseText=='0')

    alert("Sorry your Session has Expired");

    else if(xmlhttp.responseText=='1')

    document.getElementById('initiate'+id).innerHTML="Fund Initiated Successfully";

     else if(xmlhttp.responseText=='2')

     alert("Some Error Occurred");

//alert(xmlhttp.responseText);

//document.getElementById('history').innerHTML=xmlhttp.responseText;

//getalert(cid,'<?php echo $_SESSION['custid']; ?>');

    }

  }

// alert("getcustbank.php?val="+val);



  var amt=document.getElementById("amt"+id).value;

   var rem=document.getElementById("rem"+id).value;

   // alert("iniebpay.php?amt="+amt+"&rem="+rem+"&reqid="+id);

xmlhttp.open("GET","iniebpay.php?amt="+amt+"&rem="+rem+"&reqid="+id,true);

xmlhttp.send();



  }

  function show(id){

 //alert(document.getElementById('divcon_no').style.display);

 // alert(document.getElementById('divcon_no2').style.display);

  

  if(document.getElementById('divcon_no2').style.display=='block' && document.getElementById('divcon_no').style.display=='none')

  {

   document.getElementById('oldcons').innerHTML='Old Consumer Number';

   document.getElementById('divcon_no').style.display='block';

 document.getElementById('divcon_no2').style.display='none';



  }

  else if(document.getElementById('divcon_no2').style.display=='none' && document.getElementById('divcon_no').style.display=='block')

  {

  document.getElementById('oldcons').innerHTML='New Consumer Number';

 document.getElementById('divcon_no').style.display='none';

  document.getElementById('divcon_no2').style.display='block';

  }

  

  if(document.getElementById(id).checked==true)

  {

  document.getElementById('cmdsub').disabled=true;

  }

  else if(document.getElementById(id).checked==false)

  {

 // alert("hi");

  document.getElementById('cmdsub').disabled=false;

  }

  }

  

  function calc(openr,closer)

{

//alert(openr+" "+closer);

var openre=Number(document.getElementById(openr).value);

var closr=Number(document.getElementById(closer).value);

if((openre!='' || openre!='0') && (closr!='' || closr!='0'))

{

document.getElementById('unit').value=(Number(closr)-Number(openre));

}

}

function getElementTopLeft(id) {

//alert(id);

    var ele = document.getElementById(id);

    alert(ele);

    var top = 0;

    var left = 0;

   

    while(ele.tagName != "body") {

    //alert("hello");

        top += ele.offsetTop;

        alert(top);

        left += ele.offsetLeft;

        alert(left);

        ele = ele.offsetParent;

    }

   //alert(top);

    return { top: top, left: left };

   

}

function showdiv(id)

{

//alert("hi");

//var TopLeft = getElementTopLeft('initiate'+id);

//alert(TopLeft);

//alert(TopLeft.top +', '+ TopLeft.left);





if(document.getElementById('initiate'+id).style.display=='none')

document.getElementById('initiate'+id).style.display="block";

else if(document.getElementById('initiate'+id).style.display=='block')

document.getElementById('initiate'+id).style.display="none";

}



</script>



</head>



<body>



<center>

<?php include("menubar.php");

//echo $_SESSION['designation'];

if($_SESSION['designation']=='11')

 $_SESSION['custid']='all';

 

 //echo $_SESSION['user'];

 //echo  $_SESSION['custid'];

 ?></center>

<div align="center">

  <h2 class="style1">Meter Recharge Request</h2>

</div><br /><br />

<div align="center" id="Error"><?php if(isset($_SESSION['success'])){ echo $_SESSION['success']; unset($_SESSION['success']);}  ?></div>

<form id="form1" name="form1" method="post" action="processrecharge.php" onsubmit="return validate(this)" autocomplete="OFF">

<center><input type="text" name="err" id="err" readonly="readonly" /></center>

<table><tr><td valign="top"><h2>History</h2><div id="history"></div></td><td valign="top">

 <table width="790" border="1" align="center" cellpadding="4" cellspacing="0">

 <tr>

 <td width="146" height="52"><div align="center">Select Client</div></td>

 <td><div align="center">

   <p>

    <select name="cust" id="cust"> <option value="">Select Client</option>

     <?php

	 include("config.php");

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

     <!-- <input type="text" name="cust" id="cust" readonly="readonly">-->

   </p>

 </div></td>

    <td width="29"></td>

     <td><div align="center">ATM ID</div></td>

     <td><div align="center"><input type="text" name="atmid" id="atmid" value="<?php echo $row[3]; ?>" onblur="getdetails(this.value,'atm_id1');" />

       

     </div></td>

  </tr> 

  

  <tr>

 <td width="146" height="52"><div align="center">Bank</div></td>

 <td><div align="center">

   <p>

   <select name="bank" id="bank"  style="width:150px">  <option value="" >Select Bank</option>

			   

				<?php

				$bkk="select bank_name,bank from bank order by bank_name ASC";

			   //echo $pojct;

			  $bkkr=mysqli_query($con,$bkk);

 while($bkkro=mysqli_fetch_array($bkkr))

			  {

			  ?>

			  <option value="<?php echo $bkkro[0];  ?>"><?php echo $bkkro[1];  ?></option>

			  <?php

			  }

				/*for($i=0;$i<count($bank);$i++)

				{ ?>

				   <option value="<?php echo $bank[$i]; ?>"><?php echo $bank[$i]; ?></option>

			   <?php }*/ ?> 

			   <option value="">Other Bank</option> 

											 

			   </select>

     <!-- <input type="text" name="bank" id="bank" readonly/>-->

   </p>

 </div></td>

    <td width="29"></td>

     <td><div align="center">Project ID</div></td>

     <td><div align="center">

       <!--<input type="text" name="projectid" id="projectid"  readonly/>-->

       <?php 

			   

			   $pojct="select project from projects where project<>'Other Bank'";

			   //echo $pojct;

			  $pro=mysqli_query($con,$pojct);

			  if(!$pro)

			  echo mysqli_error();

			    ?>

			  <select name="projectid" id="projectid"><option value="Other Bank">Other Bank</option>

			  <?php

			  

			  

			  while($proj=mysqli_fetch_array($pro))

			  {

			  ?>

			  <option value="<?php echo $proj[0];  ?>"><?php echo $proj[0];  ?></option>

			  <?php

			  }

			  ?>

			  </select>

     </div></td>

  </tr>       

 <tr>

 <td width="146" height="52"><div align="center">Address</div></td>

 <td><div align="center">

   <p>

     <input type="text" name="address" id="address" value=""/>

   </p>

 </div></td>

    <td width="29"></td>

     <td><div align="center">Distributor</div></td>

     <td><div align="center" id="dist">

       <!--<input type="text" name="distributor" id="distributor" />-->

       <select name="distributor" id="distributor" style="width:150px"><option value="" width="60px">select Provider</option>

<?php

$sp=mysqli_query($con,"select code,provider from eserviceprovider where status=0 order by provider ASC");

while($spro=mysqli_fetch_array($sp))

{

?>

<option value="<?php echo $spro[0]; ?>"><?php echo $spro[1]." (".$spro[0].")"; ?>

<?php

}

?>

</select>

     </div></td>

  </tr>      

  <tr>

    <td width="146" height="52"><div align="center">Tracker ID</div></td>

    <td width="211"><div align="center">

      <p>

        <input type="text" name="trackid" id="trackid" value="" readonly="readonly" />

        </p>

      </div></td>

  <td width="29"></td>

    <td width="122"><div align="center">Consumer No</div></td>

    <td width="248"><div align="center">

      <p>

      <div id='divcon_no' style="display:block">

        <input type="text" name="con_no" id="con_no"  /></div><br />

        <!--<input type="checkbox" name="cons" id="cons" onclick="getdetails(this.value,'Consumer_No');" >&nbsp;&nbsp;

          <div id='divcon_no2' style="display:none">

        <input type="text" name="newcons" id="newcons" >--></div>

      </p>

    </div></td>

  </tr>

  

     <tr>

 <td width="146" height="52"><div align="center">Due DATE (Month in numbers Only)</div></td>

   <td><div align="center">

     <input type="text" name="duedate" id="duedate" />

   </div></td>

    <td width="29">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

     <td><div align="center">Landlord</div></td>

     <td><div align="center">

       <p>

         <input type="text" name="landlord" id="landlord" />

       </p>

     </div></td>

    </tr>    

<tr>

 <td width="146" height="52"><div align="center">Averarge Bill</div></td>

   <td><div align="center">

     <input type="text" name="avgbill" readonly="readonly" id="avgbill"/>

   </div></td>

    <td width="29">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

     <td><div align="center">Meter Number</div></td>

     <td><div align="center">

       <p>

       <input type="checkbox" name="cons" id="cons" />&nbsp;&nbsp;Search<br>

         <input type="text" name="meterno" id="meterno" onblur="getdetails(this.value,'meter_no');"/>

         <!--<input type="text" name="meterno" id="meterno" onblur="getdetails(this.value,'meter_no');" />-->

       </p>

     </div></td>

    </tr>

<tr>

 <td width="146" height="52"><div align="center">Supervisor</div></td>

   <td><div align="center">

     <select name="sv" id="sv"><option value="-1">Select</option>

			   <?php

			  // $sup=mysqli_query($con,"select username from login where designation='11' and serviceauth='3' and deptid='4' order by username ASC");

			  $sup=mysqli_query($con,"select distinct(hname) from fundaccounts order by hname ASC");

				 while($supro=mysqli_fetch_array($sup))

				{ ?>

				   <option value="<?php echo $supro[0]; ?>" ><?php echo $supro[0]; ?></option>

			   <?php } ?>  

			    </select>

   </div></td>

    

    <td width="29">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

     <td align="center">Amount</td>

     <td align="center"><input type="text" name="amount" id="amount" />

     <input type="hidden" name="ptype" id="ptype" value="paid" />

     </td>

</tr>



<tr>

  <td align="center">Remark</td>

     <td align="center"><textarea name="memo" id="memo"></textarea></td>

   <td width="29">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

   <td align="center">Priority</td>

     <td align="center"><select name="cases" id="cases"  height=20px>

   <option value="" >All</option>

    <option value="Normal" >Normal</option>

     <option value="Very Urgent" >Very Urgent</option>

     <option value="Disconnection" >Disconnection</option>

     </select></td>

   

</tr>



  <tr>

    <td colspan="11" align="center"><input type="hidden" name="stat" id="stat" value="paid"/><input type="submit" value="submit" id="cmdsub" name="cmdsub" />

   <!-- <input type="submit" name="cmdapp" id="cmdapp" value="Send for Approval" /> -->

          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

      <!--<a href="electricbills.php">cancel</a>-->  

     <?php if($_SESSION['designation']==8){ ?> <input type="button" name="update" id="update" value="Update" onclick="updateData();" /><?php } ?>

    </td>

  </tr>

</table>

</td></tr></table>

</form>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>

<script type="text/javascript" src="script.js"></script>

</body>

</html>