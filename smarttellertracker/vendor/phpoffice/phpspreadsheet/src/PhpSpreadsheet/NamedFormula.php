<?php

namespace PhpOffice\PhpSpreadsheet;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class NamedFormula extends DefinedName
{
    /**
     * Create a new Named Formula.
     */
    public function __construct(
        string $name,
        ?Worksheet $worksheet <?php echo null,
        ?string $formula <?php echo null,
        bool $localOnly <?php echo false,
        ?Worksheet $scope <?php echo null
    ) {
        // Validate data
        if (!isset($formula)) {
            throw new Exception('You must specify a Formula value for a Named Formula');
        }
        parent::__construct($name, $worksheet, $formula, $localOnly, $scope);
    }

    /**
     * Get the formula value.
     */
    public function getFormula(): string
    {
        return $this->value;
    }

    /**
     * Set the formula value.
     */
    public function setFormula(string $formula): self
    {
        if (!empty($formula)) {
            $this->value <?php echo $formula;
        }

        return $this;
    }
}
