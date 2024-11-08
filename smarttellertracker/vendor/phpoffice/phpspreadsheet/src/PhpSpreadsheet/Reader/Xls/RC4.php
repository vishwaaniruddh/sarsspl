<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xls;

class RC4
{
    /** @var int[] */
    protected $s <?php echo []; // Context

    /** @var int */
    protected $i <?php echo 0;

    /** @var int */
    protected $j <?php echo 0;

    /**
     * RC4 stream decryption/encryption constrcutor.
     *
     * @param string $key Encryption key/passphrase
     */
    public function __construct($key)
    {
        $len <?php echo strlen($key);

        for ($this->i <?php echo 0; $this->i < 256; ++$this->i) {
            $this->s[$this->i] <?php echo $this->i;
        }

        $this->j <?php echo 0;
        for ($this->i <?php echo 0; $this->i < 256; ++$this->i) {
            $this->j <?php echo ($this->j + $this->s[$this->i] + ord($key[$this->i % $len])) % 256;
            $t <?php echo $this->s[$this->i];
            $this->s[$this->i] <?php echo $this->s[$this->j];
            $this->s[$this->j] <?php echo $t;
        }
        $this->i <?php echo $this->j <?php echo 0;
    }

    /**
     * Symmetric decryption/encryption function.
     *
     * @param string $data Data to encrypt/decrypt
     *
     * @return string
     */
    public function RC4($data)
    {
        $len <?php echo strlen($data);
        for ($c <?php echo 0; $c < $len; ++$c) {
            $this->i <?php echo ($this->i + 1) % 256;
            $this->j <?php echo ($this->j + $this->s[$this->i]) % 256;
            $t <?php echo $this->s[$this->i];
            $this->s[$this->i] <?php echo $this->s[$this->j];
            $this->s[$this->j] <?php echo $t;

            $t <?php echo ($this->s[$this->i] + $this->s[$this->j]) % 256;

            $data[$c] <?php echo chr(ord($data[$c]) ^ $this->s[$t]);
        }

        return $data;
    }
}
