<?php
session_start();
/*if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{*/
?>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>

<!--==========================   date picker  ===================-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

       <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
<script>
$(function() {
 // $('#datetimepicker1').datetimepicker();
 $('#datetimepickerFrom').datetimepicker({format: 'DD-MM-YYYY'});
  $('#datetimepickerTo').datetimepicker({format: 'DD-MM-YYYY'});
 
});
</script>
<body style="background-color: #E6E6FA">
           <div>
			<center><h1 style="margin-top:70px; color:black;"  ><b>Lead Entry</b></h1></center>
			</div>
<form action "lead_entry_process.php" method="POST">
<table align="center" border="1" width="40%">
    <tr>
      <td width="20%">
          <label><b></b>Title </label><td ><select name="Title" id="Title" style="width:200px;">
              <option value="1">option1</option>
              <option value="2">option2</option></select>
          </td>
      </td>
  </tr >
  
  <tr>
      <td width="20%">
          <label><b></b>First Name </label><td ><input type="text" name="FirstName" id="FirstName"/></td>
      </td>
  </tr >
  
  <tr>
      <td width="20%">
          <label><b></b>Last Name </label><td ><input type="text" name="LastName " id="LastName"/></td>
      </td>
  </tr >
  
  <tr><td width="40%">
      
          <label><b></b>Mobile code </label><input type="text" name="Mobilecode1" id="Mobilecode1"/>
      
          <label><b></b>Mobile Number </label><input type="text" name="Mobilenum1" id="Mobilenum1"/>
      </td>
  </tr >
  
<tr><td width="20%"><label><b>From Date:</b></label></td>
       <td width="20%" class='input-group date' id='datetimepickerFrom'>
          <input type='text' style="width:200px;" id="fromdate" name="fromdate"/>
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
       </td>
</tr>


<!--===================================================-->
        <tr><td><input type="button" name="submit" onclick="a('','')"value="search"></button></td></tr>
        </table>
        </form>	
</body>
    
</html>

<?php
/*}else
{ 
// header("location: index.php");
}*/
?>




