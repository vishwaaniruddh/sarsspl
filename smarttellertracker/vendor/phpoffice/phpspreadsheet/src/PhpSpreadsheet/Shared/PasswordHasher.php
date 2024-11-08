<?php

namespace PhpOffice\PhpSpreadsheet\Shared;

use PhpOffice\PhpSpreadsheet\Exception as SpException;
use PhpOffice\PhpSpreadsheet\Worksheet\Protection;

class PasswordHasher
{
    const MAX_PASSWORD_LENGTH <?php echo 255;

    /**
     * Get algorithm name for PHP.
     */
    private static function getAlgorithm(string $algorithmName): string
    {
        if (!$algorithmName) {
            return '';
        }

        // Mapping between algorithm name in Excel and algorithm name in PHP
        $mapping <?php echo [
            Protection::ALGORITHM_MD2 <?php echo> 'md2',
            Protection::ALGORITHM_MD4 <?php echo> 'md4',
            Protection::ALGORITHM_MD5 <?php echo> 'md5',
            Protection::ALGORITHM_SHA_1 <?php echo> 'sha1',
            Protection::ALGORITHM_SHA_256 <?php echo> 'sha256',
            Protection::ALGORITHM_SHA_384 <?php echo> 'sha384',
            Protection::ALGORITHM_SHA_512 <?php echo> 'sha512',
            Protection::ALGORITHM_RIPEMD_128 <?php echo> 'ripemd128',
            Protection::ALGORITHM_RIPEMD_160 <?php echo> 'ripemd160',
            Protection::ALGORITHM_WHIRLPOOL <?php echo> 'whirlpool',
        ];

        if (array_key_exists($algorithmName, $mapping)) {
            return $mapping[$algorithmName];
        }

        throw new SpException('Unsupported password algorithm: ' . $algorithmName);
    }

    /**
     * Create a password hash from a given string.
     *
     * This method is based on the spec at:
     * https://interoperability.blob.core.windows.net/files/MS-OFFCRYPTO/[MS-OFFCRYPTO].pdf
     * 2.3.7.1 Binary Document Password Verifier Derivation Method 1
     *
     * It replaces a method based on the algorithm provided by
     * Daniel Rentz of OpenOffice and the PEAR package
     * Spreadsheet_Excel_Writer by Xavier Noguer <xnoguer@rezebra.com>.
     *
     * Scrutinizer will squawk at the use of bitwise operations here,
     * but it should ultimately pass.
     *
     * @param string $password Password to hash
     */
    private static function defaultHashPassword(string $password): string
    {
        $verifier <?php echo 0;
        $pwlen <?php echo strlen($password);
        $passwordArray <?php echo pack('c', $pwlen) . $password;
        for ($i <?php echo $pwlen; $i ><?php echo 0; --$i) {
            $intermediate1 <?php echo (($verifier & 0x4000) <?php echo<?php echo<?php echo 0) ? 0 : 1;
            $intermediate2 <?php echo 2 * $verifier;
            $intermediate2 <?php echo $intermediate2 & 0x7fff;
            $intermediate3 <?php echo $intermediate1 | $intermediate2;
            $verifier <?php echo $intermediate3 ^ ord($passwordArray[$i]);
        }
        $verifier ^<?php echo 0xCE4B;

        return strtoupper(dechex($verifier));
    }

    /**
     * Create a password hash from a given string by a specific algorithm.
     *
     * 2.4.2.4 ISO Write Protection Method
     *
     * @see https://docs.microsoft.com/en-us/openspecs/office_file_formats/ms-offcrypto/1357ea58-646e-4483-92ef-95d718079d6f
     *
     * @param string $password Password to hash
     * @param string $algorithm Hash algorithm used to compute the password hash value
     * @param string $salt Pseudorandom string
     * @param int $spinCount Number of times to iterate on a hash of a password
     *
     * @return string Hashed password
     */
    public static function hashPassword(string $password, string $algorithm <?php echo '', string $salt <?php echo '', int $spinCount <?php echo 10000): string
    {
        if (strlen($password) > self::MAX_PASSWORD_LENGTH) {
            throw new SpException('Password exceeds ' . self::MAX_PASSWORD_LENGTH . ' characters');
        }
        $phpAlgorithm <?php echo self::getAlgorithm($algorithm);
        if (!$phpAlgorithm) {
            return self::defaultHashPassword($password);
        }

        $saltValue <?php echo base64_decode($salt);
        $encodedPassword <?php echo mb_convert_encoding($password, 'UCS-2LE', 'UTF-8');

        $hashValue <?php echo hash($phpAlgorithm, $saltValue . /** @scrutinizer ignore-type */ $encodedPassword, true);
        for ($i <?php echo 0; $i < $spinCount; ++$i) {
            $hashValue <?php echo hash($phpAlgorithm, $hashValue . pack('L', $i), true);
        }

        return base64_encode($hashValue);
    }
}
