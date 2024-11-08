<?php
	include("config.php");
	session_start();
	$accmgr=0;
	if($_SESSION['designation']==8 && $_SESSION['dept']==4 && $_SESSION['serviceauth']==2)
		$accmgr=1;	
	$supv_stat=0;
	if($_SESSION['designation']==11)
		$supv_stat=1;
	$sr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
	$supv_stat1=mysqli_fetch_row($sr);
	$sup_str="select distinct(hname) from fundaccounts where 1 ";
	if($_SESSION['designation']==9 && $_SESSION['branch']!="all" && $_SESSION['branch']!="")
		$sup_str.="and srno in (SELECT srno FROM `login` where branch in (".$_SESSION['branch']."))";
	if($supv_stat)
		$sup_str.="and srno ='".$supv_stat1[0]."'";
	$sup_qry=mysqli_query($con,$sup_str);
	$sql="SELECT *  FROM `ebillfundrequests` WHERE `reqstatus` = 8 AND `approvedamt` <> '' AND `chqno` <> '' AND `print` like 'n' AND `pstat` = 0 ";
	$receipt_qry=mysqli_query($con,"SELECT reqid FROM `update_receipt`");
	if(mysqli_num_rows($receipt_qry)>0)
		$sql.=" AND req_no not in (SELECT reqid FROM `update_receipt`) ";
	$reversal_qry=mysqli_query($con,"SELECT reqid FROM `reversal` WHERE `status` = 1");
	if(mysqli_num_rows($reversal_qry)>0)
		$sql.=" AND req_no not in (SELECT reqid FROM `reversal` WHERE `status` = 1) ";
	if(mysqli_num_rows($sup_qry)>0)
	{
		$sql.=" AND supervisor in ($sup_str) ";
	}
	else
	{
		if($supv_stat)
			$sql.=" AND supervisor in ('') ";
	}
		
	if(isset($_REQUEST['reqid']) && $_REQUEST['reqid']!="")
		$sql.=" and req_no='".$_REQUEST['reqid']."'";
	if(isset($_POST['sup']) && $_POST['sup']!='-1' && $_POST['sup']!='')
		$sql.=" and supervisor='".$_POST['sup']."'";
	if(isset($_POST['atmid']) && $_POST['atmid']!='')
		$sql.=" and atmid like '".$_POST['atmid']."'";
	if(isset($_REQUEST['sdate']) && $_REQUEST['sdate']!='' && isset($_REQUEST['edate']) && $_REQUEST['edate']!='')
	{
		$sdate=$_REQUEST['sdate'];
		$sdate=str_replace("/","-",$sdate);
		$sdate=date("Y-m-d",strtotime($sdate));
		$edate=$_REQUEST['edate'];
		$edate=str_replace("/","-",$edate);
		$edate=date("Y-m-d",strtotime($edate));
		if($sdate!=$edate)
			$sql.=" and entrydate between STR_TO_DATE('".$_POST['sdate']."','%d/%m/%Y') and STR_TO_DATE('".$_POST['edate']."','%d/%m/%Y')";
		else
			$sql.=" and entrydate='".$sdate."'";
	}	
	if($accmgr)
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
		$sql.=" and cust_id in (".$cl.") ";
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
        <th>Customer</th>
        <th>Supervisor</th>
        <th>Atm</th>
        <th>Bank</th>
        <th width="200px">Address</th>
        <th>Bill Date</th>
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
	$sql.="  order by req_no DESC LIMIT $Page_Start , $Per_Page";
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
        <td><?php echo $ebfundreq['cust_id'];?></td>
        <td><?php echo $ebfundreq['supervisor'];?></td>
        <td><?php echo $ebfundreq['atmid'];?></td>
        <td><?php echo $atm_detail['bank'];?></td>
        <td><?php echo $atm_detail['atmsite_address'];?></td>
        <td><?php echo date('d-m-Y',strtotime($ebfundreq['bill_date']));?></td>
        <td><?php echo $ebfundreq['approvedamt'];?></td>
        <td id="app<?php echo $i; ?>">        	
        	<input type="button" onclick="showrem('showrem<?php echo $i; ?>')" value="Update" style="background:#FFFF99" />
            <div id="showrem<?php echo $i; ?>" name="showrem<?php echo $i; ?>" style="display:none">
            	<input type="text" id="amt<?php echo $i; ?>" value="<?php echo $ebfundreq['approvedamt'];?>" onKeyPress="return isNumberKey(event);"/><br/>
                <input type="text" name="pdate<?php echo $i; ?>" id="pdate<?php echo $i; ?>" onclick="displayDatePicker('pdate<?php echo $i; ?>');" readonly="readonly" placeholder="Paid Date"/><br />
                <textarea id="rem<?php echo $i; ?>"></textarea><br />
                <input type="button" onClick="approve('<?php echo $i; ?>','<?php echo $ebfundreq['req_no']; ?>')" value="Go" style="background:#FFFF99">
                <input type="button" onclick="showrem('showrem<?php echo $i; ?>')" value="Cancel" style="background:#FFFF99" />
            </div>
        </td>
        <td id="scnscpy<?php echo $i; ?>" style="display:none;width:150px">
        	<form name="scan_update" method="post" action="process_updatereceipt_req_scncpy.php" enctype="multipart/form-data">
            	<input type="hidden" name="sup" value="<?php if(isset($_POST['sup']) && $_POST['sup']!='-1' && $_POST['sup']!=''){ echo $ebfundreq['supervisor'];}?>" />
            	<input type="hidden" name="req_id" value="<?php echo $ebfundreq['req_no'];?>" />
                <input type="file" name="scancpy" id="scancpy" required="required"><br />
                <input type="submit" name="cmdsub" value="Submit"/>
            </form>
        </td>
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