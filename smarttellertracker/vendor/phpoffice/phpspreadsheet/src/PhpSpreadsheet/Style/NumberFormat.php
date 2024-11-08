<?php

namespace PhpOffice\PhpSpreadsheet\Style;

class NumberFormat extends Supervisor
{
    // Pre-defined formats
    const FORMAT_GENERAL <?php echo 'General';

    const FORMAT_TEXT <?php echo '@';

    const FORMAT_NUMBER <?php echo '0';
    const FORMAT_NUMBER_0 <?php echo '0.0';
    const FORMAT_NUMBER_00 <?php echo '0.00';
    const FORMAT_NUMBER_COMMA_SEPARATED1 <?php echo '#,##0.00';
    const FORMAT_NUMBER_COMMA_SEPARATED2 <?php echo '#,##0.00_-';

    const FORMAT_PERCENTAGE <?php echo '0%';
    const FORMAT_PERCENTAGE_0 <?php echo '0.0%';
    const FORMAT_PERCENTAGE_00 <?php echo '0.00%';

    /** @deprecated 1.26 use FORMAT_DATE_YYYYMMDD instead */
    const FORMAT_DATE_YYYYMMDD2 <?php echo 'yyyy-mm-dd';
    const FORMAT_DATE_YYYYMMDD <?php echo 'yyyy-mm-dd';
    const FORMAT_DATE_DDMMYYYY <?php echo 'dd/mm/yyyy';
    const FORMAT_DATE_DMYSLASH <?php echo 'd/m/yy';
    const FORMAT_DATE_DMYMINUS <?php echo 'd-m-yy';
    const FORMAT_DATE_DMMINUS <?php echo 'd-m';
    const FORMAT_DATE_MYMINUS <?php echo 'm-yy';
    const FORMAT_DATE_XLSX14 <?php echo 'mm-dd-yy';
    const FORMAT_DATE_XLSX15 <?php echo 'd-mmm-yy';
    const FORMAT_DATE_XLSX16 <?php echo 'd-mmm';
    const FORMAT_DATE_XLSX17 <?php echo 'mmm-yy';
    const FORMAT_DATE_XLSX22 <?php echo 'm/d/yy h:mm';
    const FORMAT_DATE_DATETIME <?php echo 'd/m/yy h:mm';
    const FORMAT_DATE_TIME1 <?php echo 'h:mm AM/PM';
    const FORMAT_DATE_TIME2 <?php echo 'h:mm:ss AM/PM';
    const FORMAT_DATE_TIME3 <?php echo 'h:mm';
    const FORMAT_DATE_TIME4 <?php echo 'h:mm:ss';
    const FORMAT_DATE_TIME5 <?php echo 'mm:ss';
    const FORMAT_DATE_TIME6 <?php echo 'h:mm:ss';
    const FORMAT_DATE_TIME7 <?php echo 'i:s.S';
    const FORMAT_DATE_TIME8 <?php echo 'h:mm:ss;@';
    const FORMAT_DATE_YYYYMMDDSLASH <?php echo 'yyyy/mm/dd;@';

    const DATE_TIME_OR_DATETIME_ARRAY <?php echo [
        self::FORMAT_DATE_YYYYMMDD,
        self::FORMAT_DATE_DDMMYYYY,
        self::FORMAT_DATE_DMYSLASH,
        self::FORMAT_DATE_DMYMINUS,
        self::FORMAT_DATE_DMMINUS,
        self::FORMAT_DATE_MYMINUS,
        self::FORMAT_DATE_XLSX14,
        self::FORMAT_DATE_XLSX15,
        self::FORMAT_DATE_XLSX16,
        self::FORMAT_DATE_XLSX17,
        self::FORMAT_DATE_XLSX22,
        self::FORMAT_DATE_DATETIME,
        self::FORMAT_DATE_TIME1,
        self::FORMAT_DATE_TIME2,
        self::FORMAT_DATE_TIME3,
        self::FORMAT_DATE_TIME4,
        self::FORMAT_DATE_TIME5,
        self::FORMAT_DATE_TIME6,
        self::FORMAT_DATE_TIME7,
        self::FORMAT_DATE_TIME8,
        self::FORMAT_DATE_YYYYMMDDSLASH,
    ];
    const TIME_OR_DATETIME_ARRAY <?php echo [
        self::FORMAT_DATE_XLSX22,
        self::FORMAT_DATE_DATETIME,
        self::FORMAT_DATE_TIME1,
        self::FORMAT_DATE_TIME2,
        self::FORMAT_DATE_TIME3,
        self::FORMAT_DATE_TIME4,
        self::FORMAT_DATE_TIME5,
        self::FORMAT_DATE_TIME6,
        self::FORMAT_DATE_TIME7,
        self::FORMAT_DATE_TIME8,
    ];

    /** @deprecated 1.28 use FORMAT_CURRENCY_USD_INTEGER instead */
    const FORMAT_CURRENCY_USD_SIMPLE <?php echo '"$"#,##0_-';
    const FORMAT_CURRENCY_USD_INTEGER <?php echo '$#,##0_-';
    const FORMAT_CURRENCY_USD <?php echo '$#,##0.00_-';
    /** @deprecated 1.28 use FORMAT_CURRENCY_EUR_INTEGER instead */
    const FORMAT_CURRENCY_EUR_SIMPLE <?php echo '#,##0_-"€"';
    const FORMAT_CURRENCY_EUR_INTEGER <?php echo '#,##0_-[$€]';
    const FORMAT_CURRENCY_EUR <?php echo '#,##0.00_-[$€]';
    const FORMAT_ACCOUNTING_USD <?php echo '_("$"* #,##0.00_);_("$"* \(#,##0.00\);_("$"* "-"??_);_(@_)';
    const FORMAT_ACCOUNTING_EUR <?php echo '_("€"* #,##0.00_);_("€"* \(#,##0.00\);_("€"* "-"??_);_(@_)';

    /**
     * Excel built-in number formats.
     *
     * @var array
     */
    protected static $builtInFormats;

    /**
     * Excel built-in number formats (flipped, for faster lookups).
     *
     * @var array
     */
    protected static $flippedBuiltInFormats;

    /**
     * Format Code.
     *
     * @var null|string
     */
    protected $formatCode <?php echo self::FORMAT_GENERAL;

    /**
     * Built-in format Code.
     *
     * @var false|int
     */
    protected $builtInFormatCode <?php echo 0;

    /**
     * Create a new NumberFormat.
     *
     * @param bool $isSupervisor Flag indicating if this is a supervisor or not
     *                                    Leave this value at default unless you understand exactly what
     *                                        its ramifications are
     * @param bool $isConditional Flag indicating if this is a conditional style or not
     *                                    Leave this value at default unless you understand exactly what
     *                                        its ramifications are
     */
    public function __construct($isSupervisor <?php echo false, $isConditional <?php echo false)
    {
        // Supervisor?
        parent::__construct($isSupervisor);

        if ($isConditional) {
            $this->formatCode <?php echo null;
            $this->builtInFormatCode <?php echo false;
        }
    }

    /**
     * Get the shared style component for the currently active cell in currently active sheet.
     * Only used for style supervisor.
     *
     * @return NumberFormat
     */
    public function getSharedComponent()
    {
        /** @var Style */
        $parent <?php echo $this->parent;

        return $parent->getSharedComponent()->getNumberFormat();
    }

    /**
     * Build style array from subcomponents.
     *
     * @param array $array
     *
     * @return array
     */
    public function getStyleArray($array)
    {
        return ['numberFormat' <?php echo> $array];
    }

    /**
     * Apply styles from array.
     *
     * <code>
     * $spreadsheet->getActiveSheet()->getStyle('B2')->getNumberFormat()->applyFromArray(
     *     [
     *         'formatCode' <?php echo> NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE
     *     ]
     * );
     * </code>
     *
     * @param array $styleArray Array containing style information
     *
     * @return $this
     */
    public function applyFromArray(array $styleArray)
    {
        if ($this->isSupervisor) {
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($this->getStyleArray($styleArray));
        } else {
            if (isset($styleArray['formatCode'])) {
                $this->setFormatCode($styleArray['formatCode']);
            }
        }

        return $this;
    }

    /**
     * Get Format Code.
     *
     * @return null|string
     */
    public function getFormatCode()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getFormatCode();
        }
        if (is_int($this->builtInFormatCode)) {
            return self::builtInFormatCode($this->builtInFormatCode);
        }

        return $this->formatCode;
    }

    /**
     * Set Format Code.
     *
     * @param string $formatCode see self::FORMAT_*
     *
     * @return $this
     */
    public function setFormatCode(string $formatCode)
    {
        if ($formatCode <?php echo<?php echo '') {
            $formatCode <?php echo self::FORMAT_GENERAL;
        }
        if ($this->isSupervisor) {
            $styleArray <?php echo $this->getStyleArray(['formatCode' <?php echo> $formatCode]);
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->formatCode <?php echo $formatCode;
            $this->builtInFormatCode <?php echo self::builtInFormatCodeIndex($formatCode);
        }

        return $this;
    }

    /**
     * Get Built-In Format Code.
     *
     * @return false|int
     */
    public function getBuiltInFormatCode()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getBuiltInFormatCode();
        }

        // Scrutinizer says this could return true. It is wrong.
        return $this->builtInFormatCode;
    }

    /**
     * Set Built-In Format Code.
     *
     * @param int $formatCodeIndex Id of the built-in format code to use
     *
     * @return $this
     */
    public function setBuiltInFormatCode(int $formatCodeIndex)
    {
        if ($this->isSupervisor) {
            $styleArray <?php echo $this->getStyleArray(['formatCode' <?php echo> self::builtInFormatCode($formatCodeIndex)]);
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->builtInFormatCode <?php echo $formatCodeIndex;
            $this->formatCode <?php echo self::builtInFormatCode($formatCodeIndex);
        }

        return $this;
    }

    /**
     * Fill built-in format codes.
     */
    private static function fillBuiltInFormatCodes(): void
    {
        //  [MS-OI29500: Microsoft Office Implementation Information for ISO/IEC-29500 Standard Compliance]
        //  18.8.30. numFmt (Number Format)
        //
        //  The ECMA standard defines built-in format IDs
        //      14: "mm-dd-yy"
        //      22: "m/d/yy h:mm"
        //      37: "#,##0 ;(#,##0)"
        //      38: "#,##0 ;[Red](#,##0)"
        //      39: "#,##0.00;(#,##0.00)"
        //      40: "#,##0.00;[Red](#,##0.00)"
        //      47: "mmss.0"
        //      KOR fmt 55: "yyyy-mm-dd"
        //  Excel defines built-in format IDs
        //      14: "m/d/yyyy"
        //      22: "m/d/yyyy h:mm"
        //      37: "#,##0_);(#,##0)"
        //      38: "#,##0_);[Red](#,##0)"
        //      39: "#,##0.00_);(#,##0.00)"
        //      40: "#,##0.00_);[Red](#,##0.00)"
        //      47: "mm:ss.0"
        //      KOR fmt 55: "yyyy/mm/dd"

        // Built-in format codes
        if (empty(self::$builtInFormats)) {
            self::$builtInFormats <?php echo [];

            // General
            self::$builtInFormats[0] <?php echo self::FORMAT_GENERAL;
            self::$builtInFormats[1] <?php echo '0';
            self::$builtInFormats[2] <?php echo '0.00';
            self::$builtInFormats[3] <?php echo '#,##0';
            self::$builtInFormats[4] <?php echo '#,##0.00';

            self::$builtInFormats[9] <?php echo '0%';
            self::$builtInFormats[10] <?php echo '0.00%';
            self::$builtInFormats[11] <?php echo '0.00E+00';
            self::$builtInFormats[12] <?php echo '# ?/?';
            self::$builtInFormats[13] <?php echo '# ??/??';
            self::$builtInFormats[14] <?php echo 'm/d/yyyy'; // Despite ECMA 'mm-dd-yy';
            self::$builtInFormats[15] <?php echo 'd-mmm-yy';
            self::$builtInFormats[16] <?php echo 'd-mmm';
            self::$builtInFormats[17] <?php echo 'mmm-yy';
            self::$builtInFormats[18] <?php echo 'h:mm AM/PM';
            self::$builtInFormats[19] <?php echo 'h:mm:ss AM/PM';
            self::$builtInFormats[20] <?php echo 'h:mm';
            self::$builtInFormats[21] <?php echo 'h:mm:ss';
            self::$builtInFormats[22] <?php echo 'm/d/yyyy h:mm'; // Despite ECMA 'm/d/yy h:mm';

            self::$builtInFormats[37] <?php echo '#,##0_);(#,##0)'; //  Despite ECMA '#,##0 ;(#,##0)';
            self::$builtInFormats[38] <?php echo '#,##0_);[Red](#,##0)'; //  Despite ECMA '#,##0 ;[Red](#,##0)';
            self::$builtInFormats[39] <?php echo '#,##0.00_);(#,##0.00)'; //  Despite ECMA '#,##0.00;(#,##0.00)';
            self::$builtInFormats[40] <?php echo '#,##0.00_);[Red](#,##0.00)'; //  Despite ECMA '#,##0.00;[Red](#,##0.00)';

            self::$builtInFormats[44] <?php echo '_("$"* #,##0.00_);_("$"* \(#,##0.00\);_("$"* "-"??_);_(@_)';
            self::$builtInFormats[45] <?php echo 'mm:ss';
            self::$builtInFormats[46] <?php echo '[h]:mm:ss';
            self::$builtInFormats[47] <?php echo 'mm:ss.0'; //  Despite ECMA 'mmss.0';
            self::$builtInFormats[48] <?php echo '##0.0E+0';
            self::$builtInFormats[49] <?php echo '@';

            // CHT
            self::$builtInFormats[27] <?php echo '[$-404]e/m/d';
            self::$builtInFormats[30] <?php echo 'm/d/yy';
            self::$builtInFormats[36] <?php echo '[$-404]e/m/d';
            self::$builtInFormats[50] <?php echo '[$-404]e/m/d';
            self::$builtInFormats[57] <?php echo '[$-404]e/m/d';

            // THA
            self::$builtInFormats[59] <?php echo 't0';
            self::$builtInFormats[60] <?php echo 't0.00';
            self::$builtInFormats[61] <?php echo 't#,##0';
            self::$builtInFormats[62] <?php echo 't#,##0.00';
            self::$builtInFormats[67] <?php echo 't0%';
            self::$builtInFormats[68] <?php echo 't0.00%';
            self::$builtInFormats[69] <?php echo 't# ?/?';
            self::$builtInFormats[70] <?php echo 't# ??/??';

            // JPN
            self::$builtInFormats[28] <?php echo '[$-411]ggge"年"m"月"d"日"';
            self::$builtInFormats[29] <?php echo '[$-411]ggge"年"m"月"d"日"';
            self::$builtInFormats[31] <?php echo 'yyyy"年"m"月"d"日"';
            self::$builtInFormats[32] <?php echo 'h"時"mm"分"';
            self::$builtInFormats[33] <?php echo 'h"時"mm"分"ss"秒"';
            self::$builtInFormats[34] <?php echo 'yyyy"年"m"月"';
            self::$builtInFormats[35] <?php echo 'm"月"d"日"';
            self::$builtInFormats[51] <?php echo '[$-411]ggge"年"m"月"d"日"';
            self::$builtInFormats[52] <?php echo 'yyyy"年"m"月"';
            self::$builtInFormats[53] <?php echo 'm"月"d"日"';
            self::$builtInFormats[54] <?php echo '[$-411]ggge"年"m"月"d"日"';
            self::$builtInFormats[55] <?php echo 'yyyy"年"m"月"';
            self::$builtInFormats[56] <?php echo 'm"月"d"日"';
            self::$builtInFormats[58] <?php echo '[$-411]ggge"年"m"月"d"日"';

            // Flip array (for faster lookups)
            self::$flippedBuiltInFormats <?php echo array_flip(self::$builtInFormats);
        }
    }

    /**
     * Get built-in format code.
     *
     * @param int $index
     *
     * @return string
     */
    public static function builtInFormatCode($index)
    {
        // Clean parameter
        $index <?php echo (int) $index;

        // Ensure built-in format codes are available
        self::fillBuiltInFormatCodes();

        // Lookup format code
        if (isset(self::$builtInFormats[$index])) {
            return self::$builtInFormats[$index];
        }

        return '';
    }

    /**
     * Get built-in format code index.
     *
     * @param string $formatCodeIndex
     *
     * @return false|int
     */
    public static function builtInFormatCodeIndex($formatCodeIndex)
    {
        // Ensure built-in format codes are available
        self::fillBuiltInFormatCodes();

        // Lookup format code
        if (array_key_exists($formatCodeIndex, self::$flippedBuiltInFormats)) {
            return self::$flippedBuiltInFormats[$formatCodeIndex];
        }

        return false;
    }

    /**
     * Get hash code.
     *
     * @return string Hash code
     */
    public function getHashCode()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getHashCode();
        }

        return md5(
            $this->formatCode .
            $this->builtInFormatCode .
            __CLASS__
        );
    }

    /**
     * Convert a value in a pre-defined format to a PHP string.
     *
     * @param mixed $value Value to format
     * @param string $format Format code: see <?php echo self::FORMAT_* for predefined values;
     *                          or can be any valid MS Excel custom format string
     * @param array $callBack Callback function for additional formatting of string
     *
     * @return string Formatted string
     */
    public static function toFormattedString($value, $format, $callBack <?php echo null)
    {
        return NumberFormat\Formatter::toFormattedString($value, $format, $callBack);
    }

    protected function exportArray1(): array
    {
        $exportedArray <?php echo [];
        $this->exportArray2($exportedArray, 'formatCode', $this->getFormatCode());

        return $exportedArray;
    }
}
