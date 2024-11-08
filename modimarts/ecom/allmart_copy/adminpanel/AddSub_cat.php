<?php
session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_USER_NAME']) || (trim($_SESSION['SESS_USER_NAME']) == '')) 
	{
		header("location: access-denied.php");
		exit();
	}
include('header.php');
include('config.php');
             $qry="select id from main_cat limit 10";
               $result=mysql_query($qry);  
               $totrwsc=mysql_num_rows($result);

?>
<style>
.btn {
  display: inline-block;
  padding: 10px 20px;
  font-size: 12px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color: #4CAF50;
  border: none;
  border-radius: 15px;
  
}

.btn:hover {background-color: #3e8e41}

.btn:active {
  background-color: #3e8e41;
  
  transform: translateY(4px);
}


</style>
<script>
function getcat()
{
    
    try
    {
      
     //  var ttrowshown=0; 
       //var ttrows='<?php echo $totrwsc;?>'; 
       
       var radioValue = $("input[name='chk[]']:checked"). val();
       
       alert(radioValue);
     //  $('[name=chk[]]')
     
     /*
       $.ajax(
           
				{
					type:'POST',    
					url:'processCreateCat.php',
					data:'',
					success: function(msg)
					{
					 alert(msg);
					 document.getElementById("shct").innerHTML=msg;
					
					 }
					    
								});

    */
        
    }catch(ex)
    {
        alert(ex);
    }
}

</script>


<!-- start content-outer -->
<div id="content-outer" >
<!-- start content -->
<div id="content" >


<div id="page-heading">
  <h1 align="center">Add Category</h1></div>


<table border="0" width="100%"   cellpadding="0" cellspacing="0" id="content-table">
<tr>
	<th rowspan="3" class="sized"><img src="images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
	<th class="topleft"></th>
	<td id="tbl-border-top">&nbsp;</td>
	<th class="topright"></th>
	<th rowspan="3" class="sized"><img src="images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
</tr>
<tr>
	<td id="tbl-border-left"></td>
	<td>
	<!--  start content-table-inner -->
	<div id="content-table-inner" style="padding-left:300px">
	
	<table border="0" width="60%"  align="center"  cellpadding="0" cellspacing="0" id="id-form">
	
	<tr valign="top">
	<td>
<form action='processCreateCat.php' method='post'>
<table align="center"   border="0" width="100%" id="id-form">


<tr height=''>    

<td align='left' width='100%'>Select Category</td>
   <td width='100%'>


<div id="shct">
    
    </div>

<script>
getcat();
</script>
           </td>
	<td><div id="sh"></div></td>
	
	</tr>
<tr height='30'>

<td align='center'>Category Name</td>

<td><input name='cname' id='cname' size='50' type='text' class="inp-form" required focus/></td></tr>

<tr height='30' style="display:none">

<td align='center' >Keywords</td>

<td><input name='add1' id='add1' size='50' type='text' class="inp-form" /></td></tr>

<tr>

<td colspan='2' align='center'><input value='Submit' class="btn"  type='button'  onclick="getcat();"/>
<button type="button" class="btn" onclick="window.open('sub_cat.php','_self');">Back</button></td></tr>

 </table></form>

<div class="clear"></div>
 

</div>
<!--  end content-table-inner  -->
</td>
<td id="tbl-border-right"></td>
</tr>
<tr>
	<th class="sized bottomleft"></th>
	<td id="tbl-border-bottom">&nbsp;</td>
	<th class="sized bottomright"></th>
</tr>
</table>

<div class="clear">&nbsp;</div>

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer -->

 

<div class="clear">&nbsp;</div>
    
<!-- start footer -->         
<div id="footer">
	<!--  start footer-left -
	<div id="footer-left">
	Admin Skin &copy; Copyright 1clickGuide. <a href="">www.1ClickGuide.org</a>. All rights reserved.</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
<script>

function shw(id)
{
     $('[name='+id+']').show();
   // $('[name=when_is_escrow_set_to_close]').hide();
   // document.getElementById(id).style.display="block";
}

</script>
 