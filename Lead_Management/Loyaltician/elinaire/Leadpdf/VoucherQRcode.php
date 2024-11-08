<?php ob_start();
require_once ('generatepdf/TCPDF-master/examples/tcpdf_include.php');
include ('generatepdf/TCPDF-master/tcpdf.php');
include ('../config.php');

// include('../phpqrcode/qrlib.php');

/* Updated phpqrcode qrlib file location */

require_once ('../phpqrcode1/qrlib.php');

//QRcode::png('PHP QR Code :)', 'myqr.png', $errorCorrectionLevel, $matrixPointSize, 2);

$tempDir = '../phpqrcode/barcode_image/';


class MYPDF extends TCPDF
{

  //Page header
  public function Header()
  {

  }

  public function Footer()
  {

    $this->SetY(-15);
    // Set font
    $this->SetFont('helvetica', 'I', 8);
    // Page number
    $this->Cell(0, 10, 'Page' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');


  }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Satyendra Sharma');
$pdf->SetTitle('L-LABLE');
$pdf->SetSubject('LABLE ADDRESS');
$pdf->SetKeywords('E-FSR, PDF');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
  require_once (dirname(__FILE__) . '/lang/eng.php');
  $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
$pdf->setMargins(10, 2, 1, 0);
// set font
$pdf->SetFont('times', '', 10);

// add a page
$pdf->AddPage();

$pdf->setMargins(10, 10, 1, 0);

$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);

// set color for background
$pdf->SetFillColor(255, 255, 127);

$pdf->Ln(1);


//$htmtab1_body="";
$htmtab1_body = '<table  border="1" width="90%"   style="padding:8px;" >';


$srno = 0;

//===========================================================================================================





$drop = $_POST['drop'];
$exp = explode(",", $drop);
for ($kk = 0; $kk < count($exp); $kk++) {
  //   echo $exp[$i];


  //$Voucher=$_POST['Voucher'];
  $Voucher = $exp[$kk];
  $getLevel = substr($Voucher, 1, 1);

  if ($getLevel == 2) {
    $getLevel = 1;
  } elseif ($getLevel == 4) {
    $getLevel = 2;
  } elseif ($getLevel == 8) {
    $getLevel = 3;
  }



  $q = "SELECT count(level_id) as V_no from voucher_Type where level_id='" . $getLevel . "'";
  $sql = mysqli_query($conn, $q);
  $_row = mysqli_fetch_array($sql);

  $sqlMemb = mysqli_query($conn, "Select MembershipNumber from voucher_Details where VoucherBookletNumber='" . $Voucher . "' ");
  $_rowMemb = mysqli_fetch_array($sqlMemb);

//   $PromotionalCheck1 = 0;
//   $RenewalCheck1 = 0;

  if ($_rowMemb['MembershipNumber'] != "") {
    $Memb_details = mysqli_query($conn, "Select GenerateMember_Id,Primary_nameOnTheCard,entryDate,ExpiryDate,	PromotionalCheck1,RenewalCheck1,promotional_voucher_code,renewal_voucher_code from Members where GenerateMember_Id='" . $_rowMemb['MembershipNumber'] . "' ");
    $detailsMemb = mysqli_fetch_array($Memb_details);

    $PromotionalCheck1 = $detailsMemb['PromotionalCheck1'];
    $RenewalCheck1 = $detailsMemb['RenewalCheck1'];
    $promotional_voucher_code = $detailsMemb['promotional_voucher_code'];
    $renewal_voucher_code = $detailsMemb['renewal_voucher_code'];

    $R = date('F, Y', strtotime($detailsMemb['ExpiryDate']));
  }
  //===========================================================================================================
/*   if ($srno%4 != 0) {$htmtab1_body.='<tr  style="font-size:12px;font-color:black">';}*/
  //while($_row=mysqli_fetch_array($sql)){

  for ($i = 1; $i <= $_row['V_no']; $i++) {

    $countR = $i;
    $readyToUse = sprintf("%03s", $countR);
    $NoOfVoucher = $Voucher . $readyToUse;

    $codeContents = $NoOfVoucher;
    $fileName = $NoOfVoucher . '.png';
    $pngAbsoluteFilePath = $tempDir . $fileName;
    $ccc = $pngAbsoluteFilePath;
    //$urlRelativeFilePath = EXAMPLE_TMP_URLRELPATH.$fileName;
    QRcode::png($codeContents, $pngAbsoluteFilePath);

    $L = 4;
    $K += $L;
    // echo $l;
    if ($srno % 4 == $k) {
      $htmtab1_body .= '<tr  style="font-color:black;">';
    }


    $htmtab1_body .= '<td ><p style="line-height:100%;font-size:8px;">  <img src="' . $ccc . '" alt="Smiley face" width="52" height="52" style="float:left;" > <div style="line-height:-280%;text-align:right">' . $detailsMemb['Primary_nameOnTheCard'] . '</div><br/><div style="line-height:-90%;text-align:right">MemberId :' . $detailsMemb['GenerateMember_Id'] . '</div><br/><div style="line-height:-25%;text-align:right">Voucher :' . $codeContents . '</div><br/><div style="line-height:-15%;text-align:right"> Expiry ' . $R . '</div></p></td> ';




    if ($srno % 4 == 3) {
      $htmtab1_body .= '</tr>';
    }
    $srno++;
  }


  if ($RenewalCheck1 == "1") {


    $NoOfVoucher = $renewal_voucher_code;

    $codeContents = $NoOfVoucher;
    $fileName = $NoOfVoucher . '.png';
    $pngAbsoluteFilePath = $tempDir . $fileName;
    $ccc = $pngAbsoluteFilePath;
    //$urlRelativeFilePath = EXAMPLE_TMP_URLRELPATH.$fileName;
    QRcode::png($codeContents, $pngAbsoluteFilePath);

    $L = 4;
    $K += $L;
    // echo $l;
    if ($srno % 4 == $k) {
      $htmtab1_body .= '<tr  style="font-color:black;">';
    }

    $htmtab1_body .= '<td ><p style="line-height:100%;font-size:8px;">  <img src="' . $ccc . '" alt="Smiley face" width="52" height="52" style="float:left;" > <div style="line-height:-280%;text-align:right">' . $detailsMemb['Primary_nameOnTheCard'] . '</div><br/><div style="line-height:-90%;text-align:right">MemberId :' . $detailsMemb['GenerateMember_Id'] . '</div><br/><div style="line-height:-25%;text-align:right">Voucher :' . $codeContents . '</div><br/><div style="line-height:-15%;text-align:right"> Expiry ' . $R . '</div></p></td> ';




    if ($srno % 4 == 3) {
      $htmtab1_body .= '</tr>';
    }
    $srno++;

  }

  if ($PromotionalCheck1 == "1") {


    $NoOfVoucher = $promotional_voucher_code;

    $codeContents = $NoOfVoucher;
    $fileName = $NoOfVoucher . '.png';
    $pngAbsoluteFilePath = $tempDir . $fileName;
    $ccc = $pngAbsoluteFilePath;
    //$urlRelativeFilePath = EXAMPLE_TMP_URLRELPATH.$fileName;
    QRcode::png($codeContents, $pngAbsoluteFilePath);

    $L = 4;
    $K += $L;
    // echo $l;
    if ($srno % 4 == $k) {
      $htmtab1_body .= '<tr  style="font-color:black;">';
    }


    $htmtab1_body .= '<td ><p style="line-height:100%;font-size:8px;">  <img src="' . $ccc . '" alt="Smiley face" width="52" height="52" style="float:left;" > <div style="line-height:-280%;text-align:right">' . $detailsMemb['Primary_nameOnTheCard'] . '</div><br/><div style="line-height:-90%;text-align:right">MemberId :' . $detailsMemb['GenerateMember_Id'] . '</div><br/><div style="line-height:-25%;text-align:right">Voucher :' . $codeContents . '</div><br/><div style="line-height:-15%;text-align:right"> Expiry ' . $R . '</div></p></td> ';




    if ($srno % 4 == 3) {
      $htmtab1_body .= '</tr>';
    }
    $srno++;

  }
  //if ($srno%4 != $k) {$htmtab1_body.='</tr>';}




}
if ($srno % 4 == 1) {
  $htmtab1_body .= '<td></td><td></td><td></td></tr>';
} else if ($srno % 4 == 2) {
  $htmtab1_body .= '<td></td><td></td></tr>';
} else if ($srno % 4 == 3) {
  $htmtab1_body .= '<td></td></tr>';
}

$htmtab1_body .= '</table>';

//echo  $htmtab1_body ;
$pdf->writeHTML($htmtab1_body, true, false, false, false, '');

//Close and output PDF document
$pdf->Output('example_003.pdf', 'FI');

//Close and output PDF document

?>
<style>
  .inline {
    float: left;

    margin: 10px;
  }

  .inline1 {
    float: right;

    margin: 10px;
  }
</style>