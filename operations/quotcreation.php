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
if(subject.value=='')
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
alert("Please Select Client");
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
}
if(memo.value=='')
{
alert("Please Enter some Description for this Quotation");
memo.focus();
return false;
}
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
if(document.getElementById("rate"+[i]).value=='' )
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
if(x=='0')
{
alert("Please Enter Material Name");
return false;
}
return true;
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
	var conf = confirm("Site Not Found, Do You want to Add This site for RNM?");

    if(conf == true){

        window.location="newrnmsite.php";

    }
    else
	{
	document.getElementById('trackid').value='';
	}
	}
	else
	{
	var str=xmlhttp.responseText;
	var st=str.split("****");
	//alert(st[0]+" "+st[1]);
	document.getElementById('trackid').value=st[0];
	document.getElementById('bk').value=st[1];
		document.getElementById('stype').value=st[2];
	}

    }
  }
if(document.getElementById('bank').value=='' || val=='')
{
alert("Client and Atmid is compulsory");
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

function gettext(val)
{
document.getElementById('mater2').innerHTML="<center><img src=loader.gif></center>";
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
	document.getElementById('mater2').innerHTML="";
    }
  }

xmlhttp.open("GET","getmaterialcnt.php?val="+val,true);
xmlhttp.send();
	
}
function getmat(val,id)
{
//alert(val+ " "+id );
document.getElementById('mater2').innerHTML="<center><img src=loader.gif></center>";
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
	
	document.getElementById(id).innerHTML=xmlhttp.responseText;
	document.getElementById('mater2').innerHTML="";
    }
  }
//alert("getmaterial.php?val="+val);
xmlhttp.open("GET","getmaterial.php?val="+val,true);
xmlhttp.send();
	
}
</script>

</head><body>

<center>
<?php include("menubar.php"); ?>
<h2>Quotation Creation</h2>
<?php
include("config.php");
if(isset($_SESSION['success']))
echo "<div style='background: lightgreen'><h3>". ok."</h3></div>";
if(isset($_SESSION['error']))
echo "<div style='background:#FF0000'><h3>". notok."</h3></div>";

 $quotid=$_GET['quotid'];
$quot=mysqli_query($con,"Select * from quotation where quotid='".$quotid."'");
$quotro=mysqli_fetch_row($quot);
//echo "select atm_id1 from ".$quotro[3]."_sites where trackerid='".$quotro[3]."'";
$str=$quotro[3];
//echo "select atm_id1 from ".$str."_sites where trackerid='".$quotro[4]."'";
$site='';
if($quotro[18]=='rnmsites')
$site="select atm_id1,bank from rnmsites where id='".$quotro[4]."'";
else
$site="select atm_id1,bank from ".$str."_sites where trackerid='".$quotro[4]."'";

//echo $site;
$atm=mysqli_query($con,$site);

$atmro=mysqli_fetch_row($atm);
?>
<table><tr><td valign="top"><?php
$re=mysqli_query($con,"Select description from quotation where quotid='".$quotid."'");
$rer=mysqli_fetch_row($re);
echo "<b>Requirement :</b>".nl2br($rer[0]);
?></td><td>
<form name="requestamt" method="post" action="procquotcreation.php" onSubmit="return validate(this)">

<table>
<tr><td>Select Account</td>
<td><?php
$st="select srno,username from login where 1";
if($_SESSION['designation']=='8' && $_SESSION['dept']=='4')
$st.=" and designation='11' and deptid='4' order by username ASC";
else
$st.=" and username='".$_SESSION['user']."'";
//echo $st;
$sup=mysqli_query($con,$st);
//echo $quotro[18];
?>
<select name="super" id="sup">

<?php
/*if($_SESSION['designation']=='8' && $_SESSION['dept']=='4')
{*/
?>
<option value="">Select Account</option>
<?php
//}
 
			 //  $sup=mysqli_query($con,"select username from login where designation='11' and serviceauth='3' and deptid='4' order by username ASC");
			 $sup=mysqli_query($con,"select distinct(hname) from fundaccounts order by hname ASC");
				 while($supro=mysqli_fetch_array($sup))
				{ ?>
				   <option value="<?php echo $supro[0]; ?>" <?php if(($_SESSION['user']==$supro[0])){ echo "selected";}else{ if($quotro[19]==$supro[0]){ echo "selected";  }  }  ?> ><?php echo $supro[0]; ?></option>
			   <?php } 
/*while($supro=mysqli_fetch_array($sup))
{
?>
<option value="<?php echo $supro[1]; ?>"><?php echo $supro[1]; ?></option>
<?php
}*/
?></select></td></tr>
<tr>
<td>Subject</td><td><input type="text" name="subject" id="subject" /></td></tr>
<tr>
<td>Select Type</td><td><select name="type" id="type">
  <option value="">Type</option>
  <?php if($_SESSION['designation']=='8'){ ?><option value="fixed">Fixed</option><?php } ?>
  <option value="R&M">Repair & Maintenance</option>
</select></td>
</tr>
	<tr>
    	<td>Client</td>
        <td>
        <?php
		
		
		
		
		$qry=mysqli_query($con,"select short_name, contact_first from contacts where type='c' order by contact_first ASC");
		?>
        	<select name="bank" id="bank"><option value="">SELECT Client</option>
            	<?php
			while($cl=mysqli_fetch_array($qry))
			{
			?>
            <option value="<?php  echo $cl[0]; ?>" <?php if($cl[0]==$quotro[3]){ ?> selected="selected"<?php } ?>><?php  echo $cl[1]; ?></option>
            <?php
			}	
				?>
            </select>        </td>
    </tr>
   
       
    <tr>
    	<td>ATM ID</td>
        <td>
        	<input type="text" name="atmid" id="atmid" value="<?php echo $atmro[0]; ?>" <?php if(isset($_GET['quotid'])){ ?> readonly="readonly" <?php } ?> <?php if(!isset($_GET['quotid'])){ ?>  onblur="getdetails(this.value,'atm_id1');"<?php } ?>>    <?php if(isset($_GET['quotid'])){ } else{ ?>  <a href="newrnmsite.php" target="_new">New One Time RNM Site</a>  <?php } ?>  </td>
    </tr>
 <tr>
    	<td>Bank</td>
        <td>
        	<input type="text" name="bk" id="bk" readonly="readonly" value="<?php echo $atmro[1]; ?>">
           
        </td>
    </tr>
     <tr>
    	<td>Mailing Client Name</td>
        <td>
        	<input type="text" name="authn" id="authn">        </td>
    </tr>
    <tr>
    	<td>Memo</td>
        <td>
        	<textarea name="memo" id="memo" rows="10" cols="30"></textarea>        </td>
    </tr>
    <tr><td>Enter Number of Materials</td><td><input type="text" id="matcnt" name="matcnt" onkeyup="onlynumbers();" value="0" onblur="gettext(this.value);" /></td></tr>
    <tr><td colspan="2" id="mater2">
    </td></tr>
    <tr><td colspan="2" id="mater">
    </td></tr>
     <tr>
    	<td colspan="2" align="center"><input type="hidden" name="trackid" id="trackid" readonly="readonly" <?php if(isset($_GET['quotid'])){ ?> value="<?php  echo $quotro[4]; ?>"<?php } ?>>
<input type="hidden" name="stype" id="stype" readonly="readonly" <?php if(isset($_GET['quotid'])){ ?> value="<?php  echo $quotro[18]; ?>"<?php } ?>> <input type="hidden" name="department" id="department" value="3">
        <input type="hidden" name="quot" id="quot" value="<?php echo $_GET['quotid']; ?>" readonly="readonly">
        	<input type="submit" name="submit" id="submit"><!--<a href="javascript:if(confirm('Close window?'))window.close()">cancel</a>-->        </td>
    </tr>
</table>
</form>
</td></tr></table>
</center><?php
unset($_SESSION['success']);
unset($_SESSION['error']);

?>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body></html>