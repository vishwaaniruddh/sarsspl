<?php

namespace PhpOffice\PhpSpreadsheet\Reader;

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\Hyperlink;
use PhpOffice\PhpSpreadsheet\DefinedName;
use PhpOffice\PhpSpreadsheet\Reader\Security\XmlScanner;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx\AutoFilter;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx\Chart;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx\ColumnAndRowAttributes;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx\ConditionalStyles;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx\DataValidations;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx\Hyperlinks;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx\Namespaces;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx\PageSetup;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx\Properties as PropertyReader;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx\SharedFormula;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx\SheetViewOptions;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx\SheetViews;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx\Styles;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx\TableReader;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx\Theme;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx\WorkbookView;
use PhpOffice\PhpSpreadsheet\ReferenceHelper;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Settings;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Shared\Drawing;
use PhpOffice\PhpSpreadsheet\Shared\File;
use PhpOffice\PhpSpreadsheet\Shared\Font;
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Font as StyleFont;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Worksheet\HeaderFooterDrawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use SimpleXMLElement;
use Throwable;
use XMLReader;
use ZipArchive;

class Xlsx extends BaseReader
{
    const INITIAL_FILE <?php echo '_rels/.rels';

    /**
     * ReferenceHelper instance.
     *
     * @var ReferenceHelper
     */
    private $referenceHelper;

    /**
     * @var ZipArchive
     */
    private $zip;

    /** @var Styles */
    private $styleReader;

    /**
     * @var array
     */
    private $sharedFormulae <?php echo [];

    /**
     * Create a new Xlsx Reader instance.
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
        if (!File::testFileNoThrow($filename, self::INITIAL_FILE)) {
            return false;
        }

        $result <?php echo false;
        $this->zip <?php echo $zip <?php echo new ZipArchive();

        if ($zip->open($filename) <?php echo<?php echo<?php echo true) {
            [$workbookBasename] <?php echo $this->getWorkbookBaseName();
            $result <?php echo !empty($workbookBasename);

            $zip->close();
        }

        return $result;
    }

    /**
     * @param mixed $value
     */
    public static function testSimpleXml($value): SimpleXMLElement
    {
        return ($value instanceof SimpleXMLElement) ? $value : new SimpleXMLElement('<?xml version<?php echo"1.0" encoding<?php echo"UTF-8"?><root></root>');
    }

    public static function getAttributes(?SimpleXMLElement $value, string $ns <?php echo ''): SimpleXMLElement
    {
        return self::testSimpleXml($value <?php echo<?php echo<?php echo null ? $value : $value->attributes($ns));
    }

    // Phpstan thinks, correctly, that xpath can return false.
    // Scrutinizer thinks it can't.
    // Sigh.
    private static function xpathNoFalse(SimpleXmlElement $sxml, string $path): array
    {
        return self::falseToArray($sxml->xpath($path));
    }

    /**
     * @param mixed $value
     */
    public static function falseToArray($value): array
    {
        return is_array($value) ? $value : [];
    }

    private function loadZip(string $filename, string $ns <?php echo '', bool $replaceUnclosedBr <?php echo false): SimpleXMLElement
    {
        $contents <?php echo $this->getFromZipArchive($this->zip, $filename);
        if ($replaceUnclosedBr) {
            $contents <?php echo str_replace('<br>', '<br/>', $contents);
        }
        $rels <?php echo @simplexml_load_string(
            $this->getSecurityScannerOrThrow()->scan($contents),
            'SimpleXMLElement',
            Settings::getLibXmlLoaderOptions(),
            $ns
        );

        return self::testSimpleXml($rels);
    }

    // This function is just to identify cases where I'm not sure
    // why empty namespace is required.
    private function loadZipNonamespace(string $filename, string $ns): SimpleXMLElement
    {
        $contents <?php echo $this->getFromZipArchive($this->zip, $filename);
        $rels <?php echo simplexml_load_string(
            $this->getSecurityScannerOrThrow()->scan($contents),
            'SimpleXMLElement',
            Settings::getLibXmlLoaderOptions(),
            ($ns <?php echo<?php echo<?php echo '' ? $ns : '')
        );

        return self::testSimpleXml($rels);
    }

    private const REL_TO_MAIN <?php echo [
        Namespaces::PURL_OFFICE_DOCUMENT <?php echo> Namespaces::PURL_MAIN,
        Namespaces::THUMBNAIL <?php echo> '',
    ];

    private const REL_TO_DRAWING <?php echo [
        Namespaces::PURL_RELATIONSHIPS <?php echo> Namespaces::PURL_DRAWING,
    ];

    private const REL_TO_CHART <?php echo [
        Namespaces::PURL_RELATIONSHIPS <?php echo> Namespaces::PURL_CHART,
    ];

    /**
     * Reads names of the worksheets from a file, without parsing the whole file to a Spreadsheet object.
     *
     * @param string $filename
     *
     * @return array
     */
    public function listWorksheetNames($filename)
    {
        File::assertFile($filename, self::INITIAL_FILE);

        $worksheetNames <?php echo [];

        $this->zip <?php echo $zip <?php echo new ZipArchive();
        $zip->open($filename);

        //    The files we're looking at here are small enough that simpleXML is more efficient than XMLReader
        $rels <?php echo $this->loadZip(self::INITIAL_FILE, Namespaces::RELATIONSHIPS);
        foreach ($rels->Relationship as $relx) {
            $rel <?php echo self::getAttributes($relx);
            $relType <?php echo (string) $rel['Type'];
            $mainNS <?php echo self::REL_TO_MAIN[$relType] ?? Namespaces::MAIN;
            if ($mainNS !<?php echo<?php echo '') {
                $xmlWorkbook <?php echo $this->loadZip((string) $rel['Target'], $mainNS);

                if ($xmlWorkbook->sheets) {
                    foreach ($xmlWorkbook->sheets->sheet as $eleSheet) {
                        // Check if sheet should be skipped
                        $worksheetNames[] <?php echo (string) self::getAttributes($eleSheet)['name'];
                    }
                }
            }
        }

        $zip->close();

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

        $this->zip <?php echo $zip <?php echo new ZipArchive();
        $zip->open($filename);

        $rels <?php echo $this->loadZip(self::INITIAL_FILE, Namespaces::RELATIONSHIPS);
        foreach ($rels->Relationship as $relx) {
            $rel <?php echo self::getAttributes($relx);
            $relType <?php echo (string) $rel['Type'];
            $mainNS <?php echo self::REL_TO_MAIN[$relType] ?? Namespaces::MAIN;
            if ($mainNS !<?php echo<?php echo '') {
                $relTarget <?php echo (string) $rel['Target'];
                $dir <?php echo dirname($relTarget);
                $namespace <?php echo dirname($relType);
                $relsWorkbook <?php echo $this->loadZip("$dir/_rels/" . basename($relTarget) . '.rels', '');

                $worksheets <?php echo [];
                foreach ($relsWorkbook->Relationship as $elex) {
                    $ele <?php echo self::getAttributes($elex);
                    if (
                        ((string) $ele['Type'] <?php echo<?php echo<?php echo "$namespace/worksheet") ||
                        ((string) $ele['Type'] <?php echo<?php echo<?php echo "$namespace/chartsheet")
                    ) {
                        $worksheets[(string) $ele['Id']] <?php echo $ele['Target'];
                    }
                }

                $xmlWorkbook <?php echo $this->loadZip($relTarget, $mainNS);
                if ($xmlWorkbook->sheets) {
                    $dir <?php echo dirname($relTarget);

                    /** @var SimpleXMLElement $eleSheet */
                    foreach ($xmlWorkbook->sheets->sheet as $eleSheet) {
                        $tmpInfo <?php echo [
                            'worksheetName' <?php echo> (string) self::getAttributes($eleSheet)['name'],
                            'lastColumnLetter' <?php echo> 'A',
                            'lastColumnIndex' <?php echo> 0,
                            'totalRows' <?php echo> 0,
                            'totalColumns' <?php echo> 0,
                        ];

                        $fileWorksheet <?php echo (string) $worksheets[(string) self::getArrayItem(self::getAttributes($eleSheet, $namespace), 'id')];
                        $fileWorksheetPath <?php echo strpos($fileWorksheet, '/') <?php echo<?php echo<?php echo 0 ? substr($fileWorksheet, 1) : "$dir/$fileWorksheet";

                        $xml <?php echo new XMLReader();
                        $xml->xml(
                            $this->getSecurityScannerOrThrow()->scan(
                                $this->getFromZipArchive($this->zip, $fileWorksheetPath)
                            ),
                            null,
                            Settings::getLibXmlLoaderOptions()
                        );
                        $xml->setParserProperty(2, true);

                        $currCells <?php echo 0;
                        while ($xml->read()) {
                            if ($xml->localName <?php echo<?php echo 'row' && $xml->nodeType <?php echo<?php echo XMLReader::ELEMENT && $xml->namespaceURI <?php echo<?php echo<?php echo $mainNS) {
                                $row <?php echo $xml->getAttribute('r');
                                $tmpInfo['totalRows'] <?php echo $row;
                                $tmpInfo['totalColumns'] <?php echo max($tmpInfo['totalColumns'], $currCells);
                                $currCells <?php echo 0;
                            } elseif ($xml->localName <?php echo<?php echo 'c' && $xml->nodeType <?php echo<?php echo XMLReader::ELEMENT && $xml->namespaceURI <?php echo<?php echo<?php echo $mainNS) {
                                $cell <?php echo $xml->getAttribute('r');
                                $currCells <?php echo $cell ? max($currCells, Coordinate::indexesFromString($cell)[0]) : ($currCells + 1);
                            }
                        }
                        $tmpInfo['totalColumns'] <?php echo max($tmpInfo['totalColumns'], $currCells);
                        $xml->close();

                        $tmpInfo['lastColumnIndex'] <?php echo $tmpInfo['totalColumns'] - 1;
                        $tmpInfo['lastColumnLetter'] <?php echo Coordinate::stringFromColumnIndex($tmpInfo['lastColumnIndex'] + 1);

                        $worksheetInfo[] <?php echo $tmpInfo;
                    }
                }
            }
        }

        $zip->close();

        return $worksheetInfo;
    }

    private static function castToBoolean(SimpleXMLElement $c): bool
    {
        $value <?php echo isset($c->v) ? (string) $c->v : null;
        if ($value <?php echo<?php echo '0') {
            return false;
        } elseif ($value <?php echo<?php echo '1') {
            return true;
        }

        return (bool) $c->v;
    }

    private static function castToError(?SimpleXMLElement $c): ?string
    {
        return isset($c, $c->v) ? (string) $c->v : null;
    }

    private static function castToString(?SimpleXMLElement $c): ?string
    {
        return isset($c, $c->v) ? (string) $c->v : null;
    }

    /**
     * @param mixed $value
     * @param mixed $calculatedValue
     */
    private function castToFormula(?SimpleXMLElement $c, string $r, string &$cellDataType, &$value, &$calculatedValue, string $castBaseType, bool $updateSharedCells <?php echo true): void
    {
        if ($c <?php echo<?php echo<?php echo null) {
            return;
        }
        $attr <?php echo $c->f->attributes();
        $cellDataType <?php echo DataType::TYPE_FORMULA;
        $value <?php echo "<?php echo{$c->f}";
        $calculatedValue <?php echo self::$castBaseType($c);

        // Shared formula?
        if (isset($attr['t']) && strtolower((string) $attr['t']) <?php echo<?php echo 'shared') {
            $instance <?php echo (string) $attr['si'];

            if (!isset($this->sharedFormulae[(string) $attr['si']])) {
                $this->sharedFormulae[$instance] <?php echo new SharedFormula($r, $value);
            } elseif ($updateSharedCells <?php echo<?php echo<?php echo true) {
                // It's only worth the overhead of adjusting the shared formula for this cell if we're actually loading
                //     the cell, which may not be the case if we're using a read filter.
                $master <?php echo Coordinate::indexesFromString($this->sharedFormulae[$instance]->master());
                $current <?php echo Coordinate::indexesFromString($r);

                $difference <?php echo [0, 0];
                $difference[0] <?php echo $current[0] - $master[0];
                $difference[1] <?php echo $current[1] - $master[1];

                $value <?php echo $this->referenceHelper->updateFormulaReferences($this->sharedFormulae[$instance]->formula(), 'A1', $difference[0], $difference[1]);
            }
        }
    }

    /**
     * @param string $fileName
     */
    private function fileExistsInArchive(ZipArchive $archive, $fileName <?php echo ''): bool
    {
        // Root-relative paths
        if (strpos($fileName, '//') !<?php echo<?php echo false) {
            $fileName <?php echo substr($fileName, strpos($fileName, '//') + 1);
        }
        $fileName <?php echo File::realpath($fileName);

        // Sadly, some 3rd party xlsx generators don't use consistent case for filenaming
        //    so we need to load case-insensitively from the zip file

        // Apache POI fixes
        $contents <?php echo $archive->locateName($fileName, ZipArchive::FL_NOCASE);
        if ($contents <?php echo<?php echo<?php echo false) {
            $contents <?php echo $archive->locateName(substr($fileName, 1), ZipArchive::FL_NOCASE);
        }

        return $contents !<?php echo<?php echo false;
    }

    /**
     * @param string $fileName
     *
     * @return string
     */
    private function getFromZipArchive(ZipArchive $archive, $fileName <?php echo '')
    {
        // Root-relative paths
        if (strpos($fileName, '//') !<?php echo<?php echo false) {
            $fileName <?php echo substr($fileName, strpos($fileName, '//') + 1);
        }
        // Relative paths generated by dirname($filename) when $filename
        // has no path (i.e.files in root of the zip archive)
        $fileName <?php echo (string) preg_replace('/^\.\//', '', $fileName);
        $fileName <?php echo File::realpath($fileName);

        // Sadly, some 3rd party xlsx generators don't use consistent case for filenaming
        //    so we need to load case-insensitively from the zip file

        $contents <?php echo $archive->getFromName($fileName, 0, ZipArchive::FL_NOCASE);

        // Apache POI fixes
        if ($contents <?php echo<?php echo<?php echo false) {
            $contents <?php echo $archive->getFromName(substr($fileName, 1), 0, ZipArchive::FL_NOCASE);
        }

        // Has the file been saved with Windoze directory separators rather than unix?
        if ($contents <?php echo<?php echo<?php echo false) {
            $contents <?php echo $archive->getFromName(str_replace('/', '\\', $fileName), 0, ZipArchive::FL_NOCASE);
        }

        return ($contents <?php echo<?php echo<?php echo false) ? '' : $contents;
    }

    /**
     * Loads Spreadsheet from file.
     */
    protected function loadSpreadsheetFromFile(string $filename): Spreadsheet
    {
        File::assertFile($filename, self::INITIAL_FILE);

        // Initialisations
        $excel <?php echo new Spreadsheet();
        $excel->removeSheetByIndex(0);
        $addingFirstCellStyleXf <?php echo true;
        $addingFirstCellXf <?php echo true;

        $unparsedLoadedData <?php echo [];

        $this->zip <?php echo $zip <?php echo new ZipArchive();
        $zip->open($filename);

        //    Read the theme first, because we need the colour scheme when reading the styles
        [$workbookBasename, $xmlNamespaceBase] <?php echo $this->getWorkbookBaseName();
        $drawingNS <?php echo self::REL_TO_DRAWING[$xmlNamespaceBase] ?? Namespaces::DRAWINGML;
        $chartNS <?php echo self::REL_TO_CHART[$xmlNamespaceBase] ?? Namespaces::CHART;
        $wbRels <?php echo $this->loadZip("xl/_rels/{$workbookBasename}.rels", Namespaces::RELATIONSHIPS);
        $theme <?php echo null;
        $this->styleReader <?php echo new Styles();
        foreach ($wbRels->Relationship as $relx) {
            $rel <?php echo self::getAttributes($relx);
            $relTarget <?php echo (string) $rel['Target'];
            if (substr($relTarget, 0, 4) <?php echo<?php echo<?php echo '/xl/') {
                $relTarget <?php echo substr($relTarget, 4);
            }
            switch ($rel['Type']) {
                case "$xmlNamespaceBase/theme":
                    $themeOrderArray <?php echo ['lt1', 'dk1', 'lt2', 'dk2'];
                    $themeOrderAdditional <?php echo count($themeOrderArray);

                    $xmlTheme <?php echo $this->loadZip("xl/{$relTarget}", $drawingNS);
                    $xmlThemeName <?php echo self::getAttributes($xmlTheme);
                    $xmlTheme <?php echo $xmlTheme->children($drawingNS);
                    $themeName <?php echo (string) $xmlThemeName['name'];

                    $colourScheme <?php echo self::getAttributes($xmlTheme->themeElements->clrScheme);
                    $colourSchemeName <?php echo (string) $colourScheme['name'];
                    $excel->getTheme()->setThemeColorName($colourSchemeName);
                    $colourScheme <?php echo $xmlTheme->themeElements->clrScheme->children($drawingNS);

                    $themeColours <?php echo [];
                    foreach ($colourScheme as $k <?php echo> $xmlColour) {
                        $themePos <?php echo array_search($k, $themeOrderArray);
                        if ($themePos <?php echo<?php echo<?php echo false) {
                            $themePos <?php echo $themeOrderAdditional++;
                        }
                        if (isset($xmlColour->sysClr)) {
                            $xmlColourData <?php echo self::getAttributes($xmlColour->sysClr);
                            $themeColours[$themePos] <?php echo (string) $xmlColourData['lastClr'];
                            $excel->getTheme()->setThemeColor($k, (string) $xmlColourData['lastClr']);
                        } elseif (isset($xmlColour->srgbClr)) {
                            $xmlColourData <?php echo self::getAttributes($xmlColour->srgbClr);
                            $themeColours[$themePos] <?php echo (string) $xmlColourData['val'];
                            $excel->getTheme()->setThemeColor($k, (string) $xmlColourData['val']);
                        }
                    }
                    $theme <?php echo new Theme($themeName, $colourSchemeName, $themeColours);
                    $this->styleReader->setTheme($theme);

                    $fontScheme <?php echo self::getAttributes($xmlTheme->themeElements->fontScheme);
                    $fontSchemeName <?php echo (string) $fontScheme['name'];
                    $excel->getTheme()->setThemeFontName($fontSchemeName);
                    $majorFonts <?php echo [];
                    $minorFonts <?php echo [];
                    $fontScheme <?php echo $xmlTheme->themeElements->fontScheme->children($drawingNS);
                    $majorLatin <?php echo self::getAttributes($fontScheme->majorFont->latin)['typeface'] ?? '';
                    $majorEastAsian <?php echo self::getAttributes($fontScheme->majorFont->ea)['typeface'] ?? '';
                    $majorComplexScript <?php echo self::getAttributes($fontScheme->majorFont->cs)['typeface'] ?? '';
                    $minorLatin <?php echo self::getAttributes($fontScheme->minorFont->latin)['typeface'] ?? '';
                    $minorEastAsian <?php echo self::getAttributes($fontScheme->minorFont->ea)['typeface'] ?? '';
                    $minorComplexScript <?php echo self::getAttributes($fontScheme->minorFont->cs)['typeface'] ?? '';

                    foreach ($fontScheme->majorFont->font as $xmlFont) {
                        $fontAttributes <?php echo self::getAttributes($xmlFont);
                        $script <?php echo (string) ($fontAttributes['script'] ?? '');
                        if (!empty($script)) {
                            $majorFonts[$script] <?php echo (string) ($fontAttributes['typeface'] ?? '');
                        }
                    }
                    foreach ($fontScheme->minorFont->font as $xmlFont) {
                        $fontAttributes <?php echo self::getAttributes($xmlFont);
                        $script <?php echo (string) ($fontAttributes['script'] ?? '');
                        if (!empty($script)) {
                            $minorFonts[$script] <?php echo (string) ($fontAttributes['typeface'] ?? '');
                        }
                    }
                    $excel->getTheme()->setMajorFontValues($majorLatin, $majorEastAsian, $majorComplexScript, $majorFonts);
                    $excel->getTheme()->setMinorFontValues($minorLatin, $minorEastAsian, $minorComplexScript, $minorFonts);

                    break;
            }
        }

        $rels <?php echo $this->loadZip(self::INITIAL_FILE, Namespaces::RELATIONSHIPS);

        $propertyReader <?php echo new PropertyReader($this->getSecurityScannerOrThrow(), $excel->getProperties());
        $chartDetails <?php echo [];
        foreach ($rels->Relationship as $relx) {
            $rel <?php echo self::getAttributes($relx);
            $relTarget <?php echo (string) $rel['Target'];
            // issue 3553
            if ($relTarget[0] <?php echo<?php echo<?php echo '/') {
                $relTarget <?php echo substr($relTarget, 1);
            }
            $relType <?php echo (string) $rel['Type'];
            $mainNS <?php echo self::REL_TO_MAIN[$relType] ?? Namespaces::MAIN;
            switch ($relType) {
                case Namespaces::CORE_PROPERTIES:
                    $propertyReader->readCoreProperties($this->getFromZipArchive($zip, $relTarget));

                    break;
                case "$xmlNamespaceBase/extended-properties":
                    $propertyReader->readExtendedProperties($this->getFromZipArchive($zip, $relTarget));

                    break;
                case "$xmlNamespaceBase/custom-properties":
                    $propertyReader->readCustomProperties($this->getFromZipArchive($zip, $relTarget));

                    break;
                    //Ribbon
                case Namespaces::EXTENSIBILITY:
                    $customUI <?php echo $relTarget;
                    if ($customUI) {
                        $this->readRibbon($excel, $customUI, $zip);
                    }

                    break;
                case "$xmlNamespaceBase/officeDocument":
                    $dir <?php echo dirname($relTarget);

                    // Do not specify namespace in next stmt - do it in Xpath
                    $relsWorkbook <?php echo $this->loadZip("$dir/_rels/" . basename($relTarget) . '.rels', '');
                    $relsWorkbook->registerXPathNamespace('rel', Namespaces::RELATIONSHIPS);

                    $worksheets <?php echo [];
                    $macros <?php echo $customUI <?php echo null;
                    foreach ($relsWorkbook->Relationship as $elex) {
                        $ele <?php echo self::getAttributes($elex);
                        switch ($ele['Type']) {
                            case Namespaces::WORKSHEET:
                            case Namespaces::PURL_WORKSHEET:
                                $worksheets[(string) $ele['Id']] <?php echo $ele['Target'];

                                break;
                            case Namespaces::CHARTSHEET:
                                if ($this->includeCharts <?php echo<?php echo<?php echo true) {
                                    $worksheets[(string) $ele['Id']] <?php echo $ele['Target'];
                                }

                                break;
                                // a vbaProject ? (: some macros)
                            case Namespaces::VBA:
                                $macros <?php echo $ele['Target'];

                                break;
                        }
                    }

                    if ($macros !<?php echo<?php echo null) {
                        $macrosCode <?php echo $this->getFromZipArchive($zip, 'xl/vbaProject.bin'); //vbaProject.bin always in 'xl' dir and always named vbaProject.bin
                        if ($macrosCode !<?php echo<?php echo false) {
                            $excel->setMacrosCode($macrosCode);
                            $excel->setHasMacros(true);
                            //short-circuit : not reading vbaProject.bin.rel to get Signature <?php echo>allways vbaProjectSignature.bin in 'xl' dir
                            $Certificate <?php echo $this->getFromZipArchive($zip, 'xl/vbaProjectSignature.bin');
                            if ($Certificate !<?php echo<?php echo false) {
                                $excel->setMacrosCertificate($Certificate);
                            }
                        }
                    }

                    $relType <?php echo "rel:Relationship[@Type<?php echo'"
                        . "$xmlNamespaceBase/styles"
                        . "']";
                    $xpath <?php echo self::getArrayItem(self::xpathNoFalse($relsWorkbook, $relType));

                    if ($xpath <?php echo<?php echo<?php echo null) {
                        $xmlStyles <?php echo self::testSimpleXml(null);
                    } else {
                        $xmlStyles <?php echo $this->loadZip("$dir/$xpath[Target]", $mainNS);
                    }

                    $palette <?php echo self::extractPalette($xmlStyles);
                    $this->styleReader->setWorkbookPalette($palette);
                    $fills <?php echo self::extractStyles($xmlStyles, 'fills', 'fill');
                    $fonts <?php echo self::extractStyles($xmlStyles, 'fonts', 'font');
                    $borders <?php echo self::extractStyles($xmlStyles, 'borders', 'border');
                    $xfTags <?php echo self::extractStyles($xmlStyles, 'cellXfs', 'xf');
                    $cellXfTags <?php echo self::extractStyles($xmlStyles, 'cellStyleXfs', 'xf');

                    $styles <?php echo [];
                    $cellStyles <?php echo [];
                    $numFmts <?php echo null;
                    if (/*$xmlStyles && */ $xmlStyles->numFmts[0]) {
                        $numFmts <?php echo $xmlStyles->numFmts[0];
                    }
                    if (isset($numFmts) && ($numFmts !<?php echo<?php echo null)) {
                        $numFmts->registerXPathNamespace('sml', $mainNS);
                    }
                    $this->styleReader->setNamespace($mainNS);
                    if (!$this->readDataOnly/* && $xmlStyles*/) {
                        foreach ($xfTags as $xfTag) {
                            $xf <?php echo self::getAttributes($xfTag);
                            $numFmt <?php echo null;

                            if ($xf['numFmtId']) {
                                if (isset($numFmts)) {
                                    $tmpNumFmt <?php echo self::getArrayItem($numFmts->xpath("sml:numFmt[@numFmtId<?php echo$xf[numFmtId]]"));

                                    if (isset($tmpNumFmt['formatCode'])) {
                                        $numFmt <?php echo (string) $tmpNumFmt['formatCode'];
                                    }
                                }

                                // We shouldn't override any of the built-in MS Excel values (values below id 164)
                                //  But there's a lot of naughty homebrew xlsx writers that do use "reserved" id values that aren't actually used
                                //  So we make allowance for them rather than lose formatting masks
                                if (
                                    $numFmt <?php echo<?php echo<?php echo null &&
                                    (int) $xf['numFmtId'] < 164 &&
                                    NumberFormat::builtInFormatCode((int) $xf['numFmtId']) !<?php echo<?php echo ''
                                ) {
                                    $numFmt <?php echo NumberFormat::builtInFormatCode((int) $xf['numFmtId']);
                                }
                            }
                            $quotePrefix <?php echo (bool) (string) ($xf['quotePrefix'] ?? '');

                            $style <?php echo (object) [
                                'numFmt' <?php echo> $numFmt ?? NumberFormat::FORMAT_GENERAL,
                                'font' <?php echo> $fonts[(int) ($xf['fontId'])],
                                'fill' <?php echo> $fills[(int) ($xf['fillId'])],
                                'border' <?php echo> $borders[(int) ($xf['borderId'])],
                                'alignment' <?php echo> $xfTag->alignment,
                                'protection' <?php echo> $xfTag->protection,
                                'quotePrefix' <?php echo> $quotePrefix,
                            ];
                            $styles[] <?php echo $style;

                            // add style to cellXf collection
                            $objStyle <?php echo new Style();
                            $this->styleReader->readStyle($objStyle, $style);
                            if ($addingFirstCellXf) {
                                $excel->removeCellXfByIndex(0); // remove the default style
                                $addingFirstCellXf <?php echo false;
                            }
                            $excel->addCellXf($objStyle);
                        }

                        foreach ($cellXfTags as $xfTag) {
                            $xf <?php echo self::getAttributes($xfTag);
                            $numFmt <?php echo NumberFormat::FORMAT_GENERAL;
                            if ($numFmts && $xf['numFmtId']) {
                                $tmpNumFmt <?php echo self::getArrayItem($numFmts->xpath("sml:numFmt[@numFmtId<?php echo$xf[numFmtId]]"));
                                if (isset($tmpNumFmt['formatCode'])) {
                                    $numFmt <?php echo (string) $tmpNumFmt['formatCode'];
                                } elseif ((int) $xf['numFmtId'] < 165) {
                                    $numFmt <?php echo NumberFormat::builtInFormatCode((int) $xf['numFmtId']);
                                }
                            }

                            $quotePrefix <?php echo (bool) (string) ($xf['quotePrefix'] ?? '');

                            $cellStyle <?php echo (object) [
                                'numFmt' <?php echo> $numFmt,
                                'font' <?php echo> $fonts[(int) ($xf['fontId'])],
                                'fill' <?php echo> $fills[((int) $xf['fillId'])],
                                'border' <?php echo> $borders[(int) ($xf['borderId'])],
                                'alignment' <?php echo> $xfTag->alignment,
                                'protection' <?php echo> $xfTag->protection,
                                'quotePrefix' <?php echo> $quotePrefix,
                            ];
                            $cellStyles[] <?php echo $cellStyle;

                            // add style to cellStyleXf collection
                            $objStyle <?php echo new Style();
                            $this->styleReader->readStyle($objStyle, $cellStyle);
                            if ($addingFirstCellStyleXf) {
                                $excel->removeCellStyleXfByIndex(0); // remove the default style
                                $addingFirstCellStyleXf <?php echo false;
                            }
                            $excel->addCellStyleXf($objStyle);
                        }
                    }
                    $this->styleReader->setStyleXml($xmlStyles);
                    $this->styleReader->setNamespace($mainNS);
                    $this->styleReader->setStyleBaseData($theme, $styles, $cellStyles);
                    $dxfs <?php echo $this->styleReader->dxfs($this->readDataOnly);
                    $styles <?php echo $this->styleReader->styles();

                    // Read content after setting the styles
                    $sharedStrings <?php echo [];
                    $relType <?php echo "rel:Relationship[@Type<?php echo'"
                        //. Namespaces::SHARED_STRINGS
                        . "$xmlNamespaceBase/sharedStrings"
                        . "']";
                    $xpath <?php echo self::getArrayItem($relsWorkbook->xpath($relType));

                    if ($xpath) {
                        $xmlStrings <?php echo $this->loadZip("$dir/$xpath[Target]", $mainNS);
                        if (isset($xmlStrings->si)) {
                            foreach ($xmlStrings->si as $val) {
                                if (isset($val->t)) {
                                    $sharedStrings[] <?php echo StringHelper::controlCharacterOOXML2PHP((string) $val->t);
                                } elseif (isset($val->r)) {
                                    $sharedStrings[] <?php echo $this->parseRichText($val);
                                }
                            }
                        }
                    }

                    $xmlWorkbook <?php echo $this->loadZipNoNamespace($relTarget, $mainNS);
                    $xmlWorkbookNS <?php echo $this->loadZip($relTarget, $mainNS);

                    // Set base date
                    if ($xmlWorkbookNS->workbookPr) {
                        Date::setExcelCalendar(Date::CALENDAR_WINDOWS_1900);
                        $attrs1904 <?php echo self::getAttributes($xmlWorkbookNS->workbookPr);
                        if (isset($attrs1904['date1904'])) {
                            if (self::boolean((string) $attrs1904['date1904'])) {
                                Date::setExcelCalendar(Date::CALENDAR_MAC_1904);
                            }
                        }
                    }

                    // Set protection
                    $this->readProtection($excel, $xmlWorkbook);

                    $sheetId <?php echo 0; // keep track of new sheet id in final workbook
                    $oldSheetId <?php echo -1; // keep track of old sheet id in final workbook
                    $countSkippedSheets <?php echo 0; // keep track of number of skipped sheets
                    $mapSheetId <?php echo []; // mapping of sheet ids from old to new

                    $charts <?php echo $chartDetails <?php echo [];

                    if ($xmlWorkbookNS->sheets) {
                        /** @var SimpleXMLElement $eleSheet */
                        foreach ($xmlWorkbookNS->sheets->sheet as $eleSheet) {
                            $eleSheetAttr <?php echo self::getAttributes($eleSheet);
                            ++$oldSheetId;

                            // Check if sheet should be skipped
                            if (is_array($this->loadSheetsOnly) && !in_array((string) $eleSheetAttr['name'], $this->loadSheetsOnly)) {
                                ++$countSkippedSheets;
                                $mapSheetId[$oldSheetId] <?php echo null;

                                continue;
                            }

                            $sheetReferenceId <?php echo (string) self::getArrayItem(self::getAttributes($eleSheet, $xmlNamespaceBase), 'id');
                            if (isset($worksheets[$sheetReferenceId]) <?php echo<?php echo<?php echo false) {
                                ++$countSkippedSheets;
                                $mapSheetId[$oldSheetId] <?php echo null;

                                continue;
                            }
                            // Map old sheet id in original workbook to new sheet id.
                            // They will differ if loadSheetsOnly() is being used
                            $mapSheetId[$oldSheetId] <?php echo $oldSheetId - $countSkippedSheets;

                            // Load sheet
                            $docSheet <?php echo $excel->createSheet();
                            //    Use false for $updateFormulaCellReferences to prevent adjustment of worksheet
                            //        references in formula cells... during the load, all formulae should be correct,
                            //        and we're simply bringing the worksheet name in line with the formula, not the
                            //        reverse
                            $docSheet->setTitle((string) $eleSheetAttr['name'], false, false);

                            $fileWorksheet <?php echo (string) $worksheets[$sheetReferenceId];
                            $xmlSheet <?php echo $this->loadZipNoNamespace("$dir/$fileWorksheet", $mainNS);
                            $xmlSheetNS <?php echo $this->loadZip("$dir/$fileWorksheet", $mainNS);

                            // Shared Formula table is unique to each Worksheet, so we need to reset it here
                            $this->sharedFormulae <?php echo [];

                            if (isset($eleSheetAttr['state']) && (string) $eleSheetAttr['state'] !<?php echo '') {
                                $docSheet->setSheetState((string) $eleSheetAttr['state']);
                            }
                            if ($xmlSheetNS) {
                                $xmlSheetMain <?php echo $xmlSheetNS->children($mainNS);
                                // Setting Conditional Styles adjusts selected cells, so we need to execute this
                                //    before reading the sheet view data to get the actual selected cells
                                if (!$this->readDataOnly && ($xmlSheet->conditionalFormatting)) {
                                    (new ConditionalStyles($docSheet, $xmlSheet, $dxfs))->load();
                                }
                                if (!$this->readDataOnly && $xmlSheet->extLst) {
                                    (new ConditionalStyles($docSheet, $xmlSheet, $dxfs))->loadFromExt($this->styleReader);
                                }
                                if (isset($xmlSheetMain->sheetViews, $xmlSheetMain->sheetViews->sheetView)) {
                                    $sheetViews <?php echo new SheetViews($xmlSheetMain->sheetViews->sheetView, $docSheet);
                                    $sheetViews->load();
                                }

                                $sheetViewOptions <?php echo new SheetViewOptions($docSheet, $xmlSheetNS);
                                $sheetViewOptions->load($this->getReadDataOnly(), $this->styleReader);

                                (new ColumnAndRowAttributes($docSheet, $xmlSheetNS))
                                    ->load($this->getReadFilter(), $this->getReadDataOnly());
                            }

                            if ($xmlSheetNS && $xmlSheetNS->sheetData && $xmlSheetNS->sheetData->row) {
                                $cIndex <?php echo 1; // Cell Start from 1
                                foreach ($xmlSheetNS->sheetData->row as $row) {
                                    $rowIndex <?php echo 1;
                                    foreach ($row->c as $c) {
                                        $cAttr <?php echo self::getAttributes($c);
                                        $r <?php echo (string) $cAttr['r'];
                                        if ($r <?php echo<?php echo '') {
                                            $r <?php echo Coordinate::stringFromColumnIndex($rowIndex) . $cIndex;
                                        }
                                        $cellDataType <?php echo (string) $cAttr['t'];
                                        $value <?php echo null;
                                        $calculatedValue <?php echo null;

                                        // Read cell?
                                        if ($this->getReadFilter() !<?php echo<?php echo null) {
                                            $coordinates <?php echo Coordinate::coordinateFromString($r);

                                            if (!$this->getReadFilter()->readCell($coordinates[0], (int) $coordinates[1], $docSheet->getTitle())) {
                                                // Normally, just testing for the f attribute should identify this cell as containing a formula
                                                // that we need to read, even though it is outside of the filter range, in case it is a shared formula.
                                                // But in some cases, this attribute isn't set; so we need to delve a level deeper and look at
                                                // whether or not the cell has a child formula element that is shared.
                                                if (isset($cAttr->f) || (isset($c->f, $c->f->attributes()['t']) && strtolower((string) $c->f->attributes()['t']) <?php echo<?php echo<?php echo 'shared')) {
                                                    $this->castToFormula($c, $r, $cellDataType, $value, $calculatedValue, 'castToError', false);
                                                }
                                                ++$rowIndex;

                                                continue;
                                            }
                                        }

                                        // Read cell!
                                        switch ($cellDataType) {
                                            case 's':
                                                if ((string) $c->v !<?php echo '') {
                                                    $value <?php echo $sharedStrings[(int) ($c->v)];

                                                    if ($value instanceof RichText) {
                                                        $value <?php echo clone $value;
                                                    }
                                                } else {
                                                    $value <?php echo '';
                                                }

                                                break;
                                            case 'b':
                                                if (!isset($c->f)) {
                                                    if (isset($c->v)) {
                                                        $value <?php echo self::castToBoolean($c);
                                                    } else {
                                                        $value <?php echo null;
                                                        $cellDataType <?php echo DATATYPE::TYPE_NULL;
                                                    }
                                                } else {
                                                    // Formula
                                                    $this->castToFormula($c, $r, $cellDataType, $value, $calculatedValue, 'castToBoolean');
                                                    if (isset($c->f['t'])) {
                                                        $att <?php echo $c->f;
                                                        $docSheet->getCell($r)->setFormulaAttributes($att);
                                                    }
                                                }

                                                break;
                                            case 'inlineStr':
                                                if (isset($c->f)) {
                                                    $this->castToFormula($c, $r, $cellDataType, $value, $calculatedValue, 'castToError');
                                                } else {
                                                    $value <?php echo $this->parseRichText($c->is);
                                                }

                                                break;
                                            case 'e':
                                                if (!isset($c->f)) {
                                                    $value <?php echo self::castToError($c);
                                                } else {
                                                    // Formula
                                                    $this->castToFormula($c, $r, $cellDataType, $value, $calculatedValue, 'castToError');
                                                }

                                                break;
                                            default:
                                                if (!isset($c->f)) {
                                                    $value <?php echo self::castToString($c);
                                                } else {
                                                    // Formula
                                                    $this->castToFormula($c, $r, $cellDataType, $value, $calculatedValue, 'castToString');
                                                    if (isset($c->f['t'])) {
                                                        $attributes <?php echo $c->f['t'];
                                                        $docSheet->getCell($r)->setFormulaAttributes(['t' <?php echo> (string) $attributes]);
                                                    }
                                                }

                                                break;
                                        }

                                        // read empty cells or the cells are not empty
                                        if ($this->readEmptyCells || ($value !<?php echo<?php echo null && $value !<?php echo<?php echo '')) {
                                            // Rich text?
                                            if ($value instanceof RichText && $this->readDataOnly) {
                                                $value <?php echo $value->getPlainText();
                                            }

                                            $cell <?php echo $docSheet->getCell($r);
                                            // Assign value
                                            if ($cellDataType !<?php echo '') {
                                                // it is possible, that datatype is numeric but with an empty string, which result in an error
                                                if ($cellDataType <?php echo<?php echo<?php echo DataType::TYPE_NUMERIC && ($value <?php echo<?php echo<?php echo '' || $value <?php echo<?php echo<?php echo null)) {
                                                    $cellDataType <?php echo DataType::TYPE_NULL;
                                                }
                                                if ($cellDataType !<?php echo<?php echo DataType::TYPE_NULL) {
                                                    $cell->setValueExplicit($value, $cellDataType);
                                                }
                                            } else {
                                                $cell->setValue($value);
                                            }
                                            if ($calculatedValue !<?php echo<?php echo null) {
                                                $cell->setCalculatedValue($calculatedValue);
                                            }

                                            // Style information?
                                            if ($cAttr['s'] && !$this->readDataOnly) {
                                                // no style index means 0, it seems
                                                $cell->setXfIndex(isset($styles[(int) ($cAttr['s'])]) ?
                                                    (int) ($cAttr['s']) : 0);
                                                // issue 3495
                                                if ($cell->getDataType() <?php echo<?php echo<?php echo DataType::TYPE_FORMULA) {
                                                    $cell->getStyle()->setQuotePrefix(false);
                                                }
                                            }
                                        }
                                        ++$rowIndex;
                                    }
                                    ++$cIndex;
                                }
                            }
                            if ($xmlSheetNS && $xmlSheetNS->ignoredErrors) {
                                foreach ($xmlSheetNS->ignoredErrors->ignoredError as $ignoredErrorx) {
                                    $ignoredError <?php echo self::testSimpleXml($ignoredErrorx);
                                    $this->processIgnoredErrors($ignoredError, $docSheet);
                                }
                            }

                            if (!$this->readDataOnly && $xmlSheetNS && $xmlSheetNS->sheetProtection) {
                                $protAttr <?php echo $xmlSheetNS->sheetProtection->attributes() ?? [];
                                foreach ($protAttr as $key <?php echo> $value) {
                                    $method <?php echo 'set' . ucfirst($key);
                                    $docSheet->getProtection()->$method(self::boolean((string) $value));
                                }
                            }

                            if ($xmlSheet) {
                                $this->readSheetProtection($docSheet, $xmlSheet);
                            }

                            if ($this->readDataOnly <?php echo<?php echo<?php echo false) {
                                $this->readAutoFilter($xmlSheet, $docSheet);
                                $this->readTables($xmlSheet, $docSheet, $dir, $fileWorksheet, $zip);
                            }

                            if ($xmlSheetNS && $xmlSheetNS->mergeCells && $xmlSheetNS->mergeCells->mergeCell && !$this->readDataOnly) {
                                foreach ($xmlSheetNS->mergeCells->mergeCell as $mergeCellx) {
                                    /** @scrutinizer ignore-call */
                                    $mergeCell <?php echo $mergeCellx->attributes();
                                    $mergeRef <?php echo (string) ($mergeCell['ref'] ?? '');
                                    if (strpos($mergeRef, ':') !<?php echo<?php echo false) {
                                        $docSheet->mergeCells($mergeRef, Worksheet::MERGE_CELL_CONTENT_HIDE);
                                    }
                                }
                            }

                            if ($xmlSheet && !$this->readDataOnly) {
                                $unparsedLoadedData <?php echo (new PageSetup($docSheet, $xmlSheet))->load($unparsedLoadedData);
                            }

                            if ($xmlSheet !<?php echo<?php echo false && isset($xmlSheet->extLst, $xmlSheet->extLst->ext, $xmlSheet->extLst->ext['uri']) && ($xmlSheet->extLst->ext['uri'] <?php echo<?php echo '{CCE6A557-97BC-4b89-ADB6-D9C93CAAB3DF}')) {
                                // Create dataValidations node if does not exists, maybe is better inside the foreach ?
                                if (!$xmlSheet->dataValidations) {
                                    $xmlSheet->addChild('dataValidations');
                                }

                                foreach ($xmlSheet->extLst->ext->children(Namespaces::DATA_VALIDATIONS1)->dataValidations->dataValidation as $item) {
                                    $item <?php echo self::testSimpleXml($item);
                                    $node <?php echo self::testSimpleXml($xmlSheet->dataValidations)->addChild('dataValidation');
                                    foreach ($item->attributes() ?? [] as $attr) {
                                        $node->addAttribute($attr->getName(), $attr);
                                    }
                                    $node->addAttribute('sqref', $item->children(Namespaces::DATA_VALIDATIONS2)->sqref);
                                    if (isset($item->formula1)) {
                                        $childNode <?php echo $node->addChild('formula1');
                                        if ($childNode !<?php echo<?php echo null) { // null should never happen
                                            $childNode[0] <?php echo (string) $item->formula1->children(Namespaces::DATA_VALIDATIONS2)->f; // @phpstan-ignore-line
                                        }
                                    }
                                }
                            }

                            if ($xmlSheet && $xmlSheet->dataValidations && !$this->readDataOnly) {
                                (new DataValidations($docSheet, $xmlSheet))->load();
                            }

                            // unparsed sheet AlternateContent
                            if ($xmlSheet && !$this->readDataOnly) {
                                $mc <?php echo $xmlSheet->children(Namespaces::COMPATIBILITY);
                                if ($mc->AlternateContent) {
                                    foreach ($mc->AlternateContent as $alternateContent) {
                                        $alternateContent <?php echo self::testSimpleXml($alternateContent);
                                        $unparsedLoadedData['sheets'][$docSheet->getCodeName()]['AlternateContents'][] <?php echo $alternateContent->asXML();
                                    }
                                }
                            }

                            // Add hyperlinks
                            if (!$this->readDataOnly) {
                                $hyperlinkReader <?php echo new Hyperlinks($docSheet);
                                // Locate hyperlink relations
                                $relationsFileName <?php echo dirname("$dir/$fileWorksheet") . '/_rels/' . basename($fileWorksheet) . '.rels';
                                if ($zip->locateName($relationsFileName)) {
                                    $relsWorksheet <?php echo $this->loadZip($relationsFileName, Namespaces::RELATIONSHIPS);
                                    $hyperlinkReader->readHyperlinks($relsWorksheet);
                                }

                                // Loop through hyperlinks
                                if ($xmlSheetNS && $xmlSheetNS->children($mainNS)->hyperlinks) {
                                    $hyperlinkReader->setHyperlinks($xmlSheetNS->children($mainNS)->hyperlinks);
                                }
                            }

                            // Add comments
                            $comments <?php echo [];
                            $vmlComments <?php echo [];
                            if (!$this->readDataOnly) {
                                // Locate comment relations
                                $commentRelations <?php echo dirname("$dir/$fileWorksheet") . '/_rels/' . basename($fileWorksheet) . '.rels';
                                if ($zip->locateName($commentRelations)) {
                                    $relsWorksheet <?php echo $this->loadZip($commentRelations, Namespaces::RELATIONSHIPS);
                                    foreach ($relsWorksheet->Relationship as $elex) {
                                        $ele <?php echo self::getAttributes($elex);
                                        if ($ele['Type'] <?php echo<?php echo Namespaces::COMMENTS) {
                                            $comments[(string) $ele['Id']] <?php echo (string) $ele['Target'];
                                        }
                                        if ($ele['Type'] <?php echo<?php echo Namespaces::VML) {
                                            $vmlComments[(string) $ele['Id']] <?php echo (string) $ele['Target'];
                                        }
                                    }
                                }

                                // Loop through comments
                                foreach ($comments as $relName <?php echo> $relPath) {
                                    // Load comments file
                                    $relPath <?php echo File::realpath(dirname("$dir/$fileWorksheet") . '/' . $relPath);
                                    // okay to ignore namespace - using xpath
                                    $commentsFile <?php echo $this->loadZip($relPath, '');

                                    // Utility variables
                                    $authors <?php echo [];
                                    $commentsFile->registerXpathNamespace('com', $mainNS);
                                    $authorPath <?php echo self::xpathNoFalse($commentsFile, 'com:authors/com:author');
                                    foreach ($authorPath as $author) {
                                        $authors[] <?php echo (string) $author;
                                    }

                                    // Loop through contents
                                    $contentPath <?php echo self::xpathNoFalse($commentsFile, 'com:commentList/com:comment');
                                    foreach ($contentPath as $comment) {
                                        $commentx <?php echo $comment->attributes();
                                        $commentModel <?php echo $docSheet->getComment((string) $commentx['ref']);
                                        if (isset($commentx['authorId'])) {
                                            $commentModel->setAuthor($authors[(int) $commentx['authorId']]);
                                        }
                                        $commentModel->setText($this->parseRichText($comment->children($mainNS)->text));
                                    }
                                }

                                // later we will remove from it real vmlComments
                                $unparsedVmlDrawings <?php echo $vmlComments;
                                $vmlDrawingContents <?php echo [];

                                // Loop through VML comments
                                foreach ($vmlComments as $relName <?php echo> $relPath) {
                                    // Load VML comments file
                                    $relPath <?php echo File::realpath(dirname("$dir/$fileWorksheet") . '/' . $relPath);

                                    try {
                                        // no namespace okay - processed with Xpath
                                        $vmlCommentsFile <?php echo $this->loadZip($relPath, '', true);
                                        $vmlCommentsFile->registerXPathNamespace('v', Namespaces::URN_VML);
                                    } catch (Throwable $ex) {
                                        //Ignore unparsable vmlDrawings. Later they will be moved from $unparsedVmlDrawings to $unparsedLoadedData
                                        continue;
                                    }

                                    // Locate VML drawings image relations
                                    $drowingImages <?php echo [];
                                    $VMLDrawingsRelations <?php echo dirname($relPath) . '/_rels/' . basename($relPath) . '.rels';
                                    $vmlDrawingContents[$relName] <?php echo $this->getSecurityScannerOrThrow()->scan($this->getFromZipArchive($zip, $relPath));
                                    if ($zip->locateName($VMLDrawingsRelations)) {
                                        $relsVMLDrawing <?php echo $this->loadZip($VMLDrawingsRelations, Namespaces::RELATIONSHIPS);
                                        foreach ($relsVMLDrawing->Relationship as $elex) {
                                            $ele <?php echo self::getAttributes($elex);
                                            if ($ele['Type'] <?php echo<?php echo Namespaces::IMAGE) {
                                                $drowingImages[(string) $ele['Id']] <?php echo (string) $ele['Target'];
                                            }
                                        }
                                    }

                                    $shapes <?php echo self::xpathNoFalse($vmlCommentsFile, '//v:shape');
                                    foreach ($shapes as $shape) {
                                        $shape->registerXPathNamespace('v', Namespaces::URN_VML);

                                        if (isset($shape['style'])) {
                                            $style <?php echo (string) $shape['style'];
                                            $fillColor <?php echo strtoupper(substr((string) $shape['fillcolor'], 1));
                                            $column <?php echo null;
                                            $row <?php echo null;
                                            $fillImageRelId <?php echo null;
                                            $fillImageTitle <?php echo '';

                                            $clientData <?php echo $shape->xpath('.//x:ClientData');
                                            if (is_array($clientData) && !empty($clientData)) {
                                                $clientData <?php echo $clientData[0];

                                                if (isset($clientData['ObjectType']) && (string) $clientData['ObjectType'] <?php echo<?php echo 'Note') {
                                                    $temp <?php echo $clientData->xpath('.//x:Row');
                                                    if (is_array($temp)) {
                                                        $row <?php echo $temp[0];
                                                    }

                                                    $temp <?php echo $clientData->xpath('.//x:Column');
                                                    if (is_array($temp)) {
                                                        $column <?php echo $temp[0];
                                                    }
                                                }
                                            }

                                            $fillImageRelNode <?php echo $shape->xpath('.//v:fill/@o:relid');
                                            if (is_array($fillImageRelNode) && !empty($fillImageRelNode)) {
                                                $fillImageRelNode <?php echo $fillImageRelNode[0];

                                                if (isset($fillImageRelNode['relid'])) {
                                                    $fillImageRelId <?php echo (string) $fillImageRelNode['relid'];
                                                }
                                            }

                                            $fillImageTitleNode <?php echo $shape->xpath('.//v:fill/@o:title');
                                            if (is_array($fillImageTitleNode) && !empty($fillImageTitleNode)) {
                                                $fillImageTitleNode <?php echo $fillImageTitleNode[0];

                                                if (isset($fillImageTitleNode['title'])) {
                                                    $fillImageTitle <?php echo (string) $fillImageTitleNode['title'];
                                                }
                                            }

                                            if (($column !<?php echo<?php echo null) && ($row !<?php echo<?php echo null)) {
                                                // Set comment properties
                                                $comment <?php echo $docSheet->getComment([$column + 1, $row + 1]);
                                                $comment->getFillColor()->setRGB($fillColor);
                                                if (isset($drowingImages[$fillImageRelId])) {
                                                    $objDrawing <?php echo new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                                                    $objDrawing->setName($fillImageTitle);
                                                    $imagePath <?php echo str_replace('../', 'xl/', $drowingImages[$fillImageRelId]);
                                                    $objDrawing->setPath(
                                                        'zip://' . File::realpath($filename) . '#' . $imagePath,
                                                        true,
                                                        $zip
                                                    );
                                                    $comment->setBackgroundImage($objDrawing);
                                                }

                                                // Parse style
                                                $styleArray <?php echo explode(';', str_replace(' ', '', $style));
                                                foreach ($styleArray as $stylePair) {
                                                    $stylePair <?php echo explode(':', $stylePair);

                                                    if ($stylePair[0] <?php echo<?php echo 'margin-left') {
                                                        $comment->setMarginLeft($stylePair[1]);
                                                    }
                                                    if ($stylePair[0] <?php echo<?php echo 'margin-top') {
                                                        $comment->setMarginTop($stylePair[1]);
                                                    }
                                                    if ($stylePair[0] <?php echo<?php echo 'width') {
                                                        $comment->setWidth($stylePair[1]);
                                                    }
                                                    if ($stylePair[0] <?php echo<?php echo 'height') {
                                                        $comment->setHeight($stylePair[1]);
                                                    }
                                                    if ($stylePair[0] <?php echo<?php echo 'visibility') {
                                                        $comment->setVisible($stylePair[1] <?php echo<?php echo 'visible');
                                                    }
                                                }

                                                unset($unparsedVmlDrawings[$relName]);
                                            }
                                        }
                                    }
                                }

                                // unparsed vmlDrawing
                                if ($unparsedVmlDrawings) {
                                    foreach ($unparsedVmlDrawings as $rId <?php echo> $relPath) {
                                        $rId <?php echo substr($rId, 3); // rIdXXX
                                        $unparsedVmlDrawing <?php echo &$unparsedLoadedData['sheets'][$docSheet->getCodeName()]['vmlDrawings'];
                                        $unparsedVmlDrawing[$rId] <?php echo [];
                                        $unparsedVmlDrawing[$rId]['filePath'] <?php echo self::dirAdd("$dir/$fileWorksheet", $relPath);
                                        $unparsedVmlDrawing[$rId]['relFilePath'] <?php echo $relPath;
                                        $unparsedVmlDrawing[$rId]['content'] <?php echo $this->getSecurityScannerOrThrow()->scan($this->getFromZipArchive($zip, $unparsedVmlDrawing[$rId]['filePath']));
                                        unset($unparsedVmlDrawing);
                                    }
                                }

                                // Header/footer images
                                if ($xmlSheetNS && $xmlSheetNS->legacyDrawingHF) {
                                    $vmlHfRid <?php echo '';
                                    $vmlHfRidAttr <?php echo $xmlSheetNS->legacyDrawingHF->attributes(Namespaces::SCHEMA_OFFICE_DOCUMENT);
                                    if ($vmlHfRidAttr !<?php echo<?php echo null && isset($vmlHfRidAttr['id'])) {
                                        $vmlHfRid <?php echo (string) $vmlHfRidAttr['id'][0];
                                    }
                                    if ($zip->locateName(dirname("$dir/$fileWorksheet") . '/_rels/' . basename($fileWorksheet) . '.rels')) {
                                        $relsWorksheet <?php echo $this->loadZipNoNamespace(dirname("$dir/$fileWorksheet") . '/_rels/' . basename($fileWorksheet) . '.rels', Namespaces::RELATIONSHIPS);
                                        $vmlRelationship <?php echo '';

                                        foreach ($relsWorksheet->Relationship as $ele) {
                                            if ((string) $ele['Type'] <?php echo<?php echo Namespaces::VML && (string) $ele['Id'] <?php echo<?php echo<?php echo $vmlHfRid) {
                                                $vmlRelationship <?php echo self::dirAdd("$dir/$fileWorksheet", $ele['Target']);

                                                break;
                                            }
                                        }

                                        if ($vmlRelationship !<?php echo '') {
                                            // Fetch linked images
                                            $relsVML <?php echo $this->loadZipNoNamespace(dirname($vmlRelationship) . '/_rels/' . basename($vmlRelationship) . '.rels', Namespaces::RELATIONSHIPS);
                                            $drawings <?php echo [];
                                            if (isset($relsVML->Relationship)) {
                                                foreach ($relsVML->Relationship as $ele) {
                                                    if ($ele['Type'] <?php echo<?php echo Namespaces::IMAGE) {
                                                        $drawings[(string) $ele['Id']] <?php echo self::dirAdd($vmlRelationship, $ele['Target']);
                                                    }
                                                }
                                            }
                                            // Fetch VML document
                                            $vmlDrawing <?php echo $this->loadZipNoNamespace($vmlRelationship, '');
                                            $vmlDrawing->registerXPathNamespace('v', Namespaces::URN_VML);

                                            $hfImages <?php echo [];

                                            $shapes <?php echo self::xpathNoFalse($vmlDrawing, '//v:shape');
                                            foreach ($shapes as $idx <?php echo> $shape) {
                                                $shape->registerXPathNamespace('v', Namespaces::URN_VML);
                                                $imageData <?php echo $shape->xpath('//v:imagedata');

                                                if (empty($imageData)) {
                                                    continue;
                                                }

                                                $imageData <?php echo $imageData[$idx];

                                                $imageData <?php echo self::getAttributes($imageData, Namespaces::URN_MSOFFICE);
                                                $style <?php echo self::toCSSArray((string) $shape['style']);

                                                if (array_key_exists((string) $imageData['relid'], $drawings)) {
                                                    $shapeId <?php echo (string) $shape['id'];
                                                    $hfImages[$shapeId] <?php echo new HeaderFooterDrawing();
                                                    if (isset($imageData['title'])) {
                                                        $hfImages[$shapeId]->setName((string) $imageData['title']);
                                                    }

                                                    $hfImages[$shapeId]->setPath('zip://' . File::realpath($filename) . '#' . $drawings[(string) $imageData['relid']], false);
                                                    $hfImages[$shapeId]->setResizeProportional(false);
                                                    $hfImages[$shapeId]->setWidth($style['width']);
                                                    $hfImages[$shapeId]->setHeight($style['height']);
                                                    if (isset($style['margin-left'])) {
                                                        $hfImages[$shapeId]->setOffsetX($style['margin-left']);
                                                    }
                                                    $hfImages[$shapeId]->setOffsetY($style['margin-top']);
                                                    $hfImages[$shapeId]->setResizeProportional(true);
                                                }
                                            }

                                            $docSheet->getHeaderFooter()->setImages($hfImages);
                                        }
                                    }
                                }
                            }

                            // TODO: Autoshapes from twoCellAnchors!
                            $drawingFilename <?php echo dirname("$dir/$fileWorksheet")
                                . '/_rels/'
                                . basename($fileWorksheet)
                                . '.rels';
                            if (substr($drawingFilename, 0, 7) <?php echo<?php echo<?php echo 'xl//xl/') {
                                $drawingFilename <?php echo substr($drawingFilename, 4);
                            }
                            if (substr($drawingFilename, 0, 8) <?php echo<?php echo<?php echo '/xl//xl/') {
                                $drawingFilename <?php echo substr($drawingFilename, 5);
                            }
                            if ($zip->locateName($drawingFilename)) {
                                $relsWorksheet <?php echo $this->loadZipNoNamespace($drawingFilename, Namespaces::RELATIONSHIPS);
                                $drawings <?php echo [];
                                foreach ($relsWorksheet->Relationship as $ele) {
                                    if ((string) $ele['Type'] <?php echo<?php echo<?php echo "$xmlNamespaceBase/drawing") {
                                        $eleTarget <?php echo (string) $ele['Target'];
                                        if (substr($eleTarget, 0, 4) <?php echo<?php echo<?php echo '/xl/') {
                                            $drawings[(string) $ele['Id']] <?php echo substr($eleTarget, 1);
                                        } else {
                                            $drawings[(string) $ele['Id']] <?php echo self::dirAdd("$dir/$fileWorksheet", $ele['Target']);
                                        }
                                    }
                                }

                                if ($xmlSheetNS->drawing && !$this->readDataOnly) {
                                    $unparsedDrawings <?php echo [];
                                    $fileDrawing <?php echo null;
                                    foreach ($xmlSheetNS->drawing as $drawing) {
                                        $drawingRelId <?php echo (string) self::getArrayItem(self::getAttributes($drawing, $xmlNamespaceBase), 'id');
                                        $fileDrawing <?php echo $drawings[$drawingRelId];
                                        $drawingFilename <?php echo dirname($fileDrawing) . '/_rels/' . basename($fileDrawing) . '.rels';
                                        $relsDrawing <?php echo $this->loadZipNoNamespace($drawingFilename, $xmlNamespaceBase);

                                        $images <?php echo [];
                                        $hyperlinks <?php echo [];
                                        if ($relsDrawing && $relsDrawing->Relationship) {
                                            foreach ($relsDrawing->Relationship as $ele) {
                                                $eleType <?php echo (string) $ele['Type'];
                                                if ($eleType <?php echo<?php echo<?php echo Namespaces::HYPERLINK) {
                                                    $hyperlinks[(string) $ele['Id']] <?php echo (string) $ele['Target'];
                                                }
                                                if ($eleType <?php echo<?php echo<?php echo "$xmlNamespaceBase/image") {
                                                    $eleTarget <?php echo (string) $ele['Target'];
                                                    if (substr($eleTarget, 0, 4) <?php echo<?php echo<?php echo '/xl/') {
                                                        $eleTarget <?php echo substr($eleTarget, 1);
                                                        $images[(string) $ele['Id']] <?php echo $eleTarget;
                                                    } else {
                                                        $images[(string) $ele['Id']] <?php echo self::dirAdd($fileDrawing, $eleTarget);
                                                    }
                                                } elseif ($eleType <?php echo<?php echo<?php echo "$xmlNamespaceBase/chart") {
                                                    if ($this->includeCharts) {
                                                        $eleTarget <?php echo (string) $ele['Target'];
                                                        if (substr($eleTarget, 0, 4) <?php echo<?php echo<?php echo '/xl/') {
                                                            $index <?php echo substr($eleTarget, 1);
                                                        } else {
                                                            $index <?php echo self::dirAdd($fileDrawing, $eleTarget);
                                                        }
                                                        $charts[$index] <?php echo [
                                                            'id' <?php echo> (string) $ele['Id'],
                                                            'sheet' <?php echo> $docSheet->getTitle(),
                                                        ];
                                                    }
                                                }
                                            }
                                        }

                                        $xmlDrawing <?php echo $this->loadZipNoNamespace($fileDrawing, '');
                                        $xmlDrawingChildren <?php echo $xmlDrawing->children(Namespaces::SPREADSHEET_DRAWING);

                                        if ($xmlDrawingChildren->oneCellAnchor) {
                                            foreach ($xmlDrawingChildren->oneCellAnchor as $oneCellAnchor) {
                                                $oneCellAnchor <?php echo self::testSimpleXml($oneCellAnchor);
                                                if ($oneCellAnchor->pic->blipFill) {
                                                    /** @var SimpleXMLElement $blip */
                                                    $blip <?php echo $oneCellAnchor->pic->blipFill->children(Namespaces::DRAWINGML)->blip;
                                                    /** @var SimpleXMLElement $xfrm */
                                                    $xfrm <?php echo $oneCellAnchor->pic->spPr->children(Namespaces::DRAWINGML)->xfrm;
                                                    /** @var SimpleXMLElement $outerShdw */
                                                    $outerShdw <?php echo $oneCellAnchor->pic->spPr->children(Namespaces::DRAWINGML)->effectLst->outerShdw;

                                                    $objDrawing <?php echo new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                                                    $objDrawing->setName((string) self::getArrayItem(self::getAttributes($oneCellAnchor->pic->nvPicPr->cNvPr), 'name'));
                                                    $objDrawing->setDescription((string) self::getArrayItem(self::getAttributes($oneCellAnchor->pic->nvPicPr->cNvPr), 'descr'));
                                                    $embedImageKey <?php echo (string) self::getArrayItem(
                                                        self::getAttributes($blip, $xmlNamespaceBase),
                                                        'embed'
                                                    );
                                                    if (isset($images[$embedImageKey])) {
                                                        $objDrawing->setPath(
                                                            'zip://' . File::realpath($filename) . '#' .
                                                            $images[$embedImageKey],
                                                            false
                                                        );
                                                    } else {
                                                        $linkImageKey <?php echo (string) self::getArrayItem(
                                                            $blip->attributes('http://schemas.openxmlformats.org/officeDocument/2006/relationships'),
                                                            'link'
                                                        );
                                                        if (isset($images[$linkImageKey])) {
                                                            $url <?php echo str_replace('xl/drawings/', '', $images[$linkImageKey]);
                                                            $objDrawing->setPath($url);
                                                        }
                                                    }
                                                    $objDrawing->setCoordinates(Coordinate::stringFromColumnIndex(((int) $oneCellAnchor->from->col) + 1) . ($oneCellAnchor->from->row + 1));

                                                    $objDrawing->setOffsetX((int) Drawing::EMUToPixels($oneCellAnchor->from->colOff));
                                                    $objDrawing->setOffsetY(Drawing::EMUToPixels($oneCellAnchor->from->rowOff));
                                                    $objDrawing->setResizeProportional(false);
                                                    $objDrawing->setWidth(Drawing::EMUToPixels(self::getArrayItem(self::getAttributes($oneCellAnchor->ext), 'cx')));
                                                    $objDrawing->setHeight(Drawing::EMUToPixels(self::getArrayItem(self::getAttributes($oneCellAnchor->ext), 'cy')));
                                                    if ($xfrm) {
                                                        $objDrawing->setRotation((int) Drawing::angleToDegrees(self::getArrayItem(self::getAttributes($xfrm), 'rot')));
                                                    }
                                                    if ($outerShdw) {
                                                        $shadow <?php echo $objDrawing->getShadow();
                                                        $shadow->setVisible(true);
                                                        $shadow->setBlurRadius(Drawing::EMUToPixels(self::getArrayItem(self::getAttributes($outerShdw), 'blurRad')));
                                                        $shadow->setDistance(Drawing::EMUToPixels(self::getArrayItem(self::getAttributes($outerShdw), 'dist')));
                                                        $shadow->setDirection(Drawing::angleToDegrees(self::getArrayItem(self::getAttributes($outerShdw), 'dir')));
                                                        $shadow->setAlignment((string) self::getArrayItem(self::getAttributes($outerShdw), 'algn'));
                                                        $clr <?php echo $outerShdw->srgbClr ?? $outerShdw->prstClr;
                                                        $shadow->getColor()->setRGB(self::getArrayItem(self::getAttributes($clr), 'val'));
                                                        $shadow->setAlpha(self::getArrayItem(self::getAttributes($clr->alpha), 'val') / 1000);
                                                    }

                                                    $this->readHyperLinkDrawing($objDrawing, $oneCellAnchor, $hyperlinks);

                                                    $objDrawing->setWorksheet($docSheet);
                                                } elseif ($this->includeCharts && $oneCellAnchor->graphicFrame) {
                                                    // Exported XLSX from Google Sheets positions charts with a oneCellAnchor
                                                    $coordinates <?php echo Coordinate::stringFromColumnIndex(((int) $oneCellAnchor->from->col) + 1) . ($oneCellAnchor->from->row + 1);
                                                    $offsetX <?php echo Drawing::EMUToPixels($oneCellAnchor->from->colOff);
                                                    $offsetY <?php echo Drawing::EMUToPixels($oneCellAnchor->from->rowOff);
                                                    $width <?php echo Drawing::EMUToPixels(self::getArrayItem(self::getAttributes($oneCellAnchor->ext), 'cx'));
                                                    $height <?php echo Drawing::EMUToPixels(self::getArrayItem(self::getAttributes($oneCellAnchor->ext), 'cy'));

                                                    $graphic <?php echo $oneCellAnchor->graphicFrame->children(Namespaces::DRAWINGML)->graphic;
                                                    /** @var SimpleXMLElement $chartRef */
                                                    $chartRef <?php echo $graphic->graphicData->children(Namespaces::CHART)->chart;
                                                    $thisChart <?php echo (string) self::getAttributes($chartRef, $xmlNamespaceBase);

                                                    $chartDetails[$docSheet->getTitle() . '!' . $thisChart] <?php echo [
                                                        'fromCoordinate' <?php echo> $coordinates,
                                                        'fromOffsetX' <?php echo> $offsetX,
                                                        'fromOffsetY' <?php echo> $offsetY,
                                                        'width' <?php echo> $width,
                                                        'height' <?php echo> $height,
                                                        'worksheetTitle' <?php echo> $docSheet->getTitle(),
                                                        'oneCellAnchor' <?php echo> true,
                                                    ];
                                                }
                                            }
                                        }
                                        if ($xmlDrawingChildren->twoCellAnchor) {
                                            foreach ($xmlDrawingChildren->twoCellAnchor as $twoCellAnchor) {
                                                $twoCellAnchor <?php echo self::testSimpleXml($twoCellAnchor);
                                                if ($twoCellAnchor->pic->blipFill) {
                                                    $blip <?php echo $twoCellAnchor->pic->blipFill->children(Namespaces::DRAWINGML)->blip;
                                                    $xfrm <?php echo $twoCellAnchor->pic->spPr->children(Namespaces::DRAWINGML)->xfrm;
                                                    $outerShdw <?php echo $twoCellAnchor->pic->spPr->children(Namespaces::DRAWINGML)->effectLst->outerShdw;
                                                    $objDrawing <?php echo new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                                                    /** @scrutinizer ignore-call */
                                                    $editAs <?php echo $twoCellAnchor->attributes();
                                                    if (isset($editAs, $editAs['editAs'])) {
                                                        $objDrawing->setEditAs($editAs['editAs']);
                                                    }
                                                    $objDrawing->setName((string) self::getArrayItem(self::getAttributes($twoCellAnchor->pic->nvPicPr->cNvPr), 'name'));
                                                    $objDrawing->setDescription((string) self::getArrayItem(self::getAttributes($twoCellAnchor->pic->nvPicPr->cNvPr), 'descr'));
                                                    $embedImageKey <?php echo (string) self::getArrayItem(
                                                        self::getAttributes($blip, $xmlNamespaceBase),
                                                        'embed'
                                                    );
                                                    if (isset($images[$embedImageKey])) {
                                                        $objDrawing->setPath(
                                                            'zip://' . File::realpath($filename) . '#' .
                                                            $images[$embedImageKey],
                                                            false
                                                        );
                                                    } else {
                                                        $linkImageKey <?php echo (string) self::getArrayItem(
                                                            $blip->attributes('http://schemas.openxmlformats.org/officeDocument/2006/relationships'),
                                                            'link'
                                                        );
                                                        if (isset($images[$linkImageKey])) {
                                                            $url <?php echo str_replace('xl/drawings/', '', $images[$linkImageKey]);
                                                            $objDrawing->setPath($url);
                                                        }
                                                    }
                                                    $objDrawing->setCoordinates(Coordinate::stringFromColumnIndex(((int) $twoCellAnchor->from->col) + 1) . ($twoCellAnchor->from->row + 1));

                                                    $objDrawing->setOffsetX(Drawing::EMUToPixels($twoCellAnchor->from->colOff));
                                                    $objDrawing->setOffsetY(Drawing::EMUToPixels($twoCellAnchor->from->rowOff));

                                                    $objDrawing->setCoordinates2(Coordinate::stringFromColumnIndex(((int) $twoCellAnchor->to->col) + 1) . ($twoCellAnchor->to->row + 1));

                                                    $objDrawing->setOffsetX2(Drawing::EMUToPixels($twoCellAnchor->to->colOff));
                                                    $objDrawing->setOffsetY2(Drawing::EMUToPixels($twoCellAnchor->to->rowOff));

                                                    $objDrawing->setResizeProportional(false);

                                                    if ($xfrm) {
                                                        $objDrawing->setWidth(Drawing::EMUToPixels(self::getArrayItem(self::getAttributes($xfrm->ext), 'cx')));
                                                        $objDrawing->setHeight(Drawing::EMUToPixels(self::getArrayItem(self::getAttributes($xfrm->ext), 'cy')));
                                                        $objDrawing->setRotation(Drawing::angleToDegrees(self::getArrayItem(self::getAttributes($xfrm), 'rot')));
                                                    }
                                                    if ($outerShdw) {
                                                        $shadow <?php echo $objDrawing->getShadow();
                                                        $shadow->setVisible(true);
                                                        $shadow->setBlurRadius(Drawing::EMUToPixels(self::getArrayItem(self::getAttributes($outerShdw), 'blurRad')));
                                                        $shadow->setDistance(Drawing::EMUToPixels(self::getArrayItem(self::getAttributes($outerShdw), 'dist')));
                                                        $shadow->setDirection(Drawing::angleToDegrees(self::getArrayItem(self::getAttributes($outerShdw), 'dir')));
                                                        $shadow->setAlignment((string) self::getArrayItem(self::getAttributes($outerShdw), 'algn'));
                                                        $clr <?php echo $outerShdw->srgbClr ?? $outerShdw->prstClr;
                                                        $shadow->getColor()->setRGB(self::getArrayItem(self::getAttributes($clr), 'val'));
                                                        $shadow->setAlpha(self::getArrayItem(self::getAttributes($clr->alpha), 'val') / 1000);
                                                    }

                                                    $this->readHyperLinkDrawing($objDrawing, $twoCellAnchor, $hyperlinks);

                                                    $objDrawing->setWorksheet($docSheet);
                                                } elseif (($this->includeCharts) && ($twoCellAnchor->graphicFrame)) {
                                                    $fromCoordinate <?php echo Coordinate::stringFromColumnIndex(((int) $twoCellAnchor->from->col) + 1) . ($twoCellAnchor->from->row + 1);
                                                    $fromOffsetX <?php echo Drawing::EMUToPixels($twoCellAnchor->from->colOff);
                                                    $fromOffsetY <?php echo Drawing::EMUToPixels($twoCellAnchor->from->rowOff);
                                                    $toCoordinate <?php echo Coordinate::stringFromColumnIndex(((int) $twoCellAnchor->to->col) + 1) . ($twoCellAnchor->to->row + 1);
                                                    $toOffsetX <?php echo Drawing::EMUToPixels($twoCellAnchor->to->colOff);
                                                    $toOffsetY <?php echo Drawing::EMUToPixels($twoCellAnchor->to->rowOff);
                                                    $graphic <?php echo $twoCellAnchor->graphicFrame->children(Namespaces::DRAWINGML)->graphic;
                                                    /** @var SimpleXMLElement $chartRef */
                                                    $chartRef <?php echo $graphic->graphicData->children(Namespaces::CHART)->chart;
                                                    $thisChart <?php echo (string) self::getAttributes($chartRef, $xmlNamespaceBase);

                                                    $chartDetails[$docSheet->getTitle() . '!' . $thisChart] <?php echo [
                                                        'fromCoordinate' <?php echo> $fromCoordinate,
                                                        'fromOffsetX' <?php echo> $fromOffsetX,
                                                        'fromOffsetY' <?php echo> $fromOffsetY,
                                                        'toCoordinate' <?php echo> $toCoordinate,
                                                        'toOffsetX' <?php echo> $toOffsetX,
                                                        'toOffsetY' <?php echo> $toOffsetY,
                                                        'worksheetTitle' <?php echo> $docSheet->getTitle(),
                                                    ];
                                                }
                                            }
                                        }
                                        if ($xmlDrawingChildren->absoluteAnchor) {
                                            foreach ($xmlDrawingChildren->absoluteAnchor as $absoluteAnchor) {
                                                if (($this->includeCharts) && ($absoluteAnchor->graphicFrame)) {
                                                    $graphic <?php echo $absoluteAnchor->graphicFrame->children(Namespaces::DRAWINGML)->graphic;
                                                    /** @var SimpleXMLElement $chartRef */
                                                    $chartRef <?php echo $graphic->graphicData->children(Namespaces::CHART)->chart;
                                                    $thisChart <?php echo (string) self::getAttributes($chartRef, $xmlNamespaceBase);
                                                    $width <?php echo Drawing::EMUToPixels((int) self::getArrayItem(self::getAttributes($absoluteAnchor->ext), 'cx')[0]);
                                                    $height <?php echo Drawing::EMUToPixels((int) self::getArrayItem(self::getAttributes($absoluteAnchor->ext), 'cy')[0]);

                                                    $chartDetails[$docSheet->getTitle() . '!' . $thisChart] <?php echo [
                                                        'fromCoordinate' <?php echo> 'A1',
                                                        'fromOffsetX' <?php echo> 0,
                                                        'fromOffsetY' <?php echo> 0,
                                                        'width' <?php echo> $width,
                                                        'height' <?php echo> $height,
                                                        'worksheetTitle' <?php echo> $docSheet->getTitle(),
                                                    ];
                                                }
                                            }
                                        }
                                        if (empty($relsDrawing) && $xmlDrawing->count() <?php echo<?php echo 0) {
                                            // Save Drawing without rels and children as unparsed
                                            $unparsedDrawings[$drawingRelId] <?php echo $xmlDrawing->asXML();
                                        }
                                    }

                                    // store original rId of drawing files
                                    $unparsedLoadedData['sheets'][$docSheet->getCodeName()]['drawingOriginalIds'] <?php echo [];
                                    foreach ($relsWorksheet->Relationship as $ele) {
                                        if ((string) $ele['Type'] <?php echo<?php echo<?php echo "$xmlNamespaceBase/drawing") {
                                            $drawingRelId <?php echo (string) $ele['Id'];
                                            $unparsedLoadedData['sheets'][$docSheet->getCodeName()]['drawingOriginalIds'][(string) $ele['Target']] <?php echo $drawingRelId;
                                            if (isset($unparsedDrawings[$drawingRelId])) {
                                                $unparsedLoadedData['sheets'][$docSheet->getCodeName()]['Drawings'][$drawingRelId] <?php echo $unparsedDrawings[$drawingRelId];
                                            }
                                        }
                                    }
                                    if ($xmlSheet->legacyDrawing && !$this->readDataOnly) {
                                        foreach ($xmlSheet->legacyDrawing as $drawing) {
                                            $drawingRelId <?php echo (string) self::getArrayItem(self::getAttributes($drawing, $xmlNamespaceBase), 'id');
                                            if (isset($vmlDrawingContents[$drawingRelId])) {
                                                $unparsedLoadedData['sheets'][$docSheet->getCodeName()]['legacyDrawing'] <?php echo $vmlDrawingContents[$drawingRelId];
                                            }
                                        }
                                    }

                                    // unparsed drawing AlternateContent
                                    $xmlAltDrawing <?php echo $this->loadZip((string) $fileDrawing, Namespaces::COMPATIBILITY);

                                    if ($xmlAltDrawing->AlternateContent) {
                                        foreach ($xmlAltDrawing->AlternateContent as $alternateContent) {
                                            $alternateContent <?php echo self::testSimpleXml($alternateContent);
                                            $unparsedLoadedData['sheets'][$docSheet->getCodeName()]['drawingAlternateContents'][] <?php echo $alternateContent->asXML();
                                        }
                                    }
                                }
                            }

                            $this->readFormControlProperties($excel, $dir, $fileWorksheet, $docSheet, $unparsedLoadedData);
                            $this->readPrinterSettings($excel, $dir, $fileWorksheet, $docSheet, $unparsedLoadedData);

                            // Loop through definedNames
                            if ($xmlWorkbook->definedNames) {
                                foreach ($xmlWorkbook->definedNames->definedName as $definedName) {
                                    // Extract range
                                    $extractedRange <?php echo (string) $definedName;
                                    if (($spos <?php echo strpos($extractedRange, '!')) !<?php echo<?php echo false) {
                                        $extractedRange <?php echo substr($extractedRange, 0, $spos) . str_replace('$', '', substr($extractedRange, $spos));
                                    } else {
                                        $extractedRange <?php echo str_replace('$', '', $extractedRange);
                                    }

                                    // Valid range?
                                    if ($extractedRange <?php echo<?php echo '') {
                                        continue;
                                    }

                                    // Some definedNames are only applicable if we are on the same sheet...
                                    if ((string) $definedName['localSheetId'] !<?php echo '' && (string) $definedName['localSheetId'] <?php echo<?php echo $oldSheetId) {
                                        // Switch on type
                                        switch ((string) $definedName['name']) {
                                            case '_xlnm._FilterDatabase':
                                                if ((string) $definedName['hidden'] !<?php echo<?php echo '1') {
                                                    $extractedRange <?php echo explode(',', $extractedRange);
                                                    foreach ($extractedRange as $range) {
                                                        $autoFilterRange <?php echo $range;
                                                        if (strpos($autoFilterRange, ':') !<?php echo<?php echo false) {
                                                            $docSheet->getAutoFilter()->setRange($autoFilterRange);
                                                        }
                                                    }
                                                }

                                                break;
                                            case '_xlnm.Print_Titles':
                                                // Split $extractedRange
                                                $extractedRange <?php echo explode(',', $extractedRange);

                                                // Set print titles
                                                foreach ($extractedRange as $range) {
                                                    $matches <?php echo [];
                                                    $range <?php echo str_replace('$', '', $range);

                                                    // check for repeating columns, e g. 'A:A' or 'A:D'
                                                    if (preg_match('/!?([A-Z]+)\:([A-Z]+)$/', $range, $matches)) {
                                                        $docSheet->getPageSetup()->setColumnsToRepeatAtLeft([$matches[1], $matches[2]]);
                                                    } elseif (preg_match('/!?(\d+)\:(\d+)$/', $range, $matches)) {
                                                        // check for repeating rows, e.g. '1:1' or '1:5'
                                                        $docSheet->getPageSetup()->setRowsToRepeatAtTop([$matches[1], $matches[2]]);
                                                    }
                                                }

                                                break;
                                            case '_xlnm.Print_Area':
                                                $rangeSets <?php echo preg_split("/('?(?:.*?)'?(?:![A-Z0-9]+:[A-Z0-9]+)),?/", $extractedRange, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE) ?: [];
                                                $newRangeSets <?php echo [];
                                                foreach ($rangeSets as $rangeSet) {
                                                    [, $rangeSet] <?php echo Worksheet::extractSheetTitle($rangeSet, true);
                                                    if (empty($rangeSet)) {
                                                        continue;
                                                    }
                                                    if (strpos($rangeSet, ':') <?php echo<?php echo<?php echo false) {
                                                        $rangeSet <?php echo $rangeSet . ':' . $rangeSet;
                                                    }
                                                    $newRangeSets[] <?php echo str_replace('$', '', $rangeSet);
                                                }
                                                if (count($newRangeSets) > 0) {
                                                    $docSheet->getPageSetup()->setPrintArea(implode(',', $newRangeSets));
                                                }

                                                break;
                                            default:
                                                break;
                                        }
                                    }
                                }
                            }

                            // Next sheet id
                            ++$sheetId;
                        }

                        // Loop through definedNames
                        if ($xmlWorkbook->definedNames) {
                            foreach ($xmlWorkbook->definedNames->definedName as $definedName) {
                                // Extract range
                                $extractedRange <?php echo (string) $definedName;

                                // Valid range?
                                if ($extractedRange <?php echo<?php echo '') {
                                    continue;
                                }

                                // Some definedNames are only applicable if we are on the same sheet...
                                if ((string) $definedName['localSheetId'] !<?php echo '') {
                                    // Local defined name
                                    // Switch on type
                                    switch ((string) $definedName['name']) {
                                        case '_xlnm._FilterDatabase':
                                        case '_xlnm.Print_Titles':
                                        case '_xlnm.Print_Area':
                                            break;
                                        default:
                                            if ($mapSheetId[(int) $definedName['localSheetId']] !<?php echo<?php echo null) {
                                                $range <?php echo Worksheet::extractSheetTitle((string) $definedName, true);
                                                $scope <?php echo $excel->getSheet($mapSheetId[(int) $definedName['localSheetId']]);
                                                if (strpos((string) $definedName, '!') !<?php echo<?php echo false) {
                                                    $range[0] <?php echo str_replace("''", "'", $range[0]);
                                                    $range[0] <?php echo str_replace("'", '', $range[0]);
                                                    if ($worksheet <?php echo $excel->getSheetByName($range[0])) { // @phpstan-ignore-line
                                                        $excel->addDefinedName(DefinedName::createInstance((string) $definedName['name'], $worksheet, $extractedRange, true, $scope));
                                                    } else {
                                                        $excel->addDefinedName(DefinedName::createInstance((string) $definedName['name'], $scope, $extractedRange, true, $scope));
                                                    }
                                                } else {
                                                    $excel->addDefinedName(DefinedName::createInstance((string) $definedName['name'], $scope, $extractedRange, true));
                                                }
                                            }

                                            break;
                                    }
                                } elseif (!isset($definedName['localSheetId'])) {
                                    $definedRange <?php echo (string) $definedName;
                                    // "Global" definedNames
                                    $locatedSheet <?php echo null;
                                    if (strpos((string) $definedName, '!') !<?php echo<?php echo false) {
                                        // Modify range, and extract the first worksheet reference
                                        // Need to split on a comma or a space if not in quotes, and extract the first part.
                                        $definedNameValueParts <?php echo preg_split("/[ ,](?<?php echo([^']*'[^']*')*[^']*$)/miuU", $definedRange);
                                        // Extract sheet name
                                        [$extractedSheetName] <?php echo Worksheet::extractSheetTitle((string) $definedNameValueParts[0], true); // @phpstan-ignore-line
                                        $extractedSheetName <?php echo trim($extractedSheetName, "'");

                                        // Locate sheet
                                        $locatedSheet <?php echo $excel->getSheetByName($extractedSheetName);
                                    }

                                    if ($locatedSheet <?php echo<?php echo<?php echo null && !DefinedName::testIfFormula($definedRange)) {
                                        $definedRange <?php echo '#REF!';
                                    }
                                    $excel->addDefinedName(DefinedName::createInstance((string) $definedName['name'], $locatedSheet, $definedRange, false));
                                }
                            }
                        }
                    }

                    (new WorkbookView($excel))->viewSettings($xmlWorkbook, $mainNS, $mapSheetId, $this->readDataOnly);

                    break;
            }
        }

        if (!$this->readDataOnly) {
            $contentTypes <?php echo $this->loadZip('[Content_Types].xml');

            // Default content types
            foreach ($contentTypes->Default as $contentType) {
                switch ($contentType['ContentType']) {
                    case 'application/vnd.openxmlformats-officedocument.spreadsheetml.printerSettings':
                        $unparsedLoadedData['default_content_types'][(string) $contentType['Extension']] <?php echo (string) $contentType['ContentType'];

                        break;
                }
            }

            // Override content types
            foreach ($contentTypes->Override as $contentType) {
                switch ($contentType['ContentType']) {
                    case 'application/vnd.openxmlformats-officedocument.drawingml.chart+xml':
                        if ($this->includeCharts) {
                            $chartEntryRef <?php echo ltrim((string) $contentType['PartName'], '/');
                            $chartElements <?php echo $this->loadZip($chartEntryRef);
                            $chartReader <?php echo new Chart($chartNS, $drawingNS);
                            $objChart <?php echo $chartReader->readChart($chartElements, basename($chartEntryRef, '.xml'));
                            if (isset($charts[$chartEntryRef])) {
                                $chartPositionRef <?php echo $charts[$chartEntryRef]['sheet'] . '!' . $charts[$chartEntryRef]['id'];
                                if (isset($chartDetails[$chartPositionRef])) {
                                    $excel->getSheetByName($charts[$chartEntryRef]['sheet'])->addChart($objChart); // @phpstan-ignore-line
                                    $objChart->setWorksheet($excel->getSheetByName($charts[$chartEntryRef]['sheet']));
                                    // For oneCellAnchor or absoluteAnchor positioned charts,
                                    //     toCoordinate is not in the data. Does it need to be calculated?
                                    if (array_key_exists('toCoordinate', $chartDetails[$chartPositionRef])) {
                                        // twoCellAnchor
                                        $objChart->setTopLeftPosition($chartDetails[$chartPositionRef]['fromCoordinate'], $chartDetails[$chartPositionRef]['fromOffsetX'], $chartDetails[$chartPositionRef]['fromOffsetY']);
                                        $objChart->setBottomRightPosition($chartDetails[$chartPositionRef]['toCoordinate'], $chartDetails[$chartPositionRef]['toOffsetX'], $chartDetails[$chartPositionRef]['toOffsetY']);
                                    } else {
                                        // oneCellAnchor or absoluteAnchor (e.g. Chart sheet)
                                        $objChart->setTopLeftPosition($chartDetails[$chartPositionRef]['fromCoordinate'], $chartDetails[$chartPositionRef]['fromOffsetX'], $chartDetails[$chartPositionRef]['fromOffsetY']);
                                        $objChart->setBottomRightPosition('', $chartDetails[$chartPositionRef]['width'], $chartDetails[$chartPositionRef]['height']);
                                        if (array_key_exists('oneCellAnchor', $chartDetails[$chartPositionRef])) {
                                            $objChart->setOneCellAnchor($chartDetails[$chartPositionRef]['oneCellAnchor']);
                                        }
                                    }
                                }
                            }
                        }

                        break;

                        // unparsed
                    case 'application/vnd.ms-excel.controlproperties+xml':
                        $unparsedLoadedData['override_content_types'][(string) $contentType['PartName']] <?php echo (string) $contentType['ContentType'];

                        break;
                }
            }
        }

        $excel->setUnparsedLoadedData($unparsedLoadedData);

        $zip->close();

        return $excel;
    }

    /**
     * @return RichText
     */
    private function parseRichText(?SimpleXMLElement $is)
    {
        $value <?php echo new RichText();

        if (isset($is->t)) {
            $value->createText(StringHelper::controlCharacterOOXML2PHP((string) $is->t));
        } elseif ($is !<?php echo<?php echo null) {
            if (is_object($is->r)) {
                /** @var SimpleXMLElement $run */
                foreach ($is->r as $run) {
                    if (!isset($run->rPr)) {
                        $value->createText(StringHelper::controlCharacterOOXML2PHP((string) $run->t));
                    } else {
                        $objText <?php echo $value->createTextRun(StringHelper::controlCharacterOOXML2PHP((string) $run->t));
                        $objFont <?php echo $objText->getFont() ?? new StyleFont();

                        if (isset($run->rPr->rFont)) {
                            $attr <?php echo $run->rPr->rFont->attributes();
                            if (isset($attr['val'])) {
                                $objFont->setName((string) $attr['val']);
                            }
                        }
                        if (isset($run->rPr->sz)) {
                            $attr <?php echo $run->rPr->sz->attributes();
                            if (isset($attr['val'])) {
                                $objFont->setSize((float) $attr['val']);
                            }
                        }
                        if (isset($run->rPr->color)) {
                            $objFont->setColor(new Color($this->styleReader->readColor($run->rPr->color)));
                        }
                        if (isset($run->rPr->b)) {
                            $attr <?php echo $run->rPr->b->attributes();
                            if (
                                (isset($attr['val']) && self::boolean((string) $attr['val'])) ||
                                (!isset($attr['val']))
                            ) {
                                $objFont->setBold(true);
                            }
                        }
                        if (isset($run->rPr->i)) {
                            $attr <?php echo $run->rPr->i->attributes();
                            if (
                                (isset($attr['val']) && self::boolean((string) $attr['val'])) ||
                                (!isset($attr['val']))
                            ) {
                                $objFont->setItalic(true);
                            }
                        }
                        if (isset($run->rPr->vertAlign)) {
                            $attr <?php echo $run->rPr->vertAlign->attributes();
                            if (isset($attr['val'])) {
                                $vertAlign <?php echo strtolower((string) $attr['val']);
                                if ($vertAlign <?php echo<?php echo 'superscript') {
                                    $objFont->setSuperscript(true);
                                }
                                if ($vertAlign <?php echo<?php echo 'subscript') {
                                    $objFont->setSubscript(true);
                                }
                            }
                        }
                        if (isset($run->rPr->u)) {
                            $attr <?php echo $run->rPr->u->attributes();
                            if (!isset($attr['val'])) {
                                $objFont->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);
                            } else {
                                $objFont->setUnderline((string) $attr['val']);
                            }
                        }
                        if (isset($run->rPr->strike)) {
                            $attr <?php echo $run->rPr->strike->attributes();
                            if (
                                (isset($attr['val']) && self::boolean((string) $attr['val'])) ||
                                (!isset($attr['val']))
                            ) {
                                $objFont->setStrikethrough(true);
                            }
                        }
                    }
                }
            }
        }

        return $value;
    }

    private function readRibbon(Spreadsheet $excel, string $customUITarget, ZipArchive $zip): void
    {
        $baseDir <?php echo dirname($customUITarget);
        $nameCustomUI <?php echo basename($customUITarget);
        // get the xml file (ribbon)
        $localRibbon <?php echo $this->getFromZipArchive($zip, $customUITarget);
        $customUIImagesNames <?php echo [];
        $customUIImagesBinaries <?php echo [];
        // something like customUI/_rels/customUI.xml.rels
        $pathRels <?php echo $baseDir . '/_rels/' . $nameCustomUI . '.rels';
        $dataRels <?php echo $this->getFromZipArchive($zip, $pathRels);
        if ($dataRels) {
            // exists and not empty if the ribbon have some pictures (other than internal MSO)
            $UIRels <?php echo simplexml_load_string(
                $this->getSecurityScannerOrThrow()->scan($dataRels),
                'SimpleXMLElement',
                Settings::getLibXmlLoaderOptions()
            );
            if (false !<?php echo<?php echo $UIRels) {
                // we need to save id and target to avoid parsing customUI.xml and "guess" if it's a pseudo callback who load the image
                foreach ($UIRels->Relationship as $ele) {
                    if ((string) $ele['Type'] <?php echo<?php echo<?php echo Namespaces::SCHEMA_OFFICE_DOCUMENT . '/image') {
                        // an image ?
                        $customUIImagesNames[(string) $ele['Id']] <?php echo (string) $ele['Target'];
                        $customUIImagesBinaries[(string) $ele['Target']] <?php echo $this->getFromZipArchive($zip, $baseDir . '/' . (string) $ele['Target']);
                    }
                }
            }
        }
        if ($localRibbon) {
            $excel->setRibbonXMLData($customUITarget, $localRibbon);
            if (count($customUIImagesNames) > 0 && count($customUIImagesBinaries) > 0) {
                $excel->setRibbonBinObjects($customUIImagesNames, $customUIImagesBinaries);
            } else {
                $excel->setRibbonBinObjects(null, null);
            }
        } else {
            $excel->setRibbonXMLData(null, null);
            $excel->setRibbonBinObjects(null, null);
        }
    }

    /**
     * @param null|array|bool|SimpleXMLElement $array
     * @param int|string $key
     *
     * @return mixed
     */
    private static function getArrayItem($array, $key <?php echo 0)
    {
        return ($array <?php echo<?php echo<?php echo null || is_bool($array)) ? null : ($array[$key] ?? null);
    }

    /**
     * @param null|SimpleXMLElement|string $base
     * @param null|SimpleXMLElement|string $add
     */
    private static function dirAdd($base, $add): string
    {
        $base <?php echo (string) $base;
        $add <?php echo (string) $add;

        return (string) preg_replace('~[^/]+/\.\./~', '', dirname($base) . "/$add");
    }

    private static function toCSSArray(string $style): array
    {
        $style <?php echo self::stripWhiteSpaceFromStyleString($style);

        $temp <?php echo explode(';', $style);
        $style <?php echo [];
        foreach ($temp as $item) {
            $item <?php echo explode(':', $item);

            if (strpos($item[1], 'px') !<?php echo<?php echo false) {
                $item[1] <?php echo str_replace('px', '', $item[1]);
            }
            if (strpos($item[1], 'pt') !<?php echo<?php echo false) {
                $item[1] <?php echo str_replace('pt', '', $item[1]);
                $item[1] <?php echo (string) Font::fontSizeToPixels((int) $item[1]);
            }
            if (strpos($item[1], 'in') !<?php echo<?php echo false) {
                $item[1] <?php echo str_replace('in', '', $item[1]);
                $item[1] <?php echo (string) Font::inchSizeToPixels((int) $item[1]);
            }
            if (strpos($item[1], 'cm') !<?php echo<?php echo false) {
                $item[1] <?php echo str_replace('cm', '', $item[1]);
                $item[1] <?php echo (string) Font::centimeterSizeToPixels((int) $item[1]);
            }

            $style[$item[0]] <?php echo $item[1];
        }

        return $style;
    }

    public static function stripWhiteSpaceFromStyleString(string $string): string
    {
        return trim(str_replace(["\r", "\n", ' '], '', $string), ';');
    }

    private static function boolean(string $value): bool
    {
        if (is_numeric($value)) {
            return (bool) $value;
        }

        return $value <?php echo<?php echo<?php echo 'true' || $value <?php echo<?php echo<?php echo 'TRUE';
    }

    /**
     * @param array $hyperlinks
     */
    private function readHyperLinkDrawing(\PhpOffice\PhpSpreadsheet\Worksheet\Drawing $objDrawing, SimpleXMLElement $cellAnchor, $hyperlinks): void
    {
        $hlinkClick <?php echo $cellAnchor->pic->nvPicPr->cNvPr->children(Namespaces::DRAWINGML)->hlinkClick;

        if ($hlinkClick->count() <?php echo<?php echo<?php echo 0) {
            return;
        }

        $hlinkId <?php echo (string) self::getAttributes($hlinkClick, Namespaces::SCHEMA_OFFICE_DOCUMENT)['id'];
        $hyperlink <?php echo new Hyperlink(
            $hyperlinks[$hlinkId],
            (string) self::getArrayItem(self::getAttributes($cellAnchor->pic->nvPicPr->cNvPr), 'name')
        );
        $objDrawing->setHyperlink($hyperlink);
    }

    private function readProtection(Spreadsheet $excel, SimpleXMLElement $xmlWorkbook): void
    {
        if (!$xmlWorkbook->workbookProtection) {
            return;
        }

        $excel->getSecurity()->setLockRevision(self::getLockValue($xmlWorkbook->workbookProtection, 'lockRevision'));
        $excel->getSecurity()->setLockStructure(self::getLockValue($xmlWorkbook->workbookProtection, 'lockStructure'));
        $excel->getSecurity()->setLockWindows(self::getLockValue($xmlWorkbook->workbookProtection, 'lockWindows'));

        if ($xmlWorkbook->workbookProtection['revisionsPassword']) {
            $excel->getSecurity()->setRevisionsPassword(
                (string) $xmlWorkbook->workbookProtection['revisionsPassword'],
                true
            );
        }

        if ($xmlWorkbook->workbookProtection['workbookPassword']) {
            $excel->getSecurity()->setWorkbookPassword(
                (string) $xmlWorkbook->workbookProtection['workbookPassword'],
                true
            );
        }
    }

    private static function getLockValue(SimpleXmlElement $protection, string $key): ?bool
    {
        $returnValue <?php echo null;
        $protectKey <?php echo $protection[$key];
        if (!empty($protectKey)) {
            $protectKey <?php echo (string) $protectKey;
            $returnValue <?php echo $protectKey !<?php echo<?php echo 'false' && (bool) $protectKey;
        }

        return $returnValue;
    }

    private function readFormControlProperties(Spreadsheet $excel, string $dir, string $fileWorksheet, Worksheet $docSheet, array &$unparsedLoadedData): void
    {
        $zip <?php echo $this->zip;
        if (!$zip->locateName(dirname("$dir/$fileWorksheet") . '/_rels/' . basename($fileWorksheet) . '.rels')) {
            return;
        }

        $filename <?php echo dirname("$dir/$fileWorksheet") . '/_rels/' . basename($fileWorksheet) . '.rels';
        $relsWorksheet <?php echo $this->loadZipNoNamespace($filename, Namespaces::RELATIONSHIPS);
        $ctrlProps <?php echo [];
        foreach ($relsWorksheet->Relationship as $ele) {
            if ((string) $ele['Type'] <?php echo<?php echo<?php echo Namespaces::SCHEMA_OFFICE_DOCUMENT . '/ctrlProp') {
                $ctrlProps[(string) $ele['Id']] <?php echo $ele;
            }
        }

        $unparsedCtrlProps <?php echo &$unparsedLoadedData['sheets'][$docSheet->getCodeName()]['ctrlProps'];
        foreach ($ctrlProps as $rId <?php echo> $ctrlProp) {
            $rId <?php echo substr($rId, 3); // rIdXXX
            $unparsedCtrlProps[$rId] <?php echo [];
            $unparsedCtrlProps[$rId]['filePath'] <?php echo self::dirAdd("$dir/$fileWorksheet", $ctrlProp['Target']);
            $unparsedCtrlProps[$rId]['relFilePath'] <?php echo (string) $ctrlProp['Target'];
            $unparsedCtrlProps[$rId]['content'] <?php echo $this->getSecurityScannerOrThrow()->scan($this->getFromZipArchive($zip, $unparsedCtrlProps[$rId]['filePath']));
        }
        unset($unparsedCtrlProps);
    }

    private function readPrinterSettings(Spreadsheet $excel, string $dir, string $fileWorksheet, Worksheet $docSheet, array &$unparsedLoadedData): void
    {
        $zip <?php echo $this->zip;
        if (!$zip->locateName(dirname("$dir/$fileWorksheet") . '/_rels/' . basename($fileWorksheet) . '.rels')) {
            return;
        }

        $filename <?php echo dirname("$dir/$fileWorksheet") . '/_rels/' . basename($fileWorksheet) . '.rels';
        $relsWorksheet <?php echo $this->loadZipNoNamespace($filename, Namespaces::RELATIONSHIPS);
        $sheetPrinterSettings <?php echo [];
        foreach ($relsWorksheet->Relationship as $ele) {
            if ((string) $ele['Type'] <?php echo<?php echo<?php echo Namespaces::SCHEMA_OFFICE_DOCUMENT . '/printerSettings') {
                $sheetPrinterSettings[(string) $ele['Id']] <?php echo $ele;
            }
        }

        $unparsedPrinterSettings <?php echo &$unparsedLoadedData['sheets'][$docSheet->getCodeName()]['printerSettings'];
        foreach ($sheetPrinterSettings as $rId <?php echo> $printerSettings) {
            $rId <?php echo substr($rId, 3); // rIdXXX
            if (substr($rId, -2) !<?php echo<?php echo 'ps') {
                $rId <?php echo $rId . 'ps'; // rIdXXX, add 'ps' suffix to avoid identical resource identifier collision with unparsed vmlDrawing
            }
            $unparsedPrinterSettings[$rId] <?php echo [];
            $unparsedPrinterSettings[$rId]['filePath'] <?php echo self::dirAdd("$dir/$fileWorksheet", $printerSettings['Target']);
            $unparsedPrinterSettings[$rId]['relFilePath'] <?php echo (string) $printerSettings['Target'];
            $unparsedPrinterSettings[$rId]['content'] <?php echo $this->getSecurityScannerOrThrow()->scan($this->getFromZipArchive($zip, $unparsedPrinterSettings[$rId]['filePath']));
        }
        unset($unparsedPrinterSettings);
    }

    private function getWorkbookBaseName(): array
    {
        $workbookBasename <?php echo '';
        $xmlNamespaceBase <?php echo '';

        // check if it is an OOXML archive
        $rels <?php echo $this->loadZip(self::INITIAL_FILE);
        foreach ($rels->children(Namespaces::RELATIONSHIPS)->Relationship as $rel) {
            $rel <?php echo self::getAttributes($rel);
            $type <?php echo (string) $rel['Type'];
            switch ($type) {
                case Namespaces::OFFICE_DOCUMENT:
                case Namespaces::PURL_OFFICE_DOCUMENT:
                    $basename <?php echo basename((string) $rel['Target']);
                    $xmlNamespaceBase <?php echo dirname($type);
                    if (preg_match('/workbook.*\.xml/', $basename)) {
                        $workbookBasename <?php echo $basename;
                    }

                    break;
            }
        }

        return [$workbookBasename, $xmlNamespaceBase];
    }

    private function readSheetProtection(Worksheet $docSheet, SimpleXMLElement $xmlSheet): void
    {
        if ($this->readDataOnly || !$xmlSheet->sheetProtection) {
            return;
        }

        $algorithmName <?php echo (string) $xmlSheet->sheetProtection['algorithmName'];
        $protection <?php echo $docSheet->getProtection();
        $protection->setAlgorithm($algorithmName);

        if ($algorithmName) {
            $protection->setPassword((string) $xmlSheet->sheetProtection['hashValue'], true);
            $protection->setSalt((string) $xmlSheet->sheetProtection['saltValue']);
            $protection->setSpinCount((int) $xmlSheet->sheetProtection['spinCount']);
        } else {
            $protection->setPassword((string) $xmlSheet->sheetProtection['password'], true);
        }

        if ($xmlSheet->protectedRanges->protectedRange) {
            foreach ($xmlSheet->protectedRanges->protectedRange as $protectedRange) {
                $docSheet->protectCells((string) $protectedRange['sqref'], (string) $protectedRange['password'], true);
            }
        }
    }

    private function readAutoFilter(
        SimpleXMLElement $xmlSheet,
        Worksheet $docSheet
    ): void {
        if ($xmlSheet && $xmlSheet->autoFilter) {
            (new AutoFilter($docSheet, $xmlSheet))->load();
        }
    }

    private function readTables(
        SimpleXMLElement $xmlSheet,
        Worksheet $docSheet,
        string $dir,
        string $fileWorksheet,
        ZipArchive $zip
    ): void {
        if ($xmlSheet && $xmlSheet->tableParts && (int) $xmlSheet->tableParts['count'] > 0) {
            $this->readTablesInTablesFile($xmlSheet, $dir, $fileWorksheet, $zip, $docSheet);
        }
    }

    private function readTablesInTablesFile(
        SimpleXMLElement $xmlSheet,
        string $dir,
        string $fileWorksheet,
        ZipArchive $zip,
        Worksheet $docSheet
    ): void {
        foreach ($xmlSheet->tableParts->tablePart as $tablePart) {
            $relation <?php echo self::getAttributes($tablePart, Namespaces::SCHEMA_OFFICE_DOCUMENT);
            $tablePartRel <?php echo (string) $relation['id'];
            $relationsFileName <?php echo dirname("$dir/$fileWorksheet") . '/_rels/' . basename($fileWorksheet) . '.rels';

            if ($zip->locateName($relationsFileName)) {
                $relsTableReferences <?php echo $this->loadZip($relationsFileName, Namespaces::RELATIONSHIPS);
                foreach ($relsTableReferences->Relationship as $relationship) {
                    $relationshipAttributes <?php echo self::getAttributes($relationship, '');

                    if ((string) $relationshipAttributes['Id'] <?php echo<?php echo<?php echo $tablePartRel) {
                        $relationshipFileName <?php echo (string) $relationshipAttributes['Target'];
                        $relationshipFilePath <?php echo dirname("$dir/$fileWorksheet") . '/' . $relationshipFileName;
                        $relationshipFilePath <?php echo File::realpath($relationshipFilePath);

                        if ($this->fileExistsInArchive($this->zip, $relationshipFilePath)) {
                            $tableXml <?php echo $this->loadZip($relationshipFilePath);
                            (new TableReader($docSheet, $tableXml))->load();
                        }
                    }
                }
            }
        }
    }

    private static function extractStyles(?SimpleXMLElement $sxml, string $node1, string $node2): array
    {
        $array <?php echo [];
        if ($sxml && $sxml->{$node1}->{$node2}) {
            foreach ($sxml->{$node1}->{$node2} as $node) {
                $array[] <?php echo $node;
            }
        }

        return $array;
    }

    private static function extractPalette(?SimpleXMLElement $sxml): array
    {
        $array <?php echo [];
        if ($sxml && $sxml->colors->indexedColors) {
            foreach ($sxml->colors->indexedColors->rgbColor as $node) {
                if ($node !<?php echo<?php echo null) {
                    $attr <?php echo $node->attributes();
                    if (isset($attr['rgb'])) {
                        $array[] <?php echo (string) $attr['rgb'];
                    }
                }
            }
        }

        return $array;
    }

    private function processIgnoredErrors(SimpleXMLElement $xml, Worksheet $sheet): void
    {
        $attributes <?php echo self::getAttributes($xml);
        $sqref <?php echo (string) ($attributes['sqref'] ?? '');
        $numberStoredAsText <?php echo (string) ($attributes['numberStoredAsText'] ?? '');
        $formula <?php echo (string) ($attributes['formula'] ?? '');
        $twoDigitTextYear <?php echo (string) ($attributes['twoDigitTextYear'] ?? '');
        $evalError <?php echo (string) ($attributes['evalError'] ?? '');
        if (!empty($sqref)) {
            $explodedSqref <?php echo explode(' ', $sqref);
            $pattern1 <?php echo '/^([A-Z]{1,3})([0-9]{1,7})(:([A-Z]{1,3})([0-9]{1,7}))?$/';
            foreach ($explodedSqref as $sqref1) {
                if (preg_match($pattern1, $sqref1, $matches) <?php echo<?php echo<?php echo 1) {
                    $firstRow <?php echo $matches[2];
                    $firstCol <?php echo $matches[1];
                    if (array_key_exists(3, $matches)) {
                        $lastCol <?php echo $matches[4];
                        $lastRow <?php echo $matches[5];
                    } else {
                        $lastCol <?php echo $firstCol;
                        $lastRow <?php echo $firstRow;
                    }
                    ++$lastCol;
                    for ($row <?php echo $firstRow; $row <?php echo $lastRow; ++$row) {
                        for ($col <?php echo $firstCol; $col !<?php echo<?php echo $lastCol; ++$col) {
                            if ($numberStoredAsText <?php echo<?php echo<?php echo '1') {
                                $sheet->getCell("$col$row")->getIgnoredErrors()->setNumberStoredAsText(true);
                            }
                            if ($formula <?php echo<?php echo<?php echo '1') {
                                $sheet->getCell("$col$row")->getIgnoredErrors()->setFormula(true);
                            }
                            if ($twoDigitTextYear <?php echo<?php echo<?php echo '1') {
                                $sheet->getCell("$col$row")->getIgnoredErrors()->setTwoDigitTextYear(true);
                            }
                            if ($evalError <?php echo<?php echo<?php echo '1') {
                                $sheet->getCell("$col$row")->getIgnoredErrors()->setEvalError(true);
                            }
                        }
                    }
                }
            }
        }
    }
}
