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
    'Approved By',
    'Approved Date',
    'Remark',
    'Status',
    'Call Status',
    'Call Status History',
    'Transferred Amount',
    'Transferred Date',
    'Cheque No',
    'Beneficiary Name',
    'Expectation Approval Amount',
    'wbs/vpr/tikNo/primeCode/RefNo/JobId'
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

 $tamt="";
//ini_set('max_execution_time', 123456);
if($rowarr[2].trim()!='ICICI')
{
$getamt=mysqli_query($con,"select sum(Total) from quotation_details where qid='".$rowarr[0]."'");
	   $tamt=mysqli_fetch_array($getamt);
}
else
{

$getamt2=mysqli_query($con,"select sum(amt) from icici_quot_details where qid='".$rowarr[0]."'");
	   $tamt=mysqli_fetch_array($getamt2);
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
	       
	       
	$wrkdet="";



$gsup=mysqli_query($con,"select hname from fundaccounts where aid='".$rowarr[17]."'");
$supr=mysqli_fetch_array($gsup);

$supvn=$supr[0];



if($rowarr[2].trim()!='ICICI')
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
	
else
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
	       
	       
	       
	       
	       

$mdby=$mdrow[0]." ".date( 'd/m/Y g:i A', strtotime($rowarr[10]));

$amt=round($tamt[0]); 
$totamt=$totamt+round($tamt[0]);

$rowamt="";

	      if($rowarr[11]=='a' || $rowarr[11]=='app' )
	      {
	      $amtqry=mysqli_query($con,"select app_amt,filename,app_by,approved_date,remark,req_amt,expectedApprovalAmt,wbs,vpr,prime,ticket_no,ref_no,job from quotation_approve_details where qid='".$rowarr[0]."'");
	      $rowamt=mysqli_fetch_array($amtqry);
	      //echo round($rowamt[0]);
	     
	      $apptotamt=$apptotamt+round($rowamt[0]);
                $reqtotamt=$reqtotamt+round($rowamt[5]);
           
	      }
	      
	      $appdt="";
	      if($rowarr[11]!='y' )
	      {
	      if($rowamt[3]!="0000-00-00")
	        {
	         $appdt=date('d-m-Y',strtotime($rowamt[3]));
	        }
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
	
   $trdet=mysqli_query($con,"select tamount,pdate,chqno from quotation1ftransfers where qid='".$rowarr[0]."'");
	  $trdrow=mysqli_fetch_array($trdet);
  

$trastamt=$trastamt+$trdrow[0];
	   $transfdt="";
	  if($trdrow[1]!='0000-00-00' && $trdrow[1]!='')
	  {
  $transfdt=date('d-m-Y',strtotime($trdrow[1]));
             }
  
  
  if($qname[0]=='DLB'){$dlbvariable='DLB Branch';}else{$dlbvariable=$qname[0];}
      
  $tik="";
    if($rowamt[7]!=""){ $tik=$rowamt[7];}else if($rowamt[8]!=""){$tik=$rowamt[8];}else if($rowamt[9]!=""){$tik= $rowamt[9];}else if($rowamt[10]!=""){$tik= $rowamt[10];}else if($rowamt[11]!=""){$tik= $rowamt[11];}else if($rowamt[12]!=""){$tik= $rowamt[12];};
  
    $sheet->setCellValue('A' . $i, $srn);
    $sheet->setCellValue('B' . $i, $cat);
    $sheet->setCellValue('C' . $i, $mdby);
    $sheet->setCellValue('D' . $i, $rowarr[1]);
    $sheet->setCellValue('E' . $i, $dlbvariable);
    $sheet->setCellValue('F' . $i, $rowarr[3]);
    $sheet->setCellValue('G' . $i, $rowarr[4]);
    $sheet->setCellValue('H' . $i, $rowarr[6]);
    $sheet->setCellValue('I' . $i, $rowarr[7]);
    $sheet->setCellValue('J' . $i, $rowarr[8]);
    $sheet->setCellValue('K' . $i, $wrkdet);
    $sheet->setCellValue('L' . $i, round($amt));
    $sheet->setCellValue('M' . $i, round($rowamt[0]));
    $sheet->setCellValue('N' . $i, round($rowamt[5]));
    $sheet->setCellValue('O' . $i, $rowamt[2]);
    $sheet->setCellValue('P' . $i, $appdt);
    $sheet->setCellValue('Q' . $i, $rowamt[4]);
    $sheet->setCellValue('R' . $i, $stat);
    $sheet->setCellValue('S' . $i, $cstat);
    $sheet->setCellValue('T' . $i, $qchis);
    $sheet->setCellValue('U' . $i, round($trdrow[0]));
    $sheet->setCellValue('V' . $i, $transfdt);
    $sheet->setCellValue('W' . $i, $trdrow[2]);
    $sheet->setCellValue('X' . $i, $supvn);
    $sheet->setCellValue('Y' . $i, $rowamt[6]);
    $sheet->setCellValue('Z' . $i, $tik);   
 
    $i++;
    $counter++ ; 
    
    $row++;
    $srn++;
}

$lastrow= intval($srn)+intval(1);

//$objSheet->getStyle('A1:AD1')->getFont()->setBold(true)->setSize(12);
//$highestRow = $objSheet->getHighestRow();
$sheet->setCellValue('L' . $lastrow, $totamt);
$sheet->setCellValue('M' . $lastrow, $apptotamt);
$sheet->setCellValue('N' . $lastrow, $reqtotamt);
$sheet->setCellValue('U' . $lastrow, round($trastamt));

//ob_start();

// Create a writer to save the Excel file
$writer = new Xlsx($spreadsheet);

// Save the Excel file to a temporary location
$tempFile = tempnam(sys_get_temp_dir(), 'Inventory');
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
