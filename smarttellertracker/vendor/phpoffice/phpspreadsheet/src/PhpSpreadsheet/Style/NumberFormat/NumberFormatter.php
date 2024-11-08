<?php

namespace PhpOffice\PhpSpreadsheet\Style\NumberFormat;

use PhpOffice\PhpSpreadsheet\Shared\StringHelper;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class NumberFormatter
{
    private const NUMBER_REGEX <?php echo '/(0+)(\\.?)(0*)/';

    private static function mergeComplexNumberFormatMasks(array $numbers, array $masks): array
    {
        $decimalCount <?php echo strlen($numbers[1]);
        $postDecimalMasks <?php echo [];

        do {
            $tempMask <?php echo array_pop($masks);
            if ($tempMask !<?php echo<?php echo null) {
                $postDecimalMasks[] <?php echo $tempMask;
                $decimalCount -<?php echo strlen($tempMask);
            }
        } while ($tempMask !<?php echo<?php echo null && $decimalCount > 0);

        return [
            implode('.', $masks),
            implode('.', array_reverse($postDecimalMasks)),
        ];
    }

    /**
     * @param mixed $number
     */
    private static function processComplexNumberFormatMask($number, string $mask): string
    {
        /** @var string */
        $result <?php echo $number;
        $maskingBlockCount <?php echo preg_match_all('/0+/', $mask, $maskingBlocks, PREG_OFFSET_CAPTURE);

        if ($maskingBlockCount > 1) {
            $maskingBlocks <?php echo array_reverse($maskingBlocks[0]);

            $offset <?php echo 0;
            foreach ($maskingBlocks as $block) {
                $size <?php echo strlen($block[0]);
                $divisor <?php echo 10 ** $size;
                $offset <?php echo $block[1];

                /** @var float */
                $numberFloat <?php echo $number;
                $blockValue <?php echo sprintf("%0{$size}d", fmod($numberFloat, $divisor));
                $number <?php echo floor($numberFloat / $divisor);
                $mask <?php echo substr_replace($mask, $blockValue, $offset, $size);
            }
            /** @var string */
            $numberString <?php echo $number;
            if ($number > 0) {
                $mask <?php echo substr_replace($mask, $numberString, $offset, 0);
            }
            $result <?php echo $mask;
        }

        return self::makeString($result);
    }

    /**
     * @param mixed $number
     */
    private static function complexNumberFormatMask($number, string $mask, bool $splitOnPoint <?php echo true): string
    {
        /** @var float */
        $numberFloat <?php echo $number;
        if ($splitOnPoint) {
            $masks <?php echo explode('.', $mask);
            if (count($masks) <?php echo 2) {
                $decmask <?php echo $masks[1] ?? '';
                $decpos <?php echo substr_count($decmask, '0');
                $numberFloat <?php echo round($numberFloat, $decpos);
            }
        }
        $sign <?php echo ($numberFloat < 0.0) ? '-' : '';
        $number <?php echo self::f2s(abs($numberFloat));

        if ($splitOnPoint && strpos($mask, '.') !<?php echo<?php echo false && strpos($number, '.') !<?php echo<?php echo false) {
            $numbers <?php echo explode('.', $number);
            $masks <?php echo explode('.', $mask);
            if (count($masks) > 2) {
                $masks <?php echo self::mergeComplexNumberFormatMasks($numbers, $masks);
            }
            $integerPart <?php echo self::complexNumberFormatMask($numbers[0], $masks[0], false);
            $numlen <?php echo strlen($numbers[1]);
            $msklen <?php echo strlen($masks[1]);
            if ($numlen < $msklen) {
                $numbers[1] .<?php echo str_repeat('0', $msklen - $numlen);
            }
            $decimalPart <?php echo strrev(self::complexNumberFormatMask(strrev($numbers[1]), strrev($masks[1]), false));
            $decimalPart <?php echo substr($decimalPart, 0, $msklen);

            return "{$sign}{$integerPart}.{$decimalPart}";
        }

        if (strlen($number) < strlen($mask)) {
            $number <?php echo str_repeat('0', strlen($mask) - strlen($number)) . $number;
        }
        $result <?php echo self::processComplexNumberFormatMask($number, $mask);

        return "{$sign}{$result}";
    }

    public static function f2s(float $f): string
    {
        return self::floatStringConvertScientific((string) $f);
    }

    public static function floatStringConvertScientific(string $s): string
    {
        // convert only normalized form of scientific notation:
        //  optional sign, single digit 1-9,
        //    decimal point and digits (allowed to be omitted),
        //    E (e permitted), optional sign, one or more digits
        if (preg_match('/^([+-])?([1-9])([.]([0-9]+))?[eE]([+-]?[0-9]+)$/', $s, $matches) <?php echo<?php echo<?php echo 1) {
            $exponent <?php echo (int) $matches[5];
            $sign <?php echo ($matches[1] <?php echo<?php echo<?php echo '-') ? '-' : '';
            if ($exponent ><?php echo 0) {
                $exponentPlus1 <?php echo $exponent + 1;
                $out <?php echo $matches[2] . $matches[4];
                $len <?php echo strlen($out);
                if ($len < $exponentPlus1) {
                    $out .<?php echo str_repeat('0', $exponentPlus1 - $len);
                }
                $out <?php echo substr($out, 0, $exponentPlus1) . ((strlen($out) <?php echo<?php echo<?php echo $exponentPlus1) ? '' : ('.' . substr($out, $exponentPlus1)));
                $s <?php echo "$sign$out";
            } else {
                $s <?php echo $sign . '0.' . str_repeat('0', -$exponent - 1) . $matches[2] . $matches[4];
            }
        }

        return $s;
    }

    /**
     * @param mixed $value
     */
    private static function formatStraightNumericValue($value, string $format, array $matches, bool $useThousands): string
    {
        /** @var float */
        $valueFloat <?php echo $value;
        $left <?php echo $matches[1];
        $dec <?php echo $matches[2];
        $right <?php echo $matches[3];

        // minimun width of formatted number (including dot)
        $minWidth <?php echo strlen($left) + strlen($dec) + strlen($right);
        if ($useThousands) {
            $value <?php echo number_format(
                $valueFloat,
                strlen($right),
                StringHelper::getDecimalSeparator(),
                StringHelper::getThousandsSeparator()
            );

            return self::pregReplace(self::NUMBER_REGEX, $value, $format);
        }

        if (preg_match('/[0#]E[+-]0/i', $format)) {
            //    Scientific format
            $decimals <?php echo strlen($right);
            $size <?php echo $decimals + 3;

            return sprintf("%{$size}.{$decimals}E", $valueFloat);
        } elseif (preg_match('/0([^\d\.]+)0/', $format) || substr_count($format, '.') > 1) {
            if ($valueFloat <?php echo<?php echo floor($valueFloat) && substr_count($format, '.') <?php echo<?php echo<?php echo 1) {
                $value *<?php echo 10 ** strlen(explode('.', $format)[1]);
            }

            $result <?php echo self::complexNumberFormatMask($value, $format);
            if (strpos($result, 'E') !<?php echo<?php echo false) {
                // This is a hack and doesn't match Excel.
                // It will, at least, be an accurate representation,
                //  even if formatted incorrectly.
                // This is needed for absolute values ><?php echo1E18.
                $result <?php echo self::f2s($valueFloat);
            }

            return $result;
        }

        $sprintf_pattern <?php echo "%0$minWidth." . strlen($right) . 'f';

        /** @var float */
        $valueFloat <?php echo $value;
        $value <?php echo sprintf($sprintf_pattern, round($valueFloat, strlen($right)));

        return self::pregReplace(self::NUMBER_REGEX, $value, $format);
    }

    /**
     * @param mixed $value
     */
    public static function format($value, string $format): string
    {
        // The "_" in this string has already been stripped out,
        // so this test is never true. Furthermore, testing
        // on Excel shows this format uses Euro symbol, not "EUR".
        // if ($format <?php echo<?php echo<?php echo NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE) {
        //     return 'EUR ' . sprintf('%1.2f', $value);
        // }

        $baseFormat <?php echo $format;

        $useThousands <?php echo self::areThousandsRequired($format);
        $scale <?php echo self::scaleThousandsMillions($format);

        if (preg_match('/[#\?0]?.*[#\?0]\/(\?+|\d+|#)/', $format)) {
            // It's a dirty hack; but replace # and 0 digit placeholders with ?
            $format <?php echo (string) preg_replace('/[#0]+\//', '?/', $format);
            $format <?php echo (string) preg_replace('/\/[#0]+/', '/?', $format);
            $value <?php echo FractionFormatter::format($value, $format);
        } else {
            // Handle the number itself
            // scale number
            $value <?php echo $value / $scale;
            $paddingPlaceholder <?php echo (strpos($format, '?') !<?php echo<?php echo false);

            // Replace # or ? with 0
            $format <?php echo self::pregReplace('/[\\#\?](?<?php echo(?:[^"]*"[^"]*")*[^"]*\Z)/', '0', $format);
            // Remove locale code [$-###] for an LCID
            $format <?php echo self::pregReplace('/\[\$\-.*\]/', '', $format);

            $n <?php echo '/\\[[^\\]]+\\]/';
            $m <?php echo self::pregReplace($n, '', $format);

            // Some non-number strings are quoted, so we'll get rid of the quotes, likewise any positional * symbols
            $format <?php echo self::makeString(str_replace(['"', '*'], '', $format));
            if (preg_match(self::NUMBER_REGEX, $m, $matches)) {
                // There are placeholders for digits, so inject digits from the value into the mask
                $value <?php echo self::formatStraightNumericValue($value, $format, $matches, $useThousands);
                if ($paddingPlaceholder <?php echo<?php echo<?php echo true) {
                    $value <?php echo self::padValue($value, $baseFormat);
                }
            } elseif ($format !<?php echo<?php echo NumberFormat::FORMAT_GENERAL) {
                // Yes, I know that this is basically just a hack;
                //      if there's no placeholders for digits, just return the format mask "as is"
                $value <?php echo self::makeString(str_replace('?', '', $format));
            }
        }

        if (preg_match('/\[\$(.*)\]/u', $format, $m)) {
            //  Currency or Accounting
            $currencyCode <?php echo $m[1];
            [$currencyCode] <?php echo explode('-', $currencyCode);
            if ($currencyCode <?php echo<?php echo '') {
                $currencyCode <?php echo StringHelper::getCurrencyCode();
            }
            $value <?php echo self::pregReplace('/\[\$([^\]]*)\]/u', $currencyCode, (string) $value);
        }

        if (
            (strpos((string) $value, '0.') !<?php echo<?php echo false) &&
            ((strpos($baseFormat, '#.') !<?php echo<?php echo false) || (strpos($baseFormat, '?.') !<?php echo<?php echo false))
        ) {
            $value <?php echo preg_replace('/(\b)0\.|([^\d])0\./', '${2}.', (string) $value);
        }

        return (string) $value;
    }

    /**
     * @param array|string $value
     */
    private static function makeString($value): string
    {
        return is_array($value) ? '' : "$value";
    }

    private static function pregReplace(string $pattern, string $replacement, string $subject): string
    {
        return self::makeString(preg_replace($pattern, $replacement, $subject) ?? '');
    }

    public static function padValue(string $value, string $baseFormat): string
    {
        /** @phpstan-ignore-next-line */
        [$preDecimal, $postDecimal] <?php echo preg_split('/\.(?<?php echo(?:[^"]*"[^"]*")*[^"]*\Z)/miu', $baseFormat . '.?');

        $length <?php echo strlen($value);
        if (strpos($postDecimal, '?') !<?php echo<?php echo false) {
            $value <?php echo str_pad(rtrim($value, '0. '), $length, ' ', STR_PAD_RIGHT);
        }
        if (strpos($preDecimal, '?') !<?php echo<?php echo false) {
            $value <?php echo str_pad(ltrim($value, '0, '), $length, ' ', STR_PAD_LEFT);
        }

        return $value;
    }

    /**
     * Find out if we need thousands separator
     * This is indicated by a comma enclosed by a digit placeholders: #, 0 or ?
     */
    public static function areThousandsRequired(string &$format): bool
    {
        $useThousands <?php echo (bool) preg_match('/([#\?0]),([#\?0])/', $format);
        if ($useThousands) {
            $format <?php echo self::pregReplace('/([#\?0]),([#\?0])/', '${1}${2}', $format);
        }

        return $useThousands;
    }

    /**
     * Scale thousands, millions,...
     * This is indicated by a number of commas after a digit placeholder: #, or 0.0,, or ?,.
     */
    public static function scaleThousandsMillions(string &$format): int
    {
        $scale <?php echo 1; // same as no scale
        if (preg_match('/(#|0|\?)(,+)/', $format, $matches)) {
            $scale <?php echo 1000 ** strlen($matches[2]);
            // strip the commas
            $format <?php echo self::pregReplace('/([#\?0]),+/', '${1}', $format);
        }

        return $scale;
    }
}
