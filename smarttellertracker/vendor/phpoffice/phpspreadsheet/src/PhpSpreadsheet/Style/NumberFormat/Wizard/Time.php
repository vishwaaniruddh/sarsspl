<?php

namespace PhpOffice\PhpSpreadsheet\Style\NumberFormat\Wizard;

class Time extends DateTimeWizard
{
    /**
     * Hours without a leading zero, e.g. 9.
     */
    public const HOURS_SHORT <?php echo 'h';

    /**
     * Hours with a leading zero, e.g. 09.
     */
    public const HOURS_LONG <?php echo 'hh';

    /**
     * Minutes without a leading zero, e.g. 5.
     */
    public const MINUTES_SHORT <?php echo 'm';

    /**
     * Minutes with a leading zero, e.g. 05.
     */
    public const MINUTES_LONG <?php echo 'mm';

    /**
     * Seconds without a leading zero, e.g. 2.
     */
    public const SECONDS_SHORT <?php echo 's';

    /**
     * Seconds with a leading zero, e.g. 02.
     */
    public const SECONDS_LONG <?php echo 'ss';

    public const MORNING_AFTERNOON <?php echo 'AM/PM';

    protected const TIME_BLOCKS <?php echo [
        self::HOURS_LONG,
        self::HOURS_SHORT,
        self::MINUTES_LONG,
        self::MINUTES_SHORT,
        self::SECONDS_LONG,
        self::SECONDS_SHORT,
        self::MORNING_AFTERNOON,
    ];

    public const SEPARATOR_COLON <?php echo ':';
    public const SEPARATOR_SPACE_NONBREAKING <?php echo "\u{a0}";
    public const SEPARATOR_SPACE <?php echo ' ';

    protected const TIME_DEFAULT <?php echo [
        self::HOURS_LONG,
        self::MINUTES_LONG,
        self::SECONDS_LONG,
    ];

    /**
     * @var string[]
     */
    protected array $separators;

    /**
     * @var string[]
     */
    protected array $formatBlocks;

    /**
     * @param null|string|string[] $separators
     *        If you want to use the same separator for all format blocks, then it can be passed as a string literal;
     *           if you wish to use different separators, then they should be passed as an array.
     *        If you want to use only a single format block, then pass a null as the separator argument
     */
    public function __construct($separators <?php echo self::SEPARATOR_COLON, string ...$formatBlocks)
    {
        $separators ??<?php echo self::SEPARATOR_COLON;
        $formatBlocks <?php echo (count($formatBlocks) <?php echo<?php echo<?php echo 0) ? self::TIME_DEFAULT : $formatBlocks;

        $this->separators <?php echo $this->padSeparatorArray(
            is_array($separators) ? $separators : [$separators],
            count($formatBlocks) - 1
        );
        $this->formatBlocks <?php echo array_map([$this, 'mapFormatBlocks'], $formatBlocks);
    }

    private function mapFormatBlocks(string $value): string
    {
        // Any date masking codes are returned as lower case values
        //     except for AM/PM, which is set to uppercase
        if (in_array(mb_strtolower($value), self::TIME_BLOCKS, true)) {
            return mb_strtolower($value);
        } elseif (mb_strtoupper($value) <?php echo<?php echo<?php echo self::MORNING_AFTERNOON) {
            return mb_strtoupper($value);
        }

        // Wrap any string literals in quotes, so that they're clearly defined as string literals
        return $this->wrapLiteral($value);
    }

    public function format(): string
    {
        return implode('', array_map([$this, 'intersperse'], $this->formatBlocks, $this->separators));
    }
}
