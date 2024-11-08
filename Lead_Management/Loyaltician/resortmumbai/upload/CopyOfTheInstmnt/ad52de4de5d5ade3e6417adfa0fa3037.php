<?php
//session_start();
include("access.php");
 //echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation']." ".$_SESSION['dept'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSS<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script src="excel.js" type="text/javascript"></script>
<script type="text/javascript">
function isNumberKey(evt)
{
var charCode = (evt.which) ? evt.which : event.keyCode;
if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
return false;
 
return true;
}
function getbank(val,type)
{
	//alert(val);

//alert(num);
//	document.getElementById('image').innerHTML="<img src='loading.gif' width='100px' height='50px'>";
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
	document.getElementById('bank').innerHTML='';
	document.getElementById('bank').innerHTML=xmlhttp.responseText;
	
	getproject(val,'projectid');
	
    }
  }

xmlhttp.open("GET","getcustbank.php?val="+val+"&type="+type,true);
xmlhttp.send();
//alert("getcustbank.php?val="+val+"&type="+type);
	
}
function getproject(val,type)
{
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
document.getElementById('proj').innerHTML='';
	document.getElementById('proj').innerHTML=xmlhttp.responseText;
	
	
    }
  }

//alert("getebillproj.php?val="+val+"&type="+type);
xmlhttp.open("GET","getebillproj_threshhold.php?val="+val+"&type="+type,true);
xmlhttp.send();

	
}
function getthreshhold()
{
	var cid=document.getElementById('cid').value;
	var bank=document.getElementById('bank').value;
	var proj=document.getElementById('proj').value;
	if(cid!='' && bank!='' && proj!='')
	{
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
				var s=xmlhttp.responseText;
				var s2=s.split("###$$$");
				if(s2[0]=='y')
				{
					document.getElementById('threshhold').value=s2[1];
				}
				else
				{
					document.getElementById('threshhold').value='';
				}
				//document.getElementById('datahere').innerHTML=s;
			}
		}
		xmlhttp.open("GET","getthreshhold.php?cid="+cid+"&bank="+bank+"&proj="+proj,true);
		xmlhttp.send();
	}

	
}
function validate(form)
{
with(form)
{
if(confirm("Are you sure you want to Update Threshhold."))
return true;

return false;
}
}
</script>
</head>
<body>
<center>
<?php include("menubar.php"); ?>

<h2 class="h2color">Add Threshhold</h2>
</center>
<?php
	if(isset($_SESSION['success']))
	{
		if($_SESSION['success']==0)	
		{
			$result="Problem please try again.";
		}
		else if($_SESSION['success']==1)	
		{
			$result="Data Inserted sucessfully.";
		}
		else if($_SESSION['success']==2)	
		{
			$result="Data Selected was improper.";
		}
?>
<script>
alert('<?php echo $result; ?>');
</script>
<?php
		unset($_SESSION['success']);
	}
?>
<form method="get" action="process_add_threshhold.php" onsubmit="return validate(this)">
<table border="1" cellpadding="2" cellspacing="2">
	<tr>
    	<td>
        	<select name="cid" id="cid" required="required" onchange="getbank(this.value,'ebill');"><option value="">select Client</option>
           <?php
          // $result1 = mysql_query("SELECT DISTINCT cust_name, cust_id FROM sites where atm_id1 in (select ATM_ID from ebill where Active='Y')");
          $sql="SELECT contact_first, short_name FROM contacts where type='c' and short_name in(select distinct(cust_id) from mastersites) order by contact_first ASC";
        //  if($_SESSION['custid']!='all')
        //  $sql.="  and short_name in ($cl)";
          
		  //echo $sql;
          $result1 = mysql_query($sql);
          // $result1 = mysql_query("SELECT DISTINCT s.cust_name, s.cust_id FROM sites s,ebill e where s.atm_id1 =e.ATM_ID and e.Active='Y'");
            while($row1 = mysql_fetch_row($result1)){ ?>
                                           <option value="<?php echo $row1[1]; ?>" ><?php echo $row1[0]; ?></option>
           <?php } ?>   
           </select>
        </td>
        <td>
        	<select name="bank" id="bank" required="required" onchange="getthreshhold();" ><option value="">select Bank</option></select>
        </td>
        <td>
        	<select name="proj" id="proj" required="required" onchange="getthreshhold();" ><option value="">select Project</option></select>
		</td>
        <td>
        	<input type="text" name="threshhold" id="threshhold" required="required" onKeyPress="return isNumberKey(event);" size="10"/>
		</td>
        <td>
        	<input type="submit" value="Add"/>
		</td>
    </tr>
</table>
</form>
<!--<div id="datahere"></div>-->
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>