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
function calc2()
{
var matcnt=document.getElementById("matcnt").value;
if(matcnt>0)
{
var tot=0;
for(i=0;i<matcnt;i++)
{
tot=tot+Number(document.getElementById("suprate"+[i]).value)*Number(document.getElementById("qty"+[i]).value);
tot=Number(tot);
//alert(document.getElementById("material"+[i]).value);

}
document.getElementById("supamt").value=tot;

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
var txt=xmlhttp.responseText
	var str=txt.split("###$$$^^^");
	//alert(str[1]);
	document.getElementById('mater').innerHTML=str[0];
	document.getElementById('quotamt').value=str[1];
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
if (confirm('Are you sure you want to remove this material?')) {
    // Save it!

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
}
function Addmat(id)
{
//alert(id);
//document.getElementById('mater').innerHTML="<center><img src=loader.gif></center>";
//alert(document.getElementById('cust').value);
var now=escape(document.getElementById('now').value);
var ast=escape(document.getElementById('ast').value);
var mat=escape(document.getElementById('mt').value);
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
	else if(xmlhttp.responseText=='0')
	alert("Failed to Delete this Material");
	else if(xmlhttp.responseText=='10')
	alert("Sorry, your session has Expired. You need to login again");
	//document.getElementById('mater').innerHTML=xmlhttp.responseText;
	
    }
  }
if(mat!='' && rt!='' && qu!='')
{
//alert("addnewmaterial.php?id="+id+"&mat="+mat+"&rt="+rt+"&qu="+qu+"&un="+un+"&asst="+ast+"&now="+now);
//alert("addnewmaterial.php?id="+id+"&mat="+mat+"&rt="+rt+"&qu="+qu+"&un="+un);
xmlhttp.open("GET","addnewmaterial.php?id="+id+"&mat="+mat+"&rt="+rt+"&qu="+qu+"&un="+un+"&asst="+ast+"&now="+now,true);
xmlhttp.send();
}
else
alert("All fields are mandatory");
	
}

</script>

</head><body>

<center>
<?php include("menubar.php"); ?>
<h2>Edit Quotation </h2>
<?php
include("config.php");
if(isset($_SESSION['success']))
echo "<div style='background: lightgreen'><h3>". ok."</h3></div>";
if(isset($_SESSION['error']))
echo "<div style='background:#FF0000'><h3>". notok."</h3></div>";

 $quotid=$_GET['quotid'];
 //echo "Select * from quotation where quotid='".$quotid."'";
$quot=mysqli_query($con,"Select * from quotation where quotid='".$quotid."'");
$quotro=mysqli_fetch_row($quot);
//echo "select atm_id1 from ".$quotro[3]."_sites where trackerid='".$quotro[3]."'";
$str=$quotro[3];
$site='';
if($quotro[18]=='rnmsites')
$site="select atm_id1 from rnmsites where id='".$quotro[4]."'";
else
$site="select atm_id1 from ".$str."_sites where trackerid='".$quotro[4]."'";

//echo $site;
$atm=mysqli_query($con,$site);
$atmro=mysqli_fetch_row($atm);
if($_SESSION['designation']=='8')
{
?>

<table><tr><td align="center">Add New Material<br><div align="center" id="addmatsuc"></div></td></tr>
<tr><td>

<?php 
	$asst="select distinct(now) from atmassets  order by now ASC";
	?>
	
	<select name="now" id="now" onchange="getmat('now','ast','ast','asset');" style="width:100px;">
<option value="" >Nature Of Work</option>
	<?php $query=mysqli_query($con,$asst);
	while($row=mysqli_fetch_array($query))
	{
	?>
	<option value="<?php echo $row[0];  ?>" ><?php echo $row[0];  ?></option>
	<?php
	}
	 ?>
	 
	 </select>&nbsp;&nbsp;

<?php 
	$asst="select distinct(problem) from atmassets where problem<>'' order by problem ASC";
	?>
	
	<select name="ast" id="ast" onchange="getmat('now','ast','mt','material');" style="width:100px;">
<option value="" >Select Component</option>
	<?php $query=mysqli_query($con,$asst);
	while($row=mysqli_fetch_array($query))
	{
	?>
	<option value="<?php echo $row[0];  ?>" ><?php echo $row[0];  ?></option>
	<?php
	}
	 ?>
	 
	 </select>&nbsp;&nbsp;<select name="mt" id="mt" width="200px">
<option value="">Select Material</option>
</select>&nbsp;&nbsp;

<input type="text" name="qu" id="qu" placeholder="Quantity" value="1" size="5px">
<input type="text" name="un" id="un" placeholder="Unit" size="5px">
<input type="text" name="rt" id="rt" placeholder="Rate" size="5px" style='text-align:right'>
<!--<td><input type="text" name="suprt" id="suprt" value="0" style='text-align:right'  size="5px"/></td>-->
<td><input type="button" id="butmat" onclick="Addmat('<?php echo $quotid; ?>');" value="Add Material">
</td></tr>
</table><?php } ?>
<table><tr><td valign="top"><?php
//echo "select * from quotapproval where quotid='".$quotid."' order by appid DESC";
$remquot=mysqli_query($con,"select * from quotapproval where quotid='".$quotid."' order by appid DESC");
if(mysqli_num_rows($remquot)>0)
{
?>
<table><tr><th>Date/Time</th><th>Update By</th><th>Remark</th></tr>
<?php
while($rem=mysqli_fetch_array($remquot))
{
$re=explode("***###",$rem[4]);
?>
<tr><td><?php echo date("d/m/y H:i:s a",strtotime($rem[3])); ?></td><td><?php echo $rem[2]; ?></td><td><?php echo nl2br($re[0]); ?></td></tr>
<?php
}
}
?></table>
</td><td valign="top">
<form name="requestamt" method="post" action="procesditquote2.php" onSubmit="return validate(this)" enctype="multipart/form-data">

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
        	<textarea name="memo" id="memo" rows="5" cols="50"></textarea>        </td>
    </tr>
    
   <?php if($_SESSION['designation']=='8'){ ?>
   <tr>
    <td>Select Supervisor</td>
<td><?php
$st="select srno,username from login where 1";
if($_SESSION['designation']=='8' && $_SESSION['dept']=='4')
$st.=" and designation='11' and deptid='4' order by username ASC";
else
$st.=" and username='".$_SESSION['user']."'";
$sup=mysqli_query($con,$st);

?>
<select name="super" id="sup" tabindex="6">
<option value="">Select Supervisor</option>
<?php
			 $sup=mysqli_query($con,"select distinct(hname) from rnmfundaccounts order by hname ASC");
				 while($supro=mysqli_fetch_array($sup))
				{ ?>
				   <option value="<?php echo $supro[0]; ?>" <?php if(($quotro[19]==$supro[0])){ echo "selected";}else{ if($quotro[19]==$supro[0]){ echo "selected";  }  }  ?> ><?php echo $supro[0]; ?></option>
			   <?php } 

?></select></td>

  </tr>
    <tr><td>Concerned Person Name</td><td><input type="text" id="authn" name="authn" value="<?php echo $quotro[28]; ?>" readonly /></td></tr>
     <tr><td>PO Number</td><td><input type="text" id="po" name="po" /></td></tr>
     <tr><td>Client Approval Date(dd/mm/yyyy)</td><td><input type="text" id="appdate" name="appdate" value="<?php if($quotro[23]!='0000-00-00'){ echo date('d/m/Y',strtotime($quotro[23]));  } ?>" />&nbsp;&nbsp;Approved by:<input type="text" id="appcl" name="appcl" value="<?php echo $quotro[15]; ?>" /></td></tr>
      <tr><td>Upload Confirmation Document</td><td><input type="file" id="userfile" name="userfile" /><input type="hidden" id="userfile2" name="userfile2" value="<?php echo $quotro[14]; ?>" /><?php echo $quotro[14]; ?></td></tr>
      <?php } ?>
    <tr><td>Number of Materials</td><td><input type="text" id="matcnt" name="matcnt" onkeyup="onlynumbers();" value="<?php echo $quotro[13]; ?>" readonly="readonly" /></td></tr>
    <tr><td colspan="2" id="mater2">
    </td></tr>
    <tr><td colspan="2" id="mater">
    <table width="100%"><tr><td align="center">Sr No</td><td align="center">Component</td><td align="center">Material</td><td align="center">Remark</td><td align="center">Quantity</td><td align="center">Unit</td><td align="center"> Rate</td><?php if($_SESSION['designation']=='8'){ ?><td align="center">Supervisor Rate</td><?php  } ?><td></td></tr>
    
    <?php 
	$i=0;
	$j=0;
	$quottot=0;
	$det=mysqli_query($con,"select * from quot_details where quotid='".$quotid."' and status='0' order by quotdetid ASC");
	while($detro=mysqli_fetch_row($det)){
//echo "select incquot from atmassets where now='".$detro[9]."' and problem='".$detro[7]."' and description='".$detro[2]."' ";
	$ck=mysqli_query($con,"select incquot from atmassets where now='".$detro[9]."' and problem='".$detro[7]."' and description='".$detro[2]."' ");
$ckro=mysqli_fetch_row($ck);
	?>
	<tr><td><?php echo $j=$j+1; ?><?php if($ckro[0]=='0'){ ?> <input type="checkbox" name="" onclick="removedet('<?php echo $detro[0]; ?>','1','<?php echo $quotid; ?>','idq<?php echo $i; ?>');"> <?php } ?></td>
	<td><?php 
	$asst="select distinct(problem) from atmassets where problem<>'' order by problem ASC";
	?>
	
	<select name="asst[]" id="asst<?php echo $i; ?>" onchange="getmat(this.value,'material<?php echo $i; ?>');" style="width:100px;">
	<?php /*$query=mysqli_query($con,$asst);
	while($row=mysqli_fetch_array($query))
	{
	?>
	<option value="<?php echo $row[0];  ?>" <?php if($row[0]==$detro[7]){ echo "selected"; }  ?>><?php echo $row[0];  ?></option>
	<?php
	}*/
	 ?>
	 <option value="<?php echo $detro[7];  ?>" ><?php echo $detro[7];  ?></option>
	 </select></td>
	
    <td>
    <input type="hidden" name="id[<?php echo $i; ?>]" value="<?php echo $detro[0]; ?>" readonly="readonly" id="idq<?php echo $i; ?>" />
    <select name="material[]" id="material<?php echo $i; ?>" />
    <option value="<?php echo $detro[2]; ?>"><?php echo $detro[2]; ?></option>
    </select></td>
<td><input type="text" name="remmm[]" id="remmm<?php echo $i; ?>" value="<?php echo $detro[12]; ?>" /></td>
<td><input type="text" name="qty[]" id="qty<?php echo $i; ?>" value="<?php echo $detro[3]; ?>" <?php if($ckro[0]=='0'){ echo "readonly"; } ?>/></td>
     <td><input type="text" name="unit[]" id="unit<?php echo $i; ?>" value="<?php echo $detro[4]; ?>" <?php if($ckro[0]=='0'){ echo "readonly"; } ?> /></td>
    
    <td><input type="text" name="rate[]" id="rate<?php echo $i; ?>" value="<?php echo round($detro[5]); ?>" style='text-align:right' onkeyup="calc();"  <?php if($ckro[0]=='0'){ echo "readonly"; } ?>/></td>
    <?php if($_SESSION['designation']=='8'){ ?><td><input type="text" name="suprate[]" id="suprate<?php echo $i; ?>" value="<?php if($detro[8]==0){ echo round($detro[5]); }else echo round($detro[8]); ?>" style='text-align:right' onkeyup="calc2();" <?php if($ckro[0]=='0'){ echo "readonly"; } ?> /> </td><?php } ?>
    <td><div id="del<?php echo $detro[0];  ?>">
    <!-- onclick="removedet('<?php echo $detro[0]; ?>','1','<?php echo $quotid; ?>','idq<?php echo $i; ?>');" -->
	<?php if($_SESSION['designation']=='8'){ ?><a href="removequotmat.php?detid=<?php echo $detro[0]; ?>" target="_blank"><img src="images/delete.jpg" height="20px" width="20px"></a><?php } ?></div>
	</td>
    </tr>
	<?php
	$quottot=$quottot+($detro[5]*$detro[3]);
	$suptot=$suptot+($detro[8]*$detro[3]);
	$i=$i+1;
	} ?>
    </table>
    </td></tr>
    <tr><td>Quotation Amount</td><td><input type="text" id="quotamt" name="quotamt" value="<?php echo $quottot; ?>" readonly />&nbsp;&nbsp;
    Supervisor Amount:<input type="text" id="supamt" name="supamt" value="<?php echo $suptot; ?>" readonly />
    </td></tr>
    <tr><td>Amount Approved By Client</td><td><input type="text" id="appamt" name="appamt" value="<?php echo $quotro[8]; ?>" /></td></tr>
     <tr>
    	<td colspan="2" align="center">
    	<input type="hidden" name="upstat" id="upstat" value="<?php echo $_GET['st']; ?>" readonly="readonly">
        <input type="hidden" name="quot" id="quot" value="<?php echo $_GET['quotid']; ?>" readonly="readonly">
        	<input type="submit" name="submit" id="submit"><!--<a href="javascript:if(confirm('Close window?'))window.close()">cancel</a>-->        </td>
    </tr>
</table>
</form></td></tr></table></center><?php
if(isset($_SESSION['success']))
unset($_SESSION['success']);

if(isset($_SESSION['error']))
unset($_SESSION['error']);

?>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body></html>