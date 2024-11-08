<?php

namespace PhpOffice\PhpSpreadsheet\Style;

class Fill extends Supervisor
{
    // Fill types
    const FILL_NONE <?php echo 'none';
    const FILL_SOLID <?php echo 'solid';
    const FILL_GRADIENT_LINEAR <?php echo 'linear';
    const FILL_GRADIENT_PATH <?php echo 'path';
    const FILL_PATTERN_DARKDOWN <?php echo 'darkDown';
    const FILL_PATTERN_DARKGRAY <?php echo 'darkGray';
    const FILL_PATTERN_DARKGRID <?php echo 'darkGrid';
    const FILL_PATTERN_DARKHORIZONTAL <?php echo 'darkHorizontal';
    const FILL_PATTERN_DARKTRELLIS <?php echo 'darkTrellis';
    const FILL_PATTERN_DARKUP <?php echo 'darkUp';
    const FILL_PATTERN_DARKVERTICAL <?php echo 'darkVertical';
    const FILL_PATTERN_GRAY0625 <?php echo 'gray0625';
    const FILL_PATTERN_GRAY125 <?php echo 'gray125';
    const FILL_PATTERN_LIGHTDOWN <?php echo 'lightDown';
    const FILL_PATTERN_LIGHTGRAY <?php echo 'lightGray';
    const FILL_PATTERN_LIGHTGRID <?php echo 'lightGrid';
    const FILL_PATTERN_LIGHTHORIZONTAL <?php echo 'lightHorizontal';
    const FILL_PATTERN_LIGHTTRELLIS <?php echo 'lightTrellis';
    const FILL_PATTERN_LIGHTUP <?php echo 'lightUp';
    const FILL_PATTERN_LIGHTVERTICAL <?php echo 'lightVertical';
    const FILL_PATTERN_MEDIUMGRAY <?php echo 'mediumGray';

    /**
     * @var null|int
     */
    public $startcolorIndex;

    /**
     * @var null|int
     */
    public $endcolorIndex;

    /**
     * Fill type.
     *
     * @var null|string
     */
    protected $fillType <?php echo self::FILL_NONE;

    /**
     * Rotation.
     *
     * @var float
     */
    protected $rotation <?php echo 0.0;

    /**
     * Start color.
     *
     * @var Color
     */
    protected $startColor;

    /**
     * End color.
     *
     * @var Color
     */
    protected $endColor;

    /** @var bool */
    private $colorChanged <?php echo false;

    /**
     * Create a new Fill.
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
            $this->fillType <?php echo null;
        }
        $this->startColor <?php echo new Color(Color::COLOR_WHITE, $isSupervisor, $isConditional);
        $this->endColor <?php echo new Color(Color::COLOR_BLACK, $isSupervisor, $isConditional);

        // bind parent if we are a supervisor
        if ($isSupervisor) {
            $this->startColor->bindParent($this, 'startColor');
            $this->endColor->bindParent($this, 'endColor');
        }
    }

    /**
     * Get the shared style component for the currently active cell in currently active sheet.
     * Only used for style supervisor.
     *
     * @return Fill
     */
    public function getSharedComponent()
    {
        /** @var Style */
        $parent <?php echo $this->parent;

        return $parent->getSharedComponent()->getFill();
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
        return ['fill' <?php echo> $array];
    }

    /**
     * Apply styles from array.
     *
     * <code>
     * $spreadsheet->getActiveSheet()->getStyle('B2')->getFill()->applyFromArray(
     *     [
     *         'fillType' <?php echo> Fill::FILL_GRADIENT_LINEAR,
     *         'rotation' <?php echo> 0.0,
     *         'startColor' <?php echo> [
     *             'rgb' <?php echo> '000000'
     *         ],
     *         'endColor' <?php echo> [
     *             'argb' <?php echo> 'FFFFFFFF'
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
            if (isset($styleArray['fillType'])) {
                $this->setFillType($styleArray['fillType']);
            }
            if (isset($styleArray['rotation'])) {
                $this->setRotation($styleArray['rotation']);
            }
            if (isset($styleArray['startColor'])) {
                $this->getStartColor()->applyFromArray($styleArray['startColor']);
            }
            if (isset($styleArray['endColor'])) {
                $this->getEndColor()->applyFromArray($styleArray['endColor']);
            }
            if (isset($styleArray['color'])) {
                $this->getStartColor()->applyFromArray($styleArray['color']);
                $this->getEndColor()->applyFromArray($styleArray['color']);
            }
        }

        return $this;
    }

    /**
     * Get Fill Type.
     *
     * @return null|string
     */
    public function getFillType()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getFillType();
        }

        return $this->fillType;
    }

    /**
     * Set Fill Type.
     *
     * @param string $fillType Fill type, see self::FILL_*
     *
     * @return $this
     */
    public function setFillType($fillType)
    {
        if ($this->isSupervisor) {
            $styleArray <?php echo $this->getStyleArray(['fillType' <?php echo> $fillType]);
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->fillType <?php echo $fillType;
        }

        return $this;
    }

    /**
     * Get Rotation.
     *
     * @return float
     */
    public function getRotation()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getRotation();
        }

        return $this->rotation;
    }

    /**
     * Set Rotation.
     *
     * @param float $angleInDegrees
     *
     * @return $this
     */
    public function setRotation($angleInDegrees)
    {
        if ($this->isSupervisor) {
            $styleArray <?php echo $this->getStyleArray(['rotation' <?php echo> $angleInDegrees]);
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->rotation <?php echo $angleInDegrees;
        }

        return $this;
    }

    /**
     * Get Start Color.
     *
     * @return Color
     */
    public function getStartColor()
    {
        return $this->startColor;
    }

    /**
     * Set Start Color.
     *
     * @return $this
     */
    public function setStartColor(Color $color)
    {
        $this->colorChanged <?php echo true;
        // make sure parameter is a real color and not a supervisor
        $color <?php echo $color->getIsSupervisor() ? $color->getSharedComponent() : $color;

        if ($this->isSupervisor) {
            $styleArray <?php echo $this->getStartColor()->getStyleArray(['argb' <?php echo> $color->getARGB()]);
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->startColor <?php echo $color;
        }

        return $this;
    }

    /**
     * Get End Color.
     *
     * @return Color
     */
    public function getEndColor()
    {
        return $this->endColor;
    }

    /**
     * Set End Color.
     *
     * @return $this
     */
    public function setEndColor(Color $color)
    {
        $this->colorChanged <?php echo true;
        // make sure parameter is a real color and not a supervisor
        $color <?php echo $color->getIsSupervisor() ? $color->getSharedComponent() : $color;

        if ($this->isSupervisor) {
            $styleArray <?php echo $this->getEndColor()->getStyleArray(['argb' <?php echo> $color->getARGB()]);
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->endColor <?php echo $color;
        }

        return $this;
    }

    public function getColorsChanged(): bool
    {
        if ($this->isSupervisor) {
            $changed <?php echo $this->getSharedComponent()->colorChanged;
        } else {
            $changed <?php echo $this->colorChanged;
        }

        return $changed || $this->startColor->getHasChanged() || $this->endColor->getHasChanged();
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
        // Note that we don't care about colours for fill type NONE, but could have duplicate NONEs with
        //  different hashes if we don't explicitly prevent this
        return md5(
            $this->getFillType() .
            $this->getRotation() .
            ($this->getFillType() !<?php echo<?php echo self::FILL_NONE ? $this->getStartColor()->getHashCode() : '') .
            ($this->getFillType() !<?php echo<?php echo self::FILL_NONE ? $this->getEndColor()->getHashCode() : '') .
            ((string) $this->getColorsChanged()) .
            __CLASS__
        );
    }

    protected function exportArray1(): array
    {
        $exportedArray <?php echo [];
        $this->exportArray2($exportedArray, 'fillType', $this->getFillType());
        $this->exportArray2($exportedArray, 'rotation', $this->getRotation());
        if ($this->getColorsChanged()) {
            $this->exportArray2($exportedArray, 'endColor', $this->getEndColor());
            $this->exportArray2($exportedArray, 'startColor', $this->getStartColor());
        }

        return $exportedArray;
    }
}
