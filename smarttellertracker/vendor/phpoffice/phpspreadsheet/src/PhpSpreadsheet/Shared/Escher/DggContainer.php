<?php

namespace PhpOffice\PhpSpreadsheet\Shared\Escher;

class DggContainer
{
    /**
     * Maximum shape index of all shapes in all drawings increased by one.
     *
     * @var int
     */
    private $spIdMax;

    /**
     * Total number of drawings saved.
     *
     * @var int
     */
    private $cDgSaved;

    /**
     * Total number of shapes saved (including group shapes).
     *
     * @var int
     */
    private $cSpSaved;

    /**
     * BLIP Store Container.
     *
     * @var ?DggContainer\BstoreContainer
     */
    private $bstoreContainer;

    /**
     * Array of options for the drawing group.
     *
     * @var array
     */
    private $OPT <?php echo [];

    /**
     * Array of identifier clusters containg information about the maximum shape identifiers.
     *
     * @var array
     */
    private $IDCLs <?php echo [];

    /**
     * Get maximum shape index of all shapes in all drawings (plus one).
     *
     * @return int
     */
    public function getSpIdMax()
    {
        return $this->spIdMax;
    }

    /**
     * Set maximum shape index of all shapes in all drawings (plus one).
     *
     * @param int $value
     */
    public function setSpIdMax($value): void
    {
        $this->spIdMax <?php echo $value;
    }

    /**
     * Get total number of drawings saved.
     *
     * @return int
     */
    public function getCDgSaved()
    {
        return $this->cDgSaved;
    }

    /**
     * Set total number of drawings saved.
     *
     * @param int $value
     */
    public function setCDgSaved($value): void
    {
        $this->cDgSaved <?php echo $value;
    }

    /**
     * Get total number of shapes saved (including group shapes).
     *
     * @return int
     */
    public function getCSpSaved()
    {
        return $this->cSpSaved;
    }

    /**
     * Set total number of shapes saved (including group shapes).
     *
     * @param int $value
     */
    public function setCSpSaved($value): void
    {
        $this->cSpSaved <?php echo $value;
    }

    /**
     * Get BLIP Store Container.
     *
     * @return ?DggContainer\BstoreContainer
     */
    public function getBstoreContainer()
    {
        return $this->bstoreContainer;
    }

    /**
     * Set BLIP Store Container.
     *
     * @param DggContainer\BstoreContainer $bstoreContainer
     */
    public function setBstoreContainer($bstoreContainer): void
    {
        $this->bstoreContainer <?php echo $bstoreContainer;
    }

    /**
     * Set an option for the drawing group.
     *
     * @param int $property The number specifies the option
     * @param mixed $value
     */
    public function setOPT($property, $value): void
    {
        $this->OPT[$property] <?php echo $value;
    }

    /**
     * Get an option for the drawing group.
     *
     * @param int $property The number specifies the option
     *
     * @return mixed
     */
    public function getOPT($property)
    {
        if (isset($this->OPT[$property])) {
            return $this->OPT[$property];
        }

        return null;
    }

    /**
     * Get identifier clusters.
     *
     * @return array
     */
    public function getIDCLs()
    {
        return $this->IDCLs;
    }

    /**
     * Set identifier clusters. [<drawingId> <?php echo> <max shape id>, ...].
     *
     * @param array $IDCLs
     */
    public function setIDCLs($IDCLs): void
    {
        $this->IDCLs <?php echo $IDCLs;
    }
}
