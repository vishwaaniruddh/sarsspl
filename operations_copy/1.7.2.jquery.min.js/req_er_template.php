<?php 
//include("access.php");
session_start();
include("config.php");

?>
<?php 
//echo $_SESSION['designation'];
if($_SESSION['designation']=='11')
	$_SESSION['custid']='all';
 
 //echo $_SESSION['user'];
 //echo  $_SESSION['custid'];
 ?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>EBill Recharge-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<!--Slide down div  -->
<script src="js/jquery.min.js.js" type="text/javascript"></script>
 
 
 
 
<style> 
body {
	font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif;
	font-size: .8em;
	}
 
/* the div that holds the date picker calendar */
.dpDiv {
	}
 
 
/* the table (within the div) that holds the date picker calendar */
.dpTable {
	font-family: Tahoma, Arial, Helvetica, sans-serif;
	font-size: 12px;
	text-align: center;
	color: #505050;
	background-color: #ece9d8;
	border: 1px solid #AAAAAA;
	}
 
 
/* a table row that holds date numbers (either blank or 1-31) */
.dpTR {
	}
 
 
/* the top table row that holds the month, year, and forward/backward 

buttons */
.dpTitleTR {
	}
 
 
/* the second table row, that holds the names of days of the week (Mo, 

Tu, We, etc.) */
.dpDayTR {
	}
 
 
/* the bottom table row, that has the "This Month" and "Close" buttons 

*/
.dpTodayButtonTR {
	}
 
 
/* a table cell that holds a date number (either blank or 1-31) */
.dpTD {
	border: 1px solid #ece9d8;
	}
 
 
/* a table cell that holds a highlighted day (usually either today's 

date or the current date field value) */
.dpDayHighlightTD {
	background-color: #CCCCCC;
	border: 1px solid #AAAAAA;
	}
 
 
/* the date number table cell that the mouse pointer is currently over 

(you can use contrasting colors to make it apparent which cell is being 

hovered over) */
.dpTDHover {
	background-color: #aca998;
	border: 1px solid #888888;
	cursor: pointer;
	color: red;
	}
 
 
/* the table cell that holds the name of the month and the year */
.dpTitleTD {
	}
 
 
/* a table cell that holds one of the forward/backward buttons */
.dpButtonTD {
	}
 
 
/* the table cell that holds the "This Month" or "Close" button at the 

bottom */
.dpTodayButtonTD {
	}
 
 
/* a table cell that holds the names of days of the week (Mo, Tu, We, 

etc.) */
.dpDayTD {
	background-color: #CCCCCC;
	border: 1px solid #AAAAAA;
	color: white;
	}
 
 
/* additional style information for the text that indicates the month 

and year */
.dpTitleText {
	font-size: 12px;
	color: gray;
	font-weight: bold;
	}
 
 
/* additional style information for the cell that holds a highlighted 

day (usually either today's date or the current date field value) */ 
.dpDayHighlight {
	color: 4060ff;
	font-weight: bold;
	}
 
 
/* the forward/backward buttons at the top */
.dpButton {
	font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: gray;
	background: #d8e8ff;
	font-weight: bold;
	padding: 0px;
	}
 
 
/* the "This Month" and "Close" buttons at the bottom */
.dpTodayButton {
	font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: gray;
	background: #d8e8ff;
	font-weight: bold;
	}
 
</style> 

<script src="php_calendar/scripts.js" type="text/javascript"></script>
<script>
function calculate(){
	var cont=document.getElementById('counter').value;
	//alert(cont);
	var amt=0;
	for(i=0;i<cont;i++){
		amt=amt+Number(document.getElementById('amt_'+i).value);
	}
	document.getElementById('totalamtgross').value=amt;
}
</script>
</head>

<body>
<center>
<?php include("menubar.php"); ?>
</center>
<div align="center">
  <h2 class="style1">View Recharge Template</h2>
</div>
<div >
<form name="myform" method="POST" action="process_req_er_template.php">
	<table id="myTable" border="1">
<?php
	$tmt_id=$_GET['tmt_id'];
	$view_temptlate=mysqli_query($con,"select * from recharge_template where status=1 and tmt_id='".$tmt_id."'");
	if($view_temptlate>0)
	{
		$row=mysqli_fetch_array($view_temptlate)
?>
		<tr>
			<td>Supervisor : </td>
			<td colspan="4"><input type="text" name="sv" id="sv" value="<?php echo $row['supervisor']; ?>" readonly />
				<!--<select name="sv" id="sv" required ><option value="-1">Select</option>
				<?php
					  $sup=mysqli_query($con,"select distinct(hname) from fundaccounts order by hname ASC");
					 while($supro=mysqli_fetch_array($sup))
					 { 
				?>
			   		<option value="<?php echo $supro[0]; ?>" <?php if($supro[0]==$row['supervisor']){ echo "selected"; } ?>><?php echo $supro[0]; ?></option>
		  		<?php } ?>  
	    			</select>-->
			</td>
		</tr>
		<tr>
			<td>Select Client : </td>
			<?php					 
					  $contact_qry=mysqli_query($con,"Select contact_first from contacts where type='c' and short_name='".$row['cust_id']."'");
					  $contact=mysqli_fetch_row($contact_qry);
			?>
			<td colspan="4">
				<input type="text" name="cust1" id="cust1" value="<?php echo $contact[0]; ?>" readonly />
				<input type="hidden" name="cust" id="cust" value="<?php echo $row['cust_id']; ?>"/>
				<!--<select name="cust" id="cust" required > <option value="">Select Client</option>
				     <?php
					  $str="Select short_name,contact_first from contacts where type='c' order by contact_first ASC";
					 
					  $qry=mysqli_query($con,$str);
					  while($row1=mysqli_fetch_row($qry))
					  {
						// echo "select 1 from ".$row[0]."_ebill";
						$val = mysqli_query($con,"select 1 from ".$row1[0]."_ebill");
						if($val !== FALSE)
						{
						   //DO SOMETHING! IT EXISTS!
						   ?>
						      <option value="<?php echo $row1[0]; ?>" <?php if($row1[0]==$row['cust_id']){ echo "selected"; } ?>><?php echo $row1[1]; ?></option>
						      <?php
						}
					  
					  }
				?>
				</select>-->
			</td/>
		</tr>
<?php
		$row2_qry=mysqli_query($con,"select * from recharge_template_details where tmt_id='".$tmt_id."' and status=1");
		$i=0;
		$allinvalid=mysqli_num_rows($row2_qry);
		$totalamt=0;
		while($row2=mysqli_fetch_array($row2_qry))
		{
			$valid=1;
			//echo "SELECT bill_date,reqstatus FROM `ebillfundrequests`  where trackerid = '".$row2['tracker_id']."' and type='recharge' order by req_no desc limit 1";
			$chck_qry=mysqli_query($con,"SELECT bill_date,reqstatus FROM `ebillfundrequests`  where trackerid = '".$row2['tracker_id']."' and type='recharge' order by req_no desc limit 1");
			$chck=mysqli_fetch_array($chck_qry);
			if(mysqli_num_rows($chck_qry)>0)
			{
				$chckdate = strtotime ( '+1 month' , strtotime ( $chck[0] ) ) ;
				if($chckdate > strtotime(date('d-m-Y')) && $chck[1]>0)
				{
					$valid=0;
					$allinvalid--;
				}
			}
?>
		<tr id="tr_row_<?php echo $i;?>" <?php if(!$valid){ ?> style="background-color:#F00"  <?php }?>>
			<td><center><b><?php echo ($i+1); ?></b></center></td>
	        	<td>Atm ID : </td>
	            	<td>
	            		<input type="hidden" value="<?php echo $row2['td_id']; ?>"  name="td_id[<?php echo $i;?>]" id="td_id_<?php echo $i;?>">
	            		<input type="text" name="atmid[<?php echo $i;?>]" id="atmid_<?php echo $i;?>" value="<?php echo $row2['atm_id']; ?>"  readonly />
	            	</td>
	            	<td>Amount</td>
	            	<td>
                        <input type="text" name="amt[<?php echo $i;?>]" id="amt_<?php echo $i;?>" value="<?php echo $row2['amount']; $totalamt+=$row2['amount']; ?>" onKeyUp="calculate();" <?php if(!$valid){ ?> readonly <?php } ?> required />
                        <input type="hidden" value="<?php echo $row2['tracker_id']; ?>"  name="trackid[<?php echo $i;?>]" id="trackid_<?php echo $i;?>">
                    	<input type="hidden" name="valid[<?php echo $i;?>]" value="<?php if($valid){echo "yes";}else{ echo "no";}?>" /></td>
	        </tr>
	            
<?php
			$i++;
		}
	}
?>	            <input type="hidden" value="<?php echo $i;?>"  name="counter" id="counter">
	        <tr>
	            <td colspan="4" align="right">Total Amount</td>
	            <td><input type="text" name="totalamtgross" id="totalamtgross" value="<?php echo $totalamt; ?>" readonly=readonly></td>
	        </tr>
	</table>
	<input type="hidden" value="<?php echo $tmt_id; ?>"  name="tmt_id">
	<input type="submit" name="Submit" value="Submit" <?php if($allinvalid==0){?>disabled="disabled" <?php } ?>/>
</form>
</div>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
<?php if($allinvalid==0){?>
<script>
alert("You have requested all the atms in this template .");
</script>
<?php } ?>
</body>
</html>