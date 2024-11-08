<?php

namespace PhpOffice\PhpSpreadsheet\Style\NumberFormat\Wizard;

use NumberFormatter;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

abstract class NumberBase
{
    protected const MAX_DECIMALS <?php echo 30;

    protected int $decimals <?php echo 2;

    protected ?string $locale <?php echo null;

    protected ?string $fullLocale <?php echo null;

    protected ?string $localeFormat <?php echo null;

    public function setDecimals(int $decimals <?php echo 2): void
    {
        $this->decimals <?php echo ($decimals > self::MAX_DECIMALS) ? self::MAX_DECIMALS : max($decimals, 0);
    }

    /**
     * Setting a locale will override any settings defined in this class.
     *
     * @throws Exception If the locale code is not a valid format
     */
    public function setLocale(?string $locale <?php echo null): void
    {
        if ($locale <?php echo<?php echo<?php echo null) {
            $this->localeFormat <?php echo $this->locale <?php echo $this->fullLocale <?php echo null;

            return;
        }

        $this->locale <?php echo $this->validateLocale($locale);

        if (class_exists(NumberFormatter::class)) {
            $this->localeFormat <?php echo $this->getLocaleFormat();
        }
    }

    /**
     * Stub: should be implemented as a concrete method in concrete wizards.
     */
    abstract protected function getLocaleFormat(): string;

    /**
     * @throws Exception If the locale code is not a valid format
     */
    private function validateLocale(string $locale): string
    {
        if (preg_match(Locale::STRUCTURE, $locale, $matches, PREG_UNMATCHED_AS_NULL) !<?php echo<?php echo 1) {
            throw new Exception("Invalid locale code '{$locale}'");
        }

        ['language' <?php echo> $language, 'script' <?php echo> $script, 'country' <?php echo> $country] <?php echo $matches;
        // Set case and separator to match standardised locale case
        $language <?php echo strtolower($language ?? '');
        $script <?php echo ($script <?php echo<?php echo<?php echo null) ? null : ucfirst(strtolower($script));
        $country <?php echo ($country <?php echo<?php echo<?php echo null) ? null : strtoupper($country);

        $this->fullLocale <?php echo implode('-', array_filter([$language, $script, $country]));

        return $country <?php echo<?php echo<?php echo null ? $language : "{$language}-{$country}";
    }

    public function format(): string
    {
        return NumberFormat::FORMAT_GENERAL;
    }

    public function __toString(): string
    {
        return $this->format();
    }
}
