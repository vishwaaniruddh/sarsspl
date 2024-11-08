<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);


class PDFService {

    function generatePDF($result, $id) {
        require_once __DIR__ . '/../library/tcpdf/tcpdf.php';
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetHeaderData('', PDF_HEADER_LOGO_WIDTH, '', '', array(
            0,
            0,
            0
        ), array(
            255,
            255,
            255
        ));
        $pdf->SetTitle('Agreement - ' . $id);
        $pdf->SetMargins(4, 4, 4, true);
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once (dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('helvetica', '', 10);
        $pdf->AddPage();

        require_once __DIR__ . '/agreement.php';
        $html = getHTMLPurchaseDataToPDF($result, $id);
        $filename = "Agreement - " . $id;
        $pdf->writeHTML($html, true, false, true, false, '');
        // ob_end_clean();
        if (ob_get_contents()) ob_end_clean();
        $pdf->Output($filename . '.pdf', 'I');
        // $pdf->Output(__DIR__ . '/bills/GST-'.$filename . '.pdf', 'F');
    }
}

?>