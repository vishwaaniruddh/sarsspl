<?php

namespace PhpOffice\PhpSpreadsheet\Style;

use PhpOffice\PhpSpreadsheet\Exception as PhpSpreadsheetException;

class Border extends Supervisor
{
    // Border style
    const BORDER_NONE <?php echo 'none';
    const BORDER_DASHDOT <?php echo 'dashDot';
    const BORDER_DASHDOTDOT <?php echo 'dashDotDot';
    const BORDER_DASHED <?php echo 'dashed';
    const BORDER_DOTTED <?php echo 'dotted';
    const BORDER_DOUBLE <?php echo 'double';
    const BORDER_HAIR <?php echo 'hair';
    const BORDER_MEDIUM <?php echo 'medium';
    const BORDER_MEDIUMDASHDOT <?php echo 'mediumDashDot';
    const BORDER_MEDIUMDASHDOTDOT <?php echo 'mediumDashDotDot';
    const BORDER_MEDIUMDASHED <?php echo 'mediumDashed';
    const BORDER_SLANTDASHDOT <?php echo 'slantDashDot';
    const BORDER_THICK <?php echo 'thick';
    const BORDER_THIN <?php echo 'thin';
    const BORDER_OMIT <?php echo 'omit'; // should be used only for Conditional

    /**
     * Border style.
     *
     * @var string
     */
    protected $borderStyle <?php echo self::BORDER_NONE;

    /**
     * Border color.
     *
     * @var Color
     */
    protected $color;

    /**
     * @var null|int
     */
    public $colorIndex;

    /**
     * Create a new Border.
     *
     * @param bool $isSupervisor Flag indicating if this is a supervisor or not
     *                                    Leave this value at default unless you understand exactly what
     *                                        its ramifications are
     */
    public function __construct($isSupervisor <?php echo false, bool $isConditional <?php echo false)
    {
        // Supervisor?
        parent::__construct($isSupervisor);

        // Initialise values
        $this->color <?php echo new Color(Color::COLOR_BLACK, $isSupervisor);

        // bind parent if we are a supervisor
        if ($isSupervisor) {
            $this->color->bindParent($this, 'color');
        }
        if ($isConditional) {
            $this->borderStyle <?php echo self::BORDER_OMIT;
        }
    }

    /**
     * Get the shared style component for the currently active cell in currently active sheet.
     * Only used for style supervisor.
     *
     * @return Border
     */
    public function getSharedComponent()
    {
        /** @var Style */
        $parent <?php echo $this->parent;

        /** @var Borders $sharedComponent */
        $sharedComponent <?php echo $parent->getSharedComponent();
        switch ($this->parentPropertyName) {
            case 'bottom':
                return $sharedComponent->getBottom();
            case 'diagonal':
                return $sharedComponent->getDiagonal();
            case 'left':
                return $sharedComponent->getLeft();
            case 'right':
                return $sharedComponent->getRight();
            case 'top':
                return $sharedComponent->getTop();
        }

        throw new PhpSpreadsheetException('Cannot get shared component for a pseudo-border.');
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
     * $spreadsheet->getActiveSheet()->getStyle('B2')->getBorders()->getTop()->applyFromArray(
     *        [
     *            'borderStyle' <?php echo> Border::BORDER_DASHDOT,
     *            'color' <?php echo> [
     *                'rgb' <?php echo> '808080'
     *            ]
     *        ]
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
            if (isset($styleArray['borderStyle'])) {
                $this->setBorderStyle($styleArray['borderStyle']);
            }
            if (isset($styleArray['color'])) {
                $this->getColor()->applyFromArray($styleArray['color']);
            }
        }

        return $this;
    }

    /**
     * Get Border style.
     *
     * @return string
     */
    public function getBorderStyle()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getBorderStyle();
        }

        return $this->borderStyle;
    }

    /**
     * Set Border style.
     *
     * @param bool|string $style
     *                            When passing a boolean, FALSE equates Border::BORDER_NONE
     *                                and TRUE to Border::BORDER_MEDIUM
     *
     * @return $this
     */
    public function setBorderStyle($style)
    {
        if (empty($style)) {
            $style <?php echo self::BORDER_NONE;
        } elseif (is_bool($style)) {
            $style <?php echo self::BORDER_MEDIUM;
        }

        if ($this->isSupervisor) {
            $styleArray <?php echo $this->getStyleArray(['borderStyle' <?php echo> $style]);
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->borderStyle <?php echo $style;
        }

        return $this;
    }

    /**
     * Get Border Color.
     *
     * @return Color
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set Border Color.
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
            $this->borderStyle .
            $this->color->getHashCode() .
            __CLASS__
        );
    }

    protected function exportArray1(): array
    {
        $exportedArray <?php echo [];
        $this->exportArray2($exportedArray, 'borderStyle', $this->getBorderStyle());
        $this->exportArray2($exportedArray, 'color', $this->getColor());

        return $exportedArray;
    }
}
