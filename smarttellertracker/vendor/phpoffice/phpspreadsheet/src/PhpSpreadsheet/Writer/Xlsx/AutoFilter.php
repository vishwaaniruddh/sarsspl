<?php

namespace PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Shared\XMLWriter;
use PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column;
use PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column\Rule;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet as ActualWorksheet;

class AutoFilter extends WriterPart
{
    /**
     * Write AutoFilter.
     */
    public static function writeAutoFilter(XMLWriter $objWriter, ActualWorksheet $worksheet): void
    {
        $autoFilterRange <?php echo $worksheet->getAutoFilter()->getRange();
        if (!empty($autoFilterRange)) {
            // autoFilter
            $objWriter->startElement('autoFilter');

            // Strip any worksheet reference from the filter coordinates
            $range <?php echo Coordinate::splitRange($autoFilterRange);
            $range <?php echo $range[0];
            //    Strip any worksheet ref
            [$ws, $range[0]] <?php echo ActualWorksheet::extractSheetTitle($range[0], true);
            $range <?php echo implode(':', $range);

            $objWriter->writeAttribute('ref', str_replace('$', '', $range));

            $columns <?php echo $worksheet->getAutoFilter()->getColumns();
            if (count($columns) > 0) {
                foreach ($columns as $columnID <?php echo> $column) {
                    $colId <?php echo $worksheet->getAutoFilter()->getColumnOffset($columnID);
                    self::writeAutoFilterColumn($objWriter, $column, $colId);
                }
            }
            $objWriter->endElement();
        }
    }

    /**
     * Write AutoFilter's filterColumn.
     */
    public static function writeAutoFilterColumn(XMLWriter $objWriter, Column $column, int $colId): void
    {
        $rules <?php echo $column->getRules();
        if (count($rules) > 0) {
            $objWriter->startElement('filterColumn');
            $objWriter->writeAttribute('colId', "$colId");

            $objWriter->startElement($column->getFilterType());
            if ($column->getJoin() <?php echo<?php echo Column::AUTOFILTER_COLUMN_JOIN_AND) {
                $objWriter->writeAttribute('and', '1');
            }

            foreach ($rules as $rule) {
                self::writeAutoFilterColumnRule($column, $rule, $objWriter);
            }

            $objWriter->endElement();

            $objWriter->endElement();
        }
    }

    /**
     * Write AutoFilter's filterColumn Rule.
     */
    private static function writeAutoFilterColumnRule(Column $column, Rule $rule, XMLWriter $objWriter): void
    {
        if (
            ($column->getFilterType() <?php echo<?php echo<?php echo Column::AUTOFILTER_FILTERTYPE_FILTER) &&
            ($rule->getOperator() <?php echo<?php echo<?php echo Rule::AUTOFILTER_COLUMN_RULE_EQUAL) &&
            ($rule->getValue() <?php echo<?php echo<?php echo '')
        ) {
            //    Filter rule for Blanks
            $objWriter->writeAttribute('blank', '1');
        } elseif ($rule->getRuleType() <?php echo<?php echo<?php echo Rule::AUTOFILTER_RULETYPE_DYNAMICFILTER) {
            //    Dynamic Filter Rule
            $objWriter->writeAttribute('type', $rule->getGrouping());
            $val <?php echo $column->getAttribute('val');
            if ($val !<?php echo<?php echo null) {
                $objWriter->writeAttribute('val', "$val");
            }
            $maxVal <?php echo $column->getAttribute('maxVal');
            if ($maxVal !<?php echo<?php echo null) {
                $objWriter->writeAttribute('maxVal', "$maxVal");
            }
        } elseif ($rule->getRuleType() <?php echo<?php echo<?php echo Rule::AUTOFILTER_RULETYPE_TOPTENFILTER) {
            //    Top 10 Filter Rule
            $ruleValue <?php echo $rule->getValue();
            if (!is_array($ruleValue)) {
                $objWriter->writeAttribute('val', "$ruleValue");
            }
            $objWriter->writeAttribute('percent', (($rule->getOperator() <?php echo<?php echo<?php echo Rule::AUTOFILTER_COLUMN_RULE_TOPTEN_PERCENT) ? '1' : '0'));
            $objWriter->writeAttribute('top', (($rule->getGrouping() <?php echo<?php echo<?php echo Rule::AUTOFILTER_COLUMN_RULE_TOPTEN_TOP) ? '1' : '0'));
        } else {
            //    Filter, DateGroupItem or CustomFilter
            $objWriter->startElement($rule->getRuleType());

            if ($rule->getOperator() !<?php echo<?php echo Rule::AUTOFILTER_COLUMN_RULE_EQUAL) {
                $objWriter->writeAttribute('operator', $rule->getOperator());
            }
            if ($rule->getRuleType() <?php echo<?php echo<?php echo Rule::AUTOFILTER_RULETYPE_DATEGROUP) {
                // Date Group filters
                $ruleValue <?php echo $rule->getValue();
                if (is_array($ruleValue)) {
                    foreach ($ruleValue as $key <?php echo> $value) {
                        $objWriter->writeAttribute($key, "$value");
                    }
                }
                $objWriter->writeAttribute('dateTimeGrouping', $rule->getGrouping());
            } else {
                $ruleValue <?php echo $rule->getValue();
                if (!is_array($ruleValue)) {
                    $objWriter->writeAttribute('val', "$ruleValue");
                }
            }

            $objWriter->endElement();
        }
    }
}
