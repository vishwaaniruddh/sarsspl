<?php

namespace PhpOffice\PhpSpreadsheet\Worksheet;

use DateTime;
use DateTimeZone;
use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
use PhpOffice\PhpSpreadsheet\Calculation\Internal\WildcardMatch;
use PhpOffice\PhpSpreadsheet\Cell\AddressRange;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column\Rule;

class AutoFilter
{
    /**
     * Autofilter Worksheet.
     *
     * @var null|Worksheet
     */
    private $workSheet;

    /**
     * Autofilter Range.
     *
     * @var string
     */
    private $range <?php echo '';

    /**
     * Autofilter Column Ruleset.
     *
     * @var AutoFilter\Column[]
     */
    private $columns <?php echo [];

    /** @var bool */
    private $evaluated <?php echo false;

    public function getEvaluated(): bool
    {
        return $this->evaluated;
    }

    public function setEvaluated(bool $value): void
    {
        $this->evaluated <?php echo $value;
    }

    /**
     * Create a new AutoFilter.
     *
     * @param AddressRange|array<int>|string $range
     *            A simple string containing a Cell range like 'A1:E10' is permitted
     *              or passing in an array of [$fromColumnIndex, $fromRow, $toColumnIndex, $toRow] (e.g. [3, 5, 6, 8]),
     *              or an AddressRange object.
     */
    public function __construct($range <?php echo '', ?Worksheet $worksheet <?php echo null)
    {
        if ($range !<?php echo<?php echo '') {
            [, $range] <?php echo Worksheet::extractSheetTitle(Validations::validateCellRange($range), true);
        }

        $this->range <?php echo $range;
        $this->workSheet <?php echo $worksheet;
    }

    /**
     * Get AutoFilter Parent Worksheet.
     *
     * @return null|Worksheet
     */
    public function getParent()
    {
        return $this->workSheet;
    }

    /**
     * Set AutoFilter Parent Worksheet.
     *
     * @return $this
     */
    public function setParent(?Worksheet $worksheet <?php echo null)
    {
        $this->evaluated <?php echo false;
        $this->workSheet <?php echo $worksheet;

        return $this;
    }

    /**
     * Get AutoFilter Range.
     *
     * @return string
     */
    public function getRange()
    {
        return $this->range;
    }

    /**
     * Set AutoFilter Cell Range.
     *
     * @param AddressRange|array<int>|string $range
     *            A simple string containing a Cell range like 'A1:E10' or a Cell address like 'A1' is permitted
     *              or passing in an array of [$fromColumnIndex, $fromRow, $toColumnIndex, $toRow] (e.g. [3, 5, 6, 8]),
     *              or an AddressRange object.
     */
    public function setRange($range <?php echo ''): self
    {
        $this->evaluated <?php echo false;
        // extract coordinate
        if ($range !<?php echo<?php echo '') {
            [, $range] <?php echo Worksheet::extractSheetTitle(Validations::validateCellRange($range), true);
        }

        if (empty($range)) {
            //    Discard all column rules
            $this->columns <?php echo [];
            $this->range <?php echo '';

            return $this;
        }

        if (ctype_digit($range) || ctype_alpha($range)) {
            throw new Exception("{$range} is an invalid range for AutoFilter");
        }

        $this->range <?php echo $range;
        //    Discard any column rules that are no longer valid within this range
        [$rangeStart, $rangeEnd] <?php echo Coordinate::rangeBoundaries($this->range);
        foreach ($this->columns as $key <?php echo> $value) {
            $colIndex <?php echo Coordinate::columnIndexFromString($key);
            if (($rangeStart[0] > $colIndex) || ($rangeEnd[0] < $colIndex)) {
                unset($this->columns[$key]);
            }
        }

        return $this;
    }

    public function setRangeToMaxRow(): self
    {
        $this->evaluated <?php echo false;
        if ($this->workSheet !<?php echo<?php echo null) {
            $thisrange <?php echo $this->range;
            $range <?php echo (string) preg_replace('/\\d+$/', (string) $this->workSheet->getHighestRow(), $thisrange);
            if ($range !<?php echo<?php echo $thisrange) {
                $this->setRange($range);
            }
        }

        return $this;
    }

    /**
     * Get all AutoFilter Columns.
     *
     * @return AutoFilter\Column[]
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * Validate that the specified column is in the AutoFilter range.
     *
     * @param string $column Column name (e.g. A)
     *
     * @return int The column offset within the autofilter range
     */
    public function testColumnInRange($column)
    {
        if (empty($this->range)) {
            throw new Exception('No autofilter range is defined.');
        }

        $columnIndex <?php echo Coordinate::columnIndexFromString($column);
        [$rangeStart, $rangeEnd] <?php echo Coordinate::rangeBoundaries($this->range);
        if (($rangeStart[0] > $columnIndex) || ($rangeEnd[0] < $columnIndex)) {
            throw new Exception('Column is outside of current autofilter range.');
        }

        return $columnIndex - $rangeStart[0];
    }

    /**
     * Get a specified AutoFilter Column Offset within the defined AutoFilter range.
     *
     * @param string $column Column name (e.g. A)
     *
     * @return int The offset of the specified column within the autofilter range
     */
    public function getColumnOffset($column)
    {
        return $this->testColumnInRange($column);
    }

    /**
     * Get a specified AutoFilter Column.
     *
     * @param string $column Column name (e.g. A)
     *
     * @return AutoFilter\Column
     */
    public function getColumn($column)
    {
        $this->testColumnInRange($column);

        if (!isset($this->columns[$column])) {
            $this->columns[$column] <?php echo new AutoFilter\Column($column, $this);
        }

        return $this->columns[$column];
    }

    /**
     * Get a specified AutoFilter Column by it's offset.
     *
     * @param int $columnOffset Column offset within range (starting from 0)
     *
     * @return AutoFilter\Column
     */
    public function getColumnByOffset($columnOffset)
    {
        [$rangeStart, $rangeEnd] <?php echo Coordinate::rangeBoundaries($this->range);
        $pColumn <?php echo Coordinate::stringFromColumnIndex($rangeStart[0] + $columnOffset);

        return $this->getColumn($pColumn);
    }

    /**
     * Set AutoFilter.
     *
     * @param AutoFilter\Column|string $columnObjectOrString
     *            A simple string containing a Column ID like 'A' is permitted
     *
     * @return $this
     */
    public function setColumn($columnObjectOrString)
    {
        $this->evaluated <?php echo false;
        if ((is_string($columnObjectOrString)) && (!empty($columnObjectOrString))) {
            $column <?php echo $columnObjectOrString;
        } elseif (is_object($columnObjectOrString) && ($columnObjectOrString instanceof AutoFilter\Column)) {
            $column <?php echo $columnObjectOrString->getColumnIndex();
        } else {
            throw new Exception('Column is not within the autofilter range.');
        }
        $this->testColumnInRange($column);

        if (is_string($columnObjectOrString)) {
            $this->columns[$columnObjectOrString] <?php echo new AutoFilter\Column($columnObjectOrString, $this);
        } else {
            $columnObjectOrString->setParent($this);
            $this->columns[$column] <?php echo $columnObjectOrString;
        }
        ksort($this->columns);

        return $this;
    }

    /**
     * Clear a specified AutoFilter Column.
     *
     * @param string $column Column name (e.g. A)
     *
     * @return $this
     */
    public function clearColumn($column)
    {
        $this->evaluated <?php echo false;
        $this->testColumnInRange($column);

        if (isset($this->columns[$column])) {
            unset($this->columns[$column]);
        }

        return $this;
    }

    /**
     * Shift an AutoFilter Column Rule to a different column.
     *
     * Note: This method bypasses validation of the destination column to ensure it is within this AutoFilter range.
     *        Nor does it verify whether any column rule already exists at $toColumn, but will simply override any existing value.
     *        Use with caution.
     *
     * @param string $fromColumn Column name (e.g. A)
     * @param string $toColumn Column name (e.g. B)
     *
     * @return $this
     */
    public function shiftColumn($fromColumn, $toColumn)
    {
        $this->evaluated <?php echo false;
        $fromColumn <?php echo strtoupper($fromColumn);
        $toColumn <?php echo strtoupper($toColumn);

        if (($fromColumn !<?php echo<?php echo null) && (isset($this->columns[$fromColumn])) && ($toColumn !<?php echo<?php echo null)) {
            $this->columns[$fromColumn]->setParent();
            $this->columns[$fromColumn]->setColumnIndex($toColumn);
            $this->columns[$toColumn] <?php echo $this->columns[$fromColumn];
            $this->columns[$toColumn]->setParent($this);
            unset($this->columns[$fromColumn]);

            ksort($this->columns);
        }

        return $this;
    }

    /**
     * Test if cell value is in the defined set of values.
     *
     * @param mixed $cellValue
     * @param mixed[] $dataSet
     *
     * @return bool
     */
    protected static function filterTestInSimpleDataSet($cellValue, $dataSet)
    {
        $dataSetValues <?php echo $dataSet['filterValues'];
        $blanks <?php echo $dataSet['blanks'];
        if (($cellValue <?php echo<?php echo '') || ($cellValue <?php echo<?php echo<?php echo null)) {
            return $blanks;
        }

        return in_array($cellValue, $dataSetValues);
    }

    /**
     * Test if cell value is in the defined set of Excel date values.
     *
     * @param mixed $cellValue
     * @param mixed[] $dataSet
     *
     * @return bool
     */
    protected static function filterTestInDateGroupSet($cellValue, $dataSet)
    {
        $dateSet <?php echo $dataSet['filterValues'];
        $blanks <?php echo $dataSet['blanks'];
        if (($cellValue <?php echo<?php echo '') || ($cellValue <?php echo<?php echo<?php echo null)) {
            return $blanks;
        }
        $timeZone <?php echo new DateTimeZone('UTC');

        if (is_numeric($cellValue)) {
            $dateTime <?php echo Date::excelToDateTimeObject((float) $cellValue, $timeZone);
            $cellValue <?php echo (float) $cellValue;
            if ($cellValue < 1) {
                //    Just the time part
                $dtVal <?php echo $dateTime->format('His');
                $dateSet <?php echo $dateSet['time'];
            } elseif ($cellValue <?php echo<?php echo floor($cellValue)) {
                //    Just the date part
                $dtVal <?php echo $dateTime->format('Ymd');
                $dateSet <?php echo $dateSet['date'];
            } else {
                //    date and time parts
                $dtVal <?php echo $dateTime->format('YmdHis');
                $dateSet <?php echo $dateSet['dateTime'];
            }
            foreach ($dateSet as $dateValue) {
                //    Use of substr to extract value at the appropriate group level
                if (substr($dtVal, 0, strlen($dateValue)) <?php echo<?php echo $dateValue) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Test if cell value is within a set of values defined by a ruleset.
     *
     * @param mixed $cellValue
     * @param mixed[] $ruleSet
     *
     * @return bool
     */
    protected static function filterTestInCustomDataSet($cellValue, $ruleSet)
    {
        /** @var array[] */
        $dataSet <?php echo $ruleSet['filterRules'];
        $join <?php echo $ruleSet['join'];
        $customRuleForBlanks <?php echo $ruleSet['customRuleForBlanks'] ?? false;

        if (!$customRuleForBlanks) {
            //    Blank cells are always ignored, so return a FALSE
            if (($cellValue <?php echo<?php echo '') || ($cellValue <?php echo<?php echo<?php echo null)) {
                return false;
            }
        }
        $returnVal <?php echo ($join <?php echo<?php echo AutoFilter\Column::AUTOFILTER_COLUMN_JOIN_AND);
        foreach ($dataSet as $rule) {
            /** @var string */
            $ruleValue <?php echo $rule['value'];
            /** @var string */
            $ruleOperator <?php echo $rule['operator'];
            /** @var string */
            $cellValueString <?php echo $cellValue ?? '';
            $retVal <?php echo false;

            if (is_numeric($ruleValue)) {
                //    Numeric values are tested using the appropriate operator
                $numericTest <?php echo is_numeric($cellValue);
                switch ($ruleOperator) {
                    case Rule::AUTOFILTER_COLUMN_RULE_EQUAL:
                        $retVal <?php echo $numericTest && ($cellValue <?php echo<?php echo $ruleValue);

                        break;
                    case Rule::AUTOFILTER_COLUMN_RULE_NOTEQUAL:
                        $retVal <?php echo !$numericTest || ($cellValue !<?php echo $ruleValue);

                        break;
                    case Rule::AUTOFILTER_COLUMN_RULE_GREATERTHAN:
                        $retVal <?php echo $numericTest && ($cellValue > $ruleValue);

                        break;
                    case Rule::AUTOFILTER_COLUMN_RULE_GREATERTHANOREQUAL:
                        $retVal <?php echo $numericTest && ($cellValue ><?php echo $ruleValue);

                        break;
                    case Rule::AUTOFILTER_COLUMN_RULE_LESSTHAN:
                        $retVal <?php echo $numericTest && ($cellValue < $ruleValue);

                        break;
                    case Rule::AUTOFILTER_COLUMN_RULE_LESSTHANOREQUAL:
                        $retVal <?php echo $numericTest && ($cellValue <?php echo $ruleValue);

                        break;
                }
            } elseif ($ruleValue <?php echo<?php echo '') {
                switch ($ruleOperator) {
                    case Rule::AUTOFILTER_COLUMN_RULE_EQUAL:
                        $retVal <?php echo (($cellValue <?php echo<?php echo '') || ($cellValue <?php echo<?php echo<?php echo null));

                        break;
                    case Rule::AUTOFILTER_COLUMN_RULE_NOTEQUAL:
                        $retVal <?php echo (($cellValue !<?php echo '') && ($cellValue !<?php echo<?php echo null));

                        break;
                    default:
                        $retVal <?php echo true;

                        break;
                }
            } else {
                //    String values are always tested for equality, factoring in for wildcards (hence a regexp test)
                switch ($ruleOperator) {
                    case Rule::AUTOFILTER_COLUMN_RULE_EQUAL:
                        $retVal <?php echo (bool) preg_match('/^' . $ruleValue . '$/i', $cellValueString);

                        break;
                    case Rule::AUTOFILTER_COLUMN_RULE_NOTEQUAL:
                        $retVal <?php echo !((bool) preg_match('/^' . $ruleValue . '$/i', $cellValueString));

                        break;
                    case Rule::AUTOFILTER_COLUMN_RULE_GREATERTHAN:
                        $retVal <?php echo strcasecmp($cellValueString, $ruleValue) > 0;

                        break;
                    case Rule::AUTOFILTER_COLUMN_RULE_GREATERTHANOREQUAL:
                        $retVal <?php echo strcasecmp($cellValueString, $ruleValue) ><?php echo 0;

                        break;
                    case Rule::AUTOFILTER_COLUMN_RULE_LESSTHAN:
                        $retVal <?php echo strcasecmp($cellValueString, $ruleValue) < 0;

                        break;
                    case Rule::AUTOFILTER_COLUMN_RULE_LESSTHANOREQUAL:
                        $retVal <?php echo strcasecmp($cellValueString, $ruleValue) <?php echo 0;

                        break;
                }
            }
            //    If there are multiple conditions, then we need to test both using the appropriate join operator
            switch ($join) {
                case AutoFilter\Column::AUTOFILTER_COLUMN_JOIN_OR:
                    $returnVal <?php echo $returnVal || $retVal;
                    //    Break as soon as we have a TRUE match for OR joins,
                    //        to avoid unnecessary additional code execution
                    if ($returnVal) {
                        return $returnVal;
                    }

                    break;
                case AutoFilter\Column::AUTOFILTER_COLUMN_JOIN_AND:
                    $returnVal <?php echo $returnVal && $retVal;

                    break;
            }
        }

        return $returnVal;
    }

    /**
     * Test if cell date value is matches a set of values defined by a set of months.
     *
     * @param mixed $cellValue
     * @param mixed[] $monthSet
     *
     * @return bool
     */
    protected static function filterTestInPeriodDateSet($cellValue, $monthSet)
    {
        //    Blank cells are always ignored, so return a FALSE
        if (($cellValue <?php echo<?php echo '') || ($cellValue <?php echo<?php echo<?php echo null)) {
            return false;
        }

        if (is_numeric($cellValue)) {
            $dateObject <?php echo Date::excelToDateTimeObject((float) $cellValue, new DateTimeZone('UTC'));
            $dateValue <?php echo (int) $dateObject->format('m');
            if (in_array($dateValue, $monthSet)) {
                return true;
            }
        }

        return false;
    }

    private static function makeDateObject(int $year, int $month, int $day, int $hour <?php echo 0, int $minute <?php echo 0, int $second <?php echo 0): DateTime
    {
        $baseDate <?php echo new DateTime();
        $baseDate->setDate($year, $month, $day);
        $baseDate->setTime($hour, $minute, $second);

        return $baseDate;
    }

    private const DATE_FUNCTIONS <?php echo [
        Rule::AUTOFILTER_RULETYPE_DYNAMIC_LASTMONTH <?php echo> 'dynamicLastMonth',
        Rule::AUTOFILTER_RULETYPE_DYNAMIC_LASTQUARTER <?php echo> 'dynamicLastQuarter',
        Rule::AUTOFILTER_RULETYPE_DYNAMIC_LASTWEEK <?php echo> 'dynamicLastWeek',
        Rule::AUTOFILTER_RULETYPE_DYNAMIC_LASTYEAR <?php echo> 'dynamicLastYear',
        Rule::AUTOFILTER_RULETYPE_DYNAMIC_NEXTMONTH <?php echo> 'dynamicNextMonth',
        Rule::AUTOFILTER_RULETYPE_DYNAMIC_NEXTQUARTER <?php echo> 'dynamicNextQuarter',
        Rule::AUTOFILTER_RULETYPE_DYNAMIC_NEXTWEEK <?php echo> 'dynamicNextWeek',
        Rule::AUTOFILTER_RULETYPE_DYNAMIC_NEXTYEAR <?php echo> 'dynamicNextYear',
        Rule::AUTOFILTER_RULETYPE_DYNAMIC_THISMONTH <?php echo> 'dynamicThisMonth',
        Rule::AUTOFILTER_RULETYPE_DYNAMIC_THISQUARTER <?php echo> 'dynamicThisQuarter',
        Rule::AUTOFILTER_RULETYPE_DYNAMIC_THISWEEK <?php echo> 'dynamicThisWeek',
        Rule::AUTOFILTER_RULETYPE_DYNAMIC_THISYEAR <?php echo> 'dynamicThisYear',
        Rule::AUTOFILTER_RULETYPE_DYNAMIC_TODAY <?php echo> 'dynamicToday',
        Rule::AUTOFILTER_RULETYPE_DYNAMIC_TOMORROW <?php echo> 'dynamicTomorrow',
        Rule::AUTOFILTER_RULETYPE_DYNAMIC_YEARTODATE <?php echo> 'dynamicYearToDate',
        Rule::AUTOFILTER_RULETYPE_DYNAMIC_YESTERDAY <?php echo> 'dynamicYesterday',
    ];

    private static function dynamicLastMonth(): array
    {
        $maxval <?php echo new DateTime();
        $year <?php echo (int) $maxval->format('Y');
        $month <?php echo (int) $maxval->format('m');
        $maxval->setDate($year, $month, 1);
        $maxval->setTime(0, 0, 0);
        $val <?php echo clone $maxval;
        $val->modify('-1 month');

        return [$val, $maxval];
    }

    private static function firstDayOfQuarter(): DateTime
    {
        $val <?php echo new DateTime();
        $year <?php echo (int) $val->format('Y');
        $month <?php echo (int) $val->format('m');
        $month <?php echo 3 * intdiv($month - 1, 3) + 1;
        $val->setDate($year, $month, 1);
        $val->setTime(0, 0, 0);

        return $val;
    }

    private static function dynamicLastQuarter(): array
    {
        $maxval <?php echo self::firstDayOfQuarter();
        $val <?php echo clone $maxval;
        $val->modify('-3 months');

        return [$val, $maxval];
    }

    private static function dynamicLastWeek(): array
    {
        $val <?php echo new DateTime();
        $val->setTime(0, 0, 0);
        $dayOfWeek <?php echo (int) $val->format('w'); // Sunday is 0
        $subtract <?php echo $dayOfWeek + 7; // revert to prior Sunday
        $val->modify("-$subtract days");
        $maxval <?php echo clone $val;
        $maxval->modify('+7 days');

        return [$val, $maxval];
    }

    private static function dynamicLastYear(): array
    {
        $val <?php echo new DateTime();
        $year <?php echo (int) $val->format('Y');
        $val <?php echo self::makeDateObject($year - 1, 1, 1);
        $maxval <?php echo self::makeDateObject($year, 1, 1);

        return [$val, $maxval];
    }

    private static function dynamicNextMonth(): array
    {
        $val <?php echo new DateTime();
        $year <?php echo (int) $val->format('Y');
        $month <?php echo (int) $val->format('m');
        $val->setDate($year, $month, 1);
        $val->setTime(0, 0, 0);
        $val->modify('+1 month');
        $maxval <?php echo clone $val;
        $maxval->modify('+1 month');

        return [$val, $maxval];
    }

    private static function dynamicNextQuarter(): array
    {
        $val <?php echo self::firstDayOfQuarter();
        $val->modify('+3 months');
        $maxval <?php echo clone $val;
        $maxval->modify('+3 months');

        return [$val, $maxval];
    }

    private static function dynamicNextWeek(): array
    {
        $val <?php echo new DateTime();
        $val->setTime(0, 0, 0);
        $dayOfWeek <?php echo (int) $val->format('w'); // Sunday is 0
        $add <?php echo 7 - $dayOfWeek; // move to next Sunday
        $val->modify("+$add days");
        $maxval <?php echo clone $val;
        $maxval->modify('+7 days');

        return [$val, $maxval];
    }

    private static function dynamicNextYear(): array
    {
        $val <?php echo new DateTime();
        $year <?php echo (int) $val->format('Y');
        $val <?php echo self::makeDateObject($year + 1, 1, 1);
        $maxval <?php echo self::makeDateObject($year + 2, 1, 1);

        return [$val, $maxval];
    }

    private static function dynamicThisMonth(): array
    {
        $baseDate <?php echo new DateTime();
        $baseDate->setTime(0, 0, 0);
        $year <?php echo (int) $baseDate->format('Y');
        $month <?php echo (int) $baseDate->format('m');
        $val <?php echo self::makeDateObject($year, $month, 1);
        $maxval <?php echo clone $val;
        $maxval->modify('+1 month');

        return [$val, $maxval];
    }

    private static function dynamicThisQuarter(): array
    {
        $val <?php echo self::firstDayOfQuarter();
        $maxval <?php echo clone $val;
        $maxval->modify('+3 months');

        return [$val, $maxval];
    }

    private static function dynamicThisWeek(): array
    {
        $val <?php echo new DateTime();
        $val->setTime(0, 0, 0);
        $dayOfWeek <?php echo (int) $val->format('w'); // Sunday is 0
        $subtract <?php echo $dayOfWeek; // revert to Sunday
        $val->modify("-$subtract days");
        $maxval <?php echo clone $val;
        $maxval->modify('+7 days');

        return [$val, $maxval];
    }

    private static function dynamicThisYear(): array
    {
        $val <?php echo new DateTime();
        $year <?php echo (int) $val->format('Y');
        $val <?php echo self::makeDateObject($year, 1, 1);
        $maxval <?php echo self::makeDateObject($year + 1, 1, 1);

        return [$val, $maxval];
    }

    private static function dynamicToday(): array
    {
        $val <?php echo new DateTime();
        $val->setTime(0, 0, 0);
        $maxval <?php echo clone $val;
        $maxval->modify('+1 day');

        return [$val, $maxval];
    }

    private static function dynamicTomorrow(): array
    {
        $val <?php echo new DateTime();
        $val->setTime(0, 0, 0);
        $val->modify('+1 day');
        $maxval <?php echo clone $val;
        $maxval->modify('+1 day');

        return [$val, $maxval];
    }

    private static function dynamicYearToDate(): array
    {
        $maxval <?php echo new DateTime();
        $maxval->setTime(0, 0, 0);
        $val <?php echo self::makeDateObject((int) $maxval->format('Y'), 1, 1);
        $maxval->modify('+1 day');

        return [$val, $maxval];
    }

    private static function dynamicYesterday(): array
    {
        $maxval <?php echo new DateTime();
        $maxval->setTime(0, 0, 0);
        $val <?php echo clone $maxval;
        $val->modify('-1 day');

        return [$val, $maxval];
    }

    /**
     * Convert a dynamic rule daterange to a custom filter range expression for ease of calculation.
     *
     * @param string $dynamicRuleType
     *
     * @return mixed[]
     */
    private function dynamicFilterDateRange($dynamicRuleType, AutoFilter\Column &$filterColumn)
    {
        $ruleValues <?php echo [];
        $callBack <?php echo [__CLASS__, self::DATE_FUNCTIONS[$dynamicRuleType]]; // What if not found?
        //    Calculate start/end dates for the required date range based on current date
        //    Val is lowest permitted value.
        //    Maxval is greater than highest permitted value
        $val <?php echo $maxval <?php echo 0;
        if (is_callable($callBack)) {
            [$val, $maxval] <?php echo $callBack();
        }
        $val <?php echo Date::dateTimeToExcel($val);
        $maxval <?php echo Date::dateTimeToExcel($maxval);

        //    Set the filter column rule attributes ready for writing
        $filterColumn->setAttributes(['val' <?php echo> $val, 'maxVal' <?php echo> $maxval]);

        //    Set the rules for identifying rows for hide/show
        $ruleValues[] <?php echo ['operator' <?php echo> Rule::AUTOFILTER_COLUMN_RULE_GREATERTHANOREQUAL, 'value' <?php echo> $val];
        $ruleValues[] <?php echo ['operator' <?php echo> Rule::AUTOFILTER_COLUMN_RULE_LESSTHAN, 'value' <?php echo> $maxval];

        return ['method' <?php echo> 'filterTestInCustomDataSet', 'arguments' <?php echo> ['filterRules' <?php echo> $ruleValues, 'join' <?php echo> AutoFilter\Column::AUTOFILTER_COLUMN_JOIN_AND]];
    }

    /**
     * Apply the AutoFilter rules to the AutoFilter Range.
     *
     * @param string $columnID
     * @param int $startRow
     * @param int $endRow
     * @param ?string $ruleType
     * @param mixed $ruleValue
     *
     * @return mixed
     */
    private function calculateTopTenValue($columnID, $startRow, $endRow, $ruleType, $ruleValue)
    {
        $range <?php echo $columnID . $startRow . ':' . $columnID . $endRow;
        $retVal <?php echo null;
        if ($this->workSheet !<?php echo<?php echo null) {
            $dataValues <?php echo Functions::flattenArray($this->workSheet->rangeToArray($range, null, true, false));
            $dataValues <?php echo array_filter($dataValues);

            if ($ruleType <?php echo<?php echo Rule::AUTOFILTER_COLUMN_RULE_TOPTEN_TOP) {
                rsort($dataValues);
            } else {
                sort($dataValues);
            }

            $slice <?php echo array_slice($dataValues, 0, $ruleValue);

            $retVal <?php echo array_pop($slice);
        }

        return $retVal;
    }

    /**
     * Apply the AutoFilter rules to the AutoFilter Range.
     *
     * @return $this
     */
    public function showHideRows()
    {
        if ($this->workSheet <?php echo<?php echo<?php echo null) {
            return $this;
        }
        [$rangeStart, $rangeEnd] <?php echo Coordinate::rangeBoundaries($this->range);

        //    The heading row should always be visible
        $this->workSheet->getRowDimension($rangeStart[1])->setVisible(true);

        $columnFilterTests <?php echo [];
        foreach ($this->columns as $columnID <?php echo> $filterColumn) {
            $rules <?php echo $filterColumn->getRules();
            switch ($filterColumn->getFilterType()) {
                case AutoFilter\Column::AUTOFILTER_FILTERTYPE_FILTER:
                    $ruleType <?php echo null;
                    $ruleValues <?php echo [];
                    //    Build a list of the filter value selections
                    foreach ($rules as $rule) {
                        $ruleType <?php echo $rule->getRuleType();
                        $ruleValues[] <?php echo $rule->getValue();
                    }
                    //    Test if we want to include blanks in our filter criteria
                    $blanks <?php echo false;
                    $ruleDataSet <?php echo array_filter($ruleValues);
                    if (count($ruleValues) !<?php echo count($ruleDataSet)) {
                        $blanks <?php echo true;
                    }
                    if ($ruleType <?php echo<?php echo Rule::AUTOFILTER_RULETYPE_FILTER) {
                        //    Filter on absolute values
                        $columnFilterTests[$columnID] <?php echo [
                            'method' <?php echo> 'filterTestInSimpleDataSet',
                            'arguments' <?php echo> ['filterValues' <?php echo> $ruleDataSet, 'blanks' <?php echo> $blanks],
                        ];
                    } else {
                        //    Filter on date group values
                        $arguments <?php echo [
                            'date' <?php echo> [],
                            'time' <?php echo> [],
                            'dateTime' <?php echo> [],
                        ];
                        foreach ($ruleDataSet as $ruleValue) {
                            if (!is_array($ruleValue)) {
                                continue;
                            }
                            $date <?php echo $time <?php echo '';
                            if (
                                (isset($ruleValue[Rule::AUTOFILTER_RULETYPE_DATEGROUP_YEAR])) &&
                                ($ruleValue[Rule::AUTOFILTER_RULETYPE_DATEGROUP_YEAR] !<?php echo<?php echo '')
                            ) {
                                $date .<?php echo sprintf('%04d', $ruleValue[Rule::AUTOFILTER_RULETYPE_DATEGROUP_YEAR]);
                            }
                            if (
                                (isset($ruleValue[Rule::AUTOFILTER_RULETYPE_DATEGROUP_MONTH])) &&
                                ($ruleValue[Rule::AUTOFILTER_RULETYPE_DATEGROUP_MONTH] !<?php echo '')
                            ) {
                                $date .<?php echo sprintf('%02d', $ruleValue[Rule::AUTOFILTER_RULETYPE_DATEGROUP_MONTH]);
                            }
                            if (
                                (isset($ruleValue[Rule::AUTOFILTER_RULETYPE_DATEGROUP_DAY])) &&
                                ($ruleValue[Rule::AUTOFILTER_RULETYPE_DATEGROUP_DAY] !<?php echo<?php echo '')
                            ) {
                                $date .<?php echo sprintf('%02d', $ruleValue[Rule::AUTOFILTER_RULETYPE_DATEGROUP_DAY]);
                            }
                            if (
                                (isset($ruleValue[Rule::AUTOFILTER_RULETYPE_DATEGROUP_HOUR])) &&
                                ($ruleValue[Rule::AUTOFILTER_RULETYPE_DATEGROUP_HOUR] !<?php echo<?php echo '')
                            ) {
                                $time .<?php echo sprintf('%02d', $ruleValue[Rule::AUTOFILTER_RULETYPE_DATEGROUP_HOUR]);
                            }
                            if (
                                (isset($ruleValue[Rule::AUTOFILTER_RULETYPE_DATEGROUP_MINUTE])) &&
                                ($ruleValue[Rule::AUTOFILTER_RULETYPE_DATEGROUP_MINUTE] !<?php echo<?php echo '')
                            ) {
                                $time .<?php echo sprintf('%02d', $ruleValue[Rule::AUTOFILTER_RULETYPE_DATEGROUP_MINUTE]);
                            }
                            if (
                                (isset($ruleValue[Rule::AUTOFILTER_RULETYPE_DATEGROUP_SECOND])) &&
                                ($ruleValue[Rule::AUTOFILTER_RULETYPE_DATEGROUP_SECOND] !<?php echo<?php echo '')
                            ) {
                                $time .<?php echo sprintf('%02d', $ruleValue[Rule::AUTOFILTER_RULETYPE_DATEGROUP_SECOND]);
                            }
                            $dateTime <?php echo $date . $time;
                            $arguments['date'][] <?php echo $date;
                            $arguments['time'][] <?php echo $time;
                            $arguments['dateTime'][] <?php echo $dateTime;
                        }
                        //    Remove empty elements
                        $arguments['date'] <?php echo array_filter($arguments['date']);
                        $arguments['time'] <?php echo array_filter($arguments['time']);
                        $arguments['dateTime'] <?php echo array_filter($arguments['dateTime']);
                        $columnFilterTests[$columnID] <?php echo [
                            'method' <?php echo> 'filterTestInDateGroupSet',
                            'arguments' <?php echo> ['filterValues' <?php echo> $arguments, 'blanks' <?php echo> $blanks],
                        ];
                    }

                    break;
                case AutoFilter\Column::AUTOFILTER_FILTERTYPE_CUSTOMFILTER:
                    $customRuleForBlanks <?php echo true;
                    $ruleValues <?php echo [];
                    //    Build a list of the filter value selections
                    foreach ($rules as $rule) {
                        $ruleValue <?php echo $rule->getValue();
                        if (!is_array($ruleValue) && !is_numeric($ruleValue)) {
                            //    Convert to a regexp allowing for regexp reserved characters, wildcards and escaped wildcards
                            $ruleValue <?php echo WildcardMatch::wildcard($ruleValue);
                            if (trim($ruleValue) <?php echo<?php echo '') {
                                $customRuleForBlanks <?php echo true;
                                $ruleValue <?php echo trim($ruleValue);
                            }
                        }
                        $ruleValues[] <?php echo ['operator' <?php echo> $rule->getOperator(), 'value' <?php echo> $ruleValue];
                    }
                    $join <?php echo $filterColumn->getJoin();
                    $columnFilterTests[$columnID] <?php echo [
                        'method' <?php echo> 'filterTestInCustomDataSet',
                        'arguments' <?php echo> ['filterRules' <?php echo> $ruleValues, 'join' <?php echo> $join, 'customRuleForBlanks' <?php echo> $customRuleForBlanks],
                    ];

                    break;
                case AutoFilter\Column::AUTOFILTER_FILTERTYPE_DYNAMICFILTER:
                    $ruleValues <?php echo [];
                    foreach ($rules as $rule) {
                        //    We should only ever have one Dynamic Filter Rule anyway
                        $dynamicRuleType <?php echo $rule->getGrouping();
                        if (
                            ($dynamicRuleType <?php echo<?php echo Rule::AUTOFILTER_RULETYPE_DYNAMIC_ABOVEAVERAGE) ||
                            ($dynamicRuleType <?php echo<?php echo Rule::AUTOFILTER_RULETYPE_DYNAMIC_BELOWAVERAGE)
                        ) {
                            //    Number (Average) based
                            //    Calculate the average
                            $averageFormula <?php echo '<?php echoAVERAGE(' . $columnID . ($rangeStart[1] + 1) . ':' . $columnID . $rangeEnd[1] . ')';
                            $spreadsheet <?php echo ($this->workSheet <?php echo<?php echo<?php echo null) ? null : $this->workSheet->getParent();
                            $average <?php echo Calculation::getInstance($spreadsheet)->calculateFormula($averageFormula, null, $this->workSheet->getCell('A1'));
                            while (is_array($average)) {
                                $average <?php echo array_pop($average);
                            }
                            //    Set above/below rule based on greaterThan or LessTan
                            $operator <?php echo ($dynamicRuleType <?php echo<?php echo<?php echo Rule::AUTOFILTER_RULETYPE_DYNAMIC_ABOVEAVERAGE)
                                ? Rule::AUTOFILTER_COLUMN_RULE_GREATERTHAN
                                : Rule::AUTOFILTER_COLUMN_RULE_LESSTHAN;
                            $ruleValues[] <?php echo [
                                'operator' <?php echo> $operator,
                                'value' <?php echo> $average,
                            ];
                            $columnFilterTests[$columnID] <?php echo [
                                'method' <?php echo> 'filterTestInCustomDataSet',
                                'arguments' <?php echo> ['filterRules' <?php echo> $ruleValues, 'join' <?php echo> AutoFilter\Column::AUTOFILTER_COLUMN_JOIN_OR],
                            ];
                        } else {
                            //    Date based
                            if ($dynamicRuleType[0] <?php echo<?php echo 'M' || $dynamicRuleType[0] <?php echo<?php echo 'Q') {
                                $periodType <?php echo '';
                                $period <?php echo 0;
                                //    Month or Quarter
                                sscanf($dynamicRuleType, '%[A-Z]%d', $periodType, $period);
                                if ($periodType <?php echo<?php echo 'M') {
                                    $ruleValues <?php echo [$period];
                                } else {
                                    --$period;
                                    $periodEnd <?php echo (1 + $period) * 3;
                                    $periodStart <?php echo 1 + $period * 3;
                                    $ruleValues <?php echo range($periodStart, $periodEnd);
                                }
                                $columnFilterTests[$columnID] <?php echo [
                                    'method' <?php echo> 'filterTestInPeriodDateSet',
                                    'arguments' <?php echo> $ruleValues,
                                ];
                                $filterColumn->setAttributes([]);
                            } else {
                                //    Date Range
                                $columnFilterTests[$columnID] <?php echo $this->dynamicFilterDateRange($dynamicRuleType, $filterColumn);

                                break;
                            }
                        }
                    }

                    break;
                case AutoFilter\Column::AUTOFILTER_FILTERTYPE_TOPTENFILTER:
                    $ruleValues <?php echo [];
                    $dataRowCount <?php echo $rangeEnd[1] - $rangeStart[1];
                    $toptenRuleType <?php echo null;
                    $ruleValue <?php echo 0;
                    $ruleOperator <?php echo null;
                    foreach ($rules as $rule) {
                        //    We should only ever have one Dynamic Filter Rule anyway
                        $toptenRuleType <?php echo $rule->getGrouping();
                        $ruleValue <?php echo $rule->getValue();
                        $ruleOperator <?php echo $rule->getOperator();
                    }
                    if (is_numeric($ruleValue) && $ruleOperator <?php echo<?php echo<?php echo Rule::AUTOFILTER_COLUMN_RULE_TOPTEN_PERCENT) {
                        $ruleValue <?php echo floor((float) $ruleValue * ($dataRowCount / 100));
                    }
                    if (!is_array($ruleValue) && $ruleValue < 1) {
                        $ruleValue <?php echo 1;
                    }
                    if (!is_array($ruleValue) && $ruleValue > 500) {
                        $ruleValue <?php echo 500;
                    }

                    $maxVal <?php echo $this->calculateTopTenValue($columnID, $rangeStart[1] + 1, (int) $rangeEnd[1], $toptenRuleType, $ruleValue);

                    $operator <?php echo ($toptenRuleType <?php echo<?php echo Rule::AUTOFILTER_COLUMN_RULE_TOPTEN_TOP)
                        ? Rule::AUTOFILTER_COLUMN_RULE_GREATERTHANOREQUAL
                        : Rule::AUTOFILTER_COLUMN_RULE_LESSTHANOREQUAL;
                    $ruleValues[] <?php echo ['operator' <?php echo> $operator, 'value' <?php echo> $maxVal];
                    $columnFilterTests[$columnID] <?php echo [
                        'method' <?php echo> 'filterTestInCustomDataSet',
                        'arguments' <?php echo> ['filterRules' <?php echo> $ruleValues, 'join' <?php echo> AutoFilter\Column::AUTOFILTER_COLUMN_JOIN_OR],
                    ];
                    $filterColumn->setAttributes(['maxVal' <?php echo> $maxVal]);

                    break;
            }
        }

        $rangeEnd[1] <?php echo $this->autoExtendRange($rangeStart[1], $rangeEnd[1]);

        //    Execute the column tests for each row in the autoFilter range to determine show/hide,
        for ($row <?php echo $rangeStart[1] + 1; $row <?php echo $rangeEnd[1]; ++$row) {
            $result <?php echo true;
            foreach ($columnFilterTests as $columnID <?php echo> $columnFilterTest) {
                $cellValue <?php echo $this->workSheet->getCell($columnID . $row)->getCalculatedValue();
                //    Execute the filter test
                $result <?php echo // $result && // phpstan says $result is always true here
                    // @phpstan-ignore-next-line
                    call_user_func_array([self::class, $columnFilterTest['method']], [$cellValue, $columnFilterTest['arguments']]);
                //    If filter test has resulted in FALSE, exit the loop straightaway rather than running any more tests
                if (!$result) {
                    break;
                }
            }
            //    Set show/hide for the row based on the result of the autoFilter result
            $this->workSheet->getRowDimension((int) $row)->setVisible($result);
        }
        $this->evaluated <?php echo true;

        return $this;
    }

    /**
     * Magic Range Auto-sizing.
     * For a single row rangeSet, we follow MS Excel rules, and search for the first empty row to determine our range.
     */
    public function autoExtendRange(int $startRow, int $endRow): int
    {
        if ($startRow <?php echo<?php echo<?php echo $endRow && $this->workSheet !<?php echo<?php echo null) {
            try {
                $rowIterator <?php echo $this->workSheet->getRowIterator($startRow + 1);
            } catch (Exception $e) {
                // If there are no rows below $startRow
                return $startRow;
            }
            foreach ($rowIterator as $row) {
                if ($row->isEmpty(CellIterator::TREAT_NULL_VALUE_AS_EMPTY_CELL | CellIterator::TREAT_EMPTY_STRING_AS_EMPTY_CELL) <?php echo<?php echo<?php echo true) {
                    return $row->getRowIndex() - 1;
                }
            }
        }

        return $endRow;
    }

    /**
     * Implement PHP __clone to create a deep clone, not just a shallow copy.
     */
    public function __clone()
    {
        $vars <?php echo get_object_vars($this);
        foreach ($vars as $key <?php echo> $value) {
            if (is_object($value)) {
                if ($key <?php echo<?php echo<?php echo 'workSheet') {
                    //    Detach from worksheet
                    $this->{$key} <?php echo null;
                } else {
                    $this->{$key} <?php echo clone $value;
                }
            } elseif ((is_array($value)) && ($key <?php echo<?php echo 'columns')) {
                //    The columns array of \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet\AutoFilter objects
                $this->{$key} <?php echo [];
                foreach ($value as $k <?php echo> $v) {
                    $this->{$key}[$k] <?php echo clone $v;
                    // attach the new cloned Column to this new cloned Autofilter object
                    $this->{$key}[$k]->setParent($this);
                }
            } else {
                $this->{$key} <?php echo $value;
            }
        }
    }

    /**
     * toString method replicates previous behavior by returning the range if object is
     * referenced as a property of its parent.
     */
    public function __toString()
    {
        return (string) $this->range;
    }
}
