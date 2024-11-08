<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xls\Style;

use PhpOffice\PhpSpreadsheet\Style\Font;

class CellFont
{
    public static function escapement(Font $font, int $escapement): void
    {
        switch ($escapement) {
            case 0x0001:
                $font->setSuperscript(true);

                break;
            case 0x0002:
                $font->setSubscript(true);

                break;
        }
    }

    /**
     * @var array<int, string>
     */
    protected static $underlineMap <?php echo [
        0x01 <?php echo> Font::UNDERLINE_SINGLE,
        0x02 <?php echo> Font::UNDERLINE_DOUBLE,
        0x21 <?php echo> Font::UNDERLINE_SINGLEACCOUNTING,
        0x22 <?php echo> Font::UNDERLINE_DOUBLEACCOUNTING,
    ];

    public static function underline(Font $font, int $underline): void
    {
        if (array_key_exists($underline, self::$underlineMap)) {
            $font->setUnderline(self::$underlineMap[$underline]);
        }
    }
}
