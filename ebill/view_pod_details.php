<?php ini_set( "display_errors", 0);
session_start();
include("access.php");
?>

<?php
//echo $_SESSION['user']." ".$_SESSION['designation'];

// header('Location:managesite1.php?id='.$id); 
 
include("config.php");

	
		
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>View Invoice</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script type="text/javascript">
  
  function func()
{
var podnum=document.getElementById('podno').value;
var strdt=document.getElementById('date').value;
var endt=document.getElementById('date2').value;
//alert(strdt+""+endt);
//alert(podnum);


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
	//alert(xmlhttp.responseText);
	var resp=xmlhttp.responseText;
	//alert(resp);
	
	//alert(xmlhttp.responseText);
     
	document.getElementById('show').innerHTML=resp;
//alert(pod);
	

	


    }
  }
  //alert()
xmlhttp.open("GET","getpoddetails1.php?podn="+podnum+"&strt="+strdt+"&end="+endt,true);

xmlhttp.send();
}

function toexcel1()
{
var strdt="";
var endt="";

var pd=document.getElementById('podno').value;
//alert(pd);



if(pd=="")
{
var strdt=document.getElementById('date').value;
var endt=document.getElementById('date2').value;
//alert (strdt);
//alert(endt);
}


window.open('podexcelcopy1.php?strtdate='+strdt+"&endate="+endt+"&podno="+pd,'_blank');



}




 function toexcel()
{
var strdt="";
var endt="";

var pd=document.getElementById('podno').value;
//alert(pd);



if(pd=="")
{
var strdt=document.getElementById('date').value;
var endt=document.getElementById('date2').value;
//alert (strdt);
//alert(endt);
}


//window.open('podexcelcopy.php?strtdate='+strdt+"&endate="+endt+"&pd="+pd,'_blank');
document.getElementById("myForm").submit();

}


function vpod(id)
{
//alert(id);
var count= id.replace( /^\D+/g, '').trim();
//alert("ok");
//alert(count);
var pod=document.getElementById('podnum'+count).value;
var rec=document.getElementById('recf'+count).value;
var strdt=document.getElementById('date').value;
var endt=document.getElementById('date2').value;

//alert(pod);


 window.open('viewpod.php?pd='+pod+'&recf='+rec+'&st='+strdt+'&end='+endt,'_blank');

}




</script>

</script>
</head>

<body>
<form name="myForm" id="myForm" action="podexcelcopy.php" method="POST" target=_blank>
<center>
<?php include("menubar.php");
//echo $_SESSION['branch'];
 //echo $_SESSION['designation']." ".$_SESSION['serviceauth']." ".$_SESSION['dept'];
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation']." ".$_SESSION['dept']." ".$_SESSION['serviceauth']
 ?></center>

<p align="center">

          
          
        
           
         
  <input type="text" name="podno" id="podno" placeholder="POD Number"   />
     <input type="text" name="date" id="date" placeholder="From date" onclick="displayDatePicker('date');"  />
    <input type="text" name="date2" id="date2" placeholder="To date" onclick="displayDatePicker('date2');"  /> 
       
      <input type="button" onclick="func();" value="Search">
   
</p>


<div id="show"></div>


<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</form>
</body>
</html>