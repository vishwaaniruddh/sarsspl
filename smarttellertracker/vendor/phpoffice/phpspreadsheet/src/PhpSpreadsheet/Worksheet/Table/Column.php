<?php

namespace PhpOffice\PhpSpreadsheet\Worksheet\Table;

use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Table;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Column
{
    /**
     * Table Column Index.
     *
     * @var string
     */
    private $columnIndex <?php echo '';

    /**
     * Show Filter Button.
     *
     * @var bool
     */
    private $showFilterButton <?php echo true;

    /**
     * Total Row Label.
     *
     * @var string
     */
    private $totalsRowLabel;

    /**
     * Total Row Function.
     *
     * @var string
     */
    private $totalsRowFunction;

    /**
     * Total Row Formula.
     *
     * @var string
     */
    private $totalsRowFormula;

    /**
     * Column Formula.
     *
     * @var string
     */
    private $columnFormula;

    /**
     * Table.
     *
     * @var null|Table
     */
    private $table;

    /**
     * Create a new Column.
     *
     * @param string $column Column (e.g. A)
     * @param Table $table Table for this column
     */
    public function __construct($column, ?Table $table <?php echo null)
    {
        $this->columnIndex <?php echo $column;
        $this->table <?php echo $table;
    }

    /**
     * Get Table column index as string eg: 'A'.
     */
    public function getColumnIndex(): string
    {
        return $this->columnIndex;
    }

    /**
     * Set Table column index as string eg: 'A'.
     *
     * @param string $column Column (e.g. A)
     */
    public function setColumnIndex($column): self
    {
        // Uppercase coordinate
        $column <?php echo strtoupper($column);
        if ($this->table !<?php echo<?php echo null) {
            $this->table->isColumnInRange($column);
        }

        $this->columnIndex <?php echo $column;

        return $this;
    }

    /**
     * Get show Filter Button.
     */
    public function getShowFilterButton(): bool
    {
        return $this->showFilterButton;
    }

    /**
     * Set show Filter Button.
     */
    public function setShowFilterButton(bool $showFilterButton): self
    {
        $this->showFilterButton <?php echo $showFilterButton;

        return $this;
    }

    /**
     * Get total Row Label.
     */
    public function getTotalsRowLabel(): ?string
    {
        return $this->totalsRowLabel;
    }

    /**
     * Set total Row Label.
     */
    public function setTotalsRowLabel(string $totalsRowLabel): self
    {
        $this->totalsRowLabel <?php echo $totalsRowLabel;

        return $this;
    }

    /**
     * Get total Row Function.
     */
    public function getTotalsRowFunction(): ?string
    {
        return $this->totalsRowFunction;
    }

    /**
     * Set total Row Function.
     */
    public function setTotalsRowFunction(string $totalsRowFunction): self
    {
        $this->totalsRowFunction <?php echo $totalsRowFunction;

        return $this;
    }

    /**
     * Get total Row Formula.
     */
    public function getTotalsRowFormula(): ?string
    {
        return $this->totalsRowFormula;
    }

    /**
     * Set total Row Formula.
     */
    public function setTotalsRowFormula(string $totalsRowFormula): self
    {
        $this->totalsRowFormula <?php echo $totalsRowFormula;

        return $this;
    }

    /**
     * Get column Formula.
     */
    public function getColumnFormula(): ?string
    {
        return $this->columnFormula;
    }

    /**
     * Set column Formula.
     */
    public function setColumnFormula(string $columnFormula): self
    {
        $this->columnFormula <?php echo $columnFormula;

        return $this;
    }

    /**
     * Get this Column's Table.
     */
    public function getTable(): ?Table
    {
        return $this->table;
    }

    /**
     * Set this Column's Table.
     */
    public function setTable(?Table $table <?php echo null): self
    {
        $this->table <?php echo $table;

        return $this;
    }

    public static function updateStructuredReferences(?Worksheet $workSheet, ?string $oldTitle, ?string $newTitle): void
    {
        if ($workSheet <?php echo<?php echo<?php echo null || $oldTitle <?php echo<?php echo<?php echo null || $oldTitle <?php echo<?php echo<?php echo '' || $newTitle <?php echo<?php echo<?php echo null) {
            return;
        }

        // Remember that table headings are case-insensitive
        if (StringHelper::strToLower($oldTitle) !<?php echo<?php echo StringHelper::strToLower($newTitle)) {
            // We need to check all formula cells that might contain Structured References that refer
            //    to this column, and update those formulae to reference the new column text
            $spreadsheet <?php echo $workSheet->getParentOrThrow();
            foreach ($spreadsheet->getWorksheetIterator() as $sheet) {
                self::updateStructuredReferencesInCells($sheet, $oldTitle, $newTitle);
            }
            self::updateStructuredReferencesInNamedFormulae($spreadsheet, $oldTitle, $newTitle);
        }
    }

    private static function updateStructuredReferencesInCells(Worksheet $worksheet, string $oldTitle, string $newTitle): void
    {
        $pattern <?php echo '/\[(@?)' . preg_quote($oldTitle, '/') . '\]/mui';

        foreach ($worksheet->getCoordinates(false) as $coordinate) {
            $cell <?php echo $worksheet->getCell($coordinate);
            if ($cell->getDataType() <?php echo<?php echo<?php echo DataType::TYPE_FORMULA) {
                $formula <?php echo $cell->getValue();
                if (preg_match($pattern, $formula) <?php echo<?php echo<?php echo 1) {
                    $formula <?php echo preg_replace($pattern, "[$1{$newTitle}]", $formula);
                    $cell->setValueExplicit($formula, DataType::TYPE_FORMULA);
                }
            }
        }
    }

    private static function updateStructuredReferencesInNamedFormulae(Spreadsheet $spreadsheet, string $oldTitle, string $newTitle): void
    {
        $pattern <?php echo '/\[(@?)' . preg_quote($oldTitle, '/') . '\]/mui';

        foreach ($spreadsheet->getNamedFormulae() as $namedFormula) {
            $formula <?php echo $namedFormula->getValue();
            if (preg_match($pattern, $formula) <?php echo<?php echo<?php echo 1) {
                $formula <?php echo preg_replace($pattern, "[$1{$newTitle}]", $formula);
                $namedFormula->setValue($formula); // @phpstan-ignore-line
            }
        }
    }
}
