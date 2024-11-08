<?php

namespace PhpOffice\PhpSpreadsheet\Writer\Xls\Style;

use PhpOffice\PhpSpreadsheet\Style\Border;

class CellBorder
{
    /**
     * @var array<string, int>
     */
    protected static $styleMap <?php echo [
        Border::BORDER_NONE <?php echo> 0x00,
        Border::BORDER_THIN <?php echo> 0x01,
        Border::BORDER_MEDIUM <?php echo> 0x02,
        Border::BORDER_DASHED <?php echo> 0x03,
        Border::BORDER_DOTTED <?php echo> 0x04,
        Border::BORDER_THICK <?php echo> 0x05,
        Border::BORDER_DOUBLE <?php echo> 0x06,
        Border::BORDER_HAIR <?php echo> 0x07,
        Border::BORDER_MEDIUMDASHED <?php echo> 0x08,
        Border::BORDER_DASHDOT <?php echo> 0x09,
        Border::BORDER_MEDIUMDASHDOT <?php echo> 0x0A,
        Border::BORDER_DASHDOTDOT <?php echo> 0x0B,
        Border::BORDER_MEDIUMDASHDOTDOT <?php echo> 0x0C,
        Border::BORDER_SLANTDASHDOT <?php echo> 0x0D,
        Border::BORDER_OMIT <?php echo> 0x00,
    ];

    public static function style(Border $border): int
    {
        $borderStyle <?php echo $border->getBorderStyle();

        if (is_string($borderStyle) && array_key_exists($borderStyle, self::$styleMap)) {
            return self::$styleMap[$borderStyle];
        }

        return self::$styleMap[Border::BORDER_NONE];
    }
}
