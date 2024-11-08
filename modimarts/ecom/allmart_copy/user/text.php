<?php
session_start();
/*
if(isset($_SESSION['user']) )
{*/
include('config.php');

$id=$_GET['id'];
$eventid=$_GET['eventid'];

//$subid=$_GET['subid'];
		?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Event</title>
<link rel="stylesheet" href="adstyle.css" type="text/css" />
<link rel="stylesheet" href="style.css" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
<script src="ckeditor/ckeditor.js"></script>
	<script src="ckeditor/samples/js/sample.js"></script>
	<link rel="stylesheet" href="ckeditor/samples/css/samples.css">

<script>




function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if ((charCode < 48 || charCode > 57))
        return false;

    return true;
}

</script>

</head>


<script type="text/javascript">

function confirm_delete(id)
{
if(confirm("Are you sure you want to delete this entry?"))
  {
    document.location="deleteCat.php?id="+id;
  }
}


function addThem2(){
	
var a = document.formf.selectcolor;
//alert(a.value);
var add = a.value+',';

document.formf.color.value += add;
return true;
}


//=======================ADD MORE IMAGES SCRIPT HERE==========================================================
function addItem()
{
	//alert("hii");
	var cnt2;
	var cnt=Number(document.getElementById('counter').value);	
  	//alert(cnt);
  	cnt2=cnt;
  	cnt=cnt+1;
  	document.getElementById('counter').value=cnt;
var catid=document.getElementById('id').value;
	
	//document.getElementById('image').innerHTML="<img src='loading.gif' width='100px' height='50px'>";
		if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		
var numi = document.getElementById('theValue');
var num = parseInt(document.getElementById('theValue').value) +1;
numi.value = num;

		var newdiv=document.createElement("div");
		newdiv.setAttribute('id',num);
		//alert(num);
//newdiv.innerHTML=xmlhttp.responseText+"<td><input type='button' value='Remove' onClick='removeElement("+num+")'><td></tr></div><tbody><table>";
newdiv.innerHTML=xmlhttp.responseText;	
	document.getElementById('back').appendChild(newdiv);
    document.getElementById('image').innerHTML="";
    document.getElementById('input').innerHTML="";
    }
  }
  
    
  //alert("addrow_image.php?cnt="+cnt);
xmlhttp.open("GET","addrow_image.php?cnt="+cnt+"&id="+catid,true);
xmlhttp.send();	
}

function addpdf()
{
	//alert("hii");
	var cnt2;
	var cnt=Number(document.getElementById('counter').value);	
  	//alert(cnt);
  	cnt2=cnt;
  	cnt=cnt+1;
  	document.getElementById('counter').value=cnt;
var catid=document.getElementById('id').value;
	
	//document.getElementById('image').innerHTML="<img src='loading.gif' width='100px' height='50px'>";
		if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		
var numi = document.getElementById('theValue');
var num = parseInt(document.getElementById('theValue').value) +1;
numi.value = num;

		var newdiv=document.createElement("div");
		newdiv.setAttribute('id',num);
		//alert(num);
//newdiv.innerHTML=xmlhttp.responseText+"<td><input type='button' value='Remove' onClick='removeElement("+num+")'><td></tr></div><tbody><table>";
newdiv.innerHTML=xmlhttp.responseText;	
	document.getElementById('back').appendChild(newdiv);
    document.getElementById('image').innerHTML="";
    document.getElementById('input').innerHTML="";
    }
  }
  
    
  //alert("addrow_image.php?cnt="+cnt);
xmlhttp.open("GET","addnewspdf.php?cnt="+cnt+"&id="+catid,true);
xmlhttp.send();	
}




function validatefrm()
{
<?php
if($eventid=="")
{
?>
var flup=document.getElementsByName("image[]");
var er=0;
for(var i=0;i<flup.length;i++)
{

if(flup[i].value=="")
{


//alert(flup[i].value);
er=parseInt(er)+parseInt(1);

//return false;
//alert("ok");
}


}
if(parseInt(er)>parseInt(0))
{
alert("Please select Image to upload");
return false;
}
<?php } ?>
return true;
}


</script>


<body>
<div >
					
				
                   
					
				</div>


<div class="body">
					<div class="content" >
                    
                    <div id="welcome" style="margin-left:300px;">					
                    

<form action="process_addevents.php" method="post" enctype="multipart/form-data" id="formf" name="formf" onsubmit="return validatefrm();">
<table style="margin-left:0px; width:500px;" >

 
 <tr><td height="36">
	<input style="color: #000000;" type="hidden" value="1"  name="counter" id="counter">
    	<input style="color: #000000;" type="hidden" name="theValue" id="theValue" value="5"/>
      	<input style="color: #000000;" type="hidden" name="myval" id="myval" value=""/>
      	<input style="color: #000000;" type="hidden" name="id" id="id" value="<?php echo $id; ?>"/>
</td>
<td>
 </td>
</tr>



<tr>
<td height="" ></td>
</tr>
<tr> <td colspan="2">
<div id="back">  
<table width="" border="0">
<tbody>

<?php 
$grwsevents="";
if($eventid!="")
{
$qrevents=mysqli_query($con1,"SELECT * FROM `events` WHERE id='".$eventid."'");
$grwsevents=mysqli_fetch_array($qrevents);

}
?>

<tr>


<tr>
<td >  

Long Description</td><td style="maring-top-1px;"><textarea  id="editor" name="desc2[]"><?php if($eventid!=""){  echo $grwsevents[7]; }?></textarea></td>
</tr>

<script>
       
initSample();                         
                                    </script> 


</tr>

</tbody>
</table>
</div>
</td></tr>



<tr><td height="31" colspan="2">

<?php if($eventid=="") {
?>
 <input type="Submit" value="Submit" id="Submit" name="Submit" class="sub">
<?php }else
{
?>
 <input type="Submit" value="Update" id="Submit" name="Update" class="sub">
<?php } ?> 

<input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
<input type="hidden" id="eventid" name="eventid" value="<?php echo $eventid; ?>" />
 
 
 <input type="button" value="Cancel" id="cancel" name="cancel"  onClick="javascript:location.href = 'view_events.php?id=<?php echo $id; ?>';" class="sub">
</td></tr></table>
</form>

</div></div></div>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script type="text/javascript" src="script.js"></script>
<script src="ckeditor/ckeditor.js"></script>
	<script src="ckeditor/samples/js/sample.js"></script>
	<link rel="stylesheet" href="ckeditor/samples/css/samples.css">
<script>
	initSample();
</script>


</body>


</html>
