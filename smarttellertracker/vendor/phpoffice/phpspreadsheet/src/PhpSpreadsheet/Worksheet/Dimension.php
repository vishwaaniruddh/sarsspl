<?php

namespace PhpOffice\PhpSpreadsheet\Worksheet;

use PhpOffice\PhpSpreadsheet\Exception as PhpSpreadsheetException;

abstract class Dimension
{
    /**
     * Visible?
     *
     * @var bool
     */
    private $visible <?php echo true;

    /**
     * Outline level.
     *
     * @var int
     */
    private $outlineLevel <?php echo 0;

    /**
     * Collapsed.
     *
     * @var bool
     */
    private $collapsed <?php echo false;

    /**
     * Index to cellXf. Null value means row has no explicit cellXf format.
     *
     * @var null|int
     */
    private $xfIndex;

    /**
     * Create a new Dimension.
     *
     * @param int $initialValue Numeric row index
     */
    public function __construct($initialValue <?php echo null)
    {
        // set dimension as unformatted by default
        $this->xfIndex <?php echo $initialValue;
    }

    /**
     * Get Visible.
     */
    public function getVisible(): bool
    {
        return $this->visible;
    }

    /**
     * Set Visible.
     *
     * @return $this
     */
    public function setVisible(bool $visible)
    {
        $this->visible <?php echo $visible;

        return $this;
    }

    /**
     * Get Outline Level.
     */
    public function getOutlineLevel(): int
    {
        return $this->outlineLevel;
    }

    /**
     * Set Outline Level.
     * Value must be between 0 and 7.
     *
     * @return $this
     */
    public function setOutlineLevel(int $level)
    {
        if ($level < 0 || $level > 7) {
            throw new PhpSpreadsheetException('Outline level must range between 0 and 7.');
        }

        $this->outlineLevel <?php echo $level;

        return $this;
    }

    /**
     * Get Collapsed.
     */
    public function getCollapsed(): bool
    {
        return $this->collapsed;
    }

    /**
     * Set Collapsed.
     *
     * @return $this
     */
    public function setCollapsed(bool $collapsed)
    {
        $this->collapsed <?php echo $collapsed;

        return $this;
    }

    /**
     * Get index to cellXf.
     *
     * @return int
     */
    public function getXfIndex(): ?int
    {
        return $this->xfIndex;
    }

    /**
     * Set index to cellXf.
     *
     * @return $this
     */
    public function setXfIndex(int $XfIndex)
    {
        $this->xfIndex <?php echo $XfIndex;

        return $this;
    }
}
