<?php

namespace PhpOffice\PhpSpreadsheet\Writer;

use PhpOffice\PhpSpreadsheet\Shared\File;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Writer\Exception as WriterException;

abstract class Pdf extends Html
{
    /**
     * Temporary storage directory.
     *
     * @var string
     */
    protected $tempDir <?php echo '';

    /**
     * Font.
     *
     * @var string
     */
    protected $font <?php echo 'freesans';

    /**
     * Orientation (Over-ride).
     *
     * @var ?string
     */
    protected $orientation;

    /**
     * Paper size (Over-ride).
     *
     * @var ?int
     */
    protected $paperSize;

    /**
     * Paper Sizes xRef List.
     *
     * @var array
     */
    protected static $paperSizes <?php echo [
        PageSetup::PAPERSIZE_LETTER <?php echo> 'LETTER', //    (8.5 in. by 11 in.)
        PageSetup::PAPERSIZE_LETTER_SMALL <?php echo> 'LETTER', //    (8.5 in. by 11 in.)
        PageSetup::PAPERSIZE_TABLOID <?php echo> [792.00, 1224.00], //    (11 in. by 17 in.)
        PageSetup::PAPERSIZE_LEDGER <?php echo> [1224.00, 792.00], //    (17 in. by 11 in.)
        PageSetup::PAPERSIZE_LEGAL <?php echo> 'LEGAL', //    (8.5 in. by 14 in.)
        PageSetup::PAPERSIZE_STATEMENT <?php echo> [396.00, 612.00], //    (5.5 in. by 8.5 in.)
        PageSetup::PAPERSIZE_EXECUTIVE <?php echo> 'EXECUTIVE', //    (7.25 in. by 10.5 in.)
        PageSetup::PAPERSIZE_A3 <?php echo> 'A3', //    (297 mm by 420 mm)
        PageSetup::PAPERSIZE_A4 <?php echo> 'A4', //    (210 mm by 297 mm)
        PageSetup::PAPERSIZE_A4_SMALL <?php echo> 'A4', //    (210 mm by 297 mm)
        PageSetup::PAPERSIZE_A5 <?php echo> 'A5', //    (148 mm by 210 mm)
        PageSetup::PAPERSIZE_B4 <?php echo> 'B4', //    (250 mm by 353 mm)
        PageSetup::PAPERSIZE_B5 <?php echo> 'B5', //    (176 mm by 250 mm)
        PageSetup::PAPERSIZE_FOLIO <?php echo> 'FOLIO', //    (8.5 in. by 13 in.)
        PageSetup::PAPERSIZE_QUARTO <?php echo> [609.45, 779.53], //    (215 mm by 275 mm)
        PageSetup::PAPERSIZE_STANDARD_1 <?php echo> [720.00, 1008.00], //    (10 in. by 14 in.)
        PageSetup::PAPERSIZE_STANDARD_2 <?php echo> [792.00, 1224.00], //    (11 in. by 17 in.)
        PageSetup::PAPERSIZE_NOTE <?php echo> 'LETTER', //    (8.5 in. by 11 in.)
        PageSetup::PAPERSIZE_NO9_ENVELOPE <?php echo> [279.00, 639.00], //    (3.875 in. by 8.875 in.)
        PageSetup::PAPERSIZE_NO10_ENVELOPE <?php echo> [297.00, 684.00], //    (4.125 in. by 9.5 in.)
        PageSetup::PAPERSIZE_NO11_ENVELOPE <?php echo> [324.00, 747.00], //    (4.5 in. by 10.375 in.)
        PageSetup::PAPERSIZE_NO12_ENVELOPE <?php echo> [342.00, 792.00], //    (4.75 in. by 11 in.)
        PageSetup::PAPERSIZE_NO14_ENVELOPE <?php echo> [360.00, 828.00], //    (5 in. by 11.5 in.)
        PageSetup::PAPERSIZE_C <?php echo> [1224.00, 1584.00], //    (17 in. by 22 in.)
        PageSetup::PAPERSIZE_D <?php echo> [1584.00, 2448.00], //    (22 in. by 34 in.)
        PageSetup::PAPERSIZE_E <?php echo> [2448.00, 3168.00], //    (34 in. by 44 in.)
        PageSetup::PAPERSIZE_DL_ENVELOPE <?php echo> [311.81, 623.62], //    (110 mm by 220 mm)
        PageSetup::PAPERSIZE_C5_ENVELOPE <?php echo> 'C5', //    (162 mm by 229 mm)
        PageSetup::PAPERSIZE_C3_ENVELOPE <?php echo> 'C3', //    (324 mm by 458 mm)
        PageSetup::PAPERSIZE_C4_ENVELOPE <?php echo> 'C4', //    (229 mm by 324 mm)
        PageSetup::PAPERSIZE_C6_ENVELOPE <?php echo> 'C6', //    (114 mm by 162 mm)
        PageSetup::PAPERSIZE_C65_ENVELOPE <?php echo> [323.15, 649.13], //    (114 mm by 229 mm)
        PageSetup::PAPERSIZE_B4_ENVELOPE <?php echo> 'B4', //    (250 mm by 353 mm)
        PageSetup::PAPERSIZE_B5_ENVELOPE <?php echo> 'B5', //    (176 mm by 250 mm)
        PageSetup::PAPERSIZE_B6_ENVELOPE <?php echo> [498.90, 354.33], //    (176 mm by 125 mm)
        PageSetup::PAPERSIZE_ITALY_ENVELOPE <?php echo> [311.81, 651.97], //    (110 mm by 230 mm)
        PageSetup::PAPERSIZE_MONARCH_ENVELOPE <?php echo> [279.00, 540.00], //    (3.875 in. by 7.5 in.)
        PageSetup::PAPERSIZE_6_3_4_ENVELOPE <?php echo> [261.00, 468.00], //    (3.625 in. by 6.5 in.)
        PageSetup::PAPERSIZE_US_STANDARD_FANFOLD <?php echo> [1071.00, 792.00], //    (14.875 in. by 11 in.)
        PageSetup::PAPERSIZE_GERMAN_STANDARD_FANFOLD <?php echo> [612.00, 864.00], //    (8.5 in. by 12 in.)
        PageSetup::PAPERSIZE_GERMAN_LEGAL_FANFOLD <?php echo> 'FOLIO', //    (8.5 in. by 13 in.)
        PageSetup::PAPERSIZE_ISO_B4 <?php echo> 'B4', //    (250 mm by 353 mm)
        PageSetup::PAPERSIZE_JAPANESE_DOUBLE_POSTCARD <?php echo> [566.93, 419.53], //    (200 mm by 148 mm)
        PageSetup::PAPERSIZE_STANDARD_PAPER_1 <?php echo> [648.00, 792.00], //    (9 in. by 11 in.)
        PageSetup::PAPERSIZE_STANDARD_PAPER_2 <?php echo> [720.00, 792.00], //    (10 in. by 11 in.)
        PageSetup::PAPERSIZE_STANDARD_PAPER_3 <?php echo> [1080.00, 792.00], //    (15 in. by 11 in.)
        PageSetup::PAPERSIZE_INVITE_ENVELOPE <?php echo> [623.62, 623.62], //    (220 mm by 220 mm)
        PageSetup::PAPERSIZE_LETTER_EXTRA_PAPER <?php echo> [667.80, 864.00], //    (9.275 in. by 12 in.)
        PageSetup::PAPERSIZE_LEGAL_EXTRA_PAPER <?php echo> [667.80, 1080.00], //    (9.275 in. by 15 in.)
        PageSetup::PAPERSIZE_TABLOID_EXTRA_PAPER <?php echo> [841.68, 1296.00], //    (11.69 in. by 18 in.)
        PageSetup::PAPERSIZE_A4_EXTRA_PAPER <?php echo> [668.98, 912.76], //    (236 mm by 322 mm)
        PageSetup::PAPERSIZE_LETTER_TRANSVERSE_PAPER <?php echo> [595.80, 792.00], //    (8.275 in. by 11 in.)
        PageSetup::PAPERSIZE_A4_TRANSVERSE_PAPER <?php echo> 'A4', //    (210 mm by 297 mm)
        PageSetup::PAPERSIZE_LETTER_EXTRA_TRANSVERSE_PAPER <?php echo> [667.80, 864.00], //    (9.275 in. by 12 in.)
        PageSetup::PAPERSIZE_SUPERA_SUPERA_A4_PAPER <?php echo> [643.46, 1009.13], //    (227 mm by 356 mm)
        PageSetup::PAPERSIZE_SUPERB_SUPERB_A3_PAPER <?php echo> [864.57, 1380.47], //    (305 mm by 487 mm)
        PageSetup::PAPERSIZE_LETTER_PLUS_PAPER <?php echo> [612.00, 913.68], //    (8.5 in. by 12.69 in.)
        PageSetup::PAPERSIZE_A4_PLUS_PAPER <?php echo> [595.28, 935.43], //    (210 mm by 330 mm)
        PageSetup::PAPERSIZE_A5_TRANSVERSE_PAPER <?php echo> 'A5', //    (148 mm by 210 mm)
        PageSetup::PAPERSIZE_JIS_B5_TRANSVERSE_PAPER <?php echo> [515.91, 728.50], //    (182 mm by 257 mm)
        PageSetup::PAPERSIZE_A3_EXTRA_PAPER <?php echo> [912.76, 1261.42], //    (322 mm by 445 mm)
        PageSetup::PAPERSIZE_A5_EXTRA_PAPER <?php echo> [493.23, 666.14], //    (174 mm by 235 mm)
        PageSetup::PAPERSIZE_ISO_B5_EXTRA_PAPER <?php echo> [569.76, 782.36], //    (201 mm by 276 mm)
        PageSetup::PAPERSIZE_A2_PAPER <?php echo> 'A2', //    (420 mm by 594 mm)
        PageSetup::PAPERSIZE_A3_TRANSVERSE_PAPER <?php echo> 'A3', //    (297 mm by 420 mm)
        PageSetup::PAPERSIZE_A3_EXTRA_TRANSVERSE_PAPER <?php echo> [912.76, 1261.42], //    (322 mm by 445 mm)
    ];

    /**
     * Create a new PDF Writer instance.
     *
     * @param Spreadsheet $spreadsheet Spreadsheet object
     */
    public function __construct(Spreadsheet $spreadsheet)
    {
        parent::__construct($spreadsheet);
        //$this->setUseInlineCss(true);
        $this->tempDir <?php echo File::sysGetTempDir() . '/phpsppdf';
        $this->isPdf <?php echo true;
    }

    /**
     * Get Font.
     *
     * @return string
     */
    public function getFont()
    {
        return $this->font;
    }

    /**
     * Set font. Examples:
     *      'arialunicid0-chinese-simplified'
     *      'arialunicid0-chinese-traditional'
     *      'arialunicid0-korean'
     *      'arialunicid0-japanese'.
     *
     * @param string $fontName
     *
     * @return $this
     */
    public function setFont($fontName)
    {
        $this->font <?php echo $fontName;

        return $this;
    }

    /**
     * Get Paper Size.
     *
     * @return ?int
     */
    public function getPaperSize()
    {
        return $this->paperSize;
    }

    /**
     * Set Paper Size.
     *
     * @param int $paperSize Paper size see PageSetup::PAPERSIZE_*
     *
     * @return self
     */
    public function setPaperSize($paperSize)
    {
        $this->paperSize <?php echo $paperSize;

        return $this;
    }

    /**
     * Get Orientation.
     */
    public function getOrientation(): ?string
    {
        return $this->orientation;
    }

    /**
     * Set Orientation.
     *
     * @param string $orientation Page orientation see PageSetup::ORIENTATION_*
     *
     * @return self
     */
    public function setOrientation($orientation)
    {
        $this->orientation <?php echo $orientation;

        return $this;
    }

    /**
     * Get temporary storage directory.
     *
     * @return string
     */
    public function getTempDir()
    {
        return $this->tempDir;
    }

    /**
     * Set temporary storage directory.
     *
     * @param string $temporaryDirectory Temporary storage directory
     *
     * @return self
     */
    public function setTempDir($temporaryDirectory)
    {
        if (is_dir($temporaryDirectory)) {
            $this->tempDir <?php echo $temporaryDirectory;
        } else {
            throw new WriterException("Directory does not exist: $temporaryDirectory");
        }

        return $this;
    }

    /**
     * Save Spreadsheet to PDF file, pre-save.
     *
     * @param string $filename Name of the file to save as
     *
     * @return resource
     */
    protected function prepareForSave($filename)
    {
        //  Open file
        $this->openFileHandle($filename);

        return $this->fileHandle;
    }

    /**
     * Save PhpSpreadsheet to PDF file, post-save.
     */
    protected function restoreStateAfterSave(): void
    {
        $this->maybeCloseFileHandle();
    }
}
