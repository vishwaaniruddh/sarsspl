<div align="center">
<?php

	include("config.php");
	session_start();
	
	$rev_str="SELECT * FROM `onaccount_reversal` where 1 ";
	
	
	if(isset($_REQUEST['status']) && $_REQUEST['status']!="")
		$rev_str.="and status='".$_REQUEST['status']."' ";
	if(isset($_REQUEST['chqno']) && $_REQUEST['chqno']!="")
		$rev_str.="and chqno='".$_REQUEST['chqno']."' ";
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
			$rev_str.=" and entrydate like '".$sdate."%'";
	}
	//echo $rev_str;
	$rev_qry=mysqli_query($con,$rev_str);
	
	
	

	$Num_Rows = mysqli_num_rows ($rev_qry);
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

/***********************

	$rev_str.="order by pdate DESC LIMIT $Page_Start , $Per_Page";

//echo $rev_str;


	$rev_str.="order by pdate DESC,chqno";
	//echo $rev_str;


*******************/
	?>

<table id="style1" border="1">
	<tr>
    	<th>Sr. no.</th>
        <th>Supervisor</th>
       
        <th>Reqid</th>
        <th>Credit Ac.</th>
        <th>Payment Type</th>
        <th>Cheque Name</th>
        <th>Cheque No.</th>
        <th>Paid Date</th>
        <th>Approved Amount</th>
        <th>Raised Amount</th>
         <th>Remarks</th>
      
    </tr>


<?php

//echo $rev_str;
//$rev_qry=mysqli_query($con,$rev_str);
	$i=1;
	while($rev=mysqli_fetch_array($rev_qry))
	{

		
		//echo "hello";


			$fundacc_qry=mysqli_query($con,"SELECT * FROM `fundaccounts` WHERE aid= '".$rev['accid']."'");
                        $fundacc=mysqli_fetch_array($fundacc_qry);

$onacc_qry=mysqli_query($con,"SELECT * FROM onacctransfer WHERE aid= '".$rev['accid']."'");
                        $onacc=mysqli_fetch_array($onacc_qry);


			//$ebfundreq=mysqli_fetch_array($ebfundreq_qry);
 


?>
	<tr>
    	<td><?php echo $i;?></td>
        <td><?php echo $fundacc['1']; ?></td>
        <td><?php echo $rev['reqid'];?></td>
        
        <td><?php echo $rev['dbtacc']; ?></td>
        <td><?php echo $rev['payment_type']; ?></td>
        <td><?php echo $rev['chqname'];?></td>
        <td><?php echo $rev['chqno'];?></td>
        <td><?php echo date('d-m-Y',strtotime($rev['pdate']));?></td>
        <td><?php echo $onacc['approvedamt'];?></td>
        <td><?php echo $rev['pamount'];?></td>        
        <td>
			<?php echo $rev['remark'];?><br/>
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

