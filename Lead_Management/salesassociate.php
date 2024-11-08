<?php
session_start();
include ('config.php');
 
         ?>
 <!DOCTYPE html>
<html> 
  <head>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sales</title>
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
    
    function modelnos() {
//alert("hello");

var state=document.getElementById("state").value;
//alert(productname);
$.ajax({
                    
                    type:'POST',
                    url:'city.php',
                     data:'state='+state,
                     datatype:'json',
                    success:function(msg){
                        //alert(msg);
                       var jsr=JSON.parse(msg);
                       //alert(jsr.length);
                        var newoption=' <option value="">Select</option>' ;
                        $('#City').empty();
                        
                        for(var i=0;i<jsr.length;i++)
                        {
                         
                       
                      //var newoption= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["modelno"]+'</option> ';
		                   newoption+= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["modelno"]+'</option> ';
		
                        
                        }                       
                     	$('#City').append(newoption);
 
                    }
                })
                
            }
            
            
           
</script>
<script>
    function validation()
{
    
    var FirstName= document.getElementById("FirstName").value;
     var LastName= document.getElementById("LastName").value;
     var Designation= document.getElementById("Designation").value;
     var UserLevel= document.getElementById("UserLevel").value;
     var Address= document.getElementById("Address").value; 
     /*var Country= document.getElementById("Country").value;
     var state= document.getElementById("state").value;
     var City= document.getElementById("City").value;
     var Pincode= document.getElementById("Pincode").value;*/
     var ContactNo= document.getElementById("ContactNo").value; 
     var Location= document.getElementById("Location").value;
     var Company= document.getElementById("Company").value;
     
      if(FirstName=="")
     {
     swal("please enter FirstName name");
     return false;
     } 
     else if(LastName=="")
     {
     swal("please enter LastName");
     return false;
     }
     else if(Designation=="")
     {
     swal("please enter Designation");
     return false;
     }
     else if(UserLevel=="")
     {
     swal("please enter User Level");
     return false;
     }
     else if (Address == "")
	{
		swal(" please fill Address ");
		return false;
		
	}
	
	else if (ContactNo == "")
	{
		swal(" please fill Contact No ");
		return false;
		
	}
	
	else if (Location == "")
	{
		swal(" please fill Location ");
		return false;
		
	}
	
	else if (Company == "")
	{
		swal(" please fill Company ");
		return false;
		
	}
	 
     else{
 
     sumitfunc();
     return true;
     
          }
          
}
</script>
<script>
    function sumitfunc(){
    
     var FirstName= document.getElementById("FirstName").value;
     var LastName= document.getElementById("LastName").value;
     var Designation= document.getElementById("Designation").value;
     var UserLevel= document.getElementById("UserLevel").value;
     var Address= document.getElementById("Address").value; 
     var Country= document.getElementById("Country").value;
     var state= document.getElementById("state").value;
     var City= document.getElementById("City").value;
     var Pincode= document.getElementById("Pincode").value;
     var ContactNo= document.getElementById("ContactNo").value; 
     var Location= document.getElementById("Location").value;
     var Company= document.getElementById("Company").value;
     var Add= document.getElementById("Add").value;
          
            $.ajax({
   type: 'POST',    
   url:'salesassociate_process.php',
   
    data:'FirstName='+FirstName+'&LastName='+LastName+'&Designation='+Designation+'&UserLevel='+UserLevel+'&Address='+Address+'&Country='+Country+'&state='+state+'&City='+City+'&Pincode='+Pincode+'&ContactNo='+ContactNo+'&Location='+Location+'&Company='+Company+'&Add='+Add,

   success: function(msg){
    
    
   //alert(msg);
 if(msg==1){
     swal("successfully Added");
     window.open("salesassociate.php","_self");
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
      
      
        <h1>Sales Associate</h1>

        <fieldset>
         
          
          <label for="name"><b>First Name :</b></label>
          <input type="text" id="FirstName" name="FirstName" placeholder="First Name">
          
          <label for="name"><b>Last Name  :</b></label>
          <input type="text" id="LastName" name="LastName" placeholder="Last Name">
          
          
     
     <label ><b>Designation:</b></label>
     <input type="text" id="Designation" name="Designation" placeholder="Designation"> 
     
     <label ><b>User Level:</b></label>
     <input type="text" id="UserLevel" name="UserLevel" placeholder="User Level">
     
     <label ><b>Address</b></label>
     <input type="text" id="Address" name="Address" placeholder="Address">
     
     <label for="state"><b>Country:</b></label>
          <select class="rounded" name="Country" id="Country">
              <option value=" ">Select Country</option>
              <option value="India">India</option>
         
          </select>
          
          <label for="state"><b>State:</b></label>
          <select class="rounded" name="state" id="state" onchange="modelnos()">
              <option value=" ">Select State</option>
          <?php 
          
          $abc="select * from state ";
          
          $runabc=mysqli_query($conn,$abc);
          while($fetch=mysqli_fetch_array($runabc)){?>
          <option value="<?php echo $fetch['state_id'];?>"><?php echo $fetch['state']?></option>
         <?php } ?>
          </select>
          
          <label for="City"><b>City:</b></label>
          <select class="rounded" name="City" id="City">
              <option value=" ">Select City</option>
          </select>
     
     <label ><b>Pincode:</b></label>
     <input type="text" id="Pincode" name="Pincode" placeholder="Pincode" onkeypress="return isNumber(event)" maxlength="7">
     
     <label ><b>Contact No :</b></label>
     <input type="text" id="ContactNo" name="ContactNo" placeholder="Contact No"onkeypress="return isNumber(event)" maxlength="10">
     
     <label ><b>Location:</b></label>
     <input type="text" id="Location" name="Location" placeholder="Location">
     
     <label ><b>Company:</b></label>
     <input type="text" id="Company" name="Company" placeholder="Company">
     
     <label ><b>Add:</b></label>
     <input type="text" id="Add" name="Add" placeholder="Add">
<center>
<button type="button" onclick="validation()" style="border-radius: 50px;width: 206px;height: 37px;background-color: #fbba00;">Submit</button>
</center></br>


      </form>
       
                </div>
                </div>
                
            </div>
             </div>
                
           
    </body>
</html>
<? //echo $abc; ?>