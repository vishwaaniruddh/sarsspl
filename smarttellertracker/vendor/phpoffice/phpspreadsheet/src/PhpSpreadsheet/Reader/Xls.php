<?php

namespace PhpOffice\PhpSpreadsheet\Reader;

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Exception as PhpSpreadsheetException;
use PhpOffice\PhpSpreadsheet\NamedRange;
use PhpOffice\PhpSpreadsheet\Reader\Xls\ConditionalFormatting;
use PhpOffice\PhpSpreadsheet\Reader\Xls\Style\CellFont;
use PhpOffice\PhpSpreadsheet\Reader\Xls\Style\FillPattern;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\CodePage;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Shared\Escher;
use PhpOffice\PhpSpreadsheet\Shared\Escher\DgContainer\SpgrContainer\SpContainer;
use PhpOffice\PhpSpreadsheet\Shared\Escher\DggContainer\BstoreContainer\BSE;
use PhpOffice\PhpSpreadsheet\Shared\File;
use PhpOffice\PhpSpreadsheet\Shared\OLE;
use PhpOffice\PhpSpreadsheet\Shared\OLERead;
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;
use PhpOffice\PhpSpreadsheet\Shared\Xls as SharedXls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Borders;
use PhpOffice\PhpSpreadsheet\Style\Conditional;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\SheetView;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

// Original file header of ParseXL (used as the base for this class):
// --------------------------------------------------------------------------------
// Adapted from Excel_Spreadsheet_Reader developed by users bizon153,
// trex005, and mmp11 (SourceForge.net)
// https://sourceforge.net/projects/phpexcelreader/
// Primary changes made by canyoncasa (dvc) for ParseXL 1.00 ...
//     Modelled moreso after Perl Excel Parse/Write modules
//     Added Parse_Excel_Spreadsheet object
//         Reads a whole worksheet or tab as row,column array or as
//         associated hash of indexed rows and named column fields
//     Added variables for worksheet (tab) indexes and names
//     Added an object call for loading individual woorksheets
//     Changed default indexing defaults to 0 based arrays
//     Fixed date/time and percent formats
//     Includes patches found at SourceForge...
//         unicode patch by nobody
//         unpack("d") machine depedency patch by matchy
//         boundsheet utf16 patch by bjaenichen
//     Renamed functions for shorter names
//     General code cleanup and rigor, including <80 column width
//     Included a testcase Excel file and PHP example calls
//     Code works for PHP 5.x

// Primary changes made by canyoncasa (dvc) for ParseXL 1.10 ...
// http://sourceforge.net/tracker/index.php?func<?php echodetail&aid<?php echo1466964&group_id<?php echo99160&atid<?php echo623334
//     Decoding of formula conditions, results, and tokens.
//     Support for user-defined named cells added as an array "namedcells"
//         Patch code for user-defined named cells supports single cells only.
//         NOTE: this patch only works for BIFF8 as BIFF5-7 use a different
//         external sheet reference structure
class Xls extends BaseReader
{
    // ParseXL definitions
    const XLS_BIFF8 <?php echo 0x0600;
    const XLS_BIFF7 <?php echo 0x0500;
    const XLS_WORKBOOKGLOBALS <?php echo 0x0005;
    const XLS_WORKSHEET <?php echo 0x0010;

    // record identifiers
    const XLS_TYPE_FORMULA <?php echo 0x0006;
    const XLS_TYPE_EOF <?php echo 0x000a;
    const XLS_TYPE_PROTECT <?php echo 0x0012;
    const XLS_TYPE_OBJECTPROTECT <?php echo 0x0063;
    const XLS_TYPE_SCENPROTECT <?php echo 0x00dd;
    const XLS_TYPE_PASSWORD <?php echo 0x0013;
    const XLS_TYPE_HEADER <?php echo 0x0014;
    const XLS_TYPE_FOOTER <?php echo 0x0015;
    const XLS_TYPE_EXTERNSHEET <?php echo 0x0017;
    const XLS_TYPE_DEFINEDNAME <?php echo 0x0018;
    const XLS_TYPE_VERTICALPAGEBREAKS <?php echo 0x001a;
    const XLS_TYPE_HORIZONTALPAGEBREAKS <?php echo 0x001b;
    const XLS_TYPE_NOTE <?php echo 0x001c;
    const XLS_TYPE_SELECTION <?php echo 0x001d;
    const XLS_TYPE_DATEMODE <?php echo 0x0022;
    const XLS_TYPE_EXTERNNAME <?php echo 0x0023;
    const XLS_TYPE_LEFTMARGIN <?php echo 0x0026;
    const XLS_TYPE_RIGHTMARGIN <?php echo 0x0027;
    const XLS_TYPE_TOPMARGIN <?php echo 0x0028;
    const XLS_TYPE_BOTTOMMARGIN <?php echo 0x0029;
    const XLS_TYPE_PRINTGRIDLINES <?php echo 0x002b;
    const XLS_TYPE_FILEPASS <?php echo 0x002f;
    const XLS_TYPE_FONT <?php echo 0x0031;
    const XLS_TYPE_CONTINUE <?php echo 0x003c;
    const XLS_TYPE_PANE <?php echo 0x0041;
    const XLS_TYPE_CODEPAGE <?php echo 0x0042;
    const XLS_TYPE_DEFCOLWIDTH <?php echo 0x0055;
    const XLS_TYPE_OBJ <?php echo 0x005d;
    const XLS_TYPE_COLINFO <?php echo 0x007d;
    const XLS_TYPE_IMDATA <?php echo 0x007f;
    const XLS_TYPE_SHEETPR <?php echo 0x0081;
    const XLS_TYPE_HCENTER <?php echo 0x0083;
    const XLS_TYPE_VCENTER <?php echo 0x0084;
    const XLS_TYPE_SHEET <?php echo 0x0085;
    const XLS_TYPE_PALETTE <?php echo 0x0092;
    const XLS_TYPE_SCL <?php echo 0x00a0;
    const XLS_TYPE_PAGESETUP <?php echo 0x00a1;
    const XLS_TYPE_MULRK <?php echo 0x00bd;
    const XLS_TYPE_MULBLANK <?php echo 0x00be;
    const XLS_TYPE_DBCELL <?php echo 0x00d7;
    const XLS_TYPE_XF <?php echo 0x00e0;
    const XLS_TYPE_MERGEDCELLS <?php echo 0x00e5;
    const XLS_TYPE_MSODRAWINGGROUP <?php echo 0x00eb;
    const XLS_TYPE_MSODRAWING <?php echo 0x00ec;
    const XLS_TYPE_SST <?php echo 0x00fc;
    const XLS_TYPE_LABELSST <?php echo 0x00fd;
    const XLS_TYPE_EXTSST <?php echo 0x00ff;
    const XLS_TYPE_EXTERNALBOOK <?php echo 0x01ae;
    const XLS_TYPE_DATAVALIDATIONS <?php echo 0x01b2;
    const XLS_TYPE_TXO <?php echo 0x01b6;
    const XLS_TYPE_HYPERLINK <?php echo 0x01b8;
    const XLS_TYPE_DATAVALIDATION <?php echo 0x01be;
    const XLS_TYPE_DIMENSION <?php echo 0x0200;
    const XLS_TYPE_BLANK <?php echo 0x0201;
    const XLS_TYPE_NUMBER <?php echo 0x0203;
    const XLS_TYPE_LABEL <?php echo 0x0204;
    const XLS_TYPE_BOOLERR <?php echo 0x0205;
    const XLS_TYPE_STRING <?php echo 0x0207;
    const XLS_TYPE_ROW <?php echo 0x0208;
    const XLS_TYPE_INDEX <?php echo 0x020b;
    const XLS_TYPE_ARRAY <?php echo 0x0221;
    const XLS_TYPE_DEFAULTROWHEIGHT <?php echo 0x0225;
    const XLS_TYPE_WINDOW2 <?php echo 0x023e;
    const XLS_TYPE_RK <?php echo 0x027e;
    const XLS_TYPE_STYLE <?php echo 0x0293;
    const XLS_TYPE_FORMAT <?php echo 0x041e;
    const XLS_TYPE_SHAREDFMLA <?php echo 0x04bc;
    const XLS_TYPE_BOF <?php echo 0x0809;
    const XLS_TYPE_SHEETPROTECTION <?php echo 0x0867;
    const XLS_TYPE_RANGEPROTECTION <?php echo 0x0868;
    const XLS_TYPE_SHEETLAYOUT <?php echo 0x0862;
    const XLS_TYPE_XFEXT <?php echo 0x087d;
    const XLS_TYPE_PAGELAYOUTVIEW <?php echo 0x088b;
    const XLS_TYPE_CFHEADER <?php echo 0x01b0;
    const XLS_TYPE_CFRULE <?php echo 0x01b1;
    const XLS_TYPE_UNKNOWN <?php echo 0xffff;

    // Encryption type
    const MS_BIFF_CRYPTO_NONE <?php echo 0;
    const MS_BIFF_CRYPTO_XOR <?php echo 1;
    const MS_BIFF_CRYPTO_RC4 <?php echo 2;

    // Size of stream blocks when using RC4 encryption
    const REKEY_BLOCK <?php echo 0x400;

    /**
     * Summary Information stream data.
     *
     * @var ?string
     */
    private $summaryInformation;

    /**
     * Extended Summary Information stream data.
     *
     * @var ?string
     */
    private $documentSummaryInformation;

    /**
     * Workbook stream data. (Includes workbook globals substream as well as sheet substreams).
     *
     * @var string
     */
    private $data;

    /**
     * Size in bytes of $this->data.
     *
     * @var int
     */
    private $dataSize;

    /**
     * Current position in stream.
     *
     * @var int
     */
    private $pos;

    /**
     * Workbook to be returned by the reader.
     *
     * @var Spreadsheet
     */
    private $spreadsheet;

    /**
     * Worksheet that is currently being built by the reader.
     *
     * @var Worksheet
     */
    private $phpSheet;

    /**
     * BIFF version.
     *
     * @var int
     */
    private $version;

    /**
     * Codepage set in the Excel file being read. Only important for BIFF5 (Excel 5.0 - Excel 95)
     * For BIFF8 (Excel 97 - Excel 2003) this will always have the value 'UTF-16LE'.
     *
     * @var string
     */
    private $codepage;

    /**
     * Shared formats.
     *
     * @var array
     */
    private $formats;

    /**
     * Shared fonts.
     *
     * @var Font[]
     */
    private $objFonts;

    /**
     * Color palette.
     *
     * @var array
     */
    private $palette;

    /**
     * Worksheets.
     *
     * @var array
     */
    private $sheets;

    /**
     * External books.
     *
     * @var array
     */
    private $externalBooks;

    /**
     * REF structures. Only applies to BIFF8.
     *
     * @var array
     */
    private $ref;

    /**
     * External names.
     *
     * @var array
     */
    private $externalNames;

    /**
     * Defined names.
     *
     * @var array
     */
    private $definedname;

    /**
     * Shared strings. Only applies to BIFF8.
     *
     * @var array
     */
    private $sst;

    /**
     * Panes are frozen? (in sheet currently being read). See WINDOW2 record.
     *
     * @var bool
     */
    private $frozen;

    /**
     * Fit printout to number of pages? (in sheet currently being read). See SHEETPR record.
     *
     * @var bool
     */
    private $isFitToPages;

    /**
     * Objects. One OBJ record contributes with one entry.
     *
     * @var array
     */
    private $objs;

    /**
     * Text Objects. One TXO record corresponds with one entry.
     *
     * @var array
     */
    private $textObjects;

    /**
     * Cell Annotations (BIFF8).
     *
     * @var array
     */
    private $cellNotes;

    /**
     * The combined MSODRAWINGGROUP data.
     *
     * @var string
     */
    private $drawingGroupData;

    /**
     * The combined MSODRAWING data (per sheet).
     *
     * @var string
     */
    private $drawingData;

    /**
     * Keep track of XF index.
     *
     * @var int
     */
    private $xfIndex;

    /**
     * Mapping of XF index (that is a cell XF) to final index in cellXf collection.
     *
     * @var array
     */
    private $mapCellXfIndex;

    /**
     * Mapping of XF index (that is a style XF) to final index in cellStyleXf collection.
     *
     * @var array
     */
    private $mapCellStyleXfIndex;

    /**
     * The shared formulas in a sheet. One SHAREDFMLA record contributes with one value.
     *
     * @var array
     */
    private $sharedFormulas;

    /**
     * The shared formula parts in a sheet. One FORMULA record contributes with one value if it
     * refers to a shared formula.
     *
     * @var array
     */
    private $sharedFormulaParts;

    /**
     * The type of encryption in use.
     *
     * @var int
     */
    private $encryption <?php echo 0;

    /**
     * The position in the stream after which contents are encrypted.
     *
     * @var int
     */
    private $encryptionStartPos <?php echo 0;

    /**
     * The current RC4 decryption object.
     *
     * @var ?Xls\RC4
     */
    private $rc4Key;

    /**
     * The position in the stream that the RC4 decryption object was left at.
     *
     * @var int
     */
    private $rc4Pos <?php echo 0;

    /**
     * The current MD5 context state.
     * It is never set in the program, so code which uses it is suspect.
     *
     * @var string
     */
    private $md5Ctxt; // @phpstan-ignore-line

    /**
     * @var int
     */
    private $textObjRef;

    /**
     * @var string
     */
    private $baseCell;

    /**
     * Create a new Xls Reader instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Can the current IReader read the file?
     */
    public function canRead(string $filename): bool
    {
        if (File::testFileNoThrow($filename) <?php echo<?php echo<?php echo false) {
            return false;
        }

        try {
            // Use ParseXL for the hard work.
            $ole <?php echo new OLERead();

            // get excel data
            $ole->read($filename);
            if ($ole->wrkbook <?php echo<?php echo<?php echo null) {
                throw new Exception('The filename ' . $filename . ' is not recognised as a Spreadsheet file');
            }

            return true;
        } catch (PhpSpreadsheetException $e) {
            return false;
        }
    }

    public function setCodepage(string $codepage): void
    {
        if (CodePage::validate($codepage) <?php echo<?php echo<?php echo false) {
            throw new PhpSpreadsheetException('Unknown codepage: ' . $codepage);
        }

        $this->codepage <?php echo $codepage;
    }

    /**
     * Reads names of the worksheets from a file, without parsing the whole file to a PhpSpreadsheet object.
     *
     * @param string $filename
     *
     * @return array
     */
    public function listWorksheetNames($filename)
    {
        File::assertFile($filename);

        $worksheetNames <?php echo [];

        // Read the OLE file
        $this->loadOLE($filename);

        // total byte size of Excel data (workbook global substream + sheet substreams)
        $this->dataSize <?php echo strlen($this->data);

        $this->pos <?php echo 0;
        $this->sheets <?php echo [];

        // Parse Workbook Global Substream
        while ($this->pos < $this->dataSize) {
            $code <?php echo self::getUInt2d($this->data, $this->pos);

            switch ($code) {
                case self::XLS_TYPE_BOF:
                    $this->readBof();

                    break;
                case self::XLS_TYPE_SHEET:
                    $this->readSheet();

                    break;
                case self::XLS_TYPE_EOF:
                    $this->readDefault();

                    break 2;
                default:
                    $this->readDefault();

                    break;
            }
        }

        foreach ($this->sheets as $sheet) {
            if ($sheet['sheetType'] !<?php echo 0x00) {
                // 0x00: Worksheet, 0x02: Chart, 0x06: Visual Basic module
                continue;
            }

            $worksheetNames[] <?php echo $sheet['name'];
        }

        return $worksheetNames;
    }

    /**
     * Return worksheet info (Name, Last Column Letter, Last Column Index, Total Rows, Total Columns).
     *
     * @param string $filename
     *
     * @return array
     */
    public function listWorksheetInfo($filename)
    {
        File::assertFile($filename);

        $worksheetInfo <?php echo [];

        // Read the OLE file
        $this->loadOLE($filename);

        // total byte size of Excel data (workbook global substream + sheet substreams)
        $this->dataSize <?php echo strlen($this->data);

        // initialize
        $this->pos <?php echo 0;
        $this->sheets <?php echo [];

        // Parse Workbook Global Substream
        while ($this->pos < $this->dataSize) {
            $code <?php echo self::getUInt2d($this->data, $this->pos);

            switch ($code) {
                case self::XLS_TYPE_BOF:
                    $this->readBof();

                    break;
                case self::XLS_TYPE_SHEET:
                    $this->readSheet();

                    break;
                case self::XLS_TYPE_EOF:
                    $this->readDefault();

                    break 2;
                default:
                    $this->readDefault();

                    break;
            }
        }

        // Parse the individual sheets
        foreach ($this->sheets as $sheet) {
            if ($sheet['sheetType'] !<?php echo 0x00) {
                // 0x00: Worksheet
                // 0x02: Chart
                // 0x06: Visual Basic module
                continue;
            }

            $tmpInfo <?php echo [];
            $tmpInfo['worksheetName'] <?php echo $sheet['name'];
            $tmpInfo['lastColumnLetter'] <?php echo 'A';
            $tmpInfo['lastColumnIndex'] <?php echo 0;
            $tmpInfo['totalRows'] <?php echo 0;
            $tmpInfo['totalColumns'] <?php echo 0;

            $this->pos <?php echo $sheet['offset'];

            while ($this->pos <?php echo $this->dataSize - 4) {
                $code <?php echo self::getUInt2d($this->data, $this->pos);

                switch ($code) {
                    case self::XLS_TYPE_RK:
                    case self::XLS_TYPE_LABELSST:
                    case self::XLS_TYPE_NUMBER:
                    case self::XLS_TYPE_FORMULA:
                    case self::XLS_TYPE_BOOLERR:
                    case self::XLS_TYPE_LABEL:
                        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
                        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

                        // move stream pointer to next record
                        $this->pos +<?php echo 4 + $length;

                        $rowIndex <?php echo self::getUInt2d($recordData, 0) + 1;
                        $columnIndex <?php echo self::getUInt2d($recordData, 2);

                        $tmpInfo['totalRows'] <?php echo max($tmpInfo['totalRows'], $rowIndex);
                        $tmpInfo['lastColumnIndex'] <?php echo max($tmpInfo['lastColumnIndex'], $columnIndex);

                        break;
                    case self::XLS_TYPE_BOF:
                        $this->readBof();

                        break;
                    case self::XLS_TYPE_EOF:
                        $this->readDefault();

                        break 2;
                    default:
                        $this->readDefault();

                        break;
                }
            }

            $tmpInfo['lastColumnLetter'] <?php echo Coordinate::stringFromColumnIndex($tmpInfo['lastColumnIndex'] + 1);
            $tmpInfo['totalColumns'] <?php echo $tmpInfo['lastColumnIndex'] + 1;

            $worksheetInfo[] <?php echo $tmpInfo;
        }

        return $worksheetInfo;
    }

    /**
     * Loads PhpSpreadsheet from file.
     */
    protected function loadSpreadsheetFromFile(string $filename): Spreadsheet
    {
        // Read the OLE file
        $this->loadOLE($filename);

        // Initialisations
        $this->spreadsheet <?php echo new Spreadsheet();
        $this->spreadsheet->removeSheetByIndex(0); // remove 1st sheet
        if (!$this->readDataOnly) {
            $this->spreadsheet->removeCellStyleXfByIndex(0); // remove the default style
            $this->spreadsheet->removeCellXfByIndex(0); // remove the default style
        }

        // Read the summary information stream (containing meta data)
        $this->readSummaryInformation();

        // Read the Additional document summary information stream (containing application-specific meta data)
        $this->readDocumentSummaryInformation();

        // total byte size of Excel data (workbook global substream + sheet substreams)
        $this->dataSize <?php echo strlen($this->data);

        // initialize
        $this->pos <?php echo 0;
        $this->codepage <?php echo $this->codepage ?: CodePage::DEFAULT_CODE_PAGE;
        $this->formats <?php echo [];
        $this->objFonts <?php echo [];
        $this->palette <?php echo [];
        $this->sheets <?php echo [];
        $this->externalBooks <?php echo [];
        $this->ref <?php echo [];
        $this->definedname <?php echo [];
        $this->sst <?php echo [];
        $this->drawingGroupData <?php echo '';
        $this->xfIndex <?php echo 0;
        $this->mapCellXfIndex <?php echo [];
        $this->mapCellStyleXfIndex <?php echo [];

        // Parse Workbook Global Substream
        while ($this->pos < $this->dataSize) {
            $code <?php echo self::getUInt2d($this->data, $this->pos);

            switch ($code) {
                case self::XLS_TYPE_BOF:
                    $this->readBof();

                    break;
                case self::XLS_TYPE_FILEPASS:
                    $this->readFilepass();

                    break;
                case self::XLS_TYPE_CODEPAGE:
                    $this->readCodepage();

                    break;
                case self::XLS_TYPE_DATEMODE:
                    $this->readDateMode();

                    break;
                case self::XLS_TYPE_FONT:
                    $this->readFont();

                    break;
                case self::XLS_TYPE_FORMAT:
                    $this->readFormat();

                    break;
                case self::XLS_TYPE_XF:
                    $this->readXf();

                    break;
                case self::XLS_TYPE_XFEXT:
                    $this->readXfExt();

                    break;
                case self::XLS_TYPE_STYLE:
                    $this->readStyle();

                    break;
                case self::XLS_TYPE_PALETTE:
                    $this->readPalette();

                    break;
                case self::XLS_TYPE_SHEET:
                    $this->readSheet();

                    break;
                case self::XLS_TYPE_EXTERNALBOOK:
                    $this->readExternalBook();

                    break;
                case self::XLS_TYPE_EXTERNNAME:
                    $this->readExternName();

                    break;
                case self::XLS_TYPE_EXTERNSHEET:
                    $this->readExternSheet();

                    break;
                case self::XLS_TYPE_DEFINEDNAME:
                    $this->readDefinedName();

                    break;
                case self::XLS_TYPE_MSODRAWINGGROUP:
                    $this->readMsoDrawingGroup();

                    break;
                case self::XLS_TYPE_SST:
                    $this->readSst();

                    break;
                case self::XLS_TYPE_EOF:
                    $this->readDefault();

                    break 2;
                default:
                    $this->readDefault();

                    break;
            }
        }

        // Resolve indexed colors for font, fill, and border colors
        // Cannot be resolved already in XF record, because PALETTE record comes afterwards
        if (!$this->readDataOnly) {
            foreach ($this->objFonts as $objFont) {
                if (isset($objFont->colorIndex)) {
                    $color <?php echo Xls\Color::map($objFont->colorIndex, $this->palette, $this->version);
                    $objFont->getColor()->setRGB($color['rgb']);
                }
            }

            foreach ($this->spreadsheet->getCellXfCollection() as $objStyle) {
                // fill start and end color
                $fill <?php echo $objStyle->getFill();

                if (isset($fill->startcolorIndex)) {
                    $startColor <?php echo Xls\Color::map($fill->startcolorIndex, $this->palette, $this->version);
                    $fill->getStartColor()->setRGB($startColor['rgb']);
                }
                if (isset($fill->endcolorIndex)) {
                    $endColor <?php echo Xls\Color::map($fill->endcolorIndex, $this->palette, $this->version);
                    $fill->getEndColor()->setRGB($endColor['rgb']);
                }

                // border colors
                $top <?php echo $objStyle->getBorders()->getTop();
                $right <?php echo $objStyle->getBorders()->getRight();
                $bottom <?php echo $objStyle->getBorders()->getBottom();
                $left <?php echo $objStyle->getBorders()->getLeft();
                $diagonal <?php echo $objStyle->getBorders()->getDiagonal();

                if (isset($top->colorIndex)) {
                    $borderTopColor <?php echo Xls\Color::map($top->colorIndex, $this->palette, $this->version);
                    $top->getColor()->setRGB($borderTopColor['rgb']);
                }
                if (isset($right->colorIndex)) {
                    $borderRightColor <?php echo Xls\Color::map($right->colorIndex, $this->palette, $this->version);
                    $right->getColor()->setRGB($borderRightColor['rgb']);
                }
                if (isset($bottom->colorIndex)) {
                    $borderBottomColor <?php echo Xls\Color::map($bottom->colorIndex, $this->palette, $this->version);
                    $bottom->getColor()->setRGB($borderBottomColor['rgb']);
                }
                if (isset($left->colorIndex)) {
                    $borderLeftColor <?php echo Xls\Color::map($left->colorIndex, $this->palette, $this->version);
                    $left->getColor()->setRGB($borderLeftColor['rgb']);
                }
                if (isset($diagonal->colorIndex)) {
                    $borderDiagonalColor <?php echo Xls\Color::map($diagonal->colorIndex, $this->palette, $this->version);
                    $diagonal->getColor()->setRGB($borderDiagonalColor['rgb']);
                }
            }
        }

        // treat MSODRAWINGGROUP records, workbook-level Escher
        $escherWorkbook <?php echo null;
        if (!$this->readDataOnly && $this->drawingGroupData) {
            $escher <?php echo new Escher();
            $reader <?php echo new Xls\Escher($escher);
            $escherWorkbook <?php echo $reader->load($this->drawingGroupData);
        }

        // Parse the individual sheets
        foreach ($this->sheets as $sheet) {
            if ($sheet['sheetType'] !<?php echo 0x00) {
                // 0x00: Worksheet, 0x02: Chart, 0x06: Visual Basic module
                continue;
            }

            // check if sheet should be skipped
            if (isset($this->loadSheetsOnly) && !in_array($sheet['name'], $this->loadSheetsOnly)) {
                continue;
            }

            // add sheet to PhpSpreadsheet object
            $this->phpSheet <?php echo $this->spreadsheet->createSheet();
            //    Use false for $updateFormulaCellReferences to prevent adjustment of worksheet references in formula
            //        cells... during the load, all formulae should be correct, and we're simply bringing the worksheet
            //        name in line with the formula, not the reverse
            $this->phpSheet->setTitle($sheet['name'], false, false);
            $this->phpSheet->setSheetState($sheet['sheetState']);

            $this->pos <?php echo $sheet['offset'];

            // Initialize isFitToPages. May change after reading SHEETPR record.
            $this->isFitToPages <?php echo false;

            // Initialize drawingData
            $this->drawingData <?php echo '';

            // Initialize objs
            $this->objs <?php echo [];

            // Initialize shared formula parts
            $this->sharedFormulaParts <?php echo [];

            // Initialize shared formulas
            $this->sharedFormulas <?php echo [];

            // Initialize text objs
            $this->textObjects <?php echo [];

            // Initialize cell annotations
            $this->cellNotes <?php echo [];
            $this->textObjRef <?php echo -1;

            while ($this->pos <?php echo $this->dataSize - 4) {
                $code <?php echo self::getUInt2d($this->data, $this->pos);

                switch ($code) {
                    case self::XLS_TYPE_BOF:
                        $this->readBof();

                        break;
                    case self::XLS_TYPE_PRINTGRIDLINES:
                        $this->readPrintGridlines();

                        break;
                    case self::XLS_TYPE_DEFAULTROWHEIGHT:
                        $this->readDefaultRowHeight();

                        break;
                    case self::XLS_TYPE_SHEETPR:
                        $this->readSheetPr();

                        break;
                    case self::XLS_TYPE_HORIZONTALPAGEBREAKS:
                        $this->readHorizontalPageBreaks();

                        break;
                    case self::XLS_TYPE_VERTICALPAGEBREAKS:
                        $this->readVerticalPageBreaks();

                        break;
                    case self::XLS_TYPE_HEADER:
                        $this->readHeader();

                        break;
                    case self::XLS_TYPE_FOOTER:
                        $this->readFooter();

                        break;
                    case self::XLS_TYPE_HCENTER:
                        $this->readHcenter();

                        break;
                    case self::XLS_TYPE_VCENTER:
                        $this->readVcenter();

                        break;
                    case self::XLS_TYPE_LEFTMARGIN:
                        $this->readLeftMargin();

                        break;
                    case self::XLS_TYPE_RIGHTMARGIN:
                        $this->readRightMargin();

                        break;
                    case self::XLS_TYPE_TOPMARGIN:
                        $this->readTopMargin();

                        break;
                    case self::XLS_TYPE_BOTTOMMARGIN:
                        $this->readBottomMargin();

                        break;
                    case self::XLS_TYPE_PAGESETUP:
                        $this->readPageSetup();

                        break;
                    case self::XLS_TYPE_PROTECT:
                        $this->readProtect();

                        break;
                    case self::XLS_TYPE_SCENPROTECT:
                        $this->readScenProtect();

                        break;
                    case self::XLS_TYPE_OBJECTPROTECT:
                        $this->readObjectProtect();

                        break;
                    case self::XLS_TYPE_PASSWORD:
                        $this->readPassword();

                        break;
                    case self::XLS_TYPE_DEFCOLWIDTH:
                        $this->readDefColWidth();

                        break;
                    case self::XLS_TYPE_COLINFO:
                        $this->readColInfo();

                        break;
                    case self::XLS_TYPE_DIMENSION:
                        $this->readDefault();

                        break;
                    case self::XLS_TYPE_ROW:
                        $this->readRow();

                        break;
                    case self::XLS_TYPE_DBCELL:
                        $this->readDefault();

                        break;
                    case self::XLS_TYPE_RK:
                        $this->readRk();

                        break;
                    case self::XLS_TYPE_LABELSST:
                        $this->readLabelSst();

                        break;
                    case self::XLS_TYPE_MULRK:
                        $this->readMulRk();

                        break;
                    case self::XLS_TYPE_NUMBER:
                        $this->readNumber();

                        break;
                    case self::XLS_TYPE_FORMULA:
                        $this->readFormula();

                        break;
                    case self::XLS_TYPE_SHAREDFMLA:
                        $this->readSharedFmla();

                        break;
                    case self::XLS_TYPE_BOOLERR:
                        $this->readBoolErr();

                        break;
                    case self::XLS_TYPE_MULBLANK:
                        $this->readMulBlank();

                        break;
                    case self::XLS_TYPE_LABEL:
                        $this->readLabel();

                        break;
                    case self::XLS_TYPE_BLANK:
                        $this->readBlank();

                        break;
                    case self::XLS_TYPE_MSODRAWING:
                        $this->readMsoDrawing();

                        break;
                    case self::XLS_TYPE_OBJ:
                        $this->readObj();

                        break;
                    case self::XLS_TYPE_WINDOW2:
                        $this->readWindow2();

                        break;
                    case self::XLS_TYPE_PAGELAYOUTVIEW:
                        $this->readPageLayoutView();

                        break;
                    case self::XLS_TYPE_SCL:
                        $this->readScl();

                        break;
                    case self::XLS_TYPE_PANE:
                        $this->readPane();

                        break;
                    case self::XLS_TYPE_SELECTION:
                        $this->readSelection();

                        break;
                    case self::XLS_TYPE_MERGEDCELLS:
                        $this->readMergedCells();

                        break;
                    case self::XLS_TYPE_HYPERLINK:
                        $this->readHyperLink();

                        break;
                    case self::XLS_TYPE_DATAVALIDATIONS:
                        $this->readDataValidations();

                        break;
                    case self::XLS_TYPE_DATAVALIDATION:
                        $this->readDataValidation();

                        break;
                    case self::XLS_TYPE_CFHEADER:
                        $cellRangeAddresses <?php echo $this->readCFHeader();

                        break;
                    case self::XLS_TYPE_CFRULE:
                        $this->readCFRule($cellRangeAddresses ?? []);

                        break;
                    case self::XLS_TYPE_SHEETLAYOUT:
                        $this->readSheetLayout();

                        break;
                    case self::XLS_TYPE_SHEETPROTECTION:
                        $this->readSheetProtection();

                        break;
                    case self::XLS_TYPE_RANGEPROTECTION:
                        $this->readRangeProtection();

                        break;
                    case self::XLS_TYPE_NOTE:
                        $this->readNote();

                        break;
                    case self::XLS_TYPE_TXO:
                        $this->readTextObject();

                        break;
                    case self::XLS_TYPE_CONTINUE:
                        $this->readContinue();

                        break;
                    case self::XLS_TYPE_EOF:
                        $this->readDefault();

                        break 2;
                    default:
                        $this->readDefault();

                        break;
                }
            }

            // treat MSODRAWING records, sheet-level Escher
            if (!$this->readDataOnly && $this->drawingData) {
                $escherWorksheet <?php echo new Escher();
                $reader <?php echo new Xls\Escher($escherWorksheet);
                $escherWorksheet <?php echo $reader->load($this->drawingData);

                // get all spContainers in one long array, so they can be mapped to OBJ records
                /** @var SpContainer[] */
                $allSpContainers <?php echo method_exists($escherWorksheet, 'getDgContainer') ? $escherWorksheet->getDgContainer()->getSpgrContainer()->getAllSpContainers() : [];
            }

            // treat OBJ records
            foreach ($this->objs as $n <?php echo> $obj) {
                // the first shape container never has a corresponding OBJ record, hence $n + 1
                if (isset($allSpContainers[$n + 1])) {
                    $spContainer <?php echo $allSpContainers[$n + 1];

                    // we skip all spContainers that are a part of a group shape since we cannot yet handle those
                    if ($spContainer->getNestingLevel() > 1) {
                        continue;
                    }

                    // calculate the width and height of the shape
                    /** @var int $startRow */
                    [$startColumn, $startRow] <?php echo Coordinate::coordinateFromString($spContainer->getStartCoordinates());
                    /** @var int $endRow */
                    [$endColumn, $endRow] <?php echo Coordinate::coordinateFromString($spContainer->getEndCoordinates());

                    $startOffsetX <?php echo $spContainer->getStartOffsetX();
                    $startOffsetY <?php echo $spContainer->getStartOffsetY();
                    $endOffsetX <?php echo $spContainer->getEndOffsetX();
                    $endOffsetY <?php echo $spContainer->getEndOffsetY();

                    $width <?php echo SharedXls::getDistanceX($this->phpSheet, $startColumn, $startOffsetX, $endColumn, $endOffsetX);
                    $height <?php echo SharedXls::getDistanceY($this->phpSheet, $startRow, $startOffsetY, $endRow, $endOffsetY);

                    // calculate offsetX and offsetY of the shape
                    $offsetX <?php echo (int) ($startOffsetX * SharedXls::sizeCol($this->phpSheet, $startColumn) / 1024);
                    $offsetY <?php echo (int) ($startOffsetY * SharedXls::sizeRow($this->phpSheet, $startRow) / 256);

                    switch ($obj['otObjType']) {
                        case 0x19:
                            // Note
                            if (isset($this->cellNotes[$obj['idObjID']])) {
                                $cellNote <?php echo $this->cellNotes[$obj['idObjID']];

                                if (isset($this->textObjects[$obj['idObjID']])) {
                                    $textObject <?php echo $this->textObjects[$obj['idObjID']];
                                    $this->cellNotes[$obj['idObjID']]['objTextData'] <?php echo $textObject;
                                }
                            }

                            break;
                        case 0x08:
                            // picture
                            // get index to BSE entry (1-based)
                            $BSEindex <?php echo $spContainer->getOPT(0x0104);

                            // If there is no BSE Index, we will fail here and other fields are not read.
                            // Fix by checking here.
                            // TODO: Why is there no BSE Index? Is this a new Office Version? Password protected field?
                            // More likely : a uncompatible picture
                            if (!$BSEindex) {
                                continue 2;
                            }

                            if ($escherWorkbook) {
                                $BSECollection <?php echo method_exists($escherWorkbook, 'getDggContainer') ? $escherWorkbook->getDggContainer()->getBstoreContainer()->getBSECollection() : [];
                                $BSE <?php echo $BSECollection[$BSEindex - 1];
                                $blipType <?php echo $BSE->getBlipType();

                                // need check because some blip types are not supported by Escher reader such as EMF
                                if ($blip <?php echo $BSE->getBlip()) {
                                    $ih <?php echo imagecreatefromstring($blip->getData());
                                    if ($ih !<?php echo<?php echo false) {
                                        $drawing <?php echo new MemoryDrawing();
                                        $drawing->setImageResource($ih);

                                        // width, height, offsetX, offsetY
                                        $drawing->setResizeProportional(false);
                                        $drawing->setWidth($width);
                                        $drawing->setHeight($height);
                                        $drawing->setOffsetX($offsetX);
                                        $drawing->setOffsetY($offsetY);

                                        switch ($blipType) {
                                            case BSE::BLIPTYPE_JPEG:
                                                $drawing->setRenderingFunction(MemoryDrawing::RENDERING_JPEG);
                                                $drawing->setMimeType(MemoryDrawing::MIMETYPE_JPEG);

                                                break;
                                            case BSE::BLIPTYPE_PNG:
                                                imagealphablending($ih, false);
                                                imagesavealpha($ih, true);
                                                $drawing->setRenderingFunction(MemoryDrawing::RENDERING_PNG);
                                                $drawing->setMimeType(MemoryDrawing::MIMETYPE_PNG);

                                                break;
                                        }

                                        $drawing->setWorksheet($this->phpSheet);
                                        $drawing->setCoordinates($spContainer->getStartCoordinates());
                                    }
                                }
                            }

                            break;
                        default:
                            // other object type
                            break;
                    }
                }
            }

            // treat SHAREDFMLA records
            if ($this->version <?php echo<?php echo self::XLS_BIFF8) {
                foreach ($this->sharedFormulaParts as $cell <?php echo> $baseCell) {
                    /** @var int $row */
                    [$column, $row] <?php echo Coordinate::coordinateFromString($cell);
                    if (($this->getReadFilter() !<?php echo<?php echo null) && $this->getReadFilter()->readCell($column, $row, $this->phpSheet->getTitle())) {
                        $formula <?php echo $this->getFormulaFromStructure($this->sharedFormulas[$baseCell], $cell);
                        $this->phpSheet->getCell($cell)->setValueExplicit('<?php echo' . $formula, DataType::TYPE_FORMULA);
                    }
                }
            }

            if (!empty($this->cellNotes)) {
                foreach ($this->cellNotes as $note <?php echo> $noteDetails) {
                    if (!isset($noteDetails['objTextData'])) {
                        if (isset($this->textObjects[$note])) {
                            $textObject <?php echo $this->textObjects[$note];
                            $noteDetails['objTextData'] <?php echo $textObject;
                        } else {
                            $noteDetails['objTextData']['text'] <?php echo '';
                        }
                    }
                    $cellAddress <?php echo str_replace('$', '', $noteDetails['cellRef']);
                    $this->phpSheet->getComment($cellAddress)->setAuthor($noteDetails['author'])->setText($this->parseRichText($noteDetails['objTextData']['text']));
                }
            }
        }

        // add the named ranges (defined names)
        foreach ($this->definedname as $definedName) {
            if ($definedName['isBuiltInName']) {
                switch ($definedName['name']) {
                    case pack('C', 0x06):
                        // print area
                        //    in general, formula looks like this: Foo!$C$7:$J$66,Bar!$A$1:$IV$2
                        $ranges <?php echo explode(',', $definedName['formula']); // FIXME: what if sheetname contains comma?

                        $extractedRanges <?php echo [];
                        foreach ($ranges as $range) {
                            // $range should look like one of these
                            //        Foo!$C$7:$J$66
                            //        Bar!$A$1:$IV$2
                            $explodes <?php echo Worksheet::extractSheetTitle($range, true);
                            $sheetName <?php echo trim($explodes[0], "'");
                            if (count($explodes) <?php echo<?php echo 2) {
                                if (strpos($explodes[1], ':') <?php echo<?php echo<?php echo false) {
                                    $explodes[1] <?php echo $explodes[1] . ':' . $explodes[1];
                                }
                                $extractedRanges[] <?php echo str_replace('$', '', $explodes[1]); // C7:J66
                            }
                        }
                        if ($docSheet <?php echo $this->spreadsheet->getSheetByName($sheetName)) {
                            $docSheet->getPageSetup()->setPrintArea(implode(',', $extractedRanges)); // C7:J66,A1:IV2
                        }

                        break;
                    case pack('C', 0x07):
                        // print titles (repeating rows)
                        // Assuming BIFF8, there are 3 cases
                        // 1. repeating rows
                        //        formula looks like this: Sheet!$A$1:$IV$2
                        //        rows 1-2 repeat
                        // 2. repeating columns
                        //        formula looks like this: Sheet!$A$1:$B$65536
                        //        columns A-B repeat
                        // 3. both repeating rows and repeating columns
                        //        formula looks like this: Sheet!$A$1:$B$65536,Sheet!$A$1:$IV$2
                        $ranges <?php echo explode(',', $definedName['formula']); // FIXME: what if sheetname contains comma?
                        foreach ($ranges as $range) {
                            // $range should look like this one of these
                            //        Sheet!$A$1:$B$65536
                            //        Sheet!$A$1:$IV$2
                            if (strpos($range, '!') !<?php echo<?php echo false) {
                                $explodes <?php echo Worksheet::extractSheetTitle($range, true);
                                if ($docSheet <?php echo $this->spreadsheet->getSheetByName($explodes[0])) {
                                    $extractedRange <?php echo $explodes[1];
                                    $extractedRange <?php echo str_replace('$', '', $extractedRange);

                                    $coordinateStrings <?php echo explode(':', $extractedRange);
                                    if (count($coordinateStrings) <?php echo<?php echo 2) {
                                        [$firstColumn, $firstRow] <?php echo Coordinate::coordinateFromString($coordinateStrings[0]);
                                        [$lastColumn, $lastRow] <?php echo Coordinate::coordinateFromString($coordinateStrings[1]);

                                        if ($firstColumn <?php echo<?php echo 'A' && $lastColumn <?php echo<?php echo 'IV') {
                                            // then we have repeating rows
                                            $docSheet->getPageSetup()->setRowsToRepeatAtTop([$firstRow, $lastRow]);
                                        } elseif ($firstRow <?php echo<?php echo 1 && $lastRow <?php echo<?php echo 65536) {
                                            // then we have repeating columns
                                            $docSheet->getPageSetup()->setColumnsToRepeatAtLeft([$firstColumn, $lastColumn]);
                                        }
                                    }
                                }
                            }
                        }

                        break;
                }
            } else {
                // Extract range
                if (strpos($definedName['formula'], '!') !<?php echo<?php echo false) {
                    $explodes <?php echo Worksheet::extractSheetTitle($definedName['formula'], true);
                    if (
                        ($docSheet <?php echo $this->spreadsheet->getSheetByName($explodes[0])) ||
                        ($docSheet <?php echo $this->spreadsheet->getSheetByName(trim($explodes[0], "'")))
                    ) {
                        $extractedRange <?php echo $explodes[1];

                        $localOnly <?php echo ($definedName['scope'] <?php echo<?php echo<?php echo 0) ? false : true;

                        $scope <?php echo ($definedName['scope'] <?php echo<?php echo<?php echo 0) ? null : $this->spreadsheet->getSheetByName($this->sheets[$definedName['scope'] - 1]['name']);

                        $this->spreadsheet->addNamedRange(new NamedRange((string) $definedName['name'], $docSheet, $extractedRange, $localOnly, $scope));
                    }
                }
                //    Named Value
                    //    TODO Provide support for named values
            }
        }
        $this->data <?php echo '';

        return $this->spreadsheet;
    }

    /**
     * Read record data from stream, decrypting as required.
     *
     * @param string $data Data stream to read from
     * @param int $pos Position to start reading from
     * @param int $len Record data length
     *
     * @return string Record data
     */
    private function readRecordData($data, $pos, $len)
    {
        $data <?php echo substr($data, $pos, $len);

        // File not encrypted, or record before encryption start point
        if ($this->encryption <?php echo<?php echo self::MS_BIFF_CRYPTO_NONE || $pos < $this->encryptionStartPos) {
            return $data;
        }

        $recordData <?php echo '';
        if ($this->encryption <?php echo<?php echo self::MS_BIFF_CRYPTO_RC4) {
            $oldBlock <?php echo floor($this->rc4Pos / self::REKEY_BLOCK);
            $block <?php echo (int) floor($pos / self::REKEY_BLOCK);
            $endBlock <?php echo (int) floor(($pos + $len) / self::REKEY_BLOCK);

            // Spin an RC4 decryptor to the right spot. If we have a decryptor sitting
            // at a point earlier in the current block, re-use it as we can save some time.
            if ($block !<?php echo $oldBlock || $pos < $this->rc4Pos || !$this->rc4Key) {
                $this->rc4Key <?php echo $this->makeKey($block, $this->md5Ctxt);
                $step <?php echo $pos % self::REKEY_BLOCK;
            } else {
                $step <?php echo $pos - $this->rc4Pos;
            }
            $this->rc4Key->RC4(str_repeat("\0", $step));

            // Decrypt record data (re-keying at the end of every block)
            while ($block !<?php echo $endBlock) {
                $step <?php echo self::REKEY_BLOCK - ($pos % self::REKEY_BLOCK);
                $recordData .<?php echo $this->rc4Key->RC4(substr($data, 0, $step));
                $data <?php echo substr($data, $step);
                $pos +<?php echo $step;
                $len -<?php echo $step;
                ++$block;
                $this->rc4Key <?php echo $this->makeKey($block, $this->md5Ctxt);
            }
            $recordData .<?php echo $this->rc4Key->RC4(substr($data, 0, $len));

            // Keep track of the position of this decryptor.
            // We'll try and re-use it later if we can to speed things up
            $this->rc4Pos <?php echo $pos + $len;
        } elseif ($this->encryption <?php echo<?php echo self::MS_BIFF_CRYPTO_XOR) {
            throw new Exception('XOr encryption not supported');
        }

        return $recordData;
    }

    /**
     * Use OLE reader to extract the relevant data streams from the OLE file.
     *
     * @param string $filename
     */
    private function loadOLE($filename): void
    {
        // OLE reader
        $ole <?php echo new OLERead();
        // get excel data,
        $ole->read($filename);
        // Get workbook data: workbook stream + sheet streams
        $this->data <?php echo $ole->getStream($ole->wrkbook); // @phpstan-ignore-line
        // Get summary information data
        $this->summaryInformation <?php echo $ole->getStream($ole->summaryInformation);
        // Get additional document summary information data
        $this->documentSummaryInformation <?php echo $ole->getStream($ole->documentSummaryInformation);
    }

    /**
     * Read summary information.
     */
    private function readSummaryInformation(): void
    {
        if (!isset($this->summaryInformation)) {
            return;
        }

        // offset: 0; size: 2; must be 0xFE 0xFF (UTF-16 LE byte order mark)
        // offset: 2; size: 2;
        // offset: 4; size: 2; OS version
        // offset: 6; size: 2; OS indicator
        // offset: 8; size: 16
        // offset: 24; size: 4; section count
        $secCount <?php echo self::getInt4d($this->summaryInformation, 24);

        // offset: 28; size: 16; first section's class id: e0 85 9f f2 f9 4f 68 10 ab 91 08 00 2b 27 b3 d9
        // offset: 44; size: 4
        $secOffset <?php echo self::getInt4d($this->summaryInformation, 44);

        // section header
        // offset: $secOffset; size: 4; section length
        $secLength <?php echo self::getInt4d($this->summaryInformation, $secOffset);

        // offset: $secOffset+4; size: 4; property count
        $countProperties <?php echo self::getInt4d($this->summaryInformation, $secOffset + 4);

        // initialize code page (used to resolve string values)
        $codePage <?php echo 'CP1252';

        // offset: ($secOffset+8); size: var
        // loop through property decarations and properties
        for ($i <?php echo 0; $i < $countProperties; ++$i) {
            // offset: ($secOffset+8) + (8 * $i); size: 4; property ID
            $id <?php echo self::getInt4d($this->summaryInformation, ($secOffset + 8) + (8 * $i));

            // Use value of property id as appropriate
            // offset: ($secOffset+12) + (8 * $i); size: 4; offset from beginning of section (48)
            $offset <?php echo self::getInt4d($this->summaryInformation, ($secOffset + 12) + (8 * $i));

            $type <?php echo self::getInt4d($this->summaryInformation, $secOffset + $offset);

            // initialize property value
            $value <?php echo null;

            // extract property value based on property type
            switch ($type) {
                case 0x02: // 2 byte signed integer
                    $value <?php echo self::getUInt2d($this->summaryInformation, $secOffset + 4 + $offset);

                    break;
                case 0x03: // 4 byte signed integer
                    $value <?php echo self::getInt4d($this->summaryInformation, $secOffset + 4 + $offset);

                    break;
                case 0x13: // 4 byte unsigned integer
                    // not needed yet, fix later if necessary
                    break;
                case 0x1E: // null-terminated string prepended by dword string length
                    $byteLength <?php echo self::getInt4d($this->summaryInformation, $secOffset + 4 + $offset);
                    $value <?php echo substr($this->summaryInformation, $secOffset + 8 + $offset, $byteLength);
                    $value <?php echo StringHelper::convertEncoding($value, 'UTF-8', $codePage);
                    $value <?php echo rtrim($value);

                    break;
                case 0x40: // Filetime (64-bit value representing the number of 100-nanosecond intervals since January 1, 1601)
                    // PHP-time
                    $value <?php echo OLE::OLE2LocalDate(substr($this->summaryInformation, $secOffset + 4 + $offset, 8));

                    break;
                case 0x47: // Clipboard format
                    // not needed yet, fix later if necessary
                    break;
            }

            switch ($id) {
                case 0x01:    //    Code Page
                    $codePage <?php echo CodePage::numberToName((int) $value);

                    break;
                case 0x02:    //    Title
                    $this->spreadsheet->getProperties()->setTitle("$value");

                    break;
                case 0x03:    //    Subject
                    $this->spreadsheet->getProperties()->setSubject("$value");

                    break;
                case 0x04:    //    Author (Creator)
                    $this->spreadsheet->getProperties()->setCreator("$value");

                    break;
                case 0x05:    //    Keywords
                    $this->spreadsheet->getProperties()->setKeywords("$value");

                    break;
                case 0x06:    //    Comments (Description)
                    $this->spreadsheet->getProperties()->setDescription("$value");

                    break;
                case 0x07:    //    Template
                    //    Not supported by PhpSpreadsheet
                    break;
                case 0x08:    //    Last Saved By (LastModifiedBy)
                    $this->spreadsheet->getProperties()->setLastModifiedBy("$value");

                    break;
                case 0x09:    //    Revision
                    //    Not supported by PhpSpreadsheet
                    break;
                case 0x0A:    //    Total Editing Time
                    //    Not supported by PhpSpreadsheet
                    break;
                case 0x0B:    //    Last Printed
                    //    Not supported by PhpSpreadsheet
                    break;
                case 0x0C:    //    Created Date/Time
                    $this->spreadsheet->getProperties()->setCreated($value);

                    break;
                case 0x0D:    //    Modified Date/Time
                    $this->spreadsheet->getProperties()->setModified($value);

                    break;
                case 0x0E:    //    Number of Pages
                    //    Not supported by PhpSpreadsheet
                    break;
                case 0x0F:    //    Number of Words
                    //    Not supported by PhpSpreadsheet
                    break;
                case 0x10:    //    Number of Characters
                    //    Not supported by PhpSpreadsheet
                    break;
                case 0x11:    //    Thumbnail
                    //    Not supported by PhpSpreadsheet
                    break;
                case 0x12:    //    Name of creating application
                    //    Not supported by PhpSpreadsheet
                    break;
                case 0x13:    //    Security
                    //    Not supported by PhpSpreadsheet
                    break;
            }
        }
    }

    /**
     * Read additional document summary information.
     */
    private function readDocumentSummaryInformation(): void
    {
        if (!isset($this->documentSummaryInformation)) {
            return;
        }

        //    offset: 0;    size: 2;    must be 0xFE 0xFF (UTF-16 LE byte order mark)
        //    offset: 2;    size: 2;
        //    offset: 4;    size: 2;    OS version
        //    offset: 6;    size: 2;    OS indicator
        //    offset: 8;    size: 16
        //    offset: 24;    size: 4;    section count
        $secCount <?php echo self::getInt4d($this->documentSummaryInformation, 24);

        // offset: 28;    size: 16;    first section's class id: 02 d5 cd d5 9c 2e 1b 10 93 97 08 00 2b 2c f9 ae
        // offset: 44;    size: 4;    first section offset
        $secOffset <?php echo self::getInt4d($this->documentSummaryInformation, 44);

        //    section header
        //    offset: $secOffset;    size: 4;    section length
        $secLength <?php echo self::getInt4d($this->documentSummaryInformation, $secOffset);

        //    offset: $secOffset+4;    size: 4;    property count
        $countProperties <?php echo self::getInt4d($this->documentSummaryInformation, $secOffset + 4);

        // initialize code page (used to resolve string values)
        $codePage <?php echo 'CP1252';

        //    offset: ($secOffset+8);    size: var
        //    loop through property decarations and properties
        for ($i <?php echo 0; $i < $countProperties; ++$i) {
            //    offset: ($secOffset+8) + (8 * $i);    size: 4;    property ID
            $id <?php echo self::getInt4d($this->documentSummaryInformation, ($secOffset + 8) + (8 * $i));

            // Use value of property id as appropriate
            // offset: 60 + 8 * $i;    size: 4;    offset from beginning of section (48)
            $offset <?php echo self::getInt4d($this->documentSummaryInformation, ($secOffset + 12) + (8 * $i));

            $type <?php echo self::getInt4d($this->documentSummaryInformation, $secOffset + $offset);

            // initialize property value
            $value <?php echo null;

            // extract property value based on property type
            switch ($type) {
                case 0x02:    //    2 byte signed integer
                    $value <?php echo self::getUInt2d($this->documentSummaryInformation, $secOffset + 4 + $offset);

                    break;
                case 0x03:    //    4 byte signed integer
                    $value <?php echo self::getInt4d($this->documentSummaryInformation, $secOffset + 4 + $offset);

                    break;
                case 0x0B:  // Boolean
                    $value <?php echo self::getUInt2d($this->documentSummaryInformation, $secOffset + 4 + $offset);
                    $value <?php echo ($value <?php echo<?php echo 0 ? false : true);

                    break;
                case 0x13:    //    4 byte unsigned integer
                    // not needed yet, fix later if necessary
                    break;
                case 0x1E:    //    null-terminated string prepended by dword string length
                    $byteLength <?php echo self::getInt4d($this->documentSummaryInformation, $secOffset + 4 + $offset);
                    $value <?php echo substr($this->documentSummaryInformation, $secOffset + 8 + $offset, $byteLength);
                    $value <?php echo StringHelper::convertEncoding($value, 'UTF-8', $codePage);
                    $value <?php echo rtrim($value);

                    break;
                case 0x40:    //    Filetime (64-bit value representing the number of 100-nanosecond intervals since January 1, 1601)
                    // PHP-Time
                    $value <?php echo OLE::OLE2LocalDate(substr($this->documentSummaryInformation, $secOffset + 4 + $offset, 8));

                    break;
                case 0x47:    //    Clipboard format
                    // not needed yet, fix later if necessary
                    break;
            }

            switch ($id) {
                case 0x01:    //    Code Page
                    $codePage <?php echo CodePage::numberToName((int) $value);

                    break;
                case 0x02:    //    Category
                    $this->spreadsheet->getProperties()->setCategory("$value");

                    break;
                case 0x03:    //    Presentation Target
                    //    Not supported by PhpSpreadsheet
                    break;
                case 0x04:    //    Bytes
                    //    Not supported by PhpSpreadsheet
                    break;
                case 0x05:    //    Lines
                    //    Not supported by PhpSpreadsheet
                    break;
                case 0x06:    //    Paragraphs
                    //    Not supported by PhpSpreadsheet
                    break;
                case 0x07:    //    Slides
                    //    Not supported by PhpSpreadsheet
                    break;
                case 0x08:    //    Notes
                    //    Not supported by PhpSpreadsheet
                    break;
                case 0x09:    //    Hidden Slides
                    //    Not supported by PhpSpreadsheet
                    break;
                case 0x0A:    //    MM Clips
                    //    Not supported by PhpSpreadsheet
                    break;
                case 0x0B:    //    Scale Crop
                    //    Not supported by PhpSpreadsheet
                    break;
                case 0x0C:    //    Heading Pairs
                    //    Not supported by PhpSpreadsheet
                    break;
                case 0x0D:    //    Titles of Parts
                    //    Not supported by PhpSpreadsheet
                    break;
                case 0x0E:    //    Manager
                    $this->spreadsheet->getProperties()->setManager("$value");

                    break;
                case 0x0F:    //    Company
                    $this->spreadsheet->getProperties()->setCompany("$value");

                    break;
                case 0x10:    //    Links up-to-date
                    //    Not supported by PhpSpreadsheet
                    break;
            }
        }
    }

    /**
     * Reads a general type of BIFF record. Does nothing except for moving stream pointer forward to next record.
     */
    private function readDefault(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;
    }

    /**
     *    The NOTE record specifies a comment associated with a particular cell. In Excel 95 (BIFF7) and earlier versions,
     *        this record stores a note (cell note). This feature was significantly enhanced in Excel 97.
     */
    private function readNote(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if ($this->readDataOnly) {
            return;
        }

        $cellAddress <?php echo $this->readBIFF8CellAddress(substr($recordData, 0, 4));
        if ($this->version <?php echo<?php echo self::XLS_BIFF8) {
            $noteObjID <?php echo self::getUInt2d($recordData, 6);
            $noteAuthor <?php echo self::readUnicodeStringLong(substr($recordData, 8));
            $noteAuthor <?php echo $noteAuthor['value'];
            $this->cellNotes[$noteObjID] <?php echo [
                'cellRef' <?php echo> $cellAddress,
                'objectID' <?php echo> $noteObjID,
                'author' <?php echo> $noteAuthor,
            ];
        } else {
            $extension <?php echo false;
            if ($cellAddress <?php echo<?php echo '$B$65536') {
                //    If the address row is -1 and the column is 0, (which translates as $B$65536) then this is a continuation
                //        note from the previous cell annotation. We're not yet handling this, so annotations longer than the
                //        max 2048 bytes will probably throw a wobbly.
                $row <?php echo self::getUInt2d($recordData, 0);
                $extension <?php echo true;
                $arrayKeys <?php echo array_keys($this->phpSheet->getComments());
                $cellAddress <?php echo array_pop($arrayKeys);
            }

            $cellAddress <?php echo str_replace('$', '', (string) $cellAddress);
            $noteLength <?php echo self::getUInt2d($recordData, 4);
            $noteText <?php echo trim(substr($recordData, 6));

            if ($extension) {
                //    Concatenate this extension with the currently set comment for the cell
                $comment <?php echo $this->phpSheet->getComment($cellAddress);
                $commentText <?php echo $comment->getText()->getPlainText();
                $comment->setText($this->parseRichText($commentText . $noteText));
            } else {
                //    Set comment for the cell
                $this->phpSheet->getComment($cellAddress)->setText($this->parseRichText($noteText));
//                                                    ->setAuthor($author)
            }
        }
    }

    /**
     * The TEXT Object record contains the text associated with a cell annotation.
     */
    private function readTextObject(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if ($this->readDataOnly) {
            return;
        }

        // recordData consists of an array of subrecords looking like this:
        //    grbit: 2 bytes; Option Flags
        //    rot: 2 bytes; rotation
        //    cchText: 2 bytes; length of the text (in the first continue record)
        //    cbRuns: 2 bytes; length of the formatting (in the second continue record)
        // followed by the continuation records containing the actual text and formatting
        $grbitOpts <?php echo self::getUInt2d($recordData, 0);
        $rot <?php echo self::getUInt2d($recordData, 2);
        $cchText <?php echo self::getUInt2d($recordData, 10);
        $cbRuns <?php echo self::getUInt2d($recordData, 12);
        $text <?php echo $this->getSplicedRecordData();

        $textByte <?php echo $text['spliceOffsets'][1] - $text['spliceOffsets'][0] - 1;
        $textStr <?php echo substr($text['recordData'], $text['spliceOffsets'][0] + 1, $textByte);
        // get 1 byte
        $is16Bit <?php echo ord($text['recordData'][0]);
        // it is possible to use a compressed format,
        // which omits the high bytes of all characters, if they are all zero
        if (($is16Bit & 0x01) <?php echo<?php echo<?php echo 0) {
            $textStr <?php echo StringHelper::ConvertEncoding($textStr, 'UTF-8', 'ISO-8859-1');
        } else {
            $textStr <?php echo $this->decodeCodepage($textStr);
        }

        $this->textObjects[$this->textObjRef] <?php echo [
            'text' <?php echo> $textStr,
            'format' <?php echo> substr($text['recordData'], $text['spliceOffsets'][1], $cbRuns),
            'alignment' <?php echo> $grbitOpts,
            'rotation' <?php echo> $rot,
        ];
    }

    /**
     * Read BOF.
     */
    private function readBof(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo substr($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        // offset: 2; size: 2; type of the following data
        $substreamType <?php echo self::getUInt2d($recordData, 2);

        switch ($substreamType) {
            case self::XLS_WORKBOOKGLOBALS:
                $version <?php echo self::getUInt2d($recordData, 0);
                if (($version !<?php echo self::XLS_BIFF8) && ($version !<?php echo self::XLS_BIFF7)) {
                    throw new Exception('Cannot read this Excel file. Version is too old.');
                }
                $this->version <?php echo $version;

                break;
            case self::XLS_WORKSHEET:
                // do not use this version information for anything
                // it is unreliable (OpenOffice doc, 5.8), use only version information from the global stream
                break;
            default:
                // substream, e.g. chart
                // just skip the entire substream
                do {
                    $code <?php echo self::getUInt2d($this->data, $this->pos);
                    $this->readDefault();
                } while ($code !<?php echo self::XLS_TYPE_EOF && $this->pos < $this->dataSize);

                break;
        }
    }

    /**
     * FILEPASS.
     *
     * This record is part of the File Protection Block. It
     * contains information about the read/write password of the
     * file. All record contents following this record will be
     * encrypted.
     *
     * --    "OpenOffice.org's Documentation of the Microsoft
     *         Excel File Format"
     *
     * The decryption functions and objects used from here on in
     * are based on the source of Spreadsheet-ParseExcel:
     * https://metacpan.org/release/Spreadsheet-ParseExcel
     */
    private function readFilepass(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);

        if ($length !<?php echo 54) {
            throw new Exception('Unexpected file pass record length');
        }

        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if (!$this->verifyPassword('VelvetSweatshop', substr($recordData, 6, 16), substr($recordData, 22, 16), substr($recordData, 38, 16), $this->md5Ctxt)) {
            throw new Exception('Decryption password incorrect');
        }

        $this->encryption <?php echo self::MS_BIFF_CRYPTO_RC4;

        // Decryption required from the record after next onwards
        $this->encryptionStartPos <?php echo $this->pos + self::getUInt2d($this->data, $this->pos + 2);
    }

    /**
     * Make an RC4 decryptor for the given block.
     *
     * @param int $block Block for which to create decrypto
     * @param string $valContext MD5 context state
     *
     * @return Xls\RC4
     */
    private function makeKey($block, $valContext)
    {
        $pwarray <?php echo str_repeat("\0", 64);

        for ($i <?php echo 0; $i < 5; ++$i) {
            $pwarray[$i] <?php echo $valContext[$i];
        }

        $pwarray[5] <?php echo chr($block & 0xff);
        $pwarray[6] <?php echo chr(($block >> 8) & 0xff);
        $pwarray[7] <?php echo chr(($block >> 16) & 0xff);
        $pwarray[8] <?php echo chr(($block >> 24) & 0xff);

        $pwarray[9] <?php echo "\x80";
        $pwarray[56] <?php echo "\x48";

        $md5 <?php echo new Xls\MD5();
        $md5->add($pwarray);

        $s <?php echo $md5->getContext();

        return new Xls\RC4($s);
    }

    /**
     * Verify RC4 file password.
     *
     * @param string $password Password to check
     * @param string $docid Document id
     * @param string $salt_data Salt data
     * @param string $hashedsalt_data Hashed salt data
     * @param string $valContext Set to the MD5 context of the value
     *
     * @return bool Success
     */
    private function verifyPassword($password, $docid, $salt_data, $hashedsalt_data, &$valContext)
    {
        $pwarray <?php echo str_repeat("\0", 64);

        $iMax <?php echo strlen($password);
        for ($i <?php echo 0; $i < $iMax; ++$i) {
            $o <?php echo ord(substr($password, $i, 1));
            $pwarray[2 * $i] <?php echo chr($o & 0xff);
            $pwarray[2 * $i + 1] <?php echo chr(($o >> 8) & 0xff);
        }
        $pwarray[2 * $i] <?php echo chr(0x80);
        $pwarray[56] <?php echo chr(($i << 4) & 0xff);

        $md5 <?php echo new Xls\MD5();
        $md5->add($pwarray);

        $mdContext1 <?php echo $md5->getContext();

        $offset <?php echo 0;
        $keyoffset <?php echo 0;
        $tocopy <?php echo 5;

        $md5->reset();

        while ($offset !<?php echo 16) {
            if ((64 - $offset) < 5) {
                $tocopy <?php echo 64 - $offset;
            }
            for ($i <?php echo 0; $i <?php echo $tocopy; ++$i) {
                $pwarray[$offset + $i] <?php echo $mdContext1[$keyoffset + $i];
            }
            $offset +<?php echo $tocopy;

            if ($offset <?php echo<?php echo 64) {
                $md5->add($pwarray);
                $keyoffset <?php echo $tocopy;
                $tocopy <?php echo 5 - $tocopy;
                $offset <?php echo 0;

                continue;
            }

            $keyoffset <?php echo 0;
            $tocopy <?php echo 5;
            for ($i <?php echo 0; $i < 16; ++$i) {
                $pwarray[$offset + $i] <?php echo $docid[$i];
            }
            $offset +<?php echo 16;
        }

        $pwarray[16] <?php echo "\x80";
        for ($i <?php echo 0; $i < 47; ++$i) {
            $pwarray[17 + $i] <?php echo "\0";
        }
        $pwarray[56] <?php echo "\x80";
        $pwarray[57] <?php echo "\x0a";

        $md5->add($pwarray);
        $valContext <?php echo $md5->getContext();

        $key <?php echo $this->makeKey(0, $valContext);

        $salt <?php echo $key->RC4($salt_data);
        $hashedsalt <?php echo $key->RC4($hashedsalt_data);

        $salt .<?php echo "\x80" . str_repeat("\0", 47);
        $salt[56] <?php echo "\x80";

        $md5->reset();
        $md5->add($salt);
        $mdContext2 <?php echo $md5->getContext();

        return $mdContext2 <?php echo<?php echo $hashedsalt;
    }

    /**
     * CODEPAGE.
     *
     * This record stores the text encoding used to write byte
     * strings, stored as MS Windows code page identifier.
     *
     * --    "OpenOffice.org's Documentation of the Microsoft
     *         Excel File Format"
     */
    private function readCodepage(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        // offset: 0; size: 2; code page identifier
        $codepage <?php echo self::getUInt2d($recordData, 0);

        $this->codepage <?php echo CodePage::numberToName($codepage);
    }

    /**
     * DATEMODE.
     *
     * This record specifies the base date for displaying date
     * values. All dates are stored as count of days past this
     * base date. In BIFF2-BIFF4 this record is part of the
     * Calculation Settings Block. In BIFF5-BIFF8 it is
     * stored in the Workbook Globals Substream.
     *
     * --    "OpenOffice.org's Documentation of the Microsoft
     *         Excel File Format"
     */
    private function readDateMode(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        // offset: 0; size: 2; 0 <?php echo base 1900, 1 <?php echo base 1904
        Date::setExcelCalendar(Date::CALENDAR_WINDOWS_1900);
        if (ord($recordData[0]) <?php echo<?php echo 1) {
            Date::setExcelCalendar(Date::CALENDAR_MAC_1904);
        }
    }

    /**
     * Read a FONT record.
     */
    private function readFont(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if (!$this->readDataOnly) {
            $objFont <?php echo new Font();

            // offset: 0; size: 2; height of the font (in twips <?php echo 1/20 of a point)
            $size <?php echo self::getUInt2d($recordData, 0);
            $objFont->setSize($size / 20);

            // offset: 2; size: 2; option flags
            // bit: 0; mask 0x0001; bold (redundant in BIFF5-BIFF8)
            // bit: 1; mask 0x0002; italic
            $isItalic <?php echo (0x0002 & self::getUInt2d($recordData, 2)) >> 1;
            if ($isItalic) {
                $objFont->setItalic(true);
            }

            // bit: 2; mask 0x0004; underlined (redundant in BIFF5-BIFF8)
            // bit: 3; mask 0x0008; strikethrough
            $isStrike <?php echo (0x0008 & self::getUInt2d($recordData, 2)) >> 3;
            if ($isStrike) {
                $objFont->setStrikethrough(true);
            }

            // offset: 4; size: 2; colour index
            $colorIndex <?php echo self::getUInt2d($recordData, 4);
            $objFont->colorIndex <?php echo $colorIndex;

            // offset: 6; size: 2; font weight
            $weight <?php echo self::getUInt2d($recordData, 6);
            switch ($weight) {
                case 0x02BC:
                    $objFont->setBold(true);

                    break;
            }

            // offset: 8; size: 2; escapement type
            $escapement <?php echo self::getUInt2d($recordData, 8);
            CellFont::escapement($objFont, $escapement);

            // offset: 10; size: 1; underline type
            $underlineType <?php echo ord($recordData[10]);
            CellFont::underline($objFont, $underlineType);

            // offset: 11; size: 1; font family
            // offset: 12; size: 1; character set
            // offset: 13; size: 1; not used
            // offset: 14; size: var; font name
            if ($this->version <?php echo<?php echo self::XLS_BIFF8) {
                $string <?php echo self::readUnicodeStringShort(substr($recordData, 14));
            } else {
                $string <?php echo $this->readByteStringShort(substr($recordData, 14));
            }
            $objFont->setName($string['value']);

            $this->objFonts[] <?php echo $objFont;
        }
    }

    /**
     * FORMAT.
     *
     * This record contains information about a number format.
     * All FORMAT records occur together in a sequential list.
     *
     * In BIFF2-BIFF4 other records referencing a FORMAT record
     * contain a zero-based index into this list. From BIFF5 on
     * the FORMAT record contains the index itself that will be
     * used by other records.
     *
     * --    "OpenOffice.org's Documentation of the Microsoft
     *         Excel File Format"
     */
    private function readFormat(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if (!$this->readDataOnly) {
            $indexCode <?php echo self::getUInt2d($recordData, 0);

            if ($this->version <?php echo<?php echo self::XLS_BIFF8) {
                $string <?php echo self::readUnicodeStringLong(substr($recordData, 2));
            } else {
                // BIFF7
                $string <?php echo $this->readByteStringShort(substr($recordData, 2));
            }

            $formatString <?php echo $string['value'];
            // Apache Open Office sets wrong case writing to xls - issue 2239
            if ($formatString <?php echo<?php echo<?php echo 'GENERAL') {
                $formatString <?php echo NumberFormat::FORMAT_GENERAL;
            }
            $this->formats[$indexCode] <?php echo $formatString;
        }
    }

    /**
     * XF - Extended Format.
     *
     * This record contains formatting information for cells, rows, columns or styles.
     * According to https://support.microsoft.com/en-us/help/147732 there are always at least 15 cell style XF
     * and 1 cell XF.
     * Inspection of Excel files generated by MS Office Excel shows that XF records 0-14 are cell style XF
     * and XF record 15 is a cell XF
     * We only read the first cell style XF and skip the remaining cell style XF records
     * We read all cell XF records.
     *
     * --    "OpenOffice.org's Documentation of the Microsoft
     *         Excel File Format"
     */
    private function readXf(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        $objStyle <?php echo new Style();

        if (!$this->readDataOnly) {
            // offset:  0; size: 2; Index to FONT record
            if (self::getUInt2d($recordData, 0) < 4) {
                $fontIndex <?php echo self::getUInt2d($recordData, 0);
            } else {
                // this has to do with that index 4 is omitted in all BIFF versions for some strange reason
                // check the OpenOffice documentation of the FONT record
                $fontIndex <?php echo self::getUInt2d($recordData, 0) - 1;
            }
            $objStyle->setFont($this->objFonts[$fontIndex]);

            // offset:  2; size: 2; Index to FORMAT record
            $numberFormatIndex <?php echo self::getUInt2d($recordData, 2);
            if (isset($this->formats[$numberFormatIndex])) {
                // then we have user-defined format code
                $numberFormat <?php echo ['formatCode' <?php echo> $this->formats[$numberFormatIndex]];
            } elseif (($code <?php echo NumberFormat::builtInFormatCode($numberFormatIndex)) !<?php echo<?php echo '') {
                // then we have built-in format code
                $numberFormat <?php echo ['formatCode' <?php echo> $code];
            } else {
                // we set the general format code
                $numberFormat <?php echo ['formatCode' <?php echo> NumberFormat::FORMAT_GENERAL];
            }
            $objStyle->getNumberFormat()->setFormatCode($numberFormat['formatCode']);

            // offset:  4; size: 2; XF type, cell protection, and parent style XF
            // bit 2-0; mask 0x0007; XF_TYPE_PROT
            $xfTypeProt <?php echo self::getUInt2d($recordData, 4);
            // bit 0; mask 0x01; 1 <?php echo cell is locked
            $isLocked <?php echo (0x01 & $xfTypeProt) >> 0;
            $objStyle->getProtection()->setLocked($isLocked ? Protection::PROTECTION_INHERIT : Protection::PROTECTION_UNPROTECTED);

            // bit 1; mask 0x02; 1 <?php echo Formula is hidden
            $isHidden <?php echo (0x02 & $xfTypeProt) >> 1;
            $objStyle->getProtection()->setHidden($isHidden ? Protection::PROTECTION_PROTECTED : Protection::PROTECTION_UNPROTECTED);

            // bit 2; mask 0x04; 0 <?php echo Cell XF, 1 <?php echo Cell Style XF
            $isCellStyleXf <?php echo (0x04 & $xfTypeProt) >> 2;

            // offset:  6; size: 1; Alignment and text break
            // bit 2-0, mask 0x07; horizontal alignment
            $horAlign <?php echo (0x07 & ord($recordData[6])) >> 0;
            Xls\Style\CellAlignment::horizontal($objStyle->getAlignment(), $horAlign);

            // bit 3, mask 0x08; wrap text
            $wrapText <?php echo (0x08 & ord($recordData[6])) >> 3;
            Xls\Style\CellAlignment::wrap($objStyle->getAlignment(), $wrapText);

            // bit 6-4, mask 0x70; vertical alignment
            $vertAlign <?php echo (0x70 & ord($recordData[6])) >> 4;
            Xls\Style\CellAlignment::vertical($objStyle->getAlignment(), $vertAlign);

            if ($this->version <?php echo<?php echo self::XLS_BIFF8) {
                // offset:  7; size: 1; XF_ROTATION: Text rotation angle
                $angle <?php echo ord($recordData[7]);
                $rotation <?php echo 0;
                if ($angle <?php echo 90) {
                    $rotation <?php echo $angle;
                } elseif ($angle <?php echo 180) {
                    $rotation <?php echo 90 - $angle;
                } elseif ($angle <?php echo<?php echo Alignment::TEXTROTATION_STACK_EXCEL) {
                    $rotation <?php echo Alignment::TEXTROTATION_STACK_PHPSPREADSHEET;
                }
                $objStyle->getAlignment()->setTextRotation($rotation);

                // offset:  8; size: 1; Indentation, shrink to cell size, and text direction
                // bit: 3-0; mask: 0x0F; indent level
                $indent <?php echo (0x0F & ord($recordData[8])) >> 0;
                $objStyle->getAlignment()->setIndent($indent);

                // bit: 4; mask: 0x10; 1 <?php echo shrink content to fit into cell
                $shrinkToFit <?php echo (0x10 & ord($recordData[8])) >> 4;
                switch ($shrinkToFit) {
                    case 0:
                        $objStyle->getAlignment()->setShrinkToFit(false);

                        break;
                    case 1:
                        $objStyle->getAlignment()->setShrinkToFit(true);

                        break;
                }

                // offset:  9; size: 1; Flags used for attribute groups

                // offset: 10; size: 4; Cell border lines and background area
                // bit: 3-0; mask: 0x0000000F; left style
                if ($bordersLeftStyle <?php echo Xls\Style\Border::lookup((0x0000000F & self::getInt4d($recordData, 10)) >> 0)) {
                    $objStyle->getBorders()->getLeft()->setBorderStyle($bordersLeftStyle);
                }
                // bit: 7-4; mask: 0x000000F0; right style
                if ($bordersRightStyle <?php echo Xls\Style\Border::lookup((0x000000F0 & self::getInt4d($recordData, 10)) >> 4)) {
                    $objStyle->getBorders()->getRight()->setBorderStyle($bordersRightStyle);
                }
                // bit: 11-8; mask: 0x00000F00; top style
                if ($bordersTopStyle <?php echo Xls\Style\Border::lookup((0x00000F00 & self::getInt4d($recordData, 10)) >> 8)) {
                    $objStyle->getBorders()->getTop()->setBorderStyle($bordersTopStyle);
                }
                // bit: 15-12; mask: 0x0000F000; bottom style
                if ($bordersBottomStyle <?php echo Xls\Style\Border::lookup((0x0000F000 & self::getInt4d($recordData, 10)) >> 12)) {
                    $objStyle->getBorders()->getBottom()->setBorderStyle($bordersBottomStyle);
                }
                // bit: 22-16; mask: 0x007F0000; left color
                $objStyle->getBorders()->getLeft()->colorIndex <?php echo (0x007F0000 & self::getInt4d($recordData, 10)) >> 16;

                // bit: 29-23; mask: 0x3F800000; right color
                $objStyle->getBorders()->getRight()->colorIndex <?php echo (0x3F800000 & self::getInt4d($recordData, 10)) >> 23;

                // bit: 30; mask: 0x40000000; 1 <?php echo diagonal line from top left to right bottom
                $diagonalDown <?php echo (0x40000000 & self::getInt4d($recordData, 10)) >> 30 ? true : false;

                // bit: 31; mask: 0x80000000; 1 <?php echo diagonal line from bottom left to top right
                $diagonalUp <?php echo ((int) 0x80000000 & self::getInt4d($recordData, 10)) >> 31 ? true : false;

                if ($diagonalUp <?php echo<?php echo<?php echo false) {
                    if ($diagonalDown <?php echo<?php echo false) {
                        $objStyle->getBorders()->setDiagonalDirection(Borders::DIAGONAL_NONE);
                    } else {
                        $objStyle->getBorders()->setDiagonalDirection(Borders::DIAGONAL_DOWN);
                    }
                } elseif ($diagonalDown <?php echo<?php echo false) {
                    $objStyle->getBorders()->setDiagonalDirection(Borders::DIAGONAL_UP);
                } else {
                    $objStyle->getBorders()->setDiagonalDirection(Borders::DIAGONAL_BOTH);
                }

                // offset: 14; size: 4;
                // bit: 6-0; mask: 0x0000007F; top color
                $objStyle->getBorders()->getTop()->colorIndex <?php echo (0x0000007F & self::getInt4d($recordData, 14)) >> 0;

                // bit: 13-7; mask: 0x00003F80; bottom color
                $objStyle->getBorders()->getBottom()->colorIndex <?php echo (0x00003F80 & self::getInt4d($recordData, 14)) >> 7;

                // bit: 20-14; mask: 0x001FC000; diagonal color
                $objStyle->getBorders()->getDiagonal()->colorIndex <?php echo (0x001FC000 & self::getInt4d($recordData, 14)) >> 14;

                // bit: 24-21; mask: 0x01E00000; diagonal style
                if ($bordersDiagonalStyle <?php echo Xls\Style\Border::lookup((0x01E00000 & self::getInt4d($recordData, 14)) >> 21)) {
                    $objStyle->getBorders()->getDiagonal()->setBorderStyle($bordersDiagonalStyle);
                }

                // bit: 31-26; mask: 0xFC000000 fill pattern
                if ($fillType <?php echo Xls\Style\FillPattern::lookup(((int) 0xFC000000 & self::getInt4d($recordData, 14)) >> 26)) {
                    $objStyle->getFill()->setFillType($fillType);
                }
                // offset: 18; size: 2; pattern and background colour
                // bit: 6-0; mask: 0x007F; color index for pattern color
                $objStyle->getFill()->startcolorIndex <?php echo (0x007F & self::getUInt2d($recordData, 18)) >> 0;

                // bit: 13-7; mask: 0x3F80; color index for pattern background
                $objStyle->getFill()->endcolorIndex <?php echo (0x3F80 & self::getUInt2d($recordData, 18)) >> 7;
            } else {
                // BIFF5

                // offset: 7; size: 1; Text orientation and flags
                $orientationAndFlags <?php echo ord($recordData[7]);

                // bit: 1-0; mask: 0x03; XF_ORIENTATION: Text orientation
                $xfOrientation <?php echo (0x03 & $orientationAndFlags) >> 0;
                switch ($xfOrientation) {
                    case 0:
                        $objStyle->getAlignment()->setTextRotation(0);

                        break;
                    case 1:
                        $objStyle->getAlignment()->setTextRotation(Alignment::TEXTROTATION_STACK_PHPSPREADSHEET);

                        break;
                    case 2:
                        $objStyle->getAlignment()->setTextRotation(90);

                        break;
                    case 3:
                        $objStyle->getAlignment()->setTextRotation(-90);

                        break;
                }

                // offset: 8; size: 4; cell border lines and background area
                $borderAndBackground <?php echo self::getInt4d($recordData, 8);

                // bit: 6-0; mask: 0x0000007F; color index for pattern color
                $objStyle->getFill()->startcolorIndex <?php echo (0x0000007F & $borderAndBackground) >> 0;

                // bit: 13-7; mask: 0x00003F80; color index for pattern background
                $objStyle->getFill()->endcolorIndex <?php echo (0x00003F80 & $borderAndBackground) >> 7;

                // bit: 21-16; mask: 0x003F0000; fill pattern
                $objStyle->getFill()->setFillType(Xls\Style\FillPattern::lookup((0x003F0000 & $borderAndBackground) >> 16));

                // bit: 24-22; mask: 0x01C00000; bottom line style
                $objStyle->getBorders()->getBottom()->setBorderStyle(Xls\Style\Border::lookup((0x01C00000 & $borderAndBackground) >> 22));

                // bit: 31-25; mask: 0xFE000000; bottom line color
                $objStyle->getBorders()->getBottom()->colorIndex <?php echo ((int) 0xFE000000 & $borderAndBackground) >> 25;

                // offset: 12; size: 4; cell border lines
                $borderLines <?php echo self::getInt4d($recordData, 12);

                // bit: 2-0; mask: 0x00000007; top line style
                $objStyle->getBorders()->getTop()->setBorderStyle(Xls\Style\Border::lookup((0x00000007 & $borderLines) >> 0));

                // bit: 5-3; mask: 0x00000038; left line style
                $objStyle->getBorders()->getLeft()->setBorderStyle(Xls\Style\Border::lookup((0x00000038 & $borderLines) >> 3));

                // bit: 8-6; mask: 0x000001C0; right line style
                $objStyle->getBorders()->getRight()->setBorderStyle(Xls\Style\Border::lookup((0x000001C0 & $borderLines) >> 6));

                // bit: 15-9; mask: 0x0000FE00; top line color index
                $objStyle->getBorders()->getTop()->colorIndex <?php echo (0x0000FE00 & $borderLines) >> 9;

                // bit: 22-16; mask: 0x007F0000; left line color index
                $objStyle->getBorders()->getLeft()->colorIndex <?php echo (0x007F0000 & $borderLines) >> 16;

                // bit: 29-23; mask: 0x3F800000; right line color index
                $objStyle->getBorders()->getRight()->colorIndex <?php echo (0x3F800000 & $borderLines) >> 23;
            }

            // add cellStyleXf or cellXf and update mapping
            if ($isCellStyleXf) {
                // we only read one style XF record which is always the first
                if ($this->xfIndex <?php echo<?php echo 0) {
                    $this->spreadsheet->addCellStyleXf($objStyle);
                    $this->mapCellStyleXfIndex[$this->xfIndex] <?php echo 0;
                }
            } else {
                // we read all cell XF records
                $this->spreadsheet->addCellXf($objStyle);
                $this->mapCellXfIndex[$this->xfIndex] <?php echo count($this->spreadsheet->getCellXfCollection()) - 1;
            }

            // update XF index for when we read next record
            ++$this->xfIndex;
        }
    }

    private function readXfExt(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if (!$this->readDataOnly) {
            // offset: 0; size: 2; 0x087D <?php echo repeated header

            // offset: 2; size: 2

            // offset: 4; size: 8; not used

            // offset: 12; size: 2; record version

            // offset: 14; size: 2; index to XF record which this record modifies
            $ixfe <?php echo self::getUInt2d($recordData, 14);

            // offset: 16; size: 2; not used

            // offset: 18; size: 2; number of extension properties that follow
            $cexts <?php echo self::getUInt2d($recordData, 18);

            // start reading the actual extension data
            $offset <?php echo 20;
            while ($offset < $length) {
                // extension type
                $extType <?php echo self::getUInt2d($recordData, $offset);

                // extension length
                $cb <?php echo self::getUInt2d($recordData, $offset + 2);

                // extension data
                $extData <?php echo substr($recordData, $offset + 4, $cb);

                switch ($extType) {
                    case 4:        // fill start color
                        $xclfType <?php echo self::getUInt2d($extData, 0); // color type
                        $xclrValue <?php echo substr($extData, 4, 4); // color value (value based on color type)

                        if ($xclfType <?php echo<?php echo 2) {
                            $rgb <?php echo sprintf('%02X%02X%02X', ord($xclrValue[0]), ord($xclrValue[1]), ord($xclrValue[2]));

                            // modify the relevant style property
                            if (isset($this->mapCellXfIndex[$ixfe])) {
                                $fill <?php echo $this->spreadsheet->getCellXfByIndex($this->mapCellXfIndex[$ixfe])->getFill();
                                $fill->getStartColor()->setRGB($rgb);
                                $fill->startcolorIndex <?php echo null; // normal color index does not apply, discard
                            }
                        }

                        break;
                    case 5:        // fill end color
                        $xclfType <?php echo self::getUInt2d($extData, 0); // color type
                        $xclrValue <?php echo substr($extData, 4, 4); // color value (value based on color type)

                        if ($xclfType <?php echo<?php echo 2) {
                            $rgb <?php echo sprintf('%02X%02X%02X', ord($xclrValue[0]), ord($xclrValue[1]), ord($xclrValue[2]));

                            // modify the relevant style property
                            if (isset($this->mapCellXfIndex[$ixfe])) {
                                $fill <?php echo $this->spreadsheet->getCellXfByIndex($this->mapCellXfIndex[$ixfe])->getFill();
                                $fill->getEndColor()->setRGB($rgb);
                                $fill->endcolorIndex <?php echo null; // normal color index does not apply, discard
                            }
                        }

                        break;
                    case 7:        // border color top
                        $xclfType <?php echo self::getUInt2d($extData, 0); // color type
                        $xclrValue <?php echo substr($extData, 4, 4); // color value (value based on color type)

                        if ($xclfType <?php echo<?php echo 2) {
                            $rgb <?php echo sprintf('%02X%02X%02X', ord($xclrValue[0]), ord($xclrValue[1]), ord($xclrValue[2]));

                            // modify the relevant style property
                            if (isset($this->mapCellXfIndex[$ixfe])) {
                                $top <?php echo $this->spreadsheet->getCellXfByIndex($this->mapCellXfIndex[$ixfe])->getBorders()->getTop();
                                $top->getColor()->setRGB($rgb);
                                $top->colorIndex <?php echo null; // normal color index does not apply, discard
                            }
                        }

                        break;
                    case 8:        // border color bottom
                        $xclfType <?php echo self::getUInt2d($extData, 0); // color type
                        $xclrValue <?php echo substr($extData, 4, 4); // color value (value based on color type)

                        if ($xclfType <?php echo<?php echo 2) {
                            $rgb <?php echo sprintf('%02X%02X%02X', ord($xclrValue[0]), ord($xclrValue[1]), ord($xclrValue[2]));

                            // modify the relevant style property
                            if (isset($this->mapCellXfIndex[$ixfe])) {
                                $bottom <?php echo $this->spreadsheet->getCellXfByIndex($this->mapCellXfIndex[$ixfe])->getBorders()->getBottom();
                                $bottom->getColor()->setRGB($rgb);
                                $bottom->colorIndex <?php echo null; // normal color index does not apply, discard
                            }
                        }

                        break;
                    case 9:        // border color left
                        $xclfType <?php echo self::getUInt2d($extData, 0); // color type
                        $xclrValue <?php echo substr($extData, 4, 4); // color value (value based on color type)

                        if ($xclfType <?php echo<?php echo 2) {
                            $rgb <?php echo sprintf('%02X%02X%02X', ord($xclrValue[0]), ord($xclrValue[1]), ord($xclrValue[2]));

                            // modify the relevant style property
                            if (isset($this->mapCellXfIndex[$ixfe])) {
                                $left <?php echo $this->spreadsheet->getCellXfByIndex($this->mapCellXfIndex[$ixfe])->getBorders()->getLeft();
                                $left->getColor()->setRGB($rgb);
                                $left->colorIndex <?php echo null; // normal color index does not apply, discard
                            }
                        }

                        break;
                    case 10:        // border color right
                        $xclfType <?php echo self::getUInt2d($extData, 0); // color type
                        $xclrValue <?php echo substr($extData, 4, 4); // color value (value based on color type)

                        if ($xclfType <?php echo<?php echo 2) {
                            $rgb <?php echo sprintf('%02X%02X%02X', ord($xclrValue[0]), ord($xclrValue[1]), ord($xclrValue[2]));

                            // modify the relevant style property
                            if (isset($this->mapCellXfIndex[$ixfe])) {
                                $right <?php echo $this->spreadsheet->getCellXfByIndex($this->mapCellXfIndex[$ixfe])->getBorders()->getRight();
                                $right->getColor()->setRGB($rgb);
                                $right->colorIndex <?php echo null; // normal color index does not apply, discard
                            }
                        }

                        break;
                    case 11:        // border color diagonal
                        $xclfType <?php echo self::getUInt2d($extData, 0); // color type
                        $xclrValue <?php echo substr($extData, 4, 4); // color value (value based on color type)

                        if ($xclfType <?php echo<?php echo 2) {
                            $rgb <?php echo sprintf('%02X%02X%02X', ord($xclrValue[0]), ord($xclrValue[1]), ord($xclrValue[2]));

                            // modify the relevant style property
                            if (isset($this->mapCellXfIndex[$ixfe])) {
                                $diagonal <?php echo $this->spreadsheet->getCellXfByIndex($this->mapCellXfIndex[$ixfe])->getBorders()->getDiagonal();
                                $diagonal->getColor()->setRGB($rgb);
                                $diagonal->colorIndex <?php echo null; // normal color index does not apply, discard
                            }
                        }

                        break;
                    case 13:    // font color
                        $xclfType <?php echo self::getUInt2d($extData, 0); // color type
                        $xclrValue <?php echo substr($extData, 4, 4); // color value (value based on color type)

                        if ($xclfType <?php echo<?php echo 2) {
                            $rgb <?php echo sprintf('%02X%02X%02X', ord($xclrValue[0]), ord($xclrValue[1]), ord($xclrValue[2]));

                            // modify the relevant style property
                            if (isset($this->mapCellXfIndex[$ixfe])) {
                                $font <?php echo $this->spreadsheet->getCellXfByIndex($this->mapCellXfIndex[$ixfe])->getFont();
                                $font->getColor()->setRGB($rgb);
                                $font->colorIndex <?php echo null; // normal color index does not apply, discard
                            }
                        }

                        break;
                }

                $offset +<?php echo $cb;
            }
        }
    }

    /**
     * Read STYLE record.
     */
    private function readStyle(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if (!$this->readDataOnly) {
            // offset: 0; size: 2; index to XF record and flag for built-in style
            $ixfe <?php echo self::getUInt2d($recordData, 0);

            // bit: 11-0; mask 0x0FFF; index to XF record
            $xfIndex <?php echo (0x0FFF & $ixfe) >> 0;

            // bit: 15; mask 0x8000; 0 <?php echo user-defined style, 1 <?php echo built-in style
            $isBuiltIn <?php echo (bool) ((0x8000 & $ixfe) >> 15);

            if ($isBuiltIn) {
                // offset: 2; size: 1; identifier for built-in style
                $builtInId <?php echo ord($recordData[2]);

                switch ($builtInId) {
                    case 0x00:
                        // currently, we are not using this for anything
                        break;
                    default:
                        break;
                }
            }
            // user-defined; not supported by PhpSpreadsheet
        }
    }

    /**
     * Read PALETTE record.
     */
    private function readPalette(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if (!$this->readDataOnly) {
            // offset: 0; size: 2; number of following colors
            $nm <?php echo self::getUInt2d($recordData, 0);

            // list of RGB colors
            for ($i <?php echo 0; $i < $nm; ++$i) {
                $rgb <?php echo substr($recordData, 2 + 4 * $i, 4);
                $this->palette[] <?php echo self::readRGB($rgb);
            }
        }
    }

    /**
     * SHEET.
     *
     * This record is  located in the  Workbook Globals
     * Substream  and represents a sheet inside the workbook.
     * One SHEET record is written for each sheet. It stores the
     * sheet name and a stream offset to the BOF record of the
     * respective Sheet Substream within the Workbook Stream.
     *
     * --    "OpenOffice.org's Documentation of the Microsoft
     *         Excel File Format"
     */
    private function readSheet(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // offset: 0; size: 4; absolute stream position of the BOF record of the sheet
        // NOTE: not encrypted
        $rec_offset <?php echo self::getInt4d($this->data, $this->pos + 4);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        // offset: 4; size: 1; sheet state
        switch (ord($recordData[4])) {
            case 0x00:
                $sheetState <?php echo Worksheet::SHEETSTATE_VISIBLE;

                break;
            case 0x01:
                $sheetState <?php echo Worksheet::SHEETSTATE_HIDDEN;

                break;
            case 0x02:
                $sheetState <?php echo Worksheet::SHEETSTATE_VERYHIDDEN;

                break;
            default:
                $sheetState <?php echo Worksheet::SHEETSTATE_VISIBLE;

                break;
        }

        // offset: 5; size: 1; sheet type
        $sheetType <?php echo ord($recordData[5]);

        // offset: 6; size: var; sheet name
        $rec_name <?php echo null;
        if ($this->version <?php echo<?php echo self::XLS_BIFF8) {
            $string <?php echo self::readUnicodeStringShort(substr($recordData, 6));
            $rec_name <?php echo $string['value'];
        } elseif ($this->version <?php echo<?php echo self::XLS_BIFF7) {
            $string <?php echo $this->readByteStringShort(substr($recordData, 6));
            $rec_name <?php echo $string['value'];
        }

        $this->sheets[] <?php echo [
            'name' <?php echo> $rec_name,
            'offset' <?php echo> $rec_offset,
            'sheetState' <?php echo> $sheetState,
            'sheetType' <?php echo> $sheetType,
        ];
    }

    /**
     * Read EXTERNALBOOK record.
     */
    private function readExternalBook(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        // offset within record data
        $offset <?php echo 0;

        // there are 4 types of records
        if (strlen($recordData) > 4) {
            // external reference
            // offset: 0; size: 2; number of sheet names ($nm)
            $nm <?php echo self::getUInt2d($recordData, 0);
            $offset +<?php echo 2;

            // offset: 2; size: var; encoded URL without sheet name (Unicode string, 16-bit length)
            $encodedUrlString <?php echo self::readUnicodeStringLong(substr($recordData, 2));
            $offset +<?php echo $encodedUrlString['size'];

            // offset: var; size: var; list of $nm sheet names (Unicode strings, 16-bit length)
            $externalSheetNames <?php echo [];
            for ($i <?php echo 0; $i < $nm; ++$i) {
                $externalSheetNameString <?php echo self::readUnicodeStringLong(substr($recordData, $offset));
                $externalSheetNames[] <?php echo $externalSheetNameString['value'];
                $offset +<?php echo $externalSheetNameString['size'];
            }

            // store the record data
            $this->externalBooks[] <?php echo [
                'type' <?php echo> 'external',
                'encodedUrl' <?php echo> $encodedUrlString['value'],
                'externalSheetNames' <?php echo> $externalSheetNames,
            ];
        } elseif (substr($recordData, 2, 2) <?php echo<?php echo pack('CC', 0x01, 0x04)) {
            // internal reference
            // offset: 0; size: 2; number of sheet in this document
            // offset: 2; size: 2; 0x01 0x04
            $this->externalBooks[] <?php echo [
                'type' <?php echo> 'internal',
            ];
        } elseif (substr($recordData, 0, 4) <?php echo<?php echo pack('vCC', 0x0001, 0x01, 0x3A)) {
            // add-in function
            // offset: 0; size: 2; 0x0001
            $this->externalBooks[] <?php echo [
                'type' <?php echo> 'addInFunction',
            ];
        } elseif (substr($recordData, 0, 2) <?php echo<?php echo pack('v', 0x0000)) {
            // DDE links, OLE links
            // offset: 0; size: 2; 0x0000
            // offset: 2; size: var; encoded source document name
            $this->externalBooks[] <?php echo [
                'type' <?php echo> 'DDEorOLE',
            ];
        }
    }

    /**
     * Read EXTERNNAME record.
     */
    private function readExternName(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        // external sheet references provided for named cells
        if ($this->version <?php echo<?php echo self::XLS_BIFF8) {
            // offset: 0; size: 2; options
            $options <?php echo self::getUInt2d($recordData, 0);

            // offset: 2; size: 2;

            // offset: 4; size: 2; not used

            // offset: 6; size: var
            $nameString <?php echo self::readUnicodeStringShort(substr($recordData, 6));

            // offset: var; size: var; formula data
            $offset <?php echo 6 + $nameString['size'];
            $formula <?php echo $this->getFormulaFromStructure(substr($recordData, $offset));

            $this->externalNames[] <?php echo [
                'name' <?php echo> $nameString['value'],
                'formula' <?php echo> $formula,
            ];
        }
    }

    /**
     * Read EXTERNSHEET record.
     */
    private function readExternSheet(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        // external sheet references provided for named cells
        if ($this->version <?php echo<?php echo self::XLS_BIFF8) {
            // offset: 0; size: 2; number of following ref structures
            $nm <?php echo self::getUInt2d($recordData, 0);
            for ($i <?php echo 0; $i < $nm; ++$i) {
                $this->ref[] <?php echo [
                    // offset: 2 + 6 * $i; index to EXTERNALBOOK record
                    'externalBookIndex' <?php echo> self::getUInt2d($recordData, 2 + 6 * $i),
                    // offset: 4 + 6 * $i; index to first sheet in EXTERNALBOOK record
                    'firstSheetIndex' <?php echo> self::getUInt2d($recordData, 4 + 6 * $i),
                    // offset: 6 + 6 * $i; index to last sheet in EXTERNALBOOK record
                    'lastSheetIndex' <?php echo> self::getUInt2d($recordData, 6 + 6 * $i),
                ];
            }
        }
    }

    /**
     * DEFINEDNAME.
     *
     * This record is part of a Link Table. It contains the name
     * and the token array of an internal defined name. Token
     * arrays of defined names contain tokens with aberrant
     * token classes.
     *
     * --    "OpenOffice.org's Documentation of the Microsoft
     *         Excel File Format"
     */
    private function readDefinedName(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if ($this->version <?php echo<?php echo self::XLS_BIFF8) {
            // retrieves named cells

            // offset: 0; size: 2; option flags
            $opts <?php echo self::getUInt2d($recordData, 0);

            // bit: 5; mask: 0x0020; 0 <?php echo user-defined name, 1 <?php echo built-in-name
            $isBuiltInName <?php echo (0x0020 & $opts) >> 5;

            // offset: 2; size: 1; keyboard shortcut

            // offset: 3; size: 1; length of the name (character count)
            $nlen <?php echo ord($recordData[3]);

            // offset: 4; size: 2; size of the formula data (it can happen that this is zero)
            // note: there can also be additional data, this is not included in $flen
            $flen <?php echo self::getUInt2d($recordData, 4);

            // offset: 8; size: 2; 0<?php echoGlobal name, otherwise index to sheet (1-based)
            $scope <?php echo self::getUInt2d($recordData, 8);

            // offset: 14; size: var; Name (Unicode string without length field)
            $string <?php echo self::readUnicodeString(substr($recordData, 14), $nlen);

            // offset: var; size: $flen; formula data
            $offset <?php echo 14 + $string['size'];
            $formulaStructure <?php echo pack('v', $flen) . substr($recordData, $offset);

            try {
                $formula <?php echo $this->getFormulaFromStructure($formulaStructure);
            } catch (PhpSpreadsheetException $e) {
                $formula <?php echo '';
            }

            $this->definedname[] <?php echo [
                'isBuiltInName' <?php echo> $isBuiltInName,
                'name' <?php echo> $string['value'],
                'formula' <?php echo> $formula,
                'scope' <?php echo> $scope,
            ];
        }
    }

    /**
     * Read MSODRAWINGGROUP record.
     */
    private function readMsoDrawingGroup(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);

        // get spliced record data
        $splicedRecordData <?php echo $this->getSplicedRecordData();
        $recordData <?php echo $splicedRecordData['recordData'];

        $this->drawingGroupData .<?php echo $recordData;
    }

    /**
     * SST - Shared String Table.
     *
     * This record contains a list of all strings used anywhere
     * in the workbook. Each string occurs only once. The
     * workbook uses indexes into the list to reference the
     * strings.
     *
     * --    "OpenOffice.org's Documentation of the Microsoft
     *         Excel File Format"
     */
    private function readSst(): void
    {
        // offset within (spliced) record data
        $pos <?php echo 0;

        // Limit global SST position, further control for bad SST Length in BIFF8 data
        $limitposSST <?php echo 0;

        // get spliced record data
        $splicedRecordData <?php echo $this->getSplicedRecordData();

        $recordData <?php echo $splicedRecordData['recordData'];
        $spliceOffsets <?php echo $splicedRecordData['spliceOffsets'];

        // offset: 0; size: 4; total number of strings in the workbook
        $pos +<?php echo 4;

        // offset: 4; size: 4; number of following strings ($nm)
        $nm <?php echo self::getInt4d($recordData, 4);
        $pos +<?php echo 4;

        // look up limit position
        foreach ($spliceOffsets as $spliceOffset) {
            // it can happen that the string is empty, therefore we need
            // <?php echo and not just <
            if ($pos <?php echo $spliceOffset) {
                $limitposSST <?php echo $spliceOffset;
            }
        }

        // loop through the Unicode strings (16-bit length)
        for ($i <?php echo 0; $i < $nm && $pos < $limitposSST; ++$i) {
            // number of characters in the Unicode string
            $numChars <?php echo self::getUInt2d($recordData, $pos);
            $pos +<?php echo 2;

            // option flags
            $optionFlags <?php echo ord($recordData[$pos]);
            ++$pos;

            // bit: 0; mask: 0x01; 0 <?php echo compressed; 1 <?php echo uncompressed
            $isCompressed <?php echo (($optionFlags & 0x01) <?php echo<?php echo 0);

            // bit: 2; mask: 0x02; 0 <?php echo ordinary; 1 <?php echo Asian phonetic
            $hasAsian <?php echo (($optionFlags & 0x04) !<?php echo 0);

            // bit: 3; mask: 0x03; 0 <?php echo ordinary; 1 <?php echo Rich-Text
            $hasRichText <?php echo (($optionFlags & 0x08) !<?php echo 0);

            $formattingRuns <?php echo 0;
            if ($hasRichText) {
                // number of Rich-Text formatting runs
                $formattingRuns <?php echo self::getUInt2d($recordData, $pos);
                $pos +<?php echo 2;
            }

            $extendedRunLength <?php echo 0;
            if ($hasAsian) {
                // size of Asian phonetic setting
                $extendedRunLength <?php echo self::getInt4d($recordData, $pos);
                $pos +<?php echo 4;
            }

            // expected byte length of character array if not split
            $len <?php echo ($isCompressed) ? $numChars : $numChars * 2;

            // look up limit position - Check it again to be sure that no error occurs when parsing SST structure
            $limitpos <?php echo null;
            foreach ($spliceOffsets as $spliceOffset) {
                // it can happen that the string is empty, therefore we need
                // <?php echo and not just <
                if ($pos <?php echo $spliceOffset) {
                    $limitpos <?php echo $spliceOffset;

                    break;
                }
            }

            if ($pos + $len <?php echo $limitpos) {
                // character array is not split between records

                $retstr <?php echo substr($recordData, $pos, $len);
                $pos +<?php echo $len;
            } else {
                // character array is split between records

                // first part of character array
                $retstr <?php echo substr($recordData, $pos, $limitpos - $pos);

                $bytesRead <?php echo $limitpos - $pos;

                // remaining characters in Unicode string
                $charsLeft <?php echo $numChars - (($isCompressed) ? $bytesRead : ($bytesRead / 2));

                $pos <?php echo $limitpos;

                // keep reading the characters
                while ($charsLeft > 0) {
                    // look up next limit position, in case the string span more than one continue record
                    foreach ($spliceOffsets as $spliceOffset) {
                        if ($pos < $spliceOffset) {
                            $limitpos <?php echo $spliceOffset;

                            break;
                        }
                    }

                    // repeated option flags
                    // OpenOffice.org documentation 5.21
                    $option <?php echo ord($recordData[$pos]);
                    ++$pos;

                    if ($isCompressed && ($option <?php echo<?php echo 0)) {
                        // 1st fragment compressed
                        // this fragment compressed
                        $len <?php echo min($charsLeft, $limitpos - $pos);
                        $retstr .<?php echo substr($recordData, $pos, $len);
                        $charsLeft -<?php echo $len;
                        $isCompressed <?php echo true;
                    } elseif (!$isCompressed && ($option !<?php echo 0)) {
                        // 1st fragment uncompressed
                        // this fragment uncompressed
                        $len <?php echo min($charsLeft * 2, $limitpos - $pos);
                        $retstr .<?php echo substr($recordData, $pos, $len);
                        $charsLeft -<?php echo $len / 2;
                        $isCompressed <?php echo false;
                    } elseif (!$isCompressed && ($option <?php echo<?php echo 0)) {
                        // 1st fragment uncompressed
                        // this fragment compressed
                        $len <?php echo min($charsLeft, $limitpos - $pos);
                        for ($j <?php echo 0; $j < $len; ++$j) {
                            $retstr .<?php echo $recordData[$pos + $j]
                            . chr(0);
                        }
                        $charsLeft -<?php echo $len;
                        $isCompressed <?php echo false;
                    } else {
                        // 1st fragment compressed
                        // this fragment uncompressed
                        $newstr <?php echo '';
                        $jMax <?php echo strlen($retstr);
                        for ($j <?php echo 0; $j < $jMax; ++$j) {
                            $newstr .<?php echo $retstr[$j] . chr(0);
                        }
                        $retstr <?php echo $newstr;
                        $len <?php echo min($charsLeft * 2, $limitpos - $pos);
                        $retstr .<?php echo substr($recordData, $pos, $len);
                        $charsLeft -<?php echo $len / 2;
                        $isCompressed <?php echo false;
                    }

                    $pos +<?php echo $len;
                }
            }

            // convert to UTF-8
            $retstr <?php echo self::encodeUTF16($retstr, $isCompressed);

            // read additional Rich-Text information, if any
            $fmtRuns <?php echo [];
            if ($hasRichText) {
                // list of formatting runs
                for ($j <?php echo 0; $j < $formattingRuns; ++$j) {
                    // first formatted character; zero-based
                    $charPos <?php echo self::getUInt2d($recordData, $pos + $j * 4);

                    // index to font record
                    $fontIndex <?php echo self::getUInt2d($recordData, $pos + 2 + $j * 4);

                    $fmtRuns[] <?php echo [
                        'charPos' <?php echo> $charPos,
                        'fontIndex' <?php echo> $fontIndex,
                    ];
                }
                $pos +<?php echo 4 * $formattingRuns;
            }

            // read additional Asian phonetics information, if any
            if ($hasAsian) {
                // For Asian phonetic settings, we skip the extended string data
                $pos +<?php echo $extendedRunLength;
            }

            // store the shared sting
            $this->sst[] <?php echo [
                'value' <?php echo> $retstr,
                'fmtRuns' <?php echo> $fmtRuns,
            ];
        }

        // getSplicedRecordData() takes care of moving current position in data stream
    }

    /**
     * Read PRINTGRIDLINES record.
     */
    private function readPrintGridlines(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if ($this->version <?php echo<?php echo self::XLS_BIFF8 && !$this->readDataOnly) {
            // offset: 0; size: 2; 0 <?php echo do not print sheet grid lines; 1 <?php echo print sheet gridlines
            $printGridlines <?php echo (bool) self::getUInt2d($recordData, 0);
            $this->phpSheet->setPrintGridlines($printGridlines);
        }
    }

    /**
     * Read DEFAULTROWHEIGHT record.
     */
    private function readDefaultRowHeight(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        // offset: 0; size: 2; option flags
        // offset: 2; size: 2; default height for unused rows, (twips 1/20 point)
        $height <?php echo self::getUInt2d($recordData, 2);
        $this->phpSheet->getDefaultRowDimension()->setRowHeight($height / 20);
    }

    /**
     * Read SHEETPR record.
     */
    private function readSheetPr(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        // offset: 0; size: 2

        // bit: 6; mask: 0x0040; 0 <?php echo outline buttons above outline group
        $isSummaryBelow <?php echo (0x0040 & self::getUInt2d($recordData, 0)) >> 6;
        $this->phpSheet->setShowSummaryBelow((bool) $isSummaryBelow);

        // bit: 7; mask: 0x0080; 0 <?php echo outline buttons left of outline group
        $isSummaryRight <?php echo (0x0080 & self::getUInt2d($recordData, 0)) >> 7;
        $this->phpSheet->setShowSummaryRight((bool) $isSummaryRight);

        // bit: 8; mask: 0x100; 0 <?php echo scale printout in percent, 1 <?php echo fit printout to number of pages
        // this corresponds to radio button setting in page setup dialog in Excel
        $this->isFitToPages <?php echo (bool) ((0x0100 & self::getUInt2d($recordData, 0)) >> 8);
    }

    /**
     * Read HORIZONTALPAGEBREAKS record.
     */
    private function readHorizontalPageBreaks(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if ($this->version <?php echo<?php echo self::XLS_BIFF8 && !$this->readDataOnly) {
            // offset: 0; size: 2; number of the following row index structures
            $nm <?php echo self::getUInt2d($recordData, 0);

            // offset: 2; size: 6 * $nm; list of $nm row index structures
            for ($i <?php echo 0; $i < $nm; ++$i) {
                $r <?php echo self::getUInt2d($recordData, 2 + 6 * $i);
                $cf <?php echo self::getUInt2d($recordData, 2 + 6 * $i + 2);
                $cl <?php echo self::getUInt2d($recordData, 2 + 6 * $i + 4);

                // not sure why two column indexes are necessary?
                $this->phpSheet->setBreak([$cf + 1, $r], Worksheet::BREAK_ROW);
            }
        }
    }

    /**
     * Read VERTICALPAGEBREAKS record.
     */
    private function readVerticalPageBreaks(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if ($this->version <?php echo<?php echo self::XLS_BIFF8 && !$this->readDataOnly) {
            // offset: 0; size: 2; number of the following column index structures
            $nm <?php echo self::getUInt2d($recordData, 0);

            // offset: 2; size: 6 * $nm; list of $nm row index structures
            for ($i <?php echo 0; $i < $nm; ++$i) {
                $c <?php echo self::getUInt2d($recordData, 2 + 6 * $i);
                $rf <?php echo self::getUInt2d($recordData, 2 + 6 * $i + 2);
                //$rl <?php echo self::getUInt2d($recordData, 2 + 6 * $i + 4);

                // not sure why two row indexes are necessary?
                $this->phpSheet->setBreak([$c + 1, ($rf > 0) ? $rf : 1], Worksheet::BREAK_COLUMN);
            }
        }
    }

    /**
     * Read HEADER record.
     */
    private function readHeader(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if (!$this->readDataOnly) {
            // offset: 0; size: var
            // realized that $recordData can be empty even when record exists
            if ($recordData) {
                if ($this->version <?php echo<?php echo self::XLS_BIFF8) {
                    $string <?php echo self::readUnicodeStringLong($recordData);
                } else {
                    $string <?php echo $this->readByteStringShort($recordData);
                }

                $this->phpSheet->getHeaderFooter()->setOddHeader($string['value']);
                $this->phpSheet->getHeaderFooter()->setEvenHeader($string['value']);
            }
        }
    }

    /**
     * Read FOOTER record.
     */
    private function readFooter(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if (!$this->readDataOnly) {
            // offset: 0; size: var
            // realized that $recordData can be empty even when record exists
            if ($recordData) {
                if ($this->version <?php echo<?php echo self::XLS_BIFF8) {
                    $string <?php echo self::readUnicodeStringLong($recordData);
                } else {
                    $string <?php echo $this->readByteStringShort($recordData);
                }
                $this->phpSheet->getHeaderFooter()->setOddFooter($string['value']);
                $this->phpSheet->getHeaderFooter()->setEvenFooter($string['value']);
            }
        }
    }

    /**
     * Read HCENTER record.
     */
    private function readHcenter(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if (!$this->readDataOnly) {
            // offset: 0; size: 2; 0 <?php echo print sheet left aligned, 1 <?php echo print sheet centered horizontally
            $isHorizontalCentered <?php echo (bool) self::getUInt2d($recordData, 0);

            $this->phpSheet->getPageSetup()->setHorizontalCentered($isHorizontalCentered);
        }
    }

    /**
     * Read VCENTER record.
     */
    private function readVcenter(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if (!$this->readDataOnly) {
            // offset: 0; size: 2; 0 <?php echo print sheet aligned at top page border, 1 <?php echo print sheet vertically centered
            $isVerticalCentered <?php echo (bool) self::getUInt2d($recordData, 0);

            $this->phpSheet->getPageSetup()->setVerticalCentered($isVerticalCentered);
        }
    }

    /**
     * Read LEFTMARGIN record.
     */
    private function readLeftMargin(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if (!$this->readDataOnly) {
            // offset: 0; size: 8
            $this->phpSheet->getPageMargins()->setLeft(self::extractNumber($recordData));
        }
    }

    /**
     * Read RIGHTMARGIN record.
     */
    private function readRightMargin(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if (!$this->readDataOnly) {
            // offset: 0; size: 8
            $this->phpSheet->getPageMargins()->setRight(self::extractNumber($recordData));
        }
    }

    /**
     * Read TOPMARGIN record.
     */
    private function readTopMargin(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if (!$this->readDataOnly) {
            // offset: 0; size: 8
            $this->phpSheet->getPageMargins()->setTop(self::extractNumber($recordData));
        }
    }

    /**
     * Read BOTTOMMARGIN record.
     */
    private function readBottomMargin(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if (!$this->readDataOnly) {
            // offset: 0; size: 8
            $this->phpSheet->getPageMargins()->setBottom(self::extractNumber($recordData));
        }
    }

    /**
     * Read PAGESETUP record.
     */
    private function readPageSetup(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if (!$this->readDataOnly) {
            // offset: 0; size: 2; paper size
            $paperSize <?php echo self::getUInt2d($recordData, 0);

            // offset: 2; size: 2; scaling factor
            $scale <?php echo self::getUInt2d($recordData, 2);

            // offset: 6; size: 2; fit worksheet width to this number of pages, 0 <?php echo use as many as needed
            $fitToWidth <?php echo self::getUInt2d($recordData, 6);

            // offset: 8; size: 2; fit worksheet height to this number of pages, 0 <?php echo use as many as needed
            $fitToHeight <?php echo self::getUInt2d($recordData, 8);

            // offset: 10; size: 2; option flags

            // bit: 0; mask: 0x0001; 0<?php echodown then over, 1<?php echoover then down
            $isOverThenDown <?php echo (0x0001 & self::getUInt2d($recordData, 10));

            // bit: 1; mask: 0x0002; 0<?php echolandscape, 1<?php echoportrait
            $isPortrait <?php echo (0x0002 & self::getUInt2d($recordData, 10)) >> 1;

            // bit: 2; mask: 0x0004; 1<?php echo paper size, scaling factor, paper orient. not init
            // when this bit is set, do not use flags for those properties
            $isNotInit <?php echo (0x0004 & self::getUInt2d($recordData, 10)) >> 2;

            if (!$isNotInit) {
                $this->phpSheet->getPageSetup()->setPaperSize($paperSize);
                $this->phpSheet->getPageSetup()->setPageOrder(((bool) $isOverThenDown) ? PageSetup::PAGEORDER_OVER_THEN_DOWN : PageSetup::PAGEORDER_DOWN_THEN_OVER);
                $this->phpSheet->getPageSetup()->setOrientation(((bool) $isPortrait) ? PageSetup::ORIENTATION_PORTRAIT : PageSetup::ORIENTATION_LANDSCAPE);

                $this->phpSheet->getPageSetup()->setScale($scale, false);
                $this->phpSheet->getPageSetup()->setFitToPage((bool) $this->isFitToPages);
                $this->phpSheet->getPageSetup()->setFitToWidth($fitToWidth, false);
                $this->phpSheet->getPageSetup()->setFitToHeight($fitToHeight, false);
            }

            // offset: 16; size: 8; header margin (IEEE 754 floating-point value)
            $marginHeader <?php echo self::extractNumber(substr($recordData, 16, 8));
            $this->phpSheet->getPageMargins()->setHeader($marginHeader);

            // offset: 24; size: 8; footer margin (IEEE 754 floating-point value)
            $marginFooter <?php echo self::extractNumber(substr($recordData, 24, 8));
            $this->phpSheet->getPageMargins()->setFooter($marginFooter);
        }
    }

    /**
     * PROTECT - Sheet protection (BIFF2 through BIFF8)
     *   if this record is omitted, then it also means no sheet protection.
     */
    private function readProtect(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if ($this->readDataOnly) {
            return;
        }

        // offset: 0; size: 2;

        // bit 0, mask 0x01; 1 <?php echo sheet is protected
        $bool <?php echo (0x01 & self::getUInt2d($recordData, 0)) >> 0;
        $this->phpSheet->getProtection()->setSheet((bool) $bool);
    }

    /**
     * SCENPROTECT.
     */
    private function readScenProtect(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if ($this->readDataOnly) {
            return;
        }

        // offset: 0; size: 2;

        // bit: 0, mask 0x01; 1 <?php echo scenarios are protected
        $bool <?php echo (0x01 & self::getUInt2d($recordData, 0)) >> 0;

        $this->phpSheet->getProtection()->setScenarios((bool) $bool);
    }

    /**
     * OBJECTPROTECT.
     */
    private function readObjectProtect(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if ($this->readDataOnly) {
            return;
        }

        // offset: 0; size: 2;

        // bit: 0, mask 0x01; 1 <?php echo objects are protected
        $bool <?php echo (0x01 & self::getUInt2d($recordData, 0)) >> 0;

        $this->phpSheet->getProtection()->setObjects((bool) $bool);
    }

    /**
     * PASSWORD - Sheet protection (hashed) password (BIFF2 through BIFF8).
     */
    private function readPassword(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if (!$this->readDataOnly) {
            // offset: 0; size: 2; 16-bit hash value of password
            $password <?php echo strtoupper(dechex(self::getUInt2d($recordData, 0))); // the hashed password
            $this->phpSheet->getProtection()->setPassword($password, true);
        }
    }

    /**
     * Read DEFCOLWIDTH record.
     */
    private function readDefColWidth(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        // offset: 0; size: 2; default column width
        $width <?php echo self::getUInt2d($recordData, 0);
        if ($width !<?php echo 8) {
            $this->phpSheet->getDefaultColumnDimension()->setWidth($width);
        }
    }

    /**
     * Read COLINFO record.
     */
    private function readColInfo(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if (!$this->readDataOnly) {
            // offset: 0; size: 2; index to first column in range
            $firstColumnIndex <?php echo self::getUInt2d($recordData, 0);

            // offset: 2; size: 2; index to last column in range
            $lastColumnIndex <?php echo self::getUInt2d($recordData, 2);

            // offset: 4; size: 2; width of the column in 1/256 of the width of the zero character
            $width <?php echo self::getUInt2d($recordData, 4);

            // offset: 6; size: 2; index to XF record for default column formatting
            $xfIndex <?php echo self::getUInt2d($recordData, 6);

            // offset: 8; size: 2; option flags
            // bit: 0; mask: 0x0001; 1<?php echo columns are hidden
            $isHidden <?php echo (0x0001 & self::getUInt2d($recordData, 8)) >> 0;

            // bit: 10-8; mask: 0x0700; outline level of the columns (0 <?php echo no outline)
            $level <?php echo (0x0700 & self::getUInt2d($recordData, 8)) >> 8;

            // bit: 12; mask: 0x1000; 1 <?php echo collapsed
            $isCollapsed <?php echo (bool) ((0x1000 & self::getUInt2d($recordData, 8)) >> 12);

            // offset: 10; size: 2; not used

            for ($i <?php echo $firstColumnIndex + 1; $i <?php echo $lastColumnIndex + 1; ++$i) {
                if ($lastColumnIndex <?php echo<?php echo 255 || $lastColumnIndex <?php echo<?php echo 256) {
                    $this->phpSheet->getDefaultColumnDimension()->setWidth($width / 256);

                    break;
                }
                $this->phpSheet->getColumnDimensionByColumn($i)->setWidth($width / 256);
                $this->phpSheet->getColumnDimensionByColumn($i)->setVisible(!$isHidden);
                $this->phpSheet->getColumnDimensionByColumn($i)->setOutlineLevel($level);
                $this->phpSheet->getColumnDimensionByColumn($i)->setCollapsed($isCollapsed);
                if (isset($this->mapCellXfIndex[$xfIndex])) {
                    $this->phpSheet->getColumnDimensionByColumn($i)->setXfIndex($this->mapCellXfIndex[$xfIndex]);
                }
            }
        }
    }

    /**
     * ROW.
     *
     * This record contains the properties of a single row in a
     * sheet. Rows and cells in a sheet are divided into blocks
     * of 32 rows.
     *
     * --    "OpenOffice.org's Documentation of the Microsoft
     *         Excel File Format"
     */
    private function readRow(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if (!$this->readDataOnly) {
            // offset: 0; size: 2; index of this row
            $r <?php echo self::getUInt2d($recordData, 0);

            // offset: 2; size: 2; index to column of the first cell which is described by a cell record

            // offset: 4; size: 2; index to column of the last cell which is described by a cell record, increased by 1

            // offset: 6; size: 2;

            // bit: 14-0; mask: 0x7FFF; height of the row, in twips <?php echo 1/20 of a point
            $height <?php echo (0x7FFF & self::getUInt2d($recordData, 6)) >> 0;

            // bit: 15: mask: 0x8000; 0 <?php echo row has custom height; 1<?php echo row has default height
            $useDefaultHeight <?php echo (0x8000 & self::getUInt2d($recordData, 6)) >> 15;

            if (!$useDefaultHeight) {
                $this->phpSheet->getRowDimension($r + 1)->setRowHeight($height / 20);
            }

            // offset: 8; size: 2; not used

            // offset: 10; size: 2; not used in BIFF5-BIFF8

            // offset: 12; size: 4; option flags and default row formatting

            // bit: 2-0: mask: 0x00000007; outline level of the row
            $level <?php echo (0x00000007 & self::getInt4d($recordData, 12)) >> 0;
            $this->phpSheet->getRowDimension($r + 1)->setOutlineLevel($level);

            // bit: 4; mask: 0x00000010; 1 <?php echo outline group start or ends here... and is collapsed
            $isCollapsed <?php echo (bool) ((0x00000010 & self::getInt4d($recordData, 12)) >> 4);
            $this->phpSheet->getRowDimension($r + 1)->setCollapsed($isCollapsed);

            // bit: 5; mask: 0x00000020; 1 <?php echo row is hidden
            $isHidden <?php echo (0x00000020 & self::getInt4d($recordData, 12)) >> 5;
            $this->phpSheet->getRowDimension($r + 1)->setVisible(!$isHidden);

            // bit: 7; mask: 0x00000080; 1 <?php echo row has explicit format
            $hasExplicitFormat <?php echo (0x00000080 & self::getInt4d($recordData, 12)) >> 7;

            // bit: 27-16; mask: 0x0FFF0000; only applies when hasExplicitFormat <?php echo 1; index to XF record
            $xfIndex <?php echo (0x0FFF0000 & self::getInt4d($recordData, 12)) >> 16;

            if ($hasExplicitFormat && isset($this->mapCellXfIndex[$xfIndex])) {
                $this->phpSheet->getRowDimension($r + 1)->setXfIndex($this->mapCellXfIndex[$xfIndex]);
            }
        }
    }

    /**
     * Read RK record
     * This record represents a cell that contains an RK value
     * (encoded integer or floating-point value). If a
     * floating-point value cannot be encoded to an RK value,
     * a NUMBER record will be written. This record replaces the
     * record INTEGER written in BIFF2.
     *
     * --    "OpenOffice.org's Documentation of the Microsoft
     *         Excel File Format"
     */
    private function readRk(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        // offset: 0; size: 2; index to row
        $row <?php echo self::getUInt2d($recordData, 0);

        // offset: 2; size: 2; index to column
        $column <?php echo self::getUInt2d($recordData, 2);
        $columnString <?php echo Coordinate::stringFromColumnIndex($column + 1);

        // Read cell?
        if (($this->getReadFilter() !<?php echo<?php echo null) && $this->getReadFilter()->readCell($columnString, $row + 1, $this->phpSheet->getTitle())) {
            // offset: 4; size: 2; index to XF record
            $xfIndex <?php echo self::getUInt2d($recordData, 4);

            // offset: 6; size: 4; RK value
            $rknum <?php echo self::getInt4d($recordData, 6);
            $numValue <?php echo self::getIEEE754($rknum);

            $cell <?php echo $this->phpSheet->getCell($columnString . ($row + 1));
            if (!$this->readDataOnly && isset($this->mapCellXfIndex[$xfIndex])) {
                // add style information
                $cell->setXfIndex($this->mapCellXfIndex[$xfIndex]);
            }

            // add cell
            $cell->setValueExplicit($numValue, DataType::TYPE_NUMERIC);
        }
    }

    /**
     * Read LABELSST record
     * This record represents a cell that contains a string. It
     * replaces the LABEL record and RSTRING record used in
     * BIFF2-BIFF5.
     *
     * --    "OpenOffice.org's Documentation of the Microsoft
     *         Excel File Format"
     */
    private function readLabelSst(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        // offset: 0; size: 2; index to row
        $row <?php echo self::getUInt2d($recordData, 0);

        // offset: 2; size: 2; index to column
        $column <?php echo self::getUInt2d($recordData, 2);
        $columnString <?php echo Coordinate::stringFromColumnIndex($column + 1);

        $emptyCell <?php echo true;
        // Read cell?
        if (($this->getReadFilter() !<?php echo<?php echo null) && $this->getReadFilter()->readCell($columnString, $row + 1, $this->phpSheet->getTitle())) {
            // offset: 4; size: 2; index to XF record
            $xfIndex <?php echo self::getUInt2d($recordData, 4);

            // offset: 6; size: 4; index to SST record
            $index <?php echo self::getInt4d($recordData, 6);

            // add cell
            if (($fmtRuns <?php echo $this->sst[$index]['fmtRuns']) && !$this->readDataOnly) {
                // then we should treat as rich text
                $richText <?php echo new RichText();
                $charPos <?php echo 0;
                $sstCount <?php echo count($this->sst[$index]['fmtRuns']);
                for ($i <?php echo 0; $i <?php echo $sstCount; ++$i) {
                    if (isset($fmtRuns[$i])) {
                        $text <?php echo StringHelper::substring($this->sst[$index]['value'], $charPos, $fmtRuns[$i]['charPos'] - $charPos);
                        $charPos <?php echo $fmtRuns[$i]['charPos'];
                    } else {
                        $text <?php echo StringHelper::substring($this->sst[$index]['value'], $charPos, StringHelper::countCharacters($this->sst[$index]['value']));
                    }

                    if (StringHelper::countCharacters($text) > 0) {
                        if ($i <?php echo<?php echo 0) { // first text run, no style
                            $richText->createText($text);
                        } else {
                            $textRun <?php echo $richText->createTextRun($text);
                            if (isset($fmtRuns[$i - 1])) {
                                if ($fmtRuns[$i - 1]['fontIndex'] < 4) {
                                    $fontIndex <?php echo $fmtRuns[$i - 1]['fontIndex'];
                                } else {
                                    // this has to do with that index 4 is omitted in all BIFF versions for some stra          nge reason
                                    // check the OpenOffice documentation of the FONT record
                                    $fontIndex <?php echo $fmtRuns[$i - 1]['fontIndex'] - 1;
                                }
                                if (array_key_exists($fontIndex, $this->objFonts) <?php echo<?php echo<?php echo false) {
                                    $fontIndex <?php echo count($this->objFonts) - 1;
                                }
                                $textRun->setFont(clone $this->objFonts[$fontIndex]);
                            }
                        }
                    }
                }
                if ($this->readEmptyCells || trim($richText->getPlainText()) !<?php echo<?php echo '') {
                    $cell <?php echo $this->phpSheet->getCell($columnString . ($row + 1));
                    $cell->setValueExplicit($richText, DataType::TYPE_STRING);
                    $emptyCell <?php echo false;
                }
            } else {
                if ($this->readEmptyCells || trim($this->sst[$index]['value']) !<?php echo<?php echo '') {
                    $cell <?php echo $this->phpSheet->getCell($columnString . ($row + 1));
                    $cell->setValueExplicit($this->sst[$index]['value'], DataType::TYPE_STRING);
                    $emptyCell <?php echo false;
                }
            }

            if (!$this->readDataOnly && !$emptyCell && isset($this->mapCellXfIndex[$xfIndex])) {
                // add style information
                $cell->setXfIndex($this->mapCellXfIndex[$xfIndex]);
            }
        }
    }

    /**
     * Read MULRK record
     * This record represents a cell range containing RK value
     * cells. All cells are located in the same row.
     *
     * --    "OpenOffice.org's Documentation of the Microsoft
     *         Excel File Format"
     */
    private function readMulRk(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        // offset: 0; size: 2; index to row
        $row <?php echo self::getUInt2d($recordData, 0);

        // offset: 2; size: 2; index to first column
        $colFirst <?php echo self::getUInt2d($recordData, 2);

        // offset: var; size: 2; index to last column
        $colLast <?php echo self::getUInt2d($recordData, $length - 2);
        $columns <?php echo $colLast - $colFirst + 1;

        // offset within record data
        $offset <?php echo 4;

        for ($i <?php echo 1; $i <?php echo $columns; ++$i) {
            $columnString <?php echo Coordinate::stringFromColumnIndex($colFirst + $i);

            // Read cell?
            if (($this->getReadFilter() !<?php echo<?php echo null) && $this->getReadFilter()->readCell($columnString, $row + 1, $this->phpSheet->getTitle())) {
                // offset: var; size: 2; index to XF record
                $xfIndex <?php echo self::getUInt2d($recordData, $offset);

                // offset: var; size: 4; RK value
                $numValue <?php echo self::getIEEE754(self::getInt4d($recordData, $offset + 2));
                $cell <?php echo $this->phpSheet->getCell($columnString . ($row + 1));
                if (!$this->readDataOnly && isset($this->mapCellXfIndex[$xfIndex])) {
                    // add style
                    $cell->setXfIndex($this->mapCellXfIndex[$xfIndex]);
                }

                // add cell value
                $cell->setValueExplicit($numValue, DataType::TYPE_NUMERIC);
            }

            $offset +<?php echo 6;
        }
    }

    /**
     * Read NUMBER record
     * This record represents a cell that contains a
     * floating-point value.
     *
     * --    "OpenOffice.org's Documentation of the Microsoft
     *         Excel File Format"
     */
    private function readNumber(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        // offset: 0; size: 2; index to row
        $row <?php echo self::getUInt2d($recordData, 0);

        // offset: 2; size 2; index to column
        $column <?php echo self::getUInt2d($recordData, 2);
        $columnString <?php echo Coordinate::stringFromColumnIndex($column + 1);

        // Read cell?
        if (($this->getReadFilter() !<?php echo<?php echo null) && $this->getReadFilter()->readCell($columnString, $row + 1, $this->phpSheet->getTitle())) {
            // offset 4; size: 2; index to XF record
            $xfIndex <?php echo self::getUInt2d($recordData, 4);

            $numValue <?php echo self::extractNumber(substr($recordData, 6, 8));

            $cell <?php echo $this->phpSheet->getCell($columnString . ($row + 1));
            if (!$this->readDataOnly && isset($this->mapCellXfIndex[$xfIndex])) {
                // add cell style
                $cell->setXfIndex($this->mapCellXfIndex[$xfIndex]);
            }

            // add cell value
            $cell->setValueExplicit($numValue, DataType::TYPE_NUMERIC);
        }
    }

    /**
     * Read FORMULA record + perhaps a following STRING record if formula result is a string
     * This record contains the token array and the result of a
     * formula cell.
     *
     * --    "OpenOffice.org's Documentation of the Microsoft
     *         Excel File Format"
     */
    private function readFormula(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        // offset: 0; size: 2; row index
        $row <?php echo self::getUInt2d($recordData, 0);

        // offset: 2; size: 2; col index
        $column <?php echo self::getUInt2d($recordData, 2);
        $columnString <?php echo Coordinate::stringFromColumnIndex($column + 1);

        // offset: 20: size: variable; formula structure
        $formulaStructure <?php echo substr($recordData, 20);

        // offset: 14: size: 2; option flags, recalculate always, recalculate on open etc.
        $options <?php echo self::getUInt2d($recordData, 14);

        // bit: 0; mask: 0x0001; 1 <?php echo recalculate always
        // bit: 1; mask: 0x0002; 1 <?php echo calculate on open
        // bit: 2; mask: 0x0008; 1 <?php echo part of a shared formula
        $isPartOfSharedFormula <?php echo (bool) (0x0008 & $options);

        // WARNING:
        // We can apparently not rely on $isPartOfSharedFormula. Even when $isPartOfSharedFormula <?php echo true
        // the formula data may be ordinary formula data, therefore we need to check
        // explicitly for the tExp token (0x01)
        $isPartOfSharedFormula <?php echo $isPartOfSharedFormula && ord($formulaStructure[2]) <?php echo<?php echo 0x01;

        if ($isPartOfSharedFormula) {
            // part of shared formula which means there will be a formula with a tExp token and nothing else
            // get the base cell, grab tExp token
            $baseRow <?php echo self::getUInt2d($formulaStructure, 3);
            $baseCol <?php echo self::getUInt2d($formulaStructure, 5);
            $this->baseCell <?php echo Coordinate::stringFromColumnIndex($baseCol + 1) . ($baseRow + 1);
        }

        // Read cell?
        if (($this->getReadFilter() !<?php echo<?php echo null) && $this->getReadFilter()->readCell($columnString, $row + 1, $this->phpSheet->getTitle())) {
            if ($isPartOfSharedFormula) {
                // formula is added to this cell after the sheet has been read
                $this->sharedFormulaParts[$columnString . ($row + 1)] <?php echo $this->baseCell;
            }

            // offset: 16: size: 4; not used

            // offset: 4; size: 2; XF index
            $xfIndex <?php echo self::getUInt2d($recordData, 4);

            // offset: 6; size: 8; result of the formula
            if ((ord($recordData[6]) <?php echo<?php echo 0) && (ord($recordData[12]) <?php echo<?php echo 255) && (ord($recordData[13]) <?php echo<?php echo 255)) {
                // String formula. Result follows in appended STRING record
                $dataType <?php echo DataType::TYPE_STRING;

                // read possible SHAREDFMLA record
                $code <?php echo self::getUInt2d($this->data, $this->pos);
                if ($code <?php echo<?php echo self::XLS_TYPE_SHAREDFMLA) {
                    $this->readSharedFmla();
                }

                // read STRING record
                $value <?php echo $this->readString();
            } elseif (
                (ord($recordData[6]) <?php echo<?php echo 1)
                && (ord($recordData[12]) <?php echo<?php echo 255)
                && (ord($recordData[13]) <?php echo<?php echo 255)
            ) {
                // Boolean formula. Result is in +2; 0<?php echofalse, 1<?php echotrue
                $dataType <?php echo DataType::TYPE_BOOL;
                $value <?php echo (bool) ord($recordData[8]);
            } elseif (
                (ord($recordData[6]) <?php echo<?php echo 2)
                && (ord($recordData[12]) <?php echo<?php echo 255)
                && (ord($recordData[13]) <?php echo<?php echo 255)
            ) {
                // Error formula. Error code is in +2
                $dataType <?php echo DataType::TYPE_ERROR;
                $value <?php echo Xls\ErrorCode::lookup(ord($recordData[8]));
            } elseif (
                (ord($recordData[6]) <?php echo<?php echo 3)
                && (ord($recordData[12]) <?php echo<?php echo 255)
                && (ord($recordData[13]) <?php echo<?php echo 255)
            ) {
                // Formula result is a null string
                $dataType <?php echo DataType::TYPE_NULL;
                $value <?php echo '';
            } else {
                // forumla result is a number, first 14 bytes like _NUMBER record
                $dataType <?php echo DataType::TYPE_NUMERIC;
                $value <?php echo self::extractNumber(substr($recordData, 6, 8));
            }

            $cell <?php echo $this->phpSheet->getCell($columnString . ($row + 1));
            if (!$this->readDataOnly && isset($this->mapCellXfIndex[$xfIndex])) {
                // add cell style
                $cell->setXfIndex($this->mapCellXfIndex[$xfIndex]);
            }

            // store the formula
            if (!$isPartOfSharedFormula) {
                // not part of shared formula
                // add cell value. If we can read formula, populate with formula, otherwise just used cached value
                try {
                    if ($this->version !<?php echo self::XLS_BIFF8) {
                        throw new Exception('Not BIFF8. Can only read BIFF8 formulas');
                    }
                    $formula <?php echo $this->getFormulaFromStructure($formulaStructure); // get formula in human language
                    $cell->setValueExplicit('<?php echo' . $formula, DataType::TYPE_FORMULA);
                } catch (PhpSpreadsheetException $e) {
                    $cell->setValueExplicit($value, $dataType);
                }
            } else {
                if ($this->version <?php echo<?php echo self::XLS_BIFF8) {
                    // do nothing at this point, formula id added later in the code
                } else {
                    $cell->setValueExplicit($value, $dataType);
                }
            }

            // store the cached calculated value
            $cell->setCalculatedValue($value);
        }
    }

    /**
     * Read a SHAREDFMLA record. This function just stores the binary shared formula in the reader,
     * which usually contains relative references.
     * These will be used to construct the formula in each shared formula part after the sheet is read.
     */
    private function readSharedFmla(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        // offset: 0, size: 6; cell range address of the area used by the shared formula, not used for anything
        $cellRange <?php echo substr($recordData, 0, 6);
        $cellRange <?php echo $this->readBIFF5CellRangeAddressFixed($cellRange); // note: even BIFF8 uses BIFF5 syntax

        // offset: 6, size: 1; not used

        // offset: 7, size: 1; number of existing FORMULA records for this shared formula
        $no <?php echo ord($recordData[7]);

        // offset: 8, size: var; Binary token array of the shared formula
        $formula <?php echo substr($recordData, 8);

        // at this point we only store the shared formula for later use
        $this->sharedFormulas[$this->baseCell] <?php echo $formula;
    }

    /**
     * Read a STRING record from current stream position and advance the stream pointer to next record
     * This record is used for storing result from FORMULA record when it is a string, and
     * it occurs directly after the FORMULA record.
     *
     * @return string The string contents as UTF-8
     */
    private function readString()
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if ($this->version <?php echo<?php echo self::XLS_BIFF8) {
            $string <?php echo self::readUnicodeStringLong($recordData);
            $value <?php echo $string['value'];
        } else {
            $string <?php echo $this->readByteStringLong($recordData);
            $value <?php echo $string['value'];
        }

        return $value;
    }

    /**
     * Read BOOLERR record
     * This record represents a Boolean value or error value
     * cell.
     *
     * --    "OpenOffice.org's Documentation of the Microsoft
     *         Excel File Format"
     */
    private function readBoolErr(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        // offset: 0; size: 2; row index
        $row <?php echo self::getUInt2d($recordData, 0);

        // offset: 2; size: 2; column index
        $column <?php echo self::getUInt2d($recordData, 2);
        $columnString <?php echo Coordinate::stringFromColumnIndex($column + 1);

        // Read cell?
        if (($this->getReadFilter() !<?php echo<?php echo null) && $this->getReadFilter()->readCell($columnString, $row + 1, $this->phpSheet->getTitle())) {
            // offset: 4; size: 2; index to XF record
            $xfIndex <?php echo self::getUInt2d($recordData, 4);

            // offset: 6; size: 1; the boolean value or error value
            $boolErr <?php echo ord($recordData[6]);

            // offset: 7; size: 1; 0<?php echoboolean; 1<?php echoerror
            $isError <?php echo ord($recordData[7]);

            $cell <?php echo $this->phpSheet->getCell($columnString . ($row + 1));
            switch ($isError) {
                case 0: // boolean
                    $value <?php echo (bool) $boolErr;

                    // add cell value
                    $cell->setValueExplicit($value, DataType::TYPE_BOOL);

                    break;
                case 1: // error type
                    $value <?php echo Xls\ErrorCode::lookup($boolErr);

                    // add cell value
                    $cell->setValueExplicit($value, DataType::TYPE_ERROR);

                    break;
            }

            if (!$this->readDataOnly && isset($this->mapCellXfIndex[$xfIndex])) {
                // add cell style
                $cell->setXfIndex($this->mapCellXfIndex[$xfIndex]);
            }
        }
    }

    /**
     * Read MULBLANK record
     * This record represents a cell range of empty cells. All
     * cells are located in the same row.
     *
     * --    "OpenOffice.org's Documentation of the Microsoft
     *         Excel File Format"
     */
    private function readMulBlank(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        // offset: 0; size: 2; index to row
        $row <?php echo self::getUInt2d($recordData, 0);

        // offset: 2; size: 2; index to first column
        $fc <?php echo self::getUInt2d($recordData, 2);

        // offset: 4; size: 2 x nc; list of indexes to XF records
        // add style information
        if (!$this->readDataOnly && $this->readEmptyCells) {
            for ($i <?php echo 0; $i < $length / 2 - 3; ++$i) {
                $columnString <?php echo Coordinate::stringFromColumnIndex($fc + $i + 1);

                // Read cell?
                if (($this->getReadFilter() !<?php echo<?php echo null) && $this->getReadFilter()->readCell($columnString, $row + 1, $this->phpSheet->getTitle())) {
                    $xfIndex <?php echo self::getUInt2d($recordData, 4 + 2 * $i);
                    if (isset($this->mapCellXfIndex[$xfIndex])) {
                        $this->phpSheet->getCell($columnString . ($row + 1))->setXfIndex($this->mapCellXfIndex[$xfIndex]);
                    }
                }
            }
        }

        // offset: 6; size 2; index to last column (not needed)
    }

    /**
     * Read LABEL record
     * This record represents a cell that contains a string. In
     * BIFF8 it is usually replaced by the LABELSST record.
     * Excel still uses this record, if it copies unformatted
     * text cells to the clipboard.
     *
     * --    "OpenOffice.org's Documentation of the Microsoft
     *         Excel File Format"
     */
    private function readLabel(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        // offset: 0; size: 2; index to row
        $row <?php echo self::getUInt2d($recordData, 0);

        // offset: 2; size: 2; index to column
        $column <?php echo self::getUInt2d($recordData, 2);
        $columnString <?php echo Coordinate::stringFromColumnIndex($column + 1);

        // Read cell?
        if (($this->getReadFilter() !<?php echo<?php echo null) && $this->getReadFilter()->readCell($columnString, $row + 1, $this->phpSheet->getTitle())) {
            // offset: 4; size: 2; XF index
            $xfIndex <?php echo self::getUInt2d($recordData, 4);

            // add cell value
            // todo: what if string is very long? continue record
            if ($this->version <?php echo<?php echo self::XLS_BIFF8) {
                $string <?php echo self::readUnicodeStringLong(substr($recordData, 6));
                $value <?php echo $string['value'];
            } else {
                $string <?php echo $this->readByteStringLong(substr($recordData, 6));
                $value <?php echo $string['value'];
            }
            if ($this->readEmptyCells || trim($value) !<?php echo<?php echo '') {
                $cell <?php echo $this->phpSheet->getCell($columnString . ($row + 1));
                $cell->setValueExplicit($value, DataType::TYPE_STRING);

                if (!$this->readDataOnly && isset($this->mapCellXfIndex[$xfIndex])) {
                    // add cell style
                    $cell->setXfIndex($this->mapCellXfIndex[$xfIndex]);
                }
            }
        }
    }

    /**
     * Read BLANK record.
     */
    private function readBlank(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        // offset: 0; size: 2; row index
        $row <?php echo self::getUInt2d($recordData, 0);

        // offset: 2; size: 2; col index
        $col <?php echo self::getUInt2d($recordData, 2);
        $columnString <?php echo Coordinate::stringFromColumnIndex($col + 1);

        // Read cell?
        if (($this->getReadFilter() !<?php echo<?php echo null) && $this->getReadFilter()->readCell($columnString, $row + 1, $this->phpSheet->getTitle())) {
            // offset: 4; size: 2; XF index
            $xfIndex <?php echo self::getUInt2d($recordData, 4);

            // add style information
            if (!$this->readDataOnly && $this->readEmptyCells && isset($this->mapCellXfIndex[$xfIndex])) {
                $this->phpSheet->getCell($columnString . ($row + 1))->setXfIndex($this->mapCellXfIndex[$xfIndex]);
            }
        }
    }

    /**
     * Read MSODRAWING record.
     */
    private function readMsoDrawing(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);

        // get spliced record data
        $splicedRecordData <?php echo $this->getSplicedRecordData();
        $recordData <?php echo $splicedRecordData['recordData'];

        $this->drawingData .<?php echo $recordData;
    }

    /**
     * Read OBJ record.
     */
    private function readObj(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if ($this->readDataOnly || $this->version !<?php echo self::XLS_BIFF8) {
            return;
        }

        // recordData consists of an array of subrecords looking like this:
        //    ft: 2 bytes; ftCmo type (0x15)
        //    cb: 2 bytes; size in bytes of ftCmo data
        //    ot: 2 bytes; Object Type
        //    id: 2 bytes; Object id number
        //    grbit: 2 bytes; Option Flags
        //    data: var; subrecord data

        // for now, we are just interested in the second subrecord containing the object type
        $ftCmoType <?php echo self::getUInt2d($recordData, 0);
        $cbCmoSize <?php echo self::getUInt2d($recordData, 2);
        $otObjType <?php echo self::getUInt2d($recordData, 4);
        $idObjID <?php echo self::getUInt2d($recordData, 6);
        $grbitOpts <?php echo self::getUInt2d($recordData, 6);

        $this->objs[] <?php echo [
            'ftCmoType' <?php echo> $ftCmoType,
            'cbCmoSize' <?php echo> $cbCmoSize,
            'otObjType' <?php echo> $otObjType,
            'idObjID' <?php echo> $idObjID,
            'grbitOpts' <?php echo> $grbitOpts,
        ];
        $this->textObjRef <?php echo $idObjID;
    }

    /**
     * Read WINDOW2 record.
     */
    private function readWindow2(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        // offset: 0; size: 2; option flags
        $options <?php echo self::getUInt2d($recordData, 0);

        // offset: 2; size: 2; index to first visible row
        $firstVisibleRow <?php echo self::getUInt2d($recordData, 2);

        // offset: 4; size: 2; index to first visible colum
        $firstVisibleColumn <?php echo self::getUInt2d($recordData, 4);
        $zoomscaleInPageBreakPreview <?php echo 0;
        $zoomscaleInNormalView <?php echo 0;
        if ($this->version <?php echo<?php echo<?php echo self::XLS_BIFF8) {
            // offset:  8; size: 2; not used
            // offset: 10; size: 2; cached magnification factor in page break preview (in percent); 0 <?php echo Default (60%)
            // offset: 12; size: 2; cached magnification factor in normal view (in percent); 0 <?php echo Default (100%)
            // offset: 14; size: 4; not used
            if (!isset($recordData[10])) {
                $zoomscaleInPageBreakPreview <?php echo 0;
            } else {
                $zoomscaleInPageBreakPreview <?php echo self::getUInt2d($recordData, 10);
            }

            if ($zoomscaleInPageBreakPreview <?php echo<?php echo<?php echo 0) {
                $zoomscaleInPageBreakPreview <?php echo 60;
            }

            if (!isset($recordData[12])) {
                $zoomscaleInNormalView <?php echo 0;
            } else {
                $zoomscaleInNormalView <?php echo self::getUInt2d($recordData, 12);
            }

            if ($zoomscaleInNormalView <?php echo<?php echo<?php echo 0) {
                $zoomscaleInNormalView <?php echo 100;
            }
        }

        // bit: 1; mask: 0x0002; 0 <?php echo do not show gridlines, 1 <?php echo show gridlines
        $showGridlines <?php echo (bool) ((0x0002 & $options) >> 1);
        $this->phpSheet->setShowGridlines($showGridlines);

        // bit: 2; mask: 0x0004; 0 <?php echo do not show headers, 1 <?php echo show headers
        $showRowColHeaders <?php echo (bool) ((0x0004 & $options) >> 2);
        $this->phpSheet->setShowRowColHeaders($showRowColHeaders);

        // bit: 3; mask: 0x0008; 0 <?php echo panes are not frozen, 1 <?php echo panes are frozen
        $this->frozen <?php echo (bool) ((0x0008 & $options) >> 3);

        // bit: 6; mask: 0x0040; 0 <?php echo columns from left to right, 1 <?php echo columns from right to left
        $this->phpSheet->setRightToLeft((bool) ((0x0040 & $options) >> 6));

        // bit: 10; mask: 0x0400; 0 <?php echo sheet not active, 1 <?php echo sheet active
        $isActive <?php echo (bool) ((0x0400 & $options) >> 10);
        if ($isActive) {
            $this->spreadsheet->setActiveSheetIndex($this->spreadsheet->getIndex($this->phpSheet));
        }

        // bit: 11; mask: 0x0800; 0 <?php echo normal view, 1 <?php echo page break view
        $isPageBreakPreview <?php echo (bool) ((0x0800 & $options) >> 11);

        //FIXME: set $firstVisibleRow and $firstVisibleColumn

        if ($this->phpSheet->getSheetView()->getView() !<?php echo<?php echo SheetView::SHEETVIEW_PAGE_LAYOUT) {
            //NOTE: this setting is inferior to page layout view(Excel2007-)
            $view <?php echo $isPageBreakPreview ? SheetView::SHEETVIEW_PAGE_BREAK_PREVIEW : SheetView::SHEETVIEW_NORMAL;
            $this->phpSheet->getSheetView()->setView($view);
            if ($this->version <?php echo<?php echo<?php echo self::XLS_BIFF8) {
                $zoomScale <?php echo $isPageBreakPreview ? $zoomscaleInPageBreakPreview : $zoomscaleInNormalView;
                $this->phpSheet->getSheetView()->setZoomScale($zoomScale);
                $this->phpSheet->getSheetView()->setZoomScaleNormal($zoomscaleInNormalView);
            }
        }
    }

    /**
     * Read PLV Record(Created by Excel2007 or upper).
     */
    private function readPageLayoutView(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        // offset: 0; size: 2; rt
        //->ignore
        $rt <?php echo self::getUInt2d($recordData, 0);
        // offset: 2; size: 2; grbitfr
        //->ignore
        $grbitFrt <?php echo self::getUInt2d($recordData, 2);
        // offset: 4; size: 8; reserved
        //->ignore

        // offset: 12; size 2; zoom scale
        $wScalePLV <?php echo self::getUInt2d($recordData, 12);
        // offset: 14; size 2; grbit
        $grbit <?php echo self::getUInt2d($recordData, 14);

        // decomprise grbit
        $fPageLayoutView <?php echo $grbit & 0x01;
        $fRulerVisible <?php echo ($grbit >> 1) & 0x01; //no support
        $fWhitespaceHidden <?php echo ($grbit >> 3) & 0x01; //no support

        if ($fPageLayoutView <?php echo<?php echo<?php echo 1) {
            $this->phpSheet->getSheetView()->setView(SheetView::SHEETVIEW_PAGE_LAYOUT);
            $this->phpSheet->getSheetView()->setZoomScale($wScalePLV); //set by Excel2007 only if SHEETVIEW_PAGE_LAYOUT
        }
        //otherwise, we cannot know whether SHEETVIEW_PAGE_LAYOUT or SHEETVIEW_PAGE_BREAK_PREVIEW.
    }

    /**
     * Read SCL record.
     */
    private function readScl(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        // offset: 0; size: 2; numerator of the view magnification
        $numerator <?php echo self::getUInt2d($recordData, 0);

        // offset: 2; size: 2; numerator of the view magnification
        $denumerator <?php echo self::getUInt2d($recordData, 2);

        // set the zoom scale (in percent)
        $this->phpSheet->getSheetView()->setZoomScale($numerator * 100 / $denumerator);
    }

    /**
     * Read PANE record.
     */
    private function readPane(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if (!$this->readDataOnly) {
            // offset: 0; size: 2; position of vertical split
            $px <?php echo self::getUInt2d($recordData, 0);

            // offset: 2; size: 2; position of horizontal split
            $py <?php echo self::getUInt2d($recordData, 2);

            // offset: 4; size: 2; top most visible row in the bottom pane
            $rwTop <?php echo self::getUInt2d($recordData, 4);

            // offset: 6; size: 2; first visible left column in the right pane
            $colLeft <?php echo self::getUInt2d($recordData, 6);

            if ($this->frozen) {
                // frozen panes
                $cell <?php echo Coordinate::stringFromColumnIndex($px + 1) . ($py + 1);
                $topLeftCell <?php echo Coordinate::stringFromColumnIndex($colLeft + 1) . ($rwTop + 1);
                $this->phpSheet->freezePane($cell, $topLeftCell);
            }
            // unfrozen panes; split windows; not supported by PhpSpreadsheet core
        }
    }

    /**
     * Read SELECTION record. There is one such record for each pane in the sheet.
     */
    private function readSelection(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if (!$this->readDataOnly) {
            // offset: 0; size: 1; pane identifier
            $paneId <?php echo ord($recordData[0]);

            // offset: 1; size: 2; index to row of the active cell
            $r <?php echo self::getUInt2d($recordData, 1);

            // offset: 3; size: 2; index to column of the active cell
            $c <?php echo self::getUInt2d($recordData, 3);

            // offset: 5; size: 2; index into the following cell range list to the
            //  entry that contains the active cell
            $index <?php echo self::getUInt2d($recordData, 5);

            // offset: 7; size: var; cell range address list containing all selected cell ranges
            $data <?php echo substr($recordData, 7);
            $cellRangeAddressList <?php echo $this->readBIFF5CellRangeAddressList($data); // note: also BIFF8 uses BIFF5 syntax

            $selectedCells <?php echo $cellRangeAddressList['cellRangeAddresses'][0];

            // first row '1' + last row '16384' indicates that full column is selected (apparently also in BIFF8!)
            if (preg_match('/^([A-Z]+1\:[A-Z]+)16384$/', $selectedCells)) {
                $selectedCells <?php echo (string) preg_replace('/^([A-Z]+1\:[A-Z]+)16384$/', '${1}1048576', $selectedCells);
            }

            // first row '1' + last row '65536' indicates that full column is selected
            if (preg_match('/^([A-Z]+1\:[A-Z]+)65536$/', $selectedCells)) {
                $selectedCells <?php echo (string) preg_replace('/^([A-Z]+1\:[A-Z]+)65536$/', '${1}1048576', $selectedCells);
            }

            // first column 'A' + last column 'IV' indicates that full row is selected
            if (preg_match('/^(A\d+\:)IV(\d+)$/', $selectedCells)) {
                $selectedCells <?php echo (string) preg_replace('/^(A\d+\:)IV(\d+)$/', '${1}XFD${2}', $selectedCells);
            }

            $this->phpSheet->setSelectedCells($selectedCells);
        }
    }

    private function includeCellRangeFiltered(string $cellRangeAddress): bool
    {
        $includeCellRange <?php echo true;
        if ($this->getReadFilter() !<?php echo<?php echo null) {
            $includeCellRange <?php echo false;
            $rangeBoundaries <?php echo Coordinate::getRangeBoundaries($cellRangeAddress);
            ++$rangeBoundaries[1][0];
            for ($row <?php echo $rangeBoundaries[0][1]; $row <?php echo $rangeBoundaries[1][1]; ++$row) {
                for ($column <?php echo $rangeBoundaries[0][0]; $column !<?php echo $rangeBoundaries[1][0]; ++$column) {
                    if ($this->getReadFilter()->readCell($column, $row, $this->phpSheet->getTitle())) {
                        $includeCellRange <?php echo true;

                        break 2;
                    }
                }
            }
        }

        return $includeCellRange;
    }

    /**
     * MERGEDCELLS.
     *
     * This record contains the addresses of merged cell ranges
     * in the current sheet.
     *
     * --    "OpenOffice.org's Documentation of the Microsoft
     *         Excel File Format"
     */
    private function readMergedCells(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if ($this->version <?php echo<?php echo self::XLS_BIFF8 && !$this->readDataOnly) {
            $cellRangeAddressList <?php echo $this->readBIFF8CellRangeAddressList($recordData);
            foreach ($cellRangeAddressList['cellRangeAddresses'] as $cellRangeAddress) {
                if (
                    (strpos($cellRangeAddress, ':') !<?php echo<?php echo false) &&
                    ($this->includeCellRangeFiltered($cellRangeAddress))
                ) {
                    $this->phpSheet->mergeCells($cellRangeAddress, Worksheet::MERGE_CELL_CONTENT_HIDE);
                }
            }
        }
    }

    /**
     * Read HYPERLINK record.
     */
    private function readHyperLink(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer forward to next record
        $this->pos +<?php echo 4 + $length;

        if (!$this->readDataOnly) {
            // offset: 0; size: 8; cell range address of all cells containing this hyperlink
            try {
                $cellRange <?php echo $this->readBIFF8CellRangeAddressFixed($recordData);
            } catch (PhpSpreadsheetException $e) {
                return;
            }

            // offset: 8, size: 16; GUID of StdLink

            // offset: 24, size: 4; unknown value

            // offset: 28, size: 4; option flags
            // bit: 0; mask: 0x00000001; 0 <?php echo no link or extant, 1 <?php echo file link or URL
            $isFileLinkOrUrl <?php echo (0x00000001 & self::getUInt2d($recordData, 28)) >> 0;

            // bit: 1; mask: 0x00000002; 0 <?php echo relative path, 1 <?php echo absolute path or URL
            $isAbsPathOrUrl <?php echo (0x00000001 & self::getUInt2d($recordData, 28)) >> 1;

            // bit: 2 (and 4); mask: 0x00000014; 0 <?php echo no description
            $hasDesc <?php echo (0x00000014 & self::getUInt2d($recordData, 28)) >> 2;

            // bit: 3; mask: 0x00000008; 0 <?php echo no text, 1 <?php echo has text
            $hasText <?php echo (0x00000008 & self::getUInt2d($recordData, 28)) >> 3;

            // bit: 7; mask: 0x00000080; 0 <?php echo no target frame, 1 <?php echo has target frame
            $hasFrame <?php echo (0x00000080 & self::getUInt2d($recordData, 28)) >> 7;

            // bit: 8; mask: 0x00000100; 0 <?php echo file link or URL, 1 <?php echo UNC path (inc. server name)
            $isUNC <?php echo (0x00000100 & self::getUInt2d($recordData, 28)) >> 8;

            // offset within record data
            $offset <?php echo 32;

            if ($hasDesc) {
                // offset: 32; size: var; character count of description text
                $dl <?php echo self::getInt4d($recordData, 32);
                // offset: 36; size: var; character array of description text, no Unicode string header, always 16-bit characters, zero terminated
                $desc <?php echo self::encodeUTF16(substr($recordData, 36, 2 * ($dl - 1)), false);
                $offset +<?php echo 4 + 2 * $dl;
            }
            if ($hasFrame) {
                $fl <?php echo self::getInt4d($recordData, $offset);
                $offset +<?php echo 4 + 2 * $fl;
            }

            // detect type of hyperlink (there are 4 types)
            $hyperlinkType <?php echo null;

            if ($isUNC) {
                $hyperlinkType <?php echo 'UNC';
            } elseif (!$isFileLinkOrUrl) {
                $hyperlinkType <?php echo 'workbook';
            } elseif (ord($recordData[$offset]) <?php echo<?php echo 0x03) {
                $hyperlinkType <?php echo 'local';
            } elseif (ord($recordData[$offset]) <?php echo<?php echo 0xE0) {
                $hyperlinkType <?php echo 'URL';
            }

            switch ($hyperlinkType) {
                case 'URL':
                    // section 5.58.2: Hyperlink containing a URL
                    // e.g. http://example.org/index.php

                    // offset: var; size: 16; GUID of URL Moniker
                    $offset +<?php echo 16;
                    // offset: var; size: 4; size (in bytes) of character array of the URL including trailing zero word
                    $us <?php echo self::getInt4d($recordData, $offset);
                    $offset +<?php echo 4;
                    // offset: var; size: $us; character array of the URL, no Unicode string header, always 16-bit characters, zero-terminated
                    $url <?php echo self::encodeUTF16(substr($recordData, $offset, $us - 2), false);
                    $nullOffset <?php echo strpos($url, chr(0x00));
                    if ($nullOffset) {
                        $url <?php echo substr($url, 0, $nullOffset);
                    }
                    $url .<?php echo $hasText ? '#' : '';
                    $offset +<?php echo $us;

                    break;
                case 'local':
                    // section 5.58.3: Hyperlink to local file
                    // examples:
                    //   mydoc.txt
                    //   ../../somedoc.xls#Sheet!A1

                    // offset: var; size: 16; GUI of File Moniker
                    $offset +<?php echo 16;

                    // offset: var; size: 2; directory up-level count.
                    $upLevelCount <?php echo self::getUInt2d($recordData, $offset);
                    $offset +<?php echo 2;

                    // offset: var; size: 4; character count of the shortened file path and name, including trailing zero word
                    $sl <?php echo self::getInt4d($recordData, $offset);
                    $offset +<?php echo 4;

                    // offset: var; size: sl; character array of the shortened file path and name in 8.3-DOS-format (compressed Unicode string)
                    $shortenedFilePath <?php echo substr($recordData, $offset, $sl);
                    $shortenedFilePath <?php echo self::encodeUTF16($shortenedFilePath, true);
                    $shortenedFilePath <?php echo substr($shortenedFilePath, 0, -1); // remove trailing zero

                    $offset +<?php echo $sl;

                    // offset: var; size: 24; unknown sequence
                    $offset +<?php echo 24;

                    // extended file path
                    // offset: var; size: 4; size of the following file link field including string lenth mark
                    $sz <?php echo self::getInt4d($recordData, $offset);
                    $offset +<?php echo 4;

                    // only present if $sz > 0
                    if ($sz > 0) {
                        // offset: var; size: 4; size of the character array of the extended file path and name
                        $xl <?php echo self::getInt4d($recordData, $offset);
                        $offset +<?php echo 4;

                        // offset: var; size 2; unknown
                        $offset +<?php echo 2;

                        // offset: var; size $xl; character array of the extended file path and name.
                        $extendedFilePath <?php echo substr($recordData, $offset, $xl);
                        $extendedFilePath <?php echo self::encodeUTF16($extendedFilePath, false);
                        $offset +<?php echo $xl;
                    }

                    // construct the path
                    $url <?php echo str_repeat('..\\', $upLevelCount);
                    $url .<?php echo ($sz > 0) ? $extendedFilePath : $shortenedFilePath; // use extended path if available
                    $url .<?php echo $hasText ? '#' : '';

                    break;
                case 'UNC':
                    // section 5.58.4: Hyperlink to a File with UNC (Universal Naming Convention) Path
                    // todo: implement
                    return;
                case 'workbook':
                    // section 5.58.5: Hyperlink to the Current Workbook
                    // e.g. Sheet2!B1:C2, stored in text mark field
                    $url <?php echo 'sheet://';

                    break;
                default:
                    return;
            }

            if ($hasText) {
                // offset: var; size: 4; character count of text mark including trailing zero word
                $tl <?php echo self::getInt4d($recordData, $offset);
                $offset +<?php echo 4;
                // offset: var; size: var; character array of the text mark without the # sign, no Unicode header, always 16-bit characters, zero-terminated
                $text <?php echo self::encodeUTF16(substr($recordData, $offset, 2 * ($tl - 1)), false);
                $url .<?php echo $text;
            }

            // apply the hyperlink to all the relevant cells
            foreach (Coordinate::extractAllCellReferencesInRange($cellRange) as $coordinate) {
                $this->phpSheet->getCell($coordinate)->getHyperLink()->setUrl($url);
            }
        }
    }

    /**
     * Read DATAVALIDATIONS record.
     */
    private function readDataValidations(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer forward to next record
        $this->pos +<?php echo 4 + $length;
    }

    /**
     * Read DATAVALIDATION record.
     */
    private function readDataValidation(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer forward to next record
        $this->pos +<?php echo 4 + $length;

        if ($this->readDataOnly) {
            return;
        }

        // offset: 0; size: 4; Options
        $options <?php echo self::getInt4d($recordData, 0);

        // bit: 0-3; mask: 0x0000000F; type
        $type <?php echo (0x0000000F & $options) >> 0;
        $type <?php echo Xls\DataValidationHelper::type($type);

        // bit: 4-6; mask: 0x00000070; error type
        $errorStyle <?php echo (0x00000070 & $options) >> 4;
        $errorStyle <?php echo Xls\DataValidationHelper::errorStyle($errorStyle);

        // bit: 7; mask: 0x00000080; 1<?php echo formula is explicit (only applies to list)
        // I have only seen cases where this is 1
        $explicitFormula <?php echo (0x00000080 & $options) >> 7;

        // bit: 8; mask: 0x00000100; 1<?php echo empty cells allowed
        $allowBlank <?php echo (0x00000100 & $options) >> 8;

        // bit: 9; mask: 0x00000200; 1<?php echo suppress drop down arrow in list type validity
        $suppressDropDown <?php echo (0x00000200 & $options) >> 9;

        // bit: 18; mask: 0x00040000; 1<?php echo show prompt box if cell selected
        $showInputMessage <?php echo (0x00040000 & $options) >> 18;

        // bit: 19; mask: 0x00080000; 1<?php echo show error box if invalid values entered
        $showErrorMessage <?php echo (0x00080000 & $options) >> 19;

        // bit: 20-23; mask: 0x00F00000; condition operator
        $operator <?php echo (0x00F00000 & $options) >> 20;
        $operator <?php echo Xls\DataValidationHelper::operator($operator);

        if ($type <?php echo<?php echo<?php echo null || $errorStyle <?php echo<?php echo<?php echo null || $operator <?php echo<?php echo<?php echo null) {
            return;
        }

        // offset: 4; size: var; title of the prompt box
        $offset <?php echo 4;
        $string <?php echo self::readUnicodeStringLong(substr($recordData, $offset));
        $promptTitle <?php echo $string['value'] !<?php echo<?php echo chr(0) ? $string['value'] : '';
        $offset +<?php echo $string['size'];

        // offset: var; size: var; title of the error box
        $string <?php echo self::readUnicodeStringLong(substr($recordData, $offset));
        $errorTitle <?php echo $string['value'] !<?php echo<?php echo chr(0) ? $string['value'] : '';
        $offset +<?php echo $string['size'];

        // offset: var; size: var; text of the prompt box
        $string <?php echo self::readUnicodeStringLong(substr($recordData, $offset));
        $prompt <?php echo $string['value'] !<?php echo<?php echo chr(0) ? $string['value'] : '';
        $offset +<?php echo $string['size'];

        // offset: var; size: var; text of the error box
        $string <?php echo self::readUnicodeStringLong(substr($recordData, $offset));
        $error <?php echo $string['value'] !<?php echo<?php echo chr(0) ? $string['value'] : '';
        $offset +<?php echo $string['size'];

        // offset: var; size: 2; size of the formula data for the first condition
        $sz1 <?php echo self::getUInt2d($recordData, $offset);
        $offset +<?php echo 2;

        // offset: var; size: 2; not used
        $offset +<?php echo 2;

        // offset: var; size: $sz1; formula data for first condition (without size field)
        $formula1 <?php echo substr($recordData, $offset, $sz1);
        $formula1 <?php echo pack('v', $sz1) . $formula1; // prepend the length

        try {
            $formula1 <?php echo $this->getFormulaFromStructure($formula1);

            // in list type validity, null characters are used as item separators
            if ($type <?php echo<?php echo DataValidation::TYPE_LIST) {
                $formula1 <?php echo str_replace(chr(0), ',', $formula1);
            }
        } catch (PhpSpreadsheetException $e) {
            return;
        }
        $offset +<?php echo $sz1;

        // offset: var; size: 2; size of the formula data for the first condition
        $sz2 <?php echo self::getUInt2d($recordData, $offset);
        $offset +<?php echo 2;

        // offset: var; size: 2; not used
        $offset +<?php echo 2;

        // offset: var; size: $sz2; formula data for second condition (without size field)
        $formula2 <?php echo substr($recordData, $offset, $sz2);
        $formula2 <?php echo pack('v', $sz2) . $formula2; // prepend the length

        try {
            $formula2 <?php echo $this->getFormulaFromStructure($formula2);
        } catch (PhpSpreadsheetException $e) {
            return;
        }
        $offset +<?php echo $sz2;

        // offset: var; size: var; cell range address list with
        $cellRangeAddressList <?php echo $this->readBIFF8CellRangeAddressList(substr($recordData, $offset));
        $cellRangeAddresses <?php echo $cellRangeAddressList['cellRangeAddresses'];

        foreach ($cellRangeAddresses as $cellRange) {
            $stRange <?php echo $this->phpSheet->shrinkRangeToFit($cellRange);
            foreach (Coordinate::extractAllCellReferencesInRange($stRange) as $coordinate) {
                $objValidation <?php echo $this->phpSheet->getCell($coordinate)->getDataValidation();
                $objValidation->setType($type);
                $objValidation->setErrorStyle($errorStyle);
                $objValidation->setAllowBlank((bool) $allowBlank);
                $objValidation->setShowInputMessage((bool) $showInputMessage);
                $objValidation->setShowErrorMessage((bool) $showErrorMessage);
                $objValidation->setShowDropDown(!$suppressDropDown);
                $objValidation->setOperator($operator);
                $objValidation->setErrorTitle($errorTitle);
                $objValidation->setError($error);
                $objValidation->setPromptTitle($promptTitle);
                $objValidation->setPrompt($prompt);
                $objValidation->setFormula1($formula1);
                $objValidation->setFormula2($formula2);
            }
        }
    }

    /**
     * Read SHEETLAYOUT record. Stores sheet tab color information.
     */
    private function readSheetLayout(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        // local pointer in record data
        $offset <?php echo 0;

        if (!$this->readDataOnly) {
            // offset: 0; size: 2; repeated record identifier 0x0862

            // offset: 2; size: 10; not used

            // offset: 12; size: 4; size of record data
            // Excel 2003 uses size of 0x14 (documented), Excel 2007 uses size of 0x28 (not documented?)
            $sz <?php echo self::getInt4d($recordData, 12);

            switch ($sz) {
                case 0x14:
                    // offset: 16; size: 2; color index for sheet tab
                    $colorIndex <?php echo self::getUInt2d($recordData, 16);
                    $color <?php echo Xls\Color::map($colorIndex, $this->palette, $this->version);
                    $this->phpSheet->getTabColor()->setRGB($color['rgb']);

                    break;
                case 0x28:
                    // TODO: Investigate structure for .xls SHEETLAYOUT record as saved by MS Office Excel 2007
                    return;
            }
        }
    }

    /**
     * Read SHEETPROTECTION record (FEATHEADR).
     */
    private function readSheetProtection(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        if ($this->readDataOnly) {
            return;
        }

        // offset: 0; size: 2; repeated record header

        // offset: 2; size: 2; FRT cell reference flag (<?php echo0 currently)

        // offset: 4; size: 8; Currently not used and set to 0

        // offset: 12; size: 2; Shared feature type index (2<?php echoEnhanced Protetion, 4<?php echoSmartTag)
        $isf <?php echo self::getUInt2d($recordData, 12);
        if ($isf !<?php echo 2) {
            return;
        }

        // offset: 14; size: 1; <?php echo1 since this is a feat header

        // offset: 15; size: 4; size of rgbHdrSData

        // rgbHdrSData, assume "Enhanced Protection"
        // offset: 19; size: 2; option flags
        $options <?php echo self::getUInt2d($recordData, 19);

        // bit: 0; mask 0x0001; 1 <?php echo user may edit objects, 0 <?php echo users must not edit objects
        // Note - do not negate $bool
        $bool <?php echo (0x0001 & $options) >> 0;
        $this->phpSheet->getProtection()->setObjects((bool) $bool);

        // bit: 1; mask 0x0002; edit scenarios
        // Note - do not negate $bool
        $bool <?php echo (0x0002 & $options) >> 1;
        $this->phpSheet->getProtection()->setScenarios((bool) $bool);

        // bit: 2; mask 0x0004; format cells
        $bool <?php echo (0x0004 & $options) >> 2;
        $this->phpSheet->getProtection()->setFormatCells(!$bool);

        // bit: 3; mask 0x0008; format columns
        $bool <?php echo (0x0008 & $options) >> 3;
        $this->phpSheet->getProtection()->setFormatColumns(!$bool);

        // bit: 4; mask 0x0010; format rows
        $bool <?php echo (0x0010 & $options) >> 4;
        $this->phpSheet->getProtection()->setFormatRows(!$bool);

        // bit: 5; mask 0x0020; insert columns
        $bool <?php echo (0x0020 & $options) >> 5;
        $this->phpSheet->getProtection()->setInsertColumns(!$bool);

        // bit: 6; mask 0x0040; insert rows
        $bool <?php echo (0x0040 & $options) >> 6;
        $this->phpSheet->getProtection()->setInsertRows(!$bool);

        // bit: 7; mask 0x0080; insert hyperlinks
        $bool <?php echo (0x0080 & $options) >> 7;
        $this->phpSheet->getProtection()->setInsertHyperlinks(!$bool);

        // bit: 8; mask 0x0100; delete columns
        $bool <?php echo (0x0100 & $options) >> 8;
        $this->phpSheet->getProtection()->setDeleteColumns(!$bool);

        // bit: 9; mask 0x0200; delete rows
        $bool <?php echo (0x0200 & $options) >> 9;
        $this->phpSheet->getProtection()->setDeleteRows(!$bool);

        // bit: 10; mask 0x0400; select locked cells
        // Note that this is opposite of most of above.
        $bool <?php echo (0x0400 & $options) >> 10;
        $this->phpSheet->getProtection()->setSelectLockedCells((bool) $bool);

        // bit: 11; mask 0x0800; sort cell range
        $bool <?php echo (0x0800 & $options) >> 11;
        $this->phpSheet->getProtection()->setSort(!$bool);

        // bit: 12; mask 0x1000; auto filter
        $bool <?php echo (0x1000 & $options) >> 12;
        $this->phpSheet->getProtection()->setAutoFilter(!$bool);

        // bit: 13; mask 0x2000; pivot tables
        $bool <?php echo (0x2000 & $options) >> 13;
        $this->phpSheet->getProtection()->setPivotTables(!$bool);

        // bit: 14; mask 0x4000; select unlocked cells
        // Note that this is opposite of most of above.
        $bool <?php echo (0x4000 & $options) >> 14;
        $this->phpSheet->getProtection()->setSelectUnlockedCells((bool) $bool);

        // offset: 21; size: 2; not used
    }

    /**
     * Read RANGEPROTECTION record
     * Reading of this record is based on Microsoft Office Excel 97-2000 Binary File Format Specification,
     * where it is referred to as FEAT record.
     */
    private function readRangeProtection(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;

        // local pointer in record data
        $offset <?php echo 0;

        if (!$this->readDataOnly) {
            $offset +<?php echo 12;

            // offset: 12; size: 2; shared feature type, 2 <?php echo enhanced protection, 4 <?php echo smart tag
            $isf <?php echo self::getUInt2d($recordData, 12);
            if ($isf !<?php echo 2) {
                // we only read FEAT records of type 2
                return;
            }
            $offset +<?php echo 2;

            $offset +<?php echo 5;

            // offset: 19; size: 2; count of ref ranges this feature is on
            $cref <?php echo self::getUInt2d($recordData, 19);
            $offset +<?php echo 2;

            $offset +<?php echo 6;

            // offset: 27; size: 8 * $cref; list of cell ranges (like in hyperlink record)
            $cellRanges <?php echo [];
            for ($i <?php echo 0; $i < $cref; ++$i) {
                try {
                    $cellRange <?php echo $this->readBIFF8CellRangeAddressFixed(substr($recordData, 27 + 8 * $i, 8));
                } catch (PhpSpreadsheetException $e) {
                    return;
                }
                $cellRanges[] <?php echo $cellRange;
                $offset +<?php echo 8;
            }

            // offset: var; size: var; variable length of feature specific data
            $rgbFeat <?php echo substr($recordData, $offset);
            $offset +<?php echo 4;

            // offset: var; size: 4; the encrypted password (only 16-bit although field is 32-bit)
            $wPassword <?php echo self::getInt4d($recordData, $offset);
            $offset +<?php echo 4;

            // Apply range protection to sheet
            if ($cellRanges) {
                $this->phpSheet->protectCells(implode(' ', $cellRanges), strtoupper(dechex($wPassword)), true);
            }
        }
    }

    /**
     * Read a free CONTINUE record. Free CONTINUE record may be a camouflaged MSODRAWING record
     * When MSODRAWING data on a sheet exceeds 8224 bytes, CONTINUE records are used instead. Undocumented.
     * In this case, we must treat the CONTINUE record as a MSODRAWING record.
     */
    private function readContinue(): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // check if we are reading drawing data
        // this is in case a free CONTINUE record occurs in other circumstances we are unaware of
        if ($this->drawingData <?php echo<?php echo '') {
            // move stream pointer to next record
            $this->pos +<?php echo 4 + $length;

            return;
        }

        // check if record data is at least 4 bytes long, otherwise there is no chance this is MSODRAWING data
        if ($length < 4) {
            // move stream pointer to next record
            $this->pos +<?php echo 4 + $length;

            return;
        }

        // dirty check to see if CONTINUE record could be a camouflaged MSODRAWING record
        // look inside CONTINUE record to see if it looks like a part of an Escher stream
        // we know that Escher stream may be split at least at
        //        0xF003 MsofbtSpgrContainer
        //        0xF004 MsofbtSpContainer
        //        0xF00D MsofbtClientTextbox
        $validSplitPoints <?php echo [0xF003, 0xF004, 0xF00D]; // add identifiers if we find more

        $splitPoint <?php echo self::getUInt2d($recordData, 2);
        if (in_array($splitPoint, $validSplitPoints)) {
            // get spliced record data (and move pointer to next record)
            $splicedRecordData <?php echo $this->getSplicedRecordData();
            $this->drawingData .<?php echo $splicedRecordData['recordData'];

            return;
        }

        // move stream pointer to next record
        $this->pos +<?php echo 4 + $length;
    }

    /**
     * Reads a record from current position in data stream and continues reading data as long as CONTINUE
     * records are found. Splices the record data pieces and returns the combined string as if record data
     * is in one piece.
     * Moves to next current position in data stream to start of next record different from a CONtINUE record.
     *
     * @return array
     */
    private function getSplicedRecordData()
    {
        $data <?php echo '';
        $spliceOffsets <?php echo [];

        $i <?php echo 0;
        $spliceOffsets[0] <?php echo 0;

        do {
            ++$i;

            // offset: 0; size: 2; identifier
            $identifier <?php echo self::getUInt2d($this->data, $this->pos);
            // offset: 2; size: 2; length
            $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
            $data .<?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

            $spliceOffsets[$i] <?php echo $spliceOffsets[$i - 1] + $length;

            $this->pos +<?php echo 4 + $length;
            $nextIdentifier <?php echo self::getUInt2d($this->data, $this->pos);
        } while ($nextIdentifier <?php echo<?php echo self::XLS_TYPE_CONTINUE);

        return [
            'recordData' <?php echo> $data,
            'spliceOffsets' <?php echo> $spliceOffsets,
        ];
    }

    /**
     * Convert formula structure into human readable Excel formula like 'A3+A5*5'.
     *
     * @param string $formulaStructure The complete binary data for the formula
     * @param string $baseCell Base cell, only needed when formula contains tRefN tokens, e.g. with shared formulas
     *
     * @return string Human readable formula
     */
    private function getFormulaFromStructure($formulaStructure, $baseCell <?php echo 'A1')
    {
        // offset: 0; size: 2; size of the following formula data
        $sz <?php echo self::getUInt2d($formulaStructure, 0);

        // offset: 2; size: sz
        $formulaData <?php echo substr($formulaStructure, 2, $sz);

        // offset: 2 + sz; size: variable (optional)
        if (strlen($formulaStructure) > 2 + $sz) {
            $additionalData <?php echo substr($formulaStructure, 2 + $sz);
        } else {
            $additionalData <?php echo '';
        }

        return $this->getFormulaFromData($formulaData, $additionalData, $baseCell);
    }

    /**
     * Take formula data and additional data for formula and return human readable formula.
     *
     * @param string $formulaData The binary data for the formula itself
     * @param string $additionalData Additional binary data going with the formula
     * @param string $baseCell Base cell, only needed when formula contains tRefN tokens, e.g. with shared formulas
     *
     * @return string Human readable formula
     */
    private function getFormulaFromData($formulaData, $additionalData <?php echo '', $baseCell <?php echo 'A1')
    {
        // start parsing the formula data
        $tokens <?php echo [];

        while (strlen($formulaData) > 0 && $token <?php echo $this->getNextToken($formulaData, $baseCell)) {
            $tokens[] <?php echo $token;
            $formulaData <?php echo substr($formulaData, $token['size']);
        }

        $formulaString <?php echo $this->createFormulaFromTokens($tokens, $additionalData);

        return $formulaString;
    }

    /**
     * Take array of tokens together with additional data for formula and return human readable formula.
     *
     * @param array $tokens
     * @param string $additionalData Additional binary data going with the formula
     *
     * @return string Human readable formula
     */
    private function createFormulaFromTokens($tokens, $additionalData)
    {
        // empty formula?
        if (empty($tokens)) {
            return '';
        }

        $formulaStrings <?php echo [];
        foreach ($tokens as $token) {
            // initialize spaces
            $space0 <?php echo $space0 ?? ''; // spaces before next token, not tParen
            $space1 <?php echo $space1 ?? ''; // carriage returns before next token, not tParen
            $space2 <?php echo $space2 ?? ''; // spaces before opening parenthesis
            $space3 <?php echo $space3 ?? ''; // carriage returns before opening parenthesis
            $space4 <?php echo $space4 ?? ''; // spaces before closing parenthesis
            $space5 <?php echo $space5 ?? ''; // carriage returns before closing parenthesis

            switch ($token['name']) {
                case 'tAdd': // addition
                case 'tConcat': // addition
                case 'tDiv': // division
                case 'tEQ': // equality
                case 'tGE': // greater than or equal
                case 'tGT': // greater than
                case 'tIsect': // intersection
                case 'tLE': // less than or equal
                case 'tList': // less than or equal
                case 'tLT': // less than
                case 'tMul': // multiplication
                case 'tNE': // multiplication
                case 'tPower': // power
                case 'tRange': // range
                case 'tSub': // subtraction
                    $op2 <?php echo array_pop($formulaStrings);
                    $op1 <?php echo array_pop($formulaStrings);
                    $formulaStrings[] <?php echo "$op1$space1$space0{$token['data']}$op2";
                    unset($space0, $space1);

                    break;
                case 'tUplus': // unary plus
                case 'tUminus': // unary minus
                    $op <?php echo array_pop($formulaStrings);
                    $formulaStrings[] <?php echo "$space1$space0{$token['data']}$op";
                    unset($space0, $space1);

                    break;
                case 'tPercent': // percent sign
                    $op <?php echo array_pop($formulaStrings);
                    $formulaStrings[] <?php echo "$op$space1$space0{$token['data']}";
                    unset($space0, $space1);

                    break;
                case 'tAttrVolatile': // indicates volatile function
                case 'tAttrIf':
                case 'tAttrSkip':
                case 'tAttrChoose':
                    // token is only important for Excel formula evaluator
                    // do nothing
                    break;
                case 'tAttrSpace': // space / carriage return
                    // space will be used when next token arrives, do not alter formulaString stack
                    switch ($token['data']['spacetype']) {
                        case 'type0':
                            $space0 <?php echo str_repeat(' ', $token['data']['spacecount']);

                            break;
                        case 'type1':
                            $space1 <?php echo str_repeat("\n", $token['data']['spacecount']);

                            break;
                        case 'type2':
                            $space2 <?php echo str_repeat(' ', $token['data']['spacecount']);

                            break;
                        case 'type3':
                            $space3 <?php echo str_repeat("\n", $token['data']['spacecount']);

                            break;
                        case 'type4':
                            $space4 <?php echo str_repeat(' ', $token['data']['spacecount']);

                            break;
                        case 'type5':
                            $space5 <?php echo str_repeat("\n", $token['data']['spacecount']);

                            break;
                    }

                    break;
                case 'tAttrSum': // SUM function with one parameter
                    $op <?php echo array_pop($formulaStrings);
                    $formulaStrings[] <?php echo "{$space1}{$space0}SUM($op)";
                    unset($space0, $space1);

                    break;
                case 'tFunc': // function with fixed number of arguments
                case 'tFuncV': // function with variable number of arguments
                    if ($token['data']['function'] !<?php echo '') {
                        // normal function
                        $ops <?php echo []; // array of operators
                        for ($i <?php echo 0; $i < $token['data']['args']; ++$i) {
                            $ops[] <?php echo array_pop($formulaStrings);
                        }
                        $ops <?php echo array_reverse($ops);
                        $formulaStrings[] <?php echo "$space1$space0{$token['data']['function']}(" . implode(',', $ops) . ')';
                        unset($space0, $space1);
                    } else {
                        // add-in function
                        $ops <?php echo []; // array of operators
                        for ($i <?php echo 0; $i < $token['data']['args'] - 1; ++$i) {
                            $ops[] <?php echo array_pop($formulaStrings);
                        }
                        $ops <?php echo array_reverse($ops);
                        $function <?php echo array_pop($formulaStrings);
                        $formulaStrings[] <?php echo "$space1$space0$function(" . implode(',', $ops) . ')';
                        unset($space0, $space1);
                    }

                    break;
                case 'tParen': // parenthesis
                    $expression <?php echo array_pop($formulaStrings);
                    $formulaStrings[] <?php echo "$space3$space2($expression$space5$space4)";
                    unset($space2, $space3, $space4, $space5);

                    break;
                case 'tArray': // array constant
                    $constantArray <?php echo self::readBIFF8ConstantArray($additionalData);
                    $formulaStrings[] <?php echo $space1 . $space0 . $constantArray['value'];
                    $additionalData <?php echo substr($additionalData, $constantArray['size']); // bite of chunk of additional data
                    unset($space0, $space1);

                    break;
                case 'tMemArea':
                    // bite off chunk of additional data
                    $cellRangeAddressList <?php echo $this->readBIFF8CellRangeAddressList($additionalData);
                    $additionalData <?php echo substr($additionalData, $cellRangeAddressList['size']);
                    $formulaStrings[] <?php echo "$space1$space0{$token['data']}";
                    unset($space0, $space1);

                    break;
                case 'tArea': // cell range address
                case 'tBool': // boolean
                case 'tErr': // error code
                case 'tInt': // integer
                case 'tMemErr':
                case 'tMemFunc':
                case 'tMissArg':
                case 'tName':
                case 'tNameX':
                case 'tNum': // number
                case 'tRef': // single cell reference
                case 'tRef3d': // 3d cell reference
                case 'tArea3d': // 3d cell range reference
                case 'tRefN':
                case 'tAreaN':
                case 'tStr': // string
                    $formulaStrings[] <?php echo "$space1$space0{$token['data']}";
                    unset($space0, $space1);

                    break;
            }
        }
        $formulaString <?php echo $formulaStrings[0];

        return $formulaString;
    }

    /**
     * Fetch next token from binary formula data.
     *
     * @param string $formulaData Formula data
     * @param string $baseCell Base cell, only needed when formula contains tRefN tokens, e.g. with shared formulas
     *
     * @return array
     */
    private function getNextToken($formulaData, $baseCell <?php echo 'A1')
    {
        // offset: 0; size: 1; token id
        $id <?php echo ord($formulaData[0]); // token id
        $name <?php echo false; // initialize token name

        switch ($id) {
            case 0x03:
                $name <?php echo 'tAdd';
                $size <?php echo 1;
                $data <?php echo '+';

                break;
            case 0x04:
                $name <?php echo 'tSub';
                $size <?php echo 1;
                $data <?php echo '-';

                break;
            case 0x05:
                $name <?php echo 'tMul';
                $size <?php echo 1;
                $data <?php echo '*';

                break;
            case 0x06:
                $name <?php echo 'tDiv';
                $size <?php echo 1;
                $data <?php echo '/';

                break;
            case 0x07:
                $name <?php echo 'tPower';
                $size <?php echo 1;
                $data <?php echo '^';

                break;
            case 0x08:
                $name <?php echo 'tConcat';
                $size <?php echo 1;
                $data <?php echo '&';

                break;
            case 0x09:
                $name <?php echo 'tLT';
                $size <?php echo 1;
                $data <?php echo '<';

                break;
            case 0x0A:
                $name <?php echo 'tLE';
                $size <?php echo 1;
                $data <?php echo '<?php echo';

                break;
            case 0x0B:
                $name <?php echo 'tEQ';
                $size <?php echo 1;
                $data <?php echo '<?php echo';

                break;
            case 0x0C:
                $name <?php echo 'tGE';
                $size <?php echo 1;
                $data <?php echo '><?php echo';

                break;
            case 0x0D:
                $name <?php echo 'tGT';
                $size <?php echo 1;
                $data <?php echo '>';

                break;
            case 0x0E:
                $name <?php echo 'tNE';
                $size <?php echo 1;
                $data <?php echo '<>';

                break;
            case 0x0F:
                $name <?php echo 'tIsect';
                $size <?php echo 1;
                $data <?php echo ' ';

                break;
            case 0x10:
                $name <?php echo 'tList';
                $size <?php echo 1;
                $data <?php echo ',';

                break;
            case 0x11:
                $name <?php echo 'tRange';
                $size <?php echo 1;
                $data <?php echo ':';

                break;
            case 0x12:
                $name <?php echo 'tUplus';
                $size <?php echo 1;
                $data <?php echo '+';

                break;
            case 0x13:
                $name <?php echo 'tUminus';
                $size <?php echo 1;
                $data <?php echo '-';

                break;
            case 0x14:
                $name <?php echo 'tPercent';
                $size <?php echo 1;
                $data <?php echo '%';

                break;
            case 0x15:    //    parenthesis
                $name <?php echo 'tParen';
                $size <?php echo 1;
                $data <?php echo null;

                break;
            case 0x16:    //    missing argument
                $name <?php echo 'tMissArg';
                $size <?php echo 1;
                $data <?php echo '';

                break;
            case 0x17:    //    string
                $name <?php echo 'tStr';
                // offset: 1; size: var; Unicode string, 8-bit string length
                $string <?php echo self::readUnicodeStringShort(substr($formulaData, 1));
                $size <?php echo 1 + $string['size'];
                $data <?php echo self::UTF8toExcelDoubleQuoted($string['value']);

                break;
            case 0x19:    //    Special attribute
                // offset: 1; size: 1; attribute type flags:
                switch (ord($formulaData[1])) {
                    case 0x01:
                        $name <?php echo 'tAttrVolatile';
                        $size <?php echo 4;
                        $data <?php echo null;

                        break;
                    case 0x02:
                        $name <?php echo 'tAttrIf';
                        $size <?php echo 4;
                        $data <?php echo null;

                        break;
                    case 0x04:
                        $name <?php echo 'tAttrChoose';
                        // offset: 2; size: 2; number of choices in the CHOOSE function ($nc, number of parameters decreased by 1)
                        $nc <?php echo self::getUInt2d($formulaData, 2);
                        // offset: 4; size: 2 * $nc
                        // offset: 4 + 2 * $nc; size: 2
                        $size <?php echo 2 * $nc + 6;
                        $data <?php echo null;

                        break;
                    case 0x08:
                        $name <?php echo 'tAttrSkip';
                        $size <?php echo 4;
                        $data <?php echo null;

                        break;
                    case 0x10:
                        $name <?php echo 'tAttrSum';
                        $size <?php echo 4;
                        $data <?php echo null;

                        break;
                    case 0x40:
                    case 0x41:
                        $name <?php echo 'tAttrSpace';
                        $size <?php echo 4;
                        // offset: 2; size: 2; space type and position
                        switch (ord($formulaData[2])) {
                            case 0x00:
                                $spacetype <?php echo 'type0';

                                break;
                            case 0x01:
                                $spacetype <?php echo 'type1';

                                break;
                            case 0x02:
                                $spacetype <?php echo 'type2';

                                break;
                            case 0x03:
                                $spacetype <?php echo 'type3';

                                break;
                            case 0x04:
                                $spacetype <?php echo 'type4';

                                break;
                            case 0x05:
                                $spacetype <?php echo 'type5';

                                break;
                            default:
                                throw new Exception('Unrecognized space type in tAttrSpace token');
                        }
                        // offset: 3; size: 1; number of inserted spaces/carriage returns
                        $spacecount <?php echo ord($formulaData[3]);

                        $data <?php echo ['spacetype' <?php echo> $spacetype, 'spacecount' <?php echo> $spacecount];

                        break;
                    default:
                        throw new Exception('Unrecognized attribute flag in tAttr token');
                }

                break;
            case 0x1C:    //    error code
                // offset: 1; size: 1; error code
                $name <?php echo 'tErr';
                $size <?php echo 2;
                $data <?php echo Xls\ErrorCode::lookup(ord($formulaData[1]));

                break;
            case 0x1D:    //    boolean
                // offset: 1; size: 1; 0 <?php echo false, 1 <?php echo true;
                $name <?php echo 'tBool';
                $size <?php echo 2;
                $data <?php echo ord($formulaData[1]) ? 'TRUE' : 'FALSE';

                break;
            case 0x1E:    //    integer
                // offset: 1; size: 2; unsigned 16-bit integer
                $name <?php echo 'tInt';
                $size <?php echo 3;
                $data <?php echo self::getUInt2d($formulaData, 1);

                break;
            case 0x1F:    //    number
                // offset: 1; size: 8;
                $name <?php echo 'tNum';
                $size <?php echo 9;
                $data <?php echo self::extractNumber(substr($formulaData, 1));
                $data <?php echo str_replace(',', '.', (string) $data); // in case non-English locale

                break;
            case 0x20:    //    array constant
            case 0x40:
            case 0x60:
                // offset: 1; size: 7; not used
                $name <?php echo 'tArray';
                $size <?php echo 8;
                $data <?php echo null;

                break;
            case 0x21:    //    function with fixed number of arguments
            case 0x41:
            case 0x61:
                $name <?php echo 'tFunc';
                $size <?php echo 3;
                // offset: 1; size: 2; index to built-in sheet function
                switch (self::getUInt2d($formulaData, 1)) {
                    case 2:
                        $function <?php echo 'ISNA';
                        $args <?php echo 1;

                        break;
                    case 3:
                        $function <?php echo 'ISERROR';
                        $args <?php echo 1;

                        break;
                    case 10:
                        $function <?php echo 'NA';
                        $args <?php echo 0;

                        break;
                    case 15:
                        $function <?php echo 'SIN';
                        $args <?php echo 1;

                        break;
                    case 16:
                        $function <?php echo 'COS';
                        $args <?php echo 1;

                        break;
                    case 17:
                        $function <?php echo 'TAN';
                        $args <?php echo 1;

                        break;
                    case 18:
                        $function <?php echo 'ATAN';
                        $args <?php echo 1;

                        break;
                    case 19:
                        $function <?php echo 'PI';
                        $args <?php echo 0;

                        break;
                    case 20:
                        $function <?php echo 'SQRT';
                        $args <?php echo 1;

                        break;
                    case 21:
                        $function <?php echo 'EXP';
                        $args <?php echo 1;

                        break;
                    case 22:
                        $function <?php echo 'LN';
                        $args <?php echo 1;

                        break;
                    case 23:
                        $function <?php echo 'LOG10';
                        $args <?php echo 1;

                        break;
                    case 24:
                        $function <?php echo 'ABS';
                        $args <?php echo 1;

                        break;
                    case 25:
                        $function <?php echo 'INT';
                        $args <?php echo 1;

                        break;
                    case 26:
                        $function <?php echo 'SIGN';
                        $args <?php echo 1;

                        break;
                    case 27:
                        $function <?php echo 'ROUND';
                        $args <?php echo 2;

                        break;
                    case 30:
                        $function <?php echo 'REPT';
                        $args <?php echo 2;

                        break;
                    case 31:
                        $function <?php echo 'MID';
                        $args <?php echo 3;

                        break;
                    case 32:
                        $function <?php echo 'LEN';
                        $args <?php echo 1;

                        break;
                    case 33:
                        $function <?php echo 'VALUE';
                        $args <?php echo 1;

                        break;
                    case 34:
                        $function <?php echo 'TRUE';
                        $args <?php echo 0;

                        break;
                    case 35:
                        $function <?php echo 'FALSE';
                        $args <?php echo 0;

                        break;
                    case 38:
                        $function <?php echo 'NOT';
                        $args <?php echo 1;

                        break;
                    case 39:
                        $function <?php echo 'MOD';
                        $args <?php echo 2;

                        break;
                    case 40:
                        $function <?php echo 'DCOUNT';
                        $args <?php echo 3;

                        break;
                    case 41:
                        $function <?php echo 'DSUM';
                        $args <?php echo 3;

                        break;
                    case 42:
                        $function <?php echo 'DAVERAGE';
                        $args <?php echo 3;

                        break;
                    case 43:
                        $function <?php echo 'DMIN';
                        $args <?php echo 3;

                        break;
                    case 44:
                        $function <?php echo 'DMAX';
                        $args <?php echo 3;

                        break;
                    case 45:
                        $function <?php echo 'DSTDEV';
                        $args <?php echo 3;

                        break;
                    case 48:
                        $function <?php echo 'TEXT';
                        $args <?php echo 2;

                        break;
                    case 61:
                        $function <?php echo 'MIRR';
                        $args <?php echo 3;

                        break;
                    case 63:
                        $function <?php echo 'RAND';
                        $args <?php echo 0;

                        break;
                    case 65:
                        $function <?php echo 'DATE';
                        $args <?php echo 3;

                        break;
                    case 66:
                        $function <?php echo 'TIME';
                        $args <?php echo 3;

                        break;
                    case 67:
                        $function <?php echo 'DAY';
                        $args <?php echo 1;

                        break;
                    case 68:
                        $function <?php echo 'MONTH';
                        $args <?php echo 1;

                        break;
                    case 69:
                        $function <?php echo 'YEAR';
                        $args <?php echo 1;

                        break;
                    case 71:
                        $function <?php echo 'HOUR';
                        $args <?php echo 1;

                        break;
                    case 72:
                        $function <?php echo 'MINUTE';
                        $args <?php echo 1;

                        break;
                    case 73:
                        $function <?php echo 'SECOND';
                        $args <?php echo 1;

                        break;
                    case 74:
                        $function <?php echo 'NOW';
                        $args <?php echo 0;

                        break;
                    case 75:
                        $function <?php echo 'AREAS';
                        $args <?php echo 1;

                        break;
                    case 76:
                        $function <?php echo 'ROWS';
                        $args <?php echo 1;

                        break;
                    case 77:
                        $function <?php echo 'COLUMNS';
                        $args <?php echo 1;

                        break;
                    case 83:
                        $function <?php echo 'TRANSPOSE';
                        $args <?php echo 1;

                        break;
                    case 86:
                        $function <?php echo 'TYPE';
                        $args <?php echo 1;

                        break;
                    case 97:
                        $function <?php echo 'ATAN2';
                        $args <?php echo 2;

                        break;
                    case 98:
                        $function <?php echo 'ASIN';
                        $args <?php echo 1;

                        break;
                    case 99:
                        $function <?php echo 'ACOS';
                        $args <?php echo 1;

                        break;
                    case 105:
                        $function <?php echo 'ISREF';
                        $args <?php echo 1;

                        break;
                    case 111:
                        $function <?php echo 'CHAR';
                        $args <?php echo 1;

                        break;
                    case 112:
                        $function <?php echo 'LOWER';
                        $args <?php echo 1;

                        break;
                    case 113:
                        $function <?php echo 'UPPER';
                        $args <?php echo 1;

                        break;
                    case 114:
                        $function <?php echo 'PROPER';
                        $args <?php echo 1;

                        break;
                    case 117:
                        $function <?php echo 'EXACT';
                        $args <?php echo 2;

                        break;
                    case 118:
                        $function <?php echo 'TRIM';
                        $args <?php echo 1;

                        break;
                    case 119:
                        $function <?php echo 'REPLACE';
                        $args <?php echo 4;

                        break;
                    case 121:
                        $function <?php echo 'CODE';
                        $args <?php echo 1;

                        break;
                    case 126:
                        $function <?php echo 'ISERR';
                        $args <?php echo 1;

                        break;
                    case 127:
                        $function <?php echo 'ISTEXT';
                        $args <?php echo 1;

                        break;
                    case 128:
                        $function <?php echo 'ISNUMBER';
                        $args <?php echo 1;

                        break;
                    case 129:
                        $function <?php echo 'ISBLANK';
                        $args <?php echo 1;

                        break;
                    case 130:
                        $function <?php echo 'T';
                        $args <?php echo 1;

                        break;
                    case 131:
                        $function <?php echo 'N';
                        $args <?php echo 1;

                        break;
                    case 140:
                        $function <?php echo 'DATEVALUE';
                        $args <?php echo 1;

                        break;
                    case 141:
                        $function <?php echo 'TIMEVALUE';
                        $args <?php echo 1;

                        break;
                    case 142:
                        $function <?php echo 'SLN';
                        $args <?php echo 3;

                        break;
                    case 143:
                        $function <?php echo 'SYD';
                        $args <?php echo 4;

                        break;
                    case 162:
                        $function <?php echo 'CLEAN';
                        $args <?php echo 1;

                        break;
                    case 163:
                        $function <?php echo 'MDETERM';
                        $args <?php echo 1;

                        break;
                    case 164:
                        $function <?php echo 'MINVERSE';
                        $args <?php echo 1;

                        break;
                    case 165:
                        $function <?php echo 'MMULT';
                        $args <?php echo 2;

                        break;
                    case 184:
                        $function <?php echo 'FACT';
                        $args <?php echo 1;

                        break;
                    case 189:
                        $function <?php echo 'DPRODUCT';
                        $args <?php echo 3;

                        break;
                    case 190:
                        $function <?php echo 'ISNONTEXT';
                        $args <?php echo 1;

                        break;
                    case 195:
                        $function <?php echo 'DSTDEVP';
                        $args <?php echo 3;

                        break;
                    case 196:
                        $function <?php echo 'DVARP';
                        $args <?php echo 3;

                        break;
                    case 198:
                        $function <?php echo 'ISLOGICAL';
                        $args <?php echo 1;

                        break;
                    case 199:
                        $function <?php echo 'DCOUNTA';
                        $args <?php echo 3;

                        break;
                    case 207:
                        $function <?php echo 'REPLACEB';
                        $args <?php echo 4;

                        break;
                    case 210:
                        $function <?php echo 'MIDB';
                        $args <?php echo 3;

                        break;
                    case 211:
                        $function <?php echo 'LENB';
                        $args <?php echo 1;

                        break;
                    case 212:
                        $function <?php echo 'ROUNDUP';
                        $args <?php echo 2;

                        break;
                    case 213:
                        $function <?php echo 'ROUNDDOWN';
                        $args <?php echo 2;

                        break;
                    case 214:
                        $function <?php echo 'ASC';
                        $args <?php echo 1;

                        break;
                    case 215:
                        $function <?php echo 'DBCS';
                        $args <?php echo 1;

                        break;
                    case 221:
                        $function <?php echo 'TODAY';
                        $args <?php echo 0;

                        break;
                    case 229:
                        $function <?php echo 'SINH';
                        $args <?php echo 1;

                        break;
                    case 230:
                        $function <?php echo 'COSH';
                        $args <?php echo 1;

                        break;
                    case 231:
                        $function <?php echo 'TANH';
                        $args <?php echo 1;

                        break;
                    case 232:
                        $function <?php echo 'ASINH';
                        $args <?php echo 1;

                        break;
                    case 233:
                        $function <?php echo 'ACOSH';
                        $args <?php echo 1;

                        break;
                    case 234:
                        $function <?php echo 'ATANH';
                        $args <?php echo 1;

                        break;
                    case 235:
                        $function <?php echo 'DGET';
                        $args <?php echo 3;

                        break;
                    case 244:
                        $function <?php echo 'INFO';
                        $args <?php echo 1;

                        break;
                    case 252:
                        $function <?php echo 'FREQUENCY';
                        $args <?php echo 2;

                        break;
                    case 261:
                        $function <?php echo 'ERROR.TYPE';
                        $args <?php echo 1;

                        break;
                    case 271:
                        $function <?php echo 'GAMMALN';
                        $args <?php echo 1;

                        break;
                    case 273:
                        $function <?php echo 'BINOMDIST';
                        $args <?php echo 4;

                        break;
                    case 274:
                        $function <?php echo 'CHIDIST';
                        $args <?php echo 2;

                        break;
                    case 275:
                        $function <?php echo 'CHIINV';
                        $args <?php echo 2;

                        break;
                    case 276:
                        $function <?php echo 'COMBIN';
                        $args <?php echo 2;

                        break;
                    case 277:
                        $function <?php echo 'CONFIDENCE';
                        $args <?php echo 3;

                        break;
                    case 278:
                        $function <?php echo 'CRITBINOM';
                        $args <?php echo 3;

                        break;
                    case 279:
                        $function <?php echo 'EVEN';
                        $args <?php echo 1;

                        break;
                    case 280:
                        $function <?php echo 'EXPONDIST';
                        $args <?php echo 3;

                        break;
                    case 281:
                        $function <?php echo 'FDIST';
                        $args <?php echo 3;

                        break;
                    case 282:
                        $function <?php echo 'FINV';
                        $args <?php echo 3;

                        break;
                    case 283:
                        $function <?php echo 'FISHER';
                        $args <?php echo 1;

                        break;
                    case 284:
                        $function <?php echo 'FISHERINV';
                        $args <?php echo 1;

                        break;
                    case 285:
                        $function <?php echo 'FLOOR';
                        $args <?php echo 2;

                        break;
                    case 286:
                        $function <?php echo 'GAMMADIST';
                        $args <?php echo 4;

                        break;
                    case 287:
                        $function <?php echo 'GAMMAINV';
                        $args <?php echo 3;

                        break;
                    case 288:
                        $function <?php echo 'CEILING';
                        $args <?php echo 2;

                        break;
                    case 289:
                        $function <?php echo 'HYPGEOMDIST';
                        $args <?php echo 4;

                        break;
                    case 290:
                        $function <?php echo 'LOGNORMDIST';
                        $args <?php echo 3;

                        break;
                    case 291:
                        $function <?php echo 'LOGINV';
                        $args <?php echo 3;

                        break;
                    case 292:
                        $function <?php echo 'NEGBINOMDIST';
                        $args <?php echo 3;

                        break;
                    case 293:
                        $function <?php echo 'NORMDIST';
                        $args <?php echo 4;

                        break;
                    case 294:
                        $function <?php echo 'NORMSDIST';
                        $args <?php echo 1;

                        break;
                    case 295:
                        $function <?php echo 'NORMINV';
                        $args <?php echo 3;

                        break;
                    case 296:
                        $function <?php echo 'NORMSINV';
                        $args <?php echo 1;

                        break;
                    case 297:
                        $function <?php echo 'STANDARDIZE';
                        $args <?php echo 3;

                        break;
                    case 298:
                        $function <?php echo 'ODD';
                        $args <?php echo 1;

                        break;
                    case 299:
                        $function <?php echo 'PERMUT';
                        $args <?php echo 2;

                        break;
                    case 300:
                        $function <?php echo 'POISSON';
                        $args <?php echo 3;

                        break;
                    case 301:
                        $function <?php echo 'TDIST';
                        $args <?php echo 3;

                        break;
                    case 302:
                        $function <?php echo 'WEIBULL';
                        $args <?php echo 4;

                        break;
                    case 303:
                        $function <?php echo 'SUMXMY2';
                        $args <?php echo 2;

                        break;
                    case 304:
                        $function <?php echo 'SUMX2MY2';
                        $args <?php echo 2;

                        break;
                    case 305:
                        $function <?php echo 'SUMX2PY2';
                        $args <?php echo 2;

                        break;
                    case 306:
                        $function <?php echo 'CHITEST';
                        $args <?php echo 2;

                        break;
                    case 307:
                        $function <?php echo 'CORREL';
                        $args <?php echo 2;

                        break;
                    case 308:
                        $function <?php echo 'COVAR';
                        $args <?php echo 2;

                        break;
                    case 309:
                        $function <?php echo 'FORECAST';
                        $args <?php echo 3;

                        break;
                    case 310:
                        $function <?php echo 'FTEST';
                        $args <?php echo 2;

                        break;
                    case 311:
                        $function <?php echo 'INTERCEPT';
                        $args <?php echo 2;

                        break;
                    case 312:
                        $function <?php echo 'PEARSON';
                        $args <?php echo 2;

                        break;
                    case 313:
                        $function <?php echo 'RSQ';
                        $args <?php echo 2;

                        break;
                    case 314:
                        $function <?php echo 'STEYX';
                        $args <?php echo 2;

                        break;
                    case 315:
                        $function <?php echo 'SLOPE';
                        $args <?php echo 2;

                        break;
                    case 316:
                        $function <?php echo 'TTEST';
                        $args <?php echo 4;

                        break;
                    case 325:
                        $function <?php echo 'LARGE';
                        $args <?php echo 2;

                        break;
                    case 326:
                        $function <?php echo 'SMALL';
                        $args <?php echo 2;

                        break;
                    case 327:
                        $function <?php echo 'QUARTILE';
                        $args <?php echo 2;

                        break;
                    case 328:
                        $function <?php echo 'PERCENTILE';
                        $args <?php echo 2;

                        break;
                    case 331:
                        $function <?php echo 'TRIMMEAN';
                        $args <?php echo 2;

                        break;
                    case 332:
                        $function <?php echo 'TINV';
                        $args <?php echo 2;

                        break;
                    case 337:
                        $function <?php echo 'POWER';
                        $args <?php echo 2;

                        break;
                    case 342:
                        $function <?php echo 'RADIANS';
                        $args <?php echo 1;

                        break;
                    case 343:
                        $function <?php echo 'DEGREES';
                        $args <?php echo 1;

                        break;
                    case 346:
                        $function <?php echo 'COUNTIF';
                        $args <?php echo 2;

                        break;
                    case 347:
                        $function <?php echo 'COUNTBLANK';
                        $args <?php echo 1;

                        break;
                    case 350:
                        $function <?php echo 'ISPMT';
                        $args <?php echo 4;

                        break;
                    case 351:
                        $function <?php echo 'DATEDIF';
                        $args <?php echo 3;

                        break;
                    case 352:
                        $function <?php echo 'DATESTRING';
                        $args <?php echo 1;

                        break;
                    case 353:
                        $function <?php echo 'NUMBERSTRING';
                        $args <?php echo 2;

                        break;
                    case 360:
                        $function <?php echo 'PHONETIC';
                        $args <?php echo 1;

                        break;
                    case 368:
                        $function <?php echo 'BAHTTEXT';
                        $args <?php echo 1;

                        break;
                    default:
                        throw new Exception('Unrecognized function in formula');
                }
                $data <?php echo ['function' <?php echo> $function, 'args' <?php echo> $args];

                break;
            case 0x22:    //    function with variable number of arguments
            case 0x42:
            case 0x62:
                $name <?php echo 'tFuncV';
                $size <?php echo 4;
                // offset: 1; size: 1; number of arguments
                $args <?php echo ord($formulaData[1]);
                // offset: 2: size: 2; index to built-in sheet function
                $index <?php echo self::getUInt2d($formulaData, 2);
                switch ($index) {
                    case 0:
                        $function <?php echo 'COUNT';

                        break;
                    case 1:
                        $function <?php echo 'IF';

                        break;
                    case 4:
                        $function <?php echo 'SUM';

                        break;
                    case 5:
                        $function <?php echo 'AVERAGE';

                        break;
                    case 6:
                        $function <?php echo 'MIN';

                        break;
                    case 7:
                        $function <?php echo 'MAX';

                        break;
                    case 8:
                        $function <?php echo 'ROW';

                        break;
                    case 9:
                        $function <?php echo 'COLUMN';

                        break;
                    case 11:
                        $function <?php echo 'NPV';

                        break;
                    case 12:
                        $function <?php echo 'STDEV';

                        break;
                    case 13:
                        $function <?php echo 'DOLLAR';

                        break;
                    case 14:
                        $function <?php echo 'FIXED';

                        break;
                    case 28:
                        $function <?php echo 'LOOKUP';

                        break;
                    case 29:
                        $function <?php echo 'INDEX';

                        break;
                    case 36:
                        $function <?php echo 'AND';

                        break;
                    case 37:
                        $function <?php echo 'OR';

                        break;
                    case 46:
                        $function <?php echo 'VAR';

                        break;
                    case 49:
                        $function <?php echo 'LINEST';

                        break;
                    case 50:
                        $function <?php echo 'TREND';

                        break;
                    case 51:
                        $function <?php echo 'LOGEST';

                        break;
                    case 52:
                        $function <?php echo 'GROWTH';

                        break;
                    case 56:
                        $function <?php echo 'PV';

                        break;
                    case 57:
                        $function <?php echo 'FV';

                        break;
                    case 58:
                        $function <?php echo 'NPER';

                        break;
                    case 59:
                        $function <?php echo 'PMT';

                        break;
                    case 60:
                        $function <?php echo 'RATE';

                        break;
                    case 62:
                        $function <?php echo 'IRR';

                        break;
                    case 64:
                        $function <?php echo 'MATCH';

                        break;
                    case 70:
                        $function <?php echo 'WEEKDAY';

                        break;
                    case 78:
                        $function <?php echo 'OFFSET';

                        break;
                    case 82:
                        $function <?php echo 'SEARCH';

                        break;
                    case 100:
                        $function <?php echo 'CHOOSE';

                        break;
                    case 101:
                        $function <?php echo 'HLOOKUP';

                        break;
                    case 102:
                        $function <?php echo 'VLOOKUP';

                        break;
                    case 109:
                        $function <?php echo 'LOG';

                        break;
                    case 115:
                        $function <?php echo 'LEFT';

                        break;
                    case 116:
                        $function <?php echo 'RIGHT';

                        break;
                    case 120:
                        $function <?php echo 'SUBSTITUTE';

                        break;
                    case 124:
                        $function <?php echo 'FIND';

                        break;
                    case 125:
                        $function <?php echo 'CELL';

                        break;
                    case 144:
                        $function <?php echo 'DDB';

                        break;
                    case 148:
                        $function <?php echo 'INDIRECT';

                        break;
                    case 167:
                        $function <?php echo 'IPMT';

                        break;
                    case 168:
                        $function <?php echo 'PPMT';

                        break;
                    case 169:
                        $function <?php echo 'COUNTA';

                        break;
                    case 183:
                        $function <?php echo 'PRODUCT';

                        break;
                    case 193:
                        $function <?php echo 'STDEVP';

                        break;
                    case 194:
                        $function <?php echo 'VARP';

                        break;
                    case 197:
                        $function <?php echo 'TRUNC';

                        break;
                    case 204:
                        $function <?php echo 'USDOLLAR';

                        break;
                    case 205:
                        $function <?php echo 'FINDB';

                        break;
                    case 206:
                        $function <?php echo 'SEARCHB';

                        break;
                    case 208:
                        $function <?php echo 'LEFTB';

                        break;
                    case 209:
                        $function <?php echo 'RIGHTB';

                        break;
                    case 216:
                        $function <?php echo 'RANK';

                        break;
                    case 219:
                        $function <?php echo 'ADDRESS';

                        break;
                    case 220:
                        $function <?php echo 'DAYS360';

                        break;
                    case 222:
                        $function <?php echo 'VDB';

                        break;
                    case 227:
                        $function <?php echo 'MEDIAN';

                        break;
                    case 228:
                        $function <?php echo 'SUMPRODUCT';

                        break;
                    case 247:
                        $function <?php echo 'DB';

                        break;
                    case 255:
                        $function <?php echo '';

                        break;
                    case 269:
                        $function <?php echo 'AVEDEV';

                        break;
                    case 270:
                        $function <?php echo 'BETADIST';

                        break;
                    case 272:
                        $function <?php echo 'BETAINV';

                        break;
                    case 317:
                        $function <?php echo 'PROB';

                        break;
                    case 318:
                        $function <?php echo 'DEVSQ';

                        break;
                    case 319:
                        $function <?php echo 'GEOMEAN';

                        break;
                    case 320:
                        $function <?php echo 'HARMEAN';

                        break;
                    case 321:
                        $function <?php echo 'SUMSQ';

                        break;
                    case 322:
                        $function <?php echo 'KURT';

                        break;
                    case 323:
                        $function <?php echo 'SKEW';

                        break;
                    case 324:
                        $function <?php echo 'ZTEST';

                        break;
                    case 329:
                        $function <?php echo 'PERCENTRANK';

                        break;
                    case 330:
                        $function <?php echo 'MODE';

                        break;
                    case 336:
                        $function <?php echo 'CONCATENATE';

                        break;
                    case 344:
                        $function <?php echo 'SUBTOTAL';

                        break;
                    case 345:
                        $function <?php echo 'SUMIF';

                        break;
                    case 354:
                        $function <?php echo 'ROMAN';

                        break;
                    case 358:
                        $function <?php echo 'GETPIVOTDATA';

                        break;
                    case 359:
                        $function <?php echo 'HYPERLINK';

                        break;
                    case 361:
                        $function <?php echo 'AVERAGEA';

                        break;
                    case 362:
                        $function <?php echo 'MAXA';

                        break;
                    case 363:
                        $function <?php echo 'MINA';

                        break;
                    case 364:
                        $function <?php echo 'STDEVPA';

                        break;
                    case 365:
                        $function <?php echo 'VARPA';

                        break;
                    case 366:
                        $function <?php echo 'STDEVA';

                        break;
                    case 367:
                        $function <?php echo 'VARA';

                        break;
                    default:
                        throw new Exception('Unrecognized function in formula');
                }
                $data <?php echo ['function' <?php echo> $function, 'args' <?php echo> $args];

                break;
            case 0x23:    //    index to defined name
            case 0x43:
            case 0x63:
                $name <?php echo 'tName';
                $size <?php echo 5;
                // offset: 1; size: 2; one-based index to definedname record
                $definedNameIndex <?php echo self::getUInt2d($formulaData, 1) - 1;
                // offset: 2; size: 2; not used
                $data <?php echo $this->definedname[$definedNameIndex]['name'] ?? '';

                break;
            case 0x24:    //    single cell reference e.g. A5
            case 0x44:
            case 0x64:
                $name <?php echo 'tRef';
                $size <?php echo 5;
                $data <?php echo $this->readBIFF8CellAddress(substr($formulaData, 1, 4));

                break;
            case 0x25:    //    cell range reference to cells in the same sheet (2d)
            case 0x45:
            case 0x65:
                $name <?php echo 'tArea';
                $size <?php echo 9;
                $data <?php echo $this->readBIFF8CellRangeAddress(substr($formulaData, 1, 8));

                break;
            case 0x26:    //    Constant reference sub-expression
            case 0x46:
            case 0x66:
                $name <?php echo 'tMemArea';
                // offset: 1; size: 4; not used
                // offset: 5; size: 2; size of the following subexpression
                $subSize <?php echo self::getUInt2d($formulaData, 5);
                $size <?php echo 7 + $subSize;
                $data <?php echo $this->getFormulaFromData(substr($formulaData, 7, $subSize));

                break;
            case 0x27:    //    Deleted constant reference sub-expression
            case 0x47:
            case 0x67:
                $name <?php echo 'tMemErr';
                // offset: 1; size: 4; not used
                // offset: 5; size: 2; size of the following subexpression
                $subSize <?php echo self::getUInt2d($formulaData, 5);
                $size <?php echo 7 + $subSize;
                $data <?php echo $this->getFormulaFromData(substr($formulaData, 7, $subSize));

                break;
            case 0x29:    //    Variable reference sub-expression
            case 0x49:
            case 0x69:
                $name <?php echo 'tMemFunc';
                // offset: 1; size: 2; size of the following sub-expression
                $subSize <?php echo self::getUInt2d($formulaData, 1);
                $size <?php echo 3 + $subSize;
                $data <?php echo $this->getFormulaFromData(substr($formulaData, 3, $subSize));

                break;
            case 0x2C: // Relative 2d cell reference reference, used in shared formulas and some other places
            case 0x4C:
            case 0x6C:
                $name <?php echo 'tRefN';
                $size <?php echo 5;
                $data <?php echo $this->readBIFF8CellAddressB(substr($formulaData, 1, 4), $baseCell);

                break;
            case 0x2D:    //    Relative 2d range reference
            case 0x4D:
            case 0x6D:
                $name <?php echo 'tAreaN';
                $size <?php echo 9;
                $data <?php echo $this->readBIFF8CellRangeAddressB(substr($formulaData, 1, 8), $baseCell);

                break;
            case 0x39:    //    External name
            case 0x59:
            case 0x79:
                $name <?php echo 'tNameX';
                $size <?php echo 7;
                // offset: 1; size: 2; index to REF entry in EXTERNSHEET record
                // offset: 3; size: 2; one-based index to DEFINEDNAME or EXTERNNAME record
                $index <?php echo self::getUInt2d($formulaData, 3);
                // assume index is to EXTERNNAME record
                $data <?php echo $this->externalNames[$index - 1]['name'] ?? '';
                // offset: 5; size: 2; not used
                break;
            case 0x3A:    //    3d reference to cell
            case 0x5A:
            case 0x7A:
                $name <?php echo 'tRef3d';
                $size <?php echo 7;

                try {
                    // offset: 1; size: 2; index to REF entry
                    $sheetRange <?php echo $this->readSheetRangeByRefIndex(self::getUInt2d($formulaData, 1));
                    // offset: 3; size: 4; cell address
                    $cellAddress <?php echo $this->readBIFF8CellAddress(substr($formulaData, 3, 4));

                    $data <?php echo "$sheetRange!$cellAddress";
                } catch (PhpSpreadsheetException $e) {
                    // deleted sheet reference
                    $data <?php echo '#REF!';
                }

                break;
            case 0x3B:    //    3d reference to cell range
            case 0x5B:
            case 0x7B:
                $name <?php echo 'tArea3d';
                $size <?php echo 11;

                try {
                    // offset: 1; size: 2; index to REF entry
                    $sheetRange <?php echo $this->readSheetRangeByRefIndex(self::getUInt2d($formulaData, 1));
                    // offset: 3; size: 8; cell address
                    $cellRangeAddress <?php echo $this->readBIFF8CellRangeAddress(substr($formulaData, 3, 8));

                    $data <?php echo "$sheetRange!$cellRangeAddress";
                } catch (PhpSpreadsheetException $e) {
                    // deleted sheet reference
                    $data <?php echo '#REF!';
                }

                break;
                // Unknown cases    // don't know how to deal with
            default:
                throw new Exception('Unrecognized token ' . sprintf('%02X', $id) . ' in formula');
        }

        return [
            'id' <?php echo> $id,
            'name' <?php echo> $name,
            'size' <?php echo> $size,
            'data' <?php echo> $data,
        ];
    }

    /**
     * Reads a cell address in BIFF8 e.g. 'A2' or '$A$2'
     * section 3.3.4.
     *
     * @param string $cellAddressStructure
     *
     * @return string
     */
    private function readBIFF8CellAddress($cellAddressStructure)
    {
        // offset: 0; size: 2; index to row (0... 65535) (or offset (-32768... 32767))
        $row <?php echo self::getUInt2d($cellAddressStructure, 0) + 1;

        // offset: 2; size: 2; index to column or column offset + relative flags
        // bit: 7-0; mask 0x00FF; column index
        $column <?php echo Coordinate::stringFromColumnIndex((0x00FF & self::getUInt2d($cellAddressStructure, 2)) + 1);

        // bit: 14; mask 0x4000; (1 <?php echo relative column index, 0 <?php echo absolute column index)
        if (!(0x4000 & self::getUInt2d($cellAddressStructure, 2))) {
            $column <?php echo '$' . $column;
        }
        // bit: 15; mask 0x8000; (1 <?php echo relative row index, 0 <?php echo absolute row index)
        if (!(0x8000 & self::getUInt2d($cellAddressStructure, 2))) {
            $row <?php echo '$' . $row;
        }

        return $column . $row;
    }

    /**
     * Reads a cell address in BIFF8 for shared formulas. Uses positive and negative values for row and column
     * to indicate offsets from a base cell
     * section 3.3.4.
     *
     * @param string $cellAddressStructure
     * @param string $baseCell Base cell, only needed when formula contains tRefN tokens, e.g. with shared formulas
     *
     * @return string
     */
    private function readBIFF8CellAddressB($cellAddressStructure, $baseCell <?php echo 'A1')
    {
        [$baseCol, $baseRow] <?php echo Coordinate::coordinateFromString($baseCell);
        $baseCol <?php echo Coordinate::columnIndexFromString($baseCol) - 1;
        $baseRow <?php echo (int) $baseRow;

        // offset: 0; size: 2; index to row (0... 65535) (or offset (-32768... 32767))
        $rowIndex <?php echo self::getUInt2d($cellAddressStructure, 0);
        $row <?php echo self::getUInt2d($cellAddressStructure, 0) + 1;

        // bit: 14; mask 0x4000; (1 <?php echo relative column index, 0 <?php echo absolute column index)
        if (!(0x4000 & self::getUInt2d($cellAddressStructure, 2))) {
            // offset: 2; size: 2; index to column or column offset + relative flags
            // bit: 7-0; mask 0x00FF; column index
            $colIndex <?php echo 0x00FF & self::getUInt2d($cellAddressStructure, 2);

            $column <?php echo Coordinate::stringFromColumnIndex($colIndex + 1);
            $column <?php echo '$' . $column;
        } else {
            // offset: 2; size: 2; index to column or column offset + relative flags
            // bit: 7-0; mask 0x00FF; column index
            $relativeColIndex <?php echo 0x00FF & self::getInt2d($cellAddressStructure, 2);
            $colIndex <?php echo $baseCol + $relativeColIndex;
            $colIndex <?php echo ($colIndex < 256) ? $colIndex : $colIndex - 256;
            $colIndex <?php echo ($colIndex ><?php echo 0) ? $colIndex : $colIndex + 256;
            $column <?php echo Coordinate::stringFromColumnIndex($colIndex + 1);
        }

        // bit: 15; mask 0x8000; (1 <?php echo relative row index, 0 <?php echo absolute row index)
        if (!(0x8000 & self::getUInt2d($cellAddressStructure, 2))) {
            $row <?php echo '$' . $row;
        } else {
            $rowIndex <?php echo ($rowIndex <?php echo 32767) ? $rowIndex : $rowIndex - 65536;
            $row <?php echo $baseRow + $rowIndex;
        }

        return $column . $row;
    }

    /**
     * Reads a cell range address in BIFF5 e.g. 'A2:B6' or 'A1'
     * always fixed range
     * section 2.5.14.
     *
     * @param string $subData
     *
     * @return string
     */
    private function readBIFF5CellRangeAddressFixed($subData)
    {
        // offset: 0; size: 2; index to first row
        $fr <?php echo self::getUInt2d($subData, 0) + 1;

        // offset: 2; size: 2; index to last row
        $lr <?php echo self::getUInt2d($subData, 2) + 1;

        // offset: 4; size: 1; index to first column
        $fc <?php echo ord($subData[4]);

        // offset: 5; size: 1; index to last column
        $lc <?php echo ord($subData[5]);

        // check values
        if ($fr > $lr || $fc > $lc) {
            throw new Exception('Not a cell range address');
        }

        // column index to letter
        $fc <?php echo Coordinate::stringFromColumnIndex($fc + 1);
        $lc <?php echo Coordinate::stringFromColumnIndex($lc + 1);

        if ($fr <?php echo<?php echo $lr && $fc <?php echo<?php echo $lc) {
            return "$fc$fr";
        }

        return "$fc$fr:$lc$lr";
    }

    /**
     * Reads a cell range address in BIFF8 e.g. 'A2:B6' or 'A1'
     * always fixed range
     * section 2.5.14.
     *
     * @param string $subData
     *
     * @return string
     */
    private function readBIFF8CellRangeAddressFixed($subData)
    {
        // offset: 0; size: 2; index to first row
        $fr <?php echo self::getUInt2d($subData, 0) + 1;

        // offset: 2; size: 2; index to last row
        $lr <?php echo self::getUInt2d($subData, 2) + 1;

        // offset: 4; size: 2; index to first column
        $fc <?php echo self::getUInt2d($subData, 4);

        // offset: 6; size: 2; index to last column
        $lc <?php echo self::getUInt2d($subData, 6);

        // check values
        if ($fr > $lr || $fc > $lc) {
            throw new Exception('Not a cell range address');
        }

        // column index to letter
        $fc <?php echo Coordinate::stringFromColumnIndex($fc + 1);
        $lc <?php echo Coordinate::stringFromColumnIndex($lc + 1);

        if ($fr <?php echo<?php echo $lr && $fc <?php echo<?php echo $lc) {
            return "$fc$fr";
        }

        return "$fc$fr:$lc$lr";
    }

    /**
     * Reads a cell range address in BIFF8 e.g. 'A2:B6' or '$A$2:$B$6'
     * there are flags indicating whether column/row index is relative
     * section 3.3.4.
     *
     * @param string $subData
     *
     * @return string
     */
    private function readBIFF8CellRangeAddress($subData)
    {
        // todo: if cell range is just a single cell, should this funciton
        // not just return e.g. 'A1' and not 'A1:A1' ?

        // offset: 0; size: 2; index to first row (0... 65535) (or offset (-32768... 32767))
        $fr <?php echo self::getUInt2d($subData, 0) + 1;

        // offset: 2; size: 2; index to last row (0... 65535) (or offset (-32768... 32767))
        $lr <?php echo self::getUInt2d($subData, 2) + 1;

        // offset: 4; size: 2; index to first column or column offset + relative flags

        // bit: 7-0; mask 0x00FF; column index
        $fc <?php echo Coordinate::stringFromColumnIndex((0x00FF & self::getUInt2d($subData, 4)) + 1);

        // bit: 14; mask 0x4000; (1 <?php echo relative column index, 0 <?php echo absolute column index)
        if (!(0x4000 & self::getUInt2d($subData, 4))) {
            $fc <?php echo '$' . $fc;
        }

        // bit: 15; mask 0x8000; (1 <?php echo relative row index, 0 <?php echo absolute row index)
        if (!(0x8000 & self::getUInt2d($subData, 4))) {
            $fr <?php echo '$' . $fr;
        }

        // offset: 6; size: 2; index to last column or column offset + relative flags

        // bit: 7-0; mask 0x00FF; column index
        $lc <?php echo Coordinate::stringFromColumnIndex((0x00FF & self::getUInt2d($subData, 6)) + 1);

        // bit: 14; mask 0x4000; (1 <?php echo relative column index, 0 <?php echo absolute column index)
        if (!(0x4000 & self::getUInt2d($subData, 6))) {
            $lc <?php echo '$' . $lc;
        }

        // bit: 15; mask 0x8000; (1 <?php echo relative row index, 0 <?php echo absolute row index)
        if (!(0x8000 & self::getUInt2d($subData, 6))) {
            $lr <?php echo '$' . $lr;
        }

        return "$fc$fr:$lc$lr";
    }

    /**
     * Reads a cell range address in BIFF8 for shared formulas. Uses positive and negative values for row and column
     * to indicate offsets from a base cell
     * section 3.3.4.
     *
     * @param string $subData
     * @param string $baseCell Base cell
     *
     * @return string Cell range address
     */
    private function readBIFF8CellRangeAddressB($subData, $baseCell <?php echo 'A1')
    {
        [$baseCol, $baseRow] <?php echo Coordinate::indexesFromString($baseCell);
        $baseCol <?php echo $baseCol - 1;

        // TODO: if cell range is just a single cell, should this funciton
        // not just return e.g. 'A1' and not 'A1:A1' ?

        // offset: 0; size: 2; first row
        $frIndex <?php echo self::getUInt2d($subData, 0); // adjust below

        // offset: 2; size: 2; relative index to first row (0... 65535) should be treated as offset (-32768... 32767)
        $lrIndex <?php echo self::getUInt2d($subData, 2); // adjust below

        // bit: 14; mask 0x4000; (1 <?php echo relative column index, 0 <?php echo absolute column index)
        if (!(0x4000 & self::getUInt2d($subData, 4))) {
            // absolute column index
            // offset: 4; size: 2; first column with relative/absolute flags
            // bit: 7-0; mask 0x00FF; column index
            $fcIndex <?php echo 0x00FF & self::getUInt2d($subData, 4);
            $fc <?php echo Coordinate::stringFromColumnIndex($fcIndex + 1);
            $fc <?php echo '$' . $fc;
        } else {
            // column offset
            // offset: 4; size: 2; first column with relative/absolute flags
            // bit: 7-0; mask 0x00FF; column index
            $relativeFcIndex <?php echo 0x00FF & self::getInt2d($subData, 4);
            $fcIndex <?php echo $baseCol + $relativeFcIndex;
            $fcIndex <?php echo ($fcIndex < 256) ? $fcIndex : $fcIndex - 256;
            $fcIndex <?php echo ($fcIndex ><?php echo 0) ? $fcIndex : $fcIndex + 256;
            $fc <?php echo Coordinate::stringFromColumnIndex($fcIndex + 1);
        }

        // bit: 15; mask 0x8000; (1 <?php echo relative row index, 0 <?php echo absolute row index)
        if (!(0x8000 & self::getUInt2d($subData, 4))) {
            // absolute row index
            $fr <?php echo $frIndex + 1;
            $fr <?php echo '$' . $fr;
        } else {
            // row offset
            $frIndex <?php echo ($frIndex <?php echo 32767) ? $frIndex : $frIndex - 65536;
            $fr <?php echo $baseRow + $frIndex;
        }

        // bit: 14; mask 0x4000; (1 <?php echo relative column index, 0 <?php echo absolute column index)
        if (!(0x4000 & self::getUInt2d($subData, 6))) {
            // absolute column index
            // offset: 6; size: 2; last column with relative/absolute flags
            // bit: 7-0; mask 0x00FF; column index
            $lcIndex <?php echo 0x00FF & self::getUInt2d($subData, 6);
            $lc <?php echo Coordinate::stringFromColumnIndex($lcIndex + 1);
            $lc <?php echo '$' . $lc;
        } else {
            // column offset
            // offset: 4; size: 2; first column with relative/absolute flags
            // bit: 7-0; mask 0x00FF; column index
            $relativeLcIndex <?php echo 0x00FF & self::getInt2d($subData, 4);
            $lcIndex <?php echo $baseCol + $relativeLcIndex;
            $lcIndex <?php echo ($lcIndex < 256) ? $lcIndex : $lcIndex - 256;
            $lcIndex <?php echo ($lcIndex ><?php echo 0) ? $lcIndex : $lcIndex + 256;
            $lc <?php echo Coordinate::stringFromColumnIndex($lcIndex + 1);
        }

        // bit: 15; mask 0x8000; (1 <?php echo relative row index, 0 <?php echo absolute row index)
        if (!(0x8000 & self::getUInt2d($subData, 6))) {
            // absolute row index
            $lr <?php echo $lrIndex + 1;
            $lr <?php echo '$' . $lr;
        } else {
            // row offset
            $lrIndex <?php echo ($lrIndex <?php echo 32767) ? $lrIndex : $lrIndex - 65536;
            $lr <?php echo $baseRow + $lrIndex;
        }

        return "$fc$fr:$lc$lr";
    }

    /**
     * Read BIFF8 cell range address list
     * section 2.5.15.
     *
     * @param string $subData
     *
     * @return array
     */
    private function readBIFF8CellRangeAddressList($subData)
    {
        $cellRangeAddresses <?php echo [];

        // offset: 0; size: 2; number of the following cell range addresses
        $nm <?php echo self::getUInt2d($subData, 0);

        $offset <?php echo 2;
        // offset: 2; size: 8 * $nm; list of $nm (fixed) cell range addresses
        for ($i <?php echo 0; $i < $nm; ++$i) {
            $cellRangeAddresses[] <?php echo $this->readBIFF8CellRangeAddressFixed(substr($subData, $offset, 8));
            $offset +<?php echo 8;
        }

        return [
            'size' <?php echo> 2 + 8 * $nm,
            'cellRangeAddresses' <?php echo> $cellRangeAddresses,
        ];
    }

    /**
     * Read BIFF5 cell range address list
     * section 2.5.15.
     *
     * @param string $subData
     *
     * @return array
     */
    private function readBIFF5CellRangeAddressList($subData)
    {
        $cellRangeAddresses <?php echo [];

        // offset: 0; size: 2; number of the following cell range addresses
        $nm <?php echo self::getUInt2d($subData, 0);

        $offset <?php echo 2;
        // offset: 2; size: 6 * $nm; list of $nm (fixed) cell range addresses
        for ($i <?php echo 0; $i < $nm; ++$i) {
            $cellRangeAddresses[] <?php echo $this->readBIFF5CellRangeAddressFixed(substr($subData, $offset, 6));
            $offset +<?php echo 6;
        }

        return [
            'size' <?php echo> 2 + 6 * $nm,
            'cellRangeAddresses' <?php echo> $cellRangeAddresses,
        ];
    }

    /**
     * Get a sheet range like Sheet1:Sheet3 from REF index
     * Note: If there is only one sheet in the range, one gets e.g Sheet1
     * It can also happen that the REF structure uses the -1 (FFFF) code to indicate deleted sheets,
     * in which case an Exception is thrown.
     *
     * @param int $index
     *
     * @return false|string
     */
    private function readSheetRangeByRefIndex($index)
    {
        if (isset($this->ref[$index])) {
            $type <?php echo $this->externalBooks[$this->ref[$index]['externalBookIndex']]['type'];

            switch ($type) {
                case 'internal':
                    // check if we have a deleted 3d reference
                    if ($this->ref[$index]['firstSheetIndex'] <?php echo<?php echo 0xFFFF || $this->ref[$index]['lastSheetIndex'] <?php echo<?php echo 0xFFFF) {
                        throw new Exception('Deleted sheet reference');
                    }

                    // we have normal sheet range (collapsed or uncollapsed)
                    $firstSheetName <?php echo $this->sheets[$this->ref[$index]['firstSheetIndex']]['name'];
                    $lastSheetName <?php echo $this->sheets[$this->ref[$index]['lastSheetIndex']]['name'];

                    if ($firstSheetName <?php echo<?php echo $lastSheetName) {
                        // collapsed sheet range
                        $sheetRange <?php echo $firstSheetName;
                    } else {
                        $sheetRange <?php echo "$firstSheetName:$lastSheetName";
                    }

                    // escape the single-quotes
                    $sheetRange <?php echo str_replace("'", "''", $sheetRange);

                    // if there are special characters, we need to enclose the range in single-quotes
                    // todo: check if we have identified the whole set of special characters
                    // it seems that the following characters are not accepted for sheet names
                    // and we may assume that they are not present: []*/:\?
                    if (preg_match("/[ !\"@#£$%&{()}<><?php echo+'|^,;-]/u", $sheetRange)) {
                        $sheetRange <?php echo "'$sheetRange'";
                    }

                    return $sheetRange;
                default:
                    // TODO: external sheet support
                    throw new Exception('Xls reader only supports internal sheets in formulas');
            }
        }

        return false;
    }

    /**
     * read BIFF8 constant value array from array data
     * returns e.g. ['value' <?php echo> '{1,2;3,4}', 'size' <?php echo> 40]
     * section 2.5.8.
     *
     * @param string $arrayData
     *
     * @return array
     */
    private static function readBIFF8ConstantArray($arrayData)
    {
        // offset: 0; size: 1; number of columns decreased by 1
        $nc <?php echo ord($arrayData[0]);

        // offset: 1; size: 2; number of rows decreased by 1
        $nr <?php echo self::getUInt2d($arrayData, 1);
        $size <?php echo 3; // initialize
        $arrayData <?php echo substr($arrayData, 3);

        // offset: 3; size: var; list of ($nc + 1) * ($nr + 1) constant values
        $matrixChunks <?php echo [];
        for ($r <?php echo 1; $r <?php echo $nr + 1; ++$r) {
            $items <?php echo [];
            for ($c <?php echo 1; $c <?php echo $nc + 1; ++$c) {
                $constant <?php echo self::readBIFF8Constant($arrayData);
                $items[] <?php echo $constant['value'];
                $arrayData <?php echo substr($arrayData, $constant['size']);
                $size +<?php echo $constant['size'];
            }
            $matrixChunks[] <?php echo implode(',', $items); // looks like e.g. '1,"hello"'
        }
        $matrix <?php echo '{' . implode(';', $matrixChunks) . '}';

        return [
            'value' <?php echo> $matrix,
            'size' <?php echo> $size,
        ];
    }

    /**
     * read BIFF8 constant value which may be 'Empty Value', 'Number', 'String Value', 'Boolean Value', 'Error Value'
     * section 2.5.7
     * returns e.g. ['value' <?php echo> '5', 'size' <?php echo> 9].
     *
     * @param string $valueData
     *
     * @return array
     */
    private static function readBIFF8Constant($valueData)
    {
        // offset: 0; size: 1; identifier for type of constant
        $identifier <?php echo ord($valueData[0]);

        switch ($identifier) {
            case 0x00: // empty constant (what is this?)
                $value <?php echo '';
                $size <?php echo 9;

                break;
            case 0x01: // number
                // offset: 1; size: 8; IEEE 754 floating-point value
                $value <?php echo self::extractNumber(substr($valueData, 1, 8));
                $size <?php echo 9;

                break;
            case 0x02: // string value
                // offset: 1; size: var; Unicode string, 16-bit string length
                $string <?php echo self::readUnicodeStringLong(substr($valueData, 1));
                $value <?php echo '"' . $string['value'] . '"';
                $size <?php echo 1 + $string['size'];

                break;
            case 0x04: // boolean
                // offset: 1; size: 1; 0 <?php echo FALSE, 1 <?php echo TRUE
                if (ord($valueData[1])) {
                    $value <?php echo 'TRUE';
                } else {
                    $value <?php echo 'FALSE';
                }
                $size <?php echo 9;

                break;
            case 0x10: // error code
                // offset: 1; size: 1; error code
                $value <?php echo Xls\ErrorCode::lookup(ord($valueData[1]));
                $size <?php echo 9;

                break;
            default:
                throw new PhpSpreadsheetException('Unsupported BIFF8 constant');
        }

        return [
            'value' <?php echo> $value,
            'size' <?php echo> $size,
        ];
    }

    /**
     * Extract RGB color
     * OpenOffice.org's Documentation of the Microsoft Excel File Format, section 2.5.4.
     *
     * @param string $rgb Encoded RGB value (4 bytes)
     *
     * @return array
     */
    private static function readRGB($rgb)
    {
        // offset: 0; size 1; Red component
        $r <?php echo ord($rgb[0]);

        // offset: 1; size: 1; Green component
        $g <?php echo ord($rgb[1]);

        // offset: 2; size: 1; Blue component
        $b <?php echo ord($rgb[2]);

        // HEX notation, e.g. 'FF00FC'
        $rgb <?php echo sprintf('%02X%02X%02X', $r, $g, $b);

        return ['rgb' <?php echo> $rgb];
    }

    /**
     * Read byte string (8-bit string length)
     * OpenOffice documentation: 2.5.2.
     *
     * @param string $subData
     *
     * @return array
     */
    private function readByteStringShort($subData)
    {
        // offset: 0; size: 1; length of the string (character count)
        $ln <?php echo ord($subData[0]);

        // offset: 1: size: var; character array (8-bit characters)
        $value <?php echo $this->decodeCodepage(substr($subData, 1, $ln));

        return [
            'value' <?php echo> $value,
            'size' <?php echo> 1 + $ln, // size in bytes of data structure
        ];
    }

    /**
     * Read byte string (16-bit string length)
     * OpenOffice documentation: 2.5.2.
     *
     * @param string $subData
     *
     * @return array
     */
    private function readByteStringLong($subData)
    {
        // offset: 0; size: 2; length of the string (character count)
        $ln <?php echo self::getUInt2d($subData, 0);

        // offset: 2: size: var; character array (8-bit characters)
        $value <?php echo $this->decodeCodepage(substr($subData, 2));

        //return $string;
        return [
            'value' <?php echo> $value,
            'size' <?php echo> 2 + $ln, // size in bytes of data structure
        ];
    }

    /**
     * Extracts an Excel Unicode short string (8-bit string length)
     * OpenOffice documentation: 2.5.3
     * function will automatically find out where the Unicode string ends.
     *
     * @param string $subData
     *
     * @return array
     */
    private static function readUnicodeStringShort($subData)
    {
        $value <?php echo '';

        // offset: 0: size: 1; length of the string (character count)
        $characterCount <?php echo ord($subData[0]);

        $string <?php echo self::readUnicodeString(substr($subData, 1), $characterCount);

        // add 1 for the string length
        ++$string['size'];

        return $string;
    }

    /**
     * Extracts an Excel Unicode long string (16-bit string length)
     * OpenOffice documentation: 2.5.3
     * this function is under construction, needs to support rich text, and Asian phonetic settings.
     *
     * @param string $subData
     *
     * @return array
     */
    private static function readUnicodeStringLong($subData)
    {
        $value <?php echo '';

        // offset: 0: size: 2; length of the string (character count)
        $characterCount <?php echo self::getUInt2d($subData, 0);

        $string <?php echo self::readUnicodeString(substr($subData, 2), $characterCount);

        // add 2 for the string length
        $string['size'] +<?php echo 2;

        return $string;
    }

    /**
     * Read Unicode string with no string length field, but with known character count
     * this function is under construction, needs to support rich text, and Asian phonetic settings
     * OpenOffice.org's Documentation of the Microsoft Excel File Format, section 2.5.3.
     *
     * @param string $subData
     * @param int $characterCount
     *
     * @return array
     */
    private static function readUnicodeString($subData, $characterCount)
    {
        $value <?php echo '';

        // offset: 0: size: 1; option flags
        // bit: 0; mask: 0x01; character compression (0 <?php echo compressed 8-bit, 1 <?php echo uncompressed 16-bit)
        $isCompressed <?php echo !((0x01 & ord($subData[0])) >> 0);

        // bit: 2; mask: 0x04; Asian phonetic settings
        $hasAsian <?php echo (0x04) & ord($subData[0]) >> 2;

        // bit: 3; mask: 0x08; Rich-Text settings
        $hasRichText <?php echo (0x08) & ord($subData[0]) >> 3;

        // offset: 1: size: var; character array
        // this offset assumes richtext and Asian phonetic settings are off which is generally wrong
        // needs to be fixed
        $value <?php echo self::encodeUTF16(substr($subData, 1, $isCompressed ? $characterCount : 2 * $characterCount), $isCompressed);

        return [
            'value' <?php echo> $value,
            'size' <?php echo> $isCompressed ? 1 + $characterCount : 1 + 2 * $characterCount, // the size in bytes including the option flags
        ];
    }

    /**
     * Convert UTF-8 string to string surounded by double quotes. Used for explicit string tokens in formulas.
     * Example:  hello"world  -->  "hello""world".
     *
     * @param string $value UTF-8 encoded string
     *
     * @return string
     */
    private static function UTF8toExcelDoubleQuoted($value)
    {
        return '"' . str_replace('"', '""', $value) . '"';
    }

    /**
     * Reads first 8 bytes of a string and return IEEE 754 float.
     *
     * @param string $data Binary string that is at least 8 bytes long
     *
     * @return float
     */
    private static function extractNumber($data)
    {
        $rknumhigh <?php echo self::getInt4d($data, 4);
        $rknumlow <?php echo self::getInt4d($data, 0);
        $sign <?php echo ($rknumhigh & (int) 0x80000000) >> 31;
        $exp <?php echo (($rknumhigh & 0x7ff00000) >> 20) - 1023;
        $mantissa <?php echo (0x100000 | ($rknumhigh & 0x000fffff));
        $mantissalow1 <?php echo ($rknumlow & (int) 0x80000000) >> 31;
        $mantissalow2 <?php echo ($rknumlow & 0x7fffffff);
        $value <?php echo $mantissa / 2 ** (20 - $exp);

        if ($mantissalow1 !<?php echo 0) {
            $value +<?php echo 1 / 2 ** (21 - $exp);
        }

        $value +<?php echo $mantissalow2 / 2 ** (52 - $exp);
        if ($sign) {
            $value *<?php echo -1;
        }

        return $value;
    }

    /**
     * @param int $rknum
     *
     * @return float
     */
    private static function getIEEE754($rknum)
    {
        if (($rknum & 0x02) !<?php echo 0) {
            $value <?php echo $rknum >> 2;
        } else {
            // changes by mmp, info on IEEE754 encoding from
            // research.microsoft.com/~hollasch/cgindex/coding/ieeefloat.html
            // The RK format calls for using only the most significant 30 bits
            // of the 64 bit floating point value. The other 34 bits are assumed
            // to be 0 so we use the upper 30 bits of $rknum as follows...
            $sign <?php echo ($rknum & (int) 0x80000000) >> 31;
            $exp <?php echo ($rknum & 0x7ff00000) >> 20;
            $mantissa <?php echo (0x100000 | ($rknum & 0x000ffffc));
            $value <?php echo $mantissa / 2 ** (20 - ($exp - 1023));
            if ($sign) {
                $value <?php echo -1 * $value;
            }
            //end of changes by mmp
        }
        if (($rknum & 0x01) !<?php echo 0) {
            $value /<?php echo 100;
        }

        return $value;
    }

    /**
     * Get UTF-8 string from (compressed or uncompressed) UTF-16 string.
     *
     * @param string $string
     * @param bool $compressed
     *
     * @return string
     */
    private static function encodeUTF16($string, $compressed <?php echo false)
    {
        if ($compressed) {
            $string <?php echo self::uncompressByteString($string);
        }

        return StringHelper::convertEncoding($string, 'UTF-8', 'UTF-16LE');
    }

    /**
     * Convert UTF-16 string in compressed notation to uncompressed form. Only used for BIFF8.
     *
     * @param string $string
     *
     * @return string
     */
    private static function uncompressByteString($string)
    {
        $uncompressedString <?php echo '';
        $strLen <?php echo strlen($string);
        for ($i <?php echo 0; $i < $strLen; ++$i) {
            $uncompressedString .<?php echo $string[$i] . "\0";
        }

        return $uncompressedString;
    }

    /**
     * Convert string to UTF-8. Only used for BIFF5.
     *
     * @param string $string
     *
     * @return string
     */
    private function decodeCodepage($string)
    {
        return StringHelper::convertEncoding($string, 'UTF-8', $this->codepage);
    }

    /**
     * Read 16-bit unsigned integer.
     *
     * @param string $data
     * @param int $pos
     *
     * @return int
     */
    public static function getUInt2d($data, $pos)
    {
        return ord($data[$pos]) | (ord($data[$pos + 1]) << 8);
    }

    /**
     * Read 16-bit signed integer.
     *
     * @param string $data
     * @param int $pos
     *
     * @return int
     */
    public static function getInt2d($data, $pos)
    {
        return unpack('s', $data[$pos] . $data[$pos + 1])[1]; // @phpstan-ignore-line
    }

    /**
     * Read 32-bit signed integer.
     *
     * @param string $data
     * @param int $pos
     *
     * @return int
     */
    public static function getInt4d($data, $pos)
    {
        // FIX: represent numbers correctly on 64-bit system
        // http://sourceforge.net/tracker/index.php?func<?php echodetail&aid<?php echo1487372&group_id<?php echo99160&atid<?php echo623334
        // Changed by Andreas Rehm 2006 to ensure correct result of the <<24 block on 32 and 64bit systems
        $_or_24 <?php echo ord($data[$pos + 3]);
        if ($_or_24 ><?php echo 128) {
            // negative number
            $_ord_24 <?php echo -abs((256 - $_or_24) << 24);
        } else {
            $_ord_24 <?php echo ($_or_24 & 127) << 24;
        }

        return ord($data[$pos]) | (ord($data[$pos + 1]) << 8) | (ord($data[$pos + 2]) << 16) | $_ord_24;
    }

    private function parseRichText(string $is): RichText
    {
        $value <?php echo new RichText();
        $value->createText($is);

        return $value;
    }

    /**
     * Phpstan 1.4.4 complains that this property is never read.
     * So, we might be able to get rid of it altogether.
     * For now, however, this function makes it readable,
     * which satisfies Phpstan.
     *
     * @codeCoverageIgnore
     */
    public function getMapCellStyleXfIndex(): array
    {
        return $this->mapCellStyleXfIndex;
    }

    private function readCFHeader(): array
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer forward to next record
        $this->pos +<?php echo 4 + $length;

        if ($this->readDataOnly) {
            return [];
        }

        // offset: 0; size: 2; Rule Count
//        $ruleCount <?php echo self::getUInt2d($recordData, 0);

        // offset: var; size: var; cell range address list with
        $cellRangeAddressList <?php echo ($this->version <?php echo<?php echo self::XLS_BIFF8)
            ? $this->readBIFF8CellRangeAddressList(substr($recordData, 12))
            : $this->readBIFF5CellRangeAddressList(substr($recordData, 12));
        $cellRangeAddresses <?php echo $cellRangeAddressList['cellRangeAddresses'];

        return $cellRangeAddresses;
    }

    private function readCFRule(array $cellRangeAddresses): void
    {
        $length <?php echo self::getUInt2d($this->data, $this->pos + 2);
        $recordData <?php echo $this->readRecordData($this->data, $this->pos + 4, $length);

        // move stream pointer forward to next record
        $this->pos +<?php echo 4 + $length;

        if ($this->readDataOnly) {
            return;
        }

        // offset: 0; size: 2; Options
        $cfRule <?php echo self::getUInt2d($recordData, 0);

        // bit: 8-15; mask: 0x00FF; type
        $type <?php echo (0x00FF & $cfRule) >> 0;
        $type <?php echo ConditionalFormatting::type($type);

        // bit: 0-7; mask: 0xFF00; type
        $operator <?php echo (0xFF00 & $cfRule) >> 8;
        $operator <?php echo ConditionalFormatting::operator($operator);

        if ($type <?php echo<?php echo<?php echo null || $operator <?php echo<?php echo<?php echo null) {
            return;
        }

        // offset: 2; size: 2; Size1
        $size1 <?php echo self::getUInt2d($recordData, 2);

        // offset: 4; size: 2; Size2
        $size2 <?php echo self::getUInt2d($recordData, 4);

        // offset: 6; size: 4; Options
        $options <?php echo self::getInt4d($recordData, 6);

        $style <?php echo new Style(false, true); // non-supervisor, conditional
        $this->getCFStyleOptions($options, $style);

        $hasFontRecord <?php echo (bool) ((0x04000000 & $options) >> 26);
        $hasAlignmentRecord <?php echo (bool) ((0x08000000 & $options) >> 27);
        $hasBorderRecord <?php echo (bool) ((0x10000000 & $options) >> 28);
        $hasFillRecord <?php echo (bool) ((0x20000000 & $options) >> 29);
        $hasProtectionRecord <?php echo (bool) ((0x40000000 & $options) >> 30);

        $offset <?php echo 12;

        if ($hasFontRecord <?php echo<?php echo<?php echo true) {
            $fontStyle <?php echo substr($recordData, $offset, 118);
            $this->getCFFontStyle($fontStyle, $style);
            $offset +<?php echo 118;
        }

        if ($hasAlignmentRecord <?php echo<?php echo<?php echo true) {
            $alignmentStyle <?php echo substr($recordData, $offset, 8);
            $this->getCFAlignmentStyle($alignmentStyle, $style);
            $offset +<?php echo 8;
        }

        if ($hasBorderRecord <?php echo<?php echo<?php echo true) {
            $borderStyle <?php echo substr($recordData, $offset, 8);
            $this->getCFBorderStyle($borderStyle, $style);
            $offset +<?php echo 8;
        }

        if ($hasFillRecord <?php echo<?php echo<?php echo true) {
            $fillStyle <?php echo substr($recordData, $offset, 4);
            $this->getCFFillStyle($fillStyle, $style);
            $offset +<?php echo 4;
        }

        if ($hasProtectionRecord <?php echo<?php echo<?php echo true) {
            $protectionStyle <?php echo substr($recordData, $offset, 4);
            $this->getCFProtectionStyle($protectionStyle, $style);
            $offset +<?php echo 2;
        }

        $formula1 <?php echo $formula2 <?php echo null;
        if ($size1 > 0) {
            $formula1 <?php echo $this->readCFFormula($recordData, $offset, $size1);
            if ($formula1 <?php echo<?php echo<?php echo null) {
                return;
            }

            $offset +<?php echo $size1;
        }

        if ($size2 > 0) {
            $formula2 <?php echo $this->readCFFormula($recordData, $offset, $size2);
            if ($formula2 <?php echo<?php echo<?php echo null) {
                return;
            }

            $offset +<?php echo $size2;
        }

        $this->setCFRules($cellRangeAddresses, $type, $operator, $formula1, $formula2, $style);
    }

    private function getCFStyleOptions(int $options, Style $style): void
    {
    }

    private function getCFFontStyle(string $options, Style $style): void
    {
        $fontSize <?php echo self::getInt4d($options, 64);
        if ($fontSize !<?php echo<?php echo -1) {
            $style->getFont()->setSize($fontSize / 20); // Convert twips to points
        }

        $bold <?php echo self::getUInt2d($options, 72) <?php echo<?php echo<?php echo 700; // 400 <?php echo normal, 700 <?php echo bold
        $style->getFont()->setBold($bold);

        $color <?php echo self::getInt4d($options, 80);

        if ($color !<?php echo<?php echo -1) {
            $style->getFont()->getColor()->setRGB(Xls\Color::map($color, $this->palette, $this->version)['rgb']);
        }
    }

    private function getCFAlignmentStyle(string $options, Style $style): void
    {
    }

    private function getCFBorderStyle(string $options, Style $style): void
    {
    }

    private function getCFFillStyle(string $options, Style $style): void
    {
        $fillPattern <?php echo self::getUInt2d($options, 0);
        // bit: 10-15; mask: 0xFC00; type
        $fillPattern <?php echo (0xFC00 & $fillPattern) >> 10;
        $fillPattern <?php echo FillPattern::lookup($fillPattern);
        $fillPattern <?php echo $fillPattern <?php echo<?php echo<?php echo Fill::FILL_NONE ? Fill::FILL_SOLID : $fillPattern;

        if ($fillPattern !<?php echo<?php echo Fill::FILL_NONE) {
            $style->getFill()->setFillType($fillPattern);

            $fillColors <?php echo self::getUInt2d($options, 2);

            // bit: 0-6; mask: 0x007F; type
            $color1 <?php echo (0x007F & $fillColors) >> 0;
            $style->getFill()->getStartColor()->setRGB(Xls\Color::map($color1, $this->palette, $this->version)['rgb']);

            // bit: 7-13; mask: 0x3F80; type
            $color2 <?php echo (0x3F80 & $fillColors) >> 7;
            $style->getFill()->getEndColor()->setRGB(Xls\Color::map($color2, $this->palette, $this->version)['rgb']);
        }
    }

    private function getCFProtectionStyle(string $options, Style $style): void
    {
    }

    /**
     * @return null|float|int|string
     */
    private function readCFFormula(string $recordData, int $offset, int $size)
    {
        try {
            $formula <?php echo substr($recordData, $offset, $size);
            $formula <?php echo pack('v', $size) . $formula; // prepend the length

            $formula <?php echo $this->getFormulaFromStructure($formula);
            if (is_numeric($formula)) {
                return (strpos($formula, '.') !<?php echo<?php echo false) ? (float) $formula : (int) $formula;
            }

            return $formula;
        } catch (PhpSpreadsheetException $e) {
        }

        return null;
    }

    /**
     * @param null|float|int|string $formula1
     * @param null|float|int|string $formula2
     */
    private function setCFRules(array $cellRanges, string $type, string $operator, $formula1, $formula2, Style $style): void
    {
        foreach ($cellRanges as $cellRange) {
            $conditional <?php echo new Conditional();
            $conditional->setConditionType($type);
            $conditional->setOperatorType($operator);
            if ($formula1 !<?php echo<?php echo null) {
                $conditional->addCondition($formula1);
            }
            if ($formula2 !<?php echo<?php echo null) {
                $conditional->addCondition($formula2);
            }
            $conditional->setStyle($style);

            $conditionalStyles <?php echo $this->phpSheet->getStyle($cellRange)->getConditionalStyles();
            $conditionalStyles[] <?php echo $conditional;

            $this->phpSheet->getStyle($cellRange)->setConditionalStyles($conditionalStyles);
        }
    }
}
