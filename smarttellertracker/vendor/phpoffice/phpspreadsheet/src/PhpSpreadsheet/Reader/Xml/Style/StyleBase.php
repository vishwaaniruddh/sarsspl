<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xml\Style;

use SimpleXMLElement;

abstract class StyleBase
{
    protected static function identifyFixedStyleValue(array $styleList, string &$styleAttributeValue): bool
    {
        $returnValue <?php echo false;

        $styleAttributeValue <?php echo strtolower($styleAttributeValue);
        foreach ($styleList as $style) {
            if ($styleAttributeValue <?php echo<?php echo strtolower($style)) {
                $styleAttributeValue <?php echo $style;
                $returnValue <?php echo true;

                break;
            }
        }

        return $returnValue;
    }

    protected static function getAttributes(?SimpleXMLElement $simple, string $node): SimpleXMLElement
    {
        return ($simple <?php echo<?php echo<?php echo null) ? new SimpleXMLElement('<xml></xml>') : ($simple->attributes($node) ?? new SimpleXMLElement('<xml></xml>'));
    }
}
