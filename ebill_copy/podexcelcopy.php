<?php

ini_set('max_execution_time', 0);
    set_time_limit(0) ;

include("config.php");
$podnum=$_POST['podno'];

$start="";
$end="";
$sqry="";

try
{
if($podnum!="")
{

$sqry.="Select `pod`, `received_from`, `supervisor_id`, `atm_id`, `rc`, `dc`, `sd`, `Due_date_charges`, `amount`, `total_amount` from ebill_package where  pod='".$podnum."' order by pid";

/*echo "Select `pod`, `received_from`, `supervisor_id`, `atm_id`, `rc`, `dc`, `sd`, `Due_date_charges`, `amount`, `total_amount` from ebill_package where  pod='".$podnum."'order by pid"."<br>";*/

}
elseif($podnum=="")
{
$dt1=str_replace("/","-",$_POST['date']);
	$start=date('Y-m-d', strtotime($dt1));
 
	$dt2=str_replace("/","-",$_POST['date2']);
	$end=date('Y-m-d', strtotime($dt2));

$sqry.="Select `pod`, `received_from`, `supervisor_id`, `atm_id`, `rc`, `dc`, `sd`, `Due_date_charges`, `amount`, `total_amount` from ebill_package where  DATE(entrydate)  >='".$start."' and DATE(entrydate) <='".$end."' order by pid";

/*echo "Select `pod`, `received_from`, `supervisor_id`, `atm_id`, `rc`, `dc`, `sd`, `Due_date_charges`, `amount`, `total_amount` from ebill_package where  DATE(entrydate)  >='".$start."' and DATE(entrydate) <='".$end."' order by pid"."<br>";*/

}


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


//$objSheet->getStyle('B')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
/*
$objSheet->getStyle('A1:AD1')->getFont()->setBold(true)->setSize(12);


for($col = 'A'; $col !== 'L'; $col++) {
   $objSheet->getColumnDimension($col)->setAutoSize(true);
}*/



$objSheet->setCellValue('A1', 'Sr No');
$objSheet->setCellValue('B1', 'Pod No');
$objSheet->setCellValue('C1', 'Received Fro');
$objSheet->setCellValue('D1', 'Supervisor ');
$objSheet->setCellValue('E1', 'Atm Id');
$objSheet->setCellValue('F1', 'RC');
$objSheet->setCellValue('G1', 'DC');
$objSheet->setCellValue('H1', 'SD');
$objSheet->setCellValue('I1', 'LATE CHARGE');
$objSheet->setCellValue('J1', 'AMOUNT');
$objSheet->setCellValue('K1', 'TOTAL AMOUNT');





$qry=mysqli_query($con,$sqry);
$num=mysqli_num_rows($qry);





$srn=1;
$gtotal=0;
$row = 2;





while($row_data = mysqli_fetch_array($qry))
{
$gtotal=intval($gtotal)+intval($row_data[9]);



for($i=0;$i<=$num;$i++)
{
//ini_set('max_execution_time', 123456);


 
$supqry=mysqli_query($con,"select hname from fundaccounts where aid='".$row_data[2]."'");
$numr=mysqli_num_rows($supqry);
$supname="";
if($numr>0)
{
$supn=mysqli_fetch_array($supqry);
$supname=$supn[0];
}




 $objSheet->setCellValueByColumnAndRow(0, $row, $srn);
$objSheet->setCellValueExplicitByColumnAndRow(1, $row, $row_data[0]);
$objSheet->setCellValueByColumnAndRow(2, $row, $row_data[1]);
$objSheet->setCellValueByColumnAndRow(3, $row, $supname);
$objSheet->setCellValueExplicitByColumnAndRow(4, $row, $row_data[3]);
$objSheet->setCellValueByColumnAndRow(5, $row, $row_data[4]);
$objSheet->setCellValueByColumnAndRow(6, $row, $row_data[5]);
$objSheet->setCellValueByColumnAndRow(7, $row, $row_data[6]);
$objSheet->setCellValueByColumnAndRow(8, $row, $row_data[7]);
$objSheet->setCellValueByColumnAndRow(9, $row, $row_data[8]);
$objSheet->setCellValueByColumnAndRow(10, $row, $row_data[9]);







}

 $row++;
$srn++;


}




$lastrow= intval($srn)+intval(1);

//$objSheet->getStyle('A1:AD1')->getFont()->setBold(true)->setSize(12);
$highestRow = $objSheet->getHighestRow();
//$objSheet->getStyle($highestRow+1)->getFont()->setBold(true)->setSize(12);
$objSheet->setCellValueByColumnAndRow(9,$lastrow, Total);
$objSheet->setCellValueByColumnAndRow(10,$lastrow, $gtotal);





//$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
////$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
//ob_clean();

 header("Content-Disposition: attachment; filename=podsoftcopy.xls");
 header("Content-Type: application/vnd.ms-excel");

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
$objWriter->save("php://output");
}
catch(Exception $e)
{
 print "Error !: " . $e->getMessage() . "<br/>";

}

  
?>