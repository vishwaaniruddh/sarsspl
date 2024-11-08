<?php

ini_set('max_execution_time', 0);
    set_time_limit(0) ;

include("config.php");
$pod=$_GET['podno'];


$start="";
$end="";
$sqry="";
$gtotal="";

try
{

if($pod!="" )
{
$qry="select distinct pod,received_from from ebill_package where pod='".$pod."'";
               
         $qry2=mysqli_query($con,"select sum(total_amount) from ebill_package where pod='".$pod."'");
         $qry2a=mysqli_fetch_array($qry2);
		
		 
			   $gtotal=$qry2a[0];
                 	
                
                 
}        
else
{

 $dt1=str_replace("/","-",$_GET['strtdate']);
	$start=date('Y-m-d', strtotime($dt1));
 
	$dt2=str_replace("/","-",$_GET['endate']);
	$end=date('Y-m-d', strtotime($dt2));



$qry="select distinct pod,received_from from ebill_package where  DATE(entrydate)  >='".$start."' and DATE(entrydate) <='".$end."'";
       
$qry2=mysqli_query($con,"select sum(total_amount) from ebill_package where  DATE(entrydate) >='".$start."' and DATE(entrydate) <='".$end."'");
//echo "select sum(total_amount), from ebill_package where  DATE(entrydate) >='".$start."' and DATE(entrydate) <='".$end."'"."<br>";
		        
		$qry2a=mysqli_fetch_array($qry2);
		
		 
			   $gtotal=$qry2a[0];



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

$objSheet->getStyle('A1:AD1')->getFont()->setBold(true)->setSize(12);

for($col = 'A'; $col !== 'G'; $col++) {
    $objPHPExcel->getActiveSheet()
        ->getColumnDimension($col)
        ->setAutoSize(true);
}




$objSheet->setCellValue('A1', 'Sr No');
$objSheet->setCellValue('B1', 'Pod No');
$objSheet->setCellValue('C1', 'Received From');
$objSheet->setCellValue('D1', 'Count');
$objSheet->setCellValue('E1', 'Entrydate');
$objSheet->setCellValue('F1', 'TOTAL AMOUNT');





$qry1=mysqli_query($con,$qry);






$srn=1;
$row = 2;
while($row_data = mysqli_fetch_array($qry1))
{


$tamtq=mysqli_query($con,"select sum(total_amount),count(pod),entrydate from ebill_package where pod='".$row_data[0]."' and received_from='".$row_data[1]."' and DATE(entrydate)  >='".$start."' and DATE(entrydate) <='".$end."'"  );
$getamt=mysqli_fetch_array($tamtq);

$edt=$getamt[2];
$entrdate=date("d/m/Y", strtotime($edt));


$objSheet->setCellValueByColumnAndRow(0, $row, $srn);
$objSheet->setCellValueExplicitByColumnAndRow(1, $row, $row_data[0]);
$objSheet->setCellValueByColumnAndRow(2, $row, $row_data[1]);
$objSheet->setCellValueByColumnAndRow(3, $row,$getamt[1] );
$objSheet->setCellValueByColumnAndRow(4, $row, $entrdate);
$objSheet->setCellValueByColumnAndRow(5, $row,$getamt[0] );






 $row++;
$srn++;
}








$lastrow=intval($srn)+intval(1);

//$objSheet->getStyle('A1:AD1')->getFont()->setBold(true)->setSize(12);
$highestRow = $objSheet->getHighestRow();
$objSheet->getStyle($highestRow+1)->getFont()->setBold(true)->setSize(12);
$objSheet->setCellValueByColumnAndRow(4,$lastrow, Total);
$objSheet->setCellValueByColumnAndRow(5,$lastrow, $gtotal);





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