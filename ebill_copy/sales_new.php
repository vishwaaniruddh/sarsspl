<?php
include("access.php");
include("config.php");


if(!$_SESSION['user'])
{
?>
<script type="text/javascript">
alert("Sorry Your session has Expired");
window.location="index.php";
</script>n 
<?php
}



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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

 <script src="excel.js" type="text/javascript"></script>


<script>

function exptab()
{
    
    
     try {
                $("#tableexport").table2excel({
                    // exclude CSS class
                    exclude: ".noExl",
                    name: "Worksheet Name",
                    filename: "SomeFile" //do not include extension
                });
            } catch (ex)
            {

                alert(ex);
            }
}


function getbank(val,type)
{
	//alert(val);

//alert(num);
//	document.getElementById('image').innerHTML="<img src='loading.gif' width='100px' height='50px'>";
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
document.getElementById('bank').innerHTML='';
	document.getElementById('bank').innerHTML=xmlhttp.responseText;
	if(val=='EUR08')
	document.getElementById('type').style.display='';
	else
	document.getElementById('type').style.display='none';
	
	if(val=='Tata05')
	document.getElementById('tata').style.display='';
	else
	document.getElementById('tata').style.display='none';
	
	getproject(val,'projectid');
	
    }
  }

xmlhttp.open("GET","getcustbank.php?val="+val+"&type="+type,true);
xmlhttp.send();
//alert("getcustbank.php?val="+val+"&type="+type);
	
}

function func(strpg,perpg)
{

var cust=document.getElementById('cid').value;
var endt=document.getElementById('endt').value;

var strdt=document.getElementById('strdt').value;
var bank=document.getElementById('bank').value;
var invoice_no=document.getElementById('invoice_no').value;
var invoicetyp =document.getElementById('invoice').value;






if(perpg=="")
{
perp='50';
}
else
{
perp=document.getElementById(perpg).value;
}



var Page="";
if(strpg!="")
{
Page=strpg;
}






//alert(accname);

//alert(atm);
$.ajax({
   type: 'POST',    
url:'sales_new_search.php',
 beforeSend: function()
                   {
        
                  document.getElementById("search").innerHTML ="<center><img src=loader.gif></center>";
                  },
data:'cid='+cust+'&strdt='+strdt+'&endt='+endt+'&perpg='+perp+'&Page='+Page+'&bank='+bank+'&invoice_no='+invoice_no+'&invoicetyp='+invoicetyp,
success: function(msg){

//alert(msg);
  document.getElementById('search').innerHTML=msg;



    
         }
     });





}

function getproject(val,type)
{
	//alert(val);

//alert(num);
//	document.getElementById('image').innerHTML="<img src='loading.gif' width='100px' height='50px'>";
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
document.getElementById('proj').innerHTML='';
	document.getElementById('proj').innerHTML=xmlhttp.responseText;
	
	
    }
  }

//alert("getebillproj.php?val="+val+"&type="+type);
xmlhttp.open("GET","getebillproj.php?val="+val+"&type="+type,true);
xmlhttp.send();

	
}

</script>
</head>
<body>
<form id='frm1' method="post" >
<center>
<?php  include("menubar.php"); ?>
<h2 class="h2color">Sales </h2>


	<br />

        <select name="cid" id="cid" onchange="getbank(this.value,'ebill');" ><option value="">select Client</option>
           <?php
              $sql="SELECT contact_first, short_name FROM contacts where type='c' and short_name in(select distinct(cust_id) from mastersites) order by contact_first ASC";
         $result1 = mysqli_query($con,$sql);
            while($row1 = mysqli_fetch_row($result1)){ ?>
                                           <option value="<?php echo $row1[1]; ?>" ><?php echo $row1[0]; ?></option>
           <?php } ?>   </select>
          <select name="bank" id="bank"  ><option value="">select Bank</option></select>
          <select name=type id=type style="display:none" >
         
          <option value="">Select Type</option>
          <option value="paid">Paid Bills</option><option value="unpaid">Unpaid Bills</option></select>
          <select name=tata id=tata style="display:none" onchange="searchById('Listing','1','');">
           <option value="">Select Type</option>
            <option value="housekeeping">Housekeeping</option>
            <option value="">Others</option>
           </select>
          <select name="proj" id="proj" ><option value="">select Project</option></select>
           <select name="invoice" id="invoice" >
           <option value="">All</option>
           <option value="0">Active</option>
           <option value="1">Inactive</option>
           </select>
           

      <input type="text" name="strdt" id="strdt" placeholder="From date" onclick="displayDatePicker('strdt');"  />
    <input type="text" name="endt" id="endt" placeholder="To date" onclick="displayDatePicker('endt');"  /> 
     <input type="text" name="invoice_no" id="invoice_no" placeholder="Invoice No." />   
      <input type="button" onclick="func('','');" value="Search by Date">
   
</p>


<center>
<div id="search"></div>

</center>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>
<?php 

?>