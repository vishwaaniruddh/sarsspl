<?php session_start();
ini_set('memory_limit', '-1');
include('config.php');

$MemberId=$_POST['MemberId'];
$Booklet=$_POST['Booklet'];
?>
                       
                                <table id="example" class="table" style="width:100%">
                                    <thead>
                                        
                                    <tr>
                                        <th>SN</th>  
                                        <th>Voucher Id</th> 
                                        <th>Voucher Description</th>
                                        <th>Status</th>
                                          <th>Used Date</th>
                                       </tr>
                                    </thead>
                                    <tbody id="setTable">
                                       
                                        
                            
                                        
                                        
                                        	<?php 

$MemberNameQ=mysqli_query($conn,"SELECT MembershipDetails_Level as lev FROM `Members` where GenerateMember_Id='".$MemberId."'");
$fetchMemLev=mysqli_fetch_array($MemberNameQ);



$q="SELECT Voucher_id,Available,usedDate FROM `BarcodeScan` where Voucher_id LIKE  '".$Booklet."%'";

 $q1=mysqli_query($conn,$q);
 $sn=1;
 while($f1=mysqli_fetch_array($q1)){
   
  if($f1['Available']=="0"){
      $status="Available";
  }else{
       $status="Used";
  }
  
  if($f1['usedDate']=="0000-00-00 00:00:00"){
      $Used="00-00-0000";
  }else{
$Used=date('d-m-Y H:i:s',strtotime($f1['usedDate']));
}
$last3_voucher=substr($f1['Voucher_id'], -3);

$voucher_TypeQ=mysqli_query($conn,"SELECT serviceName FROM `voucher_Type` where level_id='".$fetchMemLev['lev']."' and serialNumber like '%".$last3_voucher."' ");
$fetchVoucher_Type=mysqli_fetch_array($voucher_TypeQ);


?>

   <tr>
    <td><b><?php echo $sn;?></b></td>
    <td><?php echo $f1['Voucher_id'] ; ?></td>
    <td><?php echo $fetchVoucher_Type['serviceName'] ; ?></td>
	<td><?php  echo $status;?></td>
	<td><?php  echo $Used;?></td>
	
   </tr>

    <?php $sn++; } ?>
         
          </tbody>
         
                                   
                                </table>
   
         
      


    
