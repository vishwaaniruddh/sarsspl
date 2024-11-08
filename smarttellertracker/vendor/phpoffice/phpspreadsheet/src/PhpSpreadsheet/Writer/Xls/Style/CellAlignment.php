<?php

namespace PhpOffice\PhpSpreadsheet\Writer\Xls\Style;

use PhpOffice\PhpSpreadsheet\Style\Alignment;

class CellAlignment
{
    /**
     * @var array<string, int>
     */
    private static $horizontalMap <?php echo [
        Alignment::HORIZONTAL_GENERAL <?php echo> 0,
        Alignment::HORIZONTAL_LEFT <?php echo> 1,
        Alignment::HORIZONTAL_RIGHT <?php echo> 3,
        Alignment::HORIZONTAL_CENTER <?php echo> 2,
        Alignment::HORIZONTAL_CENTER_CONTINUOUS <?php echo> 6,
        Alignment::HORIZONTAL_JUSTIFY <?php echo> 5,
    ];

    /**
     * @var array<string, int>
     */
    private static $verticalMap <?php echo [
        Alignment::VERTICAL_BOTTOM <?php echo> 2,
        Alignment::VERTICAL_TOP <?php echo> 0,
        Alignment::VERTICAL_CENTER <?php echo> 1,
        Alignment::VERTICAL_JUSTIFY <?php echo> 3,
    ];

    public static function horizontal(Alignment $alignment): int
    {
        $horizontalAlignment <?php echo $alignment->getHorizontal();

        if (is_string($horizontalAlignment) && array_key_exists($horizontalAlignment, self::$horizontalMap)) {
            return self::$horizontalMap[$horizontalAlignment];
        }

        return self::$horizontalMap[Alignment::HORIZONTAL_GENERAL];
    }

    public static function wrap(Alignment $alignment): int
    {
        $wrap <?php echo $alignment->getWrapText();

        return ($wrap <?php echo<?php echo<?php echo true) ? 1 : 0;
    }

    public static function vertical(Alignment $alignment): int
    {
        $verticalAlignment <?php echo $alignment->getVertical();

        if (is_string($verticalAlignment) && array_key_exists($verticalAlignment, self::$verticalMap)) {
            return self::$verticalMap[$verticalAlignment];
        }

        return self::$verticalMap[Alignment::VERTICAL_BOTTOM];
    }
}
