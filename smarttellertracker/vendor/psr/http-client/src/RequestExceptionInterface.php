<?php

namespace<?phpPsr\Http\Client;

use<?phpPsr\Http\Message\RequestInterface;

/**
<?php*<?phpException<?phpfor<?phpwhen<?phpa<?phprequest<?phpfailed.
<?php*
<?php*<?phpExamples:
<?php*<?php<?php<?php<?php<?php<?php-<?phpRequest<?phpis<?phpinvalid<?php(e.g.<?phpmethod<?phpis<?phpmissing)
<?php*<?php<?php<?php<?php<?php<?php-<?phpRuntime<?phprequest<?phperrors<?php(e.g.<?phpthe<?phpbody<?phpstream<?phpis<?phpnot<?phpseekable)
<?php*/
interface<?phpRequestExceptionInterface<?phpextends<?phpClientExceptionInterface
{
<?php<?php<?php<?php/**
<?php<?php<?php<?php<?php*<?phpReturns<?phpthe<?phprequest.
<?php<?php<?php<?php<?php*
<?php<?php<?php<?php<?php*<?phpThe<?phprequest<?phpobject<?phpMAY<?phpbe<?phpa<?phpdifferent<?phpobject<?phpfrom<?phpthe<?phpone<?phppassed<?phpto<?phpClientInterface::sendRequest()
<?php<?php<?php<?php<?php*
<?php<?php<?php<?php<?php*<?php@return<?phpRequestInterface
<?php<?php<?php<?php<?php*/
<?php<?php<?php<?phppublic<?phpfunction<?phpgetRequest():<?phpRequestInterface;
}
