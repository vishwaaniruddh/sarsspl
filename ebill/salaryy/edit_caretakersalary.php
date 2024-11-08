<?php 
include("../access.php");
include("../config.php");
$id=$_GET['send_id'];
$qry=mysqli_query($con,"select * from caretaker_salary where Sr='".$id."'");
$qrow=mysqli_fetch_array($qry);

?>

<html>
<head>

<link href="../datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="../datepicker/datepick_js.js" type="text/javascript"></script>
<script type="text/javascript" src="../1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.4.min.js"></script>

<script>
function func()
{
var status="";
if (document.getElementById('r1').checked) {
  status=document.getElementById('r1').value;
}
else if(document.getElementById('r2').checked)
{
 status=document.getElementById('r2').value;

}
var dt=document.getElementById('hdt').value;
var ctid=document.getElementById('ctid').value;
alert(ctid);
var conf=confirm('Do you really want to update the record?');
    

if(conf==true)
{

$.ajax({
   type: 'POST',    
url:'update_ctsalary.php',
 beforeSend: function()
                   {
        
                  //document.getElementById("sub").disabled="true";
                  },
data:'dt='+dt+'&status='+status+'&id='+ctid;
success: function(msg){

alert(msg);
  //document.getElementById('search').innerHTML=msg;
 
         }
     });


}






}

</script>


<style type ="text/css">
html {
overflow-y:scroll;
overflow-x:scroll;
}



</style>
</head>
<body>
<form method="post">
<input type="text" name="ctid" id="ctid" value="<?php echo $id;?>">
 
 <table border="2" align="center">
 <tr>
 <td>Service Status</td>
  <td><input type="radio" name="serst" id="r1" value="Active"  <?php if($qrow[2]=='Active'){echo "checked"; }?>>Active<input type="radio" name="serst" id="r2" value="Inactive"  <?php if($qrow[2]=='Inctive'){echo "checked"; }?>>Inactive</td>
 
 </tr>
<tr>
 <td>Handover Date</td>
  <td><input type="text" name="hdt" id="hdt"
  onclick="displayDatePicker('hdt');"  value="<?php if($qrow[23]!='0000-00-00'){echo date('d-m-Y',strtotime($qrow[23])); }?>"/></td>
 
 </tr>
  <tr>
 
<td  colspan="2" align="center"><input type="button" name="sub" id="sub" value="Update" onclick="func();"></td></tr>
 </table>
 <div id="search"></div>
 </form>
 <script type="text/javascript" src="../1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
 </body>
 </html>

 