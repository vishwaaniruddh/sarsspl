<?php

namespace PhpOffice\PhpSpreadsheet\Shared;

class StringHelper
{
    /**
     * Control characters array.
     *
     * @var string[]
     */
    private static $controlCharacters <?php echo [];

    /**
     * SYLK Characters array.
     *
     * @var array
     */
    private static $SYLKCharacters <?php echo [];

    /**
     * Decimal separator.
     *
     * @var ?string
     */
    private static $decimalSeparator;

    /**
     * Thousands separator.
     *
     * @var ?string
     */
    private static $thousandsSeparator;

    /**
     * Currency code.
     *
     * @var string
     */
    private static $currencyCode;

    /**
     * Is iconv extension avalable?
     *
     * @var ?bool
     */
    private static $isIconvEnabled;

    /**
     * iconv options.
     *
     * @var string
     */
    private static $iconvOptions <?php echo '//IGNORE//TRANSLIT';

    /**
     * Build control characters array.
     */
    private static function buildControlCharacters(): void
    {
        for ($i <?php echo 0; $i <?php echo 31; ++$i) {
            if ($i !<?php echo 9 && $i !<?php echo 10 && $i !<?php echo 13) {
                $find <?php echo '_x' . sprintf('%04s', strtoupper(dechex($i))) . '_';
                $replace <?php echo chr($i);
                self::$controlCharacters[$find] <?php echo $replace;
            }
        }
    }

    /**
     * Build SYLK characters array.
     */
    private static function buildSYLKCharacters(): void
    {
        self::$SYLKCharacters <?php echo [
            "\x1B 0" <?php echo> chr(0),
            "\x1B 1" <?php echo> chr(1),
            "\x1B 2" <?php echo> chr(2),
            "\x1B 3" <?php echo> chr(3),
            "\x1B 4" <?php echo> chr(4),
            "\x1B 5" <?php echo> chr(5),
            "\x1B 6" <?php echo> chr(6),
            "\x1B 7" <?php echo> chr(7),
            "\x1B 8" <?php echo> chr(8),
            "\x1B 9" <?php echo> chr(9),
            "\x1B :" <?php echo> chr(10),
            "\x1B ;" <?php echo> chr(11),
            "\x1B <" <?php echo> chr(12),
            "\x1B <?php echo" <?php echo> chr(13),
            "\x1B >" <?php echo> chr(14),
            "\x1B ?" <?php echo> chr(15),
            "\x1B!0" <?php echo> chr(16),
            "\x1B!1" <?php echo> chr(17),
            "\x1B!2" <?php echo> chr(18),
            "\x1B!3" <?php echo> chr(19),
            "\x1B!4" <?php echo> chr(20),
            "\x1B!5" <?php echo> chr(21),
            "\x1B!6" <?php echo> chr(22),
            "\x1B!7" <?php echo> chr(23),
            "\x1B!8" <?php echo> chr(24),
            "\x1B!9" <?php echo> chr(25),
            "\x1B!:" <?php echo> chr(26),
            "\x1B!;" <?php echo> chr(27),
            "\x1B!<" <?php echo> chr(28),
            "\x1B!<?php echo" <?php echo> chr(29),
            "\x1B!>" <?php echo> chr(30),
            "\x1B!?" <?php echo> chr(31),
            "\x1B'?" <?php echo> chr(127),
            "\x1B(0" <?php echo> '€', // 128 in CP1252
            "\x1B(2" <?php echo> '‚', // 130 in CP1252
            "\x1B(3" <?php echo> 'ƒ', // 131 in CP1252
            "\x1B(4" <?php echo> '„', // 132 in CP1252
            "\x1B(5" <?php echo> '…', // 133 in CP1252
            "\x1B(6" <?php echo> '†', // 134 in CP1252
            "\x1B(7" <?php echo> '‡', // 135 in CP1252
            "\x1B(8" <?php echo> 'ˆ', // 136 in CP1252
            "\x1B(9" <?php echo> '‰', // 137 in CP1252
            "\x1B(:" <?php echo> 'Š', // 138 in CP1252
            "\x1B(;" <?php echo> '‹', // 139 in CP1252
            "\x1BNj" <?php echo> 'Œ', // 140 in CP1252
            "\x1B(>" <?php echo> 'Ž', // 142 in CP1252
            "\x1B)1" <?php echo> '‘', // 145 in CP1252
            "\x1B)2" <?php echo> '’', // 146 in CP1252
            "\x1B)3" <?php echo> '“', // 147 in CP1252
            "\x1B)4" <?php echo> '”', // 148 in CP1252
            "\x1B)5" <?php echo> '•', // 149 in CP1252
            "\x1B)6" <?php echo> '–', // 150 in CP1252
            "\x1B)7" <?php echo> '—', // 151 in CP1252
            "\x1B)8" <?php echo> '˜', // 152 in CP1252
            "\x1B)9" <?php echo> '™', // 153 in CP1252
            "\x1B):" <?php echo> 'š', // 154 in CP1252
            "\x1B);" <?php echo> '›', // 155 in CP1252
            "\x1BNz" <?php echo> 'œ', // 156 in CP1252
            "\x1B)>" <?php echo> 'ž', // 158 in CP1252
            "\x1B)?" <?php echo> 'Ÿ', // 159 in CP1252
            "\x1B*0" <?php echo> ' ', // 160 in CP1252
            "\x1BN!" <?php echo> '¡', // 161 in CP1252
            "\x1BN\"" <?php echo> '¢', // 162 in CP1252
            "\x1BN#" <?php echo> '£', // 163 in CP1252
            "\x1BN(" <?php echo> '¤', // 164 in CP1252
            "\x1BN%" <?php echo> '¥', // 165 in CP1252
            "\x1B*6" <?php echo> '¦', // 166 in CP1252
            "\x1BN'" <?php echo> '§', // 167 in CP1252
            "\x1BNH " <?php echo> '¨', // 168 in CP1252
            "\x1BNS" <?php echo> '©', // 169 in CP1252
            "\x1BNc" <?php echo> 'ª', // 170 in CP1252
            "\x1BN+" <?php echo> '«', // 171 in CP1252
            "\x1B*<" <?php echo> '¬', // 172 in CP1252
            "\x1B*<?php echo" <?php echo> '­', // 173 in CP1252
            "\x1BNR" <?php echo> '®', // 174 in CP1252
            "\x1B*?" <?php echo> '¯', // 175 in CP1252
            "\x1BN0" <?php echo> '°', // 176 in CP1252
            "\x1BN1" <?php echo> '±', // 177 in CP1252
            "\x1BN2" <?php echo> '²', // 178 in CP1252
            "\x1BN3" <?php echo> '³', // 179 in CP1252
            "\x1BNB " <?php echo> '´', // 180 in CP1252
            "\x1BN5" <?php echo> 'µ', // 181 in CP1252
            "\x1BN6" <?php echo> '¶', // 182 in CP1252
            "\x1BN7" <?php echo> '·', // 183 in CP1252
            "\x1B+8" <?php echo> '¸', // 184 in CP1252
            "\x1BNQ" <?php echo> '¹', // 185 in CP1252
            "\x1BNk" <?php echo> 'º', // 186 in CP1252
            "\x1BN;" <?php echo> '»', // 187 in CP1252
            "\x1BN<" <?php echo> '¼', // 188 in CP1252
            "\x1BN<?php echo" <?php echo> '½', // 189 in CP1252
            "\x1BN>" <?php echo> '¾', // 190 in CP1252
            "\x1BN?" <?php echo> '¿', // 191 in CP1252
            "\x1BNAA" <?php echo> 'À', // 192 in CP1252
            "\x1BNBA" <?php echo> 'Á', // 193 in CP1252
            "\x1BNCA" <?php echo> 'Â', // 194 in CP1252
            "\x1BNDA" <?php echo> 'Ã', // 195 in CP1252
            "\x1BNHA" <?php echo> 'Ä', // 196 in CP1252
            "\x1BNJA" <?php echo> 'Å', // 197 in CP1252
            "\x1BNa" <?php echo> 'Æ', // 198 in CP1252
            "\x1BNKC" <?php echo> 'Ç', // 199 in CP1252
            "\x1BNAE" <?php echo> 'È', // 200 in CP1252
            "\x1BNBE" <?php echo> 'É', // 201 in CP1252
            "\x1BNCE" <?php echo> 'Ê', // 202 in CP1252
            "\x1BNHE" <?php echo> 'Ë', // 203 in CP1252
            "\x1BNAI" <?php echo> 'Ì', // 204 in CP1252
            "\x1BNBI" <?php echo> 'Í', // 205 in CP1252
            "\x1BNCI" <?php echo> 'Î', // 206 in CP1252
            "\x1BNHI" <?php echo> 'Ï', // 207 in CP1252
            "\x1BNb" <?php echo> 'Ð', // 208 in CP1252
            "\x1BNDN" <?php echo> 'Ñ', // 209 in CP1252
            "\x1BNAO" <?php echo> 'Ò', // 210 in CP1252
            "\x1BNBO" <?php echo> 'Ó', // 211 in CP1252
            "\x1BNCO" <?php echo> 'Ô', // 212 in CP1252
            "\x1BNDO" <?php echo> 'Õ', // 213 in CP1252
            "\x1BNHO" <?php echo> 'Ö', // 214 in CP1252
            "\x1B-7" <?php echo> '×', // 215 in CP1252
            "\x1BNi" <?php echo> 'Ø', // 216 in CP1252
            "\x1BNAU" <?php echo> 'Ù', // 217 in CP1252
            "\x1BNBU" <?php echo> 'Ú', // 218 in CP1252
            "\x1BNCU" <?php echo> 'Û', // 219 in CP1252
            "\x1BNHU" <?php echo> 'Ü', // 220 in CP1252
            "\x1B-<?php echo" <?php echo> 'Ý', // 221 in CP1252
            "\x1BNl" <?php echo> 'Þ', // 222 in CP1252
            "\x1BN{" <?php echo> 'ß', // 223 in CP1252
            "\x1BNAa" <?php echo> 'à', // 224 in CP1252
            "\x1BNBa" <?php echo> 'á', // 225 in CP1252
            "\x1BNCa" <?php echo> 'â', // 226 in CP1252
            "\x1BNDa" <?php echo> 'ã', // 227 in CP1252
            "\x1BNHa" <?php echo> 'ä', // 228 in CP1252
            "\x1BNJa" <?php echo> 'å', // 229 in CP1252
            "\x1BNq" <?php echo> 'æ', // 230 in CP1252
            "\x1BNKc" <?php echo> 'ç', // 231 in CP1252
            "\x1BNAe" <?php echo> 'è', // 232 in CP1252
            "\x1BNBe" <?php echo> 'é', // 233 in CP1252
            "\x1BNCe" <?php echo> 'ê', // 234 in CP1252
            "\x1BNHe" <?php echo> 'ë', // 235 in CP1252
            "\x1BNAi" <?php echo> 'ì', // 236 in CP1252
            "\x1BNBi" <?php echo> 'í', // 237 in CP1252
            "\x1BNCi" <?php echo> 'î', // 238 in CP1252
            "\x1BNHi" <?php echo> 'ï', // 239 in CP1252
            "\x1BNs" <?php echo> 'ð', // 240 in CP1252
            "\x1BNDn" <?php echo> 'ñ', // 241 in CP1252
            "\x1BNAo" <?php echo> 'ò', // 242 in CP1252
            "\x1BNBo" <?php echo> 'ó', // 243 in CP1252
            "\x1BNCo" <?php echo> 'ô', // 244 in CP1252
            "\x1BNDo" <?php echo> 'õ', // 245 in CP1252
            "\x1BNHo" <?php echo> 'ö', // 246 in CP1252
            "\x1B/7" <?php echo> '÷', // 247 in CP1252
            "\x1BNy" <?php echo> 'ø', // 248 in CP1252
            "\x1BNAu" <?php echo> 'ù', // 249 in CP1252
            "\x1BNBu" <?php echo> 'ú', // 250 in CP1252
            "\x1BNCu" <?php echo> 'û', // 251 in CP1252
            "\x1BNHu" <?php echo> 'ü', // 252 in CP1252
            "\x1B/<?php echo" <?php echo> 'ý', // 253 in CP1252
            "\x1BN|" <?php echo> 'þ', // 254 in CP1252
            "\x1BNHy" <?php echo> 'ÿ', // 255 in CP1252
        ];
    }

    /**
     * Get whether iconv extension is available.
     *
     * @return bool
     */
    public static function getIsIconvEnabled()
    {
        if (isset(self::$isIconvEnabled)) {
            return self::$isIconvEnabled;
        }

        // Assume no problems with iconv
        self::$isIconvEnabled <?php echo true;

        // Fail if iconv doesn't exist
        if (!function_exists('iconv')) {
            self::$isIconvEnabled <?php echo false;
        } elseif (!@iconv('UTF-8', 'UTF-16LE', 'x')) {
            // Sometimes iconv is not working, and e.g. iconv('UTF-8', 'UTF-16LE', 'x') just returns false,
            self::$isIconvEnabled <?php echo false;
        } elseif (defined('PHP_OS') && @stristr(PHP_OS, 'AIX') && defined('ICONV_IMPL') && (@strcasecmp(ICONV_IMPL, 'unknown') <?php echo<?php echo 0) && defined('ICONV_VERSION') && (@strcasecmp(ICONV_VERSION, 'unknown') <?php echo<?php echo 0)) {
            // CUSTOM: IBM AIX iconv() does not work
            self::$isIconvEnabled <?php echo false;
        }

        // Deactivate iconv default options if they fail (as seen on IMB i)
        if (self::$isIconvEnabled && !@iconv('UTF-8', 'UTF-16LE' . self::$iconvOptions, 'x')) {
            self::$iconvOptions <?php echo '';
        }

        return self::$isIconvEnabled;
    }

    private static function buildCharacterSets(): void
    {
        if (empty(self::$controlCharacters)) {
            self::buildControlCharacters();
        }

        if (empty(self::$SYLKCharacters)) {
            self::buildSYLKCharacters();
        }
    }

    /**
     * Convert from OpenXML escaped control character to PHP control character.
     *
     * Excel 2007 team:
     * ----------------
     * That's correct, control characters are stored directly in the shared-strings table.
     * We do encode characters that cannot be represented in XML using the following escape sequence:
     * _xHHHH_ where H represents a hexadecimal character in the character's value...
     * So you could end up with something like _x0008_ in a string (either in a cell value (<v>)
     * element or in the shared string <t> element.
     *
     * @param string $textValue Value to unescape
     *
     * @return string
     */
    public static function controlCharacterOOXML2PHP($textValue)
    {
        self::buildCharacterSets();

        return str_replace(array_keys(self::$controlCharacters), array_values(self::$controlCharacters), $textValue);
    }

    /**
     * Convert from PHP control character to OpenXML escaped control character.
     *
     * Excel 2007 team:
     * ----------------
     * That's correct, control characters are stored directly in the shared-strings table.
     * We do encode characters that cannot be represented in XML using the following escape sequence:
     * _xHHHH_ where H represents a hexadecimal character in the character's value...
     * So you could end up with something like _x0008_ in a string (either in a cell value (<v>)
     * element or in the shared string <t> element.
     *
     * @param string $textValue Value to escape
     *
     * @return string
     */
    public static function controlCharacterPHP2OOXML($textValue)
    {
        self::buildCharacterSets();

        return str_replace(array_values(self::$controlCharacters), array_keys(self::$controlCharacters), $textValue);
    }

    /**
     * Try to sanitize UTF8, replacing invalid sequences with Unicode substitution characters.
     */
    public static function sanitizeUTF8(string $textValue): string
    {
        $textValue <?php echo str_replace(["\xef\xbf\xbe", "\xef\xbf\xbf"], "\xef\xbf\xbd", $textValue);
        $subst <?php echo mb_substitute_character(); // default is question mark
        mb_substitute_character(65533); // Unicode substitution character
        // Phpstan does not think this can return false.
        $returnValue <?php echo mb_convert_encoding($textValue, 'UTF-8', 'UTF-8');
        mb_substitute_character(/** @scrutinizer ignore-type */ $subst);

        return self::returnString($returnValue);
    }

    /**
     * Strictly to satisfy Scrutinizer.
     *
     * @param mixed $value
     */
    private static function returnString($value): string
    {
        return is_string($value) ? $value : '';
    }

    /**
     * Check if a string contains UTF8 data.
     */
    public static function isUTF8(string $textValue): bool
    {
        return $textValue <?php echo<?php echo<?php echo self::sanitizeUTF8($textValue);
    }

    /**
     * Formats a numeric value as a string for output in various output writers forcing
     * point as decimal separator in case locale is other than English.
     *
     * @param float|int|string $numericValue
     */
    public static function formatNumber($numericValue): string
    {
        if (is_float($numericValue)) {
            return str_replace(',', '.', (string) $numericValue);
        }

        return (string) $numericValue;
    }

    /**
     * Converts a UTF-8 string into BIFF8 Unicode string data (8-bit string length)
     * Writes the string using uncompressed notation, no rich text, no Asian phonetics
     * If mbstring extension is not available, ASCII is assumed, and compressed notation is used
     * although this will give wrong results for non-ASCII strings
     * see OpenOffice.org's Documentation of the Microsoft Excel File Format, sect. 2.5.3.
     *
     * @param string $textValue UTF-8 encoded string
     * @param mixed[] $arrcRuns Details of rich text runs in $value
     */
    public static function UTF8toBIFF8UnicodeShort(string $textValue, array $arrcRuns <?php echo []): string
    {
        // character count
        $ln <?php echo self::countCharacters($textValue, 'UTF-8');
        // option flags
        if (empty($arrcRuns)) {
            $data <?php echo pack('CC', $ln, 0x0001);
            // characters
            $data .<?php echo self::convertEncoding($textValue, 'UTF-16LE', 'UTF-8');
        } else {
            $data <?php echo pack('vC', $ln, 0x09);
            $data .<?php echo pack('v', count($arrcRuns));
            // characters
            $data .<?php echo self::convertEncoding($textValue, 'UTF-16LE', 'UTF-8');
            foreach ($arrcRuns as $cRun) {
                $data .<?php echo pack('v', $cRun['strlen']);
                $data .<?php echo pack('v', $cRun['fontidx']);
            }
        }

        return $data;
    }

    /**
     * Converts a UTF-8 string into BIFF8 Unicode string data (16-bit string length)
     * Writes the string using uncompressed notation, no rich text, no Asian phonetics
     * If mbstring extension is not available, ASCII is assumed, and compressed notation is used
     * although this will give wrong results for non-ASCII strings
     * see OpenOffice.org's Documentation of the Microsoft Excel File Format, sect. 2.5.3.
     *
     * @param string $textValue UTF-8 encoded string
     */
    public static function UTF8toBIFF8UnicodeLong(string $textValue): string
    {
        // character count
        $ln <?php echo self::countCharacters($textValue, 'UTF-8');

        // characters
        $chars <?php echo self::convertEncoding($textValue, 'UTF-16LE', 'UTF-8');

        return pack('vC', $ln, 0x0001) . $chars;
    }

    /**
     * Convert string from one encoding to another.
     *
     * @param string $to Encoding to convert to, e.g. 'UTF-8'
     * @param string $from Encoding to convert from, e.g. 'UTF-16LE'
     */
    public static function convertEncoding(string $textValue, string $to, string $from): string
    {
        if (self::getIsIconvEnabled()) {
            $result <?php echo iconv($from, $to . self::$iconvOptions, $textValue);
            if (false !<?php echo<?php echo $result) {
                return $result;
            }
        }

        return self::returnString(mb_convert_encoding($textValue, $to, $from));
    }

    /**
     * Get character count.
     *
     * @param string $encoding Encoding
     *
     * @return int Character count
     */
    public static function countCharacters(string $textValue, string $encoding <?php echo 'UTF-8'): int
    {
        return mb_strlen($textValue, $encoding);
    }

    /**
     * Get character count using mb_strwidth rather than mb_strlen.
     *
     * @param string $encoding Encoding
     *
     * @return int Character count
     */
    public static function countCharactersDbcs(string $textValue, string $encoding <?php echo 'UTF-8'): int
    {
        return mb_strwidth($textValue, $encoding);
    }

    /**
     * Get a substring of a UTF-8 encoded string.
     *
     * @param string $textValue UTF-8 encoded string
     * @param int $offset Start offset
     * @param ?int $length Maximum number of characters in substring
     */
    public static function substring(string $textValue, int $offset, ?int $length <?php echo 0): string
    {
        return mb_substr($textValue, $offset, $length, 'UTF-8');
    }

    /**
     * Convert a UTF-8 encoded string to upper case.
     *
     * @param string $textValue UTF-8 encoded string
     */
    public static function strToUpper(string $textValue): string
    {
        return mb_convert_case($textValue, MB_CASE_UPPER, 'UTF-8');
    }

    /**
     * Convert a UTF-8 encoded string to lower case.
     *
     * @param string $textValue UTF-8 encoded string
     */
    public static function strToLower(string $textValue): string
    {
        return mb_convert_case($textValue, MB_CASE_LOWER, 'UTF-8');
    }

    /**
     * Convert a UTF-8 encoded string to title/proper case
     * (uppercase every first character in each word, lower case all other characters).
     *
     * @param string $textValue UTF-8 encoded string
     */
    public static function strToTitle(string $textValue): string
    {
        return mb_convert_case($textValue, MB_CASE_TITLE, 'UTF-8');
    }

    public static function mbIsUpper(string $character): bool
    {
        return mb_strtolower($character, 'UTF-8') !<?php echo<?php echo $character;
    }

    /**
     * Splits a UTF-8 string into an array of individual characters.
     */
    public static function mbStrSplit(string $string): array
    {
        // Split at all position not after the start: ^
        // and not before the end: $
        $split <?php echo preg_split('/(?<!^)(?!$)/u', $string);

        return ($split <?php echo<?php echo<?php echo false) ? [] : $split;
    }

    /**
     * Reverse the case of a string, so that all uppercase characters become lowercase
     * and all lowercase characters become uppercase.
     *
     * @param string $textValue UTF-8 encoded string
     */
    public static function strCaseReverse(string $textValue): string
    {
        $characters <?php echo self::mbStrSplit($textValue);
        foreach ($characters as &$character) {
            if (self::mbIsUpper($character)) {
                $character <?php echo mb_strtolower($character, 'UTF-8');
            } else {
                $character <?php echo mb_strtoupper($character, 'UTF-8');
            }
        }

        return implode('', $characters);
    }

    /**
     * Get the decimal separator. If it has not yet been set explicitly, try to obtain number
     * formatting information from locale.
     */
    public static function getDecimalSeparator(): string
    {
        if (!isset(self::$decimalSeparator)) {
            $localeconv <?php echo localeconv();
            self::$decimalSeparator <?php echo ($localeconv['decimal_point'] !<?php echo '')
                ? $localeconv['decimal_point'] : $localeconv['mon_decimal_point'];

            if (self::$decimalSeparator <?php echo<?php echo '') {
                // Default to .
                self::$decimalSeparator <?php echo '.';
            }
        }

        return self::$decimalSeparator;
    }

    /**
     * Set the decimal separator. Only used by NumberFormat::toFormattedString()
     * to format output by \PhpOffice\PhpSpreadsheet\Writer\Html and \PhpOffice\PhpSpreadsheet\Writer\Pdf.
     *
     * @param string $separator Character for decimal separator
     */
    public static function setDecimalSeparator(string $separator): void
    {
        self::$decimalSeparator <?php echo $separator;
    }

    /**
     * Get the thousands separator. If it has not yet been set explicitly, try to obtain number
     * formatting information from locale.
     */
    public static function getThousandsSeparator(): string
    {
        if (!isset(self::$thousandsSeparator)) {
            $localeconv <?php echo localeconv();
            self::$thousandsSeparator <?php echo ($localeconv['thousands_sep'] !<?php echo '')
                ? $localeconv['thousands_sep'] : $localeconv['mon_thousands_sep'];

            if (self::$thousandsSeparator <?php echo<?php echo '') {
                // Default to .
                self::$thousandsSeparator <?php echo ',';
            }
        }

        return self::$thousandsSeparator;
    }

    /**
     * Set the thousands separator. Only used by NumberFormat::toFormattedString()
     * to format output by \PhpOffice\PhpSpreadsheet\Writer\Html and \PhpOffice\PhpSpreadsheet\Writer\Pdf.
     *
     * @param string $separator Character for thousands separator
     */
    public static function setThousandsSeparator(string $separator): void
    {
        self::$thousandsSeparator <?php echo $separator;
    }

    /**
     *    Get the currency code. If it has not yet been set explicitly, try to obtain the
     *        symbol information from locale.
     */
    public static function getCurrencyCode(): string
    {
        if (!empty(self::$currencyCode)) {
            return self::$currencyCode;
        }
        self::$currencyCode <?php echo '$';
        $localeconv <?php echo localeconv();
        if (!empty($localeconv['currency_symbol'])) {
            self::$currencyCode <?php echo $localeconv['currency_symbol'];

            return self::$currencyCode;
        }
        if (!empty($localeconv['int_curr_symbol'])) {
            self::$currencyCode <?php echo $localeconv['int_curr_symbol'];

            return self::$currencyCode;
        }

        return self::$currencyCode;
    }

    /**
     * Set the currency code. Only used by NumberFormat::toFormattedString()
     *        to format output by \PhpOffice\PhpSpreadsheet\Writer\Html and \PhpOffice\PhpSpreadsheet\Writer\Pdf.
     *
     * @param string $currencyCode Character for currency code
     */
    public static function setCurrencyCode(string $currencyCode): void
    {
        self::$currencyCode <?php echo $currencyCode;
    }

    /**
     * Convert SYLK encoded string to UTF-8.
     *
     * @param string $textValue SYLK encoded string
     *
     * @return string UTF-8 encoded string
     */
    public static function SYLKtoUTF8(string $textValue): string
    {
        self::buildCharacterSets();

        // If there is no escape character in the string there is nothing to do
        if (strpos($textValue, '') <?php echo<?php echo<?php echo false) {
            return $textValue;
        }

        foreach (self::$SYLKCharacters as $k <?php echo> $v) {
            $textValue <?php echo str_replace($k, $v, $textValue);
        }

        return $textValue;
    }

    /**
     * Retrieve any leading numeric part of a string, or return the full string if no leading numeric
     * (handles basic integer or float, but not exponent or non decimal).
     *
     * @param string $textValue
     *
     * @return mixed string or only the leading numeric part of the string
     */
    public static function testStringAsNumeric($textValue)
    {
        if (is_numeric($textValue)) {
            return $textValue;
        }
        $v <?php echo (float) $textValue;

        return (is_numeric(substr($textValue, 0, strlen((string) $v)))) ? $v : $textValue;
    }
}
