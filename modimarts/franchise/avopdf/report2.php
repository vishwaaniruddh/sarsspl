<?php
require_once('generatepdf/TCPDF-master/examples/tcpdf_include.php');
include('generatepdf/TCPDF-master/tcpdf.php');
include('../config.php');
$alertid=$_GET['aid'];
/*$sql=mysql_query("select * from alert where alert_id='".$alertid."'");
$row=mysql_fetch_array($sql);

$fsrsql=mysql_query("select * from FSR_details where alertid='".$alertid."'");
$fsrrow=mysql_fetch_array($fsrsql);*/

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
      $image_file ='AVO-Logo.png';
        $this->Image($image_file, 10, 10, 25, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
       // $this->SetFont('helvetica', 'B', 20);
        $this->SetFont('freesans','B',20);
       $this->Cell(0, 10, ' बालाजी    चै ि रटेबल   ट्रस्ट     ', 0, false, 'C', 0, '', 0, false, 'M', 'M');
$this->Ln();
$this->SetFont('helvetica', '', 10);
$this->Cell(0, 5, 'H.O: 230 S.N.Roy Road, Kolkata- 700038', 0, false, 'C', 0, '', 0, false, 'M', 'M');
$this->Ln();
$this->SetFont('helvetica', '', 10);
$this->Cell(0, 5, 'Service Help Line-033-32017233 / 65181192/Fax: 033-24886047.Email-service3@avoups.com', 0, false, 'C', 0, '', 0, false, 'M', 'M');

$this->Ln();
 $this->SetFont('freesans','B',10);
$this->Cell(0, 5, 'चंदा रसीद', 1,0,'C',false, '', 0, false, 'M', 'M');

//$htxc='FIELD SERVICE REPORT';
//$this->MultiCell(180,5,$htxc, 1, 'C',false,0, 0, '', '', true,0,true);
//$this->Ln(3);

    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Satyendra Sharma');
$pdf->SetTitle('E-FSR');
$pdf->SetSubject('Field Service Report');
$pdf->SetKeywords('E-FSR, PDF');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 10);

// add a page
$pdf->AddPage();

$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);

// set color for background
$pdf->SetFillColor(255, 255, 127);

$pdf->Ln(5);


$pdf->SetFont('freeserif','',10);
$pdf->MultiCell(95, 5, 'क्रमाकं  :'.$avobranch, 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(80, 5, 'तारीख:'.$docketno, 0, 'L', 0, 0, '', '', true);
$pdf->Ln(15);
$pdf->MultiCell(95, 5, 'दृारा  श्री:'.$customername, 0, '0', 0, 0, '', '', true);
//$pdf->MultiCell(80, 5, 'ATM ID:'.$atmid, 0, 'L', 0, 0, '', '', true);
$pdf->Ln();
$pdf->MultiCell(95, 5,' कंपनी का नाम :'.$address, 0, '0', 0, 0, '', '', true,0,true);
//$pdf->MultiCell(80, 5, 'Phone/Mobile:'.$phn, 0, 'L', 0, 0, '', '', true);
$pdf->Ln();
$pdf->MultiCell(95, 5,' के याद में :'.$address, 0, '0', 0, 0, '', '', true,0,true);
$pdf->Ln();
$pdf->MultiCell(95, 5,' कंपनी का नाम :'.$address, 0, 'L', 0, 0, '', '', true,0,true);


$calltype="<b>".$row[17]."</b>";
$servrendered=$row[17];
$pdf->Ln(30);
$pdf->MultiCell(90, 5, 'Date of Call :'.$row[10], 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(50, 5, 'सधन्यवाद प्रा प्त     िकये: '.$cs, 0, 'L', 0, 0, '', '', true);

$pdf->Ln(10);
$pdf->writeHTML("<hr>", true, false, false, false, '');
$pdf->MultiCell(180,5,'Call Type: '.$calltype, 1, 'L', 0, 0, '', '', true,0,true);
$pdf->Ln();
$pdf->MultiCell(180, 5, 'Service Rendered: '.$servrendered, 1, 'C', 0, 0, '', '', true);


$pdf->Ln(10);

$htmtab1='
<table border="1" width="90%" align="center">
<tr height="5px">
<td>
UPS Model
</td>
<td>

</td>
<td>
 UPS Quantity
</td>
<td>
UPS Serial Number
</td>
<td>
Battery Specs

</td>
<td>
Number of batteries</td>
</tr>

<tr height="5px">
<td>
'.$fsrrow[3].'
</td>
<td>
'.$fsrrow[4].'
</td>
<td>
'.$fsrrow[5].'
</td>
<td>
'.$fsrrow[6].'
</td>
<td>
'.$fsrrow[7].'</td>
<td>
'.$fsrrow[8].'</td>
</tr>
</table>
';
//$pdf->MultiCell(180, 5,$htmtab1, 1, 'C', 0, 0, '', '', true);
$pdf->writeHTML($htmtab1, true, false, false, false, '');


$pdf->Output('example_003.pdf', 'I');

?>