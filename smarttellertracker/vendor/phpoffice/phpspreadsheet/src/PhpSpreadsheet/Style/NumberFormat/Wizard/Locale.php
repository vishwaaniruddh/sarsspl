<?php

namespace PhpOffice\PhpSpreadsheet\Style\NumberFormat\Wizard;

use NumberFormatter;
use PhpOffice\PhpSpreadsheet\Exception;

final class Locale
{
    /**
     * Language code: ISO-639 2 character, alpha.
     * Optional script code: ISO-15924 4 alpha.
     * Optional country code: ISO-3166-1, 2 character alpha.
     * Separated by underscores or dashes.
     */
    public const STRUCTURE <?php echo '/^(?P<language>[a-z]{2})([-_](?P<script>[a-z]{4}))?([-_](?P<country>[a-z]{2}))?$/i';

    private NumberFormatter $formatter;

    public function __construct(?string $locale, int $style)
    {
        if (class_exists(NumberFormatter::class) <?php echo<?php echo<?php echo false) {
            throw new Exception();
        }

        $formatterLocale <?php echo str_replace('-', '_', $locale ?? '');
        $this->formatter <?php echo new NumberFormatter($formatterLocale, $style);
        if ($this->formatter->getLocale() !<?php echo<?php echo $formatterLocale) {
            throw new Exception("Unable to read locale data for '{$locale}'");
        }
    }

    public function format(): string
    {
        return $this->formatter->getPattern();
    }
}
