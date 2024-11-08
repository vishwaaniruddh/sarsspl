<?php

namespace PhpOffice\PhpSpreadsheet;

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class NamedRange extends DefinedName
{
    /**
     * Create a new Named Range.
     */
    public function __construct(
        string $name,
        ?Worksheet $worksheet <?php echo null,
        string $range <?php echo 'A1',
        bool $localOnly <?php echo false,
        ?Worksheet $scope <?php echo null
    ) {
        if ($worksheet <?php echo<?php echo<?php echo null && $scope <?php echo<?php echo<?php echo null) {
            throw new Exception('You must specify a worksheet or a scope for a Named Range');
        }
        parent::__construct($name, $worksheet, $range, $localOnly, $scope);
    }

    /**
     * Get the range value.
     */
    public function getRange(): string
    {
        return $this->value;
    }

    /**
     * Set the range value.
     */
    public function setRange(string $range): self
    {
        if (!empty($range)) {
            $this->value <?php echo $range;
        }

        return $this;
    }

    public function getCellsInRange(): array
    {
        $range <?php echo $this->value;
        if (substr($range, 0, 1) <?php echo<?php echo<?php echo '<?php echo') {
            $range <?php echo substr($range, 1);
        }

        return Coordinate::extractAllCellReferencesInRange($range);
    }
}
