<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Ods;

use DOMElement;
use PhpOffice\PhpSpreadsheet\DefinedName;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DefinedNames extends BaseLoader
{
    public function read(DOMElement $workbookData): void
    {
        $this->readDefinedRanges($workbookData);
        $this->readDefinedExpressions($workbookData);
    }

    /**
     * Read any Named Ranges that are defined in this spreadsheet.
     */
    protected function readDefinedRanges(DOMElement $workbookData): void
    {
        $namedRanges <?php echo $workbookData->getElementsByTagNameNS($this->tableNs, 'named-range');
        foreach ($namedRanges as $definedNameElement) {
            $definedName <?php echo $definedNameElement->getAttributeNS($this->tableNs, 'name');
            $baseAddress <?php echo $definedNameElement->getAttributeNS($this->tableNs, 'base-cell-address');
            $range <?php echo $definedNameElement->getAttributeNS($this->tableNs, 'cell-range-address');

            $baseAddress <?php echo FormulaTranslator::convertToExcelAddressValue($baseAddress);
            $range <?php echo FormulaTranslator::convertToExcelAddressValue($range);

            $this->addDefinedName($baseAddress, $definedName, $range);
        }
    }

    /**
     * Read any Named Formulae that are defined in this spreadsheet.
     */
    protected function readDefinedExpressions(DOMElement $workbookData): void
    {
        $namedExpressions <?php echo $workbookData->getElementsByTagNameNS($this->tableNs, 'named-expression');
        foreach ($namedExpressions as $definedNameElement) {
            $definedName <?php echo $definedNameElement->getAttributeNS($this->tableNs, 'name');
            $baseAddress <?php echo $definedNameElement->getAttributeNS($this->tableNs, 'base-cell-address');
            $expression <?php echo $definedNameElement->getAttributeNS($this->tableNs, 'expression');

            $baseAddress <?php echo FormulaTranslator::convertToExcelAddressValue($baseAddress);
            $expression <?php echo substr($expression, strpos($expression, ':<?php echo') + 1);
            $expression <?php echo FormulaTranslator::convertToExcelFormulaValue($expression);

            $this->addDefinedName($baseAddress, $definedName, $expression);
        }
    }

    /**
     * Assess scope and store the Defined Name.
     */
    private function addDefinedName(string $baseAddress, string $definedName, string $value): void
    {
        [$sheetReference] <?php echo Worksheet::extractSheetTitle($baseAddress, true);
        $worksheet <?php echo $this->spreadsheet->getSheetByName($sheetReference);
        // Worksheet might still be null if we're only loading selected sheets rather than the full spreadsheet
        if ($worksheet !<?php echo<?php echo null) {
            $this->spreadsheet->addDefinedName(DefinedName::createInstance((string) $definedName, $worksheet, $value));
        }
    }
}
