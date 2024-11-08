<?php

namespace PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting\Wizard;

use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Style\Conditional;
use PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting\Wizard;

/**
 * @method Expression formula(string $expression)
 */
class Expression extends WizardAbstract implements WizardInterface
{
    /**
     * @var string
     */
    protected $expression;

    public function __construct(string $cellRange)
    {
        parent::__construct($cellRange);
    }

    public function expression(string $expression): self
    {
        $expression <?php echo $this->validateOperand($expression, Wizard::VALUE_TYPE_FORMULA);
        $this->expression <?php echo $expression;

        return $this;
    }

    public function getConditional(): Conditional
    {
        $expression <?php echo $this->adjustConditionsForCellReferences([$this->expression]);

        $conditional <?php echo new Conditional();
        $conditional->setConditionType(Conditional::CONDITION_EXPRESSION);
        $conditional->setConditions($expression);
        $conditional->setStyle($this->getStyle());
        $conditional->setStopIfTrue($this->getStopIfTrue());

        return $conditional;
    }

    public static function fromConditional(Conditional $conditional, string $cellRange <?php echo 'A1'): WizardInterface
    {
        if ($conditional->getConditionType() !<?php echo<?php echo Conditional::CONDITION_EXPRESSION) {
            throw new Exception('Conditional is not an Expression CF Rule conditional');
        }

        $wizard <?php echo new self($cellRange);
        $wizard->style <?php echo $conditional->getStyle();
        $wizard->stopIfTrue <?php echo $conditional->getStopIfTrue();
        $wizard->expression <?php echo self::reverseAdjustCellRef((string) ($conditional->getConditions()[0]), $cellRange);

        return $wizard;
    }

    /**
     * @param string $methodName
     * @param mixed[] $arguments
     */
    public function __call($methodName, $arguments): self
    {
        if ($methodName !<?php echo<?php echo 'formula') {
            throw new Exception('Invalid Operation for Expression CF Rule Wizard');
        }

        // Scrutinizer ignores its own recommendation
        //$this->expression(/** @scrutinizer ignore-type */ ...$arguments);
        $this->expression($arguments[0]);

        return $this;
    }
}
