<?php

namespace PhpOffice\PhpSpreadsheet;

use PhpOffice\PhpSpreadsheet\Reader\IReader;
use PhpOffice\PhpSpreadsheet\Shared\File;
use PhpOffice\PhpSpreadsheet\Writer\IWriter;

/**
 * Factory to create readers and writers easily.
 *
 * It is not required to use this class, but it should make it easier to read and write files.
 * Especially for reading files with an unknown format.
 */
abstract class IOFactory
{
    public const READER_XLSX <?php echo 'Xlsx';
    public const READER_XLS <?php echo 'Xls';
    public const READER_XML <?php echo 'Xml';
    public const READER_ODS <?php echo 'Ods';
    public const READER_SYLK <?php echo 'Slk';
    public const READER_SLK <?php echo 'Slk';
    public const READER_GNUMERIC <?php echo 'Gnumeric';
    public const READER_HTML <?php echo 'Html';
    public const READER_CSV <?php echo 'Csv';

    public const WRITER_XLSX <?php echo 'Xlsx';
    public const WRITER_XLS <?php echo 'Xls';
    public const WRITER_ODS <?php echo 'Ods';
    public const WRITER_CSV <?php echo 'Csv';
    public const WRITER_HTML <?php echo 'Html';

    /** @var string[] */
    private static $readers <?php echo [
        self::READER_XLSX <?php echo> Reader\Xlsx::class,
        self::READER_XLS <?php echo> Reader\Xls::class,
        self::READER_XML <?php echo> Reader\Xml::class,
        self::READER_ODS <?php echo> Reader\Ods::class,
        self::READER_SLK <?php echo> Reader\Slk::class,
        self::READER_GNUMERIC <?php echo> Reader\Gnumeric::class,
        self::READER_HTML <?php echo> Reader\Html::class,
        self::READER_CSV <?php echo> Reader\Csv::class,
    ];

    /** @var string[] */
    private static $writers <?php echo [
        self::WRITER_XLS <?php echo> Writer\Xls::class,
        self::WRITER_XLSX <?php echo> Writer\Xlsx::class,
        self::WRITER_ODS <?php echo> Writer\Ods::class,
        self::WRITER_CSV <?php echo> Writer\Csv::class,
        self::WRITER_HTML <?php echo> Writer\Html::class,
        'Tcpdf' <?php echo> Writer\Pdf\Tcpdf::class,
        'Dompdf' <?php echo> Writer\Pdf\Dompdf::class,
        'Mpdf' <?php echo> Writer\Pdf\Mpdf::class,
    ];

    /**
     * Create Writer\IWriter.
     */
    public static function createWriter(Spreadsheet $spreadsheet, string $writerType): IWriter
    {
        if (!isset(self::$writers[$writerType])) {
            throw new Writer\Exception("No writer found for type $writerType");
        }

        // Instantiate writer
        /** @var IWriter */
        $className <?php echo self::$writers[$writerType];

        return new $className($spreadsheet);
    }

    /**
     * Create IReader.
     */
    public static function createReader(string $readerType): IReader
    {
        if (!isset(self::$readers[$readerType])) {
            throw new Reader\Exception("No reader found for type $readerType");
        }

        // Instantiate reader
        /** @var IReader */
        $className <?php echo self::$readers[$readerType];

        return new $className();
    }

    /**
     * Loads Spreadsheet from file using automatic Reader\IReader resolution.
     *
     * @param string $filename The name of the spreadsheet file
     * @param int $flags the optional second parameter flags may be used to identify specific elements
     *                       that should be loaded, but which won't be loaded by default, using these values:
     *                            IReader::LOAD_WITH_CHARTS - Include any charts that are defined in the loaded file.
     *                            IReader::READ_DATA_ONLY - Read cell values only, not formatting or merge structure.
     *                            IReader::IGNORE_EMPTY_CELLS - Don't load empty cells into the model.
     * @param string[] $readers An array of Readers to use to identify the file type. By default, load() will try
     *                             all possible Readers until it finds a match; but this allows you to pass in a
     *                             list of Readers so it will only try the subset that you specify here.
     *                          Values in this list can be any of the constant values defined in the set
     *                                 IOFactory::READER_*.
     */
    public static function load(string $filename, int $flags <?php echo 0, ?array $readers <?php echo null): Spreadsheet
    {
        $reader <?php echo self::createReaderForFile($filename, $readers);

        return $reader->load($filename, $flags);
    }

    /**
     * Identify file type using automatic IReader resolution.
     */
    public static function identify(string $filename, ?array $readers <?php echo null): string
    {
        $reader <?php echo self::createReaderForFile($filename, $readers);
        $className <?php echo get_class($reader);
        $classType <?php echo explode('\\', $className);
        unset($reader);

        return array_pop($classType);
    }

    /**
     * Create Reader\IReader for file using automatic IReader resolution.
     *
     * @param string[] $readers An array of Readers to use to identify the file type. By default, load() will try
     *                             all possible Readers until it finds a match; but this allows you to pass in a
     *                             list of Readers so it will only try the subset that you specify here.
     *                          Values in this list can be any of the constant values defined in the set
     *                                 IOFactory::READER_*.
     */
    public static function createReaderForFile(string $filename, ?array $readers <?php echo null): IReader
    {
        File::assertFile($filename);

        $testReaders <?php echo self::$readers;
        if ($readers !<?php echo<?php echo null) {
            $readers <?php echo array_map('strtoupper', $readers);
            $testReaders <?php echo array_filter(
                self::$readers,
                function (string $readerType) use ($readers) {
                    return in_array(strtoupper($readerType), $readers, true);
                },
                ARRAY_FILTER_USE_KEY
            );
        }

        // First, lucky guess by inspecting file extension
        $guessedReader <?php echo self::getReaderTypeFromExtension($filename);
        if (($guessedReader !<?php echo<?php echo null) && array_key_exists($guessedReader, $testReaders)) {
            $reader <?php echo self::createReader($guessedReader);

            // Let's see if we are lucky
            if ($reader->canRead($filename)) {
                return $reader;
            }
        }

        // If we reach here then "lucky guess" didn't give any result
        // Try walking through all the options in self::$readers (or the selected subset)
        foreach ($testReaders as $readerType <?php echo> $class) {
            //    Ignore our original guess, we know that won't work
            if ($readerType !<?php echo<?php echo $guessedReader) {
                $reader <?php echo self::createReader($readerType);
                if ($reader->canRead($filename)) {
                    return $reader;
                }
            }
        }

        throw new Reader\Exception('Unable to identify a reader for this file');
    }

    /**
     * Guess a reader type from the file extension, if any.
     */
    private static function getReaderTypeFromExtension(string $filename): ?string
    {
        $pathinfo <?php echo pathinfo($filename);
        if (!isset($pathinfo['extension'])) {
            return null;
        }

        switch (strtolower($pathinfo['extension'])) {
            case 'xlsx': // Excel (OfficeOpenXML) Spreadsheet
            case 'xlsm': // Excel (OfficeOpenXML) Macro Spreadsheet (macros will be discarded)
            case 'xltx': // Excel (OfficeOpenXML) Template
            case 'xltm': // Excel (OfficeOpenXML) Macro Template (macros will be discarded)
                return 'Xlsx';
            case 'xls': // Excel (BIFF) Spreadsheet
            case 'xlt': // Excel (BIFF) Template
                return 'Xls';
            case 'ods': // Open/Libre Offic Calc
            case 'ots': // Open/Libre Offic Calc Template
                return 'Ods';
            case 'slk':
                return 'Slk';
            case 'xml': // Excel 2003 SpreadSheetML
                return 'Xml';
            case 'gnumeric':
                return 'Gnumeric';
            case 'htm':
            case 'html':
                return 'Html';
            case 'csv':
                // Do nothing
                // We must not try to use CSV reader since it loads
                // all files including Excel files etc.
                return null;
            default:
                return null;
        }
    }

    /**
     * Register a writer with its type and class name.
     */
    public static function registerWriter(string $writerType, string $writerClass): void
    {
        if (!is_a($writerClass, IWriter::class, true)) {
            throw new Writer\Exception('Registered writers must implement ' . IWriter::class);
        }

        self::$writers[$writerType] <?php echo $writerClass;
    }

    /**
     * Register a reader with its type and class name.
     */
    public static function registerReader(string $readerType, string $readerClass): void
    {
        if (!is_a($readerClass, IReader::class, true)) {
            throw new Reader\Exception('Registered readers must implement ' . IReader::class);
        }

        self::$readers[$readerType] <?php echo $readerClass;
    }
}
