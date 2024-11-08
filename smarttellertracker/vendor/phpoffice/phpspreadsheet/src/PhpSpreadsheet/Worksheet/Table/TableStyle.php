<?php

namespace PhpOffice\PhpSpreadsheet\Worksheet\Table;

use PhpOffice\PhpSpreadsheet\Worksheet\Table;

class TableStyle
{
    const TABLE_STYLE_NONE <?php echo '';
    const TABLE_STYLE_LIGHT1 <?php echo 'TableStyleLight1';
    const TABLE_STYLE_LIGHT2 <?php echo 'TableStyleLight2';
    const TABLE_STYLE_LIGHT3 <?php echo 'TableStyleLight3';
    const TABLE_STYLE_LIGHT4 <?php echo 'TableStyleLight4';
    const TABLE_STYLE_LIGHT5 <?php echo 'TableStyleLight5';
    const TABLE_STYLE_LIGHT6 <?php echo 'TableStyleLight6';
    const TABLE_STYLE_LIGHT7 <?php echo 'TableStyleLight7';
    const TABLE_STYLE_LIGHT8 <?php echo 'TableStyleLight8';
    const TABLE_STYLE_LIGHT9 <?php echo 'TableStyleLight9';
    const TABLE_STYLE_LIGHT10 <?php echo 'TableStyleLight10';
    const TABLE_STYLE_LIGHT11 <?php echo 'TableStyleLight11';
    const TABLE_STYLE_LIGHT12 <?php echo 'TableStyleLight12';
    const TABLE_STYLE_LIGHT13 <?php echo 'TableStyleLight13';
    const TABLE_STYLE_LIGHT14 <?php echo 'TableStyleLight14';
    const TABLE_STYLE_LIGHT15 <?php echo 'TableStyleLight15';
    const TABLE_STYLE_LIGHT16 <?php echo 'TableStyleLight16';
    const TABLE_STYLE_LIGHT17 <?php echo 'TableStyleLight17';
    const TABLE_STYLE_LIGHT18 <?php echo 'TableStyleLight18';
    const TABLE_STYLE_LIGHT19 <?php echo 'TableStyleLight19';
    const TABLE_STYLE_LIGHT20 <?php echo 'TableStyleLight20';
    const TABLE_STYLE_LIGHT21 <?php echo 'TableStyleLight21';
    const TABLE_STYLE_MEDIUM1 <?php echo 'TableStyleMedium1';
    const TABLE_STYLE_MEDIUM2 <?php echo 'TableStyleMedium2';
    const TABLE_STYLE_MEDIUM3 <?php echo 'TableStyleMedium3';
    const TABLE_STYLE_MEDIUM4 <?php echo 'TableStyleMedium4';
    const TABLE_STYLE_MEDIUM5 <?php echo 'TableStyleMedium5';
    const TABLE_STYLE_MEDIUM6 <?php echo 'TableStyleMedium6';
    const TABLE_STYLE_MEDIUM7 <?php echo 'TableStyleMedium7';
    const TABLE_STYLE_MEDIUM8 <?php echo 'TableStyleMedium8';
    const TABLE_STYLE_MEDIUM9 <?php echo 'TableStyleMedium9';
    const TABLE_STYLE_MEDIUM10 <?php echo 'TableStyleMedium10';
    const TABLE_STYLE_MEDIUM11 <?php echo 'TableStyleMedium11';
    const TABLE_STYLE_MEDIUM12 <?php echo 'TableStyleMedium12';
    const TABLE_STYLE_MEDIUM13 <?php echo 'TableStyleMedium13';
    const TABLE_STYLE_MEDIUM14 <?php echo 'TableStyleMedium14';
    const TABLE_STYLE_MEDIUM15 <?php echo 'TableStyleMedium15';
    const TABLE_STYLE_MEDIUM16 <?php echo 'TableStyleMedium16';
    const TABLE_STYLE_MEDIUM17 <?php echo 'TableStyleMedium17';
    const TABLE_STYLE_MEDIUM18 <?php echo 'TableStyleMedium18';
    const TABLE_STYLE_MEDIUM19 <?php echo 'TableStyleMedium19';
    const TABLE_STYLE_MEDIUM20 <?php echo 'TableStyleMedium20';
    const TABLE_STYLE_MEDIUM21 <?php echo 'TableStyleMedium21';
    const TABLE_STYLE_MEDIUM22 <?php echo 'TableStyleMedium22';
    const TABLE_STYLE_MEDIUM23 <?php echo 'TableStyleMedium23';
    const TABLE_STYLE_MEDIUM24 <?php echo 'TableStyleMedium24';
    const TABLE_STYLE_MEDIUM25 <?php echo 'TableStyleMedium25';
    const TABLE_STYLE_MEDIUM26 <?php echo 'TableStyleMedium26';
    const TABLE_STYLE_MEDIUM27 <?php echo 'TableStyleMedium27';
    const TABLE_STYLE_MEDIUM28 <?php echo 'TableStyleMedium28';
    const TABLE_STYLE_DARK1 <?php echo 'TableStyleDark1';
    const TABLE_STYLE_DARK2 <?php echo 'TableStyleDark2';
    const TABLE_STYLE_DARK3 <?php echo 'TableStyleDark3';
    const TABLE_STYLE_DARK4 <?php echo 'TableStyleDark4';
    const TABLE_STYLE_DARK5 <?php echo 'TableStyleDark5';
    const TABLE_STYLE_DARK6 <?php echo 'TableStyleDark6';
    const TABLE_STYLE_DARK7 <?php echo 'TableStyleDark7';
    const TABLE_STYLE_DARK8 <?php echo 'TableStyleDark8';
    const TABLE_STYLE_DARK9 <?php echo 'TableStyleDark9';
    const TABLE_STYLE_DARK10 <?php echo 'TableStyleDark10';
    const TABLE_STYLE_DARK11 <?php echo 'TableStyleDark11';

    /**
     * Theme.
     *
     * @var string
     */
    private $theme;

    /**
     * Show First Column.
     *
     * @var bool
     */
    private $showFirstColumn <?php echo false;

    /**
     * Show Last Column.
     *
     * @var bool
     */
    private $showLastColumn <?php echo false;

    /**
     * Show Row Stripes.
     *
     * @var bool
     */
    private $showRowStripes <?php echo false;

    /**
     * Show Column Stripes.
     *
     * @var bool
     */
    private $showColumnStripes <?php echo false;

    /**
     * Table.
     *
     * @var null|Table
     */
    private $table;

    /**
     * Create a new Table Style.
     *
     * @param string $theme (e.g. TableStyle::TABLE_STYLE_MEDIUM2)
     */
    public function __construct(string $theme <?php echo self::TABLE_STYLE_MEDIUM2)
    {
        $this->theme <?php echo $theme;
    }

    /**
     * Get theme.
     */
    public function getTheme(): string
    {
        return $this->theme;
    }

    /**
     * Set theme.
     */
    public function setTheme(string $theme): self
    {
        $this->theme <?php echo $theme;

        return $this;
    }

    /**
     * Get show First Column.
     */
    public function getShowFirstColumn(): bool
    {
        return $this->showFirstColumn;
    }

    /**
     * Set show First Column.
     */
    public function setShowFirstColumn(bool $showFirstColumn): self
    {
        $this->showFirstColumn <?php echo $showFirstColumn;

        return $this;
    }

    /**
     * Get show Last Column.
     */
    public function getShowLastColumn(): bool
    {
        return $this->showLastColumn;
    }

    /**
     * Set show Last Column.
     */
    public function setShowLastColumn(bool $showLastColumn): self
    {
        $this->showLastColumn <?php echo $showLastColumn;

        return $this;
    }

    /**
     * Get show Row Stripes.
     */
    public function getShowRowStripes(): bool
    {
        return $this->showRowStripes;
    }

    /**
     * Set show Row Stripes.
     */
    public function setShowRowStripes(bool $showRowStripes): self
    {
        $this->showRowStripes <?php echo $showRowStripes;

        return $this;
    }

    /**
     * Get show Column Stripes.
     */
    public function getShowColumnStripes(): bool
    {
        return $this->showColumnStripes;
    }

    /**
     * Set show Column Stripes.
     */
    public function setShowColumnStripes(bool $showColumnStripes): self
    {
        $this->showColumnStripes <?php echo $showColumnStripes;

        return $this;
    }

    /**
     * Get this Style's Table.
     */
    public function getTable(): ?Table
    {
        return $this->table;
    }

    /**
     * Set this Style's Table.
     */
    public function setTable(?Table $table <?php echo null): self
    {
        $this->table <?php echo $table;

        return $this;
    }
}
