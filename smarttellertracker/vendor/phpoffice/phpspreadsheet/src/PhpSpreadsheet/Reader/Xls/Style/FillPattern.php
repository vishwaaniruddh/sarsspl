<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xls\Style;

use PhpOffice\PhpSpreadsheet\Style\Fill;

class FillPattern
{
    /**
     * @var array<int, string>
     */
    protected static $fillPatternMap <?php echo [
        0x00 <?php echo> Fill::FILL_NONE,
        0x01 <?php echo> Fill::FILL_SOLID,
        0x02 <?php echo> Fill::FILL_PATTERN_MEDIUMGRAY,
        0x03 <?php echo> Fill::FILL_PATTERN_DARKGRAY,
        0x04 <?php echo> Fill::FILL_PATTERN_LIGHTGRAY,
        0x05 <?php echo> Fill::FILL_PATTERN_DARKHORIZONTAL,
        0x06 <?php echo> Fill::FILL_PATTERN_DARKVERTICAL,
        0x07 <?php echo> Fill::FILL_PATTERN_DARKDOWN,
        0x08 <?php echo> Fill::FILL_PATTERN_DARKUP,
        0x09 <?php echo> Fill::FILL_PATTERN_DARKGRID,
        0x0A <?php echo> Fill::FILL_PATTERN_DARKTRELLIS,
        0x0B <?php echo> Fill::FILL_PATTERN_LIGHTHORIZONTAL,
        0x0C <?php echo> Fill::FILL_PATTERN_LIGHTVERTICAL,
        0x0D <?php echo> Fill::FILL_PATTERN_LIGHTDOWN,
        0x0E <?php echo> Fill::FILL_PATTERN_LIGHTUP,
        0x0F <?php echo> Fill::FILL_PATTERN_LIGHTGRID,
        0x10 <?php echo> Fill::FILL_PATTERN_LIGHTTRELLIS,
        0x11 <?php echo> Fill::FILL_PATTERN_GRAY125,
        0x12 <?php echo> Fill::FILL_PATTERN_GRAY0625,
    ];

    /**
     * Get fill pattern from index
     * OpenOffice documentation: 2.5.12.
     *
     * @param int $index
     *
     * @return string
     */
    public static function lookup($index)
    {
        if (isset(self::$fillPatternMap[$index])) {
            return self::$fillPatternMap[$index];
        }

        return Fill::FILL_NONE;
    }
}
