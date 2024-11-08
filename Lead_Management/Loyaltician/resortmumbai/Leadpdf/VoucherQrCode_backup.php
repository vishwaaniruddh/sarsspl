<?php
ob_start();
require_once('generatepdf/TCPDF-master/examples/tcpdf_include.php');
include('generatepdf/TCPDF-master/tcpdf.php');

// require_once('generatepdf/TCPDF-main/examples/tcpdf_include.php');
// include('generatepdf/TCPDF-man/tcpdf.php');

include('../config.php');

include('../phpqrcode/qrlib.php');


//QRcode::png('PHP QR Code :)', 'myqr.png', $errorCorrectionLevel, $matrixPointSize, 2);

$tempDir = '../phpqrcode/barcode_image/';


// var_dump($_POST); 

class MYPDF extends TCPDF
{

    public function __construct()
    {
        parent::__construct('P', 'mm', 'A4', true, 'UTF-8');
        $this->SetDisplayMode('fullpage', 'SinglePage', 'UseNone', 113);

    }


    
    //Page header
    public function Header()
    {
    }

     public function Footer() {
      
        // $this->SetY(50);
        // // Set font
        // $this->SetFont('helvetica', 'I', 8);
        // // Page number
        // $this->Cell(0, 5, 'Page'.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 1, false, 'C', 0, '', 0, false, 'T', 'M');
        
        
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetAutoPageBreak(TRUE, 1);

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetFont('times', '', 8.5);

$zoomScript = 'this.zoom = 113;';
$pdf->IncludeJS($zoomScript);
$pdf->setMargins(5, 5.2, 5, 2);
$pdf->setCellPaddings(1, 1, 1, 1);
$pdf->setCellMargins(1, 1, 1, 1);
$pdf->SetFillColor(255, 255, 127);
$pdf->Ln(1);


$htmtab1_body =
    '<table     width="113%"   style="padding:0px;" >';
$srno = 0;
$drop = $_POST['drop'];

$exp = explode(",", $drop);

for ($kk = 0; $kk < count($exp); $kk++) {

if(($kk+1)%50==1){
   $pdf->AddPage();
$pdf->setMargins(0, 5, 5, 2);
$pdf->setCellPaddings(1, 1, 1, 1);
$pdf->setCellMargins(1, 1, 1, 1);
$pdf->Ln(1);

}else if(($kk+1)%50==2){
    $pdf->setMargins(5, 12, 4, 2);
}else if(($kk+1)%50==3){
    $pdf->setMargins(5, 12, 4, 2);
}else if(($kk+1)%50==4){
    $pdf->setMargins(5, 12, 4, 2);
}else if(($kk+1)%50==5){
    $pdf->setMargins(-15, 0, 0, 0);
}

    $Voucher = $exp[$kk];
    // echo $Voucher;
    $getLevel = substr($Voucher, 1, 1);



    if($getLevel==2){
    $getLevel=1;
    // $max_issued = 12000500 ;
    
}elseif($getLevel==4){
    $getLevel=2;
    // $max_issued = 14000500 ;
        
    
}
    
    // echo $getLevel;die;




    $q = "SELECT count(level_id) as V_no from voucher_Type where level_id='" . $getLevel . "'";
    $sql = mysqli_query($conn, $q);
    $_row = mysqli_fetch_array($sql);

    $sqlMemb = mysqli_query($conn, "Select MembershipNumber from voucher_Details where VoucherBookletNumber='" . $Voucher . "' ");
    $_rowMemb = mysqli_fetch_array($sqlMemb);


    $p = mysqli_query($conn, "select count(Program_ID) from voucher_issued_additional as voucher_no where Program_ID ='" . $getLevel . "' ");
    $_p = mysqli_fetch_array($p);


    if ($_rowMemb['MembershipNumber'] != "") {
        $Memb_details = mysqli_query($conn, "Select GenerateMember_Id,Primary_nameOnTheCard,entryDate,ExpiryDate, PromotionalCheck1,promotional_voucher_code,RenewalCheck1,renewal_voucher_code from Members where GenerateMember_Id='" . $_rowMemb['MembershipNumber'] . "' ");
        $detailsMemb = mysqli_fetch_array($Memb_details);


        $PromotionalCheck1 = $detailsMemb['PromotionalCheck1'];
       
        $promotional_voucher_code = $detailsMemb['promotional_voucher_code'];
        $promovoucher = json_decode($promotional_voucher_code);
        
         $RenewalCheck1 = $detailsMemb['RenewalCheck1'];
        $renewal_voucher_code = $detailsMemb['renewal_voucher_code'];
        // $promovoucher = json_decode($renewal_voucher_code);

        $R = date('F, Y', strtotime($detailsMemb['ExpiryDate']));
    }


 $barcode_sql = mysqli_query($conn,"select * from BarcodeScan where Voucher_id like '".$Voucher."%'");
while($barcode_sql_result = mysqli_fetch_assoc($barcode_sql)){
        $Voucher_id= $barcode_sql_result['Voucher_id'];

    $codeContents = $Voucher_id;
    $fileName = $NoOfVoucher.'.png';
    $pngAbsoluteFilePath = $tempDir.$fileName;
    $ccc=$pngAbsoluteFilePath;
    //$urlRelativeFilePath = EXAMPLE_TMP_URLRELPATH.$fileName;
    QRcode::png($codeContents, $pngAbsoluteFilePath); 

        $L = 4;
        $K += $L;
        if ($srno % 5 == 0) {
            $htmtab1_body .= '<tr  style="font-color:black;margin-bottom: 1.8cm;" cellspacing="0" cellpadding="0">';
        }
            $htmtab1_body .= '<td cellpadding="0" cellspacing="0">
                                  <p style="line-height:100%;font-size:8.5px; max-height: 2.2cm;"> 
                                      <img src="' . $ccc . '" alt="Smiley face" width="52" height="52" style="float:left;" > 
                                      <div style="line-height:-250%;text-align:right; max-height: 2.2cm;">' . $detailsMemb['Primary_nameOnTheCard'] . '</div><br/>
                                      <div style="line-height:-75%;text-align:right; max-height: 2.2cm;">MemberId :' . $detailsMemb['GenerateMember_Id'] . '</div><br/>
                                      <div style="line-height:-25%;text-align:right; max-height: 2.2cm;">Voucher :' . $codeContents . '</div><br/>
                                      <div style="line-height:-15%;text-align:right; max-height: 2.2cm;">Expiry ' . $R . '</div>
                                  </p>
                              </td> ';



        if ($srno % 5 == 4) {
            $htmtab1_body .= '<td></td></tr>';
        }
        $srno++;
    }
    
    if($RenewalCheck1=="1"){

        $renewal_voucher_code=json_encode($renewal_voucher_code);
        $renewal_voucher_code=str_replace( array('[',']','"') , ''  , $renewal_voucher_code);
        $arr=explode(',',$renewal_voucher_code);
        $renewal_voucher_code = "'" . implode ( "', '", $arr )."'";
    




$barcode_sql = mysqli_query($conn,"select * from BarcodeScan where Voucher_id in($renewal_voucher_code)");
while($barcode_sql_result = mysqli_fetch_assoc($barcode_sql)){
    $Voucher_id= $barcode_sql_result['Voucher_id'];
    
    $codeContents = $Voucher_id;
    $fileName = $NoOfVoucher.'.png';
    $pngAbsoluteFilePath = $tempDir.$fileName;
    $ccc=$pngAbsoluteFilePath;
    //$urlRelativeFilePath = EXAMPLE_TMP_URLRELPATH.$fileName;
    QRcode::png($codeContents, $pngAbsoluteFilePath); 



 $L=4;
   $K+=$L;
    // echo $l;
    if ($srno%4 == $k) { $htmtab1_body.='<tr  style="font-color:black;">';}
    
                $pdf->SetCellHeightRatio(2.2);
            $htmtab1_body .= '<td cellpadding="0" cellspacing="0" >
                      <p style="line-height:100%;font-size:8.5px; max-height: 2.2cm;"> 
                      <img src="' . $ccc . '" alt="Smiley face" width="52" height="52" style="float:left;" > 
                      <div style="line-height:-250%;text-align:right; max-height: 2.2cm;">' . $detailsMemb['Primary_nameOnTheCard'] . '</div><br/>
                      <div style="line-height:-75%;text-align:right; max-height: 2.2cm;">MemberId :' . $detailsMemb['GenerateMember_Id'] . '</div><br/>
                      <div style="line-height:-25%;text-align:right; max-height: 2.2cm;">Voucher :' . $codeContents . '</div><br/>
                      <div style="line-height:-15%;text-align:right; max-height: 2.2cm;"> Expiry ' . $R . '</div></p>
                      </td> ';
  
//   $htmtab1_body.='<td ><p style="line-height:100%;font-size:8px;">  <img src="'.$ccc.'" alt="Smiley face" width="52" height="52" style="float:left;" > 
//   <div style="line-height:-280%;text-align:right">'.$detailsMemb['Primary_nameOnTheCard'].'</div><br/><div style="line-height:-90%;text-align:right">MemberId :'.$detailsMemb['GenerateMember_Id'].'</div><br/>
//   <div style="line-height:-25%;text-align:right">Voucher :'.$codeContents.'</div><br/><div style="line-height:-15%;text-align:right"> Expiry '.$R.'</div></p></td> ';
  
  
  
  
    if ($srno%4 == 3) { $htmtab1_body.='</tr>';} 
$srno++;

}

    
}
    
    
    if ($PromotionalCheck1 == "1") {
        for ($j = 0; $j < count($promovoucher); $j++) {
            
            $NoOfVoucher = $promovoucher[$j];
            
            $codeContents = $NoOfVoucher;
            $fileName = $NoOfVoucher . '.png';
            $pngAbsoluteFilePath = $tempDir . $fileName;
            $ccc = $pngAbsoluteFilePath;
            QRcode::png($codeContents, $pngAbsoluteFilePath);
            $L = 4;
            $K += $L;
            if ($srno % 5 == 0) {
                $htmtab1_body .= '<tr  style="font-color:black;margin-bottom: 1.8cm;" cellspacing="0" cellpadding="0">';
            }

            $pdf->SetCellHeightRatio(2.2);
            $htmtab1_body .= '<td cellpadding="0" cellspacing="0" >
                      <p style="line-height:100%;font-size:8.5px; max-height: 2.2cm;"> 
                      <img src="' . $ccc . '" alt="Smiley face" width="52" height="52" style="float:left;" > 
                      <div style="line-height:-250%;text-align:right; max-height: 2.2cm;">' . $detailsMemb['Primary_nameOnTheCard'] . '</div><br/>
                      <div style="line-height:-75%;text-align:right; max-height: 2.2cm;">MemberId :' . $detailsMemb['GenerateMember_Id'] . '</div><br/>
                      <div style="line-height:-25%;text-align:right; max-height: 2.2cm;">Voucher :' . $codeContents . '</div><br/>
                      <div style="line-height:-15%;text-align:right; max-height: 2.2cm;"> Expiry ' . $R . '</div></p>
                      </td> ';

            if ($srno % 5 == 4) {
                $htmtab1_body .= '<td></td></tr>';
            }
            $srno++;
        }
    }
}

if ($srno%4 == 1) { $htmtab1_body.='<td></td><td></td><td></td></tr>';}
else if ($srno%4 == 2) { $htmtab1_body.='<td></td><td></td></tr>';}
else if ($srno%4 == 3) { $htmtab1_body.='<td></td></tr>';}
$htmtab1_body .= '</table>';


$pdf->writeHTML($htmtab1_body, true, false, false, false, '');

$pdf->Output('example_003.pdf', 'FI');

?>
<style>
.inline { 
   float:left ;
    
    margin:10px;
    }
    .inline1 { 
   float:right; 
    
    margin:10px;
    }
    
    </style>