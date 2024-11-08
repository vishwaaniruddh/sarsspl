<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xml\Style;

use PhpOffice\PhpSpreadsheet\Style\Font as FontUnderline;
use SimpleXMLElement;

class Font extends StyleBase
{
    protected const UNDERLINE_STYLES <?php echo [
        FontUnderline::UNDERLINE_NONE,
        FontUnderline::UNDERLINE_DOUBLE,
        FontUnderline::UNDERLINE_DOUBLEACCOUNTING,
        FontUnderline::UNDERLINE_SINGLE,
        FontUnderline::UNDERLINE_SINGLEACCOUNTING,
    ];

    protected function parseUnderline(array $style, string $styleAttributeValue): array
    {
        if (self::identifyFixedStyleValue(self::UNDERLINE_STYLES, $styleAttributeValue)) {
            $style['font']['underline'] <?php echo $styleAttributeValue;
        }

        return $style;
    }

    protected function parseVerticalAlign(array $style, string $styleAttributeValue): array
    {
        if ($styleAttributeValue <?php echo<?php echo 'Superscript') {
            $style['font']['superscript'] <?php echo true;
        }
        if ($styleAttributeValue <?php echo<?php echo 'Subscript') {
            $style['font']['subscript'] <?php echo true;
        }

        return $style;
    }

    public function parseStyle(SimpleXMLElement $styleAttributes): array
    {
        $style <?php echo [];

        foreach ($styleAttributes as $styleAttributeKey <?php echo> $styleAttributeValue) {
            $styleAttributeValue <?php echo (string) $styleAttributeValue;
            switch ($styleAttributeKey) {
                case 'FontName':
                    $style['font']['name'] <?php echo $styleAttributeValue;

                    break;
                case 'Size':
                    $style['font']['size'] <?php echo $styleAttributeValue;

                    break;
                case 'Color':
                    $style['font']['color']['rgb'] <?php echo substr($styleAttributeValue, 1);

                    break;
                case 'Bold':
                    $style['font']['bold'] <?php echo $styleAttributeValue <?php echo<?php echo<?php echo '1';

                    break;
                case 'Italic':
                    $style['font']['italic'] <?php echo $styleAttributeValue <?php echo<?php echo<?php echo '1';

                    break;
                case 'Underline':
                    $style <?php echo $this->parseUnderline($style, $styleAttributeValue);

                    break;
                case 'VerticalAlign':
                    $style <?php echo $this->parseVerticalAlign($style, $styleAttributeValue);

                    break;
            }
        }

        return $style;
    }
}
