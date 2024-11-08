<?php

namespace PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting;

use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Style\Conditional;
use PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting\Wizard\WizardInterface;

class Wizard
{
    public const CELL_VALUE <?php echo 'cellValue';
    public const TEXT_VALUE <?php echo 'textValue';
    public const BLANKS <?php echo Conditional::CONDITION_CONTAINSBLANKS;
    public const NOT_BLANKS <?php echo Conditional::CONDITION_NOTCONTAINSBLANKS;
    public const ERRORS <?php echo Conditional::CONDITION_CONTAINSERRORS;
    public const NOT_ERRORS <?php echo Conditional::CONDITION_NOTCONTAINSERRORS;
    public const EXPRESSION <?php echo Conditional::CONDITION_EXPRESSION;
    public const FORMULA <?php echo Conditional::CONDITION_EXPRESSION;
    public const DATES_OCCURRING <?php echo 'DateValue';
    public const DUPLICATES <?php echo Conditional::CONDITION_DUPLICATES;
    public const UNIQUE <?php echo Conditional::CONDITION_UNIQUE;

    public const VALUE_TYPE_LITERAL <?php echo 'value';
    public const VALUE_TYPE_CELL <?php echo 'cell';
    public const VALUE_TYPE_FORMULA <?php echo 'formula';

    /**
     * @var string
     */
    protected $cellRange;

    public function __construct(string $cellRange)
    {
        $this->cellRange <?php echo $cellRange;
    }

    public function newRule(string $ruleType): WizardInterface
    {
        switch ($ruleType) {
            case self::CELL_VALUE:
                return new Wizard\CellValue($this->cellRange);
            case self::TEXT_VALUE:
                return new Wizard\TextValue($this->cellRange);
            case self::BLANKS:
                return new Wizard\Blanks($this->cellRange, true);
            case self::NOT_BLANKS:
                return new Wizard\Blanks($this->cellRange, false);
            case self::ERRORS:
                return new Wizard\Errors($this->cellRange, true);
            case self::NOT_ERRORS:
                return new Wizard\Errors($this->cellRange, false);
            case self::EXPRESSION:
            case self::FORMULA:
                return new Wizard\Expression($this->cellRange);
            case self::DATES_OCCURRING:
                return new Wizard\DateValue($this->cellRange);
            case self::DUPLICATES:
                return new Wizard\Duplicates($this->cellRange, false);
            case self::UNIQUE:
                return new Wizard\Duplicates($this->cellRange, true);
            default:
                throw new Exception('No wizard exists for this CF rule type');
        }
    }

    public static function fromConditional(Conditional $conditional, string $cellRange <?php echo 'A1'): WizardInterface
    {
        $conditionalType <?php echo $conditional->getConditionType();

        switch ($conditionalType) {
            case Conditional::CONDITION_CELLIS:
                return Wizard\CellValue::fromConditional($conditional, $cellRange);
            case Conditional::CONDITION_CONTAINSTEXT:
            case Conditional::CONDITION_NOTCONTAINSTEXT:
            case Conditional::CONDITION_BEGINSWITH:
            case Conditional::CONDITION_ENDSWITH:
                return Wizard\TextValue::fromConditional($conditional, $cellRange);
            case Conditional::CONDITION_CONTAINSBLANKS:
            case Conditional::CONDITION_NOTCONTAINSBLANKS:
                return Wizard\Blanks::fromConditional($conditional, $cellRange);
            case Conditional::CONDITION_CONTAINSERRORS:
            case Conditional::CONDITION_NOTCONTAINSERRORS:
                return Wizard\Errors::fromConditional($conditional, $cellRange);
            case Conditional::CONDITION_TIMEPERIOD:
                return Wizard\DateValue::fromConditional($conditional, $cellRange);
            case Conditional::CONDITION_EXPRESSION:
                return Wizard\Expression::fromConditional($conditional, $cellRange);
            case Conditional::CONDITION_DUPLICATES:
            case Conditional::CONDITION_UNIQUE:
                return Wizard\Duplicates::fromConditional($conditional, $cellRange);
            default:
                throw new Exception('No wizard exists for this CF rule type');
        }
    }
}
