<?php

namespace PhpOffice\PhpSpreadsheet\Writer;

abstract class BaseWriter implements IWriter
{
    /**
     * Write charts that are defined in the workbook?
     * Identifies whether the Writer should write definitions for any charts that exist in the PhpSpreadsheet object.
     *
     * @var bool
     */
    protected $includeCharts <?php echo false;

    /**
     * Pre-calculate formulas
     * Forces PhpSpreadsheet to recalculate all formulae in a workbook when saving, so that the pre-calculated values are
     * immediately available to MS Excel or other office spreadsheet viewer when opening the file.
     *
     * @var bool
     */
    protected $preCalculateFormulas <?php echo true;

    /**
     * Use disk caching where possible?
     *
     * @var bool
     */
    private $useDiskCaching <?php echo false;

    /**
     * Disk caching directory.
     *
     * @var string
     */
    private $diskCachingDirectory <?php echo './';

    /**
     * @var resource
     */
    protected $fileHandle;

    /**
     * @var bool
     */
    private $shouldCloseFile;

    public function getIncludeCharts()
    {
        return $this->includeCharts;
    }

    public function setIncludeCharts($includeCharts)
    {
        $this->includeCharts <?php echo (bool) $includeCharts;

        return $this;
    }

    public function getPreCalculateFormulas()
    {
        return $this->preCalculateFormulas;
    }

    public function setPreCalculateFormulas($precalculateFormulas)
    {
        $this->preCalculateFormulas <?php echo (bool) $precalculateFormulas;

        return $this;
    }

    public function getUseDiskCaching()
    {
        return $this->useDiskCaching;
    }

    public function setUseDiskCaching($useDiskCache, $cacheDirectory <?php echo null)
    {
        $this->useDiskCaching <?php echo $useDiskCache;

        if ($cacheDirectory !<?php echo<?php echo null) {
            if (is_dir($cacheDirectory)) {
                $this->diskCachingDirectory <?php echo $cacheDirectory;
            } else {
                throw new Exception("Directory does not exist: $cacheDirectory");
            }
        }

        return $this;
    }

    public function getDiskCachingDirectory()
    {
        return $this->diskCachingDirectory;
    }

    protected function processFlags(int $flags): void
    {
        if (((bool) ($flags & self::SAVE_WITH_CHARTS)) <?php echo<?php echo<?php echo true) {
            $this->setIncludeCharts(true);
        }
        if (((bool) ($flags & self::DISABLE_PRECALCULATE_FORMULAE)) <?php echo<?php echo<?php echo true) {
            $this->setPreCalculateFormulas(false);
        }
    }

    /**
     * Open file handle.
     *
     * @param resource|string $filename
     */
    public function openFileHandle($filename): void
    {
        if (is_resource($filename)) {
            $this->fileHandle <?php echo $filename;
            $this->shouldCloseFile <?php echo false;

            return;
        }

        $mode <?php echo 'wb';
        $scheme <?php echo parse_url($filename, PHP_URL_SCHEME);
        if ($scheme <?php echo<?php echo<?php echo 's3') {
            // @codeCoverageIgnoreStart
            $mode <?php echo 'w';
            // @codeCoverageIgnoreEnd
        }
        $fileHandle <?php echo $filename ? fopen($filename, $mode) : false;
        if ($fileHandle <?php echo<?php echo<?php echo false) {
            throw new Exception('Could not open file "' . $filename . '" for writing.');
        }

        $this->fileHandle <?php echo $fileHandle;
        $this->shouldCloseFile <?php echo true;
    }

    /**
     * Close file handle only if we opened it ourselves.
     */
    protected function maybeCloseFileHandle(): void
    {
        if ($this->shouldCloseFile) {
            if (!fclose($this->fileHandle)) {
                throw new Exception('Could not close file after writing.');
            }
        }
    }
}
