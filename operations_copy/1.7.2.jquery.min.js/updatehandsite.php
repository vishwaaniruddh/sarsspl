<?php
include("access.php");
include 'config.php';
 //echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation']." ".$_SESSION['dept'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script src="js/opener.js" type="text/javascript"></script>
<script src="excel.js" type="text/javascript"></script>
<script src="js/ajaxfileupload.js" type="text/javascript"></script>
<script type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
        
            function a(){
             
              var fdate=document.getElementById("fdate").value;
             // alert(fdate);
              var ids=document.getElementById("ids").value;
			  //alert(tdate);
            
             $.ajax({
               
            type:'POST',    
   url:'updatehandsite_process.php',
   data:'fdate='+fdate+'&ids='+ids,


   success: function(msg){
    //alert(msg);
   if(msg==1){
       alert("Updated Successfuly");
      // window.close();
       window.opener.location.reload();window.close();
   }
  // document.getElementById("show").innerHTML=msg;
   

   
} })
            }
        </script>
</head>

<body >

<center>
<?php //include("menubar.php");
$ids=$_GET['atmid'];


?>
<input type="hidden" name="ids" id="ids" value="<?php echo $ids;?>"/>
<h2 class="h2color">Update Site Status</h2>
<table  border="0" cellpadding="0" cellspacing="0" width="50%">
<tr>

</tr>
<tr>
<td> Hand Over :<input type="text" name="fdate" id="fdate" onclick="displayDatePicker('fdate');" placeholder="From Date"/></td></tr>


       <tr> <td><input type="button" name="submit" onclick="a()" value="submit"></button></td></tr>


</table>



               


			
			  
        </body>
    
</html>




