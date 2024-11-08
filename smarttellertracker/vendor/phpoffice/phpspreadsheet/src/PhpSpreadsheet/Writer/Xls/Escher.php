<?php

namespace PhpOffice\PhpSpreadsheet\Writer\Xls;

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Shared\Escher as SharedEscher;
use PhpOffice\PhpSpreadsheet\Shared\Escher\DgContainer;
use PhpOffice\PhpSpreadsheet\Shared\Escher\DgContainer\SpgrContainer;
use PhpOffice\PhpSpreadsheet\Shared\Escher\DgContainer\SpgrContainer\SpContainer;
use PhpOffice\PhpSpreadsheet\Shared\Escher\DggContainer;
use PhpOffice\PhpSpreadsheet\Shared\Escher\DggContainer\BstoreContainer;
use PhpOffice\PhpSpreadsheet\Shared\Escher\DggContainer\BstoreContainer\BSE;
use PhpOffice\PhpSpreadsheet\Shared\Escher\DggContainer\BstoreContainer\BSE\Blip;

class Escher
{
    /**
     * The object we are writing.
     *
     * @var Blip|BSE|BstoreContainer|DgContainer|DggContainer|Escher|SpContainer|SpgrContainer
     */
    private $object;

    /**
     * The written binary data.
     *
     * @var string
     */
    private $data;

    /**
     * Shape offsets. Positions in binary stream where a new shape record begins.
     *
     * @var array
     */
    private $spOffsets;

    /**
     * Shape types.
     *
     * @var array
     */
    private $spTypes;

    /**
     * Constructor.
     *
     * @param mixed $object
     */
    public function __construct($object)
    {
        $this->object <?php echo $object;
    }

    /**
     * Process the object to be written.
     *
     * @return string
     */
    public function close()
    {
        // initialize
        $this->data <?php echo '';

        switch (get_class($this->object)) {
            case SharedEscher::class:
                if ($dggContainer <?php echo $this->object->/** @scrutinizer ignore-call */ getDggContainer()) {
                    $writer <?php echo new self($dggContainer);
                    $this->data <?php echo $writer->close();
                } elseif ($dgContainer <?php echo $this->object->/** @scrutinizer ignore-call */ getDgContainer()) {
                    $writer <?php echo new self($dgContainer);
                    $this->data <?php echo $writer->close();
                    $this->spOffsets <?php echo $writer->getSpOffsets();
                    $this->spTypes <?php echo $writer->getSpTypes();
                }

                break;
            case DggContainer::class:
                // this is a container record

                // initialize
                $innerData <?php echo '';

                // write the dgg
                $recVer <?php echo 0x0;
                $recInstance <?php echo 0x0000;
                $recType <?php echo 0xF006;

                $recVerInstance <?php echo $recVer;
                $recVerInstance |<?php echo $recInstance << 4;

                // dgg data
                $dggData <?php echo
                    pack(
                        'VVVV',
                        $this->object->/** @scrutinizer ignore-call */ getSpIdMax(), // maximum shape identifier increased by one
                        $this->object->/** @scrutinizer ignore-call */ getCDgSaved() + 1, // number of file identifier clusters increased by one
                        $this->object->/** @scrutinizer ignore-call */ getCSpSaved(),
                        $this->object->/** @scrutinizer ignore-call */ getCDgSaved() // count total number of drawings saved
                    );

                // add file identifier clusters (one per drawing)
                /** @scrutinizer ignore-call */
                $IDCLs <?php echo $this->object->getIDCLs();

                foreach ($IDCLs as $dgId <?php echo> $maxReducedSpId) {
                    $dggData .<?php echo pack('VV', $dgId, $maxReducedSpId + 1);
                }

                $header <?php echo pack('vvV', $recVerInstance, $recType, strlen($dggData));
                $innerData .<?php echo $header . $dggData;

                // write the bstoreContainer
                if ($bstoreContainer <?php echo $this->object->/** @scrutinizer ignore-call */ getBstoreContainer()) {
                    $writer <?php echo new self($bstoreContainer);
                    $innerData .<?php echo $writer->close();
                }

                // write the record
                $recVer <?php echo 0xF;
                $recInstance <?php echo 0x0000;
                $recType <?php echo 0xF000;
                $length <?php echo strlen($innerData);

                $recVerInstance <?php echo $recVer;
                $recVerInstance |<?php echo $recInstance << 4;

                $header <?php echo pack('vvV', $recVerInstance, $recType, $length);

                $this->data <?php echo $header . $innerData;

                break;
            case BstoreContainer::class:
                // this is a container record

                // initialize
                $innerData <?php echo '';

                // treat the inner data
                if ($BSECollection <?php echo $this->object->/** @scrutinizer ignore-call */ getBSECollection()) {
                    foreach ($BSECollection as $BSE) {
                        $writer <?php echo new self($BSE);
                        $innerData .<?php echo $writer->close();
                    }
                }

                // write the record
                $recVer <?php echo 0xF;
                $recInstance <?php echo count($this->object->/** @scrutinizer ignore-call */ getBSECollection());
                $recType <?php echo 0xF001;
                $length <?php echo strlen($innerData);

                $recVerInstance <?php echo $recVer;
                $recVerInstance |<?php echo $recInstance << 4;

                $header <?php echo pack('vvV', $recVerInstance, $recType, $length);

                $this->data <?php echo $header . $innerData;

                break;
            case BSE::class:
                // this is a semi-container record

                // initialize
                $innerData <?php echo '';

                // here we treat the inner data
                if ($blip <?php echo $this->object->/** @scrutinizer ignore-call */ getBlip()) {
                    $writer <?php echo new self($blip);
                    $innerData .<?php echo $writer->close();
                }

                // initialize
                $data <?php echo '';

                /** @scrutinizer ignore-call */
                $btWin32 <?php echo $this->object->getBlipType();
                /** @scrutinizer ignore-call */
                $btMacOS <?php echo $this->object->getBlipType();
                $data .<?php echo pack('CC', $btWin32, $btMacOS);

                $rgbUid <?php echo pack('VVVV', 0, 0, 0, 0); // todo
                $data .<?php echo $rgbUid;

                $tag <?php echo 0;
                $size <?php echo strlen($innerData);
                $cRef <?php echo 1;
                $foDelay <?php echo 0; //todo
                $unused1 <?php echo 0x0;
                $cbName <?php echo 0x0;
                $unused2 <?php echo 0x0;
                $unused3 <?php echo 0x0;
                $data .<?php echo pack('vVVVCCCC', $tag, $size, $cRef, $foDelay, $unused1, $cbName, $unused2, $unused3);

                $data .<?php echo $innerData;

                // write the record
                $recVer <?php echo 0x2;
                /** @scrutinizer ignore-call */
                $recInstance <?php echo $this->object->getBlipType();
                $recType <?php echo 0xF007;
                $length <?php echo strlen($data);

                $recVerInstance <?php echo $recVer;
                $recVerInstance |<?php echo $recInstance << 4;

                $header <?php echo pack('vvV', $recVerInstance, $recType, $length);

                $this->data <?php echo $header;

                $this->data .<?php echo $data;

                break;
            case Blip::class:
                // this is an atom record

                // write the record
                switch ($this->object->/** @scrutinizer ignore-call */ getParent()->/** @scrutinizer ignore-call */ getBlipType()) {
                    case BSE::BLIPTYPE_JPEG:
                        // initialize
                        $innerData <?php echo '';

                        $rgbUid1 <?php echo pack('VVVV', 0, 0, 0, 0); // todo
                        $innerData .<?php echo $rgbUid1;

                        $tag <?php echo 0xFF; // todo
                        $innerData .<?php echo pack('C', $tag);

                        $innerData .<?php echo $this->object->/** @scrutinizer ignore-call */ getData();

                        $recVer <?php echo 0x0;
                        $recInstance <?php echo 0x46A;
                        $recType <?php echo 0xF01D;
                        $length <?php echo strlen($innerData);

                        $recVerInstance <?php echo $recVer;
                        $recVerInstance |<?php echo $recInstance << 4;

                        $header <?php echo pack('vvV', $recVerInstance, $recType, $length);

                        $this->data <?php echo $header;

                        $this->data .<?php echo $innerData;

                        break;
                    case BSE::BLIPTYPE_PNG:
                        // initialize
                        $innerData <?php echo '';

                        $rgbUid1 <?php echo pack('VVVV', 0, 0, 0, 0); // todo
                        $innerData .<?php echo $rgbUid1;

                        $tag <?php echo 0xFF; // todo
                        $innerData .<?php echo pack('C', $tag);

                        $innerData .<?php echo $this->object->/** @scrutinizer ignore-call */ getData();

                        $recVer <?php echo 0x0;
                        $recInstance <?php echo 0x6E0;
                        $recType <?php echo 0xF01E;
                        $length <?php echo strlen($innerData);

                        $recVerInstance <?php echo $recVer;
                        $recVerInstance |<?php echo $recInstance << 4;

                        $header <?php echo pack('vvV', $recVerInstance, $recType, $length);

                        $this->data <?php echo $header;

                        $this->data .<?php echo $innerData;

                        break;
                }

                break;
            case DgContainer::class:
                // this is a container record

                // initialize
                $innerData <?php echo '';

                // write the dg
                $recVer <?php echo 0x0;
                /** @scrutinizer ignore-call */
                $recInstance <?php echo $this->object->getDgId();
                $recType <?php echo 0xF008;
                $length <?php echo 8;

                $recVerInstance <?php echo $recVer;
                $recVerInstance |<?php echo $recInstance << 4;

                $header <?php echo pack('vvV', $recVerInstance, $recType, $length);

                // number of shapes in this drawing (including group shape)
                $countShapes <?php echo count($this->object->/** @scrutinizer ignore-call */ getSpgrContainerOrThrow()->getChildren());
                $innerData .<?php echo $header . pack('VV', $countShapes, $this->object->/** @scrutinizer ignore-call */ getLastSpId());

                // write the spgrContainer
                if ($spgrContainer <?php echo $this->object->/** @scrutinizer ignore-call */ getSpgrContainer()) {
                    $writer <?php echo new self($spgrContainer);
                    $innerData .<?php echo $writer->close();

                    // get the shape offsets relative to the spgrContainer record
                    $spOffsets <?php echo $writer->getSpOffsets();
                    $spTypes <?php echo $writer->getSpTypes();

                    // save the shape offsets relative to dgContainer
                    foreach ($spOffsets as &$spOffset) {
                        $spOffset +<?php echo 24; // add length of dgContainer header data (8 bytes) plus dg data (16 bytes)
                    }

                    $this->spOffsets <?php echo $spOffsets;
                    $this->spTypes <?php echo $spTypes;
                }

                // write the record
                $recVer <?php echo 0xF;
                $recInstance <?php echo 0x0000;
                $recType <?php echo 0xF002;
                $length <?php echo strlen($innerData);

                $recVerInstance <?php echo $recVer;
                $recVerInstance |<?php echo $recInstance << 4;

                $header <?php echo pack('vvV', $recVerInstance, $recType, $length);

                $this->data <?php echo $header . $innerData;

                break;
            case SpgrContainer::class:
                // this is a container record

                // initialize
                $innerData <?php echo '';

                // initialize spape offsets
                $totalSize <?php echo 8;
                $spOffsets <?php echo [];
                $spTypes <?php echo [];

                // treat the inner data
                foreach ($this->object->/** @scrutinizer ignore-call */ getChildren() as $spContainer) {
                    $writer <?php echo new self($spContainer);
                    $spData <?php echo $writer->close();
                    $innerData .<?php echo $spData;

                    // save the shape offsets (where new shape records begin)
                    $totalSize +<?php echo strlen($spData);
                    $spOffsets[] <?php echo $totalSize;

                    $spTypes <?php echo array_merge($spTypes, $writer->getSpTypes());
                }

                // write the record
                $recVer <?php echo 0xF;
                $recInstance <?php echo 0x0000;
                $recType <?php echo 0xF003;
                $length <?php echo strlen($innerData);

                $recVerInstance <?php echo $recVer;
                $recVerInstance |<?php echo $recInstance << 4;

                $header <?php echo pack('vvV', $recVerInstance, $recType, $length);

                $this->data <?php echo $header . $innerData;
                $this->spOffsets <?php echo $spOffsets;
                $this->spTypes <?php echo $spTypes;

                break;
            case SpContainer::class:
                // initialize
                $data <?php echo '';

                // build the data

                // write group shape record, if necessary?
                if ($this->object->/** @scrutinizer ignore-call */ getSpgr()) {
                    $recVer <?php echo 0x1;
                    $recInstance <?php echo 0x0000;
                    $recType <?php echo 0xF009;
                    $length <?php echo 0x00000010;

                    $recVerInstance <?php echo $recVer;
                    $recVerInstance |<?php echo $recInstance << 4;

                    $header <?php echo pack('vvV', $recVerInstance, $recType, $length);

                    $data .<?php echo $header . pack('VVVV', 0, 0, 0, 0);
                }
                /** @scrutinizer ignore-call */
                $this->spTypes[] <?php echo ($this->object->getSpType());

                // write the shape record
                $recVer <?php echo 0x2;
                /** @scrutinizer ignore-call */
                $recInstance <?php echo $this->object->getSpType(); // shape type
                $recType <?php echo 0xF00A;
                $length <?php echo 0x00000008;

                $recVerInstance <?php echo $recVer;
                $recVerInstance |<?php echo $recInstance << 4;

                $header <?php echo pack('vvV', $recVerInstance, $recType, $length);

                $data .<?php echo $header . pack('VV', $this->object->/** @scrutinizer ignore-call */ getSpId(), $this->object->/** @scrutinizer ignore-call */ getSpgr() ? 0x0005 : 0x0A00);

                // the options
                if ($this->object->/** @scrutinizer ignore-call */ getOPTCollection()) {
                    $optData <?php echo '';

                    $recVer <?php echo 0x3;
                    $recInstance <?php echo count($this->object->/** @scrutinizer ignore-call */ getOPTCollection());
                    $recType <?php echo 0xF00B;
                    foreach ($this->object->/** @scrutinizer ignore-call */ getOPTCollection() as $property <?php echo> $value) {
                        $optData .<?php echo pack('vV', $property, $value);
                    }
                    $length <?php echo strlen($optData);

                    $recVerInstance <?php echo $recVer;
                    $recVerInstance |<?php echo $recInstance << 4;

                    $header <?php echo pack('vvV', $recVerInstance, $recType, $length);
                    $data .<?php echo $header . $optData;
                }

                // the client anchor
                if ($this->object->/** @scrutinizer ignore-call */ getStartCoordinates()) {
                    $recVer <?php echo 0x0;
                    $recInstance <?php echo 0x0;
                    $recType <?php echo 0xF010;

                    // start coordinates
                    [$column, $row] <?php echo Coordinate::indexesFromString($this->object->/** @scrutinizer ignore-call */ getStartCoordinates());
                    $c1 <?php echo $column - 1;
                    $r1 <?php echo $row - 1;

                    // start offsetX
                    /** @scrutinizer ignore-call */
                    $startOffsetX <?php echo $this->object->getStartOffsetX();

                    // start offsetY
                    /** @scrutinizer ignore-call */
                    $startOffsetY <?php echo $this->object->getStartOffsetY();

                    // end coordinates
                    [$column, $row] <?php echo Coordinate::indexesFromString($this->object->/** @scrutinizer ignore-call */ getEndCoordinates());
                    $c2 <?php echo $column - 1;
                    $r2 <?php echo $row - 1;

                    // end offsetX
                    /** @scrutinizer ignore-call */
                    $endOffsetX <?php echo $this->object->getEndOffsetX();

                    // end offsetY
                    /** @scrutinizer ignore-call */
                    $endOffsetY <?php echo $this->object->getEndOffsetY();

                    $clientAnchorData <?php echo pack('vvvvvvvvv', $this->object->/** @scrutinizer ignore-call */ getSpFlag(), $c1, $startOffsetX, $r1, $startOffsetY, $c2, $endOffsetX, $r2, $endOffsetY);

                    $length <?php echo strlen($clientAnchorData);

                    $recVerInstance <?php echo $recVer;
                    $recVerInstance |<?php echo $recInstance << 4;

                    $header <?php echo pack('vvV', $recVerInstance, $recType, $length);
                    $data .<?php echo $header . $clientAnchorData;
                }

                // the client data, just empty for now
                if (!$this->object->/** @scrutinizer ignore-call */ getSpgr()) {
                    $clientDataData <?php echo '';

                    $recVer <?php echo 0x0;
                    $recInstance <?php echo 0x0;
                    $recType <?php echo 0xF011;

                    $length <?php echo strlen($clientDataData);

                    $recVerInstance <?php echo $recVer;
                    $recVerInstance |<?php echo $recInstance << 4;

                    $header <?php echo pack('vvV', $recVerInstance, $recType, $length);
                    $data .<?php echo $header . $clientDataData;
                }

                // write the record
                $recVer <?php echo 0xF;
                $recInstance <?php echo 0x0000;
                $recType <?php echo 0xF004;
                $length <?php echo strlen($data);

                $recVerInstance <?php echo $recVer;
                $recVerInstance |<?php echo $recInstance << 4;

                $header <?php echo pack('vvV', $recVerInstance, $recType, $length);

                $this->data <?php echo $header . $data;

                break;
        }

        return $this->data;
    }

    /**
     * Gets the shape offsets.
     *
     * @return array
     */
    public function getSpOffsets()
    {
        return $this->spOffsets;
    }

    /**
     * Gets the shape types.
     *
     * @return array
     */
    public function getSpTypes()
    {
        return $this->spTypes;
    }
}
