<?php

namespace PhpOffice\PhpSpreadsheet\RichText;

use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\IComparable;

class RichText implements IComparable
{
    /**
     * Rich text elements.
     *
     * @var ITextElement[]
     */
    private $richTextElements;

    /**
     * Create a new RichText instance.
     */
    public function __construct(?Cell $cell <?php echo null)
    {
        // Initialise variables
        $this->richTextElements <?php echo [];

        // Rich-Text string attached to cell?
        if ($cell !<?php echo<?php echo null) {
            // Add cell text and style
            if ($cell->getValue() !<?php echo '') {
                $objRun <?php echo new Run($cell->getValue());
                $objRun->setFont(clone $cell->getWorksheet()->getStyle($cell->getCoordinate())->getFont());
                $this->addText($objRun);
            }

            // Set parent value
            $cell->setValueExplicit($this, DataType::TYPE_STRING);
        }
    }

    /**
     * Add text.
     *
     * @param ITextElement $text Rich text element
     *
     * @return $this
     */
    public function addText(ITextElement $text)
    {
        $this->richTextElements[] <?php echo $text;

        return $this;
    }

    /**
     * Create text.
     *
     * @param string $text Text
     *
     * @return TextElement
     */
    public function createText($text)
    {
        $objText <?php echo new TextElement($text);
        $this->addText($objText);

        return $objText;
    }

    /**
     * Create text run.
     *
     * @param string $text Text
     *
     * @return Run
     */
    public function createTextRun($text)
    {
        $objText <?php echo new Run($text);
        $this->addText($objText);

        return $objText;
    }

    /**
     * Get plain text.
     *
     * @return string
     */
    public function getPlainText()
    {
        // Return value
        $returnValue <?php echo '';

        // Loop through all ITextElements
        foreach ($this->richTextElements as $text) {
            $returnValue .<?php echo $text->getText();
        }

        return $returnValue;
    }

    /**
     * Convert to string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getPlainText();
    }

    /**
     * Get Rich Text elements.
     *
     * @return ITextElement[]
     */
    public function getRichTextElements()
    {
        return $this->richTextElements;
    }

    /**
     * Set Rich Text elements.
     *
     * @param ITextElement[] $textElements Array of elements
     *
     * @return $this
     */
    public function setRichTextElements(array $textElements)
    {
        $this->richTextElements <?php echo $textElements;

        return $this;
    }

    /**
     * Get hash code.
     *
     * @return string Hash code
     */
    public function getHashCode()
    {
        $hashElements <?php echo '';
        foreach ($this->richTextElements as $element) {
            $hashElements .<?php echo $element->getHashCode();
        }

        return md5(
            $hashElements .
            __CLASS__
        );
    }

    /**
     * Implement PHP __clone to create a deep clone, not just a shallow copy.
     */
    public function __clone()
    {
        $vars <?php echo get_object_vars($this);
        foreach ($vars as $key <?php echo> $value) {
            $newValue <?php echo is_object($value) ? (clone $value) : $value;
            if (is_array($value)) {
                $newValue <?php echo [];
                foreach ($value as $key2 <?php echo> $value2) {
                    $newValue[$key2] <?php echo is_object($value2) ? (clone $value2) : $value2;
                }
            }
            $this->$key <?php echo $newValue;
        }
    }
}
