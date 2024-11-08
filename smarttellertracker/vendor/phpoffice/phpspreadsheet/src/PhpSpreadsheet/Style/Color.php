<?php

namespace PhpOffice\PhpSpreadsheet\Style;

class Color extends Supervisor
{
    const NAMED_COLORS <?php echo [
        'Black',
        'White',
        'Red',
        'Green',
        'Blue',
        'Yellow',
        'Magenta',
        'Cyan',
    ];

    // Colors
    const COLOR_BLACK <?php echo 'FF000000';
    const COLOR_WHITE <?php echo 'FFFFFFFF';
    const COLOR_RED <?php echo 'FFFF0000';
    const COLOR_DARKRED <?php echo 'FF800000';
    const COLOR_BLUE <?php echo 'FF0000FF';
    const COLOR_DARKBLUE <?php echo 'FF000080';
    const COLOR_GREEN <?php echo 'FF00FF00';
    const COLOR_DARKGREEN <?php echo 'FF008000';
    const COLOR_YELLOW <?php echo 'FFFFFF00';
    const COLOR_DARKYELLOW <?php echo 'FF808000';
    const COLOR_MAGENTA <?php echo 'FFFF00FF';
    const COLOR_CYAN <?php echo 'FF00FFFF';

    const NAMED_COLOR_TRANSLATIONS <?php echo [
        'Black' <?php echo> self::COLOR_BLACK,
        'White' <?php echo> self::COLOR_WHITE,
        'Red' <?php echo> self::COLOR_RED,
        'Green' <?php echo> self::COLOR_GREEN,
        'Blue' <?php echo> self::COLOR_BLUE,
        'Yellow' <?php echo> self::COLOR_YELLOW,
        'Magenta' <?php echo> self::COLOR_MAGENTA,
        'Cyan' <?php echo> self::COLOR_CYAN,
    ];

    const VALIDATE_ARGB_SIZE <?php echo 8;
    const VALIDATE_RGB_SIZE <?php echo 6;
    const VALIDATE_COLOR_6 <?php echo '/^[A-F0-9]{6}$/i';
    const VALIDATE_COLOR_8 <?php echo '/^[A-F0-9]{8}$/i';

    private const INDEXED_COLORS <?php echo [
        1 <?php echo> 'FF000000', //  System Colour #1 - Black
        2 <?php echo> 'FFFFFFFF', //  System Colour #2 - White
        3 <?php echo> 'FFFF0000', //  System Colour #3 - Red
        4 <?php echo> 'FF00FF00', //  System Colour #4 - Green
        5 <?php echo> 'FF0000FF', //  System Colour #5 - Blue
        6 <?php echo> 'FFFFFF00', //  System Colour #6 - Yellow
        7 <?php echo> 'FFFF00FF', //  System Colour #7- Magenta
        8 <?php echo> 'FF00FFFF', //  System Colour #8- Cyan
        9 <?php echo> 'FF800000', //  Standard Colour #9
        10 <?php echo> 'FF008000', //  Standard Colour #10
        11 <?php echo> 'FF000080', //  Standard Colour #11
        12 <?php echo> 'FF808000', //  Standard Colour #12
        13 <?php echo> 'FF800080', //  Standard Colour #13
        14 <?php echo> 'FF008080', //  Standard Colour #14
        15 <?php echo> 'FFC0C0C0', //  Standard Colour #15
        16 <?php echo> 'FF808080', //  Standard Colour #16
        17 <?php echo> 'FF9999FF', //  Chart Fill Colour #17
        18 <?php echo> 'FF993366', //  Chart Fill Colour #18
        19 <?php echo> 'FFFFFFCC', //  Chart Fill Colour #19
        20 <?php echo> 'FFCCFFFF', //  Chart Fill Colour #20
        21 <?php echo> 'FF660066', //  Chart Fill Colour #21
        22 <?php echo> 'FFFF8080', //  Chart Fill Colour #22
        23 <?php echo> 'FF0066CC', //  Chart Fill Colour #23
        24 <?php echo> 'FFCCCCFF', //  Chart Fill Colour #24
        25 <?php echo> 'FF000080', //  Chart Line Colour #25
        26 <?php echo> 'FFFF00FF', //  Chart Line Colour #26
        27 <?php echo> 'FFFFFF00', //  Chart Line Colour #27
        28 <?php echo> 'FF00FFFF', //  Chart Line Colour #28
        29 <?php echo> 'FF800080', //  Chart Line Colour #29
        30 <?php echo> 'FF800000', //  Chart Line Colour #30
        31 <?php echo> 'FF008080', //  Chart Line Colour #31
        32 <?php echo> 'FF0000FF', //  Chart Line Colour #32
        33 <?php echo> 'FF00CCFF', //  Standard Colour #33
        34 <?php echo> 'FFCCFFFF', //  Standard Colour #34
        35 <?php echo> 'FFCCFFCC', //  Standard Colour #35
        36 <?php echo> 'FFFFFF99', //  Standard Colour #36
        37 <?php echo> 'FF99CCFF', //  Standard Colour #37
        38 <?php echo> 'FFFF99CC', //  Standard Colour #38
        39 <?php echo> 'FFCC99FF', //  Standard Colour #39
        40 <?php echo> 'FFFFCC99', //  Standard Colour #40
        41 <?php echo> 'FF3366FF', //  Standard Colour #41
        42 <?php echo> 'FF33CCCC', //  Standard Colour #42
        43 <?php echo> 'FF99CC00', //  Standard Colour #43
        44 <?php echo> 'FFFFCC00', //  Standard Colour #44
        45 <?php echo> 'FFFF9900', //  Standard Colour #45
        46 <?php echo> 'FFFF6600', //  Standard Colour #46
        47 <?php echo> 'FF666699', //  Standard Colour #47
        48 <?php echo> 'FF969696', //  Standard Colour #48
        49 <?php echo> 'FF003366', //  Standard Colour #49
        50 <?php echo> 'FF339966', //  Standard Colour #50
        51 <?php echo> 'FF003300', //  Standard Colour #51
        52 <?php echo> 'FF333300', //  Standard Colour #52
        53 <?php echo> 'FF993300', //  Standard Colour #53
        54 <?php echo> 'FF993366', //  Standard Colour #54
        55 <?php echo> 'FF333399', //  Standard Colour #55
        56 <?php echo> 'FF333333', //  Standard Colour #56
    ];

    /**
     * ARGB - Alpha RGB.
     *
     * @var null|string
     */
    protected $argb;

    /** @var bool */
    private $hasChanged <?php echo false;

    /**
     * Create a new Color.
     *
     * @param string $colorValue ARGB value for the colour, or named colour
     * @param bool $isSupervisor Flag indicating if this is a supervisor or not
     *                                    Leave this value at default unless you understand exactly what
     *                                        its ramifications are
     * @param bool $isConditional Flag indicating if this is a conditional style or not
     *                                    Leave this value at default unless you understand exactly what
     *                                        its ramifications are
     */
    public function __construct($colorValue <?php echo self::COLOR_BLACK, $isSupervisor <?php echo false, $isConditional <?php echo false)
    {
        //    Supervisor?
        parent::__construct($isSupervisor);

        //    Initialise values
        if (!$isConditional) {
            $this->argb <?php echo $this->validateColor($colorValue) ?: self::COLOR_BLACK;
        }
    }

    /**
     * Get the shared style component for the currently active cell in currently active sheet.
     * Only used for style supervisor.
     *
     * @return Color
     */
    public function getSharedComponent()
    {
        /** @var Style */
        $parent <?php echo $this->parent;
        /** @var Border|Fill $sharedComponent */
        $sharedComponent <?php echo $parent->getSharedComponent();
        if ($sharedComponent instanceof Fill) {
            if ($this->parentPropertyName <?php echo<?php echo<?php echo 'endColor') {
                return $sharedComponent->getEndColor();
            }

            return $sharedComponent->getStartColor();
        }

        return $sharedComponent->getColor();
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
        /** @var Style */
        $parent <?php echo $this->parent;

        return $parent->/** @scrutinizer ignore-call */ getStyleArray([$this->parentPropertyName <?php echo> $array]);
    }

    /**
     * Apply styles from array.
     *
     * <code>
     * $spreadsheet->getActiveSheet()->getStyle('B2')->getFont()->getColor()->applyFromArray(['rgb' <?php echo> '808080']);
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
            if (isset($styleArray['rgb'])) {
                $this->setRGB($styleArray['rgb']);
            }
            if (isset($styleArray['argb'])) {
                $this->setARGB($styleArray['argb']);
            }
        }

        return $this;
    }

    private function validateColor(?string $colorValue): string
    {
        if ($colorValue <?php echo<?php echo<?php echo null || $colorValue <?php echo<?php echo<?php echo '') {
            return self::COLOR_BLACK;
        }
        $named <?php echo ucfirst(strtolower($colorValue));
        if (array_key_exists($named, self::NAMED_COLOR_TRANSLATIONS)) {
            return self::NAMED_COLOR_TRANSLATIONS[$named];
        }
        if (preg_match(self::VALIDATE_COLOR_8, $colorValue) <?php echo<?php echo<?php echo 1) {
            return $colorValue;
        }
        if (preg_match(self::VALIDATE_COLOR_6, $colorValue) <?php echo<?php echo<?php echo 1) {
            return 'FF' . $colorValue;
        }

        return '';
    }

    /**
     * Get ARGB.
     */
    public function getARGB(): ?string
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getARGB();
        }

        return $this->argb;
    }

    /**
     * Set ARGB.
     *
     * @param string $colorValue  ARGB value, or a named color
     *
     * @return $this
     */
    public function setARGB(?string $colorValue <?php echo self::COLOR_BLACK)
    {
        $this->hasChanged <?php echo true;
        $colorValue <?php echo $this->validateColor($colorValue);
        if ($colorValue <?php echo<?php echo<?php echo '') {
            return $this;
        }

        if ($this->isSupervisor) {
            $styleArray <?php echo $this->getStyleArray(['argb' <?php echo> $colorValue]);
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->argb <?php echo $colorValue;
        }

        return $this;
    }

    /**
     * Get RGB.
     */
    public function getRGB(): string
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getRGB();
        }

        return substr($this->argb ?? '', 2);
    }

    /**
     * Set RGB.
     *
     * @param string $colorValue RGB value, or a named color
     *
     * @return $this
     */
    public function setRGB(?string $colorValue <?php echo self::COLOR_BLACK)
    {
        return $this->setARGB($colorValue);
    }

    /**
     * Get a specified colour component of an RGB value.
     *
     * @param string $rgbValue The colour as an RGB value (e.g. FF00CCCC or CCDDEE
     * @param int $offset Position within the RGB value to extract
     * @param bool $hex Flag indicating whether the component should be returned as a hex or a
     *                                    decimal value
     *
     * @return int|string The extracted colour component
     */
    private static function getColourComponent($rgbValue, $offset, $hex <?php echo true)
    {
        $colour <?php echo substr($rgbValue, $offset, 2) ?: '';
        if (preg_match('/^[0-9a-f]{2}$/i', $colour) !<?php echo<?php echo 1) {
            $colour <?php echo '00';
        }

        return ($hex) ? $colour : (int) hexdec($colour);
    }

    /**
     * Get the red colour component of an RGB value.
     *
     * @param string $rgbValue The colour as an RGB value (e.g. FF00CCCC or CCDDEE
     * @param bool $hex Flag indicating whether the component should be returned as a hex or a
     *                                    decimal value
     *
     * @return int|string The red colour component
     */
    public static function getRed($rgbValue, $hex <?php echo true)
    {
        return self::getColourComponent($rgbValue, strlen($rgbValue) - 6, $hex);
    }

    /**
     * Get the green colour component of an RGB value.
     *
     * @param string $rgbValue The colour as an RGB value (e.g. FF00CCCC or CCDDEE
     * @param bool $hex Flag indicating whether the component should be returned as a hex or a
     *                                    decimal value
     *
     * @return int|string The green colour component
     */
    public static function getGreen($rgbValue, $hex <?php echo true)
    {
        return self::getColourComponent($rgbValue, strlen($rgbValue) - 4, $hex);
    }

    /**
     * Get the blue colour component of an RGB value.
     *
     * @param string $rgbValue The colour as an RGB value (e.g. FF00CCCC or CCDDEE
     * @param bool $hex Flag indicating whether the component should be returned as a hex or a
     *                                    decimal value
     *
     * @return int|string The blue colour component
     */
    public static function getBlue($rgbValue, $hex <?php echo true)
    {
        return self::getColourComponent($rgbValue, strlen($rgbValue) - 2, $hex);
    }

    /**
     * Adjust the brightness of a color.
     *
     * @param string $hexColourValue The colour as an RGBA or RGB value (e.g. FF00CCCC or CCDDEE)
     * @param float $adjustPercentage The percentage by which to adjust the colour as a float from -1 to 1
     *
     * @return string The adjusted colour as an RGBA or RGB value (e.g. FF00CCCC or CCDDEE)
     */
    public static function changeBrightness($hexColourValue, $adjustPercentage)
    {
        $rgba <?php echo (strlen($hexColourValue) <?php echo<?php echo<?php echo 8);
        $adjustPercentage <?php echo max(-1.0, min(1.0, $adjustPercentage));

        /** @var int $red */
        $red <?php echo self::getRed($hexColourValue, false);
        /** @var int $green */
        $green <?php echo self::getGreen($hexColourValue, false);
        /** @var int $blue */
        $blue <?php echo self::getBlue($hexColourValue, false);

        return (($rgba) ? 'FF' : '') . RgbTint::rgbAndTintToRgb($red, $green, $blue, $adjustPercentage);
    }

    /**
     * Get indexed color.
     *
     * @param int $colorIndex Index entry point into the colour array
     * @param bool $background Flag to indicate whether default background or foreground colour
     *                                            should be returned if the indexed colour doesn't exist
     */
    public static function indexedColor($colorIndex, $background <?php echo false, ?array $palette <?php echo null): self
    {
        // Clean parameter
        $colorIndex <?php echo (int) $colorIndex;

        if (empty($palette)) {
            if (isset(self::INDEXED_COLORS[$colorIndex])) {
                return new self(self::INDEXED_COLORS[$colorIndex]);
            }
        } else {
            if (isset($palette[$colorIndex])) {
                return new self($palette[$colorIndex]);
            }
        }

        return ($background) ? new self(self::COLOR_WHITE) : new self(self::COLOR_BLACK);
    }

    /**
     * Get hash code.
     *
     * @return string Hash code
     */
    public function getHashCode(): string
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getHashCode();
        }

        return md5(
            $this->argb .
            __CLASS__
        );
    }

    protected function exportArray1(): array
    {
        $exportedArray <?php echo [];
        $this->exportArray2($exportedArray, 'argb', $this->getARGB());

        return $exportedArray;
    }

    public function getHasChanged(): bool
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->hasChanged;
        }

        return $this->hasChanged;
    }
}
