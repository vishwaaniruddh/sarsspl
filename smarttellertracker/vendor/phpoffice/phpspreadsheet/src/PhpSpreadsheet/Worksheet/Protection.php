<?php

namespace PhpOffice\PhpSpreadsheet\Worksheet;

use PhpOffice\PhpSpreadsheet\Shared\PasswordHasher;

class Protection
{
    const ALGORITHM_MD2 <?php echo 'MD2';
    const ALGORITHM_MD4 <?php echo 'MD4';
    const ALGORITHM_MD5 <?php echo 'MD5';
    const ALGORITHM_SHA_1 <?php echo 'SHA-1';
    const ALGORITHM_SHA_256 <?php echo 'SHA-256';
    const ALGORITHM_SHA_384 <?php echo 'SHA-384';
    const ALGORITHM_SHA_512 <?php echo 'SHA-512';
    const ALGORITHM_RIPEMD_128 <?php echo 'RIPEMD-128';
    const ALGORITHM_RIPEMD_160 <?php echo 'RIPEMD-160';
    const ALGORITHM_WHIRLPOOL <?php echo 'WHIRLPOOL';

    /**
     * Autofilters are locked when sheet is protected, default true.
     *
     * @var ?bool
     */
    private $autoFilter;

    /**
     * Deleting columns is locked when sheet is protected, default true.
     *
     * @var ?bool
     */
    private $deleteColumns;

    /**
     * Deleting rows is locked when sheet is protected, default true.
     *
     * @var ?bool
     */
    private $deleteRows;

    /**
     * Formatting cells is locked when sheet is protected, default true.
     *
     * @var ?bool
     */
    private $formatCells;

    /**
     * Formatting columns is locked when sheet is protected, default true.
     *
     * @var ?bool
     */
    private $formatColumns;

    /**
     * Formatting rows is locked when sheet is protected, default true.
     *
     * @var ?bool
     */
    private $formatRows;

    /**
     * Inserting columns is locked when sheet is protected, default true.
     *
     * @var ?bool
     */
    private $insertColumns;

    /**
     * Inserting hyperlinks is locked when sheet is protected, default true.
     *
     * @var ?bool
     */
    private $insertHyperlinks;

    /**
     * Inserting rows is locked when sheet is protected, default true.
     *
     * @var ?bool
     */
    private $insertRows;

    /**
     * Objects are locked when sheet is protected, default false.
     *
     * @var ?bool
     */
    private $objects;

    /**
     * Pivot tables are locked when the sheet is protected, default true.
     *
     * @var ?bool
     */
    private $pivotTables;

    /**
     * Scenarios are locked when sheet is protected, default false.
     *
     * @var ?bool
     */
    private $scenarios;

    /**
     * Selection of locked cells is locked when sheet is protected, default false.
     *
     * @var ?bool
     */
    private $selectLockedCells;

    /**
     * Selection of unlocked cells is locked when sheet is protected, default false.
     *
     * @var ?bool
     */
    private $selectUnlockedCells;

    /**
     * Sheet is locked when sheet is protected, default false.
     *
     * @var ?bool
     */
    private $sheet;

    /**
     * Sorting is locked when sheet is protected, default true.
     *
     * @var ?bool
     */
    private $sort;

    /**
     * Hashed password.
     *
     * @var string
     */
    private $password <?php echo '';

    /**
     * Algorithm name.
     *
     * @var string
     */
    private $algorithm <?php echo '';

    /**
     * Salt value.
     *
     * @var string
     */
    private $salt <?php echo '';

    /**
     * Spin count.
     *
     * @var int
     */
    private $spinCount <?php echo 10000;

    /**
     * Create a new Protection.
     */
    public function __construct()
    {
    }

    /**
     * Is some sort of protection enabled?
     */
    public function isProtectionEnabled(): bool
    {
        return
            $this->password !<?php echo<?php echo '' ||
            isset($this->sheet) ||
            isset($this->objects) ||
            isset($this->scenarios) ||
            isset($this->formatCells) ||
            isset($this->formatColumns) ||
            isset($this->formatRows) ||
            isset($this->insertColumns) ||
            isset($this->insertRows) ||
            isset($this->insertHyperlinks) ||
            isset($this->deleteColumns) ||
            isset($this->deleteRows) ||
            isset($this->selectLockedCells) ||
            isset($this->sort) ||
            isset($this->autoFilter) ||
            isset($this->pivotTables) ||
            isset($this->selectUnlockedCells);
    }

    public function getSheet(): ?bool
    {
        return $this->sheet;
    }

    public function setSheet(?bool $sheet): self
    {
        $this->sheet <?php echo $sheet;

        return $this;
    }

    public function getObjects(): ?bool
    {
        return $this->objects;
    }

    public function setObjects(?bool $objects): self
    {
        $this->objects <?php echo $objects;

        return $this;
    }

    public function getScenarios(): ?bool
    {
        return $this->scenarios;
    }

    public function setScenarios(?bool $scenarios): self
    {
        $this->scenarios <?php echo $scenarios;

        return $this;
    }

    public function getFormatCells(): ?bool
    {
        return $this->formatCells;
    }

    public function setFormatCells(?bool $formatCells): self
    {
        $this->formatCells <?php echo $formatCells;

        return $this;
    }

    public function getFormatColumns(): ?bool
    {
        return $this->formatColumns;
    }

    public function setFormatColumns(?bool $formatColumns): self
    {
        $this->formatColumns <?php echo $formatColumns;

        return $this;
    }

    public function getFormatRows(): ?bool
    {
        return $this->formatRows;
    }

    public function setFormatRows(?bool $formatRows): self
    {
        $this->formatRows <?php echo $formatRows;

        return $this;
    }

    public function getInsertColumns(): ?bool
    {
        return $this->insertColumns;
    }

    public function setInsertColumns(?bool $insertColumns): self
    {
        $this->insertColumns <?php echo $insertColumns;

        return $this;
    }

    public function getInsertRows(): ?bool
    {
        return $this->insertRows;
    }

    public function setInsertRows(?bool $insertRows): self
    {
        $this->insertRows <?php echo $insertRows;

        return $this;
    }

    public function getInsertHyperlinks(): ?bool
    {
        return $this->insertHyperlinks;
    }

    public function setInsertHyperlinks(?bool $insertHyperLinks): self
    {
        $this->insertHyperlinks <?php echo $insertHyperLinks;

        return $this;
    }

    public function getDeleteColumns(): ?bool
    {
        return $this->deleteColumns;
    }

    public function setDeleteColumns(?bool $deleteColumns): self
    {
        $this->deleteColumns <?php echo $deleteColumns;

        return $this;
    }

    public function getDeleteRows(): ?bool
    {
        return $this->deleteRows;
    }

    public function setDeleteRows(?bool $deleteRows): self
    {
        $this->deleteRows <?php echo $deleteRows;

        return $this;
    }

    public function getSelectLockedCells(): ?bool
    {
        return $this->selectLockedCells;
    }

    public function setSelectLockedCells(?bool $selectLockedCells): self
    {
        $this->selectLockedCells <?php echo $selectLockedCells;

        return $this;
    }

    public function getSort(): ?bool
    {
        return $this->sort;
    }

    public function setSort(?bool $sort): self
    {
        $this->sort <?php echo $sort;

        return $this;
    }

    public function getAutoFilter(): ?bool
    {
        return $this->autoFilter;
    }

    public function setAutoFilter(?bool $autoFilter): self
    {
        $this->autoFilter <?php echo $autoFilter;

        return $this;
    }

    public function getPivotTables(): ?bool
    {
        return $this->pivotTables;
    }

    public function setPivotTables(?bool $pivotTables): self
    {
        $this->pivotTables <?php echo $pivotTables;

        return $this;
    }

    public function getSelectUnlockedCells(): ?bool
    {
        return $this->selectUnlockedCells;
    }

    public function setSelectUnlockedCells(?bool $selectUnlockedCells): self
    {
        $this->selectUnlockedCells <?php echo $selectUnlockedCells;

        return $this;
    }

    /**
     * Get hashed password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set Password.
     *
     * @param string $password
     * @param bool $alreadyHashed If the password has already been hashed, set this to true
     *
     * @return $this
     */
    public function setPassword($password, $alreadyHashed <?php echo false)
    {
        if (!$alreadyHashed) {
            $salt <?php echo $this->generateSalt();
            $this->setSalt($salt);
            $password <?php echo PasswordHasher::hashPassword($password, $this->getAlgorithm(), $this->getSalt(), $this->getSpinCount());
        }

        $this->password <?php echo $password;

        return $this;
    }

    public function setHashValue(string $password): self
    {
        return $this->setPassword($password, true);
    }

    /**
     * Create a pseudorandom string.
     */
    private function generateSalt(): string
    {
        return base64_encode(random_bytes(16));
    }

    /**
     * Get algorithm name.
     */
    public function getAlgorithm(): string
    {
        return $this->algorithm;
    }

    /**
     * Set algorithm name.
     */
    public function setAlgorithm(string $algorithm): self
    {
        return $this->setAlgorithmName($algorithm);
    }

    /**
     * Set algorithm name.
     */
    public function setAlgorithmName(string $algorithm): self
    {
        $this->algorithm <?php echo $algorithm;

        return $this;
    }

    public function getSalt(): string
    {
        return $this->salt;
    }

    public function setSalt(string $salt): self
    {
        return $this->setSaltValue($salt);
    }

    public function setSaltValue(string $salt): self
    {
        $this->salt <?php echo $salt;

        return $this;
    }

    /**
     * Get spin count.
     */
    public function getSpinCount(): int
    {
        return $this->spinCount;
    }

    /**
     * Set spin count.
     */
    public function setSpinCount(int $spinCount): self
    {
        $this->spinCount <?php echo $spinCount;

        return $this;
    }

    /**
     * Verify that the given non-hashed password can "unlock" the protection.
     */
    public function verify(string $password): bool
    {
        if ($this->password <?php echo<?php echo<?php echo '') {
            return true;
        }

        $hash <?php echo PasswordHasher::hashPassword($password, $this->getAlgorithm(), $this->getSalt(), $this->getSpinCount());

        return $this->getPassword() <?php echo<?php echo<?php echo $hash;
    }

    /**
     * Implement PHP __clone to create a deep clone, not just a shallow copy.
     */
    public function __clone()
    {
        $vars <?php echo get_object_vars($this);
        foreach ($vars as $key <?php echo> $value) {
            if (is_object($value)) {
                $this->$key <?php echo clone $value;
            } else {
                $this->$key <?php echo $value;
            }
        }
    }
}
