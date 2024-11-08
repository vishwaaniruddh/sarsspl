<div align="center">
<?php
	include("config.php");
	session_start();
	$rev_str="SELECT * FROM `reversal` where 1 ";
	if(isset($_REQUEST['status']) && $_REQUEST['status']!="")
		$rev_str.="and status='".$_REQUEST['status']."' ";
	if(isset($_REQUEST['sup']) && $_REQUEST['sup']!="")
		$rev_str.="and accid='".$_REQUEST['sup']."' ";
	if(isset($_REQUEST['sdate']) && $_REQUEST['sdate']!='' && isset($_REQUEST['edate']) && $_REQUEST['edate']!='')
	{
		$sdate=$_REQUEST['sdate'];
		$sdate=str_replace("/","-",$sdate);
		$sdate=date("Y-m-d",strtotime($sdate));
		$edate=$_REQUEST['edate'];
		$edate=str_replace("/","-",$edate);
		$edate=date("Y-m-d",strtotime($edate));
		if($sdate!=$edate)
			$rev_str.=" and entrydate between '".$sdate." 00:00:00' and '".$edate." 23:59:59'";
		else
			$rev_str	.=" and entrydate like '".$sdate."%'";
	}
	$rev_qry=mysqli_query($con,$rev_str);
	$showpaging=0;
	if($_REQUEST['atmid']=="")
		$showpaging=1;
if($showpaging)
{
	$Num_Rows = mysqli_num_rows ($rev_qry);
?>
Total Records: <b><?php echo $Num_Rows; ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 Records Per Page :<select name="perpg" id="perpg" onChange="searchById('Listing','1','perpg');">
 
 <?php
 for($i=1;$i<=$Num_Rows;$i++)
 {
 if($i%50==0)
 {
 ?>
 <option value="<?php echo $i; ?>" <?php if(isset($_REQUEST['perpg']) && $_REQUEST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo $i."/page"; ?></option>
 <?php
 }
 }
 
 ?>
 <option value="<?php echo $Num_Rows; ?>" <?php if(isset($_REQUEST['perpg']) && $_REQUEST['perpg']==$Num_Rows){?>  selected="selected" <?php } ?>><?php echo "All"; ?></option>
 </select>
 <?php
}
 ?>
 <table id="style1" border="1">
	<tr>
    	<th>Sr. no.</th>
        <th>Supervisor</th>
        <th>Reqid</th>
        <th>Atm</th>
        <th>Bank</th>
        <th width="200px">Address</th>
        <th>Credit Ac.</th>
        <th>Payment Type</th>
        <th>Cheque Name</th>
        <th>Cheque No.</th>
        <th>Paid Date</th>
        <th>Approved Amount</th>
        <th>Raised Amount</th>
         <th>Remarks</th>
         <?php
        	if($_REQUEST['status']==2)
			{
		?>
         <th>Update</th>
         <?php
			}
		?>
        <?php
        	if($_REQUEST['status']==1 || $_REQUEST['status']==0)
			{
		?>
        <th>Approved / Rejected By</th>
        <?php
			}
		?>
        <?php
        	if($_REQUEST['status']==2)
			{
		?>
        <th>Approve</th>
        <th>Reject</th>
        <?php
			}
		?>
    </tr>
<?php
if($showpaging)
{
	$strPage = $_REQUEST['Page'];
	$Per_Page =$_REQUEST['perpg']; //$_REQUEST['perpg'];   // Records Per Page
 
	$Page = $strPage;
	if(!$strPage)
	{
		$Page=1;
	}
	 
	$Prev_Page = $Page-1;
	$Next_Page = $Page+1;
	
	
	$Page_Start = (($Per_Page*$Page)-$Per_Page);
	if($Num_Rows<=$Per_Page)
	{
		$Num_Pages =1;
	}
	else if(($Num_Rows % $Per_Page)==0)
	{
		$Num_Pages =($Num_Rows/$Per_Page) ;
	}
	else
	{
		$Num_Pages =($Num_Rows/$Per_Page)+1;
		$Num_Pages = (int)$Num_Pages;
	}
	$rev_str.="  order by pdate DESC,chqno LIMIT $Page_Start , $Per_Page";
}
else
	$rev_str.="  order by pdate DESC,chqno";
	//echo $rev_str;
	$rev_qry=mysqli_query($con,$rev_str);
	$i=1;
	while($rev=mysqli_fetch_array($rev_qry))
	{
		$sql="select e.req_no,e.atmid,e.trackerid,f.chqname,f.chqno,f.pdate,e.approvedamt,e.cust_id from ebillfundrequests e,ebfundtransfers f where e.req_no=f.reqid and e.req_no='".$rev['reqid']."' ";
		if(isset($_REQUEST['atmid']) && $_REQUEST['atmid']!="")
			$sql.="and e.atmid='".$_REQUEST['atmid']."' ";
		//echo "<br/>".$sql."<br/>";
		$ebfundreq_qry=mysqli_query($con,$sql);
		if(mysqli_num_rows($ebfundreq_qry)>0)
		{
			$fundacc_qry=mysqli_query($con,"SELECT hname FROM `fundaccounts` WHERE `aid` = '".$rev['accid']."'");
			$fundacc=mysqli_fetch_array($fundacc_qry);
			$ebfundreq=mysqli_fetch_array($ebfundreq_qry);
			$atm_detail_qry=mysqli_query($con,"select bank,atmsite_address from ".$ebfundreq['cust_id']."_sites where trackerid='".$ebfundreq['trackerid']."'");
			$atm_detail=mysqli_fetch_array($atm_detail_qry);
?>
	<tr>
    	<td><?php echo $i;?></td>
        <td><?php echo $fundacc['hname']; ?></td>
        <td><?php echo $ebfundreq['req_no'];?></td>
        <td><?php echo $ebfundreq['atmid'];?></td>
        <td><?php echo $atm_detail['bank'];?></td>
        <td><?php echo $atm_detail['atmsite_address'];?></td>
        <td><?php echo $rev['dbtacc']; ?></td>
        <td><?php echo $rev['payment_type']; ?></td>
        <td><?php echo $rev['chqname'];?></td>
        <td><?php echo $rev['chqno'];?></td>
        <td><?php echo date('d-m-Y',strtotime($rev['pdate']));?></td>
        <td><?php echo $ebfundreq['approvedamt'];?></td>
        <td><?php echo $rev['pamount'];?></td>        
        <td>
			<?php echo $rev['remark'];?><br/>
            <a href="javascript:void(0);" id='feefbk<?php echo $i; ?>' onclick="newwin('viewefeed_reversal.php?reqid=<?php echo $ebfundreq['req_no']; ?>','display','500',400)">Click to view all Feedbacks</a>
        </td>
        <?php
        	if($_REQUEST['status']==2)
			{
		?>
        <td id="app<?php echo $i; ?>">        	
        	<input type="button" onclick="showrem('showrem<?php echo $i; ?>')" value="Update" style="background:#FFFF99" />
            <div id="showrem<?php echo $i; ?>" style="display:none">
                <textarea id="rem<?php echo $i; ?>"></textarea>
                <input type="button" onClick="approve('<?php echo $i; ?>','<?php echo $ebfundreq['req_no']; ?>')" value="Go" style="background:#FFFF99">
                <input type="button" onclick="showrem('showrem<?php echo $i; ?>')" value="Cancel" style="background:#FFFF99" />
            </div>
        </td>
        <?php
			}
		?>
        <?php
        	if($_REQUEST['status']==1 || $_REQUEST['status']==0)
			{
				echo "select username from login where username='".$rev['appby']."'";
				$sr=mysqli_query($con,"select username from login where srno='".$rev['appby']."'");
				$srno=mysqli_fetch_row($sr);
		?>
        <th><?php echo $srno[0];?></th>
        <?php
			}
		?>
        <?php
        	if($_REQUEST['status']==2)
			{
		?>
        <td><form method="post" name="ebform" action="process_ebfundtrans_app.php"><input type="text" name="reqid" value="<?php echo $ebfundreq['req_no']; ?>"/><input type="submit" value="Approve" name="sub"/></form></td>
        <td><form method="post" name="ebform" action="process_ebfundtrans_rej.php"><input type="text" name="reqid" value="<?php echo $ebfundreq['req_no']; ?>"/><input type="submit" value="Reject" name="sub"/></form></td>
        <?php
			}
		?>
    </tr>
<?php
			$i++;
		}
	}
?>
</table>
<?php
if($showpaging)
{
?>
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
<?php
}
?>
</div>