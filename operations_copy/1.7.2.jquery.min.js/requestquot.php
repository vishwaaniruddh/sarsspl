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
include("config.php");
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
if(cust.value=='')
{
alert("Please Select Client");
cust.focus();
return false;
}
if(department.value=='')
{
alert("Please Enter Department");
department.focus();
return false;
}
if(atmid.value=='')
{
alert("Please Enter ATM ID");
atmid.focus();
return false;
}
if(trackid.value=='')
{
alert("Please Enter Valid ATM ID");
trackid.focus();
return false;
}
if(memo.value=='')
{
alert("Please Enter some Description for this Quotation");
memo.focus();
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
	document.getElementById('bank').value=st[1];
		document.getElementById('stype').value=st[2];
	}

    }
  }
if(document.getElementById('cust').value=='' || val=='')
{
alert("Client and Atmid is compulsory");
return false;
}
else
  {
  var cid=document.getElementById('cust').value;
//alert("getebdetails.php?val="+val+"&type="+type);
//alert("gettrackerid.php?val="+val+"&type="+type+'&cid='+cid);
xmlhttp.open("GET","gettrackerid.php?val="+val+"&type="+type+'&cid='+cid,true);
xmlhttp.send();
}
	
}
</script>

</head><body>

<center>
<?php include("menubar.php"); ?>
<h2>Quotation & Fund Request</h2>
<?php
if(isset($_SESSION['success']))
echo "<div style='background: lightgreen'><h3>". ok."</h3></div>";
if(isset($_SESSION['error']))
echo "<div style='background:#FF0000'><h3>". notok."</h3></div>";
?>
<form name="requestamt" method="post" action="processquot.php" onSubmit="return validate(this)">

<table>

<tr><td>Supervisor</td>
<td><?php
$st="select srno,username from login where 1";
if($_SESSION['designation']=='8' && $_SESSION['dept']=='4')
$st.=" and designation='11' and deptid='4' order by username ASC";
else
$st.=" and username='".$_SESSION['user']."'";
//echo $st;
$sup=mysqli_query($con,$st);

?>
<select name="super" id="sup">

<?php
/*if($_SESSION['designation']=='8' && $_SESSION['dept']=='4')
{*/
?>
<option value="">Select Supervisor</option>
<?php
/*}
while($supro=mysqli_fetch_array($sup))
{
?>
<option value="<?php echo $supro[1]; ?>"><?php echo $supro[1]; ?></option>
<?php
}*/

 $sup=mysqli_query($con,"select distinct(hname) from fundaccounts order by hname ASC");
				 while($supro=mysqli_fetch_array($sup))
				{ ?>
				   <option value="<?php echo $supro[0]; ?>" <?php if(($_SESSION['user']==$supro[0])){ echo "selected";}  ?> ><?php echo $supro[0]; ?></option>
			   <?php } ?>
</select></td></tr>


	<tr>
    	<td>Select Client</td>
        <td>
        
        
        
        <?php
		include("config.php");
		
		$cust=array();
$cust=explode(",",$_SESSION['custid']);
$cl='';
//print_r($cust);

for($i=0;$i<count($cust);$i++)
{
//echo $cust[i]." ".$i."<br>";
if($i==0)
$cl="'".$cust[$i]."'";
elseif($i==(count($cust)-1))
$cl.=",'".$cust[$i]."'";
else
$cl.=",'".$cust[$i]."'";

//echo $cl;
}
//echo $cl;
//echo $_SESSION['user']." ".$_SESSION['custid'];
if($_SESSION['designation']!='8' && $_SESSION['dept']=='4')
$sql2="select distinct `cust_id` from quotation where 1";
if($_SESSION['custid']!='all')
$sql2.=" and `cust_id` in (".$cl.")";
/*else
$sql2.=" and quotby = (select srno from login where username like '".$_SESSION['user']."')";*/
//echo $sql2;
$sql="select `short_name`,`contact_first` from contacts where `type`='c'";
if($_SESSION['designation']=='8' && $_SESSION['dept']=='4')
$sql.="  and `short_name` in ($cl)";

$sql.=" order by contact_first ASC";
//echo $sql;
$qry=mysqli_query($con,$sql);
//$qry=mysqli_query($con,"Select short_name,contact_first from contacts where type='c' and short_name='".$_SESSION['custid']."'");
//echo $_SESSION['designation']." ".$_SESSION['dept'];
 ?>
 <select  name="cust" id="cust">

<?php
if($_SESSION['designation']=='11' && $_SESSION['dept']=='4')
{
?>
<option value="">Select Client</option>
<?php
}
while($clro=mysqli_fetch_row($qry))
{
?>
<option value="<?php echo $clro[0]; ?>"><?php echo $clro[1]; ?></option>
<?php
}
?>
</select>
		
		
		
		
		
		
		<!--<?php
		$qry=mysqli_query($con,"select short_name, contact_first from contacts where type='c' order by contact_first ASC");
		?>
        	<select name="cust" id="cust"><option value="">SELECT Client</option>
            	<?php
			while($cl=mysqli_fetch_array($qry))
			{
			?>
            <option value="<?php  echo $cl[0]; ?>" <?php if($_SESSION['custid']==$cl[0]){ ?>selected="selected"<?php } ?> onchange="return false"><?php  echo $cl[1]; ?></option>
            <?php
			}	
				?>
            </select>-->
        </td>
    </tr>
    <tr>
    	<td>ATM ID</td>
        <td>
        	<input type="text" name="atmid" id="atmid" onblur="getdetails(this.value,'atm_id1')"><a href="newrnmsite.php">New One Time RNM Site</a> 
           
        </td>
    </tr>
    <tr>
    	<td>Bank</td>
        <td>
        	<input type="text" name="bank" id="bank" readonly="readonly">
           
        </td>
    </tr>
   <tr>
    	<td>Select Type</td>
        <td>
        <?php
		include("config.php");
		//echo "select `deptid`, `desc` from department where (deptid='2' OR deptid='3')";
		$tp=mysqli_query($con,"select `deptid`, `desc` from department where deptid='3'");
			if(!$tp)
			echo mysqli_error();


		?>
        <select name="department" id="department">
        	<?php
			
			while($tpro=mysqli_fetch_array($tp))
			{
			?>
            <option value="<?php echo $tpro[0]; ?>"><?php echo $tpro[1]; ?></option>
            <?php
			}
			?>
           </select>
        </td>
    </tr>
    
    <tr>
    	<td>Memo</td>
        <td>
        	<textarea name="memo" id="memo" rows="10" cols="30"></textarea>
        </td>
    </tr>
     <tr>
    	<td colspan="2" align="center">
        <input type="text" name="trackid" id="trackid" readonly="readonly"><input type="text" name="stype" id="stype" readonly="readonly">

        	<input type="submit" name="submit" id="submit"><!--<a href="javascript:if(confirm('Close window?'))window.close()">cancel</a>-->
        </td>
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