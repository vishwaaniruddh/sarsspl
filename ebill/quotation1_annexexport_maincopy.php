<?php

ini_set('max_execution_time', 0);
    set_time_limit(0) ;
    
  

include("config.php");

$qry=$_POST['expqry'];
//echo $qry;

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

//rename the sheet
$objSheet->setTitle('Quotation detail');

 	
$objSheet->setCellValue('A1', 'Sr No');
$objSheet->setCellValue('B1', 'Category');
$objSheet->setCellValue('C1', 'Made By');
$objSheet->setCellValue('D1', 'CSS Ref No');
$objSheet->setCellValue('E1', 'Customer');
$objSheet->setCellValue('F1', 'Project');

$objSheet->setCellValue('G1', 'Bank');
$objSheet->setCellValue('H1', 'Atm');

$objSheet->setCellValue('I1', 'Site ID');
$objSheet->setCellValue('J1', 'VPR NO');
$objSheet->setCellValue('K1', 'I O CODE');
$objSheet->setCellValue('L1', 'JOB ID');
$objSheet->setCellValue('M1', 'Ticket No');
$objSheet->setCellValue('N1', 'City');

$objSheet->setCellValue('O1', 'State');
$objSheet->setCellValue('P1', 'Location');

$objSheet->setCellValue('Q1', 'Work Details');
$objSheet->setCellValue('R1', 'Zone ');
$objSheet->setCellValue('S1', 'Month');
$objSheet->setCellValue('T1', 'Approval Date');
$objSheet->setCellValue('U1', 'Approval Amount');

$objSheet->setCellValue('V1', 'Approved By');
$objSheet->setCellValue('W1', 'Mail By');
$objSheet->setCellValue('X1', 'Call Status');
$objSheet->setCellValue('Y1', 'Prime Code');

$objSheet->getStyle('Q')->getAlignment()->setWrapText(true);
$sqry=mysqli_query($con,$qry);
$num=mysqli_num_rows($sqry);


$count=0;
$srn=1;
$apptotamt==0;
$row = 2;
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

$st="";
if($row[16]=="0")
{$st="Opened";
}else{ $st="Closed";}

$objSheet->setCellValueByColumnAndRow(0, $row, $srn);
$objSheet->setCellValueByColumnAndRow(1, $row,$cat);
$objSheet->setCellValueByColumnAndRow(2, $row,$mdby1);
$objSheet->setCellValueByColumnAndRow(3, $row,$rowarr[1]);
$objSheet->setCellValueByColumnAndRow(4, $row,$qname[0]);
$objSheet->setCellValueExplicitByColumnAndRow(5, $row, $rowarr[5]);
$objSheet->setCellValueByColumnAndRow(6, $row, $rowarr[4]);
$objSheet->setCellValueByColumnAndRow(7, $row, $rowarr[3]);
$objSheet->setCellValueByColumnAndRow(8, $row,$projrow[1] );
$objSheet->setCellValueByColumnAndRow(9, $row, $approw[3]);
$objSheet->setCellValueByColumnAndRow(10, $row, $approw[2]);
$objSheet->setCellValueByColumnAndRow(11, $row,$approw[4]);
$objSheet->setCellValueByColumnAndRow(12, $row,$approw[14]);
$objSheet->setCellValueByColumnAndRow(13, $row, $rowarr[7]);
$objSheet->setCellValueByColumnAndRow(14, $row,$rowarr[8]);
$objSheet->setCellValueByColumnAndRow(15, $row,$rowarr[6]);
$objSheet->setCellValueByColumnAndRow(16, $row,$wrkdet);
$objSheet->setCellValueByColumnAndRow(17, $row,$projrow[2]);
$objSheet->setCellValueByColumnAndRow(18, $row,$mnth);
$objSheet->setCellValueByColumnAndRow(19, $row,$appdt);
$objSheet->setCellValueByColumnAndRow(20, $row,$appamt);
$objSheet->setCellValueByColumnAndRow(21, $row,$approw[7]);
$objSheet->setCellValueByColumnAndRow(22, $row,$mdrow[0]);
$objSheet->setCellValueByColumnAndRow(23, $row,$st);
$objSheet->setCellValueByColumnAndRow(24, $row,$approw[5]);

$row++;
$srn++;
}


$lastrow= intval($srn)+intval(1);

//$objSheet->getStyle('A1:AD1')->getFont()->setBold(true)->setSize(12);
$highestRow = $objSheet->getHighestRow();
$objSheet->setCellValueByColumnAndRow(20,$lastrow,$apptotamt);




















 header("Content-Disposition: attachment; filename=annexure.xls");
 header("Content-Type: application/vnd.ms-excel");

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
$objWriter->save("php://output");
?>















