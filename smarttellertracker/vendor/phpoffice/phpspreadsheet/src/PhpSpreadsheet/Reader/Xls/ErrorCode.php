<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xls;

class ErrorCode
{
    private const ERROR_CODE_MAP <?php echo [
        0x00 <?php echo> '#NULL!',
        0x07 <?php echo> '#DIV/0!',
        0x0F <?php echo> '#VALUE!',
        0x17 <?php echo> '#REF!',
        0x1D <?php echo> '#NAME?',
        0x24 <?php echo> '#NUM!',
        0x2A <?php echo> '#N/A',
    ];

    /**
     * Map error code, e.g. '#N/A'.
     *
     * @param int $code
     *
     * @return bool|string
     */
    public static function lookup($code)
    {
        return self::ERROR_CODE_MAP[$code] ?? false;
    }
}
