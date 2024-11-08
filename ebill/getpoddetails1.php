<?php
session_start();
include("config.php");

         $pod=$_GET['podn'];




        $dt1=str_replace("/","-",$_GET['strt']);
	$start=date('Y-m-d', strtotime($dt1));
 
	$dt2=str_replace("/","-",$_GET['end']);
	$end=date('Y-m-d', strtotime($dt2));


$gtotal=0;
$qry="";
$qry2="";
$totaldet=0;
$stotal=0;



if($pod!="" )
{
$qry="select distinct pod,received_from from ebill_package where pod='".$pod."'";
               
         $qry2=mysqli_query($con,"select sum(total_amount) from ebill_package where pod='".$pod."'");
         
		
		 $row1 = mysqli_fetch_array($qry2);
			   $gtotal=$row1[0];
                 	
                  
                   $qry5=mysqli_query($con,"select count(pod) from ebill_package where pod='".$pod."'");
                   $row5 = mysqli_fetch_array($qry5);
                   $totaldet=$row5[0];
}        
else
{
$qry="select distinct pod,received_from from ebill_package where  DATE(entrydate)  >='".$start."' and DATE(entrydate) <='".$end."'";
//echo $qry;
//$qry="select distinct(pod),received_from from ebill_package where entrydate Between '".$start."' and '".$end."'";
       $qry2=mysqli_query($con,"select sum(total_amount) from ebill_package where  DATE(entrydate)  >='".$start."' and DATE(entrydate) <='".$end."'");
		        // echo $qry1;        
		$row8 = mysqli_fetch_array($qry2);
		  $gtotal=$row8[0];
                 	
                   

  $qry5=mysqli_query($con,"select count(pod) from ebill_package where DATE(entrydate)  >='".$start."' and DATE(entrydate) <='".$end."'");
                   $row5 = mysqli_fetch_array($qry5);
                   $totaldet=$row5[0];

}
    
//echo   $qry;                       

?>
<center><input type="button" id="ex1" name="ex1" value="Export Table to Excel" onclick="toexcel1();"/></center>
<table border="1" align="center" name="podt" id="podt">
  <tr>
  
  <th width="120" height="30">Pod No</th>
 <th width="120" height="30">Received From</th>
  <th width="120" height="30">Total Amount</th>
    <th width="120" height="30">Total count</th>
  <th width="120" height="30">Entrydate</th>
   <th width="120" height="30">View Details</th>


</tr>
<?php 


 $cnt=0;
 $qry1=mysqli_query($con,$qry);
$numr=mysqli_num_rows($qry1);
echo "<center><b>"."Total Number of Records :".$numr."&nbsp;&nbsp;"."Total number of details :".$totaldet."&nbsp;&nbsp"."Total Amount :".round($gtotal)."</b></center>";
		while($row2 = mysqli_fetch_array($qry1))
		  {
			           
?>




<tr>

<td align="center"><input  type="text" id="podnum<?php echo $cnt; ?>" name="podnum" value="<?php echo $row2[0]; ?>" readonly="readonly"/></td>
<td align="center"><input  type="text" align="center" id="recf<?php echo $cnt; ?>"  name="recf" value="<?php echo $row2 [1]; ?>" readonly="readonly"/> </td>
<?php

   $qry9=mysqli_query($con,"select sum(total_amount) from ebill_package where pod='".$row2[0]."' and received_from='".$row2[1]."' and DATE(entrydate)  >='".$start."' and DATE(entrydate) <='".$end."' ");
		        // echo $qry1;
		     $tot=0;   
		$row8 = mysqli_fetch_array($qry9);
		  
		
			  $tot= $row8[0];
                 	
     $qry10=mysqli_query($con,"select count(pod),entrydate from ebill_package where pod='".$row2[0]."' and received_from='".$row2[1]."' and DATE(entrydate)  >='".$start."' and DATE(entrydate) <='".$end."' ");
$qry10a=mysqli_fetch_array($qry10);

$edt=$qry10a[1];
$entrdate=date("d/m/Y", strtotime($edt));
?>
<td align="center"><?php echo round($tot); ?></td>
<td align="center"><?php echo $qry10a[0]; ?></td>
<td align="center"><?php echo $entrdate; ?></td>

<td align="center"><input type="button" id="viewpod<?php echo $cnt; ?>" name="viewpod" value="View Pod" onclick="vpod(this.id)"/></td>

</tr>


<?php 

$cnt++;


}


?>
</table>
<br>

<center><input type="button" id="exc" name="exc" value="Export to Excel" onclick="toexcel();"/></center>

