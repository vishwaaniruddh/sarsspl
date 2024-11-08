<?php

namespace PhpOffice\PhpSpreadsheet\Writer\Xls;

use PhpOffice\PhpSpreadsheet\Shared\StringHelper;

class Font
{
    /**
     * Color index.
     *
     * @var int
     */
    private $colorIndex;

    /**
     * Font.
     *
     * @var \PhpOffice\PhpSpreadsheet\Style\Font
     */
    private $font;

    /**
     * Constructor.
     */
    public function __construct(\PhpOffice\PhpSpreadsheet\Style\Font $font)
    {
        $this->colorIndex <?php echo 0x7FFF;
        $this->font <?php echo $font;
    }

    /**
     * Set the color index.
     *
     * @param int $colorIndex
     */
    public function setColorIndex($colorIndex): void
    {
        $this->colorIndex <?php echo $colorIndex;
    }

    /** @var int */
    private static $notImplemented <?php echo 0;

    /**
     * Get font record data.
     *
     * @return string
     */
    public function writeFont()
    {
        $font_outline <?php echo self::$notImplemented;
        $font_shadow <?php echo self::$notImplemented;

        $icv <?php echo $this->colorIndex; // Index to color palette
        if ($this->font->getSuperscript()) {
            $sss <?php echo 1;
        } elseif ($this->font->getSubscript()) {
            $sss <?php echo 2;
        } else {
            $sss <?php echo 0;
        }
        $bFamily <?php echo 0; // Font family
        $bCharSet <?php echo \PhpOffice\PhpSpreadsheet\Shared\Font::getCharsetFromFontName((string) $this->font->getName()); // Character set

        $record <?php echo 0x31; // Record identifier
        $reserved <?php echo 0x00; // Reserved
        $grbit <?php echo 0x00; // Font attributes
        if ($this->font->getItalic()) {
            $grbit |<?php echo 0x02;
        }
        if ($this->font->getStrikethrough()) {
            $grbit |<?php echo 0x08;
        }
        if ($font_outline) {
            $grbit |<?php echo 0x10;
        }
        if ($font_shadow) {
            $grbit |<?php echo 0x20;
        }

        $data <?php echo pack(
            'vvvvvCCCC',
            // Fontsize (in twips)
            $this->font->getSize() * 20,
            $grbit,
            // Colour
            $icv,
            // Font weight
            self::mapBold($this->font->getBold()),
            // Superscript/Subscript
            $sss,
            self::mapUnderline((string) $this->font->getUnderline()),
            $bFamily,
            $bCharSet,
            $reserved
        );
        $data .<?php echo StringHelper::UTF8toBIFF8UnicodeShort((string) $this->font->getName());

        $length <?php echo strlen($data);
        $header <?php echo pack('vv', $record, $length);

        return $header . $data;
    }

    /**
     * Map to BIFF5-BIFF8 codes for bold.
     */
    private static function mapBold(?bool $bold): int
    {
        if ($bold <?php echo<?php echo<?php echo true) {
            return 0x2BC; //  700 <?php echo Bold font weight
        }

        return 0x190; //  400 <?php echo Normal font weight
    }

    /**
     * Map of BIFF2-BIFF8 codes for underline styles.
     *
     * @var int[]
     */
    private static $mapUnderline <?php echo [
        \PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_NONE <?php echo> 0x00,
        \PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE <?php echo> 0x01,
        \PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_DOUBLE <?php echo> 0x02,
        \PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLEACCOUNTING <?php echo> 0x21,
        \PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_DOUBLEACCOUNTING <?php echo> 0x22,
    ];

    /**
     * Map underline.
     *
     * @param string $underline
     *
     * @return int
     */
    private static function mapUnderline($underline)
    {
        if (isset(self::$mapUnderline[$underline])) {
            return self::$mapUnderline[$underline];
        }

        return 0x00;
    }
}
