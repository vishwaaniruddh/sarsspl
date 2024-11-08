<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
?>
<html>
<head>
<title>Add Enventory</title>
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
        
  function validation()
         {
  
  var vendorname= document.getElementById("vendorname").value;
   var Mname = document.getElementById("name").value;
  
   var modelno= document.getElementsByName('modelno[]');
  //  alert(modelno.length)
    var b="";
    
    if(modelno.length!='1'){
    
    for (var i=0; i<modelno.length-1; i++)
       {       
        if (modelno[i].value=="")
        {
        swal("Please Fillup model no");
        modelno[i].focus();
          
        b="false";
        break;
        }
       }
    }
    else{
        if (modelno[0].value=="")
        {
         swal("Please Fillup model no");
      
          return false;
        }
    }
    
    
    
     if(vendorname=="")
     {
     swal("please enter vendor name");
     return false;
     }
     else if(Mname=="")
     {
     swal("please fill up material name");
     return false;
     } 
    else if(b=="false")
    {
        return false;
    }
   
     else{
 
     
     return true;
          }
}



 
        

</script>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


</head>
<body>
<?php include 'menu.php';?>
<h2 align="center">Add Material</h2>

<div class="container">
<form  method="post" action="addmaterial_process.php" onsubmit="return validation()" >
<table  style="width:50%" align="center";>
    <tr><td>Vendor Name:</td><td> <select name="vendorname" id="vendorname" style="width: 250px;">
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
		
</td></tr>
    <tr><td>Material Name:</td> <td ><input type="text" name="name" id="name" style="width: 250px;"></td>
    </tr>
    

    
   </table>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   
<table id="myTable" style="width:25%" align="center">
        <tr>
            <td>Model NO:</td>
            <td>PO No:</td>
            <td>Project:</td>
        </tr>
        <tr>
            <td>
                <input type="text" name="modelno[]" id="modelno"  style="width: 250px;">
            </td>
            <td>
                <input type="text" name="pono[]" id="modelno"  style="width: 250px;">
            </td>
            <td>
                <input type="text" name="project[]" id="modelno"  style="width: 250px;">
            </td>
        </tr>
 </table>
<br>

	   <div align="center"><input type="submit" name="submit" value="submit" class="btnRegister" />
		 <input  type="button" onclick="myCreateFunction()" value="Add row"/>
		<input type="button" onclick="myDeleteFunction()" value="Delete row">
		</div>
		</form>
		


		
<script>
var cnt=0;
function myCreateFunction() { 
    var table = document.getElementById("myTable");
    cnt++;
   
   a= '<tr><td><input type="text" name="modelno[]" id="modelno" style="width: 250px;"></td>';
   a +=' <td><input type="text" name="pono[]" id="modelno" style="width: 250px;"></td>';
   a +=' <td><input type="text" name="project[]" id="modelno" style="width: 250px;"></td></tr>';
   
   $("#myTable").find('tbody').append(a);
   
   
  // alert(cn);
    // var row = table.insertRow(-1);
    // console.log(row);
    // var cell1 = row.insertCell(0);
    
    // cell1.innerHTML ='<td><input type="text" name="modelno[]" id="modelno" style="width: 250px;"></td> <td><input type="text" name="modelno[]" id="modelno" style="width: 250px;"></td><td><input type="text" name="modelno[]" id="modelno" style="width: 250px;"></td>';
            
    // cell1.innerHTML ='<input type="text" name="modelno[]" id="modelno'+cnt +'" style="width:250px;">';
    // $('#modelno'+cnt).focus();
   
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

<script>
$(document).keypress(function (e) {   
                if (e.which == 13 || event.keyCode == 13) {
                     
                  //  alert('enter key is pressed');
                   event.preventDefault(); 
                   myCreateFunction();
                 
                    
                   
                }
               
               
            });
            
        

       
        

</script>