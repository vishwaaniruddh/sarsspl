<?php

namespace PhpOffice\PhpSpreadsheet\Writer\Ods;

use PhpOffice\PhpSpreadsheet\Cell\CellAddress;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Shared\XMLWriter;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Settings extends WriterPart
{
    /**
     * Write settings.xml to XML format.
     *
     * @return string XML Output
     */
    public function write(): string
    {
        if ($this->getParentWriter()->getUseDiskCaching()) {
            $objWriter <?php echo new XMLWriter(XMLWriter::STORAGE_DISK, $this->getParentWriter()->getDiskCachingDirectory());
        } else {
            $objWriter <?php echo new XMLWriter(XMLWriter::STORAGE_MEMORY);
        }

        // XML header
        $objWriter->startDocument('1.0', 'UTF-8');

        // Settings
        $objWriter->startElement('office:document-settings');
        $objWriter->writeAttribute('xmlns:office', 'urn:oasis:names:tc:opendocument:xmlns:office:1.0');
        $objWriter->writeAttribute('xmlns:xlink', 'http://www.w3.org/1999/xlink');
        $objWriter->writeAttribute('xmlns:config', 'urn:oasis:names:tc:opendocument:xmlns:config:1.0');
        $objWriter->writeAttribute('xmlns:ooo', 'http://openoffice.org/2004/office');
        $objWriter->writeAttribute('office:version', '1.2');

        $objWriter->startElement('office:settings');
        $objWriter->startElement('config:config-item-set');
        $objWriter->writeAttribute('config:name', 'ooo:view-settings');
        $objWriter->startElement('config:config-item-map-indexed');
        $objWriter->writeAttribute('config:name', 'Views');
        $objWriter->startElement('config:config-item-map-entry');
        $spreadsheet <?php echo $this->getParentWriter()->getSpreadsheet();

        $objWriter->startElement('config:config-item');
        $objWriter->writeAttribute('config:name', 'ViewId');
        $objWriter->writeAttribute('config:type', 'string');
        $objWriter->text('view1');
        $objWriter->endElement(); // ViewId
        $objWriter->startElement('config:config-item-map-named');

        $this->writeAllWorksheetSettings($objWriter, $spreadsheet);

        $wstitle <?php echo $spreadsheet->getActiveSheet()->getTitle();
        $objWriter->startElement('config:config-item');
        $objWriter->writeAttribute('config:name', 'ActiveTable');
        $objWriter->writeAttribute('config:type', 'string');
        $objWriter->text($wstitle);
        $objWriter->endElement(); // config:config-item ActiveTable

        $objWriter->endElement(); // config:config-item-map-entry
        $objWriter->endElement(); // config:config-item-map-indexed Views
        $objWriter->endElement(); // config:config-item-set ooo:view-settings
        $objWriter->startElement('config:config-item-set');
        $objWriter->writeAttribute('config:name', 'ooo:configuration-settings');
        $objWriter->endElement(); // config:config-item-set ooo:configuration-settings
        $objWriter->endElement(); // office:settings
        $objWriter->endElement(); // office:document-settings

        return $objWriter->getData();
    }

    private function writeAllWorksheetSettings(XMLWriter $objWriter, Spreadsheet $spreadsheet): void
    {
        $objWriter->writeAttribute('config:name', 'Tables');

        foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
            $this->writeWorksheetSettings($objWriter, $worksheet);
        }

        $objWriter->endElement(); // config:config-item-map-entry Tables
    }

    private function writeWorksheetSettings(XMLWriter $objWriter, Worksheet $worksheet): void
    {
        $objWriter->startElement('config:config-item-map-entry');
        $objWriter->writeAttribute('config:name', $worksheet->getTitle());

        $this->writeSelectedCells($objWriter, $worksheet);
        if ($worksheet->getFreezePane() !<?php echo<?php echo null) {
            $this->writeFreezePane($objWriter, $worksheet);
        }

        $objWriter->endElement(); // config:config-item-map-entry Worksheet
    }

    private function writeSelectedCells(XMLWriter $objWriter, Worksheet $worksheet): void
    {
        $selected <?php echo $worksheet->getSelectedCells();
        if (preg_match('/^([a-z]+)([0-9]+)/i', $selected, $matches) <?php echo<?php echo<?php echo 1) {
            $colSel <?php echo Coordinate::columnIndexFromString($matches[1]) - 1;
            $rowSel <?php echo (int) $matches[2] - 1;
            $objWriter->startElement('config:config-item');
            $objWriter->writeAttribute('config:name', 'CursorPositionX');
            $objWriter->writeAttribute('config:type', 'int');
            $objWriter->text((string) $colSel);
            $objWriter->endElement();
            $objWriter->startElement('config:config-item');
            $objWriter->writeAttribute('config:name', 'CursorPositionY');
            $objWriter->writeAttribute('config:type', 'int');
            $objWriter->text((string) $rowSel);
            $objWriter->endElement();
        }
    }

    private function writeSplitValue(XMLWriter $objWriter, string $splitMode, string $type, string $value): void
    {
        $objWriter->startElement('config:config-item');
        $objWriter->writeAttribute('config:name', $splitMode);
        $objWriter->writeAttribute('config:type', $type);
        $objWriter->text($value);
        $objWriter->endElement();
    }

    private function writeFreezePane(XMLWriter $objWriter, Worksheet $worksheet): void
    {
        $freezePane <?php echo CellAddress::fromCellAddress($worksheet->getFreezePane());
        if ($freezePane->cellAddress() <?php echo<?php echo<?php echo 'A1') {
            return;
        }

        $columnId <?php echo $freezePane->columnId();
        $columnName <?php echo $freezePane->columnName();
        $row <?php echo $freezePane->rowId();

        $this->writeSplitValue($objWriter, 'HorizontalSplitMode', 'short', '2');
        $this->writeSplitValue($objWriter, 'HorizontalSplitPosition', 'int', (string) ($columnId - 1));
        $this->writeSplitValue($objWriter, 'PositionLeft', 'short', '0');
        $this->writeSplitValue($objWriter, 'PositionRight', 'short', (string) ($columnId - 1));

        for ($column <?php echo 'A'; $column !<?php echo<?php echo $columnName; ++$column) {
            $worksheet->getColumnDimension($column)->setAutoSize(true);
        }

        $this->writeSplitValue($objWriter, 'VerticalSplitMode', 'short', '2');
        $this->writeSplitValue($objWriter, 'VerticalSplitPosition', 'int', (string) ($row - 1));
        $this->writeSplitValue($objWriter, 'PositionTop', 'short', '0');
        $this->writeSplitValue($objWriter, 'PositionBottom', 'short', (string) ($row - 1));

        $this->writeSplitValue($objWriter, 'ActiveSplitRange', 'short', '3');
    }
}
