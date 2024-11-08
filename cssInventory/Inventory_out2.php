<?php
session_start();
//if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
//{


?>
<html>
<head>
<title>Add Inventory</title>
<?php include ('header.php');
include ('config.php');

?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



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
        
        function efg(){
   //  alert("bahut marunga");
 }
 
 function val(count)
{
  
var sr= document.getElementById("srno"+count).value;
 
/*var selchbox1 = [];
var inputfields1 = document.getElementsByName("srno[]");
for (var i = 0; i < inputfields1.length; i++)
{
 selchbox1.push(inputfields1[i].value);
 
}

var sr= selchbox1;
//alert(sr);
*/
  $.ajax({
   type: 'POST',   
   url:'autofield.php',
   data:'sr='+sr,

   success: function(msg){
     //  alert(msg);
     if(msg!='2'){
     
     
       var json=$.parseJSON(msg);
       for(var i=0;i<json.length;i++)
       {
        
        // Material Model Handover City po officeteam
        document.getElementById("Vendor"+count).value=json[i].vendorname;
        document.getElementById("Material"+count).value=json[i].material;
        document.getElementById("Model"+count).value=json[i].modelno;
        
      
         
       }
     }else
     {
         swal("Please Enter New SrNo.");
         
     }
     
     
       
     }})
}




</script>

<script>
function validation()
{ 
    var srno= document.getElementsByName('srno[]');
  var vendorname= document.getElementsByName('Vendor[]');
  var material = document.getElementsByName('Material[]');
  var modelno= document.getElementsByName('Model[]');
  var Handoverr= document.getElementsByName('Handoverr[]');
  var City= document.getElementsByName('City[]');

 
    var b="";
 //alert(srno.length)

 
      for (var i=0; i<srno.length; i++)
       {       
        if (srno[i].value=="")
        {
        swal("Please Fillup sr no");
        srno[i].focus();
          
        b="false";
        break;
        }
         else if (vendorname[i].value=="")
        {
        swal("Please Fillup vendor name");
        vendorname[i].focus();
       // return false;
        b="false";
         break;
        }
       else if (material[i].value=="")
        {
        swal("Please Fillup Material Name");
        material[i].focus();
       //return false;   
        b="false";
         break;
        }
        else if(Handoverr[i].value =="")
        {
         swal("Please Fillup Handover Name");
         Handoverr[i].focus();
        // return false; 
         b="false";
         break;
            
        }
      
        else if(City[i].value =="")
        {
         swal("Please Fillup City");
         City[i].focus();
         //return false; 
          b="false";
           break;
        }
        else if (modelno[i].value=="")
        {
        swal("Please Fillup Model No");
        modelno[i].focus();
        //return false;
        b="false";
         break;
        }
        
      
       }
    
 
       //  var res = doConfirm();
         // b=res;
      
        
 
  if(b == "false"){
     return false;
  }
  else
  { 
     return true;
  }

     
}

function doConfirm() {
    var ok = confirm("Are you sure to Save ?");
    if (ok) {
      
       return "true";
      
    }
    else{
       
         return "false";
    }
    
    
    
    
 /* var c=""; 
    event.preventDefault();
    var form = document.forms["myForm"]; // storing the form
    
   
  
   
    
      swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this imaginary file!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
       
   swal("Poof! Your imaginary file has been deleted!", {
      icon: "success",
    });
  
    alert("hi")
    c="true";
 
   
  } else {
    swal("Your imaginary file is safe!");
    c="false";
    

   
  }
  
 
  
});

 alert(c+"bavin")
 */
 
     
 
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


var Material=document.getElementById("Material").value;

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
  /*  var clicks = 1;
    function onClick() {
        clicks += 1;
      //  document.getElementById("demo").value = clicks;
         document.getElementById("qty").value = clicks;
        document.getElementById("demo2").value = clicks;
    };*/
    </script>
    
   <script>
 /*   var clicks;
    function onClick1() {
        clicks -= 1;
      
       // document.getElementById("demo").value = clicks;
       document.getElementById("qty").value = clicks;
        document.getElementById("demo2").value = clicks;
        
    };*/
  function Handover(count){
    
  var id= document.getElementById("Handover"+count).value;

  $.ajax({
   type: 'POST',   
   url:'autofieldHandover.php',
   data:'id='+id,

   success: function(msg){
      // alert(msg);
     if(msg!='2'){
     
     
       var json=$.parseJSON(msg);
       for(var i=0;i<json.length;i++)
       {
        
        document.getElementById("City"+count).value=json[i].city;
        document.getElementById("address"+count).value=json[i].Address;
        document.getElementById("loc"+count).value=json[i].Location;
        
      
         
       }
     }else
     {
         swal("Please Select Handover Name.");
         
     }
     
     
       
     }})


  }
   
  function TypeHideShow(count){
    
   var  tp= document.getElementById("type"+count).value;
     
      if(tp=="New")
      {
        $('#Sitename'+count).hide();
       $('#ATM_ID'+count).hide();
      
      }
      else
      { $('#Sitename'+count).show();
       $('#ATM_ID'+count).show(); 
      }
       
   }
   
   
</script>

</head>
<body>
<?php include 'menu.php';?>
<h2 align="center">Inventory Out</h2>

<div class="container" style="margin-left:0px;">
<form  name="myForm" method="post" action="inventory_out_process.php" onsubmit="return validation();">

 <table id="myTable" style="width:100%" align="center">
     <tr> 
       <td>Sr.No.</td>
       
		<td>Vendor Name</td>
		<td>Material</td>
	    <td>Model No.</td>
	    
	   <td>Handover Person Name</td>
	   
	    <td>City</td>
	    <td>Location</td>
	    <td>Address</td>
	    <td>PO Number</td>
	   	
		<td>Type</td>
		
	    <td >Site Name</td>
	    <td >ATM ID</td>
	    <td>Qty</td>
     </tr>
     <tr>
    <td><input type="text" name="srno[]" id="srno1" style="width:150px;" onblur="val('1');"></td>
     
    <td><input type="text" name="Vendor[]" id="Vendor1" style="width: 120px;border:none" readonly></td>
    <td><input type="text" name="Material[]" id="Material1" style="width: 120px;border:none" readonly></td>
    <td><input type="text" name="Model[]" id="Model1" style="width: 120px;border:none" readonly></td>
   <!--<td><input type="text" name="Handoverr[]" id="Handover1" style="width:120px;"></td>-->
   
   <td> <select name="Handoverr[]" id="Handover1" onchange="Handover('1')" style="width: 100px;">
     <option value="">Select</option>
    <?php 
        $qry="select * from team where team='2'";
        
         $result=mysqli_query($conn,$qry);
         while($row = mysqli_fetch_row($result))
	   {  ?>
		<option value="<?php echo $row[1];?>"/><?php echo $row[1]; ?></option>
               
      <?php } ?>
   
</select>
</td>
   
   
   <input type="hidden" name="demo2[]" id="demo2" />
   <!--<td><input type="text" name="qty" id="qty" style="width: 70px;"></td>-->
   <td><input type="text" name="City[]" id="City1" style="width: 120px;border:none" readonly></td>
    <td><input type="text" name="loc[]" id="loc1" style="width: 120px;border:none" readonly></td>
    <td><input type="text" name="address[]" id="address1" style="width: 120px;border:none" readonly></td>
 
    
    
    
    <td><input type="text" name="po[]" id="po1" style="width: 120px;"></td>
    
    
  
    <td><select name="type[]" id="type1"  onchange="TypeHideShow(1)">
        <option value="">Select</option>
        <option value="New">New</option>
        <option value="Replace">Replace</option>
        </select></td>
 
    <td ><input type="text" name="Sitename[]" id="Sitename1" style="width: 120px;"></td> 
    <td ><input type="text" name="ATM_ID[]" id="ATM_ID1" style="width: 120px;"></td> 
    <td id="demo"><input type="text" name="qty[]" id="qty1" value="1" style="width: 120px;" readonly></td>
 </table>
<br>
<div align="center">
    <tr>
	   <input type="submit" name="submit" value="submit" class="btnRegister" />
		<input  type="button" onclick="myCreateFunction()" value="Add row"/>
		<input type="button" onclick="myDeleteFunction()" value="Delete row"/>
		</tr>
		</div>
		</form>
		


		
<script>

function myCreateFunction() {
    var table = document.getElementById("myTable");
    var count = $('#myTable tr').length;
  
     var row = table.insertRow(-1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    var cell7 = row.insertCell(6);
    var cell8 = row.insertCell(7);
    var cell9 = row.insertCell(8);
    var cell10 = row.insertCell(9);
    var cell11 = row.insertCell(10);
     var cell12 = row.insertCell(11);
      var cell13 = row.insertCell(12);
    
   cell1.innerHTML = '<input type="text" name="srno[]" id="srno'+count +'" onblur="val('+count +')" style="width: 150px;">';
   cell2.innerHTML = '<input type="text" name="Vendor[]" id="Vendor'+count +'" style="width: 120px;" readonly>';
   cell3.innerHTML = '<input type="text" name="Material[]" id="Material'+count +'" style="width: 120px;" readonly>';
   cell4.innerHTML = '<input type="text" name="Model[]" id="Model'+count +'" style="width: 120px;" readonly>';
 
   cell5.innerHTML =  "<select name='Handoverr[]' id='Handover"+count +"' onchange='Handover("+count+")' style='width: 100px;'> <option value=' '>Select</option><?php 
       $qry='select * from team where team="2" ';
         $result=mysqli_query($conn,$qry);
         while($row=mysqli_fetch_row($result))
	   {  ?>
		<option value='<?php echo $row[1];?>'/><?php echo $row[1]; ?></option><br/> <?php  } ?> </select>";
		
		
  
   cell6.innerHTML = '<td><input type="text" name="City[]" id="City'+count +'" style="width: 120px;" readonly>';
   cell7.innerHTML ='<input type="text" name="loc[]" id="loc'+count +'" style="width: 120px;" readonly>';
   cell8.innerHTML ='<input type="text" name="address[]" id="address'+count +'" style="width: 120px;" readonly>';
   cell9.innerHTML = '<input type="text" name="po[]" id="po'+count +'" style="width: 120px;">';
  
		
/*cell10.innerHTML ='<input type="text" name="Install[]" id="Install'+count +'" style="width: 120px;">';*/
	
	cell10.innerHTML ="<select  name='type[]' id='type"+count +"' onchange='TypeHideShow("+count+")'><option value=''>Select</option><option value='New'>New</option><option value='Replace'>Replace</option></select>";
	
		cell11.innerHTML ='<input type="text" name="Sitename[]" id="Sitename'+count+'" style="width: 120px;">';
		cell12.innerHTML ='<input type="text" name="ATM_ID[]" id="ATM_ID'+count+'" style="width: 120px;">';
	
 		cell13.innerHTML ='<input type="text" name="qty[]" id="qty'+count +'" value="1" style="width: 120px;">';
 
 
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
//}else
{ 
 //header("location: login.php");
}
?>
