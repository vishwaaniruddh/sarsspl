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

function clsfunc()
{
var qid=document.getElementById('qotid1').value;
var dt=document.getElementById('date1').value; 
 var comby=document.getElementById('comby').value;
  var rem=document.getElementById('rem').value;
 
if(rem=="")
{
alert("please enter remark");
}
else
{

var conf=confirm('Are you sure to Close the Quotation?');
    
 //alert(qid);
 //alert(appamt);
var fd=new FormData($('#frm1')[0]);
  fd.append('qid',qid);
 fd.append('dt',dt);
 fd.append('comby',comby);
 fd.append('rem',rem);
 
 
if(conf==true)
{ 


$.ajax({
            url: "process_quotfinal_close.php",
            type: "POST",
            data:fd,    
            contentType: false,
            cache: false,
            processData:false,     
             beforeSend: function()
                   {
        
                  $('#maind').html("'<h1>Processing Request ...</h1>");
                  },
            success: function(text){
             alert(text);

<?php if($_GET['supvl']!="") {?>
window.open('sup_view_quot.php?qoid=<?php echo $qoid;?>'+'&strdt=<?php echo $sts;?>'+'&endt=<?php echo $ends;?>'+'&atms=<?php echo $atms;?>','_self');
<?php
}
elseif($_GET['ic']!="")
{
?>
window.open('icici_quot_view.php?qoid=<?php echo $qoid;?>'+'&strdt=<?php echo $sts;?>'+'&endt=<?php echo $ends;?>'+'&atms=<?php echo $atms;?>','_self');
<?php
}
else
{
?>
window.open('quotation_approve.php?qoid=<?php echo $qoid;?>'+'&strdt=<?php echo $sts;?>'+'&endt=<?php echo $ends;?>'+'&atms=<?php echo $atms;?>','_self');
<?php }?>
   }
 });

}

}


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
<tr>
<th>Quotation Id</th>
<th>Customer</th>
<th>Atm</th>
<th>Bank</th>
<th>Project ID</th>
<th>Location</th>
<th>City</th>
<th>State</th>
</tr>

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
<td width="150">Completion Date</td>
<td align="center"><input type="text" name="date1" id="date1"  onclick="displayDatePicker('date1');"   placeholder="dd/mm/yyyy" /></td>
</tr>


<tr>
<td width="150">Completed By</td>
<td align="center"><input type="text" name="comby" id="comby" /></td>
</tr>


<tr>
<td width="150">Remark</td>
<td align="center"><textarea name="rem" id="rem" ></textarea></td>
</tr>

<tr>
<td width="150">Attach email</td>
<td><input type="file" name="email_cpy" id="email_cpy"  ></td>
</tr>


</table>



<input type="button" value="Submit" onclick="clsfunc();">
<input type="button" name="bck" id="bck" value="Back" 
<?php if($_GET['supvl']!="") 
 {
?>
onclick="window.open('sup_view_quot.php?qoid=<?php echo $qoid;?>'+'&strdt=<?php echo $sts;?>'+'&endt=<?php echo $ends;?>'+'&oatm=<?php echo $atms;?>','_self');"/>

<?php 
} 
elseif($_GET['ic']!="")
{
?>
onclick="window.open('icici_quot_view.php?qoid=<?php echo $qoid;?>'+'&strdt=<?php echo $sts;?>'+'&endt=<?php echo $ends;?>'+'&oatm=<?php echo $atms;?>','_self');"/>
<?php
}
else 
{
?>
onclick="window.open('quotation_approve.php?qoid=<?php echo $qoid;?>'+'&strdt=<?php echo $sts;?>'+'&endt=<?php echo $ends;?>'+'&oatm=<?php echo $atms;?>','_self');"/>
<?php
 } 
?>
</div>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</form>
</center>
</body>

</html>
