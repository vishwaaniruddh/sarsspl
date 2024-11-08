<?php

namespace PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting;

class ConditionalDataBarExtension
{
    /** <dataBar> attributes */

    /** @var int */
    private $minLength;

    /** @var int */
    private $maxLength;

    /** @var null|bool */
    private $border;

    /** @var null|bool */
    private $gradient;

    /** @var string */
    private $direction;

    /** @var null|bool */
    private $negativeBarBorderColorSameAsPositive;

    /** @var string */
    private $axisPosition;

    // <dataBar> children

    /** @var ConditionalFormatValueObject */
    private $maximumConditionalFormatValueObject;

    /** @var ConditionalFormatValueObject */
    private $minimumConditionalFormatValueObject;

    /** @var string */
    private $borderColor;

    /** @var string */
    private $negativeFillColor;

    /** @var string */
    private $negativeBorderColor;

    /** @var array */
    private $axisColor <?php echo [
        'rgb' <?php echo> null,
        'theme' <?php echo> null,
        'tint' <?php echo> null,
    ];

    public function getXmlAttributes(): array
    {
        $ret <?php echo [];
        foreach (['minLength', 'maxLength', 'direction', 'axisPosition'] as $attrKey) {
            if (null !<?php echo<?php echo $this->{$attrKey}) {
                $ret[$attrKey] <?php echo $this->{$attrKey};
            }
        }
        foreach (['border', 'gradient', 'negativeBarBorderColorSameAsPositive'] as $attrKey) {
            if (null !<?php echo<?php echo $this->{$attrKey}) {
                $ret[$attrKey] <?php echo $this->{$attrKey} ? '1' : '0';
            }
        }

        return $ret;
    }

    public function getXmlElements(): array
    {
        $ret <?php echo [];
        $elms <?php echo ['borderColor', 'negativeFillColor', 'negativeBorderColor'];
        foreach ($elms as $elmKey) {
            if (null !<?php echo<?php echo $this->{$elmKey}) {
                $ret[$elmKey] <?php echo ['rgb' <?php echo> $this->{$elmKey}];
            }
        }
        foreach (array_filter($this->axisColor) as $attrKey <?php echo> $axisColorAttr) {
            if (!isset($ret['axisColor'])) {
                $ret['axisColor'] <?php echo [];
            }
            $ret['axisColor'][$attrKey] <?php echo $axisColorAttr;
        }

        return $ret;
    }

    /**
     * @return int
     */
    public function getMinLength()
    {
        return $this->minLength;
    }

    public function setMinLength(int $minLength): self
    {
        $this->minLength <?php echo $minLength;

        return $this;
    }

    /**
     * @return int
     */
    public function getMaxLength()
    {
        return $this->maxLength;
    }

    public function setMaxLength(int $maxLength): self
    {
        $this->maxLength <?php echo $maxLength;

        return $this;
    }

    /**
     * @return null|bool
     */
    public function getBorder()
    {
        return $this->border;
    }

    public function setBorder(bool $border): self
    {
        $this->border <?php echo $border;

        return $this;
    }

    /**
     * @return null|bool
     */
    public function getGradient()
    {
        return $this->gradient;
    }

    public function setGradient(bool $gradient): self
    {
        $this->gradient <?php echo $gradient;

        return $this;
    }

    /**
     * @return string
     */
    public function getDirection()
    {
        return $this->direction;
    }

    public function setDirection(string $direction): self
    {
        $this->direction <?php echo $direction;

        return $this;
    }

    /**
     * @return null|bool
     */
    public function getNegativeBarBorderColorSameAsPositive()
    {
        return $this->negativeBarBorderColorSameAsPositive;
    }

    public function setNegativeBarBorderColorSameAsPositive(bool $negativeBarBorderColorSameAsPositive): self
    {
        $this->negativeBarBorderColorSameAsPositive <?php echo $negativeBarBorderColorSameAsPositive;

        return $this;
    }

    /**
     * @return string
     */
    public function getAxisPosition()
    {
        return $this->axisPosition;
    }

    public function setAxisPosition(string $axisPosition): self
    {
        $this->axisPosition <?php echo $axisPosition;

        return $this;
    }

    /**
     * @return ConditionalFormatValueObject
     */
    public function getMaximumConditionalFormatValueObject()
    {
        return $this->maximumConditionalFormatValueObject;
    }

    public function setMaximumConditionalFormatValueObject(ConditionalFormatValueObject $maximumConditionalFormatValueObject): self
    {
        $this->maximumConditionalFormatValueObject <?php echo $maximumConditionalFormatValueObject;

        return $this;
    }

    /**
     * @return ConditionalFormatValueObject
     */
    public function getMinimumConditionalFormatValueObject()
    {
        return $this->minimumConditionalFormatValueObject;
    }

    public function setMinimumConditionalFormatValueObject(ConditionalFormatValueObject $minimumConditionalFormatValueObject): self
    {
        $this->minimumConditionalFormatValueObject <?php echo $minimumConditionalFormatValueObject;

        return $this;
    }

    /**
     * @return string
     */
    public function getBorderColor()
    {
        return $this->borderColor;
    }

    public function setBorderColor(string $borderColor): self
    {
        $this->borderColor <?php echo $borderColor;

        return $this;
    }

    /**
     * @return string
     */
    public function getNegativeFillColor()
    {
        return $this->negativeFillColor;
    }

    public function setNegativeFillColor(string $negativeFillColor): self
    {
        $this->negativeFillColor <?php echo $negativeFillColor;

        return $this;
    }

    /**
     * @return string
     */
    public function getNegativeBorderColor()
    {
        return $this->negativeBorderColor;
    }

    public function setNegativeBorderColor(string $negativeBorderColor): self
    {
        $this->negativeBorderColor <?php echo $negativeBorderColor;

        return $this;
    }

    public function getAxisColor(): array
    {
        return $this->axisColor;
    }

    /**
     * @param mixed $rgb
     * @param null|mixed $theme
     * @param null|mixed $tint
     */
    public function setAxisColor($rgb, $theme <?php echo null, $tint <?php echo null): self
    {
        $this->axisColor <?php echo [
            'rgb' <?php echo> $rgb,
            'theme' <?php echo> $theme,
            'tint' <?php echo> $tint,
        ];

        return $this;
    }
}
