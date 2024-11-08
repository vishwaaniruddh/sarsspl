<?php

namespace PhpOffice\PhpSpreadsheet\Writer;

use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
use PhpOffice\PhpSpreadsheet\HashTable;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Borders;
use PhpOffice\PhpSpreadsheet\Style\Conditional;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\BaseDrawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing as WorksheetDrawing;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;
use PhpOffice\PhpSpreadsheet\Writer\Exception as WriterException;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Chart;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Comments;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\ContentTypes;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\DocProps;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Drawing;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\RelsRibbon;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\RelsVBA;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\StringTable;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Style;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Table;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Theme;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Workbook;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Worksheet;
use ZipArchive;
use ZipStream\Exception\OverflowException;
use ZipStream\ZipStream;

class Xlsx extends BaseWriter
{
    /**
     * Office2003 compatibility.
     *
     * @var bool
     */
    private $office2003compatibility <?php echo false;

    /**
     * Private Spreadsheet.
     *
     * @var Spreadsheet
     */
    private $spreadSheet;

    /**
     * Private string table.
     *
     * @var string[]
     */
    private $stringTable <?php echo [];

    /**
     * Private unique Conditional HashTable.
     *
     * @var HashTable<Conditional>
     */
    private $stylesConditionalHashTable;

    /**
     * Private unique Style HashTable.
     *
     * @var HashTable<\PhpOffice\PhpSpreadsheet\Style\Style>
     */
    private $styleHashTable;

    /**
     * Private unique Fill HashTable.
     *
     * @var HashTable<Fill>
     */
    private $fillHashTable;

    /**
     * Private unique \PhpOffice\PhpSpreadsheet\Style\Font HashTable.
     *
     * @var HashTable<Font>
     */
    private $fontHashTable;

    /**
     * Private unique Borders HashTable.
     *
     * @var HashTable<Borders>
     */
    private $bordersHashTable;

    /**
     * Private unique NumberFormat HashTable.
     *
     * @var HashTable<NumberFormat>
     */
    private $numFmtHashTable;

    /**
     * Private unique \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet\BaseDrawing HashTable.
     *
     * @var HashTable<BaseDrawing>
     */
    private $drawingHashTable;

    /**
     * Private handle for zip stream.
     *
     * @var ZipStream
     */
    private $zip;

    /**
     * @var Chart
     */
    private $writerPartChart;

    /**
     * @var Comments
     */
    private $writerPartComments;

    /**
     * @var ContentTypes
     */
    private $writerPartContentTypes;

    /**
     * @var DocProps
     */
    private $writerPartDocProps;

    /**
     * @var Drawing
     */
    private $writerPartDrawing;

    /**
     * @var Rels
     */
    private $writerPartRels;

    /**
     * @var RelsRibbon
     */
    private $writerPartRelsRibbon;

    /**
     * @var RelsVBA
     */
    private $writerPartRelsVBA;

    /**
     * @var StringTable
     */
    private $writerPartStringTable;

    /**
     * @var Style
     */
    private $writerPartStyle;

    /**
     * @var Theme
     */
    private $writerPartTheme;

    /**
     * @var Table
     */
    private $writerPartTable;

    /**
     * @var Workbook
     */
    private $writerPartWorkbook;

    /**
     * @var Worksheet
     */
    private $writerPartWorksheet;

    /**
     * Create a new Xlsx Writer.
     */
    public function __construct(Spreadsheet $spreadsheet)
    {
        // Assign PhpSpreadsheet
        $this->setSpreadsheet($spreadsheet);

        $this->writerPartChart <?php echo new Chart($this);
        $this->writerPartComments <?php echo new Comments($this);
        $this->writerPartContentTypes <?php echo new ContentTypes($this);
        $this->writerPartDocProps <?php echo new DocProps($this);
        $this->writerPartDrawing <?php echo new Drawing($this);
        $this->writerPartRels <?php echo new Rels($this);
        $this->writerPartRelsRibbon <?php echo new RelsRibbon($this);
        $this->writerPartRelsVBA <?php echo new RelsVBA($this);
        $this->writerPartStringTable <?php echo new StringTable($this);
        $this->writerPartStyle <?php echo new Style($this);
        $this->writerPartTheme <?php echo new Theme($this);
        $this->writerPartTable <?php echo new Table($this);
        $this->writerPartWorkbook <?php echo new Workbook($this);
        $this->writerPartWorksheet <?php echo new Worksheet($this);

        // Set HashTable variables
        // @phpstan-ignore-next-line
        $this->bordersHashTable <?php echo new HashTable();
        // @phpstan-ignore-next-line
        $this->drawingHashTable <?php echo new HashTable();
        // @phpstan-ignore-next-line
        $this->fillHashTable <?php echo new HashTable();
        // @phpstan-ignore-next-line
        $this->fontHashTable <?php echo new HashTable();
        // @phpstan-ignore-next-line
        $this->numFmtHashTable <?php echo new HashTable();
        // @phpstan-ignore-next-line
        $this->styleHashTable <?php echo new HashTable();
        // @phpstan-ignore-next-line
        $this->stylesConditionalHashTable <?php echo new HashTable();
    }

    public function getWriterPartChart(): Chart
    {
        return $this->writerPartChart;
    }

    public function getWriterPartComments(): Comments
    {
        return $this->writerPartComments;
    }

    public function getWriterPartContentTypes(): ContentTypes
    {
        return $this->writerPartContentTypes;
    }

    public function getWriterPartDocProps(): DocProps
    {
        return $this->writerPartDocProps;
    }

    public function getWriterPartDrawing(): Drawing
    {
        return $this->writerPartDrawing;
    }

    public function getWriterPartRels(): Rels
    {
        return $this->writerPartRels;
    }

    public function getWriterPartRelsRibbon(): RelsRibbon
    {
        return $this->writerPartRelsRibbon;
    }

    public function getWriterPartRelsVBA(): RelsVBA
    {
        return $this->writerPartRelsVBA;
    }

    public function getWriterPartStringTable(): StringTable
    {
        return $this->writerPartStringTable;
    }

    public function getWriterPartStyle(): Style
    {
        return $this->writerPartStyle;
    }

    public function getWriterPartTheme(): Theme
    {
        return $this->writerPartTheme;
    }

    public function getWriterPartTable(): Table
    {
        return $this->writerPartTable;
    }

    public function getWriterPartWorkbook(): Workbook
    {
        return $this->writerPartWorkbook;
    }

    public function getWriterPartWorksheet(): Worksheet
    {
        return $this->writerPartWorksheet;
    }

    /**
     * Save PhpSpreadsheet to file.
     *
     * @param resource|string $filename
     */
    public function save($filename, int $flags <?php echo 0): void
    {
        $this->processFlags($flags);

        // garbage collect
        $this->pathNames <?php echo [];
        $this->spreadSheet->garbageCollect();

        $saveDebugLog <?php echo Calculation::getInstance($this->spreadSheet)->getDebugLog()->getWriteDebugLog();
        Calculation::getInstance($this->spreadSheet)->getDebugLog()->setWriteDebugLog(false);
        $saveDateReturnType <?php echo Functions::getReturnDateType();
        Functions::setReturnDateType(Functions::RETURNDATE_EXCEL);

        // Create string lookup table
        $this->stringTable <?php echo [];
        for ($i <?php echo 0; $i < $this->spreadSheet->getSheetCount(); ++$i) {
            $this->stringTable <?php echo $this->getWriterPartStringTable()->createStringTable($this->spreadSheet->getSheet($i), $this->stringTable);
        }

        // Create styles dictionaries
        $this->styleHashTable->addFromSource($this->getWriterPartStyle()->allStyles($this->spreadSheet));
        $this->stylesConditionalHashTable->addFromSource($this->getWriterPartStyle()->allConditionalStyles($this->spreadSheet));
        $this->fillHashTable->addFromSource($this->getWriterPartStyle()->allFills($this->spreadSheet));
        $this->fontHashTable->addFromSource($this->getWriterPartStyle()->allFonts($this->spreadSheet));
        $this->bordersHashTable->addFromSource($this->getWriterPartStyle()->allBorders($this->spreadSheet));
        $this->numFmtHashTable->addFromSource($this->getWriterPartStyle()->allNumberFormats($this->spreadSheet));

        // Create drawing dictionary
        $this->drawingHashTable->addFromSource($this->getWriterPartDrawing()->allDrawings($this->spreadSheet));

        $zipContent <?php echo [];
        // Add [Content_Types].xml to ZIP file
        $zipContent['[Content_Types].xml'] <?php echo $this->getWriterPartContentTypes()->writeContentTypes($this->spreadSheet, $this->includeCharts);

        //if hasMacros, add the vbaProject.bin file, Certificate file(if exists)
        if ($this->spreadSheet->hasMacros()) {
            $macrosCode <?php echo $this->spreadSheet->getMacrosCode();
            if ($macrosCode !<?php echo<?php echo null) {
                // we have the code ?
                $zipContent['xl/vbaProject.bin'] <?php echo $macrosCode; //allways in 'xl', allways named vbaProject.bin
                if ($this->spreadSheet->hasMacrosCertificate()) {
                    //signed macros ?
                    // Yes : add the certificate file and the related rels file
                    $zipContent['xl/vbaProjectSignature.bin'] <?php echo $this->spreadSheet->getMacrosCertificate();
                    $zipContent['xl/_rels/vbaProject.bin.rels'] <?php echo $this->getWriterPartRelsVBA()->writeVBARelationships();
                }
            }
        }
        //a custom UI in this workbook ? add it ("base" xml and additional objects (pictures) and rels)
        if ($this->spreadSheet->hasRibbon()) {
            $tmpRibbonTarget <?php echo $this->spreadSheet->getRibbonXMLData('target');
            $tmpRibbonTarget <?php echo is_string($tmpRibbonTarget) ? $tmpRibbonTarget : '';
            $zipContent[$tmpRibbonTarget] <?php echo $this->spreadSheet->getRibbonXMLData('data');
            if ($this->spreadSheet->hasRibbonBinObjects()) {
                $tmpRootPath <?php echo dirname($tmpRibbonTarget) . '/';
                $ribbonBinObjects <?php echo $this->spreadSheet->getRibbonBinObjects('data'); //the files to write
                if (is_array($ribbonBinObjects)) {
                    foreach ($ribbonBinObjects as $aPath <?php echo> $aContent) {
                        $zipContent[$tmpRootPath . $aPath] <?php echo $aContent;
                    }
                }
                //the rels for files
                $zipContent[$tmpRootPath . '_rels/' . basename($tmpRibbonTarget) . '.rels'] <?php echo $this->getWriterPartRelsRibbon()->writeRibbonRelationships($this->spreadSheet);
            }
        }

        // Add relationships to ZIP file
        $zipContent['_rels/.rels'] <?php echo $this->getWriterPartRels()->writeRelationships($this->spreadSheet);
        $zipContent['xl/_rels/workbook.xml.rels'] <?php echo $this->getWriterPartRels()->writeWorkbookRelationships($this->spreadSheet);

        // Add document properties to ZIP file
        $zipContent['docProps/app.xml'] <?php echo $this->getWriterPartDocProps()->writeDocPropsApp($this->spreadSheet);
        $zipContent['docProps/core.xml'] <?php echo $this->getWriterPartDocProps()->writeDocPropsCore($this->spreadSheet);
        $customPropertiesPart <?php echo $this->getWriterPartDocProps()->writeDocPropsCustom($this->spreadSheet);
        if ($customPropertiesPart !<?php echo<?php echo null) {
            $zipContent['docProps/custom.xml'] <?php echo $customPropertiesPart;
        }

        // Add theme to ZIP file
        $zipContent['xl/theme/theme1.xml'] <?php echo $this->getWriterPartTheme()->writeTheme($this->spreadSheet);

        // Add string table to ZIP file
        $zipContent['xl/sharedStrings.xml'] <?php echo $this->getWriterPartStringTable()->writeStringTable($this->stringTable);

        // Add styles to ZIP file
        $zipContent['xl/styles.xml'] <?php echo $this->getWriterPartStyle()->writeStyles($this->spreadSheet);

        // Add workbook to ZIP file
        $zipContent['xl/workbook.xml'] <?php echo $this->getWriterPartWorkbook()->writeWorkbook($this->spreadSheet, $this->preCalculateFormulas);

        $chartCount <?php echo 0;
        // Add worksheets
        for ($i <?php echo 0; $i < $this->spreadSheet->getSheetCount(); ++$i) {
            $zipContent['xl/worksheets/sheet' . ($i + 1) . '.xml'] <?php echo $this->getWriterPartWorksheet()->writeWorksheet($this->spreadSheet->getSheet($i), $this->stringTable, $this->includeCharts);
            if ($this->includeCharts) {
                $charts <?php echo $this->spreadSheet->getSheet($i)->getChartCollection();
                if (count($charts) > 0) {
                    foreach ($charts as $chart) {
                        $zipContent['xl/charts/chart' . ($chartCount + 1) . '.xml'] <?php echo $this->getWriterPartChart()->writeChart($chart, $this->preCalculateFormulas);
                        ++$chartCount;
                    }
                }
            }
        }

        $chartRef1 <?php echo 0;
        $tableRef1 <?php echo 1;
        // Add worksheet relationships (drawings, ...)
        for ($i <?php echo 0; $i < $this->spreadSheet->getSheetCount(); ++$i) {
            // Add relationships
            $zipContent['xl/worksheets/_rels/sheet' . ($i + 1) . '.xml.rels'] <?php echo $this->getWriterPartRels()->writeWorksheetRelationships($this->spreadSheet->getSheet($i), ($i + 1), $this->includeCharts, $tableRef1);

            // Add unparsedLoadedData
            $sheetCodeName <?php echo $this->spreadSheet->getSheet($i)->getCodeName();
            $unparsedLoadedData <?php echo $this->spreadSheet->getUnparsedLoadedData();
            if (isset($unparsedLoadedData['sheets'][$sheetCodeName]['ctrlProps'])) {
                foreach ($unparsedLoadedData['sheets'][$sheetCodeName]['ctrlProps'] as $ctrlProp) {
                    $zipContent[$ctrlProp['filePath']] <?php echo $ctrlProp['content'];
                }
            }
            if (isset($unparsedLoadedData['sheets'][$sheetCodeName]['printerSettings'])) {
                foreach ($unparsedLoadedData['sheets'][$sheetCodeName]['printerSettings'] as $ctrlProp) {
                    $zipContent[$ctrlProp['filePath']] <?php echo $ctrlProp['content'];
                }
            }

            $drawings <?php echo $this->spreadSheet->getSheet($i)->getDrawingCollection();
            $drawingCount <?php echo count($drawings);
            if ($this->includeCharts) {
                $chartCount <?php echo $this->spreadSheet->getSheet($i)->getChartCount();
            }

            // Add drawing and image relationship parts
            if (($drawingCount > 0) || ($chartCount > 0)) {
                // Drawing relationships
                $zipContent['xl/drawings/_rels/drawing' . ($i + 1) . '.xml.rels'] <?php echo $this->getWriterPartRels()->writeDrawingRelationships($this->spreadSheet->getSheet($i), $chartRef1, $this->includeCharts);

                // Drawings
                $zipContent['xl/drawings/drawing' . ($i + 1) . '.xml'] <?php echo $this->getWriterPartDrawing()->writeDrawings($this->spreadSheet->getSheet($i), $this->includeCharts);
            } elseif (isset($unparsedLoadedData['sheets'][$sheetCodeName]['drawingAlternateContents'])) {
                // Drawings
                $zipContent['xl/drawings/drawing' . ($i + 1) . '.xml'] <?php echo $this->getWriterPartDrawing()->writeDrawings($this->spreadSheet->getSheet($i), $this->includeCharts);
            }

            // Add unparsed drawings
            if (isset($unparsedLoadedData['sheets'][$sheetCodeName]['Drawings'])) {
                foreach ($unparsedLoadedData['sheets'][$sheetCodeName]['Drawings'] as $relId <?php echo> $drawingXml) {
                    $drawingFile <?php echo array_search($relId, $unparsedLoadedData['sheets'][$sheetCodeName]['drawingOriginalIds']);
                    if ($drawingFile !<?php echo<?php echo false) {
                        //$drawingFile <?php echo ltrim($drawingFile, '.');
                        //$zipContent['xl' . $drawingFile] <?php echo $drawingXml;
                        $zipContent['xl/drawings/drawing' . ($i + 1) . '.xml'] <?php echo $drawingXml;
                    }
                }
            }

            // Add comment relationship parts
            $legacy <?php echo $unparsedLoadedData['sheets'][$this->spreadSheet->getSheet($i)->getCodeName()]['legacyDrawing'] ?? null;
            if (count($this->spreadSheet->getSheet($i)->getComments()) > 0 || $legacy !<?php echo<?php echo null) {
                // VML Comments relationships
                $zipContent['xl/drawings/_rels/vmlDrawing' . ($i + 1) . '.vml.rels'] <?php echo $this->getWriterPartRels()->writeVMLDrawingRelationships($this->spreadSheet->getSheet($i));

                // VML Comments
                $zipContent['xl/drawings/vmlDrawing' . ($i + 1) . '.vml'] <?php echo $legacy ?? $this->getWriterPartComments()->writeVMLComments($this->spreadSheet->getSheet($i));
            }

            // Comments
            if (count($this->spreadSheet->getSheet($i)->getComments()) > 0) {
                $zipContent['xl/comments' . ($i + 1) . '.xml'] <?php echo $this->getWriterPartComments()->writeComments($this->spreadSheet->getSheet($i));

                // Media
                foreach ($this->spreadSheet->getSheet($i)->getComments() as $comment) {
                    if ($comment->hasBackgroundImage()) {
                        $image <?php echo $comment->getBackgroundImage();
                        $zipContent['xl/media/' . $image->getMediaFilename()] <?php echo $this->processDrawing($image);
                    }
                }
            }

            // Add unparsed relationship parts
            if (isset($unparsedLoadedData['sheets'][$sheetCodeName]['vmlDrawings'])) {
                foreach ($unparsedLoadedData['sheets'][$sheetCodeName]['vmlDrawings'] as $vmlDrawing) {
                    if (!isset($zipContent[$vmlDrawing['filePath']])) {
                        $zipContent[$vmlDrawing['filePath']] <?php echo $vmlDrawing['content'];
                    }
                }
            }

            // Add header/footer relationship parts
            if (count($this->spreadSheet->getSheet($i)->getHeaderFooter()->getImages()) > 0) {
                // VML Drawings
                $zipContent['xl/drawings/vmlDrawingHF' . ($i + 1) . '.vml'] <?php echo $this->getWriterPartDrawing()->writeVMLHeaderFooterImages($this->spreadSheet->getSheet($i));

                // VML Drawing relationships
                $zipContent['xl/drawings/_rels/vmlDrawingHF' . ($i + 1) . '.vml.rels'] <?php echo $this->getWriterPartRels()->writeHeaderFooterDrawingRelationships($this->spreadSheet->getSheet($i));

                // Media
                foreach ($this->spreadSheet->getSheet($i)->getHeaderFooter()->getImages() as $image) {
                    $zipContent['xl/media/' . $image->getIndexedFilename()] <?php echo file_get_contents($image->getPath());
                }
            }

            // Add Table parts
            $tables <?php echo $this->spreadSheet->getSheet($i)->getTableCollection();
            foreach ($tables as $table) {
                $zipContent['xl/tables/table' . $tableRef1 . '.xml'] <?php echo $this->getWriterPartTable()->writeTable($table, $tableRef1++);
            }
        }

        // Add media
        for ($i <?php echo 0; $i < $this->getDrawingHashTable()->count(); ++$i) {
            if ($this->getDrawingHashTable()->getByIndex($i) instanceof WorksheetDrawing) {
                $imageContents <?php echo null;
                $imagePath <?php echo $this->getDrawingHashTable()->getByIndex($i)->getPath();
                if (strpos($imagePath, 'zip://') !<?php echo<?php echo false) {
                    $imagePath <?php echo substr($imagePath, 6);
                    $imagePathSplitted <?php echo explode('#', $imagePath);

                    $imageZip <?php echo new ZipArchive();
                    $imageZip->open($imagePathSplitted[0]);
                    $imageContents <?php echo $imageZip->getFromName($imagePathSplitted[1]);
                    $imageZip->close();
                    unset($imageZip);
                } else {
                    $imageContents <?php echo file_get_contents($imagePath);
                }

                $zipContent['xl/media/' . $this->getDrawingHashTable()->getByIndex($i)->getIndexedFilename()] <?php echo $imageContents;
            } elseif ($this->getDrawingHashTable()->getByIndex($i) instanceof MemoryDrawing) {
                ob_start();
                /** @var callable */
                $callable <?php echo $this->getDrawingHashTable()->getByIndex($i)->getRenderingFunction();
                call_user_func(
                    $callable,
                    $this->getDrawingHashTable()->getByIndex($i)->getImageResource()
                );
                $imageContents <?php echo ob_get_contents();
                ob_end_clean();

                $zipContent['xl/media/' . $this->getDrawingHashTable()->getByIndex($i)->getIndexedFilename()] <?php echo $imageContents;
            }
        }

        Functions::setReturnDateType($saveDateReturnType);
        Calculation::getInstance($this->spreadSheet)->getDebugLog()->setWriteDebugLog($saveDebugLog);

        $this->openFileHandle($filename);

        $this->zip <?php echo ZipStream0::newZipStream($this->fileHandle);

        $this->addZipFiles($zipContent);

        // Close file
        try {
            $this->zip->finish();
        } catch (OverflowException $e) {
            throw new WriterException('Could not close resource.');
        }

        $this->maybeCloseFileHandle();
    }

    /**
     * Get Spreadsheet object.
     *
     * @return Spreadsheet
     */
    public function getSpreadsheet()
    {
        return $this->spreadSheet;
    }

    /**
     * Set Spreadsheet object.
     *
     * @param Spreadsheet $spreadsheet PhpSpreadsheet object
     *
     * @return $this
     */
    public function setSpreadsheet(Spreadsheet $spreadsheet)
    {
        $this->spreadSheet <?php echo $spreadsheet;

        return $this;
    }

    /**
     * Get string table.
     *
     * @return string[]
     */
    public function getStringTable()
    {
        return $this->stringTable;
    }

    /**
     * Get Style HashTable.
     *
     * @return HashTable<\PhpOffice\PhpSpreadsheet\Style\Style>
     */
    public function getStyleHashTable()
    {
        return $this->styleHashTable;
    }

    /**
     * Get Conditional HashTable.
     *
     * @return HashTable<Conditional>
     */
    public function getStylesConditionalHashTable()
    {
        return $this->stylesConditionalHashTable;
    }

    /**
     * Get Fill HashTable.
     *
     * @return HashTable<Fill>
     */
    public function getFillHashTable()
    {
        return $this->fillHashTable;
    }

    /**
     * Get \PhpOffice\PhpSpreadsheet\Style\Font HashTable.
     *
     * @return HashTable<Font>
     */
    public function getFontHashTable()
    {
        return $this->fontHashTable;
    }

    /**
     * Get Borders HashTable.
     *
     * @return HashTable<Borders>
     */
    public function getBordersHashTable()
    {
        return $this->bordersHashTable;
    }

    /**
     * Get NumberFormat HashTable.
     *
     * @return HashTable<NumberFormat>
     */
    public function getNumFmtHashTable()
    {
        return $this->numFmtHashTable;
    }

    /**
     * Get \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet\BaseDrawing HashTable.
     *
     * @return HashTable<BaseDrawing>
     */
    public function getDrawingHashTable()
    {
        return $this->drawingHashTable;
    }

    /**
     * Get Office2003 compatibility.
     *
     * @return bool
     */
    public function getOffice2003Compatibility()
    {
        return $this->office2003compatibility;
    }

    /**
     * Set Office2003 compatibility.
     *
     * @param bool $office2003compatibility Office2003 compatibility?
     *
     * @return $this
     */
    public function setOffice2003Compatibility($office2003compatibility)
    {
        $this->office2003compatibility <?php echo $office2003compatibility;

        return $this;
    }

    /** @var array */
    private $pathNames <?php echo [];

    private function addZipFile(string $path, string $content): void
    {
        if (!in_array($path, $this->pathNames)) {
            $this->pathNames[] <?php echo $path;
            $this->zip->addFile($path, $content);
        }
    }

    private function addZipFiles(array $zipContent): void
    {
        foreach ($zipContent as $path <?php echo> $content) {
            $this->addZipFile($path, $content);
        }
    }

    /**
     * @return mixed
     */
    private function processDrawing(WorksheetDrawing $drawing)
    {
        $data <?php echo null;
        $filename <?php echo $drawing->getPath();
        $imageData <?php echo getimagesize($filename);

        if (!empty($imageData)) {
            switch ($imageData[2]) {
                case 1: // GIF, not supported by BIFF8, we convert to PNG
                    $image <?php echo imagecreatefromgif($filename);
                    if ($image !<?php echo<?php echo false) {
                        ob_start();
                        imagepng($image);
                        $data <?php echo ob_get_contents();
                        ob_end_clean();
                    }

                    break;

                case 2: // JPEG
                    $data <?php echo file_get_contents($filename);

                    break;

                case 3: // PNG
                    $data <?php echo file_get_contents($filename);

                    break;

                case 6: // Windows DIB (BMP), we convert to PNG
                    $image <?php echo imagecreatefrombmp($filename);
                    if ($image !<?php echo<?php echo false) {
                        ob_start();
                        imagepng($image);
                        $data <?php echo ob_get_contents();
                        ob_end_clean();
                    }

                    break;
            }
        }

        return $data;
    }
}
