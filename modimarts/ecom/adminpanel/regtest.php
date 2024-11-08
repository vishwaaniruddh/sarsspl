<?php
session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_USER_NAME']) || (trim($_SESSION['SESS_USER_NAME']) == '')) 
	{
		header("location: access-denied.php");
		exit();
	} ?>
<?php
	ini_set( "display_errors", 0);
include('header.php'); 
include('config.php');



			  $qry="select code,name from cities";
			  $res=mysql_query($qry);                
			  $num=mysql_num_rows($res);

						  $qry1="select distinct code from categories";
						 $res1=mysql_query($qry1);                
						  $num1=mysql_num_rows($res1);     

       					$qry2="select max(code) as ncode from clients";   
						 $res2=mysql_query($qry2);
						 $row2=mysql_fetch_array($res2);
						       
							  $qry="select * from main_cat WHERE UNDER=0";
             				  $result=mysql_query($qry);  
?>



<style type="text/css">
#loginForm .has-error .control-label,
#loginForm .has-error .help-block,
#loginForm .has-error .form-control-feedback {
    color: #f39c12;
}

#loginForm .has-success .control-label,
#loginForm .has-success .help-block,
#loginForm .has-success .form-control-feedback {
    color: #18bc9c;
}

.form-submit1 {
    background: url(images/forms/form_submit.gif) no-repeat;
    border: none;
    cursor: pointer;
    display: block;
    
    height: 30px;
    margin: 0 4px 0 0;
    padding: 0;
    text-indent: -3000px;
    width: 80px;
}


</style>

<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<link href="datepc/dcalendar.picker.css" rel="stylesheet" type="text/css">

<script>

function getloc()
{
 //alert("ok");

    $.ajax({
             type: "POST",
             url: "getlocationtestr.php",
		datatype:'json',	
   data:'',

             success: function(msg){
                // alert(msg);
//alert(msg.city);
var jsr=JSON.parse(msg);
//alert(jsr['region_name']);


document.getElementById("state").value=jsr['region_name'];
//document.getElementById("city").value=jsr['city'];
city2(jsr['city']);
document.getElementById("Latitude").value=jsr['latitude'];
document.getElementById("Longitude").value=jsr['longitude'];

//var sp=msg.split('####');


/*$("#state option").each(function(i){
        alert($(this).text());
        
        if($(this).text()==sp[0])
        {
            alert($(this).text());
            $(this)prop('selected', true);
            
        }
    });*/

            }
         });
    
    
}

</script>

<script>



var searchReq = getXMLHttp();



function getXMLHttp()

{

  var xmlHttp

// alert("hi1");

  try

  {

    //Firefox, Opera 8.0+, Safari

    xmlHttp = new XMLHttpRequest();

  }

  catch(e)

  {

    //Internet Explorer

    try

    {

      xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");

    }

    catch(e)

    {

      try

      {

        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");

      }

      catch(e)

      {

        alert("Your browser does not support AJAX!")

        return false;

      }

    }

  }

  return xmlHttp;

}



function setFees(mt)

{

// var mt=document.forms[0].memtype.value;

// alert(mt);

 document.forms[0].fees.value=mt;

}



function setMode(mt)
{

 if(mt=="chq")
{
 document.forms[0].pay.disabled=false;
}
 else
{
 document.forms[0].pay.disabled=true;
}
}



function MakeRequest()

{

  var xmlHttp = getXMLHttp();

 //alert("hi");

  xmlHttp.onreadystatechange = function()

  {

    if(xmlHttp.readyState == 4)

    {

      HandleResponse(xmlHttp.responseText);

    }

  }

 //alert("hi2");

 // alert("getcategory.php?ccode="+document.forms[0].cat.value);

  xmlHttp.open("GET", "getcategory.php?ccode="+document.forms[0].cat.value, true);

  xmlHttp.send(null);

}



function HandleResponse(response)

{

  document.getElementById('res').innerHTML = response;

}



function searchSuggest() {

//alert("hi2");

	if (searchReq.readyState == 4 || searchReq.readyState == 0) {

		var str = escape(document.getElementById('area').value);

            var city = escape(document.getElementById('city').value);

//alert(""+str+"-"+city);

 		searchReq.open("GET", 'searcharea.php?search=' + str + '&city='+ city, true);

		searchReq.onreadystatechange = handleSearchSuggest; 

		searchReq.send(null);

	}		

}



function handleSearchSuggest() {

	if (searchReq.readyState == 4) {

		var ss = document.getElementById('search_suggest')

		ss.innerHTML = '';

		var str = searchReq.responseText.split("\n");

		for(i=0; i < str.length - 1; i++) {

			//Build our element string.  This is cleaner using the DOM, but

			//IE doesn't support dynamically added attributes.

			var suggest = '<div onmouseover="javascript:suggestOver(this);" ';

			suggest += 'onmouseout="javascript:suggestOut(this);" ';

			suggest += 'onclick="javascript:setSearch(this.innerHTML);" ';

			suggest += 'class="suggest_link">' + str[i] + '</div>';

			ss.innerHTML += suggest;

		}

	}

}



function suggestOver(div_value) {

	div_value.className = 'suggest_link_over';

}

//Mouse out function

function suggestOut(div_value) {

	div_value.className = 'suggest_link';

}




//Click function

function setSearch(value) {

	document.getElementById('area').value = value;

	document.getElementById('search_suggest').innerHTML = '';

}
//////////////////get city
function city1()
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
    document.getElementById("city1").innerHTML=xmlhttp.responseText;
  }
  }
  var str=document.getElementById('state').value;
 
xmlhttp.open("POST","getCity.php?id="+str,true);
//alert("getCity.php?id="+str);
xmlhttp.send();
}

function city2(city)
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
       // alert(xmlhttp.responseText);
    document.getElementById("city1").innerHTML=xmlhttp.responseText;
  }
  }
  var str=document.getElementById('state').value;
 
xmlhttp.open("POST","getCity.php?id="+str+"&city="+city,true);
//alert("getCity.php?id="+str);
xmlhttp.send();
}

var bl=true;
function val()
{
    
    try
    {
  if(checkemail()){

var catid = document.getElementById('cat');
//alert(catid);
var myElem = document.getElementsByName('subcat[]');
//alert(myElem.length);

if(catid=="0")
{
 alert('Select Category');
 bl= false;  
}
else if (myElem.length==0) {
    alert('subcategory does not exists');
 bl= false;   
    
}
else
{
    
   var myElem = document.getElementsByName('subcat[]');
   var arr=[];
  $('input[name="subcat[]"]:checked').each(function() {
 // alert(this.value);
  arr.push(this.value);
  
});
   
  if(arr.length>0){
      
      bl= true;
  }  else
  {
      
      bl= false;
      alert("select subcategory");
  }

}


    }
else{
     bl= false;
}
    
    
    }
    catch(exc)
    {
        
       alert(exc); 
    }
  return bl;
}
//================================================check email===================================================
var bool=false;

function checkemail()
{

//alert("hello");
    var email=document.getElementById('email').value;
   // alert(email);
    $.ajax({
             type: "POST",
             url: "checkemail.php",
			
   data:'email='+email,
             success: function(msg){
                 //alert("check");
//alert(msg);
if(msg==1)
{
    alert("Email id already exists !!");
    bool=false;
}
else
{
   bool=true;
    
    
}
            }
         }); 
   return bool;
}

</script>
<!--<script type="text/javascript" src="datepick_js.js"> </script>
<link type="text/css" href="date_css.css"  rel="stylesheet" />-->
<body onload="getloc();">

 
<!-- start content-outer -->
<div id="content-outer" style="padding: 0 25% 0 25%;">
<!-- start content -->
<div id="content">


<div id="page-heading">
  <h1 align="center">Add Customer</h1></div>


<table border="0" width="50%" cellpadding="0" cellspacing="0" id="content-table" align="center">
<tr>
	<th rowspan="3" class="sized"><img src="images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
	<th class="topleft"></th>
	<td id="tbl-border-top">&nbsp;</td>
	<th class="topright"></th>
	<th rowspan="3" class="sized"><img src="images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
</tr>
<tr>
	<td id="tbl-border-left"></td>
	<td>
	<!--  start content-table-inner -->
	<div id="content-table-inner" style="background-color:#f7eedc">
	
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td>
	
	
		
		<!-- start id-form   val-->
		<form action="processAddCustomer.php" method="post" enctype="multipart/form-data" id="loginForm" autocomplete="OFF" onsubmit="return val();">
		    
		    <input type="HIDDEN" id="Latitude" name="Latitude">
<input type="HIDDEN" id="Longitude" name="Longitude">
<!--<input type="HIDDEN" id="city" name="city">
<input type="HIDDEN" id="state" name="state">-->

<table width="100%" align="center"border="0" id="id-form" cellpadding="0" cellspacing="0">

<!--<tr><td width="30%" align="center">Company Code</td><td width="70%" ><input class="inp-form" type="text" name="code" size="50" value="<?php echo $row2['ncode']+1; ?>" readonly/></td></tr>-->

<tr><td align="center">Company Name</td><td><input type="text" name="cname" class="inp-form" size="50" required focus/></td></tr>

<tr><td align="center">State</td><td><select name="state"  id="state" class="styledselect_form_1"  onchange="city1()" ><option value="0" style="width: 12em" >select</option>
<?php 
$sqlm=mysql_query("select * from states");
while($rowm=mysql_fetch_row($sqlm)){
?>
				<option value="<?php echo $rowm[1]; ?>"><?php echo $rowm[1]; ?></option>
<?php } ?>
</select></td></tr>

<tr><td align="center">City</td><td><div id="city1">
<select class="styledselect_form_1" name="city" id="city" ><option value="0" style="width: 15em" >select</option>

</select></div></td></tr>

<tr><td align="center">Area</td><td><input type="text" name="area" id="area"  class="inp-form" onKeyUp="searchSuggest();" required autofocus/><div id="search_suggest">

</div></td></tr>

<tr><td align="center">Address</td><td><input type="text" name="add2"  class="inp-form" required autofocus/></td></tr>

<tr><td align="center">Company Telephone</td><td><input type="text" name="phone" size="50" class="inp-form" required autofocus/></td></tr>

<tr><td align="center">Company Fax</td><td><input type="text" name="fax" class="inp-form" /></td></tr>

<tr><td align="center">Company Email</td><td><input type="email" name="email" id="email" class="inp-form" required/><br/><br/>Email will be send to this email id</td></tr>
<tr><td align="center">Contact Person</td><td><input type="text" name="contact" class="inp-form" required autofocus/></td></tr>

<tr><td align="center">Mobile</td><td><input type="text" name="mobile" class="inp-form" required autofocus/></td></tr>

<tr><td align="center">Company Category</td><td><select name="cat" id="cat" class="styledselect_form_1" onChange="MakeRequest();" ><option value="0" >select</option>

<?php 
           		   while($row = mysql_fetch_row($result))
					{  ?>
                    
         <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
<?php } ?>

</select>    <div id="res" ></div></td></tr>

<tr><td align="center">No. Of Employees</td><td><input type="text" name="emp" size="50" class="inp-form"/></td></tr>
<!--
<tr><td align="center">Membership Type</td><td><input type="radio" name="memtype" value="0" size="50" onClick="setFees(this.value);" id="free" required autofocus/>
Free
&nbsp;<input type="radio"  class="ab"name="memtype" value="500" size="50" onClick="setFees(this.value);" />Bronze&nbsp;
<input type="radio" name="memtype" value="1000" size="50" onClick="setFees(this.value);" />Silver&nbsp; 
<input type="radio" name="memtype" value="1500" size="50" onClick="setFees(this.value);" />Gold&nbsp;
<input type="radio" name="memtype" value="3000" size="50" onClick="setFees(this.value);" />Platinum

-->
<label for="checkbox"></label></td></tr>

<tr><td align="center">Company Logo</td><td><input type="file" name="logo" class="inp-form"  size="50" /></td></tr>



<tr><td align="center">Company License</td><td><input type="text" name="lic" size="50" class="inp-form" /></td></tr>

<tr><td align="center">Company Fees</td><td><input type="text" name="fees" size="50" class="inp-form"/></td></tr>

<tr><td align="center">Year Of Establishment</td><td><input type="text" name="yoe" size="50" class="inp-form" /></td></tr>

<tr><td align="center">Date Of Registration</td><td><input type="text" name="rdate" id="rdate" onClick="displayDatePicker('rdate');" class="inp-form" required autofocus/></td></tr>
<script src="datepc/dcalendar.picker.js"></script>




</script>

<tr><td align="center">Adhar card no.</td><td><input type="text" name="adhar" size="50" class="inp-form" required autofocus/></td></tr>
<tr><td align="center">Pan card no.</td><td><input type="text" name="pan" size="50" class="inp-form" required autofocus/></td></tr>
<tr><td align="center">Establishment no.</td><td><input type="text" name="Establishment" class="inp-form" required autofocus/></td></tr>
<tr><td align="center">VAT TIN no.</td><td><input type="vat" name="vat" class="inp-form" required autofocus/></td></tr>

<!--
<tr><td align="center">Payment Mode</td><td><input type="radio" name="mop" value="cash" size="50" onClick="setMode(this.value);" autofocus/>Cash &nbsp;&nbsp;
<input type="radio" name="mop" value="chq" size="50" onClick="setMode(this.value);" />cheque</td></tr>

<tr><td align="center"></td><td><input type="text" name="pay" size="50" disabled="true" /></td></tr>
-->
<tr><td colspan="2" ><center><input type="submit" class="form-submit1" /></center></td></tr>

</table>

</form>

	<!-- end id-form  -->

	</td>
	<td>

	<!--  start related-activities --><!-- end related-activities -->

</td>
</tr>
<tr>
<td><img src="images/shared/blank.gif" width="695" height="1" alt="blank" /></td>
<td></td>
</tr>
</table>
 
<div class="clear"></div>
 

</div>
<!--  end content-table-inner  -->
</td>
<td id="tbl-border-right"></td>
</tr>
<tr>
	<th class="sized bottomleft"></th>
	<td id="tbl-border-bottom">&nbsp;</td>
	<th class="sized bottomright"></th>
</tr>
</table>









 





<div class="clear">&nbsp;</div>

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer -->

 

<div class="clear">&nbsp;</div>
    
<!-- start footer -->         
<div id="footer">
	<!--  start footer-left 
	<div id="footer-left">
	
	Admin Skin &copy; Copyright 1 Click Guide. <span id="spanYear"></span> <a href="http://www.1clickguide.org">www.1ClickGuide.org</a>. All rights reserved.</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
 </body>
 </html>