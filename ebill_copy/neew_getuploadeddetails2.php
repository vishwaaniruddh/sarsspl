<?php
include("config.php");
include("access.php");
	
session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry, your session has Expired'); window.location='index.php';</script>";
}
else
{

$rerqs="";
if($_POST['reqno']!='')
{
//echo $_POST['atm'];
$qidn=array();
$qidr=str_replace("\n",",",$_POST['reqno']);
$qidt=explode(",",$qidr);

for($i=0;$i<count($qidt);$i++)
{
if($qidt[$i]!='')
{

if($rerqs=="")
{
    
    $rerqs=$qidt[$i];
}else
{
     $rerqs=$rerqs.",".$qidt[$i];
    
}

}
}
}

$strPage = $_POST['Page'];

$notreqid="";
$qrups=mysqli_query($con,"select reqno from online_transaction_uploads");
while($qrupfr=mysqli_fetch_array($qrups))
{
    
    if($notreqid=="")
    {
        $notreqid=$qrupfr[0];
        
    }else
    {
        
        $notreqid=$notreqid.",".$qrupfr[0];
    }
    
}
	
	//$qry="Select * from quotation1 where status!='c'  and  local_status='0' ";
       $qry="Select * from online_transaction_new where 1 "; 


if($notreqid!="")
{
    $qry=$qry." and id not in($notreqid)";
    
    
}

if($_POST["pdt"]!="")
{
       $date = str_replace('/', '-', $_POST["pdt"]);
$dtt= date('Y-m-d', strtotime($date));

$qry=$qry." and PAID_DATE='".$dtt."'";
}
 
 
 if($_POST["entrydt"]!="")
{
       $date = str_replace('/', '-', $_POST["entrydt"]);
$dtt= date('Y-m-d', strtotime($date));

$qry=$qry." and UPLOADED_DT='".$dtt."'";
} 


if($rerqs!="")
{
   
$qry=$qry." and id in($rerqs)";
} 
//echo $qry;
$table=mysqli_query($con,$qry);

$Num_Rows = mysqli_num_rows ($table);


	
	
	?>
<div align="center">
 Records Per Page :<select name="perpg" id="perpg" onChange="func('1','perpg');">
 
 <?php
 for($i=1;$i<=$Num_Rows;$i++)
 {
 if($i%50==0)
 {
 ?>
 <option value="<?php echo $i; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo $i."/page"; ?></option>
 <?php
 }
 }
 
 ?>
 <option value="<?php echo $Num_Rows; ?>"><?php echo "All"; ?></option>
 </select>
 
 </div>
 <?php
// pagins
//echo $_POST['perpg'];
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
	


$qry.=" ORDER BY id ASC ";
	
	$qry.=" LIMIT $Page_Start , $Per_Page";
	
	$qrys=mysqli_query($con,$qry);
	//echo $qry;	
	?>





<center>

	<input type="hidden" id="expqry" name="expqry" value="<?php echo $qry;?>">

<table id="tableID" style="width:100%" align="center">
    <tr>
<th>Sr.No</th>
<th>Req no</th>
<th>Customer</th>
<th>Trans ID</th>
<th>Paid Person</th>
<th>ATM ID</th>
<th>Bank</th>
<th>Bill Date</th>
<th>Due Date</th>
<th>From</th>
<th>To</th>
<th>Days</th>
<th>Units</th>
<th>Bill Amt</th>
<th>Paid Amt</th>
<th>Priority</th>
<th>Bill Copy</th>
<th>Receipt Copy</th>
                   

</tr>
<?php
$srn=1;
while($rw=mysqli_fetch_array($qrys))
{
    $sr=mysqli_query($con,"select username from login where srno='".$rw["UPLOADED_BY"]."'");
			$srno=mysqli_fetch_row($sr);

    ?>
    <tr><td><?php echo $srn;?></td>
    <td><?php echo $rw["id"];?>
    <input type="hidden" id="reqno<?php echo $srn;?>" name="reqno[]" value="<?php echo $rw["id"];?>">
    </td>
    <td><?php echo $rw["Customer"];?></td>
    <td><?php echo $rw["TRANS_ID"];?></td>
    <td><?php echo $srno[0];?></td>
    <td><?php echo $rw["ATMID"];?></td>
    <td><?php echo $rw["BANK"];?></td>
    <td><?php echo $rw["PAID_DATE"];?></td>
    <td><?php echo "";?></td>
    <td><?php echo "";?></td>
    <td><?php echo "";?></td>
    <td><?php echo "";?></td>
    <td><?php echo "";?></td>
    <td><?php echo $rw["BILL_AMOUNT"];?></td>
    <td><?php echo $rw["PAID_AMOUNT"];?></td>
    <td><?php echo $rw["PRIORITY"];?>
    </td>

 <td><input type="file" id="img1up<?php echo $srn;?>" name="imguprec[]" ></td>
    <td><input type="file" id="img2up<?php echo $srn;?>" name="imgup[]" ></td>

    </tr>

    
<?php    

    
    $srn++;
}




?>	
	
	</table>
	<input type="submit" name="submit" id="submit" value="Upload" />


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
?>



<?php } ?>
</div>

</center>
