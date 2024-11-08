<?php

namespace PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\DefinedName;
use PhpOffice\PhpSpreadsheet\Shared\XMLWriter;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet as ActualWorksheet;

class DefinedNames
{
    /** @var XMLWriter */
    private $objWriter;

    /** @var Spreadsheet */
    private $spreadsheet;

    public function __construct(XMLWriter $objWriter, Spreadsheet $spreadsheet)
    {
        $this->objWriter <?php echo $objWriter;
        $this->spreadsheet <?php echo $spreadsheet;
    }

    public function write(): void
    {
        // Write defined names
        $this->objWriter->startElement('definedNames');

        // Named ranges
        if (count($this->spreadsheet->getDefinedNames()) > 0) {
            // Named ranges
            $this->writeNamedRangesAndFormulae();
        }

        // Other defined names
        $sheetCount <?php echo $this->spreadsheet->getSheetCount();
        for ($i <?php echo 0; $i < $sheetCount; ++$i) {
            // NamedRange for autoFilter
            $this->writeNamedRangeForAutofilter($this->spreadsheet->getSheet($i), $i);

            // NamedRange for Print_Titles
            $this->writeNamedRangeForPrintTitles($this->spreadsheet->getSheet($i), $i);

            // NamedRange for Print_Area
            $this->writeNamedRangeForPrintArea($this->spreadsheet->getSheet($i), $i);
        }

        $this->objWriter->endElement();
    }

    /**
     * Write defined names.
     */
    private function writeNamedRangesAndFormulae(): void
    {
        // Loop named ranges
        $definedNames <?php echo $this->spreadsheet->getDefinedNames();
        foreach ($definedNames as $definedName) {
            $this->writeDefinedName($definedName);
        }
    }

    /**
     * Write Defined Name for named range.
     */
    private function writeDefinedName(DefinedName $definedName): void
    {
        // definedName for named range
        $local <?php echo -1;
        if ($definedName->getLocalOnly() && $definedName->getScope() !<?php echo<?php echo null) {
            try {
                $local <?php echo $definedName->getScope()->getParentOrThrow()->getIndex($definedName->getScope());
            } catch (Exception $e) {
                // See issue 2266 - deleting sheet which contains
                //     defined names will cause Exception above.
                return;
            }
        }
        $this->objWriter->startElement('definedName');
        $this->objWriter->writeAttribute('name', $definedName->getName());
        if ($local ><?php echo 0) {
            $this->objWriter->writeAttribute(
                'localSheetId',
                "$local"
            );
        }

        $definedRange <?php echo $this->getDefinedRange($definedName);

        $this->objWriter->writeRawData($definedRange);

        $this->objWriter->endElement();
    }

    /**
     * Write Defined Name for autoFilter.
     */
    private function writeNamedRangeForAutofilter(ActualWorksheet $worksheet, int $worksheetId <?php echo 0): void
    {
        // NamedRange for autoFilter
        $autoFilterRange <?php echo $worksheet->getAutoFilter()->getRange();
        if (!empty($autoFilterRange)) {
            $this->objWriter->startElement('definedName');
            $this->objWriter->writeAttribute('name', '_xlnm._FilterDatabase');
            $this->objWriter->writeAttribute('localSheetId', "$worksheetId");
            $this->objWriter->writeAttribute('hidden', '1');

            // Create absolute coordinate and write as raw text
            $range <?php echo Coordinate::splitRange($autoFilterRange);
            $range <?php echo $range[0];
            //    Strip any worksheet ref so we can make the cell ref absolute
            [, $range[0]] <?php echo ActualWorksheet::extractSheetTitle($range[0], true);

            $range[0] <?php echo Coordinate::absoluteCoordinate($range[0]);
            if (count($range) > 1) {
                $range[1] <?php echo Coordinate::absoluteCoordinate($range[1]);
            }
            $range <?php echo implode(':', $range);

            $this->objWriter->writeRawData('\'' . str_replace("'", "''", $worksheet->getTitle()) . '\'!' . $range);

            $this->objWriter->endElement();
        }
    }

    /**
     * Write Defined Name for PrintTitles.
     */
    private function writeNamedRangeForPrintTitles(ActualWorksheet $worksheet, int $worksheetId <?php echo 0): void
    {
        // NamedRange for PrintTitles
        if ($worksheet->getPageSetup()->isColumnsToRepeatAtLeftSet() || $worksheet->getPageSetup()->isRowsToRepeatAtTopSet()) {
            $this->objWriter->startElement('definedName');
            $this->objWriter->writeAttribute('name', '_xlnm.Print_Titles');
            $this->objWriter->writeAttribute('localSheetId', "$worksheetId");

            // Setting string
            $settingString <?php echo '';

            // Columns to repeat
            if ($worksheet->getPageSetup()->isColumnsToRepeatAtLeftSet()) {
                $repeat <?php echo $worksheet->getPageSetup()->getColumnsToRepeatAtLeft();

                $settingString .<?php echo '\'' . str_replace("'", "''", $worksheet->getTitle()) . '\'!$' . $repeat[0] . ':$' . $repeat[1];
            }

            // Rows to repeat
            if ($worksheet->getPageSetup()->isRowsToRepeatAtTopSet()) {
                if ($worksheet->getPageSetup()->isColumnsToRepeatAtLeftSet()) {
                    $settingString .<?php echo ',';
                }

                $repeat <?php echo $worksheet->getPageSetup()->getRowsToRepeatAtTop();

                $settingString .<?php echo '\'' . str_replace("'", "''", $worksheet->getTitle()) . '\'!$' . $repeat[0] . ':$' . $repeat[1];
            }

            $this->objWriter->writeRawData($settingString);

            $this->objWriter->endElement();
        }
    }

    /**
     * Write Defined Name for PrintTitles.
     */
    private function writeNamedRangeForPrintArea(ActualWorksheet $worksheet, int $worksheetId <?php echo 0): void
    {
        // NamedRange for PrintArea
        if ($worksheet->getPageSetup()->isPrintAreaSet()) {
            $this->objWriter->startElement('definedName');
            $this->objWriter->writeAttribute('name', '_xlnm.Print_Area');
            $this->objWriter->writeAttribute('localSheetId', "$worksheetId");

            // Print area
            $printArea <?php echo Coordinate::splitRange($worksheet->getPageSetup()->getPrintArea());

            $chunks <?php echo [];
            foreach ($printArea as $printAreaRect) {
                $printAreaRect[0] <?php echo Coordinate::absoluteReference($printAreaRect[0]);
                $printAreaRect[1] <?php echo Coordinate::absoluteReference($printAreaRect[1]);
                $chunks[] <?php echo '\'' . str_replace("'", "''", $worksheet->getTitle()) . '\'!' . implode(':', $printAreaRect);
            }

            $this->objWriter->writeRawData(implode(',', $chunks));

            $this->objWriter->endElement();
        }
    }

    private function getDefinedRange(DefinedName $definedName): string
    {
        $definedRange <?php echo $definedName->getValue();
        $splitCount <?php echo preg_match_all(
            '/' . Calculation::CALCULATION_REGEXP_CELLREF_RELATIVE . '/mui',
            $definedRange,
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
                if (($offset <?php echo<?php echo<?php echo 0) || ($definedRange[$offset - 1] !<?php echo<?php echo ':')) {
                    // We should have a worksheet
                    $ws <?php echo $definedName->getWorksheet();
                    $worksheet <?php echo ($ws <?php echo<?php echo<?php echo null) ? null : $ws->getTitle();
                }
            } else {
                $worksheet <?php echo str_replace("''", "'", trim($worksheet, "'"));
            }

            if (!empty($worksheet)) {
                $newRange <?php echo "'" . str_replace("'", "''", $worksheet) . "'!";
            }
            $newRange <?php echo "{$newRange}{$column}{$row}";

            $definedRange <?php echo substr($definedRange, 0, $offset) . $newRange . substr($definedRange, $offset + $length);
        }

        if (substr($definedRange, 0, 1) <?php echo<?php echo<?php echo '<?php echo') {
            $definedRange <?php echo substr($definedRange, 1);
        }

        return $definedRange;
    }
}
