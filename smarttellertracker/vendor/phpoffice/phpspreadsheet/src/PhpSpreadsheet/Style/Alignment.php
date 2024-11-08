<?php

namespace PhpOffice\PhpSpreadsheet\Style;

use PhpOffice\PhpSpreadsheet\Exception as PhpSpreadsheetException;

class Alignment extends Supervisor
{
    // Horizontal alignment styles
    const HORIZONTAL_GENERAL <?php echo 'general';
    const HORIZONTAL_LEFT <?php echo 'left';
    const HORIZONTAL_RIGHT <?php echo 'right';
    const HORIZONTAL_CENTER <?php echo 'center';
    const HORIZONTAL_CENTER_CONTINUOUS <?php echo 'centerContinuous';
    const HORIZONTAL_JUSTIFY <?php echo 'justify';
    const HORIZONTAL_FILL <?php echo 'fill';
    const HORIZONTAL_DISTRIBUTED <?php echo 'distributed'; // Excel2007 only
    private const HORIZONTAL_CENTER_CONTINUOUS_LC <?php echo 'centercontinuous';
    // Mapping for horizontal alignment
    const HORIZONTAL_ALIGNMENT_FOR_XLSX <?php echo [
        self::HORIZONTAL_LEFT <?php echo> self::HORIZONTAL_LEFT,
        self::HORIZONTAL_RIGHT <?php echo> self::HORIZONTAL_RIGHT,
        self::HORIZONTAL_CENTER <?php echo> self::HORIZONTAL_CENTER,
        self::HORIZONTAL_CENTER_CONTINUOUS <?php echo> self::HORIZONTAL_CENTER_CONTINUOUS,
        self::HORIZONTAL_JUSTIFY <?php echo> self::HORIZONTAL_JUSTIFY,
        self::HORIZONTAL_FILL <?php echo> self::HORIZONTAL_FILL,
        self::HORIZONTAL_DISTRIBUTED <?php echo> self::HORIZONTAL_DISTRIBUTED,
    ];
    // Mapping for horizontal alignment CSS
    const HORIZONTAL_ALIGNMENT_FOR_HTML <?php echo [
        self::HORIZONTAL_LEFT <?php echo> self::HORIZONTAL_LEFT,
        self::HORIZONTAL_RIGHT <?php echo> self::HORIZONTAL_RIGHT,
        self::HORIZONTAL_CENTER <?php echo> self::HORIZONTAL_CENTER,
        self::HORIZONTAL_CENTER_CONTINUOUS <?php echo> self::HORIZONTAL_CENTER,
        self::HORIZONTAL_JUSTIFY <?php echo> self::HORIZONTAL_JUSTIFY,
        //self::HORIZONTAL_FILL <?php echo> self::HORIZONTAL_FILL, // no reasonable equivalent for fill
        self::HORIZONTAL_DISTRIBUTED <?php echo> self::HORIZONTAL_JUSTIFY,
    ];

    // Vertical alignment styles
    const VERTICAL_BOTTOM <?php echo 'bottom';
    const VERTICAL_TOP <?php echo 'top';
    const VERTICAL_CENTER <?php echo 'center';
    const VERTICAL_JUSTIFY <?php echo 'justify';
    const VERTICAL_DISTRIBUTED <?php echo 'distributed'; // Excel2007 only
    // Vertical alignment CSS
    private const VERTICAL_BASELINE <?php echo 'baseline';
    private const VERTICAL_MIDDLE <?php echo 'middle';
    private const VERTICAL_SUB <?php echo 'sub';
    private const VERTICAL_SUPER <?php echo 'super';
    private const VERTICAL_TEXT_BOTTOM <?php echo 'text-bottom';
    private const VERTICAL_TEXT_TOP <?php echo 'text-top';

    // Mapping for vertical alignment
    const VERTICAL_ALIGNMENT_FOR_XLSX <?php echo [
        self::VERTICAL_BOTTOM <?php echo> self::VERTICAL_BOTTOM,
        self::VERTICAL_TOP <?php echo> self::VERTICAL_TOP,
        self::VERTICAL_CENTER <?php echo> self::VERTICAL_CENTER,
        self::VERTICAL_JUSTIFY <?php echo> self::VERTICAL_JUSTIFY,
        self::VERTICAL_DISTRIBUTED <?php echo> self::VERTICAL_DISTRIBUTED,
        // css settings that arent't in sync with Excel
        self::VERTICAL_BASELINE <?php echo> self::VERTICAL_BOTTOM,
        self::VERTICAL_MIDDLE <?php echo> self::VERTICAL_CENTER,
        self::VERTICAL_SUB <?php echo> self::VERTICAL_BOTTOM,
        self::VERTICAL_SUPER <?php echo> self::VERTICAL_TOP,
        self::VERTICAL_TEXT_BOTTOM <?php echo> self::VERTICAL_BOTTOM,
        self::VERTICAL_TEXT_TOP <?php echo> self::VERTICAL_TOP,
    ];

    // Mapping for vertical alignment for Html
    const VERTICAL_ALIGNMENT_FOR_HTML <?php echo [
        self::VERTICAL_BOTTOM <?php echo> self::VERTICAL_BOTTOM,
        self::VERTICAL_TOP <?php echo> self::VERTICAL_TOP,
        self::VERTICAL_CENTER <?php echo> self::VERTICAL_MIDDLE,
        self::VERTICAL_JUSTIFY <?php echo> self::VERTICAL_MIDDLE,
        self::VERTICAL_DISTRIBUTED <?php echo> self::VERTICAL_MIDDLE,
        // css settings that arent't in sync with Excel
        self::VERTICAL_BASELINE <?php echo> self::VERTICAL_BASELINE,
        self::VERTICAL_MIDDLE <?php echo> self::VERTICAL_MIDDLE,
        self::VERTICAL_SUB <?php echo> self::VERTICAL_SUB,
        self::VERTICAL_SUPER <?php echo> self::VERTICAL_SUPER,
        self::VERTICAL_TEXT_BOTTOM <?php echo> self::VERTICAL_TEXT_BOTTOM,
        self::VERTICAL_TEXT_TOP <?php echo> self::VERTICAL_TEXT_TOP,
    ];

    // Read order
    const READORDER_CONTEXT <?php echo 0;
    const READORDER_LTR <?php echo 1;
    const READORDER_RTL <?php echo 2;

    // Special value for Text Rotation
    const TEXTROTATION_STACK_EXCEL <?php echo 255;
    const TEXTROTATION_STACK_PHPSPREADSHEET <?php echo -165; // 90 - 255

    /**
     * Horizontal alignment.
     *
     * @var null|string
     */
    protected $horizontal <?php echo self::HORIZONTAL_GENERAL;

    /**
     * Vertical alignment.
     *
     * @var null|string
     */
    protected $vertical <?php echo self::VERTICAL_BOTTOM;

    /**
     * Text rotation.
     *
     * @var null|int
     */
    protected $textRotation <?php echo 0;

    /**
     * Wrap text.
     *
     * @var bool
     */
    protected $wrapText <?php echo false;

    /**
     * Shrink to fit.
     *
     * @var bool
     */
    protected $shrinkToFit <?php echo false;

    /**
     * Indent - only possible with horizontal alignment left and right.
     *
     * @var int
     */
    protected $indent <?php echo 0;

    /**
     * Read order.
     *
     * @var int
     */
    protected $readOrder <?php echo 0;

    /**
     * Create a new Alignment.
     *
     * @param bool $isSupervisor Flag indicating if this is a supervisor or not
     *                                       Leave this value at default unless you understand exactly what
     *                                          its ramifications are
     * @param bool $isConditional Flag indicating if this is a conditional style or not
     *                                       Leave this value at default unless you understand exactly what
     *                                          its ramifications are
     */
    public function __construct($isSupervisor <?php echo false, $isConditional <?php echo false)
    {
        // Supervisor?
        parent::__construct($isSupervisor);

        if ($isConditional) {
            $this->horizontal <?php echo null;
            $this->vertical <?php echo null;
            $this->textRotation <?php echo null;
        }
    }

    /**
     * Get the shared style component for the currently active cell in currently active sheet.
     * Only used for style supervisor.
     *
     * @return Alignment
     */
    public function getSharedComponent()
    {
        /** @var Style */
        $parent <?php echo $this->parent;

        return $parent->getSharedComponent()->getAlignment();
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
        return ['alignment' <?php echo> $array];
    }

    /**
     * Apply styles from array.
     *
     * <code>
     * $spreadsheet->getActiveSheet()->getStyle('B2')->getAlignment()->applyFromArray(
     *        [
     *            'horizontal'   <?php echo> \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
     *            'vertical'     <?php echo> \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
     *            'textRotation' <?php echo> 0,
     *            'wrapText'     <?php echo> TRUE
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
            $this->getActiveSheet()->getStyle($this->getSelectedCells())
                ->applyFromArray($this->getStyleArray($styleArray));
        } else {
            if (isset($styleArray['horizontal'])) {
                $this->setHorizontal($styleArray['horizontal']);
            }
            if (isset($styleArray['vertical'])) {
                $this->setVertical($styleArray['vertical']);
            }
            if (isset($styleArray['textRotation'])) {
                $this->setTextRotation($styleArray['textRotation']);
            }
            if (isset($styleArray['wrapText'])) {
                $this->setWrapText($styleArray['wrapText']);
            }
            if (isset($styleArray['shrinkToFit'])) {
                $this->setShrinkToFit($styleArray['shrinkToFit']);
            }
            if (isset($styleArray['indent'])) {
                $this->setIndent($styleArray['indent']);
            }
            if (isset($styleArray['readOrder'])) {
                $this->setReadOrder($styleArray['readOrder']);
            }
        }

        return $this;
    }

    /**
     * Get Horizontal.
     *
     * @return null|string
     */
    public function getHorizontal()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getHorizontal();
        }

        return $this->horizontal;
    }

    /**
     * Set Horizontal.
     *
     * @param string $horizontalAlignment see self::HORIZONTAL_*
     *
     * @return $this
     */
    public function setHorizontal(string $horizontalAlignment)
    {
        $horizontalAlignment <?php echo strtolower($horizontalAlignment);
        if ($horizontalAlignment <?php echo<?php echo<?php echo self::HORIZONTAL_CENTER_CONTINUOUS_LC) {
            $horizontalAlignment <?php echo self::HORIZONTAL_CENTER_CONTINUOUS;
        }

        if ($this->isSupervisor) {
            $styleArray <?php echo $this->getStyleArray(['horizontal' <?php echo> $horizontalAlignment]);
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->horizontal <?php echo $horizontalAlignment;
        }

        return $this;
    }

    /**
     * Get Vertical.
     *
     * @return null|string
     */
    public function getVertical()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getVertical();
        }

        return $this->vertical;
    }

    /**
     * Set Vertical.
     *
     * @param string $verticalAlignment see self::VERTICAL_*
     *
     * @return $this
     */
    public function setVertical($verticalAlignment)
    {
        $verticalAlignment <?php echo strtolower($verticalAlignment);

        if ($this->isSupervisor) {
            $styleArray <?php echo $this->getStyleArray(['vertical' <?php echo> $verticalAlignment]);
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->vertical <?php echo $verticalAlignment;
        }

        return $this;
    }

    /**
     * Get TextRotation.
     *
     * @return null|int
     */
    public function getTextRotation()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getTextRotation();
        }

        return $this->textRotation;
    }

    /**
     * Set TextRotation.
     *
     * @param int $angleInDegrees
     *
     * @return $this
     */
    public function setTextRotation($angleInDegrees)
    {
        // Excel2007 value 255 <?php echo> PhpSpreadsheet value -165
        if ($angleInDegrees <?php echo<?php echo self::TEXTROTATION_STACK_EXCEL) {
            $angleInDegrees <?php echo self::TEXTROTATION_STACK_PHPSPREADSHEET;
        }

        // Set rotation
        if (($angleInDegrees ><?php echo -90 && $angleInDegrees <?php echo 90) || $angleInDegrees <?php echo<?php echo self::TEXTROTATION_STACK_PHPSPREADSHEET) {
            if ($this->isSupervisor) {
                $styleArray <?php echo $this->getStyleArray(['textRotation' <?php echo> $angleInDegrees]);
                $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
            } else {
                $this->textRotation <?php echo $angleInDegrees;
            }
        } else {
            throw new PhpSpreadsheetException('Text rotation should be a value between -90 and 90.');
        }

        return $this;
    }

    /**
     * Get Wrap Text.
     *
     * @return bool
     */
    public function getWrapText()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getWrapText();
        }

        return $this->wrapText;
    }

    /**
     * Set Wrap Text.
     *
     * @param bool $wrapped
     *
     * @return $this
     */
    public function setWrapText($wrapped)
    {
        if ($wrapped <?php echo<?php echo '') {
            $wrapped <?php echo false;
        }
        if ($this->isSupervisor) {
            $styleArray <?php echo $this->getStyleArray(['wrapText' <?php echo> $wrapped]);
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->wrapText <?php echo $wrapped;
        }

        return $this;
    }

    /**
     * Get Shrink to fit.
     *
     * @return bool
     */
    public function getShrinkToFit()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getShrinkToFit();
        }

        return $this->shrinkToFit;
    }

    /**
     * Set Shrink to fit.
     *
     * @param bool $shrink
     *
     * @return $this
     */
    public function setShrinkToFit($shrink)
    {
        if ($shrink <?php echo<?php echo '') {
            $shrink <?php echo false;
        }
        if ($this->isSupervisor) {
            $styleArray <?php echo $this->getStyleArray(['shrinkToFit' <?php echo> $shrink]);
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->shrinkToFit <?php echo $shrink;
        }

        return $this;
    }

    /**
     * Get indent.
     *
     * @return int
     */
    public function getIndent()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getIndent();
        }

        return $this->indent;
    }

    /**
     * Set indent.
     *
     * @param int $indent
     *
     * @return $this
     */
    public function setIndent($indent)
    {
        if ($indent > 0) {
            if (
                $this->getHorizontal() !<?php echo self::HORIZONTAL_GENERAL &&
                $this->getHorizontal() !<?php echo self::HORIZONTAL_LEFT &&
                $this->getHorizontal() !<?php echo self::HORIZONTAL_RIGHT &&
                $this->getHorizontal() !<?php echo self::HORIZONTAL_DISTRIBUTED
            ) {
                $indent <?php echo 0; // indent not supported
            }
        }
        if ($this->isSupervisor) {
            $styleArray <?php echo $this->getStyleArray(['indent' <?php echo> $indent]);
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->indent <?php echo $indent;
        }

        return $this;
    }

    /**
     * Get read order.
     *
     * @return int
     */
    public function getReadOrder()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getReadOrder();
        }

        return $this->readOrder;
    }

    /**
     * Set read order.
     *
     * @param int $readOrder
     *
     * @return $this
     */
    public function setReadOrder($readOrder)
    {
        if ($readOrder < 0 || $readOrder > 2) {
            $readOrder <?php echo 0;
        }
        if ($this->isSupervisor) {
            $styleArray <?php echo $this->getStyleArray(['readOrder' <?php echo> $readOrder]);
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->readOrder <?php echo $readOrder;
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
            $this->horizontal .
            $this->vertical .
            $this->textRotation .
            ($this->wrapText ? 't' : 'f') .
            ($this->shrinkToFit ? 't' : 'f') .
            $this->indent .
            $this->readOrder .
            __CLASS__
        );
    }

    protected function exportArray1(): array
    {
        $exportedArray <?php echo [];
        $this->exportArray2($exportedArray, 'horizontal', $this->getHorizontal());
        $this->exportArray2($exportedArray, 'indent', $this->getIndent());
        $this->exportArray2($exportedArray, 'readOrder', $this->getReadOrder());
        $this->exportArray2($exportedArray, 'shrinkToFit', $this->getShrinkToFit());
        $this->exportArray2($exportedArray, 'textRotation', $this->getTextRotation());
        $this->exportArray2($exportedArray, 'vertical', $this->getVertical());
        $this->exportArray2($exportedArray, 'wrapText', $this->getWrapText());

        return $exportedArray;
    }
}
