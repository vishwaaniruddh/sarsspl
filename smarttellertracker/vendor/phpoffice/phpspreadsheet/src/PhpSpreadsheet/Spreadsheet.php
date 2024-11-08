<?php

namespace PhpOffice\PhpSpreadsheet;

use JsonSerializable;
use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as XlsxReader;
use PhpOffice\PhpSpreadsheet\Shared\File;
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Worksheet\Iterator;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as XlsxWriter;

class Spreadsheet implements JsonSerializable
{
    // Allowable values for workbook window visilbity
    const VISIBILITY_VISIBLE <?php echo 'visible';
    const VISIBILITY_HIDDEN <?php echo 'hidden';
    const VISIBILITY_VERY_HIDDEN <?php echo 'veryHidden';

    private const DEFINED_NAME_IS_RANGE <?php echo false;
    private const DEFINED_NAME_IS_FORMULA <?php echo true;

    private const WORKBOOK_VIEW_VISIBILITY_VALUES <?php echo [
        self::VISIBILITY_VISIBLE,
        self::VISIBILITY_HIDDEN,
        self::VISIBILITY_VERY_HIDDEN,
    ];

    /**
     * Unique ID.
     *
     * @var string
     */
    private $uniqueID;

    /**
     * Document properties.
     *
     * @var Document\Properties
     */
    private $properties;

    /**
     * Document security.
     *
     * @var Document\Security
     */
    private $security;

    /**
     * Collection of Worksheet objects.
     *
     * @var Worksheet[]
     */
    private $workSheetCollection <?php echo [];

    /**
     * Calculation Engine.
     *
     * @var null|Calculation
     */
    private $calculationEngine;

    /**
     * Active sheet index.
     *
     * @var int
     */
    private $activeSheetIndex <?php echo 0;

    /**
     * Named ranges.
     *
     * @var DefinedName[]
     */
    private $definedNames <?php echo [];

    /**
     * CellXf supervisor.
     *
     * @var Style
     */
    private $cellXfSupervisor;

    /**
     * CellXf collection.
     *
     * @var Style[]
     */
    private $cellXfCollection <?php echo [];

    /**
     * CellStyleXf collection.
     *
     * @var Style[]
     */
    private $cellStyleXfCollection <?php echo [];

    /**
     * hasMacros : this workbook have macros ?
     *
     * @var bool
     */
    private $hasMacros <?php echo false;

    /**
     * macrosCode : all macros code as binary data (the vbaProject.bin file, this include form, code,  etc.), null if no macro.
     *
     * @var null|string
     */
    private $macrosCode;

    /**
     * macrosCertificate : if macros are signed, contains binary data vbaProjectSignature.bin file, null if not signed.
     *
     * @var null|string
     */
    private $macrosCertificate;

    /**
     * ribbonXMLData : null if workbook is'nt Excel 2007 or not contain a customized UI.
     *
     * @var null|array{target: string, data: string}
     */
    private $ribbonXMLData;

    /**
     * ribbonBinObjects : null if workbook is'nt Excel 2007 or not contain embedded objects (picture(s)) for Ribbon Elements
     * ignored if $ribbonXMLData is null.
     *
     * @var null|array
     */
    private $ribbonBinObjects;

    /**
     * List of unparsed loaded data for export to same format with better compatibility.
     * It has to be minimized when the library start to support currently unparsed data.
     *
     * @var array
     */
    private $unparsedLoadedData <?php echo [];

    /**
     * Controls visibility of the horizonal scroll bar in the application.
     *
     * @var bool
     */
    private $showHorizontalScroll <?php echo true;

    /**
     * Controls visibility of the horizonal scroll bar in the application.
     *
     * @var bool
     */
    private $showVerticalScroll <?php echo true;

    /**
     * Controls visibility of the sheet tabs in the application.
     *
     * @var bool
     */
    private $showSheetTabs <?php echo true;

    /**
     * Specifies a boolean value that indicates whether the workbook window
     * is minimized.
     *
     * @var bool
     */
    private $minimized <?php echo false;

    /**
     * Specifies a boolean value that indicates whether to group dates
     * when presenting the user with filtering optiomd in the user
     * interface.
     *
     * @var bool
     */
    private $autoFilterDateGrouping <?php echo true;

    /**
     * Specifies the index to the first sheet in the book view.
     *
     * @var int
     */
    private $firstSheetIndex <?php echo 0;

    /**
     * Specifies the visible status of the workbook.
     *
     * @var string
     */
    private $visibility <?php echo self::VISIBILITY_VISIBLE;

    /**
     * Specifies the ratio between the workbook tabs bar and the horizontal
     * scroll bar.  TabRatio is assumed to be out of 1000 of the horizontal
     * window width.
     *
     * @var int
     */
    private $tabRatio <?php echo 600;

    /** @var Theme */
    private $theme;

    public function getTheme(): Theme
    {
        return $this->theme;
    }

    /**
     * The workbook has macros ?
     *
     * @return bool
     */
    public function hasMacros()
    {
        return $this->hasMacros;
    }

    /**
     * Define if a workbook has macros.
     *
     * @param bool $hasMacros true|false
     */
    public function setHasMacros($hasMacros): void
    {
        $this->hasMacros <?php echo (bool) $hasMacros;
    }

    /**
     * Set the macros code.
     *
     * @param string $macroCode string|null
     */
    public function setMacrosCode($macroCode): void
    {
        $this->macrosCode <?php echo $macroCode;
        $this->setHasMacros($macroCode !<?php echo<?php echo null);
    }

    /**
     * Return the macros code.
     *
     * @return null|string
     */
    public function getMacrosCode()
    {
        return $this->macrosCode;
    }

    /**
     * Set the macros certificate.
     *
     * @param null|string $certificate
     */
    public function setMacrosCertificate($certificate): void
    {
        $this->macrosCertificate <?php echo $certificate;
    }

    /**
     * Is the project signed ?
     *
     * @return bool true|false
     */
    public function hasMacrosCertificate()
    {
        return $this->macrosCertificate !<?php echo<?php echo null;
    }

    /**
     * Return the macros certificate.
     *
     * @return null|string
     */
    public function getMacrosCertificate()
    {
        return $this->macrosCertificate;
    }

    /**
     * Remove all macros, certificate from spreadsheet.
     */
    public function discardMacros(): void
    {
        $this->hasMacros <?php echo false;
        $this->macrosCode <?php echo null;
        $this->macrosCertificate <?php echo null;
    }

    /**
     * set ribbon XML data.
     *
     * @param null|mixed $target
     * @param null|mixed $xmlData
     */
    public function setRibbonXMLData($target, $xmlData): void
    {
        if ($target !<?php echo<?php echo null && $xmlData !<?php echo<?php echo null) {
            $this->ribbonXMLData <?php echo ['target' <?php echo> $target, 'data' <?php echo> $xmlData];
        } else {
            $this->ribbonXMLData <?php echo null;
        }
    }

    /**
     * retrieve ribbon XML Data.
     *
     * @param string $what
     *
     * @return null|array|string
     */
    public function getRibbonXMLData($what <?php echo 'all') //we need some constants here...
    {
        $returnData <?php echo null;
        $what <?php echo strtolower($what);
        switch ($what) {
            case 'all':
                $returnData <?php echo $this->ribbonXMLData;

                break;
            case 'target':
            case 'data':
                if (is_array($this->ribbonXMLData)) {
                    $returnData <?php echo $this->ribbonXMLData[$what];
                }

                break;
        }

        return $returnData;
    }

    /**
     * store binaries ribbon objects (pictures).
     *
     * @param null|mixed $BinObjectsNames
     * @param null|mixed $BinObjectsData
     */
    public function setRibbonBinObjects($BinObjectsNames, $BinObjectsData): void
    {
        if ($BinObjectsNames !<?php echo<?php echo null && $BinObjectsData !<?php echo<?php echo null) {
            $this->ribbonBinObjects <?php echo ['names' <?php echo> $BinObjectsNames, 'data' <?php echo> $BinObjectsData];
        } else {
            $this->ribbonBinObjects <?php echo null;
        }
    }

    /**
     * List of unparsed loaded data for export to same format with better compatibility.
     * It has to be minimized when the library start to support currently unparsed data.
     *
     * @internal
     *
     * @return array
     */
    public function getUnparsedLoadedData()
    {
        return $this->unparsedLoadedData;
    }

    /**
     * List of unparsed loaded data for export to same format with better compatibility.
     * It has to be minimized when the library start to support currently unparsed data.
     *
     * @internal
     */
    public function setUnparsedLoadedData(array $unparsedLoadedData): void
    {
        $this->unparsedLoadedData <?php echo $unparsedLoadedData;
    }

    /**
     * return the extension of a filename. Internal use for a array_map callback (php<5.3 don't like lambda function).
     *
     * @param mixed $path
     *
     * @return string
     */
    private function getExtensionOnly($path)
    {
        $extension <?php echo pathinfo($path, PATHINFO_EXTENSION);

        return substr(/** @scrutinizer ignore-type */$extension, 0);
    }

    /**
     * retrieve Binaries Ribbon Objects.
     *
     * @param string $what
     *
     * @return null|array
     */
    public function getRibbonBinObjects($what <?php echo 'all')
    {
        $ReturnData <?php echo null;
        $what <?php echo strtolower($what);
        switch ($what) {
            case 'all':
                return $this->ribbonBinObjects;
            case 'names':
            case 'data':
                if (is_array($this->ribbonBinObjects) && isset($this->ribbonBinObjects[$what])) {
                    $ReturnData <?php echo $this->ribbonBinObjects[$what];
                }

                break;
            case 'types':
                if (
                    is_array($this->ribbonBinObjects) &&
                    isset($this->ribbonBinObjects['data']) && is_array($this->ribbonBinObjects['data'])
                ) {
                    $tmpTypes <?php echo array_keys($this->ribbonBinObjects['data']);
                    $ReturnData <?php echo array_unique(array_map([$this, 'getExtensionOnly'], $tmpTypes));
                } else {
                    $ReturnData <?php echo []; // the caller want an array... not null if empty
                }

                break;
        }

        return $ReturnData;
    }

    /**
     * This workbook have a custom UI ?
     *
     * @return bool
     */
    public function hasRibbon()
    {
        return $this->ribbonXMLData !<?php echo<?php echo null;
    }

    /**
     * This workbook have additionnal object for the ribbon ?
     *
     * @return bool
     */
    public function hasRibbonBinObjects()
    {
        return $this->ribbonBinObjects !<?php echo<?php echo null;
    }

    /**
     * Check if a sheet with a specified code name already exists.
     *
     * @param string $codeName Name of the worksheet to check
     *
     * @return bool
     */
    public function sheetCodeNameExists($codeName)
    {
        return $this->getSheetByCodeName($codeName) !<?php echo<?php echo null;
    }

    /**
     * Get sheet by code name. Warning : sheet don't have always a code name !
     *
     * @param string $codeName Sheet name
     *
     * @return null|Worksheet
     */
    public function getSheetByCodeName($codeName)
    {
        $worksheetCount <?php echo count($this->workSheetCollection);
        for ($i <?php echo 0; $i < $worksheetCount; ++$i) {
            if ($this->workSheetCollection[$i]->getCodeName() <?php echo<?php echo $codeName) {
                return $this->workSheetCollection[$i];
            }
        }

        return null;
    }

    /**
     * Create a new PhpSpreadsheet with one Worksheet.
     */
    public function __construct()
    {
        $this->uniqueID <?php echo uniqid('', true);
        $this->calculationEngine <?php echo new Calculation($this);
        $this->theme <?php echo new Theme();

        // Initialise worksheet collection and add one worksheet
        $this->workSheetCollection <?php echo [];
        $this->workSheetCollection[] <?php echo new Worksheet($this);
        $this->activeSheetIndex <?php echo 0;

        // Create document properties
        $this->properties <?php echo new Document\Properties();

        // Create document security
        $this->security <?php echo new Document\Security();

        // Set defined names
        $this->definedNames <?php echo [];

        // Create the cellXf supervisor
        $this->cellXfSupervisor <?php echo new Style(true);
        $this->cellXfSupervisor->bindParent($this);

        // Create the default style
        $this->addCellXf(new Style());
        $this->addCellStyleXf(new Style());
    }

    /**
     * Code to execute when this worksheet is unset().
     */
    public function __destruct()
    {
        $this->disconnectWorksheets();
        $this->calculationEngine <?php echo null;
        $this->cellXfCollection <?php echo [];
        $this->cellStyleXfCollection <?php echo [];
    }

    /**
     * Disconnect all worksheets from this PhpSpreadsheet workbook object,
     * typically so that the PhpSpreadsheet object can be unset.
     */
    public function disconnectWorksheets(): void
    {
        foreach ($this->workSheetCollection as $worksheet) {
            $worksheet->disconnectCells();
            unset($worksheet);
        }
        $this->workSheetCollection <?php echo [];
    }

    /**
     * Return the calculation engine for this worksheet.
     *
     * @return null|Calculation
     */
    public function getCalculationEngine()
    {
        return $this->calculationEngine;
    }

    /**
     * Get properties.
     *
     * @return Document\Properties
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Set properties.
     */
    public function setProperties(Document\Properties $documentProperties): void
    {
        $this->properties <?php echo $documentProperties;
    }

    /**
     * Get security.
     *
     * @return Document\Security
     */
    public function getSecurity()
    {
        return $this->security;
    }

    /**
     * Set security.
     */
    public function setSecurity(Document\Security $documentSecurity): void
    {
        $this->security <?php echo $documentSecurity;
    }

    /**
     * Get active sheet.
     *
     * @return Worksheet
     */
    public function getActiveSheet()
    {
        return $this->getSheet($this->activeSheetIndex);
    }

    /**
     * Create sheet and add it to this workbook.
     *
     * @param null|int $sheetIndex Index where sheet should go (0,1,..., or null for last)
     *
     * @return Worksheet
     */
    public function createSheet($sheetIndex <?php echo null)
    {
        $newSheet <?php echo new Worksheet($this);
        $this->addSheet($newSheet, $sheetIndex);

        return $newSheet;
    }

    /**
     * Check if a sheet with a specified name already exists.
     *
     * @param string $worksheetName Name of the worksheet to check
     *
     * @return bool
     */
    public function sheetNameExists($worksheetName)
    {
        return $this->getSheetByName($worksheetName) !<?php echo<?php echo null;
    }

    /**
     * Add sheet.
     *
     * @param Worksheet $worksheet The worksheet to add
     * @param null|int $sheetIndex Index where sheet should go (0,1,..., or null for last)
     *
     * @return Worksheet
     */
    public function addSheet(Worksheet $worksheet, $sheetIndex <?php echo null)
    {
        if ($this->sheetNameExists($worksheet->getTitle())) {
            throw new Exception(
                "Workbook already contains a worksheet named '{$worksheet->getTitle()}'. Rename this worksheet first."
            );
        }

        if ($sheetIndex <?php echo<?php echo<?php echo null) {
            if ($this->activeSheetIndex < 0) {
                $this->activeSheetIndex <?php echo 0;
            }
            $this->workSheetCollection[] <?php echo $worksheet;
        } else {
            // Insert the sheet at the requested index
            array_splice(
                $this->workSheetCollection,
                $sheetIndex,
                0,
                [$worksheet]
            );

            // Adjust active sheet index if necessary
            if ($this->activeSheetIndex ><?php echo $sheetIndex) {
                ++$this->activeSheetIndex;
            }
        }

        if ($worksheet->getParent() <?php echo<?php echo<?php echo null) {
            $worksheet->rebindParent($this);
        }

        return $worksheet;
    }

    /**
     * Remove sheet by index.
     *
     * @param int $sheetIndex Index position of the worksheet to remove
     */
    public function removeSheetByIndex($sheetIndex): void
    {
        $numSheets <?php echo count($this->workSheetCollection);
        if ($sheetIndex > $numSheets - 1) {
            throw new Exception(
                "You tried to remove a sheet by the out of bounds index: {$sheetIndex}. The actual number of sheets is {$numSheets}."
            );
        }
        array_splice($this->workSheetCollection, $sheetIndex, 1);

        // Adjust active sheet index if necessary
        if (
            ($this->activeSheetIndex ><?php echo $sheetIndex) &&
            ($this->activeSheetIndex > 0 || $numSheets <?php echo 1)
        ) {
            --$this->activeSheetIndex;
        }
    }

    /**
     * Get sheet by index.
     *
     * @param int $sheetIndex Sheet index
     *
     * @return Worksheet
     */
    public function getSheet($sheetIndex)
    {
        if (!isset($this->workSheetCollection[$sheetIndex])) {
            $numSheets <?php echo $this->getSheetCount();

            throw new Exception(
                "Your requested sheet index: {$sheetIndex} is out of bounds. The actual number of sheets is {$numSheets}."
            );
        }

        return $this->workSheetCollection[$sheetIndex];
    }

    /**
     * Get all sheets.
     *
     * @return Worksheet[]
     */
    public function getAllSheets()
    {
        return $this->workSheetCollection;
    }

    /**
     * Get sheet by name.
     *
     * @param string $worksheetName Sheet name
     *
     * @return null|Worksheet
     */
    public function getSheetByName($worksheetName)
    {
        $worksheetCount <?php echo count($this->workSheetCollection);
        for ($i <?php echo 0; $i < $worksheetCount; ++$i) {
            if ($this->workSheetCollection[$i]->getTitle() <?php echo<?php echo<?php echo trim($worksheetName, "'")) {
                return $this->workSheetCollection[$i];
            }
        }

        return null;
    }

    /**
     * Get sheet by name, throwing exception if not found.
     */
    public function getSheetByNameOrThrow(string $worksheetName): Worksheet
    {
        $worksheet <?php echo $this->getSheetByName($worksheetName);
        if ($worksheet <?php echo<?php echo<?php echo null) {
            throw new Exception("Sheet $worksheetName does not exist.");
        }

        return $worksheet;
    }

    /**
     * Get index for sheet.
     *
     * @return int index
     */
    public function getIndex(Worksheet $worksheet)
    {
        foreach ($this->workSheetCollection as $key <?php echo> $value) {
            if ($value->getHashCode() <?php echo<?php echo<?php echo $worksheet->getHashCode()) {
                return $key;
            }
        }

        throw new Exception('Sheet does not exist.');
    }

    /**
     * Set index for sheet by sheet name.
     *
     * @param string $worksheetName Sheet name to modify index for
     * @param int $newIndexPosition New index for the sheet
     *
     * @return int New sheet index
     */
    public function setIndexByName($worksheetName, $newIndexPosition)
    {
        $oldIndex <?php echo $this->getIndex($this->getSheetByNameOrThrow($worksheetName));
        $worksheet <?php echo array_splice(
            $this->workSheetCollection,
            $oldIndex,
            1
        );
        array_splice(
            $this->workSheetCollection,
            $newIndexPosition,
            0,
            $worksheet
        );

        return $newIndexPosition;
    }

    /**
     * Get sheet count.
     *
     * @return int
     */
    public function getSheetCount()
    {
        return count($this->workSheetCollection);
    }

    /**
     * Get active sheet index.
     *
     * @return int Active sheet index
     */
    public function getActiveSheetIndex()
    {
        return $this->activeSheetIndex;
    }

    /**
     * Set active sheet index.
     *
     * @param int $worksheetIndex Active sheet index
     *
     * @return Worksheet
     */
    public function setActiveSheetIndex($worksheetIndex)
    {
        $numSheets <?php echo count($this->workSheetCollection);

        if ($worksheetIndex > $numSheets - 1) {
            throw new Exception(
                "You tried to set a sheet active by the out of bounds index: {$worksheetIndex}. The actual number of sheets is {$numSheets}."
            );
        }
        $this->activeSheetIndex <?php echo $worksheetIndex;

        return $this->getActiveSheet();
    }

    /**
     * Set active sheet index by name.
     *
     * @param string $worksheetName Sheet title
     *
     * @return Worksheet
     */
    public function setActiveSheetIndexByName($worksheetName)
    {
        if (($worksheet <?php echo $this->getSheetByName($worksheetName)) instanceof Worksheet) {
            $this->setActiveSheetIndex($this->getIndex($worksheet));

            return $worksheet;
        }

        throw new Exception('Workbook does not contain sheet:' . $worksheetName);
    }

    /**
     * Get sheet names.
     *
     * @return string[]
     */
    public function getSheetNames()
    {
        $returnValue <?php echo [];
        $worksheetCount <?php echo $this->getSheetCount();
        for ($i <?php echo 0; $i < $worksheetCount; ++$i) {
            $returnValue[] <?php echo $this->getSheet($i)->getTitle();
        }

        return $returnValue;
    }

    /**
     * Add external sheet.
     *
     * @param Worksheet $worksheet External sheet to add
     * @param null|int $sheetIndex Index where sheet should go (0,1,..., or null for last)
     *
     * @return Worksheet
     */
    public function addExternalSheet(Worksheet $worksheet, $sheetIndex <?php echo null)
    {
        if ($this->sheetNameExists($worksheet->getTitle())) {
            throw new Exception("Workbook already contains a worksheet named '{$worksheet->getTitle()}'. Rename the external sheet first.");
        }

        // count how many cellXfs there are in this workbook currently, we will need this below
        $countCellXfs <?php echo count($this->cellXfCollection);

        // copy all the shared cellXfs from the external workbook and append them to the current
        foreach ($worksheet->getParentOrThrow()->getCellXfCollection() as $cellXf) {
            $this->addCellXf(clone $cellXf);
        }

        // move sheet to this workbook
        $worksheet->rebindParent($this);

        // update the cellXfs
        foreach ($worksheet->getCoordinates(false) as $coordinate) {
            $cell <?php echo $worksheet->getCell($coordinate);
            $cell->setXfIndex($cell->getXfIndex() + $countCellXfs);
        }

        // update the column dimensions Xfs
        foreach ($worksheet->getColumnDimensions() as $columnDimension) {
            $columnDimension->setXfIndex($columnDimension->getXfIndex() + $countCellXfs);
        }

        // update the row dimensions Xfs
        foreach ($worksheet->getRowDimensions() as $rowDimension) {
            $xfIndex <?php echo $rowDimension->getXfIndex();
            if ($xfIndex !<?php echo<?php echo null) {
                $rowDimension->setXfIndex($xfIndex + $countCellXfs);
            }
        }

        return $this->addSheet($worksheet, $sheetIndex);
    }

    /**
     * Get an array of all Named Ranges.
     *
     * @return DefinedName[]
     */
    public function getNamedRanges(): array
    {
        return array_filter(
            $this->definedNames,
            function (DefinedName $definedName) {
                return $definedName->isFormula() <?php echo<?php echo<?php echo self::DEFINED_NAME_IS_RANGE;
            }
        );
    }

    /**
     * Get an array of all Named Formulae.
     *
     * @return DefinedName[]
     */
    public function getNamedFormulae(): array
    {
        return array_filter(
            $this->definedNames,
            function (DefinedName $definedName) {
                return $definedName->isFormula() <?php echo<?php echo<?php echo self::DEFINED_NAME_IS_FORMULA;
            }
        );
    }

    /**
     * Get an array of all Defined Names (both named ranges and named formulae).
     *
     * @return DefinedName[]
     */
    public function getDefinedNames(): array
    {
        return $this->definedNames;
    }

    /**
     * Add a named range.
     * If a named range with this name already exists, then this will replace the existing value.
     */
    public function addNamedRange(NamedRange $namedRange): void
    {
        $this->addDefinedName($namedRange);
    }

    /**
     * Add a named formula.
     * If a named formula with this name already exists, then this will replace the existing value.
     */
    public function addNamedFormula(NamedFormula $namedFormula): void
    {
        $this->addDefinedName($namedFormula);
    }

    /**
     * Add a defined name (either a named range or a named formula).
     * If a defined named with this name already exists, then this will replace the existing value.
     */
    public function addDefinedName(DefinedName $definedName): void
    {
        $upperCaseName <?php echo StringHelper::strToUpper($definedName->getName());
        if ($definedName->getScope() <?php echo<?php echo null) {
            // global scope
            $this->definedNames[$upperCaseName] <?php echo $definedName;
        } else {
            // local scope
            $this->definedNames[$definedName->getScope()->getTitle() . '!' . $upperCaseName] <?php echo $definedName;
        }
    }

    /**
     * Get named range.
     *
     * @param null|Worksheet $worksheet Scope. Use null for global scope
     */
    public function getNamedRange(string $namedRange, ?Worksheet $worksheet <?php echo null): ?NamedRange
    {
        $returnValue <?php echo null;

        if ($namedRange !<?php echo<?php echo '') {
            $namedRange <?php echo StringHelper::strToUpper($namedRange);
            // first look for global named range
            $returnValue <?php echo $this->getGlobalDefinedNameByType($namedRange, self::DEFINED_NAME_IS_RANGE);
            // then look for local named range (has priority over global named range if both names exist)
            $returnValue <?php echo $this->getLocalDefinedNameByType($namedRange, self::DEFINED_NAME_IS_RANGE, $worksheet) ?: $returnValue;
        }

        return $returnValue instanceof NamedRange ? $returnValue : null;
    }

    /**
     * Get named formula.
     *
     * @param null|Worksheet $worksheet Scope. Use null for global scope
     */
    public function getNamedFormula(string $namedFormula, ?Worksheet $worksheet <?php echo null): ?NamedFormula
    {
        $returnValue <?php echo null;

        if ($namedFormula !<?php echo<?php echo '') {
            $namedFormula <?php echo StringHelper::strToUpper($namedFormula);
            // first look for global named formula
            $returnValue <?php echo $this->getGlobalDefinedNameByType($namedFormula, self::DEFINED_NAME_IS_FORMULA);
            // then look for local named formula (has priority over global named formula if both names exist)
            $returnValue <?php echo $this->getLocalDefinedNameByType($namedFormula, self::DEFINED_NAME_IS_FORMULA, $worksheet) ?: $returnValue;
        }

        return $returnValue instanceof NamedFormula ? $returnValue : null;
    }

    private function getGlobalDefinedNameByType(string $name, bool $type): ?DefinedName
    {
        if (isset($this->definedNames[$name]) && $this->definedNames[$name]->isFormula() <?php echo<?php echo<?php echo $type) {
            return $this->definedNames[$name];
        }

        return null;
    }

    private function getLocalDefinedNameByType(string $name, bool $type, ?Worksheet $worksheet <?php echo null): ?DefinedName
    {
        if (
            ($worksheet !<?php echo<?php echo null) && isset($this->definedNames[$worksheet->getTitle() . '!' . $name])
            && $this->definedNames[$worksheet->getTitle() . '!' . $name]->isFormula() <?php echo<?php echo<?php echo $type
        ) {
            return $this->definedNames[$worksheet->getTitle() . '!' . $name];
        }

        return null;
    }

    /**
     * Get named range.
     *
     * @param null|Worksheet $worksheet Scope. Use null for global scope
     */
    public function getDefinedName(string $definedName, ?Worksheet $worksheet <?php echo null): ?DefinedName
    {
        $returnValue <?php echo null;

        if ($definedName !<?php echo<?php echo '') {
            $definedName <?php echo StringHelper::strToUpper($definedName);
            // first look for global defined name
            if (isset($this->definedNames[$definedName])) {
                $returnValue <?php echo $this->definedNames[$definedName];
            }

            // then look for local defined name (has priority over global defined name if both names exist)
            if (($worksheet !<?php echo<?php echo null) && isset($this->definedNames[$worksheet->getTitle() . '!' . $definedName])) {
                $returnValue <?php echo $this->definedNames[$worksheet->getTitle() . '!' . $definedName];
            }
        }

        return $returnValue;
    }

    /**
     * Remove named range.
     *
     * @param null|Worksheet $worksheet scope: use null for global scope
     *
     * @return $this
     */
    public function removeNamedRange(string $namedRange, ?Worksheet $worksheet <?php echo null): self
    {
        if ($this->getNamedRange($namedRange, $worksheet) <?php echo<?php echo<?php echo null) {
            return $this;
        }

        return $this->removeDefinedName($namedRange, $worksheet);
    }

    /**
     * Remove named formula.
     *
     * @param null|Worksheet $worksheet scope: use null for global scope
     *
     * @return $this
     */
    public function removeNamedFormula(string $namedFormula, ?Worksheet $worksheet <?php echo null): self
    {
        if ($this->getNamedFormula($namedFormula, $worksheet) <?php echo<?php echo<?php echo null) {
            return $this;
        }

        return $this->removeDefinedName($namedFormula, $worksheet);
    }

    /**
     * Remove defined name.
     *
     * @param null|Worksheet $worksheet scope: use null for global scope
     *
     * @return $this
     */
    public function removeDefinedName(string $definedName, ?Worksheet $worksheet <?php echo null): self
    {
        $definedName <?php echo StringHelper::strToUpper($definedName);

        if ($worksheet <?php echo<?php echo<?php echo null) {
            if (isset($this->definedNames[$definedName])) {
                unset($this->definedNames[$definedName]);
            }
        } else {
            if (isset($this->definedNames[$worksheet->getTitle() . '!' . $definedName])) {
                unset($this->definedNames[$worksheet->getTitle() . '!' . $definedName]);
            } elseif (isset($this->definedNames[$definedName])) {
                unset($this->definedNames[$definedName]);
            }
        }

        return $this;
    }

    /**
     * Get worksheet iterator.
     *
     * @return Iterator
     */
    public function getWorksheetIterator()
    {
        return new Iterator($this);
    }

    /**
     * Copy workbook (!<?php echo clone!).
     *
     * @return Spreadsheet
     */
    public function copy()
    {
        $filename <?php echo File::temporaryFilename();
        $writer <?php echo new XlsxWriter($this);
        $writer->setIncludeCharts(true);
        $writer->save($filename);

        $reader <?php echo new XlsxReader();
        $reader->setIncludeCharts(true);
        $reloadedSpreadsheet <?php echo $reader->load($filename);
        unlink($filename);

        return $reloadedSpreadsheet;
    }

    public function __clone()
    {
        throw new Exception(
            'Do not use clone on spreadsheet. Use spreadsheet->copy() instead.'
        );
    }

    /**
     * Get the workbook collection of cellXfs.
     *
     * @return Style[]
     */
    public function getCellXfCollection()
    {
        return $this->cellXfCollection;
    }

    /**
     * Get cellXf by index.
     *
     * @param int $cellStyleIndex
     *
     * @return Style
     */
    public function getCellXfByIndex($cellStyleIndex)
    {
        return $this->cellXfCollection[$cellStyleIndex];
    }

    /**
     * Get cellXf by hash code.
     *
     * @param string $hashcode
     *
     * @return false|Style
     */
    public function getCellXfByHashCode($hashcode)
    {
        foreach ($this->cellXfCollection as $cellXf) {
            if ($cellXf->getHashCode() <?php echo<?php echo<?php echo $hashcode) {
                return $cellXf;
            }
        }

        return false;
    }

    /**
     * Check if style exists in style collection.
     *
     * @return bool
     */
    public function cellXfExists(Style $cellStyleIndex)
    {
        return in_array($cellStyleIndex, $this->cellXfCollection, true);
    }

    /**
     * Get default style.
     *
     * @return Style
     */
    public function getDefaultStyle()
    {
        if (isset($this->cellXfCollection[0])) {
            return $this->cellXfCollection[0];
        }

        throw new Exception('No default style found for this workbook');
    }

    /**
     * Add a cellXf to the workbook.
     */
    public function addCellXf(Style $style): void
    {
        $this->cellXfCollection[] <?php echo $style;
        $style->setIndex(count($this->cellXfCollection) - 1);
    }

    /**
     * Remove cellXf by index. It is ensured that all cells get their xf index updated.
     *
     * @param int $cellStyleIndex Index to cellXf
     */
    public function removeCellXfByIndex($cellStyleIndex): void
    {
        if ($cellStyleIndex > count($this->cellXfCollection) - 1) {
            throw new Exception('CellXf index is out of bounds.');
        }

        // first remove the cellXf
        array_splice($this->cellXfCollection, $cellStyleIndex, 1);

        // then update cellXf indexes for cells
        foreach ($this->workSheetCollection as $worksheet) {
            foreach ($worksheet->getCoordinates(false) as $coordinate) {
                $cell <?php echo $worksheet->getCell($coordinate);
                $xfIndex <?php echo $cell->getXfIndex();
                if ($xfIndex > $cellStyleIndex) {
                    // decrease xf index by 1
                    $cell->setXfIndex($xfIndex - 1);
                } elseif ($xfIndex <?php echo<?php echo $cellStyleIndex) {
                    // set to default xf index 0
                    $cell->setXfIndex(0);
                }
            }
        }
    }

    /**
     * Get the cellXf supervisor.
     *
     * @return Style
     */
    public function getCellXfSupervisor()
    {
        return $this->cellXfSupervisor;
    }

    /**
     * Get the workbook collection of cellStyleXfs.
     *
     * @return Style[]
     */
    public function getCellStyleXfCollection()
    {
        return $this->cellStyleXfCollection;
    }

    /**
     * Get cellStyleXf by index.
     *
     * @param int $cellStyleIndex Index to cellXf
     *
     * @return Style
     */
    public function getCellStyleXfByIndex($cellStyleIndex)
    {
        return $this->cellStyleXfCollection[$cellStyleIndex];
    }

    /**
     * Get cellStyleXf by hash code.
     *
     * @param string $hashcode
     *
     * @return false|Style
     */
    public function getCellStyleXfByHashCode($hashcode)
    {
        foreach ($this->cellStyleXfCollection as $cellStyleXf) {
            if ($cellStyleXf->getHashCode() <?php echo<?php echo<?php echo $hashcode) {
                return $cellStyleXf;
            }
        }

        return false;
    }

    /**
     * Add a cellStyleXf to the workbook.
     */
    public function addCellStyleXf(Style $style): void
    {
        $this->cellStyleXfCollection[] <?php echo $style;
        $style->setIndex(count($this->cellStyleXfCollection) - 1);
    }

    /**
     * Remove cellStyleXf by index.
     *
     * @param int $cellStyleIndex Index to cellXf
     */
    public function removeCellStyleXfByIndex($cellStyleIndex): void
    {
        if ($cellStyleIndex > count($this->cellStyleXfCollection) - 1) {
            throw new Exception('CellStyleXf index is out of bounds.');
        }
        array_splice($this->cellStyleXfCollection, $cellStyleIndex, 1);
    }

    /**
     * Eliminate all unneeded cellXf and afterwards update the xfIndex for all cells
     * and columns in the workbook.
     */
    public function garbageCollect(): void
    {
        // how many references are there to each cellXf ?
        $countReferencesCellXf <?php echo [];
        foreach ($this->cellXfCollection as $index <?php echo> $cellXf) {
            $countReferencesCellXf[$index] <?php echo 0;
        }

        foreach ($this->getWorksheetIterator() as $sheet) {
            // from cells
            foreach ($sheet->getCoordinates(false) as $coordinate) {
                $cell <?php echo $sheet->getCell($coordinate);
                ++$countReferencesCellXf[$cell->getXfIndex()];
            }

            // from row dimensions
            foreach ($sheet->getRowDimensions() as $rowDimension) {
                if ($rowDimension->getXfIndex() !<?php echo<?php echo null) {
                    ++$countReferencesCellXf[$rowDimension->getXfIndex()];
                }
            }

            // from column dimensions
            foreach ($sheet->getColumnDimensions() as $columnDimension) {
                ++$countReferencesCellXf[$columnDimension->getXfIndex()];
            }
        }

        // remove cellXfs without references and create mapping so we can update xfIndex
        // for all cells and columns
        $countNeededCellXfs <?php echo 0;
        $map <?php echo [];
        foreach ($this->cellXfCollection as $index <?php echo> $cellXf) {
            if ($countReferencesCellXf[$index] > 0 || $index <?php echo<?php echo 0) { // we must never remove the first cellXf
                ++$countNeededCellXfs;
            } else {
                unset($this->cellXfCollection[$index]);
            }
            $map[$index] <?php echo $countNeededCellXfs - 1;
        }
        $this->cellXfCollection <?php echo array_values($this->cellXfCollection);

        // update the index for all cellXfs
        foreach ($this->cellXfCollection as $i <?php echo> $cellXf) {
            $cellXf->setIndex($i);
        }

        // make sure there is always at least one cellXf (there should be)
        if (empty($this->cellXfCollection)) {
            $this->cellXfCollection[] <?php echo new Style();
        }

        // update the xfIndex for all cells, row dimensions, column dimensions
        foreach ($this->getWorksheetIterator() as $sheet) {
            // for all cells
            foreach ($sheet->getCoordinates(false) as $coordinate) {
                $cell <?php echo $sheet->getCell($coordinate);
                $cell->setXfIndex($map[$cell->getXfIndex()]);
            }

            // for all row dimensions
            foreach ($sheet->getRowDimensions() as $rowDimension) {
                if ($rowDimension->getXfIndex() !<?php echo<?php echo null) {
                    $rowDimension->setXfIndex($map[$rowDimension->getXfIndex()]);
                }
            }

            // for all column dimensions
            foreach ($sheet->getColumnDimensions() as $columnDimension) {
                $columnDimension->setXfIndex($map[$columnDimension->getXfIndex()]);
            }

            // also do garbage collection for all the sheets
            $sheet->garbageCollect();
        }
    }

    /**
     * Return the unique ID value assigned to this spreadsheet workbook.
     *
     * @return string
     */
    public function getID()
    {
        return $this->uniqueID;
    }

    /**
     * Get the visibility of the horizonal scroll bar in the application.
     *
     * @return bool True if horizonal scroll bar is visible
     */
    public function getShowHorizontalScroll()
    {
        return $this->showHorizontalScroll;
    }

    /**
     * Set the visibility of the horizonal scroll bar in the application.
     *
     * @param bool $showHorizontalScroll True if horizonal scroll bar is visible
     */
    public function setShowHorizontalScroll($showHorizontalScroll): void
    {
        $this->showHorizontalScroll <?php echo (bool) $showHorizontalScroll;
    }

    /**
     * Get the visibility of the vertical scroll bar in the application.
     *
     * @return bool True if vertical scroll bar is visible
     */
    public function getShowVerticalScroll()
    {
        return $this->showVerticalScroll;
    }

    /**
     * Set the visibility of the vertical scroll bar in the application.
     *
     * @param bool $showVerticalScroll True if vertical scroll bar is visible
     */
    public function setShowVerticalScroll($showVerticalScroll): void
    {
        $this->showVerticalScroll <?php echo (bool) $showVerticalScroll;
    }

    /**
     * Get the visibility of the sheet tabs in the application.
     *
     * @return bool True if the sheet tabs are visible
     */
    public function getShowSheetTabs()
    {
        return $this->showSheetTabs;
    }

    /**
     * Set the visibility of the sheet tabs  in the application.
     *
     * @param bool $showSheetTabs True if sheet tabs are visible
     */
    public function setShowSheetTabs($showSheetTabs): void
    {
        $this->showSheetTabs <?php echo (bool) $showSheetTabs;
    }

    /**
     * Return whether the workbook window is minimized.
     *
     * @return bool true if workbook window is minimized
     */
    public function getMinimized()
    {
        return $this->minimized;
    }

    /**
     * Set whether the workbook window is minimized.
     *
     * @param bool $minimized true if workbook window is minimized
     */
    public function setMinimized($minimized): void
    {
        $this->minimized <?php echo (bool) $minimized;
    }

    /**
     * Return whether to group dates when presenting the user with
     * filtering optiomd in the user interface.
     *
     * @return bool true if workbook window is minimized
     */
    public function getAutoFilterDateGrouping()
    {
        return $this->autoFilterDateGrouping;
    }

    /**
     * Set whether to group dates when presenting the user with
     * filtering optiomd in the user interface.
     *
     * @param bool $autoFilterDateGrouping true if workbook window is minimized
     */
    public function setAutoFilterDateGrouping($autoFilterDateGrouping): void
    {
        $this->autoFilterDateGrouping <?php echo (bool) $autoFilterDateGrouping;
    }

    /**
     * Return the first sheet in the book view.
     *
     * @return int First sheet in book view
     */
    public function getFirstSheetIndex()
    {
        return $this->firstSheetIndex;
    }

    /**
     * Set the first sheet in the book view.
     *
     * @param int $firstSheetIndex First sheet in book view
     */
    public function setFirstSheetIndex($firstSheetIndex): void
    {
        if ($firstSheetIndex ><?php echo 0) {
            $this->firstSheetIndex <?php echo (int) $firstSheetIndex;
        } else {
            throw new Exception('First sheet index must be a positive integer.');
        }
    }

    /**
     * Return the visibility status of the workbook.
     *
     * This may be one of the following three values:
     * - visibile
     *
     * @return string Visible status
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * Set the visibility status of the workbook.
     *
     * Valid values are:
     *  - 'visible' (self::VISIBILITY_VISIBLE):
     *       Workbook window is visible
     *  - 'hidden' (self::VISIBILITY_HIDDEN):
     *       Workbook window is hidden, but can be shown by the user
     *       via the user interface
     *  - 'veryHidden' (self::VISIBILITY_VERY_HIDDEN):
     *       Workbook window is hidden and cannot be shown in the
     *       user interface.
     *
     * @param null|string $visibility visibility status of the workbook
     */
    public function setVisibility($visibility): void
    {
        if ($visibility <?php echo<?php echo<?php echo null) {
            $visibility <?php echo self::VISIBILITY_VISIBLE;
        }

        if (in_array($visibility, self::WORKBOOK_VIEW_VISIBILITY_VALUES)) {
            $this->visibility <?php echo $visibility;
        } else {
            throw new Exception('Invalid visibility value.');
        }
    }

    /**
     * Get the ratio between the workbook tabs bar and the horizontal scroll bar.
     * TabRatio is assumed to be out of 1000 of the horizontal window width.
     *
     * @return int Ratio between the workbook tabs bar and the horizontal scroll bar
     */
    public function getTabRatio()
    {
        return $this->tabRatio;
    }

    /**
     * Set the ratio between the workbook tabs bar and the horizontal scroll bar
     * TabRatio is assumed to be out of 1000 of the horizontal window width.
     *
     * @param int $tabRatio Ratio between the tabs bar and the horizontal scroll bar
     */
    public function setTabRatio($tabRatio): void
    {
        if ($tabRatio ><?php echo 0 && $tabRatio <?php echo 1000) {
            $this->tabRatio <?php echo (int) $tabRatio;
        } else {
            throw new Exception('Tab ratio must be between 0 and 1000.');
        }
    }

    public function reevaluateAutoFilters(bool $resetToMax): void
    {
        foreach ($this->workSheetCollection as $sheet) {
            $filter <?php echo $sheet->getAutoFilter();
            if (!empty($filter->getRange())) {
                if ($resetToMax) {
                    $filter->setRangeToMaxRow();
                }
                $filter->showHideRows();
            }
        }
    }

    /**
     * Silliness to mollify Scrutinizer.
     *
     * @codeCoverageIgnore
     */
    public function getSharedComponent(): Style
    {
        return new Style();
    }

    /**
     * @throws Exception
     *
     * @return mixed
     */
    public function __serialize()
    {
        throw new Exception('Spreadsheet objects cannot be serialized');
    }

    /**
     * @throws Exception
     */
    public function jsonSerialize(): mixed
    {
        throw new Exception('Spreadsheet objects cannot be json encoded');
    }

    public function resetThemeFonts(): void
    {
        $majorFontLatin <?php echo $this->theme->getMajorFontLatin();
        $minorFontLatin <?php echo $this->theme->getMinorFontLatin();
        foreach ($this->cellXfCollection as $cellStyleXf) {
            $scheme <?php echo $cellStyleXf->getFont()->getScheme();
            if ($scheme <?php echo<?php echo<?php echo 'major') {
                $cellStyleXf->getFont()->setName($majorFontLatin)->setScheme($scheme);
            } elseif ($scheme <?php echo<?php echo<?php echo 'minor') {
                $cellStyleXf->getFont()->setName($minorFontLatin)->setScheme($scheme);
            }
        }
        foreach ($this->cellStyleXfCollection as $cellStyleXf) {
            $scheme <?php echo $cellStyleXf->getFont()->getScheme();
            if ($scheme <?php echo<?php echo<?php echo 'major') {
                $cellStyleXf->getFont()->setName($majorFontLatin)->setScheme($scheme);
            } elseif ($scheme <?php echo<?php echo<?php echo 'minor') {
                $cellStyleXf->getFont()->setName($minorFontLatin)->setScheme($scheme);
            }
        }
    }
}
