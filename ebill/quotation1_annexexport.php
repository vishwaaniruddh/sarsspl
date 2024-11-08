<?php include('config.php');
require 'vendor/autoload.php';


// error_reporting(E_ALL);
// error_reporting(-1);
// ini_set('error_reporting', E_ALL);


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;


$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();


function getColumnLabel($index) {
    $base26 = '';
    
    // Calculate the first part of the label (A, B, C, ...)
    if ($index >= 26) {
        $base26 .= chr(65 + ($index / 26) - 1);
    }
    
    // Calculate the second part of the label (A, B, C, ...)
    $base26 .= chr(65 + ($index % 26));
    
    return $base26;
}




if (!function_exists('endsWith')) {
    function endsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return $length === 0 ||
            (substr($haystack, -$length) === $needle);
    }
}
if (!function_exists('clean')) {
    function clean($string)
    {
        $string = str_replace('-', ' ', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.
    }
}
if (!function_exists('remove_special')) {

    function remove_special($site_remark2)
    {
        $site_remark2_arr = explode(" ", $site_remark2);

        foreach ($site_remark2_arr as $k => $v) {
            $a[] = preg_split('/\n/', $v);
        }

        $site_remark = '';
        foreach ($a as $key => $value) {
            foreach ($value as $ke => $va) {
                $site_remark .= $va . " ";
            }
        }

        return clean($site_remark);
    }
}

$qry=$_POST['expqry'];
//$sql_query = $_REQUEST['expqry'];
$sqry=mysqli_query($con,$qry);
$num=mysqli_num_rows($sqry);




// Set Header Styles
$headerStyle = [
     'font' => [
        'bold' => true, // Make the text bold
        'color' => ['rgb' => 'FFFFFF'], // Font color (white)
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => '0070C0'], // Background color (blue)
    ],
    'borders' => [
        'outline' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['argb' => 'FF000000'], // Border color (black)
        ],
    ],
];


$date = date('Y-m-d');


$headers = array(
    'Sr No',
    'Category',
    'Made By',
    'CSS Ref No',
    'Customer',
    'Project',
    'Bank',
    'Atm',
    'Site ID',
    'VPR NO',
    'I O CODE',
    'JOB ID',
    'Ticket No',
    'City',
    'State',
    'Location',
    'Work Details',
    'Zone',
    'Month',
    'Approval Date',
    'Approval Amount',
    'Transfer Date',
    'Transfer Amount',
    'Approved By',
    'Mail By',
    'Call Status',
    'Prime Code'
);


// Apply Header Styles
foreach ($headers as $index => $header) {
    $column = getColumnLabel($index);
    $sheet->setCellValue($column . '1', $header);
    $sheet->getStyle($column . '1')->applyFromArray($headerStyle);
    //   $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);

}



$i = 2; // Start from row 2 for data

$counter=1; 

$srn=1;
$gtotal=0;
$row = 2;

$totamt=0;
$apptotamt=0;
$requotamt=0;
 $reqtotamt=0;

while($rowarr=mysqli_fetch_array($sqry))
{

$cat="";
if($rowarr[12]=="a")
{ 
$cat="Approval Basis"; 
}elseif($rowarr[12]=="f")
{
$cat="Fixed Cost"; 
}

$transfer=mysqli_query($con,"select * from quotation1ftransfers where qid='".$rowarr[0]."' ");
$transdetail = mysqli_fetch_array($transfer);


 $mdby=mysqli_query($con,"select username from login where srno='".$rowarr[9]."'");
	  $mdrow=mysqli_fetch_array($mdby);
	  $mdby1=$mdrow[0]." ".date( 'd/m/Y g:i A', strtotime($rowarr[10]));
	  
	  
	  $qrynm=mysqli_query($con,"select cust_name from  $rowarr[2]_sites where cust_id='".$rowarr[2]."' ");
                  $qname=mysqli_fetch_array($qrynm);

$projq=mysqli_query($con,"select projectid,site_id,zone from $rowarr[2]_sites where atm_id1='".$rowarr[3]."'");
$projrow=mysqli_fetch_row($projq);


$gapdet=mysqli_query($con,"Select * from quotation_approve_details where qid='".$rowarr[0]."'");
$nurws=mysqli_num_rows($gapdet);
$approw=mysqli_fetch_array($gapdet);

$wrkdet="";       
	       
   if($rowarr[2]=='ICICI' || $rowarr[2]=='RATNAKAR' || $rowarr[2]=='ICICI_Direct' || $rowarr[2]=='Knight_Frank' )
{
	       
	       
	
   $qicicwrk=mysqli_query($con,"select * from icici_quot_details where qid='".$rowarr[0]."'");
$des="";

 while($gdetca2=mysqli_fetch_array($qicicwrk))
 {
  $des.=$gdetca2[2]."-".$gdetca2[3]."-".$gdetca2[4]."-".round($gdetca2[5])."-".$gdetca2[6]."-".$gdetca2[7]."-".round($gdetca2[8])."-".$gdetca2[9]."\n";
  //echo $des2;
  }

$wrkdet=$des; 

}  
else
{
$qdetc=mysqli_query($con,"select distinct(particular) from quotation_details where qid='".$rowarr[0]."'");
$des="";
 while($gdetca=mysqli_fetch_array($qdetc))
 {

 $des.=$gdetca[0]."\n";

  $gpart=mysqli_query($con,"select * from quotation_details where particular='".$gdetca[0]."' and qid='".$rowarr[0]."'");
$str='a';
while($gparta=mysqli_fetch_array($gpart))
 {

  $des.="(".$str.")".$gparta[3]."(".$gparta[4].")"."\n";
  


$str++;
 }

  
 }       
	$wrkdet=$des;       
}              
	      














$mnth=$rowarr[13]." ".$rowarr[14];
$appdt=date( 'd/m/Y ', strtotime($approw[12]));
$appamt=round($approw[9]); $apptotamt=$apptotamt+round($approw[9]); 

 if($transdetail[3]!="0000-00-00") {
    if(!is_null($transdetail[3])){
        $transdetaildate=  date("d/m/Y",strtotime($transdetail[3])) ;  
    }
   
    }

$st="";
if($row[16]=="0")
{$st="Opened";
}else{ $st="Closed";}

    $sheet->setCellValue('A' . $i, $srn);
    $sheet->setCellValue('B' . $i, $cat);
    $sheet->setCellValue('C' . $i, $mdby1);
    $sheet->setCellValue('D' . $i, $rowarr[1]);
    $sheet->setCellValue('E' . $i, $qname[0]);
    $sheet->setCellValue('F' . $i, $rowarr[5]);
    $sheet->setCellValue('G' . $i, $rowarr[4]);
    $sheet->setCellValue('H' . $i, $rowarr[3]);
    $sheet->setCellValue('I' . $i, $projrow[1]);
    $sheet->setCellValue('J' . $i, $approw[3]);
    $sheet->setCellValue('K' . $i, $approw[2]);
    $sheet->setCellValue('L' . $i, $approw[4]);
    $sheet->setCellValue('M' . $i, $approw[14]);
    $sheet->setCellValue('N' . $i, $rowarr[7]);
    $sheet->setCellValue('O' . $i, $rowarr[8]);
    $sheet->setCellValue('P' . $i, $rowarr[6]);
    $sheet->setCellValue('Q' . $i, $wrkdet);
    $sheet->setCellValue('R' . $i, $projrow[2]);
    $sheet->setCellValue('S' . $i, $mnth);
    $sheet->setCellValue('T' . $i, $appdt);
    $sheet->setCellValue('U' . $i, $appamt);
    $sheet->setCellValue('V' . $i, $transdetaildate);
    $sheet->setCellValue('W' . $i, $transdetail[7]);
    $sheet->setCellValue('X' . $i, $approw[7]);
    $sheet->setCellValue('Y' . $i, $mdrow[0]);
    $sheet->setCellValue('Z' . $i, $st);
    $sheet->setCellValue('AA' . $i, $approw[5]);
    
   
    $i++;
    $counter++ ; 
    
    $row++;
    $srn++;
}

$lastrow= intval($srn)+intval(1);


$sheet->setCellValue('U' .$lastrow, $apptotamt);

//ob_start();

// Create a writer to save the Excel file
$writer = new Xlsx($spreadsheet);

// Save the Excel file to a temporary location
$tempFile = tempnam(sys_get_temp_dir(), 'Inventory');
$writer->save($tempFile);



ob_end_clean();

// Provide the file as a download to the user
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="annexure.xlsx"');
header('Cache-Control: max-age=0');
readfile($tempFile);



// Close the database connection
mysqli_close($con);

// Clean up and delete the temporary file
unlink($tempFile);
