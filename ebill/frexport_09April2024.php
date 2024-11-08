<?php

ini_set('max_execution_time', 0);
    set_time_limit(0) ;
    
  

include("config.php");


$qry=$_POST['expqry'];
// echo $qry;

ini_set('memory_limit', '-1');
ini_set('precision',30);
//Prevent your script from timing out

// Create the headers.
$header_args = array('Sr No', 'Category', 'Made By', 'Quotation ID', 'Customer', 'Atm', 'Bank', 'Location', 'City', 'State', 'Work Details', 'Beneficiary Name', 'Beneficiary Acc no', 'Beneficiary IFSC', 'Amount', 'Approved AMOUNT', 'Required AMOUNT', 'Transferred AMOUNT', 'Transfer Remark', 'Approved Date', 'Approval Remark', 'Approved By', 'Status', 'Call Status', 'Call Status History', 'Ticket No', 'Qid', 'Expectation Approval Amount');

$sqry=mysqli_query($con,$qry);
$num=mysqli_num_rows($sqry);



$data = array();

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
//  || $rowarr[2]=='kotak'
if($rowarr[2]=='ICICI' || $rowarr[2]=='RATNAKAR' || $rowarr[2]=='ICICI_Direct' || $rowarr[2]=='Knight_Frank' || $rowarr[2]=='Bandhan_Branch' )
{
 $icitot=mysqli_query($con,"select sum(amt) from icici_quot_details where qid='".$rowarr[0]."'");
           $tamt=mysqli_fetch_array($icitot);

}
else if($_POST['accname']=='563' && $rowarr[2]=='kotak'){  
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
	

$wrkdet="";       
	       //|| $rowarr[2]=='kotak'
   if($rowarr[2]=='ICICI' || $rowarr[2]=='RATNAKAR' || $rowarr[2]=='ICICI_Direct' || $rowarr[2]=='Knight_Frank' || $rowarr[2]=='Bandhan_Branch' )
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
else if($_POST['accname']=='563' && $rowarr[2]=='kotak'){  
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
	      $amtqry=mysqli_query($con,"select app_amt,filename,app_by,approved_date,req_amt,ticket_no,remark,expectedApprovalAmt from quotation_approve_details where qid='".$rowarr[0]."'");
	     
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
  $gqhis=mysqli_query($con,"select * from quotation_close_detail where qid='".$rowarr[0]."'");
	  $ghrw=mysqli_fetch_array($gqhis);
	  $qcdt=date("d-m-Y",strtotime($ghrw[2]));
	   $qchis=$qcdt." ".$ghrw[3]." ".$ghrw[4];
	}  
  
   $greamt=mysqli_query($con,"select req_amt,remark from quotation1_req where qid='".$rowarr[0]."'");
            $reqamtw=mysqli_fetch_array($greamt);
              // echo round($reqamtw[0]);
             $reqtotamt=$reqtotamt+round($reqamtw[0]);

$supervname="";
if($rowarr[17]!='' && $rowarr[17]!='-1')
{
 $sup=mysqli_query($con,"select hname,ifsc_code,accno from fundaccounts where aid='".$rowarr[17]."'");
	    $sname=mysqli_fetch_array($sup);
 $supervname=$sname[0];
 }
 else
 {
  $sup1=mysqli_query($con,"select chq_name from quotation1ftransfers where qid='".$rowarr[0]."'");
	    $sname1=mysqli_fetch_array($sup1);
	   // echo "select supervisor from quotation1ftransfers where qid='".$row[0]."'";
	     
  $supervname=$sname1[0];
 }
 
// echo "".$sname[2];die;
// $int=gmp_init("".$sname[2]);
//$ben_acc_no=gmp_strval($int);

//$ben_acc_no = strval($sname[2]);
//$ben_acc_no = printf('%0.0f',$sname[2]);

$longNumberAsNumber = $sname[2];
$first = intval($longNumberAsNumber / 100000000);
$last = $longNumberAsNumber - ($first*100000000);
//$ben_acc_no = " ".$first . $last."\t"; //Now a string variable w/o precision loss
//$ben_acc_no = "'".$sname[2]."\t";
//$ben_acc_no = number_format($ben_acc_no);

$ben_acc_no = "'".$sname[2];

 $new_data = array();
 array_push($new_data, $srn, $cat, $mdby, $rowarr[1], $qname[0], $rowarr[3], $rowarr[4], $rowarr[6], $rowarr[7], $rowarr[8], $wrkdet,$supervname, $ben_acc_no, $sname[1], $amt, $rowamt[0], round($rowamt[4]), round($reqamtw[0]), $reqamtw[1], $appdt, $rowamt[6], $rowamt[2], $stat, $cstat, $qchis, $rowamt[5],$rowarr[0],$rowamt[7]);
 array_push($data, $new_data);
$row++;
$srn++;
}

//echo '<pre>';print_r($data);echo '</pre>';die;

// Start the output buffer.
ob_start();

// Set PHP headers for CSV output.
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=quotationdetails.csv');

 


$lastrow= intval($srn)+intval(1);

//$objSheet->getStyle('A1:AD1')->getFont()->setBold(true)->setSize(12);
/*$highestRow = $objSheet->getHighestRow();
$objSheet->setCellValueByColumnAndRow(14,$lastrow, $totamt);
$objSheet->setCellValueByColumnAndRow(15,$lastrow, $apptotamt);
$objSheet->setCellValueByColumnAndRow(16,$lastrow, $requotamt);
$objSheet->setCellValueByColumnAndRow(17,$lastrow, $reqtotamt); */

// Clean up output buffer before writing anything to CSV file.
ob_end_clean();

// Create a file pointer with PHP.
$output = fopen( 'php://output', 'w' );

// Write headers to CSV file.
//fputcsv( $output, $header_titles);
fputcsv( $output, $header_args );

// Loop through the prepared data to output it to CSV file.
foreach( $data as $data_item ){
    fputcsv( $output, $data_item );
}

$header_bottom = array('','','','','','','','Total','','','','','','',$totamt,$apptotamt,$requotamt,$reqtotamt);
fputcsv( $output, $header_bottom );

// Close the file pointer with PHP with the updated output.
fclose( $output );
exit;
?>

	
	
	