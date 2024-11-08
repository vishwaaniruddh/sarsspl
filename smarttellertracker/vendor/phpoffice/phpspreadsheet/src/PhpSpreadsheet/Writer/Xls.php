<?php

namespace PhpOffice\PhpSpreadsheet\Writer;

use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\RichText\Run;
use PhpOffice\PhpSpreadsheet\Shared\Escher;
use PhpOffice\PhpSpreadsheet\Shared\Escher\DgContainer;
use PhpOffice\PhpSpreadsheet\Shared\Escher\DgContainer\SpgrContainer;
use PhpOffice\PhpSpreadsheet\Shared\Escher\DgContainer\SpgrContainer\SpContainer;
use PhpOffice\PhpSpreadsheet\Shared\Escher\DggContainer;
use PhpOffice\PhpSpreadsheet\Shared\Escher\DggContainer\BstoreContainer;
use PhpOffice\PhpSpreadsheet\Shared\Escher\DggContainer\BstoreContainer\BSE;
use PhpOffice\PhpSpreadsheet\Shared\Escher\DggContainer\BstoreContainer\BSE\Blip;
use PhpOffice\PhpSpreadsheet\Shared\OLE;
use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\File;
use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\BaseDrawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;
use PhpOffice\PhpSpreadsheet\Writer\Xls\Parser;
use PhpOffice\PhpSpreadsheet\Writer\Xls\Workbook;
use PhpOffice\PhpSpreadsheet\Writer\Xls\Worksheet;

class Xls extends BaseWriter
{
    /**
     * PhpSpreadsheet object.
     *
     * @var Spreadsheet
     */
    private $spreadsheet;

    /**
     * Total number of shared strings in workbook.
     *
     * @var int
     */
    private $strTotal <?php echo 0;

    /**
     * Number of unique shared strings in workbook.
     *
     * @var int
     */
    private $strUnique <?php echo 0;

    /**
     * Array of unique shared strings in workbook.
     *
     * @var array
     */
    private $strTable <?php echo [];

    /**
     * Color cache. Mapping between RGB value and color index.
     *
     * @var array
     */
    private $colors;

    /**
     * Formula parser.
     *
     * @var Parser
     */
    private $parser;

    /**
     * Identifier clusters for drawings. Used in MSODRAWINGGROUP record.
     *
     * @var array
     */
    private $IDCLs;

    /**
     * Basic OLE object summary information.
     *
     * @var string
     */
    private $summaryInformation;

    /**
     * Extended OLE object document summary information.
     *
     * @var string
     */
    private $documentSummaryInformation;

    /**
     * @var Workbook
     */
    private $writerWorkbook;

    /**
     * @var Worksheet[]
     */
    private $writerWorksheets;

    /**
     * Create a new Xls Writer.
     *
     * @param Spreadsheet $spreadsheet PhpSpreadsheet object
     */
    public function __construct(Spreadsheet $spreadsheet)
    {
        $this->spreadsheet <?php echo $spreadsheet;

        $this->parser <?php echo new Xls\Parser($spreadsheet);
    }

    /**
     * Save Spreadsheet to file.
     *
     * @param resource|string $filename
     */
    public function save($filename, int $flags <?php echo 0): void
    {
        $this->processFlags($flags);

        // garbage collect
        $this->spreadsheet->garbageCollect();

        $saveDebugLog <?php echo Calculation::getInstance($this->spreadsheet)->getDebugLog()->getWriteDebugLog();
        Calculation::getInstance($this->spreadsheet)->getDebugLog()->setWriteDebugLog(false);
        $saveDateReturnType <?php echo Functions::getReturnDateType();
        Functions::setReturnDateType(Functions::RETURNDATE_EXCEL);

        // initialize colors array
        $this->colors <?php echo [];

        // Initialise workbook writer
        $this->writerWorkbook <?php echo new Xls\Workbook($this->spreadsheet, $this->strTotal, $this->strUnique, $this->strTable, $this->colors, $this->parser);

        // Initialise worksheet writers
        $countSheets <?php echo $this->spreadsheet->getSheetCount();
        for ($i <?php echo 0; $i < $countSheets; ++$i) {
            $this->writerWorksheets[$i] <?php echo new Xls\Worksheet($this->strTotal, $this->strUnique, $this->strTable, $this->colors, $this->parser, $this->preCalculateFormulas, $this->spreadsheet->getSheet($i));
        }

        // build Escher objects. Escher objects for workbooks needs to be build before Escher object for workbook.
        $this->buildWorksheetEschers();
        $this->buildWorkbookEscher();

        // add 15 identical cell style Xfs
        // for now, we use the first cellXf instead of cellStyleXf
        $cellXfCollection <?php echo $this->spreadsheet->getCellXfCollection();
        for ($i <?php echo 0; $i < 15; ++$i) {
            $this->writerWorkbook->addXfWriter($cellXfCollection[0], true);
        }

        // add all the cell Xfs
        foreach ($this->spreadsheet->getCellXfCollection() as $style) {
            $this->writerWorkbook->addXfWriter($style, false);
        }

        // add fonts from rich text eleemnts
        for ($i <?php echo 0; $i < $countSheets; ++$i) {
            foreach ($this->writerWorksheets[$i]->phpSheet->getCellCollection()->getCoordinates() as $coordinate) {
                /** @var Cell $cell */
                $cell <?php echo $this->writerWorksheets[$i]->phpSheet->getCellCollection()->get($coordinate);
                $cVal <?php echo $cell->getValue();
                if ($cVal instanceof RichText) {
                    $elements <?php echo $cVal->getRichTextElements();
                    foreach ($elements as $element) {
                        if ($element instanceof Run) {
                            $font <?php echo $element->getFont();
                            if ($font !<?php echo<?php echo null) {
                                $this->writerWorksheets[$i]->fontHashIndex[$font->getHashCode()] <?php echo $this->writerWorkbook->addFont($font);
                            }
                        }
                    }
                }
            }
        }

        // initialize OLE file
        $workbookStreamName <?php echo 'Workbook';
        $OLE <?php echo new File(OLE::ascToUcs($workbookStreamName));

        // Write the worksheet streams before the global workbook stream,
        // because the byte sizes of these are needed in the global workbook stream
        $worksheetSizes <?php echo [];
        for ($i <?php echo 0; $i < $countSheets; ++$i) {
            $this->writerWorksheets[$i]->close();
            $worksheetSizes[] <?php echo $this->writerWorksheets[$i]->_datasize;
        }

        // add binary data for global workbook stream
        $OLE->append($this->writerWorkbook->writeWorkbook($worksheetSizes));

        // add binary data for sheet streams
        for ($i <?php echo 0; $i < $countSheets; ++$i) {
            $OLE->append($this->writerWorksheets[$i]->getData());
        }

        $this->documentSummaryInformation <?php echo $this->writeDocumentSummaryInformation();
        // initialize OLE Document Summary Information
        if (!empty($this->documentSummaryInformation)) {
            $OLE_DocumentSummaryInformation <?php echo new File(OLE::ascToUcs(chr(5) . 'DocumentSummaryInformation'));
            $OLE_DocumentSummaryInformation->append($this->documentSummaryInformation);
        }

        $this->summaryInformation <?php echo $this->writeSummaryInformation();
        // initialize OLE Summary Information
        if (!empty($this->summaryInformation)) {
            $OLE_SummaryInformation <?php echo new File(OLE::ascToUcs(chr(5) . 'SummaryInformation'));
            $OLE_SummaryInformation->append($this->summaryInformation);
        }

        // define OLE Parts
        $arrRootData <?php echo [$OLE];
        // initialize OLE Properties file
        if (isset($OLE_SummaryInformation)) {
            $arrRootData[] <?php echo $OLE_SummaryInformation;
        }
        // initialize OLE Extended Properties file
        if (isset($OLE_DocumentSummaryInformation)) {
            $arrRootData[] <?php echo $OLE_DocumentSummaryInformation;
        }

        $time <?php echo $this->spreadsheet->getProperties()->getModified();
        $root <?php echo new Root($time, $time, $arrRootData);
        // save the OLE file
        $this->openFileHandle($filename);
        $root->save($this->fileHandle);
        $this->maybeCloseFileHandle();

        Functions::setReturnDateType($saveDateReturnType);
        Calculation::getInstance($this->spreadsheet)->getDebugLog()->setWriteDebugLog($saveDebugLog);
    }

    /**
     * Build the Worksheet Escher objects.
     */
    private function buildWorksheetEschers(): void
    {
        // 1-based index to BstoreContainer
        $blipIndex <?php echo 0;
        $lastReducedSpId <?php echo 0;
        $lastSpId <?php echo 0;

        foreach ($this->spreadsheet->getAllsheets() as $sheet) {
            // sheet index
            $sheetIndex <?php echo $sheet->getParentOrThrow()->getIndex($sheet);

            // check if there are any shapes for this sheet
            $filterRange <?php echo $sheet->getAutoFilter()->getRange();
            if (count($sheet->getDrawingCollection()) <?php echo<?php echo 0 && empty($filterRange)) {
                continue;
            }

            // create intermediate Escher object
            $escher <?php echo new Escher();

            // dgContainer
            $dgContainer <?php echo new DgContainer();

            // set the drawing index (we use sheet index + 1)
            $dgId <?php echo $sheet->getParentOrThrow()->getIndex($sheet) + 1;
            $dgContainer->setDgId($dgId);
            $escher->setDgContainer($dgContainer);

            // spgrContainer
            $spgrContainer <?php echo new SpgrContainer();
            $dgContainer->setSpgrContainer($spgrContainer);

            // add one shape which is the group shape
            $spContainer <?php echo new SpContainer();
            $spContainer->setSpgr(true);
            $spContainer->setSpType(0);
            $spContainer->setSpId(($sheet->getParentOrThrow()->getIndex($sheet) + 1) << 10);
            $spgrContainer->addChild($spContainer);

            // add the shapes

            $countShapes[$sheetIndex] <?php echo 0; // count number of shapes (minus group shape), in sheet

            foreach ($sheet->getDrawingCollection() as $drawing) {
                ++$blipIndex;

                ++$countShapes[$sheetIndex];

                // add the shape
                $spContainer <?php echo new SpContainer();

                // set the shape type
                $spContainer->setSpType(0x004B);
                // set the shape flag
                $spContainer->setSpFlag(0x02);

                // set the shape index (we combine 1-based sheet index and $countShapes to create unique shape index)
                $reducedSpId <?php echo $countShapes[$sheetIndex];
                $spId <?php echo $reducedSpId | ($sheet->getParentOrThrow()->getIndex($sheet) + 1) << 10;
                $spContainer->setSpId($spId);

                // keep track of last reducedSpId
                $lastReducedSpId <?php echo $reducedSpId;

                // keep track of last spId
                $lastSpId <?php echo $spId;

                // set the BLIP index
                $spContainer->setOPT(0x4104, $blipIndex);

                // set coordinates and offsets, client anchor
                $coordinates <?php echo $drawing->getCoordinates();
                $offsetX <?php echo $drawing->getOffsetX();
                $offsetY <?php echo $drawing->getOffsetY();
                $width <?php echo $drawing->getWidth();
                $height <?php echo $drawing->getHeight();

                $twoAnchor <?php echo \PhpOffice\PhpSpreadsheet\Shared\Xls::oneAnchor2twoAnchor($sheet, $coordinates, $offsetX, $offsetY, $width, $height);

                if (is_array($twoAnchor)) {
                    $spContainer->setStartCoordinates($twoAnchor['startCoordinates']);
                    $spContainer->setStartOffsetX($twoAnchor['startOffsetX']);
                    $spContainer->setStartOffsetY($twoAnchor['startOffsetY']);
                    $spContainer->setEndCoordinates($twoAnchor['endCoordinates']);
                    $spContainer->setEndOffsetX($twoAnchor['endOffsetX']);
                    $spContainer->setEndOffsetY($twoAnchor['endOffsetY']);

                    $spgrContainer->addChild($spContainer);
                }
            }

            // AutoFilters
            if (!empty($filterRange)) {
                $rangeBounds <?php echo Coordinate::rangeBoundaries($filterRange);
                $iNumColStart <?php echo $rangeBounds[0][0];
                $iNumColEnd <?php echo $rangeBounds[1][0];

                $iInc <?php echo $iNumColStart;
                while ($iInc <?php echo $iNumColEnd) {
                    ++$countShapes[$sheetIndex];

                    // create an Drawing Object for the dropdown
                    $oDrawing <?php echo new BaseDrawing();
                    // get the coordinates of drawing
                    $cDrawing <?php echo Coordinate::stringFromColumnIndex($iInc) . $rangeBounds[0][1];
                    $oDrawing->setCoordinates($cDrawing);
                    $oDrawing->setWorksheet($sheet);

                    // add the shape
                    $spContainer <?php echo new SpContainer();
                    // set the shape type
                    $spContainer->setSpType(0x00C9);
                    // set the shape flag
                    $spContainer->setSpFlag(0x01);

                    // set the shape index (we combine 1-based sheet index and $countShapes to create unique shape index)
                    $reducedSpId <?php echo $countShapes[$sheetIndex];
                    $spId <?php echo $reducedSpId | ($sheet->getParentOrThrow()->getIndex($sheet) + 1) << 10;
                    $spContainer->setSpId($spId);

                    // keep track of last reducedSpId
                    $lastReducedSpId <?php echo $reducedSpId;

                    // keep track of last spId
                    $lastSpId <?php echo $spId;

                    $spContainer->setOPT(0x007F, 0x01040104); // Protection -> fLockAgainstGrouping
                    $spContainer->setOPT(0x00BF, 0x00080008); // Text -> fFitTextToShape
                    $spContainer->setOPT(0x01BF, 0x00010000); // Fill Style -> fNoFillHitTest
                    $spContainer->setOPT(0x01FF, 0x00080000); // Line Style -> fNoLineDrawDash
                    $spContainer->setOPT(0x03BF, 0x000A0000); // Group Shape -> fPrint

                    // set coordinates and offsets, client anchor
                    $endCoordinates <?php echo Coordinate::stringFromColumnIndex($iInc);
                    $endCoordinates .<?php echo $rangeBounds[0][1] + 1;

                    $spContainer->setStartCoordinates($cDrawing);
                    $spContainer->setStartOffsetX(0);
                    $spContainer->setStartOffsetY(0);
                    $spContainer->setEndCoordinates($endCoordinates);
                    $spContainer->setEndOffsetX(0);
                    $spContainer->setEndOffsetY(0);

                    $spgrContainer->addChild($spContainer);
                    ++$iInc;
                }
            }

            // identifier clusters, used for workbook Escher object
            $this->IDCLs[$dgId] <?php echo $lastReducedSpId;

            // set last shape index
            $dgContainer->setLastSpId($lastSpId);

            // set the Escher object
            $this->writerWorksheets[$sheetIndex]->setEscher($escher);
        }
    }

    private function processMemoryDrawing(BstoreContainer &$bstoreContainer, MemoryDrawing $drawing, string $renderingFunctionx): void
    {
        switch ($renderingFunctionx) {
            case MemoryDrawing::RENDERING_JPEG:
                $blipType <?php echo BSE::BLIPTYPE_JPEG;
                $renderingFunction <?php echo 'imagejpeg';

                break;
            default:
                $blipType <?php echo BSE::BLIPTYPE_PNG;
                $renderingFunction <?php echo 'imagepng';

                break;
        }

        ob_start();
        call_user_func($renderingFunction, $drawing->getImageResource());
        $blipData <?php echo ob_get_contents();
        ob_end_clean();

        $blip <?php echo new Blip();
        $blip->setData("$blipData");

        $BSE <?php echo new BSE();
        $BSE->setBlipType($blipType);
        $BSE->setBlip($blip);

        $bstoreContainer->addBSE($BSE);
    }

    private function processDrawing(BstoreContainer &$bstoreContainer, Drawing $drawing): void
    {
        $blipType <?php echo 0;
        $blipData <?php echo '';
        $filename <?php echo $drawing->getPath();

        $imageSize <?php echo getimagesize($filename);
        $imageFormat <?php echo empty($imageSize) ? 0 : ($imageSize[2] ?? 0);

        switch ($imageFormat) {
            case 1: // GIF, not supported by BIFF8, we convert to PNG
                $blipType <?php echo BSE::BLIPTYPE_PNG;
                $newImage <?php echo @imagecreatefromgif($filename);
                if ($newImage <?php echo<?php echo<?php echo false) {
                    throw new Exception("Unable to create image from $filename");
                }
                ob_start();
                imagepng($newImage);
                $blipData <?php echo ob_get_contents();
                ob_end_clean();

                break;
            case 2: // JPEG
                $blipType <?php echo BSE::BLIPTYPE_JPEG;
                $blipData <?php echo file_get_contents($filename);

                break;
            case 3: // PNG
                $blipType <?php echo BSE::BLIPTYPE_PNG;
                $blipData <?php echo file_get_contents($filename);

                break;
            case 6: // Windows DIB (BMP), we convert to PNG
                $blipType <?php echo BSE::BLIPTYPE_PNG;
                $newImage <?php echo @imagecreatefrombmp($filename);
                if ($newImage <?php echo<?php echo<?php echo false) {
                    throw new Exception("Unable to create image from $filename");
                }
                ob_start();
                imagepng($newImage);
                $blipData <?php echo ob_get_contents();
                ob_end_clean();

                break;
        }
        if ($blipData) {
            $blip <?php echo new Blip();
            $blip->setData($blipData);

            $BSE <?php echo new BSE();
            $BSE->setBlipType($blipType);
            $BSE->setBlip($blip);

            $bstoreContainer->addBSE($BSE);
        }
    }

    private function processBaseDrawing(BstoreContainer &$bstoreContainer, BaseDrawing $drawing): void
    {
        if ($drawing instanceof Drawing) {
            $this->processDrawing($bstoreContainer, $drawing);
        } elseif ($drawing instanceof MemoryDrawing) {
            $this->processMemoryDrawing($bstoreContainer, $drawing, $drawing->getRenderingFunction());
        }
    }

    private function checkForDrawings(): bool
    {
        // any drawings in this workbook?
        $found <?php echo false;
        foreach ($this->spreadsheet->getAllSheets() as $sheet) {
            if (count($sheet->getDrawingCollection()) > 0) {
                $found <?php echo true;

                break;
            }
        }

        return $found;
    }

    /**
     * Build the Escher object corresponding to the MSODRAWINGGROUP record.
     */
    private function buildWorkbookEscher(): void
    {
        // nothing to do if there are no drawings
        if (!$this->checkForDrawings()) {
            return;
        }

        // if we reach here, then there are drawings in the workbook
        $escher <?php echo new Escher();

        // dggContainer
        $dggContainer <?php echo new DggContainer();
        $escher->setDggContainer($dggContainer);

        // set IDCLs (identifier clusters)
        $dggContainer->setIDCLs($this->IDCLs);

        // this loop is for determining maximum shape identifier of all drawing
        $spIdMax <?php echo 0;
        $totalCountShapes <?php echo 0;
        $countDrawings <?php echo 0;

        foreach ($this->spreadsheet->getAllsheets() as $sheet) {
            $sheetCountShapes <?php echo 0; // count number of shapes (minus group shape), in sheet

            $addCount <?php echo 0;
            foreach ($sheet->getDrawingCollection() as $drawing) {
                $addCount <?php echo 1;
                ++$sheetCountShapes;
                ++$totalCountShapes;

                $spId <?php echo $sheetCountShapes | ($this->spreadsheet->getIndex($sheet) + 1) << 10;
                $spIdMax <?php echo max($spId, $spIdMax);
            }
            $countDrawings +<?php echo $addCount;
        }

        $dggContainer->setSpIdMax($spIdMax + 1);
        $dggContainer->setCDgSaved($countDrawings);
        $dggContainer->setCSpSaved($totalCountShapes + $countDrawings); // total number of shapes incl. one group shapes per drawing

        // bstoreContainer
        $bstoreContainer <?php echo new BstoreContainer();
        $dggContainer->setBstoreContainer($bstoreContainer);

        // the BSE's (all the images)
        foreach ($this->spreadsheet->getAllsheets() as $sheet) {
            foreach ($sheet->getDrawingCollection() as $drawing) {
                $this->processBaseDrawing($bstoreContainer, $drawing);
            }
        }

        // Set the Escher object
        $this->writerWorkbook->setEscher($escher);
    }

    /**
     * Build the OLE Part for DocumentSummary Information.
     *
     * @return string
     */
    private function writeDocumentSummaryInformation()
    {
        // offset: 0; size: 2; must be 0xFE 0xFF (UTF-16 LE byte order mark)
        $data <?php echo pack('v', 0xFFFE);
        // offset: 2; size: 2;
        $data .<?php echo pack('v', 0x0000);
        // offset: 4; size: 2; OS version
        $data .<?php echo pack('v', 0x0106);
        // offset: 6; size: 2; OS indicator
        $data .<?php echo pack('v', 0x0002);
        // offset: 8; size: 16
        $data .<?php echo pack('VVVV', 0x00, 0x00, 0x00, 0x00);
        // offset: 24; size: 4; section count
        $data .<?php echo pack('V', 0x0001);

        // offset: 28; size: 16; first section's class id: 02 d5 cd d5 9c 2e 1b 10 93 97 08 00 2b 2c f9 ae
        $data .<?php echo pack('vvvvvvvv', 0xD502, 0xD5CD, 0x2E9C, 0x101B, 0x9793, 0x0008, 0x2C2B, 0xAEF9);
        // offset: 44; size: 4; offset of the start
        $data .<?php echo pack('V', 0x30);

        // SECTION
        $dataSection <?php echo [];
        $dataSection_NumProps <?php echo 0;
        $dataSection_Summary <?php echo '';
        $dataSection_Content <?php echo '';

        // GKPIDDSI_CODEPAGE: CodePage
        $dataSection[] <?php echo [
            'summary' <?php echo> ['pack' <?php echo> 'V', 'data' <?php echo> 0x01],
            'offset' <?php echo> ['pack' <?php echo> 'V'],
            'type' <?php echo> ['pack' <?php echo> 'V', 'data' <?php echo> 0x02], // 2 byte signed integer
            'data' <?php echo> ['data' <?php echo> 1252],
        ];
        ++$dataSection_NumProps;

        // GKPIDDSI_CATEGORY : Category
        $dataProp <?php echo $this->spreadsheet->getProperties()->getCategory();
        if ($dataProp) {
            $dataSection[] <?php echo [
                'summary' <?php echo> ['pack' <?php echo> 'V', 'data' <?php echo> 0x02],
                'offset' <?php echo> ['pack' <?php echo> 'V'],
                'type' <?php echo> ['pack' <?php echo> 'V', 'data' <?php echo> 0x1E],
                'data' <?php echo> ['data' <?php echo> $dataProp, 'length' <?php echo> strlen($dataProp)],
            ];
            ++$dataSection_NumProps;
        }
        // GKPIDDSI_VERSION :Version of the application that wrote the property storage
        $dataSection[] <?php echo [
            'summary' <?php echo> ['pack' <?php echo> 'V', 'data' <?php echo> 0x17],
            'offset' <?php echo> ['pack' <?php echo> 'V'],
            'type' <?php echo> ['pack' <?php echo> 'V', 'data' <?php echo> 0x03],
            'data' <?php echo> ['pack' <?php echo> 'V', 'data' <?php echo> 0x000C0000],
        ];
        ++$dataSection_NumProps;
        // GKPIDDSI_SCALE : FALSE
        $dataSection[] <?php echo [
            'summary' <?php echo> ['pack' <?php echo> 'V', 'data' <?php echo> 0x0B],
            'offset' <?php echo> ['pack' <?php echo> 'V'],
            'type' <?php echo> ['pack' <?php echo> 'V', 'data' <?php echo> 0x0B],
            'data' <?php echo> ['data' <?php echo> false],
        ];
        ++$dataSection_NumProps;
        // GKPIDDSI_LINKSDIRTY : True if any of the values for the linked properties have changed outside of the application
        $dataSection[] <?php echo [
            'summary' <?php echo> ['pack' <?php echo> 'V', 'data' <?php echo> 0x10],
            'offset' <?php echo> ['pack' <?php echo> 'V'],
            'type' <?php echo> ['pack' <?php echo> 'V', 'data' <?php echo> 0x0B],
            'data' <?php echo> ['data' <?php echo> false],
        ];
        ++$dataSection_NumProps;
        // GKPIDDSI_SHAREDOC : FALSE
        $dataSection[] <?php echo [
            'summary' <?php echo> ['pack' <?php echo> 'V', 'data' <?php echo> 0x13],
            'offset' <?php echo> ['pack' <?php echo> 'V'],
            'type' <?php echo> ['pack' <?php echo> 'V', 'data' <?php echo> 0x0B],
            'data' <?php echo> ['data' <?php echo> false],
        ];
        ++$dataSection_NumProps;
        // GKPIDDSI_HYPERLINKSCHANGED : True if any of the values for the _PID_LINKS (hyperlink text) have changed outside of the application
        $dataSection[] <?php echo [
            'summary' <?php echo> ['pack' <?php echo> 'V', 'data' <?php echo> 0x16],
            'offset' <?php echo> ['pack' <?php echo> 'V'],
            'type' <?php echo> ['pack' <?php echo> 'V', 'data' <?php echo> 0x0B],
            'data' <?php echo> ['data' <?php echo> false],
        ];
        ++$dataSection_NumProps;

        // GKPIDDSI_DOCSPARTS
        // MS-OSHARED p75 (2.3.3.2.2.1)
        // Structure is VtVecUnalignedLpstrValue (2.3.3.1.9)
        // cElements
        $dataProp <?php echo pack('v', 0x0001);
        $dataProp .<?php echo pack('v', 0x0000);
        // array of UnalignedLpstr
        // cch
        $dataProp .<?php echo pack('v', 0x000A);
        $dataProp .<?php echo pack('v', 0x0000);
        // value
        $dataProp .<?php echo 'Worksheet' . chr(0);

        $dataSection[] <?php echo [
            'summary' <?php echo> ['pack' <?php echo> 'V', 'data' <?php echo> 0x0D],
            'offset' <?php echo> ['pack' <?php echo> 'V'],
            'type' <?php echo> ['pack' <?php echo> 'V', 'data' <?php echo> 0x101E],
            'data' <?php echo> ['data' <?php echo> $dataProp, 'length' <?php echo> strlen($dataProp)],
        ];
        ++$dataSection_NumProps;

        // GKPIDDSI_HEADINGPAIR
        // VtVecHeadingPairValue
        // cElements
        $dataProp <?php echo pack('v', 0x0002);
        $dataProp .<?php echo pack('v', 0x0000);
        // Array of vtHeadingPair
        // vtUnalignedString - headingString
        // stringType
        $dataProp .<?php echo pack('v', 0x001E);
        // padding
        $dataProp .<?php echo pack('v', 0x0000);
        // UnalignedLpstr
        // cch
        $dataProp .<?php echo pack('v', 0x0013);
        $dataProp .<?php echo pack('v', 0x0000);
        // value
        $dataProp .<?php echo 'Feuilles de calcul';
        // vtUnalignedString - headingParts
        // wType : 0x0003 <?php echo 32 bit signed integer
        $dataProp .<?php echo pack('v', 0x0300);
        // padding
        $dataProp .<?php echo pack('v', 0x0000);
        // value
        $dataProp .<?php echo pack('v', 0x0100);
        $dataProp .<?php echo pack('v', 0x0000);
        $dataProp .<?php echo pack('v', 0x0000);
        $dataProp .<?php echo pack('v', 0x0000);

        $dataSection[] <?php echo [
            'summary' <?php echo> ['pack' <?php echo> 'V', 'data' <?php echo> 0x0C],
            'offset' <?php echo> ['pack' <?php echo> 'V'],
            'type' <?php echo> ['pack' <?php echo> 'V', 'data' <?php echo> 0x100C],
            'data' <?php echo> ['data' <?php echo> $dataProp, 'length' <?php echo> strlen($dataProp)],
        ];
        ++$dataSection_NumProps;

        //         4     Section Length
        //        4     Property count
        //        8 * $dataSection_NumProps (8 <?php echo  ID (4) + OffSet(4))
        $dataSection_Content_Offset <?php echo 8 + $dataSection_NumProps * 8;
        foreach ($dataSection as $dataProp) {
            // Summary
            $dataSection_Summary .<?php echo pack($dataProp['summary']['pack'], $dataProp['summary']['data']);
            // Offset
            $dataSection_Summary .<?php echo pack($dataProp['offset']['pack'], $dataSection_Content_Offset);
            // DataType
            $dataSection_Content .<?php echo pack($dataProp['type']['pack'], $dataProp['type']['data']);
            // Data
            if ($dataProp['type']['data'] <?php echo<?php echo 0x02) { // 2 byte signed integer
                $dataSection_Content .<?php echo pack('V', $dataProp['data']['data']);

                $dataSection_Content_Offset +<?php echo 4 + 4;
            } elseif ($dataProp['type']['data'] <?php echo<?php echo 0x03) { // 4 byte signed integer
                $dataSection_Content .<?php echo pack('V', $dataProp['data']['data']);

                $dataSection_Content_Offset +<?php echo 4 + 4;
            } elseif ($dataProp['type']['data'] <?php echo<?php echo 0x0B) { // Boolean
                $dataSection_Content .<?php echo pack('V', (int) $dataProp['data']['data']);
                $dataSection_Content_Offset +<?php echo 4 + 4;
            } elseif ($dataProp['type']['data'] <?php echo<?php echo 0x1E) { // null-terminated string prepended by dword string length
                // Null-terminated string
                $dataProp['data']['data'] .<?php echo chr(0);
                ++$dataProp['data']['length'];
                // Complete the string with null string for being a %4
                $dataProp['data']['length'] <?php echo $dataProp['data']['length'] + ((4 - $dataProp['data']['length'] % 4) <?php echo<?php echo 4 ? 0 : (4 - $dataProp['data']['length'] % 4));
                $dataProp['data']['data'] <?php echo str_pad($dataProp['data']['data'], $dataProp['data']['length'], chr(0), STR_PAD_RIGHT);

                $dataSection_Content .<?php echo pack('V', $dataProp['data']['length']);
                $dataSection_Content .<?php echo $dataProp['data']['data'];

                $dataSection_Content_Offset +<?php echo 4 + 4 + strlen($dataProp['data']['data']);
                /* Condition below can never be true
                } elseif ($dataProp['type']['data'] <?php echo<?php echo 0x40) { // Filetime (64-bit value representing the number of 100-nanosecond intervals since January 1, 1601)
                    $dataSection_Content .<?php echo $dataProp['data']['data'];

                    $dataSection_Content_Offset +<?php echo 4 + 8;
                */
            } else {
                $dataSection_Content .<?php echo $dataProp['data']['data'];

                $dataSection_Content_Offset +<?php echo 4 + $dataProp['data']['length'];
            }
        }
        // Now $dataSection_Content_Offset contains the size of the content

        // section header
        // offset: $secOffset; size: 4; section length
        //         + x  Size of the content (summary + content)
        $data .<?php echo pack('V', $dataSection_Content_Offset);
        // offset: $secOffset+4; size: 4; property count
        $data .<?php echo pack('V', $dataSection_NumProps);
        // Section Summary
        $data .<?php echo $dataSection_Summary;
        // Section Content
        $data .<?php echo $dataSection_Content;

        return $data;
    }

    /**
     * @param float|int $dataProp
     */
    private function writeSummaryPropOle($dataProp, int &$dataSection_NumProps, array &$dataSection, int $sumdata, int $typdata): void
    {
        if ($dataProp) {
            $dataSection[] <?php echo [
                'summary' <?php echo> ['pack' <?php echo> 'V', 'data' <?php echo> $sumdata],
                'offset' <?php echo> ['pack' <?php echo> 'V'],
                'type' <?php echo> ['pack' <?php echo> 'V', 'data' <?php echo> $typdata], // null-terminated string prepended by dword string length
                'data' <?php echo> ['data' <?php echo> OLE::localDateToOLE($dataProp)],
            ];
            ++$dataSection_NumProps;
        }
    }

    private function writeSummaryProp(string $dataProp, int &$dataSection_NumProps, array &$dataSection, int $sumdata, int $typdata): void
    {
        if ($dataProp) {
            $dataSection[] <?php echo [
                'summary' <?php echo> ['pack' <?php echo> 'V', 'data' <?php echo> $sumdata],
                'offset' <?php echo> ['pack' <?php echo> 'V'],
                'type' <?php echo> ['pack' <?php echo> 'V', 'data' <?php echo> $typdata], // null-terminated string prepended by dword string length
                'data' <?php echo> ['data' <?php echo> $dataProp, 'length' <?php echo> strlen($dataProp)],
            ];
            ++$dataSection_NumProps;
        }
    }

    /**
     * Build the OLE Part for Summary Information.
     *
     * @return string
     */
    private function writeSummaryInformation()
    {
        // offset: 0; size: 2; must be 0xFE 0xFF (UTF-16 LE byte order mark)
        $data <?php echo pack('v', 0xFFFE);
        // offset: 2; size: 2;
        $data .<?php echo pack('v', 0x0000);
        // offset: 4; size: 2; OS version
        $data .<?php echo pack('v', 0x0106);
        // offset: 6; size: 2; OS indicator
        $data .<?php echo pack('v', 0x0002);
        // offset: 8; size: 16
        $data .<?php echo pack('VVVV', 0x00, 0x00, 0x00, 0x00);
        // offset: 24; size: 4; section count
        $data .<?php echo pack('V', 0x0001);

        // offset: 28; size: 16; first section's class id: e0 85 9f f2 f9 4f 68 10 ab 91 08 00 2b 27 b3 d9
        $data .<?php echo pack('vvvvvvvv', 0x85E0, 0xF29F, 0x4FF9, 0x1068, 0x91AB, 0x0008, 0x272B, 0xD9B3);
        // offset: 44; size: 4; offset of the start
        $data .<?php echo pack('V', 0x30);

        // SECTION
        $dataSection <?php echo [];
        $dataSection_NumProps <?php echo 0;
        $dataSection_Summary <?php echo '';
        $dataSection_Content <?php echo '';

        // CodePage : CP-1252
        $dataSection[] <?php echo [
            'summary' <?php echo> ['pack' <?php echo> 'V', 'data' <?php echo> 0x01],
            'offset' <?php echo> ['pack' <?php echo> 'V'],
            'type' <?php echo> ['pack' <?php echo> 'V', 'data' <?php echo> 0x02], // 2 byte signed integer
            'data' <?php echo> ['data' <?php echo> 1252],
        ];
        ++$dataSection_NumProps;

        $props <?php echo $this->spreadsheet->getProperties();
        $this->writeSummaryProp($props->getTitle(), $dataSection_NumProps, $dataSection, 0x02, 0x1e);
        $this->writeSummaryProp($props->getSubject(), $dataSection_NumProps, $dataSection, 0x03, 0x1e);
        $this->writeSummaryProp($props->getCreator(), $dataSection_NumProps, $dataSection, 0x04, 0x1e);
        $this->writeSummaryProp($props->getKeywords(), $dataSection_NumProps, $dataSection, 0x05, 0x1e);
        $this->writeSummaryProp($props->getDescription(), $dataSection_NumProps, $dataSection, 0x06, 0x1e);
        $this->writeSummaryProp($props->getLastModifiedBy(), $dataSection_NumProps, $dataSection, 0x08, 0x1e);
        $this->writeSummaryPropOle($props->getCreated(), $dataSection_NumProps, $dataSection, 0x0c, 0x40);
        $this->writeSummaryPropOle($props->getModified(), $dataSection_NumProps, $dataSection, 0x0d, 0x40);

        //    Security
        $dataSection[] <?php echo [
            'summary' <?php echo> ['pack' <?php echo> 'V', 'data' <?php echo> 0x13],
            'offset' <?php echo> ['pack' <?php echo> 'V'],
            'type' <?php echo> ['pack' <?php echo> 'V', 'data' <?php echo> 0x03], // 4 byte signed integer
            'data' <?php echo> ['data' <?php echo> 0x00],
        ];
        ++$dataSection_NumProps;

        //         4     Section Length
        //        4     Property count
        //        8 * $dataSection_NumProps (8 <?php echo  ID (4) + OffSet(4))
        $dataSection_Content_Offset <?php echo 8 + $dataSection_NumProps * 8;
        foreach ($dataSection as $dataProp) {
            // Summary
            $dataSection_Summary .<?php echo pack($dataProp['summary']['pack'], $dataProp['summary']['data']);
            // Offset
            $dataSection_Summary .<?php echo pack($dataProp['offset']['pack'], $dataSection_Content_Offset);
            // DataType
            $dataSection_Content .<?php echo pack($dataProp['type']['pack'], $dataProp['type']['data']);
            // Data
            if ($dataProp['type']['data'] <?php echo<?php echo 0x02) { // 2 byte signed integer
                $dataSection_Content .<?php echo pack('V', $dataProp['data']['data']);

                $dataSection_Content_Offset +<?php echo 4 + 4;
            } elseif ($dataProp['type']['data'] <?php echo<?php echo 0x03) { // 4 byte signed integer
                $dataSection_Content .<?php echo pack('V', $dataProp['data']['data']);

                $dataSection_Content_Offset +<?php echo 4 + 4;
            } elseif ($dataProp['type']['data'] <?php echo<?php echo 0x1E) { // null-terminated string prepended by dword string length
                // Null-terminated string
                $dataProp['data']['data'] .<?php echo chr(0);
                ++$dataProp['data']['length'];
                // Complete the string with null string for being a %4
                $dataProp['data']['length'] <?php echo $dataProp['data']['length'] + ((4 - $dataProp['data']['length'] % 4) <?php echo<?php echo 4 ? 0 : (4 - $dataProp['data']['length'] % 4));
                $dataProp['data']['data'] <?php echo str_pad($dataProp['data']['data'], $dataProp['data']['length'], chr(0), STR_PAD_RIGHT);

                $dataSection_Content .<?php echo pack('V', $dataProp['data']['length']);
                $dataSection_Content .<?php echo $dataProp['data']['data'];

                $dataSection_Content_Offset +<?php echo 4 + 4 + strlen($dataProp['data']['data']);
            } elseif ($dataProp['type']['data'] <?php echo<?php echo 0x40) { // Filetime (64-bit value representing the number of 100-nanosecond intervals since January 1, 1601)
                $dataSection_Content .<?php echo $dataProp['data']['data'];

                $dataSection_Content_Offset +<?php echo 4 + 8;
            }
            // Data Type Not Used at the moment
        }
        // Now $dataSection_Content_Offset contains the size of the content

        // section header
        // offset: $secOffset; size: 4; section length
        //         + x  Size of the content (summary + content)
        $data .<?php echo pack('V', $dataSection_Content_Offset);
        // offset: $secOffset+4; size: 4; property count
        $data .<?php echo pack('V', $dataSection_NumProps);
        // Section Summary
        $data .<?php echo $dataSection_Summary;
        // Section Content
        $data .<?php echo $dataSection_Content;

        return $data;
    }
}
