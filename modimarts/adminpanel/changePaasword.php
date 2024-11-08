<?php
session_start();
	include('config.php');
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_USER_NAME']) || (trim($_SESSION['SESS_USER_NAME']) == '')) 
	{
		header("location: access-denied.php");
		exit();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Admin Panel</title>
<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
<!--[if IE]>
<link rel="stylesheet" media="all" type="text/css" href="css/pro_dropline_ie.css" />
<![endif]-->

<!--  jquery core -->
<script src="js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>

<!--  checkbox styling script -->
<script src="js/jquery/ui.core.js" type="text/javascript"></script>
<script src="js/jquery/ui.checkbox.js" type="text/javascript"></script>
<script src="js/jquery/jquery.bind.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
	$('input').checkBox();
	$('#toggle-all').click(function(){
 	$('#toggle-all').toggleClass('toggle-checked');
	$('#mainform input[type=checkbox]').checkBox('toggle');
	return false;
	});
});
</script>  

<![if !IE 7]>

<!--  styled select box script version 1 -->
<script src="js/jquery/jquery.selectbox-0.5.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.styledselect').selectbox({ inputClass: "selectbox_styled" });
});
</script>
 

<![endif]>

<!--  styled select box script version 2 --> 
<script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.styledselect_form_1').selectbox({ inputClass: "styledselect_form_1" });
	$('.styledselect_form_2').selectbox({ inputClass: "styledselect_form_2" });
});
</script>

<!--  styled select box script version 3 --> 
<script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.styledselect_pages').selectbox({ inputClass: "styledselect_pages" });
});
</script>

<!--  styled file upload script --> 
<script src="js/jquery/jquery.filestyle.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
  $(function() {
      $("input.file_1").filestyle({ 
          image: "images/forms/choose-file.gif",
          imageheight : 21,
          imagewidth : 78,
          width : 310
      });
  });
</script>

<!-- Custom jquery scripts -->
<script src="js/jquery/custom_jquery.js" type="text/javascript"></script>
 
<!-- Tooltips -->
<script src="js/jquery/jquery.tooltip.js" type="text/javascript"></script>
<script src="js/jquery/jquery.dimensions.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	$('a.info-tooltip ').tooltip({
		track: true,
		delay: 0,
		fixPNG: true, 
		showURL: false,
		showBody: " - ",
		top: -35,
		left: 5
	});
});
</script> 


<!--  date picker script -->
<link rel="stylesheet" href="css/datePicker.css" type="text/css" />
<script src="js/jquery/date.js" type="text/javascript"></script>
<script src="js/jquery/jquery.datePicker.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
        $(function()
{

// initialise the "Select date" link
$('#date-pick')
	.datePicker(
		// associate the link with a date picker
		{
			createButton:false,
			startDate:'01/01/2005',
			endDate:'31/12/2020'
		}
	).bind(
		// when the link is clicked display the date picker
		'click',
		function()
		{
			updateSelects($(this).dpGetSelected()[0]);
			$(this).dpDisplay();
			return false;
		}
	).bind(
		// when a date is selected update the SELECTs
		'dateSelected',
		function(e, selectedDate, $td, state)
		{
			updateSelects(selectedDate);
		}
	).bind(
		'dpClosed',
		function(e, selected)
		{
			updateSelects(selected[0]);
		}
	);
	
var updateSelects = function (selectedDate)
{
	var selectedDate = new Date(selectedDate);
	$('#d option[value=' + selectedDate.getDate() + ']').attr('selected', 'selected');
	$('#m option[value=' + (selectedDate.getMonth()+1) + ']').attr('selected', 'selected');
	$('#y option[value=' + (selectedDate.getFullYear()) + ']').attr('selected', 'selected');
}
// listen for when the selects are changed and update the picker
$('#d, #m, #y')
	.bind(
		'change',
		function()
		{
			var d = new Date(
						$('#y').val(),
						$('#m').val()-1,
						$('#d').val()
					);
			$('#date-pick').dpSetSelected(d.asString());
		}
	);

// default the position of the selects to today
var today = new Date();
updateSelects(today.getTime());

// and update the datePicker to reflect it...
$('#d').trigger('change');
});
</script>

<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
<script src="js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
$(document).pngFix( );
});
</script>

 <script>
                     function validation(){
                         	 var oldpass=document.getElementById('passwd').value;
                         	
                         var cpass=document.getElementById('cpasswd').value;
                         
                         var nwpass=document.getElementById('npasswd').value;
                         
                          //alert("test");
                        if(cpass=="" || nwpass=="" || oldpass==""){
                            
                             alert('All feilds are required!!');
                              return false;
                        }
                        
                         if(cpass!=nwpass){
                             alert('confirm password not matched!!');
                            return false;
                         }
                         return true;
                         
                     }
                     
                     
                     function changepass(){
                         try{
                         if(validation()){
                             
                          var cnfpass=document.getElementById('cpasswd').value;
                         var newpass=document.getElementById('npasswd').value;
                         var oldpass=document.getElementById('passwd').value;
                         if (confirm("Are you sure, you want to Change your password?")) {
                             
                             $.ajax({
             type: "POST",
             url: "process_updtpass.php",
			
             data: 'cnfpass='+cnfpass+'&newpass='+newpass+'&oldpass='+oldpass,
			
             success: function(msg){
              
            alert(msg);
			   if(msg==1)
			   {
				   
				  alert("Your Password has been sucessfully changed.");
				  window.open('admin.php','_self');
			   }else if(msg==5)
			   {
				   
				  alert("old Password is incorrect!!");
			   }
			   else
			   {
				   alert("Error! Please try again!!!");

				   
				   window.location.reload();
			   }
			   
			   //window.open('Enquiry_Details.php?id=<?php echo $enquiryid;?>','_self');
			   
             },
			 error: function (request, status, error) {
        alert(request.responseText);
    }
         });
                         }
                         	
                         }
                         }catch(e){
                             
                             alert(e);
                         }
                     }
                     
                 </script>
      
  
</head>
<body> 

<!-- End: page-top-outer -->
	
<div class="clear">&nbsp;</div>
 
<!--  start nav-outer-repeat................................................................................................. START -->
<?php include('header.php');?>
<!--  start nav-outer-repeat................................................... END -->

 <div class="clear"></div>
 
<!-- start content-outer ........................................................................................................................START -->
<div id="content-outer" align="center">
<!-- start content -->
<div id="content">

	<!--  start page-heading -->
	<div id="page-heading">
		<h1>Change password</h1>
	</div>
	<!-- end page-heading -->
<!--  start message-green -->
			
				<!--  end message-green -->
			<div id="loginbox">
	
	<!--  start login-inner -->
	<?php 
	
	$qry1=mysql_query("select * from  users  where cid='0'");
			  $result=mysql_fetch_array($qry1);
	
	?>
	<div id="login-inner">
	  
    <form action="" method="post">
		
		  <table  class="tables" cellpadding="2" cellspacing="0" >
                                                
                                                <tr>
                                                  <td><span class="style30">Your Old Password *</span></td>
                                                  <td  ><input type="password" name="passwd" id="passwd"  style="    height: 28px;"class="form" required/></td>
                                                </tr>
                                                <tr>
                                                  <td ><div align="left">New Password *</div></td>
                                                  <td><input class="form" type="password" id="npasswd" style="    height: 28px;" name="npasswd"  required/></td>
                                                </tr>
                                                <tr>
                                                                                                                                                 
                                              
                                                  <td><div align="left">Confirm Password * </div></td>
                                                  <td ><input type="password" name="cpasswd" style="    height: 28px;" id="cpasswd" class="form"  required/></td>
                                                  
                                                </tr>
                                                <tr><td align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="button" value="Change" id="submit" name="submit" class="btn btn-submit" onclick="changepass();"/></td><td>
                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="button" value="Cancel" id="submit" name="submit" class="btn btn-error"  onClick="history.go(-1);"/>
      </td></tr>
		                                
        </table>
        </form>
	</div>
 	<!--  end login-inner -->
				
				
	
	<div class="clear">&nbsp;</div>

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer........................................................END -->

<div class="clear">&nbsp;</div>
    
<!-- start footer -->         

<!-- end footer -->
 
</body>
</html>