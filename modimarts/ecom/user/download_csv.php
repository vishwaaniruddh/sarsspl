<?php

if(isset($_POST['mid'])){
    $mid = $_POST['mid'];
} else {
    $mid = $_GET['mid'];
}
if(isset($_POST['from_date']))
{
    $from_date= $_POST['from_date']; 
} else{
    $from_date= $_GET['from_date']; 
}

$filename = 'monthly_bill'.$mid.$from_date.'.csv';
if(isset($_POST['export_data'])){
    $export_data = unserialize($_POST['export_data']);
} else {
   $export_data = unserialize($_GET['export_data']); 
}
/*var_dump($export_data);*/
// file creation
$file = fopen($filename,"w");  

foreach ($export_data as $line){  
 fputcsv($file,$line);
}
fclose($file);  
// download
header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=".$filename);
header("Content-Type: application/csv; "); 
readfile($filename);
// deleting file
unlink($filename);
exit();
?>