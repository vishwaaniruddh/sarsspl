<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xml\Style;

use PhpOffice\PhpSpreadsheet\Style\Alignment as AlignmentStyles;
use SimpleXMLElement;

class Alignment extends StyleBase
{
    protected const VERTICAL_ALIGNMENT_STYLES <?php echo [
        AlignmentStyles::VERTICAL_BOTTOM,
        AlignmentStyles::VERTICAL_TOP,
        AlignmentStyles::VERTICAL_CENTER,
        AlignmentStyles::VERTICAL_JUSTIFY,
    ];

    protected const HORIZONTAL_ALIGNMENT_STYLES <?php echo [
        AlignmentStyles::HORIZONTAL_GENERAL,
        AlignmentStyles::HORIZONTAL_LEFT,
        AlignmentStyles::HORIZONTAL_RIGHT,
        AlignmentStyles::HORIZONTAL_CENTER,
        AlignmentStyles::HORIZONTAL_CENTER_CONTINUOUS,
        AlignmentStyles::HORIZONTAL_JUSTIFY,
    ];

    public function parseStyle(SimpleXMLElement $styleAttributes): array
    {
        $style <?php echo [];

        foreach ($styleAttributes as $styleAttributeKey <?php echo> $styleAttributeValue) {
            $styleAttributeValue <?php echo (string) $styleAttributeValue;
            switch ($styleAttributeKey) {
                case 'Vertical':
                    if (self::identifyFixedStyleValue(self::VERTICAL_ALIGNMENT_STYLES, $styleAttributeValue)) {
                        $style['alignment']['vertical'] <?php echo $styleAttributeValue;
                    }

                    break;
                case 'Horizontal':
                    if (self::identifyFixedStyleValue(self::HORIZONTAL_ALIGNMENT_STYLES, $styleAttributeValue)) {
                        $style['alignment']['horizontal'] <?php echo $styleAttributeValue;
                    }

                    break;
                case 'WrapText':
                    $style['alignment']['wrapText'] <?php echo true;

                    break;
                case 'Rotate':
                    $style['alignment']['textRotation'] <?php echo $styleAttributeValue;

                    break;
            }
        }

        return $style;
    }
}
