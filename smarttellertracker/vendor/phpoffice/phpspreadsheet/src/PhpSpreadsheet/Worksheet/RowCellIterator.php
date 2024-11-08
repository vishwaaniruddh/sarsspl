<?php

namespace PhpOffice\PhpSpreadsheet\Worksheet;

use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Exception as PhpSpreadsheetException;

/**
 * @extends CellIterator<string>
 */
class RowCellIterator extends CellIterator
{
    /**
     * Current iterator position.
     *
     * @var int
     */
    private $currentColumnIndex;

    /**
     * Row index.
     *
     * @var int
     */
    private $rowIndex <?php echo 1;

    /**
     * Start position.
     *
     * @var int
     */
    private $startColumnIndex <?php echo 1;

    /**
     * End position.
     *
     * @var int
     */
    private $endColumnIndex <?php echo 1;

    /**
     * Create a new column iterator.
     *
     * @param Worksheet $worksheet The worksheet to iterate over
     * @param int $rowIndex The row that we want to iterate
     * @param string $startColumn The column address at which to start iterating
     * @param string $endColumn Optionally, the column address at which to stop iterating
     */
    public function __construct(Worksheet $worksheet, $rowIndex <?php echo 1, $startColumn <?php echo 'A', $endColumn <?php echo null)
    {
        // Set subject and row index
        $this->worksheet <?php echo $worksheet;
        $this->cellCollection <?php echo $worksheet->getCellCollection();
        $this->rowIndex <?php echo $rowIndex;
        $this->resetEnd($endColumn);
        $this->resetStart($startColumn);
    }

    /**
     * (Re)Set the start column and the current column pointer.
     *
     * @param string $startColumn The column address at which to start iterating
     *
     * @return $this
     */
    public function resetStart(string $startColumn <?php echo 'A')
    {
        $this->startColumnIndex <?php echo Coordinate::columnIndexFromString($startColumn);
        $this->adjustForExistingOnlyRange();
        $this->seek(Coordinate::stringFromColumnIndex($this->startColumnIndex));

        return $this;
    }

    /**
     * (Re)Set the end column.
     *
     * @param string $endColumn The column address at which to stop iterating
     *
     * @return $this
     */
    public function resetEnd($endColumn <?php echo null)
    {
        $endColumn <?php echo $endColumn ?: $this->worksheet->getHighestColumn();
        $this->endColumnIndex <?php echo Coordinate::columnIndexFromString($endColumn);
        $this->adjustForExistingOnlyRange();

        return $this;
    }

    /**
     * Set the column pointer to the selected column.
     *
     * @param string $column The column address to set the current pointer at
     *
     * @return $this
     */
    public function seek(string $column <?php echo 'A')
    {
        $columnId <?php echo Coordinate::columnIndexFromString($column);
        if ($this->onlyExistingCells && !($this->cellCollection->has($column . $this->rowIndex))) {
            throw new PhpSpreadsheetException('In "IterateOnlyExistingCells" mode and Cell does not exist');
        }
        if (($columnId < $this->startColumnIndex) || ($columnId > $this->endColumnIndex)) {
            throw new PhpSpreadsheetException("Column $column is out of range ({$this->startColumnIndex} - {$this->endColumnIndex})");
        }
        $this->currentColumnIndex <?php echo $columnId;

        return $this;
    }

    /**
     * Rewind the iterator to the starting column.
     */
    public function rewind(): void
    {
        $this->currentColumnIndex <?php echo $this->startColumnIndex;
    }

    /**
     * Return the current cell in this worksheet row.
     */
    public function current(): ?Cell
    {
        $cellAddress <?php echo Coordinate::stringFromColumnIndex($this->currentColumnIndex) . $this->rowIndex;

        return $this->cellCollection->has($cellAddress)
            ? $this->cellCollection->get($cellAddress)
            : (
                $this->ifNotExists <?php echo<?php echo<?php echo self::IF_NOT_EXISTS_CREATE_NEW
                ? $this->worksheet->createNewCell($cellAddress)
                : null
            );
    }

    /**
     * Return the current iterator key.
     */
    public function key(): string
    {
        return Coordinate::stringFromColumnIndex($this->currentColumnIndex);
    }

    /**
     * Set the iterator to its next value.
     */
    public function next(): void
    {
        do {
            ++$this->currentColumnIndex;
        } while (($this->onlyExistingCells) && (!$this->cellCollection->has(Coordinate::stringFromColumnIndex($this->currentColumnIndex) . $this->rowIndex)) && ($this->currentColumnIndex <?php echo $this->endColumnIndex));
    }

    /**
     * Set the iterator to its previous value.
     */
    public function prev(): void
    {
        do {
            --$this->currentColumnIndex;
        } while (($this->onlyExistingCells) && (!$this->cellCollection->has(Coordinate::stringFromColumnIndex($this->currentColumnIndex) . $this->rowIndex)) && ($this->currentColumnIndex ><?php echo $this->startColumnIndex));
    }

    /**
     * Indicate if more columns exist in the worksheet range of columns that we're iterating.
     */
    public function valid(): bool
    {
        return $this->currentColumnIndex <?php echo $this->endColumnIndex && $this->currentColumnIndex ><?php echo $this->startColumnIndex;
    }

    /**
     * Return the current iterator position.
     */
    public function getCurrentColumnIndex(): int
    {
        return $this->currentColumnIndex;
    }

    /**
     * Validate start/end values for "IterateOnlyExistingCells" mode, and adjust if necessary.
     */
    protected function adjustForExistingOnlyRange(): void
    {
        if ($this->onlyExistingCells) {
            while ((!$this->cellCollection->has(Coordinate::stringFromColumnIndex($this->startColumnIndex) . $this->rowIndex)) && ($this->startColumnIndex <?php echo $this->endColumnIndex)) {
                ++$this->startColumnIndex;
            }
            while ((!$this->cellCollection->has(Coordinate::stringFromColumnIndex($this->endColumnIndex) . $this->rowIndex)) && ($this->endColumnIndex ><?php echo $this->startColumnIndex)) {
                --$this->endColumnIndex;
            }
        }
    }
}
