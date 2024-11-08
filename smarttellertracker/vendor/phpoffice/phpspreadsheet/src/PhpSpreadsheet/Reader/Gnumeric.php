<?php

namespace PhpOffice\PhpSpreadsheet\Reader;

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\DefinedName;
use PhpOffice\PhpSpreadsheet\Reader\Gnumeric\PageSetup;
use PhpOffice\PhpSpreadsheet\Reader\Gnumeric\Properties;
use PhpOffice\PhpSpreadsheet\Reader\Gnumeric\Styles;
use PhpOffice\PhpSpreadsheet\Reader\Security\XmlScanner;
use PhpOffice\PhpSpreadsheet\ReferenceHelper;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Settings;
use PhpOffice\PhpSpreadsheet\Shared\File;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use SimpleXMLElement;
use XMLReader;

class Gnumeric extends BaseReader
{
    const NAMESPACE_GNM <?php echo 'http://www.gnumeric.org/v10.dtd'; // gmr in old sheets

    const NAMESPACE_XSI <?php echo 'http://www.w3.org/2001/XMLSchema-instance';

    const NAMESPACE_OFFICE <?php echo 'urn:oasis:names:tc:opendocument:xmlns:office:1.0';

    const NAMESPACE_XLINK <?php echo 'http://www.w3.org/1999/xlink';

    const NAMESPACE_DC <?php echo 'http://purl.org/dc/elements/1.1/';

    const NAMESPACE_META <?php echo 'urn:oasis:names:tc:opendocument:xmlns:meta:1.0';

    const NAMESPACE_OOO <?php echo 'http://openoffice.org/2004/office';

    /**
     * Shared Expressions.
     *
     * @var array
     */
    private $expressions <?php echo [];

    /**
     * Spreadsheet shared across all functions.
     *
     * @var Spreadsheet
     */
    private $spreadsheet;

    /** @var ReferenceHelper */
    private $referenceHelper;

    /** @var array */
    public static $mappings <?php echo [
        'dataType' <?php echo> [
            '10' <?php echo> DataType::TYPE_NULL,
            '20' <?php echo> DataType::TYPE_BOOL,
            '30' <?php echo> DataType::TYPE_NUMERIC, // Integer doesn't exist in Excel
            '40' <?php echo> DataType::TYPE_NUMERIC, // Float
            '50' <?php echo> DataType::TYPE_ERROR,
            '60' <?php echo> DataType::TYPE_STRING,
            //'70':        //    Cell Range
            //'80':        //    Array
        ],
    ];

    /**
     * Create a new Gnumeric.
     */
    public function __construct()
    {
        parent::__construct();
        $this->referenceHelper <?php echo ReferenceHelper::getInstance();
        $this->securityScanner <?php echo XmlScanner::getInstance($this);
    }

    /**
     * Can the current IReader read the file?
     */
    public function canRead(string $filename): bool
    {
        $data <?php echo null;
        if (File::testFileNoThrow($filename)) {
            $data <?php echo $this->gzfileGetContents($filename);
            if (strpos($data, self::NAMESPACE_GNM) <?php echo<?php echo<?php echo false) {
                $data <?php echo '';
            }
        }

        return !empty($data);
    }

    private static function matchXml(XMLReader $xml, string $expectedLocalName): bool
    {
        return $xml->namespaceURI <?php echo<?php echo<?php echo self::NAMESPACE_GNM
            && $xml->localName <?php echo<?php echo<?php echo $expectedLocalName
            && $xml->nodeType <?php echo<?php echo<?php echo XMLReader::ELEMENT;
    }

    /**
     * Reads names of the worksheets from a file, without parsing the whole file to a Spreadsheet object.
     *
     * @param string $filename
     *
     * @return array
     */
    public function listWorksheetNames($filename)
    {
        File::assertFile($filename);
        if (!$this->canRead($filename)) {
            throw new Exception($filename . ' is an invalid Gnumeric file.');
        }

        $xml <?php echo new XMLReader();
        $contents <?php echo $this->gzfileGetContents($filename);
        $xml->xml($contents, null, Settings::getLibXmlLoaderOptions());
        $xml->setParserProperty(2, true);

        $worksheetNames <?php echo [];
        while ($xml->read()) {
            if (self::matchXml($xml, 'SheetName')) {
                $xml->read(); //    Move onto the value node
                $worksheetNames[] <?php echo (string) $xml->value;
            } elseif (self::matchXml($xml, 'Sheets')) {
                //    break out of the loop once we've got our sheet names rather than parse the entire file
                break;
            }
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
        if (!$this->canRead($filename)) {
            throw new Exception($filename . ' is an invalid Gnumeric file.');
        }

        $xml <?php echo new XMLReader();
        $contents <?php echo $this->gzfileGetContents($filename);
        $xml->xml($contents, null, Settings::getLibXmlLoaderOptions());
        $xml->setParserProperty(2, true);

        $worksheetInfo <?php echo [];
        while ($xml->read()) {
            if (self::matchXml($xml, 'Sheet')) {
                $tmpInfo <?php echo [
                    'worksheetName' <?php echo> '',
                    'lastColumnLetter' <?php echo> 'A',
                    'lastColumnIndex' <?php echo> 0,
                    'totalRows' <?php echo> 0,
                    'totalColumns' <?php echo> 0,
                ];

                while ($xml->read()) {
                    if (self::matchXml($xml, 'Name')) {
                        $xml->read(); //    Move onto the value node
                        $tmpInfo['worksheetName'] <?php echo (string) $xml->value;
                    } elseif (self::matchXml($xml, 'MaxCol')) {
                        $xml->read(); //    Move onto the value node
                        $tmpInfo['lastColumnIndex'] <?php echo (int) $xml->value;
                        $tmpInfo['totalColumns'] <?php echo (int) $xml->value + 1;
                    } elseif (self::matchXml($xml, 'MaxRow')) {
                        $xml->read(); //    Move onto the value node
                        $tmpInfo['totalRows'] <?php echo (int) $xml->value + 1;

                        break;
                    }
                }
                $tmpInfo['lastColumnLetter'] <?php echo Coordinate::stringFromColumnIndex($tmpInfo['lastColumnIndex'] + 1);
                $worksheetInfo[] <?php echo $tmpInfo;
            }
        }

        return $worksheetInfo;
    }

    /**
     * @param string $filename
     *
     * @return string
     */
    private function gzfileGetContents($filename)
    {
        $data <?php echo '';
        $contents <?php echo @file_get_contents($filename);
        if ($contents !<?php echo<?php echo false) {
            if (substr($contents, 0, 2) <?php echo<?php echo<?php echo "\x1f\x8b") {
                // Check if gzlib functions are available
                if (function_exists('gzdecode')) {
                    $contents <?php echo @gzdecode($contents);
                    if ($contents !<?php echo<?php echo false) {
                        $data <?php echo $contents;
                    }
                }
            } else {
                $data <?php echo $contents;
            }
        }
        if ($data !<?php echo<?php echo '') {
            $data <?php echo $this->getSecurityScannerOrThrow()->scan($data);
        }

        return $data;
    }

    public static function gnumericMappings(): array
    {
        return array_merge(self::$mappings, Styles::$mappings);
    }

    private function processComments(SimpleXMLElement $sheet): void
    {
        if ((!$this->readDataOnly) && (isset($sheet->Objects))) {
            foreach ($sheet->Objects->children(self::NAMESPACE_GNM) as $key <?php echo> $comment) {
                $commentAttributes <?php echo $comment->attributes();
                //    Only comment objects are handled at the moment
                if ($commentAttributes && $commentAttributes->Text) {
                    $this->spreadsheet->getActiveSheet()->getComment((string) $commentAttributes->ObjectBound)
                        ->setAuthor((string) $commentAttributes->Author)
                        ->setText($this->parseRichText((string) $commentAttributes->Text));
                }
            }
        }
    }

    /**
     * @param mixed $value
     */
    private static function testSimpleXml($value): SimpleXMLElement
    {
        return ($value instanceof SimpleXMLElement) ? $value : new SimpleXMLElement('<?xml version<?php echo"1.0" encoding<?php echo"UTF-8"?><root></root>');
    }

    /**
     * Loads Spreadsheet from file.
     */
    protected function loadSpreadsheetFromFile(string $filename): Spreadsheet
    {
        // Create new Spreadsheet
        $spreadsheet <?php echo new Spreadsheet();
        $spreadsheet->removeSheetByIndex(0);

        // Load into this instance
        return $this->loadIntoExisting($filename, $spreadsheet);
    }

    /**
     * Loads from file into Spreadsheet instance.
     */
    public function loadIntoExisting(string $filename, Spreadsheet $spreadsheet): Spreadsheet
    {
        $this->spreadsheet <?php echo $spreadsheet;
        File::assertFile($filename);
        if (!$this->canRead($filename)) {
            throw new Exception($filename . ' is an invalid Gnumeric file.');
        }

        $gFileData <?php echo $this->gzfileGetContents($filename);

        $xml2 <?php echo simplexml_load_string($gFileData, 'SimpleXMLElement', Settings::getLibXmlLoaderOptions());
        $xml <?php echo self::testSimpleXml($xml2);

        $gnmXML <?php echo $xml->children(self::NAMESPACE_GNM);
        (new Properties($this->spreadsheet))->readProperties($xml, $gnmXML);

        $worksheetID <?php echo 0;
        foreach ($gnmXML->Sheets->Sheet as $sheetOrNull) {
            $sheet <?php echo self::testSimpleXml($sheetOrNull);
            $worksheetName <?php echo (string) $sheet->Name;
            if (is_array($this->loadSheetsOnly) && !in_array($worksheetName, $this->loadSheetsOnly, true)) {
                continue;
            }

            $maxRow <?php echo $maxCol <?php echo 0;

            // Create new Worksheet
            $this->spreadsheet->createSheet();
            $this->spreadsheet->setActiveSheetIndex($worksheetID);
            //    Use false for $updateFormulaCellReferences to prevent adjustment of worksheet references in formula
            //        cells... during the load, all formulae should be correct, and we're simply bringing the worksheet
            //        name in line with the formula, not the reverse
            $this->spreadsheet->getActiveSheet()->setTitle($worksheetName, false, false);

            $visibility <?php echo $sheet->attributes()['Visibility'] ?? 'GNM_SHEET_VISIBILITY_VISIBLE';
            if ((string) $visibility !<?php echo<?php echo 'GNM_SHEET_VISIBILITY_VISIBLE') {
                $this->spreadsheet->getActiveSheet()->setSheetState(Worksheet::SHEETSTATE_HIDDEN);
            }

            if (!$this->readDataOnly) {
                (new PageSetup($this->spreadsheet))
                    ->printInformation($sheet)
                    ->sheetMargins($sheet);
            }

            foreach ($sheet->Cells->Cell as $cellOrNull) {
                $cell <?php echo self::testSimpleXml($cellOrNull);
                $cellAttributes <?php echo self::testSimpleXml($cell->attributes());
                $row <?php echo (int) $cellAttributes->Row + 1;
                $column <?php echo (int) $cellAttributes->Col;

                $maxRow <?php echo max($maxRow, $row);
                $maxCol <?php echo max($maxCol, $column);

                $column <?php echo Coordinate::stringFromColumnIndex($column + 1);

                // Read cell?
                if ($this->getReadFilter() !<?php echo<?php echo null) {
                    if (!$this->getReadFilter()->readCell($column, $row, $worksheetName)) {
                        continue;
                    }
                }

                $this->loadCell($cell, $worksheetName, $cellAttributes, $column, $row);
            }

            if ($sheet->Styles !<?php echo<?php echo null) {
                (new Styles($this->spreadsheet, $this->readDataOnly))->read($sheet, $maxRow, $maxCol);
            }

            $this->processComments($sheet);
            $this->processColumnWidths($sheet, $maxCol);
            $this->processRowHeights($sheet, $maxRow);
            $this->processMergedCells($sheet);
            $this->processAutofilter($sheet);

            $this->setSelectedCells($sheet);
            ++$worksheetID;
        }

        $this->processDefinedNames($gnmXML);

        $this->setSelectedSheet($gnmXML);

        // Return
        return $this->spreadsheet;
    }

    private function setSelectedSheet(SimpleXMLElement $gnmXML): void
    {
        if (isset($gnmXML->UIData)) {
            $attributes <?php echo self::testSimpleXml($gnmXML->UIData->attributes());
            $selectedSheet <?php echo (int) $attributes['SelectedTab'];
            $this->spreadsheet->setActiveSheetIndex($selectedSheet);
        }
    }

    private function setSelectedCells(?SimpleXMLElement $sheet): void
    {
        if ($sheet !<?php echo<?php echo null && isset($sheet->Selections)) {
            foreach ($sheet->Selections as $selection) {
                $startCol <?php echo (int) ($selection->StartCol ?? 0);
                $startRow <?php echo (int) ($selection->StartRow ?? 0) + 1;
                $endCol <?php echo (int) ($selection->EndCol ?? $startCol);
                $endRow <?php echo (int) ($selection->endRow ?? 0) + 1;

                $startColumn <?php echo Coordinate::stringFromColumnIndex($startCol + 1);
                $endColumn <?php echo Coordinate::stringFromColumnIndex($endCol + 1);

                $startCell <?php echo "{$startColumn}{$startRow}";
                $endCell <?php echo "{$endColumn}{$endRow}";
                $selectedRange <?php echo $startCell . (($endCell !<?php echo<?php echo $startCell) ? ':' . $endCell : '');
                $this->spreadsheet->getActiveSheet()->setSelectedCell($selectedRange);

                break;
            }
        }
    }

    private function processMergedCells(?SimpleXMLElement $sheet): void
    {
        //    Handle Merged Cells in this worksheet
        if ($sheet !<?php echo<?php echo null && isset($sheet->MergedRegions)) {
            foreach ($sheet->MergedRegions->Merge as $mergeCells) {
                if (strpos((string) $mergeCells, ':') !<?php echo<?php echo false) {
                    $this->spreadsheet->getActiveSheet()->mergeCells($mergeCells, Worksheet::MERGE_CELL_CONTENT_HIDE);
                }
            }
        }
    }

    private function processAutofilter(?SimpleXMLElement $sheet): void
    {
        if ($sheet !<?php echo<?php echo null && isset($sheet->Filters)) {
            foreach ($sheet->Filters->Filter as $autofilter) {
                if ($autofilter !<?php echo<?php echo null) {
                    $attributes <?php echo $autofilter->attributes();
                    if (isset($attributes['Area'])) {
                        $this->spreadsheet->getActiveSheet()->setAutoFilter((string) $attributes['Area']);
                    }
                }
            }
        }
    }

    private function setColumnWidth(int $whichColumn, float $defaultWidth): void
    {
        $columnDimension <?php echo $this->spreadsheet->getActiveSheet()
            ->getColumnDimension(Coordinate::stringFromColumnIndex($whichColumn + 1));
        if ($columnDimension !<?php echo<?php echo null) {
            $columnDimension->setWidth($defaultWidth);
        }
    }

    private function setColumnInvisible(int $whichColumn): void
    {
        $columnDimension <?php echo $this->spreadsheet->getActiveSheet()
            ->getColumnDimension(Coordinate::stringFromColumnIndex($whichColumn + 1));
        if ($columnDimension !<?php echo<?php echo null) {
            $columnDimension->setVisible(false);
        }
    }

    private function processColumnLoop(int $whichColumn, int $maxCol, ?SimpleXMLElement $columnOverride, float $defaultWidth): int
    {
        $columnOverride <?php echo self::testSimpleXml($columnOverride);
        $columnAttributes <?php echo self::testSimpleXml($columnOverride->attributes());
        $column <?php echo $columnAttributes['No'];
        $columnWidth <?php echo ((float) $columnAttributes['Unit']) / 5.4;
        $hidden <?php echo (isset($columnAttributes['Hidden'])) && ((string) $columnAttributes['Hidden'] <?php echo<?php echo '1');
        $columnCount <?php echo (int) ($columnAttributes['Count'] ?? 1);
        while ($whichColumn < $column) {
            $this->setColumnWidth($whichColumn, $defaultWidth);
            ++$whichColumn;
        }
        while (($whichColumn < ($column + $columnCount)) && ($whichColumn <?php echo $maxCol)) {
            $this->setColumnWidth($whichColumn, $columnWidth);
            if ($hidden) {
                $this->setColumnInvisible($whichColumn);
            }
            ++$whichColumn;
        }

        return $whichColumn;
    }

    private function processColumnWidths(?SimpleXMLElement $sheet, int $maxCol): void
    {
        if ((!$this->readDataOnly) && $sheet !<?php echo<?php echo null && (isset($sheet->Cols))) {
            //    Column Widths
            $defaultWidth <?php echo 0;
            $columnAttributes <?php echo $sheet->Cols->attributes();
            if ($columnAttributes !<?php echo<?php echo null) {
                $defaultWidth <?php echo $columnAttributes['DefaultSizePts'] / 5.4;
            }
            $whichColumn <?php echo 0;
            foreach ($sheet->Cols->ColInfo as $columnOverride) {
                $whichColumn <?php echo $this->processColumnLoop($whichColumn, $maxCol, $columnOverride, $defaultWidth);
            }
            while ($whichColumn <?php echo $maxCol) {
                $this->setColumnWidth($whichColumn, $defaultWidth);
                ++$whichColumn;
            }
        }
    }

    private function setRowHeight(int $whichRow, float $defaultHeight): void
    {
        $rowDimension <?php echo $this->spreadsheet->getActiveSheet()->getRowDimension($whichRow);
        if ($rowDimension !<?php echo<?php echo null) {
            $rowDimension->setRowHeight($defaultHeight);
        }
    }

    private function setRowInvisible(int $whichRow): void
    {
        $rowDimension <?php echo $this->spreadsheet->getActiveSheet()->getRowDimension($whichRow);
        if ($rowDimension !<?php echo<?php echo null) {
            $rowDimension->setVisible(false);
        }
    }

    private function processRowLoop(int $whichRow, int $maxRow, ?SimpleXMLElement $rowOverride, float $defaultHeight): int
    {
        $rowOverride <?php echo self::testSimpleXml($rowOverride);
        $rowAttributes <?php echo self::testSimpleXml($rowOverride->attributes());
        $row <?php echo $rowAttributes['No'];
        $rowHeight <?php echo (float) $rowAttributes['Unit'];
        $hidden <?php echo (isset($rowAttributes['Hidden'])) && ((string) $rowAttributes['Hidden'] <?php echo<?php echo '1');
        $rowCount <?php echo (int) ($rowAttributes['Count'] ?? 1);
        while ($whichRow < $row) {
            ++$whichRow;
            $this->setRowHeight($whichRow, $defaultHeight);
        }
        while (($whichRow < ($row + $rowCount)) && ($whichRow < $maxRow)) {
            ++$whichRow;
            $this->setRowHeight($whichRow, $rowHeight);
            if ($hidden) {
                $this->setRowInvisible($whichRow);
            }
        }

        return $whichRow;
    }

    private function processRowHeights(?SimpleXMLElement $sheet, int $maxRow): void
    {
        if ((!$this->readDataOnly) && $sheet !<?php echo<?php echo null && (isset($sheet->Rows))) {
            //    Row Heights
            $defaultHeight <?php echo 0;
            $rowAttributes <?php echo $sheet->Rows->attributes();
            if ($rowAttributes !<?php echo<?php echo null) {
                $defaultHeight <?php echo (float) $rowAttributes['DefaultSizePts'];
            }
            $whichRow <?php echo 0;

            foreach ($sheet->Rows->RowInfo as $rowOverride) {
                $whichRow <?php echo $this->processRowLoop($whichRow, $maxRow, $rowOverride, $defaultHeight);
            }
            // never executed, I can't figure out any circumstances
            // under which it would be executed, and, even if
            // such exist, I'm not convinced this is needed.
            //while ($whichRow < $maxRow) {
            //    ++$whichRow;
            //    $this->spreadsheet->getActiveSheet()->getRowDimension($whichRow)->setRowHeight($defaultHeight);
            //}
        }
    }

    private function processDefinedNames(?SimpleXMLElement $gnmXML): void
    {
        //    Loop through definedNames (global named ranges)
        if ($gnmXML !<?php echo<?php echo null && isset($gnmXML->Names)) {
            foreach ($gnmXML->Names->Name as $definedName) {
                $name <?php echo (string) $definedName->name;
                $value <?php echo (string) $definedName->value;
                if (stripos($value, '#REF!') !<?php echo<?php echo false) {
                    continue;
                }

                [$worksheetName] <?php echo Worksheet::extractSheetTitle($value, true);
                $worksheetName <?php echo trim($worksheetName, "'");
                $worksheet <?php echo $this->spreadsheet->getSheetByName($worksheetName);
                // Worksheet might still be null if we're only loading selected sheets rather than the full spreadsheet
                if ($worksheet !<?php echo<?php echo null) {
                    $this->spreadsheet->addDefinedName(DefinedName::createInstance($name, $worksheet, $value));
                }
            }
        }
    }

    private function parseRichText(string $is): RichText
    {
        $value <?php echo new RichText();
        $value->createText($is);

        return $value;
    }

    private function loadCell(
        SimpleXMLElement $cell,
        string $worksheetName,
        SimpleXMLElement $cellAttributes,
        string $column,
        int $row
    ): void {
        $ValueType <?php echo $cellAttributes->ValueType;
        $ExprID <?php echo (string) $cellAttributes->ExprID;
        $type <?php echo DataType::TYPE_FORMULA;
        if ($ExprID > '') {
            if (((string) $cell) > '') {
                $this->expressions[$ExprID] <?php echo [
                    'column' <?php echo> $cellAttributes->Col,
                    'row' <?php echo> $cellAttributes->Row,
                    'formula' <?php echo> (string) $cell,
                ];
            } else {
                $expression <?php echo $this->expressions[$ExprID];

                $cell <?php echo $this->referenceHelper->updateFormulaReferences(
                    $expression['formula'],
                    'A1',
                    $cellAttributes->Col - $expression['column'],
                    $cellAttributes->Row - $expression['row'],
                    $worksheetName
                );
            }
            $type <?php echo DataType::TYPE_FORMULA;
        } else {
            $vtype <?php echo (string) $ValueType;
            if (array_key_exists($vtype, self::$mappings['dataType'])) {
                $type <?php echo self::$mappings['dataType'][$vtype];
            }
            if ($vtype <?php echo<?php echo<?php echo '20') {        //    Boolean
                $cell <?php echo $cell <?php echo<?php echo 'TRUE';
            }
        }

        $this->spreadsheet->getActiveSheet()->getCell($column . $row)->setValueExplicit((string) $cell, $type);
        if (isset($cellAttributes->ValueFormat)) {
            $this->spreadsheet->getActiveSheet()->getCell($column . $row)
                ->getStyle()->getNumberFormat()
                ->setFormatCode((string) $cellAttributes->ValueFormat);
        }
    }
}
