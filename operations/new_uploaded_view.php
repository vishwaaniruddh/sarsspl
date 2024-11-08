<?php
session_start();
ini_set( "display_errors", 0);
include("access.php");

if($_SESSION['id']=="218" || $_SESSION['id']=="499")
{

// header('Location:managesite1.php?id='.$id); 
 
include("config.php");

$result1 = mysqli_query($con,"SELECT contact_first, short_name FROM contacts where type='c' order by short_name ASC");		
$result2 = mysqli_query($con,"SELECT DISTINCT bank FROM sites");		
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sites</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script src="excel.js" type="text/javascript"></script>

<script type="text/javascript">


function func(strpg,perpg)
{

var cust=document.getElementById('cid').value;
var pdt=document.getElementById('dt').value;
var entrydt=document.getElementById('entrydt').value;

var frmdt=document.getElementById('frmdt').value;
var todt=document.getElementById('todt').value;
var atmid=document.getElementById('atmid').value;



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
url:'neew_getuploadeddetails.php',
 beforeSend: function()
                   {
        
                  document.getElementById("search").innerHTML ="<center><img src=loader.gif></center>";
                  },
data:'cust='+cust+'&pdt='+pdt+'&entrydt='+entrydt+'&perpg='+perp+'&Page='+Page+'&atmid='+atmid+'&frmdt'+frmdt+'&todt'+todt,
success: function(msg){

//alert(msg);
  document.getElementById('search').innerHTML=msg;



   
 
         },
    error: function (jqXHR, exception) {
        var msg = '';
        if (jqXHR.status === 0) {
            msg = 'Not connect.\n Verify Network.';
        } else if (jqXHR.status == 404) {
            msg = 'Requested page not found. [404]';
        } else if (jqXHR.status == 500) {
            msg = 'Internal Server Error [500].';
        } else if (exception === 'parsererror') {
            msg = 'Requested JSON parse failed.';
        } else if (exception === 'timeout') {
            msg = 'Time out error.';
        } else if (exception === 'abort') {
            msg = 'Ajax request aborted.';
        } else {
            msg = 'Uncaught Error.\n' + jqXHR.responseText;
        }
        alert(msg);
    },
     });





}

</script>
</head>
<body >


<center>
<?php include("menubar.php");
//echo $_SESSION['branch'];
 ?>


  <h2 class="style1">Search</h2>

<p align="center">
<form  method="post" enctype="multipart/form-data">

           <select name="cid" id="cid" onchange="getproj(this.value);" required><option value="">select Client</option>
           <?php while($row1 = mysqli_fetch_row($result1)){ ?>
                                           <option value="<?php echo $row1[1]; ?>"<?php if(isset($_GET['cid']) && $_GET['cid']==$row1[1]){ ?> selected <?php }  ?> ><?php echo $row1[0]; ?></option>
           <?php } ?>   </select>
Paid Date <input type="text" name="dt" id="dt" value="" onclick="displayDatePicker('dt');"   />


Entry Date <input type="text" name="entrydt" id="entrydt" value="" onclick="displayDatePicker('entrydt');"   />


From Date <input type="text" name="frmdt" id="frmdt" value="" onclick="displayDatePicker('frmdt');"   />


To Date <input type="text" name="todt" id="todt" value="" onclick="displayDatePicker('todt');"   />

Atm Id <input type="text" name="atmid" id="atmid" />


<!--<p>&nbsp;<a href="exportallsite.php" >Export All Data</a></p>-->
<input type="button" name="submit" id="submit" value="SEARCH" onclick='func("","");'/></form>
</center>
<div id="search" style="margin-top:70px;">

</div>

</form>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="new_jqueryexportexcel.js"></script>


<script type="text/javascript" src="script.js"></script>
<script>


/*$("#btnExport").click(function () {
           alert("test");
            try {
                $("#tableID").table2excel({
                    // exclude CSS class
                    exclude: ".noExl",
                    name: "Worksheet Name",
                    filename: "SomeFile" //do not include extension
                });
            } catch (ex)
            {

                alert(ex);
            }
        });*/
        
        function expfunc()
        {
            
            alert("ok");
            try {
                $("#tableID").table2excel({
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


function billentryfunc(id)
        {
            
            try 
            {
           
           window.open("newbillentry2newtest.php?tid="+id,"_blank");
           
            } catch (ex)
            {

                alert(ex);
            }
            
        }

</script>

</body>
</html>
<?php 
    
}
else
{
    
     header("logout.php");

    
}

?>