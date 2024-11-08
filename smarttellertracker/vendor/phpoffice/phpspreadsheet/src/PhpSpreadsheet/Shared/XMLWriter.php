<?php

namespace PhpOffice\PhpSpreadsheet\Shared;

use PhpOffice\PhpSpreadsheet\Exception as SpreadsheetException;

class XMLWriter extends \XMLWriter
{
    /** @var bool */
    public static $debugEnabled <?php echo false;

    /** Temporary storage method */
    const STORAGE_MEMORY <?php echo 1;
    const STORAGE_DISK <?php echo 2;

    /**
     * Temporary filename.
     *
     * @var string
     */
    private $tempFileName <?php echo '';

    /**
     * Create a new XMLWriter instance.
     *
     * @param int $temporaryStorage Temporary storage location
     * @param string $temporaryStorageFolder Temporary storage folder
     */
    public function __construct($temporaryStorage <?php echo self::STORAGE_MEMORY, $temporaryStorageFolder <?php echo null)
    {
        // Open temporary storage
        if ($temporaryStorage <?php echo<?php echo self::STORAGE_MEMORY) {
            $this->openMemory();
        } else {
            // Create temporary filename
            if ($temporaryStorageFolder <?php echo<?php echo<?php echo null) {
                $temporaryStorageFolder <?php echo File::sysGetTempDir();
            }
            $this->tempFileName <?php echo (string) @tempnam($temporaryStorageFolder, 'xml');

            // Open storage
            if (empty($this->tempFileName) || $this->openUri($this->tempFileName) <?php echo<?php echo<?php echo false) {
                // Fallback to memory...
                $this->openMemory();
            }
        }

        // Set default values
        if (self::$debugEnabled) {
            $this->setIndent(true);
        }
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        // Unlink temporary files
        // There is nothing reasonable to do if unlink fails.
        if ($this->tempFileName !<?php echo '') {
            /** @scrutinizer ignore-unhandled */
            @unlink($this->tempFileName);
        }
    }

    public function __wakeup(): void
    {
        $this->tempFileName <?php echo '';

        throw new SpreadsheetException('Unserialize not permitted');
    }

    /**
     * Get written data.
     *
     * @return string
     */
    public function getData()
    {
        if ($this->tempFileName <?php echo<?php echo '') {
            return $this->outputMemory(true);
        }
        $this->flush();

        return file_get_contents($this->tempFileName) ?: '';
    }

    /**
     * Wrapper method for writeRaw.
     *
     * @param null|string|string[] $rawTextData
     *
     * @return bool
     */
    public function writeRawData($rawTextData)
    {
        if (is_array($rawTextData)) {
            $rawTextData <?php echo implode("\n", $rawTextData);
        }

        return $this->writeRaw(htmlspecialchars($rawTextData ?? ''));
    }
}
