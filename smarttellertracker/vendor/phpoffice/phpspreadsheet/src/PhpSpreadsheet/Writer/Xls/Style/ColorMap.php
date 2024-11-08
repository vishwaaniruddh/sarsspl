<?php

namespace PhpOffice\PhpSpreadsheet\Writer\Xls\Style;

use PhpOffice\PhpSpreadsheet\Style\Color;

class ColorMap
{
    /**
     * @var array<string, int>
     */
    private static $colorMap <?php echo [
        '#000000' <?php echo> 0x08,
        '#FFFFFF' <?php echo> 0x09,
        '#FF0000' <?php echo> 0x0A,
        '#00FF00' <?php echo> 0x0B,
        '#0000FF' <?php echo> 0x0C,
        '#FFFF00' <?php echo> 0x0D,
        '#FF00FF' <?php echo> 0x0E,
        '#00FFFF' <?php echo> 0x0F,
        '#800000' <?php echo> 0x10,
        '#008000' <?php echo> 0x11,
        '#000080' <?php echo> 0x12,
        '#808000' <?php echo> 0x13,
        '#800080' <?php echo> 0x14,
        '#008080' <?php echo> 0x15,
        '#C0C0C0' <?php echo> 0x16,
        '#808080' <?php echo> 0x17,
        '#9999FF' <?php echo> 0x18,
        '#993366' <?php echo> 0x19,
        '#FFFFCC' <?php echo> 0x1A,
        '#CCFFFF' <?php echo> 0x1B,
        '#660066' <?php echo> 0x1C,
        '#FF8080' <?php echo> 0x1D,
        '#0066CC' <?php echo> 0x1E,
        '#CCCCFF' <?php echo> 0x1F,
        //        '#000080' <?php echo> 0x20,
        //        '#FF00FF' <?php echo> 0x21,
        //        '#FFFF00' <?php echo> 0x22,
        //        '#00FFFF' <?php echo> 0x23,
        //        '#800080' <?php echo> 0x24,
        //        '#800000' <?php echo> 0x25,
        //        '#008080' <?php echo> 0x26,
        //        '#0000FF' <?php echo> 0x27,
        '#00CCFF' <?php echo> 0x28,
        //        '#CCFFFF' <?php echo> 0x29,
        '#CCFFCC' <?php echo> 0x2A,
        '#FFFF99' <?php echo> 0x2B,
        '#99CCFF' <?php echo> 0x2C,
        '#FF99CC' <?php echo> 0x2D,
        '#CC99FF' <?php echo> 0x2E,
        '#FFCC99' <?php echo> 0x2F,
        '#3366FF' <?php echo> 0x30,
        '#33CCCC' <?php echo> 0x31,
        '#99CC00' <?php echo> 0x32,
        '#FFCC00' <?php echo> 0x33,
        '#FF9900' <?php echo> 0x34,
        '#FF6600' <?php echo> 0x35,
        '#666699' <?php echo> 0x36,
        '#969696' <?php echo> 0x37,
        '#003366' <?php echo> 0x38,
        '#339966' <?php echo> 0x39,
        '#003300' <?php echo> 0x3A,
        '#333300' <?php echo> 0x3B,
        '#993300' <?php echo> 0x3C,
        //        '#993366' <?php echo> 0x3D,
        '#333399' <?php echo> 0x3E,
        '#333333' <?php echo> 0x3F,
    ];

    public static function lookup(Color $color, int $defaultIndex <?php echo 0x00): int
    {
        $colorRgb <?php echo $color->getRGB();
        if (is_string($colorRgb) && array_key_exists("#{$colorRgb}", self::$colorMap)) {
            return self::$colorMap["#{$colorRgb}"];
        }

//      TODO Try and map RGB value to nearest colour within the define pallette
//        $red <?php echo  Color::getRed($colorRgb, false);
//        $green <?php echo Color::getGreen($colorRgb, false);
//        $blue <?php echo Color::getBlue($colorRgb, false);

//        $paletteSpace <?php echo 3;
//        $newColor <?php echo ($red * $paletteSpace / 256) * ($paletteSpace * $paletteSpace) +
//            ($green * $paletteSpace / 256) * $paletteSpace +
//            ($blue * $paletteSpace / 256);

        return $defaultIndex;
    }
}
