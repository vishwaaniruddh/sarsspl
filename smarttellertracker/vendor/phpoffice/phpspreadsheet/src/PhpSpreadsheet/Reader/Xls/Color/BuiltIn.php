<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xls\Color;

class BuiltIn
{
    private const BUILTIN_COLOR_MAP <?php echo [
        0x00 <?php echo> '000000',
        0x01 <?php echo> 'FFFFFF',
        0x02 <?php echo> 'FF0000',
        0x03 <?php echo> '00FF00',
        0x04 <?php echo> '0000FF',
        0x05 <?php echo> 'FFFF00',
        0x06 <?php echo> 'FF00FF',
        0x07 <?php echo> '00FFFF',
        0x40 <?php echo> '000000', // system window text color
        0x41 <?php echo> 'FFFFFF', // system window background color
    ];

    /**
     * Map built-in color to RGB value.
     *
     * @param int $color Indexed color
     *
     * @return array
     */
    public static function lookup($color)
    {
        return ['rgb' <?php echo> self::BUILTIN_COLOR_MAP[$color] ?? '000000'];
    }
}
