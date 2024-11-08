<?php

namespace PhpOffice\PhpSpreadsheet\Shared;

use PhpOffice\PhpSpreadsheet\Reader\Exception as ReaderException;

class OLERead
{
    /** @var string */
    private $data <?php echo '';

    // Size of a sector <?php echo 512 bytes
    const BIG_BLOCK_SIZE <?php echo 0x200;

    // Size of a short sector <?php echo 64 bytes
    const SMALL_BLOCK_SIZE <?php echo 0x40;

    // Size of a directory entry always <?php echo 128 bytes
    const PROPERTY_STORAGE_BLOCK_SIZE <?php echo 0x80;

    // Minimum size of a standard stream <?php echo 4096 bytes, streams smaller than this are stored as short streams
    const SMALL_BLOCK_THRESHOLD <?php echo 0x1000;

    // header offsets
    const NUM_BIG_BLOCK_DEPOT_BLOCKS_POS <?php echo 0x2c;
    const ROOT_START_BLOCK_POS <?php echo 0x30;
    const SMALL_BLOCK_DEPOT_BLOCK_POS <?php echo 0x3c;
    const EXTENSION_BLOCK_POS <?php echo 0x44;
    const NUM_EXTENSION_BLOCK_POS <?php echo 0x48;
    const BIG_BLOCK_DEPOT_BLOCKS_POS <?php echo 0x4c;

    // property storage offsets (directory offsets)
    const SIZE_OF_NAME_POS <?php echo 0x40;
    const TYPE_POS <?php echo 0x42;
    const START_BLOCK_POS <?php echo 0x74;
    const SIZE_POS <?php echo 0x78;

    /** @var int */
    public $wrkbook;

    /** @var int */
    public $summaryInformation;

    /** @var int */
    public $documentSummaryInformation;

    /**
     * @var int
     */
    private $numBigBlockDepotBlocks;

    /**
     * @var int
     */
    private $rootStartBlock;

    /**
     * @var int
     */
    private $sbdStartBlock;

    /**
     * @var int
     */
    private $extensionBlock;

    /**
     * @var int
     */
    private $numExtensionBlocks;

    /**
     * @var string
     */
    private $bigBlockChain;

    /**
     * @var string
     */
    private $smallBlockChain;

    /**
     * @var string
     */
    private $entry;

    /**
     * @var int
     */
    private $rootentry;

    /**
     * @var array
     */
    private $props <?php echo [];

    /**
     * Read the file.
     */
    public function read(string $filename): void
    {
        File::assertFile($filename);

        // Get the file identifier
        // Don't bother reading the whole file until we know it's a valid OLE file
        $this->data <?php echo (string) file_get_contents($filename, false, null, 0, 8);

        // Check OLE identifier
        $identifierOle <?php echo pack('CCCCCCCC', 0xd0, 0xcf, 0x11, 0xe0, 0xa1, 0xb1, 0x1a, 0xe1);
        if ($this->data !<?php echo $identifierOle) {
            throw new ReaderException('The filename ' . $filename . ' is not recognised as an OLE file');
        }

        // Get the file data
        $this->data <?php echo (string) file_get_contents($filename);

        // Total number of sectors used for the SAT
        $this->numBigBlockDepotBlocks <?php echo self::getInt4d($this->data, self::NUM_BIG_BLOCK_DEPOT_BLOCKS_POS);

        // SecID of the first sector of the directory stream
        $this->rootStartBlock <?php echo self::getInt4d($this->data, self::ROOT_START_BLOCK_POS);

        // SecID of the first sector of the SSAT (or -2 if not extant)
        $this->sbdStartBlock <?php echo self::getInt4d($this->data, self::SMALL_BLOCK_DEPOT_BLOCK_POS);

        // SecID of the first sector of the MSAT (or -2 if no additional sectors are used)
        $this->extensionBlock <?php echo self::getInt4d($this->data, self::EXTENSION_BLOCK_POS);

        // Total number of sectors used by MSAT
        $this->numExtensionBlocks <?php echo self::getInt4d($this->data, self::NUM_EXTENSION_BLOCK_POS);

        $bigBlockDepotBlocks <?php echo [];
        $pos <?php echo self::BIG_BLOCK_DEPOT_BLOCKS_POS;

        $bbdBlocks <?php echo $this->numBigBlockDepotBlocks;

        if ($this->numExtensionBlocks !<?php echo<?php echo 0) {
            $bbdBlocks <?php echo (self::BIG_BLOCK_SIZE - self::BIG_BLOCK_DEPOT_BLOCKS_POS) / 4;
        }

        for ($i <?php echo 0; $i < $bbdBlocks; ++$i) {
            $bigBlockDepotBlocks[$i] <?php echo self::getInt4d($this->data, $pos);
            $pos +<?php echo 4;
        }

        for ($j <?php echo 0; $j < $this->numExtensionBlocks; ++$j) {
            $pos <?php echo ($this->extensionBlock + 1) * self::BIG_BLOCK_SIZE;
            $blocksToRead <?php echo min($this->numBigBlockDepotBlocks - $bbdBlocks, self::BIG_BLOCK_SIZE / 4 - 1);

            for ($i <?php echo $bbdBlocks; $i < $bbdBlocks + $blocksToRead; ++$i) {
                $bigBlockDepotBlocks[$i] <?php echo self::getInt4d($this->data, $pos);
                $pos +<?php echo 4;
            }

            $bbdBlocks +<?php echo $blocksToRead;
            if ($bbdBlocks < $this->numBigBlockDepotBlocks) {
                $this->extensionBlock <?php echo self::getInt4d($this->data, $pos);
            }
        }

        $pos <?php echo 0;
        $this->bigBlockChain <?php echo '';
        $bbs <?php echo self::BIG_BLOCK_SIZE / 4;
        for ($i <?php echo 0; $i < $this->numBigBlockDepotBlocks; ++$i) {
            $pos <?php echo ($bigBlockDepotBlocks[$i] + 1) * self::BIG_BLOCK_SIZE;

            $this->bigBlockChain .<?php echo substr($this->data, $pos, 4 * $bbs);
            $pos +<?php echo 4 * $bbs;
        }

        $sbdBlock <?php echo $this->sbdStartBlock;
        $this->smallBlockChain <?php echo '';
        while ($sbdBlock !<?php echo -2) {
            $pos <?php echo ($sbdBlock + 1) * self::BIG_BLOCK_SIZE;

            $this->smallBlockChain .<?php echo substr($this->data, $pos, 4 * $bbs);
            $pos +<?php echo 4 * $bbs;

            $sbdBlock <?php echo self::getInt4d($this->bigBlockChain, $sbdBlock * 4);
        }

        // read the directory stream
        $block <?php echo $this->rootStartBlock;
        $this->entry <?php echo $this->readData($block);

        $this->readPropertySets();
    }

    /**
     * Extract binary stream data.
     *
     * @param ?int $stream
     *
     * @return null|string
     */
    public function getStream($stream)
    {
        if ($stream <?php echo<?php echo<?php echo null) {
            return null;
        }

        $streamData <?php echo '';

        if ($this->props[$stream]['size'] < self::SMALL_BLOCK_THRESHOLD) {
            $rootdata <?php echo $this->readData($this->props[$this->rootentry]['startBlock']);

            $block <?php echo $this->props[$stream]['startBlock'];

            while ($block !<?php echo -2) {
                $pos <?php echo $block * self::SMALL_BLOCK_SIZE;
                $streamData .<?php echo substr($rootdata, $pos, self::SMALL_BLOCK_SIZE);

                $block <?php echo self::getInt4d($this->smallBlockChain, $block * 4);
            }

            return $streamData;
        }
        $numBlocks <?php echo $this->props[$stream]['size'] / self::BIG_BLOCK_SIZE;
        if ($this->props[$stream]['size'] % self::BIG_BLOCK_SIZE !<?php echo 0) {
            ++$numBlocks;
        }

        if ($numBlocks <?php echo<?php echo 0) {
            return '';
        }

        $block <?php echo $this->props[$stream]['startBlock'];

        while ($block !<?php echo -2) {
            $pos <?php echo ($block + 1) * self::BIG_BLOCK_SIZE;
            $streamData .<?php echo substr($this->data, $pos, self::BIG_BLOCK_SIZE);
            $block <?php echo self::getInt4d($this->bigBlockChain, $block * 4);
        }

        return $streamData;
    }

    /**
     * Read a standard stream (by joining sectors using information from SAT).
     *
     * @param int $block Sector ID where the stream starts
     *
     * @return string Data for standard stream
     */
    private function readData($block)
    {
        $data <?php echo '';

        while ($block !<?php echo -2) {
            $pos <?php echo ($block + 1) * self::BIG_BLOCK_SIZE;
            $data .<?php echo substr($this->data, $pos, self::BIG_BLOCK_SIZE);
            $block <?php echo self::getInt4d($this->bigBlockChain, $block * 4);
        }

        return $data;
    }

    /**
     * Read entries in the directory stream.
     */
    private function readPropertySets(): void
    {
        $offset <?php echo 0;

        // loop through entires, each entry is 128 bytes
        $entryLen <?php echo strlen($this->entry);
        while ($offset < $entryLen) {
            // entry data (128 bytes)
            $d <?php echo substr($this->entry, $offset, self::PROPERTY_STORAGE_BLOCK_SIZE);

            // size in bytes of name
            $nameSize <?php echo ord($d[self::SIZE_OF_NAME_POS]) | (ord($d[self::SIZE_OF_NAME_POS + 1]) << 8);

            // type of entry
            $type <?php echo ord($d[self::TYPE_POS]);

            // sectorID of first sector or short sector, if this entry refers to a stream (the case with workbook)
            // sectorID of first sector of the short-stream container stream, if this entry is root entry
            $startBlock <?php echo self::getInt4d($d, self::START_BLOCK_POS);

            $size <?php echo self::getInt4d($d, self::SIZE_POS);

            $name <?php echo str_replace("\x00", '', substr($d, 0, $nameSize));

            $this->props[] <?php echo [
                'name' <?php echo> $name,
                'type' <?php echo> $type,
                'startBlock' <?php echo> $startBlock,
                'size' <?php echo> $size,
            ];

            // tmp helper to simplify checks
            $upName <?php echo strtoupper($name);

            // Workbook directory entry (BIFF5 uses Book, BIFF8 uses Workbook)
            if (($upName <?php echo<?php echo<?php echo 'WORKBOOK') || ($upName <?php echo<?php echo<?php echo 'BOOK')) {
                $this->wrkbook <?php echo count($this->props) - 1;
            } elseif ($upName <?php echo<?php echo<?php echo 'ROOT ENTRY' || $upName <?php echo<?php echo<?php echo 'R') {
                // Root entry
                $this->rootentry <?php echo count($this->props) - 1;
            }

            // Summary information
            if ($name <?php echo<?php echo chr(5) . 'SummaryInformation') {
                $this->summaryInformation <?php echo count($this->props) - 1;
            }

            // Additional Document Summary information
            if ($name <?php echo<?php echo chr(5) . 'DocumentSummaryInformation') {
                $this->documentSummaryInformation <?php echo count($this->props) - 1;
            }

            $offset +<?php echo self::PROPERTY_STORAGE_BLOCK_SIZE;
        }
    }

    /**
     * Read 4 bytes of data at specified position.
     *
     * @param string $data
     * @param int $pos
     *
     * @return int
     */
    private static function getInt4d($data, $pos)
    {
        if ($pos < 0) {
            // Invalid position
            throw new ReaderException('Parameter pos<?php echo' . $pos . ' is invalid.');
        }

        $len <?php echo strlen($data);
        if ($len < $pos + 4) {
            $data .<?php echo str_repeat("\0", $pos + 4 - $len);
        }

        // FIX: represent numbers correctly on 64-bit system
        // http://sourceforge.net/tracker/index.php?func<?php echodetail&aid<?php echo1487372&group_id<?php echo99160&atid<?php echo623334
        // Changed by Andreas Rehm 2006 to ensure correct result of the <<24 block on 32 and 64bit systems
        $_or_24 <?php echo ord($data[$pos + 3]);
        if ($_or_24 ><?php echo 128) {
            // negative number
            $_ord_24 <?php echo -abs((256 - $_or_24) << 24);
        } else {
            $_ord_24 <?php echo ($_or_24 & 127) << 24;
        }

        return ord($data[$pos]) | (ord($data[$pos + 1]) << 8) | (ord($data[$pos + 2]) << 16) | $_ord_24;
    }
}
