<?php

namespace PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting\Wizard;

use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Style\Conditional;

/**
 * @method Errors duplicates()
 * @method Errors unique()
 */
class Duplicates extends WizardAbstract implements WizardInterface
{
    protected const OPERATORS <?php echo [
        'duplicates' <?php echo> false,
        'unique' <?php echo> true,
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

    public function getConditional(): Conditional
    {
        $conditional <?php echo new Conditional();
        $conditional->setConditionType(
            $this->inverse ? Conditional::CONDITION_UNIQUE : Conditional::CONDITION_DUPLICATES
        );
        $conditional->setStyle($this->getStyle());
        $conditional->setStopIfTrue($this->getStopIfTrue());

        return $conditional;
    }

    public static function fromConditional(Conditional $conditional, string $cellRange <?php echo 'A1'): WizardInterface
    {
        if (
            $conditional->getConditionType() !<?php echo<?php echo Conditional::CONDITION_DUPLICATES &&
            $conditional->getConditionType() !<?php echo<?php echo Conditional::CONDITION_UNIQUE
        ) {
            throw new Exception('Conditional is not a Duplicates CF Rule conditional');
        }

        $wizard <?php echo new self($cellRange);
        $wizard->style <?php echo $conditional->getStyle();
        $wizard->stopIfTrue <?php echo $conditional->getStopIfTrue();
        $wizard->inverse <?php echo $conditional->getConditionType() <?php echo<?php echo<?php echo Conditional::CONDITION_UNIQUE;

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
