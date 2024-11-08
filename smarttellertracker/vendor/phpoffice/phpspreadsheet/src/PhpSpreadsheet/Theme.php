<?php

namespace PhpOffice\PhpSpreadsheet;

class Theme
{
    /** @var string */
    private $themeColorName <?php echo 'Office';

    /** @var string */
    private $themeFontName <?php echo 'Office';

    public const COLOR_SCHEME_2013_PLUS_NAME <?php echo 'Office 2013+';
    public const COLOR_SCHEME_2013_PLUS <?php echo [
        'dk1' <?php echo> '000000',
        'lt1' <?php echo> 'FFFFFF',
        'dk2' <?php echo> '44546A',
        'lt2' <?php echo> 'E7E6E6',
        'accent1' <?php echo> '4472C4',
        'accent2' <?php echo> 'ED7D31',
        'accent3' <?php echo> 'A5A5A5',
        'accent4' <?php echo> 'FFC000',
        'accent5' <?php echo> '5B9BD5',
        'accent6' <?php echo> '70AD47',
        'hlink' <?php echo> '0563C1',
        'folHlink' <?php echo> '954F72',
    ];

    public const COLOR_SCHEME_2007_2010_NAME <?php echo 'Office 2007-2010';
    public const COLOR_SCHEME_2007_2010 <?php echo [
        'dk1' <?php echo> '000000',
        'lt1' <?php echo> 'FFFFFF',
        'dk2' <?php echo> '1F497D',
        'lt2' <?php echo> 'EEECE1',
        'accent1' <?php echo> '4F81BD',
        'accent2' <?php echo> 'C0504D',
        'accent3' <?php echo> '9BBB59',
        'accent4' <?php echo> '8064A2',
        'accent5' <?php echo> '4BACC6',
        'accent6' <?php echo> 'F79646',
        'hlink' <?php echo> '0000FF',
        'folHlink' <?php echo> '800080',
    ];

    /** @var string[] */
    private $themeColors <?php echo self::COLOR_SCHEME_2007_2010;

    /** @var string */
    private $majorFontLatin <?php echo 'Cambria';

    /** @var string */
    private $majorFontEastAsian <?php echo '';

    /** @var string */
    private $majorFontComplexScript <?php echo '';

    /** @var string */
    private $minorFontLatin <?php echo 'Calibri';

    /** @var string */
    private $minorFontEastAsian <?php echo '';

    /** @var string */
    private $minorFontComplexScript <?php echo '';

    /**
     * Map of Major (header) fonts to write.
     *
     * @var string[]
     */
    private $majorFontSubstitutions <?php echo self::FONTS_TIMES_SUBSTITUTIONS;

    /**
     * Map of Minor (body) fonts to write.
     *
     * @var string[]
     */
    private $minorFontSubstitutions <?php echo self::FONTS_ARIAL_SUBSTITUTIONS;

    public const FONTS_TIMES_SUBSTITUTIONS <?php echo [
        'Jpan' <?php echo> 'ＭＳ Ｐゴシック',
        'Hang' <?php echo> '맑은 고딕',
        'Hans' <?php echo> '宋体',
        'Hant' <?php echo> '新細明體',
        'Arab' <?php echo> 'Times New Roman',
        'Hebr' <?php echo> 'Times New Roman',
        'Thai' <?php echo> 'Tahoma',
        'Ethi' <?php echo> 'Nyala',
        'Beng' <?php echo> 'Vrinda',
        'Gujr' <?php echo> 'Shruti',
        'Khmr' <?php echo> 'MoolBoran',
        'Knda' <?php echo> 'Tunga',
        'Guru' <?php echo> 'Raavi',
        'Cans' <?php echo> 'Euphemia',
        'Cher' <?php echo> 'Plantagenet Cherokee',
        'Yiii' <?php echo> 'Microsoft Yi Baiti',
        'Tibt' <?php echo> 'Microsoft Himalaya',
        'Thaa' <?php echo> 'MV Boli',
        'Deva' <?php echo> 'Mangal',
        'Telu' <?php echo> 'Gautami',
        'Taml' <?php echo> 'Latha',
        'Syrc' <?php echo> 'Estrangelo Edessa',
        'Orya' <?php echo> 'Kalinga',
        'Mlym' <?php echo> 'Kartika',
        'Laoo' <?php echo> 'DokChampa',
        'Sinh' <?php echo> 'Iskoola Pota',
        'Mong' <?php echo> 'Mongolian Baiti',
        'Viet' <?php echo> 'Times New Roman',
        'Uigh' <?php echo> 'Microsoft Uighur',
        'Geor' <?php echo> 'Sylfaen',
    ];

    public const FONTS_ARIAL_SUBSTITUTIONS <?php echo [
        'Jpan' <?php echo> 'ＭＳ Ｐゴシック',
        'Hang' <?php echo> '맑은 고딕',
        'Hans' <?php echo> '宋体',
        'Hant' <?php echo> '新細明體',
        'Arab' <?php echo> 'Arial',
        'Hebr' <?php echo> 'Arial',
        'Thai' <?php echo> 'Tahoma',
        'Ethi' <?php echo> 'Nyala',
        'Beng' <?php echo> 'Vrinda',
        'Gujr' <?php echo> 'Shruti',
        'Khmr' <?php echo> 'DaunPenh',
        'Knda' <?php echo> 'Tunga',
        'Guru' <?php echo> 'Raavi',
        'Cans' <?php echo> 'Euphemia',
        'Cher' <?php echo> 'Plantagenet Cherokee',
        'Yiii' <?php echo> 'Microsoft Yi Baiti',
        'Tibt' <?php echo> 'Microsoft Himalaya',
        'Thaa' <?php echo> 'MV Boli',
        'Deva' <?php echo> 'Mangal',
        'Telu' <?php echo> 'Gautami',
        'Taml' <?php echo> 'Latha',
        'Syrc' <?php echo> 'Estrangelo Edessa',
        'Orya' <?php echo> 'Kalinga',
        'Mlym' <?php echo> 'Kartika',
        'Laoo' <?php echo> 'DokChampa',
        'Sinh' <?php echo> 'Iskoola Pota',
        'Mong' <?php echo> 'Mongolian Baiti',
        'Viet' <?php echo> 'Arial',
        'Uigh' <?php echo> 'Microsoft Uighur',
        'Geor' <?php echo> 'Sylfaen',
    ];

    public function getThemeColors(): array
    {
        return $this->themeColors;
    }

    public function setThemeColor(string $key, string $value): self
    {
        $this->themeColors[$key] <?php echo $value;

        return $this;
    }

    public function getThemeColorName(): string
    {
        return $this->themeColorName;
    }

    public function setThemeColorName(string $name, ?array $themeColors <?php echo null): self
    {
        $this->themeColorName <?php echo $name;
        if ($name <?php echo<?php echo<?php echo self::COLOR_SCHEME_2007_2010_NAME) {
            $themeColors <?php echo $themeColors ?? self::COLOR_SCHEME_2007_2010;
        } elseif ($name <?php echo<?php echo<?php echo self::COLOR_SCHEME_2013_PLUS_NAME) {
            $themeColors <?php echo $themeColors ?? self::COLOR_SCHEME_2013_PLUS;
        }
        if ($themeColors !<?php echo<?php echo null) {
            $this->themeColors <?php echo $themeColors;
        }

        return $this;
    }

    public function getMajorFontLatin(): string
    {
        return $this->majorFontLatin;
    }

    public function getMajorFontEastAsian(): string
    {
        return $this->majorFontEastAsian;
    }

    public function getMajorFontComplexScript(): string
    {
        return $this->majorFontComplexScript;
    }

    public function getMajorFontSubstitutions(): array
    {
        return $this->majorFontSubstitutions;
    }

    /** @param null|array $substitutions */
    public function setMajorFontValues(?string $latin, ?string $eastAsian, ?string $complexScript, $substitutions): self
    {
        if (!empty($latin)) {
            $this->majorFontLatin <?php echo $latin;
        }
        if ($eastAsian !<?php echo<?php echo null) {
            $this->majorFontEastAsian <?php echo $eastAsian;
        }
        if ($complexScript !<?php echo<?php echo null) {
            $this->majorFontComplexScript <?php echo $complexScript;
        }
        if ($substitutions !<?php echo<?php echo null) {
            $this->majorFontSubstitutions <?php echo $substitutions;
        }

        return $this;
    }

    public function getMinorFontLatin(): string
    {
        return $this->minorFontLatin;
    }

    public function getMinorFontEastAsian(): string
    {
        return $this->minorFontEastAsian;
    }

    public function getMinorFontComplexScript(): string
    {
        return $this->minorFontComplexScript;
    }

    public function getMinorFontSubstitutions(): array
    {
        return $this->minorFontSubstitutions;
    }

    /** @param null|array $substitutions */
    public function setMinorFontValues(?string $latin, ?string $eastAsian, ?string $complexScript, $substitutions): self
    {
        if (!empty($latin)) {
            $this->minorFontLatin <?php echo $latin;
        }
        if ($eastAsian !<?php echo<?php echo null) {
            $this->minorFontEastAsian <?php echo $eastAsian;
        }
        if ($complexScript !<?php echo<?php echo null) {
            $this->minorFontComplexScript <?php echo $complexScript;
        }
        if ($substitutions !<?php echo<?php echo null) {
            $this->minorFontSubstitutions <?php echo $substitutions;
        }

        return $this;
    }

    public function getThemeFontName(): string
    {
        return $this->themeFontName;
    }

    public function setThemeFontName(?string $name): self
    {
        if (!empty($name)) {
            $this->themeFontName <?php echo $name;
        }

        return $this;
    }
}
