<?php
	include("config.php");
	session_start();
	$sr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
	$srno=mysqli_fetch_row($sr);
	$sql="SELECT * FROM `update_receipt` WHERE `dstatus` = 0 and entrby='$srno[0]'";
	/*if(isset($_REQUEST['sdate']) && $_REQUEST['sdate']!='' && isset($_REQUEST['edate']) && $_REQUEST['edate']!='')
	{
		$sdate=$_REQUEST['sdate'];
		$sdate=str_replace("/","-",$sdate);
		$sdate=date("Y-m-d",strtotime($sdate));
		$edate=$_REQUEST['edate'];
		$edate=str_replace("/","-",$edate);
		$edate=date("Y-m-d",strtotime($edate));
		if($sdate!=$edate)
			$sql.=" and entrydt between STR_TO_DATE('".$_POST['sdate']."','%d/%m/%Y') and STR_TO_DATE('".$_POST['edate']."','%d/%m/%Y')";
		else
			$sql.=" and entrydt like '".$sdate."%'";
	}
	else
		$sql.=" and entrydt like'".date('Y-m-d')."%'";*/
?>
<form action="process_dispatch_req.php" method="post" >
 <table id="style1" border="1">
	<tr>
    	<th>Sr. no.</th>
        <th>Reqid</th>
        <th>Atm</th>
        <th>Bank</th>
        <th width="200px">Address</th>
        <th>Amount</th>
        <th>Updated Amount</th>
        <th>Raise</th>
    </tr>
<?php
	$sql.="  order by reqid DESC";
	//echo $sql;
	$update_receipt_qry=mysqli_query($con,$sql);
	$i=1;
	$tot1=0;
	$tot2=0;
	while($update_receipt=mysqli_fetch_array($update_receipt_qry))
	{
		$sql="SELECT *  FROM `ebillfundrequests` WHERE `req_no` = '".$update_receipt['reqid']."'";
		if(isset($_POST['sup']) && $_POST['sup']!='-1' && $_POST['sup']!='')
			$sql.=" and supervisor='".$_POST['sup']."'";
		if(isset($_POST['atmid']) && $_POST['atmid']!='')
			$sql.=" and atmid like '".$_POST['atmid']."'";
		//echo $sql;
		$ebfundreq_qry=mysqli_query($con,$sql);
		$ebfundreq=mysqli_fetch_array($ebfundreq_qry);
		if(mysqli_num_rows($ebfundreq_qry)>0)
		{
		
		$atm_detail_qry=mysqli_query($con,"select bank,atmsite_address from ".$ebfundreq['cust_id']."_sites where trackerid='".$ebfundreq['trackerid']."'");
		$atm_detail=mysqli_fetch_array($atm_detail_qry);
?>
	<tr>
    	<td><?php echo $i;?></td>
        <td><?php echo $ebfundreq['req_no'];?></td>
        <td><?php echo $ebfundreq['atmid'];?></td>
        <td><?php echo $atm_detail['bank'];?></td>
        <td><?php echo $atm_detail['atmsite_address'];?></td>
        <td><?php echo $ebfundreq['approvedamt']; $tot1+=$ebfundreq['approvedamt']; ?></td>
        <td><?php echo $update_receipt['amt'];  $tot2+=$update_receipt['amt']; ?></td>
        <td id="app<?php echo $i; ?>"><input type="checkbox" name="apps[]" id="apps<?php echo $i;  ?>" value="<?php echo $update_receipt['id']; ?>" onclick="addamt('<?php echo $update_receipt['amt']; ?>','<?php echo $ebfundreq['approvedamt']; ?>',this.id);" style="background:#FFFF99" checked="checked" />
        </td>
        <td <?php if($update_receipt['scncpy']==""){ ?> style="background-color:red;" <?php } ?>>
         <?php if($update_receipt['scncpy']==""){echo "Bill Not Uploaded"; }else { echo "Bill Uploaded"; } ?>
        </td>
    </tr>
<?php
		$i++;
		}
	}
?>
<tr>
	<td colspan="4">Dispatch</td>
	<td><input type="submit" value="Submit" <?php if($tot2==0){ ?>disabled="disabled"<?php } ?> id="dispatch_btn"/></td>
    	<td><input type="text" name='seltot' id='seltot1' value="<?php echo $tot1; ?>" readonly></td>
    	<td><input type="text" name='seltot' id='seltot2' value="<?php echo $tot2; ?>" readonly></td>
    	<td><input type="text" name='seltot' id='diff' value="<?php echo $tot2-$tot1; ?>" readonly></td>
</tr>
</table>
</form>
<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php
if($Prev_Page) 
{
	echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page','perpg')\"> << Back</a> ";
}
if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\">Next >></a> ";
}
?>
</font>
</div>
</div>