<?php
include('config.php');
  $abc="select VoucherBookletNumber,MembershipNumber from voucher_Details where voucher_id>456";
  $runabc=mysqli_query($conn,$abc);
  while($fetch=mysqli_fetch_array($runabc)){
$Voucher=$fetch['VoucherBookletNumber'];

$getLevel= substr($Voucher, 1, 1);



 $q="SELECT count(level_id) as V_no from voucher_Type where level_id='".$getLevel."'";
 $sql=mysqli_query($conn,$q);
 $_row=mysqli_fetch_array($sql);

  for($i=1;$i<=$_row['V_no'];$i++){
   
    $countR=$i;
  	$readyToUse=sprintf("%03s", $countR);
    $NoOfVoucher=$Voucher.$readyToUse;
    echo $NoOfVoucher."<br>";
    
    mysqli_query($conn,"insert into BarcodeScan(Voucher_id,Available) values('".$NoOfVoucher."','0')");
  }
  }
  ?>