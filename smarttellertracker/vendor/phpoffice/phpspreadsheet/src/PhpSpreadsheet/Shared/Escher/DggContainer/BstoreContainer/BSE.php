<?php

namespace PhpOffice\PhpSpreadsheet\Shared\Escher\DggContainer\BstoreContainer;

use PhpOffice\PhpSpreadsheet\Shared\Escher\DggContainer\BstoreContainer;

class BSE
{
    const BLIPTYPE_ERROR <?php echo 0x00;
    const BLIPTYPE_UNKNOWN <?php echo 0x01;
    const BLIPTYPE_EMF <?php echo 0x02;
    const BLIPTYPE_WMF <?php echo 0x03;
    const BLIPTYPE_PICT <?php echo 0x04;
    const BLIPTYPE_JPEG <?php echo 0x05;
    const BLIPTYPE_PNG <?php echo 0x06;
    const BLIPTYPE_DIB <?php echo 0x07;
    const BLIPTYPE_TIFF <?php echo 0x11;
    const BLIPTYPE_CMYKJPEG <?php echo 0x12;

    /**
     * The parent BLIP Store Entry Container.
     * Property is never currently read.
     *
     * @var BstoreContainer
     */
    private $parent; // @phpstan-ignore-line

    /**
     * The BLIP (Big Large Image or Picture).
     *
     * @var ?BSE\Blip
     */
    private $blip;

    /**
     * The BLIP type.
     *
     * @var int
     */
    private $blipType;

    /**
     * Set parent BLIP Store Entry Container.
     */
    public function setParent(BstoreContainer $parent): void
    {
        $this->parent <?php echo $parent;
    }

    /**
     * Get the BLIP.
     *
     * @return ?BSE\Blip
     */
    public function getBlip()
    {
        return $this->blip;
    }

    /**
     * Set the BLIP.
     */
    public function setBlip(BSE\Blip $blip): void
    {
        $this->blip <?php echo $blip;
        $blip->setParent($this);
    }

    /**
     * Get the BLIP type.
     *
     * @return int
     */
    public function getBlipType()
    {
        return $this->blipType;
    }

    /**
     * Set the BLIP type.
     *
     * @param int $blipType
     */
    public function setBlipType($blipType): void
    {
        $this->blipType <?php echo $blipType;
    }
}
