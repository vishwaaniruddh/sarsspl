<?php
include("access.php");
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation']." ".$_SESSION['dept'];
//echo $_SESSION['custid'];
/*if($_SESSION['custid']=='all')
{
?>
<script type="text/javascript">
alert("You dont have access to this page.");
window.close();
</script>
<?php
}*/

define("ok","Fund Request Sent Successfully");
define("notok","Fund Request Failed");
//echo $_SESSION['user'];
//echo "user ".$_SESSION['userid'];
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
<script type="text/javascript">
function validate(form)
{
with(form)
{
var x=0;
/*if(subject.value=='')
{
alert("Please Enter Subject");
subject.focus();
return false;
}
if(type.value=='')
{
alert("Please select Type");
type.focus();
return false;
}
if(bank.value=='')
{
alert("Please Select Bank");
bank.focus();
return false;
}
if(department.value=='')
{
alert("Please Enter Department");
department.focus();
return false;
}
if(matcnt.value=='' || matcnt.value<='0')
{
alert("Please Enter Material Count");
matcnt.focus();
return false;
}*/
if(memo.value=='')
{
alert("Please Enter some Description for this Quotation");
memo.focus();
return false;
}
/*if(userfile.value=='')
{
alert("Please Upload Document received from Client");
userfile.focus();
return false;
}*/
/*if(po.value=='')
{
alert("Please Enter PO received from Client");
po.focus();
return false;
}*/
if(matcnt.value>0)
{
//alert(matcnt.value);

for(i=0;i<matcnt.value;i++)
{
//alert(document.getElementById("material"+[i]).value);
if(document.getElementById("material"+[i]).value!='')
{

/*if(document.getElementById("unit"+[i]).value=='')
{
alert("Please Enter Unit of this material");
document.getElementById("unit"+[i]).focus();
return false;

}*/
if(document.getElementById("qty"+[i]).value=='' || document.getElementById("qty"+[i]).value=='0')
{
alert("Please Enter Quantity of this material");
document.getElementById("qty"+[i]).focus();
return false;

}
if(document.getElementById("rate"+[i]).value=='')
{
alert("Please Enter rate of this material");
document.getElementById("rate"+[i]).focus();
return false;

}

//alert("hi");
x=x+1;

}
}
}
//alert(x);
if(x=='0')
{
alert("Please Enter Material Name");
return false;
}
return true;
}
}
function calc()
{
var matcnt=document.getElementById("matcnt").value;
if(matcnt>0)
{
var tot=0;
for(i=0;i<matcnt;i++)
{
tot=tot+Number(document.getElementById("qty"+[i]).value)*Number(document.getElementById("rate"+[i]).value);
tot=Number(tot);
//alert(document.getElementById("material"+[i]).value);

}
document.getElementById("quotamt").value=tot;
document.getElementById("appamt").value=tot;
}
}
function getdetails(val,type)
{
//alert(document.getElementById('cust').value);
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
	if(xmlhttp.responseText=='0')
	{
	alert("Site Not Found");
	document.getElementById('trackid').value='';
	}
	else
	{
	document.getElementById('trackid').value=xmlhttp.responseText;
	}

    }
  }
if(document.getElementById('bank').value=='' || val=='')
{
alert("Bank and Atmid is compulsory");
return false;
}
else
  {
  var cid=document.getElementById('bank').value;
//alert("getebdetails.php?val="+val+"&type="+type);
//alert("gettrackerid.php?val="+val+"&type="+type+'&cid='+cid);
xmlhttp.open("GET","gettrackerid.php?val="+val+"&type="+type+'&cid='+cid,true);
xmlhttp.send();
}
	
}
function getmat(id,id2,id3,type)
{
//alert(val+ " "+id );
document.getElementById('addmatsuc').innerHTML="<center><img src=loader.gif></center>";
//alert(document.getElementById('cust').value);
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
	
	document.getElementById(id3).innerHTML=xmlhttp.responseText;
	document.getElementById('addmatsuc').innerHTML="";
    }
  }

var val='';
var val2='';

if(document.getElementById(id).value!='-1')
val=document.getElementById(id).value;
if(document.getElementById(id2).value!='-1')
val2=document.getElementById(id2).value;
//alert("getmaterial.php?val="+val+"&val2="+val2+"&type="+type);
xmlhttp.open("GET","getmaterial.php?val="+val+"&val2="+val2+"&type="+type,true);
xmlhttp.send();
	
	
}
function gettext(val,id)
{
//alert(val+" "+id);
document.getElementById('mater').innerHTML="<center><img src=loader.gif></center>";
//alert(document.getElementById('cust').value);
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
	
	document.getElementById('mater').innerHTML=xmlhttp.responseText;
	
    }
  }
//alert("getquotmat.php?val="+val+"&id="+id);
xmlhttp.open("GET","getquotmat.php?val="+val+"&id="+id,true);
xmlhttp.send();
	
}

function removedet(id,stat,quotid,detid)
{
//alert(id+" status="+stat+" quotid= "+quotid+" detid="+detid);
//document.getElementById('mater').innerHTML="<center><img src=loader.gif></center>";
//alert(document.getElementById('cust').value);
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
	if(xmlhttp.responseText=='1'){
	document.getElementById('del'+id).innerHTML="<img src=images/done.jpg height=20px width=20px>";
	document.getElementById('matcnt').value=Number(document.getElementById('matcnt').value)-1;
	onblur=gettext(document.getElementById('matcnt').value,quotid);
	//document.getElementById('del'+id).innerHTML="Deleted";
	}
	else
	alert("Failed to Delete this Material");
	//document.getElementById('mater').innerHTML=xmlhttp.responseText;
	
    }
  }

xmlhttp.open("GET","delquotmat.php?id="+id+"&stat="+stat+"&quotid="+quotid,true);
xmlhttp.send();
	
}
function Addmat(id)
{
//alert(id);
//document.getElementById('mater').innerHTML="<center><img src=loader.gif></center>";
//alert(document.getElementById('cust').value);
var ast=document.getElementById('ast').value;
var mat=document.getElementById('mt').value;
var qu=document.getElementById('qu').value;
var rt=document.getElementById('rt').value;
var un=document.getElementById('un').value;
//var suprate=document.getElementById('suprt').value;
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
	if(xmlhttp.responseText=='1'){
document.getElementById("addmatsuc").innerHTML="<img src=images/done.jpg height=20px width=20px>";
	document.getElementById('matcnt').value=Number(document.getElementById('matcnt').value)+1;
	onblur=gettext(document.getElementById('matcnt').value,id);
	//document.getElementById('del'+id).innerHTML="<img src=images/done.jpg height=20px width=20px>";
	
	//document.getElementById('del'+id).innerHTML="Deleted";
	}
	else
	alert("Failed to Delete this Material");
	//document.getElementById('mater').innerHTML=xmlhttp.responseText;
	
    }
  }
if(mat!='' && rt!='' && qu!='')
{
//alert("addnewmaterial.php?id="+id+"&mat="+mat+"&rt="+rt+"&qu="+qu+"&un="+un);
xmlhttp.open("GET","addnewmaterial.php?id="+id+"&mat="+mat+"&rt="+rt+"&qu="+qu+"&un="+un+"&asst="+ast,true);
xmlhttp.send();
}
else
alert("All fields are mandatory");
	
}

</script>

</head><body>

<center>
<?php include("menubar.php"); ?>
<h2>Rejection Confirmation </h2>
<?php
include("config.php");

 $quotid=$_GET['detid'];
 //echo "Select * from quotation where quotid=select quotid from quot_details where quotdetid='".$quotid."'";
$quot=mysqli_query($con,"Select * from quotation where quotid=(select quotid from quot_details where quotdetid='".$quotid."')");
$quotro=mysqli_fetch_row($quot);
//echo "select atm_id1 from ".$quotro[3]."_sites where trackerid='".$quotro[3]."'";
$del=mysqli_query($con,"select status from quot_details where quotdetid='".$quotid."'");
$delro=mysqli_fetch_row($del);
if($delro[0]=="1")
echo "<script type='text/javascript'>alert('This material has already been removed. Please Refresh the page to see the changes'); window.close();</script>";
$str=$quotro[3];
$site='';
if($quotro[18]=='rnmsites')
$site="select atm_id1 from rnmsites where id='".$quotro[4]."'";
else
$site="select atm_id1 from ".$str."_sites where trackerid='".$quotro[4]."'";

//echo $site;
$atm=mysqli_query($con,$site);
$atmro=mysqli_fetch_row($atm);
?>

<form name="requestamt" method="post" action="procremdetqt.php" onSubmit="return validate(this)" enctype="multipart/form-data">

<table><tr>
<td>Subject</td><td><input type="text" name="subject" id="subject" value="<?php echo $quotro[11]; ?>" readonly="readonly" /></td></tr>

<tr>
<td>Select Type</td><td><select name="type" id="type">
  <option value="">Type</option>
  <?php if($_SESSION['designation']=='8'){ ?><option value="fixed" <?php if($quotro[12]=="fixed") echo "selected"; ?>>Fixed</option><?php } ?>
  <option value="R&M" <?php if($quotro[12]=="R&M") echo "selected"; ?>>Repair & Maintenance</option>
</select></td>
</tr>
	<tr>
    	<td>Select Bank</td>
        <td>
        <?php
		
		$qry=mysqli_query($con,"select short_name, contact_first from contacts where type='c' and short_name='".$quotro[3]."'");
		$cl=mysqli_fetch_array($qry);
		?>
        	<input type="text" name="bank" id="bank" value="<?php echo $cl[1]; ?>" readonly="readonly">
        </td>
    </tr>
   <tr>
    	<td>Select Type</td>
        <td>
        <?php
		include("config.php");
		//echo "select `deptid`, `desc` from department where (deptid='2' OR deptid='3')";
		$tp=mysqli_query($con,"select `deptid`, `desc` from department where deptid='".$quotro[10]."'");
			$tpro=mysqli_fetch_array($tp);
		?>
        <input type="text" name="department" id="department" value="<?php echo $tpro[1]; ?>" readonly="readonly" > </td>
    </tr>
    <tr>
    	<td>ATM ID</td>
        <td>
        	<input type="text" name="atmid" id="atmid" value="<?php echo $atmro[0]; ?>" readonly="readonly">        </td>
    </tr>
    
    <tr>
    	<td>Remark</td>
        <td>
        	<textarea name="memo" id="memo" rows="10" cols="30"></textarea>        </td>
    </tr>
   <?php if($_SESSION['designation']=='8'){ ?> <tr><td>Concerned Person Name</td><td><input type="text" id="authn" name="authn" value="<?php echo $quotro[15]; ?>" readonly /></td></tr>
     <tr><td>PO Number</td><td><input type="text" id="po" name="po" /></td></tr>
     <tr><td>Client Approval Date(dd/mm/yyyy)</td><td><input type="text" id="appdate" name="appdate" value="<?php if($quotro[23]!='0000-00-00'){ echo date('dd/mm/yyyy',strtotime($quotro[23]));  } ?>" /></td></tr>
      <tr><td>Upload Confirmation Document</td><td><input type="file" id="userfile" name="userfile" /></td></tr>
      <?php } ?>
   
     <tr>
    	<td colspan="2" align="center">
        <input type="hidden" name="quot" id="quot" value="<?php echo $_GET['detid']; ?>" readonly="readonly">
        	<input type="submit" name="submit" id="submit"><!--<a href="javascript:if(confirm('Close window?'))window.close()">cancel</a>-->        </td>
    </tr>
</table>
</form></center><?php
if(isset($_SESSION['success']))
unset($_SESSION['success']);

if(isset($_SESSION['error']))
unset($_SESSION['error']);

?>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body></html>