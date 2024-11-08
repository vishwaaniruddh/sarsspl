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
$objSheet->setCellValue('L1', 'Beneficiary Name');
$objSheet->setCellValue('M1', 'Beneficiary Acc no');
$objSheet->setCellValue('N1', 'Beneficiary IFSC');

$objSheet->setCellValue('O1', 'Amount');
$objSheet->setCellValue('P1', 'Approved AMOUNT');

$objSheet->setCellValue('Q1', 'Rerquired AMOUNT');
$objSheet->setCellValue('R1', 'Transferred AMOUNT');
$objSheet->setCellValue('S1', 'Transfer Remark');

$objSheet->setCellValue('T1', 'Approved Date');

$objSheet->setCellValue('U1', 'Approved By');
$objSheet->setCellValue('V1', 'Status');
$objSheet->setCellValue('W1', 'Call Status');
$objSheet->setCellValue('X1', 'Call Status History');

$objSheet->getStyle('K')->getAlignment()->setWrapText(true);

$sqry=mysqli_query($con,$qry);
$num=mysqli_num_rows($sqry);





$srn=1;
$gtotal=0;
$row = 2;

$totamt=0;
$apptotamt=0;
$requotamt=0;
 $reqtotamt=0;

while($rowarr=mysqli_fetch_array($sqry))
{


//ini_set('max_execution_time', 123456);

 $tamt="";
if($rowarr[2]=='ICICI' || $rowarr[2]=='RATNAKAR' || $rowarr[2]=='ICICI Direct' || $rowarr[2]=='Knight Frank' )
{
 $icitot=mysqli_query($con,"select sum(amt) from icici_quot_details_tis where qid='".$rowarr[0]."'");
           $tamt=mysqli_fetch_array($icitot);

}
else
{
 

             
    $getamt=mysqli_query($con,"select sum(Total) from quotation_details_tis where qid='".$rowarr[0]."'");
	   $tamt=mysqli_fetch_array($getamt);       

}
	   
	    $ckhis=mysqli_query($con,"select qid from quotation_edit_history_tis where qid='".$rowarr[0]."' limit 0,1");
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
	       
	
	   if($rowarr[2]=='ICICI' || $rowarr[2]=='RATNAKAR' || $rowarr[2]=='ICICI Direct' || $rowarr[2]=='Knight Frank' )
{
	       
	       
	
   $qicicwrk=mysqli_query($con,"select * from icici_quot_details_tis where qid='".$rowarr[0]."'");
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
$qdetc=mysqli_query($con,"select distinct(particular) from quotation_details_tis where qid='".$rowarr[0]."'");
$des="";
 while($gdetca=mysqli_fetch_array($qdetc))
 {

 $des.=$gdetca[0]."\n";

  $gpart=mysqli_query($con,"select * from quotation_details_tis where particular='".$gdetca[0]."' and qid='".$rowarr[0]."'");
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
	      $amtqry=mysqli_query($con,"select app_amt,filename,app_by,approved_date,req_amt from quotation_approve_details_tis where qid='".$rowarr[0]."'");
	     
	      $rowamt=mysqli_fetch_array($amtqry);
	      //echo round($rowamt[0]);
	      $apptotamt=$apptotamt+round($rowamt[0]);
            $requotamt=$requotamt+round($rowamt[4]);
             
	      }
	      
	      $appdt="";
	     if($rowarr[11]!='y' )
	      {
	      if($rowamt[3]!="0000-00-00")
	        {
	         $appdt=date("d-m-Y",strtotime($rowamt[3]));
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
  $gqhis=mysqli_query($con,"select * from quotation_close_detail_tis where qid='".$rowarr[0]."'");
	  $ghrw=mysqli_fetch_array($gqhis);
	  $qcdt=date("d-m-Y",strtotime($ghrw[2]));
	   $qchis=$qcdt." ".$ghrw[3]." ".$ghrw[4];
	}  
  
   $greamt=mysqli_query($con,"select req_amt,remark from quotation1_req_tis where qid='".$rowarr[0]."'");
            $reqamtw=mysqli_fetch_array($greamt);
              // echo round($reqamtw[0]);
             $reqtotamt=$reqtotamt+round($reqamtw[0]);


 $sup=mysqli_query($con,"select hname,ifsc_code,accno from fundaccounts where aid='".$rowarr[17]."'");
	    $sname=mysqli_fetch_array($sup);

 
 

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


$objSheet->setCellValueByColumnAndRow(10, $row, $wrkdet);
$objSheet->setCellValueByColumnAndRow(11, $row, $sname[0]);
$objSheet->setCellValueExplicitByColumnAndRow(12, $row, $sname[2]);
$objSheet->setCellValueExplicitByColumnAndRow(13, $row, $sname[1]);

$objSheet->setCellValueByColumnAndRow(14, $row, $amt);
$objSheet->setCellValueByColumnAndRow(15, $row, $rowamt[0]);

$objSheet->setCellValueByColumnAndRow(16, $row, round($rowamt[4]));
$objSheet->setCellValueByColumnAndRow(17, $row, round($reqamtw[0]));
$objSheet->setCellValueByColumnAndRow(18, $row, $reqamtw[1]);

$objSheet->setCellValueByColumnAndRow(19, $row, $appdt);

$objSheet->setCellValueByColumnAndRow(20, $row, $rowamt[2]);
$objSheet->setCellValueByColumnAndRow(21, $row, $stat);
$objSheet->setCellValueByColumnAndRow(22, $row, $cstat);
$objSheet->setCellValueByColumnAndRow(23, $row, $qchis);
$objSheet->setCellValueByColumnAndRow(24, $row, $qdetc2);



$row++;
$srn++;
}





$lastrow= intval($srn)+intval(1);

//$objSheet->getStyle('A1:AD1')->getFont()->setBold(true)->setSize(12);
$highestRow = $objSheet->getHighestRow();
$objSheet->setCellValueByColumnAndRow(14,$lastrow, $totamt);
$objSheet->setCellValueByColumnAndRow(15,$lastrow, $apptotamt);
$objSheet->setCellValueByColumnAndRow(16,$lastrow, $requotamt);
$objSheet->setCellValueByColumnAndRow(17,$lastrow, $reqtotamt);




//$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
////$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
//ob_clean();

 header("Content-Disposition: attachment; filename=quotationdetails.xls");
 header("Content-Type: application/vnd.ms-excel");

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
$objWriter->save("php://output");
?>

	
	
	