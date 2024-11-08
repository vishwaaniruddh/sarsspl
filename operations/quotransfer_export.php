<?php 
include('config.php');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

function getColumnLabel($index) {
    $base26 = '';
    
    if ($index >= 26) {
        $base26 .= chr(65 + ($index / 26) - 1);
    }
    
    $base26 .= chr(65 + ($index % 26));
    
    return $base26;
}

if (!function_exists('endsWith')) {
    function endsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return $length === 0 || (substr($haystack, -$length) === $needle);
    }
}

if (!function_exists('clean')) {
    function clean($string)
    {
        $string = str_replace('-', ' ', $string);
        return preg_replace('/[^A-Za-z0-9\-]/', ' ', $string);
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
$sqry=mysqli_query($con,$qry);
$num=mysqli_num_rows($sqry);

$headerStyle = [
     'font' => [
        'bold' => true,
        'color' => ['rgb' => 'FFFFFF'],
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => '0070C0'],
    ],
    'borders' => [
        'outline' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['argb' => 'FF000000'],
        ],
    ],
];

$headers = array(
    'Sr No',
    'Category',
    'Made By',
    'Quotation ID',
    'Customer',
    'Atm',
    'Bank',
    'Location',
    'City',
    'State',
    'Work Details',
    
    'Amount',
    'Approved AMOUNT',
    'Required AMOUNT',
    
    'Approved Date',
    'Approved By',
    
    'Beneficiary Name',
    'Beneficiary Acc no',
    
    'Transferred Date',
    'Transferred AMOUNT',
    'Cheque No',
    'Ticket No/Job ID/PO No'
);

foreach ($headers as $index => $header) {
    $column = getColumnLabel($index);
    $sheet->setCellValue($column . '1', $header);
    $sheet->getStyle($column . '1')->applyFromArray($headerStyle);
}

$i = 2; // Start from row 2 for data

$srn=1;
$gtotal=0;
$row = 2;  // Start from row 2 for data

$totamt=0;
$apptotamt=0;
$requotamt=0;
 $reqtotamt=0;
$transamttot=0;

while ($rowarr=mysqli_fetch_array($sqry)) {
    
    
    //ini_set('max_execution_time', 123456);
 $tamt="";
if($rowarr[2]=='ICICI' || $rowarr[2]=='RATNAKAR' || $rowarr[2]=='ICICI_Direct' || $rowarr[2]=='Knight_Frank' )
{
 $icitot=mysqli_query($con,"select sum(amt) from icici_quot_details where qid='".$rowarr[0]."'");
           $tamt=mysqli_fetch_array($icitot);

}
else
{
 

             
    $getamt=mysqli_query($con,"select sum(Total) from quotation_details where qid='".$rowarr[0]."'");
	   $tamt=mysqli_fetch_array($getamt);       

}
	   
	    $ckhis=mysqli_query($con,"select qid from quotation_edit_history where qid='".$rowarr[0]."' limit 0,1");
	  $hisv=mysqli_num_rows($ckhis);
	  
	  $mdby=mysqli_query($con,"select username from login where srno='".$rowarr[9]."'");
	  $mdrow=mysqli_fetch_array($mdby);
	  
	$qrynm=mysqli_query($con,"select cust_name from  $rowarr[2]_sites where cust_id='".$rowarr[2]."' ");
                  $qname=mysqli_fetch_array($qrynm);  
	  

$cat="";
if($rowarr[12]=="a")
{ 
$cat="Approval Basis"; 
}elseif($rowarr[12]=="f")
{
$cat="Fixed Cost"; 
}

/*
$gwrdet=mysqli_query($con,"select description from quotation_details where qid='".$rowarr[0]."'");
$des="";
	       while($rdet=mysqli_fetch_array($gwrdet))
	       {
	       
	       $des.=$rdet[0].",";
	       }*/
	       
	       
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

  $des.="(".$str.")".$gparta[3]."(".$gparta[4]."*".round($gparta[5]).")"."\n";
  


$str++;
 }

  
 }       
	$wrkdet=$des;       
}                   
	              
	       
	       
	       
	       
	       
	       
	       

$mdby=$mdrow[0]." ".date( 'd/m/Y g:i A', strtotime($rowarr[10]));

$amt=round($tamt[0]); 
$totamt=$totamt+round($tamt[0]);

$rowamt="";
	      if($rowarr[11]=='a' || $rowarr[11]=='app' )
	      {
	      $amtqry=mysqli_query($con,"select app_amt,filename,app_by,approved_date,req_amt from quotation_approve_details where qid='".$rowarr[0]."'");
	      $rowamt=mysqli_fetch_array($amtqry);
	      //echo round($rowamt[0]);
	      $apptotamt=$apptotamt+round($rowamt[0]);
              $requotamt=$requotamt+round($rowamt[4]);
	      }
	      
	      $appdt="";
	     
	      if($rowamt[3]!="0000-00-00")
	        {
	         $appdt=date("d-m-Y",strtotime($rowamt[3]));
	        }
	  


$stat="";
 if($rowarr[11]=='y')
 { 
 $stat="Pending";
  }
  elseif($rowarr[11]=='a')
  { 
  $stat="Approve By"; 
  }
  elseif($rowarr[11]=='app')
  {
  $stat="Approved";
  } 
  
  $cstat="";
  if($rowarr[16]=="0")
  {
  $cstat="Opened";
  }
  else
  {
  $cstat="Closed";
  }
  
  $qchis="";
  if($rowarr[16]=="1")
  {
  $gqhis=mysqli_query($con,"select * from quotation_close_detail where qid='".$rowarr[0]."'");
	  $ghrw=mysqli_fetch_array($gqhis);
	  $qcdt=date("d-m-Y",strtotime($ghrw[2]));
	   $qchis=$qcdt." ".$ghrw[3]." ".$ghrw[4];
	}  
  
   $greamt=mysqli_query($con,"select req_amt from quotation1_req where qid='".$rowarr[0]."'");
            $reqamtw=mysqli_fetch_array($greamt);
              // echo round($reqamtw[0]);
             $reqtotamt=$reqtotamt+round($reqamtw[0]);

$supvname="";
if($rowarr[17]!="" && $rowarr[17]!="-1")
{
 $sup=mysqli_query($con,"select hname,ifsc_code,accno from fundaccounts where aid='".$rowarr[17]."'");
	    $sname=mysqli_fetch_array($sup);
$supvname=$sname[0];  
  }
  else
  {
  $sup1=mysqli_query($con,"select chq_name from quotation1ftransfers where qid='".$rowarr[0]."'");
	    $sname1=mysqli_fetch_array($sup1);
	   // echo "select supervisor from quotation1ftransfers where qid='".$row[0]."'";
	     
  $supvname=$sname1[0];
  }

$trandate=mysqli_query($con,"select * from  quotation1ftransfers where qid='".$rowarr[0]."'");
$tdarow=mysqli_fetch_array($trandate);

$trasamt=round($tdarow[7]); 
$transamttot=$transamttot+$trasamt;

if($tdarow[3]!='0000-00-00') {
$trdate=date('d-m-Y',strtotime($tdarow[3]));
 }
    
    
    // Your data processing logic here
    $sheet->setCellValue('A' . $i, $srn);
    $sheet->setCellValue('B' . $i, $cat);
    $sheet->setCellValue('C' . $i, $mdby);
    $sheet->setCellValue('D' . $i, $rowarr[1]);
    $sheet->setCellValue('E' . $i, $qname[0]);
     $sheet->setCellValueExplicit('F' . $i, $rowarr[3], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
    $sheet->setCellValue('G' . $i, $rowarr[4]);
    $sheet->setCellValue('H' . $i, $rowarr[6]);
    $sheet->setCellValue('I' . $i, $rowarr[7]);
    $sheet->setCellValue('J' . $i, $rowarr[8]);
    
    $sheet->setCellValue('K' . $i, $wrkdet);
    $sheet->setCellValue('L' . $i, $amt);
    $sheet->setCellValue('M' . $i, round($rowamt[0]));
    $sheet->setCellValue('N' . $i, round($rowamt[4]));
    
    $sheet->setCellValue('O' . $i, $appdt);
    $sheet->setCellValue('P' . $i, $rowamt[2]);
    
    $sheet->setCellValue('Q' . $i, $supvname);
     $sheet->setCellValueExplicit('R' . $i, $sname[2], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
    
    $sheet->setCellValue('S' . $i, $trdate);
    $sheet->setCellValue('T' . $i, $trasamt);
    $sheet->setCellValue('U' . $i, $tdarow[5]);
    
    $amtqry1=mysqli_query($con,"select ticket_no,job,po from quotation_approve_details where qid='".$rowarr[0]."'");
    $rowamt1=mysqli_fetch_array($amtqry1);
  
    if($rowamt1[0]){
        $sheet->setCellValue('V' . $i, $rowamt1[0]);
    }
    else if($rowamt1[1]){
        $sheet->setCellValue('V' . $i, $rowamt1[1]);
    }
    else if($rowamt1[2]){
        $sheet->setCellValue('V' . $i, $rowamt1[2]);
    }
    
$i++;
$srn++;
}

$lastrow= intval($srn)+intval(1);

//$objSheet->getStyle('A1:AD1')->getFont()->setBold(true)->setSize(12);
$highestRow = $sheet->getHighestRow();
$sheet->setCellValue('L' . $lastrow, $totamt);
$sheet->setCellValue('M' . $lastrow, $apptotamt);
$sheet->setCellValue('N' . $lastrow, $requotamt);
$sheet->setCellValue('T' . $lastrow, $transamttot);


// Save the Excel file
$writer = new Xlsx($spreadsheet);
$tempFile = tempnam(sys_get_temp_dir(), 'Quotation_Details');
$writer->save($tempFile);

ob_end_clean();

// Provide the file as a download to the user
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="quotationdetails.xlsx"');
header('Cache-Control: max-age=0');
readfile($tempFile);

// Close the database connection
mysqli_close($con);

// Clean up and delete the temporary file
unlink($tempFile);

