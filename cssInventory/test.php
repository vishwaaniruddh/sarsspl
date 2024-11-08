<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
?>
<html>

    <head>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

 <script type="text/javascript">
var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script>

	
	
	
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
       
        <script>
        
            function a(strPage,perpg){
               var Zone1=document.getElementById("Zone").value;
           // alert(bid);
               var DVRIP=document.getElementById("DVRIP").value;
           // alert(bname);
            var atmid=document.getElementById("atmid").value;
             var DVRName=document.getElementById("DVRName").value;
            // alert(subject);
              var ATMShortName=document.getElementById("ATMShortName").value;
             // alert(serial_number);
             
             perp='700';

var Page="";
if(strPage!="")
{
Page=strPage;
}
   $('#loadingmessage').show();  // show the loading message.

              
             $.ajax({
               
            type:'POST',    
   url:'viewsite_process.php',
   data:'Zone2='+Zone1+'&DVRIP='+DVRIP+'&atmid='+atmid+'&DVRName='+DVRName+'&ATMShortName='+ATMShortName+'&Page='+Page+'&perpg='+perp,


   success: function(msg){
    
   $('#loadingmessage').hide(); // hide the loading message
   document.getElementById("show").innerHTML=msg;
   

   
} })
            }
        </script>
        
        
</head>
      &nbsp;&nbsp;&nbsp;
        <body onload="a('','')" style="background-color: #dce079">
		       <?php include 'menu.php';?>

            <div>
			<center><h1 style="margin-top:70px; color:#fff;"  ><b> View Site</b></h1></center>
			
		

      <table border="1" style="margin-top:40px; width:90%; " align="center" >          
               
<tr style="background-color:#8cb77e">
<td> Zone:<input type="text" name="Zone" id="Zone" ></td>
<td> DVRIP:<input type="text" name="DVRIP" id="DVRIP" ></td>
<td> ATM ID:<input type="text" name="atmid" id="atmid" ></td>
<td> DVRName:<input type="text" name="DVRName" id="DVRName" ></td>
<td> ATMShortName:<input type="text" name="ATMShortName" id="ATMShortName" ></td>
            
        <td><input type="button" name="submit" onclick="a('','')"value="search"></button></td>
		<input type="button" onclick="tableToExcel('show', 'W3C Example Table')" value="Export to Excel" style="float: right;" >




<button onclick="myFunction()" style="float: right;" style="margin-top:50px" >Print this page</button>
</tr>
</table>
            </div>
            	<!--============== code for loader (Start) =====================-->

			<div id='loadingmessage' style='display:none;' >
                <img src='img/loading.gif' style="position:center;left:50%;margin-left:550px; "/>
            </div>
          <!--============== code for loader (End) =====================-->
            
            <div id="show"></div>
            
			
			<div><input type="button" onclick="tableToExcel('show', 'W3C Example Table')" value="Export to Excel" style="float: left;">
			<button onclick="myFunction()" style="float: left;" >Print this page</button>
</div>
			
               
<!--<input type="button" name="csv"  placeholder="csv formate" value ="csv formate" onclick="csv()">-->


<script>
function myFunction() {
    window.print();
}
</script>


</div>

</div>
			
			  
        </body>
    
</html>


<?php
}else
{ 
 header("location: index.php");
}
?>





