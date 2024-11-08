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

$strPage = $_POST['Page'];
	
        $dt1=str_replace("/","-",$_POST['strdt']);
	$start=date('Y-m-d', strtotime($dt1));
 
	$dt2=str_replace("/","-",$_POST['endt']);
	$end=date('Y-m-d', strtotime($dt2));
	
	/*---------------------------approval basis -----------------------------------*/


//-------------------------------------------------------------------pending

       $qrya="Select count(id) from quotation1 where local_status='0' and ((status='a' or status='app' ) and category='a') and p_stat='0'";
       
       if($_POST['cust']!="")
       {
       $qrya.=" and cust='".$_POST['cust']."'";
       }
       if($_POST['strdt']!="" && $_POST['endt']!="" )
       {
       $qrya.=" and DATE(entrydate) >='".$start."' and DATE(entrydate) <='".$end."'";
       }


      
       $amtr="Select id from quotation1 where local_status='0' and ((status='a' or status='app' ) and category='a') and p_stat='0'";
       if($_POST['cust']!="")
       {
       $amtr.=" and cust='".$_POST['cust']."'";
       }
       if($_POST['strdt']!="" && $_POST['endt']!="" )
       {
       $amtr.=" and DATE(entrydate) >='".$start."' and DATE(entrydate) <='".$end."'";
       }
       
       $amtqrya="select sum(Total) from quotation_details where qid in(".$amtr.")";

      $iciciamta="select sum(amt) from icici_quot_details where qid in(".$amtr.")";


//-------------------------------------------------------------------in fund process

      $qrya1="Select count(id) from quotation1 where local_status='0' and ((status='a' or status='app' ) and category='a') and p_stat='1'";
      
       if($_POST['cust']!="")
       {
       $qrya1.=" and cust='".$_POST['cust']."'";
       }
      
       $frrnm="select qid from  quotation1_req where DATE(entrydate) >='".$start."' and DATE(entrydate) <='".$end."'";
       if($_POST['strdt']!="" && $_POST['endt']!="" )
       {
       $qrya1.=" and id in (".$frrnm.")";
       }

//echo $qrya1;

      $amtr1="Select id from quotation1 where local_status='0' and ((status='a' or status='app' ) and category='a') and p_stat='1'";
       if($_POST['cust']!="")
       {
       $amtr1.=" and cust='".$_POST['cust']."'";
       }
       
       $amtqrya1="select sum(req_amt) from quotation1_req where qid in(".$amtr1.")";

    
	   //-------------------------------------------------------------------closed
       
       $qrya2="Select count(id) from quotation1 where ((status='a' or status='app' ) and category='a') and  p_stat='2'";
       
        if($_POST['cust']!="")
       {
       $qrya2.=" and cust='".$_POST['cust']."'";
       }
       
       $amtr2="Select id from quotation1 where local_status='0' and ((status='a' or status='app' ) and category='a') and p_stat='2'";
       if($_POST['cust']!="")
       {
       $amtr2.=" and cust='".$_POST['cust']."'";
       }
       
       $amtqrya2="select sum(tamount) from quotation1ftransfers where qid in(".$amtr2.")";
       
      /*----------------------------------------------------------------------------------*/        
        
	
	$qra=mysqli_query($con,$qrya);
        $rowa=mysqli_fetch_array($qra);

	$amtqra=mysqli_query($con,$amtqrya);
	$amtrowa=mysqli_fetch_array($amtqra);

       $iciciamt=mysqli_query($con,$iciciamta);
	$iciciamtrow=mysqli_fetch_array($iciciamt);
             
 $apamt1=$amtrowa[0]+$iciciamtrow[0];

	$qra1=mysqli_query($con,$qrya1);
        $rowa1=mysqli_fetch_array($qra1);

	$amtqra1=mysqli_query($con,$amtqrya1);
	$amtrowa1=mysqli_fetch_array($amtqra1);
         
      

       $qra2=mysqli_query($con,$qrya2);
        $rowa2=mysqli_fetch_array($qra2);

	$amtqra2=mysqli_query($con,$amtqrya2);
	$amtrowa2=mysqli_fetch_array($amtqra2);
	

/*---------------------------fixed cost-----------------------------------*/




//-------------------------------------------------------------------pending

$qryf="Select count(id) from quotation1 where local_status='0' and status='y'  and category='f' and p_stat='0'";

 if($_POST['cust']!="")
       {
       $qryf.=" and cust='".$_POST['cust']."'";
       }
 if($_POST['strdt']!="" && $_POST['endt']!="" )
       {
       $qryf.=" and DATE(entrydate) >='".$start."' and DATE(entrydate) <='".$end."'";
       }



 $amtrf="Select id from quotation1 where local_status='0' and status='y'  and category='f'  and p_stat='0'";
       if($_POST['cust']!="")
       {
       $amtrf.=" and cust='".$_POST['cust']."'";
       }
if($_POST['strdt']!="" && $_POST['endt']!="" )
       {
       $amtrf.=" and DATE(entrydate) >='".$start."' and DATE(entrydate) <='".$end."'";
       }
  
       $amtqryf="select sum(Total) from quotation_details where qid in(".$amtrf.")";

      $iciciamtf="select sum(amt) from icici_quot_details where qid in(".$amtrf.")";


//--------------------------------------------------------------in fund process


      $qryf1="Select count(id) from quotation1 where local_status='0' and status='y'  and category='f'  and p_stat='1'";
       if($_POST['cust']!="")
       {
       $qryf1.=" and cust='".$_POST['cust']."'";
       }


      $amtrf1="Select id from quotation1 where local_status='0' and status='y'  and category='f' and p_stat='1'";
       if($_POST['cust']!="")
       {
       $amtrf1.=" and cust='".$_POST['cust']."'";
       }

       $amtqryf1="select sum(req_amt) from quotation1_req where qid in(".$amtrf1.")";

    
	   
 //---------------------------------------------------------------payment done------------------
      
       $qryf2="Select count(id) from quotation1 where status='y'  and category='f'   and  p_stat='2'";
if($_POST['cust']!="")
       {
       $qryf2.=" and cust='".$_POST['cust']."'";
       }

        $amtrf2="Select id from quotation1 where local_status='0' and status='y'  and category='f'  and p_stat='2'";
       if($_POST['cust']!="")
       {
       $amtrf2.=" and cust='".$_POST['cust']."'";
       }
       
       $amtqryf2="select sum(tamount) from quotation1ftransfers where qid in(".$amtrf2.")";







       $qrf=mysqli_query($con,$qryf);
        $rowf=mysqli_fetch_array($qrf);

	$amtqrf=mysqli_query($con,$amtqryf);
	$amtrowf=mysqli_fetch_array($amtqrf);

       $iciciamtf=mysqli_query($con,$iciciamtf);
	$iciciamtrowf=mysqli_fetch_array($iciciamtf);
             
 $fpamt1=$amtrowf[0]+$iciciamtrowf[0];

	$qrf1=mysqli_query($con,$qryf1);
        $rowf1=mysqli_fetch_array($qrf1);

	$amtqrf1=mysqli_query($con,$amtqryf1);
	$amtrowf1=mysqli_fetch_array($amtqrf1);
         
      

       $qrf2=mysqli_query($con,$qryf2);
        $rowf2=mysqli_fetch_array($qrf2);

	$amtqrf2=mysqli_query($con,$amtqryf2);
	$amtrowf2=mysqli_fetch_array($amtqrf2);




      /*----------------------------------------------------------------------------------*/ 
	?>
	
	

	
	<table id="tableexport" name="tableexport" border="2" cellspacing="50" cellpadding="20">
	<th  align="center">Sr No</th>
	<th width="75">User</th>
	
	<th  align="center">Category</th>
	<th  align="center">Particulars</th>
	<th  align="center">NO of Calls</th>
	<th  align="center">Amount</th>
	
	
	
	<?php 
	$cntt=1;
	
	
	
	?>
	<tr>
	<td align="center"><?php echo $cntt; $cntt=$cntt+1;?></td>

	<td align="center"><?php echo "";?></td>
	<td align="center"><?php echo "Fixed Cost";?></td>
	<td align="center"><?php echo "Pending";?></td>
	<td align="center"><?php echo $rowf[0];?></td>
	<td align="center"><?php echo round($fpamt1);?></td>
	</tr>
	
	
	<tr>
	<td align="center"><?php echo $cntt; $cntt=$cntt+1;?></td>
	
	 <td align="center"><?php echo "";?></td>
	<td align="center"><?php echo "Fixed Cost";?></td>
	<td align="center"><?php echo "Fund Proces";?></td>
	<td align="center"><?php echo $rowf1[0];?></td>
	<td align="center"><?php echo round($amtrowf1[0]);?></td>
	</tr>
	
	<tr>
	<td align="center"><?php echo $cntt; $cntt=$cntt+1;?></td>
	<td align="center"><?php echo "";?></td>
	<td align="center"><?php echo "Fixed Cost";?></td>
	<td align="center"><?php echo "Payment Done";?></td>
	<td align="center"><?php echo $rowf2[0];?></td>
	<td align="center"><?php echo round($amtrowf2[0]);?></td>
	</tr>
        
        <!-----------------------approval basis---------->

         <tr>
	<td align="center"><?php echo $cntt; $cntt=$cntt+1;?></td>

	<td align="center"><?php echo "";?></td>
	<td align="center"><?php echo "Approval Basis";?></td>
	<td align="center"><?php echo "Pending";?></td>
	<td align="center"><?php echo $rowa[0];?></td>
	<td align="center"><?php echo round($apamt1);?></td>
	</tr>
	
	
	<tr>
	<td align="center"><?php echo $cntt; $cntt=$cntt+1;?></td>
	
	<td align="center"><?php echo "";?></td>
	<td align="center"><?php echo "Approval Basis";?></td>
	<td align="center"><?php echo "Fund Proces";?></td>
	<td align="center"><?php echo $rowa1[0];?></td>
	<td align="center"><?php echo round($amtrowa1[0]);?></td>
	</tr>
	
	<tr>
	<td align="center"><?php echo $cntt; $cntt=$cntt+1;?></td>
	<td align="center"><?php echo "";?></td>
	<td align="center"><?php echo "Approval Basis";?></td>
	<td align="center"><?php echo "Payment Done";?></td>
	<td align="center"><?php echo $rowa2[0];?></td>
	<td align="center"><?php echo round($amtrowa2[0]);?></td>
	</tr>



<?php	
 ?>
	
	
	
	
	
	
	
	
	
	
	
	
	</table>
	
	
	
	
<?php
}
?>