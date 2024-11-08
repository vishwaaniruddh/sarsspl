<?php
session_start();

 if(isset($_SESSION['SESS_USER_NAME']) && isset($_SESSION['designation']))
{	
$id=$_SESSION['designation'];
include "config.php"; 
$sql = mysql_query("SELECT * FROM `clients` WHERE code ='$id'");
$row = mysql_fetch_array($sql);
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

  <!-- Title -->
  <title>Welcome</title>
  <script src="../js/jquery.min.js"></script>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />

<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />	

<script type="text/javascript" src="../adminpanel/datepick_js.js"> </script>
<link type="text/css" href="date_css.css"  rel="stylesheet" />
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
padding: 10px;
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
height: 50px;
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
        
    }
    else
    {
        document.getElementById('show2').style.display="";
        document.getElementById('show1').style.display="none";
        
        
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

function locupdt()
{
    var oid=document.getElementById('oid').value;
     var loc=document.getElementById('loc1').value;
    //alert(oid);
    //alert(loc);
    $.ajax({
   type: 'POST',    
url:'loc_update.php',
data:'oid='+oid+'&loc='+loc,

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
alert(oid);

$.ajax({
   type: 'POST',    
url:'orderprocess.php',
data:'oid='+oid+'&num='+num,

success: function(msg){
//alert("test");
//alert(msg);
funcs('','');
//document.getElementById('ordershow').innerHTML=msg;

         }
     });
}


</script>
<script>
function funcs(strPage,perpg)
{
ddlmerc

var fdate=document.getElementById('fdate').value;
var tdate=document.getElementById('tdate').value;
var progress=document.getElementById('progressid').value;
var ddlcity = document.getElementById("ddlcity");
var cityddl = ddlcity.options[ddlcity.selectedIndex].value;
var ddlmerc = document.getElementById("ddlmerc");
var mername = ddlmerc.options[ddlmerc.selectedIndex].value;


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


$.ajax({
   type: 'POST',    
url:'orderdetails.php',
data:'Page='+Page+'&perpg='+perp+'&fdate='+fdate+'&tdate='+tdate+'&progress='+progress+'&mername='+mername+'&cityddl='+cityddl,

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

alert(chkid);
$.ajax({
             type: "POST",
             url: "process_reject.php",
 
             data: 'id='+id+'&chkid='+chkid+'&txt='+txt,

             success: function(msg){
            // alert("dsjfhn");
            alert(msg);
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

$.ajax({
             type: "POST",
             url: "process_dispatch.php",
 
             data: 'sname='+sname+'&contact='+contact+'&cname='+cname+'&dcn='+dcn+'&rd='+rd+'&oid='+oid+'&loc='+loc,

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
//==========
function funshow()
{
    alert("chekcldsf");
  if(document.getElementById('Courier').checked)
{
    document.getElementById('showscourier').style.display="";
     document.getElementById('showself').style.display="none";
}
else if(document.getElementById('self').checked)
{
    document.getElementById('showscourier').style.display="none";
    document.getElementById('showself').style.display="";
    
}
}

//====
function checkAll(name,checkId){
//alert("testing");

if(document.getElementById(checkId).checked==true)
{
//alert("truuee");
        var inputs = document.getElementsByName("chk[]");

alert(inputs.length);
        for (var i = 0; i < inputs.length; i++) { 

             inputs[i].checked = true;
               
            
        }  
}
else
{
//alert("falseeee");
var inputs = document.getElementsByName("chk[]");

alert(inputs.length);
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
<b style="font-size:16px;" class="col-4-md">Person Name :</b> <input type="text" id="sname" style="width:200px; height:30px;" name="sname" required autofocus><br/><br/>
<b style="font-size:16px;">Contact :</b> <input type="text" id="contact" style="width:200px; height:30px;" name="contact" required autofocus><br/><br/>
</div>
<div id="showscourier" style="display:none">
    <b style="font-size:16px;" class="col-4-md">Courier Name :</b> <input type="text" id="cname" style="width:200px; height:30px;" name="cname" required autofocus><br/><br/>
<b style="font-size:16px;" class="col-4-md">Docket No. :</b> <input type="text" id="dcn" style="width:200px; height:30px;" name="dcn" required autofocus>
</div>
<!--<b style="font-size:16px;">Date :</b> <input type="text" id="date" style="width:200px; height:30px;" name="date" onClick="displayDatePicker('rdate');">-->

<b style="font-size:16px;" class="col-4-md">Current Location :</b> <input type="text" id="loc" style="width:200px; height:30px;" name="loc" required autofocus><br/><br/>
<a href="javascript:void(0)" class="myButton" onclick="disdetails();">Submit</a>&nbsp;&nbsp;
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
<a href="javascript:void(0)" class="myButton" onclick="locupdt();">Update</a>&nbsp;&nbsp;
<a href="javascript:void(0)" class="myButton" onclick="popupclose();">Cancel</a>
</center>
</div>
</div>
</div>

        <!-- Title & Sitemap -->
        
        <input type="hidden" id="oid" name="oid">
        
        
        <div class="title-sitemap grid-12">
          <h1 class="grid-6"><span>Welcome to Admin Panel</span></h1>
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
                        
            Merchant Name : <select id="ddlmerc" name="ddlmerc">
                <option value="">select</option>
                <?php
                            $Mcnm="select name from clients where 1=1";
                            $mname=mysql_query($Mcnm);
                            while($fetchmernm=mysql_fetch_array($mname))
                            {
                            ?>
                <option value="<?php echo $fetchmernm[0] ?>"><?php echo $fetchmernm[0] ?></option>
                <?php } ?>
                </select></td>
               <td>
                            
                            
            City : <select id="ddlcity" name="ddlcity">
                <option value="">select</option>
                <?php
                            $nm="select name,code from cities where 1=1";
                            $cty=mysql_query($nm);
                            while($fetchcity=mysql_fetch_array($cty))
                            {
                            ?>
                <option value="<?php echo $fetchcity[1] ?>"><?php echo $fetchcity[0] ?></option>
                <?php } ?>
                </select></td>
                        &nbsp;   &nbsp;
                        
                        
                        
                         
                        
                        
                        
               
                <td>
            Status : <select id="progressid">
                <option value="">select</option>
                <option value="pending">Pending</option>
                <option value="pr">Processing</option>
                <option value="dis">Dispatch</option>
                <option value="c">Complete</option>
                <option value="rej">Reject</option>
                </select></td>
               <td>  &nbsp;   &nbsp;
               
               <td>
              <input type="text" name="rdate" id="fdate" onClick="displayDatePicker('rdate');" class="inp-form" placeholder="from date" style="heigth:30px;width:100px"/></td>
               <td><input type="text" name="tdate" id="tdate" onClick="displayDatePicker('tdate');" class="inp-form" placeholder="till date"/></td>
               
               
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