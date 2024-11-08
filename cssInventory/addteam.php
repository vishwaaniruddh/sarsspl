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
             var boolemail=false;
            function mails(){
               var email=document.getElementById("email").value;
            //alert("h"+email);
              if(email!=""){ 
            
             $.ajax({
   type: 'POST',    
   url:'mailcheck.php',
  
    data:'email='+email,

   success: function(msg){
       //alert(msg);
      if(msg==1){
 boolemail=false;
swal("Email allready exist");

}
   else{
        boolemail=true;
         }
} })
}
return boolemail;

            }
            
            function finalval()
{
   
    if(validation() && mails())
    {
       return true; 
    }
    else
    {
        
        return false; 
        
    }
    
   
}
        </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <title>Add vendor</title>
 <?php include('header.php');?>

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

  var Name= document.getElementById("Name").value;
   var Address= document.getElementById("Address").value;
     var MobileNumber= document.getElementById("MobileNumber").value;
     var email= document.getElementById("email").value;
     var emailFilter =  /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/ ;
   
     
     if(Name=="")
     {
     swal("please enter name");
     return false;
     }
     else if(Address=="")
     {
     swal("please fill up Address");
     return false;
     } 
    else if(MobileNumber=="")
     {
     swal("please enter Mobile Number");
     return false;
     } 
     else if(MobileNumber=="")
     {
     swal("please enter Mobile Number");
     return false;
     }
     else if(email=="")
     {
     swal("please enter Email id ");
     return false;
     }
     else if (!emailFilter.test(email))
	{
		
		alert("invalid email ")
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
  <h2 align="center">Add Office Team</h2>
  <form method="POST" id="myname" name="myform" action="addteam_process.php">
   <tr>
     <td><label>Team:</label></td>
     <td><select  class="form-control" id="ddl_team" name="ddl_team"><option value="">select</option><option value="1">Office Team</option><option value="2">Filed Team</option></select>
    </td>
</tr>
   <tr>

      <td><label>Name:</label></td>
     <td><input type="text" class="form-control" id="Name" name="Name" placeholder="Enter Name" >
    </td>
</tr>
<tr>
<td>
      <label>Address:</label></td>
      <td><input type="text" class="form-control" id="Address" name="Address" placeholder="Address">
    </td>
</tr>

<tr>
<td>
      <label>Location:</label></td>
      <td><input type="text" class="form-control" id="Location" name="Location" placeholder="Location">
    </td>
</tr>
<tr>
<td>
      <label>State:</label></td>
      <td><select  id="ddl_state" name="ddl_state" class="form-control">
          <option value="">Select State</option>
          <?php  
          $stateQuery= mysqli_query($conn,"select * from state");
         while($statefetch= mysqli_fetch_array($stateQuery)){
          ?>
          <option value="<?php echo $statefetch[1]; ?>"><?php echo $statefetch[1]; ?></option>
          
          
          <? }?>
      </select>
    </td>
</tr>

<td>
      <label>City:</label></td>
      <td>
          <select  id="ddl_city" name="ddl_city" class="form-control">
          <option value="">Select city</option>
          <?php  
          $stateQuery= mysqli_query($conn,"select * from city");
         while($statefetch= mysqli_fetch_array($stateQuery)){
          ?>
          <option value="<?php echo $statefetch[1]; ?>"><?php echo $statefetch[1]; ?></option>
          
          
          <? }?>
      </select>
    </td>
</tr>
<tr>
<td>
      <label>Mobile Number:</label></td>
      <td><input type="text" class="form-control" id="MobileNumber" name="MobileNumber" placeholder="Mobile Number" onkeypress="return isNumberKey(event)" maxlength="10">
    </td>
</tr>




     <tr ><td colspan="2" ><button type="submit" style="margin-left:287px" class="btn btn-default">Submit</button></td></tr>
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