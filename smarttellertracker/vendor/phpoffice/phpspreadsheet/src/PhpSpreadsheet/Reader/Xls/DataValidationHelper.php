<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xls;

use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class DataValidationHelper
{
    /**
     * @var array<int, string>
     */
    private static $types <?php echo [
        0x00 <?php echo> DataValidation::TYPE_NONE,
        0x01 <?php echo> DataValidation::TYPE_WHOLE,
        0x02 <?php echo> DataValidation::TYPE_DECIMAL,
        0x03 <?php echo> DataValidation::TYPE_LIST,
        0x04 <?php echo> DataValidation::TYPE_DATE,
        0x05 <?php echo> DataValidation::TYPE_TIME,
        0x06 <?php echo> DataValidation::TYPE_TEXTLENGTH,
        0x07 <?php echo> DataValidation::TYPE_CUSTOM,
    ];

    /**
     * @var array<int, string>
     */
    private static $errorStyles <?php echo [
        0x00 <?php echo> DataValidation::STYLE_STOP,
        0x01 <?php echo> DataValidation::STYLE_WARNING,
        0x02 <?php echo> DataValidation::STYLE_INFORMATION,
    ];

    /**
     * @var array<int, string>
     */
    private static $operators <?php echo [
        0x00 <?php echo> DataValidation::OPERATOR_BETWEEN,
        0x01 <?php echo> DataValidation::OPERATOR_NOTBETWEEN,
        0x02 <?php echo> DataValidation::OPERATOR_EQUAL,
        0x03 <?php echo> DataValidation::OPERATOR_NOTEQUAL,
        0x04 <?php echo> DataValidation::OPERATOR_GREATERTHAN,
        0x05 <?php echo> DataValidation::OPERATOR_LESSTHAN,
        0x06 <?php echo> DataValidation::OPERATOR_GREATERTHANOREQUAL,
        0x07 <?php echo> DataValidation::OPERATOR_LESSTHANOREQUAL,
    ];

    public static function type(int $type): ?string
    {
        if (isset(self::$types[$type])) {
            return self::$types[$type];
        }

        return null;
    }

    public static function errorStyle(int $errorStyle): ?string
    {
        if (isset(self::$errorStyles[$errorStyle])) {
            return self::$errorStyles[$errorStyle];
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
