<?php
session_start();

 if(isset($_SESSION['adminuser']) && isset($_SESSION['id']))
{	
$id=$_SESSION['id'];
include "config.php"; 
$sql = mysqli_query($con1,"SELECT * FROM `clients` WHERE code ='$id'");
$row = mysqli_fetch_array($sql);
//echo $row[0];	


//$View = mysql_query("SELECT id,user_id,amount,status,date FROM `Order` where id='".."'");

?>

<!doctype html>
<html lang="en">
<head>
  <!-- Meta -->
  <meta charset="UTF-8">
  <meta name="author" content="Acura">
  <meta name="description" content="Acura - A Real Admin Template">
  <meta name="keywords" content="Acura, Admin Template, Admin, Premium, ThemeForest, Clean, Modern, Responsive">
  <!-- Responsive viewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <!-- Title -->
  <title>Welcome</title>
  <script src="../js/jquery.min.js"></script>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />

<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />	

<script type="text/javascript" src="../adminpanel/datepick_js.js"> </script>
<link type="text/css" href="date_css.css"  rel="stylesheet" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


  

<script>
    

  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>




<style>
/*
.table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 17px;
    border-spacing: 0;
    border: 0px solid #dddddd;
}
.table-bordered {
    border: 1px solid #dddddd;
}

ul.unit li {
    display: inline-block;
    width: 14%;
    float: left;
}



ul.cart-header li {
    display: inline-block;
    width: 14%;
    float: left;
    */
    
    
    .table1 {
	background: #f5f5f5;
	border-collapse: separate;
	  border-spacing: 0;
	box-shadow: inset 0 1px 0 #fff;
	font-size: 14px;
	line-height: 15px;
	margin: 30px auto;
	text-align: left;

	width: 100%;
    max-width: 100%;
}	

th {
	background: url(http://jackrugile.com/images/misc/noise-diagonal.png), linear-gradient(#777, #444);
	border-left: 1px solid #555;
	border-right: 1px solid #777;
	border-top: 1px solid #555;
	border-bottom: 1px solid #333;
	box-shadow: inset 0 1px 0 #999;
	color: #fff;
   font-weight: bold;
	padding: 10px 15px;
	position: relative;
	text-shadow: 0 1px 0 #000;	
}

th:after {
	background: linear-gradient(rgba(255,255,255,0), rgba(255,255,255,.08));
	content: '';
	display: block;
	height: 25%;
	left: 0;
	margin: 1px 0 0 0;
	position: absolute;
	top: 25%;
	width: 100%;
}

th:first-child {
	border-left: 1px solid #777;	
	box-shadow: inset 1px 1px 0 #999;
}

th:last-child {
	box-shadow: inset -1px 1px 0 #999;
}

td {
	border-right: 1px solid #fff;
	border-left: 1px solid #e8e8e8;
	border-top: 1px solid #fff;
	border-bottom: 1px solid #e8e8e8;
	padding: 10px 15px;
	position: relative;
	transition: all 300ms;
}

    
    
}
</style>
                            

<style type="text/css">
#overlay {
position: fixed;
top: 0;
left: 0;
width: 100%;
height: 100%;
background-color: #000;
filter:alpha(opacity=70);
-moz-opacity:0.7;
-khtml-opacity: 0.7;
opacity: 0.7;
z-index: 0;
display: none;
}
.cnt223 a{
text-decoration: none;
}
.popup{
width: 100%;
margin: 0 auto;
display: none;
position: fixed;
z-index: 101;
}
.cnt223{

width: 500px;
height: 300px;
min-height: 150px;
padding: 5px;
/*margin: 100px auto;*/
margin-left: 10%;
margin-top: 10%;
background: #FFFFFF;
position: relative;
z-index: 103;

border-radius: 5px;
box-shadow: 0 2px 5px #000;
}
.cnt223 p{
clear: both;
color: #555555;
text-align: justify;
}
.cnt223 p a{
color: #d91900;
font-weight: bold;
}
.cnt223 .x{
float: right;

top: -25px;
width: 34px;
}
.cnt223 .x:hover{
cursor: pointer;
}

.myButton {
	-moz-box-shadow: 0px 0px 0px 2px #9fb4f2;
	-webkit-box-shadow: 0px 0px 0px 2px #9fb4f2;
	box-shadow: 0px 0px 0px 2px #9fb4f2;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #083a8f), color-stop(1, #1b80fa));
	background:-moz-linear-gradient(top, #083a8f 5%, #1b80fa 100%);
	background:-webkit-linear-gradient(top, #083a8f 5%, #1b80fa 100%);
	background:-o-linear-gradient(top, #083a8f 5%, #1b80fa 100%);
	background:-ms-linear-gradient(top, #083a8f 5%, #1b80fa 100%);
	background:linear-gradient(to bottom, #083a8f 5%, #1b80fa 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#083a8f', endColorstr='#1b80fa',GradientType=0);
	background-color:#083a8f;
	-moz-border-radius:10px;
	-webkit-border-radius:10px;
	border-radius:10px;
	border:1px solid #4e6096;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:19px;
	padding:6px 30px;
	text-decoration:none;
	text-shadow:0px 1px 0px #283966;
}
.myButton:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #1b80fa), color-stop(1, #083a8f));
	background:-moz-linear-gradient(top, #1b80fa 5%, #083a8f 100%);
	background:-webkit-linear-gradient(top, #1b80fa 5%, #083a8f 100%);
	background:-o-linear-gradient(top, #1b80fa 5%, #083a8f 100%);
	background:-ms-linear-gradient(top, #1b80fa 5%, #083a8f 100%);
	background:linear-gradient(to bottom, #1b80fa 5%, #083a8f 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#1b80fa', endColorstr='#083a8f',GradientType=0);
	background-color:#1b80fa;
}


.myButton1 {

	background-color:#1b80fa;


	color:#ffffff;
	
	font-size:36px;

}
.myButton1:hover {

color:#000;
	background-color:#1b80fa;
}


.cnt223321{
height: 29px;
background: #00a0e4;
color: #fff;
padding:9px 32px;
position: relative;
z-index: 103;

</style>
        
<script>
   var overlay 
function popshow(oid,id)
{
    if(id==1)
    {
        document.getElementById('show1').style.display="";
        document.getElementById('show2').style.display="none";
         document.getElementById('show3').style.display="none";
        document.getElementById('show4').style.display="none"
    }
    else if(id==2)
    {
        document.getElementById('show2').style.display="";
        document.getElementById('show1').style.display="none";
         document.getElementById('show3').style.display="none";
       document.getElementById('show4').style.display="none"
        
    }
    else if(id==3)
    {  document.getElementById('show3').style.display="";
       
         document.getElementById('show2').style.display="none";
        document.getElementById('show1').style.display="none";
        document.getElementById('show4').style.display="none"
        
    }
    else if(id==6)
    {
        document.getElementById('show4').style.display="";
       
         document.getElementById('show2').style.display="none";
        document.getElementById('show1').style.display="none";
        document.getElementById('show3').style.display="none";
        
    }
     overlay = $('<div id="overlay"></div>');
overlay.show();
overlay.appendTo(document.body);
$('.popup').show();
document.getElementById('oid').value=oid;
}
function popupclose()
{
  
    $('.popup').hide();
overlay.appendTo(document.body).remove();
return false;
    
}
/*
function locupdt()
{
    var oid=document.getElementById('oid').value;
     var loc=document.getElementById('loc1').value;
    //alert(oid);
    //alert(loc);
    $.ajax({
   type: 'POST',    
url:'loc_update.php',
data:'oid='+oid+'&loc='+loc+'&st=1',

success: function(msg){
//alert("test");
//alert(msg);
if(msg==1)
{
    alert("location updated!!");
}
else
{
    alert("error");
    
}

         }
     });
}

*/
function rejct()
{
    var oid=document.getElementById('oid').value;
    var rj=document.getElementById('rj').value;
    if(rj!=""){
    $.ajax({
   type: 'POST',    
url:'loc_update.php',
data:'oid='+oid+'&rj='+rj+'&st=2',

success: function(msg){

//alert(msg);
if(msg==1)
{
    alert("Reason Submitted!!");
}
else
{
    alert("error");
    
}
popupclose();
        }
     });
}}


function sub()
{

var datepicker=document.getElementById('datepicker').value;
var oid=document.getElementById('oid').value;

$.ajax({
             type: "POST",
             url: "deli_date.php",
 
             data: 'datepicker='+datepicker+'&oid='+oid,

             success: function(msg){
            // alert("dsjfhn");
            //alert(msg);
if(msg==1)
{
alert("Success !!");
popupclose();
orderprocess(oid,'5');
}
  //document.getElementById('show').innerHTML=msg;
  },
 error: function (request, status, error) {
        alert(error);
    }
         });
    
}

function com()
{
   var datepicker=document.getElementById('datepicker').value;
   	if (datepicker == "")
	{
		alert(" Please select date");
		
	}
		else
	{
	    
	sub();
	}
	
}



function showdeatis(uid)
{//alert(uid);

   $.ajax({
   type: 'POST',    
url:'viewdetails.php',
data:'uid='+uid,

success: function(msg){
//alert("test");
//alert(msg);
document.getElementById('ordershow').style.display="none";
document.getElementById('a').style.display="";
document.getElementById('show').innerHTML=msg;

         }
     });


}
</script>

<script>
function orderprocess(oid,num)
{

//alert(oid);
var Session_merid="<?php echo  $_SESSION['id'];?>";


$.ajax({
   type: 'POST',    
url:'orderprocess.php',
data:'oid='+oid+'&num='+num+'&Session_merid='+Session_merid,

success: function(msg){

//alert(msg);


if(num=="4"){
    
    popshow(oid,'3');
}
funcs('','');
//document.getElementById('ordershow').innerHTML=msg;
showdeatis('46');
         }
     });
}


</script>
<script>
function funcs(strPage,perpg)
{

var fdate=document.getElementById('fdate').value;
var tdate=document.getElementById('tdate').value;
var progress=document.getElementById('progressid').value;
//var actionid=document.getElementById('actionid').value;

var orderid=document.getElementById('orderid').value;


//alert("helloo");
//alert(sr);
if(perpg=="")
{
perp='10';
}
else
{
perp=document.getElementById(perpg).value;
}
var Page="";
if(strPage!="")
{
Page=strPage;
}

//alert("test");
$.ajax({
   type: 'POST',    
url:'orderdetails.php',
data:'Page='+Page+'&perpg='+perp+'&fdate='+fdate+'&tdate='+tdate+'&progress='+progress+'&orderid='+orderid,

success: function(msg){
//alert(msg);
  document.getElementById('ordershow').innerHTML=msg;
         }
     });

}
//===========rejected

function funchk(id,chkid,txtid)
{
//alert("check");
var txt=document.getElementById(txtid).value;
//alert(txt);
var chkid=document.getElementById(chkid).checked;

//alert(chkid);
$.ajax({
             type: "POST",
             url: "process_reject.php",
 
             data: 'id='+id+'&chkid='+chkid+'&txt='+txt,

             success: function(msg){
            // alert("dsjfhn");
           // alert(msg);
if(msg==1)
{
//location.reload();
}
  //document.getElementById('show').innerHTML=msg;
  },
 error: function (request, status, error) {
        alert(error);
    }
         });

}

//==============
function disdetails()
{
   
    if (document.getElementById('Courier').checked) {
  rd = document.getElementById('Courier').value;
}
else if(document.getElementById('self').checked)
{
  rd = document.getElementById('self').value;
}
var sname=document.getElementById('sname').value;
var contact=document.getElementById('contact').value;
var cname=document.getElementById('cname').value;
var dcn=document.getElementById('dcn').value;
var oid=document.getElementById('oid').value;
var loc=document.getElementById('loc').value;
var prid=document.getElementById('prid').value;
var ctid=document.getElementById('ctid').value;
 
$.ajax({
             type: "POST",
             url: "process_dispatch.php",
 
             data: 'sname='+sname+'&contact='+contact+'&cname='+cname+'&dcn='+dcn+'&rd='+rd+'&oid='+oid+'&loc='+loc+'&prid='+prid+'&ctid='+ctid,

             success: function(msg){
            // alert("dsjfhn");
          //  alert(msg);
if(msg==1)
{
alert("Order dispatched !!");
popupclose();
orderprocess(oid,'2');
}
  //document.getElementById('show').innerHTML=msg;
  },
 error: function (request, status, error) {
        alert(error);
    }
         });
    
}

function validation(){
  
   if(document.getElementById('Courier').checked)
{
var cname=document.getElementById('cname').value;
var dcn=document.getElementById('dcn').value;
var loc=document.getElementById('loc').value;
	if (cname == "")
	{
		alert("Courier Name can not be empty");
	}
	else if (dcn == "")
	{
		alert("Docket Number can not be empty");
	}
	else if ( loc == "")
	{
		alert(" location can not to be empty");
	}
	else
	{
	disdetails();
	}

}
else if(document.getElementById('self').checked)
{
  
var sname=document.getElementById('sname').value;
var contact=document.getElementById('contact').value;
var loc=document.getElementById('loc').value;
	if (sname == "")
	{
		alert("Person Name can not be empty");
		
	}
	else if (contact == "")
	{
		alert("contact can not be empty");
	
	}
	
	else if ( loc == "")
	{
		alert(" location can not to be empty");
		
	}
	else
	{
	    
	disdetails();
	}

}

}


//==========
function funshow()
{
   // alert("chekcldsf");
  if(document.getElementById('Courier').checked)
{
    document.getElementById('showscourier').style.display="";
     document.getElementById('showself').style.display="none";
     
      document.getElementById('sname').value="";
   document.getElementById('contact').value="";
}
else if(document.getElementById('self').checked)
{
    document.getElementById('showscourier').style.display="none";
    document.getElementById('showself').style.display="";
    
    
       
   document.getElementById('cname').value="";
   document.getElementById('dcn').value="";
    
   
    
}
}

//====
function checkAll(name,checkId){
//alert("testing");

if(document.getElementById(checkId).checked==true)
{
//alert("truuee");
        var inputs = document.getElementsByName("chk[]");

//alert(inputs.length);
        for (var i = 0; i < inputs.length; i++) { 

             inputs[i].checked = true;
               
            
        }  
}
else
{
//alert("falseeee");
var inputs = document.getElementsByName("chk[]");

//alert(inputs.length);
        for (var i = 0; i < inputs.length; i++) { 

             inputs[i].checked = false;
               
            
        }  
}
    }
</script>
</head>
<?php
include('header.php');
?>        
<body onload="funcs('','');">


<script>
      function isNumberKey(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
  </script>

    <div id="show1">
    <div class='popup'>
<div class='cnt223' >
<div class="cnt223321">
 <center><h3><b>Dispatch details</b></h3></center>
</div>
</br></br>
<center>
    <div class="row">
    <b style="font-size:16px;" class="col-4-md">Mode :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="mode" value="self" id="self" onchange="funshow();" checked> Self &nbsp;&nbsp;&nbsp;
  <input type="radio" name="mode" id="Courier" value="Courier" onchange="funshow();"> Courier<br><br/>
  
  <div id="showself">
        <b style="font-size:16px;" class="col-4-md">Person Name :</b> <input type="text" id="sname" style="width:200px; height:30px;" name="sname"  autofocus><br/><br/>
        <b style="font-size:16px;margin-left: -26px;" class="col-4-md">Contact Number :</b> <input type="text" id="contact" style="width:200px;height:30px;margin-left: 2Px;" name="contact" onkeypress="return isNumberKey(event)" maxlength="10" required autofocus><br/><br/>
  </div>
<div id="showscourier" style="display:none">
    <b style="font-size:16px;" class="col-4-md">Courier Name :</b> <input type="text" id="cname" style="width:200px; height:30px;" name="cname" required autofocus><br/><br/>
    <b style="font-size:16px;margin-left: -19px;" class="col-4-md">Docket Number :</b> <input type="text" id="dcn" style="width:200px;height:30px;margin-left: 1px;" name="dcn" onkeypress="return isNumberKey(event)" required autofocus><br/><br/>
</div> 
<!--<b style="font-size:16px;">Date :</b> <input type="text" id="date" style="width:200px; height:30px;" name="date" onClick="displayDatePicker('rdate');">-->

<b style="font-size:16px;margin-left: -28px;" class="col-4-md">Current Location :</b> <input type="text" id="loc" style="width:200px; height:30px;" name="loc" required autofocus><br/><br/>
<a href="javascript:void(0)" class="myButton" onclick="validation();">Submit</a>&nbsp;&nbsp;
<a href="javascript:void(0)" class="myButton" onclick="popupclose();">Cancel</a>
</center>
</div>
</div>
</div>



 <div id="show2">
    <div class='popup'>
<div class='cnt223'>
<div class="cnt223321">
 <center><h3><b>Update Location</b></h3></center>
</div>
</br></br>
<center>
  

<!--<b style="font-size:16px;">Date :</b> <input type="text" id="date" style="width:200px; height:30px;" name="date" onClick="displayDatePicker('rdate');">-->
<br/><br/>
<b style="font-size:16px;">Current Location :</b> <input type="text" id="loc1" style="width:200px; height:30px;" name="loc1" required autofocus><br/><br/><br/><br/>

<!--
<a href="javascript:void(0)" class="myButton" onclick="locupdt();">Update</a>&nbsp;&nbsp;
<a href="javascript:void(0)" class="myButton" onclick="popupclose();">Cancel</a>
-->
</center>
</div>
</div>
</div>




 <div id="show4">
    <div class='popup'>
<div class='cnt223'>
<div class="cnt223321">
 <center><h3><b>Deliverd Date</b></h3></center>
</div>
</br></br>
<center>
  
<br/><br/>
<b style="font-size:16px;">Select Date :</b> <br/><input type="text" id="datepicker" style="width:200px; height:30px;" name="datepicker" required autofocus><br/><br/><br/>
<a href="javascript:void(0)" class="myButton" onclick="com();">Submit</a>&nbsp;&nbsp;
<a href="javascript:void(0)" class="myButton" onclick="popupclose();">Cancel</a>

</center>
</div>
</div>
</div>






 <div id="show3">
    <div class='popup'>
<div class='cnt223'>
<div class="cnt223321">
 <center><h3><b>Reject Product</b></h3></center>
</div>
</br></br>
<center>
  

<!--<b style="font-size:16px;">Date :</b> <input type="text" id="date" style="width:200px; height:30px;" name="date" onClick="displayDatePicker('rdate');">-->
<br/><br/>
<b style="font-size:16px;">Reason For Reject:</b> <textarea rows="4" cols="50" id="rj" name="rj" style="width:200px; height:30px;"  required autofocus>
    </textarea><br/><br/><br/><br/>
<a href="javascript:void(0)" class="myButton" onclick="rejct();">Submit</a>&nbsp;&nbsp;

</center>
</div>
</div>
</div>
        <!-- Title & Sitemap -->
        <input type="hidden" id="oid" name="oid">
        <div class="title-sitemap grid-12">
          <h1 class="grid-6"><i>&#xf132;</i><span>Welcome to User Panel</span></h1>
        <!--  <div class="sitemap grid-6">
            <ul>
              <li><span>1click</span><i>/</i></li>
              <li><a href="index.php">User Panel</a></li>
            </ul>
          </div>-->
        </div>
      </header>
      <!-- Data -->
      <div class="data grid-12">
        <!-- Simple Chart -->
        <div class="grid-12">
          <div class="widget">
            <header class="widget-header">
              <div class="widget-header-icon">&#xf109;</div>
              <h3 class="widget-header-title" id="a" style="display:none"><strong><a href="order.php">Back</a></strong></h3>
            </header>
            <div class="widget-body" >
                <table>
                    <tr> 
                        <td>
              <input type="text" name="rdate" id="fdate" onClick="displayDatePicker('rdate');" class="inp-form" placeholder="from date" style="heigth:30px;width:100px"/></td>
               <td><input type="text" name="tdate" id="tdate" onClick="displayDatePicker('tdate');" class="inp-form" placeholder="to date"/></td>
                <td>
            Progress : <select id="progressid">
                <option value="">select</option>
                <option value="pending">Pending</option>
                <option value="Accept">Accept</option>
                <option value="pr">Processing</option>
                <option value="dis">Dispatch</option>
                <option value="completed">Completed</option>
                <option value="rej">Reject</option>
                </select></td>
               <td>  &nbsp;   &nbsp;
                <input type="text" id="orderid" name="orderid" placeholder="Order ID"></td>
                 <td>
                    <input type="button" value="Search" onclick="funcs('','');" style="background: url(http://jackrugile.com/images/misc/noise-diagonal.png), linear-gradient(#777, #444);	color: #fff;"/> 
                    
                 </td>
                 </tr>
                 </table>
<div id="ordershow">

             </div>
             <div id="show"></div>
    
      </div>
 
</div>
          </div>
        </div>
      </div>
    
        
       
      <!-- Footer 
      <footer class="footer grid-12" >
        <ul class="footer-sitemap grid-12" >
          <li><a href="http://www.1clickguide.org">Home</a><span>/</span></li>
          
          <li><a href="http://www.1clickguide.org/contact.php">Contact</a><span>/</span></li>
        </ul>
        <div class="copyright grid-12">
          Copyright © 2012-2013 1clickguide.org. All rights Reserved!
        </div>
      </footer>-->
    </div>
  </div>
</body>
</html>



<?php
}else
{ 
 header("location: index.php");
}
?>