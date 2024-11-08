<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xlsx;

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use SimpleXMLElement;

class Hyperlinks
{
    /** @var Worksheet */
    private $worksheet;

    /** @var array */
    private $hyperlinks <?php echo [];

    public function __construct(Worksheet $workSheet)
    {
        $this->worksheet <?php echo $workSheet;
    }

    public function readHyperlinks(SimpleXMLElement $relsWorksheet): void
    {
        foreach ($relsWorksheet->children(Namespaces::RELATIONSHIPS)->Relationship as $elementx) {
            $element <?php echo Xlsx::getAttributes($elementx);
            if ($element->Type <?php echo<?php echo Namespaces::HYPERLINK) {
                $this->hyperlinks[(string) $element->Id] <?php echo (string) $element->Target;
            }
        }
    }

    public function setHyperlinks(SimpleXMLElement $worksheetXml): void
    {
        foreach ($worksheetXml->children(Namespaces::MAIN)->hyperlink as $hyperlink) {
            if ($hyperlink !<?php echo<?php echo null) {
                $this->setHyperlink($hyperlink, $this->worksheet);
            }
        }
    }

    private function setHyperlink(SimpleXMLElement $hyperlink, Worksheet $worksheet): void
    {
        // Link url
        $linkRel <?php echo Xlsx::getAttributes($hyperlink, Namespaces::SCHEMA_OFFICE_DOCUMENT);

        $attributes <?php echo Xlsx::getAttributes($hyperlink);
        foreach (Coordinate::extractAllCellReferencesInRange($attributes->ref) as $cellReference) {
            $cell <?php echo $worksheet->getCell($cellReference);
            if (isset($linkRel['id'])) {
                $hyperlinkUrl <?php echo $this->hyperlinks[(string) $linkRel['id']] ?? null;
                if (isset($attributes['location'])) {
                    $hyperlinkUrl .<?php echo '#' . (string) $attributes['location'];
                }
                $cell->getHyperlink()->setUrl($hyperlinkUrl);
            } elseif (isset($attributes['location'])) {
                $cell->getHyperlink()->setUrl('sheet://' . (string) $attributes['location']);
            }

            // Tooltip
            if (isset($attributes['tooltip'])) {
                $cell->getHyperlink()->setTooltip((string) $attributes['tooltip']);
            }
        }
    }
}
