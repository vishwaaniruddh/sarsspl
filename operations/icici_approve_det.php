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
 
 var pocap=document.getElementById('pocap').value;
 var po=document.getElementById('po').value;
var pr=document.getElementById('pr').value;
var sr=document.getElementById('sr').value;
 
 var date1=document.getElementById('date1').value;

 var reqamt=document.getElementById('reqamt').value;

 var svn=document.getElementById('sv').value;
 
 //alert(svn);
 
 
 if(validate() & chckapp())
 {
 
 
 
 
 
 var conf=confirm('Are you sure to Submit the record?');
    
 
 
 

if(conf==true)
{     
  var fd=new FormData($('#frm1')[0]);
  fd.append('rem',rem);
  fd.append('approvby',approvby);
  fd.append('appamt',appamt); 
   fd.append('pocap',pocap);
  fd.append('pr',pr);
  fd.append('po',po);
  fd.append('sr',sr) ; 
  
   fd.append('qid',qid)  ;
    fd.append('date1',date1);
  fd.append('reqamt',reqamt)  ;

fd.append('svn',svn);
  
  $.ajax({
            url: "process_icici_approval.php",
            type: "POST",
            data: fd ,
            contentType: false,
            cache: false,
            processData:false,
             beforeSend: function()
                   {
        
                  $('#maind').html("'<h1>Processing Request ...</h1>");
                  },
            success: function(text){
             alert(text);
               
 
window.open('icici_quot_view.php?qoid=<?php echo $qoid;?>'+'&strdt=<?php echo $sts;?>'+'&endt=<?php echo $ends;?>'+'&oatm=<?php echo $atms;?>','_self');

          }          
       });

  
  
  
  
  

}
}
}

function validate()
{

var catg=document.getElementById('cat').value;
if(catg=="a")
{

//alert("a");
  if(document.getElementById('email_cpy').value=="")
  {
  
  alert("please attatch email");
  return false;
  }

return true;

}

return true;

}

function updfunc()
{
var qid=document.getElementById('qotid1').value;
var appamt=document.getElementById('appamt').value; 
 

 var reqamt=document.getElementById('reqamt').value;

  var svn=document.getElementById('sv').value;
  
  var pocap=document.getElementById('pocap').value;
 var po=document.getElementById('po').value;
var pr=document.getElementById('pr').value;
var sr=document.getElementById('sr').value;
  
 
 
 //alert(tno);
if(chckapp())
{


var conf=confirm('Are you sure to Update the record?');
    
 //alert(qid);
 //alert(appamt);
if(conf==true)
{ 


$.ajax({
            url:"process_icici_final_approval.php",
            type: "POST",
            data:'appamtu='+appamt+'&pocap='+pocap+'&po='+po+'&pr='+pr+'&sr='+sr+'&qid='+qid+'&reqamt='+reqamt+'&svn='+svn,         
             beforeSend: function()
                   {
        
                  $('#maind').html("'<h1>Processing Request ...</h1>");
                  },
            success: function(text)
            {
             alert(text);
window.open('icici_quot_view.php?qoid=<?php echo $qoid;?>'+'&strdt=<?php echo $sts;?>'+'&endt=<?php echo $ends;?>'+'&oatm=<?php echo $atms;?>','_self');



   },
   error:function(x,e) {
    if (x.status==0) {
        alert('You are offline!!\n Please Check Your Network.');
    } else if(x.status==404) {
        alert('Requested URL not found.');
    } else if(x.status==500) {
        alert('Internel Server Error.');
    } else if(e=='parsererror') {
        alert('Error.\nParsing JSON Request failed.');
    } else if(e=='timeout'){
        alert('Request Time out.');
    } else {
        alert('Unknow Error.\n'+x.responseText);
    }
}
 });

}

}


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
<tr height="45">
<td>Supervisor</td>
<td>
<select name="sv" id="sv"><option value="-1">Select</option>
   <?php
 //  $sup=mysqli_query($con,"select username from login where designation='11' and serviceauth='3' and deptid='4' order by username ASC");
 $sup=mysqli_query($con,"select hname,aid,accno from fundaccounts where status=0 order by hname ASC");
 
    
	 while($supro=mysqli_fetch_array($sup))
	{ ?>
	   <option value="<?php echo $supro[1]; ?>" <?php if($row[17]==$supro[1]){ echo "selected" ; } ?>><?php echo $supro[0]."/".$supro[2]; ?></option>
   <?php } ?>  
    </select>
</td>

</tr>




<tr>
<td width="150">Remark</td>
<td align="center"><textarea name="rem" id="rem" <?php if($nadt>0){ ?> readonly="readonly" <?php } ?> ><?php echo $detrow[6]; ?></textarea></td>
</tr>
<tr>
<td width="150">Attach email</td>
<td><input type="file" name="email_cpy" id="email_cpy" <?php if($nadt>0){ ?> disabled="disabled" <?php } ?> ></td>
</tr>

<tr>
<td width="150">Approve By</td>
<td align="center"><input type="text" name="approvby" id="approvby" value="<?php echo $detrow[7]; ?>" <?php if($nadt>0){ ?> readonly="readonly" <?php } ?> ></td>
</tr>

<tr>
<td width="150">PO / SR / PR / Pocap Date</td>
<td align="center"><input type="text" name="date1" id="date1" value="<?php if($nadt>0 & $detrow[12]!="0000-00-00"){ echo date("d-m-Y",strtotime($detrow[12])); }?>" <?php if($nadt>0){ ?> readonly="readonly"  <?php }else { ?> onclick="displayDatePicker('date1');"   <?php } ?> placeholder="dd/mm/yyyy" /></td>
</tr>



<tr>
<td width="150">Approved Amount</td>
<td align="center"><input type="text" name="appamt" id="appamt"  value="<?php echo round($detrow[9]); ?>" ></td>
</tr>


<tr>
<td width="150">Required Amount</td>
<td align="center"><input type="text" name="reqamt" id="reqamt"  value="<?php echo round($detrow[13]); ?>" onblur="chckapp();"></td>
</tr>


<tr>
<td width="150">Pocap</td>
<td align="center"><input type="text" name="pocap" id="pocap" value="<?php echo $detrow[16]; ?>" ></td>
</tr>

<tr>
<td width="150">Purchase Order (PO)</td>
<td align="center"><input type="text" name="po" id="po" value="<?php echo $detrow[17]; ?>"></td>
</tr>

<tr>
<td width="150">Purchase Request (PR)</td>
<td align="center"><input type="text" name="pr" id="pr" value="<?php echo $detrow[18]; ?>"></td>
</tr>



<tr>
<td width="150">Service Request (SR)</td>
<td align="center"><input type="text" name="sr" id="sr" value="<?php echo $detrow[19]; ?>"></td>
</tr>




</table>


<input type="button" value="Submit"  onclick="submitfunc();" <?php if($nadt>0){ ?> style="display:none" <?php } ?>>
<input type="button" value="Update" onclick="updfunc();" <?php if($nadt==0){ ?> style="display:none" <?php } ?>>
<input type="button" name="bck" id="bck" value="Back"
 onclick="window.open('icici_quot_view.php?qoid=<?php echo $qoid;?>'+'&strdt=<?php echo $sts;?>'+'&endt=<?php echo $ends;?>'+'&oatm=<?php echo $atms;?>','_self');"/>

</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</form>
</center>
</body>

</html>
