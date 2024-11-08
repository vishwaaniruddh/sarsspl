<?php
session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	/*if(!isset($_SESSION['SESS_USER_NAME']) || (trim($_SESSION['SESS_USER_NAME']) == '')) 
	{
		header("location: access-denied.php");
		exit();
	}*/
?>
<?php 
//	ini_set( "display_errors", 0);

include('config.php');

include('header.php'); 
?>

<html>
    <head>
<script>


function remval(index)
{

//alert(index);
var elem=document.getElementById('Select1');
elem.remove(index);

}

function locrel()
{

location.reload();
}


function addtoschedule1(nm,id,chckid)
{

var sel = document.getElementById("Select1");
var option = document.createElement("option");
option.text = nm;
option.value=id;
sel.add(option);



}


function funcs(strPage,perpg)
{
    try
    {
//alert("ok");
var perp="";
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
url:'process_view_schedule.php',
data:'Page='+Page+'&perpg='+perp,

success: function(msg){
//alert(msg);
 document.getElementById('wrapper-logo').innerHTML=msg;
         },
    error: function (jqXHR, exception) {
        var msg = '';
        if (jqXHR.status === 0) {
            msg = 'Not connect.\n Verify Network.';
        } else if (jqXHR.status == 404) {
            msg = 'Requested page not found. [404]';
        } else if (jqXHR.status == 500) {
            msg = 'Internal Server Error [500].';
        } else if (exception === 'parsererror') {
            msg = 'Requested JSON parse failed.';
        } else if (exception === 'timeout') {
            msg = 'Time out error.';
        } else if (exception === 'abort') {
            msg = 'Ajax request aborted.';
        } else {
            msg = 'Uncaught Error.\n' + jqXHR.responseText;
        }
       alert(msg);
    },
     });
}catch(exc)
{
    
    alert(exc);
}
}



function deletefun(ids)
{
//alert(ids);
var abc=confirm('Are you sure you want to delete?');
if(abc)
{
$.ajax({
   type: 'POST',    
url:'deletemovie.php',
data:'id='+ids,

success: function(msg){
alert(msg);
if(msg!="")
{
location.reload();
}
  //document.getElementById('show').innerHTML=msg;
         }
     });
}
}



function fnc()
{

var dt= document.getElementById('dt').value;
var movieid= document.getElementById('Select1').options;
var stimer= document.getElementById('stime').value;
var stminsr= document.getElementById('stmins').value;
var smerir= document.getElementById('smeri').value;

var stm="";
if(smerir=="pm")
{
stm=parseInt(stimer)+12;
}
else

{
stm=stimer;
}

var tym2=dt+" "+stm+":"+stminsr+":00";




var movid="";
var marr=[];

		
		for(var i = 0; i < movieid.length; i++) 
                   {
			marr.push(movieid[i].value);

if(movid=="")
{
movid=movid+movieid[i].value;

}
else
{
movid=movid+","+movieid[i].value;
}
			}



if(dt=="")
{
alert("Select Date");

}
else if(movid=="")
{
alert("Select Ad To schedule");
}
else
{
var left = (screen.width/2)-(750/2);
var top = (screen.height/2)-(450/2);

window.open('v_movieschedulepopup.php?movid='+movid+'&dt='+tym2,'parentcon',"scrollbars=yes, resizable=no,width=750, height=400, top="+top+", left="+left);

}
}




</script>
<style>

#child-left{
  float: left;
  width: 600px;
  height:700px;
  border:solid 1px #0F0;
}
#child-right{
    float: right;
    width: 550px;
   height:700px;
  border:solid 1px #00F;
}
	
#wrapper-logo {
    float:left;
}

#wrapper-navbar {
    float:right;
}	
</style>

<script>
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if ((charCode < 48 || charCode > 57))
        return false;

    return true;
}

</script>
</head>

<body onload="funcs('','');">
<form action="" method="POST">
<div id="content-outer">
<!-- start content -->
<div id="content">
<center>
Date:-<input type="text" style="width:158px;"  id="dt" />

Hour<input style="width:50px;" type="number" name="stime" id="stime" min="1" max="12" value="00" maxlength="2" onkeypress="return isNumberKey(event)" 
oninput="javascript: if (this.value > 12 ) this.value =12;"
>
Minute<input style="width:50px;" type="number" name="stmins" id="stmins" min="0" max="59" 
 value="00" 
maxlength="2" 
onkeypress="return isNumberKey(event)" 
oninput="javascript: if (this.value > 59 ) this.value =00;"
/>


<select name="smeri" id="smeri">
<option value="am" >AM</option>
<option value="pm" >PM</option>
</select>


</center>
<script srzc="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="datepc/dcalendar.picker.js"></script>
<script>
$('#dt').dcalendarpicker({format: 'dd-mm-yyyy'});
</script>

<div id="wrapper">
    <div id="wrapper-header" class="cf"> 
        <div id="wrapper-logo">
            
        </div>
        <div id="wrapper-navbar">
            <p>Note:Double Click to remove the movie from list<p>
<select style="width:500px;height:250px;" name="drop1" id="Select1"  multiple="multiple" onchanage="alert(this.value);" onDblClick="remval(this.selectedIndex)">

        </div>
        
        
        
        
    </div>
</div>
</div>
<div id="content">
    <input type="button" value="View Schedule" onclick="fnc();" >	
    </div>
</div>


<!-- end footer -->
 </form>
</body>
</html>