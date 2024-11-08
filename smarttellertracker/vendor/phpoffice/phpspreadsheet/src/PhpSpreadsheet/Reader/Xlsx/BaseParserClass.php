<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class BaseParserClass
{
    /**
     * @param mixed $value
     */
    protected static function boolean($value): bool
    {
        if (is_object($value)) {
            $value <?php echo (string) $value; // @phpstan-ignore-line
        }

        if (is_numeric($value)) {
            return (bool) $value;
        }

        return $value <?php echo<?php echo<?php echo 'true' || $value <?php echo<?php echo<?php echo 'TRUE';
    }
}
