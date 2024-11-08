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
function chkfunc()
{
    var rdate= document.getElementById('rdate').value;
    var tdate= document.getElementById('tdate').value;
    var ratepersec= document.getElementById('ratepersec').value;
    // alert("abc");
    if(ratepersec=="")
    {
        alert("Enter Rate");
    } else if(rdate=="")
    {
        alert("Select From Date");
    }
    else if(tdate=="")
    {
        alert("Select  To Date");
    } else
    {
        var abc=confirm(" Are you sure Continue!!! ");
        if(abc)
        {
            $.ajax({
                type: 'POST',    
                url:'slot_set_process_check.php',
                data:'fromdt='+rdate+'&todt='+tdate,
                success: function(msg){
                    var jsr=JSON.parse(msg);
                    //alert(msg);
                    if(jsr["sts"]=="1")
                    {
                        document.getElementById("shw").innerHTML="";
                        document.getElementById("shw").style.display="none";
                        submfunc();
                    } else {
                        document.getElementById("mn").style.display="none";
                        document.getElementById("noupdt").value=jsr["dts"];
                        // alert(jsr["dts"]);
                        var expl=jsr["dts"].split(',');
     
                        var str="Ads has been scheduled for the following dates..if you wish to continue slot will be set for remaining dates";
                        for(var a=0;a<expl.length;a++)
                        {
                            str=str+"</br>"+expl[a];
                        }
                        str=str+"</br>"+'<button type="button" onclick="submfunc()">Continue</button>&nbsp;&nbsp;&nbsp;<button type="button" onclick="cancfunc();">Cancel</button>';
                        document.getElementById("shw").innerHTML=str;
                        document.getElementById("shw").style.display="block";
                    }
                }
            });
        }
    }
}
function cancfunc()
{
    document.getElementById("shw").innerHTML="";
    document.getElementById("shw").style.display="none";
    document.getElementById("noupdt").value="";
    document.getElementById("mn").style.display="block";
}
function submfunc()
{
    var rdate= document.getElementById('rdate').value;
    var tdate= document.getElementById('tdate').value;
    var noupdt= document.getElementById('noupdt').value;
    var ratepersec= document.getElementById('ratepersec').value;
    //alert(noupdt);
    $.ajax({
        type: 'POST',    
        url:'slot_set_process.php',
        data:'fromdt='+rdate+'&todt='+tdate+'&noupdt='+noupdt+'&ratepersec='+ratepersec,
        success: function(msg){
         alert(msg);
        var jsr=JSON.parse(msg);

  if(jsr["sts"]=="1")
  {
      
      alert("successful");
      
  }else
  {
      
      alert("Error");
  }
     
     window.location.reload();
     
      
      
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
   <td>
       
       <td>
        Rate Per Second
        <input type="text" name="ratepersec" id="ratepersec" class="inp-form" placeholder="Rate Per Second"/>
        </td>
       <td>
             From Date <input type="text" name="rdate" id="rdate"  class="inp-form" placeholder="from date"/></td>
         <td>
             To Date<input type="text" name="tdate" id="tdate"  class="inp-form" placeholder="to date"/></td>
                <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="datepc/dcalendar.picker.js"></script>
<script>
$('#rdate').dcalendarpicker({format: 'dd-mm-yyyy'});
$('#tdate').dcalendarpicker({format: 'dd-mm-yyyy'});



$('#ratepersec').on('input', function () {
        this.value = this.value.match(/^\d+\.?\d{0,2}/);
    });
</script>
	<td><input type="button" class="form-submit" name="search" value="Save" onclick="chkfunc();"/></td></tr>
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