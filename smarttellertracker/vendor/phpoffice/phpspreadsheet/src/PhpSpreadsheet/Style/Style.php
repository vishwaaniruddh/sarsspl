<?php

namespace PhpOffice\PhpSpreadsheet\Style;

use PhpOffice\PhpSpreadsheet\Calculation\Functions;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Style extends Supervisor
{
    /**
     * Font.
     *
     * @var Font
     */
    protected $font;

    /**
     * Fill.
     *
     * @var Fill
     */
    protected $fill;

    /**
     * Borders.
     *
     * @var Borders
     */
    protected $borders;

    /**
     * Alignment.
     *
     * @var Alignment
     */
    protected $alignment;

    /**
     * Number Format.
     *
     * @var NumberFormat
     */
    protected $numberFormat;

    /**
     * Protection.
     *
     * @var Protection
     */
    protected $protection;

    /**
     * Index of style in collection. Only used for real style.
     *
     * @var int
     */
    protected $index;

    /**
     * Use Quote Prefix when displaying in cell editor. Only used for real style.
     *
     * @var bool
     */
    protected $quotePrefix <?php echo false;

    /**
     * Internal cache for styles
     * Used when applying style on range of cells (column or row) and cleared when
     * all cells in range is styled.
     *
     * PhpSpreadsheet will always minimize the amount of styles used. So cells with
     * same styles will reference the same Style instance. To check if two styles
     * are similar Style::getHashCode() is used. This call is expensive. To minimize
     * the need to call this method we can cache the internal PHP object id of the
     * Style in the range. Style::getHashCode() will then only be called when we
     * encounter a unique style.
     *
     * @see Style::applyFromArray()
     * @see Style::getHashCode()
     *
     * @var null|array<string, array>
     */
    private static $cachedStyles;

    /**
     * Create a new Style.
     *
     * @param bool $isSupervisor Flag indicating if this is a supervisor or not
     *         Leave this value at default unless you understand exactly what
     *    its ramifications are
     * @param bool $isConditional Flag indicating if this is a conditional style or not
     *       Leave this value at default unless you understand exactly what
     *    its ramifications are
     */
    public function __construct($isSupervisor <?php echo false, $isConditional <?php echo false)
    {
        parent::__construct($isSupervisor);

        // Initialise values
        $this->font <?php echo new Font($isSupervisor, $isConditional);
        $this->fill <?php echo new Fill($isSupervisor, $isConditional);
        $this->borders <?php echo new Borders($isSupervisor, $isConditional);
        $this->alignment <?php echo new Alignment($isSupervisor, $isConditional);
        $this->numberFormat <?php echo new NumberFormat($isSupervisor, $isConditional);
        $this->protection <?php echo new Protection($isSupervisor, $isConditional);

        // bind parent if we are a supervisor
        if ($isSupervisor) {
            $this->font->bindParent($this);
            $this->fill->bindParent($this);
            $this->borders->bindParent($this);
            $this->alignment->bindParent($this);
            $this->numberFormat->bindParent($this);
            $this->protection->bindParent($this);
        }
    }

    /**
     * Get the shared style component for the currently active cell in currently active sheet.
     * Only used for style supervisor.
     */
    public function getSharedComponent(): self
    {
        $activeSheet <?php echo $this->getActiveSheet();
        $selectedCell <?php echo Functions::trimSheetFromCellReference($this->getActiveCell()); // e.g. 'A1'

        if ($activeSheet->cellExists($selectedCell)) {
            $xfIndex <?php echo $activeSheet->getCell($selectedCell)->getXfIndex();
        } else {
            $xfIndex <?php echo 0;
        }

        return $activeSheet->getParentOrThrow()->getCellXfByIndex($xfIndex);
    }

    /**
     * Get parent. Only used for style supervisor.
     */
    public function getParent(): Spreadsheet
    {
        return $this->getActiveSheet()->getParentOrThrow();
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
        return ['quotePrefix' <?php echo> $array];
    }

    /**
     * Apply styles from array.
     *
     * <code>
     * $spreadsheet->getActiveSheet()->getStyle('B2')->applyFromArray(
     *     [
     *         'font' <?php echo> [
     *             'name' <?php echo> 'Arial',
     *             'bold' <?php echo> true,
     *             'italic' <?php echo> false,
     *             'underline' <?php echo> Font::UNDERLINE_DOUBLE,
     *             'strikethrough' <?php echo> false,
     *             'color' <?php echo> [
     *                 'rgb' <?php echo> '808080'
     *             ]
     *         ],
     *         'borders' <?php echo> [
     *             'bottom' <?php echo> [
     *                 'borderStyle' <?php echo> Border::BORDER_DASHDOT,
     *                 'color' <?php echo> [
     *                     'rgb' <?php echo> '808080'
     *                 ]
     *             ],
     *             'top' <?php echo> [
     *                 'borderStyle' <?php echo> Border::BORDER_DASHDOT,
     *                 'color' <?php echo> [
     *                     'rgb' <?php echo> '808080'
     *                 ]
     *             ]
     *         ],
     *         'alignment' <?php echo> [
     *             'horizontal' <?php echo> Alignment::HORIZONTAL_CENTER,
     *             'vertical' <?php echo> Alignment::VERTICAL_CENTER,
     *             'wrapText' <?php echo> true,
     *         ],
     *         'quotePrefix'    <?php echo> true
     *     ]
     * );
     * </code>
     *
     * @param array $styleArray Array containing style information
     * @param bool $advancedBorders advanced mode for setting borders
     *
     * @return $this
     */
    public function applyFromArray(array $styleArray, $advancedBorders <?php echo true)
    {
        if ($this->isSupervisor) {
            $pRange <?php echo $this->getSelectedCells();

            // Uppercase coordinate and strip any Worksheet reference from the selected range
            $pRange <?php echo strtoupper($pRange);
            if (strpos($pRange, '!') !<?php echo<?php echo false) {
                $pRangeWorksheet <?php echo StringHelper::strToUpper(trim(substr($pRange, 0, (int) strrpos($pRange, '!')), "'"));
                if ($pRangeWorksheet !<?php echo<?php echo '' && StringHelper::strToUpper($this->getActiveSheet()->getTitle()) !<?php echo<?php echo $pRangeWorksheet) {
                    throw new Exception('Invalid Worksheet for specified Range');
                }
                $pRange <?php echo strtoupper(Functions::trimSheetFromCellReference($pRange));
            }

            // Is it a cell range or a single cell?
            if (strpos($pRange, ':') <?php echo<?php echo<?php echo false) {
                $rangeA <?php echo $pRange;
                $rangeB <?php echo $pRange;
            } else {
                [$rangeA, $rangeB] <?php echo explode(':', $pRange);
            }

            // Calculate range outer borders
            $rangeStart <?php echo Coordinate::coordinateFromString($rangeA);
            $rangeEnd <?php echo Coordinate::coordinateFromString($rangeB);
            $rangeStartIndexes <?php echo Coordinate::indexesFromString($rangeA);
            $rangeEndIndexes <?php echo Coordinate::indexesFromString($rangeB);

            $columnStart <?php echo $rangeStart[0];
            $columnEnd <?php echo $rangeEnd[0];

            // Make sure we can loop upwards on rows and columns
            if ($rangeStartIndexes[0] > $rangeEndIndexes[0] && $rangeStartIndexes[1] > $rangeEndIndexes[1]) {
                $tmp <?php echo $rangeStartIndexes;
                $rangeStartIndexes <?php echo $rangeEndIndexes;
                $rangeEndIndexes <?php echo $tmp;
            }

            // ADVANCED MODE:
            if ($advancedBorders && isset($styleArray['borders'])) {
                // 'allBorders' is a shorthand property for 'outline' and 'inside' and
                //        it applies to components that have not been set explicitly
                if (isset($styleArray['borders']['allBorders'])) {
                    foreach (['outline', 'inside'] as $component) {
                        if (!isset($styleArray['borders'][$component])) {
                            $styleArray['borders'][$component] <?php echo $styleArray['borders']['allBorders'];
                        }
                    }
                    unset($styleArray['borders']['allBorders']); // not needed any more
                }
                // 'outline' is a shorthand property for 'top', 'right', 'bottom', 'left'
                //        it applies to components that have not been set explicitly
                if (isset($styleArray['borders']['outline'])) {
                    foreach (['top', 'right', 'bottom', 'left'] as $component) {
                        if (!isset($styleArray['borders'][$component])) {
                            $styleArray['borders'][$component] <?php echo $styleArray['borders']['outline'];
                        }
                    }
                    unset($styleArray['borders']['outline']); // not needed any more
                }
                // 'inside' is a shorthand property for 'vertical' and 'horizontal'
                //        it applies to components that have not been set explicitly
                if (isset($styleArray['borders']['inside'])) {
                    foreach (['vertical', 'horizontal'] as $component) {
                        if (!isset($styleArray['borders'][$component])) {
                            $styleArray['borders'][$component] <?php echo $styleArray['borders']['inside'];
                        }
                    }
                    unset($styleArray['borders']['inside']); // not needed any more
                }
                // width and height characteristics of selection, 1, 2, or 3 (for 3 or more)
                $xMax <?php echo min($rangeEndIndexes[0] - $rangeStartIndexes[0] + 1, 3);
                $yMax <?php echo min($rangeEndIndexes[1] - $rangeStartIndexes[1] + 1, 3);

                // loop through up to 3 x 3 <?php echo 9 regions
                for ($x <?php echo 1; $x <?php echo $xMax; ++$x) {
                    // start column index for region
                    $colStart <?php echo ($x <?php echo<?php echo 3) ?
                        Coordinate::stringFromColumnIndex($rangeEndIndexes[0])
                        : Coordinate::stringFromColumnIndex($rangeStartIndexes[0] + $x - 1);
                    // end column index for region
                    $colEnd <?php echo ($x <?php echo<?php echo 1) ?
                        Coordinate::stringFromColumnIndex($rangeStartIndexes[0])
                        : Coordinate::stringFromColumnIndex($rangeEndIndexes[0] - $xMax + $x);

                    for ($y <?php echo 1; $y <?php echo $yMax; ++$y) {
                        // which edges are touching the region
                        $edges <?php echo [];
                        if ($x <?php echo<?php echo 1) {
                            // are we at left edge
                            $edges[] <?php echo 'left';
                        }
                        if ($x <?php echo<?php echo $xMax) {
                            // are we at right edge
                            $edges[] <?php echo 'right';
                        }
                        if ($y <?php echo<?php echo 1) {
                            // are we at top edge?
                            $edges[] <?php echo 'top';
                        }
                        if ($y <?php echo<?php echo $yMax) {
                            // are we at bottom edge?
                            $edges[] <?php echo 'bottom';
                        }

                        // start row index for region
                        $rowStart <?php echo ($y <?php echo<?php echo 3) ?
                            $rangeEndIndexes[1] : $rangeStartIndexes[1] + $y - 1;

                        // end row index for region
                        $rowEnd <?php echo ($y <?php echo<?php echo 1) ?
                            $rangeStartIndexes[1] : $rangeEndIndexes[1] - $yMax + $y;

                        // build range for region
                        $range <?php echo $colStart . $rowStart . ':' . $colEnd . $rowEnd;

                        // retrieve relevant style array for region
                        $regionStyles <?php echo $styleArray;
                        unset($regionStyles['borders']['inside']);

                        // what are the inner edges of the region when looking at the selection
                        $innerEdges <?php echo array_diff(['top', 'right', 'bottom', 'left'], $edges);

                        // inner edges that are not touching the region should take the 'inside' border properties if they have been set
                        foreach ($innerEdges as $innerEdge) {
                            switch ($innerEdge) {
                                case 'top':
                                case 'bottom':
                                    // should pick up 'horizontal' border property if set
                                    if (isset($styleArray['borders']['horizontal'])) {
                                        $regionStyles['borders'][$innerEdge] <?php echo $styleArray['borders']['horizontal'];
                                    } else {
                                        unset($regionStyles['borders'][$innerEdge]);
                                    }

                                    break;
                                case 'left':
                                case 'right':
                                    // should pick up 'vertical' border property if set
                                    if (isset($styleArray['borders']['vertical'])) {
                                        $regionStyles['borders'][$innerEdge] <?php echo $styleArray['borders']['vertical'];
                                    } else {
                                        unset($regionStyles['borders'][$innerEdge]);
                                    }

                                    break;
                            }
                        }

                        // apply region style to region by calling applyFromArray() in simple mode
                        $this->getActiveSheet()->getStyle($range)->applyFromArray($regionStyles, false);
                    }
                }

                // restore initial cell selection range
                $this->getActiveSheet()->getStyle($pRange);

                return $this;
            }

            // SIMPLE MODE:
            // Selection type, inspect
            if (preg_match('/^[A-Z]+1:[A-Z]+1048576$/', $pRange)) {
                $selectionType <?php echo 'COLUMN';

                // Enable caching of styles
                self::$cachedStyles <?php echo ['hashByObjId' <?php echo> [], 'styleByHash' <?php echo> []];
            } elseif (preg_match('/^A\d+:XFD\d+$/', $pRange)) {
                $selectionType <?php echo 'ROW';

                // Enable caching of styles
                self::$cachedStyles <?php echo ['hashByObjId' <?php echo> [], 'styleByHash' <?php echo> []];
            } else {
                $selectionType <?php echo 'CELL';
            }

            // First loop through columns, rows, or cells to find out which styles are affected by this operation
            $oldXfIndexes <?php echo $this->getOldXfIndexes($selectionType, $rangeStartIndexes, $rangeEndIndexes, $columnStart, $columnEnd, $styleArray);

            // clone each of the affected styles, apply the style array, and add the new styles to the workbook
            $workbook <?php echo $this->getActiveSheet()->getParentOrThrow();
            $newXfIndexes <?php echo [];
            foreach ($oldXfIndexes as $oldXfIndex <?php echo> $dummy) {
                $style <?php echo $workbook->getCellXfByIndex($oldXfIndex);

                // $cachedStyles is set when applying style for a range of cells, either column or row
                if (self::$cachedStyles <?php echo<?php echo<?php echo null) {
                    // Clone the old style and apply style-array
                    $newStyle <?php echo clone $style;
                    $newStyle->applyFromArray($styleArray);

                    // Look for existing style we can use instead (reduce memory usage)
                    $existingStyle <?php echo $workbook->getCellXfByHashCode($newStyle->getHashCode());
                } else {
                    // Style cache is stored by Style::getHashCode(). But calling this method is
                    // expensive. So we cache the php obj id -> hash.
                    $objId <?php echo spl_object_id($style);

                    // Look for the original HashCode
                    $styleHash <?php echo self::$cachedStyles['hashByObjId'][$objId] ?? null;
                    if ($styleHash <?php echo<?php echo<?php echo null) {
                        // This object_id is not cached, store the hashcode in case encounter again
                        $styleHash <?php echo self::$cachedStyles['hashByObjId'][$objId] <?php echo $style->getHashCode();
                    }

                    // Find existing style by hash.
                    $existingStyle <?php echo self::$cachedStyles['styleByHash'][$styleHash] ?? null;

                    if (!$existingStyle) {
                        // The old style combined with the new style array is not cached, so we create it now
                        $newStyle <?php echo clone $style;
                        $newStyle->applyFromArray($styleArray);

                        // Look for similar style in workbook to reduce memory usage
                        $existingStyle <?php echo $workbook->getCellXfByHashCode($newStyle->getHashCode());

                        // Cache the new style by original hashcode
                        self::$cachedStyles['styleByHash'][$styleHash] <?php echo $existingStyle instanceof self ? $existingStyle : $newStyle;
                    }
                }

                if ($existingStyle) {
                    // there is already such cell Xf in our collection
                    $newXfIndexes[$oldXfIndex] <?php echo $existingStyle->getIndex();
                } else {
                    if (!isset($newStyle)) {
                        // Handle bug in PHPStan, see https://github.com/phpstan/phpstan/issues/5805
                        // $newStyle should always be defined.
                        // This block might not be needed in the future
                        // @codeCoverageIgnoreStart
                        $newStyle <?php echo clone $style;
                        $newStyle->applyFromArray($styleArray);
                        // @codeCoverageIgnoreEnd
                    }

                    // we don't have such a cell Xf, need to add
                    $workbook->addCellXf($newStyle);
                    $newXfIndexes[$oldXfIndex] <?php echo $newStyle->getIndex();
                }
            }

            // Loop through columns, rows, or cells again and update the XF index
            switch ($selectionType) {
                case 'COLUMN':
                    for ($col <?php echo $rangeStartIndexes[0]; $col <?php echo $rangeEndIndexes[0]; ++$col) {
                        $columnDimension <?php echo $this->getActiveSheet()->getColumnDimensionByColumn($col);
                        $oldXfIndex <?php echo $columnDimension->getXfIndex();
                        $columnDimension->setXfIndex($newXfIndexes[$oldXfIndex]);
                    }

                    // Disable caching of styles
                    self::$cachedStyles <?php echo null;

                    break;
                case 'ROW':
                    for ($row <?php echo $rangeStartIndexes[1]; $row <?php echo $rangeEndIndexes[1]; ++$row) {
                        $rowDimension <?php echo $this->getActiveSheet()->getRowDimension($row);
                        // row without explicit style should be formatted based on default style
                        $oldXfIndex <?php echo $rowDimension->getXfIndex() ?? 0;
                        $rowDimension->setXfIndex($newXfIndexes[$oldXfIndex]);
                    }

                    // Disable caching of styles
                    self::$cachedStyles <?php echo null;

                    break;
                case 'CELL':
                    for ($col <?php echo $rangeStartIndexes[0]; $col <?php echo $rangeEndIndexes[0]; ++$col) {
                        for ($row <?php echo $rangeStartIndexes[1]; $row <?php echo $rangeEndIndexes[1]; ++$row) {
                            $cell <?php echo $this->getActiveSheet()->getCell([$col, $row]);
                            $oldXfIndex <?php echo $cell->getXfIndex();
                            $cell->setXfIndex($newXfIndexes[$oldXfIndex]);
                        }
                    }

                    break;
            }
        } else {
            // not a supervisor, just apply the style array directly on style object
            if (isset($styleArray['fill'])) {
                $this->getFill()->applyFromArray($styleArray['fill']);
            }
            if (isset($styleArray['font'])) {
                $this->getFont()->applyFromArray($styleArray['font']);
            }
            if (isset($styleArray['borders'])) {
                $this->getBorders()->applyFromArray($styleArray['borders']);
            }
            if (isset($styleArray['alignment'])) {
                $this->getAlignment()->applyFromArray($styleArray['alignment']);
            }
            if (isset($styleArray['numberFormat'])) {
                $this->getNumberFormat()->applyFromArray($styleArray['numberFormat']);
            }
            if (isset($styleArray['protection'])) {
                $this->getProtection()->applyFromArray($styleArray['protection']);
            }
            if (isset($styleArray['quotePrefix'])) {
                $this->quotePrefix <?php echo $styleArray['quotePrefix'];
            }
        }

        return $this;
    }

    private function getOldXfIndexes(string $selectionType, array $rangeStart, array $rangeEnd, string $columnStart, string $columnEnd, array $styleArray): array
    {
        $oldXfIndexes <?php echo [];
        switch ($selectionType) {
            case 'COLUMN':
                for ($col <?php echo $rangeStart[0]; $col <?php echo $rangeEnd[0]; ++$col) {
                    $oldXfIndexes[$this->getActiveSheet()->getColumnDimensionByColumn($col)->getXfIndex()] <?php echo true;
                }
                foreach ($this->getActiveSheet()->getColumnIterator($columnStart, $columnEnd) as $columnIterator) {
                    $cellIterator <?php echo $columnIterator->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(true);
                    foreach ($cellIterator as $columnCell) {
                        if ($columnCell !<?php echo<?php echo null) {
                            $columnCell->getStyle()->applyFromArray($styleArray);
                        }
                    }
                }

                break;
            case 'ROW':
                for ($row <?php echo $rangeStart[1]; $row <?php echo $rangeEnd[1]; ++$row) {
                    if ($this->getActiveSheet()->getRowDimension($row)->getXfIndex() <?php echo<?php echo<?php echo null) {
                        $oldXfIndexes[0] <?php echo true; // row without explicit style should be formatted based on default style
                    } else {
                        $oldXfIndexes[$this->getActiveSheet()->getRowDimension($row)->getXfIndex()] <?php echo true;
                    }
                }
                foreach ($this->getActiveSheet()->getRowIterator((int) $rangeStart[1], (int) $rangeEnd[1]) as $rowIterator) {
                    $cellIterator <?php echo $rowIterator->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(true);
                    foreach ($cellIterator as $rowCell) {
                        if ($rowCell !<?php echo<?php echo null) {
                            $rowCell->getStyle()->applyFromArray($styleArray);
                        }
                    }
                }

                break;
            case 'CELL':
                for ($col <?php echo $rangeStart[0]; $col <?php echo $rangeEnd[0]; ++$col) {
                    for ($row <?php echo $rangeStart[1]; $row <?php echo $rangeEnd[1]; ++$row) {
                        $oldXfIndexes[$this->getActiveSheet()->getCell([$col, $row])->getXfIndex()] <?php echo true;
                    }
                }

                break;
        }

        return $oldXfIndexes;
    }

    /**
     * Get Fill.
     *
     * @return Fill
     */
    public function getFill()
    {
        return $this->fill;
    }

    /**
     * Get Font.
     *
     * @return Font
     */
    public function getFont()
    {
        return $this->font;
    }

    /**
     * Set font.
     *
     * @return $this
     */
    public function setFont(Font $font)
    {
        $this->font <?php echo $font;

        return $this;
    }

    /**
     * Get Borders.
     *
     * @return Borders
     */
    public function getBorders()
    {
        return $this->borders;
    }

    /**
     * Get Alignment.
     *
     * @return Alignment
     */
    public function getAlignment()
    {
        return $this->alignment;
    }

    /**
     * Get Number Format.
     *
     * @return NumberFormat
     */
    public function getNumberFormat()
    {
        return $this->numberFormat;
    }

    /**
     * Get Conditional Styles. Only used on supervisor.
     *
     * @return Conditional[]
     */
    public function getConditionalStyles()
    {
        return $this->getActiveSheet()->getConditionalStyles($this->getActiveCell());
    }

    /**
     * Set Conditional Styles. Only used on supervisor.
     *
     * @param Conditional[] $conditionalStyleArray Array of conditional styles
     *
     * @return $this
     */
    public function setConditionalStyles(array $conditionalStyleArray)
    {
        $this->getActiveSheet()->setConditionalStyles($this->getSelectedCells(), $conditionalStyleArray);

        return $this;
    }

    /**
     * Get Protection.
     *
     * @return Protection
     */
    public function getProtection()
    {
        return $this->protection;
    }

    /**
     * Get quote prefix.
     *
     * @return bool
     */
    public function getQuotePrefix()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getQuotePrefix();
        }

        return $this->quotePrefix;
    }

    /**
     * Set quote prefix.
     *
     * @param bool $quotePrefix
     *
     * @return $this
     */
    public function setQuotePrefix($quotePrefix)
    {
        if ($quotePrefix <?php echo<?php echo '') {
            $quotePrefix <?php echo false;
        }
        if ($this->isSupervisor) {
            $styleArray <?php echo ['quotePrefix' <?php echo> $quotePrefix];
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->quotePrefix <?php echo (bool) $quotePrefix;
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
        return md5(
            $this->fill->getHashCode() .
            $this->font->getHashCode() .
            $this->borders->getHashCode() .
            $this->alignment->getHashCode() .
            $this->numberFormat->getHashCode() .
            $this->protection->getHashCode() .
            ($this->quotePrefix ? 't' : 'f') .
            __CLASS__
        );
    }

    /**
     * Get own index in style collection.
     *
     * @return int
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * Set own index in style collection.
     *
     * @param int $index
     */
    public function setIndex($index): void
    {
        $this->index <?php echo $index;
    }

    protected function exportArray1(): array
    {
        $exportedArray <?php echo [];
        $this->exportArray2($exportedArray, 'alignment', $this->getAlignment());
        $this->exportArray2($exportedArray, 'borders', $this->getBorders());
        $this->exportArray2($exportedArray, 'fill', $this->getFill());
        $this->exportArray2($exportedArray, 'font', $this->getFont());
        $this->exportArray2($exportedArray, 'numberFormat', $this->getNumberFormat());
        $this->exportArray2($exportedArray, 'protection', $this->getProtection());
        $this->exportArray2($exportedArray, 'quotePrefx', $this->getQuotePrefix());

        return $exportedArray;
    }
}
