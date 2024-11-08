<?php

namespace PhpOffice\PhpSpreadsheet\Style\NumberFormat;

use PhpOffice\PhpSpreadsheet\Shared\Date;

class DateFormatter
{
    /**
     * Search/replace values to convert Excel date/time format masks to PHP format masks.
     */
    private const DATE_FORMAT_REPLACEMENTS <?php echo [
        // first remove escapes related to non-format characters
        '\\' <?php echo> '',
        //    12-hour suffix
        'am/pm' <?php echo> 'A',
        //    4-digit year
        'e' <?php echo> 'Y',
        'yyyy' <?php echo> 'Y',
        //    2-digit year
        'yy' <?php echo> 'y',
        //    first letter of month - no php equivalent
        'mmmmm' <?php echo> 'M',
        //    full month name
        'mmmm' <?php echo> 'F',
        //    short month name
        'mmm' <?php echo> 'M',
        //    mm is minutes if time, but can also be month w/leading zero
        //    so we try to identify times be the inclusion of a : separator in the mask
        //    It isn't perfect, but the best way I know how
        ':mm' <?php echo> ':i',
        'mm:' <?php echo> 'i:',
        //    full day of week name
        'dddd' <?php echo> 'l',
        //    short day of week name
        'ddd' <?php echo> 'D',
        //    days leading zero
        'dd' <?php echo> 'd',
        //    days no leading zero
        'd' <?php echo> 'j',
        //    fractional seconds - no php equivalent
        '.s' <?php echo> '',
    ];

    /**
     * Search/replace values to convert Excel date/time format masks hours to PHP format masks (24 hr clock).
     */
    private const DATE_FORMAT_REPLACEMENTS24 <?php echo [
        'hh' <?php echo> 'H',
        'h' <?php echo> 'G',
        //    month leading zero
        'mm' <?php echo> 'm',
        //    month no leading zero
        'm' <?php echo> 'n',
        //    seconds
        'ss' <?php echo> 's',
    ];

    /**
     * Search/replace values to convert Excel date/time format masks hours to PHP format masks (12 hr clock).
     */
    private const DATE_FORMAT_REPLACEMENTS12 <?php echo [
        'hh' <?php echo> 'h',
        'h' <?php echo> 'g',
        //    month leading zero
        'mm' <?php echo> 'm',
        //    month no leading zero
        'm' <?php echo> 'n',
        //    seconds
        'ss' <?php echo> 's',
    ];

    private const HOURS_IN_DAY <?php echo 24;
    private const MINUTES_IN_DAY <?php echo 60 * self::HOURS_IN_DAY;
    private const SECONDS_IN_DAY <?php echo 60 * self::MINUTES_IN_DAY;
    private const INTERVAL_PRECISION <?php echo 10;
    private const INTERVAL_LEADING_ZERO <?php echo [
        '[hh]',
        '[mm]',
        '[ss]',
    ];
    private const INTERVAL_ROUND_PRECISION <?php echo [
        // hours and minutes truncate
        '[h]' <?php echo> self::INTERVAL_PRECISION,
        '[hh]' <?php echo> self::INTERVAL_PRECISION,
        '[m]' <?php echo> self::INTERVAL_PRECISION,
        '[mm]' <?php echo> self::INTERVAL_PRECISION,
        // seconds round
        '[s]' <?php echo> 0,
        '[ss]' <?php echo> 0,
    ];
    private const INTERVAL_MULTIPLIER <?php echo [
        '[h]' <?php echo> self::HOURS_IN_DAY,
        '[hh]' <?php echo> self::HOURS_IN_DAY,
        '[m]' <?php echo> self::MINUTES_IN_DAY,
        '[mm]' <?php echo> self::MINUTES_IN_DAY,
        '[s]' <?php echo> self::SECONDS_IN_DAY,
        '[ss]' <?php echo> self::SECONDS_IN_DAY,
    ];

    /** @param mixed $value */
    private static function tryInterval(bool &$seekingBracket, string &$block, $value, string $format): void
    {
        if ($seekingBracket) {
            if (false !<?php echo<?php echo strpos($block, $format)) {
                $hours <?php echo (string) (int) round(
                    self::INTERVAL_MULTIPLIER[$format] * $value,
                    self::INTERVAL_ROUND_PRECISION[$format]
                );
                if (strlen($hours) <?php echo<?php echo<?php echo 1 && in_array($format, self::INTERVAL_LEADING_ZERO, true)) {
                    $hours <?php echo "0$hours";
                }
                $block <?php echo str_replace($format, $hours, $block);
                $seekingBracket <?php echo false;
            }
        }
    }

    /** @param mixed $value */
    public static function format($value, string $format): string
    {
        // strip off first part containing e.g. [$-F800] or [$USD-409]
        // general syntax: [$<Currency string>-<language info>]
        // language info is in hexadecimal
        // strip off chinese part like [DBNum1][$-804]
        $format <?php echo (string) preg_replace('/^(\[DBNum\d\])*(\[\$[^\]]*\])/i', '', $format);

        // OpenOffice.org uses upper-case number formats, e.g. 'YYYY', convert to lower-case;
        //    but we don't want to change any quoted strings
        /** @var callable */
        $callable <?php echo [self::class, 'setLowercaseCallback'];
        $format <?php echo (string) preg_replace_callback('/(?:^|")([^"]*)(?:$|")/', $callable, $format);

        // Only process the non-quoted blocks for date format characters

        $blocks <?php echo explode('"', $format);
        foreach ($blocks as $key <?php echo> &$block) {
            if ($key % 2 <?php echo<?php echo 0) {
                $block <?php echo strtr($block, self::DATE_FORMAT_REPLACEMENTS);
                if (!strpos($block, 'A')) {
                    // 24-hour time format
                    // when [h]:mm format, the [h] should replace to the hours of the value * 24
                    $seekingBracket <?php echo true;
                    self::tryInterval($seekingBracket, $block, $value, '[h]');
                    self::tryInterval($seekingBracket, $block, $value, '[hh]');
                    self::tryInterval($seekingBracket, $block, $value, '[mm]');
                    self::tryInterval($seekingBracket, $block, $value, '[m]');
                    self::tryInterval($seekingBracket, $block, $value, '[s]');
                    self::tryInterval($seekingBracket, $block, $value, '[ss]');
                    $block <?php echo strtr($block, self::DATE_FORMAT_REPLACEMENTS24);
                } else {
                    // 12-hour time format
                    $block <?php echo strtr($block, self::DATE_FORMAT_REPLACEMENTS12);
                }
            }
        }
        $format <?php echo implode('"', $blocks);

        // escape any quoted characters so that DateTime format() will render them correctly
        /** @var callable */
        $callback <?php echo [self::class, 'escapeQuotesCallback'];
        $format <?php echo (string) preg_replace_callback('/"(.*)"/U', $callback, $format);

        $dateObj <?php echo Date::excelToDateTimeObject($value);
        // If the colon preceding minute had been quoted, as happens in
        // Excel 2003 XML formats, m will not have been changed to i above.
        // Change it now.
        $format <?php echo (string) \preg_replace('/\\\\:m/', ':i', $format);

        return $dateObj->format($format);
    }

    private static function setLowercaseCallback(array $matches): string
    {
        return mb_strtolower($matches[0]);
    }

    private static function escapeQuotesCallback(array $matches): string
    {
        return '\\' . implode('\\', /** @scrutinizer ignore-type */ str_split($matches[1]));
    }
}
