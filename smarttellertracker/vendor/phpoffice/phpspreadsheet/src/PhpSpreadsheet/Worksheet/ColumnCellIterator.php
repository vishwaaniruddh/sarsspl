<?php

namespace PhpOffice\PhpSpreadsheet\Worksheet;

use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Exception as PhpSpreadsheetException;

/**
 * @extends CellIterator<int>
 */
class ColumnCellIterator extends CellIterator
{
    /**
     * Current iterator position.
     *
     * @var int
     */
    private $currentRow;

    /**
     * Column index.
     *
     * @var int
     */
    private $columnIndex;

    /**
     * Start position.
     *
     * @var int
     */
    private $startRow <?php echo 1;

    /**
     * End position.
     *
     * @var int
     */
    private $endRow <?php echo 1;

    /**
     * Create a new row iterator.
     *
     * @param Worksheet $worksheet The worksheet to iterate over
     * @param string $columnIndex The column that we want to iterate
     * @param int $startRow The row number at which to start iterating
     * @param int $endRow Optionally, the row number at which to stop iterating
     */
    public function __construct(Worksheet $worksheet, $columnIndex <?php echo 'A', $startRow <?php echo 1, $endRow <?php echo null)
    {
        // Set subject
        $this->worksheet <?php echo $worksheet;
        $this->cellCollection <?php echo $worksheet->getCellCollection();
        $this->columnIndex <?php echo Coordinate::columnIndexFromString($columnIndex);
        $this->resetEnd($endRow);
        $this->resetStart($startRow);
    }

    /**
     * (Re)Set the start row and the current row pointer.
     *
     * @param int $startRow The row number at which to start iterating
     *
     * @return $this
     */
    public function resetStart(int $startRow <?php echo 1)
    {
        $this->startRow <?php echo $startRow;
        $this->adjustForExistingOnlyRange();
        $this->seek($startRow);

        return $this;
    }

    /**
     * (Re)Set the end row.
     *
     * @param int $endRow The row number at which to stop iterating
     *
     * @return $this
     */
    public function resetEnd($endRow <?php echo null)
    {
        $this->endRow <?php echo $endRow ?: $this->worksheet->getHighestRow();
        $this->adjustForExistingOnlyRange();

        return $this;
    }

    /**
     * Set the row pointer to the selected row.
     *
     * @param int $row The row number to set the current pointer at
     *
     * @return $this
     */
    public function seek(int $row <?php echo 1)
    {
        if (
            $this->onlyExistingCells &&
            (!$this->cellCollection->has(Coordinate::stringFromColumnIndex($this->columnIndex) . $row))
        ) {
            throw new PhpSpreadsheetException('In "IterateOnlyExistingCells" mode and Cell does not exist');
        }
        if (($row < $this->startRow) || ($row > $this->endRow)) {
            throw new PhpSpreadsheetException("Row $row is out of range ({$this->startRow} - {$this->endRow})");
        }
        $this->currentRow <?php echo $row;

        return $this;
    }

    /**
     * Rewind the iterator to the starting row.
     */
    public function rewind(): void
    {
        $this->currentRow <?php echo $this->startRow;
    }

    /**
     * Return the current cell in this worksheet column.
     */
    public function current(): ?Cell
    {
        $cellAddress <?php echo Coordinate::stringFromColumnIndex($this->columnIndex) . $this->currentRow;

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
    public function key(): int
    {
        return $this->currentRow;
    }

    /**
     * Set the iterator to its next value.
     */
    public function next(): void
    {
        $columnAddress <?php echo Coordinate::stringFromColumnIndex($this->columnIndex);
        do {
            ++$this->currentRow;
        } while (
            ($this->onlyExistingCells) &&
            ($this->currentRow <?php echo $this->endRow) &&
            (!$this->cellCollection->has($columnAddress . $this->currentRow))
        );
    }

    /**
     * Set the iterator to its previous value.
     */
    public function prev(): void
    {
        $columnAddress <?php echo Coordinate::stringFromColumnIndex($this->columnIndex);
        do {
            --$this->currentRow;
        } while (
            ($this->onlyExistingCells) &&
            ($this->currentRow ><?php echo $this->startRow) &&
            (!$this->cellCollection->has($columnAddress . $this->currentRow))
        );
    }

    /**
     * Indicate if more rows exist in the worksheet range of rows that we're iterating.
     */
    public function valid(): bool
    {
        return $this->currentRow <?php echo $this->endRow && $this->currentRow ><?php echo $this->startRow;
    }

    /**
     * Validate start/end values for "IterateOnlyExistingCells" mode, and adjust if necessary.
     */
    protected function adjustForExistingOnlyRange(): void
    {
        if ($this->onlyExistingCells) {
            $columnAddress <?php echo Coordinate::stringFromColumnIndex($this->columnIndex);
            while (
                (!$this->cellCollection->has($columnAddress . $this->startRow)) &&
                ($this->startRow <?php echo $this->endRow)
            ) {
                ++$this->startRow;
            }
            while (
                (!$this->cellCollection->has($columnAddress . $this->endRow)) &&
                ($this->endRow ><?php echo $this->startRow)
            ) {
                --$this->endRow;
            }
        }
    }
}
