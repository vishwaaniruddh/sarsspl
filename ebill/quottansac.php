<?php ini_set( "display_errors", 0);
	
	include("access.php");
	
	
	// header('Location:managesite1.php?id='.$id); 
	 
	include("config.php");
	
	$result1 = mysqli_query($con,"SELECT contact_first, short_name FROM contacts where type='c' order by short_name ASC");		
	//$result2 = mysqli_query($con,"SELECT DISTINCT bank FROM sites");		
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


</script>

	
	</head>
	<body >
	<center>
<?php include("menubar.php");
//echo $_SESSION['branch'];
 ?></center>
	<center>
	<form name="frm1" method="post" action="<?php $_SERVER['PHP-SELF']; ?>"  enctype="multipart/form-data" align="center">
	<h2 class="style1" align="center">TRANSACTIONS</h2>
	<table border="3" align="center"><tr><!--<td width="209" align="center">
		 Client :
			  <select name="cid" id="cid" onchange="searchById('Listing','1','');getproj(this.value);" ><option value="">select Client</option>
			   <?php
				while($row1 = mysqli_fetch_row($result1))
				{ ?>
				   <option value="<?php echo $row1[1]; ?>"<?php if(isset($_POST['cid']) && $_POST['cid']==$row1[1]){ echo "selected"; }  ?> ><?php echo $row1[0]; ?></option>
			   <?php } ?>   </select></td>-->
			   <td>
			    From: <input type="text" name="frmdt" id="frmdt" value="<?php if(isset($_POST['frmdt'])){ echo $_POST['frmdt']; } ?>"  onclick="displayDatePicker('frmdt')" >&nbsp;
			    </td>
			    <td>
			    TO:<input type="text" name="todt" id="todt"  onclick="displayDatePicker('todt')" value="<?php if(isset($_POST['todt'])){ echo $_POST['todt']; } ?>" >&nbsp;
			    </td>
			   <td>
			  <input type="submit" name="sub" id="sub" value="Done" >
			   </td>
			  
			   </tr>
			   </table>
			   </form>
			   </center>
			     </br>
			     </br>
			     </br> 
			    <?php
			    include("config.php");
 			
				if(isset($_POST['sub']))
				 {
					?>
					
					<table  border="3" align="center" cellspacing="10" cellpadding="10">
					<tr><center>
				<th>Sr No</th>
				 <th>Cheque No</th>
<th>Request Count</th><th>Transferred Date</th>
				 <th>Amount</th>
				
				<th>View</th>
				
				
				</center>
				</tr>
			<?php
				 
				// $client=$_POST['cid'];
					 $frm=$_POST['frmdt'];
					 $to=$_POST['todt'];
		//echo "select * from siteinvoice where custid='".$client."' and billdate between STR_TO_DATE('".$frm."','%d/%m/%Y') and STR_TO_DATE('".$to."','%d/%m/%Y') ";
		$chqno=array();
				/*$query=mysqli_query($con,"select distinct(chqno) from ebfundtransfers where status='0'  and pdate between STR_TO_DATE('".$frm."','%d/%m/%Y') and STR_TO_DATE('".$to."','%d/%m/%Y') and chqno not like '%on%' order by tid ASC");
				$tidarr=array();
					while($row=mysqli_fetch_row($query))
					{
					$tidarr[]=$row[0];
					$chqno[]=$row[1];
					}	*/
					//echo "select sum(approvedamt),chqno,count(chqno) from ebillfundrequests where chqno!='' and chqno!='0' and reqstatus=8 and req_no in(select reqid from ebillfundapp where apptime between STR_TO_DATE('".$frm."','%d/%m/%Y') and STR_TO_DATE('".$to."','%d/%m/%Y') and level='8' and status=0) group by chqno order by req_no ASC";
					$srno=0;
//echo "select sum(approvedamt),chqno,count(chqno) from ebillfundrequests where chqno!='' and chqno!='0' and reqstatus=8 group by chqno order by req_no ASC";
echo "select sum(tamount),chqno,count(chqno) from quotation1ftransfers status!=0 and group by tid order by qid ASC";
				$sql=mysqli_query($con,"select sum(tamount),chqno,count(chqno),tid from quotation1ftransfers where status!=0 group by tid order by qid ASC");	
			
				while($row=mysqli_fetch_array($sql))
				{
				$srno=$srno+1;
				$req=mysqli_query($con,"select distinct(pdate) from quotation1ftransfers where chqno='".$row[1]."'");
				$reqro=mysqli_fetch_row($req);
				?>
				<tr>
					<td><?php echo $srno; ?></td>
					<td><?php echo $row[1]; ?></td>
<td><?php echo $row[2]; ?></td><td><?php echo $reqro[0]; ?></td>
					<td><?php echo $row[0]; ?></td>
				<td><?php if(mysqli_num_rows($req)>0){ ?><a href="viewquottransdet.php?id=<?php echo $row[3]; ?>" target="_blank"><input type='button' name="view" id="view" value="View Details" /></a><?php } ?>
				
				
				
			<!--<?php if($_SESSION['designation']=='2'){ ?>
			
			<a href="javascript:void(0);" onclick="newwin('edtchq.php?tid=<?php echo $tidarr[$i]; ?>&chqno=<?php echo $chqno[$i]; ?>','display','400','400')"><input type='button' name="view" id="view" value="Edit cheque number" /></a>
			<?php } ?>		
				
					</td>-->
				<?php if($_SESSION['designation']=='6' && mysqli_num_rows($req)>0){ ?>	<td><a href="viewequotbtrans.php?transid=<?php echo $row[3]; ?>" target="_blank"><input type='button' name="view" id="view" value="View Bank Statement" /></td><?php }else{ echo "<td>&nbsp;</td>";} ?>
					</tr>
				<?php
				}
				
				?>
				
				<!--<?php
				 
				// $client=$_POST['cid'];
					 $frm=$_POST['frmdt'];
					 $to=$_POST['todt'];
		//echo "select * from siteinvoice where custid='".$client."' and billdate between STR_TO_DATE('".$frm."','%d/%m/%Y') and STR_TO_DATE('".$to."','%d/%m/%Y') ";
		$chqno=array();
				$query=mysqli_query($con,"select distinct(tid),chqno from ebfundtransfers where status='0'  and pdate between STR_TO_DATE('".$frm."','%d/%m/%Y') and STR_TO_DATE('".$to."','%d/%m/%Y') and chqno not like '%on%' order by tid ASC");
				$tidarr=array();
					while($row=mysqli_fetch_row($query))
					{
					$tidarr[]=$row[0];
					$chqno[]=$row[1];
					}
					//echo count($tidarr)." ".count($chqno);
					//print_r($tidarr);
					for($i=0;$i<count($tidarr);$i++)
					{
					//echo "Select sum(approvedamt) from ebillfundrequests where req_no in(Select reqid from ebfundtransfers where tid='".$tidarr[$i]."')";
					if($chqno[$i]!=''){
					$qryamt=mysqli_query($con,"Select sum(approvedamt) from ebillfundrequests where req_no in(Select reqid from ebfundtransfers where tid='".$tidarr[$i]."') and chqno='".$chqno[$i]."'");
					$amtres=mysqli_fetch_row($qryamt);
					$qrycnt=mysqli_query($con,"Select count(tid) from ebfundtransfers where chqno='".$chqno[$i]."' and tid='".$tidarr[$i]."'");
					$cntro=mysqli_fetch_row($qrycnt);
					?>
					<tr>
					<td><?php echo $tidarr[$i]; ?></td>
					<td><?php echo $chqno[$i]; ?></td>
<td><?php echo $cntro[0]; ?></td>
					<td><?php echo $amtres[0].""; ?></td>


					<td><a href="viewtransdet.php?id=<?php echo $tidarr[$i]; ?>" target="_blank"><input type='button' name="view" id="view" value="View Details" /></a></td>




			<?php if($_SESSION['designation']=='2'){ ?>
			
			<a href="javascript:void(0);" onclick="newwin('edtchq.php?tid=<?php echo $tidarr[$i]; ?>&chqno=<?php echo $chqno[$i]; ?>','display','400','400')"><input type='button' name="view" id="view" value="Edit cheque number" /></a>
			<?php } ?>		
				
					<td>
				<?php if($_SESSION['designation']=='6'){ ?>	<td><a href="viewebtrans.php?transid=<?php echo $tidarr[$i]; ?>" target="_blank"><input type='button' name="view" id="view" value="View Bank Statement" /></td><?php } ?></td>




					</tr>
					<?php
					}}
					?>
					

				



					
				</table>
				</center>
				<?php	
				}
				?>
				
				
				
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>		
			</body>
			   </html>
			   
			   
			  		   
			   