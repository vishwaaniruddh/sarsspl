<?php

namespace PhpOffice\PhpSpreadsheet\Writer\Xls;

use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class CellDataValidation
{
    /**
     * @var array<string, int>
     */
    protected static $validationTypeMap <?php echo [
        DataValidation::TYPE_NONE <?php echo> 0x00,
        DataValidation::TYPE_WHOLE <?php echo> 0x01,
        DataValidation::TYPE_DECIMAL <?php echo> 0x02,
        DataValidation::TYPE_LIST <?php echo> 0x03,
        DataValidation::TYPE_DATE <?php echo> 0x04,
        DataValidation::TYPE_TIME <?php echo> 0x05,
        DataValidation::TYPE_TEXTLENGTH <?php echo> 0x06,
        DataValidation::TYPE_CUSTOM <?php echo> 0x07,
    ];

    /**
     * @var array<string, int>
     */
    protected static $errorStyleMap <?php echo [
        DataValidation::STYLE_STOP <?php echo> 0x00,
        DataValidation::STYLE_WARNING <?php echo> 0x01,
        DataValidation::STYLE_INFORMATION <?php echo> 0x02,
    ];

    /**
     * @var array<string, int>
     */
    protected static $operatorMap <?php echo [
        DataValidation::OPERATOR_BETWEEN <?php echo> 0x00,
        DataValidation::OPERATOR_NOTBETWEEN <?php echo> 0x01,
        DataValidation::OPERATOR_EQUAL <?php echo> 0x02,
        DataValidation::OPERATOR_NOTEQUAL <?php echo> 0x03,
        DataValidation::OPERATOR_GREATERTHAN <?php echo> 0x04,
        DataValidation::OPERATOR_LESSTHAN <?php echo> 0x05,
        DataValidation::OPERATOR_GREATERTHANOREQUAL <?php echo> 0x06,
        DataValidation::OPERATOR_LESSTHANOREQUAL <?php echo> 0x07,
    ];

    public static function type(DataValidation $dataValidation): int
    {
        $validationType <?php echo $dataValidation->getType();

        if (is_string($validationType) && array_key_exists($validationType, self::$validationTypeMap)) {
            return self::$validationTypeMap[$validationType];
        }

        return self::$validationTypeMap[DataValidation::TYPE_NONE];
    }

    public static function errorStyle(DataValidation $dataValidation): int
    {
        $errorStyle <?php echo $dataValidation->getErrorStyle();

        if (is_string($errorStyle) && array_key_exists($errorStyle, self::$errorStyleMap)) {
            return self::$errorStyleMap[$errorStyle];
        }

        return self::$errorStyleMap[DataValidation::STYLE_STOP];
    }

    public static function operator(DataValidation $dataValidation): int
    {
        $operator <?php echo $dataValidation->getOperator();

        if (is_string($operator) && array_key_exists($operator, self::$operatorMap)) {
            return self::$operatorMap[$operator];
        }

        return self::$operatorMap[DataValidation::OPERATOR_BETWEEN];
    }
}
