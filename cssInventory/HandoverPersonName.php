<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
       
        <script>

        </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <title></title>
 <?php include('header.php');?>

<script>

function validation()
{

  var Handover= document.getElementById("Handover").value;
   
     
   
     
     if(Handover=="")
     {
     swal("please enter name");
     return false;
     }
    
     else{
 
     
     return true;
          }
}

</script>
<style>
#border {
    border: 2px solid red;
    border-radius: 12px;
    
}
</style>
</head>
<body>
<?php include('menu.php')?>
<table border="1" style="width:50%" align="center" >
  <h2 align="center">Handover Person Name</h2>
  <form method="POST" id="myname" name="myform" action="HandoverPersonName_process.php" onsubmit="return validation()">
   
   <tr>

      <td><label>Handover Person Name:</label></td>
     <td><input type="text" class="form-control" id="Handover" name="Handover" placeholder="Enter Name" >
    </td>
</tr>
<tr>
<td>
      <label>City:</label></td>
      <td><select name="City" id="City">
  <option value="Mumbai">Mumbai</option>
  <option value="Punjab">Punjab</option>
  <option value="Maharashtra">Maharashtra</option>
</select>
    </td>
</tr>



     <tr><td colspan="2"><button type="submit" style="margin-left: 296px;" align="center" class="btn btn-default">Submit</button></td></tr>
  </form>
</table>
</body>
</html>
<?php
}else
{ 
 header("location: login.php");
}
?>