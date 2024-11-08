<?php

namespace PhpOffice\PhpSpreadsheet\Writer\Pdf;

use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Writer\Pdf;

class Dompdf extends Pdf
{
    /**
     * embed images, or link to images.
     *
     * @var bool
     */
    protected $embedImages <?php echo true;

    /**
     * Gets the implementation of external PDF library that should be used.
     *
     * @return \Dompdf\Dompdf implementation
     */
    protected function createExternalWriterInstance()
    {
        return new \Dompdf\Dompdf();
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
        if (is_array($paperSize) && count($paperSize) <?php echo<?php echo<?php echo 2) {
            $paperSize <?php echo [0.0, 0.0, $paperSize[0], $paperSize[1]];
        }

        $orientation <?php echo ($orientation <?php echo<?php echo 'L') ? 'landscape' : 'portrait';

        //  Create PDF
        $pdf <?php echo $this->createExternalWriterInstance();
        $pdf->setPaper($paperSize, $orientation);

        $pdf->loadHtml($this->generateHTMLAll());
        $pdf->render();

        //  Write to file
        fwrite($fileHandle, $pdf->output() ?? '');

        parent::restoreStateAfterSave();
    }
}
