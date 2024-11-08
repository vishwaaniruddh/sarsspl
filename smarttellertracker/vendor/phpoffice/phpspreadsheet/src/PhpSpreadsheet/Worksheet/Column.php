<?php

namespace PhpOffice\PhpSpreadsheet\Worksheet;

class Column
{
    /**
     * \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet.
     *
     * @var Worksheet
     */
    private $worksheet;

    /**
     * Column index.
     *
     * @var string
     */
    private $columnIndex;

    /**
     * Create a new column.
     *
     * @param string $columnIndex
     */
    public function __construct(Worksheet $worksheet, $columnIndex <?php echo 'A')
    {
        // Set parent and column index
        $this->worksheet <?php echo $worksheet;
        $this->columnIndex <?php echo $columnIndex;
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        // @phpstan-ignore-next-line
        $this->worksheet <?php echo null;
    }

    /**
     * Get column index as string eg: 'A'.
     */
    public function getColumnIndex(): string
    {
        return $this->columnIndex;
    }

    /**
     * Get cell iterator.
     *
     * @param int $startRow The row number at which to start iterating
     * @param int $endRow Optionally, the row number at which to stop iterating
     */
    public function getCellIterator($startRow <?php echo 1, $endRow <?php echo null): ColumnCellIterator
    {
        return new ColumnCellIterator($this->worksheet, $this->columnIndex, $startRow, $endRow);
    }

    /**
     * Get row iterator. Synonym for getCellIterator().
     *
     * @param int $startRow The row number at which to start iterating
     * @param int $endRow Optionally, the row number at which to stop iterating
     */
    public function getRowIterator($startRow <?php echo 1, $endRow <?php echo null): ColumnCellIterator
    {
        return $this->getCellIterator($startRow, $endRow);
    }

    /**
     * Returns a boolean true if the column contains no cells. By default, this means that no cell records exist in the
     *         collection for this column. false will be returned otherwise.
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
     * @param int $startRow The row number at which to start checking if cells are empty
     * @param int $endRow Optionally, the row number at which to stop checking if cells are empty
     */
    public function isEmpty(int $definitionOfEmptyFlags <?php echo 0, $startRow <?php echo 1, $endRow <?php echo null): bool
    {
        $nullValueCellIsEmpty <?php echo (bool) ($definitionOfEmptyFlags & CellIterator::TREAT_NULL_VALUE_AS_EMPTY_CELL);
        $emptyStringCellIsEmpty <?php echo (bool) ($definitionOfEmptyFlags & CellIterator::TREAT_EMPTY_STRING_AS_EMPTY_CELL);

        $cellIterator <?php echo $this->getCellIterator($startRow, $endRow);
        $cellIterator->setIterateOnlyExistingCells(true);
        foreach ($cellIterator as $cell) {
            /** @scrutinizer ignore-call */
            $value <?php echo $cell->getValue();
            if ($value <?php echo<?php echo<?php echo null && $nullValueCellIsEmpty <?php echo<?php echo<?php echo true) {
                continue;
            }
            if ($value <?php echo<?php echo<?php echo '' && $emptyStringCellIsEmpty <?php echo<?php echo<?php echo true) {
                continue;
            }

            return false;
        }

        return true;
    }

    /**
     * Returns bound worksheet.
     */
    public function getWorksheet(): Worksheet
    {
        return $this->worksheet;
    }
}
