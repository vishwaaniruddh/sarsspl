<?php
session_start();
include ('config.php');
 
         ?>
 <!DOCTYPE html>
<html> 
  <head>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create roll</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="icon" href="images/favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,700%7CRoboto+Slab:400,300,700">
    <link rel="stylesheet" href="css/sig.css">
    
<link rel="stylesheet" href="css/bootstrap.min.css">
<!--<link rel="stylesheet" href="bootstrap.css">-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
 <link rel="stylesheet" href="multipledropdown.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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



</style>

<script>
    function validation()
{
    var lstStates=document.getElementById("lstStates").value;
     var Roll=document.getElementById("Roll").value;
     
   
     if(lstStates=="")
     {
     swal("drop down  can not be empty");
     return false;
     } 
    else if(Roll=="")
     {
     swal("Roll can not be empty");
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
     var Roll= document.getElementById("Roll").value; 
     var drop= document.getElementById("drop").value;
            $.ajax({
   type: 'POST',    
   url:'roll_process.php',
   
    data:'Roll='+Roll+'&drop='+drop,

   success: function(msg){
    
    
   //alert(msg);
 if(msg==1){
     swal("Roll Created Successfully ");
     window.open("roll.php","_self");
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
                  
      <form  method="post" id="myForm">
      <div><input type="hidden" name="drop" id="drop"/></div>
      
        <h1>Create Roll</h1>

        <fieldset>
         
          
          <label for="name"><b>Roll:</b></label>
          <input type="text" id="Roll" name="Roll" placeholder="Create Roll">
          
    
    <div class="row div1">
    
    <div  class="col-md-3"><leble>Permission</leble></div>
     <div  class="col-md-7">  
     
      <select name="lstStates" multiple="multiple" id="lstStates" onchange="per()">
          
    <optgroup label="Lead Entry">
         <optgroup label=" ">
        <option value="1">Add Lead Entry</option>
        <option value="2">View Lead</option>
        <option value="15">bulk upload lead</option>
         </optgroup>
          </optgroup>
          
          
          
           <optgroup label="Users">
               </optgroup>
                <optgroup label=" ">
                <option value="3">Create roll</option>    
                <option value="4">Add User</option>
                <option value="5">View User</option>
               </optgroup>
               
               
               <optgroup label="Employee">
               </optgroup>
        <optgroup label="">
            <option value="6">Add Employee</option>
            <option value="7">View Employee</option>
            <option value="8">bulk upload Employee</option>
           
        </optgroup>
         
         <optgroup label="Lead Update">
               </optgroup>
        <optgroup label="">
            <option value="9">Update Lead</option>
            <option value="10">View Update</option>
            
        </optgroup>
          
          
           <optgroup label="Lead Sources">
               </optgroup>
        <optgroup label="">
            <option value="11">Add Lead source</option>
            <option value="12">View Lead source</option>

        </optgroup>
    </select>   
     
     
     </div>
      <div  class="col-md-2"></div>
</div>
 </br>     
          
<center>
<button type="button" onclick="validation()" style="border-radius: 50px;width: 206px;height: 37px;background-color: #fbba00;">Create</button>
</center></br>


      </form>
       
               
        
</script>        
           
    </body>
</html>
<? //echo $abc; ?>
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
