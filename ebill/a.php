<?php 
  
 require_once('vendor/autoload.php'); 
use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use PhpOffice\PhpSpreadsheet\Writer\Xlsx; 
  
// Creates New Spreadsheet 
$spreadsheet = new Spreadsheet(); 
  
// Retrieve the current active worksheet 
$sheet = $spreadsheet->getActiveSheet(); 
  
// Set the value of cell A1 
$sheet->setCellValue('A1', 'GeeksForGeeks!'); 
  
// Sets the value of cell B1 
$sheet->setCellValue('B1', 'A Computer Science Portal For Geeks'); 
   
// Write an .xlsx file  
$writer = new Xlsx($spreadsheet); 
  
// Save .xlsx file to the current directory 
$writer->save('gfg.xlsx'); 

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="gfg.xlsx"');
header('Cache-Control: max-age=0');
?> 