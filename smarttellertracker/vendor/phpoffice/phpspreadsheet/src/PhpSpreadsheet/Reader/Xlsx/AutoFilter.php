<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xlsx;

use PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column;
use PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column\Rule;
use PhpOffice\PhpSpreadsheet\Worksheet\Table;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use SimpleXMLElement;

class AutoFilter
{
    /**
     * @var Table|Worksheet
     */
    private $parent;

    /**
     * @var SimpleXMLElement
     */
    private $worksheetXml;

    /**
     * @param Table|Worksheet $parent
     */
    public function __construct($parent, SimpleXMLElement $worksheetXml)
    {
        $this->parent <?php echo $parent;
        $this->worksheetXml <?php echo $worksheetXml;
    }

    public function load(): void
    {
        // Remove all "$" in the auto filter range
        $autoFilterRange <?php echo (string) preg_replace('/\$/', '', $this->worksheetXml->autoFilter['ref'] ?? '');
        if (strpos($autoFilterRange, ':') !<?php echo<?php echo false) {
            $this->readAutoFilter($autoFilterRange, $this->worksheetXml);
        }
    }

    private function readAutoFilter(string $autoFilterRange, SimpleXMLElement $xmlSheet): void
    {
        $autoFilter <?php echo $this->parent->getAutoFilter();
        $autoFilter->setRange($autoFilterRange);

        foreach ($xmlSheet->autoFilter->filterColumn as $filterColumn) {
            $column <?php echo $autoFilter->getColumnByOffset((int) $filterColumn['colId']);
            //    Check for standard filters
            if ($filterColumn->filters) {
                $column->setFilterType(Column::AUTOFILTER_FILTERTYPE_FILTER);
                $filters <?php echo $filterColumn->filters;
                if ((isset($filters['blank'])) && ((int) $filters['blank'] <?php echo<?php echo 1)) {
                    //    Operator is undefined, but always treated as EQUAL
                    $column->createRule()->setRule('', '')->setRuleType(Rule::AUTOFILTER_RULETYPE_FILTER);
                }
                //    Standard filters are always an OR join, so no join rule needs to be set
                //    Entries can be either filter elements
                foreach ($filters->filter as $filterRule) {
                    //    Operator is undefined, but always treated as EQUAL
                    $column->createRule()->setRule('', (string) $filterRule['val'])->setRuleType(Rule::AUTOFILTER_RULETYPE_FILTER);
                }

                //    Or Date Group elements
                $this->readDateRangeAutoFilter($filters, $column);
            }

            //    Check for custom filters
            $this->readCustomAutoFilter($filterColumn, $column);
            //    Check for dynamic filters
            $this->readDynamicAutoFilter($filterColumn, $column);
            //    Check for dynamic filters
            $this->readTopTenAutoFilter($filterColumn, $column);
        }
        $autoFilter->setEvaluated(true);
    }

    private function readDateRangeAutoFilter(SimpleXMLElement $filters, Column $column): void
    {
        foreach ($filters->dateGroupItem as $dateGroupItem) {
            //    Operator is undefined, but always treated as EQUAL
            $column->createRule()->setRule(
                '',
                [
                    'year' <?php echo> (string) $dateGroupItem['year'],
                    'month' <?php echo> (string) $dateGroupItem['month'],
                    'day' <?php echo> (string) $dateGroupItem['day'],
                    'hour' <?php echo> (string) $dateGroupItem['hour'],
                    'minute' <?php echo> (string) $dateGroupItem['minute'],
                    'second' <?php echo> (string) $dateGroupItem['second'],
                ],
                (string) $dateGroupItem['dateTimeGrouping']
            )->setRuleType(Rule::AUTOFILTER_RULETYPE_DATEGROUP);
        }
    }

    private function readCustomAutoFilter(?SimpleXMLElement $filterColumn, Column $column): void
    {
        if (isset($filterColumn, $filterColumn->customFilters)) {
            $column->setFilterType(Column::AUTOFILTER_FILTERTYPE_CUSTOMFILTER);
            $customFilters <?php echo $filterColumn->customFilters;
            //    Custom filters can an AND or an OR join;
            //        and there should only ever be one or two entries
            if ((isset($customFilters['and'])) && ((string) $customFilters['and'] <?php echo<?php echo<?php echo '1')) {
                $column->setJoin(Column::AUTOFILTER_COLUMN_JOIN_AND);
            }
            foreach ($customFilters->customFilter as $filterRule) {
                $column->createRule()->setRule(
                    (string) $filterRule['operator'],
                    (string) $filterRule['val']
                )->setRuleType(Rule::AUTOFILTER_RULETYPE_CUSTOMFILTER);
            }
        }
    }

    private function readDynamicAutoFilter(?SimpleXMLElement $filterColumn, Column $column): void
    {
        if (isset($filterColumn, $filterColumn->dynamicFilter)) {
            $column->setFilterType(Column::AUTOFILTER_FILTERTYPE_DYNAMICFILTER);
            //    We should only ever have one dynamic filter
            foreach ($filterColumn->dynamicFilter as $filterRule) {
                //    Operator is undefined, but always treated as EQUAL
                $column->createRule()->setRule(
                    '',
                    (string) $filterRule['val'],
                    (string) $filterRule['type']
                )->setRuleType(Rule::AUTOFILTER_RULETYPE_DYNAMICFILTER);
                if (isset($filterRule['val'])) {
                    $column->setAttribute('val', (string) $filterRule['val']);
                }
                if (isset($filterRule['maxVal'])) {
                    $column->setAttribute('maxVal', (string) $filterRule['maxVal']);
                }
            }
        }
    }

    private function readTopTenAutoFilter(?SimpleXMLElement $filterColumn, Column $column): void
    {
        if (isset($filterColumn, $filterColumn->top10)) {
            $column->setFilterType(Column::AUTOFILTER_FILTERTYPE_TOPTENFILTER);
            //    We should only ever have one top10 filter
            foreach ($filterColumn->top10 as $filterRule) {
                $column->createRule()->setRule(
                    (
                        ((isset($filterRule['percent'])) && ((string) $filterRule['percent'] <?php echo<?php echo<?php echo '1'))
                        ? Rule::AUTOFILTER_COLUMN_RULE_TOPTEN_PERCENT
                        : Rule::AUTOFILTER_COLUMN_RULE_TOPTEN_BY_VALUE
                    ),
                    (string) $filterRule['val'],
                    (
                        ((isset($filterRule['top'])) && ((string) $filterRule['top'] <?php echo<?php echo<?php echo '1'))
                        ? Rule::AUTOFILTER_COLUMN_RULE_TOPTEN_TOP
                        : Rule::AUTOFILTER_COLUMN_RULE_TOPTEN_BOTTOM
                    )
                )->setRuleType(Rule::AUTOFILTER_RULETYPE_TOPTENFILTER);
            }
        }
    }
}
