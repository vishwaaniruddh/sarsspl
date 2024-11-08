<?php

include("access.php");
include("config.php");	


session_start();
//include("access.php");
if(!$_SESSION['user'])
{
?>
<script type="text/javascript">
alert("Sorry Your session has Expired");
window.location="index.php";
</script>
<?php
}





$qid=$_GET['qid'];
$qoid=$_GET['qoid'];
$sts=$_GET['strdt'];
$ends=$_GET['endt'];
$atms=$_GET['atm'];

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

<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
<script>




function submitfunc()
{
 var qid=document.getElementById('qotid1').value;
 var rem=document.getElementById('rem').value;
var approvby=document.getElementById('approvby').value;
var appamt=document.getElementById('appamt').value;
var expamt=document.getElementById('expamt').value;
 var date1=document.getElementById('date1').value;
 var reqamt=document.getElementById('reqamt').value;
 var mlcpy=document.getElementById('mlcopy').value;
 var ticket=document.getElementById('ticket').value;



//alert(mlcpy);

if(chkseldt())
{

 if(chckapp())
 {
 
 
 
 
 
 var conf=confirm('Are you sure to update the record?');
    
 
 
 

if(conf==true)
{     
  var fd=new FormData($('#frm1')[0]);
  fd.append('rem',rem);
  fd.append('approvby',approvby);
  fd.append('appamt',appamt); 
  fd.append('expamt',expamt); 
   fd.append('qid',qid);
    fd.append('date1',date1);
   fd.append('reqamt',reqamt);
  fd.append('mlcpy',mlcpy);
  fd.append('ticket',ticket);
  
  $.ajax({
            url: "process_quot_approvalrnm.php",
            type: "POST",
            data: fd ,
            contentType: false,
            cache: false,
            processData:false,
             beforeSend: function()
                   {
        
                  $('#maind').html("<h1>Processing Request ...</h1>");
                  },
            success: function(text){
             alert(text);
               
 
window.open('appedit_quotrnm.php?qid='+qid,'_self');

            },
error: function (request, status, error) {
        alert(request.responseText);
    }           
       });

  
  
  
 } 
  

}
}
}


function chkseldt()
{


var dt=document.getElementById('date1').value;

if(dt!="")
{
var date = dt.substring(0, 2);
            var month = dt.substring(3, 5);
            var year = dt.substring(6, 10);

            var myDate = new Date(year, month - 1, date);

            var today = new Date();


  if (myDate >=today) {
                alert("Entered date cannot be greater than todays Date ");
return false;
            }

     return true;
     

   
}
return true;
}

function chckapp()
{

 var reqamt=document.getElementById('reqamt').value;
var appamt=document.getElementById('appamt').value; 
if(parseInt(reqamt)>parseInt(appamt))
{
alert("Required amount is greater than approved amount")
return false;
}
return true;
}


</script>
</head>
<body>

<center>
<?php include("menubar.php"); ?>
<h2>Quotation Approval</h2>
</center>
<form name="frm1" id="frm1" method="post" enctype="multipart/form-data">
<div id="maind" align="center">
<div align="center">

<table width="790" border="2">

<th>Quotation Id</th>
<th>Customer</th>
<th>Atm</th>
<th>Bank</th>
<th>Project ID</th>
<th>Location</th>
<th>City</th>
<th>State</th>
<th style="display:none"></th>




<tr>
 
<?php 
//echo "Select * from quotation1 where id='".$qid."'";
$edqry=mysqli_query($con,"Select * from quotation1 where id='".$qid."'");
$row=mysqli_fetch_array($edqry);

//echo "Select * from quotation_approve_details where qid='".$qid."'";

$edqry=mysqli_query($con,"Select * from quotation_approve_details where qid='".$qid."'");
$nadt=mysqli_num_rows($edqry);
$detrow="";
if($nadt>0)
{
$detrow=mysqli_fetch_array($edqry);
}


$qrynm=mysqli_query($con,"select cust_name from $row[2]_sites where cust_id='".$row[2]."' ");
$qname=mysqli_fetch_array($qrynm);
?>

<td>

<input type="text" style="width:45px" name="qotid1" id="qotid1" value="<?php echo $row[0]; ?>" readonly="readonly"/>
</td>
<td>

<input type="text" style="width:60px" name="cust1" id="cust1" value="<?php echo $qname[0]; ?>" readonly="readonly"/>
</td>

<td>
<input type="text" name="atm1" id="atm1" value="<?php echo $row[3]; ?>" readonly="readonly"/>
</td>

<td>
<input type="text" name="bank" id="bank" value="<?php echo $row[4]; ?>" readonly="readonly"/>

</td>

<td>
<input type="text" name="proj" id="proj" value="<?php echo $row[5]; ?>" readonly="readonly"/>

</td>

<td>
<textarea name="ta" id="ta" readonly="readonly"?><?php echo $row[6]; ?></textarea>
</td>

<td>
<input type="text" style="width:100px" name="city" id="city" value="<?php echo $row[7]; ?>" readonly="readonly"/>
</td>

<td>
<input type="text" name="state" id="state" value="<?php echo $row[8]; ?>" readonly="readonly"/>
</td>



<td>
<input type="hidden" style="width:45px" name="cat" id="cat" value="<?php echo $row[12]; ?>" readonly="readonly"/>
</td>





</tr>

</table>
<br>
<table border="1">

<tr>
<td width="150">Remark</td>
<td align="center"><textarea name="rem" id="rem" ><?php echo $detrow[6]; ?></textarea></td>
</tr>
<tr>
<td width="150">Attach email</td>
<td><input type="file" name="email_cpy" id="email_cpy" >  <?php if($detrow[8]!=""){ ?>  <a href='../operations/quotuploads/approve/<?php echo $detrow[8]; ?>' download>Download</a>  <?php }?>
<input type="hidden" name="mlcopy" id="mlcopy" value="<?php echo $detrow[8]; ?>" readonly>

</td>
</tr>

<tr>
<td width="150">Approve By</td>
<td align="center"><input type="text" name="approvby" id="approvby" value="<?php echo $detrow[7]; ?>" ></td>
</tr>

<tr>
<td width="150">Approved Date</td>
<td align="center"><input type="text" name="date1" id="date1" value="<?php if($nadt>0 & $detrow[12]!="0000-00-00"){ echo date("d-m-Y",strtotime($detrow[12])); }?>"  onclick="displayDatePicker('date1');"  placeholder="dd/mm/yyyy" onchange="chkseldt();"/></td>
</tr>



<tr>
<td width="150">Approved Amount</td>
<td align="center"><input type="text" name="appamt" id="appamt"  value="<?php echo round($detrow[9]); ?>" ></td>
</tr>

<tr>
<td width="150">Expected Amount</td>
<td align="center"><input type="text" name="expamt" id="expamt"  value="<?php echo round($detrow[20]); ?>" ></td>
</tr>

<tr>
<td width="150">Required Amount</td>
<td align="center"><input type="text" name="reqamt" id="reqamt"  value="<?php echo round($detrow[13]); ?>" onblur="chckapp();"></td>
</tr>

<tr>
<td width="150">Ticket Number</td>
<td align="center"><input type="text" name="ticket" id="ticket"  value="<?php echo $detrow[14]; ?>" ></td>
</tr>






</table>

<input type="button" value="Update" onclick="submitfunc();">

</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</form>
</center>
</body>

</html>
