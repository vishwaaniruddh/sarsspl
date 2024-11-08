<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
?>
<html>
<head>
<title>Add Faulty Item</title>
<?php include ('header.php');
include ('config.php');

?>

<style>
      table, td {
                 border: 1px solid black;
                
                }
#border {
    border: 2px solid red;
    border-radius: 12px;
}
</style>
 <script>

 
 
 
  function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode != 46 && charCode > 31
              && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
</script>

<script>


function TocheckSerialNo(count){
 
  
  var to=count-1;
  var text="srno"+to;
  
var inputfields1 = document.getElementsByName("srno[]");

for (var i = 0; i < inputfields1.length-1; i++)
{
var textbox = document.getElementById(text).value;

if(textbox==inputfields1[i].value && text!='srno'+[i] ){
    
myDeleteFunction();
$('form input').on('keypress', function(e) {

   return e.which !== 13;
    
 
});
 
    alert("Duplicate Value / Delete this row")
 
 
}
  
}

var ccc= $('#myTable').find('tr').length;
 var ddd=ccc-1;
  //alert(ddd)
  document.getElementById("demo").innerHTML = ddd;  
 //  document.getElementById("demo2").value = ddd;  
   
}


function validation()
{ var srno= document.getElementsByName('srno[]');
  var modelno= document.getElementsByName('modelno[]');
  var material = document.getElementsByName('material[]');
  var companyname = document.getElementsByName('companyname[]');
  var vendorname= document.getElementsByName('vendorname[]');
  
        for (var i = 0; i < srno.length; i++)
       {      
             
        if (srno[i].value=="")
        {
        alert("Please Fillup sr no ");
        srno[i].focus();
        return false;            
        }
        else if (modelno[i].value=="")
        {
        alert("Please fillup Model No");
        modelno[i].focus();
        return false;            
        }
        else if (material[i].value=="")
        {
        alert("Please fillup Material Name");
        material[i].focus();
        return false;            
        }
         else if (companyname[i].value=="")
        {
        alert("Please fillup Company Name ");
        companyname[i].focus();
        return false;            
        }
        else if (vendorname[i].value=="")
        {
        alert("Please fill up vendor name");
        vendorname[i].focus();
        return false;            
        }
       }
 
return true;
        
}
</script>
<script>
    
    function modelnos() {
//alert("hello");

var Material=document.getElementById("Material").value;
//alert(productname);
$.ajax({
                    
                    type:'POST',
                    url:'materialmodel.php',
                     data:'material='+Material,
                     datatype:'json',
                    success:function(msg){
                      //  alert(msg);
                       var jsr=JSON.parse(msg);
                       //alert(jsr.length);
                        var newoption=' <option value="">Select</option>' ;
                        $('#Model').empty();
                        for(var i=0;i<jsr.length;i++)
                        {
                         
                       
                      //var newoption= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["modelno"]+'</option> ';
		                   newoption+= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["modelno"]+'</option> ';
			
                        
                        }                       
                     $('#Model').append(newoption);
 
                    }
                })
                
            }
</script>


</head>
<body>
<?php include 'menu.php';?>
<h2 align="center">Faulty Inventory</h2>

<div class="container" style="margin-left:0px;">
<form  method="post" action="Faulty_process.php" onsubmit="return validation()">

<table  style="width:100%">
          
           <tr> 
       
		
		<td>Material</td>
	    <td>Model No.</td>
	    <td>Vendor Name</td>
	    <td>Qty</td>
	    <td>City</td>
		<td>Location</td>
		<td>Address</td>
	    <td>Remark</td>
		 </tr>
  <tr>
    
     <td> <select name="Material" id="Material" onchange="modelnos()" style="width: 100px;">
     <option value="">Select</option>
    <?php 
         $qry="select * from material";
         //echo $qry;
         $result=mysqli_query($conn,$qry);
         while($row = mysqli_fetch_row($result))
	   {  ?>
		<option value="<?php echo $row[0];?>"/><?php echo $row[2]; ?></option>
               <br/>
      <?php } ?>
   
</select>
</td>
    
    <td> <select name="Model" id="Model" style="width: 100px;">
     <option value="">Select</option>
    
   
</select>
</td>

<td> <select name="Vendor" id="Vendor" style="width: 100px;">
     <option value="">Select</option>
    <?php 
         $qry="select * from vendor";
         //echo $qry;
         $result=mysqli_query($conn,$qry);
         while($row = mysqli_fetch_row($result))
	   {  ?>
		<option value="<?php echo $row[1];?>"/><?php echo $row[1]; ?></option>
               <br/>
      <?php } ?>
   
</select>
</td>
   <td><input type="text" name="qty" id="qty" value="1" readonly style="width: 70px;"></td>
   
    <td><input type="text" name="City" id="City" style="width: 120px;"></td>
    <td><input type="text" name="loc" id="loc" style="width: 120px;"></td>
    
    <td><input type="text" name="address" id="address" style="width: 120px;"></td>
    <td><input type="text" name="remark" id="remark" style="width: 120px;"></td>
   
  </tr>
 </table>
 </br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 
 <table id="myTable" style="width:25%" align="center">
     <tr> 
       <td>Sr.No.</td>
     </tr>
     <tr><td><input type="text" name="srno[]" id="srno0"  style="width:250px;"></td></tr>
     
 </table>
<br>
<div align="center">
    <tr>
	   <input type="submit" name="submit" value="submit" class="btnRegister" />
		<input  type="button" onclick="myCreateFunction()" value="Add row"/>
		<input type="button" onclick="myDeleteFunction()" value="Delete row"/>
		</tr>
		</div>
		</form>
		


		
<script>
   var cnt=0;
function myCreateFunction() {
 
    var table = document.getElementById("myTable");
       cnt++;
     var row = table.insertRow(-1);
    var cell1 = row.insertCell(0);
    
    cell1.innerHTML = '<input type="text" name="srno[]" id="srno'+cnt +'"   style="width: 250px;" >';
  $('#srno'+cnt).focus();
  
TocheckSerialNo(cnt);
    }

function myDeleteFunction() {
var rowCount = myTable.rows.length;
var a=rowCount - 1;
cnt--;
if(a!=0){

    document.getElementById("myTable").deleteRow(-1);
}}

</script>

</body>
</html>

<script>
$(document).keypress(function (e) {
   
                if (e.which == 13 || event.keyCode == 13) {
                     
                  //  alert('enter key is pressed');
                   event.preventDefault(); 
                   myCreateFunction();
                 
                    
                   
                }
               
               
            });
        </script>    


<?php
}else
{ 
 header("location: login.php");
}
?>
