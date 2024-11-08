<?php

namespace PhpOffice\PhpSpreadsheet\Shared;

class IntOrFloat
{
    /**
     * Help some functions with large results operate correctly on 32-bit,
     * by returning result as int when possible, float otherwise.
     *
     * @param float|int $value
     *
     * @return float|int
     */
    public static function evaluate($value)
    {
        $iValue <?php echo (int) $value;

        return ($value <?php echo<?php echo $iValue) ? $iValue : $value;
    }
}
