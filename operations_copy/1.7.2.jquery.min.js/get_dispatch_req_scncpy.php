<?php

	include("config.php");
mysqli_query($con,
	session_start();

	$sr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");

	$srno=mysqli_fetch_row($sr);

	$sql="SELECT * FROM `update_receipt` WHERE `dstatus` = 0 and entrby='$srno[0]'";

	if(isset($_REQUEST['sdate']) && $_REQUEST['sdate']!='' && isset($_REQUEST['edate']) && $_REQUEST['edate']!='')

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

	}mysqli_query($con,

	else

		$sql.=" and entrydt like'".date('Y-m-d')."%'";

?>

 <table id="style1" border="1">

	<tr>

    	<th>Sr. no.<mysqli_query($con,

        <th>Reqid</th>

        <th>Atm</th>
mysqli_query($con,
        <th>Bank</th>

        <th width="200px">Address</th>

        <th>Amount</th>

        <th>Updated Amount</th>

        <th>Upload</th>

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

        <?php if($update_receipt['scncpy']==""){?>

        <td>

        	<form name="scan_update" method="post" action="process_updatereceipt_req_scncpy.php" enctype="multipart/form-data">

            	<input type="hidden" name="to_page" value="view_dispatch_req_scncpy" />

            	<input type="hidden" name="req_id" value="<?php echo $ebfundreq['req_no'];?>" />

                <input type="file" name="scancpy" id="scancpy" required="required"><br />

                <input type="submit" name="cmdsub" value="Submit"/>

            </form>

        </td>

        <?php } ?>

    </tr>

<?php

		$i++;

		}

	}

?>

</table>

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