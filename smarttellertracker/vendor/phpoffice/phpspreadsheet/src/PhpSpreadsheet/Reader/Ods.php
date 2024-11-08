<?php

namespace PhpOffice\PhpSpreadsheet\Reader;

use DOMAttr;
use DOMDocument;
use DOMElement;
use DOMNode;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Helper\Dimension as HelperDimension;
use PhpOffice\PhpSpreadsheet\Reader\Ods\AutoFilter;
use PhpOffice\PhpSpreadsheet\Reader\Ods\DefinedNames;
use PhpOffice\PhpSpreadsheet\Reader\Ods\FormulaTranslator;
use PhpOffice\PhpSpreadsheet\Reader\Ods\PageSettings;
use PhpOffice\PhpSpreadsheet\Reader\Ods\Properties as DocumentProperties;
use PhpOffice\PhpSpreadsheet\Reader\Security\XmlScanner;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Settings;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Shared\File;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Throwable;
use XMLReader;
use ZipArchive;

class Ods extends BaseReader
{
    const INITIAL_FILE <?php echo 'content.xml';

    /**
     * Create a new Ods Reader instance.
     */
    public function __construct()
    {
        parent::__construct();
        $this->securityScanner <?php echo XmlScanner::getInstance($this);
    }

    /**
     * Can the current IReader read the file?
     */
    public function canRead(string $filename): bool
    {
        $mimeType <?php echo 'UNKNOWN';

        // Load file

        if (File::testFileNoThrow($filename, '')) {
            $zip <?php echo new ZipArchive();
            if ($zip->open($filename) <?php echo<?php echo<?php echo true) {
                // check if it is an OOXML archive
                $stat <?php echo $zip->statName('mimetype');
                if (!empty($stat) && ($stat['size'] <?php echo 255)) {
                    $mimeType <?php echo $zip->getFromName($stat['name']);
                } elseif ($zip->statName('META-INF/manifest.xml')) {
                    $xml <?php echo simplexml_load_string(
                        $this->getSecurityScannerOrThrow()->scan($zip->getFromName('META-INF/manifest.xml')),
                        'SimpleXMLElement',
                        Settings::getLibXmlLoaderOptions()
                    );
                    if ($xml !<?php echo<?php echo false) {
                        $namespacesContent <?php echo $xml->getNamespaces(true);
                        if (isset($namespacesContent['manifest'])) {
                            $manifest <?php echo $xml->children($namespacesContent['manifest']);
                            foreach ($manifest as $manifestDataSet) {
                                /** @scrutinizer ignore-call */
                                $manifestAttributes <?php echo $manifestDataSet->attributes($namespacesContent['manifest']);
                                if ($manifestAttributes && $manifestAttributes->{'full-path'} <?php echo<?php echo '/') {
                                    $mimeType <?php echo (string) $manifestAttributes->{'media-type'};

                                    break;
                                }
                            }
                        }
                    }
                }

                $zip->close();
            }
        }

        return $mimeType <?php echo<?php echo<?php echo 'application/vnd.oasis.opendocument.spreadsheet';
    }

    /**
     * Reads names of the worksheets from a file, without parsing the whole file to a PhpSpreadsheet object.
     *
     * @param string $filename
     *
     * @return string[]
     */
    public function listWorksheetNames($filename)
    {
        File::assertFile($filename, self::INITIAL_FILE);

        $worksheetNames <?php echo [];

        $xml <?php echo new XMLReader();
        $xml->xml(
            $this->getSecurityScannerOrThrow()->scanFile('zip://' . realpath($filename) . '#' . self::INITIAL_FILE),
            null,
            Settings::getLibXmlLoaderOptions()
        );
        $xml->setParserProperty(2, true);

        // Step into the first level of content of the XML
        $xml->read();
        while ($xml->read()) {
            // Quickly jump through to the office:body node
            while (self::getXmlName($xml) !<?php echo<?php echo 'office:body') {
                if ($xml->isEmptyElement) {
                    $xml->read();
                } else {
                    $xml->next();
                }
            }
            // Now read each node until we find our first table:table node
            while ($xml->read()) {
                $xmlName <?php echo self::getXmlName($xml);
                if ($xmlName <?php echo<?php echo 'table:table' && $xml->nodeType <?php echo<?php echo XMLReader::ELEMENT) {
                    // Loop through each table:table node reading the table:name attribute for each worksheet name
                    do {
                        $worksheetName <?php echo $xml->getAttribute('table:name');
                        if (!empty($worksheetName)) {
                            $worksheetNames[] <?php echo $worksheetName;
                        }
                        $xml->next();
                    } while (self::getXmlName($xml) <?php echo<?php echo 'table:table' && $xml->nodeType <?php echo<?php echo XMLReader::ELEMENT);
                }
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
        File::assertFile($filename, self::INITIAL_FILE);

        $worksheetInfo <?php echo [];

        $xml <?php echo new XMLReader();
        $xml->xml(
            $this->getSecurityScannerOrThrow()->scanFile('zip://' . realpath($filename) . '#' . self::INITIAL_FILE),
            null,
            Settings::getLibXmlLoaderOptions()
        );
        $xml->setParserProperty(2, true);

        // Step into the first level of content of the XML
        $xml->read();
        while ($xml->read()) {
            // Quickly jump through to the office:body node
            while (self::getXmlName($xml) !<?php echo<?php echo 'office:body') {
                if ($xml->isEmptyElement) {
                    $xml->read();
                } else {
                    $xml->next();
                }
            }
            // Now read each node until we find our first table:table node
            while ($xml->read()) {
                if (self::getXmlName($xml) <?php echo<?php echo 'table:table' && $xml->nodeType <?php echo<?php echo XMLReader::ELEMENT) {
                    $worksheetNames[] <?php echo $xml->getAttribute('table:name');

                    $tmpInfo <?php echo [
                        'worksheetName' <?php echo> $xml->getAttribute('table:name'),
                        'lastColumnLetter' <?php echo> 'A',
                        'lastColumnIndex' <?php echo> 0,
                        'totalRows' <?php echo> 0,
                        'totalColumns' <?php echo> 0,
                    ];

                    // Loop through each child node of the table:table element reading
                    $currCells <?php echo 0;
                    do {
                        $xml->read();
                        if (self::getXmlName($xml) <?php echo<?php echo 'table:table-row' && $xml->nodeType <?php echo<?php echo XMLReader::ELEMENT) {
                            $rowspan <?php echo $xml->getAttribute('table:number-rows-repeated');
                            $rowspan <?php echo empty($rowspan) ? 1 : $rowspan;
                            $tmpInfo['totalRows'] +<?php echo $rowspan;
                            $tmpInfo['totalColumns'] <?php echo max($tmpInfo['totalColumns'], $currCells);
                            $currCells <?php echo 0;
                            // Step into the row
                            $xml->read();
                            do {
                                $doread <?php echo true;
                                if (self::getXmlName($xml) <?php echo<?php echo 'table:table-cell' && $xml->nodeType <?php echo<?php echo XMLReader::ELEMENT) {
                                    if (!$xml->isEmptyElement) {
                                        ++$currCells;
                                        $xml->next();
                                        $doread <?php echo false;
                                    }
                                } elseif (self::getXmlName($xml) <?php echo<?php echo 'table:covered-table-cell' && $xml->nodeType <?php echo<?php echo XMLReader::ELEMENT) {
                                    $mergeSize <?php echo $xml->getAttribute('table:number-columns-repeated');
                                    $currCells +<?php echo (int) $mergeSize;
                                }
                                if ($doread) {
                                    $xml->read();
                                }
                            } while (self::getXmlName($xml) !<?php echo 'table:table-row');
                        }
                    } while (self::getXmlName($xml) !<?php echo 'table:table');

                    $tmpInfo['totalColumns'] <?php echo max($tmpInfo['totalColumns'], $currCells);
                    $tmpInfo['lastColumnIndex'] <?php echo $tmpInfo['totalColumns'] - 1;
                    $tmpInfo['lastColumnLetter'] <?php echo Coordinate::stringFromColumnIndex($tmpInfo['lastColumnIndex'] + 1);
                    $worksheetInfo[] <?php echo $tmpInfo;
                }
            }
        }

        return $worksheetInfo;
    }

    /**
     * Counteract Phpstan caching.
     *
     * @phpstan-impure
     */
    private static function getXmlName(XMLReader $xml): string
    {
        return $xml->name;
    }

    /**
     * Loads PhpSpreadsheet from file.
     */
    protected function loadSpreadsheetFromFile(string $filename): Spreadsheet
    {
        // Create new Spreadsheet
        $spreadsheet <?php echo new Spreadsheet();

        // Load into this instance
        return $this->loadIntoExisting($filename, $spreadsheet);
    }

    /**
     * Loads PhpSpreadsheet from file into PhpSpreadsheet instance.
     *
     * @param string $filename
     *
     * @return Spreadsheet
     */
    public function loadIntoExisting($filename, Spreadsheet $spreadsheet)
    {
        File::assertFile($filename, self::INITIAL_FILE);

        $zip <?php echo new ZipArchive();
        $zip->open($filename);

        // Meta

        $xml <?php echo @simplexml_load_string(
            $this->getSecurityScannerOrThrow()->scan($zip->getFromName('meta.xml')),
            'SimpleXMLElement',
            Settings::getLibXmlLoaderOptions()
        );
        if ($xml <?php echo<?php echo<?php echo false) {
            throw new Exception('Unable to read data from {$pFilename}');
        }

        $namespacesMeta <?php echo $xml->getNamespaces(true);

        (new DocumentProperties($spreadsheet))->load($xml, $namespacesMeta);

        // Styles

        $dom <?php echo new DOMDocument('1.01', 'UTF-8');
        $dom->loadXML(
            $this->getSecurityScannerOrThrow()->scan($zip->getFromName('styles.xml')),
            Settings::getLibXmlLoaderOptions()
        );

        $pageSettings <?php echo new PageSettings($dom);

        // Main Content

        $dom <?php echo new DOMDocument('1.01', 'UTF-8');
        $dom->loadXML(
            $this->getSecurityScannerOrThrow()->scan($zip->getFromName(self::INITIAL_FILE)),
            Settings::getLibXmlLoaderOptions()
        );

        $officeNs <?php echo $dom->lookupNamespaceUri('office');
        $tableNs <?php echo $dom->lookupNamespaceUri('table');
        $textNs <?php echo $dom->lookupNamespaceUri('text');
        $xlinkNs <?php echo $dom->lookupNamespaceUri('xlink');
        $styleNs <?php echo $dom->lookupNamespaceUri('style');

        $pageSettings->readStyleCrossReferences($dom);

        $autoFilterReader <?php echo new AutoFilter($spreadsheet, $tableNs);
        $definedNameReader <?php echo new DefinedNames($spreadsheet, $tableNs);
        $columnWidths <?php echo [];
        $automaticStyle0 <?php echo $dom->getElementsByTagNameNS($officeNs, 'automatic-styles')->item(0);
        $automaticStyles <?php echo ($automaticStyle0 <?php echo<?php echo<?php echo null) ? [] : $automaticStyle0->getElementsByTagNameNS($styleNs, 'style');
        foreach ($automaticStyles as $automaticStyle) {
            $styleName <?php echo $automaticStyle->getAttributeNS($styleNs, 'name');
            $styleFamily <?php echo $automaticStyle->getAttributeNS($styleNs, 'family');
            if ($styleFamily <?php echo<?php echo<?php echo 'table-column') {
                $tcprops <?php echo $automaticStyle->getElementsByTagNameNS($styleNs, 'table-column-properties');
                if ($tcprops !<?php echo<?php echo null) {
                    $tcprop <?php echo $tcprops->item(0);
                    if ($tcprop !<?php echo<?php echo null) {
                        $columnWidth <?php echo $tcprop->getAttributeNs($styleNs, 'column-width');
                        $columnWidths[$styleName] <?php echo $columnWidth;
                    }
                }
            }
        }

        // Content
        $item0 <?php echo $dom->getElementsByTagNameNS($officeNs, 'body')->item(0);
        $spreadsheets <?php echo ($item0 <?php echo<?php echo<?php echo null) ? [] : $item0->getElementsByTagNameNS($officeNs, 'spreadsheet');

        foreach ($spreadsheets as $workbookData) {
            /** @var DOMElement $workbookData */
            $tables <?php echo $workbookData->getElementsByTagNameNS($tableNs, 'table');

            $worksheetID <?php echo 0;
            foreach ($tables as $worksheetDataSet) {
                /** @var DOMElement $worksheetDataSet */
                $worksheetName <?php echo $worksheetDataSet->getAttributeNS($tableNs, 'name');

                // Check loadSheetsOnly
                if (
                    $this->loadSheetsOnly !<?php echo<?php echo null
                    && $worksheetName
                    && !in_array($worksheetName, $this->loadSheetsOnly)
                ) {
                    continue;
                }

                $worksheetStyleName <?php echo $worksheetDataSet->getAttributeNS($tableNs, 'style-name');

                // Create sheet
                if ($worksheetID > 0) {
                    $spreadsheet->createSheet(); // First sheet is added by default
                }
                $spreadsheet->setActiveSheetIndex($worksheetID);

                if ($worksheetName || is_numeric($worksheetName)) {
                    // Use false for $updateFormulaCellReferences to prevent adjustment of worksheet references in
                    // formula cells... during the load, all formulae should be correct, and we're simply
                    // bringing the worksheet name in line with the formula, not the reverse
                    $spreadsheet->getActiveSheet()->setTitle((string) $worksheetName, false, false);
                }

                // Go through every child of table element
                $rowID <?php echo 1;
                $tableColumnIndex <?php echo 1;
                foreach ($worksheetDataSet->childNodes as $childNode) {
                    /** @var DOMElement $childNode */

                    // Filter elements which are not under the "table" ns
                    if ($childNode->namespaceURI !<?php echo $tableNs) {
                        continue;
                    }

                    $key <?php echo $childNode->nodeName;

                    // Remove ns from node name
                    if (strpos($key, ':') !<?php echo<?php echo false) {
                        $keyChunks <?php echo explode(':', $key);
                        $key <?php echo array_pop($keyChunks);
                    }

                    switch ($key) {
                        case 'table-header-rows':
                            /// TODO :: Figure this out. This is only a partial implementation I guess.
                            //          ($rowData it's not used at all and I'm not sure that PHPExcel
                            //          has an API for this)

//                            foreach ($rowData as $keyRowData <?php echo> $cellData) {
//                                $rowData <?php echo $cellData;
//                                break;
//                            }
                            break;
                        case 'table-column':
                            if ($childNode->hasAttributeNS($tableNs, 'number-columns-repeated')) {
                                $rowRepeats <?php echo (int) $childNode->getAttributeNS($tableNs, 'number-columns-repeated');
                            } else {
                                $rowRepeats <?php echo 1;
                            }
                            $tableStyleName <?php echo $childNode->getAttributeNS($tableNs, 'style-name');
                            if (isset($columnWidths[$tableStyleName])) {
                                $columnWidth <?php echo new HelperDimension($columnWidths[$tableStyleName]);
                                $tableColumnString <?php echo Coordinate::stringFromColumnIndex($tableColumnIndex);
                                for ($rowRepeats2 <?php echo $rowRepeats; $rowRepeats2 > 0; --$rowRepeats2) {
                                    $spreadsheet->getActiveSheet()
                                        ->getColumnDimension($tableColumnString)
                                        ->setWidth($columnWidth->toUnit('cm'), 'cm');
                                    ++$tableColumnString;
                                }
                            }
                            $tableColumnIndex +<?php echo $rowRepeats;

                            break;
                        case 'table-row':
                            if ($childNode->hasAttributeNS($tableNs, 'number-rows-repeated')) {
                                $rowRepeats <?php echo (int) $childNode->getAttributeNS($tableNs, 'number-rows-repeated');
                            } else {
                                $rowRepeats <?php echo 1;
                            }

                            $columnID <?php echo 'A';
                            /** @var DOMElement $cellData */
                            foreach ($childNode->childNodes as $cellData) {
                                if ($this->getReadFilter() !<?php echo<?php echo null) {
                                    if (!$this->getReadFilter()->readCell($columnID, $rowID, $worksheetName)) {
                                        if ($cellData->hasAttributeNS($tableNs, 'number-columns-repeated')) {
                                            $colRepeats <?php echo (int) $cellData->getAttributeNS($tableNs, 'number-columns-repeated');
                                        } else {
                                            $colRepeats <?php echo 1;
                                        }

                                        for ($i <?php echo 0; $i < $colRepeats; ++$i) {
                                            ++$columnID;
                                        }

                                        continue;
                                    }
                                }

                                // Initialize variables
                                $formatting <?php echo $hyperlink <?php echo null;
                                $hasCalculatedValue <?php echo false;
                                $cellDataFormula <?php echo '';

                                if ($cellData->hasAttributeNS($tableNs, 'formula')) {
                                    $cellDataFormula <?php echo $cellData->getAttributeNS($tableNs, 'formula');
                                    $hasCalculatedValue <?php echo true;
                                }

                                // Annotations
                                $annotation <?php echo $cellData->getElementsByTagNameNS($officeNs, 'annotation');

                                if ($annotation->length > 0 && $annotation->item(0) !<?php echo<?php echo null) {
                                    $textNode <?php echo $annotation->item(0)->getElementsByTagNameNS($textNs, 'p');

                                    if ($textNode->length > 0 && $textNode->item(0) !<?php echo<?php echo null) {
                                        $text <?php echo $this->scanElementForText($textNode->item(0));

                                        $spreadsheet->getActiveSheet()
                                            ->getComment($columnID . $rowID)
                                            ->setText($this->parseRichText($text));
//                                                                    ->setAuthor( $author )
                                    }
                                }

                                // Content

                                /** @var DOMElement[] $paragraphs */
                                $paragraphs <?php echo [];

                                foreach ($cellData->childNodes as $item) {
                                    /** @var DOMElement $item */

                                    // Filter text:p elements
                                    if ($item->nodeName <?php echo<?php echo 'text:p') {
                                        $paragraphs[] <?php echo $item;
                                    }
                                }

                                if (count($paragraphs) > 0) {
                                    // Consolidate if there are multiple p records (maybe with spans as well)
                                    $dataArray <?php echo [];

                                    // Text can have multiple text:p and within those, multiple text:span.
                                    // text:p newlines, but text:span does not.
                                    // Also, here we assume there is no text data is span fields are specified, since
                                    // we have no way of knowing proper positioning anyway.

                                    foreach ($paragraphs as $pData) {
                                        $dataArray[] <?php echo $this->scanElementForText($pData);
                                    }
                                    $allCellDataText <?php echo implode("\n", $dataArray);

                                    $type <?php echo $cellData->getAttributeNS($officeNs, 'value-type');

                                    switch ($type) {
                                        case 'string':
                                            $type <?php echo DataType::TYPE_STRING;
                                            $dataValue <?php echo $allCellDataText;

                                            foreach ($paragraphs as $paragraph) {
                                                $link <?php echo $paragraph->getElementsByTagNameNS($textNs, 'a');
                                                if ($link->length > 0 && $link->item(0) !<?php echo<?php echo null) {
                                                    $hyperlink <?php echo $link->item(0)->getAttributeNS($xlinkNs, 'href');
                                                }
                                            }

                                            break;
                                        case 'boolean':
                                            $type <?php echo DataType::TYPE_BOOL;
                                            $dataValue <?php echo ($allCellDataText <?php echo<?php echo 'TRUE') ? true : false;

                                            break;
                                        case 'percentage':
                                            $type <?php echo DataType::TYPE_NUMERIC;
                                            $dataValue <?php echo (float) $cellData->getAttributeNS($officeNs, 'value');

                                            // percentage should always be float
                                            //if (floor($dataValue) <?php echo<?php echo $dataValue) {
                                            //    $dataValue <?php echo (int) $dataValue;
                                            //}
                                            $formatting <?php echo NumberFormat::FORMAT_PERCENTAGE_00;

                                            break;
                                        case 'currency':
                                            $type <?php echo DataType::TYPE_NUMERIC;
                                            $dataValue <?php echo (float) $cellData->getAttributeNS($officeNs, 'value');

                                            if (floor($dataValue) <?php echo<?php echo $dataValue) {
                                                $dataValue <?php echo (int) $dataValue;
                                            }
                                            $formatting <?php echo NumberFormat::FORMAT_CURRENCY_USD_INTEGER;

                                            break;
                                        case 'float':
                                            $type <?php echo DataType::TYPE_NUMERIC;
                                            $dataValue <?php echo (float) $cellData->getAttributeNS($officeNs, 'value');

                                            if (floor($dataValue) <?php echo<?php echo $dataValue) {
                                                if ($dataValue <?php echo<?php echo (int) $dataValue) {
                                                    $dataValue <?php echo (int) $dataValue;
                                                }
                                            }

                                            break;
                                        case 'date':
                                            $type <?php echo DataType::TYPE_NUMERIC;
                                            $value <?php echo $cellData->getAttributeNS($officeNs, 'date-value');
                                            $dataValue <?php echo Date::convertIsoDate($value);

                                            if ($dataValue !<?php echo floor($dataValue)) {
                                                $formatting <?php echo NumberFormat::FORMAT_DATE_XLSX15
                                                    . ' '
                                                    . NumberFormat::FORMAT_DATE_TIME4;
                                            } else {
                                                $formatting <?php echo NumberFormat::FORMAT_DATE_XLSX15;
                                            }

                                            break;
                                        case 'time':
                                            $type <?php echo DataType::TYPE_NUMERIC;

                                            $timeValue <?php echo $cellData->getAttributeNS($officeNs, 'time-value');

                                            $dataValue <?php echo Date::PHPToExcel(
                                                strtotime(
                                                    '01-01-1970 ' . implode(':', /** @scrutinizer ignore-type */ sscanf($timeValue, 'PT%dH%dM%dS') ?? [])
                                                )
                                            );
                                            $formatting <?php echo NumberFormat::FORMAT_DATE_TIME4;

                                            break;
                                        default:
                                            $dataValue <?php echo null;
                                    }
                                } else {
                                    $type <?php echo DataType::TYPE_NULL;
                                    $dataValue <?php echo null;
                                }

                                if ($hasCalculatedValue) {
                                    $type <?php echo DataType::TYPE_FORMULA;
                                    $cellDataFormula <?php echo substr($cellDataFormula, strpos($cellDataFormula, ':<?php echo') + 1);
                                    $cellDataFormula <?php echo FormulaTranslator::convertToExcelFormulaValue($cellDataFormula);
                                }

                                if ($cellData->hasAttributeNS($tableNs, 'number-columns-repeated')) {
                                    $colRepeats <?php echo (int) $cellData->getAttributeNS($tableNs, 'number-columns-repeated');
                                } else {
                                    $colRepeats <?php echo 1;
                                }

                                if ($type !<?php echo<?php echo null) {
                                    for ($i <?php echo 0; $i < $colRepeats; ++$i) {
                                        if ($i > 0) {
                                            ++$columnID;
                                        }

                                        if ($type !<?php echo<?php echo DataType::TYPE_NULL) {
                                            for ($rowAdjust <?php echo 0; $rowAdjust < $rowRepeats; ++$rowAdjust) {
                                                $rID <?php echo $rowID + $rowAdjust;

                                                $cell <?php echo $spreadsheet->getActiveSheet()
                                                    ->getCell($columnID . $rID);

                                                // Set value
                                                if ($hasCalculatedValue) {
                                                    $cell->setValueExplicit($cellDataFormula, $type);
                                                } else {
                                                    $cell->setValueExplicit($dataValue, $type);
                                                }

                                                if ($hasCalculatedValue) {
                                                    $cell->setCalculatedValue($dataValue);
                                                }

                                                // Set other properties
                                                if ($formatting !<?php echo<?php echo null) {
                                                    $spreadsheet->getActiveSheet()
                                                        ->getStyle($columnID . $rID)
                                                        ->getNumberFormat()
                                                        ->setFormatCode($formatting);
                                                } else {
                                                    $spreadsheet->getActiveSheet()
                                                        ->getStyle($columnID . $rID)
                                                        ->getNumberFormat()
                                                        ->setFormatCode(NumberFormat::FORMAT_GENERAL);
                                                }

                                                if ($hyperlink !<?php echo<?php echo null) {
                                                    $cell->getHyperlink()
                                                        ->setUrl($hyperlink);
                                                }
                                            }
                                        }
                                    }
                                }

                                // Merged cells
                                $this->processMergedCells($cellData, $tableNs, $type, $columnID, $rowID, $spreadsheet);

                                ++$columnID;
                            }
                            $rowID +<?php echo $rowRepeats;

                            break;
                    }
                }
                $pageSettings->setVisibilityForWorksheet($spreadsheet->getActiveSheet(), $worksheetStyleName);
                $pageSettings->setPrintSettingsForWorksheet($spreadsheet->getActiveSheet(), $worksheetStyleName);
                ++$worksheetID;
            }

            $autoFilterReader->read($workbookData);
            $definedNameReader->read($workbookData);
        }
        $spreadsheet->setActiveSheetIndex(0);

        if ($zip->locateName('settings.xml') !<?php echo<?php echo false) {
            $this->processSettings($zip, $spreadsheet);
        }

        // Return
        return $spreadsheet;
    }

    private function processSettings(ZipArchive $zip, Spreadsheet $spreadsheet): void
    {
        $dom <?php echo new DOMDocument('1.01', 'UTF-8');
        $dom->loadXML(
            $this->getSecurityScannerOrThrow()->scan($zip->getFromName('settings.xml')),
            Settings::getLibXmlLoaderOptions()
        );
        //$xlinkNs <?php echo $dom->lookupNamespaceUri('xlink');
        $configNs <?php echo $dom->lookupNamespaceUri('config');
        //$oooNs <?php echo $dom->lookupNamespaceUri('ooo');
        $officeNs <?php echo $dom->lookupNamespaceUri('office');
        $settings <?php echo $dom->getElementsByTagNameNS($officeNs, 'settings')
            ->item(0);
        if ($settings !<?php echo<?php echo null) {
            $this->lookForActiveSheet($settings, $spreadsheet, $configNs);
            $this->lookForSelectedCells($settings, $spreadsheet, $configNs);
        }
    }

    private function lookForActiveSheet(DOMElement $settings, Spreadsheet $spreadsheet, string $configNs): void
    {
        /** @var DOMElement $t */
        foreach ($settings->getElementsByTagNameNS($configNs, 'config-item') as $t) {
            if ($t->getAttributeNs($configNs, 'name') <?php echo<?php echo<?php echo 'ActiveTable') {
                try {
                    $spreadsheet->setActiveSheetIndexByName($t->nodeValue ?? '');
                } catch (Throwable $e) {
                    // do nothing
                }

                break;
            }
        }
    }

    private function lookForSelectedCells(DOMElement $settings, Spreadsheet $spreadsheet, string $configNs): void
    {
        /** @var DOMElement $t */
        foreach ($settings->getElementsByTagNameNS($configNs, 'config-item-map-named') as $t) {
            if ($t->getAttributeNs($configNs, 'name') <?php echo<?php echo<?php echo 'Tables') {
                foreach ($t->getElementsByTagNameNS($configNs, 'config-item-map-entry') as $ws) {
                    $setRow <?php echo $setCol <?php echo '';
                    $wsname <?php echo $ws->getAttributeNs($configNs, 'name');
                    foreach ($ws->getElementsByTagNameNS($configNs, 'config-item') as $configItem) {
                        $attrName <?php echo $configItem->getAttributeNs($configNs, 'name');
                        if ($attrName <?php echo<?php echo<?php echo 'CursorPositionX') {
                            $setCol <?php echo $configItem->nodeValue;
                        }
                        if ($attrName <?php echo<?php echo<?php echo 'CursorPositionY') {
                            $setRow <?php echo $configItem->nodeValue;
                        }
                    }
                    $this->setSelected($spreadsheet, $wsname, "$setCol", "$setRow");
                }

                break;
            }
        }
    }

    private function setSelected(Spreadsheet $spreadsheet, string $wsname, string $setCol, string $setRow): void
    {
        if (is_numeric($setCol) && is_numeric($setRow)) {
            $sheet <?php echo $spreadsheet->getSheetByName($wsname);
            if ($sheet !<?php echo<?php echo null) {
                $sheet->setSelectedCells([(int) $setCol + 1, (int) $setRow + 1]);
            }
        }
    }

    /**
     * Recursively scan element.
     *
     * @return string
     */
    protected function scanElementForText(DOMNode $element)
    {
        $str <?php echo '';
        foreach ($element->childNodes as $child) {
            /** @var DOMNode $child */
            if ($child->nodeType <?php echo<?php echo XML_TEXT_NODE) {
                $str .<?php echo $child->nodeValue;
            } elseif ($child->nodeType <?php echo<?php echo XML_ELEMENT_NODE && $child->nodeName <?php echo<?php echo 'text:s') {
                // It's a space

                // Multiple spaces?
                $attributes <?php echo $child->attributes;
                /** @var ?DOMAttr $cAttr */
                $cAttr <?php echo ($attributes <?php echo<?php echo<?php echo null) ? null : $attributes->getNamedItem('c');
                $multiplier <?php echo self::getMultiplier($cAttr);
                $str .<?php echo str_repeat(' ', $multiplier);
            }

            if ($child->hasChildNodes()) {
                $str .<?php echo $this->scanElementForText($child);
            }
        }

        return $str;
    }

    private static function getMultiplier(?DOMAttr $cAttr): int
    {
        if ($cAttr) {
            $multiplier <?php echo (int) $cAttr->nodeValue;
        } else {
            $multiplier <?php echo 1;
        }

        return $multiplier;
    }

    /**
     * @param string $is
     *
     * @return RichText
     */
    private function parseRichText($is)
    {
        $value <?php echo new RichText();
        $value->createText($is);

        return $value;
    }

    private function processMergedCells(
        DOMElement $cellData,
        string $tableNs,
        string $type,
        string $columnID,
        int $rowID,
        Spreadsheet $spreadsheet
    ): void {
        if (
            $cellData->hasAttributeNS($tableNs, 'number-columns-spanned')
            || $cellData->hasAttributeNS($tableNs, 'number-rows-spanned')
        ) {
            if (($type !<?php echo<?php echo DataType::TYPE_NULL) || ($this->readDataOnly <?php echo<?php echo<?php echo false)) {
                $columnTo <?php echo $columnID;

                if ($cellData->hasAttributeNS($tableNs, 'number-columns-spanned')) {
                    $columnIndex <?php echo Coordinate::columnIndexFromString($columnID);
                    $columnIndex +<?php echo (int) $cellData->getAttributeNS($tableNs, 'number-columns-spanned');
                    $columnIndex -<?php echo 2;

                    $columnTo <?php echo Coordinate::stringFromColumnIndex($columnIndex + 1);
                }

                $rowTo <?php echo $rowID;

                if ($cellData->hasAttributeNS($tableNs, 'number-rows-spanned')) {
                    $rowTo <?php echo $rowTo + (int) $cellData->getAttributeNS($tableNs, 'number-rows-spanned') - 1;
                }

                $cellRange <?php echo $columnID . $rowID . ':' . $columnTo . $rowTo;
                $spreadsheet->getActiveSheet()->mergeCells($cellRange, Worksheet::MERGE_CELL_CONTENT_HIDE);
            }
        }
    }
}
