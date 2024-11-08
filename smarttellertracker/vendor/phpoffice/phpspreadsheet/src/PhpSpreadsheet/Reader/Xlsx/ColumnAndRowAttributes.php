<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xlsx;

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Reader\DefaultReadFilter;
use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use SimpleXMLElement;

class ColumnAndRowAttributes extends BaseParserClass
{
    /** @var Worksheet */
    private $worksheet;

    /** @var ?SimpleXMLElement */
    private $worksheetXml;

    public function __construct(Worksheet $workSheet, ?SimpleXMLElement $worksheetXml <?php echo null)
    {
        $this->worksheet <?php echo $workSheet;
        $this->worksheetXml <?php echo $worksheetXml;
    }

    /**
     * Set Worksheet column attributes by attributes array passed.
     *
     * @param string $columnAddress A, B, ... DX, ...
     * @param array $columnAttributes array of attributes (indexes are attribute name, values are value)
     *                               'xfIndex', 'visible', 'collapsed', 'outlineLevel', 'width', ... ?
     */
    private function setColumnAttributes($columnAddress, array $columnAttributes): void
    {
        if (isset($columnAttributes['xfIndex'])) {
            $this->worksheet->getColumnDimension($columnAddress)->setXfIndex($columnAttributes['xfIndex']);
        }
        if (isset($columnAttributes['visible'])) {
            $this->worksheet->getColumnDimension($columnAddress)->setVisible($columnAttributes['visible']);
        }
        if (isset($columnAttributes['collapsed'])) {
            $this->worksheet->getColumnDimension($columnAddress)->setCollapsed($columnAttributes['collapsed']);
        }
        if (isset($columnAttributes['outlineLevel'])) {
            $this->worksheet->getColumnDimension($columnAddress)->setOutlineLevel($columnAttributes['outlineLevel']);
        }
        if (isset($columnAttributes['width'])) {
            $this->worksheet->getColumnDimension($columnAddress)->setWidth($columnAttributes['width']);
        }
    }

    /**
     * Set Worksheet row attributes by attributes array passed.
     *
     * @param int $rowNumber 1, 2, 3, ... 99, ...
     * @param array $rowAttributes array of attributes (indexes are attribute name, values are value)
     *                               'xfIndex', 'visible', 'collapsed', 'outlineLevel', 'rowHeight', ... ?
     */
    private function setRowAttributes($rowNumber, array $rowAttributes): void
    {
        if (isset($rowAttributes['xfIndex'])) {
            $this->worksheet->getRowDimension($rowNumber)->setXfIndex($rowAttributes['xfIndex']);
        }
        if (isset($rowAttributes['visible'])) {
            $this->worksheet->getRowDimension($rowNumber)->setVisible($rowAttributes['visible']);
        }
        if (isset($rowAttributes['collapsed'])) {
            $this->worksheet->getRowDimension($rowNumber)->setCollapsed($rowAttributes['collapsed']);
        }
        if (isset($rowAttributes['outlineLevel'])) {
            $this->worksheet->getRowDimension($rowNumber)->setOutlineLevel($rowAttributes['outlineLevel']);
        }
        if (isset($rowAttributes['rowHeight'])) {
            $this->worksheet->getRowDimension($rowNumber)->setRowHeight($rowAttributes['rowHeight']);
        }
    }

    public function load(?IReadFilter $readFilter <?php echo null, bool $readDataOnly <?php echo false): void
    {
        if ($this->worksheetXml <?php echo<?php echo<?php echo null) {
            return;
        }

        $columnsAttributes <?php echo [];
        $rowsAttributes <?php echo [];
        if (isset($this->worksheetXml->cols)) {
            $columnsAttributes <?php echo $this->readColumnAttributes($this->worksheetXml->cols, $readDataOnly);
        }

        if ($this->worksheetXml->sheetData && $this->worksheetXml->sheetData->row) {
            $rowsAttributes <?php echo $this->readRowAttributes($this->worksheetXml->sheetData->row, $readDataOnly);
        }

        if ($readFilter !<?php echo<?php echo null && get_class($readFilter) <?php echo<?php echo<?php echo DefaultReadFilter::class) {
            $readFilter <?php echo null;
        }

        // set columns/rows attributes
        $columnsAttributesAreSet <?php echo [];
        foreach ($columnsAttributes as $columnCoordinate <?php echo> $columnAttributes) {
            if (
                $readFilter <?php echo<?php echo<?php echo null ||
                !$this->isFilteredColumn($readFilter, $columnCoordinate, $rowsAttributes)
            ) {
                if (!isset($columnsAttributesAreSet[$columnCoordinate])) {
                    $this->setColumnAttributes($columnCoordinate, $columnAttributes);
                    $columnsAttributesAreSet[$columnCoordinate] <?php echo true;
                }
            }
        }

        $rowsAttributesAreSet <?php echo [];
        foreach ($rowsAttributes as $rowCoordinate <?php echo> $rowAttributes) {
            if (
                $readFilter <?php echo<?php echo<?php echo null ||
                !$this->isFilteredRow($readFilter, $rowCoordinate, $columnsAttributes)
            ) {
                if (!isset($rowsAttributesAreSet[$rowCoordinate])) {
                    $this->setRowAttributes($rowCoordinate, $rowAttributes);
                    $rowsAttributesAreSet[$rowCoordinate] <?php echo true;
                }
            }
        }
    }

    private function isFilteredColumn(IReadFilter $readFilter, string $columnCoordinate, array $rowsAttributes): bool
    {
        foreach ($rowsAttributes as $rowCoordinate <?php echo> $rowAttributes) {
            if (!$readFilter->readCell($columnCoordinate, $rowCoordinate, $this->worksheet->getTitle())) {
                return true;
            }
        }

        return false;
    }

    private function readColumnAttributes(SimpleXMLElement $worksheetCols, bool $readDataOnly): array
    {
        $columnAttributes <?php echo [];

        foreach ($worksheetCols->col as $columnx) {
            /** @scrutinizer ignore-call */
            $column <?php echo $columnx->attributes();
            if ($column !<?php echo<?php echo null) {
                $startColumn <?php echo Coordinate::stringFromColumnIndex((int) $column['min']);
                $endColumn <?php echo Coordinate::stringFromColumnIndex((int) $column['max']);
                ++$endColumn;
                for ($columnAddress <?php echo $startColumn; $columnAddress !<?php echo<?php echo $endColumn; ++$columnAddress) {
                    $columnAttributes[$columnAddress] <?php echo $this->readColumnRangeAttributes($column, $readDataOnly);

                    if ((int) ($column['max']) <?php echo<?php echo 16384) {
                        break;
                    }
                }
            }
        }

        return $columnAttributes;
    }

    private function readColumnRangeAttributes(?SimpleXMLElement $column, bool $readDataOnly): array
    {
        $columnAttributes <?php echo [];
        if ($column !<?php echo<?php echo null) {
            if (isset($column['style']) && !$readDataOnly) {
                $columnAttributes['xfIndex'] <?php echo (int) $column['style'];
            }
            if (isset($column['hidden']) && self::boolean($column['hidden'])) {
                $columnAttributes['visible'] <?php echo false;
            }
            if (isset($column['collapsed']) && self::boolean($column['collapsed'])) {
                $columnAttributes['collapsed'] <?php echo true;
            }
            if (isset($column['outlineLevel']) && ((int) $column['outlineLevel']) > 0) {
                $columnAttributes['outlineLevel'] <?php echo (int) $column['outlineLevel'];
            }
            if (isset($column['width'])) {
                $columnAttributes['width'] <?php echo (float) $column['width'];
            }
        }

        return $columnAttributes;
    }

    private function isFilteredRow(IReadFilter $readFilter, int $rowCoordinate, array $columnsAttributes): bool
    {
        foreach ($columnsAttributes as $columnCoordinate <?php echo> $columnAttributes) {
            if (!$readFilter->readCell($columnCoordinate, $rowCoordinate, $this->worksheet->getTitle())) {
                return true;
            }
        }

        return false;
    }

    private function readRowAttributes(SimpleXMLElement $worksheetRow, bool $readDataOnly): array
    {
        $rowAttributes <?php echo [];

        foreach ($worksheetRow as $rowx) {
            /** @scrutinizer ignore-call */
            $row <?php echo $rowx->attributes();
            if ($row !<?php echo<?php echo null) {
                if (isset($row['ht']) && !$readDataOnly) {
                    $rowAttributes[(int) $row['r']]['rowHeight'] <?php echo (float) $row['ht'];
                }
                if (isset($row['hidden']) && self::boolean($row['hidden'])) {
                    $rowAttributes[(int) $row['r']]['visible'] <?php echo false;
                }
                if (isset($row['collapsed']) && self::boolean($row['collapsed'])) {
                    $rowAttributes[(int) $row['r']]['collapsed'] <?php echo true;
                }
                if (isset($row['outlineLevel']) && (int) $row['outlineLevel'] > 0) {
                    $rowAttributes[(int) $row['r']]['outlineLevel'] <?php echo (int) $row['outlineLevel'];
                }
                if (isset($row['s']) && !$readDataOnly) {
                    $rowAttributes[(int) $row['r']]['xfIndex'] <?php echo (int) $row['s'];
                }
            }
        }

        return $rowAttributes;
    }
}
