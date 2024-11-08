<?php
session_start();
if(!$_SESSION['user'])
header('location:index.php');
//echo $_SESSION['user'];
//$desig=$_POST['desig'];
//$service=$_POST['service'];
//$dept=$_POST['dept'];
//$app=$_POST['apps'];
//echo count($app);
include('config.php');

?><html><head><title>Paid Ebill Fund</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<!--datepicker-->

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script>

function tableToExcel(table, name)
{
    try
    {
    //alert("ok");
    var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
 
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
    }catch(ex)
    {
        alert(ex);
    }
 
}

function func(strpg,perpg)
{
//alert("ok");
var reqid=document.getElementById('reqid').value;
if(reqid!="")
{
if(perpg=="")
{
perp='50';
}
else
{
perp=document.getElementById(perpg).value;
}



var Page="";
if(strpg!="")
{
Page=strpg;
}


$.ajax({
   type: 'POST',    
url:'getreqiddets.php',
 beforeSend: function()
                   {
        
                  document.getElementById("show").innerHTML ="<center><img src=loader.gif></center>";
                  },
data:'reqid='+reqid,
data:'perpg='+perp+'&Page='+Page+'&reqid='+reqid,
success: function(msg){
//alert(msg);
  document.getElementById('show').innerHTML=msg;

 
         }
     });


}


}






function updtfn(btnid,reqno,srno)
{
  try
  {
   
    var sv=document.getElementById("sv"+srno).value;
     var supvorg=document.getElementById("supvorg"+srno).value;
    $.ajax({
   type: 'POST',    
url:'updtnewtransferto.php',
 beforeSend: function()
                   {
        
                  document.getElementById(btnid).disabled =true;
                  },
data:'reqno='+reqno+'&sv='+sv+'&supvorg='+supvorg,
success: function(msg){
alert(msg);
if(msg==1)
{
    alert("Updated");
}
else if(msg==2)
{
    alert("Your session has been expired");
    window.open("logout.php","_self");
}
else
{
    alert("Error");
}
  document.getElementById(btnid).disabled =false;
         }
     });
}catch(xc)
{
    alert(xc);
}
    
}


</script>
        <script type="text/javascript">
			function pop(div) {
			    alert("ok");
				document.getElementById(div).style.display = 'block';
			}
			function hide(div) {
				document.getElementById(div).style.display = 'none';
			}
			//To detect escape button
			document.onkeydown = function(evt) {
				evt = evt || window.event;
				if (evt.keyCode == 27) {
					hide('popDiv');
				}
			};
		</script>



</head>
<body >
<center>
<?php include("menubar.php"); ?>
</center>
<form name="frm1" method="post" action="">
  <input type="text" name='reqid' id="reqid"/><button type="button" id="myButtonControlID" onClick="func('','');">Search</button>
</form>
<div id="show">

</div>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script></body></html>