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

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
<script>
function submitfunc()
{
 var qid=document.getElementById('qotid1').value;
 var rem=document.getElementById('rem').value;
var approvby=document.getElementById('approvby').value;
var appamt=document.getElementById('appamt').value;

 var Expectappamt=document.getElementById('Expectappamt').value;
  var hd_nadt=document.getElementById('hd_nadt').value;

 var wbs=document.getElementById('wbs').value;
 var vpr=document.getElementById('vpr').value;
var jid=document.getElementById('jid').value;
var pcode=document.getElementById('pcode').value;
 
 var date1=document.getElementById('date1').value;

 var reqamt=document.getElementById('reqamt').value;
var tno=document.getElementById('tno').value;
var refno=document.getElementById('refno').value;
 var svn=document.getElementById('sv').value;
 

if(wbs!="" && appamt==""){ alert("please Enter approval Amount");}
else if(vpr!="" && appamt==""){ alert("please Enter approval Amount");}
else if(jid!="" && appamt==""){ alert("please Enter approval Amount");}
else if(pcode!="" && appamt==""){ alert("please Enter approval Amount");}
else if(tno!="" && appamt==""){ alert("please Enter approval Amount");}
else if(refno!="" && appamt==""){ alert("please Enter approval Amount");}


else{
 
 if(Expectappamt=="" || hd_nadt>"0"){
 
 
 
 if(validate() && chckapp())
 {
 
 var conf=confirm('Are you sure to Submit the record?');
    
if(conf==true)
{     
  var fd=new FormData($('#frm1')[0]);
  fd.append('rem',rem);
  fd.append('approvby',approvby);
  fd.append('appamt',appamt);
   fd.append('Expectappamt',Expectappamt);
   fd.append('wbs',wbs);
  fd.append('vpr',vpr);
  fd.append('jid',jid);
  fd.append('pcode',pcode) ; 
   fd.append('qid',qid)  ;
    fd.append('date1',date1);
  fd.append('reqamt',reqamt)  ;
   fd.append('tno',tno)  ;
    fd.append('refno',refno);
fd.append('svn',svn);
  
  $.ajax({
            url: "process_quot_approval_tis.php",
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
               
 <?php if($_GET['supvl']=="") {?>
window.open('quotation_approve_tis.php?qoid=<?php echo $qoid;?>'+'&strdt=<?php echo $sts;?>'+'&endt=<?php echo $ends;?>'+'&oatm=<?php echo $atms;?>','_self');
<?php } else {?>
window.open('sup_view_quot_tis.php?qoid=<?php echo $qoid;?>'+'&strdt=<?php echo $sts;?>'+'&endt=<?php echo $ends;?>'+'&oatm=<?php echo $atms;?>','_self');
<?php }?>
            }           
       });

  
  
  
  
  
}
}
}
else{
    var conf=confirm('Are you sure to Submit the record?');
    
if(conf==true)
{     
  var fd=new FormData($('#frm1')[0]);
  fd.append('rem',rem);
  fd.append('approvby',approvby);
  fd.append('appamt',appamt);
   fd.append('Expectappamt',Expectappamt);
   fd.append('wbs',wbs);
  fd.append('vpr',vpr);
  fd.append('jid',jid);
  fd.append('pcode',pcode) ; 
   fd.append('qid',qid)  ;
    fd.append('date1',date1);
  fd.append('reqamt',reqamt)  ;
   fd.append('tno',tno)  ;
    fd.append('refno',refno);
fd.append('svn',svn);
  
  $.ajax({
            url: "process_quot_approval_tis.php",
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
               
 <?php if($_GET['supvl']=="") {?>
window.open('quotation_approve_tis.php?qoid=<?php echo $qoid;?>'+'&strdt=<?php echo $sts;?>'+'&endt=<?php echo $ends;?>'+'&oatm=<?php echo $atms;?>','_self');
<?php } else {?>
window.open('sup_view_quot_tis.php?qoid=<?php echo $qoid;?>'+'&strdt=<?php echo $sts;?>'+'&endt=<?php echo $ends;?>'+'&oatm=<?php echo $atms;?>','_self');
<?php }?>
            }           
       });

  
  
  
  
  
}
}
}



}

function validate()
{

if(chkseldt())
{
var catg=document.getElementById('cat').value;
if(catg=="a")
{
var eml=document.getElementById('email_cpy').value;
var ticno=document.getElementById('tno').value;

//alert("a");
  if(eml=="" && ticno=="" )
  {
  
  alert("please attatch email");
  return false;
  }

return true;

}


return true;
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




function updfunc()
{
 var qid=document.getElementById('qotid1').value;
 var rem=document.getElementById('rem').value;
 var approvby=document.getElementById('approvby').value;
 var date1=document.getElementById('date1').value;
 
 var appamt=document.getElementById('appamt').value; 
 var wbs=document.getElementById('wbs').value;
 var vpr=document.getElementById('vpr').value;
 var jid=document.getElementById('jid').value;
 var pcode=document.getElementById('pcode').value;

 var reqamt=document.getElementById('reqamt').value;
 var tno=document.getElementById('tno').value;
 var refno=document.getElementById('refno').value;
 var svn=document.getElementById('sv').value;
  var Expectappamt=document.getElementById('Expectappamt').value;
 
 
 
var eml=document.getElementById('email_cpy').value;


if(chckapp())
{


 if(Expectappamt!="" && eml==""){
     alert("Please select Attachment");
 }else{
 

var conf=confirm('Are you sure to Update the record?');
    
 //alert(qid);
 //alert(appamt);
if(conf==true)
{ 


var fd1=new FormData($('#frm1')[0]);
  fd1.append('qid',qid);
  fd1.append('rem',rem);
  fd1.append('approvby',approvby);
   fd1.append('date1',date1);
   fd1.append('appamt',appamt);
  fd1.append('wbs',wbs);
  fd1.append('vpr',vpr);
  fd1.append('jid',jid) ; 
   fd1.append('pcode',pcode)  ;
    fd1.append('reqamt',reqamt);
  fd1.append('tno',tno)  ;
   fd1.append('refno',refno)  ;
    fd1.append('svn',svn);
fd1.append('Expectappamt',Expectappamt);
  



$.ajax({
            url: "process_quotfinal_approval_tis.php",
            type: "POST",
          //  data:'appamtu='+appamt+'&wbs='+wbs+'&vpr='+vpr+'&jid='+jid+'&pcode='+pcode+'&qid='+qid+'&reqamt='+reqamt+'&tno='+tno+'&refno='+refno+'&svn='+svn+'&rem='+rem+'&approvby='+approvby+'&date1='+date1+'&Expectappamt='+Expectappamt,         
            data:fd1,
            contentType: false,
            cache: false,
            processData:false,
             beforeSend: function()
                   {
        
                  $('#maind').html("'<h1>Processing Request ...</h1>");
                  },
            success: function(text){
             alert(text);

<?php if($_GET['supvl']=="") {?>
window.open('quotation_approve_tis.php?qoid=<?php echo $qoid;?>'+'&strdt=<?php echo $sts;?>'+'&endt=<?php echo $ends;?>'+'&oatm=<?php echo $atms;?>','_self');
<?php } else {?>
window.open('sup_view_quot_tis.php?qoid=<?php echo $qoid;?>'+'&strdt=<?php echo $sts;?>'+'&endt=<?php echo $ends;?>'+'&oatm=<?php echo $atms;?>','_self');
<?php } ?>
   }
 });

}
     
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
$edqry=mysqli_query($con,"Select * from quotation1_tis where id='".$qid."'");
$row=mysqli_fetch_array($edqry);

//echo "Select * from quotation_approve_details where qid='".$qid."'";

$edqry=mysqli_query($con,"Select * from quotation_approve_details_tis where qid='".$qid."'");
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
<input type="text" id="hd_nadt" name="hd_nadt" value="<?php echo $nadt; ?>">
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
<td align="center"><textarea name="rem" id="rem" <?php if($nadt>0 && $detrow[20]==""){ ?> readonly="readonly" <?php } ?> ><?php echo $detrow[6]; ?></textarea></td>
</tr>
<tr>
<td width="150">Attach email</td>
<td><input type="file" name="email_cpy" id="email_cpy" <?php if($nadt>0 && $detrow[20]==""){ ?> disabled="disabled" <?php } ?> ></td>
</tr>

<tr>
<td width="150">Approve By</td>
<td align="center"><input type="text" name="approvby" id="approvby" value="<?php echo $detrow[7]; ?>" <?php if($nadt>0 && $detrow[20]==""){ ?> readonly="readonly" <?php } ?> ></td>
</tr>

<tr>
<td width="150">Approved Date</td>
<td align="center"><input type="text" name="date1" id="date1" value="<?php if($nadt>0 & $detrow[12]!="0000-00-00"){ echo date("d-m-Y",strtotime($detrow[12])); }?>" <?php if($nadt>0 && $detrow[20]==""){ ?> readonly="readonly"  <?php }else { ?> onclick="displayDatePicker('date1');"   <?php } ?> placeholder="dd/mm/yyyy" /></td>
</tr>


<tr>
<td width="150">Expectation Approval Amount</td>
<td align="center"><input type="text" name="Expectappamt" id="Expectappamt"  value="<?php echo $detrow[20]; ?>" <?php if($nadt>0){ ?> readonly="readonly"  <?php }?>></td>
</tr>


<tr>
<td width="150">Approved Amount</td>
<td align="center"><input type="text" name="appamt" id="appamt"  value="<?php echo $detrow[9]; ?>" ></td>
</tr>


<tr>
<td width="150">Required Amount</td>
<td align="center"><input type="text" name="reqamt" id="reqamt"  value="<?php echo $detrow[13]; ?>" onblur="chckapp();"></td>
</tr>


<tr>
<td width="150">WBS/IO CODE</td>
<td align="center"><input type="text" name="wbs" id="wbs"  ></td>
</tr>

<tr>
<td width="150">VPR No</td>
<td align="center"><input type="text" name="vpr" id="vpr" ></td>
</tr>

<tr>
<td width="150">JOB ID</td>
<td align="center"><input type="text" name="jid" id="jid" ></td>
</tr>



<tr>
<td width="150">Prime Code</td>
<td align="center"><input type="text" name="pcode" id="pcode" ></td>
</tr>

<tr>
<td width="150">Ticket Number</td>
<td align="center"><input type="text" name="tno" id="tno" ></td>
</tr>

<tr>
<td width="150">Reference Number </td>
<td align="center"><input type="text" name="refno" id="refno" ></td>
</tr>






</table>


<input type="button" value="Submit"  onclick="submitfunc();" <?php if($nadt>0){ ?> style="display:none" <?php } ?>>
<input type="button" value="Update" onclick="updfunc();" <?php if($nadt==0){ ?> style="display:none" <?php } ?>>
<input type="button" name="bck" id="bck" value="Back"
<?php if($_GET['supvl']=="") {?>
 onclick="window.open('quotation_approve_tis.php?qoid=<?php echo $qoid;?>'+'&strdt=<?php echo $sts;?>'+'&endt=<?php echo $ends;?>'+'&oatm=<?php echo $atms;?>','_self');"/>
<?php }else {?>
 onclick="window.open('sup_view_quot_tis.php?qoid=<?php echo $qoid;?>'+'&strdt=<?php echo $sts;?>'+'&endt=<?php echo $ends;?>'+'&oatm=<?php echo $atms;?>','_self');"/>
<?php }?>
</div>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</form>
</center>
</body>

</html>
