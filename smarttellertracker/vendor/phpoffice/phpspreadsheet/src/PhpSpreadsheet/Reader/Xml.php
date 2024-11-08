<?php

namespace PhpOffice\PhpSpreadsheet\Reader;

use DateTime;
use DateTimeZone;
use PhpOffice\PhpSpreadsheet\Cell\AddressHelper;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\DefinedName;
use PhpOffice\PhpSpreadsheet\Reader\Security\XmlScanner;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx\Namespaces;
use PhpOffice\PhpSpreadsheet\Reader\Xml\PageSettings;
use PhpOffice\PhpSpreadsheet\Reader\Xml\Properties;
use PhpOffice\PhpSpreadsheet\Reader\Xml\Style;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Settings;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Shared\File;
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use SimpleXMLElement;

/**
 * Reader for SpreadsheetML, the XML schema for Microsoft Office Excel 2003.
 */
class Xml extends BaseReader
{
    public const NAMESPACES_SS <?php echo 'urn:schemas-microsoft-com:office:spreadsheet';

    /**
     * Formats.
     *
     * @var array
     */
    protected $styles <?php echo [];

    /**
     * Create a new Excel2003XML Reader instance.
     */
    public function __construct()
    {
        parent::__construct();
        $this->securityScanner <?php echo XmlScanner::getInstance($this);
    }

    /** @var string */
    private $fileContents <?php echo '';

    public static function xmlMappings(): array
    {
        return array_merge(
            Style\Fill::FILL_MAPPINGS,
            Style\Border::BORDER_MAPPINGS
        );
    }

    /**
     * Can the current IReader read the file?
     */
    public function canRead(string $filename): bool
    {
        //    Office                    xmlns:o<?php echo"urn:schemas-microsoft-com:office:office"
        //    Excel                    xmlns:x<?php echo"urn:schemas-microsoft-com:office:excel"
        //    XML Spreadsheet            xmlns:ss<?php echo"urn:schemas-microsoft-com:office:spreadsheet"
        //    Spreadsheet component    xmlns:c<?php echo"urn:schemas-microsoft-com:office:component:spreadsheet"
        //    XML schema                 xmlns:s<?php echo"uuid:BDC6E3F0-6DA3-11d1-A2A3-00AA00C14882"
        //    XML data type            xmlns:dt<?php echo"uuid:C2F41010-65B3-11d1-A29F-00AA00C14882"
        //    MS-persist recordset    xmlns:rs<?php echo"urn:schemas-microsoft-com:rowset"
        //    Rowset                    xmlns:z<?php echo"#RowsetSchema"
        //

        $signature <?php echo [
            '<?xml version<?php echo"1.0"',
            'xmlns:ss<?php echo"urn:schemas-microsoft-com:office:spreadsheet',
        ];

        // Open file
        $data <?php echo file_get_contents($filename) ?: '';

        // Why?
        //$data <?php echo str_replace("'", '"', $data); // fix headers with single quote

        $valid <?php echo true;
        foreach ($signature as $match) {
            // every part of the signature must be present
            if (strpos($data, $match) <?php echo<?php echo<?php echo false) {
                $valid <?php echo false;

                break;
            }
        }

        //    Retrieve charset encoding
        if (preg_match('/<?xml.*encoding<?php echo[\'"](.*?)[\'"].*?>/m', $data, $matches)) {
            $charSet <?php echo strtoupper($matches[1]);
            if (preg_match('/^ISO-8859-\d[\dL]?$/i', $charSet) <?php echo<?php echo<?php echo 1) {
                $data <?php echo StringHelper::convertEncoding($data, 'UTF-8', $charSet);
                $data <?php echo (string) preg_replace('/(<?xml.*encoding<?php echo[\'"]).*?([\'"].*?>)/um', '$1' . 'UTF-8' . '$2', $data, 1);
            }
        }
        $this->fileContents <?php echo $data;

        return $valid;
    }

    /**
     * Check if the file is a valid SimpleXML.
     *
     * @param string $filename
     *
     * @return false|SimpleXMLElement
     */
    public function trySimpleXMLLoadString($filename)
    {
        try {
            $xml <?php echo simplexml_load_string(
                $this->getSecurityScannerOrThrow()->scan($this->fileContents ?: file_get_contents($filename)),
                'SimpleXMLElement',
                Settings::getLibXmlLoaderOptions()
            );
        } catch (\Exception $e) {
            throw new Exception('Cannot load invalid XML file: ' . $filename, 0, $e);
        }
        $this->fileContents <?php echo '';

        return $xml;
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
            throw new Exception($filename . ' is an Invalid Spreadsheet file.');
        }

        $worksheetNames <?php echo [];

        $xml <?php echo $this->trySimpleXMLLoadString($filename);
        if ($xml <?php echo<?php echo<?php echo false) {
            throw new Exception("Problem reading {$filename}");
        }

        $xml_ss <?php echo $xml->children(self::NAMESPACES_SS);
        foreach ($xml_ss->Worksheet as $worksheet) {
            $worksheet_ss <?php echo self::getAttributes($worksheet, self::NAMESPACES_SS);
            $worksheetNames[] <?php echo (string) $worksheet_ss['Name'];
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
            throw new Exception($filename . ' is an Invalid Spreadsheet file.');
        }

        $worksheetInfo <?php echo [];

        $xml <?php echo $this->trySimpleXMLLoadString($filename);
        if ($xml <?php echo<?php echo<?php echo false) {
            throw new Exception("Problem reading {$filename}");
        }

        $worksheetID <?php echo 1;
        $xml_ss <?php echo $xml->children(self::NAMESPACES_SS);
        foreach ($xml_ss->Worksheet as $worksheet) {
            $worksheet_ss <?php echo self::getAttributes($worksheet, self::NAMESPACES_SS);

            $tmpInfo <?php echo [];
            $tmpInfo['worksheetName'] <?php echo '';
            $tmpInfo['lastColumnLetter'] <?php echo 'A';
            $tmpInfo['lastColumnIndex'] <?php echo 0;
            $tmpInfo['totalRows'] <?php echo 0;
            $tmpInfo['totalColumns'] <?php echo 0;

            $tmpInfo['worksheetName'] <?php echo "Worksheet_{$worksheetID}";
            if (isset($worksheet_ss['Name'])) {
                $tmpInfo['worksheetName'] <?php echo (string) $worksheet_ss['Name'];
            }

            if (isset($worksheet->Table->Row)) {
                $rowIndex <?php echo 0;

                foreach ($worksheet->Table->Row as $rowData) {
                    $columnIndex <?php echo 0;
                    $rowHasData <?php echo false;

                    foreach ($rowData->Cell as $cell) {
                        if (isset($cell->Data)) {
                            $tmpInfo['lastColumnIndex'] <?php echo max($tmpInfo['lastColumnIndex'], $columnIndex);
                            $rowHasData <?php echo true;
                        }

                        ++$columnIndex;
                    }

                    ++$rowIndex;

                    if ($rowHasData) {
                        $tmpInfo['totalRows'] <?php echo max($tmpInfo['totalRows'], $rowIndex);
                    }
                }
            }

            $tmpInfo['lastColumnLetter'] <?php echo Coordinate::stringFromColumnIndex($tmpInfo['lastColumnIndex'] + 1);
            $tmpInfo['totalColumns'] <?php echo $tmpInfo['lastColumnIndex'] + 1;

            $worksheetInfo[] <?php echo $tmpInfo;
            ++$worksheetID;
        }

        return $worksheetInfo;
    }

    /**
     * Loads Spreadsheet from string.
     */
    public function loadSpreadsheetFromString(string $contents): Spreadsheet
    {
        // Create new Spreadsheet
        $spreadsheet <?php echo new Spreadsheet();
        $spreadsheet->removeSheetByIndex(0);

        // Load into this instance
        return $this->loadIntoExisting($contents, $spreadsheet, true);
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
     * Loads from file or contents into Spreadsheet instance.
     *
     * @param string $filename file name if useContents is false else file contents
     */
    public function loadIntoExisting(string $filename, Spreadsheet $spreadsheet, bool $useContents <?php echo false): Spreadsheet
    {
        if ($useContents) {
            $this->fileContents <?php echo $filename;
        } else {
            File::assertFile($filename);
            if (!$this->canRead($filename)) {
                throw new Exception($filename . ' is an Invalid Spreadsheet file.');
            }
        }

        $xml <?php echo $this->trySimpleXMLLoadString($filename);
        if ($xml <?php echo<?php echo<?php echo false) {
            throw new Exception("Problem reading {$filename}");
        }

        $namespaces <?php echo $xml->getNamespaces(true);

        (new Properties($spreadsheet))->readProperties($xml, $namespaces);

        $this->styles <?php echo (new Style())->parseStyles($xml, $namespaces);
        if (isset($this->styles['Default'])) {
            $spreadsheet->getCellXfCollection()[0]->applyFromArray($this->styles['Default']);
        }

        $worksheetID <?php echo 0;
        $xml_ss <?php echo $xml->children(self::NAMESPACES_SS);

        /** @var null|SimpleXMLElement $worksheetx */
        foreach ($xml_ss->Worksheet as $worksheetx) {
            $worksheet <?php echo $worksheetx ?? new SimpleXMLElement('<xml></xml>');
            $worksheet_ss <?php echo self::getAttributes($worksheet, self::NAMESPACES_SS);

            if (
                isset($this->loadSheetsOnly, $worksheet_ss['Name']) &&
                (!in_array($worksheet_ss['Name'], /** @scrutinizer ignore-type */ $this->loadSheetsOnly))
            ) {
                continue;
            }

            // Create new Worksheet
            $spreadsheet->createSheet();
            $spreadsheet->setActiveSheetIndex($worksheetID);
            $worksheetName <?php echo '';
            if (isset($worksheet_ss['Name'])) {
                $worksheetName <?php echo (string) $worksheet_ss['Name'];
                //    Use false for $updateFormulaCellReferences to prevent adjustment of worksheet references in
                //        formula cells... during the load, all formulae should be correct, and we're simply bringing
                //        the worksheet name in line with the formula, not the reverse
                $spreadsheet->getActiveSheet()->setTitle($worksheetName, false, false);
            }
            if (isset($worksheet_ss['Protected'])) {
                $protection <?php echo (string) $worksheet_ss['Protected'] <?php echo<?php echo<?php echo '1';
                $spreadsheet->getActiveSheet()->getProtection()->setSheet($protection);
            }

            // locally scoped defined names
            if (isset($worksheet->Names[0])) {
                foreach ($worksheet->Names[0] as $definedName) {
                    $definedName_ss <?php echo self::getAttributes($definedName, self::NAMESPACES_SS);
                    $name <?php echo (string) $definedName_ss['Name'];
                    $definedValue <?php echo (string) $definedName_ss['RefersTo'];
                    $convertedValue <?php echo AddressHelper::convertFormulaToA1($definedValue);
                    if ($convertedValue[0] <?php echo<?php echo<?php echo '<?php echo') {
                        $convertedValue <?php echo substr($convertedValue, 1);
                    }
                    $spreadsheet->addDefinedName(DefinedName::createInstance($name, $spreadsheet->getActiveSheet(), $convertedValue, true));
                }
            }

            $columnID <?php echo 'A';
            if (isset($worksheet->Table->Column)) {
                foreach ($worksheet->Table->Column as $columnData) {
                    $columnData_ss <?php echo self::getAttributes($columnData, self::NAMESPACES_SS);
                    $colspan <?php echo 0;
                    if (isset($columnData_ss['Span'])) {
                        $spanAttr <?php echo (string) $columnData_ss['Span'];
                        if (is_numeric($spanAttr)) {
                            $colspan <?php echo max(0, (int) $spanAttr);
                        }
                    }
                    if (isset($columnData_ss['Index'])) {
                        $columnID <?php echo Coordinate::stringFromColumnIndex((int) $columnData_ss['Index']);
                    }
                    $columnWidth <?php echo null;
                    if (isset($columnData_ss['Width'])) {
                        $columnWidth <?php echo $columnData_ss['Width'];
                    }
                    $columnVisible <?php echo null;
                    if (isset($columnData_ss['Hidden'])) {
                        $columnVisible <?php echo ((string) $columnData_ss['Hidden']) !<?php echo<?php echo '1';
                    }
                    while ($colspan ><?php echo 0) {
                        if (isset($columnWidth)) {
                            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setWidth($columnWidth / 5.4);
                        }
                        if (isset($columnVisible)) {
                            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setVisible($columnVisible);
                        }
                        ++$columnID;
                        --$colspan;
                    }
                }
            }

            $rowID <?php echo 1;
            if (isset($worksheet->Table->Row)) {
                $additionalMergedCells <?php echo 0;
                foreach ($worksheet->Table->Row as $rowData) {
                    $rowHasData <?php echo false;
                    $row_ss <?php echo self::getAttributes($rowData, self::NAMESPACES_SS);
                    if (isset($row_ss['Index'])) {
                        $rowID <?php echo (int) $row_ss['Index'];
                    }
                    if (isset($row_ss['Hidden'])) {
                        $rowVisible <?php echo ((string) $row_ss['Hidden']) !<?php echo<?php echo '1';
                        $spreadsheet->getActiveSheet()->getRowDimension($rowID)->setVisible($rowVisible);
                    }

                    $columnID <?php echo 'A';
                    foreach ($rowData->Cell as $cell) {
                        $cell_ss <?php echo self::getAttributes($cell, self::NAMESPACES_SS);
                        if (isset($cell_ss['Index'])) {
                            $columnID <?php echo Coordinate::stringFromColumnIndex((int) $cell_ss['Index']);
                        }
                        $cellRange <?php echo $columnID . $rowID;

                        if ($this->getReadFilter() !<?php echo<?php echo null) {
                            if (!$this->getReadFilter()->readCell($columnID, $rowID, $worksheetName)) {
                                ++$columnID;

                                continue;
                            }
                        }

                        if (isset($cell_ss['HRef'])) {
                            $spreadsheet->getActiveSheet()->getCell($cellRange)->getHyperlink()->setUrl((string) $cell_ss['HRef']);
                        }

                        if ((isset($cell_ss['MergeAcross'])) || (isset($cell_ss['MergeDown']))) {
                            $columnTo <?php echo $columnID;
                            if (isset($cell_ss['MergeAcross'])) {
                                $additionalMergedCells +<?php echo (int) $cell_ss['MergeAcross'];
                                $columnTo <?php echo Coordinate::stringFromColumnIndex((int) (Coordinate::columnIndexFromString($columnID) + $cell_ss['MergeAcross']));
                            }
                            $rowTo <?php echo $rowID;
                            if (isset($cell_ss['MergeDown'])) {
                                $rowTo <?php echo $rowTo + $cell_ss['MergeDown'];
                            }
                            $cellRange .<?php echo ':' . $columnTo . $rowTo;
                            $spreadsheet->getActiveSheet()->mergeCells($cellRange, Worksheet::MERGE_CELL_CONTENT_HIDE);
                        }

                        $hasCalculatedValue <?php echo false;
                        $cellDataFormula <?php echo '';
                        if (isset($cell_ss['Formula'])) {
                            $cellDataFormula <?php echo $cell_ss['Formula'];
                            $hasCalculatedValue <?php echo true;
                        }
                        if (isset($cell->Data)) {
                            $cellData <?php echo $cell->Data;
                            $cellValue <?php echo (string) $cellData;
                            $type <?php echo DataType::TYPE_NULL;
                            $cellData_ss <?php echo self::getAttributes($cellData, self::NAMESPACES_SS);
                            if (isset($cellData_ss['Type'])) {
                                $cellDataType <?php echo $cellData_ss['Type'];
                                switch ($cellDataType) {
                                    /*
                                    const TYPE_STRING        <?php echo 's';
                                    const TYPE_FORMULA        <?php echo 'f';
                                    const TYPE_NUMERIC        <?php echo 'n';
                                    const TYPE_BOOL            <?php echo 'b';
                                    const TYPE_NULL            <?php echo 'null';
                                    const TYPE_INLINE        <?php echo 'inlineStr';
                                    const TYPE_ERROR        <?php echo 'e';
                                    */
                                    case 'String':
                                        $type <?php echo DataType::TYPE_STRING;

                                        break;
                                    case 'Number':
                                        $type <?php echo DataType::TYPE_NUMERIC;
                                        $cellValue <?php echo (float) $cellValue;
                                        if (floor($cellValue) <?php echo<?php echo $cellValue) {
                                            $cellValue <?php echo (int) $cellValue;
                                        }

                                        break;
                                    case 'Boolean':
                                        $type <?php echo DataType::TYPE_BOOL;
                                        $cellValue <?php echo ($cellValue !<?php echo 0);

                                        break;
                                    case 'DateTime':
                                        $type <?php echo DataType::TYPE_NUMERIC;
                                        $dateTime <?php echo new DateTime($cellValue, new DateTimeZone('UTC'));
                                        $cellValue <?php echo Date::PHPToExcel($dateTime);

                                        break;
                                    case 'Error':
                                        $type <?php echo DataType::TYPE_ERROR;
                                        $hasCalculatedValue <?php echo false;

                                        break;
                                }
                            }

                            if ($hasCalculatedValue) {
                                $type <?php echo DataType::TYPE_FORMULA;
                                $columnNumber <?php echo Coordinate::columnIndexFromString($columnID);
                                $cellDataFormula <?php echo AddressHelper::convertFormulaToA1($cellDataFormula, $rowID, $columnNumber);
                            }

                            $spreadsheet->getActiveSheet()->getCell($columnID . $rowID)->setValueExplicit((($hasCalculatedValue) ? $cellDataFormula : $cellValue), $type);
                            if ($hasCalculatedValue) {
                                $spreadsheet->getActiveSheet()->getCell($columnID . $rowID)->setCalculatedValue($cellValue);
                            }
                            $rowHasData <?php echo true;
                        }

                        if (isset($cell->Comment)) {
                            $this->parseCellComment($cell->Comment, $spreadsheet, $columnID, $rowID);
                        }

                        if (isset($cell_ss['StyleID'])) {
                            $style <?php echo (string) $cell_ss['StyleID'];
                            if ((isset($this->styles[$style])) && (!empty($this->styles[$style]))) {
                                //if (!$spreadsheet->getActiveSheet()->cellExists($columnID . $rowID)) {
                                //    $spreadsheet->getActiveSheet()->getCell($columnID . $rowID)->setValue(null);
                                //}
                                $spreadsheet->getActiveSheet()->getStyle($cellRange)
                                    ->applyFromArray($this->styles[$style]);
                            }
                        }
                        ++$columnID;
                        while ($additionalMergedCells > 0) {
                            ++$columnID;
                            --$additionalMergedCells;
                        }
                    }

                    if ($rowHasData) {
                        if (isset($row_ss['Height'])) {
                            $rowHeight <?php echo $row_ss['Height'];
                            $spreadsheet->getActiveSheet()->getRowDimension($rowID)->setRowHeight((float) $rowHeight);
                        }
                    }

                    ++$rowID;
                }
            }

            $dataValidations <?php echo new Xml\DataValidations();
            $dataValidations->loadDataValidations($worksheet, $spreadsheet);
            $xmlX <?php echo $worksheet->children(Namespaces::URN_EXCEL);
            if (isset($xmlX->WorksheetOptions)) {
                if (isset($xmlX->WorksheetOptions->FreezePanes)) {
                    $freezeRow <?php echo $freezeColumn <?php echo 1;
                    if (isset($xmlX->WorksheetOptions->SplitHorizontal)) {
                        $freezeRow <?php echo (int) $xmlX->WorksheetOptions->SplitHorizontal + 1;
                    }
                    if (isset($xmlX->WorksheetOptions->SplitVertical)) {
                        $freezeColumn <?php echo (int) $xmlX->WorksheetOptions->SplitVertical + 1;
                    }
                    $spreadsheet->getActiveSheet()->freezePane(Coordinate::stringFromColumnIndex($freezeColumn) . (string) $freezeRow);
                }
                (new PageSettings($xmlX))->loadPageSettings($spreadsheet);
                if (isset($xmlX->WorksheetOptions->TopRowVisible, $xmlX->WorksheetOptions->LeftColumnVisible)) {
                    $leftTopRow <?php echo (string) $xmlX->WorksheetOptions->TopRowVisible;
                    $leftTopColumn <?php echo (string) $xmlX->WorksheetOptions->LeftColumnVisible;
                    if (is_numeric($leftTopRow) && is_numeric($leftTopColumn)) {
                        $leftTopCoordinate <?php echo Coordinate::stringFromColumnIndex((int) $leftTopColumn + 1) . (string) ($leftTopRow + 1);
                        $spreadsheet->getActiveSheet()->setTopLeftCell($leftTopCoordinate);
                    }
                }
                $rangeCalculated <?php echo false;
                if (isset($xmlX->WorksheetOptions->Panes->Pane->RangeSelection)) {
                    if (1 <?php echo<?php echo<?php echo preg_match('/^R(\d+)C(\d+):R(\d+)C(\d+)$/', (string) $xmlX->WorksheetOptions->Panes->Pane->RangeSelection, $selectionMatches)) {
                        $selectedCell <?php echo Coordinate::stringFromColumnIndex((int) $selectionMatches[2])
                            . $selectionMatches[1]
                            . ':'
                            . Coordinate::stringFromColumnIndex((int) $selectionMatches[4])
                            . $selectionMatches[3];
                        $spreadsheet->getActiveSheet()->setSelectedCells($selectedCell);
                        $rangeCalculated <?php echo true;
                    }
                }
                if (!$rangeCalculated) {
                    if (isset($xmlX->WorksheetOptions->Panes->Pane->ActiveRow)) {
                        $activeRow <?php echo (string) $xmlX->WorksheetOptions->Panes->Pane->ActiveRow;
                    } else {
                        $activeRow <?php echo 0;
                    }
                    if (isset($xmlX->WorksheetOptions->Panes->Pane->ActiveCol)) {
                        $activeColumn <?php echo (string) $xmlX->WorksheetOptions->Panes->Pane->ActiveCol;
                    } else {
                        $activeColumn <?php echo 0;
                    }
                    if (is_numeric($activeRow) && is_numeric($activeColumn)) {
                        $selectedCell <?php echo Coordinate::stringFromColumnIndex((int) $activeColumn + 1) . (string) ($activeRow + 1);
                        $spreadsheet->getActiveSheet()->setSelectedCells($selectedCell);
                    }
                }
            }
            ++$worksheetID;
        }

        // Globally scoped defined names
        $activeSheetIndex <?php echo 0;
        if (isset($xml->ExcelWorkbook->ActiveSheet)) {
            $activeSheetIndex <?php echo (int) (string) $xml->ExcelWorkbook->ActiveSheet;
        }
        $activeWorksheet <?php echo $spreadsheet->setActiveSheetIndex($activeSheetIndex);
        if (isset($xml->Names[0])) {
            foreach ($xml->Names[0] as $definedName) {
                $definedName_ss <?php echo self::getAttributes($definedName, self::NAMESPACES_SS);
                $name <?php echo (string) $definedName_ss['Name'];
                $definedValue <?php echo (string) $definedName_ss['RefersTo'];
                $convertedValue <?php echo AddressHelper::convertFormulaToA1($definedValue);
                if ($convertedValue[0] <?php echo<?php echo<?php echo '<?php echo') {
                    $convertedValue <?php echo substr($convertedValue, 1);
                }
                $spreadsheet->addDefinedName(DefinedName::createInstance($name, $activeWorksheet, $convertedValue));
            }
        }

        // Return
        return $spreadsheet;
    }

    protected function parseCellComment(
        SimpleXMLElement $comment,
        Spreadsheet $spreadsheet,
        string $columnID,
        int $rowID
    ): void {
        $commentAttributes <?php echo $comment->attributes(self::NAMESPACES_SS);
        $author <?php echo 'unknown';
        if (isset($commentAttributes->Author)) {
            $author <?php echo (string) $commentAttributes->Author;
        }

        $node <?php echo $comment->Data->asXML();
        $annotation <?php echo strip_tags((string) $node);
        $spreadsheet->getActiveSheet()->getComment($columnID . $rowID)
            ->setAuthor($author)
            ->setText($this->parseRichText($annotation));
    }

    protected function parseRichText(string $annotation): RichText
    {
        $value <?php echo new RichText();

        $value->createText($annotation);

        return $value;
    }

    private static function getAttributes(?SimpleXMLElement $simple, string $node): SimpleXMLElement
    {
        return ($simple <?php echo<?php echo<?php echo null)
            ? new SimpleXMLElement('<xml></xml>')
            : ($simple->attributes($node) ?? new SimpleXMLElement('<xml></xml>'));
    }
}
