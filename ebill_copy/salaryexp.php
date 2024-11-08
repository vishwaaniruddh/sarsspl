<?php

ini_set('max_execution_time', 0);
    set_time_limit(0) ;

include("config.php");



$tid=$_GET['tid'];
/*echo "SELECT sum(tamount), `tid`, `ctid`, `type`, `pay_typ`, `name`, `chq_no`, `chq_date`, `dbtaccno`, `email_body`, `mail_by`, `entrydt`, `month`, `year`, `tamount`, `accid`, `pdate` FROM `quotation1ftransfers` where tid='".$tid."' GROUP BY accid";*/

$qry=mysqli_query($con,"SELECT distinct(accno) FROM `salary_generate_details` where tid='".$tid."' ");
    


require_once 'Classes/PHPExcel.php';

require_once "Classes/PHPExcel/IOFactory.php";

include_once 'Classes/PHPExcel/Writer/Excel5.php';

// create new PHPExcel object
$objPHPExcel = new PHPExcel();



 
ini_set('memory_limit', '-1');
//Prevent your script from timing out

// This increases the excution time from 30 secs to 3000 secs.
//set_time_limit ( 3000 ); 


// writer already created the first sheet for us, let's get it
$objSheet = $objPHPExcel->getActiveSheet();

// rename the sheet
$objSheet->setTitle('Task Results');


$objSheet->setCellValue('A1', 'Paymentidentifier');
$objSheet->setCellValue('B1', 'Amount');
$objSheet->setCellValue('C1', 'ValueDate');
$objSheet->setCellValue('D1', 'BeneficiaryName');
$objSheet->setCellValue('E1', 'BeneAccountNumber');
$objSheet->setCellValue('F1', 'EmailIDofbeneficiary');


$objSheet->setCellValue('G1', 'Email
Body');
$objSheet->setCellValue('H1', 'DebitAccountNumber');
$objSheet->setCellValue('I1', 'CRN(Narration/Remarks)');
$objSheet->setCellValue('J1', 'ReceiverIFSC');
$objSheet->setCellValue('K1', 'ReceiverA/ctype');


$objSheet->setCellValue('L1', 'Request By');
$objSheet->setCellValue('M1', 'Mail By');
$objSheet->setCellValue('N1', 'Service Work Details');
$objSheet->setCellValue('O1', 'Transfer Month');



$srn=1;
$row = 2;


$bl="";
while($rowd1=mysqli_fetch_array($qry))
{


$qrnm=mysqli_query($con,"select * from salary_acc where accno='".$rowd1[0]."'");
$qrnrow=mysqli_fetch_array($qrnm);

$amtsum=mysqli_query($con,"select sum(tamount) from salary_generate_details where tid='".$tid."' and accno='".$rowd1[0]."'");
$amtros=mysqli_fetch_array($amtsum);

$qry2=mysqli_query($con,"SELECT * FROM `salary_generate_details` where accid='".$qrnrow[0]."' and tid='".$tid."' ");
  $rowd=mysqli_fetch_array($qry2);  

$objSheet->setCellValueByColumnAndRow(1, $row, $amtros[0]);
$objSheet->setCellValueByColumnAndRow(2, $row, date('d-m-Y',strtotime($rowd[11])));
$objSheet->setCellValueByColumnAndRow(3, $row, $qrnrow[1]);
$objSheet->setCellValueExplicitByColumnAndRow(4, $row, $qrnrow[2]);
$objSheet->setCellValueByColumnAndRow(5, $row,$bl);
$objSheet->setCellValueByColumnAndRow(6, $row,$rowd[9]);
$objSheet->setCellValueExplicitByColumnAndRow(7, $row,$rowd[8]);
$objSheet->setCellValueByColumnAndRow(8, $row, "");
$objSheet->setCellValueByColumnAndRow(9, $row, $qrnrow[3]);
$objSheet->setCellValueByColumnAndRow(10, $row,$bl);
$objSheet->setCellValueByColumnAndRow(11, $row, $qrnrow[1]);
$objSheet->setCellValueByColumnAndRow(12, $row, $rowd[10]);
$objSheet->setCellValueByColumnAndRow(13, $row,"");
$objSheet->setCellValueByColumnAndRow(14, $row, date('M-Y',strtotime($rowd[11])));
 $row++;
$srn++;
}


 header("Content-Disposition: attachment; filename=cmsexport.xls");
 header("Content-Type: application/vnd.ms-excel");

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
$objWriter->save("php://output");

?>