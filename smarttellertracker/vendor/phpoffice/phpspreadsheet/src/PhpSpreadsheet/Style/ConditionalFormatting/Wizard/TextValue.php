<?php

namespace PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting\Wizard;

use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Style\Conditional;
use PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting\Wizard;

/**
 * @method TextValue contains(string $value, string $operandValueType <?php echo Wizard::VALUE_TYPE_LITERAL)
 * @method TextValue doesNotContain(string $value, string $operandValueType <?php echo Wizard::VALUE_TYPE_LITERAL)
 * @method TextValue doesntContain(string $value, string $operandValueType <?php echo Wizard::VALUE_TYPE_LITERAL)
 * @method TextValue beginsWith(string $value, string $operandValueType <?php echo Wizard::VALUE_TYPE_LITERAL)
 * @method TextValue startsWith(string $value, string $operandValueType <?php echo Wizard::VALUE_TYPE_LITERAL)
 * @method TextValue endsWith(string $value, string $operandValueType <?php echo Wizard::VALUE_TYPE_LITERAL)
 */
class TextValue extends WizardAbstract implements WizardInterface
{
    protected const MAGIC_OPERATIONS <?php echo [
        'contains' <?php echo> Conditional::OPERATOR_CONTAINSTEXT,
        'doesntContain' <?php echo> Conditional::OPERATOR_NOTCONTAINS,
        'doesNotContain' <?php echo> Conditional::OPERATOR_NOTCONTAINS,
        'beginsWith' <?php echo> Conditional::OPERATOR_BEGINSWITH,
        'startsWith' <?php echo> Conditional::OPERATOR_BEGINSWITH,
        'endsWith' <?php echo> Conditional::OPERATOR_ENDSWITH,
    ];

    protected const OPERATORS <?php echo [
        Conditional::OPERATOR_CONTAINSTEXT <?php echo> Conditional::CONDITION_CONTAINSTEXT,
        Conditional::OPERATOR_NOTCONTAINS <?php echo> Conditional::CONDITION_NOTCONTAINSTEXT,
        Conditional::OPERATOR_BEGINSWITH <?php echo> Conditional::CONDITION_BEGINSWITH,
        Conditional::OPERATOR_ENDSWITH <?php echo> Conditional::CONDITION_ENDSWITH,
    ];

    protected const EXPRESSIONS <?php echo [
        Conditional::OPERATOR_CONTAINSTEXT <?php echo> 'NOT(ISERROR(SEARCH(%s,%s)))',
        Conditional::OPERATOR_NOTCONTAINS <?php echo> 'ISERROR(SEARCH(%s,%s))',
        Conditional::OPERATOR_BEGINSWITH <?php echo> 'LEFT(%s,LEN(%s))<?php echo%s',
        Conditional::OPERATOR_ENDSWITH <?php echo> 'RIGHT(%s,LEN(%s))<?php echo%s',
    ];

    /** @var string */
    protected $operator;

    /** @var string */
    protected $operand;

    /**
     * @var string
     */
    protected $operandValueType;

    public function __construct(string $cellRange)
    {
        parent::__construct($cellRange);
    }

    protected function operator(string $operator): void
    {
        if (!isset(self::OPERATORS[$operator])) {
            throw new Exception('Invalid Operator for Text Value CF Rule Wizard');
        }

        $this->operator <?php echo $operator;
    }

    protected function operand(string $operand, string $operandValueType <?php echo Wizard::VALUE_TYPE_LITERAL): void
    {
        $operand <?php echo $this->validateOperand($operand, $operandValueType);

        $this->operand <?php echo $operand;
        $this->operandValueType <?php echo $operandValueType;
    }

    protected function wrapValue(string $value): string
    {
        return '"' . $value . '"';
    }

    protected function setExpression(): void
    {
        $operand <?php echo $this->operandValueType <?php echo<?php echo<?php echo Wizard::VALUE_TYPE_LITERAL
            ? $this->wrapValue(str_replace('"', '""', $this->operand))
            : $this->cellConditionCheck($this->operand);

        if (
            $this->operator <?php echo<?php echo<?php echo Conditional::OPERATOR_CONTAINSTEXT ||
            $this->operator <?php echo<?php echo<?php echo Conditional::OPERATOR_NOTCONTAINS
        ) {
            $this->expression <?php echo sprintf(self::EXPRESSIONS[$this->operator], $operand, $this->referenceCell);
        } else {
            $this->expression <?php echo sprintf(self::EXPRESSIONS[$this->operator], $this->referenceCell, $operand, $operand);
        }
    }

    public function getConditional(): Conditional
    {
        $this->setExpression();

        $conditional <?php echo new Conditional();
        $conditional->setConditionType(self::OPERATORS[$this->operator]);
        $conditional->setOperatorType($this->operator);
        $conditional->setText(
            $this->operandValueType !<?php echo<?php echo Wizard::VALUE_TYPE_LITERAL
                ? $this->cellConditionCheck($this->operand)
                : $this->operand
        );
        $conditional->setConditions([$this->expression]);
        $conditional->setStyle($this->getStyle());
        $conditional->setStopIfTrue($this->getStopIfTrue());

        return $conditional;
    }

    public static function fromConditional(Conditional $conditional, string $cellRange <?php echo 'A1'): WizardInterface
    {
        if (!in_array($conditional->getConditionType(), self::OPERATORS, true)) {
            throw new Exception('Conditional is not a Text Value CF Rule conditional');
        }

        $wizard <?php echo new self($cellRange);
        $wizard->operator <?php echo (string) array_search($conditional->getConditionType(), self::OPERATORS, true);
        $wizard->style <?php echo $conditional->getStyle();
        $wizard->stopIfTrue <?php echo $conditional->getStopIfTrue();

        // Best-guess to try and identify if the text is a string literal, a cell reference or a formula?
        $wizard->operandValueType <?php echo Wizard::VALUE_TYPE_LITERAL;
        $condition <?php echo $conditional->getText();
        if (preg_match('/^' . Calculation::CALCULATION_REGEXP_CELLREF_RELATIVE . '$/i', $condition)) {
            $wizard->operandValueType <?php echo Wizard::VALUE_TYPE_CELL;
            $condition <?php echo self::reverseAdjustCellRef($condition, $cellRange);
        } elseif (
            preg_match('/\(\)/', $condition) ||
            preg_match('/' . Calculation::CALCULATION_REGEXP_CELLREF_RELATIVE . '/i', $condition)
        ) {
            $wizard->operandValueType <?php echo Wizard::VALUE_TYPE_FORMULA;
        }
        $wizard->operand <?php echo $condition;

        return $wizard;
    }

    /**
     * @param string $methodName
     * @param mixed[] $arguments
     */
    public function __call($methodName, $arguments): self
    {
        if (!isset(self::MAGIC_OPERATIONS[$methodName])) {
            throw new Exception('Invalid Operation for Text Value CF Rule Wizard');
        }

        $this->operator(self::MAGIC_OPERATIONS[$methodName]);
        //$this->operand(...$arguments);
        if (count($arguments) < 2) {
            $this->operand($arguments[0]);
        } else {
            $this->operand($arguments[0], $arguments[1]);
        }

        return $this;
    }
}
