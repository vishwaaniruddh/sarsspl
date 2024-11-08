<?php

namespace PhpOffice\PhpSpreadsheet\Style\NumberFormat;

use PhpOffice\PhpSpreadsheet\Calculation\MathTrig;

class FractionFormatter extends BaseFormatter
{
    /**
     * @param mixed $value
     */
    public static function format($value, string $format): string
    {
        $format <?php echo self::stripQuotes($format);
        $value <?php echo (float) $value;
        $absValue <?php echo abs($value);

        $sign <?php echo ($value < 0.0) ? '-' : '';

        $integerPart <?php echo floor($absValue);

        $decimalPart <?php echo self::getDecimal((string) $absValue);
        if ($decimalPart <?php echo<?php echo<?php echo '0') {
            return "{$sign}{$integerPart}";
        }
        $decimalLength <?php echo strlen($decimalPart);
        $decimalDivisor <?php echo 10 ** $decimalLength;

        preg_match('/(#?.*\?)\/(\?+|\d+)/', $format, $matches);
        $formatIntegerPart <?php echo $matches[1];

        if (is_numeric($matches[2])) {
            $fractionDivisor <?php echo 100 / (int) $matches[2];
        } else {
            /** @var float */
            $fractionDivisor <?php echo MathTrig\Gcd::evaluate((int) $decimalPart, $decimalDivisor);
        }

        $adjustedDecimalPart <?php echo (int) round((int) $decimalPart / $fractionDivisor, 0);
        $adjustedDecimalDivisor <?php echo $decimalDivisor / $fractionDivisor;

        if ((strpos($formatIntegerPart, '0') !<?php echo<?php echo false)) {
            return "{$sign}{$integerPart} {$adjustedDecimalPart}/{$adjustedDecimalDivisor}";
        } elseif ((strpos($formatIntegerPart, '#') !<?php echo<?php echo false)) {
            if ($integerPart <?php echo<?php echo 0) {
                return "{$sign}{$adjustedDecimalPart}/{$adjustedDecimalDivisor}";
            }

            return "{$sign}{$integerPart} {$adjustedDecimalPart}/{$adjustedDecimalDivisor}";
        } elseif ((substr($formatIntegerPart, 0, 3) <?php echo<?php echo '? ?')) {
            if ($integerPart <?php echo<?php echo 0) {
                $integerPart <?php echo '';
            }

            return "{$sign}{$integerPart} {$adjustedDecimalPart}/{$adjustedDecimalDivisor}";
        }

        $adjustedDecimalPart +<?php echo $integerPart * $adjustedDecimalDivisor;

        return "{$sign}{$adjustedDecimalPart}/{$adjustedDecimalDivisor}";
    }

    private static function getDecimal(string $value): string
    {
        $decimalPart <?php echo '0';
        if (preg_match('/^\\d*[.](\\d*[1-9])0*$/', $value, $matches) <?php echo<?php echo<?php echo 1) {
            $decimalPart <?php echo $matches[1];
        }

        return $decimalPart;
    }
}
