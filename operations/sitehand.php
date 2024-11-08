<?php
include("access.php");
 //echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation']." ".$_SESSION['dept'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script src="js/opener.js" type="text/javascript"></script>
<script src="excel.js" type="text/javascript"></script>
<script src="js/ajaxfileupload.js" type="text/javascript"></script>
<script type="text/javascript"></script>

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
              // var panelid=document.getElementById("panelid").value;
          // alert(panelid);
              // var DVRIP=document.getElementById("DVRIP").value;
         //alert(DVRIP);
            //var compy=document.getElementById("compy").value;
            //alert(compy);
            // var ATMID=document.getElementById("ATMID").value;
            //alert(ATMID);
             // var fdate=document.getElementById("fdate").value;
             // alert(fdate);
             // var tdate=document.getElementById("tdate").value;
			  //alert(tdate);
             perp='700';

var Page="";
if(strPage!="")
{
Page=strPage;
}
   $('#loadingmessage').show();  // show the loading message.

              
             $.ajax({
               
            type:'POST',    
   url:'viewsitehand_process.php',
   data:'Page='+Page+'&perpg='+perp,


   success: function(msg){
    //alert(msg);
   $('#loadingmessage').hide(); // hide the loading message
   document.getElementById("show").innerHTML=msg;
   

   
} })
            }
        </script>
</head>

<body onload="a('','')">

<center>
<?php //include("menubar.php");?>

<h2 class="h2color">site Status</h2>
<!--<table  border="0" cellpadding="0" cellspacing="0">
<tr>

</tr>
<tr>
<td> panel id :<input type="text" name="panelid" id="panelid"  ></td>
<td> DVRIP:<input type="text" name="DVRIP" id="DVRIP" ></td>
<td> Bank:<select id="compy" name="compy" >                      
 
  
    <?php
  include ('config.php');
      $sql="select name from customer";
      $runsql=mysqli_query($conn,$sql);
      ?> 
      <option value="">select</option><?
    while($datas=mysqli_fetch_array($runsql)){
      ?>
      
 <option value="<?php echo $datas[0];?>"><?php echo $datas[0];?></option>
<?php }?>

</select></td>
<td> ATMID:<input type="text" name="ATMID" id="ATMID"  ></td>
<th width="75"><input type="text" name="fdate" id="fdate" onclick="displayDatePicker('fdate');" placeholder="From Date"/></th>
<th width="75"><input type="text" name="tdate" id="tdate" onclick="displayDatePicker('tdate');" placeholder="To Date"/></th>

        <td><input type="button" name="submit" onclick="a('','')"value="search"></button></td>
		<input type="button" onclick="tableToExcel('show', 'W3C Example Table')" value="Export to Excel" style="float: right;height:30px;background-color: #67efb0;" >




<button onclick="myFunction()" style="float: right;height:30px;background-color: #67efb0;" style="margin-top:50px;" >Print this page</button>
</tr>
</table>-->
            </div>
            	<!--============== code for loader (Start)===================-->

			<div id='loadingmessage' style='display:none;' >
                <img src='img/loading.gif' style="position:center;left:50%;margin-left:550px; "/>
            </div>
          <!--============== code for loader (End) =====================-->
            
            
            <div id="show"></div>
            
			
			<div><input type="button" onclick="tableToExcel('show', 'W3C Example Table')" value="Export to Excel" style="float: left;height:30px;background-color: #67efb0;">
			<button onclick="myFunction()" style="float: left;height:30px;background-color: #67efb0;" >Print this page</button>
</div>
			
               



<script>
function myFunction() {
    window.print();
}
</script>

<div id="search" align="left"></div>

			
			  
        </body>
    
</html>




