<?php
session_start();
//echo $_SESSION['user'];

include('config.php');

$strPage = $_REQUEST['Page'];

$cid="";
$strt="";
$endt="";
$sql="";


           if(isset($_POST['qid']) && $_POST['qid']!="")
	   {
	   $sql="select * from quotation1 where status!='c' and id='".$_POST['qid']."' ";
	   }
            else
            {

              if(isset($_POST['sdate']) && $_POST['sdate']!='' && isset($_POST['edate']) && $_POST['edate']!='')
                 {
                 $sdate=str_replace("/","-",$_REQUEST['sdate']);
                 $strt=date("Y-m-d",strtotime($sdate));
                 $edate=str_replace("/","-",$_REQUEST['edate']);
                 $endt=date("Y-m-d",strtotime($edate));
                 }
         
	 
	   if($_POST['cid']!=-1)
	   {
	   $sql="select * from quotation1 where cust='".$_POST['cid']."' and status!='c'";
           }
            else 
           {
            if($strt!="" && $endt!="")
             {
         $sql="select * from quotation1 where status!='c' ";
             }
           }

       
          if(isset($_POST['atmid']) && $_POST['atmid']!="")
	{
           $sql.=" and atm='".$_POST['atmid']."'";
        }
         

	
          if(isset($_POST['sdate']) && $_POST['sdate']!='' && isset($_POST['edate']) && $_POST['edate']!='')
          {

         //echo $sdate2;

           $sql.=" and  date(entrydate)>='".$strt."' and date(entrydate)<='".$endt."'";

                     }

     }

             //    echo $sql;
$table=mysqli_query($con,$sql);

$Num_Rows = mysqli_num_rows ($table);
 
// pagins
?>
 <div align="center">
 Records Per Page :<select name="perpg" id="perpg" onChange="searchById('Listing','1','perpg');">
 
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
$sql.=" order by id ";
if(isset($_POST['atmid']) && $_POST['atmid']=='')
$sql.=" LIMIT $Page_Start , $Per_Page";

//echo $sql;
$table=mysqli_query($con,$sql);
if(!$table)
echo mysqli_error();
//include_once('class_files/filter_new.php');
//$filter=new filter_new();
//$table=$filter->filter($id,$cid,$bank,$area,$pin,$city,$state,$sdate,$edate);

/*include_once('class_files/table_formation.php');
$form=new table_formation();
$form->table_forming(array("","","","","",""),$table,"n");*/
include("config.php");
?>

<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>
<table width="995" border="1" cellpadding="2" cellspacing="0"  id="custtable" style="margin-top:5px;"> 


<th width="75">Sr NO</th>
<th width="75">Category</th>
<th width="175">CSS Ref No</th>
<th width="90">Customer</th>
<th width="90">Project</th>
<th width="100">Bank</th>
<th width="175">Atm ID</th>
<th width="175">Site ID</th>
<th width="175">VPR NO</th>
<th width="175">I O CODE</th>
<th width="175">JOB ID</th>
<th width="105">City</th>
<th width="175">State</th>

<th width="300">Location</th>
<th width="600">WorkDetails</th>

<th width="75">Zone</th>
<th width="75">Month</th>
<th width="75">Approval Date</th>

<th width="75">Approval Amount</th>
<th width="75">Approved By</th>
<th width="300">Mail By</th>


<?php

if(mysqli_num_rows($table)>0) {
$count=0;
$srn=1;
while($row= mysqli_fetch_row($table))
{
//echo $row[10]."<br>";

$qry1=mysqli_query($con,"select short_name,contact_first from contacts where short_name='$row[2]'");
$qrrow=mysqli_fetch_array($qry1);

//echo "select username from login where srno='".$row[1]."'";
$branch=mysqli_query($con,"select username from login where srno='".$row[1]."'");
$brro=mysqli_fetch_row($branch);

//echo "select projectid from $row[2]_sites where atm_id1='".$row[3]."'";
$projq=mysqli_query($con,"select projectid,site_id,zone from $row[2]_sites where atm_id1='".$row[3]."'");
$projrow=mysqli_fetch_row($projq);

$gapdet=mysqli_query($con,"Select * from quotation_approve_details where qid='".$row[0]."'");
$nurws=mysqli_num_rows($gapdet);
$approw="";
if($nurws>0)
{
$approw=mysqli_fetch_array($gapdet);


}



?>
<tr>
<td align="center"><?php echo $srn;?></td>
<td align="center"><?php if($row[12]=="a"){ echo "Approval Basis"; }elseif($row[12]=="f"){echo "Fixed Cost"; };?></td>
<td align="center" width="170"><?php echo $row[1];?></td>
<td align="center"><?php echo $qrrow[1];?></td>
<td align="center"><?php echo $projrow[0];?></td>
<td align="center"><?php echo $row[4];?></td>
<td align="center"><?php echo $row[3];?></td>
<td align="center"><?php echo $projrow[1];?></td>
<td align="center"><?php echo $approw[3];?></td>
<td align="center" ><?php echo $approw[4];?></td>
<td align="center"><?php echo $approw[5];?></td>
<td align="center"><?php echo $row[7];?></td>
<td align="center"><?php echo $row[8];?></td>
<td align="center"><?php echo $row[6];?></td>

<td align="center">
<?php
//echo "select description from quotation_details where qid='".$row[0]."' and revised_status!='d'";
$wrkqry=mysqli_query($con,"select description from quotation_details where qid='".$row[0]."'");
//echo mysqli_error();
while($wrkrow=mysqli_fetch_array($wrkqry))
{
echo $wrkrow[0].",";

}
 ?>
</td>
<td align="center"><?php echo $projrow[2]; ?></td>
<td align="center"><?php if($nurws>0)
{ echo $row[13]." ".$row[14]; }?> </td>
<td align="center"><?php if($nurws>0)
{ echo date( 'd/m/Y g:i A', strtotime($approw[11])); }?></td>
<td align="center"><?php if($nurws>0)
{ echo round($approw[9]); }?></td>
<td align="center"><?php if($nurws>0)
{ echo $approw[7]; }?></td>
<td></td>


</tr>



<?php
$srn++;
}
?>
</td></tr></div></div></table>
<div class="pagination" style="width:100%;"><font size="4" color="#000">
 <?php 

}
if($Prev_Page) 
{
	echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page','perpg')\"> << Back</a> ";
}
/*
for($i=1; $i<=$Num_Pages; $i++){
	if($i != $Page)
	{
		echo " <li><a href=\"JavaScript:searchById('Listing','$i')\">$i</a> </li>";
	}
	else
	{
		echo "<li class='currentpage'><b> $i </b></li>";
	}
}*/
if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\">Next >></a> ";
}
?>