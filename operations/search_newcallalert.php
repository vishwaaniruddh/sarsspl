<?php
include("config.php");
include("access.php");
	
	session_start();
//include("access.php");
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry, your session has Expired'); window.location='index.php';</script>";
}
else
{
$callt=$_POST['calltype'];
$atm=$_POST['atm'];
$bank=$_POST['bank'];
$area=$_POST['area'];
$sdate=$_POST['sdate'];
$edate=$_POST['edate'];

$strPage = $_POST['Page'];

echo $callt;
	
	$sql="select * from alert_detail where 1 ";
	
	
	
	if($callt=="")
	{
	$sql.=" and status='0' or status='10' ";
	
	}
	elseif($callt==0)
	{
	$sql.=" and status='0' ";
	
	}
	elseif($callt==1)
	{
	$sql.=" and status='1' ";
	
	}
	elseif($callt==10)
	{
	$sql.=" and status='10' ";
	
	}
	
	//echo $sql;
	$table=mysqli_query($con,$sql);

$Num_Rows = mysqli_num_rows ($table);
?>


 <div align="center">
 <b>Total Records: <?php echo $Num_Rows; ?></b> &nbsp;&nbsp;Records Per Page :<select name="perpg" id="perpg" onchange="searchById('Listing','1','perpg');">
 
 <?php
 for($i=1;$i<=$Num_Rows;$i++)
 {
 if($i%10==0)
 {
 ?>
 <option value="<?php echo $i; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo $i."/page"; ?></option>
 <?php
 }
 }
 
 ?>
 <option value="<?php echo $Num_Rows; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$Num_Rows){?>  selected="selected" <?php } ?>><?php echo "All"; ?></option>
 </select>
 
 </div>
 <?php
 
########### pagins

$Per_Page =$_POST['perpg'];   // Records Per Page
 
$Page = $strPage;
if($strPage=="")
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
$qr22=$sql;
$sql.=" order by alertid ASC LIMIT $Page_Start , $Per_Page";
//echo $sql;



//$table=mysqli_query($con,"select cust_id,atm_id,bank_name,state,createdby from alert");
?>

<input type="button" onClick="tableToExcel('custtable', 'Table Export Example')" value="Export Table data into Excel"/>


<table border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" id="custtable" name="custtable" >
<th width="77">Sr No</th>
<th width="77">User Name</th>
<th width="77">Complaint No</th>

<th width="75">Call Receive Date</th>
<th width="125">Call Receive From</th>
<th width="125">Customer Name	</th>
<th width="125">Bank</th>
<th width="75">ATM</th>

<th width="75"> Area</th>
<th width="75">Address	</th>
<th width="75">City</th>

<th width="45">State</th>
<th width="45">Service Issue</th>

<th width="45">Work Type</th>
<th width="45">Call Deleget To	</th>
<th width="45">Contact Number</th>
<th width="45">Branch Manager</th>
<th>Call Status	</th>
<th width="45">Call Close Date	</th>
<th width="45">Closer Snaps</th>
<th width="45">Remarks</th>
<th>Update Remark</th>
<th>Standby Remark</th>
<th>Call Close Details</th>
<th>Update</th>



<?php
$qrys=mysqli_query($con,$sql);


$rcnt=1;
while($row=mysqli_fetch_array($qrys))
{

$getmby=mysqli_query($con,"select username from login where srno='".$row[25]."'");
$gmbrow=mysqli_fetch_array($getmby);


$gmat=mysqli_query($con,"select * from quot_details where alertid='".$row[0]."' ");
$gmrow=mysqli_fetch_array($gmat);


$gupdrem=mysqli_query($con,"select * from new_callupdate_details where alertid='".$row[0]."' ");
$gupdremr=mysqli_fetch_array($gupdrem);

$gcldet=mysqli_query($con,"select * from new_call_closedetail where alertid='".$row[0]."' ");
$clrow=mysqli_fetch_array($gcldet);
$clnor=mysqli_num_rows($gcldet);

$closedet="";
if($clnor>0)
{
$grename=mysqli_query($con,"select username from login where srno='".$clrow[3]."'");
$renrow=mysqli_fetch_array($grename);

$closedet=$renrow[0]."<br>".$clrow[2]."<br>".date('d-m-y',strtotime($clrow[4]));
}

$chcq=mysqli_query($con,"select alertid,remark from new_callstandby_details where alertid='".$row[0]."'");
$chrow=mysqli_fetch_array($chcq);
$nors=mysqli_num_rows($chcq);

$getdn=mysqli_query($con,"select * from new_call_closedetail where alertid='".$row[0]."'");
$nocr=mysqli_num_rows($getdn);
$dwnro=mysqli_fetch_array($getdn);
//echo "no=".$nors;

$status="";
if($row[21]=='0')
{
$status="Opened";
}
elseif($row[21]=='1')
{
$status="Closed";
}
elseif($row[21]=='10')
{
$status="Standby";
}


$cdelegate="";
if($row[19]=='0')
{

$fqr=mysqli_query($con,"select hname from fundaccounts where aid='".$row[13]."'");
$fqrow=mysqli_fetch_array($fqr);
$cdelegate=$fqrow[0];
}
else
{
$cdelegate="Geeta";
}
?>

<tr <?php if($nors>0 ){?>
	style="background-color:red;"
	<?php
	}?> >
       <td align="center"><?php echo $rcnt;?></td>
      <td align="center"><?php echo $gmbrow[0];?></td>
     <td align="center"><?php echo $row[24];?></td>
    <td align="center"><?php echo date('d-m-Y',strtotime($row[26]));?></td>
    <td align="center"><?php echo $row[10];?></td>
     <td align="center"><?php echo $row[1];?></td>
     <td align="center"><?php echo $row[3];?></td>
     
      <td align="center"><?php echo $row[2];?></td>
     <td align="center"><?php echo $row[4];?></td>
     <td align="center"><?php echo $row[5];?></td>


      <td align="center"><?php echo $row[8];?></td>
     <td align="center"><?php echo $row[6];?></td>
     <td align="center"><?php echo $gmrow[5];?></td>
    <td align="center"><?php echo "<b>".$gmrow[4].":"."<b><br>".$gmrow[2]?></td>
     <td align="center"><?php echo $cdelegate;?></td>
     

   <td align="center"><?php echo $row[9];?></td>
<td align="center"><?php echo $row[5];?></td>
<td align="center"><?php echo $status;?></td>
<td align="center"><?php if( $nocr>0 & $dwnro[4]!="0000-00-00 00:00:00" ) { echo date('d-m-Y',strtotime($dwnro[4])); }?></td>
<td align="center"><?php if($nocr>0 & $dwnro[5]!=""){?> <a href="new_callclose_uploads/<?php echo $dwnro[5]; ?>" download >Download</a><?php } ?></td>
<td align="center"><?php echo $row[15];?></td>
<td align="center"><?php echo $gupdremr[2];?></td>
<td align="center"><?php echo $chrow[1];?></td>
<td align="center"><?php echo $closedet;?></td>
<td align="center">
<input type="hidden" id="alid<?php echo $rcnt;?>" name="alid<?php echo $rcnt;?>" value="<?php echo $row[0];?>" readonly>

<?php if($row[21]!='1') { ?>
<input type="button" name="updcall<?php echo $rcnt;?>" id="updcall<?php echo $rcnt;?>" onclick="showupdiv(this.id);" value="Update"/><br>

<div style="display:none" id="updiv<?php echo $rcnt;?>">
Remark:<textarea  name="updrem<?php echo $rcnt;?>" id="updrem<?php echo $rcnt;?>"></textarea>
<input type="button" id='updb<?php echo $rcnt;?>' name='updb<?php echo $rcnt;?>' onclick="callupdfunc(this.id);" value="Update"/>
<input type="button" id='cancb<?php echo $rcnt;?>' name='cancb<?php echo $rcnt;?>' onclick="hidediv('updiv<?php echo $rcnt;?>');" value="Cancel"/>
</div><br>
<?php } ?>


<?php if($row[21]!='1' && $row[21]!='10' ) { ?>
<hr>
<input type="button" id="stndby<?php echo $rcnt;?>" name="stndby<?php echo $rcnt;?>" onclick="showstdiv(this.id);" value="Standby"/><br>
<div style="display:none" id="stndbydiv<?php echo $rcnt;?>">
Remark:<textarea  name="stndbyrem<?php echo $rcnt;?>" id="stndbyrem<?php echo $rcnt;?>"></textarea>
<input type="button" id='stndbyb<?php echo $rcnt;?>' name='stndbyb<?php echo $rcnt;?>' onclick="standbyfunc(this.id);" value="Update"/>
<input type="button" id='cancb<?php echo $rcnt;?>' name='cancb<?php echo $rcnt;?>' onclick="hidediv('stndbydiv<?php echo $rcnt;?>');" value="Cancel"/>
</div><br>
<?php } ?>


<?php if($row[21]!='1') { ?>
<hr>
<input type="button" id="closecall<?php echo $rcnt;?>" name="closecall<?php echo $rcnt;?>" onclick="showcldiv(this.id);" value="Close Call"/><br>
<div style="display:none" id="closecalldiv<?php echo $rcnt;?>">
Remark:<textarea  name="closecallrem<?php echo $rcnt;?>" id="closecallrem<?php echo $rcnt;?>"></textarea><br>
Upload Snaps<input type="file" name="file<?php echo $rcnt; ?>" id="file<?php echo $rcnt; ?>" value="Upload"/><br><br>
<input type="button" id='closecallb<?php echo $rcnt;?>' name='closecallb<?php echo $rcnt;?>' onclick="closecallfunc(this.id);" value="Update"/>
<input type="button" id='cancb<?php echo $rcnt;?>' name='cancb<?php echo $rcnt;?>' onclick="hidediv('closecalldiv<?php echo $rcnt;?>');" value="Cancel"/>
</div><br>
<?php } ?>

</td>

</tr>

<?php
$rcnt++;
}

?>
</table>
<div class="pagination" style="width:100%;"><font size="4" color="#000">
 <?php 

if($Prev_Page) 
{
	echo " <a href=\"JavaScript:func('$Prev_Page','perpg')\"> << Back</a> ";
}

if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:func('$Next_Page','perpg')\">Next >></a> ";
}


}

?>
