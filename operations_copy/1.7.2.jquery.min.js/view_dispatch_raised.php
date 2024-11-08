<?php 
	include("access.php");
	include("config.php");	
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<script src="excel.js" type="text/javascript"></script>
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<!--Slide down div  -->
<script src="js/jquery.min.js.js" type="text/javascript"></script>
<script src="php_calendar/scripts.js" type="text/javascript"></script>
<script type="text/javascript">
 function approve(cnt,id)
{
//alert(cnt+" "+id);
 	var rem=document.getElementById("rem"+cnt).value;
	var towhom=document.getElementById("towhom"+cnt).value;
	if(rem=="")
	{
		alert('POD number is cmpulsory.');
		document.getElementById("rem"+cnt).focus();
	}
	else if(towhom=="")
	{
		alert('To Whom is cmpulsory.');
		document.getElementById("towhom"+cnt).focus();
	}
	else
	{
		var xmlhttp;
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
			if(xmlhttp.responseText=='1')
			{
		   // alert("Fund Approved");
			document.getElementById("app"+cnt).innerHTML=rem;
			document.getElementById("towhom"+cnt).innerHTML=towhom;
			}
			else
			 alert("Failed please try again.");
			}
		  }
				xmlhttp.open("GET","process_po_req.php?pod="+rem+"&did="+id+"&towhom="+towhom,true);
				xmlhttp.send();
	}
}
function showrem(id)
{

if(document.getElementById(id).style.display=='none')
document.getElementById(id).style.display='block';
else
document.getElementById(id).style.display='none';
}
function isNumberKey(evt)
{
var charCode = (evt.which) ? evt.which : event.keyCode;
if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
return false;
 
return true;
}
</script>
</head>
<body>
<center>
<?php include("menubar.php"); ?>
<?php
	if(isset($_SESSION['success']))
	{
		if($_SESSION['success']==0)	
		{
			$result="Database problem please try again.";
		}
		else if($_SESSION['success']==1)	
		{
			$result="Request submited sucessfully Your dispatch ID is ".$_SESSION['did'];
		}
?>
<script>
alert('<?php echo $result; ?>');
</script>
<?php
		unset($_SESSION['success']);
		unset($_SESSION['did']);
	}
?>
<h2>View Dispatched </h2>
<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Dispatch Detail')">Export Table data into Excel</button>
<center>
	<table>
		<form method="post" action="<?php $_SERVER["PHP_SELF"] ?>"/>
			<input type="text" name="didno" placeholder="DID Number" onKeyPress="return isNumberKey(event);" value="<?php if(isset($_REQUEST['didno'])){ echo $_REQUEST['didno']; }?>" size="10"/>
			<input type="submit" value="Submit"/>
		</form>
	</table>
</center>
<table id="custtable" border="1">
	<tr>
    	<th>Sr. No.</th>
        <th>Dispatch ID</th>
        <th>Count of Atm</th>
        <th>Sum of Fund Transfered</th>
        <th>Sum of Fund Updated</th>
        <th>Difference</th>
        <th>Dispatch Date</th>
        <th>View Detail</th>
        <th>PO Number</th>
        <th>To Whom</th>
        <th>HO Approval</th>
        <th>Approval Date</th>
	</tr>
<?php
	$sr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
	$srno=mysqli_fetch_row($sr);
	$str="SELECT did,sum(amt),count(*),req_status,entrby,ddate,adate FROM `update_receipt` where dstatus=1 and entrby='$srno[0]'";
	if(isset($_REQUEST['didno']) && $_REQUEST['didno']!='')
	$str.=" and did='".$_REQUEST['didno']."'";
	$str.=" group by did order by did desc";
	$qry=mysqli_query($con,$str);
	$i=1;
	while($row=mysqli_fetch_array($qry))
	{
		$trans_qry=mysqli_query($con,"select sum(approvedamt) from `ebillfundrequests` where req_no in (SELECT reqid FROM `update_receipt` WHERE `did` = $row[0])");
		$trans=mysqli_fetch_array($trans_qry);
		$pod_qry=mysqli_query($con,"SELECT * FROM `pod_receipt` WHERE `did` = $row[0]");
		$pod=mysqli_fetch_array($pod_qry);
		$entrby_qry=mysqli_query($con,"select username from login where srno='".$row['entrby']."'");
		$entrby=mysqli_fetch_row($entrby_qry);
		$did=$row[0];
		if($did<=9)
		$did ="000".$did ;
		if($did>9 && $did <=99)
		$did = "00".$did ;
		if($did>99 && $did <=999)
		$did = "0".$did ;
?>
	<tr style="text-align:center">
    	<td><?php echo $i; ?></td>
        <td><?php echo "CSS_".$entrby[0]."_".$did; ?></td>
        <td><?php echo $row[2]; ?></td>
        <td><?php echo $trans[0]; ?></td>
        <td><?php echo $row[1]; ?></td>
        <td><?php echo $row[1]-$trans[0]; ?></td>
        <td><?php if($row[5]!='0000-00-00'){echo date('d-m-Y',strtotime($row[5]));}  ?></td>
        <td><a href="view_dispatch_detail.php?did=<?php echo $row[0]; ?>">View</a></td>
        <td id="app<?php echo $i; ?>">
        	<?php if(mysqli_num_rows($pod_qry)<1){ ?>
            	<input type="button" onclick="showrem('showrem<?php echo $i; ?>');showrem(this.id);" id="update<?php echo $i; ?>" value="Update" style="background:#FFFF99" />
                <div id="showrem<?php echo $i; ?>" style="display:none">
					<input type="text" id="rem<?php echo $i; ?>" placeholder="POD Number"/><br />
					<input type="text" id="towhom<?php echo $i; ?>" placeholder="To Whom"/><br />
                    <input type="button" onClick="approve('<?php echo $i; ?>','<?php echo $row[0]; ?>')" value="Go" style="background:#FFFF99">
                    <input type="button" onclick="showrem('showrem<?php echo $i; ?>');showrem('update<?php echo $i; ?>');" value="Cancel" style="background:#FFFF99" />
                </div>
			<?php } else{ echo $pod['pod'];}?>
        </td>
        <td id="towhom<?php echo $i; ?>"><?php echo $pod['to_whom']; ?></td>
        <td><?php if($row[3]==0){ echo "Not Received";}else if($row[3]==1){ echo "Received"; }?></td>
        <td><?php if($row[6]!='0000-00-00'){echo date('d-m-Y',strtotime($row[6]));} ?></td>
<?php
		$i++;
	}
?>
</table>
</center>
<div id="datahere" style="margin-top:25px"></div>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>