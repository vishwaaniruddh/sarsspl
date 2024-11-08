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
{ 
   var count = $('#myTable1 tr').length;
    
   for(var i=1;i<count;i++){
       
  var Description= document.getElementById('Description'+i).value;
  var Qty= document.getElementById('Qty'+i).value;
  var PerRate= document.getElementById('PerRate'+i).value;
 
              
        if (Description=="")
        {
        swal("Please Fill up Description");
        return false;            
        }
        else if (Qty=="")
        {
        swal("Please fill up Qty");
        return false;            
        }
        else if (PerRate=="")
        {
        swal("Please fill up product Rate");
        return false;            
        }
       
   }  
   popup();
  
   
      /*else
       {
       popup();
       }
      */
          
}

</script>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
           /* function prints(){
                // var mname=document.getElementById("mbid").value;
                 
                
               
            $.ajax({
   type: 'POST',    
   url:'pdfcon.php',
   // data:'mname1='+mname+'&name='+name+'&author='+author+'&serial='+serial,

   success: function(msg){
    
    
   alert(msg);
   //document.getElementById("show").innerHTML=msg;
  
   
   
   
   
   
  
  
   
} })
            }
            */
        </script>

<script>
        /*    function mail(){
            
             // alert(id);
                $.ajax({
                    
                    type:'POST',
                    url:'sendpdf_process.php',
                     //data:'bid='+bid+'&status=2',
                    success:function(msg){
                        alert(msg);

                    }
                })
                
            }
            */
        </script>


<script>
function popup(){
   /*
var Description=document.getElementById("Description").value;
var Qty=document.getElementById("Qty").value;
var PerRate=document.getElementById("PerRate").value;
var GST=document.getElementById("GST").value;
var total=document.getElementById("total").value;
 */

var selchbox = [];
var inputfields = document.getElementsByName("Description");

for (var i = 0; i < inputfields.length; i++)
{
 selchbox.push(inputfields[i].value);
 alert("ram")
}
var Description = selchbox;

  
  
var selchbox1 = [];
var inputfields1 = document.getElementsByName("Qty");
for (var i = 0; i < inputfields1.length; i++)
{
 selchbox1.push(inputfields1[i].value);
}
var Qty= selchbox1;
   

var selchbox2 = [];
var inputfields2 = document.getElementsByName("PerRate");
for (var i = 0; i < inputfields2.length; i++)
{
 selchbox2.push(inputfields2[i].value);
}
var PerRate= selchbox2;

   
var selchbox3 = [];
var inputfields3 = document.getElementsByName("GST");
for (var i = 0; i < inputfields3.length; i++)
{
 selchbox3.push(inputfields3[i].value);
}
var GST= selchbox3;
  
   
var selchbox4 = [];
var inputfields4 = document.getElementsByName("total");
for (var i = 0; i < inputfields4.length; i++)
{
 selchbox4.push(inputfields4[i].value);
}
var total= selchbox4;
          
            $.ajax({
   type: 'POST',    
   url:'po_process_form.php',
    data:'Description='+Description+'&Qty='+Qty+'&PerRate='+PerRate+'&GST='+GST+'&total='+total,

   success: function(msg){
    
    
  document.getElementById("last").value=msg;
  // document.getElementById("show").innerHTML=msg;
    if(msg)
   { 
   $("#hd").show();
   $("#ckl").click(); 

    }
  
   
} })
            }
        </script>
<script>
    function rates(){
        //alert("hello");
       var totalqty= document.getElementById("Qty1").value;
       var totalrate= document.getElementById("PerRate1").value;
       
       var x=totalqty * totalrate;
       var result=document.innerHTML = x;
        //alert(result);
        var gst=result +(result*0.18);
        var onlygst=(result*0.18);
        var roundgst=Math.round(onlygst);
        var withroundgst=document.getElementById("GST1").value=roundgst;
        
        var round=Math.round(gst);
        var withgst=document.getElementById("total1").value=round;
        //alert("gst"+withgst);
        
    }
    
    function hello_test(count){
        
         var totalqty= document.getElementById("Qty"+count).value;
       var totalrate= document.getElementById("PerRate"+count).value;
       
       var x=totalqty * totalrate;
       var result=document.innerHTML = x;
        //alert(result);
        var gst=result +(result*0.18);
        var onlygst=(result*0.18);
        var roundgst=Math.round(onlygst);
        var withroundgst=document.getElementById("GST"+count).value=roundgst;
        
        var round=Math.round(gst);
        var withgst=document.getElementById("total"+count).value=round;
        //alert("gst"+withgst);
    }
    
    
  /*  function hello(count){
        var Qty=document.getElementById("Qty"+count).value;
var PerRate=document.getElementById("PerRate"+count).value;

var selchbox = [];
var inputfields = document.getElementsByName("Qty"+count);

for (var i = 0; i < inputfields.length; i++)
{
    
 selchbox.push(inputfields[i].value);
}
var qty = selchbox;

var selchbox1 = [];
var inputfields1 = document.getElementsByName("PerRate"+count);
for (var i = 0; i < inputfields1.length; i++)
{
 selchbox.push(inputfields[i].value);
}
var rates = selchbox;
alert(rates);

for (var i=0;i< rates;i++){
       
       var x=totalqty * totalrate;
        alert(x);
       var result=document.innerHTML = x;
        //alert(result);
        var gst=result +(result*0.18);
        var onlygst=(result*0.18);
        var roundgst=Math.round(onlygst);
        var withroundgst=document.getElementById("GST"+count).value=roundgst;
        
        var round=Math.round(gst);
        var withgst=document.getElementById("total"+count).value=round;
    }
    }*/
</script>
</head>
<body>
  <?php include 'menu.php';?>  
<h2 align="center">PO Form</h2>


<div id="hd" style="display:none">
<div class="container">
 
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" id="ckl" data-toggle="modal" data-target="#myModal" style="display:none">Open Large Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md" style="top: 160px;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">send pdf </h4>
        </div>
        <div class="modal-body">
         <form  method="post" action="pdfcon.php" style="width: 567px;" >

<table align="center" id="myTable" width="70" height="35" border="1">
         
  <tr><td style="width: 150px;"><leble>Select Email Id:</lable></td>
<td> <select name="pdfimail" id="pdfimail" style="width: 200px;">
     <option value="">Select</option>
    <?php 
         $qry="select * from email";
         //echo $qry;
         $result=mysqli_query($conn,$qry);
         while($row = mysqli_fetch_row($result))
	   {  ?>
		<option value="<?php echo $row[2];?>"/><?php echo $row[2]; ?></option>
               <br/>
      <?php } ?>
   
</select>
</td>
    <input type="text" name="last" id="last"/>
    <!--<td ><input type="text" name="email" id="email" style="width: 250px;"></td>-->
</tr>

</table>
<br/>
<center><input type="submit"  name="submit" value="ok" class="btn btn-default" class="btn btn-default "/></center></br>
                    

		</form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button></br>
<!--<button type="button" onclick="" >pdf</button>-->
        </div>
      </div>
    </div>
  </div>
</div>


</div>





<div class="container" style="margin-left:0px;">
<form  method="post" action="">

<table align="center" id="myTable1" style="width: 100px;">
         
  <tr>
<td><leble>Description:</lable></td>
<td><leble>Qty:</lable></td>
<td><leble>Per Rate:</lable></td>
<td><leble>GST-18%:</lable></td>
<td><leble>Total</lable></td>
</tr>
<tr>
    <td ><input type="text" name="Description" id="Description1" style="width: 350px;" ></td>
    <td ><input type="text" name="Qty" id="Qty1" style="width: 100px;" onkeypress="return isNumberKey(event)"></td>
    <td ><input type="text" name="PerRate" id="PerRate1" style="width: 168px;" onblur="rates()" onkeypress="return isNumberKey(event)"></td>
    <td ><input type="text" name="GST" id="GST1" style="width: 168px;"></td>
    <td ><input type="text" name="total" id="total1" style="width: 200px;"></td>
</tr>
</table>
</br>

<div align="center"> <input type="button"  name="submit" value="submit" class="readbutton" onclick="validation()" />  
	                 <input  type="button" onclick="myCreateFunction()" value="Add row" >
                      <input type="button" onclick="myDeleteFunction()" value="Delete row" class="readbutton">
		</div>

		</form>
		
	
<script>
function myCreateFunction() {
     var table = document.getElementById("myTable1");
   var count = $('#myTable1 tr').length;
  
     var row = table.insertRow(-1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
  
cell1.innerHTML ='<input type="text" name="Description" id="Description'+count +'" style="width:350px;">';
cell2.innerHTML ='<input type="text" name="Qty" id="Qty'+count +'"style="width: 100px;" onkeypress="return isNumberKey(event)">';
cell3.innerHTML ='<input type="text" name="PerRate" id="PerRate'+count +'" onblur="hello_test('+count +')" style="width: 168px;" onkeypress="return isNumberKey(event)">';
cell4.innerHTML ='<input type="text" name="GST" id="GST'+count +'" style="width: 168px;">';
cell5.innerHTML ='<input type="text" name="total" id="total'+count +'" style="width: 200px;" >';


}


function myDeleteFunction() {
var rowCount = myTable1.rows.length;
var a=rowCount - 1;
if(a!=0){

    document.getElementById("myTable1").deleteRow(-1);
}}
</script>
<script>
function myFunction() {
    window.print();
}
</script>

</body>
</html>
<?php
}else
{ 
 header("location: login.php");
}
?>
