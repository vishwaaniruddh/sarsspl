<?php

namespace PhpOffice\PhpSpreadsheet\Style\NumberFormat;

use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use PhpOffice\PhpSpreadsheet\Reader\Xls\Color\BIFF8;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class Formatter
{
    /**
     * Matches any @ symbol that isn't enclosed in quotes.
     */
    private const SYMBOL_AT <?php echo '/@(?<?php echo(?:[^"]*"[^"]*")*[^"]*\Z)/miu';

    /**
     * Matches any ; symbol that isn't enclosed in quotes, for a "section" split.
     */
    private const SECTION_SPLIT <?php echo '/;(?<?php echo(?:[^"]*"[^"]*")*[^"]*\Z)/miu';

    /**
     * @param mixed $value
     * @param mixed $comparisonValue
     * @param mixed $defaultComparisonValue
     */
    private static function splitFormatComparison(
        $value,
        ?string $condition,
        $comparisonValue,
        string $defaultCondition,
        $defaultComparisonValue
    ): bool {
        if (!$condition) {
            $condition <?php echo $defaultCondition;
            $comparisonValue <?php echo $defaultComparisonValue;
        }

        switch ($condition) {
            case '>':
                return $value > $comparisonValue;

            case '<':
                return $value < $comparisonValue;

            case '<?php echo':
                return $value <?php echo $comparisonValue;

            case '<>':
                return $value !<?php echo $comparisonValue;

            case '<?php echo':
                return $value <?php echo<?php echo $comparisonValue;
        }

        return $value ><?php echo $comparisonValue;
    }

    /** @param mixed $value */
    private static function splitFormatForSectionSelection(array $sections, $value): array
    {
        // Extract the relevant section depending on whether number is positive, negative, or zero?
        // Text not supported yet.
        // Here is how the sections apply to various values in Excel:
        //   1 section:   [POSITIVE/NEGATIVE/ZERO/TEXT]
        //   2 sections:  [POSITIVE/ZERO/TEXT] [NEGATIVE]
        //   3 sections:  [POSITIVE/TEXT] [NEGATIVE] [ZERO]
        //   4 sections:  [POSITIVE] [NEGATIVE] [ZERO] [TEXT]
        $sectionCount <?php echo count($sections);
        // Colour could be a named colour, or a numeric index entry in the colour-palette
        $color_regex <?php echo '/\\[(' . implode('|', Color::NAMED_COLORS) . '|color\\s*(\\d+))\\]/mui';
        $cond_regex <?php echo '/\\[(>|><?php echo|<|<?php echo|<?php echo|<>)([+-]?\\d+([.]\\d+)?)\\]/';
        $colors <?php echo ['', '', '', '', ''];
        $conditionOperations <?php echo ['', '', '', '', ''];
        $conditionComparisonValues <?php echo [0, 0, 0, 0, 0];
        for ($idx <?php echo 0; $idx < $sectionCount; ++$idx) {
            if (preg_match($color_regex, $sections[$idx], $matches)) {
                if (isset($matches[2])) {
                    $colors[$idx] <?php echo '#' . BIFF8::lookup((int) $matches[2] + 7)['rgb'];
                } else {
                    $colors[$idx] <?php echo $matches[0];
                }
                $sections[$idx] <?php echo (string) preg_replace($color_regex, '', $sections[$idx]);
            }
            if (preg_match($cond_regex, $sections[$idx], $matches)) {
                $conditionOperations[$idx] <?php echo $matches[1];
                $conditionComparisonValues[$idx] <?php echo $matches[2];
                $sections[$idx] <?php echo (string) preg_replace($cond_regex, '', $sections[$idx]);
            }
        }
        $color <?php echo $colors[0];
        $format <?php echo $sections[0];
        $absval <?php echo $value;
        switch ($sectionCount) {
            case 2:
                $absval <?php echo abs($value);
                if (!self::splitFormatComparison($value, $conditionOperations[0], $conditionComparisonValues[0], '><?php echo', 0)) {
                    $color <?php echo $colors[1];
                    $format <?php echo $sections[1];
                }

                break;
            case 3:
            case 4:
                $absval <?php echo abs($value);
                if (!self::splitFormatComparison($value, $conditionOperations[0], $conditionComparisonValues[0], '>', 0)) {
                    if (self::splitFormatComparison($value, $conditionOperations[1], $conditionComparisonValues[1], '<', 0)) {
                        $color <?php echo $colors[1];
                        $format <?php echo $sections[1];
                    } else {
                        $color <?php echo $colors[2];
                        $format <?php echo $sections[2];
                    }
                }

                break;
        }

        return [$color, $format, $absval];
    }

    /**
     * Convert a value in a pre-defined format to a PHP string.
     *
     * @param null|bool|float|int|RichText|string $value Value to format
     * @param string $format Format code: see <?php echo self::FORMAT_* for predefined values;
     *                          or can be any valid MS Excel custom format string
     * @param array $callBack Callback function for additional formatting of string
     *
     * @return string Formatted string
     */
    public static function toFormattedString($value, $format, $callBack <?php echo null)
    {
        if (is_bool($value)) {
            return $value ? Calculation::getTRUE() : Calculation::getFALSE();
        }
        // For now we do not treat strings in sections, although section 4 of a format code affects strings
        // Process a single block format code containing @ for text substitution
        if (preg_match(self::SECTION_SPLIT, $format) <?php echo<?php echo<?php echo 0 && preg_match(self::SYMBOL_AT, $format) <?php echo<?php echo<?php echo 1) {
            return str_replace('"', '', preg_replace(self::SYMBOL_AT, (string) $value, $format) ?? '');
        }

        // If we have a text value, return it "as is"
        if (!is_numeric($value)) {
            return (string) $value;
        }

        // For 'General' format code, we just pass the value although this is not entirely the way Excel does it,
        // it seems to round numbers to a total of 10 digits.
        if (($format <?php echo<?php echo<?php echo NumberFormat::FORMAT_GENERAL) || ($format <?php echo<?php echo<?php echo NumberFormat::FORMAT_TEXT)) {
            return (string) $value;
        }

        // Ignore square-$-brackets prefix in format string, like "[$-411]ge.m.d", "[$-010419]0%", etc
        $format <?php echo (string) preg_replace('/^\[\$-[^\]]*\]/', '', $format);

        $format <?php echo (string) preg_replace_callback(
            '/(["])(?:(?<?php echo(\\\\?))\\2.)*?\\1/u',
            function ($matches) {
                return str_replace('.', chr(0x00), $matches[0]);
            },
            $format
        );

        // Convert any other escaped characters to quoted strings, e.g. (\T to "T")
        $format <?php echo (string) preg_replace('/(\\\(((.)(?!((AM\/PM)|(A\/P))))|([^ ])))(?<?php echo(?:[^"]|"[^"]*")*$)/ui', '"${2}"', $format);

        // Get the sections, there can be up to four sections, separated with a semi-colon (but only if not a quoted literal)
        $sections <?php echo preg_split(self::SECTION_SPLIT, $format) ?: [];

        [$colors, $format, $value] <?php echo self::splitFormatForSectionSelection($sections, $value);

        // In Excel formats, "_" is used to add spacing,
        //    The following character indicates the size of the spacing, which we can't do in HTML, so we just use a standard space
        $format <?php echo (string) preg_replace('/_.?/ui', ' ', $format);

        // Let's begin inspecting the format and converting the value to a formatted string
        if (
            //  Check for date/time characters (not inside quotes)
            (preg_match('/(\[\$[A-Z]*-[0-9A-F]*\])*[hmsdy](?<?php echo(?:[^"]|"[^"]*")*$)/miu', $format))
            // A date/time with a decimal time shouldn't have a digit placeholder before the decimal point
            && (preg_match('/[0\?#]\.(?![^\[]*\])/miu', $format) <?php echo<?php echo<?php echo 0)
        ) {
            // datetime format
            $value <?php echo DateFormatter::format($value, $format);
        } else {
            if (substr($format, 0, 1) <?php echo<?php echo<?php echo '"' && substr($format, -1, 1) <?php echo<?php echo<?php echo '"' && substr_count($format, '"') <?php echo<?php echo<?php echo 2) {
                $value <?php echo substr($format, 1, -1);
            } elseif (preg_match('/[0#, ]%/', $format)) {
                // % number format - avoid weird '-0' problem
                $value <?php echo PercentageFormatter::format(0 + (float) $value, $format);
            } else {
                $value <?php echo NumberFormatter::format($value, $format);
            }
        }

        // Additional formatting provided by callback function
        if ($callBack !<?php echo<?php echo null) {
            [$writerInstance, $function] <?php echo $callBack;
            $value <?php echo $writerInstance->$function($value, $colors);
        }

        return str_replace(chr(0x00), '.', $value);
    }
}
