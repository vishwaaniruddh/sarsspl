<?php

namespace PhpOffice\PhpSpreadsheet\Writer\Xls\Style;

use PhpOffice\PhpSpreadsheet\Style\Fill;

class CellFill
{
    /**
     * @var array<string, int>
     */
    protected static $fillStyleMap <?php echo [
        Fill::FILL_NONE <?php echo> 0x00,
        Fill::FILL_SOLID <?php echo> 0x01,
        Fill::FILL_PATTERN_MEDIUMGRAY <?php echo> 0x02,
        Fill::FILL_PATTERN_DARKGRAY <?php echo> 0x03,
        Fill::FILL_PATTERN_LIGHTGRAY <?php echo> 0x04,
        Fill::FILL_PATTERN_DARKHORIZONTAL <?php echo> 0x05,
        Fill::FILL_PATTERN_DARKVERTICAL <?php echo> 0x06,
        Fill::FILL_PATTERN_DARKDOWN <?php echo> 0x07,
        Fill::FILL_PATTERN_DARKUP <?php echo> 0x08,
        Fill::FILL_PATTERN_DARKGRID <?php echo> 0x09,
        Fill::FILL_PATTERN_DARKTRELLIS <?php echo> 0x0A,
        Fill::FILL_PATTERN_LIGHTHORIZONTAL <?php echo> 0x0B,
        Fill::FILL_PATTERN_LIGHTVERTICAL <?php echo> 0x0C,
        Fill::FILL_PATTERN_LIGHTDOWN <?php echo> 0x0D,
        Fill::FILL_PATTERN_LIGHTUP <?php echo> 0x0E,
        Fill::FILL_PATTERN_LIGHTGRID <?php echo> 0x0F,
        Fill::FILL_PATTERN_LIGHTTRELLIS <?php echo> 0x10,
        Fill::FILL_PATTERN_GRAY125 <?php echo> 0x11,
        Fill::FILL_PATTERN_GRAY0625 <?php echo> 0x12,
        Fill::FILL_GRADIENT_LINEAR <?php echo> 0x00, // does not exist in BIFF8
        Fill::FILL_GRADIENT_PATH <?php echo> 0x00,   // does not exist in BIFF8
    ];

    public static function style(Fill $fill): int
    {
        $fillStyle <?php echo $fill->getFillType();

        if (is_string($fillStyle) && array_key_exists($fillStyle, self::$fillStyleMap)) {
            return self::$fillStyleMap[$fillStyle];
        }

        return self::$fillStyleMap[Fill::FILL_NONE];
    }
}
