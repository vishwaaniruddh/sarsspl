<?php
session_start();
include ('header.php');
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{?>
<html>
    <head>
         <link rel="stylesheet" href="css/bootstrap.css">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

 <link rel="stylesheet" href="multipledropdown.css">
 <style>
.multiselect {
    width:20em;
    height:15em;
    border:solid 1px #c0c0c0;
    overflow:auto;
}
 
.multiselect label {
    display:block;
}
 
.multiselect-on {
   
  
}
.ms-options-wrap > button > span {
    display: inline-block;
}

.label{
    color: #000;
}

</style>

	    </head>
	
    <style>
 {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}

input[type=text] {
   
   
    border: 1px solid #ccc;
    border-radius: 2px;
    
}
.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #283E56;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 16px;
  padding: 7px;
  width: 100px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover {

  background-color: #f4511e;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}
optgroup{
    blackgrond-color:black;
   
}
option{
    color:black;
}

.div1{margin-top:2px;padding:4px;background-color:#cfe8c7}
.div1:hover{margin-top:2px;background-color:#ccc}
.form1{padding:10px;   width:50%; margin-left:25%; test-align:left ;}
.hed{background-color:#283E56; color:#fff;}

</style>
 
    <body>
<?php include 'menu.php'; ?>
 <div class="container" style="padding:20px;margin-top:90px">

<form name="myForm"  action="addusers_process.php" method="POST" class="form1">
    <div><input type="hidden" name="drop" id="drop"/></div>
    
<div class="row hed"  >
    <div  class="col-md-4"></div>
 <div  class="col-md-4"><center><h2 style="color:white" >Add Users</h2></center></div>
 <div  class="col-md-4"></div>
</div>


<div class="row div1">
    <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Name</leble></div>
     <div  class="col-md-4"> <input type="text" name="fn" id="fn" /></div>
      <div  class="col-md-2"></div>
</div>

<div class="row div1 ">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>user name</leble></div>
     <div  class="col-md-4">  <input type="text" name="name" id="name" placeholder="Email ID"/></div>
      <div  class="col-md-2"></div>
</div>


<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>password</leble></div>
     <div  class="col-md-4">   <input type="text" name="password" id="password" /></div>
      <div  class="col-md-2"></div>
</div>


<div class="row div1">
     <div  class="col-md-2"></div>
    <div  class="col-md-4"><leble>Permission</leble></div>
     <div  class="col-md-4">  
     
      <select size="5" name="lstStates" multiple="multiple" id="lstStates" onchange="per()">
    <optgroup  label="ADD" >
         <optgroup label=" ">
        <option value="1">Add Vendor</option>
        <option value="2">View Companye</option>
        <option value="3">Add Material</option>
        <option value="4">View Team</option>
        <option value="5">View Vendor</option>
        <option value="6">View Companye</option>
        <option value="7">View Material</option>
        <option value="8">View Team</option>
         </optgroup>
          </optgroup>
          
          
          
           <optgroup label="STOCK">
               </optgroup>
                <optgroup label="">
                <option value="9">Stock In</option>
                <option value="10">Stock Out</option>
                <option value="11">View Stock In</option>
                <option value="12">View Stock Out</option>
               </optgroup>
               
               
               <optgroup label="Faulty Material">
               </optgroup>
        <optgroup label="">
            <option value="13">Faulty Material</option>
            <option value="14">Faulty Material View</option>
           
        </optgroup>
        
        <optgroup label="ADD User">
               </optgroup>
        <optgroup label="">
            <option value="15">Add User</option>
            <option value="16">View User</option>
           
        </optgroup>
         
         
          
    </select>   
     
     
     </div>
      <div  class="col-md-2"></div>
</div>








<div class="row" style="margin-top:30px;">
     <div  class="col-md-3"></div>
    <div  class="col-md-3"><center> <input type="submit" name="sub" value="submit"  /></center></div>
    
      <div  class="col-md-3"></div>
</div>

</form>
</center>
     </div>   

       
        
    </body>
</html>

<?php
}else
{ 
// header("location: index.php");
}
?>


<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.js"></script>


 <script>
 
   
 function per(){
    
   var obj = myForm.lstStates,
        options = obj.options, 
        selected = [], i, str;
   
    for (i = 0; i < options.length; i++) {
        options[i].selected && selected.push(obj[i].value);
    }
    
    str = selected.join();
    
    // what should I write here??
   // alert("Options selected are " + str);
  
document.getElementById("drop").value=str;
 }
 
 
    $(function () {
    $('#lstStates').multiselect({
        buttonText: function(options){
          if (options.length === 0) {
              return 'No option selected ...';
           }
           var labels = [];
           options.each(function() {
               if ($(this).attr('value') !== undefined) {
                   labels.push($(this).attr('value'));
               } 
            });
            return labels.join(', ');  
         }
    }); 
});
</script>
<!--<link rel="stylesheet" type="text/css" href="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.css" />-->
