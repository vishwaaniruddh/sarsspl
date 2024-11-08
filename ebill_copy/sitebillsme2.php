<?php ini_set( "display_errors", 0);



include("access.php");





// header('Location:managesite1.php?id='.$id); 

 

include("config.php");



 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Site Bills</title>

<link href="style.css" rel="stylesheet" type="text/css" />

<link href="menu.css" rel="stylesheet" type="text/css" />

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />

<script src="datepicker/datepick_js.js" type="text/javascript"></script>

<script type="text/javascript">
function getdata(cid) {
//alert(val);
if(document.getElementById(cid).value=='')
{
//alert("Please select Client");
//document.getElementById('err').innerHTML="<h2>Please select Client</h2>";
}
else
{
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
    document.getElementById("atm").innerHTML=xmlhttp.responseText;
    }
  }
  var cid=document.getElementById(cid).value;
 
			//var url = 'getsiteatm.php'; 
		
			//var pmeters = 'cid='+cid+'&cat='+val;
	//alert("getsiteatm.php?cid="+cid+"&cat="+cat+"&bank="+bank+"&subcat+"+subcat);	
if(cid=='SBI'){
xmlhttp.open("GET","getsiteatm.php?cid="+cid,true);
xmlhttp.send();}else{
document.getElementById("atm").innerHTML='';
}

		  	
			
		}
  }
function getzone(id,field)
{
//alert(cid);
//alert("hi");
var po;
var cid=document.getElementById("cid").value;
var service=document.getElementById("service").value;

if(cid=='tata05')
po=document.getElementById('po').value;
else
po='';

//alert('hi');

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

document.getElementById(id).innerHTML='';

	document.getElementById(id).innerHTML=xmlhttp.responseText;

	

	

    }

  }

var project=document.getElementById("project").value;
var bank=document.getElementById("bank").value;
//alert("custpo.php?cid="+cid+"&bank="+bank+"&proj="+project+"&service="+service+"&po="+po+"&field="+field+'&tp='+field);
//var service=document.getElementById(service).value;
xmlhttp.open("GET","custpo.php?cid="+cid+"&bank="+bank+"&proj="+project+"&service="+service+"&po="+po+"&field="+field+'&tp='+field,true);

xmlhttp.send();




}

function getcust(cid,project,service)
{

//alert("hi");

	//alert(id+" "+type+" "+par);
//alert(cid+" "+service);
	var cust=document.getElementById(cid).value;

	var service=document.getElementById(service).value;
//alert(cust+" "+service);
	if(cust=='-1' || service=='-1')

	{

	alert("Client and Service is compulsory");

	}

	else

	{
var po;
	
	project=document.getElementById(project).value;

if(project!='-1')

project=project;

else

project='-1';





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

var str=xmlhttp.responseText;

str2=str.split("###");

//alert(str2[0]);

//alert(str2[1]);

document.getElementById(str2[1]).innerHTML='';

	document.getElementById(str2[1]).innerHTML=str2[0];

	

	

    }

  }

// alert("getcust.php?bank="+bank+"&tp=site&cid="+cust+"&proj="+project+"&service="+service);
//alert("getcust.php?tp=site&cid="+cust+"&proj="+project+"&service="+service+"&po="+po);
xmlhttp.open("GET","getcust.php?tp=site&cid="+cust+"&proj="+project+"&service="+service,false);



xmlhttp.send();

}

	

}



function getpo(cid,project,service,bank)
{
//alert(cid+" "+project+" "+service+" "+bank);
//alert("hi");
var cid=document.getElementById(cid).value;
var service=document.getElementById(service).value;
if(cid=='Tata05')
{
//alert('hi');
document.getElementById('po').style.display='block';
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

document.getElementById('pono').innerHTML='';

	document.getElementById('pono').innerHTML=xmlhttp.responseText;

	

	

    }

  }

 

  //alert("getcustbank.php?val="+val);

  //alert("newsitebank.php?cid="+cust+"&project="+project+"$service="+service);
var project=document.getElementById(project).value;
var bank=document.getElementById(bank).value;
//var service=document.getElementById(service).value;
//alert("custpo.php?cid="+cid+"&bank="+bank+"&proj="+project+"&service="+service);
xmlhttp.open("GET","custpo.php?cid="+cid+"&bank="+bank+"&proj="+project+"&service="+service+"&tp=po",true);

xmlhttp.send();



}
else{
document.getElementById('po').style.display='none';

}
}





function getbank(cid,project,service)
{

//alert("hi");

var cust=document.getElementById(cid).value;

var project=document.getElementById(project).value;

var service=document.getElementById(service).value;

	//alert(cust+" "+project+" "+service);

if(cust!='-1' && project !='x@' && service!='-1')

{

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

document.getElementById('bank').innerHTML='';

	document.getElementById('bank').innerHTML=xmlhttp.responseText;

	

	

    }

  }

 

  //alert("getcustbank.php?val="+val);

  //alert("newsitebank.php?cid="+cust+"&project="+project+"$service="+service);

xmlhttp.open("GET","newsitebank.php?cid="+cust+"&project="+project+"&service="+service,true);

xmlhttp.send();

}
else
{

alert("Customer, project, service is compulsory");

}

	

}

</script>

<script language=text/javascript>

 

 function validate1(form1){

 with(form1){

	 if(comp.value=='')

	 {

		 alert("Please Select company to continue");

		 comp.focus();

		 return false;

	 }

  

}

 return true;

 }

var datePickerDivID = "datepicker";

var iFrameDivID = "datepickeriframe";

 

var dayArrayShort = new Array('Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa');

var dayArrayMed = new Array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');

var dayArrayLong = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');

var monthArrayShort = new Array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');

var monthArrayMed = new Array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec');

var monthArrayLong = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October', 'November', 'December');

 

 function myalert()

 {

 alert("hello");

 }



var defaultDateSeparator = "/";       

var defaultDateFormat = "dmy"   ; 

var dateSeparator = defaultDateSeparator;

var dateFormat = defaultDateFormat;

 

function displayDatePicker(dateFieldName, displayBelowThisObject, dtFormat, dtSep)

{

//alert("hello");

  var targetDateField = document.getElementsByName(dateFieldName).item(0);

 

 

  if (!displayBelowThisObject)

    displayBelowThisObject = targetDateField;

 

 

  if (dtSep)

    dateSeparator = dtSep;

  else

    dateSeparator = defaultDateSeparator;

 

  if (dtFormat)

    dateFormat = dtFormat;

  else

    dateFormat = defaultDateFormat;

 

  var x = displayBelowThisObject.offsetLeft;

  var y = displayBelowThisObject.offsetTop + displayBelowThisObject.offsetHeight ;

 

  var parent = displayBelowThisObject;

  while (parent.offsetParent) {

    parent = parent.offsetParent;

    x += parent.offsetLeft;

    y += parent.offsetTop ;

  }

 //alert("hello1");

  drawDatePicker(targetDateField, x, y);

}

 

 

function drawDatePicker(targetDateField, x, y)

{

  var dt = getFieldDate(targetDateField.value );

//alert("wow");

 

  if (!document.getElementById(datePickerDivID)) {

 

    var newNode = document.createElement("div");

    newNode.setAttribute("id", datePickerDivID);

    newNode.setAttribute("class", "dpDiv");

    newNode.setAttribute("style", "visibility: hidden;");

    document.body.appendChild(newNode);

  }

 

  var pickerDiv = document.getElementById(datePickerDivID);

  pickerDiv.style.position = "absolute";

  pickerDiv.style.left = x + "px";

  pickerDiv.style.top = y + "px";

  pickerDiv.style.visibility = (pickerDiv.style.visibility == "visible" ? "hidden" : "visible");

  pickerDiv.style.display = (pickerDiv.style.display == "block" ? "none" : "block");

  pickerDiv.style.zIndex = 10000;

 

  // draw the datepicker table

  refreshDatePicker(targetDateField.name, dt.getFullYear(), dt.getMonth(), dt.getDate()); 

}

 

 

function refreshDatePicker(dateFieldName, year, month, day)

{

 //alert("fh");

  var thisDay = new Date();

 

  if ((month >= 0) && (year > 0)) {

    thisDay = new Date(year, month, 1);

  } else {

    day = thisDay.getDate();

    thisDay.setDate(1);

  }

 

 

  var crlf = "\r\n";

  var TABLE = "<table cols=7 class='dpTable'>" + crlf;

  var xTABLE = "</table>" + crlf;

  var TR = "<tr class='dpTR'>";

  var TR_title = "<tr class='dpTitleTR'>";

  var TR_days = "<tr class='dpDayTR'>";

  var TR_todaybutton = "<tr class='dpTodayButtonTR'>";

  var xTR = "</tr>" + crlf;

  var TD = "<td class='dpTD' onMouseOut='this.className=\"dpTD\";' onMouseOver=' this.className=\"dpTDHover\";' ";   

  var TD_title = "<td colspan=5 class='dpTitleTD'>";

  var TD_buttons = "<td class='dpButtonTD'>";

  var TD_todaybutton = "<td colspan=7 class='dpTodayButtonTD'>";

  var TD_days = "<td class='dpDayTD'>";

  var TD_selected = "<td class='dpDayHighlightTD' onMouseOut='this.className=\"dpDayHighlightTD\";' onMouseOver='this.className=\"dpTDHover\";' ";   

  var xTD = "</td>" + crlf;

  var DIV_title = "<div class='dpTitleText'>";

  var DIV_selected = "<div class='dpDayHighlight'>";

  var xDIV = "</div>";

 

  // start generating the code for the calendar table

  var html = TABLE;

 

  // this is the title bar, which displays the month and the buttons to

  // go back to a previous month or forward to the next month

  html += TR_title;

  html += TD_buttons + getButtonCode(dateFieldName, thisDay, -1, "&lt;") + xTD;

  html += TD_title + DIV_title + monthArrayLong[ thisDay.getMonth()] + " " + thisDay.getFullYear() + xDIV + xTD;

  html += TD_buttons + getButtonCode(dateFieldName, thisDay, 1, "&gt;") + xTD;

  html += xTR;

 

  // this is the row that indicates which day of the week we're on

  html += TR_days;

  for(i = 0; i < dayArrayShort.length; i++)

    html += TD_days + dayArrayShort[i] + xTD;

  html += xTR;

 

  // now we'll start populating the table with days of the month

  html += TR;

 

  // first, the leading blanks

  for (i = 0; i < thisDay.getDay(); i++)

    html += TD + "&nbsp;" + xTD;

 // alert("before update");

  // now, the days of the month

  do {

    dayNum = thisDay.getDate();

    TD_onclick = " onclick=\"updateDateField('" + dateFieldName + "', '" + getDateString(thisDay) + "');\">";

    

    if (dayNum == day)

      html += TD_selected + TD_onclick + DIV_selected + dayNum + xDIV + xTD;

    else

      html += TD + TD_onclick + dayNum + xTD;

    

    // if this is a Saturday, start a new row

    if (thisDay.getDay() == 6)

      html += xTR + TR;

    

    // increment the day

    thisDay.setDate(thisDay.getDate() + 1);

  } while (thisDay.getDate() > 1)

 

  // fill in any trailing blanks

  if (thisDay.getDay() > 0) {

    for (i = 6; i > thisDay.getDay(); i--)

      html += TD + "&nbsp;" + xTD;

  }

  html += xTR;

 

  var today = new Date();

  var todayString = "Today is " + dayArrayMed[today.getDay()] + ", " + monthArrayMed[ today.getMonth()] + " " + today.getDate();

  html += TR_todaybutton + TD_todaybutton;

  html += "<button class='dpTodayButton' onClick='refreshDatePicker(\"" + dateFieldName + "\");'>this month</button> ";

  html += "<button class='dpTodayButton' onClick='updateDateField(\"" + dateFieldName + "\");'>close</button>";

  html += xTD + xTR;

 

  // and finally, close the table

  html += xTABLE;

 

  document.getElementById(datePickerDivID).innerHTML = html;

 

 // adjustiFrame();

}

 

 

function getButtonCode(dateFieldName, dateVal, adjust, label)

{

 //alert("in getbuttoncode");

  var newMonth = (dateVal.getMonth () + adjust) % 12;

  var newYear = dateVal.getFullYear() + parseInt((dateVal.getMonth() + adjust) / 12);

  if (newMonth < 0) {

    newMonth += 12;

    newYear += -1;

  }

 

  return "<button class='dpButton' onClick='refreshDatePicker(\"" + dateFieldName + "\", " + newYear + ", " + newMonth + ");'>" + label + "</button>";

}

 

 

function getDateString(dateVal)

{

 //alert("in getdatestring");

  var dayString = "00" + dateVal.getDate();

  var monthString = "00" + (dateVal.getMonth()+1);

  dayString = dayString.substring(dayString.length - 2);

  monthString = monthString.substring(monthString.length - 2);

 

  switch (dateFormat) {

    case "dmy" :

      return dayString + dateSeparator + monthString + dateSeparator + dateVal.getFullYear();

    case "ymd" :

      return dateVal.getFullYear() + dateSeparator + monthString + dateSeparator + dayString;

    case "mdy" :

    default :

      return monthString + dateSeparator + dayString + dateSeparator + dateVal.getFullYear();

  }

}

 

 

function getFieldDate(dateString)

{

  var dateVal;

  var dArray;

  var d, m, y;

 //alert("in getFielddate");

  try {

    dArray = splitDateString(dateString);

    if (dArray) {

      switch (dateFormat) {

        case "dmy" :

          d = parseInt(dArray[0], 10);

          m = parseInt(dArray[1], 10) - 1;

          y = parseInt(dArray[2], 10);

          break;

        case "ymd" :

          d = parseInt(dArray[2], 10);

          m = parseInt(dArray[1], 10) - 1;

          y = parseInt(dArray[0], 10);

          break;

        case "mdy" :

        default :

          d = parseInt(dArray[1], 10);

          m = parseInt(dArray[0], 10) - 1;

          y = parseInt(dArray[2], 10);

          break;

      }

      dateVal = new Date(y, m, d);

    } else if (dateString) {

      dateVal = new Date(dateString);

    } else {

      dateVal = new Date();

    }

  } catch(e) {

    dateVal = new Date();

  }

 

  return dateVal;

}

 

 



function splitDateString(dateString)

{

 //alert("in splitdate");

  var dArray;

  if (dateString.indexOf("/") >= 0)

    dArray = dateString.split("/");

  else if (dateString.indexOf(".") >= 0)

    dArray = dateString.split(".");

  else if (dateString.indexOf("-") >= 0)

    dArray = dateString.split("-");

  else if (dateString.indexOf("\\") >= 0)

    dArray = dateString.split("\\");

  else

    dArray = false;

 

  return dArray;

}

 

function updateDateField(dateFieldName, dateString)

{

 //alert("in updateFielddate");

  var targetDateField = document.getElementsByName 



(dateFieldName).item(0);

  if (dateString)

    targetDateField.value = dateString;

 

  var pickerDiv = document.getElementById(datePickerDivID);

  pickerDiv.style.visibility = "hidden";

  pickerDiv.style.display = "none";

 

  adjustiFrame();

  targetDateField.focus();

 

  // after the datepicker has closed, optionally run a user-defined 



//function called

  // datePickerClosed, passing the field that was just updated as a 



//parameter

  // (note that this will only run if the user actually selected a date 



//from the datepicker)

  if ((dateString) && (typeof(datePickerClosed) == "function"))

    datePickerClosed(targetDateField);

}

 

 

function adjustiFrame(pickerDiv, iFrameDiv)

{/*

  // we know that Opera doesn't like something about this, so if we

  // think we're using Opera, don't even try

  var is_opera = (navigator.userAgent.toLowerCase().indexOf("opera") != -1);

  if (is_opera)

    return;

  

  // put a try/catch block around the whole thing, just in case

  try {

    if (!document.getElementById(iFrameDivID)) {

      // don't use innerHTML to update the body, because it can cause global variables

  

    document.body.innerHTML += "<iframe id='" + iFrameDivID + "' src='javascript:false;' scrolling='no' frameborder='0'>";

      var newNode = document.createElement("iFrame");

      newNode.setAttribute("id", iFrameDivID);

      newNode.setAttribute("src", "javascript:false;");

      newNode.setAttribute("scrolling", "no");

      newNode.setAttribute ("frameborder", "0");

      document.body.appendChild(newNode);

    }

    

    if (!pickerDiv)

      pickerDiv = document.getElementById(datePickerDivID);

    if (!iFrameDiv)

      iFrameDiv = document.getElementById(iFrameDivID);

    

    try {

      iFrameDiv.style.position = "absolute";

      iFrameDiv.style.width = pickerDiv.offsetWidth;

      iFrameDiv.style.height = pickerDiv.offsetHeight ;

      iFrameDiv.style.top = pickerDiv.style.top;

      iFrameDiv.style.left = pickerDiv.style.left;

      iFrameDiv.style.zIndex = pickerDiv.style.zIndex - 1;

      iFrameDiv.style.visibility = pickerDiv.style.visibility ;

      iFrameDiv.style.display = pickerDiv.style.display;

    } catch(e) {

    }

 

  } catch (ee) {

  }

*/ 

}

 

 

</script> 

 

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





<script type="text/javascript">

function validate()

{

	if(document.getElementById("comp").value=='')

	{

		alert("Please select Company");

		return false;

	}

	return true;

}







function cleardata()

{

//document.getElementById('cid').innerHTML="";

document.getElementById('project').innerHTML="";

document.getElementById('bank').innerHTML="";

//document.getElementById('cid').innerHTML="";

document.getElementById('project').innerHTML="";

//document.getElementById('cid').selected='-1';

document.getElementById('bank').innerHTML="<option value='-1'>Select</option>";

document.getElementById('project').innerHTML="<option value='-1'>Select</option>";



}

</script>

<script src="php_calendar/scripts.js" type="text/javascript"></script>

</head>



<body onload="<?php if(isset($_GET['cid']) && isset($_GET['serv'])){ ?>getcust('cid','project','service'); <?php } ?>" >

<center>

<?php include("menubar.php");

//echo $_SESSION['branch'];

 ?></center>

<div align="center">

  <h2 class="style1">SITE BILLS</h2>

</div><br /><br />

<form id="form1" name="form1" method="post" action="showsitebillsme.php" onsubmit="validate1(this)" >
 <!-- <form id="form1" name="form1" method="post" action="showsitebills2temp.php" onsubmit="validate1(this)" >-->


 <table width="375" border="1" align="center" cellpadding="4" cellspacing="0">

  <?php





	

		$sql = "SELECT contact_first,short_name FROM contacts where type='c' order by contact_first ASC" ;

		$result = mysqli_query($con,$sql);

	?>

    <tr>

    <td>Select company:</td><td><select name="comp" id="comp" ><option value="-1">select</option>

<?php $res=mysqli_query($con,"select * from company_details");

      while($row=mysqli_fetch_array($res))

      { ?>

       <option value='<?php echo $row[0]; ?>'<?php if(isset($_GET['comp']) && $_GET['comp']==$row[0]){ ?> selected <?php }  ?>  ><?php echo $row[1]; ?></option>

     <?php } ?></select>

</td>

    </tr>

<tr>

    <td>Services</td>

    <td><div align="left"><select name="service" id="service">

    <option value='-1'>Select</option>

	<option value="caretaker" <?php if(($_GET['serv'])=='caretaker'){ ?> selected <?php }  ?>> Caretaker  </option>  

	<option value="housekeeping" <?php if(($_GET['serv'])=='housekeeping'){ ?> selected <?php }  ?>> housekeeping  </option>

	<option  value="maintenance" <?php if(($_GET['serv'])=='maintenance'){ ?> selected <?php }  ?>> maintenance </option>
<option  value="maintenance CT" <?php if($_GET['serv']=="housekeeping='Y' and maintenance"){ ?> selected <?php }  ?> >CT maintenance </option>
<option  value="maintenance HK"<?php if($_GET['serv']=="housekeeping='Y' and maintenance"){ ?> selected <?php }  ?> >HK maintenance
</option>	</select>

    </div></td>

  </tr>

  <tr>

    <td><div align="center">Customer ID </div></td>

    <td><div align="left"><select name="cid" id="cid" onchange="getcust(this.id,'project','service');getdata(this.id);" ><option value="-1">-- select --</option>

    <?php 

           while($row = mysqli_fetch_row($result))

		{

                      $cust = $row[0] ;

                             // echo $cust ;

                   ?>            <option value="<?php echo $row[1] ; ?>"<?php if(isset($_GET['cid']) && $_GET['cid']==$row[1]){ ?> selected <?php }  ?>  ><?php echo $row[0] ; ?></option>

                   <?php } ?></select>

    </div>
    
    </td>

  </tr>

    <tr>

    <td><div align="center">Project ID</div></td>

    <td><div align="left"><select name="project" id="project" onchange="getbank('cid','project','service','pono')" ><option value="-1">-- select --</option>

    <?php 

           while($row = mysqli_fetch_row($result))

		{

                      $cust = $row[0] ;

                             // echo $cust ;

                   ?>            <option value="<?php echo $row[1] ; ?>" ><?php echo $row[0] ; ?></option>

                   <?php } ?></select>

    </div></td>

  </tr>
<tr>

    <td><div align="center">Atm</div></td>

    <td><div align="left">
    

      <select multiple="multiple" name="atm[]"  id="atm"><option value="-1">All</option>
</select>

    </div>

<div id="po" style="display:none"><select name="pono" id="pono" onchange="getzone('zone','zone');" >
    <option value="">-Select PO Number-</option>
    </select></div></td>

  </tr>
  <tr>

    <td><div align="center">Bank </div></td>

    <td><div align="left">
    <label for='formCountries[]'></label><br>

      <select multiple="multiple" name="formCountries[]"  id="bank" onchange="getzone('zone','zone');getpo('cid','project','service','bank','zone');"><option value="-1">All</option>
</select>

    </div><div id="po" style="display:none"><select name="pono" id="pono" onchange="getzone('zone','zone');" >
    <option value="">-Select PO Number-</option>
    </select></div></td>

  </tr>
<tr><td>Zone</td><td><select name="zone" id="zone">
<option value="">Select Zone</option>
</select></td></tr>
  <tr>

    <td><div align="center">City </div></td>

    <td><div align="left">

      <select name="city" ><option value="-1">All</option>

    <?php 

           $sql2 = "SELECT distinct city FROM sites";

	   $result2 = mysqli_query($con,$sql2);

           while($row2 = mysqli_fetch_row($result2))

		{

                   ?>            <option value="<?php echo $row2[0] ; ?>" ><?php echo $row2[0] ; ?></option>

                   <?php } ?></select>

    </div></td>

  </tr>

  

  <tr>

    <td><div align="center">From </div></td>

    <td><div align="left">

      <input type="text" name="from" id="from" value="<?php if(isset($_GET['stdt'])) { echo date('d/m/Y',strtotime($_GET['stdt'])); }  ?>"/><input type="button" name="button" value="select" onclick="displayDatePicker('from');"> 

    </div></td>

  </tr>

  <tr>

    <td><div align="center">To </div></td>

    <td><div align="left">

      <input type="text" name="to" id="to"  value="<?php if(isset($_GET['todt'])) { echo date('d/m/Y',strtotime($_GET['todt'])); }  ?>"/><input type="button" name="button" value="select" onclick="displayDatePicker('to');"> 

    </div></td>

  </tr>

  <tr>

    <td colspan="2" align="center">

    <input type="hidden" name="id" value="<?php echo $id  ?>" >

    <input type="submit" value="submit" /></td>

  </tr>

</table>



</form>

<p>&nbsp;</p>

<script type="text/javascript" src="1.7.2.jquery.min.js"></script>

<script type="text/javascript" src="script.js"></script>

</body>

</html>