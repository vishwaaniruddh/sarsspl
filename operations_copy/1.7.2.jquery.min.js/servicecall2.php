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
if(trackid.value=='')
{
alert("Please Enter ATMID");
atmid.focus();
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
if(authn.value=='')
{
alert("Please Enter Mailing Person Name");
authn.focus();
return false;
}
if(email.value=='')
{
alert("Please Enter Email ID");
email.focus();
return false;
}
if(sup.value=='')
{
alert("Please select Supervisor");
sup.focus();
return false;
}
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
if(matcnt.value=='' || matcnt.value<='0')
{
alert("Please Enter Material Count");
matcnt.focus();
return false;
}
/*if(memo.value=='')
{
alert("Please Enter some Description for this Quotation");
memo.focus();
return false;
}*/
//alert(x);
if(matcnt.value>0)
{
//alert(matcnt.value);

for(i=0;i<matcnt.value;i++)
{
//alert(document.getElementById("material"+[i]).value);
if(document.getElementById("material"+[i]).value!='-1')
{

/*if(document.getElementById("docno"+[i]).value=='')
{
alert("Please Enter Client Docket Number");
document.getElementById("docno"+[i]).focus();
return false;

}
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

}*/

//alert("hi");
x=x+1;

}
}
}
//alert(e.eventkey);
//alert(x);
if(x=='0')
{
alert("Please Enter Material Name");
return false;
}
var answer = confirm ("Dou you really want to submit this form?");
if (answer)
return true;
else
return false;

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
	//alert(xmlhttp.responseText);
	var str=xmlhttp.responseText;
	var st=str.split("****");
	//alert(st[0]+" "+st[1]);
	document.getElementById('trackid').value=st[0];
	document.getElementById('bk').value=st[1];
		document.getElementById('stype').value=st[2];
		document.getElementById('csslocalbr').value=st[3];
		document.getElementById('city').value=st[4];
		document.getElementById('address').value=st[5];
		document.getElementById('state').value=st[6];
		document.getElementById('authn').value=st[7];
		document.getElementById('connum').value=st[8];
		document.getElementById('email').value=st[9];
		document.getElementById('sup').value=st[10];
		document.getElementById('ccmail').value=st[11];
		gethistory(st[0],cid,val,st[2]);
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
function newwin(url,winname,w,h)
{
//var pos = $('#'+id).offset();
//alert(pos.);
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var targetWin = window.open (url, winname, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=1, resizable=yes, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
  //mywindow = window.open(url, winname, "location=400,status=1,scrollbars=1, width=500,height=400,left=350,top=200");
  
 }
function gethistory(trackerid,custid,atmid,stype)
  {
  //alert(trackerid+" "+custid+" "+atmid+" "+stype);
var cid=custid;
document.getElementById('history').innerHTML="<center></center>";
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
document.getElementById('history').innerHTML=xmlhttp.responseText;

    }
  }
// alert("getcustbank.php?val="+val);

 // var cid=document.getElementById('cust').value;
  // var atmid=document.getElementById('atmid').value;
  //  var trackid=document.getElementById('trackid').value;
//alert("getrnmhistory.php?trackid="+trackerid+"&custid="+custid+"&atmid="+atmid+"&stype="+stype);
xmlhttp.open("GET","getrnmhistory.php?trackid="+trackerid+"&custid="+custid+"&atmid="+atmid+"&stype="+stype,true);
xmlhttp.send();

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
	document.getElementById('now0').focus();
    }
  }

xmlhttp.open("GET","getmaterialcnt.php?val="+val,true);
xmlhttp.send();
	
}
function getmat(id,id2,id3,type)
{
//alert(id+" "+id2+" "+id3);
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
	
	document.getElementById(id3).innerHTML=xmlhttp.responseText;
	document.getElementById('mater2').innerHTML="";
    }
  }
//alert("getmaterial.php?val="+val);
var val='';
var val2='';
if(document.getElementById(id).value!='-1')
val=document.getElementById(id).value;
if(document.getElementById(id2).value!='-1')
val2=document.getElementById(id2).value;
xmlhttp.open("GET","getmaterial.php?val="+val+"&val2="+val2+"&type="+type,true);
xmlhttp.send();
	//alert("getmaterial.php?val="+val+"&val2="+val2+"&type="+type);
}
</script>

</head><body>

<center>
<?php include("menubar.php"); ?>
<h2>Service Call</h2>
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
$site="select atm_id1,bank, from rnmsites where id='".$quotro[4]."'";
else
$site="select atm_id1,bank from ".$str."_sites where trackerid='".$quotro[4]."'";

//echo $site;
$atm=mysqli_query($con,$site);

$atmro=mysqli_fetch_row($atm);
?>
<table border="1"><tr><td valign="top"><div  id="history" style="height:400px; width:200px; overflow:auto"><?php
$re=mysqli_query($con,"Select description from quotation where quotid='".$quotid."'");
$rer=mysqli_fetch_row($re);
echo "<b>Requirement :</b>".nl2br($rer[0]);
?></div></td><td valign="top">
<form name="requestamt" method="post" action="processquotcall2.php" onSubmit="return validate(this)">

<table>
<tr>

    	<td>Client</td>
        <td>
        <?php
	$qry=mysqli_query($con,"select short_name, contact_first from contacts where type='c' order by contact_first ASC");
		?>
        	<select name="bank" id="bank" tabindex="1"><option value="">SELECT Client</option>
            	<?php
			while($cl=mysqli_fetch_array($qry))
			{
			?>
            <option value="<?php  echo $cl[0]; ?>" <?php if($cl[0]==$_SESSION['custid']){ ?> selected="selected"<?php } ?>><?php  echo $cl[1]; ?></option>
            <?php
			}	
				?>
            </select>        </td>
<td>ATM ID</td>
        <td>
        	<input type="text" name="atmid" tabindex="2" id="atmid" value="<?php echo $atmro[0]; ?>" <?php if(isset($_GET['quotid'])){ ?> readonly="readonly" <?php } ?> <?php if(!isset($_GET['quotid'])){ ?>  onblur="getdetails(this.value,'atm_id');"<?php } ?>>    <?php if(isset($_GET['quotid'])){ } else{ ?> <br> <a href="newrnmsite.php" target="_new">New One Time RNM Site</a>  <?php } ?>  </td>

    </tr>
   
       
    <tr>
    	
   
    	<td>Bank</td>
        <td>
        	<input type="text" name="bk" id="bk"  value="<?php echo $atmro[1]; ?>">
           
        </td>
  
    	<td>CSS Local Branch</td>
        <td>
        	<input type="text" name="csslocalbr" id="csslocalbr" value="<?php echo $atmro[1]; ?>">
           <select name="state" id="state"><option value="">Select State</option>
           <?php $stt=mysqli_query($con,"select state from state order by state ASC");
           while($sttro=mysqli_fetch_row($stt))
           {
           ?>
           <option value="<?php echo $sttro[0]; ?>"><?php echo $sttro[0]; ?></option>
           <?php
           }
            ?>
           </select>
           <!--<input type="text" name="state" id="state" placeholder="State">-->
        </td>
      </tr>
    <tr>
    	<td>City</td>
        <td>
        	<input type="text" name="city" id="city"  value="<?php echo $atmro[1]; ?>">
           
        </td>
    
    	<td>Address</td>
        <td>
        	<textarea name="address" id="address"  ></textarea><input type="checkbox" name="updet" id="updet"> Click to update Details
           
        </td>
      </tr>
    <tr>
    	<td>Mailing Client Name</td>
        <td>
        	<input type="text" name="authn" id="authn" tabindex="3">        </td>
<td>Contact Number</td>
        <td>
        	<input type="text" name="connum" id="connum" tabindex="4">        </td></tr><tr>
<td colspan=2><table><tr><td>Email ID</td><td><input type="text" name="email" id="email" tabindex="5"></td></tr>
       <tr><td>CC mail IDs</td> <td>
        	<textarea name="ccmail" id="ccmail"></textarea>    </td></tr></table>   </td>

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
				   <option value="<?php echo $supro[0]; ?>" <?php if(($_SESSION['user']==$supro[0])){ echo "selected";}else{ if($quotro[19]==$supro[0]){ echo "selected";  }  }  ?> ><?php echo $supro[0]; ?></option>
			   <?php } 

?></select></td>

  </tr>
    <tr>
<td>Subject</td><td><input type="text" name="subject" id="subject" tabindex="7" /></td>
<td>Select Type</td><td><select name="type" id="type" tabindex="8">
  <option value="">Type</option>
  <?php if($_SESSION['designation']=='8'){ ?><option value="fixed">Fixed</option><?php } ?>
  <option value="R&M">Approval Basis</option>
</select></td>
</tr>
<tr>
  
    <tr>
    <td>Remark</td><td><textarea id="rem" name="rem" tabindex="9" /></textarea></td>
    <td>Enter Number of Materials</td><td><input type="text" id="matcnt" name="matcnt" onkeyup="onlynumbers();" value="0" onblur="gettext(this.value);" tabindex="10" /></td></tr>
    <tr><td colspan="4" id="mater2">
    </td></tr>
    <tr><td colspan="4" id="mater">
    </td></tr>
     <tr>
    	<td colspan="4" align="center"><input type="hidden" name="trackid" id="trackid" readonly="readonly" <?php if(isset($_GET['quotid'])){ ?> value="<?php  echo $quotro[4]; ?>"<?php } ?>>
<input type="hidden" name="stype" id="stype" readonly="readonly" <?php if(isset($_GET['quotid'])){ ?> value="<?php  echo $quotro[18]; ?>"<?php } ?>> <input type="hidden" name="department" id="department" value="3">
Call Priority: <select name="prio" id="prio">
<option value="Normal">Normal</option>
<option value="Medium">Medium</option>
<option value="High">High</option>
<option value="Very High">Very High</option>
</select>&nbsp;&nbsp;Deadline: 
<input type="text" name="est" id="est" value="<?php date('d/m/Y'); ?>" readonly="readonly" onclick="displayDatePicker('est');">
&nbsp;&nbsp;
<select name="time" id="time"><option value="">Select time</option>
<?php
for($i=1;$i<=12;$i++)
{
?>
<option value="<?php echo $i.":00:00"; ?>"><?php echo $i; ?></option>
<?php
}
?>

</select>

<select name="meri" id="meri"><option value="">Select</option>
<option value="am">am</option><option value="pm">pm</option>
</select>
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