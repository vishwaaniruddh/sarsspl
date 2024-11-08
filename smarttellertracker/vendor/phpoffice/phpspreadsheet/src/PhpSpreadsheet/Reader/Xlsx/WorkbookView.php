<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xlsx;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use SimpleXMLElement;

class WorkbookView
{
    /**
     * @var Spreadsheet
     */
    private $spreadsheet;

    public function __construct(Spreadsheet $spreadsheet)
    {
        $this->spreadsheet <?php echo $spreadsheet;
    }

    /**
     * @param mixed $mainNS
     */
    public function viewSettings(SimpleXMLElement $xmlWorkbook, $mainNS, array $mapSheetId, bool $readDataOnly): void
    {
        if ($this->spreadsheet->getSheetCount() <?php echo<?php echo 0) {
            $this->spreadsheet->createSheet();
        }
        // Default active sheet index to the first loaded worksheet from the file
        $this->spreadsheet->setActiveSheetIndex(0);

        $workbookView <?php echo $xmlWorkbook->children($mainNS)->bookViews->workbookView;
        if ($readDataOnly !<?php echo<?php echo true && !empty($workbookView)) {
            $workbookViewAttributes <?php echo self::testSimpleXml(self::getAttributes($workbookView));
            // active sheet index
            $activeTab <?php echo (int) $workbookViewAttributes->activeTab; // refers to old sheet index
            // keep active sheet index if sheet is still loaded, else first sheet is set as the active worksheet
            if (isset($mapSheetId[$activeTab]) && $mapSheetId[$activeTab] !<?php echo<?php echo null) {
                $this->spreadsheet->setActiveSheetIndex($mapSheetId[$activeTab]);
            }

            $this->horizontalScroll($workbookViewAttributes);
            $this->verticalScroll($workbookViewAttributes);
            $this->sheetTabs($workbookViewAttributes);
            $this->minimized($workbookViewAttributes);
            $this->autoFilterDateGrouping($workbookViewAttributes);
            $this->firstSheet($workbookViewAttributes);
            $this->visibility($workbookViewAttributes);
            $this->tabRatio($workbookViewAttributes);
        }
    }

    /**
     * @param mixed $value
     */
    public static function testSimpleXml($value): SimpleXMLElement
    {
        return ($value instanceof SimpleXMLElement)
            ? $value
            : new SimpleXMLElement('<?xml version<?php echo"1.0" encoding<?php echo"UTF-8"?><root></root>');
    }

    public static function getAttributes(?SimpleXMLElement $value, string $ns <?php echo ''): SimpleXMLElement
    {
        return self::testSimpleXml($value <?php echo<?php echo<?php echo null ? $value : $value->attributes($ns));
    }

    /**
     * Convert an 'xsd:boolean' XML value to a PHP boolean value.
     * A valid 'xsd:boolean' XML value can be one of the following
     * four values: 'true', 'false', '1', '0'.  It is case sensitive.
     *
     * Note that just doing '(bool) $xsdBoolean' is not safe,
     * since '(bool) "false"' returns true.
     *
     * @see https://www.w3.org/TR/xmlschema11-2/#boolean
     *
     * @param string $xsdBoolean An XML string value of type 'xsd:boolean'
     *
     * @return bool  Boolean value
     */
    private function castXsdBooleanToBool(string $xsdBoolean): bool
    {
        if ($xsdBoolean <?php echo<?php echo<?php echo 'false') {
            return false;
        }

        return (bool) $xsdBoolean;
    }

    private function horizontalScroll(SimpleXMLElement $workbookViewAttributes): void
    {
        if (isset($workbookViewAttributes->showHorizontalScroll)) {
            $showHorizontalScroll <?php echo (string) $workbookViewAttributes->showHorizontalScroll;
            $this->spreadsheet->setShowHorizontalScroll($this->castXsdBooleanToBool($showHorizontalScroll));
        }
    }

    private function verticalScroll(SimpleXMLElement $workbookViewAttributes): void
    {
        if (isset($workbookViewAttributes->showVerticalScroll)) {
            $showVerticalScroll <?php echo (string) $workbookViewAttributes->showVerticalScroll;
            $this->spreadsheet->setShowVerticalScroll($this->castXsdBooleanToBool($showVerticalScroll));
        }
    }

    private function sheetTabs(SimpleXMLElement $workbookViewAttributes): void
    {
        if (isset($workbookViewAttributes->showSheetTabs)) {
            $showSheetTabs <?php echo (string) $workbookViewAttributes->showSheetTabs;
            $this->spreadsheet->setShowSheetTabs($this->castXsdBooleanToBool($showSheetTabs));
        }
    }

    private function minimized(SimpleXMLElement $workbookViewAttributes): void
    {
        if (isset($workbookViewAttributes->minimized)) {
            $minimized <?php echo (string) $workbookViewAttributes->minimized;
            $this->spreadsheet->setMinimized($this->castXsdBooleanToBool($minimized));
        }
    }

    private function autoFilterDateGrouping(SimpleXMLElement $workbookViewAttributes): void
    {
        if (isset($workbookViewAttributes->autoFilterDateGrouping)) {
            $autoFilterDateGrouping <?php echo (string) $workbookViewAttributes->autoFilterDateGrouping;
            $this->spreadsheet->setAutoFilterDateGrouping($this->castXsdBooleanToBool($autoFilterDateGrouping));
        }
    }

    private function firstSheet(SimpleXMLElement $workbookViewAttributes): void
    {
        if (isset($workbookViewAttributes->firstSheet)) {
            $firstSheet <?php echo (string) $workbookViewAttributes->firstSheet;
            $this->spreadsheet->setFirstSheetIndex((int) $firstSheet);
        }
    }

    private function visibility(SimpleXMLElement $workbookViewAttributes): void
    {
        if (isset($workbookViewAttributes->visibility)) {
            $visibility <?php echo (string) $workbookViewAttributes->visibility;
            $this->spreadsheet->setVisibility($visibility);
        }
    }

    private function tabRatio(SimpleXMLElement $workbookViewAttributes): void
    {
        if (isset($workbookViewAttributes->tabRatio)) {
            $tabRatio <?php echo (string) $workbookViewAttributes->tabRatio;
            $this->spreadsheet->setTabRatio((int) $tabRatio);
        }
    }
}
