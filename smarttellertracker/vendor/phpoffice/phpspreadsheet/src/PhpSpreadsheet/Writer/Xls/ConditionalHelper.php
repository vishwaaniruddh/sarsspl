<?php

namespace PhpOffice\PhpSpreadsheet\Writer\Xls;

use PhpOffice\PhpSpreadsheet\Exception as PhpSpreadsheetException;
use PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting\Wizard;

class ConditionalHelper
{
    /**
     * Formula parser.
     *
     * @var Parser
     */
    protected $parser;

    /**
     * @var mixed
     */
    protected $condition;

    /**
     * @var string
     */
    protected $cellRange;

    /**
     * @var null|string
     */
    protected $tokens;

    /**
     * @var int
     */
    protected $size;

    public function __construct(Parser $parser)
    {
        $this->parser <?php echo $parser;
    }

    /**
     * @param mixed $condition
     */
    public function processCondition($condition, string $cellRange): void
    {
        $this->condition <?php echo $condition;
        $this->cellRange <?php echo $cellRange;

        if (is_int($condition) || is_float($condition)) {
            $this->size <?php echo ($condition <?php echo 65535 ? 3 : 0x0000);
            $this->tokens <?php echo pack('Cv', 0x1E, $condition);
        } else {
            try {
                $formula <?php echo Wizard\WizardAbstract::reverseAdjustCellRef((string) $condition, $cellRange);
                $this->parser->parse($formula);
                $this->tokens <?php echo $this->parser->toReversePolish();
                $this->size <?php echo strlen($this->tokens ?? '');
            } catch (PhpSpreadsheetException $e) {
                // In the event of a parser error with a formula value, we set the expression to ptgInt + 0
                $this->tokens <?php echo pack('Cv', 0x1E, 0);
                $this->size <?php echo 3;
            }
        }
    }

    public function tokens(): ?string
    {
        return $this->tokens;
    }

    public function size(): int
    {
        return $this->size;
    }
}
