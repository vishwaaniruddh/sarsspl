<?php 
	include("access.php");
	include("config.php");	
     //$repod=$_GET['repod'];
     $frmb=$_GET['podfbill'];
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>

<script type="text/javascript">


function vbefunc(id)
{
/*
var count= id.replace( /^\D+/g, '').trim();
//alert(count);
//alert("hello");
var at=document.getElementById('atm'+count).value;
var pidno=document.getElementById('pid'+count).value;
var supid=document.getElementById('supid'+count).value;
var podnum=document.getElementById('podno').value;
//alert(pidno);
//self.location='view_ebill_package.php?repod=' + podnum;

     // document.location.reload(true); 
    //window.close();
       window.open('newbillentry2.php?podatmid='+at+'&pidn='+pidno+'&podn='+podnum+'&supid='+supid,'_self');
   */  
}


function appfunc(id)
{
var count= id.replace( /^\D+/g, '').trim();
var pidno=document.getElementById('pid'+count).value;
var podno=document.getElementById('podno').value;
//alert(podno);


var conf=confirm('Do you really want to approve the pod?');
    

if(conf==true)
{



 $.ajax({
            url: "podapprove.php",
            type: "POST",
            data: 'pid='+pidno ,      
            success: function(text){     
             alert(text);
                window.open('view_ebill_package(new).php?podfbill='+podno,'_self');
                 //window.close();  

            }           
       });
}


}
function showdiv(id)
{

//alert(id);
var count= id.replace( /^\D+/g, '').trim();
document.getElementById('dispd'+count).style.display = 'block';



}

 
/* function showdiv(id)


{

var left = (screen.width/2)-250;
  var top = (screen.height/2)-125;


var count= id.replace( /^\D+/g, '').trim();
var pidno=document.getElementById('pid'+count).value;
var podno=document.getElementById('podno').value;
//alert(podno);

window.open("uploadfrm.php?pid="+pidno+"&pod="+podno,"","toolbar=no,status=no,menubar=no,location=center,scrollbars=no,resizable=no,height=500,width=657");
}
 */
 

 
 
 
function dispfunc(id)

{
//alert("hello");
var countf= id.replace( /^\D+/g, '').trim();
var pidno=document.getElementById('pid'+countf).value;
var podno=document.getElementById('podno').value;
var rem=document.getElementById('rem'+countf).value;

//alert(pidno);
if(rem=="")
{
alert("Please enter remark");
}
else
{

	var fd=new FormData($('#frmup')[0]);
	//lert(fd);

fd.append('pidnum',pidno);
fd.append('remark',rem);
fd.append('cnt',countf);

      //alert(fd);
        $.ajax({
            url: "upload.php",
            type: "POST",
            data: fd ,
            contentType: false,
            cache: false,
            processData:false,
            success: function(text){
              
                

          //document.getElementById("Error").innerHTML =text;

             alert(text);
                window.open('view_ebill_package(new).php?podfbill='+podno,'_self');
                 //window.close();  

            }           
       });
  

}
}






function fn()
{


//alert("OK");
var podn=document.getElementById('podno').value;
func(podn);
}



function func(pod)
{

var podnum="";
if(pod==1 || pod=="")
{
var podnum=document.getElementById('podno').value;
}
else
{
var podnum=pod;
}
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
xmlhttp.open("GET","getpoddetails(new).php?podn="+podnum,true);
xmlhttp.send();


}



</script>
<style>


</style>
</head>
<!---<body onload="func(<?php echo $frmb;?>)">--->
<body onload="fn()">
<center>
<?php include("menubar.php"); ?>
<h2>View Ebill package</h2>
<form id="frmup" name="frmup" enctype="multipart/form-data" method="post" >

<div id="mdiv" <label>Pod NO.</label><input type="text" id="podno" name="podno"/ value="<?php echo $frmb; ?>"/> <input type="button" name ="search" id="search" value="Search" onclick="func(1)"/></div>

<div id="show"></div>



<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</form>
</center>
</body>

</html>





