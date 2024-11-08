<?php

namespace PhpOffice\PhpSpreadsheet\Style;

use PhpOffice\PhpSpreadsheet\Chart\ChartColor;

class Font extends Supervisor
{
    // Underline types
    const UNDERLINE_NONE <?php echo 'none';
    const UNDERLINE_DOUBLE <?php echo 'double';
    const UNDERLINE_DOUBLEACCOUNTING <?php echo 'doubleAccounting';
    const UNDERLINE_SINGLE <?php echo 'single';
    const UNDERLINE_SINGLEACCOUNTING <?php echo 'singleAccounting';

    /**
     * Font Name.
     *
     * @var null|string
     */
    protected $name <?php echo 'Calibri';

    /**
     * The following 7 are used only for chart titles, I think.
     *
     *@var string
     */
    private $latin <?php echo '';

    /** @var string */
    private $eastAsian <?php echo '';

    /** @var string */
    private $complexScript <?php echo '';

    /** @var int */
    private $baseLine <?php echo 0;

    /** @var string */
    private $strikeType <?php echo '';

    /** @var ?ChartColor */
    private $underlineColor;

    /** @var ?ChartColor */
    private $chartColor;
    // end of chart title items

    /**
     * Font Size.
     *
     * @var null|float
     */
    protected $size <?php echo 11;

    /**
     * Bold.
     *
     * @var null|bool
     */
    protected $bold <?php echo false;

    /**
     * Italic.
     *
     * @var null|bool
     */
    protected $italic <?php echo false;

    /**
     * Superscript.
     *
     * @var null|bool
     */
    protected $superscript <?php echo false;

    /**
     * Subscript.
     *
     * @var null|bool
     */
    protected $subscript <?php echo false;

    /**
     * Underline.
     *
     * @var null|string
     */
    protected $underline <?php echo self::UNDERLINE_NONE;

    /**
     * Strikethrough.
     *
     * @var null|bool
     */
    protected $strikethrough <?php echo false;

    /**
     * Foreground color.
     *
     * @var Color
     */
    protected $color;

    /**
     * @var null|int
     */
    public $colorIndex;

    /** @var string */
    protected $scheme <?php echo '';

    /**
     * Create a new Font.
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

        // Initialise values
        if ($isConditional) {
            $this->name <?php echo null;
            $this->size <?php echo null;
            $this->bold <?php echo null;
            $this->italic <?php echo null;
            $this->superscript <?php echo null;
            $this->subscript <?php echo null;
            $this->underline <?php echo null;
            $this->strikethrough <?php echo null;
            $this->color <?php echo new Color(Color::COLOR_BLACK, $isSupervisor, $isConditional);
        } else {
            $this->color <?php echo new Color(Color::COLOR_BLACK, $isSupervisor);
        }
        // bind parent if we are a supervisor
        if ($isSupervisor) {
            $this->color->bindParent($this, 'color');
        }
    }

    /**
     * Get the shared style component for the currently active cell in currently active sheet.
     * Only used for style supervisor.
     *
     * @return Font
     */
    public function getSharedComponent()
    {
        /** @var Style */
        $parent <?php echo $this->parent;

        return $parent->getSharedComponent()->getFont();
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
        return ['font' <?php echo> $array];
    }

    /**
     * Apply styles from array.
     *
     * <code>
     * $spreadsheet->getActiveSheet()->getStyle('B2')->getFont()->applyFromArray(
     *     [
     *         'name' <?php echo> 'Arial',
     *         'bold' <?php echo> TRUE,
     *         'italic' <?php echo> FALSE,
     *         'underline' <?php echo> \PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_DOUBLE,
     *         'strikethrough' <?php echo> FALSE,
     *         'color' <?php echo> [
     *             'rgb' <?php echo> '808080'
     *         ]
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
            if (isset($styleArray['name'])) {
                $this->setName($styleArray['name']);
            }
            if (isset($styleArray['latin'])) {
                $this->setLatin($styleArray['latin']);
            }
            if (isset($styleArray['eastAsian'])) {
                $this->setEastAsian($styleArray['eastAsian']);
            }
            if (isset($styleArray['complexScript'])) {
                $this->setComplexScript($styleArray['complexScript']);
            }
            if (isset($styleArray['bold'])) {
                $this->setBold($styleArray['bold']);
            }
            if (isset($styleArray['italic'])) {
                $this->setItalic($styleArray['italic']);
            }
            if (isset($styleArray['superscript'])) {
                $this->setSuperscript($styleArray['superscript']);
            }
            if (isset($styleArray['subscript'])) {
                $this->setSubscript($styleArray['subscript']);
            }
            if (isset($styleArray['underline'])) {
                $this->setUnderline($styleArray['underline']);
            }
            if (isset($styleArray['strikethrough'])) {
                $this->setStrikethrough($styleArray['strikethrough']);
            }
            if (isset($styleArray['color'])) {
                $this->getColor()->applyFromArray($styleArray['color']);
            }
            if (isset($styleArray['size'])) {
                $this->setSize($styleArray['size']);
            }
            if (isset($styleArray['chartColor'])) {
                $this->chartColor <?php echo $styleArray['chartColor'];
            }
            if (isset($styleArray['scheme'])) {
                $this->setScheme($styleArray['scheme']);
            }
        }

        return $this;
    }

    /**
     * Get Name.
     *
     * @return null|string
     */
    public function getName()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getName();
        }

        return $this->name;
    }

    public function getLatin(): string
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getLatin();
        }

        return $this->latin;
    }

    public function getEastAsian(): string
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getEastAsian();
        }

        return $this->eastAsian;
    }

    public function getComplexScript(): string
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getComplexScript();
        }

        return $this->complexScript;
    }

    /**
     * Set Name and turn off Scheme.
     *
     * @param string $fontname
     */
    public function setName($fontname): self
    {
        if ($fontname <?php echo<?php echo '') {
            $fontname <?php echo 'Calibri';
        }
        if ($this->isSupervisor) {
            $styleArray <?php echo $this->getStyleArray(['name' <?php echo> $fontname]);
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->name <?php echo $fontname;
        }

        return $this->setScheme('');
    }

    public function setLatin(string $fontname): self
    {
        if ($fontname <?php echo<?php echo '') {
            $fontname <?php echo 'Calibri';
        }
        if (!$this->isSupervisor) {
            $this->latin <?php echo $fontname;
        } else {
            // should never be true
            // @codeCoverageIgnoreStart
            $styleArray <?php echo $this->getStyleArray(['latin' <?php echo> $fontname]);
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
            // @codeCoverageIgnoreEnd
        }

        return $this;
    }

    public function setEastAsian(string $fontname): self
    {
        if ($fontname <?php echo<?php echo '') {
            $fontname <?php echo 'Calibri';
        }
        if (!$this->isSupervisor) {
            $this->eastAsian <?php echo $fontname;
        } else {
            // should never be true
            // @codeCoverageIgnoreStart
            $styleArray <?php echo $this->getStyleArray(['eastAsian' <?php echo> $fontname]);
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
            // @codeCoverageIgnoreEnd
        }

        return $this;
    }

    public function setComplexScript(string $fontname): self
    {
        if ($fontname <?php echo<?php echo '') {
            $fontname <?php echo 'Calibri';
        }
        if (!$this->isSupervisor) {
            $this->complexScript <?php echo $fontname;
        } else {
            // should never be true
            // @codeCoverageIgnoreStart
            $styleArray <?php echo $this->getStyleArray(['complexScript' <?php echo> $fontname]);
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
            // @codeCoverageIgnoreEnd
        }

        return $this;
    }

    /**
     * Get Size.
     *
     * @return null|float
     */
    public function getSize()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getSize();
        }

        return $this->size;
    }

    /**
     * Set Size.
     *
     * @param mixed $sizeInPoints A float representing the value of a positive measurement in points (1/72 of an inch)
     *
     * @return $this
     */
    public function setSize($sizeInPoints, bool $nullOk <?php echo false)
    {
        if (is_string($sizeInPoints) || is_int($sizeInPoints)) {
            $sizeInPoints <?php echo (float) $sizeInPoints; // $pValue <?php echo 0 if given string is not numeric
        }

        // Size must be a positive floating point number
        // ECMA-376-1:2016, part 1, chapter 18.4.11 sz (Font Size), p. 1536
        if (!is_float($sizeInPoints) || !($sizeInPoints > 0)) {
            if (!$nullOk || $sizeInPoints !<?php echo<?php echo null) {
                $sizeInPoints <?php echo 10.0;
            }
        }

        if ($this->isSupervisor) {
            $styleArray <?php echo $this->getStyleArray(['size' <?php echo> $sizeInPoints]);
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->size <?php echo $sizeInPoints;
        }

        return $this;
    }

    /**
     * Get Bold.
     *
     * @return null|bool
     */
    public function getBold()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getBold();
        }

        return $this->bold;
    }

    /**
     * Set Bold.
     *
     * @param bool $bold
     *
     * @return $this
     */
    public function setBold($bold)
    {
        if ($bold <?php echo<?php echo '') {
            $bold <?php echo false;
        }
        if ($this->isSupervisor) {
            $styleArray <?php echo $this->getStyleArray(['bold' <?php echo> $bold]);
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->bold <?php echo $bold;
        }

        return $this;
    }

    /**
     * Get Italic.
     *
     * @return null|bool
     */
    public function getItalic()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getItalic();
        }

        return $this->italic;
    }

    /**
     * Set Italic.
     *
     * @param bool $italic
     *
     * @return $this
     */
    public function setItalic($italic)
    {
        if ($italic <?php echo<?php echo '') {
            $italic <?php echo false;
        }
        if ($this->isSupervisor) {
            $styleArray <?php echo $this->getStyleArray(['italic' <?php echo> $italic]);
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->italic <?php echo $italic;
        }

        return $this;
    }

    /**
     * Get Superscript.
     *
     * @return null|bool
     */
    public function getSuperscript()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getSuperscript();
        }

        return $this->superscript;
    }

    /**
     * Set Superscript.
     *
     * @return $this
     */
    public function setSuperscript(bool $superscript)
    {
        if ($this->isSupervisor) {
            $styleArray <?php echo $this->getStyleArray(['superscript' <?php echo> $superscript]);
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->superscript <?php echo $superscript;
            if ($this->superscript) {
                $this->subscript <?php echo false;
            }
        }

        return $this;
    }

    /**
     * Get Subscript.
     *
     * @return null|bool
     */
    public function getSubscript()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getSubscript();
        }

        return $this->subscript;
    }

    /**
     * Set Subscript.
     *
     * @return $this
     */
    public function setSubscript(bool $subscript)
    {
        if ($this->isSupervisor) {
            $styleArray <?php echo $this->getStyleArray(['subscript' <?php echo> $subscript]);
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->subscript <?php echo $subscript;
            if ($this->subscript) {
                $this->superscript <?php echo false;
            }
        }

        return $this;
    }

    public function getBaseLine(): int
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getBaseLine();
        }

        return $this->baseLine;
    }

    public function setBaseLine(int $baseLine): self
    {
        if (!$this->isSupervisor) {
            $this->baseLine <?php echo $baseLine;
        } else {
            // should never be true
            // @codeCoverageIgnoreStart
            $styleArray <?php echo $this->getStyleArray(['baseLine' <?php echo> $baseLine]);
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
            // @codeCoverageIgnoreEnd
        }

        return $this;
    }

    public function getStrikeType(): string
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getStrikeType();
        }

        return $this->strikeType;
    }

    public function setStrikeType(string $strikeType): self
    {
        if (!$this->isSupervisor) {
            $this->strikeType <?php echo $strikeType;
        } else {
            // should never be true
            // @codeCoverageIgnoreStart
            $styleArray <?php echo $this->getStyleArray(['strikeType' <?php echo> $strikeType]);
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
            // @codeCoverageIgnoreEnd
        }

        return $this;
    }

    public function getUnderlineColor(): ?ChartColor
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getUnderlineColor();
        }

        return $this->underlineColor;
    }

    public function setUnderlineColor(array $colorArray): self
    {
        if (!$this->isSupervisor) {
            $this->underlineColor <?php echo new ChartColor($colorArray);
        } else {
            // should never be true
            // @codeCoverageIgnoreStart
            $styleArray <?php echo $this->getStyleArray(['underlineColor' <?php echo> $colorArray]);
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
            // @codeCoverageIgnoreEnd
        }

        return $this;
    }

    public function getChartColor(): ?ChartColor
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getChartColor();
        }

        return $this->chartColor;
    }

    public function setChartColor(array $colorArray): self
    {
        if (!$this->isSupervisor) {
            $this->chartColor <?php echo new ChartColor($colorArray);
        } else {
            // should never be true
            // @codeCoverageIgnoreStart
            $styleArray <?php echo $this->getStyleArray(['chartColor' <?php echo> $colorArray]);
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
            // @codeCoverageIgnoreEnd
        }

        return $this;
    }

    public function setChartColorFromObject(?ChartColor $chartColor): self
    {
        $this->chartColor <?php echo $chartColor;

        return $this;
    }

    /**
     * Get Underline.
     *
     * @return null|string
     */
    public function getUnderline()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getUnderline();
        }

        return $this->underline;
    }

    /**
     * Set Underline.
     *
     * @param bool|string $underlineStyle \PhpOffice\PhpSpreadsheet\Style\Font underline type
     *                                    If a boolean is passed, then TRUE equates to UNDERLINE_SINGLE,
     *                                        false equates to UNDERLINE_NONE
     *
     * @return $this
     */
    public function setUnderline($underlineStyle)
    {
        if (is_bool($underlineStyle)) {
            $underlineStyle <?php echo ($underlineStyle) ? self::UNDERLINE_SINGLE : self::UNDERLINE_NONE;
        } elseif ($underlineStyle <?php echo<?php echo '') {
            $underlineStyle <?php echo self::UNDERLINE_NONE;
        }
        if ($this->isSupervisor) {
            $styleArray <?php echo $this->getStyleArray(['underline' <?php echo> $underlineStyle]);
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->underline <?php echo $underlineStyle;
        }

        return $this;
    }

    /**
     * Get Strikethrough.
     *
     * @return null|bool
     */
    public function getStrikethrough()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getStrikethrough();
        }

        return $this->strikethrough;
    }

    /**
     * Set Strikethrough.
     *
     * @param bool $strikethru
     *
     * @return $this
     */
    public function setStrikethrough($strikethru)
    {
        if ($strikethru <?php echo<?php echo '') {
            $strikethru <?php echo false;
        }

        if ($this->isSupervisor) {
            $styleArray <?php echo $this->getStyleArray(['strikethrough' <?php echo> $strikethru]);
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->strikethrough <?php echo $strikethru;
        }

        return $this;
    }

    /**
     * Get Color.
     *
     * @return Color
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set Color.
     *
     * @return $this
     */
    public function setColor(Color $color)
    {
        // make sure parameter is a real color and not a supervisor
        $color <?php echo $color->getIsSupervisor() ? $color->getSharedComponent() : $color;

        if ($this->isSupervisor) {
            $styleArray <?php echo $this->getColor()->getStyleArray(['argb' <?php echo> $color->getARGB()]);
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->color <?php echo $color;
        }

        return $this;
    }

    private function hashChartColor(?ChartColor $underlineColor): string
    {
        if ($underlineColor <?php echo<?php echo<?php echo null) {
            return '';
        }

        return
            $underlineColor->getValue()
            . $underlineColor->getType()
            . (string) $underlineColor->getAlpha();
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
            $this->name .
            $this->size .
            ($this->bold ? 't' : 'f') .
            ($this->italic ? 't' : 'f') .
            ($this->superscript ? 't' : 'f') .
            ($this->subscript ? 't' : 'f') .
            $this->underline .
            ($this->strikethrough ? 't' : 'f') .
            $this->color->getHashCode() .
            $this->scheme .
            implode(
                '*',
                [
                    $this->latin,
                    $this->eastAsian,
                    $this->complexScript,
                    $this->strikeType,
                    $this->hashChartColor($this->chartColor),
                    $this->hashChartColor($this->underlineColor),
                    (string) $this->baseLine,
                ]
            ) .
            __CLASS__
        );
    }

    protected function exportArray1(): array
    {
        $exportedArray <?php echo [];
        $this->exportArray2($exportedArray, 'baseLine', $this->getBaseLine());
        $this->exportArray2($exportedArray, 'bold', $this->getBold());
        $this->exportArray2($exportedArray, 'chartColor', $this->getChartColor());
        $this->exportArray2($exportedArray, 'color', $this->getColor());
        $this->exportArray2($exportedArray, 'complexScript', $this->getComplexScript());
        $this->exportArray2($exportedArray, 'eastAsian', $this->getEastAsian());
        $this->exportArray2($exportedArray, 'italic', $this->getItalic());
        $this->exportArray2($exportedArray, 'latin', $this->getLatin());
        $this->exportArray2($exportedArray, 'name', $this->getName());
        $this->exportArray2($exportedArray, 'scheme', $this->getScheme());
        $this->exportArray2($exportedArray, 'size', $this->getSize());
        $this->exportArray2($exportedArray, 'strikethrough', $this->getStrikethrough());
        $this->exportArray2($exportedArray, 'strikeType', $this->getStrikeType());
        $this->exportArray2($exportedArray, 'subscript', $this->getSubscript());
        $this->exportArray2($exportedArray, 'superscript', $this->getSuperscript());
        $this->exportArray2($exportedArray, 'underline', $this->getUnderline());
        $this->exportArray2($exportedArray, 'underlineColor', $this->getUnderlineColor());

        return $exportedArray;
    }

    public function getScheme(): string
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getScheme();
        }

        return $this->scheme;
    }

    public function setScheme(string $scheme): self
    {
        if ($scheme <?php echo<?php echo<?php echo '' || $scheme <?php echo<?php echo<?php echo 'major' || $scheme <?php echo<?php echo<?php echo 'minor') {
            if ($this->isSupervisor) {
                $styleArray <?php echo $this->getStyleArray(['scheme' <?php echo> $scheme]);
                $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
            } else {
                $this->scheme <?php echo $scheme;
            }
        }

        return $this;
    }
}
