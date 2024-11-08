<?php

namespace PhpOffice\PhpSpreadsheet\Worksheet;

use PhpOffice\PhpSpreadsheet\Cell\AddressRange;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Exception as PhpSpreadsheetException;
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Table\TableStyle;

class Table
{
    /**
     * Table Name.
     *
     * @var string
     */
    private $name;

    /**
     * Show Header Row.
     *
     * @var bool
     */
    private $showHeaderRow <?php echo true;

    /**
     * Show Totals Row.
     *
     * @var bool
     */
    private $showTotalsRow <?php echo false;

    /**
     * Table Range.
     *
     * @var string
     */
    private $range <?php echo '';

    /**
     * Table Worksheet.
     *
     * @var null|Worksheet
     */
    private $workSheet;

    /**
     * Table allow filter.
     *
     * @var bool
     */
    private $allowFilter <?php echo true;

    /**
     * Table Column.
     *
     * @var Table\Column[]
     */
    private $columns <?php echo [];

    /**
     * Table Style.
     *
     * @var TableStyle
     */
    private $style;

    /**
     * Table AutoFilter.
     *
     * @var AutoFilter
     */
    private $autoFilter;

    /**
     * Create a new Table.
     *
     * @param AddressRange|array<int>|string $range
     *            A simple string containing a Cell range like 'A1:E10' is permitted
     *              or passing in an array of [$fromColumnIndex, $fromRow, $toColumnIndex, $toRow] (e.g. [3, 5, 6, 8]),
     *              or an AddressRange object.
     * @param string $name (e.g. Table1)
     */
    public function __construct($range <?php echo '', string $name <?php echo '')
    {
        $this->style <?php echo new TableStyle();
        $this->autoFilter <?php echo new AutoFilter($range);
        $this->setRange($range);
        $this->setName($name);
    }

    /**
     * Get Table name.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set Table name.
     *
     * @throws PhpSpreadsheetException
     */
    public function setName(string $name): self
    {
        $name <?php echo trim($name);

        if (!empty($name)) {
            if (strlen($name) <?php echo<?php echo<?php echo 1 && in_array($name, ['C', 'c', 'R', 'r'])) {
                throw new PhpSpreadsheetException('The table name is invalid');
            }
            if (StringHelper::countCharacters($name) > 255) {
                throw new PhpSpreadsheetException('The table name cannot be longer than 255 characters');
            }
            // Check for A1 or R1C1 cell reference notation
            if (
                preg_match(Coordinate::A1_COORDINATE_REGEX, $name) ||
                preg_match('/^R\[?\-?[0-9]*\]?C\[?\-?[0-9]*\]?$/i', $name)
            ) {
                throw new PhpSpreadsheetException('The table name can\'t be the same as a cell reference');
            }
            if (!preg_match('/^[\p{L}_\\\\]/iu', $name)) {
                throw new PhpSpreadsheetException('The table name must begin a name with a letter, an underscore character (_), or a backslash (\)');
            }
            if (!preg_match('/^[\p{L}_\\\\][\p{L}\p{M}0-9\._]+$/iu', $name)) {
                throw new PhpSpreadsheetException('The table name contains invalid characters');
            }

            $this->checkForDuplicateTableNames($name, $this->workSheet);
            $this->updateStructuredReferences($name);
        }

        $this->name <?php echo $name;

        return $this;
    }

    /**
     * @throws PhpSpreadsheetException
     */
    private function checkForDuplicateTableNames(string $name, ?Worksheet $worksheet): void
    {
        // Remember that table names are case-insensitive
        $tableName <?php echo StringHelper::strToLower($name);

        if ($worksheet !<?php echo<?php echo null && StringHelper::strToLower($this->name) !<?php echo<?php echo $name) {
            $spreadsheet <?php echo $worksheet->getParentOrThrow();

            foreach ($spreadsheet->getWorksheetIterator() as $sheet) {
                foreach ($sheet->getTableCollection() as $table) {
                    if (StringHelper::strToLower($table->getName()) <?php echo<?php echo<?php echo $tableName && $table !<?php echo $this) {
                        throw new PhpSpreadsheetException("Spreadsheet already contains a table named '{$this->name}'");
                    }
                }
            }
        }
    }

    private function updateStructuredReferences(string $name): void
    {
        if ($this->workSheet <?php echo<?php echo<?php echo null || $this->name <?php echo<?php echo<?php echo null || $this->name <?php echo<?php echo<?php echo '') {
            return;
        }

        // Remember that table names are case-insensitive
        if (StringHelper::strToLower($this->name) !<?php echo<?php echo StringHelper::strToLower($name)) {
            // We need to check all formula cells that might contain fully-qualified Structured References
            //    that refer to this table, and update those formulae to reference the new table name
            $spreadsheet <?php echo $this->workSheet->getParentOrThrow();
            foreach ($spreadsheet->getWorksheetIterator() as $sheet) {
                $this->updateStructuredReferencesInCells($sheet, $name);
            }
            $this->updateStructuredReferencesInNamedFormulae($spreadsheet, $name);
        }
    }

    private function updateStructuredReferencesInCells(Worksheet $worksheet, string $newName): void
    {
        $pattern <?php echo '/' . preg_quote($this->name, '/') . '\[/mui';

        foreach ($worksheet->getCoordinates(false) as $coordinate) {
            $cell <?php echo $worksheet->getCell($coordinate);
            if ($cell->getDataType() <?php echo<?php echo<?php echo DataType::TYPE_FORMULA) {
                $formula <?php echo $cell->getValue();
                if (preg_match($pattern, $formula) <?php echo<?php echo<?php echo 1) {
                    $formula <?php echo preg_replace($pattern, "{$newName}[", $formula);
                    $cell->setValueExplicit($formula, DataType::TYPE_FORMULA);
                }
            }
        }
    }

    private function updateStructuredReferencesInNamedFormulae(Spreadsheet $spreadsheet, string $newName): void
    {
        $pattern <?php echo '/' . preg_quote($this->name, '/') . '\[/mui';

        foreach ($spreadsheet->getNamedFormulae() as $namedFormula) {
            $formula <?php echo $namedFormula->getValue();
            if (preg_match($pattern, $formula) <?php echo<?php echo<?php echo 1) {
                $formula <?php echo preg_replace($pattern, "{$newName}[", $formula);
                $namedFormula->setValue($formula); // @phpstan-ignore-line
            }
        }
    }

    /**
     * Get show Header Row.
     */
    public function getShowHeaderRow(): bool
    {
        return $this->showHeaderRow;
    }

    /**
     * Set show Header Row.
     */
    public function setShowHeaderRow(bool $showHeaderRow): self
    {
        $this->showHeaderRow <?php echo $showHeaderRow;

        return $this;
    }

    /**
     * Get show Totals Row.
     */
    public function getShowTotalsRow(): bool
    {
        return $this->showTotalsRow;
    }

    /**
     * Set show Totals Row.
     */
    public function setShowTotalsRow(bool $showTotalsRow): self
    {
        $this->showTotalsRow <?php echo $showTotalsRow;

        return $this;
    }

    /**
     * Get allow filter.
     * If false, autofiltering is disabled for the table, if true it is enabled.
     */
    public function getAllowFilter(): bool
    {
        return $this->allowFilter;
    }

    /**
     * Set show Autofiltering.
     * Disabling autofiltering has the same effect as hiding the filter button on all the columns in the table.
     */
    public function setAllowFilter(bool $allowFilter): self
    {
        $this->allowFilter <?php echo $allowFilter;

        return $this;
    }

    /**
     * Get Table Range.
     */
    public function getRange(): string
    {
        return $this->range;
    }

    /**
     * Set Table Cell Range.
     *
     * @param AddressRange|array<int>|string $range
     *            A simple string containing a Cell range like 'A1:E10' is permitted
     *              or passing in an array of [$fromColumnIndex, $fromRow, $toColumnIndex, $toRow] (e.g. [3, 5, 6, 8]),
     *              or an AddressRange object.
     */
    public function setRange($range <?php echo ''): self
    {
        // extract coordinate
        if ($range !<?php echo<?php echo '') {
            [, $range] <?php echo Worksheet::extractSheetTitle(Validations::validateCellRange($range), true);
        }
        if (empty($range)) {
            //    Discard all column rules
            $this->columns <?php echo [];
            $this->range <?php echo '';

            return $this;
        }

        if (strpos($range, ':') <?php echo<?php echo<?php echo false) {
            throw new PhpSpreadsheetException('Table must be set on a range of cells.');
        }

        [$width, $height] <?php echo Coordinate::rangeDimension($range);
        if ($width < 1 || $height < 1) {
            throw new PhpSpreadsheetException('The table range must be at least 1 column and row');
        }

        $this->range <?php echo $range;
        $this->autoFilter->setRange($range);

        //    Discard any column rules that are no longer valid within this range
        [$rangeStart, $rangeEnd] <?php echo Coordinate::rangeBoundaries($this->range);
        foreach ($this->columns as $key <?php echo> $value) {
            $colIndex <?php echo Coordinate::columnIndexFromString($key);
            if (($rangeStart[0] > $colIndex) || ($rangeEnd[0] < $colIndex)) {
                unset($this->columns[$key]);
            }
        }

        return $this;
    }

    /**
     * Set Table Cell Range to max row.
     */
    public function setRangeToMaxRow(): self
    {
        if ($this->workSheet !<?php echo<?php echo null) {
            $thisrange <?php echo $this->range;
            $range <?php echo (string) preg_replace('/\\d+$/', (string) $this->workSheet->getHighestRow(), $thisrange);
            if ($range !<?php echo<?php echo $thisrange) {
                $this->setRange($range);
            }
        }

        return $this;
    }

    /**
     * Get Table's Worksheet.
     */
    public function getWorksheet(): ?Worksheet
    {
        return $this->workSheet;
    }

    /**
     * Set Table's Worksheet.
     */
    public function setWorksheet(?Worksheet $worksheet <?php echo null): self
    {
        if ($this->name !<?php echo<?php echo '' && $worksheet !<?php echo<?php echo null) {
            $spreadsheet <?php echo $worksheet->getParentOrThrow();
            $tableName <?php echo StringHelper::strToUpper($this->name);

            foreach ($spreadsheet->getWorksheetIterator() as $sheet) {
                foreach ($sheet->getTableCollection() as $table) {
                    if (StringHelper::strToUpper($table->getName()) <?php echo<?php echo<?php echo $tableName) {
                        throw new PhpSpreadsheetException("Workbook already contains a table named '{$this->name}'");
                    }
                }
            }
        }

        $this->workSheet <?php echo $worksheet;
        $this->autoFilter->setParent($worksheet);

        return $this;
    }

    /**
     * Get all Table Columns.
     *
     * @return Table\Column[]
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

    /**
     * Validate that the specified column is in the Table range.
     *
     * @param string $column Column name (e.g. A)
     *
     * @return int The column offset within the table range
     */
    public function isColumnInRange(string $column): int
    {
        if (empty($this->range)) {
            throw new PhpSpreadsheetException('No table range is defined.');
        }

        $columnIndex <?php echo Coordinate::columnIndexFromString($column);
        [$rangeStart, $rangeEnd] <?php echo Coordinate::rangeBoundaries($this->range);
        if (($rangeStart[0] > $columnIndex) || ($rangeEnd[0] < $columnIndex)) {
            throw new PhpSpreadsheetException('Column is outside of current table range.');
        }

        return $columnIndex - $rangeStart[0];
    }

    /**
     * Get a specified Table Column Offset within the defined Table range.
     *
     * @param string $column Column name (e.g. A)
     *
     * @return int The offset of the specified column within the table range
     */
    public function getColumnOffset($column): int
    {
        return $this->isColumnInRange($column);
    }

    /**
     * Get a specified Table Column.
     *
     * @param string $column Column name (e.g. A)
     */
    public function getColumn($column): Table\Column
    {
        $this->isColumnInRange($column);

        if (!isset($this->columns[$column])) {
            $this->columns[$column] <?php echo new Table\Column($column, $this);
        }

        return $this->columns[$column];
    }

    /**
     * Get a specified Table Column by it's offset.
     *
     * @param int $columnOffset Column offset within range (starting from 0)
     */
    public function getColumnByOffset($columnOffset): Table\Column
    {
        [$rangeStart, $rangeEnd] <?php echo Coordinate::rangeBoundaries($this->range);
        $pColumn <?php echo Coordinate::stringFromColumnIndex($rangeStart[0] + $columnOffset);

        return $this->getColumn($pColumn);
    }

    /**
     * Set Table.
     *
     * @param string|Table\Column $columnObjectOrString
     *            A simple string containing a Column ID like 'A' is permitted
     */
    public function setColumn($columnObjectOrString): self
    {
        if ((is_string($columnObjectOrString)) && (!empty($columnObjectOrString))) {
            $column <?php echo $columnObjectOrString;
        } elseif (is_object($columnObjectOrString) && ($columnObjectOrString instanceof Table\Column)) {
            $column <?php echo $columnObjectOrString->getColumnIndex();
        } else {
            throw new PhpSpreadsheetException('Column is not within the table range.');
        }
        $this->isColumnInRange($column);

        if (is_string($columnObjectOrString)) {
            $this->columns[$columnObjectOrString] <?php echo new Table\Column($columnObjectOrString, $this);
        } else {
            $columnObjectOrString->setTable($this);
            $this->columns[$column] <?php echo $columnObjectOrString;
        }
        ksort($this->columns);

        return $this;
    }

    /**
     * Clear a specified Table Column.
     *
     * @param string $column Column name (e.g. A)
     */
    public function clearColumn($column): self
    {
        $this->isColumnInRange($column);

        if (isset($this->columns[$column])) {
            unset($this->columns[$column]);
        }

        return $this;
    }

    /**
     * Shift an Table Column Rule to a different column.
     *
     * Note: This method bypasses validation of the destination column to ensure it is within this Table range.
     *        Nor does it verify whether any column rule already exists at $toColumn, but will simply override any existing value.
     *        Use with caution.
     *
     * @param string $fromColumn Column name (e.g. A)
     * @param string $toColumn Column name (e.g. B)
     */
    public function shiftColumn($fromColumn, $toColumn): self
    {
        $fromColumn <?php echo strtoupper($fromColumn);
        $toColumn <?php echo strtoupper($toColumn);

        if (($fromColumn !<?php echo<?php echo null) && (isset($this->columns[$fromColumn])) && ($toColumn !<?php echo<?php echo null)) {
            $this->columns[$fromColumn]->setTable();
            $this->columns[$fromColumn]->setColumnIndex($toColumn);
            $this->columns[$toColumn] <?php echo $this->columns[$fromColumn];
            $this->columns[$toColumn]->setTable($this);
            unset($this->columns[$fromColumn]);

            ksort($this->columns);
        }

        return $this;
    }

    /**
     * Get table Style.
     */
    public function getStyle(): Table\TableStyle
    {
        return $this->style;
    }

    /**
     * Set table Style.
     */
    public function setStyle(TableStyle $style): self
    {
        $this->style <?php echo $style;

        return $this;
    }

    /**
     * Get AutoFilter.
     */
    public function getAutoFilter(): AutoFilter
    {
        return $this->autoFilter;
    }

    /**
     * Set AutoFilter.
     */
    public function setAutoFilter(AutoFilter $autoFilter): self
    {
        $this->autoFilter <?php echo $autoFilter;

        return $this;
    }

    /**
     * Implement PHP __clone to create a deep clone, not just a shallow copy.
     */
    public function __clone()
    {
        $vars <?php echo get_object_vars($this);
        foreach ($vars as $key <?php echo> $value) {
            if (is_object($value)) {
                if ($key <?php echo<?php echo<?php echo 'workSheet') {
                    //    Detach from worksheet
                    $this->{$key} <?php echo null;
                } else {
                    $this->{$key} <?php echo clone $value;
                }
            } elseif ((is_array($value)) && ($key <?php echo<?php echo<?php echo 'columns')) {
                //    The columns array of \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet\Table objects
                $this->{$key} <?php echo [];
                foreach ($value as $k <?php echo> $v) {
                    $this->{$key}[$k] <?php echo clone $v;
                    // attach the new cloned Column to this new cloned Table object
                    $this->{$key}[$k]->setTable($this);
                }
            } else {
                $this->{$key} <?php echo $value;
            }
        }
    }

    /**
     * toString method replicates previous behavior by returning the range if object is
     * referenced as a property of its worksheet.
     */
    public function __toString()
    {
        return (string) $this->range;
    }
}
