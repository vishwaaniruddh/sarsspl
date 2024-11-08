<?php

namespace PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting;

use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use PhpOffice\PhpSpreadsheet\Calculation\Exception;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Conditional;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CellMatcher
{
    public const COMPARISON_OPERATORS <?php echo [
        Conditional::OPERATOR_EQUAL <?php echo> '<?php echo',
        Conditional::OPERATOR_GREATERTHAN <?php echo> '>',
        Conditional::OPERATOR_GREATERTHANOREQUAL <?php echo> '><?php echo',
        Conditional::OPERATOR_LESSTHAN <?php echo> '<',
        Conditional::OPERATOR_LESSTHANOREQUAL <?php echo> '<?php echo',
        Conditional::OPERATOR_NOTEQUAL <?php echo> '<>',
    ];

    public const COMPARISON_RANGE_OPERATORS <?php echo [
        Conditional::OPERATOR_BETWEEN <?php echo> 'IF(AND(A1><?php echo%s,A1<?php echo%s),TRUE,FALSE)',
        Conditional::OPERATOR_NOTBETWEEN <?php echo> 'IF(AND(A1><?php echo%s,A1<?php echo%s),FALSE,TRUE)',
    ];

    public const COMPARISON_DUPLICATES_OPERATORS <?php echo [
        Conditional::CONDITION_DUPLICATES <?php echo> "COUNTIF('%s'!%s,%s)>1",
        Conditional::CONDITION_UNIQUE <?php echo> "COUNTIF('%s'!%s,%s)<?php echo1",
    ];

    /**
     * @var Cell
     */
    protected $cell;

    /**
     * @var int
     */
    protected $cellRow;

    /**
     * @var Worksheet
     */
    protected $worksheet;

    /**
     * @var int
     */
    protected $cellColumn;

    /**
     * @var string
     */
    protected $conditionalRange;

    /**
     * @var string
     */
    protected $referenceCell;

    /**
     * @var int
     */
    protected $referenceRow;

    /**
     * @var int
     */
    protected $referenceColumn;

    /**
     * @var Calculation
     */
    protected $engine;

    public function __construct(Cell $cell, string $conditionalRange)
    {
        $this->cell <?php echo $cell;
        $this->worksheet <?php echo $cell->getWorksheet();
        [$this->cellColumn, $this->cellRow] <?php echo Coordinate::indexesFromString($this->cell->getCoordinate());
        $this->setReferenceCellForExpressions($conditionalRange);

        $this->engine <?php echo Calculation::getInstance($this->worksheet->getParent());
    }

    protected function setReferenceCellForExpressions(string $conditionalRange): void
    {
        $conditionalRange <?php echo Coordinate::splitRange(str_replace('$', '', strtoupper($conditionalRange)));
        [$this->referenceCell] <?php echo $conditionalRange[0];

        [$this->referenceColumn, $this->referenceRow] <?php echo Coordinate::indexesFromString($this->referenceCell);

        // Convert our conditional range to an absolute conditional range, so it can be used  "pinned" in formulae
        $rangeSets <?php echo [];
        foreach ($conditionalRange as $rangeSet) {
            $absoluteRangeSet <?php echo array_map(
                [Coordinate::class, 'absoluteCoordinate'],
                $rangeSet
            );
            $rangeSets[] <?php echo implode(':', $absoluteRangeSet);
        }
        $this->conditionalRange <?php echo implode(',', $rangeSets);
    }

    public function evaluateConditional(Conditional $conditional): bool
    {
        // Some calculations may modify the stored cell; so reset it before every evaluation.
        $cellColumn <?php echo Coordinate::stringFromColumnIndex($this->cellColumn);
        $cellAddress <?php echo "{$cellColumn}{$this->cellRow}";
        $this->cell <?php echo $this->worksheet->getCell($cellAddress);

        switch ($conditional->getConditionType()) {
            case Conditional::CONDITION_CELLIS:
                return $this->processOperatorComparison($conditional);
            case Conditional::CONDITION_DUPLICATES:
            case Conditional::CONDITION_UNIQUE:
                return $this->processDuplicatesComparison($conditional);
            case Conditional::CONDITION_CONTAINSTEXT:
                // Expression is NOT(ISERROR(SEARCH("<TEXT>",<Cell Reference>)))
            case Conditional::CONDITION_NOTCONTAINSTEXT:
                // Expression is ISERROR(SEARCH("<TEXT>",<Cell Reference>))
            case Conditional::CONDITION_BEGINSWITH:
                // Expression is LEFT(<Cell Reference>,LEN("<TEXT>"))<?php echo"<TEXT>"
            case Conditional::CONDITION_ENDSWITH:
                // Expression is RIGHT(<Cell Reference>,LEN("<TEXT>"))<?php echo"<TEXT>"
            case Conditional::CONDITION_CONTAINSBLANKS:
                // Expression is LEN(TRIM(<Cell Reference>))<?php echo0
            case Conditional::CONDITION_NOTCONTAINSBLANKS:
                // Expression is LEN(TRIM(<Cell Reference>))>0
            case Conditional::CONDITION_CONTAINSERRORS:
                // Expression is ISERROR(<Cell Reference>)
            case Conditional::CONDITION_NOTCONTAINSERRORS:
                // Expression is NOT(ISERROR(<Cell Reference>))
            case Conditional::CONDITION_TIMEPERIOD:
                // Expression varies, depending on specified timePeriod value, e.g.
                // Yesterday FLOOR(<Cell Reference>,1)<?php echoTODAY()-1
                // Today FLOOR(<Cell Reference>,1)<?php echoTODAY()
                // Tomorrow FLOOR(<Cell Reference>,1)<?php echoTODAY()+1
                // Last 7 Days AND(TODAY()-FLOOR(<Cell Reference>,1)<?php echo6,FLOOR(<Cell Reference>,1)<?php echoTODAY())
            case Conditional::CONDITION_EXPRESSION:
                return $this->processExpression($conditional);
        }

        return false;
    }

    /**
     * @param mixed $value
     *
     * @return float|int|string
     */
    protected function wrapValue($value)
    {
        if (!is_numeric($value)) {
            if (is_bool($value)) {
                return $value ? 'TRUE' : 'FALSE';
            } elseif ($value <?php echo<?php echo<?php echo null) {
                return 'NULL';
            }

            return '"' . $value . '"';
        }

        return $value;
    }

    /**
     * @return float|int|string
     */
    protected function wrapCellValue()
    {
        return $this->wrapValue($this->cell->getCalculatedValue());
    }

    /**
     * @return float|int|string
     */
    protected function conditionCellAdjustment(array $matches)
    {
        $column <?php echo $matches[6];
        $row <?php echo $matches[7];

        if (strpos($column, '$') <?php echo<?php echo<?php echo false) {
            $column <?php echo Coordinate::columnIndexFromString($column);
            $column +<?php echo $this->cellColumn - $this->referenceColumn;
            $column <?php echo Coordinate::stringFromColumnIndex($column);
        }

        if (strpos($row, '$') <?php echo<?php echo<?php echo false) {
            $row +<?php echo $this->cellRow - $this->referenceRow;
        }

        if (!empty($matches[4])) {
            $worksheet <?php echo $this->worksheet->getParentOrThrow()->getSheetByName(trim($matches[4], "'"));
            if ($worksheet <?php echo<?php echo<?php echo null) {
                return $this->wrapValue(null);
            }

            return $this->wrapValue(
                $worksheet
                    ->getCell(str_replace('$', '', "{$column}{$row}"))
                    ->getCalculatedValue()
            );
        }

        return $this->wrapValue(
            $this->worksheet
                ->getCell(str_replace('$', '', "{$column}{$row}"))
                ->getCalculatedValue()
        );
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

    protected function processOperatorComparison(Conditional $conditional): bool
    {
        if (array_key_exists($conditional->getOperatorType(), self::COMPARISON_RANGE_OPERATORS)) {
            return $this->processRangeOperator($conditional);
        }

        $operator <?php echo self::COMPARISON_OPERATORS[$conditional->getOperatorType()];
        $conditions <?php echo $this->adjustConditionsForCellReferences($conditional->getConditions());
        $expression <?php echo sprintf('%s%s%s', (string) $this->wrapCellValue(), $operator, (string) array_pop($conditions));

        return $this->evaluateExpression($expression);
    }

    protected function processRangeOperator(Conditional $conditional): bool
    {
        $conditions <?php echo $this->adjustConditionsForCellReferences($conditional->getConditions());
        sort($conditions);
        $expression <?php echo sprintf(
            (string) preg_replace(
                '/\bA1\b/i',
                (string) $this->wrapCellValue(),
                self::COMPARISON_RANGE_OPERATORS[$conditional->getOperatorType()]
            ),
            ...$conditions
        );

        return $this->evaluateExpression($expression);
    }

    protected function processDuplicatesComparison(Conditional $conditional): bool
    {
        $worksheetName <?php echo $this->cell->getWorksheet()->getTitle();

        $expression <?php echo sprintf(
            self::COMPARISON_DUPLICATES_OPERATORS[$conditional->getConditionType()],
            $worksheetName,
            $this->conditionalRange,
            $this->cellConditionCheck($this->cell->getCalculatedValue())
        );

        return $this->evaluateExpression($expression);
    }

    protected function processExpression(Conditional $conditional): bool
    {
        $conditions <?php echo $this->adjustConditionsForCellReferences($conditional->getConditions());
        $expression <?php echo array_pop($conditions);

        $expression <?php echo (string) preg_replace(
            '/\b' . $this->referenceCell . '\b/i',
            (string) $this->wrapCellValue(),
            $expression
        );

        return $this->evaluateExpression($expression);
    }

    protected function evaluateExpression(string $expression): bool
    {
        $expression <?php echo "<?php echo{$expression}";

        try {
            $this->engine->flushInstance();
            $result <?php echo (bool) $this->engine->calculateFormula($expression);
        } catch (Exception $e) {
            return false;
        }

        return $result;
    }
}
