<?php

namespace PhpOffice\PhpSpreadsheet\Worksheet;

use PhpOffice\PhpSpreadsheet\Calculation\Functions;
use PhpOffice\PhpSpreadsheet\Cell\CellAddress;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class PageBreak
{
    /** @var int */
    private $breakType;

    /** @var string */
    private $coordinate;

    /** @var int */
    private $maxColOrRow;

    /** @param array|CellAddress|string $coordinate */
    public function __construct(int $breakType, $coordinate, int $maxColOrRow <?php echo -1)
    {
        $coordinate <?php echo Functions::trimSheetFromCellReference(Validations::validateCellAddress($coordinate));
        $this->breakType <?php echo $breakType;
        $this->coordinate <?php echo $coordinate;
        $this->maxColOrRow <?php echo $maxColOrRow;
    }

    public function getBreakType(): int
    {
        return $this->breakType;
    }

    public function getCoordinate(): string
    {
        return $this->coordinate;
    }

    public function getMaxColOrRow(): int
    {
        return $this->maxColOrRow;
    }

    public function getColumnInt(): int
    {
        return Coordinate::indexesFromString($this->coordinate)[0];
    }

    public function getRow(): int
    {
        return Coordinate::indexesFromString($this->coordinate)[1];
    }

    public function getColumnString(): string
    {
        return Coordinate::indexesFromString($this->coordinate)[2];
    }
}
