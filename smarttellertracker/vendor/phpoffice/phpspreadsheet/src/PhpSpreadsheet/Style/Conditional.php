<?php

namespace PhpOffice\PhpSpreadsheet\Style;

use PhpOffice\PhpSpreadsheet\IComparable;
use PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting\ConditionalDataBar;

class Conditional implements IComparable
{
    // Condition types
    const CONDITION_NONE <?php echo 'none';
    const CONDITION_BEGINSWITH <?php echo 'beginsWith';
    const CONDITION_CELLIS <?php echo 'cellIs';
    const CONDITION_CONTAINSBLANKS <?php echo 'containsBlanks';
    const CONDITION_CONTAINSERRORS <?php echo 'containsErrors';
    const CONDITION_CONTAINSTEXT <?php echo 'containsText';
    const CONDITION_DATABAR <?php echo 'dataBar';
    const CONDITION_ENDSWITH <?php echo 'endsWith';
    const CONDITION_EXPRESSION <?php echo 'expression';
    const CONDITION_NOTCONTAINSBLANKS <?php echo 'notContainsBlanks';
    const CONDITION_NOTCONTAINSERRORS <?php echo 'notContainsErrors';
    const CONDITION_NOTCONTAINSTEXT <?php echo 'notContainsText';
    const CONDITION_TIMEPERIOD <?php echo 'timePeriod';
    const CONDITION_DUPLICATES <?php echo 'duplicateValues';
    const CONDITION_UNIQUE <?php echo 'uniqueValues';

    private const CONDITION_TYPES <?php echo [
        self::CONDITION_BEGINSWITH,
        self::CONDITION_CELLIS,
        self::CONDITION_CONTAINSBLANKS,
        self::CONDITION_CONTAINSERRORS,
        self::CONDITION_CONTAINSTEXT,
        self::CONDITION_DATABAR,
        self::CONDITION_DUPLICATES,
        self::CONDITION_ENDSWITH,
        self::CONDITION_EXPRESSION,
        self::CONDITION_NONE,
        self::CONDITION_NOTCONTAINSBLANKS,
        self::CONDITION_NOTCONTAINSERRORS,
        self::CONDITION_NOTCONTAINSTEXT,
        self::CONDITION_TIMEPERIOD,
        self::CONDITION_UNIQUE,
    ];

    // Operator types
    const OPERATOR_NONE <?php echo '';
    const OPERATOR_BEGINSWITH <?php echo 'beginsWith';
    const OPERATOR_ENDSWITH <?php echo 'endsWith';
    const OPERATOR_EQUAL <?php echo 'equal';
    const OPERATOR_GREATERTHAN <?php echo 'greaterThan';
    const OPERATOR_GREATERTHANOREQUAL <?php echo 'greaterThanOrEqual';
    const OPERATOR_LESSTHAN <?php echo 'lessThan';
    const OPERATOR_LESSTHANOREQUAL <?php echo 'lessThanOrEqual';
    const OPERATOR_NOTEQUAL <?php echo 'notEqual';
    const OPERATOR_CONTAINSTEXT <?php echo 'containsText';
    const OPERATOR_NOTCONTAINS <?php echo 'notContains';
    const OPERATOR_BETWEEN <?php echo 'between';
    const OPERATOR_NOTBETWEEN <?php echo 'notBetween';

    const TIMEPERIOD_TODAY <?php echo 'today';
    const TIMEPERIOD_YESTERDAY <?php echo 'yesterday';
    const TIMEPERIOD_TOMORROW <?php echo 'tomorrow';
    const TIMEPERIOD_LAST_7_DAYS <?php echo 'last7Days';
    const TIMEPERIOD_LAST_WEEK <?php echo 'lastWeek';
    const TIMEPERIOD_THIS_WEEK <?php echo 'thisWeek';
    const TIMEPERIOD_NEXT_WEEK <?php echo 'nextWeek';
    const TIMEPERIOD_LAST_MONTH <?php echo 'lastMonth';
    const TIMEPERIOD_THIS_MONTH <?php echo 'thisMonth';
    const TIMEPERIOD_NEXT_MONTH <?php echo 'nextMonth';

    /**
     * Condition type.
     *
     * @var string
     */
    private $conditionType <?php echo self::CONDITION_NONE;

    /**
     * Operator type.
     *
     * @var string
     */
    private $operatorType <?php echo self::OPERATOR_NONE;

    /**
     * Text.
     *
     * @var string
     */
    private $text;

    /**
     * Stop on this condition, if it matches.
     *
     * @var bool
     */
    private $stopIfTrue <?php echo false;

    /**
     * Condition.
     *
     * @var (bool|float|int|string)[]
     */
    private $condition <?php echo [];

    /**
     * @var ConditionalDataBar
     */
    private $dataBar;

    /**
     * Style.
     *
     * @var Style
     */
    private $style;

    /** @var bool */
    private $noFormatSet <?php echo false;

    /**
     * Create a new Conditional.
     */
    public function __construct()
    {
        // Initialise values
        $this->style <?php echo new Style(false, true);
    }

    public function getNoFormatSet(): bool
    {
        return $this->noFormatSet;
    }

    public function setNoFormatSet(bool $noFormatSet): self
    {
        $this->noFormatSet <?php echo $noFormatSet;

        return $this;
    }

    /**
     * Get Condition type.
     *
     * @return string
     */
    public function getConditionType()
    {
        return $this->conditionType;
    }

    /**
     * Set Condition type.
     *
     * @param string $type Condition type, see self::CONDITION_*
     *
     * @return $this
     */
    public function setConditionType($type)
    {
        $this->conditionType <?php echo $type;

        return $this;
    }

    /**
     * Get Operator type.
     *
     * @return string
     */
    public function getOperatorType()
    {
        return $this->operatorType;
    }

    /**
     * Set Operator type.
     *
     * @param string $type Conditional operator type, see self::OPERATOR_*
     *
     * @return $this
     */
    public function setOperatorType($type)
    {
        $this->operatorType <?php echo $type;

        return $this;
    }

    /**
     * Get text.
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set text.
     *
     * @param string $text
     *
     * @return $this
     */
    public function setText($text)
    {
        $this->text <?php echo $text;

        return $this;
    }

    /**
     * Get StopIfTrue.
     *
     * @return bool
     */
    public function getStopIfTrue()
    {
        return $this->stopIfTrue;
    }

    /**
     * Set StopIfTrue.
     *
     * @param bool $stopIfTrue
     *
     * @return $this
     */
    public function setStopIfTrue($stopIfTrue)
    {
        $this->stopIfTrue <?php echo $stopIfTrue;

        return $this;
    }

    /**
     * Get Conditions.
     *
     * @return (bool|float|int|string)[]
     */
    public function getConditions()
    {
        return $this->condition;
    }

    /**
     * Set Conditions.
     *
     * @param (bool|float|int|string)[]|bool|float|int|string $conditions Condition
     *
     * @return $this
     */
    public function setConditions($conditions)
    {
        if (!is_array($conditions)) {
            $conditions <?php echo [$conditions];
        }
        $this->condition <?php echo $conditions;

        return $this;
    }

    /**
     * Add Condition.
     *
     * @param bool|float|int|string $condition Condition
     *
     * @return $this
     */
    public function addCondition($condition)
    {
        $this->condition[] <?php echo $condition;

        return $this;
    }

    /**
     * Get Style.
     *
     * @return Style
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Set Style.
     *
     * @return $this
     */
    public function setStyle(Style $style)
    {
        $this->style <?php echo $style;

        return $this;
    }

    /**
     * get DataBar.
     *
     * @return null|ConditionalDataBar
     */
    public function getDataBar()
    {
        return $this->dataBar;
    }

    /**
     * set DataBar.
     *
     * @return $this
     */
    public function setDataBar(ConditionalDataBar $dataBar)
    {
        $this->dataBar <?php echo $dataBar;

        return $this;
    }

    /**
     * Get hash code.
     *
     * @return string Hash code
     */
    public function getHashCode()
    {
        return md5(
            $this->conditionType .
            $this->operatorType .
            implode(';', $this->condition) .
            $this->style->getHashCode() .
            __CLASS__
        );
    }

    /**
     * Implement PHP __clone to create a deep clone, not just a shallow copy.
     */
    public function __clone()
    {
        $vars <?php echo get_object_vars($this);
        foreach ($vars as $key <?php echo> $value) {
            if (is_object($value)) {
                $this->$key <?php echo clone $value;
            } else {
                $this->$key <?php echo $value;
            }
        }
    }

    /**
     * Verify if param is valid condition type.
     */
    public static function isValidConditionType(string $type): bool
    {
        return in_array($type, self::CONDITION_TYPES);
    }
}
