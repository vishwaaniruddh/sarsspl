<?php
session_start();
/*if(isset($_SESSION['user']) && isset($_SESSION['id']))
 
{
*/
 ?>
 
 <!DOCTYPE html>
<html> 
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Leads Details</title>
     <link rel="stylesheet" href="css/normalize.css">
         <link href='http://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
      <!--<link rel="stylesheet" href="css/signup.css">-->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

       <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
<script>
$(function() {
 // $('#datetimepicker1').datetimepicker();
 $('#datetimepickerFrom').datetimepicker({format: 'DD-MM-YYYY'});
  $('#datetimepickerTo').datetimepicker({format: 'DD-MM-YYYY'});
 
});
</script>

   <script>
function func(strPage,perpg)
{
    
var dt1=document.getElementById("fromdate").value;
var dt2=document.getElementById("todate").value;
var fname=document.getElementById("fname").value;
var lname=document.getElementById("lname").value;
var Mobile=document.getElementById("Mobile").value;
var calltype=document.getElementById("calltype").value;
var Pincode=document.getElementById("Pincode").value;
	
	
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
             type: "POST",
             url: "viewlead_process.php",
			 
             data: 'Page='+Page+'&perpg='+perp+'&strdt='+dt1+'&endt='+dt2+'&fname='+fname+'&lname='+lname+'&Mobile='+Mobile+'&calltype='+calltype+'&Pincode='+Pincode,
			
             success: function(msg){
             
              //alert(msg);
			  document.getElementById('show').innerHTML=msg;
			  },
			 error: function (request, status, error) {
        alert(request.responseText);
    }
         });
 //alert("ok");
}
 function expfunc()
{//alert("hii")

$('#formf').attr('action', 'delegation.php').attr('target','_self');
$('#formf').submit();

   
}                
</script>
</head>
<body onload="func('','');">
<header id="header">

<?php include 'menu.php';?>

<!--<div>
        <button type="button" onClick="window.location.href='testscheduleview.php' " style="width:100px;height: 39px; border: 0px solid red;" class="button button2">Back</button></td><td style="text-align:center;">
</div>-->
</header>
      <form  method="post" id="formf" action="delegation.php">
      
      
        <h2 align="center">View Lead Details</h2>

        
       	<table width="70%"  align="center">
		<tr>
		    <td><select name="calltype" id="calltype" style="width:100px; height:25px">
		        <option value="">All</option>
		        <option value="0">pending</option>
		        <option value="1">delegated</option>
		        <option value="2">close</option>
		        <option value="3">Suspense</option>
		        <option value="4">Member</option>
		        </select>
		    </td>
		<td><input type="text" name="fname" id="fname" placeholder="first Name"></td>
		<td><input type="text" name="lname" id="lname" placeholder="Last Name"/></td>
		<td><input type="text" name="Mobile" id="Mobile" placeholder="Mobile Num"/></td>
<!--		<td><input type="text" name="Email" id="Email" placeholder="Email"/></td>
-->		<td><input type="text" name="Pincode" id="Pincode" placeholder="Pincode"/></td>
		
		<td width="20%"><label><b>FromDate:</b></label></td>
       <td width="20%" class='input-group date' id='datetimepickerFrom'>
          <input type='text' style="width:100px;" id="fromdate" name="fromdate"/>
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
       </td>
       
       <td width="20%"><label><b>ToDate:</b></label></td>
       <td width="20%" class='input-group date' id='datetimepickerTo'>
          <input type='text' style="width:100px;" id="todate" name="todate"/>
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
       </td>
			
			<td><input type="button" name="Search" id="Search" value="Search" onclick="func('','');"/></td>
			
			 
		
	
		
</tr>
	</table>
	
	
	<div id="show">
	
	</div>
	
        


      </form>
      
    </body>
</html>
<?php
/*}else
{ 
    ?>
    <script>
        alert("Your session has expired. Please log in again");
        window.open("index.php","_self");
    </script>
    <?php
}*/
?>
