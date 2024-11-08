<?php include('config.php');
date_default_timezone_set("Asia/Kolkata");

    $date = date('Y-m-d h:i:s a', time());
    $only_date = date('Y-m-d');
    $target_dir = 'PHPExcel/';
    $file_name=$_FILES["userfile"]["name"];
    $file_tmp=$_FILES["userfile"]["tmp_name"];
    $file =  $target_dir.'/'.$file_name;

    move_uploaded_file($file_tmp=$_FILES["userfile"]["tmp_name"],$target_dir.'/'.$file_name);
    include('PHPExcel/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');
    $inputFileName = $file;

  try {
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);
  } catch (Exception $e) {
    die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . 
        $e->getMessage());
  }

  $sheet = $objPHPExcel->getSheet(0);
  $highestRow = $sheet->getHighestRow();
  $highestColumn = $sheet->getHighestColumn();

  for ($row = 1; $row <= $highestRow; $row++) { 
    $rowData[] = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, 
                                    null, true, false);
                                
  }

$row = $row-2;
$error = '0';
$contents='';



    for($i = 1; $i<=$row; $i++){
        
        $col = $i+1 ;
$membershipid = $rowData[$i][0][1];
$city = $rowData[$i][0][0];

$time = $objPHPExcel->getActiveSheet()->getCell('C'.$col)->getFormattedValue();
$time = date("H:i:s", strtotime($time) );

$pos_code = $rowData[$i][0][4];
$CheckNo = $rowData[$i][0][5];
$pax = $rowData[$i][0][6];
$paxclose = $rowData[$i][0][7];
$tender_media_number = $rowData[$i][0][8];
$food_amt = $rowData[$i][0][9];
$food_disc_amt = $rowData[$i][0][10];
$soft_bev_amt = $rowData[$i][0][11];
$soft_bev_disc_amt = $rowData[$i][0][12];
$indian_liq_amt = $rowData[$i][0][13];
$indian_liq_disc_amt = $rowData[$i][0][14];
$imp_liq_amt = $rowData[$i][0][15];
$imp_liq_disc_amt = $rowData[$i][0][16];
$service_charge = $rowData[$i][0][17];
$nett_amount = $rowData[$i][0][18];
$total_tax_collected = $rowData[$i][0][19];
$gross_total = $rowData[$i][0][20];
$cashier_number = $rowData[$i][0][21];

         if($membershipid){
        //  echo $i . ' '  ;
                 
         if( is_numeric($membershipid) && strlen($membershipid)==8){
                $membershipid = $membershipid ;
         }else if(strpos($membershipid, '/') !== false) {
            $membershipid = explode('/',$membershipid);
            $membershipid = $membershipid[0];
         }else{
             
             if(is_numeric($membershipid) && strlen($membershipid)!=8){
                $membershipid = '14177491' ; // For No Records
             }else{
                $membershipid = '12689341' ; // For Old Records         
             }
         }
         
         
             $type1= $membershipid[1];
             if($type1=='2'){
                 $type = 1 ; 
             }else if($type1=='4'){
                 $type = 2 ;
             }
                 

$calllogin_date = $objPHPExcel->getActiveSheet()->getCell('D'.$col)->getFormattedValue();
$Dt = date("Y-m-d", strtotime($calllogin_date) );





$dupQ= mysqli_query($conn,"SELECT * FROM `POS_table` WHERE BillDate='".$Dt."' and CheckNo='".$CheckNo."'");

if(mysqli_num_rows($dupQ)=="0"){   
    
    	 $result= "insert into POS_table(City,CertificateNumber,Time,BillDate,POS_code,CheckNo,No_of_Pax,No_of_paxClose,TenderMediaNumber,FoodAmt,FoodDiscAmt,SoftBevAmt,SoftBevDiscAmt,IndianLiqAmt,IndianLiqDiscAmt,ImpLiqAmt,ImpLiqDiscAmt,AutomaticServiceCharge,NettAmount,TotalTaxCollected,GrossTotal,CashierNumber,type) values('".$city."','".$membershipid."','".$time."','".$Dt."','".$pos_code."','".$CheckNo."','".$pax."','".$paxclose."','".$tender_media_number."','".$food_amt."','".$food_disc_amt."','".$soft_bev_amt."','".$soft_bev_disc_amt."','".$indian_liq_amt."','".$indian_liq_disc_amt."','".$imp_liq_amt."','".$imp_liq_disc_amt."','".$service_charge."','".$nett_amount."','".$total_tax_collected."','".$gross_total."','".$cashier_number."','".$type."')";
    	 
}else{
    	 $result= "insert into POS_table(City,CertificateNumber,Time,BillDate,POS_code,CheckNo,No_of_Pax,No_of_paxClose,TenderMediaNumber,FoodAmt,FoodDiscAmt,SoftBevAmt,SoftBevDiscAmt,IndianLiqAmt,IndianLiqDiscAmt,ImpLiqAmt,ImpLiqDiscAmt,AutomaticServiceCharge,NettAmount,TotalTaxCollected,GrossTotal,CashierNumber,type) values('".$city."','".$membershipid."','".$time."','".$Dt."','".$pos_code."','".$CheckNo."','".$pax."','".$paxclose."','".$tender_media_number."','".$food_amt."','".$food_disc_amt."','".$soft_bev_amt."','".$soft_bev_disc_amt."','".$indian_liq_amt."','".$indian_liq_disc_amt."','".$imp_liq_amt."','".$imp_liq_disc_amt."','".$service_charge."','".$nett_amount."','".$total_tax_collected."','".$gross_total."','".$cashier_number."','".$type."')";
}

	 $runresult=mysqli_query($conn,$result);

    }
}
?>

<script>
    alert('Uploaded !');
    window.location.hreef="excel_POS_uplode.php";
</script>

