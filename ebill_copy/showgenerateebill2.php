<?php
include('config.php');
session_start();
 $cid=$_POST['cid'];
 $bid=$_POST['bank'];
/*
if($cid=="FSS04")
{
?><form method="post" name="form1" id="from1" action="newshowEbill.php" onSubmit="return validate1(this)" target="_new" >
<?php
}
elseif($cid=="Tata05")
{
//TATA format
?>
<form method="post" name="form1" id="from1" action="tata.php" onSubmit="return validate1(this)" target="_new" >
<?php
}
elseif($cid=="AGS01")
{
//AGS format
?>
<form method="post" name="form1" id="from1" action="ags.php" onSubmit="return validate1(this)" target="_new" >
<?php
}
elseif($cid=="DIE002" || $cid=="PRIZM07" || $cid=="EUR08")
{
//Diebold, EPS, prizm,euronet format
?>
<form method="post" name="form1" id="from1" action="diebold.php" onSubmit="return validate1(this)" target="_new" >
<?php
}
else
{
//old format
?>
<form method="post" name="form1" id="from1" action="showEbill.php" onSubmit="return validate1(this)" target="_new" >
<?php
} */
?>
<center><button id="myButtonControlID" onClick="tableToExcel('generate_table', 'Generate Data')">Export Table data into Excel</button></center>
<?php
if($cid=="FIS03")
{
?><form method="post" name="form1" id="from1" action="FIS03.php" onSubmit="return validate1(this)" >
<?php
}
else
{

?>
<form method="post" name="form1" id="from1" action="tata2.php" onSubmit="return validate1(this)" >
<?php
} 
?>
<div align="LEFT">

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SELECT COMPANY :<select name="comp" id="comp" ><!--<option value="-1">select</option>-->
<?php $res=mysqli_query($con,"select * from company_details");
      while($row=mysqli_fetch_array($res))
      { ?>
       <option value='<?php echo $row[0]; ?>' ><?php echo $row[1]; ?></option>
     <?php } ?></select> Additional charge to be levid on service charge <input type="text" name="addsv" id="addsv" value="0">
</div>


  <?php
         $cnttt=0;
        /*  $sql = "SELECT atm_id1 FROM ".$cid."_sites where ebill='Y' ";
	if(isset($bid) && $bid!='' && $bid!='-1')
	$sql.="  and bank='".$bid."'";			
		
		
		if(isset($_POST['atm']) && $_POST['atm']!='')
		$sql.=" and atm_id1 like ('%".$_POST['atm']."%')";
		if(isset($_POST['zone']) && $_POST['zone']!='')
		$sql.=" and zone like ('%".$_POST['zone']."%')";
		if(isset($_POST['address']) && $_POST['address']!='')
		$sql.=" and atmsite like ('%".$_POST['address']."%')";
		if(isset($_POST['proj']) && $_POST['proj']!='')
		$sql.=" and projectid like ('".$_POST['proj']."')";
	//echo $sql."<br>";*/
	//$sql2="select f.req_no,f.atmid,e.Consumer_No,e.Distributor,f.bill_date,f.due_date,f.unit,p.Paid_Amount,p.Paid_Date,s.bank,s.atmsite_address,s.projectid,s.housekeeping,s.caretaker,f.reqby,f.entrydate from ebillfundrequests f,".$cid."_sites s,".$cid."_ebill e,ebpayment p where f.print='n' and f.pstat='1' and f.trackerid=s.trackerid and f.trackerid=e.atmtrackid ";
	
	$sql2="select f.req_no,f.atmid,f.bill_date,f.due_date,f.unit,p.Paid_Amount,p.Paid_Date,f.reqby,f.entrydate,f.trackerid,f.cust_id,f.start_date,f.end_date,f.billfrom,DATE_FORMAT(p.`entrydt`,'%y-%m-%d') AS entrydt,p.`upby` from ebillfundrequests f,ebpayment p where f.reqstatus<>100 and f.print='n' and f.pstat='1' and p.Bill_No=f.req_no and f.req_no not in (select alert_id from ebfundtranscanc where status=0) and f.req_no not in (select reqid from ebillfundcancinv where status=0)";
	if($cid!='')
	$sql2.=" and f.cust_id='".$cid."'";
	if($_POST['designation']!=""){
		if($_POST['designation']=="ebill")
			$sql2.=" and f.reqby in (select srno from login where designation = '7')";
		else if($_POST['designation']=="super")
			$sql2.=" and f.reqby in (select srno from login where designation <> '7')";
		else if($_POST['designation']=="uploaded")
			$sql2.=" and f.reqby = 0";	
	}
	
	//$sql2="select * from ebillfundrequests where print='n' and atmid in ($sql)";
	if(isset($_POST['dt']) && isset($_POST['dt2']) && $_POST['dt']!='' && $_POST['dt2']!='')
			{
			$dt=str_replace("/","-",$_POST['dt']);
	$start=date('Y-m-d', strtotime($dt));
	$dt2=str_replace("/","-",$_POST['dt2']);
	$end=date('Y-m-d', strtotime($dt2));
			if($start!=$end)
			$sql2.=" and p.entrydt Between '".$start."' and '".$end."'";
			else
			$sql2.=" and p.entrydt Like '".$start."%'";
			}
			if($cid=='EUR08'){
			if(isset($_POST['type']) && $_POST['type']!='')
			$sql2.=" and p.status='".$_POST['type']."'";
			}
		if(isset($_POST['atmid']) && $_POST['atmid']!='')
		$sql2.=" and f.atmid like ('%".$_POST['atmid']."%')";
/*if($cid=='')
$sql2.=" order by entrydate DESC";
else
$sql2.=" order by entrydate ASC";*/

$sql2.=" order by ";

if($_POST['sort_by_old']=="true")
	$sql2.="p.Paid_Date ASC,";
if($_POST['sort_by_amt']=="true")
	$sql2.="p.Paid_Amount DESC,";

$sql2.="cust_id,atmid,";

$sql2.="req_no ASC";
	//echo $sql2;
	$eb=mysqli_query($con,$sql2);
	if(!$eb)
	echo mysqli_error();
?>

<div align="center">
  <h2 class="style1">ELECTRIC BILLS</h2>
</div>
<p>
</p><?php if(isset($cid)) { ?>
<table width="800" border="1" class="hoverTable" id="generate_table" align="center" cellpadding="4" cellspacing="0">
  <tr>
  <th scope="col"><div align="center">Sr No</div></th>
    <th scope="col"><div align="center">Bill ID </div></th>
    <th scope="col"><div align="center">Cust ID </div></th>
    <th scope="col"><div align="center">ATM ID</div></th>
    <th scope="col"><div align="center">Entry Date</div></th>
    <th scope="col"><div align="center">Request By</div></th>
    <th scope="col"><div align="center">Updated Date</div></th>
    <th scope="col"><div align="center">Updated By</div></th>
    <th scope="col"><div align="center">Bank</div></th>
    <th scope="col"><div align="center">ProjectID</div></th>
    <?php if($cid=='Tata05'){ ?>
    <th scope="col"><div align="center">Housekeeping</div></th>
    <th scope="col"><div align="center">Caretaker</div></th>
    <th scope="col"><div align="center">Maintenance</div></th>
    <?php } ?>
    <th scope="col"><div align="center">Address</div></th>
    <th scope="col"><div align="center">CONSUMER NO.</div></th>
    <th scope="col"><div align="center">DISTRIBUTOR</div></th>
    <th scope="col"><div align="center">Start DATE </div></th> 
    <th scope="col"><div align="center">BILL From </div></th> 
    <th scope="col"><div align="center">To Date </div></th> 
    <th scope="col"><div align="center">BILL DATE </div></th>       
    <th scope="col"><div align="center">DUEDATE </div></th>    
    <th scope="col"><div align="center">Days </div></th>
    <th scope="col"><div align="center">UNITS CONSUMED </div></th>   
    <th scope="col"><div align="center">Average Amt</div></th>    
    <th scope="col"><div align="center">PAID AMOUNT</div></th>   
      <th scope="col"><div align="center">PAID DATE</div></th>
      <th scope="col"><div align="center">SELECT</div></th>  
      <?php  if($_SESSION['designation']=='13'){ ?><th scope="col"><div align="center">DELETE</div></th> <?php  } ?>         
    
  </tr>
<?php
               $totamt=0;
		while($row = mysqli_fetch_row($eb))
		{
		$sitestr="select bank,projectid,atmsite_address,housekeeping,caretaker,maintenance from ".$row[10]."_sites where trackerid='".$row[9]."'";
		if(isset($_POST['bk']) && $_POST['bk']!='' && $_POST['bk']!='-1')
		{
		$bnk=str_replace(",","','",$_POST['bk']);
		$bnk="'".$bnk."'";
	$sitestr.="  and bank in ($bnk)";
	}
	
			//if(isset($bid) && $bid!='' && $bid!='-1')
	//$sitestr.="  and bank='".$bid."'";			
		
		//echo $bid;
		
		if(isset($_POST['zone']) && $_POST['zone']!='')
		$sitestr.=" and zone like ('%".$_POST['zone']."%')";
		if(isset($_POST['address']) && $_POST['address']!='')
		$sitestr.=" and atmsite_address like ('%".$_POST['address']."%')";
		if(isset($_POST['proj']) && $_POST['proj']!='')
		$sitestr.=" and projectid like ('".$_POST['proj']."')";
		if($cid=='Tata05'){
if(isset($_POST['tata']) && $_POST['tata']!='')
$sitestr.=" and ".$_POST['tata']." = 'Y'";

//else
//$sql2.=" and housekeeping<>'Y'";

	// $sql2." ".$_POST['proj']." ".$_POST['tata'];
	}
	//echo "<br>".$sitestr."<br>";
	$site=mysqli_query($con,$sitestr);
	?>
	
	
	<?php
	if(mysqli_num_rows($site)>0){
	$sitero=mysqli_fetch_row($site);
	//echo "<br>select username from login where srno='".$row[7]."'<br>";
		$qr=mysqli_query($con,"select username from login where srno='".$row[7]."'");
		$qrr=mysqli_fetch_row($qr);
		//echo "<br>select * from ".$cid."_ebill where atmtrackid='".$row[9]."'<br>";
                 $cons=mysqli_query($con,"select Consumer_No,Distributor from ".$row[10]."_ebill where atmtrackid='".$row[9]."' order by id DESC limit 1");
				 $consro=mysqli_fetch_row($cons);
				 /*$sql1 = "select * from  ebpayment where Bill_No='".$row[0]."'"; //echo $nsql;
                  $res1 = mysqli_query($con,$sql1);
				 
				 $row3 = mysqli_fetch_row($res1);*/
		 $cust_name_qry = mysqli_query($con,"SELECT contact_first FROM contacts where short_name ='$row[10]'");
		 $cust_name_row=mysqli_fetch_array($cust_name_qry);
		 
		 
		$ebfundreq_qry=mysqli_query($con,"select * from ebillfundrequests where req_no='".$row[0]."'");
		$row1=mysqli_fetch_array($ebfundreq_qry);
		$ec=0;
		$rc=0;
		$dc=0;
		$sd=0;
		$adc=0;	
		
		if($row1['extrachrg_stat']==1)
		$ec=$row1['extrachrg'];
		if($row1['recon_chrg_stat']==1)
		$rc=$row1['recon_chrg'];
		if($row1['discon_chrg_stat']==1)
		$dc=$row1['discon_chrg'];
		if($row1['sd_stat']==1)
		$sd=$row1['sd'];
		if($row1['after_duedt_chrg_stat']==1)
		$adc=$row1['after_duedt_chrg'];
		$rsum=$row[5]+$ec+$rc+$dc+$sd+$adc;
		$totamt=$totamt+$rsum;
			?>
		 <tr>
		 <td><?php echo ($cnttt=$cnttt+1); ?></td>
		 <td><?php echo $row[0]; ?></td>
		<td> <?php echo $cust_name_row[0]; ?></td>
		     <td><a href="javascript:void(0);" onclick="newwin('ebsitehist.php?atmid=<?php echo $row[1]; ?>&custid=<?php echo $row[10]; ?>&trackid=<?php  echo $row[9]; ?>','display',900,700)"><?php echo $row[1]; ?></a><?php //echo $row[1]; ?></td>
		     <td><?php if($row[8]!='0000-00-00 00:00:00'){ echo date("d/m/Y",strtotime($row[8]));}else{ echo "uploading case"; } ?></td>
		 <td><?php echo $qrr[0]; ?></td>
		 <td><?php if($row[14]!='0000-00-00 00:00:00'){ echo date("d/m/Y",strtotime($row[14]));} ?></td>
		 <td><?php echo $row[15]; ?></td>
		     <td><?php echo $sitero[0]; ?></td>
		     <td><?php echo $sitero[1]; ?></td>
		     <?php if($cid=='Tata05'){ ?>
    <td><?php echo $sitero[3]; ?></td>
    <td><?php echo $sitero[4]; ?></td>
    <td><?php echo $sitero[5]; ?></td>
    <?php } ?>
		     <td><?php echo $sitero[2]; ?></td>
			 <td><?php echo $consro[0]; ?></td>
			 <td><?php echo $consro[1]; ?></td>
			 <td><?php if(isset($row[11]) and $row[11]!='0000-00-00'){ echo date('d/m/Y',strtotime($row[11]));} ?></td>			 
			 <td><?php if(isset($row[13]) and $row[13]!='0000-00-00'){ echo date('d/m/Y',strtotime($row[13]));} ?></td>			 
			 <td><?php if(isset($row[12]) and $row[12]!='0000-00-00'){ echo date('d/m/Y',strtotime($row[12]));} ?></td>			 
			 <td><?php if(isset($row[2]) and $row[2]!='0000-00-00'){ echo date('d/m/Y',strtotime($row[2]));} ?></td>			 			              
			  <td><?php if(isset($row[3]) and $row[3]!='0000-00-00'){ echo date('d/m/Y',strtotime($row[3])); } ?></td>
<td><?php $nod=0; if($row[11]!='0000-00-00' and $row[12]!='0000-00-00'){echo $nod=floor((strtotime($row[12])-strtotime($row[11])) / 86400);}else{echo "NA";}  ?></td>	 			              
			   <td><?php echo $row[4]; ?></td>	
<td><?php if($nod!=0)echo number_format ($rsum*30.0/$nod,2); ?></td>			   	 			              
			 <td><?php echo $rsum; ?></td>			
             <td><?php if($row[6]!='0000-00-00'){ echo date('d/m/Y',strtotime($row[6]));} ?></td>
             <td>
              <!--<a href="editbill.php?reqid=<?php echo $row[0]; ?>&cid=<?php echo $cid; ?>">Edit Details</a><br>-->
              <?php
		//echo "SELECT threshhold FROM `threshhold` WHERE `cust_id` LIKE '".$row[10]."' AND `project_id` LIKE '".$sitero[1]."' AND `bank` LIKE '".$sitero[0]."'";
		$threshhold_qry=mysqli_query($con,"SELECT threshhold FROM `threshhold` WHERE `cust_id` LIKE '".$row[10]."' AND `project_id` LIKE '".$sitero[1]."' AND `bank` LIKE '".$sitero[0]."'");
		/*if(mysqli_num_rows($threshhold_qry)>0 && $row[0]>41220)
		{
			$threshhold=mysqli_fetch_array($threshhold_qry);
			$threshhold_val=intval($threshhold[0]);
			$avgamt=intval($row[5]*30.0/$nod);
			//echo $avgamt.">".$threshhold_val;
			if($avgamt>$threshhold_val)
			{
				//echo "select copy from ebillemailcpy where reqid='".$row[0]."' and status='1'";
				$email_attach_chck_qry=mysqli_query($con,"select copy from ebillemailcpy where reqid='".$row[0]."' and status='1'");
				if(mysqli_num_rows($email_attach_chck_qry)==0)
				{
				?>
				<b style="color:red">Email not attached.</b>
				<?php				
				}
				else
				{
					$back_pending=0;
					$pending_req=array();
					$th_chck_qry=mysqli_query($con,"select f.req_no,f.atmid,f.bill_date,f.due_date,f.unit,p.Paid_Amount,p.Paid_Date,f.reqby,f.entrydate,f.trackerid,f.cust_id,f.start_date,f.end_date,f.billfrom,DATE_FORMAT(p.`entrydt`,'%y-%m-%d') AS entrydt,p.`upby` from ebillfundrequests f,ebpayment p where f.reqstatus<>100 and f.print='n' and f.pstat='1' and p.Bill_No=f.req_no and f.req_no not in (select alert_id from ebfundtranscanc where status=0) and f.req_no not in (select reqid from ebillfundcancinv where status=0)  and f.atmid like ('".$row[1]."') and f.req_no<>$row[0] and f.req_no>41220 order by f.req_no");
					while($th_chck=mysqli_fetch_array($th_chck_qry))
					{
						$nod1=floor((strtotime($th_chck[12])-strtotime($th_chck[11])) / 86400);
						$chck_amt=intval($th_chck[5]*30.0/$nod1,2);
						//echo $chck_amt.">".$threshhold_val;
						if($chck_amt>$threshhold_val)
						{
							$email_attach_chck_qry1=mysqli_query($con,"select copy from ebillemailcpy where reqid='".$th_chck[0]."' and status='1'");
							if(mysqli_num_rows($email_attach_chck_qry1)==0)
							{
								$back_pending++;
								$pending_req[]=$th_chck[0];
							}
						}
					}
					if($back_pending>0)
					{
						?>
						<b style="color:red">Previous Email not attached. Request ids are <?php echo implode(",", $pending_req); ?></b>
						<?php
					}
					else
					{
					?>
					<a href="javascript:void(0);" onclick="newwin('reject_generatebill.php?reqid=<?php echo $row[0]; ?>','display',600,600)">Reject</a><br>
					<input type="checkbox" name="bills[]" value="<?php echo $row[0]; ?>" id="<?php echo $row[0]; ?>" onclick="fillreq(this.id);registerses();" />                 		
					<?php
					}
				}
			}
			else
			{
			//echo "Avg amt is less than threshhold";
			?>
			<a href="javascript:void(0);" onclick="newwin('reject_generatebill.php?reqid=<?php echo $row[0]; ?>','display',600,600)">Reject</a><br>
			<input type="checkbox" name="bills[]" value="<?php echo $row[0]; ?>" id="<?php echo $row[0]; ?>" onclick="fillreq(this.id);registerses();" />
			<?php
			}
		}
		else
		{*/
		//echo "Not in threshold and reqid is less than 41220";
		?>
		<a href="javascript:void(0);" onclick="newwin('reject_generatebill.php?reqid=<?php echo $row[0]; ?>','display',600,600)">Reject</a><br>
		<input type="checkbox" name="bills[]" value="<?php echo $row[0]; ?>" id="<?php echo $row[0]; ?>" onclick="fillreq(this.id);registerses();" />			
		<?php
		//}
		?>
             </td>
               <?php  if($_SESSION['designation']=='13'){ ?>  <td><a href="deleteEbill.php?id=<?php echo $row[0]; ?>&atm=<?php echo $row[3]; ?>&cid=<?php echo $cid; ?>&bid=<?php echo $bid; ?>">Delete</a></td>	<?php } ?>					               
		</tr>
		<?php
		}
		}
?>
<tr><td>Total</td><td colspan="<?php 

  
      
         if($cid=='Tata05'){ echo "11"; }else{ echo "8"; } ?>"></td><td colspan="3"><?php echo $totamt; ?></td></tr>
         
</table>
<center><?php $_SESSION['token']=(rand(10,10000000));
//echo $_SESSION['token'];
 ?>
 <input type="text" name="reqid" id="reqid" readonly>
 <input type="hidden" name="tok" value="<?php echo $_SESSION['token']; ?>" readonly id="tok" />
<input type="hidden" name="tata" value="<?php if(isset($_POST['tata']) && $_POST['tata']!=''){ echo $_POST['tata']; } ?>" readonly id="tata" />
<input type="hidden" name="proj" value="<?php if(isset($_POST['proj'])){ echo $_POST['proj']; } ?>" readonly id="proj" />
<input type="hidden" name="type" value="<?php if(isset($_POST['type'])){ echo $_POST['type']; } ?>" readonly id="type" />
<input type="hidden" name="cid" value="<?php echo $cid; ?>" readonly id="cust" />
<input type="hidden" name="bid" value="<?php echo $bid; ?>" id="bid" readonly /><input type="submit" value="generate" /></center><?php } ?>
</form>***???<?php echo $cnttt; ?>***???<?php echo $totamt; ?>