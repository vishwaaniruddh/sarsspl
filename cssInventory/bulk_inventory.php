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
 <script>d
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

  //var companyname= document.getElementById("companyname").value;
   var vendorname= document.getElementById("vendorname").value; 
     var material= document.getElementById("material").value;
     var modelno= document.getElementById("modelno").value;
     var qty= document.getElementById("qty").value;
     var userfile= document.getElementById("userfile").value;
    
     
     
     if(vendorname=="")
     {
     swal("please fill up vendorname");
     return false;
     } 
    else if(material=="")
     {
     swal("please enter material name");
     return false;
     } 
     else if(modelno=="")
     {
     swal("please enter model Number");
     return false;
     }
     
     else if(qty=="")
     {
     swal("please enter quantity");
     return false;
     }
     
     else if(userfile=="")
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

<script>
     function abc() {


var vendorname=document.getElementById("vendorname").value;
//alert(productname);
$.ajax({
                    
                    type:'POST',
                    url:'materialvendor.php',
                     data:'vendorname='+vendorname,
                     datatype:'json',
                    success:function(msg){
                        //alert(msg);
                       var jsr=JSON.parse(msg);
                       //alert(jsr.length);
                        var newoption=' <option value="">Select</option>' ;
                        $('#material').empty();
                        
                        for(var i=0;i<jsr.length;i++)
                        {
                         
                       
                      //var newoption= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["modelno"]+'</option> ';
		                   newoption+= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["material"]+'</option> ';
		
                        
                        }                       
                     	$('#material').append(newoption);
 
                    }
                })
                
     }
</script>
<script>
    
    function modelnos() {
//alert("hello");

var material=document.getElementById("material").value;
//alert(productname);
$.ajax({
                    
                    type:'POST',
                    url:'materialmodel.php',
                     data:'material='+material,
                     datatype:'json',
                    success:function(msg){
                        //alert(msg);
                       var jsr=JSON.parse(msg);
                       //alert(jsr.length);
                        var newoption=' <option value="">Select</option>' ;
                        $('#modelno').empty();
                        
                        for(var i=0;i<jsr.length;i++)
                        {
                         
                       
                      //var newoption= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["modelno"]+'</option> ';
		                   newoption+= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["modelno"]+'</option> ';
		
                        
                        }                       
                     	$('#modelno').append(newoption);
 
                    }
                })
                
            }
            
            
           
</script>
<script>
/*function quntity()
{
 var selchbox1 = [];  
var inputfields1 = document.getElementsByName("srno");
//alert(inputfields1.length);
for (var i = 0; i < inputfields1.length; i++)
{
 selchbox1.push(inputfields1[i].value);
}
var BatterySerialNo= selchbox1;

var BatteryS_No=  explode(',', $BatterySerialNo);
document.getElementById("demo").innerHTML = BatteryS_No.length;
}

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



*/
/*
var boolemail="";
 
function val()
{
  // var boolemail="";
    
var e = document.getElementById("vendorname");
var vendorname = e.options[e.selectedIndex].text;

var e1 = document.getElementById("material");
var material = e1.options[e1.selectedIndex].text;

var e2 = document.getElementById("modelno");
var modelno = e2.options[e2.selectedIndex].text;
  
    
var selchbox1 = [];
var inputfields1 = document.getElementsByName("srno[]");

for (var i = 0; i < inputfields1.length; i++)
{
 selchbox1.push(inputfields1[i].value);
 
}

var sr= selchbox1;

            
             $.ajax({
   type: 'POST',    
   url:'val.php',
   data:'sr='+sr+'&vendorname='+vendorname+'&material='+material+'&modelno='+modelno,
    async:false,
   success: function(msg){
      // alert(msg);
      if(msg==1){
        swal("allready exist");
        boolemail="0";
     }
    else{
        boolemail="1";
        }
         
    
     
} 
                 
   })
   
 if(boolemail==1){
           //  alert("anans--"+boolemail)
            return true;
         }else{
             return false;
         }
   
   
   
// return true;

}
*/
function finalval()
{
   
    if(validation() && val())
    {
       return true; 
       
    }
    else
    {
        
        return false; 
        
    }
    
   
}


</script>

<script>
   /* var clicks = 1;include
   
   
    function onClick() {
        clicks += 1;
       // document.getElementById("demo").innerHTML = clicks;
        document.getElementById("demo2").value = clicks;
    };
    </script>
    
   <script>
    var clicks;
    function onClick1() {
        clicks -= 1;
     
       // document.getElementById("demo").innerHTML = clicks;
        document.getElementById("demo2").value = clicks;
        
    };
   */ 
    
   
</script>
</head>
<body>
   
<?php include 'menu.php';?>
<h2 align="center">Add Inventory Excel</h2>

<div class="container" style="margin-left:0px;">
<form id="myname" method="post" action="bulk_inventory_process.php" enctype="multipart/form-data" onSubmit="return validation(this)" name="form">
    <!--<form action="process_qrtsite_excel.php" method="post" enctype="multipart/form-data" onSubmit="return validate(this)" name="form">-->
<table  style="width:80%" align="center";>
    <tr>
        <!--<td>COMPANY NAME</td> -->
    <td>VENDOR NAME</td>
    <td>Material</td>
    <td>Model No.</td>
    <td>QTY</td>
    
    </tr>
	<tr>
	        <!--<tr><td> <select name="companyname" id="companyname" style="width: 120px;">
     <option value="">Select</option>
    <?php 
         $qry="select * from company";
         //echo $qry;
         $result=mysqli_query($conn,$qry);
         while($row = mysqli_fetch_row($result))
	   {  ?>
		<option value="<?php echo $row[1];?>"/><?php echo $row[1]; ?></option>
               <br/>
      <?php } ?>
   
</select>
</td>-->

<td> <select name="vendorname" id="vendorname"  style="width: 200px;" onchange="abc()">
     <option value="">Select</option>
    <?php 
         $qry="select * from vendor";
        
         $result=mysqli_query($conn,$qry);
         while($row = mysqli_fetch_row($result))
	   {  ?>
		<option value="<?php echo $row[0];?>"/><?php echo $row[1]; ?></option>
               <br/>
      <?php } ?>
   
</select>
		
</td>

<td> <select name="material" id="material" onchange="modelnos()" style="width:200px;"  >
     <option value="">Select</option>
    
   
</select>

</td>
 <td> <select name="modelno" id="modelno" style="width: 200px;">
     <option value="">Select</option>
   
   
</select>
</td>
<td><input type="text" id="qty" name="qty"/></td>

  </tr>
   
   
 
   
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
