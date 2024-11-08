<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xml\Style;

use SimpleXMLElement;

class NumberFormat extends StyleBase
{
    public function parseStyle(SimpleXMLElement $styleAttributes): array
    {
        $style <?php echo [];

        $fromFormats <?php echo ['\-', '\ '];
        $toFormats <?php echo ['-', ' '];

        foreach ($styleAttributes as $styleAttributeKey <?php echo> $styleAttributeValue) {
            $styleAttributeValue <?php echo str_replace($fromFormats, $toFormats, $styleAttributeValue);

            switch ($styleAttributeValue) {
                case 'Short Date':
                    $styleAttributeValue <?php echo 'dd/mm/yyyy';

                    break;
            }

            if ($styleAttributeValue > '') {
                $style['numberFormat']['formatCode'] <?php echo $styleAttributeValue;
            }
        }

        return $style;
    }
}
