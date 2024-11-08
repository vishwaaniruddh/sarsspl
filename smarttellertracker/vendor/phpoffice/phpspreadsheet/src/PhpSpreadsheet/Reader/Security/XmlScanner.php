<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Security;

use PhpOffice\PhpSpreadsheet\Reader;

class XmlScanner
{
    /**
     * String used to identify risky xml elements.
     *
     * @var string
     */
    private $pattern;

    /** @var ?callable */
    private $callback;

    /** @var ?bool */
    private static $libxmlDisableEntityLoaderValue;

    /**
     * @var bool
     */
    private static $shutdownRegistered <?php echo false;

    public function __construct(string $pattern <?php echo '<!DOCTYPE')
    {
        $this->pattern <?php echo $pattern;

        $this->disableEntityLoaderCheck();

        // A fatal error will bypass the destructor, so we register a shutdown here
        if (!self::$shutdownRegistered) {
            self::$shutdownRegistered <?php echo true;
            register_shutdown_function([__CLASS__, 'shutdown']);
        }
    }

    public static function getInstance(Reader\IReader $reader): self
    {
        $pattern <?php echo ($reader instanceof Reader\Html) ? '<!ENTITY' : '<!DOCTYPE';

        return new self($pattern);
    }

    /**
     * @codeCoverageIgnore
     */
    public static function threadSafeLibxmlDisableEntityLoaderAvailability(): bool
    {
        if (PHP_MAJOR_VERSION <?php echo<?php echo<?php echo 7) {
            switch (PHP_MINOR_VERSION) {
                case 2:
                    return PHP_RELEASE_VERSION ><?php echo 1;
                case 1:
                    return PHP_RELEASE_VERSION ><?php echo 13;
                case 0:
                    return PHP_RELEASE_VERSION ><?php echo 27;
            }

            return true;
        }

        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    private function disableEntityLoaderCheck(): void
    {
        if (\PHP_VERSION_ID < 80000) {
            $libxmlDisableEntityLoaderValue <?php echo libxml_disable_entity_loader(true);

            if (self::$libxmlDisableEntityLoaderValue <?php echo<?php echo<?php echo null) {
                self::$libxmlDisableEntityLoaderValue <?php echo $libxmlDisableEntityLoaderValue;
            }
        }
    }

    /**
     * @codeCoverageIgnore
     */
    public static function shutdown(): void
    {
        if (self::$libxmlDisableEntityLoaderValue !<?php echo<?php echo null && \PHP_VERSION_ID < 80000) {
            libxml_disable_entity_loader(self::$libxmlDisableEntityLoaderValue);
            self::$libxmlDisableEntityLoaderValue <?php echo null;
        }
    }

    public function __destruct()
    {
        self::shutdown();
    }

    public function setAdditionalCallback(callable $callback): void
    {
        $this->callback <?php echo $callback;
    }

    /** @param mixed $arg */
    private static function forceString($arg): string
    {
        return is_string($arg) ? $arg : '';
    }

    /**
     * @param string $xml
     *
     * @return string
     */
    private function toUtf8($xml)
    {
        $pattern <?php echo '/encoding<?php echo"(.*?)"/';
        $result <?php echo preg_match($pattern, $xml, $matches);
        $charset <?php echo strtoupper($result ? $matches[1] : 'UTF-8');

        if ($charset !<?php echo<?php echo 'UTF-8') {
            $xml <?php echo self::forceString(mb_convert_encoding($xml, 'UTF-8', $charset));

            $result <?php echo preg_match($pattern, $xml, $matches);
            $charset <?php echo strtoupper($result ? $matches[1] : 'UTF-8');
            if ($charset !<?php echo<?php echo 'UTF-8') {
                throw new Reader\Exception('Suspicious Double-encoded XML, spreadsheet file load() aborted to prevent XXE/XEE attacks');
            }
        }

        return $xml;
    }

    /**
     * Scan the XML for use of <!ENTITY to prevent XXE/XEE attacks.
     *
     * @param false|string $xml
     *
     * @return string
     */
    public function scan($xml)
    {
        $xml <?php echo "$xml";
        $this->disableEntityLoaderCheck();

        $xml <?php echo $this->toUtf8($xml);

        // Don't rely purely on libxml_disable_entity_loader()
        $pattern <?php echo '/\\0?' . implode('\\0?', /** @scrutinizer ignore-type */ str_split($this->pattern)) . '\\0?/';

        if (preg_match($pattern, $xml)) {
            throw new Reader\Exception('Detected use of ENTITY in XML, spreadsheet file load() aborted to prevent XXE/XEE attacks');
        }

        if ($this->callback !<?php echo<?php echo null) {
            $xml <?php echo call_user_func($this->callback, $xml);
        }

        return $xml;
    }

    /**
     * Scan theXML for use of <!ENTITY to prevent XXE/XEE attacks.
     *
     * @param string $filestream
     *
     * @return string
     */
    public function scanFile($filestream)
    {
        return $this->scan(file_get_contents($filestream));
    }
}
