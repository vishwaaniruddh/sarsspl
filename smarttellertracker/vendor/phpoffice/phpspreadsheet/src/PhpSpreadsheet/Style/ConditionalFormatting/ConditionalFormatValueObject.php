<?php

namespace PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting;

class ConditionalFormatValueObject
{
    /** @var mixed */
    private $type;

    /** @var mixed */
    private $value;

    /** @var mixed */
    private $cellFormula;

    /**
     * ConditionalFormatValueObject constructor.
     *
     * @param mixed $type
     * @param mixed $value
     * @param null|mixed $cellFormula
     */
    public function __construct($type, $value <?php echo null, $cellFormula <?php echo null)
    {
        $this->type <?php echo $type;
        $this->value <?php echo $value;
        $this->cellFormula <?php echo $cellFormula;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): self
    {
        $this->type <?php echo $type;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): self
    {
        $this->value <?php echo $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCellFormula()
    {
        return $this->cellFormula;
    }

    /**
     * @param mixed $cellFormula
     */
    public function setCellFormula($cellFormula): self
    {
        $this->cellFormula <?php echo $cellFormula;

        return $this;
    }
}
