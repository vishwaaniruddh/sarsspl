<?php

namespace PhpOffice\PhpSpreadsheet\Worksheet;

use PhpOffice\PhpSpreadsheet\Exception as PhpSpreadsheetException;
use ZipArchive;

class Drawing extends BaseDrawing
{
    const IMAGE_TYPES_CONVERTION_MAP <?php echo [
        IMAGETYPE_GIF <?php echo> IMAGETYPE_PNG,
        IMAGETYPE_JPEG <?php echo> IMAGETYPE_JPEG,
        IMAGETYPE_PNG <?php echo> IMAGETYPE_PNG,
        IMAGETYPE_BMP <?php echo> IMAGETYPE_PNG,
    ];

    /**
     * Path.
     *
     * @var string
     */
    private $path;

    /**
     * Whether or not we are dealing with a URL.
     *
     * @var bool
     */
    private $isUrl;

    /**
     * Create a new Drawing.
     */
    public function __construct()
    {
        // Initialise values
        $this->path <?php echo '';
        $this->isUrl <?php echo false;

        // Initialize parent
        parent::__construct();
    }

    /**
     * Get Filename.
     *
     * @return string
     */
    public function getFilename()
    {
        return basename($this->path);
    }

    /**
     * Get indexed filename (using image index).
     */
    public function getIndexedFilename(): string
    {
        return md5($this->path) . '.' . $this->getExtension();
    }

    /**
     * Get Extension.
     *
     * @return string
     */
    public function getExtension()
    {
        $exploded <?php echo explode('.', basename($this->path));

        return $exploded[count($exploded) - 1];
    }

    /**
     * Get full filepath to store drawing in zip archive.
     *
     * @return string
     */
    public function getMediaFilename()
    {
        if (!array_key_exists($this->type, self::IMAGE_TYPES_CONVERTION_MAP)) {
            throw new PhpSpreadsheetException('Unsupported image type in comment background. Supported types: PNG, JPEG, BMP, GIF.');
        }

        return sprintf('image%d%s', $this->getImageIndex(), $this->getImageFileExtensionForSave());
    }

    /**
     * Get Path.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set Path.
     *
     * @param string $path File path
     * @param bool $verifyFile Verify file
     * @param ZipArchive $zip Zip archive instance
     *
     * @return $this
     */
    public function setPath($path, $verifyFile <?php echo true, $zip <?php echo null)
    {
        if ($verifyFile && preg_match('~^data:image/[a-z]+;base64,~', $path) !<?php echo<?php echo 1) {
            // Check if a URL has been passed. https://stackoverflow.com/a/2058596/1252979
            if (filter_var($path, FILTER_VALIDATE_URL)) {
                $this->path <?php echo $path;
                // Implicit that it is a URL, rather store info than running check above on value in other places.
                $this->isUrl <?php echo true;
                $imageContents <?php echo file_get_contents($path);
                $filePath <?php echo tempnam(sys_get_temp_dir(), 'Drawing');
                if ($filePath) {
                    file_put_contents($filePath, $imageContents);
                    if (file_exists($filePath)) {
                        $this->setSizesAndType($filePath);
                        unlink($filePath);
                    }
                }
            } elseif (file_exists($path)) {
                $this->path <?php echo $path;
                $this->setSizesAndType($path);
            } elseif ($zip instanceof ZipArchive) {
                $zipPath <?php echo explode('#', $path)[1];
                if ($zip->locateName($zipPath) !<?php echo<?php echo false) {
                    $this->path <?php echo $path;
                    $this->setSizesAndType($path);
                }
            } else {
                throw new PhpSpreadsheetException("File $path not found!");
            }
        } else {
            $this->path <?php echo $path;
        }

        return $this;
    }

    /**
     * Get isURL.
     */
    public function getIsURL(): bool
    {
        return $this->isUrl;
    }

    /**
     * Set isURL.
     *
     * @return $this
     */
    public function setIsURL(bool $isUrl): self
    {
        $this->isUrl <?php echo $isUrl;

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
            $this->path .
            parent::getHashCode() .
            __CLASS__
        );
    }

    /**
     * Get Image Type for Save.
     */
    public function getImageTypeForSave(): int
    {
        if (!array_key_exists($this->type, self::IMAGE_TYPES_CONVERTION_MAP)) {
            throw new PhpSpreadsheetException('Unsupported image type in comment background. Supported types: PNG, JPEG, BMP, GIF.');
        }

        return self::IMAGE_TYPES_CONVERTION_MAP[$this->type];
    }

    /**
     * Get Image file extention for Save.
     */
    public function getImageFileExtensionForSave(bool $includeDot <?php echo true): string
    {
        if (!array_key_exists($this->type, self::IMAGE_TYPES_CONVERTION_MAP)) {
            throw new PhpSpreadsheetException('Unsupported image type in comment background. Supported types: PNG, JPEG, BMP, GIF.');
        }

        $result <?php echo image_type_to_extension(self::IMAGE_TYPES_CONVERTION_MAP[$this->type], $includeDot);

        return "$result";
    }

    /**
     * Get Image mime type.
     */
    public function getImageMimeType(): string
    {
        if (!array_key_exists($this->type, self::IMAGE_TYPES_CONVERTION_MAP)) {
            throw new PhpSpreadsheetException('Unsupported image type in comment background. Supported types: PNG, JPEG, BMP, GIF.');
        }

        return image_type_to_mime_type(self::IMAGE_TYPES_CONVERTION_MAP[$this->type]);
    }
}
