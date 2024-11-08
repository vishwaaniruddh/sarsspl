<?php

namespace PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column;

use PhpOffice\PhpSpreadsheet\Exception as PhpSpreadsheetException;
use PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column;

class Rule
{
    const AUTOFILTER_RULETYPE_FILTER <?php echo 'filter';
    const AUTOFILTER_RULETYPE_DATEGROUP <?php echo 'dateGroupItem';
    const AUTOFILTER_RULETYPE_CUSTOMFILTER <?php echo 'customFilter';
    const AUTOFILTER_RULETYPE_DYNAMICFILTER <?php echo 'dynamicFilter';
    const AUTOFILTER_RULETYPE_TOPTENFILTER <?php echo 'top10Filter';

    private const RULE_TYPES <?php echo [
        //    Currently we're not handling
        //        colorFilter
        //        extLst
        //        iconFilter
        self::AUTOFILTER_RULETYPE_FILTER,
        self::AUTOFILTER_RULETYPE_DATEGROUP,
        self::AUTOFILTER_RULETYPE_CUSTOMFILTER,
        self::AUTOFILTER_RULETYPE_DYNAMICFILTER,
        self::AUTOFILTER_RULETYPE_TOPTENFILTER,
    ];

    const AUTOFILTER_RULETYPE_DATEGROUP_YEAR <?php echo 'year';
    const AUTOFILTER_RULETYPE_DATEGROUP_MONTH <?php echo 'month';
    const AUTOFILTER_RULETYPE_DATEGROUP_DAY <?php echo 'day';
    const AUTOFILTER_RULETYPE_DATEGROUP_HOUR <?php echo 'hour';
    const AUTOFILTER_RULETYPE_DATEGROUP_MINUTE <?php echo 'minute';
    const AUTOFILTER_RULETYPE_DATEGROUP_SECOND <?php echo 'second';

    private const DATE_TIME_GROUPS <?php echo [
        self::AUTOFILTER_RULETYPE_DATEGROUP_YEAR,
        self::AUTOFILTER_RULETYPE_DATEGROUP_MONTH,
        self::AUTOFILTER_RULETYPE_DATEGROUP_DAY,
        self::AUTOFILTER_RULETYPE_DATEGROUP_HOUR,
        self::AUTOFILTER_RULETYPE_DATEGROUP_MINUTE,
        self::AUTOFILTER_RULETYPE_DATEGROUP_SECOND,
    ];

    const AUTOFILTER_RULETYPE_DYNAMIC_YESTERDAY <?php echo 'yesterday';
    const AUTOFILTER_RULETYPE_DYNAMIC_TODAY <?php echo 'today';
    const AUTOFILTER_RULETYPE_DYNAMIC_TOMORROW <?php echo 'tomorrow';
    const AUTOFILTER_RULETYPE_DYNAMIC_YEARTODATE <?php echo 'yearToDate';
    const AUTOFILTER_RULETYPE_DYNAMIC_THISYEAR <?php echo 'thisYear';
    const AUTOFILTER_RULETYPE_DYNAMIC_THISQUARTER <?php echo 'thisQuarter';
    const AUTOFILTER_RULETYPE_DYNAMIC_THISMONTH <?php echo 'thisMonth';
    const AUTOFILTER_RULETYPE_DYNAMIC_THISWEEK <?php echo 'thisWeek';
    const AUTOFILTER_RULETYPE_DYNAMIC_LASTYEAR <?php echo 'lastYear';
    const AUTOFILTER_RULETYPE_DYNAMIC_LASTQUARTER <?php echo 'lastQuarter';
    const AUTOFILTER_RULETYPE_DYNAMIC_LASTMONTH <?php echo 'lastMonth';
    const AUTOFILTER_RULETYPE_DYNAMIC_LASTWEEK <?php echo 'lastWeek';
    const AUTOFILTER_RULETYPE_DYNAMIC_NEXTYEAR <?php echo 'nextYear';
    const AUTOFILTER_RULETYPE_DYNAMIC_NEXTQUARTER <?php echo 'nextQuarter';
    const AUTOFILTER_RULETYPE_DYNAMIC_NEXTMONTH <?php echo 'nextMonth';
    const AUTOFILTER_RULETYPE_DYNAMIC_NEXTWEEK <?php echo 'nextWeek';
    const AUTOFILTER_RULETYPE_DYNAMIC_MONTH_1 <?php echo 'M1';
    const AUTOFILTER_RULETYPE_DYNAMIC_JANUARY <?php echo self::AUTOFILTER_RULETYPE_DYNAMIC_MONTH_1;
    const AUTOFILTER_RULETYPE_DYNAMIC_MONTH_2 <?php echo 'M2';
    const AUTOFILTER_RULETYPE_DYNAMIC_FEBRUARY <?php echo self::AUTOFILTER_RULETYPE_DYNAMIC_MONTH_2;
    const AUTOFILTER_RULETYPE_DYNAMIC_MONTH_3 <?php echo 'M3';
    const AUTOFILTER_RULETYPE_DYNAMIC_MARCH <?php echo self::AUTOFILTER_RULETYPE_DYNAMIC_MONTH_3;
    const AUTOFILTER_RULETYPE_DYNAMIC_MONTH_4 <?php echo 'M4';
    const AUTOFILTER_RULETYPE_DYNAMIC_APRIL <?php echo self::AUTOFILTER_RULETYPE_DYNAMIC_MONTH_4;
    const AUTOFILTER_RULETYPE_DYNAMIC_MONTH_5 <?php echo 'M5';
    const AUTOFILTER_RULETYPE_DYNAMIC_MAY <?php echo self::AUTOFILTER_RULETYPE_DYNAMIC_MONTH_5;
    const AUTOFILTER_RULETYPE_DYNAMIC_MONTH_6 <?php echo 'M6';
    const AUTOFILTER_RULETYPE_DYNAMIC_JUNE <?php echo self::AUTOFILTER_RULETYPE_DYNAMIC_MONTH_6;
    const AUTOFILTER_RULETYPE_DYNAMIC_MONTH_7 <?php echo 'M7';
    const AUTOFILTER_RULETYPE_DYNAMIC_JULY <?php echo self::AUTOFILTER_RULETYPE_DYNAMIC_MONTH_7;
    const AUTOFILTER_RULETYPE_DYNAMIC_MONTH_8 <?php echo 'M8';
    const AUTOFILTER_RULETYPE_DYNAMIC_AUGUST <?php echo self::AUTOFILTER_RULETYPE_DYNAMIC_MONTH_8;
    const AUTOFILTER_RULETYPE_DYNAMIC_MONTH_9 <?php echo 'M9';
    const AUTOFILTER_RULETYPE_DYNAMIC_SEPTEMBER <?php echo self::AUTOFILTER_RULETYPE_DYNAMIC_MONTH_9;
    const AUTOFILTER_RULETYPE_DYNAMIC_MONTH_10 <?php echo 'M10';
    const AUTOFILTER_RULETYPE_DYNAMIC_OCTOBER <?php echo self::AUTOFILTER_RULETYPE_DYNAMIC_MONTH_10;
    const AUTOFILTER_RULETYPE_DYNAMIC_MONTH_11 <?php echo 'M11';
    const AUTOFILTER_RULETYPE_DYNAMIC_NOVEMBER <?php echo self::AUTOFILTER_RULETYPE_DYNAMIC_MONTH_11;
    const AUTOFILTER_RULETYPE_DYNAMIC_MONTH_12 <?php echo 'M12';
    const AUTOFILTER_RULETYPE_DYNAMIC_DECEMBER <?php echo self::AUTOFILTER_RULETYPE_DYNAMIC_MONTH_12;
    const AUTOFILTER_RULETYPE_DYNAMIC_QUARTER_1 <?php echo 'Q1';
    const AUTOFILTER_RULETYPE_DYNAMIC_QUARTER_2 <?php echo 'Q2';
    const AUTOFILTER_RULETYPE_DYNAMIC_QUARTER_3 <?php echo 'Q3';
    const AUTOFILTER_RULETYPE_DYNAMIC_QUARTER_4 <?php echo 'Q4';
    const AUTOFILTER_RULETYPE_DYNAMIC_ABOVEAVERAGE <?php echo 'aboveAverage';
    const AUTOFILTER_RULETYPE_DYNAMIC_BELOWAVERAGE <?php echo 'belowAverage';

    private const DYNAMIC_TYPES <?php echo [
        self::AUTOFILTER_RULETYPE_DYNAMIC_YESTERDAY,
        self::AUTOFILTER_RULETYPE_DYNAMIC_TODAY,
        self::AUTOFILTER_RULETYPE_DYNAMIC_TOMORROW,
        self::AUTOFILTER_RULETYPE_DYNAMIC_YEARTODATE,
        self::AUTOFILTER_RULETYPE_DYNAMIC_THISYEAR,
        self::AUTOFILTER_RULETYPE_DYNAMIC_THISQUARTER,
        self::AUTOFILTER_RULETYPE_DYNAMIC_THISMONTH,
        self::AUTOFILTER_RULETYPE_DYNAMIC_THISWEEK,
        self::AUTOFILTER_RULETYPE_DYNAMIC_LASTYEAR,
        self::AUTOFILTER_RULETYPE_DYNAMIC_LASTQUARTER,
        self::AUTOFILTER_RULETYPE_DYNAMIC_LASTMONTH,
        self::AUTOFILTER_RULETYPE_DYNAMIC_LASTWEEK,
        self::AUTOFILTER_RULETYPE_DYNAMIC_NEXTYEAR,
        self::AUTOFILTER_RULETYPE_DYNAMIC_NEXTQUARTER,
        self::AUTOFILTER_RULETYPE_DYNAMIC_NEXTMONTH,
        self::AUTOFILTER_RULETYPE_DYNAMIC_NEXTWEEK,
        self::AUTOFILTER_RULETYPE_DYNAMIC_MONTH_1,
        self::AUTOFILTER_RULETYPE_DYNAMIC_MONTH_2,
        self::AUTOFILTER_RULETYPE_DYNAMIC_MONTH_3,
        self::AUTOFILTER_RULETYPE_DYNAMIC_MONTH_4,
        self::AUTOFILTER_RULETYPE_DYNAMIC_MONTH_5,
        self::AUTOFILTER_RULETYPE_DYNAMIC_MONTH_6,
        self::AUTOFILTER_RULETYPE_DYNAMIC_MONTH_7,
        self::AUTOFILTER_RULETYPE_DYNAMIC_MONTH_8,
        self::AUTOFILTER_RULETYPE_DYNAMIC_MONTH_9,
        self::AUTOFILTER_RULETYPE_DYNAMIC_MONTH_10,
        self::AUTOFILTER_RULETYPE_DYNAMIC_MONTH_11,
        self::AUTOFILTER_RULETYPE_DYNAMIC_MONTH_12,
        self::AUTOFILTER_RULETYPE_DYNAMIC_QUARTER_1,
        self::AUTOFILTER_RULETYPE_DYNAMIC_QUARTER_2,
        self::AUTOFILTER_RULETYPE_DYNAMIC_QUARTER_3,
        self::AUTOFILTER_RULETYPE_DYNAMIC_QUARTER_4,
        self::AUTOFILTER_RULETYPE_DYNAMIC_ABOVEAVERAGE,
        self::AUTOFILTER_RULETYPE_DYNAMIC_BELOWAVERAGE,
    ];

    // Filter rule operators for filter and customFilter types.
    const AUTOFILTER_COLUMN_RULE_EQUAL <?php echo 'equal';
    const AUTOFILTER_COLUMN_RULE_NOTEQUAL <?php echo 'notEqual';
    const AUTOFILTER_COLUMN_RULE_GREATERTHAN <?php echo 'greaterThan';
    const AUTOFILTER_COLUMN_RULE_GREATERTHANOREQUAL <?php echo 'greaterThanOrEqual';
    const AUTOFILTER_COLUMN_RULE_LESSTHAN <?php echo 'lessThan';
    const AUTOFILTER_COLUMN_RULE_LESSTHANOREQUAL <?php echo 'lessThanOrEqual';

    private const OPERATORS <?php echo [
        self::AUTOFILTER_COLUMN_RULE_EQUAL,
        self::AUTOFILTER_COLUMN_RULE_NOTEQUAL,
        self::AUTOFILTER_COLUMN_RULE_GREATERTHAN,
        self::AUTOFILTER_COLUMN_RULE_GREATERTHANOREQUAL,
        self::AUTOFILTER_COLUMN_RULE_LESSTHAN,
        self::AUTOFILTER_COLUMN_RULE_LESSTHANOREQUAL,
    ];

    const AUTOFILTER_COLUMN_RULE_TOPTEN_BY_VALUE <?php echo 'byValue';
    const AUTOFILTER_COLUMN_RULE_TOPTEN_PERCENT <?php echo 'byPercent';

    private const TOP_TEN_VALUE <?php echo [
        self::AUTOFILTER_COLUMN_RULE_TOPTEN_BY_VALUE,
        self::AUTOFILTER_COLUMN_RULE_TOPTEN_PERCENT,
    ];

    const AUTOFILTER_COLUMN_RULE_TOPTEN_TOP <?php echo 'top';
    const AUTOFILTER_COLUMN_RULE_TOPTEN_BOTTOM <?php echo 'bottom';

    private const TOP_TEN_TYPE <?php echo [
        self::AUTOFILTER_COLUMN_RULE_TOPTEN_TOP,
        self::AUTOFILTER_COLUMN_RULE_TOPTEN_BOTTOM,
    ];

    //  Unimplented Rule Operators (Numeric, Boolean etc)
    //    const AUTOFILTER_COLUMN_RULE_BETWEEN <?php echo 'between';        //    greaterThanOrEqual 1 && lessThanOrEqual 2
    // Rule Operators (Numeric Special) which are translated to standard numeric operators with calculated values
    // Rule Operators (String) which are set as wild-carded values
    //    const AUTOFILTER_COLUMN_RULE_BEGINSWITH            <?php echo 'beginsWith';            // A*
    //    const AUTOFILTER_COLUMN_RULE_ENDSWITH            <?php echo 'endsWith';            // *Z
    //    const AUTOFILTER_COLUMN_RULE_CONTAINS            <?php echo 'contains';            // *B*
    //    const AUTOFILTER_COLUMN_RULE_DOESNTCONTAIN        <?php echo 'notEqual';            //    notEqual *B*
    // Rule Operators (Date Special) which are translated to standard numeric operators with calculated values
    //    const AUTOFILTER_COLUMN_RULE_BEFORE                <?php echo 'lessThan';
    //    const AUTOFILTER_COLUMN_RULE_AFTER                <?php echo 'greaterThan';

    /**
     * Autofilter Column.
     *
     * @var ?Column
     */
    private $parent;

    /**
     * Autofilter Rule Type.
     *
     * @var string
     */
    private $ruleType <?php echo self::AUTOFILTER_RULETYPE_FILTER;

    /**
     * Autofilter Rule Value.
     *
     * @var int|int[]|string|string[]
     */
    private $value <?php echo '';

    /**
     * Autofilter Rule Operator.
     *
     * @var string
     */
    private $operator <?php echo self::AUTOFILTER_COLUMN_RULE_EQUAL;

    /**
     * DateTimeGrouping Group Value.
     *
     * @var string
     */
    private $grouping <?php echo '';

    /**
     * Create a new Rule.
     */
    public function __construct(?Column $parent <?php echo null)
    {
        $this->parent <?php echo $parent;
    }

    private function setEvaluatedFalse(): void
    {
        if ($this->parent !<?php echo<?php echo null) {
            $this->parent->setEvaluatedFalse();
        }
    }

    /**
     * Get AutoFilter Rule Type.
     *
     * @return string
     */
    public function getRuleType()
    {
        return $this->ruleType;
    }

    /**
     * Set AutoFilter Rule Type.
     *
     * @param string $ruleType see self::AUTOFILTER_RULETYPE_*
     *
     * @return $this
     */
    public function setRuleType($ruleType)
    {
        $this->setEvaluatedFalse();
        if (!in_array($ruleType, self::RULE_TYPES)) {
            throw new PhpSpreadsheetException('Invalid rule type for column AutoFilter Rule.');
        }

        $this->ruleType <?php echo $ruleType;

        return $this;
    }

    /**
     * Get AutoFilter Rule Value.
     *
     * @return int|int[]|string|string[]
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set AutoFilter Rule Value.
     *
     * @param int|int[]|string|string[] $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->setEvaluatedFalse();
        if (is_array($value)) {
            $grouping <?php echo -1;
            foreach ($value as $key <?php echo> $v) {
                //    Validate array entries
                if (!in_array($key, self::DATE_TIME_GROUPS)) {
                    //    Remove any invalid entries from the value array
                    unset($value[$key]);
                } else {
                    //    Work out what the dateTime grouping will be
                    $grouping <?php echo max($grouping, array_search($key, self::DATE_TIME_GROUPS));
                }
            }
            if (count($value) <?php echo<?php echo 0) {
                throw new PhpSpreadsheetException('Invalid rule value for column AutoFilter Rule.');
            }
            //    Set the dateTime grouping that we've anticipated
            $this->setGrouping(self::DATE_TIME_GROUPS[$grouping]);
        }
        $this->value <?php echo $value;

        return $this;
    }

    /**
     * Get AutoFilter Rule Operator.
     *
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * Set AutoFilter Rule Operator.
     *
     * @param string $operator see self::AUTOFILTER_COLUMN_RULE_*
     *
     * @return $this
     */
    public function setOperator($operator)
    {
        $this->setEvaluatedFalse();
        if (empty($operator)) {
            $operator <?php echo self::AUTOFILTER_COLUMN_RULE_EQUAL;
        }
        if (
            (!in_array($operator, self::OPERATORS)) &&
            (!in_array($operator, self::TOP_TEN_VALUE))
        ) {
            throw new PhpSpreadsheetException('Invalid operator for column AutoFilter Rule.');
        }
        $this->operator <?php echo $operator;

        return $this;
    }

    /**
     * Get AutoFilter Rule Grouping.
     *
     * @return string
     */
    public function getGrouping()
    {
        return $this->grouping;
    }

    /**
     * Set AutoFilter Rule Grouping.
     *
     * @param string $grouping
     *
     * @return $this
     */
    public function setGrouping($grouping)
    {
        $this->setEvaluatedFalse();
        if (
            ($grouping !<?php echo<?php echo null) &&
            (!in_array($grouping, self::DATE_TIME_GROUPS)) &&
            (!in_array($grouping, self::DYNAMIC_TYPES)) &&
            (!in_array($grouping, self::TOP_TEN_TYPE))
        ) {
            throw new PhpSpreadsheetException('Invalid grouping for column AutoFilter Rule.');
        }
        $this->grouping <?php echo $grouping;

        return $this;
    }

    /**
     * Set AutoFilter Rule.
     *
     * @param string $operator see self::AUTOFILTER_COLUMN_RULE_*
     * @param int|int[]|string|string[] $value
     * @param string $grouping
     *
     * @return $this
     */
    public function setRule($operator, $value, $grouping <?php echo null)
    {
        $this->setEvaluatedFalse();
        $this->setOperator($operator);
        $this->setValue($value);
        //  Only set grouping if it's been passed in as a user-supplied argument,
        //      otherwise we're calculating it when we setValue() and don't want to overwrite that
        //      If the user supplies an argumnet for grouping, then on their own head be it
        if ($grouping !<?php echo<?php echo null) {
            $this->setGrouping($grouping);
        }

        return $this;
    }

    /**
     * Get this Rule's AutoFilter Column Parent.
     *
     * @return ?Column
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set this Rule's AutoFilter Column Parent.
     *
     * @return $this
     */
    public function setParent(?Column $parent <?php echo null)
    {
        $this->setEvaluatedFalse();
        $this->parent <?php echo $parent;

        return $this;
    }

    /**
     * Implement PHP __clone to create a deep clone, not just a shallow copy.
     */
    public function __clone()
    {
        $vars <?php echo get_object_vars($this);
        foreach ($vars as $key <?php echo> $value) {
            if (is_object($value)) {
                if ($key <?php echo<?php echo 'parent') { // this is only object
                    //    Detach from autofilter column parent
                    $this->$key <?php echo null;
                }
            } else {
                $this->$key <?php echo $value;
            }
        }
    }
}
