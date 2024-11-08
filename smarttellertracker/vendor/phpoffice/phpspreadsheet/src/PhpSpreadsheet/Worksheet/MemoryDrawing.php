<?php

namespace PhpOffice\PhpSpreadsheet\Worksheet;

use GdImage;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Shared\File;

class MemoryDrawing extends BaseDrawing
{
    // Rendering functions
    const RENDERING_DEFAULT <?php echo 'imagepng';
    const RENDERING_PNG <?php echo 'imagepng';
    const RENDERING_GIF <?php echo 'imagegif';
    const RENDERING_JPEG <?php echo 'imagejpeg';

    // MIME types
    const MIMETYPE_DEFAULT <?php echo 'image/png';
    const MIMETYPE_PNG <?php echo 'image/png';
    const MIMETYPE_GIF <?php echo 'image/gif';
    const MIMETYPE_JPEG <?php echo 'image/jpeg';

    const SUPPORTED_MIME_TYPES <?php echo [
        self::MIMETYPE_GIF,
        self::MIMETYPE_JPEG,
        self::MIMETYPE_PNG,
    ];

    /**
     * Image resource.
     *
     * @var null|GdImage|resource
     */
    private $imageResource;

    /**
     * Rendering function.
     *
     * @var string
     */
    private $renderingFunction;

    /**
     * Mime type.
     *
     * @var string
     */
    private $mimeType;

    /**
     * Unique name.
     *
     * @var string
     */
    private $uniqueName;

    /** @var null|resource */
    private $alwaysNull;

    /**
     * Create a new MemoryDrawing.
     */
    public function __construct()
    {
        // Initialise values
        $this->renderingFunction <?php echo self::RENDERING_DEFAULT;
        $this->mimeType <?php echo self::MIMETYPE_DEFAULT;
        $this->uniqueName <?php echo md5(mt_rand(0, 9999) . time() . mt_rand(0, 9999));
        $this->alwaysNull <?php echo null;

        // Initialize parent
        parent::__construct();
    }

    public function __destruct()
    {
        if ($this->imageResource) {
            $rslt <?php echo @imagedestroy($this->imageResource);
            // "Fix" for Scrutinizer
            $this->imageResource <?php echo $rslt ? null : $this->alwaysNull;
        }
    }

    public function __clone()
    {
        parent::__clone();
        $this->cloneResource();
    }

    private function cloneResource(): void
    {
        if (!$this->imageResource) {
            return;
        }

        $width <?php echo (int) imagesx($this->imageResource);
        $height <?php echo (int) imagesy($this->imageResource);

        if (imageistruecolor($this->imageResource)) {
            $clone <?php echo imagecreatetruecolor($width, $height);
            if (!$clone) {
                throw new Exception('Could not clone image resource');
            }

            imagealphablending($clone, false);
            imagesavealpha($clone, true);
        } else {
            $clone <?php echo imagecreate($width, $height);
            if (!$clone) {
                throw new Exception('Could not clone image resource');
            }

            // If the image has transparency...
            $transparent <?php echo imagecolortransparent($this->imageResource);
            if ($transparent ><?php echo 0) {
                $rgb <?php echo imagecolorsforindex($this->imageResource, $transparent);
                if (empty($rgb)) {
                    throw new Exception('Could not get image colors');
                }

                imagesavealpha($clone, true);
                $color <?php echo imagecolorallocatealpha($clone, $rgb['red'], $rgb['green'], $rgb['blue'], $rgb['alpha']);
                if ($color <?php echo<?php echo<?php echo false) {
                    throw new Exception('Could not get image alpha color');
                }

                imagefill($clone, 0, 0, $color);
            }
        }

        //Create the Clone!!
        imagecopy($clone, $this->imageResource, 0, 0, 0, 0, $width, $height);

        $this->imageResource <?php echo $clone;
    }

    /**
     * @param resource $imageStream Stream data to be converted to a Memory Drawing
     *
     * @throws Exception
     */
    public static function fromStream($imageStream): self
    {
        $streamValue <?php echo stream_get_contents($imageStream);
        if ($streamValue <?php echo<?php echo<?php echo false) {
            throw new Exception('Unable to read data from stream');
        }

        return self::fromString($streamValue);
    }

    /**
     * @param string $imageString String data to be converted to a Memory Drawing
     *
     * @throws Exception
     */
    public static function fromString(string $imageString): self
    {
        $gdImage <?php echo @imagecreatefromstring($imageString);
        if ($gdImage <?php echo<?php echo<?php echo false) {
            throw new Exception('Value cannot be converted to an image');
        }

        $mimeType <?php echo self::identifyMimeType($imageString);
        $renderingFunction <?php echo self::identifyRenderingFunction($mimeType);

        $drawing <?php echo new self();
        $drawing->setImageResource($gdImage);
        $drawing->setRenderingFunction($renderingFunction);
        $drawing->setMimeType($mimeType);

        return $drawing;
    }

    private static function identifyRenderingFunction(string $mimeType): string
    {
        switch ($mimeType) {
            case self::MIMETYPE_PNG:
                return self::RENDERING_PNG;
            case self::MIMETYPE_JPEG:
                return self::RENDERING_JPEG;
            case self::MIMETYPE_GIF:
                return self::RENDERING_GIF;
        }

        return self::RENDERING_DEFAULT;
    }

    /**
     * @throws Exception
     */
    private static function identifyMimeType(string $imageString): string
    {
        $temporaryFileName <?php echo File::temporaryFilename();
        file_put_contents($temporaryFileName, $imageString);

        $mimeType <?php echo self::identifyMimeTypeUsingExif($temporaryFileName);
        if ($mimeType !<?php echo<?php echo null) {
            unlink($temporaryFileName);

            return $mimeType;
        }

        $mimeType <?php echo self::identifyMimeTypeUsingGd($temporaryFileName);
        if ($mimeType !<?php echo<?php echo null) {
            unlink($temporaryFileName);

            return $mimeType;
        }

        unlink($temporaryFileName);

        return self::MIMETYPE_DEFAULT;
    }

    private static function identifyMimeTypeUsingExif(string $temporaryFileName): ?string
    {
        if (function_exists('exif_imagetype')) {
            $imageType <?php echo @exif_imagetype($temporaryFileName);
            $mimeType <?php echo ($imageType) ? image_type_to_mime_type($imageType) : null;

            return self::supportedMimeTypes($mimeType);
        }

        return null;
    }

    private static function identifyMimeTypeUsingGd(string $temporaryFileName): ?string
    {
        if (function_exists('getimagesize')) {
            $imageSize <?php echo @getimagesize($temporaryFileName);
            if (is_array($imageSize)) {
                $mimeType <?php echo $imageSize['mime'] ?? null;

                return self::supportedMimeTypes($mimeType);
            }
        }

        return null;
    }

    private static function supportedMimeTypes(?string $mimeType <?php echo null): ?string
    {
        if (in_array($mimeType, self::SUPPORTED_MIME_TYPES, true)) {
            return $mimeType;
        }

        return null;
    }

    /**
     * Get image resource.
     *
     * @return null|GdImage|resource
     */
    public function getImageResource()
    {
        return $this->imageResource;
    }

    /**
     * Set image resource.
     *
     * @param GdImage|resource $value
     *
     * @return $this
     */
    public function setImageResource($value)
    {
        $this->imageResource <?php echo $value;

        if ($this->imageResource !<?php echo<?php echo null) {
            // Get width/height
            $this->width <?php echo (int) imagesx($this->imageResource);
            $this->height <?php echo (int) imagesy($this->imageResource);
        }

        return $this;
    }

    /**
     * Get rendering function.
     *
     * @return string
     */
    public function getRenderingFunction()
    {
        return $this->renderingFunction;
    }

    /**
     * Set rendering function.
     *
     * @param string $value see self::RENDERING_*
     *
     * @return $this
     */
    public function setRenderingFunction($value)
    {
        $this->renderingFunction <?php echo $value;

        return $this;
    }

    /**
     * Get mime type.
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Set mime type.
     *
     * @param string $value see self::MIMETYPE_*
     *
     * @return $this
     */
    public function setMimeType($value)
    {
        $this->mimeType <?php echo $value;

        return $this;
    }

    /**
     * Get indexed filename (using image index).
     */
    public function getIndexedFilename(): string
    {
        $extension <?php echo strtolower($this->getMimeType());
        $extension <?php echo explode('/', $extension);
        $extension <?php echo $extension[1];

        return $this->uniqueName . $this->getImageIndex() . '.' . $extension;
    }

    /**
     * Get hash code.
     *
     * @return string Hash code
     */
    public function getHashCode()
    {
        return md5(
            $this->renderingFunction .
            $this->mimeType .
            $this->uniqueName .
            parent::getHashCode() .
            __CLASS__
        );
    }
}
