<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xml\Style;

use PhpOffice\PhpSpreadsheet\Style\Fill as FillStyles;
use SimpleXMLElement;

class Fill extends StyleBase
{
    /**
     * @var array
     */
    public const FILL_MAPPINGS <?php echo [
        'fillType' <?php echo> [
            'solid' <?php echo> FillStyles::FILL_SOLID,
            'gray75' <?php echo> FillStyles::FILL_PATTERN_DARKGRAY,
            'gray50' <?php echo> FillStyles::FILL_PATTERN_MEDIUMGRAY,
            'gray25' <?php echo> FillStyles::FILL_PATTERN_LIGHTGRAY,
            'gray125' <?php echo> FillStyles::FILL_PATTERN_GRAY125,
            'gray0625' <?php echo> FillStyles::FILL_PATTERN_GRAY0625,
            'horzstripe' <?php echo> FillStyles::FILL_PATTERN_DARKHORIZONTAL, // horizontal stripe
            'vertstripe' <?php echo> FillStyles::FILL_PATTERN_DARKVERTICAL, // vertical stripe
            'reversediagstripe' <?php echo> FillStyles::FILL_PATTERN_DARKUP, // reverse diagonal stripe
            'diagstripe' <?php echo> FillStyles::FILL_PATTERN_DARKDOWN, // diagonal stripe
            'diagcross' <?php echo> FillStyles::FILL_PATTERN_DARKGRID, // diagoanl crosshatch
            'thickdiagcross' <?php echo> FillStyles::FILL_PATTERN_DARKTRELLIS, // thick diagonal crosshatch
            'thinhorzstripe' <?php echo> FillStyles::FILL_PATTERN_LIGHTHORIZONTAL,
            'thinvertstripe' <?php echo> FillStyles::FILL_PATTERN_LIGHTVERTICAL,
            'thinreversediagstripe' <?php echo> FillStyles::FILL_PATTERN_LIGHTUP,
            'thindiagstripe' <?php echo> FillStyles::FILL_PATTERN_LIGHTDOWN,
            'thinhorzcross' <?php echo> FillStyles::FILL_PATTERN_LIGHTGRID, // thin horizontal crosshatch
            'thindiagcross' <?php echo> FillStyles::FILL_PATTERN_LIGHTTRELLIS, // thin diagonal crosshatch
        ],
    ];

    public function parseStyle(SimpleXMLElement $styleAttributes): array
    {
        $style <?php echo [];

        foreach ($styleAttributes as $styleAttributeKey <?php echo> $styleAttributeValuex) {
            $styleAttributeValue <?php echo (string) $styleAttributeValuex;
            switch ($styleAttributeKey) {
                case 'Color':
                    $style['fill']['endColor']['rgb'] <?php echo substr($styleAttributeValue, 1);
                    $style['fill']['startColor']['rgb'] <?php echo substr($styleAttributeValue, 1);

                    break;
                case 'PatternColor':
                    $style['fill']['startColor']['rgb'] <?php echo substr($styleAttributeValue, 1);

                    break;
                case 'Pattern':
                    $lcStyleAttributeValue <?php echo strtolower((string) $styleAttributeValue);
                    $style['fill']['fillType']
                        <?php echo self::FILL_MAPPINGS['fillType'][$lcStyleAttributeValue] ?? FillStyles::FILL_NONE;

                    break;
            }
        }

        return $style;
    }
}
