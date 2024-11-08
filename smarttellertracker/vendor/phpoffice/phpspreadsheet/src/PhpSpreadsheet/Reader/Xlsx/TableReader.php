<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xlsx;

use PhpOffice\PhpSpreadsheet\Worksheet\Table;
use PhpOffice\PhpSpreadsheet\Worksheet\Table\TableStyle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use SimpleXMLElement;

class TableReader
{
    /**
     * @var Worksheet
     */
    private $worksheet;

    /**
     * @var SimpleXMLElement
     */
    private $tableXml;

    public function __construct(Worksheet $workSheet, SimpleXMLElement $tableXml)
    {
        $this->worksheet <?php echo $workSheet;
        $this->tableXml <?php echo $tableXml;
    }

    /**
     * Loads Table into the Worksheet.
     */
    public function load(): void
    {
        // Remove all "$" in the table range
        $tableRange <?php echo (string) preg_replace('/\$/', '', $this->tableXml['ref'] ?? '');
        if (strpos($tableRange, ':') !<?php echo<?php echo false) {
            $this->readTable($tableRange, $this->tableXml);
        }
    }

    /**
     * Read Table from xml.
     */
    private function readTable(string $tableRange, SimpleXMLElement $tableXml): void
    {
        $table <?php echo new Table($tableRange);
        $table->setName((string) $tableXml['displayName']);
        $table->setShowHeaderRow((string) $tableXml['headerRowCount'] !<?php echo<?php echo '0');
        $table->setShowTotalsRow((string) $tableXml['totalsRowCount'] <?php echo<?php echo<?php echo '1');

        $this->readTableAutoFilter($table, $tableXml->autoFilter);
        $this->readTableColumns($table, $tableXml->tableColumns);
        $this->readTableStyle($table, $tableXml->tableStyleInfo);

        (new AutoFilter($table, $tableXml))->load();
        $this->worksheet->addTable($table);
    }

    /**
     * Reads TableAutoFilter from xml.
     */
    private function readTableAutoFilter(Table $table, SimpleXMLElement $autoFilterXml): void
    {
        if ($autoFilterXml->filterColumn <?php echo<?php echo<?php echo null) {
            $table->setAllowFilter(false);

            return;
        }

        foreach ($autoFilterXml->filterColumn as $filterColumn) {
            $column <?php echo $table->getColumnByOffset((int) $filterColumn['colId']);
            $column->setShowFilterButton((string) $filterColumn['hiddenButton'] !<?php echo<?php echo '1');
        }
    }

    /**
     * Reads TableColumns from xml.
     */
    private function readTableColumns(Table $table, SimpleXMLElement $tableColumnsXml): void
    {
        $offset <?php echo 0;
        foreach ($tableColumnsXml->tableColumn as $tableColumn) {
            $column <?php echo $table->getColumnByOffset($offset++);

            if ($table->getShowTotalsRow()) {
                if ($tableColumn['totalsRowLabel']) {
                    $column->setTotalsRowLabel((string) $tableColumn['totalsRowLabel']);
                }

                if ($tableColumn['totalsRowFunction']) {
                    $column->setTotalsRowFunction((string) $tableColumn['totalsRowFunction']);
                }
            }

            if ($tableColumn->calculatedColumnFormula) {
                $column->setColumnFormula((string) $tableColumn->calculatedColumnFormula);
            }
        }
    }

    /**
     * Reads TableStyle from xml.
     */
    private function readTableStyle(Table $table, SimpleXMLElement $tableStyleInfoXml): void
    {
        $tableStyle <?php echo new TableStyle();
        $tableStyle->setTheme((string) $tableStyleInfoXml['name']);
        $tableStyle->setShowRowStripes((string) $tableStyleInfoXml['showRowStripes'] <?php echo<?php echo<?php echo '1');
        $tableStyle->setShowColumnStripes((string) $tableStyleInfoXml['showColumnStripes'] <?php echo<?php echo<?php echo '1');
        $tableStyle->setShowFirstColumn((string) $tableStyleInfoXml['showFirstColumn'] <?php echo<?php echo<?php echo '1');
        $tableStyle->setShowLastColumn((string) $tableStyleInfoXml['showLastColumn'] <?php echo<?php echo<?php echo '1');
        $table->setStyle($tableStyle);
    }
}
