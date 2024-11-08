<?php
session_start();
include "config.php"; 

$strPage=$_POST['Page'];

$fdate=$_POST['fdate'];
$tdate=$_POST['tdate'];
$progress=$_POST['progress'];
//$actionid=$_POST['actionid'];
$orderid=$_POST['orderid'];
$dt=str_replace("/","-",$fdate);
$newDate = date("Y-m-d", strtotime($dt));
$dt1=str_replace("/","-",$tdate);
$Date=date("Y-m-d", strtotime($dt1));


/*if($progress!=0)
{
    $View = "SELECT a.id,a.user_id,a.amount,a.status,a.date,b.status FROM Orders a INNER JOIN order_details b ON a.id=b.oid  where a.id in(SELECT oid FROM `order_details` where mrc_id='".$_SESSION["id"]."')";

}*/


//$View = "SELECT id,user_id,amount,status,date FROM `Orders` where id in(SELECT oid FROM `order_details` where mrc_id='".$_SESSION["id"]."')";

 $View = "SELECT a.id,a.user_id,a.amount,a.status,a.date,b.status FROM Orders a INNER JOIN order_details b ON a.id=b.oid  where b.mrc_id in(SELECT mrc_id FROM `order_details` where mrc_id='".$_SESSION["id"]."')";
//echo "ram".$View;
if($newDate!="1970-01-01")
{
    $View .= " and a.date >= '".$newDate."'";
    
}
if($Date!="1970-01-01")
{
    $View .= " and a.date <= '".$Date."'";
    
}
if($progress!="")
{
    $View .= " and b.status = '".$progress."'";
    
}
if($orderid!="")
{
    $View .= " and a.id = '".$orderid."'";
    
}
if($actionid!="")
{
    if($actionid=="pro")
    {
    $View .= " and status = 'pending'";
    }
    elseif($actionid=="dis")
    {
    $View .= " and status = 'pro'";
    }
    elseif($actionid=="c")
    {
    $View .= " and status = 'dis'";
    }
     elseif($actionid=="rej")
    {
    $View .= " and status = 'dis'";
    }
}
//echo ($View);
$table=mysqli_query($con1,$View);

$Num_Rows = mysqli_num_rows($table);

//echo $View;
?>
<div align="center" >
 Records Per Page :<select name="perpg" id="perpg" onChange="funcs('1','perpg');"><br>
 
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
 <option value="<?php echo $Num_Rows; ?>"><?php echo "All"; ?></option>
 </select>
 
 </div>
<?php
// pagins
//echo $_POST['perpg'];
$Per_Page =$_POST['perpg'];   // Records Per Page
 
 
 //echo $Per_Page;
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
	


//$View.=" ORDER BY cust ASC ";
	
	$View.=" LIMIT $Page_Start , $Per_Page";
	
	$qrys=mysqli_query($con1,$View);
//	echo $View;	
	
	


?>






<table  border="1" id="tbl" class="table table-bordered table-hover">
<tr>
<th>Order ID</th>
<th>Customer</th>
<th>Address</th>
<th>Total Amount</th>
<th>date</th>
<th>View</th>
<th>Status</th>
<!--<th>Action</th>-->

</tr>
<?php
//$qryshow=mysql_query("SELECT id,user_id,amount,status,date FROM `Order`");
while($fetchshow=mysql_fetch_array($qrys))
{
$qryname=mysqli_query($con1,"select Firstname,Lastname,address,email from Registration where id='".$fetchshow[1]."'");
$fetchnm=mysqli_fetch_array($qryname);

$View2 = mysqli_query($con1,"SELECT oid,status FROM `order_details` where mrc_id='".$_SESSION["id"]."' and oid='".$fetchshow[0]."'");
$fetchstatus2=mysqli_fetch_array($View2);



$stt="";
$nm="";
$rej="";

if($fetchstatus2[1]=="pending")
{//$stt="anand";
   $stt="Accept";
$rej="/Reject";
$nm=0;
}


else if($fetchstatus2[1]=="Accept"){
   // $stt="Accept";
    $stt="processing";
   
    $nm=1;
}
else if($fetchstatus2[1]=="pr")
{//$stt="processing";
$stt="dispatch";
$nm=2;
}
else if($fetchstatus2[1]=="dis")
{//$stt="dispatch";
$stt="Delivered";
//$rej="/Reject";
$nm=3;
}
else if($fetchstatus2[1]=="c")
{$stt="completed";
$nm=5;
}

$st="";
if($fetchstatus2[1]=="pending")
{
$st=" ";

}
elseif($fetchstatus2[1]=="Accept")
{
$st="Accept";
//$st="pending";
}

elseif($fetchstatus2[1]=="pr")
{//$st="Accept";
$st="Processing";
}
elseif($fetchstatus2[1]=="dis")
{//$st="Processing";
$st="dispatch";
}
elseif($fetchstatus2[1]=="c")
{//$st="dispatch";
$st="Delivered";
}
elseif($fetchstatus2[1]=="rej")
{
$st="Reject";
}
elseif($fetchstatus2[1]=="completed")
{
$st="completed";
}


//=========


?>
<tr align="center">
<td ><?php echo $fetchshow[0];?></td>
<td><?php echo $fetchnm[0]." ".$fetchnm[1];?></td>
<td><?php echo $fetchnm[2];?></td>
<td><?php echo $fetchshow[2];?></td>
<td><?php echo $fetchshow[4];?></td>
<td><a href="javascript:void(0)" onclick="showdeatis('<?php echo $fetchshow[0];?>');">View</a></td>
<td><?php echo $st;?></td>


<!--
<td>
    
    <?php if($fetchstatus2[1]=="pending"){?>
<a href="javascript:void(0)" onclick="orderprocess('<?php echo $fetchshow[0];?>','<?php echo $nm;?>');"><?php echo $stt;?></a><?php } ?>

  <?php if($fetchstatus2[1]=="rej"){?>
<a href="javascript:void(0)"    onclick="orderprocess('<?php echo $fetchshow[0];?>','<?php echo 4;?>');"><?php echo $rej;?></a><?php } ?>





 <?php if($fetchstatus2[1]=="Accept"){?>
<a href="javascript:void(0)" onclick="orderprocess('<?php echo $fetchshow[0];?>','<?php echo $nm;?>');"><?php echo $stt;?></a><?php } ?>


   <?php if($fetchstatus2[1]=="pr"){?>
 <a href="javascript:void(0)" onclick="<?php if($fetchshow[3]=="pr"){ echo "popshow('$fetchshow[0]',' 1')"; } else { echo "orderprocess('$fetchshow[0]',' $nm')"; } ?>">
<?php echo $stt;?></a><?php } ?>

<?php if($fetchstatus2[1]=="dis"){?>
<a href="javascript:void(0)" onclick="orderprocess('<?php echo $fetchshow[0];?>','<?php echo $nm;?>');" ><?php echo $stt;?></a><?php } ?>

<a href="javascript:void(0)" onclick="orderprocess('<?php echo $fetchshow[0];?>','<?php echo 4;?>');"><?php echo $rej;?></a>



<?php if($fetchstatus2[1]=="c"){?>
<!--<a href="javascript:void(0)" onclick="<?php if($fetchshow[3]=="c"){ echo "popshow('$fetchshow[0]',' 6')"; } else { echo "orderprocess('$fetchshow[0]',' $nm')"; } ?>">-->
<!--<?php echo $stt;?></a> 


<?php } ?>
</td>-->

<?php } ?>
</table>



<div class="pagination" style="width:100%;" align="center"><font size="4" color="#000">
 <?php 

if($Prev_Page) 
{
	echo " <a href=\"JavaScript:funcs('$Prev_Page','perpg')\"> << Back</a> ";
}

if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:funcs('$Next_Page','perpg')\">Next >></a> ";
}
?>
	
	</div>