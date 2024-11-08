<?php
	include("config.php");
	session_start();
	$accmgr=0;
	$branchmgr=0;
	if($_SESSION['designation']==8 && $_SESSION['dept']==4 && $_SESSION['serviceauth']==2)
	{
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
		$accmgr=1;
	}
	else if($_SESSION['designation']==9 && $_SESSION['branch']!="all" && $_SESSION['branch']!="")
	{	
		$branchmgr=1;
	}
	else
	{
		$sr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
		$srno=mysqli_fetch_row($sr);
		$fundacc_qry=mysqli_query($con,"SELECT * FROM `fundaccounts` WHERE `srno` = '".$srno[0]."'");
		$fundacc=mysqli_fetch_row($fundacc_qry);
	}
	$sql="select e.req_no,e.atmid,e.trackerid,f.chqname,f.chqno,f.pdate,e.approvedamt,e.cust_id,e.supervisor from ebillfundrequests e,ebfundtransfers f where e.req_no=f.reqid and f.status=0 and e.req_no not in (SELECT reqid FROM `reversal` WHERE `status` <> 0) and e.req_no not in (SELECT reqid FROM `transfer` WHERE `status` <> 0)";
	if($accmgr || $branchmgr)
	{
		if($accmgr)
			$sql.=" and e.cust_id in (".$cl.") ";
		if($branchmgr)
			$sql.=" and e.supervisor in (SELECT distinct(hname) FROM `fundaccounts` WHERE srno in (SELECT srno FROM `login` where branch in (".$_SESSION['branch']."))) ";
		if(isset($_REQUEST['supv']) && $_REQUEST['supv']!="")
			$sql.="and e.supervisor='".$_REQUEST['supv']."' ";
	}
	else
	{
		//echo $fundacc[0];
		if($fundacc[0]=='')
		$sql.=" and f.accid='-1' ";
		else
		$sql.=" and f.accid='".$fundacc[0]."' ";
	}
	if(isset($_REQUEST['reqid']) && $_REQUEST['reqid']!="")
		$sql.="and e.req_no='".$_REQUEST['reqid']."'";
	if(isset($_REQUEST['atmid']) && $_REQUEST['atmid']!="")
		$sql.="and e.atmid='".$_REQUEST['atmid']."'";
	if(isset($_REQUEST['chqno']) && $_REQUEST['chqno']!="")
		$sql.="and f.chqno='".$_REQUEST['chqno']."'";
	if(isset($_REQUEST['sdate']) && $_REQUEST['sdate']!='' && isset($_REQUEST['edate']) && $_REQUEST['edate']!='')
	{
		$sdate=$_REQUEST['sdate'];
		$sdate=str_replace("/","-",$sdate);
		$sdate=date("Y-m-d",strtotime($sdate));
		$edate=$_REQUEST['edate'];
		$edate=str_replace("/","-",$edate);
		$edate=date("Y-m-d",strtotime($edate));
		if($sdate!=$edate)
			$sql.=" and pdate between STR_TO_DATE('".$_POST['sdate']."','%d/%m/%Y') and STR_TO_DATE('".$_POST['edate']."','%d/%m/%Y')";
		else
			$sql.=" and pdate='".$sdate."'";
	}
	$ebfundreq_qry=mysqli_query($con,$sql);
	$Num_Rows = mysqli_num_rows ($ebfundreq_qry);
?>
 <div align="center">Total Records: <b><?php echo $Num_Rows; ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
 <table id="style1" border="1">
	<tr>
    	<th>Sr. no.</th>
        <th>Reqid</th>
        <?php
			if($accmgr || $branchmgr)
			{
		?>
        <th>Supervisor</th>
		<?php
			}
		?>
        <th>Atm</th>
        <th>Bank</th>
        <th width="200px">Address</th>
        <th>Cheque Name</th>
        <th>Cheque No.</th>
        <th>Paid Date</th>
        <th>Amount</th>
        <th>Raise</th>
    </tr>
<?php
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
	$sql.="  order by f.pdate DESC,f.chqno LIMIT $Page_Start , $Per_Page";
	//echo $sql;
	$ebfundreq_qry=mysqli_query($con,$sql);
	$i=1;
	while($ebfundreq=mysqli_fetch_array($ebfundreq_qry))
	{
		$atm_detail_qry=mysqli_query($con,"select bank,atmsite_address from ".$ebfundreq['cust_id']."_sites where trackerid='".$ebfundreq['trackerid']."'");
		$atm_detail=mysqli_fetch_array($atm_detail_qry);
?>
	<tr>
    	<td><?php echo $i;?></td>
        <td><?php echo $ebfundreq['req_no'];?></td>
        <?php
			if($accmgr || $branchmgr)
			{
		?>
        <td><?php echo $ebfundreq['supervisor']; ?></td>
		<?php
			}
		?>
        <td><?php echo $ebfundreq['atmid'];?></td>
        <td><?php echo $atm_detail['bank'];?></td>
        <td><?php echo $atm_detail['atmsite_address'];?></td>
        <td><?php echo $ebfundreq['chqname'];?></td>
        <td><?php echo $ebfundreq['chqno'];?></td>
        <td><?php echo date('d-m-Y',strtotime($ebfundreq['pdate']));?></td>
        <td><?php echo $ebfundreq['approvedamt'];?></td>
        <td><button><a href="<?php if($_REQUEST['trans_type']=="reversal"){?>revesal_req_sv.php<?php }?><?php if($_REQUEST['trans_type']=="transfer"){?>transfer_req_sv.php<?php }?>?reqid=<?php echo $ebfundreq['req_no'];?>">Raise</a></button>
    </tr>
<?php
		$i++;
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