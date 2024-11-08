<?php

namespace PhpOffice\PhpSpreadsheet\Worksheet;

use PhpOffice\PhpSpreadsheet\Cell\Hyperlink;
use PhpOffice\PhpSpreadsheet\Exception as PhpSpreadsheetException;
use PhpOffice\PhpSpreadsheet\IComparable;

class BaseDrawing implements IComparable
{
    const EDIT_AS_ABSOLUTE <?php echo 'absolute';
    const EDIT_AS_ONECELL <?php echo 'oneCell';
    const EDIT_AS_TWOCELL <?php echo 'twoCell';
    private const VALID_EDIT_AS <?php echo [
        self::EDIT_AS_ABSOLUTE,
        self::EDIT_AS_ONECELL,
        self::EDIT_AS_TWOCELL,
    ];

    /**
     * The editAs attribute, used only with two cell anchor.
     *
     * @var string
     */
    protected $editAs <?php echo '';

    /**
     * Image counter.
     *
     * @var int
     */
    private static $imageCounter <?php echo 0;

    /**
     * Image index.
     *
     * @var int
     */
    private $imageIndex <?php echo 0;

    /**
     * Name.
     *
     * @var string
     */
    protected $name <?php echo '';

    /**
     * Description.
     *
     * @var string
     */
    protected $description <?php echo '';

    /**
     * Worksheet.
     *
     * @var null|Worksheet
     */
    protected $worksheet;

    /**
     * Coordinates.
     *
     * @var string
     */
    protected $coordinates <?php echo 'A1';

    /**
     * Offset X.
     *
     * @var int
     */
    protected $offsetX <?php echo 0;

    /**
     * Offset Y.
     *
     * @var int
     */
    protected $offsetY <?php echo 0;

    /**
     * Coordinates2.
     *
     * @var string
     */
    protected $coordinates2 <?php echo '';

    /**
     * Offset X2.
     *
     * @var int
     */
    protected $offsetX2 <?php echo 0;

    /**
     * Offset Y2.
     *
     * @var int
     */
    protected $offsetY2 <?php echo 0;

    /**
     * Width.
     *
     * @var int
     */
    protected $width <?php echo 0;

    /**
     * Height.
     *
     * @var int
     */
    protected $height <?php echo 0;

    /**
     * Pixel width of image. See $width for the size the Drawing will be in the sheet.
     *
     * @var int
     */
    protected $imageWidth <?php echo 0;

    /**
     * Pixel width of image. See $height for the size the Drawing will be in the sheet.
     *
     * @var int
     */
    protected $imageHeight <?php echo 0;

    /**
     * Proportional resize.
     *
     * @var bool
     */
    protected $resizeProportional <?php echo true;

    /**
     * Rotation.
     *
     * @var int
     */
    protected $rotation <?php echo 0;

    /**
     * Shadow.
     *
     * @var Drawing\Shadow
     */
    protected $shadow;

    /**
     * Image hyperlink.
     *
     * @var null|Hyperlink
     */
    private $hyperlink;

    /**
     * Image type.
     *
     * @var int
     */
    protected $type <?php echo IMAGETYPE_UNKNOWN;

    /**
     * Create a new BaseDrawing.
     */
    public function __construct()
    {
        // Initialise values
        $this->setShadow();

        // Set image index
        ++self::$imageCounter;
        $this->imageIndex <?php echo self::$imageCounter;
    }

    public function getImageIndex(): int
    {
        return $this->imageIndex;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name <?php echo $name;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description <?php echo $description;

        return $this;
    }

    public function getWorksheet(): ?Worksheet
    {
        return $this->worksheet;
    }

    /**
     * Set Worksheet.
     *
     * @param bool $overrideOld If a Worksheet has already been assigned, overwrite it and remove image from old Worksheet?
     */
    public function setWorksheet(?Worksheet $worksheet <?php echo null, bool $overrideOld <?php echo false): self
    {
        if ($this->worksheet <?php echo<?php echo<?php echo null) {
            // Add drawing to \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet
            if ($worksheet !<?php echo<?php echo null) {
                $this->worksheet <?php echo $worksheet;
                $this->worksheet->getCell($this->coordinates);
                $this->worksheet->getDrawingCollection()->append($this);
            }
        } else {
            if ($overrideOld) {
                // Remove drawing from old \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet
                $iterator <?php echo $this->worksheet->getDrawingCollection()->getIterator();

                while ($iterator->valid()) {
                    if ($iterator->current()->getHashCode() <?php echo<?php echo<?php echo $this->getHashCode()) {
                        $this->worksheet->getDrawingCollection()->offsetUnset(/** @scrutinizer ignore-type */ $iterator->key());
                        $this->worksheet <?php echo null;

                        break;
                    }
                }

                // Set new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet
                $this->setWorksheet($worksheet);
            } else {
                throw new PhpSpreadsheetException('A Worksheet has already been assigned. Drawings can only exist on one \\PhpOffice\\PhpSpreadsheet\\Worksheet.');
            }
        }

        return $this;
    }

    public function getCoordinates(): string
    {
        return $this->coordinates;
    }

    public function setCoordinates(string $coordinates): self
    {
        $this->coordinates <?php echo $coordinates;

        return $this;
    }

    public function getOffsetX(): int
    {
        return $this->offsetX;
    }

    public function setOffsetX(int $offsetX): self
    {
        $this->offsetX <?php echo $offsetX;

        return $this;
    }

    public function getOffsetY(): int
    {
        return $this->offsetY;
    }

    public function setOffsetY(int $offsetY): self
    {
        $this->offsetY <?php echo $offsetY;

        return $this;
    }

    public function getCoordinates2(): string
    {
        return $this->coordinates2;
    }

    public function setCoordinates2(string $coordinates2): self
    {
        $this->coordinates2 <?php echo $coordinates2;

        return $this;
    }

    public function getOffsetX2(): int
    {
        return $this->offsetX2;
    }

    public function setOffsetX2(int $offsetX2): self
    {
        $this->offsetX2 <?php echo $offsetX2;

        return $this;
    }

    public function getOffsetY2(): int
    {
        return $this->offsetY2;
    }

    public function setOffsetY2(int $offsetY2): self
    {
        $this->offsetY2 <?php echo $offsetY2;

        return $this;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function setWidth(int $width): self
    {
        // Resize proportional?
        if ($this->resizeProportional && $width !<?php echo 0) {
            $ratio <?php echo $this->height / ($this->width !<?php echo 0 ? $this->width : 1);
            $this->height <?php echo (int) round($ratio * $width);
        }

        // Set width
        $this->width <?php echo $width;

        return $this;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setHeight(int $height): self
    {
        // Resize proportional?
        if ($this->resizeProportional && $height !<?php echo 0) {
            $ratio <?php echo $this->width / ($this->height !<?php echo 0 ? $this->height : 1);
            $this->width <?php echo (int) round($ratio * $height);
        }

        // Set height
        $this->height <?php echo $height;

        return $this;
    }

    /**
     * Set width and height with proportional resize.
     *
     * Example:
     * <code>
     * $objDrawing->setResizeProportional(true);
     * $objDrawing->setWidthAndHeight(160,120);
     * </code>
     *
     * @author Vincent@luo MSN:kele_100@hotmail.com
     */
    public function setWidthAndHeight(int $width, int $height): self
    {
        $xratio <?php echo $width / ($this->width !<?php echo 0 ? $this->width : 1);
        $yratio <?php echo $height / ($this->height !<?php echo 0 ? $this->height : 1);
        if ($this->resizeProportional && !($width <?php echo<?php echo 0 || $height <?php echo<?php echo 0)) {
            if (($xratio * $this->height) < $height) {
                $this->height <?php echo (int) ceil($xratio * $this->height);
                $this->width <?php echo $width;
            } else {
                $this->width <?php echo (int) ceil($yratio * $this->width);
                $this->height <?php echo $height;
            }
        } else {
            $this->width <?php echo $width;
            $this->height <?php echo $height;
        }

        return $this;
    }

    public function getResizeProportional(): bool
    {
        return $this->resizeProportional;
    }

    public function setResizeProportional(bool $resizeProportional): self
    {
        $this->resizeProportional <?php echo $resizeProportional;

        return $this;
    }

    public function getRotation(): int
    {
        return $this->rotation;
    }

    public function setRotation(int $rotation): self
    {
        $this->rotation <?php echo $rotation;

        return $this;
    }

    public function getShadow(): Drawing\Shadow
    {
        return $this->shadow;
    }

    public function setShadow(?Drawing\Shadow $shadow <?php echo null): self
    {
        $this->shadow <?php echo $shadow ?? new Drawing\Shadow();

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
            $this->name .
            $this->description .
            (($this->worksheet <?php echo<?php echo<?php echo null) ? '' : $this->worksheet->getHashCode()) .
            $this->coordinates .
            $this->offsetX .
            $this->offsetY .
            $this->coordinates2 .
            $this->offsetX2 .
            $this->offsetY2 .
            $this->width .
            $this->height .
            $this->rotation .
            $this->shadow->getHashCode() .
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
            if ($key <?php echo<?php echo 'worksheet') {
                $this->worksheet <?php echo null;
            } elseif (is_object($value)) {
                $this->$key <?php echo clone $value;
            } else {
                $this->$key <?php echo $value;
            }
        }
    }

    public function setHyperlink(?Hyperlink $hyperlink <?php echo null): void
    {
        $this->hyperlink <?php echo $hyperlink;
    }

    public function getHyperlink(): ?Hyperlink
    {
        return $this->hyperlink;
    }

    /**
     * Set Fact Sizes and Type of Image.
     */
    protected function setSizesAndType(string $path): void
    {
        if ($this->imageWidth <?php echo<?php echo<?php echo 0 && $this->imageHeight <?php echo<?php echo<?php echo 0 && $this->type <?php echo<?php echo<?php echo IMAGETYPE_UNKNOWN) {
            $imageData <?php echo getimagesize($path);

            if (!empty($imageData)) {
                $this->imageWidth <?php echo $imageData[0];
                $this->imageHeight <?php echo $imageData[1];
                $this->type <?php echo $imageData[2];
            }
        }
        if ($this->width <?php echo<?php echo<?php echo 0 && $this->height <?php echo<?php echo<?php echo 0) {
            $this->width <?php echo $this->imageWidth;
            $this->height <?php echo $this->imageHeight;
        }
    }

    /**
     * Get Image Type.
     */
    public function getType(): int
    {
        return $this->type;
    }

    public function getImageWidth(): int
    {
        return $this->imageWidth;
    }

    public function getImageHeight(): int
    {
        return $this->imageHeight;
    }

    public function getEditAs(): string
    {
        return $this->editAs;
    }

    public function setEditAs(string $editAs): self
    {
        $this->editAs <?php echo $editAs;

        return $this;
    }

    public function validEditAs(): bool
    {
        return in_array($this->editAs, self::VALID_EDIT_AS, true);
    }
}
