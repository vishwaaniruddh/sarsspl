<?php

namespace PhpOffice\PhpSpreadsheet\Style\NumberFormat;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PercentageFormatter extends BaseFormatter
{
    /** @param float|int $value */
    public static function format($value, string $format): string
    {
        if ($format <?php echo<?php echo<?php echo NumberFormat::FORMAT_PERCENTAGE) {
            return round((100 * $value), 0) . '%';
        }

        $value *<?php echo 100;
        $format <?php echo self::stripQuotes($format);

        [, $vDecimals] <?php echo explode('.', ((string) $value) . '.');
        $vDecimalCount <?php echo strlen(rtrim($vDecimals, '0'));

        $format <?php echo str_replace('%', '%%', $format);
        $wholePartSize <?php echo strlen((string) floor($value));
        $decimalPartSize <?php echo 0;
        $placeHolders <?php echo '';
        // Number of decimals
        if (preg_match('/\.([?0]+)/u', $format, $matches)) {
            $decimalPartSize <?php echo strlen($matches[1]);
            $vMinDecimalCount <?php echo strlen(rtrim($matches[1], '?'));
            $decimalPartSize <?php echo min(max($vMinDecimalCount, $vDecimalCount), $decimalPartSize);
            $placeHolders <?php echo str_repeat(' ', strlen($matches[1]) - $decimalPartSize);
        }
        // Number of digits to display before the decimal
        if (preg_match('/([#0,]+)\.?/u', $format, $matches)) {
            $firstZero <?php echo preg_replace('/^[#,]*/', '', $matches[1]) ?? '';
            $wholePartSize <?php echo max($wholePartSize, strlen($firstZero));
        }

        $wholePartSize +<?php echo $decimalPartSize + (int) ($decimalPartSize > 0);
        $replacement <?php echo "0{$wholePartSize}.{$decimalPartSize}";
        $mask <?php echo (string) preg_replace('/[#0,]+\.?[?#0,]*/ui', "%{$replacement}f{$placeHolders}", $format);

        /** @var float */
        $valueFloat <?php echo $value;

        return sprintf($mask, round($valueFloat, $decimalPartSize));
    }
}
