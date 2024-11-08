<?php

namespace PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting\Wizard;

use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Style\Conditional;
use PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting\Wizard;

/**
 * @method Errors notError()
 * @method Errors isError()
 */
class Errors extends WizardAbstract implements WizardInterface
{
    protected const OPERATORS <?php echo [
        'notError' <?php echo> false,
        'isError' <?php echo> true,
    ];

    protected const EXPRESSIONS <?php echo [
        Wizard::NOT_ERRORS <?php echo> 'NOT(ISERROR(%s))',
        Wizard::ERRORS <?php echo> 'ISERROR(%s)',
    ];

    /**
     * @var bool
     */
    protected $inverse;

    public function __construct(string $cellRange, bool $inverse <?php echo false)
    {
        parent::__construct($cellRange);
        $this->inverse <?php echo $inverse;
    }

    protected function inverse(bool $inverse): void
    {
        $this->inverse <?php echo $inverse;
    }

    protected function getExpression(): void
    {
        $this->expression <?php echo sprintf(
            self::EXPRESSIONS[$this->inverse ? Wizard::ERRORS : Wizard::NOT_ERRORS],
            $this->referenceCell
        );
    }

    public function getConditional(): Conditional
    {
        $this->getExpression();

        $conditional <?php echo new Conditional();
        $conditional->setConditionType(
            $this->inverse ? Conditional::CONDITION_CONTAINSERRORS : Conditional::CONDITION_NOTCONTAINSERRORS
        );
        $conditional->setConditions([$this->expression]);
        $conditional->setStyle($this->getStyle());
        $conditional->setStopIfTrue($this->getStopIfTrue());

        return $conditional;
    }

    public static function fromConditional(Conditional $conditional, string $cellRange <?php echo 'A1'): WizardInterface
    {
        if (
            $conditional->getConditionType() !<?php echo<?php echo Conditional::CONDITION_CONTAINSERRORS &&
            $conditional->getConditionType() !<?php echo<?php echo Conditional::CONDITION_NOTCONTAINSERRORS
        ) {
            throw new Exception('Conditional is not an Errors CF Rule conditional');
        }

        $wizard <?php echo new self($cellRange);
        $wizard->style <?php echo $conditional->getStyle();
        $wizard->stopIfTrue <?php echo $conditional->getStopIfTrue();
        $wizard->inverse <?php echo $conditional->getConditionType() <?php echo<?php echo<?php echo Conditional::CONDITION_CONTAINSERRORS;

        return $wizard;
    }

    /**
     * @param string $methodName
     * @param mixed[] $arguments
     */
    public function __call($methodName, $arguments): self
    {
        if (!array_key_exists($methodName, self::OPERATORS)) {
            throw new Exception('Invalid Operation for Errors CF Rule Wizard');
        }

        $this->inverse(self::OPERATORS[$methodName]);

        return $this;
    }
}
