<?php
include("access.php");
include("config.php");

if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry, your session has Expired'); window.location='index.php';</script>";
}


$qry=mysqli_query($con,"select * from  quotation1ftransfers_tis where tid='".$_GET['tid']."'");

$tid=$_GET['tid'];

?>


<html>
<head>
<title>CSS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>

<script type="text/javascript" src="script.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>


<script type="text/javascript">


function func()
{
var td=document.getElementById('tdate').value;
var chn=document.getElementById('chname').value;
var chno=document.getElementById('chno').value;
var tid=document.getElementById('tid').value;
//alert("hello");
$.ajax({
   type: 'POST',    
url:'process_cmsentry_tis.php',
 beforeSend: function()
                   {
        
                  document.getElementById("tab").innerHTML ="<center>Processing request</center>";
                  },
data:'td='+td+'&chn='+chn+'&chno='+chno+'&tid='+tid,
success: function(msg){

alert(msg);
window.open('view_quotrans_tis.php','_self')
  //document.getElementById('search').innerHTML=msg;
         }
     });


}

</script>

</head>
<body >
<center>
<?php  include("menubar.php"); ?>
<h2 class="h2color">RNM FUND REQUESTS </h2>
</center>
<br>
<br>
<br>
<center>
<input type="hidden" name="tid" id="tid" value="<?php echo $tid;?>">
<table cellspacing="4" cellpaddind="5" border="2" id="tab">

<tr>
<td>Transfer Date</td><td><input type="text" name="tdate" id="tdate" onclick="displayDatePicker('tdate')" ></td>
</tr>
<tr>
<td>Cheque Name</td><td><input type="text" name="chname" id="chname" /></td>
</tr>
<tr>
<td>Cheque Number</td><td><input type="text" name="chno" id="chno" /></td>
</tr>

<tr>
<td colspan="2" align="center"><input type="button" name="sub" id="sub" value="Submit" onclick="func();">
<input type="button" name="bck" id="bck" value="Back" onclick="window.open('view_quotrans_tis.php','_self');"></td>
</tr>
</table>
</center>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>

</html>

