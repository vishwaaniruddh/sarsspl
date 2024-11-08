<?php
	include("config.php");
	session_start();
	$accmgr=0;
	$branchmgr=0;
	

	$sql="select e.reqid,e.chqname,o.cheqno,e.pdate,o.aid,o.approvedamt,f.hname,e.remark,o.reqid from fundaccounts f, onacctransfer o,ebonacctransfers e where o.reqstatus=8 and o.aid=f.aid and o.reqid=e.reqid and o.reqid not in (SELECT reqid FROM `onaccount_reversal` WHERE `status` <> 0)";
//and e.req_no not in (SELECT reqid FROM `reversal` WHERE `status` <> 0) 


if(isset($_REQUEST['supv']) && $_REQUEST['supv']!="")
{
$sql.="and f.hname='".$_REQUEST['supv']."' ";
}
	if(isset($_REQUEST['reqid']) && $_REQUEST['reqid']!="")
		$sql.="and e.reqid='".$_REQUEST['reqid']."'";
	
	if(isset($_REQUEST['chqno']) && $_REQUEST['cheqno']!="")
		$sql.="and f.chqno='".$_REQUEST['cheqno']."'";
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



//echo $sql;
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
        <th>Account id</th>
        <th>Name</th>
        <th>Cheque Name</th>
        <th>Cheque No.</th>
        <th>Paid Date</th>
        <th>approved Amount</th>
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
	$sql.="  order by e.pdate,o.aid DESC LIMIT $Page_Start , $Per_Page";
	//echo $sql;
	$ebfundreq_qry=mysqli_query($con,$sql);
	$i=1;
	while($ebfundreq=mysqli_fetch_array($ebfundreq_qry))
	{
?>
	<tr>
    	<td><?php echo $i;?></td>
        <td><?php echo $ebfundreq['aid'];?></td>
      
        <td><?php echo $ebfundreq['hname']; ?></td>
		

		

        <td><?php echo $ebfundreq['chqname'];?></td>
        <td><?php echo $ebfundreq['cheqno'];?></td>
        <td><?php echo date('d-m-Y',strtotime($ebfundreq['pdate']));?></td>
        <td><?php echo $ebfundreq['approvedamt'];?></td>
        <td><button onclick="window.open('revesal_reqOnAcc_sv.php?reqid=<?php echo $ebfundreq['reqid'];?>','_self');"> Raise</button>
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