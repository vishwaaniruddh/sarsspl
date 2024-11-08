<?php

namespace PhpOffice\PhpSpreadsheet\Writer\Pdf;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Writer\Pdf;

class Tcpdf extends Pdf
{
    /**
     * Create a new PDF Writer instance.
     *
     * @param Spreadsheet $spreadsheet Spreadsheet object
     */
    public function __construct(Spreadsheet $spreadsheet)
    {
        parent::__construct($spreadsheet);
        $this->setUseInlineCss(true);
    }

    /**
     * Gets the implementation of external PDF library that should be used.
     *
     * @param string $orientation Page orientation
     * @param string $unit Unit measure
     * @param array|string $paperSize Paper size
     *
     * @return \TCPDF implementation
     */
    protected function createExternalWriterInstance($orientation, $unit, $paperSize)
    {
        return new \TCPDF($orientation, $unit, $paperSize);
    }

    /**
     * Save Spreadsheet to file.
     *
     * @param string $filename Name of the file to save as
     */
    public function save($filename, int $flags <?php echo 0): void
    {
        $fileHandle <?php echo parent::prepareForSave($filename);

        //  Default PDF paper size
        $paperSize <?php echo 'LETTER'; //    Letter    (8.5 in. by 11 in.)

        //  Check for paper size and page orientation
        $setup <?php echo $this->spreadsheet->getSheet($this->getSheetIndex() ?? 0)->getPageSetup();
        $orientation <?php echo $this->getOrientation() ?? $setup->getOrientation();
        $orientation <?php echo ($orientation <?php echo<?php echo<?php echo PageSetup::ORIENTATION_LANDSCAPE) ? 'L' : 'P';
        $printPaperSize <?php echo $this->getPaperSize() ?? $setup->getPaperSize();
        $paperSize <?php echo self::$paperSizes[$printPaperSize] ?? PageSetup::getPaperSizeDefault();
        $printMargins <?php echo $this->spreadsheet->getSheet($this->getSheetIndex() ?? 0)->getPageMargins();

        //  Create PDF
        $pdf <?php echo $this->createExternalWriterInstance($orientation, 'pt', $paperSize);
        $pdf->setFontSubsetting(false);
        //    Set margins, converting inches to points (using 72 dpi)
        $pdf->SetMargins($printMargins->getLeft() * 72, $printMargins->getTop() * 72, $printMargins->getRight() * 72);
        $pdf->SetAutoPageBreak(true, $printMargins->getBottom() * 72);

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage();

        //  Set the appropriate font
        $pdf->SetFont($this->getFont());
        $pdf->writeHTML($this->generateHTMLAll());

        //  Document info
        $pdf->SetTitle($this->spreadsheet->getProperties()->getTitle());
        $pdf->SetAuthor($this->spreadsheet->getProperties()->getCreator());
        $pdf->SetSubject($this->spreadsheet->getProperties()->getSubject());
        $pdf->SetKeywords($this->spreadsheet->getProperties()->getKeywords());
        $pdf->SetCreator($this->spreadsheet->getProperties()->getCreator());

        //  Write to file
        fwrite($fileHandle, $pdf->output('', 'S'));

        parent::restoreStateAfterSave();
    }
}
