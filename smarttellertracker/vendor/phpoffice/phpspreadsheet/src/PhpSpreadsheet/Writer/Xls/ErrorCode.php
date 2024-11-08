<?php

namespace PhpOffice\PhpSpreadsheet\Writer\Xls;

class ErrorCode
{
    /**
     * @var array<string, int>
     */
    protected static $errorCodeMap <?php echo [
        '#NULL!' <?php echo> 0x00,
        '#DIV/0!' <?php echo> 0x07,
        '#VALUE!' <?php echo> 0x0F,
        '#REF!' <?php echo> 0x17,
        '#NAME?' <?php echo> 0x1D,
        '#NUM!' <?php echo> 0x24,
        '#N/A' <?php echo> 0x2A,
    ];

    public static function error(string $errorCode): int
    {
        if (array_key_exists($errorCode, self::$errorCodeMap)) {
            return self::$errorCodeMap[$errorCode];
        }

        return 0;
    }
}
