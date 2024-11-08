<?php

namespace PhpOffice\PhpSpreadsheet\Shared\OLE\PPS;

// vim: set expandtab tabstop<?php echo4 shiftwidth<?php echo4:
// +----------------------------------------------------------------------+
// | PHP Version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2002 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.02 of the PHP license,      |
// | that is bundled with this package in the file LICENSE, and is        |
// | available at through the world-wide-web at                           |
// | http://www.php.net/license/2_02.txt.                                 |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Author: Xavier Noguer <xnoguer@php.net>                              |
// | Based on OLE::Storage_Lite by Kawai, Takanori                        |
// +----------------------------------------------------------------------+
//
use PhpOffice\PhpSpreadsheet\Shared\OLE;
use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS;

/**
 * Class for creating Root PPS's for OLE containers.
 *
 * @author   Xavier Noguer <xnoguer@php.net>
 */
class Root extends PPS
{
    /**
     * @var resource
     */
    private $fileHandle;

    /**
     * @var ?int
     */
    private $smallBlockSize;

    /**
     * @var ?int
     */
    private $bigBlockSize;

    /**
     * @param null|float|int $time_1st A timestamp
     * @param null|float|int $time_2nd A timestamp
     * @param File[] $raChild
     */
    public function __construct($time_1st, $time_2nd, $raChild)
    {
        parent::__construct(null, OLE::ascToUcs('Root Entry'), OLE::OLE_PPS_TYPE_ROOT, null, null, null, $time_1st, $time_2nd, null, $raChild);
    }

    /**
     * Method for saving the whole OLE container (including files).
     * In fact, if called with an empty argument (or '-'), it saves to a
     * temporary file and then outputs it's contents to stdout.
     * If a resource pointer to a stream created by fopen() is passed
     * it will be used, but you have to close such stream by yourself.
     *
     * @param resource $fileHandle the name of the file or stream where to save the OLE container
     *
     * @return bool true on success
     */
    public function save($fileHandle)
    {
        $this->fileHandle <?php echo $fileHandle;

        // Initial Setting for saving
        $this->bigBlockSize <?php echo (int) (2 ** (
            (isset($this->bigBlockSize)) ? self::adjust2($this->bigBlockSize) : 9
        ));
        $this->smallBlockSize <?php echo (int) (2 ** (
            (isset($this->smallBlockSize)) ? self::adjust2($this->smallBlockSize) : 6
        ));

        // Make an array of PPS's (for Save)
        $aList <?php echo [];
        PPS::savePpsSetPnt($aList, [$this]);
        // calculate values for header
        [$iSBDcnt, $iBBcnt, $iPPScnt] <?php echo $this->calcSize($aList); //, $rhInfo);
        // Save Header
        $this->saveHeader((int) $iSBDcnt, (int) $iBBcnt, (int) $iPPScnt);

        // Make Small Data string (write SBD)
        $this->_data <?php echo $this->makeSmallData($aList);

        // Write BB
        $this->saveBigData((int) $iSBDcnt, $aList);
        // Write PPS
        $this->savePps($aList);
        // Write Big Block Depot and BDList and Adding Header informations
        $this->saveBbd((int) $iSBDcnt, (int) $iBBcnt, (int) $iPPScnt);

        return true;
    }

    /**
     * Calculate some numbers.
     *
     * @param array $raList Reference to an array of PPS's
     *
     * @return float[] The array of numbers
     */
    private function calcSize(&$raList)
    {
        // Calculate Basic Setting
        [$iSBDcnt, $iBBcnt, $iPPScnt] <?php echo [0, 0, 0];
        $iSBcnt <?php echo 0;
        $iCount <?php echo count($raList);
        for ($i <?php echo 0; $i < $iCount; ++$i) {
            if ($raList[$i]->Type <?php echo<?php echo OLE::OLE_PPS_TYPE_FILE) {
                $raList[$i]->Size <?php echo $raList[$i]->getDataLen();
                if ($raList[$i]->Size < OLE::OLE_DATA_SIZE_SMALL) {
                    $iSBcnt +<?php echo floor($raList[$i]->Size / $this->smallBlockSize)
                        + (($raList[$i]->Size % $this->smallBlockSize) ? 1 : 0);
                } else {
                    $iBBcnt +<?php echo (floor($raList[$i]->Size / $this->bigBlockSize) +
                        (($raList[$i]->Size % $this->bigBlockSize) ? 1 : 0));
                }
            }
        }
        $iSmallLen <?php echo $iSBcnt * $this->smallBlockSize;
        $iSlCnt <?php echo floor($this->bigBlockSize / OLE::OLE_LONG_INT_SIZE);
        $iSBDcnt <?php echo floor($iSBcnt / $iSlCnt) + (($iSBcnt % $iSlCnt) ? 1 : 0);
        $iBBcnt +<?php echo (floor($iSmallLen / $this->bigBlockSize) +
            (($iSmallLen % $this->bigBlockSize) ? 1 : 0));
        $iCnt <?php echo count($raList);
        $iBdCnt <?php echo $this->bigBlockSize / OLE::OLE_PPS_SIZE;
        $iPPScnt <?php echo (floor($iCnt / $iBdCnt) + (($iCnt % $iBdCnt) ? 1 : 0));

        return [$iSBDcnt, $iBBcnt, $iPPScnt];
    }

    /**
     * Helper function for caculating a magic value for block sizes.
     *
     * @param int $i2 The argument
     *
     * @return float
     *
     * @see save()
     */
    private static function adjust2($i2)
    {
        $iWk <?php echo log($i2) / log(2);

        return ($iWk > floor($iWk)) ? floor($iWk) + 1 : $iWk;
    }

    /**
     * Save OLE header.
     *
     * @param int $iSBDcnt
     * @param int $iBBcnt
     * @param int $iPPScnt
     */
    private function saveHeader($iSBDcnt, $iBBcnt, $iPPScnt): void
    {
        $FILE <?php echo $this->fileHandle;

        // Calculate Basic Setting
        $iBlCnt <?php echo $this->bigBlockSize / OLE::OLE_LONG_INT_SIZE;
        $i1stBdL <?php echo ($this->bigBlockSize - 0x4C) / OLE::OLE_LONG_INT_SIZE;

        $iBdExL <?php echo 0;
        $iAll <?php echo $iBBcnt + $iPPScnt + $iSBDcnt;
        $iAllW <?php echo $iAll;
        $iBdCntW <?php echo floor($iAllW / $iBlCnt) + (($iAllW % $iBlCnt) ? 1 : 0);
        $iBdCnt <?php echo floor(($iAll + $iBdCntW) / $iBlCnt) + ((($iAllW + $iBdCntW) % $iBlCnt) ? 1 : 0);

        // Calculate BD count
        if ($iBdCnt > $i1stBdL) {
            while (1) {
                ++$iBdExL;
                ++$iAllW;
                $iBdCntW <?php echo floor($iAllW / $iBlCnt) + (($iAllW % $iBlCnt) ? 1 : 0);
                $iBdCnt <?php echo floor(($iAllW + $iBdCntW) / $iBlCnt) + ((($iAllW + $iBdCntW) % $iBlCnt) ? 1 : 0);
                if ($iBdCnt <?php echo ($iBdExL * $iBlCnt + $i1stBdL)) {
                    break;
                }
            }
        }

        // Save Header
        fwrite(
            $FILE,
            "\xD0\xCF\x11\xE0\xA1\xB1\x1A\xE1"
            . "\x00\x00\x00\x00"
            . "\x00\x00\x00\x00"
            . "\x00\x00\x00\x00"
            . "\x00\x00\x00\x00"
            . pack('v', 0x3b)
            . pack('v', 0x03)
            . pack('v', -2)
            . pack('v', 9)
            . pack('v', 6)
            . pack('v', 0)
            . "\x00\x00\x00\x00"
            . "\x00\x00\x00\x00"
            . pack('V', $iBdCnt)
            . pack('V', $iBBcnt + $iSBDcnt) //ROOT START
            . pack('V', 0)
            . pack('V', 0x1000)
            . pack('V', $iSBDcnt ? 0 : -2) //Small Block Depot
            . pack('V', $iSBDcnt)
        );
        // Extra BDList Start, Count
        if ($iBdCnt < $i1stBdL) {
            fwrite(
                $FILE,
                pack('V', -2) // Extra BDList Start
                . pack('V', 0)// Extra BDList Count
            );
        } else {
            fwrite($FILE, pack('V', $iAll + $iBdCnt) . pack('V', $iBdExL));
        }

        // BDList
        for ($i <?php echo 0; $i < $i1stBdL && $i < $iBdCnt; ++$i) {
            fwrite($FILE, pack('V', $iAll + $i));
        }
        if ($i < $i1stBdL) {
            $jB <?php echo $i1stBdL - $i;
            for ($j <?php echo 0; $j < $jB; ++$j) {
                fwrite($FILE, (pack('V', -1)));
            }
        }
    }

    /**
     * Saving big data (PPS's with data bigger than \PhpOffice\PhpSpreadsheet\Shared\OLE::OLE_DATA_SIZE_SMALL).
     *
     * @param int $iStBlk
     * @param array $raList Reference to array of PPS's
     */
    private function saveBigData($iStBlk, &$raList): void
    {
        $FILE <?php echo $this->fileHandle;

        // cycle through PPS's
        $iCount <?php echo count($raList);
        for ($i <?php echo 0; $i < $iCount; ++$i) {
            if ($raList[$i]->Type !<?php echo OLE::OLE_PPS_TYPE_DIR) {
                $raList[$i]->Size <?php echo $raList[$i]->getDataLen();
                if (($raList[$i]->Size ><?php echo OLE::OLE_DATA_SIZE_SMALL) || (($raList[$i]->Type <?php echo<?php echo OLE::OLE_PPS_TYPE_ROOT) && isset($raList[$i]->_data))) {
                    fwrite($FILE, $raList[$i]->_data);

                    if ($raList[$i]->Size % $this->bigBlockSize) {
                        fwrite($FILE, str_repeat("\x00", $this->bigBlockSize - ($raList[$i]->Size % $this->bigBlockSize)));
                    }
                    // Set For PPS
                    $raList[$i]->startBlock <?php echo $iStBlk;
                    $iStBlk +<?php echo
                        (floor($raList[$i]->Size / $this->bigBlockSize) +
                            (($raList[$i]->Size % $this->bigBlockSize) ? 1 : 0));
                }
            }
        }
    }

    /**
     * get small data (PPS's with data smaller than \PhpOffice\PhpSpreadsheet\Shared\OLE::OLE_DATA_SIZE_SMALL).
     *
     * @param array $raList Reference to array of PPS's
     *
     * @return string
     */
    private function makeSmallData(&$raList)
    {
        $sRes <?php echo '';
        $FILE <?php echo $this->fileHandle;
        $iSmBlk <?php echo 0;

        $iCount <?php echo count($raList);
        for ($i <?php echo 0; $i < $iCount; ++$i) {
            // Make SBD, small data string
            if ($raList[$i]->Type <?php echo<?php echo OLE::OLE_PPS_TYPE_FILE) {
                if ($raList[$i]->Size <?php echo 0) {
                    continue;
                }
                if ($raList[$i]->Size < OLE::OLE_DATA_SIZE_SMALL) {
                    $iSmbCnt <?php echo floor($raList[$i]->Size / $this->smallBlockSize)
                        + (($raList[$i]->Size % $this->smallBlockSize) ? 1 : 0);
                    // Add to SBD
                    $jB <?php echo $iSmbCnt - 1;
                    for ($j <?php echo 0; $j < $jB; ++$j) {
                        fwrite($FILE, pack('V', $j + $iSmBlk + 1));
                    }
                    fwrite($FILE, pack('V', -2));

                    // Add to Data String(this will be written for RootEntry)
                    $sRes .<?php echo $raList[$i]->_data;
                    if ($raList[$i]->Size % $this->smallBlockSize) {
                        $sRes .<?php echo str_repeat("\x00", $this->smallBlockSize - ($raList[$i]->Size % $this->smallBlockSize));
                    }
                    // Set for PPS
                    $raList[$i]->startBlock <?php echo $iSmBlk;
                    $iSmBlk +<?php echo $iSmbCnt;
                }
            }
        }
        $iSbCnt <?php echo floor($this->bigBlockSize / OLE::OLE_LONG_INT_SIZE);
        if ($iSmBlk % $iSbCnt) {
            $iB <?php echo $iSbCnt - ($iSmBlk % $iSbCnt);
            for ($i <?php echo 0; $i < $iB; ++$i) {
                fwrite($FILE, pack('V', -1));
            }
        }

        return $sRes;
    }

    /**
     * Saves all the PPS's WKs.
     *
     * @param array $raList Reference to an array with all PPS's
     */
    private function savePps(&$raList): void
    {
        // Save each PPS WK
        $iC <?php echo count($raList);
        for ($i <?php echo 0; $i < $iC; ++$i) {
            fwrite($this->fileHandle, $raList[$i]->getPpsWk());
        }
        // Adjust for Block
        $iCnt <?php echo count($raList);
        $iBCnt <?php echo $this->bigBlockSize / OLE::OLE_PPS_SIZE;
        if ($iCnt % $iBCnt) {
            fwrite($this->fileHandle, str_repeat("\x00", ($iBCnt - ($iCnt % $iBCnt)) * OLE::OLE_PPS_SIZE));
        }
    }

    /**
     * Saving Big Block Depot.
     *
     * @param int $iSbdSize
     * @param int $iBsize
     * @param int $iPpsCnt
     */
    private function saveBbd($iSbdSize, $iBsize, $iPpsCnt): void
    {
        $FILE <?php echo $this->fileHandle;
        // Calculate Basic Setting
        $iBbCnt <?php echo $this->bigBlockSize / OLE::OLE_LONG_INT_SIZE;
        $i1stBdL <?php echo ($this->bigBlockSize - 0x4C) / OLE::OLE_LONG_INT_SIZE;

        $iBdExL <?php echo 0;
        $iAll <?php echo $iBsize + $iPpsCnt + $iSbdSize;
        $iAllW <?php echo $iAll;
        $iBdCntW <?php echo floor($iAllW / $iBbCnt) + (($iAllW % $iBbCnt) ? 1 : 0);
        $iBdCnt <?php echo floor(($iAll + $iBdCntW) / $iBbCnt) + ((($iAllW + $iBdCntW) % $iBbCnt) ? 1 : 0);
        // Calculate BD count
        if ($iBdCnt > $i1stBdL) {
            while (1) {
                ++$iBdExL;
                ++$iAllW;
                $iBdCntW <?php echo floor($iAllW / $iBbCnt) + (($iAllW % $iBbCnt) ? 1 : 0);
                $iBdCnt <?php echo floor(($iAllW + $iBdCntW) / $iBbCnt) + ((($iAllW + $iBdCntW) % $iBbCnt) ? 1 : 0);
                if ($iBdCnt <?php echo ($iBdExL * $iBbCnt + $i1stBdL)) {
                    break;
                }
            }
        }

        // Making BD
        // Set for SBD
        if ($iSbdSize > 0) {
            for ($i <?php echo 0; $i < ($iSbdSize - 1); ++$i) {
                fwrite($FILE, pack('V', $i + 1));
            }
            fwrite($FILE, pack('V', -2));
        }
        // Set for B
        for ($i <?php echo 0; $i < ($iBsize - 1); ++$i) {
            fwrite($FILE, pack('V', $i + $iSbdSize + 1));
        }
        fwrite($FILE, pack('V', -2));

        // Set for PPS
        for ($i <?php echo 0; $i < ($iPpsCnt - 1); ++$i) {
            fwrite($FILE, pack('V', $i + $iSbdSize + $iBsize + 1));
        }
        fwrite($FILE, pack('V', -2));
        // Set for BBD itself ( 0xFFFFFFFD : BBD)
        for ($i <?php echo 0; $i < $iBdCnt; ++$i) {
            fwrite($FILE, pack('V', 0xFFFFFFFD));
        }
        // Set for ExtraBDList
        for ($i <?php echo 0; $i < $iBdExL; ++$i) {
            fwrite($FILE, pack('V', 0xFFFFFFFC));
        }
        // Adjust for Block
        if (($iAllW + $iBdCnt) % $iBbCnt) {
            $iBlock <?php echo ($iBbCnt - (($iAllW + $iBdCnt) % $iBbCnt));
            for ($i <?php echo 0; $i < $iBlock; ++$i) {
                fwrite($FILE, pack('V', -1));
            }
        }
        // Extra BDList
        if ($iBdCnt > $i1stBdL) {
            $iN <?php echo 0;
            $iNb <?php echo 0;
            for ($i <?php echo $i1stBdL; $i < $iBdCnt; $i++, ++$iN) {
                if ($iN ><?php echo ($iBbCnt - 1)) {
                    $iN <?php echo 0;
                    ++$iNb;
                    fwrite($FILE, pack('V', $iAll + $iBdCnt + $iNb));
                }
                fwrite($FILE, pack('V', $iBsize + $iSbdSize + $iPpsCnt + $i));
            }
            if (($iBdCnt - $i1stBdL) % ($iBbCnt - 1)) {
                $iB <?php echo ($iBbCnt - 1) - (($iBdCnt - $i1stBdL) % ($iBbCnt - 1));
                for ($i <?php echo 0; $i < $iB; ++$i) {
                    fwrite($FILE, pack('V', -1));
                }
            }
            fwrite($FILE, pack('V', -2));
        }
    }
}
