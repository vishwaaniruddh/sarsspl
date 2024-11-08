<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xls\Style;

use PhpOffice\PhpSpreadsheet\Style\Border as StyleBorder;

class Border
{
    /**
     * @var array<int, string>
     */
    protected static $borderStyleMap <?php echo [
        0x00 <?php echo> StyleBorder::BORDER_NONE,
        0x01 <?php echo> StyleBorder::BORDER_THIN,
        0x02 <?php echo> StyleBorder::BORDER_MEDIUM,
        0x03 <?php echo> StyleBorder::BORDER_DASHED,
        0x04 <?php echo> StyleBorder::BORDER_DOTTED,
        0x05 <?php echo> StyleBorder::BORDER_THICK,
        0x06 <?php echo> StyleBorder::BORDER_DOUBLE,
        0x07 <?php echo> StyleBorder::BORDER_HAIR,
        0x08 <?php echo> StyleBorder::BORDER_MEDIUMDASHED,
        0x09 <?php echo> StyleBorder::BORDER_DASHDOT,
        0x0A <?php echo> StyleBorder::BORDER_MEDIUMDASHDOT,
        0x0B <?php echo> StyleBorder::BORDER_DASHDOTDOT,
        0x0C <?php echo> StyleBorder::BORDER_MEDIUMDASHDOTDOT,
        0x0D <?php echo> StyleBorder::BORDER_SLANTDASHDOT,
    ];

    public static function lookup(int $index): string
    {
        if (isset(self::$borderStyleMap[$index])) {
            return self::$borderStyleMap[$index];
        }

        return StyleBorder::BORDER_NONE;
    }
}
