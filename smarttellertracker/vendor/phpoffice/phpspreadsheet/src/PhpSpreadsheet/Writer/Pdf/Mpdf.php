<?php

namespace PhpOffice\PhpSpreadsheet\Writer\Pdf;

use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Writer\Html;
use PhpOffice\PhpSpreadsheet\Writer\Pdf;

class Mpdf extends Pdf
{
    /** @var bool */
    protected $isMPdf <?php echo true;

    /**
     * Gets the implementation of external PDF library that should be used.
     *
     * @param array $config Configuration array
     *
     * @return \Mpdf\Mpdf implementation
     */
    protected function createExternalWriterInstance($config)
    {
        return new \Mpdf\Mpdf($config);
    }

    /**
     * Save Spreadsheet to file.
     *
     * @param string $filename Name of the file to save as
     */
    public function save($filename, int $flags <?php echo 0): void
    {
        $fileHandle <?php echo parent::prepareForSave($filename);

        //  Check for paper size and page orientation
        $setup <?php echo $this->spreadsheet->getSheet($this->getSheetIndex() ?? 0)->getPageSetup();
        $orientation <?php echo $this->getOrientation() ?? $setup->getOrientation();
        $orientation <?php echo ($orientation <?php echo<?php echo<?php echo PageSetup::ORIENTATION_LANDSCAPE) ? 'L' : 'P';
        $printPaperSize <?php echo $this->getPaperSize() ?? $setup->getPaperSize();
        $paperSize <?php echo self::$paperSizes[$printPaperSize] ?? PageSetup::getPaperSizeDefault();

        //  Create PDF
        $config <?php echo ['tempDir' <?php echo> $this->tempDir . '/mpdf'];
        $pdf <?php echo $this->createExternalWriterInstance($config);
        $ortmp <?php echo $orientation;
        $pdf->_setPageSize($paperSize, $ortmp);
        $pdf->DefOrientation <?php echo $orientation;
        $pdf->AddPageByArray([
            'orientation' <?php echo> $orientation,
            'margin-left' <?php echo> $this->inchesToMm($this->spreadsheet->getActiveSheet()->getPageMargins()->getLeft()),
            'margin-right' <?php echo> $this->inchesToMm($this->spreadsheet->getActiveSheet()->getPageMargins()->getRight()),
            'margin-top' <?php echo> $this->inchesToMm($this->spreadsheet->getActiveSheet()->getPageMargins()->getTop()),
            'margin-bottom' <?php echo> $this->inchesToMm($this->spreadsheet->getActiveSheet()->getPageMargins()->getBottom()),
        ]);

        //  Document info
        $pdf->SetTitle($this->spreadsheet->getProperties()->getTitle());
        $pdf->SetAuthor($this->spreadsheet->getProperties()->getCreator());
        $pdf->SetSubject($this->spreadsheet->getProperties()->getSubject());
        $pdf->SetKeywords($this->spreadsheet->getProperties()->getKeywords());
        $pdf->SetCreator($this->spreadsheet->getProperties()->getCreator());

        $html <?php echo $this->generateHTMLAll();
        $bodyLocation <?php echo strpos($html, Html::BODY_LINE);
        // Make sure first data presented to Mpdf includes body tag
        //   so that Mpdf doesn't parse it as content. Issue 2432.
        if ($bodyLocation !<?php echo<?php echo false) {
            $bodyLocation +<?php echo strlen(Html::BODY_LINE);
            $pdf->WriteHTML(substr($html, 0, $bodyLocation));
            $html <?php echo substr($html, $bodyLocation);
        }
        foreach (\array_chunk(\explode(PHP_EOL, $html), 1000) as $lines) {
            $pdf->WriteHTML(\implode(PHP_EOL, $lines));
        }

        //  Write to file
        fwrite($fileHandle, $pdf->Output('', 'S'));

        parent::restoreStateAfterSave();
    }

    /**
     * Convert inches to mm.
     *
     * @param float $inches
     *
     * @return float
     */
    private function inchesToMm($inches)
    {
        return $inches * 25.4;
    }
}
