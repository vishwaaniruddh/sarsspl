<?php session_start();
ini_set('memory_limit', '-1');
include('config.php');
$FromDat=$_POST['FromDt'];
$Todat=$_POST['ToDt'];
$MemberId=$_POST['MemberId'];

$FromDt=date('Y-m-d', strtotime($FromDat));
$Todt=date('Y-m-d', strtotime($Todat));
$FromDt1=date('d-m-Y', strtotime($FromDat));
$Todt1=date('d-m-Y', strtotime($Todat));
$array=array();
//=================== get month name and month in number ====
     $convert_date_From = strtotime($FromDt);
     $From_MonthName = date('F',$convert_date_From);
     $From_Month = date('m',$convert_date_From);
     
     $convert_date_To = strtotime($Todat);
     $From_ToName = date('F',$convert_date_To);
     $From_To = date('m',$convert_date_To);
//===========================================================

if($FromDt<=$Todt){

?>
                       
                                <table id="example" class="table" style="width:100%">
                                    <thead>
                                        
                                    <tr>
                                        <th>SN</th>  
                                        <th>Date</th>
                                        <th>Period</th>                                      
                                        <th>Covers</th>
                                        <th>Bill Number</th>
                                        <th>Gross Amt</th>
                                        <th>Discount</th>
                                        <th>Net Amount</th> 
                                        
                                        
                                    </tr>
                                    </thead>
                                    <tbody id="setTable">
                                       
                                        
                            
                                        
                                        
                                        	<?php 
$GrossAmt=0;
$discountAmt=0;
$netAmt=0;
	
// $q="SELECT sum(MiscAmt) as No_of_MiscAmt,sum(MiscDiscAmt) as MiscDiscAmt  ,sum(No_of_Pax) as No_of_Pax ,sum(No_of_paxClose) as No_of_paxClose ,sum(FoodAmt) as FoodAmt,sum(FoodDiscAmt) as FoodDiscAmt ,SUM(SoftBevAmt) as SoftBevAmt,sum(SoftBevDiscAmt) as SoftBevDiscAmt,SUM(IndianLiqAmt) as IndianLiqAmt,SUM(IndianLiqDiscAmt) as IndianLiqDiscAmt,sum(ImpLiqAmt) as ImpLiqAmt,SUM(ImpLiqDiscAmt) as ImpLiqDiscAmt,Sum(NettAmount) as NettAmount FROM `POS_table` where   BillDate BETWEEN '".$FromDt."' AND '".$Todt."' and CertificateNumber='".$MemberId."'  and type=1 ";
$q="SELECT * FROM `POS_table` where BillDate BETWEEN '".$FromDt."' AND '".$Todt."' and  (CertificateNumber='".$MemberId."' and type=1) ";
 $q1=mysqli_query($conn,$q);
 $sn=1;
 while($f1=mysqli_fetch_array($q1)){
   
   if($f1['Time'] >="07:00:00" && $f1['Time']<="10:59:59"){  $periods="Breakfast"; }
   else if($f1['Time'] >="11:00:00" && $f1['Time']<="16:59:59"){$periods="Lunch";}
   else if($f1['Time'] >="17:00:00" && $f1['Time']<="23:59:59"){$periods="Dinner";}
   else if($f1['Time'] >="00:00:00" && $f1['Time']<="06:59:59"){$periods="Misc";}
   
$discount2=$f1['FoodDiscAmt']+$f1['SoftBevDiscAmt']+$f1['IndianLiqDiscAmt']+$f11['ImpLiqDiscAmt']+$f1['MiscDiscAmt'];

?>

   <tr>
    <td><b><?php echo $sn;?></b></td>
    <td><?php echo $f1['BillDate'] ; ?></td>
	<td><?php  echo $periods;?></td>
	<td><?php  echo $f1['No_of_paxClose'];?></td>
	<td><?php  echo $f1['CashierNumber'];?></td>
	<td><?php  echo $f1['GrossTotal']; ?></td>
	<td><?php  echo $discount2;?></td>
	<td><?php  echo $f1['NettAmount'];?></td>
   </tr>

     <?php 
     $GrossAmt+=$f1['GrossTotal'];		
     $discountAmt+=$discount2;
     $netAmt+=$f1['NettAmount'];
     
     
     $sn++;  } ?>
         
         			<tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>Total</b></td>
                    <td><?php echo $GrossAmt; ?></td>
                	<td><?php echo $discountAmt; ?></td>
                	<td><?php echo $netAmt; ?></td>
	            	</tr>
				
          </tbody>
         
                                   
                                </table>
   
         
       <?php   }else { ?>                   
   <table id="example" class="table" style="width:100%">
                                    <tr>
                                        <th >Date Filter Not valid </th> 
                                    </tr>
                                    </table>


<?php
	}


	
  ?>
    
