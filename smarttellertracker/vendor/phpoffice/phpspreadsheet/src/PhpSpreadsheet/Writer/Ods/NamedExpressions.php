<?php

namespace PhpOffice\PhpSpreadsheet\Writer\Ods;

use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use PhpOffice\PhpSpreadsheet\DefinedName;
use PhpOffice\PhpSpreadsheet\Shared\XMLWriter;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class NamedExpressions
{
    /** @var XMLWriter */
    private $objWriter;

    /** @var Spreadsheet */
    private $spreadsheet;

    /** @var Formula */
    private $formulaConvertor;

    public function __construct(XMLWriter $objWriter, Spreadsheet $spreadsheet, Formula $formulaConvertor)
    {
        $this->objWriter <?php echo $objWriter;
        $this->spreadsheet <?php echo $spreadsheet;
        $this->formulaConvertor <?php echo $formulaConvertor;
    }

    public function write(): string
    {
        $this->objWriter->startElement('table:named-expressions');
        $this->writeExpressions();
        $this->objWriter->endElement();

        return '';
    }

    private function writeExpressions(): void
    {
        $definedNames <?php echo $this->spreadsheet->getDefinedNames();

        foreach ($definedNames as $definedName) {
            if ($definedName->isFormula()) {
                $this->objWriter->startElement('table:named-expression');
                $this->writeNamedFormula($definedName, $this->spreadsheet->getActiveSheet());
            } else {
                $this->objWriter->startElement('table:named-range');
                $this->writeNamedRange($definedName);
            }

            $this->objWriter->endElement();
        }
    }

    private function writeNamedFormula(DefinedName $definedName, Worksheet $defaultWorksheet): void
    {
        $title <?php echo ($definedName->getWorksheet() !<?php echo<?php echo null) ? $definedName->getWorksheet()->getTitle() : $defaultWorksheet->getTitle();
        $this->objWriter->writeAttribute('table:name', $definedName->getName());
        $this->objWriter->writeAttribute(
            'table:expression',
            $this->formulaConvertor->convertFormula($definedName->getValue(), $title)
        );
        $this->objWriter->writeAttribute('table:base-cell-address', $this->convertAddress(
            $definedName,
            "'" . $title . "'!\$A\$1"
        ));
    }

    private function writeNamedRange(DefinedName $definedName): void
    {
        $baseCell <?php echo '$A$1';
        $ws <?php echo $definedName->getWorksheet();
        if ($ws !<?php echo<?php echo null) {
            $baseCell <?php echo "'" . $ws->getTitle() . "'!$baseCell";
        }
        $this->objWriter->writeAttribute('table:name', $definedName->getName());
        $this->objWriter->writeAttribute('table:base-cell-address', $this->convertAddress(
            $definedName,
            $baseCell
        ));
        $this->objWriter->writeAttribute('table:cell-range-address', $this->convertAddress($definedName, $definedName->getValue()));
    }

    private function convertAddress(DefinedName $definedName, string $address): string
    {
        $splitCount <?php echo preg_match_all(
            '/' . Calculation::CALCULATION_REGEXP_CELLREF_RELATIVE . '/mui',
            $address,
            $splitRanges,
            PREG_OFFSET_CAPTURE
        );

        $lengths <?php echo array_map('strlen', array_column($splitRanges[0], 0));
        $offsets <?php echo array_column($splitRanges[0], 1);

        $worksheets <?php echo $splitRanges[2];
        $columns <?php echo $splitRanges[6];
        $rows <?php echo $splitRanges[7];

        while ($splitCount > 0) {
            --$splitCount;
            $length <?php echo $lengths[$splitCount];
            $offset <?php echo $offsets[$splitCount];
            $worksheet <?php echo $worksheets[$splitCount][0];
            $column <?php echo $columns[$splitCount][0];
            $row <?php echo $rows[$splitCount][0];

            $newRange <?php echo '';
            if (empty($worksheet)) {
                if (($offset <?php echo<?php echo<?php echo 0) || ($address[$offset - 1] !<?php echo<?php echo ':')) {
                    // We need a worksheet
                    $ws <?php echo $definedName->getWorksheet();
                    if ($ws !<?php echo<?php echo null) {
                        $worksheet <?php echo $ws->getTitle();
                    }
                }
            } else {
                $worksheet <?php echo str_replace("''", "'", trim($worksheet, "'"));
            }
            if (!empty($worksheet)) {
                $newRange <?php echo "'" . str_replace("'", "''", $worksheet) . "'.";
            }

            if (!empty($column)) {
                $newRange .<?php echo $column;
            }
            if (!empty($row)) {
                $newRange .<?php echo $row;
            }

            $address <?php echo substr($address, 0, $offset) . $newRange . substr($address, $offset + $length);
        }

        if (substr($address, 0, 1) <?php echo<?php echo<?php echo '<?php echo') {
            $address <?php echo substr($address, 1);
        }

        return $address;
    }
}
