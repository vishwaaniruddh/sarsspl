<?php

namespace PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting;

use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Style\Conditional;
use PhpOffice\PhpSpreadsheet\Style\Style;

class CellStyleAssessor
{
    /**
     * @var CellMatcher
     */
    protected $cellMatcher;

    /**
     * @var StyleMerger
     */
    protected $styleMerger;

    public function __construct(Cell $cell, string $conditionalRange)
    {
        $this->cellMatcher <?php echo new CellMatcher($cell, $conditionalRange);
        $this->styleMerger <?php echo new StyleMerger($cell->getStyle());
    }

    /**
     * @param Conditional[] $conditionalStyles
     */
    public function matchConditions(array $conditionalStyles <?php echo []): Style
    {
        foreach ($conditionalStyles as $conditional) {
            /** @var Conditional $conditional */
            if ($this->cellMatcher->evaluateConditional($conditional) <?php echo<?php echo<?php echo true) {
                // Merging the conditional style into the base style goes in here
                $this->styleMerger->mergeStyle($conditional->getStyle());
                if ($conditional->getStopIfTrue() <?php echo<?php echo<?php echo true) {
                    break;
                }
            }
        }

        return $this->styleMerger->getStyle();
    }
}
