<?php ini_set( "display_errors", 0);
	
	include("access.php");
	
	
	// header('Location:managesite1.php?id='.$id); 
	 
	include("config.php");
	
	$result1 = mysqli_query($con,"SELECT DISTINCT DISCRIPTION as DISC  FROM Online_TransferData order by DISCRIPTION ASC");		
	//$result2 = mysqli_query($con,"SELECT DISTINCT bank FROM sites");		
	 ?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Outstanding</title>
	<link href="style.css" rel="stylesheet" type="text/css" />
	<link href="menu.css" rel="stylesheet" type="text/css" />
	<!--datepicker-->
	<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
	
	<script src="datepicker/datepick_js.js" type="text/javascript"></script>
	
	
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
				
				<script>
				    function Trans_Process(){
				        
				      var cid=  $("#cid").val();
				      var frmdt=$("#frmdt").val();
				      var todt= $("#todt").val();
				     
				     if(cid==""){
				         alert("Please Select Description");
				     }else if(frmdt==""){
				        alert("Please Select From Date"); 
				     }
				     else if(todt==""){
				        alert("Please Select To Date"); 
				     }else{
				        
				         $.ajax({
				             type:"post",
				             url:"Online_transfer_process.php",
				             data:"cid="+cid+"&frmdt="+frmdt+"&todt="+todt,
				             success:function(msg){
				                 //alert(msg);
				                 $("#show").html(msg);
				             }
				             
				             
				         })
				         
				     }
				     
				      
				     
				    }
				</script>
				
				
	</head>
	<body >
	<center>
	<?php include("menubar.php");?>
	<form name="frm1"  align="center">
	<h2 class="style1" align="center">Online Transfer</h2>
	<table border="3" align="center"><tr><td width="209" align="center">
		 Description :
			  <select name="cid" id="cid"  ><option value="">select Description</option>
		<option value="ALL" selected>ALL</option>
			   <?php
				while($row1 = mysqli_fetch_row($result1))
				{
				
				
				 ?>
				   <option value="<?php echo $row1[0]; ?>"><?php echo $row1[0]; ?></option>
			   <?php } ?>   </select></td>
			   <td>
			    From: <input type="text" name="frmdt" id="frmdt" value="<?php echo date('d/m/Y')?>"  onclick="displayDatePicker('frmdt')" autocomplete="off">&nbsp;
			    </td>
			    <td>
			    TO:<input type="text" name="todt" id="todt" onclick="displayDatePicker('todt')"  value="<?php echo date('d/m/Y')?>" autocomplete="off">&nbsp;
			    </td>
			   <td>
			  <input type="button" onclick="Trans_Process();"  name="sub" id="sub" value="Search" >
			   </td>
			  
			   </tr>
			   </table>
			   </form>
			   </center>
			   
			  
				<div id="show">

</div>

				
			</body>
			   </html>
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   
			   