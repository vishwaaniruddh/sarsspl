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
        <title>view location</title>
     <link rel="stylesheet" href="css/normalize.css">
         <link href='http://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
      <!--  <link rel="stylesheet" href="css/signup.css">-->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

       <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">


   <script>
function func(strPage,perpg)
{
 
var fname=document.getElementById("fname").value;
var email=document.getElementById("email").value;
var Mobile=document.getElementById("Mobile").value;

	
	
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
             url: "viewlocation_process.php",
			 
             data: 'Page='+Page+'&perpg='+perp+'&fname='+fname+'&email='+email+'&Mobile='+Mobile,
			
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


function newwin(url,winname)
{

  mywindow = window.open(url, winname, "location=400,status=1,scrollbars=1, width=500,height=400,left=350,top=200");
  
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
		<td><input type="text" name="fname" id="fname" placeholder="Name"></td>
		<td><input type="text" name="email" id="email" placeholder="email id"/></td>
		<td><input type="text" name="Mobile" id="Mobile" placeholder="Mobile Num"/></td>
		
		
		
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
