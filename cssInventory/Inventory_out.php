<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
?>
<html>
<head>
<title>Add Inventory</title>
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
     function abc() {


var Vendor=document.getElementById("Vendor").value;
//alert(Vendor);
$.ajax({
                    
                    type:'POST',
                    url:'materialvendor.php',
                     data:'vendorname='+Vendor,
                     datatype:'json',
                    success:function(msg){
                        //alert(msg);
                       var jsr=JSON.parse(msg);
                       //alert(jsr.length);
                        var newoption=' <option value="">Select</option>' ;
                        $('#Material').empty();
                        
                        for(var i=0;i<jsr.length;i++)
                        {
                         
                       
                      //var newoption= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["modelno"]+'</option> ';
		                   newoption+= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["material"]+'</option> ';
		
                        
                        }                       
                     	$('#Material').append(newoption);
 
                    }
                })
                
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
                       // alert(msg);
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
<script>
    var clicks = 1;
    function onClick() {
        clicks += 1;
        document.getElementById("demo").innerHTML = clicks;
        document.getElementById("demo2").value = clicks;
    };
    </script>
    
   <script>
    var clicks;
    function onClick1() {
        clicks -= 1;
      
        document.getElementById("demo").innerHTML = clicks;
        document.getElementById("demo2").value = clicks;
        
    };
   
</script>

</head>
<body>
<?php include 'menu.php';?>
<h2 align="center">Inventory Out</h2>

<div class="container" style="margin-left:0px;">
<form  method="post" action="inventory_out_process.php" onsubmit="return validation()">

<table  style="width:100%">
          
           <tr> 
        <!--<td>Date</td>-->
        <!--<td>Sr.No.</td>-->
        <td>Handover Person Name</td>
		<td>Vendor Name</td>
		<td>Material</td>
	    <td>Model No.</td>
	    <td>Qty</td>
	    <td>City</td>
	    <td>PO Name</td>
	    <td>Office Team</td>
		<td>Location</td>
		<td>Install</td>
		<td>Address</td>
	    <td>Site Name</td>
		 </tr>
  <tr>
   
   <td> <select name="Handover" id="Handover" style="width: 100px;">
     <option value="">Select</option>
    <?php 
         $qry="select * from Inventory_IN";
         //echo $qry;
         $result=mysqli_query($conn,$qry);
         while($row = mysqli_fetch_row($result))
	   {  ?>
		<option value="<?php echo $row[1];?>"/><?php echo $row[1]; ?></option>
               <br/>
      <?php } ?>
   
</select>
</td>
    <td> <select name="Vendor" id="Vendor" style="width: 100px;" onchange="abc()">
     <option value="">Select</option>
    <?php 
         $qry="select * from vendor";
         //echo $qry;
         $result=mysqli_query($conn,$qry);
         while($row = mysqli_fetch_row($result))
	   {  ?>
		<option value="<?php echo $row[0];?>"/><?php echo $row[1]; ?></option>
               <br/>
      <?php } ?>
   
</select>
</td>
    
     <td> <select name="Material" id="Material" onchange="modelnos()" style="width: 100px;">
     <option value="">Select</option>
    <?php 
    /*
         $qry="select * from material";
         //echo $qry;
         $result=mysqli_query($conn,$qry);
         while($row = mysqli_fetch_row($result))
	   {  ?>
		<option value="<?php echo $row[0];?>"/><?php echo $row[1]; ?></option>
               <br/>
      <?php } 
      */
      ?>
   
</select>
</td>
    
    <td> <select name="Model" id="Model" style="width: 100px;">
     <option value="">Select</option>
    
   
</select>
</td>
<td id="demo">1</td>
   <input type="hidden" id="demo2" name="demo2"/>
   <!--<td><input type="text" name="qty" id="qty" style="width: 70px;"></td>-->
    <td><input type="text" name="City" id="City" style="width: 120px;"></td>
    <td><input type="text" name="po" id="po" style="width: 120px;"></td>
    <td> <select name="officeteam" id="officeteam"  style="width: 100px;">
     <option value="">Select</option>
    <?php 
         $qry="select * from team";
         //echo $qry;
         $result=mysqli_query($conn,$qry);
         while($row = mysqli_fetch_row($result))
	   {  ?>
		<option value="<?php echo $row[1];?>"/><?php echo $row[1]; ?></option>
               <br/>
      <?php } ?>
   
</select>
</td>
    <td><input type="text" name="loc" id="loc" style="width: 120px;"></td>
    <td><input type="text" name="Install" id="Install" style="width: 120px;"></td>
    <td><input type="text" name="address" id="address" style="width: 120px;"></td>
    <td><input type="text" name="Sitename" id="Sitename" style="width: 120px;"></td>
   
  </tr>
 </table>
 </br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 
 <table id="myTable" style="width:25%" align="center">
     <tr> 
       <td>Sr.No.</td>
     </tr>
     <tr><td><input type="text" name="srno[]" id="srno[]" style="width:250px;"></td></tr>
     
 </table>
<br>
<div align="center">
    <tr>
	   <input type="submit" name="submit" value="submit" class="btnRegister" />
		<input  type="button" onclick="myCreateFunction();onClick();" value="Add row"/>
		<input type="button" onclick="myDeleteFunction();onClick1();" value="Delete row"/>
		</tr>
		</div>
		</form>
		


		
<script>

function myCreateFunction() {
    var table = document.getElementById("myTable");
   
     var row = table.insertRow(-1);
    var cell1 = row.insertCell(0);
    
    cell1.innerHTML = '<input type="text" name="srno[]" id="srno[]" style="width: 250px;">';
   
 
 /*
 cell4.innerHTML ="<select name='companyname[]' id='companyname[]' style='width: 120px;'> <option value=' '>Select</option><?php 
         $qry='select * from company';
         $result=mysqli_query($conn,$qry);
         while($row=mysqli_fetch_row($result))
	   {  ?>
		<option value='<?php echo $row[1];?>'/><?php echo $row[1]; ?></option><br/> <?php } ?> </select>";
		
		cell5.innerHTML ="<select name='vendorname[]' id='vendorname[]' style='width: 120px;'> <option value=' '>Select</option><?php 
         $qry='select * from vendor';
         $result=mysqli_query($conn,$qry);
         while($row=mysqli_fetch_row($result))
	   {  ?>
		<option value='<?php echo $row[1];?>'/><?php echo $row[1]; ?></option><br/> <?php } ?> </select>";
 
*/
    }

function myDeleteFunction() {
var rowCount = myTable.rows.length;
var a=rowCount - 1;
if(a!=0){

    document.getElementById("myTable").deleteRow(-1);
}}

</script>

</body>
</html>
<?php
}else
{ 
 header("location: login.php");
}
?>
