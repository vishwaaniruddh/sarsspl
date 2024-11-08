<?php
session_start();
include ('config.php');

$leadid=$_REQUEST['id'];
$sql="select * from Leads_table where Lead_id='".$leadid."'";
$runsql=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($runsql);
 
$number0=explode('-',$row['MobileNumber']) ;
$number1=explode('-',$row['ContactNo1']) ;
$number2=explode('-',$row['ContactNo2']) ;
$number3=explode('-',$row['ContactNo3']) ;

$sql2="select state from state where state_id='".$row['State']."'";
$runsql2=mysqli_query($conn,$sql2);
$sqlfetch=mysqli_fetch_array($runsql2);
//print_r($number1);
         ?>
 <!DOCTYPE html>
<html> 
  <head>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lead update</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="icon" href="images/favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,700%7CRoboto+Slab:400,300,700">
    <link rel="stylesheet" href="css/sig.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 
<link href="datepc/dcalendar.picker.css" rel="stylesheet" type="text/css">
 <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
                    <script src="datepc/dcalendar.picker.js"></script>
                    <script>
                        $(document).ready(function () {
                            $('#dt1').dcalendarpicker({
                                format: 'dd-mm-yyyy'
                            });
                        });
                        
                    </script> 
 <style>
.rounded {
  border-radius: 20px;
  height: 40px;
}
</style>
<script>


function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
} 

function test()
{
alert('kk');
}
</script>
<style>
        .busy * {
            cursor: wait !important;
        }
        
        .button {
            background-color: #FBBA00;
            border: none;
            color: white;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            -webkit-transition-duration: 0.4s;
            /* Safari */
            transition-duration: 0.4s;
            cursor: pointer;
        }
        .button2{
            .button {
            background-color: #FBBA00;
            border: none;
            color: white;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            -webkit-transition-duration: 0.4s;
            /* Safari */
            transition-duration: 0.4s;
            cursor: pointer;
        }
        }
        
        .button1 {
            background-color: #FBBA00;
            color: #fff;
            font-family: "Open Sans", Helvetica, Arial, sans-serif;
            font-size: 22px;
            padding: 8px 10px;
        }
        
        
        
      
/* unvisited link */
.test2:link {
    color: #5B5B5B;
    text-decoration: none;
}
}

/* visited link */
.test2:visited {
    color: #5B5B5B;
}

/* mouse over link */
.test2:hover {
    color: #00A0E3;
     text-decoration: underline;
}

/* selected link */
.test2:active {
    color: #5B5B5B;
}
.col-md-6 {
    width: 33%;
}
.col-md-offset-3 {
    margin-left: 34%;
}
</style>
<script>

function abc(){
var a =document.getElementById('status').value;

if(a==2){
    
$("#showonclose").show();
}else{
   $("#showonclose").hide(); 
}
}
</script>


<script>
    function validation()
{
    
    var status= document.getElementById("status").value; 
    var ClosedReason= document.getElementById("ClosedReason").value;
    
     if(status==2){
         if(ClosedReason==""){
             swal("Please fill up close reason ");
              return false;
         }
     }
     
     else{
 
     sumitfunc();
     return true;
     
          }
          
}
</script>
<script>
    function sumitfunc(){
     var leadid= document.getElementById("leadid").value; 
     var FirstName= document.getElementById("FirstName").value;
     var LastName= document.getElementById("LastName").value;
     var Comments= document.getElementById("Comments").value;
     var status= document.getElementById("status").value;
     var dt1= document.getElementById("dt1").value; 
     var ClosedReason= document.getElementById("ClosedReason").value;
     
            $.ajax({
   type: 'POST',    
   url:'updatelead_process.php',
   
    data:'leadid='+leadid+'&FirstName='+FirstName+'&LastName='+LastName+'&Comments='+Comments+'&status='+status+'&dt1='+dt1+'&ClosedReason='+ClosedReason,

   success: function(msg){
    
    
   alert(msg);
 if(msg==1){
     swal("successfully Updated");
     window.open("viewlead.php","_self");
 }else{
     swal("error");
 }
   
   
} })
            }
</script>
    </head>
    <body>
<?php include 'menu.php'?>
                
                   <div class="row" style="margin-right:0px;">
            <div class="col-md-12" style="
    right: 15px;
">
                
                <div class="row" style="margin-top:2%;">
                    <div class="col-md-6 col-md-offset-3" style="border: 1px solid #bfbfbf;">
                  <form class="login" action="process_admin_login.php" method="post" style="
    margin-bottom: 0px;
    margin-top: 0px;
    padding-bottom: 0px;
">
      <form  method="post">
      
   
        <h1>Update Lead</h1>

        <fieldset>
            <label for="name"><b>Lead Id  :</b></label>
         <input type="text" name="leadid" id="leadid" value="<?php echo $leadid;?>" readonly/>  
         
          <label for="name"><b>Lead Name :</b></label>
          <input type="text" id="FirstName" name="FirstName" placeholder="First Name" value="<?php echo $row['FirstName'];?>" readonly>
          
          <label for="name"><b>Lead Last Name  :</b></label>
          <input type="text" id="LastName" name="LastName" placeholder="Last Name" value="<?php echo $row['LastName'];?>" readonly>
          
          <label for="name"><b>Comments:</b></label>
          <textarea id="Comments" name="Comments" rows="4" cols="50"> </textarea>
          
          <label><b>Status:</b></label>
          <select class="rounded" name="status" id="status" onchange="abc()">
              <option value=" ">select status</option>
              <option value="1">open</option>
              <option value="2">close</option>
              <option value="3">Suspense</option>
              <option value="4">Member</option>
              </select> 
              
             <label><b>Next Update Time</b>
             <input type="text" name="dt1" id="dt1" placeholder="from date"> </label>
			<div style="display:none" id="showonclose">
            <label><b>Closed Reason </b></label> 
             <input type="text" name="ClosedReason" id="ClosedReason" placeholder="Closed Reason" />
             </div>
<center>
<button type="button" onclick="validation()" style="border-radius: 50px;width: 206px;height: 37px;background-color: #fbba00;">Update</button>
</center></br>


      </form>
       
                </div>
                </div>
                
            </div>
             </div>
                
           
    </body>
</html>
<? //echo $abc; ?>