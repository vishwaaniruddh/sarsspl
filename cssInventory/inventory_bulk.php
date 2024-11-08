<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
?>
<html>
<head>
<title>Bulk Upload Inventory</title>
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

function validation()
{

  
     if(userfile=="")
     {
     swal("You Forgot to select an *.xls File to Import");
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
<h2 align="center">Upload Bulk Inventory Excel</h2>

<div class="container" style="margin-left:0px;">
<form id="myname" method="post" action="inventory_bulk_process.php" enctype="multipart/form-data" onSubmit="return validation(this)" name="form">
    <!--<form action="process_qrtsite_excel.php" method="post" enctype="multipart/form-data" onSubmit="return validate(this)" name="form">-->

   
    </table>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<table style="width:40%" align="center";>
<tr>
    <td width="432" height="35"><b>Upload Excel:  <a href="Excel/inventory_bulk.xls" download>Download format </a></b></td>  
</tr>
<tr>
<td width="432" height="35"><b>Select *.xls File to Import :</b>
<input type="file" name="userfile" value="" id="userfile"/></td>
</tr>
<tr>

</tr>



<tr>
<td height="35" colspan="2"><input type="submit" value="submit" class="readbutton" /></td>
</tr>
</table>


<?php
}else
{ 
 header("location: login.php");
}
?>
