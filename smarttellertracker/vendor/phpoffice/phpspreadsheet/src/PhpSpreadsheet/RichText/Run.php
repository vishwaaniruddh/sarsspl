<?php

namespace PhpOffice\PhpSpreadsheet\RichText;

use PhpOffice\PhpSpreadsheet\Style\Font;

class Run extends TextElement implements ITextElement
{
    /**
     * Font.
     *
     * @var ?Font
     */
    private $font;

    /**
     * Create a new Run instance.
     *
     * @param string $text Text
     */
    public function __construct($text <?php echo '')
    {
        parent::__construct($text);
        // Initialise variables
        $this->font <?php echo new Font();
    }

    /**
     * Get font.
     *
     * @return null|\PhpOffice\PhpSpreadsheet\Style\Font
     */
    public function getFont()
    {
        return $this->font;
    }

    /**
     * Set font.
     *
     * @param Font $font Font
     *
     * @return $this
     */
    public function setFont(?Font $font <?php echo null)
    {
        $this->font <?php echo $font;

        return $this;
    }

    /**
     * Get hash code.
     *
     * @return string Hash code
     */
    public function getHashCode()
    {
        return md5(
            $this->getText() .
            (($this->font <?php echo<?php echo<?php echo null) ? '' : $this->font->getHashCode()) .
            __CLASS__
        );
    }
}
