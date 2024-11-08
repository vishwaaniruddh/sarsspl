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
<form method="post" name="form1" id="from1" action="tata.php" onSubmit="return validate1(this)" >
<div align="LEFT">

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SELECT COMPANY :<select name="comp" id="comp" ><!--<option value="-1">select</option>-->
<?php $res=mysqli_query($con,"select * from company_details");
      while($row=mysqli_fetch_array($res))
      { ?>
       <option value='<?php echo $row[0]; ?>' ><?php echo $row[1]; ?></option>
     <?php } ?></select>
</div>

<div align="center">
  <h2 class="style1">ELECTRIC BILLS</h2>
</div>
<p>
</p><?php if(isset($cid)) { ?>
<table width="800" border="1" align="center" cellpadding="4" cellspacing="0">
  <tr>
    <th scope="col"><div align="center">Bill ID </div></th>
    <th scope="col"><div align="center">ATM ID</div></th>
    <th scope="col"><div align="center">Entry Date</div></th>
    <th scope="col"><div align="center">Request By</div></th>
    <th scope="col"><div align="center">Bank</div></th>
    <th scope="col"><div align="center">ProjectID</div></th>
    <?php if($cid=='Tata05'){ ?>
    <th scope="col"><div align="center">Housekeeping</div></th>
    <th scope="col"><div align="center">Caretaker</div></th>
    <?php } ?>
    <th scope="col"><div align="center">Address</div></th>
    <th scope="col"><div align="center">CONSUMER NO.</div></th>
    <th scope="col"><div align="center">DISTRIBUTOR</div></th>
    <th scope="col"><div align="center">BILL DATE </div></th>       
    <th scope="col"><div align="center">DUEDATE </div></th>       
    <th scope="col"><div align="center">UNITS CONSUMED </div></th>       
    <th scope="col"><div align="center">PAID AMOUNT</div></th>   
      <th scope="col"><div align="center">PAID DATE</div></th>
      <th scope="col"><div align="center">SELECT</div></th>  
      <?php  if($_SESSION['designation']=='13'){ ?><th scope="col"><div align="center">DELETE</div></th> <?php  } ?>         
    
  </tr>
  <?php
         // echo $cid." - " .$bid;
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
	$sql2="select f.req_no,f.atmid,f.bill_date,f.due_date,f.unit,p.Paid_Amount,p.Paid_Date,f.reqby,f.entrydate,f.trackerid,f.cust_id from ebillfundrequests f,ebpayment p where f.print='n' and f.pstat='1' and p.Bill_No=f.req_no ";
	if($cid!='')
	$sql2.=" and f.cust_id='".$cid."'";
	
	
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

$sql2.=" order by req_no,cust_id ASC";
//	echo $sql2;
	$eb=mysqli_query($con,$sql2);
	if(!$eb)
	echo mysqli_error();
               $totamt=0;
		while($row = mysqli_fetch_row($eb))
		{
		$sitestr="select bank,projectid,atmsite_address,housekeeping,caretaker from ".$row[10]."_sites where trackerid='".$row[9]."'";
		
			if(isset($bid) && $bid!='' && $bid!='-1')
	$sitestr.="  and bank='".$bid."'";			
		
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
	if(mysqli_num_rows($site)>0){
	$sitero=mysqli_fetch_row($site);
	//echo "<br>select username from login where srno='".$row[7]."'<br>";
		$qr=mysqli_query($con,"select username from login where srno='".$row[7]."'");
		$qrr=mysqli_fetch_row($qr);
		//echo "<br>select * from ".$cid."_ebill where atmtrackid='".$row[9]."'<br>";
                 $cons=mysqli_query($con,"select Consumer_No,Distributor from ".$row[10]."_ebill where atmtrackid='".$row[9]."'");
				 $consro=mysqli_fetch_row($cons);
				 /*$sql1 = "select * from  ebpayment where Bill_No='".$row[0]."'"; //echo $nsql;
                  $res1 = mysqli_query($con,$sql1);
				 
				 $row3 = mysqli_fetch_row($res1);*/
				 $totamt=$totamt+$row[5];
		 
			?>
		 <tr><td><?php echo $row[0]; ?></td>
		 
		     <td><?php echo $row[1]; ?></td>
		     <td><?php if($row[8]!='0000-00-00 00:00:00'){ echo date("d/m/Y",strtotime($row[8]));}else{ echo "uploading case"; } ?></td>
		 <td><?php echo $qrr[0]; ?></td>
		     <td><?php echo $sitero[0]; ?></td>
		     <td><?php echo $sitero[1]; ?></td>
		     <?php if($cid=='Tata05'){ ?>
    <td><?php echo $sitero[3]; ?></td>
    <td><?php echo $sitero[4]; ?></td>
    <?php } ?>
		     <td><?php echo $sitero[2]; ?></td>
			 <td><?php echo $consro[0]; ?></td>
			 <td><?php echo $consro[1]; ?></td>
			 <td><?php if(isset($row[2]) and $row[2]!='0000-00-00'){ echo date('d/m/Y',strtotime($row[2]));} ?></td>			 			              
			  <td><?php if(isset($row[3]) and $row[3]!='0000-00-00'){ echo date('d/m/Y',strtotime($row[3])); } ?></td>			 			              
			   <td><?php echo $row[4]; ?></td>			 			              
			 <td><?php echo $row[5]; ?></td>			
             <td><?php if($row[6]!='0000-00-00'){ echo date('d/m/Y',strtotime($row[6]));} ?></td>
             <td>
              <a href="editbill.php?reqid=<?php echo $row[0]; ?>&cid=<?php echo $cid; ?>">Edit Details</a><br>
             <input type="checkbox" name="bills[]" value="<?php echo $row[0]; ?>" /></td>
               <?php  if($_SESSION['designation']=='13'){ ?>  <td><a href="deleteEbill.php?id=<?php echo $row[0]; ?>&atm=<?php echo $row[3]; ?>&cid=<?php echo $cid; ?>&bid=<?php echo $bid; ?>">Delete</a></td>	<?php } ?>					               
		</tr>
		<?php
		}
		}
?>
<tr><td>Total</td><td colspan="<?php 

  
      
         if($cid=='Tata05'){ echo "11"; }else{ echo "8"; } ?>"></td><td colspan="3"><?php echo $totamt; ?></td></tr>
</table><center><?php $_SESSION['token']=(rand(10,10000000));
//echo $_SESSION['token'];
 ?>
 <input type="text" name="tok" value="<?php echo $_SESSION['token']; ?>" readonly id="tok" />
<input type="text" name="tata" value="<?php if(isset($_POST['tata']) && $_POST['tata']!=''){ echo $_POST['tata']; } ?>" readonly id="tata" />
<input type="text" name="proj" value="<?php if(isset($_POST['proj'])){ echo $_POST['proj']; } ?>" readonly id="proj" />
<input type="text" name="type" value="<?php if(isset($_POST['type'])){ echo $_POST['type']; } ?>" readonly id="type" />
<input type="text" name="cid" value="<?php echo $cid; ?>" readonly id="cust" />
<input type="text" name="bid" value="<?php echo $bid; ?>" id="bid" readonly /><input type="submit" value="generate" /></center><?php } ?>
</form>