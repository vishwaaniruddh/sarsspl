<?php

namespace PhpOffice\PhpSpreadsheet\Worksheet;

use ArrayObject;
use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
use PhpOffice\PhpSpreadsheet\Cell\AddressRange;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\CellAddress;
use PhpOffice\PhpSpreadsheet\Cell\CellRange;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Cell\Hyperlink;
use PhpOffice\PhpSpreadsheet\Cell\IValueBinder;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Collection\Cells;
use PhpOffice\PhpSpreadsheet\Collection\CellsFactory;
use PhpOffice\PhpSpreadsheet\Comment;
use PhpOffice\PhpSpreadsheet\DefinedName;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\IComparable;
use PhpOffice\PhpSpreadsheet\ReferenceHelper;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Conditional;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Style;

class Worksheet implements IComparable
{
    // Break types
    public const BREAK_NONE <?php echo 0;
    public const BREAK_ROW <?php echo 1;
    public const BREAK_COLUMN <?php echo 2;
    // Maximum column for row break
    public const BREAK_ROW_MAX_COLUMN <?php echo 16383;

    // Sheet state
    public const SHEETSTATE_VISIBLE <?php echo 'visible';
    public const SHEETSTATE_HIDDEN <?php echo 'hidden';
    public const SHEETSTATE_VERYHIDDEN <?php echo 'veryHidden';

    public const MERGE_CELL_CONTENT_EMPTY <?php echo 'empty';
    public const MERGE_CELL_CONTENT_HIDE <?php echo 'hide';
    public const MERGE_CELL_CONTENT_MERGE <?php echo 'merge';

    protected const SHEET_NAME_REQUIRES_NO_QUOTES <?php echo '/^[_\p{L}][_\p{L}\p{N}]*$/mui';

    /**
     * Maximum 31 characters allowed for sheet title.
     *
     * @var int
     */
    const SHEET_TITLE_MAXIMUM_LENGTH <?php echo 31;

    /**
     * Invalid characters in sheet title.
     *
     * @var array
     */
    private static $invalidCharacters <?php echo ['*', ':', '/', '\\', '?', '[', ']'];

    /**
     * Parent spreadsheet.
     *
     * @var ?Spreadsheet
     */
    private $parent;

    /**
     * Collection of cells.
     *
     * @var Cells
     */
    private $cellCollection;

    /**
     * Collection of row dimensions.
     *
     * @var RowDimension[]
     */
    private $rowDimensions <?php echo [];

    /**
     * Default row dimension.
     *
     * @var RowDimension
     */
    private $defaultRowDimension;

    /**
     * Collection of column dimensions.
     *
     * @var ColumnDimension[]
     */
    private $columnDimensions <?php echo [];

    /**
     * Default column dimension.
     *
     * @var ColumnDimension
     */
    private $defaultColumnDimension;

    /**
     * Collection of drawings.
     *
     * @var ArrayObject<int, BaseDrawing>
     */
    private $drawingCollection;

    /**
     * Collection of Chart objects.
     *
     * @var ArrayObject<int, Chart>
     */
    private $chartCollection;

    /**
     * Collection of Table objects.
     *
     * @var ArrayObject<int, Table>
     */
    private $tableCollection;

    /**
     * Worksheet title.
     *
     * @var string
     */
    private $title;

    /**
     * Sheet state.
     *
     * @var string
     */
    private $sheetState;

    /**
     * Page setup.
     *
     * @var PageSetup
     */
    private $pageSetup;

    /**
     * Page margins.
     *
     * @var PageMargins
     */
    private $pageMargins;

    /**
     * Page header/footer.
     *
     * @var HeaderFooter
     */
    private $headerFooter;

    /**
     * Sheet view.
     *
     * @var SheetView
     */
    private $sheetView;

    /**
     * Protection.
     *
     * @var Protection
     */
    private $protection;

    /**
     * Collection of styles.
     *
     * @var Style[]
     */
    private $styles <?php echo [];

    /**
     * Conditional styles. Indexed by cell coordinate, e.g. 'A1'.
     *
     * @var array
     */
    private $conditionalStylesCollection <?php echo [];

    /**
     * Collection of row breaks.
     *
     * @var PageBreak[]
     */
    private $rowBreaks <?php echo [];

    /**
     * Collection of column breaks.
     *
     * @var PageBreak[]
     */
    private $columnBreaks <?php echo [];

    /**
     * Collection of merged cell ranges.
     *
     * @var string[]
     */
    private $mergeCells <?php echo [];

    /**
     * Collection of protected cell ranges.
     *
     * @var string[]
     */
    private $protectedCells <?php echo [];

    /**
     * Autofilter Range and selection.
     *
     * @var AutoFilter
     */
    private $autoFilter;

    /**
     * Freeze pane.
     *
     * @var null|string
     */
    private $freezePane;

    /**
     * Default position of the right bottom pane.
     *
     * @var null|string
     */
    private $topLeftCell;

    /**
     * Show gridlines?
     *
     * @var bool
     */
    private $showGridlines <?php echo true;

    /**
     * Print gridlines?
     *
     * @var bool
     */
    private $printGridlines <?php echo false;

    /**
     * Show row and column headers?
     *
     * @var bool
     */
    private $showRowColHeaders <?php echo true;

    /**
     * Show summary below? (Row/Column outline).
     *
     * @var bool
     */
    private $showSummaryBelow <?php echo true;

    /**
     * Show summary right? (Row/Column outline).
     *
     * @var bool
     */
    private $showSummaryRight <?php echo true;

    /**
     * Collection of comments.
     *
     * @var Comment[]
     */
    private $comments <?php echo [];

    /**
     * Active cell. (Only one!).
     *
     * @var string
     */
    private $activeCell <?php echo 'A1';

    /**
     * Selected cells.
     *
     * @var string
     */
    private $selectedCells <?php echo 'A1';

    /**
     * Cached highest column.
     *
     * @var int
     */
    private $cachedHighestColumn <?php echo 1;

    /**
     * Cached highest row.
     *
     * @var int
     */
    private $cachedHighestRow <?php echo 1;

    /**
     * Right-to-left?
     *
     * @var bool
     */
    private $rightToLeft <?php echo false;

    /**
     * Hyperlinks. Indexed by cell coordinate, e.g. 'A1'.
     *
     * @var array
     */
    private $hyperlinkCollection <?php echo [];

    /**
     * Data validation objects. Indexed by cell coordinate, e.g. 'A1'.
     *
     * @var array
     */
    private $dataValidationCollection <?php echo [];

    /**
     * Tab color.
     *
     * @var null|Color
     */
    private $tabColor;

    /**
     * Dirty flag.
     *
     * @var bool
     */
    private $dirty <?php echo true;

    /**
     * Hash.
     *
     * @var string
     */
    private $hash;

    /**
     * CodeName.
     *
     * @var string
     */
    private $codeName;

    /**
     * Create a new worksheet.
     *
     * @param string $title
     */
    public function __construct(?Spreadsheet $parent <?php echo null, $title <?php echo 'Worksheet')
    {
        // Set parent and title
        $this->parent <?php echo $parent;
        $this->setTitle($title, false);
        // setTitle can change $pTitle
        $this->setCodeName($this->getTitle());
        $this->setSheetState(self::SHEETSTATE_VISIBLE);

        $this->cellCollection <?php echo CellsFactory::getInstance($this);
        // Set page setup
        $this->pageSetup <?php echo new PageSetup();
        // Set page margins
        $this->pageMargins <?php echo new PageMargins();
        // Set page header/footer
        $this->headerFooter <?php echo new HeaderFooter();
        // Set sheet view
        $this->sheetView <?php echo new SheetView();
        // Drawing collection
        $this->drawingCollection <?php echo new ArrayObject();
        // Chart collection
        $this->chartCollection <?php echo new ArrayObject();
        // Protection
        $this->protection <?php echo new Protection();
        // Default row dimension
        $this->defaultRowDimension <?php echo new RowDimension(null);
        // Default column dimension
        $this->defaultColumnDimension <?php echo new ColumnDimension(null);
        // AutoFilter
        $this->autoFilter <?php echo new AutoFilter('', $this);
        // Table collection
        $this->tableCollection <?php echo new ArrayObject();
    }

    /**
     * Disconnect all cells from this Worksheet object,
     * typically so that the worksheet object can be unset.
     */
    public function disconnectCells(): void
    {
        if ($this->cellCollection !<?php echo<?php echo null) {
            $this->cellCollection->unsetWorksheetCells();
            // @phpstan-ignore-next-line
            $this->cellCollection <?php echo null;
        }
        //    detach ourself from the workbook, so that it can then delete this worksheet successfully
        $this->parent <?php echo null;
    }

    /**
     * Code to execute when this worksheet is unset().
     */
    public function __destruct()
    {
        Calculation::getInstance($this->parent)->clearCalculationCacheForWorksheet($this->title);

        $this->disconnectCells();
        $this->rowDimensions <?php echo [];
    }

    /**
     * Return the cell collection.
     *
     * @return Cells
     */
    public function getCellCollection()
    {
        return $this->cellCollection;
    }

    /**
     * Get array of invalid characters for sheet title.
     *
     * @return array
     */
    public static function getInvalidCharacters()
    {
        return self::$invalidCharacters;
    }

    /**
     * Check sheet code name for valid Excel syntax.
     *
     * @param string $sheetCodeName The string to check
     *
     * @return string The valid string
     */
    private static function checkSheetCodeName($sheetCodeName)
    {
        $charCount <?php echo Shared\StringHelper::countCharacters($sheetCodeName);
        if ($charCount <?php echo<?php echo 0) {
            throw new Exception('Sheet code name cannot be empty.');
        }
        // Some of the printable ASCII characters are invalid:  * : / \ ? [ ] and  first and last characters cannot be a "'"
        if (
            (str_replace(self::$invalidCharacters, '', $sheetCodeName) !<?php echo<?php echo $sheetCodeName) ||
            (Shared\StringHelper::substring($sheetCodeName, -1, 1) <?php echo<?php echo '\'') ||
            (Shared\StringHelper::substring($sheetCodeName, 0, 1) <?php echo<?php echo '\'')
        ) {
            throw new Exception('Invalid character found in sheet code name');
        }

        // Enforce maximum characters allowed for sheet title
        if ($charCount > self::SHEET_TITLE_MAXIMUM_LENGTH) {
            throw new Exception('Maximum ' . self::SHEET_TITLE_MAXIMUM_LENGTH . ' characters allowed in sheet code name.');
        }

        return $sheetCodeName;
    }

    /**
     * Check sheet title for valid Excel syntax.
     *
     * @param string $sheetTitle The string to check
     *
     * @return string The valid string
     */
    private static function checkSheetTitle($sheetTitle)
    {
        // Some of the printable ASCII characters are invalid:  * : / \ ? [ ]
        if (str_replace(self::$invalidCharacters, '', $sheetTitle) !<?php echo<?php echo $sheetTitle) {
            throw new Exception('Invalid character found in sheet title');
        }

        // Enforce maximum characters allowed for sheet title
        if (Shared\StringHelper::countCharacters($sheetTitle) > self::SHEET_TITLE_MAXIMUM_LENGTH) {
            throw new Exception('Maximum ' . self::SHEET_TITLE_MAXIMUM_LENGTH . ' characters allowed in sheet title.');
        }

        return $sheetTitle;
    }

    /**
     * Get a sorted list of all cell coordinates currently held in the collection by row and column.
     *
     * @param bool $sorted Also sort the cell collection?
     *
     * @return string[]
     */
    public function getCoordinates($sorted <?php echo true)
    {
        if ($this->cellCollection <?php echo<?php echo null) {
            return [];
        }

        if ($sorted) {
            return $this->cellCollection->getSortedCoordinates();
        }

        return $this->cellCollection->getCoordinates();
    }

    /**
     * Get collection of row dimensions.
     *
     * @return RowDimension[]
     */
    public function getRowDimensions()
    {
        return $this->rowDimensions;
    }

    /**
     * Get default row dimension.
     *
     * @return RowDimension
     */
    public function getDefaultRowDimension()
    {
        return $this->defaultRowDimension;
    }

    /**
     * Get collection of column dimensions.
     *
     * @return ColumnDimension[]
     */
    public function getColumnDimensions()
    {
        /** @var callable */
        $callable <?php echo [self::class, 'columnDimensionCompare'];
        uasort($this->columnDimensions, $callable);

        return $this->columnDimensions;
    }

    private static function columnDimensionCompare(ColumnDimension $a, ColumnDimension $b): int
    {
        return $a->getColumnNumeric() - $b->getColumnNumeric();
    }

    /**
     * Get default column dimension.
     *
     * @return ColumnDimension
     */
    public function getDefaultColumnDimension()
    {
        return $this->defaultColumnDimension;
    }

    /**
     * Get collection of drawings.
     *
     * @return ArrayObject<int, BaseDrawing>
     */
    public function getDrawingCollection()
    {
        return $this->drawingCollection;
    }

    /**
     * Get collection of charts.
     *
     * @return ArrayObject<int, Chart>
     */
    public function getChartCollection()
    {
        return $this->chartCollection;
    }

    /**
     * Add chart.
     *
     * @param null|int $chartIndex Index where chart should go (0,1,..., or null for last)
     *
     * @return Chart
     */
    public function addChart(Chart $chart, $chartIndex <?php echo null)
    {
        $chart->setWorksheet($this);
        if ($chartIndex <?php echo<?php echo<?php echo null) {
            $this->chartCollection[] <?php echo $chart;
        } else {
            // Insert the chart at the requested index
            // @phpstan-ignore-next-line
            array_splice(/** @scrutinizer ignore-type */ $this->chartCollection, $chartIndex, 0, [$chart]);
        }

        return $chart;
    }

    /**
     * Return the count of charts on this worksheet.
     *
     * @return int The number of charts
     */
    public function getChartCount()
    {
        return count($this->chartCollection);
    }

    /**
     * Get a chart by its index position.
     *
     * @param ?string $index Chart index position
     *
     * @return Chart|false
     */
    public function getChartByIndex($index)
    {
        $chartCount <?php echo count($this->chartCollection);
        if ($chartCount <?php echo<?php echo 0) {
            return false;
        }
        if ($index <?php echo<?php echo<?php echo null) {
            $index <?php echo --$chartCount;
        }
        if (!isset($this->chartCollection[$index])) {
            return false;
        }

        return $this->chartCollection[$index];
    }

    /**
     * Return an array of the names of charts on this worksheet.
     *
     * @return string[] The names of charts
     */
    public function getChartNames()
    {
        $chartNames <?php echo [];
        foreach ($this->chartCollection as $chart) {
            $chartNames[] <?php echo $chart->getName();
        }

        return $chartNames;
    }

    /**
     * Get a chart by name.
     *
     * @param string $chartName Chart name
     *
     * @return Chart|false
     */
    public function getChartByName($chartName)
    {
        foreach ($this->chartCollection as $index <?php echo> $chart) {
            if ($chart->getName() <?php echo<?php echo $chartName) {
                return $chart;
            }
        }

        return false;
    }

    /**
     * Refresh column dimensions.
     *
     * @return $this
     */
    public function refreshColumnDimensions()
    {
        $newColumnDimensions <?php echo [];
        foreach ($this->getColumnDimensions() as $objColumnDimension) {
            $newColumnDimensions[$objColumnDimension->getColumnIndex()] <?php echo $objColumnDimension;
        }

        $this->columnDimensions <?php echo $newColumnDimensions;

        return $this;
    }

    /**
     * Refresh row dimensions.
     *
     * @return $this
     */
    public function refreshRowDimensions()
    {
        $newRowDimensions <?php echo [];
        foreach ($this->getRowDimensions() as $objRowDimension) {
            $newRowDimensions[$objRowDimension->getRowIndex()] <?php echo $objRowDimension;
        }

        $this->rowDimensions <?php echo $newRowDimensions;

        return $this;
    }

    /**
     * Calculate worksheet dimension.
     *
     * @return string String containing the dimension of this worksheet
     */
    public function calculateWorksheetDimension()
    {
        // Return
        return 'A1:' . $this->getHighestColumn() . $this->getHighestRow();
    }

    /**
     * Calculate worksheet data dimension.
     *
     * @return string String containing the dimension of this worksheet that actually contain data
     */
    public function calculateWorksheetDataDimension()
    {
        // Return
        return 'A1:' . $this->getHighestDataColumn() . $this->getHighestDataRow();
    }

    /**
     * Calculate widths for auto-size columns.
     *
     * @return $this
     */
    public function calculateColumnWidths()
    {
        // initialize $autoSizes array
        $autoSizes <?php echo [];
        foreach ($this->getColumnDimensions() as $colDimension) {
            if ($colDimension->getAutoSize()) {
                $autoSizes[$colDimension->getColumnIndex()] <?php echo -1;
            }
        }

        // There is only something to do if there are some auto-size columns
        if (!empty($autoSizes)) {
            // build list of cells references that participate in a merge
            $isMergeCell <?php echo [];
            foreach ($this->getMergeCells() as $cells) {
                foreach (Coordinate::extractAllCellReferencesInRange($cells) as $cellReference) {
                    $isMergeCell[$cellReference] <?php echo true;
                }
            }

            $autoFilterIndentRanges <?php echo (new AutoFit($this))->getAutoFilterIndentRanges();

            // loop through all cells in the worksheet
            foreach ($this->getCoordinates(false) as $coordinate) {
                $cell <?php echo $this->getCellOrNull($coordinate);

                if ($cell !<?php echo<?php echo null && isset($autoSizes[$this->cellCollection->getCurrentColumn()])) {
                    //Determine if cell is in merge range
                    $isMerged <?php echo isset($isMergeCell[$this->cellCollection->getCurrentCoordinate()]);

                    //By default merged cells should be ignored
                    $isMergedButProceed <?php echo false;

                    //The only exception is if it's a merge range value cell of a 'vertical' range (1 column wide)
                    if ($isMerged && $cell->isMergeRangeValueCell()) {
                        $range <?php echo (string) $cell->getMergeRange();
                        $rangeBoundaries <?php echo Coordinate::rangeDimension($range);
                        if ($rangeBoundaries[0] <?php echo<?php echo<?php echo 1) {
                            $isMergedButProceed <?php echo true;
                        }
                    }

                    // Determine width if cell is not part of a merge or does and is a value cell of 1-column wide range
                    if (!$isMerged || $isMergedButProceed) {
                        // Determine if we need to make an adjustment for the first row in an AutoFilter range that
                        //    has a column filter dropdown
                        $filterAdjustment <?php echo false;
                        if (!empty($autoFilterIndentRanges)) {
                            foreach ($autoFilterIndentRanges as $autoFilterFirstRowRange) {
                                if ($cell->isInRange($autoFilterFirstRowRange)) {
                                    $filterAdjustment <?php echo true;

                                    break;
                                }
                            }
                        }

                        $indentAdjustment <?php echo $cell->getStyle()->getAlignment()->getIndent();
                        $indentAdjustment +<?php echo (int) ($cell->getStyle()->getAlignment()->getHorizontal() <?php echo<?php echo<?php echo Alignment::HORIZONTAL_CENTER);

                        // Calculated value
                        // To formatted string
                        $cellValue <?php echo NumberFormat::toFormattedString(
                            $cell->getCalculatedValue(),
                            (string) $this->getParentOrThrow()->getCellXfByIndex($cell->getXfIndex())
                                ->getNumberFormat()->getFormatCode()
                        );

                        if ($cellValue !<?php echo<?php echo null && $cellValue !<?php echo<?php echo '') {
                            $autoSizes[$this->cellCollection->getCurrentColumn()] <?php echo max(
                                $autoSizes[$this->cellCollection->getCurrentColumn()],
                                round(
                                    Shared\Font::calculateColumnWidth(
                                        $this->getParentOrThrow()->getCellXfByIndex($cell->getXfIndex())->getFont(),
                                        $cellValue,
                                        (int) $this->getParentOrThrow()->getCellXfByIndex($cell->getXfIndex())
                                            ->getAlignment()->getTextRotation(),
                                        $this->getParentOrThrow()->getDefaultStyle()->getFont(),
                                        $filterAdjustment,
                                        $indentAdjustment
                                    ),
                                    3
                                )
                            );
                        }
                    }
                }
            }

            // adjust column widths
            foreach ($autoSizes as $columnIndex <?php echo> $width) {
                if ($width <?php echo<?php echo -1) {
                    $width <?php echo $this->getDefaultColumnDimension()->getWidth();
                }
                $this->getColumnDimension($columnIndex)->setWidth($width);
            }
        }

        return $this;
    }

    /**
     * Get parent or null.
     */
    public function getParent(): ?Spreadsheet
    {
        return $this->parent;
    }

    /**
     * Get parent, throw exception if null.
     */
    public function getParentOrThrow(): Spreadsheet
    {
        if ($this->parent !<?php echo<?php echo null) {
            return $this->parent;
        }

        throw new Exception('Sheet does not have a parent.');
    }

    /**
     * Re-bind parent.
     *
     * @return $this
     */
    public function rebindParent(Spreadsheet $parent)
    {
        if ($this->parent !<?php echo<?php echo null) {
            $definedNames <?php echo $this->parent->getDefinedNames();
            foreach ($definedNames as $definedName) {
                $parent->addDefinedName($definedName);
            }

            $this->parent->removeSheetByIndex(
                $this->parent->getIndex($this)
            );
        }
        $this->parent <?php echo $parent;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title.
     *
     * @param string $title String containing the dimension of this worksheet
     * @param bool $updateFormulaCellReferences Flag indicating whether cell references in formulae should
     *            be updated to reflect the new sheet name.
     *          This should be left as the default true, unless you are
     *          certain that no formula cells on any worksheet contain
     *          references to this worksheet
     * @param bool $validate False to skip validation of new title. WARNING: This should only be set
     *                       at parse time (by Readers), where titles can be assumed to be valid.
     *
     * @return $this
     */
    public function setTitle($title, $updateFormulaCellReferences <?php echo true, $validate <?php echo true)
    {
        // Is this a 'rename' or not?
        if ($this->getTitle() <?php echo<?php echo $title) {
            return $this;
        }

        // Old title
        $oldTitle <?php echo $this->getTitle();

        if ($validate) {
            // Syntax check
            self::checkSheetTitle($title);

            if ($this->parent) {
                // Is there already such sheet name?
                if ($this->parent->sheetNameExists($title)) {
                    // Use name, but append with lowest possible integer

                    if (Shared\StringHelper::countCharacters($title) > 29) {
                        $title <?php echo Shared\StringHelper::substring($title, 0, 29);
                    }
                    $i <?php echo 1;
                    while ($this->parent->sheetNameExists($title . ' ' . $i)) {
                        ++$i;
                        if ($i <?php echo<?php echo 10) {
                            if (Shared\StringHelper::countCharacters($title) > 28) {
                                $title <?php echo Shared\StringHelper::substring($title, 0, 28);
                            }
                        } elseif ($i <?php echo<?php echo 100) {
                            if (Shared\StringHelper::countCharacters($title) > 27) {
                                $title <?php echo Shared\StringHelper::substring($title, 0, 27);
                            }
                        }
                    }

                    $title .<?php echo " $i";
                }
            }
        }

        // Set title
        $this->title <?php echo $title;
        $this->dirty <?php echo true;

        if ($this->parent && $this->parent->getCalculationEngine()) {
            // New title
            $newTitle <?php echo $this->getTitle();
            $this->parent->getCalculationEngine()
                ->renameCalculationCacheForWorksheet($oldTitle, $newTitle);
            if ($updateFormulaCellReferences) {
                ReferenceHelper::getInstance()->updateNamedFormulae($this->parent, $oldTitle, $newTitle);
            }
        }

        return $this;
    }

    /**
     * Get sheet state.
     *
     * @return string Sheet state (visible, hidden, veryHidden)
     */
    public function getSheetState()
    {
        return $this->sheetState;
    }

    /**
     * Set sheet state.
     *
     * @param string $value Sheet state (visible, hidden, veryHidden)
     *
     * @return $this
     */
    public function setSheetState($value)
    {
        $this->sheetState <?php echo $value;

        return $this;
    }

    /**
     * Get page setup.
     *
     * @return PageSetup
     */
    public function getPageSetup()
    {
        return $this->pageSetup;
    }

    /**
     * Set page setup.
     *
     * @return $this
     */
    public function setPageSetup(PageSetup $pageSetup)
    {
        $this->pageSetup <?php echo $pageSetup;

        return $this;
    }

    /**
     * Get page margins.
     *
     * @return PageMargins
     */
    public function getPageMargins()
    {
        return $this->pageMargins;
    }

    /**
     * Set page margins.
     *
     * @return $this
     */
    public function setPageMargins(PageMargins $pageMargins)
    {
        $this->pageMargins <?php echo $pageMargins;

        return $this;
    }

    /**
     * Get page header/footer.
     *
     * @return HeaderFooter
     */
    public function getHeaderFooter()
    {
        return $this->headerFooter;
    }

    /**
     * Set page header/footer.
     *
     * @return $this
     */
    public function setHeaderFooter(HeaderFooter $headerFooter)
    {
        $this->headerFooter <?php echo $headerFooter;

        return $this;
    }

    /**
     * Get sheet view.
     *
     * @return SheetView
     */
    public function getSheetView()
    {
        return $this->sheetView;
    }

    /**
     * Set sheet view.
     *
     * @return $this
     */
    public function setSheetView(SheetView $sheetView)
    {
        $this->sheetView <?php echo $sheetView;

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
     * Set Protection.
     *
     * @return $this
     */
    public function setProtection(Protection $protection)
    {
        $this->protection <?php echo $protection;
        $this->dirty <?php echo true;

        return $this;
    }

    /**
     * Get highest worksheet column.
     *
     * @param null|int|string $row Return the data highest column for the specified row,
     *                                     or the highest column of any row if no row number is passed
     *
     * @return string Highest column name
     */
    public function getHighestColumn($row <?php echo null)
    {
        if ($row <?php echo<?php echo<?php echo null) {
            return Coordinate::stringFromColumnIndex($this->cachedHighestColumn);
        }

        return $this->getHighestDataColumn($row);
    }

    /**
     * Get highest worksheet column that contains data.
     *
     * @param null|int|string $row Return the highest data column for the specified row,
     *                                     or the highest data column of any row if no row number is passed
     *
     * @return string Highest column name that contains data
     */
    public function getHighestDataColumn($row <?php echo null)
    {
        return $this->cellCollection->getHighestColumn($row);
    }

    /**
     * Get highest worksheet row.
     *
     * @param null|string $column Return the highest data row for the specified column,
     *                                     or the highest row of any column if no column letter is passed
     *
     * @return int Highest row number
     */
    public function getHighestRow($column <?php echo null)
    {
        if ($column <?php echo<?php echo<?php echo null) {
            return $this->cachedHighestRow;
        }

        return $this->getHighestDataRow($column);
    }

    /**
     * Get highest worksheet row that contains data.
     *
     * @param null|string $column Return the highest data row for the specified column,
     *                                     or the highest data row of any column if no column letter is passed
     *
     * @return int Highest row number that contains data
     */
    public function getHighestDataRow($column <?php echo null)
    {
        return $this->cellCollection->getHighestRow($column);
    }

    /**
     * Get highest worksheet column and highest row that have cell records.
     *
     * @return array Highest column name and highest row number
     */
    public function getHighestRowAndColumn()
    {
        return $this->cellCollection->getHighestRowAndColumn();
    }

    /**
     * Set a cell value.
     *
     * @param array<int>|CellAddress|string $coordinate Coordinate of the cell as a string, eg: 'C5';
     *               or as an array of [$columnIndex, $row] (e.g. [3, 5]), or a CellAddress object.
     * @param mixed $value Value for the cell
     * @param null|IValueBinder $binder Value Binder to override the currently set Value Binder
     *
     * @return $this
     */
    public function setCellValue($coordinate, $value, ?IValueBinder $binder <?php echo null)
    {
        $cellAddress <?php echo Functions::trimSheetFromCellReference(Validations::validateCellAddress($coordinate));
        $this->getCell($cellAddress)->setValue($value, $binder);

        return $this;
    }

    /**
     * Set a cell value by using numeric cell coordinates.
     *
     * @deprecated 1.23.0
     *      Use the setCellValue() method with a cell address such as 'C5' instead;,
     *          or passing in an array of [$columnIndex, $row] (e.g. [3, 5]), or a CellAddress object.
     * @see Worksheet::setCellValue()
     *
     * @param int $columnIndex Numeric column coordinate of the cell
     * @param int $row Numeric row coordinate of the cell
     * @param mixed $value Value of the cell
     * @param null|IValueBinder $binder Value Binder to override the currently set Value Binder
     *
     * @return $this
     */
    public function setCellValueByColumnAndRow($columnIndex, $row, $value, ?IValueBinder $binder <?php echo null)
    {
        $this->getCell(Coordinate::stringFromColumnIndex($columnIndex) . $row)->setValue($value, $binder);

        return $this;
    }

    /**
     * Set a cell value.
     *
     * @param array<int>|CellAddress|string $coordinate Coordinate of the cell as a string, eg: 'C5';
     *               or as an array of [$columnIndex, $row] (e.g. [3, 5]), or a CellAddress object.
     * @param mixed $value Value of the cell
     * @param string $dataType Explicit data type, see DataType::TYPE_*
     *        Note that PhpSpreadsheet does not validate that the value and datatype are consistent, in using this
     *             method, then it is your responsibility as an end-user developer to validate that the value and
     *             the datatype match.
     *       If you do mismatch value and datatpe, then the value you enter may be changed to match the datatype
     *          that you specify.
     *
     * @see DataType
     *
     * @return $this
     */
    public function setCellValueExplicit($coordinate, $value, $dataType)
    {
        $cellAddress <?php echo Functions::trimSheetFromCellReference(Validations::validateCellAddress($coordinate));
        $this->getCell($cellAddress)->setValueExplicit($value, $dataType);

        return $this;
    }

    /**
     * Set a cell value by using numeric cell coordinates.
     *
     * @deprecated 1.23.0
     *      Use the setCellValueExplicit() method with a cell address such as 'C5' instead;,
     *          or passing in an array of [$columnIndex, $row] (e.g. [3, 5]), or a CellAddress object.
     * @see Worksheet::setCellValueExplicit()
     *
     * @param int $columnIndex Numeric column coordinate of the cell
     * @param int $row Numeric row coordinate of the cell
     * @param mixed $value Value of the cell
     * @param string $dataType Explicit data type, see DataType::TYPE_*
     *        Note that PhpSpreadsheet does not validate that the value and datatype are consistent, in using this
     *             method, then it is your responsibility as an end-user developer to validate that the value and
     *             the datatype match.
     *       If you do mismatch value and datatpe, then the value you enter may be changed to match the datatype
     *          that you specify.
     *
     * @see DataType
     *
     * @return $this
     */
    public function setCellValueExplicitByColumnAndRow($columnIndex, $row, $value, $dataType)
    {
        $this->getCell(Coordinate::stringFromColumnIndex($columnIndex) . $row)->setValueExplicit($value, $dataType);

        return $this;
    }

    /**
     * Get cell at a specific coordinate.
     *
     * @param array<int>|CellAddress|string $coordinate Coordinate of the cell as a string, eg: 'C5';
     *               or as an array of [$columnIndex, $row] (e.g. [3, 5]), or a CellAddress object.
     *
     * @return Cell Cell that was found or created
     *              WARNING: Because the cell collection can be cached to reduce memory, it only allows one
     *              "active" cell at a time in memory. If you assign that cell to a variable, then select
     *              another cell using getCell() or any of its variants, the newly selected cell becomes
     *              the "active" cell, and any previous assignment becomes a disconnected reference because
     *              the active cell has changed.
     */
    public function getCell($coordinate): Cell
    {
        $cellAddress <?php echo Functions::trimSheetFromCellReference(Validations::validateCellAddress($coordinate));

        // Shortcut for increased performance for the vast majority of simple cases
        if ($this->cellCollection->has($cellAddress)) {
            /** @var Cell $cell */
            $cell <?php echo $this->cellCollection->get($cellAddress);

            return $cell;
        }

        /** @var Worksheet $sheet */
        [$sheet, $finalCoordinate] <?php echo $this->getWorksheetAndCoordinate($cellAddress);
        $cell <?php echo $sheet->cellCollection->get($finalCoordinate);

        return $cell ?? $sheet->createNewCell($finalCoordinate);
    }

    /**
     * Get the correct Worksheet and coordinate from a coordinate that may
     * contains reference to another sheet or a named range.
     *
     * @return array{0: Worksheet, 1: string}
     */
    private function getWorksheetAndCoordinate(string $coordinate): array
    {
        $sheet <?php echo null;
        $finalCoordinate <?php echo null;

        // Worksheet reference?
        if (strpos($coordinate, '!') !<?php echo<?php echo false) {
            $worksheetReference <?php echo self::extractSheetTitle($coordinate, true);

            $sheet <?php echo $this->getParentOrThrow()->getSheetByName($worksheetReference[0]);
            $finalCoordinate <?php echo strtoupper($worksheetReference[1]);

            if ($sheet <?php echo<?php echo<?php echo null) {
                throw new Exception('Sheet not found for name: ' . $worksheetReference[0]);
            }
        } elseif (
            !preg_match('/^' . Calculation::CALCULATION_REGEXP_CELLREF . '$/i', $coordinate) &&
            preg_match('/^' . Calculation::CALCULATION_REGEXP_DEFINEDNAME . '$/iu', $coordinate)
        ) {
            // Named range?
            $namedRange <?php echo $this->validateNamedRange($coordinate, true);
            if ($namedRange !<?php echo<?php echo null) {
                $sheet <?php echo $namedRange->getWorksheet();
                if ($sheet <?php echo<?php echo<?php echo null) {
                    throw new Exception('Sheet not found for named range: ' . $namedRange->getName());
                }

                /** @phpstan-ignore-next-line */
                $cellCoordinate <?php echo ltrim(substr($namedRange->getValue(), strrpos($namedRange->getValue(), '!')), '!');
                $finalCoordinate <?php echo str_replace('$', '', $cellCoordinate);
            }
        }

        if ($sheet <?php echo<?php echo<?php echo null || $finalCoordinate <?php echo<?php echo<?php echo null) {
            $sheet <?php echo $this;
            $finalCoordinate <?php echo strtoupper($coordinate);
        }

        if (Coordinate::coordinateIsRange($finalCoordinate)) {
            throw new Exception('Cell coordinate string can not be a range of cells.');
        } elseif (strpos($finalCoordinate, '$') !<?php echo<?php echo false) {
            throw new Exception('Cell coordinate must not be absolute.');
        }

        return [$sheet, $finalCoordinate];
    }

    /**
     * Get an existing cell at a specific coordinate, or null.
     *
     * @param string $coordinate Coordinate of the cell, eg: 'A1'
     *
     * @return null|Cell Cell that was found or null
     */
    private function getCellOrNull($coordinate): ?Cell
    {
        // Check cell collection
        if ($this->cellCollection->has($coordinate)) {
            return $this->cellCollection->get($coordinate);
        }

        return null;
    }

    /**
     * Get cell at a specific coordinate by using numeric cell coordinates.
     *
     * @deprecated 1.23.0
     *      Use the getCell() method with a cell address such as 'C5' instead;,
     *          or passing in an array of [$columnIndex, $row] (e.g. [3, 5]), or a CellAddress object.
     * @see Worksheet::getCell()
     *
     * @param int $columnIndex Numeric column coordinate of the cell
     * @param int $row Numeric row coordinate of the cell
     *
     * @return Cell Cell that was found/created or null
     *              WARNING: Because the cell collection can be cached to reduce memory, it only allows one
     *              "active" cell at a time in memory. If you assign that cell to a variable, then select
     *              another cell using getCell() or any of its variants, the newly selected cell becomes
     *              the "active" cell, and any previous assignment becomes a disconnected reference because
     *              the active cell has changed.
     */
    public function getCellByColumnAndRow($columnIndex, $row): Cell
    {
        return $this->getCell(Coordinate::stringFromColumnIndex($columnIndex) . $row);
    }

    /**
     * Create a new cell at the specified coordinate.
     *
     * @param string $coordinate Coordinate of the cell
     *
     * @return Cell Cell that was created
     *              WARNING: Because the cell collection can be cached to reduce memory, it only allows one
     *              "active" cell at a time in memory. If you assign that cell to a variable, then select
     *              another cell using getCell() or any of its variants, the newly selected cell becomes
     *              the "active" cell, and any previous assignment becomes a disconnected reference because
     *              the active cell has changed.
     */
    public function createNewCell($coordinate): Cell
    {
        [$column, $row, $columnString] <?php echo Coordinate::indexesFromString($coordinate);
        $cell <?php echo new Cell(null, DataType::TYPE_NULL, $this);
        $this->cellCollection->add($coordinate, $cell);

        // Coordinates
        if ($column > $this->cachedHighestColumn) {
            $this->cachedHighestColumn <?php echo $column;
        }
        if ($row > $this->cachedHighestRow) {
            $this->cachedHighestRow <?php echo $row;
        }

        // Cell needs appropriate xfIndex from dimensions records
        //    but don't create dimension records if they don't already exist
        $rowDimension <?php echo $this->rowDimensions[$row] ?? null;
        $columnDimension <?php echo $this->columnDimensions[$columnString] ?? null;

        if ($rowDimension !<?php echo<?php echo null) {
            $rowXf <?php echo (int) $rowDimension->getXfIndex();
            if ($rowXf > 0) {
                // then there is a row dimension with explicit style, assign it to the cell
                $cell->setXfIndex($rowXf);
            }
        } elseif ($columnDimension !<?php echo<?php echo null) {
            $colXf <?php echo (int) $columnDimension->getXfIndex();
            if ($colXf > 0) {
                // then there is a column dimension, assign it to the cell
                $cell->setXfIndex($colXf);
            }
        }

        return $cell;
    }

    /**
     * Does the cell at a specific coordinate exist?
     *
     * @param array<int>|CellAddress|string $coordinate Coordinate of the cell as a string, eg: 'C5';
     *               or as an array of [$columnIndex, $row] (e.g. [3, 5]), or a CellAddress object.
     */
    public function cellExists($coordinate): bool
    {
        $cellAddress <?php echo Validations::validateCellAddress($coordinate);
        /** @var Worksheet $sheet */
        [$sheet, $finalCoordinate] <?php echo $this->getWorksheetAndCoordinate($cellAddress);

        return $sheet->cellCollection->has($finalCoordinate);
    }

    /**
     * Cell at a specific coordinate by using numeric cell coordinates exists?
     *
     * @deprecated 1.23.0
     *      Use the cellExists() method with a cell address such as 'C5' instead;,
     *          or passing in an array of [$columnIndex, $row] (e.g. [3, 5]), or a CellAddress object.
     * @see Worksheet::cellExists()
     *
     * @param int $columnIndex Numeric column coordinate of the cell
     * @param int $row Numeric row coordinate of the cell
     */
    public function cellExistsByColumnAndRow($columnIndex, $row): bool
    {
        return $this->cellExists(Coordinate::stringFromColumnIndex($columnIndex) . $row);
    }

    /**
     * Get row dimension at a specific row.
     *
     * @param int $row Numeric index of the row
     */
    public function getRowDimension(int $row): RowDimension
    {
        // Get row dimension
        if (!isset($this->rowDimensions[$row])) {
            $this->rowDimensions[$row] <?php echo new RowDimension($row);

            $this->cachedHighestRow <?php echo max($this->cachedHighestRow, $row);
        }

        return $this->rowDimensions[$row];
    }

    public function rowDimensionExists(int $row): bool
    {
        return isset($this->rowDimensions[$row]);
    }

    /**
     * Get column dimension at a specific column.
     *
     * @param string $column String index of the column eg: 'A'
     */
    public function getColumnDimension(string $column): ColumnDimension
    {
        // Uppercase coordinate
        $column <?php echo strtoupper($column);

        // Fetch dimensions
        if (!isset($this->columnDimensions[$column])) {
            $this->columnDimensions[$column] <?php echo new ColumnDimension($column);

            $columnIndex <?php echo Coordinate::columnIndexFromString($column);
            if ($this->cachedHighestColumn < $columnIndex) {
                $this->cachedHighestColumn <?php echo $columnIndex;
            }
        }

        return $this->columnDimensions[$column];
    }

    /**
     * Get column dimension at a specific column by using numeric cell coordinates.
     *
     * @param int $columnIndex Numeric column coordinate of the cell
     */
    public function getColumnDimensionByColumn(int $columnIndex): ColumnDimension
    {
        return $this->getColumnDimension(Coordinate::stringFromColumnIndex($columnIndex));
    }

    /**
     * Get styles.
     *
     * @return Style[]
     */
    public function getStyles()
    {
        return $this->styles;
    }

    /**
     * Get style for cell.
     *
     * @param AddressRange|array<int>|CellAddress|int|string $cellCoordinate
     *              A simple string containing a cell address like 'A1' or a cell range like 'A1:E10'
     *              or passing in an array of [$fromColumnIndex, $fromRow, $toColumnIndex, $toRow] (e.g. [3, 5, 6, 8]),
     *              or a CellAddress or AddressRange object.
     */
    public function getStyle($cellCoordinate): Style
    {
        $cellCoordinate <?php echo Validations::validateCellOrCellRange($cellCoordinate);

        // set this sheet as active
        $this->getParentOrThrow()->setActiveSheetIndex($this->getParentOrThrow()->getIndex($this));

        // set cell coordinate as active
        $this->setSelectedCells($cellCoordinate);

        return $this->getParentOrThrow()->getCellXfSupervisor();
    }

    /**
     * Get style for cell by using numeric cell coordinates.
     *
     * @deprecated 1.23.0
     *      Use the getStyle() method with a cell address range such as 'C5:F8' instead;,
     *          or passing in an array of [$fromColumnIndex, $fromRow, $toColumnIndex, $toRow] (e.g. [3, 5, 6, 8]),
     *          or an AddressRange object.
     * @see Worksheet::getStyle()
     *
     * @param int $columnIndex1 Numeric column coordinate of the cell
     * @param int $row1 Numeric row coordinate of the cell
     * @param null|int $columnIndex2 Numeric column coordinate of the range cell
     * @param null|int $row2 Numeric row coordinate of the range cell
     *
     * @return Style
     */
    public function getStyleByColumnAndRow($columnIndex1, $row1, $columnIndex2 <?php echo null, $row2 <?php echo null)
    {
        if ($columnIndex2 !<?php echo<?php echo null && $row2 !<?php echo<?php echo null) {
            $cellRange <?php echo new CellRange(
                CellAddress::fromColumnAndRow($columnIndex1, $row1),
                CellAddress::fromColumnAndRow($columnIndex2, $row2)
            );

            return $this->getStyle($cellRange);
        }

        return $this->getStyle(CellAddress::fromColumnAndRow($columnIndex1, $row1));
    }

    /**
     * Get conditional styles for a cell.
     *
     * @param string $coordinate eg: 'A1' or 'A1:A3'.
     *          If a single cell is referenced, then the array of conditional styles will be returned if the cell is
     *               included in a conditional style range.
     *          If a range of cells is specified, then the styles will only be returned if the range matches the entire
     *               range of the conditional.
     *
     * @return Conditional[]
     */
    public function getConditionalStyles(string $coordinate): array
    {
        $coordinate <?php echo strtoupper($coordinate);
        if (strpos($coordinate, ':') !<?php echo<?php echo false) {
            return $this->conditionalStylesCollection[$coordinate] ?? [];
        }

        $cell <?php echo $this->getCell($coordinate);
        foreach (array_keys($this->conditionalStylesCollection) as $conditionalRange) {
            if ($cell->isInRange($conditionalRange)) {
                return $this->conditionalStylesCollection[$conditionalRange];
            }
        }

        return [];
    }

    public function getConditionalRange(string $coordinate): ?string
    {
        $coordinate <?php echo strtoupper($coordinate);
        $cell <?php echo $this->getCell($coordinate);
        foreach (array_keys($this->conditionalStylesCollection) as $conditionalRange) {
            if ($cell->isInRange($conditionalRange)) {
                return $conditionalRange;
            }
        }

        return null;
    }

    /**
     * Do conditional styles exist for this cell?
     *
     * @param string $coordinate eg: 'A1' or 'A1:A3'.
     *          If a single cell is specified, then this method will return true if that cell is included in a
     *               conditional style range.
     *          If a range of cells is specified, then true will only be returned if the range matches the entire
     *               range of the conditional.
     */
    public function conditionalStylesExists($coordinate): bool
    {
        $coordinate <?php echo strtoupper($coordinate);
        if (strpos($coordinate, ':') !<?php echo<?php echo false) {
            return isset($this->conditionalStylesCollection[$coordinate]);
        }

        $cell <?php echo $this->getCell($coordinate);
        foreach (array_keys($this->conditionalStylesCollection) as $conditionalRange) {
            if ($cell->isInRange($conditionalRange)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Removes conditional styles for a cell.
     *
     * @param string $coordinate eg: 'A1'
     *
     * @return $this
     */
    public function removeConditionalStyles($coordinate)
    {
        unset($this->conditionalStylesCollection[strtoupper($coordinate)]);

        return $this;
    }

    /**
     * Get collection of conditional styles.
     *
     * @return array
     */
    public function getConditionalStylesCollection()
    {
        return $this->conditionalStylesCollection;
    }

    /**
     * Set conditional styles.
     *
     * @param string $coordinate eg: 'A1'
     * @param Conditional[] $styles
     *
     * @return $this
     */
    public function setConditionalStyles($coordinate, $styles)
    {
        $this->conditionalStylesCollection[strtoupper($coordinate)] <?php echo $styles;

        return $this;
    }

    /**
     * Duplicate cell style to a range of cells.
     *
     * Please note that this will overwrite existing cell styles for cells in range!
     *
     * @param Style $style Cell style to duplicate
     * @param string $range Range of cells (i.e. "A1:B10"), or just one cell (i.e. "A1")
     *
     * @return $this
     */
    public function duplicateStyle(Style $style, $range)
    {
        // Add the style to the workbook if necessary
        $workbook <?php echo $this->getParentOrThrow();
        if ($existingStyle <?php echo $workbook->getCellXfByHashCode($style->getHashCode())) {
            // there is already such cell Xf in our collection
            $xfIndex <?php echo $existingStyle->getIndex();
        } else {
            // we don't have such a cell Xf, need to add
            $workbook->addCellXf($style);
            $xfIndex <?php echo $style->getIndex();
        }

        // Calculate range outer borders
        [$rangeStart, $rangeEnd] <?php echo Coordinate::rangeBoundaries($range . ':' . $range);

        // Make sure we can loop upwards on rows and columns
        if ($rangeStart[0] > $rangeEnd[0] && $rangeStart[1] > $rangeEnd[1]) {
            $tmp <?php echo $rangeStart;
            $rangeStart <?php echo $rangeEnd;
            $rangeEnd <?php echo $tmp;
        }

        // Loop through cells and apply styles
        for ($col <?php echo $rangeStart[0]; $col <?php echo $rangeEnd[0]; ++$col) {
            for ($row <?php echo $rangeStart[1]; $row <?php echo $rangeEnd[1]; ++$row) {
                $this->getCell(Coordinate::stringFromColumnIndex($col) . $row)->setXfIndex($xfIndex);
            }
        }

        return $this;
    }

    /**
     * Duplicate conditional style to a range of cells.
     *
     * Please note that this will overwrite existing cell styles for cells in range!
     *
     * @param Conditional[] $styles Cell style to duplicate
     * @param string $range Range of cells (i.e. "A1:B10"), or just one cell (i.e. "A1")
     *
     * @return $this
     */
    public function duplicateConditionalStyle(array $styles, $range <?php echo '')
    {
        foreach ($styles as $cellStyle) {
            if (!($cellStyle instanceof Conditional)) {
                throw new Exception('Style is not a conditional style');
            }
        }

        // Calculate range outer borders
        [$rangeStart, $rangeEnd] <?php echo Coordinate::rangeBoundaries($range . ':' . $range);

        // Make sure we can loop upwards on rows and columns
        if ($rangeStart[0] > $rangeEnd[0] && $rangeStart[1] > $rangeEnd[1]) {
            $tmp <?php echo $rangeStart;
            $rangeStart <?php echo $rangeEnd;
            $rangeEnd <?php echo $tmp;
        }

        // Loop through cells and apply styles
        for ($col <?php echo $rangeStart[0]; $col <?php echo $rangeEnd[0]; ++$col) {
            for ($row <?php echo $rangeStart[1]; $row <?php echo $rangeEnd[1]; ++$row) {
                $this->setConditionalStyles(Coordinate::stringFromColumnIndex($col) . $row, $styles);
            }
        }

        return $this;
    }

    /**
     * Set break on a cell.
     *
     * @param array<int>|CellAddress|string $coordinate Coordinate of the cell as a string, eg: 'C5';
     *               or as an array of [$columnIndex, $row] (e.g. [3, 5]), or a CellAddress object.
     * @param int $break Break type (type of Worksheet::BREAK_*)
     *
     * @return $this
     */
    public function setBreak($coordinate, $break, int $max <?php echo -1)
    {
        $cellAddress <?php echo Functions::trimSheetFromCellReference(Validations::validateCellAddress($coordinate));

        if ($break <?php echo<?php echo<?php echo self::BREAK_NONE) {
            unset($this->rowBreaks[$cellAddress], $this->columnBreaks[$cellAddress]);
        } elseif ($break <?php echo<?php echo<?php echo self::BREAK_ROW) {
            $this->rowBreaks[$cellAddress] <?php echo new PageBreak($break, $cellAddress, $max);
        } elseif ($break <?php echo<?php echo<?php echo self::BREAK_COLUMN) {
            $this->columnBreaks[$cellAddress] <?php echo new PageBreak($break, $cellAddress, $max);
        }

        return $this;
    }

    /**
     * Set break on a cell by using numeric cell coordinates.
     *
     * @deprecated 1.23.0
     *      Use the setBreak() method with a cell address such as 'C5' instead;,
     *          or passing in an array of [$columnIndex, $row] (e.g. [3, 5]), or a CellAddress object.
     * @see Worksheet::setBreak()
     *
     * @param int $columnIndex Numeric column coordinate of the cell
     * @param int $row Numeric row coordinate of the cell
     * @param int $break Break type (type of Worksheet::BREAK_*)
     *
     * @return $this
     */
    public function setBreakByColumnAndRow($columnIndex, $row, $break)
    {
        return $this->setBreak(Coordinate::stringFromColumnIndex($columnIndex) . $row, $break);
    }

    /**
     * Get breaks.
     *
     * @return int[]
     */
    public function getBreaks()
    {
        $breaks <?php echo [];
        /** @var callable */
        $compareFunction <?php echo [self::class, 'compareRowBreaks'];
        uksort($this->rowBreaks, $compareFunction);
        foreach ($this->rowBreaks as $break) {
            $breaks[$break->getCoordinate()] <?php echo self::BREAK_ROW;
        }
        /** @var callable */
        $compareFunction <?php echo [self::class, 'compareColumnBreaks'];
        uksort($this->columnBreaks, $compareFunction);
        foreach ($this->columnBreaks as $break) {
            $breaks[$break->getCoordinate()] <?php echo self::BREAK_COLUMN;
        }

        return $breaks;
    }

    /**
     * Get row breaks.
     *
     * @return PageBreak[]
     */
    public function getRowBreaks()
    {
        /** @var callable */
        $compareFunction <?php echo [self::class, 'compareRowBreaks'];
        uksort($this->rowBreaks, $compareFunction);

        return $this->rowBreaks;
    }

    protected static function compareRowBreaks(string $coordinate1, string $coordinate2): int
    {
        $row1 <?php echo Coordinate::indexesFromString($coordinate1)[1];
        $row2 <?php echo Coordinate::indexesFromString($coordinate2)[1];

        return $row1 - $row2;
    }

    protected static function compareColumnBreaks(string $coordinate1, string $coordinate2): int
    {
        $column1 <?php echo Coordinate::indexesFromString($coordinate1)[0];
        $column2 <?php echo Coordinate::indexesFromString($coordinate2)[0];

        return $column1 - $column2;
    }

    /**
     * Get column breaks.
     *
     * @return PageBreak[]
     */
    public function getColumnBreaks()
    {
        /** @var callable */
        $compareFunction <?php echo [self::class, 'compareColumnBreaks'];
        uksort($this->columnBreaks, $compareFunction);

        return $this->columnBreaks;
    }

    /**
     * Set merge on a cell range.
     *
     * @param AddressRange|array<int>|string $range A simple string containing a Cell range like 'A1:E10'
     *              or passing in an array of [$fromColumnIndex, $fromRow, $toColumnIndex, $toRow] (e.g. [3, 5, 6, 8]),
     *              or an AddressRange.
     * @param string $behaviour How the merged cells should behave.
     *               Possible values are:
     *                   MERGE_CELL_CONTENT_EMPTY - Empty the content of the hidden cells
     *                   MERGE_CELL_CONTENT_HIDE - Keep the content of the hidden cells
     *                   MERGE_CELL_CONTENT_MERGE - Move the content of the hidden cells into the first cell
     *
     * @return $this
     */
    public function mergeCells($range, $behaviour <?php echo self::MERGE_CELL_CONTENT_EMPTY)
    {
        $range <?php echo Functions::trimSheetFromCellReference(Validations::validateCellRange($range));

        if (strpos($range, ':') <?php echo<?php echo<?php echo false) {
            $range .<?php echo ":{$range}";
        }

        if (preg_match('/^([A-Z]+)(\\d+):([A-Z]+)(\\d+)$/', $range, $matches) !<?php echo<?php echo 1) {
            throw new Exception('Merge must be on a valid range of cells.');
        }

        $this->mergeCells[$range] <?php echo $range;
        $firstRow <?php echo (int) $matches[2];
        $lastRow <?php echo (int) $matches[4];
        $firstColumn <?php echo $matches[1];
        $lastColumn <?php echo $matches[3];
        $firstColumnIndex <?php echo Coordinate::columnIndexFromString($firstColumn);
        $lastColumnIndex <?php echo Coordinate::columnIndexFromString($lastColumn);
        $numberRows <?php echo $lastRow - $firstRow;
        $numberColumns <?php echo $lastColumnIndex - $firstColumnIndex;

        if ($numberRows <?php echo<?php echo<?php echo 1 && $numberColumns <?php echo<?php echo<?php echo 1) {
            return $this;
        }

        // create upper left cell if it does not already exist
        $upperLeft <?php echo "{$firstColumn}{$firstRow}";
        if (!$this->cellExists($upperLeft)) {
            $this->getCell($upperLeft)->setValueExplicit(null, DataType::TYPE_NULL);
        }

        if ($behaviour !<?php echo<?php echo self::MERGE_CELL_CONTENT_HIDE) {
            // Blank out the rest of the cells in the range (if they exist)
            if ($numberRows > $numberColumns) {
                $this->clearMergeCellsByColumn($firstColumn, $lastColumn, $firstRow, $lastRow, $upperLeft, $behaviour);
            } else {
                $this->clearMergeCellsByRow($firstColumn, $lastColumnIndex, $firstRow, $lastRow, $upperLeft, $behaviour);
            }
        }

        return $this;
    }

    private function clearMergeCellsByColumn(string $firstColumn, string $lastColumn, int $firstRow, int $lastRow, string $upperLeft, string $behaviour): void
    {
        $leftCellValue <?php echo ($behaviour <?php echo<?php echo<?php echo self::MERGE_CELL_CONTENT_MERGE)
            ? [$this->getCell($upperLeft)->getFormattedValue()]
            : [];

        foreach ($this->getColumnIterator($firstColumn, $lastColumn) as $column) {
            $iterator <?php echo $column->getCellIterator($firstRow);
            $iterator->setIterateOnlyExistingCells(true);
            foreach ($iterator as $cell) {
                if ($cell !<?php echo<?php echo null) {
                    $row <?php echo $cell->getRow();
                    if ($row > $lastRow) {
                        break;
                    }
                    $leftCellValue <?php echo $this->mergeCellBehaviour($cell, $upperLeft, $behaviour, $leftCellValue);
                }
            }
        }

        if ($behaviour <?php echo<?php echo<?php echo self::MERGE_CELL_CONTENT_MERGE) {
            $this->getCell($upperLeft)->setValueExplicit(implode(' ', $leftCellValue), DataType::TYPE_STRING);
        }
    }

    private function clearMergeCellsByRow(string $firstColumn, int $lastColumnIndex, int $firstRow, int $lastRow, string $upperLeft, string $behaviour): void
    {
        $leftCellValue <?php echo ($behaviour <?php echo<?php echo<?php echo self::MERGE_CELL_CONTENT_MERGE)
            ? [$this->getCell($upperLeft)->getFormattedValue()]
            : [];

        foreach ($this->getRowIterator($firstRow, $lastRow) as $row) {
            $iterator <?php echo $row->getCellIterator($firstColumn);
            $iterator->setIterateOnlyExistingCells(true);
            foreach ($iterator as $cell) {
                if ($cell !<?php echo<?php echo null) {
                    $column <?php echo $cell->getColumn();
                    $columnIndex <?php echo Coordinate::columnIndexFromString($column);
                    if ($columnIndex > $lastColumnIndex) {
                        break;
                    }
                    $leftCellValue <?php echo $this->mergeCellBehaviour($cell, $upperLeft, $behaviour, $leftCellValue);
                }
            }
        }

        if ($behaviour <?php echo<?php echo<?php echo self::MERGE_CELL_CONTENT_MERGE) {
            $this->getCell($upperLeft)->setValueExplicit(implode(' ', $leftCellValue), DataType::TYPE_STRING);
        }
    }

    public function mergeCellBehaviour(Cell $cell, string $upperLeft, string $behaviour, array $leftCellValue): array
    {
        if ($cell->getCoordinate() !<?php echo<?php echo $upperLeft) {
            Calculation::getInstance($cell->getWorksheet()->getParentOrThrow())->flushInstance();
            if ($behaviour <?php echo<?php echo<?php echo self::MERGE_CELL_CONTENT_MERGE) {
                $cellValue <?php echo $cell->getFormattedValue();
                if ($cellValue !<?php echo<?php echo '') {
                    $leftCellValue[] <?php echo $cellValue;
                }
            }
            $cell->setValueExplicit(null, DataType::TYPE_NULL);
        }

        return $leftCellValue;
    }

    /**
     * Set merge on a cell range by using numeric cell coordinates.
     *
     * @deprecated 1.23.0
     *      Use the mergeCells() method with a cell address range such as 'C5:F8' instead;,
     *          or passing in an array of [$fromColumnIndex, $fromRow, $toColumnIndex, $toRow] (e.g. [3, 5, 6, 8]),
     *          or an AddressRange object.
     * @see Worksheet::mergeCells()
     *
     * @param int $columnIndex1 Numeric column coordinate of the first cell
     * @param int $row1 Numeric row coordinate of the first cell
     * @param int $columnIndex2 Numeric column coordinate of the last cell
     * @param int $row2 Numeric row coordinate of the last cell
     * @param string $behaviour How the merged cells should behave.
     *               Possible values are:
     *                   MERGE_CELL_CONTENT_EMPTY - Empty the content of the hidden cells
     *                   MERGE_CELL_CONTENT_HIDE - Keep the content of the hidden cells
     *                   MERGE_CELL_CONTENT_MERGE - Move the content of the hidden cells into the first cell
     *
     * @return $this
     */
    public function mergeCellsByColumnAndRow($columnIndex1, $row1, $columnIndex2, $row2, $behaviour <?php echo self::MERGE_CELL_CONTENT_EMPTY)
    {
        $cellRange <?php echo new CellRange(
            CellAddress::fromColumnAndRow($columnIndex1, $row1),
            CellAddress::fromColumnAndRow($columnIndex2, $row2)
        );

        return $this->mergeCells($cellRange, $behaviour);
    }

    /**
     * Remove merge on a cell range.
     *
     * @param AddressRange|array<int>|string $range A simple string containing a Cell range like 'A1:E10'
     *              or passing in an array of [$fromColumnIndex, $fromRow, $toColumnIndex, $toRow] (e.g. [3, 5, 6, 8]),
     *              or an AddressRange.
     *
     * @return $this
     */
    public function unmergeCells($range)
    {
        $range <?php echo Functions::trimSheetFromCellReference(Validations::validateCellRange($range));

        if (strpos($range, ':') !<?php echo<?php echo false) {
            if (isset($this->mergeCells[$range])) {
                unset($this->mergeCells[$range]);
            } else {
                throw new Exception('Cell range ' . $range . ' not known as merged.');
            }
        } else {
            throw new Exception('Merge can only be removed from a range of cells.');
        }

        return $this;
    }

    /**
     * Remove merge on a cell range by using numeric cell coordinates.
     *
     * @deprecated 1.23.0
     *      Use the unmergeCells() method with a cell address range such as 'C5:F8' instead;,
     *          or passing in an array of [$fromColumnIndex, $fromRow, $toColumnIndex, $toRow] (e.g. [3, 5, 6, 8]),
     *          or an AddressRange object.
     * @see Worksheet::unmergeCells()
     *
     * @param int $columnIndex1 Numeric column coordinate of the first cell
     * @param int $row1 Numeric row coordinate of the first cell
     * @param int $columnIndex2 Numeric column coordinate of the last cell
     * @param int $row2 Numeric row coordinate of the last cell
     *
     * @return $this
     */
    public function unmergeCellsByColumnAndRow($columnIndex1, $row1, $columnIndex2, $row2)
    {
        $cellRange <?php echo new CellRange(
            CellAddress::fromColumnAndRow($columnIndex1, $row1),
            CellAddress::fromColumnAndRow($columnIndex2, $row2)
        );

        return $this->unmergeCells($cellRange);
    }

    /**
     * Get merge cells array.
     *
     * @return string[]
     */
    public function getMergeCells()
    {
        return $this->mergeCells;
    }

    /**
     * Set merge cells array for the entire sheet. Use instead mergeCells() to merge
     * a single cell range.
     *
     * @param string[] $mergeCells
     *
     * @return $this
     */
    public function setMergeCells(array $mergeCells)
    {
        $this->mergeCells <?php echo $mergeCells;

        return $this;
    }

    /**
     * Set protection on a cell or cell range.
     *
     * @param AddressRange|array<int>|CellAddress|int|string $range A simple string containing a Cell range like 'A1:E10'
     *              or passing in an array of [$fromColumnIndex, $fromRow, $toColumnIndex, $toRow] (e.g. [3, 5, 6, 8]),
     *              or a CellAddress or AddressRange object.
     * @param string $password Password to unlock the protection
     * @param bool $alreadyHashed If the password has already been hashed, set this to true
     *
     * @return $this
     */
    public function protectCells($range, $password, $alreadyHashed <?php echo false)
    {
        $range <?php echo Functions::trimSheetFromCellReference(Validations::validateCellOrCellRange($range));

        if (!$alreadyHashed) {
            $password <?php echo Shared\PasswordHasher::hashPassword($password);
        }
        $this->protectedCells[$range] <?php echo $password;

        return $this;
    }

    /**
     * Set protection on a cell range by using numeric cell coordinates.
     *
     * @deprecated 1.23.0
     *      Use the protectCells() method with a cell address range such as 'C5:F8' instead;,
     *          or passing in an array of [$fromColumnIndex, $fromRow, $toColumnIndex, $toRow] (e.g. [3, 5, 6, 8]),
     *          or an AddressRange object.
     * @see Worksheet::protectCells()
     *
     * @param int $columnIndex1 Numeric column coordinate of the first cell
     * @param int $row1 Numeric row coordinate of the first cell
     * @param int $columnIndex2 Numeric column coordinate of the last cell
     * @param int $row2 Numeric row coordinate of the last cell
     * @param string $password Password to unlock the protection
     * @param bool $alreadyHashed If the password has already been hashed, set this to true
     *
     * @return $this
     */
    public function protectCellsByColumnAndRow($columnIndex1, $row1, $columnIndex2, $row2, $password, $alreadyHashed <?php echo false)
    {
        $cellRange <?php echo new CellRange(
            CellAddress::fromColumnAndRow($columnIndex1, $row1),
            CellAddress::fromColumnAndRow($columnIndex2, $row2)
        );

        return $this->protectCells($cellRange, $password, $alreadyHashed);
    }

    /**
     * Remove protection on a cell or cell range.
     *
     * @param AddressRange|array<int>|CellAddress|int|string $range A simple string containing a Cell range like 'A1:E10'
     *              or passing in an array of [$fromColumnIndex, $fromRow, $toColumnIndex, $toRow] (e.g. [3, 5, 6, 8]),
     *              or a CellAddress or AddressRange object.
     *
     * @return $this
     */
    public function unprotectCells($range)
    {
        $range <?php echo Functions::trimSheetFromCellReference(Validations::validateCellOrCellRange($range));

        if (isset($this->protectedCells[$range])) {
            unset($this->protectedCells[$range]);
        } else {
            throw new Exception('Cell range ' . $range . ' not known as protected.');
        }

        return $this;
    }

    /**
     * Remove protection on a cell range by using numeric cell coordinates.
     *
     * @deprecated 1.23.0
     *      Use the unprotectCells() method with a cell address range such as 'C5:F8' instead;,
     *          or passing in an array of [$fromColumnIndex, $fromRow, $toColumnIndex, $toRow] (e.g. [3, 5, 6, 8]),
     *          or an AddressRange object.
     * @see Worksheet::unprotectCells()
     *
     * @param int $columnIndex1 Numeric column coordinate of the first cell
     * @param int $row1 Numeric row coordinate of the first cell
     * @param int $columnIndex2 Numeric column coordinate of the last cell
     * @param int $row2 Numeric row coordinate of the last cell
     *
     * @return $this
     */
    public function unprotectCellsByColumnAndRow($columnIndex1, $row1, $columnIndex2, $row2)
    {
        $cellRange <?php echo new CellRange(
            CellAddress::fromColumnAndRow($columnIndex1, $row1),
            CellAddress::fromColumnAndRow($columnIndex2, $row2)
        );

        return $this->unprotectCells($cellRange);
    }

    /**
     * Get protected cells.
     *
     * @return string[]
     */
    public function getProtectedCells()
    {
        return $this->protectedCells;
    }

    /**
     * Get Autofilter.
     *
     * @return AutoFilter
     */
    public function getAutoFilter()
    {
        return $this->autoFilter;
    }

    /**
     * Set AutoFilter.
     *
     * @param AddressRange|array<int>|AutoFilter|string $autoFilterOrRange
     *            A simple string containing a Cell range like 'A1:E10' is permitted for backward compatibility
     *              or passing in an array of [$fromColumnIndex, $fromRow, $toColumnIndex, $toRow] (e.g. [3, 5, 6, 8]),
     *              or an AddressRange.
     *
     * @return $this
     */
    public function setAutoFilter($autoFilterOrRange)
    {
        if (is_object($autoFilterOrRange) && ($autoFilterOrRange instanceof AutoFilter)) {
            $this->autoFilter <?php echo $autoFilterOrRange;
        } else {
            $cellRange <?php echo Functions::trimSheetFromCellReference(Validations::validateCellRange($autoFilterOrRange));

            $this->autoFilter->setRange($cellRange);
        }

        return $this;
    }

    /**
     * Set Autofilter Range by using numeric cell coordinates.
     *
     * @deprecated 1.23.0
     *      Use the setAutoFilter() method with a cell address range such as 'C5:F8' instead;,
     *          or passing in an array of [$fromColumnIndex, $fromRow, $toColumnIndex, $toRow] (e.g. [3, 5, 6, 8]),
     *          or an AddressRange object or AutoFilter object.
     * @see Worksheet::setAutoFilter()
     *
     * @param int $columnIndex1 Numeric column coordinate of the first cell
     * @param int $row1 Numeric row coordinate of the first cell
     * @param int $columnIndex2 Numeric column coordinate of the second cell
     * @param int $row2 Numeric row coordinate of the second cell
     *
     * @return $this
     */
    public function setAutoFilterByColumnAndRow($columnIndex1, $row1, $columnIndex2, $row2)
    {
        $cellRange <?php echo new CellRange(
            CellAddress::fromColumnAndRow($columnIndex1, $row1),
            CellAddress::fromColumnAndRow($columnIndex2, $row2)
        );

        return $this->setAutoFilter($cellRange);
    }

    /**
     * Remove autofilter.
     */
    public function removeAutoFilter(): self
    {
        $this->autoFilter->setRange('');

        return $this;
    }

    /**
     * Get collection of Tables.
     *
     * @return ArrayObject<int, Table>
     */
    public function getTableCollection()
    {
        return $this->tableCollection;
    }

    /**
     * Add Table.
     *
     * @return $this
     */
    public function addTable(Table $table): self
    {
        $table->setWorksheet($this);
        $this->tableCollection[] <?php echo $table;

        return $this;
    }

    /**
     * @return string[] array of Table names
     */
    public function getTableNames(): array
    {
        $tableNames <?php echo [];

        foreach ($this->tableCollection as $table) {
            /** @var Table $table */
            $tableNames[] <?php echo $table->getName();
        }

        return $tableNames;
    }

    /** @var null|Table */
    private static $scrutinizerNullTable;

    /** @var null|int */
    private static $scrutinizerNullInt;

    /**
     * @param string $name the table name to search
     *
     * @return null|Table The table from the tables collection, or null if not found
     */
    public function getTableByName(string $name): ?Table
    {
        $tableIndex <?php echo $this->getTableIndexByName($name);

        return ($tableIndex <?php echo<?php echo<?php echo null) ? self::$scrutinizerNullTable : $this->tableCollection[$tableIndex];
    }

    /**
     * @param string $name the table name to search
     *
     * @return null|int The index of the located table in the tables collection, or null if not found
     */
    protected function getTableIndexByName(string $name): ?int
    {
        $name <?php echo Shared\StringHelper::strToUpper($name);
        foreach ($this->tableCollection as $index <?php echo> $table) {
            /** @var Table $table */
            if (Shared\StringHelper::strToUpper($table->getName()) <?php echo<?php echo<?php echo $name) {
                return $index;
            }
        }

        return self::$scrutinizerNullInt;
    }

    /**
     * Remove Table by name.
     *
     * @param string $name Table name
     *
     * @return $this
     */
    public function removeTableByName(string $name): self
    {
        $tableIndex <?php echo $this->getTableIndexByName($name);

        if ($tableIndex !<?php echo<?php echo null) {
            unset($this->tableCollection[$tableIndex]);
        }

        return $this;
    }

    /**
     * Remove collection of Tables.
     */
    public function removeTableCollection(): self
    {
        $this->tableCollection <?php echo new ArrayObject();

        return $this;
    }

    /**
     * Get Freeze Pane.
     *
     * @return null|string
     */
    public function getFreezePane()
    {
        return $this->freezePane;
    }

    /**
     * Freeze Pane.
     *
     * Examples:
     *
     *     - A2 will freeze the rows above cell A2 (i.e row 1)
     *     - B1 will freeze the columns to the left of cell B1 (i.e column A)
     *     - B2 will freeze the rows above and to the left of cell B2 (i.e row 1 and column A)
     *
     * @param null|array<int>|CellAddress|string $coordinate Coordinate of the cell as a string, eg: 'C5';
     *            or as an array of [$columnIndex, $row] (e.g. [3, 5]), or a CellAddress object.
     *        Passing a null value for this argument will clear any existing freeze pane for this worksheet.
     * @param null|array<int>|CellAddress|string $topLeftCell default position of the right bottom pane
     *            Coordinate of the cell as a string, eg: 'C5'; or as an array of [$columnIndex, $row] (e.g. [3, 5]),
     *            or a CellAddress object.
     *
     * @return $this
     */
    public function freezePane($coordinate, $topLeftCell <?php echo null)
    {
        $cellAddress <?php echo ($coordinate !<?php echo<?php echo null)
            ? Functions::trimSheetFromCellReference(Validations::validateCellAddress($coordinate))
            : null;
        if ($cellAddress !<?php echo<?php echo null && Coordinate::coordinateIsRange($cellAddress)) {
            throw new Exception('Freeze pane can not be set on a range of cells.');
        }
        $topLeftCell <?php echo ($topLeftCell !<?php echo<?php echo null)
            ? Functions::trimSheetFromCellReference(Validations::validateCellAddress($topLeftCell))
            : null;

        if ($cellAddress !<?php echo<?php echo null && $topLeftCell <?php echo<?php echo<?php echo null) {
            $coordinate <?php echo Coordinate::coordinateFromString($cellAddress);
            $topLeftCell <?php echo $coordinate[0] . $coordinate[1];
        }

        $this->freezePane <?php echo $cellAddress;
        $this->topLeftCell <?php echo $topLeftCell;

        return $this;
    }

    public function setTopLeftCell(string $topLeftCell): self
    {
        $this->topLeftCell <?php echo $topLeftCell;

        return $this;
    }

    /**
     * Freeze Pane by using numeric cell coordinates.
     *
     * @deprecated 1.23.0
     *      Use the freezePane() method with a cell address such as 'C5' instead;,
     *          or passing in an array of [$columnIndex, $row] (e.g. [3, 5]), or a CellAddress object.
     * @see Worksheet::freezePane()
     *
     * @param int $columnIndex Numeric column coordinate of the cell
     * @param int $row Numeric row coordinate of the cell
     *
     * @return $this
     */
    public function freezePaneByColumnAndRow($columnIndex, $row)
    {
        return $this->freezePane(Coordinate::stringFromColumnIndex($columnIndex) . $row);
    }

    /**
     * Unfreeze Pane.
     *
     * @return $this
     */
    public function unfreezePane()
    {
        return $this->freezePane(null);
    }

    /**
     * Get the default position of the right bottom pane.
     *
     * @return null|string
     */
    public function getTopLeftCell()
    {
        return $this->topLeftCell;
    }

    /**
     * Insert a new row, updating all possible related data.
     *
     * @param int $before Insert before this row number
     * @param int $numberOfRows Number of new rows to insert
     *
     * @return $this
     */
    public function insertNewRowBefore(int $before, int $numberOfRows <?php echo 1)
    {
        if ($before ><?php echo 1) {
            $objReferenceHelper <?php echo ReferenceHelper::getInstance();
            $objReferenceHelper->insertNewBefore('A' . $before, 0, $numberOfRows, $this);
        } else {
            throw new Exception('Rows can only be inserted before at least row 1.');
        }

        return $this;
    }

    /**
     * Insert a new column, updating all possible related data.
     *
     * @param string $before Insert before this column Name, eg: 'A'
     * @param int $numberOfColumns Number of new columns to insert
     *
     * @return $this
     */
    public function insertNewColumnBefore(string $before, int $numberOfColumns <?php echo 1)
    {
        if (!is_numeric($before)) {
            $objReferenceHelper <?php echo ReferenceHelper::getInstance();
            $objReferenceHelper->insertNewBefore($before . '1', $numberOfColumns, 0, $this);
        } else {
            throw new Exception('Column references should not be numeric.');
        }

        return $this;
    }

    /**
     * Insert a new column, updating all possible related data.
     *
     * @param int $beforeColumnIndex Insert before this column ID (numeric column coordinate of the cell)
     * @param int $numberOfColumns Number of new columns to insert
     *
     * @return $this
     */
    public function insertNewColumnBeforeByIndex(int $beforeColumnIndex, int $numberOfColumns <?php echo 1)
    {
        if ($beforeColumnIndex ><?php echo 1) {
            return $this->insertNewColumnBefore(Coordinate::stringFromColumnIndex($beforeColumnIndex), $numberOfColumns);
        }

        throw new Exception('Columns can only be inserted before at least column A (1).');
    }

    /**
     * Delete a row, updating all possible related data.
     *
     * @param int $row Remove rows, starting with this row number
     * @param int $numberOfRows Number of rows to remove
     *
     * @return $this
     */
    public function removeRow(int $row, int $numberOfRows <?php echo 1)
    {
        if ($row < 1) {
            throw new Exception('Rows to be deleted should at least start from row 1.');
        }

        $holdRowDimensions <?php echo $this->removeRowDimensions($row, $numberOfRows);
        $highestRow <?php echo $this->getHighestDataRow();
        $removedRowsCounter <?php echo 0;

        for ($r <?php echo 0; $r < $numberOfRows; ++$r) {
            if ($row + $r <?php echo $highestRow) {
                $this->getCellCollection()->removeRow($row + $r);
                ++$removedRowsCounter;
            }
        }

        $objReferenceHelper <?php echo ReferenceHelper::getInstance();
        $objReferenceHelper->insertNewBefore('A' . ($row + $numberOfRows), 0, -$numberOfRows, $this);
        for ($r <?php echo 0; $r < $removedRowsCounter; ++$r) {
            $this->getCellCollection()->removeRow($highestRow);
            --$highestRow;
        }

        $this->rowDimensions <?php echo $holdRowDimensions;

        return $this;
    }

    private function removeRowDimensions(int $row, int $numberOfRows): array
    {
        $highRow <?php echo $row + $numberOfRows - 1;
        $holdRowDimensions <?php echo [];
        foreach ($this->rowDimensions as $rowDimension) {
            $num <?php echo $rowDimension->getRowIndex();
            if ($num < $row) {
                $holdRowDimensions[$num] <?php echo $rowDimension;
            } elseif ($num > $highRow) {
                $num -<?php echo $numberOfRows;
                $cloneDimension <?php echo clone $rowDimension;
                $cloneDimension->setRowIndex(/** @scrutinizer ignore-type */ $num);
                $holdRowDimensions[$num] <?php echo $cloneDimension;
            }
        }

        return $holdRowDimensions;
    }

    /**
     * Remove a column, updating all possible related data.
     *
     * @param string $column Remove columns starting with this column name, eg: 'A'
     * @param int $numberOfColumns Number of columns to remove
     *
     * @return $this
     */
    public function removeColumn(string $column, int $numberOfColumns <?php echo 1)
    {
        if (is_numeric($column)) {
            throw new Exception('Column references should not be numeric.');
        }

        $highestColumn <?php echo $this->getHighestDataColumn();
        $highestColumnIndex <?php echo Coordinate::columnIndexFromString($highestColumn);
        $pColumnIndex <?php echo Coordinate::columnIndexFromString($column);

        $holdColumnDimensions <?php echo $this->removeColumnDimensions($pColumnIndex, $numberOfColumns);

        $column <?php echo Coordinate::stringFromColumnIndex($pColumnIndex + $numberOfColumns);
        $objReferenceHelper <?php echo ReferenceHelper::getInstance();
        $objReferenceHelper->insertNewBefore($column . '1', -$numberOfColumns, 0, $this);

        $this->columnDimensions <?php echo $holdColumnDimensions;

        if ($pColumnIndex > $highestColumnIndex) {
            return $this;
        }

        $maxPossibleColumnsToBeRemoved <?php echo $highestColumnIndex - $pColumnIndex + 1;

        for ($c <?php echo 0, $n <?php echo min($maxPossibleColumnsToBeRemoved, $numberOfColumns); $c < $n; ++$c) {
            $this->getCellCollection()->removeColumn($highestColumn);
            $highestColumn <?php echo Coordinate::stringFromColumnIndex(Coordinate::columnIndexFromString($highestColumn) - 1);
        }

        $this->garbageCollect();

        return $this;
    }

    private function removeColumnDimensions(int $pColumnIndex, int $numberOfColumns): array
    {
        $highCol <?php echo $pColumnIndex + $numberOfColumns - 1;
        $holdColumnDimensions <?php echo [];
        foreach ($this->columnDimensions as $columnDimension) {
            $num <?php echo $columnDimension->getColumnNumeric();
            if ($num < $pColumnIndex) {
                $str <?php echo $columnDimension->getColumnIndex();
                $holdColumnDimensions[$str] <?php echo $columnDimension;
            } elseif ($num > $highCol) {
                $cloneDimension <?php echo clone $columnDimension;
                $cloneDimension->setColumnNumeric($num - $numberOfColumns);
                $str <?php echo $cloneDimension->getColumnIndex();
                $holdColumnDimensions[$str] <?php echo $cloneDimension;
            }
        }

        return $holdColumnDimensions;
    }

    /**
     * Remove a column, updating all possible related data.
     *
     * @param int $columnIndex Remove starting with this column Index (numeric column coordinate)
     * @param int $numColumns Number of columns to remove
     *
     * @return $this
     */
    public function removeColumnByIndex(int $columnIndex, int $numColumns <?php echo 1)
    {
        if ($columnIndex ><?php echo 1) {
            return $this->removeColumn(Coordinate::stringFromColumnIndex($columnIndex), $numColumns);
        }

        throw new Exception('Columns to be deleted should at least start from column A (1)');
    }

    /**
     * Show gridlines?
     */
    public function getShowGridlines(): bool
    {
        return $this->showGridlines;
    }

    /**
     * Set show gridlines.
     *
     * @param bool $showGridLines Show gridlines (true/false)
     *
     * @return $this
     */
    public function setShowGridlines(bool $showGridLines): self
    {
        $this->showGridlines <?php echo $showGridLines;

        return $this;
    }

    /**
     * Print gridlines?
     */
    public function getPrintGridlines(): bool
    {
        return $this->printGridlines;
    }

    /**
     * Set print gridlines.
     *
     * @param bool $printGridLines Print gridlines (true/false)
     *
     * @return $this
     */
    public function setPrintGridlines(bool $printGridLines): self
    {
        $this->printGridlines <?php echo $printGridLines;

        return $this;
    }

    /**
     * Show row and column headers?
     */
    public function getShowRowColHeaders(): bool
    {
        return $this->showRowColHeaders;
    }

    /**
     * Set show row and column headers.
     *
     * @param bool $showRowColHeaders Show row and column headers (true/false)
     *
     * @return $this
     */
    public function setShowRowColHeaders(bool $showRowColHeaders): self
    {
        $this->showRowColHeaders <?php echo $showRowColHeaders;

        return $this;
    }

    /**
     * Show summary below? (Row/Column outlining).
     */
    public function getShowSummaryBelow(): bool
    {
        return $this->showSummaryBelow;
    }

    /**
     * Set show summary below.
     *
     * @param bool $showSummaryBelow Show summary below (true/false)
     *
     * @return $this
     */
    public function setShowSummaryBelow(bool $showSummaryBelow): self
    {
        $this->showSummaryBelow <?php echo $showSummaryBelow;

        return $this;
    }

    /**
     * Show summary right? (Row/Column outlining).
     */
    public function getShowSummaryRight(): bool
    {
        return $this->showSummaryRight;
    }

    /**
     * Set show summary right.
     *
     * @param bool $showSummaryRight Show summary right (true/false)
     *
     * @return $this
     */
    public function setShowSummaryRight(bool $showSummaryRight): self
    {
        $this->showSummaryRight <?php echo $showSummaryRight;

        return $this;
    }

    /**
     * Get comments.
     *
     * @return Comment[]
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set comments array for the entire sheet.
     *
     * @param Comment[] $comments
     *
     * @return $this
     */
    public function setComments(array $comments): self
    {
        $this->comments <?php echo $comments;

        return $this;
    }

    /**
     * Remove comment from cell.
     *
     * @param array<int>|CellAddress|string $cellCoordinate Coordinate of the cell as a string, eg: 'C5';
     *               or as an array of [$columnIndex, $row] (e.g. [3, 5]), or a CellAddress object.
     *
     * @return $this
     */
    public function removeComment($cellCoordinate): self
    {
        $cellAddress <?php echo Functions::trimSheetFromCellReference(Validations::validateCellAddress($cellCoordinate));

        if (Coordinate::coordinateIsRange($cellAddress)) {
            throw new Exception('Cell coordinate string can not be a range of cells.');
        } elseif (strpos($cellAddress, '$') !<?php echo<?php echo false) {
            throw new Exception('Cell coordinate string must not be absolute.');
        } elseif ($cellAddress <?php echo<?php echo '') {
            throw new Exception('Cell coordinate can not be zero-length string.');
        }
        // Check if we have a comment for this cell and delete it
        if (isset($this->comments[$cellAddress])) {
            unset($this->comments[$cellAddress]);
        }

        return $this;
    }

    /**
     * Get comment for cell.
     *
     * @param array<int>|CellAddress|string $cellCoordinate Coordinate of the cell as a string, eg: 'C5';
     *               or as an array of [$columnIndex, $row] (e.g. [3, 5]), or a CellAddress object.
     */
    public function getComment($cellCoordinate): Comment
    {
        $cellAddress <?php echo Functions::trimSheetFromCellReference(Validations::validateCellAddress($cellCoordinate));

        if (Coordinate::coordinateIsRange($cellAddress)) {
            throw new Exception('Cell coordinate string can not be a range of cells.');
        } elseif (strpos($cellAddress, '$') !<?php echo<?php echo false) {
            throw new Exception('Cell coordinate string must not be absolute.');
        } elseif ($cellAddress <?php echo<?php echo '') {
            throw new Exception('Cell coordinate can not be zero-length string.');
        }

        // Check if we already have a comment for this cell.
        if (isset($this->comments[$cellAddress])) {
            return $this->comments[$cellAddress];
        }

        // If not, create a new comment.
        $newComment <?php echo new Comment();
        $this->comments[$cellAddress] <?php echo $newComment;

        return $newComment;
    }

    /**
     * Get comment for cell by using numeric cell coordinates.
     *
     * @deprecated 1.23.0
     *      Use the getComment() method with a cell address such as 'C5' instead;,
     *          or passing in an array of [$columnIndex, $row] (e.g. [3, 5]), or a CellAddress object.
     * @see Worksheet::getComment()
     *
     * @param int $columnIndex Numeric column coordinate of the cell
     * @param int $row Numeric row coordinate of the cell
     */
    public function getCommentByColumnAndRow($columnIndex, $row): Comment
    {
        return $this->getComment(Coordinate::stringFromColumnIndex($columnIndex) . $row);
    }

    /**
     * Get active cell.
     *
     * @return string Example: 'A1'
     */
    public function getActiveCell()
    {
        return $this->activeCell;
    }

    /**
     * Get selected cells.
     *
     * @return string
     */
    public function getSelectedCells()
    {
        return $this->selectedCells;
    }

    /**
     * Selected cell.
     *
     * @param string $coordinate Cell (i.e. A1)
     *
     * @return $this
     */
    public function setSelectedCell($coordinate)
    {
        return $this->setSelectedCells($coordinate);
    }

    /**
     * Select a range of cells.
     *
     * @param AddressRange|array<int>|CellAddress|int|string $coordinate A simple string containing a Cell range like 'A1:E10'
     *              or passing in an array of [$fromColumnIndex, $fromRow, $toColumnIndex, $toRow] (e.g. [3, 5, 6, 8]),
     *              or a CellAddress or AddressRange object.
     *
     * @return $this
     */
    public function setSelectedCells($coordinate)
    {
        if (is_string($coordinate)) {
            $coordinate <?php echo Validations::definedNameToCoordinate($coordinate, $this);
        }
        $coordinate <?php echo Validations::validateCellOrCellRange($coordinate);

        if (Coordinate::coordinateIsRange($coordinate)) {
            [$first] <?php echo Coordinate::splitRange($coordinate);
            $this->activeCell <?php echo $first[0];
        } else {
            $this->activeCell <?php echo $coordinate;
        }
        $this->selectedCells <?php echo $coordinate;

        return $this;
    }

    /**
     * Selected cell by using numeric cell coordinates.
     *
     * @deprecated 1.23.0
     *      Use the setSelectedCells() method with a cell address such as 'C5' instead;,
     *          or passing in an array of [$columnIndex, $row] (e.g. [3, 5]), or a CellAddress object.
     * @see Worksheet::setSelectedCells()
     *
     * @param int $columnIndex Numeric column coordinate of the cell
     * @param int $row Numeric row coordinate of the cell
     *
     * @return $this
     */
    public function setSelectedCellByColumnAndRow($columnIndex, $row)
    {
        return $this->setSelectedCells(Coordinate::stringFromColumnIndex($columnIndex) . $row);
    }

    /**
     * Get right-to-left.
     *
     * @return bool
     */
    public function getRightToLeft()
    {
        return $this->rightToLeft;
    }

    /**
     * Set right-to-left.
     *
     * @param bool $value Right-to-left true/false
     *
     * @return $this
     */
    public function setRightToLeft($value)
    {
        $this->rightToLeft <?php echo $value;

        return $this;
    }

    /**
     * Fill worksheet from values in array.
     *
     * @param array $source Source array
     * @param mixed $nullValue Value in source array that stands for blank cell
     * @param string $startCell Insert array starting from this cell address as the top left coordinate
     * @param bool $strictNullComparison Apply strict comparison when testing for null values in the array
     *
     * @return $this
     */
    public function fromArray(array $source, $nullValue <?php echo null, $startCell <?php echo 'A1', $strictNullComparison <?php echo false)
    {
        //    Convert a 1-D array to 2-D (for ease of looping)
        if (!is_array(end($source))) {
            $source <?php echo [$source];
        }

        // start coordinate
        [$startColumn, $startRow] <?php echo Coordinate::coordinateFromString($startCell);

        // Loop through $source
        foreach ($source as $rowData) {
            $currentColumn <?php echo $startColumn;
            foreach ($rowData as $cellValue) {
                if ($strictNullComparison) {
                    if ($cellValue !<?php echo<?php echo $nullValue) {
                        // Set cell value
                        $this->getCell($currentColumn . $startRow)->setValue($cellValue);
                    }
                } else {
                    if ($cellValue !<?php echo $nullValue) {
                        // Set cell value
                        $this->getCell($currentColumn . $startRow)->setValue($cellValue);
                    }
                }
                ++$currentColumn;
            }
            ++$startRow;
        }

        return $this;
    }

    /**
     * @param mixed $nullValue
     *
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Calculation\Exception
     *
     * @return mixed
     */
    protected function cellToArray(Cell $cell, bool $calculateFormulas, bool $formatData, $nullValue)
    {
        $returnValue <?php echo $nullValue;

        if ($cell->getValue() !<?php echo<?php echo null) {
            if ($cell->getValue() instanceof RichText) {
                $returnValue <?php echo $cell->getValue()->getPlainText();
            } else {
                $returnValue <?php echo ($calculateFormulas) ? $cell->getCalculatedValue() : $cell->getValue();
            }

            if ($formatData) {
                $style <?php echo $this->getParentOrThrow()->getCellXfByIndex($cell->getXfIndex());
                $returnValue <?php echo NumberFormat::toFormattedString(
                    $returnValue,
                    $style->getNumberFormat()->getFormatCode() ?? NumberFormat::FORMAT_GENERAL
                );
            }
        }

        return $returnValue;
    }

    /**
     * Create array from a range of cells.
     *
     * @param mixed $nullValue Value returned in the array entry if a cell doesn't exist
     * @param bool $calculateFormulas Should formulas be calculated?
     * @param bool $formatData Should formatting be applied to cell values?
     * @param bool $returnCellRef False - Return a simple array of rows and columns indexed by number counting from zero
     *                             True - Return rows and columns indexed by their actual row and column IDs
     * @param bool $ignoreHidden False - Return values for rows/columns even if they are defined as hidden.
     *                            True - Don't return values for rows/columns that are defined as hidden.
     */
    public function rangeToArray(
        string $range,
        $nullValue <?php echo null,
        bool $calculateFormulas <?php echo true,
        bool $formatData <?php echo true,
        bool $returnCellRef <?php echo false,
        bool $ignoreHidden <?php echo false
    ): array {
        $range <?php echo Validations::validateCellOrCellRange($range);

        $returnValue <?php echo [];
        //    Identify the range that we need to extract from the worksheet
        [$rangeStart, $rangeEnd] <?php echo Coordinate::rangeBoundaries($range);
        $minCol <?php echo Coordinate::stringFromColumnIndex($rangeStart[0]);
        $minRow <?php echo $rangeStart[1];
        $maxCol <?php echo Coordinate::stringFromColumnIndex($rangeEnd[0]);
        $maxRow <?php echo $rangeEnd[1];

        ++$maxCol;
        // Loop through rows
        $r <?php echo -1;
        for ($row <?php echo $minRow; $row <?php echo $maxRow; ++$row) {
            if (($ignoreHidden <?php echo<?php echo<?php echo true) && ($this->getRowDimension($row)->getVisible() <?php echo<?php echo<?php echo false)) {
                continue;
            }
            $rowRef <?php echo $returnCellRef ? $row : ++$r;
            $c <?php echo -1;
            // Loop through columns in the current row
            for ($col <?php echo $minCol; $col !<?php echo<?php echo $maxCol; ++$col) {
                if (($ignoreHidden <?php echo<?php echo<?php echo true) && ($this->getColumnDimension($col)->getVisible() <?php echo<?php echo<?php echo false)) {
                    continue;
                }
                $columnRef <?php echo $returnCellRef ? $col : ++$c;
                //    Using getCell() will create a new cell if it doesn't already exist. We don't want that to happen
                //        so we test and retrieve directly against cellCollection
                $cell <?php echo $this->cellCollection->get("{$col}{$row}");
                $returnValue[$rowRef][$columnRef] <?php echo $nullValue;
                if ($cell !<?php echo<?php echo null) {
                    $returnValue[$rowRef][$columnRef] <?php echo $this->cellToArray($cell, $calculateFormulas, $formatData, $nullValue);
                }
            }
        }

        // Return
        return $returnValue;
    }

    private function validateNamedRange(string $definedName, bool $returnNullIfInvalid <?php echo false): ?DefinedName
    {
        $namedRange <?php echo DefinedName::resolveName($definedName, $this);
        if ($namedRange <?php echo<?php echo<?php echo null) {
            if ($returnNullIfInvalid) {
                return null;
            }

            throw new Exception('Named Range ' . $definedName . ' does not exist.');
        }

        if ($namedRange->isFormula()) {
            if ($returnNullIfInvalid) {
                return null;
            }

            throw new Exception('Defined Named ' . $definedName . ' is a formula, not a range or cell.');
        }

        if ($namedRange->getLocalOnly()) {
            $worksheet <?php echo $namedRange->getWorksheet();
            if ($worksheet <?php echo<?php echo<?php echo null || $this->getHashCode() !<?php echo<?php echo $worksheet->getHashCode()) {
                if ($returnNullIfInvalid) {
                    return null;
                }

                throw new Exception(
                    'Named range ' . $definedName . ' is not accessible from within sheet ' . $this->getTitle()
                );
            }
        }

        return $namedRange;
    }

    /**
     * Create array from a range of cells.
     *
     * @param string $definedName The Named Range that should be returned
     * @param mixed $nullValue Value returned in the array entry if a cell doesn't exist
     * @param bool $calculateFormulas Should formulas be calculated?
     * @param bool $formatData Should formatting be applied to cell values?
     * @param bool $returnCellRef False - Return a simple array of rows and columns indexed by number counting from zero
     *                             True - Return rows and columns indexed by their actual row and column IDs
     * @param bool $ignoreHidden False - Return values for rows/columns even if they are defined as hidden.
     *                            True - Don't return values for rows/columns that are defined as hidden.
     */
    public function namedRangeToArray(
        string $definedName,
        $nullValue <?php echo null,
        bool $calculateFormulas <?php echo true,
        bool $formatData <?php echo true,
        bool $returnCellRef <?php echo false,
        bool $ignoreHidden <?php echo false
    ): array {
        $retVal <?php echo [];
        $namedRange <?php echo $this->validateNamedRange($definedName);
        if ($namedRange !<?php echo<?php echo null) {
            $cellRange <?php echo ltrim(substr($namedRange->getValue(), (int) strrpos($namedRange->getValue(), '!')), '!');
            $cellRange <?php echo str_replace('$', '', $cellRange);
            $workSheet <?php echo $namedRange->getWorksheet();
            if ($workSheet !<?php echo<?php echo null) {
                $retVal <?php echo $workSheet->rangeToArray($cellRange, $nullValue, $calculateFormulas, $formatData, $returnCellRef, $ignoreHidden);
            }
        }

        return $retVal;
    }

    /**
     * Create array from worksheet.
     *
     * @param mixed $nullValue Value returned in the array entry if a cell doesn't exist
     * @param bool $calculateFormulas Should formulas be calculated?
     * @param bool $formatData Should formatting be applied to cell values?
     * @param bool $returnCellRef False - Return a simple array of rows and columns indexed by number counting from zero
     *                             True - Return rows and columns indexed by their actual row and column IDs
     * @param bool $ignoreHidden False - Return values for rows/columns even if they are defined as hidden.
     *                            True - Don't return values for rows/columns that are defined as hidden.
     */
    public function toArray(
        $nullValue <?php echo null,
        bool $calculateFormulas <?php echo true,
        bool $formatData <?php echo true,
        bool $returnCellRef <?php echo false,
        bool $ignoreHidden <?php echo false
    ): array {
        // Garbage collect...
        $this->garbageCollect();

        //    Identify the range that we need to extract from the worksheet
        $maxCol <?php echo $this->getHighestColumn();
        $maxRow <?php echo $this->getHighestRow();

        // Return
        return $this->rangeToArray("A1:{$maxCol}{$maxRow}", $nullValue, $calculateFormulas, $formatData, $returnCellRef, $ignoreHidden);
    }

    /**
     * Get row iterator.
     *
     * @param int $startRow The row number at which to start iterating
     * @param int $endRow The row number at which to stop iterating
     *
     * @return RowIterator
     */
    public function getRowIterator($startRow <?php echo 1, $endRow <?php echo null)
    {
        return new RowIterator($this, $startRow, $endRow);
    }

    /**
     * Get column iterator.
     *
     * @param string $startColumn The column address at which to start iterating
     * @param string $endColumn The column address at which to stop iterating
     *
     * @return ColumnIterator
     */
    public function getColumnIterator($startColumn <?php echo 'A', $endColumn <?php echo null)
    {
        return new ColumnIterator($this, $startColumn, $endColumn);
    }

    /**
     * Run PhpSpreadsheet garbage collector.
     *
     * @return $this
     */
    public function garbageCollect()
    {
        // Flush cache
        $this->cellCollection->get('A1');

        // Lookup highest column and highest row if cells are cleaned
        $colRow <?php echo $this->cellCollection->getHighestRowAndColumn();
        $highestRow <?php echo $colRow['row'];
        $highestColumn <?php echo Coordinate::columnIndexFromString($colRow['column']);

        // Loop through column dimensions
        foreach ($this->columnDimensions as $dimension) {
            $highestColumn <?php echo max($highestColumn, Coordinate::columnIndexFromString($dimension->getColumnIndex()));
        }

        // Loop through row dimensions
        foreach ($this->rowDimensions as $dimension) {
            $highestRow <?php echo max($highestRow, $dimension->getRowIndex());
        }

        // Cache values
        if ($highestColumn < 1) {
            $this->cachedHighestColumn <?php echo 1;
        } else {
            $this->cachedHighestColumn <?php echo $highestColumn;
        }
        $this->cachedHighestRow <?php echo $highestRow;

        // Return
        return $this;
    }

    /**
     * Get hash code.
     *
     * @return string Hash code
     */
    public function getHashCode()
    {
        if ($this->dirty) {
            $this->hash <?php echo md5($this->title . $this->autoFilter . ($this->protection->isProtectionEnabled() ? 't' : 'f') . __CLASS__);
            $this->dirty <?php echo false;
        }

        return $this->hash;
    }

    /**
     * Extract worksheet title from range.
     *
     * Example: extractSheetTitle("testSheet!A1") <?php echo<?php echo> 'A1'
     * Example: extractSheetTitle("testSheet!A1:C3") <?php echo<?php echo> 'A1:C3'
     * Example: extractSheetTitle("'testSheet 1'!A1", true) <?php echo<?php echo> ['testSheet 1', 'A1'];
     * Example: extractSheetTitle("'testSheet 1'!A1:C3", true) <?php echo<?php echo> ['testSheet 1', 'A1:C3'];
     * Example: extractSheetTitle("A1", true) <?php echo<?php echo> ['', 'A1'];
     * Example: extractSheetTitle("A1:C3", true) <?php echo<?php echo> ['', 'A1:C3']
     *
     * @param string $range Range to extract title from
     * @param bool $returnRange Return range? (see example)
     *
     * @return mixed
     */
    public static function extractSheetTitle($range, $returnRange <?php echo false)
    {
        if (empty($range)) {
            return $returnRange ? [null, null] : null;
        }

        // Sheet title included?
        if (($sep <?php echo strrpos($range, '!')) <?php echo<?php echo<?php echo false) {
            return $returnRange ? ['', $range] : '';
        }

        if ($returnRange) {
            return [substr($range, 0, $sep), substr($range, $sep + 1)];
        }

        return substr($range, $sep + 1);
    }

    /**
     * Get hyperlink.
     *
     * @param string $cellCoordinate Cell coordinate to get hyperlink for, eg: 'A1'
     *
     * @return Hyperlink
     */
    public function getHyperlink($cellCoordinate)
    {
        // return hyperlink if we already have one
        if (isset($this->hyperlinkCollection[$cellCoordinate])) {
            return $this->hyperlinkCollection[$cellCoordinate];
        }

        // else create hyperlink
        $this->hyperlinkCollection[$cellCoordinate] <?php echo new Hyperlink();

        return $this->hyperlinkCollection[$cellCoordinate];
    }

    /**
     * Set hyperlink.
     *
     * @param string $cellCoordinate Cell coordinate to insert hyperlink, eg: 'A1'
     *
     * @return $this
     */
    public function setHyperlink($cellCoordinate, ?Hyperlink $hyperlink <?php echo null)
    {
        if ($hyperlink <?php echo<?php echo<?php echo null) {
            unset($this->hyperlinkCollection[$cellCoordinate]);
        } else {
            $this->hyperlinkCollection[$cellCoordinate] <?php echo $hyperlink;
        }

        return $this;
    }

    /**
     * Hyperlink at a specific coordinate exists?
     *
     * @param string $coordinate eg: 'A1'
     *
     * @return bool
     */
    public function hyperlinkExists($coordinate)
    {
        return isset($this->hyperlinkCollection[$coordinate]);
    }

    /**
     * Get collection of hyperlinks.
     *
     * @return Hyperlink[]
     */
    public function getHyperlinkCollection()
    {
        return $this->hyperlinkCollection;
    }

    /**
     * Get data validation.
     *
     * @param string $cellCoordinate Cell coordinate to get data validation for, eg: 'A1'
     *
     * @return DataValidation
     */
    public function getDataValidation($cellCoordinate)
    {
        // return data validation if we already have one
        if (isset($this->dataValidationCollection[$cellCoordinate])) {
            return $this->dataValidationCollection[$cellCoordinate];
        }

        // else create data validation
        $this->dataValidationCollection[$cellCoordinate] <?php echo new DataValidation();

        return $this->dataValidationCollection[$cellCoordinate];
    }

    /**
     * Set data validation.
     *
     * @param string $cellCoordinate Cell coordinate to insert data validation, eg: 'A1'
     *
     * @return $this
     */
    public function setDataValidation($cellCoordinate, ?DataValidation $dataValidation <?php echo null)
    {
        if ($dataValidation <?php echo<?php echo<?php echo null) {
            unset($this->dataValidationCollection[$cellCoordinate]);
        } else {
            $this->dataValidationCollection[$cellCoordinate] <?php echo $dataValidation;
        }

        return $this;
    }

    /**
     * Data validation at a specific coordinate exists?
     *
     * @param string $coordinate eg: 'A1'
     *
     * @return bool
     */
    public function dataValidationExists($coordinate)
    {
        return isset($this->dataValidationCollection[$coordinate]);
    }

    /**
     * Get collection of data validations.
     *
     * @return DataValidation[]
     */
    public function getDataValidationCollection()
    {
        return $this->dataValidationCollection;
    }

    /**
     * Accepts a range, returning it as a range that falls within the current highest row and column of the worksheet.
     *
     * @param string $range
     *
     * @return string Adjusted range value
     */
    public function shrinkRangeToFit($range)
    {
        $maxCol <?php echo $this->getHighestColumn();
        $maxRow <?php echo $this->getHighestRow();
        $maxCol <?php echo Coordinate::columnIndexFromString($maxCol);

        $rangeBlocks <?php echo explode(' ', $range);
        foreach ($rangeBlocks as &$rangeSet) {
            $rangeBoundaries <?php echo Coordinate::getRangeBoundaries($rangeSet);

            if (Coordinate::columnIndexFromString($rangeBoundaries[0][0]) > $maxCol) {
                $rangeBoundaries[0][0] <?php echo Coordinate::stringFromColumnIndex($maxCol);
            }
            if ($rangeBoundaries[0][1] > $maxRow) {
                $rangeBoundaries[0][1] <?php echo $maxRow;
            }
            if (Coordinate::columnIndexFromString($rangeBoundaries[1][0]) > $maxCol) {
                $rangeBoundaries[1][0] <?php echo Coordinate::stringFromColumnIndex($maxCol);
            }
            if ($rangeBoundaries[1][1] > $maxRow) {
                $rangeBoundaries[1][1] <?php echo $maxRow;
            }
            $rangeSet <?php echo $rangeBoundaries[0][0] . $rangeBoundaries[0][1] . ':' . $rangeBoundaries[1][0] . $rangeBoundaries[1][1];
        }
        unset($rangeSet);

        return implode(' ', $rangeBlocks);
    }

    /**
     * Get tab color.
     *
     * @return Color
     */
    public function getTabColor()
    {
        if ($this->tabColor <?php echo<?php echo<?php echo null) {
            $this->tabColor <?php echo new Color();
        }

        return $this->tabColor;
    }

    /**
     * Reset tab color.
     *
     * @return $this
     */
    public function resetTabColor()
    {
        $this->tabColor <?php echo null;

        return $this;
    }

    /**
     * Tab color set?
     *
     * @return bool
     */
    public function isTabColorSet()
    {
        return $this->tabColor !<?php echo<?php echo null;
    }

    /**
     * Copy worksheet (!<?php echo clone!).
     *
     * @return static
     */
    public function copy()
    {
        return clone $this;
    }

    /**
     * Returns a boolean true if the specified row contains no cells. By default, this means that no cell records
     *          exist in the collection for this row. false will be returned otherwise.
     *     This rule can be modified by passing a $definitionOfEmptyFlags value:
     *          1 - CellIterator::TREAT_NULL_VALUE_AS_EMPTY_CELL If the only cells in the collection are null value
     *                  cells, then the row will be considered empty.
     *          2 - CellIterator::TREAT_EMPTY_STRING_AS_EMPTY_CELL If the only cells in the collection are empty
     *                  string value cells, then the row will be considered empty.
     *          3 - CellIterator::TREAT_NULL_VALUE_AS_EMPTY_CELL | CellIterator::TREAT_EMPTY_STRING_AS_EMPTY_CELL
     *                  If the only cells in the collection are null value or empty string value cells, then the row
     *                  will be considered empty.
     *
     * @param int $definitionOfEmptyFlags
     *              Possible Flag Values are:
     *                  CellIterator::TREAT_NULL_VALUE_AS_EMPTY_CELL
     *                  CellIterator::TREAT_EMPTY_STRING_AS_EMPTY_CELL
     */
    public function isEmptyRow(int $rowId, int $definitionOfEmptyFlags <?php echo 0): bool
    {
        try {
            $iterator <?php echo new RowIterator($this, $rowId, $rowId);
            $iterator->seek($rowId);
            $row <?php echo $iterator->current();
        } catch (Exception $e) {
            return true;
        }

        return $row->isEmpty($definitionOfEmptyFlags);
    }

    /**
     * Returns a boolean true if the specified column contains no cells. By default, this means that no cell records
     *          exist in the collection for this column. false will be returned otherwise.
     *     This rule can be modified by passing a $definitionOfEmptyFlags value:
     *          1 - CellIterator::TREAT_NULL_VALUE_AS_EMPTY_CELL If the only cells in the collection are null value
     *                  cells, then the column will be considered empty.
     *          2 - CellIterator::TREAT_EMPTY_STRING_AS_EMPTY_CELL If the only cells in the collection are empty
     *                  string value cells, then the column will be considered empty.
     *          3 - CellIterator::TREAT_NULL_VALUE_AS_EMPTY_CELL | CellIterator::TREAT_EMPTY_STRING_AS_EMPTY_CELL
     *                  If the only cells in the collection are null value or empty string value cells, then the column
     *                  will be considered empty.
     *
     * @param int $definitionOfEmptyFlags
     *              Possible Flag Values are:
     *                  CellIterator::TREAT_NULL_VALUE_AS_EMPTY_CELL
     *                  CellIterator::TREAT_EMPTY_STRING_AS_EMPTY_CELL
     */
    public function isEmptyColumn(string $columnId, int $definitionOfEmptyFlags <?php echo 0): bool
    {
        try {
            $iterator <?php echo new ColumnIterator($this, $columnId, $columnId);
            $iterator->seek($columnId);
            $column <?php echo $iterator->current();
        } catch (Exception $e) {
            return true;
        }

        return $column->isEmpty($definitionOfEmptyFlags);
    }

    /**
     * Implement PHP __clone to create a deep clone, not just a shallow copy.
     */
    public function __clone()
    {
        // @phpstan-ignore-next-line
        foreach ($this as $key <?php echo> $val) {
            if ($key <?php echo<?php echo 'parent') {
                continue;
            }

            if (is_object($val) || (is_array($val))) {
                if ($key <?php echo<?php echo 'cellCollection') {
                    $newCollection <?php echo $this->cellCollection->cloneCellCollection($this);
                    $this->cellCollection <?php echo $newCollection;
                } elseif ($key <?php echo<?php echo 'drawingCollection') {
                    $currentCollection <?php echo $this->drawingCollection;
                    $this->drawingCollection <?php echo new ArrayObject();
                    foreach ($currentCollection as $item) {
                        if (is_object($item)) {
                            $newDrawing <?php echo clone $item;
                            $newDrawing->setWorksheet($this);
                        }
                    }
                } elseif (($key <?php echo<?php echo 'autoFilter') && ($this->autoFilter instanceof AutoFilter)) {
                    $newAutoFilter <?php echo clone $this->autoFilter;
                    $this->autoFilter <?php echo $newAutoFilter;
                    $this->autoFilter->setParent($this);
                } else {
                    $this->{$key} <?php echo unserialize(serialize($val));
                }
            }
        }
    }

    /**
     * Define the code name of the sheet.
     *
     * @param string $codeName Same rule as Title minus space not allowed (but, like Excel, change
     *                       silently space to underscore)
     * @param bool $validate False to skip validation of new title. WARNING: This should only be set
     *                       at parse time (by Readers), where titles can be assumed to be valid.
     *
     * @return $this
     */
    public function setCodeName($codeName, $validate <?php echo true)
    {
        // Is this a 'rename' or not?
        if ($this->getCodeName() <?php echo<?php echo $codeName) {
            return $this;
        }

        if ($validate) {
            $codeName <?php echo str_replace(' ', '_', $codeName); //Excel does this automatically without flinching, we are doing the same

            // Syntax check
            // throw an exception if not valid
            self::checkSheetCodeName($codeName);

            // We use the same code that setTitle to find a valid codeName else not using a space (Excel don't like) but a '_'

            if ($this->parent !<?php echo<?php echo null) {
                // Is there already such sheet name?
                if ($this->parent->sheetCodeNameExists($codeName)) {
                    // Use name, but append with lowest possible integer

                    if (Shared\StringHelper::countCharacters($codeName) > 29) {
                        $codeName <?php echo Shared\StringHelper::substring($codeName, 0, 29);
                    }
                    $i <?php echo 1;
                    while ($this->getParentOrThrow()->sheetCodeNameExists($codeName . '_' . $i)) {
                        ++$i;
                        if ($i <?php echo<?php echo 10) {
                            if (Shared\StringHelper::countCharacters($codeName) > 28) {
                                $codeName <?php echo Shared\StringHelper::substring($codeName, 0, 28);
                            }
                        } elseif ($i <?php echo<?php echo 100) {
                            if (Shared\StringHelper::countCharacters($codeName) > 27) {
                                $codeName <?php echo Shared\StringHelper::substring($codeName, 0, 27);
                            }
                        }
                    }

                    $codeName .<?php echo '_' . $i; // ok, we have a valid name
                }
            }
        }

        $this->codeName <?php echo $codeName;

        return $this;
    }

    /**
     * Return the code name of the sheet.
     *
     * @return null|string
     */
    public function getCodeName()
    {
        return $this->codeName;
    }

    /**
     * Sheet has a code name ?
     *
     * @return bool
     */
    public function hasCodeName()
    {
        return $this->codeName !<?php echo<?php echo null;
    }

    public static function nameRequiresQuotes(string $sheetName): bool
    {
        return preg_match(self::SHEET_NAME_REQUIRES_NO_QUOTES, $sheetName) !<?php echo<?php echo 1;
    }
}
