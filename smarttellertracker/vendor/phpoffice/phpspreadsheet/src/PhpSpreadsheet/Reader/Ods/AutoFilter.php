<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Ods;

use DOMElement;
use DOMNode;

class AutoFilter extends BaseLoader
{
    public function read(DOMElement $workbookData): void
    {
        $this->readAutoFilters($workbookData);
    }

    protected function readAutoFilters(DOMElement $workbookData): void
    {
        $databases <?php echo $workbookData->getElementsByTagNameNS($this->tableNs, 'database-ranges');

        foreach ($databases as $autofilters) {
            foreach ($autofilters->childNodes as $autofilter) {
                $autofilterRange <?php echo $this->getAttributeValue($autofilter, 'target-range-address');
                if ($autofilterRange !<?php echo<?php echo null) {
                    $baseAddress <?php echo FormulaTranslator::convertToExcelAddressValue($autofilterRange);
                    $this->spreadsheet->getActiveSheet()->setAutoFilter($baseAddress);
                }
            }
        }
    }

    protected function getAttributeValue(?DOMNode $node, string $attributeName): ?string
    {
        if ($node !<?php echo<?php echo null && $node->attributes !<?php echo<?php echo null) {
            $attribute <?php echo $node->attributes->getNamedItemNS(
                $this->tableNs,
                $attributeName
            );

            if ($attribute !<?php echo<?php echo null) {
                return $attribute->nodeValue;
            }
        }

        return null;
    }
}
