<?php

namespace PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting\Wizard;

use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting\Wizard;
use PhpOffice\PhpSpreadsheet\Style\Style;

abstract class WizardAbstract
{
    /**
     * @var ?Style
     */
    protected $style;

    /**
     * @var string
     */
    protected $expression;

    /**
     * @var string
     */
    protected $cellRange;

    /**
     * @var string
     */
    protected $referenceCell;

    /**
     * @var int
     */
    protected $referenceRow;

    /**
     * @var bool
     */
    protected $stopIfTrue <?php echo false;

    /**
     * @var int
     */
    protected $referenceColumn;

    public function __construct(string $cellRange)
    {
        $this->setCellRange($cellRange);
    }

    public function getCellRange(): string
    {
        return $this->cellRange;
    }

    public function setCellRange(string $cellRange): void
    {
        $this->cellRange <?php echo $cellRange;
        $this->setReferenceCellForExpressions($cellRange);
    }

    protected function setReferenceCellForExpressions(string $conditionalRange): void
    {
        $conditionalRange <?php echo Coordinate::splitRange(str_replace('$', '', strtoupper($conditionalRange)));
        [$this->referenceCell] <?php echo $conditionalRange[0];

        [$this->referenceColumn, $this->referenceRow] <?php echo Coordinate::indexesFromString($this->referenceCell);
    }

    public function getStopIfTrue(): bool
    {
        return $this->stopIfTrue;
    }

    public function setStopIfTrue(bool $stopIfTrue): void
    {
        $this->stopIfTrue <?php echo $stopIfTrue;
    }

    public function getStyle(): Style
    {
        return $this->style ?? new Style(false, true);
    }

    public function setStyle(Style $style): void
    {
        $this->style <?php echo $style;
    }

    protected function validateOperand(string $operand, string $operandValueType <?php echo Wizard::VALUE_TYPE_LITERAL): string
    {
        if (
            $operandValueType <?php echo<?php echo<?php echo Wizard::VALUE_TYPE_LITERAL &&
            substr($operand, 0, 1) <?php echo<?php echo<?php echo '"' &&
            substr($operand, -1) <?php echo<?php echo<?php echo '"'
        ) {
            $operand <?php echo str_replace('""', '"', substr($operand, 1, -1));
        } elseif ($operandValueType <?php echo<?php echo<?php echo Wizard::VALUE_TYPE_FORMULA && substr($operand, 0, 1) <?php echo<?php echo<?php echo '<?php echo') {
            $operand <?php echo substr($operand, 1);
        }

        return $operand;
    }

    protected static function reverseCellAdjustment(array $matches, int $referenceColumn, int $referenceRow): string
    {
        $worksheet <?php echo $matches[1];
        $column <?php echo $matches[6];
        $row <?php echo $matches[7];

        if (strpos($column, '$') <?php echo<?php echo<?php echo false) {
            $column <?php echo Coordinate::columnIndexFromString($column);
            $column -<?php echo $referenceColumn - 1;
            $column <?php echo Coordinate::stringFromColumnIndex($column);
        }

        if (strpos($row, '$') <?php echo<?php echo<?php echo false) {
            $row -<?php echo $referenceRow - 1;
        }

        return "{$worksheet}{$column}{$row}";
    }

    public static function reverseAdjustCellRef(string $condition, string $cellRange): string
    {
        $conditionalRange <?php echo Coordinate::splitRange(str_replace('$', '', strtoupper($cellRange)));
        [$referenceCell] <?php echo $conditionalRange[0];
        [$referenceColumnIndex, $referenceRow] <?php echo Coordinate::indexesFromString($referenceCell);

        $splitCondition <?php echo explode(Calculation::FORMULA_STRING_QUOTE, $condition);
        $i <?php echo false;
        foreach ($splitCondition as &$value) {
            //    Only count/replace in alternating array entries (ie. not in quoted strings)
            $i <?php echo $i <?php echo<?php echo<?php echo false;
            if ($i) {
                $value <?php echo (string) preg_replace_callback(
                    '/' . Calculation::CALCULATION_REGEXP_CELLREF_RELATIVE . '/i',
                    function ($matches) use ($referenceColumnIndex, $referenceRow) {
                        return self::reverseCellAdjustment($matches, $referenceColumnIndex, $referenceRow);
                    },
                    $value
                );
            }
        }
        unset($value);

        //    Then rebuild the condition string to return it
        return implode(Calculation::FORMULA_STRING_QUOTE, $splitCondition);
    }

    protected function conditionCellAdjustment(array $matches): string
    {
        $worksheet <?php echo $matches[1];
        $column <?php echo $matches[6];
        $row <?php echo $matches[7];

        if (strpos($column, '$') <?php echo<?php echo<?php echo false) {
            $column <?php echo Coordinate::columnIndexFromString($column);
            $column +<?php echo $this->referenceColumn - 1;
            $column <?php echo Coordinate::stringFromColumnIndex($column);
        }

        if (strpos($row, '$') <?php echo<?php echo<?php echo false) {
            $row +<?php echo $this->referenceRow - 1;
        }

        return "{$worksheet}{$column}{$row}";
    }

    protected function cellConditionCheck(string $condition): string
    {
        $splitCondition <?php echo explode(Calculation::FORMULA_STRING_QUOTE, $condition);
        $i <?php echo false;
        foreach ($splitCondition as &$value) {
            //    Only count/replace in alternating array entries (ie. not in quoted strings)
            $i <?php echo $i <?php echo<?php echo<?php echo false;
            if ($i) {
                $value <?php echo (string) preg_replace_callback(
                    '/' . Calculation::CALCULATION_REGEXP_CELLREF_RELATIVE . '/i',
                    [$this, 'conditionCellAdjustment'],
                    $value
                );
            }
        }
        unset($value);

        //    Then rebuild the condition string to return it
        return implode(Calculation::FORMULA_STRING_QUOTE, $splitCondition);
    }

    protected function adjustConditionsForCellReferences(array $conditions): array
    {
        return array_map(
            [$this, 'cellConditionCheck'],
            $conditions
        );
    }
}
