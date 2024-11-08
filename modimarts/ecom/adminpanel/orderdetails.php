<?php
session_start();
include "config.php"; 

$strPage=$_POST['Page'];
$mernam=$_POST['mername'];
$dcity=$_POST['cityddl'];

$fdate=$_POST['fdate'];
$tdate=$_POST['tdate'];
$progress=$_POST['progress'];
$dt=str_replace("/","-",$fdate);
$newDate = date("Y-m-d", strtotime($dt));
$dt1=str_replace("/","-",$tdate);
$Date=date('Y-m-d', strtotime($dt1));

//$View = "SELECT id,user_id,amount,status,date FROM `Orders` where id in(SELECT oid FROM `order_details` where mrc_id='".$_SESSION["id"]."')";
$View="select name,city,state,address,category,rdate,till_date,email from clients where 1=1";



if($dcity!="")
{
    $View .= " and city = '".$dcity."'";
    
}
if($mernam!="")
{
    $View .= " and name = '".$mernam."'";
    
}
if($newDate!="1970-01-01")
{
    $View .= " and rdate >= '".$newDate."'";
    
}
if($Date!="1970-01-01")
{
    $View .= " and till_date <= '".$Date."'";
    
}
if($progress!="")
{
    $View .= " and status = '".$progress."'";
    
}



$table=mysql_query($View);

$Num_Rows = mysql_num_rows($table);

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
	
	$qrys=mysql_query($View);
//	echo $View;	
	
	


?>
<table  border="1" id="tbl" class="table table-bordered table-hover">
<tr>

<th>Merchant Name</th>
<th>City</th>

<th>Address</th>
<th>Category</th>
<th>Email</th>
<th>From Date</th>
<th>Till Date</th>

<th>Status</th>

</tr>
<?php
//$qryshow=mysql_query("SELECT id,user_id,amount,status,date FROM `Order`");
while($fetchshow=mysql_fetch_array($qrys))
{
    $qrycity=mysql_query("select code,name from cities where code='".$fetchshow[1]."'");
$fetchcity=mysql_fetch_array($qrycity);

    
    
$qryname=mysql_query("select Firstname,Lastname,address from Registration where id='".$fetchshow[1]."'");
$fetchnm=mysql_fetch_array($qryname);

$stt="";
$nm="";
$rej="";
if($fetchshow[3]=="pending")
{
$stt="processing";
$nm=1;
}
elseif($fetchshow[3]=="pr")
{
$stt="dispatch";
$nm=2;
}
elseif($fetchshow[3]=="dis")
{
$stt="complete";
$rej="/Reject";
$nm=3;
}


$st="";

if($fetchshow[3]=="pending")
{
$st="pending";

}
elseif($fetchshow[3]=="pr")
{
$st="Processing";
}
elseif($fetchshow[3]=="dis")
{
$st="dispatch";
}
elseif($fetchshow[3]=="c")
{
$st="Complete";
}
elseif($fetchshow[3]=="rej")
{
$st="Reject";
}


//=========


?>
<tr align="center">
<td ><?php echo $fetchshow[0];?></td>
<td><?php echo $fetchcity[1];?></td>

<td><?php echo $fetchshow[3];?></td>
<td><?php echo $fetchshow[4];?></td>
<td><?php echo $fetchshow[7];?></td>
<td><?php echo $fetchshow[5];?></td>
<td><?php echo $fetchshow[6];?></td>

<td><?php echo $st;?></td>

</tr>
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