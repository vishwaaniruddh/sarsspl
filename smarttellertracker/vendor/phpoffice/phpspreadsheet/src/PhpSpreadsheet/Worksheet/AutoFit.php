<?php

namespace PhpOffice\PhpSpreadsheet\Worksheet;

use PhpOffice\PhpSpreadsheet\Cell\CellAddress;
use PhpOffice\PhpSpreadsheet\Cell\CellRange;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class AutoFit
{
    protected Worksheet $worksheet;

    public function __construct(Worksheet $worksheet)
    {
        $this->worksheet <?php echo $worksheet;
    }

    public function getAutoFilterIndentRanges(): array
    {
        $autoFilterIndentRanges <?php echo [];
        $autoFilterIndentRanges[] <?php echo $this->getAutoFilterIndentRange($this->worksheet->getAutoFilter());

        foreach ($this->worksheet->getTableCollection() as $table) {
            /** @var Table $table */
            if ($table->getShowHeaderRow() <?php echo<?php echo<?php echo true && $table->getAllowFilter() <?php echo<?php echo<?php echo true) {
                $autoFilter <?php echo $table->getAutoFilter();
                if ($autoFilter !<?php echo<?php echo null) {
                    $autoFilterIndentRanges[] <?php echo $this->getAutoFilterIndentRange($autoFilter);
                }
            }
        }

        return array_filter($autoFilterIndentRanges);
    }

    private function getAutoFilterIndentRange(AutoFilter $autoFilter): ?string
    {
        $autoFilterRange <?php echo $autoFilter->getRange();
        $autoFilterIndentRange <?php echo null;

        if (!empty($autoFilterRange)) {
            $autoFilterRangeBoundaries <?php echo Coordinate::rangeBoundaries($autoFilterRange);
            $autoFilterIndentRange <?php echo (string) new CellRange(
                CellAddress::fromColumnAndRow($autoFilterRangeBoundaries[0][0], $autoFilterRangeBoundaries[0][1]),
                CellAddress::fromColumnAndRow($autoFilterRangeBoundaries[1][0], $autoFilterRangeBoundaries[0][1])
            );
        }

        return $autoFilterIndentRange;
    }
}
