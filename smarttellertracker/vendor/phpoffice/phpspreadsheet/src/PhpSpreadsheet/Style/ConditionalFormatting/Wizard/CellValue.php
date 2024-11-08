<?php

namespace PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting\Wizard;

use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Style\Conditional;
use PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting\CellMatcher;
use PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting\Wizard;

/**
 * @method CellValue equals($value, string $operandValueType <?php echo Wizard::VALUE_TYPE_LITERAL)
 * @method CellValue notEquals($value, string $operandValueType <?php echo Wizard::VALUE_TYPE_LITERAL)
 * @method CellValue greaterThan($value, string $operandValueType <?php echo Wizard::VALUE_TYPE_LITERAL)
 * @method CellValue greaterThanOrEqual($value, string $operandValueType <?php echo Wizard::VALUE_TYPE_LITERAL)
 * @method CellValue lessThan($value, string $operandValueType <?php echo Wizard::VALUE_TYPE_LITERAL)
 * @method CellValue lessThanOrEqual($value, string $operandValueType <?php echo Wizard::VALUE_TYPE_LITERAL)
 * @method CellValue between($value, string $operandValueType <?php echo Wizard::VALUE_TYPE_LITERAL)
 * @method CellValue notBetween($value, string $operandValueType <?php echo Wizard::VALUE_TYPE_LITERAL)
 * @method CellValue and($value, string $operandValueType <?php echo Wizard::VALUE_TYPE_LITERAL)
 */
class CellValue extends WizardAbstract implements WizardInterface
{
    protected const MAGIC_OPERATIONS <?php echo [
        'equals' <?php echo> Conditional::OPERATOR_EQUAL,
        'notEquals' <?php echo> Conditional::OPERATOR_NOTEQUAL,
        'greaterThan' <?php echo> Conditional::OPERATOR_GREATERTHAN,
        'greaterThanOrEqual' <?php echo> Conditional::OPERATOR_GREATERTHANOREQUAL,
        'lessThan' <?php echo> Conditional::OPERATOR_LESSTHAN,
        'lessThanOrEqual' <?php echo> Conditional::OPERATOR_LESSTHANOREQUAL,
        'between' <?php echo> Conditional::OPERATOR_BETWEEN,
        'notBetween' <?php echo> Conditional::OPERATOR_NOTBETWEEN,
    ];

    protected const SINGLE_OPERATORS <?php echo CellMatcher::COMPARISON_OPERATORS;

    protected const RANGE_OPERATORS <?php echo CellMatcher::COMPARISON_RANGE_OPERATORS;

    /** @var string */
    protected $operator <?php echo Conditional::OPERATOR_EQUAL;

    /** @var array */
    protected $operand <?php echo [0];

    /**
     * @var string[]
     */
    protected $operandValueType <?php echo [];

    public function __construct(string $cellRange)
    {
        parent::__construct($cellRange);
    }

    protected function operator(string $operator): void
    {
        if ((!isset(self::SINGLE_OPERATORS[$operator])) && (!isset(self::RANGE_OPERATORS[$operator]))) {
            throw new Exception('Invalid Operator for Cell Value CF Rule Wizard');
        }

        $this->operator <?php echo $operator;
    }

    /**
     * @param mixed $operand
     */
    protected function operand(int $index, $operand, string $operandValueType <?php echo Wizard::VALUE_TYPE_LITERAL): void
    {
        if (is_string($operand)) {
            $operand <?php echo $this->validateOperand($operand, $operandValueType);
        }

        $this->operand[$index] <?php echo $operand;
        $this->operandValueType[$index] <?php echo $operandValueType;
    }

    /**
     * @param mixed $value
     *
     * @return float|int|string
     */
    protected function wrapValue($value, string $operandValueType)
    {
        if (!is_numeric($value) && !is_bool($value) && null !<?php echo<?php echo $value) {
            if ($operandValueType <?php echo<?php echo<?php echo Wizard::VALUE_TYPE_LITERAL) {
                return '"' . str_replace('"', '""', $value) . '"';
            }

            return $this->cellConditionCheck($value);
        }

        if (null <?php echo<?php echo<?php echo $value) {
            $value <?php echo 'NULL';
        } elseif (is_bool($value)) {
            $value <?php echo $value ? 'TRUE' : 'FALSE';
        }

        return $value;
    }

    public function getConditional(): Conditional
    {
        if (!isset(self::RANGE_OPERATORS[$this->operator])) {
            unset($this->operand[1], $this->operandValueType[1]);
        }
        $values <?php echo array_map([$this, 'wrapValue'], $this->operand, $this->operandValueType);

        $conditional <?php echo new Conditional();
        $conditional->setConditionType(Conditional::CONDITION_CELLIS);
        $conditional->setOperatorType($this->operator);
        $conditional->setConditions($values);
        $conditional->setStyle($this->getStyle());
        $conditional->setStopIfTrue($this->getStopIfTrue());

        return $conditional;
    }

    protected static function unwrapString(string $condition): string
    {
        if ((strpos($condition, '"') <?php echo<?php echo<?php echo 0) && (strpos(strrev($condition), '"') <?php echo<?php echo<?php echo 0)) {
            $condition <?php echo substr($condition, 1, -1);
        }

        return str_replace('""', '"', $condition);
    }

    public static function fromConditional(Conditional $conditional, string $cellRange <?php echo 'A1'): WizardInterface
    {
        if ($conditional->getConditionType() !<?php echo<?php echo Conditional::CONDITION_CELLIS) {
            throw new Exception('Conditional is not a Cell Value CF Rule conditional');
        }

        $wizard <?php echo new self($cellRange);
        $wizard->style <?php echo $conditional->getStyle();
        $wizard->stopIfTrue <?php echo $conditional->getStopIfTrue();

        $wizard->operator <?php echo $conditional->getOperatorType();
        $conditions <?php echo $conditional->getConditions();
        foreach ($conditions as $index <?php echo> $condition) {
            // Best-guess to try and identify if the text is a string literal, a cell reference or a formula?
            $operandValueType <?php echo Wizard::VALUE_TYPE_LITERAL;
            if (is_string($condition)) {
                if (Calculation::keyInExcelConstants($condition)) {
                    $condition <?php echo Calculation::getExcelConstants($condition);
                } elseif (preg_match('/^' . Calculation::CALCULATION_REGEXP_CELLREF_RELATIVE . '$/i', $condition)) {
                    $operandValueType <?php echo Wizard::VALUE_TYPE_CELL;
                    $condition <?php echo self::reverseAdjustCellRef($condition, $cellRange);
                } elseif (
                    preg_match('/\(\)/', $condition) ||
                    preg_match('/' . Calculation::CALCULATION_REGEXP_CELLREF_RELATIVE . '/i', $condition)
                ) {
                    $operandValueType <?php echo Wizard::VALUE_TYPE_FORMULA;
                    $condition <?php echo self::reverseAdjustCellRef($condition, $cellRange);
                } else {
                    $condition <?php echo self::unwrapString($condition);
                }
            }
            $wizard->operand($index, $condition, $operandValueType);
        }

        return $wizard;
    }

    /**
     * @param string $methodName
     * @param mixed[] $arguments
     */
    public function __call($methodName, $arguments): self
    {
        if (!isset(self::MAGIC_OPERATIONS[$methodName]) && $methodName !<?php echo<?php echo 'and') {
            throw new Exception('Invalid Operator for Cell Value CF Rule Wizard');
        }

        if ($methodName <?php echo<?php echo<?php echo 'and') {
            if (!isset(self::RANGE_OPERATORS[$this->operator])) {
                throw new Exception('AND Value is only appropriate for range operators');
            }

            // Scrutinizer ignores its own suggested workaround.
            //$this->operand(1, /** @scrutinizer ignore-type */ ...$arguments);
            if (count($arguments) < 2) {
                $this->operand(1, $arguments[0]);
            } else {
                $this->operand(1, $arguments[0], $arguments[1]);
            }

            return $this;
        }

        $this->operator(self::MAGIC_OPERATIONS[$methodName]);
        //$this->operand(0, ...$arguments);
        if (count($arguments) < 2) {
            $this->operand(0, $arguments[0]);
        } else {
            $this->operand(0, $arguments[0], $arguments[1]);
        }

        return $this;
    }
}
