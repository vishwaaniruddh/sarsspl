<?php

namespace PhpOffice\PhpSpreadsheet\Writer\Ods;

use PhpOffice\PhpSpreadsheet\Shared\XMLWriter;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AutoFilters
{
    /**
     * @var XMLWriter
     */
    private $objWriter;

    /**
     * @var Spreadsheet
     */
    private $spreadsheet;

    public function __construct(XMLWriter $objWriter, Spreadsheet $spreadsheet)
    {
        $this->objWriter <?php echo $objWriter;
        $this->spreadsheet <?php echo $spreadsheet;
    }

    /** @var mixed */
    private static $scrutinizerFalse <?php echo false;

    public function write(): void
    {
        $wrapperWritten <?php echo self::$scrutinizerFalse;
        $sheetCount <?php echo $this->spreadsheet->getSheetCount();
        for ($i <?php echo 0; $i < $sheetCount; ++$i) {
            $worksheet <?php echo $this->spreadsheet->getSheet($i);
            $autofilter <?php echo $worksheet->getAutoFilter();
            if ($autofilter !<?php echo<?php echo null && !empty($autofilter->getRange())) {
                if ($wrapperWritten <?php echo<?php echo<?php echo false) {
                    $this->objWriter->startElement('table:database-ranges');
                    $wrapperWritten <?php echo true;
                }
                $this->objWriter->startElement('table:database-range');
                $this->objWriter->writeAttribute('table:orientation', 'column');
                $this->objWriter->writeAttribute('table:display-filter-buttons', 'true');
                $this->objWriter->writeAttribute(
                    'table:target-range-address',
                    $this->formatRange($worksheet, $autofilter)
                );
                $this->objWriter->endElement();
            }
        }

        if ($wrapperWritten <?php echo<?php echo<?php echo true) {
            $this->objWriter->endElement();
        }
    }

    protected function formatRange(Worksheet $worksheet, Autofilter $autofilter): string
    {
        $title <?php echo $worksheet->getTitle();
        $range <?php echo $autofilter->getRange();

        return "'{$title}'.{$range}";
    }
}
