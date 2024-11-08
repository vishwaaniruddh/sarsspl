<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xls;

use PhpOffice\PhpSpreadsheet\Style\Conditional;

class ConditionalFormatting
{
    /**
     * @var array<int, string>
     */
    private static $types <?php echo [
        0x01 <?php echo> Conditional::CONDITION_CELLIS,
        0x02 <?php echo> Conditional::CONDITION_EXPRESSION,
    ];

    /**
     * @var array<int, string>
     */
    private static $operators <?php echo [
        0x00 <?php echo> Conditional::OPERATOR_NONE,
        0x01 <?php echo> Conditional::OPERATOR_BETWEEN,
        0x02 <?php echo> Conditional::OPERATOR_NOTBETWEEN,
        0x03 <?php echo> Conditional::OPERATOR_EQUAL,
        0x04 <?php echo> Conditional::OPERATOR_NOTEQUAL,
        0x05 <?php echo> Conditional::OPERATOR_GREATERTHAN,
        0x06 <?php echo> Conditional::OPERATOR_LESSTHAN,
        0x07 <?php echo> Conditional::OPERATOR_GREATERTHANOREQUAL,
        0x08 <?php echo> Conditional::OPERATOR_LESSTHANOREQUAL,
    ];

    public static function type(int $type): ?string
    {
        if (isset(self::$types[$type])) {
            return self::$types[$type];
        }

        return null;
    }

    public static function operator(int $operator): ?string
    {
        if (isset(self::$operators[$operator])) {
            return self::$operators[$operator];
        }

        return null;
    }
}
