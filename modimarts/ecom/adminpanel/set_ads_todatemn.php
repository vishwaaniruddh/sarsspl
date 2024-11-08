<?php
session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
/*	if(!isset($_SESSION['SESS_USER_NAME']) || (trim($_SESSION['SESS_USER_NAME']) == '')) 
	{
		header("location: access-denied.php");
		exit();
	}*/
?>
<?php 
//	ini_set( "display_errors", 0);

include('config.php');

include('header.php'); 

	
?>

<style>
/*---Paging specific styling----*/     
	.paging { padding:10px 0px 0px 0px; text-align:center; font-size:13px;}
	.paging.display{text-align:right;}
	.paging a, .paging span {padding:2px 8px 2px 8px; font-weight :normal}
	.paging span {font-weight:bold; color:#000; font-size:13px; }
	.paging a, .paging a:visited {color:#000; text-decoration:none; border:1px solid #dddddd;}
	.paging a:hover { text-decoration:none; background-color:#6C6C6C; color:#fff; border-color:#000;}
	.paging span.prn { font-size:13px; font-weight:normal; color:#aaa; }
	.paging a.prn, .paging a.prn:visited { border:2px solid #dddddd;}
	.paging a.prn:hover { border-color:#000;}
	.paging p#total_count{color:#aaa; font-size:12px; font-weight: normal; padding-left:18px;}
	.paging p#total_display{color:#aaa; font-size:12px; padding-top:10px;}
</style>
<script>


function setdtfunc(sts)
{
  
     var rdate= document.getElementById('rdate').value;

  //alert(noupdt);
  $.ajax({
   type: 'POST',    
url:'adstodaydate_process.php',
data:'fromdt='+rdate+'&st='+sts,

success: function(msg){
    
    
   //alert(msg);
  
      if(msg==1)
      {
          
          alert("successful");
    window.location.reload(true);
      }
      else
      {
          
          alert("error");
      }
  }
         
     });  
    
}





</script>
<body> 
<form action="" method="POST">
    <input type="hidden" id="noupdt" name="noupdt">
<!-- Start: page-top-outer --><!-- End: page-top-outer -->
	
<div class="clear">&nbsp;</div>
<div class="clear"></div>
 
<!-- start content-outer ........................................................................................................................START -->
<div id="content-outer">
<!-- start content -->
<div id="content">

	<!--  start page-heading -->
	<div id="page-heading">
		<h1></h1>
	</div>
	
	<div id="mn">
	<!-- end page-heading -->
	<table align="center" width="50%">
  <tr> 
  
       <?php
session_start();
include('config.php');
//include('access.php');
$qr=mysql_query("select dt from todays_date");
$dtt="";
if($nr=mysql_num_rows($qr)>0)
{
    $fr=mysql_fetch_array($qr);

if($fr[0]!="0000-00-00")
{

  $dtt=date("d-m-Y",strtotime($fr[0]));  
}
}

?>
       <td>
             From Date <input type="text" name="rdate" id="rdate"  class="inp-form" placeholder="from date" value="<?php echo $dtt;?>"/></td>
         
                <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="datepc/dcalendar.picker.js"></script>
<script>
$('#rdate').dcalendarpicker({format: 'dd-mm-yyyy'});

</script>
	<td><input type="button"  name="search" value="Save" onclick="setdtfunc(1);"/><input type="button"  name="search" value="Clear" onclick="setdtfunc(0);"/></td></tr>
	</table>
</div>

<div id="shw">
    
    
    
    </div>

	<div class="clear">&nbsp;</div>

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer........................................................END -->

<div class="clear">&nbsp;</div>
    
<!-- start footer -->         
<div id="footer">
	
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
 </form>
</body>
</html>