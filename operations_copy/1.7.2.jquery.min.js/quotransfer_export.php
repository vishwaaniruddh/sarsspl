<?php

ini_set('max_execution_time', 0);
    set_time_limit(0) ;
    
  

include("config.php");

$qry=$_POST['expqry'];
//echo $qry;


require_once '../ebill/Classes/PHPExcel.php';

require_once "../ebill/Classes/PHPExcel/IOFactory.php";

include_once '../ebill/Classes/PHPExcel/Writer/Excel5.php';

// create new PHPExcel object
$objPHPExcel = new PHPExcel();



 
ini_set('memory_limit', '-1');
//Prevent your script from timing out

// This increases the excution time from 30 secs to 3000 secs.
//set_time_limit ( 3000 ); 


// writer already created the first sheet for us, let's get it
$objSheet = $objPHPExcel->getActiveSheet();

// rename the sheet
$objSheet->setTitle('Quotation detail');



$objSheet->setCellValue('A1', 'Sr No');
$objSheet->setCellValue('B1', 'Category');
$objSheet->setCellValue('C1', 'Made By');
$objSheet->setCellValue('D1', 'Quotation ID');
$objSheet->setCellValue('E1', 'Customer');
$objSheet->setCellValue('F1', 'Atm');
$objSheet->setCellValue('G1', 'Bank');
$objSheet->setCellValue('H1', 'Location');
$objSheet->setCellValue('I1', 'City');
$objSheet->setCellValue('J1', 'State');
$objSheet->setCellValue('K1', 'Work Details');

$objSheet->setCellValue('L1', 'Amount');
$objSheet->setCellValue('M1', 'Approved AMOUNT');
$objSheet->setCellValue('N1', 'Rerquired AMOUNT');

$objSheet->setCellValue('O1', 'Approved Date');
$objSheet->setCellValue('P1', 'Approved By');

$objSheet->setCellValue('Q1', 'Beneficiary Name');
$objSheet->setCellValue('R1', 'Beneficiary Account No');

$objSheet->setCellValue('S1', 'Transferred Date');
$objSheet->setCellValue('T1', 'Transferred Amount');
$objSheet->setCellValue('U1', 'Cheque No');
$objSheet->setCellValue('V1', 'Ticket No/Job ID/PO No');




$sqry=mysqli_query($con,$qry);
$num=mysqli_num_rows($sqry);





$srn=1;
$gtotal=0;
$row = 2;

$totamt=0;
$apptotamt=0;
$requotamt=0;
 $reqtotamt=0;
$transamttot=0;
while($rowarr=mysqli_fetch_array($sqry))
{


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



 $objSheet->setCellValueByColumnAndRow(0, $row, $srn);
$objSheet->setCellValueByColumnAndRow(1, $row,$cat);
$objSheet->setCellValueByColumnAndRow(2, $row, $mdby);
$objSheet->setCellValueByColumnAndRow(3, $row, $rowarr[1]);
$objSheet->setCellValueByColumnAndRow(4, $row, $qname[0]);
$objSheet->setCellValueExplicitByColumnAndRow(5, $row, $rowarr[3]);
$objSheet->setCellValueByColumnAndRow(6, $row, $rowarr[4]);
$objSheet->setCellValueByColumnAndRow(7, $row, $rowarr[6]);
$objSheet->setCellValueByColumnAndRow(8, $row, $rowarr[7]);
$objSheet->setCellValueByColumnAndRow(9, $row, $rowarr[8]);


$objSheet->setCellValueByColumnAndRow(10, $row,$wrkdet);
$objSheet->setCellValueByColumnAndRow(11, $row,  $amt);
$objSheet->setCellValueByColumnAndRow(12, $row,round($rowamt[0]));
$objSheet->setCellValueByColumnAndRow(13, $row,round($rowamt[4]));

$objSheet->setCellValueByColumnAndRow(14, $row, $appdt );
$objSheet->setCellValueByColumnAndRow(15, $row,$rowamt[2]);

$objSheet->setCellValueByColumnAndRow(16, $row,$supvname);
$objSheet->setCellValueExplicitByColumnAndRow(17, $row,$sname[2] );


$objSheet->setCellValueByColumnAndRow(18, $row,$trdate );
$objSheet->setCellValueByColumnAndRow(19, $row,$trasamt);
$objSheet->setCellValueByColumnAndRow(20, $row,$tdarow[5]);

 $amtqry1=mysqli_query($con,"select ticket_no,job,po from quotation_approve_details where qid='".$rowarr[0]."'");
 $rowamt1=mysqli_fetch_array($amtqry1);
  
  if($rowamt1[0]){
  $objSheet->setCellValueByColumnAndRow(21, $row,$rowamt1[0]);
  }
  else if($rowamt1[1]){
  $objSheet->setCellValueByColumnAndRow(21, $row,$rowamt1[1]);
  }
  else if($rowamt1[2]){
  $objSheet->setCellValueByColumnAndRow(21, $row,$rowamt1[2]);
  }
 


$row++;
$srn++;
}




$lastrow= intval($srn)+intval(1);

//$objSheet->getStyle('A1:AD1')->getFont()->setBold(true)->setSize(12);
$highestRow = $objSheet->getHighestRow();
$objSheet->setCellValueByColumnAndRow(11,$lastrow, $totamt);
$objSheet->setCellValueByColumnAndRow(12,$lastrow, $apptotamt);
$objSheet->setCellValueByColumnAndRow(13,$lastrow, $requotamt);
$objSheet->setCellValueByColumnAndRow(19,$lastrow, $transamttot);





//$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
////$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
//ob_clean();

 header("Content-Disposition: attachment; filename=quotationdetails.xls");
 header("Content-Type: application/vnd.ms-excel");

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
$objWriter->save("php://output");
?>

	
	
	