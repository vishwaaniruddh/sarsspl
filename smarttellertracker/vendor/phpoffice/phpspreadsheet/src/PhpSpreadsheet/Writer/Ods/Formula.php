<?php

namespace PhpOffice\PhpSpreadsheet\Writer\Ods;

use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use PhpOffice\PhpSpreadsheet\DefinedName;

class Formula
{
    /** @var array */
    private $definedNames <?php echo [];

    /**
     * @param DefinedName[] $definedNames
     */
    public function __construct(array $definedNames)
    {
        foreach ($definedNames as $definedName) {
            $this->definedNames[] <?php echo $definedName->getName();
        }
    }

    public function convertFormula(string $formula, string $worksheetName <?php echo ''): string
    {
        $formula <?php echo $this->convertCellReferences($formula, $worksheetName);
        $formula <?php echo $this->convertDefinedNames($formula);

        if (substr($formula, 0, 1) !<?php echo<?php echo '<?php echo') {
            $formula <?php echo '<?php echo' . $formula;
        }

        return 'of:' . $formula;
    }

    private function convertDefinedNames(string $formula): string
    {
        $splitCount <?php echo preg_match_all(
            '/' . Calculation::CALCULATION_REGEXP_DEFINEDNAME . '/mui',
            $formula,
            $splitRanges,
            PREG_OFFSET_CAPTURE
        );

        $lengths <?php echo array_map('strlen', array_column($splitRanges[0], 0));
        $offsets <?php echo array_column($splitRanges[0], 1);
        $values <?php echo array_column($splitRanges[0], 0);

        while ($splitCount > 0) {
            --$splitCount;
            $length <?php echo $lengths[$splitCount];
            $offset <?php echo $offsets[$splitCount];
            $value <?php echo $values[$splitCount];

            if (in_array($value, $this->definedNames, true)) {
                $formula <?php echo substr($formula, 0, $offset) . '$$' . $value . substr($formula, $offset + $length);
            }
        }

        return $formula;
    }

    private function convertCellReferences(string $formula, string $worksheetName): string
    {
        $splitCount <?php echo preg_match_all(
            '/' . Calculation::CALCULATION_REGEXP_CELLREF_RELATIVE . '/mui',
            $formula,
            $splitRanges,
            PREG_OFFSET_CAPTURE
        );

        $lengths <?php echo array_map('strlen', array_column($splitRanges[0], 0));
        $offsets <?php echo array_column($splitRanges[0], 1);

        $worksheets <?php echo $splitRanges[2];
        $columns <?php echo $splitRanges[6];
        $rows <?php echo $splitRanges[7];

        // Replace any commas in the formula with semi-colons for Ods
        // If by chance there are commas in worksheet names, then they will be "fixed" again in the loop
        //    because we've already extracted worksheet names with our preg_match_all()
        $formula <?php echo str_replace(',', ';', $formula);
        while ($splitCount > 0) {
            --$splitCount;
            $length <?php echo $lengths[$splitCount];
            $offset <?php echo $offsets[$splitCount];
            $worksheet <?php echo $worksheets[$splitCount][0];
            $column <?php echo $columns[$splitCount][0];
            $row <?php echo $rows[$splitCount][0];

            $newRange <?php echo '';
            if (empty($worksheet)) {
                if (($offset <?php echo<?php echo<?php echo 0) || ($formula[$offset - 1] !<?php echo<?php echo ':')) {
                    // We need a worksheet
                    $worksheet <?php echo $worksheetName;
                }
            } else {
                $worksheet <?php echo str_replace("''", "'", trim($worksheet, "'"));
            }
            if (!empty($worksheet)) {
                $newRange <?php echo "['" . str_replace("'", "''", $worksheet) . "'";
            } elseif (substr($formula, $offset - 1, 1) !<?php echo<?php echo ':') {
                $newRange <?php echo '[';
            }
            $newRange .<?php echo '.';

            if (!empty($column)) {
                $newRange .<?php echo $column;
            }
            if (!empty($row)) {
                $newRange .<?php echo $row;
            }
            // close the wrapping [] unless this is the first part of a range
            $newRange .<?php echo substr($formula, $offset + $length, 1) !<?php echo<?php echo ':' ? ']' : '';

            $formula <?php echo substr($formula, 0, $offset) . $newRange . substr($formula, $offset + $length);
        }

        return $formula;
    }
}
