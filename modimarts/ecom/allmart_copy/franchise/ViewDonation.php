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
        <title>Shyam Committee Member View Donation</title>
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
<link rel="stylesheet" href="css/custom.css">
<script>
$(function() {
 // $('#datetimepicker1').datetimepicker();
 $('#datetimepickerFrom').datetimepicker({format: 'DD-MM-YYYY'});
  $('#datetimepickerTo').datetimepicker({format: 'DD-MM-YYYY'});
 
});
</script>


<style>
    body {
    font-size: 13px;
    line-height: 1.8;
   
    background-image: url(images/body-bg.jpg);
    background-repeat: no-repeat;
    background-size: cover;
    -moz-background-size: cover;
    -webkit-background-size: cover;
    -o-background-size: cover;
    -ms-background-size: cover;
    background-position: center center;
    font-weight: 400;
    font-family: 'Roboto Slab';
    margin: 0px;
}
</style>



<style>
    table { 
	width: 750px; 
	border-collapse: collapse; 
	margin:50px auto;
	}

/* Zebra striping */
tr:nth-of-type(odd) { 
	background: #eee; 
	}

th { 
	background: #94111d; 
	color: white; 
	font-weight: bold; 
 height: 36px;
 
	}

td, th { 
	padding: 10px; 
	border: 1px solid #ccc; 
	text-align: left; 
	font-size: 24px;
	}

/* 
Max width before this PARTICULAR table gets nasty
This query will take effect for any screen smaller than 760px
and also iPads specifically.
*/
@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	table { 
	  	width: 100%; 
	}

	/* Force table to not be like tables anymore */
	table, thead, tbody, th, td, tr { 
		display: block; 
	}
	
	/* Hide table headers (but not display: none;, for accessibility) */
	thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	tr { border: 1px solid #ccc; }
	
	td { 
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
			font-size: 24px;
	}

	td:before { 
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
		/* Label the data */
		content: attr(data-column);

		color: #000;
		font-weight: bold;
	}

}
</style>




   <script>
function func(strPage,perpg)
{
    
var dt1=document.getElementById("fromdate").value;
var dt2=document.getElementById("todate").value;
var fname=document.getElementById("fname").value;
var cname=document.getElementById("cname").value;
var Mobile=document.getElementById("Mobile").value;
var calltype=document.getElementById("calltype").value;
var Paymentmode=document.getElementById("Paymentmode").value;
	
	
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
             url: "viewDonation_process.php",
			 
             data: 'Page='+Page+'&perpg='+perp+'&strdt='+dt1+'&endt='+dt2+'&fname='+fname+'&cname='+cname+'&Mobile='+Mobile+'&calltype='+calltype+'&Paymentmode='+Paymentmode,
			
             success: function(msg){
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

/*$('#formf').attr('action', 'delegation.php').attr('target','_self');
$('#formf').submit();*/

   
}                
</script>
<script>
    function cnctestfn(canid)
 {
	//alert(canid);
	
	var conf=confirm("Are you sure wants to Approve");
	if(conf)
	{
	  $.ajax({
             type: "POST",
             url: "Approve.php",
			
             data: 'id='+canid,
			
             success: function(msg){
              
              //alert(msg);
			   if(msg!=1)
			   {
				   
				   alert("Error");
			   }
			   else
			   {
				   alert("Approved ");
				   window.open("viewmember.php","_self");
				   //func('','');
			   }
			   //window.open('Enquiry_Details.php?id=<?php echo $enquiryid;?>','_self');
             },
			 error: function (request, status, error) {
        alert(request.responseText);
    }
         });
	}
 }
</script>

<script>
    function cnctestfn1(canid)
 {
	//alert(canid);
	var conf=confirm("Are you sure wants to DisApprove");
	if(conf)
	{
	  $.ajax({
             type: "POST",
             url: "disApprove.php",
             data: 'id='+canid,
             success: function(msg){
              //alert(msg);
			   if(msg!=1)
			   {
				   alert("Error");
			   }
			   else
			   {
				   alert("DisApproved ");
				   window.open("viewmember.php","_self");
				   //func('','');
			   }
			   //window.open('Enquiry_Details.php?id=<?php echo $enquiryid;?>','_self');
             },
			 error: function (request, status, error) {
        alert(request.responseText);
    }
         });
	}
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
     <!-- <form  method="post" id="formf" action="delegation.php">-->
     <div class="container">
        <h2 align="center">View Donation</h2>
       	<div class="row">
		    <div class="clearfix">
		        <div class="col-md-3">
    		        <div class="form-group">
    		            <select name="calltype" id="calltype" class="form-control">
    		                <option value="">Amount</option>
    		                <option value="ASC">Assending order</option>
    		                <option value="DESC">Decending order</option>
    		                
        		        </select>
    		        </div>
    		    </div>
    		    <div class="col-md-3">
    		        <div class="form-group">
    		            <input type="text" name="fname" id="fname" class="form-control" placeholder="Name">
    		        </div>
    		    </div>
        		<div class="col-md-3">
    		        <div class="form-group">
    		            <input type="text" name="cname" id="cname" class="form-control" placeholder="Company Name"/>
    		        </div>
    		    </div>
        		<div class="col-md-3">
    		        <div class="form-group">
    		            <input type="text" name="Mobile" id="Mobile" class="form-control" placeholder="Mobile Num"/>
    		        </div>
    		    </div>
            	<div class="col-md-3">
    		        <div class="form-group">
    		             <select name="Paymentmode" id="Paymentmode" class="form-control">
    		                <option seleected value="">Payment mode</option>
                            <option value="Cheque">Cheque</option>
                            <option value="Cash">Cash</option>
                            <option value="RTGS">RTGS</option>
                            <option value="CreditCard">Credit card</option>
    		                
        		        </select>
    		          
    		        </div>
    		    </div>
    		    <div class="col-md-3">
    		        <div class="form-group" >
    		            <div class='input-group date' id='datetimepickerFrom'>
    		            <input type='text' class="form-control" id="fromdate" placeholder="FromDate" name="fromdate"/>
                          <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                         </div>
    		        </div>
    		    </div>
    		    
    		    <div class="col-md-3">
    		        <div class="form-group" >
    		            <div class='input-group date' id='datetimepickerTo'>
    		            <input type='text' id="todate" class="form-control" Placeholder="ToDate" name="todate"/>
                          <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                        </div>
    		        </div>
    		    </div>
    		    <div class="col-md-3 text-right">
    		        <input type="button" name="Search" id="Search" value="Search" class="btn btn-primary" onclick="func('','');"/>
    		    </div>
            </div>
        </div>
        </div>
	</div>
	</div>
	<div id="show">
	</div>
     <!-- </form>-->
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
