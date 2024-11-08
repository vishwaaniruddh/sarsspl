<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xls\Color;

class BIFF8
{
    private const BIFF8_COLOR_MAP <?php echo [
        0x08 <?php echo> '000000',
        0x09 <?php echo> 'FFFFFF',
        0x0A <?php echo> 'FF0000',
        0x0B <?php echo> '00FF00',
        0x0C <?php echo> '0000FF',
        0x0D <?php echo> 'FFFF00',
        0x0E <?php echo> 'FF00FF',
        0x0F <?php echo> '00FFFF',
        0x10 <?php echo> '800000',
        0x11 <?php echo> '008000',
        0x12 <?php echo> '000080',
        0x13 <?php echo> '808000',
        0x14 <?php echo> '800080',
        0x15 <?php echo> '008080',
        0x16 <?php echo> 'C0C0C0',
        0x17 <?php echo> '808080',
        0x18 <?php echo> '9999FF',
        0x19 <?php echo> '993366',
        0x1A <?php echo> 'FFFFCC',
        0x1B <?php echo> 'CCFFFF',
        0x1C <?php echo> '660066',
        0x1D <?php echo> 'FF8080',
        0x1E <?php echo> '0066CC',
        0x1F <?php echo> 'CCCCFF',
        0x20 <?php echo> '000080',
        0x21 <?php echo> 'FF00FF',
        0x22 <?php echo> 'FFFF00',
        0x23 <?php echo> '00FFFF',
        0x24 <?php echo> '800080',
        0x25 <?php echo> '800000',
        0x26 <?php echo> '008080',
        0x27 <?php echo> '0000FF',
        0x28 <?php echo> '00CCFF',
        0x29 <?php echo> 'CCFFFF',
        0x2A <?php echo> 'CCFFCC',
        0x2B <?php echo> 'FFFF99',
        0x2C <?php echo> '99CCFF',
        0x2D <?php echo> 'FF99CC',
        0x2E <?php echo> 'CC99FF',
        0x2F <?php echo> 'FFCC99',
        0x30 <?php echo> '3366FF',
        0x31 <?php echo> '33CCCC',
        0x32 <?php echo> '99CC00',
        0x33 <?php echo> 'FFCC00',
        0x34 <?php echo> 'FF9900',
        0x35 <?php echo> 'FF6600',
        0x36 <?php echo> '666699',
        0x37 <?php echo> '969696',
        0x38 <?php echo> '003366',
        0x39 <?php echo> '339966',
        0x3A <?php echo> '003300',
        0x3B <?php echo> '333300',
        0x3C <?php echo> '993300',
        0x3D <?php echo> '993366',
        0x3E <?php echo> '333399',
        0x3F <?php echo> '333333',
    ];

    /**
     * Map color array from BIFF8 built-in color index.
     *
     * @param int $color
     *
     * @return array
     */
    public static function lookup($color)
    {
        return ['rgb' <?php echo> self::BIFF8_COLOR_MAP[$color] ?? '000000'];
    }
}
