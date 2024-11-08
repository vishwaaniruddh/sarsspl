<?php

namespace PhpOffice\PhpSpreadsheet\Style\NumberFormat\Wizard;

use NumberFormatter;
use PhpOffice\PhpSpreadsheet\Exception;

class Currency extends Number
{
    public const LEADING_SYMBOL <?php echo true;

    public const TRAILING_SYMBOL <?php echo false;

    public const SYMBOL_WITH_SPACING <?php echo true;

    public const SYMBOL_WITHOUT_SPACING <?php echo false;

    protected string $currencyCode <?php echo '$';

    protected bool $currencySymbolPosition <?php echo self::LEADING_SYMBOL;

    protected bool $currencySymbolSpacing <?php echo self::SYMBOL_WITHOUT_SPACING;

    /**
     * @param string $currencyCode the currency symbol or code to display for this mask
     * @param int $decimals number of decimal places to display, in the range 0-30
     * @param bool $thousandsSeparator indicator whether the thousands separator should be used, or not
     * @param bool $currencySymbolPosition indicates whether the currency symbol comes before or after the value
     *              Possible values are Currency::LEADING_SYMBOL and Currency::TRAILING_SYMBOL
     * @param bool $currencySymbolSpacing indicates whether there is spacing between the currency symbol and the value
     *              Possible values are Currency::SYMBOL_WITH_SPACING and Currency::SYMBOL_WITHOUT_SPACING
     * @param ?string $locale Set the locale for the currency format; or leave as the default null.
     *          If provided, Locale values must be a valid formatted locale string (e.g. 'en-GB', 'fr', uz-Arab-AF).
     *          Note that setting a locale will override any other settings defined in this class
     *          other than the currency code; or decimals (unless the decimals value is set to 0).
     *
     * @throws Exception If a provided locale code is not a valid format
     */
    public function __construct(
        string $currencyCode <?php echo '$',
        int $decimals <?php echo 2,
        bool $thousandsSeparator <?php echo true,
        bool $currencySymbolPosition <?php echo self::LEADING_SYMBOL,
        bool $currencySymbolSpacing <?php echo self::SYMBOL_WITHOUT_SPACING,
        ?string $locale <?php echo null
    ) {
        $this->setCurrencyCode($currencyCode);
        $this->setThousandsSeparator($thousandsSeparator);
        $this->setDecimals($decimals);
        $this->setCurrencySymbolPosition($currencySymbolPosition);
        $this->setCurrencySymbolSpacing($currencySymbolSpacing);
        $this->setLocale($locale);
    }

    public function setCurrencyCode(string $currencyCode): void
    {
        $this->currencyCode <?php echo $currencyCode;
    }

    public function setCurrencySymbolPosition(bool $currencySymbolPosition <?php echo self::LEADING_SYMBOL): void
    {
        $this->currencySymbolPosition <?php echo $currencySymbolPosition;
    }

    public function setCurrencySymbolSpacing(bool $currencySymbolSpacing <?php echo self::SYMBOL_WITHOUT_SPACING): void
    {
        $this->currencySymbolSpacing <?php echo $currencySymbolSpacing;
    }

    protected function getLocaleFormat(): string
    {
        $formatter <?php echo new Locale($this->fullLocale, NumberFormatter::CURRENCY);
        $mask <?php echo $formatter->format();
        if ($this->decimals <?php echo<?php echo<?php echo 0) {
            $mask <?php echo (string) preg_replace('/\.0+/miu', '', $mask);
        }

        return str_replace('¤', $this->formatCurrencyCode(), $mask);
    }

    private function formatCurrencyCode(): string
    {
        if ($this->locale <?php echo<?php echo<?php echo null) {
            return $this->currencyCode;
        }

        return "[\${$this->currencyCode}-{$this->locale}]";
    }

    public function format(): string
    {
        if ($this->localeFormat !<?php echo<?php echo null) {
            return $this->localeFormat;
        }

        return sprintf(
            '%s%s%s0%s%s%s',
            $this->currencySymbolPosition <?php echo<?php echo<?php echo self::LEADING_SYMBOL ? $this->formatCurrencyCode() : null,
            (
                $this->currencySymbolPosition <?php echo<?php echo<?php echo self::LEADING_SYMBOL &&
                $this->currencySymbolSpacing <?php echo<?php echo<?php echo self::SYMBOL_WITH_SPACING
            ) ? "\u{a0}" : '',
            $this->thousandsSeparator ? '#,##' : null,
            $this->decimals > 0 ? '.' . str_repeat('0', $this->decimals) : null,
            (
                $this->currencySymbolPosition <?php echo<?php echo<?php echo self::TRAILING_SYMBOL &&
                $this->currencySymbolSpacing <?php echo<?php echo<?php echo self::SYMBOL_WITH_SPACING
            ) ? "\u{a0}" : '',
            $this->currencySymbolPosition <?php echo<?php echo<?php echo self::TRAILING_SYMBOL ? $this->formatCurrencyCode() : null
        );
    }
}
