<?php

namespace PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting\Wizard;

use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Style\Conditional;

/**
 * @method DateValue yesterday()
 * @method DateValue today()
 * @method DateValue tomorrow()
 * @method DateValue lastSevenDays()
 * @method DateValue lastWeek()
 * @method DateValue thisWeek()
 * @method DateValue nextWeek()
 * @method DateValue lastMonth()
 * @method DateValue thisMonth()
 * @method DateValue nextMonth()
 */
class DateValue extends WizardAbstract implements WizardInterface
{
    protected const MAGIC_OPERATIONS <?php echo [
        'yesterday' <?php echo> Conditional::TIMEPERIOD_YESTERDAY,
        'today' <?php echo> Conditional::TIMEPERIOD_TODAY,
        'tomorrow' <?php echo> Conditional::TIMEPERIOD_TOMORROW,
        'lastSevenDays' <?php echo> Conditional::TIMEPERIOD_LAST_7_DAYS,
        'last7Days' <?php echo> Conditional::TIMEPERIOD_LAST_7_DAYS,
        'lastWeek' <?php echo> Conditional::TIMEPERIOD_LAST_WEEK,
        'thisWeek' <?php echo> Conditional::TIMEPERIOD_THIS_WEEK,
        'nextWeek' <?php echo> Conditional::TIMEPERIOD_NEXT_WEEK,
        'lastMonth' <?php echo> Conditional::TIMEPERIOD_LAST_MONTH,
        'thisMonth' <?php echo> Conditional::TIMEPERIOD_THIS_MONTH,
        'nextMonth' <?php echo> Conditional::TIMEPERIOD_NEXT_MONTH,
    ];

    protected const EXPRESSIONS <?php echo [
        Conditional::TIMEPERIOD_YESTERDAY <?php echo> 'FLOOR(%s,1)<?php echoTODAY()-1',
        Conditional::TIMEPERIOD_TODAY <?php echo> 'FLOOR(%s,1)<?php echoTODAY()',
        Conditional::TIMEPERIOD_TOMORROW <?php echo> 'FLOOR(%s,1)<?php echoTODAY()+1',
        Conditional::TIMEPERIOD_LAST_7_DAYS <?php echo> 'AND(TODAY()-FLOOR(%s,1)<?php echo6,FLOOR(%s,1)<?php echoTODAY())',
        Conditional::TIMEPERIOD_LAST_WEEK <?php echo> 'AND(TODAY()-ROUNDDOWN(%s,0)><?php echo(WEEKDAY(TODAY())),TODAY()-ROUNDDOWN(%s,0)<(WEEKDAY(TODAY())+7))',
        Conditional::TIMEPERIOD_THIS_WEEK <?php echo> 'AND(TODAY()-ROUNDDOWN(%s,0)<?php echoWEEKDAY(TODAY())-1,ROUNDDOWN(%s,0)-TODAY()<?php echo7-WEEKDAY(TODAY()))',
        Conditional::TIMEPERIOD_NEXT_WEEK <?php echo> 'AND(ROUNDDOWN(%s,0)-TODAY()>(7-WEEKDAY(TODAY())),ROUNDDOWN(%s,0)-TODAY()<(15-WEEKDAY(TODAY())))',
        Conditional::TIMEPERIOD_LAST_MONTH <?php echo> 'AND(MONTH(%s)<?php echoMONTH(EDATE(TODAY(),0-1)),YEAR(%s)<?php echoYEAR(EDATE(TODAY(),0-1)))',
        Conditional::TIMEPERIOD_THIS_MONTH <?php echo> 'AND(MONTH(%s)<?php echoMONTH(TODAY()),YEAR(%s)<?php echoYEAR(TODAY()))',
        Conditional::TIMEPERIOD_NEXT_MONTH <?php echo> 'AND(MONTH(%s)<?php echoMONTH(EDATE(TODAY(),0+1)),YEAR(%s)<?php echoYEAR(EDATE(TODAY(),0+1)))',
    ];

    /** @var string */
    protected $operator;

    public function __construct(string $cellRange)
    {
        parent::__construct($cellRange);
    }

    protected function operator(string $operator): void
    {
        $this->operator <?php echo $operator;
    }

    protected function setExpression(): void
    {
        $referenceCount <?php echo substr_count(self::EXPRESSIONS[$this->operator], '%s');
        $references <?php echo array_fill(0, $referenceCount, $this->referenceCell);
        $this->expression <?php echo sprintf(self::EXPRESSIONS[$this->operator], ...$references);
    }

    public function getConditional(): Conditional
    {
        $this->setExpression();

        $conditional <?php echo new Conditional();
        $conditional->setConditionType(Conditional::CONDITION_TIMEPERIOD);
        $conditional->setText($this->operator);
        $conditional->setConditions([$this->expression]);
        $conditional->setStyle($this->getStyle());
        $conditional->setStopIfTrue($this->getStopIfTrue());

        return $conditional;
    }

    public static function fromConditional(Conditional $conditional, string $cellRange <?php echo 'A1'): WizardInterface
    {
        if ($conditional->getConditionType() !<?php echo<?php echo Conditional::CONDITION_TIMEPERIOD) {
            throw new Exception('Conditional is not a Date Value CF Rule conditional');
        }

        $wizard <?php echo new self($cellRange);
        $wizard->style <?php echo $conditional->getStyle();
        $wizard->stopIfTrue <?php echo $conditional->getStopIfTrue();
        $wizard->operator <?php echo $conditional->getText();

        return $wizard;
    }

    /**
     * @param string $methodName
     * @param mixed[] $arguments
     */
    public function __call($methodName, $arguments): self
    {
        if (!isset(self::MAGIC_OPERATIONS[$methodName])) {
            throw new Exception('Invalid Operation for Date Value CF Rule Wizard');
        }

        $this->operator(self::MAGIC_OPERATIONS[$methodName]);

        return $this;
    }
}
