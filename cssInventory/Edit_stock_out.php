<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
?>
<html>
<head>
<title>Edit Inventory Out</title>
<?php include ('header.php');
include ('config.php');

$id=$_REQUEST['srno'];
$sql="select * from Inventory_OUT where iout='".$id."'";
$sqresult=mysqli_query($conn,$sql);
$erow=mysqli_fetch_array($sqresult);
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
{
   // var po= document.getElementById("po").value;
    var loc= document.getElementById("loc").value;
    var engname= document.getElementById("engname").value;
   var address= document.getElementById("address").value;
   var returnstock= document.getElementById("returnstock").value;
           
         if (loc=="")
        {
        alert("Please fillup Location");
        return false;            
        }
        else if (address=="")
        {
        alert("Please fillup Address");
        return false;            
        }
         
        else if (returnstock=="Return Stock"){
            if(engname==""){
               
                alert("Please Fill Up Engineer Name");
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
                        alert(msg);
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
   function TypeHideShow(){
    
   var  tp= document.getElementById("returnstock").value;
     //alert(tp);
      if(tp=="Return Stock")
      {
        $('#engname').show();
      
      }
      else
      { $('#engname').hide();
      
      }
       
   }  
</script>

</head>
<body>
<?php include 'menu.php';?>
<h2 align="center">Inventory Out</h2>

<div class="container" style="margin-left:0px;">
<form  method="post" action="Edit_stock_out_process.php" onsubmit="return validation()">

<table  style="width:100%">
          
           <tr> 
        <!--<td>Date</td>-->
        <td>Stock out return</td>
        <td>Eng Name</td>
        <td>SrNo</td>
        <td>Handover Person Name</td>
		<td>Vendor Name</td>
		<td>Material</td>
	    <td>Model No.</td>
	    <td>Qty</td>
	    <td>City</td>
	     <td>PO Number</td>
	   <!-- <td>Office Team</td>-->
		<td>Location</td>
		<!--<td>Install</td>-->
		<td>Address</td>
	    <td>Site Name</td>
		 </tr>
  <tr>
      <td><select name="returnstock" id="returnstock" onchange="TypeHideShow()">
          <option value="-1">Select </option>
          <option value="Return Stock">Return Stock</option>
      </select></td>
      <td><input type="text" id="engname" name="engname" style="display:none"></td>
    <td>
        <input type="text" name="Srno" id="Srno" value="<?php echo $erow['M_srno'];?>" style="width: 120px;border:none;background-color:#e2dddd" readonly>
   </td>
   <td>
       
       <input type="text" name="Handover" id="Handover" value="<?php echo $erow['Handover'];?>" style="width: 120px;">
       <!-- <select name="Handover" id="Handover" style="width: 100px;">
     <option value="<?php //echo $erow['Handover'];?>"><?php //echo $erow['Handover'];?></option>
    <?php 
      /* $qry="select * from Inventory_IN";
         //echo $qry;
         $result=mysqli_query($conn,$qry);
         while($row = mysqli_fetch_row($result))
	   {  ?>
		<option value="<?php echo $row[1];?>"/><?php echo $row[1]; ?></option>
               <br/>
      <?php } */?>
   
</select>-->
</td>
    <td>
        <input type="text"  name="Vendor" id="Vendor" value="<?php echo $erow['Vendor'];?>" style="width: 160px;border:none;background-color:#e2dddd" readonly>
        
        <!-- <select name="Vendor" id="Vendor" style="width: 100px;">
     <option value="<?php echo $erow['Vendor'];?>"><?php echo $erow['Vendor'];?></option>
    <?php 
       /*  $qry="select * from company";
         //echo $qry;
         $result=mysqli_query($conn,$qry);
         while($row = mysqli_fetch_row($result))
	   {  ?>
		<option value="<?php echo $row[1];?>"/><?php echo $row[1]; ?></option>
               <br/>
      <?php }*/ ?>
   
</select>-->
</td>
    
     <td>
          <input type="text"  name="Material" id="Material" value="<?php echo $erow['Material']?>" style="width: 150px;border:none;background-color:#e2dddd" readonly>
       
         
       <!--   <select name="Material" id="Material" onchange="modelnos()" style="width: 100px;">
     <option value="<?php //echo $erow['Material']?>"><?php //echo $erow['Material']?></option>
    <?php 
       /*  $qry="select * from material";
         //echo $qry;
         $result=mysqli_query($conn,$qry);
         while($row = mysqli_fetch_row($result))
	   {  ?>
		<option value="<?php echo $row[0];?>"/><?php echo $row[1]; ?></option>
               <br/>
      <?php } */?>
   
</select>-->
</td>
    
    <td>
          <input type="text"   name="Model"  id="Model"   value="<?php echo $erow['Model']?>" style="width: 120px;border:none;background-color:#e2dddd" readonly>
       
     <!--    <select name="Model" id="Model"  style="width: 100px;">
     <option value="<?php echo $erow['Model']?>"><?php echo $erow['Model']?></option>
    
   
</select>-->
</td>
  <input type="text" name="id" id="id" style="width: 70px;" value="<?php echo $id;?>">
<input type="hidden" name="atmid" id="atmid" style="width: 70px;" value="<?php echo $erow['ATMID'];?>">
   <td><input type="text" name="qty" id="qty" style="width: 70px;border:none;background-color:#e2dddd" value="<?php echo $erow['qty']?>" readonly></td>
    <td><input type="text" name="City" id="City" style="width: 120px;" value="<?php echo $erow['City']?>"></td>
   <!-- <td> <select name="officeteam" id="officeteam"  style="width: 100px;">
     <option value="<?php// echo $erow['officeteam']?>"><?php// echo $erow['officeteam']?></option>
    <?php 
        /* $qry="select * from team";
         //echo $qry;
         $result=mysqli_query($conn,$qry);
         while($row = mysqli_fetch_row($result))
	   {  ?>
		<option value="<?php echo $row[1];?>"/><?php echo $row[1]; ?></option>
               <br/>
      <?php }*/ ?>
   
</select>
</td>-->
    <td><input type="text" name="po" id="po" style="width: 120px;" value="<?php echo $erow['PO_Number']?>"></td>
    <td><input type="text" name="loc" id="loc" style="width: 120px;" value="<?php echo $erow['loc']?>"></td>
    <!--<td><input type="text" name="Install" id="Install" style="width: 120px;" value="<?php echo $erow['Install']?>"></td>-->
    <td><input type="text" name="address" id="address" style="width: 110px;" value="<?php echo $erow['address']?>"></td>
    <td><input type="text" name="Sitename" id="Sitename" style="width: 90px;" value="<?php echo $erow['address']?>"></td>
   
  </tr>
 </table>

<br>
<div align="center">
    <tr>
	   <input type="submit" name="submit" value="update" class="btnRegister" />
		
		</tr>
		</div>
		</form>
</body>
</html>
<?php

}else
{ 
 header("location: login.php");
}
?>
