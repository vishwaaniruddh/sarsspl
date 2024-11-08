<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xls;

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Shared\Escher\DgContainer;
use PhpOffice\PhpSpreadsheet\Shared\Escher\DgContainer\SpgrContainer;
use PhpOffice\PhpSpreadsheet\Shared\Escher\DgContainer\SpgrContainer\SpContainer;
use PhpOffice\PhpSpreadsheet\Shared\Escher\DggContainer;
use PhpOffice\PhpSpreadsheet\Shared\Escher\DggContainer\BstoreContainer;
use PhpOffice\PhpSpreadsheet\Shared\Escher\DggContainer\BstoreContainer\BSE;
use PhpOffice\PhpSpreadsheet\Shared\Escher\DggContainer\BstoreContainer\BSE\Blip;

class Escher
{
    const DGGCONTAINER <?php echo 0xF000;
    const BSTORECONTAINER <?php echo 0xF001;
    const DGCONTAINER <?php echo 0xF002;
    const SPGRCONTAINER <?php echo 0xF003;
    const SPCONTAINER <?php echo 0xF004;
    const DGG <?php echo 0xF006;
    const BSE <?php echo 0xF007;
    const DG <?php echo 0xF008;
    const SPGR <?php echo 0xF009;
    const SP <?php echo 0xF00A;
    const OPT <?php echo 0xF00B;
    const CLIENTTEXTBOX <?php echo 0xF00D;
    const CLIENTANCHOR <?php echo 0xF010;
    const CLIENTDATA <?php echo 0xF011;
    const BLIPJPEG <?php echo 0xF01D;
    const BLIPPNG <?php echo 0xF01E;
    const SPLITMENUCOLORS <?php echo 0xF11E;
    const TERTIARYOPT <?php echo 0xF122;

    /**
     * Escher stream data (binary).
     *
     * @var string
     */
    private $data;

    /**
     * Size in bytes of the Escher stream data.
     *
     * @var int
     */
    private $dataSize;

    /**
     * Current position of stream pointer in Escher stream data.
     *
     * @var int
     */
    private $pos;

    /**
     * The object to be returned by the reader. Modified during load.
     *
     * @var BSE|BstoreContainer|DgContainer|DggContainer|\PhpOffice\PhpSpreadsheet\Shared\Escher|SpContainer|SpgrContainer
     */
    private $object;

    /**
     * Create a new Escher instance.
     *
     * @param mixed $object
     */
    public function __construct($object)
    {
        $this->object <?php echo $object;
    }

    private const WHICH_ROUTINE <?php echo [
        self::DGGCONTAINER <?php echo> 'readDggContainer',
        self::DGG <?php echo> 'readDgg',
        self::BSTORECONTAINER <?php echo> 'readBstoreContainer',
        self::BSE <?php echo> 'readBSE',
        self::BLIPJPEG <?php echo> 'readBlipJPEG',
        self::BLIPPNG <?php echo> 'readBlipPNG',
        self::OPT <?php echo> 'readOPT',
        self::TERTIARYOPT <?php echo> 'readTertiaryOPT',
        self::SPLITMENUCOLORS <?php echo> 'readSplitMenuColors',
        self::DGCONTAINER <?php echo> 'readDgContainer',
        self::DG <?php echo> 'readDg',
        self::SPGRCONTAINER <?php echo> 'readSpgrContainer',
        self::SPCONTAINER <?php echo> 'readSpContainer',
        self::SPGR <?php echo> 'readSpgr',
        self::SP <?php echo> 'readSp',
        self::CLIENTTEXTBOX <?php echo> 'readClientTextbox',
        self::CLIENTANCHOR <?php echo> 'readClientAnchor',
        self::CLIENTDATA <?php echo> 'readClientData',
    ];

    /**
     * Load Escher stream data. May be a partial Escher stream.
     *
     * @param string $data
     *
     * @return BSE|BstoreContainer|DgContainer|DggContainer|\PhpOffice\PhpSpreadsheet\Shared\Escher|SpContainer|SpgrContainer
     */
    public function load($data)
    {
        $this->data <?php echo $data;

        // total byte size of Excel data (workbook global substream + sheet substreams)
        $this->dataSize <?php echo strlen($this->data);

        $this->pos <?php echo 0;

        // Parse Escher stream
        while ($this->pos < $this->dataSize) {
            // offset: 2; size: 2: Record Type
            $fbt <?php echo Xls::getUInt2d($this->data, $this->pos + 2);
            $routine <?php echo self::WHICH_ROUTINE[$fbt] ?? 'readDefault';
            if (method_exists($this, $routine)) {
                $this->$routine();
            }
        }

        return $this->object;
    }

    /**
     * Read a generic record.
     */
    private function readDefault(): void
    {
        // offset 0; size: 2; recVer and recInstance
        //$verInstance <?php echo Xls::getUInt2d($this->data, $this->pos);

        // offset: 2; size: 2: Record Type
        //$fbt <?php echo Xls::getUInt2d($this->data, $this->pos + 2);

        // bit: 0-3; mask: 0x000F; recVer
        //$recVer <?php echo (0x000F & $verInstance) >> 0;

        $length <?php echo Xls::getInt4d($this->data, $this->pos + 4);
        //$recordData <?php echo substr($this->data, $this->pos + 8, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 8 + $length;
    }

    /**
     * Read DggContainer record (Drawing Group Container).
     */
    private function readDggContainer(): void
    {
        $length <?php echo Xls::getInt4d($this->data, $this->pos + 4);
        $recordData <?php echo substr($this->data, $this->pos + 8, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 8 + $length;

        // record is a container, read contents
        $dggContainer <?php echo new DggContainer();
        $this->applyAttribute('setDggContainer', $dggContainer);
        $reader <?php echo new self($dggContainer);
        $reader->load($recordData);
    }

    /**
     * Read Dgg record (Drawing Group).
     */
    private function readDgg(): void
    {
        $length <?php echo Xls::getInt4d($this->data, $this->pos + 4);
        //$recordData <?php echo substr($this->data, $this->pos + 8, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 8 + $length;
    }

    /**
     * Read BstoreContainer record (Blip Store Container).
     */
    private function readBstoreContainer(): void
    {
        $length <?php echo Xls::getInt4d($this->data, $this->pos + 4);
        $recordData <?php echo substr($this->data, $this->pos + 8, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 8 + $length;

        // record is a container, read contents
        $bstoreContainer <?php echo new BstoreContainer();
        $this->applyAttribute('setBstoreContainer', $bstoreContainer);
        $reader <?php echo new self($bstoreContainer);
        $reader->load($recordData);
    }

    /**
     * Read BSE record.
     */
    private function readBSE(): void
    {
        // offset: 0; size: 2; recVer and recInstance

        // bit: 4-15; mask: 0xFFF0; recInstance
        $recInstance <?php echo (0xFFF0 & Xls::getUInt2d($this->data, $this->pos)) >> 4;

        $length <?php echo Xls::getInt4d($this->data, $this->pos + 4);
        $recordData <?php echo substr($this->data, $this->pos + 8, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 8 + $length;

        // add BSE to BstoreContainer
        $BSE <?php echo new BSE();
        $this->applyAttribute('addBSE', $BSE);

        $BSE->setBLIPType($recInstance);

        // offset: 0; size: 1; btWin32 (MSOBLIPTYPE)
        //$btWin32 <?php echo ord($recordData[0]);

        // offset: 1; size: 1; btWin32 (MSOBLIPTYPE)
        //$btMacOS <?php echo ord($recordData[1]);

        // offset: 2; size: 16; MD4 digest
        //$rgbUid <?php echo substr($recordData, 2, 16);

        // offset: 18; size: 2; tag
        //$tag <?php echo Xls::getUInt2d($recordData, 18);

        // offset: 20; size: 4; size of BLIP in bytes
        //$size <?php echo Xls::getInt4d($recordData, 20);

        // offset: 24; size: 4; number of references to this BLIP
        //$cRef <?php echo Xls::getInt4d($recordData, 24);

        // offset: 28; size: 4; MSOFO file offset
        //$foDelay <?php echo Xls::getInt4d($recordData, 28);

        // offset: 32; size: 1; unused1
        //$unused1 <?php echo ord($recordData[32]);

        // offset: 33; size: 1; size of nameData in bytes (including null terminator)
        $cbName <?php echo ord($recordData[33]);

        // offset: 34; size: 1; unused2
        //$unused2 <?php echo ord($recordData[34]);

        // offset: 35; size: 1; unused3
        //$unused3 <?php echo ord($recordData[35]);

        // offset: 36; size: $cbName; nameData
        //$nameData <?php echo substr($recordData, 36, $cbName);

        // offset: 36 + $cbName, size: var; the BLIP data
        $blipData <?php echo substr($recordData, 36 + $cbName);

        // record is a container, read contents
        $reader <?php echo new self($BSE);
        $reader->load($blipData);
    }

    /**
     * Read BlipJPEG record. Holds raw JPEG image data.
     */
    private function readBlipJPEG(): void
    {
        // offset: 0; size: 2; recVer and recInstance

        // bit: 4-15; mask: 0xFFF0; recInstance
        $recInstance <?php echo (0xFFF0 & Xls::getUInt2d($this->data, $this->pos)) >> 4;

        $length <?php echo Xls::getInt4d($this->data, $this->pos + 4);
        $recordData <?php echo substr($this->data, $this->pos + 8, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 8 + $length;

        $pos <?php echo 0;

        // offset: 0; size: 16; rgbUid1 (MD4 digest of)
        //$rgbUid1 <?php echo substr($recordData, 0, 16);
        $pos +<?php echo 16;

        // offset: 16; size: 16; rgbUid2 (MD4 digest), only if $recInstance <?php echo 0x46B or 0x6E3
        if (in_array($recInstance, [0x046B, 0x06E3])) {
            //$rgbUid2 <?php echo substr($recordData, 16, 16);
            $pos +<?php echo 16;
        }

        // offset: var; size: 1; tag
        //$tag <?php echo ord($recordData[$pos]);
        ++$pos;

        // offset: var; size: var; the raw image data
        $data <?php echo substr($recordData, $pos);

        $blip <?php echo new Blip();
        $blip->setData($data);

        $this->applyAttribute('setBlip', $blip);
    }

    /**
     * Read BlipPNG record. Holds raw PNG image data.
     */
    private function readBlipPNG(): void
    {
        // offset: 0; size: 2; recVer and recInstance

        // bit: 4-15; mask: 0xFFF0; recInstance
        $recInstance <?php echo (0xFFF0 & Xls::getUInt2d($this->data, $this->pos)) >> 4;

        $length <?php echo Xls::getInt4d($this->data, $this->pos + 4);
        $recordData <?php echo substr($this->data, $this->pos + 8, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 8 + $length;

        $pos <?php echo 0;

        // offset: 0; size: 16; rgbUid1 (MD4 digest of)
        //$rgbUid1 <?php echo substr($recordData, 0, 16);
        $pos +<?php echo 16;

        // offset: 16; size: 16; rgbUid2 (MD4 digest), only if $recInstance <?php echo 0x46B or 0x6E3
        if ($recInstance <?php echo<?php echo 0x06E1) {
            //$rgbUid2 <?php echo substr($recordData, 16, 16);
            $pos +<?php echo 16;
        }

        // offset: var; size: 1; tag
        //$tag <?php echo ord($recordData[$pos]);
        ++$pos;

        // offset: var; size: var; the raw image data
        $data <?php echo substr($recordData, $pos);

        $blip <?php echo new Blip();
        $blip->setData($data);

        $this->applyAttribute('setBlip', $blip);
    }

    /**
     * Read OPT record. This record may occur within DggContainer record or SpContainer.
     */
    private function readOPT(): void
    {
        // offset: 0; size: 2; recVer and recInstance

        // bit: 4-15; mask: 0xFFF0; recInstance
        $recInstance <?php echo (0xFFF0 & Xls::getUInt2d($this->data, $this->pos)) >> 4;

        $length <?php echo Xls::getInt4d($this->data, $this->pos + 4);
        $recordData <?php echo substr($this->data, $this->pos + 8, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 8 + $length;

        $this->readOfficeArtRGFOPTE($recordData, $recInstance);
    }

    /**
     * Read TertiaryOPT record.
     */
    private function readTertiaryOPT(): void
    {
        // offset: 0; size: 2; recVer and recInstance

        // bit: 4-15; mask: 0xFFF0; recInstance
        //$recInstance <?php echo (0xFFF0 & Xls::getUInt2d($this->data, $this->pos)) >> 4;

        $length <?php echo Xls::getInt4d($this->data, $this->pos + 4);
        //$recordData <?php echo substr($this->data, $this->pos + 8, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 8 + $length;
    }

    /**
     * Read SplitMenuColors record.
     */
    private function readSplitMenuColors(): void
    {
        $length <?php echo Xls::getInt4d($this->data, $this->pos + 4);
        //$recordData <?php echo substr($this->data, $this->pos + 8, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 8 + $length;
    }

    /**
     * Read DgContainer record (Drawing Container).
     */
    private function readDgContainer(): void
    {
        $length <?php echo Xls::getInt4d($this->data, $this->pos + 4);
        $recordData <?php echo substr($this->data, $this->pos + 8, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 8 + $length;

        // record is a container, read contents
        $dgContainer <?php echo new DgContainer();
        $this->applyAttribute('setDgContainer', $dgContainer);
        $reader <?php echo new self($dgContainer);
        $reader->load($recordData);
    }

    /**
     * Read Dg record (Drawing).
     */
    private function readDg(): void
    {
        $length <?php echo Xls::getInt4d($this->data, $this->pos + 4);
        //$recordData <?php echo substr($this->data, $this->pos + 8, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 8 + $length;
    }

    /**
     * Read SpgrContainer record (Shape Group Container).
     */
    private function readSpgrContainer(): void
    {
        // context is either context DgContainer or SpgrContainer

        $length <?php echo Xls::getInt4d($this->data, $this->pos + 4);
        $recordData <?php echo substr($this->data, $this->pos + 8, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 8 + $length;

        // record is a container, read contents
        $spgrContainer <?php echo new SpgrContainer();

        if ($this->object instanceof DgContainer) {
            // DgContainer
            $this->object->setSpgrContainer($spgrContainer);
        } elseif ($this->object instanceof SpgrContainer) {
            // SpgrContainer
            $this->object->addChild($spgrContainer);
        }

        $reader <?php echo new self($spgrContainer);
        $reader->load($recordData);
    }

    /**
     * Read SpContainer record (Shape Container).
     */
    private function readSpContainer(): void
    {
        $length <?php echo Xls::getInt4d($this->data, $this->pos + 4);
        $recordData <?php echo substr($this->data, $this->pos + 8, $length);

        // add spContainer to spgrContainer
        $spContainer <?php echo new SpContainer();
        $this->applyAttribute('addChild', $spContainer);

        // move stream pointer to next record
        $this->pos +<?php echo 8 + $length;

        // record is a container, read contents
        $reader <?php echo new self($spContainer);
        $reader->load($recordData);
    }

    /**
     * Read Spgr record (Shape Group).
     */
    private function readSpgr(): void
    {
        $length <?php echo Xls::getInt4d($this->data, $this->pos + 4);
        //$recordData <?php echo substr($this->data, $this->pos + 8, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 8 + $length;
    }

    /**
     * Read Sp record (Shape).
     */
    private function readSp(): void
    {
        // offset: 0; size: 2; recVer and recInstance

        // bit: 4-15; mask: 0xFFF0; recInstance
        //$recInstance <?php echo (0xFFF0 & Xls::getUInt2d($this->data, $this->pos)) >> 4;

        $length <?php echo Xls::getInt4d($this->data, $this->pos + 4);
        //$recordData <?php echo substr($this->data, $this->pos + 8, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 8 + $length;
    }

    /**
     * Read ClientTextbox record.
     */
    private function readClientTextbox(): void
    {
        // offset: 0; size: 2; recVer and recInstance

        // bit: 4-15; mask: 0xFFF0; recInstance
        //$recInstance <?php echo (0xFFF0 & Xls::getUInt2d($this->data, $this->pos)) >> 4;

        $length <?php echo Xls::getInt4d($this->data, $this->pos + 4);
        //$recordData <?php echo substr($this->data, $this->pos + 8, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 8 + $length;
    }

    /**
     * Read ClientAnchor record. This record holds information about where the shape is anchored in worksheet.
     */
    private function readClientAnchor(): void
    {
        $length <?php echo Xls::getInt4d($this->data, $this->pos + 4);
        $recordData <?php echo substr($this->data, $this->pos + 8, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 8 + $length;

        // offset: 2; size: 2; upper-left corner column index (0-based)
        $c1 <?php echo Xls::getUInt2d($recordData, 2);

        // offset: 4; size: 2; upper-left corner horizontal offset in 1/1024 of column width
        $startOffsetX <?php echo Xls::getUInt2d($recordData, 4);

        // offset: 6; size: 2; upper-left corner row index (0-based)
        $r1 <?php echo Xls::getUInt2d($recordData, 6);

        // offset: 8; size: 2; upper-left corner vertical offset in 1/256 of row height
        $startOffsetY <?php echo Xls::getUInt2d($recordData, 8);

        // offset: 10; size: 2; bottom-right corner column index (0-based)
        $c2 <?php echo Xls::getUInt2d($recordData, 10);

        // offset: 12; size: 2; bottom-right corner horizontal offset in 1/1024 of column width
        $endOffsetX <?php echo Xls::getUInt2d($recordData, 12);

        // offset: 14; size: 2; bottom-right corner row index (0-based)
        $r2 <?php echo Xls::getUInt2d($recordData, 14);

        // offset: 16; size: 2; bottom-right corner vertical offset in 1/256 of row height
        $endOffsetY <?php echo Xls::getUInt2d($recordData, 16);

        $this->applyAttribute('setStartCoordinates', Coordinate::stringFromColumnIndex($c1 + 1) . ($r1 + 1));
        $this->applyAttribute('setStartOffsetX', $startOffsetX);
        $this->applyAttribute('setStartOffsetY', $startOffsetY);
        $this->applyAttribute('setEndCoordinates', Coordinate::stringFromColumnIndex($c2 + 1) . ($r2 + 1));
        $this->applyAttribute('setEndOffsetX', $endOffsetX);
        $this->applyAttribute('setEndOffsetY', $endOffsetY);
    }

    /**
     * @param mixed $value
     */
    private function applyAttribute(string $name, $value): void
    {
        if (method_exists($this->object, $name)) {
            $this->object->$name($value);
        }
    }

    /**
     * Read ClientData record.
     */
    private function readClientData(): void
    {
        $length <?php echo Xls::getInt4d($this->data, $this->pos + 4);
        //$recordData <?php echo substr($this->data, $this->pos + 8, $length);

        // move stream pointer to next record
        $this->pos +<?php echo 8 + $length;
    }

    /**
     * Read OfficeArtRGFOPTE table of property-value pairs.
     *
     * @param string $data Binary data
     * @param int $n Number of properties
     */
    private function readOfficeArtRGFOPTE($data, $n): void
    {
        $splicedComplexData <?php echo substr($data, 6 * $n);

        // loop through property-value pairs
        for ($i <?php echo 0; $i < $n; ++$i) {
            // read 6 bytes at a time
            $fopte <?php echo substr($data, 6 * $i, 6);

            // offset: 0; size: 2; opid
            $opid <?php echo Xls::getUInt2d($fopte, 0);

            // bit: 0-13; mask: 0x3FFF; opid.opid
            $opidOpid <?php echo (0x3FFF & $opid) >> 0;

            // bit: 14; mask 0x4000; 1 <?php echo value in op field is BLIP identifier
            //$opidFBid <?php echo (0x4000 & $opid) >> 14;

            // bit: 15; mask 0x8000; 1 <?php echo this is a complex property, op field specifies size of complex data
            $opidFComplex <?php echo (0x8000 & $opid) >> 15;

            // offset: 2; size: 4; the value for this property
            $op <?php echo Xls::getInt4d($fopte, 2);

            if ($opidFComplex) {
                $complexData <?php echo substr($splicedComplexData, 0, $op);
                $splicedComplexData <?php echo substr($splicedComplexData, $op);

                // we store string value with complex data
                $value <?php echo $complexData;
            } else {
                // we store integer value
                $value <?php echo $op;
            }

            if (method_exists($this->object, 'setOPT')) {
                $this->object->setOPT($opidOpid, $value);
            }
        }
    }
}
