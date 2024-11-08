<?php session_start();
/*if(isset($_SESSION['user']) && isset($_SESSION['id']))
 
{
*/
 ?>
 <!DOCTYPE html>
<html> 
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shyam Committee Member Details</title>
        <link rel="stylesheet" href="css/normalize.css">
         <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
      <!--<link rel="stylesheet" href="css/signup.css">-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="css/custom.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />


<link rel="icon" href="../images/favicon.png" type="image/gif" sizes="16x16">
      <link href="https://fonts.googleapis.com/css?family=Amita:400,700&display=swap&subset=devanagari" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap&subset=devanagari" rel="stylesheet">
      <link rel="stylesheet" href="../css/css_new/bootstrap.min.css">
    <!--  <script src="../js/jquery.min.js"></script>
      <script src="../js/popper.min.js"></script>-->
     <!-- <script src="../js/bootstrap.min.js"></script>-->
     <!-- <link rel="stylesheet" href="../css/css_new/font-awesome.min.css">-->
      <link rel="stylesheet" type="text/css" href="../css/css_new/slick.min.css">
     <!----> <script src="../js/slick.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/css_new/style.css">
        <link rel="stylesheet" type="text/css" href="../css/css_new/hindi.css">

      <style>.mandir_plan h5:before{left: 40px;}</style>





<script>

$(function() {
 // $('#datetimepicker1').datetimepicker();
 $('#datetimepickerFrom').datetimepicker({format: 'DD-MM-YYYY'});
  $('#datetimepickerTo').datetimepicker({format: 'DD-MM-YYYY'});
});

function ClearFields(){
    document.getElementById("fromdate").value="";
    document.getElementById("todate").value="";
    document.getElementById("fname").value="";
    document.getElementById("email").value="";
    document.getElementById("Mobile").value="";
    document.getElementById("calltype").value="";
    document.getElementById("Pincode").value="";
    func('','');
}
</script>

   <script>
function func(strPage,perpg)
{
    var dt1=document.getElementById("fromdate").value;
    var dt2=document.getElementById("todate").value;
    var fname=document.getElementById("fname").value;
    var email=document.getElementById("email").value;
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
             url: "viewmember_process.php",
             data: 'Page='+Page+'&perpg='+perp+'&strdt='+dt1+'&endt='+dt2+'&fname='+fname+'&email='+email+'&Mobile='+Mobile+'&calltype='+calltype+'&Pincode='+Pincode,
			
             success: function(msg){
			  document.getElementById('show').innerHTML=msg;
			 // alert(msg);
			  },
			  
			 error: function (request, status, error) {
        swal(request.responseText);
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
function checkKey(){
    document.addEventListener('keydown', function(e){
   if(e.key === 'Y' || e.key === 'y'){
		return true;
   } else{ false; }
});
}




function waitlist(wid){
    
    	swal({
  title: "Approve?",
  text: "Are you sure wants to Approve for waiting list?",
  type: "warning",
  showCancelButton: true,
  confirmButtonClass: "btn-danger",
  confirmButtonText: "Yes",
  closeOnConfirm: false
},
function(){
    $.ajax({
             type: "POST",
             url: "ApproveWaiting.php",
             data: 'id='+wid,
             success: function(msg){
              
			   if(msg!="1")
			   {
				   swal("Error");
			   }
			   else
			   {
				   window.open("viewmember.php","_self");
				   //func('','');
			   }
			   //window.open('Enquiry_Details.php?id=<?php echo $enquiryid;?>','_self');
             },
			 error: function (request, status, error) {
        swal(request.responseText);
        }
         });
  swal("Approved!", "Waiting List has been approved.", "success");
});
}



function cnctestfn(canid)
 {
    // alert(canid);
	swal({
  title: "Approve?",
  text: "Are you sure wants to Approve?",
  type: "warning",
  showCancelButton: true,
  confirmButtonClass: "btn-danger",
  confirmButtonText: "Yes",
  closeOnConfirm: false
},
function(){
    $.ajax({
             type: "POST",
             url: "Approve.php",
             data: 'id='+canid,
             success: function(msg){
              //alert(msg);
			   if(msg!=1)
			   {
				   swal("Error");
			   }
			   else
			   {
				   window.open("viewmember.php","_self");
				   //func('','');
			   }
			   //window.open('Enquiry_Details.php?id=<?php echo $enquiryid;?>','_self');
             },
			 error: function (request, status, error) {
        swal(request.responseText);
        }
         });
  swal("Approved!", "Committee has been approved.", "success");
});
	
 }
 
 
 
 function wait(canid,status)
 {
	swal({
  title: "Put in WaitList?",
  text: "Are you sure wants to put this member into WaitList?",
  type: "warning",
  name:"con",
  showCancelButton: true,
  confirmButtonClass: "btn-danger",
  confirmButtonText: "Yes",
  closeOnConfirm: false
},
/*document.addEventListener('keydown', function(e){
   if(e.key ==='y'){
       $.ajax({
             type: "POST",
             url: "disApprove.php",
             data: 'id='+canid+'&status='+status,
             success: function(msg){
              alert(msg);
			   if(msg!=1)
			   {
				   swal("Error");
			   }
			   else
			   {
				   window.open("viewmember.php","_self");
				   //func('','');
			   }
             }
         });
   }
       
}),*/

function(){
    $.ajax({
             type: "POST",
             url: "disApprove.php",
             data: 'id='+canid+'&status='+status,
             success: function(msg){
              //alert(msg);
			   if(msg!=1)
			   {
				   swal("Error");
			   }
			   else
			   {
			      // window.open("viewmember.php","_self");
				   func('','');
			   }
             },
			 error: function (request, status, error) {
        swal(request.responseText);
        }
         });
  swal("Shifted!", "Committee has been shifted to wait list.", "success");
});
	
 }
</script>

<script>
    function cnctestfn1(canid)
 {
	swal({
  title: "Disapprove?",
  text: "Are you sure , you want to disapprove?",
  type: "warning",
  showCancelButton: true,
  confirmButtonClass: "btn-danger",
  confirmButtonText: "Yes",
  closeOnConfirm: false
},
/*document.addEventListener('keydown', function(e){
   if(e.key === 'y' ||e.key === 'Y'){
   //console.log('y');
   $.ajax({
             type: "POST",
             url: "disApprove.php",
             data: 'id='+canid,
             success: function(msg){
              //alert(msg);
			   if(msg!=1)
			   {
				   swal("Error");
			   }
			   else
			   {
				   window.open("viewmember.php","_self");
				   //func('','');
			   }
             },
			 error: function (request, status, error) {
        swal(request.responseText);
        }
    });
  swal("Disapprove!", "Committee has been disapproved!.", "success");
   }
}),*/
function(){
    $.ajax({
             type: "POST",
             url: "disApprove.php",
             data: 'id='+canid,
             success: function(msg){
              //alert(msg);
			   if(msg!=1)
			   {
				   swal("Error");
			   }
			   else
			   {
				   //swal("DisApproved ");
				   window.open("viewmember.php","_self");
				   //func('','');
			   }
			   //window.open('Enquiry_Details.php?id=<?php echo $enquiryid;?>','_self');
             },
			 error: function (request, status, error) {
        swal(request.responseText);
        }
    });
  swal("Disapprove!", "Committee has been disapproved!.", "success");
});
	/*var conf=confirm("Are you sure wants to DisApprove");
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
				   swal("Error");
			   }
			   else
			   {
				   //swal("DisApproved ");
				   window.open("viewmember.php","_self");
				   //func('','');
			   }
			   //window.open('Enquiry_Details.php?id=<?php echo $enquiryid;?>','_self');
             },
			 error: function (request, status, error) {
        swal(request.responseText);
    }
         });
*/	}
 //}
</script>
</head>
<body onload="func('','');">
<header id="header">
<?php include 'admin_menu.php';?>
<!--<div>
        <button type="button" onClick="window.location.href='testscheduleview.php' " style="width:100px;height: 39px; border: 0px solid red;" class="button button2">Back</button></td><td style="text-align:center;">
</div>-->
</header>
     <!-- <form  method="post" id="formf" action="delegation.php">-->
     <div class="container">
        <h2 align="center" style="padding-top: 67px;">View Member</h2>
       	<div class="row">
		    <div class="clearfix">
		        <div class="col-md-3">
    		        <div class="form-group">
    		            <select name="calltype" id="calltype" class="form-control" onchange="func('','');">
    		               <!-- <option value="">All</option>-->
    		                <option value="3" selected>Applied Waiting</option>
    		                <option value="0" >Final Approval</option>
    		                <option value="1">List Of Approved</option>
    		                <option value="2">List Of Disapproved</option>
    		               
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
    		            <input type="text" name="email" id="email" class="form-control" placeholder="Email Id"/>
    		        </div>
    		    </div>
        		<div class="col-md-3">
    		        <div class="form-group">
    		            <input type="text" name="Mobile" id="Mobile" class="form-control" placeholder="Mobile Num"/>
    		        </div>
    		    </div>
            	<div class="col-md-3">
    		        <div class="form-group">
    		            <input type="text" name="Pincode" id="Pincode" class="form-control" placeholder="Pincode"/>
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
    		        <input type="reset" name="Reset" id="reset" value="reset" class="btn btn-primary" onclick="ClearFields()"/>
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
