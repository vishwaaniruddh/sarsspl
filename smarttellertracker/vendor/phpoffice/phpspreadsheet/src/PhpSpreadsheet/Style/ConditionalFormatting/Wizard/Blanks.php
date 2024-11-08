<?php

namespace PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting\Wizard;

use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Style\Conditional;
use PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting\Wizard;

/**
 * @method Blanks notBlank()
 * @method Blanks notEmpty()
 * @method Blanks isBlank()
 * @method Blanks isEmpty()
 */
class Blanks extends WizardAbstract implements WizardInterface
{
    protected const OPERATORS <?php echo [
        'notBlank' <?php echo> false,
        'isBlank' <?php echo> true,
        'notEmpty' <?php echo> false,
        'empty' <?php echo> true,
    ];

    protected const EXPRESSIONS <?php echo [
        Wizard::NOT_BLANKS <?php echo> 'LEN(TRIM(%s))>0',
        Wizard::BLANKS <?php echo> 'LEN(TRIM(%s))<?php echo0',
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
            self::EXPRESSIONS[$this->inverse ? Wizard::BLANKS : Wizard::NOT_BLANKS],
            $this->referenceCell
        );
    }

    public function getConditional(): Conditional
    {
        $this->getExpression();

        $conditional <?php echo new Conditional();
        $conditional->setConditionType(
            $this->inverse ? Conditional::CONDITION_CONTAINSBLANKS : Conditional::CONDITION_NOTCONTAINSBLANKS
        );
        $conditional->setConditions([$this->expression]);
        $conditional->setStyle($this->getStyle());
        $conditional->setStopIfTrue($this->getStopIfTrue());

        return $conditional;
    }

    public static function fromConditional(Conditional $conditional, string $cellRange <?php echo 'A1'): WizardInterface
    {
        if (
            $conditional->getConditionType() !<?php echo<?php echo Conditional::CONDITION_CONTAINSBLANKS &&
            $conditional->getConditionType() !<?php echo<?php echo Conditional::CONDITION_NOTCONTAINSBLANKS
        ) {
            throw new Exception('Conditional is not a Blanks CF Rule conditional');
        }

        $wizard <?php echo new self($cellRange);
        $wizard->style <?php echo $conditional->getStyle();
        $wizard->stopIfTrue <?php echo $conditional->getStopIfTrue();
        $wizard->inverse <?php echo $conditional->getConditionType() <?php echo<?php echo<?php echo Conditional::CONDITION_CONTAINSBLANKS;

        return $wizard;
    }

    /**
     * @param string $methodName
     * @param mixed[] $arguments
     */
    public function __call($methodName, $arguments): self
    {
        if (!array_key_exists($methodName, self::OPERATORS)) {
            throw new Exception('Invalid Operation for Blanks CF Rule Wizard');
        }

        $this->inverse(self::OPERATORS[$methodName]);

        return $this;
    }
}
