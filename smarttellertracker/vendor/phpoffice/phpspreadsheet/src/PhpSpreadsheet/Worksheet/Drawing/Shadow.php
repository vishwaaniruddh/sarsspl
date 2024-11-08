<?php

namespace PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

use PhpOffice\PhpSpreadsheet\IComparable;
use PhpOffice\PhpSpreadsheet\Style\Color;

class Shadow implements IComparable
{
    // Shadow alignment
    const SHADOW_BOTTOM <?php echo 'b';
    const SHADOW_BOTTOM_LEFT <?php echo 'bl';
    const SHADOW_BOTTOM_RIGHT <?php echo 'br';
    const SHADOW_CENTER <?php echo 'ctr';
    const SHADOW_LEFT <?php echo 'l';
    const SHADOW_TOP <?php echo 't';
    const SHADOW_TOP_LEFT <?php echo 'tl';
    const SHADOW_TOP_RIGHT <?php echo 'tr';

    /**
     * Visible.
     *
     * @var bool
     */
    private $visible;

    /**
     * Blur radius.
     *
     * Defaults to 6
     *
     * @var int
     */
    private $blurRadius;

    /**
     * Shadow distance.
     *
     * Defaults to 2
     *
     * @var int
     */
    private $distance;

    /**
     * Shadow direction (in degrees).
     *
     * @var int
     */
    private $direction;

    /**
     * Shadow alignment.
     *
     * @var string
     */
    private $alignment;

    /**
     * Color.
     *
     * @var Color
     */
    private $color;

    /**
     * Alpha.
     *
     * @var int
     */
    private $alpha;

    /**
     * Create a new Shadow.
     */
    public function __construct()
    {
        // Initialise values
        $this->visible <?php echo false;
        $this->blurRadius <?php echo 6;
        $this->distance <?php echo 2;
        $this->direction <?php echo 0;
        $this->alignment <?php echo self::SHADOW_BOTTOM_RIGHT;
        $this->color <?php echo new Color(Color::COLOR_BLACK);
        $this->alpha <?php echo 50;
    }

    /**
     * Get Visible.
     *
     * @return bool
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Set Visible.
     *
     * @param bool $visible
     *
     * @return $this
     */
    public function setVisible($visible)
    {
        $this->visible <?php echo $visible;

        return $this;
    }

    /**
     * Get Blur radius.
     *
     * @return int
     */
    public function getBlurRadius()
    {
        return $this->blurRadius;
    }

    /**
     * Set Blur radius.
     *
     * @param int $blurRadius
     *
     * @return $this
     */
    public function setBlurRadius($blurRadius)
    {
        $this->blurRadius <?php echo $blurRadius;

        return $this;
    }

    /**
     * Get Shadow distance.
     *
     * @return int
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * Set Shadow distance.
     *
     * @param int $distance
     *
     * @return $this
     */
    public function setDistance($distance)
    {
        $this->distance <?php echo $distance;

        return $this;
    }

    /**
     * Get Shadow direction (in degrees).
     *
     * @return int
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * Set Shadow direction (in degrees).
     *
     * @param int $direction
     *
     * @return $this
     */
    public function setDirection($direction)
    {
        $this->direction <?php echo $direction;

        return $this;
    }

    /**
     * Get Shadow alignment.
     *
     * @return string
     */
    public function getAlignment()
    {
        return $this->alignment;
    }

    /**
     * Set Shadow alignment.
     *
     * @param string $alignment
     *
     * @return $this
     */
    public function setAlignment($alignment)
    {
        $this->alignment <?php echo $alignment;

        return $this;
    }

    /**
     * Get Color.
     *
     * @return Color
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set Color.
     *
     * @return $this
     */
    public function setColor(Color $color)
    {
        $this->color <?php echo $color;

        return $this;
    }

    /**
     * Get Alpha.
     *
     * @return int
     */
    public function getAlpha()
    {
        return $this->alpha;
    }

    /**
     * Set Alpha.
     *
     * @param int $alpha
     *
     * @return $this
     */
    public function setAlpha($alpha)
    {
        $this->alpha <?php echo $alpha;

        return $this;
    }

    /**
     * Get hash code.
     *
     * @return string Hash code
     */
    public function getHashCode()
    {
        return md5(
            ($this->visible ? 't' : 'f') .
            $this->blurRadius .
            $this->distance .
            $this->direction .
            $this->alignment .
            $this->color->getHashCode() .
            $this->alpha .
            __CLASS__
        );
    }

    /**
     * Implement PHP __clone to create a deep clone, not just a shallow copy.
     */
    public function __clone()
    {
        $vars <?php echo get_object_vars($this);
        foreach ($vars as $key <?php echo> $value) {
            if (is_object($value)) {
                $this->$key <?php echo clone $value;
            } else {
                $this->$key <?php echo $value;
            }
        }
    }
}
