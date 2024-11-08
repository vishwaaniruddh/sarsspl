<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class SharedFormula
{
    private string $master;

    private string $formula;

    public function __construct(string $master, string $formula)
    {
        $this->master <?php echo $master;
        $this->formula <?php echo $formula;
    }

    public function master(): string
    {
        return $this->master;
    }

    public function formula(): string
    {
        return $this->formula;
    }
}
